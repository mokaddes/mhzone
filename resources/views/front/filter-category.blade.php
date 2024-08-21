@extends('front.layouts.master')
@section('title', __('home'))
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
    <!-- ============================== filter category ================================== -->
    <div class="product_filter_sec mb-4">
        <div class="container">
            <form action="#" method="post">
                <!-- Shop For -->
                <div class="filter_wrap mb-4">
                    <div class="row gy-4 align-items-center">
                        <div class="col-md-3">
                            <div class="filter_heading">
                                <h3>Shop For</h3>
                            </div>
                        </div>
                        <div class="col-md-9">
                            <div class="filter_button">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="category" value="men" id="men"
                                           checked>
                                    <label class="form-check-label" for="men">
                                        Men
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="category" value="women"
                                           id="women">
                                    <label class="form-check-label" for="women">
                                        Women
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Select what are you searching for -->
                <div class="filter_wrap mb-4">
                    <div class="row gy-4 align-items-center">
                        <div class="col-md-3">
                            <div class="filter_heading">
                                <h3>Select what are you searching for</h3>
                            </div>
                        </div>
                        <div class="col-md-9">
                            <div class="filter_button">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="shoes_category" value="Sneakers"
                                           id="sneakers" checked>
                                    <label class="form-check-label" for="sneakers">
                                        Sneakers
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="shoes_category" value="Boots"
                                           id="boots">
                                    <label class="form-check-label" for="boots">
                                        Boots
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="shoes_category" value="sandals"
                                           id="sandals">
                                    <label class="form-check-label" for="sandals">
                                        sandals
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="shoes_category"
                                           value="Unique Footwere" id="unique_footwere">
                                    <label class="form-check-label" for="unique_footwere">
                                        Unique Footwere
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="shoes_category" value="Socks"
                                           id="socks">
                                    <label class="form-check-label" for="socks">
                                        Socks
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Select your size -->
                <div class="filter_wrap  size_filter">
                    <div class="row gy-4 align-items-center">
                        <div class="col-md-3">
                            <div class="filter_heading">
                                <h3>Select your size</h3>
                            </div>
                        </div>
                        <div class="col-md-9">
                            <div class="filter_button">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="size" value="6" id="6" checked>
                                    <label class="form-check-label" for="6">
                                        6
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="size" value="6.5" id="6.5">
                                    <label class="form-check-label" for="6.5">
                                        6.5
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="size" value="7" id="7">
                                    <label class="form-check-label" for="7">
                                        7
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="size" value="8" id="8">
                                    <label class="form-check-label" for="8">
                                        8
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="size" value="8.5" id="8.5">
                                    <label class="form-check-label" for="8.5">
                                        8.5
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="size" value="9" id="9">
                                    <label class="form-check-label" for="9">
                                        9
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="size" value="9.5" id="9.5">
                                    <label class="form-check-label" for="9.5">
                                        9.5
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="size" value="10" id="10">
                                    <label class="form-check-label" for="10">
                                        10
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="size" value="10.5" id="10.5">
                                    <label class="form-check-label" for="10.5">
                                        10.5
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="apply_btn text-center mt-5">
                    <button type="submit" class="btn btn-primary">Apply</button>
                </div>

            </form>
        </div>
    </div>
    <!-- ============================== filter category ================================== -->
@endsection
