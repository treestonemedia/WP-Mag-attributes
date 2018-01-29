<?php
/**
 * Created by PhpStorm.
 * User: info
 * Date: 1/28/2018
 * Time: 8:50 PM
 */

defined( 'ABSPATH' ) or die( "Cannot access pages directly." ); //protect from direct access
class magento {


	public function connect( $id ) {

		$attribute_id = $id; //get the attribute id passed by the shortcode
		$mg_host      = get_option( 'mg_url' ); //get the magento shop URL as set in settings
		$mg_usr       = get_option( 'mg_api_user' ); //get the magento api user as set in settings
		$mg_scrt      = get_option( 'mg_scrt' ); //get the magento api secret as set in settings


		$proxy = new SoapClient( $mg_host . '/api/v2_soap/?wsdl' ); //initiate request to magento

		$sessionId = $proxy->login( $mg_usr, $mg_scrt ); //login to magento with API credentials


		$result = $proxy->catalogProductAttributeOptions( $sessionId, $attribute_id ); //get the attributes options


		return $result;


	}

}