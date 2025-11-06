<?php
/**
 * Hero-01 Widget
 *
 * Split layout hero section with heading, description, CTA buttons, and image.
 *
 * @package Pagifye_Elementor_Widgets
 */

namespace Pagifye\ElementorWidgets\Widgets;

use Pagifye\ElementorWidgets\Base_Widget;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Repeater;
use Elementor\Utils;

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Hero-01 Widget Class
 */
class Hero_01 extends Base_Widget {

	/**
	 * Get widget name
	 */
	public function get_name() {
		return 'pagifye-hero-01';
	}

	/**
	 * Get widget title
	 */
	public function get_title() {
		return esc_html__( 'Hero 01', 'pagifye-elementor-widgets' );
	}

	/**
	 * Get widget icon
	 */
	public function get_icon() {
		return 'eicon-banner';
	}

	/**
	 * Get widget keywords
	 */
	public function get_keywords() {
		return [ 'pagifye', 'hero', 'banner', 'header', 'cta' ];
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
		// Hero Content Section
		$this->start_controls_section(
			'section_content',
			[
				'label' => esc_html__( 'Hero Content', 'pagifye-elementor-widgets' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'heading_line_1',
			[
				'label'       => esc_html__( 'Heading Line 1', 'pagifye-elementor-widgets' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => esc_html__( 'Driving Success Through', 'pagifye-elementor-widgets' ),
				'placeholder' => esc_html__( 'Enter first line', 'pagifye-elementor-widgets' ),
				'label_block' => true,
				'dynamic'     => [ 'active' => true ],
			]
		);

		$this->add_control(
			'heading_line_2',
			[
				'label'       => esc_html__( 'Heading Line 2 (Highlighted)', 'pagifye-elementor-widgets' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => esc_html__( 'Innovation and Excellence', 'pagifye-elementor-widgets' ),
				'placeholder' => esc_html__( 'Enter second line (will be highlighted)', 'pagifye-elementor-widgets' ),
				'label_block' => true,
				'dynamic'     => [ 'active' => true ],
			]
		);

		$this->add_control(
			'heading_tag',
			[
				'label'   => esc_html__( 'Heading HTML Tag', 'pagifye-elementor-widgets' ),
				'type'    => Controls_Manager::SELECT,
				'options' => [
					'h1'   => 'H1',
					'h2'   => 'H2',
					'h3'   => 'H3',
					'h4'   => 'H4',
					'h5'   => 'H5',
					'h6'   => 'H6',
					'div'  => 'div',
					'span' => 'span',
				],
				'default' => 'h1',
			]
		);

		$this->add_control(
			'description',
			[
				'label'       => esc_html__( 'Description', 'pagifye-elementor-widgets' ),
				'type'        => Controls_Manager::TEXTAREA,
				'default'     => esc_html__( 'Unlock your business\'s full potential with our innovative SaaS solutions and see the difference we can make.', 'pagifye-elementor-widgets' ),
				'placeholder' => esc_html__( 'Enter description', 'pagifye-elementor-widgets' ),
				'rows'        => 4,
				'dynamic'     => [ 'active' => true ],
			]
		);

		$this->end_controls_section();

		// CTA Buttons Section
		$this->start_controls_section(
			'section_buttons',
			[
				'label' => esc_html__( 'CTA Buttons', 'pagifye-elementor-widgets' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'button_text',
			[
				'label'       => esc_html__( 'Button Text', 'pagifye-elementor-widgets' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => esc_html__( 'Get Started', 'pagifye-elementor-widgets' ),
				'label_block' => true,
			]
		);

		$repeater->add_control(
			'button_link',
			[
				'label'       => esc_html__( 'Link', 'pagifye-elementor-widgets' ),
				'type'        => Controls_Manager::URL,
				'placeholder' => esc_html__( 'https://example.com', 'pagifye-elementor-widgets' ),
				'default'     => [
					'url'         => '#',
					'is_external' => false,
					'nofollow'    => false,
				],
			]
		);

		$repeater->add_control(
			'button_type',
			[
				'label'   => esc_html__( 'Button Style', 'pagifye-elementor-widgets' ),
				'type'    => Controls_Manager::SELECT,
				'options' => [
					'primary'   => esc_html__( 'Primary', 'pagifye-elementor-widgets' ),
					'secondary' => esc_html__( 'Secondary (Outline)', 'pagifye-elementor-widgets' ),
				],
				'default' => 'primary',
			]
		);

		$repeater->add_control(
			'show_icon',
			[
				'label'        => esc_html__( 'Show Icon', 'pagifye-elementor-widgets' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Yes', 'pagifye-elementor-widgets' ),
				'label_off'    => esc_html__( 'No', 'pagifye-elementor-widgets' ),
				'return_value' => 'yes',
				'default'      => '',
			]
		);

		$this->add_control(
			'buttons',
			[
				'label'       => esc_html__( 'Buttons', 'pagifye-elementor-widgets' ),
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'default'     => [
					[
						'button_text' => esc_html__( 'Get Started', 'pagifye-elementor-widgets' ),
						'button_type' => 'primary',
						'show_icon'   => 'yes',
					],
					[
						'button_text' => esc_html__( 'Learn More', 'pagifye-elementor-widgets' ),
						'button_type' => 'secondary',
						'show_icon'   => '',
					],
				],
				'title_field' => '{{{ button_text }}}',
			]
		);

		$this->end_controls_section();

		// Hero Image Section
		$this->start_controls_section(
			'section_image',
			[
				'label' => esc_html__( 'Hero Image', 'pagifye-elementor-widgets' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'image',
			[
				'label'   => esc_html__( 'Choose Image', 'pagifye-elementor-widgets' ),
				'type'    => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
				'dynamic' => [ 'active' => true ],
			]
		);

		$this->add_control(
			'image_position',
			[
				'label'   => esc_html__( 'Image Position', 'pagifye-elementor-widgets' ),
				'type'    => Controls_Manager::SELECT,
				'options' => [
					'left'  => esc_html__( 'Left', 'pagifye-elementor-widgets' ),
					'right' => esc_html__( 'Right', 'pagifye-elementor-widgets' ),
				],
				'default' => 'right',
			]
		);

		$this->end_controls_section();

		// Layout Section
		$this->start_controls_section(
			'section_layout',
			[
				'label' => esc_html__( 'Layout', 'pagifye-elementor-widgets' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_responsive_control(
			'content_width',
			[
				'label'      => esc_html__( 'Content Width', 'pagifye-elementor-widgets' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ '%' ],
				'range'      => [
					'%' => [
						'min' => 30,
						'max' => 70,
					],
				],
				'default'    => [
					'unit' => '%',
					'size' => 50,
				],
				'selectors'  => [
					'{{WRAPPER}} .pgfy-hero-content' => 'width: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .pgfy-hero-image'   => 'width: calc(100% - {{SIZE}}{{UNIT}});',
				],
			]
		);

		$this->add_responsive_control(
			'gap',
			[
				'label'      => esc_html__( 'Gap Between Columns', 'pagifye-elementor-widgets' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'rem' ],
				'range'      => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default'    => [
					'unit' => 'px',
					'size' => 40,
				],
				'selectors'  => [
					'{{WRAPPER}} .pgfy-hero-container' => 'gap: {{SIZE}}{{UNIT}};',
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
				'selector' => '{{WRAPPER}} .pgfy-hero-section',
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
					'top'      => '64',
					'right'    => '0',
					'bottom'   => '80',
					'left'     => '0',
					'unit'     => 'px',
					'isLinked' => false,
				],
				'selectors'  => [
					'{{WRAPPER}} .pgfy-hero-section' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		// Heading Style
		$this->start_controls_section(
			'heading_style',
			[
				'label' => esc_html__( 'Heading', 'pagifye-elementor-widgets' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'heading_color',
			[
				'label'     => esc_html__( 'Line 1 Color', 'pagifye-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#FFFFFF',
				'selectors' => [
					'{{WRAPPER}} .pgfy-hero-heading' => 'color: {{VALUE}};',
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
					'{{WRAPPER}} .pgfy-hero-heading-highlight' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'heading_typography',
				'selector' => '{{WRAPPER}} .pgfy-hero-heading',
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
					'size' => 24,
					'unit' => 'px',
				],
				'selectors'  => [
					'{{WRAPPER}} .pgfy-hero-heading' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		// Description Style
		$this->start_controls_section(
			'description_style',
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
				'default'   => '#E5E5E5',
				'selectors' => [
					'{{WRAPPER}} .pgfy-hero-description' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'description_typography',
				'selector' => '{{WRAPPER}} .pgfy-hero-description',
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
					'size' => 40,
					'unit' => 'px',
				],
				'selectors'  => [
					'{{WRAPPER}} .pgfy-hero-description' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		// Button Style
		$this->start_controls_section(
			'button_style',
			[
				'label' => esc_html__( 'Buttons', 'pagifye-elementor-widgets' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'button_gap',
			[
				'label'      => esc_html__( 'Gap Between Buttons', 'pagifye-elementor-widgets' ),
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
					'{{WRAPPER}} .pgfy-hero-buttons' => 'gap: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'button_typography',
				'selector' => '{{WRAPPER}} .pgfy-hero-button',
			]
		);

		// Primary Button
		$this->add_control(
			'primary_button_heading',
			[
				'label'     => esc_html__( 'Primary Button', 'pagifye-elementor-widgets' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->start_controls_tabs( 'primary_button_tabs' );

		$this->start_controls_tab(
			'primary_button_normal',
			[
				'label' => esc_html__( 'Normal', 'pagifye-elementor-widgets' ),
			]
		);

		$this->add_control(
			'primary_button_bg',
			[
				'label'     => esc_html__( 'Background Color', 'pagifye-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#8FE35F',
				'selectors' => [
					'{{WRAPPER}} .pgfy-hero-button-primary' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'primary_button_color',
			[
				'label'     => esc_html__( 'Text Color', 'pagifye-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#0F2C24',
				'selectors' => [
					'{{WRAPPER}} .pgfy-hero-button-primary' => 'color: {{VALUE}};',
					'{{WRAPPER}} .pgfy-hero-button-primary svg path' => 'fill: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'primary_button_hover',
			[
				'label' => esc_html__( 'Hover', 'pagifye-elementor-widgets' ),
			]
		);

		$this->add_control(
			'primary_button_bg_hover',
			[
				'label'     => esc_html__( 'Background Color', 'pagifye-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#7AD44B',
				'selectors' => [
					'{{WRAPPER}} .pgfy-hero-button-primary:hover' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		// Secondary Button
		$this->add_control(
			'secondary_button_heading',
			[
				'label'     => esc_html__( 'Secondary Button', 'pagifye-elementor-widgets' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->start_controls_tabs( 'secondary_button_tabs' );

		$this->start_controls_tab(
			'secondary_button_normal',
			[
				'label' => esc_html__( 'Normal', 'pagifye-elementor-widgets' ),
			]
		);

		$this->add_control(
			'secondary_button_border',
			[
				'label'     => esc_html__( 'Border Color', 'pagifye-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#8FE35F',
				'selectors' => [
					'{{WRAPPER}} .pgfy-hero-button-secondary' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'secondary_button_color',
			[
				'label'     => esc_html__( 'Text Color', 'pagifye-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#FFFFFF',
				'selectors' => [
					'{{WRAPPER}} .pgfy-hero-button-secondary' => 'color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'secondary_button_hover',
			[
				'label' => esc_html__( 'Hover', 'pagifye-elementor-widgets' ),
			]
		);

		$this->add_control(
			'secondary_button_bg_hover',
			[
				'label'     => esc_html__( 'Background Color', 'pagifye-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#8FE35F',
				'selectors' => [
					'{{WRAPPER}} .pgfy-hero-button-secondary:hover' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'secondary_button_color_hover',
			[
				'label'     => esc_html__( 'Text Color', 'pagifye-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#1A2E27',
				'selectors' => [
					'{{WRAPPER}} .pgfy-hero-button-secondary:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();
	}

	/**
	 * Render widget output
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();

		$image_position = $settings['image_position'];
		$flex_direction = ( 'left' === $image_position ) ? 'row-reverse' : 'row';
		?>

		<section class="pgfy-hero-section">
			<div class="container">
				<div class="pgfy-hero-container" style="display: flex; align-items: center; flex-direction: <?php echo esc_attr( $flex_direction ); ?>; flex-wrap: wrap;">

					<!-- Hero Content -->
					<div class="pgfy-hero-content" style="flex-grow: 1;">
						<div style="display: flex; flex-direction: column; gap: 24px;">

							<!-- Heading -->
							<?php if ( ! empty( $settings['heading_line_1'] ) || ! empty( $settings['heading_line_2'] ) ) : ?>
								<<?php echo tag_escape( $settings['heading_tag'] ); ?> class="pgfy-hero-heading" style="font-size: 60px; font-weight: 700; line-height: 1.13; margin: 0;">
									<?php if ( ! empty( $settings['heading_line_1'] ) ) : ?>
										<span style="display: block;"><?php echo esc_html( $settings['heading_line_1'] ); ?></span>
									<?php endif; ?>
									<?php if ( ! empty( $settings['heading_line_2'] ) ) : ?>
										<span class="pgfy-hero-heading-highlight" style="display: block;"><?php echo esc_html( $settings['heading_line_2'] ); ?></span>
									<?php endif; ?>
								</<?php echo tag_escape( $settings['heading_tag'] ); ?>>
							<?php endif; ?>

							<!-- Description -->
							<?php if ( ! empty( $settings['description'] ) ) : ?>
								<p class="pgfy-hero-description" style="font-size: 18px; line-height: 1.6; margin: 0;">
									<?php echo esc_html( $settings['description'] ); ?>
								</p>
							<?php endif; ?>

							<!-- CTA Buttons -->
							<?php if ( ! empty( $settings['buttons'] ) ) : ?>
								<div class="pgfy-hero-buttons" style="display: flex; flex-wrap: wrap;">
									<?php foreach ( $settings['buttons'] as $index => $button ) : ?>
										<?php
										$button_class = 'pgfy-hero-button';
										$button_class .= ( 'primary' === $button['button_type'] ) ? ' pgfy-hero-button-primary' : ' pgfy-hero-button-secondary';

										$this->add_link_attributes( 'button_' . $index, $button['button_link'] );
										?>
										<a <?php echo $this->get_render_attribute_string( 'button_' . $index ); ?> class="<?php echo esc_attr( $button_class ); ?>" style="display: inline-flex; align-items: center; justify-content: center; gap: 4px; padding: 12px 32px; border-radius: 9999px; font-weight: 700; font-size: 16px; text-decoration: none; transition: all 0.3s ease; <?php echo ( 'secondary' === $button['button_type'] ) ? 'border: 1px solid;' : ''; ?>">
											<span><?php echo esc_html( $button['button_text'] ); ?></span>
											<?php if ( 'yes' === $button['show_icon'] ) : ?>
												<svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg" style="transition: transform 0.3s ease;">
													<path d="M17.5383 10.6635L11.9133 16.2885C11.7372 16.4647 11.4983 16.5636 11.2492 16.5636C11.0001 16.5636 10.7613 16.4647 10.5852 16.2885C10.409 16.1124 10.3101 15.8736 10.3101 15.6245C10.3101 15.3754 10.409 15.1365 10.5852 14.9604L14.6094 10.9378H3.125C2.87636 10.9378 2.6379 10.839 2.46209 10.6632C2.28627 10.4874 2.1875 10.2489 2.1875 10.0003C2.1875 9.75162 2.28627 9.51316 2.46209 9.33735C2.6379 9.16153 2.87636 9.06276 3.125 9.06276H14.6094L10.5867 5.03776C10.4106 4.86164 10.3117 4.62277 10.3117 4.3737C10.3117 4.12462 10.4106 3.88575 10.5867 3.70963C10.7628 3.53351 11.0017 3.43457 11.2508 3.43457C11.4999 3.43457 11.7387 3.53351 11.9148 3.70963L17.5398 9.33463C17.6273 9.42185 17.6966 9.52547 17.7438 9.63955C17.7911 9.75364 17.8153 9.87593 17.8152 9.99941C17.815 10.1229 17.7905 10.2451 17.743 10.3591C17.6955 10.4731 17.6259 10.5765 17.5383 10.6635Z" fill="currentColor"/>
												</svg>
											<?php endif; ?>
										</a>
									<?php endforeach; ?>
								</div>
							<?php endif; ?>

						</div>
					</div>

					<!-- Hero Image -->
					<?php if ( ! empty( $settings['image']['url'] ) ) : ?>
						<div class="pgfy-hero-image" style="flex-grow: 1;">
							<?php echo wp_get_attachment_image( $settings['image']['id'], 'full', false, [ 'style' => 'width: 100%; height: auto; display: block;' ] ); ?>
						</div>
					<?php endif; ?>

				</div>
			</div>
		</section>

		<?php
	}
}
