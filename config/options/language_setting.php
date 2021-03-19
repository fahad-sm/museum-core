<?php

Redux::setSection( $opt_name, array(

	'title'         => esc_html__( 'Language Settings', 'student' ),
    'id'            => 'language_settings',
    'desc'          => '',
    'icon'			=> 'el el-globe',
    'fields'        => array(          
		array(
			'id' => 'optLanguage',
			'type' => 'language',
			'desc' => esc_html__('Please upload .mo language file', 'student'),
			)
	),
) );
