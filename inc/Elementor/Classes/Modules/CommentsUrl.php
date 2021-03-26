<?php
/**
 * @author Shahbaz Ahmed <shehbaz2009@gmail.com>
 * @package   Student Elementor
 * @version   0.0.1
 **/
namespace MuseumCore\Elementor\Classes\Modules;

use Elementor\Core\DynamicTags\Data_Tag;
use Elementor\Modules\DynamicTags\Module;
use MuseumCore\Elementor\Classes\MuseumModules;

class CommentsUrl extends Data_Tag {

	public function get_name() {
		return 'WE_Comments_Url';
	}

	public function get_title() {
		return __( 'Comments URL', 'museum-core' );
	}

	public function get_group() {
		return MuseumModules::COMMENTS_GROUP;
	}

	public function get_categories() {
		return [ Module::URL_CATEGORY ];
	}

	public function get_value( array $options = [] ) {
		return get_comments_link();
	}
}
