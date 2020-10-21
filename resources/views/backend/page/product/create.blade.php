@extends('backend.layout.index')
@section('title')
    @lang('title.product.create') - @lang('app.app_title')
@endsection
@section('main')
    <div class="content">

        <!-- Start Content-->
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <h4 class="page-title">Thêm sản phẩm</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb p-0 m-0">
                                <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Trang chủ</a></li>
                                <li class="breadcrumb-item"><a href="{{route('product.index')}}">Sản phẩm</a></li>
                                <li class="breadcrumb-item active">Thêm sản phẩm</li>
                            </ol>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="header-title mb-4">Nhập thông tin</h4>
                            @if(count($errors)>0)
                                <div class="alert alert-danger text-center">
                                    @foreach($errors->all() as $er)
                                        {{$er}}<br>
                                    @endforeach
                                </div>
                            @endif
                            <div class="row">
                                <div class="col-12">
                                    <div class="">
                                        <form class="form-horizontal" action="{{route('product.store')}}" method="POST" enctype="multipart/form-data">
                                            {!!csrf_field() !!}

                                            <div class="form-group row">
                                                <div class="col-sm-6">
                                                    <label for="name">Tên sản phẩm</label>
                                                    <input type="text" class="form-control" required="" name="name" id="name" placeholder="Nhập tên sản phẩm...">
                                                </div>
                                                <div class="col-sm-6">
                                                    <label for="cate_id">Danh mục sản phẩm</label>
                                                    <select class="form-control" name="cate_id" id="cate_id">
                                                        @foreach($categories as $ct)
                                                            @if($ct->status == 1)
                                                                <option value="{{$ct->id}}">{{$ct->name}}</option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <div class="col-md-6">
                                                    <label for="price">Giá nhập</label>
                                                    <input type="number" class="form-control text-center" min="0" required="" name="price" id="price" placeholder="Nhập giá sản phẩm nhập vào...">
                                                </div>

                                                <div class="col-md-6">
                                                    <label for="amount">Số lượng</label>
                                                    <input type="number" class="form-control text-center" min="0" required="" name="amount" id="amount" placeholder="Nhập số lượng sản phẩm...">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="des">Mô tả</label>
                                                <textarea class="form-control" name="des" rows="5" id="des" placeholder="Nhập mô tả sản phẩm..."></textarea>
                                            </div>

                                            <div class="form-group">
                                                <label for="image">Hình ảnh</label>
                                                <input type="file" class="form-control" required="" name="image" id="image">
                                            </div>

                                            <div class="form-group text-center mb-0">
                                                <button class="btn btn-primary waves-effect waves-light mr-1" type="submit">
                                                    Xác nhận
                                                </button>
                                                <button type="reset" class="btn btn-secondary waves-effect waves-light">
                                                    Làm mới
                                                </button>
                                            </div>

                                        </form>
                                    </div>
                                </div>

                            </div>
                            <!-- end row -->

                        </div>
                    </div>
                    <!-- end card -->
                </div>
                <!-- end col -->
            </div>
            <!-- end row -->

        </div>
    </div>
@endsection
