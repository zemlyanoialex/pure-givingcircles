<?php 
/**
 * Template tags for giving circles
 *
 * @link       http://purecharity.com
 * @since      1.0.0
 *
 * @package    Purecharity_Wp_Givingcircles
 * @subpackage Purecharity_Wp_Givingcircles/includes
 */

/**
 * Giving Circles listing.
 *
 * For more information, please refer to the README.md
 *
 * @since    1.0.0
 */
function pc_giving_circles(){
    return pc_base()->api_call('giving_circles');
}

/**
 * Single Giving Circle information based on slug.
 *
 * For more information, please refer to the README.md
 *
 * @since    1.0.0
 */
function pc_giving_circle($slug = null){
    if($slug == null){ return pc_giving_circle_not_found(); }

    return pc_base()->api_call('giving_circles/'.$slug)->giving_circle;
}

/**
 * Giving circle not found message.
 *
 * @since    1.0.0
 */
function pc_giving_circle_not_found(){
    return "Giving Circle not found.";
}
