<?php
/**
 * Navigation-01 Widget
 *
 * Navigation header with logo, menu items, dropdowns, CTA buttons, and mobile menu.
 *
 * @package Pagifye_Elementor_Widgets
 */

namespace Pagifye\ElementorWidgets\Widgets;

use Pagifye\ElementorWidgets\Base_Widget;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;
use Elementor\Repeater;
use Elementor\Utils;

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Navigation-01 Widget Class
 */
class Navigation_01 extends Base_Widget {

	/**
	 * Get widget name
	 */
	public function get_name() {
		return 'pagifye-navigation-01';
	}

	/**
	 * Get widget title
	 */
	public function get_title() {
		return esc_html__( 'Navigation 01', 'pagifye-elementor-widgets' );
	}

	/**
	 * Get widget icon
	 */
	public function get_icon() {
		return 'eicon-nav-menu';
	}

	/**
	 * Get widget keywords
	 */
	public function get_keywords() {
		return [ 'pagifye', 'navigation', 'menu', 'header', 'navbar' ];
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
		// Logo Section
		$this->start_controls_section(
			'section_logo',
			[
				'label' => esc_html__( 'Logo', 'pagifye-elementor-widgets' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'logo_type',
			[
				'label'   => esc_html__( 'Logo Type', 'pagifye-elementor-widgets' ),
				'type'    => Controls_Manager::SELECT,
				'options' => [
					'image' => esc_html__( 'Image', 'pagifye-elementor-widgets' ),
					'text'  => esc_html__( 'Text', 'pagifye-elementor-widgets' ),
				],
				'default' => 'image',
			]
		);

		$this->add_control(
			'logo_image',
			[
				'label'     => esc_html__( 'Choose Logo', 'pagifye-elementor-widgets' ),
				'type'      => Controls_Manager::MEDIA,
				'default'   => [
					'url' => Utils::get_placeholder_image_src(),
				],
				'condition' => [
					'logo_type' => 'image',
				],
			]
		);

		$this->add_control(
			'logo_text',
			[
				'label'       => esc_html__( 'Logo Text', 'pagifye-elementor-widgets' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => esc_html__( 'Brand', 'pagifye-elementor-widgets' ),
				'label_block' => true,
				'condition'   => [
					'logo_type' => 'text',
				],
			]
		);

		$this->add_control(
			'logo_link',
			[
				'label'       => esc_html__( 'Link', 'pagifye-elementor-widgets' ),
				'type'        => Controls_Manager::URL,
				'placeholder' => esc_html__( 'https://example.com', 'pagifye-elementor-widgets' ),
				'default'     => [
					'url' => '#',
				],
			]
		);

		$this->end_controls_section();

		// Menu Items Section
		$this->start_controls_section(
			'section_menu',
			[
				'label' => esc_html__( 'Menu Items', 'pagifye-elementor-widgets' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);

		$menu_repeater = new Repeater();

		$menu_repeater->add_control(
			'menu_text',
			[
				'label'       => esc_html__( 'Menu Text', 'pagifye-elementor-widgets' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => esc_html__( 'Menu Item', 'pagifye-elementor-widgets' ),
				'label_block' => true,
			]
		);

		$menu_repeater->add_control(
			'menu_link',
			[
				'label'       => esc_html__( 'Link', 'pagifye-elementor-widgets' ),
				'type'        => Controls_Manager::URL,
				'placeholder' => esc_html__( 'https://example.com', 'pagifye-elementor-widgets' ),
				'default'     => [
					'url' => '#',
				],
			]
		);

		$menu_repeater->add_control(
			'has_dropdown',
			[
				'label'        => esc_html__( 'Has Dropdown', 'pagifye-elementor-widgets' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Yes', 'pagifye-elementor-widgets' ),
				'label_off'    => esc_html__( 'No', 'pagifye-elementor-widgets' ),
				'return_value' => 'yes',
				'default'      => '',
			]
		);

		$menu_repeater->add_control(
			'dropdown_items',
			[
				'label'       => esc_html__( 'Dropdown Items (one per line)', 'pagifye-elementor-widgets' ),
				'type'        => Controls_Manager::TEXTAREA,
				'default'     => "Overview\nFeatures\nSolutions\nIntegrations",
				'description' => esc_html__( 'Enter each submenu item on a new line', 'pagifye-elementor-widgets' ),
				'rows'        => 5,
				'condition'   => [
					'has_dropdown' => 'yes',
				],
			]
		);

		$this->add_control(
			'menu_items',
			[
				'label'       => esc_html__( 'Menu Items', 'pagifye-elementor-widgets' ),
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $menu_repeater->get_controls(),
				'default'     => [
					[
						'menu_text'     => esc_html__( 'Home', 'pagifye-elementor-widgets' ),
						'has_dropdown'  => '',
					],
					[
						'menu_text'     => esc_html__( 'Product', 'pagifye-elementor-widgets' ),
						'has_dropdown'  => 'yes',
						'dropdown_items' => "Overview\nFeatures\nSolutions\nIntegrations",
					],
					[
						'menu_text'     => esc_html__( 'Solutions', 'pagifye-elementor-widgets' ),
						'has_dropdown'  => '',
					],
					[
						'menu_text'     => esc_html__( 'Pricing', 'pagifye-elementor-widgets' ),
						'has_dropdown'  => '',
					],
					[
						'menu_text'     => esc_html__( 'Blogs', 'pagifye-elementor-widgets' ),
						'has_dropdown'  => '',
					],
				],
				'title_field' => '{{{ menu_text }}}',
			]
		);

		$this->end_controls_section();

		// CTA Buttons Section
		$this->start_controls_section(
			'section_cta',
			[
				'label' => esc_html__( 'CTA Buttons', 'pagifye-elementor-widgets' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);

		$cta_repeater = new Repeater();

		$cta_repeater->add_control(
			'button_text',
			[
				'label'       => esc_html__( 'Button Text', 'pagifye-elementor-widgets' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => esc_html__( 'Get Started', 'pagifye-elementor-widgets' ),
				'label_block' => true,
			]
		);

		$cta_repeater->add_control(
			'button_link',
			[
				'label'       => esc_html__( 'Link', 'pagifye-elementor-widgets' ),
				'type'        => Controls_Manager::URL,
				'placeholder' => esc_html__( 'https://example.com', 'pagifye-elementor-widgets' ),
				'default'     => [
					'url' => '#',
				],
			]
		);

		$cta_repeater->add_control(
			'button_style',
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

		$this->add_control(
			'cta_buttons',
			[
				'label'       => esc_html__( 'Buttons', 'pagifye-elementor-widgets' ),
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $cta_repeater->get_controls(),
				'default'     => [
					[
						'button_text'  => esc_html__( 'Sign In', 'pagifye-elementor-widgets' ),
						'button_style' => 'secondary',
					],
					[
						'button_text'  => esc_html__( 'Get Started', 'pagifye-elementor-widgets' ),
						'button_style' => 'primary',
					],
				],
				'title_field' => '{{{ button_text }}}',
			]
		);

		$this->end_controls_section();

		// Mobile Menu Section
		$this->start_controls_section(
			'section_mobile',
			[
				'label' => esc_html__( 'Mobile Menu', 'pagifye-elementor-widgets' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'mobile_menu_items_text',
			[
				'label'       => esc_html__( 'Mobile Menu Items', 'pagifye-elementor-widgets' ),
				'type'        => Controls_Manager::TEXTAREA,
				'default'     => "Home\nAbout us\nHow it works\nCase Study\nService",
				'description' => esc_html__( 'Enter each menu item on a new line', 'pagifye-elementor-widgets' ),
				'rows'        => 5,
			]
		);

		$this->add_control(
			'mobile_breakpoint',
			[
				'label'       => esc_html__( 'Mobile Breakpoint', 'pagifye-elementor-widgets' ),
				'type'        => Controls_Manager::SELECT,
				'options'     => [
					'768'  => esc_html__( 'Tablet (768px)', 'pagifye-elementor-widgets' ),
					'1024' => esc_html__( 'Desktop (1024px)', 'pagifye-elementor-widgets' ),
				],
				'default'     => '1024',
				'description' => esc_html__( 'Show mobile menu below this width', 'pagifye-elementor-widgets' ),
			]
		);

		$this->end_controls_section();
	}

	/**
	 * Register style controls
	 */
	private function register_style_controls() {
		// Header Style
		$this->start_controls_section(
			'header_style',
			[
				'label' => esc_html__( 'Header', 'pagifye-elementor-widgets' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'     => 'header_background',
				'types'    => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .pgfy-nav-header',
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
			'header_padding',
			[
				'label'      => esc_html__( 'Padding', 'pagifye-elementor-widgets' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'rem' ],
				'default'    => [
					'top'      => '16',
					'right'    => '0',
					'bottom'   => '16',
					'left'     => '0',
					'unit'     => 'px',
					'isLinked' => false,
				],
				'selectors'  => [
					'{{WRAPPER}} .pgfy-nav-header' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'text_color',
			[
				'label'     => esc_html__( 'Text Color', 'pagifye-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#FFFFFF',
				'selectors' => [
					'{{WRAPPER}} .pgfy-nav-header' => 'color: {{VALUE}};',
					'{{WRAPPER}} .pgfy-nav-link' => 'color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();

		// Menu Style
		$this->start_controls_section(
			'menu_style',
			[
				'label' => esc_html__( 'Menu', 'pagifye-elementor-widgets' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'menu_typography',
				'selector' => '{{WRAPPER}} .pgfy-nav-link',
			]
		);

		$this->add_responsive_control(
			'menu_gap',
			[
				'label'      => esc_html__( 'Gap Between Items', 'pagifye-elementor-widgets' ),
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
					'{{WRAPPER}} .pgfy-nav-menu' => 'gap: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		// Dropdown Style
		$this->start_controls_section(
			'dropdown_style',
			[
				'label' => esc_html__( 'Dropdown', 'pagifye-elementor-widgets' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'dropdown_bg',
			[
				'label'     => esc_html__( 'Background Color', 'pagifye-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#1A2E27',
				'selectors' => [
					'{{WRAPPER}} .pgfy-nav-dropdown' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'dropdown_hover_bg',
			[
				'label'     => esc_html__( 'Hover Background Color', 'pagifye-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#8FE35F',
				'selectors' => [
					'{{WRAPPER}} .pgfy-nav-dropdown-item:hover' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'dropdown_hover_color',
			[
				'label'     => esc_html__( 'Hover Text Color', 'pagifye-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#0F2C24',
				'selectors' => [
					'{{WRAPPER}} .pgfy-nav-dropdown-item:hover' => 'color: {{VALUE}};',
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

		$this->start_controls_tabs( 'button_tabs' );

		// Primary Button
		$this->start_controls_tab(
			'button_primary',
			[
				'label' => esc_html__( 'Primary', 'pagifye-elementor-widgets' ),
			]
		);

		$this->add_control(
			'button_primary_bg',
			[
				'label'     => esc_html__( 'Background Color', 'pagifye-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#8FE35F',
				'selectors' => [
					'{{WRAPPER}} .pgfy-nav-btn-primary' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'button_primary_color',
			[
				'label'     => esc_html__( 'Text Color', 'pagifye-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#0F2C24',
				'selectors' => [
					'{{WRAPPER}} .pgfy-nav-btn-primary' => 'color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		// Secondary Button
		$this->start_controls_tab(
			'button_secondary',
			[
				'label' => esc_html__( 'Secondary', 'pagifye-elementor-widgets' ),
			]
		);

		$this->add_control(
			'button_secondary_border',
			[
				'label'     => esc_html__( 'Border Color', 'pagifye-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#8FE35F',
				'selectors' => [
					'{{WRAPPER}} .pgfy-nav-btn-secondary' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'button_secondary_color',
			[
				'label'     => esc_html__( 'Text Color', 'pagifye-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#FFFFFF',
				'selectors' => [
					'{{WRAPPER}} .pgfy-nav-btn-secondary' => 'color: {{VALUE}};',
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

		$breakpoint_class = ( '768' === $settings['mobile_breakpoint'] ) ? 'md' : 'lg';
		$widget_id = $this->get_id();
		?>

		<header class="pgfy-nav-header" style="position: relative; display: flex; align-items: center; justify-content: space-between; font-weight: 500;">

			<!-- Desktop Navigation -->
			<div class="container" style="display: flex; align-items: center; justify-content: space-between;">

				<!-- Logo -->
				<?php
				$this->add_link_attributes( 'logo_link', $settings['logo_link'] );
				?>
				<a <?php echo $this->get_render_attribute_string( 'logo_link' ); ?>>
					<?php if ( 'image' === $settings['logo_type'] && ! empty( $settings['logo_image']['url'] ) ) : ?>
						<img src="<?php echo esc_url( $settings['logo_image']['url'] ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>" style="max-height: 40px;">
					<?php elseif ( 'text' === $settings['logo_type'] ) : ?>
						<span style="font-size: 24px; font-weight: 700;"><?php echo esc_html( $settings['logo_text'] ); ?></span>
					<?php endif; ?>
				</a>

				<!-- Desktop Menu -->
				<nav class="pgfy-nav-desktop" style="display: block;">
					<ul class="pgfy-nav-menu" style="display: flex; list-style: none; margin: 0; padding: 0;">
						<?php foreach ( $settings['menu_items'] as $index => $item ) : ?>
							<li style="position: relative; <?php echo ( 'yes' === $item['has_dropdown'] ) ? 'group' : ''; ?>">
								<?php
								$this->add_link_attributes( 'menu_link_' . $index, $item['menu_link'] );
								?>
								<a <?php echo $this->get_render_attribute_string( 'menu_link_' . $index ); ?> class="pgfy-nav-link" style="display: flex; align-items: center; gap: 4px; text-decoration: none; transition: color 0.3s ease;">
									<?php echo esc_html( $item['menu_text'] ); ?>
									<?php if ( 'yes' === $item['has_dropdown'] ) : ?>
										<svg width="16" height="16" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg" class="pgfy-dropdown-icon" style="transition: transform 0.3s ease;">
											<path d="M2.5 4.5L6 8L9.5 4.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
										</svg>
									<?php endif; ?>
								</a>

								<?php if ( 'yes' === $item['has_dropdown'] && ! empty( $item['dropdown_items'] ) ) : ?>
									<div class="pgfy-nav-dropdown" style="position: absolute; left: 0; top: 100%; z-index: 50; min-width: 200px; border-radius: 8px; padding: 16px; opacity: 0; visibility: hidden; transition: all 0.3s ease; box-shadow: 0 10px 25px rgba(0,0,0,0.2);">
										<ul style="display: flex; flex-direction: column; gap: 8px; list-style: none; margin: 0; padding: 0;">
											<?php
											$dropdown_lines = explode( "\n", $item['dropdown_items'] );
											foreach ( $dropdown_lines as $line ) :
												$line = trim( $line );
												if ( empty( $line ) ) {
													continue;
												}
												?>
												<li>
													<a href="#" class="pgfy-nav-dropdown-item" style="display: block; border-radius: 8px; padding: 8px 12px; transition: all 0.3s ease; text-decoration: none; color: inherit;">
														<?php echo esc_html( $line ); ?>
													</a>
												</li>
											<?php endforeach; ?>
										</ul>
									</div>
								<?php endif; ?>
							</li>
						<?php endforeach; ?>
					</ul>
				</nav>

				<!-- Desktop CTA Buttons -->
				<div class="pgfy-nav-cta" style="display: flex; gap: 24px;">
					<?php foreach ( $settings['cta_buttons'] as $index => $button ) : ?>
						<?php
						$button_class = ( 'primary' === $button['button_style'] ) ? 'pgfy-nav-btn-primary' : 'pgfy-nav-btn-secondary';
						$button_style = ( 'secondary' === $button['button_style'] ) ? 'border: 1px solid;' : '';
						$this->add_link_attributes( 'cta_button_' . $index, $button['button_link'] );
						?>
						<a <?php echo $this->get_render_attribute_string( 'cta_button_' . $index ); ?> class="<?php echo esc_attr( $button_class ); ?>" style="display: inline-flex; align-items: center; justify-content: center; padding: 12px 32px; border-radius: 9999px; font-size: 16px; font-weight: 700; text-decoration: none; transition: all 0.3s ease; <?php echo esc_attr( $button_style ); ?>">
							<?php echo esc_html( $button['button_text'] ); ?>
						</a>
					<?php endforeach; ?>
				</div>
			</div>

			<!-- Mobile Navigation -->
			<div class="pgfy-nav-mobile" style="display: none;" x-data="{ isOpen: false }">
				<!-- Mobile CTA Button -->
				<?php if ( ! empty( $settings['cta_buttons'][0] ) ) : ?>
					<?php
					$mobile_button = $settings['cta_buttons'][0];
					$this->add_link_attributes( 'mobile_cta', $mobile_button['button_link'] );
					?>
					<a <?php echo $this->get_render_attribute_string( 'mobile_cta' ); ?> class="pgfy-nav-btn-primary" style="margin-right: 16px; display: inline-flex; padding: 8px 16px; border-radius: 9999px; font-size: 16px; font-weight: 700; text-decoration: none; transition: all 0.3s ease;">
						<?php echo esc_html( $mobile_button['button_text'] ); ?>
					</a>
				<?php endif; ?>

				<!-- Hamburger Menu Button -->
				<button @click="isOpen = !isOpen" style="position: relative; z-index: 10; background: none; border: none; cursor: pointer; padding: 8px;">
					<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M4 6H20M4 12H20M4 18H20" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
					</svg>
				</button>

				<!-- Mobile Menu Panel -->
				<div x-show="isOpen" x-transition style="display: none; position: absolute; left: 0; right: 0; top: 70px; z-index: 20; height: calc(100vh - 72px); width: 100%; background-color: inherit; padding: 16px; overflow-y: auto;">
					<div style="display: flex; flex-direction: column; justify-content: space-between; height: 100%;">

						<!-- Mobile Menu Items -->
						<ul style="display: flex; flex-direction: column; gap: 16px; padding-top: 24px; list-style: none; margin: 0; padding: 0;">
							<?php
							$mobile_items = explode( "\n", $settings['mobile_menu_items_text'] );
							foreach ( $mobile_items as $item ) :
								$item = trim( $item );
								if ( empty( $item ) ) {
									continue;
								}
								?>
								<li>
									<a href="#" style="display: block; font-weight: 700; text-decoration: none; color: inherit; transition: color 0.3s ease;">
										<?php echo esc_html( $item ); ?>
									</a>
								</li>
							<?php endforeach; ?>
						</ul>

						<!-- Mobile CTA Buttons -->
						<div style="display: flex; flex-wrap: wrap; gap: 16px; width: 100%;">
							<?php foreach ( $settings['cta_buttons'] as $index => $button ) : ?>
								<?php
								$button_class = ( 'primary' === $button['button_style'] ) ? 'pgfy-nav-btn-primary' : 'pgfy-nav-btn-secondary';
								$button_style = ( 'secondary' === $button['button_style'] ) ? 'border: 1px solid;' : '';
								$this->add_link_attributes( 'mobile_button_' . $index, $button['button_link'] );
								?>
								<a <?php echo $this->get_render_attribute_string( 'mobile_button_' . $index ); ?> class="<?php echo esc_attr( $button_class ); ?>" style="flex: 1; min-width: 100%; display: inline-flex; align-items: center; justify-content: center; padding: 12px 32px; border-radius: 9999px; font-size: 16px; font-weight: 700; text-decoration: none; transition: all 0.3s ease; <?php echo esc_attr( $button_style ); ?>">
									<?php echo esc_html( $button['button_text'] ); ?>
								</a>
							<?php endforeach; ?>
						</div>
					</div>
				</div>
			</div>

		</header>

		<style>
			/* Desktop/Mobile Toggle */
			@media (max-width: <?php echo esc_attr( $settings['mobile_breakpoint'] ); ?>px) {
				.pgfy-nav-desktop,
				.pgfy-nav-cta {
					display: none !important;
				}
				.pgfy-nav-mobile {
					display: flex !important;
					align-items: center;
				}
			}

			/* Dropdown Hover Effect */
			li:hover > .pgfy-nav-dropdown {
				opacity: 1 !important;
				visibility: visible !important;
			}
			li:hover .pgfy-dropdown-icon {
				transform: rotate(180deg);
			}
		</style>

		<?php
	}
}
