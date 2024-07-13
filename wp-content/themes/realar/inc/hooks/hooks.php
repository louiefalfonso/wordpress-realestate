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

	/**
	* Hook for preloader
	*/
	add_action( 'realar_preloader_wrap', 'realar_preloader_wrap_cb', 10 );

	/**
	* Hook for offcanvas cart
	*/
	add_action( 'realar_main_wrapper_start', 'realar_main_wrapper_start_cb', 10 );

	/**
	* Hook for Header
	*/
	add_action( 'realar_header', 'realar_header_cb', 10 );
	
	/**
	* Hook for Blog Start Wrapper
	*/
	add_action( 'realar_blog_start_wrap', 'realar_blog_start_wrap_cb', 10 );
	
	/**
	* Hook for Blog Column Start Wrapper
	*/
    add_action( 'realar_blog_col_start_wrap', 'realar_blog_col_start_wrap_cb', 10 );
	
	/**
	* Hook for Blog Column End Wrapper
	*/
    add_action( 'realar_blog_col_end_wrap', 'realar_blog_col_end_wrap_cb', 10 );
	
	/**
	* Hook for Blog Column End Wrapper
	*/
    add_action( 'realar_blog_end_wrap', 'realar_blog_end_wrap_cb', 10 );
	
	/**
	* Hook for Blog Pagination
	*/
    add_action( 'realar_blog_pagination', 'realar_blog_pagination_cb', 10 );
    
    /**
	* Hook for Blog Content
	*/
	add_action( 'realar_blog_content', 'realar_blog_content_cb', 10 );
    
    /**
	* Hook for Blog Sidebar
	*/
	add_action( 'realar_blog_sidebar', 'realar_blog_sidebar_cb', 10 );
    
    /**
	* Hook for Blog Details Sidebar
	*/
	add_action( 'realar_blog_details_sidebar', 'realar_blog_details_sidebar_cb', 10 );

	/**
	* Hook for Blog Details Wrapper Start
	*/
	add_action( 'realar_blog_details_wrapper_start', 'realar_blog_details_wrapper_start_cb', 10 );

	/**
	* Hook for Blog Details Post Meta
	*/
	add_action( 'realar_blog_post_meta', 'realar_blog_post_meta_cb', 10 );

	/**
	* Hook for Blog Details Post Share Options
	*/
	add_action( 'realar_blog_details_share_options', 'realar_blog_details_share_options_cb', 10 );

	/**
	* Hook for Blog Post Share Options
	*/
	add_action( 'realar_blog_post_share_options', 'realar_blog_post_share_options_cb', 10 );

	/**
	* Hook for Blog Details Post Author Bio
	*/
	add_action( 'realar_blog_details_author_bio', 'realar_blog_details_author_bio_cb', 10 );

	/**
	* Hook for Blog Details Tags and Categories
	*/
	add_action( 'realar_blog_details_tags_and_categories', 'realar_blog_details_tags_and_categories_cb', 10 );

	/**
	* Hook for Blog Details Related Post Navigation
	*/
	add_action( 'realar_blog_details_post_navigation', 'realar_blog_details_post_navigation_cb', 10 ); 

	/**
	* Hook for Blog Deatils Comments
	*/
	add_action( 'realar_blog_details_comments', 'realar_blog_details_comments_cb', 10 );

	/**
	* Hook for Blog Deatils Column Start
	*/
	add_action('realar_blog_details_col_start','realar_blog_details_col_start_cb');

	/**
	* Hook for Blog Deatils Column End
	*/
	add_action('realar_blog_details_col_end','realar_blog_details_col_end_cb');

	/**
	* Hook for Blog Deatils Wrapper End
	*/
	add_action('realar_blog_details_wrapper_end','realar_blog_details_wrapper_end_cb');
	
	/**
	* Hook for Blog Post Thumbnail
	*/
	add_action('realar_blog_post_thumb','realar_blog_post_thumb_cb');
    
	/**
	* Hook for Blog Post Content
	*/
	add_action('realar_blog_post_content','realar_blog_post_content_cb');
	
    
	/**
	* Hook for Blog Post Excerpt And Read More Button
	*/
	add_action('realar_blog_postexcerpt_read_content','realar_blog_postexcerpt_read_content_cb');
	
	/**
	* Hook for footer content
	*/
	add_action( 'realar_footer_content', 'realar_footer_content_cb', 10 );
	
	/**
	* Hook for main wrapper end
	*/
	add_action( 'realar_main_wrapper_end', 'realar_main_wrapper_end_cb', 10 );
	
	/**
	* Hook for Back to Top Button
	*/
	add_action( 'realar_back_to_top', 'realar_back_to_top_cb', 10 );

	/**
	* Hook for Page Start Wrapper
	*/
	add_action( 'realar_page_start_wrap', 'realar_page_start_wrap_cb', 10 );

	/**
	* Hook for Page End Wrapper
	*/
	add_action( 'realar_page_end_wrap', 'realar_page_end_wrap_cb', 10 );

	/**
	* Hook for Page Column Start Wrapper
	*/
	add_action( 'realar_page_col_start_wrap', 'realar_page_col_start_wrap_cb', 10 );

	/**
	* Hook for Page Column End Wrapper
	*/
	add_action( 'realar_page_col_end_wrap', 'realar_page_col_end_wrap_cb', 10 );

	/**
	* Hook for Page Column End Wrapper
	*/
	add_action( 'realar_page_sidebar', 'realar_page_sidebar_cb', 10 );

	/**
	* Hook for Page Content
	*/
	add_action( 'realar_page_content', 'realar_page_content_cb', 10 );