# Pricing-01 Elementor Widget - Implementation Plan

**Component:** root_pricing-01
**Version:** 1.0.0
**Last Updated:** 2025-11-02
**Status:** Ready for Implementation

---

## Table of Contents

1. [Component Analysis](#1-component-analysis)
2. [Elementor Controls Specification](#2-elementor-controls-specification)
3. [PHP Class Structure](#3-php-class-structure)
4. [Render Method Implementation Plan](#4-render-method-implementation-plan)
5. [Alpine.js Integration](#5-alpinejs-integration)
6. [Repeater Structure](#6-repeater-structure)
7. [Featured Card Logic](#7-featured-card-logic)
8. [Styling Controls](#8-styling-controls)
9. [Grid Layout Controls](#9-grid-layout-controls)
10. [Implementation Steps](#10-implementation-steps)
11. [Testing Checklist](#11-testing-checklist)
12. [Code Snippets](#12-code-snippets)

---

## 1. Component Analysis

### Component Structure Overview

**File Location:** `/Users/nadimtuhin/opensource/pagifye/components/root_pricing-01.html`

**HTML Structure:**
```
<section> (Container with background)
  └── <div class="container"> (Main container)
      ├── <h1> (Section heading with highlighted text)
      ├── <div> (Billing toggle buttons)
      └── <div class="grid"> (Pricing cards grid)
          ├── Pricing Card 1 (Standard)
          ├── Pricing Card 2 (Standard)
          ├── Pricing Card 3 (Featured with badge)
          └── Pricing Card 4 (Standard)
```

### Key Features Identified

1. **Section Header** (lines 3-9)
   - Multi-part heading with highlight capability
   - Centered text with responsive sizing
   - Custom max-width constraint (700px)

2. **Billing Period Toggle** (lines 11-15)
   - Two toggle buttons (Monthly/Annually)
   - Rounded full background container
   - Active state styling with primary color
   - Alpine.js integration needed for state management

3. **Pricing Cards Grid** (lines 17-156)
   - Responsive grid: 1 column (mobile), 2 columns (tablet), 4 columns (desktop)
   - Gap spacing: 24px (mobile), 30px (desktop)
   - Four pricing cards with identical structure

4. **Individual Pricing Card Structure**
   - **Header Section:**
     - Plan name (h5)
     - Price display (h6) with price + suffix
     - Description text
   - **Divider:** Horizontal line separator
   - **Content Section:**
     - Feature description
     - CTA button with icon
   - **Badge (Featured only):** Absolute positioned discount badge

5. **Featured Card Indicators** (Card 3 - "Scale")
   - Special border color (`!border-pgfy-primary-500`)
   - Different button styling (primary background)
   - Absolute positioned badge (`-top-7 right-7`)
   - Order modification on mobile (`max-sm:order-first`)

### Design Patterns

**Color Scheme:**
- Background: `bg-pgfy-gray-500`
- Card background: `bg-pgfy-gray-500`
- Primary accent: `bg-pgfy-primary-500`
- Text colors: white, gray variants

**Spacing:**
- Section padding: `py-10 md:py-20 lg:py-28`
- Card padding: `p-5 md:p-[30px]`
- Gap spacing: `gap-6 md:gap-10`

**Typography:**
- Heading: `text-4xl md:text-[40px] lg:text-5xl`
- Plan name: `text-2xl md:text-3xl`
- Price: `text-4xl md:text-5xl`

**Interactive Elements:**
- Billing toggle buttons
- CTA buttons with hover states
- SVG icons in buttons

---

## 2. Elementor Controls Specification

### Content Tab Controls

#### Section: Header Settings

```php
'section_header' => [
    'label' => 'Header',
    'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
]
```

**Control: Enable Header**
- Type: `SWITCHER`
- Name: `show_header`
- Label: "Show Section Header"
- Default: `yes`
- Description: "Toggle section heading visibility"

**Control: Heading Text**
- Type: `TEXTAREA`
- Name: `heading_text`
- Label: "Heading Text"
- Default: "Plans for customer-first business of all sizes"
- Dynamic: Yes
- Condition: `show_header === 'yes'`
- Description: "Main section heading"

**Control: Highlight Words**
- Type: `TEXT`
- Name: `highlight_words`
- Label: "Words to Highlight"
- Default: "customer-first"
- Dynamic: Yes
- Condition: `show_header === 'yes'`
- Description: "Comma-separated words to highlight in primary color"

**Control: Heading Alignment**
- Type: `CHOOSE`
- Name: `heading_alignment`
- Label: "Alignment"
- Options: `['left', 'center', 'right']`
- Default: `center`
- Selectors: `{{WRAPPER}} .pricing-heading`
- Condition: `show_header === 'yes'`

#### Section: Billing Toggle Settings

```php
'section_billing_toggle' => [
    'label' => 'Billing Period Toggle',
    'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
]
```

**Control: Enable Billing Toggle**
- Type: `SWITCHER`
- Name: `show_billing_toggle`
- Label: "Show Billing Toggle"
- Default: `yes`
- Description: "Display monthly/annual toggle buttons"

**Control: Monthly Label**
- Type: `TEXT`
- Name: `monthly_label`
- Label: "Monthly Label"
- Default: "Bill Monthly"
- Dynamic: Yes
- Condition: `show_billing_toggle === 'yes'`

**Control: Annual Label**
- Type: `TEXT`
- Name: `annual_label`
- Label: "Annual Label"
- Default: "Bill Annually"
- Dynamic: Yes
- Condition: `show_billing_toggle === 'yes'`

**Control: Default Period**
- Type: `SELECT`
- Name: `default_billing_period`
- Label: "Default Billing Period"
- Options:
  - `monthly` => "Monthly"
  - `annual` => "Annual"
- Default: `annual`
- Condition: `show_billing_toggle === 'yes'`
- Description: "Which period is selected by default"

#### Section: Pricing Cards

```php
'section_pricing_cards' => [
    'label' => 'Pricing Cards',
    'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
]
```

**Control: Pricing Cards Repeater**
- Type: `REPEATER`
- Name: `pricing_cards`
- See [Section 6: Repeater Structure](#6-repeater-structure) for detailed fields

**Default Items:** 4 cards with the following data:
```php
[
    [
        'plan_name' => 'Starter',
        'monthly_price' => 'Free',
        'annual_price' => 'Free',
        'price_suffix' => '/month',
        'description' => 'Billed annually, up to 5 seats',
        'feature_text' => 'Maximise reviews impact with tools to drive SEO',
        'button_text' => 'Try for free',
        'button_url' => '#',
        'is_featured' => '',
    ],
    [
        'plan_name' => 'Growth',
        'monthly_price' => '$19',
        'annual_price' => '$19',
        // ... similar structure
    ],
    [
        'plan_name' => 'Scale',
        'monthly_price' => '$59',
        'annual_price' => '$49',
        'is_featured' => 'yes',
        'badge_text' => '20% OFF',
        // ... similar structure
    ],
    [
        'plan_name' => 'Premier',
        'monthly_price' => '$99',
        'annual_price' => '$99',
        // ... similar structure
    ],
]
```

---

## 3. PHP Class Structure

### Widget Class Outline

**File:** `widgets/class-pricing-01-widget.php`

```php
<?php
namespace Pagifye_Elementor_Widgets\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Background;
use Elementor\Core\Kits\Documents\Tabs\Global_Colors;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

class Pricing_01_Widget extends Widget_Base {

    // 1. Widget Identification Methods
    public function get_name() {}
    public function get_title() {}
    public function get_icon() {}
    public function get_categories() {}
    public function get_keywords() {}

    // 2. Script/Style Dependencies
    public function get_script_depends() {}
    public function get_style_depends() {}

    // 3. Control Registration
    protected function register_controls() {}

    // 3a. Content Tab Controls
    private function register_header_controls() {}
    private function register_billing_toggle_controls() {}
    private function register_pricing_cards_controls() {}

    // 3b. Style Tab Controls
    private function register_section_style_controls() {}
    private function register_header_style_controls() {}
    private function register_toggle_style_controls() {}
    private function register_card_style_controls() {}
    private function register_price_style_controls() {}
    private function register_button_style_controls() {}
    private function register_badge_style_controls() {}

    // 4. Render Method
    protected function render() {}

    // 5. Helper Methods
    private function render_header() {}
    private function render_billing_toggle() {}
    private function render_pricing_cards() {}
    private function render_single_card($card, $index) {}
    private function highlight_text($text, $highlight_words) {}
    private function render_button_icon() {}

    // 6. Editor Render (optional)
    protected function content_template() {}
}
```

### Key Method Details

#### get_name()
```php
public function get_name() {
    return 'pagifye-pricing-01';
}
```

#### get_title()
```php
public function get_title() {
    return esc_html__('Pricing Cards 01', 'pagifye-elementor-widgets');
}
```

#### get_icon()
```php
public function get_icon() {
    return 'eicon-price-table';
}
```

#### get_categories()
```php
public function get_categories() {
    return ['pagifye'];
}
```

#### get_keywords()
```php
public function get_keywords() {
    return ['pricing', 'price', 'table', 'plans', 'subscription', 'billing', 'cards'];
}
```

#### get_script_depends()
```php
public function get_script_depends() {
    return ['alpine-js', 'pagifye-pricing-01'];
}
```

#### get_style_depends()
```php
public function get_style_depends() {
    return ['pagifye-tailwind', 'pagifye-pricing-01'];
}
```

---

## 4. Render Method Implementation Plan

### Main Render Structure

```php
protected function render() {
    $settings = $this->get_settings_for_display();

    // Alpine.js data attributes
    $alpine_data = sprintf(
        "{ billingPeriod: '%s' }",
        esc_attr($settings['default_billing_period'])
    );

    ?>
    <section class="bg-pgfy-gray-500 py-10 md:py-20 lg:py-28" x-data="<?php echo $alpine_data; ?>">
        <div class="container flex flex-col items-center justify-center gap-6 md:gap-10">

            <?php $this->render_header(); ?>

            <?php $this->render_billing_toggle(); ?>

            <?php $this->render_pricing_cards(); ?>

        </div>
    </section>
    <?php
}
```

### Header Rendering Logic

```php
private function render_header() {
    $settings = $this->get_settings_for_display();

    if ('yes' !== $settings['show_header']) {
        return;
    }

    $heading_text = $settings['heading_text'];
    $highlight_words = $settings['highlight_words'];
    $alignment = $settings['heading_alignment'];

    // Process highlighting
    $processed_heading = $this->highlight_text($heading_text, $highlight_words);

    ?>
    <h1 class="text-4xl font-bold capitalize md:text-[40px] md:leading-[48px] lg:text-5xl lg:leading-[56px] mx-auto w-full max-w-[700px] text-center text-white pricing-heading">
        <?php echo $processed_heading; ?>
    </h1>
    <?php
}
```

### Billing Toggle Rendering Logic

```php
private function render_billing_toggle() {
    $settings = $this->get_settings_for_display();

    if ('yes' !== $settings['show_billing_toggle']) {
        return;
    }

    $monthly_label = $settings['monthly_label'];
    $annual_label = $settings['annual_label'];

    ?>
    <div class="flex gap-2 rounded-full bg-pgfy-gray-400 p-1.5 font-bold md:p-2">
        <button
            @click="billingPeriod = 'monthly'"
            :class="billingPeriod === 'monthly' ? 'bg-pgfy-primary-500 text-pgfy-gray-500' : 'text-white'"
            class="cursor-pointer rounded-full px-6 py-1.5 md:py-2 transition-colors duration-200">
            <?php echo esc_html($monthly_label); ?>
        </button>
        <button
            @click="billingPeriod = 'annual'"
            :class="billingPeriod === 'annual' ? 'bg-pgfy-primary-500 text-pgfy-gray-500' : 'text-white'"
            class="cursor-pointer rounded-full px-6 py-1.5 md:py-2 transition-colors duration-200">
            <?php echo esc_html($annual_label); ?>
        </button>
    </div>
    <?php
}
```

### Pricing Cards Grid Rendering Logic

```php
private function render_pricing_cards() {
    $settings = $this->get_settings_for_display();
    $cards = $settings['pricing_cards'];

    if (empty($cards)) {
        return;
    }

    $columns = $settings['grid_columns'];
    $columns_tablet = $settings['grid_columns_tablet'];
    $columns_mobile = $settings['grid_columns_mobile'];

    $grid_classes = sprintf(
        'grid grid-cols-%d sm:grid-cols-%d lg:grid-cols-%d gap-6 md:gap-[30px]',
        $columns_mobile,
        $columns_tablet,
        $columns
    );

    ?>
    <div class="<?php echo esc_attr($grid_classes); ?>">
        <?php foreach ($cards as $index => $card) : ?>
            <?php $this->render_single_card($card, $index); ?>
        <?php endforeach; ?>
    </div>
    <?php
}
```

### Single Card Rendering Logic

```php
private function render_single_card($card, $index) {
    $is_featured = 'yes' === $card['is_featured'];
    $has_badge = $is_featured && !empty($card['badge_text']);

    // Build card classes
    $card_classes = 'relative space-y-4 p-5 md:p-[30px] rounded-2xl border-[3px] bg-pgfy-gray-500';

    if ($is_featured) {
        $card_classes .= ' !border-pgfy-primary-500 max-sm:order-first';
    } else {
        $card_classes .= ' border-white/10';
    }

    // Button classes
    $button_classes = 'flex w-full select-none items-center justify-center gap-1 rounded-full px-8 py-3 text-base font-bold';

    if ($is_featured) {
        $button_classes .= ' bg-pgfy-primary-500 text-pgfy-gray-500 transition duration-300 ease-in-out hover:bg-pgfy-primary-600';
    } else {
        $button_classes .= ' bg-pgfy-gray-400 text-white';
    }

    ?>
    <div class="<?php echo esc_attr($card_classes); ?>">

        <!-- Plan Header -->
        <div class="space-y-2">
            <h5 class="text-2xl font-bold md:text-3xl text-white">
                <?php echo esc_html($card['plan_name']); ?>
            </h5>

            <!-- Price with Alpine.js toggle -->
            <h6 class="text-4xl font-bold leading-[48px] md:text-5xl md:leading-[56px] text-white">
                <span x-show="billingPeriod === 'monthly'" x-cloak>
                    <?php echo esc_html($card['monthly_price']); ?>
                </span>
                <span x-show="billingPeriod === 'annual'" x-cloak>
                    <?php echo esc_html($card['annual_price']); ?>
                </span>
                <span class="text-base font-normal">
                    <?php echo esc_html($card['price_suffix']); ?>
                </span>
            </h6>

            <p class="text-pgfy-gray-50/70">
                <?php echo esc_html($card['description']); ?>
            </p>
        </div>

        <!-- Divider -->
        <div class="h-px w-full bg-pgfy-wireframe-100/50"></div>

        <!-- Features & CTA -->
        <div class="space-y-6">
            <p class="text-pgfy-gray-50">
                <?php echo esc_html($card['feature_text']); ?>
            </p>

            <a href="<?php echo esc_url($card['button_url']['url']); ?>"
               class="<?php echo esc_attr($button_classes); ?>"
               <?php if ($card['button_url']['is_external']) : ?>target="_blank"<?php endif; ?>
               <?php if ($card['button_url']['nofollow']) : ?>rel="nofollow"<?php endif; ?>>
                <span><?php echo esc_html($card['button_text']); ?></span>
                <?php $this->render_button_icon($is_featured); ?>
            </a>
        </div>

        <!-- Featured Badge -->
        <?php if ($has_badge) : ?>
            <p class="absolute -top-7 right-7 rounded px-2 py-1 text-xs font-bold uppercase bg-pgfy-primary-500 text-pgfy-gray-500">
                <?php echo esc_html($card['badge_text']); ?>
            </p>
        <?php endif; ?>

    </div>
    <?php
}
```

### Helper Method: Highlight Text

```php
private function highlight_text($text, $highlight_words) {
    if (empty($highlight_words)) {
        return '<span>' . esc_html($text) . '</span>';
    }

    $words_to_highlight = array_map('trim', explode(',', $highlight_words));
    $words = explode(' ', $text);
    $output = '';

    foreach ($words as $word) {
        $is_highlighted = false;
        foreach ($words_to_highlight as $highlight) {
            if (stripos($word, $highlight) !== false) {
                $output .= '<span class="text-pgfy-primary-500">' . esc_html($word) . '</span> ';
                $is_highlighted = true;
                break;
            }
        }
        if (!$is_highlighted) {
            $output .= '<span>' . esc_html($word) . '</span> ';
        }
    }

    return trim($output);
}
```

### Helper Method: Render Button Icon

```php
private function render_button_icon($is_featured = false) {
    $fill_color = $is_featured ? '#0F2C24' : '#FFFFFF';
    ?>
    <svg width="20" height="20" viewBox="0 0 20 20" fill="<?php echo esc_attr($fill_color); ?>" xmlns="http://www.w3.org/2000/svg">
        <path d="M17.5383 10.6635L11.9133 16.2885C11.7372 16.4647 11.4983 16.5636 11.2492 16.5636C11.0001 16.5636 10.7613 16.4647 10.5852 16.2885C10.409 16.1124 10.3101 15.8736 10.3101 15.6245C10.3101 15.3754 10.409 15.1365 10.5852 14.9604L14.6094 10.9378H3.125C2.87636 10.9378 2.6379 10.839 2.46209 10.6632C2.28627 10.4874 2.1875 10.2489 2.1875 10.0003C2.1875 9.75162 2.28627 9.51316 2.46209 9.33735C2.6379 9.16153 2.87636 9.06276 3.125 9.06276H14.6094L10.5867 5.03776C10.4106 4.86164 10.3117 4.62277 10.3117 4.3737C10.3117 4.12462 10.4106 3.88575 10.5867 3.70963C10.7628 3.53351 11.0017 3.43457 11.2508 3.43457C11.4999 3.43457 11.7387 3.53351 11.9148 3.70963L17.5398 9.33463C17.6273 9.42185 17.6966 9.52547 17.7438 9.63955C17.7911 9.75364 17.8153 9.87593 17.8152 9.99941C17.815 10.1229 17.7905 10.2451 17.743 10.3591C17.6955 10.4731 17.6259 10.5765 17.5383 10.6635Z"/>
    </svg>
    <?php
}
```

---

## 5. Alpine.js Integration

### Alpine.js Requirements

**File:** `assets/js/pricing-01.js`

```javascript
// Initialize Alpine.js for pricing toggle
document.addEventListener('alpine:init', () => {
    Alpine.data('pricingToggle', (defaultPeriod = 'annual') => ({
        billingPeriod: defaultPeriod,

        init() {
            // Initialize billing period
            this.billingPeriod = defaultPeriod;
        },

        setMonthly() {
            this.billingPeriod = 'monthly';
        },

        setAnnual() {
            this.billingPeriod = 'annual';
        },

        isMonthly() {
            return this.billingPeriod === 'monthly';
        },

        isAnnual() {
            return this.billingPeriod === 'annual';
        }
    }));
});
```

### Alpine.js Directives Used

1. **x-data**: Initialize component state
   ```html
   <section x-data="{ billingPeriod: 'annual' }">
   ```

2. **x-show**: Conditional display for prices
   ```html
   <span x-show="billingPeriod === 'monthly'">$19</span>
   <span x-show="billingPeriod === 'annual'">$15</span>
   ```

3. **@click**: Toggle button clicks
   ```html
   <button @click="billingPeriod = 'monthly'">
   ```

4. **:class**: Dynamic button styling
   ```html
   <button :class="billingPeriod === 'monthly' ? 'bg-primary' : 'bg-gray'">
   ```

5. **x-cloak**: Prevent flash of unstyled content
   ```html
   <span x-show="billingPeriod === 'monthly'" x-cloak>
   ```

### CSS for Alpine.js

Add to `assets/css/pricing-01.css`:

```css
[x-cloak] {
    display: none !important;
}

/* Smooth transitions for price toggle */
[x-show] {
    transition: opacity 0.2s ease-in-out;
}
```

### Script Enqueuing

In main plugin file or widget class:

```php
public function get_script_depends() {
    return ['alpine-js', 'pagifye-pricing-01'];
}

// In plugin initialization
wp_register_script(
    'alpine-js',
    'https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js',
    [],
    '3.13.0',
    true
);

wp_register_script(
    'pagifye-pricing-01',
    PAGIFYE_PLUGIN_URL . 'assets/js/pricing-01.js',
    ['alpine-js'],
    PAGIFYE_VERSION,
    true
);
```

---

## 6. Repeater Structure

### Pricing Cards Repeater Fields

```php
$repeater = new \Elementor\Repeater();

// Plan Name
$repeater->add_control(
    'plan_name',
    [
        'label' => esc_html__('Plan Name', 'pagifye-elementor-widgets'),
        'type' => Controls_Manager::TEXT,
        'default' => esc_html__('Starter', 'pagifye-elementor-widgets'),
        'label_block' => true,
        'dynamic' => [
            'active' => true,
        ],
    ]
);

// Monthly Price
$repeater->add_control(
    'monthly_price',
    [
        'label' => esc_html__('Monthly Price', 'pagifye-elementor-widgets'),
        'type' => Controls_Manager::TEXT,
        'default' => '$19',
        'label_block' => true,
        'dynamic' => [
            'active' => true,
        ],
        'description' => esc_html__('Enter price (e.g., $19 or Free)', 'pagifye-elementor-widgets'),
    ]
);

// Annual Price
$repeater->add_control(
    'annual_price',
    [
        'label' => esc_html__('Annual Price', 'pagifye-elementor-widgets'),
        'type' => Controls_Manager::TEXT,
        'default' => '$15',
        'label_block' => true,
        'dynamic' => [
            'active' => true,
        ],
        'description' => esc_html__('Annual discounted price', 'pagifye-elementor-widgets'),
    ]
);

// Price Suffix
$repeater->add_control(
    'price_suffix',
    [
        'label' => esc_html__('Price Suffix', 'pagifye-elementor-widgets'),
        'type' => Controls_Manager::TEXT,
        'default' => '/month',
        'label_block' => true,
        'dynamic' => [
            'active' => true,
        ],
    ]
);

// Description
$repeater->add_control(
    'description',
    [
        'label' => esc_html__('Description', 'pagifye-elementor-widgets'),
        'type' => Controls_Manager::TEXTAREA,
        'default' => esc_html__('Billed annually, up to 5 seats', 'pagifye-elementor-widgets'),
        'rows' => 2,
        'dynamic' => [
            'active' => true,
        ],
    ]
);

// Divider
$repeater->add_control(
    'divider_features',
    [
        'label' => esc_html__('Features', 'pagifye-elementor-widgets'),
        'type' => Controls_Manager::DIVIDER,
    ]
);

// Feature Text
$repeater->add_control(
    'feature_text',
    [
        'label' => esc_html__('Feature Description', 'pagifye-elementor-widgets'),
        'type' => Controls_Manager::TEXTAREA,
        'default' => esc_html__('Maximise reviews impact with tools to drive SEO', 'pagifye-elementor-widgets'),
        'rows' => 3,
        'dynamic' => [
            'active' => true,
        ],
    ]
);

// Button Text
$repeater->add_control(
    'button_text',
    [
        'label' => esc_html__('Button Text', 'pagifye-elementor-widgets'),
        'type' => Controls_Manager::TEXT,
        'default' => esc_html__('Try for free', 'pagifye-elementor-widgets'),
        'label_block' => true,
        'dynamic' => [
            'active' => true,
        ],
    ]
);

// Button URL
$repeater->add_control(
    'button_url',
    [
        'label' => esc_html__('Button URL', 'pagifye-elementor-widgets'),
        'type' => Controls_Manager::URL,
        'placeholder' => esc_html__('https://your-link.com', 'pagifye-elementor-widgets'),
        'default' => [
            'url' => '#',
            'is_external' => false,
            'nofollow' => false,
        ],
        'dynamic' => [
            'active' => true,
        ],
    ]
);

// Divider
$repeater->add_control(
    'divider_featured',
    [
        'label' => esc_html__('Featured Settings', 'pagifye-elementor-widgets'),
        'type' => Controls_Manager::DIVIDER,
    ]
);

// Is Featured
$repeater->add_control(
    'is_featured',
    [
        'label' => esc_html__('Featured Card', 'pagifye-elementor-widgets'),
        'type' => Controls_Manager::SWITCHER,
        'label_on' => esc_html__('Yes', 'pagifye-elementor-widgets'),
        'label_off' => esc_html__('No', 'pagifye-elementor-widgets'),
        'return_value' => 'yes',
        'default' => '',
        'description' => esc_html__('Highlight this card with primary border and button', 'pagifye-elementor-widgets'),
    ]
);

// Badge Text
$repeater->add_control(
    'badge_text',
    [
        'label' => esc_html__('Badge Text', 'pagifye-elementor-widgets'),
        'type' => Controls_Manager::TEXT,
        'default' => '',
        'label_block' => true,
        'dynamic' => [
            'active' => true,
        ],
        'condition' => [
            'is_featured' => 'yes',
        ],
        'description' => esc_html__('e.g., "20% OFF" or "POPULAR"', 'pagifye-elementor-widgets'),
    ]
);

// Register the repeater
$this->add_control(
    'pricing_cards',
    [
        'label' => esc_html__('Pricing Cards', 'pagifye-elementor-widgets'),
        'type' => Controls_Manager::REPEATER,
        'fields' => $repeater->get_controls(),
        'default' => [
            [
                'plan_name' => esc_html__('Starter', 'pagifye-elementor-widgets'),
                'monthly_price' => 'Free',
                'annual_price' => 'Free',
                'price_suffix' => '/month',
                'description' => 'Billed annually, up to 5 seats',
                'feature_text' => 'Maximise reviews impact with tools to drive SEO',
                'button_text' => 'Try for free',
                'button_url' => ['url' => '#'],
                'is_featured' => '',
            ],
            [
                'plan_name' => esc_html__('Growth', 'pagifye-elementor-widgets'),
                'monthly_price' => '$19',
                'annual_price' => '$19',
                'price_suffix' => '/month',
                'description' => 'Billed annually, up to 5 seats',
                'feature_text' => 'Maximise reviews impact with tools to drive SEO',
                'button_text' => 'Try for free',
                'button_url' => ['url' => '#'],
                'is_featured' => '',
            ],
            [
                'plan_name' => esc_html__('Scale', 'pagifye-elementor-widgets'),
                'monthly_price' => '$59',
                'annual_price' => '$49',
                'price_suffix' => '/month',
                'description' => 'Billed annually, up to 5 seats',
                'feature_text' => 'Maximise reviews impact with tools to drive SEO',
                'button_text' => 'Try for free',
                'button_url' => ['url' => '#'],
                'is_featured' => 'yes',
                'badge_text' => '20% OFF',
            ],
            [
                'plan_name' => esc_html__('Premier', 'pagifye-elementor-widgets'),
                'monthly_price' => '$99',
                'annual_price' => '$99',
                'price_suffix' => '/month',
                'description' => 'Billed annually, up to 5 seats',
                'feature_text' => 'Maximise reviews impact with tools to drive SEO',
                'button_text' => 'Try for free',
                'button_url' => ['url' => '#'],
                'is_featured' => '',
            ],
        ],
        'title_field' => '{{{ plan_name }}}',
    ]
);
```

---

## 7. Featured Card Logic

### Featured Card Implementation

#### PHP Logic for Featured Detection

```php
private function is_featured_card($card) {
    return isset($card['is_featured']) && 'yes' === $card['is_featured'];
}

private function has_badge($card) {
    return $this->is_featured_card($card) && !empty($card['badge_text']);
}

private function get_card_classes($card) {
    $classes = [
        'relative',
        'space-y-4',
        'p-5',
        'md:p-[30px]',
        'rounded-2xl',
        'border-[3px]',
        'bg-pgfy-gray-500',
    ];

    if ($this->is_featured_card($card)) {
        $classes[] = '!border-pgfy-primary-500';
        $classes[] = 'max-sm:order-first'; // Featured card appears first on mobile
    } else {
        $classes[] = 'border-white/10';
    }

    return implode(' ', $classes);
}

private function get_button_classes($card) {
    $classes = [
        'flex',
        'w-full',
        'select-none',
        'items-center',
        'justify-center',
        'gap-1',
        'rounded-full',
        'px-8',
        'py-3',
        'text-base',
        'font-bold',
    ];

    if ($this->is_featured_card($card)) {
        $classes[] = 'bg-pgfy-primary-500';
        $classes[] = 'text-pgfy-gray-500';
        $classes[] = 'transition';
        $classes[] = 'duration-300';
        $classes[] = 'ease-in-out';
        $classes[] = 'hover:bg-pgfy-primary-600';
    } else {
        $classes[] = 'bg-pgfy-gray-400';
        $classes[] = 'text-white';
    }

    return implode(' ', $classes);
}
```

#### Badge Rendering

```php
private function render_badge($card) {
    if (!$this->has_badge($card)) {
        return;
    }

    ?>
    <p class="absolute -top-7 right-7 rounded px-2 py-1 text-xs font-bold uppercase bg-pgfy-primary-500 text-pgfy-gray-500 pricing-badge">
        <?php echo esc_html($card['badge_text']); ?>
    </p>
    <?php
}
```

### Featured Card Styling Differences

| Element | Normal Card | Featured Card |
|---------|-------------|---------------|
| Border | `border-white/10` | `!border-pgfy-primary-500` |
| Button Background | `bg-pgfy-gray-400` | `bg-pgfy-primary-500` |
| Button Text | `text-white` | `text-pgfy-gray-500` |
| Button Hover | None | `hover:bg-pgfy-primary-600` |
| Mobile Order | Default | `max-sm:order-first` |
| Badge | Hidden | Visible (if badge_text exists) |
| Icon Fill | `#FFFFFF` | `#0F2C24` |

### Conditional Logic Flow

```
For each pricing card:
1. Check if is_featured === 'yes'

   IF FEATURED:
   2a. Apply primary border color
   2b. Use primary button styling
   2c. Add order-first on mobile
   2d. Change icon color to dark
   2e. Check if badge_text exists
       IF EXISTS:
       2e1. Render badge absolutely positioned

   IF NOT FEATURED:
   3a. Apply subtle border
   3b. Use default button styling
   3c. Default card order
   3d. Use white icon color
   3e. No badge
```

---

## 8. Styling Controls

### Style Tab Structure

All style controls are organized into sections on the Style tab.

#### Section: Section Style

```php
$this->start_controls_section(
    'section_style_section',
    [
        'label' => esc_html__('Section', 'pagifye-elementor-widgets'),
        'tab' => Controls_Manager::TAB_STYLE,
    ]
);

// Background
$this->add_group_control(
    Group_Control_Background::get_type(),
    [
        'name' => 'section_background',
        'label' => esc_html__('Background', 'pagifye-elementor-widgets'),
        'types' => ['classic', 'gradient'],
        'selector' => '{{WRAPPER}} .pricing-section',
        'default' => '#1F2937', // pgfy-gray-500
    ]
);

// Padding
$this->add_responsive_control(
    'section_padding',
    [
        'label' => esc_html__('Padding', 'pagifye-elementor-widgets'),
        'type' => Controls_Manager::DIMENSIONS,
        'size_units' => ['px', 'em', '%'],
        'selectors' => [
            '{{WRAPPER}} .pricing-section' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ],
        'default' => [
            'top' => '40',
            'right' => '0',
            'bottom' => '40',
            'left' => '0',
            'unit' => 'px',
            'isLinked' => false,
        ],
    ]
);

$this->end_controls_section();
```

#### Section: Header Style

```php
$this->start_controls_section(
    'section_style_header',
    [
        'label' => esc_html__('Header', 'pagifye-elementor-widgets'),
        'tab' => Controls_Manager::TAB_STYLE,
        'condition' => [
            'show_header' => 'yes',
        ],
    ]
);

// Heading Color
$this->add_control(
    'heading_color',
    [
        'label' => esc_html__('Text Color', 'pagifye-elementor-widgets'),
        'type' => Controls_Manager::COLOR,
        'selectors' => [
            '{{WRAPPER}} .pricing-heading' => 'color: {{VALUE}};',
        ],
        'default' => '#FFFFFF',
    ]
);

// Highlight Color
$this->add_control(
    'heading_highlight_color',
    [
        'label' => esc_html__('Highlight Color', 'pagifye-elementor-widgets'),
        'type' => Controls_Manager::COLOR,
        'selectors' => [
            '{{WRAPPER}} .pricing-heading .text-pgfy-primary-500' => 'color: {{VALUE}};',
        ],
        'default' => '#3DD68C', // pgfy-primary-500
    ]
);

// Typography
$this->add_group_control(
    Group_Control_Typography::get_type(),
    [
        'name' => 'heading_typography',
        'label' => esc_html__('Typography', 'pagifye-elementor-widgets'),
        'selector' => '{{WRAPPER}} .pricing-heading',
        'global' => [
            'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
        ],
    ]
);

// Spacing
$this->add_responsive_control(
    'heading_spacing',
    [
        'label' => esc_html__('Bottom Spacing', 'pagifye-elementor-widgets'),
        'type' => Controls_Manager::SLIDER,
        'size_units' => ['px'],
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
            '{{WRAPPER}} .pricing-heading' => 'margin-bottom: {{SIZE}}{{UNIT}};',
        ],
    ]
);

$this->end_controls_section();
```

#### Section: Toggle Button Style

```php
$this->start_controls_section(
    'section_style_toggle',
    [
        'label' => esc_html__('Billing Toggle', 'pagifye-elementor-widgets'),
        'tab' => Controls_Manager::TAB_STYLE,
        'condition' => [
            'show_billing_toggle' => 'yes',
        ],
    ]
);

// Toggle Container Background
$this->add_control(
    'toggle_container_bg',
    [
        'label' => esc_html__('Container Background', 'pagifye-elementor-widgets'),
        'type' => Controls_Manager::COLOR,
        'selectors' => [
            '{{WRAPPER}} .billing-toggle-container' => 'background-color: {{VALUE}};',
        ],
        'default' => '#374151', // pgfy-gray-400
    ]
);

// Toggle Typography
$this->add_group_control(
    Group_Control_Typography::get_type(),
    [
        'name' => 'toggle_typography',
        'label' => esc_html__('Typography', 'pagifye-elementor-widgets'),
        'selector' => '{{WRAPPER}} .billing-toggle-container button',
    ]
);

// Active Button Styles
$this->add_control(
    'toggle_active_heading',
    [
        'label' => esc_html__('Active Button', 'pagifye-elementor-widgets'),
        'type' => Controls_Manager::HEADING,
        'separator' => 'before',
    ]
);

$this->add_control(
    'toggle_active_bg',
    [
        'label' => esc_html__('Background', 'pagifye-elementor-widgets'),
        'type' => Controls_Manager::COLOR,
        'selectors' => [
            '{{WRAPPER}} .billing-toggle-container button.active' => 'background-color: {{VALUE}};',
        ],
        'default' => '#3DD68C', // pgfy-primary-500
    ]
);

$this->add_control(
    'toggle_active_color',
    [
        'label' => esc_html__('Text Color', 'pagifye-elementor-widgets'),
        'type' => Controls_Manager::COLOR,
        'selectors' => [
            '{{WRAPPER}} .billing-toggle-container button.active' => 'color: {{VALUE}};',
        ],
        'default' => '#0F2C24', // pgfy-gray-500
    ]
);

// Inactive Button Styles
$this->add_control(
    'toggle_inactive_heading',
    [
        'label' => esc_html__('Inactive Button', 'pagifye-elementor-widgets'),
        'type' => Controls_Manager::HEADING,
        'separator' => 'before',
    ]
);

$this->add_control(
    'toggle_inactive_color',
    [
        'label' => esc_html__('Text Color', 'pagifye-elementor-widgets'),
        'type' => Controls_Manager::COLOR,
        'selectors' => [
            '{{WRAPPER}} .billing-toggle-container button:not(.active)' => 'color: {{VALUE}};',
        ],
        'default' => '#FFFFFF',
    ]
);

// Spacing
$this->add_responsive_control(
    'toggle_spacing',
    [
        'label' => esc_html__('Bottom Spacing', 'pagifye-elementor-widgets'),
        'type' => Controls_Manager::SLIDER,
        'size_units' => ['px'],
        'range' => [
            'px' => [
                'min' => 0,
                'max' => 100,
            ],
        ],
        'default' => [
            'unit' => 'px',
            'size' => 40,
        ],
        'selectors' => [
            '{{WRAPPER}} .billing-toggle-container' => 'margin-bottom: {{SIZE}}{{UNIT}};',
        ],
    ]
);

$this->end_controls_section();
```

#### Section: Card Style

```php
$this->start_controls_section(
    'section_style_card',
    [
        'label' => esc_html__('Card', 'pagifye-elementor-widgets'),
        'tab' => Controls_Manager::TAB_STYLE,
    ]
);

// Card Background
$this->add_control(
    'card_background',
    [
        'label' => esc_html__('Background', 'pagifye-elementor-widgets'),
        'type' => Controls_Manager::COLOR,
        'selectors' => [
            '{{WRAPPER}} .pricing-card' => 'background-color: {{VALUE}};',
        ],
        'default' => '#1F2937', // pgfy-gray-500
    ]
);

// Normal Card Border
$this->add_control(
    'card_border_heading',
    [
        'label' => esc_html__('Normal Card Border', 'pagifye-elementor-widgets'),
        'type' => Controls_Manager::HEADING,
        'separator' => 'before',
    ]
);

$this->add_group_control(
    Group_Control_Border::get_type(),
    [
        'name' => 'card_border',
        'label' => esc_html__('Border', 'pagifye-elementor-widgets'),
        'selector' => '{{WRAPPER}} .pricing-card:not(.featured)',
        'fields_options' => [
            'border' => [
                'default' => 'solid',
            ],
            'width' => [
                'default' => [
                    'top' => '3',
                    'right' => '3',
                    'bottom' => '3',
                    'left' => '3',
                    'isLinked' => true,
                ],
            ],
            'color' => [
                'default' => 'rgba(255, 255, 255, 0.1)',
            ],
        ],
    ]
);

// Featured Card Border
$this->add_control(
    'featured_border_heading',
    [
        'label' => esc_html__('Featured Card Border', 'pagifye-elementor-widgets'),
        'type' => Controls_Manager::HEADING,
        'separator' => 'before',
    ]
);

$this->add_control(
    'featured_border_color',
    [
        'label' => esc_html__('Border Color', 'pagifye-elementor-widgets'),
        'type' => Controls_Manager::COLOR,
        'selectors' => [
            '{{WRAPPER}} .pricing-card.featured' => 'border-color: {{VALUE}};',
        ],
        'default' => '#3DD68C', // pgfy-primary-500
    ]
);

// Border Radius
$this->add_responsive_control(
    'card_border_radius',
    [
        'label' => esc_html__('Border Radius', 'pagifye-elementor-widgets'),
        'type' => Controls_Manager::DIMENSIONS,
        'size_units' => ['px', '%'],
        'selectors' => [
            '{{WRAPPER}} .pricing-card' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ],
        'default' => [
            'top' => '16',
            'right' => '16',
            'bottom' => '16',
            'left' => '16',
            'unit' => 'px',
            'isLinked' => true,
        ],
    ]
);

// Padding
$this->add_responsive_control(
    'card_padding',
    [
        'label' => esc_html__('Padding', 'pagifye-elementor-widgets'),
        'type' => Controls_Manager::DIMENSIONS,
        'size_units' => ['px', 'em', '%'],
        'selectors' => [
            '{{WRAPPER}} .pricing-card' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ],
        'default' => [
            'top' => '30',
            'right' => '30',
            'bottom' => '30',
            'left' => '30',
            'unit' => 'px',
            'isLinked' => true,
        ],
    ]
);

// Box Shadow
$this->add_group_control(
    Group_Control_Box_Shadow::get_type(),
    [
        'name' => 'card_box_shadow',
        'label' => esc_html__('Box Shadow', 'pagifye-elementor-widgets'),
        'selector' => '{{WRAPPER}} .pricing-card',
    ]
);

$this->end_controls_section();
```

#### Section: Plan Name & Price Style

```php
$this->start_controls_section(
    'section_style_price',
    [
        'label' => esc_html__('Plan Name & Price', 'pagifye-elementor-widgets'),
        'tab' => Controls_Manager::TAB_STYLE,
    ]
);

// Plan Name
$this->add_control(
    'plan_name_heading',
    [
        'label' => esc_html__('Plan Name', 'pagifye-elementor-widgets'),
        'type' => Controls_Manager::HEADING,
    ]
);

$this->add_control(
    'plan_name_color',
    [
        'label' => esc_html__('Color', 'pagifye-elementor-widgets'),
        'type' => Controls_Manager::COLOR,
        'selectors' => [
            '{{WRAPPER}} .plan-name' => 'color: {{VALUE}};',
        ],
        'default' => '#FFFFFF',
    ]
);

$this->add_group_control(
    Group_Control_Typography::get_type(),
    [
        'name' => 'plan_name_typography',
        'label' => esc_html__('Typography', 'pagifye-elementor-widgets'),
        'selector' => '{{WRAPPER}} .plan-name',
    ]
);

// Price
$this->add_control(
    'price_heading',
    [
        'label' => esc_html__('Price', 'pagifye-elementor-widgets'),
        'type' => Controls_Manager::HEADING,
        'separator' => 'before',
    ]
);

$this->add_control(
    'price_color',
    [
        'label' => esc_html__('Color', 'pagifye-elementor-widgets'),
        'type' => Controls_Manager::COLOR,
        'selectors' => [
            '{{WRAPPER}} .pricing-price' => 'color: {{VALUE}};',
        ],
        'default' => '#FFFFFF',
    ]
);

$this->add_group_control(
    Group_Control_Typography::get_type(),
    [
        'name' => 'price_typography',
        'label' => esc_html__('Typography', 'pagifye-elementor-widgets'),
        'selector' => '{{WRAPPER}} .pricing-price',
    ]
);

// Price Suffix
$this->add_control(
    'price_suffix_heading',
    [
        'label' => esc_html__('Price Suffix', 'pagifye-elementor-widgets'),
        'type' => Controls_Manager::HEADING,
        'separator' => 'before',
    ]
);

$this->add_group_control(
    Group_Control_Typography::get_type(),
    [
        'name' => 'price_suffix_typography',
        'label' => esc_html__('Typography', 'pagifye-elementor-widgets'),
        'selector' => '{{WRAPPER}} .price-suffix',
    ]
);

// Description
$this->add_control(
    'description_heading',
    [
        'label' => esc_html__('Description', 'pagifye-elementor-widgets'),
        'type' => Controls_Manager::HEADING,
        'separator' => 'before',
    ]
);

$this->add_control(
    'description_color',
    [
        'label' => esc_html__('Color', 'pagifye-elementor-widgets'),
        'type' => Controls_Manager::COLOR,
        'selectors' => [
            '{{WRAPPER}} .plan-description' => 'color: {{VALUE}};',
        ],
        'default' => 'rgba(229, 231, 235, 0.7)', // pgfy-gray-50/70
    ]
);

$this->add_group_control(
    Group_Control_Typography::get_type(),
    [
        'name' => 'description_typography',
        'label' => esc_html__('Typography', 'pagifye-elementor-widgets'),
        'selector' => '{{WRAPPER}} .plan-description',
    ]
);

$this->end_controls_section();
```

#### Section: Button Style

```php
$this->start_controls_section(
    'section_style_button',
    [
        'label' => esc_html__('Button', 'pagifye-elementor-widgets'),
        'tab' => Controls_Manager::TAB_STYLE,
    ]
);

// Normal Button Tabs
$this->start_controls_tabs('button_style_tabs');

// Normal State
$this->start_controls_tab(
    'button_normal',
    [
        'label' => esc_html__('Normal', 'pagifye-elementor-widgets'),
    ]
);

$this->add_control(
    'button_bg_color',
    [
        'label' => esc_html__('Background', 'pagifye-elementor-widgets'),
        'type' => Controls_Manager::COLOR,
        'selectors' => [
            '{{WRAPPER}} .pricing-button:not(.featured-button)' => 'background-color: {{VALUE}};',
        ],
        'default' => '#374151', // pgfy-gray-400
    ]
);

$this->add_control(
    'button_text_color',
    [
        'label' => esc_html__('Text Color', 'pagifye-elementor-widgets'),
        'type' => Controls_Manager::COLOR,
        'selectors' => [
            '{{WRAPPER}} .pricing-button:not(.featured-button)' => 'color: {{VALUE}};',
        ],
        'default' => '#FFFFFF',
    ]
);

$this->end_controls_tab();

// Hover State
$this->start_controls_tab(
    'button_hover',
    [
        'label' => esc_html__('Hover', 'pagifye-elementor-widgets'),
    ]
);

$this->add_control(
    'button_bg_color_hover',
    [
        'label' => esc_html__('Background', 'pagifye-elementor-widgets'),
        'type' => Controls_Manager::COLOR,
        'selectors' => [
            '{{WRAPPER}} .pricing-button:not(.featured-button):hover' => 'background-color: {{VALUE}};',
        ],
    ]
);

$this->add_control(
    'button_text_color_hover',
    [
        'label' => esc_html__('Text Color', 'pagifye-elementor-widgets'),
        'type' => Controls_Manager::COLOR,
        'selectors' => [
            '{{WRAPPER}} .pricing-button:not(.featured-button):hover' => 'color: {{VALUE}};',
        ],
    ]
);

$this->end_controls_tab();

$this->end_controls_tabs();

// Featured Button
$this->add_control(
    'featured_button_heading',
    [
        'label' => esc_html__('Featured Button', 'pagifye-elementor-widgets'),
        'type' => Controls_Manager::HEADING,
        'separator' => 'before',
    ]
);

$this->start_controls_tabs('featured_button_style_tabs');

// Normal State
$this->start_controls_tab(
    'featured_button_normal',
    [
        'label' => esc_html__('Normal', 'pagifye-elementor-widgets'),
    ]
);

$this->add_control(
    'featured_button_bg',
    [
        'label' => esc_html__('Background', 'pagifye-elementor-widgets'),
        'type' => Controls_Manager::COLOR,
        'selectors' => [
            '{{WRAPPER}} .pricing-button.featured-button' => 'background-color: {{VALUE}};',
        ],
        'default' => '#3DD68C', // pgfy-primary-500
    ]
);

$this->add_control(
    'featured_button_color',
    [
        'label' => esc_html__('Text Color', 'pagifye-elementor-widgets'),
        'type' => Controls_Manager::COLOR,
        'selectors' => [
            '{{WRAPPER}} .pricing-button.featured-button' => 'color: {{VALUE}};',
        ],
        'default' => '#0F2C24', // pgfy-gray-500
    ]
);

$this->end_controls_tab();

// Hover State
$this->start_controls_tab(
    'featured_button_hover',
    [
        'label' => esc_html__('Hover', 'pagifye-elementor-widgets'),
    ]
);

$this->add_control(
    'featured_button_bg_hover',
    [
        'label' => esc_html__('Background', 'pagifye-elementor-widgets'),
        'type' => Controls_Manager::COLOR,
        'selectors' => [
            '{{WRAPPER}} .pricing-button.featured-button:hover' => 'background-color: {{VALUE}};',
        ],
        'default' => '#2AB574', // pgfy-primary-600
    ]
);

$this->end_controls_tab();

$this->end_controls_tabs();

// Typography
$this->add_group_control(
    Group_Control_Typography::get_type(),
    [
        'name' => 'button_typography',
        'label' => esc_html__('Typography', 'pagifye-elementor-widgets'),
        'selector' => '{{WRAPPER}} .pricing-button',
        'separator' => 'before',
    ]
);

// Padding
$this->add_responsive_control(
    'button_padding',
    [
        'label' => esc_html__('Padding', 'pagifye-elementor-widgets'),
        'type' => Controls_Manager::DIMENSIONS,
        'size_units' => ['px', 'em'],
        'selectors' => [
            '{{WRAPPER}} .pricing-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ],
        'default' => [
            'top' => '12',
            'right' => '32',
            'bottom' => '12',
            'left' => '32',
            'unit' => 'px',
            'isLinked' => false,
        ],
    ]
);

$this->end_controls_section();
```

#### Section: Badge Style

```php
$this->start_controls_section(
    'section_style_badge',
    [
        'label' => esc_html__('Featured Badge', 'pagifye-elementor-widgets'),
        'tab' => Controls_Manager::TAB_STYLE,
    ]
);

$this->add_control(
    'badge_background',
    [
        'label' => esc_html__('Background', 'pagifye-elementor-widgets'),
        'type' => Controls_Manager::COLOR,
        'selectors' => [
            '{{WRAPPER}} .pricing-badge' => 'background-color: {{VALUE}};',
        ],
        'default' => '#3DD68C', // pgfy-primary-500
    ]
);

$this->add_control(
    'badge_color',
    [
        'label' => esc_html__('Text Color', 'pagifye-elementor-widgets'),
        'type' => Controls_Manager::COLOR,
        'selectors' => [
            '{{WRAPPER}} .pricing-badge' => 'color: {{VALUE}};',
        ],
        'default' => '#0F2C24', // pgfy-gray-500
    ]
);

$this->add_group_control(
    Group_Control_Typography::get_type(),
    [
        'name' => 'badge_typography',
        'label' => esc_html__('Typography', 'pagifye-elementor-widgets'),
        'selector' => '{{WRAPPER}} .pricing-badge',
        'fields_options' => [
            'font_size' => [
                'default' => [
                    'size' => 12,
                    'unit' => 'px',
                ],
            ],
            'text_transform' => [
                'default' => 'uppercase',
            ],
            'font_weight' => [
                'default' => '700',
            ],
        ],
    ]
);

$this->add_responsive_control(
    'badge_padding',
    [
        'label' => esc_html__('Padding', 'pagifye-elementor-widgets'),
        'type' => Controls_Manager::DIMENSIONS,
        'size_units' => ['px'],
        'selectors' => [
            '{{WRAPPER}} .pricing-badge' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ],
        'default' => [
            'top' => '4',
            'right' => '8',
            'bottom' => '4',
            'left' => '8',
            'unit' => 'px',
            'isLinked' => false,
        ],
    ]
);

$this->add_control(
    'badge_position_heading',
    [
        'label' => esc_html__('Position', 'pagifye-elementor-widgets'),
        'type' => Controls_Manager::HEADING,
        'separator' => 'before',
    ]
);

$this->add_responsive_control(
    'badge_position_top',
    [
        'label' => esc_html__('Top', 'pagifye-elementor-widgets'),
        'type' => Controls_Manager::SLIDER,
        'size_units' => ['px'],
        'range' => [
            'px' => [
                'min' => -50,
                'max' => 50,
            ],
        ],
        'default' => [
            'unit' => 'px',
            'size' => -28,
        ],
        'selectors' => [
            '{{WRAPPER}} .pricing-badge' => 'top: {{SIZE}}{{UNIT}};',
        ],
    ]
);

$this->add_responsive_control(
    'badge_position_right',
    [
        'label' => esc_html__('Right', 'pagifye-elementor-widgets'),
        'type' => Controls_Manager::SLIDER,
        'size_units' => ['px'],
        'range' => [
            'px' => [
                'min' => 0,
                'max' => 100,
            ],
        ],
        'default' => [
            'unit' => 'px',
            'size' => 28,
        ],
        'selectors' => [
            '{{WRAPPER}} .pricing-badge' => 'right: {{SIZE}}{{UNIT}};',
        ],
    ]
);

$this->end_controls_section();
```

---

## 9. Grid Layout Controls

### Grid Columns Control

```php
$this->start_controls_section(
    'section_grid_layout',
    [
        'label' => esc_html__('Grid Layout', 'pagifye-elementor-widgets'),
        'tab' => Controls_Manager::TAB_CONTENT,
    ]
);

// Desktop Columns
$this->add_responsive_control(
    'grid_columns',
    [
        'label' => esc_html__('Columns', 'pagifye-elementor-widgets'),
        'type' => Controls_Manager::SELECT,
        'default' => '4',
        'tablet_default' => '2',
        'mobile_default' => '1',
        'options' => [
            '1' => '1',
            '2' => '2',
            '3' => '3',
            '4' => '4',
            '5' => '5',
            '6' => '6',
        ],
        'selectors' => [
            '{{WRAPPER}} .pricing-grid' => 'grid-template-columns: repeat({{VALUE}}, minmax(0, 1fr));',
        ],
    ]
);

// Gap Between Cards
$this->add_responsive_control(
    'grid_gap',
    [
        'label' => esc_html__('Gap', 'pagifye-elementor-widgets'),
        'type' => Controls_Manager::SLIDER,
        'size_units' => ['px'],
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
        'tablet_default' => [
            'unit' => 'px',
            'size' => 24,
        ],
        'mobile_default' => [
            'unit' => 'px',
            'size' => 24,
        ],
        'selectors' => [
            '{{WRAPPER}} .pricing-grid' => 'gap: {{SIZE}}{{UNIT}};',
        ],
    ]
);

// Row Gap (if different from column gap)
$this->add_responsive_control(
    'grid_row_gap',
    [
        'label' => esc_html__('Row Gap', 'pagifye-elementor-widgets'),
        'type' => Controls_Manager::SLIDER,
        'size_units' => ['px'],
        'range' => [
            'px' => [
                'min' => 0,
                'max' => 100,
            ],
        ],
        'selectors' => [
            '{{WRAPPER}} .pricing-grid' => 'row-gap: {{SIZE}}{{UNIT}};',
        ],
    ]
);

$this->end_controls_section();
```

### Responsive Grid Implementation

In the render method:

```php
private function render_pricing_cards() {
    $settings = $this->get_settings_for_display();
    $cards = $settings['pricing_cards'];

    if (empty($cards)) {
        return;
    }

    ?>
    <div class="pricing-grid">
        <?php foreach ($cards as $index => $card) : ?>
            <?php $this->render_single_card($card, $index); ?>
        <?php endforeach; ?>
    </div>
    <?php
}
```

The grid CSS is controlled by Elementor's responsive controls and Tailwind classes:

```css
.pricing-grid {
    display: grid;
    grid-template-columns: repeat(var(--elementor-grid-columns, 4), minmax(0, 1fr));
    gap: var(--elementor-grid-gap, 24px);
}

@media (max-width: 1024px) {
    .pricing-grid {
        grid-template-columns: repeat(var(--elementor-grid-columns-tablet, 2), minmax(0, 1fr));
    }
}

@media (max-width: 767px) {
    .pricing-grid {
        grid-template-columns: repeat(var(--elementor-grid-columns-mobile, 1), minmax(0, 1fr));
    }
}
```

---

## 10. Implementation Steps

### Phase 1: Setup & Scaffolding (30 minutes)

**Step 1.1: Create Widget Class File**
```bash
# Create file at: widgets/class-pricing-01-widget.php
touch widgets/class-pricing-01-widget.php
```

**Step 1.2: Add Basic Class Structure**
- Copy widget template
- Define namespace
- Extend `Widget_Base`
- Import required Elementor classes
- Add basic identification methods

**Step 1.3: Register Widget**
```php
// In main plugin file or widget manager
add_action('elementor/widgets/register', function($widgets_manager) {
    require_once(__DIR__ . '/widgets/class-pricing-01-widget.php');
    $widgets_manager->register(new \Pagifye_Elementor_Widgets\Widgets\Pricing_01_Widget());
});
```

**Step 1.4: Create Asset Files**
```bash
mkdir -p assets/js
mkdir -p assets/css
touch assets/js/pricing-01.js
touch assets/css/pricing-01.css
```

### Phase 2: Content Controls (1 hour)

**Step 2.1: Implement Header Controls**
- Add `register_header_controls()` method
- Create show_header switcher
- Add heading_text textarea
- Add highlight_words text field
- Add heading_alignment choose control

**Step 2.2: Implement Billing Toggle Controls**
- Add `register_billing_toggle_controls()` method
- Create show_billing_toggle switcher
- Add monthly_label and annual_label text fields
- Add default_billing_period select

**Step 2.3: Implement Pricing Cards Repeater**
- Add `register_pricing_cards_controls()` method
- Create repeater instance
- Add all repeater fields (see Section 6)
- Set default data for 4 cards
- Register repeater with title_field

**Step 2.4: Implement Grid Layout Controls**
- Add grid_columns responsive select
- Add grid_gap responsive slider
- Add row_gap slider (optional)

### Phase 3: Style Controls (1 hour)

**Step 3.1: Section Style Controls**
- Background color/gradient
- Padding (responsive)

**Step 3.2: Header Style Controls**
- Text color
- Highlight color
- Typography group control
- Spacing

**Step 3.3: Toggle Button Style Controls**
- Container background
- Typography
- Active/inactive states
- Spacing

**Step 3.4: Card Style Controls**
- Background color
- Normal border (group control)
- Featured border color
- Border radius
- Padding
- Box shadow

**Step 3.5: Price & Plan Style Controls**
- Plan name: color, typography
- Price: color, typography
- Price suffix: typography
- Description: color, typography

**Step 3.6: Button Style Controls**
- Normal button: tabs for normal/hover states
- Featured button: tabs for normal/hover states
- Typography
- Padding

**Step 3.7: Badge Style Controls**
- Background color
- Text color
- Typography
- Padding
- Position adjustments

### Phase 4: Render Implementation (2 hours)

**Step 4.1: Main Render Method**
- Get settings
- Setup Alpine.js data attribute
- Render section wrapper
- Call helper methods

**Step 4.2: Header Rendering**
- Implement `render_header()` method
- Check show_header condition
- Process text highlighting
- Output heading HTML

**Step 4.3: Billing Toggle Rendering**
- Implement `render_billing_toggle()` method
- Check show_billing_toggle condition
- Add Alpine.js click handlers
- Add Alpine.js class bindings
- Output toggle HTML

**Step 4.4: Cards Grid Rendering**
- Implement `render_pricing_cards()` method
- Build grid classes dynamically
- Loop through cards
- Call single card renderer

**Step 4.5: Single Card Rendering**
- Implement `render_single_card()` method
- Detect featured status
- Build card classes
- Build button classes
- Render plan header
- Render price with Alpine.js toggle
- Render divider
- Render features and button
- Render badge (conditional)

**Step 4.6: Helper Methods**
- Implement `highlight_text()` method
- Implement `render_button_icon()` method
- Implement `is_featured_card()` helper
- Implement `has_badge()` helper

### Phase 5: Alpine.js Integration (30 minutes)

**Step 5.1: Create Alpine.js Script**
```javascript
// assets/js/pricing-01.js
document.addEventListener('alpine:init', () => {
    // Alpine.js initialization code
});
```

**Step 5.2: Add x-cloak Styles**
```css
/* assets/css/pricing-01.css */
[x-cloak] { display: none !important; }
```

**Step 5.3: Register Scripts**
- Enqueue Alpine.js from CDN
- Enqueue pricing-01.js with Alpine.js dependency
- Enqueue pricing-01.css

**Step 5.4: Test Toggle Functionality**
- Click monthly button
- Verify prices switch
- Click annual button
- Verify prices switch back
- Check button styling changes

### Phase 6: Testing & Refinement (1 hour)

**Step 6.1: Functional Testing**
- Add widget to page
- Test all content controls
- Test all style controls
- Test responsive behavior
- Test Alpine.js toggle

**Step 6.2: Edge Case Testing**
- Empty repeater
- Single card
- Many cards (6+)
- Long text in fields
- Missing badge text
- All cards featured
- No cards featured

**Step 6.3: Browser Testing**
- Chrome
- Firefox
- Safari
- Edge
- Mobile browsers

**Step 6.4: Performance Testing**
- Check page load time
- Verify asset loading
- Check for console errors
- Test in Elementor editor
- Test on frontend

**Step 6.5: Accessibility Testing**
- Keyboard navigation
- Screen reader compatibility
- Color contrast ratios
- ARIA labels where needed
- Focus states

### Phase 7: Documentation & Polish (30 minutes)

**Step 7.1: Add Inline Documentation**
- PHPDoc blocks for all methods
- Inline comments for complex logic
- Control descriptions

**Step 7.2: Code Cleanup**
- Remove debug code
- Format code consistently
- Check for unused variables
- Validate PHP syntax

**Step 7.3: Create Usage Documentation**
- Widget description
- Control explanations
- Common use cases
- Troubleshooting tips

---

## 11. Testing Checklist

### Functionality Tests

- [ ] Widget appears in Elementor panel under "Pagifye" category
- [ ] Widget icon displays correctly
- [ ] Widget can be dragged to page
- [ ] All content controls visible and functional
- [ ] All style controls visible and functional

### Header Tests

- [ ] Header shows/hides based on toggle
- [ ] Heading text updates in real-time
- [ ] Words highlight correctly based on highlight_words
- [ ] Multiple words can be highlighted (comma-separated)
- [ ] Alignment control works (left/center/right)
- [ ] Typography controls apply correctly
- [ ] Color controls work
- [ ] Spacing control functions

### Billing Toggle Tests

- [ ] Toggle shows/hides based on control
- [ ] Default period applies on load
- [ ] Monthly button switches to monthly prices
- [ ] Annual button switches to annual prices
- [ ] Active button styling applies correctly
- [ ] Button labels update from controls
- [ ] Typography controls work
- [ ] Color controls work

### Pricing Cards Tests

- [ ] Cards display in grid layout
- [ ] Correct number of columns on desktop/tablet/mobile
- [ ] Gap control adjusts spacing
- [ ] All card content displays correctly
- [ ] Plan names show correctly
- [ ] Prices toggle between monthly/annual
- [ ] Price suffix displays
- [ ] Descriptions show
- [ ] Feature text displays
- [ ] Buttons render with correct URLs
- [ ] Button icons appear
- [ ] External links work
- [ ] Nofollow attribute applies when set

### Featured Card Tests

- [ ] Featured toggle works for any card
- [ ] Featured card gets primary border
- [ ] Featured card button uses primary styling
- [ ] Featured card icon color changes
- [ ] Badge appears when text provided
- [ ] Badge hides when text empty
- [ ] Badge text updates in real-time
- [ ] Badge position adjusts with controls
- [ ] Featured card appears first on mobile
- [ ] Multiple cards can be featured

### Style Controls Tests

- [ ] Section background changes
- [ ] Section padding adjusts
- [ ] Card background color changes
- [ ] Normal card border adjusts
- [ ] Featured card border color changes
- [ ] Border radius works
- [ ] Card padding adjusts
- [ ] Box shadow applies
- [ ] All typography controls work
- [ ] All color controls work
- [ ] Button hover states work
- [ ] Badge styles apply

### Responsive Tests

- [ ] Desktop: 4 columns (default)
- [ ] Tablet: 2 columns (default)
- [ ] Mobile: 1 column (default)
- [ ] Custom column counts work
- [ ] Featured card reorders on mobile
- [ ] All text scales appropriately
- [ ] Padding adjusts per breakpoint
- [ ] Gaps adjust per breakpoint

### Alpine.js Tests

- [ ] Alpine.js loads without errors
- [ ] Billing toggle initializes correctly
- [ ] Price switching is smooth
- [ ] No flash of unstyled content
- [ ] x-cloak works
- [ ] State persists during interaction
- [ ] Console shows no errors

### Browser Compatibility Tests

- [ ] Chrome (latest)
- [ ] Firefox (latest)
- [ ] Safari (latest)
- [ ] Edge (latest)
- [ ] Mobile Safari (iOS)
- [ ] Chrome Mobile (Android)

### Performance Tests

- [ ] Page load time acceptable
- [ ] No layout shifts (CLS)
- [ ] Assets load efficiently
- [ ] No JavaScript errors
- [ ] Elementor editor loads widget quickly
- [ ] Widget saves without delay

### Accessibility Tests

- [ ] Keyboard navigation works
- [ ] Focus indicators visible
- [ ] ARIA labels present where needed
- [ ] Screen reader friendly
- [ ] Color contrast meets WCAG AA
- [ ] Heading hierarchy logical
- [ ] Links are descriptive

### Edge Cases Tests

- [ ] Empty repeater (no cards)
- [ ] Single card displays properly
- [ ] 10+ cards handle well
- [ ] Very long plan names
- [ ] Very long descriptions
- [ ] Special characters in text
- [ ] HTML in text fields (escaped)
- [ ] Missing button URL
- [ ] Free price (no $)
- [ ] Large numbers in price

### Integration Tests

- [ ] Works with other Elementor widgets
- [ ] Works with Elementor themes
- [ ] Works with Elementor Pro features
- [ ] Plays nice with other plugins
- [ ] Exports/imports correctly
- [ ] Copy/paste widget works
- [ ] Undo/redo functions
- [ ] Widget templates save correctly

---

## 12. Code Snippets

### Complete Widget Registration

```php
<?php
/**
 * Register Pricing-01 Widget
 *
 * @param \Elementor\Widgets_Manager $widgets_manager
 */
function register_pricing_01_widget($widgets_manager) {
    require_once(__DIR__ . '/widgets/class-pricing-01-widget.php');

    $widgets_manager->register(new \Pagifye_Elementor_Widgets\Widgets\Pricing_01_Widget());
}
add_action('elementor/widgets/register', 'register_pricing_01_widget');
```

### Complete register_controls() Method Structure

```php
protected function register_controls() {
    // Content Tab
    $this->register_header_controls();
    $this->register_billing_toggle_controls();
    $this->register_pricing_cards_controls();
    $this->register_grid_layout_controls();

    // Style Tab
    $this->register_section_style_controls();
    $this->register_header_style_controls();
    $this->register_toggle_style_controls();
    $this->register_card_style_controls();
    $this->register_price_style_controls();
    $this->register_button_style_controls();
    $this->register_badge_style_controls();
}
```

### Example Repeater Control Registration

```php
private function register_pricing_cards_controls() {
    $this->start_controls_section(
        'section_pricing_cards',
        [
            'label' => esc_html__('Pricing Cards', 'pagifye-elementor-widgets'),
            'tab' => Controls_Manager::TAB_CONTENT,
        ]
    );

    $repeater = new \Elementor\Repeater();

    // Add all repeater fields here (see Section 6)

    $this->add_control(
        'pricing_cards',
        [
            'label' => esc_html__('Pricing Cards', 'pagifye-elementor-widgets'),
            'type' => Controls_Manager::REPEATER,
            'fields' => $repeater->get_controls(),
            'default' => [
                // Default card data
            ],
            'title_field' => '{{{ plan_name }}}',
        ]
    );

    $this->end_controls_section();
}
```

### Complete Render Method with Alpine.js

```php
protected function render() {
    $settings = $this->get_settings_for_display();

    $default_period = isset($settings['default_billing_period'])
        ? $settings['default_billing_period']
        : 'annual';

    ?>
    <section class="pricing-section bg-pgfy-gray-500 py-10 md:py-20 lg:py-28"
             x-data="{ billingPeriod: '<?php echo esc_attr($default_period); ?>' }">
        <div class="container flex flex-col items-center justify-center gap-6 md:gap-10">

            <?php $this->render_header(); ?>

            <?php $this->render_billing_toggle(); ?>

            <?php $this->render_pricing_cards(); ?>

        </div>
    </section>
    <?php
}
```

### Alpine.js Price Toggle Example

```php
<h6 class="pricing-price text-4xl font-bold leading-[48px] md:text-5xl md:leading-[56px] text-white">
    <span x-show="billingPeriod === 'monthly'" x-cloak>
        <?php echo esc_html($card['monthly_price']); ?>
    </span>
    <span x-show="billingPeriod === 'annual'" x-cloak>
        <?php echo esc_html($card['annual_price']); ?>
    </span>
    <span class="price-suffix text-base font-normal">
        <?php echo esc_html($card['price_suffix']); ?>
    </span>
</h6>
```

### Complete Featured Card Logic

```php
private function render_single_card($card, $index) {
    $is_featured = $this->is_featured_card($card);
    $has_badge = $this->has_badge($card);

    $card_classes = $this->get_card_classes($card);
    $button_classes = $this->get_button_classes($card);

    ?>
    <div class="<?php echo esc_attr($card_classes); ?> pricing-card <?php echo $is_featured ? 'featured' : ''; ?>">

        <!-- Card content here -->

        <?php if ($has_badge) : ?>
            <?php $this->render_badge($card); ?>
        <?php endif; ?>

    </div>
    <?php
}

private function is_featured_card($card) {
    return isset($card['is_featured']) && 'yes' === $card['is_featured'];
}

private function has_badge($card) {
    return $this->is_featured_card($card) && !empty($card['badge_text']);
}

private function get_card_classes($card) {
    $classes = [
        'relative',
        'space-y-4',
        'p-5',
        'md:p-[30px]',
        'rounded-2xl',
        'border-[3px]',
        'bg-pgfy-gray-500',
    ];

    if ($this->is_featured_card($card)) {
        $classes[] = '!border-pgfy-primary-500';
        $classes[] = 'max-sm:order-first';
    } else {
        $classes[] = 'border-white/10';
    }

    return implode(' ', $classes);
}
```

### Asset Enqueuing

```php
public function get_script_depends() {
    return ['alpine-js', 'pagifye-pricing-01'];
}

public function get_style_depends() {
    return ['pagifye-tailwind', 'pagifye-pricing-01'];
}

// In plugin main file
add_action('elementor/frontend/after_register_scripts', function() {
    wp_register_script(
        'alpine-js',
        'https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js',
        [],
        '3.13.0',
        true
    );

    wp_register_script(
        'pagifye-pricing-01',
        PAGIFYE_PLUGIN_URL . 'assets/js/pricing-01.js',
        ['alpine-js'],
        PAGIFYE_VERSION,
        true
    );
});

add_action('elementor/frontend/after_register_styles', function() {
    wp_register_style(
        'pagifye-tailwind',
        PAGIFYE_PLUGIN_URL . 'assets/css/tailwind-output.css',
        [],
        PAGIFYE_VERSION
    );

    wp_register_style(
        'pagifye-pricing-01',
        PAGIFYE_PLUGIN_URL . 'assets/css/pricing-01.css',
        ['pagifye-tailwind'],
        PAGIFYE_VERSION
    );
});
```

### Text Highlighting Helper

```php
private function highlight_text($text, $highlight_words) {
    if (empty($highlight_words)) {
        return '<span>' . esc_html($text) . '</span>';
    }

    // Split highlight words by comma
    $words_to_highlight = array_map('trim', explode(',', $highlight_words));

    // Split text into words
    $words = explode(' ', $text);
    $output = '';

    foreach ($words as $word) {
        $is_highlighted = false;

        // Check if this word should be highlighted
        foreach ($words_to_highlight as $highlight) {
            if (stripos($word, $highlight) !== false) {
                $output .= '<span class="text-pgfy-primary-500">' . esc_html($word) . '</span> ';
                $is_highlighted = true;
                break;
            }
        }

        if (!$is_highlighted) {
            $output .= '<span>' . esc_html($word) . '</span> ';
        }
    }

    return trim($output);
}
```

### Complete Alpine.js JavaScript File

```javascript
/**
 * Pricing-01 Widget - Alpine.js Integration
 *
 * Handles billing period toggle functionality
 */

// Wait for Alpine.js to initialize
document.addEventListener('alpine:init', () => {

    // Optional: Define reusable Alpine component
    Alpine.data('pricingToggle', (defaultPeriod = 'annual') => ({
        billingPeriod: defaultPeriod,

        init() {
            // Any initialization logic
            console.log('Pricing toggle initialized with:', this.billingPeriod);
        },

        setMonthly() {
            this.billingPeriod = 'monthly';
        },

        setAnnual() {
            this.billingPeriod = 'annual';
        },

        isMonthly() {
            return this.billingPeriod === 'monthly';
        },

        isAnnual() {
            return this.billingPeriod === 'annual';
        }
    }));

});

// Optional: Add smooth transition when prices change
document.addEventListener('DOMContentLoaded', function() {
    const pricingSections = document.querySelectorAll('[x-data]');

    pricingSections.forEach(section => {
        if (section.hasAttribute('x-data') && section.getAttribute('x-data').includes('billingPeriod')) {
            // Add transition class to price elements
            const priceElements = section.querySelectorAll('[x-show]');
            priceElements.forEach(el => {
                el.style.transition = 'opacity 0.2s ease-in-out';
            });
        }
    });
});
```

---

## Summary

This implementation plan provides a complete roadmap for developing the Pricing-01 Elementor widget. Key points:

1. **Component Analysis**: Detailed breakdown of HTML structure and features
2. **Controls**: Comprehensive list of all Elementor controls needed
3. **PHP Structure**: Complete class outline with all methods
4. **Rendering**: Step-by-step render implementation with code examples
5. **Alpine.js**: Full integration guide for billing toggle functionality
6. **Repeater**: Detailed repeater structure with all fields
7. **Featured Logic**: Complete implementation of featured card highlighting
8. **Styling**: All style tab controls with default values
9. **Grid Layout**: Responsive grid implementation
10. **Implementation**: Step-by-step coding guide (estimated 6 hours)
11. **Testing**: Comprehensive checklist covering all scenarios
12. **Code Snippets**: Ready-to-use code examples

**Estimated Development Time:** 6-8 hours for a developer familiar with Elementor widget development.

**Technical Requirements:**
- PHP 7.4+
- WordPress 5.8+
- Elementor 3.16+
- Tailwind CSS 3.4+
- Alpine.js 3.13+

**Next Steps:**
1. Review this plan
2. Set up development environment
3. Follow implementation steps in order
4. Test thoroughly using checklist
5. Deploy to production

---

**Document Version:** 1.0.0
**Last Updated:** 2025-11-02
**Status:** Ready for Development
