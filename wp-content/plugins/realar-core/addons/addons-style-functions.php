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

// Color field
// realar_color_fields($th, $id, $label, $property, $selector, $condition = null);
if (!function_exists('realar_color_fields')) {
    function realar_color_fields($th, $id, $label, $property, $selector, $condition = null) {
        $control_args = [
            'label'      => __( $label, 'realar' ),
            'type'       => Controls_Manager::COLOR,
            'selectors'  => [
                $selector => $property . ': {{VALUE}};',
            ],
        ];

        if (!empty($condition)) {
            $control_args['condition'] = [
                'layout_style' => $condition,
            ];
        }

        $th->add_control($id, $control_args);
    }
}

// Typography field
// realar_typography_fields($th, $id, $label, $selector, $condition = null);
if (!function_exists('realar_typography_fields')) {
    function realar_typography_fields($th, $id, $label, $selector, $condition = null) {
        $control_args = [
            'name' 		=> $id,
            'label'      => __( $label, 'realar' ),
            'selector' 	=>  $selector,
        ];

        if (!empty($condition)) {
            $control_args['condition'] = [
                'layout_style' => $condition,
            ];
        }

        $th->add_group_control(Group_Control_Typography::get_type(), $control_args);
    }
}

// Dimensions field - margin, padding, border-radious
// realar_dimensions_fields($th, $id, $label, $property, $selector, $condition = null);
if (!function_exists('realar_dimensions_fields')) {
    function realar_dimensions_fields($th, $id, $label, $property, $selector, $condition = null) {
        $control_args = [
            'label'      => __( $label, 'realar' ),
            'type' 			=> Controls_Manager::DIMENSIONS,
            'size_units' 	=> [ 'px', '%', 'em' ],
            'selectors' 	=> [
                $selector => $property . ': {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
            ],
        ];

        if (!empty($condition)) {
            $control_args['condition'] = [
                'layout_style' => $condition,
            ];
        }

        $th->add_responsive_control($id, $control_args);
    }
}

// Common Style fields - Color, Typography, Margin & padding
// realar_common_style_fields($th, $id, $label, $selector, $condition = null, $p = 'color');
if (!function_exists('realar_common_style_fields')) {
    function realar_common_style_fields($th, $id, $label, $selector, $condition = null, $p = 'color') {
       
        $control_args = [
            'label'      => __( $label, 'realar' ),
            'tab' 		=> Controls_Manager::TAB_STYLE,
        ];
        if (!empty($condition)) {
            $control_args['condition'] = [
                'layout_style' => $condition,
            ];
        }
        $th->start_controls_section($id.'title_style_section', $control_args);

		$th->add_control(
			$id.'color',
			[
				'label' 	=> __( 'Color', 'realar' ),
				'type' 		=> Controls_Manager::COLOR,
				'selectors'  => [
					$selector => $p . ': {{VALUE}}',
				],
			]
        );

		$th->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 		=> $id.'typography',
				'label' 	=> __( 'Typography', 'realar' ),
				'selector' 	=> $selector
			]
		);

		$th->add_responsive_control(
			$id.'margin',
			[
				'label' 		=> __( 'Margin', 'realar' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%', 'em' ],
				'selectors' 	=> [
					$selector => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);

		$th->add_responsive_control(
			$id.'padding',
			[
				'label' 		=> __( 'Padding', 'realar' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%', 'em' ],
				'selectors' 	=> [
					$selector => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);

		$th->end_controls_section();

    }
}

// Common2 Style fields - Color, Hover Color, Typography, Margin & padding
// realar_common2_style_fields($th, $id, $label, $selector, $condition = null, $p = 'color', $p2 = 'color')
if (!function_exists('realar_common2_style_fields')) {
    function realar_common2_style_fields($th, $id, $label, $selector, $condition = null, $p = 'color', $p2 = 'color') {
       
        $control_args = [
            'label'      => __( $label, 'realar' ),
            'tab' 		=> Controls_Manager::TAB_STYLE,
        ];
        if (!empty($condition)) {
            $control_args['condition'] = [
                'layout_style' => $condition,
            ];
        }
        $th->start_controls_section($id.'title_style_section', $control_args);

		$th->add_control(
			$id.'color',
			[
				'label' 	=> __( 'Color', 'realar' ),
				'type' 		=> Controls_Manager::COLOR,
				'selectors'  => [
					$selector => $p . ': {{VALUE}}',
				],
			]
        );

		$th->add_control(
			$id.'hover_color',
			[
				'label' 	=> __( 'Hover Color', 'realar' ),
				'type' 		=> Controls_Manager::COLOR,
				'selectors'  => [
					$selector . ':hover' => $p2 . ': {{VALUE}}',
				],
			]
        );

		$th->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 		=> $id.'typography',
				'label' 	=> __( 'Typography', 'realar' ),
				'selector' 	=> $selector
			]
		);

		$th->add_responsive_control(
			$id.'margin',
			[
				'label' 		=> __( 'Margin', 'realar' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%', 'em' ],
				'selectors' 	=> [
					$selector => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);

		$th->add_responsive_control(
			$id.'padding',
			[
				'label' 		=> __( 'Padding', 'realar' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%', 'em' ],
				'selectors' 	=> [
					$selector => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);

		$th->end_controls_section();

    }
}



// Button Style field
// realar_button_style_fields($th, $id, $label, $selector, $condition = null)
if (!function_exists('realar_button_style_fields')) {
    function realar_button_style_fields($th, $id, $label, $selector, $condition = null) {
       
        $control_args = [
            'label'      => __( $label, 'realar' ),
            'tab' 		=> Controls_Manager::TAB_STYLE,
        ];
        if (!empty($condition)) {
            $control_args['condition'] = [
                'layout_style' => $condition,
            ];
        }

		$th->start_controls_section($id.'button_style_section', $control_args);

		$th->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 		=> $id.'button_typography',
				'label' 	=> __( 'Typography', 'realar' ),
				'selector' 	=> $selector
			]
		);

		$th->start_controls_tabs(
			$id.'style_tabs'
		);

			$th->start_controls_tab(
				$id.'first_style_tab',
				[
					'label' => esc_html__( 'Normal', 'realar' ),
				]
			);

			$th->add_control(
				$id.'button_color',
				[
					'label' 		=> __( 'Color', 'realar' ),
					'type' 			=> Controls_Manager::COLOR,
					'selectors' 	=> [
						$selector => 'color: {{VALUE}}',
					],
				]
			);
	
			$th->add_control(
				$id.'button_bg',
				[
					'label' 		=> __( 'Background Color', 'realar' ),
					'type' 			=> Controls_Manager::COLOR,
					'selectors' 	=> [
						$selector => 'background-color:{{VALUE}}',
					],
				]
			);

			$th->add_group_control(
				\Elementor\Group_Control_Border::get_type(),
				[
					'name' => $id.'border',
					'selector' => $selector
				]
			);

			$th->end_controls_tab();

			//--------------------secound--------------------//
			$th->start_controls_tab(
				$id.'sec_style_tab',
				[
					'label' => esc_html__( 'Hover', 'realar' ),
				]
			);

			$th->add_control(
				$id.'button_h_color',
				[
					'label' 		=> __( 'Hover Color ', 'realar' ),
					'type' 			=> Controls_Manager::COLOR,
					'selectors' 	=> [
                        $selector . ':hover' => 'color:{{VALUE}} !important',
					],
				]
			);

			$th->add_control(
				$id.'button_hover_bg',
				[
					'label' 		=> __( 'Background Hover Color', 'realar' ),
					'type' 			=> Controls_Manager::COLOR,
					'selectors' => [
                        $selector . ':before' => 'background:{{VALUE}} !important',
                        $selector . ':after' => 'background:{{VALUE}} !important',
                    ],
				]
			);

			$th->add_group_control(
				\Elementor\Group_Control_Border::get_type(),
				[
					'name' => $id.'border2',
					'selector' => $selector.':hover',
				]
			);

			$th->end_controls_tab();

		$th->end_controls_tabs();

		$th->add_control(
			$id.'hr',
			[
				'type' => \Elementor\Controls_Manager::DIVIDER,
			]
		);

		$th->add_responsive_control(
			$id.'button_margin',
			[
				'label' 		=> __( 'Margin', 'realar' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%', 'em' ],
				'selectors' 	=> [
					$selector => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);

		$th->add_responsive_control(
			$id.'button_padding',
			[
				'label' 		=> __( 'Padding', 'realar' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%', 'em' ],
				'selectors' 	=> [
					$selector => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);
		
		$th->add_responsive_control(
			$id.'button_border_radius',
			[
				'label' 		=> __( 'Border Radius', 'realar' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%', 'em' ],
				'selectors' 	=> [
					$selector => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);

		$th->end_controls_section();

    }
}
