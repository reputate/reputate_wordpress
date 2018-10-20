<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://www.reputate.io
 * @since      1.0.0
 *
 * @package    Reputate_wordpress
 * @subpackage Reputate_wordpress/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Reputate_wordpress
 * @subpackage Reputate_wordpress/includes
 * @author     Reputate Co <contact@reputate.io>
 */
class Reputate_wordpress_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function reputate_load_plugin_textdomain() {

		load_plugin_textdomain(
			'reputate_wordpress',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
