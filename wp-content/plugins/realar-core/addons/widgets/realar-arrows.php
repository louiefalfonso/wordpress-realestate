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
 * Arrows Widget .
 *
 */
class realar_Arrows extends Widget_Base {

	public function get_name() {
		return 'realararrows';
	}
	public function get_title() {
		return __( 'Slider Arrow', 'realar' );
	}
	public function get_icon() {
		return 'th-icon';
    }
	public function get_categories() {
		return [ 'realar' ];
	}

	protected function register_controls() {

		$this->start_controls_section(
			'arrow_section',
			[
				'label'     => __( 'Slider Arrows', 'realar' ),
				'tab'       => Controls_Manager::TAB_CONTENT,
			]
        );

		realar_select_field( $this, 'layout_style', 'Layout Style', [ 'Style One' ] );

		realar_general_fields($this, 'arrow_id', 'Arrow ID or Class', 'TEXT', '#serviceSlider2');
		realar_general_fields($this, 'arrow_extra_class', 'Arrow Extra Class', 'TEXT', '');

        $this->end_controls_section();

        //---------------------------------------
			//Style Section Start
		//---------------------------------------

	}

	protected function render() {

    $settings = $this->get_settings_for_display();

		if( $settings['layout_style'] == '1' ){
			echo '<div class="sec-btn '.esc_attr($settings['arrow_extra_class']).'">';
				echo '<div class="icon-box">';
					echo '<button data-slider-prev="'.esc_attr($settings['arrow_id']).'" class="slider-arrow style4 default slider-prev"><img src="'.REALAR_ASSETS.'/img/arrow-left.svg" alt=""></button>';
					echo '<button data-slider-next="'.esc_attr($settings['arrow_id']).'" class="slider-arrow style4 default slider-next"><img src="'.REALAR_ASSETS.'/img/arrow-right.svg" alt=""></button>';
				echo '</div>';
			echo '</div>';	
		}	
	}
}