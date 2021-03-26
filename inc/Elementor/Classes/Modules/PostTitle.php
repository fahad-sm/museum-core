<?php
/**
 * @author Shahbaz Ahmed <shehbaz2009@gmail.com>
 * @package   Student Elementor
 * @version   0.0.1
 **/
namespace MuseumCore\Elementor\Classes\Modules;

use Elementor\Core\DynamicTags\Tag;
use Elementor\Modules\DynamicTags\Module;
use MuseumCore\Elementor\Classes\MuseumModules;

class PostTitle extends Tag {
	/**
	 * Get Name
	 * Returns the Name of the tag
	 *
	 * @since  0.0.1
	 * @access public
	 * @return string
	 */
	public function get_name() {
		return 'WE_Post_Title';
	}

	/**
	 * Get Title
	 * Returns the title of the Tag
	 *
	 * @since  0.0.1
	 * @access public
	 * @return string
	 */
	public function get_title() {
		return __( 'Post Title', 'museum-core' );
	}

	/**
	 * Get Group
	 * Returns the Group of the tag
	 *
	 * @since  0.0.1
	 * @access public
	 * @return string
	 */
	public function get_group() {
		return MuseumModules::POST_GROUP;
	}

	/**
	 * Get Categories
	 * Returns an array of tag categories
	 *
	 * @since  0.0.1
	 * @access public
	 * @return array
	 */
	public function get_categories() {
		return [ Module::TEXT_CATEGORY ];
	}

	/**
	 * Register Controls
	 * Registers the Dynamic tag controls
	 *
	 * @since  0.0.1
	 * @access protected
	 * @return void
	 */

	protected function _register_controls() {
		$this->add_control(
			'length',
			[
				'label'   => __( 'Title Length', 'museum-core' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
			]
		);
	}

	/**
	 * Render
	 * Prints out the value of the Dynamic tag
	 *
	 * @since  0.0.1
	 * @access public
	 * @return void
	 */
	public function render() {
		$length = $this->get_settings( 'length' );

		if( $length ) {
			echo wp_kses_post(substr(get_the_title(), 0, $length));
			if(strlen(get_the_title()) > $length) {
				echo ' ...';
			}
		} else {
		    echo wp_kses_post( get_the_title() );
		}
	}
}