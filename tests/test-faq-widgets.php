<?php
/**
 * Test FAQ Widgets
 *
 * @package Pagifye_Elementor_Widgets
 */

use Pagifye\ElementorWidgets\Widgets\FAQ_01;
use Pagifye\ElementorWidgets\Widgets\FAQ_04;
use Pagifye\ElementorWidgets\Widgets\FAQ_05;

class Test_FAQ_Widgets extends \PHPUnit\Framework\TestCase {

	/**
	 * Test all FAQ widgets exist
	 */
	public function test_all_faq_widgets_exist() {
		$faq_widgets = [
			FAQ_01::class,
			FAQ_04::class,
			FAQ_05::class,
		];

		foreach ( $faq_widgets as $class ) {
			$this->assertTrue( class_exists( $class ) );
		}
	}

	/**
	 * Test FAQ widgets instantiate
	 */
	public function test_faq_widgets_instantiate() {
		$widgets = [
			new FAQ_01(),
			new FAQ_04(),
			new FAQ_05(),
		];

		foreach ( $widgets as $widget ) {
			$this->assertInstanceOf( \Pagifye\ElementorWidgets\Base_Widget::class, $widget );
		}
	}

	/**
	 * Test FAQ widgets render
	 */
	public function test_faq_widgets_render() {
		$widgets = [
			new FAQ_01(),
			new FAQ_04(),
			new FAQ_05(),
		];

		foreach ( $widgets as $widget ) {
			ob_start();
			$widget->render();
			$output = ob_get_clean();

			$this->assertNotEmpty( $output );
		}
	}

	/**
	 * Test FAQ_01 name
	 */
	public function test_faq_01_name() {
		$widget = new FAQ_01();
		$this->assertEquals( 'pagifye-faq-01', $widget->get_name() );
	}

	/**
	 * Test FAQ widgets have faq keywords
	 */
	public function test_faq_widgets_keywords() {
		$widget = new FAQ_01();
		$keywords = $widget->get_keywords();

		$this->assertIsArray( $keywords );
		$this->assertContains( 'faq', $keywords );
	}

	/**
	 * Test all FAQ widgets have unique names
	 */
	public function test_faq_widgets_unique_names() {
		$widgets = [
			new FAQ_01(),
			new FAQ_04(),
			new FAQ_05(),
		];

		$names = [];
		foreach ( $widgets as $widget ) {
			$names[] = $widget->get_name();
		}

		$this->assertCount( 3, array_unique( $names ) );
	}

	/**
	 * Test FAQ widgets have accordion keywords
	 */
	public function test_faq_widgets_have_accordion_keywords() {
		$widget = new FAQ_01();
		$keywords = $widget->get_keywords();

		$this->assertContains( 'accordion', $keywords );
	}
}
