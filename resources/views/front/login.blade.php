@extends('front.layouts.master')
@section('title', __('Login'))
@section('meta')
    @php
        $data = metaData('login');
    @endphp
    <meta name="title" content="@if (currentLanguage()->code == 'lv') {{ $data->title_lv }} @else {{ $data->title }} @endif">
    <meta name="description"
        content="@if (currentLanguage()->code == 'lv') {{ $data->description_lv }} @else {{ $data->description }} @endif">
    <meta property="og:image" content="{{ $data->image_url }}" />
    <meta property="og:site_name" content="{{ config('app.name') }}">
    <meta property="og:title"
        content="@if (currentLanguage()->code == 'lv') {{ $data->title_lv }} @else {{ $data->title }} @endif">
    <meta property="og:url" content="{{ route('frontend.index') }}">
    <meta property="og:type" content="article">
    <meta property="og:description"
        content="@if (currentLanguage()->code == 'lv') {{ $data->description_lv }} @else {{ $data->description }} @endif">
    <meta name=twitter:card content={{ $data->image_url }} />
    <meta name=twitter:site content="{{ config('app.name') }}" />
    <meta name=twitter:url content="{{ route('frontend.index') }}" />
    <meta name=twitter:title
        content="@if (currentLanguage()->code == 'lv') {{ $data->title_lv }} @else {{ $data->title }} @endif" />
    <meta name=twitter:description
        content="@if (currentLanguage()->code == 'lv') {{ $data->description_lv }} @else {{ $data->description }} @endif" />
    <meta name=twitter:image content="{{ $data->image_url }}" />
@endsection
@push('css')
    <style>
        .login_form .form-control {
            border-radius: 40px !important;
        }
    </style>
@endpush
@section('content')
    <!-- login -->
    <div class="login_page">
        <div class="container">
            <div class="login_form text-center">
                <h4>Welcome to</h4>
                <h2>mhzone</h2>
                {{-- <p>
                    Elevate Your Footwear Game with Style, Comfort, and Quality
                </p> --}}
                <h3>Log in</h3>
                <div class="row d-flex justify-content-center">
                    <div class="col-lg-6">
                        <form action="{{ route('user.login.store') }}" method="post">
                            @csrf
                            <div class="mb-4">
                                <input type="email" name="email" id="email" class="form-control"
                                    placeholder="Enter email address" value="{{ old('email') }}" required>
                            </div>
                            <div class="mb-4">
                                <input type="password" name="password" id="password" class="form-control"
                                    placeholder="Enter password" required>
                            </div>
                            <div class="account_create mb-2">
                                <p>Forgot password? <a href="{{ route('customer.forgot.password') }}">Click here</a></p>
                            </div>
                            <div class="account_create mb-2">
                                <p>Don't have an account? <a href="{{ route('frontend.signup') }}">Sign Up</a></p>
                            </div>
                            @if (
                                (env('GOOGLE_LOGIN_ACTIVE') && env('GOOGLE_CLIENT_ID') && env('GOOGLE_CLIENT_SECRET')) ||
                                    (env('FACEBOOK_LOGIN_ACTIVE') && env('FACEBOOK_CLIENT_ID') && env('FACEBOOK_CLIENT_SECRET')))
                                <div class="divider mb-2">
                                    <span>OR</span>
                                </div>

                                <div class="social_login mb-4 d-none d-lg-block">
                                    <h5 class="mb-3">Continue with</h5>
                                    @if (env('GOOGLE_LOGIN_ACTIVE') && env('GOOGLE_CLIENT_ID') && env('GOOGLE_CLIENT_SECRET'))
                                        <a href="{{ route('social-login', 'google') }}"><img
                                                src="{{ asset('front/assets/images/google.png') }}" width="20"
                                                alt="icon"></a>
                                    @endif
                                    @if (env('FACEBOOK_LOGIN_ACTIVE') && env('FACEBOOK_CLIENT_ID') && env('FACEBOOK_CLIENT_SECRET'))
                                        <a href="{{ route('social-login', 'facebook') }}"><img class="facebook"
                                                src="{{ asset('front/assets/images/facebook.png') }}" width="20"
                                                alt="icon"></a>
                                    @endif
                                    {{--                                <a href="#"><img src="{{ asset('front/assets/images/twitter.png') }}" width="20" alt="icon"></a> --}}
                                </div>
                            @endif
                            <button type="submit" class="btn btn-primary loading mt-3">Log In</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
