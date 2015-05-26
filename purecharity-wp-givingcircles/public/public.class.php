<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       http://purecharity.com
 * @since      1.0.0
 *
 * @package    Purecharity_Wp_Givingcircles
 * @subpackage Purecharity_Wp_Givingcircles/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the dashboard-specific stylesheet and JavaScript.
 *
 * @package    Purecharity_Wp_Givingcircles
 * @subpackage Purecharity_Wp_Givingcircles/public
 * @author     Pure Charity <dev@purecharity.com>
 */
class Purecharity_Wp_Givingcircles_Public {

	/**
	 * The Giving Circle.
	 *
	 * @since    1.0.0
	 * @access   public
	 * @var      string    $givingcircle    The Giving Circle.
	 */
	public static $givingcircle;

	/**
	 * The Giving Circles collection.
	 *
	 * @since    1.0.0
	 * @access   public
	 * @var      string    $givingcircles    The Giving Circles collection.
	 */
	public static $givingcircles;

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
	 * @var      string    $plugin_name       The name of the plugin.
	 * @var      string    $version    The version of this plugin.
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
	public function enqueue_styles() {
		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/public.css', array(), $this->version, 'all' );
	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {
		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/public.js', array( 'jquery' ), $this->version, false );
	}

	/**
	 * Custom layout from the plugin settings.
	 *
	 * @since    1.0.0
	 */
	public static function custom_style(){
		$main_color = get_option('puregivingcircles_main_color', false);
		$text_color = get_option('puregivingcircles_text_color', false);
		$html = "";
		$html.= '	<style>';

		if($main_color != '')
		{
			$html.= '		
				.gc-go-back,
				.gc-go-back:hover { 
					background: #'.str_replace('#', '', $main_color).' !important; 
				} 
				a.gc-pure-button,
				a.gc-pure-button:hover { 
					background: #'.str_replace('#', '', $main_color).' !important; 
				} 
			';
		}

		if($text_color != '')
		{
			$html.= '		
				.gc-go-back,
				.gc-go-back:hover { 
					color: #'.str_replace('#', '', $text_color).' !important; 
				} 
				a.gc-pure-button,
				a.gc-pure-button:hover { 
					color: #'.str_replace('#', '', $text_color).' !important; 
				} 
			';
		}

		$html.= '	</style>';

		return $html;
	}

	/**
	 * Not found layout for listing display.
	 *
	 * @since    1.0.0
	 */
	public static function list_not_found(){
		return "<p>No Giving Circles Found.</p>" . Purecharity_Wp_Base_Public::powered_by();;	
	}

	/**
	 * Not found layout for single display.
	 *
	 * @since    1.0.0
	 */
	public static function not_found(){
		return "<p>Giving Circle Not Found.</p>" . Purecharity_Wp_Base_Public::powered_by();;	
	}

	/**
	 * List of Giving Circles.
	 *
	 * @since    1.0.0
	 */
	public static function listing(){

		$html = "";
		$html .= self::custom_style();
		$html .= '<div class="gc-listing">';

		foreach(self::$givingcircles as &$giving_circle){
			$html .= '
				<div class="gc-listing-single">
					<a href="?slug='. $giving_circle->slug .'" title="View '. $giving_circle->name .'">
						<div class="gc-listing-avatar-container">
							<div class="gc-listing-avatar" href="#" style="background-image: url('. $giving_circle->profile->avatar .')"></div>
						</div>
						<div class="gc-listing-info">
							<h3>'. $giving_circle->name .'</h3>
							<p>'.$giving_circle->members_count.' '.pluralize($giving_circle->members_count, 'Member', 'Members').'</p>
						</div>
					</a>
				</div>
			';
		}

		$html .= '</div>';
		$html .= Purecharity_Wp_Base_Public::powered_by();

		return $html;
	}

	/**
	 * Members link on the display header.
	 *
	 * @since    1.0.0
	 */
	public static function members_link(){
		if(count(self::$givingcircle->organizers) > 0){
			return '	and 
								<a href="#trigger-tab-3" onclick="$(\'#trigger-tab-3\').click()">
									'.count(self::$givingcircle->organizers).' '.pluralize(count(self::$givingcircle->organizers), 'member', 'members').'
								</a>';
		}else{
			return '';
		}
	}

	/**
	 * Backed Causes listing for a single Giving Circle display.
	 *
	 * @since    1.0.0
	 */
	public static function backed_causes_listing(){
		$html = '<ul class="gc-causes">';
		foreach(self::$givingcircle->backed_causes as &$backed_cause){
			$html .= '
				<li>
	    		<span class="gc-cause-avatar"><img src="'.$backed_cause->avatar.'" /></span>
	     		<h4><a href="'.$backed_cause->url.'" target="_blank">'.$backed_cause->name.'</a></h4>
	     		<p class="gc-location">
	     			'.$backed_cause->location.'<br />
	     			Amount donated to this cause: $'.$backed_cause->amount_donated.'
	     		</p>
			  </li>
			';

		}
		$html .= '</ul>';
		return $html;					    	
	}


	/**
	 * Members listing for a single Giving Circle display.
	 *
	 * @since    1.0.0
	 */
	public static function members_listing(){
		$html = '<ul class="gc-members">';
		foreach(self::$givingcircle->members as &$member){
			$html .= '
				<li>
	    		<span class="gc-cause-avatar" style="background: url('.$member->avatar.') center; background-size: 100%;"></span>
	     		<h4><a href="'.$member->profile_url.'" target="_blank">'.$member->name.'</a></h4>
	     		<p class="gc-location"></p>
			  </li>
			';

		}
		$html .= '</ul>';
		return $html;					    	
	}

	/**
	 * Virtual page for a single Giving Circle
	 *
	 * @since    1.0.0
	 */
	public static function show(){
		$html = "";
		if(isset($_GET['slug'])){
			$html .= '<a class="gc-go-back" href="#" onclick="window.history.go(-1); return false;">&lt; Back</a>';
		}

		$html .= self::custom_style();
		$html .= '
			<div class="gc-container">				
				<div class="gc-header">
					<img src="'.self::$givingcircle->profile->cover.'">
				</div>

				<div class="gc-intro">
					<div class="gc-avatar" style="background: url('.self::$givingcircle->profile->avatar.') center; background-size: 100%;">
					</div>

					<div class="gc-info">
						<h2>'.self::$givingcircle->name.'</h2>
						<p class="gc-organizer">
							Organized by 
							<a href="'.self::$givingcircle->founder->profile_url.'" target="_blank">
								'.self::$givingcircle->founder->name.'
							</a> 
							'.self::members_link().'
						</p>
						<ul class="gc-stats">
							<li><span class="gc-stat">'.self::$givingcircle->profile->lives_impacted.'</span><br/> 
							'.pluralize(intval(self::$givingcircle->profile->lives_impacted), 'Live Impacted', 'Lives Impacted').'</li>
							<li><span class="gc-stat">'.count(self::$givingcircle->members).'</span><br/> 
							'.pluralize(count(self::$givingcircle->members), 'Member', 'Members').'</li>
						</ul>
					</div>

					<div class="gc-join">
						<a class="gc-pure-button" href="'.self::$givingcircle->join_url.'">Join</a>
						<p>A minimum monthly donation of $'.self::$givingcircle->minimum_monthly_donation.' is required.</p>
						<p>Funds Donated: $'.self::$givingcircle->minimum_monthly_donation.'</p>
					</div>
				</div>

				<div class="gc-body">
					<div id="gc-tabs">
					  <ul class="gc-tabs-list">
					    <li><a id="trigger-tab-1" href="#tab-1">About</a></li>
					    <li><a id="trigger-tab-2" href="#tab-2">Causes</a></li>
					    <li><a id="trigger-tab-3" href="#tab-3">Members</a></li>
					  </ul>
					  <div id="tab-1">
					    <p>'.self::$givingcircle->profile->about.'</p>
					  </div>
					  <div id="tab-2">
							'.self::backed_causes_listing().'
					  </div>
					  <div id="tab-3">
							'.self::members_listing().'
					  </div>
					</div>

				</div>

			</div>
		';
		$html .= Purecharity_Wp_Base_Public::powered_by();
		return $html;
	}

}
