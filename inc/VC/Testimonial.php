<?php

namespace MuseumCore\VC;

class Testimonial 
{
	public static function init() {
		vc_map([
			"name" => esc_html__("Testimonial", "museum-core"),
			"icon" => 'vc-site-icon',
			"base" => "museumwp_testimonials",
			"category" => __('Museum Theme', "museum-core"),
			"html_template" => get_theme_file_path( 'vc_templates/testimonial.php' ),
			"params" => array(
				array(
					"type" => "textarea_html",
					"heading" => __("Content", "museum-core"),
					'description'	=> esc_html__('Enter the content', 'museum-core'),
					"param_name" => "content",
				),
			)
		]);
	}
}