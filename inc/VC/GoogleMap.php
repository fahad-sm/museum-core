<?php

namespace MuseumCore\VC;

class GoogleMap 
{
	public static function init() {

		vc_map([
			"name" => esc_html__("Map", "museum-core"),
			"icon" => 'vc-site-icon',
			"base" => "museumwp_contact_map",
			"category" => __('Museum Theme', "museum-core"),
			"html_template" => get_theme_file_path( 'vc_templates/map.php' ),
			"params" => array(
				array(
					"type" => "attach_image",
					"heading" => __("Marker", "museum-core"),
					"admin_label" => false,
					'description'	=> esc_html__('Select the marker', 'museum-core'),
					"param_name" => "marker",
				),
				array(
					"type" => "textfield",
					"heading" => __("Address", "museum-core"),
					"admin_label" => true,
					'description'	=> esc_html__('Enter the address', 'museum-core'),
					"param_name" => "addr",
				),
				array(
					"type" => "textfield",
					"heading" => __("Latitude", "museum-core"),
					'description'	=> esc_html__('Enter the map latitude', 'museum-core'),
					"param_name" => "lat",
				),
				array(
					"type" => "textfield",
					"heading" => __("Longitude", "museum-core"),
					'description'	=> esc_html__('Enter the map longitude', 'museum-core'),
					"param_name" => "lng",
				),
				array(
					"type" => "textfield",
					"heading" => __("Content", "museum-core"),
					"admin_label" => true,
					'description'	=> esc_html__('Enter the content show on map', 'museum-core'),
					"param_name" => "text",
				),
				array(
					"type" => "textfield",
					"heading" => __("Zoom", "museum-core"),
					"admin_label" => true,
					'description'	=> esc_html__('Enter the map zoom', 'museum-core'),
					"param_name" => "zoom",
					'value'	=> '12'
				),
			)
		]);
	}
	
}