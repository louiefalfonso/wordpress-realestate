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
 * Project Widget .
 *
 */
class realar_Project extends Widget_Base {

	public function get_name() {
		return 'realarproject';
	}
	public function get_title() {
		return __( 'Projects', 'realar' );
	}
	public function get_icon() {
		return 'th-icon';
    }
	public function get_categories() {
		return [ 'realar' ];
	}

	protected function register_controls() {

		 $this->start_controls_section(
			'project_section',
			[
				'label'		 	=> __( 'Projects', 'realar' ),
				'tab' 			=> Controls_Manager::TAB_CONTENT,
			]
        );

		realar_select_field( $this, 'layout_style', 'Layout Style',[ 'Style One', 'Style Two', 'Style Three' ] );

		realar_general_fields( $this, 'title', 'Section Title', 'TEXT', 'Projects', [ '1' ] );
		realar_general_fields( $this, 'subtitle', 'Section Subtitle', 'TEXT', 'Subtitle', [ '1'] );
		realar_general_fields( $this, 'desc', 'Section Description', 'TEXTAREA', 'Description', [ '1'] );

		realar_general_fields($this, 'button_text', 'Button Text', 'TEXT', 'Button Text', [ '1' ]);
		realar_url_fields($this, 'button_url', 'Button URL', [ '1' ]);

		//------------------------------------------style-1------------------------------------------//
		$repeater = new Repeater();

		$repeater->add_control(
			'image',
			[
				'label' 		=> __( 'Image', 'realar' ),
				'type' 			=> Controls_Manager::MEDIA,
				'dynamic' 		=> [
					'active' 		=> true,
				],
				'default' 		=> [
					'url' 			=> Utils::get_placeholder_image_src(),
				],
			]
		);
        $repeater->add_control(
			'realar_single_project_option',
			[
				'label'     => __( 'Chose Single Page', 'realar' ),
				'type'      => Controls_Manager::SELECT,
				'options'   => $this->realar_service_choose_option(),
				'default'	=> ''
			]
		);
        
        
		$this->add_control(
			'slides',
			[
				'label' 		=> __( 'Projects', 'realar' ),
				'type' 			=> Controls_Manager::REPEATER,
				'fields' 		=> $repeater->get_controls(),
				'condition'	=> [
                    'layout_style' => ['1']
                ]
			]
		);
		//------------------------------------------style-2------------------------------------------//
		$repeater2 = new Repeater();

		$repeater2->add_control(
			'p_image',
			[
				'label' 		=> __( 'Image', 'realar' ),
				'type' 			=> Controls_Manager::MEDIA,
				'dynamic' 		=> [
					'active' 		=> true,
				],
				'default' 		=> [
					'url' 			=> Utils::get_placeholder_image_src(),
				],
			]
		);
		$repeater2->add_control(
			'p_title',
			[
				'label' 	=> __( 'Title', 'realar' ),
                'type' 		=> Controls_Manager::TEXTAREA,
                'rows' 		=> 2,
                'default'  	=> __( 'Section Subtitle', 'realar' ),
			]
        );
        $repeater2->add_control(
			'p_desc',
			[
				'label' 	=> __( 'Description', 'realar' ),
                'type' 		=> Controls_Manager::TEXTAREA,
                'rows' 		=> 4,
                'default'  	=> __( 'Section Subtitle', 'realar' ),
			]
        );
        $repeater2->add_control(
			'p_realar_single_project_option',
			[
				'label'     => __( 'Chose Single Page', 'realar' ),
				'type'      => Controls_Manager::SELECT,
				'options'   => $this->realar_service_choose_option(),
				'default'	=> ''
			]
		);
		$repeater2->add_control(
			'p_url',
			[
				'label' 	=> __( 'Details Page url', 'realar' ),
                'type' 		=> Controls_Manager::TEXTAREA,
                'rows' 		=> 2,
                'default'  	=> __( '#', 'realar' ),
			]
        );
        
        
		$this->add_control(
			'slides2',
			[
				'label' 		=> __( 'Projects', 'realar' ),
				'type' 			=> Controls_Manager::REPEATER,
				'fields' 		=> $repeater2->get_controls(),
				'condition'	=> [
                    'layout_style' => ['2']
                ]
			]
		);

		$fields_to_include = [ 'image' => ['Choose Image'], 'title' => [ 'Title', 'Description'], 'url' => ['URL'] ];
		realar_repeater_fields( $this, 'project_lists', 'Project Lists', $fields_to_include, ['3'] );

		$this->add_control(
			'shape_image',
			[
				'label' 		=> __( 'Shape Image', 'realar' ),
				'type' 			=> Controls_Manager::MEDIA,
				'dynamic' 		=> [
					'active' 		=> true,
				],
				'default' 		=> [
					'url' 			=> Utils::get_placeholder_image_src(),
				],
				'condition'	=> [
                    'layout_style' => ['1','2']
                ]
			]
		);


		

        $this->end_controls_section();

        //---------------------------------------
			//Style Section Start
		//---------------------------------------
		
		//-------Title Style-------
		realar_common2_style_fields( $this, 'title', 'Title', '{{WRAPPER}} .sec-title,{{WRAPPER}} .th_i_title',['1','2'],'--white-color' );
		realar_common_style_fields( $this, 'desc', 'Description', '{{WRAPPER}} .sec-text,{{WRAPPER}} .th_i_desc',['1','2'],'--white-color');
		//-------Description Style-------
		

		realar_common2_style_fields( $this, 'title2', 'Title', '{{WRAPPER}} .th_i_title a',['3'] );
		realar_common_style_fields( $this, 'desc2', 'Description', '{{WRAPPER}} .th_i_desc',['3'] );

		realar_button_style_fields($this, '11', 'Button Styling', '{{WRAPPER}} .th-btn', ['1']);

	}


	public function realar_service_choose_option(){

		$realar_post_query = new WP_Query( array(
			'post_type'				=> 'realar_project',
			'posts_per_page'	    => -1,
		) );

		$realar_service_title = array();
		$realar_service_title[''] = __( 'Select a Project','realar');

		while( $realar_post_query->have_posts() ) {
			$realar_post_query->the_post();
			$realar_service_title[ get_the_ID() ] =  get_the_title();
		}
		wp_reset_postdata();

		return $realar_service_title;

	}

	protected function render() {

	$settings = $this->get_settings_for_display();

		if( $settings['layout_style'] == '1' ){
			echo '<section class="project-area-1 space overflow-hidden">';
		        echo '<div class="container">';
		            echo '<div class="project-wrap1">';
		                echo '<div class="project-number-pagination" data-slider-tab="#projectSlider1">';
		                   	$k = 0;
							foreach( $settings['slides'] as $single_data ){
								$k++;
								$j = str_pad($k, 2, '0', STR_PAD_LEFT);

								$active_class = $k == 1 ? 'active' : '';

			                    echo '<div class="tab-btn '.esc_attr( $active_class ).'">';
			                        echo '<span>'.esc_html( $j ).'</span>';
			                    echo '</div>';
			                }
		                    
		                echo '</div>';
		                echo '<div class="row gy-50 justify-content-between align-items-center">';
		                    echo '<div class="col-xxl-5 col-xl-6">';
		                        echo '<div class="project-title-wrap1">';
		                            echo '<div class="title-area mb-40">';
		                                if(!empty( $settings['title'] )){
			                                echo '<span class="shadow-title">'.esc_html( $settings['title'] ).'</span>';
			                            }
			                            if(!empty( $settings['subtitle'] )){
			                                echo '<h2 class="sec-title text-white">'.esc_html( $settings['subtitle'] ).'</h2>';
			                            }
			                            if(!empty( $settings['desc'] )){
			                                echo '<p class="sec-text text-white mt-15">'.esc_html( $settings['desc'] ).'</p>';
			                            }
		                            echo '</div>';
		                            echo '<div class="btn-wrap">';
		                            	if( ! empty( $settings['button_text'] ) ) {
				                            echo '<a href="'.esc_url( $settings['button_url']['url'] ).'" class="th-btn btn-mask th-btn-icon">'.esc_html( $settings['button_text'] ).'</a>';
				                        }
		                            echo '</div>';
		                        echo '</div>';
		                    echo '</div>';
		                    echo '<div class="col-xl-6">';
		                        echo '<div class="slider-area project-slider-area">';
		                            echo '<div class="swiper th-slider project-slider1" id="projectSlider1" data-slider-options=\'{"breakpoints":{"0":{"slidesPerView":1},"576":{"slidesPerView":"1"},"768":{"slidesPerView":"1"},"992":{"slidesPerView":"1"},"1200":{"slidesPerView":"1"}},"loop":false, "thumbs":{"swiper":".project-number-pagination"}}\'>';
		                                echo '<div class="swiper-wrapper">';

		                                	$k = 0;
											foreach( $settings['slides'] as $single_data ){
												$k++;

												if(!empty($single_data['image']['url'])){
				                                    echo '<div class="swiper-slide">';
				                                        echo '<div class="portfolio-card">';
				                                            echo '<div class="portfolio-img img-shine" data-mask-src="'.REALAR_PLUGDIRURI . 'assets/img/project-card1-img-mask.png" data-bs-toggle="modal" data-bs-target="#portfolioModal'.esc_attr( $k ).'">';
				                                                echo '<img src="'.esc_url( $single_data['image']['url'] ).'" alt="project image">';
				                                                if(!empty($settings['shape_image']['url'])){
					                                                echo '<div class="portfolio-card-shape" data-mask-src="'.REALAR_PLUGDIRURI . 'assets/img/project-card1-img-mask.png">';
					                                                    echo '<img src="'.esc_url( $settings['shape_image']['url'] ).'" alt="img">';
					                                                echo '</div>';
					                                            }
				                                            echo '</div>';
				                                            echo '<div class="portfolio-content">';
				                                                echo '<a href="#portfolioModal'.esc_attr( $k ).'" data-bs-toggle="modal" data-bs-target="#portfolioModal'.esc_attr( $k ).'" class="icon-btn"><img src="'.REALAR_PLUGDIRURI . 'assets/img/arrow-right.svg" alt="img"></a>';
				                                            echo '</div>';
				                                        echo '</div>';
				                                    echo '</div>';
				                                }
				                            }

		                                    

		                                echo '</div>';
		                                echo '<div class="slider-pagination d-sm-block d-none"></div>';
		                            echo '</div>';
		                        echo '</div>';
		                    echo '</div>';
		                echo '</div>';
		            echo '</div>';
		        echo '</div>';
		    echo '</section>';

		    $k = 0;
			foreach( $settings['slides'] as $single_data ){
				$k++;
			    echo '<div class="th-modal modal fade" id="portfolioModal'.esc_attr( $k ).'" tabindex="-1" aria-hidden="true">';
			        echo '<div class="modal-dialog modal-xl">';
			            echo '<div class="modal-content">';
			                echo '<div class="container">';
			                    echo '<button type="button" class="icon-btn btn-close bg-title-dark" data-bs-dismiss="modal" aria-label="Close"><i class="fa-regular fa-xmark"></i></button>';
			                    echo '<div class="page-single bg-theme">';
			                        
			                        $elementor = \Elementor\Plugin::instance();
									if( ! empty( $single_data['realar_single_project_option'] ) ){
									    echo $elementor->frontend->get_builder_content_for_display( $single_data['realar_single_project_option'] );
									}


			                        
			                    echo '</div>';
			                echo '</div>';
			            echo '</div>';
			        echo '</div>';
			    echo '</div>';
			}
		}elseif( $settings['layout_style'] == '2' ){
			echo '<section class="overflow-hidden">';
			echo '<div class="container-fluid p-0">';
				echo '<div class="slider-area project-slider2">';
	                echo '<div class="swiper th-slider" id="projectSlider2" data-slider-options=\'{"breakpoints":{"0":{"slidesPerView":1},"576":{"slidesPerView":"1"},"768":{"slidesPerView":"2"},"992":{"slidesPerView":"3"},"1200":{"slidesPerView":"3"}}}\'>';
	                    echo '<div class="swiper-wrapper">';
	                    	$k = 0;
	                        foreach( $settings['slides2'] as $single_data ){
	                        	$k++;

		                        echo '<div class="swiper-slide">';
		                            echo '<div class="portfolio-card style2">';
		                                echo '<div class="portfolio-img img-shine" data-bs-toggle="modal" data-bs-target="#portfolioModal'.esc_attr( $k ).'">';
		                                    echo '<img src="'.esc_url( $single_data['p_image']['url'] ).'" alt="project image">';
		                                    echo '<div class="portfolio-card-shape">';
		                                        echo '<img src="'.esc_url( $settings['shape_image']['url'] ).'" alt="img">';
		                                    echo '</div>';
		                                echo '</div>';
		                                echo '<div class="portfolio-content">';


		                                	$modal_url = '#portfolioModal'.esc_attr( $k );

		                                	$url = $single_data['p_url']  ? $single_data['p_url'] : '#' ;

		                                	if(!empty( $single_data['p_title'] )){


		                                		
				                               	echo '<h3 class="portfolio-title th_i_title"><a href="'.esc_url( $url ).'">'.esc_html( $single_data['p_title'] ).'</a></h3>';
				                                
			                                }
			                                if(!empty( $single_data['p_desc'] )){
			                                    echo '<p class="portfolio-text th_i_desc">'.esc_html( $single_data['p_desc'] ).'</p>';
			                                }
		                                echo '</div>';
		                            echo '</div>';
		                        echo '</div>';
		                    } 
	                    echo '</div>';
	                echo '</div>';
	                echo '<button data-slider-prev="#projectSlider2" class="slider-arrow slider-prev"><img src="'.REALAR_PLUGDIRURI . 'assets/img/arrow-left.svg" alt="img"></button>';
	            echo '</div>';
            echo '</div>';
            echo '</section>';

            $k = 0;
			foreach( $settings['slides2'] as $single_data ){
				$k++;
			    echo '<div class="th-modal modal fade" id="portfolioModal'.esc_attr( $k ).'" tabindex="-1" aria-hidden="true">';
			        echo '<div class="modal-dialog modal-xl">';
			            echo '<div class="modal-content">';
			                echo '<div class="container">';
			                    echo '<button type="button" class="icon-btn btn-close bg-title-dark" data-bs-dismiss="modal" aria-label="Close"><i class="fa-regular fa-xmark"></i></button>';
			                    echo '<div class="page-single bg-theme">';
			                        
			                        $elementor = \Elementor\Plugin::instance();
									if( ! empty( $single_data['p_realar_single_project_option'] ) ){
									    echo $elementor->frontend->get_builder_content_for_display( $single_data['p_realar_single_project_option'] );
									}
			                    echo '</div>';
			                echo '</div>';
			            echo '</div>';
			        echo '</div>';
			    echo '</div>';
			}
		}elseif( $settings['layout_style'] == '3' ){

			echo '<div class="slider-area">';
                echo '<div class="swiper th-slider slider-drag-wrap" id="projectSlider3" data-slider-options=\'{"breakpoints":{"0":{"slidesPerView":1},"576":{"slidesPerView":"1"},"768":{"slidesPerView":"2"},"992":{"slidesPerView":"3"},"1400":{"slidesPerView":"4"}}}\'>';
                    echo '<div class="swiper-wrapper">';


                        foreach( $settings['project_lists'] as $data ){
	                        echo '<div class="swiper-slide">';
	                            echo '<div class="portfolio-card style3">';
	                            	if(!empty($data['choose_image']['url'])){
		                                echo '<div class="portfolio-img">';
		                                    echo realar_img_tag( array(
												'url'   => esc_url( $data['choose_image']['url'] ),
											));
		                                    echo '<a href="'.esc_url( $data['url']['url'] ).'" class="icon-btn">';
		                                        echo '<div class="icon">';
		                                            echo '<img src="'.REALAR_PLUGDIRURI . 'assets/img/arrow-right.svg" alt="img">';
		                                        echo '</div>';
		                                    echo '</a>';
		                                echo '</div>';
		                            }
	                                echo '<div class="portfolio-content">';
	                                	if(!empty($data['title'])){
		                                    echo '<h3 class="portfolio-title th_i_title"><a href="'.esc_url( $data['url']['url'] ).'">'.esc_html($data['title']).'</a></h3>';
		                                }
		                                if(!empty($data['description'])){
		                                    echo '<p class="portfolio-text th_i_desc">'.esc_html($data['description']).'</p>';
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