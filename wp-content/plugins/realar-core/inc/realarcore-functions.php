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

 * Admin Custom Login Logo

 */

function realar_custom_login_logo() {

    $logo = ! empty( realar_opt( 'realar_admin_login_logo', 'url' ) ) ? realar_opt( 'realar_admin_login_logo', 'url' ) : '' ;

    if( isset( $logo ) && ! empty( $logo ) ){

        echo '<style type="text/css">body.login div#login h1 a { background-image:url('.esc_url( $logo ).'); }</style>';
    }
}

add_action( 'login_enqueue_scripts', 'realar_custom_login_logo' );

/**
* Admin Custom css
*/

add_action( 'admin_enqueue_scripts', 'realar_admin_styles' );

function realar_admin_styles() {

  if ( ! empty( $realar_admin_custom_css ) ) {
        $realar_admin_custom_css = str_replace(array("\r\n", "\r", "\n", "\t", '    '), '', $realar_admin_custom_css);
        echo '<style rel="stylesheet" id="realar-admin-custom-css" >';
            echo esc_html( $realar_admin_custom_css );
        echo '</style>';
    }
}

// share button code

 function realar_social_sharing_buttons( ) {

    // Get page URL

    $URL        = get_permalink();
    $Sitetitle  = get_bloginfo('name');
    // Get page title

    $Title  = str_replace( ' ', '%20', get_the_title());

    // Construct sharing URL without using any script

    $twitterURL     = 'https://twitter.com/share?text='.esc_html( $Title ).'&url='.esc_url( $URL );
    $facebookURL    = 'https://www.facebook.com/sharer/sharer.php?u='.esc_url( $URL );
    $pinterest   = 'http://pinterest.com/pin/create/link/?url='.esc_url( $URL ).'&media='.esc_url(get_the_post_thumbnail_url()).'&description='.wp_kses_post(get_the_title());
    $linkedin       = 'https://www.linkedin.com/shareArticle?mini=true&url='.esc_url( $URL ).'&title='.esc_html( $Title );
    // Add sharing button at the end of page/page content

    $content = '';

    $content .= '<a href="'.esc_url( $facebookURL ).'" target="_blank"><i class="fab fa-facebook-f"></i></a>';
    $content .= '<a href="'. esc_url( $twitterURL ) .'" target="_blank"><i class="fab fa-twitter"></i></a>';
    $content .= '<a href="'.esc_url( $linkedin ).'" target="_blank"><i class="fab fa-linkedin-in"></i></a>';
    $content .= '<a href="'.esc_url( $pinterest ).'" target="_blank"><i class="fa-brands fa-pinterest-p"></i></a>';


    return $content;

};


//Post Reading Time Count

function realar_estimated_reading_time() {
    global $post;
    // get the content
    $the_content = $post->post_content;
    // count the number of words
    $words = str_word_count( strip_tags( $the_content ) );
    // rounding off and deviding per 100 words per minute
    $minute = floor( $words / 100 );
    // rounding off to get the seconds
    $second = floor( $words % 100 / ( 100 / 60 ) );
    // calculate the amount of time needed to read
    $estimate = $minute . esc_html__(' Min', 'realar') . ( $minute == 1 ? '' : 's' ) . esc_html__(' Read', 'realar');
    // create output
    $output = $estimate;
    // return the estimate
    return $output;
}



//add SVG to allowed file uploads

function realar_mime_types( $mimes ) {

    $mimes['svg'] = 'image/svg+xml';
    $mimes['svgz'] = 'image/svgz+xml';
    $mimes['exe'] = 'program/exe';
    $mimes['dwg'] = 'image/vnd.dwg';
    return $mimes;
}

add_filter('upload_mimes', 'realar_mime_types');



function realar_wp_check_filetype_and_ext( $data, $file, $filename, $mimes ) {

    $wp_filetype = wp_check_filetype( $filename, $mimes );
    $ext         = $wp_filetype['ext'];
    $type        = $wp_filetype['type'];
    $proper_filename = $data['proper_filename'];

    return compact( 'ext', 'type', 'proper_filename' );

}

add_filter( 'wp_check_filetype_and_ext', 'realar_wp_check_filetype_and_ext', 10, 4 );

add_action( 'init','realar_project', 0 );


function realar_project(){

    $labels = array(

        'name'               => esc_html__( 'Projects', 'post Category general name', 'realar' ),
        'singular_name'      => esc_html__( 'Project', 'post Category singular name', 'realar' ),
        'menu_name'          => esc_html__( 'Projects', 'admin menu', 'realar' ),
        'name_admin_bar'     => esc_html__( 'Project', 'add new on admin bar', 'realar' ),
        'add_new'            => esc_html__( 'Add New', 'Project', 'realar' ),
        'add_new_item'       => esc_html__( 'Add New Project', 'realar' ),
        'new_item'           => esc_html__( 'New Project', 'realar' ),
        'edit_item'          => esc_html__( 'Edit Project', 'realar' ),
        'view_item'          => esc_html__( 'View Project', 'realar' ),
        'all_items'          => esc_html__( 'All Projects', 'realar' ),
        'search_items'       => esc_html__( 'Search Projects', 'realar' ),
        'parent_item_colon'  => esc_html__( 'Parent Projects:', 'realar' ),
        'not_found'          => esc_html__( 'No Projects found.', 'realar' ),
        'not_found_in_trash' => esc_html__( 'No Projects found in Trash.', 'realar' ),
    );



    $args = array(

        'labels'             => $labels,
        'description'        => esc_html__( 'Description.', 'realar' ),
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => null,
        'show_in_rest'       => true,
        'menu_icon'          => 'dashicons-index-card',
        'supports'           => array( 'title', 'thumbnail', 'editor', 'excerpt', 'elementor' ),
        'rewrite'            => array( 'slug' => 'all-projects' ),
    );

    register_post_type( 'realar_project', $args );

  }



/**
 * Single Template
 */

// add_filter( 'single_template', 'realar_core_template_redirect' );

// if( ! function_exists( 'realar_core_template_redirect' ) ){

//     function realar_core_template_redirect( $single_template ){
//         global $post;

//         if( $post ){

//             if( $post->post_type == 'realar_event' ){

//                 $single_template = REALAR_CORE_PLUGIN_TEMP . 'single-realar_event.php';

//             }
//         }

//         return $single_template;
//     }

// }


/**
 * Archive Template
 */

// add_filter( 'archive_template', 'realar_core_template_archive' );

if( ! function_exists( 'realar_core_template_archive' ) ){

    function realar_core_template_archive( $archive_template ){

        global $post;


        if( $post ){

            if( $post->post_type == 'realar_event' ){

                $archive_template = REALAR_CORE_PLUGIN_TEMP . 'archive-realar_event.php';
            }
        }

        return $archive_template;
    }

}

function realar_calculate_read_time($content) {
    // Average reading speed in words per minute
    $average_reading_speed = 200;

    // Strip shortcodes and HTML tags from the content
    $clean_content = wp_strip_all_tags(strip_shortcodes($content));

    // Count the number of words in the cleaned content
    $word_count = str_word_count($clean_content);

    // Calculate the reading time in minutes
    $reading_time = ceil($word_count / $average_reading_speed);

    // Return the reading time
    return $reading_time;
}



// Add Image Size
add_image_size( 'realar_85X85', 85, 85, true );
add_image_size( 'realar_636X440', 636, 440, true );
add_image_size( 'realar_636X300', 636, 300, true );
add_image_size( 'realar_416X300', 416, 300, true );


remove_filter( 'render_block', 'wp_render_layout_support_flag', 10, 2 );
remove_filter( 'render_block', 'gutenberg_render_layout_support_flag', 10, 2 );