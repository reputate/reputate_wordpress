<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://www.reputate.io
 * @since      1.0.0
 *
 * @package    Reputate_wordpress
 * @subpackage Reputate_wordpress/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Reputate_wordpress
 * @subpackage Reputate_wordpress/public
 * @author     Reputate Co <contact@reputate.io>
 */
class Reputate_wordpress_Public {

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
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
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

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/reputate_wordpress-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
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

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/reputate_wordpress-public.js', array( 'jquery' ), $this->version, false );

	}

	public function reputate_opt_in_checkout_field ($checkout) {
		$verbiage = 'Subscribe to our marketing and promotions, including potential offers and deals!';
		if (strlen(get_option('reputate_opt_in_verbiage')) > 10) {
			$verbiage = get_option('reputate_opt_in_verbiage');
		}
		woocommerce_form_field('reputate_opt_in', array(
	        'type'          => 'checkbox',
			'class' => array(
				'my-field-class form-row-wide'
			) ,
			'label' => __($verbiage),
			'required' => true,
		    'default' => 1, //This will pre-select the checkbox
		) , $checkout->get_value('reputate_opt_in'));
		/*
	    //echo '<div id="my-new-field"><h3>'.__('Email: ').'</h3>';
		$verbiage = 'Subscribe to our marketing and promotions, including potential offers and deals!';
		if (str_len(get_option('reputate_opt_in_verbiage')) > 10) {
			$verbiage = get_option('reputate_opt_in_verbiage');
		}
		//echo '<div id="customise_checkout_field"><h2>' . __('Heading') . '</h2>';
		woocommerce_form_field('reputate_opt_in', array(
	        'type'          => 'checkbox',
	        'class'         => array('input-checkbox, form-row-wide'),
			'label' => __($verbiage) ,
	        'required'  => true,
        ), $checkout->get_value( 'reputate_opt_in' ));
		//echo '</div>';*/
	}

	public function reputate_opt_in_checkout_field_update_order_meta( $order_id ) {
	    if ($_POST['reputate_opt_in']) update_post_meta( $order_id, 'reputate_custom_opt_in', esc_attr($_POST['reputate_opt_in']));
	}

}
