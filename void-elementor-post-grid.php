<?php
/**
 * Plugin Name: Void Elementor Post Grid Addon for Elementor Page builder
 * Description: Elementor Post Grid in 5 different style by voidthems for elementor page builder
 * Version:     1.0.0
 * Author:      VOID THEMES
 * Plugin URI:  http://voidthemes.com/void-elementor-post-grid-plugin/
 * Author URI:  http://voidthemes.com
 * Text Domain: voidgrid
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
	require( __DIR__ . '/void-shortcode.php' );   //loading the main plugin

define( 'VOID_ELEMENTS_FILE_', __FILE__ );
define( 'VOID_ELEMENTS_DIR', plugin_dir_path( __FILE__ ) );
require VOID_ELEMENTS_DIR . 'class-gamajo-template-loader.php';
require VOID_ELEMENTS_DIR . 'void-template-loader.php';
require VOID_ELEMENTS_DIR . 'template-tags.php';

	
	function voidgrid_load_elements() {
	// Load localization file
	load_plugin_textdomain( 'voidgrid' );

	// Notice if the Elementor is not active
	if ( ! did_action( 'elementor/loaded' ) ) {
		return;
	}

	// Check version required
	$elementor_version_required = '1.0.0';
	if ( ! version_compare( ELEMENTOR_VERSION, $elementor_version_required, '>=' ) ) {
		return;
	}

	// Require the main plugin file
	require( __DIR__ . '/plugin.php' );   //loading the main plugin

}
add_action( 'plugins_loaded', 'voidgrid_load_elements' );   //notiung but checking and notice

function void_grid_image_size(){
	add_image_size( 'blog-list-post-size', 350 );
}
add_action('init', 'void_grid_image_size');