<?php

use MuseumCore\Elementor\Classes\CSSModule;
use MuseumCore\Elementor\Classes\Enqueue;
use MuseumCore\Elementor\Classes\MuseumElementor;
use MuseumCore\Elementor\Classes\MuseumModules;

add_action( 'plugins_loaded', function() {

	if( class_exists('\Elementor\Plugin')) {
		new CSSModule;
		new MuseumElementor;
		new Enqueue;
		new MuseumModules;
	}

}, 50 );