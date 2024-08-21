<!-- ============================== shop filter ================================== -->
<div class="shop_filter mb-4">
    <div class="container">
        <div class="row d-flex justify-content-center">

            <!-- mobile -->
            <div class="search_box mb-3 d-block d-sm-none">
                <div class="row gx-1 align-items-center">
                    <div class="col-10">
                        <form action="{{ route('frontend.shop') }}" method="get">
                            <div class="input-group">
                                <input type="text" name="keyword" id="search" class="form-control"
                                       placeholder="Search" value="{{ request('keyword') }}" required>
                                <button type="submit" class="input-group-text"><i class="la la-search"></i></button>
                            </div>
                        </form>
                    </div>
                    <div class="col-2">
                        <a href="javascript:void(0)" class="btn btn-primary" data-bs-toggle="modal"
                           data-bs-target="#filterModal">
                            <img src="{{ asset('front/assets/images/icons/filter.svg') }}" alt="image">
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-xl-6 d-none d-md-block">
                <div class="d-sm-flex justify-content-evenly align-items-center">
                    <div class="title text-center text-sm-start mb-3 mb-sm-0">
                        <h4>Shop For</h4>
                    </div>
                    <div class="filter_group_btn text-center text-sm-start">
                        @if(!empty($departments) && count($departments) > 0)
                            @foreach($departments as $dept)
                                <a href="{{ route('frontend.shop', $dept->slug) }}" class="btn btn-primary mb-1 mb-sm-0">{{ $dept->name }}</a>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@include('front.filter_modal')

<!-- ============================== shop filter ================================== -->
