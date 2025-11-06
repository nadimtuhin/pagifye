<?php
/**
 * Hero-07 Widget
 *
 * Centered fullscreen hero with background image and overlay.
 *
 * @package Pagifye_Elementor_Widgets
 */

namespace Pagifye\ElementorWidgets\Widgets;

use Pagifye\ElementorWidgets\Base_Widget;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Repeater;
use Elementor\Utils;

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Hero-07 Widget Class
 */
class Hero_07 extends Base_Widget {

	/**
	 * Get widget name
	 */
	public function get_name() {
		return 'pagifye-hero-07';
	}

	/**
	 * Get widget title
	 */
	public function get_title() {
		return esc_html__( 'Hero 07', 'pagifye-elementor-widgets' );
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
		return [ 'pagifye', 'hero', 'banner', 'centered', 'fullscreen' ];
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
			'heading',
			[
				'label'       => esc_html__( 'Heading', 'pagifye-elementor-widgets' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => esc_html__( 'Discover Inner Peace at Pagifye yoga', 'pagifye-elementor-widgets' ),
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
				'default'     => esc_html__( 'Visually plan, track, and deliver work projects without the last-minute rush and stress.', 'pagifye-elementor-widgets' ),
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

		// Background Image Section
		$this->start_controls_section(
			'section_background',
			[
				'label' => esc_html__( 'Background Image', 'pagifye-elementor-widgets' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'background_image',
			[
				'label'   => esc_html__( 'Choose Image', 'pagifye-elementor-widgets' ),
				'type'    => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
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
		$bg_image = ! empty( $settings['background_image']['url'] ) ? $settings['background_image']['url'] : '';
		?>

		<section style="background-color: #0F2C24; padding: 30px;">
			<div style="position: relative; min-height: 870px; border-radius: 24px; background-image: url(<?php echo esc_url( $bg_image ); ?>); background-size: cover; background-position: center; padding: 226px 0;">
				<div style="position: absolute; inset: 0; background-color: rgba(0, 0, 0, 0.25); border-radius: 24px;">
					<div style="position: relative; display: flex; flex-direction: column; align-items: center; justify-content: center; height: 100%; gap: 40px; padding: 16px;">

						<div style="max-width: 570px; text-align: center; display: flex; flex-direction: column; gap: 24px;">
							<?php if ( ! empty( $settings['heading'] ) ) : ?>
								<<?php echo tag_escape( $settings['heading_tag'] ); ?> class="pgfy-hero-heading" style="font-size: 60px; font-weight: 700; line-height: 1.13; margin: 0;">
									<?php echo esc_html( $settings['heading'] ); ?>
								</<?php echo tag_escape( $settings['heading_tag'] ); ?>>
							<?php endif; ?>

							<?php if ( ! empty( $settings['description'] ) ) : ?>
								<p style="font-size: 18px; font-weight: 700; color: #FFFFFF; margin: 0;">
									<?php echo esc_html( $settings['description'] ); ?>
								</p>
							<?php endif; ?>
						</div>

						<?php if ( ! empty( $settings['buttons'] ) ) : ?>
							<div style="display: flex; flex-wrap: wrap; justify-content: center; gap: 16px;">
								<?php foreach ( $settings['buttons'] as $index => $button ) : ?>
									<?php
									$this->add_link_attributes( 'button_' . $index, $button['button_link'] );
									$btn_style = 'display: inline-flex; align-items: center; justify-content: center; gap: 4px; padding: 12px 32px; border-radius: 9999px; font-weight: 700; font-size: 16px; text-decoration: none; transition: all 0.3s;';
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
			</div>
		</section>

		<?php
	}
}
