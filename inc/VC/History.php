<?php

namespace MuseumCore\VC;

class History 
{
	public static function init() {

		vc_map([
			"name" => esc_html__("History", "museum-core"),
			"icon" => 'vc-site-icon',
			"base" => "museumwp_history",
			"category" => __('Museum Theme', "museum-core"),
			"html_template" => get_theme_file_path( 'vc_templates/history.php' ),
			"params" => array(
				array(
					"type" => "attach_image",
					"heading" => __("Bg Image", "museum-core"),
					"admin_label" => false,
					'description'	=> esc_html__('Select the background image', 'museum-core'),
					"param_name" => "bg",
					'group'	=> esc_html__('General', 'museum-core')
				),
				array(
					"type" => "colorpicker",
					"heading" => __("Bg Color", "museum-core"),
					"admin_label" => true,
					'description'	=> esc_html__('Select the background color', 'museum-core'),
					"param_name" => "bg_color",
					'group'	=> esc_html__('General', 'museum-core')
				),
				array(
					"type" => "textfield",
					"heading" => __("Title", "museum-core"),
					"admin_label" => true,
					'description'	=> esc_html__('Enter the title', 'museum-core'),
					"param_name" => "title",
					'group'	=> esc_html__('Section 1', 'museum-core')
				),
				array(
					"type" => "textarea_html",
					"heading" => __("Cotent", "museum-core"),
					'description'	=> esc_html__('Enter the content', 'museum-core'),
					"param_name" => "content",
					'group'	=> esc_html__('Section 1', 'museum-core')
				),
				array(
					"type" => "textfield",
					"heading" => __("Title", "museum-core"),
					"admin_label" => true,
					'description'	=> esc_html__('Enter the title for section2', 'museum-core'),
					"param_name" => "title2",
					'group'	=> esc_html__('Section 2', 'museum-core')
				),
				array(
                    "type" => "param_group",
                    "heading" => esc_html__("List", 'museum-core'),
                    "param_name" => "list",
                    "admin_label" => false,
					'group'	=> esc_html__('Section 2', 'museum-core'),
                    'params' => [
                    	array(
							"type" => "textfield",
							"heading" => __("Title", "museum-core"),
							'description'	=> esc_html__('Enter the title', 'museum-core'),
							"param_name" => "title",
						),
                    ]
                ),
			)
		]);
	}
	
}