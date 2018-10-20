<?php

/**
 * Fired during plugin activation
 *
 * @link       https://www.reputate.io
 * @since      1.0.0
 *
 * @package    Reputate_wordpress
 * @subpackage Reputate_wordpress/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Reputate_wordpress
 * @subpackage Reputate_wordpress/includes
 * @author     Reputate Co <contact@reputate.io>
 */
class Reputate_wordpress_Activator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function activate() {
		if ( ! wp_next_scheduled( 'reputate_order_cron' ) ) {
			wp_schedule_event(time(), 'hourly', 'reputate_order_cron' );
		}

	}

}
