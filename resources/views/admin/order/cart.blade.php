@extends('admin.layouts.layout')

@section('content')

    <div class="form-group">
    <h2>Danh sách đơn hàng</h2>
    </div>
    <table class="table table-bordered" id="example">
        <thead>
            <tr style="text-align: center;">
                <th>{{ trans('messages.stt') }}</th>
                <th>Khách Hàng</th>
                <th>{{ trans('messages.status') }}</th>
                <th>Thanh Toán</th>
                <th>Ngày Tạo</th>
                <th>Tổng Tiền</th>
                <th width="280px">{{ trans('messages.action') }}</th>
            </tr>
        </thead>
        <tbody style="text-align:center">
            <tr>
                <td style="text-align: center;">1</td>
                <td>Việt Leo</td>
                <td>Đơn hàng mới</td>
                <td>Đã thanh toán</td>
                <td>7/2/2023</td>
                <td>379.000đ</td>
                <td  style="text-align: center;">
                    <a class="btn btn-warning" href="">Chờ xử lý</a>
                    <a class="btn btn-success" href="/admin/show-detail-cart/">Chi Tiết</a>
                </td>
            </tr>
        </tbody>
    </table>

@endsection
