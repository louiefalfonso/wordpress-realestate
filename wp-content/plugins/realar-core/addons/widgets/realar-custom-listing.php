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
 * Feature Widget .
 *
 */
class realar_CustoM_Listing extends Widget_Base {

	public function get_name() {
		return 'realarcustomlisting';
	}
	public function get_title() {
		return __( 'Realar Custom Listing', 'realar' );
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
				'label'     => __( 'Listing', 'realar' ),
				'tab'       => Controls_Manager::TAB_CONTENT,
			]
        );

		realar_select_field( $this, 'layout_style', 'Layout Style',[ 'Style One'] );

		$fields_to_include = [ 'image' => ['Thumb Image'], 'title' => ['Title','Price','Location','Bed','Bath','Size','Button Text'], 'url' => ['URL'] ];
		realar_repeater_fields( $this, 'service_list', 'Feature Lists', $fields_to_include, ['1'] );


        $this->end_controls_section();

		realar_common2_style_fields( $this, 'title2', 'Title', '{{WRAPPER}} .box-title', ['1'] );


	}

	protected function render() {

        $settings = $this->get_settings_for_display();

		if( $settings['layout_style'] == '1' ){

			echo '<div class="slider-area property-slider2 slider-drag-wrap">';
                echo '<div class="swiper th-slider" data-slider-options=\'{"breakpoints":{"0":{"slidesPerView":1},"576":{"slidesPerView":"1"},"768":{"slidesPerView":"2"},"992":{"slidesPerView":"2"},"1200":{"slidesPerView":"3"},"1500":{"slidesPerView":"4"}},"spaceBetween":"32","grabCursor":"true","slideToClickedSlide":"true"}\'>';
                    echo '<div class="swiper-wrapper">';

                    	foreach( $settings['service_list'] as $data ){
	                        echo '<div class="swiper-slide">';
	                            echo '<div class="property-card2">';
	                            	if(!empty($data['thumb_image']['url'])){
		                                echo '<div class="property-card-thumb img-shine">';
		                                    echo realar_img_tag( array(
												'url'   => esc_url( $data['thumb_image']['url'] ),
											));
		                                echo '</div>';
		                            }
	                                echo '<div class="property-card-meta">';
	                                	if(!empty($data['bed'])){
		                                    echo '<span><img src="'.REALAR_PLUGDIRURI . 'assets/img/property-icon1-1.svg" alt="img">'.esc_html($data['bed']).'</span>';
		                                }
		                                if(!empty($data['bath'])){
		                                    echo '<span><img src="'.REALAR_PLUGDIRURI . 'assets/img/property-icon1-2.svg" alt="img">'.esc_html($data['bath']).'</span>';
		                                }
		                                if(!empty($data['size'])){
		                                    echo '<span><img src="'.REALAR_PLUGDIRURI . 'assets/img/property-icon1-3.svg" alt="img">'.esc_html($data['size']).'</span>';
		                                }
	                                echo '</div>';
	                                echo '<div class="property-card-details">';
	                                    echo '<div class="media-left">';
	                                    	if(!empty($data['title'])){
		                                        echo '<h4 class="property-card-title"><a href="property-details.html">'.esc_html($data['title']).'</a></h4>';
		                                    }
		                                    if(!empty($data['price'])){
		                                        echo '<h5 class="property-card-price">'.esc_html($data['price']).'</h5>';
		                                    }
		                                    if(!empty($data['location'])){
		                                        echo '<p class="property-card-location">'.esc_html($data['location']).'</p>';
		                                    }
	                                    echo '</div>';
	                                    if(!empty($data['button_text'])){
		                                    echo '<div class="btn-wrap">';
		                                        echo '<a href="'.esc_url( $data['url']['url'] ).'" class="th-btn style-border2 th-btn-icon">'.esc_html($data['button_text']).'</a>';
		                                    echo '</div>';
		                                }
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