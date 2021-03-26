<?php
/**
 * @author Shahbaz Ahmed <shehbaz2009@gmail.com>
 * @package   Student Elementor
 * @version   0.0.1
 **/
namespace MuseumCore\Elementor\Classes\Modules;

use Elementor\Core\DynamicTags\Tag;
use Elementor\Modules\DynamicTags\Module;
use Elementor\Controls_Manager;
use MuseumCore\Elementor\Classes\MuseumModules;

class FeaturedImageData extends Tag {

	public function get_name() {
		return 'WE_Featured_Image_Data';
	}

	public function get_group() {
		return MuseumModules::MEDIA_GROUP;
	}

	public function get_categories() {
		return [
			Module::TEXT_CATEGORY,
			Module::URL_CATEGORY,
			Module::POST_META_CATEGORY,
		];
	}

	public function get_title() {
		return __( 'Featured Image Data', 'museum-core' );
	}

	private function get_attacment() {
		$settings = $this->get_settings();
		$id       = get_post_thumbnail_id();

		if ( ! $id ) {
			return false;
		}

		return get_post( $id );
	}

	public function render() {
		$settings   = $this->get_settings();
		$attachment = $this->get_attacment();

		if ( ! $attachment ) {
			return '';
		}

		$value = '';

		switch ( $settings['attachment_data'] ) {
			case 'alt':
				$value = get_post_meta( $attachment->ID, '_wp_attachment_image_alt', true );
				break;
			case 'caption':
				$value = $attachment->post_excerpt;
				break;
			case 'description':
				$value = $attachment->post_content;
				break;
			case 'href':
				$value = get_permalink( $attachment->ID );
				break;
			case 'src':
				$value = $attachment->guid;
				break;
			case 'title':
				$value = $attachment->post_title;
				break;
		}
		echo wp_kses_post( $value );
	}

	protected function _register_controls() {

		$this->add_control(
			'attachment_data',
			[
				'label'   => __( 'Data', 'museum-core' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'title',
				'options' => [
					'title'       => __( 'Title', 'museum-core' ),
					'alt'         => __( 'Alt', 'museum-core' ),
					'caption'     => __( 'Caption', 'museum-core' ),
					'description' => __( 'Description', 'museum-core' ),
					'src'         => __( 'File URL', 'museum-core' ),
					'href'        => __( 'Attachment URL', 'museum-core' ),
				],
			]
		);
	}
}
