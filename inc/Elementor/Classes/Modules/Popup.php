<?php
/**
 * @author Shahbaz Ahmed <shehbaz2009@gmail.com>
 * @package   Student Elementor
 * @version   0.0.1
 **/
namespace MuseumCore\Elementor\Classes\Modules;

use Elementor\Core\DynamicTags\Tag;
use Elementor\Modules\DynamicTags\Module;
use Elementor\Controls_Manager;
use Elementor\Embed;
use MuseumCore\Elementor\Classes\StudentModules;


class Popup extends Tag {

	private $ids_printed = [];

	public function get_name() {
		return 'popup';
	}

	public function get_title() {
		return __( 'Popup', 'museum-core' );
	}

	public function get_group() {
		return StudentModules::ACTION_GROUP;
	}

	public function get_categories() {
		return [ Module::URL_CATEGORY ];
	}

	// Keep Empty to avoid default advanced section
	protected function register_advanced_section() {
	}

	public function _register_controls() {
		$templates = wp_list_pluck( get_posts( array(
			'post_type'      => 'elementor_library',
			'posts_per_page' => 100,
		) ), 'post_title', 'ID' );

		$this->add_control(
			'template',
			[
				'label'   => __( 'Elementor Template', 'museum-core' ),
				'type'    => Controls_Manager::SELECT,
				'options' => $templates,
			]
		);

	}


	public function render() {
		$settings = $this->get_settings( 'template' );

		if ( ! $settings ) {
			return;
		}

		wp_enqueue_script( array( 'webinane-elementor-module-scripts' ) );

		$priority = array_rand(range(1,100));
		$priority = (!$priority) ? 1 : $priority;
		$id  = $this->get_id();
		$obj = $this;
		if ( $settings ) {

			add_action( 'get_footer', function () use ( $settings, $id, $obj ) {

				if ( ! in_array( $id, $obj->ids_printed ) ) {
					?>
					<div style="display:none" id="<?php echo esc_attr( $id ); ?>">
						<?php echo \Elementor\Plugin::instance()->frontend->get_builder_content_for_display( $settings ); ?>
					</div>
					<?php
					$obj->ids_printed[] = $id;
				}
			}, $priority );
			$url = "#{$id}";
			echo '#action-webinane-elementor-modal|' . esc_attr( $url ) . '|inline';
		}

	}

	/**
	 * Create Action URL.
	 *
	 * @param string $action
	 * @param array  $settings Optional.
	 *
	 * @return string
	 */
	public function create_action_url( $action, array $settings = [] ) {
		return '#' . rawurlencode( sprintf( 'elementor-action:action=%1$s settings=%2$s', $action, base64_encode( wp_json_encode( $settings ) ) ) );
	}
}
