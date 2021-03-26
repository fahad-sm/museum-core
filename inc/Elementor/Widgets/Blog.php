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


class Blog extends Widget_Base {

	public $base;

	public function get_name() {
		return 'museum_core_blog_posts';
	}

	public function get_title() {
		return esc_html__( 'Blog', 'museum-core' );
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
				'label' => esc_html__( 'Settings', 'museum-core' ),
			]
		);

		$this->add_control(
			'title',
			[
				'label'     => esc_html__( 'Title', 'museum-core' ),
				'type'      => Controls_Manager::TEXT,
			]
		);

		$this->add_control(
			'enable_more_btn',
			[
				'label'   => esc_html__( 'Show More Button', 'museum-core' ),
				'type'    => Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'museum-core' ),
				'label_off' => __( 'Hide', 'museum-core' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);
		$this->add_control(
			'btn',
			[
				'label'   => esc_html__( 'More Button Text', 'museum-core' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'Read More',
				'condition' => [ 'enable_more_btn' => 'yes' ]
			]
		);
		$this->add_control(
			'btn_url',
			[
				'label'   => esc_html__( 'More Button Link', 'museum-core' ),
				'type'    => Controls_Manager::URL,
				'default' => ['url' => ''],
				'condition' => [ 'enable_more_btn' => 'yes' ]
			]
		);

		$this->end_controls_section();


		// Query
		$this->start_controls_section(
			'posts_query_section',
			[
				'label' => esc_html__( 'Query', 'museum-core' ),
			]
		);

		$this->add_control(
			'posts_num',
			[
				'label'     => esc_html__( 'Posts Count', 'museum-core' ),
				'type'      => Controls_Manager::NUMBER,
				'min'       => 1,
				'max'       => 100,
				'default'   => 3,
			]
		);
		

		$this->add_control(
			'is_manual_selection',
			[
				'label' => esc_html__( 'Select posts by:', 'museum-core' ),
				'type' => Controls_Manager::SELECT,
				'default' => '',
				'options' => [
					'recent'    => esc_html__( 'Recent Post', 'museum-core' ),
					'yes'       => esc_html__( 'Selected Post', 'museum-core' ),
					''        => esc_html__( 'Category Post', 'museum-core' ),
				],

			]
		);

		$this->add_control(
			'manual_selection',
			[
				'label' =>esc_html__('Search & Select', 'museum-core'),
				'type'      => ControlsManager::AJAXSELECT2,
				'options'   =>'action=museum_core_ajax&subaction=ajaxselect2&data=post&type=post',
				'label_block' => true,
				'multiple'  => true,
				'condition' => [ 'is_manual_selection' => 'yes' ]
			]
		);
		$this->add_control(
			'posts_cats',
			[
				'label' =>esc_html__('Select Categories', 'museum-core'),
				'type'      => ControlsManager::AJAXSELECT2,
				'options'   =>'action=museum_core_ajax&subaction=ajaxselect2&data=term&type=category',
				'label_block' => true,
				'multiple'  => true,
				'condition' => [ 'is_manual_selection' => '' ]
			]
		);

		$this->add_control(
			'posts_offset',
			[
				'label'     => esc_html__( 'Offset', 'museum-core' ),
				'type'      => Controls_Manager::NUMBER,
				'min'       => 0,
				'max'       => 20,
				'default'   => 0,
			]
		);

		$this->add_control(
			'orderby',
			[
				'label'   => esc_html__( 'Order by', 'museum-core' ),
				'type'    => Controls_Manager::SELECT,
				'options' => [
					'date'          => esc_html__( 'Date', 'museum-core' ),
					'title'         => esc_html__( 'Title', 'museum-core' ),
					'author'        => esc_html__( 'Author', 'museum-core' ),
					'modified'      => esc_html__( 'Modified', 'museum-core' ),
					'comment_count' => esc_html__( 'Comments', 'museum-core' ),
				],
				'default' => 'date',
				'condition' => [ 'is_manual_selection!' => 'recent' ]
			]
		);

		$this->add_control(
			'sort',
			[
				'label'   => esc_html__( 'Order', 'museum-core' ),
				'type'    => Controls_Manager::SELECT,
				'options' => [
					'ASC'  => esc_html__( 'ASC', 'museum-core' ),
					'DESC' => esc_html__( 'DESC', 'museum-core' ),
				],
				'default' => 'DESC',
				'condition' => [ 'is_manual_selection!' => 'recent' ]
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
		$settings = $this->get_settings();
		extract($settings);

		include $this->getFile('');
	}

	/**
	 * [getFile description]
	 * @param  [type] $style [description]
	 * @return [type]        [description]
	 */
	private function getFile($style) {

		$filename = ($style) ? 'blog-' . $style . '.php' : 'blog.php';

		$file = get_theme_file_path( 'templates/elemenetor/'.$filename );

		if ( file_exists( $file ) ) {
			return $file;
		}

		return MUSEUM_CORE_PATH . 'templates/elementor/' . $filename;
	}
}
