<?php
use \Elementor\Widget_Base;
use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Typography;
use \Elementor\Utils;
use \Elementor\Repeater;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Group_Control_Box_Shadow;
/**
 *
 * Testimonial Slider Widget .
 *
 */
class realar_Testimonial extends Widget_Base{

	public function get_name() {
		return 'realartestimonialslider';
	}
	public function get_title() {
		return __( 'Testimonials', 'realar' );
	}
	public function get_icon() {
		return 'th-icon';
    }
	public function get_categories() {
		return [ 'realar' ];
	}

	protected function register_controls() {

		$this->start_controls_section(
			'testimonial_slider_section',
			[
				'label' 	=> __( 'Testimonial Slider', 'realar' ), 
				'tab' 		=> Controls_Manager::TAB_CONTENT,
			]
		);

		realar_select_field( $this, 'layout_style', 'Layout Style',[ 'Style One', 'Style Two', 'Style Three' ] );

		realar_media_fields( $this, 'image', 'Quote Image' );


		$repeater = new Repeater();

		realar_media_fields( $repeater, 'client_image', 'Client Image' );
		realar_general_fields( $repeater, 'client_name', 'Client Name', 'TEXT', 'Alex Michel' );
		realar_general_fields( $repeater, 'client_desig', 'Client Designation', 'TEXT', 'Ui/Ux Designer' );
		realar_general_fields( $repeater, 'client_feedback', 'Client Feedback', 'TEXTAREA', 'Our knowledgeable technicians are happy to provide tips' );

		realar_select_field( $repeater, 'client_rating', 'Client Rating', [ 'One Star', 'Two Star', 'Three Star', 'Four Star', 'Five Star' ] );

		$this->add_control(
			'slides',
			[
				'label' 		=> __( 'Slides', 'realar' ),
				'type' 			=> Controls_Manager::REPEATER,
				'fields' 		=> $repeater->get_controls(),
				'default' 		=> [
					[
						'client_image'	=> Utils::get_placeholder_image_src(),
					],
				],
				'title_field' 	=> '{{{ client_name }}}',
				'condition'		=> [ 
					'layout_style' => [ '1','3'],
				],
			]
		);

		$repeater = new Repeater();

		realar_media_fields( $repeater, 'client_image', 'Client Image' );
		realar_media_fields( $repeater, 'bg_image', 'Thumb Image' );
		realar_general_fields( $repeater, 'client_name', 'Client Name', 'TEXT', 'Alex Michel' );
		realar_general_fields( $repeater, 'client_desig', 'Client Designation', 'TEXT', 'Ui/Ux Designer' );
		realar_general_fields( $repeater, 'client_feedback', 'Client Feedback', 'TEXTAREA', 'Our knowledgeable technicians are happy to provide tips' );
		realar_select_field( $repeater, 'client_rating', 'Client Rating', [ 'One Star', 'Two Star', 'Three Star', 'Four Star', 'Five Star' ] );

		$this->add_control(
			'slides2',
			[
				'label' 		=> __( 'Slides', 'realar' ),
				'type' 			=> Controls_Manager::REPEATER,
				'fields' 		=> $repeater->get_controls(),
				'default' 		=> [
					[
						'client_image'	=> Utils::get_placeholder_image_src(),
					],
				],
				'title_field' 	=> '{{{ client_name }}}',
				'condition'		=> [ 
					'layout_style' => [ '2'],
				],
			]
		);
		realar_general_fields($this, 'arrow_id', 'Arrow ID or Class', 'TEXT', '#serviceSlider2',[ '2','3']);

		$this->end_controls_section();

        //---------------------------------------
			//Style Section Start
		//---------------------------------------
		
		//-------Name Style-------
		realar_common_style_fields( $this, 'title', 'Title', '{{WRAPPER}} .title', ['4'] );
		realar_common_style_fields( $this, 'name', 'Name', '{{WRAPPER}} .name' );
		//-------Designation Style-------
		realar_common_style_fields( $this, 'designation', 'Designation', '{{WRAPPER}} .desig' );
		//-------Feedback Style-------
		realar_common_style_fields( $this, 'feedback', 'Feedback', '{{WRAPPER}} .text' );
		
	}

	protected function render() {

		$settings = $this->get_settings_for_display();

		if( $settings['layout_style'] == '1' ){

			echo '<div class="swiper th-slider testi-slider1" id="testiSlider1" data-slider-options=\'{"breakpoints":{"0":{"slidesPerView":1},"576":{"slidesPerView":"1"},"768":{"slidesPerView":"1"},"992":{"slidesPerView":"1"},"1200":{"slidesPerView":"1"}}}\'>';
                echo '<div class="swiper-wrapper">';

                    foreach( $settings['slides'] as $data ){
	                    echo '<div class="swiper-slide">';
	                        echo '<div class="testi-card">';
	                            echo '<div class="testi-grid_review">';
	                            	if( $data['client_rating'] == '1' ){
										echo '<i class="fa-sharp fa-solid fa-star"></i>';
										echo '<i class="fa-sharp fa-regular fa-star"></i>';
										echo '<i class="fa-sharp fa-regular fa-star"></i>';
										echo '<i class="fa-sharp fa-regular fa-star"></i>';
										echo '<i class="fa-sharp fa-regular fa-star"></i>';
									}elseif( $data['client_rating'] == '2' ){
										echo '<i class="fa-sharp fa-solid fa-star"></i>';
										echo '<i class="fa-sharp fa-solid fa-star"></i>';
										echo '<i class="fa-sharp fa-regular fa-star"></i>';
										echo '<i class="fa-sharp fa-regular fa-star"></i>';
										echo '<i class="fa-sharp fa-regular fa-star"></i>';
									}elseif( $data['client_rating'] == '3' ){
										echo '<i class="fa-sharp fa-solid fa-star"></i>';
										echo '<i class="fa-sharp fa-solid fa-star"></i>';
										echo '<i class="fa-sharp fa-solid fa-star"></i>';
										echo '<i class="fa-sharp fa-regular fa-star"></i>';
										echo '<i class="fa-sharp fa-regular fa-star"></i>';
									}elseif( $data['client_rating'] == '4' ){
										echo '<i class="fa-sharp fa-solid fa-star"></i>';
										echo '<i class="fa-sharp fa-solid fa-star"></i>';
										echo '<i class="fa-sharp fa-solid fa-star"></i>';
										echo '<i class="fa-sharp fa-solid fa-star"></i>';
										echo '<i class="fa-sharp fa-regular fa-star"></i>';
									}else{
										echo '<i class="fa-sharp fa-solid fa-star"></i>';
										echo '<i class="fa-sharp fa-solid fa-star"></i>';
										echo '<i class="fa-sharp fa-solid fa-star"></i>';
										echo '<i class="fa-sharp fa-solid fa-star"></i>';
										echo '<i class="fa-sharp fa-solid fa-star"></i>';
									}
	                            echo '</div>';
	                            if(!empty($data['client_feedback'])){
		                            echo '<p class="testi-card_text text">'.esc_html( $data['client_feedback'] ).'</p>';
		                        }
	                            echo '<div class="testi-grid-wrap">';
	                                echo '<div class="testi-card_profile">';
	                                	if(!empty($data['client_image']['url'])){
		                                    echo '<div class="avatar" data-mask-src="'.REALAR_ASSETS.'/img/testi_1_1-mask.png">';
		                                        echo realar_img_tag( array(
													'url'	=> esc_url( $data['client_image']['url'] ),
												) );
		                                    echo '</div>';
		                                }
	                                    echo '<div class="testi-card_profile-details">';
	                                        if(!empty($data['client_name'])){
												echo '<h3 class="testi-card_name name">'.esc_html( $data['client_name'] ).'</h3>';
											}
											if(!empty($data['client_desig'])){
												echo '<span class="testi-card_desig desig">'.esc_html( $data['client_desig'] ).'</span>';
											}
	                                    echo '</div>';
	                                echo '</div>';
	                                if(!empty($settings['image']['url'])){
		                                echo '<div class="quote-icon">';
		                                    echo realar_img_tag( array(
												'url'	=> esc_url( $settings['image']['url'] ),
											) );
		                                echo '</div>';
		                            }
	                            echo '</div>';
	                        echo '</div>';
	                    echo '</div>';
	                }
                    

                echo '</div>';
                echo '<div class="slider-pagination style2"></div>';
            echo '</div>';

		}elseif( $settings['layout_style'] == '2' ){

			echo '<div class="container-fluid">';
                echo '<div class="testi-wrap2">';
                    echo '<div class="swiper th-slider testi-slider2" id="'.esc_attr($settings['arrow_id']).'" data-slider-options=\'{"spaceBetween":"48","breakpoints":{"0":{"slidesPerView":1},"576":{"slidesPerView":"1"},"768":{"slidesPerView":"1"},"992":{"slidesPerView":"1"},"1200":{"slidesPerView":"2"}}}\'>';
                        echo '<div class="swiper-wrapper">';
                            foreach( $settings['slides2'] as $data ){
	                            echo '<div class="swiper-slide">';
	                                echo '<div class="testi-grid-wrap2">';
	                                	if(!empty($data['bg_image']['url'])){
		                                    echo '<div class="testi-grid-thumb">';
		                                        echo realar_img_tag( array(
													'url'	=> esc_url( $data['bg_image']['url'] ),
												) );
		                                    echo '</div>';
		                                }
	                                    echo '<div class="testi-card style2">';
	                                        echo '<div class="testi-grid_review">';
	                                            if( $data['client_rating'] == '1' ){
													echo '<i class="fa-sharp fa-solid fa-star"></i>';
													echo '<i class="fa-sharp fa-regular fa-star"></i>';
													echo '<i class="fa-sharp fa-regular fa-star"></i>';
													echo '<i class="fa-sharp fa-regular fa-star"></i>';
													echo '<i class="fa-sharp fa-regular fa-star"></i>';
												}elseif( $data['client_rating'] == '2' ){
													echo '<i class="fa-sharp fa-solid fa-star"></i>';
													echo '<i class="fa-sharp fa-solid fa-star"></i>';
													echo '<i class="fa-sharp fa-regular fa-star"></i>';
													echo '<i class="fa-sharp fa-regular fa-star"></i>';
													echo '<i class="fa-sharp fa-regular fa-star"></i>';
												}elseif( $data['client_rating'] == '3' ){
													echo '<i class="fa-sharp fa-solid fa-star"></i>';
													echo '<i class="fa-sharp fa-solid fa-star"></i>';
													echo '<i class="fa-sharp fa-solid fa-star"></i>';
													echo '<i class="fa-sharp fa-regular fa-star"></i>';
													echo '<i class="fa-sharp fa-regular fa-star"></i>';
												}elseif( $data['client_rating'] == '4' ){
													echo '<i class="fa-sharp fa-solid fa-star"></i>';
													echo '<i class="fa-sharp fa-solid fa-star"></i>';
													echo '<i class="fa-sharp fa-solid fa-star"></i>';
													echo '<i class="fa-sharp fa-solid fa-star"></i>';
													echo '<i class="fa-sharp fa-regular fa-star"></i>';
												}else{
													echo '<i class="fa-sharp fa-solid fa-star"></i>';
													echo '<i class="fa-sharp fa-solid fa-star"></i>';
													echo '<i class="fa-sharp fa-solid fa-star"></i>';
													echo '<i class="fa-sharp fa-solid fa-star"></i>';
													echo '<i class="fa-sharp fa-solid fa-star"></i>';
												}
	                                        echo '</div>';
	                                        if(!empty($data['client_feedback'])){
												echo '<p class="testi-card_text text">'.esc_html( $data['client_feedback'] ).'</p>';
											}
	                                        echo '<p class="testi-card_text"></p>';
	                                        echo '<div class="testi-card_profile">';
	                                        	if(!empty($settings['image']['url'])){
		                                            echo '<div class="quote-icon">';
		                                                echo realar_img_tag( array(
															'url'	=> esc_url( $settings['image']['url'] ),
														) );
		                                            echo '</div>';
		                                        }
		                                        if(!empty($data['client_image']['url'])){
		                                            echo '<div class="avatar">';
		                                                echo realar_img_tag( array(
															'url'	=> esc_url( $data['client_image']['url'] ),
														) );
		                                            echo '</div>';
		                                        }
	                                            echo '<div class="testi-card_profile-details">';
		                                            if(!empty($data['client_name'])){
														echo '<h3 class="testi-card_name name">'.esc_html( $data['client_name'] ).'</h3>';
													}
													if(!empty($data['client_desig'])){
														echo '<span class="testi-card_desig desig">'.esc_html( $data['client_desig'] ).'</span>';
													}
	                                            echo '</div>';
	                                        echo '</div>';
	                                    echo '</div>';
	                                echo '</div>';
	                            echo '</div>';
	                        }
                        echo '</div>';
                    echo '</div>';
                echo '</div>';
            echo '</div>';
		}elseif( $settings['layout_style'] == '3' ){
			echo '<div class="container-fluid p-0">';
	            echo '<div class="swiper th-slider testi-slider3" id="'.esc_attr($settings['arrow_id']).'" data-slider-options=\'{"spaceBetween":"32","breakpoints":{"0":{"slidesPerView":1},"576":{"slidesPerView":"1"},"768":{"slidesPerView":"1"},"992":{"slidesPerView":"2"},"1200":{"slidesPerView":"2"},"1400":{"slidesPerView":"3"}},"centeredSlides": "true"}\'>';
	                echo '<div class="swiper-wrapper">';
	                    foreach( $settings['slides'] as $data ){
		                    echo '<div class="swiper-slide">';
		                        echo '<div class="testi-card style3">';
		                            if(!empty($data['client_feedback'])){
			                            echo '<p class="testi-card_text text">'.esc_html( $data['client_feedback'] ).'</p>';
			                        }
		                            echo '<div class="testi-grid_review">';
		                               	if( $data['client_rating'] == '1' ){
											echo '<i class="fa-sharp fa-solid fa-star"></i>';
											echo '<i class="fa-sharp fa-regular fa-star"></i>';
											echo '<i class="fa-sharp fa-regular fa-star"></i>';
											echo '<i class="fa-sharp fa-regular fa-star"></i>';
											echo '<i class="fa-sharp fa-regular fa-star"></i>';
										}elseif( $data['client_rating'] == '2' ){
											echo '<i class="fa-sharp fa-solid fa-star"></i>';
											echo '<i class="fa-sharp fa-solid fa-star"></i>';
											echo '<i class="fa-sharp fa-regular fa-star"></i>';
											echo '<i class="fa-sharp fa-regular fa-star"></i>';
											echo '<i class="fa-sharp fa-regular fa-star"></i>';
										}elseif( $data['client_rating'] == '3' ){
											echo '<i class="fa-sharp fa-solid fa-star"></i>';
											echo '<i class="fa-sharp fa-solid fa-star"></i>';
											echo '<i class="fa-sharp fa-solid fa-star"></i>';
											echo '<i class="fa-sharp fa-regular fa-star"></i>';
											echo '<i class="fa-sharp fa-regular fa-star"></i>';
										}elseif( $data['client_rating'] == '4' ){
											echo '<i class="fa-sharp fa-solid fa-star"></i>';
											echo '<i class="fa-sharp fa-solid fa-star"></i>';
											echo '<i class="fa-sharp fa-solid fa-star"></i>';
											echo '<i class="fa-sharp fa-solid fa-star"></i>';
											echo '<i class="fa-sharp fa-regular fa-star"></i>';
										}else{
											echo '<i class="fa-sharp fa-solid fa-star"></i>';
											echo '<i class="fa-sharp fa-solid fa-star"></i>';
											echo '<i class="fa-sharp fa-solid fa-star"></i>';
											echo '<i class="fa-sharp fa-solid fa-star"></i>';
											echo '<i class="fa-sharp fa-solid fa-star"></i>';
										}
		                            echo '</div>';
		                            echo '<div class="testi-card_profile">';
		                                if(!empty($settings['image']['url'])){
			                                echo '<div class="quote-icon">';
			                                    echo realar_img_tag( array(
													'url'	=> esc_url( $settings['image']['url'] ),
												) );
			                                echo '</div>';
			                            }
			                            if(!empty($data['client_image']['url'])){
			                                echo '<div class="avatar">';
			                                    echo realar_img_tag( array(
													'url'	=> esc_url( $data['client_image']['url'] ),
												) );
			                                echo '</div>';
			                            }
		                                echo '<div class="testi-card_profile-details">';
		                                	if(!empty($data['client_name'])){
												echo '<h3 class="testi-card_name name">'.esc_html( $data['client_name'] ).'</h3>';
											}
											if(!empty($data['client_desig'])){
												echo '<span class="testi-card_desig desig">'.esc_html( $data['client_desig'] ).'</span>';
											}
		                                echo '</div>';
		                            echo '</div>';
		                        echo '</div>';
		                    echo '</div>';
		                }
	                echo '</div>';
	            echo '</div>';
	        echo '</div>';
		}
	}
}