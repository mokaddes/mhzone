@extends('front.layouts.master')
@section('title', __('Home'))
@section('meta')
    @php
        $data = metaData('home');
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
    @include('front.shop_filter')

    <!-- ============================== product carousel ================================== -->
    <div class="carousel_product mb-5">
        <div class="container">
            <div class="swiper banner_product">
                <div class="swiper-wrapper main_banner">
                    <!-- product item -->
                    @if (isset($ad_banners) && $ad_banners->count() > 0)
                        @foreach ($ad_banners as $item)
                            <div class="swiper-slide">
                                <div class="carousel_item text-center text-lg-start">
                                    <div class="row gy-4 lg-gy-0">
                                        <div class="col-lg-4">
                                            <div class="product_img ">
                                                <img src="{{ asset($item->thumbnail ?? 'front/assets/images/products/2.png') }}"
                                                    alt="">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="content">
                                                <h2>{{ $item->title }}</h2>
                                                <p>
                                                    {{ $item->description }}
                                                </p>
                                                <h6>
                                                    @if ($item->attrs != null)
                                                        @foreach ($item->attrs as $attr)
                                                            {{ $attr->parent_attr->name }} |
                                                            @foreach (json_decode($attr->attr_details, true) as $key => $value)
                                                                {{ $key }} {{ $loop->last ? '' : ',' }}
                                                            @endforeach
                                                            {!! $loop->last ? '' : '<br>' !!}
                                                        @endforeach
                                                    @endif
                                                </h6>
                                                <a href="{{ route('frontend.ad.details', $item->slug) }}"
                                                    class="btn btn-primary">Explore</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="price text-center text-lg-end mt-4 mt-lg-0">
                                        <div class="price_old">
                                            <h6>
                                                <span class="old_price">$ {{ $item->price }}</span>
                                                <span>{{ $item->discount }}% OFF</span>
                                            </h6>
                                        </div>
                                        <div class="current_price">
                                            <h4>$ {{ $item->price_after_discount }}</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                    <!-- product item -->

                </div>
                <div class="swiper-pagination"></div>
            </div>
        </div>
    </div>
    <!-- ============================== product carousel ================================== -->

    <!-- ============================== New Arrivals ================================== -->
    <div class="new_arrivals mb-5">
        <div class="container">
            <div class="section_title mb-4">
                <h3>New Arrivals</h3>
            </div>
            <div class="swiper arrivals_products">
                <div class="swiper-wrapper">
                    @foreach ($recent_ads as $item)
                        <div class="swiper-slide">
                            @include('front.single_product', $item)
                        </div>
                    @endforeach
                </div>
                <div class="swiper-pagination"></div>
            </div>
        </div>
    </div>
    <!-- ============================== New Arrivals ================================== -->

    @if (isset($deal_of_the_day))
        <!-- ============================== Deal of the day ================================== -->
        <div class="deal_section mb-5">
            <div class="container">
                <div class="section_title mb-4">
                    <h3>Deal of The Day</h3>
                </div>
                <div class="deal_products carousel_product">
                    <div class="carousel_item text-center text-lg-start">

                        <div class="row gy-4 lg-gy-0 align-items-center">
                            <div class="col-lg-3">
                                <div class="pro_img">
                                    <img src="{{ asset($deal_of_the_day->thumbnail ?? 'front/assets/images/products/2.png') }}"
                                        class="img-fluid" alt="">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="content text-center ps-lg-5">
                                    <h1>{{ $deal_of_the_day->title }}</h1>
                                    <p>
                                        {{ $deal_of_the_day->description }}
                                    </p>
                                    <h6>
                                        @if ($deal_of_the_day->attrs != null)
                                            @foreach ($deal_of_the_day->attrs as $attr)
                                                {{ $attr->parent_attr->name }} |
                                                @foreach (json_decode($attr->attr_details, true) as $key => $value)
                                                    {{ $key }} {{ $loop->last ? '' : ',' }}
                                                @endforeach
                                                {!! $loop->last ? '' : '<br>' !!}
                                            @endforeach
                                        @endif
                                    </h6>
                                    <a href="{{ route('frontend.ad.details', $deal_of_the_day->slug) }}"
                                        class="btn btn-primary">Explore</a>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                @if (isset($deal_of_the_day->discount))
                                    <div class="discount_tag align-items-center text-center text-lg-end">
                                        <h1>{{ $deal_of_the_day->discount }}% OFF </h1>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- ============================== Deal of the day ================================== -->
    @endif
@endsection

@push('css')
    <style>
        .main_banner img {
            height: 250px !important;
        }
    </style>
@endpush
@push('js')
@endpush
