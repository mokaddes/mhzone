@extends('admin.settings.setting-layout')

@section('title')
    {{ __('cms') }}
@endsection

@section('website-settings')
    @php
        $cms_tab = session('cms_part');
    @endphp

    <div class="card">
        <div class="card-header">
            <ul class="nav nav-pills mb-3" id="cms-pills-tab" role="tablist">
                {{-- <li class="nav-item" role="presentation">
                    <a class="nav-link {{ $cms_tab == 'home' ? 'active' : '' }}" id="home-tab" data-toggle="pill"
                        href="#cms-home" role="tab" aria-controls="home" aria-selected="false">{{ __('home') }}</a>
                </li> --}}
                {{-- <li class="nav-item" role="presentation">
                    <a class="nav-link" href="{{ route('slider.index') }}">{{ __('Slider') }}</a>
                </li> --}}
                <li class="nav-item" role="presentation">
                    <a class="nav-link active" id="about-tab" data-toggle="pill" href="#cms-about" role="tab"
                        aria-controls="about" aria-selected="true">{{ __('about') }}</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" id="terms-tab" data-toggle="pill"
                        href="#cms-terms" role="tab" aria-controls="terms"
                        aria-selected="false">{{ __('terms condition') }}
                    </a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link " id="privacy-tab" data-toggle="pill"
                        href="#cms-privacy" role="tab" aria-controls="privacy"
                        aria-selected="false">{{ __('privacy policy') }}
                    </a>
                </li>
                {{-- <li class="nav-item" role="presentation">
                    <a class="nav-link" id="posting-tab"
                        data-toggle="pill" href="#cms-posting" role="tab" aria-controls="posting"
                        aria-selected="false">{{ __('posting rules') }}
                    </a>
                </li> --}}
                {{-- <li class="nav-item" role="presentation">
                    <a class="nav-link" id="membership-tab"
                        data-toggle="pill" href="#cms-membership" role="tab" aria-controls="membership"
                        aria-selected="false">{{ __('Data Deletion') }}</a>
                </li> --}}
                <!--
                        <li class="nav-item" role="presentation">
                            <a class="nav-link {{ $cms_tab == 'price_plan' ? 'active' : '' }}" id="price-plan-tab"
                                data-toggle="pill" href="#cms-price-plan" role="tab" aria-controls="price-plan"
                                aria-selected="false">{{ __('price plan') }}</a>
                        </li>
                    -->
                <!--
                        <li class="nav-item" role="presentation">
                            <a class="nav-link {{ $cms_tab == 'blog' ? 'active' : '' }}" id="blog-tab" data-toggle="pill"
                                href="#cms-blog" role="tab" aria-controls="blog" aria-selected="false">{{ __('blog') }}</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link {{ $cms_tab == 'ads' ? 'active' : '' }}" id="ads-tab" data-toggle="pill"
                                href="#cms-ads" role="tab" aria-controls="ads" aria-selected="false">{{ __('ads') }}</a>
                        </li>
                    -->

                {{-- <li class="nav-item" role="presentation">
                    <a class="nav-link " id="contact-tab" data-toggle="pill"
                        href="#cms-contact" role="tab" aria-controls="contact"
                        aria-selected="false">{{ __('contact') }}</a>
                </li> --}}
                {{-- <li class="nav-item" role="presentation">
                    <a class="nav-link {{ $cms_tab == 'faq' ? 'active' : '' }}" id="faq-tab" data-toggle="pill"
                        href="#cms-faq" role="tab" aria-controls="faq"
                        aria-selected="false">{{ __('faqs') }}</a>
                </li> --}}

                <!-- <li class="nav-item" role="presentation">
                        <a class="nav-link " id="dashboard-tab"
                            data-toggle="pill" href="#cms-dashboards" role="tab" aria-controls="dashboard"
                            aria-selected="false">{{ __('dashboards') }}</a>
                    </li> -->

                {{-- <li class="nav-item" role="presentation">
                    <a class="nav-link {{ $cms_tab == 'auth' ? 'active' : '' }}" id="auth-tab" data-toggle="pill"
                        href="#cms-auth" role="tab" aria-controls="auth"
                        aria-selected="false">{{ __('login_or_register') }}</a>
                </li> --}}
                {{-- <li class="nav-item" role="presentation">
                    <a class="nav-link" id="c_soon-tab" data-toggle="pill"
                        href="#cms-c_soon" role="tab" aria-controls="c_soon"
                        aria-selected="false">{{ __('coming soon') }}</a>
                </li> --}}
                {{-- <li class="nav-item" role="presentation">
                    <a class="nav-link " id="maintenance-tab"
                        data-toggle="pill" href="#cms-maintenance" role="tab" aria-controls="maintenance"
                        aria-selected="false">{{ __('maintenance') }}</a>
                </li> --}}
                {{-- <li class="nav-item" role="presentation">
                    <a class="nav-link " id="errorpages-tab"
                        data-toggle="pill" href="#cms-errorpages" role="tab" aria-controls="errorpages"
                        aria-selected="false">{{ __('error pages') }}</a>
                </li> --}}
            </ul>
        </div>
        <div class="card-body">
            <div class="tab-content" id="cms-pills-tabContent">
                {{-- Home Settings --}}
                {{-- <div class="tab-pane fade  {{ $cms_tab == 'home' ? 'show active' : '' }}" id="cms-home"
                    role="tabpanel" aria-labelledby="home-tab">
                    <x-backend.setting.cms.home-setting :cms="$cms" />
                </div> --}}

                {{-- About Settings --}}
                <div class="tab-pane fade show active" id="cms-about" role="tabpanel" aria-labelledby="about-tab">
                    <x-backend.setting.cms.about-setting :aboutcontent="$cms->about_body" :aboutVideoThumb="$cms->about_video_thumb" :aboutBackground="$cms->about_background" />
                </div>

                {{-- Terms Settings --}}
                <div class="tab-pane fade " id="cms-terms" role="tabpanel"
                    aria-labelledby="terms-tab">
                    <x-backend.setting.cms.terms-condition-setting :terms="$cms->terms_body" :termsBackground="$cms->terms_background" />
                </div>

                {{-- Privacy Settings --}}
                <div class="tab-pane fade " id="cms-privacy"
                    role="tabpanel" aria-labelledby="posting-tab">
                    <x-backend.setting.cms.privacy-policy-setting :privacy="$cms->privacy_body" :privacyBackground="$cms->privacy_background" />
                </div>

                {{-- Posting Rules Settings --}}
                <div class="tab-pane fade " id="cms-posting"
                    role="tabpanel" aria-labelledby="posting-tab">
                    <x-backend.setting.cms.posting-rules-setting :rules="$cms->posting_rules_body" :postingRulesBackground="$cms->posting_rules_background" />
                </div>

                {{-- Membership --}}
                <div class="tab-pane fade " id="cms-membership"
                    role="tabpanel" aria-labelledby="membership-tab">
                    <x-backend.setting.cms.membership :cms="$cms" />
                </div>
                {{-- Pricing Plan --}}
                <div class="tab-pane fade " id="cms-price-plan"
                    role="tabpanel" aria-labelledby="price-plan-tab">
                    <x-backend.setting.cms.pricing-plan :cms="$cms" />
                </div>
                {{-- Blog --}}
                <div class="tab-pane fade " id="cms-blog" role="tabpanel"
                    aria-labelledby="blog-tab">
                    <x-backend.setting.cms.blog :cms="$cms" />
                </div>
                {{-- Ads --}}
                <div class="tab-pane fade " id="cms-ads" role="tabpanel"
                    aria-labelledby="ads-tab">
                    <x-backend.setting.cms.ads :cms="$cms" />
                </div>
                {{-- Contact --}}
                <div class="tab-pane fade" id="cms-contact"
                    role="tabpanel" aria-labelledby="contact-tab">
                    <x-backend.setting.cms.contact :cms="$cms" />
                </div>
                {{-- Faq --}}
                {{-- <div class="tab-pane fade {{ $cms_tab == 'faq' ? 'show active' : '' }}" id="cms-faq" role="tabpanel"
                    aria-labelledby="faqs-tab">
                    <x-backend.setting.cms.faqs :cms="$cms" />
                </div> --}}
                {{-- Dashboard --}}
                <div class="tab-pane fade " id="cms-dashboards"
                    role="tabpanel" aria-labelledby="dashboards-tab">
                    <x-backend.setting.cms.dashboards :cms="$cms" />
                </div>
                {{-- Login / Register --}}
                <div class="tab-pane fade " id="cms-auth" role="tabpanel"
                    aria-labelledby="auth-tab">
                    <x-backend.setting.cms.auth :cms="$cms" />
                </div>
                {{-- Coming soon --}}
                <div class="tab-pane fade " id="cms-c_soon"
                    role="tabpanel" aria-labelledby="c_soon-tab">
                    <x-backend.setting.cms.csoon :cms="$cms" />
                </div>
                {{-- maintenance --}}
                <div class="tab-pane fade " id="cms-maintenance"
                    role="tabpanel" aria-labelledby="maintenance-tab">
                    <x-backend.setting.cms.maintanace :cms="$cms" />
                </div>
                {{-- error page --}}
                <div class="tab-pane fade " id="cms-errorpages"
                    role="tabpanel" aria-labelledby="errorpages-tab">
                    <x-backend.setting.cms.errorpages :cms="$cms" />
                </div>
            </div>
        </div>
    </div>
@endsection

@section('style')
    <link rel="stylesheet" href="{{ asset('backend') }}/css/dropify.min.css" />

    <style>
        .ck-editor__editable_inline {
            min-height: 170px;
        }
    </style>
@endsection

@section('script')
    <script src="{{ asset('backend') }}/js/dropify.min.js"></script>
    <script src="{{ asset('backend') }}/dist/js/ckeditor.js"></script>
    <script>
        ClassicEditor
            .create(document.querySelector('#about_ck'))
            .catch(error => {
                console.error(error);
            });

        ClassicEditor
            .create(document.querySelector('#terms_ck'))
            .catch(error => {
                console.error(error);
            });

        ClassicEditor
            .create(document.querySelector('#rules'))
            .catch(error => {
                console.error(error);
            });
        ClassicEditor
            .create(document.querySelector('#privacy_ck'))
            .catch(error => {
                console.error(error);
            });

        ClassicEditor
            .create(document.querySelector('#dataDeletion'))
            .catch(error => {
                console.error(error);
            });

        ClassicEditor
            .create(document.querySelector('#dataDeletion_lt'))
            .catch(error => {
                console.error(error);
            });

        ClassicEditor
            .create(document.querySelector('#about_ck_lt'))
            .catch(error => {
                console.error(error);
            });
            ClassicEditor
            .create(document.querySelector('#about_ck_vission'))
            .catch(error => {
                console.error(error);
            });
            ClassicEditor
            .create(document.querySelector('#about_ck_core_values'))
            .catch(error => {
                console.error(error);
            });
            ClassicEditor
            .create(document.querySelector('#about_ck_purpose'))
            .catch(error => {
                console.error(error);
            });
        ClassicEditor
            .create(document.querySelector('#terms_body_lt'))
            .catch(error => {
                console.error(error);
            });
        ClassicEditor
            .create(document.querySelector('#privacy_body_lt'))
            .catch(error => {
                console.error(error);
            });
        ClassicEditor
            .create(document.querySelector('#rules_body_lt'))
            .catch(error => {
                console.error(error);
            });

        $('.dropify').dropify();
    </script>
@endsection
