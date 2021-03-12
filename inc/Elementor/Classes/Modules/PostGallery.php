<?php
/**
 * @author Shahbaz Ahmed <shehbaz2009@gmail.com>
 * @package   Student Elementor
 * @version   0.0.1
 **/
namespace MuseumCore\Elementor\Classes\Modules;

use Elementor\Core\DynamicTags\Data_Tag;
use Elementor\Modules\DynamicTags\Module;
use MuseumCore\Elementor\Classes\StudentModules;

class PostGallery extends Data_Tag {

	public function get_name() {
		return 'WE_Post_Gallery';
	}

	public function get_title() {
		return __( 'Post Image Attachments', 'museum-core' );
	}

	public function get_group() {
		return StudentModules::POST_GROUP;
	}

	public function get_categories() {
		return [ Module::GALLERY_CATEGORY ];
	}

	public function get_value( array $options = [] ) {
		$images = get_attached_media( 'image' );

		$value = [];

		foreach ( $images as $image ) {
			$value[] = [
				'id' => $image->ID,
			];
		}

		return $value;
	}
}
