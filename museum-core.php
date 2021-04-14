<?php
/**
 * Plugin Name:     Museum Core
 * Plugin URI:      https://premiumlayers.com
 * Description:     Museum plugin theme
 * Author:          iHekrit
 * Author URI:      https://premiumlayers.com
 * Text Domain:     museum-core
 * Domain Path:     /languages
 * Version:         1.0.0
 *
 * @package         Museum_Core
 */

if ( ! defined('ABSPATH') ) {
	exit;
}

defined('MUSEUM_CORE_PATH') || define('MUSEUM_CORE_PATH', plugin_dir_path( __FILE__ ));
defined('MUSEUM_CORE_URL') || define('MUSEUM_CORE_URL', plugin_dir_url( __FILE__ ));
defined('MUSEUM_CORE_VERSION') || define('MUSEUM_CORE_VERSION', '1.0');

require_once MUSEUM_CORE_PATH . 'inc/Loader.php';

register_activation_hook( __FILE__, array( '\MuseumCore\Loader', 'activate' ) );
register_deactivation_hook( __FILE__, array( '\MuseumCore\Loader', 'deactivate' ) );
