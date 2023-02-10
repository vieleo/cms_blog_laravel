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
    <h2>{{ trans('messages.list_product') }}</h2>
    <a class="btn btn-primary" href="/admin/add-product">{{ trans('messages.add_product') }}</a>
    </div>
    <p>Number of product: {{ count($product) }}</p>
    <table class="table table-bordered" id="example">
        <thead>
            <tr style="text-align: center;">
                <th>{{ trans('messages.stt') }}</th>
                <th>{{ trans('messages.name_product') }}</th>
                <th>{{ trans('messages.category') }}</th>

                <th width="280px">{{ trans('messages.action') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($product as $items)
            <tr>
                <td style="text-align: center;">{{ $items->id }}</td>
                <td>{{ $items->name }}</td>
                <td>{{ $items->categories->name }}</td>
                <td  style="text-align: center;">
                    <a class="btn btn-warning" href="/admin/show-product/{{ $items->id}}"><i class="fa fa-eye"></i></a>
                    <a class="btn btn-primary" href="/admin/edit-product/{{ $items->id}}"><i class="fa fa-pen"></i></a>
                    <a class="btn btn-danger show_confirm" href="/admin/delete-product/{{ $items->id}}" onclick="return confirm('You Sure Want Delete?')"><i class="fa fa-trash"></i></a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="paginate">
        {{ $product->links() }}
    </div>
@endsection
