<?php
/**
 * @author Shahbaz Ahmed <shehbaz2009@gmail.com>
 * @package   Student Elementor
 * @version   0.0.1
 **/
namespace MuseumCore\Elementor\Classes\Modules;

use Elementor\Core\DynamicTags\Tag;
use Elementor\Controls_Manager;
use Elementor\Modules\DynamicTags\Module;
use MuseumCore\Elementor\Classes\MuseumModules;


class PostCustomField extends Tag {

	public function get_name() {
		return 'WE_Post_Custom_Field';
	}

	public function get_title() {
		return __( 'Post Custom Field', 'museum-core' );
	}

	public function get_group() {
		return MuseumModules::POST_GROUP;
	}

	public function get_categories() {
		return [
			Module::TEXT_CATEGORY,
			Module::URL_CATEGORY,
			Module::POST_META_CATEGORY,
		];
	}

	public function get_panel_template_setting_key() {
		return 'key';
	}

	public function is_settings_required() {
		return true;
	}

	protected function _register_controls() {
		$this->add_control(
			'key',
			[
				'label'   => __( 'Key', 'museum-core' ),
				'type'    => Controls_Manager::SELECT,
				'options' => $this->get_custom_keys_array(),
			]
		);
	}

	public function render() {
		$key = $this->get_settings( 'key' );

		if ( empty( $key ) ) {
			return;
		}

		$value = get_post_meta( get_the_ID(), $key, true );

		echo wp_kses_post( $value );
	}

	static function get_custom_keys_array() {
			global $wpdb;
		$custom_keys = $wpdb->get_results( "SELECT meta_key FROM {$wpdb->prefix}postmeta GROUP BY meta_key" );
		$options     = [
			'' => __( 'Select...', 'museum-core' ),
		];

		foreach( $custom_keys as $key ) {
		    $options[$key->meta_key] = $key->meta_key;
		}

		return $options;
	}
}
