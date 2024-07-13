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
* Creating Category List Widget
***************************************/

class realar_category_list_widget extends WP_Widget {

    function __construct() {

        parent::__construct(

            // Base ID of your widget
            'realar_category_list_widget',

            // Widget name will appear in UI
            esc_html__( 'Realar :: Category List', 'realar' ),

            // Widget description
            array(
                'classname'                     => 'widget widget_categories',
                'customize_selective_refresh'   => true,
                'description'                   => esc_html__( 'Add Category List Widget', 'realar' ),
            )
        );
    }

    // This is where the action happens
    public function widget( $args, $instance ) {

        $title  = apply_filters( 'widget_title', $instance['title'] );

        //before and after widget arguments are defined by themes
        echo $args['before_widget'];

        if( !empty( $title  ) ){
            echo '<h3 class="widget_title">'.esc_html( $title ).'</h3>';
        }

        if ( isset( $instance[ 'number' ] ) ) {
            $number = $instance[ 'number' ];
        }else {
            $number = '5';
        }

        $show_count = isset( $instance['show_count'] ) ? $instance['show_count'] : false;

        $categories = get_categories();

        $limit= $number;

        $counter = 0;

        echo '<ul>';
        foreach($categories as $category){
            if($counter<$limit){

                echo '<li>';
                echo '<a href="'.esc_url( get_category_link( $category->term_id ) ).'">'.esc_html($category->name).'';

                if ( $show_count ) {
                    echo '<span> (' . $category->count . ')</span>';
                }
                echo '</a>';
                echo '</li>';
            }
            $counter++; 
        }
        echo '</ul>';

        echo $args['after_widget'];
    }

    // Widget Backend
    public function form( $instance ) {

        //Title
        if ( isset( $instance[ 'title' ] ) ) {
            $title = $instance[ 'title' ];
        }else {
            $title = 'Categories';
        }

        //Number
        if ( isset( $instance[ 'number' ] ) ) {
            $number = $instance[ 'number' ];
        }else {
            $number = '5';
        }

        $show_count = isset( $instance['show_count'] ) ? $instance['show_count'] : false;

        // Widget admin form
        ?>
        <p>
            <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ,'realar'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id( 'number' ); ?>"><?php _e( 'Number of Category:' ,'realar'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" type="text" value="<?php echo esc_attr( $number ); ?>" />
        </p>
        <p>
            <input class="checkbox" type="checkbox" <?php checked( $show_count ); ?> id="<?php echo $this->get_field_id( 'show_count' ); ?>" name="<?php echo $this->get_field_name( 'show_count' ); ?>" />
            <label for="<?php echo $this->get_field_id( 'show_count' ); ?>"><?php _e( 'Display category count', 'realar' ); ?></label>
        </p>
        <?php
    }

    // Updating widget replacing old instances with new
    public function update( $new_instance, $old_instance ) {

        $instance = array();
        $instance['title']          = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
        $instance['number']         = ( ! empty( $new_instance['number'] ) ) ? strip_tags( $new_instance['number'] ) : '';
        $instance['show_count']     = isset( $new_instance['show_count'] ) ? (bool) $new_instance['show_count'] : false;

        return $instance;
    }
} // Class realar_category_list_widget ends here

// Register and load the widget
function realar_category_list_load_widget() {
    register_widget( 'realar_category_list_widget' );
}
add_action( 'widgets_init', 'realar_category_list_load_widget' );