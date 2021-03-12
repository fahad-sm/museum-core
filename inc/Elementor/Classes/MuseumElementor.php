<?php
/**
 * @author Shahbaz Ahmed <shehbaz2009@gmail.com>
 * @package   Student Elementor
 * @version   0.0.1
 **/
namespace MuseumCore\Elementor\Classes;

use Elementor\Plugin;
use MuseumCore\Elementor\Classes\Controls\ControlImageSelect;
use MuseumCore\Elementor\Classes\Controls\AjaxSelect2;

/**
 * Main Elementor Extension Class
 * The main class that initiates and runs the plugin.
 *
 * @since 0.0.1
 */
class MuseumElementor {

	/**
	 * Constructer
	 *
	 * @since  0.0.1
	 * @access public
	 */
	public function __construct() {
		add_action( 'elementor/elements/categories_registered', [ $this, 'register_cat' ] );
		add_action( 'elementor/controls/controls_registered', [ $this, 'register_controls']);
	}

	/**
	 * Register elements category
	 *
	 * @since  0.0.1
	 * @access public
	 */
	public function register_cat( $elements_manager ) {

		$elements_manager->add_category( 'we-widget', [
			'title' => __( 'Student Elementor', 'museum-core' ),
			'icon'  => 'eicon-library-open',
		] );

	}

	public function register_controls($elementor) {
		
		$controls_manager = \Elementor\Plugin::$instance->controls_manager;

		$controls_manager->register_control( 'imageselect', new ControlImageSelect() );
		$controls_manager->register_control( 'ajaxselect2', new AjaxSelect2() );
	}
}
