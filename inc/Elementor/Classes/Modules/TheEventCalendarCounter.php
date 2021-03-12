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
use MuseumCore\Elementor\Classes\StudentModules;

class TheEventCalendarCounter extends Tag {

	public function get_name() {
		return 'WE_The_Event_Calendar_Counter';
	}

	public function get_group() {
		return StudentModules::THE_EVENT_GROUP;
	}

	public function get_categories() {
		return [ Module::TEXT_CATEGORY ];
	}

	public function get_title() {
		return __( 'Event Counter', 'museum-core' );
	}

	protected function _register_controls() {

		$this->event_date_counter_controls();
	}

	private function event_date_counter_controls() {
		$this->add_control(
			'date_counter_animation',
			[
				'label'       => __( 'Animation', 'museum-core' ),
				'type'        => Controls_Manager::SELECT,
				'default'     => 'smooth',
				'label_block' => true,
				'options'     => [
					'smooth' => __( 'Smooth', 'museum-core' ),
					'ticks'  => __( 'Ticks', 'museum-core' ),
				],
			]
		);

		$this->add_control(
			'date_counter_circle_bg_color',
			[
				'label'   => __( 'Circle Background ', 'museum-core' ),
				'type'    => Controls_Manager::COLOR,
				'default' => '#000000',
			]
		);

		$this->add_control(
			'date_counter_use_background',
			[
				'label'        => __( 'Use Background', 'museum-core' ),
				'type'         => Controls_Manager::SWITCHER,
				'return_value' => 'true',
				'default'      => 'true',
			]
		);

		$this->add_control(
			'date_counter_fg_width',
			[
				'label'   => __( 'Foreground Circle Width', 'museum-core' ),
				'type'    => Controls_Manager::NUMBER,
				'step'    => 0.01,
				'default' => 0.05,
			]
		);

		$this->add_control(
			'date_counter_bg_width',
			[
				'label'   => __( 'Background Ground Circle Width', 'museum-core' ),
				'type'    => Controls_Manager::NUMBER,
				'step'    => 0.01,
				'default' => 0.5,
			]
		);

		$this->add_control(
			'date_counter_text_size',
			[
				'label'   => __( 'Text Size', 'museum-core' ),
				'type'    => Controls_Manager::NUMBER,
				'step'    => 0.01,
				'max'     => 1,
				'default' => 0.5,
			]
		);

		$this->add_control(
			'date_counter_number_size',
			[
				'label'   => __( 'Number Size ', 'museum-core' ),
				'type'    => Controls_Manager::NUMBER,
				'step'    => 0.01,
				'max'     => 1,
				'default' => 0.5,
			]
		);

		$this->add_control(
			'date_counter_direction',
			[
				'label'   => __( 'Direction', 'museum-core' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'Clockwise',
				'options' => [
					'Clockwise'         => __( 'Clockwise', 'museum-core' ),
					'Counter-clockwise' => __( 'Counter Clockwise', 'museum-core' ),
				],
			]
		);

		$this->add_control(
			'date_counter_days',
			[
				'label'   => __( 'Days Color', 'museum-core' ),
				'type'    => Controls_Manager::COLOR,
				'default' => '#FFCC66',
			]
		);

		$this->add_control(
			'date_counter_days_text',
			[
				'label'   => __( 'Days Text', 'museum-core' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'Days',
			]
		);

		$this->add_control(
			'date_counter_hours',
			[
				'label'   => __( 'Hours Color', 'museum-core' ),
				'type'    => Controls_Manager::COLOR,
				'default' => '#99CCFF',
			]
		);

		$this->add_control(
			'date_counter_hours_text',
			[
				'label'   => __( 'Hours Text', 'museum-core' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'Hours',
			]
		);

		$this->add_control(
			'date_counter_minutes',
			[
				'label'   => __( 'Minutes Color', 'museum-core' ),
				'type'    => Controls_Manager::COLOR,
				'default' => '#BBFFBB',
			]
		);

		$this->add_control(
			'date_counter_minutes_text',
			[
				'label'   => __( 'Minutes Text', 'museum-core' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'Minutes',
			]
		);

		$this->add_control(
			'date_counter_seconds',
			[
				'label'   => __( 'Seconds Color', 'museum-core' ),
				'type'    => Controls_Manager::COLOR,
				'default' => '#FF9999',
			]
		);

		$this->add_control(
			'date_counter_seconds_text',
			[
				'label'   => __( 'Seconds Text', 'museum-core' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'Seconds',
			]
		);
	}

	public function render() {
		$settings = $this->get_settings();

		$settings['post_meta_get'] = get_post_meta( get_the_ID() );

		echo $this->date_counter( $settings );


	}

	private function location( $settings ) {

		if ( empty( webinane_el_set( $settings['post_meta_get'], '_EventVenueID' ) ) ) {
			return;
		}

		$location_meta = get_post_meta( webinane_el_set( webinane_el_set( $settings['post_meta_get'], '_EventVenueID' ), 0 ) );

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
