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

			// Navigation Widgets (3 total)
			'navigation-01'   => 'Navigation_01',
			'navigation-03'   => 'Navigation_03',
			'navigation-05'   => 'Navigation_05',

			// Hero Widgets (5 total)
			'hero-01'         => 'Hero_01',
			'hero-03'         => 'Hero_03',
			'hero-04'         => 'Hero_04',
			'hero-06'         => 'Hero_06',
			'hero-07'         => 'Hero_07',

			// Content Widgets (3 total)
			'content-02'      => 'Content_02',
			'content-03'      => 'Content_03',
			'content-04'      => 'Content_04',

			// Metrics Widgets (2 total)
			'metrics-02'      => 'Metrics_02',
			'metrics-06'      => 'Metrics_06',

			// Team Widgets (3 total)
			'team-01'         => 'Team_01',
			'team-02'         => 'Team_02',
			'team-04'         => 'Team_04',

			// Pricing Widgets (3 total)
			'pricing-01'      => 'Pricing_01',
			'pricing-02'      => 'Pricing_02',
			'pricing-05'      => 'Pricing_05',

			// Testimonial Widgets (3 total)
			'testimonial-02'  => 'Testimonial_02',
			'testimonial-04'  => 'Testimonial_04',
			'testimonial-05'  => 'Testimonial_05',

			// FAQ Widgets (3 total)
			'faq-01'          => 'FAQ_01',
			'faq-04'          => 'FAQ_04',
			'faq-05'          => 'FAQ_05',

			// Contact Widgets (3 total)
			'contact-01'      => 'Contact_01',
			'contact-02'      => 'Contact_02',
			'contact-04'      => 'Contact_04',

			// Awards Widgets (3 total)
			'awards-01'       => 'Awards_01',
			'awards-02'       => 'Awards_02',
			'awards-04'       => 'Awards_04',

			// Blog Widgets (3 total)
			'blog-01'         => 'Blog_01',
			'blog-03'         => 'Blog_03',
			'blog-05'         => 'Blog_05',
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
