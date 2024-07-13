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
 * Price Widget .
 *
 */
class Realar_Price extends Widget_Base {

	public function get_name() {
		return 'realarprice';
	}
	public function get_title() {
		return __( 'Price Box', 'realar' );
	}
	public function get_icon() {
		return 'th-icon';
    }
	public function get_categories() {
		return [ 'realar' ];
	}

	protected function register_controls() {

		$this->start_controls_section(
			'price_section',
			[
				'label' 	=> __( 'Price Box', 'realar' ),
				'tab' 		=> Controls_Manager::TAB_CONTENT,
			]
        );

		realar_select_field( $this, 'layout_style', 'Layout Style', [ 'Style One'] );

		$repeater = new Repeater();

		realar_media_fields( $repeater, 'icon_image', 'Icon Image' );
		realar_general_fields( $repeater, 'plan_name', 'Plan Name', 'TEXT', 'Basic' );
		realar_general_fields( $repeater, 'price', 'Price', 'TEXT', '$100.00' );
		realar_general_fields( $repeater, 'subtitle', 'Subtitle', 'TEXT', 'Automatically connect with prospective clients' );
		realar_general_fields( $repeater, 'desc', 'Features', 'WYSIWYG', 'Automatically connect with prospective clients' );

		realar_general_fields($repeater, 'button_text', 'Button Text', 'TEXT', 'Button Text');
		realar_url_fields($repeater, 'button_url', 'Button URL');

		realar_switcher_fields( $repeater, 'is_popular', 'Is Popular?' );

		$this->add_control(
			'price_lists',
			[
				'label' 		=> __( 'Slides', 'realar' ),
				'type' 			=> Controls_Manager::REPEATER,
				'fields' 		=> $repeater->get_controls(),
				'default' 		=> [
					[
						'client_image'	=> Utils::get_placeholder_image_src(),
					],
				],
				'title_field' 	=> '{{{ plan_name }}}',
				'condition'		=> [ 
					'layout_style' => [ '1'],
				],
			]
		);


		$this->end_controls_section();



		$this->start_controls_section(
			'general_styling',
			[
				'label'     => __( 'Form General', 'realar' ),
				'tab'       => Controls_Manager::TAB_STYLE,
			]
		);

		realar_color_fields( $this, 'bg', 'Background', 'background', '{{WRAPPER}} .bg' );  

		$this->end_controls_section();

		//-------Title Style-------
		realar_common_style_fields( $this, 'tag', 'Title', '{{WRAPPER}} .title-tag', ['1'],'--theme-color' );
		realar_common_style_fields( $this, 'price', 'Price', '{{WRAPPER}} .price', ['1'],'--theme-color' );
		realar_common_style_fields( $this, 'features', 'Features', '{{WRAPPER}} .checklist', ['1'],'--title-color' );
		//------Button Style-------
		realar_button_style_fields( $this, '11', 'Button Styling', '{{WRAPPER}} .th_btn' );

	}

	protected function render() {

	$settings = $this->get_settings_for_display();

		if( $settings['layout_style'] == '1' ){

			echo '<div class="row gy-4 justify-content-center">';

            
				foreach( $settings['price_lists'] as $data ){
	                echo '<div class="col-lg-4 col-md-6 bg">';

	                	$active_class = ($data['is_popular'] == 'yes') ? 'active' : '';

	                    echo '<div class="price-card '.esc_attr( $active_class ).'">';
	                        echo '<div class="offer-tag">'.esc_html__('Most Popular', 'realar').'</div>';
	                        if(!empty($data['icon_image']['url'])){
		                        echo '<div class="price-card-icon">';
		                            echo realar_img_tag( array(
										'url'   => esc_url( $data['icon_image']['url'] ),
									));
		                        echo '</div>';
		                    }
		                    if(!empty($data['plan_name'])){
		                        echo '<h3 class="price-card-title title-tag">'.esc_html($data['plan_name']).'</h3>';
		                    }
		                    if(!empty($data['price'])){
		                        echo '<h4 class="price-card_price price">'.wp_kses_post($data['price']).'</h4>';
		                    }
		                    if(!empty($data['subtitle'])){
		                        echo '<p class="price-card_text">'.esc_html($data['subtitle']).'</p>';
		                    }
	                        echo '<div class="price-card_content">';
	                        	if(!empty($data['button_text'])){
		                            echo '<a href="'.esc_url( $data['button_url']['url'] ).'" class="th-btn th_btn style-border2 w-100">'.esc_html($data['button_text']).'</a>';
		                        }
	                            if(!empty($data['desc'])){
									echo '<div class="checklist">'.wp_kses_post($data['desc']).'</div>';
								}    
	                        echo '</div>';
	                    echo '</div>';
	                echo '</div>';
	            }
            echo '</div>';
		}
	}
}