jQuery(function() {

    jQuery("#contactForm input,#contactForm textarea").jqBootstrapValidation({
        preventSubmit: true,
        submitError: function(jQueryform, event, errors) {
            // additional error messages or events
        },
        submitSuccess: function(jQueryform, event) {
            event.preventDefault(); // prevent default submit behaviour
            // get values from FORM
            var name = jQuery("input#name").val();
            var email = jQuery("input#email").val();
            var phone = jQuery("input#phone").val();
            var message = jQuery("textarea#message").val();
            var firstName = name; // For Success/Failure Message
            // Check for white space in name for Success/Fail message
            if (firstName.indexOf(' ') >= 0) {
                firstName = name.split(' ').slice(0, -1).join(' ');
            }
            jQuery.ajax({
                url: "././mail/contact_me.php",
                type: "POST",
                data: {
                    name: name,
                    phone: phone,
                    email: email,
                    message: message
                },
                cache: false,
                success: function() {
                    // Success message
                    jQuery('#success').html("<div class='alert alert-success'>");
                    jQuery('#success > .alert-success').html("<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;")
                        .append("</button>");
                    jQuery('#success > .alert-success')
                        .append("<strong>Your message has been sent. </strong>");
                    jQuery('#success > .alert-success')
                        .append('</div>');

                    //clear all fields
                    jQuery('#contactForm').trigger("reset");
                },
                error: function() {
                    // Fail message
                    jQuery('#success').html("<div class='alert alert-danger'>");
                    jQuery('#success > .alert-danger').html("<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;")
                        .append("</button>");
                    jQuery('#success > .alert-danger').append("<strong>Sorry " + firstName + ", it seems that my mail server is not responding. Please try again later!");
                    jQuery('#success > .alert-danger').append('</div>');
                    //clear all fields
                    jQuery('#contactForm').trigger("reset");
                },
            })
        },
        filter: function() {
            return jQuery(this).is(":visible");
        },
    });

    jQuery("a[data-toggle=\"tab\"]").click(function(e) {
        e.preventDefault();
        jQuery(this).tab("show");
    });
});


/*When clicking on Full hide fail/success boxes */
jQuery('#name').focus(function() {
    jQuery('#success').html('');
});
