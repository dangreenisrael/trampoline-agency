/*!
 * Agency v1.0.x (http://startbootstrap.com/template-overviews/agency)
 * Copyright 2013-2016 Start Bootstrap
 * Licensed under MIT (https://github.com/BlackrockDigital/startbootstrap/blob/gh-pages/LICENSE)
 */

jQuery(document).ready(function () {
    // jQuery for page scrolling feature - requires jQuery Easing plugin
    jQuery(function() {
        jQuery('a.page-scroll').bind('click', function(event) {
            var jQueryanchor = jQuery(this);
            jQuery('html, body').stop().animate({
                scrollTop: jQuery(jQueryanchor.attr('href')).offset().top
            }, 1500, 'easeInOutExpo');
            event.preventDefault();
        });
    });
    var body = jQuery('body');

// Highlight the top nav as scrolling occurs
    body.scrollspy({
        target: '.navbar-fixed-top'
    });

// Closes the Responsive Menu on Menu Item Click
    var navBox = jQuery('#nav-main').find('.navbar-mobilized');
    var menuToggle = jQuery('#toggleMenu');
    var backdrop = jQuery('#backdrop');
    var showingMenu = false;
    var hideOnContent = function () {
        jQuery('#content').one('click', function () {
            navBox.removeClass('show');
            backdrop.modal('hide');
        })
    };
    menuToggle.on('click',function() {
        if(!showingMenu){
            showingMenu = true;
            navBox.addClass('show');
            backdrop.modal('show');
            hideOnContent();
        } else{
            showingMenu = false;
            navBox.removeClass('show');
            backdrop.modal('hide');
        }
    });
    navBox.on('click', function (){
        navBox.removeClass('show');
        backdrop.modal('hide');
    });
});
