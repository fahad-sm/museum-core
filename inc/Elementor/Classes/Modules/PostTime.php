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
use MuseumCore\Elementor\Classes\StudentModules;

class PostTime extends Tag {
	public function get_name() {
		return 'WE_Post_Time';
	}

	public function get_title() {
		return __( 'Post Time', 'museum-core' );
	}

	public function get_group() {
		return StudentModules::POST_GROUP;
	}

	public function get_categories() {
		return [ Module::TEXT_CATEGORY ];
	}

	protected function _register_controls() {
		$this->add_control(
			'type',
			[
				'label'   => __( 'Type', 'museum-core' ),
				'type'    => Controls_Manager::SELECT,
				'options' => [
					'post_date_gmt'     => __( 'Post Published', 'museum-core' ),
					'post_modified_gmt' => __( 'Post Modified', 'museum-core' ),
				],
				'default' => 'post_date_gmt',
			]
		);

		$this->add_control(
			'format',
			[
				'label'   => __( 'Format', 'museum-core' ),
				'type'    => Controls_Manager::SELECT,
				'options' => [
					'default' => __( 'Default', 'museum-core' ),
					'g:i a'   => date( 'g:i a' ),
					'g:i A'   => date( 'g:i A' ),
					'H:i'     => date( 'H:i' ),
					'custom'  => __( 'Custom', 'museum-core' ),
				],
				'default' => 'default',
			]
		);

		$this->add_control(
			'custom_format',
			[
				'label'       => __( 'Custom Format', 'museum-core' ),
				'default'     => '',
				'description' => sprintf( '<a href="https://codex.wordpress.org/Formatting_Date_and_Time" target="_blank">%s</a>', __( 'Documentation on date and time formatting', 'museum-core' ) ),
				'condition'   => [
					'format' => 'custom',
				],
			]
		);
	}

	public function render() {
		$time_type = $this->get_settings( 'type' );
		$format    = $this->get_settings( 'format' );

		switch ( $format ) {
			case 'default':
				$date_format = '';
				break;
			case 'custom':
				$date_format = $this->get_settings( 'custom_format' );
				break;
			default:
				$date_format = $format;
				break;
		}

		if ( 'post_date_gmt' === $time_type ) {
			$value = get_the_time( $date_format );
		} else {
			$value = get_the_modified_time( $date_format );
		}

		echo wp_kses_post( $value );
	}
}
