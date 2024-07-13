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
    
    /**
    *
    * Hook for Footer Content
    *
    * Hook realar_footer_content
    *
    * @Hooked realar_footer_content_cb 10
    *
    */
    do_action( 'realar_footer_content' );


    /**
    *
    * Hook for Back to Top Button
    *
    * Hook realar_back_to_top
    *
    * @Hooked realar_back_to_top_cb 10
    *
    */
    do_action( 'realar_back_to_top' );

    /**
    *
    * realar grid lines
    *
    * Hook realar_grid_lines
    *
    * @Hooked realar_grid_lines_cb 10
    *
    */
    do_action( 'realar_grid_lines' );

    wp_footer();
    ?>
</body>
</html>