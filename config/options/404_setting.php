<?php

Redux::setSection( $opt_name, array(
	'title'      => esc_html__( '404 Page Settings', 'museum-core' ),
	'id'         => '404_setting',
	'desc'       => '',
	'subsection' => true,
	'fields'     => array(
		array(
			'id'      => '404_source_type',
			'type'    => 'button_set',
			'title'   => esc_html__( '404 Source Type', 'museum-core' ),
			'options' => array(
				'd' => esc_html__( 'Default', 'museum-core' ),
				'e' => esc_html__( 'Elementor', 'museum-core' ),
			),
			'default' => 'd',
		),
		array(
			'id'       => '404_elementor_template',
			'type'     => 'select',
			'title'    => __( 'Template', 'museum-core' ),
			'data'     => 'posts',
			'args'     => [
				'post_type' => [ 'elementor_library' ],
			],
			'required' => [ '404_source_type', '=', 'e' ],
		),
		array(
			'id'       => '404_default_st',
			'type'     => 'section',
			'title'    => esc_html__( '404 Default', 'museum-core' ),
			'indent'   => true,
			'required' => [ '404_source_type', '=', 'd' ],
		),
		array(
			'id'      => '404_page_banner',
			'type'    => 'switch',
			'title'   => esc_html__( 'Show Banner', 'museum-core' ),
			'desc'    => esc_html__( 'Enable to show banner on blog', 'museum-core' ),
			'default' => true,
		),
		array(
			'id'       => '404_banner_title',
			'type'     => 'text',
			'title'    => esc_html__( 'Banner Section Title', 'museum-core' ),
			'desc'     => esc_html__( 'Enter the title to show in banner section', 'museum-core' ),
			'required' => array( '404_page_banner', '=', true ),
		),
		array(
			'id'	=> '404_page_background_grad',
		    'type' => 'color_gradient',
		    'title' => esc_html__( 'Background Color' , 'museum-core' ),
		    'subtitle' => esc_html__( 'Choose the gradient color' , 'museum-core' ),
		    'desc' => esc_html__( 'Enter the background color' , 'museum-core' ),
		    'compiler' => true,
		    'output' => array(
		        '.error404 .overlay-gr'
		    ),
		    'default' => array(
		        'from' => 'rgb(241, 145, 0)',
		        'to'	=> 'rgba(199, 64, 64, 0.9)'
		    )
		),
		array(
			'id'       => 'error_page_image',
			'type'     => 'media',
			'url'      => true,
			'title'    => esc_html__( 'Error Page Image', 'museum-core' ),
			'desc'     => esc_html__( 'Insert Error Page image for banner', 'museum-core' ),
		),
		array(
			'id'    => '404_page_heading',
			'type'  => 'text',
			'title' => esc_html__( 'Main Heading', 'museum-core' ),
			'desc'  => esc_html__( 'Enter 404 section title that you want to show', 'museum-core' ),
		),
		array(
			'id'    => '404_page_title',
			'type'  => 'text',
			'title' => esc_html__( '404 Title', 'museum-core' ),
			'desc'  => esc_html__( 'Enter 404 section title that you want to show', 'museum-core' ),
		),
		array(
			'id'    => '404_page_text',
			'type'  => 'textarea',
			'title' => esc_html__( '404 Page Description', 'museum-core' ),
			'desc'  => esc_html__( 'Enter 404 page description that you want to show.', 'museum-core' ),
		),
		array(
			'id'     => '404_post_settings_end',
			'type'   => 'section',
			'indent' => false,
		),
	),
) );