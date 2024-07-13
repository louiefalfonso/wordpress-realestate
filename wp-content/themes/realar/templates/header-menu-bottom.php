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

    if( defined( 'CMB2_LOADED' )  ){
        if( !empty( realar_meta('page_breadcrumb_area') ) ) {
            $realar_page_breadcrumb_area  = realar_meta('page_breadcrumb_area');
        } else {
            $realar_page_breadcrumb_area = '1';
        }
    }else{
        $realar_page_breadcrumb_area = '1';
    }
    
    $allowhtml = array(
        'p'         => array(
            'class'     => array()
        ),
        'span'      => array(
            'class'     => array(),
        ),
        'a'         => array(
            'href'      => array(),
            'title'     => array()
        ),
        'br'        => array(),
        'em'        => array(),
        'strong'    => array(),
        'b'         => array(),
        'sub'       => array(),
        'sup'       => array(),
    );
    
    if(  is_page() || is_page_template( 'template-builder.php' )  ) {
        if( $realar_page_breadcrumb_area == '1' ) {
            echo '<!-- Page title 2 -->';
            
            if( class_exists( 'ReduxFramework' ) ){
                $ex_class = '';
            }else{
                $ex_class = ' th-breadcumb';   
            }
            echo '<div class="breadcumb-wrapper '. esc_attr($ex_class).'">';
                echo '<div class="container">';
                    echo '<div class="row justify-content-center">';
                        echo '<div class="col-xl-9">';
                            echo '<div class="breadcumb-content">';
                                if( defined('CMB2_LOADED') || class_exists('ReduxFramework') ) {
                                    if( !empty( realar_meta('page_breadcrumb_settings') ) ) {
                                        if( realar_meta('page_breadcrumb_settings') == 'page' ) {
                                            $realar_page_title_switcher = realar_meta('page_title');
                                        } else {
                                            $realar_page_title_switcher = realar_opt('realar_page_title_switcher');
                                        }
                                    } else {
                                        $realar_page_title_switcher = '1';
                                    }
                                } else {
                                    $realar_page_title_switcher = '1';
                                }

                                if( $realar_page_title_switcher ){
                                    if( class_exists( 'ReduxFramework' ) ){
                                        $realar_page_title_tag    = realar_opt('realar_page_title_tag');
                                    }else{
                                        $realar_page_title_tag    = 'h1';
                                    }

                                    if( defined( 'CMB2_LOADED' )  ){
                                        if( !empty( realar_meta('page_title_settings') ) ) {
                                            $realar_custom_title = realar_meta('page_title_settings');
                                        } else {
                                            $realar_custom_title = 'default';
                                        }
                                    }else{
                                        $realar_custom_title = 'default';
                                    }

                                    if( $realar_custom_title == 'default' ) {
                                        echo realar_heading_tag(
                                            array(
                                                "tag"   => esc_attr( $realar_page_title_tag ),
                                                "text"  => esc_html( get_the_title( ) ),
                                                'class' => 'breadcumb-title'
                                            )
                                        );
                                    } else {
                                        echo realar_heading_tag(
                                            array(
                                                "tag"   => esc_attr( $realar_page_title_tag ),
                                                "text"  => esc_html( realar_meta('custom_page_title') ),
                                                'class' => 'breadcumb-title'
                                            )
                                        );
                                    }

                                }
                                if( defined('CMB2_LOADED') || class_exists('ReduxFramework') ) {

                                    if( realar_meta('page_breadcrumb_settings') == 'page' ) {
                                        $realar_breadcrumb_switcher = realar_meta('page_breadcrumb_trigger');
                                    } else {
                                        $realar_breadcrumb_switcher = realar_opt('realar_enable_breadcrumb');
                                    }

                                } else {
                                    $realar_breadcrumb_switcher = '1';
                                }

                                if( $realar_breadcrumb_switcher == '1' && (  is_page() || is_page_template( 'template-builder.php' ) )) {
                                        realar_breadcrumbs(
                                            array(
                                                'breadcrumbs_classes' => '',
                                            )
                                        );
                                }
                            echo '</div>';
                        echo '</div>';
                    echo '</div>';
                echo '</div>';

            echo '</div>';
            echo '<!-- End of Page title -->';
            
        }
    } else {
        echo '<!-- Page title 3 -->';
         if( class_exists( 'ReduxFramework' ) ){
            $ex_class = '';
            if (class_exists( 'woocommerce' ) && is_shop()){
            $breadcumb_bg_class = 'custom-woo-class';
            }elseif(is_404()){
                $breadcumb_bg_class = 'custom-error-class';
            }elseif(is_search()){
                $breadcumb_bg_class = 'custom-search-class';
            }elseif(is_archive()){
                $breadcumb_bg_class = 'custom-archive-class';
            }else{
                $breadcumb_bg_class = '';
            }
        }else{
            $breadcumb_bg_class = ''; 
            $ex_class = ' th-breadcumb';     
        }
        echo '<div class="breadcumb-wrapper '. esc_attr($breadcumb_bg_class . $ex_class).'">'; 
            echo '<div class="container z-index-common">';
                    echo '<div class="breadcumb-content">';
                        if( class_exists( 'ReduxFramework' )  ){
                            $realar_page_title_switcher  = realar_opt('realar_page_title_switcher');
                        }else{
                            $realar_page_title_switcher = '1';
                        }

                        if( $realar_page_title_switcher ){
                            if( class_exists( 'ReduxFramework' ) ){
                                $realar_page_title_tag    = realar_opt('realar_page_title_tag');
                            }else{
                                $realar_page_title_tag    = 'h1';
                            }
                            if( class_exists('woocommerce') && is_shop() ) {
                                echo realar_heading_tag(
                                    array(
                                        "tag"   => esc_attr( $realar_page_title_tag ),
                                        "text"  => wp_kses( woocommerce_page_title( false ), $allowhtml ),
                                        'class' => 'breadcumb-title'
                                    )
                                );
                            }elseif ( is_archive() ){
                                echo realar_heading_tag(
                                    array(
                                        "tag"   => esc_attr( $realar_page_title_tag ),
                                        "text"  => wp_kses( get_the_archive_title(), $allowhtml ),
                                        'class' => 'breadcumb-title'
                                    )
                                );
                            }elseif ( is_home() ){
                                $realar_blog_page_title_setting = realar_opt('realar_blog_page_title_setting');
                                $realar_blog_page_title_switcher = realar_opt('realar_blog_page_title_switcher');
                                $realar_blog_page_custom_title = realar_opt('realar_blog_page_custom_title');
                                if( class_exists('ReduxFramework') ){
                                    if( $realar_blog_page_title_switcher ){
                                        echo realar_heading_tag(
                                            array(
                                                "tag"   => esc_attr( $realar_page_title_tag ),
                                                "text"  => !empty( $realar_blog_page_custom_title ) && $realar_blog_page_title_setting == 'custom' ? esc_html( $realar_blog_page_custom_title) : esc_html__( 'Latest News', 'realar' ),
                                                'class' => 'breadcumb-title'
                                            )
                                        );
                                    }
                                }else{
                                    echo realar_heading_tag(
                                        array(
                                            "tag"   => "h1",
                                            "text"  => esc_html__( 'Latest News', 'realar' ),
                                            'class' => 'breadcumb-title',
                                        )
                                    );
                                }
                            }elseif( is_search() ){
                                echo realar_heading_tag(
                                    array(
                                        "tag"   => esc_attr( $realar_page_title_tag ),
                                        "text"  => esc_html__( 'Search Result', 'realar' ),
                                        'class' => 'breadcumb-title'
                                    )
                                );
                            }elseif( is_404() ){
                                echo realar_heading_tag(
                                    array(
                                        "tag"   => esc_attr( $realar_page_title_tag ),
                                        "text"  => esc_html__( 'Error Page', 'realar' ),
                                        'class' => 'breadcumb-title'
                                    )
                                );
                            }elseif( is_singular( 'product' ) ){
                                $posttitle_position  = realar_opt('realar_product_details_title_position');
                                $postTitlePos = false;
                                if( class_exists( 'ReduxFramework' ) ){
                                    if( $posttitle_position && $posttitle_position != 'header' ){
                                        $postTitlePos = true;
                                    }
                                }else{
                                    $postTitlePos = false;
                                }

                                if( $postTitlePos != true ){
                                    echo realar_heading_tag(
                                        array(
                                            "tag"   => esc_attr( $realar_page_title_tag ),
                                            "text"  => wp_kses( get_the_title( ), $allowhtml ),
                                            'class' => 'breadcumb-title'
                                        )
                                    );
                                } else {
                                    if( class_exists( 'ReduxFramework' ) ){
                                        $realar_post_details_custom_title  = realar_opt('realar_product_details_custom_title');
                                    }else{
                                        $realar_post_details_custom_title = __( 'Shop Details','realar' );
                                    }

                                    if( !empty( $realar_post_details_custom_title ) ) {
                                        echo realar_heading_tag(
                                            array(
                                                "tag"   => esc_attr( $realar_page_title_tag ),
                                                "text"  => wp_kses( $realar_post_details_custom_title, $allowhtml ),
                                                'class' => 'breadcumb-title'
                                            )
                                        );
                                    }
                                }
                            }else{
                                $posttitle_position  = realar_opt('realar_post_details_title_position');
                                $postTitlePos = false;
                                if( is_single() ){
                                    if( class_exists( 'ReduxFramework' ) ){
                                        if( $posttitle_position && $posttitle_position != 'header' ){
                                            $postTitlePos = true;
                                        }
                                    }else{
                                        $postTitlePos = false;
                                    }
                                }
                                if( is_singular( 'product' ) ){
                                    $posttitle_position  = realar_opt('realar_product_details_title_position');
                                    $postTitlePos = false;
                                    if( class_exists( 'ReduxFramework' ) ){
                                        if( $posttitle_position && $posttitle_position != 'header' ){
                                            $postTitlePos = true;
                                        }
                                    }else{
                                        $postTitlePos = false;
                                    }
                                }

                                if( $postTitlePos != true ){
                                    echo realar_heading_tag(
                                        array(
                                            "tag"   => esc_attr( $realar_page_title_tag ),
                                            "text"  => wp_kses( get_the_title( ), $allowhtml ),
                                            'class' => 'breadcumb-title'
                                        )
                                    );
                                } else {
                                    if( class_exists( 'ReduxFramework' ) ){
                                        $realar_post_details_custom_title  = realar_opt('realar_post_details_custom_title');
                                    }else{
                                        $realar_post_details_custom_title = __( 'Blog Details','realar' );
                                    }

                                    if( !empty( $realar_post_details_custom_title ) ) {
                                        echo realar_heading_tag(
                                            array(
                                                "tag"   => esc_attr( $realar_page_title_tag ),
                                                "text"  => wp_kses( $realar_post_details_custom_title, $allowhtml ),
                                                'class' => 'breadcumb-title'
                                            )
                                        );
                                    }
                                }
                            }
                        }
                        if( class_exists('ReduxFramework') ) {
                            $realar_breadcrumb_switcher = realar_opt( 'realar_enable_breadcrumb' );
                        } else {
                            $realar_breadcrumb_switcher = '1';
                        }
                        if( $realar_breadcrumb_switcher == '1' ) {
                            if(realar_breadcrumbs()){
                            echo '<div>';
                                realar_breadcrumbs(
                                    array(
                                        'breadcrumbs_classes' => 'nav',
                                    )
                                );
                            echo '</div>';
                            }
                        }
                    echo '</div>';
            echo '</div>';

        echo '</div>';
        echo '<!-- End of Page title -->';
    }