@extends('front.layouts.master')

@section('title', __('Wishlist'))

@section('content')
    {{-- shop filter  --}}
    @include('front.shop_filter')

    <div class="breadcrumb mb-4">
        <div class="container">
            <div class="breadcrumb_name">
                <h3>Wish List</h3>
            </div>
        </div>
    </div>

    <div class="wishlist_section mb-4">
        <div class="container">
            <div class="row gy-4">
                @foreach ($items as $item)
                    <div class="col-sm-6 col-lg-4 col-xl-3" style="margin-bottom:80px;">
                        @include('front.single_product', $item)

                        <div class="wishlist_button text-center">
                            <a href="{{ route('frontend.user.remove.wishlist', $item->id) }}"
                                onclick="return confirm('Are you sure to remove from wishlist?')">
                                <img src="{{ asset('front/assets/images/icons/trash.svg') }}" alt="">
                            </a>
                            <a href="{{ route('frontend.ad.details', $item->slug) }}">
                                <img src="{{ asset('front/assets/images/icons/cart-2.svg') }}" alt="">
                            </a>
                        </div>

                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
