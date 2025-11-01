<?php
/**
 * Sanitization Helper Functions
 *
 * @package Pagifye_Elementor_Widgets
 */

namespace Pagifye\ElementorWidgets\Helpers;

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Sanitize HTML class names
 *
 * @param string|array $classes
 * @return string
 */
function sanitize_html_classes( $classes ) {
	if ( is_array( $classes ) ) {
		$classes = implode( ' ', $classes );
	}

	return sanitize_html_class( $classes );
}

/**
 * Sanitize SVG output
 *
 * @param string $svg
 * @return string
 */
function sanitize_svg( $svg ) {
	return wp_kses(
		$svg,
		[
			'svg'  => [
				'class'           => true,
				'aria-hidden'     => true,
				'aria-labelledby' => true,
				'role'            => true,
				'xmlns'           => true,
				'width'           => true,
				'height'          => true,
				'viewbox'         => true,
				'fill'            => true,
				'stroke'          => true,
			],
			'g'    => [ 'fill' => true ],
			'path' => [
				'd'               => true,
				'fill'            => true,
				'stroke'          => true,
				'stroke-width'    => true,
				'stroke-linecap'  => true,
				'stroke-linejoin' => true,
			],
		]
	);
}
