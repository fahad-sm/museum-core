<?php

namespace MuseumCore\VC;

class Clients 
{
	public static function init() {


		vc_map([
			"name" => esc_html__("Clients", "museum-core"),
			"icon" => 'vc-site-icon',
			"base" => "museumwp_clients",
			"category" => __('Museum Theme', "museum-core"),
			"html_template" => get_theme_file_path( 'vc_templates/clients.php' ),
			"params" => array(
				array(
					"type" => "textfield",
					"heading" => __("Title", "museum-core"),
					"admin_label" => true,
					'description'	=> esc_html__('Enter the title', 'museum-core'),
					"param_name" => "title",
				),
				array(
                    "type" => "textfield",
                    "heading" => esc_html__("Number of Posts", 'museum-core'),
                    "param_name" => "number_of_posts",
                    "admin_label" => true
                ),
                array(
                    "type" => "dropdown",
                    "heading" => esc_html__("Order By", 'museum-core'),
                    "param_name" => "order_by",
                    "value" => array(
                        "Title" => "title",
                        "Date" => "date"
                    ),
                    'save_always' => true,
                    "admin_label" => true
                ),
                array(
                    "type" => "dropdown",
                    "heading" => esc_html__("Order", 'museum-core'),
                    "param_name" => "order",
                    "value" => array(
                        "ASC" => "ASC",
                        "DESC" => "DESC"
                    ),
                    'save_always' => true,
                    "admin_label" => true
                ),
                array(
					"type" => "dropdown",
					"class" => "",
					"heading" => __("Display Style", "museumwp-toolkit"),
					"param_name" => "display_style",
					"value" => array(
						"Select an Option" => "",
						"Grid" => "grid",
						"List" => "list",
					)
				),
			)
		]);


		add_filter( 'vc_autocomplete_museumwp_blog_cat_callback', [__CLASS__, 'categories'], 10, 3 );
		add_filter( 'vc_autocomplete_museumwp_blog_cat_render', [__CLASS__, 'categories_render'], $value, $setting, $tag );
	}

	public static function categories($query, $tag, $param_name) {
		$cats = get_categories();
		$return = [];

		foreach($cats as $cat) {
			$return[] = array('value' => $cat->slug, 'label' => $cat->name);
		}

		return $return;
	}
}