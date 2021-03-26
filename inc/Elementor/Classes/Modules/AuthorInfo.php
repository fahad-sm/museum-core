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
use MuseumCore\Elementor\Classes\MuseumModules;


class AuthorInfo extends Tag {

	public function get_name() {
		return 'WE_Author_Info';
	}

	public function get_title() {
		return __( 'Author Info', 'museum-core' );
	}

	public function get_group() {
		return MuseumModules::AUTHOR_GROUP;
	}

	public function get_categories() {
		return [ Module::TEXT_CATEGORY ];
	}

	public function render() {
		$key = $this->get_settings( 'key' );

		if ( empty( $key ) ) {
			return;
		}

		$value = get_the_author_meta( $key );

		echo wp_kses_post( $value );
	}

	public function get_panel_template_setting_key() {
		return 'key';
	}

	protected function _register_controls() {
		$this->add_control(
			'key',
			[
				'label' => __( 'Field', 'museum-core' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'description',
				'options' => [
					'description' => __( 'Bio', 'museum-core' ),
					'email' => __( 'Email', 'museum-core' ),
					'url' => __( 'Website', 'museum-core' ),
				],
			]
		);
	}
}
