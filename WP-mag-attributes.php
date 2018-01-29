<?php

/*
Plugin Name: WP Mag Attributes
Plugin URI: http://treestone.com
Description: Allows you to retrieve attribute options from a Magento store with a simple Shortcode.
Version: 1.0
Author: Chaim Paperman
Author URI: http://treestone.com
License: GPL2
*/

defined( 'ABSPATH' ) or die( "Cannot access pages directly." ); //protect from direct access

define( 'MAGENTO__PLUGIN_DIR', plugin_dir_path( __FILE__ ) ); //define the current path
require_once( MAGENTO__PLUGIN_DIR . 'api/api.php' ); // load the api class
require_once( MAGENTO__PLUGIN_DIR . 'admin/magento-admin.php' ); //load the admin settings


function magento_attributes_func( $atts ) {

	$id = $atts['attribute_id']; //get the attribute id from the shortcode

	$transientUnique = 'ts_magento_api' . $id; //set a unique transient

	$transient = get_transient( $transientUnique ); //check if the transient is already cached

	if ( ! empty( $transient ) ) {

		// The function will return here every time after the first time it is run, until the transient expires.
		return $transient;

		// Nope!  We gotta make a call.
	} else {

		$mg = new magento(); //init magento api class

		$attributes = $mg->connect( $id ); //init magento api call with attribute id

		$return = "<ul>"; //start a list for the results, can be set as table also

		foreach ( $attributes as $value ) {

			if ( strlen( $value->label ) > 2 ) { //had to add this is because of some blank attribute option values

				$return .= "<li>" . $value->label . "</li>"; //get only the label of the attribute option
			}

		}

		$return .= "</ul>"; //close the ul

		set_transient( $transientUnique, $return, 86400 ); //if the transient wasn't cached, we just did :)


		return $return;
	}

}

add_shortcode( "magento_attributes", "magento_attributes_func" ); //this enables the shortcode