<!-- ============================== desktop header =================================== -->

<div class="header shadow-sm d-none d-sm-block mb-5">
    <div class="container">
        <nav class="navbar navbar-expand-lg p-0">
            <a class="navbar-brand p-0" href="{{ route('frontend.index') }}">
                <img src="{{ getPhotoAvater(setting('logo_image')) }}" width="80" title="logo" alt="{{ env('APP_NAME') }}">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" href="#mobileMenu" role="button"
                aria-controls="mobileMenu">
                <i class="las la-bars"></i>
            </button>
            <!-- desktop menu -->
            <div class="collapse navbar-collapse text-center" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link {{ Route::is('frontend.index') ? 'active' : '' }}"
                            href="{{ route('frontend.index') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Route::is('frontend.shop') ? 'active' : '' }}"
                            href="{{ route('frontend.shop') }}">Shop</a>
                    </li>
                    @if (Auth::check())
                        <li class="nav-item">
                            <a class="nav-link {{ Route::is('frontend.user.myOrder') ? 'active' : '' }} "
                                href="{{ route('frontend.user.myOrder') }}">My Orders</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ Route::is('frontend.user.profile') ? 'active' : '' }}"
                                href="{{ route('frontend.user.profile') }}">Dashboard</a>
                        </li>
                    @endif
                    <li class="nav-item pe-lg-5 ps-lg-5 d-flex align-items-center">
                        <form action="{{ route('frontend.shop') }}" method="get">
                            <div class="input-group">
                                <input class="form-control" type="search" name="keyword" id="inputSearch"
                                    placeholder="Search" value="{{ request('keyword') }}" required
                                    style="padding-left: 15px;">
                                <button type="submit" class="input-group-text inputSearchBtn" id="inputSearchBtn">
                                    <i class="la la-search"></i>
                                </button>
                            </div>
                        </form>
                    </li>
                    @if (Auth::check())
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                Hi ! <strong>{{ Auth::user()->name }} <i class="la la-angle-down"></i> </strong>
                            </a>
                            <ul class="dropdown-menu">
                                <div class="d-flex justify-content-between mb-3">
                                    <div>
                                        <a class="btn btn-primary" href="{{ route('frontend.user.myOrder') }}">
                                            <i class="las la-shopping-cart"></i>
                                            My Orders
                                        </a>
                                    </div>
                                    <div>
                                        <a class="btn btn-primary" href="{{ route('frontend.user.wishlist') }}">
                                            <i class="las la-heart"></i>
                                            Wish List
                                        </a>
                                    </div>
                                </div>
                                <p><strong>Account Settings</strong></p>
                                @if (is_seller())
                                    <li>
                                        <a class="dropdown-item" href="{{ route('frontend.user.myAds') }}">My Items<i
                                                class="la la-angle-right"></i></a>
                                    </li>

                                    <li>
                                        <a class="dropdown-item" href="{{ route('frontend.user.myShop') }}">My Shop<i
                                                class="la la-angle-right"></i></a>
                                    </li>
                                @endif

                                <li>
                                    <a class="dropdown-item" href="{{ route('frontend.user.profileEdit') }}">Edit
                                        Profile <i class="la la-angle-right"></i></a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="{{ route('frontend.user.card') }}">Saved Cards
                                        <i class="la la-angle-right"></i></a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="{{ route('frontend.user.address') }}">Saved
                                        Addresses <i class="la la-angle-right"></i></a>
                                </li>
                                <li>
                                    <a class="dropdown-item"
                                        href="{{ route('frontend.user.transaction') }}">Transactions
                                        <i class="la la-angle-right"></i></a>
                                </li>

                                @if (is_seller())
                                    <p class="mb-1 mt-1"><strong>Earn With Erthoo</strong></p>
                                    <li>
                                        <a class="dropdown-item" href="{{ route('frontend.post.create') }}">Sell on
                                            erthoo
                                            <i class="la la-angle-right"></i></a>
                                    </li>
                                @endif
                                <div class="d-flex justify-content-between">
                                    <div class="logout  mt-3">
                                        <a href="{{ route('frontend.user.switch.mode', is_seller() ? '0' : 1) }}"
                                            onclick="return confirm('Are you sure to switch {{ is_seller() ? 'Buyer Mode' : 'Seller Mode' }} ?')"
                                            class="btn btn-primary">
                                            <i class="las la-user"></i>
                                            {{ is_seller() ? 'Switch to buyer' : 'Switch to seller' }}
                                        </a>
                                    </div>
                                    <div class="logout mt-3">
                                        <a href="javascript:void(0)" onclick="$('#logout-form').submit();"
                                            class="btn btn-primary">
                                            <i class="las la-sign-out-alt"></i>
                                            Log out
                                        </a>
                                    </div>
                                </div>
                            </ul>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link {{ Route::is('user.login') ? 'active' : '' }} "
                                href="{{ route('user.login') }}">Login</a>
                        </li>
                    @endif
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('frontend.helpcenter') }}">Help Center</a>
                    </li>
                </ul>
                <ul class="navbar-nav ms-auto">
                    {{--                    <li class="nav-item"> --}}
                    {{--                        <a class="ps-2 pe-2" href="#"> --}}
                    {{--                            <img src="{{ asset('front/assets/images/icons/bell.svg') }}" alt="icon"> --}}
                    {{--                        </a> --}}
                    {{--                    </li> --}}
                    <li class="nav-item">
                        <a class="ps-2 pe-2" href="{{ route('frontend.cart.index') }}">
                            <img src="{{ asset('front/assets/images/icons/cart.svg') }}" alt="icon">
                            <sup
                                class="text-black cart_count ">{{ Session::has('cart') ? count(Session::get('cart')) : '' }}</sup>
                        </a>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
</div>
<!-- ============================== desktop header ================================== -->


<!-- offcanvas menu -->
<div class="mobile_menu offcanvas offcanvas-start d-block d-sm-block d-lg-none" tabindex="-1" id="mobileMenu"
    aria-labelledby="mobileMenuLabel">
    <div class="offcanvas-header mt-4">
        <h5 class="offcanvas-title" id="mobileMenuLabel">
            <a href="{{ route('frontend.index') }}" class="text-dark">erthoo</a>
        </h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body" style="height: 767px !important;">
        <ul class="navbar-nav ms-auto mb-lg-0">
            <form action="{{ route('frontend.shop') }}" method="get" class="mb-2">
                <div class="input-group">
                    <input class="form-control" type="search" name="keyword" placeholder="Search"
                        value="{{ request('keyword') }}" required style="padding-left: 15px;">
                    <button type="submit" class="input-group-text">
                        <i class="la la-search"></i>
                    </button>
                </div>
            </form>
            <li class="nav-item">
                <a class="nav-link {{ Route::is('frontend.index') ? 'active' : '' }}"
                    href="{{ route('frontend.index') }}">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Route::is('frontend.shop') ? 'active' : '' }}"
                    href="{{ route('frontend.shop') }}">Shop</a>
            </li>

            @if (Auth::check())
                <li class="nav-item">
                    <a class="nav-link {{ Route::is('frontend.user.myOrder') ? 'active' : '' }}"
                        href="{{ route('frontend.user.myOrder') }}">My Orders</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Route::is('frontend.user.wishlist') ? 'active' : '' }}"
                        href="{{ route('frontend.user.wishlist') }}">Wishlist</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Route::is('frontend.user.profile') ? 'active' : '' }}"
                        href="{{ route('frontend.user.profile') }}">Dashboard</a>
                </li>
            @endif

            @if (Auth::check())
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        Hi ! <strong>{{ Auth::user()->name }}</strong>
                        <i class="la la-angle-down" style="float: right;"></i>
                    </a>
                    <ul class="dropdown-menu">

                        <div class="ustify-content-between mb-3">
                            <a class="btn btn-primary mb-2 w-100" href="{{ route('frontend.user.myOrder') }}">
                                <i class="las la-shopping-cart"></i>
                                Your Orders
                            </a>
                            <a class="btn btn-primary w-100" href="{{ route('frontend.user.wishlist') }}">
                                <i class="las la-heart"></i>
                                Wish List
                            </a>
                        </div>

                        <p style="font-size: 13px;"><strong>Account Settings</strong></p>
                        @if (is_seller())
                            <li>
                                <a class="dropdown-item" href="{{ route('frontend.user.myAds') }}">My
                                    Items<i class="la la-angle-right"></i></a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route('frontend.user.myShop') }}">My
                                    Shop<i class="la la-angle-right"></i></a>
                            </li>
                        @endif
                        <li>
                            <a class="dropdown-item" href="{{ route('frontend.user.profileEdit') }}">Edit
                                Profile <i class="la la-angle-right"></i></a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="{{ route('frontend.user.card') }}">Saved
                                Cards <i class="la la-angle-right"></i></a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="{{ route('frontend.user.address') }}">Saved
                                Addresses <i class="la la-angle-right"></i></a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="{{ route('frontend.user.transaction') }}">Transactions
                                <i class="la la-angle-right"></i></a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="{{ route('frontend.helpcenter') }}">Help
                                Center <i class="la la-angle-right"></i></a>
                        </li>
                        @if (is_seller())
                            <p class="mb-1 mt-1"><strong>Earn With Erthoo</strong></p>
                            <li>
                                <a class="dropdown-item" href="{{ route('frontend.post.create') }}">Sell
                                    on
                                    erthoo <i class="la la-angle-right"></i></a>
                            </li>
                        @endif
                        <div class="d-flex justify-content-between">
                            <div class=" mt-3">
                                <a href="{{ route('frontend.user.switch.mode', is_seller() ? '0' : 1) }}"
                                    onclick="return confirm('Are you sure to switch {{ is_seller() ? 'Buyer Mode' : 'Seller Mode' }} ?')"
                                    class="btn btn-primary " style="margin-right: 2px">
                                    <i class="las la-user"></i>
                                    {{ is_seller() ? 'Switch to buyer' : 'Switch to seller' }}
                                </a>
                            </div>
                            <div class="mt-3">
                                <a href="javascript:void(0)" onclick="$('#logout-form').submit();"
                                    class="btn btn-primary">
                                    <i class="las la-sign-out-alt"></i>
                                    Log out
                                </a>
                            </div>
                        </div>
                    </ul>
                </li>
            @else
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('user.login') }}">Login</a>
                </li>
            @endif

            <div class="d-flex justify-content-between">
                <li class="nav-item">
                    <a class="ps-2 pe-2 nav-link" href="{{ route('frontend.cart.index') }}">
                        {{-- <img src="{{ asset('front/assets/images/icons/cart.svg') }}" alt="icon"> --}}
                    </a>

                </li>
                <li class="nav-item">
                    <a class="ps-2 pe-2 nav-link" href="#">
                        {{-- <img src="{{ asset('front/assets/images/icons/bell.svg') }}" alt="icon"> --}}
                    </a>
                    <!-- <a href="javascript:void(0)" onclick="$('#logout-form').submit();" class="ps-2 pe-2 nav-link">
                                    <i class="las la-sign-out-alt"></i>
                                    Log out
                                </a> -->
                </li>
            </div>
        </ul>
    </div>
</div>


<!-- ============================== mobile header ================================== -->
<div class="d-block d-sm-none pb-4 pt-5">
    <div class="container">
        <div class="d-flex justify-content-between">
            <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" href="#mobileMenu"
                role="button" aria-controls="mobileMenu">
                <i class="las la-bars"></i>
            </button>
            <!-- <div class="notification_alert">
                <a href="{{ route('frontend.user.profile') }}">
                    <img src="{{ asset('front/assets/images/icons/profile.svg') }}" alt="icon">
                </a>
            </div> -->
            <div class="app_name">
                <h3><a href="{{ route('frontend.index') }}">erthoo</a></h3>
            </div>
            <div class="notification_alert">
                <a href="{{ route('frontend.cart.index') }}">
                    <img src="{{ asset('front/assets/images/icons/cart.svg') }}" alt="icon">
                    <sup
                        class="text-black cart_count ">{{ Session::has('cart') ? count(Session::get('cart')) : '' }}</sup>
                </a>
            </div>
        </div>
    </div>
</div>
<!-- ============================== mobile header ================================== -->

<form id="logout-form" action="{{ route('user.logout') }}" method="POST" style="display: none;">
    @csrf
</form>
