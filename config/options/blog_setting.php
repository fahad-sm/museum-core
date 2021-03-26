<?php

Redux::setSection( $opt_name, array(
	'title'  => esc_html__( 'Blog Page Settings', 'museum-core' ),
	'id'     => 'blog_setting',
	'desc'   => '',
	'icon'   => 'el el-indent-left',
	'fields' => array(
		array(
			'id'      => 'blog_source_type',
			'type'    => 'button_set',
			'title'   => esc_html__( 'Blog Source Type', 'museum-core' ),
			'options' => array(
				'd' => esc_html__( 'Default', 'museum-core' ),
				'e' => esc_html__( 'Elementor', 'museum-core' ),
			),
			'default' => 'd',
		),
		array(
			'id'       => 'blog_elementor_template',
			'type'     => 'select',
			'title'    => __( 'Template', 'museum-core' ),
			'data'     => 'posts',
			'args'     => [
				'post_type' => [ 'elementor_library' ],
				'posts_per_page'=> -1,
			],
			'required' => [ 'blog_source_type', '=', 'e' ],
		),

		array(
			'id'       => 'blog_default_st',
			'type'     => 'section',
			'title'    => esc_html__( 'Blog Default', 'museum-core' ),
			'indent'   => true,
			'required' => [ 'blog_source_type', '=', 'd' ],
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
			'id'       => 'blog_page_background',
			'type'     => 'media',
			'url'      => true,
			'title'    => esc_html__( 'Background Image', 'museum-core' ),
			'desc'     => esc_html__( 'Insert background image for banner', 'museum-core' ),
			'default'  => '',
			'required' => array( 'blog_page_banner', '=', true ),
		),

		array(
			'id'       => 'blog_sidebar_layout',
			'type'     => 'image_select',
			'title'    => esc_html__( 'Layout', 'museum-core' ),
			'subtitle' => esc_html__( 'Select main content and sidebar alignment.', 'museum-core' ),
			'options'  => array(

				'left'  => array(
					'alt' => esc_html__( '2 Column Left', 'museum-core' ),
					'img' => get_template_directory_uri() . '/assets/images/redux/2cl.png',
				),
				'full'  => array(
					'alt' => esc_html__( '1 Column', 'museum-core' ),
					'img' => get_template_directory_uri() . '/assets/images/redux/1col.png',
				),
				'right' => array(
					'alt' => esc_html__( '2 Column Right', 'museum-core' ),
					'img' => get_template_directory_uri() . '/assets/images/redux/2cr.png',
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
			'options'  => museum_get_sidebars(),
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





