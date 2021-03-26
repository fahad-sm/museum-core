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


class Testimonials extends Widget_Base {

    public $base;

    public function get_name() {
        return 'museum_core_testimonials';
    }

    public function get_title() {
        return esc_html__( 'Testimonials', 'museum-core' );
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
          'name', [
            'label' => __( 'Name', 'museum-core' ),
            'type' => \Elementor\Controls_Manager::TEXT,
            'default' => __( 'Dr. John Doe' , 'museum-core' ),
            'label_block' => true,
          ]
        );

        $repeater->add_control(
          'designation', [
            'label' => __( 'Designation', 'museum-core' ),
            'type' => \Elementor\Controls_Manager::TEXT,
          ]
        );
        $repeater->add_control(
          'text', [
            'label' => __( 'Review', 'museum-core' ),
            'type' => \Elementor\Controls_Manager::WYSIWYG,
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
                'name' => __( 'Dr. John Doe', 'museum-core' ),
                'text' => __( 'The figure that now stood by its bows was tall and swart, with one white tooth evilly protruding from its steel-like lips.', 'museum-core' ),
                'image' => '',
                'designation' => esc_html__( 'Director', 'museum-core' )
              ],
              [
                'name' => __( 'Dr. John Doe', 'museum-core' ),
                'text' => __( 'The figure that now stood by its bows was tall and swart, with one white tooth evilly protruding from its steel-like lips.', 'museum-core' ),
                'image' => '',
                'designation' => esc_html__( 'Director', 'museum-core' )
              ],
              [
                'name' => __( 'Dr. John Doe', 'museum-core' ),
                'text' => __( 'The figure that now stood by its bows was tall and swart, with one white tooth evilly protruding from its steel-like lips.', 'museum-core' ),
                'image' => '',
                'designation' => esc_html__( 'Director', 'museum-core' )
              ],
            ],
            'title_field' => '{{{ name }}}',
          ]
        );

        $this->end_controls_section();
        


       // Title Styles
       $this->start_controls_section(
           'student_testimonial_title_style',
           [
               'label' => esc_html__( 'Title', 'museum-core' ),
               'tab'   => Controls_Manager::TAB_STYLE,
           ]
       );

       $this->start_controls_tabs( 'student_course_posts_content_border_tabs', [] );
       $this->start_controls_tab(
           'student_testimonials_title_normal',
           [
               'label' =>esc_html__( 'Normal', 'museum-core' ),
           ]
       );

       $this->add_control(
           'student_testimonials_title_normal_color',
           [
               'label' => esc_html_x( 'Color', 'Title Control', 'museum-core' ),
               'type' => Controls_Manager::COLOR,
               'default' => '',
               'selectors' => [
                   '{{WRAPPER}} .title a' => 'color: {{VALUE}};',
               ],
           ]
       );
       $this->end_controls_tab();

       $this->start_controls_tab(
           'student_testimonials_title_hover',
           [
               'label' =>esc_html__( 'Hover', 'museum-core' ),
           ]
       );
       $this->add_control(
           'student_testimonials_title_hover_color',
           [
               'label' => esc_html_x( 'Color', 'Title Control', 'museum-core' ),
               'type' => Controls_Manager::COLOR,
               'default' => '',
               'selectors' => [
                   '{{WRAPPER}} .snap > .flex:hover .title' => 'color: {{VALUE}};',
               ],
           ]
       );
       $this->end_controls_tab();
       $this->end_controls_tabs();

       $this->add_group_control(
           Group_Control_Typography::get_type(), [
               'name'       => 'student_testimonials_title_typography',
               'selector'   => '{{WRAPPER}} .title',
           ]
       );

       $this->end_controls_section();

       // Read more button Style.
        $this->start_controls_section(
           'student_coursel_icon_dd_button_style',
           [
               'label' => esc_html__( 'Carousel Icon', 'museum-core' ),
               'tab'   => Controls_Manager::TAB_STYLE,
           ]
        );

        $this->start_controls_tabs( 'student_carousel_icon_button_style_tabs');
        $this->start_controls_tab(
           'student_carousel_icon_button',
           [
               'label' =>esc_html__( 'Normal', 'museum-core' ),
           ]
        );

        $this->add_control(
           'student_icon_button_color',
           [
               'label' => esc_html_x( 'Color', 'Button Control', 'museum-core' ),
               'type' => Controls_Manager::COLOR,
               'default' => '',
               'selectors' => [
                  '{{WRAPPER}} .carousel-control' => 'color: {{VALUE}};',
               ],
           ]
        );
        $this->add_control(
           'student_icon_button_bg_color',
           [
               'label' => esc_html_x( 'Background Color', 'Button Control', 'museum-core' ),
               'type' => Controls_Manager::COLOR,
               'default' => '',
               'selectors' => [
                  '{{WRAPPER}} .carousel-control' => 'background-color: {{VALUE}}; border-color: {{VALUE}}',
               ],
           ]
        );
       
        $this->end_controls_tab();

        $this->start_controls_tab(
           'student_icon_button_hover',
           [
               'label' =>esc_html__( 'Hover', 'museum-core' ),
           ]
        );
        $this->add_control(
           'icon_button_hover_color',
           [
               'label' => esc_html_x( 'Color', 'Button Control', 'museum-core' ),
               'type' => Controls_Manager::COLOR,
               'default' => '',
               'selectors' => [
                   '{{WRAPPER}} .carousel-control:hover' => 'color: {{VALUE}};',
               ],
           ]
        );
        $this->add_control(
           'icon_button_bg_hover_color',
           [
               'label' => esc_html_x( 'Background Color', 'Button Control', 'museum-core' ),
               'type' => Controls_Manager::COLOR,
               'default' => '',
               'selectors' => [
                   '{{WRAPPER}} .carousel-control:hover' => 'background-color: {{VALUE}}; border-color: {{VALUE}}',
               ],
           ]
        );
       
        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->end_controls_section();

    }

    public function render() {
        $settings = $this->get_settings();
        extract($settings);
        include MUSEUM_CORE_PATH . 'templates/elementor/testimonials-carousel.php';
    }
}
