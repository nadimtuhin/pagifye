<?php
/**
 * Test All Widgets - Generic Tests
 *
 * These tests run against all 35 widget classes to ensure
 * they follow proper structure and implement required methods.
 *
 * @package Pagifye_Elementor_Widgets
 */

use Pagifye\ElementorWidgets\Widgets_Loader;

class Test_All_Widgets extends \PHPUnit\Framework\TestCase {

	/**
	 * Get all widget instances
	 *
	 * @return array
	 */
	private function get_all_widget_instances() {
		$loader = new Widgets_Loader();
		$widget_list = $loader->get_widgets();
		$instances = [];

		foreach ( $widget_list as $id => $class_name ) {
			$full_class_name = '\\Pagifye\\ElementorWidgets\\Widgets\\' . $class_name;
			if ( class_exists( $full_class_name ) ) {
				$instances[$id] = new $full_class_name();
			}
		}

		return $instances;
	}

	/**
	 * Test all widgets can be instantiated
	 */
	public function test_all_widgets_instantiate() {
		$instances = $this->get_all_widget_instances();

		$this->assertGreaterThan( 0, count( $instances ) );

		foreach ( $instances as $id => $widget ) {
			$this->assertIsObject( $widget, "Widget {$id} should be an object" );
		}
	}

	/**
	 * Test all widgets extend Base_Widget
	 */
	public function test_all_widgets_extend_base() {
		$instances = $this->get_all_widget_instances();

		foreach ( $instances as $id => $widget ) {
			$this->assertInstanceOf(
				\Pagifye\ElementorWidgets\Base_Widget::class,
				$widget,
				"Widget {$id} should extend Base_Widget"
			);
		}
	}

	/**
	 * Test all widgets have get_name method
	 */
	public function test_all_widgets_have_get_name() {
		$instances = $this->get_all_widget_instances();

		foreach ( $instances as $id => $widget ) {
			$this->assertTrue(
				method_exists( $widget, 'get_name' ),
				"Widget {$id} should have get_name method"
			);
		}
	}

	/**
	 * Test all widgets return valid name
	 */
	public function test_all_widgets_return_valid_name() {
		$instances = $this->get_all_widget_instances();

		foreach ( $instances as $id => $widget ) {
			$name = $widget->get_name();
			$this->assertIsString( $name, "Widget {$id} name should be string" );
			$this->assertNotEmpty( $name, "Widget {$id} name should not be empty" );
		}
	}

	/**
	 * Test all widgets have get_title method
	 */
	public function test_all_widgets_have_get_title() {
		$instances = $this->get_all_widget_instances();

		foreach ( $instances as $id => $widget ) {
			$this->assertTrue(
				method_exists( $widget, 'get_title' ),
				"Widget {$id} should have get_title method"
			);
		}
	}

	/**
	 * Test all widgets return valid title
	 */
	public function test_all_widgets_return_valid_title() {
		$instances = $this->get_all_widget_instances();

		foreach ( $instances as $id => $widget ) {
			$title = $widget->get_title();
			$this->assertIsString( $title, "Widget {$id} title should be string" );
			$this->assertNotEmpty( $title, "Widget {$id} title should not be empty" );
		}
	}

	/**
	 * Test all widgets have get_icon method
	 */
	public function test_all_widgets_have_get_icon() {
		$instances = $this->get_all_widget_instances();

		foreach ( $instances as $id => $widget ) {
			$this->assertTrue(
				method_exists( $widget, 'get_icon' ),
				"Widget {$id} should have get_icon method"
			);
		}
	}

	/**
	 * Test all widgets return valid icon
	 */
	public function test_all_widgets_return_valid_icon() {
		$instances = $this->get_all_widget_instances();

		foreach ( $instances as $id => $widget ) {
			$icon = $widget->get_icon();
			$this->assertIsString( $icon, "Widget {$id} icon should be string" );
			$this->assertNotEmpty( $icon, "Widget {$id} icon should not be empty" );
		}
	}

	/**
	 * Test all widgets have get_categories method
	 */
	public function test_all_widgets_have_get_categories() {
		$instances = $this->get_all_widget_instances();

		foreach ( $instances as $id => $widget ) {
			$this->assertTrue(
				method_exists( $widget, 'get_categories' ),
				"Widget {$id} should have get_categories method"
			);
		}
	}

	/**
	 * Test all widgets return pagifye-widgets category
	 */
	public function test_all_widgets_return_pagifye_category() {
		$instances = $this->get_all_widget_instances();

		foreach ( $instances as $id => $widget ) {
			$categories = $widget->get_categories();
			$this->assertIsArray( $categories, "Widget {$id} categories should be array" );
			$this->assertContains( 'pagifye-widgets', $categories, "Widget {$id} should be in pagifye-widgets category" );
		}
	}

	/**
	 * Test all widgets have get_keywords method
	 */
	public function test_all_widgets_have_get_keywords() {
		$instances = $this->get_all_widget_instances();

		foreach ( $instances as $id => $widget ) {
			$this->assertTrue(
				method_exists( $widget, 'get_keywords' ),
				"Widget {$id} should have get_keywords method"
			);
		}
	}

	/**
	 * Test all widgets return array of keywords
	 */
	public function test_all_widgets_return_keywords_array() {
		$instances = $this->get_all_widget_instances();

		foreach ( $instances as $id => $widget ) {
			$keywords = $widget->get_keywords();
			$this->assertIsArray( $keywords, "Widget {$id} keywords should be array" );
		}
	}

	/**
	 * Test all widgets have register_controls method
	 */
	public function test_all_widgets_have_register_controls() {
		$instances = $this->get_all_widget_instances();

		foreach ( $instances as $id => $widget ) {
			$this->assertTrue(
				method_exists( $widget, 'register_controls' ),
				"Widget {$id} should have register_controls method"
			);
		}
	}

	/**
	 * Test all widgets have render method
	 */
	public function test_all_widgets_have_render() {
		$instances = $this->get_all_widget_instances();

		foreach ( $instances as $id => $widget ) {
			$this->assertTrue(
				method_exists( $widget, 'render' ),
				"Widget {$id} should have render method"
			);
		}
	}

	/**
	 * Test render method produces output
	 */
	public function test_all_widgets_render_produces_output() {
		$instances = $this->get_all_widget_instances();

		foreach ( $instances as $id => $widget ) {
			ob_start();
			$widget->render();
			$output = ob_get_clean();

			$this->assertNotEmpty( $output, "Widget {$id} should produce output when rendered" );
		}
	}

	/**
	 * Test all widget names start with pagifye-
	 */
	public function test_all_widget_names_have_prefix() {
		$instances = $this->get_all_widget_instances();

		foreach ( $instances as $id => $widget ) {
			$name = $widget->get_name();
			if ( $name !== 'mock-widget' ) { // Skip our test widget
				$this->assertStringStartsWith(
					'pagifye-',
					$name,
					"Widget {$id} name should start with 'pagifye-'"
				);
			}
		}
	}

	/**
	 * Test widget names don't contain spaces
	 */
	public function test_widget_names_no_spaces() {
		$instances = $this->get_all_widget_instances();

		foreach ( $instances as $id => $widget ) {
			$name = $widget->get_name();
			$this->assertStringNotContainsString(
				' ',
				$name,
				"Widget {$id} name should not contain spaces"
			);
		}
	}

	/**
	 * Test widget icons are valid Elementor icons
	 */
	public function test_widget_icons_are_valid() {
		$instances = $this->get_all_widget_instances();

		foreach ( $instances as $id => $widget ) {
			$icon = $widget->get_icon();
			$this->assertStringStartsWith(
				'eicon-',
				$icon,
				"Widget {$id} icon should start with 'eicon-'"
			);
		}
	}

	/**
	 * Test widget count matches expected (35 widgets)
	 */
	public function test_widget_count_matches_expected() {
		$instances = $this->get_all_widget_instances();
		$this->assertEquals( 35, count( $instances ), "Should have exactly 35 widgets" );
	}

	/**
	 * Test no duplicate widget names
	 */
	public function test_no_duplicate_widget_names() {
		$instances = $this->get_all_widget_instances();
		$names = [];

		foreach ( $instances as $widget ) {
			$names[] = $widget->get_name();
		}

		$unique_names = array_unique( $names );
		$this->assertCount(
			count( $names ),
			$unique_names,
			"All widget names should be unique"
		);
	}
}
