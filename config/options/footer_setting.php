<?php

Redux::setSection( $opt_name, array(
	'title'      => esc_html__( 'Footer Setting', 'student' ),
	'id'         => 'footer_setting',
	'desc'       => '',
	'subsection' => false,
	'fields'     => array(
		array(
			'id'      => 'footer_source_type',
			'type'    => 'button_set',
			'title'   => esc_html__( 'Footer Source Type', 'student' ),
			'options' => array(
				'd' => esc_html__( 'Default', 'student' ),
				'e' => esc_html__( 'Elementor', 'student' ),
			),
			'default' => 'd',
		),
		array(
			'id'       => 'footer_elementor_template',
			'type'     => 'select',
			'title'    => __( 'Template', 'student' ),
			'data'     => 'posts',
			'args'     => [
				'post_type' => [ 'elementor_library' ],
				'posts_per_page'	=> -1
			],
			'required' => [ 'footer_source_type', '=', 'e' ],
		),
		array(
			'id'       => 'footer_style_section_start',
			'type'     => 'section',
			'indent'      => true,
			'title'    => esc_html__( 'Footer Settings', 'student' ),
			'required' => array( 'footer_source_type', '=', 'd' ),
		),
		array(
		    'id'       => 'footer_style_settings',
		    'type'     => 'image_select',
		    'title'    => esc_html__( 'Choose Footer Styles', 'student' ),
		    'subtitle' => esc_html__( 'Choose Footer Styles', 'student' ),
		    'options'  => array(

			    'footer_v1'  => array(
				    'alt' => esc_html__( 'Footer Style 1', 'student' ),
				    'img' => get_template_directory_uri() . '/assets/images/redux/footer/footer1.png',
			    ),
			    'footer_v2'  => array(
				    'alt' => esc_html__( 'Footer Style 2', 'student' ),
				    'img' => get_template_directory_uri() . '/assets/images/redux/footer/footer2.png',
			    ),
				'footer_v3'  => array(
				    'alt' => esc_html__( 'Footer Style 3', 'student' ),
				    'img' => get_template_directory_uri() . '/assets/images/redux/footer/footer3.png',
			    ),
			    'footer_v4'  => array(
				    'alt' => esc_html__( 'Footer Style 4', 'student' ),
				    'img' => get_template_directory_uri() . '/assets/images/redux/footer/footer4.png',
			    ),
				'footer_v5'  => array(
				    'alt' => esc_html__( 'Footer Style 5', 'student' ),
				    'img' => get_template_directory_uri() . '/assets/images/redux/footer/footer5.png',
			    ),
				'footer_v6'  => array(
				    'alt' => esc_html__( 'Footer Style 6', 'student' ),
				    'img' => get_template_directory_uri() . '/assets/images/redux/footer/footer6.png',
			    ),
			),
			'required' => array( 'footer_source_type', '=', 'd' ),
			'default' => 'footer_v6',
	    ),
		
		
		/***********************************************************************
								Footer Version 1 Start
		************************************************************************/
		array(
			'id'       => 'footer_v1_settings_section_start',
			'type'     => 'section',
			'indent'      => true,
			'title'    => esc_html__( 'Footer Style One Settings', 'student' ),
			'required' => array( 'footer_style_settings', '=', 'footer_v1' ),
		),
		array(
			'id'      => 'footer_menu',
			'type'    => 'textarea',
			'title'   => __( 'Footer Menu html', 'student' ),
			'desc'    => esc_html__( 'Enter the raw html', 'student' ),
			'default' => '',
			'required' => array( 'footer_style_settings', '=', 'footer_v1' ),
		),
		array(
			'id'      => 'copyright_text',
			'type'    => 'textarea',
			'title'   => __( 'Copyright Text', 'student' ),
			'desc'    => esc_html__( 'Enter the Copyright Text', 'student' ),
			'required' => array( 'footer_style_settings', '=', 'footer_v1' ),
		),
		array(
			'id'    => 'footer_v1_social_share',
			'type'  => 'social_media',
			'title' => esc_html__( 'Social Profiles', 'student' ),
			'required' => array( 'footer_style_settings', '=', 'footer_v1' ),
		),
		/***********************************************************************
								Footer Version 2 Start
		************************************************************************/
		array(
			'id'       => 'footer_v2_settings_section_start',
			'type'     => 'section',
			'indent'      => true,
			'title'    => esc_html__( 'Footer Style Two Settings', 'student' ),
			'required' => array( 'footer_style_settings', '=', 'footer_v2' ),
		),
		array(
			'id'       => 'footer_bg_img',
			'type'     => 'media',
			'url'      => true,
			'title'    => esc_html__( 'Footer Background Image', 'student' ),
			'required' => array( 'footer_style_settings', '=', 'footer_v2' ),
		),
		array(
			'id'      => 'copyright_text2',
			'type'    => 'textarea',
			'title'   => __( 'Copyright Text', 'student' ),
			'desc'    => esc_html__( 'Enter the Copyright Text', 'student' ),
			'required' => array( 'footer_style_settings', '=', 'footer_v2' ),
		),
		array(
			'id'      => 'footer_menu_2',
			'type'    => 'textarea',
			'title'   => __( 'Footer Menu html', 'student' ),
			'desc'    => esc_html__( 'Enter the raw html', 'student' ),
			'default' => '',
			'required' => array( 'footer_style_settings', '=', 'footer_v2' ),
		),
		/***********************************************************************
								Footer Version 3 Start
		************************************************************************/
		array(
			'id'       => 'footer_v3_settings_section_start',
			'type'     => 'section',
			'indent'      => true,
			'title'    => esc_html__( 'Footer Style Three Settings', 'student' ),
			'required' => array( 'footer_style_settings', '=', 'footer_v3' ),
		),
		array(
			'id'       => 'footer_bg_img_2',
			'type'     => 'media',
			'url'      => true,
			'title'    => esc_html__( 'Footer Background Image', 'student' ),
			'required' => array( 'footer_style_settings', '=', 'footer_v3' ),
		),
		array(
			'id'      => 'copyright_text_3',
			'type'    => 'textarea',
			'title'   => __( 'Copyright Text', 'student' ),
			'desc'    => esc_html__( 'Enter the Copyright Text', 'student' ),
			'required' => array( 'footer_style_settings', '=', 'footer_v3' ),
		),
		array(
			'id'      => 'footer_menu_3',
			'type'    => 'textarea',
			'title'   => __( 'Footer Menu html', 'student' ),
			'desc'    => esc_html__( 'Enter the raw html', 'student' ),
			'default' => '',
			'required' => array( 'footer_style_settings', '=', 'footer_v3' ),
		),
		array(
			'id'    => 'footer_v3_social_share',
			'type'  => 'social_media',
			'title' => esc_html__( 'Social Profiles', 'student' ),
			'required' => array( 'footer_style_settings', '=', 'footer_v3' ),
		),
		/***********************************************************************
								Footer Version 4 Start
		************************************************************************/
		array(
			'id'       => 'footer_v4_settings_section_start',
			'type'     => 'section',
			'indent'      => true,
			'title'    => esc_html__( 'Footer Style Four Settings', 'student' ),
			'required' => array( 'footer_style_settings', '=', 'footer_v4' ),
		),
		array(
			'id'       => 'bg_image_3',
			'type'     => 'media',
			'url'      => true,
			'title'    => esc_html__( 'Footer Background Image', 'student' ),
			'required' => array( 'footer_style_settings', '=', 'footer_v4' ),
		),
		array(
			'id'      => 'footer_menu_4',
			'type'    => 'textarea',
			'title'   => __( 'Footer Menu html', 'student' ),
			'desc'    => esc_html__( 'Enter the raw html', 'student' ),
			'default' => '',
			'required' => array( 'footer_style_settings', '=', 'footer_v4' ),
		),
		/***********************************************************************
								Footer Version 5 Start
		************************************************************************/
		array(
			'id'       => 'footer_v5_settings_section_start',
			'type'     => 'section',
			'indent'      => true,
			'title'    => esc_html__( 'Footer Style Five Settings', 'student' ),
			'required' => array( 'footer_style_settings', '=', 'footer_v5' ),
		),
		array(
			'id'       => 'bg_image_4',
			'type'     => 'media',
			'url'      => true,
			'title'    => esc_html__( 'Footer Background Image', 'student' ),
			'required' => array( 'footer_style_settings', '=', 'footer_v5' ),
		),
		array(
			'id'      => 'copyright_text5',
			'type'    => 'textarea',
			'title'   => __( 'Copyright Text', 'student' ),
			'desc'    => esc_html__( 'Enter the Copyright Text', 'student' ),
			'required' => array( 'footer_style_settings', '=', 'footer_v5' ),
		),
		array(
			'id'      => 'footer_menu_5',
			'type'    => 'textarea',
			'title'   => __( 'Footer Menu html', 'student' ),
			'desc'    => esc_html__( 'Enter the raw html', 'student' ),
			'default' => '',
			'required' => array( 'footer_style_settings', '=', 'footer_v5' ),
		),
		/***********************************************************************
								Footer Version 6 Start
		************************************************************************/
		array(
			'id'       => 'footer_v6_settings_section_start',
			'type'     => 'section',
			'indent'      => true,
			'title'    => esc_html__( 'Footer Style Six Settings', 'student' ),
			'required' => array( 'footer_style_settings', '=', 'footer_v6' ),
		),
		array(
			'id'      => 'footer_menu6',
			'type'    => 'textarea',
			'title'   => __( 'Footer Menu html', 'student' ),
			'desc'    => esc_html__( 'Enter the raw html', 'student' ),
			'default' => '',
			'required' => array( 'footer_style_settings', '=', 'footer_v6' ),
		),
		array(
			'id'      => 'copyright_text6',
			'type'    => 'textarea',
			'title'   => __( 'Copyright Text', 'student' ),
			'desc'    => esc_html__( 'Enter the Copyright Text', 'student' ),
			'required' => array( 'footer_style_settings', '=', 'footer_v6' ),
		),
		array(
			'id'    => 'footer_v6_social_share',
			'type'  => 'social_media',
			'title' => esc_html__( 'Social Profiles', 'student' ),
			'required' => array( 'footer_style_settings', '=', 'footer_v6' ),
		),
		array(
			'id'       => 'footer_default_ed',
			'type'     => 'section',
			'indent'   => false,
			'required' => [ 'footer_source_type', '=', 'd' ],
		),
	),
) );
