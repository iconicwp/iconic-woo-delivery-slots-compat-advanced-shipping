<?php
/**
 * Plugin Name:     WooCommerce Delivery Slots by Iconic [WooCommerce Advanced Shipping]
 * Plugin URI:      https://iconicwp.com/products/woocommerce-delivery-slots/
 * Description:     Compatibility between WooCommerce Delivery Slots by Iconic and WooCommerce Advanced Shipping by Jeroen Sormani.
 * Author:          Iconic
 * Author URI:      https://iconicwp.com/
 * Text Domain:     iconic-compat-advanced-shipping
 * Domain Path:     /languages
 * Version:         0.1.0
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Iconic Compat Advanced Shipping
 *
 * @package Iconic_Compat_Advanced_Shipping
 * @version 0.1.0
 */
class Iconic_Compat_Advanced_Shipping {
	/**
	 * Init
	 * 
	 * @return void
	 */
	public static function init() {
		add_action( 'plugins_loaded', array( __CLASS__, 'hooks' ) );
	}

	/**
	 * Hooks
	 *
	 * @return void
	 */
	public static function hooks() {
		if ( ! class_exists( 'WooCommerce_Advanced_Shipping' ) ) {
			return;
		}

		add_filter( 'iconic_wds_shipping_method_options', array( __CLASS__, 'replace_shipping_method_id' ) );
	}

	/**
	 * Replace shipping method ID
	 *
	 * @param array $shipping_method_options
	 *
	 * @return array
	 */
	public static function replace_shipping_method_id( $shipping_method_options ) {
		foreach ( $shipping_method_options as $key => $shipping_method_option ) {
			if ( strpos( $key, 'was_advanced_shipping_method' ) !== false ) {
				$new_key                             = str_replace( 'was_advanced_shipping_method', 'advanced_shipping', $key );
				$shipping_method_options[ $new_key ] = $shipping_method_option;
				unset( $shipping_method_options[ $key ] );
			}

		}

		return $shipping_method_options;
	}
}

Iconic_Compat_Advanced_Shipping::init();
