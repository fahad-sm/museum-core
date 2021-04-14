<?php
namespace MuseumCore\Elementor\Widgets;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Icons_Manager;
use Elementor\Scheme_Typography;
use Elementor\Utils as ElementorUtils;
use Elementor\Widget_Base;
use MuseumCore\Elementor\Classes\Controls\ControlsManager;
use MuseumCore\Util\Utils;


if ( ! defined( 'ABSPATH' ) ) exit;


class Timing extends Widget_Base {

	public $base;

	public function get_name() {
		return 'museum_timings';
	}

	public function get_title() {
		return esc_html__( 'Timings', 'museum-core' );
	}

	public function get_icon() {
		return 'eicon-info-box ekit-widget-icon';
	}

	public function get_categories() {
		return ['we-widget'];
	}

	protected function _register_controls() {

        // Setting
		$this->start_controls_section(
			'posts_settings_section',
			[
				'label' => esc_html__( 'Heading', 'museum-core' ),
			]
		);

		$this->add_control(
			'heading',
			[
				'label'     => esc_html__( 'Heading', 'museum-core' ),
				'type'      => Controls_Manager::TEXT,
			]
		);

		$this->add_control(
			'Icon',
			[
				'label' => __( 'Icon', 'text-domain' ),
				'type' => \Elementor\Controls_Manager::ICONS,
				'default' => [
					'value' => 'fas fa-star',
					'library' => 'solid',
				],
			]
		);
		

	
		$repeater = new \Elementor\Repeater();
		$this->add_control(
			'list',
			[
				'label' => __( 'Repeater', 'museum-core' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => [
					[
						'name' => 'time',
						'label' => __( 'Time', 'museum-core' ),
						'type' => \Elementor\Controls_Manager::TEXT,
						'placeholder' => __( 'TIME', 'museum-core' ),
						'default' => __( 'time', 'museum-core' ),
					],
					[
						'name' => 'days',
						'label' => __( 'Days', 'museum-core' ),
						'type' => \Elementor\Controls_Manager::TEXT,
						'placeholder' => __( 'DAYS', 'museum-core' ),
						'default' => __( 'Days', 'museum-core' ),
					],
					[
						'name' => 'text',
						'label' => __( 'Text', 'museum-core' ),
						'type' => \Elementor\Controls_Manager::TEXT,
						'placeholder' => __( 'TEXT', 'museum-core' ),
						'default' => __( 'text', 'museum-core' ),
					],
				],
				
				'title_field' => '{{{ time }}}',
			]
		);
		
		
		$this->end_controls_section();


       // Section Heading Styles
		$this->start_controls_section(
			'section_heading_style',
			[
				'label' => esc_html__( 'Heading', 'museum-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		
		$this->add_control(
			'section_heading_color_normal',
			[
				'label' => esc_html_x( 'Color', 'Title Control', 'museum-core' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .section-title' => 'color: {{VALUE}};',
				],
			]
		);
		

		$this->add_group_control(
			Group_Control_Typography::get_type(), [
				'name'       => 'section_heading_typography',
				'selector'   => '{{WRAPPER}} .section-title',
			]
		);

		$this->end_controls_section();

		// Section days Styles
		$this->start_controls_section(
			'section_days_style',
			[
				'label' => esc_html__( 'Days', 'museum-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		
		$this->add_control(
			'section_days_color_normal',
			[
				'label' => esc_html_x( 'Days Color', 'Title Control', 'museum-core' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .timing-days' => 'color: {{VALUE}};',
				],
			]
		);
		

		$this->add_group_control(
			Group_Control_Typography::get_type(), [
				'name'       => 'section_days_typography',
				'selector'   => '{{WRAPPER}} .timing-days',
			]
		);

		$this->end_controls_section();

			// Section time Styles
		$this->start_controls_section(
			'section_time_style',
			[
				'label' => esc_html__( 'Time', 'museum-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		
		$this->add_control(
			'section_time_color_normal',
			[
				'label' => esc_html_x( 'time Color', 'Title Control', 'museum-core' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} p.time' => 'color: {{VALUE}};',
				],
			]
		);
		

		$this->add_group_control(
			Group_Control_Typography::get_type(), [
				'name'       => 'section_time_typography',
				'selector'   => '{{WRAPPER}} p.time',
			]
		);

		$this->end_controls_section();
	// Section text Styles

		
		$this->start_controls_section(
			'section_text_style',
			[
				'label' => esc_html__( 'Text', 'museum-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		
		$this->add_control(
			'section_text_color_normal',
			[
				'label' => esc_html_x( 'text Color', 'Title Control', 'museum-core' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .appoiment' => 'color: {{VALUE}};',
				],
			]
		);
		

		$this->add_group_control(
			Group_Control_Typography::get_type(), [
				'name'       => 'section_text_typography',
				'selector'   => '{{WRAPPER}} .appoiment',
			]
		);
		

		$this->end_controls_section();

        
	}

	/**
	 * [render description]
	 * @return [type] [description]
	 */
	public function render() {
		$settings = $this->get_settings_for_display();
	 	
	 	if(file_exists(get_theme_file_path( 'templates/elementor/timings.php' ))) {
	 		include get_theme_file_path( 'templates/elementor/timing.php' );
	 		return;
	 	}

	 	include MUSEUM_CORE_PATH . 'templates/elementor/timing.php';
	}

}
