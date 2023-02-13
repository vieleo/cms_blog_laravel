@extends('admin.layouts.layout')

@section('content')

    <!-- Sale & Revenue Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="row g-4">
                    <div class="col-sm-6 col-xl-3">
                        <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                            <i class="fa fa-chart-line fa-3x text-primary"></i>
                            <div class="ms-3">
                                <p class="mb-2">{{ trans('messages.total_users') }}</p>
                                <h6 class="mb-0">{{ $user }}</h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xl-3">
                        <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                            <i class="fa fa-chart-bar fa-3x text-primary"></i>
                            <div class="ms-3">
                                <p class="mb-2">{{ trans('messages.total_products') }}</p>
                                <h6 class="mb-0">{{ $products }}</h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xl-3">
                        <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                            <i class="fa fa-chart-area fa-3x text-primary"></i>
                            <div class="ms-3">
                                <p class="mb-2">{{ trans('messages.total_order') }}</p>
                                <h6 class="mb-0">{{ count($total_order) }}</h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xl-3">
                        <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                            <i class="fa fa-chart-pie fa-3x text-primary"></i>
                            <div class="ms-3">
                                <p class="mb-2">{{ trans('messages.total_revenue') }}</p>
                                <h6 class="mb-0">{{ number_format($total,0,'.','.') }} VNĐ</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Sale & Revenue End -->


            <!-- Recent Sales Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="bg-light text-center rounded p-4">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <h6 class="mb-0">{{ trans('messages.recent_orders') }}</h6>
                        <a href="">Show All</a>
                    </div>
                    <div class="table-responsive">
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
                    </div>
                </div>
            </div>
            <!-- Recent Sales End -->

@endsection

