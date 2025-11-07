<?php
/**
 * Test Pricing Widgets
 *
 * @package Pagifye_Elementor_Widgets
 */

use Pagifye\ElementorWidgets\Widgets\Pricing_01;
use Pagifye\ElementorWidgets\Widgets\Pricing_02;
use Pagifye\ElementorWidgets\Widgets\Pricing_05;

class Test_Pricing_Widgets extends \PHPUnit\Framework\TestCase {

	/**
	 * Test all pricing widgets exist
	 */
	public function test_all_pricing_widgets_exist() {
		$pricing_widgets = [
			Pricing_01::class,
			Pricing_02::class,
			Pricing_05::class,
		];

		foreach ( $pricing_widgets as $class ) {
			$this->assertTrue( class_exists( $class ) );
		}
	}

	/**
	 * Test pricing widgets instantiate
	 */
	public function test_pricing_widgets_instantiate() {
		$widgets = [
			new Pricing_01(),
			new Pricing_02(),
			new Pricing_05(),
		];

		foreach ( $widgets as $widget ) {
			$this->assertInstanceOf( \Pagifye\ElementorWidgets\Base_Widget::class, $widget );
		}
	}

	/**
	 * Test pricing widgets render
	 */
	public function test_pricing_widgets_render() {
		$widgets = [
			new Pricing_01(),
			new Pricing_02(),
			new Pricing_05(),
		];

		foreach ( $widgets as $widget ) {
			ob_start();
			$widget->render();
			$output = ob_get_clean();

			$this->assertNotEmpty( $output );
		}
	}

	/**
	 * Test Pricing_01 name
	 */
	public function test_pricing_01_name() {
		$widget = new Pricing_01();
		$this->assertEquals( 'pagifye-pricing-01', $widget->get_name() );
	}

	/**
	 * Test pricing widgets have pricing keywords
	 */
	public function test_pricing_widgets_keywords() {
		$widget = new Pricing_01();
		$keywords = $widget->get_keywords();

		$this->assertIsArray( $keywords );
		$this->assertContains( 'pricing', $keywords );
	}

	/**
	 * Test all pricing widgets have unique names
	 */
	public function test_pricing_widgets_unique_names() {
		$widgets = [
			new Pricing_01(),
			new Pricing_02(),
			new Pricing_05(),
		];

		$names = [];
		foreach ( $widgets as $widget ) {
			$names[] = $widget->get_name();
		}

		$this->assertCount( 3, array_unique( $names ) );
	}
}
