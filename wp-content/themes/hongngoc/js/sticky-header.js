/**
 * Created by hoaint on 6/2/2015.
 */
jQuery(function ($) {
    var stickyHeaderTop = $('.site-header').offset().top;
    $(window).scroll(function () {
        //var yPos = ( $(window).scrollTop() );
        if ($(window).scrollTop() > stickyHeaderTop) { // show sticky menu after screen has scrolled down 200px from the top
            $('.site-header').css({position: 'fixed', top: '0', width: '100%', 'z-index': '9999'});
            $('#stickyalias').css('display', 'block');
        } else {
            $('.site-header').css({position: 'static'});
            $('#stickyalias').css('display', 'none');
        }
    });
});
