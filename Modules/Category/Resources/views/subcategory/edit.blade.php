@extends('admin.layouts.app')

@section('title')
    {{ __('edit subcategory') }}
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title" style="line-height: 36px;">{{ __('edit subcategory') }}</h3>
                        <a href="{{ route('module.subcategory.index') }}"
                            class="btn bg-primary float-right d-flex align-items-center justify-content-center">
                            <i class="fas fa-arrow-left"></i>&nbsp; {{ __('back') }}
                        </a>
                    </div>
                    <div class="row pt-3 pb-4">
                        <div class="col-md-6 offset-md-3">
                            <form class="form-horizontal"
                                action="{{ route('module.subcategory.update', $subcategory->id) }}" method="POST"
                                enctype="multipart/form-data">
                                @method('PUT')
                                @csrf
                                <div class="form-group row mb-15">
                                    <x-forms.label name="category name" required="true" class="col-sm-3" />
                                    <div class="col-sm-9">
                                        <select name="category_id"
                                            class="select2bs4 @error('category_id') is-invalid @enderror"
                                            style="width: 100%;">
                                            <option value="">{{ __('select category') }}</option>
                                            @foreach ($categories as $category)
                                                <option {{ $subcategory->category_id == $category->id ? 'selected' : '' }}
                                                    value="{{ $category->id }}">{{ $category->name }} ({{ $category->department->name }})</option>
                                            @endforeach
                                        </select>
                                        @error('category_id')
                                            <span class="invalid-feedback"
                                                role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <x-forms.label name="subcategory name" required="true" class="col-sm-3" />
                                    <div class="col-sm-9">
                                        <input value="{{ $subcategory->name }}" name="name" type="text"
                                            class="form-control @error('name') is-invalid @enderror"
                                            placeholder="{{ __('enter subcategory name') }}">
                                        @error('name')
                                            <span class="invalid-feedback"
                                                role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <x-forms.label name="Home Show" required="true" class="col-sm-3" />
                                    <div class="col-sm-9">
                                        <input type="checkbox" name="is_show_home" class="form-control"
                                            {{ $subcategory->is_show_home ? 'checked' : old('homeshow') }} />
                                    </div>
                                </div>
{{--                                <div class="form-group row">--}}
{{--                                    <x-forms.label name="Measurement Points" :required="false" class="col-sm-3" />--}}
{{--                                    <div class="col-sm-9">--}}
{{--                                        <div class="row ml-3">--}}
{{--                                            @foreach ($meatusements as $item)--}}
{{--                                                <div class="col-sm-4">--}}
{{--                                                    <input type="checkbox" name="measurements[]" id="{{ $item->id }}"--}}
{{--                                                        class="form-check-input mb-2 form-control"--}}
{{--                                                        value="{{ $item->name }}"--}}
{{--                                                        {{ in_array($item->name, array_map('trim', explode(',', $subcategory->mesurement_point))) ? 'checked' : '' }} />--}}
{{--                                                    <label class="form-check-label ml-1 mr-1 mb-2"--}}
{{--                                                        for="{{ $item->id }}">{{ str_replace('_', ' ', $item->name) }}</label>--}}
{{--                                                </div>--}}
{{--                                            @endforeach--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
                                <div class="form-group row">
                                    <label class="col-sm-3">Slider Image</label>
                                    <div class="col-sm-9">
                                        <span class="text-danger">(240x240)px</span>
                                        <input type="file" class="form-control dropify"
                                            data-default-file="{{ asset($subcategory->thumb) }}" name="image"
                                            autocomplete="image" data-allowed-file-extensions="jpg png jpeg"
                                            accept="image/png, image/jpg, image/jpeg">
                                        @error('image')
                                            <span class="invalid-feedback"
                                                role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="offset-sm-3 col-sm-4">
                                        <button type="submit" class="btn btn-success">
                                            <i class="fas fa-sync"></i>&nbsp; {{ __('update') }}
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('style')
    <link rel="stylesheet" href="{{ asset('backend') }}/plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="{{ asset('backend') }}/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
    <link rel="stylesheet" href="{{ asset('backend') }}/css/dropify.min.css" />
    <style>
        .select2-results__option[aria-selected=true] {
            display: none;
        }

        .select2-container--bootstrap4 .select2-selection--multiple .select2-selection__choice {
            color: #fff;
            border: 1px solid #fff;
            background: #007bff;
            border-radius: 30px;
        }

        .select2-container--bootstrap4 .select2-selection--multiple .select2-selection__choice__remove {
            color: #fff;
        }

        input[type=checkbox] {
            width: 20px;
            height: 20px;
        }
    </style>
@endsection

@section('script')
    <script src="{{ asset('backend') }}/plugins/select2/js/select2.full.min.js"></script>
    <script src="{{ asset('backend') }}/js/dropify.min.js"></script>
    <script>
        //Initialize Select2 Elements
        $('.select2bs4').select2({
            theme: 'bootstrap4'
        })

        //Initialize Dropify  Elements

        $('.dropify').dropify();
    </script>
@endsection
