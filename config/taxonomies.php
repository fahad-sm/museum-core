<?php

museum_taxonomy(
	esc_html__('Gallery Tag', 'museum-core'),
	esc_html__( 'Gallery Tags', 'museum-core' )
)->setId('gallery-tags')
 ->addToPermalinks()
 ->addPostType('museumwp_gallery');