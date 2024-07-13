<?php
use \Elementor\Widget_Base;
use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Typography;
use \Elementor\Repeater;
use \Elementor\Utils;
use \Elementor\Group_Control_Border;
/**
 *
 * Banner Widget.
 *
 */
class realar_Banner extends Widget_Base {

	public function get_name() {
		return 'realarbanner';
	}
	public function get_title() {
		return __( 'Banner Slider', 'realar' );
	}
	public function get_icon() {
		return 'th-icon';
    }
	public function get_categories() {
		return [ 'realar_header_elements' ];
	}

	protected function register_controls() {

		$this->start_controls_section(
			'banner_section',
			[
				'label' 	=> __( 'Banner', 'realar' ),
				'tab' 		=> Controls_Manager::TAB_CONTENT,
			]
        );

		realar_select_field( $this, 'layout_style', 'Layout Style', [ 'Style One', 'Style Two', 'Style Three' ] );


		$fields_to_include = [ 'image' => ['Background'], 'title' => ['Title', 'Subtitle','Shadow Title'], 'desc' => ['Description'], 'btn' => ['Button Text'], 'url' => ['Button URL','Video URL'] ];
		realar_repeater_fields( $this, 'banners1', 'Banner Info', $fields_to_include, ['1','2'] );


		$fields_to_include2 = [ 'title' => ['Button Text', 'Button url']] ;
		realar_repeater_fields( $this, 'buttons', 'Buttons', $fields_to_include2, ['3'] );

		realar_media_fields( $this, 'mask', 'Mask Image', ['1'] );
		realar_social_fields($this, 'social_icon_list', 'Social List', ['1'] );	

		realar_media_fields( $this, 'image', 'Avatar Image', ['2','3'] );
		realar_media_fields( $this, 'shape', 'Shape Image', ['2'] );
		realar_general_fields( $this, 'curve_text', 'Curve Text', 'TEXT', 'Need Help?', ['2'] );
		realar_general_fields( $this, 'title', 'Tittle', 'TEXT', 'Need Help?', ['3'] );
		realar_general_fields( $this, 'video_url', 'Video Url', 'TEXT', '#', ['3'] );
		realar_general_fields( $this, 'id', 'Scroll ID', 'TEXT', 'about-sec', ['1','3'] );

		$this->end_controls_section();

        //---------------------------------------
			//Style Section Start
		//---------------------------------------

		//-------Subtitle Style-------
		realar_common_style_fields($this, 'subtitle', 'Subtitle', '{{WRAPPER}} .title2', ['1','2']);
		realar_common_style_fields($this, 'subtitle2', 'Subtitle', '{{WRAPPER}} .title2', ['3'],'--white-color');
		//-------Title Style-------
		realar_common_style_fields($this, 'title', 'Title', '{{WRAPPER}} .title1', ['1','2']);
		//-------Description Style-------
		realar_common_style_fields($this, 'desc1', 'Description', '{{WRAPPER}} .hero-text', ['1'],'--white-color');
		realar_common_style_fields($this, 'desc2', 'Description', '{{WRAPPER}} .hero-text', ['2']);
		//------Button Style-------
		realar_button_style_fields($this, '10', 'Button Styling', '{{WRAPPER}} .btn-mask', ['1']);
		realar_button_style_fields($this, '11', 'Button Styling', '{{WRAPPER}} .th-btn', ['2']);

    }

	protected function render() {

    $settings = $this->get_settings_for_display();

		if( $settings['layout_style'] == '1' ){

			echo '<div class="hero-1" id="hero">';
		        echo '<div class="swiper th-slider hero-slider1" id="heroSlide1" data-slider-options=\'{"effect":"fade"}\'>';
		            echo '<div class="swiper-wrapper">';
		            	foreach( $settings['banners1'] as  $data ){
			                echo '<div class="swiper-slide">';
			                
			                	$mask_image = $settings['mask']['url'] ?  $settings['mask']['url'] : ''.REALAR_PLUGDIRURI . 'assets/img/hero_1_bg_mask.png';

			                    echo '<div class="hero-inner" data-mask-src="'.REALAR_PLUGDIRURI . 'assets/img/hero_1_bg_mask.png">';
			                    	if(!empty( $data['background']['url'] )){
				                        echo '<div class="th-hero-bg" data-bg-src="'.esc_url( $data['background']['url']  ).'"></div>';
				                    }
				                    if(!empty($data['shadow_title'])){
				                        echo '<div class="hero-big-text">'.esc_html($data['shadow_title']).'</div>';
				                    }
			                        echo '<div class="container">';
			                            echo '<div class="row align-items-center">';
			                                echo '<div class="col-lg-6">';
			                                    echo '<div class="hero-style1">';
			                                        echo '<h1 class="hero-title text-white">';
			                                        	if(!empty($data['title'])){
				                                            echo '<span class="title1" data-ani="slideindown" data-ani-delay="0.3s">'.esc_html($data['title']).'</span>';
				                                        }
			                                            if(!empty($data['subtitle'])){    
				                                            echo '<span class="title2" data-ani="slideindown" data-ani-delay="0.4s">'.esc_html($data['subtitle']).'</span>';
				                                        }
		
			                                        echo '</h1>';
			                                        if(!empty($data['description'])){  
				                                        echo '<p class="hero-text text-white" data-ani="slideinup" data-ani-delay="0.5s">'.esc_html($data['description']).'</p>';
				                                    }
				                                    if(!empty($data['button_text'])){  
				                                        echo '<a href="'.esc_url( $data['button_url']['url'] ).'" class="th-btn btn-mask th-btn-icon" data-ani="slideinup" data-ani-delay="0.6s">'.esc_html($data['button_text']).'</a>';
				                                    }
			                                    echo '</div>';
			                                echo '</div>';
			                                if(!empty($data['video_url']['url'])){  
				                                echo '<div class="col-lg-6">';
				                                    echo '<div class="hero-video-wrap text-center" data-ani="slideinright" data-ani-delay="0.4s">';
				                                        echo '<a href="'.esc_url( $data['video_url']['url'] ).'" class="play-btn style2 popup-video"><i class="fa-sharp fa-solid fa-play"></i></a>';
				                                    echo '</div>';
				                                echo '</div>';
				                            }
			                            echo '</div>';
			                        echo '</div>';
			                    echo '</div>';
			                echo '</div>';
			            }
		           	echo ' </div>';
		            echo '<div class="slider-pagination"></div>';
		        echo '</div>';
		        echo '<div class="hero-social-link">';
		            echo '<div class="social-wrap">';

		            	foreach( $settings['social_icon_list'] as $social_icon ){
							$social_target    = $social_icon['icon_link']['is_external'] ? ' target="_blank"' : '';
							$social_nofollow  = $social_icon['icon_link']['nofollow'] ? ' rel="nofollow"' : '';

							echo '<a '.wp_kses_post( $social_target.$social_nofollow ).' href="'.esc_url( $social_icon['icon_link']['url'] ).'">';

							echo esc_html( $social_icon['name'] );

							echo '</a> ';
						}
		            echo '</div>';
		        echo '</div>';
		        if( !empty( $settings['id'] ) ){
			        echo '<div class="scroll-down">';
			            echo '<a href="'.esc_attr( $settings['id'] ).'" class="hero-scroll-wrap"><i class="fal fa-long-arrow-left"></i>Scroll</a>';
			        echo '</div>';
			    }
		    echo '</div>';
		}elseif( $settings['layout_style'] == '2' ){

			echo '<div class="th-hero-wrapper hero-2" id="hero">';
		        echo '<div class="container">';
		            echo '<div class="swiper th-slider hero-slider1" id="heroSlide1" data-slider-options=\'{"effect":"fade","loop":false,"thumbs":{"swiper":".hero-grid-thumb"}}\'>';
		                echo '<div class="swiper-wrapper">';

		                	foreach( $settings['banners1'] as  $data ){
			                    echo '<div class="swiper-slide">';
			                        echo '<div class="hero-inner">';
			                            echo '<div class="row gx-60 gy-50">';
			                                echo '<div class="col-xl-5">';
			                                	if(!empty(  $data['background']['url'] )){
				                                    echo '<div class="hero-thumb2-1">';
				                                        echo '<img src="'.esc_url( $data['background']['url']  ).'" alt="img">';
				                                    echo '</div>';
				                                }
			                                echo '</div>';
			                                echo '<div class="col-xl-7">';
			                                    echo '<div class="hero-style2">';
			                                        echo '<h1 class="hero-title">';
			                                        	if(!empty($data['title'])){
				                                            echo '<span class="title1" data-ani="slideinup" data-ani-delay="0.4s">'.esc_html($data['title']).'</span>';
				                                        }
			                                            if(!empty($data['subtitle'])){    
				                                            echo '<span class="title2" data-ani="slideinup" data-ani-delay="0.5s">'.esc_html($data['subtitle']).'</span>';
				                                        }
			                                        echo '</h1>';
			                                        if(!empty($data['description'])){  
				                                        echo '<p class="hero-text" data-ani="slideinup" data-ani-delay="0.6s">'.esc_html($data['description']).'</p>';
				                                    }
				                                    if(!empty($data['button_text'])){  
				                                        echo '<div class="btn-wrap" data-ani="slideinup" data-ani-delay="0.7s">';
				                                            echo '<a href="'.esc_url( $data['button_url']['url'] ).'" class="th-btn style2 th-btn-icon">'.esc_html($data['button_text']).'</a>';

				                                        echo '</div>';
				                                    }
			                                    echo '</div>';
			                                echo '</div>';
			                            echo '</div>';
			                        echo '</div>';
			                    echo '</div>';
			                }
		                echo '</div>';
		            echo '</div>';

		            echo '<div class="row gx-60 justify-content-end">';
		                echo '<div class="col-xl-7">';
		                    echo '<div class="slider-area hero-slider-thumb-wrap">';
		                        echo '<div class="swiper th-slider hero-grid-thumb" data-slider-options=\'{"effect":"slide","loop":false,"slidesPerView":"3"}\'>';
		                            echo '<div class="swiper-wrapper">';
		                            	$i = 0;
		                            	foreach( $settings['banners1'] as  $data ){
		                            		$i++;
		                            		$k = str_pad($i, 2, '0', STR_PAD_LEFT);
			                                echo '<div class="swiper-slide">';
			                                    echo '<div class="box-img">';
			                                        echo '<img src="'. esc_url( $data['background']['url']  ).'" alt="Image">';
			                                        echo '<span class="slider-number">'.esc_html( $k ).'</span>';
			                                    echo '</div>';
			                                echo '</div>';
			                            }
		                            echo '</div>';
		                        echo '</div>';
		                        echo '<button data-slider-prev="#heroSlide1" class="slider-arrow style2"><img src="'.REALAR_PLUGDIRURI . 'assets/img/arrow-left.svg" alt="img"></button>';
		                        echo '<button data-slider-next="#heroSlide1" class="slider-arrow style2 slider-next"><img src="'.REALAR_PLUGDIRURI . 'assets/img/arrow-right.svg" alt="img"></button>';
		                    echo '</div>';
		                echo '</div>';
		            echo '</div>';
		        echo '</div>';
		        echo '<div class="about-tag">';
		        	if(!empty($settings['curve_text'])){  
			            echo '<div class="about-experience-tag">';
			                echo '<span class="circle-title-anime">'.esc_html( $settings['curve_text'] ).'</span>';
			            echo '</div>';
			        }
			        if(!empty(  $settings['image']['url'] )){
			            echo '<div class="about-tag-thumb">';
			                echo '<img src="'. esc_url( $settings['image']['url']  ).'" alt="img">';
			            echo '</div>';
			        }
		        echo '</div>';
		        if(!empty(  $settings['shape']['url'] )){
			        echo '<div class="hero-bg-shape2-1 spin shape-mockup" data-top="14%" data-left="1%">';
			            echo '<img src="'. esc_url( $settings['shape']['url']  ).'" alt="img">';
			        echo '</div>';
			    }
		    echo '</div>';
		}elseif( $settings['layout_style'] == '3' ){

			$bg = $settings['image']['url'] ?  $settings['image']['url'] : '#';
			$video_url = $settings['video_url'] ?  $settings['video_url'] : '#';

			echo '<div class="th-hero-wrapper hero-3" id="hero" data-bg-src="'.esc_url( $bg ).'">';
		        echo '<video class="hero-video" id="video" src="'.esc_url( $video_url ).'" loop="" muted="" autoplay=""></video>';
		        echo '<div class="container">';
		            echo '<div class="row gy-5 justify-content-center">';
		                echo '<div class="col-12">';
		                    echo '<div class="hero-style3 text-center">';
		                        echo '<div class="btn-wrap justify-content-center">';
		                        	foreach( $settings['buttons'] as  $data ){
			                            echo '<a href="'.esc_url($data['button_url']).'" class="th-btn style-border th-btn-icon">'.esc_html($data['button_text']).'</a>';
			                        }
		                            
		                        echo '</div>';
		                        if(!empty($settings['title'])){
			                        echo '<h1 class="hero-title text-white title2">'.esc_html($settings['title']).'</h1>';
			                    }
		                        echo '<div class="property-search-form-custom">';
		                            
		                        	echo do_shortcode( '[directorist_search_listing]' );
		                        echo '</div>';
		                        if( !empty( $settings['id'] ) ){
			                        echo '<div class="scroll-down">';
			                            echo '<a href="'.esc_attr( $settings['id'] ).'" class="hero-scroll-wrap"></a>';
			                        echo '</div>';
			                    }
		                    echo '</div>';
		                echo '</div>';
		            echo '</div>';
		        echo '</div>';
		    echo '</div>';
		}
	}
}