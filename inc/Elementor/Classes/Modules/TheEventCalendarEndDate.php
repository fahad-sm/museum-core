<?php
/**
 * @author Shahbaz Ahmed <shehbaz2009@gmail.com>
 * @package   Student Elementor
 * @version   0.0.1
 **/
namespace MuseumCore\Elementor\Classes\Modules;

use Elementor\Modules\DynamicTags\Module;
use Elementor\Core\DynamicTags\Tag;
use Elementor\Controls_Manager;
use MuseumCore\Elementor\Classes\MuseumModules;

class TheEventCalendarEndDate extends Tag {

	public function get_name() {
		return 'WE_The_Event_Calendar_End_Date';
	}

	public function get_group() {
		return MuseumModules::THE_EVENT_GROUP;
	}

	public function get_categories() {
		return [ Module::TEXT_CATEGORY ];
	}

	public function get_title() {
		return __( 'Event End Date', 'museum-core' );
	}

	protected function _register_controls() {
		$this->add_control(
			'format',
			[
				'label'   => __( 'Format', 'museum-core' ),
				'type'    => Controls_Manager::SELECT,
				'options' => [
					'F j, Y' => date( 'F j, Y' ),
					'Y-m-d'  => date( 'Y-m-d' ),
					'm/d/Y'  => date( 'm/d/Y' ),
					'd/m/Y'  => date( 'd/m/Y' ),
					'human'  => __( 'Human Readable', 'museum-core' ),
					'custom' => __( 'Custom', 'museum-core' ),
				],
				'default' => 'Y-m-d',
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
		$format  = $this->get_settings( 'format' );
		$setting = get_post_meta( get_the_ID(), '_EventEndDateUTC', true );

		if ( 'human' === $format ) {
			/* translators: %s: Human readable date/time. */
			$value = sprintf( __( '%s ago', 'museum-core' ), human_time_diff( strtotime( $setting ) ) );
		} else {
			switch ( $format ) {
				case 'custom':
					$date_format = $this->get_settings( 'custom_format' );
					break;
				default:
					$date_format = $format;
					break;
			}


			$value = date( $date_format, strtotime( $setting ) );
		}

		echo wp_kses_post( $value );

	}
}
