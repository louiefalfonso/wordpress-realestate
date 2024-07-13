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
 * Include File
 *
 */

// Constants
require_once get_parent_theme_file_path() . '/inc/realar-constants.php';

//theme setup
require_once REALAR_DIR_PATH_INC . 'theme-setup.php';

//essential scripts
require_once REALAR_DIR_PATH_INC . 'essential-scripts.php';

// Woo Hooks
require_once REALAR_DIR_PATH_INC . 'woo-hooks/realar-woo-hooks.php';

// Woo Hooks Functions
require_once REALAR_DIR_PATH_INC . 'woo-hooks/realar-woo-hooks-functions.php';

// plugin activation
require_once REALAR_DIR_PATH_FRAM . 'plugins-activation/realar-active-plugins.php';

// theme dynamic css
require_once REALAR_DIR_PATH_INC . 'realar-commoncss.php';

// meta options
require_once REALAR_DIR_PATH_FRAM . 'realar-meta/realar-config.php';

// page breadcrumbs
require_once REALAR_DIR_PATH_INC . 'realar-breadcrumbs.php';

// sidebar register
require_once REALAR_DIR_PATH_INC . 'realar-widgets-reg.php';

//essential functions
require_once REALAR_DIR_PATH_INC . 'realar-functions.php';

// helper function
require_once REALAR_DIR_PATH_INC . 'wp-html-helper.php';

// Demo Data
require_once REALAR_DEMO_DIR_PATH . 'demo-import.php';

// pagination
require_once REALAR_DIR_PATH_INC . 'wp_bootstrap_pagination.php';

// realar options
require_once REALAR_DIR_PATH_FRAM . 'realar-options/realar-options.php';

// hooks
require_once REALAR_DIR_PATH_HOOKS . 'hooks.php';

// hooks funtion
require_once REALAR_DIR_PATH_HOOKS . 'hooks-functions.php'; 


add_action('wp_ajax_update_cart_count', 'update_cart_count');
add_action('wp_ajax_nopriv_update_cart_count', 'update_cart_count');

function update_cart_count() {
    if (class_exists('woocommerce')) {
        global $woocommerce;
        $product_id = intval($_POST['product_id']);
        $woocommerce->cart->add_to_cart($product_id); // Add the product to the cart

        $cart_count = $woocommerce->cart->cart_contents_count;
        echo esc_html($cart_count);
    }
    wp_die();
}
