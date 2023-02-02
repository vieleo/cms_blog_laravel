@extends('admin.layouts.layout')

@section('content')
    <h2>Edit Role</h2>
    <div class="form-group">
        <label for=""style="font-wight:300">{{ trans('messages.note') }}: </label> <label style="color: red">(*)</label><label for="">{{ trans('messages.note_message') }}</label>
     </div>
    <form action="/admin/update-user/{{ $users->id}}" method="post">
        @csrf
        <div class="form-group">
          <label for="name">Name</label> <label style="color: red">(*)</label>
          <input type="text" class="form-control" name="name" value="{{ $users->name }}">
        </div>
        <div class="form-group">
          <label for="email">Email</label> <label style="color: red">(*)</label>
          <input type="text" class="form-control" name="email" value="{{ $users->email }}">
        </div></br>
        <div class="form-group">
            <label for="Phone">Phone</label> <label style="color: red">(*)</label>
            <input type="text" class="form-control" name="phone" value="{{ $users->profile->phone }}">
        </div></br>
        <div class="form-group">
            <label for="Address">Address</label> <label style="color: red">(*)</label>
            <input type="text" class="form-control" name="address" value="{{ $users->profile->address }}">
        </div></br>
        <div class="form-group">
            <label for="Gender">Gender</label></br> <label style="color: red">(*)</label>
            <input type="radio" name="gender" value="1" {{ $users->profile->gender == '1' ? 'checked="checked"' : '' }}>Nam
            <input type="radio" name="gender" value="0" {{ $users->profile->gender == '0' ? 'checked="checked"' : '' }}>Nữ
        </div></br>
        <div class="form-group">
            <label for="role">Role</label> <label style="color: red">(*)</label>
            <select class="form-select" name="role" id="role">
                <option value="admin" {{ $users->role == 'Admin' ? 'selected="selected"' : '' }}>Admin</option>
                <option value="User" {{ $users->role == 'User' ? 'selected="selected"' : '' }}>User</option>
                <option value="Manager" {{ $users->role == 'Manager' ? 'selected="selected"' : '' }}>Manager</option>
            </select>
          </div></br>
        <button type="submit" class="btn btn-primary">{{ trans('messages.update') }}</button>
    </form>
@endsection
