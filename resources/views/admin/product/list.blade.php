@extends('admin.layouts.layout')

@section('content')

    <div class="form-group">
    <h2>{{ trans('messages.list_product') }}</h2>
    <a class="btn btn-primary" href="/admin/add-product">{{ trans('messages.add_product') }}</a>
    </div>
    <p>Number of users: {{ count($product) }}</p>
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
                    <a class="btn btn-warning" href="/admin/show-product/{{ $items->id}}">{{ trans('messages.detail') }}</a>
                    <a class="btn btn-primary" href="/admin/edit-product/{{ $items->id}}">{{ trans('messages.edit') }}</a>
                    <a class="btn btn-danger show_confirm" href="/admin/delete-product/{{ $items->id}}" onclick="return confirm('You Sure Want Delete?')">{{ trans('messages.delete') }}</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="paginate">
        {{ $product->links() }}
    </div>
@endsection
