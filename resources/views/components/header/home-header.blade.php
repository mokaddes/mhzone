<header class="header header--two" id="sticky-menu">
    <div class="navigation-bar__top">
        <div class="container">
            <div class="navigation-bar">
                <div class="d-flex align-items-center">
                    <button class="toggle-icon  ">
                        <span class="toggle-icon__bar"></span>
                        <span class="toggle-icon__bar"></span>
                        <span class="toggle-icon__bar"></span>
                    </button>
                    <!-- Brand Logo -->
                    <a href="{{ route('frontend.index') }}" class="navigation-bar__logo d-none d-xl-block">
                        <img src="{{ $settings->logo_image_url }}" alt="brand logo" class="logo-dark">
                    </a>
                </div>
                <a href="{{ route('frontend.index') }}" class="navigation-bar__logo d-block d-xl-none"
                    style="margin:0 auto !important;">
                    <img src="{{ $settings->logo_image_url }}" alt="brand logo" class="logo-dark">
                </a>
                <!-- Search Field -->
                <form action="{{ route('frontend.adlist.search') }}" method="GET" class="d-none d-xl-block">
                    <div class="navigation-bar__search-field">
                        <div class="input-group">
                            <input type="text" name="keyword" placeholder="{{ __('search_place') }}" required
                                value="{{ request()->keyword }}">
                            <button class="input-group-text" type="submit">
                                <i class="fa fa-search"></i>
                            </button>
                        </div>
                    </div>
                </form>
                <!-- Action Buttons -->
                <div class="navigation-bar__buttons">
                    @if (auth('user')->check())
                        @php
                            $unread_messages = App\Models\Messenger::where('to_id', auth('user')->id())
                                ->where('body', '!=', '.')
                                ->where('read', 0)
                                ->count();
                        @endphp
                        <ul class="header_menu d-none d-md-block">
                            <li><a href="{{ route('frontend.adlist') }}">{{ __('shop') }}</a></li>
                            @if (isset(Auth::user()->coupons) && Auth::user()->coupons > 0)
                                <li><a href="{{ route('frontend.post') }}">{{ __('sell') }}</a></li>
                            @else
                                <li><a href="{{ route('frontend.coupons') }}">{{ __('sell') }}</a></li>
                            @endif
                            <li><a href="{{ route('frontend.blog') }}">{{ __('blog') }}</a></li>

                            <li class="favourit_item me-2">
                                <a href="{{ route('frontend.favourites') }}" data-toggle="tooltip" data-placement="top"
                                    title="{{ __('wishlist') }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22"
                                        viewBox="0 0 24 24" fill="none" stroke="#000000" stroke-width="1.5"
                                        stroke-linecap="round" stroke-linejoin="bevel">
                                        <path
                                            d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z">
                                        </path>
                                    </svg>
                                    <span class="favorite_count">{{ wishlist_count() }}</span>
                                </a>
                            </li>
                            <li class="favourit_item">
                                <a href="{{ route('frontend.coupons') }}" data-toggle="tooltip" data-placement="top"
                                    title="{{ __('my coupons') }}">
                                    <i class="fa fa-shopping-basket fa-xl"></i>
                                    {{-- <i class="fa-solid fa-bag-shopping fa-xl"></i> --}}
                                    <span>{{ Auth::user()->coupons ?? 0 }}</span>
                                </a>
                            </li>
                        </ul>
                        <ul class="header_menu d-block d-md-none">
                            <li class="favourit_item me-2">
                                <a href="{{ route('frontend.favourites') }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22"
                                        viewBox="0 0 24 24" fill="none" stroke="#000000" stroke-width="1.5"
                                        stroke-linecap="round" stroke-linejoin="bevel">
                                        <path
                                            d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z">
                                        </path>
                                    </svg>
                                    <span class="favorite_count">{{ wishlist_count() }}</span>
                                </a>
                            </li>
                            <li class="favourit_item">
                                <a href="{{ route('frontend.coupons') }}" data-toggle="tooltip" data-placement="top"
                                    title="{{ __('my coupons') }}">
                                    <i class="fa fa-shopping-basket fa-xl"></i>
                                    {{-- <i class="fa-solid fa-bag-shopping fa-xl"></i> --}}
                                    <span>{{ Auth::user()->coupons ?? 0 }}</span>
                                </a>
                            </li>
                        </ul>
                        <div class="dropdown user_dropdown">
                            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                <img src="{{ getPhotoAvater(auth('user')->user()->image) }}"
                                    style="width: 40px; height: 40px; border-radius: 50%" alt="User Image">
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                <li>
                                    <a href="{{ route('frontend.dashboard') }}">{{ auth('user')->user()->name }}</a>
                                </li>
                                <hr>

                                <li><a href="{{ route('frontend.adds') }}"
                                        class="{{ request()->routeIs('frontend.adds') ? 'active' : '' }}">{{ __('my_itmes') }}</a>
                                </li>
                                <li><a href="{{ route('frontend.coupons') }}"
                                        class="{{ request()->routeIs('frontend.coupons') ? 'active' : '' }}">{{ __('my_coupons') }}</a>
                                </li>
                                @if (session('user_plan') && session('user_plan')->ad_limit > 0)
                                    <li><a href="{{ route('frontend.purchase.index') }}"
                                            class="{{ request()->routeIs('frontend.purchase.*') ? 'active' : '' }}">{{ __('post_ads') }}
                                        </a></li>
                                @endif
                                <li><a href="{{ route('frontend.account-setting') }}"
                                        class="{{ request()->routeIs('frontend.account-setting') ? 'active' : '' }}">{{ __('my_profile') }}</a>
                                </li>
                                <li><a href="{{ route('frontend.message') }}"
                                        class="{{ request()->routeIs('frontend.message') ? 'active' : '' }}">{{ __('message') }}</a>
                                </li>
                                <li><a href="{{ route('frontend.favourites') }}"
                                        class="{{ request()->routeIs('frontend.favourites') ? 'active' : '' }}">{{ __('wishlist') }}</a>
                                </li>

                                <li><a class="{{ request()->routeIs('frontend.myTransaction') ? 'active' : '' }}"
                                        href="{{ route('frontend.myTransaction') }}">{{ __('transactions') }}</a>
                                </li>
                                <li>

                                <li>
                                    <a href="#" class="dashboard__nav-link"
                                        onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                        {{ __('sign out') }}
                                    </a>
                                    <form id="logout-form" action="{{ route('frontend.logout') }}" method="POST"
                                        class="d-none">
                                        @csrf
                                    </form>
                                </li>
                            </ul>
                        </div>
                    @else
                        <ul class="header_menu d-none d-md-block">
                            <li><a href="{{ route('frontend.adlist') }}">{{ __('shop') }}</a></li>
                            @if (auth('user')->check())
                                <li><a href="{{ route('frontend.post') }}">{{ __('sell') }}</a></li>
                            @else
                                <li><a href="#" data-bs-toggle="modal"
                                        data-bs-target="#loginModal">{{ __('sell') }}</a>
                                </li>
                            @endif
                            <li><a href="{{ route('frontend.blog') }}">{{ __('blog') }}</a></li>
                        </ul>
                        <a href="#" class="btn btn--bg ms-3 me-3" data-bs-toggle="modal"
                            data-bs-target="#loginModal">
                            <span class="icon--left login_icon">
                                <x-svg.image-select-icon />
                            </span>
                            {{ __('sign_in') }}
                        </a>
                        <a href="#" class="btn d-none d-sm-block" data-bs-toggle="modal"
                            data-bs-target="#signupModal">
                            {{ __('sign_up') }}
                        </a>
                    @endif
                </div>
                <!-- Responsive Navigation Menu  -->
                <x-frontend.responsive-menu />
            </div>
        </div>
    </div>
    <div class="navigation-bar__bottom-wrap">
        <div class="container navigation-bar__bottom justify-content-between">
            @if (request()->is('dashboard') || request()->is('dashboard/*'))
                <style>
                    .breedcrumb {
                        padding: 122px 0 0px !important;
                    }
                </style>
            @else
                <div class="align-items-center">
                    <!-- Category Item -->
                    <ul class="categories header_categories text-center">
                        @foreach ($categories as $topCategory)
                            @if ($topCategory->subcategories->count() > 0)
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle"
                                        href="{{ route('frontend.adlist.search', ['category' => $topCategory->slug]) }}"
                                        id="navbarDropdown2" role="button" aria-expanded="false">
                                        {{ __($topCategory->name) }}
                                    </a>
                                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown2">
                                        <li>
                                            <a class="dropdown-item"
                                                href="{{ route('frontend.adlist.search', ['category' => $topCategory->slug]) }}">
                                                {{ __('all_categories') }}
                                            </a>
                                        </li>
                                        @foreach ($topCategory->subcategories as $subcategory)
                                            @if ($subcategory->childCategory->count() > 0)
                                                <li>
                                                    <a class="dropdown-item"
                                                        href="{{ route('frontend.adlist.search', ['subcategory' => $subcategory->slug]) }}">{{ __($subcategory->name) }}
                                                        <i class="fa fa-angle-right"></i></a>
                                                    <ul class="subsubmenu">
                                                        @foreach ($subcategory->childCategory as $childCategory)
                                                            <li><a class="dropdown-item"
                                                                    href="{{ route('frontend.adlist.search', ['childcategory[]' => $childCategory->slug]) }}">{{ __($childCategory->name) }}</a>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                </li>
                                            @else
                                                <li><a class="dropdown-item"
                                                        href="{{ route('frontend.adlist.search', ['subcategory' => $subcategory->slug]) }}">{{ __($subcategory->name) }}</a>
                                                </li>
                                            @endif
                                        @endforeach
                                    </ul>
                                </li>
                            @else
                                <li class="categories__item">
                                    <a href="{{ route('frontend.adlist.search', ['category' => $topCategory->slug]) }}"
                                        onclick="adFilterFunctionTwo('{{ $topCategory->slug }}')"
                                        class="categories__link {{ request()->routeIs('frontend.index') ? 'active' : '' }} ">
                                        {{ __($topCategory->name) }}
                                    </a>
                                </li>
                            @endif
                        @endforeach
                    </ul>
                </div>
                <x-frontend.language-switcher />
            @endif
        </div>
    </div>
</header>
<!-- Login with social media -->
<div class="login_modal">
    <div class="modal fade" id="loginModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="d-flex justify-content-end">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-4 text-center">
                        <h1>{{ __('sign_in') }}</h1>
                        <p>{{ __('login_your_account') }}
                        </p>
                    </div>
                    @if (config('zakirsoft.facebook_active') || config('zakirsoft.google_active'))
                        <div class="social_login">
                            @if (config('zakirsoft.facebook_active'))
                                <a href="{{ route('social-login', 'facebook') }}" class="facebook w-100"><i
                                        class="fab fa-facebook"></i> {{ __('continue_with_facebook') }} </a>
                            @endif
                            @if (env('GOOGLE_LOGIN_ACTIVE') && env('GOOGLE_CLIENT_ID') && env('GOOGLE_CLIENT_SECRET'))
                                <a href="{{ route('social-login', 'google') }}" class="google w-100">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 18">
                                        <g fill="#000" fill-rule="evenodd">
                                            <path
                                                d="M9 3.48c1.69 0 2.83.73 3.48 1.34l2.54-2.48C13.46.89 11.43 0 9 0 5.48 0 2.44 2.02.96 4.96l2.91 2.26C4.6 5.05 6.62 3.48 9 3.48z"
                                                fill="#EA4335"></path>
                                            <path
                                                d="M17.64 9.2c0-.74-.06-1.28-.19-1.84H9v3.34h4.96c-.1.83-.64 2.08-1.84 2.92l2.84 2.2c1.7-1.57 2.68-3.88 2.68-6.62z"
                                                fill="#4285F4"></path>
                                            <path
                                                d="M3.88 10.78A5.54 5.54 0 0 1 3.58 9c0-.62.11-1.22.29-1.78L.96 4.96A9.008 9.008 0 0 0 0 9c0 1.45.35 2.82.96 4.04l2.92-2.26z"
                                                fill="#FBBC05"></path>
                                            <path
                                                d="M9 18c2.43 0 4.47-.8 5.96-2.18l-2.84-2.2c-.76.53-1.78.9-3.12.9-2.38 0-4.4-1.57-5.12-3.74L.97 13.04C2.45 15.98 5.48 18 9 18z"
                                                fill="#34A853"></path>
                                        </g>
                                    </svg>
                                    {{ __('continue_with_google') }}

                                </a>
                            @endif
                        </div>
                    @endif
                    <div class="email_login">
                        <a href="#" data-bs-toggle="modal"
                            data-bs-target="#emailModal">{{ __('login_with_email') }}</a>
                    </div>
                    <div class="bottom text-center">
                        <p>{{ __('dont_have_account') }} ? <a href="#" data-bs-toggle="modal"
                                data-bs-target="#signupModal">{{ __('sign_up') }}</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Login with email -->
<div class="login_with_email login_modal modal" id="emailModal" data-bs-backdrop="static" data-bs-keyboard="false"
    tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="d-flex justify-content-end">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-4">
                    <h1>{{ __('sign_in') }}</h1>
                </div>
                <form action="{{ route('frontend.login') }}" id="loginForm" method="post">
                    <div class="mb-3">
                        <label class="form-label">{{ __('email address') }}</label>
                        <input type="text" name="login_data" id="login_data" class="form-control" required>
                        <span class="text-danger email_login_error"></span>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">{{ __('password') }}</label>
                        <input type="password" name="password" id="login_password" class="form-control" required>
                        <span class="text-danger password_login_error"></span>
                    </div>
                    <div class="text-center mb-4">
                        <button type="submit" class="login_btn">{{ __('sign_in') }}</button></button>
                    </div>
                </form>
                <div class="bottom">
                    <p><a href="{{ route('customer.forgot.password') }}">{{ __('forgot_password') }}</a></p>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Signup with social media -->
<div class="login_modal">
    <div class="modal" id="signupModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="d-flex justify-content-end">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-4">
                        <h1>{{ __('create_an_account') }}</h1>
                        <p>{{ __('create_account_to_buy') }}</p>
                    </div>
                    @if (config('zakirsoft.facebook_active') || config('zakirsoft.google_active'))
                        <div class="social_login">
                            @if (config('zakirsoft.facebook_active'))
                                <a href="{{ route('social-login', 'facebook') }}" class="facebook w-100"><i
                                        class="fab fa-facebook"></i> {{ __('continue_with_facebook') }}</a>
                            @endif
                            @if (env('GOOGLE_LOGIN_ACTIVE') && env('GOOGLE_CLIENT_ID') && env('GOOGLE_CLIENT_SECRET'))
                                <a href="{{ route('social-login', 'google') }}" class="google w-100">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 18">
                                        <g fill="#000" fill-rule="evenodd">
                                            <path
                                                d="M9 3.48c1.69 0 2.83.73 3.48 1.34l2.54-2.48C13.46.89 11.43 0 9 0 5.48 0 2.44 2.02.96 4.96l2.91 2.26C4.6 5.05 6.62 3.48 9 3.48z"
                                                fill="#EA4335"></path>
                                            <path
                                                d="M17.64 9.2c0-.74-.06-1.28-.19-1.84H9v3.34h4.96c-.1.83-.64 2.08-1.84 2.92l2.84 2.2c1.7-1.57 2.68-3.88 2.68-6.62z"
                                                fill="#4285F4"></path>
                                            <path
                                                d="M3.88 10.78A5.54 5.54 0 0 1 3.58 9c0-.62.11-1.22.29-1.78L.96 4.96A9.008 9.008 0 0 0 0 9c0 1.45.35 2.82.96 4.04l2.92-2.26z"
                                                fill="#FBBC05"></path>
                                            <path
                                                d="M9 18c2.43 0 4.47-.8 5.96-2.18l-2.84-2.2c-.76.53-1.78.9-3.12.9-2.38 0-4.4-1.57-5.12-3.74L.97 13.04C2.45 15.98 5.48 18 9 18z"
                                                fill="#34A853"></path>
                                        </g>
                                    </svg>
                                    {{ __('continue_with_google') }}
                                </a>
                            @endif
                        </div>
                    @endif
                    <div class="email_login">
                        <a href="#" data-bs-toggle="modal"
                            data-bs-target="#emailSignupModal">{{ __('create_account_with_email') }} </a>
                    </div>
                    <div class="bottom">
                        <p>{{ __('already_have_an_account') }} ? <a href="#" data-bs-toggle="modal"
                                data-bs-target="#emailModal">{{ __('sign_in') }}</a></p>
                        <div class="mt-3 text-center accept_condition">
                            <p> {{ __('accept_2life') }} <strong><a
                                        href="{{ route('frontend.terms') }}">{{ __('terms_of_service') }}</a></strong>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Signup with email -->
<div class="login_with_email login_modal modal " id="emailSignupModal" data-bs-backdrop="static"
    data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="d-flex justify-content-end">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-4">
                    <h1>{{ __('create account') }}</h1>
                </div>
                <form action="{{ route('customer.register') }}" id="registerForm" method="POST">
                    @csrf
                    <div class="input-field">
                        <input value="" type="text" placeholder="Full Name" name="name" id="name"
                            required>
                        @error('name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="input-field">
                        <input value="" type="text" placeholder="Username" name="username" id="username"
                            required>
                        <span class="text-danger" id="username_error"></span>
                    </div>
                    <div class="input-field">
                        <input value="" type="email" placeholder="Email Address" name="email"
                            id="email" required>
                        <span class="text-danger" id="email_error"></span>
                    </div>
                    <div class="input-field">
                        <input type="password" value="" name="password" id="password" placeholder="Password"
                            required>
                        <span class="text-danger" id="password_error"></span>
                    </div>
                    <div class="input-field">
                        <input type="password" name="password_confirmation" id="password_confirmation"
                            placeholder="Confirm Password" required>
                        @error('password_confirmation')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="registration-form__option">
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="checkme" required>
                            <label class="form-check-label" for="checkme">
                                {{ __('agree with 2life') }}
                                <a href="{{ route('frontend.privacy') }}">{{ __('privacy policy') }}</a>
                                and
                                <a href="{{ route('frontend.terms') }}">{{ __('terms condition') }}</a>
                            </label>
                        </div>
                    </div>
                    <button class="btn btn--lg w-100 registration-form__btns" type="submit">
                        {{ __('sign up') }}
                        <span class="icon--right">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path d="M3.75 12H20.25" stroke="#fff" stroke-width="1.6" stroke-linecap="round"
                                    stroke-linejoin="round"></path>
                                <path d="M13.5 5.25L20.25 12L13.5 18.75" stroke="#fff" stroke-width="1.6"
                                    stroke-linecap="round" stroke-linejoin="round"></path>
                            </svg>
                        </span>
                    </button>
                    <p class="text--body-3 registration-form__redirect">
                        {{ __('have account') }}
                        <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#emailModal">
                            {{ __('sign in') }}
                        </a>
                    </p>
                </form>
                <div class="bottom">
                    <div class="text-center accept_condition">
                        <p>
                            {{ __('accept 2life') }}
                            <strong>
                                <a href="{{ route('frontend.terms') }}">
                                    {{ __('terms of service') }}
                                </a>
                            </strong>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
