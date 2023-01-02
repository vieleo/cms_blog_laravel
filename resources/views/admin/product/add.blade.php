@extends('admin.layouts.layout')

@section('content')
<?php //Hiển thị thông báo thành công?>

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


    <h2>Create Category</h2>
    <form action="/admin/add-category" method="post">
        @csrf
        <div class="form-group">
          <label for="name">Name:</label>
          <input type="text" class="form-control" name="name" id="name">
        </div>
        <div class="form-group">
          <label for="description">Description:</label>
          <textarea class="form-control" rows="5" name="description" id="description"></textarea>
        </div></br>
        <button type="submit" class="btn btn-primary">Create</button>
    </form>
@endsection
