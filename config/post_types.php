<?php

// Clients Post type
museum_post_type(
	esc_html__('Client', 'museum-core'),
	esc_html__('Clients', 'museum-core')
)->setId('museumwp_clients')
 ->addToPermalinks()
 ->setIcon('dashicons-admin-comments');

// Gallery Post Type
museum_post_type(
	esc_html__('Gallery', 'museum-core'),
	esc_html__('Galleries', 'museum-core')
)->setId('museumwp_gallery')
 ->setArgument('supports', ['title', 'editor', 'thumbnail'])
 ->addToPermalinks()
 ->setIcon('dashicons-schedule');
