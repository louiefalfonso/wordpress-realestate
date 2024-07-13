<?php
// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
    exit( );
}
/**
 * @Packge    : realar
 * @version   : 1.0
 * @Author    : Themeholy
 * @Author URI: https://themeforest.net/user/themeholy
 */

// demo import file
function realar_import_files() {

	$demoImg = '<img src="'. REALAR_DEMO_DIR_URI  .'screen-image.png" alt="'.esc_attr__('Demo Preview Imgae','realar').'" />';

    return array(
        array(
            'import_file_name'             => esc_html__('Realar Demo','realar'),
            'local_import_file'            =>  REALAR_DEMO_DIR_PATH  . 'realar-demo.xml',
            'local_import_widget_file'     =>  REALAR_DEMO_DIR_PATH  . 'realar-widgets-demo.json',
            'local_import_redux'           => array(
                array(
                    'file_path'   =>  REALAR_DEMO_DIR_PATH . 'redux_options_demo.json',
                    'option_name' => 'realar_opt',
                ),
            ),
            'import_notice' => $demoImg,
        ),
    );
}
add_filter( 'pt-ocdi/import_files', 'realar_import_files' );

// demo import setup
function realar_after_import_setup() {
	// Assign menus to their locations.

	$primary_menu  		= get_term_by( 'name', 'Primary Menu', 'nav_menu' );

	set_theme_mod( 'nav_menu_locations', array(
			'primary-menu'   	=> $primary_menu->term_id, 
		)
	);

	// Assign front page and posts page (blog page).
	$front_page_id 	= get_page_by_title( 'Luxury Apartment' );
	$blog_page_id  	= get_page_by_title( 'Blog' );

	update_option( 'show_on_front', 'page' );
	update_option( 'page_on_front', $front_page_id->ID );
	update_option( 'page_for_posts', $blog_page_id->ID );

    
}
add_action( 'pt-ocdi/after_import', 'realar_after_import_setup' );


//disable the branding notice after successful demo import
add_filter( 'pt-ocdi/disable_pt_branding', '__return_true' );

//change the location, title and other parameters of the plugin page
function realar_import_plugin_page_setup( $default_settings ) {
	$default_settings['parent_slug'] = 'themes.php';
	$default_settings['page_title']  = esc_html__( 'Realar Demo Import' , 'realar' );
	$default_settings['menu_title']  = esc_html__( 'Import Demo Data' , 'realar' );
	$default_settings['capability']  = 'import';
	$default_settings['menu_slug']   = 'realar-demo-import';

	return $default_settings;
}
add_filter( 'pt-ocdi/plugin_page_setup', 'realar_import_plugin_page_setup' );

// Enqueue scripts
function realar_demo_import_custom_scripts(){
	if( isset( $_GET['page'] ) && $_GET['page'] == 'realar-demo-import' ){
		// style
		wp_enqueue_style( 'realar-demo-import', REALAR_DEMO_DIR_URI.'css/realar.demo.import.css', array(), '1.0', false );
	}
}
add_action( 'admin_enqueue_scripts', 'realar_demo_import_custom_scripts' );