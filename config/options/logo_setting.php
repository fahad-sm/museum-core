<?php
Redux::setSection( $opt_name, array(
	'title'      => esc_html__( 'Logo Setting', 'museum-core' ),
	'id'         => 'logo_setting',
	'desc'       => '',
	'subsection' => false,
	'fields'     => array(
		
		array(
			'id'       => 'logo',
			'type'     => 'media',
			'url'      => true,
			'title'    => esc_html__( 'Logo', 'museum-core' ),
			'subtitle' => esc_html__( 'Insert site logo image', 'museum-core' ),
			'default'  => array( 'url' => get_template_directory_uri() . '/assets/images/logo.png' ),
		),
		array(
			'id'       => 'logo_dimension',
			'type'     => 'dimensions',
			'title'    => esc_html__( 'Logo Dimentions', 'museum-core' ),
			'subtitle' => esc_html__( 'Select Logo Dimentions', 'museum-core' ),
			'units'    => array( 'em', 'px', '%' ),
			'default'  => array( 'Width' => '183', 'Height' => '45' ),
		),

	),
) );
