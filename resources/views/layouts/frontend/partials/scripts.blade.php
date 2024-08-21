<script src="{{ asset('frontend') }}/js/plugins/jquery.min.js"></script>
{{-- <script src="{{asset('frontend/js/plugins/bvselect.js')}}"></script> --}}
<script src="{{ asset('frontend') }}/js/plugins/bootstrap.bundle.min.js"></script>
{{-- toastr notificaiton --}}
<script src="{{ asset('backend') }}/plugins/toastr/toastr.min.js"></script>
<script src="{{ asset('frontend/js/sweet-alert.min.js') }}"></script>
<script src="{{ asset('frontend/') }}/js/plugins/lan.js"></script>
<script src="{{ asset('frontend/js/chat.js') }}"></script> <!-- for pusher js in realtime chat -->
<script src="{{ asset('frontend/js/axios.min.js') }}"></script>
<script src="{{ asset('frontend/js/lg-thumbnail.umd.js') }}"></script>
<script src="{{ asset('frontend/js/lg-zoom.umd.js') }}"></script>
<script src="{{ asset('frontend/js/lightgallery.min.js') }}"></script>


<script src="{{ asset('frontend/plugins/owl-carousle/owl.carousel.min.js') }}"></script>

@yield('scripts')

<!-- lightgallery  -->
<script type="text/javascript">
    $(document).ready(function() {
        lightGallery(document.getElementById('lightgallery'), {
            download: false,
            speed: 500,
        });
    });

    $(function() {
        $('[data-toggle="tooltip"]').tooltip();
    });
</script>


<!-- Trending Products -->
<script>
    $('.trend_product').owlCarousel({
        loop: false,
        autoplay: true,
        autoplayTimeout: 5000,
        autoplayHoverPause: true,
        dots: false,
        nav: true,
        margin: 10,
        items: 6,
        slideBy: 6,
        navText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],
        responsive: {
            0: {
                items: 1,
            },
            576: {
                items: 2,
            },
            768: {
                items: 3,
            },
            992: {
                items: 4,
            },
            1220: {
                items: 6,
            },
        },
    });
</script>

<!-- Deals Products -->
<script>
    // $('.deals_product').owlCarousel({
    //     loop: false,
    //     autoplay: true,
    //     autoplayTimeout: 5000,
    //     autoplayHoverPause: true,
    //     dots: false,
    //     nav: true,
    //     margin: 10,
    //     items: 6,
    //     slideBy: 6,
    //     navText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],
    //     responsive: {
    //         0: {
    //             items: 1,
    //         },
    //         576: {
    //             items: 2,
    //         },
    //         768: {
    //             items: 3,
    //         },
    //         992: {
    //             items: 4,
    //         },
    //         1220: {
    //             items: 6,
    //         },
    //     },
    // });
</script>

<!-- Featured Products -->
<script>
    // $('.featured_product').owlCarousel({
    //     loop: false,
    //     autoplay: true,
    //     autoplayTimeout: 5000,
    //     autoplayHoverPause: true,
    //     dots: false,
    //     nav: true,
    //     margin: 10,
    //     items: 3,
    //     slideBy: 3,
    //     navText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],
    //     responsive: {
    //         0: {
    //             items: 1,
    //         },
    //         576: {
    //             items: 2,
    //         },
    //         768: {
    //             items: 3,
    //         },
    //         992: {
    //             items: 3,
    //         }
    //     },
    // });
</script>

<script>
    @if (Session::has('success'))
        toastr.success("{{ Session::get('success') }}", 'Success!')
    @elseif (Session::has('warning'))
        toastr.warning("{{ Session::get('warning') }}", 'Warning!')
    @elseif (Session::has('error'))
        toastr.error("{{ Session::get('error') }}", 'Error!')
    @endif
    // toast config
    toastr.options = {
        "closeButton": false,
        "debug": false,
        "newestOnTop": true,
        "progressBar": true,
        "positionClass": "toast-top-right",
        "preventDuplicates": true,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "hideMethod": "fadeOut"
    }

    $('.login_required').click(function(event) {
        event.preventDefault();
        swal({
                title: `Do you want to login?`,
                text: "If you do this action, you need to login your account first.",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: '#e64942',
                confirmButtonText: 'Login',
                closeOnConfirm: false,
                // closeOnCancel: false
            },
            function() {
                window.location.href = "{{ route('users.login') }}";
            });
    });
    $('#language_switch_button').on('click', function() {
        $('#switch_dropdown').toggle();
    });
</script>

<script type="module" src="{{ asset('frontend') }}/js/plugins/app.js"></script>

{!! $settings->body_script !!}
@stack('component_script')

<!-- Puhser Js  -->
<script>
    // message Echo / Pusher Section
    const authId_global = "{!! $auth_user_gloabl !!}";
    const current_route_name = "{!! $current_route_name !!}";
    if (current_route_name !== "frontend.message") {

        window.Echo.private(`chat.${authId_global}`)
            .listen('MessageEvent', (e) => {
                if (e) {
                    // also show toast
                    toastr.success("You have new unseen message from " + e.user.name + "", 'New Message!!')
                    // unread message count div increament
                    // unread_count_custom3
                    $('#unread_count_custom3').removeClass('d-none'); //css class remove
                    var unreadAmount = $('#unread_count_custom3').attr('amount');
                    var amount = parseInt(unreadAmount) + parseInt(1);
                    $('#unread_count_custom3').attr('amount', parseInt(amount));
                    $('#unread_count_custom3').html(amount);
                    // unread_count_custom4
                    $('#unread_count_custom4').removeClass('d-none'); //css class remove
                    var unreadAmount1 = $('#unread_count_custom4').attr('amount');
                    var amount1 = parseInt(unreadAmount1) + parseInt(1);
                    $('#unread_count_custom4').attr('amount', parseInt(amount1));
                    $('#unread_count_custom4').html(amount1);
                    // unread_count_custom2
                    $('#unread_count_custom2').removeClass('d-none'); //css class remove
                    var unreadAmount2 = $('#unread_count_custom2').attr('amount');
                    var amount2 = parseInt(unreadAmount2) + parseInt(1);
                    $('#unread_count_custom2').attr('amount', parseInt(amount2));
                    $('#unread_count_custom2').html('(' + amount2 + ')');
                }
            });
    }
</script>



<script>
    function addToWishList(event) {
        let ad_id = event.target.value;
        let isChecked = ($('#' + event.target.id).is(':checked') ? true : false);

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        axios.post("{{ route('frontend.addToWishList') }}", {
                isChecked: isChecked,
                ad_id: ad_id
            })
            .then(function(response) {

                $('.favorite_count').html(response.data.count)
                toastr.success(response.data.message);
            })
            .catch(function(error) {
                console.log(error);
            });
    }
</script>

<script>
    $("#username_error").hide()
    $("#email_error").hide()
    $("#password_error").hide()
    $(".username_error").hide()
    $(".username_error").hide()

    $('#registerForm').submit(function(e) {
        e.preventDefault();
        // alert(1);

        $('.registration-form__btns').html(`
            <div class="d-flex justify-content-center" style="padding: 8px;">
                <div class="spinner-border" role="status">
                    <span class="visually-hidden">
                        Loading...
                    </span>
                </div>
            </div>
            `);

        $(".registration-form__btns").attr("disabled", true);

        let url = this.action;
        let name = $('#name').val();
        let username = $('#username').val();
        let email = $('#email').val();
        let password = $('#password').val();
        let password_confirmation = $('#password_confirmation').val();
        axios.post(url, {
                name: name,
                username: username,
                email: email,
                password: password,
                password_confirmation: password_confirmation,
            })
            .then(function(response) {

                $('.registration-form__btns').html(`
                    Sign Up
                    <span class="icon--right">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"xmlns="http://www.w3.org/2000/svg">
                            <path d="M3.75 12H20.25" stroke="#fff" stroke-width="1.6" stroke-linecap="round"stroke-linejoin="round"></path>
                            <path d="M13.5 5.25L20.25 12L13.5 18.75" stroke="#fff" stroke-width="1.6"stroke-linecap="round" stroke-linejoin="round"></path>
                        </svg>
                    </span>
                `);

                console.log(response);

                if (response.data == "success") {
                    window.location.href = '{{ route('frontend.coupons') }}'
                } else if (response.data == "verification") {
                    window.location.href = '{{ route('verification.notice') }}'
                }

                if (Object.keys(response.data) == "error") {

                    $(".registration-form__btns").attr("disabled", false);

                    let errors = Object.keys(response.data.error);
                    for (let i = 0; i < errors.length; i++) {
                        const element = errors[i];
                        $('#' + element + '_error').html(response.data.error[element]);
                        $('#' + element + '_error').show();
                    }
                    error.each((e) => {
                        console.log(e);
                    })
                }
            })
            .catch(function(errors) {
                console.log(errors);
            });
    });

    $('#loginForm').submit(function(event) {
        event.preventDefault();

        $('.login_btn').html(
            '<div class="d-flex justify-content-center"><div class="spinner-border" role="status"><span class="visually-hidden">Loading...</span></div></div>'
        );

        let url = this.action;
        let login_data = $('#login_data').val();
        let login_password = $('#login_password').val();
        // console.dir({url,login_data,login_password});

        axios.post(url, {
                login_data: login_data,
                password: login_password
            })
            .then(function(response) {
                $('.login_btn').html('Login');
                console.log(response.data.coupons);
                if (response.status == 203) {

                    if (response.data.coupons > 0) {
                        window.location.href = '{{ route('frontend.dashboard') }}'
                    } else {
                        window.location.href = '{{ route('frontend.coupons') }}'
                    }
                }
                if (Object.keys(response.data) == "error") {
                    let errors = Object.keys(response.data.error);
                    for (let i = 0; i < errors.length; i++) {
                        const element = errors[i];
                        $('.' + element + '_login_error').html(response.data.error[element]);
                        $('.' + element + '_login_error').show();

                    }
                }

            })
            .catch(function(error) {
                console.log(error);
            });

    });
</script>
@include('pushnotification::index')
