<?php

Redux::setSection( $opt_name, array(
	'title'      => esc_html__( 'Single Post Settings', 'museum-core' ),
	'id'         => 'single_post_setting',
	'desc'       => '',
	'subsection' => true,
	'fields'     => array(
		array(
			'id'      => 'single_source_type',
			'type'    => 'button_set',
			'title'   => esc_html__( 'Single Post Source Type', 'museum-core' ),
			'options' => array(
				'd' => esc_html__( 'Default', 'museum-core' ),
				'e' => esc_html__( 'Elementor', 'museum-core' ),
			),
			'default' => 'd',
		),

		array(
			'id'       => 'single_default_st',
			'type'     => 'section',
			'title'    => esc_html__( 'Post Default', 'museum-core' ),
			'indent'   => true,
			'required' => [ 'single_source_type', '=', 'd' ],
		),
		array(
			'id'      => 'single_post_date',
			'type'    => 'switch',
			'title'   => esc_html__( 'Show Date', 'museum-core' ),
			'desc'    => esc_html__( 'Enable to show post publish date on posts detail page', 'museum-core' ),
			'default' => false,
		),
		array(
			'id'      => 'single_post_author',
			'type'    => 'switch',
			'title'   => esc_html__( 'Show Author', 'museum-core' ),
			'desc'    => esc_html__( 'Enable to show author on posts detail page', 'museum-core' ),
			'default' => false,
		),

		array(
			'id'      => 'single_post_comments',
			'type'    => 'switch',
			'title'   => esc_html__( 'Show Comments', 'museum-core' ),
			'desc'    => esc_html__( 'Enable to show number of comments on posts single page', 'museum-core' ),
			'default' => false,
		),
		array(
			'id'      => 'single_post_tag',
			'type'    => 'switch',
			'title'   => esc_html__( 'Show Tags', 'museum-core' ),
			'desc'    => esc_html__( 'Enable to show post tags on posts single page', 'museum-core' ),
			'default' => false,
		),
		array(
			'id'      => 'facebook_sharing',
			'type'    => 'switch',
			'title'   => esc_html__( 'Show Facebook Post Share', 'museum-core' ),
			'desc'    => esc_html__( 'Enable to show Post Share to Facebook', 'museum-core' ),
			'default' => false,
		),
		array(
			'id'      => 'twitter_sharing',
			'type'    => 'switch',
			'title'   => esc_html__( 'Show Twitter Post Share', 'museum-core' ),
			'desc'    => esc_html__( 'Enable to show Post Share to Twitter', 'museum-core' ),
			'default' => false,
		),
		array(
			'id'      => 'linkedin_sharing',
			'type'    => 'switch',
			'title'   => esc_html__( 'Show Linkedin Post Share', 'museum-core' ),
			'desc'    => esc_html__( 'Enable to show Post Share to Linkedin', 'museum-core' ),
			'default' => false,
		),
		array(
			'id'      => 'pinterest_sharing',
			'type'    => 'switch',
			'title'   => esc_html__( 'Show Pinterest Post Share', 'museum-core' ),
			'desc'    => esc_html__( 'Enable to show Post Share to Pinterest', 'museum-core' ),
			'default' => false,
		),
		array(
			'id'      => 'reddit_sharing',
			'type'    => 'switch',
			'title'   => esc_html__( 'Show Reddit Post Share', 'museum-core' ),
			'desc'    => esc_html__( 'Enable to show Post Share to Reddit', 'museum-core' ),
			'default' => false,
		),
		array(
			'id'      => 'tumblr_sharing',
			'type'    => 'switch',
			'title'   => esc_html__( 'Show Tumblr Post Share', 'museum-core' ),
			'desc'    => esc_html__( 'Enable to show Post Share to Tumblr', 'museum-core' ),
			'default' => false,
		),
		array(
			'id'      => 'digg_sharing',
			'type'    => 'switch',
			'title'   => esc_html__( 'Show Digg Post Share', 'museum-core' ),
			'desc'    => esc_html__( 'Enable to show Post Share to Digg', 'museum-core' ),
			'default' => false,
		),
		array(
			'id'      => 'single_post_author_box',
			'type'    => 'switch',
			'title'   => esc_html__( 'Show Author Box', 'museum-core' ),
			'desc'    => esc_html__( 'Enable to show author box on post detail page.', 'museum-core' ),
			'default' => false,
		),
		array(
			'id'      => 'single_post_author_links',
			'type'    => 'switch',
			'title'   => esc_html__( 'Show Author Social Media', 'museum-core' ),
			'desc'    => esc_html__( 'Enable to show author Social Media on posts detail page', 'museum-core' ),
			'default' => false,
		),
		array(
			'id'    => 'single_post_author_social_share',
			'type'  => 'social_media',
			'title' => esc_html__( 'Author Social Profiles', 'museum-core' ),
			'desc'    => esc_html__( 'show author Social Media on posts detail page', 'museum-core' ),
		),
		array(
			'id'       => 'single_section_default_ed',
			'type'     => 'section',
			'indent'   => false,
			'required' => [ 'single_source_type', '=', 'd' ],
		),
	),
) );





