<?php

namespace MuseumCore\Classes;

use MuseumCore\Register\Registry;


class Plugin
{
	public static function init() {

		add_action('init', [__CLASS__, 'register']);

		/*add_action('after_setup_theme', function() {
		}, 200);*/

		require_once MUSEUM_CORE_PATH . 'config/options.php';
		add_action('wp_enqueue_scripts', [__CLASS__, 'mailchimp_list']);

		self::elementor();
		add_action( 'elementor/widgets/widgets_registered', [__CLASS__, 'elementor_widgets'] );

		add_action('wp_ajax_museum_core_ajax', [Ajax::class, 'init']);
		add_action('wp_ajax_nopriv_museum_core_ajax', [Ajax::class, 'init']);
		// 
		add_action('vc_before_init', [__CLASS__, 'vc_init']);
	}

	/**
	 * Register Post Types.
	 * 
	 * @return [type] [description]
	 */
	public static function register() {

		require_once MUSEUM_CORE_PATH . 'config/post_types.php';
		require_once MUSEUM_CORE_PATH . 'config/taxonomies.php';

		foreach(Registry::$collection as $coll) {
			$coll->register();
		}

		
	}

	/**
	 * Load the elementor modules.
	 *
	 * @return [type] [description]
	 */
	private static function elementor() {
		$modules = include MUSEUM_CORE_PATH . 'config/elementor.php';

		foreach($modules['modules'] as $module) {
			if(class_exists($module)) {
				call_user_func([$module, 'boot']);
			}
		}
	}

	public static function elementor_widgets($elementor) {
		$modules = include MUSEUM_CORE_PATH . 'config/elementor.php';

		foreach($modules['widgets'] as $module) {
			if(class_exists($module)) {
				$elementor->register_widget_type( new $module );
			}
		}
	}

	public static function vc_init() {
		\MuseumCore\VC\About::init();
		\MuseumCore\VC\Blog::init();
		\MuseumCore\VC\Clients::init();
		\MuseumCore\VC\Contact::init();
		\MuseumCore\VC\Events::init();
		\MuseumCore\VC\Gallery::init();
		\MuseumCore\VC\GoogleMap::init();
		\MuseumCore\VC\History::init();
		\MuseumCore\VC\Testimonial::init();
		\MuseumCore\VC\Timing::init();
	}

	/**
	 * Mailchimp list.
	 *
	 * @return [type] [description]
	 */
	public static function mailchimp_list() {
	    $list = get_transient( 'studentwp_mailchimp_list' );
		
		if($list) {
			return;
		}

		if( function_exists('studentwp') ) {

	        $api = studentwp()->options->get('mailchimp_api_key');

	        if( $api ) {

	            if ( $list === false ) {
	                try {
	                    $MailChimp = new \StudentPlugin\Libraries\MailChimp($api);
	                    $lists = $MailChimp->get('lists');
	                    if( $MailChimp->success() ) {
	                        foreach($lists['lists'] as $value ) {
	                            $list[ student_get($value, 'id') ] = student_get( $value, 'name' );
	                        }

	                        set_transient( 'studentwp_mailchimp_list', $list, 3600*24*5 );
	                    }

	                } catch (\Exception $e) {
	                    
	                }
	            }
	        }
	    }
	}
}