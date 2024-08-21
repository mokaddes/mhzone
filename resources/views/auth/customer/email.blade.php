@extends('front.layouts.master')

@section('title', __('forget password'))
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
                        <form method="POST" action="{{ route('customer.password.email') }}">
                            @csrf
                            <div class="mb-4">
                                <input type="email" name="email" id="email" class="form-control"
                                    placeholder="Enter email address" value="{{ old('email') }}" required>
                                @error('email')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary">Send password reset link</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
