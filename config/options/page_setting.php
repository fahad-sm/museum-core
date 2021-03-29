<?php

Redux::setSection( $opt_name, array(
	'title'      => esc_html__( 'Page Settings', 'museum-core' ),
	'id'         => 'single_page_setting',
	'desc'       => '',
	'icon'		=> 'el el-folder',
	'subsection' => false,
	'fields'     => array(
		
		// Page banner Settings
		array(
			'id'      => 'single_page_show_banner',
			'type'    => 'switch',
			'title'   => esc_html__( 'Show Banner', 'museum-core' ),
			'desc'    => esc_html__( 'Enable to show page banner', 'museum-core' ),
			'default' => false,
		),
		array(
			'id'      => 'single_page_show_breads',
			'type'    => 'switch',
			'title'   => esc_html__( 'Show Breadcrumbs', 'museum-core' ),
			'desc'    => esc_html__( 'Enable to show page Breadcrumbs', 'museum-core' ),
			'default' => false,
		),
		// Page meta settings.		
		array(
			'id'      => 'single_page_source_type',
			'type'    => 'button_set',
			'title'   => esc_html__( 'Source Type', 'museum-core' ),
			'options' => array(
				'd' => esc_html__( 'Default', 'museum-core' ),
				'e' => esc_html__( 'Elementor', 'museum-core' ),
			),
			'default' => 'd',
		),

		array(
			'id'       => 'single_page_default_st',
			'type'     => 'section',
			'title'    => esc_html__( 'Page Default', 'museum-core' ),
			'indent'   => true,
			'required' => [ 'single_page_source_type', '=', 'd' ],
		),
		array(
			'id'      => 'single_page_show_meta',
			'type'    => 'switch',
			'title'   => esc_html__( 'Show Meta', 'museum-core' ),
			'desc'    => esc_html__( 'Enable to show page meta', 'museum-core' ),
			'default' => false,
		),
		array(
			'id'      => 'single_page_date',
			'type'    => 'switch',
			'title'   => esc_html__( 'Show Date', 'museum-core' ),
			'desc'    => esc_html__( 'Enable to show page publish date', 'museum-core' ),
			'default' => false,
			'required' => [ 'single_page_show_meta', '=', true ],
		),
		array(
			'id'      => 'single_page_author',
			'type'    => 'switch',
			'title'   => esc_html__( 'Show Author', 'museum-core' ),
			'desc'    => esc_html__( 'Enable to show author on page', 'museum-core' ),
			'default' => false,
			'required' => [ 'single_page_show_meta', '=', true ],
		),

		array(
			'id'      => 'single_page_comments',
			'type'    => 'switch',
			'title'   => esc_html__( 'Show Comments', 'museum-core' ),
			'desc'    => esc_html__( 'Enable to show number of comments on page', 'museum-core' ),
			'default' => false,
			'required' => [ 'single_page_show_meta', '=', true ],
		),
		array(
			'id'      => 'page_socials_sharing',
			'type'    => 'switch',
			'title'   => esc_html__( 'Enable Social Sharing', 'museum-core' ),
			'desc'    => esc_html__( 'Enable to show social sharing icons', 'museum-core' ),
			'default' => false,
		),
		array(
			'id'      => 'page_facebook_sharing',
			'type'    => 'switch',
			'title'   => esc_html__( 'Show Facebook Page Share', 'museum-core' ),
			'desc'    => esc_html__( 'Enable to show page Share to Facebook', 'museum-core' ),
			'default' => false,
			'required' => [ 'page_socials_sharing', '=', true ],
		),
		array(
			'id'      => 'page_twitter_sharing',
			'type'    => 'switch',
			'title'   => esc_html__( 'Show Twitter Page Share', 'museum-core' ),
			'desc'    => esc_html__( 'Enable to show Post Share to Twitter', 'museum-core' ),
			'default' => false,
			'required' => [ 'page_socials_sharing', '=', true ],
		),
		array(
			'id'      => 'page_linkedin_sharing',
			'type'    => 'switch',
			'title'   => esc_html__( 'Show Linkedin page Share', 'museum-core' ),
			'desc'    => esc_html__( 'Enable to show page Share to Linkedin', 'museum-core' ),
			'default' => false,
			'required' => [ 'page_socials_sharing', '=', true ],
		),
		array(
			'id'      => 'page_pinterest_sharing',
			'type'    => 'switch',
			'title'   => esc_html__( 'Show Pinterest page Share', 'museum-core' ),
			'desc'    => esc_html__( 'Enable to show page Share to Pinterest', 'museum-core' ),
			'default' => false,
			'required' => [ 'page_socials_sharing', '=', true ],
		),
		array(
			'id'      => 'page_reddit_sharing',
			'type'    => 'switch',
			'title'   => esc_html__( 'Show Reddit page Share', 'museum-core' ),
			'desc'    => esc_html__( 'Enable to show page Share to Reddit', 'museum-core' ),
			'default' => false,
			'required' => [ 'page_socials_sharing', '=', true ],
		),
		array(
			'id'      => 'page_tumblr_sharing',
			'type'    => 'switch',
			'title'   => esc_html__( 'Show Tumblr page Share', 'museum-core' ),
			'desc'    => esc_html__( 'Enable to show page Share to Tumblr', 'museum-core' ),
			'default' => false,
			'required' => [ 'page_socials_sharing', '=', true ],
		),
		array(
			'id'      => 'page_digg_sharing',
			'type'    => 'switch',
			'title'   => esc_html__( 'Show Digg page Share', 'museum-core' ),
			'desc'    => esc_html__( 'Enable to show page Share to Digg', 'museum-core' ),
			'default' => false,
			'required' => [ 'page_socials_sharing', '=', true ],
		),
		/*array(
			'id'      => 'single_page_author_box',
			'type'    => 'switch',
			'title'   => esc_html__( 'Show Author Box', 'museum-core' ),
			'desc'    => esc_html__( 'Enable to show author box on page.', 'museum-core' ),
			'default' => false,
			'required' => [ 'page_socials_sharing', '=', true ],
		),
		array(
			'id'      => 'single_page_author_links',
			'type'    => 'switch',
			'title'   => esc_html__( 'Show Author Social Media', 'museum-core' ),
			'desc'    => esc_html__( 'Enable to show author Social Media on page', 'museum-core' ),
			'default' => false,
			'required' => [ 'page_socials_sharing', '=', true ],
		),*/

		array(
			'id'       => 'page_sidebar_layout',
			'type'     => 'image_select',
			'title'    => esc_html__( 'Layout', 'museum-core' ),
			'subtitle' => esc_html__( 'Select main content and sidebar alignment.', 'museum-core' ),
			'options'  => array(

				'left'  => array(
					'alt' => esc_html__( 'Left sidebar', 'museum-core' ),
					'img' => get_template_directory_uri() . '/assets/images/left.png',
				),
				'full'  => array(
					'alt' => esc_html__( 'Full width', 'museum-core' ),
					'img' => get_template_directory_uri() . '/assets/images/full.png',
				),
				'right' => array(
					'alt' => esc_html__( 'Right sidebar', 'museum-core' ),
					'img' => get_template_directory_uri() . '/assets/images/right.png',
				),
			),

			'default' => 'right',
		),

		array(
			'id'       => 'simple_page_sidebar',
			'type'     => 'select',
			'title'    => esc_html__( 'Sidebar', 'museum-core' ),
			'desc'     => esc_html__( 'Select sidebar to show at page', 'museum-core' ),
			'required' => array(
				array( 'page_sidebar_layout', '=', array( 'left', 'right' ) ),
			),
			'data'	=> 'sidebar'
		),
		array(
			'id'       => 'single_page_section_default_ed',
			'type'     => 'section',
			'indent'   => false,
			'required' => [ 'single_source_type', '=', 'd' ],
		),
	),
) );





