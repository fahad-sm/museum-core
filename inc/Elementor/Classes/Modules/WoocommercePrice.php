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
use MuseumCore\Elementor\Classes\StudentModules;

class WoocommercePrice extends Tag {

	public function get_name() {
		return 'WE_Woocommerce_Price';
	}

	public function get_title() {
		return __( 'Wocommerce Price', 'museum-core' );
	}

	public function get_group() {
		return StudentModules::WOOCOMMERCE_GROUP;
	}

	public function get_categories() {
		return [ Module::TEXT_CATEGORY ];
	}

	protected function _register_controls() {

		$this->add_control(
			'woocommerce_price',
			[
				'label'   => __( 'Price', 'museum-core' ),
				'type'    => Controls_Manager::SELECT,
				'default' => '',
				'options' => [
					'regular'	=> __( 'Regular Price', 'museum-core' ),
					'sale' 		=> __( 'Sale Price', 'museum-core' ),
					'both' 		=> __( 'Both', 'museum-core' ),
				],
			]
		);

		$this->add_control(
			'woocommerce_formatted_price',
			[
				'label'   => __( 'Formatted Price', 'museum-core' ),
				'type'    => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);
	}

	public function render() {
		$settings = $this->get_settings();

		global $product;

		if ( $product && $product->get_price() ) {

			$price = '<span class="webinane-el-woocommerce-price">';

			if ( $settings['woocommerce_formatted_price'] ) {
				if( $settings['woocommerce_price'] == 'both') {
					$price .= $product->get_price_html();
				} else if( $settings['woocommerce_price'] == 'regular') {
					$price .= wc_price( $product->get_regular_price() );
				} else if( $settings['woocommerce_price'] == 'sale') {
					$price .= wc_price( $product->get_sale_price() );
				}
			} else {
				if( $settings['woocommerce_price'] == 'both') {
					$price .= '<span class="unformatted-price"><del>'.$product->get_regular_price() . '</del>' 
					. '<span>' . $product->get_sale_price() . '</span>' .'</span>';
				} else if( $settings['woocommerce_price'] == 'regular') {
					$price .= $product->get_regular_price();
				} else if( $settings['woocommerce_price'] == 'sale') {
					$price .= $product->get_sale_price();
				}
			}

			$price .= '</span>';

			echo apply_filters( 'woocommerce_get_price_html', $price, $product );

		} else {
			esc_html__('No price found', 'museum-core');
		}
	}
}
