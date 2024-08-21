@extends('admin.layouts.auth')

@section('content')
    <p class="login-box-msg">{{ __('sign in to start your session') }}</p>
    <form method="POST" action="{{ route('admin.login') }}">
        @csrf
        <div class="input-group mb-3">
            <input type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                value="{{ old('email') }}" placeholder="{{ __('email') }}">
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-envelope"></span>
                </div>
            </div>
            @error('email')
                <span class="invalid-feedback" role="alert"><strong>{{ $message == 'validation.required' ? 'Email field is required' : 'Credential is not match' }}</strong></span>
            @enderror
        </div>
        <div class="input-group mb-3">
            <input type="password" class="form-control @error('password') is-invalid @enderror" name="password"
                placeholder="{{ __('password') }}">
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-lock"></span>
                </div>
            </div>
            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message == 'validation.required' ? 'Password field is required' : '' }}</strong></span>
            @enderror
        </div>
        <div class="d-flex justify-content-between align-items-center">
            <div class="icheck-primary">
                <input type="checkbox" id="remember">
                <label class="m-0" for="remember">{{ __('remember me') }}</label>
            </div>
            <div>
                <a href="{{ route('admin.password.request') }}">{{ __('I forgot my password') }}</a>
            </div>
        </div>
        @if (env('NOCAPTCHA_ACTIVE'))
            <div class="input-group mt-3 text-center">
                {!! NoCaptcha::display() !!}
                @if ($errors->has('g-recaptcha-response'))
                    <span class="text-danger text-sm">
                        <strong>{{ $errors->first('g-recaptcha-response') }}</strong>
                    </span>
                @endif
            </div>
        @endif
        <button type="submit" class="btn btn-primary btn-block mt-4">
            {{ __('sign in') }}

        </button>
    </form>
@endsection

{{-- @extends('admin.layouts.auth')
@section('content')

    <div class="text-center mt-5" style="margin-top:22rem !important;">
        <h2>Coming Soon</h2>
        <a href="{{ route('frontend.index') }}" class="btn btn-primary">Back to Home</a>
    </div>

@endsection  --}}
