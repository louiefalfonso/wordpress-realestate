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
 * Video Widget .
 *
 */
class realar_Video extends Widget_Base {

	public function get_name() {
		return 'realarvideo';
	}
	public function get_title() {
		return __( 'Video Box', 'realar' );
	}
	public function get_icon() {
		return 'th-icon';
    }
	public function get_categories() {
		return [ 'realar' ];
	}

	protected function register_controls() {

		$this->start_controls_section(
			'video_section',
			[
				'label' 	=> __( 'video Box', 'realar' ),
				'tab' 		=> Controls_Manager::TAB_CONTENT,
			]
        );

		realar_select_field( $this, 'layout_style', 'Layout Style', [ 'Style One','Style Two' ,'Style Three' ] ); 

		realar_general_fields( $this, 'title', 'Title', 'TEXT', 'Take a look at our modern apartment' , [ '1','2','3' ] );
		realar_general_fields( $this, 'description', 'Subtitle', 'TEXTAREA','Description' , [ '1' ]);
		realar_general_fields($this, 'button_text', 'Button Text', 'TEXT', 'Button Text' , [ '1','2' ]);
		realar_url_fields($this, 'button_url', 'Button URL' , [ '1' ]);


		realar_media_fields( $this, 'bg', 'Background Image' , [ '1','3' ]);
		realar_general_fields( $this, 'name', 'Author Name', 'TEXT' , '',[ '1' ]);
		realar_general_fields( $this, 'desig', 'Author Designation', 'TEXT' , '',[ '1' ]);
		realar_media_fields( $this, 'a_image', 'Author Image' , [ '1' ]);
		realar_media_fields( $this, 'a_sign', 'Author Signature' , [ '1' ]);




		realar_general_fields( $this, 'video_url', 'Video Url', 'TEXT', '#' );

		$this->end_controls_section();

		realar_common_style_fields($this, 'title', 'Title', '{{WRAPPER}} .text-theme', ['2'], '--theme-color');

        //---------------------------------------
			//Style Section Start
		//---------------------------------------

		//-------Title Style-------
		// realar_common_style_fields( $this, 'title2', 'Title', '{{WRAPPER}} .sec-title', [ '1' ] );
	
	}

	protected function render() {

        $settings = $this->get_settings_for_display();



		if( $settings['layout_style'] == '1' ){

			echo '<div class="video-area-1 ">';
	            echo '<div class="video-wrap1">';
	            	if(!empty($settings['video_url'])){
		                echo '<div class="video-box1">';
		                	if(!empty( $settings['bg']['url'] )){
			                    echo '<img src="'.esc_url( $settings['bg']['url'] ).'" alt="img">';
			                }
		                    echo '<a href="'.esc_url( $settings['video_url'] ).'" class="play-btn style3 popup-video"><i class="fa-sharp fa-solid fa-play"></i></a>';
		                echo '</div>';
		            }
	                echo '<div class="video-wrap-details">';
	                    echo '<div class="title-area mb-45">';
	                    	if(!empty($settings['title'])){
		                        echo '<h2 class="sec-title">'.esc_html($settings['title']).'</h2>';
		                    }
		                    if(!empty($settings['description'])){
		                        echo '<p class="sec-text text-title">'.esc_html($settings['description']).'</p>';
		                    }
	                    echo '</div>';
	                    if( ! empty( $settings['button_text'] ) ) {
		                    echo '<div class="btn-wrap mb-55">';
		                        echo '<a href="'.esc_url( $settings['button_url']['url'] ).'" class="th-btn style2 btn-mask th-btn-icon">'.esc_html( $settings['button_text'] ).'</a>';
		                    echo '</div>';
		                }
	                    echo '<div class="author-grid">';
	                        echo '<div class="author-profile">';
	                        	if(!empty( $settings['a_image']['url'] )){
		                            echo '<div class="avater">';
		                                echo '<img src="'.esc_url( $settings['a_image']['url'] ).'" alt="img">';
		                            echo '</div>';
		                        }
	                            echo '<div class="media-body">';
	                            	if( ! empty( $settings['name'] ) ) {
		                                echo '<h5 class="author-profile-name">'.esc_html($settings['name']).'</h5>';
		                            }
		                            if( ! empty( $settings['desig'] ) ) {
		                                echo '<p class="author-desig">'.esc_html($settings['desig']).'</p>';
		                            }
	                            echo '</div>';
	                        echo '</div>';
	                        if(!empty( $settings['a_sign']['url'] )){
		                        echo '<div class="author-sign">';
		                            echo '<img src="'.esc_url( $settings['a_sign']['url'] ).'" alt="img">';
		                        echo '</div>';
		                    }
	                    echo '</div>';
	                echo '</div>';
	            echo '</div>';
	        echo '</div>';
		}elseif( $settings['layout_style'] == '2' ){
			echo '<div class="video-wrap2 mb-lg-0 mb-40">';
				if(!empty($settings['title'])){
	                echo '<h2 class="video-title text-theme">'.wp_kses_post( $settings['title'] ).'</h2>';
	            }
	            if(!empty($settings['video_url'])){
	                echo '<a href="'.esc_url( $settings['video_url'] ).'" class="video-btn popup-video">';
	                    echo '<span class="play-btn style5"><i class="fa-sharp fa-solid fa-play"></i></span>';
	                    if( ! empty( $settings['button_text'] ) ) {
		                    echo $settings['button_text'];
		                }
	                echo '</a>';
	            }
            echo '</div>';
		}else{
			echo '<div class="img-box3">';
				if(!empty( $settings['bg']['url'] )){
	                echo '<div class="img1">';
	                    echo '<img src="'.esc_url( $settings['bg']['url'] ).'" alt="About">';
	                echo '</div>';
	            }
                echo '<div class="about-tag">';
                	if(!empty($settings['title'])){
	                    echo '<div class="about-experience-tag">';
	                        echo '<span class="circle-title-anime">'.esc_html($settings['title']).'</span>';
	                    echo '</div>';
	                }
	                if(!empty($settings['video_url'])){
	                    echo '<a href="'.esc_url( $settings['video_url'] ).'" class="play-btn popup-video"><i class="fa-sharp fa-solid fa-play"></i></a>';
	                }
                echo '</div>';
            echo '</div>';
		}
	}
}