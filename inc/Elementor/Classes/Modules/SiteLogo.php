<?php
/**
 * @author Shahbaz Ahmed <shehbaz2009@gmail.com>
 * @package   Student Elementor
 * @version   0.0.1
 **/
namespace MuseumCore\Elementor\Classes\Modules;

use Elementor\Core\DynamicTags\Data_Tag;
use Elementor\Utils;
use Elementor\Modules\DynamicTags\Module;
use MuseumCore\Elementor\Classes\MuseumModules;

class SiteLogo extends Data_Tag {
	public function get_name() {
		return 'WE_Site_Logo';
	}

	public function get_title() {
		return __( 'Site Logo', 'museum-core' );
	}

	public function get_group() {
		return MuseumModules::SITE_GROUP;
	}

	public function get_categories() {
		return [ Module::IMAGE_CATEGORY ];
	}

	public function get_value( array $options = [] ) {
		$custom_logo_id = get_theme_mod( 'custom_logo' );

		if ( $custom_logo_id ) {
			$url = wp_get_attachment_image_src( $custom_logo_id, 'full' )[0];
		} else {
			$url = Utils::get_placeholder_image_src();
		}

		return [
			'id'  => $custom_logo_id,
			'url' => $url,
		];
	}
}
