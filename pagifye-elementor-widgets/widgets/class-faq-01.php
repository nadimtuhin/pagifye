<?php
/**
 * FAQ-01 Widget
 *
 * Accordion-style FAQ section with Alpine.js powered expand/collapse functionality.
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
 * FAQ-01 Widget Class
 */
class FAQ_01 extends Base_Widget {

	/**
	 * Get widget name
	 */
	public function get_name() {
		return 'pagifye-faq-01';
	}

	/**
	 * Get widget title
	 */
	public function get_title() {
		return esc_html__( 'FAQ 01', 'pagifye-elementor-widgets' );
	}

	/**
	 * Get widget icon
	 */
	public function get_icon() {
		return 'eicon-accordion';
	}

	/**
	 * Get widget keywords
	 */
	public function get_keywords() {
		return [ 'pagifye', 'faq', 'accordion', 'questions', 'answers', 'help' ];
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
			'heading_line_1',
			[
				'label'       => esc_html__( 'Heading Line 1', 'pagifye-elementor-widgets' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => esc_html__( 'Frequently asked', 'pagifye-elementor-widgets' ),
				'label_block' => true,
				'dynamic'     => [ 'active' => true ],
				'condition'   => [
					'show_heading' => 'yes',
				],
			]
		);

		$this->add_control(
			'heading_line_2',
			[
				'label'       => esc_html__( 'Heading Line 2 (Highlighted)', 'pagifye-elementor-widgets' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => esc_html__( 'questions', 'pagifye-elementor-widgets' ),
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
				'label'     => esc_html__( 'Heading HTML Tag', 'pagifye-elementor-widgets' ),
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

		$this->add_control(
			'description',
			[
				'label'       => esc_html__( 'Description', 'pagifye-elementor-widgets' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => esc_html__( 'Everything you need to know about Pagifye', 'pagifye-elementor-widgets' ),
				'label_block' => true,
				'dynamic'     => [ 'active' => true ],
				'condition'   => [
					'show_heading' => 'yes',
				],
			]
		);

		$this->end_controls_section();

		// FAQ Items
		$this->start_controls_section(
			'section_items',
			[
				'label' => esc_html__( 'FAQ Items', 'pagifye-elementor-widgets' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'question',
			[
				'label'       => esc_html__( 'Question', 'pagifye-elementor-widgets' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => esc_html__( 'How to create a user?', 'pagifye-elementor-widgets' ),
				'label_block' => true,
				'dynamic'     => [ 'active' => true ],
			]
		);

		$repeater->add_control(
			'answer',
			[
				'label'       => esc_html__( 'Answer', 'pagifye-elementor-widgets' ),
				'type'        => Controls_Manager::TEXTAREA,
				'default'     => esc_html__( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus ac libero non augue vestibulum finibus at vitae ex.', 'pagifye-elementor-widgets' ),
				'rows'        => 5,
				'dynamic'     => [ 'active' => true ],
			]
		);

		$repeater->add_control(
			'open_default',
			[
				'label'        => esc_html__( 'Open by Default', 'pagifye-elementor-widgets' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Yes', 'pagifye-elementor-widgets' ),
				'label_off'    => esc_html__( 'No', 'pagifye-elementor-widgets' ),
				'return_value' => 'yes',
				'default'      => '',
			]
		);

		$this->add_control(
			'faq_items',
			[
				'label'       => esc_html__( 'FAQ Items', 'pagifye-elementor-widgets' ),
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'default'     => [
					[
						'question'     => esc_html__( 'How to create a user?', 'pagifye-elementor-widgets' ),
						'answer'       => esc_html__( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus ac libero non augue vestibulum finibus at vitae ex. Donec euismod non tellus sed lobortis.', 'pagifye-elementor-widgets' ),
						'open_default' => '',
					],
					[
						'question'     => esc_html__( 'How much does it cost to create a user?', 'pagifye-elementor-widgets' ),
						'answer'       => esc_html__( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus ac libero non augue vestibulum finibus at vitae ex. Donec euismod non tellus sed lobortis.', 'pagifye-elementor-widgets' ),
						'open_default' => '',
					],
					[
						'question'     => esc_html__( 'Can we get a review of Pagifye?', 'pagifye-elementor-widgets' ),
						'answer'       => esc_html__( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus ac libero non augue vestibulum finibus at vitae ex. Donec euismod non tellus sed lobortis.', 'pagifye-elementor-widgets' ),
						'open_default' => '',
					],
				],
				'title_field' => '{{{ question }}}',
			]
		);

		$this->add_control(
			'accordion_behavior',
			[
				'label'       => esc_html__( 'Accordion Behavior', 'pagifye-elementor-widgets' ),
				'type'        => Controls_Manager::SELECT,
				'options'     => [
					'single'   => esc_html__( 'Single (Only one open at a time)', 'pagifye-elementor-widgets' ),
					'multiple' => esc_html__( 'Multiple (Allow multiple open)', 'pagifye-elementor-widgets' ),
				],
				'default'     => 'single',
				'description' => esc_html__( 'Control whether users can open multiple items at once', 'pagifye-elementor-widgets' ),
			]
		);

		$this->end_controls_section();

		// Settings Section
		$this->start_controls_section(
			'section_settings',
			[
				'label' => esc_html__( 'Settings', 'pagifye-elementor-widgets' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'icon_position',
			[
				'label'   => esc_html__( 'Icon Position', 'pagifye-elementor-widgets' ),
				'type'    => Controls_Manager::SELECT,
				'options' => [
					'left'  => esc_html__( 'Left', 'pagifye-elementor-widgets' ),
					'right' => esc_html__( 'Right', 'pagifye-elementor-widgets' ),
				],
				'default' => 'right',
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
				'selector' => '{{WRAPPER}} .pgfy-faq-section',
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
				'size_units' => [ 'px', 'rem', '%' ],
				'default'    => [
					'top'      => '40',
					'right'    => '0',
					'bottom'   => '40',
					'left'     => '0',
					'unit'     => 'px',
					'isLinked' => false,
				],
				'selectors'  => [
					'{{WRAPPER}} .pgfy-faq-section' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
				'label'     => esc_html__( 'Line 1 Color', 'pagifye-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#FFFFFF',
				'selectors' => [
					'{{WRAPPER}} .pgfy-faq-heading' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'heading_highlight_color',
			[
				'label'     => esc_html__( 'Line 2 Color (Highlight)', 'pagifye-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#8FE35F',
				'selectors' => [
					'{{WRAPPER}} .pgfy-faq-heading-highlight' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'heading_typography',
				'selector' => '{{WRAPPER}} .pgfy-faq-heading',
			]
		);

		$this->add_responsive_control(
			'heading_spacing',
			[
				'label'      => esc_html__( 'Bottom Spacing', 'pagifye-elementor-widgets' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'rem' ],
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
					'{{WRAPPER}} .pgfy-faq-heading' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		// Description Style
		$this->start_controls_section(
			'description_style',
			[
				'label'     => esc_html__( 'Description', 'pagifye-elementor-widgets' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'show_heading' => 'yes',
				],
			]
		);

		$this->add_control(
			'description_color',
			[
				'label'     => esc_html__( 'Color', 'pagifye-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#E5E5E5',
				'selectors' => [
					'{{WRAPPER}} .pgfy-faq-description' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'description_typography',
				'selector' => '{{WRAPPER}} .pgfy-faq-description',
			]
		);

		$this->add_responsive_control(
			'description_spacing',
			[
				'label'      => esc_html__( 'Bottom Spacing', 'pagifye-elementor-widgets' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'rem' ],
				'range'      => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default'    => [
					'size' => 32,
					'unit' => 'px',
				],
				'selectors'  => [
					'{{WRAPPER}} .pgfy-faq-description' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		// FAQ Items Style
		$this->start_controls_section(
			'items_style',
			[
				'label' => esc_html__( 'FAQ Items', 'pagifye-elementor-widgets' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'items_spacing',
			[
				'label'      => esc_html__( 'Gap Between Items', 'pagifye-elementor-widgets' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'rem' ],
				'range'      => [
					'px' => [
						'min' => 0,
						'max' => 50,
					],
				],
				'default'    => [
					'size' => 16,
					'unit' => 'px',
				],
				'selectors'  => [
					'{{WRAPPER}} .pgfy-faq-list' => 'gap: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'     => 'item_background',
				'types'    => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .pgfy-faq-item',
				'fields_options' => [
					'background' => [
						'default' => 'classic',
					],
					'color' => [
						'default' => '#1A2E27',
					],
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'item_border',
				'selector' => '{{WRAPPER}} .pgfy-faq-item',
			]
		);

		$this->add_responsive_control(
			'item_border_radius',
			[
				'label'      => esc_html__( 'Border Radius', 'pagifye-elementor-widgets' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'default'    => [
					'top'      => '8',
					'right'    => '8',
					'bottom'   => '8',
					'left'     => '8',
					'unit'     => 'px',
					'isLinked' => true,
				],
				'selectors'  => [
					'{{WRAPPER}} .pgfy-faq-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'item_padding',
			[
				'label'      => esc_html__( 'Padding', 'pagifye-elementor-widgets' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'rem' ],
				'default'    => [
					'top'      => '16',
					'right'    => '16',
					'bottom'   => '16',
					'left'     => '16',
					'unit'     => 'px',
					'isLinked' => true,
				],
				'selectors'  => [
					'{{WRAPPER}} .pgfy-faq-question-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		// Question Style
		$this->start_controls_section(
			'question_style',
			[
				'label' => esc_html__( 'Question', 'pagifye-elementor-widgets' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'question_color',
			[
				'label'     => esc_html__( 'Color', 'pagifye-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#FFFFFF',
				'selectors' => [
					'{{WRAPPER}} .pgfy-faq-question' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'question_typography',
				'selector' => '{{WRAPPER}} .pgfy-faq-question',
			]
		);

		$this->end_controls_section();

		// Answer Style
		$this->start_controls_section(
			'answer_style',
			[
				'label' => esc_html__( 'Answer', 'pagifye-elementor-widgets' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'answer_color',
			[
				'label'     => esc_html__( 'Color', 'pagifye-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#E5E5E5',
				'selectors' => [
					'{{WRAPPER}} .pgfy-faq-answer' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'answer_typography',
				'selector' => '{{WRAPPER}} .pgfy-faq-answer',
			]
		);

		$this->add_responsive_control(
			'answer_padding',
			[
				'label'      => esc_html__( 'Padding', 'pagifye-elementor-widgets' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'rem' ],
				'default'    => [
					'top'      => '0',
					'right'    => '24',
					'bottom'   => '24',
					'left'     => '24',
					'unit'     => 'px',
					'isLinked' => false,
				],
				'selectors'  => [
					'{{WRAPPER}} .pgfy-faq-answer' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		// Icon Style
		$this->start_controls_section(
			'icon_style',
			[
				'label' => esc_html__( 'Icon', 'pagifye-elementor-widgets' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'icon_color',
			[
				'label'     => esc_html__( 'Color', 'pagifye-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#FFFFFF',
				'selectors' => [
					'{{WRAPPER}} .pgfy-faq-icon' => 'fill: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'icon_size',
			[
				'label'      => esc_html__( 'Size', 'pagifye-elementor-widgets' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min' => 12,
						'max' => 48,
					],
				],
				'default'    => [
					'size' => 24,
					'unit' => 'px',
				],
				'selectors'  => [
					'{{WRAPPER}} .pgfy-faq-icon' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
	}

	/**
	 * Render widget output
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();

		// Determine default open item
		$default_open = null;
		foreach ( $settings['faq_items'] as $index => $item ) {
			if ( 'yes' === $item['open_default'] ) {
				$default_open = $index + 1;
				break;
			}
		}

		$widget_id = $this->get_id();
		?>

		<section class="pgfy-faq-section">
			<div class="container">
				<div style="display: flex; flex-direction: column; gap: 32px;">

					<!-- Section Heading -->
					<?php if ( 'yes' === $settings['show_heading'] ) : ?>
						<div style="display: flex; flex-direction: column; align-items: center; justify-content: center; gap: 16px; width: 100%;">
							<?php if ( ! empty( $settings['heading_line_1'] ) || ! empty( $settings['heading_line_2'] ) ) : ?>
								<<?php echo tag_escape( $settings['heading_tag'] ); ?> class="pgfy-faq-heading" style="font-size: 48px; font-weight: 700; text-align: center; max-width: 644px; margin: 0;">
									<?php if ( ! empty( $settings['heading_line_1'] ) ) : ?>
										<span><?php echo esc_html( $settings['heading_line_1'] ); ?> </span>
									<?php endif; ?>
									<?php if ( ! empty( $settings['heading_line_2'] ) ) : ?>
										<span class="pgfy-faq-heading-highlight"><?php echo esc_html( $settings['heading_line_2'] ); ?></span>
									<?php endif; ?>
								</<?php echo tag_escape( $settings['heading_tag'] ); ?>>
							<?php endif; ?>

							<?php if ( ! empty( $settings['description'] ) ) : ?>
								<p class="pgfy-faq-description" style="font-size: 16px; margin: 0;">
									<?php echo esc_html( $settings['description'] ); ?>
								</p>
							<?php endif; ?>
						</div>
					<?php endif; ?>

					<!-- FAQ Items -->
					<?php if ( ! empty( $settings['faq_items'] ) ) : ?>
						<ul class="pgfy-faq-list" style="display: flex; flex-direction: column; list-style: none; margin: 0; padding: 0;" x-data="{ selected: <?php echo $default_open ? $default_open : 'null'; ?> }">
							<?php foreach ( $settings['faq_items'] as $index => $item ) : ?>
								<?php
								$item_index = $index + 1;
								$flex_direction = ( 'left' === $settings['icon_position'] ) ? 'row-reverse' : 'row';
								?>
								<li class="pgfy-faq-item" style="position: relative;">
									<button type="button" class="pgfy-faq-question-button" style="display: flex; align-items: center; justify-content: space-between; width: 100%; text-align: left; background: none; border: none; cursor: pointer; flex-direction: <?php echo esc_attr( $flex_direction ); ?>;" @click="selected !== <?php echo $item_index; ?> ? selected = <?php echo $item_index; ?> : selected = null">
										<p class="pgfy-faq-question" style="font-size: 20px; font-weight: 700; margin: 0;">
											<?php echo esc_html( $item['question'] ); ?>
										</p>
										<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="pgfy-faq-icon" style="min-width: 24px; transition: transform 0.5s ease;" x-bind:class="selected == <?php echo $item_index; ?> ? 'rotate-90' : ''">
											<path d="M17.2959 12.7959L9.7959 20.2959C9.58455 20.5072 9.29791 20.626 8.99902 20.626C8.70014 20.626 8.41349 20.5072 8.20215 20.2959C7.9908 20.0846 7.87207 19.7979 7.87207 19.499C7.87207 19.2001 7.9908 18.9135 8.20215 18.7021L14.9062 12L8.20402 5.2959C8.09937 5.19125 8.01636 5.06702 7.95973 4.93029C7.90309 4.79356 7.87394 4.64702 7.87394 4.49902C7.87394 4.35103 7.90309 4.20448 7.95973 4.06776C8.01636 3.93103 8.09937 3.80679 8.20402 3.70215C8.30867 3.5975 8.4329 3.51449 8.56963 3.45785C8.70636 3.40122 8.8529 3.37207 9.0009 3.37207C9.14889 3.37207 9.29543 3.40122 9.43216 3.45785C9.56889 3.51449 9.69313 3.5975 9.79777 3.70215L17.2978 11.2021C17.4025 11.3068 17.4856 11.4311 17.5422 11.5679C17.5988 11.7047 17.6279 11.8513 17.6277 11.9994C17.6275 12.1475 17.5981 12.2941 17.5412 12.4307C17.4843 12.5674 17.4009 12.6915 17.2959 12.7959Z"/>
										</svg>
									</button>

									<div class="pgfy-faq-answer-wrapper" style="position: relative; max-height: 0; overflow: hidden; transition: max-height 0.5s ease;" x-ref="container<?php echo $item_index; ?>" x-bind:style="selected == <?php echo $item_index; ?> ? 'max-height: ' + $refs.container<?php echo $item_index; ?>.scrollHeight + 'px' : ''">
										<p class="pgfy-faq-answer" style="text-align: justify; margin: 0;">
											<?php echo esc_html( $item['answer'] ); ?>
										</p>
									</div>
								</li>
							<?php endforeach; ?>
						</ul>
					<?php endif; ?>

				</div>
			</div>
		</section>

		<?php
	}

	/**
	 * Render widget output in the editor
	 */
	protected function content_template() {
		?>
		<#
		var defaultOpen = null;
		_.each( settings.faq_items, function( item, index ) {
			if ( 'yes' === item.open_default && ! defaultOpen ) {
				defaultOpen = index + 1;
			}
		});

		var flexDirection = ( 'left' === settings.icon_position ) ? 'row-reverse' : 'row';
		#>

		<section class="pgfy-faq-section">
			<div class="container">
				<div style="display: flex; flex-direction: column; gap: 32px;">

					<# if ( 'yes' === settings.show_heading ) { #>
						<div style="display: flex; flex-direction: column; align-items: center; justify-content: center; gap: 16px; width: 100%;">
							<# if ( settings.heading_line_1 || settings.heading_line_2 ) { #>
								<{{{ settings.heading_tag }}} class="pgfy-faq-heading" style="font-size: 48px; font-weight: 700; text-align: center; max-width: 644px; margin: 0;">
									<# if ( settings.heading_line_1 ) { #>
										<span>{{{ settings.heading_line_1 }}} </span>
									<# } #>
									<# if ( settings.heading_line_2 ) { #>
										<span class="pgfy-faq-heading-highlight">{{{ settings.heading_line_2 }}}</span>
									<# } #>
								</{{{ settings.heading_tag }}}>
							<# } #>

							<# if ( settings.description ) { #>
								<p class="pgfy-faq-description" style="font-size: 16px; margin: 0;">
									{{{ settings.description }}}
								</p>
							<# } #>
						</div>
					<# } #>

					<# if ( settings.faq_items.length ) { #>
						<ul class="pgfy-faq-list" style="display: flex; flex-direction: column; list-style: none; margin: 0; padding: 0;">
							<# _.each( settings.faq_items, function( item, index ) {
								var itemIndex = index + 1;
								var isOpen = ( 'yes' === item.open_default );
							#>
								<li class="pgfy-faq-item" style="position: relative;">
									<button type="button" class="pgfy-faq-question-button" style="display: flex; align-items: center; justify-content: space-between; width: 100%; text-align: left; background: none; border: none; cursor: pointer; flex-direction: {{{ flexDirection }}};">
										<p class="pgfy-faq-question" style="font-size: 20px; font-weight: 700; margin: 0;">
											{{{ item.question }}}
										</p>
										<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="pgfy-faq-icon" style="min-width: 24px; transition: transform 0.5s ease; transform: {{{ isOpen ? 'rotate(90deg)' : 'rotate(0deg)' }}};">
											<path d="M17.2959 12.7959L9.7959 20.2959C9.58455 20.5072 9.29791 20.626 8.99902 20.626C8.70014 20.626 8.41349 20.5072 8.20215 20.2959C7.9908 20.0846 7.87207 19.7979 7.87207 19.499C7.87207 19.2001 7.9908 18.9135 8.20215 18.7021L14.9062 12L8.20402 5.2959C8.09937 5.19125 8.01636 5.06702 7.95973 4.93029C7.90309 4.79356 7.87394 4.64702 7.87394 4.49902C7.87394 4.35103 7.90309 4.20448 7.95973 4.06776C8.01636 3.93103 8.09937 3.80679 8.20402 3.70215C8.30867 3.5975 8.4329 3.51449 8.56963 3.45785C8.70636 3.40122 8.8529 3.37207 9.0009 3.37207C9.14889 3.37207 9.29543 3.40122 9.43216 3.45785C9.56889 3.51449 9.69313 3.5975 9.79777 3.70215L17.2978 11.2021C17.4025 11.3068 17.4856 11.4311 17.5422 11.5679C17.5988 11.7047 17.6279 11.8513 17.6277 11.9994C17.6275 12.1475 17.5981 12.2941 17.5412 12.4307C17.4843 12.5674 17.4009 12.6915 17.2959 12.7959Z"/>
										</svg>
									</button>

									<div class="pgfy-faq-answer-wrapper" style="position: relative; max-height: {{{ isOpen ? 'auto' : '0' }}}; overflow: hidden; transition: max-height 0.5s ease;">
										<p class="pgfy-faq-answer" style="text-align: justify; margin: 0;">
											{{{ item.answer }}}
										</p>
									</div>
								</li>
							<# }); #>
						</ul>
					<# } #>

				</div>
			</div>
		</section>
		<?php
	}
}
