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
 * Team Widget .
 *
 */
class realar_Team extends Widget_Base {

	public function get_name() {
		return 'realarteam';
	}
	public function get_title() {
		return __( 'Team', 'realar' );
	}
	public function get_icon() {
		return 'th-icon';
    }
	public function get_categories() {
		return [ 'realar' ];
	}

	protected function register_controls() {

		$this->start_controls_section(
			'team_section',
			[
				'label'     => __( 'Team Content', 'realar' ),
				'tab'       => Controls_Manager::TAB_CONTENT,
			]
        );

		realar_select_field( $this, 'layout_style', 'Layout Style', [ 'Style One', 'Style Two', 'Style Three'] );

		// realar_general_fields( $this, 'arrow_id', 'Arrow ID', 'TEXT', 'teamSlider2', ['1'] );

		$fields_to_include = [ 'image' => ['Team Image'], 'title' => ['Name', 'Designation', 'Phone'], 'url' => ['Profile URL', 'Facebook URL', 'Twitter URL', 'Linkedin URL', 'Instagram URL','Youtube URL'] ];
		realar_repeater_fields( $this, 'team_lists', 'Member Lists', $fields_to_include, ['1','2','3']  );

		// $fields_to_include2 = [ 'image' => ['Team Image'], 'title' => ['Name', 'Designation'], 'desc' => ['Description', 'Info'],  'url' => ['Profile URL', 'Facebook URL', 'Twitter URL', 'Linkedin URL', 'Instagram URL'] ];
		// realar_repeater_fields( $this, 'team_lists2', 'Member Lists', $fields_to_include2, ['2'] );

		// $fields_to_include3 = [ 'image' => ['Team Image'], 'title' => ['Name', 'Designation'], 'desc' => ['Description'],  'url' => ['Profile URL', 'Facebook URL', 'Twitter URL', 'Linkedin URL', 'Instagram URL'] ];
		// realar_repeater_fields( $this, 'team_lists3', 'Member Lists', $fields_to_include3, ['4'] );

		realar_media_fields( $this, 'shape', 'Shape Image', ['1']);
		realar_media_fields( $this, 'phone_shape', 'Phone Image');
		realar_switcher_fields( $this, 'show_list', 'Show List?', ['2'] );

        $this->end_controls_section();

        //---------------------------------------
			//Style Section Start
		//---------------------------------------

		//-------Name Style-------
		realar_common_style_fields( $this, 'name', 'Name', '{{WRAPPER}} .title', ['1'], '--white-color' );
		realar_common_style_fields( $this, 'name2', 'Name', '{{WRAPPER}} .title a', ['2','3'] );
		//-------Designation Style-------
		realar_common_style_fields( $this, 'desig', 'Designation', '{{WRAPPER}} .desig', ['1'], '--white-color' );
		realar_common_style_fields( $this, 'desig2', 'Designation', '{{WRAPPER}} .desig', ['2','3'] );



		$this->start_controls_section(
			'general_styling',
			[
				'label'     => __( 'General', 'realar' ),
				'tab'       => Controls_Manager::TAB_STYLE,
			]
		);
		realar_color_fields( $this, 'bg', 'BG', '--gray-color', '{{WRAPPER}} .team-card-content', ['2']  );  
		realar_color_fields( $this, 'p_bg', 'Phone BG', '--title-dark', '{{WRAPPER}} .team-card.style2 .icon-btn', ['2']  );  

		$this->end_controls_section();




	}

	protected function render() {

        $settings = $this->get_settings_for_display();

			if( $settings['layout_style'] == '1' ){

				echo '<div class="swiper th-slider team-slider1" id="teamSlider1" data-slider-options=\'{"breakpoints":{"0":{"slidesPerView":1},"576":{"slidesPerView":"1"},"768":{"slidesPerView":"2"},"992":{"slidesPerView":"2"},"1200":{"slidesPerView":"3"}}}\'>';
	                echo '<div class="swiper-wrapper">';


	                    foreach( $settings['team_lists'] as $data ){

	                    	$target = $data['profile_url']['is_external'] ? ' target="_blank"' : '';
							$nofollow = $data['profile_url']['nofollow'] ? ' rel="nofollow"' : '';

							$f_target = $data['facebook_url']['is_external'] ? ' target="_blank"' : '';
							$f_nofollow = $data['facebook_url']['nofollow'] ? ' rel="nofollow"' : '';
							$t_target = $data['twitter_url']['is_external'] ? ' target="_blank"' : '';
							$t_nofollow = $data['twitter_url']['nofollow'] ? ' rel="nofollow"' : '';
							$l_target = $data['linkedin_url']['is_external'] ? ' target="_blank"' : '';
							$l_nofollow = $data['linkedin_url']['nofollow'] ? ' rel="nofollow"' : '';
							$i_target = $data['instagram_url']['is_external'] ? ' target="_blank"' : '';
							$i_nofollow = $data['instagram_url']['nofollow'] ? ' rel="nofollow"' : '';
							$y_target = $data['youtube_url']['is_external'] ? ' target="_blank"' : '';
							$y_nofollow = $data['youtube_url']['nofollow'] ? ' rel="nofollow"' : '';

		                    echo '<!-- Single Item -->';
		                    echo '<div class="swiper-slide">';
		                        echo '<div class="th-team team-card">';
		                        	$shape =  $settings['shape']['url'] ? $settings['shape']['url'] : ''.REALAR_PLUGDIRURI . 'assets/img/team-shape1.png';

		                        	if(!empty($data['team_image']['url'])){
			                            echo '<div class="img-wrap">';
			                                echo '<div class="team-img" data-mask-src="'.REALAR_PLUGDIRURI . 'assets/img/team-shape1.png">';
			                                    echo realar_img_tag( array(
													'url'   => esc_url( $data['team_image']['url']  ),
												));
			                                echo '</div>';
			                            echo '</div>';
			                        }
		                            echo '<div class="team-card-content">';
		                                echo '<div class="media">';
		                                    echo '<div class="media-left">';
		                                        if($data['name']){
													echo '<h3 class="box-title title"><a href="'.esc_url( $data['profile_url']['url'] ).'">'.esc_html($data['name']).'</a></h3>';
												}
		                                        if($data['designation']){
													echo '<span class="team-desig desig">'.esc_html($data['designation']).'</span>';
												}
		                                    echo '</div>';
		                                    if( $data['phone'] ){
			                                    echo '<div class="media-body">';
			                                        echo '<a class="icon-btn" href="tel:'.esc_attr( $data['phone'] ).'"><img src="'.esc_url( $settings['phone_shape']['url'] ).'" alt="img"></a>';
			                                    echo '</div>';
			                                }
		                                echo '</div>';
		                                echo '<div class="th-social">';
		                                    if( ! empty( $data['facebook_url']['url']) ){
												echo '<a '.wp_kses_post( $f_nofollow.$f_target ).' href="'.esc_url( $data['facebook_url']['url'] ).'"><i class="fab fa-facebook-f"></i></a>';
											}
		                                    if( ! empty( $data['twitter_url']['url']) ){
												echo '<a '.wp_kses_post( $t_nofollow.$t_target ).' href="'.esc_url( $data['twitter_url']['url'] ).'"><i class="fab fa-twitter"></i></a>';
											}
											if( ! empty( $data['linkedin_url']['url']) ){
												echo '<a '.wp_kses_post( $l_nofollow.$l_target ).' href="'.esc_url( $data['linkedin_url']['url'] ).'"><i class="fab fa-linkedin-in"></i></a>';
											}
											if( ! empty( $data['instagram_url']['url']) ){
												echo '<a '.wp_kses_post( $i_nofollow.$i_target ).' href="'.esc_url( $data['instagram_url']['url'] ).'"><i class="fab fa-instagram"></i></a>';
											}
											if( ! empty( $data['youtube_url']['url']) ){
												echo '<a '.wp_kses_post( $y_nofollow.$y_target ).' href="'.esc_url( $data['youtube_url']['url'] ).'"><i class="fab fa-youtube"></i></a>';
											}
		                                echo '</div>';
		                            echo '</div>';
		                        echo '</div>';
		                    echo '</div>';
		                }
	                echo '</div>';
	                echo '<div class="slider-pagination"></div>';
	                echo '<button data-slider-prev="#teamSlider1" class="slider-arrow slider-prev"><img src="'.REALAR_PLUGDIRURI . 'assets/img/arrow-left.svg" alt="icon"></button>';
	                echo '<button data-slider-next="#teamSlider1" class="slider-arrow slider-next"><img src="'.REALAR_PLUGDIRURI . 'assets/img/arrow-right.svg" alt="icon"></button>';
	            echo '</div>';
			}elseif( $settings['layout_style'] == '2' ){
				echo '<div class="slider-area team-slider2">';
					if($settings['show_list'] == 'yes'){
	                echo '<div class="swiper th-slider" id="teamSlider2" data-slider-options=\'{"breakpoints":{"0":{"slidesPerView":1},"576":{"slidesPerView":"1"},"768":{"slidesPerView":"2"},"992":{"slidesPerView":"3"},"1200":{"slidesPerView":"3"}}}\'>';
	                    echo '<div class="swiper-wrapper">';
	                }
	                else{
	                	echo '<div class="row gy-30">';
	                	
	                }
	                    	foreach( $settings['team_lists'] as $data ){

		                    	$target = $data['profile_url']['is_external'] ? ' target="_blank"' : '';
								$nofollow = $data['profile_url']['nofollow'] ? ' rel="nofollow"' : '';

								$f_target = $data['facebook_url']['is_external'] ? ' target="_blank"' : '';
								$f_nofollow = $data['facebook_url']['nofollow'] ? ' rel="nofollow"' : '';
								$t_target = $data['twitter_url']['is_external'] ? ' target="_blank"' : '';
								$t_nofollow = $data['twitter_url']['nofollow'] ? ' rel="nofollow"' : '';
								$l_target = $data['linkedin_url']['is_external'] ? ' target="_blank"' : '';
								$l_nofollow = $data['linkedin_url']['nofollow'] ? ' rel="nofollow"' : '';
								$i_target = $data['instagram_url']['is_external'] ? ' target="_blank"' : '';
								$i_nofollow = $data['instagram_url']['nofollow'] ? ' rel="nofollow"' : '';
								$y_target = $data['youtube_url']['is_external'] ? ' target="_blank"' : '';
								$y_nofollow = $data['youtube_url']['nofollow'] ? ' rel="nofollow"' : '';
		                        
		                        echo '<!-- Single Item -->';
		                        if($settings['show_list'] == 'yes'){
		                        	echo '<div class="swiper-slide">';
		                        }else{
		                        	echo '<div class="col-lg-4 col-md-6">';
		                        }
		                            echo '<div class="th-team team-card style2">';
		                                echo '<div class="img-wrap">';
		                                	if(!empty($data['team_image']['url'])){
			                                    echo '<div class="team-img">';
			                                        echo realar_img_tag( array(
														'url'   => esc_url( $data['team_image']['url']  ),
													));
			                                    echo '</div>';
			                                }
		                                    echo '<div class="th-social-wrap">';
		                                        echo '<div class="th-social">';
		                                            if( ! empty( $data['facebook_url']['url']) ){
														echo '<a '.wp_kses_post( $f_nofollow.$f_target ).' href="'.esc_url( $data['facebook_url']['url'] ).'"><i class="fab fa-facebook-f"></i></a>';
													}
				                                    if( ! empty( $data['twitter_url']['url']) ){
														echo '<a '.wp_kses_post( $t_nofollow.$t_target ).' href="'.esc_url( $data['twitter_url']['url'] ).'"><i class="fab fa-twitter"></i></a>';
													}
													if( ! empty( $data['linkedin_url']['url']) ){
														echo '<a '.wp_kses_post( $l_nofollow.$l_target ).' href="'.esc_url( $data['linkedin_url']['url'] ).'"><i class="fab fa-linkedin-in"></i></a>';
													}
													if( ! empty( $data['instagram_url']['url']) ){
														echo '<a '.wp_kses_post( $i_nofollow.$i_target ).' href="'.esc_url( $data['instagram_url']['url'] ).'"><i class="fab fa-instagram"></i></a>';
													}
													if( ! empty( $data['youtube_url']['url']) ){
														echo '<a '.wp_kses_post( $y_nofollow.$y_target ).' href="'.esc_url( $data['youtube_url']['url'] ).'"><i class="fab fa-youtube"></i></a>';
													}
		                                        echo '</div>';
		                                        echo '<a class="icon-btn" href="'.esc_url( $data['profile_url']['url'] ).'"><img src="'.REALAR_PLUGDIRURI . 'assets/img/arrow-right.svg" alt="img"></a>';
		                                    echo '</div>';
		                                echo '</div>';
		                                echo '<div class="team-card-content">';
		                                    echo '<div class="media-left">';
		                                        if($data['name']){
													echo '<h3 class="box-title title"><a href="'.esc_url( $data['profile_url']['url'] ).'">'.esc_html($data['name']).'</a></h3>';
												}
		                                        if($data['designation']){
													echo '<span class="team-desig desig">'.esc_html($data['designation']).'</span>';
												}
		                                    echo '</div>';
		                                    if( $data['phone'] ){

			                                    echo '<a class="icon-btn" href="tel:'.esc_attr( $data['phone'] ).'"><img src="'.esc_url( $settings['phone_shape']['url'] ).'" alt="img"></a>';
			                                }
		                                echo '</div>';
		                            echo '</div>';
		                        echo '</div>';
		                    }
	                    echo '</div>';
	                if($settings['show_list'] == 'yes'){
		                echo '</div>';
		            }
		            if($settings['show_list'] == 'yes'){
		                echo '<button data-slider-prev="#teamSlider2" class="slider-arrow slider-prev"><img src="'.REALAR_PLUGDIRURI . 'assets/img/arrow-left.svg" alt=""></button>';
		                echo '<button data-slider-next="#teamSlider2" class="slider-arrow slider-next"><img src="'.REALAR_PLUGDIRURI . 'assets/img/arrow-right.svg" alt=""></button>';
		            }
	            echo '</div>';
			}elseif( $settings['layout_style'] == '3' ){
				echo '<div class="slider-area team-slider2">';
	                echo '<div class="swiper th-slider slider-drag-wrap" id="teamSlider3" data-slider-options=\'{"breakpoints":{"0":{"slidesPerView":1},"576":{"slidesPerView":"1"},"768":{"slidesPerView":"2"},"992":{"slidesPerView":"3"},"1400":{"slidesPerView":"4"}},"grabCursor":"true"}\'>';
	                    echo '<div class="swiper-wrapper">';
	                    	foreach( $settings['team_lists'] as $data ){

		                    	$target = $data['profile_url']['is_external'] ? ' target="_blank"' : '';
								$nofollow = $data['profile_url']['nofollow'] ? ' rel="nofollow"' : '';

								$f_target = $data['facebook_url']['is_external'] ? ' target="_blank"' : '';
								$f_nofollow = $data['facebook_url']['nofollow'] ? ' rel="nofollow"' : '';
								$t_target = $data['twitter_url']['is_external'] ? ' target="_blank"' : '';
								$t_nofollow = $data['twitter_url']['nofollow'] ? ' rel="nofollow"' : '';
								$l_target = $data['linkedin_url']['is_external'] ? ' target="_blank"' : '';
								$l_nofollow = $data['linkedin_url']['nofollow'] ? ' rel="nofollow"' : '';
								$i_target = $data['instagram_url']['is_external'] ? ' target="_blank"' : '';
								$i_nofollow = $data['instagram_url']['nofollow'] ? ' rel="nofollow"' : '';
								$y_target = $data['youtube_url']['is_external'] ? ' target="_blank"' : '';
								$y_nofollow = $data['youtube_url']['nofollow'] ? ' rel="nofollow"' : '';
		                        
		                        echo '<!-- Single Item -->';
		                        echo '<div class="swiper-slide">';
		                            echo '<div class="th-team team-card style3">';
		                                echo '<div class="img-wrap">';
		                                	if(!empty($data['team_image']['url'])){
			                                    echo '<div class="team-img">';
			                                        echo realar_img_tag( array(
														'url'   => esc_url( $data['team_image']['url']  ),
													));
			                                    echo '</div>';
			                                }
		                                    echo '<div class="th-social-wrap">';
		                                        echo '<div class="th-social">';
		                                            if( ! empty( $data['facebook_url']['url']) ){
														echo '<a '.wp_kses_post( $f_nofollow.$f_target ).' href="'.esc_url( $data['facebook_url']['url'] ).'"><i class="fab fa-facebook-f"></i></a>';
													}
				                                    if( ! empty( $data['twitter_url']['url']) ){
														echo '<a '.wp_kses_post( $t_nofollow.$t_target ).' href="'.esc_url( $data['twitter_url']['url'] ).'"><i class="fab fa-twitter"></i></a>';
													}
													if( ! empty( $data['linkedin_url']['url']) ){
														echo '<a '.wp_kses_post( $l_nofollow.$l_target ).' href="'.esc_url( $data['linkedin_url']['url'] ).'"><i class="fab fa-linkedin-in"></i></a>';
													}
													if( ! empty( $data['instagram_url']['url']) ){
														echo '<a '.wp_kses_post( $i_nofollow.$i_target ).' href="'.esc_url( $data['instagram_url']['url'] ).'"><i class="fab fa-instagram"></i></a>';
													}
													if( ! empty( $data['youtube_url']['url']) ){
														echo '<a '.wp_kses_post( $y_nofollow.$y_target ).' href="'.esc_url( $data['youtube_url']['url'] ).'"><i class="fab fa-youtube"></i></a>';
													}
		                                        echo '</div>';
		                                        echo '<a class="icon-btn" href="'.esc_url( $data['profile_url']['url'] ).'"><img src="'.REALAR_PLUGDIRURI . 'assets/img/arrow-right.svg" alt="img"></a>';
		                                    echo '</div>';
		                                echo '</div>';
		                                echo '<div class="team-card-content">';
		                                    echo '<div class="media-left">';
		                                        if($data['name']){
													echo '<h3 class="box-title title"><a href="'.esc_url( $data['profile_url']['url'] ).'">'.esc_html($data['name']).'</a></h3>';
												}
		                                        if($data['designation']){
													echo '<span class="team-desig desig">'.esc_html($data['designation']).'</span>';
												}
		                                    echo '</div>';
		                                    if( $data['phone'] ){

			                                    echo '<a class="icon-btn" href="tel:'.esc_attr( $data['phone'] ).'"><img src="'.esc_url( $settings['phone_shape']['url'] ).'" alt="img"></a>';
			                                }
		                                echo '</div>';
		                            echo '</div>';
		                        echo '</div>';
		                    }
	                    echo '</div>';
	                echo '</div>';
	                // echo '<button data-slider-prev="#teamSlider2" class="slider-arrow slider-prev"><img src="'.REALAR_PLUGDIRURI . 'assets/img/arrow-left.svg" alt=""></button>';
	                // echo '<button data-slider-next="#teamSlider2" class="slider-arrow slider-next"><img src="'.REALAR_PLUGDIRURI . 'assets/img/arrow-right.svg" alt=""></button>';
	            echo '</div>';	

			}
	}
}