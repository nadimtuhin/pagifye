<?php
/**
 * Widget Rendering Tests
 *
 * @package Pagifye_Elementor_Widgets
 */

/**
 * Test widgets render correctly
 */
class Test_Widget_Rendering extends WP_UnitTestCase {

	/**
	 * Test Navigation-01 widget renders
	 */
	public function test_navigation_01_renders() {
		$widget = $this->get_widget_instance( 'navigation-01' );

		if ( ! $widget ) {
			$this->markTestSkipped( 'Navigation-01 widget not available' );
		}

		// Set test settings
		$widget->set_settings( [
			'logo_type' => 'text',
			'logo_text' => 'Test Logo',
			'menu_items' => [
				[
					'menu_text' => 'Home',
					'menu_link' => [ 'url' => '/' ],
				],
			],
		] );

		// Render widget
		ob_start();
		$widget->render();
		$output = ob_get_clean();

		// Assertions
		$this->assertStringContainsString( 'Test Logo', $output );
		$this->assertStringContainsString( 'Home', $output );
		$this->assertNotEmpty( $output );
	}

	/**
	 * Test Hero-01 widget renders
	 */
	public function test_hero_01_renders() {
		$widget = $this->get_widget_instance( 'hero-01' );

		if ( ! $widget ) {
			$this->markTestSkipped( 'Hero-01 widget not available' );
		}

		$widget->set_settings( [
			'heading' => 'Test {Heading}',
			'description' => 'Test description text',
		] );

		ob_start();
		$widget->render();
		$output = ob_get_clean();

		$this->assertStringContainsString( 'Test', $output );
		$this->assertStringContainsString( 'Heading', $output );
		$this->assertStringContainsString( 'description', $output );
	}

	/**
	 * Test Pricing-01 widget renders
	 */
	public function test_pricing_01_renders() {
		$widget = $this->get_widget_instance( 'pricing-01' );

		if ( ! $widget ) {
			$this->markTestSkipped( 'Pricing-01 widget not available' );
		}

		$widget->set_settings( [
			'heading' => 'Our Pricing',
			'show_billing_toggle' => 'yes',
			'pricing_cards' => [
				[
					'plan_name' => 'Basic',
					'monthly_price' => '$19',
					'annual_price' => '$190',
				],
			],
		] );

		ob_start();
		$widget->render();
		$output = ob_get_clean();

		$this->assertStringContainsString( 'Our Pricing', $output );
		$this->assertStringContainsString( 'Basic', $output );
		$this->assertStringContainsString( 'x-data', $output ); // Alpine.js
	}

	/**
	 * Test FAQ-01 widget renders
	 */
	public function test_faq_01_renders() {
		$widget = $this->get_widget_instance( 'faq-01' );

		if ( ! $widget ) {
			$this->markTestSkipped( 'FAQ-01 widget not available' );
		}

		$widget->set_settings( [
			'faq_items' => [
				[
					'question' => 'Test Question?',
					'answer' => 'Test answer text.',
				],
			],
		] );

		ob_start();
		$widget->render();
		$output = ob_get_clean();

		$this->assertStringContainsString( 'Test Question', $output );
		$this->assertStringContainsString( 'x-data', $output ); // Alpine.js
	}

	/**
	 * Test widgets escape output correctly
	 */
	public function test_widgets_escape_output() {
		$widget = $this->get_widget_instance( 'hero-01' );

		if ( ! $widget ) {
			$this->markTestSkipped( 'Hero-01 widget not available' );
		}

		// Try XSS attack
		$widget->set_settings( [
			'heading' => '<script>alert("xss")</script>Test',
		] );

		ob_start();
		$widget->render();
		$output = ob_get_clean();

		// Script should be escaped
		$this->assertStringNotContainsString( '<script>', $output );
		$this->assertStringContainsString( '&lt;script&gt;', $output );
	}

	/**
	 * Get widget instance for testing
	 *
	 * @param string $widget_slug Widget slug.
	 * @return mixed
	 */
	protected function get_widget_instance( $widget_slug ) {
		if ( ! did_action( 'elementor/widgets/register' ) ) {
			return null;
		}

		$widgets_manager = \Elementor\Plugin::instance()->widgets_manager;
		$widget_name = 'pagifye-' . $widget_slug;

		return $widgets_manager->get_widget_types( $widget_name );
	}
}
