<?php
use \Elementor\Widget_Base;
use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Typography;
use \Elementor\Utils;
use \Elementor\Repeater;
use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Image_Size;
/**
 *
 * Team Info Widget
 *
 */
class realar_Team_info extends Widget_Base{

	public function get_name() {
		return 'realarteaminfo';
	}
	public function get_title() {
		return esc_html__( 'Team Member Info', 'realar' );
	}
	public function get_icon() {
		return 'th-icon';
    }
	public function get_categories() {
		return [ 'realar' ];
	}

	protected function register_controls() {

		$this->start_controls_section(
			'team_member_content',
			[
				'label'		=> esc_html__( 'Member Info','realar' ),
				'tab'		=> Controls_Manager::TAB_CONTENT,
			]
		);

		realar_select_field( $this, 'layout_style', 'Layout Style',['Style One'] );

		realar_media_fields( $this, 'image', 'Choose Image' );
		realar_general_fields($this, 'name', 'Member Name', 'TEXT', 'Jonson Anderson');
		realar_general_fields($this, 'designation', 'Designation', 'TEXT', 'Designation');

		realar_media_fields( $this, 'phone_shape', 'Phone Image');
		realar_general_fields($this, 'phone', 'Phone', 'TEXT', 'J1122');

		realar_social_fields($this, 'social_icon_list', 'Social Media');

		$this->end_controls_section();

        //---------------------------------------
			//Style Section Start
		//---------------------------------------

		//-------Name Style-------
		realar_common_style_fields( $this, 'name', 'Name', '{{WRAPPER}} .name' );
		//-------Designation Style-------
		realar_common_style_fields( $this, 'designation', 'Designation', '{{WRAPPER}} .team-about_desig' );
		//-------Description Style-------


	}

	protected function render() {

	$settings = $this->get_settings_for_display(); 

		if( $settings['layout_style'] == '1' ){
			echo '<div class="th-team team-card style4">';
                echo '<div class="img-wrap">';
                	if(!empty($settings['image']['url'])){
	                    echo '<div class="team-img">';
	                        echo realar_img_tag( array(
								'url'   => esc_url( $settings['image']['url'] ),
							));
	                    echo '</div>';
	                }
                    echo '<div class="th-social-wrap">';
                        echo '<div class="th-social">';
                            foreach( $settings['social_icon_list'] as $social_icon ){
								$social_target    = $social_icon['icon_link']['is_external'] ? ' target="_blank"' : '';
								$social_nofollow  = $social_icon['icon_link']['nofollow'] ? ' rel="nofollow"' : '';
								echo '<a '.wp_kses_post( $social_target.$social_nofollow ).' href="'.esc_url( $social_icon['icon_link']['url'] ).'">';
								\Elementor\Icons_Manager::render_icon( $social_icon['social_icon'], [ 'aria-hidden' => 'true' ] );
								echo '</a> ';
							}
                        echo '</div>';
                    echo '</div>';
                echo '</div>';
                echo '<div class="team-card-content">';
                    echo '<div class="media-left">';
                    	if(!empty($settings['name'])){
	                        echo '<h3 class="box-title name">'.esc_html($settings['name']).'</h3>';
	                    }
	                    if(!empty($settings['designation'])){
	                        echo '<span class="team-desig team-about_desig">'.esc_html($settings['designation']).'</span>';
	                    }
                    echo '</div>';
                    if( $settings['phone'] ){
	                    echo '<a class="icon-btn" href="tel:'.esc_attr( $settings['phone'] ).'"><img src="'.esc_url( $settings['phone_shape']['url'] ).'" alt="img"></a>';
	                }
               echo ' </div>';
            echo '</div>';
		}
	}
}