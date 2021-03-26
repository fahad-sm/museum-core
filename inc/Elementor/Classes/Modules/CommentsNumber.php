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

class CommentsNumber extends Tag {

	public function get_name() {
		return 'WE_Comments_Number';
	}

	public function get_title() {
		return __( 'Comments Number', 'museum-core' );
	}

	public function get_group() {
		return MuseumModules::COMMENTS_GROUP;
	}

	public function get_categories() {
		return [ Module::TEXT_CATEGORY ];
	}

	protected function _register_controls() {
		$this->add_control(
			'format_no_comments',
			[
				'label'   => __( 'No Comments Format', 'museum-core' ),
				'default' => __( 'No Responses', 'museum-core' ),
			]
		);

		$this->add_control(
			'format_one_comments',
			[
				'label'   => __( 'One Comment Format', 'museum-core' ),
				'default' => __( 'One Response', 'museum-core' ),
			]
		);

		$this->add_control(
			'format_many_comments',
			[
				'label'   => __( 'Many Comment Format', 'museum-core' ),
				'default' => __( '{number} Responses', 'museum-core' ),
			]
		);

		$this->add_control(
			'link_to',
			[
				'label'   => __( 'Link', 'museum-core' ),
				'type'    => Controls_Manager::SELECT,
				'default' => '',
				'options' => [
					''              => __( 'None', 'museum-core' ),
					'comments_link' => __( 'Comments Link', 'museum-core' ),
				],
			]
		);
	}

	public function render() {
		$settings = $this->get_settings();

		$comments_number = get_comments_number();

		if ( ! $comments_number ) {
			$count = $settings['format_no_comments'];
		} elseif ( 1 === $comments_number ) {
			$count = $settings['format_one_comments'];
		} else {
			$count = strtr( $settings['format_many_comments'], [
				'{number}' => number_format_i18n( $comments_number ),
			] );
		}

		if ( 'comments_link' === $this->get_settings( 'link_to' ) ) {
			$count = sprintf( '<a href="%s">%s</a>', get_comments_link(), $count );
		}

		echo wp_kses_post( $count );
	}
}
