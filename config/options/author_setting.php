<?php

Redux::setSection( $opt_name, array(
	'title'      => esc_html__( 'Author Page Settings', 'museum-core' ),
	'id'         => 'author_setting',
	'desc'       => '',
	'subsection' => true,
	'fields'     => array(
		array(
			'id'       => 'author_default_st',
			'type'     => 'section',
			'title'    => esc_html__( 'Author Default', 'museum-core' ),
			'indent'   => true,
		),
		array(
			'id'      => 'author_page_banner',
			'type'    => 'switch',
			'title'   => esc_html__( 'Show Banner', 'museum-core' ),
			'desc'    => esc_html__( 'Enable to show banner on blog', 'museum-core' ),
			'default' => true,
		),
		array(
			'id'       => 'author_banner_title',
			'type'     => 'text',
			'title'    => esc_html__( 'Banner Section Title', 'museum-core' ),
			'desc'     => esc_html__( 'Enter the title to show in banner section', 'museum-core' ),
			'default'	=> '%s Archive',
			'required' => array( 'author_page_banner', '=', true ),
		),
		array(
			'id'	=> 'author_page_background_grad',
		    'type' => 'color_gradient',
		    'title' => esc_html__( 'Background Color' , 'museum-core' ),
		    'subtitle' => esc_html__( 'Choose the gradient color' , 'museum-core' ),
		    'desc' => esc_html__( 'Enter the background color' , 'museum-core' ),
		    'compiler' => true,
		    'output' => array(
		        'background' => '.author .overlay-gr'
		    ),
		    'default' => array(
		        'from' => 'rgb(241, 145, 0)',
		        'to'	=> 'rgba(199, 64, 64, 0.9)'
		    )
		),
		array(
			'id'       => 'author_sidebar_layout',
			'type'     => 'image_select',
			'title'    => esc_html__( 'Layout', 'museum-core' ),
			'subtitle' => esc_html__( 'Select main content and sidebar alignment.', 'museum-core' ),
			'options'  => array(

				'left'  => array(
					'alt' => esc_html__( '2 Column Left', 'museum-core' ),
					'img' => get_template_directory_uri() . '/assets/images/left.png',
				),
				'full'  => array(
					'alt' => esc_html__( '1 Column', 'museum-core' ),
					'img' => get_template_directory_uri() . '/assets/images/full.png',
				),
				'right' => array(
					'alt' => esc_html__( '2 Column Right', 'museum-core' ),
					'img' => get_template_directory_uri() . '/assets/images/right.png',
				),
			),

			'default' => 'right',
		),

		array(
			'id'       => 'author_page_sidebar',
			'type'     => 'select',
			'title'    => esc_html__( 'Sidebar', 'museum-core' ),
			'desc'     => esc_html__( 'Select sidebar to show at blog listing page', 'museum-core' ),
			'required' => array(
				array( 'author_sidebar_layout', '=', array( 'left', 'right' ) ),
			),
			'data'  => 'sidebars',
		),
		array(
			'id'       => 'author_default_ed',
			'type'     => 'section',
			'indent'   => false,
			'required' => [ 'author_source_type', '=', 'd' ],
		),
	),
) );





