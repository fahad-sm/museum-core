<?php

namespace MuseumCore\Classes;

class Ajax
{
	public static function init() {

		$subaction = sanitize_text_field( $_REQUEST['subaction'] );

		if($subaction && method_exists(new static, $subaction)) {
			call_user_func([new static, $subaction]);
		}
		wp_send_json_error( ['message' => esc_html__('No sub action found', 'museum-core')] );
	}


	private function ajaxselect2() {
		$query = sanitize_text_field( $_REQUEST['s'] );
		$type = sanitize_text_field( $_REQUEST['data'] );

		switch ($type) {
			case 'post':
				$this->getPosts($query);
				break;
			case 'term':
				$this->getTerms($query);
				break;
			
			default:
				# code...
				break;
		}
	}


	private function getPosts($search) {

		$type = sanitize_text_field( $_REQUEST['type'] );
		$query = new \WP_Query(['post_type' => $type, 'post_per_page' => 100, 's' => $search]);

		$results = [];

		while ($query->have_posts()) {
			$query->the_post();

			$results[] = ['id' => get_the_id(), 'text' => get_the_title()];
		}

		wp_reset_postdata();

		wp_send_json(compact('results'));
	}

	private function getTerms($search) {

		$type = sanitize_text_field( $_REQUEST['type'] );
		$terms = get_terms(['taxonomy' => $type, 'number' => 100, 'search' => $search]);

		$results = [];

		if($terms) {
			foreach ( $terms as $term ) {
				$results[] = ['id' => $term->slug, 'text' => $term->name];
			}
		}

		wp_send_json(compact('results'));
	}

	
}