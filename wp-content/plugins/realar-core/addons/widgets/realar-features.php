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
class realar_Feature extends Widget_Base {

	public function get_name() {
		return 'realarfeatures';
	}
	public function get_title() {
		return __( 'Realar Features', 'realar' );
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
				'label'     => __( 'Features', 'realar' ),
				'tab'       => Controls_Manager::TAB_CONTENT,
			]
        );

		realar_select_field( $this, 'layout_style', 'Layout Style',[ 'Style One'] );

		$fields_to_include = [ 'image' => ['Thumb Image','Icon Image'], 'title' => ['Title'], 'url' => ['URL'] ];
		realar_repeater_fields( $this, 'service_list', 'Feature Lists', $fields_to_include, ['1'] );


        $this->end_controls_section();

		realar_common2_style_fields( $this, 'title2', 'Title', '{{WRAPPER}} .box-title', ['1'] );


	}

	protected function render() {

        $settings = $this->get_settings_for_display();

		if( $settings['layout_style'] == '1' ){
			echo '<div class="swiper th-slider aminities-slider" id="aminitiesSlider1" data-slider-options=\'{"breakpoints":{"0":{"slidesPerView":1},"375":{"slidesPerView":"2"},"768":{"slidesPerView":"3"},"992":{"slidesPerView":"4"},"1200":{"slidesPerView":"6"}}}\'>';
                echo '<div class="swiper-wrapper">';

                    foreach( $settings['service_list'] as $data ){
	                    echo '<div class="swiper-slide">';
	                        echo '<a href="'.esc_url( $data['url']['url'] ).'" class="aminities-card" data-mask-src="'.REALAR_PLUGDIRURI . 'assets/img/aminities-shape1.png">';
	                        	if(!empty($data['thumb_image']['url'])){
		                            echo '<div class="aminities-card-img">';
		                                echo realar_img_tag( array(
											'url'   => esc_url( $data['thumb_image']['url'] ),
										));
		                            echo '</div>';
		                        }
	                            echo '<div class="aminities-content">';
	                            	if(!empty($data['icon_image']['url'])){
		                                echo '<div class="aminities-card-icon">';
		                                    echo realar_img_tag( array(
												'url'   => esc_url( $data['icon_image']['url'] ),
											));
		                                echo '</div>';
		                            }
		                            if(!empty($data['title'])){
		                                echo '<h3 class="box-title">'.esc_html($data['title']).'</h3>';
		                            }
	                            echo '</div>';
	                        echo '</a>';
	                    echo '</div>';
	                }
                echo '</div>';
                echo '<div class="slider-pagination"></div>';
                echo '<button data-slider-prev="#aminitiesSlider1" class="slider-arrow slider-prev"><img src="'.REALAR_PLUGDIRURI . 'assets/img/arrow-left.svg" alt="icon"></button>';
                echo '<button data-slider-next="#aminitiesSlider1" class="slider-arrow slider-next"><img src="'.REALAR_PLUGDIRURI . 'assets/img/arrow-right.svg" alt="icon"></button>';
            echo '</div>';
		}
	}
}