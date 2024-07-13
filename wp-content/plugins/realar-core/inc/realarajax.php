<?php
/**
 * @Packge     : Realar
 * @Version    : 1.0
 * @Author     : Themeholy
 * @Author URI : https://themeforest.net/user/themeholy
 *
 */


// Blocking direct access
if( ! defined( 'ABSPATH' ) ) {
    exit;
}

function realar_core_essential_scripts( ) {
    wp_enqueue_script('realar-ajax',REALAR_PLUGDIRURI.'assets/js/realar.ajax.js',array( 'jquery' ),'1.0',true);
    wp_localize_script(
    'realar-ajax',
    'realarajax',
        array(
            'action_url' => admin_url( 'admin-ajax.php' ),
            'nonce'	     => wp_create_nonce( 'realar-nonce' ),
        )
    );
}

add_action('wp_enqueue_scripts','realar_core_essential_scripts');


// realar Section subscribe ajax callback function
add_action( 'wp_ajax_realar_subscribe_ajax', 'realar_subscribe_ajax' );
add_action( 'wp_ajax_nopriv_realar_subscribe_ajax', 'realar_subscribe_ajax' );

function realar_subscribe_ajax( ){
  $apiKey = realar_opt('realar_subscribe_apikey');
  $listid = realar_opt('realar_subscribe_listid');
   if( ! wp_verify_nonce($_POST['security'], 'realar-nonce') ) {
    echo '<div class="alert alert-danger mt-2" role="alert">'.esc_html__('You are not allowed.', 'realar').'</div>';
   }else{
       if( !empty( $apiKey ) && !empty( $listid )  ){
           $MailChimp = new DrewM\MailChimp\MailChimp( $apiKey );

           $result = $MailChimp->post("lists/{$listid}/members",[
               'email_address'    => esc_attr( $_POST['sectsubscribe_email'] ),
               'status'           => 'subscribed',
           ]);

           if ($MailChimp->success()) {
               if( $result['status'] == 'subscribed' ){
                   echo '<div class="alert alert-success mt-2" role="alert">'.esc_html__('Thank you, you have been added to our mailing list.', 'realar').'</div>';
               }
           }elseif( $result['status'] == '400' ) {
               echo '<div class="alert alert-danger mt-2" role="alert">'.esc_html__('This Email address is already exists.', 'realar').'</div>';
           }else{
               echo '<div class="alert alert-danger mt-2" role="alert">'.esc_html__('Sorry something went wrong.', 'realar').'</div>';
           }
        }else{
           echo '<div class="alert alert-danger mt-2" role="alert">'.esc_html__('Apikey Or Listid Missing.', 'realar').'</div>';
        }
   }

   wp_die();

}

add_action('wp_ajax_realar_addtocart_notification','realar_addtocart_notification');
add_action('wp_ajax_nopriv_realar_addtocart_notification','realar_addtocart_notification');
function realar_addtocart_notification(){

    $_product = wc_get_product($_POST['prodid']);
    $response = [
        'img_url'   => esc_url( wp_get_attachment_image_src( $_product->get_image_id(),array('60','60'))[0] ),
        'title'     => wp_kses_post( $_product->get_title() )
    ];
    echo json_encode($response);

    wp_die();
}