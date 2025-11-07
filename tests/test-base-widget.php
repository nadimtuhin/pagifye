<?php
/**
 * Test Base Widget Class
 *
 * @package Pagifye_Elementor_Widgets
 */

use Pagifye\ElementorWidgets\Base_Widget;

/**
 * Mock widget for testing
 */
class Mock_Test_Widget extends Base_Widget {
	public function get_name() {
		return 'mock-widget';
	}

	public function get_title() {
		return 'Mock Widget';
	}

	protected function register_controls() {
		// Empty for testing
	}

	protected function render() {
		echo 'Mock widget content';
	}
}

class Test_Base_Widget extends \PHPUnit\Framework\TestCase {

	/**
	 * Test get_categories returns pagifye-widgets
	 */
	public function test_get_categories() {
		$widget = new Mock_Test_Widget();
		$categories = $widget->get_categories();

		$this->assertIsArray( $categories );
		$this->assertContains( 'pagifye-widgets', $categories );
	}

	/**
	 * Test get_icon returns default icon
	 */
	public function test_get_icon() {
		$widget = new Mock_Test_Widget();
		$icon = $widget->get_icon();

		$this->assertEquals( 'eicon-plug', $icon );
	}

	/**
	 * Test get_keywords returns array
	 */
	public function test_get_keywords() {
		$widget = new Mock_Test_Widget();
		$keywords = $widget->get_keywords();

		$this->assertIsArray( $keywords );
		$this->assertContains( 'pagifye', $keywords );
		$this->assertContains( 'tailwind', $keywords );
		$this->assertContains( 'component', $keywords );
	}

	/**
	 * Test widget has required methods
	 */
	public function test_widget_has_required_methods() {
		$widget = new Mock_Test_Widget();

		$this->assertTrue( method_exists( $widget, 'get_name' ) );
		$this->assertTrue( method_exists( $widget, 'get_title' ) );
		$this->assertTrue( method_exists( $widget, 'get_categories' ) );
		$this->assertTrue( method_exists( $widget, 'register_controls' ) );
		$this->assertTrue( method_exists( $widget, 'render' ) );
	}

	/**
	 * Test get_name returns string
	 */
	public function test_get_name_returns_string() {
		$widget = new Mock_Test_Widget();
		$this->assertIsString( $widget->get_name() );
	}

	/**
	 * Test get_title returns string
	 */
	public function test_get_title_returns_string() {
		$widget = new Mock_Test_Widget();
		$this->assertIsString( $widget->get_title() );
	}

	/**
	 * Test render outputs content
	 */
	public function test_render_outputs_content() {
		$widget = new Mock_Test_Widget();

		ob_start();
		$widget->render();
		$output = ob_get_clean();

		$this->assertNotEmpty( $output );
		$this->assertStringContainsString( 'Mock widget content', $output );
	}
}
