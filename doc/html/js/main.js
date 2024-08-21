(function ($) {
    "use strict";

    $(window).on('load', function(){
        // Prealoder
        $("#preloader").delay(700).fadeOut("slow");
    });

    $(document).ready(function () {

        //  Back to top button
        $(window).on('scroll', function () {
            if ($(this).scrollTop() > 600) {
                $('.back-to-top').fadeIn(200)
            } else {
                $('.back-to-top').fadeOut(200)
            }
        });
        $('.back-to-top').on('click', function (event) {
            event.preventDefault();
            $('html, body').animate({
                scrollTop: 0,
            }, 700);
        });


        // flagStrap
        $('#options').flagStrap({
            countries: {
                "LV": "LV",
                "ES": "Es",
                "US": "En"
            },
            buttonSize: "btn-sm",
            labelMargin: "10px",
            scrollable: false,
            scrollableHeight: "550px",
            placeholder: {
                value: "",
                text: ""
            }
        });


        // Hero Slider Initialize
        $('.hero_slider').slick({
            arrows: false,
            dots: false,
            infinite: true,
            autoplay: true,
            autoplaySpeed: 2000,
            speed: 1000,
            slidesToShow: 1,
            slidesToScroll: 1,
        }).slickAnimation();



        // Product Card Favorite Button
        $('.favorite_button').on('click', function () {
            $(this).toggleClass('checked');
        });



        // size list (sidebar)
        var tipsList = '.size_list .button';
        $(tipsList).on('click', function () {
            $(tipsList).removeClass('checked');
            $(this).addClass('checked');
        });



        //js range Initialize
        $(".js-range-slider").ionRangeSlider({
            type: "double",
            skin: "round",
            min: 10,
            max: 100,
            from: 30,
        });

        
        // nice select Initialize
        $('.nice-select').niceSelect();



        // pd main box slider Initialize
        $('#pd_main_box_slider').slick({
            infinite: true,
            speed: 300,
            slidesToShow: 1,
            dots: false,
            arrows: false,
        });
        $('[data-target]').on('click', function () {
            $('#pd_main_box_slider').slick('slickGoTo', $(this).attr('data-target'));
        });



        // product slider Initialize
        $('.product_slider').slick({
            dots: false,
            arrows: false,
            slidesToShow: 4,
            slidesToScroll: 1,
            responsive: [
                {
                    breakpoint: 992,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 1,
                    }
                }
            ]
        });

        

    });


})(jQuery);
