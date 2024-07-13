<?php
/**
 * @Packge     : Realar
 * @Version    : 1.0
 * @Author     : Themeholy
 * @Author URI : https://themeforest.net/user/themeholy
 *
 */

    // Block direct access
    if( ! defined( 'ABSPATH' ) ){
        exit();
    }

    if( class_exists( 'ReduxFramework' ) && defined('ELEMENTOR_VERSION') ) {
        if( is_page() || is_page_template('template-builder.php') ) {
            $realar_post_id = get_the_ID();

            // Get the page settings manager
            $realar_page_settings_manager = \Elementor\Core\Settings\Manager::get_settings_managers( 'page' );

            // Get the settings model for current post
            $realar_page_settings_model = $realar_page_settings_manager->get_model( $realar_post_id );

            // Retrieve the color we added before
            $realar_header_style = $realar_page_settings_model->get_settings( 'realar_header_style' );
            $realar_header_builder_option = $realar_page_settings_model->get_settings( 'realar_header_builder_option' );

            if( $realar_header_style == 'header_builder'  ) {

                if( !empty( $realar_header_builder_option ) ) {
                    $realarheader = get_post( $realar_header_builder_option );
                    echo '<header class="header">';
                        echo \Elementor\Plugin::instance()->frontend->get_builder_content_for_display( $realarheader->ID );
                    echo '</header>';
                }
            } else {
                // global options
                $realar_header_builder_trigger = realar_opt('realar_header_options');
                if( $realar_header_builder_trigger == '2' ) {
                    echo '<header>';
                    $realar_global_header_select = get_post( realar_opt( 'realar_header_select_options' ) );
                    $header_post = get_post( $realar_global_header_select );
                    echo \Elementor\Plugin::instance()->frontend->get_builder_content_for_display( $header_post->ID );
                    echo '</header>';
                } else {
                    // wordpress Header
                    realar_global_header_option();
                }
            }
        } else {
            $realar_header_options = realar_opt('realar_header_options');
            if( $realar_header_options == '1' ) {
                realar_global_header_option();
            } else {
                $realar_header_select_options = realar_opt('realar_header_select_options');
                $realarheader = get_post( $realar_header_select_options );
                echo '<header class="header">';
                    echo \Elementor\Plugin::instance()->frontend->get_builder_content_for_display( $realarheader->ID );
                echo '</header>';
            }
        }
    } else {
        realar_global_header_option();
    }