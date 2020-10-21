@extends('backend.layout.index')
@section('title')
    @lang('title.category.create') - @lang('app.app_title')
@endsection
@section('main')
    <div class="content">

        <!-- Start Content-->
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <h4 class="page-title">@lang('sidebar.category_add')</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb p-0 m-0">
                                <li class="breadcrumb-item"><a href="{{route('dashboard')}}">@lang('sidebar.dashboard')</a></li>
                                <li class="breadcrumb-item"><a href="{{route('category.index')}}">@lang('sidebar.category')</a></li>
                                <li class="breadcrumb-item active">@lang('sidebar.category_add')</li>
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
                                        <form class="form-horizontal" action="{{route('category.store')}}" method="POST">
                                            @csrf
                                            <div class="form-group row">
                                                <label class="col-lg-2 col-form-label" for="name">@lang('label.name')</label>
                                                <div class="col-lg-10">
                                                    <input type="text" class="form-control" required="" name="name" id="name" placeholder="@lang('hint.category.name')">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-lg-2 col-form-label" for="desc">@lang('label.desc')</label>
                                                <div class="col-lg-10">
                                                    <textarea name="description" class="form-control" id="desc" cols="30" rows="5" placeholder="@lang('hint.category.desc')"></textarea>
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
