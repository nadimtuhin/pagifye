<?php
/**
 * Widget Registration Tests
 *
 * @package Pagifye_Elementor_Widgets
 */

/**
 * Test all widgets are properly registered
 */
class Test_Widget_Registration extends \PHPUnit\Framework\TestCase {

	/**
	 * List of all expected widgets
	 *
	 * @var array
	 */
	protected $expected_widgets = [
		'navigation-01',
		'navigation-03',
		'navigation-05',
		'hero-01',
		'hero-03',
		'hero-04',
		'hero-06',
		'hero-07',
		'content-02',
		'content-03',
		'content-04',
		'metrics-02',
		'metrics-06',
		'team-01',
		'team-02',
		'team-04',
		'pricing-01',
		'pricing-02',
		'pricing-05',
		'testimonial-02',
		'testimonial-04',
		'testimonial-05',
		'faq-01',
		'faq-04',
		'faq-05',
		'contact-01',
		'contact-02',
		'contact-04',
		'awards-01',
		'awards-02',
		'awards-04',
		'blog-01',
		'blog-03',
		'blog-05',
	];

	/**
	 * Test all widget classes exist
	 */
	public function test_all_widget_classes_exist() {
		foreach ( $this->expected_widgets as $widget_slug ) {
			$class_name = $this->get_class_name( $widget_slug );
			$this->assertTrue(
				class_exists( $class_name ),
				"Widget class {$class_name} does not exist"
			);
		}
	}

	/**
	 * Test all widgets extend base widget
	 */
	public function test_widgets_extend_base() {
		foreach ( $this->expected_widgets as $widget_slug ) {
			$class_name = $this->get_class_name( $widget_slug );

			if ( class_exists( $class_name ) ) {
				$reflection = new ReflectionClass( $class_name );
				$this->assertTrue(
					$reflection->isSubclassOf( 'Pagifye\ElementorWidgets\Base_Widget' ),
					"{$class_name} does not extend Base_Widget"
				);
			}
		}
	}

	/**
	 * Test widgets are registered with Elementor
	 */
	public function test_widgets_registered_with_elementor() {
		if ( ! did_action( 'elementor/widgets/register' ) ) {
			$this->markTestSkipped( 'Elementor widgets not yet registered' );
		}

		$widgets_manager = \Elementor\Plugin::instance()->widgets_manager;
		$registered_widgets = $widgets_manager->get_widget_types();

		foreach ( $this->expected_widgets as $widget_slug ) {
			$widget_name = 'pagifye-' . $widget_slug;
			$this->assertArrayHasKey(
				$widget_name,
				$registered_widgets,
				"Widget {$widget_name} is not registered with Elementor"
			);
		}
	}

	/**
	 * Test widget count
	 */
	public function test_widget_count() {
		$this->assertEquals(
			34,
			count( $this->expected_widgets ),
			'Expected 34 widgets'
		);
	}

	/**
	 * Get class name from widget slug
	 *
	 * @param string $slug Widget slug.
	 * @return string
	 */
	protected function get_class_name( $slug ) {
		$parts = explode( '-', $slug );
		$class = '';

		foreach ( $parts as $part ) {
			$class .= ucfirst( $part ) . '_';
		}

		$class = rtrim( $class, '_' );

		return 'Pagifye\\ElementorWidgets\\Widgets\\' . $class;
	}
}
