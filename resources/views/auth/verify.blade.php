@extends('front.layouts.master')

@section('title', 'Verify')

@section('content')
    <!-- Sign up -->
    <div class="login_page">
        <div class="container">
            <div class="login_form signup text-center" style="position:inherit !important;">
                <h3>Verify your email</h3>
                <div class="row d-flex justify-content-center mb-5">
                    <div class="col-lg-6">
                        @if (session('resent'))
                            <div class="alert alert-success" role="alert">
                                {{ __('A fresh verification link has been sent to your email address') }}
                            </div>
                        @endif
                        <p class="mb-3">{{ __('Before proceeding please check your email for a verification link') }}</p>
                        <span class="text-info mt-3">{{ __('If you did not receive the email') }}</span>
                            <br>
                        <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                            @csrf
                            <button type="submit" class="btn m-3 btn-success">
                                {{ __('Click here to request another') }}
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection