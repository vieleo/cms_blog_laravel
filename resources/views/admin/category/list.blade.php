@extends('admin.layouts.layout')

@section('content')
    @if ( Session::has('success') )
        <div class="alert alert-success alert-dismissible" role="alert">
            <strong>{{ Session::get('success') }}</strong>
        </div>
    @endif

    <?php //Hiển thị thông báo lỗi?>
    @if ( Session::has('error') )
        <div class="alert alert-danger alert-dismissible" role="alert">
            <strong>{{ Session::get('error') }}</strong>
        </div>
    @endif
    <div class="form-group">
    <h2>List Category</h2>
    <a class="btn btn-primary" href="/admin/add-category">ADD CATEGORY</a>
    </div>
    <table class="table table-bordered">
        <tr>
            <th>S.No</th>
            <th>Name</th>
            <th>Description</th>
            <th width="280px">Action</th>
        </tr>
        @foreach ($categories as $category)
        <tr>
            <td>{{ $category->id }}</td>
            <td>{{ $category->name }}</td>
            <td>{{ $category->description }}</td>
            <td>
                <a class="btn btn-primary" href="/admin/edit-category/{{ $category->id}}">Edit</a>
                <a class="btn btn-danger show_confirm" href="/admin/delete-category/{{ $category->id}}" onclick="return confirm('You Sure Want Delete?')">Delete</a>
            </td>
        </tr>
        @endforeach
    </table>
@endsection
