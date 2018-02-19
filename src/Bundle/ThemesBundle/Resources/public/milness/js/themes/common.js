"use strict";

(function ($) {

    /*-------------------------------------
     Global vars
     -------------------------------------*/
    var window_page = $(window);

    /*-------------------------------------
     Loader
     -------------------------------------*/
    window_page.load(function () {

        $('#status').fadeOut();
        $('#preloader').delay(1000).fadeOut('slow');
        /*-------------------------------------
         Particles
         -------------------------------------*/
        $('#particles-js').particleground({
            dotColor: 'rgba(255, 255, 255, 0.40)',
            lineColor: 'rgba(255, 255, 255, 0.21)',
            parallaxMultiplier: 5,
            particleRadius: 5,
            proximity: 130,
            density: 12000
        });


    });

    /*-------------------------------------
    Top menu - Superfish
    -------------------------------------*/
    $('ul.sf-menu').superfish({
        delay: 200,
        speed: 'fast',
        cssArrows: true,
        disableHI: false,
        easing: 'fade',
        touchMove: false,
        swipe: false
    });

    /*-------------------------------------
     Top nav
     -------------------------------------*/
    $(function(){
        // scroll is still position
        var scroll = $(document).scrollTop(),
            headerHeight = $('.page-header').outerHeight();
        //console.log(headerHeight);

        /*-------------------------------------
         Top menu - fixed
         -------------------------------------*/
        $(window).on('scroll', function() {
            var winTop = $(window).scrollTop(),
                top_nav = $("#top-nav");

            if(winTop >= 150){
                top_nav.addClass("is-sticky");
            }else{
                top_nav.removeClass("is-sticky");
            }
            /*-------------------------------------
             Back to top link
             -------------------------------------*/
        })
    });

    /*-------------------------------------
    Drag images restagt
    -------------------------------------*/
    $('img, a').on('dragstart', function(event) { event.preventDefault(); });

    /*-------------------------------------
     Smooth Scroll to link
     -------------------------------------*/
    $(document).on('click', 'a[href^="#"]', function(e) {
        var id = $(this).attr('href');
        // target element
        var $id = $(id);
        if ($id.length === 0) {
            return;
        }

        if($('.single-product').length === 0){
            e.preventDefault();
            var pos = $id.offset().top;
            $('html, body').stop().animate({
                scrollTop: pos
            }, {
                duration: 1000,
                specialEasing: {
                    width: "linear",
                    height: "easeInOutCubic"
                }
            });
        }

    });

    /*-------------------------------------
    Slider animation full screen
    -------------------------------------*/

    $('.full-slider').on('afterChange', function(event, slick, currentSlide){
        $('.slick-active .heading-title-big').removeClass('opacity-none');
        $('.slick-active .heading-title-big').addClass('animated fadeInDown');
        //
        $('.slick-active .description').removeClass('opacity-none');
        $('.slick-active .description').addClass('animated slideInUp');
        //
        $('.slick-active .buttons-download').removeClass('opacity-none');
        $('.slick-active .buttons-download').addClass('animated fadeInDown');

    });

    $('.full-slider').on('beforeChange', function(event, slick, currentSlide){
        $('.slick-active .heading-title-big').addClass('opacity-none');
        $('.slick-active .heading-title-big').removeClass('animated fadeInDown');
        //
        $('.slick-active .description').addClass('opacity-none');
        $('.slick-active .description').removeClass('animated slideInUp');
        //
        $('.slick-active .buttons-download').addClass('opacity-none');
        $('.slick-active .buttons-download').removeClass('animated fadeInDown');
    });



    /*-------------------------------------
    Background slider function
    -------------------------------------*/
    $('.slide, .hero-background-slider, .fixed-image, .background-image').each(function(){
        var url = $(this).attr('data-image');
        if(url){
            $(this).css('background-image', 'url(' + url + ')');
        }
    });

    /*-------------------------------------
    Back to top link
    -------------------------------------*/
    $(document).scroll(function () {
        var y = $(this).scrollTop();
        if (y > 500) {
            $('.top').fadeIn('slow');
        } else {
            $('.top').fadeOut('slow');
        }
    });

    /*-------------------------------------
    Animation blocks
    -------------------------------------*/
    if (typeof $.fn.animated !== 'undefined') {
        $(function () {
            if( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {
            } else {
                $('.iphone-nalf').animated('fadeInUp');
                $('.section-class-image > img').animated('fadeInUp');
                $('.iphones > .right-mob-back, .left-mob-back').animated('fadeInUp');
                $('.heading-title > .al-headitg-title').animated('fadeInDown');
                $('.heading-title > .al-subtitle').animated('fadeInUp');
            }
        }());
    }

    /*-------------------------------------
    Mobile menu - full screen menu
    -------------------------------------*/
    $(function() {

        var $menu = $('#mobile-menu'),
            $body = $('body'),
            $fn = $('#mobile-menu'),
            $fnToggle = $('.toggle-mnu'),
            $window = $(window);

        $menu.find('.menu-item-has-children > a').on('click', function(e) {
            e.preventDefault();
            if ($(this).next('ul').is(':visible')) {
                $(this).removeClass('sub-active').next('ul').slideUp(250);
            } else {
                $('.menu-item-has-children > a').removeClass('sub-active').next('ul').slideUp(250);
                $(this).addClass('sub-active').next('ul').slideToggle(250);
            }
        });

        var fnOpen = false;

        var fnToggleFunc = function() {
            fnOpen = !fnOpen;
            $body.toggleClass('fullscreen-nav-open');
            $fn.stop().fadeToggle(500);
            $('.toggle-mnu').toggleClass('on');
            $('.logo').toggleClass('on');

            return false;
        };

        $fnToggle.on('click', fnToggleFunc);

        $(document).on('keyup', function(e) {
            if (e.keyCode == 27 && fnOpen) {
                fnToggleFunc();
            }
        });

        $fn.find('li:not(.menu-item-has-children) > a').one('click', function() {
            fnToggleFunc();
            return true;
        });

        $menu.on('click', function(){
            fnToggleFunc();
            return true;
        });

        $('.inner-wrap, .fullscreen-menu-toggle').on('click', function(e){
            e.stopPropagation();
        });
    });

    /*-------------------------------------
     Parallax
     -------------------------------------*/
    $('.jarallax').jarallax({
        speed: -0.2,
        noAndroid: true
    });


    /*-------------------------------------
    Mailchimp subscribe form processing
    -------------------------------------*/
    $('#signup').on('submit', function( e ) {
        e.preventDefault();
        // update user interface
        $('#response').html('Adding email address...');

        // Prepare query string and send AJAX request
        jQuery.ajax({
            url: 'mailchimp/store-address.php',
            data: 'ajax=true&email=' + escape($('#mailchimp_email').val()),
            success: function(msg) {
                $('#response').html(msg);
                $('#response').slideToggle( 'slow' );
            }
        });
    });


    /*-------------------------------------
    Remove 100vh heigth in slider on the mobile devices
    -------------------------------------*/
    $(function () {
        if( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {
            $('.slide').removeClass('vertical-align');
        }
    }());

    /*-------------------------------------
     Masonry
     -------------------------------------*/
    $('.br-shop-masonry-container').imagesLoaded(function(){
        $('.br-shop-masonry-container').isotope({
            layoutMode: 'masonry',
            itemSelector: '.br-shop-masonry-item',
            transitionDuration: '0.3s'
        });
    });


})(jQuery);

