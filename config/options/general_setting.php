<?php
$styles = [];
foreach(range(1, 28) as $val) {
    $styles[$val] = sprintf(esc_html__('Style %s', 'student'), $val);
}


Redux::setSection( $opt_name, array(
    'title'      => esc_html__( 'General Setting', 'student' ),
    'id'         => 'general_setting',
    'desc'       => '',
    'icon'       => 'el el-wrench',
    'fields'     => array(
        array(
            'id' => 'primary_color',
            'type' => 'color',
            'title' => esc_html__('Primary Color', 'student'),
            'default' => '#f19100',
            'compiler'  => true,
            'output'    => array(
                'background-color'  => '.top-bar .call'
            )
        ),
        array(
            'id' => 'theme_preloader',
            'type' => 'switch',
            'title' => esc_html__('Enable Preloader', 'student'),
            'default' => false,
        ),
		array(
			'id'      => 'preloader_text',
			'type'    => 'textarea',
			'title'   => __( 'Preloader Text', 'student' ),
			'desc'    => esc_html__( 'Enter the Preloader Text', 'student' ),
			'default' => 'Museum',
            'required' => array(
                array(
                    'theme_preloader',
                    '=',
                    true
                )
            ),
		),
        array(
            'id'      => 'mailchimp_api_key',
            'type'    => 'text',
            'title'   => __( 'MailChimp API Key', 'student' ),
            'desc'    => sprintf(__( 'Enter the MailChimp API key, you can <a href="%s" target="_blank">API key here</a>', 'student' ), 'https://us12.admin.mailchimp.com/account/api/'),
            'default' => '',
        ),
        array(

            'id'      => 'mailchimp_api_list',
            'type' => 'select',
            'title'   => __( 'MailChimp Subscription List', 'student' ),
            'subtitle' => __( 'Choose from the list' , 'redux_docs_generator' ),
            'desc' => __( 'select the mailchimp subscription list' , 'redux_docs_generator' ),
            'data' => 'callback',
            'args'  => ['museum_core_mailchimp_list'],
            'ajax'  => true,
            'required' => array(
                array(
                    'mailchimp_api_key',
                    'contains',
                    '-us12'
                )
            ),
        ),
        
    ),
) );
