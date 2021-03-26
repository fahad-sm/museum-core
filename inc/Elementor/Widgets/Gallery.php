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
           'posts_content_carousel_section',
           [
               'label' => esc_html__( 'Carousel', 'museum-core' ),
           ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
          'image',
          [
            'label' => __( 'Choose Image', 'museum-core' ),
            'type' => \Elementor\Controls_Manager::MEDIA,
            'default' => [
              'url' => \Elementor\Utils::get_placeholder_image_src(),
            ],
          ]
        );
        $repeater->add_control(
          'title', [
            'label' => __( 'Title', 'museum-core' ),
            'type' => \Elementor\Controls_Manager::TEXT,
            'default' => __( 'Dr. John Doe' , 'museum-core' ),
            'label_block' => true,
          ]
        );

        $repeater->add_control(
          'tagline', [
            'label' => __( 'Tagline', 'museum-core' ),
            'type' => \Elementor\Controls_Manager::TEXT,
          ]
        );
        $repeater->add_control(
          'tags', [
            'label' => __( 'Tags', 'museum-core' ),
            'type' => \Elementor\Controls_Manager::TEXT,
          ]
        );
        
        $this->add_control(
          'list',
          [
            'label' => __( 'Testimonials', 'museum-core' ),
            'type' => \Elementor\Controls_Manager::REPEATER,
            'fields' => $repeater->get_controls(),
            'default' => [
              [
                'title' => __( 'Dr. John Doe', 'museum-core' ),
                'tagline' => __( 'Chemistry', 'museum-core' ),
                'image' => '',
                'tags' => 'biology,chemistry'
              ],
              [
                'title' => __( 'Dr. John Doe', 'museum-core' ),
                'tagline' => __( 'Chemistry', 'museum-core' ),
                'image' => '',
                'tags' => 'biology,chemistry'
              ],
              [
                'title' => __( 'Dr. John Doe', 'museum-core' ),
                'tagline' => __( 'Chemistry', 'museum-core' ),
                'image' => '',
                'tags' => 'biology,chemistry'
              ],
              
            ],
            'title_field' => '{{{ name }}}',
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
               'label' =>esc_html__( 'Normal', 'museum-core' ),
           ]
       );

       $this->add_control(
           'buttons_color_normal',
           [
               'label' => esc_html_x( 'Color', 'Title Control', 'museum-core' ),
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
               'label' => esc_html_x( 'Background Color', 'Title Control', 'museum-core' ),
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
               'label' =>esc_html__( 'Hover', 'museum-core' ),
           ]
       );
       $this->add_control(
           'buttons_color_hover_color',
           [
               'label' => esc_html_x( 'Color', 'Title Control', 'museum-core' ),
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
               'label' => esc_html_x( 'Background Color', 'Title Control', 'museum-core' ),
               'type' => Controls_Manager::COLOR,
               'default' => '#8cc739',
               'selectors' => [
                   '{{WRAPPER}} .sort-links a:hover, {{WRAPPER}} .sort-links a.active' => 'background-color: {{VALUE}};border-color: {{VALUE}};',
               ],
           ]
       );
       
       $this->end_controls_tab();
       $this->end_controls_tabs();
       
       $this->add_control(
           'gallery_hover_overlay_bg_color',
           [
               'label' => esc_html_x( 'Overlay Background Color', 'Title Control', 'museum-core' ),
               'type' => Controls_Manager::COLOR,
               'default' => '#8CC739D1',
               'selectors' => [
                   '{{WRAPPER}} .overly' => 'background-color: {{VALUE}};',
               ],
           ]
       );
       
       $this->end_controls_section();
    }

    public function render() {
        $settings = $this->get_settings();
        extract($settings);
        include MUSEUM_CORE_PATH . 'templates/elementor/masonry-gallery.php';
    }
}
