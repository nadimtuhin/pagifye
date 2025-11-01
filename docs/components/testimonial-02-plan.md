# Testimonial-02 Widget - Implementation Plan

**Component:** `root_testimonial-02`
**Version:** 1.0.0
**Last Updated:** 2025-11-02
**Status:** Planning Phase
**Priority:** Medium (Business/Trust Component)

---

## Table of Contents

1. [Component Analysis](#component-analysis)
2. [Elementor Controls Specification](#elementor-controls-specification)
3. [PHP Class Structure](#php-class-structure)
4. [Render Method Implementation Plan](#render-method-implementation-plan)
5. [Image Handling](#image-handling)
6. [Testimonial Repeater](#testimonial-repeater)
7. [Avatar Selection UI](#avatar-selection-ui)
8. [Quote Styling](#quote-styling)
9. [Layout Options](#layout-options)
10. [Styling Controls](#styling-controls)
11. [Alpine.js Integration](#alpinejs-integration)
12. [Implementation Steps](#implementation-steps)
13. [Testing Checklist](#testing-checklist)
14. [Code Snippets](#code-snippets)

---

## Component Analysis

### HTML Structure Overview

The Testimonial-02 component (from `/components/root_testimonial-02.html` and `examples/pricing-page.html` lines 213-252) consists of:

```html
<section class="py-10 md:py-20 lg:py-28 bg-pgfy-gray-500 text-white">
  <div class="container">
    <!-- Header Section -->
    <div class="mx-auto mb-10 w-full text-center md:max-w-[538px] lg:mb-16">
      <p class="text-base font-bold">Testimonials</p>
      <h1 class="text-4xl font-bold capitalize md:text-[40px] md:leading-[48px] lg:text-5xl lg:leading-[56px] mt-4">
        <span>What Client say about</span>
        <span class="text-pgfy-primary-500">our Business</span>
      </h1>
    </div>

    <!-- Testimonial Content -->
    <div class="flex items-center gap-8 max-md:flex-col md:gap-10 lg:gap-20">
      <!-- Featured Image (Left) -->
      <div class="flex max-h-[480px] w-full min-w-[370px] items-end justify-center md:max-w-[470px] rounded-2xl bg-pgfy-gray-400">
        <img src="..." alt="testimonial" class="object-cover object-bottom">
      </div>

      <!-- Testimonial Content (Right) -->
      <div class="grow space-y-8 md:space-y-16">
        <!-- Quote Section -->
        <div>
          <img src="..." alt="quote">
          <p class="mt-6 text-2xl font-bold italic md:mt-10">
            "I cannot thank Pagifye website builder enough..."
          </p>
          <p class="mt-6">
            <span class="font-bold">Amber Stone,</span> Head of Enterprise, UserTesting
          </p>
        </div>

        <!-- Avatar Selector -->
        <div class="flex gap-4">
          <div class="rounded-full border-2 border-pgfy-primary-500">
            <img src="..." alt="testimonial" class="cursor-pointer rounded-full p-0.5">
          </div>
          <img src="..." alt="testimonial" class="cursor-pointer">
          <img src="..." alt="testimonial" class="cursor-pointer">
        </div>
      </div>
    </div>
  </div>
</section>
```

### Key Features Identified

1. **Section Header**
   - Subtitle (e.g., "Testimonials")
   - Main heading with optional highlighted text
   - Centered layout with max-width constraint

2. **Featured Image Area**
   - Large testimonial image on left
   - Rounded corners (2xl)
   - Background color
   - Responsive sizing (max-h-480px)
   - Image position controls (object-bottom)

3. **Quote Display**
   - Company logo/quote icon
   - Quote text (large, bold, italic)
   - Author name (bold)
   - Author position/company

4. **Avatar Selector**
   - Multiple small avatar images
   - Active state with colored border
   - Clickable for switching testimonials
   - Flex layout with gap

5. **Layout**
   - Two-column layout (image + content)
   - Responsive (stacks on mobile)
   - Flexible gaps (8/10/20)
   - Dark background theme

---

## Elementor Controls Specification

### Content Tab

#### Section Header Controls

```php
// Section: header_section
$this->add_control(
    'show_header',
    [
        'label' => __('Show Header', 'pagifye'),
        'type' => \Elementor\Controls_Manager::SWITCHER,
        'label_on' => __('Yes', 'pagifye'),
        'label_off' => __('No', 'pagifye'),
        'return_value' => 'yes',
        'default' => 'yes',
    ]
);

$this->add_control(
    'subtitle',
    [
        'label' => __('Subtitle', 'pagifye'),
        'type' => \Elementor\Controls_Manager::TEXT,
        'default' => __('Testimonials', 'pagifye'),
        'placeholder' => __('Enter subtitle', 'pagifye'),
        'label_block' => true,
        'condition' => [
            'show_header' => 'yes',
        ],
    ]
);

$this->add_control(
    'heading_text',
    [
        'label' => __('Heading Normal Text', 'pagifye'),
        'type' => \Elementor\Controls_Manager::TEXT,
        'default' => __('What Client say about', 'pagifye'),
        'placeholder' => __('Enter heading', 'pagifye'),
        'label_block' => true,
        'condition' => [
            'show_header' => 'yes',
        ],
    ]
);

$this->add_control(
    'heading_highlight',
    [
        'label' => __('Heading Highlight Text', 'pagifye'),
        'type' => \Elementor\Controls_Manager::TEXT,
        'default' => __('our Business', 'pagifye'),
        'placeholder' => __('Enter highlight text', 'pagifye'),
        'label_block' => true,
        'condition' => [
            'show_header' => 'yes',
        ],
    ]
);

$this->add_control(
    'heading_tag',
    [
        'label' => __('Heading HTML Tag', 'pagifye'),
        'type' => \Elementor\Controls_Manager::SELECT,
        'default' => 'h1',
        'options' => [
            'h1' => __('H1', 'pagifye'),
            'h2' => __('H2', 'pagifye'),
            'h3' => __('H3', 'pagifye'),
            'h4' => __('H4', 'pagifye'),
            'h5' => __('H5', 'pagifye'),
            'h6' => __('H6', 'pagifye'),
            'div' => __('div', 'pagifye'),
            'p' => __('p', 'pagifye'),
        ],
        'condition' => [
            'show_header' => 'yes',
        ],
    ]
);
```

#### Testimonials Repeater

```php
// Section: testimonials_section
$repeater = new \Elementor\Repeater();

$repeater->add_control(
    'featured_image',
    [
        'label' => __('Featured Image', 'pagifye'),
        'type' => \Elementor\Controls_Manager::MEDIA,
        'default' => [
            'url' => \Elementor\Utils::get_placeholder_image_src(),
        ],
    ]
);

$repeater->add_control(
    'featured_image_bg_color',
    [
        'label' => __('Featured Image Background', 'pagifye'),
        'type' => \Elementor\Controls_Manager::COLOR,
        'default' => '#1f2937', // pgfy-gray-400
        'selectors' => [
            '{{WRAPPER}} {{CURRENT_ITEM}} .testimonial-featured-bg' => 'background-color: {{VALUE}};',
        ],
    ]
);

$repeater->add_control(
    'quote_icon',
    [
        'label' => __('Quote Icon/Logo', 'pagifye'),
        'type' => \Elementor\Controls_Manager::MEDIA,
        'default' => [
            'url' => '',
        ],
    ]
);

$repeater->add_control(
    'quote_text',
    [
        'label' => __('Quote Text', 'pagifye'),
        'type' => \Elementor\Controls_Manager::TEXTAREA,
        'default' => __('I cannot thank Pagifye website builder enough for their exceptional service. From the moment I walked in, I felt welcomed and valued.', 'pagifye'),
        'placeholder' => __('Enter testimonial quote', 'pagifye'),
        'rows' => 5,
    ]
);

$repeater->add_control(
    'author_name',
    [
        'label' => __('Author Name', 'pagifye'),
        'type' => \Elementor\Controls_Manager::TEXT,
        'default' => __('Amber Stone', 'pagifye'),
        'placeholder' => __('Enter author name', 'pagifye'),
        'label_block' => true,
    ]
);

$repeater->add_control(
    'author_position',
    [
        'label' => __('Author Position', 'pagifye'),
        'type' => \Elementor\Controls_Manager::TEXT,
        'default' => __('Head of Enterprise, UserTesting', 'pagifye'),
        'placeholder' => __('Enter position/company', 'pagifye'),
        'label_block' => true,
    ]
);

$repeater->add_control(
    'avatar_image',
    [
        'label' => __('Avatar Image', 'pagifye'),
        'type' => \Elementor\Controls_Manager::MEDIA,
        'default' => [
            'url' => \Elementor\Utils::get_placeholder_image_src(),
        ],
    ]
);

$this->add_control(
    'testimonials',
    [
        'label' => __('Testimonials', 'pagifye'),
        'type' => \Elementor\Controls_Manager::REPEATER,
        'fields' => $repeater->get_controls(),
        'default' => [
            [
                'author_name' => __('Amber Stone', 'pagifye'),
                'author_position' => __('Head of Enterprise, UserTesting', 'pagifye'),
                'quote_text' => __('I cannot thank Pagifye website builder enough for their exceptional service.', 'pagifye'),
            ],
            [
                'author_name' => __('John Doe', 'pagifye'),
                'author_position' => __('CEO, Tech Corp', 'pagifye'),
                'quote_text' => __('Outstanding quality and support throughout the entire process.', 'pagifye'),
            ],
            [
                'author_name' => __('Jane Smith', 'pagifye'),
                'author_position' => __('Marketing Director, StartupXYZ', 'pagifye'),
                'quote_text' => __('Exceeded all our expectations. Highly recommended!', 'pagifye'),
            ],
        ],
        'title_field' => '{{{ author_name }}}',
    ]
);
```

#### Layout Settings

```php
// Section: layout_section
$this->add_control(
    'layout_direction',
    [
        'label' => __('Layout Direction', 'pagifye'),
        'type' => \Elementor\Controls_Manager::SELECT,
        'default' => 'image-left',
        'options' => [
            'image-left' => __('Image Left', 'pagifye'),
            'image-right' => __('Image Right', 'pagifye'),
        ],
    ]
);

$this->add_control(
    'show_avatar_selector',
    [
        'label' => __('Show Avatar Selector', 'pagifye'),
        'type' => \Elementor\Controls_Manager::SWITCHER,
        'label_on' => __('Yes', 'pagifye'),
        'label_off' => __('No', 'pagifye'),
        'return_value' => 'yes',
        'default' => 'yes',
    ]
);

$this->add_control(
    'enable_avatar_switching',
    [
        'label' => __('Enable Avatar Switching', 'pagifye'),
        'type' => \Elementor\Controls_Manager::SWITCHER,
        'label_on' => __('Yes', 'pagifye'),
        'label_off' => __('No', 'pagifye'),
        'return_value' => 'yes',
        'default' => 'yes',
        'description' => __('Allow users to switch testimonials by clicking avatars', 'pagifye'),
        'condition' => [
            'show_avatar_selector' => 'yes',
        ],
    ]
);

$this->add_responsive_control(
    'content_alignment',
    [
        'label' => __('Content Alignment', 'pagifye'),
        'type' => \Elementor\Controls_Manager::CHOOSE,
        'options' => [
            'left' => [
                'title' => __('Left', 'pagifye'),
                'icon' => 'eicon-text-align-left',
            ],
            'center' => [
                'title' => __('Center', 'pagifye'),
                'icon' => 'eicon-text-align-center',
            ],
            'right' => [
                'title' => __('Right', 'pagifye'),
                'icon' => 'eicon-text-align-right',
            ],
        ],
        'default' => 'left',
        'selectors' => [
            '{{WRAPPER}} .testimonial-content' => 'text-align: {{VALUE}};',
        ],
    ]
);
```

### Style Tab

#### Section Styling

```php
// Section: section_style
$this->add_control(
    'section_background_color',
    [
        'label' => __('Background Color', 'pagifye'),
        'type' => \Elementor\Controls_Manager::COLOR,
        'default' => '#374151', // pgfy-gray-500
        'selectors' => [
            '{{WRAPPER}} .testimonial-section' => 'background-color: {{VALUE}};',
        ],
    ]
);

$this->add_control(
    'section_text_color',
    [
        'label' => __('Text Color', 'pagifye'),
        'type' => \Elementor\Controls_Manager::COLOR,
        'default' => '#ffffff',
        'selectors' => [
            '{{WRAPPER}} .testimonial-section' => 'color: {{VALUE}};',
        ],
    ]
);

$this->add_responsive_control(
    'section_padding',
    [
        'label' => __('Padding', 'pagifye'),
        'type' => \Elementor\Controls_Manager::DIMENSIONS,
        'size_units' => ['px', 'em', 'rem', '%'],
        'default' => [
            'top' => '40',
            'right' => '0',
            'bottom' => '40',
            'left' => '0',
            'unit' => 'px',
        ],
        'selectors' => [
            '{{WRAPPER}} .testimonial-section' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ],
    ]
);

$this->add_responsive_control(
    'section_margin',
    [
        'label' => __('Margin', 'pagifye'),
        'type' => \Elementor\Controls_Manager::DIMENSIONS,
        'size_units' => ['px', 'em', 'rem', '%'],
        'selectors' => [
            '{{WRAPPER}} .testimonial-section' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ],
    ]
);
```

#### Header Styling

```php
// Section: header_style
$this->add_control(
    'subtitle_color',
    [
        'label' => __('Subtitle Color', 'pagifye'),
        'type' => \Elementor\Controls_Manager::COLOR,
        'default' => '#ffffff',
        'selectors' => [
            '{{WRAPPER}} .testimonial-subtitle' => 'color: {{VALUE}};',
        ],
    ]
);

$this->add_group_control(
    \Elementor\Group_Control_Typography::get_type(),
    [
        'name' => 'subtitle_typography',
        'label' => __('Subtitle Typography', 'pagifye'),
        'selector' => '{{WRAPPER}} .testimonial-subtitle',
    ]
);

$this->add_control(
    'heading_color',
    [
        'label' => __('Heading Color', 'pagifye'),
        'type' => \Elementor\Controls_Manager::COLOR,
        'default' => '#ffffff',
        'selectors' => [
            '{{WRAPPER}} .testimonial-heading' => 'color: {{VALUE}};',
        ],
    ]
);

$this->add_control(
    'heading_highlight_color',
    [
        'label' => __('Heading Highlight Color', 'pagifye'),
        'type' => \Elementor\Controls_Manager::COLOR,
        'default' => '#3b82f6', // pgfy-primary-500
        'selectors' => [
            '{{WRAPPER}} .testimonial-heading-highlight' => 'color: {{VALUE}};',
        ],
    ]
);

$this->add_group_control(
    \Elementor\Group_Control_Typography::get_type(),
    [
        'name' => 'heading_typography',
        'label' => __('Heading Typography', 'pagifye'),
        'selector' => '{{WRAPPER}} .testimonial-heading',
    ]
);

$this->add_responsive_control(
    'header_spacing',
    [
        'label' => __('Bottom Spacing', 'pagifye'),
        'type' => \Elementor\Controls_Manager::SLIDER,
        'size_units' => ['px', 'rem'],
        'range' => [
            'px' => [
                'min' => 0,
                'max' => 200,
            ],
        ],
        'default' => [
            'unit' => 'px',
            'size' => 40,
        ],
        'selectors' => [
            '{{WRAPPER}} .testimonial-header' => 'margin-bottom: {{SIZE}}{{UNIT}};',
        ],
    ]
);

$this->add_responsive_control(
    'header_max_width',
    [
        'label' => __('Max Width', 'pagifye'),
        'type' => \Elementor\Controls_Manager::SLIDER,
        'size_units' => ['px', '%'],
        'range' => [
            'px' => [
                'min' => 200,
                'max' => 1200,
            ],
            '%' => [
                'min' => 10,
                'max' => 100,
            ],
        ],
        'default' => [
            'unit' => 'px',
            'size' => 538,
        ],
        'selectors' => [
            '{{WRAPPER}} .testimonial-header' => 'max-width: {{SIZE}}{{UNIT}};',
        ],
    ]
);
```

#### Featured Image Styling

```php
// Section: featured_image_style
$this->add_responsive_control(
    'featured_image_width',
    [
        'label' => __('Width', 'pagifye'),
        'type' => \Elementor\Controls_Manager::SLIDER,
        'size_units' => ['px', '%'],
        'range' => [
            'px' => [
                'min' => 200,
                'max' => 800,
            ],
            '%' => [
                'min' => 10,
                'max' => 100,
            ],
        ],
        'default' => [
            'unit' => 'px',
            'size' => 470,
        ],
        'selectors' => [
            '{{WRAPPER}} .testimonial-featured-image' => 'max-width: {{SIZE}}{{UNIT}};',
        ],
    ]
);

$this->add_responsive_control(
    'featured_image_height',
    [
        'label' => __('Height', 'pagifye'),
        'type' => \Elementor\Controls_Manager::SLIDER,
        'size_units' => ['px', 'vh'],
        'range' => [
            'px' => [
                'min' => 200,
                'max' => 800,
            ],
        ],
        'default' => [
            'unit' => 'px',
            'size' => 480,
        ],
        'selectors' => [
            '{{WRAPPER}} .testimonial-featured-image' => 'max-height: {{SIZE}}{{UNIT}};',
        ],
    ]
);

$this->add_control(
    'featured_image_border_radius',
    [
        'label' => __('Border Radius', 'pagifye'),
        'type' => \Elementor\Controls_Manager::DIMENSIONS,
        'size_units' => ['px', '%', 'rem'],
        'default' => [
            'top' => '16',
            'right' => '16',
            'bottom' => '16',
            'left' => '16',
            'unit' => 'px',
        ],
        'selectors' => [
            '{{WRAPPER}} .testimonial-featured-image' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ],
    ]
);

$this->add_control(
    'featured_image_object_fit',
    [
        'label' => __('Object Fit', 'pagifye'),
        'type' => \Elementor\Controls_Manager::SELECT,
        'default' => 'cover',
        'options' => [
            'cover' => __('Cover', 'pagifye'),
            'contain' => __('Contain', 'pagifye'),
            'fill' => __('Fill', 'pagifye'),
            'none' => __('None', 'pagifye'),
        ],
        'selectors' => [
            '{{WRAPPER}} .testimonial-featured-image img' => 'object-fit: {{VALUE}};',
        ],
    ]
);

$this->add_control(
    'featured_image_object_position',
    [
        'label' => __('Object Position', 'pagifye'),
        'type' => \Elementor\Controls_Manager::SELECT,
        'default' => 'bottom',
        'options' => [
            'top' => __('Top', 'pagifye'),
            'center' => __('Center', 'pagifye'),
            'bottom' => __('Bottom', 'pagifye'),
            'left' => __('Left', 'pagifye'),
            'right' => __('Right', 'pagifye'),
        ],
        'selectors' => [
            '{{WRAPPER}} .testimonial-featured-image img' => 'object-position: {{VALUE}};',
        ],
    ]
);
```

#### Quote Styling

```php
// Section: quote_style
$this->add_responsive_control(
    'quote_icon_size',
    [
        'label' => __('Quote Icon Size', 'pagifye'),
        'type' => \Elementor\Controls_Manager::SLIDER,
        'size_units' => ['px'],
        'range' => [
            'px' => [
                'min' => 20,
                'max' => 200,
            ],
        ],
        'selectors' => [
            '{{WRAPPER}} .testimonial-quote-icon' => 'width: {{SIZE}}{{UNIT}}; height: auto;',
        ],
    ]
);

$this->add_control(
    'quote_text_color',
    [
        'label' => __('Quote Text Color', 'pagifye'),
        'type' => \Elementor\Controls_Manager::COLOR,
        'default' => '#ffffff',
        'selectors' => [
            '{{WRAPPER}} .testimonial-quote-text' => 'color: {{VALUE}};',
        ],
    ]
);

$this->add_group_control(
    \Elementor\Group_Control_Typography::get_type(),
    [
        'name' => 'quote_text_typography',
        'label' => __('Quote Typography', 'pagifye'),
        'selector' => '{{WRAPPER}} .testimonial-quote-text',
    ]
);

$this->add_control(
    'quote_text_style',
    [
        'label' => __('Quote Text Style', 'pagifye'),
        'type' => \Elementor\Controls_Manager::SELECT,
        'default' => 'italic',
        'options' => [
            'normal' => __('Normal', 'pagifye'),
            'italic' => __('Italic', 'pagifye'),
            'oblique' => __('Oblique', 'pagifye'),
        ],
        'selectors' => [
            '{{WRAPPER}} .testimonial-quote-text' => 'font-style: {{VALUE}};',
        ],
    ]
);

$this->add_responsive_control(
    'quote_spacing',
    [
        'label' => __('Quote Spacing', 'pagifye'),
        'type' => \Elementor\Controls_Manager::SLIDER,
        'size_units' => ['px', 'rem'],
        'range' => [
            'px' => [
                'min' => 0,
                'max' => 100,
            ],
        ],
        'default' => [
            'unit' => 'px',
            'size' => 24,
        ],
        'selectors' => [
            '{{WRAPPER}} .testimonial-quote-text' => 'margin-top: {{SIZE}}{{UNIT}};',
        ],
    ]
);
```

#### Author Styling

```php
// Section: author_style
$this->add_control(
    'author_name_color',
    [
        'label' => __('Author Name Color', 'pagifye'),
        'type' => \Elementor\Controls_Manager::COLOR,
        'default' => '#ffffff',
        'selectors' => [
            '{{WRAPPER}} .testimonial-author-name' => 'color: {{VALUE}};',
        ],
    ]
);

$this->add_group_control(
    \Elementor\Group_Control_Typography::get_type(),
    [
        'name' => 'author_name_typography',
        'label' => __('Author Name Typography', 'pagifye'),
        'selector' => '{{WRAPPER}} .testimonial-author-name',
    ]
);

$this->add_control(
    'author_position_color',
    [
        'label' => __('Author Position Color', 'pagifye'),
        'type' => \Elementor\Controls_Manager::COLOR,
        'default' => '#ffffff',
        'selectors' => [
            '{{WRAPPER}} .testimonial-author-position' => 'color: {{VALUE}};',
        ],
    ]
);

$this->add_group_control(
    \Elementor\Group_Control_Typography::get_type(),
    [
        'name' => 'author_position_typography',
        'label' => __('Author Position Typography', 'pagifye'),
        'selector' => '{{WRAPPER}} .testimonial-author-position',
    ]
);

$this->add_responsive_control(
    'author_spacing',
    [
        'label' => __('Author Info Spacing', 'pagifye'),
        'type' => \Elementor\Controls_Manager::SLIDER,
        'size_units' => ['px', 'rem'],
        'range' => [
            'px' => [
                'min' => 0,
                'max' => 100,
            ],
        ],
        'default' => [
            'unit' => 'px',
            'size' => 24,
        ],
        'selectors' => [
            '{{WRAPPER}} .testimonial-author-info' => 'margin-top: {{SIZE}}{{UNIT}};',
        ],
    ]
);
```

#### Avatar Styling

```php
// Section: avatar_style
$this->add_responsive_control(
    'avatar_size',
    [
        'label' => __('Avatar Size', 'pagifye'),
        'type' => \Elementor\Controls_Manager::SLIDER,
        'size_units' => ['px'],
        'range' => [
            'px' => [
                'min' => 30,
                'max' => 150,
            ],
        ],
        'default' => [
            'unit' => 'px',
            'size' => 60,
        ],
        'selectors' => [
            '{{WRAPPER}} .testimonial-avatar' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
        ],
    ]
);

$this->add_responsive_control(
    'avatar_gap',
    [
        'label' => __('Avatar Gap', 'pagifye'),
        'type' => \Elementor\Controls_Manager::SLIDER,
        'size_units' => ['px', 'rem'],
        'range' => [
            'px' => [
                'min' => 0,
                'max' => 50,
            ],
        ],
        'default' => [
            'unit' => 'px',
            'size' => 16,
        ],
        'selectors' => [
            '{{WRAPPER}} .testimonial-avatars' => 'gap: {{SIZE}}{{UNIT}};',
        ],
    ]
);

$this->add_control(
    'avatar_border_radius',
    [
        'label' => __('Border Radius', 'pagifye'),
        'type' => \Elementor\Controls_Manager::SLIDER,
        'size_units' => ['px', '%'],
        'range' => [
            'px' => [
                'min' => 0,
                'max' => 100,
            ],
            '%' => [
                'min' => 0,
                'max' => 100,
            ],
        ],
        'default' => [
            'unit' => '%',
            'size' => 50,
        ],
        'selectors' => [
            '{{WRAPPER}} .testimonial-avatar' => 'border-radius: {{SIZE}}{{UNIT}};',
        ],
    ]
);

$this->add_control(
    'avatar_active_border_color',
    [
        'label' => __('Active Border Color', 'pagifye'),
        'type' => \Elementor\Controls_Manager::COLOR,
        'default' => '#3b82f6', // pgfy-primary-500
        'selectors' => [
            '{{WRAPPER}} .testimonial-avatar.active' => 'border-color: {{VALUE}};',
        ],
    ]
);

$this->add_responsive_control(
    'avatar_active_border_width',
    [
        'label' => __('Active Border Width', 'pagifye'),
        'type' => \Elementor\Controls_Manager::SLIDER,
        'size_units' => ['px'],
        'range' => [
            'px' => [
                'min' => 0,
                'max' => 10,
            ],
        ],
        'default' => [
            'unit' => 'px',
            'size' => 2,
        ],
        'selectors' => [
            '{{WRAPPER}} .testimonial-avatar.active' => 'border-width: {{SIZE}}{{UNIT}};',
        ],
    ]
);

$this->add_control(
    'avatar_hover_effect',
    [
        'label' => __('Hover Effect', 'pagifye'),
        'type' => \Elementor\Controls_Manager::SELECT,
        'default' => 'opacity',
        'options' => [
            'none' => __('None', 'pagifye'),
            'opacity' => __('Opacity', 'pagifye'),
            'scale' => __('Scale', 'pagifye'),
            'both' => __('Opacity + Scale', 'pagifye'),
        ],
    ]
);

$this->add_responsive_control(
    'avatars_spacing',
    [
        'label' => __('Avatars Section Spacing', 'pagifye'),
        'type' => \Elementor\Controls_Manager::SLIDER,
        'size_units' => ['px', 'rem'],
        'range' => [
            'px' => [
                'min' => 0,
                'max' => 150,
            ],
        ],
        'default' => [
            'unit' => 'px',
            'size' => 32,
        ],
        'selectors' => [
            '{{WRAPPER}} .testimonial-avatars' => 'margin-top: {{SIZE}}{{UNIT}};',
        ],
    ]
);
```

#### Layout Spacing

```php
// Section: layout_spacing_style
$this->add_responsive_control(
    'content_gap',
    [
        'label' => __('Content Gap', 'pagifye'),
        'type' => \Elementor\Controls_Manager::SLIDER,
        'size_units' => ['px', 'rem'],
        'range' => [
            'px' => [
                'min' => 0,
                'max' => 150,
            ],
        ],
        'default' => [
            'unit' => 'px',
            'size' => 32,
        ],
        'selectors' => [
            '{{WRAPPER}} .testimonial-main-content' => 'gap: {{SIZE}}{{UNIT}};',
        ],
    ]
);

$this->add_responsive_control(
    'quote_section_spacing',
    [
        'label' => __('Quote Section Spacing', 'pagifye'),
        'type' => \Elementor\Controls_Manager::SLIDER,
        'size_units' => ['px', 'rem'],
        'range' => [
            'px' => [
                'min' => 0,
                'max' => 150,
            ],
        ],
        'default' => [
            'unit' => 'px',
            'size' => 32,
        ],
        'selectors' => [
            '{{WRAPPER}} .testimonial-quote-section' => 'margin-bottom: {{SIZE}}{{UNIT}};',
        ],
    ]
);
```

---

## PHP Class Structure

### Widget Class Outline

```php
<?php
namespace Pagifye\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

/**
 * Testimonial 02 Widget
 *
 * Elementor widget for Pagifye Testimonial-02 component
 *
 * @since 1.0.0
 */
class Testimonial_02 extends Widget_Base {

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
        return __('Testimonial 02', 'pagifye');
    }

    /**
     * Get widget icon
     */
    public function get_icon() {
        return 'eicon-testimonial';
    }

    /**
     * Get widget categories
     */
    public function get_categories() {
        return ['pagifye-widgets'];
    }

    /**
     * Get widget keywords
     */
    public function get_keywords() {
        return ['testimonial', 'review', 'quote', 'feedback', 'client', 'pagifye'];
    }

    /**
     * Get style dependencies
     */
    public function get_style_depends() {
        return ['pagifye-testimonial-02'];
    }

    /**
     * Get script dependencies
     */
    public function get_script_depends() {
        return ['pagifye-testimonial-02', 'alpine-js'];
    }

    /**
     * Register widget controls
     */
    protected function register_controls() {
        $this->register_content_controls();
        $this->register_style_controls();
    }

    /**
     * Register content tab controls
     */
    private function register_content_controls() {
        $this->register_header_controls();
        $this->register_testimonials_controls();
        $this->register_layout_controls();
    }

    /**
     * Register header section controls
     */
    private function register_header_controls() {
        // Implementation from "Section Header Controls" above
    }

    /**
     * Register testimonials repeater controls
     */
    private function register_testimonials_controls() {
        // Implementation from "Testimonials Repeater" above
    }

    /**
     * Register layout controls
     */
    private function register_layout_controls() {
        // Implementation from "Layout Settings" above
    }

    /**
     * Register style tab controls
     */
    private function register_style_controls() {
        $this->register_section_style_controls();
        $this->register_header_style_controls();
        $this->register_featured_image_style_controls();
        $this->register_quote_style_controls();
        $this->register_author_style_controls();
        $this->register_avatar_style_controls();
        $this->register_layout_spacing_controls();
    }

    /**
     * Register section style controls
     */
    private function register_section_style_controls() {
        // Implementation from "Section Styling" above
    }

    /**
     * Register header style controls
     */
    private function register_header_style_controls() {
        // Implementation from "Header Styling" above
    }

    /**
     * Register featured image style controls
     */
    private function register_featured_image_style_controls() {
        // Implementation from "Featured Image Styling" above
    }

    /**
     * Register quote style controls
     */
    private function register_quote_style_controls() {
        // Implementation from "Quote Styling" above
    }

    /**
     * Register author style controls
     */
    private function register_author_style_controls() {
        // Implementation from "Author Styling" above
    }

    /**
     * Register avatar style controls
     */
    private function register_avatar_style_controls() {
        // Implementation from "Avatar Styling" above
    }

    /**
     * Register layout spacing controls
     */
    private function register_layout_spacing_controls() {
        // Implementation from "Layout Spacing" above
    }

    /**
     * Render widget output
     */
    protected function render() {
        $settings = $this->get_settings_for_display();

        // Start rendering
        $this->render_testimonial_section($settings);
    }

    /**
     * Render testimonial section
     */
    private function render_testimonial_section($settings) {
        // Main render logic
    }

    /**
     * Render section header
     */
    private function render_header($settings) {
        // Header rendering logic
    }

    /**
     * Render testimonial content
     */
    private function render_testimonial_content($settings, $index = 0) {
        // Testimonial content rendering logic
    }

    /**
     * Render featured image
     */
    private function render_featured_image($testimonial, $index) {
        // Featured image rendering logic
    }

    /**
     * Render quote section
     */
    private function render_quote_section($testimonial) {
        // Quote section rendering logic
    }

    /**
     * Render avatar selector
     */
    private function render_avatar_selector($settings) {
        // Avatar selector rendering logic
    }

    /**
     * Render widget in editor mode
     */
    protected function content_template() {
        // JavaScript template for live preview
    }
}
```

---

## Render Method Implementation Plan

### Main Render Method

```php
protected function render() {
    $settings = $this->get_settings_for_display();

    // Early return if no testimonials
    if (empty($settings['testimonials'])) {
        return;
    }

    // Build wrapper classes
    $wrapper_classes = [
        'testimonial-section',
        'py-10 md:py-20 lg:py-28'
    ];

    // Add Alpine.js data attribute if switching is enabled
    $alpine_data = '';
    if ($settings['enable_avatar_switching'] === 'yes' && $settings['show_avatar_selector'] === 'yes') {
        $alpine_data = "x-data='testimonialSwitcher()'";
    }

    ?>
    <section class="<?php echo esc_attr(implode(' ', $wrapper_classes)); ?>" <?php echo $alpine_data; ?>>
        <div class="container">
            <?php
            // Render header if enabled
            if ($settings['show_header'] === 'yes') {
                $this->render_header($settings);
            }
            ?>

            <?php $this->render_main_content($settings); ?>
        </div>
    </section>
    <?php
}
```

### Header Rendering

```php
private function render_header($settings) {
    if (empty($settings['subtitle']) && empty($settings['heading_text'])) {
        return;
    }

    $heading_tag = $settings['heading_tag'];
    ?>
    <div class="testimonial-header mx-auto mb-10 w-full text-center lg:mb-16">
        <?php if (!empty($settings['subtitle'])) : ?>
            <p class="testimonial-subtitle text-base font-bold">
                <?php echo esc_html($settings['subtitle']); ?>
            </p>
        <?php endif; ?>

        <?php if (!empty($settings['heading_text']) || !empty($settings['heading_highlight'])) : ?>
            <<?php echo esc_attr($heading_tag); ?> class="testimonial-heading text-4xl font-bold capitalize md:text-[40px] md:leading-[48px] lg:text-5xl lg:leading-[56px] mt-4">
                <?php if (!empty($settings['heading_text'])) : ?>
                    <span><?php echo esc_html($settings['heading_text']); ?></span>
                <?php endif; ?>
                <?php if (!empty($settings['heading_highlight'])) : ?>
                    <span class="testimonial-heading-highlight text-pgfy-primary-500">
                        <?php echo esc_html($settings['heading_highlight']); ?>
                    </span>
                <?php endif; ?>
            </<?php echo esc_attr($heading_tag); ?>>
        <?php endif; ?>
    </div>
    <?php
}
```

### Main Content Rendering

```php
private function render_main_content($settings) {
    $layout_direction = $settings['layout_direction'];
    $flex_classes = 'flex items-center gap-8 max-md:flex-col md:gap-10 lg:gap-20';

    if ($layout_direction === 'image-right') {
        $flex_classes .= ' flex-row-reverse';
    }

    ?>
    <div class="testimonial-main-content <?php echo esc_attr($flex_classes); ?>">
        <?php
        // If Alpine.js is enabled, use x-show for switching
        if ($settings['enable_avatar_switching'] === 'yes' && $settings['show_avatar_selector'] === 'yes') {
            $this->render_testimonials_with_alpine($settings);
        } else {
            // Show only first testimonial
            $this->render_single_testimonial($settings, 0);
        }
        ?>
    </div>
    <?php
}
```

### Testimonial Rendering (Alpine.js Version)

```php
private function render_testimonials_with_alpine($settings) {
    foreach ($settings['testimonials'] as $index => $testimonial) {
        $show_condition = $index === 0 ? 'currentTestimonial === ' . $index : 'currentTestimonial === ' . $index;
        ?>
        <template x-if="<?php echo esc_attr($show_condition); ?>">
            <div class="testimonial-item-<?php echo esc_attr($index); ?> w-full flex items-center gap-8 max-md:flex-col md:gap-10 lg:gap-20">
                <?php
                $this->render_featured_image($testimonial, $index);
                $this->render_content_area($testimonial, $settings, $index);
                ?>
            </div>
        </template>
        <?php
    }
}
```

### Single Testimonial Rendering

```php
private function render_single_testimonial($settings, $index = 0) {
    if (!isset($settings['testimonials'][$index])) {
        return;
    }

    $testimonial = $settings['testimonials'][$index];
    ?>
    <div class="testimonial-single">
        <?php
        $this->render_featured_image($testimonial, $index);
        $this->render_content_area($testimonial, $settings, $index);
        ?>
    </div>
    <?php
}
```

### Featured Image Rendering

```php
private function render_featured_image($testimonial, $index) {
    if (empty($testimonial['featured_image']['url'])) {
        return;
    }

    $image_url = $testimonial['featured_image']['url'];
    $image_alt = !empty($testimonial['author_name'])
        ? esc_attr($testimonial['author_name'])
        : esc_attr__('Testimonial', 'pagifye');

    ?>
    <div class="testimonial-featured-image flex max-h-[480px] w-full min-w-[370px] items-end justify-center md:max-w-[470px] rounded-2xl elementor-repeater-item-<?php echo esc_attr($testimonial['_id']); ?>">
        <div class="testimonial-featured-bg w-full h-full rounded-2xl flex items-end justify-center">
            <img
                src="<?php echo esc_url($image_url); ?>"
                alt="<?php echo $image_alt; ?>"
                class="object-cover object-bottom"
            >
        </div>
    </div>
    <?php
}
```

### Content Area Rendering

```php
private function render_content_area($testimonial, $settings, $index) {
    ?>
    <div class="testimonial-content grow space-y-8 md:space-y-16">
        <?php $this->render_quote_section($testimonial); ?>

        <?php
        if ($settings['show_avatar_selector'] === 'yes' && count($settings['testimonials']) > 1) {
            $this->render_avatar_selector($settings);
        }
        ?>
    </div>
    <?php
}
```

### Quote Section Rendering

```php
private function render_quote_section($testimonial) {
    ?>
    <div class="testimonial-quote-section">
        <?php if (!empty($testimonial['quote_icon']['url'])) : ?>
            <img
                src="<?php echo esc_url($testimonial['quote_icon']['url']); ?>"
                alt="<?php echo esc_attr__('Quote', 'pagifye'); ?>"
                class="testimonial-quote-icon"
            >
        <?php endif; ?>

        <?php if (!empty($testimonial['quote_text'])) : ?>
            <p class="testimonial-quote-text mt-6 text-2xl font-bold italic md:mt-10">
                "<?php echo esc_html($testimonial['quote_text']); ?>"
            </p>
        <?php endif; ?>

        <?php if (!empty($testimonial['author_name']) || !empty($testimonial['author_position'])) : ?>
            <p class="testimonial-author-info mt-6">
                <?php if (!empty($testimonial['author_name'])) : ?>
                    <span class="testimonial-author-name font-bold">
                        <?php echo esc_html($testimonial['author_name']); ?>,
                    </span>
                <?php endif; ?>
                <?php if (!empty($testimonial['author_position'])) : ?>
                    <span class="testimonial-author-position">
                        <?php echo esc_html($testimonial['author_position']); ?>
                    </span>
                <?php endif; ?>
            </p>
        <?php endif; ?>
    </div>
    <?php
}
```

### Avatar Selector Rendering

```php
private function render_avatar_selector($settings) {
    $testimonials = $settings['testimonials'];
    $enable_switching = $settings['enable_avatar_switching'] === 'yes';

    ?>
    <div class="testimonial-avatars flex gap-4">
        <?php foreach ($testimonials as $index => $testimonial) : ?>
            <?php if (!empty($testimonial['avatar_image']['url'])) : ?>
                <div class="testimonial-avatar-wrapper <?php echo $index === 0 ? 'active' : ''; ?>"
                     <?php echo $enable_switching ? '@click="currentTestimonial = ' . $index . '"' : ''; ?>
                     <?php echo $enable_switching ? ':class="{ \'active\': currentTestimonial === ' . $index . ' }"' : ''; ?>>

                    <div class="testimonial-avatar rounded-full border-2 <?php echo $index === 0 ? 'border-pgfy-primary-500' : 'border-transparent'; ?>">
                        <img
                            src="<?php echo esc_url($testimonial['avatar_image']['url']); ?>"
                            alt="<?php echo esc_attr($testimonial['author_name'] ?? __('Avatar', 'pagifye')); ?>"
                            class="cursor-pointer rounded-full p-0.5"
                        >
                    </div>
                </div>
            <?php endif; ?>
        <?php endforeach; ?>
    </div>
    <?php
}
```

---

## Image Handling

### Image Types

1. **Featured Image**
   - Large testimonial photo (left/right side)
   - Control: `MEDIA` type
   - Default: Placeholder image
   - Rendering: `<img>` with background container
   - Object-fit: cover
   - Object-position: bottom

2. **Quote Icon/Logo**
   - Company logo or quote mark
   - Control: `MEDIA` type
   - Optional field
   - Rendering: `<img>` above quote text
   - Size: Controllable via style tab

3. **Avatar Image**
   - Small circular avatar for selector
   - Control: `MEDIA` type (repeater field)
   - Default: Placeholder image
   - Rendering: Circular with border
   - Active state: Primary color border

### Image Optimization

```php
// Add image size registration in main plugin file
add_image_size('pagifye_testimonial_featured', 470, 480, false);
add_image_size('pagifye_testimonial_avatar', 80, 80, true);

// Use in widget
$image_id = $testimonial['featured_image']['id'];
if ($image_id) {
    echo wp_get_attachment_image($image_id, 'pagifye_testimonial_featured', false, [
        'class' => 'object-cover object-bottom',
        'alt' => esc_attr($testimonial['author_name'])
    ]);
}
```

### Fallback Images

```php
private function get_featured_image_url($testimonial) {
    if (!empty($testimonial['featured_image']['url'])) {
        return $testimonial['featured_image']['url'];
    }

    return \Elementor\Utils::get_placeholder_image_src();
}

private function get_avatar_image_url($testimonial) {
    if (!empty($testimonial['avatar_image']['url'])) {
        return $testimonial['avatar_image']['url'];
    }

    // Return default avatar
    return PAGIFYE_ASSETS_URL . '/images/default-avatar.svg';
}
```

---

## Testimonial Repeater

### Repeater Structure

The repeater allows multiple testimonials with the following fields:

1. **Featured Image** - Main testimonial photo
2. **Featured Image BG Color** - Background color for image container
3. **Quote Icon** - Company logo or quote mark
4. **Quote Text** - Testimonial text (textarea)
5. **Author Name** - Person's name
6. **Author Position** - Job title/company
7. **Avatar Image** - Small circular photo for selector

### Repeater Implementation

```php
$repeater = new \Elementor\Repeater();

// Add all fields (as shown in Controls Specification)

$this->add_control(
    'testimonials',
    [
        'label' => __('Testimonials', 'pagifye'),
        'type' => \Elementor\Controls_Manager::REPEATER,
        'fields' => $repeater->get_controls(),
        'default' => [
            // Default testimonials array
        ],
        'title_field' => '{{{ author_name }}}',
    ]
);
```

### Loop Through Repeater

```php
<?php foreach ($settings['testimonials'] as $index => $testimonial) : ?>
    <!-- Render each testimonial -->
<?php endforeach; ?>
```

### Repeater Item Styling

Each repeater item gets a unique class: `elementor-repeater-item-{$testimonial['_id']}`

This allows targeting specific items with CSS:

```php
'selectors' => [
    '{{WRAPPER}} {{CURRENT_ITEM}} .testimonial-featured-bg' => 'background-color: {{VALUE}};',
],
```

---

## Avatar Selection UI

### HTML Structure

```html
<div class="testimonial-avatars flex gap-4">
    <!-- Avatar 1 (Active) -->
    <div class="testimonial-avatar-wrapper active" @click="currentTestimonial = 0">
        <div class="testimonial-avatar rounded-full border-2 border-pgfy-primary-500">
            <img src="avatar1.jpg" alt="Author 1" class="cursor-pointer rounded-full p-0.5">
        </div>
    </div>

    <!-- Avatar 2 -->
    <div class="testimonial-avatar-wrapper" @click="currentTestimonial = 1">
        <div class="testimonial-avatar rounded-full border-2 border-transparent">
            <img src="avatar2.jpg" alt="Author 2" class="cursor-pointer rounded-full p-0.5">
        </div>
    </div>

    <!-- Avatar 3 -->
    <div class="testimonial-avatar-wrapper" @click="currentTestimonial = 2">
        <div class="testimonial-avatar rounded-full border-2 border-transparent">
            <img src="avatar3.jpg" alt="Author 3" class="cursor-pointer rounded-full p-0.5">
        </div>
    </div>
</div>
```

### Active State Logic

```php
private function render_avatar_selector($settings) {
    $testimonials = $settings['testimonials'];
    $enable_switching = $settings['enable_avatar_switching'] === 'yes';

    ?>
    <div class="testimonial-avatars flex gap-4">
        <?php foreach ($testimonials as $index => $testimonial) : ?>
            <?php if (!empty($testimonial['avatar_image']['url'])) : ?>
                <div class="testimonial-avatar-wrapper"
                     <?php if ($enable_switching) : ?>
                         @click="currentTestimonial = <?php echo $index; ?>"
                         :class="{ 'active': currentTestimonial === <?php echo $index; ?> }"
                     <?php else : ?>
                         class="<?php echo $index === 0 ? 'active' : ''; ?>"
                     <?php endif; ?>>

                    <div class="testimonial-avatar rounded-full border-2"
                         <?php if ($enable_switching) : ?>
                             :class="currentTestimonial === <?php echo $index; ?> ? 'border-pgfy-primary-500' : 'border-transparent'"
                         <?php else : ?>
                             class="<?php echo $index === 0 ? 'border-pgfy-primary-500' : 'border-transparent'; ?>"
                         <?php endif; ?>>
                        <img
                            src="<?php echo esc_url($testimonial['avatar_image']['url']); ?>"
                            alt="<?php echo esc_attr($testimonial['author_name'] ?? ''); ?>"
                            class="cursor-pointer rounded-full p-0.5"
                        >
                    </div>
                </div>
            <?php endif; ?>
        <?php endforeach; ?>
    </div>
    <?php
}
```

### CSS for Active State

```css
.testimonial-avatar-wrapper {
    transition: all 0.3s ease;
}

.testimonial-avatar-wrapper.active .testimonial-avatar {
    border-color: var(--pgfy-primary-500, #3b82f6);
}

.testimonial-avatar {
    transition: border-color 0.3s ease;
}

.testimonial-avatar img {
    transition: opacity 0.3s ease, transform 0.3s ease;
}

.testimonial-avatar:hover img {
    opacity: 0.8;
    transform: scale(1.05);
}
```

---

## Quote Styling

### Quote Icon/Logo

```php
<?php if (!empty($testimonial['quote_icon']['url'])) : ?>
    <img
        src="<?php echo esc_url($testimonial['quote_icon']['url']); ?>"
        alt="<?php echo esc_attr__('Quote', 'pagifye'); ?>"
        class="testimonial-quote-icon mb-6"
    >
<?php endif; ?>
```

**Controls:**
- Size: Responsive slider (20-200px)
- Spacing: Bottom margin
- Display toggle: Show/hide

### Quote Text

```php
<p class="testimonial-quote-text mt-6 text-2xl font-bold italic md:mt-10">
    "<?php echo esc_html($testimonial['quote_text']); ?>"
</p>
```

**Style Options:**
- Typography: Size, weight, line-height, letter-spacing
- Color: Text color
- Style: Normal, italic, oblique
- Spacing: Top margin
- Quotes: Automatic wrapping with quotation marks

### Quote Mark Options

For automatic quote marks without icon:

```php
// Add control
$this->add_control(
    'show_quote_marks',
    [
        'label' => __('Show Quote Marks', 'pagifye'),
        'type' => \Elementor\Controls_Manager::SWITCHER,
        'default' => 'yes',
    ]
);

$this->add_control(
    'quote_mark_style',
    [
        'label' => __('Quote Mark Style', 'pagifye'),
        'type' => \Elementor\Controls_Manager::SELECT,
        'default' => 'standard',
        'options' => [
            'standard' => __('Standard (")', 'pagifye'),
            'single' => __('Single (\')', 'pagifye'),
            'guillemet' => __('Guillemet («)', 'pagifye'),
            'custom' => __('Custom', 'pagifye'),
        ],
        'condition' => [
            'show_quote_marks' => 'yes',
        ],
    ]
);

// Rendering
<?php
$quote_marks = [
    'standard' => ['"', '"'],
    'single' => ["'", "'"],
    'guillemet' => ['«', '»'],
];
$marks = $quote_marks[$settings['quote_mark_style']] ?? ['"', '"'];
?>
<p class="testimonial-quote-text">
    <?php echo $marks[0]; ?><?php echo esc_html($testimonial['quote_text']); ?><?php echo $marks[1]; ?>
</p>
```

---

## Layout Options

### Image Position

**Control:**
```php
$this->add_control(
    'layout_direction',
    [
        'label' => __('Layout Direction', 'pagifye'),
        'type' => \Elementor\Controls_Manager::SELECT,
        'default' => 'image-left',
        'options' => [
            'image-left' => __('Image Left', 'pagifye'),
            'image-right' => __('Image Right', 'pagifye'),
        ],
    ]
);
```

**Implementation:**
```php
$flex_classes = 'flex items-center gap-8 max-md:flex-col md:gap-10 lg:gap-20';

if ($settings['layout_direction'] === 'image-right') {
    $flex_classes .= ' flex-row-reverse';
}
```

### Content Alignment

**Control:**
```php
$this->add_responsive_control(
    'content_alignment',
    [
        'label' => __('Content Alignment', 'pagifye'),
        'type' => \Elementor\Controls_Manager::CHOOSE,
        'options' => [
            'left' => [
                'title' => __('Left', 'pagifye'),
                'icon' => 'eicon-text-align-left',
            ],
            'center' => [
                'title' => __('Center', 'pagifye'),
                'icon' => 'eicon-text-align-center',
            ],
            'right' => [
                'title' => __('Right', 'pagifye'),
                'icon' => 'eicon-text-align-right',
            ],
        ],
        'default' => 'left',
        'selectors' => [
            '{{WRAPPER}} .testimonial-content' => 'text-align: {{VALUE}};',
        ],
    ]
);
```

### Vertical Alignment

```php
$this->add_responsive_control(
    'vertical_alignment',
    [
        'label' => __('Vertical Alignment', 'pagifye'),
        'type' => \Elementor\Controls_Manager::CHOOSE,
        'options' => [
            'start' => [
                'title' => __('Top', 'pagifye'),
                'icon' => 'eicon-v-align-top',
            ],
            'center' => [
                'title' => __('Middle', 'pagifye'),
                'icon' => 'eicon-v-align-middle',
            ],
            'end' => [
                'title' => __('Bottom', 'pagifye'),
                'icon' => 'eicon-v-align-bottom',
            ],
        ],
        'default' => 'center',
        'selectors' => [
            '{{WRAPPER}} .testimonial-main-content' => 'align-items: {{VALUE}};',
        ],
    ]
);
```

### Responsive Stacking

Default behavior: Stack on mobile (max-md:flex-col)

**Custom breakpoint control:**
```php
$this->add_control(
    'stack_on',
    [
        'label' => __('Stack On', 'pagifye'),
        'type' => \Elementor\Controls_Manager::SELECT,
        'default' => 'mobile',
        'options' => [
            'never' => __('Never', 'pagifye'),
            'mobile' => __('Mobile', 'pagifye'),
            'tablet' => __('Tablet', 'pagifye'),
        ],
    ]
);
```

---

## Styling Controls

### Section Background

```php
// Background Color
$this->add_control(
    'section_background_color',
    [
        'label' => __('Background Color', 'pagifye'),
        'type' => \Elementor\Controls_Manager::COLOR,
        'default' => '#374151',
        'selectors' => [
            '{{WRAPPER}} .testimonial-section' => 'background-color: {{VALUE}};',
        ],
    ]
);

// Background Type (Color, Gradient, Image)
$this->add_group_control(
    \Elementor\Group_Control_Background::get_type(),
    [
        'name' => 'section_background',
        'label' => __('Background', 'pagifye'),
        'types' => ['classic', 'gradient'],
        'selector' => '{{WRAPPER}} .testimonial-section',
    ]
);
```

### Typography Controls

All text elements need typography controls:

1. **Subtitle**
2. **Heading**
3. **Quote Text**
4. **Author Name**
5. **Author Position**

**Example:**
```php
$this->add_group_control(
    \Elementor\Group_Control_Typography::get_type(),
    [
        'name' => 'quote_text_typography',
        'label' => __('Quote Typography', 'pagifye'),
        'selector' => '{{WRAPPER}} .testimonial-quote-text',
    ]
);
```

### Border and Shadow

```php
// Featured Image Border
$this->add_group_control(
    \Elementor\Group_Control_Border::get_type(),
    [
        'name' => 'featured_image_border',
        'label' => __('Border', 'pagifye'),
        'selector' => '{{WRAPPER}} .testimonial-featured-image',
    ]
);

// Featured Image Shadow
$this->add_group_control(
    \Elementor\Group_Control_Box_Shadow::get_type(),
    [
        'name' => 'featured_image_shadow',
        'label' => __('Box Shadow', 'pagifye'),
        'selector' => '{{WRAPPER}} .testimonial-featured-image',
    ]
);
```

### Spacing Controls

**Responsive padding/margin for all major sections:**

1. Section padding
2. Header spacing
3. Content gap
4. Quote section spacing
5. Avatar spacing

### Hover Effects

```php
$this->add_control(
    'avatar_hover_opacity',
    [
        'label' => __('Hover Opacity', 'pagifye'),
        'type' => \Elementor\Controls_Manager::SLIDER,
        'range' => [
            'px' => [
                'min' => 0,
                'max' => 1,
                'step' => 0.1,
            ],
        ],
        'default' => [
            'size' => 0.8,
        ],
        'selectors' => [
            '{{WRAPPER}} .testimonial-avatar:hover img' => 'opacity: {{SIZE}};',
        ],
    ]
);

$this->add_control(
    'avatar_hover_scale',
    [
        'label' => __('Hover Scale', 'pagifye'),
        'type' => \Elementor\Controls_Manager::SLIDER,
        'range' => [
            'px' => [
                'min' => 0.5,
                'max' => 2,
                'step' => 0.05,
            ],
        ],
        'default' => [
            'size' => 1.05,
        ],
        'selectors' => [
            '{{WRAPPER}} .testimonial-avatar:hover img' => 'transform: scale({{SIZE}});',
        ],
    ]
);
```

---

## Alpine.js Integration

### Alpine.js Component

**File: `assets/js/testimonial-02.js`**

```javascript
/**
 * Testimonial Switcher Component
 * Alpine.js component for switching between testimonials
 */
document.addEventListener('alpine:init', () => {
    Alpine.data('testimonialSwitcher', () => ({
        currentTestimonial: 0,
        totalTestimonials: 0,
        autoPlay: false,
        autoPlayInterval: null,
        autoPlayDelay: 5000,

        init() {
            // Count testimonials
            this.totalTestimonials = this.$el.querySelectorAll('[x-if]').length;

            // Optional: Start autoplay
            if (this.autoPlay) {
                this.startAutoPlay();
            }
        },

        switchTestimonial(index) {
            if (index >= 0 && index < this.totalTestimonials) {
                this.currentTestimonial = index;

                // Reset autoplay timer
                if (this.autoPlay) {
                    this.stopAutoPlay();
                    this.startAutoPlay();
                }
            }
        },

        nextTestimonial() {
            this.currentTestimonial = (this.currentTestimonial + 1) % this.totalTestimonials;
        },

        prevTestimonial() {
            this.currentTestimonial = (this.currentTestimonial - 1 + this.totalTestimonials) % this.totalTestimonials;
        },

        startAutoPlay() {
            this.autoPlayInterval = setInterval(() => {
                this.nextTestimonial();
            }, this.autoPlayDelay);
        },

        stopAutoPlay() {
            if (this.autoPlayInterval) {
                clearInterval(this.autoPlayInterval);
                this.autoPlayInterval = null;
            }
        }
    }));
});
```

### Script Enqueuing

**In widget class:**

```php
public function get_script_depends() {
    return ['pagifye-testimonial-02', 'alpine-js'];
}
```

**In main plugin file:**

```php
// Register Alpine.js
wp_register_script(
    'alpine-js',
    'https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js',
    [],
    '3.13.0',
    true
);

// Register widget script
wp_register_script(
    'pagifye-testimonial-02',
    PAGIFYE_ASSETS_URL . '/js/testimonial-02.js',
    ['alpine-js'],
    PAGIFYE_VERSION,
    true
);
```

### Alpine.js in Render

```php
// Main section wrapper
$alpine_data = '';
if ($settings['enable_avatar_switching'] === 'yes' && $settings['show_avatar_selector'] === 'yes') {
    $alpine_data = "x-data='testimonialSwitcher()'";
}
?>
<section class="testimonial-section" <?php echo $alpine_data; ?>>
    <!-- Content -->
</section>
```

### Template Switching

```php
<?php foreach ($settings['testimonials'] as $index => $testimonial) : ?>
    <template x-if="currentTestimonial === <?php echo $index; ?>">
        <div class="testimonial-item">
            <!-- Testimonial content -->
        </div>
    </template>
<?php endforeach; ?>
```

### Optional: Autoplay Control

```php
$this->add_control(
    'enable_autoplay',
    [
        'label' => __('Enable Autoplay', 'pagifye'),
        'type' => \Elementor\Controls_Manager::SWITCHER,
        'default' => 'no',
        'condition' => [
            'enable_avatar_switching' => 'yes',
        ],
    ]
);

$this->add_control(
    'autoplay_delay',
    [
        'label' => __('Autoplay Delay (ms)', 'pagifye'),
        'type' => \Elementor\Controls_Manager::NUMBER,
        'default' => 5000,
        'min' => 1000,
        'step' => 500,
        'condition' => [
            'enable_autoplay' => 'yes',
            'enable_avatar_switching' => 'yes',
        ],
    ]
);

// In render method
if ($settings['enable_autoplay'] === 'yes') {
    $alpine_data = sprintf(
        "x-data='testimonialSwitcher()' x-init='autoPlay = true; autoPlayDelay = %d; startAutoPlay()'",
        $settings['autoplay_delay']
    );
}
```

### Optional: Navigation Arrows

```php
<!-- Previous Button -->
<button
    type="button"
    class="testimonial-nav-prev"
    @click="prevTestimonial()"
    :disabled="currentTestimonial === 0">
    <svg><!-- Arrow icon --></svg>
</button>

<!-- Next Button -->
<button
    type="button"
    class="testimonial-nav-next"
    @click="nextTestimonial()"
    :disabled="currentTestimonial === totalTestimonials - 1">
    <svg><!-- Arrow icon --></svg>
</button>
```

---

## Implementation Steps

### Step 1: File Setup

1. Create widget file: `includes/widgets/testimonial-02.php`
2. Create stylesheet: `assets/css/widgets/testimonial-02.css`
3. Create JavaScript: `assets/js/widgets/testimonial-02.js`

### Step 2: Widget Registration

**In `includes/plugin.php`:**

```php
public function register_widgets() {
    // ... other widgets

    require_once PAGIFYE_PATH . 'includes/widgets/testimonial-02.php';
    \Elementor\Plugin::instance()->widgets_manager->register(new \Pagifye\Widgets\Testimonial_02());
}
```

### Step 3: Implement Widget Class Structure

1. Create basic class extending `Widget_Base`
2. Implement required methods:
   - `get_name()`
   - `get_title()`
   - `get_icon()`
   - `get_categories()`
   - `get_keywords()`
3. Add dependencies:
   - `get_style_depends()`
   - `get_script_depends()`

### Step 4: Register Controls (Content Tab)

1. **Header Section:**
   - Show header toggle
   - Subtitle text
   - Heading text
   - Heading highlight
   - Heading tag

2. **Testimonials Repeater:**
   - Create repeater instance
   - Add all repeater fields
   - Set default values
   - Register repeater control

3. **Layout Section:**
   - Layout direction
   - Show avatar selector
   - Enable avatar switching
   - Content alignment

### Step 5: Register Controls (Style Tab)

1. **Section Style:**
   - Background color
   - Text color
   - Padding
   - Margin

2. **Header Style:**
   - Subtitle color & typography
   - Heading color & typography
   - Highlight color
   - Spacing
   - Max width

3. **Featured Image Style:**
   - Width & height
   - Border radius
   - Object fit & position
   - Border & shadow

4. **Quote Style:**
   - Icon size
   - Text color & typography
   - Text style (italic)
   - Spacing

5. **Author Style:**
   - Name color & typography
   - Position color & typography
   - Spacing

6. **Avatar Style:**
   - Size
   - Gap
   - Border radius
   - Active border color & width
   - Hover effects

7. **Layout Spacing:**
   - Content gap
   - Quote section spacing
   - Avatar section spacing

### Step 6: Implement Render Method

1. Get settings
2. Check if testimonials exist
3. Build wrapper classes
4. Add Alpine.js data attribute (conditional)
5. Render section wrapper
6. Render header (conditional)
7. Render main content:
   - If Alpine enabled: Loop all testimonials with templates
   - If disabled: Show first testimonial only
8. Render featured image
9. Render quote section
10. Render avatar selector (conditional)

### Step 7: Create Helper Methods

1. `render_header($settings)`
2. `render_main_content($settings)`
3. `render_testimonials_with_alpine($settings)`
4. `render_single_testimonial($settings, $index)`
5. `render_featured_image($testimonial, $index)`
6. `render_content_area($testimonial, $settings, $index)`
7. `render_quote_section($testimonial)`
8. `render_avatar_selector($settings)`

### Step 8: Styling (CSS)

**File: `assets/css/widgets/testimonial-02.css`**

```css
/* Section */
.testimonial-section {
    /* Base styles handled by Tailwind and Elementor */
}

/* Container */
.testimonial-section .container {
    /* Responsive container */
}

/* Header */
.testimonial-header {
    /* Centered header with max-width */
}

.testimonial-subtitle {
    /* Subtitle styles */
}

.testimonial-heading {
    /* Main heading styles */
}

.testimonial-heading-highlight {
    /* Highlight color */
}

/* Featured Image */
.testimonial-featured-image {
    transition: all 0.3s ease;
}

.testimonial-featured-bg {
    /* Background container */
}

/* Quote */
.testimonial-quote-icon {
    max-width: 100%;
    height: auto;
}

.testimonial-quote-text {
    /* Quote text styles */
}

/* Author */
.testimonial-author-info {
    /* Author info container */
}

.testimonial-author-name {
    /* Bold name */
}

.testimonial-author-position {
    /* Position/company */
}

/* Avatars */
.testimonial-avatars {
    display: flex;
    align-items: center;
}

.testimonial-avatar-wrapper {
    transition: all 0.3s ease;
}

.testimonial-avatar {
    border-style: solid;
    transition: border-color 0.3s ease;
}

.testimonial-avatar img {
    transition: opacity 0.3s ease, transform 0.3s ease;
    display: block;
}

.testimonial-avatar:hover img {
    opacity: 0.8;
    transform: scale(1.05);
}

/* Alpine.js transitions */
[x-cloak] {
    display: none !important;
}

.testimonial-item {
    animation: fadeIn 0.3s ease-in-out;
}

@keyframes fadeIn {
    from {
        opacity: 0;
        transform: translateY(10px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Responsive adjustments */
@media (max-width: 767px) {
    .testimonial-main-content {
        flex-direction: column;
    }
}
```

### Step 9: JavaScript Implementation

Implement Alpine.js component (see Alpine.js Integration section)

### Step 10: Asset Registration

**In main plugin file:**

```php
public function register_frontend_scripts() {
    // Alpine.js
    wp_register_script(
        'alpine-js',
        'https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js',
        [],
        '3.13.0',
        true
    );

    // Widget script
    wp_register_script(
        'pagifye-testimonial-02',
        PAGIFYE_ASSETS_URL . '/js/widgets/testimonial-02.js',
        ['alpine-js'],
        PAGIFYE_VERSION,
        true
    );

    // Widget stylesheet
    wp_register_style(
        'pagifye-testimonial-02',
        PAGIFYE_ASSETS_URL . '/css/widgets/testimonial-02.css',
        [],
        PAGIFYE_VERSION
    );
}
```

### Step 11: Testing

Run through testing checklist (see below)

### Step 12: Documentation

1. Add inline code comments
2. Create usage guide
3. Document customization options
4. Add to main plugin documentation

---

## Testing Checklist

### Functional Testing

- [ ] Widget appears in Elementor panel
- [ ] Widget icon displays correctly
- [ ] Widget can be dragged to canvas
- [ ] All controls render properly in editor
- [ ] Default values load correctly
- [ ] Repeater can add/remove items
- [ ] Repeater items can be reordered
- [ ] Image uploads work for all image fields
- [ ] Media library integration works
- [ ] Settings persist after saving

### Content Testing

- [ ] Header shows/hides correctly
- [ ] Subtitle displays and updates
- [ ] Heading text renders properly
- [ ] Heading highlight applies color
- [ ] Heading tag changes work
- [ ] Featured image displays
- [ ] Featured image background color applies
- [ ] Quote icon displays
- [ ] Quote text renders with proper formatting
- [ ] Author name displays
- [ ] Author position displays
- [ ] Avatar images display
- [ ] Empty states handled gracefully

### Layout Testing

- [ ] Image left layout works
- [ ] Image right layout works
- [ ] Content alignment (left/center/right) works
- [ ] Vertical alignment works
- [ ] Responsive stacking works on mobile
- [ ] Responsive stacking works on tablet
- [ ] Container width respects settings
- [ ] Gaps/spacing update correctly

### Style Testing

- [ ] Background color applies
- [ ] Text color applies
- [ ] All typography controls work
- [ ] All color controls work
- [ ] Padding controls work
- [ ] Margin controls work
- [ ] Border radius works on featured image
- [ ] Object-fit works on featured image
- [ ] Object-position works on featured image
- [ ] Avatar size control works
- [ ] Avatar gap control works
- [ ] Avatar border controls work
- [ ] Avatar active state styles correctly
- [ ] Hover effects work on avatars

### Alpine.js Testing

- [ ] Alpine.js loads correctly
- [ ] Avatar clicking switches testimonials
- [ ] Active state updates on click
- [ ] First testimonial active by default
- [ ] x-if templates render correctly
- [ ] Transitions smooth between testimonials
- [ ] Autoplay works (if enabled)
- [ ] Autoplay delay respects setting
- [ ] Autoplay stops on manual interaction

### Responsive Testing

- [ ] Desktop (1920px+) displays correctly
- [ ] Laptop (1366px) displays correctly
- [ ] Tablet landscape (1024px) displays correctly
- [ ] Tablet portrait (768px) displays correctly
- [ ] Mobile landscape (640px) displays correctly
- [ ] Mobile portrait (375px) displays correctly
- [ ] All responsive controls work per breakpoint
- [ ] Typography scales appropriately
- [ ] Images scale appropriately

### Browser Testing

- [ ] Chrome (latest)
- [ ] Firefox (latest)
- [ ] Safari (latest)
- [ ] Edge (latest)
- [ ] Mobile Safari (iOS)
- [ ] Mobile Chrome (Android)

### Performance Testing

- [ ] Widget loads quickly
- [ ] No console errors
- [ ] No JavaScript errors
- [ ] Alpine.js performance acceptable
- [ ] Images lazy load (if implemented)
- [ ] CSS loads without blocking
- [ ] No layout shift (CLS)
- [ ] Animations smooth (60fps)

### Accessibility Testing

- [ ] Images have alt text
- [ ] Heading hierarchy logical
- [ ] Color contrast meets WCAG AA
- [ ] Keyboard navigation works
- [ ] Focus indicators visible
- [ ] Screen reader friendly
- [ ] ARIA labels where needed
- [ ] Semantic HTML used

### Editor Experience

- [ ] Live preview updates immediately
- [ ] No lag when typing in controls
- [ ] Repeater UI responsive
- [ ] Color picker works
- [ ] Typography controls work
- [ ] Media picker works
- [ ] Undo/redo works
- [ ] Copy/paste widget works
- [ ] Duplicate widget works

### Integration Testing

- [ ] Works with other Elementor widgets
- [ ] Works in sections/columns
- [ ] Works with Elementor Pro features
- [ ] Works with global colors
- [ ] Works with global fonts
- [ ] Works with custom CSS
- [ ] Exports/imports correctly
- [ ] Template library compatible

---

## Code Snippets

### Complete Control Registration Example

```php
/**
 * Register header section controls
 */
private function register_header_controls() {
    $this->start_controls_section(
        'header_section',
        [
            'label' => __('Header', 'pagifye'),
            'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
        ]
    );

    $this->add_control(
        'show_header',
        [
            'label' => __('Show Header', 'pagifye'),
            'type' => \Elementor\Controls_Manager::SWITCHER,
            'label_on' => __('Yes', 'pagifye'),
            'label_off' => __('No', 'pagifye'),
            'return_value' => 'yes',
            'default' => 'yes',
        ]
    );

    $this->add_control(
        'subtitle',
        [
            'label' => __('Subtitle', 'pagifye'),
            'type' => \Elementor\Controls_Manager::TEXT,
            'default' => __('Testimonials', 'pagifye'),
            'placeholder' => __('Enter subtitle', 'pagifye'),
            'label_block' => true,
            'condition' => [
                'show_header' => 'yes',
            ],
        ]
    );

    $this->add_control(
        'heading_text',
        [
            'label' => __('Heading Normal Text', 'pagifye'),
            'type' => \Elementor\Controls_Manager::TEXT,
            'default' => __('What Client say about', 'pagifye'),
            'placeholder' => __('Enter heading', 'pagifye'),
            'label_block' => true,
            'condition' => [
                'show_header' => 'yes',
            ],
        ]
    );

    $this->add_control(
        'heading_highlight',
        [
            'label' => __('Heading Highlight Text', 'pagifye'),
            'type' => \Elementor\Controls_Manager::TEXT,
            'default' => __('our Business', 'pagifye'),
            'placeholder' => __('Enter highlight text', 'pagifye'),
            'label_block' => true,
            'condition' => [
                'show_header' => 'yes',
            ],
        ]
    );

    $this->add_control(
        'heading_tag',
        [
            'label' => __('Heading HTML Tag', 'pagifye'),
            'type' => \Elementor\Controls_Manager::SELECT,
            'default' => 'h1',
            'options' => [
                'h1' => __('H1', 'pagifye'),
                'h2' => __('H2', 'pagifye'),
                'h3' => __('H3', 'pagifye'),
                'h4' => __('H4', 'pagifye'),
                'h5' => __('H5', 'pagifye'),
                'h6' => __('H6', 'pagifye'),
                'div' => __('div', 'pagifye'),
                'p' => __('p', 'pagifye'),
            ],
            'condition' => [
                'show_header' => 'yes',
            ],
        ]
    );

    $this->end_controls_section();
}
```

### Complete Render Example

```php
/**
 * Render widget output
 */
protected function render() {
    $settings = $this->get_settings_for_display();

    // Early return if no testimonials
    if (empty($settings['testimonials'])) {
        echo '<p>' . __('Please add testimonials in the widget settings.', 'pagifye') . '</p>';
        return;
    }

    // Build wrapper classes
    $wrapper_classes = [
        'testimonial-section',
        'py-10 md:py-20 lg:py-28'
    ];

    // Add Alpine.js data attribute if switching is enabled
    $alpine_attrs = '';
    if ($settings['enable_avatar_switching'] === 'yes' && $settings['show_avatar_selector'] === 'yes') {
        $alpine_attrs = "x-data='testimonialSwitcher()'";
    }

    ?>
    <section class="<?php echo esc_attr(implode(' ', $wrapper_classes)); ?>" <?php echo $alpine_attrs; ?>>
        <div class="container">
            <?php
            // Render header if enabled
            if ($settings['show_header'] === 'yes') {
                $this->render_header($settings);
            }

            // Render main content
            $this->render_main_content($settings);
            ?>
        </div>
    </section>
    <?php
}

/**
 * Render section header
 */
private function render_header($settings) {
    if (empty($settings['subtitle']) && empty($settings['heading_text']) && empty($settings['heading_highlight'])) {
        return;
    }

    $heading_tag = $settings['heading_tag'];
    ?>
    <div class="testimonial-header mx-auto mb-10 w-full text-center lg:mb-16">
        <?php if (!empty($settings['subtitle'])) : ?>
            <p class="testimonial-subtitle text-base font-bold">
                <?php echo esc_html($settings['subtitle']); ?>
            </p>
        <?php endif; ?>

        <?php if (!empty($settings['heading_text']) || !empty($settings['heading_highlight'])) : ?>
            <<?php echo esc_attr($heading_tag); ?> class="testimonial-heading text-4xl font-bold capitalize md:text-[40px] md:leading-[48px] lg:text-5xl lg:leading-[56px] mt-4">
                <?php if (!empty($settings['heading_text'])) : ?>
                    <span><?php echo esc_html($settings['heading_text']); ?></span>
                <?php endif; ?>
                <?php if (!empty($settings['heading_highlight'])) : ?>
                    <span class="testimonial-heading-highlight">
                        <?php echo esc_html($settings['heading_highlight']); ?>
                    </span>
                <?php endif; ?>
            </<?php echo esc_attr($heading_tag); ?>>
        <?php endif; ?>
    </div>
    <?php
}
```

### Alpine.js Integration Snippet

```php
/**
 * Render main content with Alpine.js support
 */
private function render_main_content($settings) {
    $layout_direction = $settings['layout_direction'];
    $flex_classes = 'flex items-center gap-8 max-md:flex-col md:gap-10 lg:gap-20';

    if ($layout_direction === 'image-right') {
        $flex_classes .= ' flex-row-reverse';
    }

    $enable_switching = $settings['enable_avatar_switching'] === 'yes' && $settings['show_avatar_selector'] === 'yes';

    if ($enable_switching) {
        // Render all testimonials with Alpine.js templates
        foreach ($settings['testimonials'] as $index => $testimonial) {
            ?>
            <template x-if="currentTestimonial === <?php echo $index; ?>">
                <div class="testimonial-main-content <?php echo esc_attr($flex_classes); ?>">
                    <?php
                    $this->render_featured_image($testimonial, $index);
                    $this->render_content_area($testimonial, $settings, $index);
                    ?>
                </div>
            </template>
            <?php
        }
    } else {
        // Show only first testimonial
        ?>
        <div class="testimonial-main-content <?php echo esc_attr($flex_classes); ?>">
            <?php
            $testimonial = $settings['testimonials'][0];
            $this->render_featured_image($testimonial, 0);
            $this->render_content_area($testimonial, $settings, 0);
            ?>
        </div>
        <?php
    }
}
```

### Responsive Control Snippet

```php
/**
 * Example of responsive control
 */
$this->add_responsive_control(
    'section_padding',
    [
        'label' => __('Padding', 'pagifye'),
        'type' => \Elementor\Controls_Manager::DIMENSIONS,
        'size_units' => ['px', 'em', 'rem', '%'],
        'default' => [
            'top' => '40',
            'right' => '0',
            'bottom' => '40',
            'left' => '0',
            'unit' => 'px',
            'isLinked' => false,
        ],
        'tablet_default' => [
            'top' => '80',
            'right' => '0',
            'bottom' => '80',
            'left' => '0',
            'unit' => 'px',
        ],
        'mobile_default' => [
            'top' => '40',
            'right' => '0',
            'bottom' => '40',
            'left' => '0',
            'unit' => 'px',
        ],
        'selectors' => [
            '{{WRAPPER}} .testimonial-section' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ],
    ]
);
```

---

## Notes & Considerations

### Design System Consistency

- Use Pagifye color variables (`pgfy-primary-500`, `pgfy-gray-400`, etc.)
- Maintain consistent spacing scale
- Follow Tailwind's responsive breakpoints
- Keep typography hierarchy

### Performance Optimization

1. **Image Loading:**
   - Use lazy loading for featured images
   - Register custom image sizes
   - Implement srcset for responsive images

2. **Script Loading:**
   - Only load Alpine.js when needed
   - Use `get_script_depends()` properly
   - Defer non-critical scripts

3. **CSS Optimization:**
   - Minimize inline styles
   - Use Tailwind classes where possible
   - Purge unused CSS in production

### Accessibility

- Always provide alt text for images
- Use semantic HTML (proper heading hierarchy)
- Ensure keyboard navigation works
- Maintain color contrast ratios
- Add ARIA labels where appropriate

### Browser Compatibility

- Test Alpine.js in older browsers
- Provide fallbacks for CSS features
- Use autoprefixer for vendor prefixes
- Test on mobile browsers

### Future Enhancements

1. **Animation Options:**
   - Slide transitions
   - Fade effects
   - Custom animations

2. **Additional Layouts:**
   - Centered layout
   - Grid layout for multiple testimonials
   - Carousel mode

3. **Advanced Features:**
   - Star ratings
   - Social media integration
   - Video testimonials
   - Dynamic data from custom post types

4. **Integration:**
   - WooCommerce reviews
   - Google Reviews API
   - Custom testimonial post type

### Maintenance

- Document custom CSS classes
- Keep Alpine.js updated
- Test with new Elementor versions
- Monitor for WordPress compatibility
- Track user feedback for improvements

---

## Conclusion

This implementation plan provides a comprehensive guide for developing the Testimonial-02 Elementor widget. It covers all aspects from controls registration to rendering, styling, and JavaScript integration.

**Key Takeaways:**

1. **Modular Structure:** Break down the widget into logical sections
2. **Flexible Controls:** Provide extensive customization options
3. **Responsive Design:** Ensure mobile-first approach
4. **Interactive Features:** Use Alpine.js for dynamic testimonial switching
5. **Code Quality:** Follow WordPress and Elementor coding standards
6. **User Experience:** Make it intuitive for non-technical users

**Development Timeline Estimate:**

- Setup & Structure: 2-3 hours
- Controls Registration: 4-5 hours
- Render Implementation: 4-6 hours
- Styling & CSS: 3-4 hours
- Alpine.js Integration: 2-3 hours
- Testing & Refinement: 4-5 hours
- Documentation: 2-3 hours

**Total: ~25-30 hours** for complete implementation

---

**Document Version:** 1.0.0
**Created:** 2025-11-02
**Author:** Implementation Planning Team
**Status:** Ready for Development
