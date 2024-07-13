<?php
/**
 * @Packge     : Realar
 * @Version    : 1.0
 * @Author     : Themeholy
 * @Author URI : https://themeforest.net/user/themeholy
 *
 */

// Block direct access
if (!defined('ABSPATH')) {
    exit;
}

if ( ! is_active_sidebar( 'realar-page-sidebar' ) ) {
    return;
}
?>

<div class="col-xxl-4 col-lg-5">
    <div class="page-sidebar">
    <?php 
        dynamic_sidebar( 'realar-page-sidebar' );
    ?>               
    </div>
</div>