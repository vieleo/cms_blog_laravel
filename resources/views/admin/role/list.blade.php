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
    <h2>Users Managenment</h2>
    <a class="btn btn-primary" href="/admin/add-category">Create new user</a>
    </div>

    <p>Number of users: {{ count($users) }}</p>

    <table class="table table-bordered" id="table">
        <tr style="text-align: center;">
            <th>ID</th>
            <th>User Name</th>
            <th>Email</th>
            <th>Roles</th>
            <th width="280px">{{ trans('messages.action') }}</th>
        </tr>
        {{-- @dd($users); --}}
        @foreach ($users as $items)
        <tr>
            <td>{{ $items->id }}</td>
            <td>{{ $items->name }}</td>
            <td>{{ $items->email }}</td>
            <td style="text-align:center">
                <button class="btn btn-outline-warning">{{ $items->roles->role }}</button>

            </td>
            <td style="text-align: center;">
                <a class="btn btn-primary" href="/admin/edit-user/{{ $items->id}}">Sửa quyền</a>
                <a class="btn btn-danger show_confirm" href="/admin/delete-user/{{ $items->id}}" onclick="return confirm('You Sure Want Delete?')">{{ trans('messages.delete') }}</a>
            </td>
        </tr>
        @endforeach
    </table>
    <div class="paginate">
        {{ $users->links() }}
    </div>
@endsection
