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
    exit;
}

if ( ! is_active_sidebar( 'realar-blog-sidebar' ) ) {
    return;
}

echo '<div class="col-xxl-4 col-lg-5">';
    echo '<aside class="sidebar-area">';
        dynamic_sidebar( 'realar-blog-sidebar' );
    echo '</aside>';
echo '</div>';