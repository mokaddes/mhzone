@extends('front.layouts.master')
@section('title', __('Sign Up'))
@section('meta')
    @php
        $data = metaData('register');
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
    <meta name=twitter:card content="{{ $data->image_url }}" />
    <meta name=twitter:site content="{{ config('app.name') }}" />
    <meta name=twitter:url content="{{ route('frontend.index') }}" />
    <meta name=twitter:title
        content="@if (currentLanguage()->code == 'lv') {{ $data->title_lv }} @else {{ $data->title }} @endif" />
    <meta name=twitter:description
        content="@if (currentLanguage()->code == 'lv') {{ $data->description_lv }} @else {{ $data->description }} @endif" />
    <meta name=twitter:image content="{{ $data->image_url }}" />
@endsection
@section('content')
    <!-- Sign up -->
    <div class="login_page">
        <div class="container">
            <div class="login_form signup text-center custome_input_field" style="position:inherit !important;">
                <h3>Register Yourself</h3>
                <div class="row d-flex justify-content-center mb-5">
                    <div class="col-lg-6">
                        <form action="{{ route('user.register') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-4">
                                <div class="input-group">
                                    <span class="input-group-text"><i class="la la-user"></i></span>
                                    <input type="text" name="name" value="{{ old('name') }}" id="name"
                                        class="form-control" placeholder="Enter your name" required>
                                </div>
                                @error('name')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-4">
                                <div class="input-group">
                                    <span class="input-group-text"><i class="la la-envelope"></i></span>
                                    <input type="email" name="email" value="{{ old('email') }}" id="email"
                                        class="form-control" placeholder="Enter your email" required>
                                </div>
                                @error('email')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-4">
                                <div class="input-group">
                                    <span class="input-group-text"><i class="la la-lock"></i></span>
                                    <input type="password" name="password" id="password" class="form-control"
                                        placeholder="Password" required>
                                </div>
                                @error('password')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-4">
                                <div class="input-group">
                                    <span class="input-group-text"><i class="la la-lock"></i></span>
                                    <input type="password" name="password_confirmation" id="confirm_password"
                                        class="form-control" placeholder="Re-Enter Password" required>
                                </div>
                            </div>

                            <div class="mb-4">
                                <div class="input-group">
                                    <span class="input-group-text"><i class="la la-mobile"></i></span>
                                    <input type="text" name="phone" value="{{ old('phone') }}" id="phone"
                                        class="form-control" placeholder="Phone Number" required>
                                </div>
                                @error('phone')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- <div class="mb-4">
                                <div class="input-group">
                                    <span class="input-group-text"><i class="las la-calendar"></i></span>
                                    <input type="text" name="dob" id="date" value="{{ old('dob') }}" class="form-control datepicker"
                                           placeholder="Date of Birth" readonly >
                                </div>
                            </div> --}}

                            {{-- <div class="mb-4">
                                <div class="text-center">
                                    <div class=" form-check">
                                        <input class="form-check-input" name="gender" type="radio" value="Male"
                                               id="male" {{ old('gender') == 'Male' ? 'checked' : '' }} >
                                        <label class="form-check-label" for="male">
                                            Male
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" name="gender" type="radio" value="Female"
                                               id="female" {{ old('gender') == 'Female' ? 'checked' : '' }} >
                                        <label class="form-check-label" for="female">
                                            Female
                                        </label>
                                    </div>
                                </div>
                            </div> --}}

                            <div class="account_create mb-2">
                                <p>Already have an account? <a href="{{ route('user.login') }}">Log In</a></p>
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
                                    {{-- <a href="#"><img src="{{ asset('front/assets/images/twitter.png') }}" width="20" alt="icon"></a> --}}
                                </div>
                            @endif

                            <button type="submit"
                                class="btn btn-primary">{{ setting('customer_email_verification') == 1 ? 'Verify' : 'Sign Up' }}</button>


                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('css')
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
@endpush
@push('js')
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
    <script>
        $(function() {
            $(".datepicker").datepicker({
                changeMonth: true,
                changeYear: true,
                dateFormat: "dd-mm-yy",
                maxDate: 'today'
            });
        });
    </script>
@endpush
