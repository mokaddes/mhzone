@extends('front.layouts.master')

@section('title', '404')

@section('content')
    <!-- breedcrumb section start  -->
    {{-- <section class="breedcrumb"
        style="background: url('{{ asset('frontend/images/bg/bg-04.jpg') }}') center center/cover no-repeat;">
        <div class="container">
            <h2 class="breedcrumb__title text--heading-2">{{ __('404') }}</h2>
            <ul class="breedcrumb__page">
                <li class="breedcrumb__page-item">
                    <a href="{{ route('frontend.index') }}" class="breedcrumb__page-link text--body-3">{{ __('home') }}</a>
                </li>
                <li class="breedcrumb__page-item">
                    <a href="#" class="breedcrumb__page-link text--body-3">/</a>
                </li>
                <li class="breedcrumb__page-item">
                    <a href="#" class="breedcrumb__page-link text--body-3">{{ __('404') }}</a>
                </li>
            </ul>
        </div>
    </section> --}}
    <!-- breedcrumb section end  -->

    <!-- Error section start  -->
    <section class="section error text-center">
        <div class="container">
            <div class="error__img-wrapper">
                <img src="{{ asset($cms->e404_image) }}" alt="error" />
            </div>
            <h2 class="error__title text--heading-1">{{ __($cms->e404_title) }}</h2>
            <p class="error__brief text--body-3">
                {{ __($cms->e404_subtitle) }}
            </p>
            <a href="/" class="error__back-btn btn">
                <span class="icon--left">
                    <x-svg.left-arrow-icon stroke="white" />
                </span>
                {{ __('go back home') }}
            </a>
            <a href="{{ url()->previous() }}" class="error__back-btn btn">
                <span class="icon--left">
                    <x-svg.left-arrow-icon stroke="white" />
                </span>
                {{ __('back') }}
            </a>
        </div>
    </section>
    <!-- Error section end   -->
@endsection
