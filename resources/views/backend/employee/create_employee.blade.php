@extends('backend.admin_master')
@section('backend_content')
<div class="row">
    <div class="col-lg-8 col-md-8 col-sm-12">
        <!-- Form Basic -->
        <div class="card mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Create New Employee</h6>
            </div>
            <!------ Form Error Message Show-------->
            @if($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>{{ $errors->first() }}</strong>
                <button class="close" data-dismiss="alert" aria-label="close">&times;</button>
                </div>
            @endif
            <div class="card-body">

                <form action="{{ route('employee.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group row">
                        <label for="employeeName" class="col-sm-2 col-form-label">Employee Name: </label>
                        <div class="col-sm-10">
                            <input type="text" name="employee_name" class="form-control" id="employeeName">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="employeeEmail" class="col-sm-2 col-form-label">Employee Email: </label>
                        <div class="col-sm-10">
                            <input type="email" name="employee_email" class="form-control" id="employeeEmail">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="employeePhoto" class="col-sm-2 col-form-label">Employee Photo: </label>
                        <div class="col-sm-10">
                          <input type="file" name="employee_photo" class="form-control" id="employeePhoto">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="employeeEmail" class="col-sm-2 col-form-label">Employee Gender: </label>
                        <div class="col-sm-10">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="employee_gender" id="inlineRadio1" value="Male">
                                <label class="form-check-label" for="inlineRadio1">Male</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="employee_gender" id="inlineRadio2" value="Female">
                                <label class="form-check-label" for="inlineRadio2">Female</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="employeeEmail" class="col-sm-2 col-form-label">Employee Skills: </label>
                        <div class="col-sm-10">
                            @foreach($categories as $category)
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" name="employee_skills[]" type="checkbox" id="inlineCheckbox_{{ $loop->index+1 }}" value="{{ $category->category_name }}">
                                <label class="form-check-label" for="inlineCheckbox_{{ $loop->index+1 }}">{{ $category->category_name }}</label>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Save Info</button>
                  </form>
            </div>
        </div>
    </div>
</div>

@endsection