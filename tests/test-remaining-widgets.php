<?php
/**
 * Test Remaining Widget Categories
 *
 * Tests for Contact, Content, Team, Metrics, Awards, and Blog widgets
 *
 * @package Pagifye_Elementor_Widgets
 */

class Test_Remaining_Widgets extends \PHPUnit\Framework\TestCase {

	/**
	 * Test all contact widgets
	 */
	public function test_contact_widgets() {
		$widgets = [
			new \Pagifye\ElementorWidgets\Widgets\Contact_01(),
			new \Pagifye\ElementorWidgets\Widgets\Contact_02(),
			new \Pagifye\ElementorWidgets\Widgets\Contact_04(),
		];

		foreach ( $widgets as $widget ) {
			$this->assertInstanceOf( \Pagifye\ElementorWidgets\Base_Widget::class, $widget );

			ob_start();
			$widget->render();
			$output = ob_get_clean();
			$this->assertNotEmpty( $output );
		}
	}

	/**
	 * Test all content widgets
	 */
	public function test_content_widgets() {
		$widgets = [
			new \Pagifye\ElementorWidgets\Widgets\Content_02(),
			new \Pagifye\ElementorWidgets\Widgets\Content_03(),
			new \Pagifye\ElementorWidgets\Widgets\Content_04(),
		];

		foreach ( $widgets as $widget ) {
			$this->assertInstanceOf( \Pagifye\ElementorWidgets\Base_Widget::class, $widget );

			ob_start();
			$widget->render();
			$output = ob_get_clean();
			$this->assertNotEmpty( $output );
		}
	}

	/**
	 * Test all team widgets
	 */
	public function test_team_widgets() {
		$widgets = [
			new \Pagifye\ElementorWidgets\Widgets\Team_01(),
			new \Pagifye\ElementorWidgets\Widgets\Team_02(),
			new \Pagifye\ElementorWidgets\Widgets\Team_04(),
		];

		foreach ( $widgets as $widget ) {
			$this->assertInstanceOf( \Pagifye\ElementorWidgets\Base_Widget::class, $widget );

			ob_start();
			$widget->render();
			$output = ob_get_clean();
			$this->assertNotEmpty( $output );
		}
	}

	/**
	 * Test all metrics widgets
	 */
	public function test_metrics_widgets() {
		$widgets = [
			new \Pagifye\ElementorWidgets\Widgets\Metrics_02(),
			new \Pagifye\ElementorWidgets\Widgets\Metrics_06(),
		];

		foreach ( $widgets as $widget ) {
			$this->assertInstanceOf( \Pagifye\ElementorWidgets\Base_Widget::class, $widget );

			ob_start();
			$widget->render();
			$output = ob_get_clean();
			$this->assertNotEmpty( $output );
		}
	}

	/**
	 * Test all awards widgets
	 */
	public function test_awards_widgets() {
		$widgets = [
			new \Pagifye\ElementorWidgets\Widgets\Awards_01(),
			new \Pagifye\ElementorWidgets\Widgets\Awards_02(),
			new \Pagifye\ElementorWidgets\Widgets\Awards_04(),
		];

		foreach ( $widgets as $widget ) {
			$this->assertInstanceOf( \Pagifye\ElementorWidgets\Base_Widget::class, $widget );

			ob_start();
			$widget->render();
			$output = ob_get_clean();
			$this->assertNotEmpty( $output );
		}
	}

	/**
	 * Test all blog widgets
	 */
	public function test_blog_widgets() {
		$widgets = [
			new \Pagifye\ElementorWidgets\Widgets\Blog_01(),
			new \Pagifye\ElementorWidgets\Widgets\Blog_03(),
			new \Pagifye\ElementorWidgets\Widgets\Blog_05(),
		];

		foreach ( $widgets as $widget ) {
			$this->assertInstanceOf( \Pagifye\ElementorWidgets\Base_Widget::class, $widget );

			ob_start();
			$widget->render();
			$output = ob_get_clean();
			$this->assertNotEmpty( $output );
		}
	}

	/**
	 * Test contact widget names
	 */
	public function test_contact_widget_names() {
		$widget = new \Pagifye\ElementorWidgets\Widgets\Contact_01();
		$this->assertEquals( 'pagifye-contact-01', $widget->get_name() );
	}

	/**
	 * Test content widget names
	 */
	public function test_content_widget_names() {
		$widget = new \Pagifye\ElementorWidgets\Widgets\Content_02();
		$this->assertEquals( 'pagifye-content-02', $widget->get_name() );
	}

	/**
	 * Test team widget names
	 */
	public function test_team_widget_names() {
		$widget = new \Pagifye\ElementorWidgets\Widgets\Team_01();
		$this->assertEquals( 'pagifye-team-01', $widget->get_name() );
	}

	/**
	 * Test metrics widget names
	 */
	public function test_metrics_widget_names() {
		$widget = new \Pagifye\ElementorWidgets\Widgets\Metrics_02();
		$this->assertEquals( 'pagifye-metrics-02', $widget->get_name() );
	}

	/**
	 * Test awards widget names
	 */
	public function test_awards_widget_names() {
		$widget = new \Pagifye\ElementorWidgets\Widgets\Awards_01();
		$this->assertEquals( 'pagifye-awards-01', $widget->get_name() );
	}

	/**
	 * Test blog widget names
	 */
	public function test_blog_widget_names() {
		$widget = new \Pagifye\ElementorWidgets\Widgets\Blog_01();
		$this->assertEquals( 'pagifye-blog-01', $widget->get_name() );
	}
}
