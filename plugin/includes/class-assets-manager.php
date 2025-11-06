<?php
/**
 * Assets Manager
 *
 * Handles enqueuing of CSS and JavaScript assets for widgets.
 * Only loads assets when widgets are actually used on the page.
 *
 * @package Pagifye_Elementor_Widgets
 */

namespace Pagifye\ElementorWidgets;

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Assets Manager Class
 */
class Assets_Manager {

    /**
     * Track which widgets are used on the page
     *
     * @var array
     */
    private static $widgets_in_use = [];

    /**
     * Initialize the assets manager
     */
    public function __construct() {
        // Frontend assets
        add_action( 'wp_enqueue_scripts', [ $this, 'register_assets' ] );
        add_action( 'wp_footer', [ $this, 'enqueue_widget_assets' ], 5 );

        // Editor assets
        add_action( 'elementor/editor/before_enqueue_scripts', [ $this, 'enqueue_editor_assets' ] );
        add_action( 'elementor/preview/enqueue_styles', [ $this, 'enqueue_preview_assets' ] );
    }

    /**
     * Register all assets (doesn't enqueue them yet)
     */
    public function register_assets() {
        // Get asset URLs
        $css_url = $this->get_asset_url( 'css/pagifye-widgets.min.css' );
        $js_url  = $this->get_asset_url( 'js/pagifye-widgets.min.js' );

        // Development mode - use unminified files
        if ( defined( 'WP_DEBUG' ) && WP_DEBUG ) {
            $css_url = $this->get_asset_url( 'css/pagifye-widgets.css' );
            $js_url  = $this->get_asset_url( 'js/pagifye-widgets.js' );
        }

        // Register styles
        wp_register_style(
            'pagifye-widgets',
            $css_url,
            [],
            PAGIFYE_WIDGETS_VERSION
        );

        // Register scripts
        wp_register_script(
            'pagifye-widgets',
            $js_url,
            [],
            PAGIFYE_WIDGETS_VERSION,
            true
        );

        // Add Alpine.js defer attribute
        add_filter( 'script_loader_tag', [ $this, 'add_defer_attribute' ], 10, 2 );
    }

    /**
     * Enqueue widget assets if any Pagifye widgets are used
     */
    public function enqueue_widget_assets() {
        // Check if we're in Elementor edit mode
        if ( \Elementor\Plugin::$instance->preview->is_preview_mode() ) {
            wp_enqueue_style( 'pagifye-widgets' );
            wp_enqueue_script( 'pagifye-widgets' );
            return;
        }

        // Check if any Pagifye widgets are used on this page
        if ( $this->has_pagifye_widgets() ) {
            wp_enqueue_style( 'pagifye-widgets' );
            wp_enqueue_script( 'pagifye-widgets' );
        }
    }

    /**
     * Enqueue editor assets
     */
    public function enqueue_editor_assets() {
        // Editor-specific CSS
        wp_enqueue_style(
            'pagifye-widgets-editor',
            PAGIFYE_WIDGETS_URL . 'assets/css/admin/editor.css',
            [],
            PAGIFYE_WIDGETS_VERSION
        );

        // Editor-specific JS
        wp_enqueue_script(
            'pagifye-widgets-editor',
            PAGIFYE_WIDGETS_URL . 'assets/js/admin/editor.js',
            [ 'jquery' ],
            PAGIFYE_WIDGETS_VERSION,
            true
        );
    }

    /**
     * Enqueue preview assets
     */
    public function enqueue_preview_assets() {
        wp_enqueue_style( 'pagifye-widgets' );
        wp_enqueue_script( 'pagifye-widgets' );
    }

    /**
     * Check if page has any Pagifye widgets
     *
     * @return bool
     */
    private function has_pagifye_widgets() {
        // Get current post
        $post = get_post();

        if ( ! $post ) {
            return false;
        }

        // Check if Elementor is used on this page
        if ( ! \Elementor\Plugin::$instance->documents->get( $post->ID ) ) {
            return false;
        }

        // Get Elementor data
        $document = \Elementor\Plugin::$instance->documents->get( $post->ID );
        $elements = $document->get_elements_data();

        // Check if any element is a Pagifye widget
        return $this->search_widgets_in_elements( $elements );
    }

    /**
     * Recursively search for Pagifye widgets in elements
     *
     * @param array $elements
     * @return bool
     */
    private function search_widgets_in_elements( $elements ) {
        foreach ( $elements as $element ) {
            // Check if this is a Pagifye widget
            if ( isset( $element['widgetType'] ) && strpos( $element['widgetType'], 'pagifye-' ) === 0 ) {
                return true;
            }

            // Check nested elements (sections, columns)
            if ( ! empty( $element['elements'] ) ) {
                if ( $this->search_widgets_in_elements( $element['elements'] ) ) {
                    return true;
                }
            }
        }

        return false;
    }

    /**
     * Get asset URL
     *
     * @param string $path
     * @return string
     */
    private function get_asset_url( $path ) {
        return PAGIFYE_WIDGETS_ASSETS_URL . $path;
    }

    /**
     * Add defer attribute to Alpine.js script
     *
     * @param string $tag
     * @param string $handle
     * @return string
     */
    public function add_defer_attribute( $tag, $handle ) {
        if ( 'pagifye-widgets' === $handle ) {
            return str_replace( ' src', ' defer src', $tag );
        }
        return $tag;
    }

    /**
     * Mark a widget as being used on the page
     *
     * @param string $widget_name
     */
    public static function mark_widget_used( $widget_name ) {
        self::$widgets_in_use[] = $widget_name;
    }

    /**
     * Get widgets used on the page
     *
     * @return array
     */
    public static function get_widgets_in_use() {
        return self::$widgets_in_use;
    }
}
