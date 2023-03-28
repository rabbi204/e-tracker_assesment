@extends('backend.admin_master')
@section('backend_content')
<div class="row">
    <div class="col-lg-12 col-md-12">
        <a href="{{ route('employee.create') }}" class="btn btn-primary btn-sm">Add New Employee</a><br><br>
        <div class="card mb-4">
            <!--------- Success Message Show--------->
            @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>{{ session('success') }}</strong>
                <button class="close" data-dismiss="alert" aria-label="Close">&times;</button>
            </div>
            @endif


            <div class="table-responsive">
                <table class="table table-hover px-3 py-2" id="myTable">
                    <thead>
                        <tr>
                            <th scope="col" style="width: 10%">#</th>
                            <th scope="col" style="width: 10%">Employee Photo</th>
                            <th scope="col" style="width: 10%">Name</th>
                            <th scope="col" style="width: 20%">Email</th>
                            <th scope="col" style="width: 10%">Gender</th>
                            <th scope="col" style="width: 20%">Skills</th>
                            <th scope="col" style="width: 20%">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    
                        @foreach ($all_data as $data)
                            <tr>
                                <th scope="row">{{ $loop->index+1; }}</th>
                                <td>
                                    <img style="width:80px; object-fit:cover; height:50px; width:50px;" class="rounded-circle" src="{{ (!empty($data->employee_photo)) ? url($data->employee_photo) : url('upload/no_image.jpg') }}" alt="">
                                </td>
                                <td>{{ $data->employee_name }}</td>
                                <td>{{ $data->employee_email }}</td>
                                <td>{{ $data->employee_gender }}</td>
                                <td>
                                    @php
                                        $skills = json_decode($data->employee_skills);
                                    @endphp
                                    @foreach($skills as $skill)
                                        <span class="badge badge-primary">{{ $skill }}</span>
                                    @endforeach
                                </td>
                                <td>
                                    <a href="{{ route('employee.edit', $data->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                    <a href="{{ route('employee.delete', $data->id) }}" class="btn btn-danger btn-sm">Delete</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>



        </div>
    </div>
</div>

@endsection
