<?php

namespace MuseumCore\VC;

class Gallery 
{
	public static function init() {

		vc_map([
			"name" => esc_html__("Gallery", "museum-core"),
			"icon" => 'vc-site-icon',
			"base" => "museumwp_gallery",
			"category" => __('Museum Theme', "museum-core"),
			"html_template" => get_theme_file_path( 'vc_templates/gallery.php' ),
			"params" => array(
				array(
					"type" => "colorpicker",
					"heading" => __("Bg Color", "museum-core"),
					"admin_label" => true,
					'description'	=> esc_html__('Choose the background color', 'museum-core'),
					"param_name" => "bg",
				),
				array(
					"type" => "textfield",
					"heading" => __("Title", "museum-core"),
					"admin_label" => true,
					'description'	=> esc_html__('Enter the title', 'museum-core'),
					"param_name" => "title",
				),
				array(
					"type" => "textfield",
					"heading" => __("Description", "museum-core"),
					"admin_label" => true,
					'description'	=> esc_html__('Enter the description', 'museum-core'),
					"param_name" => "desc",
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
                    "heading" => esc_html__("Tags", 'museum-core'),
                    "param_name" => "tags",
                    'settings'	=> [
                    	'min_length' => 1,
                    ]
                ),
			)
		]);
		add_filter( 'vc_autocomplete_museumwp_gallery_tags_callback', [__CLASS__, 'categories'], 10, 3 );
		add_filter( 'vc_autocomplete_museumwp_gallery_tags_render', [__CLASS__, 'categories_render'], 10, 3 );
	}

	public static function categories($query, $tag, $param_name) {
		$cats = get_terms(['taxonomy' => 'gallery-tags', 'search' => $query, 'hide_empty' => false]);

		$return = [];

		foreach($cats as $cat) {
			$return[] = array('value' => $cat->slug, 'label' => $cat->name);
		}

		return $return;
	}

	public static function categories_render($value, $setting, $tag) {
		$cats = get_term_by( 'slug', $value['value'], 'gallery-tags' );

		$return = [];

		if($cats) {
			$return = [
				'value'	=> $value['value'],
				'label' => '(ID: '.$cats->term_id . ') Name: ' . $cats->name
			];
		}

		return $return;
	}
	
}