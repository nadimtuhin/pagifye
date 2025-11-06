<?php
/**
 * Pricing-01 Widget
 *
 * Pricing table section with billing toggle and pricing cards grid.
 *
 * @package Pagifye_Elementor_Widgets
 */

namespace Pagifye\ElementorWidgets\Widgets;

use Pagifye\ElementorWidgets\Base_Widget;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Repeater;

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Pricing-01 Widget Class
 */
class Pricing_01 extends Base_Widget {

	/**
	 * Get widget name
	 */
	public function get_name() {
		return 'pagifye-pricing-01';
	}

	/**
	 * Get widget title
	 */
	public function get_title() {
		return esc_html__( 'Pricing 01', 'pagifye-elementor-widgets' );
	}

	/**
	 * Get widget icon
	 */
	public function get_icon() {
		return 'eicon-price-table';
	}

	/**
	 * Get widget keywords
	 */
	public function get_keywords() {
		return [ 'pagifye', 'pricing', 'price', 'table', 'plans', 'billing' ];
	}

	/**
	 * Register widget controls
	 */
	protected function register_controls() {
		$this->register_content_controls();
		$this->register_style_controls();
	}

	/**
	 * Register content controls
	 */
	private function register_content_controls() {
		// Section Heading
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
			'heading_parts',
			[
				'label'       => esc_html__( 'Heading Text', 'pagifye-elementor-widgets' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => esc_html__( 'Plans for {customer-first} business of all sizes', 'pagifye-elementor-widgets' ),
				'description' => esc_html__( 'Use {curly braces} around text to highlight it', 'pagifye-elementor-widgets' ),
				'label_block' => true,
				'dynamic'     => [ 'active' => true ],
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
				'options'   => [
					'h1' => 'H1',
					'h2' => 'H2',
					'h3' => 'H3',
					'h4' => 'H4',
					'h5' => 'H5',
					'h6' => 'H6',
				],
				'default'   => 'h2',
				'condition' => [
					'show_heading' => 'yes',
				],
			]
		);

		$this->end_controls_section();

		// Billing Toggle
		$this->start_controls_section(
			'section_billing',
			[
				'label' => esc_html__( 'Billing Toggle', 'pagifye-elementor-widgets' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'show_billing_toggle',
			[
				'label'        => esc_html__( 'Show Billing Toggle', 'pagifye-elementor-widgets' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Show', 'pagifye-elementor-widgets' ),
				'label_off'    => esc_html__( 'Hide', 'pagifye-elementor-widgets' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			]
		);

		$this->add_control(
			'monthly_label',
			[
				'label'       => esc_html__( 'Monthly Label', 'pagifye-elementor-widgets' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => esc_html__( 'Bill Monthly', 'pagifye-elementor-widgets' ),
				'label_block' => true,
				'condition'   => [
					'show_billing_toggle' => 'yes',
				],
			]
		);

		$this->add_control(
			'annually_label',
			[
				'label'       => esc_html__( 'Annually Label', 'pagifye-elementor-widgets' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => esc_html__( 'Bill Annually', 'pagifye-elementor-widgets' ),
				'label_block' => true,
				'condition'   => [
					'show_billing_toggle' => 'yes',
				],
			]
		);

		$this->add_control(
			'default_billing',
			[
				'label'     => esc_html__( 'Default Billing Period', 'pagifye-elementor-widgets' ),
				'type'      => Controls_Manager::SELECT,
				'options'   => [
					'monthly'  => esc_html__( 'Monthly', 'pagifye-elementor-widgets' ),
					'annually' => esc_html__( 'Annually', 'pagifye-elementor-widgets' ),
				],
				'default'   => 'annually',
				'condition' => [
					'show_billing_toggle' => 'yes',
				],
			]
		);

		$this->end_controls_section();

		// Pricing Cards
		$this->start_controls_section(
			'section_pricing_cards',
			[
				'label' => esc_html__( 'Pricing Cards', 'pagifye-elementor-widgets' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'plan_name',
			[
				'label'       => esc_html__( 'Plan Name', 'pagifye-elementor-widgets' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => esc_html__( 'Starter', 'pagifye-elementor-widgets' ),
				'label_block' => true,
			]
		);

		$repeater->add_control(
			'monthly_price',
			[
				'label'       => esc_html__( 'Monthly Price', 'pagifye-elementor-widgets' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => '$19',
				'label_block' => true,
			]
		);

		$repeater->add_control(
			'annual_price',
			[
				'label'       => esc_html__( 'Annual Price', 'pagifye-elementor-widgets' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => '$15',
				'label_block' => true,
			]
		);

		$repeater->add_control(
			'price_period',
			[
				'label'   => esc_html__( 'Price Period', 'pagifye-elementor-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => '/month',
			]
		);

		$repeater->add_control(
			'billing_description',
			[
				'label'       => esc_html__( 'Billing Description', 'pagifye-elementor-widgets' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => esc_html__( 'Billed annually, up to 5 seats', 'pagifye-elementor-widgets' ),
				'label_block' => true,
			]
		);

		$repeater->add_control(
			'features',
			[
				'label'       => esc_html__( 'Features Description', 'pagifye-elementor-widgets' ),
				'type'        => Controls_Manager::TEXTAREA,
				'default'     => esc_html__( 'Maximise reviews impact with tools to drive SEO', 'pagifye-elementor-widgets' ),
				'rows'        => 3,
			]
		);

		$repeater->add_control(
			'button_text',
			[
				'label'   => esc_html__( 'Button Text', 'pagifye-elementor-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => esc_html__( 'Try for free', 'pagifye-elementor-widgets' ),
			]
		);

		$repeater->add_control(
			'button_link',
			[
				'label'       => esc_html__( 'Button Link', 'pagifye-elementor-widgets' ),
				'type'        => Controls_Manager::URL,
				'placeholder' => esc_html__( 'https://example.com', 'pagifye-elementor-widgets' ),
				'default'     => [
					'url' => '#',
				],
			]
		);

		$repeater->add_control(
			'is_featured',
			[
				'label'        => esc_html__( 'Featured Plan', 'pagifye-elementor-widgets' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Yes', 'pagifye-elementor-widgets' ),
				'label_off'    => esc_html__( 'No', 'pagifye-elementor-widgets' ),
				'return_value' => 'yes',
				'default'      => '',
			]
		);

		$repeater->add_control(
			'badge_text',
			[
				'label'     => esc_html__( 'Badge Text', 'pagifye-elementor-widgets' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => esc_html__( '20% OFF', 'pagifye-elementor-widgets' ),
				'condition' => [
					'is_featured' => 'yes',
				],
			]
		);

		$this->add_control(
			'pricing_cards',
			[
				'label'       => esc_html__( 'Pricing Cards', 'pagifye-elementor-widgets' ),
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'default'     => [
					[
						'plan_name'     => esc_html__( 'Starter', 'pagifye-elementor-widgets' ),
						'monthly_price' => 'Free',
						'annual_price'  => 'Free',
						'is_featured'   => '',
					],
					[
						'plan_name'     => esc_html__( 'Growth', 'pagifye-elementor-widgets' ),
						'monthly_price' => '$19',
						'annual_price'  => '$15',
						'is_featured'   => '',
					],
					[
						'plan_name'     => esc_html__( 'Scale', 'pagifye-elementor-widgets' ),
						'monthly_price' => '$49',
						'annual_price'  => '$39',
						'is_featured'   => 'yes',
						'badge_text'    => '20% OFF',
					],
					[
						'plan_name'     => esc_html__( 'Premier', 'pagifye-elementor-widgets' ),
						'monthly_price' => '$99',
						'annual_price'  => '$79',
						'is_featured'   => '',
					],
				],
				'title_field' => '{{{ plan_name }}}',
			]
		);

		$this->add_responsive_control(
			'columns',
			[
				'label'          => esc_html__( 'Columns', 'pagifye-elementor-widgets' ),
				'type'           => Controls_Manager::SELECT,
				'default'        => '4',
				'tablet_default' => '2',
				'mobile_default' => '1',
				'options'        => [
					'1' => '1',
					'2' => '2',
					'3' => '3',
					'4' => '4',
				],
			]
		);

		$this->end_controls_section();
	}

	/**
	 * Register style controls
	 */
	private function register_style_controls() {
		// Section Style
		$this->start_controls_section(
			'section_style',
			[
				'label' => esc_html__( 'Section', 'pagifye-elementor-widgets' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'     => 'section_background',
				'types'    => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .pgfy-pricing-section',
				'fields_options' => [
					'background' => [
						'default' => 'classic',
					],
					'color' => [
						'default' => '#0F2C24',
					],
				],
			]
		);

		$this->add_responsive_control(
			'section_padding',
			[
				'label'      => esc_html__( 'Padding', 'pagifye-elementor-widgets' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'rem' ],
				'default'    => [
					'top'      => '40',
					'right'    => '0',
					'bottom'   => '40',
					'left'     => '0',
					'unit'     => 'px',
					'isLinked' => false,
				],
				'selectors'  => [
					'{{WRAPPER}} .pgfy-pricing-section' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		// Heading Style
		$this->start_controls_section(
			'heading_style',
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
				'default'   => '#FFFFFF',
				'selectors' => [
					'{{WRAPPER}} .pgfy-pricing-heading' => 'color: {{VALUE}};',
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
					'{{WRAPPER}} .pgfy-pricing-heading-highlight' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'heading_typography',
				'selector' => '{{WRAPPER}} .pgfy-pricing-heading',
			]
		);

		$this->end_controls_section();

		// Billing Toggle Style
		$this->start_controls_section(
			'toggle_style',
			[
				'label'     => esc_html__( 'Billing Toggle', 'pagifye-elementor-widgets' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'show_billing_toggle' => 'yes',
				],
			]
		);

		$this->add_control(
			'toggle_bg',
			[
				'label'     => esc_html__( 'Background Color', 'pagifye-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#1A2E27',
				'selectors' => [
					'{{WRAPPER}} .pgfy-pricing-toggle' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->start_controls_tabs( 'toggle_tabs' );

		$this->start_controls_tab(
			'toggle_inactive',
			[
				'label' => esc_html__( 'Inactive', 'pagifye-elementor-widgets' ),
			]
		);

		$this->add_control(
			'toggle_inactive_color',
			[
				'label'     => esc_html__( 'Text Color', 'pagifye-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#FFFFFF',
				'selectors' => [
					'{{WRAPPER}} .pgfy-pricing-toggle-btn' => 'color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'toggle_active',
			[
				'label' => esc_html__( 'Active', 'pagifye-elementor-widgets' ),
			]
		);

		$this->add_control(
			'toggle_active_bg',
			[
				'label'     => esc_html__( 'Background Color', 'pagifye-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#8FE35F',
				'selectors' => [
					'{{WRAPPER}} .pgfy-pricing-toggle-btn.active' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'toggle_active_color',
			[
				'label'     => esc_html__( 'Text Color', 'pagifye-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#0F2C24',
				'selectors' => [
					'{{WRAPPER}} .pgfy-pricing-toggle-btn.active' => 'color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

		// Pricing Card Style
		$this->start_controls_section(
			'card_style',
			[
				'label' => esc_html__( 'Pricing Card', 'pagifye-elementor-widgets' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'     => 'card_background',
				'types'    => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .pgfy-pricing-card',
				'fields_options' => [
					'background' => [
						'default' => 'classic',
					],
					'color' => [
						'default' => '#0F2C24',
					],
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'card_border',
				'selector' => '{{WRAPPER}} .pgfy-pricing-card',
				'fields_options' => [
					'border' => [
						'default' => 'solid',
					],
					'width' => [
						'default' => [
							'top'      => '3',
							'right'    => '3',
							'bottom'   => '3',
							'left'     => '3',
							'unit'     => 'px',
							'isLinked' => true,
						],
					],
					'color' => [
						'default' => 'rgba(255,255,255,0.1)',
					],
				],
			]
		);

		$this->add_control(
			'featured_border_color',
			[
				'label'     => esc_html__( 'Featured Border Color', 'pagifye-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#8FE35F',
				'selectors' => [
					'{{WRAPPER}} .pgfy-pricing-card.featured' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'card_border_radius',
			[
				'label'      => esc_html__( 'Border Radius', 'pagifye-elementor-widgets' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'default'    => [
					'top'      => '16',
					'right'    => '16',
					'bottom'   => '16',
					'left'     => '16',
					'unit'     => 'px',
					'isLinked' => true,
				],
				'selectors'  => [
					'{{WRAPPER}} .pgfy-pricing-card' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'card_padding',
			[
				'label'      => esc_html__( 'Padding', 'pagifye-elementor-widgets' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'rem' ],
				'default'    => [
					'top'      => '30',
					'right'    => '30',
					'bottom'   => '30',
					'left'     => '30',
					'unit'     => 'px',
					'isLinked' => true,
				],
				'selectors'  => [
					'{{WRAPPER}} .pgfy-pricing-card' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'card_gap',
			[
				'label'      => esc_html__( 'Gap Between Cards', 'pagifye-elementor-widgets' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
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
					'{{WRAPPER}} .pgfy-pricing-grid' => 'gap: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		// Plan Name Style
		$this->start_controls_section(
			'plan_name_style',
			[
				'label' => esc_html__( 'Plan Name', 'pagifye-elementor-widgets' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'plan_name_color',
			[
				'label'     => esc_html__( 'Color', 'pagifye-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#FFFFFF',
				'selectors' => [
					'{{WRAPPER}} .pgfy-pricing-plan-name' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'plan_name_typography',
				'selector' => '{{WRAPPER}} .pgfy-pricing-plan-name',
			]
		);

		$this->end_controls_section();

		// Price Style
		$this->start_controls_section(
			'price_style',
			[
				'label' => esc_html__( 'Price', 'pagifye-elementor-widgets' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'price_color',
			[
				'label'     => esc_html__( 'Color', 'pagifye-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#FFFFFF',
				'selectors' => [
					'{{WRAPPER}} .pgfy-pricing-price' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'price_typography',
				'selector' => '{{WRAPPER}} .pgfy-pricing-price',
			]
		);

		$this->end_controls_section();

		// Button Style
		$this->start_controls_section(
			'button_style',
			[
				'label' => esc_html__( 'Button', 'pagifye-elementor-widgets' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->start_controls_tabs( 'button_tabs' );

		// Normal Button
		$this->start_controls_tab(
			'button_normal',
			[
				'label' => esc_html__( 'Normal', 'pagifye-elementor-widgets' ),
			]
		);

		$this->add_control(
			'button_bg',
			[
				'label'     => esc_html__( 'Background Color', 'pagifye-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#1A2E27',
				'selectors' => [
					'{{WRAPPER}} .pgfy-pricing-button' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'button_color',
			[
				'label'     => esc_html__( 'Text Color', 'pagifye-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#FFFFFF',
				'selectors' => [
					'{{WRAPPER}} .pgfy-pricing-button' => 'color: {{VALUE}};',
					'{{WRAPPER}} .pgfy-pricing-button svg path' => 'fill: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		// Featured Button
		$this->start_controls_tab(
			'button_featured',
			[
				'label' => esc_html__( 'Featured', 'pagifye-elementor-widgets' ),
			]
		);

		$this->add_control(
			'button_featured_bg',
			[
				'label'     => esc_html__( 'Background Color', 'pagifye-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#8FE35F',
				'selectors' => [
					'{{WRAPPER}} .pgfy-pricing-card.featured .pgfy-pricing-button' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'button_featured_color',
			[
				'label'     => esc_html__( 'Text Color', 'pagifye-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#0F2C24',
				'selectors' => [
					'{{WRAPPER}} .pgfy-pricing-card.featured .pgfy-pricing-button' => 'color: {{VALUE}};',
					'{{WRAPPER}} .pgfy-pricing-card.featured .pgfy-pricing-button svg path' => 'fill: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

		// Badge Style
		$this->start_controls_section(
			'badge_style',
			[
				'label' => esc_html__( 'Badge', 'pagifye-elementor-widgets' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'badge_bg',
			[
				'label'     => esc_html__( 'Background Color', 'pagifye-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#8FE35F',
				'selectors' => [
					'{{WRAPPER}} .pgfy-pricing-badge' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'badge_color',
			[
				'label'     => esc_html__( 'Text Color', 'pagifye-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#0F2C24',
				'selectors' => [
					'{{WRAPPER}} .pgfy-pricing-badge' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'badge_typography',
				'selector' => '{{WRAPPER}} .pgfy-pricing-badge',
			]
		);

		$this->end_controls_section();
	}

	/**
	 * Render widget output
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();

		$default_billing = ( 'annually' === $settings['default_billing'] ) ? 'annually' : 'monthly';

		// Parse heading text with highlight
		$heading_html = '';
		if ( ! empty( $settings['heading_parts'] ) ) {
			$text = $settings['heading_parts'];
			// Replace {text} with highlighted span
			$heading_html = preg_replace_callback(
				'/\{([^}]+)\}/',
				function( $matches ) {
					return '<span class="pgfy-pricing-heading-highlight">' . esc_html( $matches[1] ) . '</span>';
				},
				$text
			);
			$heading_html = esc_html( $text );
			$heading_html = preg_replace(
				'/\{([^}]+)\}/',
				'<span class="pgfy-pricing-heading-highlight">$1</span>',
				$heading_html
			);
		}

		$columns = $settings['columns'];
		$columns_tablet = $settings['columns_tablet'] ?: '2';
		$columns_mobile = $settings['columns_mobile'] ?: '1';
		?>

		<section class="pgfy-pricing-section">
			<div class="container">
				<div style="display: flex; flex-direction: column; align-items: center; justify-content: center; gap: 24px;">

					<!-- Heading -->
					<?php if ( 'yes' === $settings['show_heading'] && ! empty( $heading_html ) ) : ?>
						<<?php echo tag_escape( $settings['heading_tag'] ); ?> class="pgfy-pricing-heading" style="font-size: 48px; font-weight: 700; text-align: center; max-width: 700px; margin: 0;">
							<?php echo wp_kses_post( $heading_html ); ?>
						</<?php echo tag_escape( $settings['heading_tag'] ); ?>>
					<?php endif; ?>

					<!-- Billing Toggle -->
					<?php if ( 'yes' === $settings['show_billing_toggle'] ) : ?>
						<div class="pgfy-pricing-toggle" style="display: flex; gap: 8px; border-radius: 9999px; padding: 8px; font-weight: 700;" x-data="{ billing: '<?php echo esc_attr( $default_billing ); ?>' }">
							<button class="pgfy-pricing-toggle-btn" style="cursor: pointer; border-radius: 9999px; padding: 8px 24px; border: none; transition: all 0.3s ease;" x-bind:class="billing === 'monthly' ? 'active' : ''" @click="billing = 'monthly'">
								<?php echo esc_html( $settings['monthly_label'] ); ?>
							</button>
							<button class="pgfy-pricing-toggle-btn active" style="cursor: pointer; border-radius: 9999px; padding: 8px 24px; border: none; transition: all 0.3s ease;" x-bind:class="billing === 'annually' ? 'active' : ''" @click="billing = 'annually'">
								<?php echo esc_html( $settings['annually_label'] ); ?>
							</button>
						</div>
					<?php endif; ?>

					<!-- Pricing Cards Grid -->
					<?php if ( ! empty( $settings['pricing_cards'] ) ) : ?>
						<div class="pgfy-pricing-grid" style="display: grid; grid-template-columns: repeat(<?php echo esc_attr( $columns_mobile ); ?>, 1fr); width: 100%;" <?php echo 'yes' === $settings['show_billing_toggle'] ? 'x-data' : ''; ?>>
							<?php foreach ( $settings['pricing_cards'] as $index => $card ) : ?>
								<?php
								$is_featured = ( 'yes' === $card['is_featured'] );
								$card_class = 'pgfy-pricing-card';
								if ( $is_featured ) {
									$card_class .= ' featured';
								}

								$this->add_link_attributes( 'button_' . $index, $card['button_link'] );
								?>
								<div class="<?php echo esc_attr( $card_class ); ?>" style="position: relative; display: flex; flex-direction: column; gap: 16px;">

									<!-- Card Header -->
									<div style="display: flex; flex-direction: column; gap: 8px;">
										<h5 class="pgfy-pricing-plan-name" style="font-size: 28px; font-weight: 700; margin: 0;">
											<?php echo esc_html( $card['plan_name'] ); ?>
										</h5>

										<?php if ( 'yes' === $settings['show_billing_toggle'] ) : ?>
											<!-- Dynamic Price with Toggle -->
											<h6 class="pgfy-pricing-price" style="font-size: 48px; font-weight: 700; line-height: 1.2; margin: 0;">
												<span x-show="billing === 'monthly'"><?php echo esc_html( $card['monthly_price'] ); ?></span>
												<span x-show="billing === 'annually'"><?php echo esc_html( $card['annual_price'] ); ?></span>
												<span style="font-size: 16px; font-weight: 400;"><?php echo esc_html( $card['price_period'] ); ?></span>
											</h6>
										<?php else : ?>
											<!-- Static Price -->
											<h6 class="pgfy-pricing-price" style="font-size: 48px; font-weight: 700; line-height: 1.2; margin: 0;">
												<?php echo esc_html( $card['monthly_price'] ); ?>
												<span style="font-size: 16px; font-weight: 400;"><?php echo esc_html( $card['price_period'] ); ?></span>
											</h6>
										<?php endif; ?>

										<?php if ( ! empty( $card['billing_description'] ) ) : ?>
											<p style="color: rgba(229, 229, 229, 0.7); margin: 0;">
												<?php echo esc_html( $card['billing_description'] ); ?>
											</p>
										<?php endif; ?>
									</div>

									<!-- Divider -->
									<div style="height: 1px; width: 100%; background-color: rgba(255, 255, 255, 0.3);"></div>

									<!-- Card Content -->
									<div style="display: flex; flex-direction: column; gap: 24px;">
										<?php if ( ! empty( $card['features'] ) ) : ?>
											<p style="color: #E5E5E5; margin: 0;">
												<?php echo esc_html( $card['features'] ); ?>
											</p>
										<?php endif; ?>

										<a <?php echo $this->get_render_attribute_string( 'button_' . $index ); ?> class="pgfy-pricing-button" style="display: flex; align-items: center; justify-center: center; gap: 4px; width: 100%; padding: 12px 32px; border-radius: 9999px; font-size: 16px; font-weight: 700; text-decoration: none; transition: all 0.3s ease;">
											<span><?php echo esc_html( $card['button_text'] ); ?></span>
											<svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
												<path d="M17.5383 10.6635L11.9133 16.2885C11.7372 16.4647 11.4983 16.5636 11.2492 16.5636C11.0001 16.5636 10.7613 16.4647 10.5852 16.2885C10.409 16.1124 10.3101 15.8736 10.3101 15.6245C10.3101 15.3754 10.409 15.1365 10.5852 14.9604L14.6094 10.9378H3.125C2.87636 10.9378 2.6379 10.839 2.46209 10.6632C2.28627 10.4874 2.1875 10.2489 2.1875 10.0003C2.1875 9.75162 2.28627 9.51316 2.46209 9.33735C2.6379 9.16153 2.87636 9.06276 3.125 9.06276H14.6094L10.5867 5.03776C10.4106 4.86164 10.3117 4.62277 10.3117 4.3737C10.3117 4.12462 10.4106 3.88575 10.5867 3.70963C10.7628 3.53351 11.0017 3.43457 11.2508 3.43457C11.4999 3.43457 11.7387 3.53351 11.9148 3.70963L17.5398 9.33463C17.6273 9.42185 17.6966 9.52547 17.7438 9.63955C17.7911 9.75364 17.8153 9.87593 17.8152 9.99941C17.815 10.1229 17.7905 10.2451 17.743 10.3591C17.6955 10.4731 17.6259 10.5765 17.5383 10.6635Z" fill="currentColor"/>
											</svg>
										</a>
									</div>

									<!-- Featured Badge -->
									<?php if ( $is_featured && ! empty( $card['badge_text'] ) ) : ?>
										<p class="pgfy-pricing-badge" style="position: absolute; top: -28px; right: 28px; padding: 4px 8px; border-radius: 4px; font-size: 12px; font-weight: 700; text-transform: uppercase; margin: 0;">
											<?php echo esc_html( $card['badge_text'] ); ?>
										</p>
									<?php endif; ?>

								</div>
							<?php endforeach; ?>
						</div>

						<style>
							@media (min-width: 768px) {
								.pgfy-pricing-grid {
									grid-template-columns: repeat(<?php echo esc_attr( $columns_tablet ); ?>, 1fr) !important;
								}
							}
							@media (min-width: 1024px) {
								.pgfy-pricing-grid {
									grid-template-columns: repeat(<?php echo esc_attr( $columns ); ?>, 1fr) !important;
								}
							}
						</style>
					<?php endif; ?>

				</div>
			</div>
		</section>

		<?php
	}
}
