@extends('admin.layouts.layout')

@section('content')
<div>
    <h2>{{ trans('messages.order_details') }}</h2>
    <a class="btn btn-info" href="/admin/cart/">BACK</a>

</div>

    {{-- <div class="form-group">
    <h2>Chi tiết đơn hàng</h2>
    </div> --}}
{{-- @dd($user) --}}
    <div class="form-group">
        <h4 style="text-align: center">{{ trans('messages.SHIPPING_INFORMATION') }}</h4>
    </div>
    <table class="table table-bordered" >
        <tr>
            <th>{{ trans('messages.customer_name') }}</th>
            <td>{{ $user->name }}</td>
        </tr>
        <tr>
            <th>{{ trans('messages.order_date') }}</th>
            <td>{{ $order->created_at }}</td>
        </tr>
        <tr>
            <th>{{ trans('messages.phone') }}</th>
            <td>{{ $user->profile->phone }}</td>
        </tr>
        <tr>
            <th>{{ trans('messages.address') }}</th>
            <td>{{ $user->profile->address }}</td>
        </tr>
        <tr>
            <th>{{ trans('messages.email') }}</th>
            <td>{{ $user->email }}</td>
        </tr>
        <tr>
            <th>{{ trans('messages.note') }}</th>
            <td>Giúp tôi giao hàng sớm nhất!</td>
        </tr>
    </table>





    <div class="form-group">
        <h4 style="text-align: center">{{ trans('messages.LIST_DETAILS_OF_BILLINGS') }}</h4>
    </div>
    <table class="table table-bordered" id="example">
        <thead>
            <tr style="text-align: center;">
                <th>{{ trans('messages.stt') }}</th>
                <th>{{ trans('messages.invoice_code') }}</th>
                <th>{{ trans('messages.name_product') }}</th>
                <th>{{ trans('messages.price') }}</th>
                <th>{{ trans('messages.quantity') }}</th>
                <th></th>
            </tr>
        </thead>
        <tbody style="text-align:center">
            @foreach ($detail as $details)
                <tr>
                    <td style="text-align: center;">{{ $details->id }}</td>
                    <td>{{ $details->product_id }}</td>
                    <td>{{ $details->name_product }}</td>
                    <td>{{ number_format($details->price,0,'.','.') }} VNĐ</td>
                    <td>{{ $details->quantity }}</td>
                    <td></td>
                </tr>

            @endforeach
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td>{{ trans('messages.subtotal') }}: {{ number_format($order->subtotal,0,'.','.') }} VNĐ</td>

            </tr>
        </tbody>
    </table>

    <form action="/admin/update-cart/{{ $order->id }}" method="post" style="width: 20%"  >
        @csrf
        <div class="form-group">
            <label>{{ trans('messages.status') }}</label>
              <select class="form-select" name="status" id="status" aria-label="Default select example">
                        <option value="1" {{ $order->status == '1' ? 'selected="selected"' : '' }}>{{ trans('messages.new_order') }}</option>
                        <option value="2" {{ $order->status == '2' ? 'selected="selected"' : '' }}>{{ trans('messages.delivering') }}</option>
                        <option value="3" {{ $order->status == '3' ? 'selected="selected"' : '' }}>{{ trans('messages.delivered') }}</option>
                </select>
          </div><br>
        <button type="submit" class="btn btn-primary">{{ trans('messages.update') }}</button>
    </form>


@endsection
