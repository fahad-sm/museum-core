<?php

namespace SmartxPlugin\Elementor;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Utils as ElementorUtils;

if ( ! defined( 'ABSPATH' ) ) exit;

class WpForms extends Widget_Base
{
	public $base;

	public function get_name() {
		return 'smartx_plugin_wp_forms';
	}

	public function get_title() {
		return esc_html__( 'WP Forms', 'museum-core' );
	}

	public function get_icon() {
		return 'eicon-info-box';
	}

	public function get_categories() {
		return ['wpforms-page-buttonwidget'];
	}

	/**
	 * Get dependant scripts.
	 *
	 * @return array Scripts handler names.
	 */
	public function get_script_depends() {
	    return [];
	}

	/**
	 * Register widgets scripts.
	 *
	 * @return void
	 */
	protected function _register_controls() {

		$forms = wp_list_pluck( get_posts([
			'post_type'	=> 'wpforms',
		]), 'post_title', 'ID' );

		$field_classes = '{{WRAPPER}} div.wpforms-container-full .wpforms-form input[type=date], {{WRAPPER}} div.wpforms-container-full .wpforms-form input[type=datetime], {{WRAPPER}} div.wpforms-container-full .wpforms-form input[type=datetime-local], {{WRAPPER}} div.wpforms-container-full .wpforms-form input[type=email], {{WRAPPER}} div.wpforms-container-full .wpforms-form input[type=month], {{WRAPPER}} div.wpforms-container-full .wpforms-form input[type=number], {{WRAPPER}} div.wpforms-container-full .wpforms-form input[type=password], {{WRAPPER}} div.wpforms-container-full .wpforms-form input[type=range], {{WRAPPER}} div.wpforms-container-full .wpforms-form input[type=search], {{WRAPPER}} div.wpforms-container-full .wpforms-form input[type=tel], {{WRAPPER}} div.wpforms-container-full .wpforms-form input[type=text], {{WRAPPER}} div.wpforms-container-full .wpforms-form input[type=time], {{WRAPPER}} div.wpforms-container-full .wpforms-form input[type=url], {{WRAPPER}} div.wpforms-container-full .wpforms-form input[type=week], {{WRAPPER}} div.wpforms-container-full .wpforms-form select, {{WRAPPER}} div.wpforms-container-full .wpforms-form textarea';

		$this->start_controls_section(
			'forms',
			[
				'label' => esc_html__( 'Form', 'museum-core' ),
			]
		);

		$this->add_control(
			'form_id', [
				'label' => __( 'Choose Form', 'museum-core' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => '',
				'label_block' => true,
				'options'	=> $forms
			]
		);

		$this->end_controls_section();

        // Label Styles
		$this->start_controls_section(
			'smartx_wpforms_label_style',
			[
				'label' => esc_html__( 'Labels', 'museum-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
            'label_color_normal',
            [
               'label' => esc_html_x( 'Color', 'Label Control', 'museum-core' ),
               'type' => Controls_Manager::COLOR,
               'default' => '',
               'selectors' => [
                   '{{WRAPPER}} div.wpforms-container-full .wpforms-form .wpforms-field-label' => 'color: {{VALUE}};',
               ],
            ]
        );

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'label_typography',
				'label' => __( 'Typography', 'museum-core' ),
				'scheme' => \Elementor\Scheme_Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} div.wpforms-container-full .wpforms-form .wpforms-field-label',
			]
		);

		$this->add_control(
			'label_space',
			[
				'label' => __( 'Space', 'museum-core' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 5,
				],
				'selectors' => [
					'{{WRAPPER}} div.wpforms-container-full .wpforms-form .wpforms-field-label' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		// Fields Styles
		$this->start_controls_section(
			'smartx_wpforms_fields_style',
			[
				'label' => esc_html__( 'Fields', 'museum-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
            'field_color_normal',
            [
               'label' => esc_html_x( 'Color', 'Label Control', 'museum-core' ),
               'type' => Controls_Manager::COLOR,
               'default' => '',
               'selectors' => [
                   '{{WRAPPER}} '.$field_classes => 'color: {{VALUE}};',
               ],
            ]
        );
        $this->add_control(
            'field_bg_color_normal',
            [
               'label' => esc_html_x( 'Background Color', 'Label Control', 'museum-core' ),
               'type' => Controls_Manager::COLOR,
               'default' => '',
               'selectors' => [
                   '{{WRAPPER}} '.$field_classes => 'background-color: {{VALUE}};',
               ],
            ]
        );
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'field_typography',
				'label' => __( 'Typography', 'museum-core' ),
				'scheme' => \Elementor\Scheme_Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} '.$field_classes,
			]
		);

		$this->add_control(
			'field_space',
			[
				'label' => __( 'Space', 'museum-core' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 30,
				],
				'selectors' => [
					'{{WRAPPER}} '.$field_classes => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
            'smartx_field_padding',
            [
                'label' => esc_html__( 'Padding', 'museum-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} '.$field_classes => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'default'=>[
                    'unit' => 'px',
                    'top' => '14',
                    'right' => '0',
                    'bottom' => '12',
                    'left' => '0',
                ],
            ]
        );
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'field_border',
				'label' => __( 'Border', 'museum-core' ),
				'selector' => '{{WRAPPER}} '.$field_classes,
			]
		);
		$this->add_responsive_control(
            'smartx_field_radius',
            [
                'label' => esc_html__( 'Border Radius', 'museum-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} '.$field_classes => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'default'=>[
                    'unit' => 'px',
                    'size' => '20',
                ],
            ]
        );
		
		$this->end_controls_section();


		// Button Styles
		$this->start_controls_section(
			'smartx_wpforms_button_style',
			[
				'label' => esc_html__( 'Button', 'museum-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->start_controls_tabs( 'wp_forms_button_coloring_tabs');


		$this->start_controls_tab(
			'wp_forms_button_coloing_normal_tab',
			[
				'label' =>esc_html__( 'Normal', 'museum-core' ),
			]
		);

		$this->add_control(
            'button_color_normal',
            [
               'label' => esc_html_x( 'Color', 'Label Control', 'museum-core' ),
               'type' => Controls_Manager::COLOR,
               'default' => '',
               'selectors' => [
                   '{{WRAPPER}} div.wpforms-container-full .wpforms-form input[type=submit]' => 'color: {{VALUE}};',
                   '{{WRAPPER}} div.wpforms-container-full .wpforms-form button[type=submit]' => 'color: {{VALUE}};',
                   '{{WRAPPER}} div.wpforms-container-full .wpforms-form .wpforms-page-button' => 'color: {{VALUE}};',
               ],
            ]
        );
        $this->add_control(
            'button_bg_color_normal',
            [
               'label' => esc_html_x( 'Background Color', 'Label Control', 'museum-core' ),
               'type' => Controls_Manager::COLOR,
               'default' => '',
               'selectors' => [
                    '{{WRAPPER}} div.wpforms-container-full .wpforms-form input[type=submit]' => 'background-color: {{VALUE}};',
                   '{{WRAPPER}} div.wpforms-container-full .wpforms-form button[type=submit]' => 'background-color: {{VALUE}};',
                   '{{WRAPPER}} div.wpforms-container-full .wpforms-form .wpforms-page-button' => 'background-color: {{VALUE}};',
               ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
			'wp_forms_button_coloing_hover_tab',
			[
				'label' =>esc_html__( 'Hover', 'museum-core' ),
			]
		);

		$this->add_control(
            'button_color_hover',
            [
               'label' => esc_html_x( 'Color', 'Label Control', 'museum-core' ),
               'type' => Controls_Manager::COLOR,
               'default' => '',
               'selectors' => [
                   '{{WRAPPER}} div.wpforms-container-full .wpforms-form input[type=submit]:hover' => 'color: {{VALUE}};',
                   '{{WRAPPER}} div.wpforms-container-full .wpforms-form button[type=submit]:hover' => 'color: {{VALUE}};',
                   '{{WRAPPER}} div.wpforms-container-full .wpforms-form .wpforms-page-button:hover' => 'color: {{VALUE}};',
               ],
            ]
        );
        $this->add_control(
            'button_bg_color_hover',
            [
               'label' => esc_html_x( 'Background Color', 'Label Control', 'museum-core' ),
               'type' => Controls_Manager::COLOR,
               'default' => '',
               'selectors' => [
                    '{{WRAPPER}} div.wpforms-container-full .wpforms-form input[type=submit]:hover' => 'background-color: {{VALUE}};',
                   '{{WRAPPER}} div.wpforms-container-full .wpforms-form button[type=submit]:hover' => 'background-color: {{VALUE}};',
                   '{{WRAPPER}} div.wpforms-container-full .wpforms-form .wpforms-page-button:hover' => 'background-color: {{VALUE}};',
               ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'button_typography',
				'label' => __( 'Typography', 'museum-core' ),
				'scheme' => \Elementor\Scheme_Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} div.wpforms-container-full .wpforms-form input[type=submit], {{WRAPPER}} div.wpforms-container-full .wpforms-form button[type=submit], {{WRAPPER}} div.wpforms-container-full .wpforms-form .wpforms-page-button',
			]
		);
		$this->add_responsive_control(
            'smartx_button_margin',
            [
                'label' => esc_html__( 'Margin', 'museum-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} div.wpforms-container-full .wpforms-form input[type=submit], {{WRAPPER}} div.wpforms-container-full .wpforms-form button[type=submit], {{WRAPPER}} div.wpforms-container-full .wpforms-form .wpforms-page-button' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'default'=>[
                    'unit' => 'px',
                    'size' => '0',
                ],
            ]
        );
		$this->add_responsive_control(
            'smartx_button_padding',
            [
                'label' => esc_html__( 'Padding', 'museum-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} div.wpforms-container-full .wpforms-form input[type=submit], {{WRAPPER}} div.wpforms-container-full .wpforms-form button[type=submit], {{WRAPPER}} div.wpforms-container-full .wpforms-form .wpforms-page-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'default'=>[
                    'unit' => 'px',
                    'top' => '11',
                    'right' => '60',
                    'bottom' => '11',
                    'left' => '60',
                ],
            ]
        );
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'button_border',
				'label' => __( 'Border', 'museum-core' ),
				'selector' => '{{WRAPPER}} div.wpforms-container-full .wpforms-form input[type=submit], {{WRAPPER}} div.wpforms-container-full .wpforms-form button[type=submit], {{WRAPPER}} div.wpforms-container-full .wpforms-form .wpforms-page-button',
			]
		);
		$this->add_responsive_control(
            'smartx_button_radius',
            [
                'label' => esc_html__( 'Border Radius', 'museum-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} div.wpforms-container-full .wpforms-form input[type=submit], {{WRAPPER}} div.wpforms-container-full .wpforms-form button[type=submit], {{WRAPPER}} div.wpforms-container-full .wpforms-form .wpforms-page-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'default'=>[
                    'unit' => 'px',
                    'size' => '5',
                ],
            ]
        );
        $this->add_control(
            'wp_forms_button_align',
            [
                'label' => esc_html__( 'Alignment', 'museum-core' ),
                'type' => Controls_Manager::CHOOSE,
                'default'   => 'right',
                'options' => [
                    'left' => [
                        'title' => esc_html__( 'Left', 'museum-core' ),
                        'icon' => 'fa fa-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__( 'Center', 'museum-core' ),
                        'icon' => 'fa fa-align-center',
                    ],
                    'right' => [
                        'title' => esc_html__( 'Right', 'museum-core' ),
                        'icon' => 'fa fa-align-right',
                    ],
                ],
                'toggle' => true,
            ]
        );
		
		$this->end_controls_section();
	}

	/**
	 * Render the widget output.
	 * 
	 * @return [type] [description]
	 */
	public function render() {
		$settings = $this->get_settings();
		?>
		<div class="smartx-wp-forms-widget button-align-<?php echo $settings['wp_forms_button_align'] ?>"> 
			<?php echo do_shortcode('[wpforms id="'.$settings['form_id'].'"]'); ?>
		</div>

		<?php
	}

	/**
	 * Content Template.
	 *
	 * @return void
	 */
	/*protected function _content_template() {
		?>
		
		<?php
	}*/
}