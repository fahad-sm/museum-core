<?php

namespace MuseumCore\VC;

class About 
{
	public static function init() {
		vc_map([
			"name" => esc_html__("About Us", "museum-core"),
			"icon" => 'vc-site-icon',
			"base" => "museumwp_about",
			"category" => __('Museum Theme', "museum-core"),
			"html_template" => get_theme_file_path( 'vc_templates/about.php' ),
			"params" => array(
				array(
					"type" => "textfield",
					"heading" => __("Title", "museum-core"),
					"admin_label" => true,
					'description'	=> esc_html__('Enter the title', 'museum-core'),
					"param_name" => "title",
				),
				array(
					"type" => "textarea_html",
					"heading" => __("Content", "museum-core"),
					'description'	=> esc_html__('Enter the content', 'museum-core'),
					"param_name" => "content",
				),
				array(
					"type" => "vc_link",
					"heading" => __("Button", "museum-core"),
					"admin_label" => true,
					'description'	=> esc_html__('Enter the button text and link', 'museum-core'),
					"param_name" => "btn",
				),
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