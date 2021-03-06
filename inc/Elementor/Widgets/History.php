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
use MuseumCore\Util\Utils;

// use \Elementor\ElementsKit_Widget_Icon_Box_Handler as Handler;
// use \ElementsKit_Lite\Modules\Controls\Controls_Manager as ElementsKit_Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit;


class History extends Widget_Base {
    // use \ElementsKit_Lite\Widgets\Widget_Notice;

    public $base;

    public function get_name() {
        return 'museum_core_icon_box';
    }

    public function get_title() {
        return esc_html__( 'Icon Box', 'museum-core' );
    }

    public function get_icon() {
        return 'eicon-info-box ekit-widget-icon';
    }

    public function get_categories() {
        return ['we-widget'];
    }

    protected function _register_controls() {

        $this->start_controls_section(
            'ekit_icon_box',
            [
                'label' => esc_html__( 'Icon Box', 'museum-core' ),
            ]
        );

        $this->add_control(
            'ekit_icon_box_enable_header_icon', [
                'label'       => esc_html__( 'Icon Type', 'museum-core' ),
                'type'        => Controls_Manager::CHOOSE,
                'label_block' => false,
                'options'     => [
                    'none' => [
                        'title' => esc_html__( 'None', 'museum-core' ),
                        'icon'  => 'fa fa-ban',
                    ],
                    'icon' => [
                        'title' => esc_html__( 'Icon', 'museum-core' ),
                        'icon'  => 'fa fa-paint-brush',
                    ],
                    'image' => [
                        'title' => esc_html__( 'Image', 'museum-core' ),
                        'icon'  => 'fa fa-image',
                    ],
                ],
                'default'       => 'icon',
            ]
        );

        $this->add_control(
            'ekit_icon_box_header_icons__switch',
            [
                'label' => esc_html__('Add icon? ', 'museum-core'),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'yes',
                'label_on' =>esc_html__( 'Yes', 'museum-core' ),
                'label_off' =>esc_html__( 'No', 'museum-core' ),
                'condition' => [
                    'ekit_icon_box_enable_header_icon!' => 'none',
                ]
            ]
        );

        $this->add_control(
            'ekit_icon_box_header_icons',
            [
                'label' => esc_html__( 'Header Icon', 'museum-core' ),
                'type' => Controls_Manager::ICONS,
                'fa4compatibility' => 'ekit_icon_box_header_icon',
                'default' => [
                    'value' => 'icon icon-review',
                    'library' => 'ekiticons',
                ],
                'label_block' => true,
                'condition' => [
                    'ekit_icon_box_enable_header_icon' => 'icon',
                    'ekit_icon_box_header_icons__switch'    => 'yes'
                ]
            ]
        );

        $this->add_control(
            'ekit_icon_box_header_image',
            [
                'label' => esc_html__( 'Choose Image', 'museum-core' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => ElementorUtils::get_placeholder_image_src(),
                ],
                'dynamic' => [
                    'active' => true,
                ],
                'condition' => [
                    'ekit_icon_box_enable_header_icon' => 'image',
                ]
            ]
        );

        $this->add_control(
            'ekit_icon_box_title_text',
            [
                'label' => esc_html__( 'Title ', 'museum-core' ),
                'type' => Controls_Manager::TEXT,
                'dynamic' => [
                    'active' => true,
                ],
                'default' => esc_html__( 'Strategy and  Planning', 'museum-core' ),
                'placeholder' => esc_html__( 'Enter your title', 'museum-core' ),
                'label_block' => true,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'ekit_icon_box_description_text',
            [
                'label' => esc_html__( 'Content', 'museum-core' ),
                'type' => Controls_Manager::TEXTAREA,
                'dynamic' => [
                    'active' => true,
                ],
                'default' => esc_html__( 'We bring the right people together to challenge established thinking and drive transform in 2020', 'museum-core' ),
                'placeholder' => esc_html__( 'Enter your description', 'museum-core' ),
                'separator' => 'none',
                'rows' => 10,
                'show_label' => false,
            ]
        );

        $this->end_controls_section();

        //  Section Button

        $this->start_controls_section(
            'ekit_icon_box_section_button',
            [
                'label' => esc_html__( 'Read More', 'museum-core' ),
            ]
        );
        $this->add_control(
            'ekit_icon_box_enable_btn',
            [
                'label' => esc_html__( 'Enable Button', 'museum-core' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Yes', 'museum-core' ),
                'label_off' => esc_html__( 'No', 'museum-core' ),
                'return_value' => 'yes',
                'default' => 'no',
                'separator' => 'before',
            ]
        );
        $this->add_control(
            'ekit_icon_box_enable_hover_btn',
            [
                'label' => esc_html__( 'Enable Hover Btn', 'museum-core' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Yes', 'museum-core' ),
                'label_off' => esc_html__( 'No', 'museum-core' ),
                'return_value' => 'yes',
                'default' => 'no',
                'separator' => 'before',
                'condition' => [
                    'ekit_icon_box_enable_btn' => 'yes',
                ]
            ]
        );

        $this->add_control(
            'hover_btn_horizontal_align',
            [
                'label' => esc_html__( 'Horizontal Alignment', 'museum-core' ),
                'type' => Controls_Manager::CHOOSE,
                'default'   => 'center',
                'options' => [
                    'left' => [
                        'title' => esc_html__( 'Left', 'museum-core' ),
                        'icon' => 'fa fa-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__( 'Center', 'museum-core' ),
                        'icon' => 'fa fa-align-center',
                    ],
                    'right' => [
                        'title' => esc_html__( 'Right', 'museum-core' ),
                        'icon' => 'fa fa-align-right',
                    ],
                ],
                'toggle' => true,
                'condition' => [
                    'ekit_icon_box_enable_hover_btn'    => 'yes'
                ]
            ]
        );

        $this->add_control(
            'ekit_icon_box_btn_text',
            [
                'label' =>esc_html__( 'Label', 'museum-core' ),
                'type' => Controls_Manager::TEXT,
                'default' =>esc_html__( 'Learn more ', 'museum-core' ),
                'placeholder' =>esc_html__( 'Learn more ', 'museum-core' ),
                'dynamic'     => array( 'active' => true ),
                'condition' => [
                    'ekit_icon_box_enable_btn' => 'yes',
                ]
            ]
        );


        $this->add_control(
            'ekit_icon_box_btn_url',
            [
                'label' =>esc_html__( 'URL', 'museum-core' ),
                'type' => Controls_Manager::URL,
                'placeholder' =>esc_url('http://your-link.com'),
                'default' => [
                    'url' => '#',
                ],
                'dynamic' => [
                    'active' => true,
                ],
                'condition' => [
                    'ekit_icon_box_enable_btn' => 'yes',
                ]
            ]
        );
        
        $this->add_control(
            'ekit_icon_box_icons__switch',
            [
                'label' => esc_html__('Add icon? ', 'museum-core'),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'yes',
                'label_on' =>esc_html__( 'Yes', 'museum-core' ),
                'label_off' =>esc_html__( 'No', 'museum-core' ),
                'condition' => [
                    'ekit_icon_box_enable_btn' => 'yes',
                ]
            ]
        );

        $this->add_control(
            'ekit_icon_box_icons',
            [
                'label' =>esc_html__( 'Icon', 'museum-core' ),
                'type' => Controls_Manager::ICONS,
                'fa4compatibility' => 'ekit_icon_box_icon',
                'default' => [
                    'value' => '',
                ],
                'label_block' => true,
                'condition' => [
                    'ekit_icon_box_enable_btn' => 'yes',
                    'ekit_icon_box_icons__switch'   => 'yes'
                ]
            ]
        );
        $this->add_control(
            'ekit_icon_box_icon_align',
            [
                'label' =>esc_html__( 'Icon Position', 'museum-core' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'left',
                'options' => [
                    'left' =>esc_html__( 'Before', 'museum-core' ),
                    'right' =>esc_html__( 'After', 'museum-core' ),
                ],
                'condition' => [
                    'ekit_icon_box_icons__switch'   => 'yes',
                    'ekit_icon_box_enable_btn'      => 'yes',
                ],
            ]
        );

        $this->add_control(
            'ekit_icon_box_show_global_link',
            [
                'label' => esc_html__( 'Global Link', 'museum-core' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Yes', 'museum-core' ),
                'label_off' => esc_html__( 'No', 'museum-core' ),
                'return_value' => 'yes',
                'default' => 'yes',
                'condition' => [
                    'ekit_icon_box_enable_btn!' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'ekit_icon_box_global_link',
            [
                'label' => esc_html__( 'Link', 'museum-core' ),
                'type' => Controls_Manager::URL,
                'placeholder' => esc_html__( 'https://your-link.com', 'museum-core' ),
                'show_external' => true,
                'default' => [
                    'url' => 'https://your-link.com',
                ],
                'dynamic' => [
                    'active' => true,
                ],
                'condition' => [
                    'ekit_icon_box_show_global_link' => 'yes',
                    'ekit_icon_box_enable_btn!' => 'yes',
                ],
            ]
        );

        $this->end_controls_section();

        //  Settings
        $this->start_controls_section(
            'ekit_icon_box_section_settings',
            [
                'label' => esc_html__( 'Settings', 'museum-core' ),
            ]
        );

        $this->add_control(
            'ekit_icon_box_enable_water_mark',
            [
                'label' => esc_html__( 'Enable Hover Water Mark ', 'museum-core' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Yes', 'museum-core' ),
                'label_off' => esc_html__( 'No', 'museum-core' ),
                'return_value' => 'yes',
                'default' => '',
            ]
        );

        $this->add_control(
            'ekit_icon_box_water_mark_icons',
            [
                'label' => esc_html__( 'Social Icons', 'museum-core' ),
                'type' => Controls_Manager::ICONS,
                'fa4compatibility' => 'ekit_icon_box_water_mark_icon',
                'default' => [
                    'value' => 'icon icon-review',
                    'library' => 'ekiticons',
                ],
                'label_block' => true,
                'condition' => [
                      'ekit_icon_box_enable_water_mark' => 'yes'
                ]
            ]
        );



        $this->add_control(
            'ekit_icon_box_icon_position',
            [
                'label' => esc_html__( 'Icon Position', 'museum-core' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'top',
                'options' => [
                    'top'  => esc_html__( 'Top', 'museum-core' ),
                    'left'  => esc_html__( 'Left', 'museum-core' ),
                    'right'  => esc_html__( 'Right', 'museum-core' ),
                ],
                'separator' => 'before',
                'condition' => [
                    'ekit_icon_box_header_icons__switch'    => 'yes',
                    'ekit_icon_box_enable_header_icon!' => 'none',
                ]
            ]
        );

        $this->add_control(
            'ekit_icon_box_text_align_responsive',
            [
                'label' => esc_html__( 'Content Alignment', 'museum-core' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => esc_html__( 'Left', 'museum-core' ),
                        'icon' => 'fa fa-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__( 'Center', 'museum-core' ),
                        'icon' => 'fa fa-align-center',
                    ],
                    'right' => [
                        'title' => esc_html__( 'Right', 'museum-core' ),
                        'icon' => 'fa fa-align-right',
                    ],
                ],
                'toggle' => true,
                'separator' => 'before',
            ]
        );
        $this->add_control(
            'ekit_icon_box_title_size',
            [
                'label' => esc_html__( 'Title HTML Tag', 'museum-core' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'h1' => 'H1',
                    'h2' => 'H2',
                    'h3' => 'H3',
                    'h4' => 'H4',
                    'h5' => 'H5',
                    'h6' => 'H6',
                    'div' => 'div',
                    'span' => 'span',
                    'p' => 'p',
                ],
                'default' => 'h3',
                'separator' => 'before',
            ]
        );
        $this->end_controls_section();

        $this->start_controls_section(
            'ekit_icon_box_badge_control_tab',
            [
                'label' => esc_html__( 'Badge', 'museum-core' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'ekit_icon_box_badge_control',
            [
                'label' => esc_html__( 'Show Badge', 'museum-core' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Show', 'museum-core' ),
                'label_off' => esc_html__( 'Hide', 'museum-core' ),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );
        $this->add_control(
            'ekit_icon_box_badge_title',
            [
                'label' => esc_html__( 'Title', 'museum-core' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__( 'EXCLUSIVE', 'museum-core' ),
                'placeholder' => esc_html__( 'Type your title here', 'museum-core' ),
                'condition' => [
                    'ekit_icon_box_badge_control' => 'yes'
                ]
            ]
        );

        $this->add_control(
            'ekit_icon_box_badge_position',
            [
                'label' => esc_html__( 'Position', 'museum-core' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'top_left',
                'options' => [
                    'top-0 left-0'  => esc_html__( 'Top Left', 'museum-core' ),
                    'top-0 justify-center' => esc_html__( 'Top Center', 'museum-core' ),
                    'top-0 justify-right' => esc_html__( 'Top Right', 'museum-core' ),
                    // 'center_left' => esc_html__( 'Center Left', 'elementskit-lite' ),
                    'bottom-0 left-0' => esc_html__( 'Bottom Left', 'museum-core' ),
                    'bottom-0 justify-center' => esc_html__( 'Bottom Center', 'museum-core' ),
                    'bottom-0 justify-right' => esc_html__( 'Bottom Right', 'museum-core' ),
                ],
                'condition' => [
                    'ekit_icon_box_badge_control' => 'yes'
                ]
            ]
        );

        $this->end_controls_section();

        // start style for Icon Box Container
        $this->start_controls_section(
            'ekit_icon_box_section_background_style',
            [
                'label' => esc_html__( 'Icon Box Container', 'museum-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->start_controls_tabs('ekit_icon_box_style_background_tab');
        $this->start_controls_tab(
            'ekit_icon_box_section_background_style_n_tab',
            [
                'label' => esc_html__( 'Normal', 'museum-core' ),
            ]
        );
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'ekit_icon_box_infobox_bg_group',
                'label' => esc_html__( 'Background', 'museum-core' ),
                'types' => [ 'classic', 'gradient', 'video' ],
                'selector' => '{{WRAPPER}} .elementskit-infobox',
            ]
        );
        $this->add_responsive_control(
            'ekit_icon_box_infobox_bg_padding',
            [
                'label' => esc_html__( 'Padding', 'museum-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'default' =>     [
                    'top' => '50',
                    'right' => '40',
                    'bottom' => '50',
                    'left' => '40',
                    'unit' => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementskit-infobox' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'ekit_icon_box_infobox_box_shadow_group',
                'label' => esc_html__( 'Box Shadow', 'museum-core' ),
                'selector' => '{{WRAPPER}} .elementskit-infobox',
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'ekit_icon_box_iocnbox_border_group',
                'label' => esc_html__( 'Border', 'museum-core' ),
                'selector' => '{{WRAPPER}} .elementskit-infobox',
            ]
        );
        $this->add_responsive_control(
            'ekit_icon_box_infobox_border_radious',
            [
                'label' => esc_html__( 'Border Radius', 'museum-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .elementskit-infobox' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->start_controls_tab(
            'ekit_icon_box_section_background_style_n_hv_tab',
            [
                'label' => esc_html__( 'Hover', 'museum-core' ),
            ]
        );
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'ekit_icon_box_infobox_bg_hover_group',
                'label' => esc_html__( 'Background', 'museum-core' ),
                'types' => [ 'classic', 'gradient', 'video' ],
                'selector' => '{{WRAPPER}} .elementskit-infobox:hover',
            ]
        );
        $this->add_responsive_control(
            'ekit_icon_box_infobox_bg_padding_inner',
            [
                'label' => esc_html__( 'Padding', 'museum-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],

                'selectors' => [
                    '{{WRAPPER}} .elementskit-infobox:hover' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'ekit_icon_box_infobox_box_shadow_hv_group',
                'label' => esc_html__( 'Box Shadow', 'museum-core' ),
                'selector' => '{{WRAPPER}} .elementskit-infobox:hover',
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'ekit_icon_box_icon_box_border_hv_group',
                'label' => esc_html__( 'Border', 'museum-core' ),
                'selector' => '{{WRAPPER}} .elementskit-infobox:hover',
            ]
        );
        $this->add_responsive_control(
            'ekit_icon_box_infobox_border_radious_hv',
            [
                'label' => esc_html__( 'Border Radius', 'museum-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .elementskit-infobox:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'ekit_icon_box_info_box_hover_animation',
            [
                'label' => esc_html__( 'Hover Animation', 'museum-core' ),
                'type' => Controls_Manager::HOVER_ANIMATION,
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();

        // start content style
        $this->start_controls_section(
            'ekit_icon_section_style_content',
            [
                'label' => esc_html__( 'Content', 'museum-core' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'ekit_icon_heading_title',
            [
                'label' => esc_html__( 'Title', 'museum-core' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_responsive_control(
            'ekit_icon_title_bottom_space',
            [
                'label' => esc_html__( 'Margin', 'museum-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .elementskit-infobox .elementskit-info-box-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'default'=>[
                    'unit' => 'px',
                    'size' => '20',
                ],
            ]
        );

        $this->add_responsive_control(
            'ekit_icon_title_padding',
            [
                'label' => esc_html__( 'Padding', 'museum-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .elementskit-infobox .elementskit-info-box-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'default'    => [
                    'top' => '0',
                    'right' => '0',
                    'bottom' => '0',
                    'left' => '0',
                    'unit' => 'px',
                    'isLinked' => '',
                ],
            ]
        );

        $this->add_control(
            'ekit_icon_title_color',
            [
                'label' => esc_html__( 'Color', 'museum-core' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#000000',
                'selectors' => [
                    '{{WRAPPER}} .elementskit-infobox .elementskit-info-box-title' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'ekit_icon_title_color_hover',
            [
                'label' => esc_html__( 'Color Hover', 'museum-core' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#000000',
                'selectors' => [
                    '{{WRAPPER}} .elementskit-infobox:hover .elementskit-info-box-title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'ekit_icon_title_typography_group',
                'selector' => '{{WRAPPER}} .elementskit-infobox .elementskit-info-box-title',
            ]
        );

        $this->add_control(
            'ekit_icon_heading_description',
            [
                'label' => esc_html__( 'Description', 'museum-core' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'ekit_icon_description_color',
            [
                'label' => esc_html__( 'Color', 'museum-core' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#656565',
                'selectors' => [
                    '{{WRAPPER}} .elementskit-infobox .box-body > p' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'ekit_icon_description_color_hover',
            [
                'label' => esc_html__( 'Color Hover as', 'museum-core' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#656565',
                'selectors' => [
                    '{{WRAPPER}} .elementskit-infobox:hover .box-body > p' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'ekit_icon_description_typography_group',
                'selector' => '{{WRAPPER}} .elementskit-infobox .box-body > p',
            ]
        );


        $this->add_responsive_control(
            'ekit_icon_box_margin',
            [
                'label' => esc_html__( 'Margin', 'museum-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .elementskit-infobox p' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'default' => [
                    'size' => 15,
                    'unit' => 'px',
                ],
            ]
        );

        $this->add_control(
            'ekit_icon_box_watermark',
            [
                'label' => esc_html__( 'Water Mark', 'museum-core' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
                'condition' => [
                    'ekit_icon_box_enable_water_mark' => 'yes',
                ]
            ]
        );

        $this->add_control(
            'ekit_icon_box_watermark_color',
            [
                'label' => esc_html__( 'Water Mark Color', 'museum-core' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#000000',
                'selectors' => [
                    '{{WRAPPER}} .elementskit-infobox:hover .icon-hover' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .elementskit-infobox .icon-hover > svg path'   => 'stroke: {{VALUE}}; fill: {{VALUE}};'
                ],
                'condition' => [
                    'ekit_icon_box_enable_water_mark' => 'yes',
                ]
            ]
        );

        $this->add_responsive_control(
            'ekit_icon_box_watermark_font_size',
            [
                'label' => esc_html__( 'Water Mark Font Size', 'museum-core' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                        'step' => 1,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 100,
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementskit-infobox .icon-hover > i' => 'font-size: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .elementskit-infobox .icon-hover > svg'    => 'max-width: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'ekit_icon_box_enable_water_mark' => 'yes',
                ]
            ]
        );

        $this->end_controls_section();

         // Icon style
         $this->start_controls_section(
            'ekit_icon_box_section_style_icon',
            [
                'label' => esc_html__( 'Icon', 'museum-core' ),
                'tab'   => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'ekit_icon_box_enable_header_icon!' => 'none',
                    'ekit_icon_box_header_icons__switch'    => 'yes'
                ]
            ]
        );

        $this->start_controls_tabs( 'ekit_icon_box_icon_colors' );

        $this->start_controls_tab(
            'ekit_icon_box_icon_colors_normal',
            [
                'label' => esc_html__( 'Normal', 'museum-core' ),
            ]
        );

        $this->add_control(
            'ekit_icon_box_icon_primary_color',
            [
                'label' => esc_html__( 'Icon Color', 'museum-core' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#656565',
                'selectors' => [
                    '{{WRAPPER}} .elementkit-infobox-icon' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .elementskit-info-box-icon > svg path' => 'fill: {{VALUE}}; stroke: {{VALUE}};'
                ],
                'condition' => [
                    'ekit_icon_box_enable_header_icon' => 'icon'
                ]
            ]
        );

        $this->add_control(
            'ekit_icon_box_icon_secondary_color_normal',
            [
                'label' => esc_html__( 'Icon BG Color', 'museum-core' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .elementskit-info-box-icon' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'ekit_icon_box_border',
                'label' => esc_html__( 'Border', 'museum-core' ),
                'selector' => '{{WRAPPER}} .elementskit-info-box-icon',
            ]
        );



        $this->add_responsive_control(
            'ekit_icon_box_icon_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'museum-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .elementskit-info-box-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'ekit_icon_icon_box_shadow_normal_group',
                'selector' => '{{WRAPPER}} .elementskit-infobox .elementskit-info-box-icon',
            ]
        );
        $this->end_controls_tab();

        $this->start_controls_tab(
            'ekit_icon_box_icon_colors_hover',
            [
                'label' => esc_html__( 'Hover', 'museum-core' ),
            ]
        );

        $this->add_control(
            'ekit_icon_box_hover_primary_color',
            [
                'label' => esc_html__( 'Icon Hover Color', 'museum-core' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .elementskit-infobox:hover .elementskit-info-box-icon i' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .elementskit-infobox:hover .elementskit-info-box-icon svg path' => 'fill: {{VALUE}}; stroke: {{VALUE}};',
                ],
                'condition' => [
                    'ekit_icon_box_enable_header_icon' => 'icon'
                ]
            ]
        );

        $this->add_control(
            'ekit_icon_box_hover_background_color',
            [
                'label' => esc_html__( 'Background Color', 'museum-core' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .elementskit-infobox:hover .elementskit-info-box-icon' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'ekit_icon_box_border_icon_group',
                'label' => esc_html__( 'Border', 'museum-core' ),
                'selector' => '{{WRAPPER}} .elementskit-infobox:hover .elementskit-info-box-icon',
            ]
        );

        $this->add_control(
            'ekit_icon_icons_hover_animation',
            [
                'label' => esc_html__( 'Hover Animation', 'museum-core' ),
                'type' =>   Controls_Manager::HOVER_ANIMATION,
            ]
        );
        $this->add_responsive_control(
            'ekit_icon_box_icons_hover_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'museum-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .elementskit-infobox:hover .elementskit-info-box-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'ekit_icon_icon_box_shadow_group',
                'selector' => '{{WRAPPER}} .elementskit-infobox:hover .elementskit-info-box-icon',
            ]
        );
        $this->end_controls_tab();

        $this->end_controls_tabs();
        $this->add_responsive_control(
            'ekit_icon_icon_size',
            [
                'label' => esc_html__( 'Size', 'museum-core' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 6,
                        'max' => 300,
                    ],
                ],
                'default' => [
                    'size' => 40,
                    'unit' => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementskit-infobox .elementskit-info-box-icon i' => 'font-size: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .elementskit-info-box-icon > svg'  => 'max-width: {{SIZE}}{{UNIT}}; height: auto;'
                ],
                'separator' => 'before',
                'condition' => [
                        'ekit_icon_box_enable_header_icon' => 'icon'
                ]
            ]
        );

        $this->add_responsive_control(
            'ekit_icon_box_icon_space',
            [
                'label' => esc_html__( 'Spacing', 'museum-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .elementskit-infobox .elementskit-box-header .elementskit-info-box-icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'default' => [
                    'top' => '',
                    'right' => '',
                    'bottom' => '',
                    'left' => '',
                    'unit' => 'px',
                    'isLinked' => 'true',
                ]
            ]
        );

        $this->add_responsive_control(
            'ekit_icon_icon_padding',
            [
                'label' => esc_html__( 'Padding', 'museum-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .elementskit-infobox .elementskit-info-box-icon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'default' => [
                    'size' => 15,
                    'unit' => 'px',
                ],
            ]
        );

        $this->add_responsive_control(
            'ekit_icon_rotate',
            [
                'label' => esc_html__( 'Rotate', 'museum-core' ),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 0,
                    'unit' => 'deg',
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementskit-infobox .elementskit-info-box-icon' => 'transform: rotate({{SIZE}}{{UNIT}});',
                ],
            ]
        );

        $this->add_responsive_control(
            'ekit_icon_box_icon_height',
            [
                'label' => esc_html__( 'Height', 'museum-core' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 10,
                        'max' => 200,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementskit-infobox .elementskit-info-box-icon ' => 'height: {{SIZE}}{{UNIT}};',
                ],

            ]
        );

        $this->add_responsive_control(
            'ekit_icon_box_icon_width',
            [
                'label' => esc_html__( 'Width', 'museum-core' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 10,
                        'max' => 200,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementskit-infobox .elementskit-info-box-icon' => 'width: {{SIZE}}{{UNIT}};',
                ],


            ]
        );

        $this->add_responsive_control(
            'ekit_icon_box_icon_line_height',
            [
                'label' => esc_html__( 'Line Height', 'museum-core' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 10,
                        'max' => 200,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementskit-infobox .elementkit-infobox-icon' => 'line-height: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .elementskit-infobox .elementskit-info-box-icon' => 'line-height: {{SIZE}}{{UNIT}};',
                ],

            ]
        );

        $this->add_responsive_control(
            'ekit_icon_box_icon_vertical_align',
            [
                'label' => esc_html__( 'Vertical Position ', 'museum-core' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => -200,
                        'max' => 200,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementskit-infobox .elementskit-box-header .elementskit-info-box-icon' => ' -webkit-transform: translateY({{SIZE}}{{UNIT}}); -ms-transform: translateY({{SIZE}}{{UNIT}}); transform: translateY({{SIZE}}{{UNIT}});',
                ],
                'condition' => [
                        'ekit_icon_box_icon_position!' => 'top'
                ]

            ]
        );
        $this->end_controls_section();

       // start Button style
        $this->start_controls_section(
            'ekit_icon_box_section_style',
            [
                'label' => esc_html__( 'Button', 'museum-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'ekit_icon_box_enable_btn' => 'yes',
                ]
            ]
        );
        $this->add_responsive_control(
            'ekit_icon_box_text_padding',
            [
                'label' =>esc_html__( 'Padding', 'museum-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .elementskit-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'ekit_icon_box_text_margin',
            [
                'label' =>esc_html__( 'Margin', 'museum-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .elementskit-btn' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'ekit_icon_box_typography_group',
                'label' =>esc_html__( 'Typography', 'museum-core' ),
                'selector' => '{{WRAPPER}} .elementskit-btn',
            ]
        );
        $this->add_responsive_control(
            'ekit_icon_box_btn_icon_font_size',
            array(
                'label'      => esc_html__( 'Icon Font Size', 'museum-core' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => array(
                    'px', 'em', 'rem',
                ),
                'range'      => array(
                    'px' => array(
                        'min' => 1,
                        'max' => 100,
                    ),
                ),
                'selectors'  => array(
                    '{{WRAPPER}} .elementskit-btn i' => 'font-size: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .elementskit-btn svg'  => 'max-width: {{SIZE}}{{UNIT}};'
                ),
                'condition' => [
                    'ekit_icon_box_icons__switch'   => 'yes',
                ],
            )
        );
        $this->start_controls_tabs( 'tabs_button_style' );

        $this->start_controls_tab(
            'ekit_icon_box_tab_button_normal',
            [
                'label' => esc_html__( 'Normal', 'museum-core' ),
            ]
        );

        $this->add_control(
            'ekit_icon_box_button_text_color',
            [
                'label' => esc_html__( 'Text Color', 'museum-core' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .elementskit-btn' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .elementskit-btn svg path' => 'stroke: {{VALUE}}; fill: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'ekit_icon_box_btn_background_group',
                'label' => esc_html__( 'Background', 'museum-core' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .elementskit-btn',
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'ekit_icon_box_button_border_color_group',
                'label' => esc_html__( 'Border', 'museum-core' ),
                'selector' => '{{WRAPPER}} .elementskit-btn',
            ]
        );
        $this->add_responsive_control(
            'ekit_icon_box_btn_border_radius',
            [
                'label' =>esc_html__( 'Border Radius', 'museum-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px'],
                'default' => [
                    'top' => '',
                    'right' => '',
                    'bottom' => '' ,
                    'left' => '',
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementskit-btn' =>  'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'ekit_icon_box_button_box_shadow',
                'selector' => '{{WRAPPER}} .elementskit-btn',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'ekit_icon_box_tab_button_hover',
            [
                'label' => esc_html__( 'Hover', 'museum-core' ),
            ]
        );

        $this->add_control(
            'ekit_icon_box_btn_hover_color',
            [
                'label' => esc_html__( 'Text Color', 'museum-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementskit-infobox:hover .elementskit-btn' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .elementskit-infobox:hover .elementskit-btn svg path' => 'stroke: {{VALUE}}; fill: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'ekit_icon_box_btn_background_hover_group',
                'label' => esc_html__( 'Background', 'museum-core' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .elementskit-infobox:hover .elementskit-btn',
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'ekit_icon_box_button_border_hv_color_group',
                'label' => esc_html__( 'Border', 'museum-core' ),
                'selector' => '{{WRAPPER}} .elementskit-infobox:hover .elementskit-btn',
            ]
        );
        $this->add_responsive_control(
            'ekit_icon_box_btn_hover_border_radius',
            [
                'label' =>esc_html__( 'Border Radius', 'museum-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px'],
                'default' => [
                    'top' => '',
                    'right' => '',
                    'bottom' => '' ,
                    'left' => '',
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementskit-infobox:hover .elementskit-btn' =>  'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'ekit_icon_box_button_box_shadow_hover_group',
                'selector' => '{{WRAPPER}} .elementskit-infobox:hover .elementskit-btn',
            ]
        );

        $this->add_control(
            'ekit_icon_box_button_hover_animation',
            [
                'label' => esc_html__( 'Animation', 'museum-core' ),
                'type' => Controls_Manager::HOVER_ANIMATION,
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();


        $this->end_controls_section();

        // Background Overlay style
        $this->start_controls_section(
            'ekit_icon_box_section_bg_ovelry_style',
            [
                'label' => esc_html__( 'Background Overlay ', 'museum-core' ),
                'tab' => controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'ekit_icon_box_show_image_overlay',
            [
                'label' => esc_html__( 'Enable Image Overlay', 'museum-core' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Yes', 'museum-core' ),
                'label_off' => esc_html__( 'No', 'museum-core' ),
                'return_value' => 'yes',
                'default' => '',
            ]
        );

        $this->add_control(
            'ekit_icon_box_show_image',
            [
                'label' => esc_html__( 'Choose Image', 'museum-core' ),
                'type' => Controls_Manager::MEDIA,
                'dynamic' => [
                    'active' => true,
                ],
                'default' => [
                    'url' => ElementorUtils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'ekit_icon_box_show_image_overlay' => 'yes',
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'ekit_icon_box_image_ovelry_color',
                'label' => esc_html__( 'Background Overlay Color', 'museum-core' ),
                'types' => [ 'classic','gradient' ],
                'selector' => '{{WRAPPER}} .elementskit-infobox.image-active::before',
                'condition' => [
                    'ekit_icon_box_show_image_overlay' => 'yes',
                ]
            ]
        );

        $this->add_control(
            'ekit_icon_box_show_overlay',
            [
                'label' => esc_html__( 'Enable Overlay', 'museum-core' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Yes', 'museum-core' ),
                'label_off' => esc_html__( 'No', 'museum-core' ),
                'return_value' => 'yes',
                'default' => '',
            ]
        );
        $this->start_controls_tabs(
                'ekit_icon_box_style_bg_overlay_tab',
                [
                        'condition' => [
                            'ekit_icon_box_show_overlay' => 'yes'
                        ]
                ]
        );
        $this->start_controls_tab(
            'ekit_icon_box_section_bg_ov_style_n_tab',
            [
                'label' => esc_html__( 'Normal', 'museum-core' ),
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'ekit_icon_box_bg_ovelry_color',
                'label' => esc_html__( 'Background Overlay Color', 'museum-core' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .elementskit-infobox.gradient-active::before',
            ]
        );
        $this->end_controls_tab();
        $this->start_controls_tab(
            'ekit_icon_box_section_bg_ov_style_n_hv_tab',
            [
                'label' => esc_html__( 'Hover', 'museum-core' ),
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'ekit_icon_box_bg_ovelry_color_hv',
                'label' => esc_html__( 'Background Overlay Color', 'museum-core' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .elementskit-infobox.gradient-active:hover::before',
            ]
        );

        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->add_control(
            'ekit_icon_box_section_bg_hover_color_direction',
            [
                'label' => esc_html__( 'Hover Direction', 'museum-core' ),
                'type' =>   Controls_Manager::CHOOSE,
                'options' => [
                    'hover_from_left' => [
                        'title' => esc_html__( 'From Left', 'museum-core' ),
                        'icon' => 'fa fa-caret-right',
                    ],
                    'hover_from_top' => [
                        'title' => esc_html__( 'From Top', 'museum-core' ),
                        'icon' => 'fa fa-caret-down',
                    ],
                    'hover_from_right' => [
                        'title' => esc_html__( 'From Right', 'museum-core' ),
                        'icon' => 'fa fa-caret-left',
                    ],
                    'hover_from_bottom' => [
                        'title' => esc_html__( 'From Bottom', 'museum-core' ),
                        'icon' => 'fa fa-caret-up',
                    ],

                ],
                'default' => 'hover_from_left',
                'toggle' => true,
                'condition'  => [
                    'ekit_icon_box_show_overlay' => 'yes'
                ]
            ]
        );
        $this->end_controls_section();

        $this->start_controls_section(
            'ekit_icon_box_badge_style_tab',
            [
                'label' => esc_html__( 'Badge', 'museum-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'ekit_icon_box_badge_control' => 'yes',
                    'ekit_icon_box_badge_title!' => ''
                ]
            ]
        );

        $this->add_responsive_control(
            'ekit_icon_box_badge_padding',
            [
                'label' => esc_html__( 'Padding', 'museum-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'default'    => [
                    'top' => '10',
                    'right' => '10',
                    'bottom' => '10',
                    'left' => '10',
                    'unit' => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}} .ekit-badge' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'ekit_icon_box_badge_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'museum-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'default'    => [
                    'top' => '0',
                    'right' => '0',
                    'bottom' => '0',
                    'left' => '0',
                    'unit' => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}} .ekit-badge' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'ekit_icon_box_badge_background',
                'label' => esc_html__( 'Background', 'museum-core' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .ekit-badge',
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'ekit_icon_box_badge_box_shadow',
                'label' => esc_html__( 'Box Shadow', 'museum-core' ),
                'selector' => '{{WRAPPER}} .ekit-badge',
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'ekit_icon_box_badge_typography',
                'label' => esc_html__( 'Typography', 'museum-core' ),
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .ekit-badge',
            ]
        );


        $this->end_controls_section();

        // $this->insert_pro_message();
    }

    protected function render( ) {
        echo '<div class="ekit-wid-con" >';
            $this->render_raw();
        echo '</div>';
    }

    protected function render_raw( ) {
        $settings = $this->get_settings_for_display();

        $icon_image_post =  $settings['ekit_icon_box_icon_position'];
        $icon_pos_class = '';
        $icon_pos_class .= $icon_image_post == 'right'  ? 'elementskit-icon-right' : '';
        $icon_pos_class .= $icon_image_post == 'left'  ? 'flex' : '';
        $content_alignment = $settings['ekit_icon_box_text_align_responsive'];

        if($icon_image_post == 'top'){
            $text_align = $settings['ekit_icon_box_text_align_responsive'].' '.'icon-top-align';
        }else{
            $text_align =  $icon_image_post.' '.'icon-lef-right-aligin';
        }
        $enable_overlay_color = '';
        if($settings['ekit_icon_box_show_overlay'] == 'yes') {
            $enable_overlay_color = 'gradient-active';
        }

        $ekit_icon_box_show_image = '';
        if($settings['ekit_icon_box_show_image_overlay'] == 'yes') {
            $ekit_icon_box_show_image = 'image-active';
        }
        // info box style

        $this->add_render_attribute( 'infobox_wrapper', 'class', 'elementskit-infobox' );
        $this->add_render_attribute( 'infobox_wrapper', 'class', 'text-'.(empty($content_alignment) && $icon_image_post == 'top' ? 'center' : $content_alignment));
        $this->add_render_attribute( 'infobox_wrapper', 'class', 'text-'.$text_align );
        $this->add_render_attribute( 'infobox_wrapper', 'class', 'elementor-animation-' . $settings['ekit_icon_box_info_box_hover_animation'] );
        $this->add_render_attribute( 'infobox_wrapper', 'class', $icon_pos_class );
        $this->add_render_attribute( 'infobox_wrapper', 'class', $enable_overlay_color );
        $this->add_render_attribute( 'infobox_wrapper', 'class', $ekit_icon_box_show_image );
        $this->add_render_attribute( 'infobox_wrapper', 'class', $settings['ekit_icon_box_section_bg_hover_color_direction'] );
        $this->add_render_attribute( 'infobox_wrapper', 'class', 'ekit-hover-btn-horizontal-align-'.$settings['hover_btn_horizontal_align'] );

        // Icon

        $image = '';
        if ( ! empty( $settings['ekit_icon_box_show_image']['url'] ) && $settings['ekit_icon_box_show_image_overlay'] == 'yes') {
            $this->add_render_attribute( 'image', 'src', $settings['ekit_icon_box_show_image']['url'] );
            $this->add_render_attribute( 'image', 'alt', Control_Media::get_image_alt( $settings['ekit_icon_box_show_image'] ) );

            $image_html = Group_Control_Image_Size::get_attachment_image_html( $settings, 'thumbnail', 'ekit_icon_box_show_image' );


            $image = '<figure class="image-hover">' . $image_html . '</figure>';
        }
        // Button
        $btn_text = $settings['ekit_icon_box_btn_text'];
        $btn_url = (! empty( $settings['ekit_icon_box_btn_url']['url'])) ? $settings['ekit_icon_box_btn_url']['url'] : '';

        ?>
        <!-- link opening -->
        <?php if($settings['ekit_icon_box_show_global_link'] == 'yes' && $settings['ekit_icon_box_enable_btn'] != 'yes' && (!empty( $settings['ekit_icon_box_global_link']['url']))) : ?>
        <a href="<?php echo esc_url($settings['ekit_icon_box_global_link']['url'])?>" target="<?php echo esc_attr($settings['ekit_icon_box_global_link']['is_external'] ? '_blank' : '_self');?>" rel="<?php echo esc_attr($settings['ekit_icon_box_global_link']['nofollow'] ? 'nofollow' : '');?>" class="ekit_global_links">
        <?php endif; ?>
        <!-- end link opening -->

        <div <?php echo Utils::render($this->get_render_attribute_string( 'infobox_wrapper' )); ?>>
        <?php if(! empty($settings['ekit_icon_box_header_icons']) && $settings['ekit_icon_box_enable_header_icon'] == 'icon' ) : ?>
            <div class="elementskit-box-header text-center <?php echo 'elementor-animation-'.esc_attr($settings['ekit_icon_icons_hover_animation']); ?>">
                <div class="elementskit-info-box-icon inline-block transition duration-500  <?php echo Utils::render($settings['ekit_icon_box_icon_position'] != 'top' ? 'text-center' : ''); ?>">
                    <?php

                        $migrated = isset( $settings['__fa4_migrated']['ekit_icon_box_header_icons'] );
                        // Check if its a new widget without previously selected icon using the old Icon control
                        $is_new = empty( $settings['ekit_icon_box_header_icon'] );
                        if ( $is_new || $migrated ) {

                            // new icon
                            Icons_Manager::render_icon( $settings['ekit_icon_box_header_icons'], [ 'aria-hidden' => 'true', 'class'  => 'elementkit-infobox-icon' ] );
                        } else {
                            ?>
                            <i class="<?php echo $settings['ekit_icon_box_header_icon']; ?> elementkit-infobox-icon" aria-hidden="true"></i>
                            <?php
                        }
                    ?>

                </div>
          </div>
        <?php endif;?>
        <?php if(! empty($settings['ekit_icon_box_header_image']) && $settings['ekit_icon_box_enable_header_icon'] == 'image' ) : ?>
            <div class="elementskit-box-header">
                <div class="elementskit-info-box-icon <?php echo Utils::render($settings['ekit_icon_box_icon_position'] != 'top' ? 'text-center' : ''); ?>">
                    <img src="<?php echo esc_url($settings['ekit_icon_box_header_image']['url'])?>" alt="<?php echo  esc_attr($settings['ekit_icon_box_title_text']); ?>">
                </div>
          </div>
        <?php endif;?>
        <div class="box-body">
            <?php if ($settings['ekit_icon_box_title_text'] != '') { ?>
                <<?php echo Utils::render($settings['ekit_icon_box_title_size']); ?> class="elementskit-info-box-title">
                    <?php echo esc_html($settings['ekit_icon_box_title_text']); ?>
                </<?php echo Utils::render($settings['ekit_icon_box_title_size']); ?>>
            <?php } ?>
            <?php if($settings['ekit_icon_box_description_text'] != ''): ?>
            <p><?php echo Utils::kses($settings['ekit_icon_box_description_text'] ); ?> </p>
            <?php endif; ?>
            <?php if($settings['ekit_icon_box_enable_btn'] == 'yes') :  ?>
                <div class="box-footer <?php if($settings['ekit_icon_box_enable_hover_btn']== 'yes'){echo esc_attr("enable_hover_btn");} else {echo esc_attr("disable_hover_button");}?>">
                    <div class="btn-wraper">
                        <?php
                            switch ($settings['ekit_icon_box_icon_align']) {
                                case 'right': ?>
                                    <a href="<?php echo esc_url( $btn_url ); ?>"  target="<?php echo esc_attr($settings['ekit_icon_box_btn_url']['is_external'] ? '_blank' : '_self');?>" rel="<?php echo esc_attr($settings['ekit_icon_box_btn_url']['nofollow'] ? 'nofollow' : '');?>" class="elementskit-btn <?php echo isset($settings['ekit_icon_box_button_hover_animation']) ? 'elementor-animation-'.$settings['ekit_icon_box_button_hover_animation'] : ''; ?>">
                                        <?php echo esc_html( $btn_text ); ?>

                                        <?php
                                            // new icon
                                            $migrated = isset( $settings['__fa4_migrated']['ekit_icon_box_icons'] );
                                            // Check if its a new widget without previously selected icon using the old Icon control
                                            $is_new = empty( $settings['ekit_icon_box_icon'] );
                                            if ( $is_new || $migrated ) {

                                                // new icon
                                                Icons_Manager::render_icon( $settings['ekit_icon_box_icons'], [ 'aria-hidden' => 'true' ] );
                                            } else {
                                                ?>
                                                <i class="<?php echo $settings['ekit_icon_box_icon']; ?>" aria-hidden="true"></i>
                                                <?php
                                            }
                                        ?>

                                    </a>
                                    <?php break;
                                case 'left': ?>
                                    <a href="<?php echo esc_url( $btn_url ); ?>" target="<?php echo esc_attr($settings['ekit_icon_box_btn_url']['is_external'] ? '_blank' : '_self');?>" rel="<?php echo esc_attr($settings['ekit_icon_box_btn_url']['nofollow'] ? 'nofollow' : '');?>" class="elementskit-btn <?php echo isset($settings['ekit_icon_box_button_hover_animation']) ? 'elementor-animation-'.$settings['ekit_icon_box_button_hover_animation'] : ''; ?>">
                                        <?php
                                            // new icon
                                            $migrated = isset( $settings['__fa4_migrated']['ekit_icon_box_icons'] );
                                            // Check if its a new widget without previously selected icon using the old Icon control
                                            $is_new = empty( $settings['ekit_icon_box_icon'] );
                                            if ( $is_new || $migrated ) {

                                                // new icon
                                                Icons_Manager::render_icon( $settings['ekit_icon_box_icons'], [ 'aria-hidden' => 'true' ] );
                                            } else {
                                                ?>
                                                <i class="<?php echo $settings['ekit_icon_box_icon']; ?>" aria-hidden="true"></i>
                                                <?php
                                            }
                                        ?>
                                        <?php echo esc_html( $btn_text ); ?>
                                    </a>
                                    <?php break;
                                default: ?>
                                    <a href="<?php echo esc_url( $btn_url ); ?>" target="<?php echo esc_attr($settings['ekit_icon_box_btn_url']['is_external'] ? '_blank' : '_self');?>" rel="<?php echo esc_attr($settings['ekit_icon_box_btn_url']['nofollow'] ? 'nofollow' : '');?>" class="elementskit-btn <?php echo isset($settings['ekit_icon_box_button_hover_animation']) ? 'elementor-animation-'.$settings['ekit_icon_box_button_hover_animation'] : ''; ?>">
                                        <?php echo esc_html( $btn_text ); ?>
                                    </a>
                                    <?php break;
                            }
                        ?>
                    </div>
                </div>
            <?php endif; ?>
        </div>
        <?php if(!empty($settings['ekit_icon_box_enable_water_mark']) && $settings['ekit_icon_box_enable_water_mark'] == 'yes') :  ?>

        <div class="icon-hover">
            <?php
                // new icon
                $migrated = isset( $settings['__fa4_migrated']['ekit_icon_box_water_mark_icons'] );
                // Check if its a new widget without previously selected icon using the old Icon control
                $is_new = empty( $settings['ekit_icon_box_water_mark_icon'] );
                if ( $is_new || $migrated ) {
                    // new icon
                    Icons_Manager::render_icon( $settings['ekit_icon_box_water_mark_icons'], [ 'aria-hidden' => 'true' ] );
                } else {
                    ?>
                    <i class="<?php echo $settings['ekit_icon_box_water_mark_icon']; ?>" aria-hidden="true"></i>
                    <?php
                }
            ?>
        </div>

        <?php endif; ?>

        <?php if(!empty($settings['ekit_icon_box_show_image_overlay']) && $settings['ekit_icon_box_show_image_overlay'] == 'yes') :  ?>
            <?php echo Utils::render($image); ?>
        <?php endif; ?>

        <?php if($settings['ekit_icon_box_badge_control'] == 'yes' && $settings['ekit_icon_box_badge_title'] != '') : ?>
            <div class="absolute flex w-full <?php echo esc_attr($settings['ekit_icon_box_badge_position']);?>">
                <span class="ekit-badge"><?php echo esc_html($settings['ekit_icon_box_badge_title'])?></span>
            </div>
        <?php endif; ?>
        </div>
        <?php
        // link Closing
        if($settings['ekit_icon_box_show_global_link'] == 'yes' && $settings['ekit_icon_box_enable_btn'] != 'yes' && (!empty( $settings['ekit_icon_box_global_link']['url']))) : ?>
        </a>
        <?php endif; // end link Closing
        
    }
    protected function _content_template() { }
}
