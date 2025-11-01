# Hero-01 Elementor Widget Implementation Plan

## Table of Contents
1. [Component Analysis](#1-component-analysis)
2. [Elementor Controls Specification](#2-elementor-controls-specification)
3. [PHP Class Structure](#3-php-class-structure)
4. [Render Method Implementation Plan](#4-render-method-implementation-plan)
5. [Image Handling](#5-image-handling)
6. [Button Group Management](#6-button-group-management)
7. [Styling Controls](#7-styling-controls)
8. [Layout Options](#8-layout-options)
9. [Responsive Behavior](#9-responsive-behavior)
10. [Implementation Steps](#10-implementation-steps)
11. [Testing Checklist](#11-testing-checklist)
12. [Code Snippets](#12-code-snippets)

---

## 1. Component Analysis

### HTML Structure Overview
The Hero-01 component is a full-width section with a split layout containing:

**Container Structure:**
- Root: `<section>` with background color and padding
- Container: `.container` with flexbox layout
- Two main columns (50/50 split, responsive to 100% on mobile)

**Left Column - Hero Information:**
- Heading wrapper (h1) with:
  - Primary text line
  - Highlighted text line with accent color
- Description paragraph
- CTA buttons wrapper with:
  - Primary button (with icon)
  - Secondary button (outlined)

**Right Column - Hero Image:**
- Image container with responsive width
- Full-width image with alt text

### Key Features Identified:
1. **Two-column split layout** (left/right reversible)
2. **Dual-line heading** with different styling
3. **Rich text description**
4. **Multiple CTA buttons** (repeater control needed)
5. **Hero image** with responsive handling
6. **Icon support** in buttons
7. **Hover effects** on buttons
8. **Responsive behavior** (stacks on mobile)
9. **Custom color scheme** using design system colors
10. **Spacing controls** (padding, gaps)

### Design System Colors Used:
- `bg-pgfy-gray-500` - Section background
- `text-pgfy-primary-500` - Highlighted text
- `bg-pgfy-primary-500` - Primary button
- `border-pgfy-primary-500` - Secondary button border
- `text-white / text-pgfy-neutral-white` - Text colors

---

## 2. Elementor Controls Specification

### 2.1 Content Tab

#### Section: Hero Content
```php
'heading_line_1' => [
    'label' => 'Heading Line 1',
    'type' => \Elementor\Controls_Manager::TEXT,
    'default' => 'Driving Success Through',
    'placeholder' => 'Enter first line of heading',
    'label_block' => true,
    'dynamic' => ['active' => true],
]

'heading_line_2' => [
    'label' => 'Heading Line 2',
    'type' => \Elementor\Controls_Manager::TEXT,
    'default' => 'Innovation and Excellence',
    'placeholder' => 'Enter second line of heading',
    'label_block' => true,
    'dynamic' => ['active' => true],
]

'heading_tag' => [
    'label' => 'HTML Tag',
    'type' => \Elementor\Controls_Manager::SELECT,
    'options' => [
        'h1' => 'H1',
        'h2' => 'H2',
        'h3' => 'H3',
        'h4' => 'H4',
        'h5' => 'H5',
        'h6' => 'H6',
        'div' => 'div',
        'span' => 'span',
    ],
    'default' => 'h1',
]

'description' => [
    'label' => 'Description',
    'type' => \Elementor\Controls_Manager::TEXTAREA,
    'default' => 'Unlock your business\'s full potential with our innovative SaaS solutions and see the difference we can make.',
    'placeholder' => 'Enter description text',
    'rows' => 4,
    'dynamic' => ['active' => true],
]

'description_tag' => [
    'label' => 'Description HTML Tag',
    'type' => \Elementor\Controls_Manager::SELECT,
    'options' => [
        'p' => 'p',
        'div' => 'div',
        'span' => 'span',
    ],
    'default' => 'p',
]
```

#### Section: CTA Buttons
```php
'buttons' => [
    'label' => 'Buttons',
    'type' => \Elementor\Controls_Manager::REPEATER,
    'fields' => [
        [
            'name' => 'button_text',
            'label' => 'Button Text',
            'type' => \Elementor\Controls_Manager::TEXT,
            'default' => 'Get Started',
            'label_block' => true,
        ],
        [
            'name' => 'button_link',
            'label' => 'Link',
            'type' => \Elementor\Controls_Manager::URL,
            'placeholder' => 'https://example.com',
            'default' => [
                'url' => '#',
                'is_external' => false,
                'nofollow' => false,
            ],
        ],
        [
            'name' => 'button_type',
            'label' => 'Button Type',
            'type' => \Elementor\Controls_Manager::SELECT,
            'options' => [
                'primary' => 'Primary',
                'secondary' => 'Secondary',
                'custom' => 'Custom',
            ],
            'default' => 'primary',
        ],
        [
            'name' => 'show_icon',
            'label' => 'Show Icon',
            'type' => \Elementor\Controls_Manager::SWITCHER,
            'label_on' => 'Yes',
            'label_off' => 'No',
            'default' => 'no',
        ],
        [
            'name' => 'icon',
            'label' => 'Icon',
            'type' => \Elementor\Controls_Manager::ICONS,
            'default' => [
                'value' => 'fas fa-arrow-right',
                'library' => 'fa-solid',
            ],
            'condition' => [
                'show_icon' => 'yes',
            ],
        ],
        [
            'name' => 'icon_position',
            'label' => 'Icon Position',
            'type' => \Elementor\Controls_Manager::SELECT,
            'options' => [
                'left' => 'Left',
                'right' => 'Right',
            ],
            'default' => 'right',
            'condition' => [
                'show_icon' => 'yes',
            ],
        ],
    ],
    'default' => [
        [
            'button_text' => 'Get Started',
            'button_type' => 'primary',
            'show_icon' => 'yes',
        ],
        [
            'button_text' => 'Learn More',
            'button_type' => 'secondary',
            'show_icon' => 'no',
        ],
    ],
    'title_field' => '{{{ button_text }}}',
]

'buttons_layout' => [
    'label' => 'Buttons Layout',
    'type' => \Elementor\Controls_Manager::SELECT,
    'options' => [
        'inline' => 'Inline',
        'stacked' => 'Stacked',
    ],
    'default' => 'inline',
    'prefix_class' => 'hero-buttons-',
]
```

#### Section: Hero Image
```php
'hero_image' => [
    'label' => 'Choose Image',
    'type' => \Elementor\Controls_Manager::MEDIA,
    'default' => [
        'url' => \Elementor\Utils::get_placeholder_image_src(),
    ],
    'dynamic' => ['active' => true],
]

'image_alt' => [
    'label' => 'Alt Text',
    'type' => \Elementor\Controls_Manager::TEXT,
    'default' => 'Hero Image',
    'placeholder' => 'Enter alternative text',
    'label_block' => true,
    'dynamic' => ['active' => true],
]

'image_size' => [
    'label' => 'Image Size',
    'type' => \Elementor\Group_Control_Image_Size::get_type(),
    'default' => 'large',
]
```

### 2.2 Style Tab

#### Section: Layout
```php
'layout_type' => [
    'label' => 'Layout Direction',
    'type' => \Elementor\Controls_Manager::SELECT,
    'options' => [
        'row' => 'Image Right',
        'row-reverse' => 'Image Left',
    ],
    'default' => 'row',
    'selectors' => [
        '{{WRAPPER}} .hero-container' => 'flex-direction: {{VALUE}};',
    ],
]

'column_gap' => [
    'label' => 'Column Gap',
    'type' => \Elementor\Controls_Manager::SLIDER,
    'size_units' => ['px', 'rem', 'em'],
    'range' => [
        'px' => [
            'min' => 0,
            'max' => 200,
            'step' => 1,
        ],
        'rem' => [
            'min' => 0,
            'max' => 10,
            'step' => 0.1,
        ],
    ],
    'default' => [
        'unit' => 'px',
        'size' => 40,
    ],
    'selectors' => [
        '{{WRAPPER}} .hero-container' => 'gap: {{SIZE}}{{UNIT}};',
    ],
]

'content_width' => [
    'label' => 'Content Width (%)',
    'type' => \Elementor\Controls_Manager::SLIDER,
    'size_units' => ['%'],
    'range' => [
        '%' => [
            'min' => 20,
            'max' => 80,
            'step' => 1,
        ],
    ],
    'default' => [
        'unit' => '%',
        'size' => 50,
    ],
    'selectors' => [
        '{{WRAPPER}} .hero-content' => 'width: {{SIZE}}{{UNIT}};',
        '{{WRAPPER}} .hero-image' => 'width: calc(100% - {{SIZE}}{{UNIT}});',
    ],
]

'vertical_alignment' => [
    'label' => 'Vertical Alignment',
    'type' => \Elementor\Controls_Manager::CHOOSE,
    'options' => [
        'flex-start' => [
            'title' => 'Top',
            'icon' => 'eicon-v-align-top',
        ],
        'center' => [
            'title' => 'Middle',
            'icon' => 'eicon-v-align-middle',
        ],
        'flex-end' => [
            'title' => 'Bottom',
            'icon' => 'eicon-v-align-bottom',
        ],
    ],
    'default' => 'center',
    'selectors' => [
        '{{WRAPPER}} .hero-container' => 'align-items: {{VALUE}};',
    ],
]
```

#### Section: Section Styling
```php
'section_background' => [
    'label' => 'Background Color',
    'type' => \Elementor\Controls_Manager::COLOR,
    'default' => '#0F2C24', // pgfy-gray-500
    'selectors' => [
        '{{WRAPPER}} .hero-section' => 'background-color: {{VALUE}};',
    ],
]

'section_padding' => [
    'label' => 'Section Padding',
    'type' => \Elementor\Controls_Manager::DIMENSIONS,
    'size_units' => ['px', 'em', 'rem', '%'],
    'default' => [
        'top' => '64',
        'right' => '0',
        'bottom' => '80',
        'left' => '0',
        'unit' => 'px',
        'isLinked' => false,
    ],
    'selectors' => [
        '{{WRAPPER}} .hero-section' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
    ],
]
```

#### Section: Heading Styling
```php
'heading_color' => [
    'label' => 'Heading Line 1 Color',
    'type' => \Elementor\Controls_Manager::COLOR,
    'default' => '#FFFFFF',
    'selectors' => [
        '{{WRAPPER}} .hero-heading-line-1' => 'color: {{VALUE}};',
    ],
]

'heading_highlight_color' => [
    'label' => 'Heading Line 2 Color',
    'type' => \Elementor\Controls_Manager::COLOR,
    'default' => '#00D9A3', // pgfy-primary-500
    'selectors' => [
        '{{WRAPPER}} .hero-heading-line-2' => 'color: {{VALUE}};',
    ],
]

'heading_typography' => [
    'label' => 'Typography',
    'type' => \Elementor\Group_Control_Typography::get_type(),
    'selector' => '{{WRAPPER}} .hero-heading',
    'fields_options' => [
        'typography' => ['default' => 'yes'],
        'font_size' => [
            'default' => [
                'size' => 60,
                'unit' => 'px',
            ],
        ],
        'font_weight' => ['default' => '700'],
        'line_height' => [
            'default' => [
                'size' => 68,
                'unit' => 'px',
            ],
        ],
    ],
]

'heading_spacing' => [
    'label' => 'Bottom Spacing',
    'type' => \Elementor\Controls_Manager::SLIDER,
    'size_units' => ['px', 'rem', 'em'],
    'range' => [
        'px' => [
            'min' => 0,
            'max' => 100,
            'step' => 1,
        ],
    ],
    'default' => [
        'unit' => 'px',
        'size' => 24,
    ],
    'selectors' => [
        '{{WRAPPER}} .hero-heading' => 'margin-bottom: {{SIZE}}{{UNIT}};',
    ],
]
```

#### Section: Description Styling
```php
'description_color' => [
    'label' => 'Text Color',
    'type' => \Elementor\Controls_Manager::COLOR,
    'default' => '#FFFFFF',
    'selectors' => [
        '{{WRAPPER}} .hero-description' => 'color: {{VALUE}};',
    ],
]

'description_typography' => [
    'label' => 'Typography',
    'type' => \Elementor\Group_Control_Typography::get_type(),
    'selector' => '{{WRAPPER}} .hero-description',
    'fields_options' => [
        'typography' => ['default' => 'yes'],
        'font_size' => [
            'default' => [
                'size' => 18,
                'unit' => 'px',
            ],
        ],
    ],
]

'description_spacing' => [
    'label' => 'Bottom Spacing',
    'type' => \Elementor\Controls_Manager::SLIDER,
    'size_units' => ['px', 'rem', 'em'],
    'range' => [
        'px' => [
            'min' => 0,
            'max' => 100,
            'step' => 1,
        ],
    ],
    'default' => [
        'unit' => 'px',
        'size' => 40,
    ],
    'selectors' => [
        '{{WRAPPER}} .hero-description' => 'margin-bottom: {{SIZE}}{{UNIT}};',
    ],
]
```

#### Section: Button Styling
```php
'button_gap' => [
    'label' => 'Gap Between Buttons',
    'type' => \Elementor\Controls_Manager::SLIDER,
    'size_units' => ['px', 'rem', 'em'],
    'range' => [
        'px' => [
            'min' => 0,
            'max' => 50,
            'step' => 1,
        ],
    ],
    'default' => [
        'unit' => 'px',
        'size' => 16,
    ],
    'selectors' => [
        '{{WRAPPER}} .hero-buttons' => 'gap: {{SIZE}}{{UNIT}};',
    ],
]

'button_typography' => [
    'label' => 'Typography',
    'type' => \Elementor\Group_Control_Typography::get_type(),
    'selector' => '{{WRAPPER}} .hero-button',
    'fields_options' => [
        'typography' => ['default' => 'yes'],
        'font_size' => [
            'default' => [
                'size' => 16,
                'unit' => 'px',
            ],
        ],
        'font_weight' => ['default' => '700'],
    ],
]

// Primary Button
'primary_button_color' => [
    'label' => 'Primary Text Color',
    'type' => \Elementor\Controls_Manager::COLOR,
    'default' => '#0F2C24',
    'selectors' => [
        '{{WRAPPER}} .hero-button-primary' => 'color: {{VALUE}};',
    ],
]

'primary_button_bg' => [
    'label' => 'Primary Background',
    'type' => \Elementor\Controls_Manager::COLOR,
    'default' => '#00D9A3',
    'selectors' => [
        '{{WRAPPER}} .hero-button-primary' => 'background-color: {{VALUE}};',
    ],
]

'primary_button_hover_color' => [
    'label' => 'Primary Hover Text Color',
    'type' => \Elementor\Controls_Manager::COLOR,
    'default' => '#0F2C24',
    'selectors' => [
        '{{WRAPPER}} .hero-button-primary:hover' => 'color: {{VALUE}};',
    ],
]

'primary_button_hover_bg' => [
    'label' => 'Primary Hover Background',
    'type' => \Elementor\Controls_Manager::COLOR,
    'default' => '#00BF8F',
    'selectors' => [
        '{{WRAPPER}} .hero-button-primary:hover' => 'background-color: {{VALUE}};',
    ],
]

// Secondary Button
'secondary_button_color' => [
    'label' => 'Secondary Text Color',
    'type' => \Elementor\Controls_Manager::COLOR,
    'default' => '#FFFFFF',
    'selectors' => [
        '{{WRAPPER}} .hero-button-secondary' => 'color: {{VALUE}};',
    ],
]

'secondary_button_border' => [
    'label' => 'Secondary Border Color',
    'type' => \Elementor\Controls_Manager::COLOR,
    'default' => '#00D9A3',
    'selectors' => [
        '{{WRAPPER}} .hero-button-secondary' => 'border-color: {{VALUE}};',
    ],
]

'secondary_button_hover_color' => [
    'label' => 'Secondary Hover Text',
    'type' => \Elementor\Controls_Manager::COLOR,
    'default' => '#333333',
    'selectors' => [
        '{{WRAPPER}} .hero-button-secondary:hover' => 'color: {{VALUE}};',
    ],
]

'secondary_button_hover_bg' => [
    'label' => 'Secondary Hover Background',
    'type' => \Elementor\Controls_Manager::COLOR,
    'default' => '#00D9A3',
    'selectors' => [
        '{{WRAPPER}} .hero-button-secondary:hover' => 'background-color: {{VALUE}};',
    ],
]

'button_padding' => [
    'label' => 'Button Padding',
    'type' => \Elementor\Controls_Manager::DIMENSIONS,
    'size_units' => ['px', 'em', 'rem'],
    'default' => [
        'top' => '12',
        'right' => '32',
        'bottom' => '12',
        'left' => '32',
        'unit' => 'px',
        'isLinked' => false,
    ],
    'selectors' => [
        '{{WRAPPER}} .hero-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
    ],
]

'button_border_radius' => [
    'label' => 'Border Radius',
    'type' => \Elementor\Controls_Manager::DIMENSIONS,
    'size_units' => ['px', '%', 'em'],
    'default' => [
        'top' => '9999',
        'right' => '9999',
        'bottom' => '9999',
        'left' => '9999',
        'unit' => 'px',
        'isLinked' => true,
    ],
    'selectors' => [
        '{{WRAPPER}} .hero-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
    ],
]

'icon_spacing' => [
    'label' => 'Icon Spacing',
    'type' => \Elementor\Controls_Manager::SLIDER,
    'size_units' => ['px'],
    'range' => [
        'px' => [
            'min' => 0,
            'max' => 30,
            'step' => 1,
        ],
    ],
    'default' => [
        'unit' => 'px',
        'size' => 4,
    ],
    'selectors' => [
        '{{WRAPPER}} .hero-button i' => 'margin-left: {{SIZE}}{{UNIT}};',
        '{{WRAPPER}} .hero-button svg' => 'margin-left: {{SIZE}}{{UNIT}};',
    ],
]
```

#### Section: Image Styling
```php
'image_border_radius' => [
    'label' => 'Border Radius',
    'type' => \Elementor\Controls_Manager::DIMENSIONS,
    'size_units' => ['px', '%', 'em'],
    'selectors' => [
        '{{WRAPPER}} .hero-image img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
    ],
]

'image_box_shadow' => [
    'label' => 'Box Shadow',
    'type' => \Elementor\Group_Control_Box_Shadow::get_type(),
    'selector' => '{{WRAPPER}} .hero-image img',
]

'image_css_filters' => [
    'label' => 'CSS Filters',
    'type' => \Elementor\Group_Control_Css_Filter::get_type(),
    'selector' => '{{WRAPPER}} .hero-image img',
]
```

### 2.3 Advanced Tab

#### Section: Responsive Settings
```php
'mobile_layout' => [
    'label' => 'Mobile Layout',
    'type' => \Elementor\Controls_Manager::SELECT,
    'options' => [
        'stacked' => 'Stacked (Image on Top)',
        'stacked-reverse' => 'Stacked Reverse (Content on Top)',
    ],
    'default' => 'stacked',
]

'mobile_content_width' => [
    'label' => 'Mobile Content Width',
    'type' => \Elementor\Controls_Manager::SLIDER,
    'size_units' => ['%'],
    'range' => [
        '%' => [
            'min' => 80,
            'max' => 100,
            'step' => 1,
        ],
    ],
    'default' => [
        'unit' => '%',
        'size' => 100,
    ],
    'selectors' => [
        '(mobile){{WRAPPER}} .hero-content' => 'width: {{SIZE}}{{UNIT}};',
        '(mobile){{WRAPPER}} .hero-image' => 'width: {{SIZE}}{{UNIT}};',
    ],
]

'hide_on_mobile' => [
    'label' => 'Hide Image on Mobile',
    'type' => \Elementor\Controls_Manager::SWITCHER,
    'label_on' => 'Yes',
    'label_off' => 'No',
    'default' => 'no',
    'selectors' => [
        '(mobile){{WRAPPER}} .hero-image' => 'display: none;',
    ],
]
```

#### Section: Animation
```php
'content_animation' => [
    'label' => 'Content Animation',
    'type' => \Elementor\Controls_Manager::ANIMATION,
    'prefix_class' => 'animated ',
]

'image_animation' => [
    'label' => 'Image Animation',
    'type' => \Elementor\Controls_Manager::ANIMATION,
]

'animation_delay' => [
    'label' => 'Animation Delay (ms)',
    'type' => \Elementor\Controls_Manager::NUMBER,
    'default' => 0,
    'min' => 0,
    'max' => 5000,
    'step' => 100,
]
```

---

## 3. PHP Class Structure

### File: `widgets/hero-01-widget.php`

```php
<?php
namespace Pagifye\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Css_Filter;
use Elementor\Repeater;
use Elementor\Utils;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

/**
 * Hero 01 Widget
 *
 * Elementor widget for Hero-01 component
 *
 * @since 1.0.0
 */
class Hero_01_Widget extends Widget_Base {

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
        return esc_html__('Hero 01', 'pagifye');
    }

    /**
     * Get widget icon
     */
    public function get_icon() {
        return 'eicon-header';
    }

    /**
     * Get widget categories
     */
    public function get_categories() {
        return ['pagifye-components'];
    }

    /**
     * Get widget keywords
     */
    public function get_keywords() {
        return ['hero', 'header', 'banner', 'cta', 'pagifye'];
    }

    /**
     * Register widget controls
     */
    protected function register_controls() {
        $this->register_content_controls();
        $this->register_style_controls();
        $this->register_advanced_controls();
    }

    /**
     * Register content tab controls
     */
    private function register_content_controls() {
        // Hero Content Section
        $this->register_hero_content_section();

        // CTA Buttons Section
        $this->register_buttons_section();

        // Hero Image Section
        $this->register_image_section();
    }

    /**
     * Register style tab controls
     */
    private function register_style_controls() {
        // Layout Section
        $this->register_layout_section();

        // Section Styling
        $this->register_section_styling();

        // Heading Styling
        $this->register_heading_styling();

        // Description Styling
        $this->register_description_styling();

        // Button Styling
        $this->register_button_styling();

        // Image Styling
        $this->register_image_styling();
    }

    /**
     * Register advanced tab controls
     */
    private function register_advanced_controls() {
        // Responsive Settings
        $this->register_responsive_settings();

        // Animation Settings
        $this->register_animation_settings();
    }

    /**
     * Individual section registration methods
     */
    private function register_hero_content_section() { /* ... */ }
    private function register_buttons_section() { /* ... */ }
    private function register_image_section() { /* ... */ }
    private function register_layout_section() { /* ... */ }
    private function register_section_styling() { /* ... */ }
    private function register_heading_styling() { /* ... */ }
    private function register_description_styling() { /* ... */ }
    private function register_button_styling() { /* ... */ }
    private function register_image_styling() { /* ... */ }
    private function register_responsive_settings() { /* ... */ }
    private function register_animation_settings() { /* ... */ }

    /**
     * Render widget output on the frontend
     */
    protected function render() {
        $settings = $this->get_settings_for_display();

        // Render section wrapper
        $this->render_section_start($settings);

        // Render container
        $this->render_container_start($settings);

        // Render content column
        $this->render_content_column($settings);

        // Render image column
        $this->render_image_column($settings);

        // Close container and section
        $this->render_container_end();
        $this->render_section_end();
    }

    /**
     * Render methods for different parts
     */
    private function render_section_start($settings) { /* ... */ }
    private function render_container_start($settings) { /* ... */ }
    private function render_content_column($settings) { /* ... */ }
    private function render_heading($settings) { /* ... */ }
    private function render_description($settings) { /* ... */ }
    private function render_buttons($settings) { /* ... */ }
    private function render_single_button($button, $index, $settings) { /* ... */ }
    private function render_image_column($settings) { /* ... */ }
    private function render_container_end() { /* ... */ }
    private function render_section_end() { /* ... */ }

    /**
     * Render widget output in the editor (optional)
     */
    protected function content_template() {
        // JavaScript template for live editing
        // This is optional but recommended for better UX
    }

    /**
     * Helper methods
     */
    private function get_button_class($button_type) { /* ... */ }
    private function get_responsive_classes() { /* ... */ }
    private function sanitize_html_class($class) { /* ... */ }
}
```

---

## 4. Render Method Implementation Plan

### 4.1 Main Render Flow

```
render()
├── render_section_start()      // <section> with classes and styles
├── render_container_start()    // <div class="container"> with flex
├── render_content_column()     // Left/right column with content
│   ├── render_heading()        // Dual-line heading
│   ├── render_description()    // Description paragraph
│   └── render_buttons()        // Button repeater loop
│       └── render_single_button() × N
├── render_image_column()       // Right/left column with image
├── render_container_end()      // Close container
└── render_section_end()        // Close section
```

### 4.2 Section Start Implementation

**Purpose:** Create the outer `<section>` wrapper with background and padding

**Logic:**
1. Get background color from settings
2. Get padding values from settings
3. Apply responsive classes
4. Add animation classes if enabled
5. Open section tag with all classes

**Output:**
```html
<section class="hero-section bg-pgfy-gray-500 py-10 md:pb-20 md:pt-16">
```

### 4.3 Container Start Implementation

**Purpose:** Create the flex container for columns

**Logic:**
1. Get layout direction (row or row-reverse)
2. Apply vertical alignment
3. Add responsive flex direction classes
4. Set gap between columns

**Output:**
```html
<div class="hero-container container flex items-center gap-10 max-md:flex-col">
```

### 4.4 Content Column Rendering

**Purpose:** Render the text content side of the hero

**Structure:**
```php
private function render_content_column($settings) {
    echo '<div class="hero-content flex flex-col gap-10 max-md:gap-6">';

    // Heading + Description wrapper
    echo '<div class="hero-text-wrapper flex flex-col gap-6 max-md:gap-4">';
    $this->render_heading($settings);
    $this->render_description($settings);
    echo '</div>';

    // Buttons
    $this->render_buttons($settings);

    echo '</div>';
}
```

### 4.5 Heading Rendering

**Purpose:** Render dual-line heading with different colors

**Logic:**
1. Get heading tag from settings
2. Get line 1 and line 2 text
3. Apply typography classes
4. Wrap each line in span for individual styling

**Output:**
```html
<h1 class="hero-heading text-6xl font-bold leading-[68px] max-lg:text-[42px] max-lg:leading-[48px]">
    <span class="hero-heading-line-1 text-white">Driving Success Through</span>
    <span class="hero-heading-line-2 text-pgfy-primary-500">Innovation and Excellence</span>
</h1>
```

**Implementation:**
```php
private function render_heading($settings) {
    $heading_tag = $settings['heading_tag'];
    $line_1 = $settings['heading_line_1'];
    $line_2 = $settings['heading_line_2'];

    if (empty($line_1) && empty($line_2)) {
        return;
    }

    echo sprintf(
        '<%1$s class="hero-heading">',
        esc_attr($heading_tag)
    );

    if (!empty($line_1)) {
        echo sprintf(
            '<span class="hero-heading-line-1">%s</span>',
            esc_html($line_1)
        );
    }

    if (!empty($line_2)) {
        echo sprintf(
            '<span class="hero-heading-line-2">%s</span>',
            esc_html($line_2)
        );
    }

    echo sprintf('</%s>', esc_attr($heading_tag));
}
```

### 4.6 Description Rendering

**Purpose:** Render description paragraph

**Logic:**
1. Get description text
2. Get HTML tag
3. Apply typography classes
4. Escape and output

**Implementation:**
```php
private function render_description($settings) {
    $description = $settings['description'];
    $description_tag = $settings['description_tag'];

    if (empty($description)) {
        return;
    }

    echo sprintf(
        '<%1$s class="hero-description text-lg max-md:text-base">%2$s</%1$s>',
        esc_attr($description_tag),
        wp_kses_post($description)
    );
}
```

### 4.7 Buttons Rendering

**Purpose:** Loop through button repeater and render each button

**Logic:**
1. Get buttons array from repeater
2. Check if buttons exist
3. Open buttons wrapper with flex/gap
4. Loop and render each button
5. Close wrapper

**Implementation:**
```php
private function render_buttons($settings) {
    $buttons = $settings['buttons'];

    if (empty($buttons)) {
        return;
    }

    echo '<div class="hero-buttons flex flex-wrap gap-4">';

    foreach ($buttons as $index => $button) {
        $this->render_single_button($button, $index, $settings);
    }

    echo '</div>';
}
```

### 4.8 Single Button Rendering

**Purpose:** Render individual button with link, icon, and styling

**Logic:**
1. Get button type (primary/secondary)
2. Build button classes based on type
3. Get link URL and attributes
4. Check for icon
5. Render button with proper structure

**Implementation:**
```php
private function render_single_button($button, $index, $settings) {
    $button_text = $button['button_text'];
    $button_type = $button['button_type'];
    $button_link = $button['button_link'];
    $show_icon = $button['show_icon'];
    $icon_position = $button['icon_position'];

    // Build classes
    $button_classes = [
        'hero-button',
        'hero-button-' . $button_type,
        'group',
        'flex',
        'select-none',
        'items-center',
        'justify-center',
        'gap-1',
        'text-nowrap',
        'rounded-full',
        'text-base',
        'font-bold',
        'transition',
        'duration-300',
        'ease-in-out',
        'max-lg:w-full',
        '!w-auto',
        'px-8',
        'py-3',
    ];

    // Add type-specific classes
    if ($button_type === 'primary') {
        $button_classes[] = 'bg-pgfy-primary-500';
        $button_classes[] = 'text-pgfy-gray-500';
        $button_classes[] = 'hover:bg-pgfy-primary-600';
    } elseif ($button_type === 'secondary') {
        $button_classes[] = 'border';
        $button_classes[] = 'border-pgfy-primary-500';
        $button_classes[] = 'text-white';
        $button_classes[] = 'hover:bg-pgfy-primary-500';
        $button_classes[] = 'hover:text-pgfy-gray-400';
    }

    // Link attributes
    $this->add_link_attributes('button-link-' . $index, $button_link);

    echo sprintf(
        '<a %s class="%s">',
        $this->get_render_attribute_string('button-link-' . $index),
        esc_attr(implode(' ', $button_classes))
    );

    // Icon before text
    if ($show_icon === 'yes' && $icon_position === 'left') {
        \Elementor\Icons_Manager::render_icon($button['icon'], ['aria-hidden' => 'true']);
    }

    // Button text
    echo sprintf('<span>%s</span>', esc_html($button_text));

    // Icon after text
    if ($show_icon === 'yes' && $icon_position === 'right') {
        \Elementor\Icons_Manager::render_icon($button['icon'], [
            'aria-hidden' => 'true',
            'class' => 'transition-transform duration-300 ease-in-out group-hover:translate-x-1',
        ]);
    }

    echo '</a>';
}
```

### 4.9 Image Column Rendering

**Purpose:** Render image side of hero

**Logic:**
1. Get image from media control
2. Get alt text
3. Get image size setting
4. Use Group_Control_Image_Size for responsive images
5. Apply image classes

**Implementation:**
```php
private function render_image_column($settings) {
    $image = $settings['hero_image'];
    $image_alt = $settings['image_alt'];

    if (empty($image['id']) && empty($image['url'])) {
        return;
    }

    echo '<div class="hero-image w-1/2 grow max-md:w-full">';

    // Use Elementor's image size group control
    $image_html = Group_Control_Image_Size::get_attachment_image_html(
        $settings,
        'image',
        'hero_image'
    );

    // Add custom classes and alt text
    if (!empty($image_html)) {
        // Replace img tag to add our classes
        $image_html = str_replace(
            '<img ',
            '<img class="w-full" alt="' . esc_attr($image_alt) . '" ',
            $image_html
        );
        echo $image_html;
    } else {
        // Fallback if image HTML generation fails
        echo sprintf(
            '<img src="%s" alt="%s" class="w-full">',
            esc_url($image['url']),
            esc_attr($image_alt)
        );
    }

    echo '</div>';
}
```

---

## 5. Image Handling

### 5.1 Media Control Setup

Use Elementor's built-in media control with Group_Control_Image_Size:

```php
$this->add_control(
    'hero_image',
    [
        'label' => esc_html__('Choose Image', 'pagifye'),
        'type' => Controls_Manager::MEDIA,
        'default' => [
            'url' => Utils::get_placeholder_image_src(),
        ],
        'dynamic' => [
            'active' => true,
        ],
    ]
);

$this->add_group_control(
    Group_Control_Image_Size::get_type(),
    [
        'name' => 'image',
        'default' => 'large',
        'exclude' => ['custom'],
    ]
);
```

### 5.2 Responsive Image Sizes

**WordPress Image Sizes to Support:**
- `thumbnail` - 150x150
- `medium` - 300x300
- `medium_large` - 768x0
- `large` - 1024x1024
- `full` - Original size

**Recommendation:** Default to `large` for hero images

### 5.3 Lazy Loading

Add native lazy loading for performance:

```php
$image_html = str_replace(
    '<img ',
    '<img loading="lazy" ',
    $image_html
);
```

### 5.4 Fallback Handling

Always provide fallback for missing images:

```php
if (empty($image['id']) && empty($image['url'])) {
    // Show placeholder or skip rendering
    echo '<img src="' . Utils::get_placeholder_image_src() . '" alt="Placeholder">';
    return;
}
```

### 5.5 Alt Text Best Practices

- Provide dedicated alt text control
- Fall back to image attachment alt text
- Use empty alt for decorative images
- Make it translatable

```php
$attachment_alt = get_post_meta($image['id'], '_wp_attachment_image_alt', true);
$alt_text = !empty($settings['image_alt']) ? $settings['image_alt'] : $attachment_alt;
```

---

## 6. Button Group Management

### 6.1 Repeater Structure

The button repeater should support unlimited buttons with these fields:

**Required Fields:**
- Button Text (TEXT)
- Button Link (URL)
- Button Type (SELECT: primary, secondary, custom)

**Optional Fields:**
- Show Icon (SWITCHER)
- Icon (ICONS) - conditional on show_icon
- Icon Position (SELECT: left, right) - conditional on show_icon

### 6.2 Button Type Classes

**Primary Button:**
```php
$primary_classes = [
    'bg-pgfy-primary-500',
    'text-pgfy-gray-500',
    'hover:bg-pgfy-primary-600',
];
```

**Secondary Button:**
```php
$secondary_classes = [
    'border',
    'border-pgfy-primary-500',
    'text-white',
    'hover:bg-pgfy-primary-500',
    'hover:text-pgfy-gray-400',
];
```

**Custom Button:**
User-defined via style controls (background, text, border colors)

### 6.3 Icon Integration

Use Elementor's Icons_Manager for proper icon rendering:

```php
if ($show_icon === 'yes') {
    \Elementor\Icons_Manager::render_icon(
        $button['icon'],
        [
            'aria-hidden' => 'true',
            'class' => 'hero-button-icon',
        ]
    );
}
```

### 6.4 Link Attributes

Properly handle link attributes including external and nofollow:

```php
$button_key = 'button-link-' . $index;
$this->add_link_attributes($button_key, $button['button_link']);
echo '<a ' . $this->get_render_attribute_string($button_key) . '>';
```

### 6.5 Hover Effects

Implement group hover for icon animation:

```html
<a class="group ...">
    <span>Get Started</span>
    <svg class="transition-transform duration-300 group-hover:translate-x-1">...</svg>
</a>
```

### 6.6 Responsive Button Layout

**Desktop:** Inline with flex-wrap
**Mobile:** Full width buttons stacked

```php
$button_wrapper_classes = [
    'hero-buttons',
    'flex',
    'flex-wrap',
    'gap-4',
];

// Individual button responsive class
$button_classes[] = 'max-lg:w-full';
```

---

## 7. Styling Controls

### 7.1 Layout Controls (Style Tab)

**Section: Layout**
- Layout Direction (SELECT: row, row-reverse)
- Column Gap (SLIDER: px, rem, em)
- Content Width (SLIDER: %)
- Vertical Alignment (CHOOSE: top, middle, bottom)

### 7.2 Section Styling (Style Tab)

**Section: Section**
- Background Color (COLOR)
- Background Type (GROUP_CONTROL_BACKGROUND)
- Section Padding (DIMENSIONS)
- Border Type (GROUP_CONTROL_BORDER)

### 7.3 Heading Styling (Style Tab)

**Section: Heading**
- Line 1 Color (COLOR)
- Line 2 Color (COLOR)
- Typography (GROUP_CONTROL_TYPOGRAPHY)
- Text Shadow (GROUP_CONTROL_TEXT_SHADOW)
- Bottom Spacing (SLIDER)

### 7.4 Description Styling (Style Tab)

**Section: Description**
- Text Color (COLOR)
- Typography (GROUP_CONTROL_TYPOGRAPHY)
- Bottom Spacing (SLIDER)

### 7.5 Button Styling (Style Tab)

**Section: Buttons**
- Gap Between Buttons (SLIDER)
- Typography (GROUP_CONTROL_TYPOGRAPHY)

**Subsection: Primary Button**
- Text Color (COLOR)
- Background Color (COLOR)
- Hover Text Color (COLOR)
- Hover Background Color (COLOR)
- Border (GROUP_CONTROL_BORDER)

**Subsection: Secondary Button**
- Text Color (COLOR)
- Background Color (COLOR)
- Border Color (COLOR)
- Hover Text Color (COLOR)
- Hover Background Color (COLOR)

**Subsection: Button Common**
- Padding (DIMENSIONS)
- Border Radius (DIMENSIONS)
- Box Shadow (GROUP_CONTROL_BOX_SHADOW)
- Icon Spacing (SLIDER)

### 7.6 Image Styling (Style Tab)

**Section: Image**
- Border Radius (DIMENSIONS)
- Box Shadow (GROUP_CONTROL_BOX_SHADOW)
- CSS Filters (GROUP_CONTROL_CSS_FILTER)
- Opacity (SLIDER)

### 7.7 Selector Patterns

Use Elementor's CSS selector system:

```php
'selectors' => [
    '{{WRAPPER}} .hero-heading' => 'color: {{VALUE}};',
    '{{WRAPPER}} .hero-button:hover' => 'background-color: {{VALUE}};',
],
```

For responsive selectors:

```php
'selectors' => [
    '(mobile){{WRAPPER}} .hero-content' => 'width: {{SIZE}}{{UNIT}};',
    '(tablet){{WRAPPER}} .hero-heading' => 'font-size: {{SIZE}}{{UNIT}};',
],
```

---

## 8. Layout Options

### 8.1 Image Position Control

**Control Setup:**
```php
$this->add_control(
    'layout_type',
    [
        'label' => esc_html__('Layout Direction', 'pagifye'),
        'type' => Controls_Manager::SELECT,
        'options' => [
            'row' => esc_html__('Image Right', 'pagifye'),
            'row-reverse' => esc_html__('Image Left', 'pagifye'),
        ],
        'default' => 'row',
        'selectors' => [
            '{{WRAPPER}} .hero-container' => 'flex-direction: {{VALUE}};',
        ],
    ]
);
```

**CSS Impact:**
- `row` - Content left, image right (default)
- `row-reverse` - Image left, content right

### 8.2 Vertical Alignment

**Control Setup:**
```php
$this->add_control(
    'vertical_alignment',
    [
        'label' => esc_html__('Vertical Alignment', 'pagifye'),
        'type' => Controls_Manager::CHOOSE,
        'options' => [
            'flex-start' => [
                'title' => esc_html__('Top', 'pagifye'),
                'icon' => 'eicon-v-align-top',
            ],
            'center' => [
                'title' => esc_html__('Middle', 'pagifye'),
                'icon' => 'eicon-v-align-middle',
            ],
            'flex-end' => [
                'title' => esc_html__('Bottom', 'pagifye'),
                'icon' => 'eicon-v-align-bottom',
            ],
        ],
        'default' => 'center',
        'selectors' => [
            '{{WRAPPER}} .hero-container' => 'align-items: {{VALUE}};',
        ],
    ]
);
```

### 8.3 Content Width Distribution

Allow users to adjust column width ratio:

```php
$this->add_control(
    'content_width',
    [
        'label' => esc_html__('Content Width (%)', 'pagifye'),
        'type' => Controls_Manager::SLIDER,
        'size_units' => ['%'],
        'range' => [
            '%' => [
                'min' => 20,
                'max' => 80,
                'step' => 1,
            ],
        ],
        'default' => [
            'unit' => '%',
            'size' => 50,
        ],
        'selectors' => [
            '{{WRAPPER}} .hero-content' => 'width: {{SIZE}}{{UNIT}};',
            '{{WRAPPER}} .hero-image' => 'width: calc(100% - {{SIZE}}{{UNIT}});',
        ],
    ]
);
```

**Use Cases:**
- 40/60 - More emphasis on image
- 50/50 - Equal balance (default)
- 60/40 - More emphasis on content

### 8.4 Text Alignment Options

Add text alignment control for content:

```php
$this->add_responsive_control(
    'text_alignment',
    [
        'label' => esc_html__('Text Alignment', 'pagifye'),
        'type' => Controls_Manager::CHOOSE,
        'options' => [
            'left' => [
                'title' => esc_html__('Left', 'pagifye'),
                'icon' => 'eicon-text-align-left',
            ],
            'center' => [
                'title' => esc_html__('Center', 'pagifye'),
                'icon' => 'eicon-text-align-center',
            ],
            'right' => [
                'title' => esc_html__('Right', 'pagifye'),
                'icon' => 'eicon-text-align-right',
            ],
        ],
        'default' => 'left',
        'selectors' => [
            '{{WRAPPER}} .hero-content' => 'text-align: {{VALUE}};',
        ],
    ]
);
```

### 8.5 Button Alignment

Separate control for button alignment:

```php
$this->add_responsive_control(
    'button_alignment',
    [
        'label' => esc_html__('Button Alignment', 'pagifye'),
        'type' => Controls_Manager::CHOOSE,
        'options' => [
            'flex-start' => [
                'title' => esc_html__('Left', 'pagifye'),
                'icon' => 'eicon-text-align-left',
            ],
            'center' => [
                'title' => esc_html__('Center', 'pagifye'),
                'icon' => 'eicon-text-align-center',
            ],
            'flex-end' => [
                'title' => esc_html__('Right', 'pagifye'),
                'icon' => 'eicon-text-align-right',
            ],
        ],
        'default' => 'flex-start',
        'selectors' => [
            '{{WRAPPER}} .hero-buttons' => 'justify-content: {{VALUE}};',
        ],
    ]
);
```

---

## 9. Responsive Behavior

### 9.1 Breakpoint Strategy

**Elementor Default Breakpoints:**
- Desktop: > 1024px
- Tablet: 768px - 1024px
- Mobile: < 768px

**Tailwind Breakpoints Used:**
- `md:` - 768px and up
- `lg:` - 1024px and up
- `max-md:` - Below 768px
- `max-lg:` - Below 1024px

### 9.2 Mobile Layout Control

**Control Setup:**
```php
$this->add_control(
    'mobile_layout',
    [
        'label' => esc_html__('Mobile Layout', 'pagifye'),
        'type' => Controls_Manager::SELECT,
        'options' => [
            'stacked' => esc_html__('Image on Top', 'pagifye'),
            'stacked-reverse' => esc_html__('Content on Top', 'pagifye'),
        ],
        'default' => 'stacked',
        'prefix_class' => 'mobile-layout-',
    ]
);
```

**CSS Implementation:**
```css
/* Default: Image on top */
@media (max-width: 767px) {
    .hero-container {
        flex-direction: column;
    }
}

/* Reverse: Content on top */
@media (max-width: 767px) {
    .mobile-layout-stacked-reverse .hero-container {
        flex-direction: column-reverse;
    }
}
```

### 9.3 Responsive Typography

**Desktop:**
- Heading: 60px / 68px line-height
- Description: 18px

**Tablet (max-lg):**
- Heading: 42px / 48px line-height
- Description: 18px

**Mobile (max-md):**
- Heading: 42px / 48px line-height
- Description: 16px

**Implementation:**
```php
$this->add_group_control(
    Group_Control_Typography::get_type(),
    [
        'name' => 'heading_typography',
        'selector' => '{{WRAPPER}} .hero-heading',
        'fields_options' => [
            'font_size' => [
                'default' => [
                    'size' => 60,
                    'unit' => 'px',
                ],
                'size_units' => ['px', 'em', 'rem'],
            ],
        ],
    ]
);
```

### 9.4 Responsive Spacing

**Desktop:**
- Section padding: 64px top / 80px bottom
- Column gap: 40px
- Content gap: 40px

**Mobile:**
- Section padding: 40px top/bottom
- Column gap: 32px
- Content gap: 24px

**Implementation via Tailwind:**
```html
<section class="py-10 md:pb-20 md:pt-16">
<div class="gap-10 max-md:gap-8">
<div class="gap-10 max-md:gap-6">
```

### 9.5 Responsive Button Behavior

**Desktop:** Inline buttons with auto width
**Mobile:** Full-width stacked buttons

```html
<button class="max-lg:w-full !w-auto px-8 py-3">
```

### 9.6 Hide Elements on Mobile

Add control to hide image on mobile:

```php
$this->add_control(
    'hide_image_mobile',
    [
        'label' => esc_html__('Hide Image on Mobile', 'pagifye'),
        'type' => Controls_Manager::SWITCHER,
        'label_on' => esc_html__('Yes', 'pagifye'),
        'label_off' => esc_html__('No', 'pagifye'),
        'default' => 'no',
        'selectors' => [
            '(mobile){{WRAPPER}} .hero-image' => 'display: none;',
        ],
    ]
);
```

### 9.7 Responsive Controls

Use `add_responsive_control` for controls that need different values per breakpoint:

```php
$this->add_responsive_control(
    'column_gap',
    [
        'label' => esc_html__('Column Gap', 'pagifye'),
        'type' => Controls_Manager::SLIDER,
        'size_units' => ['px', 'rem'],
        'devices' => ['desktop', 'tablet', 'mobile'],
        'desktop_default' => [
            'size' => 40,
            'unit' => 'px',
        ],
        'tablet_default' => [
            'size' => 32,
            'unit' => 'px',
        ],
        'mobile_default' => [
            'size' => 32,
            'unit' => 'px',
        ],
        'selectors' => [
            '{{WRAPPER}} .hero-container' => 'gap: {{SIZE}}{{UNIT}};',
        ],
    ]
);
```

---

## 10. Implementation Steps

### Step 1: Setup Widget File Structure
**Duration:** 15 minutes

1. Create file: `/widgets/hero-01-widget.php`
2. Add namespace and imports
3. Create class extending `Widget_Base`
4. Implement required methods:
   - `get_name()`
   - `get_title()`
   - `get_icon()`
   - `get_categories()`
   - `get_keywords()`

**Verification:** Widget appears in Elementor panel under Pagifye category

### Step 2: Register Content Controls
**Duration:** 45 minutes

1. Create `register_content_controls()` method
2. Implement `register_hero_content_section()`:
   - Add heading_line_1 control
   - Add heading_line_2 control
   - Add heading_tag control
   - Add description control
   - Add description_tag control
3. Test controls appear in Elementor editor

**Verification:** All content controls visible and functional

### Step 3: Implement Button Repeater
**Duration:** 1 hour

1. Create `register_buttons_section()` method
2. Setup repeater control with fields:
   - button_text
   - button_link (URL control)
   - button_type (SELECT)
   - show_icon (SWITCHER)
   - icon (ICONS control with condition)
   - icon_position (SELECT with condition)
3. Set default repeater items (2 buttons)
4. Test adding/removing/reordering buttons

**Verification:** Can add/edit/remove buttons with all fields working

### Step 4: Add Image Controls
**Duration:** 30 minutes

1. Create `register_image_section()` method
2. Add media control for hero_image
3. Add Group_Control_Image_Size
4. Add image_alt control
5. Test image upload and selection

**Verification:** Image uploader works, preview shows selected image

### Step 5: Implement Basic Render Method
**Duration:** 1 hour

1. Create `render()` method
2. Implement section wrapper rendering
3. Implement container rendering
4. Create placeholder content/image columns
5. Test basic HTML output

**Verification:** Widget renders on frontend with basic structure

### Step 6: Render Heading
**Duration:** 45 minutes

1. Create `render_heading()` method
2. Get settings values
3. Build dual-line heading HTML
4. Add proper escaping
5. Apply dynamic heading tag
6. Test with different heading tags and text

**Verification:** Heading renders correctly with both lines styled

### Step 7: Render Description
**Duration:** 30 minutes

1. Create `render_description()` method
2. Get description text and tag
3. Apply wp_kses_post for safe HTML
4. Test with rich text content

**Verification:** Description renders with proper formatting

### Step 8: Render Buttons
**Duration:** 1.5 hours

1. Create `render_buttons()` method
2. Create `render_single_button()` method
3. Implement button type classes:
   - Primary button classes
   - Secondary button classes
4. Implement icon rendering:
   - Check icon position
   - Use Icons_Manager
   - Add hover animation classes
5. Implement link attributes
6. Test all button types and icon positions

**Verification:** Buttons render with correct styles, links work, icons appear

### Step 9: Render Image
**Duration:** 45 minutes

1. Create `render_image_column()` method
2. Use Group_Control_Image_Size::get_attachment_image_html()
3. Add custom classes to image tag
4. Handle alt text
5. Add fallback for missing images
6. Test with different image sizes

**Verification:** Images render correctly, responsive srcset works

### Step 10: Add Layout Style Controls
**Duration:** 1 hour

1. Create `register_layout_section()` method
2. Add layout_type control (row/row-reverse)
3. Add column_gap control
4. Add content_width control
5. Add vertical_alignment control
6. Test layout switching in editor

**Verification:** Layout controls change appearance in real-time

### Step 11: Add Section Styling Controls
**Duration:** 45 minutes

1. Create `register_section_styling()` method
2. Add background color control
3. Add section padding control
4. Add border controls (optional)
5. Test background and padding changes

**Verification:** Section styling updates live in editor

### Step 12: Add Heading Style Controls
**Duration:** 1 hour

1. Create `register_heading_styling()` method
2. Add heading_color control (line 1)
3. Add heading_highlight_color control (line 2)
4. Add Group_Control_Typography
5. Add heading_spacing control
6. Test typography changes

**Verification:** Heading colors and typography update correctly

### Step 13: Add Description Style Controls
**Duration:** 45 minutes

1. Create `register_description_styling()` method
2. Add description_color control
3. Add Group_Control_Typography for description
4. Add description_spacing control
5. Test all description styling

**Verification:** Description styling works independently from heading

### Step 14: Add Button Style Controls
**Duration:** 2 hours

1. Create `register_button_styling()` method
2. Add button_gap control
3. Add button_typography group control
4. Add primary button colors:
   - Text color
   - Background color
   - Hover text color
   - Hover background color
5. Add secondary button colors:
   - Text color
   - Border color
   - Hover text color
   - Hover background color
6. Add button_padding control
7. Add button_border_radius control
8. Add icon_spacing control
9. Test all button styling options

**Verification:** All button styles work, hover effects apply

### Step 15: Add Image Style Controls
**Duration:** 45 minutes

1. Create `register_image_styling()` method
2. Add image_border_radius control
3. Add Group_Control_Box_Shadow
4. Add Group_Control_Css_Filter
5. Test image styling effects

**Verification:** Image filters and shadows apply correctly

### Step 16: Add Responsive Controls
**Duration:** 1 hour

1. Create `register_responsive_settings()` method
2. Add mobile_layout control
3. Add mobile_content_width control
4. Add hide_image_mobile control
5. Test mobile preview in Elementor

**Verification:** Mobile layout switches work in responsive preview

### Step 17: Add Animation Controls
**Duration:** 30 minutes

1. Create `register_animation_settings()` method
2. Add content_animation control
3. Add image_animation control
4. Add animation_delay control
5. Test animations in frontend

**Verification:** Entrance animations work on page load

### Step 18: Implement Editor Preview
**Duration:** 1 hour

1. Create `content_template()` method
2. Write JavaScript template using Backbone.js
3. Mirror PHP render logic in JS
4. Test live editing experience

**Verification:** Changes reflect instantly in Elementor editor

### Step 19: Add Custom CSS Classes
**Duration:** 30 minutes

1. Add prefix_class options to key controls
2. Add custom CSS file (optional)
3. Enqueue styles properly
4. Test class application

**Verification:** Custom classes appear in HTML output

### Step 20: Testing & Refinement
**Duration:** 2 hours

1. Test all controls with various values
2. Test responsive behavior on real devices
3. Test with different themes
4. Check accessibility (ARIA labels, keyboard nav)
5. Validate HTML output
6. Check performance (page speed)
7. Cross-browser testing
8. Fix any bugs found

**Verification:** Widget works flawlessly in all scenarios

### Step 21: Documentation
**Duration:** 1 hour

1. Add inline code comments
2. Create user documentation
3. Add control tooltips
4. Create video tutorial (optional)

**Verification:** Other developers can understand and modify code

### Step 22: Register Widget
**Duration:** 15 minutes

1. Register widget in main plugin file
2. Add to widgets manager
3. Test widget category registration
4. Clear Elementor cache

**Verification:** Widget appears in Elementor panel

---

## 11. Testing Checklist

### Functional Testing

- [ ] Widget appears in Elementor panel under correct category
- [ ] All content controls accept and save input
- [ ] Heading displays both lines with correct styling
- [ ] Description renders with formatting preserved
- [ ] Button repeater allows adding/removing/reordering
- [ ] All button types render with correct default styles
- [ ] Button links work (internal, external, nofollow)
- [ ] Icons appear in correct position (left/right)
- [ ] Icon hover animation works on primary button
- [ ] Image upload and selection works
- [ ] Image size selector provides correct sizes
- [ ] Alt text applies to image tag
- [ ] Layout direction switches (row/row-reverse)
- [ ] Column gap adjusts spacing
- [ ] Content width ratio changes correctly
- [ ] Vertical alignment works (top/middle/bottom)

### Style Controls Testing

- [ ] Background color changes section background
- [ ] Section padding adjusts spacing
- [ ] Heading line 1 color changes correctly
- [ ] Heading line 2 color changes correctly
- [ ] Heading typography controls work
- [ ] Heading spacing adjusts margin
- [ ] Description color changes
- [ ] Description typography controls work
- [ ] Description spacing adjusts margin
- [ ] Button gap adjusts spacing between buttons
- [ ] Primary button colors change correctly
- [ ] Primary button hover colors apply
- [ ] Secondary button colors change correctly
- [ ] Secondary button hover colors apply
- [ ] Button padding adjusts button size
- [ ] Button border radius changes shape
- [ ] Icon spacing adjusts gap from text
- [ ] Image border radius rounds corners
- [ ] Image box shadow applies
- [ ] Image CSS filters work

### Responsive Testing

- [ ] Desktop layout displays correctly (> 1024px)
- [ ] Tablet layout adapts properly (768px - 1024px)
- [ ] Mobile layout stacks columns (< 768px)
- [ ] Mobile layout reverse works
- [ ] Typography scales on mobile
- [ ] Buttons go full-width on mobile
- [ ] Button text wraps properly
- [ ] Spacing reduces appropriately on mobile
- [ ] Hide image on mobile control works
- [ ] Responsive controls have device-specific values

### Browser Compatibility

- [ ] Chrome (latest)
- [ ] Firefox (latest)
- [ ] Safari (latest)
- [ ] Edge (latest)
- [ ] Mobile Safari (iOS)
- [ ] Chrome Mobile (Android)

### Performance Testing

- [ ] Page loads within 2 seconds
- [ ] Images are lazy loaded
- [ ] No console errors
- [ ] No PHP warnings/errors
- [ ] CSS is minified (production)
- [ ] No unused CSS loaded
- [ ] Widget doesn't slow Elementor editor

### Accessibility Testing

- [ ] Semantic HTML tags used
- [ ] Heading hierarchy is correct
- [ ] Images have alt text
- [ ] Links have descriptive text
- [ ] Buttons are keyboard accessible
- [ ] Focus states visible
- [ ] Color contrast meets WCAG AA
- [ ] Screen reader compatible

### Content Testing

- [ ] Works with very long headings
- [ ] Works with short headings
- [ ] Works with long descriptions
- [ ] Works with multiple paragraphs in description
- [ ] Works with 1 button
- [ ] Works with 5+ buttons
- [ ] Works with no buttons
- [ ] Works without image
- [ ] Works with very large images
- [ ] Works with small images

### Integration Testing

- [ ] Works with default WordPress theme
- [ ] Works with popular themes (Astra, GeneratePress)
- [ ] Works inside Elementor sections
- [ ] Works inside Elementor containers
- [ ] Works with global colors
- [ ] Works with global fonts
- [ ] Respects Elementor theme style settings
- [ ] Works with Elementor Pro features
- [ ] Duplicating widget works
- [ ] Copy/paste between pages works

### Edge Cases

- [ ] Empty heading line 1
- [ ] Empty heading line 2
- [ ] Both heading lines empty
- [ ] Empty description
- [ ] No buttons added
- [ ] Button with no text
- [ ] Button with no link
- [ ] Icon only button
- [ ] Very long button text
- [ ] Image deleted from media library
- [ ] Widget in narrow column

### Elementor Editor Testing

- [ ] Live preview updates instantly
- [ ] No lag when editing controls
- [ ] Navigator shows correct structure
- [ ] Can edit in responsive modes
- [ ] History/undo works
- [ ] Copy style works
- [ ] Paste style works
- [ ] Widget can be saved as template
- [ ] Template insertion works

---

## 12. Code Snippets

### 12.1 Complete Widget Registration

**File: `pagifye.php` (main plugin file)**

```php
<?php
/**
 * Plugin Name: Pagifye Elementor Components
 * Description: Custom Elementor widgets for Pagifye design system
 * Version: 1.0.0
 * Author: Pagifye
 */

if (!defined('ABSPATH')) {
    exit;
}

final class Pagifye_Elementor {

    private static $_instance = null;

    public static function instance() {
        if (is_null(self::$_instance)) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    public function __construct() {
        add_action('elementor/widgets/register', [$this, 'register_widgets']);
        add_action('elementor/elements/categories_registered', [$this, 'register_categories']);
    }

    public function register_categories($elements_manager) {
        $elements_manager->add_category(
            'pagifye-components',
            [
                'title' => esc_html__('Pagifye Components', 'pagifye'),
                'icon' => 'fa fa-plug',
            ]
        );
    }

    public function register_widgets($widgets_manager) {
        require_once(__DIR__ . '/widgets/hero-01-widget.php');
        $widgets_manager->register(new \Pagifye\Widgets\Hero_01_Widget());
    }
}

Pagifye_Elementor::instance();
```

### 12.2 Hero Content Section Registration

```php
private function register_hero_content_section() {
    $this->start_controls_section(
        'section_hero_content',
        [
            'label' => esc_html__('Hero Content', 'pagifye'),
            'tab' => Controls_Manager::TAB_CONTENT,
        ]
    );

    $this->add_control(
        'heading_line_1',
        [
            'label' => esc_html__('Heading Line 1', 'pagifye'),
            'type' => Controls_Manager::TEXT,
            'default' => esc_html__('Driving Success Through', 'pagifye'),
            'placeholder' => esc_html__('Enter first line of heading', 'pagifye'),
            'label_block' => true,
            'dynamic' => [
                'active' => true,
            ],
        ]
    );

    $this->add_control(
        'heading_line_2',
        [
            'label' => esc_html__('Heading Line 2', 'pagifye'),
            'type' => Controls_Manager::TEXT,
            'default' => esc_html__('Innovation and Excellence', 'pagifye'),
            'placeholder' => esc_html__('Enter second line of heading', 'pagifye'),
            'label_block' => true,
            'dynamic' => [
                'active' => true,
            ],
        ]
    );

    $this->add_control(
        'heading_tag',
        [
            'label' => esc_html__('HTML Tag', 'pagifye'),
            'type' => Controls_Manager::SELECT,
            'options' => [
                'h1' => 'H1',
                'h2' => 'H2',
                'h3' => 'H3',
                'h4' => 'H4',
                'h5' => 'H5',
                'h6' => 'H6',
                'div' => 'div',
                'span' => 'span',
            ],
            'default' => 'h1',
        ]
    );

    $this->add_control(
        'description',
        [
            'label' => esc_html__('Description', 'pagifye'),
            'type' => Controls_Manager::TEXTAREA,
            'default' => esc_html__('Unlock your business\'s full potential with our innovative SaaS solutions and see the difference we can make.', 'pagifye'),
            'placeholder' => esc_html__('Enter description text', 'pagifye'),
            'rows' => 4,
            'dynamic' => [
                'active' => true,
            ],
        ]
    );

    $this->add_control(
        'description_tag',
        [
            'label' => esc_html__('Description HTML Tag', 'pagifye'),
            'type' => Controls_Manager::SELECT,
            'options' => [
                'p' => 'p',
                'div' => 'div',
                'span' => 'span',
            ],
            'default' => 'p',
        ]
    );

    $this->end_controls_section();
}
```

### 12.3 Button Repeater Registration

```php
private function register_buttons_section() {
    $this->start_controls_section(
        'section_buttons',
        [
            'label' => esc_html__('CTA Buttons', 'pagifye'),
            'tab' => Controls_Manager::TAB_CONTENT,
        ]
    );

    $repeater = new Repeater();

    $repeater->add_control(
        'button_text',
        [
            'label' => esc_html__('Button Text', 'pagifye'),
            'type' => Controls_Manager::TEXT,
            'default' => esc_html__('Get Started', 'pagifye'),
            'label_block' => true,
        ]
    );

    $repeater->add_control(
        'button_link',
        [
            'label' => esc_html__('Link', 'pagifye'),
            'type' => Controls_Manager::URL,
            'placeholder' => esc_html__('https://example.com', 'pagifye'),
            'default' => [
                'url' => '#',
                'is_external' => false,
                'nofollow' => false,
            ],
        ]
    );

    $repeater->add_control(
        'button_type',
        [
            'label' => esc_html__('Button Type', 'pagifye'),
            'type' => Controls_Manager::SELECT,
            'options' => [
                'primary' => esc_html__('Primary', 'pagifye'),
                'secondary' => esc_html__('Secondary', 'pagifye'),
            ],
            'default' => 'primary',
        ]
    );

    $repeater->add_control(
        'show_icon',
        [
            'label' => esc_html__('Show Icon', 'pagifye'),
            'type' => Controls_Manager::SWITCHER,
            'label_on' => esc_html__('Yes', 'pagifye'),
            'label_off' => esc_html__('No', 'pagifye'),
            'default' => 'no',
        ]
    );

    $repeater->add_control(
        'icon',
        [
            'label' => esc_html__('Icon', 'pagifye'),
            'type' => Controls_Manager::ICONS,
            'default' => [
                'value' => 'fas fa-arrow-right',
                'library' => 'fa-solid',
            ],
            'condition' => [
                'show_icon' => 'yes',
            ],
        ]
    );

    $repeater->add_control(
        'icon_position',
        [
            'label' => esc_html__('Icon Position', 'pagifye'),
            'type' => Controls_Manager::SELECT,
            'options' => [
                'left' => esc_html__('Left', 'pagifye'),
                'right' => esc_html__('Right', 'pagifye'),
            ],
            'default' => 'right',
            'condition' => [
                'show_icon' => 'yes',
            ],
        ]
    );

    $this->add_control(
        'buttons',
        [
            'label' => esc_html__('Buttons', 'pagifye'),
            'type' => Controls_Manager::REPEATER,
            'fields' => $repeater->get_controls(),
            'default' => [
                [
                    'button_text' => esc_html__('Get Started', 'pagifye'),
                    'button_type' => 'primary',
                    'show_icon' => 'yes',
                ],
                [
                    'button_text' => esc_html__('Learn More', 'pagifye'),
                    'button_type' => 'secondary',
                    'show_icon' => 'no',
                ],
            ],
            'title_field' => '{{{ button_text }}}',
        ]
    );

    $this->end_controls_section();
}
```

### 12.4 Complete Render Method

```php
protected function render() {
    $settings = $this->get_settings_for_display();

    // Section start
    ?>
    <section class="hero-section bg-pgfy-gray-500 py-10 md:pb-20 md:pt-16">
        <div class="hero-container container flex items-center gap-10 max-md:flex-col max-md:gap-8">

            <!-- Hero Content -->
            <div class="hero-content flex w-1/2 grow flex-col gap-10 max-md:w-full max-md:gap-6">
                <div class="flex flex-col gap-6 max-md:gap-4">
                    <?php $this->render_heading($settings); ?>
                    <?php $this->render_description($settings); ?>
                </div>

                <?php $this->render_buttons($settings); ?>
            </div>

            <!-- Hero Image -->
            <?php $this->render_image_column($settings); ?>

        </div>
    </section>
    <?php
}

private function render_heading($settings) {
    $heading_tag = $settings['heading_tag'];
    $line_1 = $settings['heading_line_1'];
    $line_2 = $settings['heading_line_2'];

    if (empty($line_1) && empty($line_2)) {
        return;
    }

    ?>
    <<?php echo esc_attr($heading_tag); ?> class="hero-heading text-6xl font-bold leading-[68px] text-white max-lg:text-[42px] max-lg:leading-[48px]">
        <?php if (!empty($line_1)) : ?>
            <span class="hero-heading-line-1"><?php echo esc_html($line_1); ?></span>
        <?php endif; ?>
        <?php if (!empty($line_2)) : ?>
            <span class="hero-heading-line-2 text-pgfy-primary-500"><?php echo esc_html($line_2); ?></span>
        <?php endif; ?>
    </<?php echo esc_attr($heading_tag); ?>>
    <?php
}

private function render_description($settings) {
    $description = $settings['description'];
    $description_tag = $settings['description_tag'];

    if (empty($description)) {
        return;
    }

    ?>
    <<?php echo esc_attr($description_tag); ?> class="hero-description text-lg text-pgfy-neutral-white max-md:text-base">
        <?php echo wp_kses_post($description); ?>
    </<?php echo esc_attr($description_tag); ?>>
    <?php
}

private function render_buttons($settings) {
    $buttons = $settings['buttons'];

    if (empty($buttons)) {
        return;
    }

    ?>
    <div class="hero-buttons flex flex-wrap gap-4">
        <?php foreach ($buttons as $index => $button) : ?>
            <?php $this->render_single_button($button, $index, $settings); ?>
        <?php endforeach; ?>
    </div>
    <?php
}

private function render_single_button($button, $index, $settings) {
    $button_text = $button['button_text'];
    $button_type = $button['button_type'];
    $show_icon = $button['show_icon'];
    $icon_position = $button['icon_position'];

    // Build button classes
    $button_classes = [
        'hero-button',
        'hero-button-' . $button_type,
        'group',
        'flex',
        'select-none',
        'items-center',
        'justify-center',
        'gap-1',
        'text-nowrap',
        'rounded-full',
        'text-base',
        'font-bold',
        'transition',
        'duration-300',
        'ease-in-out',
        'max-lg:w-full',
        '!w-auto',
        'px-8',
        'py-3',
    ];

    // Type-specific classes
    if ($button_type === 'primary') {
        $button_classes = array_merge($button_classes, [
            'bg-pgfy-primary-500',
            'text-pgfy-gray-500',
            'hover:bg-pgfy-primary-600',
        ]);
    } elseif ($button_type === 'secondary') {
        $button_classes = array_merge($button_classes, [
            'border',
            'border-pgfy-primary-500',
            'text-white',
            'hover:bg-pgfy-primary-500',
            'hover:text-pgfy-gray-400',
        ]);
    }

    // Link attributes
    $button_key = 'button-link-' . $index;
    $this->add_link_attributes($button_key, $button['button_link']);

    ?>
    <a <?php echo $this->get_render_attribute_string($button_key); ?> class="<?php echo esc_attr(implode(' ', $button_classes)); ?>">

        <?php if ($show_icon === 'yes' && $icon_position === 'left') : ?>
            <?php \Elementor\Icons_Manager::render_icon($button['icon'], ['aria-hidden' => 'true']); ?>
        <?php endif; ?>

        <span><?php echo esc_html($button_text); ?></span>

        <?php if ($show_icon === 'yes' && $icon_position === 'right') : ?>
            <?php
            \Elementor\Icons_Manager::render_icon($button['icon'], [
                'aria-hidden' => 'true',
                'class' => 'transition-transform duration-300 ease-in-out group-hover:translate-x-1',
            ]);
            ?>
        <?php endif; ?>

    </a>
    <?php
}

private function render_image_column($settings) {
    $image = $settings['hero_image'];
    $image_alt = $settings['image_alt'];

    if (empty($image['id']) && empty($image['url'])) {
        return;
    }

    ?>
    <div class="hero-image w-1/2 grow max-md:w-full">
        <?php
        $image_html = Group_Control_Image_Size::get_attachment_image_html($settings, 'image', 'hero_image');

        if (!empty($image_html)) {
            // Add custom classes
            $image_html = str_replace('<img ', '<img class="w-full" alt="' . esc_attr($image_alt) . '" ', $image_html);
            echo $image_html;
        } else {
            // Fallback
            echo sprintf(
                '<img src="%s" alt="%s" class="w-full">',
                esc_url($image['url']),
                esc_attr($image_alt)
            );
        }
        ?>
    </div>
    <?php
}
```

### 12.5 Typography Control Example

```php
private function register_heading_styling() {
    $this->start_controls_section(
        'section_heading_style',
        [
            'label' => esc_html__('Heading', 'pagifye'),
            'tab' => Controls_Manager::TAB_STYLE,
        ]
    );

    $this->add_control(
        'heading_color',
        [
            'label' => esc_html__('Line 1 Color', 'pagifye'),
            'type' => Controls_Manager::COLOR,
            'default' => '#FFFFFF',
            'selectors' => [
                '{{WRAPPER}} .hero-heading-line-1' => 'color: {{VALUE}};',
            ],
        ]
    );

    $this->add_control(
        'heading_highlight_color',
        [
            'label' => esc_html__('Line 2 Color', 'pagifye'),
            'type' => Controls_Manager::COLOR,
            'default' => '#00D9A3',
            'selectors' => [
                '{{WRAPPER}} .hero-heading-line-2' => 'color: {{VALUE}};',
            ],
        ]
    );

    $this->add_group_control(
        Group_Control_Typography::get_type(),
        [
            'name' => 'heading_typography',
            'label' => esc_html__('Typography', 'pagifye'),
            'selector' => '{{WRAPPER}} .hero-heading',
        ]
    );

    $this->add_responsive_control(
        'heading_spacing',
        [
            'label' => esc_html__('Bottom Spacing', 'pagifye'),
            'type' => Controls_Manager::SLIDER,
            'size_units' => ['px', 'rem', 'em'],
            'range' => [
                'px' => [
                    'min' => 0,
                    'max' => 100,
                    'step' => 1,
                ],
            ],
            'default' => [
                'unit' => 'px',
                'size' => 24,
            ],
            'selectors' => [
                '{{WRAPPER}} .hero-heading' => 'margin-bottom: {{SIZE}}{{UNIT}};',
            ],
        ]
    );

    $this->end_controls_section();
}
```

---

## Summary

This implementation plan provides a complete roadmap for building the Hero-01 Elementor widget. The plan includes:

1. **Detailed component analysis** of the original HTML structure
2. **Comprehensive control specifications** for all customization options
3. **Clear PHP class structure** with organized methods
4. **Step-by-step render implementation** with code examples
5. **Image handling best practices** using Elementor's built-in tools
6. **Button repeater management** with type-based styling
7. **Complete styling controls** for all visual aspects
8. **Flexible layout options** for different design needs
9. **Responsive behavior** across all devices
10. **22-step implementation guide** with time estimates
11. **Extensive testing checklist** covering all scenarios
12. **Production-ready code snippets** that can be used directly

**Estimated Total Implementation Time:** 15-20 hours

**Key Features:**
- Dual-line heading with independent styling
- Unlimited CTA buttons with icons
- Responsive hero image
- Complete style customization
- Mobile-first responsive design
- Accessibility compliant
- Performance optimized

Follow this plan sequentially, testing at each step, to create a robust, user-friendly Elementor widget that matches the original component design while providing extensive customization options.
