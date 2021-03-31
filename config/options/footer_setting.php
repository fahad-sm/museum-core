<?php

Redux::setSection( $opt_name, array(
	'title'      => esc_html__( 'Footer Setting', 'museum-core' ),
	'id'         => 'footer_setting',
	'desc'       => '',
	'subsection' => false,
	'fields'     => array(
		array(
			'id'      => 'footer_source_type',
			'type'    => 'button_set',
			'title'   => esc_html__( 'Footer Source Type', 'museum-core' ),
			'options' => array(
				'd' => esc_html__( 'Default', 'museum-core' ),
				'e' => esc_html__( 'Elementor', 'museum-core' ),
			),
			'default' => 'd',
		),
		array(
			'id'       => 'footer_elementor_template',
			'type'     => 'select',
			'title'    => __( 'Template', 'museum-core' ),
			'data'     => 'posts',
			'args'     => [
				'post_type' => [ 'elementor_library' ],
				'posts_per_page'	=> -1
			],
			'required' => [ 'footer_source_type', '=', 'e' ],
		),
		array(
			'id'       => 'footer_bg_color',
			'type'     => 'color',
			'title'    => esc_html__( 'Background Color', 'museum-core' ),
			'default'	=> '#000',
			'required' => [ 'footer_source_type', '=', 'd' ],
			'output'	=> ['background-color' => '.site-footer']
		),
		array(
			'id'       => 'enable_footer_top',
			'type'     => 'switch',
			'title'    => esc_html__( 'Enable Footer Top', 'museum-core' ),
			'default'	=> true,
			'required' => [ 'footer_source_type', '=', 'd' ],
		),
		array(
			'id'       => 'footer_style_top_section_start',
			'type'     => 'section',
			'indent'      => true,
			'title'    => esc_html__( 'Footer Settings', 'museum-core' ),
			'required' => array( 'enable_footer_top', '=', true ),
		),
		array(
			'id'       => 'footer_top_logo',
			'type'     => 'media',
			'title'    => esc_html__( 'Logo', 'museum-core' ),
			'default' => [],
		),
		array(
			'id'       => 'footer_top_menu',
			'type'     => 'select',
			'title'    => esc_html__( 'Menu', 'museum-core' ),
			'data'	   => 'terms',
			'args'		=> [
				'taxonomies'	=> ['nav_menu'],
				'number'	=> -1
			]
		),
		array(
			'id'       => 'footer_style_top_section_end',
			'type'     => 'section',
			'indent'      => false,
			'required' => array( 'enable_footer_top', '=', true ),
		),
		array(
			'id'       => 'enable_footer_bottom',
			'type'     => 'switch',
			'title'    => esc_html__( 'Enable Footer Bottom', 'museum-core' ),
			'default'	=> true,
			'required' => [ 'footer_source_type', '=', 'd' ],
		),
		array(
			'id'       => 'footer_style_bottom_section_start',
			'type'     => 'section',
			'indent'      => true,
			'title'    => esc_html__( 'Footer Bottom', 'museum-core' ),
			'required' => array( 'enable_footer_bottom', '=', true ),
		),
		array(
			'id'       => 'site_footer_address',
			'type'     => 'text',
			'title'    => esc_html__( 'Address', 'museum-core' ),
			'default'	=> '345 National Museum, Melbourne PO 6570',
		),
		array(
			'id'       => 'site_footer_phone',
			'type'     => 'text',
			'title'    => esc_html__( 'Phone', 'museum-core' ),
			'default'	=> '(123) 456-7890',
		),
		array(
			'id'       => 'site_footer_email',
			'type'     => 'text',
			'title'    => esc_html__( 'Email', 'museum-core' ),
			'default'	=> 'mail@example.com',
		),
		array(
			'id'       => 'site_footer_social_links',
			'type'     => 'multi_text',
			'title'    => esc_html__( 'Social Links', 'museum-core' ),
			// 'default'	=> ['Facebook|https://facebook.com', 'Twitter|https://twitter.com']
		),
		array(
			'id'       => 'footer_style_bottom_section_end',
			'type'     => 'section',
			'indent'      => false,
			'required' => array( 'enable_footer_bottom', '=', true ),
		),
	),
) );
