<?php
use \Elementor\Widget_Base;
use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Typography;
use \Elementor\Utils;
use \Elementor\Repeater;
use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Background;
/**
 * 
 * Newsletter Widget .
 *
 */
class Realar_Newsletter extends Widget_Base {

	public function get_name() {
		return 'realarnewsletter';
	}
	public function get_title() {
		return __( 'Newsletter', 'realar' );
	}
	public function get_icon() {
		return 'th-icon';
    }
	public function get_categories() {
		return [ 'realar' ];
	}
	
	protected function register_controls() {

		$this->start_controls_section(
			'layout_section',
			[
				'label'     => __( 'Newsletter Style', 'realar' ),
				'tab'       => Controls_Manager::TAB_CONTENT,
			]
        );

		realar_select_field( $this, 'layout_style', 'Layout Style', ['Style One', 'Style Two', 'Style Three', 'Style Four'] );

		realar_general_fields( $this, 'title', 'Title', 'TEXT', 'Sign Up For Newsletter', ['1','2', '3','4'] );


		realar_general_fields( $this, 'newsletter_placeholder', 'Placeholder', 'TEXT', 'Enter your Email' );
		realar_general_fields( $this, 'newsletter_button', 'Subscribe Button', 'TEXT', '<i class="fa-solid fa-paper-plane"></i>', ['1','2', '3','4']  );

        $this->end_controls_section();

        //---------------------------------------
			//Style Section Start
		//---------------------------------------
		//-------Title Style-------
		realar_common_style_fields($this, 'title', 'Title', '{{WRAPPER}} .title', ['1','2', '3']);
		realar_common_style_fields($this, 'title2', 'Title', '{{WRAPPER}} .title', ['4'],'--white-color');
		//-------Description Style-------


	}

	protected function render() {

        $settings = $this->get_settings_for_display();

		if( $settings['layout_style'] == '1' ){
			echo '<div class="title-area">';
				if($settings['title']){
	                echo '<h2 class="sec-title text-white title">'.esc_html($settings['title']).'</h2>';
	            }
            echo '</div>';
            echo '<form class="subscribe-form newsletter-form">';
                echo '<div class="form-group style-white style-radius gx-4">';
                    echo '<input type="text" class="form-control" placeholder="'.esc_attr( $settings['newsletter_placeholder'] ).'">';
                    echo '<i class="fal fa-envelope"></i>';
                echo '</div>';
                echo '<button class="th-btn style-border">'.wp_kses_post( $settings['newsletter_button'] ).' <span class="btn-icon"><img src="'.REALAR_PLUGDIRURI . 'assets/img/paper-plane.svg" alt="img"></span></button>';
            echo '</form>';
		}elseif( $settings['layout_style'] == '2' ){
			echo '<div class="newsletter-wrap">';
                echo '<h5 class="newsletter-title title">'.esc_html($settings['title']).'</h5>';
                echo '<form class="subscribe-form newsletter-form">';
                    echo '<div class="form-group">';
                        echo '<input type="text" class="form-control" placeholder="'.esc_attr( $settings['newsletter_placeholder'] ).'">';
                    echo '</div>';
                    echo '<button class="th-btn btn-mask">'.wp_kses_post( $settings['newsletter_button'] ).' <span class="btn-icon"><img src="'.REALAR_PLUGDIRURI . 'assets/img/paper-plane.svg" alt="img"></span></button>';
                echo '</form>';
            echo '</div>';
		}elseif( $settings['layout_style'] == '3' ){
			echo '<div class="newsletter-wrap">';
                echo '<h5 class="newsletter-title title">'.esc_html($settings['title']).'</h5>';
                echo '<form class="subscribe-form newsletter-form">';
                    echo '<div class="form-group">';
                        echo '<input type="text" class="form-control" placeholder="'.esc_attr( $settings['newsletter_placeholder'] ).'">';
                    echo '</div>';
                    echo '<button class="th-btn style3">'.wp_kses_post( $settings['newsletter_button'] ).' <span class="btn-icon"><img src="'.REALAR_PLUGDIRURI . 'assets/img/paper-plane.svg" alt="img"></span></button>';
                echo '</form>';
            echo '</div>';
		}else{
			echo '<div class="row gx-35 justify-content-center">';
                echo '<div class="col-xxl-10">';
                    echo '<div class="title-area text-center">';
                        echo '<h2 class="sec-title text-white title">'.esc_html($settings['title']).'</h2>';
                    echo '</div>';
                    echo '<form class="subscribe-form style2 newsletter-form">';
                        echo '<div class="form-group style-border3 style-radius">';
                            echo '<input type="text" class="form-control" placeholder="'.esc_attr( $settings['newsletter_placeholder'] ).'">';
                            echo '<i class="fal fa-envelope"></i>';
                        echo '</div>';
                        echo '<button class="th-btn">'.wp_kses_post( $settings['newsletter_button'] ).' <span class="btn-icon"><img src="'.REALAR_PLUGDIRURI . 'assets/img/paper-plane.svg" alt="img"></span></button>';
                    echo '</form>';
                echo '</div>';
            echo '</div>';
		}
	}
}
						