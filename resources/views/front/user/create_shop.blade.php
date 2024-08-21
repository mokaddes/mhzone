@extends('front.layouts.master')

@section('title', __('Create Shop'))

@section('content')
    <!-- Sign up -->
    <div class="login_page">
        <div class="container">
            <div class="login_form signup text-center" style="position:inherit !important;">
                <div class="image_round mb-4">
                    <img src="{{  asset(Auth::user()->image ?? 'front/assets/images/profile.png') }}" class="img-fluid mb-2" alt="image">
                   <h3> Create a shop on erthoo</h3>
                </div>
                <div class="row d-flex justify-content-center mb-5">
                    <div class="col-lg-6">
                        <form action="{{ route('frontend.user.shop.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group mb-4">
                                <label for="shop_name" class="form-label text-start">Shop Name</label>
                                <input type="text" name="name" id="name" class="form-control"
                                    value="{{ old('name') }}" placeholder="Enter shop name" required>
                            </div>
                            <div class="form-group mb-4">
                                <label for="shop_logo" class="form-label">Shop Logo <span class="text-warning">(Prefer size 250 x 250)</span> </label>
                                <input type="file" name="logo" id="logo" class="form-control" required accept="image/png, image/jpeg, image/jpg"
                                    style="line-height: 50px;">
                            </div>
                            <div class="form-group mb-4">
                                <label for="banner" class="form-label">Shop Banner <span class="text-warning">(Prefer size 1000 x 750)</span> </label>
                                <input type="file" name="banner" id="banner" class="form-control" accept="image/png, image/jpeg, image/jpg"
                                    style="line-height: 50px;">
                            </div>

                            <div class="form-group mb-4">
                                <label for="location" class="form-label text-start">Shop location</label>
                                <input type="text" name="location" id="location" class="form-control"
                                    value="{{ old('location') }}" placeholder="Enter shop location" required>
                            </div>
                            <div class="form-group mb-4">
                                <label for="return_policy" class="form-label text-start">Return Policy</label>
                                <textarea name="return_policy" id="return_policy" style="height: 100px; padding: 20px" class="form-control" placeholder="Enter Return Policy">{{ old('return_policy') }}</textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection