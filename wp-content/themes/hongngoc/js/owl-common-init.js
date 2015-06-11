/**
 * Created by hoaint on 6/2/2015.
 */
jQuery.noConflict();
(function ($) {

    $(function () {

        $(".partners-carousel-section").owlCarousel({
            lazyLoad: true,
            itemsCustom: [[0, 1], [320, 1], [480, 2], [640, 3], [768, 4], [992, 4], [1200, 4]],
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
            navigationText: ["<i class='partners-icon-left-open'></i>", "<i class='partners-icon-right-open'></i>"]
        });

    });

})(jQuery);
