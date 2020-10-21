@extends('backend.layout.index')
@section('title')
    @lang('title.product.index') - @lang('app.app_title')
@endsection
@section('main')
    <div class="content">

        <!-- Start Content-->
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <h4 class="page-title">@lang('sidebar.product')</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb p-0 m-0">
                                <li class="breadcrumb-item"><a href="{{route('dashboard')}}">@lang('sidebar.dashboard')</a></li>
                                <li class="breadcrumb-item active">@lang('sidebar.product')</li>
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
                                    <th>Giá bán</th>
                                    <th>Số lượng</th>
                                    <th>Đã bán</th>
                                    <th>Trạng thái</th>
                                    <th>Hành động</th>
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
                                        <td>{{\Illuminate\Support\Str::limit($pd->name, 50, '...')}}</td>
                                        <td>{{number_format($pd->price)}}</td>
                                        <td>{{number_format($pd->cost)}}</td>
                                        <td>{{$pd->amount}}</td>
                                        <td>{{$pd->sale}}</td>
                                        @if($pd->status == 1)
                                            <td><i class="mdi mdi-check-circle-outline text-success"></i></td>
                                        @else
                                            <td><i class="mdi mdi-close-circle-outline text-danger"></i></td>
                                        @endif
                                        <td>
                                            <a href="javascript:void(0);" onclick="$(this).find('form').submit();" >
                                                <form action="{{ route('product.destroy', ['product' => $pd->id]) }}" method="post">
                                                    @csrf
                                                    <input type="hidden" name="_method" value="DELETE">
                                                </form>
                                                <i class="mdi mdi-delete-sweep text-danger"></i><span> @lang('button.delete') </span>
                                            </a>
                                            <a href="{{route('product.edit', ['product' => $pd->id])}}" style="margin-left: 10px;" class="text-dark"><i class="far fa-edit text-success"></i><span class=""> @lang('button.edit') </span></a>
                                        </td>
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
