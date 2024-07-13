<?php
/**
 * 
 * Plugin Name: Realar Core
 * Description: This is a helper plugin of realar theme
 * Version:     1.0
 * Author:      Themeholy
 * Author URI:  https://themeforest.net/user/themeholy 
 * License:     GPL2
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Domain Path: /languages
 * Text Domain: realar
 * 
 */

// Blocking direct access

if( ! defined( 'ABSPATH' ) ) {

    exit();

}

// Define Constant

define( 'REALAR_PLUGIN_PATH', plugin_dir_path( __FILE__ ) );

define( 'REALAR_PLUGIN_INC_PATH', plugin_dir_path( __FILE__ ) . 'inc/' );
define( 'REALAR_PLUGIN_CMB2EXT_PATH', plugin_dir_path( __FILE__ ) . 'cmb2-ext/' );

define( 'REALAR_PLUGIN_WIDGET_PATH', plugin_dir_path( __FILE__ ) . 'inc/widgets/' );

define( 'REALAR_PLUGDIRURI', plugin_dir_url( __FILE__ ) );

define( 'REALAR_ADDONS', plugin_dir_path( __FILE__ ) .'addons/' );

define( 'REALAR_ELEMENTOR_OPTIONS', plugin_dir_url( __FILE__ ) .'addons/elementor-options/' );

define( 'REALAR_ASSETS', plugin_dir_url( __FILE__ ) .'assets/' );

define( 'REALAR_CORE_PLUGIN_TEMP', plugin_dir_path( __FILE__ ) .'realar-template/' );

// load textdomain

load_plugin_textdomain( 'realar', false, basename( dirname( __FILE__ ) ) . '/languages' ); 

//include file.

require_once REALAR_PLUGIN_INC_PATH .'realarcore-functions.php';
require_once REALAR_PLUGIN_INC_PATH .'builder/builder.php';
require_once REALAR_PLUGIN_INC_PATH . 'MCAPI.class.php';
require_once REALAR_PLUGIN_INC_PATH .'realarajax.php';

require_once REALAR_PLUGIN_CMB2EXT_PATH . 'cmb2ext-init.php';

//Widget

require_once REALAR_PLUGIN_WIDGET_PATH . 'recent-post-widget.php';
require_once REALAR_PLUGIN_WIDGET_PATH . 'search-form.php';
require_once REALAR_PLUGIN_WIDGET_PATH . 'categories-lists.php';
require_once REALAR_PLUGIN_WIDGET_PATH . 'about-us-widget.php';
require_once REALAR_PLUGIN_WIDGET_PATH . 'realar-newslater-widget.php';
// require_once REALAR_PLUGIN_WIDGET_PATH . 'author-widget.php';
require_once REALAR_PLUGIN_WIDGET_PATH . 'offer-banner.php';
// require_once REALAR_PLUGIN_WIDGET_PATH . 'realar-contact-author.php';

//addons

require_once REALAR_ADDONS . 'addons.php';
require_once REALAR_ADDONS . 'addons-style-functions.php';
require_once REALAR_ADDONS . 'addons-field-functions.php';

// Register widget styles
add_action( 'elementor/editor/after_enqueue_scripts', 'widget_styles' );

function widget_styles() {

    wp_register_style( 'editor-style-1', plugins_url( 'assets/css/editor.css', __FILE__ ) );
    wp_enqueue_style( 'editor-style-1' );

}


