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

    @if (\Session::has('message'))
    <div class="alert alert-success">
        <ul>
            <li>{!! \Session::get('message') !!}</li>
        </ul>
    </div>
    @endif


    <div class="form-group">
    <h2>{{ trans('messages.list_category') }}</h2>
    <a class="btn btn-primary" href="/admin/add-category">{{ trans('messages.add_category') }}</a>
    </div>
    <p>Number of categories: {{ count($total_cate) }}</p>

    <table class="table table-bordered" id="table">
        <tr style="text-align: center;">
            <th>{{ trans('messages.stt') }}</th>
            <th>{{ trans('messages.name_category') }}</th>
            <th>{{ trans('messages.description') }}</th>
            <th width="280px">{{ trans('messages.action') }}</th>
        </tr>
        @foreach ($categories as $category)
        <tr>
            <td>{{ $category->id }}</td>
            <td>{{ $category->name }}</td>
            <td>{!! $category->description !!}</td>
            <td style="text-align: center;">
                <a class="btn btn-primary" href="/admin/edit-category/{{ $category->id}}"><i class="fa fa-pen"></i></a>
                <a class="btn btn-danger show_confirm" href="/admin/delete-category/{{ $category->id}}" onclick="return confirm('You Sure Want Delete?')"><i class="fa fa-trash"></i></a>
            </td>
        </tr>
        @endforeach
    </table>
    <div class="paginate">
        {{ $categories->links() }}
    </div>
@endsection
