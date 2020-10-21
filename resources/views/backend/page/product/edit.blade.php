@extends('backend.layout.index')
@section('title')
    {{$product->name}} - @lang('title.product.edit') -  @lang('app.app_title')
@endsection
@section('main')
    <div class="content">

        <!-- Start Content-->
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <h4 class="page-title">Cập nhật sản phẩm</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb p-0 m-0">
                                <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Trang chủ</a></li>
                                <li class="breadcrumb-item"><a href="{{route('product.index')}}">Sản phẩm</a></li>
                                <li class="breadcrumb-item active">Cập nhật sản phẩm</li>
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
                                        <form class="form-horizontal" action="{{route('product.update', ['product' => $product->id])}}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT')
                                            <div class="form-group row">
                                                <div class="col-sm-6">
                                                    <label for="name">Tên sản phẩm</label>
                                                    <input type="text" class="form-control" required="" value="{{$product->name}}" name="name" id="name" placeholder="Nhập tên sản phẩm...">
                                                </div>
                                                <div class="col-sm-6">
                                                    <label for="cate_id">Danh mục sản phẩm</label>
                                                    <select class="form-control" name="cate_id" id="cate_id" disabled="">
                                                        @foreach($categories as $ct)
                                                            <option
                                                                @if($product->category['id'] == $ct->id)
                                                                {{"selected"}}
                                                                @endif
                                                                value="{{$ct->id}}">{{$ct->name}}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <div class="col-sm-6" hidden="">
                                                    <label for="cate_id">Danh mục sản phẩm</label>
                                                    <select class="form-control" name="cate_id" id="cate_id">
                                                        @foreach($categories as $ct)
                                                            <option
                                                                @if($product->category['id'] == $ct->id)
                                                                {{"selected"}}
                                                                @endif
                                                                value="{{$ct->id}}">{{$ct->name}}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <div class="col-md-6">
                                                    <label for="price">Giá nhập</label>
                                                    <input type="number" class="form-control text-center" min="0" value="{{$product->price}}" required="" name="price" id="price" placeholder="Nhập giá sản phẩm nhập vào...">
                                                </div>

                                                <div class="col-md-6">
                                                    <label for="amount">Số lượng</label>
                                                    <input type="number" class="form-control text-center" min="0" value="{{$product->amount}}" required="" name="amount" id="amount" placeholder="Nhập số lượng sản phẩm...">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <div class="col-md-6">
                                                    <label for="cost">Giá bán</label>
                                                    <input type="number" class="form-control text-center" min="0" value="{{$product->cost}}" required="" name="cost" id="cost" placeholder="Nhập giá sản phẩm nhập vào...">
                                                </div>

                                                <div class="col-md-6">
                                                    <label>Trạng thái</label>
                                                    <div class="">
                                                        <div class="radio radio-success form-check-inline ml-5">
                                                            <input type="radio" id="status1" value="1" name="status"
                                                            @if($product->status == 1)
                                                                {{"checked"}}
                                                                @endif
                                                            >
                                                            <label for="status1"> Đang kinh doanh </label>
                                                        </div>
                                                        <div class="radio radio-danger form-check-inline ml-5">
                                                            <input type="radio" id="status2" value="2" name="status"
                                                            @if($product->status == 2)
                                                                {{"checked"}}
                                                                @endif
                                                            >
                                                            <label for="status2"> Ngừng kinh doanh </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <div class="col-md-6">
                                                    <label for="des">Mô tả</label>
                                                    <textarea class="form-control" name="des" rows="7" id="des" placeholder="Nhập mô tả sản phẩm...">{{$product->des}}</textarea>
                                                </div>

                                                <div class="col-md-6">
                                                    <p>
                                                        <img src="{{asset('/upload/product/'.$product['image'])}}" width="150" alt="">
                                                        <input type="text" value="{{$product->image}}" name="iconname" hidden="">
                                                    </p>
                                                    <input type="file" class="form-control" name="image" id="image">
                                                </div>
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
