@extends('front.layouts.master')
@section('title', __('Order Track'))
@section('meta')
    @php
        $data = metaData('home');
    @endphp
    <meta name="title" content="@if (currentLanguage()->code == 'lv') {{ $data->title_lv }} @else {{ $data->title }}  @endif">
    <meta name="description" content="@if (currentLanguage()->code == 'lv') {{ $data->description_lv }} @else {{ $data->description }}  @endif">
    <meta property="og:image" content="{{ $data->image_url }}" />
    <meta property="og:site_name" content="{{ config('app.name') }}">
    <meta property="og:title" content="@if (currentLanguage()->code == 'lv') {{ $data->title_lv }} @else {{ $data->title }}  @endif">
    <meta property="og:url" content="{{ route('frontend.index') }}">
    <meta property="og:type" content="article">
    <meta property="og:description" content="@if (currentLanguage()->code == 'lv') {{ $data->description_lv }} @else {{ $data->description }}  @endif">
    <meta name=twitter:card content={{ $data->image_url }} />
    <meta name=twitter:site content="{{ config('app.name') }}" />
    <meta name=twitter:url content="{{ route('frontend.index') }}" />
    <meta name=twitter:title content="@if (currentLanguage()->code == 'lv') {{ $data->title_lv }} @else {{ $data->title }}  @endif" />
    <meta name=twitter:description content="@if (currentLanguage()->code == 'lv') {{ $data->description_lv }} @else {{ $data->description }}  @endif" />
    <meta name=twitter:image content="{{ $data->image_url }}" />
@endsection
@section('content')
    <!-- ============================== breadcrumb ================================== -->
    <div class="breadcrumb mb-4">
        <div class="container">
            <div class="breadcrumb_name">
                <h3>Track Orders</h3>
            </div>
        </div>
    </div>
    <!-- ============================== breadcrumb ================================== -->

    <!-- ==============================  order details ================================== -->
    <div class="order_details pb-4 pt-0">
        <div class="container">
            <div class="row gy-4">
                <div class="col-lg-8 order-lg-2">
                    <div class="order text-center">
                        <div class="float-lg-end">
                            <img src="assets/images/mapsImg.png" class="w-100 d-none d-sm-block" alt="image">
                            <img src="assets/images/trackMap.png" class="w-100 d-block d-sm-none" alt="image">
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 order-lg-1">
                    <div class="track_order order_table mb-5">
                        <table class="table">
                            <tr>
                                <td class="cols">Order Details</td>
                            </tr>
                            <tr>
                                <td class="cols">Nike air Jordan</td>
                                <td><span>$ 7,99.00</span></td>
                            </tr>
                            <tr>
                                <td class="cols">Discount</td>
                                <td><span class="text-green">$ 2,99.00</span></td>
                            </tr>
                            <tr class="boder-bottom">
                                <td class="cols">Delivery</td>
                                <td><span class="text-green">$ 60.00</span></td>
                            </tr>
                            <tr class="total_price">
                                <td class="cols">Total</td>
                                <td><span>$ 5,99.00</span></td>
                            </tr>
                        </table>
                    </div>

                    <div class="delivery_address">
                        <div class="mb-3">
                            <h3>Delivery Address</h3>
                        </div>
                        <div class="d-flex justify-content-between">
                            <div class="">
                                <p>G/12/56 Lake Town, Kolkata</p>
                                <p>Kol-7000067</p>
                                <p>Mobile-8653138715</p>
                            </div>
                            <div class="">
                                <p>
                                    <span class="text-end d-block d-sm-none">
                                        <strong>Deliver Here</strong>
                                    </span>
                                    <span class="text-end d-block d-sm-none">Other</span>
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="step_paginate d-none d-sm-block mt-5">
                        <ul class="d-flex justify-content-between align-items-center">
                            <li class="active"><span>1</span></li>
                            <li><span>2</span></li>
                            <li><span>3</span></li>
                            <li><span>4</span></li>
                            <li>
                                <button class="btn btn-secondary">Next</button>
                            </li>
                        </ul>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- ==============================  order details ================================== -->
@endsection
