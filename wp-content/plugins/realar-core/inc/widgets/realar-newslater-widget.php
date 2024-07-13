<?php
/**
 * @version  1.0
 * @package  realar
 * @author   Rasm <
 *
 *
 *
 */

/**************************************
*   Creating Newsletter Widget
***************************************/

class realar_newsletter_widget extends WP_Widget {
	function __construct() {
		parent::__construct(
    		// Base ID of your widget
    		'realar_newsletter_widget',
    		// Widget name will appear in UI
    		esc_html__( 'Realar :: Newsletter', 'realar' ),
    		// Widget description
    		array(
				'description' 	              => esc_html__( 'Add Newsletter', 'realar' ),
				'classname'		              => 'widget_newsletter widget newsletter-widget',
                'customize_selective_refresh' => true,
			)
		);
	}

// This is where the action happens
public function widget( $args, $instance ) {
	$title 			= apply_filters( 'widget_title', $instance['title'] );
	$placeholder 	= apply_filters( 'widget_placeholder', $instance['placeholder'] );



	// before and after widget arguments are defined by themes
	echo $args['before_widget'];
    if( !empty( $title  ) ){
        echo '<h3 class="widget_title">'.esc_html( $title ).'</h3>';
    }
    echo '<form class="newsletter-form ">';
        echo '<div class="form-group">';
            echo '<input class="form-control" type="email" placeholder="'.esc_attr( $placeholder ).'" required="">';
            echo '<button type="submit" class="th-btn"><i class="far fa-paper-plane text-theme"></i></button>';
        echo '</div>';
    echo '</form>';
    echo '<div class="th-social style2">';
        echo realar_social_icon();
    echo '</div>';


    echo $args['after_widget'];
}

// Widget Backend
public function form( $instance ) {
	//Title
	if ( isset( $instance[ 'title' ] ) ) {
		$title = $instance[ 'title' ];
	}else {
		$title = esc_html__( 'Subscribe Us', 'realar' );
	}

	// Placeholder Text
	if ( isset( $instance[ 'placeholder' ] ) ) {
		$placeholder = $instance[ 'placeholder' ];
	}else{
		$placeholder = __( 'Your Email Address', 'realar' );
	}

// Widget admin form
	?>
	<p>
		<label for="<?php echo $this->get_field_id( 'title' ); ?>">
			<?php
				_e( 'Title:' ,'realar');
			?>
		</label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
	</p>
	<p>
		<label for="<?php echo $this->get_field_id( 'placeholder' ); ?>">
			<?php
				_e( 'Placeholder:' ,'realar' );
			?>
		</label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'placeholder' ); ?>" name="<?php echo $this->get_field_name( 'placeholder' ); ?>" type="text" value="<?php echo esc_attr( $placeholder ); ?>" />
	</p>
<?php
	}
// Updating widget replacing old instances with new
public function update( $new_instance, $old_instance ) {
    	$instance 					= array();
    	$instance['title'] 			= ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
    	$instance['placeholder']  	= ( ! empty( $new_instance['placeholder'] ) ) ? strip_tags( $new_instance['placeholder'] ) : '';

    	return $instance;
	}
} // Class realar_subscribe_widget ends here


// Register and load the widget
function realar_newsletter_load_widget() {
	register_widget( 'realar_newsletter_widget' );
}
add_action( 'widgets_init', 'realar_newsletter_load_widget' );