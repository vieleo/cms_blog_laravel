@extends('admin.layouts.layout')

@section('content')
<div>
    <a class="btn btn-info" href="/admin/list-product/">BACK</a>
</div>

    <h2>{{ trans('messages.detail_product') }}</h2>
    <table class="table table-bordered" >
        <tr>
            <th>{{ trans('messages.stt') }}</th>
            <td>{{ $products->id }}</td>
        </tr>
        <tr>
            <th>{{ trans('messages.name_product') }}</th>
            <td>{{ $products->name }}</td>
        </tr>
        <tr>
            <th>{{ trans('messages.category') }}</th>
            <td>{{ $products->categories->name }}</td>
        </tr>
        <tr>
            <th>{{ trans('messages.quantity') }}</th>
            <td>
                @if ($products->quantity > 0)
                    {{ $products->quantity }}
                @else
                    <p style="color:red"> Hết hàng </p>
                @endif

            </td>
        </tr>
        <tr>
            <th>{{ trans('messages.price_old') }} (VNĐ)</th>
            <td>{{ number_format($products->price_old,0,'.','.') }}</td>
        </tr>
        <tr>
            <th>{{ trans('messages.price_new') }} (VNĐ)</th>
            <td>{{ number_format($products->price_new,0,'.','.') }}</td>
        </tr>
        <tr>
            <th>{{ trans('messages.description') }}</th>
            <td>{!! $products->description !!}</td>
        </tr>
        <tr>
            <th>{{ trans('messages.related_images') }}</th>
            <td>
                @foreach ($products->images as $img)
                     <img class="myImages" id="myImg" src="{{ asset($img->link) }}" class="card-img-top" alt="{{ $products->name }}" style="width:250px; height:200px">
                @endforeach
            </td>
        </tr>
        <tr>
            <th>{{ trans('messages.created_at') }}</th>
            <td>{{ $products->created_at }}</td>
        </tr>
        <tr>
            <th>{{ trans('messages.updated_at') }}</th>
            <td>{{ $products->updated_at }}</td>
        </tr>
    </table>
@endsection
