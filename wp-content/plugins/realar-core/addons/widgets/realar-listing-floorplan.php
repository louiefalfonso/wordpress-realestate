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
class Realar_Listing_FloorPlan extends Widget_Base {

	public function get_name() {
		return 'realarlisitngfloorplan';
	}
	public function get_title() {
		return __( 'Single Listing Floor Tab', 'realar' );
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
				'label'     => __( 'Floor Tab', 'realar' ),
				'tab'       => Controls_Manager::TAB_CONTENT,
			]
        );

		realar_select_field( $this, 'layout_style', 'Layout Style',[ 'Style One' ] );
		realar_general_fields($this, 'title', 'Title', 'TEXT', 'Empowering Visions', ['1'] );



		// Layout Style 5
		$fields_to_include3 = [ 'image' => ['Choose Image'], 'title' => ['Label'], 'desc' => ['Content Area'], ];
		realar_repeater_fields( $this, 'feature_lists', 'Features List', $fields_to_include3, [ '1' ] );

        $this->end_controls_section();





        realar_common2_style_fields( $this, 'title', 'Heading', '{{WRAPPER}} h3', [ '1' ] );
        realar_common2_style_fields( $this, 'title2', 'Title', '{{WRAPPER}} h4', [ '1' ] );
        realar_common2_style_fields( $this, 'title3', 'Description', '{{WRAPPER}} p', [ '1' ] );

  //       //---------------------------------------
		// 	//Style Section Start
		// //---------------------------------------
		// //-------Subtitle Style-------
		// realar_common_style_fields( $this, 'subtitle', 'Subtitle', '{{WRAPPER}} .sub-title', '','--theme-color', [ '5' ] );
		// //-------Title Style-------
		// realar_common_style_fields( $this, 'title3', 'Title', '{{WRAPPER}} .sec-title', [ '5' ] );

		// //-------Title Style-------
		// realar_common2_style_fields( $this, 'title', 'Title', '{{WRAPPER}} .title a', [ '1' ] );
		// realar_common_style_fields( $this, 'date', 'Date', '{{WRAPPER}} .history-item-date', [ '5' ] );
		// realar_common_style_fields( $this, 'title2', 'Title', '{{WRAPPER}} .title', [ '2', '3', '4', '5' ] );
		// //-------Description Style-------
		// realar_common_style_fields( $this, 'desc', 'Description', '{{WRAPPER}} .text', [ '1', '2', '3', '4', '5' ] );

	}

	protected function render() {

    $settings = $this->get_settings_for_display(); 

		if( $settings['layout_style'] == '1' ){

			echo '<div class="row align-items-center justify-content-between">';
				if( !empty( $settings['title'] ) ){
	                echo '<div class="col-lg-auto">';
	                    echo '<h3 class="page-title mt-50 mb-30">'.esc_html( $settings['title'] ).'</h3>';
	                echo '</div>';
	            }

                echo '<div class="col-lg-auto">';
                    echo '<ul class="nav nav-tabs property-tab mt-50" role="tablist">';
                    	$i = 0;
                        foreach( $settings['feature_lists'] as $data ){
                        	$i++;

                        	$active_class = $i == 1 ? ' active' : '';
                        	$aria_selected = $i == 1 ? ' true' : 'false';

                        	if( !empty( $data['label'] ) ){
		                        echo '<li class="nav-item" role="presentation">';
		                            echo '<button class="nav-link '.esc_attr( $active_class ).'" id="floor-tab'.esc_attr( $i ).'" data-bs-toggle="tab" data-bs-target="#floor-tab'.esc_attr( $i ).'-pane" type="button" role="tab" aria-controls="floor-tab'.esc_attr( $i ).'-pane" aria-selected="'.esc_attr( $aria_selected ).'">'.esc_html( $data['label'] ).'</button>';
		                        echo '</li>';
		                    }
	                    }
                    echo '</ul>';
                echo '</div>';
            echo '</div>';
            echo '<div class="tab-content">';
            	$i = 0;
                foreach( $settings['feature_lists'] as $data ){
                	$i++;

                	$active_class = $i == 1 ? ' show active' : '';


	                echo '<div class="tab-pane fade '.esc_attr( $active_class ).'" id="floor-tab'.esc_attr( $i ).'-pane" role="tabpanel" aria-labelledby="floor-tab'.esc_attr( $i ).'" tabindex="0">';
	                    echo '<div class="property-grid-plan">';
	                    	if(!empty($data['choose_image']['url'])){
		                        echo '<div class="property-grid-thumb">';
		                            echo realar_img_tag( array(
										'url'   => esc_url( $data['choose_image']['url'] ),
									));
		                        echo '</div>';
		                    }
	                        echo '<div class="property-grid-details">';
	                        	if( !empty( $data['label'] ) ){
		                            echo '<h4 class="property-grid-title">'.esc_html( $data['label'] ).'</h4>';
		                        }
		                        if( !empty( $data['content_area'] ) ){
		                            echo '<p class="property-grid-text">'.esc_html( $data['content_area'] ).'</p>';
		                        }
	                        echo '</div>';
	                    echo '</div>';
	                echo '</div>';
	            }
            echo '</div>';
		}		
	}
}