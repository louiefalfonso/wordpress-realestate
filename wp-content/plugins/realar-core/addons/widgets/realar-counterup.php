<?php
use \Elementor\Widget_Base;
use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Typography;
use \Elementor\Repeater;
use \Elementor\Utils;
use \Elementor\Group_Control_Border;
/**
 *
 * Counter Up Widget .
 *
 */
class realar_Counterup extends Widget_Base {

	public function get_name() {
		return 'realarcounterup';
	}
	public function get_title() {
		return __( 'Counter Up', 'realar' );
	}
	public function get_icon() {
		return 'th-icon';
    }
	public function get_categories() {
		return [ 'realar' ];
	}

	protected function register_controls() {

		$this->start_controls_section(
			'counter_section',
			[
				'label' 	=> __( 'Counter Up', 'realar' ),
				'tab' 		=> Controls_Manager::TAB_CONTENT,
			]
        );

		realar_select_field( $this, 'layout_style', 'Layout Style', [ 'Style One', 'Style Two', 'Style Three' ] ); 

		$repeater = new Repeater();

		$fields_to_include = [ 'title' => ['Title','Number', 'After Prefix'] ];
		realar_repeater_fields( $this, 'counter_lists', 'Counter List', $fields_to_include, ['1', '2', '3'] );

		$this->end_controls_section();

        //---------------------------------------
			//Style Section Start
		//---------------------------------------

		$this->start_controls_section(
			'general_styling',
			[
				'label'     => __( 'General', 'realar' ),
				'tab'       => Controls_Manager::TAB_STYLE,
			]
		);


		$this->end_controls_section();

		//-------Number Style-------
		realar_common_style_fields($this, 'number', 'Number', '{{WRAPPER}} .num');
		//-------Title Style-------
		realar_common_style_fields($this, 'title', 'Title', '{{WRAPPER}} .desc');
		

	}

	protected function render() {

	$settings = $this->get_settings_for_display();

		if( $settings['layout_style'] == '1' ){

			echo '<div class="counter-card-wrap space">';
                foreach( $settings['counter_lists'] as $data ){
	                echo '<div class="counter-card">';
	                    echo '<div class="media-body">';
	                    	if(!empty($data['number'])){
		                        echo '<h2 class="box-number"><span class="counter-number num">'.esc_html( $data['number'] ).'</span>'.esc_html( $data['after_prefix'] ).'</h2>';
		                    }
		                    if(!empty($data['title'])){
		                        echo '<p class="box-text desc">'.esc_html( $data['title'] ).'</p>';
		                    }
	                    echo '</div>';
	                echo '</div>';
	            }
            echo '</div>';
		}elseif( $settings['layout_style'] == '2' ){

			echo '<div class="counter-card-wrap space">';

                foreach( $settings['counter_lists'] as $data ){
	                echo '<div class="counter-card style2">';
	                    echo '<div class="media-body">';
	                    	if(!empty($data['number'])){
		                        echo '<h2 class="box-number"><span class="counter-number num">'.esc_html( $data['number'] ).'</span>'.esc_html( $data['after_prefix'] ).'</h2>';
		                    }
		                    if(!empty($data['title'])){
		                        echo '<p class="box-text desc">'.esc_html( $data['title'] ).'</p>';
		                    }
	                    echo '</div>';
	                echo '</div>';
	            }
                

            echo '</div>';
		}elseif( $settings['layout_style'] == '3' ){
			echo '<div class="counter-card-wrap style2">';
                foreach( $settings['counter_lists'] as $data ){
	                echo '<div class="counter-card style2">';
	                    echo '<div class="media-body">';
	                    	if(!empty($data['number'])){
		                        echo '<h2 class="box-number text-white num"><span class="counter-number text-white">'.esc_html( $data['number'] ).'</span>'.esc_html( $data['after_prefix'] ).'</h2>';
		                    }
		                    if(!empty($data['title'])){
		                        echo '<p class="box-text text-light desc">'.esc_html( $data['title'] ).'</p>';
		                    }
	                    echo '</div>';
	                echo '</div>';
	            }  
            echo '</div>';
		}
	}
}