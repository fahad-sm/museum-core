<?php
namespace MuseumCore\Elementor\Modules\Services;

class Init
{
	/**
	 * Initialize module.
	 * 
	 * @return [type] [description]
	 */
	public static function boot() {
		add_action( 'elementor/widgets/widgets_registered', [__CLASS__, 'elementor'] );
		add_action( 'wp_enqueue_scripts', [__CLASS__, 'enqueue'] );
	}

	/**
	 * Register elementor widget.
	 * 
	 * @param  [type] $elementor [description]
	 * @return [type]            [description]
	 */
	static function elementor($elementor) {
		// $elementor->register_widget_type( new Services );
	}

	static function posts_taxonomies() {

	}

	/**
	 * Enqueue Scripts styles.
	 * @return [type] [description]
	 */
	static function enqueue() {

		$ver = (defined(WP_DEBUG) && WP_DEBUG) ? time() : STUDENT_PLUGIN_VERSION;

		wp_register_script(
			'services_scripts', 
			STUDENT_PLUGIN_URL . 'inc/Elementor/Modules/Services/js/index.js',
			['owl-carousel'],
			$ver,
			true
		);

		wp_register_style(
			'services_style', 
			STUDENT_PLUGIN_URL . 'inc/Elementor/Modules/Services/css/style.css',
			'',
			$ver
		);

		wp_register_style(
			'responsive_services_style', 
			STUDENT_PLUGIN_URL . 'inc/Elementor/Modules/Services/css/responsive.css',
			'',
			$ver
		);
	}
}
