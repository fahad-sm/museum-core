<?php
/**
 * @author Shahbaz Ahmed <shehbaz2009@gmail.com>
 * @package   Student Elementor
 * @version   0.0.1
 **/
namespace MuseumCore\Elementor\Classes\Modules;

use Elementor\Core\DynamicTags\Tag;
use Elementor\Modules\DynamicTags\Module;
use Elementor\Controls_Manager;
use MuseumCore\Elementor\Classes\StudentModules;


class ArchiveTitle extends Tag {
	public function get_name() {
		return 'WE_Archive_Title';
	}

	public function get_title() {
		return __( 'Archive Title', 'museum-core' );
	}

	public function get_group() {
		return StudentModules::ARCHIVE_GROUP;
	}

	public function get_categories() {
		return [ Module::TEXT_CATEGORY ];
	}

	public function render() {
		$include_context = 'yes' === $this->get_settings( 'include_context' );

		$title = get_page_title( $include_context );

		echo wp_kses_post( $title );
	}

	protected function _register_controls() {
		$this->add_control(
			'include_context',
			[
				'label'   => __( 'Include Context', 'museum-core' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);
	}
}
