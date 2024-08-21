@extends('admin.layouts.app')
@section('title')
    {{ __('customer details') }}
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-lg-6 mb-3">
                <div class="card card-widget widget-user shadow">
                    <div class="widget-user-header bg-info">
                        <h3 class="widget-user-username">{{ $customer->name }}</h3>
                        <h5 class="widget-user-desc">{{ $customer->email }}</h5>
                    </div>
                    <div class="widget-user-image">
                        @if ($customer->image)
                            <img class="img-circle elevation-2" src="{{ asset($customer->image) }}" alt="Customer Image">
                        @else
                            <img class="img-circle elevation-2" src="{{ asset('backend/image/thumbnail.jpg') }}"
                                alt="Customer Image">
                        @endif
                    </div>
                    <div class="card-footer">
                        <div class="row">
                            <div class="col-sm-4 border-right">
                                <div class="description-block">
                                    <h5 class="description-header">{{ __('username') }}</h5>
                                    <span class="description-text">{{ $customer->username }}</span>
                                </div>
                            </div>
                            <div class="col-sm-4 border-right">
                                <div class="description-block">
                                    <h5 class="description-header">{{ __('phone') }}</h5>
                                    <span class="description-text">{{ $customer->phone }}</span>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="description-block">
                                    <h5 class="description-header">{{ __('registered at') }}</h5>
                                    <span
                                        class="description-text">{{ date('M d, Y', strtotime($customer->created_at)) }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                {{-- category wise ads --}}
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title" style="line-height: 36px;">{{ __('Customer') }} {{ __('ads') }}
                        </h3>
                        <a href="{{ route('module.customer.index') }}"
                            class="btn bg-primary float-right d-flex align-items-center justify-content-center"><i
                                class="fas fa-arrow-left"></i>&nbsp; {{ __('back') }}</a>
                    </div>
                    <div class="card-body table-responsive p-0">
                        <x-backend.ad-manage :ads="$ads" :showCustomer="false" />
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection

@section('style')
    <style>
        .widget-user .widget-user-image>img {
            width: 110px;
        }

        .widget-user .card-footer {
            padding-top: 80px;
        }
    </style>
@endsection
