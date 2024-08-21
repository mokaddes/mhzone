@extends('front.layouts.master')
@section('title', __('Dashboard'))
@section('content')
    <!-- ============================== user profile ================================== -->
    <div class="user_profile">
        <div class="container">
            <div class="row d-flex justify-content-center">
                <div class="col-md-7 col-lg-5 col-xl-4">
                    <div class="title text-center mb-4">
                        <div class="mb-2">
                            <img src="{{ asset(Auth::user()->image ?? 'front/assets/images/profile.png') }}" class="img-fluid rounded-circle" width="100" alt="">
                        </div>
                        <h4>Hi! {{ Auth::user()->name }}</h4>
                    </div>
                    <ul>
                        <div class="d-flex justify-content-between mb-3">
                            <div>
                                <a class="btn btn-primary" href="{{ route('frontend.user.myOrder') }}">
                                    <i class="las la-shopping-cart"></i>
                                    My Orders
                                </a>
                            </div>
                            <div>
                                <a class="btn btn-primary" href="{{ route('frontend.user.wishlist') }}">
                                    <i class="las la-heart"></i>
                                    Wish List
                                </a>
                            </div>
                        </div>

                        <p><strong>Account Settings</strong></p>
                        @if (is_seller())
                            <li>
                                <a class="dropdown-item" href="{{ route('frontend.user.myAds') }}">My Items<i
                                        class="la la-angle-right"></i></a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route('frontend.user.myShop') }}">My
                                    Shop <i class="la la-angle-right"></i></a>
                            </li>
                        @endif
                        <li>
                            <a class="dropdown-item" href="{{ route('frontend.user.profileEdit') }}">Edit Profile <i
                                    class="la la-angle-right"></i></a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="{{ route('frontend.user.card') }}">Saved Cards <i
                                    class="la la-angle-right"></i></a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="{{ route('frontend.user.address') }}">Saved Addresses <i
                                    class="la la-angle-right"></i></a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="{{ route('frontend.user.transaction') }}">Transactions <i
                                    class="la la-angle-right"></i></a>
                        </li>

                        @if (is_seller())
                            <p class="mb-1 mt-1"><strong>Earn With mhzone</strong></p>
                            <li>
                                <a class="dropdown-item" href="{{ route('frontend.post.create') }}">Sell on mhzone <i
                                        class="la la-angle-right"></i></a>
                            </li>
                        @endif
                        <div class="d-flex justify-content-between">
                            <div class="mt-3">
                                <a href="{{ route('frontend.user.switch.mode', is_seller() ? '0' : 1) }}"
                                    onclick="return confirm('Are you sure to switch {{ is_seller() ? 'Buyer Mode' : 'Seller Mode' }} ?')"
                                    class="btn btn-primary">
                                    <i class="las la-user"></i>
                                    {{ is_seller() ? 'Switch to buyer' : 'Switch to seller' }}
                                </a>
                            </div>
                            <div class=" mt-3">
                                <a href="javascript:void(0)" onclick="$('#logout-form').submit();" class="btn btn-primary">
                                    <i class="las la-sign-out-alt"></i>
                                    Log out
                                </a>
                            </div>
                        </div>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- ============================== user profile ================================== -->
@endsection
