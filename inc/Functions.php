<?php

use MuseumCore\Register\PostType;
use MuseumCore\Register\Taxonomy;

if ( ! function_exists( 'printr' ) ) {
	function printr($var) {
		echo '<pre>';
		print_r($var);
		exit;
	}
}

if ( ! function_exists( 'museum_core_mailchimp_list') ) {
	/**
	 * Mailchimp list.
	 * 
	 * @return [type] [description]
	 */
	function museum_core_mailchimp_list() {

	    $list = get_transient( 'museum_core_mailchimp_list' );
	    $list = ($list) ? $list : ['' => esc_html__( 'Select List', 'student-plugin' )];
	    return $list;
	}
}

if( ! function_exists( 'museum_get' ) ) {
	function museum_get($var, $key, $def = '') {
		if(is_array($var)) {
			return isset( $var[ $key ] ) ? $var[ $key ] : $def;
		} elseif( is_object( $var ) ) {
			return isset( $var->{$key} ) ? $var->{$key} : $def;
		}

		return $def;
	}
}

if( ! function_exists( 'museum_post_type' ) ) {
	/**
	 * Register post type.
	 *
	 * @param  [type] $singular [description]
	 * @param  string $plural   [description]
	 * @param  array  $settings [description]
	 * @return [type]           [description]
	 */
	function museum_post_type($singular, $plural = '', $settings = []) {

		$obj = new PostType($singular, $plural, $settings);
		$obj->addToRegistry();

		return $obj;
	}
}

if( ! function_exists( 'museum_taxonomy' ) ) {
	/**
	 * Register post type.
	 *
	 * @param  [type] $singular [description]
	 * @param  string $plural   [description]
	 * @param  array  $settings [description]
	 * @return [type]           [description]
	 */
	function museum_taxonomy($singular, $plural = '', $settings = []) {

		$obj = new Taxonomy($singular, $plural, $settings);
		$obj->addToRegistry();

		return $obj;
	}
}

/**
 * Used to overcome core bug when taxonomy is in more then one post type
 *
 * @see   https://core.trac.wordpress.org/ticket/27918
 * @global array $wp_taxonomies The registered taxonomies.
 * @since 0.0.1
 *
 * @param array  $args
 * @param string $output
 * @param string $operator
 *
 * @return array
 */
function museum_get_taxonomies( $args = [], $output = 'names', $operator = 'and' ) {
	global $wp_taxonomies;

	$field = ( 'names' === $output ) ? 'name' : false;

	// Handle 'object_type' separately.
	if ( isset( $args['object_type'] ) ) {
		$object_type = (array) $args['object_type'];
		unset( $args['object_type'] );
	}

	$taxonomies = wp_filter_object_list( $wp_taxonomies, $args, $operator );

	if ( isset( $object_type ) ) {
		foreach ( $taxonomies as $tax => $tax_data ) {
			if ( ! array_intersect( $object_type, $tax_data->object_type ) ) {
				unset( $taxonomies[ $tax ] );
			}
		}
	}

	if ( $field ) {
		$taxonomies = wp_list_pluck( $taxonomies, $field );
	}

	return $taxonomies;
}


if( ! function_exists( 'museum_get_sidebars' ) ) {
	/**
	 * Get sidebars
	 * 
	 * @param  boolean $multi [description]
	 * @return [type]         [description]
	 */
	function museum_get_sidebars($multi = false) {
		global $wp_registered_sidebars;
		$sidebars = ! ( $wp_registered_sidebars ) ? get_option( 'wp_registered_sidebars' ) : $wp_registered_sidebars;
		if ( $multi ) {
			$data[] = array( 'value' => '', 'label' => '' );
		}
		foreach ( (array) $sidebars as $sidebar ) {
			if ( $multi ) {
				$data[] = array( 'value' => student_get( $sidebar, 'id' ), 'label' => student_get( $sidebar, 'name' ) );
			} else {
				$data[ student_get( $sidebar, 'id' ) ] = student_get( $sidebar, 'name' );
			}
		}

		return $data;
	}
}