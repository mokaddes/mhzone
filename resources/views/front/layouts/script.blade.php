<script src="{{ asset('front/assets/js/jquery.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.js"></script>
<script src="{{ asset('front/assets/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('backend') }}/plugins/toastr/toastr.min.js"></script>

<script>
    $(document).ready(function () {
        // banner product
        new Swiper('.banner_product', {
            loop: true,
            slidesPerView: 4,
            paginationClickable: true,
            pagination: {
                el: '.swiper-pagination',
                clickable: true
            },
            spaceBetween: 20,
            breakpoints: {
                0: {
                    slidesPerView: 1,
                    spaceBetween: 10
                }
            },
            autoplay:{
                delay:6000,
                pauseOnMouseEnter:true,
            },
            effect: "creative",
            creativeEffect: {
                prev: {
                    shadow: true,
                    translate: ["-120%", 0, -500],
                },
                next: {
                    shadow: true,
                    translate: ["120%", 0, -500],
                },
            },
        });

        // arrivals products
        new Swiper('.arrivals_products', {
            loop: false,
            slidesPerView: 4,
            paginationClickable: true,
            pagination: {
                el: '.swiper-pagination',
                clickable: true
            },
            spaceBetween: 20,
            breakpoints: {
                1400: {
                    slidesPerView: 4,
                    spaceBetween: 30
                },
                992: {
                    slidesPerView: 3,
                    spaceBetween: 30
                },
                575: {
                    slidesPerView: 2,
                    spaceBetween: 10
                },
                500: {
                    slidesPerView: 1,
                    spaceBetween: 10
                },
                0: {
                    slidesPerView: 1,
                    spaceBetween: 10
                }
            }
        });
    });

    @if (Session::has('success'))
    toastr.success("{{ Session::get('success') }}", 'Success!')
    @elseif (Session::has('warning'))
    toastr.warning("{{ Session::get('warning') }}", 'Warning!')
    @elseif (Session::has('error'))
    toastr.error("{{ Session::get('error') }}", 'Error!')
    @elseif (Session::has('status'))
    toastr.success("{{ Session::get('status') }}", 'Success!')
    @endif
    // toast config
    toastr.options = {
        "closeButton": true,
        "debug": false,
        "newestOnTop": true,
        "progressBar": true,
        "positionClass": "toast-top-right",
        // "preventDuplicates": true,
        // "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "hideMethod": "fadeOut"
    }

    @if ($errors->any())
    @foreach ($errors->all() as $error)
    toastr.error("{{ $error }}", 'Error!')
    @endforeach
    @endif




</script>
<script>
    function AddWishlist(item, user) {
        if (user) {
            $.ajax({
                type: "get",
                url: "{{ route('frontend.addToFavorite') }}",
                data: {
                    id: item,
                    user: user,
                },
                success: function (data) {
                    console.log(data)
                    if (data.status == 'failed') {
                        toastr.error('Wishlist removed successfully')
                    } else {
                        toastr.success('Wishlist added successfully')

                    }
                }
            });
        } else {
            $('#favorite_' + item).prop('checked', false)
            toastr.error('Please login first');
        }
    }

    $(document).ready(function () {
        // Add event listener for form submissions
        $(document).on('submit', 'form', function () {
            let submitButton = $(this).find(':submit');
            submitButton.html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading...');
            // Disable the submit button and add the loading class
            submitButton.prop('disabled', true);
        });
    });

</script>
@stack('js')
