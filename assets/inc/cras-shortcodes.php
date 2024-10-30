<?php 
/*
*
*	***** Custom Registration Ajax Shortcode *****
*
*	Shortcodes
*	
*/
// If this file is called directly, abort. //
if ( ! defined( 'WPINC' ) ) {die;} // end if
/*
*
*  Build The Custom Plugin Form
*
*  Display Anywhere Using Shortcode: [cras_custom_plugin_form]
*
*/
function cras_custom_plugin_form_display($atts, $content = NULL){
		extract(shortcode_atts(array(
      	'el_class' => '',
      	'el_id' => '',	
		),$atts));            
        $out ='';
        $out .= '<div id="cras_custom_plugin_form_wrap" class="cras-form-wrap">';
        $out .= 'Hey! Im a cool new plugin named <strong>Custom Registration Ajax Shortcode!</strong>';
        $out .= '<form id="cras_custom_plugin_form">';
        $out .= '<p><p class="form-row form-row-first validate-required" id="billing_first_name_field" data-priority="10"><label>Name</label>
        <input type="text" name="name" id="name" placeholder="">
        <p class="form-row form-row-first validate-required" id="billing_first_name_field" data-priority="10">
        <p id="name-error">please fill</p></span></p></p><br>
        <p class="form-row form-row-first validate-required" id="billing_first_name_field" data-priority="10"><label>Email</label>
                <input type="email" name="email" id="email" placeholder=""></span></p><br><br>
                <p class="form-row form-row-first validate-required" id="billing_first_name_field" data-priority="10"><label>Password </label>
        <input type="password" name="password" id="password" placeholder=""></p><br>
       <p class="form-row form-row-first validate-required" id="billing_first_name_field" data-priority="10"><label>Confirm Password</label>
        <input type="password" name="cpassword" id="cpassword" placeholder=""></p><br><br></p>';

        $out .= '<p class="form-row form-row-first validate-required" id="billing_first_name_field" data-priority="10"><input type="submit" name = "submit" id="submit_btn" value="Submit My Form"></p>
        <h3 class="register-msg"></h3>';        
        $out .= '</form>';
         // Form Ends
        $out .='</div><br><!-- cras_custom_plugin_form_wrap -->';       
        return $out;
}

function cras_custom_plugin_login_form_display(){?>
        <form method="post">
        <p class="form-row form-row-first validate-required" id="billing_first_name_field" data-priority="10"><label>Email</label>
        <input type="email" name="email" id="email" placeholder=""></span></p><br><br>
        <p class="form-row form-row-first validate-required" id="billing_first_name_field" data-priority="10"><label>Password</label>
        <input type="password" name="password" id="password" placeholder=""></p><br><br><br></p>      
        <p class="form-row form-row-first validate-required" id="billing_first_name_field" data-priority="10"><button type="submit" name="btn_submit">Log In</button></p></form>
  <?php       

   global $wpdb;
    if ($_POST) {
      $username = sanitize_email($_POST['email']);
      $password = sanitize_text_field($_POST['password']);
      $login_array = array();
      $login_array['user_login'] = $username;
      $login_array['user_password'] = $password;
      $verify_user = wp_signon( $login_array, true );
      if (!is_wp_error($verify_user) ) {
        echo "<script>window.location = '".site_url()."'</script>";
      }else{
        echo "<p>Invalid Credentials </p>";
      }
    }
  $out = ob_get_clean();
  return $out;
} 
/*
Register All Shorcodes At Once
*/
add_action( 'init', 'cras_register_shortcodes');
function cras_register_shortcodes(){
	// Registered Shortcodes
	add_shortcode ('cras_custom_plugin_form', 'cras_custom_plugin_form_display' );
        add_shortcode ('cras_custom_plugin_login_form', 'cras_custom_plugin_login_form_display' );
};