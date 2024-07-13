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
 * Service Widget .
 *
 */
class realar_Service extends Widget_Base {

	public function get_name() {
		return 'realarservice';
	}
	public function get_title() {
		return __( 'Services', 'realar' );
	}
	public function get_icon() {
		return 'th-icon';
    }
	public function get_categories() {
		return [ 'realar' ];
	}

	protected function register_controls() {

		 $this->start_controls_section(
			'service_section',
			[
				'label'     => __( 'Services', 'realar' ),
				'tab'       => Controls_Manager::TAB_CONTENT,
			]
        );

		realar_select_field( $this, 'layout_style', 'Layout Style',[ 'Style One', 'Style Two', 'Style Three', 'Style Four'] );

		// realar_general_fields($this, 'arrow_id', 'Arrow ID', 'TEXT', 'serviceSlider1', ['1']);
		// realar_media_fields( $this, 'shape', 'Choose Shape', ['1', '2'] );

		$fields_to_include = [ 'image' => ['Thumb Image','Icon Image'], 'title' => ['Title'], 'desc' => ['Description'], 'btn' => ['Button Text'], 'url' => ['URL'] ];
		realar_repeater_fields( $this, 'service_list', 'Service Lists', $fields_to_include, ['2','3','4'] );

		realar_common_repeater_field( $this, 'Services', ['image', 'title', 'text', 'link' ], ['1']);

        $this->end_controls_section();

        //---------------------------------------
			//Style Section Start
		//---------------------------------------

		//-------Title Style-------
		// realar_common2_style_fields( $this, 'title', 'Title', '{{WRAPPER}} .title a', ['1', '2', '4'] );
		realar_common2_style_fields( $this, 'title2', 'Title', '{{WRAPPER}} .title a', ['1','2','3','4'] );
		//-------Description Style-------
		realar_common_style_fields( $this, 'desc', 'Description', '{{WRAPPER}} .desc' );

	}

	protected function render() {

        $settings = $this->get_settings_for_display();

		if( $settings['layout_style'] == '1' ){
			echo '<div class="custom-service1">';
				echo '<div class="row gy-40">';
	                foreach( $settings['services'] as $data ){
		                echo '<div class="col-lg-4 col-md-6">';
		                    echo '<div class="service-card">';
		                    	if(!empty($data['services_image']['url'])){
			                        echo '<div class="service-card-icon">';
			                            echo '<div class="icon">';
			                                echo realar_img_tag( array(
												'url'   => esc_url( $data['services_image']['url'] ),
											));
			                            echo '</div>';
			                        echo '</div>';
			                    }
		                        echo '<div class="box-content">';
		                        	if(!empty($data['services_title'])){
			                            echo '<h3 class="box-title title"><a href="'.esc_url( $data['services_link']['url'] ).'">'.esc_html($data['services_title']).'</a></h3>';
			                        }
			                        if(!empty($data['services_text'])){
			                            echo '<p class="box-text desc">'.esc_html($data['services_text']).'</p>';
			                        }
		                        echo '</div>';
		                    echo '</div>';
		                echo '</div>';
		            }
	            echo '</div>';
            echo '</div>';
		}elseif( $settings['layout_style'] == '2' ){

			echo '<div class="swiper th-slider" data-slider-options=\'{"breakpoints":{"0":{"slidesPerView":1},"576":{"slidesPerView":"1"},"768":{"slidesPerView":"2"},"992":{"slidesPerView":"2"},"1200":{"slidesPerView":"3"}}}\'>';
                echo '<div class="swiper-wrapper">';
                    foreach( $settings['service_list'] as $data ){
	                    echo '<div class="swiper-slide">';
	                        echo '<div class="service-card style2">';
	                        	if(!empty($data['icon_image']['url'])){
		                            echo '<div class="service-card-icon">';
		                                echo realar_img_tag( array(
											'url'   => esc_url( $data['icon_image']['url'] ),
										));
		                            echo '</div>';
		                        }
		                        if(!empty($data['title'])){
		                            echo '<h3 class="box-title title"><a href="'.esc_url( $data['url']['url'] ).'">'.esc_html($data['title']).'</a></h3>';
		                        }
		                        if(!empty($data['description'])){
		                            echo '<p class="box-text desc">'.esc_html($data['description']).'</p>';
		                        }
		                        if(!empty($data['thumb_image']['url'])){
		                            echo '<div class="service-img img-shine">';
		                                echo realar_img_tag( array(
											'url'   => esc_url( $data['thumb_image']['url'] ),
										));
		                            echo '</div>';
		                        }
	                        echo '</div>';
	                    echo '</div>';
	                }
                echo '</div>';
            echo '</div>';
		}elseif( $settings['layout_style'] == '3' ){
			echo '<div class="swiper th-slider service-slider3" data-slider-options=\'{"breakpoints":{"0":{"slidesPerView":1},"576":{"slidesPerView":"1"},"768":{"slidesPerView":"2"},"992":{"slidesPerView":"2"},"1200":{"slidesPerView":"4"}}}\'>';
                echo '<div class="swiper-wrapper">';

                    
                    foreach( $settings['service_list'] as $data ){
	                    echo '<div class="swiper-slide">';
	                        echo '<div class="service-card style3">';
	                        	if(!empty($data['icon_image']['url'])){
		                            echo '<div class="service-card-icon">';
		                                echo realar_img_tag( array(
											'url'   => esc_url( $data['icon_image']['url'] ),
										));
		                            echo '</div>';
		                        }
		                        if(!empty($data['title'])){
		                            echo '<h3 class="box-title title"><a href="'.esc_url( $data['url']['url'] ).'">'.esc_html($data['title']).'</a></h3>';
		                        }
		                        if(!empty($data['description'])){
		                            echo '<p class="box-text desc">'.esc_html($data['description']).'</p>';
		                        }
		                        if(!empty($data['thumb_image']['url'])){
		                            echo '<div class="service-img img-shine">';
		                                echo realar_img_tag( array(
											'url'   => esc_url( $data['thumb_image']['url'] ),
										));
										echo '<a href="'.esc_url( $data['url']['url'] ).'" class="icon-btn">';
		                                    echo '<img src="'.REALAR_PLUGDIRURI . 'assets/img/arrow-right.svg" alt="img">';
		                                echo '</a>';
		                            echo '</div>';
		                        }
	                        echo '</div>';
	                    echo '</div>';
	                }
                echo '</div>';
                echo '<div class="slider-pagination"></div>';
            echo '</div>';
		}elseif( $settings['layout_style'] == '4' ){
			echo '<div class="swiper th-slider" data-slider-options=\'{"breakpoints":{"0":{"slidesPerView":1},"576":{"slidesPerView":"1"},"768":{"slidesPerView":"2"},"992":{"slidesPerView":"2"},"1200":{"slidesPerView":"3"}}}\'>';
                echo '<div class="swiper-wrapper">';
                    foreach( $settings['service_list'] as $data ){
	                    echo '<div class="swiper-slide">';
	                        echo '<div class="service-card style4">';
	                        	if(!empty($data['icon_image']['url'])){
		                            echo '<div class="service-card-icon">';
		                                echo realar_img_tag( array(
											'url'   => esc_url( $data['icon_image']['url'] ),
										));
		                            echo '</div>';
		                        }
		                        if(!empty($data['title'])){
		                            echo '<h3 class="box-title title"><a href="'.esc_url( $data['url']['url'] ).'">'.esc_html($data['title']).'</a></h3>';
		                        }
		                        if(!empty($data['description'])){
		                            echo '<p class="box-text desc">'.esc_html($data['description']).'</p>';
		                        }
		                        if(!empty($data['thumb_image']['url'])){
		                            echo '<div class="service-img img-shine">';
		                                echo realar_img_tag( array(
											'url'   => esc_url( $data['thumb_image']['url'] ),
										));
		                            echo '</div>';
		                        }
	                        echo '</div>';
	                    echo '</div>';
	                }
                echo '</div>';
            echo '</div>';

		}


	}

}