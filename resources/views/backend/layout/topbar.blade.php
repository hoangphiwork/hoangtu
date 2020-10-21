<div class="navbar-custom">
    <ul class="list-unstyled topnav-menu float-right mb-0">

        @if(isset($userLogin))
        <li class="dropdown notification-list">
            <a class="nav-link dropdown-toggle nav-user mr-0 waves-effect" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                <img src="assets\images\users\avatar.png" alt="user-image" class="rounded-circle">
                <span class="pro-user-name ml-1">
                                {{$userLogin->name}}   <i class="mdi mdi-chevron-down"></i>
                            </span>
            </a>
            <div class="dropdown-menu dropdown-menu-right profile-dropdown ">
                <!-- item-->
                <a href="{{route('admin.changePass')}}" class="dropdown-item notify-item">
                    <i class="mdi mdi-account-outline"></i>
                    <span>@lang('topbar.change_pass')</span>
                </a>

                <!-- item-->
                <a href="{{route('admin.logout')}}" class="dropdown-item notify-item">
                    <i class="mdi mdi-logout-variant"></i>
                    <span>@lang('topbar.logout')</span>
                </a>

            </div>
        </li>
        @endif
    </ul>

    <!-- LOGO -->
    <div class="logo-box">
        <a href="{{route('dashboard')}}" class="logo text-center logo-dark">
                        <span class="logo-lg">
                            <img src="assets\images\logo-dark.png" alt="" height="18">
                            <!-- <span class="logo-lg-text-dark">Velonic</span> -->
                        </span>
            <span class="logo-sm">
                            <!-- <span class="logo-lg-text-dark">V</span> -->
                            <img src="assets\images\logo-sm.png" alt="" height="22">
                        </span>
        </a>

        <a href="{{route('dashboard')}}" class="logo text-center logo-light">
                        <span class="logo-lg">
                            <img src="assets\images\logo_light.png" alt="" height="75">
                            <!-- <span class="logo-lg-text-dark">Velonic</span> -->
                        </span>
            <span class="logo-sm">
                            <!-- <span class="logo-lg-text-dark">V</span> -->
                            <img src="assets\images\logo-sm.png" alt="" height="22">
                        </span>
        </a>
    </div>

    <!-- LOGO -->


    <ul class="list-unstyled topnav-menu topnav-menu-left m-0">
        <li>
            <button class="button-menu-mobile waves-effect">
                <i class="mdi mdi-menu"></i>
            </button>
        </li>
    </ul>
</div>
