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
 * Contact Form Widget .
 *
 */
class realar_Contact_Form extends Widget_Base {

    public function get_name() {
        return 'realarcontactform';
    }
    public function get_title() {
        return __( 'Contact Form', 'realar' );
    }
    public function get_icon() {
        return 'th-icon';
    }
    public function get_categories() {
        return [ 'realar' ];
    }

    public function get_as_contact_form(){
        if ( ! class_exists( 'WPCF7' ) ) {
            return;
        }
        $as_cfa         = array();
        $as_cf_args     = array( 'posts_per_page' => -1, 'post_type'=> 'wpcf7_contact_form' );
        $as_forms       = get_posts( $as_cf_args );
        $as_cfa         = ['0' => esc_html__( 'Select Form', 'realar' ) ];
        if( $as_forms ){
            foreach ( $as_forms as $as_form ){
                $as_cfa[$as_form->ID] = $as_form->post_title;
            }
        }else{
            $as_cfa[ esc_html__( 'No contact form found', 'realar' ) ] = 0;
        }
        return $as_cfa;
    }

    protected function register_controls() {

        $this->start_controls_section(
            'contact_form_section',
            [
                'label'     => __( 'Contact Form', 'realar' ),
                'tab'       => Controls_Manager::TAB_CONTENT,
            ]
        );

        realar_select_field( $this, 'layout_style', 'Layout Style',[ 'Style One','Style Two'] );

        $this->add_control(
            'realar_select_contact_form',
            [
                'label'   => esc_html__( 'Select Form', 'realar' ),
                'type'    => Controls_Manager::SELECT,
                'default' => '0',
                'options' => $this->get_as_contact_form(),
            ]
        );
        realar_general_fields( $this, 'title', 'Title', 'TEXT', 'Title', ['2' ] );

        $this->end_controls_section();

         $this->start_controls_section(
            'general_styling',
            [
                'label'     => __( 'General Styling', 'realar' ),
                'tab'       => Controls_Manager::TAB_STYLE,
            ]
        );


        realar_color_fields( $this, 'form_bg', 'Background', 'background', '{{WRAPPER}} .bg', ['2'] );

        $this->end_controls_section();

        realar_common_style_fields($this, 'title', 'Title', '{{WRAPPER}} .form-title', ['2'], '--white-color');

        //------Button Style-------
        realar_button_style_fields( $this, '10', 'Button Styling', '{{WRAPPER}} .th-btn' );

    }

    protected function render() {

        $settings = $this->get_settings_for_display();

        if( $settings['layout_style'] == '1' ){
            
            if( !empty($settings['realar_select_contact_form']) ){
                echo do_shortcode( '[contact-form-7  id="'.$settings['realar_select_contact_form'].'"]' ); 
            }else{
                echo '<div class="alert alert-warning"><p class="m-0">' . __('Please Select contact form.', 'realar' ). '</p></div>';
            }
        }else{
            echo '<div class="appointment-wrap2 bg">';
                if(!empty($settings['title'])){
                    echo '<h2 class="form-title text-white">'.esc_html($settings['title']).'</h2>';
                }
                if( !empty($settings['realar_select_contact_form']) ){
                    echo do_shortcode( '[contact-form-7  id="'.$settings['realar_select_contact_form'].'"]' ); 
                }else{
                    echo '<div class="alert alert-warning"><p class="m-0">' . __('Please Select contact form.', 'realar' ). '</p></div>';
                }
                
            echo '</div>';
        }
    }
}