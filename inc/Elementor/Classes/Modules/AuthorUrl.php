<?php
/**
 * @author Shahbaz Ahmed <shehbaz2009@gmail.com>
 * @package   Student Elementor
 * @version   0.0.1
 **/
namespace MuseumCore\Elementor\Classes\Modules;

use Elementor\Modules\DynamicTags\Module;
use Elementor\Core\DynamicTags\Data_Tag;
use Elementor\Controls_Manager;
use MuseumCore\Elementor\Classes\MuseumModules;

class AuthorUrl extends Data_Tag {

	public function get_name() {
		return 'WE_Author_Url';
	}

	public function get_group() {
		return MuseumModules::AUTHOR_GROUP;
	}

	public function get_categories() {
		return [ Module::URL_CATEGORY ];
	}

	public function get_title() {
		return __( 'Author URL', 'museum-core' );
	}

	public function get_panel_template_setting_key() {
		return 'url';
	}

	public function get_value( array $options = [] ) {
		$value = '';

		if ( 'archive' === $this->get_settings( 'url' ) ) {
			global $authordata;

			if ( $authordata ) {
				$value = get_author_posts_url( $authordata->ID, $authordata->user_nicename );
			}
		} else {
			$value = get_the_author_meta( 'url' );
		}

		return $value;
	}

	protected function _register_controls() {
		$this->add_control(
			'url',
			[
				'label' => __( 'URL', 'museum-core' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'archive',
				'options' => [
					'archive' => __( 'Author Archive', 'museum-core' ),
					'website' => __( 'Author Website', 'museum-core' ),
				],
			]
		);
	}
}
