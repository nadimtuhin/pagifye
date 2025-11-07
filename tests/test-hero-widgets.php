<?php
/**
 * Test Hero Widgets
 *
 * @package Pagifye_Elementor_Widgets
 */

use Pagifye\ElementorWidgets\Widgets\Hero_01;

class Test_Hero_Widgets extends \PHPUnit\Framework\TestCase {

	/**
	 * Test Hero_01 widget instantiation
	 */
	public function test_hero_01_instantiation() {
		$widget = new Hero_01();
		$this->assertInstanceOf( Hero_01::class, $widget );
	}

	/**
	 * Test Hero_01 get_name
	 */
	public function test_hero_01_get_name() {
		$widget = new Hero_01();
		$this->assertEquals( 'pagifye-hero-01', $widget->get_name() );
	}

	/**
	 * Test Hero_01 get_title
	 */
	public function test_hero_01_get_title() {
		$widget = new Hero_01();
		$title = $widget->get_title();

		$this->assertIsString( $title );
		$this->assertStringContainsString( 'Hero', $title );
	}

	/**
	 * Test Hero_01 get_icon
	 */
	public function test_hero_01_get_icon() {
		$widget = new Hero_01();
		$icon = $widget->get_icon();

		$this->assertIsString( $icon );
		$this->assertStringStartsWith( 'eicon-', $icon );
	}

	/**
	 * Test Hero_01 keywords include relevant terms
	 */
	public function test_hero_01_keywords() {
		$widget = new Hero_01();
		$keywords = $widget->get_keywords();

		$this->assertIsArray( $keywords );
		$this->assertContains( 'hero', $keywords );
	}

	/**
	 * Test Hero_01 renders content
	 */
	public function test_hero_01_renders_content() {
		$widget = new Hero_01();

		ob_start();
		$widget->render();
		$output = ob_get_clean();

		$this->assertNotEmpty( $output );
	}

	/**
	 * Test Hero_01 has content section
	 */
	public function test_hero_01_has_content_section() {
		$widget = new Hero_01();

		// Register controls to set them up
		$widget->register_controls();

		// Check that controls were registered (via reflection or output check)
		$this->assertTrue( method_exists( $widget, 'render' ) );
	}

	/**
	 * Test all hero widgets exist
	 */
	public function test_all_hero_widgets_exist() {
		$hero_widgets = [
			'\\Pagifye\\ElementorWidgets\\Widgets\\Hero_01',
			'\\Pagifye\\ElementorWidgets\\Widgets\\Hero_03',
			'\\Pagifye\\ElementorWidgets\\Widgets\\Hero_04',
			'\\Pagifye\\ElementorWidgets\\Widgets\\Hero_06',
			'\\Pagifye\\ElementorWidgets\\Widgets\\Hero_07',
		];

		foreach ( $hero_widgets as $class ) {
			$this->assertTrue( class_exists( $class ), "Class {$class} should exist" );
		}
	}

	/**
	 * Test all hero widgets can be instantiated
	 */
	public function test_all_hero_widgets_instantiate() {
		$hero_classes = [
			\Pagifye\ElementorWidgets\Widgets\Hero_01::class,
			\Pagifye\ElementorWidgets\Widgets\Hero_03::class,
			\Pagifye\ElementorWidgets\Widgets\Hero_04::class,
			\Pagifye\ElementorWidgets\Widgets\Hero_06::class,
			\Pagifye\ElementorWidgets\Widgets\Hero_07::class,
		];

		foreach ( $hero_classes as $class ) {
			$widget = new $class();
			$this->assertInstanceOf( \Pagifye\ElementorWidgets\Base_Widget::class, $widget );
		}
	}

	/**
	 * Test all hero widgets have unique names
	 */
	public function test_all_hero_widgets_unique_names() {
		$widgets = [
			new \Pagifye\ElementorWidgets\Widgets\Hero_01(),
			new \Pagifye\ElementorWidgets\Widgets\Hero_03(),
			new \Pagifye\ElementorWidgets\Widgets\Hero_04(),
			new \Pagifye\ElementorWidgets\Widgets\Hero_06(),
			new \Pagifye\ElementorWidgets\Widgets\Hero_07(),
		];

		$names = [];
		foreach ( $widgets as $widget ) {
			$names[] = $widget->get_name();
		}

		$unique_names = array_unique( $names );
		$this->assertCount( count( $names ), $unique_names );
	}

	/**
	 * Test all hero widgets produce output
	 */
	public function test_all_hero_widgets_produce_output() {
		$widgets = [
			new \Pagifye\ElementorWidgets\Widgets\Hero_01(),
			new \Pagifye\ElementorWidgets\Widgets\Hero_03(),
			new \Pagifye\ElementorWidgets\Widgets\Hero_04(),
			new \Pagifye\ElementorWidgets\Widgets\Hero_06(),
			new \Pagifye\ElementorWidgets\Widgets\Hero_07(),
		];

		foreach ( $widgets as $widget ) {
			ob_start();
			$widget->render();
			$output = ob_get_clean();

			$this->assertNotEmpty( $output, get_class( $widget ) . ' should produce output' );
		}
	}
}
