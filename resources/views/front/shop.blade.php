@extends('front.layouts.master')
@section('title', __('Shop'))
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
    <meta name=twitter:card content={{ $data->image_url }} />
    <meta name=twitter:site content="{{ config('app.name') }}" />
    <meta name=twitter:url content="{{ route('frontend.index') }}" />
    <meta name=twitter:title
        content="@if (currentLanguage()->code == 'lv') {{ $data->title_lv }} @else {{ $data->title }} @endif" />
    <meta name=twitter:description
        content="@if (currentLanguage()->code == 'lv') {{ $data->description_lv }} @else {{ $data->description }} @endif" />
    <meta name=twitter:image content="{{ $data->image_url }}" />
@endsection
@section('content')

    <!-- ============================== breadcrumb ================================== -->
    <div class="breadcrumb mb-4">
        <div class="container">
            <div class="breadcrumb_name">
                <h3>Shop</h3>
            </div>
        </div>
    </div>
    <!-- ============================== breadcrumb ================================== -->

    <!-- ============================== shop ================================== -->
    <div class="shop-sec mb-4">
        <div class="container">
            <div class="row gy-3 xl-gy-0">
                <div class="col-xl-3 d-none d-xl-block">
                    <!-- shop sidebar -->
                    <div class="shop_sidebar sticky-top" style="top:2rem;">
                        <form action="{{ route('frontend.shop', request('department') ?? '') }}" method="get" id="adFilterForm">
                            <div class="shop-wrapper">
                                @include('front.shop_sidebar', [$departments, $categories])
                            </div>
                        </form>
                    </div>
                </div>

                <div class="col-xl-9">
                    <!-- shop header -->
                    <div class="shop-header mb-4">
                        <div class="d-sm-flex align-items-center justify-content-between">
                            <div class="count-product text-center text-sm-start mb-3 mb-sm-0">
                                <div class="d-flex justify-content-between sm:justify-content-center align-items-center">
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

                    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 row-cols-xl-4 gy-3">
                        @foreach ($ads as $item)
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


    {{-- offcanvas shop filter --}}
    <div class="offcanvas_shop offcanvas offcanvas-start d-block d-xl-none" tabindex="-1" id="shopFilter"
        aria-labelledby="shopFilterLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="shopFilterLabel">Shop Filter</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <div class="shop_sidebar">
                <div class="shop-wrapper">
                <form action="{{ route('frontend.shop') }}" method="get" id="adFilterForm">
                    @include('front.shop_sidebar')
                </form>
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


