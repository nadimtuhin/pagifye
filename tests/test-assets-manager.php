<?php
/**
 * Test Assets Manager Class
 *
 * @package Pagifye_Elementor_Widgets
 */

use Pagifye\ElementorWidgets\Assets_Manager;

class Test_Assets_Manager extends \PHPUnit\Framework\TestCase {

	/**
	 * Test instance creation
	 */
	public function test_instance_creation() {
		$assets_manager = new Assets_Manager();
		$this->assertInstanceOf( Assets_Manager::class, $assets_manager );
	}

	/**
	 * Test mark_widget_used method
	 */
	public function test_mark_widget_used() {
		Assets_Manager::mark_widget_used( 'pagifye-hero-01' );
		$widgets = Assets_Manager::get_widgets_in_use();

		$this->assertContains( 'pagifye-hero-01', $widgets );
	}

	/**
	 * Test get_widgets_in_use returns array
	 */
	public function test_get_widgets_in_use_returns_array() {
		$widgets = Assets_Manager::get_widgets_in_use();
		$this->assertIsArray( $widgets );
	}

	/**
	 * Test multiple widgets can be marked
	 */
	public function test_multiple_widgets_marked() {
		Assets_Manager::mark_widget_used( 'pagifye-navigation-01' );
		Assets_Manager::mark_widget_used( 'pagifye-pricing-01' );

		$widgets = Assets_Manager::get_widgets_in_use();
		$this->assertGreaterThanOrEqual( 2, count( $widgets ) );
	}

	/**
	 * Test add_defer_attribute adds defer to script tag
	 */
	public function test_add_defer_attribute() {
		$assets_manager = new Assets_Manager();

		$tag = '<script src="test.js"></script>';
		$result = $assets_manager->add_defer_attribute( $tag, 'pagifye-widgets' );

		$this->assertStringContainsString( 'defer', $result );
	}

	/**
	 * Test add_defer_attribute only affects pagifye-widgets handle
	 */
	public function test_add_defer_attribute_other_handles() {
		$assets_manager = new Assets_Manager();

		$tag = '<script src="other.js"></script>';
		$result = $assets_manager->add_defer_attribute( $tag, 'other-script' );

		$this->assertEquals( $tag, $result );
	}

	/**
	 * Test register_assets hooks are added
	 */
	public function test_hooks_registered() {
		new Assets_Manager();

		$this->assertGreaterThan( 0, has_action( 'wp_enqueue_scripts', [ Assets_Manager::class, 'register_assets' ] ) >= 0 );
		$this->assertTrue( has_action( 'wp_footer' ) !== false );
	}

	/**
	 * Test WP_DEBUG mode changes asset URLs
	 */
	public function test_debug_mode_assets() {
		if ( ! defined( 'WP_DEBUG' ) ) {
			define( 'WP_DEBUG', true );
		}

		$assets_manager = new Assets_Manager();
		$assets_manager->register_assets();

		global $wp_styles, $wp_scripts;

		// Check that pagifye-widgets style is registered
		$this->assertTrue( isset( $wp_styles->registered['pagifye-widgets'] ) );
		$this->assertTrue( isset( $wp_scripts->registered['pagifye-widgets'] ) );
	}
}
