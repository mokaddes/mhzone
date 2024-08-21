@extends('front.layouts.master')
@section('title', __('Privacy Policy'))
@section('meta')
    @php
        $data = metaData('home');
    @endphp
    <meta name="title"
          content="@if (currentLanguage()->code == 'lv') {{ $data->title_lv }} @else {{ $data->title }}  @endif">
    <meta name="description"
          content="@if (currentLanguage()->code == 'lv') {{ $data->description_lv }} @else {{ $data->description }}  @endif">
    <meta property="og:image" content="{{ $data->image_url }}"/>
    <meta property="og:site_name" content="{{ config('app.name') }}">
    <meta property="og:title"
          content="@if (currentLanguage()->code == 'lv') {{ $data->title_lv }} @else {{ $data->title }}  @endif">
    <meta property="og:url" content="{{ route('frontend.index') }}">
    <meta property="og:type" content="article">
    <meta property="og:description"
          content="@if (currentLanguage()->code == 'lv') {{ $data->description_lv }} @else {{ $data->description }}  @endif">
    <meta name=twitter:card content={{ $data->image_url }} />
    <meta name=twitter:site content="{{ config('app.name') }}"/>
    <meta name=twitter:url content="{{ route('frontend.index') }}"/>
    <meta name=twitter:title
          content="@if (currentLanguage()->code == 'lv') {{ $data->title_lv }} @else {{ $data->title }}  @endif"/>
    <meta name=twitter:description
          content="@if (currentLanguage()->code == 'lv') {{ $data->description_lv }} @else {{ $data->description }}  @endif"/>
    <meta name=twitter:image content="{{ $data->image_url }}"/>
@endsection
@section('content')
    <!-- ============================== breadcrumb ================================== -->
    <div class="breadcrumb mb-3 mb-sm-5">
        <div class="container">
            <div class="breadcrumb_name">
                <h3 class="d-none d-sm-block">Privacy Policy</h3>
                <h3 class="d-block d-sm-none">Privacy Policy</h3>
            </div>
        </div>
    </div>
    <!-- ============================== breadcrumb ================================== -->

    <!-- ============================== privacy policy ================================== -->
    <div class="privacy_policy_sec">
        <div class="container">
            <div class="custome_page_content">
                <p>{!! $cms->privacy_body !!}</p>




            </div>
        </div>
    </div>
    <!-- ============================== privacy policy ================================== -->
@endsection

@push('js')

@endpush
