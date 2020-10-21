@extends('backend.layout.index')
@section('title')
    @lang('title.order.index') - @lang('app.app_title')
@endsection
@section('main')
    <div class="content">

        <!-- Start Content-->
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <h4 class="page-title">@lang('title.order.index')</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb p-0 m-0">
                                <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Trang chủ</a></li>
                                <li class="breadcrumb-item active">@lang('title.order.index')</li>
                            </ol>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            @if(session('notice'))
                <div class="alert alert-success text-left">
                    {{session('notice')}}
                </div>
            @endif

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body table-responsive">
                            <table id="datatable" class="table table-striped table-bordered "
                                   style="border-collapse: collapse; border-spacing: 0; width: 100%;">

                                <thead>
                                <tr class="text-center">
                                    <th>Mã đơn</th>
                                    <th>Khách hàng</th>
                                    <th>Sản phẩm</th>
                                    <th>Tổng tiền</th>
                                    <th>Ngày đặt</th>
                                    <th>Trạng thái</th>
                                </tr>
                                </thead>

                                <tbody>
                                @foreach($order as $ct)
                                    <tr class="text-center">
                                        <td>{{$ct->id}}</td>
                                        <td>
                                            <a href="{{route('detail.index', ['id' => $ct->id])}}">
                                                <span class="text-danger font-weight-bold">{{$ct->name}}</span>
                                            </a>
                                        </td>
                                        <td class="text-left">
                                            @foreach($detail as $dt)
                                                @if($dt->order_id == $ct->id)
                                                    @foreach($product as $pd)
                                                        @if($dt->product_id == $pd->id)
                                                            {{'- '}} {{\Illuminate\Support\Str::limit($pd->name, 100, '...')}} <br>
                                                        @endif
                                                    @endforeach
                                                @endif
                                            @endforeach
                                        </td>
                                        <td>{{number_format($ct['cost_total'],0,',','.')}} đ</td>
                                        <td>{{Carbon\Carbon::parse($ct->created_at)->format('h:m:s d/m/Y')}}</td>
                                        @if($ct['status'] == 1)
                                            <td class="text-danger"><i class="ion ion-ios-alert text-danger"></i> Chưa chốt
                                                đơn
                                            </td>
                                        @endif
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end row -->

        </div>
    </div>
@endsection
