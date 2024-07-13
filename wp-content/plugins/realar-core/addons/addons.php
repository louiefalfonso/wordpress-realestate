<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Main Realar Core Class
 *
 * The main class that initiates and runs the plugin.
 *
 * @since 1.0.0
 */

final class Realar_Extension {

	/**
	 * Plugin Version
	 *
	 * @since 1.0.0
	 *
	 * @var string The plugin version.
	 */
	const VERSION = '1.0.0';

	/**
	 * Minimum Elementor Version
	 *
	 * @since 1.0.0
	 *
	 * @var string Minimum Elementor version required to run the plugin.
	 */

	const MINIMUM_ELEMENTOR_VERSION = '2.0.0';

	/**
	 * Minimum PHP Version
	 *
	 * @since 1.0.0
	 *
	 * @var string Minimum PHP version required to run the plugin.
	 */
	const MINIMUM_PHP_VERSION = '7.0';


	/**
	 * Instance
	 *
	 * @since 1.0.0
	 *
	 * @access private
	 * @static
	 *
	 * @var Elementor_Test_Extension The single instance of the class.
	 */

	private static $_instance = null;

	/**
	 * Instance
	 *
	 * Ensures only one instance of the class is loaded or can be loaded.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 * @static
	 *
	 * @return Elementor_Test_Extension An instance of the class.
	 */
	public static function instance() {

		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;

	}

	/**
	 * Constructor
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function __construct() {
		add_action( 'plugins_loaded', [ $this, 'init' ] );
	}

	/**
	 * Initialize the plugin
	 *
	 * Load the plugin only after Elementor (and other plugins) are loaded.
	 * Checks for basic plugin requirements, if one check fail don't continue,
	 * if all check have passed load the files required to run the plugin.
	 *
	 * Fired by `plugins_loaded` action hook.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function init() {

		// Check if Elementor installed and activated

		if ( ! did_action( 'elementor/loaded' ) ) {
			add_action( 'admin_notices', [ $this, 'admin_notice_missing_main_plugin' ] );
			return;
		}

		// Check for required Elementor version

		if ( ! version_compare( ELEMENTOR_VERSION, self::MINIMUM_ELEMENTOR_VERSION, '>=' ) ) {
			add_action( 'admin_notices', [ $this, 'admin_notice_minimum_elementor_version' ] );
			return;
		}

		// Check for required PHP version

		if ( version_compare( PHP_VERSION, self::MINIMUM_PHP_VERSION, '<' ) ) {
			add_action( 'admin_notices', [ $this, 'admin_notice_minimum_php_version' ] );
			return;
		}


		// Add Plugin actions

		add_action( 'elementor/widgets/register', [ $this, 'init_widgets' ] );


        // Register widget scripts

		add_action( 'elementor/frontend/after_enqueue_scripts', [ $this, 'widget_scripts' ]);


		// Specific Register widget scripts

		// add_action( 'elementor/frontend/after_register_scripts', [ $this, 'realar_regsiter_widget_scripts' ] );
		// add_action( 'elementor/frontend/before_register_scripts', [ $this, 'realar_regsiter_widget_scripts' ] );


        // category register

		add_action( 'elementor/elements/categories_registered',[ $this, 'realar_elementor_widget_categories' ] );
	}

	/**
	 * Admin notice
	 *
	 * Warning when the site doesn't have Elementor installed or activated.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function admin_notice_missing_main_plugin() {

		if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );

		$message = sprintf(
			/* translators: 1: Plugin name 2: Elementor */
			esc_html__( '"%1$s" requires "%2$s" to be installed and activated.', 'realar' ),
			'<strong>' . esc_html__( 'Realar Core', 'realar' ) . '</strong>',
			'<strong>' . esc_html__( 'Elementor', 'realar' ) . '</strong>'
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );
	}

	/**
	 * Admin notice
	 *
	 * Warning when the site doesn't have a minimum required Elementor version.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function admin_notice_minimum_elementor_version() {

		if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );

		$message = sprintf(
			/* translators: 1: Plugin name 2: Elementor 3: Required Elementor version */

			esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'realar' ),
			'<strong>' . esc_html__( 'Realar Core', 'realar' ) . '</strong>',
			'<strong>' . esc_html__( 'Elementor', 'realar' ) . '</strong>',
			 self::MINIMUM_ELEMENTOR_VERSION
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );
	}
	/**
	 * Admin notice
	 *
	 * Warning when the site doesn't have a minimum required PHP version.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function admin_notice_minimum_php_version() {

		if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );

		$message = sprintf(

			/* translators: 1: Plugin name 2: PHP 3: Required PHP version */
			esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'realar' ),
			'<strong>' . esc_html__( 'Realar Core', 'realar' ) . '</strong>',
			'<strong>' . esc_html__( 'PHP', 'realar' ) . '</strong>',
			 self::MINIMUM_PHP_VERSION
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );
	}

	/**
	 * Init Widgets
	 *
	 * Include widgets files and register them
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */

	public function init_widgets() {

		$widget_register = \Elementor\Plugin::instance()->widgets_manager;

		// Header Include file & Widget Register
		require_once( REALAR_ADDONS . '/header/header.php' );

		$widget_register->register ( new \Realar_Header() );


		// Include All Widget Files
		foreach($this->Realar_Include_File() as $widget_file_name){
			require_once( REALAR_ADDONS . '/widgets/realar-'."$widget_file_name".'.php' );
		}
		// All Widget Register
		foreach($this->Realar_Register_File() as $name){
			$widget_register->register ( $name );
		}
		
	}

	public function Realar_Include_File(){
		return [
			'listing-gallery', 
			'listing-features', 
			'listing-floorplan', 
			'listing-video', 
			'banner', 
			'counterup', 
			'animated-shape', 
			'section-title', 
			'button', 
			'image', 
			'service', 
			'gallery-image', 
			'project',
			'features',
			'video', 
			'team', 
			'testimonial', 
			'arrows', 
			'brand-logo', 
			'contact-form', 
			'newsletter', 
			'contact-info', 
			'blog', 
			'menu-select',
			'team-info', 
			'custom-listing', 
			'price',
			'faq', 
			// // 'banner2', 
			// 'cta', 
			// 'info-box', 
			// 'service-list', 
			// 'product',
			// 'footer-widgets',

			// 'social',
			// 'filter', 
			// 'tab-builder', 
			// 'skill', 
			// 'step', 
			// 'features', 
			// 'project-info',
			// 'download',
			// 'marquee',
			// 'choose-us',
		];
	}

	public function Realar_Register_File(){
		return [
			new \Realar_Listing_Gallery(),
			new \Realar_Listing_Features(),
			new \Realar_Listing_FloorPlan(),
			new \Realar_Listing_Video(),
			new \Realar_Banner() ,
			new \Realar_Counterup(),
			new \Realar_Animated_Shape(),
			new \Realar_Section_Title(),
			new \Realar_Button(),
			new \Realar_Image(),
			new \Realar_Service(),
			new \realar_Slider_Image(),
			new \realar_Project(),
			new \realar_Feature(),
			new \realar_Video(),
			new \Realar_Team(),
			new \Realar_Testimonial(),
			new \Realar_Arrows(),
			new \Realar_Brand_Logo(),
			new \Realar_Contact_Form(),
			new \realar_Newsletter(),
			new \Realar_Contact_Info(),
			new \Realar_Blog(),
			new \Realar_Menu(),
			new \Realar_Team_info(),
			new \realar_CustoM_Listing(),
			new \Realar_Price(),
			new \Realar_Faq(),
			// // new \Realar_Banner2() ,
			// new \Realar_Cta(),
			// new \Realar_Info_Box(),
			// new \realar_Service_List(),
			// new \Realar_Product(),
		
			// new \Realar_Footer_Widgets(),

			// new \Realar_Social(),
			// new \Realar_Filter_Widgets(),
			// new \Realar_Tab_Builder(),
			// new \realar_Skill(),
			// new \realar_Step(),
			// new \Realar_Features(),
			// new \Realar_Project_Info(), 
			// new \realar_Download(),
			// new \Realar_Marquee(),
			// new \realar_Choose_Us(),
		];
	}

    public function widget_scripts() {

        // wp_enqueue_script(
        //     'realar-frontend-script',
        //     REALAR_PLUGDIRURI . 'assets/js/realar-frontend.js',
        //     array('jquery'),
        //     false,
        //     true
		// );

	}


    function realar_elementor_widget_categories( $elements_manager ) {

        $elements_manager->add_category(
            'realar',
            [
                'title' => __( 'Realar', 'realar' ),
                'icon' 	=> 'fa fa-plug',
            ]
        );
        $elements_manager->add_category(
            'realar_listing',
            [
                'title' => __( 'Realar Listing', 'realar' ),
                'icon' 	=> 'fa fa-plug',
            ]
        );

        $elements_manager->add_category(
            'realar_footer_elements',
            [
                'title' => __( 'Realar Footer Elements', 'realar' ),
                'icon' 	=> 'fa fa-plug',
            ]
		);

		$elements_manager->add_category(
            'realar_header_elements',
            [
                'title' => __( 'Realar Header Elements', 'realar' ),
                'icon' 	=> 'fa fa-plug',
            ]
        );
	}
}

Realar_Extension::instance();