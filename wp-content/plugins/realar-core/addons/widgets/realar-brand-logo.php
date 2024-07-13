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
class realar_Brand_Logo extends Widget_Base {

	public function get_name() {
		return 'realarbrandlogo';
	}
	public function get_title() {
		return __( 'Brand Logo', 'realar' );
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
				'label' 	=> __( 'Brand Logo', 'realar' ),
				'tab' 		=> Controls_Manager::TAB_CONTENT,
			]
        );

		realar_select_field( $this, 'layout_style', 'Layout Style', [ 'Style One'] );

		// realar_general_fields( $this, 'title', 'Title', 'TEXTAREA2', 'Title', [ '1' ] );
		// realar_general_fields( $this, 'desc', 'Description', 'TEXTAREA', 'Description', [ '1' ] );

		$fields_to_include = [ 'image' => ['Brand Logo'], 'url' => ['Link'] ];
		realar_repeater_fields( $this, 'logos', 'Brand Logos', $fields_to_include );

        $this->end_controls_section();

		//---------------------------------------
			//Style Section Start
		//---------------------------------------

		//-------General Style-------
		// $this->start_controls_section(
		// 	'general_styling',
		// 	[
		// 		'label'     => __( 'General', 'realar' ),
		// 		'tab'       => Controls_Manager::TAB_STYLE,
		// 	]
		// );

		// realar_color_fields( $this, 'bg', 'Background', 'background', '{{WRAPPER}} .brand-slider, {{WRAPPER}} .brand-sec', ['1', '2'] );  
		// // realar_color_fields( $this, 'bg2', 'Background', 'background', '{{WRAPPER}} .brand-sec', ['2'], '--title-color' );  
		// realar_color_fields( $this, 'bg4', 'Background 2', 'background', '{{WRAPPER}} .brandSlider1', ['1'] );  
		// realar_color_fields( $this, 'bg3', 'Background Shage', 'background', '{{WRAPPER}} .brand-sec .brand-shape', ['2'] );  

		// $this->end_controls_section();

		// realar_common_style_fields( $this, 'title', 'Title', '{{WRAPPER}} .title', [ '1' ] );
		// realar_common_style_fields( $this, 'desc', 'Description', '{{WRAPPER}} .desc', [ '1' ] );


	}

	protected function render() {

	$settings = $this->get_settings_for_display();

		if( $settings['layout_style'] == '1' ){

			echo '<div class="slider-area client-slider1">';
                echo '<div class="swiper th-slider has-shadow" id="clientSlider1" data-slider-options=\'{"breakpoints":{"0":{"slidesPerView":2},"576":{"slidesPerView":"3"},"768":{"slidesPerView":"4"},"992":{"slidesPerView":"5"},"1200":{"slidesPerView":"6"}}}\'>';
                    echo '<div class="swiper-wrapper">';

                        foreach( $settings['logos'] as $data ){
	                        echo '<div class="swiper-slide">';
	                            echo '<a href="'.esc_url( $data['link']['url'] ).'" class="client-card">';
	                                echo realar_img_tag( array(
										'url'   => esc_url( $data['brand_logo']['url'] ),
									) );
	                            echo '</a>';
	                        echo '</div>';
	                    }
                    echo '</div>';
                echo '</div>';
            echo '</div>';
		}
	}
}