@extends('front.layouts.master')
@section('title', __('Help Center'))
@section('content')
    <!-- ============================== breadcrumb ================================= -->
    <div class="breadcrumb mb-5 d-none d-sm-block">
        <div class="container">
            <div class="breadcrumb_name">
                <h3>Help Center</h3>
            </div>
        </div>
    </div>
    <!-- ============================== breadcrumb ================================= -->

    <!-- ============================== help-center ================================== -->
    <div class="helpcenter-sec mb-5 mb-lg-0">
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-6">
                    <div class="faq_list">
                        <div class="accordion" id="accordionExample">
                            @if (!empty($faqs) && count($faqs) > 0)
                                @foreach ($faqs as $key => $value)
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="heading__{{ $key }}">
                                            <button class="accordion-button {{ $key == 0 ? '' : 'collapsed' }}"
                                                type="button" data-bs-toggle="collapse"
                                                data-bs-target="#collapseOne{{ $key }}" aria-expanded="true"
                                                aria-controls="collapseOne{{ $key }}">
                                                {{ $value->question }}
                                            </button>
                                        </h2>
                                        <div id="collapseOne{{ $key }}"
                                            class="accordion-collapse collapse @if ($key == 0) show @endif"
                                            data-bs-parent="#accordionExample"
                                            aria-labelledby="heading__{{ $key }}">
                                            <div class="accordion-body">
                                                <p>
                                                    {{ $value->answer }}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <form action="{{ route('frontend.contact.store') }}" method="post">
                        @csrf
                        <div class="contact_form">

                            <div class="mb-4">
                                <h4>Contact Us</h4>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group mb-4">
                                        <label for="name" class="form-label">Name <span class="text-danger">*</span>
                                        </label>
                                        <input type="text" name="name" id="name" autocomplete="off"
                                            value="{{ old('name') }}" class="form-control" placeholder="Enter your name"
                                            required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-4">
                                        <label for="name" class="form-label"> Email <span
                                                class="text-danger">*</span></label>
                                        <input type="email" name="email" id="email" autocomplete="off"
                                            value="{{ old('email') }}" class="form-control" placeholder="Enter your email"
                                            required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group mb-4">
                                <label for="subject" class="form-label">Subject <span class="text-danger">*</span></label>
                                <input type="text" name="subject" id="subject" autocomplete="off"
                                    value="{{ old('subject') }}" class="form-control" placeholder="Enter your subject"
                                    required>
                            </div>
                            <div class="form-group mb-4">
                                <label for="message" class="form-label">Message <span class="text-danger">*</span></label>
                                <textarea name="message" id="message" cols="30" rows="5" class="form-control"
                                    placeholder="Please Enter your message">{{ old('message') }}</textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Send</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- ============================== help-center ================================== -->
@endsection
