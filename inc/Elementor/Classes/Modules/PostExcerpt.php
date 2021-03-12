<?php
/**
 * @author Shahbaz Ahmed <shehbaz2009@gmail.com>
 * @package   Student Elementor
 * @version   0.0.1
 **/
namespace MuseumCore\Elementor\Classes\Modules;

use Elementor\Core\DynamicTags\Tag;
use Elementor\Modules\DynamicTags\Module;
use MuseumCore\Elementor\Classes\StudentModules;
use Elementor\Controls_Manager;

class PostExcerpt extends Tag {
	public function get_name() {
		return 'WE_Post_Excerpt';
	}

	public function get_title() {
		return __( 'Post Excerpt', 'museum-core' );
	}

	public function get_group() {
		return StudentModules::POST_GROUP;
	}

	public function get_categories() {
		return [ Module::TEXT_CATEGORY ];
	}

    protected function _register_controls() {
		$this->add_control(
			'length',
			[
				'label'   => __( 'Excerpt Length', 'museum-core' ),
				'type'    => Controls_Manager::TEXT,
			]
		);
	}

	public function render() {
	    $length = $this->get_settings( 'length' );
		// Allow only a real `post_excerpt` and not the trimmed `post_content` from the `get_the_excerpt` filter
		$post = get_post();

		if ( ! $post || empty( $post->post_excerpt ) ) {
			return;
		}
        
        if( $length ) {
            echo wp_kses_post( wp_trim_words($post->post_excerpt, $length) );
        } else {
		    echo wp_kses_post( $post->post_excerpt );
        }
	}
}
