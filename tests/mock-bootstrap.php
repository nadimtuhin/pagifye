<?php
/**
 * Mock Bootstrap for PHPUnit Tests
 *
 * Loads plugin files without WordPress for unit testing
 *
 * @package Pagifye_Elementor_Widgets
 */

// Load composer autoloader
require_once dirname( __DIR__ ) . '/vendor/autoload.php';

// Define WordPress constants that might be needed
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', '/tmp/wordpress/' );
}

if ( ! defined( 'PAGIFYE_WIDGETS_VERSION' ) ) {
	define( 'PAGIFYE_WIDGETS_VERSION', '1.0.0' );
}

if ( ! defined( 'PAGIFYE_WIDGETS_URL' ) ) {
	define( 'PAGIFYE_WIDGETS_URL', 'http://localhost/wp-content/plugins/pagifye-elementor-widgets/' );
}

if ( ! defined( 'PAGIFYE_WIDGETS_PATH' ) ) {
	define( 'PAGIFYE_WIDGETS_PATH', dirname( __DIR__ ) . '/pagifye-elementor-widgets/' );
}

if ( ! defined( 'PAGIFYE_WIDGETS_ASSETS_URL' ) ) {
	define( 'PAGIFYE_WIDGETS_ASSETS_URL', PAGIFYE_WIDGETS_URL . 'assets/' );
}

// Mock WordPress functions used by the plugin
if ( ! function_exists( 'esc_html__' ) ) {
	function esc_html__( $text, $domain = '' ) {
		return $text;
	}
}

if ( ! function_exists( 'esc_html' ) ) {
	function esc_html( $text ) {
		return htmlspecialchars( $text, ENT_QUOTES, 'UTF-8' );
	}
}

if ( ! function_exists( 'esc_attr' ) ) {
	function esc_attr( $text ) {
		return htmlspecialchars( $text, ENT_QUOTES, 'UTF-8' );
	}
}

if ( ! function_exists( 'esc_url' ) ) {
	function esc_url( $url ) {
		return filter_var( $url, FILTER_SANITIZE_URL );
	}
}

if ( ! function_exists( 'wp_kses_post' ) ) {
	function wp_kses_post( $data ) {
		return $data;
	}
}

if ( ! function_exists( 'wp_parse_args' ) ) {
	function wp_parse_args( $args, $defaults = [] ) {
		if ( is_object( $args ) ) {
			$r = get_object_vars( $args );
		} elseif ( is_array( $args ) ) {
			$r = &$args;
		} else {
			parse_str( $args, $r );
		}

		if ( is_array( $defaults ) ) {
			return array_merge( $defaults, $r );
		}
		return $r;
	}
}

if ( ! function_exists( 'add_action' ) ) {
	function add_action( $hook, $callback, $priority = 10, $accepted_args = 1 ) {
		return true;
	}
}

if ( ! function_exists( 'add_filter' ) ) {
	function add_filter( $hook, $callback, $priority = 10, $accepted_args = 1 ) {
		return true;
	}
}

if ( ! function_exists( 'has_action' ) ) {
	function has_action( $hook, $callback = false ) {
		return true;
	}
}

if ( ! function_exists( 'wp_enqueue_script' ) ) {
	function wp_enqueue_script( $handle, $src = '', $deps = [], $ver = false, $in_footer = false ) {
		global $wp_scripts;
		if ( ! isset( $wp_scripts ) ) {
			$wp_scripts = new stdClass();
			$wp_scripts->registered = [];
		}
	}
}

if ( ! function_exists( 'wp_enqueue_style' ) ) {
	function wp_enqueue_style( $handle, $src = '', $deps = [], $ver = false, $media = 'all' ) {
		global $wp_styles;
		if ( ! isset( $wp_styles ) ) {
			$wp_styles = new stdClass();
			$wp_styles->registered = [];
		}
	}
}

if ( ! function_exists( 'wp_register_script' ) ) {
	function wp_register_script( $handle, $src = '', $deps = [], $ver = false, $in_footer = false ) {
		global $wp_scripts;
		if ( ! isset( $wp_scripts ) ) {
			$wp_scripts = new stdClass();
			$wp_scripts->registered = [];
		}
		$wp_scripts->registered[ $handle ] = true;
	}
}

if ( ! function_exists( 'wp_register_style' ) ) {
	function wp_register_style( $handle, $src = '', $deps = [], $ver = false, $media = 'all' ) {
		global $wp_styles;
		if ( ! isset( $wp_styles ) ) {
			$wp_styles = new stdClass();
			$wp_styles->registered = [];
		}
		$wp_styles->registered[ $handle ] = true;
	}
}

if ( ! function_exists( 'get_post' ) ) {
	function get_post( $post = null ) {
		return null;
	}
}

// Mock Elementor classes
if ( ! class_exists( 'Elementor\Widget_Base' ) ) {
	class Elementor_Widget_Base {
		public function get_name() { return ''; }
		public function get_title() { return ''; }
		public function get_categories() { return []; }
		public function get_icon() { return ''; }
		public function get_keywords() { return []; }
		protected function register_controls() {}
		protected function render() {}
		public function add_responsive_control( $id, $args = [] ) {}
		public function start_controls_section( $id, $args = [] ) {}
		public function end_controls_section() {}
		public function add_control( $id, $args = [] ) {}
	}

	class_alias( 'Elementor_Widget_Base', 'Elementor\Widget_Base' );
}

if ( ! class_exists( 'Elementor\Controls_Manager' ) ) {
	class Elementor_Controls_Manager {
		const TEXT = 'text';
		const TEXTAREA = 'textarea';
		const NUMBER = 'number';
		const SELECT = 'select';
		const SWITCHER = 'switcher';
		const SLIDER = 'slider';
		const MEDIA = 'media';
		const REPEATER = 'repeater';
		const COLOR = 'color';
		const TAB_CONTENT = 'tab-content';
		const TAB_STYLE = 'tab-style';
		const TAB_ADVANCED = 'tab-advanced';
		const URL = 'url';
		const WYSIWYG = 'wysiwyg';
		const CHOOSE = 'choose';
		const DIMENSIONS = 'dimensions';
	}

	class_alias( 'Elementor_Controls_Manager', 'Elementor\Controls_Manager' );
}

// Load plugin files
$plugin_includes = dirname( __DIR__ ) . '/pagifye-elementor-widgets/includes/';
$plugin_widgets = dirname( __DIR__ ) . '/pagifye-elementor-widgets/widgets/';

// Load helper files
if ( file_exists( $plugin_includes . 'helpers/sanitization.php' ) ) {
	require_once $plugin_includes . 'helpers/sanitization.php';
}

if ( file_exists( $plugin_includes . 'helpers/utilities.php' ) ) {
	require_once $plugin_includes . 'helpers/utilities.php';
}

// Load core classes
require_once $plugin_includes . 'class-base-widget.php';
require_once $plugin_includes . 'class-assets-manager.php';
require_once $plugin_includes . 'class-widgets-loader.php';

// Load all widget files
$widget_files = glob( $plugin_widgets . 'class-*.php' );
foreach ( $widget_files as $file ) {
	require_once $file;
}
