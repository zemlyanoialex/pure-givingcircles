<?php

/**
 * Fired during plugin activation
 *
 * @link       http://purecharity.com
 * @since      1.0.0
 *
 * @package    Purecharity_Wp_Givingcircles
 * @subpackage Purecharity_Wp_Givingcircles/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Purecharity_Wp_Givingcircles
 * @subpackage Purecharity_Wp_Givingcircles/includes
 * @author     Pure Charity <dev@purecharity.com>
 */
class Purecharity_Wp_Givingcircles_Activator {

	/**
	 * Register the settings needed.
	 *
	 * Register the settings needed.
	 *
	 * @since    1.0.0
	 */
	public static function activate() {
    register_setting('purecharity_wp_givingcircles', 'purecharity_wp_givingcircles_main_color', array('Pure_Givingcircles_Admin', 'clean_text'));
    register_setting('purecharity_wp_givingcircles', 'purecharity_wp_givingcircles_text_color', array('Pure_Givingcircles_Admin', 'clean_text'));
	}

}
