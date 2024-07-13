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



class Realar_Listing_Gallery extends Widget_Base {

	public function get_name() {
		return 'realarlistinggallery';
	}
	public function get_title() {
		return __( 'Realer Listing Gallery', 'realar' );
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
				'label' 	=> __( 'Gallery', 'realar' ),
				'tab' 		=> Controls_Manager::TAB_CONTENT,
			]
        ); 
		realar_select_field( $this, 'layout_style', 'Layout Style',['Style One','Style Two'] );
		realar_general_fields($this, 'title', 'Title', 'TEXT', 'Empowering Visions', ['2'] );
		
		

		$this->add_control(
			'gallery',
			[
				'label' => esc_html__( 'Add Gallery Slider', 'realar' ),
				'type' => \Elementor\Controls_Manager::GALLERY,
				'default' => [],
			]
		);

		$this->end_controls_section();


		realar_common2_style_fields( $this, 'title', 'Title', '{{WRAPPER}} h3', [ '2' ] );
		//---------------------------------------
			//Style Section Start
		//---------------------------------------

		//-------Title Style-------
		

	}

	protected function render() {

	$settings = $this->get_settings_for_display();



		if( $settings['layout_style'] == '1' ){

			echo '<div class="slider-area property-slider1">';
                echo '<div class="swiper th-slider mb-4" id="propertySlider" data-slider-options=\'{"effect":"slide","loop":true,"thumbs":{"swiper":".property-thumb-slider"}}\'>';
                    echo '<div class="swiper-wrapper">';

                    	foreach ( $settings['gallery'] as $data ){
	                        echo '<div class="swiper-slide">';
	                            echo '<div class="property-slider-img">';
	                                echo realar_img_tag( array(
										'url'   => esc_url( $data['url'] ),
									));
	                            echo '</div>';
	                        echo '</div>';
	                    }
                    echo '</div>';
                echo '</div>';
                echo '<div class="swiper th-slider property-thumb-slider" data-slider-options=\'{"effect":"slide","loop":true,"breakpoints":{"0":{"slidesPerView":2},"576":{"slidesPerView":"2"},"768":{"slidesPerView":"3"},"992":{"slidesPerView":"3"},"1200":{"slidesPerView":"4"}}}\'>';
                    echo '<div class="swiper-wrapper">';

                        foreach ( $settings['gallery'] as $data ){
	                        echo '<div class="swiper-slide">';
	                            echo '<div class="property-slider-img">';
	                                echo realar_img_tag( array(
										'url'   => esc_url( $data['url'] ),
									));
	                            echo '</div>';
	                        echo '</div>';
	                    }
                    echo '</div>';
                echo '</div>';

                echo '<button data-slider-prev="#propertySlider" class="slider-arrow style3 slider-prev"><img src="'.REALAR_PLUGDIRURI . 'assets/img/arrow-left.svg" alt="icon"></button>';
                echo '<button data-slider-next="#propertySlider" class="slider-arrow style3 slider-next"><img src="'.REALAR_PLUGDIRURI . 'assets/img/arrow-right.svg" alt="icon"></button>';
            echo '</div>';

            

		}else{
			if(!empty($settings['title'])){
				echo '<h3 class="page-title mt-50 mb-30">'.esc_html( $settings['title'] ).'</h3>';
			}
                echo '<div class="row gy-4">';
                	$i = 0 ;
                    foreach ( $settings['gallery'] as $data ){
                    	$i++;

                    	if($i % 2 == 0) {
					        $xol = "7";
					    } else {
					        $xol = "5";
					    }
	                    echo '<div class="col-xl-'.esc_attr( $xol ).'">';
	                        echo '<div class="property-gallery-card">';
	                            echo '<div class="property-gallery-card-img">';
	                                echo '<img class="w-100" src="'.esc_url( $data['url'] ).'" alt="img">';
	                            echo '</div>';
	                            echo '<a class="icon-btn popup-image" href="'.esc_url( $data['url'] ).'"><i class="fal fa-magnifying-glass-plus"></i></a>';
	                        echo '</div>';
	                    echo '</div>';
	                }
                    
                echo '</div>';
		}
	}
}