@extends('admin.layouts.app')
@section('title')
    {{ __('create product') }}
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title" style="line-height: 36px;">{{ __('create product') }}</h3>
                        <a href="{{ route('module.ad.index') }}"
                            class="btn bg-primary float-right d-flex align-items-center justify-content-center"><i
                                class="fas fa-arrow-left"></i>&nbsp; {{ __('back') }}</a>
                    </div>
                    <div class="row pt-3 pb-4">
                        <div class="col-12 px-5">
                            <form class="form-horizontal" action="{{ route('module.ad.store') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <x-forms.label name="title" required="true" />
                                                <input type="text" name="title"
                                                    class="form-control @error('title') is-invalid @enderror"
                                                    value="{{ old('title') }}" placeholder="{{ __('enter ad title') }}">
                                                @error('title')
                                                    <span class="invalid-feedback">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <x-forms.label name="brand" required="true" />
                                                <select name="brand_id"
                                                    class="form-control @error('brand_id') is-invalid @enderror">
                                                    @foreach ($brands as $brand)
                                                        <option {{ old('brand_id') == $brand->id ? 'selected' : '' }}
                                                            value="{{ $brand->id }}">{{ $brand->name }}</option>
                                                    @endforeach
                                                </select>
                                                @error('brand_id')
                                                    <span class="invalid-feedback">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <x-forms.label name="author" required="true" />
                                                <select name="user_id"
                                                    class="form-control @error('user_id') is-invalid @enderror">
                                                    @foreach ($customers as $customer)
                                                        <option {{ old('user_id') == $customer->id ? 'selected' : '' }}
                                                            value="{{ $customer->id }}">{{ $customer->name }}</option>
                                                    @endforeach
                                                </select>
                                                @error('user_id')
                                                    <span class="invalid-feedback">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <x-forms.label name="price" required="true">
                                                    ({{ env('APP_CURRENCY_SYMBOL') }})
                                                </x-forms.label>
                                                <input type="number" name="price"
                                                    class="form-control @error('price') is-invalid @enderror"
                                                    value="{{ old('price') }}" placeholder="{{ __('enter ad price') }}">
                                                @error('price')
                                                    <span class="invalid-feedback">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <x-forms.label name="select category" required="true" />
                                                <select name="category_id" id="ad_category"
                                                    class="form-control @error('category_id') border-danger @enderror">
                                                    @foreach ($categories as $category)
                                                        <option {{ old('category_id') == $category->id ? 'selected' : '' }}
                                                            value="{{ $category->id }}">{{ $category->name }}</option>
                                                    @endforeach
                                                </select>
                                                @error('category_id')
                                                    <span class="invalid-feedback">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div class="col-md-6 mb-3">
                                                <x-forms.label name="select subcategory" required="true" />
                                                <select name="subcategory_id" id="ad_subcategory"
                                                    class="form-control @error('subcategory_id') border-danger @enderror"></select>
                                                @error('subcategory_id')
                                                    <span class="invalid-feedback">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <x-forms.label name="Select Child Category" required="true" />
                                                <select name="select_child_category" id="ad_child_category"
                                                    class="form-control @error('select_child_category') border-danger @enderror">
                                                </select>
                                                @error('select_child_category')
                                                    <span class="invalid-feedback">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <input type="hidden" name="show_phone" id="show_phone" value="1">
                                                <label for="phone_number">{{ __('phone number') }}
                                                    <span>(
                                                        <input type="checkbox" name="show_phone" id="show_phone_number"
                                                            value="0"> <label
                                                            for="show_phone_number">{{ __('hide in details') }}</label>
                                                        )</span>
                                                </label>
                                                <input type="text" name="phone"
                                                    class="form-control @error('phone') is-invalid @enderror"
                                                    value="{{ old('phone') }}"
                                                    placeholder="{{ __('enter customer phone number') }}">
                                                @error('phone')
                                                    <span class="invalid-feedback">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div class="col-md-6 mb-3">
                                                <label for="optional_phone_number" class="p-1">{{ __('phone number') }}
                                                    ({{ __('optional') }})</label>
                                                <input type="text" name="phone_2"
                                                    class="form-control @error('phone_2') is-invalid @enderror"
                                                    value="{{ old('phone_2') }}"
                                                    placeholder="{{ __('enter another phone number') }}">
                                                @error('phone_2')
                                                    <span class="invalid-feedback">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label for="whatsapp_profile_url"
                                                    class="p-1">{{ __('whatsapp number') }}
                                                    (<a href="https://faq.whatsapp.com/iphone/how-to-link-to-whatsapp-from-a-different-app/?lang=en"
                                                        target="_blank">{{ __('get help') }}</a>)
                                                </label>
                                                <input type="number" name="whatsapp"
                                                    class="form-control @error('whatsapp') is-invalid @enderror"
                                                    value="{{ old('whatsapp') }}" placeholder="E.g: 8801681******"
                                                    id="whatsapp_profile_url">
                                                @error('whatsapp')
                                                    <span class="invalid-feedback">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-md-3">
                                                <div class="icheck-success d-inline" data-toggle="tooltip"
                                                    data-original-title="{{ __('show featured ads on homepage') }} ">
                                                    <input {{ old('featured') == 1 ? 'checked' : '' }} value="1"
                                                        name="featured" type="checkbox" class="form-check-input"
                                                        id="featured" />
                                                    <x-forms.label name="featured" class="form-check-label"
                                                        for="featured" :required="false" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="col-md-12 mb-4">
                                            <x-forms.label name="upload thumbnail" required="true" />
                                            <input name="thumbnail" type="file"
                                                accept="image/png, image/jpg, image/jpeg"
                                                class="form-control dropify @error('thumbnail') is-invalid @enderror"
                                                style="border:none;padding-left:0;"
                                                accept="image/png,image/jpg,image/jpeg"
                                                data-allowed-file-extensions='["jpg", "jpeg","png"]'
                                                data-max-file-size="3M" data-show-errors="true" />
                                            @error('thumbnail')
                                                <span
                                                    class="invalid-feedback d-block"><strong>{{ $message }}</strong></span>
                                            @enderror
                                        </div>
                                        <div class="col-md-12 mb-3">
                                            <div class="input-field--textarea">
                                                <x-forms.label name="features" for="feature" />
                                                <div id="multiple_feature_part">
                                                    <div class="row">
                                                        <div class="col-10">
                                                            <div class="input-field mb-3">
                                                                <input name="features[]" type="text"
                                                                    placeholder="{{ __('feature') }}" id="adname"
                                                                    class="form-control @error('features') border-danger @enderror" />
                                                            </div>
                                                        </div>
                                                        <div class="col-2 mt-10">
                                                            <a role="button" onclick="add_features_field()"
                                                                class="btn bg-primary btn-sm text-light"><i
                                                                    class="fas fa-plus"></i></a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 mb-3">
                                        <x-forms.label name="description" required="true" />
                                        <textarea id="editor2" name="description" class="form-control @error('description') is-invalid @enderror"
                                            placeholder="{{ __('write description of ad') }}">
                                            {{ old('description') }}
                                        </textarea>

                                        @error('description')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <strong>
                                        <x-forms.label name="Locations" :required="true" />
                                    </strong>

                                    <div class="col-12 col-md-6">
                                        <div class="input-field__group">
                                            <div class="input-field">
                                                <x-forms.label name="Neighborhood" for="neighborhood" :required="true" />
                                                <input name="neighborhood" id="neighborhood" type="text"
                                                    class="" placeholder=""
                                                    value="{{ old('neighborhood') ?? '' }}" />
                                                @error('neighborhood')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <div class="input-field__group">
                                            <div class="input-field">
                                                <x-forms.label name="locality" for="locality" :required="true" />
                                                <input name="locality" id="locality" type="text" class=""
                                                    placeholder="" value="{{ old('locality') ?? '' }}" />
                                                @error('locality')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <div class="input-field__group">
                                            <div class="input-field">
                                                <x-forms.label name="place" for="place" :required="true" />
                                                <input name="place" id="place" type="text" class=""
                                                    placeholder="" value="{{ old('place') ?? '' }}" />
                                                @error('place')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12 col-md-6">
                                        <div class="input-field__group">
                                            <div class="input-field">
                                                <x-forms.label name="district" for="district" :required="true" />
                                                <input name="district" id="district" type="text" class=""
                                                    placeholder="" value="{{ old('district') ?? '' }}" />
                                                @error('district')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <div class="input-field__group">
                                            <div class="input-field">
                                                <x-forms.label name="postcode" for="postcode" :required="true" />
                                                <input name="postcode" id="postcode" type="text" class=""
                                                    placeholder="" value="{{ old('postcode') ?? '' }}" />
                                                @error('postcode')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <div class="input-field__group">
                                            <div class="input-field">
                                                <x-forms.label name="region" for="region" :required="true" />
                                                <input name="region" id="region" type="text" class=""
                                                    placeholder="" value="{{ old('region') ?? '' }}" />
                                                @error('region')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <div class="input-field__group">
                                            <div class="input-field">
                                                <x-forms.label name="country" for="country" :required="true" />
                                                <input name="country" id="country" type="text" class=""
                                                    placeholder="" value="{{ old('country') ?? '' }}" />
                                                @error('country')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <div class="input-field__group">
                                            <div class="input-field">
                                                <x-forms.label name="Full Address" for="fulladdress" :required="true" />
                                                <input name="fulladdress" id="fulladdress" type="text" class=""
                                                    placeholder="" value="{{ old('fulladdress') ?? '' }}" />
                                                @error('fulladdress')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 text-center">
                                        <button type="submit" class="btn btn-success"><i class="fas fa-plus"></i>&nbsp;
                                            {{ __('create') }}</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if (old('subcategory_id'))
        <input type="hidden" id="subct_id" value="{{ old('subcategory_id') }}">
    @else
        <input type="hidden" id="subct_id" value="">
    @endif
    @if (old('select_child_category'))
        <input type="hidden" id="child_ct_id" value="{{ old('select_child_category') }}">
    @else
        <input type="hidden" id="child_ct_id" value="">
    @endif
@endsection
@section('style')
    <link rel="stylesheet" href="{{ asset('backend') }}/css/dropify.min.css" />

    <link rel="stylesheet" href="{{ asset('backend') }}/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <style>
        .ck-editor__editable_inline {
            min-height: 300px;
        }
    </style>
    <!-- >=>Mapbox<=< -->
    <link rel="stylesheet" href="{{ asset('frontend/plugins/mapbox/mapbox-gl-geocoder.css') }}" type="text/css">
    <link href="{{ asset('frontend/plugins/mapbox/mapbox-gl.css') }}" rel="stylesheet">
    <style>
        .mymap {
            width: 100%;
            min-height: 300px;
            border-radius: 12px;
        }

        .p-half {
            padding: 1px;
        }

        .mapClass {
            border: 1px solid transparent;
            margin-top: 15px;
            border-radius: 4px 0 0 4px;
            box-sizing: border-box;
            -moz-box-sizing: border-box;
            height: 35px;
            outline: none;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
        }

        #searchInput {
            font-family: 'Roboto';
            background-color: #fff;
            font-size: 16px;
            text-overflow: ellipsis;
            margin-left: 16px;
            font-weight: 400;
            width: 30%;
            padding: 0 11px 0 13px;
        }

        #searchInput:focus {
            border-color: #4d90fe;
        }
    </style>
    <!-- >=>Mapbox<=< -->
@endsection

@section('script')
    <script src="{{ asset('backend') }}/js/dropify.min.js"></script>
    <script src="{{ asset('frontend') }}/js/axios.min.js"></script>
    <script src="{{ asset('backend') }}/dist/js/ckeditor.js"></script>

    {{-- ck-editor --}}
    <script>
        ClassicEditor
            .create(document.querySelector('#editor2'))
            .catch(error => {
                // console.error(error);
            });
    </script>

    {{-- category-subcategory dropdown --}}
    <script>
        var subct_id = document.getElementById('subct_id').value;

        $(document).ready(function() {
            var category_id = document.getElementById('ad_category').value;
            cat_wise_subcat(category_id);
        });



        // category wise subcategory function
        function cat_wise_subcat(categoryID) {
            axios.get('/get_subcategory/' + categoryID).then((res => {
                // console.log(res);
                if (res.data) {
                    $('#ad_subcategory').empty();
                    html = ``;
                    html += `<option value="null">Slelct Sub Category</option>`;

                    $.each(res.data, function(key, subcat) {
                        var matched = parseInt(subct_id) === subcat.id ? true : false
                        html +=
                            `<option ${matched ? 'selected':''} value="${subcat.id}">${subcat.name}</option>`
                    });
                    $('select[name="subcategory_id"]').append(html);

                } else {
                    $('#ad_subcategory').empty();
                }
            }))
        }

        // Category wise subcategories dropdown
        $('#ad_category').on('change', function() {
            var categoryID = $(this).val();
            if (categoryID) {
                cat_wise_subcat(categoryID);
            }
        });

        $(document).ready(function() {
            var subcategory = document.getElementById('ad_subcategory').value;
            cat_wise_child_cat(subcategory);
        });
        var child_ct_id = document.getElementById('child_ct_id').value;




        // category wise child_category function
        function cat_wise_child_cat(childCategoryID) {

            axios.post("{{ route('getChildcategory') }}", {
                id: childCategoryID
            }).then((res => {
                console.log(res.data);
                if (res.data) {
                    $('#ad_child_category').empty();
                    var html = ``;
                    html += `<option value="null">Slelct Child Category</option>`;

                    $.each(res.data, function(key, child_cat) {
                        var matched = parseInt(child_ct_id) === child_cat.id ? true : false
                        html +=
                            `<option ${matched ? 'selected':''} value="${child_cat.id}">${child_cat.name}</option>`;
                    });

                    $('select[name="select_child_category"]').append(html);

                } else {
                    $('#ad_child_category').empty();
                }
            }))
        }

        // Category wise child_categories dropdown
        $('#ad_subcategory').on('change', function() {

            var subCategoryID = $(this).val();
            console.log(subCategoryID);
            if (subCategoryID) {
                cat_wise_child_cat(subCategoryID);
            }
        });
    </script>

    {{-- Featured inputs --}}
    <script>
        function add_features_field() {
            $("#multiple_feature_part").append(`
            <div class="row">
                <div class="col-lg-10">
                    <div class="input-field mb-3">
                        <input name="features[]" type="text" placeholder="Feature" id="adname" class="form-control @error('features') border-danger @enderror"/>
                        </div>
                        </div>
                    <div class="col-lg-2 mt-10">
                        <button onclick="remove_single_field()" id="remove_item" class="btn btn-sm bg-danger text-light"><i class="fas fa-times"></i></button>
                    </div>
                    </div>
                    `);
        }

        $(document).on("click", "#remove_item", function() {
            $(this).parent().parent('div').remove();
        });
    </script>

    {{-- Dropify image upload --}}
    <script>
        var drEvent = $('.dropify').dropify();

        drEvent.on('dropify.error.fileSize', function(event, element) {
            alert('Filesize error message!');
        });
        drEvent.on('dropify.error.imageFormat', function(event, element) {
            alert('Image format error message!');
        });
    </script>

    <x-set-mapbox />
    <x-set-googlemap />
@endsection
