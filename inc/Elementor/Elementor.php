<?php

use MuseumCore\Elementor\Classes\CSSModule;
use MuseumCore\Elementor\Classes\Enqueue;
use MuseumCore\Elementor\Classes\StudentElementor;
use MuseumCore\Elementor\Classes\StudentModules;

add_action( 'plugins_loaded', function() {

	if( class_exists('\Elementor\Plugin')) {
		new CSSModule;
		new StudentElementor;
		new Enqueue;
		new StudentModules;
	}

}, 50 );