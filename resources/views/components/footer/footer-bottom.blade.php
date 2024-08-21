@php
    $categories = Modules\Category\Entities\Category::where('status', 1)->get();
    $cms = DB::table('cms')->first();
@endphp
<footer class="footer_section">
    <div class="container">
        <!-- footer widgets -->
        <div class="row g-0 justify-content-between footer_widgets">
            <div class="col-lg-9">
                <div class="row g-0 justify-content-between">
                    <div class="col-lg-3 col-md-12">
                        <div class="footer_widget logo_widget mt_60">
                            <a href="{{ route('frontend.index') }}" class="footer_logo mb-5"><img
                                    src="{{ asset('frontend') }}//footer-logo.svg" alt="" class="img-fluid"></a>
                            <ul class="social_links">
                                <li class="me-4"><a href="{{ $settings->facebook }}" target="_blank"><i
                                            class="fab fa-facebook-f"></i></a></li>
                                <li><a href="mailto:{{ $settings->gmail }}" target="_blank"><i
                                            class="fa fa-envelope"></i></a>
                                </li>
                                <br>
                                <br>
                                <li class="me-4"><a href="{{ $settings->instagram }}" target="_blank"><i
                                            class="fa-brands fa-instagram"></i></a></li>
                                <li><a href="{{ $settings->tiktok }}" target="_blank"><i
                                            class="fa-brands fa-tiktok"></i></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-3 mt-4 mt-lg-0">
                        <div class="footer_widget mt_60">
                            <h4>
                                <font style="vertical-align: inherit;">
                                    <font style="vertical-align: inherit;">{{ __('categories') }}</font>
                                </font>
                            </h4>
                            <ul class="footer_links">
                                @foreach ($categories as $category)
                                    <li>
                                        <a
                                            href="{{ route('frontend.adlist.search', ['category' => $category->slug]) }}">
                                            {{ __($category->name) }}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-4 mt-4 mt-lg-0">
                        <div class="footer_widget mt_60">
                            <h4>
                                <font style="vertical-align: inherit;">
                                    <font style="vertical-align: inherit;">{{ __('quick_links') }}</font>
                                </font>
                            </h4>
                            <ul class="footer_links">
                                <li><a href="{{ route('frontend.about') }}"
                                        style="text-transform: uppercase;">{{ __('about_us') }}</a></li>
                                <li><a href="{{ route('frontend.adlist') }}"
                                        style="text-transform: uppercase;">{{ __('shop') }}</a></li>
                                <li><a href="{{ route('frontend.blog') }}"
                                        style="text-transform: uppercase;">{{ __('blog') }}</a></li>
                                <li><a href="{{ route('frontend.faq') }}"
                                        style="text-transform: uppercase;">{{ __('faq') }}</a></li>
                                <li><a href="{{ route('frontend.privacy') }}"
                                        style="text-transform: uppercase;">{{ __('privacy_policy') }}</a></li>
                                <li><a href="{{ route('frontend.terms') }}"
                                        style="text-transform: uppercase;">{{ __('terms_conditions') }}</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 mt-4 mt-lg-0">
                        <div class="footer_widget mt_60">
                            <h4>
                                <font style="vertical-align: inherit;">
                                    <font style="vertical-align: inherit;">{{ __('contact') }}</font>
                                </font>
                            </h4>
                            <ul class="footer_links">
                                <li class="mb-2" style="text-transform: uppercase;">
                                    <span>{{ __('phone_number') }}</span>
                                    <a href="tel:{{ $cms->contact_number }}">
                                        <strong>{{ $cms->contact_number }}</strong>
                                    </a>
                                </li>
                                <li class="mb-2" style="text-transform: uppercase;">
                                    <span>{{ __('email') }}:</span>
                                    <a href="mailto:{{ $cms->contact_email }}">
                                        <span><strong>{{ $cms->contact_email }}</strong></span>
                                    </a>
                                </li>
                                <li class="address" style="text-transform: uppercase;">
                                    {{ $cms->contact_address }}
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 mt-4 mt-lg-0">
                <div class="footer_widget mt_60">
                    <h4>{{ __('subscribe_for_newsletter') }}</h4>
                    <p class="mb-4">
                        <font style="vertical-align: inherit;">
                            <font style="vertical-align: inherit;">
                                {{ __('subscribe_us') }}
                            </font>
                        </font>
                    </p>
                    <form class="subs_form" action="{{ route('newsletter.subscribe') }}" method="POST">
                        @csrf
                        <div class="input-group">
                            <input type="email" name="sub_email" id="email" class="form-control"
                                placeholder="{{ __('subscribe') }}" required>

                            <button type="submit" class="btn btn-outline-dark input-group-text">
                                {{-- <i class="fas fa-right-to-bracket"></i> --}}
                                <i class="fa-solid fa-arrow-right fa-xl"></i>
                                {{-- <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg> --}}
                            </button>
                        </div>
                        @error('sub_email')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </form>
                </div>
            </div>
        </div>
        <!-- Copyright -->
        <div class="row align-items-center copyright">
            <div class="col-8">
                <p>2life.lv &copy; {{ date('Y') }}</p>
            </div>
            <div class="col-4 text-end">
                <img src="{{ asset('frontend') }}/cards-logos.svg" alt="" class="card_logos">
            </div>
        </div>
    </div>
</footer>
