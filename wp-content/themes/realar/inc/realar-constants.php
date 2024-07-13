<?php
/**
 * @Packge     : Realar
 * @Version    : 1.0
 * @Author     : Themeholy
 * @Author URI : https://themeforest.net/user/themeholy
 *
 */

// Block direct access
if ( !defined( 'ABSPATH' ) ) {
    exit;
}

/**
 *
 * Define constant 
 *
 */

// Base URI
if ( ! defined( 'REALAR_DIR_URI' ) ) {
    define('REALAR_DIR_URI', get_parent_theme_file_uri().'/' );
}

// Assist URI
if ( ! defined( 'REALAR_DIR_ASSIST_URI' ) ) {
    define( 'REALAR_DIR_ASSIST_URI', get_theme_file_uri('/assets/') );
}


// Css File URI
if ( ! defined( 'REALAR_DIR_CSS_URI' ) ) {
    define( 'REALAR_DIR_CSS_URI', get_theme_file_uri('/assets/css/') );
}

// Js File URI
if (!defined('REALAR_DIR_JS_URI')) {
    define('REALAR_DIR_JS_URI', get_theme_file_uri('/assets/js/'));
}


// Base Directory
if (!defined('REALAR_DIR_PATH')) {
    define('REALAR_DIR_PATH', get_parent_theme_file_path() . '/');
}

//Inc Folder Directory
if (!defined('REALAR_DIR_PATH_INC')) {
    define('REALAR_DIR_PATH_INC', REALAR_DIR_PATH . 'inc/');
}

//REALAR framework Folder Directory
if (!defined('REALAR_DIR_PATH_FRAM')) {
    define('REALAR_DIR_PATH_FRAM', REALAR_DIR_PATH_INC . 'realar-framework/');
}

//Hooks Folder Directory
if (!defined('REALAR_DIR_PATH_HOOKS')) {
    define('REALAR_DIR_PATH_HOOKS', REALAR_DIR_PATH_INC . 'hooks/');
}

//Demo Data Folder Directory Path
if( !defined( 'REALAR_DEMO_DIR_PATH' ) ){
    define( 'REALAR_DEMO_DIR_PATH', REALAR_DIR_PATH_INC.'demo-data/' );
}
    
//Demo Data Folder Directory URI
if( !defined( 'REALAR_DEMO_DIR_URI' ) ){
    define( 'REALAR_DEMO_DIR_URI', REALAR_DIR_URI.'inc/demo-data/' );
}