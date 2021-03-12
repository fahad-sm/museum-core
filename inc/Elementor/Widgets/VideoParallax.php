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


class VideoParallax extends Widget_Base {

    public $base;

    public function get_name() {
        return 'museum_core_video_parallax';
    }

    public function get_title() {
        return esc_html__( 'Video Parallax', 'museum-core' );
    }

    public function get_icon() {
        return 'eicon-info-box ekit-widget-icon';
    }

    public function get_categories() {
        return ['we-widget'];
    }

    /**
     * Register control
     * 
     * @return void
     */
    protected function _register_controls() {

        // Carousel Settings
        $this->start_controls_section(
           'posts_content_video_section',
           [
               'label' => esc_html__( 'Content', 'museum-core' ),
           ]
        );


        $this->add_control(
          'icon',
          [
            'label' => __( 'Icon', 'museum-core' ),
            'type' => \Elementor\Controls_Manager::ICONS,
            // 'default' => 'fa fa-play'
          ]
        );
        $this->add_control(
          'icon_position',
          [
            'label' => __( 'Icon Position', 'museum-core' ),
            'type' => \Elementor\Controls_Manager::SELECT,
            'options' => [
              'center'  => esc_html__( 'Center', 'museum-core' ),
              'top'  => esc_html__( 'Top', 'museum-core' ),
              'bottom'  => esc_html__( 'Bottom', 'museum-core' ),
            ],
            'default' => 'top'
          ]
        );
        
        $this->add_control(
          'video',
          [
            'label' => __( 'Video', 'plugin-domain' ),
            'type' => \Elementor\Controls_Manager::TEXT,
            /*'default' => [
              'url' => \Elementor\Utils::get_placeholder_image_src(),
            ],*/
            'default' => ''
          ]
        );
        
        $this->add_control(
          'title',
          [
            'label' => __( 'Title 1', 'plugin-domain' ),
            'type' => \Elementor\Controls_Manager::TEXT,
            'default' => 'Video background Tour'
          ]
        );
        $this->add_control(
          'title2',
          [
            'label' => __( 'Title 2', 'plugin-domain' ),
            'type' => \Elementor\Controls_Manager::TEXT,
            'default' => 'great for presentations'
          ]
        );
        

        $this->end_controls_section();

        // Title Styles
        $this->start_controls_section(
             'filter_buttons_style',
             [
                 'label' => esc_html__( 'Title', 'museum-core' ),
                 'tab'   => Controls_Manager::TAB_STYLE,
             ]
        );
        $this->start_controls_tabs( 'title_main_style', [] );
        
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
               'default' => '#fff',
               'selectors' => [
                   '{{WRAPPER}} .title' => 'color: {{VALUE}};',
               ],
           ]
        );
        $this->end_controls_tab();

        $this->start_controls_tab(
          'title_color_hover',
          [
            'label' =>esc_html__( 'Hover', 'museum-core' ),
          ]
        );
        $this->add_control(
           'title_color_hover_color',
           [
               'label' => esc_html_x( 'Color', 'Title Control', 'museum-core' ),
               'type' => Controls_Manager::COLOR,
               'default' => '#8cc739',
               'selectors' => [
                  '{{WRAPPER}}:hover .title' => 'color: {{VALUE}};',
               ],
           ]
        );
       
        $this->end_controls_tab();
        $this->end_controls_tabs();
       
        $this->add_group_control(
           Group_Control_Typography::get_type(), [
               'name'       => 'title_typography',
               'selector'   => '{{WRAPPER}} .title',
           ]
        );

        $this->add_control(
          'title_space',
          [
            'label' => __( 'Space', 'plugin-domain' ),
            'type' => Controls_Manager::SLIDER,
            'size_units' => [ 'px', '%' ],
            'range' => [
              'px' => [
                'min' => 0,
                'max' => 1000,
                'step' => 5,
              ],
              '%' => [
                'min' => 0,
                'max' => 100,
              ],
            ],
            'default' => [
              'unit' => 'px',
              'size' => 50,
            ],
            'selectors' => [
              '{{WRAPPER}} .title:nth-child(2)' => 'margin-top: {{SIZE}}{{UNIT}};',
            ],
          ]
        );
       
        $this->end_controls_section();

        // Title Styles
        $this->start_controls_section(
             'icon_style',
             [
                 'label' => esc_html__( 'Icon', 'museum-core' ),
                 'tab'   => Controls_Manager::TAB_STYLE,
             ]
        );
        $this->start_controls_tabs( 'icon_main_style', [] );
        
        $this->start_controls_tab(
           'icon_style_normal',
           [
               'label' =>esc_html__( 'Normal', 'museum-core' ),
           ]
        );

        $this->add_control(
           'icon_color_normal',
           [
               'label' => esc_html_x( 'Color', 'Title Control', 'museum-core' ),
               'type' => Controls_Manager::COLOR,
               'default' => '#8cc739',
               'selectors' => [
                   '{{WRAPPER}} .parallax-icon' => 'color: {{VALUE}};',
               ],
           ]
        );
        $this->add_control(
           'icon_bg_color_normal',
           [
               'label' => esc_html_x( 'Background', 'Title Control', 'museum-core' ),
               'type' => Controls_Manager::COLOR,
               'default' => '#fff',
               'selectors' => [
                   '{{WRAPPER}} .parallax-icon' => 'background-color: {{VALUE}};',
               ],
           ]
        );
        
        $this->end_controls_tab();

        $this->start_controls_tab(
          'icon_color_hover',
          [
            'label' =>esc_html__( 'Hover', 'museum-core' ),
          ]
        );
        $this->add_control(
           'icon_color_hover_color',
           [
               'label' => esc_html_x( 'Color', 'Title Control', 'museum-core' ),
               'type' => Controls_Manager::COLOR,
               'default' => '#fff',
               'selectors' => [
                  '{{WRAPPER}} .parallax-icon:hover' => 'color: {{VALUE}};',
               ],
           ]
        );
        $this->add_control(
             'icon_bg_hover_color',
             [
                 'label' => esc_html_x( 'Background', 'Title Control', 'museum-core' ),
                 'type' => Controls_Manager::COLOR,
                 'default' => '#8cc739',
                 'selectors' => [
                    '{{WRAPPER}} .parallax-icon:hover' => 'background-color: {{VALUE}};',
                 ],
             ]
        );
       
        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->add_group_control(
          \Elementor\Group_Control_Border::get_type(),
          [
            'name' => 'border',
            'label' => __( 'Border', 'plugin-domain' ),
            'selector' => '{{WRAPPER}} .parallax-icon',
          ]
        );
        $this->add_control(
          'margin',
          [
            'label' => __( 'Border Radius', 'plugin-domain' ),
            'type' => Controls_Manager::DIMENSIONS,
            'size_units' => [ 'px', '%', 'em' ],
            'default' => [
              'top' => 50,
              'right' => 50,
              'bottom' => 50,
              'left' => 50,
              'isLinked' => true,
            ],
            'selectors' => [
              '{{WRAPPER}} .parallax-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
          ]
        );

        $this->add_control(
          'width',
          [
            'label' => __( 'Width', 'plugin-domain' ),
            'type' => Controls_Manager::SLIDER,
            'size_units' => [ 'px', '%' ],
            'range' => [
              'px' => [
                'min' => 0,
                'max' => 1000,
                'step' => 5,
              ],
              '%' => [
                'min' => 0,
                'max' => 100,
              ],
            ],
            'default' => [
              'unit' => 'px',
              'size' => 185,
            ],
            'selectors' => [
              '{{WRAPPER}} .parallax-icon' => 'width: {{SIZE}}{{UNIT}};',
            ],
          ]
        );
        $this->add_control(
          'height',
          [
            'label' => __( 'Height', 'plugin-domain' ),
            'type' => Controls_Manager::SLIDER,
            'size_units' => [ 'px', '%' ],
            'range' => [
              'px' => [
                'min' => 0,
                'max' => 1000,
                'step' => 5,
              ],
              '%' => [
                'min' => 0,
                'max' => 100,
              ],
            ],
            'default' => [
              'unit' => 'px',
              'size' => 185,
            ],
            'selectors' => [
              '{{WRAPPER}} .parallax-icon' => 'height: {{SIZE}}{{UNIT}};',
            ],
          ]
        );
        
        $this->end_controls_section();
    }

    /**
     * Render
     * 
     * @return [type] [description]
     */
    public function render() {
      $settings = $this->get_settings();
      extract($settings);
      include STUDENT_PLUGIN_PATH . 'templates/elementor/video-parallax.php';
    }
}
