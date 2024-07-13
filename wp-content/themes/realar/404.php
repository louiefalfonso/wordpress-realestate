<?php
/**
 * @Packge     : Realar
 * @Version    : 1.0
 * @Author     : Themeholy
 * @Author URI : https://themeforest.net/user/themeholy
 *
 */

    // Block direct access
    if( !defined( 'ABSPATH' ) ){
        exit();
    }

    if( class_exists( 'ReduxFramework' ) ) {
        $realar404title     = realar_opt( 'realar_error_title' );
        $realar404subtitle     = realar_opt( 'realar_error_subtitle' );
        $realar404description  = realar_opt( 'realar_error_description' );
        $realar404btntext      = realar_opt( 'realar_error_btn_text' );
    } else {
        $realar404title     = __( '404', 'realar' );
        $realar404subtitle     = __( 'This page seems to have slipped through a time portal', 'realar' );
        $realar404description  = __( 'We appologize for any distruction to the space-time continuum. Feel free to journey back to our homepage', 'realar' );
        $realar404btntext      = __( 'Go Back Home', 'realar');

    }

    // get header //
    get_header(); 

        echo '<section class="error-area-1 position-relative">';
            echo '<div class="container">';
                echo '<div class="error-img">';
                    if(!empty(realar_opt('realar_error_img', 'url' ) )){
                        echo '<img src="'.esc_url( realar_opt('realar_error_img', 'url' ) ).'" alt="'.esc_attr__('404 image', 'realar').'">';
                    }else{
                        echo '<img src="'.get_template_directory_uri().'/assets/img/error_1_1.png" alt="'.esc_attr__('404 image', 'realar').'">';
                    }
                echo '</div>';
                echo '<div class="row">';
                    echo '<div class="col-lg-6">';
                        echo '<div class="error-content">';
                            if(!empty($realar404title)){
                                echo '<h2 class="error-title">'.esc_html( $realar404title ).'</h2>';
                            }
                            if(!empty($realar404subtitle)){
                                echo '<h3 class="error-subtitle">'.esc_html( $realar404subtitle ).'</h3>';
                            }
                            if(!empty($realar404description)){
                                echo '<p class="error-text">'.esc_html( $realar404description ).'</p>';
                            }
                            echo '<a href="'.esc_url( home_url('/') ).'" class="th-btn style-border2 th-btn-icon">'.esc_html( $realar404btntext ).'</a>';
                        echo '</div>';
                    echo '</div>';
                echo '</div>';
            echo '</div>';
        echo '</section>';
    //footer
    get_footer();