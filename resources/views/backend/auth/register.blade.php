<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>@lang('title.register') - @lang('app.app_title') - @lang('app.app_domain')</title>
    <base href="{{asset('')}}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="@lang('app.app_title')" name="description">
    <meta content="Phi Hoang Jsc" name="author">
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
                    <div class="card-header text-center p-4 bg-primary">
                        <h4 class="text-white mb-0 mt-0">@lang('app.app_name')</h4>
                        <h5 class="text-white font-13 mb-0">@lang('title.register')</h5>
                    </div>
                    <div class="card-body">
                        @if(count($errors)>0)
                            <div class="alert alert-danger text-center">
                                @foreach($errors->all() as $er)
                                    {{$er}}<br>
                                @endforeach
                            </div>
                        @endif
                        <form action="{{route('register.do_register')}}" class="p-2" method="POST">
                            @csrf
                            <div class="form-group mb-3">
                                <label for="name">@lang('auth.label.name')</label>
                                <input class="form-control" type="text" name="name" id="name" required="" placeholder="@lang('auth.hint.name')">
                            </div>

                            <div class="form-group mb-3">
                                <label for="email">@lang('auth.label.email')</label>
                                <input class="form-control" type="email" name="email" id="email" required="" placeholder="@lang('auth.hint.email')">
                            </div>

                            <div class="form-group mb-3">
                                <label for="password">@lang('auth.label.password')</label>
                                <input class="form-control" type="password" name="password" id="password" required="" placeholder="@lang('auth.hint.password')">
                            </div>

                            <div class="form-group mb-4">
                                <div class="checkbox checkbox-success">
                                    <input id="remember" type="checkbox" required checked="">
                                    <label for="remember">
                                        Tôi đồng ý với các <strong><a>Điều khoản & Chính sách</a></strong>
                                    </label>
                                </div>
                            </div>

                            <div class="form-group text-center mt-4 mb-4">
                                <div class="col-12">
                                    <button class="btn btn-md btn-block btn-primary waves-effect waves-light" type="submit">@lang('auth.button.register')</button>
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-sm-12 text-center">
                                    <a href="{{route('login.index')}}">@lang('auth.had_account')</a>
                                </div>
                            </div>
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
