    $(document).ready(function() {
        $('#mitra-kerjasama-slider').on('init', function(event, slick) {
            adjustSlickSlidesToShow($(this), 7);
        });

        $(window).on('resize orientationchange', function() {
            adjustSlickSlidesToShow($('#mitra-kerjasama-slider'), 7);
        });

        $('#mitra-kerjasama-slider').slick({
            slidesToShow: 7,
            slidesToScroll: 1,
            autoplay: true,
            autoplaySpeed: 2000,
            arrows: true,
            dots: false
        });
    });

    $(document).ready(function() {
        $('.weekly2-news-active:not(#mitra-kerjasama-slider)').on('init', function(event, slick) {
            adjustSlickSlidesToShow($(this), 4);
        });

        $(window).on('resize orientationchange', function() {
            $('.weekly2-news-active:not(#mitra-kerjasama-slider)').each(function() {
                adjustSlickSlidesToShow($(this), 4);
            });
        });

        $('.weekly2-news-active:not(#mitra-kerjasama-slider)').slick({
            slidesToShow: 4,
            slidesToScroll: 1,
            autoplay: true,
            autoplaySpeed: 2000,
            arrows: true,
            dots: false
        });
    });

    function adjustSlickSlidesToShow(slider, slidesToShow) {
        var windowWidth = $(window).width();

        if (windowWidth < 992) {
            slidesToShow = 4;
        }
        if (windowWidth < 768) {
            slidesToShow = 3;
        }
        if (windowWidth < 576) {
            slidesToShow = 2;
        }

        slider.slick('slickSetOption', 'slidesToShow', slidesToShow, true);
    }