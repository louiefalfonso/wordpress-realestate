<?php
use \Elementor\Widget_Base;
use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Typography;
use \Elementor\Utils;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Group_Control_Box_Shadow;
use \Elementor\Group_Control_Border;
/**
 *
 * Image Widget .
 *
 */
class Realar_Image extends Widget_Base {

	public function get_name() {
		return 'realarimage';
	}
	public function get_title() {
		return __( 'Image', 'realar' );
	}
	public function get_icon() {
		return 'th-icon';
    }
	public function get_categories() {
		return [ 'realar' ];
	}

	protected function register_controls() {

		$this->start_controls_section(
			'image_section',
			[
				'label' 	=> __( 'Image', 'realar' ),
				'tab' 		=> Controls_Manager::TAB_CONTENT,
			]
        );

		realar_select_field( $this, 'layout_style', 'Layout Style', [ 'Style One','Style Two','Style Three'] );

		realar_media_fields( $this, 'image1', 'Choose Image' );
		realar_media_fields( $this, 'image2', 'Choose Image' ,[ '3' ]);
		realar_general_fields( $this, 'title', 'Title', 'TEXT', 'Realar Agent Realar Living Solutions', [ '2' ] );
		// realar_media_fields( $this, 'image2', 'Choose Image', ['1', '4', '5'] );
		// realar_media_fields( $this, 'image3', 'Choose Image', ['4', '5'] );
		// realar_general_fields( $this, 'number', 'Number', 'TEXTAREA2', '35', [ '1', '5', '9', '10' ] );
		// realar_general_fields( $this, 'name', 'Name', 'TEXTAREA2', 'Benjamin Dowd', [ '5', '9'] );
		// realar_general_fields( $this, 'desig', 'Designatin', 'TEXTAREA2', 'Founder of Konta', ['5'] );

       $this->end_controls_section();

      	//---------------------------------------
			//Style Section Start
		//---------------------------------------

		//-------Title Style-------
		// realar_common_style_fields( $this, 'num', 'Number', '{{WRAPPER}} .num', ['1'] );
		// realar_common_style_fields( $this, 'title', 'Title', '{{WRAPPER}} .title', ['1'] );

	}

	protected function render() {

        $settings = $this->get_settings_for_display();
       
		if( $settings['layout_style'] == '1' ){
			if(!empty($settings['image1']['url'])){
				echo '<div class="img-box1">';
	                echo '<div class="img1 img-shine" data-mask-src="'.REALAR_PLUGDIRURI . 'assets/img/about-1-mask.png">';
	                    echo realar_img_tag( array(
							'url'   => esc_url( $settings['image1']['url'] ),
						));
	                echo '</div>';
	            echo '</div>';
	        }
		}elseif( $settings['layout_style'] == '2' ){

			echo '<div class="about-tag">';
				if(!empty($settings['title'])){
	                echo '<div class="about-experience-tag">';
	                    echo '<span class="circle-title-anime">'.wp_kses_post( $settings['title'] ).'</span>';
	                echo '</div>';
	            }
                echo '<div class="about-tag-thumb">';
                    echo realar_img_tag( array(
						'url'   => esc_url( $settings['image1']['url'] ),
					));
                echo '</div>';
            echo '</div>';
		}elseif( $settings['layout_style'] == '3' ){
			echo '<div class="testi-thumb-wrap">';
				if(!empty($settings['image1']['url'])){
	                echo '<div class="img1">';
	                    echo realar_img_tag( array(
							'url'   => esc_url( $settings['image1']['url'] ),
						));
	                echo '</div>';
	            }
	            if(!empty($settings['image2']['url'])){
	                echo '<div class="img2 jump">';
	                    echo realar_img_tag( array(
							'url'   => esc_url( $settings['image2']['url'] ),
						));
	                echo '</div>';
	            }
            echo '</div>';
		}
	}
}