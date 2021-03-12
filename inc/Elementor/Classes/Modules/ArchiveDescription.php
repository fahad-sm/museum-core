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

class ArchiveDescription extends Tag {

	public function get_name() {
		return 'WE_Archive_Description';
	}

	public function get_title() {
		return __( 'Archive Description', 'museum-core' );
	}

	public function get_group() {
		return StudentModules::ARCHIVE_GROUP;
	}

	public function get_categories() {
		return [ Module::TEXT_CATEGORY ];
	}

	public function render() {
		echo wp_kses_post( get_the_archive_description() );
	}
}
