/*!
 * Agency v1.0.x (http://startbootstrap.com/template-overviews/agency)
 * Copyright 2013-2016 Start Bootstrap
 * Licensed under MIT (https://github.com/BlackrockDigital/startbootstrap/blob/gh-pages/LICENSE)
 */

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

// Highlight the top nav as scrolling occurs
jQuery('body').scrollspy({
    target: '.navbar-fixed-top'
});

// Closes the Responsive Menu on Menu Item Click
var navBox = jQuery('#nav-main').find('.navbar-mobilized');
var menuToggle = jQuery('#toggleMenu');
var hideOnContent = function () {
  jQuery('#content').one('click', function () {
      navBox.removeClass('show');
  })
};
menuToggle.on('click',function() {
    navBox.toggleClass('show');
    hideOnContent();
});
navBox.on('click', function (){
    navBox.removeClass('show');
});