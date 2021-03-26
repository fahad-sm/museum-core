<?php
/**
 * @author Shahbaz Ahmed <shehbaz2009@gmail.com>
 * @package   Student Elementor
 * @version   0.0.1
 **/
namespace MuseumCore\Elementor\Classes\Modules;

use Elementor\Core\DynamicTags\Tag;
use Elementor\Modules\DynamicTags\Module;
use MuseumCore\Elementor\Classes\MuseumModules;

class PostId extends Tag {
	public function get_name() {
		return 'WE_Post_ID';
	}

	public function get_title() {
		return __( 'Post ID', 'museum-core' );
	}

	public function get_group() {
		return MuseumModules::POST_GROUP;
	}

	public function get_categories() {
		return [ Module::TEXT_CATEGORY ];
	}

	public function render() {
		echo get_the_ID();
	}
}
