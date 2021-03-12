<?php

namespace MuseumCore\Elementor\Modules\Services;

use Elementor\Controls_Manager;
use Elementor\Controls_Stack;
use Elementor\Group_Control_Typography;
use Elementor\Scheme_Typography;
use Elementor\Scheme_Color;
use Elementor\Group_Control_Border;
use Elementor\Repeater;

/**
 * Elementor button widget.
 * Elementor widget that displays a button with the ability to control every
 * aspect of the button design.
 *
 * @since 1.0.0
 */
class Services extends \Elementor\Widget_Base {

	/**
	 * Get widget name.
	 * Retrieve button widget name.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'student_elementor_services';
	}

	/**
	 * Get widget title.
	 * Retrieve button widget title.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return string Widget title.
	 */
	public function get_title() {
		return esc_html__( 'Services', 'museum-core' );
	}

	/**
	 * Get widget icon.
	 * Retrieve button widget icon.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-wrench';
	}

	/**
	 * Get widget categories.
	 * Retrieve the list of categories the button widget belongs to.
	 * Used to determine where to display the widget in the editor.
	 *
	 * @since  2.0.0
	 * @access public
	 * @return array Widget categories.
	 */
	public function get_categories() {
		return [ 'we-widget' ];
	}


	/**
	 * Register button widget controls.
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since  1.0.0
	 * @access protected
	 */
	protected function _register_controls() {

		$this->start_controls_section(
			'query',
			[
				'label' => esc_html__( 'Query', 'museum-core' ),
			]
		);
		$this->add_control(
			'style',
			[
				'label'   => esc_html__( 'Style', 'museum-core' ),
				'type'    => Controls_Manager::SELECT2,
				'default' => 'style1',
				'options' => array(
					'style1'            => esc_html__('Style 1', 'museum-core'),
					'style2'            => esc_html__('Style 2', 'museum-core'),
					'style3'            => esc_html__('Style 3', 'museum-core'),
					'style4'            => esc_html__('Style 4', 'museum-core'),
				),
			]
		);
		
		$this->add_control(
			'title_limit',
			[
				'label'   => esc_html__( 'Title Limit', 'museum-core' ),
				'type'    => Controls_Manager::NUMBER,
				'default' => 3,
				'min'     => 1,
				'max'     => 100,
				'step'    => 1,
			]
		);

		$this->add_control(
			'query_exclude',
			[
				'label'       => esc_html__( 'Exclude', 'museum-core' ),
				'type'        => Controls_Manager::TEXT,
				'description' => esc_html__( 'Exclude posts, pages, etc. by ID with comma separated.', 'museum-core' ),
			]
		);

		$this->add_control(
			'query_number',
			[
				'label'   => esc_html__( 'Number', 'museum-core' ),
				'type'    => Controls_Manager::NUMBER,
				'default' => 3,
				'min'     => 1,
				'max'     => 100,
				'step'    => 1,
			]
		);
		$this->add_control(
			'query_orderby',
			[
				'label'   => esc_html__( 'Order By', 'museum-core' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'date',
				'options' => array(
					'date'       => esc_html__( 'Date', 'museum-core' ),
					'title'      => esc_html__( 'Title', 'museum-core' ),
					'menu_order' => esc_html__( 'Menu Order', 'museum-core' ),
					'rand'       => esc_html__( 'Random', 'museum-core' ),
				),
			]
		);
		$this->add_control(
			'query_order',
			[
				'label'   => esc_html__( 'Order', 'museum-core' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'DESC',
				'options' => array(
					'DESC' => esc_html__( 'DESC', 'museum-core' ),
					'ASC'  => esc_html__( 'ASC', 'museum-core' ),
				),
			]
		);

		$this->add_control(
			'detail-btn',
			[
				'label'       => esc_html__( 'Button Text', 'museum-core' ),
				'type'        => Controls_Manager::TEXT,
			]
		);
		
		$this->end_controls_section();
		
		/**
		 * Starting Style tab
		 */

		$this->start_controls_section(
			'title_style',
			[
				'label'      => __( 'Title', 'museum-core' ),
				'tab'        => Controls_Manager::TAB_STYLE,
			]
		);
		
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'label' => __( 'Typography', 'museum-core' ),
				'scheme' => Scheme_Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .title',
			]
		);
		
		$this->start_controls_tabs(
            'title_color_tabs'
        );
		// Control Tabs for Title
		$this->start_controls_tab(
            'title_color_normal',
            [
                'label' => __('Normal', 'museum-core'),
            ]
        );
		$this->add_control(
			'title_color',
			[
				'label' => __( 'Title Color', 'museum-core' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'scheme' => [
					'type' => \Elementor\Scheme_Color::get_type(),
					'value' => \Elementor\Scheme_Color::COLOR_1,
				],
				'selectors' => [
					'{{WRAPPER}} .title' => 'color: {{VALUE}}',
				],
			]
		);
		$this->end_controls_tab();

		$this->start_controls_tab(
            'title_color_hover',
            [
                'label' => __('Hover', 'museum-core'),
            ]
        );
        
        $this->add_control(
			'title_hover_color',
			[
				'label' => __( 'Title Hover Color', 'museum-core' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'scheme' => [
					'type' => \Elementor\Scheme_Color::get_type(),
					'value' => \Elementor\Scheme_Color::COLOR_1,
				],
				'selectors' => [
					'{{WRAPPER}} .title:hover' => 'color: {{VALUE}}',
				],
			]
		);
        $this->end_controls_tab();
        $this->end_controls_tabs();
        
		
		$this->end_controls_section();

		//button styling

		$this->start_controls_section(
			'btn_style',
			[
				'label'      => __( 'Button', 'museum-core' ),
				'tab'        => Controls_Manager::TAB_STYLE,
			]
		);
		
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'btn_typography',
				'label' => __( 'Typography', 'museum-core' ),
				'scheme' => Scheme_Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .service-img > a',
			]
		);
		
		$this->start_controls_tabs(
            'btn_color_tabs'
        );

		$this->start_controls_tab(
            'btn_color_normal',
            [
                'label' => __('Normal', 'museum-core'),
            ]
        );
		$this->add_control(
			'btn_color',
			[
				'label' => __( 'Color', 'museum-core' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'scheme' => [
					'type' => \Elementor\Scheme_Color::get_type(),
					'value' => \Elementor\Scheme_Color::COLOR_1,
				],
				'selectors' => [
					'{{WRAPPER}} .service-img > a' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'btn_bgcolor',
			[
				'label' => __( 'Background Color', 'museum-core' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'scheme' => [
					'type' => \Elementor\Scheme_Color::get_type(),
					'value' => \Elementor\Scheme_Color::COLOR_1,
				],
				'selectors' => [
					'{{WRAPPER}} .service-img > a' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'btn_border',
				'label' => __( 'Border', 'museum-core' ),
				'selector' => '{{WRAPPER}} .service-img > a',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
            'btn_color_hover',
            [
                'label' => __('Hover', 'museum-core'),
            ]
        );
        
        $this->add_control(
			'btn_hover_color',
			[
				'label' => __( 'Color', 'museum-core' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'scheme' => [
					'type' => \Elementor\Scheme_Color::get_type(),
					'value' => \Elementor\Scheme_Color::COLOR_1,
				],
				'selectors' => [
					'{{WRAPPER}} .service-img > a:hover' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'btn_hover_bgcolor',
			[
				'label' => __( 'Background Color', 'museum-core' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'scheme' => [
					'type' => \Elementor\Scheme_Color::get_type(),
					'value' => \Elementor\Scheme_Color::COLOR_1,
				],
				'selectors' => [
					'{{WRAPPER}} .service-img > a:hover' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'btn_hover_border',
				'label' => __( 'Border', 'museum-core' ),
				'selector' => '{{WRAPPER}} .service-img > a:hover',
			]
		);
        $this->end_controls_tab();
        $this->end_controls_tabs();
		
		$this->end_controls_section();

		/* Image Overlay Styling */

		$this->start_controls_section(
			'img_style',
			[
				'label'      => __( 'Image', 'museum-core' ),
				'tab'        => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'img_overlay',
				[
					'label' => __( 'Image Overlay', 'museum-core' ),
					'type' => \Elementor\Controls_Manager::COLOR,
					'scheme' => [
						'type' => \Elementor\Scheme_Color::get_type(),
						'value' => \Elementor\Scheme_Color::COLOR_1,
					],
					'selectors' => [
						'{{WRAPPER}} .service-img figure::before' => 'background-color: {{VALUE}}',
					],
				]
			);

		$this->end_controls_section();

		

			
	}

	/**
	 * Render button widget output on the frontend.
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since  1.0.0
	 * @access protected
	 */
	protected function render() {
		
		$settings = $this->get_settings_for_display();
        
        $style = isset($settings['style']) ? $settings['style'] : 'style1';
        
        $file = get_theme_file_path( 'elementor/services/'.$style.'.php' );
        
        if( file_exists($file) ) {
            include $file;
        } else {
            $file = WEBINANE_EL_PATH . 'modules/services/templates/services-'.$style.'.php';
            
            if( file_exists($file) ) {
                include $file;
            } else {
                include WEBINANE_EL_PATH . 'modules/services/templates/services.php';
            }
        }
	}

}
