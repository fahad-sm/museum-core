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


class PostDate extends Tag {
	public function get_name() {
		return 'WE_Post_Date';
	}

	public function get_title() {
		return __( 'Post Date', 'museum-core' );
	}

	public function get_group() {
		return MuseumModules::POST_GROUP;
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
					'F j, Y'  => date( 'F j, Y' ),
					'Y-m-d'   => date( 'Y-m-d' ),
					'm/d/Y'   => date( 'm/d/Y' ),
					'd/m/Y'   => date( 'd/m/Y' ),
					'human'   => __( 'Human Readable', 'museum-core' ),
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
		$date_type = $this->get_settings( 'type' );
		$format    = $this->get_settings( 'format' );

		if ( 'human' === $format ) {
			/* translators: %s: Human readable date/time. */
			$value = sprintf( __( '%s ago', 'museum-core' ), human_time_diff( strtotime( get_post()->{$date_type} ) ) );
		} else {
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

			if ( 'post_date_gmt' === $date_type ) {
				$value = get_the_date( $date_format );
			} else {
				$value = get_the_modified_date( $date_format );
			}
		}
		echo wp_kses_post( $value );
	}
}
