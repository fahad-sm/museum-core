<?php
/**
 * @package   Student Elementor
 * @version   0.0.1
 *
 * @author    Shahbaz Ahmed <shahbazahmed9@hotmail.com>
 **/
namespace MuseumCore\Elementor\Classes;

use MuseumCore\Elementor\Classes\Modules\Modules;
use Elementor\Plugin;

class MuseumModules {

	const AUTHOR_GROUP      = 'we-author';

	const POST_GROUP        = 'we-post';

	const COMMENTS_GROUP    = 'we-comments';

	const SITE_GROUP        = 'we-site';

	const ARCHIVE_GROUP     = 'we-archive';

	const REQUEST_GROUP     = 'we-request';

	const MEDIA_GROUP       = 'we-media';

	const ACTION_GROUP      = 'we-action';

	const WOOCOMMERCE_GROUP = 'we-woocommerce';

	const THE_EVENT_GROUP   = 'we-the-event-calendar';

	public function __construct() {

		add_action( 'elementor/dynamic_tags/register_tags', [ $this, 'tci_init_dynamic_tags' ] );
	}

	/**
	 * Init Dynamic Tags
	 * Include dynamic tag files and register them
	 *
	 * @since  0.0.1
	 * @access public
	 */
	public function tci_init_dynamic_tags( $dynamic_tags ) {
		// Include Widget files

		$tci_dynamic_tag_files = glob( STUDENT_PLUGIN_PATH . 'inc/Elementor/Classes/Modules/*.php' );


		foreach ( $this->tci_get_groups() as $k => $v ) {
			Plugin::$instance->dynamic_tags->register_group( $k, $v );
		}

		foreach ( $tci_dynamic_tag_files as $file ) {
						
			$class_name = str_replace(
				[STUDENT_PLUGIN_PATH.'inc', '/', '.php'],
				['\\MuseumCore', '\\', ''],
				$file
			); ///__NAMESPACE__ . '\\Modules\\' . $file;
			// echo $class_name;exit;
			// In our Dynamic Tag we use a group named request-variables so we need
			// To register that group as well before the tag

			if ( class_exists( $class_name ) ) {
				// Finally register the tag
				$dynamic_tags->register_tag( $class_name );
			}
		}

	}

	/**
	 * Get Groups
	 *
	 * @since  0.0.1
	 * @access public
	 */
	public function tci_get_groups() {


		$cats = [
			self::POST_GROUP     => [
				'title' => __( 'Student Post', 'museum-core' ),
			],
			self::ARCHIVE_GROUP  => [
				'title' => __( 'Student Archive', 'museum-core' ),
			],
			self::SITE_GROUP     => [
				'title' => __( 'Student Site', 'museum-core' ),
			],
			self::MEDIA_GROUP    => [
				'title' => __( 'Student Media', 'museum-core' ),
			],
			self::ACTION_GROUP   => [
				'title' => __( 'Student Actions', 'museum-core' ),
			],
			self::AUTHOR_GROUP   => [
				'title' => __( 'Student Author', 'museum-core' ),
			],
			self::COMMENTS_GROUP => [
				'title' => __( 'Student Comments', 'museum-core' ),
			],
		];

		if ( class_exists( 'WooCommerce' ) ) {
			$cats[ self::WOOCOMMERCE_GROUP ] = [
				'title' => __( 'Woocommerce', 'museum-core' ),
			];
		}

		if ( class_exists( 'Tribe__Events__Main' ) ) {
			$cats[ self::THE_EVENT_GROUP ] = [
				'title' => __( 'The Event Calendar', 'museum-core' ),
			];
		}

		return $cats;
	}
}
