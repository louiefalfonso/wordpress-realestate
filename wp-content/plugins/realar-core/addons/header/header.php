<?php

use \Elementor\Widget_Base;
use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Typography;
use \Elementor\Repeater;
use \Elementor\Utils;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Text_Shadow;
use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Box_Shadow;
/**
 *
 * Header Widget . 
 *
 */
class Realar_Header extends Widget_Base {

	public function get_name() {
		return 'realarheader';
	}
	public function get_title() {
		return __( 'Header', 'realar' );
	}
	public function get_icon() {
		return 'th-icon';
    }
	public function get_categories() {
		return [ 'realar_header_elements' ];
	}

	protected function register_controls() {

		$this->start_controls_section(
			'layout_section',
			[
				'label' 	=> __( 'Header', 'realar' ),
				'tab' 		=> Controls_Manager::TAB_CONTENT,
			]
        );

		realar_select_field( $this, 'layout_style', 'Layout Style',['Style One','Style Two'] );

		

		$this->add_control(
			'logo_image',

			[
				'label' 		=> __( 'Upload Logo', 'realar' ),
				'type' 			=> Controls_Manager::MEDIA,
			]
		);				

		$menus = $this->realar_menu_select();

		if( !empty( $menus ) ){
	        $this->add_control(
				'realar_menu_select',
				[
					'label'     	=> __( 'Select realar Menu', 'realar' ),
					'type'      	=> Controls_Manager::SELECT,
					'options'   	=> $menus,
					'description' 	=> sprintf( __( 'Go to the <a href="%s" target="_blank">Menus screen</a> to manage your menus.', 'realar' ), admin_url( 'nav-menus.php' ) ),
				]
			);
		}else {
			$this->add_control(
				'no_menu',
				[
					'type' 				=> Controls_Manager::RAW_HTML,
					'raw' 				=> '<strong>' . __( 'There are no menus in your site.', 'realar' ) . '</strong><br>' . sprintf( __( 'Go to the <a href="%s" target="_blank">Menus screen</a> to create one.', 'realar' ), admin_url( 'nav-menus.php?action=edit&menu=0' ) ),
					'separator' 		=> 'after',
					'content_classes' 	=> 'elementor-panel-alert elementor-panel-alert-info',
				]
			);
		}
	
		$this->add_control(
			'show_offcanvas_btn',
			[
				'label' 		=> __( 'Show Offcanvas Button?', 'realar' ),
				'type' 			=> Controls_Manager::SWITCHER,
				'label_on' 		=> __( 'Show', 'realar' ),
				'label_off' 	=> __( 'Hide', 'realar' ),
				'return_value' 	=> 'yes',
				'default' 		=> 'yes',
			]
		);

		$this->add_control(
			'button_text',
			[
				'label' 		=> __( 'Button Text', 'realar' ),
				'type' 			=> Controls_Manager::TEXT,
				'label_block' 	=> true,
				'default' 	=> __( 'Contact Us', 'realar' ),
			]
		);

		$this->add_control(
			'button_url',
			[
				'label' 		=> esc_html__( 'Button Link', 'realar' ),
				'type' 			=> Controls_Manager::URL,
				'placeholder' 	=> esc_html__( 'https://your-link.com', 'realar' ),
				'show_external' => true,
				'default' 		=> [
					'url' 			=> '#',
					'is_external' 	=> false,
					'nofollow' 		=> false,
				],
			]
		);

        $this->end_controls_section();

		//---------------------------------------
			//Style Section Start
		//---------------------------------------

		//-------General Style-------
		 $this->start_controls_section(
			'general_styling',
			[
				'label'     => __( 'Background Styling', 'realar' ),
				'tab'       => Controls_Manager::TAB_STYLE,
			]
        );


		realar_color_fields( $this, 'menu_bg', 'Background', 'background', '{{WRAPPER}} .header-layout-control, {{WRAPPER}} .header-layout-control .sticky-wrapper', ['1','2'] );         
      
       

		$this->end_controls_section();

		//------Menu Bar Style-------
        $this->start_controls_section(
			'menubar_styling2',
			[
				'label'     => __( 'Menu Styling', 'realar' ),
				'tab'       => Controls_Manager::TAB_STYLE,
			]
        );

		realar_color_fields( $this, 'menu_color1', 'Color', 'color', '{{WRAPPER}} .main-menu>ul>li>a', ['1','2'] );
		realar_color_fields( $this, 'menu_color2', 'Hover Color', 'color', '{{WRAPPER}} .main-menu>ul>li>a:hover', ['1','2'] );
		realar_color_fields( $this, 'menu_color3', 'Dropdown Color', 'color', '{{WRAPPER}} .main-menu ul.sub-menu li a' );
		realar_color_fields( $this, 'menu_color4', 'Dropdown Hover Color', 'color', '{{WRAPPER}} .main-menu ul.sub-menu li a:hover' );
		realar_color_fields( $this, 'menu_color5', 'Menu Icon Color', 'color', '{{WRAPPER}} .main-menu ul.sub-menu li a:before, {{WRAPPER}} .main-menu ul li.menu-item-has-children > a:after' );

		realar_typography_fields( $this, 'menu_font', 'Menu Trpography', '{{WRAPPER}} .main-menu>ul>li>a, {{WRAPPER}} .main-menu ul.sub-menu li a' );

		realar_dimensions_fields( $this, 'menu_margin', 'Menu Margin', 'margin', '{{WRAPPER}} .main-menu>ul>li>a' );
		realar_dimensions_fields( $this, 'menu_padding', 'Menu Padding', 'padding', '{{WRAPPER}} .main-menu>ul>li>a' );

		$this->end_controls_section();

		//------Button Style-------
		realar_button_style_fields( $this, '12', 'Button Styling', '{{WRAPPER}} .btn-mask, {{WRAPPER}} .th-btn' );

    }

    public function realar_menu_select(){
	    $realar_menu = wp_get_nav_menus();
	    $menu_array  = array();
		$menu_array[''] = __( 'Select A Menu', 'realar' );
	    foreach( $realar_menu as $menu ){
	        $menu_array[ $menu->slug ] = $menu->name;
	    }
	    return $menu_array;
	}

	protected function render() {

        $settings = $this->get_settings_for_display();

		global $woocommerce;

        //Menu by menu select
        $realar_avaiable_menu   = $this->realar_menu_select();
		if( ! $realar_avaiable_menu ){
			return;
		}
		$args = [
			'menu' 			=> $settings['realar_menu_select'],
			'menu_class' 	=> 'realar-menu',
			'container' 	=> '',
		];

		//Mobile menu, Offcanvas, Search
        echo realar_mobile_menu();
		// echo realar_header_cart_offcanvas();
		if(!empty( $settings['show_offcanvas_btn'])){
			echo realar_header_offcanvas();
		}
		if(!empty( $settings['show_search_btn'])){
			echo realar_search_box();
		}
		// Header sub-menu icon
		if( class_exists( 'ReduxFramework' ) ){ 
			if(realar_opt('realar_header_sticky')){
                $sticky = '';
            }else{
                $sticky = '-no';
            }

			if(realar_opt('realar_menu_icon')){
				$menu_icon = '';
			}else{
				$menu_icon = 'hide-icon';
			}
		}

		

		$header_class = $settings['layout_style'] == '1' ? 'header-layout1 header-layout-control' : ' header-layout2 header-layout-control';

		echo '<div class="th-header '.esc_attr( $header_class ).'">';
	        echo '<div class="sticky-wrapper'.esc_attr($sticky).'">';
	            echo '<!-- Main Menu Area -->';
	            echo '<div class="menu-area">';
	                echo '<div class="container">';
	                    echo '<div class="row align-items-center justify-content-between">';
	                        echo '<div class="col-auto">';
	                            echo '<div class="header-logo">';
	                                echo '<a href="'.esc_url( home_url( '/' ) ).'">';
										echo realar_img_tag( array(
											'url'   => esc_url( $settings['logo_image']['url'] ),
										));
									echo '</a>';
	                            echo '</div>';
	                        echo '</div>';
	                        echo '<div class="col-auto">';
	                            echo '<nav class="main-menu d-none d-lg-inline-block '.esc_attr($menu_icon).'">';
	                                if( ! empty( $settings['realar_menu_select'] ) ){
										wp_nav_menu( $args );
									}

	                            echo '</nav>';
	                            echo '<div class="header-button d-flex d-lg-none">';
	                                echo '<button type="button" class="th-menu-toggle sidebar-btn">';
	                                    echo '<span class="line"></span><span class="line"></span><span class="line"></span>';
	                                echo '</button>';
	                            echo '</div>';
	                        echo '</div>';
	                        echo '<div class="col-auto d-none d-xl-block">';
	                            echo '<div class="header-button">';
									if(!empty( $settings['button_text'])){

										$btn_class = $settings['layout_style'] == '1' ? 'th-btn btn-mask th-btn-icon' : 'th-btn style2 th-btn-icon';

										echo '<a href="'.esc_url($settings['button_url']['url']).'" class="'.esc_attr( $btn_class ).'">'.wp_kses_post($settings['button_text']).'</a>';
									}
	                            	if(!empty( $settings['show_offcanvas_btn'])){
										echo '<button type="button" class="simple-icon sideMenuInfo sidebar-btn">';
		                                    echo '<span class="line"></span><span class="line"></span><span class="line"></span>';
		                                echo '</button>';
									}
	                            echo '</div>';
	                        echo '</div>';
	                    echo '</div>';
	                echo '</div>';
	            echo '</div>';
	        echo '</div>';
	    echo '</div>';

	}
}