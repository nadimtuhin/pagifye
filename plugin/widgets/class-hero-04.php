<?php
/**
 * Hero-04 Widget
 *
 * Two-column hero layout with title, description, CTA buttons and video thumbnail.
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
 * Hero-04 Widget Class
 */
class Hero_04 extends Base_Widget {

	/**
	 * Get widget name
	 */
	public function get_name() {
		return 'pagifye-hero-04';
	}

	/**
	 * Get widget title
	 */
	public function get_title() {
		return esc_html__( 'Hero 04', 'pagifye-elementor-widgets' );
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
		return [ 'pagifye', 'hero', 'banner', 'video', 'cta' ];
	}

	/**
	 * Register widget controls
	 */
	protected function register_controls() {
		// Hero Content Section
		$this->start_controls_section(
			'section_content',
			[
				'label' => esc_html__( 'Hero Content', 'pagifye-elementor-widgets' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'heading_parts',
			[
				'label'       => esc_html__( 'Heading Text', 'pagifye-elementor-widgets' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => esc_html__( 'Unleashing the Power of AI for {Business Success}', 'pagifye-elementor-widgets' ),
				'description' => esc_html__( 'Use {curly braces} around text to highlight it', 'pagifye-elementor-widgets' ),
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
					'h1' => 'H1',
					'h2' => 'H2',
					'h3' => 'H3',
					'h4' => 'H4',
					'h5' => 'H5',
					'h6' => 'H6',
				],
				'default' => 'h1',
			]
		);

		$this->add_control(
			'description',
			[
				'label'       => esc_html__( 'Description', 'pagifye-elementor-widgets' ),
				'type'        => Controls_Manager::TEXTAREA,
				'default'     => esc_html__( 'Our innovative AI solutions are meticulously crafted to optimize operations, drive efficiency, and unlock new opportunities for growth.', 'pagifye-elementor-widgets' ),
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
				'label'   => esc_html__( 'Link', 'pagifye-elementor-widgets' ),
				'type'    => Controls_Manager::URL,
				'default' => [
					'url' => '#',
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
					'secondary' => esc_html__( 'Secondary', 'pagifye-elementor-widgets' ),
				],
				'default' => 'primary',
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
					],
					[
						'button_text' => esc_html__( 'Learn More', 'pagifye-elementor-widgets' ),
						'button_type' => 'secondary',
					],
				],
				'title_field' => '{{{ button_text }}}',
			]
		);

		$this->end_controls_section();

		// Video Section
		$this->start_controls_section(
			'section_video',
			[
				'label' => esc_html__( 'Video/Image', 'pagifye-elementor-widgets' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'video_thumbnail',
			[
				'label'   => esc_html__( 'Video Thumbnail', 'pagifye-elementor-widgets' ),
				'type'    => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
			]
		);

		$this->add_control(
			'video_url',
			[
				'label'       => esc_html__( 'Video URL', 'pagifye-elementor-widgets' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => '',
				'placeholder' => 'https://youtube.com/watch?v=...',
			]
		);

		$this->end_controls_section();

		// Style Controls
		$this->register_style_controls();
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
				'label'     => esc_html__( 'Color', 'pagifye-elementor-widgets' ),
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
				'label'     => esc_html__( 'Highlight Color', 'pagifye-elementor-widgets' ),
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

		$this->end_controls_section();
	}

	/**
	 * Render widget output
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();

		// Parse heading text with highlight
		$heading_html = '';
		if ( ! empty( $settings['heading_parts'] ) ) {
			$text = $settings['heading_parts'];
			$heading_html = esc_html( $text );
			$heading_html = preg_replace(
				'/\{([^}]+)\}/',
				'<span class="pgfy-hero-heading-highlight">$1</span>',
				$heading_html
			);
		}
		?>

		<section class="pgfy-hero-section" style="padding: 40px 0;">
			<div class="container">
				<div style="display: flex; flex-direction: column; gap: 32px;">

					<!-- Title and Description Row -->
					<div style="display: flex; gap: 58px; align-items: center; flex-wrap: wrap;">

						<!-- Title -->
						<div style="flex: 1 1 65%; min-width: 300px;">
							<?php if ( ! empty( $heading_html ) ) : ?>
								<<?php echo tag_escape( $settings['heading_tag'] ); ?> class="pgfy-hero-heading" style="font-size: 60px; font-weight: 700; line-height: 1.13; margin: 0;">
									<?php echo wp_kses_post( $heading_html ); ?>
								</<?php echo tag_escape( $settings['heading_tag'] ); ?>>
							<?php endif; ?>
						</div>

						<!-- Description and CTA -->
						<div style="flex: 1 1 35%; min-width: 300px; max-width: 424px; display: flex; flex-direction: column; gap: 24px;">
							<?php if ( ! empty( $settings['description'] ) ) : ?>
								<p style="font-size: 16px; color: #FFFFFF; margin: 0;">
									<?php echo esc_html( $settings['description'] ); ?>
								</p>
							<?php endif; ?>

							<?php if ( ! empty( $settings['buttons'] ) ) : ?>
								<div style="display: flex; gap: 16px; flex-wrap: wrap;">
									<?php foreach ( $settings['buttons'] as $index => $button ) : ?>
										<?php
										$this->add_link_attributes( 'button_' . $index, $button['button_link'] );
										$btn_style = 'display: inline-flex; align-items: center; justify-content: center; gap: 4px; padding: 8px 24px; border-radius: 9999px; font-weight: 700; font-size: 16px; text-decoration: none; transition: all 0.3s;';
										if ( 'primary' === $button['button_type'] ) {
											$btn_style .= ' background: #8FE35F; color: #0F2C24;';
										} else {
											$btn_style .= ' color: white; border: 1px solid #8FE35F;';
										}
										?>
										<a <?php echo $this->get_render_attribute_string( 'button_' . $index ); ?> style="<?php echo esc_attr( $btn_style ); ?>">
											<span><?php echo esc_html( $button['button_text'] ); ?></span>
										</a>
									<?php endforeach; ?>
								</div>
							<?php endif; ?>
						</div>

					</div>

					<!-- Video Thumbnail -->
					<?php if ( ! empty( $settings['video_thumbnail']['url'] ) ) : ?>
						<div style="position: relative; border-radius: 12px; overflow: hidden; max-height: 500px;">
							<img src="<?php echo esc_url( $settings['video_thumbnail']['url'] ); ?>" alt="<?php echo esc_attr__( 'Video', 'pagifye-elementor-widgets' ); ?>" style="width: 100%; height: auto; display: block; object-fit: cover;">
							<?php if ( ! empty( $settings['video_url'] ) ) : ?>
								<div style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); cursor: pointer;">
									<svg width="72" height="72" viewBox="0 0 72 72" fill="none" xmlns="http://www.w3.org/2000/svg">
										<circle cx="36" cy="36" r="36" fill="#8FE35F"/>
										<path d="M30 24L48 36L30 48V24Z" fill="#0F2C24"/>
									</svg>
								</div>
							<?php endif; ?>
						</div>
					<?php endif; ?>

				</div>
			</div>
		</section>

		<?php
	}
}
