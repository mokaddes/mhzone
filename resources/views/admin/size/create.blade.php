@extends('admin.size.size-layout')
@section('title')
    {{ __('size') }}
@endsection

@section('website-settings')
    <div class="card">
        <div class="card-header">
            <div class="d-flex align-items-center justify-content-between">
                <h3 class="card-title" style="line-height: 36px;">{{ __('size') }}</h3>
                <a href="{{ route('size.index') }}"
                    class="btn bg-primary float-right d-flex align-items-center justify-content-center"><i
                        class="fas fa-arrow-left"></i>&nbsp; Back</a>
            </div>
        </div>
        <div class="card-body">
            <form action="{{ route('size.store') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <x-forms.label name="select_category" required="true" />
                        <select name="category_id" id="ad_category"
                            class="form-control @error('category_id') border-danger @enderror">
                            <option value="">Select Category</option>
                            @foreach ($categories as $category)
                                <option {{ old('category_id') == $category->id ? 'selected' : '' }}
                                    value="{{ $category->id }}">
                                    {{ $category->name }}</option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-md-4 mb-3">
                        <x-forms.label name="select_subcategory" required="true" />
                        <select name="subcategory_id" id="ad_subcategory"
                            class="form-control @error('subcategory_id') border-danger @enderror"></select>
                        @error('subcategory_id')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    {{-- <div class="col-md-4 mb-3">
                        <x-forms.label name="Select Child Category" required="true" />
                        <select name="select_child_category" id="ad_child_category"
                            class="form-control @error('select_child_category') border-danger @enderror">
                        </select>
                        @error('select_child_category')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div> --}}
                    <div class="col-md-4 mb-3">
                        <x-forms.label name="size" required="true" />
                        <input type="text" name="size" id="size"
                            class="form-control @error('size') border-danger @enderror">
                        @error('size')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-md-12 md-3">
                        <div class="d-flex justify-content-center">
                            <button class="btn btn-success">Save</button>
                        </div>
                    </div>
                </div>
            </form>
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




@section('script')
    {{-- category-subcategory dropdown --}}
    <script src="{{ asset('frontend') }}/js/axios.min.js"></script>
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
                    html += `<option value="">Slelct Sub Category</option>`;

                    $.each(res.data, function(key, subcat) {
                        var matched = parseInt(subct_id) === subcat.id ? true : false
                        html +=
                            `<option ${matched ? 'selected':''} value="${subcat.id}">${subcat.name}</option>`
                    });
                    $('select[name="subcategory_id"]').append(html);
                    var subcategory = document.getElementById('ad_subcategory').value;
                    cat_wise_child_cat(subcategory);

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
                    html += `<option value="">Slelct Child Category</option>`;

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
            if (subCategoryID) {
                cat_wise_child_cat(subCategoryID);
            }
        });
    </script>
@endsection
