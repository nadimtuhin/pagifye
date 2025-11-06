<?php
/**
 * Widgets Loader
 *
 * Handles registration of all Pagifye widgets with Elementor.
 *
 * @package Pagifye_Elementor_Widgets
 */

namespace Pagifye\ElementorWidgets;

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Widgets Loader Class
 */
class Widgets_Loader {

	/**
	 * List of widgets to register
	 *
	 * @var array
	 */
	private $widgets = [];

	/**
	 * Constructor
	 */
	public function __construct() {
		// Define available widgets
		$this->define_widgets();

		// Register widgets
		add_action( 'elementor/widgets/register', [ $this, 'register_widgets' ] );
	}

	/**
	 * Define available widgets
	 *
	 * Add new widgets here as they are developed
	 */
	private function define_widgets() {
		$this->widgets = [
			// Test widget (remove after Phase 1 complete)
			'test' => 'Test_Widget',

			// Phase 2 - Priority Widgets (commented out for now)
			// 'navigation-01'   => 'Navigation_01',  // Coming soon
			// 'hero-01'         => 'Hero_01',         // Coming soon
			// 'pricing-01'      => 'Pricing_01',      // Coming soon
			// 'faq-01'          => 'FAQ_01',          // Coming soon
			// 'testimonial-02'  => 'Testimonial_02',  // Coming soon

			// Phase 3 - Remaining widgets
			// Will be added as development progresses
		];
	}

	/**
	 * Register widgets with Elementor
	 *
	 * @param \Elementor\Widgets_Manager $widgets_manager
	 */
	public function register_widgets( $widgets_manager ) {
		foreach ( $this->widgets as $widget_id => $widget_class ) {
			// Build full class name
			$class_name = '\\Pagifye\\ElementorWidgets\\Widgets\\' . $widget_class;

			// Check if class exists
			if ( ! class_exists( $class_name ) ) {
				continue;
			}

			// Register the widget
			$widgets_manager->register( new $class_name() );
		}
	}

	/**
	 * Get registered widgets
	 *
	 * @return array
	 */
	public function get_widgets() {
		return $this->widgets;
	}
}
