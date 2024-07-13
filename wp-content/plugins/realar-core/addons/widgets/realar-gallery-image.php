<?php
use \Elementor\Widget_Base;
use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Typography;
use \Elementor\Utils;
use \Elementor\Repeater;
use \Elementor\Group_Control_Border;
/**
 *
 * Brand Logo Widget .
 *
 */
class realar_Slider_Image extends Widget_Base {

	public function get_name() {
		return 'realarsliderimage';
	}
	public function get_title() {
		return __( 'Realar Slider Image', 'realar' );
	}
	public function get_icon() {
		return 'th-icon';
    }
	public function get_categories() {
		return [ 'realar' ];
	}

	protected function register_controls() {

		$this->start_controls_section(
			'client_logo_section',
			[
				'label' 	=> __( 'Slider Image', 'realar' ),
				'tab' 		=> Controls_Manager::TAB_CONTENT,
			]
        );

		realar_select_field( $this, 'layout_style', 'Layout Style', [ 'Style One','Style Two','Style Three'] );

		realar_general_fields( $this, 'title', 'Curve Text', 'TEXT', 'Title', [ '1','2','3' ] );
		realar_general_fields( $this, 'subtitle', 'Subtitle', 'TEXT', 'Subtitle', [ '3' ] );
		realar_general_fields( $this, 'desc', 'Description', 'TEXT', 'Description', [ '3' ] );

		realar_general_fields( $this, 'url', 'Video Url', 'TEXT', '#', [ '1' ] );


		$fields_to_include = [ 'image' => ['Slider Image'] ];
		realar_repeater_fields( $this, 'logos', 'Slider Images', $fields_to_include, ['1','2'] );


		$fields_to_include2 = [ 'image' => ['Slider Image'] ,'title' => ['Class']];
		realar_repeater_fields( $this, 'logos2', 'Slider Images', $fields_to_include2, ['2','3'] );

		realar_general_fields($this, 'button_text', 'Button Text', 'TEXT', 'Button Text', [ '2','3' ]);
		realar_url_fields($this, 'button_url', 'Button URL', [ '2','3' ]);

		realar_general_fields($this, 'button_text2', 'Button Text 2', 'TEXT', 'Button Text', [ '3' ]);
		realar_url_fields($this, 'button_url2', 'Button URL 2', [ '3' ]);

        $this->end_controls_section();

		//---------------------------------------
			//Style Section Start
		//---------------------------------------

		realar_button_style_fields($this, '11', 'Button Styling', '{{WRAPPER}} .th-btn', ['2']);


	}

	protected function render() {

	$settings = $this->get_settings_for_display();

		if( $settings['layout_style'] == '1' ){
			echo '<div class="img-box2">';
                echo '<div class="slider-area">';
                    echo '<div class="swiper th-slider about-thumb-slider" id="aboutSlider1" data-slider-options=\'{"breakpoints":{"0":{"slidesPerView":1},"576":{"slidesPerView":"1"},"768":{"slidesPerView":"1","effect":"fade"},"992":{"slidesPerView":"3"},"1200":{"slidesPerView":"3"}},"effect":"coverflow","coverflowEffect":{"rotate":"0","stretch":"350","depth":"215","modifier":"1"},"centeredSlides":"true"}\'>';
                        echo '<div class="swiper-wrapper">';

                            foreach( $settings['logos'] as $data ){
	                            echo '<div class="swiper-slide">';
	                                echo '<div class="img1">';
	                                    echo realar_img_tag( array(
											'url'   => esc_url( $data['slider_image']['url'] ),
										) );
	                                echo '</div>';
	                            echo '</div>';
	                        }
                        echo '</div>';
                    echo '</div>';
                    echo '<button data-slider-next="#aboutSlider1" class="slider-arrow slider-next"><img src="'.REALAR_PLUGDIRURI . 'assets/img/arrow-right.svg" alt="icon"></button>';
                echo '</div>';
                echo '<div class="about-tag">';
                	if(!empty($settings['title'])){
	                    echo '<div class="about-experience-tag">';
	                        echo '<span class="circle-title-anime">'.esc_html($settings['title']).'</span>';
	                    echo '</div>';
	                }
	                if(!empty($settings['url'])){
	                    echo '<a href="'.esc_url($settings['url']).'" class="play-btn popup-video"><i class="fa-sharp fa-solid fa-play"></i></a>';
	                }
                echo '</div>';
            echo '</div>';
		}elseif( $settings['layout_style'] == '2' ){
			echo '<div class="gallery-wrap1">';
                echo '<div class="row justify-content-center">';

                    echo '<div class="col-lg-6 col-md-8 order-md-2">';
                        echo '<div class="title-area mb-md-0 text-center">';
                        	if(!empty($settings['title'])){
	                            echo '<h2 class="sec-title">'.esc_html($settings['title']).'</h2>';
	                        }
	                        if( ! empty( $settings['button_text'] ) ) {
	                            echo '<div class="btn-wrap mt-4 justify-content-center">';
	                                echo '<a href="'.esc_url( $settings['button_url']['url'] ).'" class="th-btn mb-0 style2 th-btn-icon">'.esc_html( $settings['button_text'] ).'</a>';
	                            echo '</div>';
	                        }
                        echo '</div>';
                    echo '</div>';
                    echo '<div class="col-12 order-md-1">';
                        echo '<ul class="gallery-list-1">';
                        	foreach( $settings['logos'] as $data ){
	                            echo '<li class="gallery-card">';
	                                echo '<a class="popup-image" href="'.esc_url( $data['slider_image']['url'] ).'">';
	                                    echo realar_img_tag( array(
											'url'   => esc_url( $data['slider_image']['url'] ),
										) );
	                                    echo '<i class="fal fa-plus"></i>';
	                                echo '</a>';
	                            echo '</li>';
	                        }
                            
                        echo '</ul>';
                    echo '</div>';
                    echo '<div class="col-12 order-md-3">';
                        echo '<ul class="gallery-list-2">';
                            
                            foreach( $settings['logos2'] as $data ){
	                            echo '<li class="gallery-card">';
	                                echo '<a class="popup-image" href="'.esc_url( $data['slider_image']['url'] ).'">';
	                                    echo realar_img_tag( array(
											'url'   => esc_url( $data['slider_image']['url'] ),
										) );
	                                    echo '<i class="fal fa-plus"></i>';
	                                echo '</a>';
	                            echo '</li>';
	                        }
                            

                        echo '</ul>';
                    echo '</div>';
                echo '</div>';
            echo '</div>';
		}else{
			echo '<div class="container">';
	            echo '<div class="row align-items-center justify-content-center">';
	                echo '<div class="col-xl-5">';
	                    echo '<div class="title-area text-center">';
	                    	if(!empty($settings['title'])){
		                        echo '<span class="sub-title text-white">'.esc_html($settings['title']).'</span>';
		                    }
		                    if(!empty($settings['subtitle'])){
		                        echo '<h2 class="sec-title text-white">'.esc_html($settings['subtitle']).'</h2>';
		                    }
		                    if(!empty($settings['desc'])){
		                        echo '<p class="text-light">'.esc_html($settings['desc']).'</p>';
		                    }
	                        echo '<div class="btn-wrap justify-content-center">';
	                        	if( ! empty( $settings['button_text'] ) ) {
		                            echo '<a href="'.esc_url( $settings['button_url']['url'] ).'" class="th-btn mb-0 style-white2 th-btn-icon">'.esc_html( $settings['button_text'] ).'</a>';
		                        }
		                        if( ! empty( $settings['button_text2'] ) ) {
		                            echo '<a href="'.esc_url( $settings['button_url2']['url'] ).'" class="th-btn mb-0 style-border3 th-btn-icon">'.esc_html( $settings['button_text2'] ).'</a>';
		                        }
	                        echo '</div>';
	                    echo '</div>';
	                echo '</div>';
	            echo '</div>';
	        echo '</div>';
	        echo '<div class="container th-container2">';
	            echo '<ul class="about-3-thumb-list">';
	            	foreach( $settings['logos2'] as $data ){
	            		$class = $data['class'] ? $data['class'] : '';
		                echo '<li class="gallery-card">';
		                    echo '<a class="popup-image '.esc_attr( $class ).'" href="'.esc_url( $data['slider_image']['url'] ).'">';
		                        echo realar_img_tag( array(
									'url'   => esc_url( $data['slider_image']['url'] ),
								) );
		                        echo '<i class="fal fa-plus"></i>';
		                    echo '</a>';
		                echo '</li>';
		            }
	            echo '</ul>';
	        echo '</div>';
		}
	}
}