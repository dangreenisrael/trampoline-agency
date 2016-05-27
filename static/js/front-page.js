/**
 * Created by Dan on 21/05/2016.
 */

jQuery.fn.smoothHide = function() {
    var element = this;
    this.css({
        transition: "opacity 700ms linear",
        opacity: 0
    });
    setTimeout(function () {
        element.hide();
    }, 700)
};

jQuery.fn.smoothShow = function() {
    var element = this;
    this.show().css({
        opacity: 1
    });
    setTimeout(function () {
        element.css({
            opacity: 1
        });
    }, 1 );
};

jQuery(document).ready(function () {
    var contactForm = jQuery('#contactForm');
    var callouts = jQuery('.bs-callout');
    callouts.smoothHide();
    contactForm.submit(function( event ) {
        event.preventDefault();
        jQuery.post( "#", contactForm.serialize() ).done(function(data) {
            console.log(data);
            if (data === "true") {
                jQuery('#success-message').smoothShow();

            } else {
                jQuery('#error-message').smoothShow();
            }
            jQuery('body').one('click', function () {
                callouts.smoothHide();
            })
        });
     });
});

