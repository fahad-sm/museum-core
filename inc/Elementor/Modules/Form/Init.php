<?php
namespace MuseumCore\Elementor\Modules\Form;

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

		new Ajax;
	}

	/**
	 * Register elementor widget.
	 * 
	 * @param  [type] $elementor [description]
	 * @return [type]            [description]
	 */
	static function elementor($elementor) {
		$elementor->register_widget_type( new FormElementorWidget );
		// $elementor->register_widget_type( new Login );
		// $elementor->register_widget_type( new Registration );
	}

	/**
	 * Enqueue Scripts styles.
	 * @return [type] [description]
	 */
	static function enqueue() {

		$ver = (defined(WP_DEBUG) && WP_DEBUG) ? time() : '1.0';

		wp_register_script(
			'student-elementor-form', 
			STUDENT_PLUGIN_URL . 'inc/Elementor/Modules/Form/js/index.js',
			[],
			$ver,
			true
		);

		wp_register_style(
			'student-elementor-form', 
			STUDENT_PLUGIN_URL . 'inc/Elementor/Modules/Form/css/style.css',
			'',
			$ver
		);
	}
}
