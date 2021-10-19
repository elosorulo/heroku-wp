jQuery(document).ready(function($) {
    'use strict';

    if(cutemag_ajax_object.secondary_menu_active){

        $(".cutemag-nav-secondary .cutemag-secondary-nav-menu").addClass("cutemag-secondary-responsive-menu");

        $( ".cutemag-secondary-responsive-menu-icon" ).on( "click", function() {
            $(this).next(".cutemag-nav-secondary .cutemag-secondary-nav-menu").slideToggle();
        });

        $(window).on( "resize", function() {
            if(window.innerWidth > 1112) {
                $(".cutemag-nav-secondary .cutemag-secondary-nav-menu, nav .sub-menu, nav .children").removeAttr("style");
                $(".cutemag-secondary-responsive-menu > li").removeClass("cutemag-secondary-menu-open");
            }
        });

        $( ".cutemag-secondary-responsive-menu > li" ).on( "click", function(event) {
            if (event.target !== this)
            return;
            $(this).find(".sub-menu:first").toggleClass('cutemag-submenu-toggle').parent().toggleClass("cutemag-secondary-menu-open");
            $(this).find(".children:first").toggleClass('cutemag-submenu-toggle').parent().toggleClass("cutemag-secondary-menu-open");
        });

        $( "div.cutemag-secondary-responsive-menu > ul > li" ).on( "click", function(event) {
            if (event.target !== this)
                return;
            $(this).find("ul:first").toggleClass('cutemag-submenu-toggle').parent().toggleClass("cutemag-secondary-menu-open");
        });

    }

    if(cutemag_ajax_object.primary_menu_active){

        // grab the initial top offset of the navigation 
        var cutemagstickyNavTop = $('.cutemag-primary-menu-container').offset().top;
        
        // our function that decides weather the navigation bar should have "fixed" css position or not.
        var cutemagstickyNav = function(){
            var cutemagscrollTop = $(window).scrollTop(); // our current vertical position from the top
                 
            // if we've scrolled more than the navigation, change its position to fixed to stick to top,
            // otherwise change it back to relative

            if(window.innerWidth > 1112) {
                if (cutemagscrollTop > cutemagstickyNavTop) {
                    $('.cutemag-primary-menu-container').addClass('cutemag-fixed');
                } else {
                    $('.cutemag-primary-menu-container').removeClass('cutemag-fixed'); 
                }
            }
        };

        cutemagstickyNav();
        // and run it again every time you scroll
        $(window).on( "scroll", function() {
            cutemagstickyNav();
        });

        $(".cutemag-nav-primary .cutemag-primary-nav-menu").addClass("cutemag-primary-responsive-menu");

        $( ".cutemag-primary-responsive-menu-icon" ).on( "click", function() {
            $(this).next(".cutemag-nav-primary .cutemag-primary-nav-menu").slideToggle();
        });

        $(window).on( "resize", function() {
            if(window.innerWidth > 1112) {
                $(".cutemag-nav-primary .cutemag-primary-nav-menu, nav .sub-menu, nav .children").removeAttr("style");
                $(".cutemag-primary-responsive-menu > li").removeClass("cutemag-primary-menu-open");
            }
        });

        $( ".cutemag-primary-responsive-menu > li" ).on( "click", function(event) {
            if (event.target !== this)
            return;
            $(this).find(".sub-menu:first").toggleClass('cutemag-submenu-toggle').parent().toggleClass("cutemag-primary-menu-open");
            $(this).find(".children:first").toggleClass('cutemag-submenu-toggle').parent().toggleClass("cutemag-primary-menu-open");
        });

        $( "div.cutemag-primary-responsive-menu > ul > li" ).on( "click", function(event) {
            if (event.target !== this)
                return;
            $(this).find("ul:first").toggleClass('cutemag-submenu-toggle').parent().toggleClass("cutemag-primary-menu-open");
        });

    }

    if($(".cutemag-social-icon-search").length){
        $(".cutemag-social-icon-search").on('click', function (e) {
            e.preventDefault();
            document.getElementById("cutemag-search-overlay-wrap").style.display = "block";
            const cutemag_focusableelements = 'button, [href], input';
            const cutemag_search_modal = document.querySelector('#cutemag-search-overlay-wrap');
            const cutemag_firstfocusableelement = cutemag_search_modal.querySelectorAll(cutemag_focusableelements)[0];
            const cutemag_focusablecontent = cutemag_search_modal.querySelectorAll(cutemag_focusableelements);
            const cutemag_lastfocusableelement = cutemag_focusablecontent[cutemag_focusablecontent.length - 1];
            document.addEventListener('keydown', function(e) {
              let isTabPressed = e.key === 'Tab' || e.keyCode === 9;
              if (!isTabPressed) {
                return;
              }
              if (e.shiftKey) {
                if (document.activeElement === cutemag_firstfocusableelement) {
                  cutemag_lastfocusableelement.focus();
                  e.preventDefault();
                }
              } else {
                if (document.activeElement === cutemag_lastfocusableelement) {
                  cutemag_firstfocusableelement.focus();
                  e.preventDefault();
                }
              }
            });
            cutemag_firstfocusableelement.focus();
        });
    }

    if($(".cutemag-search-closebtn").length){
        $(".cutemag-search-closebtn").on('click', function (e) {
            e.preventDefault();
            document.getElementById("cutemag-search-overlay-wrap").style.display = "none";
        });
    }

    if(cutemag_ajax_object.fitvids_active){
        $(".post").fitVids();
    }

    if(cutemag_ajax_object.backtotop_active){
        if($(".cutemag-scroll-top").length){
            var cutemag_scroll_button = $( '.cutemag-scroll-top' );
            cutemag_scroll_button.hide();

            $(window).on( "scroll", function() {
                if ( $( window ).scrollTop() < 20 ) {
                    $( '.cutemag-scroll-top' ).fadeOut();
                } else {
                    $( '.cutemag-scroll-top' ).fadeIn();
                }
            } );

            cutemag_scroll_button.on( "click", function() {
                $( "html, body" ).animate( { scrollTop: 0 }, 300 );
                return false;
            } );
        }
    }

    if(cutemag_ajax_object.sticky_sidebar_active){
    $('.cutemag-main-wrapper, .cutemag-sidebar-wrapper').theiaStickySidebar({
        containerSelector: ".cutemag-content-wrapper",
        additionalMarginTop: 0,
        additionalMarginBottom: 0,
        minWidth: 960,
    });

    $(window).on( "resize", function() {
        $('.cutemag-main-wrapper, .cutemag-sidebar-wrapper').theiaStickySidebar({
            containerSelector: ".cutemag-content-wrapper",
            additionalMarginTop: 0,
            additionalMarginBottom: 0,
            minWidth: 960,
        });
    });
    }

});