<?php
/**
 * Plugin Name: Pagifye Elementor Widgets
 * Plugin URI: https://github.com/nadimtuhin/pagifye
 * Description: Transform beautiful Pagifye Tailwind CSS components into fully customizable Elementor widgets for WordPress. 34+ widgets across 11 categories.
 * Version: 1.0.0
 * Requires at least: 5.8
 * Requires PHP: 7.4
 * Author: Nadim Tuhin
 * Author URI: https://github.com/nadimtuhin
 * License: GPL v2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: pagifye-widgets
 * Domain Path: /languages
 * Elementor tested up to: 3.19
 * Elementor Pro tested up to: 3.19
 *
 * @package Pagifye_Elementor_Widgets
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

/**
 * Main Pagifye Elementor Widgets Class
 *
 * The main class that initiates and runs the plugin.
 *
 * @since 1.0.0
 */
final class Pagifye_Elementor_Widgets {

    /**
     * Plugin Version
     *
     * @since 1.0.0
     * @var string The plugin version.
     */
    const VERSION = '1.0.0';

    /**
     * Minimum Elementor Version
     *
     * @since 1.0.0
     * @var string Minimum Elementor version required to run the plugin.
     */
    const MINIMUM_ELEMENTOR_VERSION = '3.16.0';

    /**
     * Minimum PHP Version
     *
     * @since 1.0.0
     * @var string Minimum PHP version required to run the plugin.
     */
    const MINIMUM_PHP_VERSION = '7.4';

    /**
     * Instance
     *
     * @since 1.0.0
     * @access private
     * @static
     * @var Pagifye_Elementor_Widgets The single instance of the class.
     */
    private static $_instance = null;

    /**
     * Instance
     *
     * Ensures only one instance of the class is loaded or can be loaded.
     *
     * @since 1.0.0
     * @access public
     * @static
     * @return Pagifye_Elementor_Widgets An instance of the class.
     */
    public static function instance() {
        if (is_null(self::$_instance)) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    /**
     * Constructor
     *
     * @since 1.0.0
     * @access public
     */
    public function __construct() {
        add_action('plugins_loaded', [$this, 'init']);
    }

    /**
     * Initialize the plugin
     *
     * Load the plugin only after Elementor (and other plugins) are loaded.
     * Checks for basic plugin requirements, if one check fail don't continue,
     * if all check have passed load the files required to run the plugin.
     *
     * Fired by `plugins_loaded` action hook.
     *
     * @since 1.0.0
     * @access public
     */
    public function init() {
        // Check if Elementor installed and activated
        if (!did_action('elementor/loaded')) {
            add_action('admin_notices', [$this, 'admin_notice_missing_main_plugin']);
            return;
        }

        // Check for required Elementor version
        if (!version_compare(ELEMENTOR_VERSION, self::MINIMUM_ELEMENTOR_VERSION, '>=')) {
            add_action('admin_notices', [$this, 'admin_notice_minimum_elementor_version']);
            return;
        }

        // Check for required PHP version
        if (version_compare(PHP_VERSION, self::MINIMUM_PHP_VERSION, '<')) {
            add_action('admin_notices', [$this, 'admin_notice_minimum_php_version']);
            return;
        }

        // Add Plugin actions
        add_action('elementor/widgets/register', [$this, 'init_widgets']);
        add_action('elementor/elements/categories_registered', [$this, 'register_categories']);

        // Register Widget Styles
        add_action('elementor/frontend/after_enqueue_styles', [$this, 'widget_styles']);

        // Register Widget Scripts
        add_action('elementor/frontend/after_register_scripts', [$this, 'widget_scripts']);

        // Load textdomain
        add_action('init', [$this, 'i18n']);
    }

    /**
     * Load Textdomain
     *
     * Load plugin localization files.
     *
     * Fired by `init` action hook.
     *
     * @since 1.0.0
     * @access public
     */
    public function i18n() {
        load_plugin_textdomain('pagifye-widgets', false, dirname(plugin_basename(__FILE__)) . '/languages');
    }

    /**
     * Admin notice
     *
     * Warning when the site doesn't have Elementor installed or activated.
     *
     * @since 1.0.0
     * @access public
     */
    public function admin_notice_missing_main_plugin() {
        if (isset($_GET['activate'])) {
            unset($_GET['activate']);
        }

        $message = sprintf(
            /* translators: 1: Plugin name 2: Elementor */
            esc_html__('"%1$s" requires "%2$s" to be installed and activated.', 'pagifye-widgets'),
            '<strong>' . esc_html__('Pagifye Elementor Widgets', 'pagifye-widgets') . '</strong>',
            '<strong>' . esc_html__('Elementor', 'pagifye-widgets') . '</strong>'
        );

        printf('<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message);
    }

    /**
     * Admin notice
     *
     * Warning when the site doesn't have a minimum required Elementor version.
     *
     * @since 1.0.0
     * @access public
     */
    public function admin_notice_minimum_elementor_version() {
        if (isset($_GET['activate'])) {
            unset($_GET['activate']);
        }

        $message = sprintf(
            /* translators: 1: Plugin name 2: Elementor 3: Required Elementor version */
            esc_html__('"%1$s" requires "%2$s" version %3$s or greater.', 'pagifye-widgets'),
            '<strong>' . esc_html__('Pagifye Elementor Widgets', 'pagifye-widgets') . '</strong>',
            '<strong>' . esc_html__('Elementor', 'pagifye-widgets') . '</strong>',
            self::MINIMUM_ELEMENTOR_VERSION
        );

        printf('<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message);
    }

    /**
     * Admin notice
     *
     * Warning when the site doesn't have a minimum required PHP version.
     *
     * @since 1.0.0
     * @access public
     */
    public function admin_notice_minimum_php_version() {
        if (isset($_GET['activate'])) {
            unset($_GET['activate']);
        }

        $message = sprintf(
            /* translators: 1: Plugin name 2: PHP 3: Required PHP version */
            esc_html__('"%1$s" requires "%2$s" version %3$s or greater.', 'pagifye-widgets'),
            '<strong>' . esc_html__('Pagifye Elementor Widgets', 'pagifye-widgets') . '</strong>',
            '<strong>' . esc_html__('PHP', 'pagifye-widgets') . '</strong>',
            self::MINIMUM_PHP_VERSION
        );

        printf('<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message);
    }

    /**
     * Initialize Widgets
     *
     * Include widgets files and register them
     *
     * @since 1.0.0
     * @access public
     */
    public function init_widgets() {
        // TODO: Include widget files here
        // Example:
        // require_once(__DIR__ . '/widgets/hero/class-hero-01.php');
        // \Elementor\Plugin::instance()->widgets_manager->register(new \Pagifye_Hero_01());

        // Widget files will be loaded here once they are created
    }

    /**
     * Register Widget Categories
     *
     * Register new Elementor widget categories.
     *
     * @since 1.0.0
     * @access public
     */
    public function register_categories($elements_manager) {
        $elements_manager->add_category(
            'pagifye-widgets',
            [
                'title' => esc_html__('Pagifye Components', 'pagifye-widgets'),
                'icon' => 'fa fa-plug',
            ]
        );
    }

    /**
     * Enqueue Styles
     *
     * Load required plugin frontend stylesheets.
     *
     * @since 1.0.0
     * @access public
     */
    public function widget_styles() {
        wp_register_style(
            'pagifye-widgets',
            plugins_url('assets/css/pagifye-widgets.css', __FILE__),
            [],
            self::VERSION
        );
        wp_enqueue_style('pagifye-widgets');
    }

    /**
     * Enqueue Scripts
     *
     * Load required plugin frontend scripts.
     *
     * @since 1.0.0
     * @access public
     */
    public function widget_scripts() {
        wp_register_script(
            'pagifye-widgets',
            plugins_url('assets/js/pagifye-widgets.js', __FILE__),
            ['jquery'],
            self::VERSION,
            true
        );
        wp_enqueue_script('pagifye-widgets');
    }
}

/**
 * Initialize Pagifye Elementor Widgets
 *
 * Main instance of the plugin.
 *
 * @since 1.0.0
 * @return Pagifye_Elementor_Widgets
 */
function pagifye_elementor_widgets() {
    return Pagifye_Elementor_Widgets::instance();
}

// Kick off the plugin
pagifye_elementor_widgets();
