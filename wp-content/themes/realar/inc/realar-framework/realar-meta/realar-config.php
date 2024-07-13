<?php

/**
 * Include and setup custom metaboxes and fields. (make sure you copy this file to outside the CMB2 directory)
 *
 * Be sure to replace all instances of 'yourprefix_' with your project's prefix.
 * http://nacin.com/2010/05/11/in-wordpress-prefix-everything/
 *
 * @category YourThemeOrPlugin
 * @package  Demo_CMB2
 * @license  http://www.opensource.org/licenses/gpl-license.php GPL v2.0 (or later)
 * @link     https://github.com/WebDevStudios/CMB2
 */

 /**
 * Only return default value if we don't have a post ID (in the 'post' query variable)
 *
 * @param  bool  $default On/Off (true/false)
 * @return mixed          Returns true or '', the blank default
 */
function realar_set_checkbox_default_for_new_post( $default ) {
	return isset( $_GET['post'] ) ? '' : ( $default ? (string) $default : '' );
}

add_action( 'cmb2_admin_init', 'realar_register_metabox' );

/**
 * Hook in and add a demo metabox. Can only happen on the 'cmb2_admin_init' or 'cmb2_init' hook.
 */

function realar_register_metabox() {

	$prefix = '_realar_';

	$prefixpage = '_realarpage_';
	
	$realar_post_meta = new_cmb2_box( array(
		'id'            => $prefixpage . 'blog_post_control',
		'title'         => esc_html__( 'Post Thumb Controller', 'realar' ),
		'object_types'  => array( 'post' ), // Post type
		'closed'        => true
	) );

    $realar_post_meta->add_field( array(
        'name' => esc_html__( 'Post Format Video', 'realar' ),
        'desc' => esc_html__( 'Use This Field When Post Format Video', 'realar' ),
        'id'   => $prefix . 'post_format_video',
        'type' => 'text_url',
    ) );

	$realar_post_meta->add_field( array(
		'name' => esc_html__( 'Post Format Audio', 'realar' ),
		'desc' => esc_html__( 'Use This Field When Post Format Audio', 'realar' ),
		'id'   => $prefix . 'post_format_audio',
        'type' => 'oembed',
    ) );
	$realar_post_meta->add_field( array(
		'name' => esc_html__( 'Post Thumbnail For Slider', 'realar' ),
		'desc' => esc_html__( 'Use This Field When You Want A Slider In Post Thumbnail', 'realar' ),
		'id'   => $prefix . 'post_format_slider',
        'type' => 'file_list',
    ) );
	
	$realar_page_meta = new_cmb2_box( array(
		'id'            => $prefixpage . 'page_meta_section',
		'title'         => esc_html__( 'Page Meta', 'realar' ),
		'object_types'  => array( 'page'), // Post type
        'closed'        => true
    ) );

    $realar_page_meta->add_field( array(
		'name' => esc_html__( 'Page Breadcrumb Area', 'realar' ),
		'desc' => esc_html__( 'check to display page breadcrumb area.', 'realar' ),
		'id'   => $prefix . 'page_breadcrumb_area',
        'type' => 'select',
        'default' => '1',
        'options'   => array(
            '1'   => esc_html__('Show','realar'),
            '2'     => esc_html__('Hide','realar'),
        )
    ) );


    $realar_page_meta->add_field( array(
		'name' => esc_html__( 'Page Breadcrumb Settings', 'realar' ),
		'id'   => $prefix . 'page_breadcrumb_settings',
        'type' => 'select',
        'default'   => 'global',
        'options'   => array(
            'global'   => esc_html__('Global Settings','realar'),
            'page'     => esc_html__('Page Settings','realar'),
        )
	) );

    $realar_page_meta->add_field( array(
        'name'    => esc_html__( 'Breadcumb Image', 'realar' ),
        'desc'    => esc_html__( 'Upload an image or enter an URL.', 'realar' ),
        'id'      => $prefix . 'breadcumb_image',
        'type'    => 'file',
        // Optional:
        'options' => array(
            'url' => false, // Hide the text input for the url
        ),
        'text'    => array(
            'add_upload_file_text' => __( 'Add File', 'realar' ) // Change upload button text. Default: "Add or Upload File"
        ),
        'preview_size' => 'large', // Image size to use when previewing in the admin.
    ) );

    $realar_page_meta->add_field( array(
		'name' => esc_html__( 'Page Title', 'realar' ),
		'desc' => esc_html__( 'check to display Page Title.', 'realar' ),
		'id'   => $prefix . 'page_title',
        'type' => 'select',
        'default' => '1',
        'options'   => array(
            '1'   => esc_html__('Show','realar'),
            '2'     => esc_html__('Hide','realar'),
        )
	) );

    $realar_page_meta->add_field( array(
		'name' => esc_html__( 'Page Title Settings', 'realar' ),
		'id'   => $prefix . 'page_title_settings',
        'type' => 'select',
        'options'   => array(
            'default'  => esc_html__('Default Title','realar'),
            'custom'  => esc_html__('Custom Title','realar'),
        ),
        'default'   => 'default'
    ) );

    $realar_page_meta->add_field( array(
		'name' => esc_html__( 'Custom Page Title', 'realar' ),
		'id'   => $prefix . 'custom_page_title',
        'type' => 'text'
    ) );

    $realar_page_meta->add_field( array(
		'name' => esc_html__( 'Breadcrumb', 'realar' ),
		'desc' => esc_html__( 'Select Show to display breadcrumb area', 'realar' ),
		'id'   => $prefix . 'page_breadcrumb_trigger',
        'type' => 'switch_btn',
        'default' => realar_set_checkbox_default_for_new_post( true ),
    ) );

    $realar_layout_meta = new_cmb2_box( array(
		'id'            => $prefixpage . 'page_layout_section',
		'title'         => esc_html__( 'Page Layout', 'realar' ),
        'context' 		=> 'side',
        'priority' 		=> 'high',
        'object_types'  => array( 'page', ), // Post type
        'closed'        => true
	) );

	$realar_layout_meta->add_field( array(
		'desc'       => esc_html__( 'Set page layout container,container fluid,fullwidth or both. It\'s work only in template builder page.', 'realar' ),
		'id'         => $prefix . 'custom_page_layout',
		'type'       => 'radio',
        'options' => array(
            '1' => esc_html__( 'Container', 'realar' ),
            '2' => esc_html__( 'Container Fluid', 'realar' ),
            '3' => esc_html__( 'Fullwidth', 'realar' ),
        ),
	) );

	// code for body class//

    $realar_layout_meta->add_field( array(
    	'name' => esc_html__( 'Insert Your Body Class', 'realar' ),
    	'id'   => $prefix . 'custom_body_class',
    	'type' => 'text'
    ) );


    $realar_extra_listing_meta = new_cmb2_box( array(
        'id'            => $prefixpage . 'listingmeta_section',
        'title'         => esc_html__( 'Additional Informations', 'realar' ),
        'object_types'  => array( 'at_biz_dir' ), // Post type
        'closed'        => true,
        'context'       => 'side',
        'priority'      => 'default'
    ) );

    $realar_extra_listing_meta->add_field( array(
        'name' => esc_html__( 'Address', 'realar' ),
        'id'   => $prefix . 'realar_address',
        'type' => 'text'
    ) );
    $realar_extra_listing_meta->add_field( array(
        'name' => esc_html__( 'Short Description', 'realar' ),
        'id'   => $prefix . 'realar_short_description',
        'type' => 'textarea'
    ) );
    $realar_extra_listing_meta->add_field( array(
        'name' => esc_html__( 'Bad Room', 'realar' ),
        'id'   => $prefix . 'realar_bed_count',
        'type' => 'text'
    ) );
    $realar_extra_listing_meta->add_field( array(
        'name' => esc_html__( 'Bath Room', 'realar' ),
        'id'   => $prefix . 'realar_bath_count',
        'type' => 'text'
    ) );
    $realar_extra_listing_meta->add_field( array(
        'name' => esc_html__( 'Room Size', 'realar' ),
        'id'   => $prefix . 'realar_room_size',
        'type' => 'text'
    ) );

}

add_action( 'cmb2_admin_init', 'realar_register_taxonomy_metabox' );
/**
 * Hook in and add a metabox to add fields to taxonomy terms
 */
function realar_register_taxonomy_metabox() {

    $prefix = '_realar_';
	/**
	 * Metabox to add fields to categories and tags
	 */
	$realar_term_meta = new_cmb2_box( array(
		'id'               => $prefix.'term_edit',
		'title'            => esc_html__( 'Category Metabox', 'realar' ),
		'object_types'     => array( 'term' ),
		'taxonomies'       => array( 'category'),
	) );
	$realar_term_meta->add_field( array(
		'name'     => esc_html__( 'Extra Info', 'realar' ),
		'id'       => $prefix.'term_extra_info',
		'type'     => 'title',
		'on_front' => false,
	) );
	$realar_term_meta->add_field( array(
		'name' => esc_html__( 'Category Image', 'realar' ),
		'desc' => esc_html__( 'Set Category Image', 'realar' ),
		'id'   => $prefix.'term_avatar',
        'type' => 'file',
        'text'    => array(
			'add_upload_file_text' => esc_html__('Add Image','realar') // Change upload button text. Default: "Add or Upload File"
		),
	) );


	/**
	 * Metabox for the user profile screen
	 */
	$realar_user = new_cmb2_box( array(
		'id'               => $prefix.'user_edit',
		'title'            => esc_html__( 'User Profile Metabox', 'realar' ), // Doesn't output for user boxes
		'object_types'     => array( 'user' ), // Tells CMB2 to use user_meta as post_meta
		'show_names'       => true,
		'new_user_section' => 'add-new-user', // where form will show on new user page. 'add-existing-user' is only other valid option.
	) );
    $realar_user->add_field( array(
		'name' => esc_html__( 'Author Designation', 'realar' ),
		'desc' => esc_html__( 'Use This Field When Author Designation', 'realar' ),
		'id'   => $prefix . 'author_desig',
        'type' => 'text',
    ) );
	$realar_user->add_field( array(
		'name'     => esc_html__( 'Social Profile', 'realar' ),
		'id'       => $prefix.'user_extra_info',
		'type'     => 'title',
		'on_front' => false,
	) );

	$group_field_id = $realar_user->add_field( array(
        'id'          => $prefix .'social_profile_group',
        'type'        => 'group',
        'description' => __( 'Social Profile', 'realar' ),
        'options'     => array(
            'group_title'       => __( 'Social Profile {#}', 'realar' ), // since version 1.1.4, {#} gets replaced by row number
            'add_button'        => __( 'Add Another Social Profile', 'realar' ),
            'remove_button'     => __( 'Remove Social Profile', 'realar' ),
            'closed'         => true
        ),
    ) );

    $realar_user->add_group_field( $group_field_id, array(
        'name'        => __( 'Icon Class', 'realar' ),
        'id'          => $prefix .'social_profile_icon',
        'type'        => 'text', // This field type
    ) );

    $realar_user->add_group_field( $group_field_id, array(
        'desc'       => esc_html__( 'Set social profile link.', 'realar' ),
        'id'         => $prefix . 'lawyer_social_profile_link',
        'name'       => esc_html__( 'Social Profile link', 'realar' ),
        'type'       => 'text'
    ) );
}
