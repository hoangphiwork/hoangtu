@extends('backend.layout.index')
@section('title')
    @lang('title.order.detail') #{{$order['id']}} - @lang('app.app_title')
@endsection
@section('main')
    <div class="content">

        <!-- Start Content-->
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <h4 class="page-title">Chi tiết đơn hàng</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb p-0 m-0">
                                <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Trang chủ</a></li>
                                @switch($order['status'])
                                    @case(1)
                                        <li class="breadcrumb-item"><a href="{{route('order.index')}}">@lang('title.order.index')</a></li>
                                        @break
                                    @case(2)
                                        <li class="breadcrumb-item"><a href="{{route('order.delivery')}}">@lang('title.order.delivery')</a></li>
                                        @break
                                    @case(3)
                                        <li class="breadcrumb-item"><a href="{{route('order.shipped')}}">@lang('title.order.shipped')</a></li>
                                        @break
                                @endswitch
                                <li class="breadcrumb-item">Đơn hàng #{{$order['id']}}</li>
                            </ol>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            @if(session('notice'))
                <div class="alert alert-success text-center">
                    {{session('notice')}}
                </div>
            @endif

            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <!-- <div class="panel-heading">
                                        <h4>Invoice</h4>
                                    </div> -->
                        <div class="card-body">
                            <div class="clearfix">
                                <h5 class="float-left ml-2">Chi tiết đơn hàng
                                    <strong> #{{Carbon\Carbon::parse($order->created_at)->format('Ymd')}}-{{$order->id}}</strong>
                                </h5>
                                <div class="d-print-none float-right mr-3">
                                    <div class="text-center d-print-none">
                                        <a href="javascript:window.print()" class="btn btn-dark waves-effect waves-light mr-1"><i class="fa fa-print"></i></a>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="float-left mt-4 ml-4">
                                        <p><strong>Khách hàng: </strong> {{$order->name}}</p>
                                        <p class="mt-2"><strong>Số điện thoại: </strong> {{$order->phone}}</p>
                                        <p class="mt-2">
                                            <strong>Địa chỉ: </strong>
                                            <span>
                                            {{$order->customer_address}}
                                        </span>
                                        </p>
                                    </div>
                                    <div class="float-right mt-4 mr-4">
                                        <p><strong>Mã đơn hàng: </strong> #{{$order->id}}</p>
                                        <p class="mt-2"><strong>Ngày đặt: </strong> {{Carbon\Carbon::parse($order->created_at)->format('d-m-Y')}}</p>
                                        @switch($order['status'])
                                            @case(3)
                                                <p class="mt-2"><strong>Ngày giao: </strong> {{Carbon\Carbon::parse($order->updated_at)->format('d-m-Y')}}</p>
                                                @break
                                            @case(4)
                                                <p class="mt-2"><strong>Ngày hủy: </strong> {{Carbon\Carbon::parse($order->updated_at)->format('d-m-Y')}}</p>
                                                @break
                                        @endswitch
                                        <p class="mt-2">
                                            <strong>Trạng thái: </strong>
                                            <span class="badge badge-pink">
                                            @if($order['status'] == 1)
                                                Chờ duyệt
                                            @elseif($order['status'] == 2)
                                                Giao hàng
                                            @elseif($order['status'] == 3)
                                                Đã nhận
                                            @elseif($order['status'] == 4)
                                                Hủy đơn
                                            @endif
                                        </span>
                                        </p>

                                    </div>
                                </div>
                            </div>
                            <div class="mt-3"></div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="table-responsive">
                                        <table class="table mt-4">
                                            <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Ảnh</th>
                                                <th>Tên</th>
                                                <th>Đơn giá</th>
                                                <th>Số lượng</th>
                                                <th>Thành tiền</th>
                                            </tr>
                                            </thead>
                                            <tbody>

                                            <?php $i = 1; ?>
                                            @foreach($detail as $dt)
                                                @foreach($product as $pd)
                                                    @if($dt->product_id == $pd->id)
                                                        <tr class="text-center">
                                                            <td><?php echo $i++; ?></td>
                                                            <td>
                                                                <img width="80rem" src="{{asset('/upload/product/'.$pd['image'])}}">
                                                            </td>
                                                            <td class="text-left">{{$pd->name}}</td>
                                                            <td>{{number_format($pd->price, 0, ',', '.')}} đ</td>
                                                            <td>{{$dt->count}}</td>
                                                            <td>{{number_format($order->cost_total, 0, ',', '.')}} đ</td>
                                                        </tr>
                                                    @endif
                                                @endforeach
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="row" style="border-radius: 0px">
                                <div class="col-md-3 offset-md-9">
                                    <p class="text-right"><b>Tổng thanh toán:</b> {{number_format($order->cost_total,0,',','.')}} đ</p>
                                    <hr>
                                    <h4 class="text-right">{{number_format($order->cost_total,0,',','.')}} đ</h4>
                                </div>
                            </div>

                            @if($order['status'] == 1)
                            <hr class="d-print-none">
                            <div class="text-center d-print-none">
                                <a href="{{route('order.index')}}" class="btn btn-outline-secondary mr-3" role="button">
                                    <i class="fa fa-arrow-left mr-1" aria-hidden="true"></i>
                                    Quay lại
                                </a>
                                <a href="{{route('detail.delivery', ['id' => $order['id']])}}" class="btn btn-outline-success mr-3" role="button">
                                    <i class="fa fa-truck mr-1" aria-hidden="true"></i> Giao hàng
                                </a>
                                <a href="{{route('detail.cancel', ['id' => $order['id']])}}" class="btn btn-outline-danger mr-3" role="button">
                                    <i class="ion ion-md-trash mr-1" aria-hidden="true"></i> Huỷ đơn hàng
                                </a>
                            </div>
                            @elseif($order['status'] == 2)
                            <hr>
                            <div class="text-center d-print-none">
                                <a href="{{route('order.delivery')}}" class="btn btn-outline-secondary mr-3" role="button">
                                    <i class="fa fa-arrow-left" aria-hidden="true"></i>
                                    Quay lại
                                </a>
                                <a href="{{route('detail.delivered', ['id' => $order['id']])}}" class="btn btn-outline-success mr-3" role="button">
                                    <i class="fa fa-truck mr-1" aria-hidden="true"></i> Đã giao hàng
                                </a>
                                <a href="{{route('detail.cancel', ['id' => $order['id']])}}" class="btn btn-outline-danger mr-3" role="button">
                                    <i class="ion ion-md-trash mr-1" aria-hidden="true"></i> Huỷ đơn hàng
                                </a>
                            </div>
                            @endif
                        </div>
                    </div>

                </div>

            </div>
            <!-- end row -->

        </div>
    </div>
@endsection
