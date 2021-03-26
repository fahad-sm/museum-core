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

class UserInfo extends Tag {

	public function get_name() {
		return 'WE_User_Info';
	}

	public function get_title() {
		return __( 'User Info', 'museum-core' );
	}

	public function get_group() {
		return MuseumModules::SITE_GROUP;
	}

	public function get_categories() {
		return [ Module::TEXT_CATEGORY ];
	}

	public function render() {
		$type = $this->get_settings( 'type' );
		$user = wp_get_current_user();
		if ( empty( $type ) || 0 === $user->ID ) {
			return;
		}

		$value = '';
		switch ( $type ) {
			case 'login':
			case 'email':
			case 'url':
			case 'nicename':
				$field = 'user_' . $type;
				$value = isset( $user->$field ) ? $user->$field : '';
				break;
			case 'id':
			case 'description':
			case 'first_name':
			case 'last_name':
			case 'display_name':
				$value = isset( $user->$type ) ? $user->$type : '';
				break;
			case 'meta':
				$key = $this->get_settings( 'meta_key' );
				if ( ! empty( $key ) ) {
					$value = get_user_meta( $user->ID, $key, true );
				}
				break;
		}

		echo wp_kses_post( $value );
	}

	public function get_panel_template_setting_key() {
		return 'type';
	}

	protected function _register_controls() {
		$this->add_control(
			'type',
			[
				'label'   => __( 'Field', 'museum-core' ),
				'type'    => Controls_Manager::SELECT,
				'options' => [
					''             => __( 'Choose', 'museum-core' ),
					'id'           => __( 'ID', 'museum-core' ),
					'display_name' => __( 'Display Name', 'museum-core' ),
					'login'        => __( 'Username', 'museum-core' ),
					'first_name'   => __( 'First Name', 'museum-core' ),
					'last_name'    => __( 'Last Name', 'museum-core' ),
					'description'  => __( 'Bio', 'museum-core' ),
					'email'        => __( 'Email', 'museum-core' ),
					'url'          => __( 'Website', 'museum-core' ),
					'meta'         => __( 'User Meta', 'museum-core' ),
				],
			]
		);

		$this->add_control(
			'meta_key',
			[
				'label'     => __( 'Meta Key', 'museum-core' ),
				'condition' => [
					'type' => 'meta',
				],
			]
		);
	}
}
