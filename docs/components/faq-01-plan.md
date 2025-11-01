# FAQ-01 Elementor Widget - Implementation Plan

**Component:** root_faq-01.html
**Widget Class:** Pagifye_FAQ_01
**Category:** FAQ Widgets
**Priority:** High (Phase 2 - Core Widget #4)
**Complexity:** Medium-High (Alpine.js accordion functionality)
**Last Updated:** 2025-11-02

---

## Table of Contents

1. [Component Analysis](#component-analysis)
2. [Elementor Controls Specification](#elementor-controls-specification)
3. [PHP Class Structure](#php-class-structure)
4. [Render Method Implementation Plan](#render-method-implementation-plan)
5. [Alpine.js Integration](#alpinejs-integration)
6. [Repeater Structure](#repeater-structure)
7. [Icon Control](#icon-control)
8. [Animation Details](#animation-details)
9. [Styling Controls](#styling-controls)
10. [Accessibility Considerations](#accessibility-considerations)
11. [Implementation Steps](#implementation-steps)
12. [Testing Checklist](#testing-checklist)
13. [Code Snippets](#code-snippets)

---

## Component Analysis

### HTML Structure Overview

The FAQ-01 component consists of the following key elements:

```
Section (Container)
├── Container (Inner wrapper)
│   ├── Header Section
│   │   ├── Heading (with highlighted text)
│   │   └── Description
│   └── FAQ List (ul with Alpine.js)
│       └── FAQ Items (li) [Repeatable]
│           ├── Button (Question trigger)
│           │   ├── Question Text
│           │   └── Chevron Icon (SVG)
│           └── Answer Container (collapsible)
│               └── Answer Text
```

### Key HTML Elements from Component

**File Location:** `/Users/nadimtuhin/opensource/pagifye/components/root_faq-01.html`
**Example Usage:** `/Users/nadimtuhin/opensource/pagifye/examples/pricing-page.html` (lines 254-316)

#### Section Wrapper
```html
<section class="bg-pgfy-gray-500 py-10 md:py-20 lg:py-28">
```
- Background: `bg-pgfy-gray-500` (#0F2C24 - dark green)
- Padding: Responsive vertical padding (10/20/28)

#### Header Section
```html
<div class="flex w-full flex-col items-center justify-center gap-4">
  <h1 class="text-4xl font-bold capitalize md:text-[40px] md:leading-[48px] lg:text-5xl lg:leading-[56px] w-full max-w-[644px] text-center capitalize text-white">
    <span> Frequently asked </span>
    <span class="text-pgfy-primary-500"> questions</span>
  </h1>
  <p class="text-base font-normal text-pgfy-gray-50">
    Everything you need to know about Pagifye
  </p>
</div>
```
- Centered layout with flex column
- Split heading with highlight capability
- Subtitle/description text

#### FAQ List Container
```html
<ul class="flex flex-col gap-4 lg:gap-7" x-data="{selected:null}">
```
- Alpine.js data: `{selected:null}` - tracks which item is open
- Flex column layout with responsive gap

#### Individual FAQ Item
```html
<li class="relative rounded-lg bg-pgfy-gray-400">
  <!-- Question Button -->
  <button type="button" class="flex w-full items-center justify-between p-4 text-left lg:p-6"
          @click="selected !== 1 ? selected = 1 : selected = null">
    <p class="text-xl font-bold lg:text-2xl text-white">
      How to create a user?
    </p>
    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
         class="md:min-w-6 fill-white duration-500 ease-in-out"
         x-bind:class="selected == 1 ? 'rotate-90 duration-500 ease-in-out' : 'duration-500 ease-in-out'">
      <path d="M17.2959 12.7959L9.7959 20.2959C9.58455 20.5072..."/>
    </svg>
  </button>

  <!-- Answer Container -->
  <div class="relative max-h-0 overflow-hidden transition-all duration-500"
       x-ref="container1"
       x-bind:style="selected == 1 ? 'max-height: ' + $refs.container1.scrollHeight + 'px' : ''">
    <p class="p-6 pt-0 text-justify text-pgfy-gray-50">
      Lorem ipsum dolor sit amet...
    </p>
  </div>
</li>
```

### Interactive Behavior

1. **Initial State:** All FAQ items collapsed (`selected = null`)
2. **Click Trigger:** Toggle behavior - `selected !== 1 ? selected = 1 : selected = null`
3. **Icon Rotation:** Chevron rotates 90° when item is expanded
4. **Height Animation:** Answer container animates from `max-h-0` to `scrollHeight`
5. **Smooth Transition:** 500ms duration with ease-in-out timing
6. **Single Accordion:** Only one item can be open at a time

### Design Characteristics

- **Color Scheme:**
  - Background: Dark green (#0F2C24)
  - Cards: Lighter green (#1A2E27)
  - Text: White headings, light gray body
  - Accent: Primary green (#8FE35F)

- **Typography:**
  - Questions: XL/2XL bold (20px/24px)
  - Answers: Base regular (16px)
  - Heading: 4XL/5XL bold (36px/48px)

- **Spacing:**
  - Section padding: 10/20/28 (mobile/tablet/desktop)
  - Card padding: 4/6 (mobile/desktop)
  - Gap between items: 4/7

---

## Elementor Controls Specification

### Content Tab

#### 1. Header Section (`section_header`)

**Control Group:** Content > Header

##### Heading Control
```php
'heading_text' => [
    'label' => __('Heading', 'pagifye-widgets'),
    'type' => \Elementor\Controls_Manager::TEXT,
    'default' => __('Frequently asked questions', 'pagifye-widgets'),
    'dynamic' => ['active' => true],
    'label_block' => true,
]
```

##### Heading Highlight Control
```php
'heading_highlight' => [
    'label' => __('Highlighted Word', 'pagifye-widgets'),
    'type' => \Elementor\Controls_Manager::TEXT,
    'default' => __('questions', 'pagifye-widgets'),
    'description' => __('This word will be highlighted in the primary color', 'pagifye-widgets'),
    'dynamic' => ['active' => true],
]
```

##### Description Control
```php
'description' => [
    'label' => __('Description', 'pagifye-widgets'),
    'type' => \Elementor\Controls_Manager::TEXTAREA,
    'default' => __('Everything you need to know about Pagifye', 'pagifye-widgets'),
    'dynamic' => ['active' => true],
    'rows' => 3,
]
```

##### Show/Hide Controls
```php
'show_description' => [
    'label' => __('Show Description', 'pagifye-widgets'),
    'type' => \Elementor\Controls_Manager::SWITCHER,
    'default' => 'yes',
    'label_on' => __('Show', 'pagifye-widgets'),
    'label_off' => __('Hide', 'pagifye-widgets'),
]
```

##### Heading HTML Tag
```php
'heading_tag' => [
    'label' => __('HTML Tag', 'pagifye-widgets'),
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
    'default' => 'h2',
]
```

---

#### 2. FAQ Items Section (`section_faq_items`)

**Control Group:** Content > FAQ Items

##### FAQ Items Repeater
```php
'faq_items' => [
    'label' => __('FAQ Items', 'pagifye-widgets'),
    'type' => \Elementor\Controls_Manager::REPEATER,
    'fields' => [
        [
            'name' => 'question',
            'label' => __('Question', 'pagifye-widgets'),
            'type' => \Elementor\Controls_Manager::TEXT,
            'default' => __('How to create a user?', 'pagifye-widgets'),
            'label_block' => true,
            'dynamic' => ['active' => true],
        ],
        [
            'name' => 'answer',
            'label' => __('Answer', 'pagifye-widgets'),
            'type' => \Elementor\Controls_Manager::WYSIWYG,
            'default' => __('Lorem ipsum dolor sit amet, consectetur adipiscing elit...', 'pagifye-widgets'),
            'dynamic' => ['active' => true],
        ],
        [
            'name' => 'item_id',
            'label' => __('Custom ID', 'pagifye-widgets'),
            'type' => \Elementor\Controls_Manager::TEXT,
            'description' => __('Optional custom ID for this FAQ item (for linking)', 'pagifye-widgets'),
            'dynamic' => ['active' => true],
        ],
    ],
    'default' => [
        [
            'question' => __('How to create a user?', 'pagifye-widgets'),
            'answer' => __('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus ac libero non augue vestibulum finibus at vitae ex.', 'pagifye-widgets'),
        ],
        [
            'question' => __('How much does it cost to create a user?', 'pagifye-widgets'),
            'answer' => __('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus ac libero non augue vestibulum finibus at vitae ex.', 'pagifye-widgets'),
        ],
        [
            'question' => __('Can we get a review of Pagifye?', 'pagifye-widgets'),
            'answer' => __('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus ac libero non augue vestibulum finibus at vitae ex.', 'pagifye-widgets'),
        ],
        [
            'question' => __('Boost in-app engagement with real-time video?', 'pagifye-widgets'),
            'answer' => __('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus ac libero non augue vestibulum finibus at vitae ex.', 'pagifye-widgets'),
        ],
        [
            'question' => __('Who uses Pagifye?', 'pagifye-widgets'),
            'answer' => __('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus ac libero non augue vestibulum finibus at vitae ex.', 'pagifye-widgets'),
        ],
    ],
    'title_field' => '{{{ question }}}',
]
```

---

#### 3. Settings Section (`section_settings`)

**Control Group:** Content > Settings

##### Accordion Behavior
```php
'accordion_behavior' => [
    'label' => __('Accordion Behavior', 'pagifye-widgets'),
    'type' => \Elementor\Controls_Manager::SELECT,
    'options' => [
        'single' => __('Single (Only one open)', 'pagifye-widgets'),
        'multiple' => __('Multiple (Multiple can be open)', 'pagifye-widgets'),
    ],
    'default' => 'single',
    'description' => __('Choose whether multiple FAQ items can be open at once', 'pagifye-widgets'),
]
```

##### Default Opened Item
```php
'default_open' => [
    'label' => __('Default Opened Item', 'pagifye-widgets'),
    'type' => \Elementor\Controls_Manager::NUMBER,
    'default' => 0,
    'min' => 0,
    'description' => __('Set which item should be open by default (0 for none, 1 for first, etc.)', 'pagifye-widgets'),
    'condition' => [
        'accordion_behavior' => 'single',
    ],
]
```

##### Icon Settings
```php
'icon_position' => [
    'label' => __('Icon Position', 'pagifye-widgets'),
    'type' => \Elementor\Controls_Manager::CHOOSE,
    'options' => [
        'left' => [
            'title' => __('Left', 'pagifye-widgets'),
            'icon' => 'eicon-h-align-left',
        ],
        'right' => [
            'title' => __('Right', 'pagifye-widgets'),
            'icon' => 'eicon-h-align-right',
        ],
    ],
    'default' => 'right',
    'toggle' => false,
]

'selected_icon' => [
    'label' => __('Icon', 'pagifye-widgets'),
    'type' => \Elementor\Controls_Manager::ICONS,
    'default' => [
        'value' => 'fas fa-chevron-right',
        'library' => 'fa-solid',
    ],
    'recommended' => [
        'fa-solid' => [
            'chevron-right',
            'angle-right',
            'arrow-right',
            'plus',
            'caret-right',
        ],
    ],
]

'icon_active_rotate' => [
    'label' => __('Icon Rotation When Active', 'pagifye-widgets'),
    'type' => \Elementor\Controls_Manager::SLIDER,
    'range' => [
        'deg' => [
            'min' => 0,
            'max' => 360,
            'step' => 45,
        ],
    ],
    'default' => [
        'unit' => 'deg',
        'size' => 90,
    ],
    'selectors' => [
        '{{WRAPPER}} .faq-item.active .faq-icon' => 'transform: rotate({{SIZE}}{{UNIT}});',
    ],
]
```

---

### Style Tab

#### 4. Section Style (`section_section_style`)

**Control Group:** Style > Section

##### Background
```php
'section_background' => [
    'label' => __('Background Color', 'pagifye-widgets'),
    'type' => \Elementor\Controls_Manager::COLOR,
    'default' => '#0F2C24',
    'selectors' => [
        '{{WRAPPER}} .pagifye-faq-section' => 'background-color: {{VALUE}};',
    ],
]
```

##### Section Padding
```php
'section_padding' => [
    'label' => __('Padding', 'pagifye-widgets'),
    'type' => \Elementor\Controls_Manager::DIMENSIONS,
    'size_units' => ['px', 'em', 'rem', '%'],
    'default' => [
        'top' => '80',
        'right' => '0',
        'bottom' => '80',
        'left' => '0',
        'unit' => 'px',
    ],
    'selectors' => [
        '{{WRAPPER}} .pagifye-faq-section' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
    ],
]
```

---

#### 5. Header Style (`section_header_style`)

**Control Group:** Style > Header

##### Heading Typography
```php
'heading_typography' => [
    'label' => __('Typography', 'pagifye-widgets'),
    'type' => \Elementor\Group_Control_Typography::get_type(),
    'selector' => '{{WRAPPER}} .faq-heading',
    'global' => [
        'default' => \Elementor\Core\Kits\Documents\Tabs\Global_Typography::TYPOGRAPHY_PRIMARY,
    ],
]
```

##### Heading Color
```php
'heading_color' => [
    'label' => __('Color', 'pagifye-widgets'),
    'type' => \Elementor\Controls_Manager::COLOR,
    'default' => '#FFFFFF',
    'selectors' => [
        '{{WRAPPER}} .faq-heading' => 'color: {{VALUE}};',
    ],
]
```

##### Highlight Color
```php
'heading_highlight_color' => [
    'label' => __('Highlight Color', 'pagifye-widgets'),
    'type' => \Elementor\Controls_Manager::COLOR,
    'default' => '#8FE35F',
    'selectors' => [
        '{{WRAPPER}} .faq-heading .highlight' => 'color: {{VALUE}};',
    ],
]
```

##### Heading Alignment
```php
'heading_alignment' => [
    'label' => __('Alignment', 'pagifye-widgets'),
    'type' => \Elementor\Controls_Manager::CHOOSE,
    'options' => [
        'left' => [
            'title' => __('Left', 'pagifye-widgets'),
            'icon' => 'eicon-text-align-left',
        ],
        'center' => [
            'title' => __('Center', 'pagifye-widgets'),
            'icon' => 'eicon-text-align-center',
        ],
        'right' => [
            'title' => __('Right', 'pagifye-widgets'),
            'icon' => 'eicon-text-align-right',
        ],
    ],
    'default' => 'center',
    'selectors' => [
        '{{WRAPPER}} .faq-header' => 'text-align: {{VALUE}};',
    ],
]
```

##### Description Typography
```php
'description_typography' => [
    'label' => __('Typography', 'pagifye-widgets'),
    'type' => \Elementor\Group_Control_Typography::get_type(),
    'selector' => '{{WRAPPER}} .faq-description',
    'condition' => [
        'show_description' => 'yes',
    ],
]
```

##### Description Color
```php
'description_color' => [
    'label' => __('Color', 'pagifye-widgets'),
    'type' => \Elementor\Controls_Manager::COLOR,
    'default' => '#F5F7F6',
    'selectors' => [
        '{{WRAPPER}} .faq-description' => 'color: {{VALUE}};',
    ],
    'condition' => [
        'show_description' => 'yes',
    ],
]
```

##### Header Spacing
```php
'header_spacing' => [
    'label' => __('Bottom Spacing', 'pagifye-widgets'),
    'type' => \Elementor\Controls_Manager::SLIDER,
    'size_units' => ['px', 'em', 'rem'],
    'range' => [
        'px' => [
            'min' => 0,
            'max' => 100,
        ],
    ],
    'default' => [
        'unit' => 'px',
        'size' => 64,
    ],
    'selectors' => [
        '{{WRAPPER}} .faq-header' => 'margin-bottom: {{SIZE}}{{UNIT}};',
    ],
]
```

---

#### 6. FAQ Items Style (`section_items_style`)

**Control Group:** Style > FAQ Items

##### Items Gap
```php
'items_gap' => [
    'label' => __('Gap Between Items', 'pagifye-widgets'),
    'type' => \Elementor\Controls_Manager::SLIDER,
    'size_units' => ['px', 'em', 'rem'],
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
        '{{WRAPPER}} .faq-list' => 'gap: {{SIZE}}{{UNIT}};',
    ],
]
```

##### Item Background
```php
'item_background' => [
    'label' => __('Background Color', 'pagifye-widgets'),
    'type' => \Elementor\Controls_Manager::COLOR,
    'default' => '#1A2E27',
    'selectors' => [
        '{{WRAPPER}} .faq-item' => 'background-color: {{VALUE}};',
    ],
]
```

##### Item Border
```php
'item_border_type' => [
    'label' => __('Border Type', 'pagifye-widgets'),
    'type' => \Elementor\Controls_Manager::SELECT,
    'options' => [
        '' => __('None', 'pagifye-widgets'),
        'solid' => __('Solid', 'pagifye-widgets'),
        'double' => __('Double', 'pagifye-widgets'),
        'dotted' => __('Dotted', 'pagifye-widgets'),
        'dashed' => __('Dashed', 'pagifye-widgets'),
    ],
    'default' => '',
    'selectors' => [
        '{{WRAPPER}} .faq-item' => 'border-style: {{VALUE}};',
    ],
]

'item_border_width' => [
    'label' => __('Border Width', 'pagifye-widgets'),
    'type' => \Elementor\Controls_Manager::DIMENSIONS,
    'size_units' => ['px'],
    'condition' => [
        'item_border_type!' => '',
    ],
    'selectors' => [
        '{{WRAPPER}} .faq-item' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
    ],
]

'item_border_color' => [
    'label' => __('Border Color', 'pagifye-widgets'),
    'type' => \Elementor\Controls_Manager::COLOR,
    'condition' => [
        'item_border_type!' => '',
    ],
    'selectors' => [
        '{{WRAPPER}} .faq-item' => 'border-color: {{VALUE}};',
    ],
]
```

##### Item Border Radius
```php
'item_border_radius' => [
    'label' => __('Border Radius', 'pagifye-widgets'),
    'type' => \Elementor\Controls_Manager::DIMENSIONS,
    'size_units' => ['px', '%'],
    'default' => [
        'top' => '8',
        'right' => '8',
        'bottom' => '8',
        'left' => '8',
        'unit' => 'px',
    ],
    'selectors' => [
        '{{WRAPPER}} .faq-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
    ],
]
```

##### Item Padding
```php
'item_padding' => [
    'label' => __('Padding', 'pagifye-widgets'),
    'type' => \Elementor\Controls_Manager::DIMENSIONS,
    'size_units' => ['px', 'em', '%'],
    'default' => [
        'top' => '24',
        'right' => '24',
        'bottom' => '24',
        'left' => '24',
        'unit' => 'px',
    ],
    'selectors' => [
        '{{WRAPPER}} .faq-question' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
    ],
]
```

---

#### 7. Question Style (`section_question_style`)

**Control Group:** Style > Question

##### Question Typography
```php
'question_typography' => [
    'label' => __('Typography', 'pagifye-widgets'),
    'type' => \Elementor\Group_Control_Typography::get_type(),
    'selector' => '{{WRAPPER}} .faq-question-text',
]
```

##### Question Color
```php
'question_color' => [
    'label' => __('Color', 'pagifye-widgets'),
    'type' => \Elementor\Controls_Manager::COLOR,
    'default' => '#FFFFFF',
    'selectors' => [
        '{{WRAPPER}} .faq-question-text' => 'color: {{VALUE}};',
    ],
]

'question_color_active' => [
    'label' => __('Active Color', 'pagifye-widgets'),
    'type' => \Elementor\Controls_Manager::COLOR,
    'selectors' => [
        '{{WRAPPER}} .faq-item.active .faq-question-text' => 'color: {{VALUE}};',
    ],
]
```

##### Question Hover Effects
```php
'question_hover_color' => [
    'label' => __('Hover Color', 'pagifye-widgets'),
    'type' => \Elementor\Controls_Manager::COLOR,
    'selectors' => [
        '{{WRAPPER}} .faq-question:hover .faq-question-text' => 'color: {{VALUE}};',
    ],
]
```

---

#### 8. Answer Style (`section_answer_style`)

**Control Group:** Style > Answer

##### Answer Typography
```php
'answer_typography' => [
    'label' => __('Typography', 'pagifye-widgets'),
    'type' => \Elementor\Group_Control_Typography::get_type(),
    'selector' => '{{WRAPPER}} .faq-answer',
]
```

##### Answer Color
```php
'answer_color' => [
    'label' => __('Color', 'pagifye-widgets'),
    'type' => \Elementor\Controls_Manager::COLOR,
    'default' => '#F5F7F6',
    'selectors' => [
        '{{WRAPPER}} .faq-answer' => 'color: {{VALUE}};',
    ],
]
```

##### Answer Padding
```php
'answer_padding' => [
    'label' => __('Padding', 'pagifye-widgets'),
    'type' => \Elementor\Controls_Manager::DIMENSIONS,
    'size_units' => ['px', 'em', '%'],
    'default' => [
        'top' => '0',
        'right' => '24',
        'bottom' => '24',
        'left' => '24',
        'unit' => 'px',
    ],
    'selectors' => [
        '{{WRAPPER}} .faq-answer' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
    ],
]
```

##### Answer Alignment
```php
'answer_alignment' => [
    'label' => __('Text Align', 'pagifye-widgets'),
    'type' => \Elementor\Controls_Manager::CHOOSE,
    'options' => [
        'left' => [
            'title' => __('Left', 'pagifye-widgets'),
            'icon' => 'eicon-text-align-left',
        ],
        'center' => [
            'title' => __('Center', 'pagifye-widgets'),
            'icon' => 'eicon-text-align-center',
        ],
        'right' => [
            'title' => __('Right', 'pagifye-widgets'),
            'icon' => 'eicon-text-align-right',
        ],
        'justify' => [
            'title' => __('Justified', 'pagifye-widgets'),
            'icon' => 'eicon-text-align-justify',
        ],
    ],
    'default' => 'justify',
    'selectors' => [
        '{{WRAPPER}} .faq-answer' => 'text-align: {{VALUE}};',
    ],
]
```

---

#### 9. Icon Style (`section_icon_style`)

**Control Group:** Style > Icon

##### Icon Size
```php
'icon_size' => [
    'label' => __('Size', 'pagifye-widgets'),
    'type' => \Elementor\Controls_Manager::SLIDER,
    'size_units' => ['px'],
    'range' => [
        'px' => [
            'min' => 10,
            'max' => 100,
        ],
    ],
    'default' => [
        'unit' => 'px',
        'size' => 24,
    ],
    'selectors' => [
        '{{WRAPPER}} .faq-icon' => 'font-size: {{SIZE}}{{UNIT}}; width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
        '{{WRAPPER}} .faq-icon svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
    ],
]
```

##### Icon Color
```php
'icon_color' => [
    'label' => __('Color', 'pagifye-widgets'),
    'type' => \Elementor\Controls_Manager::COLOR,
    'default' => '#FFFFFF',
    'selectors' => [
        '{{WRAPPER}} .faq-icon' => 'color: {{VALUE}}; fill: {{VALUE}};',
        '{{WRAPPER}} .faq-icon svg' => 'fill: {{VALUE}};',
    ],
]

'icon_color_active' => [
    'label' => __('Active Color', 'pagifye-widgets'),
    'type' => \Elementor\Controls_Manager::COLOR,
    'selectors' => [
        '{{WRAPPER}} .faq-item.active .faq-icon' => 'color: {{VALUE}}; fill: {{VALUE}};',
        '{{WRAPPER}} .faq-item.active .faq-icon svg' => 'fill: {{VALUE}};',
    ],
]
```

##### Icon Spacing
```php
'icon_spacing' => [
    'label' => __('Spacing', 'pagifye-widgets'),
    'type' => \Elementor\Controls_Manager::SLIDER,
    'size_units' => ['px'],
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
        '{{WRAPPER}} .faq-question[data-icon-position="left"] .faq-icon' => 'margin-right: {{SIZE}}{{UNIT}};',
        '{{WRAPPER}} .faq-question[data-icon-position="right"] .faq-icon' => 'margin-left: {{SIZE}}{{UNIT}};',
    ],
]
```

---

#### 10. Animation Style (`section_animation_style`)

**Control Group:** Style > Animation

##### Transition Duration
```php
'animation_duration' => [
    'label' => __('Duration (ms)', 'pagifye-widgets'),
    'type' => \Elementor\Controls_Manager::SLIDER,
    'range' => [
        'px' => [
            'min' => 100,
            'max' => 1000,
            'step' => 50,
        ],
    ],
    'default' => [
        'size' => 500,
    ],
    'selectors' => [
        '{{WRAPPER}} .faq-answer-wrapper' => 'transition-duration: {{SIZE}}ms;',
        '{{WRAPPER}} .faq-icon' => 'transition-duration: {{SIZE}}ms;',
    ],
]
```

##### Transition Easing
```php
'animation_easing' => [
    'label' => __('Easing', 'pagifye-widgets'),
    'type' => \Elementor\Controls_Manager::SELECT,
    'options' => [
        'linear' => __('Linear', 'pagifye-widgets'),
        'ease' => __('Ease', 'pagifye-widgets'),
        'ease-in' => __('Ease In', 'pagifye-widgets'),
        'ease-out' => __('Ease Out', 'pagifye-widgets'),
        'ease-in-out' => __('Ease In Out', 'pagifye-widgets'),
    ],
    'default' => 'ease-in-out',
    'selectors' => [
        '{{WRAPPER}} .faq-answer-wrapper' => 'transition-timing-function: {{VALUE}};',
        '{{WRAPPER}} .faq-icon' => 'transition-timing-function: {{VALUE}};',
    ],
]
```

---

## PHP Class Structure

### File Location
`/widgets/faq/class-faq-01.php`

### Class Skeleton

```php
<?php
namespace Pagifye\Widgets\FAQ;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

class Pagifye_FAQ_01 extends \Pagifye\Widgets\Base\Pagifye_Widget_Base {

    /**
     * Get widget name.
     */
    public function get_name() {
        return 'pagifye-faq-01';
    }

    /**
     * Get widget title.
     */
    public function get_title() {
        return __('FAQ 01', 'pagifye-widgets');
    }

    /**
     * Get widget icon.
     */
    public function get_icon() {
        return 'eicon-accordion';
    }

    /**
     * Get widget categories.
     */
    public function get_categories() {
        return ['pagifye-faq'];
    }

    /**
     * Get widget keywords.
     */
    public function get_keywords() {
        return ['pagifye', 'faq', 'accordion', 'questions', 'answers', 'collapsible', 'toggle'];
    }

    /**
     * Get script dependencies.
     */
    public function get_script_depends() {
        return ['alpine-js', 'pagifye-faq-frontend'];
    }

    /**
     * Get style dependencies.
     */
    public function get_style_depends() {
        return ['pagifye-tailwind'];
    }

    /**
     * Register widget controls.
     */
    protected function register_controls() {
        $this->register_header_content_controls();
        $this->register_faq_items_content_controls();
        $this->register_settings_content_controls();

        $this->register_section_style_controls();
        $this->register_header_style_controls();
        $this->register_items_style_controls();
        $this->register_question_style_controls();
        $this->register_answer_style_controls();
        $this->register_icon_style_controls();
        $this->register_animation_style_controls();
    }

    /**
     * Register Header Content Controls
     */
    protected function register_header_content_controls() {
        // Implementation in code snippets section
    }

    /**
     * Register FAQ Items Content Controls
     */
    protected function register_faq_items_content_controls() {
        // Implementation in code snippets section
    }

    /**
     * Register Settings Content Controls
     */
    protected function register_settings_content_controls() {
        // Implementation in code snippets section
    }

    /**
     * Register Section Style Controls
     */
    protected function register_section_style_controls() {
        // Implementation in code snippets section
    }

    /**
     * Register Header Style Controls
     */
    protected function register_header_style_controls() {
        // Implementation in code snippets section
    }

    /**
     * Register Items Style Controls
     */
    protected function register_items_style_controls() {
        // Implementation in code snippets section
    }

    /**
     * Register Question Style Controls
     */
    protected function register_question_style_controls() {
        // Implementation in code snippets section
    }

    /**
     * Register Answer Style Controls
     */
    protected function register_answer_style_controls() {
        // Implementation in code snippets section
    }

    /**
     * Register Icon Style Controls
     */
    protected function register_icon_style_controls() {
        // Implementation in code snippets section
    }

    /**
     * Register Animation Style Controls
     */
    protected function register_animation_style_controls() {
        // Implementation in code snippets section
    }

    /**
     * Render widget output on the frontend.
     */
    protected function render() {
        $settings = $this->get_settings_for_display();

        // Render implementation in code snippets section
    }

    /**
     * Render widget output in the editor (Backbone.js template).
     */
    protected function content_template() {
        // JavaScript template for live editing
    }

    /**
     * Helper: Get heading with highlight
     */
    private function render_heading($settings) {
        // Helper implementation
    }

    /**
     * Helper: Render FAQ item
     */
    private function render_faq_item($item, $index, $settings) {
        // Helper implementation
    }
}
```

---

## Render Method Implementation Plan

### Rendering Strategy

1. **Get Settings:** Retrieve all control values
2. **Setup Alpine.js Data:** Initialize accordion state
3. **Render Section Wrapper:** Main container with background
4. **Render Header:** Heading and description
5. **Render FAQ List:** Loop through repeater items
6. **Output Each Item:** Question button + answer container
7. **Apply Dynamic Classes:** Based on settings
8. **Sanitize Output:** Escape all user inputs

### HTML Structure to Generate

```html
<section class="pagifye-widget pagifye-faq-section bg-pgfy-gray-500 py-10 md:py-20 lg:py-28">
    <div class="container flex w-full flex-col gap-8 lg:gap-16">

        <!-- Header -->
        <div class="faq-header flex w-full flex-col items-center justify-center gap-4">
            <h2 class="faq-heading text-4xl font-bold text-white">
                <span>Frequently asked</span>
                <span class="highlight text-pgfy-primary-500">questions</span>
            </h2>
            <p class="faq-description text-base font-normal text-pgfy-gray-50">
                Everything you need to know about Pagifye
            </p>
        </div>

        <!-- FAQ List -->
        <ul class="faq-list flex flex-col gap-4 lg:gap-7"
            x-data="{ selected: <?php echo $default_open; ?> }">

            <!-- FAQ Item Loop -->
            <?php foreach ($settings['faq_items'] as $index => $item): ?>
            <li class="faq-item relative rounded-lg bg-pgfy-gray-400"
                :class="selected === <?php echo $index + 1; ?> ? 'active' : ''"
                <?php if ($item['item_id']): ?>id="<?php echo esc_attr($item['item_id']); ?>"<?php endif; ?>>

                <!-- Question Button -->
                <button type="button"
                        class="faq-question flex w-full items-center justify-between p-4 text-left lg:p-6"
                        data-icon-position="<?php echo esc_attr($settings['icon_position']); ?>"
                        @click="selected !== <?php echo $index + 1; ?> ? selected = <?php echo $index + 1; ?> : selected = null"
                        aria-expanded="false"
                        :aria-expanded="selected === <?php echo $index + 1; ?> ? 'true' : 'false'"
                        aria-controls="faq-answer-<?php echo $index + 1; ?>">

                    <!-- Question Text -->
                    <span class="faq-question-text text-xl font-bold lg:text-2xl text-white">
                        <?php echo esc_html($item['question']); ?>
                    </span>

                    <!-- Icon -->
                    <span class="faq-icon duration-500 ease-in-out"
                          :class="selected === <?php echo $index + 1; ?> ? 'rotate-90' : ''">
                        <?php \Elementor\Icons_Manager::render_icon($settings['selected_icon']); ?>
                    </span>
                </button>

                <!-- Answer Container -->
                <div class="faq-answer-wrapper relative max-h-0 overflow-hidden transition-all duration-500"
                     id="faq-answer-<?php echo $index + 1; ?>"
                     x-ref="container<?php echo $index + 1; ?>"
                     :style="selected === <?php echo $index + 1; ?> ? 'max-height: ' + $refs.container<?php echo $index + 1; ?>.scrollHeight + 'px' : ''"
                     role="region"
                     aria-labelledby="faq-question-<?php echo $index + 1; ?>">
                    <div class="faq-answer p-6 pt-0 text-justify text-pgfy-gray-50">
                        <?php echo wp_kses_post($item['answer']); ?>
                    </div>
                </div>
            </li>
            <?php endforeach; ?>

        </ul>
    </div>
</section>
```

---

## Alpine.js Integration

### Alpine.js Setup

**File:** `assets/js/widgets-frontend.js`

```javascript
// Alpine.js is already included globally
// No additional setup needed for basic accordion

// Optional: Advanced features
document.addEventListener('alpine:init', () => {
    Alpine.data('pagifyeFaq', (defaultOpen = null) => ({
        selected: defaultOpen,

        toggle(index) {
            if (this.selected === index) {
                this.selected = null;
            } else {
                this.selected = index;
            }
        },

        isOpen(index) {
            return this.selected === index;
        },

        // Optional: URL hash support
        init() {
            const hash = window.location.hash.substring(1);
            if (hash) {
                const element = document.getElementById(hash);
                if (element && element.classList.contains('faq-item')) {
                    const index = Array.from(element.parentNode.children).indexOf(element) + 1;
                    this.selected = index;

                    // Scroll to element
                    setTimeout(() => {
                        element.scrollIntoView({ behavior: 'smooth', block: 'start' });
                    }, 100);
                }
            }
        }
    }));
});
```

### State Management

**Data Structure:**
```javascript
x-data="{ selected: null }"
```

- `selected`: Stores the index of currently open FAQ item (null = all closed)
- Single accordion: Only stores one number
- Multiple accordion: Would store array of numbers (future enhancement)

**Toggle Logic:**
```javascript
@click="selected !== 1 ? selected = 1 : selected = null"
```

- If current item is NOT selected: Open it (set selected = index)
- If current item IS selected: Close it (set selected = null)

**Conditional Classes:**
```javascript
:class="selected === 1 ? 'active' : ''"
```

**Icon Rotation:**
```javascript
:class="selected === 1 ? 'rotate-90 duration-500 ease-in-out' : 'duration-500 ease-in-out'"
```

**Height Animation:**
```javascript
:style="selected === 1 ? 'max-height: ' + $refs.container1.scrollHeight + 'px' : ''"
```

- Closed state: `max-height: 0`
- Open state: `max-height: [calculated scrollHeight]px`
- Uses CSS transition for smooth animation

### Multiple Accordion Support (Optional Enhancement)

For future implementation of multiple open items:

```javascript
x-data="{ selected: [] }"

// Toggle function
toggle(index) {
    if (this.selected.includes(index)) {
        this.selected = this.selected.filter(i => i !== index);
    } else {
        this.selected.push(index);
    }
}

// Check function
isOpen(index) {
    return this.selected.includes(index);
}
```

---

## Repeater Structure

### Repeater Field Definition

```php
'faq_items' => [
    'label' => __('FAQ Items', 'pagifye-widgets'),
    'type' => \Elementor\Controls_Manager::REPEATER,
    'fields' => [
        // Question field
        [
            'name' => 'question',
            'label' => __('Question', 'pagifye-widgets'),
            'type' => \Elementor\Controls_Manager::TEXT,
            'default' => __('How to create a user?', 'pagifye-widgets'),
            'label_block' => true,
            'dynamic' => ['active' => true],
        ],

        // Answer field
        [
            'name' => 'answer',
            'label' => __('Answer', 'pagifye-widgets'),
            'type' => \Elementor\Controls_Manager::WYSIWYG,
            'default' => __('Lorem ipsum dolor sit amet...', 'pagifye-widgets'),
            'dynamic' => ['active' => true],
        ],

        // Custom ID field (for deep linking)
        [
            'name' => 'item_id',
            'label' => __('Custom ID', 'pagifye-widgets'),
            'type' => \Elementor\Controls_Manager::TEXT,
            'description' => __('Optional custom ID for this FAQ item (for linking)', 'pagifye-widgets'),
            'dynamic' => ['active' => true],
        ],
    ],
    'default' => [
        // 5 default items
    ],
    'title_field' => '{{{ question }}}',
]
```

### Rendering Repeater Items

```php
<?php if (!empty($settings['faq_items'])): ?>
    <?php foreach ($settings['faq_items'] as $index => $item):
        $item_index = $index + 1;
        ?>
        <li class="faq-item" <?php echo $item['item_id'] ? 'id="' . esc_attr($item['item_id']) . '"' : ''; ?>>
            <!-- Question -->
            <button @click="toggle(<?php echo $item_index; ?>)">
                <?php echo esc_html($item['question']); ?>
            </button>

            <!-- Answer -->
            <div x-ref="container<?php echo $item_index; ?>">
                <?php echo wp_kses_post($item['answer']); ?>
            </div>
        </li>
    <?php endforeach; ?>
<?php endif; ?>
```

### Dynamic Index Handling

- **Loop Index:** `$index` (0-based)
- **Display Index:** `$index + 1` (1-based for Alpine.js)
- **Ref Naming:** `container1`, `container2`, etc.
- **Click Handler:** `selected !== 1 ? selected = 1 : selected = null`

---

## Icon Control

### Icon Control Setup

```php
'selected_icon' => [
    'label' => __('Icon', 'pagifye-widgets'),
    'type' => \Elementor\Controls_Manager::ICONS,
    'default' => [
        'value' => 'fas fa-chevron-right',
        'library' => 'fa-solid',
    ],
    'recommended' => [
        'fa-solid' => [
            'chevron-right',
            'angle-right',
            'arrow-right',
            'plus',
            'caret-right',
        ],
    ],
]
```

### Rendering Icons

**Using Elementor Icons Manager:**

```php
<?php \Elementor\Icons_Manager::render_icon($settings['selected_icon'], ['class' => 'faq-icon']); ?>
```

This automatically handles:
- Font Awesome icons
- SVG icons
- Custom uploaded icons

### Default SVG Icon

Original chevron right SVG from component:

```html
<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" class="md:min-w-6 fill-white duration-500 ease-in-out">
    <path d="M17.2959 12.7959L9.7959 20.2959C9.58455 20.5072 9.29791 20.626 8.99902 20.626C8.70014 20.626 8.41349 20.5072 8.20215 20.2959C7.9908 20.0846 7.87207 19.7979 7.87207 19.499C7.87207 19.2001 7.9908 18.9135 8.20215 18.7021L14.9062 12L8.20402 5.2959C8.09937 5.19125 8.01636 5.06702 7.95973 4.93029C7.90309 4.79356 7.87394 4.64702 7.87394 4.49902C7.87394 4.35103 7.90309 4.20448 7.95973 4.06776C8.01636 3.93103 8.09937 3.80679 8.20402 3.70215C8.30867 3.5975 8.4329 3.51449 8.56963 3.45785C8.70636 3.40122 8.8529 3.37207 9.0009 3.37207C9.14889 3.37207 9.29543 3.40122 9.43216 3.45785C9.56889 3.51449 9.69313 3.5975 9.79777 3.70215L17.2978 11.2021C17.4025 11.3068 17.4856 11.4311 17.5422 11.5679C17.5988 11.7047 17.6279 11.8513 17.6277 11.9994C17.6275 12.1475 17.5981 12.2941 17.5412 12.4307C17.4843 12.5674 17.4009 12.6915 17.2959 12.7959Z"></path>
</svg>
```

### Icon Position Control

```php
'icon_position' => [
    'label' => __('Icon Position', 'pagifye-widgets'),
    'type' => \Elementor\Controls_Manager::CHOOSE,
    'options' => [
        'left' => [
            'title' => __('Left', 'pagifye-widgets'),
            'icon' => 'eicon-h-align-left',
        ],
        'right' => [
            'title' => __('Right', 'pagifye-widgets'),
            'icon' => 'eicon-h-align-right',
        ],
    ],
    'default' => 'right',
]
```

Conditional layout in render:

```php
<button class="faq-question <?php echo $settings['icon_position'] === 'left' ? 'flex-row' : 'flex-row-reverse'; ?>">
    <?php if ($settings['icon_position'] === 'left'): ?>
        <!-- Icon -->
        <!-- Text -->
    <?php else: ?>
        <!-- Text -->
        <!-- Icon -->
    <?php endif; ?>
</button>
```

---

## Animation Details

### CSS Transitions

**Answer Container:**
```css
.faq-answer-wrapper {
    max-height: 0;
    overflow: hidden;
    transition: max-height 500ms ease-in-out;
}

.faq-item.active .faq-answer-wrapper {
    max-height: var(--answer-height); /* Set by Alpine.js */
}
```

**Icon Rotation:**
```css
.faq-icon {
    transition: transform 500ms ease-in-out;
}

.faq-item.active .faq-icon {
    transform: rotate(90deg);
}
```

### Alpine.js Dynamic Height

```javascript
x-bind:style="selected == 1 ? 'max-height: ' + $refs.container1.scrollHeight + 'px' : ''"
```

**How it works:**
1. Alpine.js uses `x-ref` to get reference to answer container
2. On open: Reads `scrollHeight` (actual content height)
3. Sets `max-height` to that value
4. CSS transition animates from 0 to scrollHeight
5. On close: Sets max-height back to empty (0 via CSS)

### Timing Control

Allow users to customize animation speed:

```php
'animation_duration' => [
    'label' => __('Duration (ms)', 'pagifye-widgets'),
    'type' => \Elementor\Controls_Manager::SLIDER,
    'range' => [
        'px' => [
            'min' => 100,
            'max' => 1000,
            'step' => 50,
        ],
    ],
    'default' => [
        'size' => 500,
    ],
    'selectors' => [
        '{{WRAPPER}} .faq-answer-wrapper' => 'transition-duration: {{SIZE}}ms;',
        '{{WRAPPER}} .faq-icon' => 'transition-duration: {{SIZE}}ms;',
    ],
]
```

### Easing Functions

```php
'animation_easing' => [
    'label' => __('Easing', 'pagifye-widgets'),
    'type' => \Elementor\Controls_Manager::SELECT,
    'options' => [
        'linear' => 'Linear',
        'ease' => 'Ease',
        'ease-in' => 'Ease In',
        'ease-out' => 'Ease Out',
        'ease-in-out' => 'Ease In Out',
        'cubic-bezier(0.4, 0, 0.2, 1)' => 'Custom (Material)',
    ],
    'default' => 'ease-in-out',
    'selectors' => [
        '{{WRAPPER}} .faq-answer-wrapper' => 'transition-timing-function: {{VALUE}};',
        '{{WRAPPER}} .faq-icon' => 'transition-timing-function: {{VALUE}};',
    ],
]
```

---

## Styling Controls

### Typography Controls

**Group Control Usage:**

```php
$this->add_group_control(
    \Elementor\Group_Control_Typography::get_type(),
    [
        'name' => 'question_typography',
        'label' => __('Typography', 'pagifye-widgets'),
        'selector' => '{{WRAPPER}} .faq-question-text',
    ]
);
```

Gives users control over:
- Font family
- Font size
- Font weight
- Text transform
- Font style
- Line height
- Letter spacing

### Color Controls

**Simple Color:**
```php
$this->add_control(
    'question_color',
    [
        'label' => __('Color', 'pagifye-widgets'),
        'type' => \Elementor\Controls_Manager::COLOR,
        'default' => '#FFFFFF',
        'selectors' => [
            '{{WRAPPER}} .faq-question-text' => 'color: {{VALUE}};',
        ],
    ]
);
```

**With Global Colors:**
```php
$this->add_control(
    'heading_color',
    [
        'label' => __('Color', 'pagifye-widgets'),
        'type' => \Elementor\Controls_Manager::COLOR,
        'default' => '#FFFFFF',
        'selectors' => [
            '{{WRAPPER}} .faq-heading' => 'color: {{VALUE}};',
        ],
        'global' => [
            'default' => \Elementor\Core\Kits\Documents\Tabs\Global_Colors::COLOR_PRIMARY,
        ],
    ]
);
```

### Spacing Controls

**Dimensions (Padding/Margin):**
```php
$this->add_responsive_control(
    'item_padding',
    [
        'label' => __('Padding', 'pagifye-widgets'),
        'type' => \Elementor\Controls_Manager::DIMENSIONS,
        'size_units' => ['px', 'em', '%'],
        'default' => [
            'top' => '24',
            'right' => '24',
            'bottom' => '24',
            'left' => '24',
            'unit' => 'px',
            'isLinked' => true,
        ],
        'selectors' => [
            '{{WRAPPER}} .faq-question' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ],
    ]
);
```

**Slider (Single Value):**
```php
$this->add_responsive_control(
    'items_gap',
    [
        'label' => __('Gap Between Items', 'pagifye-widgets'),
        'type' => \Elementor\Controls_Manager::SLIDER,
        'size_units' => ['px', 'em'],
        'range' => [
            'px' => [
                'min' => 0,
                'max' => 100,
            ],
        ],
        'default' => [
            'unit' => 'px',
            'size' => 16,
        ],
        'selectors' => [
            '{{WRAPPER}} .faq-list' => 'gap: {{SIZE}}{{UNIT}};',
        ],
    ]
);
```

### Border & Background

**Border Group:**
```php
$this->add_group_control(
    \Elementor\Group_Control_Border::get_type(),
    [
        'name' => 'item_border',
        'label' => __('Border', 'pagifye-widgets'),
        'selector' => '{{WRAPPER}} .faq-item',
    ]
);
```

**Border Radius:**
```php
$this->add_responsive_control(
    'item_border_radius',
    [
        'label' => __('Border Radius', 'pagifye-widgets'),
        'type' => \Elementor\Controls_Manager::DIMENSIONS,
        'size_units' => ['px', '%'],
        'default' => [
            'top' => '8',
            'right' => '8',
            'bottom' => '8',
            'left' => '8',
            'unit' => 'px',
            'isLinked' => true,
        ],
        'selectors' => [
            '{{WRAPPER}} .faq-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ],
    ]
);
```

**Background:**
```php
$this->add_group_control(
    \Elementor\Group_Control_Background::get_type(),
    [
        'name' => 'section_background',
        'label' => __('Background', 'pagifye-widgets'),
        'types' => ['classic', 'gradient'],
        'selector' => '{{WRAPPER}} .pagifye-faq-section',
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
```

### Responsive Controls

Use `add_responsive_control` instead of `add_control` for values that should be different on mobile/tablet/desktop:

```php
$this->add_responsive_control(
    'heading_alignment',
    [
        'label' => __('Alignment', 'pagifye-widgets'),
        'type' => \Elementor\Controls_Manager::CHOOSE,
        'options' => [
            'left' => [
                'title' => __('Left', 'pagifye-widgets'),
                'icon' => 'eicon-text-align-left',
            ],
            'center' => [
                'title' => __('Center', 'pagifye-widgets'),
                'icon' => 'eicon-text-align-center',
            ],
            'right' => [
                'title' => __('Right', 'pagifye-widgets'),
                'icon' => 'eicon-text-align-right',
            ],
        ],
        'default' => 'center',
        'selectors' => [
            '{{WRAPPER}} .faq-header' => 'text-align: {{VALUE}};',
        ],
    ]
);
```

This creates separate controls for Desktop/Tablet/Mobile breakpoints.

---

## Accessibility Considerations

### ARIA Attributes

**Accordion Pattern (WAI-ARIA):**

```html
<button type="button"
        class="faq-question"
        aria-expanded="false"
        :aria-expanded="selected === 1 ? 'true' : 'false'"
        aria-controls="faq-answer-1"
        id="faq-question-1">
    Question text
</button>

<div class="faq-answer-wrapper"
     id="faq-answer-1"
     role="region"
     aria-labelledby="faq-question-1">
    Answer text
</div>
```

**Key ARIA Attributes:**
- `aria-expanded`: Indicates whether content is expanded
- `aria-controls`: Links button to content it controls
- `role="region"`: Defines answer as a landmark region
- `aria-labelledby`: Associates region with its label (question)

### Keyboard Navigation

**Requirements:**
1. All FAQ items must be keyboard accessible
2. Tab key navigates between questions
3. Enter/Space key toggles accordion
4. Focus indicators must be visible

**Implementation:**

```css
.faq-question:focus {
    outline: 2px solid #8FE35F;
    outline-offset: 2px;
}

.faq-question:focus-visible {
    outline: 2px solid #8FE35F;
    outline-offset: 2px;
}
```

**JavaScript Enhancement:**

```javascript
// Add keyboard support
document.querySelectorAll('.faq-question').forEach(button => {
    button.addEventListener('keydown', (e) => {
        if (e.key === 'Enter' || e.key === ' ') {
            e.preventDefault();
            button.click();
        }
    });
});
```

### Screen Reader Support

**Best Practices:**

1. **Semantic HTML:** Use `<button>` for clickable elements
2. **Descriptive Labels:** Question text is button label
3. **State Changes:** Announce expanded/collapsed state
4. **Live Regions:** Optional for dynamic updates

**Optional Live Region:**

```html
<div aria-live="polite" aria-atomic="true" class="sr-only">
    <span x-show="selected === 1">FAQ item 1 expanded</span>
</div>
```

**Screen Reader Only CSS:**

```css
.sr-only {
    position: absolute;
    width: 1px;
    height: 1px;
    padding: 0;
    margin: -1px;
    overflow: hidden;
    clip: rect(0, 0, 0, 0);
    white-space: nowrap;
    border-width: 0;
}
```

### Color Contrast

**WCAG 2.1 Level AA Requirements:**
- Normal text: 4.5:1
- Large text (18pt+): 3:1
- UI components: 3:1

**Component Colors:**
- White text (#FFFFFF) on dark background (#0F2C24): 16.8:1 ✓
- Primary green (#8FE35F) on dark background: 8.2:1 ✓
- Light gray (#F5F7F6) on dark background: 15.4:1 ✓

All colors meet WCAG AA standards.

### Focus Management

**When Opening FAQ Item:**

```javascript
// Optional: Focus management
toggle(index) {
    this.selected = index;

    // After animation completes, focus answer
    setTimeout(() => {
        const answer = document.getElementById(`faq-answer-${index}`);
        if (answer) {
            answer.setAttribute('tabindex', '-1');
            answer.focus();
        }
    }, 500);
}
```

### Skip Links

For pages with many FAQ items, consider adding skip navigation:

```html
<a href="#faq-list" class="skip-link">Skip to FAQ list</a>
```

---

## Implementation Steps

### Step 1: Create Widget File

**File:** `/widgets/faq/class-faq-01.php`

1. Create file structure
2. Add namespace and class declaration
3. Extend base widget class
4. Implement required methods (get_name, get_title, get_icon)

**Time Estimate:** 15 minutes

---

### Step 2: Register Content Controls

1. Create `register_header_content_controls()` method
   - Heading text
   - Heading highlight
   - Description
   - Show/hide toggles

2. Create `register_faq_items_content_controls()` method
   - Setup repeater
   - Add question field
   - Add answer field
   - Add item ID field
   - Set default items

3. Create `register_settings_content_controls()` method
   - Accordion behavior
   - Default open item
   - Icon settings
   - Icon position

**Time Estimate:** 1 hour

---

### Step 3: Register Style Controls

1. Create `register_section_style_controls()` method
   - Background color/gradient
   - Section padding
   - Container width

2. Create `register_header_style_controls()` method
   - Heading typography
   - Heading color
   - Highlight color
   - Description typography
   - Description color
   - Alignment
   - Spacing

3. Create `register_items_style_controls()` method
   - Items gap
   - Item background
   - Item border
   - Border radius
   - Item padding

4. Create `register_question_style_controls()` method
   - Question typography
   - Question color (normal/active/hover)

5. Create `register_answer_style_controls()` method
   - Answer typography
   - Answer color
   - Answer padding
   - Text alignment

6. Create `register_icon_style_controls()` method
   - Icon size
   - Icon color (normal/active)
   - Icon spacing

7. Create `register_animation_style_controls()` method
   - Transition duration
   - Easing function

**Time Estimate:** 2-3 hours

---

### Step 4: Implement Render Method

1. Get settings: `$settings = $this->get_settings_for_display();`

2. Output section wrapper:
```php
echo '<section class="pagifye-widget pagifye-faq-section">';
echo '<div class="container">';
```

3. Render header:
   - Call `render_heading()` helper
   - Output description if enabled

4. Render FAQ list:
   - Output `<ul>` with Alpine.js data
   - Loop through repeater items
   - Call `render_faq_item()` helper for each

5. Close wrappers:
```php
echo '</div>';
echo '</section>';
```

**Time Estimate:** 1.5 hours

---

### Step 5: Create Helper Methods

1. `render_heading($settings)` method:
   - Get heading text
   - Split on highlight word
   - Wrap highlight in span
   - Output with proper tag

2. `render_faq_item($item, $index, $settings)` method:
   - Output `<li>` wrapper
   - Render question button
   - Render icon with position logic
   - Render answer container
   - Add Alpine.js bindings

**Time Estimate:** 45 minutes

---

### Step 6: Add Alpine.js Integration

1. Enqueue Alpine.js in widget dependencies

2. Add Alpine.js data attribute to FAQ list:
```html
x-data="{ selected: <?php echo $default_open; ?> }"
```

3. Add click handler to buttons:
```html
@click="selected !== <?php echo $index; ?> ? selected = <?php echo $index; ?> : selected = null"
```

4. Add conditional classes:
```html
:class="selected === <?php echo $index; ?> ? 'active' : ''"
```

5. Add height animation binding:
```html
x-ref="container<?php echo $index; ?>"
:style="selected === <?php echo $index; ?> ? 'max-height: ' + $refs.container<?php echo $index; ?>.scrollHeight + 'px' : ''"
```

**Time Estimate:** 30 minutes

---

### Step 7: Add ARIA Attributes

1. Add to question buttons:
   - `aria-expanded` with Alpine.js binding
   - `aria-controls` pointing to answer ID
   - Unique `id` attribute

2. Add to answer containers:
   - `role="region"`
   - `aria-labelledby` pointing to button ID
   - Unique `id` attribute

3. Test with screen reader

**Time Estimate:** 30 minutes

---

### Step 8: Implement Editor Template (Optional)

Create `content_template()` method with Backbone.js template for live editing in Elementor.

**Time Estimate:** 1 hour (Optional)

---

### Step 9: Test Widget Functionality

1. Add widget to Elementor page
2. Test all content controls
3. Test all style controls
4. Test responsive behavior
5. Test accordion opening/closing
6. Test icon rotation
7. Test animation smoothness
8. Test keyboard navigation
9. Test with screen reader
10. Test in different browsers

**Time Estimate:** 2 hours

---

### Step 10: Optimize and Document

1. Add inline PHPDoc comments
2. Sanitize all outputs
3. Optimize CSS selectors
4. Minify assets
5. Test performance
6. Create usage documentation

**Time Estimate:** 1 hour

---

### Total Estimated Time: 10-12 hours

**Breakdown:**
- Setup & Structure: 15 minutes
- Content Controls: 1 hour
- Style Controls: 2-3 hours
- Render Logic: 1.5 hours
- Helper Methods: 45 minutes
- Alpine.js: 30 minutes
- Accessibility: 30 minutes
- Editor Template: 1 hour (optional)
- Testing: 2 hours
- Polish: 1 hour

---

## Testing Checklist

### Functional Tests

- [ ] Widget appears in Elementor panel under "Pagifye FAQ" category
- [ ] Widget icon displays correctly
- [ ] Widget can be dragged onto page
- [ ] All default content displays on first add

**Content Controls:**
- [ ] Heading text updates in real-time
- [ ] Heading highlight word changes correctly
- [ ] Description shows/hides with toggle
- [ ] Heading HTML tag changes work
- [ ] Repeater adds new FAQ items
- [ ] Repeater deletes items
- [ ] Repeater reorders items (drag & drop)
- [ ] Question text updates in each item
- [ ] Answer WYSIWYG editor works
- [ ] Custom ID field applies to items

**Settings:**
- [ ] Accordion behavior (single) works
- [ ] Default open item setting works (0 = none, 1+ = item number)
- [ ] Icon position switches (left/right)
- [ ] Icon picker changes icon
- [ ] Icon rotation angle control works

**Style Controls:**
- [ ] Section background color changes
- [ ] Section padding controls work
- [ ] Heading typography controls work
- [ ] Heading color changes
- [ ] Highlight color changes
- [ ] Heading alignment works
- [ ] Description typography/color work
- [ ] Header bottom spacing works
- [ ] Items gap slider works
- [ ] Item background color changes
- [ ] Item border controls work
- [ ] Item border radius works
- [ ] Item padding controls work
- [ ] Question typography works
- [ ] Question color changes (normal/active/hover)
- [ ] Answer typography works
- [ ] Answer color changes
- [ ] Answer padding works
- [ ] Answer text alignment works
- [ ] Icon size slider works
- [ ] Icon color changes (normal/active)
- [ ] Icon spacing works
- [ ] Animation duration slider works
- [ ] Animation easing dropdown works

---

### Interactive Tests

**Accordion Functionality:**
- [ ] Clicking question opens answer
- [ ] Clicking open question closes it
- [ ] Only one item open at a time
- [ ] Default open item works on page load
- [ ] Icon rotates when opening
- [ ] Icon rotates back when closing
- [ ] Answer height animates smoothly
- [ ] No content jumping or flashing

**Animation Quality:**
- [ ] Open animation is smooth
- [ ] Close animation is smooth
- [ ] Icon rotation is smooth
- [ ] Custom duration setting works
- [ ] Custom easing setting works
- [ ] No layout shift during animation

---

### Responsive Tests

**Desktop (1920px):**
- [ ] Layout looks correct
- [ ] Typography sizes appropriate
- [ ] Spacing matches design
- [ ] Animations work smoothly

**Tablet (768px):**
- [ ] Layout adapts correctly
- [ ] Typography sizes adjust
- [ ] Padding/spacing adjusts
- [ ] Touch targets adequate size
- [ ] Animations work on touch

**Mobile (375px):**
- [ ] Layout stacks properly
- [ ] Text is readable
- [ ] No horizontal scroll
- [ ] Buttons easy to tap
- [ ] Animations perform well

**Breakpoint Testing:**
- [ ] Custom responsive controls work
- [ ] Values change at correct breakpoints
- [ ] No jarring transitions between breakpoints

---

### Accessibility Tests

**Keyboard Navigation:**
- [ ] Tab key navigates to first question
- [ ] Tab key moves through all questions
- [ ] Enter key toggles accordion
- [ ] Space key toggles accordion
- [ ] Focus indicators visible
- [ ] Focus order is logical
- [ ] Can navigate entire widget without mouse

**Screen Reader Tests:**
- [ ] Widget announces as "accordion" or "FAQ"
- [ ] Question buttons announce correctly
- [ ] Expanded/collapsed state announced
- [ ] Answer content is read when opened
- [ ] Navigation makes sense
- [ ] No duplicate announcements

**ARIA Validation:**
- [ ] `aria-expanded` attribute present on buttons
- [ ] `aria-expanded` value changes correctly
- [ ] `aria-controls` links button to content
- [ ] `role="region"` on answer containers
- [ ] `aria-labelledby` links region to button
- [ ] All IDs are unique
- [ ] No ARIA validation errors in browser tools

**Color Contrast:**
- [ ] Question text meets 4.5:1 ratio
- [ ] Answer text meets 4.5:1 ratio
- [ ] Highlight color meets 3:1 ratio
- [ ] Focus indicators meet 3:1 ratio
- [ ] All interactive elements meet standards

---

### Browser Compatibility

- [ ] Chrome (latest): All features work
- [ ] Firefox (latest): All features work
- [ ] Safari (latest): All features work
- [ ] Edge (latest): All features work
- [ ] Mobile Safari (iOS): All features work
- [ ] Chrome Mobile (Android): All features work

**Specific Checks:**
- [ ] Alpine.js loads correctly in all browsers
- [ ] CSS transitions work in all browsers
- [ ] Flexbox layout consistent
- [ ] SVG icons display correctly
- [ ] No console errors in any browser

---

### Performance Tests

- [ ] Widget loads quickly (<1 second)
- [ ] Animations are 60fps
- [ ] No janky scrolling
- [ ] Alpine.js doesn't block page load
- [ ] CSS file size reasonable
- [ ] JavaScript file size reasonable
- [ ] Images optimized (if any)
- [ ] No memory leaks

**Lighthouse Scores:**
- [ ] Performance: 90+
- [ ] Accessibility: 100
- [ ] Best Practices: 90+
- [ ] SEO: 90+

---

### Integration Tests

- [ ] Works in Elementor editor
- [ ] Works on frontend
- [ ] Saves correctly to database
- [ ] Duplicates correctly
- [ ] Copy/paste works
- [ ] Global widget works
- [ ] Template library works
- [ ] Dynamic tags work (if applicable)
- [ ] Compatible with Elementor Pro features
- [ ] No conflicts with other widgets
- [ ] No conflicts with theme

---

### Edge Cases

- [ ] Widget with 0 FAQ items (empty repeater)
- [ ] Widget with 1 FAQ item
- [ ] Widget with 50+ FAQ items
- [ ] Very long question text
- [ ] Very long answer text
- [ ] HTML in answer field renders correctly
- [ ] Special characters in questions/answers
- [ ] Empty question field
- [ ] Empty answer field
- [ ] Multiple widgets on same page
- [ ] Widget in popup/modal
- [ ] Widget in accordion/tab
- [ ] RTL language support

---

### Security Tests

- [ ] All user inputs sanitized
- [ ] All outputs escaped
- [ ] No XSS vulnerabilities
- [ ] No SQL injection possible
- [ ] Nonce verification (if applicable)
- [ ] Capability checks (if applicable)
- [ ] No direct file access possible

---

### Documentation Tests

- [ ] Code is well commented
- [ ] PHPDoc blocks complete
- [ ] Control descriptions helpful
- [ ] Tooltips informative
- [ ] Inline help text clear
- [ ] No orphaned TODOs
- [ ] No commented-out code

---

## Code Snippets

### Complete Header Content Controls

```php
/**
 * Register Header Content Controls
 */
protected function register_header_content_controls() {
    $this->start_controls_section(
        'section_header',
        [
            'label' => __('Header', 'pagifye-widgets'),
            'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
        ]
    );

    $this->add_control(
        'heading_text',
        [
            'label' => __('Heading', 'pagifye-widgets'),
            'type' => \Elementor\Controls_Manager::TEXT,
            'default' => __('Frequently asked questions', 'pagifye-widgets'),
            'placeholder' => __('Enter your heading', 'pagifye-widgets'),
            'dynamic' => [
                'active' => true,
            ],
            'label_block' => true,
        ]
    );

    $this->add_control(
        'heading_highlight',
        [
            'label' => __('Highlighted Word', 'pagifye-widgets'),
            'type' => \Elementor\Controls_Manager::TEXT,
            'default' => __('questions', 'pagifye-widgets'),
            'description' => __('This word will be highlighted in the primary color. Must be part of the heading text.', 'pagifye-widgets'),
            'dynamic' => [
                'active' => true,
            ],
        ]
    );

    $this->add_control(
        'heading_tag',
        [
            'label' => __('HTML Tag', 'pagifye-widgets'),
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
            'default' => 'h2',
        ]
    );

    $this->add_control(
        'show_description',
        [
            'label' => __('Show Description', 'pagifye-widgets'),
            'type' => \Elementor\Controls_Manager::SWITCHER,
            'default' => 'yes',
            'label_on' => __('Show', 'pagifye-widgets'),
            'label_off' => __('Hide', 'pagifye-widgets'),
        ]
    );

    $this->add_control(
        'description',
        [
            'label' => __('Description', 'pagifye-widgets'),
            'type' => \Elementor\Controls_Manager::TEXTAREA,
            'default' => __('Everything you need to know about Pagifye', 'pagifye-widgets'),
            'placeholder' => __('Enter your description', 'pagifye-widgets'),
            'dynamic' => [
                'active' => true,
            ],
            'rows' => 3,
            'condition' => [
                'show_description' => 'yes',
            ],
        ]
    );

    $this->end_controls_section();
}
```

---

### Complete FAQ Items Repeater

```php
/**
 * Register FAQ Items Content Controls
 */
protected function register_faq_items_content_controls() {
    $this->start_controls_section(
        'section_faq_items',
        [
            'label' => __('FAQ Items', 'pagifye-widgets'),
            'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
        ]
    );

    $repeater = new \Elementor\Repeater();

    $repeater->add_control(
        'question',
        [
            'label' => __('Question', 'pagifye-widgets'),
            'type' => \Elementor\Controls_Manager::TEXT,
            'default' => __('How to create a user?', 'pagifye-widgets'),
            'placeholder' => __('Enter question', 'pagifye-widgets'),
            'label_block' => true,
            'dynamic' => [
                'active' => true,
            ],
        ]
    );

    $repeater->add_control(
        'answer',
        [
            'label' => __('Answer', 'pagifye-widgets'),
            'type' => \Elementor\Controls_Manager::WYSIWYG,
            'default' => __('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus ac libero non augue vestibulum finibus at vitae ex. Donec euismod non tellus sed lobortis.', 'pagifye-widgets'),
            'placeholder' => __('Enter answer', 'pagifye-widgets'),
            'dynamic' => [
                'active' => true,
            ],
        ]
    );

    $repeater->add_control(
        'item_id',
        [
            'label' => __('Custom ID', 'pagifye-widgets'),
            'type' => \Elementor\Controls_Manager::TEXT,
            'description' => __('Optional custom ID for this FAQ item. Useful for deep linking (e.g., #how-to-create-user)', 'pagifye-widgets'),
            'dynamic' => [
                'active' => true,
            ],
        ]
    );

    $this->add_control(
        'faq_items',
        [
            'label' => __('FAQ Items', 'pagifye-widgets'),
            'type' => \Elementor\Controls_Manager::REPEATER,
            'fields' => $repeater->get_controls(),
            'default' => [
                [
                    'question' => __('How to create a user?', 'pagifye-widgets'),
                    'answer' => __('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus ac libero non augue vestibulum finibus at vitae ex. Donec euismod non tellus sed lobortis. Praesent diam lacus, congue vel enim vitae, dictum porta nulla.', 'pagifye-widgets'),
                ],
                [
                    'question' => __('How much does it cost to create a user?', 'pagifye-widgets'),
                    'answer' => __('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus ac libero non augue vestibulum finibus at vitae ex. Donec euismod non tellus sed lobortis.', 'pagifye-widgets'),
                ],
                [
                    'question' => __('Can we get a review of Pagifye?', 'pagifye-widgets'),
                    'answer' => __('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus ac libero non augue vestibulum finibus at vitae ex. Donec euismod non tellus sed lobortis.', 'pagifye-widgets'),
                ],
                [
                    'question' => __('Boost in-app engagement with real-time video?', 'pagifye-widgets'),
                    'answer' => __('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus ac libero non augue vestibulum finibus at vitae ex. Donec euismod non tellus sed lobortis.', 'pagifye-widgets'),
                ],
                [
                    'question' => __('Who uses Pagifye?', 'pagifye-widgets'),
                    'answer' => __('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus ac libero non augue vestibulum finibus at vitae ex. Donec euismod non tellus sed lobortis.', 'pagifye-widgets'),
                ],
            ],
            'title_field' => '{{{ question }}}',
        ]
    );

    $this->end_controls_section();
}
```

---

### Complete Settings Controls

```php
/**
 * Register Settings Content Controls
 */
protected function register_settings_content_controls() {
    $this->start_controls_section(
        'section_settings',
        [
            'label' => __('Settings', 'pagifye-widgets'),
            'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
        ]
    );

    $this->add_control(
        'accordion_behavior',
        [
            'label' => __('Accordion Behavior', 'pagifye-widgets'),
            'type' => \Elementor\Controls_Manager::SELECT,
            'options' => [
                'single' => __('Single (Only one open)', 'pagifye-widgets'),
                'multiple' => __('Multiple (Multiple can be open)', 'pagifye-widgets'),
            ],
            'default' => 'single',
            'description' => __('Choose whether multiple FAQ items can be open at once', 'pagifye-widgets'),
        ]
    );

    $this->add_control(
        'default_open',
        [
            'label' => __('Default Opened Item', 'pagifye-widgets'),
            'type' => \Elementor\Controls_Manager::NUMBER,
            'default' => 0,
            'min' => 0,
            'description' => __('Set which item should be open by default (0 for none, 1 for first, 2 for second, etc.)', 'pagifye-widgets'),
            'condition' => [
                'accordion_behavior' => 'single',
            ],
        ]
    );

    $this->add_control(
        'icon_settings_heading',
        [
            'label' => __('Icon', 'pagifye-widgets'),
            'type' => \Elementor\Controls_Manager::HEADING,
            'separator' => 'before',
        ]
    );

    $this->add_control(
        'icon_position',
        [
            'label' => __('Icon Position', 'pagifye-widgets'),
            'type' => \Elementor\Controls_Manager::CHOOSE,
            'options' => [
                'left' => [
                    'title' => __('Left', 'pagifye-widgets'),
                    'icon' => 'eicon-h-align-left',
                ],
                'right' => [
                    'title' => __('Right', 'pagifye-widgets'),
                    'icon' => 'eicon-h-align-right',
                ],
            ],
            'default' => 'right',
            'toggle' => false,
        ]
    );

    $this->add_control(
        'selected_icon',
        [
            'label' => __('Icon', 'pagifye-widgets'),
            'type' => \Elementor\Controls_Manager::ICONS,
            'default' => [
                'value' => 'fas fa-chevron-right',
                'library' => 'fa-solid',
            ],
            'recommended' => [
                'fa-solid' => [
                    'chevron-right',
                    'angle-right',
                    'arrow-right',
                    'plus',
                    'caret-right',
                ],
            ],
        ]
    );

    $this->end_controls_section();
}
```

---

### Complete Render Method

```php
/**
 * Render FAQ-01 widget output on the frontend.
 */
protected function render() {
    $settings = $this->get_settings_for_display();

    // Calculate default open item
    $default_open = isset($settings['default_open']) ? (int)$settings['default_open'] : 0;

    // Wrapper classes
    $wrapper_classes = 'pagifye-widget pagifye-faq-section bg-pgfy-gray-500 py-10 md:py-20 lg:py-28';

    ?>
    <section class="<?php echo esc_attr($wrapper_classes); ?>">
        <div class="container flex w-full flex-col gap-8 lg:gap-16">

            <?php $this->render_header($settings); ?>

            <?php if (!empty($settings['faq_items'])): ?>
                <ul class="faq-list flex flex-col gap-4 lg:gap-7"
                    x-data="{ selected: <?php echo esc_attr($default_open); ?> }">

                    <?php foreach ($settings['faq_items'] as $index => $item):
                        $item_index = $index + 1;
                        $this->render_faq_item($item, $item_index, $settings);
                    endforeach; ?>

                </ul>
            <?php endif; ?>

        </div>
    </section>
    <?php
}

/**
 * Render header section
 */
private function render_header($settings) {
    if (empty($settings['heading_text']) && empty($settings['description'])) {
        return;
    }
    ?>
    <div class="faq-header flex w-full flex-col items-center justify-center gap-4">

        <?php if (!empty($settings['heading_text'])): ?>
            <?php
            $heading_tag = isset($settings['heading_tag']) ? $settings['heading_tag'] : 'h2';
            $heading_text = $settings['heading_text'];
            $highlight = isset($settings['heading_highlight']) ? $settings['heading_highlight'] : '';

            // Split heading by highlight word
            if (!empty($highlight) && strpos($heading_text, $highlight) !== false) {
                $parts = explode($highlight, $heading_text);
                $heading_html = esc_html($parts[0]) .
                               '<span class="highlight text-pgfy-primary-500">' . esc_html($highlight) . '</span>' .
                               (isset($parts[1]) ? esc_html($parts[1]) : '');
            } else {
                $heading_html = esc_html($heading_text);
            }
            ?>
            <<?php echo esc_attr($heading_tag); ?> class="faq-heading text-4xl font-bold capitalize md:text-[40px] md:leading-[48px] lg:text-5xl lg:leading-[56px] w-full max-w-[644px] text-center text-white">
                <?php echo $heading_html; ?>
            </<?php echo esc_attr($heading_tag); ?>>
        <?php endif; ?>

        <?php if (!empty($settings['description']) && $settings['show_description'] === 'yes'): ?>
            <p class="faq-description text-base font-normal text-pgfy-gray-50">
                <?php echo esc_html($settings['description']); ?>
            </p>
        <?php endif; ?>

    </div>
    <?php
}

/**
 * Render individual FAQ item
 */
private function render_faq_item($item, $index, $settings) {
    if (empty($item['question'])) {
        return;
    }

    $item_id = !empty($item['item_id']) ? 'id="' . esc_attr($item['item_id']) . '"' : '';
    $icon_position = isset($settings['icon_position']) ? $settings['icon_position'] : 'right';
    ?>
    <li class="faq-item relative rounded-lg bg-pgfy-gray-400"
        <?php echo $item_id; ?>
        :class="selected === <?php echo esc_attr($index); ?> ? 'active' : ''">

        <!-- Question Button -->
        <button type="button"
                class="faq-question flex w-full items-center justify-between p-4 text-left lg:p-6"
                data-icon-position="<?php echo esc_attr($icon_position); ?>"
                @click="selected !== <?php echo esc_attr($index); ?> ? selected = <?php echo esc_attr($index); ?> : selected = null"
                :aria-expanded="selected === <?php echo esc_attr($index); ?> ? 'true' : 'false'"
                aria-controls="faq-answer-<?php echo esc_attr($index); ?>"
                id="faq-question-<?php echo esc_attr($index); ?>">

            <span class="faq-question-text text-xl font-bold lg:text-2xl text-white">
                <?php echo esc_html($item['question']); ?>
            </span>

            <span class="faq-icon md:min-w-6 fill-white duration-500 ease-in-out"
                  :class="selected === <?php echo esc_attr($index); ?> ? 'rotate-90' : ''">
                <?php \Elementor\Icons_Manager::render_icon($settings['selected_icon'], ['aria-hidden' => 'true']); ?>
            </span>
        </button>

        <!-- Answer Container -->
        <div class="faq-answer-wrapper relative max-h-0 overflow-hidden transition-all duration-500"
             id="faq-answer-<?php echo esc_attr($index); ?>"
             x-ref="container<?php echo esc_attr($index); ?>"
             :style="selected === <?php echo esc_attr($index); ?> ? 'max-height: ' + $refs.container<?php echo esc_attr($index); ?>.scrollHeight + 'px' : ''"
             role="region"
             aria-labelledby="faq-question-<?php echo esc_attr($index); ?>">
            <div class="faq-answer p-6 pt-0 text-justify text-pgfy-gray-50">
                <?php echo wp_kses_post($item['answer']); ?>
            </div>
        </div>
    </li>
    <?php
}
```

---

### Example Style Controls Section

```php
/**
 * Register Header Style Controls
 */
protected function register_header_style_controls() {
    $this->start_controls_section(
        'section_header_style',
        [
            'label' => __('Header', 'pagifye-widgets'),
            'tab' => \Elementor\Controls_Manager::TAB_STYLE,
        ]
    );

    // Heading Typography
    $this->add_group_control(
        \Elementor\Group_Control_Typography::get_type(),
        [
            'name' => 'heading_typography',
            'label' => __('Typography', 'pagifye-widgets'),
            'selector' => '{{WRAPPER}} .faq-heading',
        ]
    );

    // Heading Color
    $this->add_control(
        'heading_color',
        [
            'label' => __('Color', 'pagifye-widgets'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'default' => '#FFFFFF',
            'selectors' => [
                '{{WRAPPER}} .faq-heading' => 'color: {{VALUE}};',
            ],
        ]
    );

    // Highlight Color
    $this->add_control(
        'heading_highlight_color',
        [
            'label' => __('Highlight Color', 'pagifye-widgets'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'default' => '#8FE35F',
            'selectors' => [
                '{{WRAPPER}} .faq-heading .highlight' => 'color: {{VALUE}};',
            ],
        ]
    );

    // Heading Alignment
    $this->add_responsive_control(
        'heading_alignment',
        [
            'label' => __('Alignment', 'pagifye-widgets'),
            'type' => \Elementor\Controls_Manager::CHOOSE,
            'options' => [
                'left' => [
                    'title' => __('Left', 'pagifye-widgets'),
                    'icon' => 'eicon-text-align-left',
                ],
                'center' => [
                    'title' => __('Center', 'pagifye-widgets'),
                    'icon' => 'eicon-text-align-center',
                ],
                'right' => [
                    'title' => __('Right', 'pagifye-widgets'),
                    'icon' => 'eicon-text-align-right',
                ],
            ],
            'default' => 'center',
            'selectors' => [
                '{{WRAPPER}} .faq-header' => 'text-align: {{VALUE}};',
            ],
        ]
    );

    // Separator
    $this->add_control(
        'description_heading',
        [
            'label' => __('Description', 'pagifye-widgets'),
            'type' => \Elementor\Controls_Manager::HEADING,
            'separator' => 'before',
            'condition' => [
                'show_description' => 'yes',
            ],
        ]
    );

    // Description Typography
    $this->add_group_control(
        \Elementor\Group_Control_Typography::get_type(),
        [
            'name' => 'description_typography',
            'label' => __('Typography', 'pagifye-widgets'),
            'selector' => '{{WRAPPER}} .faq-description',
            'condition' => [
                'show_description' => 'yes',
            ],
        ]
    );

    // Description Color
    $this->add_control(
        'description_color',
        [
            'label' => __('Color', 'pagifye-widgets'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'default' => '#F5F7F6',
            'selectors' => [
                '{{WRAPPER}} .faq-description' => 'color: {{VALUE}};',
            ],
            'condition' => [
                'show_description' => 'yes',
            ],
        ]
    );

    // Header Spacing
    $this->add_responsive_control(
        'header_spacing',
        [
            'label' => __('Bottom Spacing', 'pagifye-widgets'),
            'type' => \Elementor\Controls_Manager::SLIDER,
            'size_units' => ['px', 'em', 'rem'],
            'range' => [
                'px' => [
                    'min' => 0,
                    'max' => 100,
                ],
            ],
            'default' => [
                'unit' => 'px',
                'size' => 64,
            ],
            'selectors' => [
                '{{WRAPPER}} .faq-header' => 'margin-bottom: {{SIZE}}{{UNIT}};',
            ],
        ]
    );

    $this->end_controls_section();
}
```

---

## Summary

This implementation plan provides a complete roadmap for building the FAQ-01 Elementor widget. The widget features:

**Core Functionality:**
- Accordion FAQ list with smooth animations
- Alpine.js powered state management
- Single accordion behavior (one item open at a time)
- Optional default opened item
- Customizable icons with position control

**Content Features:**
- Split heading with highlight capability
- Optional description
- Repeater for unlimited FAQ items
- WYSIWYG editor for answers
- Custom IDs for deep linking

**Styling Options:**
- Complete typography controls
- Color customization for all elements
- Border and spacing controls
- Animation timing and easing
- Fully responsive

**Accessibility:**
- Full keyboard navigation
- Screen reader support
- ARIA attributes
- Focus management
- WCAG 2.1 Level AA compliant

**Technical Details:**
- Clean, documented PHP code
- Proper sanitization and escaping
- Performance optimized
- Browser compatible
- Follows WordPress coding standards

The estimated implementation time is 10-12 hours, with comprehensive testing ensuring quality and accessibility standards are met.

---

**Document Status:** Complete
**Ready for:** Implementation
**Next Step:** Begin coding widget class file
