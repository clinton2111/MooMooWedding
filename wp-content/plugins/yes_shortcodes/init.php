<?php
/*
 * Plugin Name: Yes Theme ShortCodes and Post Types
 * Version: 1.0
 * Plugin URI: http://www.logicathemes.com/
 * Description: Required for Yes template
 * Author: logicathemes 
 * Author URI: http://www.logicathemes.com/
 * Requires at least: 3.4
 * Text Domain: js_composer
 * Domain Path: /languages/
 */

if ( ! defined( 'ABSPATH' ) ) exit;

/*
|--------------------------------------------------------------------------
| Basic Constants 
|--------------------------------------------------------------------------
*/

define( 'YES_ADDON_DIR' , plugin_dir_path(__FILE__));
define( 'YES_ADDON_URL' , plugin_dir_url(__FILE__));
define( 'YES_ADDON_ASSETS_URL' , YES_ADDON_URL . 'assets/');
define( 'YES_ADDON_VERSION' , '1.0');


/*
|--------------------------------------------------------------------------
| Load Language Files
|--------------------------------------------------------------------------
*/

load_plugin_textdomain( 'js_composer', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
add_action( 'plugins_loaded', 'load_plugin_textdomain' );


/*
|--------------------------------------------------------------------------
| Yes Visual Composer Addon
|--------------------------------------------------------------------------
*/
// Load Front End Scripts and Styles edited for Visual Composer
if(! function_exists('yes_vc_enqueue_scripts') ) {
	
	// frontend css and js
	add_action( 'wp_enqueue_scripts', 'yes_vc_enqueue_scripts', 99 );
	
	function yes_vc_enqueue_scripts() {		
		wp_enqueue_script( 'yes-custom-js', YES_ADDON_ASSETS_URL .'js/custom.js', array('jquery') );
	}
	
}

// Load Styles for admin backend for Visual Composer
if(! function_exists('yes_vc_admin_enqueue_scripts') ) {
	
	// backend css and js
	add_action( 'admin_enqueue_scripts', 'yes_vc_admin_enqueue_scripts' );
	
	function yes_vc_admin_enqueue_scripts() {
		wp_enqueue_style( 'flaticon', YES_ADDON_ASSETS_URL .'css/flaticon.css', array(), '1', 'all' );
		
		wp_enqueue_style( 'vc-admin-css', YES_ADDON_ASSETS_URL .'css/admin.css', array(), '1', 'all' );
		
		wp_enqueue_script( 'google-maps', 'https://maps.googleapis.com/maps/api/js?sensor=false', false, null);
		
		wp_enqueue_script( 'yes-vc-admin-js', YES_ADDON_ASSETS_URL .'js/vc_admin.js', array('jquery') );
	}
	
}

// Initialise Visual Composer Stuff
if(! function_exists('load_yes_vc_init') ) {
	
	// register new shortcodes
	add_action( 'vc_before_init', 'load_yes_vc_init' );
	
	function load_yes_vc_init() {
		
		vc_set_as_theme(); // hide actyeste vc message

		vc_set_shortcodes_templates_dir( YES_ADDON_DIR . 'vc_templates/' );
		
		include YES_ADDON_DIR . 'vc_libs/map.php';
		
		include YES_ADDON_DIR . 'vc_libs/shortcode-params.php';
		
		include YES_ADDON_DIR . 'vc_libs/shortcodes.php';
		
		include YES_ADDON_DIR . 'vc_libs/vc_row/params.php';  // row custom parameters

		include YES_ADDON_DIR . 'vc_libs/vc_column/params.php'; // column custom parameters


		// When using nested shortcodes, main shortcode and nested shortcode should extend WPBakeryShortCodesContainer class to 
		// inherit all required functionality. MUST USE INSIDE vc_before_init action!
		if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
		    class WPBakeryShortCode_map_holder extends WPBakeryShortCodesContainer {
		    }
		}
		if ( class_exists( 'WPBakeryShortCode' ) ) {
		    class WPBakeryShortCode_map_location extends WPBakeryShortCode {
		    }
		}
		if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
		    class WPBakeryShortCode_yes_gift_registry extends WPBakeryShortCodesContainer {
		    }
		}
		if ( class_exists( 'WPBakeryShortCode' ) ) {
		    class WPBakeryShortCode_gift_paypal extends WPBakeryShortCode {
		    }
		}
		if ( class_exists( 'WPBakeryShortCode' ) ) {
		    class WPBakeryShortCode_gift_image extends WPBakeryShortCode {
		    }
		}

	}
	
}

/*
|--------------------------------------------------------------------------
| Initialize Custom Post Types
|--------------------------------------------------------------------------
*/
require_once( YES_ADDON_DIR . 'theme-custom-post-type.php'); 

?>