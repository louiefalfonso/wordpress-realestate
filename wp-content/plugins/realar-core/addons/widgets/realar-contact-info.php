
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
 * Contact Info Widget .
 *
 */
class Realar_Contact_Info extends Widget_Base {

	public function get_name() {
		return 'realarcontactinfo';
	}
	public function get_title() {
		return __( 'Contact Info', 'realar' );
	}
	public function get_icon() {
		return 'th-icon';
    }
	public function get_categories() {
		return [ 'realar' ];
	}

	protected function register_controls() { 

		$this->start_controls_section(
			'title_section',
			[
				'label' 	=> __( 'Contact Info', 'realar' ),
				'tab' 		=> Controls_Manager::TAB_CONTENT,
			]
        );

		realar_select_field( $this, 'layout_style', 'Layout Style',[ 'Style One','Style Two','Style Three' ] );

		realar_general_fields( $this, 'title', 'Title', 'TEXT', 'Projects', [ '2' ] );

		$repeater = new Repeater();

		realar_media_fields( $repeater, 'image', 'Image' );
		realar_general_fields( $repeater, 'label', 'Label', 'TEXT', 'Address' );
		realar_general_fields( $repeater, 'info', 'Informations', 'WYSIWYG', 'Address' );

		

		$this->add_control(
			'slides',
			[
				'label' 		=> __( 'Slides', 'realar' ),
				'type' 			=> Controls_Manager::REPEATER,
				'fields' 		=> $repeater->get_controls(),
				'default' 		=> [
					[
						'client_image'	=> Utils::get_placeholder_image_src(),
					],
				],
				'title_field' 	=> '{{{ label }}}',
				'condition'		=> [ 
					'layout_style' => [ '1','2'],
				],
				
			]
		);


		$repeater2 = new Repeater();

		realar_general_fields( $repeater2, 'icon', 'Icon Class', 'TEXT', '#' );
		realar_general_fields( $repeater2, 'label', 'Label', 'TEXT', 'Address' );
		realar_general_fields( $repeater2, 'info', 'Informations', 'WYSIWYG', 'Address' );

		

		$this->add_control(
			'slides2',
			[
				'label' 		=> __( 'Slides', 'realar' ),
				'type' 			=> Controls_Manager::REPEATER,
				'fields' 		=> $repeater2->get_controls(),
				'default' 		=> [
					[
						'client_image'	=> Utils::get_placeholder_image_src(),
					],
				],
				'title_field' 	=> '{{{ label }}}',
				'condition'		=> [ 
					'layout_style' => [ '3'],
				],
				
			]
		);
		
		
		


        $this->end_controls_section();

        //---------------------------------------

		//-------Description Style-------
		realar_common_style_fields( $this, 'label', 'Info Title', '{{WRAPPER}} .title', ['1','2','3'] );
		realar_common_style_fields( $this, 'desc', 'Info Content', '{{WRAPPER}} .about-contact-details-text, {{WRAPPER}} .about-contact-details-text a', ['1'] );
		realar_common_style_fields( $this, 'desc2', 'Info Content', '{{WRAPPER}} .details, {{WRAPPER}} .details a', ['2'] );

		realar_common_style_fields( $this, 'desc3', 'Info', '{{WRAPPER}} .info',['3'],'--light-color' );

		
	}

	protected function render() {

        $settings = $this->get_settings_for_display(); 

			
		if( $settings['layout_style'] == '1' ){

			foreach( $settings['slides'] as $data ){
				echo '<div class="about-contact-grid">';

					if(!empty($data['image']['url'])){
		                echo '<div class="about-contact-icon text-white">';
		                    echo realar_img_tag( array(
								'url'	=> esc_url( $data['image']['url'] ),
							) );
		                echo '</div>';
		            }
	                echo '<div class="about-contact-details">';
	                	if($data['label']){
		                    echo '<h6 class="about-contact-details-title title">'.esc_html($data['label']).'</h6>';
		                }
		                if($data['info']){
		                	echo wp_kses_post( $data['info'] );
		                }
	                echo '</div>';
	            echo '</div>';
	        }
		}elseif( $settings['layout_style'] == '2' ){
			echo '<div class="widget footer-widget">';
				if( !empty( $settings['title'] ) ){
	                echo '<h3 class="widget_title title">'.esc_html( $settings['title'] ).'</h3>';
	            }
                echo '<div class="th-widget-contact">';
                	foreach( $settings['slides'] as $data ){
	                    echo '<div class="info-box_text">';
	                    	if(!empty($data['image']['url'])){
		                        echo '<div class="icon"><img src="'.esc_url( $data['image']['url'] ).'" alt="img"></div>';
		                    }
	                        echo '<div class="details">';
	                           	if($data['info']){
				                	echo wp_kses_post( $data['info'] );
				                } 
	                            
	                        echo '</div>';
	                    echo '</div>';
	                }
                echo '</div>';
            echo '</div>';
		}else{
			echo '<div class="row gy-4 justify-content-center">';
				foreach( $settings['slides2'] as $data ){
	                echo '<div class="col-xl-4 col-lg-6">';
	                    echo '<div class="about-contact-grid style2">';
	                        echo '<div class="about-contact-icon">';
	                            if($data['icon']){
				                	echo wp_kses_post( $data['icon'] );
				                } 
	                        echo '</div>';
	                        echo '<div class="about-contact-details">';
	                        	if($data['label']){
		                            echo '<h6 class="about-contact-details-title title">'.esc_html($data['label']).'</h6>';
		                        }
		                        if($data['info']){
		                        	echo '<div class="info">';
				                		echo wp_kses_post( $data['info'] );
				                	echo '</div>';
				                } 
	                            
	                        echo '</div>';
	                    echo '</div>';
	                echo '</div>';
	            }
            echo '</div>';
		}
	}
}
