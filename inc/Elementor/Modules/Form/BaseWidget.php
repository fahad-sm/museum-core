<?php
namespace MuseumCore\Elementor\Modules\Form;

use Elementor\Widget_Base;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

abstract class BaseWidget extends Widget_Base {

	public function get_categories() {
		return [ 'we-widget' ];
	}
}
