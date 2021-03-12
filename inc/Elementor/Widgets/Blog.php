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

        // Carousel Settings
		/*$this->start_controls_section(
			'posts_content_carousel_section',
			[
				'label' => esc_html__( 'Carousel', 'museum-core' ),
			]
		);

		$this->add_control(
			'carousel_arrow_left_icon',
			[
				'label'     => esc_html__( 'Left Arrow Icon', 'museum-core' ),
				'type'      => Controls_Manager::ICONS,
				'default'   => ['library' => 'fa-solid', 'value' => 'fa-chevron-left'],
			]
		);

		$this->add_control(
			'carousel_arrow_right_icon',
			[
				'label'     => esc_html__( 'Right Arrow Icon', 'museum-core' ),
				'type'      => Controls_Manager::ICONS,
				'default'   => ['library' => 'fa-solid', 'value' => 'fa-chevron-right'],
			]
		);

		$this->add_control(
			'carousel_more_button_label',
			[
				'label'     => esc_html__( 'Read More Button Label', 'museum-core' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => 'See the Full list courses',
			]
		);
		$this->add_control(
			'carousel_more_button',
			[
				'label'     => esc_html__( 'Link', 'museum-core' ),
				'type'      => Controls_Manager::URL,
			]
		);



		$this->end_controls_section();*/

        // Query
		$this->start_controls_section(
			'posts_query_section',
			[
				'label' => esc_html__( 'Query', 'museum-core' ),
			]
		);

		$this->add_control(
			'style',
			[
				'label'     => esc_html__( 'Style', 'museum-core' ),
				'type'      => Controls_Manager::SELECT,
				'options'	=> [
					''		=> esc_html__( 'Style 1', 'museum-core' ),
					'2'		=> esc_html__( 'Style 2', 'museum-core' ),
				],
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
				'label' =>esc_html__( 'Normal', 'elementskit-lite' ),
			]
		);

		$this->add_control(
			'title_color_normal',
			[
				'label' => esc_html_x( 'Color', 'Title Control', 'elementskit-lite' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .title a' => 'color: {{VALUE}};',
				],
			]
		);
		$this->end_controls_tab();

		$this->start_controls_tab(
			'title_color_hover_style',
			[
				'label' =>esc_html__( 'Hover', 'elementskit-lite' ),
			]
		);
		$this->add_control(
			'title_color_hover',
			[
				'label' => esc_html_x( 'Color', 'Title Control', 'elementskit-lite' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .snap > .flex:hover .title a' => 'color: {{VALUE}};',
				],
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->add_group_control(
			Group_Control_Typography::get_type(), [
				'name'       => 'posts_meta_typography',
				'selector'   => '{{WRAPPER}} .title a',
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
				'label' =>esc_html__( 'Normal', 'elementskit-lite' ),
			]
		);

		$this->add_control(
			'read_more_button_color',
			[
				'label' => esc_html_x( 'Color', 'Button Control', 'elementskit-lite' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .read-more a' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'read_more_button_bg_color',
			[
				'label' => esc_html_x( 'Background Color', 'Button Control', 'elementskit-lite' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .read-more a' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'read_more_button_hover',
			[
				'label' =>esc_html__( 'Hover', 'elementskit-lite' ),
			]
		);
		$this->add_control(
			'read_more_button_hover_color',
			[
				'label' => esc_html_x( 'Color', 'Button Control', 'elementskit-lite' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .read-more:hover a' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'read_more_button_bg_hover_color',
			[
				'label' => esc_html_x( 'Background Color', 'Button Control', 'elementskit-lite' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .read-more:hover a' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->add_group_control(
			Group_Control_Typography::get_type(), [
				'name'       => 'read_more_button_typography',
				'selector'   => '{{WRAPPER}} .read-more a',
			]
		);

		$this->end_controls_section();

        // Carousel arrow buttons Style.
		$this->start_controls_section(
			'arrow_style',
			[
				'label' => esc_html__( 'Carousel Buttons', 'museum-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->start_controls_tabs( 'carousel_arrow_style_tabs');
		$this->start_controls_tab(
			'carousel_arrow_style_normal',
			[
				'label' =>esc_html__( 'Normal', 'elementskit-lite' ),
			]
		);

		$this->add_control(
			'carousel_arrow_style_normal_color',
			[
				'label' => esc_html_x( 'Color', 'Button Control', 'elementskit-lite' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .carousel-control' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'carousel_arrow_style_normal_bg_color',
			[
				'label' => esc_html_x( 'Background Color', 'Button Control', 'elementskit-lite' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .carousel-control' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'carousel_arrow_style_hover',
			[
				'label' =>esc_html__( 'Hover', 'elementskit-lite' ),
			]
		);
		$this->add_control(
			'carousel_arrow_style_hover_color',
			[
				'label' => esc_html_x( 'Color', 'Button Control', 'elementskit-lite' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .carousel-control:hover' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'carousel_arrow_style_hover_bg_color',
			[
				'label' => esc_html_x( 'Background Color', 'Button Control', 'elementskit-lite' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .carousel-control:hover' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->add_group_control(
			Group_Control_Typography::get_type(), [
				'name'       => 'carousel_arrow_style_typography',
				'selector'   => '{{WRAPPER}} .carousel-control',
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

		include $this->getFile( $style );
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

		return STUDENT_PLUGIN_PATH . 'templates/elementor/' . $filename;
	}
}
