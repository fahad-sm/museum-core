<?php

namespace MuseumCore\VC;

class Blog 
{
	public static function init() {

		add_filter( 'vc_autocomplete_museumwp_blog_cat_callback', [__CLASS__, 'categories'], 10, 3 );
		add_filter( 'vc_autocomplete_museumwp_blog_cat_render', [__CLASS__, 'categories_render'], $value, $setting, $tag );
		vc_map([
			"name" => esc_html__("Blog", "museum-core"),
			"icon" => 'vc-site-icon',
			"base" => "museumwp_blog",
			"category" => __('Museum Theme', "museum-core"),
			"html_template" => get_theme_file_path( 'vc_templates/blog.php' ),
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
                    "type" => "autocomplete",
                    "heading" => esc_html__("Category", 'museum-core'),
                    "param_name" => "cats",
                ),
				array(
					"type" => "vc_link",
					"heading" => __("Button", "museum-core"),
					"admin_label" => true,
					'description'	=> esc_html__('Enter the button text and link', 'museum-core'),
					"param_name" => "btn",
				),				
			)
		]);
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