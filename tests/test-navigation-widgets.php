<?php
/**
 * Test Navigation Widgets
 *
 * @package Pagifye_Elementor_Widgets
 */

use Pagifye\ElementorWidgets\Widgets\Navigation_01;
use Pagifye\ElementorWidgets\Widgets\Navigation_03;
use Pagifye\ElementorWidgets\Widgets\Navigation_05;

class Test_Navigation_Widgets extends \PHPUnit\Framework\TestCase {

	/**
	 * Test Navigation_01 widget
	 */
	public function test_navigation_01_exists() {
		$this->assertTrue( class_exists( Navigation_01::class ) );
	}

	/**
	 * Test Navigation_01 instantiation
	 */
	public function test_navigation_01_instantiation() {
		$widget = new Navigation_01();
		$this->assertInstanceOf( Navigation_01::class, $widget );
	}

	/**
	 * Test Navigation_01 name
	 */
	public function test_navigation_01_name() {
		$widget = new Navigation_01();
		$this->assertEquals( 'pagifye-navigation-01', $widget->get_name() );
	}

	/**
	 * Test all navigation widgets exist
	 */
	public function test_all_navigation_widgets_exist() {
		$nav_widgets = [
			Navigation_01::class,
			Navigation_03::class,
			Navigation_05::class,
		];

		foreach ( $nav_widgets as $class ) {
			$this->assertTrue( class_exists( $class ), "Class {$class} should exist" );
		}
	}

	/**
	 * Test all navigation widgets instantiate
	 */
	public function test_all_navigation_widgets_instantiate() {
		$widgets = [
			new Navigation_01(),
			new Navigation_03(),
			new Navigation_05(),
		];

		foreach ( $widgets as $widget ) {
			$this->assertInstanceOf( \Pagifye\ElementorWidgets\Base_Widget::class, $widget );
		}
	}

	/**
	 * Test all navigation widgets render
	 */
	public function test_all_navigation_widgets_render() {
		$widgets = [
			new Navigation_01(),
			new Navigation_03(),
			new Navigation_05(),
		];

		foreach ( $widgets as $widget ) {
			ob_start();
			$widget->render();
			$output = ob_get_clean();

			$this->assertNotEmpty( $output );
		}
	}

	/**
	 * Test navigation widgets have unique names
	 */
	public function test_navigation_widgets_unique_names() {
		$widgets = [
			new Navigation_01(),
			new Navigation_03(),
			new Navigation_05(),
		];

		$names = array_map( function( $widget ) {
			return $widget->get_name();
		}, $widgets );

		$this->assertCount( 3, array_unique( $names ) );
	}

	/**
	 * Test navigation keywords
	 */
	public function test_navigation_keywords() {
		$widget = new Navigation_01();
		$keywords = $widget->get_keywords();

		$this->assertIsArray( $keywords );
		$this->assertNotEmpty( $keywords );
	}
}
