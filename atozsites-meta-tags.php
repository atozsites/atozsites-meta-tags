<?php
/*
Plugin Name: atozsites Meta Tags
Plugin URI: https://github.com/atozsites/atozsites-meta-tags/
Description: A super simple plugin to edit meta tags in all your pages, posts, categories, tags, custom post types and WooCommerce pages.
Author: atozsites
Author URI: https://atozsites.com/
Version: 1.0
Text Domain: atozsites-meta-tags
*/


// direct calls are not allowed
defined('ABSPATH') || die();



// define plugin file
if( !defined('ATOZSITES_PLUGIN_FILE') ){
    define( 'ATOZSITES_PLUGIN_FILE', plugin_basename( __FILE__ ) );
}



// define relative path to plugin directory
if( !defined('ATOZSITES_PLUGIN_DIR') ){
    define( 'ATOZSITES_PLUGIN_DIR',  dirname( plugin_basename( __FILE__ ) ) );
}



// define full path to plugin file
if( !defined('ATOZSITES_PLUGIN_FULL_PATH') ){
    define( 'ATOZSITES_PLUGIN_FULL_PATH',  __FILE__ );
}



// include core class
if ( ! class_exists( 'ATOZSITES_Meta_Tags' ) ){
	require_once dirname( __FILE__ ) . '/includes/class-atozsites-meta-tags.php';
}



// main instance of the plugin
return ATOZSITES_Meta_Tags::get_instance();
