<?php

namespace MuseumCore\VC;

class Timing 
{
	public static function init() {
		vc_map([
			"name" => esc_html__("Timing", "museum-core"),
			"icon" => 'vc-site-icon',
			"base" => "museumwp_timing",
			"category" => __('Museum Theme', "museum-core"),
			"html_template" => get_theme_file_path( 'vc_templates/timing.php' ),
			"params" => array(
				array(
					"type" => "textfield",
					"heading" => esc_html__("Heading", "museum-core"),
					'group'	=> esc_html__('Timing', 'museum-core'),
					'description'	=> esc_html__('Enter the hading for office hours area', 'museum-core'),
					"param_name" => "heading",
				),
				array(
					"type" => "param_group",
					"heading" => esc_html__("Office Hours", "museum-core"),
					'group'	=> esc_html__('Timing', 'museum-core'),
					'description'	=> esc_html__('Enter the office hours area', 'museum-core'),
					"param_name" => "hours",
					'params'	=> array(
						array(
							"type" => "textfield",
							"heading" => esc_html__("Days", "museum-core"),
							'description'	=> esc_html__('Enter the days', 'museum-core'),
							"param_name" => "days",
						),
						array(
							"type" => "textfield",
							"heading" => esc_html__("Time", "museum-core"),
							'description'	=> esc_html__('Enter the time for days', 'museum-core'),
							"param_name" => "time",
						),
						array(
							"type" => "textfield",
							"heading" => esc_html__("Label", "museum-core"),
							'description'	=> esc_html__('Give a label for that time', 'museum-core'),
							"param_name" => "label",
						),
						
					)
				),
				
			)
		]);
	}
}