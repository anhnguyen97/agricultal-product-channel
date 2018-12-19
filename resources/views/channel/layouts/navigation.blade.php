<!-- Header -->
<header class="header trans_300">

    <!-- Top Navigation -->

    <div class="top_nav">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="top_nav_left">CHUNG TAY PHÁT TRIỂN NÔNG NGHIỆP SẠCH VIỆT NAM</div>
                </div>
                <div class="col-md-6 text-right">
                    <div class="top_nav_right">
                        <ul class="top_nav_menu">
                            <li class="account">
                                @if (Auth::check())
                                <a href="#">
                                    {{Auth::user()->name}}
                                    <i class="fa fa-angle-down"></i>
                                </a>
                                <ul class="account_selection" style="width: 120px">
                                    <li ><a href="{{ route('user.profile') }}"><i class="fa fa-sign-in" aria-hidden="true"></i>Profile</a></li>
                                    <li >
                                        <a href="{{ route('logout') }}" class="btn btn-default btn-flat" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">{{-- <i class="fa fa-user-plus" aria-hidden="true"></i> --}}Logout
                                        </a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            @csrf
                                        </form>
                                    </li>
                                </ul>
                                @else
                                <a href="#">
                                    Account
                                    <i class="fa fa-angle-down"></i>
                                </a>
                                <ul class="account_selection" style="width: 120px">
                                    <li><a href="{{ route('login') }}"><i class="fa fa-sign-in" aria-hidden="true"></i>Sign In</a></li>
                                    <li><a href="{{ route('register') }}"><i class="fa fa-user-plus" aria-hidden="true"></i>Register</a></li>
                                </ul>
                                @endif

                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Navigation -->

    <div class="main_nav_container" style="background-color: transparent!important">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-right">
                    <div class="logo_container">
                        <a href="{{ route('channel.index') }}">Agri<span>pc</span></a>
                    </div>
                    <nav class="navbar" style="height: 80px">
                        @if (Auth::check())
                        @if (Auth::user()->is_farmer==1)
                        <ul class="navbar_menu" style="margin-bottom: 0px">
                            <li><a href="{{ route('channel.index') }}">Trang chủ</a></li>
                            <li><a href="{{ route('farmer.product') }}">QL Nông sản</a></li>
                            <li><a href="{{ route('farmer.transaction') }}">QL Giao dịch</a></li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" data-toggle="dropdown"  href="#" id="navbarDropdown"> Thống kê</a>
                                <ul id="navbarDropdown" class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <li class="dropdown-item"><a href="{{ asset('') }}farmer/statistical/product">Nông sản</a></li>
                                    <li class="dropdown-item"><a href="{{ asset('') }}farmer/statistical/transaction">Giao dịch</a></li>
                                    <li class="dropdown-item"><a href="{{ asset('') }}farmer/statistical/sales">Doanh số</a></li>
                                </ul>
                            </li>
                        </ul>
                        <ul class="navbar_user" style="margin-bottom: 0px">
                            <li><a href="#"><i class="fa fa-search" aria-hidden="true"></i></a></li>
                        </ul>
                        @else
                        <ul class="navbar_menu" style="margin-bottom: 0px">
                            <li><a href="{{ route('channel.index') }}">Trang chủ</a></li>
                            <li><a href="{{ route('trader.product') }}">QL Kho</a></li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" data-toggle="dropdown"  href="#" id="navbarDropdown">QL Giao dịch</a>
                                <ul id="navbarDropdown" class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <li class="dropdown-item"><a href="{{ route('trader.transaction.export') }}">Xuất hàng</a></li>
                                    <li class="dropdown-item"><a href="{{ route('trader.transaction.import') }}">Nhập hàng</a></li>
                                </ul>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" data-toggle="dropdown"  href="#" id="navbarDropdown"> Thống kê</a>
                                <ul id="navbarDropdown" class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <li class="dropdown-item"><a href="{{ asset('') }}trader/statistical/product">Nông sản</a></li>
                                    <li class="dropdown-item"><a href="{{ asset('') }}trader/statistical/transaction">Giao dịch</a></li>
                                    <li class="dropdown-item"><a href="{{ asset('') }}trader/statistical/sales">Doanh số</a></li>
                                </ul>
                            </li>
                        </ul>
                        <ul class="navbar_user" style="margin-bottom: 0px">
                            <li><a href="#"><i class="fa fa-search" aria-hidden="true"></i></a></li>
                            <li class="checkout">
                                <a href="{{ asset('') }}trader/cart">
                                    <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                                    <div id="checkout_items" class="checkout_items"></div>
                                </a>
                            </li>
                        </ul>
                        @endif
                        @else
                        <ul class="navbar_menu" style="margin-bottom: 0px">
                            <li><a href="{{ route('channel.index') }}">Trang chủ</a></li>
                            <li><a href="#">Liên hệ</a></li>
                        </ul>
                        <ul class="navbar_user" style="margin-bottom: 0px">
                            <li><a href="#"><i class="fa fa-search" aria-hidden="true"></i></a></li>
                           {{--  <li class="checkout">
                                <a href="#">
                                    <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                                    <span id="checkout_items" class="checkout_items">2</span>
                                </a>
                            </li> --}}
                        </ul>
                        @endif
                        <div class="hamburger_container">
                            <i class="fa fa-bars" aria-hidden="true"></i>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </div>

</header>
