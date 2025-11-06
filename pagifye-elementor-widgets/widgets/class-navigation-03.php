<?php
/**
 * Navigation-03 Widget
 *
 * Rounded navigation header with logo, menu, theme toggle, and CTA buttons.
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
use Elementor\Utils;

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Navigation-03 Widget Class
 */
class Navigation_03 extends Base_Widget {

	/**
	 * Get widget name
	 */
	public function get_name() {
		return 'pagifye-navigation-03';
	}

	/**
	 * Get widget title
	 */
	public function get_title() {
		return esc_html__( 'Navigation 03', 'pagifye-elementor-widgets' );
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
		return [ 'pagifye', 'navigation', 'menu', 'header', 'navbar', 'rounded' ];
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
				'label'     => esc_html__( 'Logo Text', 'pagifye-elementor-widgets' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => esc_html__( 'Logo', 'pagifye-elementor-widgets' ),
				'condition' => [
					'logo_type' => 'text',
				],
			]
		);

		$this->add_control(
			'logo_link',
			[
				'label'   => esc_html__( 'Logo Link', 'pagifye-elementor-widgets' ),
				'type'    => Controls_Manager::URL,
				'default' => [
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

		$repeater = new Repeater();

		$repeater->add_control(
			'menu_text',
			[
				'label'   => esc_html__( 'Menu Text', 'pagifye-elementor-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => esc_html__( 'Menu Item', 'pagifye-elementor-widgets' ),
			]
		);

		$repeater->add_control(
			'menu_link',
			[
				'label' => esc_html__( 'Link', 'pagifye-elementor-widgets' ),
				'type'  => Controls_Manager::URL,
			]
		);

		$repeater->add_control(
			'has_dropdown',
			[
				'label'        => esc_html__( 'Has Dropdown', 'pagifye-elementor-widgets' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Yes', 'pagifye-elementor-widgets' ),
				'label_off'    => esc_html__( 'No', 'pagifye-elementor-widgets' ),
				'return_value' => 'yes',
				'default'      => 'no',
			]
		);

		$repeater->add_control(
			'dropdown_items',
			[
				'label'     => esc_html__( 'Dropdown Items', 'pagifye-elementor-widgets' ),
				'type'      => Controls_Manager::TEXTAREA,
				'rows'      => 4,
				'default'   => "Overview|#\nFeatures|#\nSolutions|#",
				'description' => esc_html__( 'Format: Text|URL (one per line)', 'pagifye-elementor-widgets' ),
				'condition' => [
					'has_dropdown' => 'yes',
				],
			]
		);

		$this->add_control(
			'menu_items',
			[
				'label'       => esc_html__( 'Menu Items', 'pagifye-elementor-widgets' ),
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'default'     => [
					[
						'menu_text' => esc_html__( 'Home', 'pagifye-elementor-widgets' ),
						'menu_link' => [ 'url' => '#' ],
					],
					[
						'menu_text'      => esc_html__( 'Product', 'pagifye-elementor-widgets' ),
						'menu_link'      => [ 'url' => '#' ],
						'has_dropdown'   => 'yes',
						'dropdown_items' => "Overview|#\nFeatures|#\nSolutions|#\nIntegrations|#",
					],
					[
						'menu_text' => esc_html__( 'Solutions', 'pagifye-elementor-widgets' ),
						'menu_link' => [ 'url' => '#' ],
					],
					[
						'menu_text' => esc_html__( 'Pricing', 'pagifye-elementor-widgets' ),
						'menu_link' => [ 'url' => '#' ],
					],
					[
						'menu_text' => esc_html__( 'Blogs', 'pagifye-elementor-widgets' ),
						'menu_link' => [ 'url' => '#' ],
					],
				],
				'title_field' => '{{{ menu_text }}}',
			]
		);

		$this->end_controls_section();

		// Theme Toggle Section
		$this->start_controls_section(
			'section_theme_toggle',
			[
				'label' => esc_html__( 'Theme Toggle', 'pagifye-elementor-widgets' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'show_theme_toggle',
			[
				'label'        => esc_html__( 'Show Theme Toggle', 'pagifye-elementor-widgets' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Yes', 'pagifye-elementor-widgets' ),
				'label_off'    => esc_html__( 'No', 'pagifye-elementor-widgets' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			]
		);

		$this->add_control(
			'light_icon',
			[
				'label'     => esc_html__( 'Light Icon', 'pagifye-elementor-widgets' ),
				'type'      => Controls_Manager::MEDIA,
				'default'   => [
					'url' => 'https://static.pagifye.com/root/images/navbar/sun-light.svg',
				],
				'condition' => [
					'show_theme_toggle' => 'yes',
				],
			]
		);

		$this->add_control(
			'dark_icon',
			[
				'label'     => esc_html__( 'Dark Icon', 'pagifye-elementor-widgets' ),
				'type'      => Controls_Manager::MEDIA,
				'default'   => [
					'url' => 'https://static.pagifye.com/root/images/navbar/moon-light.svg',
				],
				'condition' => [
					'show_theme_toggle' => 'yes',
				],
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

		$this->add_control(
			'show_sign_in',
			[
				'label'        => esc_html__( 'Show Sign In Button', 'pagifye-elementor-widgets' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Yes', 'pagifye-elementor-widgets' ),
				'label_off'    => esc_html__( 'No', 'pagifye-elementor-widgets' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			]
		);

		$this->add_control(
			'sign_in_text',
			[
				'label'     => esc_html__( 'Sign In Text', 'pagifye-elementor-widgets' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => esc_html__( 'Sign In', 'pagifye-elementor-widgets' ),
				'condition' => [
					'show_sign_in' => 'yes',
				],
			]
		);

		$this->add_control(
			'sign_in_link',
			[
				'label'     => esc_html__( 'Sign In Link', 'pagifye-elementor-widgets' ),
				'type'      => Controls_Manager::URL,
				'default'   => [
					'url' => '#',
				],
				'condition' => [
					'show_sign_in' => 'yes',
				],
			]
		);

		$this->add_control(
			'show_get_started',
			[
				'label'        => esc_html__( 'Show Get Started Button', 'pagifye-elementor-widgets' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Yes', 'pagifye-elementor-widgets' ),
				'label_off'    => esc_html__( 'No', 'pagifye-elementor-widgets' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			]
		);

		$this->add_control(
			'get_started_text',
			[
				'label'     => esc_html__( 'Get Started Text', 'pagifye-elementor-widgets' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => esc_html__( 'Get Started', 'pagifye-elementor-widgets' ),
				'condition' => [
					'show_get_started' => 'yes',
				],
			]
		);

		$this->add_control(
			'get_started_link',
			[
				'label'     => esc_html__( 'Get Started Link', 'pagifye-elementor-widgets' ),
				'type'      => Controls_Manager::URL,
				'default'   => [
					'url' => '#',
				],
				'condition' => [
					'show_get_started' => 'yes',
				],
			]
		);

		$this->end_controls_section();

		// Mobile Menu Section
		$this->start_controls_section(
			'section_mobile_menu',
			[
				'label' => esc_html__( 'Mobile Menu', 'pagifye-elementor-widgets' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);

		$mobile_repeater = new Repeater();

		$mobile_repeater->add_control(
			'mobile_menu_text',
			[
				'label'   => esc_html__( 'Menu Text', 'pagifye-elementor-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => esc_html__( 'Menu Item', 'pagifye-elementor-widgets' ),
			]
		);

		$mobile_repeater->add_control(
			'mobile_menu_link',
			[
				'label' => esc_html__( 'Link', 'pagifye-elementor-widgets' ),
				'type'  => Controls_Manager::URL,
			]
		);

		$this->add_control(
			'mobile_menu_items',
			[
				'label'       => esc_html__( 'Mobile Menu Items', 'pagifye-elementor-widgets' ),
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $mobile_repeater->get_controls(),
				'default'     => [
					[
						'mobile_menu_text' => esc_html__( 'Home', 'pagifye-elementor-widgets' ),
						'mobile_menu_link' => [ 'url' => '#' ],
					],
					[
						'mobile_menu_text' => esc_html__( 'About us', 'pagifye-elementor-widgets' ),
						'mobile_menu_link' => [ 'url' => '#' ],
					],
					[
						'mobile_menu_text' => esc_html__( 'How it works', 'pagifye-elementor-widgets' ),
						'mobile_menu_link' => [ 'url' => '#' ],
					],
					[
						'mobile_menu_text' => esc_html__( 'Case Study', 'pagifye-elementor-widgets' ),
						'mobile_menu_link' => [ 'url' => '#' ],
					],
					[
						'mobile_menu_text' => esc_html__( 'Service', 'pagifye-elementor-widgets' ),
						'mobile_menu_link' => [ 'url' => '#' ],
					],
				],
				'title_field' => '{{{ mobile_menu_text }}}',
			]
		);

		$this->add_control(
			'mobile_menu_icon',
			[
				'label'   => esc_html__( 'Hamburger Icon', 'pagifye-elementor-widgets' ),
				'type'    => Controls_Manager::MEDIA,
				'default' => [
					'url' => 'https://static.pagifye.com/root/images/navbar/burger-menu-white.svg',
				],
			]
		);

		$this->end_controls_section();
	}

	/**
	 * Register style controls
	 */
	private function register_style_controls() {
		// Navigation Container Style
		$this->start_controls_section(
			'section_style_container',
			[
				'label' => esc_html__( 'Navigation Container', 'pagifye-elementor-widgets' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'     => 'container_background',
				'types'    => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .pagifye-nav-03-container',
			]
		);

		$this->add_control(
			'container_padding',
			[
				'label'      => esc_html__( 'Padding', 'pagifye-elementor-widgets' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .pagifye-nav-03-container' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'container_border_radius',
			[
				'label'      => esc_html__( 'Border Radius', 'pagifye-elementor-widgets' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .pagifye-nav-03-container' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		// Logo Style
		$this->start_controls_section(
			'section_style_logo',
			[
				'label' => esc_html__( 'Logo', 'pagifye-elementor-widgets' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'logo_width',
			[
				'label'      => esc_html__( 'Width', 'pagifye-elementor-widgets' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range'      => [
					'px' => [
						'min' => 20,
						'max' => 300,
					],
					'%'  => [
						'min' => 10,
						'max' => 100,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .pagifye-nav-03-logo img' => 'width: {{SIZE}}{{UNIT}};',
				],
				'condition'  => [
					'logo_type' => 'image',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'      => 'logo_typography',
				'selector'  => '{{WRAPPER}} .pagifye-nav-03-logo-text',
				'condition' => [
					'logo_type' => 'text',
				],
			]
		);

		$this->add_control(
			'logo_color',
			[
				'label'     => esc_html__( 'Color', 'pagifye-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .pagifye-nav-03-logo-text' => 'color: {{VALUE}};',
				],
				'condition' => [
					'logo_type' => 'text',
				],
			]
		);

		$this->end_controls_section();

		// Menu Items Style
		$this->start_controls_section(
			'section_style_menu',
			[
				'label' => esc_html__( 'Menu Items', 'pagifye-elementor-widgets' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'menu_typography',
				'selector' => '{{WRAPPER}} .pagifye-nav-03-menu a',
			]
		);

		$this->add_control(
			'menu_color',
			[
				'label'     => esc_html__( 'Text Color', 'pagifye-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .pagifye-nav-03-menu a' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'menu_spacing',
			[
				'label'      => esc_html__( 'Item Spacing', 'pagifye-elementor-widgets' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .pagifye-nav-03-menu' => 'gap: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		// Dropdown Style
		$this->start_controls_section(
			'section_style_dropdown',
			[
				'label' => esc_html__( 'Dropdown', 'pagifye-elementor-widgets' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'     => 'dropdown_background',
				'types'    => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .pagifye-nav-03-dropdown',
			]
		);

		$this->add_control(
			'dropdown_item_hover_bg',
			[
				'label'     => esc_html__( 'Item Hover Background', 'pagifye-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .pagifye-nav-03-dropdown a:hover' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'dropdown_item_hover_color',
			[
				'label'     => esc_html__( 'Item Hover Color', 'pagifye-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .pagifye-nav-03-dropdown a:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();

		// CTA Buttons Style
		$this->start_controls_section(
			'section_style_buttons',
			[
				'label' => esc_html__( 'CTA Buttons', 'pagifye-elementor-widgets' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'sign_in_heading',
			[
				'label'     => esc_html__( 'Sign In Button', 'pagifye-elementor-widgets' ),
				'type'      => Controls_Manager::HEADING,
				'condition' => [
					'show_sign_in' => 'yes',
				],
			]
		);

		$this->add_control(
			'sign_in_bg',
			[
				'label'     => esc_html__( 'Background Color', 'pagifye-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .pagifye-nav-03-btn-sign-in' => 'background-color: {{VALUE}};',
				],
				'condition' => [
					'show_sign_in' => 'yes',
				],
			]
		);

		$this->add_control(
			'sign_in_color',
			[
				'label'     => esc_html__( 'Text Color', 'pagifye-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .pagifye-nav-03-btn-sign-in' => 'color: {{VALUE}};',
				],
				'condition' => [
					'show_sign_in' => 'yes',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'      => 'sign_in_border',
				'selector'  => '{{WRAPPER}} .pagifye-nav-03-btn-sign-in',
				'condition' => [
					'show_sign_in' => 'yes',
				],
			]
		);

		$this->add_control(
			'get_started_heading',
			[
				'label'     => esc_html__( 'Get Started Button', 'pagifye-elementor-widgets' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => [
					'show_get_started' => 'yes',
				],
			]
		);

		$this->add_control(
			'get_started_bg',
			[
				'label'     => esc_html__( 'Background Color', 'pagifye-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .pagifye-nav-03-btn-get-started' => 'background-color: {{VALUE}};',
				],
				'condition' => [
					'show_get_started' => 'yes',
				],
			]
		);

		$this->add_control(
			'get_started_color',
			[
				'label'     => esc_html__( 'Text Color', 'pagifye-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .pagifye-nav-03-btn-get-started' => 'color: {{VALUE}};',
				],
				'condition' => [
					'show_get_started' => 'yes',
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
		?>
		<section class="min-h-screen">
			<header class="container relative">
				<div class="pagifye-nav-03-container flex items-center justify-between rounded-full px-6 py-4 font-medium max-lg:pr-4 bg-pgfy-gray-500 text-white">
					<!-- Desktop -->
					<div class="flex w-full items-center lg:justify-between">
						<!-- Logo -->
						<a href="<?php echo esc_url( $settings['logo_link']['url'] ); ?>" class="pagifye-nav-03-logo">
							<?php if ( 'image' === $settings['logo_type'] && ! empty( $settings['logo_image']['url'] ) ) : ?>
								<img src="<?php echo esc_url( $settings['logo_image']['url'] ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>">
							<?php else : ?>
								<span class="pagifye-nav-03-logo-text"><?php echo esc_html( $settings['logo_text'] ); ?></span>
							<?php endif; ?>
						</a>

						<!-- Desktop Menu -->
						<nav>
							<ul class="pagifye-nav-03-menu flex gap-6 max-lg:hidden">
								<?php foreach ( $settings['menu_items'] as $item ) : ?>
									<li class="<?php echo 'yes' === $item['has_dropdown'] ? 'group relative' : ''; ?>">
										<a href="<?php echo esc_url( $item['menu_link']['url'] ); ?>" class="flex items-center gap-1">
											<?php echo esc_html( $item['menu_text'] ); ?>
											<?php if ( 'yes' === $item['has_dropdown'] ) : ?>
												<svg width="16" height="16" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg" class="transition-transform duration-300 group-hover:rotate-180">
													<path d="M2.5 4.5L6 8L9.5 4.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
												</svg>
											<?php endif; ?>
										</a>

										<?php if ( 'yes' === $item['has_dropdown'] && ! empty( $item['dropdown_items'] ) ) : ?>
											<div class="pagifye-nav-03-dropdown invisible absolute left-0 top-full z-50 min-w-[200px] rounded-lg p-4 opacity-0 shadow-lg transition-all duration-300 group-hover:visible group-hover:opacity-100 bg-pgfy-gray-400">
												<ul class="flex flex-col gap-2">
													<?php
													$dropdown_lines = explode( "\n", $item['dropdown_items'] );
													foreach ( $dropdown_lines as $line ) {
														$parts = explode( '|', $line );
														if ( count( $parts ) === 2 ) {
															$text = trim( $parts[0] );
															$url  = trim( $parts[1] );
															?>
															<li>
																<a href="<?php echo esc_url( $url ); ?>" class="block rounded-lg px-3 py-2 transition-colors hover:bg-pgfy-primary-500 hover:text-pgfy-gray-500">
																	<?php echo esc_html( $text ); ?>
																</a>
															</li>
															<?php
														}
													}
													?>
												</ul>
											</div>
										<?php endif; ?>
									</li>
								<?php endforeach; ?>
							</ul>
						</nav>

						<!-- Desktop Buttons -->
						<div class="flex items-center gap-6 max-lg:hidden">
							<?php if ( 'yes' === $settings['show_theme_toggle'] ) : ?>
								<!-- Theme Toggle -->
								<div class="flex items-center gap-1.5 rounded-full border p-[2px] border-white/10">
									<button class="rounded-full p-[2px] bg-pgfy-gray-400">
										<img src="<?php echo esc_url( $settings['light_icon']['url'] ); ?>" alt="" class="max-h-4 min-h-4 min-w-4 max-w-4">
									</button>
									<button>
										<img src="<?php echo esc_url( $settings['dark_icon']['url'] ); ?>" alt="" class="max-h-4 min-h-4 min-w-4 max-w-4">
									</button>
								</div>
							<?php endif; ?>

							<?php if ( 'yes' === $settings['show_sign_in'] ) : ?>
								<a href="<?php echo esc_url( $settings['sign_in_link']['url'] ); ?>" class="pagifye-nav-03-btn-sign-in group flex select-none items-center justify-center gap-1 text-nowrap rounded-full border text-base font-bold transition duration-300 ease-in-out max-lg:w-full sm:w-max px-8 py-3 border-pgfy-primary-500 text-white hover:bg-pgfy-primary-500 hover:text-pgfy-gray-400">
									<span><?php echo esc_html( $settings['sign_in_text'] ); ?></span>
								</a>
							<?php endif; ?>

							<?php if ( 'yes' === $settings['show_get_started'] ) : ?>
								<a href="<?php echo esc_url( $settings['get_started_link']['url'] ); ?>" class="pagifye-nav-03-btn-get-started group flex select-none items-center justify-center gap-1 text-nowrap rounded-full text-base font-bold transition duration-300 ease-in-out max-lg:w-full sm:w-max px-8 py-3 bg-pgfy-primary-500 text-pgfy-gray-500 hover:bg-pgfy-primary-600">
									<span><?php echo esc_html( $settings['get_started_text'] ); ?></span>
								</a>
							<?php endif; ?>
						</div>
					</div>

					<!-- Mobile Menu -->
					<div x-data="{ isOpen: false }" class="flex lg:hidden">
						<button @click="isOpen = !isOpen">
							<img src="<?php echo esc_url( $settings['mobile_menu_icon']['url'] ); ?>" alt="" class="min-h-6 min-w-6">
						</button>

						<div x-show="isOpen" class="" style="display: none;">
							<div class="absolute left-1/2 top-[86px] z-20 flex h-[calc(100vh-90px)] w-[calc(100vw-32px)] -translate-x-1/2 flex-col justify-between overflow-y-auto rounded-2xl px-4 pb-4 bg-pgfy-gray-500">
								<ul class="space-y-4 pt-6">
									<?php foreach ( $settings['mobile_menu_items'] as $item ) : ?>
										<li>
											<a href="<?php echo esc_url( $item['mobile_menu_link']['url'] ); ?>" class="block font-bold transition-colors text-white">
												<?php echo esc_html( $item['mobile_menu_text'] ); ?>
											</a>
										</li>
									<?php endforeach; ?>
								</ul>

								<div class="flex w-full flex-wrap gap-4 max-sm:flex-col">
									<?php if ( 'yes' === $settings['show_get_started'] ) : ?>
										<a href="<?php echo esc_url( $settings['get_started_link']['url'] ); ?>" class="select-none rounded-full px-8 py-3 text-base font-bold bg-pgfy-primary-500 text-pgfy-gray-500 transition duration-300 ease-in-out hover:bg-pgfy-primary-600">
											<?php echo esc_html( $settings['get_started_text'] ); ?>
										</a>
									<?php endif; ?>
									<?php if ( 'yes' === $settings['show_sign_in'] ) : ?>
										<a href="<?php echo esc_url( $settings['sign_in_link']['url'] ); ?>" class="select-none rounded-full border border-pgfy-primary-500 bg-pgfy-gray-400 text-white px-8 py-3 text-base font-bold">
											<?php echo esc_html( $settings['sign_in_text'] ); ?>
										</a>
									<?php endif; ?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</header>
		</section>
		<?php
	}
}
