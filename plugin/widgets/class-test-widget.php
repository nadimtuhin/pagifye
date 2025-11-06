<?php
/**
 * Test Widget (For Development Testing)
 *
 * @package Pagifye_Elementor_Widgets
 */

namespace Pagifye\ElementorWidgets\Widgets;

use Pagifye\ElementorWidgets\Base_Widget;
use Elementor\Controls_Manager;

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Test Widget Class
 */
class Test_Widget extends Base_Widget {

	/**
	 * Get widget name
	 */
	public function get_name() {
		return 'pagifye-test';
	}

	/**
	 * Get widget title
	 */
	public function get_title() {
		return esc_html__( 'Test Widget', 'pagifye-elementor-widgets' );
	}

	/**
	 * Register widget controls
	 */
	protected function register_controls() {
		$this->start_controls_section(
			'section_content',
			[
				'label' => esc_html__( 'Content', 'pagifye-elementor-widgets' ),
			]
		);

		$this->add_control(
			'title',
			[
				'label'   => esc_html__( 'Title', 'pagifye-elementor-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => esc_html__( 'Test Widget', 'pagifye-elementor-widgets' ),
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
		<div class="pgfy-container pgfy-section">
			<h2 class="pgfy-heading-lg text-pgfy-gray-500">
				<?php echo esc_html( $settings['title'] ); ?>
			</h2>
			<p class="mt-4 text-pgfy-gray-400">
				<?php echo esc_html__( 'This is a test widget to verify the Pagifye Elementor Widgets plugin is working correctly.', 'pagifye-elementor-widgets' ); ?>
			</p>
			<div class="mt-6">
				<a href="#" class="pgfy-btn-primary">
					<?php echo esc_html__( 'Primary Button', 'pagifye-elementor-widgets' ); ?>
				</a>
				<a href="#" class="pgfy-btn-outline ml-4">
					<?php echo esc_html__( 'Outline Button', 'pagifye-elementor-widgets' ); ?>
				</a>
			</div>
		</div>
		<?php
	}
}
