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
    <h2>Create User</h2>
    <div class="form-group">
        <label for=""style="font-wight:300">{{ trans('messages.note') }}: </label> <label style="color: red">(*)</label><label for="">{{ trans('messages.note_message') }}</label>
     </div>
    <form action="/admin/add-user" method="post" style="width:60%">
        @csrf
        <div class="form-group">
          <label for="name">Name</label> <label style="color: red">(*)</label>
          <input type="text" class="form-control" name="name" value="">
        </div>
        <div class="form-group">
          <label for="email">Email</label> <label style="color: red">(*)</label>
          <input type="text" class="form-control" name="email" value="">
        </div></br>
        <div class="form-group">
            <label for="Phone">Phone</label> <label style="color: red">(*)</label>
            <input type="text" class="form-control" name="phone" value="">
        </div></br>
        <div class="form-group">
            <label for="Address">Address</label> <label style="color: red">(*)</label>
            <input type="text" class="form-control" name="address" value="">
        </div></br>
        <div class="form-group">
            <label for="Birth Date">Birth Date</label></br> <label style="color: red">(*)</label>
            <input type="datetime-local" class="form-control" id="birthdaytime" name="birthdaytime">
        </div></br>
        <div class="form-group">
            <label for="Gender">Gender</label></br> <label style="color: red">(*)</label>
            <input type="radio" name="gender" value="1" checked>Nam
            <input type="radio" name="gender" value="0">Nữ
        </div></br>
        <div class="form-group"> <label style="color: red">(*)</label>
            <label for="Password">Password</label>
            <input id="password" class="form-control"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />
        </div></br>
        <div class="form-group"> <label style="color: red">(*)</label>
            <label for="Confirm Password">Confirm Password</label>
            <input id="password_confirmation" class="form-control"
                            type="password"
                            name="password_confirmation" required />
        </div></br>

        <button type="submit" class="btn btn-primary">{{ trans('messages.create') }}</button>
    </form>
@endsection
