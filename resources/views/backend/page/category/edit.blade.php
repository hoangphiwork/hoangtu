@extends('backend.layout.index')
@section('title')
    @lang('title.category.edit') - {{$category->name}} - @lang('app.app_title')
@endsection
@section('main')
    <div class="content">

        <!-- Start Content-->
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <h4 class="page-title">{{$category->name}}</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb p-0 m-0">
                                <li class="breadcrumb-item"><a href="{{route('dashboard')}}">@lang('sidebar.dashboard')</a></li>
                                <li class="breadcrumb-item"><a href="{{route('category.index')}}">@lang('sidebar.category')</a></li>
                                <li class="breadcrumb-item active">Cập nhật loại sản phẩm</li>
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
                            <h4 class="header-title mb-4 text-center">@lang('label.input_info')</h4>
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
                                        <form class="form-horizontal" action="{{route('category.update', ['category' => $category->id])}}}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="form-group row">
                                                <label class="col-lg-2 col-form-label" for="name">@lang('label.name')</label>
                                                <div class="col-lg-10">
                                                    <input type="text" class="form-control" required="" name="name" id="name" value="{{$category->name}}" placeholder="@lang('hint.category.name')">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-lg-2 col-form-label" for="desc">@lang('label.desc')</label>
                                                <div class="col-lg-10">
                                                    <textarea name="description" class="form-control" id="desc" cols="30" rows="5" placeholder="@lang('hint.category.desc')">{{$category->description}}</textarea>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-sm-2 control-label">Trạng thái</label>
                                                <div class="col-sm-10">
                                                    <div class="radio radio-success form-check-inline">
                                                        <input type="radio" id="inlineRadio1" value="1" name="status"
                                                        @if($category->status == 1)
                                                            {{"checked"}}
                                                            @endif
                                                        >
                                                        <label for="inlineRadio1"> Đang kinh doanh </label>
                                                    </div>
                                                    <div class="radio radio-danger form-check-inline">
                                                        <input type="radio" id="inlineRadio2" value="2" name="status"
                                                        @if($category->status == 2)
                                                            {{"checked"}}
                                                            @endif
                                                        >
                                                        <label for="inlineRadio2"> Ngừng kinh doanh </label>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group text-center mb-0">
                                                <button class="btn btn-primary waves-effect waves-light mr-1" type="submit">
                                                    @lang('button.confirm')
                                                </button>
                                                <button type="reset" class="btn btn-secondary waves-effect waves-light">
                                                    @lang('button.reset')
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
