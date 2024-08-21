<div class="modal fade" id="filterModal" tabindex="-1" aria-labelledby="filterModalLabel" aria-hidden="true"
     data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="filterModalLabel">Search Product</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-0">
                <div class="product_filter_sec mb-4">
                    <div class="container">
                        <form action="{{ route('frontend.shop') }}" method="get">
                            <!-- Shop For -->
                            <div class="filter_wrap mb-4">
                                <div class="row gy-4 align-items-center">
                                    <div class="col-lg-3">
                                        <div class="filter_heading">
                                            <h3>Shop For</h3>
                                        </div>
                                    </div>
                                    <div class="col-lg-9">

                                        <div class="filter_button">
                                            @if(!empty($departments) && count($departments) > 0)
                                                @foreach($departments as $department)
                                                    <!-- onchange="changeFilter('{{ $department->slug }}')" -->
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="department"
                                                               value="{{$department->slug}}"
                                                               id="desk_{{$department->slug}}"
                                                            {{ request('department') == $department->slug ? 'checked' : '' }} >
                                                        <label class="form-check-label"
                                                               for="desk_{{$department->slug}}">
                                                            {{ $department->name }}
                                                        </label>
                                                    </div>
                                                @endforeach
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Select what are you searching for -->
                            <div class="filter_wrap mb-4">
                                <div class="row gy-4 align-items-center">
                                    <div class="col-lg-3">
                                        <div class="filter_heading">
                                            <h3>Category</h3>
                                        </div>
                                    </div>
                                    <div class="col-lg-9">
                                        <div class="filter_button">
                                            @if(isset($categories) && $categories->count() > 0)
                                                @foreach($categories as $category)
                                                    <div class="form-check">
                                                        <input
                                                            class="form-check-input cat_input_check {{ $category->department->slug }}"
                                                            type="radio"
                                                            name="category"
                                                            data-department="{{ $category->department->slug }}"
                                                            value="{{ $category->slug }}"
                                                            id="desk_{{$category->slug}}{{$category->id}}" {{ request('category') == $category->slug ? 'checked' : '' }} >
                                                        <label class="form-check-label"
                                                               for="desk_{{$category->slug}}{{$category->id}}">
                                                            {{ $category->name }}
                                                        </label>
                                                    </div>
                                                @endforeach
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Select your size -->
                            <div class="filter_wrap size_filter">
                                <div class="row gy-4 align-items-center">
                                    <div class="col-lg-3">
                                        <div class="filter_heading">
                                            <h3>Price</h3>
                                        </div>
                                    </div>
                                    <div class="col-lg-9">
                                        <div class="shop_price">
                                            <div class="input-group">
                                                <input type="number" name="min_price" id="from_price"
                                                       class="form-control" placeholder="Min" autocomplete="off"
                                                       value="{{ request('min_price') }}">
                                                <input type="number" name="max_price" id="to_price" class="form-control"
                                                       placeholder="Max" value="{{ request('max_price') }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="apply_btn text-center mt-5">
                                <button type="submit" class="btn btn-primary">Apply</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
