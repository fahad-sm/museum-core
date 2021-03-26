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

class RequestParameter extends Tag {
	public function get_name() {
		return 'WE_Request_Parameter';
	}

	public function get_title() {
		return __( 'Request Parameter', 'museum-core' );
	}

	public function get_group() {
		return MuseumModules::SITE_GROUP;
	}

	public function get_categories() {
		return [
			Module::TEXT_CATEGORY,
			Module::POST_META_CATEGORY,
		];
	}

	public function render() {
		$settings     = $this->get_settings();
		$request_type = isset( $settings['request_type'] ) ? strtoupper( $settings['request_type'] ) : false;
		$param_name   = isset( $settings['param_name'] ) ? $settings['param_name'] : false;
		$value        = '';

		if ( ! $param_name || ! $request_type ) {
			return '';
		}

		switch ( $request_type ) {
			case 'POST':
				if ( ! isset( $_POST[ $param_name ] ) ) {
					return '';
				}
				$value = $_POST[ $param_name ];
				break;
			case 'GET':
				if ( ! isset( $_GET[ $param_name ] ) ) {
					return '';
				}
				$value = $_GET[ $param_name ];
				break;
			case 'QUERY_VAR':
				$value = get_query_var( $param_name );
				break;
		}
		echo wp_kses_post( $value );
	}

	protected function _register_controls() {
		$this->add_control(
			'request_type',
			[
				'label'   => __( 'Type', 'museum-core' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'get',
				'options' => [
					'get'       => 'Get',
					'post'      => 'Post',
					'query_var' => 'Query Var',
				],
			]
		);
		$this->add_control(
			'param_name',
			[
				'label' => __( 'Parameter Name', 'museum-core' ),
				'type'  => Controls_Manager::TEXT,
			]
		);
	}
}
