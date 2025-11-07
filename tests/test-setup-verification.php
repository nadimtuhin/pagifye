<?php
/**
 * Setup Verification Test
 *
 * Simple test to verify PHPUnit is working without requiring WordPress
 *
 * @package Pagifye_Elementor_Widgets
 */

use PHPUnit\Framework\TestCase;

class Test_Setup_Verification extends TestCase {

	/**
	 * Test that PHPUnit is working
	 */
	public function test_phpunit_is_working() {
		$this->assertTrue( true );
	}

	/**
	 * Test that PHP version meets requirements
	 */
	public function test_php_version() {
		$this->assertTrue(
			version_compare( PHP_VERSION, '7.4', '>=' ),
			'PHP version must be 7.4 or higher'
		);
	}

	/**
	 * Test that plugin directory exists
	 */
	public function test_plugin_directory_exists() {
		$plugin_dir = dirname( dirname( __FILE__ ) ) . '/pagifye-elementor-widgets';
		$this->assertTrue(
			is_dir( $plugin_dir ),
			'Plugin directory should exist at: ' . $plugin_dir
		);
	}

	/**
	 * Test that main plugin file exists
	 */
	public function test_plugin_main_file_exists() {
		$plugin_file = dirname( dirname( __FILE__ ) ) . '/pagifye-elementor-widgets/pagifye-elementor-widgets.php';
		$this->assertTrue(
			file_exists( $plugin_file ),
			'Main plugin file should exist at: ' . $plugin_file
		);
	}

	/**
	 * Test that widgets directory exists
	 */
	public function test_widgets_directory_exists() {
		$widgets_dir = dirname( dirname( __FILE__ ) ) . '/pagifye-elementor-widgets/widgets';
		$this->assertTrue(
			is_dir( $widgets_dir ),
			'Widgets directory should exist'
		);
	}

	/**
	 * Test that includes directory exists
	 */
	public function test_includes_directory_exists() {
		$includes_dir = dirname( dirname( __FILE__ ) ) . '/pagifye-elementor-widgets/includes';
		$this->assertTrue(
			is_dir( $includes_dir ),
			'Includes directory should exist'
		);
	}

	/**
	 * Test that assets directory exists
	 */
	public function test_assets_directory_exists() {
		$assets_dir = dirname( dirname( __FILE__ ) ) . '/pagifye-elementor-widgets/assets';
		$this->assertTrue(
			is_dir( $assets_dir ),
			'Assets directory should exist'
		);
	}

	/**
	 * Test that we can count widget files
	 */
	public function test_widget_files_exist() {
		$widgets_dir = dirname( dirname( __FILE__ ) ) . '/pagifye-elementor-widgets/widgets';
		if ( is_dir( $widgets_dir ) ) {
			$widget_files = glob( $widgets_dir . '/class-*.php' );
			$this->assertGreaterThan(
				0,
				count( $widget_files ),
				'Should have at least one widget file'
			);
		}
	}

	/**
	 * Test that composer autoloader is available
	 */
	public function test_composer_autoloader_exists() {
		$autoloader = dirname( dirname( __FILE__ ) ) . '/vendor/autoload.php';
		$this->assertTrue(
			file_exists( $autoloader ),
			'Composer autoloader should exist'
		);
	}

	/**
	 * Test that testing dependencies are installed
	 */
	public function test_testing_dependencies_installed() {
		$vendor_dir = dirname( dirname( __FILE__ ) ) . '/vendor';
		$phpunit_dir = $vendor_dir . '/phpunit';

		$this->assertTrue(
			is_dir( $vendor_dir ),
			'Vendor directory should exist'
		);

		$this->assertTrue(
			is_dir( $phpunit_dir ),
			'PHPUnit should be installed in vendor directory'
		);
	}
}
