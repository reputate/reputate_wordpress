<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://www.reputate.io
 * @since      1.0.0
 *
 * @package    Reputate_wordpress
 * @subpackage Reputate_wordpress/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Reputate_wordpress
 * @subpackage Reputate_wordpress/admin
 * @author     Reputate Co <contact@reputate.io>
 */
class Reputate_wordpress_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;
	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function reputate_enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Reputate_wordpress_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Reputate_wordpress_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/reputate_wordpress-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function reputate_enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Reputate_wordpress_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Reputate_wordpress_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/reputate_wordpress-admin.js', array( 'jquery' ), $this->version, false );

	}

	/**
	 * Register the administration menu for this plugin into the WordPress Dashboard menu.
	 *
	 * @since    1.0.0
	 */

	public function reputate_add_plugin_admin_menu() {

	    /*
	     * Add a settings page for this plugin to the Settings menu.
	     *
	     * NOTE:  Alternative menu locations are available via WordPress administration menu functions.
	     *
	     *        Administration Menus: http://codex.wordpress.org/Administration_Menus
	     *
	     */
	    add_options_page( 'Repuate Plugin Settings and Options', 'Reputate.io', 'manage_options', $this->plugin_name, array($this, 'reputate_display_plugin_setup_page')
	    );
	}

	 /**
	 * Add settings action link to the plugins page.
	 *
	 * @since    1.0.0
	 */

	public function reputate_add_action_links( $links ) {
	    /*
	    *  Documentation : https://codex.wordpress.org/Plugin_API/Filter_Reference/plugin_action_links_(plugin_file_name)
	    */
	   $settings_link = array(
	    '<a href="' . admin_url( 'options-general.php?page=' . $this->plugin_name ) . '">' . __('Settings', $this->plugin_name) . '</a>',
	   );
	   return array_merge(  $settings_link, $links );

	}

	/**
	 * Render the settings page for this plugin.
	 *
	 * @since    1.0.0
	 */

	public function reputate_display_plugin_setup_page() {
	    include_once( 'partials/reputate_wordpress-admin-display.php' );
	}

	public function reputate_validate($input) {
	    // All checkboxes inputs        
	    $valid = array();
	    $valid['api_key'] = esc_url($input['api_key']);

	    return $valid;
	 }

	 public function options_update() {
	    register_setting($this->plugin_name, $this->plugin_name, array($this, 'reputate_validate'));
	 }

    public function update_reputate_api_key() {
		register_setting( 'reputate-settings', 'reputate_api_key' );
		register_setting( 'reputate-settings', 'reputate_api_code' );
    }

	public function reputate_sample_admin_notice__success() {
	    ?>
	    <div class="notice notice-success is-dismissible">
	        <p><?php _e( 'Done!', 'sample-text-domain' ); ?></p>
	    </div>
	    <?php
	}

	// hook that function onto our scheduled event:
	public function reputate_order_cron() {

		// The Cron will run every hour, so let's get the orders placed in the last hour
		$orders = wc_get_orders( array(
		    'status' => 'completed',
		    'date_completed' => '>' . ( time() - 1*60*60 ),
		) );

		$dataPoints = array();  
		$dataPoint = array();  


		// Let's iterate through the orders we found
		if (count($orders) > 0) {
			for ($i=0; $i<count($orders); $i++) {
				$opt_in = get_post_meta( $orders[$i]->get_data()['id'], 'reputate_custom_opt_in', true );
							
				if ($opt_in == 1) {
				    // Now we need to get the attributes required to send
				    $email = $orders[$i]->get_data()['billing']['email'];
				    $date_c = $orders[$i]->get_data()['date_completed'];
				    $name = $orders[$i]->get_data()['billing']['first_name']." ".$orders[$i]->get_data()['billing']['last_name'];
				    $total_value = $orders[$i]->get_data()['total_tax'];
				    $city = $orders[$i]->get_data()['billing']['city'];
				    $state = $orders[$i]->get_data()['billing']['state'];
				    $country = $orders[$i]->get_data()['billing']['country'];

				    // Build the array with the datapoints we need
				    //$dataPoint = array("email"=>$email,"date"=>$date_c,"name"=>$name);
				    $dataPoint = array("email"=>$email,"date"=>$date_c,"name"=>$name,"total"=>$total_value,"city"=>$city,"state"=>$state,"country"=>$country,"optin"=>$opt_in);

				    // Add it to the array
			        array_push($dataPoints, $dataPoint);
				}
			}

			// JSON Formatting so we can unmarshal it
			$data = array(
			    'customers'   => $dataPoints
			);

			// Let's grab the apikey and apicode
			$apicode = get_option('reputate_api_code');
			$apikey = get_option('reputate_api_key');

			// Now let's send it all off to Reputate
			$url = 'https://api.reputate.io/api/v1/integrations/customer';
			$options = array(
			    'http' => array(
			        'header'  => "Content-type: application/json\r\nAuthorization: Basic " . base64_encode($apicode . ":" . $apikey) . "\r\n",
			        'method'  => 'POST',
			        'content' => json_encode($data)
			    )
			);
			$context  = stream_context_create($options);
			$result = file_get_contents($url, false, $context);
			if ($result === FALSE) { error_log( print_r( $result, true ) ); }
			//var_dump($result);
		}
	}
}
