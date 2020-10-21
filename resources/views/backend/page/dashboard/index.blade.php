@extends('backend.layout.index')
@section('title')
    @lang('title.dashboard')
@endsection
@section('main')
<div class="content">
        <!-- Start Content-->
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <h4 class="page-title">Hôm nay</h4>

                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row" id="demoload">

                <div class="col-xl-3 col-sm-6">
                    <div class="card bg-secondary">
                        <div class="card-body widget-style-2">
                            <div class="text-white media">
                                <div class="media-body align-self-center">
                                    <h2 class="my-0 text-white"><span data-plugin="counterup">{{$data['order']}}</span></h2>
                                    <p class="mb-0">Đơn chờ duyệt</p>
                                </div>
                                <i class="ion ion-md-paper-plane"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-sm-6">
                    <div class="card bg-info">
                        <div class="card-body widget-style-2">
                            <div class="text-white media">
                                <div class="media-body align-self-center">
                                    <h3 class="my-0 text-white"><span data-plugin="counterup">{{number_format($data['money'])}}</span> đ</h3>
                                    <p class="mb-0">Tổng tiền</p>
                                </div>
                                <i class="ion ion-logo-usd"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-sm-6">
                    <div class="card bg-pink">
                        <div class="card-body widget-style-2">
                            <div class="text-white media">
                                <div class="media-body align-self-center">
                                    <h3 class="my-0 text-white"><span data-plugin="counterup">{{number_format($data['money_receive'])}}</span> đ</h3>
                                    <p class="mb-0">Doanh thu</p>
                                </div>
                                <i class="ion ion-logo-usd"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <h4 class="page-title">Tháng này</h4>

                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>


            <div class="row" id="demoload">

                <div class="col-xl-3 col-sm-6">
                    <div class="card bg-secondary">
                        <div class="card-body widget-style-2">
                            <div class="text-white media">
                                <div class="media-body align-self-center">
                                    <h2 class="my-0 text-white"><span data-plugin="counterup">{{$data['order_month']}}</span></h2>
                                    <p class="mb-0">Đơn thành công</p>
                                </div>
                                <i class="ion ion-md-paper-plane"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-sm-6">
                    <div class="card bg-danger">
                        <div class="card-body widget-style-2">
                            <div class="text-white media">
                                <div class="media-body align-self-center">
                                    <h2 class="my-0 text-white"><span data-plugin="counterup">{{$data['order_month_false']}}</span></h2>
                                    <p class="mb-0">Đơn bị hủy</p>
                                </div>
                                <i class="ion ion-md-close-circle"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-sm-6">
                    <div class="card bg-info">
                        <div class="card-body widget-style-2">
                            <div class="text-white media">
                                <div class="media-body align-self-center">
                                    <h3 class="my-0 text-white"><span data-plugin="counterup">{{number_format($data['money_month'])}}</span> đ</h3>
                                    <p class="mb-0">Tổng tiền</p>
                                </div>
                                <i class="ion ion-logo-usd"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-sm-6">
                    <div class="card bg-pink">
                        <div class="card-body widget-style-2">
                            <div class="text-white media">
                                <div class="media-body align-self-center">
                                    <h3 class="my-0 text-white"><span data-plugin="counterup">{{number_format($data['money_month_receive'])}}</span> đ</h3>
                                    <p class="mb-0">Doanh thu</p>
                                </div>
                                <i class="ion ion-logo-usd"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <h4 class="page-title">Kho hàng</h4>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body table-responsive">
                            <table id="datatable" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">

                                <thead>
                                <tr class="text-center">
                                    <th>STT</th>
                                    <th>Ảnh</th>
                                    <th>Tên</th>
                                    <th>Giá nhập</th>
                                    <th>Số lượng</th>
                                    <th>Đã bán</th>
                                    <th>Trạng thái</th>
                                </tr>
                                </thead>

                                <tbody>
                                <?php $i = 1; ?>
                                @foreach($products as $pd)
                                    <tr class="text-center">
                                        <td><?php echo $i++; ?></td>
                                        <td>
                                            <img width="80rem" src="{{asset('/upload/product/'.$pd['image'])}}">
                                        </td>
                                        <td>{{$pd->name}}</td>
                                        <td>{{number_format($pd->price)}}</td>
                                        <td>{{$pd->amount}}</td>
                                        <td>{{$pd->sale}}</td>
                                        @if($pd->status == 1)
                                            <td><i class="mdi mdi-check-circle-outline text-success"></i></td>
                                        @else
                                            <td><i class="mdi mdi-close-circle-outline text-danger"></i></td>
                                        @endif
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- end container-fluid -->
    </div>
@endsection
