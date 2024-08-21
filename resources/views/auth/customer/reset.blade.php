@extends('front.layouts.master')

@section('title', __('reset password'))
@push('css')
    <style>
        .signup .form-control {
            border: 1px solid #1b1919 !important;
            border-radius: 40px !important;
        }
    </style>
@endpush
@section('content')
    <!-- Sign up -->
    <div class="login_page">
        <div class="container">
            <div class="login_form signup text-center" style="position:inherit !important;">
                <h3>Forgot password</h3>
                <div class="row d-flex justify-content-center mb-5">
                    <div class="col-lg-6">
                        <form method="POST" action="{{ route('customer.password.update') }}">
                            @csrf
                            <input type="hidden" name="token" value="{{ $token }}">
                            <div class="input-field d-none">
                                <input type="email" placeholder="{{ __('email address') }}" name="email"
                                       value="{{ request('email', '') }}"
                                       class="@error('email') is-invalid border-danger @enderror" />
                                @error('email')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <div class="input-field">
                                    <input type="password" placeholder="{{ __('new password') }}" id="password"
                                           name="password" class="form-control @error('password') is-invalid border-danger @enderror" />
                                    @error('password')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-4">
                                <div class="input-field">
                                    <input type="password" placeholder="{{ __('confirm password') }}" id="confirmPassword"
                                           name="password_confirmation"
                                           class="form-control @error('password_confirmation') is-invalid border-danger @enderror" />
                                    @error('password_confirmation')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Reset Password</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
