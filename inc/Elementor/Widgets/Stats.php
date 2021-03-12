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


class Stats extends Widget_Base {

    public $base;

    public function get_name() {
        return 'museum_core_stats';
    }

    public function get_title() {
        return esc_html__( 'Stats (Knob)', 'museum-core' );
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
           'student_teachers_general_section',
           [
               'label' => esc_html__( 'Content', 'museum-core' ),
           ]
        );

        
        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
          'title',
          [
            'label' => __( 'Title', 'plugin-domain' ),
            'type' => \Elementor\Controls_Manager::TEXT,
            'default' => 'Title',
          ]
        );
        $repeater->add_control(
          'stat', [
            'label' => __( 'Stat', 'plugin-domain' ),
            'type' => \Elementor\Controls_Manager::NUMBER,
            'default' => 50,
            'label_block' => true,
          ]
        );
        $repeater->add_control(
          'min', [
            'label' => __( 'Minimum', 'plugin-domain' ),
            'type' => \Elementor\Controls_Manager::NUMBER,
            'default' => 50,
            'label_block' => true,
          ]
        );
        $repeater->add_control(
          'max', [
            'label' => __( 'Maximum', 'plugin-domain' ),
            'type' => \Elementor\Controls_Manager::NUMBER,
            'default' => 50,
            'label_block' => true,
          ]
        );
        
        
        $this->add_control(
          'list',
          [
            'label' => __( 'Stats', 'plugin-domain' ),
            'type' => \Elementor\Controls_Manager::REPEATER,
            'fields' => $repeater->get_controls(),
            'default' => [
              [
                'title' => __( 'New Teachers', 'plugin-domain' ),
                'stat' => 2589,
                'min' => 20,
                'max' => 6000
              ],
              [
                'title' => __( 'Categories', 'plugin-domain' ),
                'stat' => 70,
                'min' => 5,
                'max' => 100
              ],
              [
                'title' => __( 'Languages', 'plugin-domain' ),
                'stat' => 35,
                'min' => 1,
                'max' => 40
              ],
              [
                'title' => __( 'Video Courses', 'plugin-domain' ),
                'stat' => 2589,
                'min' => 20,
                'max' => 3000
              ],
              
            ],
            'title_field' => '{{{ title }}}',
          ]
        );

        $this->end_controls_section();
        


        // Title Styles
        $this->start_controls_section(
           'student_stats_title_style',
           [
               'label' => esc_html__( 'Styling', 'museum-core' ),
               'tab'   => Controls_Manager::TAB_STYLE,
           ]
        );

        $this->add_control(
           'student_stats_title_color',
           [
               'label' => esc_html_x( 'Title Color', 'Title Control', 'elementskit-lite' ),
               'type' => Controls_Manager::COLOR,
               'default' => '',
               'selectors' => [
                   '{{WRAPPER}} .title' => 'color: {{VALUE}};',
               ],
           ]
        );

        $this->add_control(
           'student_stats_numbers_color',
           [
               'label' => esc_html_x( 'Numbers Color', 'Title Control', 'elementskit-lite' ),
               'type' => Controls_Manager::COLOR,
               'default' => '',
               'selectors' => [
                   '{{WRAPPER}} .number' => 'stroke: {{VALUE}};',
               ],
           ]
        );
        $this->add_control(
           'student_stats_knob_color',
           [
               'label' => esc_html_x( 'Knob Color', 'Title Control', 'elementskit-lite' ),
               'type' => Controls_Manager::COLOR,
               'default' => '#8cc739',
               'selectors' => [
                   '{{WRAPPER}} .progress-ring__circle' => 'stroke: {{VALUE}};',
               ],
           ]
        );
       

        $this->add_group_control(
          Group_Control_Typography::get_type(), [
            'name'       => 'student_stats_title_typography',
            'label' => esc_html_x( 'Title Typography', 'Title Control', 'elementskit-lite' ),
            'selector'   => '{{WRAPPER}} .title',
          ]
        );

        $this->add_group_control(
          Group_Control_Typography::get_type(), [
            'name'       => 'student_stats_number_typography',
            'label' => esc_html_x( 'Numbers Typography', 'Title Control', 'elementskit-lite' ),
            'selector'   => '{{WRAPPER}} .number',
          ]
        );
        
        $this->end_controls_section();

    }

    public function render() {
        $settings = $this->get_settings();
        extract($settings);
        include STUDENT_PLUGIN_PATH . 'templates/elementor/stats.php';
    }
}
