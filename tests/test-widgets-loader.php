<?php
/**
 * Test Widgets Loader Class
 *
 * @package Pagifye_Elementor_Widgets
 */

use Pagifye\ElementorWidgets\Widgets_Loader;

class Test_Widgets_Loader extends \PHPUnit\Framework\TestCase {

	/**
	 * Test instance creation
	 */
	public function test_instance_creation() {
		$loader = new Widgets_Loader();
		$this->assertInstanceOf( Widgets_Loader::class, $loader );
	}

	/**
	 * Test get_widgets returns array
	 */
	public function test_get_widgets_returns_array() {
		$loader = new Widgets_Loader();
		$widgets = $loader->get_widgets();

		$this->assertIsArray( $widgets );
	}

	/**
	 * Test get_widgets returns non-empty array
	 */
	public function test_get_widgets_not_empty() {
		$loader = new Widgets_Loader();
		$widgets = $loader->get_widgets();

		$this->assertNotEmpty( $widgets );
	}

	/**
	 * Test has expected number of widgets (35 including test widget)
	 */
	public function test_widget_count() {
		$loader = new Widgets_Loader();
		$widgets = $loader->get_widgets();

		$this->assertEquals( 35, count( $widgets ) );
	}

	/**
	 * Test navigation widgets are included
	 */
	public function test_navigation_widgets_included() {
		$loader = new Widgets_Loader();
		$widgets = $loader->get_widgets();

		$this->assertArrayHasKey( 'navigation-01', $widgets );
		$this->assertArrayHasKey( 'navigation-03', $widgets );
		$this->assertArrayHasKey( 'navigation-05', $widgets );
	}

	/**
	 * Test hero widgets are included
	 */
	public function test_hero_widgets_included() {
		$loader = new Widgets_Loader();
		$widgets = $loader->get_widgets();

		$this->assertArrayHasKey( 'hero-01', $widgets );
		$this->assertArrayHasKey( 'hero-03', $widgets );
		$this->assertArrayHasKey( 'hero-04', $widgets );
		$this->assertArrayHasKey( 'hero-06', $widgets );
		$this->assertArrayHasKey( 'hero-07', $widgets );
	}

	/**
	 * Test pricing widgets are included
	 */
	public function test_pricing_widgets_included() {
		$loader = new Widgets_Loader();
		$widgets = $loader->get_widgets();

		$this->assertArrayHasKey( 'pricing-01', $widgets );
		$this->assertArrayHasKey( 'pricing-02', $widgets );
		$this->assertArrayHasKey( 'pricing-05', $widgets );
	}

	/**
	 * Test FAQ widgets are included
	 */
	public function test_faq_widgets_included() {
		$loader = new Widgets_Loader();
		$widgets = $loader->get_widgets();

		$this->assertArrayHasKey( 'faq-01', $widgets );
		$this->assertArrayHasKey( 'faq-04', $widgets );
		$this->assertArrayHasKey( 'faq-05', $widgets );
	}

	/**
	 * Test testimonial widgets are included
	 */
	public function test_testimonial_widgets_included() {
		$loader = new Widgets_Loader();
		$widgets = $loader->get_widgets();

		$this->assertArrayHasKey( 'testimonial-02', $widgets );
		$this->assertArrayHasKey( 'testimonial-04', $widgets );
		$this->assertArrayHasKey( 'testimonial-05', $widgets );
	}

	/**
	 * Test contact widgets are included
	 */
	public function test_contact_widgets_included() {
		$loader = new Widgets_Loader();
		$widgets = $loader->get_widgets();

		$this->assertArrayHasKey( 'contact-01', $widgets );
		$this->assertArrayHasKey( 'contact-02', $widgets );
		$this->assertArrayHasKey( 'contact-04', $widgets );
	}

	/**
	 * Test content widgets are included
	 */
	public function test_content_widgets_included() {
		$loader = new Widgets_Loader();
		$widgets = $loader->get_widgets();

		$this->assertArrayHasKey( 'content-02', $widgets );
		$this->assertArrayHasKey( 'content-03', $widgets );
		$this->assertArrayHasKey( 'content-04', $widgets );
	}

	/**
	 * Test team widgets are included
	 */
	public function test_team_widgets_included() {
		$loader = new Widgets_Loader();
		$widgets = $loader->get_widgets();

		$this->assertArrayHasKey( 'team-01', $widgets );
		$this->assertArrayHasKey( 'team-02', $widgets );
		$this->assertArrayHasKey( 'team-04', $widgets );
	}

	/**
	 * Test metrics widgets are included
	 */
	public function test_metrics_widgets_included() {
		$loader = new Widgets_Loader();
		$widgets = $loader->get_widgets();

		$this->assertArrayHasKey( 'metrics-02', $widgets );
		$this->assertArrayHasKey( 'metrics-06', $widgets );
	}

	/**
	 * Test awards widgets are included
	 */
	public function test_awards_widgets_included() {
		$loader = new Widgets_Loader();
		$widgets = $loader->get_widgets();

		$this->assertArrayHasKey( 'awards-01', $widgets );
		$this->assertArrayHasKey( 'awards-02', $widgets );
		$this->assertArrayHasKey( 'awards-04', $widgets );
	}

	/**
	 * Test blog widgets are included
	 */
	public function test_blog_widgets_included() {
		$loader = new Widgets_Loader();
		$widgets = $loader->get_widgets();

		$this->assertArrayHasKey( 'blog-01', $widgets );
		$this->assertArrayHasKey( 'blog-03', $widgets );
		$this->assertArrayHasKey( 'blog-05', $widgets );
	}

	/**
	 * Test widget class names are correct format
	 */
	public function test_widget_class_names_format() {
		$loader = new Widgets_Loader();
		$widgets = $loader->get_widgets();

		foreach ( $widgets as $id => $class_name ) {
			$this->assertIsString( $class_name );
			$this->assertStringContainsString( '_', $class_name );
		}
	}

	/**
	 * Test register_widgets hook is added
	 */
	public function test_register_widgets_hook_added() {
		new Widgets_Loader();

		$this->assertGreaterThan( 0, has_action( 'elementor/widgets/register' ) );
	}

	/**
	 * Test all widget class files exist
	 */
	public function test_widget_files_exist() {
		$loader = new Widgets_Loader();
		$widgets = $loader->get_widgets();
		$widgets_dir = dirname( dirname( __FILE__ ) ) . '/pagifye-elementor-widgets/widgets/';

		foreach ( $widgets as $id => $class_name ) {
			$file_name = 'class-' . strtolower( str_replace( '_', '-', $class_name ) ) . '.php';
			$file_path = $widgets_dir . $file_name;

			$this->assertFileExists( $file_path, "Widget file should exist: {$file_name}" );
		}
	}

	/**
	 * Test total widget categories
	 */
	public function test_widget_categories_count() {
		$loader = new Widgets_Loader();
		$widgets = $loader->get_widgets();

		// Count widgets by category (simple heuristic based on naming)
		$categories = [];
		foreach ( $widgets as $id => $class_name ) {
			$category = explode( '-', $id )[0];
			if ( ! isset( $categories[$category] ) ) {
				$categories[$category] = 0;
			}
			$categories[$category]++;
		}

		// Should have 11 categories (navigation, hero, pricing, faq, testimonial, contact, content, team, metrics, awards, blog)
		$this->assertGreaterThanOrEqual( 11, count( $categories ) );
	}
}
