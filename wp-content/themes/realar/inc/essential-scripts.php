<?php
/**
 * @Packge     : Realar
 * @Version    : 1.0
 * @Author     : Themeholy
 * @Author URI : https://themeforest.net/user/themeholy
 *
 */

// Block direct access
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Enqueue scripts and styles.
 */
function realar_essential_scripts() {

    wp_enqueue_style( 'realar-style', get_stylesheet_uri() ,array(), wp_get_theme()->get( 'Version' ) ); 

    // google font
    wp_enqueue_style( 'realar-fonts', realar_google_fonts() ,array(), null );

    // Bootstrap Min
    wp_enqueue_style( 'bootstrap', get_theme_file_uri( '/assets/css/bootstrap.min.css' ) ,array(), '5.0.0' );

    // Font Awesome Six
    wp_enqueue_style( 'fontawesome', get_theme_file_uri( '/assets/css/fontawesome.min.css' ) ,array(), '6.0.0' );

    // Magnific Popup
    wp_enqueue_style( 'magnific-popup', get_theme_file_uri( '/assets/css/magnific-popup.min.css' ), array(), '1.0' );

    // Swiper css
    wp_enqueue_style( 'swiper-css', get_theme_file_uri( '/assets/css/swiper-bundle.min.css' ) ,array(), '4.0.13' );

    // realar main style
    wp_enqueue_style( 'realar-main-style', get_theme_file_uri('/assets/css/style.css') ,array(), wp_get_theme()->get( 'Version' ) );


    // Load Js

    // Bootstrap
    wp_enqueue_script( 'bootstrap', get_theme_file_uri( '/assets/js/bootstrap.min.js' ), array( 'jquery' ), '5.0.0', true );

    // swiper js
    wp_enqueue_script( 'swiper-js', get_theme_file_uri( '/assets/js/swiper-bundle.min.js' ), array('jquery'), '1.0.0', true );

    // magnific popup
    wp_enqueue_script( 'magnific-popup', get_theme_file_uri( '/assets/js/jquery.magnific-popup.min.js' ), array('jquery'), '1.0.0', true );

    // Isotope
    wp_enqueue_script( 'isototpe-pkgd', get_theme_file_uri( '/assets/js/isotope.pkgd.min.js' ), array( 'jquery' ), '1.0.0', true );

    // Isotope Imagesloaded
    wp_enqueue_script( 'imagesloaded' ); 
     
    // gsap
    wp_enqueue_script( 'gsap', get_theme_file_uri( '/assets/js/gsap.min.js' ), array( 'jquery' ), '3.4.0', true );

    // datetimepicker
    wp_enqueue_script( 'tweenmax', get_theme_file_uri( '/assets/js/tweenmax.min.js' ), array( 'jquery' ), '1.0.0', true );


    // nice-select
    wp_enqueue_script( 'marquee', get_theme_file_uri( '/assets/js/jquery.marquee.min.js' ), array( 'jquery' ), '1.0.0', true );

    // ScrollTrigger
    wp_enqueue_script( 'counterup', get_theme_file_uri( '/assets/js/jquery.counterup.min.js' ), array( 'jquery' ), '3.3.3', true );

    // main script
    wp_enqueue_script( 'realar-main-script', get_theme_file_uri( '/assets/js/main.js' ), array('jquery'), wp_get_theme()->get( 'Version' ), true );

    // comment reply
    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }
}
add_action( 'wp_enqueue_scripts', 'realar_essential_scripts',99 );


function realar_block_editor_assets( ) {
    // Add custom fonts.
    wp_enqueue_style( 'realar-editor-fonts', realar_google_fonts(), array(), null );
}

add_action( 'enqueue_block_editor_assets', 'realar_block_editor_assets' );

/*
Register Fonts
*/
function realar_google_fonts() {
    $font_url = '';
    
    /*
    Translators: If there are characters in your language that are not supported
    by chosen font(s), translate this to 'off'. Do not translate into your own language.
     */
     
    if ( 'off' !== _x( 'on', 'Google font: on or off', 'realar' ) ) {
        $font_url =  'https://fonts.googleapis.com/css2?family=Inter:wght@100..900&family=Outfit:wght@100..900&display=swap';
    }
    return $font_url;
}