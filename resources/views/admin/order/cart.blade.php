@extends('admin.layouts.layout')

@section('content')

    <div class="form-group">
    <h2>{{ trans('messages.list_order') }}</h2>
    </div>
    <p>Total Orders: {{ count($total_order) }}</p>
    <h3>Tổng doanh thu: {{ number_format($total_order->sum('subtotal',0,'.','.')) }} VNĐ</h3>
    <table class="table table-bordered" id="example">
        <thead>
            <tr style="text-align: center;">
                <th>{{ trans('messages.stt') }}</th>
                <th>{{ trans('messages.user_name') }}</th>
                <th>{{ trans('messages.payment_method') }}</th>
                <th>{{ trans('messages.status_payment_method') }}</th>
                <th>{{ trans('messages.created_at') }}</th>
                <th>{{ trans('messages.subtotal') }}</th>
                <th>{{ trans('messages.status') }}</th>
                <th width="280px">{{ trans('messages.action') }}</th>
            </tr>
        </thead>
        <tbody style="text-align:center">

            @foreach ($order as $orders)
                <tr>
                    <td style="text-align: center;">{{ $orders->id }}</td>
                    <td>{{ $orders->user->name }}</td>

                    @if ($orders->payment_method == 1)
                        <td>{{ trans('messages.cod') }}</td>
                    @elseif ($orders->payment_method == 0)
                        <td>{{ trans('messages.bank_transfer') }}</td>
                    @endif
                    <td>{{ trans('messages.Paid') }}</td>
                    <td>{{ $orders->created_at }}</td>
                    <td>{{ number_format($orders->subtotal,0,'.','.') }} VNĐ</td>
                    <td>
                        @if ($orders->status == 1)
                             <a class="btn btn-warning" style="border-radius: 100%;">{{ trans('messages.new_order') }}</a>
                        @elseif ($orders->status == 2)
                             <a class="btn btn-success" style="border-radius: 100%;">{{ trans('messages.delivering') }}</a>
                        @elseif ($orders->status == 3)
                             <a class="btn btn-danger" style="border-radius: 100%;">{{ trans('messages.delivered') }}</a>
                        @endif
                    </td>
                    <td  style="text-align: center;">
                        @if ($orders->status == 1)

                            <a class="btn btn-warning" href="">{{ trans('messages.waiting_for_progressing') }}</a>

                        @elseif ($orders->status == 2 || $orders->status == 3 )

                            <a class="btn btn-danger" href="">{{ trans('messages.successful_processing') }}</a>

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
