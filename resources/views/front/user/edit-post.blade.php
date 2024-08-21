@extends('front.layouts.master')
@section('title', __('Edit Post'))
@section('meta')
    @php
        $data = metaData('home');
    @endphp
    <meta name="title" content="@if (currentLanguage()->code == 'lv') {{ $data->title_lv }} @else {{ $data->title }} @endif">
    <meta name="description"
        content="@if (currentLanguage()->code == 'lv') {{ $data->description_lv }} @else {{ $data->description }} @endif">
    <meta property="og:image" content="{{ $data->image_url }}" />
    <meta property="og:site_name" content="{{ config('app.name') }}">
    <meta property="og:title"
        content="@if (currentLanguage()->code == 'lv') {{ $data->title_lv }} @else {{ $data->title }} @endif">
    <meta property="og:url" content="{{ route('frontend.index') }}">
    <meta property="og:type" content="article">
    <meta property="og:description"
        content="@if (currentLanguage()->code == 'lv') {{ $data->description_lv }} @else {{ $data->description }} @endif">
    <meta name=twitter:card content={{ $data->image_url }} />
    <meta name=twitter:site content="{{ config('app.name') }}" />
    <meta name=twitter:url content="{{ route('frontend.index') }}" />
    <meta name=twitter:title
        content="@if (currentLanguage()->code == 'lv') {{ $data->title_lv }} @else {{ $data->title }} @endif" />
    <meta name=twitter:description
        content="@if (currentLanguage()->code == 'lv') {{ $data->description_lv }} @else {{ $data->description }} @endif" />
    <meta name=twitter:image content="{{ $data->image_url }}" />
@endsection
@section('content')
    <!-- ============================== breadcrumb ================================= -->
    <div class="breadcrumb mb-4">
        <div class="container">
            <div class="breadcrumb_name">
                <h3>Sell to mhzone</h3>
            </div>
        </div>
    </div>
    <!-- ============================== breadcrumb ================================= -->

    <!-- ============================== ad post ================================== -->
    <div class="ad-post-sec">
        <div class="container">
            <div class="row d-flex justify-content-center">
                <div class="col-lg-8">
                    <div class="mb-4">
                        @if ($setting->admin_commission)
                            <div class="admin-commission">{{ $setting->admin_commission }}% commission will be charge
                                from
                                product
                                sell price
                            </div>
                        @endif
                    </div>
                    <div class="adpost-form mb-3">
                        <form action="{{ route('frontend.post.update', $ad->id) }}" method="post"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-6 mb-4">
                                    <label for="title" class="form-label">Ad title <small
                                            class="text-danger">*</small></label>
                                    <input type="text" name="title" value="{{ $ad->title }}" id="title"
                                        class="form-control" placeholder="Enter your ad title" required>
                                </div>
                                <div class="col-md-6 mb-4">
                                    <label for="department_id" class="form-label">Department <small
                                            class="text-danger">*</small></label>
                                    <select name="department_id" id="department_id" class="form-control form-select"
                                        required>
                                        @if (isset($departments) && $departments->count() > 0)
                                            <option value="" hidden>Select ad Department</option>
                                            @foreach ($departments as $item)
                                                <option value="{{ $item->id }}"
                                                    {{ $ad->department_id == $item->id ? 'selected' : '' }}>
                                                    {{ $item->name }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                                <div class="col-md-6 mb-4">
                                    <label for="category_id" class="form-label">Category <small
                                            class="text-danger">*</small></label>
                                    <select name="category_id" id="category_id" class="form-control form-select">
                                        @if (isset($category) && $category->count() > 0)
                                            @foreach ($category as $cat)
                                                <option value="{{ $cat->id }}"
                                                    {{ $ad->category_id == $cat->id ? 'selected' : '' }}>
                                                    {{ $cat->name }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                                <div class="col-md-6 mb-4">
                                    <label for="subcategory_id" class="form-label">Sub Category</label>
                                    <select name="subcategory_id" id="subcategory_id" class="form-control form-select">
                                        @if (isset($subCategory) && $subCategory->count() > 0)
                                            @foreach ($subCategory as $subCat)
                                                <option value="{{ $subCat->id }}"
                                                    {{ $ad->subcategory_id == $subCat->id ? 'selected' : '' }}>
                                                    {{ $subCat->name }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                                <div class="col-md-6 mb-4">
                                    <label for="price" class="form-label">Price <small
                                            class="text-danger">*</small></label>
                                    <input type="number" name="price" id="price" value="{{ $ad->price }}"
                                        class="form-control" placeholder="Enter your ad price" required>
                                </div>
                                <div class="col-md-6 mb-4">
                                    <label for="price" class="form-label"> Quantity <small
                                            class="text-danger">*</small></label>
                                    <input type="number" name="qty" id="qty" value="{{ $ad->qty }}"
                                        class="form-control" placeholder="Enter Quantity">
                                </div>
                                <div class="col-md-6 mb-4">
                                    <label for="price" class="form-label">Discount <small>(%)</small> </label>
                                    <input type="number" name="discount" id="discount" value="{{ $ad->discount }}"
                                        class="form-control" placeholder="Enter Discount">
                                </div>
                                <div class="col-md-6 mb-4">
                                    <label for="price" class="form-label">Price after discount </label>
                                    <input type="number" name="price_after_discount" id="price_after_discount" readonly
                                        value="{{ $ad->price_after_discount }}" class="form-control"
                                        placeholder="Price after discount">
                                </div>

                                @if (isset($ad->attrs) && $ad->attrs->count() > 0)
                                    @foreach ($ad->attrs as $attr)
                                        <div class="col-md-6">
                                            @foreach (json_decode($attr->attr_details, true) as $name => $price)
                                                <div class="mb-4 attr_div_{{ $attr->attr_id }}"
                                                    id="attr_div_{{ $attr->attr_id }}">
                                                    <label for="size"
                                                        class="form-label">{{ $attr->parent_attr->name }}</label>
                                                    <div class="input-group">
                                                        <input type="text" name="attr_name[{{ $attr->attr_id }}][]"
                                                            id="attr_name{{ $attr->attr_id }}" class="form-control"
                                                            placeholder="{{ __($attr->parent_attr->name . ' Name') }}"
                                                            autocomplete="off" value="{{ $name }}">
                                                        <input type="number" name="attr_price[{{ $attr->attr_id }}][]"
                                                            id="attr_price{{ $attr->attr_id }}" class="form-control"
                                                            placeholder="{{ __('Extra price') }}"
                                                            value="{{ $price }}">
                                                        <button type="button" data-id="attr_div_{{ $attr->attr_id }}"
                                                            class="{{ $loop->index == 0 ? 'attr_btn' : 'attr_btn_remove' }}">
                                                            {{ $loop->index == 0 ? '+' : '-' }}
                                                        </button>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    @endforeach
                                @elseif(isset($attributes) && $attributes->count() > 0)
                                    @foreach ($attributes as $attr)
                                        <div class="col-md-6">
                                            <div class="mb-4 attr_div_{{ $attr->id }}"
                                                id="attr_div_{{ $attr->id }}">
                                                <label for="size" class="form-label">{{ $attr->name }}</label>
                                                <div class="input-group">
                                                    <input type="text" name="attr_name[{{ $attr->id }}][]"
                                                        id="attr_name{{ $attr->id }}" class="form-control"
                                                        placeholder="{{ __($attr->name . ' Name') }}" autocomplete="off"
                                                        value="">
                                                    <input type="any" name="attr_price[{{ $attr->id }}][]"
                                                        id="attr_price{{ $attr->id }}" class="form-control"
                                                        placeholder="{{ __('Extra price') }}" value="">
                                                    <button type="button" data-id="attr_div_{{ $attr->id }}"
                                                        class="attr_btn">
                                                        +
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif

                                <div class="col-12 mb-4">
                                    <label for="description" class="form-label">Description <small class="text-danger">*
                                            (Maximum 500 characters)</small></label>
                                    <textarea name="description" id="description" cols="30" rows="5" class="form-control"
                                        placeholder="Description">{{ $ad->description }}</textarea>
                                </div>

                                <div class="col-12 mb-4">
                                    @if (!empty($ad->thumbnail))
                                        <div class="col" id="photo_div_{{ $ad->id }}">
                                            <div class="position-relative">
                                                <img src="{{ asset($ad->thumbnail) }}" class="img-fluid" width="100"
                                                    height="auto">
                                            </div>
                                        </div>
                                    @endif
                                    <label for="feature_image" class="form-label">Feature Image (Prefer Image size
                                        250X200)</label>
                                    <input type="file" name="thumbnail" id="thumbnail"
                                        accept="image/png, image/jpeg, image/jpg" class="form-control">
                                </div>

                                <div class="col-12 mb-4">
                                    <label for="gallery" class="form-label">Gallery Images (Prefer Image size
                                        400x350)</label>

                                    <div class="uploaded"></div>
                                </div>

                                {{-- <div class="col-12 mb-4 terms_check">
                                    <div class="form-check">
                                        <input class="form-check-input" name="terms" type="checkbox" value="1"
                                               id="acceptTerms" required>
                                        <label class="form-check-label" for="acceptTerms">
                                            I have read and accept the <a href="transaction.html">Terms and
                                                Conditions</a>
                                        </label>
                                    </div>
                                </div> --}}
                                @if ($ad->status != 'pending')
                                    <div class="col-md-12 mb-4">
                                        <label for="price" class="form-label">Status </label>
                                        <select name="status" id="status" class="form-control form-select">
                                            <option value="active" {{ $ad->status == 'active' ? 'selected' : '' }}>
                                                Active
                                            </option>
                                            <option value="sold" {{ $ad->status == 'sold' ? 'selected' : '' }}>Sold
                                            </option>
                                            <option value="declined" {{ $ad->status == 'declined' ? 'selected' : '' }}>
                                                Declined
                                            </option>
                                        </select>
                                    </div>
                                @endif

                                <div class="col-12">
                                    <button class="btn btn-primary">Publish</button>
                                </div>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ============================== ad post ================================== -->
@endsection
@push('css')
    <link rel="stylesheet" href="https://unpkg.com/@yaireo/tagify/dist/tagify.css">
    <link type="text/css" rel="stylesheet" href="{{ asset('front/assets/css/image-uploader.min.css') }}">
    <style>
        .attr_btn,
        .attr_btn_remove {
            padding: 12px 30px;
            font-family: 'JetBrains Mono', monospace;
            font-size: 15px;
            border: none !important;
            background: var(--primary-hover);
            color: var(--black) !important;
            font-weight: 500;
        }

        .admin-commission {
            width: 100%;
            border: 1px solid #FBAD47;
            padding: 18px 10px;
            background: #FEFBF7;
            font-size: 18px;
        }
    </style>
@endpush

@push('js')
    <script src="{{ asset('front/assets/js/image-uploader.min.js') }}"></script>
    <script src="https://unpkg.com/@yaireo/tagify"></script>
    <script>
        $(document).ready(function() {
            let preloaded = [
                @foreach ($ad->galleries as $galleries)

                    {
                        id: "{{ $galleries->id }}",
                        src: "{{ getPhoto($galleries->image) }}"
                    },
                @endforeach
            ];

            $('.uploaded').imageUploader({
                preloaded: preloaded,
                imagesInputName: 'images',
                preloadedInputName: 'old',
                maxSize: 2 * 1024 * 1024,
                maxFiles: 10
            });;

            // size tag
            var input = document.querySelector('input[name=size]');
            new Tagify(input)
        })
    </script>
    <script>
        $(document).on('change', '#department_id', function(e) {
            var department_id = e.target.value;
            console.log(department_id);
            $.ajax({
                method: "get",
                url: "{{ route('frontend.post.getCategory') }}",
                data: {
                    department_id: department_id
                },
                success: function(res) {
                    console.log(res);
                    $("#category_id").html(res);
                }
            });
        });
        $(document).on('change', '#category_id ', function(e) {
            var category_id = e.target.value;
            console.log(category_id);
            $.ajax({
                method: 'get',
                url: "{{ route('frontend.post.getSubcategory') }}",
                data: {
                    category_id: category_id
                },
                success: function(res) {
                    console.log(res);
                    // console.log(res);
                    $('#subcategory_id').html(res);
                }
            })
        });
        $(document).on('click', '.attr_btn ', function(e) {

            let selector = '#' + $(this).data('id');
            let clonedDiv = $(selector).clone();
            let classSelector = '.' + $(this).data('id') + ':last';
            clonedDiv.find('button').text('-').removeClass('attr_btn').addClass('attr_btn_remove');
            clonedDiv.find('input').val('');
            $(classSelector).after(clonedDiv);
        });
        $(document).on('click', '.attr_btn_remove ', function(e) {
            $(this).parent().parent().remove();
        });
    </script>
    <script>
        $(document).ready(function() {
            $("#price").on('input', function() {

                calculateFinalPrice();
            });
            $('#discount').on('input', function() {
                calculateFinalPrice();
            });

            function calculateFinalPrice() {
                let originalPrice = parseFloat($('#price').val());
                let discount = parseFloat($('#discount').val());
                if (discount > 99) {
                    $('#discount').val(99);
                    discount = 99;
                }
                let finalPrice = originalPrice - (originalPrice * (discount / 100));

                $('#price_after_discount').val(finalPrice.toFixed(2));
            }
        });
    </script>
@endpush
