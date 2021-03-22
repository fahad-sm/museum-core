<?php

namespace MuseumCore\VC;

class Contact 
{
	public static function init() {

		vc_map([
			"name" => esc_html__("Wp Forms", "museum-core"),
			"icon" => 'vc-site-icon',
			"base" => "museumwp_form",
			"category" => __('Museum Theme', "museum-core"),
			"html_template" => get_theme_file_path( 'vc_templates/contact.php' ),
			"params" => array(
                array(
                    "type" => "autocomplete",
                    "heading" => esc_html__("Select Form", 'museum-core'),
                    "param_name" => "form",
                    'settings'	=> [
                    	'min_length' => 1,
                    ]
                ),
			)
		]);
		add_filter( 'vc_autocomplete_museumwp_form_form_callback', [__CLASS__, 'forms'], 10, 3 );
		add_filter( 'vc_autocomplete_museumwp_form_form_render', [__CLASS__, 'forms_render'], 10, 3 );
	}

	public static function forms($query, $tag, $param_name) {
		$forms = new \WP_Query(['post_type' => 'wpforms', 's' => $query]);
		// printr($cats);
		$return = [];

		foreach($forms->posts as $cat) {
			$return[] = array('value' => $cat->ID, 'label' => $cat->post_title);
		}

		return $return;
	}

	public static function forms_render($value, $setting, $tag) {
		$form = get_post($value['value']);

		$return = [];

		if($form) {
			$return = [
				'value'	=> $value['value'],
				'label' => '(ID: '.$post->ID . ') Name: ' . $post->post_title
			];
		}

		return $return;
	}
	
}