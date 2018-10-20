<?php

/**
 * Fired during plugin deactivation
 *
 * @link       https://www.reputate.io
 * @since      1.0.0
 *
 * @package    Reputate_wordpress
 * @subpackage Reputate_wordpress/includes
 */

/**
 * Fired during plugin deactivation.
 *
 * This class defines all code necessary to run during the plugin's deactivation.
 *
 * @since      1.0.0
 * @package    Reputate_wordpress
 * @subpackage Reputate_wordpress/includes
 * @author     Reputate Co <contact@reputate.io>
 */
class Reputate_wordpress_Deactivator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function deactivate() {
		$timestamp = wp_next_scheduled ('reputate_order_cron');
		// unschedule previous event if any
		wp_unschedule_event ($timestamp, 'reputate_order_cron');
	}

}
