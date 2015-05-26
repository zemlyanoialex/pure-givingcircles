<?php

/**
 * Fired during plugin deactivation
 *
 * @link       http://purecharity.com
 * @since      1.0.0
 *
 * @package    Purecharity_Wp_Givingcircles
 * @subpackage Purecharity_Wp_Givingcircles/includes
 */

/**
 * Fired during plugin deactivation.
 *
 * This class defines all code necessary to run during the plugin's deactivation.
 *
 * @since      1.0.0
 * @package    Purecharity_Wp_Givingcircles
 * @subpackage Purecharity_Wp_Givingcircles/includes
 * @author     Pure Charity <dev@purecharity.com>
 */
class Purecharity_Wp_Givingcircles_Deactivator {

	/**
	 * Unregister the settings needed.
	 *
	 * Unregister the settings needed.
	 *
	 * @since    1.0.0
	 */
	public static function deactivate() {
    unregister_setting('purecharity_wp_givingcircles', 'purecharity_wp_givingcircles_main_color');
    unregister_setting('purecharity_wp_givingcircles', 'purecharity_wp_givingcircles_text_color');
	}

}
