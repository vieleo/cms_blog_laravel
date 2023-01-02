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

{{-- validation --}}
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
{{-- endvalidation --}}

    <h2>Create Product</h2>
    <form action="/admin/add-product" method="post" style="width: 75%"  enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="Product Name">Product Name</label>
            <input type="text" name="name" class="form-control"  placeholder="Product Name" >
        </div></br>
        <label for="Product Name">Image:</label>
        <br>
        <input type="file" class="form-control" name="photos[]" multiple />
        <br><br>

        {{-- <div class="form-group">
          <label for="name">Name:</label>
          <input type="text" class="form-control" name="name" id="name">
        </div>
        <div class="form-group">
          <label for="name">Category:</label>
            <select class="form-select" aria-label="Default select example">
                <option selected>Open this select menu</option>
                <option value="1">One</option>
                <option value="2">Two</option>
                <option value="3">Three</option>
              </select>
        </div>
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" class="form-control" name="name" id="name">
          </div>
        <div class="form-group">
          <label for="description">Description:</label>
          <textarea class="form-control" rows="5" name="description" id="description"></textarea>
        </div></br> --}}
        <button type="submit" class="btn btn-primary">Create</button>
    </form>
@endsection
