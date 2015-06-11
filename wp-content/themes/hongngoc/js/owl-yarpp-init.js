/**
 * Created by hoaint on 6/10/2015.
 */
jQuery.noConflict();
(function ($) {

    $(function () {

        $(".related-post-carousel").owlCarousel({
            lazyLoad: true,
            itemsCustom: [[0, 1], [320, 1], [480, 2], [640, 2], [768, 3], [992, 3], [1152, 3]],
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
            autoWidth: false,
            navigationText: ["", ""]
        });

    });

})(jQuery);