<?php
/**
 * Utility Helper Functions
 *
 * @package Pagifye_Elementor_Widgets
 */

namespace Pagifye\ElementorWidgets\Helpers;

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Check if Elementor is in edit mode
 *
 * @return bool
 */
function is_edit_mode() {
	return \Elementor\Plugin::$instance->editor->is_edit_mode();
}

/**
 * Check if Elementor preview mode
 *
 * @return bool
 */
function is_preview_mode() {
	return \Elementor\Plugin::$instance->preview->is_preview_mode();
}

/**
 * Get Pagifye icon SVG
 *
 * @param string $icon Icon name
 * @return string
 */
function get_icon_svg( $icon ) {
	$icons = [
		'chevron-down' => '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>',
		'menu'         => '<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>',
		'close'        => '<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>',
		'check'        => '<svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path></svg>',
	];

	return $icons[ $icon ] ?? '';
}
