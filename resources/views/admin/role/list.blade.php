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
    <h2>{{ trans('messages.user_manager') }}</h2>
    <a class="btn btn-primary" href="/admin/add-user">{{ trans('messages.create_new_user') }}</a>
    <p>Number of orders: {{ count($total_user) }}</p>

    </div>
    <table class="table table-bordered" id="table">
        <tr style="text-align: center;">
            <th>{{ trans('messages.stt') }}</th>
            <th>{{ trans('messages.user_name') }}</th>
            <th>Email</th>
            <th>{{ trans('messages.role') }}</th>
            @if (Auth::user()->role == 'admin')
                <th width="280px">{{ trans('messages.action') }}</th>
            @endif

        </tr>
        @foreach ($users as $items)
        <tr style="text-align: center;">
            <td>{{ $items->id }}</td>
            <td>{{ $items->name }}</td>
            <td>{{ $items->email }}</td>
            <td style="text-align:center">
                <button class="btn btn-outline-warning">{{ $items->role }}</button>
            </td>
            @if (Auth::user()->role == 'admin')
                <td style="text-align: center;">
                    <a class="btn btn-primary" href="/admin/edit-user/{{ $items->id}}">{{ trans('messages.edit') }}</a>
                    <a class="btn btn-danger show_confirm" href="/admin/delete-user/{{ $items->id}}" onclick="return confirm('You Sure Want Delete?')">{{ trans('messages.delete') }}</a>
                </td>
            @endif
        </tr>
        @endforeach
    </table>
    <div class="paginate">
        {{ $users->links() }}
    </div>
@endsection
