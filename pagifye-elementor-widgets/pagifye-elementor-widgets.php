<?php
/**
 * Plugin Name: Pagifye Elementor Widgets
 * Plugin URI: https://github.com/yourusername/pagifye-elementor-widgets
 * Description: Transform beautiful Pagifye Tailwind CSS components into fully customizable Elementor widgets.
 * Version: 1.0.0
 * Author: Your Name
 * Author URI: https://yourwebsite.com
 * License: GPL v2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: pagifye-elementor-widgets
 * Domain Path: /languages
 * Requires at least: 5.8
 * Requires PHP: 7.4
 * Elementor tested up to: 3.19
 * Elementor Pro tested up to: 3.19
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Plugin constants
 */
define( 'PAGIFYE_WIDGETS_VERSION', '1.0.0' );
define( 'PAGIFYE_WIDGETS_FILE', __FILE__ );
define( 'PAGIFYE_WIDGETS_PATH', plugin_dir_path( __FILE__ ) );
define( 'PAGIFYE_WIDGETS_URL', plugin_dir_url( __FILE__ ) );
define( 'PAGIFYE_WIDGETS_ASSETS_URL', PAGIFYE_WIDGETS_URL . 'build/' );

/**
 * Minimum requirements
 */
define( 'PAGIFYE_WIDGETS_MINIMUM_PHP_VERSION', '7.4' );
define( 'PAGIFYE_WIDGETS_MINIMUM_WP_VERSION', '5.8' );
define( 'PAGIFYE_WIDGETS_MINIMUM_ELEMENTOR_VERSION', '3.16.0' );

/**
 * Load Composer autoloader
 */
if ( file_exists( PAGIFYE_WIDGETS_PATH . 'vendor/autoload.php' ) ) {
	require_once PAGIFYE_WIDGETS_PATH . 'vendor/autoload.php';
}

/**
 * Main Plugin Class
 */
final class Pagifye_Elementor_Widgets {

	/**
	 * Plugin instance
	 *
	 * @var Pagifye_Elementor_Widgets
	 */
	private static $_instance = null;

	/**
	 * Get plugin instance
	 *
	 * @return Pagifye_Elementor_Widgets
	 */
	public static function instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}

	/**
	 * Constructor
	 */
	private function __construct() {
		add_action( 'plugins_loaded', [ $this, 'init' ] );
	}

	/**
	 * Initialize plugin
	 */
	public function init() {
		// Check if Elementor is installed and activated
		if ( ! did_action( 'elementor/loaded' ) ) {
			add_action( 'admin_notices', [ $this, 'admin_notice_missing_elementor' ] );
			return;
		}

		// Check minimum Elementor version
		if ( ! version_compare( ELEMENTOR_VERSION, PAGIFYE_WIDGETS_MINIMUM_ELEMENTOR_VERSION, '>=' ) ) {
			add_action( 'admin_notices', [ $this, 'admin_notice_minimum_elementor_version' ] );
			return;
		}

		// Check minimum PHP version
		if ( version_compare( PHP_VERSION, PAGIFYE_WIDGETS_MINIMUM_PHP_VERSION, '<' ) ) {
			add_action( 'admin_notices', [ $this, 'admin_notice_minimum_php_version' ] );
			return;
		}

		// Load plugin functionality
		$this->load_plugin();
	}

	/**
	 * Load plugin functionality
	 */
	private function load_plugin() {
		// Load text domain
		add_action( 'init', [ $this, 'load_textdomain' ] );

		// Register Elementor widget category
		add_action( 'elementor/elements/categories_registered', [ $this, 'register_widget_category' ] );

		// Initialize assets manager
		new \Pagifye\ElementorWidgets\Assets_Manager();

		// Initialize widgets loader
		new \Pagifye\ElementorWidgets\Widgets_Loader();
	}

	/**
	 * Load plugin text domain
	 */
	public function load_textdomain() {
		load_plugin_textdomain(
			'pagifye-elementor-widgets',
			false,
			dirname( plugin_basename( __FILE__ ) ) . '/languages'
		);
	}

	/**
	 * Register widget category
	 *
	 * @param \Elementor\Elements_Manager $elements_manager
	 */
	public function register_widget_category( $elements_manager ) {
		$elements_manager->add_category(
			'pagifye-widgets',
			[
				'title' => esc_html__( 'Pagifye Components', 'pagifye-elementor-widgets' ),
				'icon' => 'fa fa-plug',
			]
		);
	}

	/**
	 * Admin notice - Missing Elementor
	 */
	public function admin_notice_missing_elementor() {
		$message = sprintf(
			/* translators: 1: Plugin name 2: Elementor */
			esc_html__( '"%1$s" requires "%2$s" to be installed and activated.', 'pagifye-elementor-widgets' ),
			'<strong>' . esc_html__( 'Pagifye Elementor Widgets', 'pagifye-elementor-widgets' ) . '</strong>',
			'<strong>' . esc_html__( 'Elementor', 'pagifye-elementor-widgets' ) . '</strong>'
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', wp_kses_post( $message ) );
	}

	/**
	 * Admin notice - Minimum Elementor version
	 */
	public function admin_notice_minimum_elementor_version() {
		$message = sprintf(
			/* translators: 1: Plugin name 2: Elementor 3: Required Elementor version */
			esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'pagifye-elementor-widgets' ),
			'<strong>' . esc_html__( 'Pagifye Elementor Widgets', 'pagifye-elementor-widgets' ) . '</strong>',
			'<strong>' . esc_html__( 'Elementor', 'pagifye-elementor-widgets' ) . '</strong>',
			PAGIFYE_WIDGETS_MINIMUM_ELEMENTOR_VERSION
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', wp_kses_post( $message ) );
	}

	/**
	 * Admin notice - Minimum PHP version
	 */
	public function admin_notice_minimum_php_version() {
		$message = sprintf(
			/* translators: 1: Plugin name 2: PHP 3: Required PHP version */
			esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'pagifye-elementor-widgets' ),
			'<strong>' . esc_html__( 'Pagifye Elementor Widgets', 'pagifye-elementor-widgets' ) . '</strong>',
			'<strong>' . esc_html__( 'PHP', 'pagifye-elementor-widgets' ) . '</strong>',
			PAGIFYE_WIDGETS_MINIMUM_PHP_VERSION
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', wp_kses_post( $message ) );
	}
}

/**
 * Initialize plugin
 */
function pagifye_elementor_widgets() {
	return Pagifye_Elementor_Widgets::instance();
}

// Kick off the plugin
pagifye_elementor_widgets();
