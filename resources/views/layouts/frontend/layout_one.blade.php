<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />

        @if (env('APP_MODE') == 'DEVELOPMENT')
            <meta name="robots" content="noindex">
        @endif

        <meta name="robots" content="index,follow">
        <meta name="googlebot" content="index,follow">

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

        <!-- Styles goes here -->
        @include('layouts.frontend.partials.links')

        <!-- Google tag (gtag.js) -->
        <script async src="https://www.googletagmanager.com/gtag/js?id={{ $settings->google_analytical_id }}"></script>
        <script>
            window.dataLayer = window.dataLayer || [];

            function gtag() {
                dataLayer.push(arguments);
            }
            gtag('js', new Date());

            gtag('config', '{{ $settings->google_analytical_id }}');
        </script>
        <!-- Google Tag Manager -->
        <script>
            (function(w, d, s, l, i) {
                w[l] = w[l] || [];
                w[l].push({
                    'gtm.start': new Date().getTime(),
                    event: 'gtm.js'
                });
                var f = d.getElementsByTagName(s)[0],
                    j = d.createElement(s),
                    dl = l != 'dataLayer' ? '&l=' + l : '';
                j.async = true;
                j.src =
                    'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
                f.parentNode.insertBefore(j, f);
            })(window, document, 'script', 'dataLayer', 'GTM-533VQZN');
        </script>

        <style>
            .category-menu__subdropdown__item {
                width: 270px !important;
            }

            .navigation-bar__buttons .user {
                margin: 0px 24px;
            }

            a.categories__link.active {
                color: #000 !important;
                transition: all 0.3s linear;
                font-weight: 800;
            }

            .subscribe__input-group.is-invalid {
                border: 1px solid red;
            }

            .margin-t-30px {
                margin-top: 30px;
            }

            .error-message-span {
                display: block;
                padding-left: 20px;
                padding-bottom: 10px;
            }
        </style>

        {!! $settings->header_css !!}
        {!! $settings->header_script !!}
        <link
            href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
            rel="stylesheet">
        <link rel="stylesheet" href="{{ asset('frontend/css') }}/main.css?v=2">

    </head>
    <body class="{{ auth('user')->check() && isset(session('user_plan')->ad_limit) && session('user_plan')->ad_limit < $settings->free_ad_limit ? 'wraning-show_hide' : '' }}" dir="{{ langDirection() }}">
        <!-- Google Tag Manager (noscript) -->
        <noscript>
            <iframe src="https://www.googletagmanager.com/ns.html?id=GTM-533VQZN" height="0" width="0"
                style="display:none;visibility:hidden">
            </iframe>
        </noscript>
        <!-- End Google Tag Manager (noscript) -->
        @php
            $current_route_name = request()
                ->route()
                ->getName(); // <!-- for pusher global -->
            $auth_user_gloabl = Auth::user() ? Auth::user()->id : ''; // <!-- for pusher global -->
        @endphp
        <!-- Top bar start  -->
        @if (auth('user')->check() &&
                isset(session('user_plan')->ad_limit) &&
                session('user_plan')->ad_limit < $settings->free_ad_limit)
            @include('layouts.frontend.partials.top-bar')
        @endif
        <!-- loader start  -->
        @if (setting('website_loader'))
            @include('layouts.frontend.partials.loader')
        @endif

        @if (request()->is('dashboard') || request()->is('dashboard/*'))
            <x-header.home-header />
        @else
            <x-header.home-header />
        @endif

        @yield('css')

        @yield('sold')

        @yield('content')
        <!-- footer section start  -->
        <x-footer.footer-top />
        <!-- Back To Top Btn Start-->
        @include('layouts.frontend.partials.back-to-top')
        <!-- Scripts goes here -->
        @include('layouts.frontend.partials.scripts')

        @yield('js')
        @stack('js')
    </body>

</html>
