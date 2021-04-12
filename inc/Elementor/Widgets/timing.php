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
		return 'Timings';
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
			'Heading',
			[
				'label'     => esc_html__( 'Heading', 'museum-core' ),
				'type'      => Controls_Manager::TEXT,
			]
		);

		$this->add_control(
			'icon',
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
				'label' => __( 'Repeater', 'plugin-name' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => [
					[
						'name' => 'time',
						'label' => __( 'Time', 'plugin-name' ),
						'type' => \Elementor\Controls_Manager::DATE_TIME,
						'placeholder' => __( 'TIME', 'plugin-name' ),
						'default' => __( 'time', 'plugin-name' ),
					],
					[
						'name' => 'Days',
						'label' => __( 'Days', 'plugin-name' ),
						'type' => \Elementor\Controls_Manager::TEXT,
						'placeholder' => __( 'DAYS', 'plugin-name' ),
						'default' => __( 'Days', 'plugin-name' ),
					],
					[
						'name' => 'text',
						'label' => __( 'Text', 'plugin-name' ),
						'type' => \Elementor\Controls_Manager::TEXT,
						'placeholder' => __( 'TEXT', 'plugin-name' ),
						'default' => __( 'text', 'plugin-name' ),
					],
				],
				
				'title_field' => '{{{ text }}}',
			]
		);
		

		

		

		

		
		
		

		
		$this->end_controls_section();

       // Section Heading Styles
		$this->start_controls_section(
			'section_heading_style',
			[
				'label' => esc_html__( 'Section Heading', 'museum-core' ),
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
					'{{WRAPPER}} .section-header h3' => 'color: {{VALUE}};',
				],
			]
		);
		

		$this->add_group_control(
			Group_Control_Typography::get_type(), [
				'name'       => 'section_heading_typography',
				'selector'   => '{{WRAPPER}} .section-header h3',
			]
		);

		$this->end_controls_section();

		// Title Styles
		$this->start_controls_section(
			'posts_style',
			[
				'label' => esc_html__( 'Title', 'museum-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->start_controls_tabs( 'blog_posts_title_style', [] );
		$this->start_controls_tab(
			'title_style_normal',
			[
				'label' =>esc_html__( 'Normal', 'museum-core' ),
			]
		);

		$this->add_control(
			'title_color_normal',
			[
				'label' => esc_html_x( 'Color', 'Title Control', 'museum-core' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .entry-header a' => 'color: {{VALUE}};',
				],
			]
		);
		$this->end_controls_tab();

		$this->start_controls_tab(
			'title_color_hover_style',
			[
				'label' =>esc_html__( 'Hover', 'museum-core' ),
			]
		);
		$this->add_control(
			'title_color_hover',
			[
				'label' => esc_html_x( 'Color', 'Title Control', 'museum-core' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .entry-header a:hover' => 'color: {{VALUE}};',
				],
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->add_group_control(
			Group_Control_Typography::get_type(), [
				'name'       => 'posts_meta_typography',
				'selector'   => '{{WRAPPER}} .entry-header a',
			]
		);

		$this->end_controls_section();

        // Read more button Style.
		$this->start_controls_section(
			'posts_button_style',
			[
				'label' => esc_html__( 'Read More Button', 'museum-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->start_controls_tabs( 'button_style_tabs');
		$this->start_controls_tab(
			'posts_read_more_button',
			[
				'label' =>esc_html__( 'Normal', 'museum-core' ),
			]
		);

		$this->add_control(
			'read_more_button_color',
			[
				'label' => esc_html_x( 'Color', 'Button Control', 'museum-core' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .blog-box-inner .read-more-post' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'read_more_button_bg_color',
			[
				'label' => esc_html_x( 'Background Color', 'Button Control', 'museum-core' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .blog-box-inner .read-more-post' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'read_more_button_hover',
			[
				'label' =>esc_html__( 'Hover', 'museum-core' ),
			]
		);
		$this->add_control(
			'read_more_button_hover_color',
			[
				'label' => esc_html_x( 'Color', 'Button Control', 'museum-core' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .blog-box-inner .read-more-post:hover' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'read_more_button_bg_hover_color',
			[
				'label' => esc_html_x( 'Background Color', 'Button Control', 'museum-core' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .blog-box-inner .read-more-post:hover' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->add_group_control(
			Group_Control_Typography::get_type(), [
				'name'       => 'read_more_button_typography',
				'selector'   => '{{WRAPPER}} .blog-box-inner .read-more-post',
			]
		);
		$this->add_control(
			'read_more_btn_padding',
			[
				'label' => __( 'Padding', 'museum-core' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .blog-box-inner .read-more-post' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'read_more_btn_radius',
			[
				'label' => __( 'Border Radius', 'museum-core' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .blog-box-inner .read-more-post' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'read_more_btn_box_shadow',
				'label' => __( 'Box Shadow', 'museum-core' ),
				'selector' => '{{WRAPPER}} .blog-box-inner .read-more-post',
			]
		);
		$this->end_controls_section();

        // View all posts buttons Style.
		$this->start_controls_section(
			'arrow_style',
			[
				'label' => esc_html__( 'View All Post Button', 'museum-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
				'condition' => [ 'enable_more_btn' => 'yes' ]
			]
		);

		$this->start_controls_tabs( 'carousel_arrow_style_tabs');
		$this->start_controls_tab(
			'carousel_arrow_style_normal',
			[
				'label' =>esc_html__( 'Normal', 'museum-core' ),
			]
		);

		$this->add_control(
			'carousel_arrow_style_normal_color',
			[
				'label' => esc_html_x( 'Color', 'Button Control', 'museum-core' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .blog-section .view-all-posts' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'carousel_arrow_style_normal_bg_color',
			[
				'label' => esc_html_x( 'Background Color', 'Button Control', 'museum-core' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .blog-section .view-all-posts' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'carousel_arrow_style_hover',
			[
				'label' =>esc_html__( 'Hover', 'museum-core' ),
			]
		);
		$this->add_control(
			'carousel_arrow_style_hover_color',
			[
				'label' => esc_html_x( 'Color', 'Button Control', 'museum-core' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .blog-section .view-all-posts:hover' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'carousel_arrow_style_hover_bg_color',
			[
				'label' => esc_html_x( 'Background Color', 'Button Control', 'museum-core' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .blog-section .view-all-posts:hover' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->add_group_control(
			Group_Control_Typography::get_type(), [
				'name'       => 'carousel_arrow_style_typography',
				'selector'   => '{{WRAPPER}} .blog-section .view-all-posts',
			]
		);

		$this->add_control(
			'more_btn_padding',
			[
				'label' => __( 'Padding', 'museum-core' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .blog-section .view-all-posts' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'more_btn_margin',
			[
				'label' => __( 'Marding', 'museum-core' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .blog-section .view-all-posts' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'more_btn_radius',
			[
				'label' => __( 'Border Radius', 'museum-core' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .blog-section .view-all-posts' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'all_posts_btn_box_shadow',
				'label' => __( 'Box Shadow', 'museum-core' ),
				'selector' => '{{WRAPPER}} .blog-section .view-all-posts',
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
	echo '<h3>' . $settings['Heading'] . '</h3>';
	
	Icons_Manager::render_icon( $settings['icon'], [ 'aria-hidden' => 'true' ] );
		include $this->getFile('');
	}

	/**
	 * [getFile description]
	 * @param  [type] $style [description]
	 * @return [type]        [description]
	 */
	private function getFile($style) {

		$filename = ($style) ? 'blog-' . $style . '.php' : 'timing.php';

		$file = get_theme_file_path( 'templates/elemenetor/'.$filename );

		if ( file_exists( $file ) ) {
			return $file;
		}

		return MUSEUM_CORE_PATH . 'templates/elementor/' . $filename;
	}
}
