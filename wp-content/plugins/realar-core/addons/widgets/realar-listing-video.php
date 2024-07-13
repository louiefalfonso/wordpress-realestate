<?php

use \Elementor\Widget_Base;
use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Typography;
use \Elementor\Repeater;
use \Elementor\Utils;
use \Elementor\Group_Control_Border;
/**
 *
 * Gallery Widget .
 *
 */



class Realar_Listing_Video extends Widget_Base {

	public function get_name() {
		return 'realarlistingvideo';
	}
	public function get_title() {
		return __( 'Realer Listing Video', 'realar' );
	}
	public function get_icon() {
		return 'th-icon';
    }
	public function get_categories() {
		return [ 'realar_listing' ];
	}

	protected function register_controls() {

		$this->start_controls_section(
			'counter_section',
			[
				'label' 	=> __( 'Video', 'realar' ),
				'tab' 		=> Controls_Manager::TAB_CONTENT,
			]
        ); 
		realar_select_field( $this, 'layout_style', 'Layout Style',['Style One'] );
		realar_general_fields($this, 'title', 'Title', 'TEXT', 'Empowering Visions', ['1'] );
		realar_general_fields($this, 'url', 'Video Url', 'TEXT', '#', ['1'] );
		realar_media_fields( $this, 'thumb', 'Video Thumb', ['1'] );
		

		$this->end_controls_section();

		realar_common2_style_fields( $this, 'title', 'Title', '{{WRAPPER}} h3', [ '2' ] );


	}

	protected function render() {

	$settings = $this->get_settings_for_display();



		if( $settings['layout_style'] == '1' ){

			if(!empty($settings['title'])){
				echo '<h3 class="page-title mt-50 mb-30">'.esc_html( $settings['title'] ).'</h3>';
			}
            echo '<div class="video-box2 mb-30">';
            	if(!empty($settings['thumb']['url'])){
	                echo realar_img_tag( array(
						'url'   => esc_url( $settings['thumb']['url']),
					));
	            }
	            if(!empty($settings['url'])){
	                echo '<a href="'.esc_url( $settings['url'] ).'" class="play-btn style4 popup-video"><i class="fa-sharp fa-solid fa-play"></i></a>';
	            }
            echo '</div>';
		}
	}
}