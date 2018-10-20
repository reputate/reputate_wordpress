<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://www.reputate.io
 * @since             1.0.0
 * @package           Reputate_wordpress
 *
 * @wordpress-plugin
 * Plugin Name:       Reputate - Automate and Improve your Online Reputation 
 * Description:       Increase Reviews and Sales by upping your marketing game. Reputate is the E-Commerce Marketing Easy Button. The Reputate Plugin allows you to automate your marketing and improve your online reputation. You need an account on Reputate.io in order to use it.
 * Version:           1.0.0
 * Author:            Reputate Co
 * Author URI:        https://www.reputate.io
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       reputate_wordpress
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'PLUGIN_NAME_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-reputate_wordpress-activator.php
 */
function activate_reputate_wordpress() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-reputate_wordpress-activator.php';
	Reputate_wordpress_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-reputate_wordpress-deactivator.php
 */
function deactivate_reputate_wordpress() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-reputate_wordpress-deactivator.php';
	Reputate_wordpress_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_reputate_wordpress' );
register_deactivation_hook( __FILE__, 'deactivate_reputate_wordpress' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-reputate_wordpress.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_reputate_wordpress() {

	$plugin = new Reputate_wordpress();
	$plugin->run();

}
run_reputate_wordpress();
