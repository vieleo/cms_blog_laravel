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
    <h2>{{ trans('messages.create_new_user') }}</h2>
    <div class="form-group">
        <label for=""style="font-wight:300">{{ trans('messages.note') }}: </label> <label style="color: red">(*)</label><label for="">{{ trans('messages.note_message') }}</label>
     </div>
    <form action="/admin/add-user" method="post" style="width:60%">
        @csrf
        <div class="form-group">
          <label for="name">{{ trans('messages.name_user') }}</label> <label style="color: red">(*)</label>
          <input type="text" class="form-control" name="name" value="">
        </div>
        <div class="form-group">
          <label for="email">{{ trans('messages.email') }}</label> <label style="color: red">(*)</label>
          <input type="text" class="form-control" name="email" value="">
        </div></br>
        <div class="form-group">
            <label for="Phone">{{ trans('messages.phone') }}</label> <label style="color: red">(*)</label>
            <input type="text" class="form-control" name="phone" value="">
        </div></br>
        <div class="form-group">
            <label for="Address">{{ trans('messages.address') }}</label> <label style="color: red">(*)</label>
            <input type="text" class="form-control" name="address" value="">
        </div></br>
        <div class="form-group">
            <label for="Gender">{{ trans('messages.gender') }}</label></br>
            <input type="radio" name="gender" value="1" checked>{{ trans('messages.male') }}
            <input type="radio" name="gender" value="0">{{ trans('messages.female') }}
        </div></br>
        <div class="form-group"> <label style="color: red">(*)</label>
            <label for="Password">{{ trans('messages.password') }}</label>
            <input id="password" class="form-control"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />
        </div></br>
        <div class="form-group"> <label style="color: red">(*)</label>
            <label for="Confirm Password">{{ trans('messages.confirm_password') }}</label>
            <input id="password_confirmation" class="form-control"
                            type="password"
                            name="password_confirmation" required />
        </div></br>

        <button type="submit" class="btn btn-primary">{{ trans('messages.create') }}</button>
    </form>
@endsection
