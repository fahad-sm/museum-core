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

class TheEventCalendarVenue extends Tag {

	public function get_name() {
		return 'WE_The_Event_Calendar_Venue';
	}

	public function get_group() {
		return MuseumModules::THE_EVENT_GROUP;
	}

	public function get_categories() {
		return [ Module::TEXT_CATEGORY ];
	}

	public function get_title() {
		return __( 'Event Venue', 'museum-core' );
	}

	protected function _register_controls() {
		$this->add_control(
			'opt',
			[
				'label'       => __( 'Info', 'museum-core' ),
				'type'        => Controls_Manager::SELECT,
				'default'     => '_VenueCity',
				'label_block' => true,
				'options'     => [
					'_name'          => __( 'Name', 'museum-core' ),
					'_VenueCity'          => __( 'City', 'museum-core' ),
					'_VenueCountry'       => __( 'Country', 'museum-core' ),
					'_VenueStateProvince' => __( 'State or Province', 'museum-core' ),
					'_VenueAddress'       => __( 'Address', 'museum-core' ),
					'_VenueZip'           => __( 'Zip', 'museum-core' ),
					'_VenuePhone'         => __( 'Phone', 'museum-core' ),
					'_VenueURL'           => __( 'URL', 'museum-core' ),
				],
			]
		);
	}

	public function render() {
		$settings = $this->get_settings();
		$setting  = get_post_meta( get_the_ID() );
		$setting  = get_post_meta( webinane_el_set( webinane_el_set( $setting, '_EventVenueID' ), 0 ), $settings['opt'], true );
		?>
		<?php if($settings['opt'] == '_name'): ?>

			<span class="<?php echo esc_attr( $settings['opt'] ) ?>>"><?php echo esc_html( get_the_title(get_post_meta(get_the_ID(), '_EventVenueID', true) ) ); ?></span>

			<?php else: ?>
				<span class="<?php echo esc_attr( $settings['opt'] ) ?>>"><?php echo esc_html( $setting ); ?></span>
			<?php endif; ?>
		<?php
	}
}
