<?php
/**
 * Testimonial-02 Widget
 *
 * Featured testimonial section with author image, quote, and avatar thumbnails.
 *
 * @package Pagifye_Elementor_Widgets
 */

namespace Pagifye\ElementorWidgets\Widgets;

use Pagifye\ElementorWidgets\Base_Widget;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Utils;

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Testimonial-02 Widget Class
 */
class Testimonial_02 extends Base_Widget {

	/**
	 * Get widget name
	 */
	public function get_name() {
		return 'pagifye-testimonial-02';
	}

	/**
	 * Get widget title
	 */
	public function get_title() {
		return esc_html__( 'Testimonial 02', 'pagifye-elementor-widgets' );
	}

	/**
	 * Get widget icon
	 */
	public function get_icon() {
		return 'eicon-testimonial';
	}

	/**
	 * Get widget keywords
	 */
	public function get_keywords() {
		return [ 'pagifye', 'testimonial', 'review', 'quote', 'client' ];
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
			'subtitle',
			[
				'label'       => esc_html__( 'Subtitle', 'pagifye-elementor-widgets' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => esc_html__( 'Testimonials', 'pagifye-elementor-widgets' ),
				'label_block' => true,
				'condition'   => [
					'show_heading' => 'yes',
				],
			]
		);

		$this->add_control(
			'heading_parts',
			[
				'label'       => esc_html__( 'Heading Text', 'pagifye-elementor-widgets' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => esc_html__( 'What Client say about {our Business}', 'pagifye-elementor-widgets' ),
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

		// Featured Image
		$this->start_controls_section(
			'section_featured_image',
			[
				'label' => esc_html__( 'Featured Image', 'pagifye-elementor-widgets' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'featured_image',
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
				'default' => 'left',
			]
		);

		$this->end_controls_section();

		// Testimonial Content
		$this->start_controls_section(
			'section_testimonial',
			[
				'label' => esc_html__( 'Testimonial Content', 'pagifye-elementor-widgets' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'show_logo',
			[
				'label'        => esc_html__( 'Show Company Logo/Icon', 'pagifye-elementor-widgets' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Show', 'pagifye-elementor-widgets' ),
				'label_off'    => esc_html__( 'Hide', 'pagifye-elementor-widgets' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			]
		);

		$this->add_control(
			'company_logo',
			[
				'label'     => esc_html__( 'Company Logo/Icon', 'pagifye-elementor-widgets' ),
				'type'      => Controls_Manager::MEDIA,
				'default'   => [
					'url' => '',
				],
				'condition' => [
					'show_logo' => 'yes',
				],
			]
		);

		$this->add_control(
			'quote_text',
			[
				'label'       => esc_html__( 'Quote Text', 'pagifye-elementor-widgets' ),
				'type'        => Controls_Manager::TEXTAREA,
				'default'     => esc_html__( '"I cannot thank Pagifye website builder enough for their exceptional service. From the moment I walked in, I felt welcomed and valued."', 'pagifye-elementor-widgets' ),
				'rows'        => 5,
				'dynamic'     => [ 'active' => true ],
			]
		);

		$this->add_control(
			'author_name',
			[
				'label'       => esc_html__( 'Author Name', 'pagifye-elementor-widgets' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => esc_html__( 'Amber Stone', 'pagifye-elementor-widgets' ),
				'label_block' => true,
				'dynamic'     => [ 'active' => true ],
			]
		);

		$this->add_control(
			'author_position',
			[
				'label'       => esc_html__( 'Author Position', 'pagifye-elementor-widgets' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => esc_html__( 'Head of Enterprise, UserTesting', 'pagifye-elementor-widgets' ),
				'label_block' => true,
				'dynamic'     => [ 'active' => true ],
			]
		);

		$this->end_controls_section();

		// Avatar Thumbnails
		$this->start_controls_section(
			'section_avatars',
			[
				'label' => esc_html__( 'Avatar Thumbnails', 'pagifye-elementor-widgets' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'show_avatars',
			[
				'label'        => esc_html__( 'Show Avatars', 'pagifye-elementor-widgets' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Show', 'pagifye-elementor-widgets' ),
				'label_off'    => esc_html__( 'Hide', 'pagifye-elementor-widgets' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			]
		);

		$this->add_control(
			'avatar_1',
			[
				'label'     => esc_html__( 'Avatar 1 (Active)', 'pagifye-elementor-widgets' ),
				'type'      => Controls_Manager::MEDIA,
				'default'   => [
					'url' => Utils::get_placeholder_image_src(),
				],
				'condition' => [
					'show_avatars' => 'yes',
				],
			]
		);

		$this->add_control(
			'avatar_2',
			[
				'label'     => esc_html__( 'Avatar 2', 'pagifye-elementor-widgets' ),
				'type'      => Controls_Manager::MEDIA,
				'default'   => [
					'url' => Utils::get_placeholder_image_src(),
				],
				'condition' => [
					'show_avatars' => 'yes',
				],
			]
		);

		$this->add_control(
			'avatar_3',
			[
				'label'     => esc_html__( 'Avatar 3', 'pagifye-elementor-widgets' ),
				'type'      => Controls_Manager::MEDIA,
				'default'   => [
					'url' => Utils::get_placeholder_image_src(),
				],
				'condition' => [
					'show_avatars' => 'yes',
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
				'selector' => '{{WRAPPER}} .pgfy-testimonial-section',
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
					'{{WRAPPER}} .pgfy-testimonial-section' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .pgfy-testimonial-section' => 'color: {{VALUE}};',
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
			'subtitle_color',
			[
				'label'     => esc_html__( 'Subtitle Color', 'pagifye-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#FFFFFF',
				'selectors' => [
					'{{WRAPPER}} .pgfy-testimonial-subtitle' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'subtitle_typography',
				'selector' => '{{WRAPPER}} .pgfy-testimonial-subtitle',
			]
		);

		$this->add_control(
			'heading_color',
			[
				'label'     => esc_html__( 'Heading Color', 'pagifye-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#FFFFFF',
				'selectors' => [
					'{{WRAPPER}} .pgfy-testimonial-heading' => 'color: {{VALUE}};',
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
					'{{WRAPPER}} .pgfy-testimonial-heading-highlight' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'heading_typography',
				'selector' => '{{WRAPPER}} .pgfy-testimonial-heading',
			]
		);

		$this->end_controls_section();

		// Featured Image Style
		$this->start_controls_section(
			'featured_image_style',
			[
				'label' => esc_html__( 'Featured Image', 'pagifye-elementor-widgets' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'image_width',
			[
				'label'      => esc_html__( 'Width', 'pagifye-elementor-widgets' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range'      => [
					'px' => [
						'min' => 200,
						'max' => 800,
					],
					'%' => [
						'min' => 20,
						'max' => 100,
					],
				],
				'default'    => [
					'size' => 470,
					'unit' => 'px',
				],
				'selectors'  => [
					'{{WRAPPER}} .pgfy-testimonial-image' => 'max-width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'image_height',
			[
				'label'      => esc_html__( 'Max Height', 'pagifye-elementor-widgets' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min' => 200,
						'max' => 800,
					],
				],
				'default'    => [
					'size' => 480,
					'unit' => 'px',
				],
				'selectors'  => [
					'{{WRAPPER}} .pgfy-testimonial-image' => 'max-height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'image_bg',
			[
				'label'     => esc_html__( 'Background Color', 'pagifye-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#1A2E27',
				'selectors' => [
					'{{WRAPPER}} .pgfy-testimonial-image' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'image_border_radius',
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
					'{{WRAPPER}} .pgfy-testimonial-image' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		// Quote Style
		$this->start_controls_section(
			'quote_style',
			[
				'label' => esc_html__( 'Quote', 'pagifye-elementor-widgets' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'quote_color',
			[
				'label'     => esc_html__( 'Color', 'pagifye-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#FFFFFF',
				'selectors' => [
					'{{WRAPPER}} .pgfy-testimonial-quote' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'quote_typography',
				'selector' => '{{WRAPPER}} .pgfy-testimonial-quote',
			]
		);

		$this->end_controls_section();

		// Author Style
		$this->start_controls_section(
			'author_style',
			[
				'label' => esc_html__( 'Author', 'pagifye-elementor-widgets' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'author_name_color',
			[
				'label'     => esc_html__( 'Name Color', 'pagifye-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#FFFFFF',
				'selectors' => [
					'{{WRAPPER}} .pgfy-testimonial-author-name' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'author_position_color',
			[
				'label'     => esc_html__( 'Position Color', 'pagifye-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#E5E5E5',
				'selectors' => [
					'{{WRAPPER}} .pgfy-testimonial-author-position' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'author_typography',
				'selector' => '{{WRAPPER}} .pgfy-testimonial-author',
			]
		);

		$this->end_controls_section();

		// Avatar Style
		$this->start_controls_section(
			'avatar_style',
			[
				'label'     => esc_html__( 'Avatars', 'pagifye-elementor-widgets' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'show_avatars' => 'yes',
				],
			]
		);

		$this->add_responsive_control(
			'avatar_size',
			[
				'label'      => esc_html__( 'Size', 'pagifye-elementor-widgets' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min' => 40,
						'max' => 120,
					],
				],
				'default'    => [
					'size' => 60,
					'unit' => 'px',
				],
				'selectors'  => [
					'{{WRAPPER}} .pgfy-testimonial-avatar' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'avatar_gap',
			[
				'label'      => esc_html__( 'Gap', 'pagifye-elementor-widgets' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
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
					'{{WRAPPER}} .pgfy-testimonial-avatars' => 'gap: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'avatar_border_color',
			[
				'label'     => esc_html__( 'Active Border Color', 'pagifye-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#8FE35F',
				'selectors' => [
					'{{WRAPPER}} .pgfy-testimonial-avatar-active' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'avatar_border_width',
			[
				'label'      => esc_html__( 'Active Border Width', 'pagifye-elementor-widgets' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min' => 1,
						'max' => 10,
					],
				],
				'default'    => [
					'size' => 2,
					'unit' => 'px',
				],
				'selectors'  => [
					'{{WRAPPER}} .pgfy-testimonial-avatar-active' => 'border-width: {{SIZE}}{{UNIT}};',
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

		// Parse heading text with highlight
		$heading_html = '';
		if ( ! empty( $settings['heading_parts'] ) ) {
			$text = $settings['heading_parts'];
			$heading_html = esc_html( $text );
			$heading_html = preg_replace(
				'/\{([^}]+)\}/',
				'<span class="pgfy-testimonial-heading-highlight">$1</span>',
				$heading_html
			);
		}

		$image_position = $settings['image_position'];
		$flex_direction = ( 'right' === $image_position ) ? 'row-reverse' : 'row';
		?>

		<section class="pgfy-testimonial-section">
			<div class="container">

				<!-- Section Heading -->
				<?php if ( 'yes' === $settings['show_heading'] ) : ?>
					<div style="margin: 0 auto 40px; max-width: 538px; text-align: center;">
						<?php if ( ! empty( $settings['subtitle'] ) ) : ?>
							<p class="pgfy-testimonial-subtitle" style="font-size: 16px; font-weight: 700; margin: 0 0 16px;">
								<?php echo esc_html( $settings['subtitle'] ); ?>
							</p>
						<?php endif; ?>

						<?php if ( ! empty( $heading_html ) ) : ?>
							<<?php echo tag_escape( $settings['heading_tag'] ); ?> class="pgfy-testimonial-heading" style="font-size: 48px; font-weight: 700; margin: 0;">
								<?php echo wp_kses_post( $heading_html ); ?>
							</<?php echo tag_escape( $settings['heading_tag'] ); ?>>
						<?php endif; ?>
					</div>
				<?php endif; ?>

				<!-- Testimonial Content -->
				<div style="display: flex; align-items: center; gap: 32px; flex-direction: <?php echo esc_attr( $flex_direction ); ?>; flex-wrap: wrap;">

					<!-- Featured Image -->
					<?php if ( ! empty( $settings['featured_image']['url'] ) ) : ?>
						<div class="pgfy-testimonial-image" style="display: flex; align-items: flex-end; justify-content: center; width: 100%; min-width: 370px; overflow: hidden;">
							<?php echo wp_get_attachment_image( $settings['featured_image']['id'], 'large', false, [ 'style' => 'width: 100%; height: 100%; object-fit: cover; object-position: bottom;' ] ); ?>
						</div>
					<?php endif; ?>

					<!-- Testimonial Text -->
					<div style="flex: 1; display: flex; flex-direction: column; gap: 32px;">

						<!-- Quote Content -->
						<div>
							<?php if ( 'yes' === $settings['show_logo'] && ! empty( $settings['company_logo']['url'] ) ) : ?>
								<img src="<?php echo esc_url( $settings['company_logo']['url'] ); ?>" alt="<?php echo esc_attr__( 'Company Logo', 'pagifye-elementor-widgets' ); ?>" style="max-height: 40px;">
							<?php endif; ?>

							<?php if ( ! empty( $settings['quote_text'] ) ) : ?>
								<p class="pgfy-testimonial-quote" style="font-size: 24px; font-weight: 700; font-style: italic; margin: <?php echo ( 'yes' === $settings['show_logo'] && ! empty( $settings['company_logo']['url'] ) ) ? '24px' : '0'; ?> 0 0;">
									<?php echo esc_html( $settings['quote_text'] ); ?>
								</p>
							<?php endif; ?>

							<?php if ( ! empty( $settings['author_name'] ) || ! empty( $settings['author_position'] ) ) : ?>
								<p class="pgfy-testimonial-author" style="margin: 24px 0 0;">
									<?php if ( ! empty( $settings['author_name'] ) ) : ?>
										<span class="pgfy-testimonial-author-name" style="font-weight: 700;">
											<?php echo esc_html( $settings['author_name'] ); ?>,
										</span>
									<?php endif; ?>
									<?php if ( ! empty( $settings['author_position'] ) ) : ?>
										<span class="pgfy-testimonial-author-position">
											<?php echo esc_html( $settings['author_position'] ); ?>
										</span>
									<?php endif; ?>
								</p>
							<?php endif; ?>
						</div>

						<!-- Avatar Thumbnails -->
						<?php if ( 'yes' === $settings['show_avatars'] ) : ?>
							<div class="pgfy-testimonial-avatars" style="display: flex;">
								<?php if ( ! empty( $settings['avatar_1']['url'] ) ) : ?>
									<div class="pgfy-testimonial-avatar-active" style="border-radius: 9999px; border-style: solid; overflow: hidden;">
										<img src="<?php echo esc_url( $settings['avatar_1']['url'] ); ?>" alt="<?php echo esc_attr__( 'Avatar 1', 'pagifye-elementor-widgets' ); ?>" class="pgfy-testimonial-avatar" style="cursor: pointer; border-radius: 9999px; padding: 2px; display: block;">
									</div>
								<?php endif; ?>

								<?php if ( ! empty( $settings['avatar_2']['url'] ) ) : ?>
									<img src="<?php echo esc_url( $settings['avatar_2']['url'] ); ?>" alt="<?php echo esc_attr__( 'Avatar 2', 'pagifye-elementor-widgets' ); ?>" class="pgfy-testimonial-avatar" style="cursor: pointer; border-radius: 9999px; display: block;">
								<?php endif; ?>

								<?php if ( ! empty( $settings['avatar_3']['url'] ) ) : ?>
									<img src="<?php echo esc_url( $settings['avatar_3']['url'] ); ?>" alt="<?php echo esc_attr__( 'Avatar 3', 'pagifye-elementor-widgets' ); ?>" class="pgfy-testimonial-avatar" style="cursor: pointer; border-radius: 9999px; display: block;">
								<?php endif; ?>
							</div>
						<?php endif; ?>

					</div>

				</div>

			</div>
		</section>

		<?php
	}
}
