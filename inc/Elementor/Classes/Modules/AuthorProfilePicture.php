<?php
/**
 * @author Shahbaz Ahmed <shehbaz2009@gmail.com>
 * @package   Student Elementor
 * @version   0.0.1
 **/
namespace MuseumCore\Elementor\Classes\Modules;

use Elementor\Modules\DynamicTags\Module;
use Elementor\Core\DynamicTags\Data_Tag;
use MuseumCore\Elementor\Classes\MuseumModules;

class AuthorProfilePicture extends Data_Tag {

	public function get_name() {
		return 'WE_Author_Profile_Picture';
	}

	public function get_title() {
		return __( 'Author Profile Picture', 'museum-core' );
	}

	public function get_group() {
		return MuseumModules::AUTHOR_GROUP;
	}

	public function get_categories() {
		return [ Module::IMAGE_CATEGORY ];
	}

	public function get_value( array $options = [] ) {
		//\Elementor\Utils::set_global_authordata();

		return [
			'id'  => '',
			'url' => get_avatar_url( (int) get_the_author_meta( 'ID' ), array('size' => 235) ),
		];
	}
}
