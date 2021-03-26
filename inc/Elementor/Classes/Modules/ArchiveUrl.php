<?php
/**
 * @author Shahbaz Ahmed <shehbaz2009@gmail.com>
 * @package   Student Elementor
 * @version   0.0.1
 **/
namespace MuseumCore\Elementor\Classes\Modules;

use Elementor\Modules\DynamicTags\Module;
use MuseumCore\Elementor\Classes\MuseumModules;
use Elementor\Core\DynamicTags\Data_Tag;

class ArchiveUrl extends Data_Tag {

	public function get_name() {
		return 'WE_Archive_Url';
	}

	public function get_group() {
		return MuseumModules::ARCHIVE_GROUP;
	}

	public function get_categories() {
		return [ Module::URL_CATEGORY ];
	}

	public function get_title() {
		return __( 'Archive URL', 'museum-core' );
	}

	public function get_panel_template() {
		return ' ({{ url }})';
	}

	public function get_value( array $options = [] ) {
		return Utils::get_the_archive_url();
	}
}

