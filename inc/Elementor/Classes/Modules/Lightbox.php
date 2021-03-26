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
use Elementor\Embed;
use MuseumCore\Elementor\Classes\MuseumModules;
use MuseumCore\Elementor\Classes\Modules\PostCustomField;
use WE\Widgets\Modules\WE_Post_Custom_Field;


class Lightbox extends Tag {

	public function get_name() {
		return 'lightbox';
	}

	public function get_title() {
		return __( 'Lightbox', 'museum-core' );
	}

	public function get_group() {
		return MuseumModules::ACTION_GROUP;
	}

	public function get_categories() {
		return [ Module::URL_CATEGORY ];
	}

	// Keep Empty to avoid default advanced section
	protected function register_advanced_section() {
	}

	public function _register_controls() {
		$this->add_control(
			'type',
			[
				'label'       => __( 'Type', 'museum-core' ),
				'type'        => Controls_Manager::CHOOSE,
				'label_block' => false,
				'options'     => [
					'video'  => [
						'title' => __( 'Video', 'museum-core' ),
						'icon'  => 'fa fa-video-camera',
					],
					'image'  => [
						'title' => __( 'Image', 'museum-core' ),
						'icon'  => 'fa fa-image',
					],
					'iframe' => [
						'title' => __( 'IFrame', 'museum-core' ),
						'icon'  => 'fa fa-link',
					],
					'meta'   => [
						'title' => __( 'Post Meta', 'museum-core' ),
						'icon'  => 'fa fa-dot-circle-o',
					],
				],
			]
		);

		$this->add_control(
			'image',
			[
				'label'     => __( 'Image', 'museum-core' ),
				'type'      => Controls_Manager::MEDIA,
				'condition' => [
					'type' => 'image',
				],
			]
		);

		$this->add_control(
			'video_url',
			[
				'label'       => __( 'Video URL', 'museum-core' ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
				'condition'   => [
					'type' => 'video',
				],
			]
		);
		$this->add_control(
			'iframe_url',
			[
				'label'       => __( 'IFrame URL', 'museum-core' ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
				'condition'   => [
					'type' => 'iframe',
				],
			]
		);
		$this->add_control(
			'key',
			[
				'label'     => __( 'Key', 'museum-core' ),
				'type'      => Controls_Manager::SELECT,
				'options'   => PostCustomField::get_custom_keys_array(),
				'condition' => [
					'type' => 'meta',
				],
			]
		);
		$this->add_control(
			'title',
			[
				'label'       => __( 'Title', 'museum-core' ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
			]
		);
	}

	private function get_image_settings( $settings ) {
		return [
			'url'  => $settings['image']['url'],
			'type' => 'image',
		];
	}

	private function get_video_settings( $settings ) {
		return [
			'type' => 'video',
			'url'  => $settings['video_url'],
		];
	}

	private function get_iframe_settings( $settings ) {
		return [
			'type' => 'iframe',
			'url'  => $settings['iframe_url'],
		];
	}

	private function get_meta_settings( $settings ) {
		$value = get_post_meta( get_the_ID(), $settings['key'], true );

		return [
			'type' => 'video',
			'url'  => $value,
		];
	}

	public function render() {
		$settings = $this->get_settings();

		$value = [];

		if ( ! $settings['type'] ) {
			return;
		}

		if ( 'image' === $settings['type'] && $settings['image'] ) {
			$value = $this->get_image_settings( $settings );
		} elseif ( 'video' === $settings['type'] && $settings['video_url'] ) {
			$value = $this->get_video_settings( $settings );
		} elseif ( 'iframe' === $settings['type'] && $settings['iframe_url'] ) {
			$value = $this->get_iframe_settings( $settings );
		} elseif ( 'meta' === $settings['type'] && $settings['key'] ) {
			$value = $this->get_meta_settings( $settings );
		}

		if ( ! $value ) {
			return;
		}
		$title = $settings['title'] ? '|' . $settings['title'] : '';
		// echo $value['url'];
		// return;
		echo esc_url(home_url("#action-webinane-elementor-modal|{$value['url']}|{$value['type']}{$title}"));
	}
}
