<?php

Redux::setSection( $opt_name, array(

    'title'         => esc_html__( 'Custom Sidebar Settings', 'student' ),
    'id'            => 'sidebar_setting',
    'desc'          => '',
    'icon'          => 'el el-indent-left',
    'fields'        => array(
        array(
            'id' => 'custom_sidebar_name',
            'type' => 'multi_text',
            'title' => esc_html__('Dynamic Custom Sidebar', 'student'),
            'desc' => esc_html__('This section is used to create custom sidebar', 'student')
            ),
    ),
) );

