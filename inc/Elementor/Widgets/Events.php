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


class Events extends Widget_Base {

	public $base;

	public function get_name() {
		return 'museum_core_events_list';
	}

	public function get_title() {
		return esc_html__( 'Events', 'museum-core' );
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
			'column',
			[
				'label'     => esc_html__( 'Column', 'museum-core' ),
				'type'      => Controls_Manager::SELECT,
				'options'	=> [
					'one'		=> esc_html__('One', 'museum-core'),
					'two'		=> esc_html__('Two', 'museum-core'),
				],
				'default' => 'two',
			]
		);
		$this->add_control(
			'length',
			[
				'label'     => esc_html__( 'Excerpt Length', 'museum-core' ),
				'type'      => Controls_Manager::NUMBER,
				'default' => 50,
			]
		);
		$this->add_control(
			'show_view_event_btn',
			[
				'label'     => esc_html__( 'Show View Event Button', 'museum-core' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'museum-core' ),
				'label_off' => __( 'Hide', 'museum-core' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);
		$this->add_control(
			'view_event_btn_text',
			[
				'label'     => esc_html__( 'View Event Label', 'museum-core' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => 'View Event',
				'condition' => [ 'show_view_event_btn' => 'yes' ]
			]
		);
		

		$this->end_controls_section();

        // Query
		$this->start_controls_section(
			'museum_event_posts_content_section',
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
				'options'   =>'action=museum_core_ajax&subaction=ajaxselect2&data=post&type=course',
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

		// Wrapper Styles
		$this->start_controls_section(
			'museum_event_Wrapper_style',
			[
				'label' => esc_html__( 'Wrapper', 'museum-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'wrapper_padding',
			[
				'label' => __( 'Padding', 'museum-core' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .sec-100px' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
		// Title Styles
		$this->start_controls_section(
			'museum_event_posts_style',
			[
				'label' => esc_html__( 'Title', 'museum-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->start_controls_tabs( 'museum_event_posts_content_border_tabs', [
          /* 'condition' => [
               'museum_event_posts_layout_style' =>  'elementskit-post-image-card',
               'museum_event_posts_feature_img' => 'yes'
           ]*/
       ] );
		$this->start_controls_tab(
			'museum_event_posts_content_border_normal',
			[
				'label' =>esc_html__( 'Normal', 'museum-core' ),
			]
		);

		$this->add_control(
			'museum_event_posts_content_title_color_normal',
			[
				'label' => esc_html_x( 'Color', 'Title Control', 'museum-core' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .event-detail h4 a' => 'color: {{VALUE}};',
				],
			]
		);
		$this->end_controls_tab();

		$this->start_controls_tab(
			'museum_event_posts_content_title_color_hover_style',
			[
				'label' =>esc_html__( 'Hover', 'museum-core' ),
			]
		);
		$this->add_control(
			'museum_event_posts_content_title_color_hover',
			[
				'label' => esc_html_x( 'Color', 'Title Control', 'museum-core' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .event-detail h4 a:hover' => 'color: {{VALUE}};',
				],
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->add_group_control(
			Group_Control_Typography::get_type(), [
				'name'       => 'museum_event_posts_meta_typography',
				'selector'   => '{{WRAPPER}} .event-detail h4 a',
			]
		);

		$this->end_controls_section();
		
        // Read more button Style.
		$this->start_controls_section(
			'museum_event_posts_button_style',
			[
				'label' => esc_html__( 'View Event Button', 'museum-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->start_controls_tabs( 'museum_event_posts_button_style_tabs');
		$this->start_controls_tab(
			'museum_event_posts_read_more_button',
			[
				'label' =>esc_html__( 'Normal', 'museum-core' ),
			]
		);

		$this->add_control(
			'museum_event_posts_read_more_button_color',
			[
				'label' => esc_html_x( 'Color', 'Button Control', 'museum-core' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .event-detail .view-event' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'museum_event_posts_read_more_button_bg_color',
			[
				'label' => esc_html_x( 'Background Color', 'Button Control', 'museum-core' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}}  .event-detail .view-event' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'museum_event_posts_read_more_button_hover',
			[
				'label' =>esc_html__( 'Hover', 'museum-core' ),
			]
		);
		$this->add_control(
			'museum_event_posts_read_more_button_hover_color',
			[
				'label' => esc_html_x( 'Color', 'Button Control', 'museum-core' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .event-detail .view-event:hover' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'museum_event_posts_read_more_button_bg_hover_color',
			[
				'label' => esc_html_x( 'Background Color', 'Button Control', 'museum-core' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .event-detail .view-event:hover' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->add_group_control(
			Group_Control_Typography::get_type(), [
				'name'       => 'museum_event_posts_read_more_button_typography',
				'selector'   => '{{WRAPPER}} .event-detail .view-event',
			]
		);
		$this->add_control(
			'read_more_btn_padding',
			[
				'label' => __( 'Padding', 'museum-core' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .event-detail .view-event' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .event-detail .view-event' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'read_more_btn_box_shadow',
				'label' => __( 'Box Shadow', 'museum-core' ),
				'selector' => '{{WRAPPER}} .event-detail .view-event',
			]
		);
		$this->end_controls_section();

        // Carousel arrow buttons Style.
		$this->start_controls_section(
			'museum_event_carousel_arrow_style',
			[
				'label' => esc_html__( 'Date Box', 'museum-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'date_box_bg_background',
				'label' => __( 'Background', 'museum-core' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .shortcode-twocolumn li > .date',
			]
		);
		$this->add_control(
			'date_box_date_color',
			[
				'label' => esc_html_x( 'Date Color', 'Button Control', 'museum-core' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .shortcode-twocolumn li > .date' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'date_box_month_color',
			[
				'label' => esc_html_x( 'Month Year Color', 'Button', 'museum-core' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .shortcode-twocolumn li > .date > p' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(), [
				'label'		=> esc_html__('Date Typography', 'museum-core'),
				'name'       => 'museum_event_carousel_arrow_style_typography',
				'selector'   => '{{WRAPPER}} .shortcode-twocolumn li > .date',
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(), [
				'label'		=> esc_html__('Month Typography', 'museum-core'),
				'name'       => 'datebox_month_year_style_typography',
				'selector'   => '{{WRAPPER}} .shortcode-twocolumn li > .date > p',
			]
		);
		
		$this->end_controls_section();
	}

	/**
	 * Render.
	 * 
	 * @return [type] [description]
	 */
	public function render() {
		$settings = $this->get_settings();
		extract($settings);

		if(file_exists(get_theme_file_path( 'templates/elementor/events.php' ))) {
			include get_theme_file_path( 'templates/elementor/events.php' );
			return;
		}
		include MUSEUM_CORE_PATH . 'templates/elementor/events.php';
	}
}
