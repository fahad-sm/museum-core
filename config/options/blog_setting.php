<?php

Redux::setSection( $opt_name, array(
	'title'  => esc_html__( 'Blog Page Settings', 'museum-core' ),
	'id'     => 'blog_setting',
	'desc'   => '',
	'icon'   => 'el el-indent-left',
	'fields' => array(
		array(
			'id'       => 'blog_default_st',
			'type'     => 'section',
			'title'    => esc_html__( 'Blog Default', 'museum-core' ),
			'indent'   => true,
		),
		array(
			'id'      => 'blog_page_banner',
			'type'    => 'switch',
			'title'   => esc_html__( 'Show Banner', 'museum-core' ),
			'desc'    => esc_html__( 'Enable to show banner on blog', 'museum-core' ),
			'default' => true,
		),
		array(
			'id'       => 'blog_banner_title',
			'type'     => 'text',
			'title'    => esc_html__( 'Banner Section Title', 'museum-core' ),
			'desc'     => esc_html__( 'Enter the title to show in banner section', 'museum-core' ),
			'required' => array( 'blog_page_banner', '=', true ),
		),
		array(
			'id'	=> 'blog_page_background_grad',
		    'type' => 'color_gradient',
		    'title' => esc_html__( 'Background Color' , 'museum-core' ),
		    'subtitle' => esc_html__( 'Choose the gradient color' , 'museum-core' ),
		    'desc' => esc_html__( 'Enter the background color' , 'museum-core' ),
		    'compiler' => true,
		    'output' => array(
		        'background' => '.blog .overlay-gr'
		    ),
		    'default' => array(
		        'from' => 'rgb(241, 145, 0)',
		        'to'	=> 'rgba(199, 64, 64, 0.9)'
		    )
		),
		array(
			'id'       => 'blog_sidebar_layout',
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
			'id'       => 'blog_page_sidebar',
			'type'     => 'select',
			'title'    => esc_html__( 'Sidebar', 'museum-core' ),
			'desc'     => esc_html__( 'Select sidebar to show at blog listing page', 'museum-core' ),
			'required' => array(
				array( 'blog_sidebar_layout', '=', array( 'left', 'right' ) ),
			),
			'data'  => 'sidebars',
		),
		array(
			'id'      => 'blog_post_comments',
			'type'    => 'switch',
			'title'   => esc_html__( 'Show Post Comments', 'museum-core' ),
			'desc'    => esc_html__( 'Enable to show post comments on posts listing', 'museum-core' ),
			'default' => true,
		),

		array(
			'id'      => 'blog_post_author',
			'type'    => 'switch',
			'title'   => esc_html__( 'Show Author', 'museum-core' ),
			'desc'    => esc_html__( 'Enable to show author on posts listing', 'museum-core' ),
			'default' => true,
		),
		array(
			'id'      => 'blog_post_date',
			'type'    => 'switch',
			'title'   => esc_html__( 'Show Post Date', 'museum-core' ),
			'desc'    => esc_html__( 'Enable to show post data on posts listing', 'museum-core' ),
			'default' => true,
		),
		array(
			'id'       => 'blog_default_ed',
			'type'     => 'section',
			'indent'   => false,
			'required' => [ 'blog_source_type', '=', 'd' ],
		),
	),
) );





