@extends('admin.layouts.layout')

@section('content')

    <div class="form-group">
    <h2>Danh sách đơn hàng</h2>
    </div>
    <p>Number of order: {{ count($order) }}</p>
    <table class="table table-bordered" id="example">
        <thead>
            <tr style="text-align: center;">
                <th>{{ trans('messages.stt') }}</th>
                <th>Khách Hàng</th>
                <th>Phương Thứ Thanh Toán</th>
                <th>Ngày Đặt Hàng</th>
                <th>Tổng Tiền</th>
                <th>Tình trạng đơn hàng</th>
                <th width="280px">{{ trans('messages.action') }}</th>
            </tr>
        </thead>
        <tbody style="text-align:center">

            @foreach ($order as $orders)
                <tr>
                    <td style="text-align: center;">{{ $orders->id }}</td>
                    <td>{{ $orders->user->name }}</td>

                    @if ($orders->payment_method == 1)
                        <td>Trả tiền mặt</td>
                    @elseif ($orders->payment_method == 0)
                        <td>Chuyển khoản ngân hàng</td>
                    @endif
                    <td>{{ $orders->created_at }}</td>
                    <td>{{ number_format($orders->subtotal,0,'.','.') }} VNĐ</td>
                    <td>
                        @if ($orders->status == 1)
                             <a class="btn btn-warning" style="border-radius: 100%;">Đơn hàng mới</a>
                        @elseif ($orders->status == 2)
                             <a class="btn btn-success" style="border-radius: 100%;">Đang giao</a>
                        @elseif ($orders->status == 3)
                             <a class="btn btn-danger" style="border-radius: 100%;">Đã giao</a>
                        @endif
                    </td>
                    <td  style="text-align: center;">
                        @if ($orders->status == 1)

                            <a class="btn btn-warning" href="">Chờ xử lý</a>

                        @elseif ($orders->status == 2 || $orders->status == 3 )

                            <a class="btn btn-danger" href="">Đã xử lý</a>

                        @endif

                        <a class="btn btn-success" href="/admin/show-detail-cart/{{ $orders->id}}"><i class="fa fa-eye"></i></a>
                    </td>
                </tr>
            @endforeach

        </tbody>
    </table>
    <div class="paginate">
        {{ $order->links() }}
    </div>

@endsection
