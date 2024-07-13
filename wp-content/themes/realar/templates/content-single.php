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

    realar_setPostViews( get_the_ID() );

    ?>
    <div <?php post_class(); ?>>
    <?php
        if( class_exists('ReduxFramework') ) {
            $realar_post_details_title_position = realar_opt('realar_post_details_title_position');
        } else {
            $realar_post_details_title_position = 'header';
        }

        $allowhtml = array(
            'p'         => array(
                'class'     => array()
            ),
            'span'      => array(),
            'a'         => array(
                'href'      => array(),
                'title'     => array()
            ),
            'br'        => array(),
            'em'        => array(),
            'strong'    => array(),
            'b'         => array(),
        );
        // Blog Post Thumbnail
        do_action( 'realar_blog_post_thumb' );
        
        echo '<div class="blog-content">';
            // Blog Post Meta
            do_action( 'realar_blog_post_meta' );

            if( $realar_post_details_title_position != 'header' ) {
                echo '<h2 class="blog-title">'.wp_kses( get_the_title(), $allowhtml ).'</h2>';
            }

            if( get_the_content() ){

                the_content();
                // Link Pages
                realar_link_pages();
            }  

            if( class_exists('ReduxFramework') ) {
                $realar_post_details_share_options = realar_opt('realar_post_details_share_options');
                $realar_display_post_tags = realar_opt('realar_display_post_tags');
                $realar_author_options = realar_opt('realar_post_details_author_desc_trigger');
            } else {
                $realar_post_details_share_options = false;
                $realar_display_post_tags = false;
                $realar_author_options = false;
            }
            
            $realar_post_tag = get_the_tags();
            
            if( ! empty( $realar_display_post_tags ) || ( ! empty($realar_post_details_share_options )) ){
                echo '<div class="share-links clearfix">';
                    echo '<div class="row justify-content-between">';
                        if( is_array( $realar_post_tag ) && ! empty( $realar_post_tag ) ){
                            if( count( $realar_post_tag ) > 1 ){
                                $tag_text = __( 'Tags:', 'realar' );
                            }else{
                                $tag_text = __( 'Tag:', 'realar' );
                            }
                            if($realar_display_post_tags){
                                echo '<div class="col-md-auto">';
                                    echo '<span class="share-links-title">'.esc_html($tag_text).'</span>';
                                    echo '<div class="tagcloud">';
                                        foreach( $realar_post_tag as $tags ){
                                            echo '<a href="'.esc_url( get_tag_link( $tags->term_id ) ).'">'.esc_html( $tags->name ).'</a>';
                                        }
                                    echo '</div>';
                                echo '</div>';
                            }
                        }
    
                        /**
                        *
                        * Hook for Blog Details Share Options
                        *
                        * Hook realar_blog_details_share_options
                        *
                        * @Hooked realar_blog_details_share_options_cb 10
                        *
                        */
                        do_action( 'realar_blog_details_share_options' );
    
                    echo '</div>';
    
                echo '</div>';    
            }  
        
        echo '</div>';

    echo '</div>'; 

        /**
        *
        * Hook for Post Navigation
        *
        * Hook realar_blog_details_post_navigation
        *
        * @Hooked realar_blog_details_post_navigation_cb 10
        *
        */
        do_action( 'realar_blog_details_post_navigation' );

        /**
        *
        * Hook for Blog Authro Bio
        *
        * Hook realar_blog_details_author_bio
        *
        * @Hooked realar_blog_details_author_bio_cb 10
        *
        */
        do_action( 'realar_blog_details_author_bio' );

        /**
        *
        * Hook for Blog Details Comments
        *
        * Hook realar_blog_details_comments
        *
        * @Hooked realar_blog_details_comments_cb 10
        *
        */
        do_action( 'realar_blog_details_comments' );
