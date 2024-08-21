@extends('front.layouts.master')
@section('title', __('My Ads'))
@section('content')
    <!-- ============================== breadcrumb ================================= -->
    <div class="breadcrumb mb-5 d-none d-sm-block">
        <div class="container">
            <div class="breadcrumb_name">
                <h3>My Items</h3>
            </div>
        </div>
    </div>
    <!-- ============================== breadcrumb ================================= -->

    <!-- ============================== user ads ================================== -->
    <div class="user_ads_sec">
        <div class="container">
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 row-cols-xl-5 gy-3">
                <!-- product -->
                @if(!empty($ads) && count($ads) > 0)
                    @foreach($ads as $item)
                        <div class="col">
                            @include('front.single_product', $item)
                        </div>
                    @endforeach
                @else
                    <div class="col">
                        <h6>Item not found</h6>
                    </div>
                @endif
            </div>
            <!-- pagination -->
            <div class="pagination_nav mt-4 mb-4">
                <nav aria-label="Page navigation example">
                    <ul class="pagination justify-content-center">
                        {{ $ads->links() }}
                    </ul>
                </nav>
            </div>
            <!-- pagination -->
        </div>
    </div>
    <!-- ============================== user ads ================================== -->
@endsection
