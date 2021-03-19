<?php

Redux::setSection( $opt_name, array(
	'title'      => esc_html__( 'Single Post Settings', 'student' ),
	'id'         => 'single_post_setting',
	'desc'       => '',
	'subsection' => true,
	'fields'     => array(
		array(
			'id'      => 'single_source_type',
			'type'    => 'button_set',
			'title'   => esc_html__( 'Single Post Source Type', 'student' ),
			'options' => array(
				'd' => esc_html__( 'Default', 'student' ),
				'e' => esc_html__( 'Elementor', 'student' ),
			),
			'default' => 'd',
		),

		array(
			'id'       => 'single_default_st',
			'type'     => 'section',
			'title'    => esc_html__( 'Post Default', 'student' ),
			'indent'   => true,
			'required' => [ 'single_source_type', '=', 'd' ],
		),
		array(
			'id'      => 'single_post_date',
			'type'    => 'switch',
			'title'   => esc_html__( 'Show Date', 'student' ),
			'desc'    => esc_html__( 'Enable to show post publish date on posts detail page', 'student' ),
			'default' => false,
		),
		array(
			'id'      => 'single_post_author',
			'type'    => 'switch',
			'title'   => esc_html__( 'Show Author', 'student' ),
			'desc'    => esc_html__( 'Enable to show author on posts detail page', 'student' ),
			'default' => false,
		),

		array(
			'id'      => 'single_post_comments',
			'type'    => 'switch',
			'title'   => esc_html__( 'Show Comments', 'student' ),
			'desc'    => esc_html__( 'Enable to show number of comments on posts single page', 'student' ),
			'default' => false,
		),
		array(
			'id'      => 'single_post_tag',
			'type'    => 'switch',
			'title'   => esc_html__( 'Show Tags', 'student' ),
			'desc'    => esc_html__( 'Enable to show post tags on posts single page', 'student' ),
			'default' => false,
		),
		array(
			'id'      => 'facebook_sharing',
			'type'    => 'switch',
			'title'   => esc_html__( 'Show Facebook Post Share', 'student' ),
			'desc'    => esc_html__( 'Enable to show Post Share to Facebook', 'student' ),
			'default' => false,
		),
		array(
			'id'      => 'twitter_sharing',
			'type'    => 'switch',
			'title'   => esc_html__( 'Show Twitter Post Share', 'student' ),
			'desc'    => esc_html__( 'Enable to show Post Share to Twitter', 'student' ),
			'default' => false,
		),
		array(
			'id'      => 'linkedin_sharing',
			'type'    => 'switch',
			'title'   => esc_html__( 'Show Linkedin Post Share', 'student' ),
			'desc'    => esc_html__( 'Enable to show Post Share to Linkedin', 'student' ),
			'default' => false,
		),
		array(
			'id'      => 'pinterest_sharing',
			'type'    => 'switch',
			'title'   => esc_html__( 'Show Pinterest Post Share', 'student' ),
			'desc'    => esc_html__( 'Enable to show Post Share to Pinterest', 'student' ),
			'default' => false,
		),
		array(
			'id'      => 'reddit_sharing',
			'type'    => 'switch',
			'title'   => esc_html__( 'Show Reddit Post Share', 'student' ),
			'desc'    => esc_html__( 'Enable to show Post Share to Reddit', 'student' ),
			'default' => false,
		),
		array(
			'id'      => 'tumblr_sharing',
			'type'    => 'switch',
			'title'   => esc_html__( 'Show Tumblr Post Share', 'student' ),
			'desc'    => esc_html__( 'Enable to show Post Share to Tumblr', 'student' ),
			'default' => false,
		),
		array(
			'id'      => 'digg_sharing',
			'type'    => 'switch',
			'title'   => esc_html__( 'Show Digg Post Share', 'student' ),
			'desc'    => esc_html__( 'Enable to show Post Share to Digg', 'student' ),
			'default' => false,
		),
		array(
			'id'      => 'single_post_author_box',
			'type'    => 'switch',
			'title'   => esc_html__( 'Show Author Box', 'student' ),
			'desc'    => esc_html__( 'Enable to show author box on post detail page.', 'student' ),
			'default' => false,
		),
		array(
			'id'      => 'single_post_author_links',
			'type'    => 'switch',
			'title'   => esc_html__( 'Show Author Social Media', 'student' ),
			'desc'    => esc_html__( 'Enable to show author Social Media on posts detail page', 'student' ),
			'default' => false,
		),
		array(
			'id'    => 'single_post_author_social_share',
			'type'  => 'social_media',
			'title' => esc_html__( 'Author Social Profiles', 'student' ),
			'desc'    => esc_html__( 'show author Social Media on posts detail page', 'student' ),
		),
		array(
			'id'       => 'single_section_default_ed',
			'type'     => 'section',
			'indent'   => false,
			'required' => [ 'single_source_type', '=', 'd' ],
		),
	),
) );





