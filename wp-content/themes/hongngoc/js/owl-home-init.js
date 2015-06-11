/**
 * Created by hoaint on 6/2/2015.
 */
jQuery.noConflict();
(function ($) {

    $(function () {

        $(".slider-carousel-news").owlCarousel({
            lazyLoad: true,
            itemsCustom: [[0, 1], [320, 1], [480, 2], [768, 2], [992, 4], [1152, 4]],
            responsiveRefreshRate: 50,
            slideSpeed: 200,
            paginationSpeed: 500,
            scrollPerPage: false,
            stopOnHover: true,
            rewindNav: true,
            rewindSpeed: 600,
            pagination: false,
            navigation: true,
            autoPlay: true,
            navigationText: ["<i class='icon-left-open'></i>", "<i class='icon-right-open'></i>"]
        });

    });

})(jQuery);
