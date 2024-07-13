<!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <?php wp_head();?>
</head>
<body <?php body_class(); ?>>

<?php

    wp_body_open();

    echo '<div class="cursor-follower"></div><div class="slider-drag-cursor"><i class="fas fa-angle-left me-2"></i> '.esc_html__(' DRAG ','realar').' <i class="fas fa-angle-right ms-2"></i></div>';

    /**
    *
    * Preloader
    *
    * Hook realar_preloader_wrap
    *
    * @Hooked realar_preloader_wrap_cb 10
    *
    */
    do_action( 'realar_preloader_wrap' );

    if( !is_404()) {

        /**
        *
        * realar header
        *
        * Hook realar_header
        *
        * @Hooked realar_header_cb 10
        *
        */
        do_action( 'realar_header' );
    }