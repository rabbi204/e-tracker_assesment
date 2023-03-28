<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Employee;
use Illuminate\Http\Request;
use Image;

class EmployeeController extends Controller
{
    /**
     *  show all employee
     */
    public function index()
    {
        $all_data = Employee::latest()->get();
        return view('backend.employee.index', compact('all_data'));
    }
    /**
     *  create employee form
     */
    public function createEmployee()
    {
        $categories = Category::all();
        return view('backend.employee.create_employee', compact('categories'));
    }
    /**
     *  store employee data
     */
    public function storeEmployee(Request $request)
    {
        $validateData = $request->validate([
            'employee_name'  => 'required',
            'employee_email'   => 'required|email|unique:employees,employee_email',
            'employee_photo'  => 'required|image|mimes:jpg,png,jpeg|max:2048',
            'employee_gender'  => 'required',
            'employee_skills'  => 'required',
        ]);


        // if (!file_exists($save_path)) {
        //     mkdir($save_path, 666, true);
        // }

        $employeeData = new Employee();

        //image file upload process
        $image = $request->file('employee_photo');
        $name_gen = hexdec(uniqid()).'.'.$image -> getClientOriginalExtension();

        $save_path = "upload/images/employee/";
        if (!file_exists($save_path)) {
            mkdir($save_path, 666, true);
        }
        Image::make($image) -> resize(150,150) -> save($save_path.$name_gen);
        $save_url = 'upload/images/employee/'.$name_gen;

        $employeeData->employee_name = $request->employee_name;
        $employeeData->employee_email = $request->employee_email;
        $employeeData->employee_photo = $save_url;
        $employeeData->employee_gender = $request->employee_gender;
        $employeeData->employee_skills = json_encode($request->employee_skills);
        $employeeData->save();
        return redirect()->route('employee.index')->with('success', 'Employee Data Added Successful');

    }

    /***
     *  employee edit
     */
    public function editEmployee($id)
    {
        $categories = Category::all();
        $edit_data = Employee::findOrFail($id);
        return view('backend.employee.edit_employee', compact('edit_data', 'categories'));
    }

    /***
     *  update employee
     */
    public function updateEmployee(Request $request, $id)
    {
        $validateData = $request->validate([
            'employee_name'     => 'required',
            'employee_email'    => 'required|email|unique:employees,employee_email,'.$id,
            'employee_photo'    => 'image|mimes:jpg,png,jpeg|max:2048',
            'employee_gender'   => 'required',
            'employee_skills'   => 'required',
        ]);

        $employeePhoto = $request -> file('employee_photo');

        if($employeePhoto){

            $employeeData = Employee::findOrFail($id);

            $image = $request->file('employee_photo');
            $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
            $save_path = "upload/images/employee/";
            if (!file_exists($save_path)) {
                mkdir($save_path, 666, true);
            }
            Image::make($image)->resize(150,150)->save( $save_path.$name_gen);
            $save_url = 'upload/images/employee/'.$name_gen;

            //delete old photo
            $old_image = $employeeData->employee_photo;
            unlink($old_image);

            $employeeData->employee_name = $request->employee_name;
            $employeeData->employee_email = $request->employee_email;
            $employeeData->employee_photo = $save_url;
            $employeeData->employee_gender = $request->employee_gender;
            $employeeData->employee_skills = json_encode($request->employee_skills);
            $employeeData->update();
            return redirect()-> route('employee.index')->with("success",'Employee Data Updated Successful with Image');
        }else{
            $employeeData = Employee::findOrFail($id);
            $employeeData->employee_name = $request->employee_name;
            $employeeData->employee_email = $request->employee_email;
            $employeeData->employee_gender = $request->employee_gender;
            $employeeData->employee_skills = json_encode($request->employee_skills);
            $employeeData->update();
            return redirect()-> route('employee.index') -> with("success",'Employee Data Updated Successful');
        }

    }
    /**
     *  delete employee data
     */
    public function employeeDelete($id)
    {
        $employee_data = Employee::findOrFail($id);
        unlink($employee_data->employee_photo);
        Employee::findOrFail($id)->delete();

        return redirect()->back()->with('success', 'Employee Data Deleted Successful');
    }


    //end
}
