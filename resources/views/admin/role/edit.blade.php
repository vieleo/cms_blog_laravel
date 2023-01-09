@extends('admin.layouts.layout')

@section('content')
    <h2>Edit Role</h2>
    <div class="form-group">
        <label for=""style="font-wight:300">{{ trans('messages.note') }}: </label> <label style="color: red">(*)</label><label for="">{{ trans('messages.note_message') }}</label>
     </div>
    <form action="/admin/update-user/{{ $users->id}}" method="post">
        @csrf
        <div class="form-group">
          <label for="name">Name</label>
          <input type="text" class="form-control" name="name" value="{{ $users->name }}">
        </div>
        <div class="form-group">
          <label for="email">Email</label>
          <input type="text" class="form-control" name="email" value="{{ $users->email }}">
        </div></br>
        <div class="form-group">
            <label for="role">Role</label>
            <select class="form-select" name="role" id="role">
                <option value="Admin">Admin</option>
                <option value="User">User</option>
                <option value="Manager" selected>Manager</option>
            </select>
          </div></br>
        <button type="submit" class="btn btn-primary">{{ trans('messages.update') }}</button>
    </form>
@endsection
