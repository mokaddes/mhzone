@extends('front.layouts.master')
@section('title', __('Seller Shop'))
@section('meta')
    @php
        $data = metaData('login');
    @endphp
    <meta name="title"
          content="@if (currentLanguage()->code == 'lv') {{ $data->title_lv }} @else {{ $data->title }} @endif">
    <meta name="description"
          content="@if (currentLanguage()->code == 'lv') {{ $data->description_lv }} @else {{ $data->description }} @endif">
    <meta property="og:image" content="{{ $data->image_url }}"/>
    <meta property="og:site_name" content="{{ config('app.name') }}">
    <meta property="og:title"
          content="@if (currentLanguage()->code == 'lv') {{ $data->title_lv }} @else {{ $data->title }} @endif">
    <meta property="og:url" content="{{ route('frontend.index') }}">
    <meta property="og:type" content="article">
    <meta property="og:description"
          content="@if (currentLanguage()->code == 'lv') {{ $data->description_lv }} @else {{ $data->description }} @endif">
    <meta name=twitter:card content="{{ $data->image_url }}" />
    <meta name=twitter:site content="{{ config('app.name') }}"/>
    <meta name=twitter:url content="{{ route('frontend.index') }}"/>
    <meta name=twitter:title
          content="@if (currentLanguage()->code == 'lv') {{ $data->title_lv }} @else {{ $data->title }} @endif"/>
    <meta name=twitter:description
          content="@if (currentLanguage()->code == 'lv') {{ $data->description_lv }} @else {{ $data->description }} @endif"/>
    <meta name=twitter:image content="{{ $data->image_url }}"/>
@endsection
@section('content')
    <!-- ============================== breadcrumb ================================== -->
    <div class="breadcrumb mb-4">
        <div class="container">
            <div class="breadcrumb_name">
                <h3>Seller Shop</h3>
            </div>
        </div>
    </div>
    <!-- ============================== breadcrumb ================================== -->

    <!-- ============================== shop ================================== -->
    <div class="shop-sec mb-4">
        <div class="container">
            <div class="row gy-3 xl-gy-0">
                <div class="col-xl-3 d-none d-xl-block">

                    <div class="shop_wrap mb-4">
                        <div class="seller-profile position-relative">
                            <div class="text-center">
                                <div class="seller-img profile_logo mb-1">
                                    <img src="{{ asset($user->image ?? 'front/assets/images/profile.png') }}" width="50"
                                         alt="user name">
                                </div>
                                <div class="seller-info">
                                    <h4 class="mb-2">{{ $user->name }}</h4>
                                    <p>
                                        <i class="la la-phone"></i>
                                        <a href="tel:{{ $user->phone }}">{{ $user->phone }}</a>
                                    </p>
                                    <p>
                                        <i class="la la-envelope"></i>
                                        <a href="mailto:{{ $user->email }}">{{ $user->email }}</a>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- shop sidebar -->
                    <div class="shop_sidebar sticky-top" style="top:2rem;">
                        <form action="{{ route('frontend.seller.shop', [$seller_shop->slug , request('department') ?? '']) }}" method="get" id="adFilterForm">
                            <div class="shop-wrapper">
                                @include('front.shop_sidebar', [$user,$departments, $categories, $seller_shop ])
                            </div>
                        </form>
                    </div>
                </div>

                <div class="col-xl-9">
                    {{-- seller shop banner --}}
                    <div class="seller-shop-banner align-items-center"
                         style="background-image:url('{{ asset($seller_shop->banner ?? 'frontend/seller-shop/bg1.jpg') }}')
                        ">
                        <div class="banner-info">
                            <div class="seller-profile d-flex justify-content-between position-relative">
                                <div class="d-flex align-items-center ">
                                    <div class="seller-img profile_logo me-3">
                                        @if($seller_shop->logo)
                                            <img src="{{ asset($seller_shop->logo) }}" width="50"
                                                 alt="user name">
                                        @else
                                            <img src="{{ asset('front/assets/images/profile.png') }}" width="50"
                                                 alt="user name">
                                        @endif

                                    </div>
                                    <div class="seller-info">
                                        <h4 style="font-size: 20px">{{ $seller_shop->name }}</h4>
                                        <span class="text-white">{{ $seller_shop->location }}</span>
                                        <br>
                                        <span>{{ $ads->total() }} items for sale</span>
                                    </div>
                                </div>
                                @if(is_seller() && Auth::user()->id == $seller_shop->user_id)
                                    <div class="d-flex align-items-center ">
                                        <button class="btn btn-sm btn-primary" data-bs-toggle="modal"
                                                data-bs-target="#shopEditModal"><i class="la la-edit"
                                                                                   style="font-size: 20px"></i></button>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <!-- shop header -->
                    <div class="shop-header mb-4">
                        <div class="d-sm-flex align-items-center justify-content-between">
                            <div class="count-product text-center text-sm-start mb-3 mb-sm-0">
                                <div
                                    class="d-flex justify-content-between sm:justify-content-center align-items-center">
                                    {{-- offcanvas shop filter button --}}
                                    <div class="d-block d-xl-none me-2">
                                        <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas"
                                                href="#shopFilter" role="button" aria-controls="shopFilter">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                                 viewBox="0 0 24 24" fill="none" stroke="#000000" stroke-width="1.5"
                                                 stroke-linecap="square" stroke-linejoin="bevel">
                                                <line x1="4" y1="21" x2="4" y2="14"></line>
                                                <line x1="4" y1="10" x2="4" y2="3"></line>
                                                <line x1="12" y1="21" x2="12" y2="12"></line>
                                                <line x1="12" y1="8" x2="12" y2="3"></line>
                                                <line x1="20" y1="21" x2="20" y2="16"></line>
                                                <line x1="20" y1="12" x2="20" y2="3"></line>
                                                <line x1="1" y1="14" x2="7" y2="14"></line>
                                                <line x1="9" y1="8" x2="15" y2="8"></line>
                                                <line x1="17" y1="16" x2="23" y2="16"></line>
                                            </svg>
                                        </button>
                                    </div>
                                    <div>
                                        <p class="m-0">{{ $ads->total() }} items Available Listings</p>
                                    </div>
                                </div>
                            </div>
                            <div class="filter_short">
                                <form action="#" method="post">
                                    <div class="input-group">
                                        <span class="input-group-text">Sort By:</span>
                                        <select name="sort" id="sort" class="form-control form-select sort_select">
                                            <option value="" class="d-none">Select</option>
                                            <option value="recent" {{ request('sort') == 'recent' ? 'selected' : '' }}>Recent ads</option>
                                            <option value="high_to_low" {{ request('sort') == 'high_to_low' ? 'selected' : '' }}>Price high to low</option>
                                            <option value="low_to_high" {{ request('sort') == 'low_to_high' ? 'selected' : '' }}>Price low to high</option>
                                        </select>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 gy-3">

                        <!-- product -->
                        @foreach($ads as $item)
                            <div class="col">
                                @include('front.single_product', $item)
                            </div>
                        @endforeach
                    </div>

                    <!-- pagination -->
                    <div class="pagination_nav mt-4">
                        <nav aria-label="Page navigation example">
                            <ul class="pagination justify-content-center">
                                {{ $ads->withQueryString()->links() }}
                            </ul>
                        </nav>
                    </div>
                    <!-- pagination -->

                </div>
            </div>
        </div>
    </div>
    <!-- ============================== shop ================================== -->

    <div class="offcanvas_shop offcanvas offcanvas-start d-block d-xl-none" tabindex="-1" id="shopFilter"
         aria-labelledby="shopFilterLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="shopFilterLabel">Shop Filter</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <div class="shop_sidebar">
                <form action="{{ route('frontend.seller.shop', [$seller_shop->slug , request('department') ?? '']) }}" method="get" id="adFilterForm">
                    <div class="shop-wrapper">
                        @include('front.shop_sidebar')
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="shopEditModal" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false"
         aria-labelledby="shopEditModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="shopEditModalLabel">Edit Shop</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('frontend.user.shopUpdate', $seller_shop->id) }}" method="post"
                          enctype="multipart/form-data">
                        @csrf
                        <div class="form-group mb-4">
                            <label for="shop_name" class="form-label text-start">Shop Name</label>
                            <input type="text" name="name" id="name" class="form-control"
                                   value="{{ old('name') ?? $seller_shop->name }}" placeholder="Enter shop name"
                                   required style="line-height: 30px;">
                        </div>
                        <div class="form-group mb-4">
                            <label for="shop_logo" class="form-label">Shop Logo <span class="text-warning">(Prefer size 250 x 250)</span>
                            </label>
                            <input type="file" name="logo" id="logo" class="form-control" accept="image/png, image/jpeg, image/jpg"
                                   style="line-height: 30px;">
                        </div>
                        <div class="form-group mb-4">
                            <label for="banner" class="form-label">Shop Banner <span class="text-warning">(Prefer size 1000 x 750)</span>
                            </label>
                            <input type="file" name="banner" id="banner" class="form-control" accept="image/png, image/jpeg, image/jpg"
                                   style="line-height: 30px;">
                        </div>
                        <div class="form-group mb-4">
                            <label for="location" class="form-label text-start">Shop location</label>
                            <input type="text" name="location" id="location" class="form-control"
                                value="{{ $seller_shop->location }}" placeholder="Enter shop location" required>
                        </div>
                        <div class="form-group mb-4">
                            <label for="return_policy" class="form-label text-start">Return Policy</label>
                            <textarea name="return_policy" id="return_policy" cols="30" rows="2" class="form-control" placeholder="Enter Return Policy">{{ $seller_shop->return_policy }}</textarea>
                        </div>
                        {{--                        <div class="form-group mb-4">--}}
                        {{--                            <label for="status" class="form-label">Status</label>--}}
                        {{--                            <select name="status" id="status" class="form-control">--}}
                        {{--                                <option value=""></option>--}}
                        {{--                            </select>--}}
                        {{--                        </div>--}}
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>

                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('js')
    <script type="text/javascript">

        $('.cat_input_check').change(function () {
            let url = $('.action_url').val();
            let cat = null;
            if ($(this).is(':checked')) {
                cat = $(this).data('department');
            }
            if (cat != null) {
                $('#adFilterForm').attr('action', url + cat);
            } else {
                $('#adFilterForm').attr('action', url);
            }
            $('#adFilterForm').submit();

        });

        function changeFilter(cat) {
            if (cat == null) {
                cat = $('.session_cat').val();
            }
            const form = $('#adFilterForm');
            const data = form.serializeArray();
            let url = $('.action_url').val();
            if (cat) {
                $('#adFilterForm').attr('action', url + cat);
            } else {
                $('#adFilterForm').attr('action', url);
            }
            $('#adFilterForm').submit();
        }

        $('.sort_select').change(function () {
            let vl = $(this).val();
            $('input[name="sort"]').val(vl);
            changeFilter()
        });

        $('.inputSearchBtn').click(function (e) {
            let ivl = $('#inputSearch').val();
            if (ivl) {
                e.preventDefault();
                $('input[name="keyword"]').val(ivl);
                changeFilter()
            }
        });

        $('#apply_btn').click(function () {
            if ($('#from_price').val() == '') {
                toastr.error('Please fill the min price field.');
                return false;
            }else if($('#to_price').val() == '') {
                toastr.error('Please fill the max price field.');
                return false;
            } else {
                changeFilter();
            }
        });
    </script>
@endpush
