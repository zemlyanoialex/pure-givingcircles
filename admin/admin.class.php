<?php

/**
 * The dashboard-specific functionality of the plugin.
 *
 * @link       http://purecharity.com
 * @since      1.0.0
 *
 * @package    Purecharity_Wp_Givingcircles
 * @subpackage Purecharity_Wp_Givingcircles/admin
 */

/**
 * The dashboard-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the dashboard-specific stylesheet and JavaScript.
 *
 * @package    Purecharity_Wp_Givingcircles
 * @subpackage Purecharity_Wp_Givingcircles/admin
 * @author     Pure Charity <dev@purecharity.com>
 */
class Purecharity_Wp_Givingcircles_Admin {

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
	 * @var      string    $plugin_name       The name of this plugin.
	 * @var      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}
	
	/**
	 * Add the Plugin Settings Menu.
	 *
	 * @since    1.0.0
	 */
	function add_admin_menu(  ) { 
		add_options_page( 'PureCharity&#8482; Giving Circles Settings', 'PureCharity&#8482; Giving Circles', 'manage_options', 'purecharity_giving_circles', array('Purecharity_Wp_Givingcircles_Admin', 'options_page') );
	}

	/**
	 * Checks for the existence of the giving_circles plugin settings.
	 *
	 * @since    1.0.0
	 */
	public static function settings_exist(  ) { 
		if( false == get_option( 'purecharity_giving_circles_settings' ) ) { 
			add_option( 'purecharity_giving_circles_settings' );
		}
	}

	/**
	 * Initializes the settings page options.
	 *
	 * @since    1.0.0
	 */
	public static function settings_init(  ) 
	{
		register_setting( 'pgPluginPage', 'purecharity_giving_circles_settings' );

		add_settings_section(
			'purecharity_giving_circles_pgPluginPage_section', 
			__( 'General settings', 'wordpress' ), 
			array('Purecharity_Wp_Givingcircles_Admin', 'settings_section_callback'),
			'pgPluginPage'
		);

		add_settings_field( 
			'plugin_color', 
			__( 'Main Theme Color', 'wordpress' ), 
			array('Purecharity_Wp_Givingcircles_Admin', 'main_color_render'), 
			'pgPluginPage', 
			'purecharity_giving_circles_pgPluginPage_section' 
		);

		add_settings_field( 
			'round_avatars', __( 'Round Avatar Images', 'wordpress' ), 
			array('Purecharity_Wp_Givingcircles_Admin', 'round_avatars_render'), 
			'pgPluginPage', 
			'purecharity_giving_circles_pgPluginPage_section' 
		);

		add_settings_field( 
			'single_view_template', __( 'Single view template', 'wordpress' ), 
			array('Purecharity_Wp_Givingcircles_Admin', 'single_view_template_render'), 
			'pgPluginPage', 
			'purecharity_giving_circles_pgPluginPage_section' 
		);
	}

	/**
	 * Renders the template selector for the single view.
	 *
	 * @since    1.0.4
	 */
	public static function single_view_template_render(  ) { 
		$options = get_option( 'purecharity_giving_circles_settings' );
		$templates = purecharity_get_templates();
		?>
		<select name="purecharity_giving_circles_settings[single_view_template]">
			<option value="">Inherit from the listing page</option>
			<?php foreach($templates as $key => $template){ ?>
				<option <?php echo $template == @$options['single_view_template'] ? 'selected' : '' ?> value="<?php echo $template; ?>"><?php echo "$key ($template)" ?></option>
			<?php } ?>
		</select>
		<?php
	}


	/**
	 * Renders the round avatar image switch.
	 *
	 * @since    1.0.0
	 */
	public static function round_avatars_render(  ) { 
		$options = get_option( 'purecharity_giving_circles_settings' );
		?>
		<input 
			type="checkbox" 
			name="purecharity_giving_circles_settings[round_avatars]" 
			<?php echo (isset($options['round_avatars'])) ? 'checked' : '' ?>
			value="true">
		<?php
	}

	/**
	 * Renders the main theme color picker.
	 *
	 * @since    1.0.0
	 */
	public static function main_color_render(  ) { 

		$options = get_option( 'purecharity_giving_circles_settings' );
		?>
		<input type="text" name="purecharity_giving_circles_settings[plugin_color]" id="main_color" value="<?php echo @$options['plugin_color']; ?>">

	<?php

	}

	/**
	 * Callback for use with Settings API.
	 *
	 * @since    1.0.0
	 */
	public static function settings_section_callback(  ) 
	{ 
		echo __( 'General settings for the Pure Charity Giving Circles plugin.', 'wordpress' );
	}

	
	/**
	 * Creates the options page.
	 *
	 * @since    1.0.0
	 */
	public static function options_page()
	{
    ?>
    <div class="wrap">
      <form action="options.php" method="post" class="pure-settings-form">
				<?php
					echo '<img align="left" src="' . plugins_url( 'purecharity-wp-base/public/img/purecharity.png' ) . '" > ';
				?>
				<h2 style="padding-left:100px;padding-top: 20px;padding-bottom: 50px;border-bottom: 1px solid #ccc;">PureCharity&#8482; Giving CirclesSettings</h2>
				
				<?php
				settings_fields( 'pgPluginPage' );
				do_settings_sections( 'pgPluginPage' );
				submit_button();
				?>
				
			</form>
    </div>
    <?php
	}

	/**
	 * Register the stylesheets for the Dashboard.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the dashboard.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/admin.js', array( 'jquery' ), $this->version, false );

	}

}
