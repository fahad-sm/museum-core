<?php
/**
 * @author Shahbaz Ahmed <shehbaz2009@gmail.com>
 * @package   Student Elementor
 * @version   0.0.1
 **/
namespace MuseumCore\Elementor\Classes\Modules;

use Elementor\Core\DynamicTags\Tag;
use Elementor\Modules\DynamicTags\Module;
use MuseumCore\Elementor\Classes\MuseumModules;
use Elementor\Controls_Manager;

class QueryVar extends Tag {

	public function get_name() {
		return 'WE_Query_Var';
	}

	public function get_title() {
		return __( 'Query Var', 'museum-core' );
	}

	public function get_group() {
		return MuseumModules::POST_GROUP;
	}

	public function get_categories() {
		return [ Module::TEXT_CATEGORY, Module::IMAGE_CATEGORY ];
	}

	public function get_panel_template() {
		return ' ({{{ key }}})';
	}

	public function render() {
		$key = $this->get_settings( 'key' );


		if ( empty( $key ) ) {
			return;
		}

		$value = '';
		if( get_query_var($key)) {
			$allowed_html = wp_kses_allowed_html( 'post' );
			echo wp_kses( get_query_var($key), $allowed_html );
		}

	}

	public function get_panel_template_setting_key() {
		return 'key';
	}

	protected function _register_controls() {
		$this->add_control(
			'key',
			[
				'type'	=> Controls_Manager::SELECT2,
				'label' => __( 'Query Var Key', 'museum-core' ),
				'options'	=> apply_filters( 'webinane_elementor/dynamic_tag/query_var_keys', [] )
			]
		);
	}
}
