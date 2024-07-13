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
    // Header
    get_header();

    /**
    * 
    * Hook for Blog Start Wrapper
    *
    * Hook realar_blog_start_wrap
    *
    * @Hooked realar_blog_start_wrap_cb 10
    *  
    */
    do_action( 'realar_blog_start_wrap' );

    /**
    * 
    * Hook for Blog Column Start Wrapper
    *
    * Hook realar_blog_col_start_wrap
    *
    * @Hooked realar_blog_col_start_wrap_cb 10
    *  
    */
    do_action( 'realar_blog_col_start_wrap' );

    /**
    * 
    * Hook for Blog Content
    *
    * Hook realar_blog_content
    *
    * @Hooked realar_blog_content_cb 10
    *  
    */
    do_action( 'realar_blog_content' );

    /**
    * 
    * Hook for Blog Pagination
    *
    * Hook realar_blog_pagination
    *
    * @Hooked realar_blog_pagination_cb 10
    *  
    */
    do_action( 'realar_blog_pagination' ); 

    /**
    * 
    * Hook for Blog Column End Wrapper
    *
    * Hook realar_blog_col_end_wrap
    *
    * @Hooked realar_blog_col_end_wrap_cb 10
    *  
    */
    do_action( 'realar_blog_col_end_wrap' ); 

    /**
    * 
    * Hook for Blog Sidebar
    *
    * Hook realar_blog_sidebar
    *
    * @Hooked realar_blog_sidebar_cb 10
    *  
    */
    do_action( 'realar_blog_sidebar' );     
        
    /**
    * 
    * Hook for Blog End Wrapper
    *
    * Hook realar_blog_end_wrap
    *
    * @Hooked realar_blog_end_wrap_cb 10
    *  
    */
    do_action( 'realar_blog_end_wrap' );

    //footer
    get_footer();