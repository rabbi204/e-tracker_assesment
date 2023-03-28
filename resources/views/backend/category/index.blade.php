@extends('backend.admin_master')
@section('backend_content')
<div class="row">
    <div class="col-lg-8 col-md-8">
        <a href="{{ route('category.create') }}" class="btn btn-primary btn-sm">Add New Category</a><br><br>
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
                            <th scope="col">#</th>
                            <th scope="col">Category Name</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($all_data as $data)
                            <tr>
                                <th scope="row">{{ $loop->index+1; }}</th>
                                <td>{{ $data->category_name }}</td>
                                <td>
                                    <a href="{{ route('category.edit', $data->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                    <a href="{{ route('category.delete', $data->id) }}" class="btn btn-danger btn-sm">Delete</a>
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
