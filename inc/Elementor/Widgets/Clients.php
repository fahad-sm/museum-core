<?php
namespace MuseumCore\Elementor\Widgets;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Icons_Manager;
use Elementor\Scheme_Typography;
use Elementor\Utils as ElementorUtils;
use Elementor\Widget_Base;
use MuseumCore\Elementor\Classes\Controls\ControlsManager;
use MuseumCore\Util\Utils;


if ( ! defined( 'ABSPATH' ) ) exit;


class Clients extends Widget_Base {

    public $base;

    public function get_name() {
        return 'museum_core_clients';
    }

    public function get_title() {
        return esc_html__( 'Clients', 'museum-core' );
    }

    public function get_icon() {
        return 'eicon-info-box ekit-widget-icon';
    }

    public function get_categories() {
        return ['we-widget'];
    }

    protected function _register_controls() {

        // Carousel Settings
		$this->start_controls_section(
			'content_carousel_section',
			[
				'label' => esc_html__( 'Content', 'museum-core' ),
			]
		);

		$this->add_control(
			'carousel',
			[
				'label'     => esc_html__( 'Enable Carousel', 'museum-core' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'museum-core' ),
				'label_off' => __( 'Hide', 'museum-core' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);
		/*$this->add_control(
			'column',
			[
				'label'     => esc_html__( 'Column', 'museum-core' ),
				'type'      => Controls_Manager::SELECT,
				'options'	=> [
					3			=> esc_html__('Three', 'museum-core'),
					4			=> esc_html__('Four', 'museum-core'),
					6			=> esc_html__('Six', 'museum-core'),
				],
				'default' => 4,
			]
		);*/
		
		$this->end_controls_section();

        // Query
		$this->start_controls_section(
			'museum_event_posts_content_section',
			[
				'label' => esc_html__( 'Query', 'museum-core' ),
			]
		);

		$this->add_control(
			'posts_num',
			[
				'label'     => esc_html__( 'Posts Count', 'museum-core' ),
				'type'      => Controls_Manager::NUMBER,
				'min'       => 1,
				'max'       => 100,
				'default'   => 3,
			]
		);
		$this->add_control(
			'posts_offset',
			[
				'label'     => esc_html__( 'Offset', 'museum-core' ),
				'type'      => Controls_Manager::NUMBER,
				'min'       => 0,
				'max'       => 20,
				'default'   => 0,
			]
		);
		$this->add_control(
			'orderby',
			[
				'label'   => esc_html__( 'Order by', 'museum-core' ),
				'type'    => Controls_Manager::SELECT,
				'options' => [
					'date'          => esc_html__( 'Date', 'museum-core' ),
					'title'         => esc_html__( 'Title', 'museum-core' ),
					'author'        => esc_html__( 'Author', 'museum-core' ),
					'modified'      => esc_html__( 'Modified', 'museum-core' ),
					'comment_count' => esc_html__( 'Comments', 'museum-core' ),
				],
				'default' => 'date',
			]
		);

		$this->add_control(
			'sort',
			[
				'label'   => esc_html__( 'Order', 'museum-core' ),
				'type'    => Controls_Manager::SELECT,
				'options' => [
					'ASC'  => esc_html__( 'ASC', 'museum-core' ),
					'DESC' => esc_html__( 'DESC', 'museum-core' ),
				],
				'default' => 'DESC',
			]
		);

		$this->end_controls_section();


    }

    public function render() {
        $settings = $this->get_settings();
        extract($settings);
        include MUSEUM_CORE_PATH . 'templates/elementor/clients.php';
    }
}
