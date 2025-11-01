<?php
/**
 * Base Widget Class
 *
 * All Pagifye widgets extend this base class.
 * Provides common functionality, helper methods, and standard controls.
 *
 * @package Pagifye_Elementor_Widgets
 */

namespace Pagifye\ElementorWidgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Core\Kits\Documents\Tabs\Global_Colors;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Base Widget Class
 */
abstract class Base_Widget extends Widget_Base {

	/**
	 * Get widget categories
	 *
	 * @return array
	 */
	public function get_categories() {
		return [ 'pagifye-widgets' ];
	}

	/**
	 * Get widget icon
	 *
	 * @return string
	 */
	public function get_icon() {
		return 'eicon-plug';
	}

	/**
	 * Get widget keywords for search
	 *
	 * @return array
	 */
	public function get_keywords() {
		return [ 'pagifye', 'tailwind', 'component' ];
	}

	/**
	 * Register common responsive controls
	 *
	 * @param string $prefix Control ID prefix
	 * @param string $label Control label
	 * @param string $selector CSS selector
	 * @param array  $options Control options
	 */
	protected function add_responsive_control_custom( $prefix, $label, $selector, $options = [] ) {
		$defaults = [
			'type'       => Controls_Manager::SLIDER,
			'size_units' => [ 'px', 'em', 'rem', '%' ],
			'range'      => [
				'px' => [
					'min' => 0,
					'max' => 1000,
				],
			],
		];

		$options = wp_parse_args( $options, $defaults );

		$this->add_responsive_control(
			$prefix,
			array_merge(
				[
					'label'     => $label,
					'selectors' => [ $selector => $options['property'] . ': {{SIZE}}{{UNIT}};' ],
				],
				$options
			)
		);
	}

	/**
	 * Add section heading controls
	 *
	 * Used by many widgets (Hero, Pricing, FAQ, Testimonial)
	 */
	protected function add_section_heading_controls() {
		$this->start_controls_section(
			'section_heading',
			[
				'label' => esc_html__( 'Section Heading', 'pagifye-elementor-widgets' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'show_heading',
			[
				'label'        => esc_html__( 'Show Heading', 'pagifye-elementor-widgets' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Show', 'pagifye-elementor-widgets' ),
				'label_off'    => esc_html__( 'Hide', 'pagifye-elementor-widgets' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			]
		);

		$this->add_control(
			'heading_text',
			[
				'label'       => esc_html__( 'Heading', 'pagifye-elementor-widgets' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => esc_html__( 'Section Heading', 'pagifye-elementor-widgets' ),
				'placeholder' => esc_html__( 'Enter heading', 'pagifye-elementor-widgets' ),
				'dynamic'     => [
					'active' => true,
				],
				'condition'   => [
					'show_heading' => 'yes',
				],
			]
		);

		$this->add_control(
			'heading_highlight_text',
			[
				'label'       => esc_html__( 'Highlighted Text', 'pagifye-elementor-widgets' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => '',
				'placeholder' => esc_html__( 'Text to highlight', 'pagifye-elementor-widgets' ),
				'description' => esc_html__( 'This text will be highlighted with the primary color', 'pagifye-elementor-widgets' ),
				'condition'   => [
					'show_heading' => 'yes',
				],
			]
		);

		$this->add_control(
			'heading_tag',
			[
				'label'     => esc_html__( 'HTML Tag', 'pagifye-elementor-widgets' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'h2',
				'options'   => [
					'h1' => 'H1',
					'h2' => 'H2',
					'h3' => 'H3',
					'h4' => 'H4',
					'h5' => 'H5',
					'h6' => 'H6',
				],
				'condition' => [
					'show_heading' => 'yes',
				],
			]
		);

		$this->add_control(
			'description_text',
			[
				'label'       => esc_html__( 'Description', 'pagifye-elementor-widgets' ),
				'type'        => Controls_Manager::TEXTAREA,
				'default'     => '',
				'placeholder' => esc_html__( 'Enter description', 'pagifye-elementor-widgets' ),
				'rows'        => 4,
				'dynamic'     => [
					'active' => true,
				],
			]
		);

		$this->end_controls_section();
	}

	/**
	 * Add heading style controls
	 */
	protected function add_heading_style_controls() {
		$this->start_controls_section(
			'section_heading_style',
			[
				'label'     => esc_html__( 'Heading', 'pagifye-elementor-widgets' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'show_heading' => 'yes',
				],
			]
		);

		$this->add_control(
			'heading_color',
			[
				'label'     => esc_html__( 'Color', 'pagifye-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#0F2C24',
				'selectors' => [
					'{{WRAPPER}} .pgfy-section-heading' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'heading_highlight_color',
			[
				'label'     => esc_html__( 'Highlight Color', 'pagifye-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#8FE35F',
				'selectors' => [
					'{{WRAPPER}} .pgfy-text-highlight' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'heading_typography',
				'selector' => '{{WRAPPER}} .pgfy-section-heading',
				'global'   => [
					'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
				],
			]
		);

		$this->add_responsive_control(
			'heading_spacing',
			[
				'label'      => esc_html__( 'Bottom Spacing', 'pagifye-elementor-widgets' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em', 'rem' ],
				'range'      => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default'    => [
					'size' => 16,
					'unit' => 'px',
				],
				'selectors'  => [
					'{{WRAPPER}} .pgfy-section-heading' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'heading_alignment',
			[
				'label'     => esc_html__( 'Alignment', 'pagifye-elementor-widgets' ),
				'type'      => Controls_Manager::CHOOSE,
				'options'   => [
					'left'   => [
						'title' => esc_html__( 'Left', 'pagifye-elementor-widgets' ),
						'icon'  => 'eicon-text-align-left',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'pagifye-elementor-widgets' ),
						'icon'  => 'eicon-text-align-center',
					],
					'right'  => [
						'title' => esc_html__( 'Right', 'pagifye-elementor-widgets' ),
						'icon'  => 'eicon-text-align-right',
					],
				],
				'default'   => 'left',
				'selectors' => [
					'{{WRAPPER}} .pgfy-section-heading' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();
	}

	/**
	 * Add description style controls
	 */
	protected function add_description_style_controls() {
		$this->start_controls_section(
			'section_description_style',
			[
				'label' => esc_html__( 'Description', 'pagifye-elementor-widgets' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'description_color',
			[
				'label'     => esc_html__( 'Color', 'pagifye-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#1A2E27',
				'selectors' => [
					'{{WRAPPER}} .pgfy-section-description' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'description_typography',
				'selector' => '{{WRAPPER}} .pgfy-section-description',
				'global'   => [
					'default' => Global_Typography::TYPOGRAPHY_TEXT,
				],
			]
		);

		$this->add_responsive_control(
			'description_spacing',
			[
				'label'      => esc_html__( 'Bottom Spacing', 'pagifye-elementor-widgets' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em', 'rem' ],
				'range'      => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default'    => [
					'size' => 24,
					'unit' => 'px',
				],
				'selectors'  => [
					'{{WRAPPER}} .pgfy-section-description' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
	}

	/**
	 * Render section heading (used by multiple widgets)
	 *
	 * @param array $settings Widget settings
	 */
	protected function render_section_heading( $settings ) {
		if ( 'yes' !== $settings['show_heading'] ) {
			return;
		}

		$heading_text = $settings['heading_text'];
		$highlight    = $settings['heading_highlight_text'];

		// Replace highlight text with span
		if ( ! empty( $highlight ) && strpos( $heading_text, $highlight ) !== false ) {
			$heading_text = str_replace(
				$highlight,
				'<span class="pgfy-text-highlight">' . esc_html( $highlight ) . '</span>',
				$heading_text
			);
		} else {
			$heading_text = esc_html( $heading_text );
		}

		printf(
			'<%1$s class="pgfy-section-heading pgfy-heading-lg">%2$s</%1$s>',
			tag_escape( $settings['heading_tag'] ),
			wp_kses_post( $heading_text )
		);

		if ( ! empty( $settings['description_text'] ) ) {
			printf(
				'<p class="pgfy-section-description">%s</p>',
				esc_html( $settings['description_text'] )
			);
		}
	}

	/**
	 * Sanitize HTML class
	 *
	 * @param string $class
	 * @return string
	 */
	protected function sanitize_html_class( $class ) {
		return sanitize_html_class( $class );
	}

	/**
	 * Get button classes based on style
	 *
	 * @param string $style Button style (primary, secondary, outline)
	 * @return string
	 */
	protected function get_button_classes( $style = 'primary' ) {
		$classes = 'pgfy-btn';

		switch ( $style ) {
			case 'primary':
				$classes .= ' pgfy-btn-primary';
				break;
			case 'secondary':
				$classes .= ' pgfy-btn-secondary';
				break;
			case 'outline':
				$classes .= ' pgfy-btn-outline';
				break;
		}

		return $classes;
	}

	/**
	 * Render button
	 *
	 * @param array $button_settings Button settings
	 * @param array $additional_classes Additional CSS classes
	 */
	protected function render_button( $button_settings, $additional_classes = [] ) {
		if ( empty( $button_settings['text'] ) ) {
			return;
		}

		$classes   = [ $this->get_button_classes( $button_settings['style'] ) ];
		$classes   = array_merge( $classes, $additional_classes );
		$class_str = implode( ' ', $classes );

		$this->add_link_attributes( 'button', $button_settings['link'] );

		printf(
			'<a %1$s class="%2$s">%3$s</a>',
			$this->get_render_attribute_string( 'button' ),
			esc_attr( $class_str ),
			esc_html( $button_settings['text'] )
		);
	}

	/**
	 * Check if we're in edit mode
	 *
	 * @return bool
	 */
	protected function is_edit_mode() {
		return \Elementor\Plugin::$instance->editor->is_edit_mode();
	}
}
