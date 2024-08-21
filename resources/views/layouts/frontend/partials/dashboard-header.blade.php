@php
    $user = auth('user')->user();
    $ads = Modules\Ad\Entities\Ad::where('user_id', $user->id)->get('id');

    $ads_array = [];
    foreach ($ads as $id) {
        array_push($ads_array, $id->id);
    }
    $reviews = Modules\Review\Entities\Review::with([
        'ads' => function ($q) use ($user) {
            $q->with(['category', 'subcategory', 'childcategory'])->where('user_id', $user->id);
        },
    ])
        ->whereIn('item_id', $ads_array)
        ->get();

    $rating_details = [
        'total' => $reviews->count(),
        'rating' => $reviews->sum('stars'),
        'average' => number_format($reviews->avg('stars')),
    ];

    $userFollower = App\Models\UserFollower::where('seller_id', $user->id)->count();

@endphp
<div class="user_header mb-3">
    <div class="user_info">
        <div class="row mb-2">
            <div class="col-lg-9">
                <div class="user_profile mb-4 md-lg-0">
                    <div class="d-flex position-relative">
                        <div class="profile_photo">
                            <img src="{{ getPhotoAvater($user->image) }}" class="flex-shrink-0 me-3 rounded-circle"
                                alt="image">
                        </div>
                        <div class="profile_info">
                            <h3>{{ $user->name }}</h3>
                            <div class="d-md-flex">
                                <div class="info_div"
                                    style="border:none; padding-left: 0px !important; padding-right:15px !important;">
                                    <h6>{{ __('joined in') }} {{ date('Y', strtotime($user->created_at)) }}</h6>
                                    <p><i class="fa fa-globe"></i> {{ $user->country->locations ?? 'N/A' }}</p>
                                </div>
                                <div class="info_left">
                                    {{-- <span style="padding-right: 10px">{{ $rating_details['average'] }}
                                        {{ __('star rating') }}</span> --}}

                                    <div class="info_div sm_info">
                                        <h3>
                                            <span>{{ $rating_details['average'] }}</span>
                                            @for ($i = 0; $i < $rating_details['average']; $i++)
                                                <i class="fa fa-star"></i>
                                            @endfor

                                        </h3>
                                        <p>{{ $user->reviews->count() }} {{ __('reviews') }}</p>
                                    </div>
                                    {{-- <div class="info_div sm_info">
                                        <h3>{{ $user->completeTransactions->count() }}</h3>
                                        <p>Transactions</p>
                                    </div> --}}
                                    <div class="info_div sm_info">
                                        <h3>{{ $userFollower }}</h3>
                                        <p>{{ __('followers') }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="user_follow d-flex justify-content-end">

                    @auth

                        @if ($user->username !== auth()->user()->username)
                            @if ($isFoollwer)
                                <a
                                    href="{{ route('frontend.seller.sellerFollow', ['user' => $user->id, 'status' => 'unfollow']) }}">
                                    {{ __('unfollow') }}</a>
                            @else
                                <a
                                    href="{{ route('frontend.seller.sellerFollow', ['user' => $user->id, 'status' => 'follow']) }}">{{ __('follow') }}</a>
                            @endif
                        @endif
                    @endauth

                    @guest
                        <a href="#" data-bs-toggle="modal" data-bs-target="#loginModal">{{ __('follow') }}</a>
                    @endguest


                    <div>
                        <button class="dropdown-toggle" type="button" id="dropdownMenuButton1"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <svg class="UserShareDropdown-module__dropdown___DVl8L" height="16px" width="20px"
                                viewBox="0 0 16 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M7.72178 13.0493C8.15016 13.0493 8.51263 12.6906 8.51263 12.2646V3.52019L8.44674 2.1749L8.90805 2.69059L10.1163 4.02466C10.2591 4.18161 10.4568 4.26009 10.6435 4.26009C11.0609 4.26009 11.3685 3.96862 11.3685 3.56503C11.3685 3.34081 11.2806 3.18386 11.1268 3.03813L8.29296 0.269065C8.09525 0.067273 7.93047 0 7.72178 0C7.52407 0 7.35931 0.067273 7.1616 0.269065L4.31673 3.03813C4.17393 3.18386 4.08607 3.34081 4.08607 3.56503C4.08607 3.96862 4.38262 4.26009 4.80002 4.26009C4.98676 4.26009 5.19545 4.18161 5.33825 4.02466L6.54649 2.69059L7.00782 2.1749L6.94191 3.52019V12.2646C6.94191 12.6906 7.30438 13.0493 7.72178 13.0493ZM2.80093 20H12.6536C14.5319 20 15.4545 19.0583 15.4545 17.1749V8.57625C15.4545 6.69282 14.5319 5.75114 12.6536 5.75114H10.2921V7.3767H12.6317C13.4115 7.3767 13.8728 7.81392 13.8728 8.65472V17.0964C13.8728 17.9484 13.4115 18.3744 12.6317 18.3744H2.82291C2.03204 18.3744 1.58171 17.9484 1.58171 17.0964V8.65472C1.58171 7.81392 2.03204 7.3767 2.82291 7.3767H5.16249V5.75114H2.80093C0.933641 5.75114 0 6.69282 0 8.57625V17.1749C0 19.0583 0.933641 20 2.80093 20Z"
                                    fill="black"></path>
                            </svg>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton1">
                            <li><a
                                    href="https://www.facebook.com/share.php?u={{ url()->current() }}">{{ __('share on facebook') }}</a>
                            </li>
                            <li><a
                                    href="https://twitter.com/intent/tweet?url={{ url()->current() }}">{{ __('share on twitter') }}</a>
                            </li>
                            <li><a href="#" onclick="copyText()">{{ __('copy link') }}</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="row g-3">
            <div class="col-md-6 col-lg-4">
                <div class="userinfo_module">
                    @if ($user->bio)
                        <div class="seller-info">
                            <p>{!! $user->bio !!}</p>
                        </div>
                    @endif

                </div>
            </div>
            <div class="col-md-6 col-lg-8">
                <div class="sellere_tag">
                    <ul>
                        @if ($user->trusted_seller)
                            <li class="me-5">
                                <svg class="--trusted-seller-flair" height="17px" width="17px" viewBox="0 0 12 16"
                                    fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M9.48013 15.3371V10.0794C10.6878 9.02611 11.4597 7.47333 11.4688 5.75711C11.4779 2.57889 8.87173 0 5.72985 0C2.58798 0 0 2.57889 0 5.75711C0 7.48241 0.780938 9.04426 1.99772 10.0976L2.00682 15.3371C2.00682 15.8093 2.25198 16 2.56981 16C2.82407 16 3.03291 15.8456 3.24177 15.6368L5.50284 13.3848C5.59365 13.3031 5.66629 13.2758 5.73893 13.2758C5.81157 13.2758 5.88423 13.3031 5.97502 13.3848L8.23608 15.6368C8.45402 15.8547 8.66289 16 8.91714 16C9.24404 16 9.48013 15.8093 9.48013 15.3371ZM5.73893 10.2157C3.25085 10.2066 1.32576 8.22702 1.32576 5.75711C1.32576 3.26903 3.25085 1.28944 5.73893 1.28944C8.22701 1.28944 10.143 3.26903 10.1521 5.75711C10.1612 8.22702 8.22701 10.2247 5.73893 10.2157Z"
                                        fill="#0000FF"></path>
                                </svg>
                                {{ __('trusted seller') }}
                            </li>
                        @endif
                        @if ($user->quick_responder)
                            <li>
                                <svg class="--quick-responder-flair" height="17px" width="17px" viewBox="0 0 12 16"
                                    fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M4.48382 15.621L11.038 7.38113C11.7284 6.50246 11.3967 5.82104 10.518 5.82104H7.47849L8.3751 0.97037C8.54545 0.0468623 7.54126 -0.347639 6.96743 0.369639L0.377341 8.66329C-0.322013 9.533 0.00973197 10.2144 0.888411 10.2144H3.92791L3.0313 15.0651C2.86095 15.9886 3.90999 16.3293 4.48382 15.621ZM4.34035 13.9084L5.32662 9.73025C5.43421 9.29988 5.3087 9.00399 4.8335 9.00399H1.60569V8.96813L6.97639 2.11803H7.07501L6.07978 6.31417C5.97218 6.73557 6.0977 7.03145 6.57291 7.03145H9.80069V7.06733L4.43002 13.9084H4.34035Z"
                                        fill="#0000FF"></path>
                                </svg>
                                {{ __('quick responder') }}
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@section('scripts')
    <script>
        function copyText() {
            navigator.clipboard.writeText(
                "{{ route('frontend.seller.profile', ['user' => auth('user')->user()->username]) }}");
            toastr.success("Copy to clipboard");
        }
    </script>
@endsection
