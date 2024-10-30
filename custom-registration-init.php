<?php 
/*
*
*	***** Custom Registration Ajax Shortcode *****
*
*	This file initializes all CRAS Core components
*	
*/
// If this file is called directly, abort. //
if ( ! defined( 'WPINC' ) ) {die;} // end if
// Define Our Constants
define('CRAS_CORE_INC',dirname( __FILE__ ).'/assets/inc/');
define('CRAS_CORE_IMG',plugins_url( 'assets/img/', __FILE__ ));
define('CRAS_CORE_CSS',plugins_url( 'assets/css/', __FILE__ ));
define('CRAS_CORE_JS',plugins_url( 'assets/js/', __FILE__ ));
/*
*
*  Register CSS
*
*/
function cras_register_core_css(){
	wp_enqueue_style('cras-core', CRAS_CORE_CSS . 'cras-core.css',null,time(),'all');
};
add_action( 'wp_enqueue_scripts', 'cras_register_core_css' );    
/*
*
*  Register JS/Jquery Ready
*
*/
function cras_register_core_js(){
	// Register Core Plugin JS	
	wp_enqueue_script('cras-core', CRAS_CORE_JS . 'cras-core.js','jquery',time(),true);
	wp_enqueue_script('cras-core-js', CRAS_CORE_JS . 'jquery.validate.min.js','jquery',time(),true);
	wp_localize_script( 'cras-core', 'ajax_var', array( 'ajaxurl' => admin_url('admin-ajax.php') ));
};
add_action( 'wp_enqueue_scripts', 'cras_register_core_js' );    
/*
*
*  Includes
*
*/ 
    
// Load the ajax Request
if ( file_exists( CRAS_CORE_INC . 'cras-ajax-request.php' ) ) {
	require_once CRAS_CORE_INC . 'cras-ajax-request.php';
} 
// Load the Shortcodes
if ( file_exists( CRAS_CORE_INC . 'cras-shortcodes.php' ) ) {
	require_once CRAS_CORE_INC . 'cras-shortcodes.php';
}