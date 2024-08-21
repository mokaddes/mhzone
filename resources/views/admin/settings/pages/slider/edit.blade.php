@extends('admin.settings.setting-layout')
@section('title')
    {{ __('Edit Slider') }}
@endsection

@section('website-settings')
    <div class="card">
        <div class="card-header">
                <div class="d-flex align-items-center justify-content-between">
                   <h3 class="card-title" style="line-height: 36px;">{{ __('Edit Slider') }}</h3>
                    <a href="{{ route('slider.index') }}" class="btn bg-primary float-right d-flex align-items-center justify-content-center"><i class="fas fa-arrow-left"></i>&nbsp; Back</a>
                </div>
            </div>
        <div class="card-body">

            <form action="{{route('slider.update',['slider'=>$slider->id])}}" method="POST" enctype="multipart/form-data">

                @csrf @method('put')
                <div class="row">

                    <div class="col-md-12">
                        <div class="form-group">
                            <x-forms.label name="Slider Image" />
                            <div class="row">
                                <input type="file" class="form-control dropify"
                                    data-default-file="{{ asset($slider->path) }}" name="image"
                                    autocomplete="image" data-allowed-file-extensions="jpg png jpeg"
                                    accept="image/png, image/jpg, image/jpeg"  multiple>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <x-forms.label name="Slider Title" />
                            <input type="text" name="title" id="title" class="form-control" required value="{{$slider->content_title}}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <x-forms.label name="Short Description" />
                            <textarea name="body" class="form-control" cols="30" rows="3" required placeholder="Short Description">{{$slider->content_body}}</textarea>
                        </div>
                    </div>
                    {{-- <div class="col-md-4">
                        <div class="form-group">
                            <x-forms.label name="Select seller for follower link" />
                            <select name="seller" id="seller" class="form-control" id="select2" required>
                                <option value="null">Select Seller</option>
                                @foreach ($sellers as $seller)
                                    <option {{$seller->id == $slider->seller_id ? "selected" : ''}} value="{{ $seller->id }}">{{ $seller->username }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div> --}}
                    <div class="col-md-12 text-center">
                        <button type="submit" class="btn btn-success">Update</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('style')
    <link rel="stylesheet" href="{{ asset('backend') }}/css/dropify.min.css" />
@endsection
@section('script')
    <script src="{{ asset('backend') }}/js/dropify.min.js"></script>
    <script>
        $('.dropify').dropify();
    </script>
@endsection
