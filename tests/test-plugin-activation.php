<?php
/**
 * Plugin Activation Tests
 *
 * @package Pagifye_Elementor_Widgets
 */

/**
 * Test plugin activation and basic functionality
 */
class Test_Plugin_Activation extends WP_UnitTestCase {

	/**
	 * Test plugin is activated
	 */
	public function test_plugin_activated() {
		$this->assertTrue( is_plugin_active( 'pagifye-elementor-widgets/pagifye-elementor-widgets.php' ) );
	}

	/**
	 * Test main plugin class exists
	 */
	public function test_main_class_exists() {
		$this->assertTrue( class_exists( 'Pagifye\ElementorWidgets\Plugin' ) );
	}

	/**
	 * Test Elementor is active (dependency)
	 */
	public function test_elementor_active() {
		$this->assertTrue( did_action( 'elementor/loaded' ) > 0 );
	}

	/**
	 * Test widgets loader class exists
	 */
	public function test_widgets_loader_exists() {
		$this->assertTrue( class_exists( 'Pagifye\ElementorWidgets\Widgets_Loader' ) );
	}

	/**
	 * Test base widget class exists
	 */
	public function test_base_widget_exists() {
		$this->assertTrue( class_exists( 'Pagifye\ElementorWidgets\Base_Widget' ) );
	}

	/**
	 * Test assets manager class exists
	 */
	public function test_assets_manager_exists() {
		$this->assertTrue( class_exists( 'Pagifye\ElementorWidgets\Assets_Manager' ) );
	}
}
