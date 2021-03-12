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


class VerticalTabs extends Widget_Base {

    public $base;

    public function get_name() {
        return 'museum_core_vertical_tabs';
    }

    public function get_title() {
        return esc_html__( 'Veritcal Tabs', 'museum-core' );
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
           'posts_content_tabs_section',
           [
               'label' => esc_html__( 'Tabs', 'museum-core' ),
           ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
          'title',
          [
            'label' => __( 'Title', 'plugin-domain' ),
            'type' => \Elementor\Controls_Manager::TEXT,
            'default' => 'Tab',
          ]
        );
        $repeater->add_control(
          'source',
          [
            'label' => __( 'Source', 'plugin-domain' ),
            'type' => \Elementor\Controls_Manager::SELECT,
            'default' => 'elementor',
            'options'	=> [
            	'page'	=> esc_html__( 'Page', 'museum-core' ),
            	'elementor'	=> esc_html__( 'Elementor', 'museum-core' ),
            	'editor'	=> esc_html__( 'Editor', 'museum-core' ),
            ]
          ]
        );
        
        $repeater->add_control(
          'page', [
            'label' => __( 'Page', 'plugin-domain' ),
            'type' => \Elementor\Controls_Manager::SELECT,
            'default' => 2,
            'options' => $this->get_pages_list(),
            'condition' => [
                'source' => 'page',
            ]
          ]
        );
        $repeater->add_control(
          'elementor', [
            'label' => __( 'Elementor Template', 'plugin-domain' ),
            'type' => \Elementor\Controls_Manager::SELECT,
            'default' => 2,
            'options' => $this->get_pages_list('elementor_library'),
            'condition' => [
                'source' => 'elementor',
            ]
          ]
        );
        $repeater->add_control(
          'editor', [
            'label' => __( 'Content', 'plugin-domain' ),
            'type' => \Elementor\Controls_Manager::WYSIWYG,
            'condition' => [
                'source' => 'editor',
            ]
          ]
        );
        
        
        $this->add_control(
          'list',
          [
            'label' => __( 'Tabs', 'plugin-domain' ),
            'type' => \Elementor\Controls_Manager::REPEATER,
            'fields' => $repeater->get_controls(),
            'default' => [
              [
                'title' => __( 'Dr. John Doe', 'plugin-domain' ),
                'page' => 2,
              ]
            ],
            'title_field' => '{{{ title }}}',
          ]
        );

        $this->end_controls_section();

        //Bg color
        // Title Styles
        $this->start_controls_section(
             'filter_buttons_style',
             [
                 'label' => esc_html__( 'Filter Buttons', 'museum-core' ),
                 'tab'   => Controls_Manager::TAB_STYLE,
             ]
        );
        $this->start_controls_tabs( 'filteration_buttons_style', [] );
       $this->start_controls_tab(
           'buttons_style_normal',
           [
               'label' =>esc_html__( 'Normal', 'elementskit-lite' ),
           ]
       );

       $this->add_control(
           'buttons_color_normal',
           [
               'label' => esc_html_x( 'Color', 'Title Control', 'elementskit-lite' ),
               'type' => Controls_Manager::COLOR,
               'default' => '',
               'selectors' => [
                   '{{WRAPPER}} .sort-links a' => 'color: {{VALUE}};',
               ],
           ]
       );
       $this->add_control(
           'buttons_bg_color_normal',
           [
               'label' => esc_html_x( 'Background Color', 'Title Control', 'elementskit-lite' ),
               'type' => Controls_Manager::COLOR,
               'default' => '#ffffff',
               'selectors' => [
                   '{{WRAPPER}} .sort-links a' => 'background-color: {{VALUE}};',
               ],
           ]
       );
       $this->end_controls_tab();

       $this->start_controls_tab(
           'buttons_color_hover',
           [
               'label' =>esc_html__( 'Hover', 'elementskit-lite' ),
           ]
       );
       $this->add_control(
           'buttons_color_hover_color',
           [
               'label' => esc_html_x( 'Color', 'Title Control', 'elementskit-lite' ),
               'type' => Controls_Manager::COLOR,
               'default' => '#ffffff',
               'selectors' => [
                   '{{WRAPPER}} .sort-links a:hover, {{WRAPPER}} .sort-links a.active' => 'color: {{VALUE}};',
               ],
           ]
       );
       $this->add_control(
           'buttons_color_hover_bg_color',
           [
               'label' => esc_html_x( 'Background Color', 'Title Control', 'elementskit-lite' ),
               'type' => Controls_Manager::COLOR,
               'default' => '#8cc739',
               'selectors' => [
                   '{{WRAPPER}} .sort-links a:hover, {{WRAPPER}} .sort-links a.active' => 'background-color: {{VALUE}};',
               ],
           ]
       );
       
       $this->end_controls_tab();
       $this->end_controls_tabs();
       
       $this->add_control(
           'gallery_hover_overlay_bg_color',
           [
               'label' => esc_html_x( 'Overlay Background Color', 'Title Control', 'elementskit-lite' ),
               'type' => Controls_Manager::COLOR,
               'default' => '#8CC739D1',
               'selectors' => [
                   '{{WRAPPER}} .overly' => 'background-color: {{VALUE}};',
               ],
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
        include STUDENT_PLUGIN_PATH . 'templates/elementor/vertical-tabs.php';
    }

    /**
     * Get pages list.
     * 
     * @return [type] [description]
     */
    private function get_pages_list($post_type = 'page') {
    	global $post;
      	$query = new \WP_Query(['post_type' => $post_type, 'posts_per_page' => -1]);
      	$pages = [];
    	while ($query->have_posts()) {
			$query->the_post();
			$pages[$post->post_name] = get_the_title();
      	}
      	return $pages;
    }
}
