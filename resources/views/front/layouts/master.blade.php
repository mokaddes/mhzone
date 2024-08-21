<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @if (env('APP_MODE') == 'DEVELOPMENT')
        <meta name="robots" content="noindex">
    @endif

    <meta name="robots" content="index,follow">
    <meta name="googlebot" content="index,follow">
    <meta property="developer" content="Md. Mokaddes Hosain">

    <meta property="fb:app_id" content="{{ $settings->fb_app_id }}">

    @hasSection('meta')
        @yield('meta')
    @else
        <meta property="title" content="{{ $settings->seo_meta_title }}">
        <meta property="description" content="{{ $settings->seo_meta_description }}">
        <meta property="keywords" content="{{ $settings->seo_meta_keywords }}">
        <meta property="og:image" content="{{ $settings->og_image }}">
    @endif

    <title>@yield('title') - {{ config('app.name') }}</title>

    @include('front.layouts.style')
</head>

<body>

{{--@if(!Route::is('user.login') && !Route::is('frontend.signup'))--}}
    @include('front.layouts.header')
{{--@endif--}}

@yield('content')

<div class="d-none d-sm-block">
    @include('front.layouts.footer')
</div>

@include('front.layouts.script')

</body>

</html>
