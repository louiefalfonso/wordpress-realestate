<?php
use \Elementor\Widget_Base;
use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Typography;
use \Elementor\Utils;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Group_Control_Box_Shadow;
use \Elementor\Group_Control_Border;
use \Elementor\Repeater;
/**
 *
 * features Widget .
 *
 */
class Realar_Listing_Features extends Widget_Base {

	public function get_name() {
		return 'realarlisitngfeatures';
	}
	public function get_title() {
		return __( 'Single Listing Features', 'realar' );
	}
	public function get_icon() {
		return 'th-icon';
    }
	public function get_categories() {
		return [ 'realar_listing' ];
	}

	protected function register_controls() {

		$this->start_controls_section(
			'arrow_section',
			[
				'label'     => __( 'Features', 'realar' ),
				'tab'       => Controls_Manager::TAB_CONTENT,
			]
        );

		realar_select_field( $this, 'layout_style', 'Layout Style',[ 'Style One' ] );
		realar_general_fields($this, 'title', 'Title', 'TEXT', 'Empowering Visions', ['1'] );



		// Layout Style 5
		$fields_to_include3 = [ 'image' => ['Choose Image'], 'title' => ['Label', 'Value'] ];
		realar_repeater_fields( $this, 'feature_lists', 'Features List', $fields_to_include3, [ '1' ] );

        $this->end_controls_section();



		// //-------Title Style-------
		realar_common2_style_fields( $this, 'title', 'Title', '{{WRAPPER}} h2', [ '1' ] );


	}

	protected function render() {

    $settings = $this->get_settings_for_display(); 

		if( $settings['layout_style'] == '1' ){

			if(!empty($settings['title'])){
				echo '<h2 class="page-title mb-20">'.wp_kses_post($settings['title']).'</h2>';
			}
            echo '<ul class="property-grid-list">';

                foreach( $settings['feature_lists'] as $data ){
	                echo '<li>';
	                	if(!empty($data['choose_image']['url'])){
							echo '<div class="property-grid-list-icon">';
								echo realar_img_tag( array(
									'url'   => esc_url( $data['choose_image']['url'] ),
								));
							echo '</div>';
						}
	                    echo '<div class="property-grid-list-details">';
	                    	if(!empty($data['label'])){
		                        echo '<h4 class="property-grid-list-title">'.esc_html($data['label']).'</h4>';
		                    }
		                    if(!empty($data['value'])){
		                        echo '<p class="property-grid-list-text">'.esc_html($data['value']).'</p>';
		                    }
	                    echo '</div>';
	                echo '</li>';
	            }
            echo '</ul>';
		}		
	}
}