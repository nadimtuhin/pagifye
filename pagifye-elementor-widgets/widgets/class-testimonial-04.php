<?php
/**
 * Testimonial 04 Widget
 *
 * DESCRIPTION
 *
 * @package Pagifye_Elementor_Widgets
 */

namespace Pagifye\ElementorWidgets\Widgets;

use Pagifye\ElementorWidgets\Base_Widget;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;
use Elementor\Repeater;
use Elementor\Utils;

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Testimonial_04 Widget Class
 */
class Testimonial_04 extends Base_Widget {

	/**
	 * Get widget name
	 */
	public function get_name() {
		return 'pagifye-testimonial-04';
	}

	/**
	 * Get widget title
	 */
	public function get_title() {
		return esc_html__( 'Testimonial 04', 'pagifye-elementor-widgets' );
	}

	/**
	 * Get widget icon
	 */
	public function get_icon() {
		return 'eicon-testimonial';
	}

	/**
	 * Get widget keywords
	 */
	public function get_keywords() {
		return [ 'pagifye', 'testimonial', 'review', 'quote' ];
	}

	/**
	 * Register widget controls
	 */
	protected function register_controls() {
		$this->register_content_controls();
		$this->register_style_controls();
	}

	/**
	 * Register content controls
	 */
	private function register_content_controls() {
		// Main Content Section
		$this->start_controls_section(
			'section_content',
			[
				'label' => esc_html__( 'Content', 'pagifye-elementor-widgets' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'heading',
			[
				'label'       => esc_html__( 'Heading', 'pagifye-elementor-widgets' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => esc_html__( 'Heading Text', 'pagifye-elementor-widgets' ),
				'label_block' => true,
				'dynamic'     => [ 'active' => true ],
			]
		);

		$this->add_control(
			'description',
			[
				'label'       => esc_html__( 'Description', 'pagifye-elementor-widgets' ),
				'type'        => Controls_Manager::TEXTAREA,
				'default'     => esc_html__( 'Description text here.', 'pagifye-elementor-widgets' ),
				'rows'        => 4,
				'dynamic'     => [ 'active' => true ],
			]
		);

		$this->end_controls_section();
	}

	/**
	 * Register style controls
	 */
	private function register_style_controls() {
		// Section Style
		$this->start_controls_section(
			'section_style',
			[
				'label' => esc_html__( 'Section', 'pagifye-elementor-widgets' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'     => 'section_background',
				'types'    => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .pgfy-section',
				'fields_options' => [
					'background' => [
						'default' => 'classic',
					],
					'color' => [
						'default' => '#0F2C24',
					],
				],
			]
		);

		$this->end_controls_section();
	}

	/**
	 * Render widget output
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();
		?>
		<section class="pgfy-section" style="background-color: #0F2C24; padding: 40px 0; color: white;">
			<div class="container">
				<?php if ( ! empty( $settings['heading'] ) ) : ?>
					<h2 style="font-size: 48px; font-weight: 700; margin: 0 0 24px;">
						<?php echo esc_html( $settings['heading'] ); ?>
					</h2>
				<?php endif; ?>

				<?php if ( ! empty( $settings['description'] ) ) : ?>
					<p style="font-size: 18px; margin: 0;">
						<?php echo esc_html( $settings['description'] ); ?>
					</p>
				<?php endif; ?>
			</div>
		</section>
		<?php
	}
}
