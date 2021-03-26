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

class TheEventCalendarOrganizer extends Tag {

	public function get_name() {
		return 'WE_The_Event_Calendar_Organizer';
	}

	public function get_group() {
		return MuseumModules::THE_EVENT_GROUP;
	}

	public function get_categories() {
		return [ Module::TEXT_CATEGORY ];
	}

	public function get_title() {
		return __( 'Event Organizer', 'museum-core' );
	}

	protected function _register_controls() {

		$this->event_date_counter_controls();
	}

	private function event_date_counter_controls() {
		$this->add_control(
			'opt',
			[
				'label'       => __( 'Info', 'museum-core' ),
				'type'        => Controls_Manager::SELECT,
				'default'     => 'OrganizerPhone',
				'label_block' => true,
				'options'     => [
					'name'              => __( 'Name', 'museum-core' ),
					'_OrganizerPhone'   => __( 'Phone', 'museum-core' ),
					'_OrganizerWebsite' => __( 'Website', 'museum-core' ),
					'_OrganizerEmail'   => __( 'Email', 'museum-core' ),
				],
			]
		);
	}

	public function render() {
		$settings = $this->get_settings();
		$setting  = get_post_meta( get_the_ID(), '_EventOrganizerID', true );
		if ( $settings['opt'] == 'name' ) {
			echo get_the_title( $setting );

			return;
		}
		$setting = get_post_meta( $setting, $settings['opt'], true );

		?>
		<span class="<?php echo esc_attr( $settings['opt'] ); ?>"><?php echo esc_html( $setting ); ?></span>
		<?php


	}

	private function location( $setting ) {


		if ( $settings['event_get_location'] && is_array( $settings['event_get_location'] ) ) {
			foreach ( $settings['event_get_location'] as $data ) {
				?>
				<span class="<?php echo esc_attr( $data ); ?>"><?php echo esc_html( webinane_el_set( webinane_el_set( $location_meta, $data ), 0 ) ); ?></span>
				<?php
			}
		}
	}

	private function date_counter( $settings ) {

		wp_enqueue_script( 'timer-circles' );
		$data_attribute = [
			'animation'       => $settings['date_counter_animation'],
			'circle_bg_color' => $settings['date_counter_circle_bg_color'],
			'use_background'  => $settings['date_counter_use_background'],
			'fg_width'        => $settings['date_counter_fg_width'],
			'bg_width'        => $settings['date_counter_bg_width'],
			'direction'       => $settings['date_counter_direction'],
			'text_size'       => $settings['date_counter_text_size'],
			'number_size '    => $settings['date_counter_number_size'],
			'time'            => [
				'Days'    => [
					'color' => $settings['date_counter_days'],
					'show'  => true,
					'text'  => $settings['date_counter_days_text'],
				],
				'Hours'   => [
					'color' => $settings['date_counter_hours'],
					'show'  => true,
					'text'  => $settings['date_counter_hours_text'],
				],
				'Minutes' => [
					'color' => $settings['date_counter_minutes'],
					'show'  => true,
					'text'  => $settings['date_counter_minutes_text'],
				],
				'Seconds' => [
					'color' => $settings['date_counter_seconds'],
					'show'  => true,
					'text'  => $settings['date_counter_seconds_text'],
				],
			],
		];
		$start          = webinane_el_set( webinane_el_set( $settings['post_meta_get'], '_EventStartDate' ), 0 );
		$end            = webinane_el_set( webinane_el_set( $settings['post_meta_get'], '_EventEndDate' ), 0 );
		?>
		<div data-attribute='<?php echo esc_attr( json_encode( $data_attribute ) ); ?>' data-date="<?php echo $start; ?>" id="<?php echo $this->get_id(); ?>" class="webinane-time-counter"></div>
		<?php
	}
}
