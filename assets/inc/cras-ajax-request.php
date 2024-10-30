<?php 
/*
*
*   ***** Custom Registration Ajax Shortcode *****
*
*   Ajax Request
*   
*/
// If this file is called directly, abort. //
if ( ! defined( 'WPINC' ) ) {die;} // end if
/*
Ajax Requests
*/
add_action( 'wp_ajax_cras_custom_plugin_frontend_ajax', 'cras_custom_plugin_frontend_ajax' );
add_action( 'wp_ajax_nopriv_cras_custom_plugin_frontend_ajax', 'cras_custom_plugin_frontend_ajax' );
function cras_custom_plugin_frontend_ajax(){    
    global $wpdb;
    if($_POST){
       $name = isset($_POST['name'])?sanitize_text_field($_POST['name']):'';
       $email = isset($_POST['email'])?sanitize_email($_POST['email']):'';
       $password = isset($_POST['password'])?$_POST['password']:'';
       $cpassword = isset($_POST['cpassword'])?$_POST['cpassword']:'';
       $error = array();
        if (username_exists($name)) {
          $error['username_exists'] = "Username already exists";
        }
        if (email_exists($email)) {
          $error['email_existence'] = "Email already exists";
        }
        if (strcmp($password, $cpassword) != 0) {
          $error['password'] = "Password didn't match";
        }
        if (count($error) == 0) {
            $user_id = wp_create_user($name, $password, $email);
            if ( metadata_exists( 'user', $user_id, 'first_name' ) ) {
                update_user_meta( $user_id, 'first_name', $firstname );
            }else{
                add_user_meta($user_id, 'first_name', $firstname);
            }
            $response = array('code' => 200,'msg' => 'User Created Successfully');
            return wp_send_json($response);
        }else {
            $response = array('code' => 201,'msg' => $error);
            return wp_send_json($response); 
        } 
    }
}

