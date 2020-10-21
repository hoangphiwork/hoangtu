<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="utf-8">
    <title>@lang('title.login') - @lang('app.app_title') - @lang('app.app_domain')</title>
    <base href="{{asset('')}}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Đăng nhập hệ thống - Website bán phụ kiện máy tính Hoàng Tú - hoangtu.work" name="description">
    <meta content="Hoang Phi Co.,Ltd" name="author">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- App favicon -->
    <link rel="shortcut icon" href="assets\images\fav.ico">

    <!-- App css -->
    <link href="assets\css\bootstrap.min.css" rel="stylesheet" type="text/css" id="bootstrap-stylesheet">
    <link href="assets\css\icons.min.css" rel="stylesheet" type="text/css">
    <link href="assets\css\app.min.css" rel="stylesheet" type="text/css" id="app-stylesheet">

</head>

<body class="authentication-page">

<div class="account-pages my-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6 col-xl-5">
                <div class="card mt-4">
                    <div class="card-header p-4 bg-primary">
                        <h4 class="text-white text-center mb-0 mt-0">@lang('app.app_name')</h4>
                    </div>
                    <div class="card-body">
                        @if(session('notice'))
                            <div class="alert alert-success text-center">
                                {{session('notice')}}
                            </div>
                        @endif
                        <form action="{{route('login.do_login')}}" class="p-2" method="POST">
                            @csrf
                            <div class="form-group mb-3">
                                <label for="email">@lang('auth.label.email')</label>
                                <input class="form-control" type="email" name="email" id="email" required="" placeholder="@lang('auth.hint.email')">
                            </div>

                            <div class="form-group mb-3">
                                <label for="password">@lang('auth.label.password')</label>
                                <input class="form-control" type="password" name="password" required="" id="password" placeholder="@lang('auth.hint.password')">
                            </div>

                            <div class="form-group row text-center mt-4 mb-4">
                                <div class="col-12">
                                    <button class="btn btn-md btn-block btn-primary waves-effect waves-light" type="submit">@lang('auth.button.login')</button>
                                </div>
                            </div>

{{--                            <div class="form-group row text-center mt-4 mb-4">--}}
{{--                                <div class="col-12">--}}
{{--                                    <a class="btn btn-md btn-block btn-danger waves-effect waves-light" href="javasript:void()">@lang('auth.button.login_with_google')</a>--}}
{{--                                </div>--}}
{{--                            </div>--}}
                            @if($user->count() == 0)
                            <div class="form-group row mb-0">
                                <div class="col-sm-12 text-center">
                                    <p class="text-muted mb-0">@lang('auth.do_not_have_account')<a href="{{route('register.create')}}" class="text-dark m-l-5"><b>@lang('auth.button.register')</b></a></p>
                                </div>
                            </div>
                            @endif
                        </form>

                    </div>
                    <!-- end card-body -->
                </div>
                <!-- end card -->
                <!-- end row -->

            </div>
            <!-- end col -->
        </div>
        <!-- end row -->

    </div>
</div>

<!-- Vendor js -->
<script src="assets\js\vendor.min.js"></script>

<!-- App js -->
<script src="assets\js\app.min.js"></script>

</body>

</html>
