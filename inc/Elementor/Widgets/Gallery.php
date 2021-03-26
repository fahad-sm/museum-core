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


class Gallery extends Widget_Base {

    public $base;

    public function get_name() {
        return 'museum_core_masonry_gallery';
    }

    public function get_title() {
        return esc_html__( 'Gallery', 'museum-core' );
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
           'gallery_posts_content',
           [
               'label' => esc_html__( 'Content', 'museum-core' ),
           ]
        );

        $this->add_control(
			'columns',
			[
				'label' =>esc_html__('Columns', 'museum-core'),
				'type'      => Controls_Manager::SELECT,
				'options'   => [
					3	=> esc_html__( 'Three', 'museum-core' ),
					4	=> esc_html__( 'Four', 'museum-core' ),
				],
				'default'	=> 3
			]
		);

        $this->end_controls_section();

        // Carousel Settings
        $this->start_controls_section(
           'posts_content_carousel_section',
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
			'tags',
			[
				'label' =>esc_html__('Select Tags', 'museum-core'),
				'type'      => ControlsManager::AJAXSELECT2,
				'options'   =>'action=museum_core_ajax&subaction=ajaxselect2&data=term&type=gallery-tags',
				'label_block' => true,
				'multiple'  => true,
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
			]
		);

        $this->end_controls_section();

        //Bg color
        // Title Styles
        $this->start_controls_section(
             'filter_buttons_style',
             [
                 'label' => esc_html__( 'Tags', 'museum-core' ),
                 'tab'   => Controls_Manager::TAB_STYLE,
             ]
        );
        $this->start_controls_tabs( 'filteration_buttons_style', [] );
       	$this->start_controls_tab(
			'buttons_style_normal',
			[
				'label' =>esc_html__( 'Normal', 'museum-core' ),
			]
       	);

       $this->add_control(
           'buttons_color_normal',
           [
               'label' => esc_html_x( 'Color', 'museum-core' ),
               'type' => Controls_Manager::COLOR,
               'default' => '#fff',
               'selectors' => [
                   '{{WRAPPER}} .inn-sec a[rel=tag]' => 'color: {{VALUE}};',
               ],
           ]
       );
       $this->add_control(
           'buttons_bg_color_normal',
           [
               'label' => esc_html_x( 'Background Color', 'museum-core' ),
               'type' => Controls_Manager::COLOR,
               'default' => '#f19100',
               'selectors' => [
                   '{{WRAPPER}} .inn-sec a[rel=tag]' => 'background-color: {{VALUE}};',
               ],
           ]
       );
       $this->end_controls_tab();

       $this->start_controls_tab(
           'buttons_color_hover',
           [
               'label' =>esc_html__( 'Hover', 'museum-core' ),
           ]
       );
       $this->add_control(
           'buttons_color_hover_color',
           [
               'label' => esc_html_x( 'Color', 'museum-core' ),
               'type' => Controls_Manager::COLOR,
               'default' => '',
               'selectors' => [
                   '{{WRAPPER}} .inn-sec a[rel=tag]:hover' => 'color: {{VALUE}};',
               ],
           ]
       );
       $this->add_control(
           'buttons_color_hover_bg_color',
           [
               'label' => esc_html_x( 'Background Color', 'Title Control', 'museum-core' ),
               'type' => Controls_Manager::COLOR,
               'default' => '#8cc739',
               'selectors' => [
                   '{{WRAPPER}} .inn-sec a[rel=tag]:hover' => 'background-color: {{VALUE}};',
               ],
           ]
        );
       
        $this->end_controls_tab();
        $this->end_controls_tabs();
       
        $this->end_controls_section();

        // Title Styling
        $this->start_controls_section(
             'galler_item_title_styling',
             [
                 'label' => esc_html__( 'Title', 'museum-core' ),
                 'tab'   => Controls_Manager::TAB_STYLE,
             ]
        );
        $this->add_control(
           'gallery_item_title_color',
           [
               'label' => esc_html_x( 'Color', 'Title Control', 'museum-core' ),
               'type' => Controls_Manager::COLOR,
               'default' => '#f19100',
               'selectors' => [
                   '{{WRAPPER}} .inn-sec .detail a' => 'color: {{VALUE}};',
               ],
           ]
        );
        $this->add_control(
           'gallery_item_title_color_hover',
           [
               'label' => esc_html_x( 'Hover Color', 'Title Control', 'museum-core' ),
               'type' => Controls_Manager::COLOR,
               'default' => '#fff',
               'selectors' => [
                   '{{WRAPPER}} .inn-sec .detail:hover a' => 'color: {{VALUE}};',
               ],
           ]
        );
        $this->add_group_control(
			Group_Control_Typography::get_type(), [
                'label' => esc_html__( 'Typography', 'museum-core' ),
				'name'       => 'gallery_title_typography',
				'selector'   => '{{WRAPPER}} .inn-sec .detail a',
			]
		);
       $this->end_controls_section();
    }

    public function render() {
        $settings = $this->get_settings();
        extract($settings);
        include MUSEUM_CORE_PATH . 'templates/elementor/gallery.php';
    }
}
