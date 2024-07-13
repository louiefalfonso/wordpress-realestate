<?php
/**
* @version  1.0
* @package  realar
* @author   Themeholy <themeholy@gmail.com>
*
* Websites: https://themeholy.com/
*
*/

/**************************************
* Creating Offer Banner Widget
***************************************/

class realar_offer_banner_widget extends WP_Widget {

        function __construct() {

            parent::__construct(
                // Base ID of your widget
                'realar_offer_banner_widget',

                // Widget name will appear in UI
                esc_html__( 'Realar :: Offer Banner Widget', 'realar' ),

                // Widget description
                array(
                    'customize_selective_refresh'   => true,
                    'description'                   => esc_html__( 'Add Offer Banner Widget', 'realar' ),
                    'classname'                     => 'no-banner-widget',
                )
            );

        }

        // This is where the action happens
        public function widget( $args, $instance ) {
            $banner_title   = apply_filters( 'widget_banner_title', $instance['banner_title'] );
            $banner_desc   = apply_filters( 'widget_banner_desc', $instance['banner_desc'] );
            $banner_phone   = apply_filters( 'widget_banner_phone', $instance['banner_phone'] );
            $button_text   = apply_filters( 'widget_button_text', $instance['button_text'] );

            $replace_phoone        = array(' ','-',' - ', '(', ')');
            $with           = array('','','');
            
		    $phoneurl       = str_replace( $replace_phoone, $with, $banner_phone );

            if ( isset( $instance[ 'banner_img_url' ] ) ) {
                $banner_img_url = $instance[ 'banner_img_url' ];
            }   
            
            if ( isset( $instance[ 'banner_img_url2' ] ) ) {
                $banner_img_url2 = $instance[ 'banner_img_url2' ];
            }

            if ( isset( $instance[ 'button_url' ] ) ) {
                $button_url = $instance[ 'button_url' ];
            }else {
                $button_url = '#';
            }

        	echo $args['before_widget'];
        	?>
            <div class="widget widget_offer  " data-bg-src="<?php echo esc_url($banner_img_url ); ?>">
                <div class="offer-banner">
                    <h5 class="banner-title"><?php echo esc_html( $banner_title ); ?></h5>
                    <div class="banner-logo">
                        <?php 
                        if(!empty($banner_img_url2)){
                            echo realar_img_tag( array(
                                'url'   => esc_url($banner_img_url2),
                            )); 
                        }
                        ?>
                    </div>
                    <div class="offer">
                        <h6 class="offer-title"><?php echo esc_html( $banner_desc ); ?></h6>
                        <a class="offter-num" href="<?php echo esc_attr('tel:' . $phoneurl); ?>"><?php echo esc_html( $banner_phone ); ?></a>
                    </div>
                    <?php if(!empty($button_text)): ?>
                    <a href="<?php echo esc_url( $button_url ); ?>" class="th-btn style3"><?php echo esc_html( $button_text ); ?><i class="fa-regular fa-arrow-right"></i></a>
                    <?php endif; ?>
                </div>
            </div>

        	<?php
           echo $args['after_widget'];
        }

        // Widget Backend
        public function form( $instance ) {

             //Image Url
            if ( isset( $instance[ 'banner_img_url' ] ) ) {
                $banner_img_url = $instance[ 'banner_img_url' ];
            }else {
                $banner_img_url = '';
            }

            //Logo Url
            if ( isset( $instance[ 'banner_img_url2' ] ) ) {
                $banner_img_url2 = $instance[ 'banner_img_url2' ];
            }else {
                $banner_img_url2 = '';
            }

            if ( isset( $instance[ 'banner_title' ] ) ) {
                $banner_title = $instance[ 'banner_title' ];
            }else {
                $banner_title = '';
            }    

            if ( isset( $instance[ 'banner_desc' ] ) ) {
                $banner_desc = $instance[ 'banner_desc' ];
            }else {
                $banner_desc = '';
            } 

            if ( isset( $instance[ 'banner_phone' ] ) ) {
                $banner_phone = $instance[ 'banner_phone' ];
            }else {
                $banner_phone = '';
            } 

            if ( isset( $instance[ 'button_text' ] ) ) {
                $button_text = $instance[ 'button_text' ];
            }else {
                $button_text = '';
            }            

            if ( isset( $instance[ 'button_url' ] ) ) {
                $button_url = $instance[ 'button_url' ];
            }else {
                $button_url = '';
            }

        	?>
            <p>
                <label for="<?php echo $this->get_field_id( 'banner_img_url' ); ?>"><?php _e( 'Image URL:' ,'realar'); ?></label>
                <input class="widefat" id="<?php echo $this->get_field_id( 'banner_img_url' ); ?>" name="<?php echo $this->get_field_name( 'banner_img_url' ); ?>" type="text" value="<?php echo esc_attr( $banner_img_url ); ?>" />
            </p>
            <p>
                <label for="<?php echo $this->get_field_id( 'banner_img_url2' ); ?>"><?php _e( 'Logo URL:' ,'realar'); ?></label>
                <input class="widefat" id="<?php echo $this->get_field_id( 'banner_img_url2' ); ?>" name="<?php echo $this->get_field_name( 'banner_img_url2' ); ?>" type="text" value="<?php echo esc_attr( $banner_img_url2 ); ?>" />
            </p>
            <p>
                <label for="<?php echo $this->get_field_id( 'banner_title' ); ?>"><?php _e( 'Banner Title:' ,'realar'); ?></label>
                <textarea class="widefat" id="<?php echo $this->get_field_id( 'banner_title' ); ?>" name="<?php echo $this->get_field_name( 'banner_title' ); ?>" rows="2" cols="80"><?php echo esc_html( $banner_title ); ?></textarea>
            </p>
            <p>
                <label for="<?php echo $this->get_field_id( 'banner_desc' ); ?>"><?php _e( 'Banner Description:' ,'realar'); ?></label>
                <textarea class="widefat" id="<?php echo $this->get_field_id( 'banner_desc' ); ?>" name="<?php echo $this->get_field_name( 'banner_desc' ); ?>" rows="2" cols="80"><?php echo esc_html( $banner_desc ); ?></textarea>
            </p>
            <p>
                <label for="<?php echo $this->get_field_id( 'banner_phone' ); ?>"><?php _e( 'Phone Number:' ,'realar'); ?></label>
                <textarea class="widefat" id="<?php echo $this->get_field_id( 'banner_phone' ); ?>" name="<?php echo $this->get_field_name( 'banner_phone' ); ?>" rows="2" cols="80"><?php echo esc_html( $banner_phone ); ?></textarea>
            </p>
            <p>
                <label for="<?php echo $this->get_field_id( 'button_text' ); ?>"><?php _e( 'Button Text:' ,'realar'); ?></label>
                <input class="widefat" id="<?php echo $this->get_field_id( 'button_text' ); ?>" name="<?php echo $this->get_field_name( 'button_text' ); ?>" type="text" value="<?php echo esc_attr( $button_text ); ?>" />
            </p>
            <p>
                <label for="<?php echo $this->get_field_id( 'button_url' ); ?>"><?php _e( 'Button URL:' ,'realar'); ?></label>
                <input class="widefat" id="<?php echo $this->get_field_id( 'button_url' ); ?>" name="<?php echo $this->get_field_name( 'button_url' ); ?>" type="text" value="<?php echo esc_attr( $button_url ); ?>" />
            </p>

        	<?php
           
        }


         // Updating widget replacing old instances with new
         public function update( $new_instance, $old_instance ) {
                $instance = array();
                $instance['banner_img_url']    = ( ! empty( $new_instance['banner_img_url'] ) ) ? strip_tags( $new_instance['banner_img_url'] ) : '';
                $instance['banner_img_url2']    = ( ! empty( $new_instance['banner_img_url2'] ) ) ? strip_tags( $new_instance['banner_img_url2'] ) : '';
                $instance['banner_title']       = ( ! empty( $new_instance['banner_title'] ) ) ? strip_tags( $new_instance['banner_title'] ) : '';   
                $instance['banner_desc']       = ( ! empty( $new_instance['banner_desc'] ) ) ? strip_tags( $new_instance['banner_desc'] ) : ''; 
                $instance['banner_phone']       = ( ! empty( $new_instance['banner_phone'] ) ) ? strip_tags( $new_instance['banner_phone'] ) : ''; 
                $instance['button_text']      = ( ! empty( $new_instance['button_text'] ) ) ? strip_tags( $new_instance['button_text'] ) : '';  
                $instance['button_url']     = ( ! empty( $new_instance['button_url'] ) ) ? strip_tags( $new_instance['button_url'] ) : '';
                return $instance;
           
        }

    } // Class realar_offer_banner_widget ends here


    // Register and load the widget
    function realar_offer_banner_load_widget() {
        register_widget( 'realar_offer_banner_widget' );
    }
    add_action( 'widgets_init', 'realar_offer_banner_load_widget' );