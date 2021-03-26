<?php
/**
 * @author Shahbaz Ahmed <shehbaz2009@gmail.com>
 * @package   Student Elementor
 * @version   0.0.1
 **/

namespace MuseumCore\Elementor\Classes;

class Enqueue {

	/**
	 * Constructer
	 *
	 * @since  0.0.1
	 * @access public
	 */
	public function __construct() {
		add_action( 'wp_enqueue_scripts', [ $this, 'we_register_style' ] );
		add_action( 'wp_enqueue_scripts', [ $this, 'we_register_script' ] );
		add_action( 'elementor/editor/after_enqueue_scripts', [ $this, 'we_editor_style' ] );
		add_action( 'wp_head', [ $this, 'we_wp_head_style' ] );
		add_action( 'wp_enqueue_scripts', [ $this, 'we_wp_script' ] );
	}

	/**
	 * Register Style Files
	 *
	 * @since  0.0.1
	 * @access public
	 */
	public function we_register_style() {
	}

	/**
	 * Register Script Files
	 *
	 * @since  0.0.1
	 * @access public
	 */
	public function we_register_script() {
		$ver           = ( defined( WP_DEBUG ) && WP_DEBUG ) ? time() : MUSEUM_CORE_VERSION;
		$_script_array = [
			'we-frontend'                       => 'assets/elementor/js/frontend.js',
			'knob'                              => 'assets/elementor/js/jquery.knob.js',
			'select2'                           => 'assets/elementor/js/select2.min.js',
			'owl-carousel'                      => 'assets/elementor/js/owl.carousel.min.js',
			'fancybox'                          => 'assets/elementor/js/jquery.fancybox.min.js',
			'timer-circles'                     => 'assets/elementor/js/TimeCircles.js',
			'anime'                             => 'assets/elementor/js/anime.min.js',
			'isotope'                           => 'assets/elementor/js/isotope.pkgd.min.js',
			'perfect-scrollbar'                 => 'assets/elementor/js/perfect-scrollbar.min.js',
			'malihu-PageScroll2id'              => 'assets/elementor/js/jquery.malihu.PageScroll2id.min.js',
			'webinane-elementor-module-scripts' => 'assets/elementor/js/modules.js',
		];

		foreach ( $_script_array as $script_k => $script_v ) {
			wp_register_script( $script_k, MUSEUM_CORE_URL . $script_v, [ 'jquery' ], $ver, true );
		}
	}

	/**
	 * Print Editor Files
	 *
	 * @since  0.0.1
	 * @access public
	 */
	public function we_editor_style() {
	}

	/**
	 * Print Editor Files
	 *
	 * @since  0.0.1
	 * @access public
	 */
	public function we_wp_head_style() {
		do_action( 'we_uet/plugins/style' );
	}

	/**
	 * Print Script Files
	 *
	 * @since  0.0.1
	 * @access public
	 */
	public function we_wp_script() {
		wp_enqueue_script( [ 'fancybox', 'webinane-elementor-module-scripts', 'we-frontend' ] );
		wp_enqueue_style( 'we-frontend', MUSEUM_CORE_URL . 'assets/elementor/css/frontend.css' );

		$js = array(
			'ajaxurl' => admin_url( 'admin-ajax.php' ),
			'nonce'   => wp_create_nonce( '_wpnonce' ),
		);
		wp_localize_script( 'jquery', 'webinane_elementor_util', $js );
	}
}

