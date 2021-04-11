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


class Heading extends Widget_Base {

    public $base;

    public function get_name() {
        return 'museum_core_heading';
    }

    public function get_title() {
        return esc_html__( 'Styled Heading', 'museum-core' );
    }

    public function get_icon() {
        return 'eicon-info-box ekit-widget-icon';
    }

    public function get_categories() {
        return ['we-widget'];
    }

    protected function _register_controls() {

        // Carousel Settings
		$this->start_controls_section(
			'content_carousel_section',
			[
				'label' => esc_html__( 'Content', 'museum-core' ),
			]
		);

		$this->add_control(
			'heading',
			[
				'label'     => esc_html__( 'Heading', 'museum-core' ),
				'type'      => Controls_Manager::TEXT,
				'default' => '',
			]
		);

		$this->add_control(
			'text_align',
			[
				'label' => __( 'Alignment', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => __( 'Left', 'plugin-domain' ),
						'icon' => 'fa fa-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'plugin-domain' ),
						'icon' => 'fa fa-align-center',
					],
					'right' => [
						'title' => __( 'Right', 'plugin-domain' ),
						'icon' => 'fa fa-align-right',
					],
				],
				'default' => 'center',
				'toggle' => true,
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
				'default' => '#333333',
				'selectors' => [
					'{{WRAPPER}} .styled-title' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(), [
				'name'       => 'section_heading_typography',
				'selector'   => '{{WRAPPER}} .styled-title',
			]
		);

		$this->end_controls_section();

		// Border Styles
		$this->start_controls_section(
			'section_heading_boder_style',
			[
				'label' => esc_html__( 'Border', 'museum-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		
		$this->add_control(
			'section_border_color_normal',
			[
				'label' => esc_html_x( 'Color', 'Title Control', 'museum-core' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#f19100',
				'selectors' => [
					'{{WRAPPER}} hr' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'section_border_height',
			[
				'label' => esc_html_x( 'Height', 'museum-core' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 10,
						'step' => 1,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 3,
				],
				'selectors' => [
					'{{WRAPPER}} hr' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);
		
		$this->add_control(
			'section_border_width',
			[
				'label' => esc_html_x( 'Width', 'museum-core' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 500,
						'step' => 5,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 100,
				],
				'selectors' => [
					'{{WRAPPER}} hr' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);
		

		$this->end_controls_section();

    }

    public function render() {
        $settings = $this->get_settings();
        ?>
        <div class="museumwp-section-heading text-<?php echo esc_attr($settings['text_align']) ?>">
        	<h2 class="styled-title"><?php echo wp_kses($settings['heading'], wp_kses_allowed_html( 'post' )) ?></h2>
	       	<hr style="display: inline-block;">
	    </div>
        <?php
    }
}
