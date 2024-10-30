/*-----------------------------
* Build Your Plugin JS / jQuery
-----------------------------*/
/*
Jquery Ready!
*/
jQuery(document).ready(function($){
    "use strict";
    /* Custom registrationlogin with ajax*/

     jQuery('#cras_custom_plugin_form').validate({
       rules: {
            "name": {
                 required: true,
              },
            "email": {
                 required: true,
              },
            "password": {
                 required: true,
              },
            "cpassword": {
                 required: true,
              },
            },
        messages: {
            "name": {
                 required: "This field is required",
                 minlength: "This field must contain at least {0} characters",
             },
            "email": {
                 required: "This field is required",
                 minlength: "This field must contain at least {0} characters",
             },
            "password": {
                 required: "This field is required",
                 pwcheck:"Password is not strong enough",
            },
            "cpassword": {
                 required: "This field is required",
                 pwcheck:"Password is not strong enough",
             },
        },submitHandler: function(form){
            var target = form.id;  
            var name = $('#name').val();
            var email = $('#email').val();
            var password = $('#password').val();
            var cpassword = $('#cpassword').val();
            var data = {
              'action': 'cras_custom_plugin_frontend_ajax',
               'name':   name,
               'email': email,
              'password': password,
              'cpassword': cpassword,
             };
            var ajaxurl = "<?php echo admin_url('admin-ajax.php');?>";   
                $.post(ajax_var.ajaxurl, data, function(response) {
                if(response.code == 200)
                {
                    $('.register-msg').html(response.msg);
                    $("#cras_custom_plugin_form")[0].reset();
                }
                else
                {
                    let msg = response.msg;
                    var final = [];
                    if (msg.hasOwnProperty("email_existence")) {
                        final.push(msg.email_existence);
                    }
                    if (msg.hasOwnProperty("password")) {
                        final.push('<br>' + msg.password);
                    }
                    if (msg.hasOwnProperty("username_exists")) {
                        final.push('<br>'+msg.username_exists);
                    }
                     $('.register-msg').html(final);

                }
            });
        }
 });


});