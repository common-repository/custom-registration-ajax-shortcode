<?php 
/*
Plugin Name: Custom Registration Ajax Shortcode
Plugin URI: zestgeek.com
Description: Customer registration and login process with ajax.
Version: 1.1
Author: vishakha1990
Author URI: vishakha.com
*/

// If this file is called directly, abort. //
if ( ! defined( 'WPINC' ) ) {die;} // end if

// Let's Initialize Everything
if ( file_exists( plugin_dir_path( __FILE__ ) . 'custom-registration-init.php' ) ) {
	require_once( plugin_dir_path( __FILE__ ) . 'custom-registration-init.php' );
}

function custom_register_menu_page(){
	add_menu_page( 
		__( 'Custom Menu Title', 'textdomain' ),
		'Custom Register Login',
		'manage_options',
		'custompage',
		'custom_registration_menu_page',
		'dashicons-bell',
		6
	); 
}
add_action( 'admin_menu', 'custom_register_menu_page' );

function custom_register_plugin_settings_link($links) { 
  $settings_link = '<a href='.admin_url().'admin.php?page=custompage>Settings</a>'; 
  array_unshift($links, $settings_link); 
  return $links; 
}
$plugin = plugin_basename(__FILE__); 
add_filter("plugin_action_links_$plugin", 'custom_register_plugin_settings_link' );

function custom_registration_menu_page(){
	echo "<h4>SHORTCODE IS HERE FOR REGISTER USER: [cras_custom_plugin_form]</h4>
	<h4>SHORTCODE IS HERE FOR LOGIN USER: [cras_custom_plugin_login_form]</h4>";
}