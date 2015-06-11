/**
 * Created by hoaint on 6/9/2015.
 */
jQuery.noConflict();
(function ($) {

    $(function () {

        $(".slider-carousel-news").owlCarousel({
            autoPlay: true,
            lazyLoad: true,
            stopOnHover: true,
            pagination: false,
            autoPlay: true,
            navigation: true,
            navigationText: ["<i class='icon-chevron-left'></i>", "<i class='icon-chevron-right'></i>"],
            slideSpeed: 500,
            paginationSpeed: 500,
            singleItem: true,
            transitionStyle: "fade"
        });

    });
})(jQuery);
