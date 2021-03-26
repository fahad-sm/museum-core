<?php
Redux::setSection( $opt_name, array(
	'title'      => esc_html__( 'Header Setting', 'museum-core' ),
	'id'         => 'headers_setting',
	'desc'       => '',
	'subsection' => false,
	'fields'     => array(
		array(
			'id'      => 'header_source_type',
			'type'    => 'button_set',
			'title'   => esc_html__( 'Header Source Type', 'museum-core' ),
			'options' => array(
				'd' => esc_html__( 'Default', 'museum-core' ),
				'e' => esc_html__( 'Elementor', 'museum-core' ),
			),
			'default' => 'd',
		),
		array(
			'id'       => 'header_elementor_template',
			'type'     => 'select',
			'title'    => __( 'Template', 'museum-core' ),
			'data'     => 'posts',
			'args'     => [
				'post_type' => [ 'elementor_library' ],
				'posts_per_page'	=> -1
			],
			'required' => [ 'header_source_type', '=', 'e' ],
		),
		array(
			'id'       => 'header_style_section_start',
			'type'     => 'section',
			'indent'      => true,
			'title'    => esc_html__( 'Topbar Settings', 'museum-core' ),
			'required' => array( 'header_source_type', '=', 'd' ),
		),
		array(
		    'id'       => 'header_topbar_text',
		    'type'     => 'textarea',
		    'title'    => esc_html__( 'Topbar Text', 'museum-core' ),
		    
			'required' => array( 'header_source_type', '=', 'd' ),
			'default' => '<i class="ion-ios-clock-outline"></i> Museum opening hours: 8AM to 7PM. Open all days',
			'desc'	=> esc_html__('You can use HTML tags', 'museum-core')
	    ),
	    array(
		    'id'       => 'header_topbar_phone',
		    'type'     => 'text',
		    'title'    => esc_html__( 'Topbar Phone Number', 'museum-core' ),
			'required' => array( 'header_source_type', '=', 'd' ),
			'default' => '1800 123 4659',
	    ),
	    
		array(
			'id'       => 'header_v1_settings_section_start',
			'type'     => 'section',
			'indent'      => true,
			'title'    => esc_html__( 'Header Main Settings', 'museum-core' ),
			'required' => array( 'header_source_type', '=', 'd' ),
		),
		array(
		    'id'       => 'menu_color',
		    'type'     => 'color',
		    'title'    => esc_html__( 'Menu Color', 'museum-core' ),
		    'desc'     => esc_html__( 'Choose the top level menu color.', 'museum-core' ),
			'default'  => '#616566',
			'output'	=> array('color' => '.ow-navigation .navbar-nav > li > a')
	    ),
	    array(
		    'id'       => 'menu_bg_color',
		    'type'     => 'color',
		    'title'    => esc_html__( 'Menu Background Color', 'museum-core' ),
		    'desc'     => esc_html__( 'Choose the top level menu bg color.', 'museum-core' ),
			'default'  => 'transparent',
			'output'	=> array('background-color' => '.ow-navigation .navbar-nav > li > a')
	    ),
	    array(
		    'id'       => 'active_menu_color',
		    'type'     => 'color',
		    'title'    => esc_html__( 'Active Menu Color', 'museum-core' ),
		    'desc'     => esc_html__( 'Choose the top level active/hover menu color.', 'museum-core' ),
			'default'  => '#000',
			'output'	=> array('color' => '.ow-navigation .navbar-nav > li.current-menu-item > a, .ow-navigation .navbar-nav > li:hover > a')
	    ),
	    array(
		    'id'       => 'active_menu_bg_color',
		    'type'     => 'color',
		    'title'    => esc_html__( 'Active Menu Background Color', 'museum-core' ),
		    'desc'     => esc_html__( 'Choose the top level active/hover bg menu color.', 'museum-core' ),
			'default'  => 'transparent',
			'output'	=> array('background-color' => '.ow-navigation .navbar-nav > li.current-menu-item > a, .ow-navigation .navbar-nav > li:hover > a')
	    ),
	    array(
			'id'       => 'header_v1_menu_settings_section_end',
			'type'     => 'section',
			'indent'      => false,
		),

	    // Dropdown menu settings
		array(
			'id'       => 'header_v1_dropdown_menu_settings_section_start',
			'type'     => 'section',
			'indent'      => true,
			'title'    => esc_html__( 'Dropdown Menu Settings', 'museum-core' ),
			'required' => array( 'header_source_type', '=', 'd' ),
		),
		
		array(
		    'id'       => 'dropdown_menu_wrapper_bg_color',
		    'type'     => 'color',
		    'title'    => esc_html__( 'Menu Wrapper BG Color', 'museum-core' ),
		    'desc'     => esc_html__( 'Choose the background color for dropdown menu wrapper.', 'museum-core' ),
			'default'  => '#fff',
			'output'	=> array('background-color' => '.ow-navigation .navbar-nav > li ul.sub-menu')
	    ),
	    array(
		    'id'       => 'dropdown_menu_color',
		    'type'     => 'color',
		    'title'    => esc_html__( 'Menu Color', 'museum-core' ),
		    'desc'     => esc_html__( 'Choose the dropdown menu color.', 'museum-core' ),
			'default'  => '#616566',
			'output'	=> array('color' => '.ow-navigation .navbar-nav > li ul.sub-menu li > a')
	    ),
	    array(
		    'id'       => 'dropdown_menu_bg_color',
		    'type'     => 'color',
		    'title'    => esc_html__( 'Menu Background Color', 'museum-core' ),
		    'desc'     => esc_html__( 'Choose the dropdown menu bg color.', 'museum-core' ),
			'default'  => 'transparent',
			'output'	=> array('background-color' => '.ow-navigation .navbar-nav > li ul.sub-menu li > a')
	    ),
	    array(
		    'id'       => 'dropdown_active_menu_color',
		    'type'     => 'color',
		    'title'    => esc_html__( 'Active Menu Color', 'museum-core' ),
		    'desc'     => esc_html__( 'Choose the dropdown active/hover menu color.', 'museum-core' ),
			'default'  => '#000',
			'output'	=> array('color' => '.ow-navigation .navbar-nav > li ul li.current-menu-item > a, .ow-navigation .navbar-nav > li ul.sub-menu li:hover > a')
	    ),
	    array(
		    'id'       => 'dropdown_active_menu_bg_color',
		    'type'     => 'color',
		    'title'    => esc_html__( 'Active Menu Background Color', 'museum-core' ),
		    'desc'     => esc_html__( 'Choose the dropdown active/hover bg menu color.', 'museum-core' ),
			'default'  => 'transparent',
			'output'	=> array('background-color' => '.ow-navigation .navbar-nav > li ul.sub-menu li.current-menu-item > a, .ow-navigation .navbar-nav > li ul.sub-menu li:hover > a')
	    ),

		array(
			'id'       => 'header_style_section_end',
			'type'     => 'section',
			'indent'      => false,
			'required' => [ 'header_source_type', '=', 'd' ],
		),
	),
) );
