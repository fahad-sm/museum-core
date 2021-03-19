<?php
Redux::setSection( $opt_name, array(
	'title'      => esc_html__( 'Logo Setting', 'student' ),
	'id'         => 'logo_setting',
	'desc'       => '',
	'subsection' => false,
	'fields'     => array(
		
		array(
			'id'       => 'logo',
			'type'     => 'media',
			'url'      => true,
			'title'    => esc_html__( 'Logo', 'student' ),
			'subtitle' => esc_html__( 'Insert site logo image', 'student' ),
			'default'  => array( 'url' => get_template_directory_uri() . '/assets/images/logo.png' ),
		),
		array(
			'id'       => 'logo_dimension',
			'type'     => 'dimensions',
			'title'    => esc_html__( 'Logo Dimentions', 'student' ),
			'subtitle' => esc_html__( 'Select Logo Dimentions', 'student' ),
			'units'    => array( 'em', 'px', '%' ),
			'default'  => array( 'Width' => '183', 'Height' => '45' ),
		),

	),
) );
