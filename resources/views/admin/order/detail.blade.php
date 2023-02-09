@extends('admin.layouts.layout')

@section('content')
<div>
    <h2>Chi tiết đơn hàng</h2>
    <a class="btn btn-info" href="/admin/cart/">BACK</a>

</div>

    {{-- <div class="form-group">
    <h2>Chi tiết đơn hàng</h2>
    </div> --}}
{{-- @dd($user) --}}
    <div class="form-group">
        <h4 style="text-align: center">THÔNG TIN VẬN CHUYỂN HÀNG</h4>
    </div>
    <table class="table table-bordered" >
        <tr>
            <th>Thông tin người đặt hàng</th>
            <td>{{ $user->name }}</td>
        </tr>
        <tr>
            <th>Ngày đặt hàng</th>
            <td>{{ $order->created_at }}</td>
        </tr>
        <tr>
            <th>Số điện thoại</th>
            <td>{{ $user->profile->phone }}</td>
        </tr>
        <tr>
            <th>Địa chỉ</th>
            <td>{{ $user->profile->address }}</td>
        </tr>
        <tr>
            <th>Email</th>
            <td>{{ $user->email }}</td>
        </tr>
        <tr>
            <th>Ghi chú</th>
            <td>Giúp tôi giao hàng sớm nhất!</td>
        </tr>
    </table>





    <div class="form-group">
        <h4 style="text-align: center">LIỆT KÊ CHI TIẾT HOÁ ĐƠN</h4>
    </div>
    <table class="table table-bordered" id="example">
        <thead>
            <tr style="text-align: center;">
                <th>{{ trans('messages.stt') }}</th>
                <th>Mã đơn hàng</th>
                <th>Tên sản phẩm</th>
                <th>Giá</th>
                <th>Số lượng mua</th>
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
                <td>Tổng tiền: {{ number_format($order->subtotal,0,'.','.') }} VNĐ</td>

            </tr>
        </tbody>
    </table>

    <form action="/admin/update-cart/{{ $order->id }}" method="post" style="width: 20%"  >
        @csrf
        <div class="form-group">
            <label>Tình trạng đơn hàng</label>
              <select class="form-select" name="status" id="status" aria-label="Default select example">
                        <option value="1" {{ $order->status == '1' ? 'selected="selected"' : '' }}>Đơn hàng mới</option>
                        <option value="2" {{ $order->status == '2' ? 'selected="selected"' : '' }}>Đang giao</option>
                        <option value="3" {{ $order->status == '3' ? 'selected="selected"' : '' }}>Đã giao</option>
                </select>
          </div><br>
        <button type="submit" class="btn btn-primary">{{ trans('messages.update') }}</button>
    </form>


@endsection
