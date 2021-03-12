<?php
/**
 * @author Shahbaz Ahmed <shehbaz2009@gmail.com>
 * @package   Student Elementor
 * @version   0.0.1
 **/
namespace MuseumCore\Elementor\Classes\Modules;

use Elementor\Core\DynamicTags\Tag;
use Elementor\Modules\DynamicTags\Module;
use MuseumCore\Elementor\Classes\StudentModules;

class SiteTagline extends Tag {
	public function get_name() {
		return 'WE_Site_Tagline';
	}

	public function get_title() {
		return __( 'Site Tagline', 'museum-core' );
	}

	public function get_group() {
		return StudentModules::SITE_GROUP;
	}

	public function get_categories() {
		return [ Module::TEXT_CATEGORY ];
	}

	public function render() {
		echo wp_kses_post( get_bloginfo( 'description' ) );
	}
}
