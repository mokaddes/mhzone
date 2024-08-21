@extends('admin.layouts.app')
@section('title')
    {{ __('edit product') }}
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title" style="line-height: 36px;">{{ __('edit product') }}</h3>
                        <a href="{{ route('module.ad.index') }}"
                            class="btn bg-primary float-right d-flex align-items-center justify-content-center"><i
                                class="fas fa-arrow-left"></i>&nbsp; {{ __('back') }}</a>
                    </div>
                    <div class="row pt-3 pb-4">
                        <div class="col-12 px-5">
                            <form class="form-horizontal" action="{{ route('module.ad.update', $ad->id) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @method('put')
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <x-forms.label name="title" required="true" />
                                                <input type="text" name="title"
                                                    class="form-control @error('title') is-invalid @enderror"
                                                    value="{{ $ad->title }}" placeholder="{{ __('enter ad title') }}}">
                                                @error('title')
                                                    <span class="invalid-feedback">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <x-forms.label name="brand" />
                                                <select name="brand_id"
                                                    class="form-control @error('brand_id') is-invalid @enderror">
                                                    <option value="">Select Band</option>
                                                    @foreach ($brands as $brand)
                                                        <option {{ $ad->brand_id == $brand->id ? 'selected' : '' }}
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
                                                        <option {{ $ad->user_id == $customer->id ? 'selected' : '' }}
                                                            value="{{ $customer->id }}">{{ $customer->name }}</option>
                                                    @endforeach
                                                </select>
                                                @error('user_id')
                                                    <span class="invalid-feedback">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <x-forms.label name="Condition" required="true" />
                                                <select name="condition"
                                                    class="form-control @error('condition') is-invalid @enderror">

                                                    <option value="" class="d-none">Condition</option>
                                                    <option {{ $ad->condition == 'new' ? 'selected' : '' }} value="new">
                                                        New/Never Worn
                                                    </option>
                                                    <option {{ $ad->condition == 'Gently' ? 'selected' : '' }}
                                                        value="Gently Used">
                                                        Gently Used</option>
                                                    <option {{ $ad->condition == 'Used' ? 'selected' : '' }}
                                                        value="Used">Used</option>
                                                    <option {{ $ad->condition == 'Worn' ? 'selected' : '' }}
                                                        value="Worn">Very Worn
                                                    </option>


                                                </select>
                                                @error('condition')
                                                    <span class="invalid-feedback">{{ $message }}</span>
                                                @enderror
                                            </div>


                                            <div class="col-md-6 mb-3">
                                                <x-forms.label name="price" required="true">
                                                    ( {{ onlyCurrencySymbol() }} )</x-forms.label>
                                                <input type="number" name="price"
                                                    class="form-control @error('price') is-invalid @enderror"
                                                    value="{{ $ad->price }}" placeholder="{{ __('enter ad price') }}">
                                                @error('price')
                                                    <span class="invalid-feedback">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label >Minimum Price ( {{ onlyCurrencySymbol() }} )</label>
                                                <input type="number" name="min_price"
                                                    class="form-control @error('min_price') is-invalid @enderror"
                                                    value="{{ $ad->min_price }}"
                                                    placeholder="{{ __('enter ad min price') }}">
                                                @error('min_price')
                                                    <span class="invalid-feedback">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>


                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label >Department <span class="text-danger">*</span></label>
                                                <select name="category_id" id="ad_category"
                                                    class="form-control @error('category_id') border-danger @enderror">
                                                    @foreach ($categories as $category)
                                                        <option {{ $category->id == $ad->category_id ? 'selected' : '' }}
                                                            value="{{ $category->id }}">{{ $category->name }}</option>
                                                    @endforeach
                                                </select>
                                                @error('category_id')
                                                    <span class="invalid-feedback">{{ $message }}</span>
                                                @enderror
                                            </div>


                                            <div class="col-md-6 mb-3">
                                                <x-forms.label name="subcategory" required="true" />
                                                <select name="subcategory_id" id="ad_subcategory"
                                                    class="form-control @error('subcategory_id') border-danger @enderror">
                                                    @foreach ($subcategories as $subcategory)
                                                        <option
                                                            {{ $subcategory->id == $ad->subcategory_id ? 'selected' : '' }}
                                                            value="{{ $subcategory->id }}">{{ $subcategory->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('subcategory_id')
                                                    <span class="invalid-feedback">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <x-forms.label name="Select Child Category" required="true" />
                                                <select name="select_child_category" id="ad_child_category"
                                                    class="form-control @error('select_child_category') border-danger @enderror">

                                                    @foreach ($childcategories as $childcategory)
                                                        <option
                                                            {{ $childcategory->id == $ad->child_category_id ? 'selected' : '' }}
                                                            value="{{ $childcategory->id }}">{{ $childcategory->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('select_child_category')
                                                    <span class="invalid-feedback">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            {{-- <div class="col-md-6 mb-3">
                                                <x-forms.label name="Size" required="true" />
                                                <select name="size" id="size"
                                                    class="form-control @error('size') border-danger @enderror">

                                                    @foreach ($size as $aDsize)
                                                        <option {{ $aDsize->id == $ad->size_id ? 'selected' : '' }}
                                                            value="{{ $aDsize->id }}">{{ $aDsize->size }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('size')
                                                    <span class="invalid-feedback">{{ $message }}</span>
                                                @enderror
                                            </div> --}}
                                            <div class="col-md-6 mb-3">
                                                <x-forms.label name="Color" required="true" />
                                                <select name="color" id="color"
                                                    class="form-control @error('color') border-danger @enderror">

                                                    @foreach ($color as $adColor)
                                                        <option {{ $adColor->id == $ad->color ? 'selected' : '' }}
                                                            value="{{ $adColor->id }}">{{ $adColor->color }}</option>
                                                    @endforeach

                                                </select>
                                                @error('color')
                                                    <span class="invalid-feedback">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label >Select Type</label>
                                                <select name="tags"
                                                    class="form-control @error('tags') border-danger @enderror">
                                                    <option value="null">Select Tag</option>
                                                    <option {{ $ad->tags == 'staff_picks' ? 'selected' : '' }}
                                                        value="staff_picks">{{ __('Staff Picks') }}</option>
                                                    <option {{ $ad->tags == 'trending_streetwear' ? 'selected' : '' }}
                                                        value="trending_streetwear">{{ __('Trending Streetwear') }}
                                                    </option>
                                                </select>
                                                @error('tags')
                                                    <span class="invalid-feedback">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6 d-flex justify-content-between align-items-center">

                                                <div class="col-md-4">
                                                    <div class="icheck-success d-inline">
                                                        <input value="1" name="featured" type="checkbox"
                                                            class="form-check-input" id="featured"
                                                            {{ $ad->featured == 1 ? 'checked' : '' }} />
                                                        <x-forms.label name="featured" class="form-check-label"
                                                            for="featured" :required="false" />
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="icheck-success d-inline">
                                                        <input value="1" name="popular" type="checkbox"
                                                            class="form-check-input" id="popular"
                                                            {{ $ad->popular == 1 ? 'checked' : '' }} />
                                                        <x-forms.label name="Popular" class="form-check-label"
                                                            for="popular" :required="false" />
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="icheck-success d-inline">
                                                        <input value="1" name="trending" type="checkbox"
                                                            class="form-check-input" id="trending"
                                                            {{ $ad->trending == 1 ? 'checked' : '' }} />
                                                        <x-forms.label name="Trending" class="form-check-label"
                                                            for="trending" :required="false" />
                                                    </div>
                                                </div>


                                            </div>

                                            <div class="col-md-6">
                                                <div class="input-select">
                                                    <label >Tags ( SEO )</label>
                                                    <div id="tags">
                                                        <div class="input-field">
                                                            <input type="text" name="tags"
                                                                class="form-control tags" placeholder=""
                                                                value="@foreach ($ad->adTags as $tags)
                                                                {{ $tags->tag_name }}, @endforeach">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="row">
                                            <div class="col-md-12 mb-3">
                                                <x-forms.label name="upload thumbnail" required="true" />
                                                <input name="thumbnail" type="file"
                                                    accept="image/png, image/jpg, image/jpeg"
                                                    class="form-control dropify @error('thumbnail') is-invalid @enderror"
                                                    style="border:none;padding-left:0;" data-max-file-size="3M"
                                                    data-show-errors="true"
                                                    data-allowed-file-extensions='["jpg", "jpeg","png"]'
                                                    data-default-file="{{ $ad->image_url }}" />
                                                @error('thumbnail')
                                                    <span
                                                        class="invalid-feedback d-block"><strong>{{ $message }}</strong></span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12 mb-3">
                                        <x-forms.label name="description" required="true" />
                                        <textarea id="editor2" cols="20" rows="10" name="description"
                                            class="form-control @error('description') is-invalid @enderror"
                                            placeholder="{{ __('write description of ad') }}">
                                            {{ $ad->description }}
                                        </textarea>
                                        @error('description')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 mb-3">

                                        <strong>
                                            <x-forms.label name="Shipping From" :required="false" />
                                        </strong>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <x-forms.label name="Street address" for="address" :required="true" />
                                        <input name="address" id="address" type="text" class="form-control"
                                            placeholder="" value="{{ old('address') ?? $ad->address }}" />
                                        @error('address')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>



                                    <div class="col-md-6 mb-3">
                                        <x-forms.label name="Apt/Suite" for="apartment" :required="false" />
                                        <input name="apartment" id="apartment" type="text" class="form-control"
                                            placeholder="" value="{{ old('apartment') ?? $ad->apartment }}" />
                                        @error('apartment')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>


                                    <div class="col-md-6 mb-3">
                                        <x-forms.label name="city" for="city" :required="true" />
                                        <input name="city" id="city" type="text" class="form-control"
                                            placeholder="" value="{{ old('city') ?? $ad->city }}" />
                                        @error('city')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>


                                    <div class="col-md-6 mb-3">
                                        <x-forms.label name="state" for="state" :required="true" />
                                        <input name="state" id="state" type="text" class="form-control"
                                            stateholder="" value="{{ old('state') ?? $ad->state }}" />
                                        @error('state')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>



                                    <div class="col-md-6 mb-3">
                                        <x-forms.label name="country" for="country" :required="true" />
                                        <select name="country" id="" class="form-control">

                                            @foreach ($locations as $location)
                                                <option {{ $ad->country == $location->id ? 'selected' : '' }}
                                                    value="{{ $location->id }}">{{ $location->locations }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('country')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>



                                    <div class="col-md-6 mb-3">
                                        <x-forms.label name="ZIP Code" for="postcode" :required="false" />
                                        <input name="postcode" id="postcode" type="text" class="form-control"
                                            placeholder="" value="{{ old('postcode') ?? $ad->postcode }}" />
                                        @error('postcode')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                </div>

                                <div class="row">
                                    <div class="col-12 text-center">
                                        <button type="submit" class="btn btn-success"><i class="fas fa-plus"></i>&nbsp;
                                            {{ __('update') }}</button>
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
{{-- @include('components.set-location-edit') --}}
@section('style')
    <link rel="stylesheet" href="{{ asset('backend') }}/css/dropify.min.css" />
    <link rel="stylesheet" href="{{ asset('backend') }}/plugins/icheck-bootstrap/icheck-bootstrap.min.css">

    <!-- >=>Mapbox<=< -->
    <link rel="stylesheet" href="{{ asset('frontend/plugins/mapbox/mapbox-gl-geocoder.css') }}" type="text/css">
    <link href="{{ asset('frontend/plugins/mapbox/mapbox-gl.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('frontend/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/select2-bootstrap-5-theme.css') }}">
    <link href="{{ asset('frontend/js/plugins/tags/tagify.css') }}" rel="stylesheet" type="text/css" />

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
    <script src="{{ asset('frontend') }}/js/axios.min.js"></script>
    <script src="{{ asset('backend') }}/js/dropify.min.js"></script>
    <script src="{{ asset('backend') }}/dist/js/ckeditor.js"></script>
    <script src="{{ asset('frontend/js/plugins/select2/js/select2.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#size').select2();
            $('#color').select2();
        })
    </script>

    <script src="{{ asset('frontend/js/plugins/tags/tagify.js') }}"></script>
    <script src="{{ asset('frontend/js/plugins/tags/tagify.polyfills.min.js') }}"></script>

    <script>
        var input = document.querySelector('.tags');

        // initialize Tagify on the above input node reference
        let teg = new Tagify(input)
    </script>


    {{-- ck-editor --}}
    {{-- <script>
        ClassicEditor
            .create(document.querySelector('#editor2'))
            .catch(error => {
                console.error(error);
            });
    </script> --}}

    {{-- category-subcategory dropdown --}}
    <script>
        // category wise subcategory function
        function cat_wise_subcat(categoryID) {
            axios.get('/get_subcategory/' + categoryID).then((res => {
                console.log(res);
                if (res.data) {
                    $('#ad_subcategory').empty();
                    $.each(res.data, function(key, subcat) {
                        $('select[name="subcategory_id"]').append('<option value="' + subcat.id + '">' +
                            subcat.name + '</option>');
                    });
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



        // category wise child_category function
        function cat_wise_child_cat(childCategoryID) {

            axios.post("{{ route('getChildcategory') }}", {
                id: childCategoryID
            }).then((res => {
                console.log(res.data);
                if (res.data) {
                    console.log(res.data);
                    $('#ad_child_category').empty();
                    var html = ``;
                    html += `<option value="null">Slelct Child Category</option>`;

                    $.each(res.data, function(key, child_cat) {

                        html += `<option value="${child_cat.id}">${child_cat.name}</option>`;
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

            if (subCategoryID) {
                cat_wise_child_cat(subCategoryID);
                sub_cat_wise_size(subCategoryID)
            }
        });


        function sub_cat_wise_size(subCategory) {




            axios.post("{{ route('frontend.getSizeByCategories') }}", {
                subCategory: subCategory,
            }).then(function(responce) {
                console.log(responce.data);

                var html = ``;
                html += `<option value="null">Slelct Your Size</option>`;

                $.each(responce.data, function(key, child_cat) {

                    html += `<option value="${child_cat.id}">${child_cat.size}</option>`;
                });


                $('select[name="size"]').html(html);


            }).catch(function(error) {
                console.log(error);
            })
        }
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
    <!-- >=>Mapbox<=< -->
    <script src="{{ asset('frontend') }}/js/axios.min.js"></script>
    <script src="{{ asset('frontend/plugins/mapbox/mapbox-gl-geocoder.min.js') }}"></script>
    <script src="{{ asset('frontend/plugins/mapbox/mapbox-gl.js') }}"></script>
    <!--=============== map box ===============-->
    <script>
        var token = "{{ setting('map_box_key') }}";
        mapboxgl.accessToken = token;
        const coordinates = document.getElementById('coordinates');

        var item = {!! $ad !!};

        var oldlat = item.lat ? item.lat : {!! setting('default_lat') !!};
        var oldlng = item.long ? item.long : {!! setting('default_long') !!};

        const map = new mapboxgl.Map({
            container: 'map-box',
            style: 'mapbox://styles/mapbox/streets-v11',
            center: [oldlng, oldlat],
            zoom: 6
        });
        // Add the control to the map.
        map.addControl(
            new MapboxGeocoder({
                accessToken: mapboxgl.accessToken,
                mapboxgl: mapboxgl
            })
        );
        // Add the control to the map.
        const geocoder = new MapboxGeocoder({
            accessToken: mapboxgl.accessToken,
            marker: {
                color: 'orange',
                draggable: true
            },
            mapboxgl: mapboxgl
        });
        var marker = new mapboxgl.Marker({
                draggable: true
            }).setLngLat([oldlng, oldlat])
            .addTo(map);

        function onDragEnd() {
            const lngLat = marker.getLngLat();
            let lat = lngLat.lat;
            let lng = lngLat.lng;

            axios.get(
                    `https://api.mapbox.com/geocoding/v5/mapbox.places/${lng},${lat}.json?&types=address,neighborhood,locality,place,district,postcode,region,country&access_token=${token}`
                )
                .then((res) => {

                    var form = new FormData();
                    form.append('lat', lat);
                    form.append('lng', lng);

                    for (let i = 0; i < res.data.features.length; i++) {
                        form.append(res.data.features[i].place_type[0], res.data.features[i].text);
                    }

                    axios.post(
                            '/set/session', form
                        )
                        .then((res) => {
                            // console.log(res.data);
                            // toastr.success("Location Saved", 'Success!');
                        })
                        .catch((e) => {
                            toastr.error("Something Wrong", 'Error!');
                        });
                })
                .catch((e) => {
                    // toastr.error("Something Wrong", 'Error!');
                });
        }

        function add_marker(event) {
            var coordinates = event.lngLat;
            marker.setLngLat(coordinates).addTo(map);

        }
        map.on('style.load', function() {
            map.on('click', function(e) {
                var coordinates = e.lngLat;
                let lat = parseFloat(coordinates.lat);
                let lng = parseFloat(coordinates.lng);
                axios.get(
                        `https://api.mapbox.com/geocoding/v5/mapbox.places/${lng},${lat}.json?&types=address,neighborhood,locality,place,district,postcode,region,country&access_token=${token}`
                    )
                    .then((res) => {

                        var form = new FormData();
                        form.append('lat', lat);
                        form.append('lng', lng);

                        for (let i = 0; i < res.data.features.length; i++) {
                            form.append(res.data.features[i].place_type[0], res.data.features[i].text);
                        }

                        axios.post(
                                '/set/session', form
                            )
                            .then((res) => {
                                // console.log(res.data);
                                // toastr.success("Location Saved", 'Success!');
                            })
                            .catch((e) => {
                                toastr.error("Something Wrong", 'Error!');
                            });
                    })
                    .catch((e) => {
                        // toastr.error("Something Wrong", 'Error!');
                    });
            });
        });
        map.on('click', add_marker);
        marker.on('dragend', onDragEnd);
    </script>
    <script>
        $('.mapboxgl-ctrl-logo').addClass('d-none');
        $('.mapboxgl-compact').addClass('d-none');
        $('.mapboxgl-ctrl-attrib-inner').addClass('d-none');
    </script>
    <!-- ============== map box ============= -->




    <!-- ============== google map ========= -->
    <script>
        function initMap() {
            var token = "{{ setting('google_map_key') }}";

            var oldlat = item.lat ? item.lat : {!! setting('default_lat') !!};
            var oldlng = item.long ? item.long : {!! setting('default_long') !!};

            const map = new google.maps.Map(document.getElementById("google-map"), {
                zoom: 14,
                center: {
                    lat: oldlat,
                    lng: oldlng
                },
            });

            const image =
                "https://gisgeography.com/wp-content/uploads/2018/01/map-marker-3-116x200.png";
            const beachMarker = new google.maps.Marker({
                position: {
                    lat: oldlat,
                    lng: oldlng
                },
                map,
                // icon: image
            });

            // google.maps.event.addListener(map, 'click',
            //     function(event) {
            //         pos = event.latLng
            //         beachMarker.setPosition(pos);
            //         let lat = beachMarker.position.lat();
            //         let lng = beachMarker.position.lng();
            //         axios.post(
            //             `https://maps.googleapis.com/maps/api/geocode/json?latlng=${lat},${lng}&key=${token}`
            //         ).then((data) => {
            //             const total = data.data.results.length;
            //             let amount = '';
            //             if (total > 1) {
            //                 amount = total - 2;
            //             }
            //             const result = data.data.results.slice(amount);
            //             let country = '';
            //             let region = '';

            //             for (let index = 0; index < result.length; index++) {
            //                 const element = result[index];


            //                 if (element.types[0] == 'country') {
            //                     country = element.formatted_address;
            //                 }
            //                 if (element.types[0] == 'administrative_area_level_1') {

            //                     const str = element.formatted_address;
            //                     const first = str.split(',').shift()
            //                     region = first;
            //                 }
            //             }

            //             var form = new FormData();
            //             form.append('lat', lat);
            //             form.append('lng', lng);

            //             form.append('country', country);
            //             form.append('region', region);

            //             axios.post(
            //                     '/set/session', form
            //                 )
            //                 .then((res) => {
            //                     // console.log(res.data);
            //                     // toastr.success("Location Saved", 'Success!');
            //                 })
            //                 .catch((e) => {
            //                     toastr.error("Something Wrong", 'Error!');
            //                 });
            //         })
            //     });

            // google.maps.event.addListener(beachMarker, 'dragend',
            //     function() {
            //         let lat = beachMarker.position.lat();
            //         let lng = beachMarker.position.lng();
            //         axios.post(
            //             `https://maps.googleapis.com/maps/api/geocode/json?latlng=${lat},${lng}&key=${token}`
            //         ).then((data) => {
            //             const total = data.data.results.length;
            //             let amount = '';
            //             if (total > 1) {
            //                 amount = total - 2;
            //             }
            //             const result = data.data.results.slice(amount);
            //             let country = '';
            //             let region = '';

            //             for (let index = 0; index < result.length; index++) {
            //                 const element = result[index];


            //                 if (element.types[0] == 'country') {
            //                     country = element.formatted_address;
            //                 }
            //                 if (element.types[0] == 'administrative_area_level_1') {

            //                     const str = element.formatted_address;
            //                     const first = str.split(' ').shift()
            //                     region = first;
            //                 }
            //             }

            //             var form = new FormData();
            //             form.append('lat', lat);
            //             form.append('lng', lng);

            //             form.append('country', country);
            //             form.append('region', region);

            //             axios.post(
            //                     '/set/session', form
            //                 )
            //                 .then((res) => {
            //                     // console.log(res.data);
            //                     // toastr.success("Location Saved", 'Success!');
            //                 })
            //                 .catch((e) => {
            //                     toastr.error("Something Wrong", 'Error!');
            //                 });
            //         })
            //     });

            // // Search
            // var input = document.getElementById('searchInput');
            // map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

            // var autocomplete = new google.maps.places.Autocomplete(input);
            // autocomplete.bindTo('bounds', map);

            // var infowindow = new google.maps.InfoWindow();
            // var marker = new google.maps.Marker({
            //     map: map,
            //     anchorPoint: new google.maps.Point(0, -29)
            // });

            // autocomplete.addListener('place_changed', function() {
            //     infowindow.close();
            //     marker.setVisible(false);
            //     var place = autocomplete.getPlace();

            //     if (place.geometry.viewport) {
            //         map.fitBounds(place.geometry.viewport);
            //     } else {
            //         map.setCenter(place.geometry.location);
            //         map.setZoom(17);
            //     }
            // });
        }

        window.initMap = initMap;
    </script>
    <script>
        @php
            $link1 = 'https://maps.googleapis.com/maps/api/js?key=';
            $link2 = setting('google_map_key');
            $Link3 = '&callback=initMap&libraries=places,geometry';
            $scr = $link1 . $link2 . $Link3;
        @endphp;
    </script>
    <script src="{{ $scr }}" async defer></script>
    <!-- =============== google map ========= -->
    <script type="text/javascript">
        $(document).ready(function() {
            $("[data-toggle=tooltip]").tooltip()
        })
    </script>
    <!-- >=>Mapbox<=< -->
@endsection
