<?php
/**
 * Test Testimonial Widgets
 *
 * @package Pagifye_Elementor_Widgets
 */

use Pagifye\ElementorWidgets\Widgets\Testimonial_02;
use Pagifye\ElementorWidgets\Widgets\Testimonial_04;
use Pagifye\ElementorWidgets\Widgets\Testimonial_05;

class Test_Testimonial_Widgets extends \PHPUnit\Framework\TestCase {

	/**
	 * Test all testimonial widgets exist
	 */
	public function test_all_testimonial_widgets_exist() {
		$testimonial_widgets = [
			Testimonial_02::class,
			Testimonial_04::class,
			Testimonial_05::class,
		];

		foreach ( $testimonial_widgets as $class ) {
			$this->assertTrue( class_exists( $class ) );
		}
	}

	/**
	 * Test testimonial widgets instantiate
	 */
	public function test_testimonial_widgets_instantiate() {
		$widgets = [
			new Testimonial_02(),
			new Testimonial_04(),
			new Testimonial_05(),
		];

		foreach ( $widgets as $widget ) {
			$this->assertInstanceOf( \Pagifye\ElementorWidgets\Base_Widget::class, $widget );
		}
	}

	/**
	 * Test testimonial widgets render
	 */
	public function test_testimonial_widgets_render() {
		$widgets = [
			new Testimonial_02(),
			new Testimonial_04(),
			new Testimonial_05(),
		];

		foreach ( $widgets as $widget ) {
			ob_start();
			$widget->render();
			$output = ob_get_clean();

			$this->assertNotEmpty( $output );
		}
	}

	/**
	 * Test Testimonial_02 name
	 */
	public function test_testimonial_02_name() {
		$widget = new Testimonial_02();
		$this->assertEquals( 'pagifye-testimonial-02', $widget->get_name() );
	}

	/**
	 * Test testimonial widgets have testimonial keywords
	 */
	public function test_testimonial_widgets_keywords() {
		$widget = new Testimonial_02();
		$keywords = $widget->get_keywords();

		$this->assertIsArray( $keywords );
		$this->assertContains( 'testimonial', $keywords );
	}

	/**
	 * Test all testimonial widgets have unique names
	 */
	public function test_testimonial_widgets_unique_names() {
		$widgets = [
			new Testimonial_02(),
			new Testimonial_04(),
			new Testimonial_05(),
		];

		$names = [];
		foreach ( $widgets as $widget ) {
			$names[] = $widget->get_name();
		}

		$this->assertCount( 3, array_unique( $names ) );
	}
}
