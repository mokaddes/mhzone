@extends('front.layouts.master')
@section('title', __('About & Us'))
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
    {{-- <div class="breadcrumb mb-3 mb-sm-5">
        <div class="container">
            <div class="breadcrumb_name">
                <h3 class="d-none d-sm-block">Terms & Conditions</h3>
                <h3 class="d-block d-sm-none">Terms & Conditions</h3>
            </div>
        </div>
    </div> --}}
    <!-- ============================== breadcrumb ================================== -->

    <!-- ============================== privacy policy ================================== -->
    <div class="privacy_policy_sec">
        <div class="container">
            <div class="custome_page_content">
                <div class="about">
                    <h4>{{ $cms->about_title }}</h4>
                    <p>{!! $cms->about_body !!}</p>
                </div>
                <div class="time-line py-5">
                    <div class="main-timeline-2">
                        <div class="timeline-2 left-2">
                            <div class="card">
                                <div class="card-body">
                                    <img src="{{ asset($setting->logo_image) }}" alt="" width="50px"
                                        height="50px">
                                </div>
                            </div>
                        </div>
                        <div class="timeline-2 right-2">
                            <div class="card">
                                <div class="card-body">
                                    <p style="font-weight: bold">Mission:</p>
                                    <p style="font-weight: bold">{{ $cms->mission_title }}</p>
                                    <p class="">{!! $cms->mission_body !!}</p>
                                </div>
                            </div>
                        </div>
                        <div class="timeline-2 left-2">
                            <div class="card">
                                <div class="card-body">
                                    <p style="font-weight: bold">Vission:</p>
                                    <p style="font-weight: bold">{{ $cms->vission_title }}</p>
                                    <p class="">{!! $cms->vission_body !!}</p>
                                </div>
                            </div>
                        </div>
                        <div class="timeline-2 right-2">
                            <div class="card">
                                <div class="card-body">
                                    <img src="{{ asset($setting->logo_image) }}" alt="" width="50px"
                                        height="50px">
                                </div>
                            </div>
                        </div>
                        <div class="timeline-2 left-2">
                            <div class="card">
                                <div class="card-body">
                                    <p style="font-weight: bold">CORE VALUES:</p>
                                    <p style="font-weight: bold">{{ $cms->core_value_title }}</p>
                                    <p class="">{!! $cms->core_value_body !!}</p>
                                </div>
                            </div>
                        </div>

                        <div class="timeline-2 right-2">
                            <div class="card">
                                <div class="card-body">
                                    <p style="font-weight: bold">Purpose:</p>
                                    <p style="font-weight: bold">{{ $cms->purpose_title }}</p>
                                    <p class="">{!! $cms->purpose_body !!}</p>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ============================== privacy policy ================================== -->
@endsection
@push('css')
    <style>
        .about {
            background-color: #1A1E24;
            border: 1px solid #1A1E24;
            border-radius: 10px;
        }

        .about h4 {
            text-align: center;
            padding: 10px;
        }

        .about p {
            text-align: justify;
            margin: 20px;
            color: #ddd
        }

        .time-line {
            width: 100%;
            margin: 20px;
        }

        .custome_page_content p {

            margin-top: 0px !important;
        }

        /* The actual timeline (the vertical ruler) */
        .main-timeline-2 {
            position: relative;
        }

        /* The actual timeline (the vertical ruler) */
        .main-timeline-2::after {
            content: "";
            position: absolute;
            width: 1px;
            background-color: #e7e7e7;
            top: 0;
            bottom: 0;
            left: 50%;
            margin-left: -2px;
        }

        /* Container around content */
        .timeline-2 {
            position: relative;
            background-color: inherit;
            width: 50%;
        }

        /* The circles on the timeline */
        .timeline-2::after {
    content: "";
    position: absolute;
    width: 16px;
    height: 16px;
    right: -6px;
    background-color: #d2d2d2;
    top: 0px;
    border-radius: 5px;
    z-index: 1;
}
        .card {
            border: none !important;
        }

        .card-body {
            border: none !important;
            box-shadow: none !important;
            outline: none !important;
            background: rgb(226 230 235 / 25%);
            border-radius: 6px;
            height: 100% !important;
        }

        /* Place the container to the left */
        .left-2 {
            padding: 0px 40px 20px 0px;
            left: 0;
        }

        /* Place the container to the right */
        .right-2 {
            padding: 0px 0px 20px 40px;
            left: 50%;
        }

        /* Add arrows to the left container (pointing right) */
        .left-2::before {
            content: " ";
            position: absolute;
            top: 18px;
            z-index: 1;
            right: 30px;
            border: medium solid white;
            border-width: 10px 0 10px 10px;
            border-color: transparent transparent transparent white;
        }

        /* Add arrows to the right container (pointing left) */
        .right-2::before {
            content: " ";
            position: absolute;
            top: 18px;
            z-index: 1;
            left: 30px;
            border: medium solid white;
            border-width: 10px 10px 10px 0;
            border-color: transparent white transparent transparent;
        }

        /* Fix the circle for containers on the right side */
        .right-2::after {
    left: -10px;
}
        /* Media queries - Responsive timeline on screens less than 600px wide */
        @media screen and (max-width: 600px) {

            /* Place the timelime to the left */
            .main-timeline-2::after {
                left: 31px;
            }

            /* Full-width containers */
            .timeline-2 {
                width: 100%;
                padding-left: 70px;
                padding-right: 25px;
            }

            /* Make sure that all arrows are pointing leftwards */
            .timeline-2::before {
                left: 60px;
                border: medium solid white;
                border-width: 10px 10px 10px 0;
                border-color: transparent white transparent transparent;
            }

            /* Make sure all circles are at the same spot */
            .left-2::after,
            .right-2::after {
                left: 18px;
            }

            .left-2::before {
                right: auto;
            }

            /* Make all right containers behave like the left ones */
            .right-2 {
                left: 0%;
            }
        }
    </style>
@endpush
@push('js')
@endpush
