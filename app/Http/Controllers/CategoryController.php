<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    //show category 
    public function index()
    {
        $all_data = Category::latest()->get();
        return view('backend.category.index', compact('all_data'));
    }
    //create category
    public function createCategory()
    {
        return view('backend.category.create_category');
    }
    /**
     * category store
     */
    public function categoryStore(Request $request)
    {
        $validateData = $request->validate([
            'category_name'  => 'required',
        ]);

        $categoryData = new Category();

        $categoryData->category_name = $request->category_name;
        $categoryData->save();
        return redirect()->route('category.index')->with('success', 'Category Added Successful');
    }
    /***
     *  Category data edit
     */
    public function editCategoryData($id)
    {
        $edit_data = Category::findOrFail($id);
        return view('backend.category.edit_category', compact('edit_data'));
    }

    /**
     *  Category data update
     */
    public function updateCategoryData(Request $request, $id)
    {
        $validateData = $request->validate([
            'category_name'   => 'required'
        ]);
        $categoryData = Category::findOrFail($id);
        $categoryData->category_name = $request->category_name;
        $categoryData->update();
        return redirect()-> route('category.index') -> with("success",'Category Data Updated Successful');
    }
    /**
     *  Category data delete
     */
    public function categoryDataDelete($id)
    {
        Category::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Category Data Deleted Successful');
    }


    //end
}
