<?php

namespace MuseumCore\VC;

class Events 
{
	public static function init() {

		vc_map([
			"name" => esc_html__("Events", "museum-core"),
			"icon" => 'vc-site-icon',
			"base" => "museumwp_events",
			"category" => __('Museum Theme', "museum-core"),
			"html_template" => get_theme_file_path( 'vc_templates/events.php' ),
			"params" => array(
				array(
					"type" => "textfield",
					"heading" => __("Title", "museum-core"),
					"admin_label" => true,
					'description'	=> esc_html__('Enter the title', 'museum-core'),
					"param_name" => "title",
				),
				array(
					"type" => "textarea",
					"heading" => __("Description", "museum-core"),
					"admin_label" => false,
					'description'	=> esc_html__('Enter the description', 'museum-core'),
					"param_name" => "desc",
				),
				array(
                    "type" => "dropdown",
                    "heading" => esc_html__("Columns", 'museum-core'),
                    "param_name" => "columns",
                    "value" => array(
                        "Select" => 1,
                        esc_html__("One", 'museum-core') => 1,
                        esc_html__("Two", 'museum-core') => 2,
                    ),
                    "admin_label" => true
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
                    "admin_label" => true
                ),
                array(
                    "type" => "autocomplete",
                    "heading" => esc_html__("Category", 'museum-core'),
                    "param_name" => "cats",
                    'settings'	=> [
                    	'min_length' => 1,
                    ]
                ),
				/*array(
					"type" => "vc_link",
					"heading" => __("Button", "museum-core"),
					"admin_label" => true,
					'description'	=> esc_html__('Enter the button text and link', 'museum-core'),
					"param_name" => "btn",
				),	*/			
			)
		]);
		add_filter( 'vc_autocomplete_museumwp_events_cats_callback', [__CLASS__, 'categories'], 10, 3 );
		add_filter( 'vc_autocomplete_museumwp_events_cats_render', [__CLASS__, 'categories_render'], 10, 3 );
	}

	public static function categories($query, $tag, $param_name) {
		$cats = get_terms(['taxonomy' => 'tribe_events_cat', 'hide_empty' => false]);
		// printr($cats);
		$return = [];

		foreach($cats as $cat) {
			$return[] = array('value' => $cat->slug, 'label' => $cat->name);
		}

		return $return;
	}

	public static function categories_render($value, $setting, $tag) {
		$cats = get_term_by( 'slug', $value['value'], 'tribe_events_cat' );

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