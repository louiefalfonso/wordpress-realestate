<?php
use \Elementor\Widget_Base;
use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Typography;
use \Elementor\Group_Control_Border;
use \Elementor\Utils;
/**
 *
 * Section Title Widget .
 *
 */
class Realar_Section_Title extends Widget_Base {

	public function get_name() {
		return 'realarsectiontitle';
	}
	public function get_title() {
		return __( 'Section Title', 'realar' );
	}
	public function get_icon() {
		return 'th-icon';
    }
	public function get_categories() {
		return [ 'realar' ];
	}

	protected function register_controls() {

		$this->start_controls_section(
			'section_title_section',
			[
				'label'		 	=> __( 'Section Title', 'realar' ), 
				'tab' 			=> Controls_Manager::TAB_CONTENT,
			]
        );

		realar_select_field( $this, 'layout_style', 'Layout Style', [ 'Style One', 'Style Two' ] );

		
		
		realar_general_fields( $this, 'shadow_title', 'Shadow Title', 'TEXT', 'Subtitle' );

		$this->add_control(
			'shadow_title_tag', 
			[
				'label' 	=> __( 'Shadow Tag', 'realar' ),
				'type' 		=> Controls_Manager::SELECT,
				'options' 	=> [
					'h1' => 'H1',
					'h2' => 'H2',
					'h3' => 'H3',
					'h4' => 'H4',
					'h5' => 'H5',
					'h6' => 'H6',
					'span'  => 'span',
				],
				'default' => 'span',
			]
        );
		realar_general_fields( $this, 'section_title', 'Title', 'TEXTAREA', 'Title Here' );
		
        $this->add_control(
			'section_title_tag', 
			[
				'label' 	=> __( 'Title Tag', 'realar' ),
				'type' 		=> Controls_Manager::SELECT,
				'options' 	=> [
					'h1' => 'H1',
					'h2' => 'H2',
					'h3' => 'H3',
					'h4' => 'H4',
					'h5' => 'H5',
					'h6' => 'H6',
					'span'  => 'span',
				],
				'default' => 'h2',
			]
        );

		realar_general_fields( $this, 'section_desc', 'Description', 'TEXTAREA', '' );

        $this->add_responsive_control(
			'section_align',
			[
				'label' 		=> __( 'Alignment', 'realar' ),
				'type' 			=> Controls_Manager::CHOOSE,
				'options' 		=> [
					'left' 	=> [
						'title' 		=> __( 'Left', 'realar' ),
						'icon' 			=> 'eicon-text-align-left',
					],
					'center' 	=> [
						'title' 		=> __( 'Center', 'realar' ),
						'icon' 			=> 'eicon-text-align-center',
					],
					'right' 	=> [
						'title' 		=> __( 'Right', 'realar' ),
						'icon' 			=> 'eicon-text-align-right',
					],
				],
				'default' 	=> 'left',
				'toggle' 	=> true,
				'selectors' 	=> [
					'{{WRAPPER}} .title-area' => 'text-align: {{VALUE}};',
                ]
			]
		);

		realar_general_fields( $this, 'wrap_class', 'Wraper Extra Class', 'TEXT', '' );
		realar_general_fields( $this, 'shadow_title_class', 'Subtitle Extra Class', 'TEXT', '' );
		realar_general_fields( $this, 'section_title_class', 'Title Extra Class', 'TEXT', '' );
		realar_general_fields( $this, 'section_desc_class', 'Description Class', 'TEXT', '' );

        $this->end_controls_section();

        //---------------------------------------
			//Style Section Start
		//---------------------------------------

		//-------------------------General Style-----------------------//
        $this->start_controls_section(
			'general_style_section',
			[
				'label' => __( 'General Style', 'realar' ),
				'tab' 	=> Controls_Manager::TAB_STYLE,
			]
		);

		realar_dimensions_fields($this, 'menu_margin', 'Margin', 'margin', '{{WRAPPER}} .title-area');

		$this->end_controls_section();

		//-------Title Style-------
		realar_common_style_fields($this, 'title', 'Title', '{{WRAPPER}} .sec-title');
		//-------Description Style-------
		realar_common_style_fields($this, 'desc', 'Description', '{{WRAPPER}} p');

	}

	protected function render() {

	$settings = $this->get_settings_for_display();

	if (isset($settings['section_align'])) {
        if ($settings['section_align'] == 'left') {
            $wrap_align_class = 'text-left';
        } elseif ($settings['section_align'] == 'center') {
            $wrap_align_class = 'text-center';
        } elseif ($settings['section_align'] == 'right') {
            $wrap_align_class = 'text-right';
        } else {
            $wrap_align_class = '';
        }
    } else {
        // Default value if 'section_align' is not set
        $wrap_align_class = 'text-left';
    }
	if($settings['layout_style'] == '1'){
		$this->add_render_attribute( 'shadow_args', 'class', 'shadow-title '. $settings['shadow_title_class'] );
	}else{
		$this->add_render_attribute( 'shadow_args', 'class', 'sub-title '. $settings['shadow_title_class'] );
	}
	$this->add_render_attribute( 'title_args', 'class', 'sec-title '. $settings['section_title_class']  );

	?>
		<div class="title-area <?php echo esc_attr($wrap_align_class . ' ' . $settings['wrap_class']); ?>">
			<?php	
				
				if ( !empty($settings['shadow_title' ]) ){

					printf( '<%1$s %2$s>%3$s</%1$s>',
					$settings['shadow_title_tag'],
					$this->get_render_attribute_string( 'shadow_args' ),
					esc_html( $settings['shadow_title' ] )
					);
				}
				if ( !empty($settings['section_title' ]) ){
					printf( '<%1$s %2$s>%3$s</%1$s>',
					$settings['section_title_tag'],
					$this->get_render_attribute_string( 'title_args' ),
					esc_html( $settings['section_title' ] )
					);
				}

				if( ! empty( $settings['section_desc'] ) ){
					echo realar_paragraph_tag( array(
						'text'	=> wp_kses_post( $settings['section_desc'] ),
						'class'	=> esc_attr($settings['section_desc_class']),
					) );
				}

			?>
		</div>

	<?php
		
	}
}