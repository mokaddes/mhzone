@extends('admin.layouts.app')
@section('title')
    {{ __('Website Settings') }}
@endsection
@section('breadcrumbs')
    <div class="row mb-2 mt-4">
        <div class="col-sm-6">
            <h1 class="m-0">{{ __('Color') }}</h1>
        </div>
    </div>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                @yield('website-color')
            </div>
        </div>
    </div>
@endsection
