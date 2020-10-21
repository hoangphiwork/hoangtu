<div class="left-side-menu">

    <div class="slimscroll-menu">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <ul class="metismenu" id="side-menu">

                <li>
                    <a href="{{route('dashboard')}}" class="waves-effect">
                        <i class="ion-md-speedometer"></i>
                        <span>  @lang('sidebar.dashboard')  </span>
                    </a>
                </li>

                <li>
                    <a href="javascript: void(0);" class="waves-effect">
                        <i class="ion ion-md-bookmark"></i>
                        <span> @lang('sidebar.category') </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul class="nav-second-level" aria-expanded="false">
                        <li><a href="{{route('category.index')}}">@lang('sidebar.list')</a></li>
                        <li><a href="{{route('category.create')}}">@lang('sidebar.category_add')</a></li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="waves-effect">
                        <i class="ion-md-basket"></i>
                        <span> @lang('sidebar.product') </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul class="nav-second-level" aria-expanded="false">
                        <li><a href="{{route('product.index')}}">@lang('sidebar.list')</a></li>
                        <li><a href="{{route('product.create')}}">@lang('sidebar.product_add')</a></li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="waves-effect">
                        <i class="ion ion-md-cart"></i>
                        <span> @lang('sidebar.order') </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul class="nav-second-level" aria-expanded="false">
                        <li><a href="{{route('order.index')}}">@lang('sidebar.order_new')</a></li>
                        <li><a href="{{route('order.delivery')}}">@lang('sidebar.order_shipping')</a></li>
                        <li><a href="{{route('order.shipped')}}">@lang('sidebar.order_shipped')</a></li>
                    </ul>
                </li>

            </ul>

        </div>
        <!-- End Sidebar -->

        <div class="clearfix"></div>

    </div>
    <!-- Sidebar -left -->

</div>
