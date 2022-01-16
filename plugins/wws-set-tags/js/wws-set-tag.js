
    jQuery(document).ready(function ($) {
        $('#submit').click(function(e) {
            e.preventDefault();
            $('#add-to-top').submit();
        })
    });



/*
    jQuery('form').submit(function ($) {
        $('#submit').attr('disabled', 'disabled'); //disable on any form submit
    });*/
