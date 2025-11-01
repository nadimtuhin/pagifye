# Navigation-01 Implementation Plan

**Component:** Navigation-01
**File:** `/Users/nadimtuhin/opensource/pagifye/components/root_navigation-01.html`
**Widget Class:** `Pagifye_Navigation_01`
**Category:** Navigation
**Priority:** Highest (⭐⭐⭐⭐⭐)
**Estimated Time:** 3-4 days

---

## Table of Contents

1. [Component Analysis](#component-analysis)
2. [Elementor Controls Specification](#elementor-controls-specification)
3. [PHP Class Structure](#php-class-structure)
4. [Render Method Implementation Plan](#render-method-implementation-plan)
5. [Alpine.js Integration](#alpinejs-integration)
6. [Styling Controls](#styling-controls)
7. [Responsive Behavior](#responsive-behavior)
8. [Implementation Steps](#implementation-steps)
9. [Testing Checklist](#testing-checklist)
10. [Code Snippets](#code-snippets)

---

## Component Analysis

### HTML Structure Overview

The Navigation-01 component consists of:

```
<section> (min-h-screen wrapper)
  └── <header> (navigation container)
      ├── Desktop Navigation
      │   ├── Logo (image with link)
      │   ├── Menu (nav > ul)
      │   │   ├── Menu Item (simple link)
      │   │   ├── Menu Item with Dropdown
      │   │   │   ├── Parent Link
      │   │   │   ├── SVG Icon (chevron)
      │   │   │   └── Dropdown Container
      │   │   │       └── Submenu Items (ul > li)
      │   │   └── More Menu Items...
      │   └── CTA Buttons Container
      │       ├── Primary Button (Sign In)
      │       └── Secondary Button (Get Started)
      └── Mobile Navigation
          ├── Mobile CTA Button (Get Started)
          ├── Menu Toggle Button (hamburger icon)
          └── Mobile Menu Panel (x-show)
              ├── Menu Items List
              └── CTA Buttons Container
```

### Key Elements Analysis

#### 1. Header Container
- **Classes:** `relative flex items-center justify-between py-4 font-medium max-lg:pr-4 bg-pgfy-gray-500 text-white`
- **Role:** Main navigation wrapper
- **Customizable:** Background color, text color, padding, height

#### 2. Logo
- **Element:** `<img>` wrapped in `<a>`
- **Source:** `https://static.pagifye.com/root/images/navbar/root-ui-white-logo.svg`
- **Link:** `#top`
- **Customizable:** Logo image, alt text, link URL, size

#### 3. Desktop Menu
- **Container:** `<nav>` > `<ul class="flex gap-6 max-lg:hidden">`
- **Menu Items:** Regular links + dropdown items
- **Gap:** 6 (1.5rem)
- **Hidden:** Below `lg` breakpoint

#### 4. Desktop Menu Items

**Simple Menu Item:**
```html
<li>
  <a href="#top">Home</a>
</li>
```

**Dropdown Menu Item:**
```html
<li class="group relative">
  <a href="#top" class="flex items-center gap-1">
    Product
    <svg><!-- chevron icon --></svg>
  </a>
  <div class="invisible absolute... group-hover:visible...">
    <ul class="flex flex-col gap-2">
      <li><a href="#top">Overview</a></li>
      <!-- more submenu items -->
    </ul>
  </div>
</li>
```

**Dropdown Mechanics:**
- Parent: `group relative`
- Dropdown: Initially `invisible opacity-0`
- Trigger: `group-hover:visible group-hover:opacity-100`
- Animation: `transition-all duration-300`
- Icon rotation: `group-hover:rotate-180`

#### 5. Desktop CTA Buttons

**Primary Button (Outline):**
- **Classes:** `border-pgfy-primary-500 text-white hover:bg-pgfy-primary-500 hover:text-pgfy-gray-400`
- **Style:** Outlined with hover fill

**Secondary Button (Filled):**
- **Classes:** `bg-pgfy-primary-500 text-pgfy-gray-500 hover:bg-pgfy-primary-600`
- **Style:** Filled with darker hover

**Common Button Classes:**
- `group flex select-none items-center justify-center gap-1 text-nowrap rounded-full text-base font-bold transition duration-300 ease-in-out max-lg:w-full sm:w-max px-8 py-3`

#### 6. Mobile Navigation

**Mobile Toggle Button:**
```html
<button @click="isOpen = !isOpen" class="relative z-10">
  <img src="...burger-menu-white.svg" alt="Menu">
</button>
```

**Mobile Menu Panel:**
```html
<div x-show="isOpen" style="display: none;">
  <div class="absolute inset-x-0 top-[70px]... bg-pgfy-gray-500">
    <ul class="space-y-4 pt-6">
      <!-- Mobile menu items -->
    </ul>
    <div class="flex w-full flex-wrap gap-4 max-sm:flex-col">
      <!-- Mobile CTA buttons -->
    </div>
  </div>
</div>
```

**Mobile Menu Characteristics:**
- **Trigger:** Alpine.js `x-data="{ isOpen: false }"`
- **Toggle:** `@click="isOpen = !isOpen"`
- **Display:** `x-show="isOpen"`
- **Position:** Absolute, full-width overlay
- **Top offset:** `top-[70px]` (below header)
- **Height:** `h-[calc(100vh-72px)]`
- **Visibility:** Hidden on `lg` and above (`lg:hidden`)

### Color Scheme

**Background Colors:**
- Header: `bg-pgfy-gray-500` (#0F2C24)
- Dropdown: `bg-pgfy-gray-400` (#1A2E27)
- Mobile Menu: `bg-pgfy-gray-500`

**Text Colors:**
- Default: `text-white` (#FFFFFF)
- Button text (secondary): `text-pgfy-gray-500`

**Accent Colors:**
- Primary: `pgfy-primary-500` (#8FE35F)
- Primary hover: `pgfy-primary-600` (#7DD44E)

### Interactive States

1. **Dropdown Hover:** Visibility toggle, icon rotation
2. **Button Hover:** Background color change
3. **Mobile Menu Toggle:** Show/hide panel
4. **Submenu Hover:** Background color change

---

## Elementor Controls Specification

### Content Tab

#### Section 1: Logo Settings
**Section ID:** `section_logo`

| Control ID | Type | Label | Default | Description |
|------------|------|-------|---------|-------------|
| `logo_type` | CHOOSE | Logo Type | 'image' | Image or text logo |
| `logo_image` | MEDIA | Logo Image | (default SVG) | Logo image upload |
| `logo_alt` | TEXT | Alt Text | 'Logo' | Image alt attribute |
| `logo_link` | URL | Logo Link | ['url' => '#'] | Logo link URL |
| `logo_text` | TEXT | Text Logo | 'Brand' | Text if logo_type is 'text' |

**Conditional Logic:**
- `logo_image` shown when `logo_type === 'image'`
- `logo_text` shown when `logo_type === 'text'`

---

#### Section 2: Menu Items
**Section ID:** `section_menu_items`

| Control ID | Type | Label | Default | Description |
|------------|------|-------|---------|-------------|
| `menu_items` | REPEATER | Menu Items | [5 default items] | Main navigation menu |

**Repeater Fields for `menu_items`:**

| Field ID | Type | Label | Default | Description |
|----------|------|-------|---------|-------------|
| `menu_text` | TEXT | Menu Text | 'Menu Item' | Display text |
| `menu_link` | URL | Link | ['url' => '#'] | Menu item URL |
| `has_dropdown` | SWITCHER | Has Dropdown | 'no' | Enable submenu |
| `submenu_items` | REPEATER | Submenu Items | [] | Dropdown items |

**Nested Repeater Fields for `submenu_items`:**

| Field ID | Type | Label | Default | Description |
|----------|------|-------|---------|-------------|
| `submenu_text` | TEXT | Text | 'Submenu Item' | Submenu display text |
| `submenu_link` | URL | Link | ['url' => '#'] | Submenu URL |

**Default Menu Items:**
```php
[
    [
        'menu_text' => 'Home',
        'menu_link' => ['url' => '#top'],
        'has_dropdown' => 'no',
    ],
    [
        'menu_text' => 'Product',
        'menu_link' => ['url' => '#top'],
        'has_dropdown' => 'yes',
        'submenu_items' => [
            ['submenu_text' => 'Overview', 'submenu_link' => ['url' => '#top']],
            ['submenu_text' => 'Features', 'submenu_link' => ['url' => '#top']],
            ['submenu_text' => 'Solutions', 'submenu_link' => ['url' => '#top']],
            ['submenu_text' => 'Integrations', 'submenu_link' => ['url' => '#top']],
        ],
    ],
    [
        'menu_text' => 'Solutions',
        'menu_link' => ['url' => '#top'],
        'has_dropdown' => 'no',
    ],
    [
        'menu_text' => 'Pricing',
        'menu_link' => ['url' => '#top'],
        'has_dropdown' => 'no',
    ],
    [
        'menu_text' => 'Blogs',
        'menu_link' => ['url' => '#top'],
        'has_dropdown' => 'no',
    ],
]
```

---

#### Section 3: Desktop CTA Buttons
**Section ID:** `section_desktop_cta`

| Control ID | Type | Label | Default | Description |
|------------|------|-------|---------|-------------|
| `show_desktop_cta` | SWITCHER | Show CTA Buttons | 'yes' | Display CTA buttons on desktop |
| `primary_btn_text` | TEXT | Primary Button Text | 'Sign In' | First button text |
| `primary_btn_link` | URL | Primary Button Link | ['url' => '#'] | First button URL |
| `primary_btn_style` | SELECT | Primary Button Style | 'outline' | outline/filled |
| `secondary_btn_text` | TEXT | Secondary Button Text | 'Get Started' | Second button text |
| `secondary_btn_link` | URL | Secondary Button Link | ['url' => '#'] | Second button URL |
| `secondary_btn_style` | SELECT | Secondary Button Style | 'filled' | outline/filled |

---

#### Section 4: Mobile Menu Settings
**Section ID:** `section_mobile_menu`

| Control ID | Type | Label | Default | Description |
|------------|------|-------|---------|-------------|
| `mobile_menu_items` | SELECT | Mobile Menu Items | 'same' | same/custom |
| `custom_mobile_items` | REPEATER | Custom Mobile Items | [] | Only if 'custom' selected |
| `show_mobile_cta` | SWITCHER | Show Mobile CTA | 'yes' | Display mobile CTA button |
| `mobile_cta_text` | TEXT | Mobile CTA Text | 'Get Started' | Mobile button text |
| `mobile_cta_link` | URL | Mobile CTA Link | ['url' => '#'] | Mobile button URL |
| `mobile_menu_icon` | MEDIA | Menu Icon | (burger icon) | Hamburger menu icon |
| `mobile_menu_close_icon` | MEDIA | Close Icon | (X icon) | Close menu icon (optional) |

**Conditional Logic:**
- `custom_mobile_items` shown when `mobile_menu_items === 'custom'`

---

#### Section 5: Navigation Behavior
**Section ID:** `section_behavior`

| Control ID | Type | Label | Default | Description |
|------------|------|-------|---------|-------------|
| `sticky_header` | SWITCHER | Sticky Navigation | 'no' | Fixed on scroll |
| `sticky_offset` | SLIDER | Sticky Offset | ['size' => 0] | Scroll distance before sticky |
| `dropdown_trigger` | SELECT | Dropdown Trigger | 'hover' | hover/click |
| `close_on_outside_click` | SWITCHER | Close on Outside Click | 'yes' | Close dropdown on outside click |
| `mobile_breakpoint` | SELECT | Mobile Breakpoint | 'lg' | sm/md/lg/xl |

**Conditional Logic:**
- `sticky_offset` shown when `sticky_header === 'yes'`

---

### Style Tab

#### Section 1: Header Style
**Section ID:** `section_header_style`

| Control ID | Type | Label | Selector | Default |
|------------|------|-------|----------|---------|
| `header_background` | COLOR | Background Color | `.pagifye-nav-header` | #0F2C24 |
| `header_padding` | DIMENSIONS | Padding | `.pagifye-nav-header` | top/bottom: 16px |
| `header_height` | SLIDER | Min Height | `.pagifye-nav-header` | 70px |
| `header_border` | BORDER | Border | `.pagifye-nav-header` | none |
| `header_box_shadow` | BOX_SHADOW | Box Shadow | `.pagifye-nav-header` | none |

---

#### Section 2: Logo Style
**Section ID:** `section_logo_style`

| Control ID | Type | Label | Selector | Default |
|------------|------|-------|----------|---------|
| `logo_width` | SLIDER | Width | `.pagifye-nav-logo img` | auto |
| `logo_max_width` | SLIDER | Max Width | `.pagifye-nav-logo img` | 200px |
| `logo_height` | SLIDER | Height | `.pagifye-nav-logo img` | auto |
| `logo_spacing` | SLIDER | Right Spacing | `.pagifye-nav-logo` | 0 |

---

#### Section 3: Menu Items Style
**Section ID:** `section_menu_style`

| Control ID | Type | Label | Selector | Default |
|------------|------|-------|----------|---------|
| `menu_typography` | TYPOGRAPHY | Typography | `.pagifye-nav-menu a` | font-medium |
| `menu_text_color` | COLOR | Text Color | `.pagifye-nav-menu a` | #FFFFFF |
| `menu_text_color_hover` | COLOR | Hover Color | `.pagifye-nav-menu a:hover` | #8FE35F |
| `menu_active_color` | COLOR | Active Color | `.pagifye-nav-menu a.active` | #8FE35F |
| `menu_items_gap` | SLIDER | Items Gap | `.pagifye-nav-menu ul` | 24px |
| `menu_padding` | DIMENSIONS | Item Padding | `.pagifye-nav-menu a` | 0 |

---

#### Section 4: Dropdown Style
**Section ID:** `section_dropdown_style`

| Control ID | Type | Label | Selector | Default |
|------------|------|-------|----------|---------|
| `dropdown_bg` | COLOR | Background | `.pagifye-dropdown-menu` | #1A2E27 |
| `dropdown_padding` | DIMENSIONS | Padding | `.pagifye-dropdown-menu` | 16px |
| `dropdown_border_radius` | SLIDER | Border Radius | `.pagifye-dropdown-menu` | 8px |
| `dropdown_box_shadow` | BOX_SHADOW | Shadow | `.pagifye-dropdown-menu` | default |
| `dropdown_item_color` | COLOR | Item Color | `.pagifye-dropdown-menu a` | #FFFFFF |
| `dropdown_item_hover_bg` | COLOR | Hover Background | `.pagifye-dropdown-menu a:hover` | #8FE35F |
| `dropdown_item_hover_color` | COLOR | Hover Color | `.pagifye-dropdown-menu a:hover` | #0F2C24 |
| `dropdown_item_spacing` | SLIDER | Item Spacing | `.pagifye-dropdown-menu li` | 8px |
| `dropdown_item_padding` | DIMENSIONS | Item Padding | `.pagifye-dropdown-menu a` | 12px |
| `dropdown_item_border_radius` | SLIDER | Item Border Radius | `.pagifye-dropdown-menu a` | 8px |

---

#### Section 5: CTA Buttons Style
**Section ID:** `section_cta_style`

| Control ID | Type | Label | Selector | Default |
|------------|------|-------|----------|---------|
| `cta_buttons_gap` | SLIDER | Buttons Gap | `.pagifye-nav-cta` | 24px |

**Primary Button Sub-Section:**

| Control ID | Type | Label | Selector | Default |
|------------|------|-------|----------|---------|
| `primary_btn_typography` | TYPOGRAPHY | Typography | `.pagifye-btn-primary` | font-bold |
| `primary_btn_text_color` | COLOR | Text Color | `.pagifye-btn-primary` | #FFFFFF |
| `primary_btn_bg` | COLOR | Background | `.pagifye-btn-primary` | transparent |
| `primary_btn_border` | BORDER | Border | `.pagifye-btn-primary` | 2px solid #8FE35F |
| `primary_btn_border_radius` | SLIDER | Border Radius | `.pagifye-btn-primary` | 9999px |
| `primary_btn_padding` | DIMENSIONS | Padding | `.pagifye-btn-primary` | 12px 32px |
| `primary_btn_hover_text_color` | COLOR | Hover Text Color | `.pagifye-btn-primary:hover` | #0F2C24 |
| `primary_btn_hover_bg` | COLOR | Hover Background | `.pagifye-btn-primary:hover` | #8FE35F |

**Secondary Button Sub-Section:**

| Control ID | Type | Label | Selector | Default |
|------------|------|-------|----------|---------|
| `secondary_btn_typography` | TYPOGRAPHY | Typography | `.pagifye-btn-secondary` | font-bold |
| `secondary_btn_text_color` | COLOR | Text Color | `.pagifye-btn-secondary` | #0F2C24 |
| `secondary_btn_bg` | COLOR | Background | `.pagifye-btn-secondary` | #8FE35F |
| `secondary_btn_border` | BORDER | Border | `.pagifye-btn-secondary` | none |
| `secondary_btn_border_radius` | SLIDER | Border Radius | `.pagifye-btn-secondary` | 9999px |
| `secondary_btn_padding` | DIMENSIONS | Padding | `.pagifye-btn-secondary` | 12px 32px |
| `secondary_btn_hover_bg` | COLOR | Hover Background | `.pagifye-btn-secondary:hover` | #7DD44E |

---

#### Section 6: Mobile Menu Style
**Section ID:** `section_mobile_style`

| Control ID | Type | Label | Selector | Default |
|------------|------|-------|----------|---------|
| `mobile_menu_bg` | COLOR | Background | `.pagifye-mobile-menu` | #0F2C24 |
| `mobile_menu_padding` | DIMENSIONS | Padding | `.pagifye-mobile-menu` | 24px 16px |
| `mobile_item_color` | COLOR | Item Color | `.pagifye-mobile-menu a` | #FFFFFF |
| `mobile_item_spacing` | SLIDER | Item Spacing | `.pagifye-mobile-menu li` | 16px |
| `mobile_item_typography` | TYPOGRAPHY | Typography | `.pagifye-mobile-menu a` | font-bold |
| `mobile_toggle_size` | SLIDER | Toggle Button Size | `.pagifye-menu-toggle` | 24px |
| `mobile_toggle_color` | COLOR | Toggle Color | `.pagifye-menu-toggle` | #FFFFFF |

---

#### Section 7: Responsive Settings
**Section ID:** `section_responsive_style`

**Tablet Overrides (max-width: 1024px):**

| Control ID | Type | Label | Default |
|------------|------|-------|---------|
| `tablet_logo_width` | SLIDER | Logo Width (Tablet) | auto |
| `tablet_header_padding` | DIMENSIONS | Header Padding (Tablet) | inherit |
| `tablet_menu_items_gap` | SLIDER | Menu Gap (Tablet) | inherit |

**Mobile Overrides (max-width: 768px):**

| Control ID | Type | Label | Default |
|------------|------|-------|---------|
| `mobile_logo_width` | SLIDER | Logo Width (Mobile) | auto |
| `mobile_header_padding` | DIMENSIONS | Header Padding (Mobile) | 12px |
| `mobile_cta_btn_width` | SELECT | Mobile CTA Width | 'full' |

---

### Advanced Tab

#### Section: Custom CSS
**Section ID:** `section_custom_css`

| Control ID | Type | Label | Description |
|------------|------|-------|-------------|
| `custom_css` | CODE | Custom CSS | Additional CSS for advanced customization |

---

## PHP Class Structure

### File Location
`/widgets/navigation/class-navigation-01.php`

### Class Definition

```php
<?php
namespace Pagifye\Widgets\Navigation;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

class Pagifye_Navigation_01 extends \Pagifye\Widgets\Base\Pagifye_Widget_Base {

    /**
     * Widget name
     */
    public function get_name() {
        return 'pagifye-navigation-01';
    }

    /**
     * Widget title
     */
    public function get_title() {
        return __('Navigation 01', 'pagifye-widgets');
    }

    /**
     * Widget icon
     */
    public function get_icon() {
        return 'eicon-nav-menu';
    }

    /**
     * Widget categories
     */
    public function get_categories() {
        return ['pagifye-components'];
    }

    /**
     * Widget keywords
     */
    public function get_keywords() {
        return ['navigation', 'nav', 'menu', 'header', 'navbar', 'pagifye'];
    }

    /**
     * Widget scripts
     */
    public function get_script_depends() {
        return ['alpine-js'];
    }

    /**
     * Widget styles
     */
    public function get_style_depends() {
        return ['pagifye-tailwind'];
    }

    /**
     * Register widget controls
     */
    protected function register_controls() {
        $this->register_logo_controls();
        $this->register_menu_items_controls();
        $this->register_desktop_cta_controls();
        $this->register_mobile_menu_controls();
        $this->register_behavior_controls();

        // Style Tab
        $this->register_header_style_controls();
        $this->register_logo_style_controls();
        $this->register_menu_style_controls();
        $this->register_dropdown_style_controls();
        $this->register_cta_style_controls();
        $this->register_mobile_style_controls();
        $this->register_responsive_controls();
    }

    /**
     * Register logo controls
     */
    protected function register_logo_controls() {
        // Implementation in Code Snippets section
    }

    /**
     * Register menu items controls
     */
    protected function register_menu_items_controls() {
        // Implementation in Code Snippets section
    }

    /**
     * Render widget output
     */
    protected function render() {
        $settings = $this->get_settings_for_display();
        $this->render_navigation($settings);
    }

    /**
     * Render navigation HTML
     */
    protected function render_navigation($settings) {
        // Implementation in Code Snippets section
    }

    /**
     * Render desktop menu
     */
    protected function render_desktop_menu($settings) {
        // Implementation in Code Snippets section
    }

    /**
     * Render mobile menu
     */
    protected function render_mobile_menu($settings) {
        // Implementation in Code Snippets section
    }

    /**
     * Render CTA buttons
     */
    protected function render_cta_buttons($settings, $context = 'desktop') {
        // Implementation in Code Snippets section
    }

    /**
     * Get menu icon SVG
     */
    protected function get_dropdown_icon() {
        return '<svg width="16" height="16" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg" class="transition-transform duration-300 group-hover:rotate-180">
            <path d="M2.5 4.5L6 8L9.5 4.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
        </svg>';
    }

    /**
     * Render editor preview template
     */
    protected function content_template() {
        // JavaScript template for Elementor editor
    }
}
```

---

## Render Method Implementation Plan

### Overall Structure

```php
protected function render() {
    $settings = $this->get_settings_for_display();

    // Wrapper with Alpine.js data
    $this->add_render_attribute('wrapper', [
        'class' => 'pagifye-widget pagifye-navigation-01',
        'x-data' => '{ isOpen: false }',
    ]);

    // Sticky behavior
    if ('yes' === $settings['sticky_header']) {
        $this->add_render_attribute('header', 'class', 'sticky top-0 z-50');
    }

    echo '<section ' . $this->get_render_attribute_string('wrapper') . '>';
    echo '<header class="pagifye-nav-header relative flex items-center justify-between py-4 font-medium max-lg:pr-4">';

    // Container
    echo '<div class="container flex items-center lg:justify-between">';

    // Logo
    $this->render_logo($settings);

    // Desktop Menu
    $this->render_desktop_menu($settings);

    // Desktop CTA Buttons
    if ('yes' === $settings['show_desktop_cta']) {
        $this->render_cta_buttons($settings, 'desktop');
    }

    echo '</div>'; // .container

    // Mobile Navigation
    $this->render_mobile_navigation($settings);

    echo '</header>';
    echo '</section>';
}
```

### Logo Rendering

```php
protected function render_logo($settings) {
    $logo_html = '';

    if ('text' === $settings['logo_type']) {
        $logo_html = '<span class="pagifye-nav-logo-text">' .
            esc_html($settings['logo_text']) .
            '</span>';
    } else {
        if (!empty($settings['logo_image']['url'])) {
            $logo_html = sprintf(
                '<img src="%s" alt="%s" class="pagifye-nav-logo-img">',
                esc_url($settings['logo_image']['url']),
                esc_attr($settings['logo_alt'])
            );
        }
    }

    // Wrap in link
    if (!empty($settings['logo_link']['url'])) {
        $this->add_render_attribute('logo_link', 'href', $settings['logo_link']['url']);

        if ($settings['logo_link']['is_external']) {
            $this->add_render_attribute('logo_link', 'target', '_blank');
        }

        if ($settings['logo_link']['nofollow']) {
            $this->add_render_attribute('logo_link', 'rel', 'nofollow');
        }

        echo '<a ' . $this->get_render_attribute_string('logo_link') . ' class="pagifye-nav-logo">';
        echo $logo_html;
        echo '</a>';
    } else {
        echo '<div class="pagifye-nav-logo">' . $logo_html . '</div>';
    }
}
```

### Desktop Menu Rendering

```php
protected function render_desktop_menu($settings) {
    if (empty($settings['menu_items'])) {
        return;
    }

    echo '<nav class="pagifye-nav-menu">';
    echo '<ul class="flex gap-6 max-lg:hidden">';

    foreach ($settings['menu_items'] as $index => $item) {
        $has_dropdown = 'yes' === $item['has_dropdown'] && !empty($item['submenu_items']);

        $item_key = 'menu_item_' . $index;
        $link_key = 'menu_link_' . $index;

        // List item classes
        $li_classes = $has_dropdown ? 'group relative' : '';

        echo '<li class="' . esc_attr($li_classes) . '">';

        // Menu link
        if (!empty($item['menu_link']['url'])) {
            $this->add_render_attribute($link_key, 'href', $item['menu_link']['url']);

            if ($item['menu_link']['is_external']) {
                $this->add_render_attribute($link_key, 'target', '_blank');
            }

            if ($item['menu_link']['nofollow']) {
                $this->add_render_attribute($link_key, 'rel', 'nofollow');
            }
        } else {
            $this->add_render_attribute($link_key, 'href', '#');
        }

        $link_classes = $has_dropdown ? 'flex items-center gap-1' : '';
        $this->add_render_attribute($link_key, 'class', $link_classes);

        echo '<a ' . $this->get_render_attribute_string($link_key) . '>';
        echo esc_html($item['menu_text']);

        // Dropdown icon
        if ($has_dropdown) {
            echo $this->get_dropdown_icon();
        }

        echo '</a>';

        // Dropdown menu
        if ($has_dropdown) {
            $this->render_dropdown_menu($item['submenu_items'], $index);
        }

        echo '</li>';
    }

    echo '</ul>';
    echo '</nav>';
}
```

### Dropdown Menu Rendering

```php
protected function render_dropdown_menu($submenu_items, $parent_index) {
    echo '<div class="pagifye-dropdown-menu invisible absolute left-0 top-full z-50 min-w-[200px] rounded-lg p-4 opacity-0 shadow-lg transition-all duration-300 group-hover:visible group-hover:opacity-100">';
    echo '<ul class="flex flex-col gap-2">';

    foreach ($submenu_items as $sub_index => $sub_item) {
        $sub_link_key = 'submenu_link_' . $parent_index . '_' . $sub_index;

        if (!empty($sub_item['submenu_link']['url'])) {
            $this->add_render_attribute($sub_link_key, 'href', $sub_item['submenu_link']['url']);

            if ($sub_item['submenu_link']['is_external']) {
                $this->add_render_attribute($sub_link_key, 'target', '_blank');
            }

            if ($sub_item['submenu_link']['nofollow']) {
                $this->add_render_attribute($sub_link_key, 'rel', 'nofollow');
            }
        } else {
            $this->add_render_attribute($sub_link_key, 'href', '#');
        }

        $this->add_render_attribute($sub_link_key, 'class', 'block rounded-lg px-3 py-2 transition-colors');

        echo '<li>';
        echo '<a ' . $this->get_render_attribute_string($sub_link_key) . '>';
        echo esc_html($sub_item['submenu_text']);
        echo '</a>';
        echo '</li>';
    }

    echo '</ul>';
    echo '</div>';
}
```

### CTA Buttons Rendering

```php
protected function render_cta_buttons($settings, $context = 'desktop') {
    $wrapper_classes = $context === 'desktop' ?
        'flex gap-6 max-lg:hidden pagifye-nav-cta' :
        'flex w-full flex-wrap gap-4 max-sm:flex-col pagifye-nav-cta-mobile';

    echo '<div class="' . esc_attr($wrapper_classes) . '">';

    if ($context === 'desktop') {
        // Primary button
        if (!empty($settings['primary_btn_text'])) {
            $this->render_button([
                'text' => $settings['primary_btn_text'],
                'link' => $settings['primary_btn_link'],
                'style' => $settings['primary_btn_style'],
                'class' => 'pagifye-btn-primary',
            ]);
        }

        // Secondary button
        if (!empty($settings['secondary_btn_text'])) {
            $this->render_button([
                'text' => $settings['secondary_btn_text'],
                'link' => $settings['secondary_btn_link'],
                'style' => $settings['secondary_btn_style'],
                'class' => 'pagifye-btn-secondary',
            ]);
        }
    } else {
        // Mobile buttons (simplified)
        if (!empty($settings['primary_btn_text'])) {
            $this->render_button([
                'text' => $settings['primary_btn_text'],
                'link' => $settings['primary_btn_link'],
                'style' => 'outline',
                'class' => 'pagifye-btn-primary-mobile',
            ]);
        }

        if (!empty($settings['secondary_btn_text'])) {
            $this->render_button([
                'text' => $settings['secondary_btn_text'],
                'link' => $settings['secondary_btn_link'],
                'style' => 'filled',
                'class' => 'pagifye-btn-secondary-mobile',
            ]);
        }
    }

    echo '</div>';
}
```

### Button Rendering Helper

```php
protected function render_button($args) {
    $defaults = [
        'text' => '',
        'link' => ['url' => '#'],
        'style' => 'filled',
        'class' => '',
    ];

    $args = wp_parse_args($args, $defaults);

    $button_key = 'button_' . md5($args['text']);

    if (!empty($args['link']['url'])) {
        $this->add_render_attribute($button_key, 'href', $args['link']['url']);

        if ($args['link']['is_external']) {
            $this->add_render_attribute($button_key, 'target', '_blank');
        }

        if ($args['link']['nofollow']) {
            $this->add_render_attribute($button_key, 'rel', 'nofollow');
        }
    }

    $base_classes = 'group flex select-none items-center justify-center gap-1 text-nowrap rounded-full text-base font-bold transition duration-300 ease-in-out max-lg:w-full sm:w-max px-8 py-3';

    $style_classes = $args['style'] === 'outline' ?
        'border border-pgfy-primary-500 text-white hover:bg-pgfy-primary-500' :
        'bg-pgfy-primary-500 text-pgfy-gray-500 hover:bg-pgfy-primary-600';

    $this->add_render_attribute($button_key, 'class', $base_classes . ' ' . $style_classes . ' ' . $args['class']);

    echo '<button ' . $this->get_render_attribute_string($button_key) . '>';
    echo '<span>' . esc_html($args['text']) . '</span>';
    echo '</button>';
}
```

### Mobile Navigation Rendering

```php
protected function render_mobile_navigation($settings) {
    echo '<div x-data="{ isOpen: false }" class="flex lg:hidden">';

    // Mobile CTA button (outside menu)
    if ('yes' === $settings['show_mobile_cta']) {
        echo '<button class="mr-4 select-none text-nowrap rounded-full px-4 py-1 text-base font-bold bg-pgfy-primary-500 text-pgfy-gray-500 transition duration-300 ease-in-out hover:bg-pgfy-primary-600">';
        echo esc_html($settings['mobile_cta_text']);
        echo '</button>';
    }

    // Mobile menu toggle
    echo '<button @click="isOpen = !isOpen" class="relative z-10 pagifye-menu-toggle">';

    if (!empty($settings['mobile_menu_icon']['url'])) {
        echo '<img src="' . esc_url($settings['mobile_menu_icon']['url']) . '" alt="Menu" class="min-h-6 min-w-6">';
    } else {
        echo '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor">
            <line x1="3" y1="6" x2="21" y2="6" stroke-width="2"/>
            <line x1="3" y1="12" x2="21" y2="12" stroke-width="2"/>
            <line x1="3" y1="18" x2="21" y2="18" stroke-width="2"/>
        </svg>';
    }

    echo '</button>';

    // Mobile menu panel
    echo '<div x-show="isOpen" style="display: none;">';
    $this->render_mobile_menu_panel($settings);
    echo '</div>';

    echo '</div>'; // x-data wrapper
}
```

### Mobile Menu Panel Rendering

```php
protected function render_mobile_menu_panel($settings) {
    echo '<div class="pagifye-mobile-menu absolute inset-x-0 top-[70px] z-20 flex h-[calc(100vh-72px)] w-full flex-col justify-between overflow-y-auto px-4 pb-4">';

    // Menu items
    $menu_items = 'custom' === $settings['mobile_menu_items'] && !empty($settings['custom_mobile_items']) ?
        $settings['custom_mobile_items'] :
        $settings['menu_items'];

    echo '<ul class="space-y-4 pt-6">';

    foreach ($menu_items as $index => $item) {
        $link_key = 'mobile_menu_link_' . $index;

        if (!empty($item['menu_link']['url'])) {
            $this->add_render_attribute($link_key, 'href', $item['menu_link']['url']);

            if ($item['menu_link']['is_external']) {
                $this->add_render_attribute($link_key, 'target', '_blank');
            }

            if ($item['menu_link']['nofollow']) {
                $this->add_render_attribute($link_key, 'rel', 'nofollow');
            }
        } else {
            $this->add_render_attribute($link_key, 'href', '#');
        }

        $this->add_render_attribute($link_key, 'class', 'block font-bold transition-colors');

        echo '<li>';
        echo '<a ' . $this->get_render_attribute_string($link_key) . '>';
        echo esc_html($item['menu_text']);
        echo '</a>';
        echo '</li>';
    }

    echo '</ul>';

    // Mobile CTA buttons
    $this->render_cta_buttons($settings, 'mobile');

    echo '</div>';
}
```

---

## Alpine.js Integration

### State Management

**Mobile Menu Toggle:**
```javascript
x-data="{ isOpen: false }"
```

**Toggle Button:**
```html
<button @click="isOpen = !isOpen">
```

**Menu Panel:**
```html
<div x-show="isOpen" style="display: none;">
```

### Advanced Features (Optional Enhancements)

**1. Click Outside to Close:**
```javascript
x-data="{
    isOpen: false,
    close() { this.isOpen = false }
}"
@click.away="close()"
```

**2. Body Scroll Lock:**
```javascript
x-data="{
    isOpen: false,
    toggle() {
        this.isOpen = !this.isOpen;
        document.body.style.overflow = this.isOpen ? 'hidden' : '';
    }
}"
```

**3. Desktop Dropdown Click Trigger (Alternative):**
```html
<li x-data="{ open: false }" @click.away="open = false">
    <button @click="open = !open">Product</button>
    <div x-show="open" x-transition>
        <!-- Dropdown items -->
    </div>
</li>
```

**4. Smooth Transitions:**
```html
<div
    x-show="isOpen"
    x-transition:enter="transition ease-out duration-300"
    x-transition:enter-start="opacity-0 transform translate-y-4"
    x-transition:enter-end="opacity-100 transform translate-y-0"
    x-transition:leave="transition ease-in duration-200"
    x-transition:leave-start="opacity-100 transform translate-y-0"
    x-transition:leave-end="opacity-0 transform translate-y-4"
>
```

### JavaScript Enqueue

**File:** `/assets/js/navigation-frontend.js`

```javascript
document.addEventListener('alpine:init', () => {
    Alpine.data('navigation', () => ({
        isOpen: false,

        init() {
            // Close on escape key
            this.$watch('isOpen', value => {
                if (value) {
                    document.body.style.overflow = 'hidden';
                } else {
                    document.body.style.overflow = '';
                }
            });
        },

        toggle() {
            this.isOpen = !this.isOpen;
        },

        close() {
            this.isOpen = false;
        }
    }));
});
```

---

## Styling Controls

### CSS Selectors Reference

```css
/* Main containers */
.pagifye-navigation-01 { /* Widget wrapper */ }
.pagifye-nav-header { /* Header element */ }

/* Logo */
.pagifye-nav-logo { /* Logo container */ }
.pagifye-nav-logo img { /* Logo image */ }
.pagifye-nav-logo-text { /* Text logo */ }

/* Desktop menu */
.pagifye-nav-menu { /* Nav container */ }
.pagifye-nav-menu ul { /* Menu list */ }
.pagifye-nav-menu li { /* Menu item */ }
.pagifye-nav-menu a { /* Menu link */ }
.pagifye-nav-menu a:hover { /* Menu link hover */ }
.pagifye-nav-menu a.active { /* Active menu item */ }

/* Dropdown */
.pagifye-dropdown-menu { /* Dropdown container */ }
.pagifye-dropdown-menu ul { /* Dropdown list */ }
.pagifye-dropdown-menu li { /* Dropdown item */ }
.pagifye-dropdown-menu a { /* Dropdown link */ }
.pagifye-dropdown-menu a:hover { /* Dropdown link hover */ }

/* CTA Buttons */
.pagifye-nav-cta { /* Desktop CTA container */ }
.pagifye-btn-primary { /* Primary button */ }
.pagifye-btn-primary:hover { /* Primary button hover */ }
.pagifye-btn-secondary { /* Secondary button */ }
.pagifye-btn-secondary:hover { /* Secondary button hover */ }

/* Mobile */
.pagifye-mobile-menu { /* Mobile menu panel */ }
.pagifye-menu-toggle { /* Hamburger button */ }
.pagifye-nav-cta-mobile { /* Mobile CTA container */ }
.pagifye-btn-primary-mobile { /* Mobile primary button */ }
.pagifye-btn-secondary-mobile { /* Mobile secondary button */ }
```

### Dynamic CSS Generation

**Method:** `get_inline_style()`

```php
protected function get_inline_style($settings) {
    $css = '';

    // Header background
    if (!empty($settings['header_background'])) {
        $css .= '.pagifye-nav-header { background-color: ' . $settings['header_background'] . '; }';
    }

    // Menu text color
    if (!empty($settings['menu_text_color'])) {
        $css .= '.pagifye-nav-menu a { color: ' . $settings['menu_text_color'] . '; }';
    }

    // More dynamic styles...

    return $css;
}
```

---

## Responsive Behavior

### Breakpoint Strategy

**Tailwind Default Breakpoints:**
- `sm`: 640px
- `md`: 768px
- `lg`: 1024px (default mobile breakpoint)
- `xl`: 1280px

**Navigation Breakpoints:**
- **Desktop:** `lg:` and above (>= 1024px)
  - Show: Desktop menu, desktop CTA buttons
  - Hide: Mobile toggle, mobile menu

- **Mobile/Tablet:** `max-lg:` (< 1024px)
  - Show: Mobile toggle, mobile menu
  - Hide: Desktop menu, desktop CTA buttons

### Responsive Classes

**Desktop Only:**
```html
<nav class="max-lg:hidden">
  <!-- Desktop menu -->
</nav>

<div class="flex gap-6 max-lg:hidden">
  <!-- Desktop CTA buttons -->
</div>
```

**Mobile Only:**
```html
<div class="flex lg:hidden">
  <!-- Mobile toggle and menu -->
</div>
```

**Responsive Utilities:**
```html
<!-- Full width on mobile, auto on desktop -->
<button class="max-lg:w-full sm:w-max">

<!-- Column on small mobile, row on larger -->
<div class="flex gap-4 max-sm:flex-col">

<!-- Different padding on mobile -->
<header class="py-4 max-lg:pr-4">
```

### Elementor Responsive Controls

**Logo Width:**
- Desktop: 200px (default)
- Tablet: 150px (adjustable)
- Mobile: 120px (adjustable)

**Header Padding:**
- Desktop: 16px top/bottom
- Tablet: 12px top/bottom
- Mobile: 8px top/bottom

**Menu Gap:**
- Desktop: 24px (gap-6)
- Tablet: 16px (gap-4)
- Mobile: N/A (vertical list)

---

## Implementation Steps

### Step 1: Setup Widget File (30 minutes)

1. Create file: `/widgets/navigation/class-navigation-01.php`
2. Define namespace: `Pagifye\Widgets\Navigation`
3. Extend base class: `Pagifye_Widget_Base`
4. Implement required methods:
   - `get_name()`
   - `get_title()`
   - `get_icon()`
   - `get_categories()`
   - `get_keywords()`
5. Register dependencies:
   - `get_script_depends()` - Alpine.js
   - `get_style_depends()` - Tailwind CSS

**Verification:**
- Widget appears in Elementor panel
- No PHP errors
- Icon displays correctly

---

### Step 2: Register Logo Controls (45 minutes)

1. Create `register_logo_controls()` method
2. Add Content Tab section: "Logo Settings"
3. Add controls:
   - Logo type (image/text)
   - Logo image upload
   - Logo alt text
   - Logo link URL
   - Text logo (conditional)
4. Implement `render_logo()` method
5. Test in Elementor editor

**Verification:**
- Logo image uploads successfully
- Logo link works
- Text logo displays when selected
- Preview updates in real-time

---

### Step 3: Register Menu Items Controls (2 hours)

1. Create `register_menu_items_controls()` method
2. Add Content Tab section: "Menu Items"
3. Add repeater control:
   - Menu text field
   - Menu link URL
   - Has dropdown switcher
   - Nested submenu repeater (conditional)
4. Set default menu items (5 items)
5. Set default submenu items for "Product" menu
6. Implement `render_desktop_menu()` method
7. Implement `render_dropdown_menu()` method
8. Add dropdown icon helper

**Verification:**
- Can add/remove menu items
- Can add/remove submenu items
- Dropdown shows/hides correctly
- Links work properly
- Icon rotates on hover

---

### Step 4: Register CTA Button Controls (1.5 hours)

1. Create `register_desktop_cta_controls()` method
2. Add Content Tab section: "Desktop CTA Buttons"
3. Add controls:
   - Show/hide toggle
   - Primary button text
   - Primary button link
   - Primary button style
   - Secondary button text
   - Secondary button link
   - Secondary button style
4. Implement `render_cta_buttons()` method
5. Implement `render_button()` helper method

**Verification:**
- Buttons display correctly
- Button styles apply properly
- Links work with external/nofollow options
- Buttons hide on toggle off

---

### Step 5: Register Mobile Menu Controls (1.5 hours)

1. Create `register_mobile_menu_controls()` method
2. Add Content Tab section: "Mobile Menu"
3. Add controls:
   - Mobile menu items (same/custom)
   - Custom mobile items repeater
   - Show mobile CTA toggle
   - Mobile CTA text
   - Mobile CTA link
   - Mobile menu icon upload
4. Implement `render_mobile_navigation()` method
5. Implement `render_mobile_menu_panel()` method

**Verification:**
- Mobile menu toggles open/close
- Menu items display correctly
- Mobile CTA works
- Custom menu items option works
- Alpine.js state management functions

---

### Step 6: Register Behavior Controls (30 minutes)

1. Create `register_behavior_controls()` method
2. Add Content Tab section: "Navigation Behavior"
3. Add controls:
   - Sticky header toggle
   - Sticky offset slider
   - Dropdown trigger (hover/click)
   - Close on outside click
   - Mobile breakpoint selector
4. Implement sticky behavior in `render()` method

**Verification:**
- Sticky header works on scroll
- Offset applies correctly
- Dropdown trigger option works
- Breakpoint changes affect display

---

### Step 7: Register Style Controls - Header & Logo (1 hour)

1. Create `register_header_style_controls()` method
2. Add Style Tab section: "Header Style"
3. Add controls:
   - Background color
   - Padding dimensions
   - Min height slider
   - Border
   - Box shadow
4. Create `register_logo_style_controls()` method
5. Add Style Tab section: "Logo Style"
6. Add controls:
   - Logo width
   - Logo max width
   - Logo height
   - Logo spacing

**Verification:**
- Header background changes
- Padding adjusts correctly
- Logo size controls work
- Live preview updates

---

### Step 8: Register Style Controls - Menu & Dropdown (1.5 hours)

1. Create `register_menu_style_controls()` method
2. Add Style Tab section: "Menu Items Style"
3. Add controls:
   - Typography
   - Text color
   - Hover color
   - Active color
   - Items gap
   - Item padding
4. Create `register_dropdown_style_controls()` method
5. Add Style Tab section: "Dropdown Style"
6. Add controls:
   - Background color
   - Padding
   - Border radius
   - Box shadow
   - Item colors (normal/hover)
   - Item spacing
   - Item padding
   - Item border radius

**Verification:**
- Menu typography changes
- Colors apply correctly
- Dropdown styling works
- Hover states function properly

---

### Step 9: Register Style Controls - CTA Buttons (1.5 hours)

1. Create `register_cta_style_controls()` method
2. Add Style Tab section: "CTA Buttons Style"
3. Add button gap control
4. Add Primary Button sub-section:
   - Typography
   - Text color
   - Background color
   - Border
   - Border radius
   - Padding
   - Hover colors
5. Add Secondary Button sub-section:
   - Same controls as primary
6. Update `render_button()` to use custom styles

**Verification:**
- Button typography changes
- Button colors update
- Border and radius apply
- Hover states work
- Padding adjusts correctly

---

### Step 10: Register Style Controls - Mobile (1 hour)

1. Create `register_mobile_style_controls()` method
2. Add Style Tab section: "Mobile Menu Style"
3. Add controls:
   - Background color
   - Padding
   - Item color
   - Item spacing
   - Item typography
   - Toggle button size
   - Toggle button color

**Verification:**
- Mobile menu background changes
- Item styling applies
- Toggle button size/color work
- Typography updates correctly

---

### Step 11: Register Responsive Controls (1 hour)

1. Create `register_responsive_controls()` method
2. Add Style Tab section: "Responsive Settings"
3. Add Tablet sub-section:
   - Logo width override
   - Header padding override
   - Menu gap override
4. Add Mobile sub-section:
   - Logo width override
   - Header padding override
   - CTA button width

**Verification:**
- Tablet overrides apply at correct breakpoint
- Mobile overrides apply at correct breakpoint
- Elementor responsive preview modes work

---

### Step 12: Implement Inline Styles (45 minutes)

1. Create `get_inline_style()` method
2. Generate dynamic CSS from settings
3. Output inline styles in `render()` method
4. Handle all style controls

**Verification:**
- Dynamic styles output correctly
- No CSS conflicts
- Styles apply in correct specificity order

---

### Step 13: Test Alpine.js Integration (1 hour)

1. Verify Alpine.js is enqueued
2. Test mobile menu toggle
3. Test dropdown hover states
4. Test click outside to close (if implemented)
5. Test body scroll lock (if implemented)
6. Test keyboard accessibility

**Verification:**
- Mobile menu opens/closes smoothly
- Dropdowns show/hide correctly
- No JavaScript console errors
- Transitions are smooth
- Keyboard navigation works

---

### Step 14: Cross-Browser Testing (1.5 hours)

Test in:
- Chrome (latest)
- Firefox (latest)
- Safari (latest)
- Edge (latest)
- Mobile Safari (iOS)
- Chrome Mobile (Android)

**Test Cases:**
- Menu items display correctly
- Dropdowns work in all browsers
- Mobile menu functions properly
- Buttons render consistently
- Colors display correctly
- Fonts load properly

---

### Step 15: Responsive Testing (1 hour)

Test at breakpoints:
- 1920px (Desktop)
- 1440px (Laptop)
- 1024px (Tablet landscape)
- 768px (Tablet portrait)
- 425px (Mobile large)
- 375px (Mobile medium)
- 320px (Mobile small)

**Verification:**
- Layout shifts correctly
- No horizontal scroll
- Touch targets adequate (mobile)
- Text remains readable
- Buttons remain accessible

---

### Step 16: Accessibility Audit (1.5 hours)

1. **Semantic HTML:**
   - Proper use of `<header>`, `<nav>`, `<ul>`, `<li>`
   - Heading hierarchy maintained

2. **ARIA Labels:**
   - Add `aria-label` to menu toggle
   - Add `aria-expanded` to dropdowns
   - Add `aria-current` to active menu items

3. **Keyboard Navigation:**
   - Tab through all links
   - Enter/Space activates buttons
   - Escape closes mobile menu
   - Arrow keys navigate dropdowns

4. **Color Contrast:**
   - Text: White (#FFFFFF) on Dark Green (#0F2C24) = Pass
   - Button: Dark Green (#0F2C24) on Lime (#8FE35F) = Pass
   - Check all hover states

5. **Screen Reader Testing:**
   - Test with NVDA (Windows)
   - Test with VoiceOver (Mac/iOS)
   - Verify announcements make sense

**Verification:**
- WCAG 2.1 Level AA compliance
- Keyboard navigation complete
- Screen reader compatible
- Color contrast ratios pass

---

### Step 17: Performance Optimization (1 hour)

1. **CSS Optimization:**
   - Remove unused Tailwind classes
   - Minify CSS output
   - Combine selectors where possible

2. **JavaScript Optimization:**
   - Ensure Alpine.js loads conditionally
   - Defer non-critical scripts
   - Minimize inline JavaScript

3. **Image Optimization:**
   - Use SVG for icons
   - Optimize default logo
   - Lazy load menu images (if any)

4. **Render Optimization:**
   - Cache settings locally
   - Minimize database queries
   - Optimize repeater loops

**Verification:**
- PageSpeed Insights score > 90
- No render-blocking resources
- Fast initial paint
- Smooth interactions

---

### Step 18: Documentation & Code Comments (1 hour)

1. Add PHPDoc comments to all methods
2. Inline comments for complex logic
3. Document filter/action hooks
4. Create usage examples
5. Document customization options

**Example PHPDoc:**
```php
/**
 * Render the navigation logo
 *
 * Outputs the logo image or text based on settings. Wraps in a link
 * if logo_link is set. Handles responsive sizing and accessibility.
 *
 * @since 1.0.0
 * @access protected
 *
 * @param array $settings Widget settings array
 * @return void Outputs HTML directly
 */
protected function render_logo($settings) {
    // Implementation
}
```

---

### Step 19: Final Integration Testing (2 hours)

1. Test with other Elementor widgets
2. Test with different themes
3. Test with plugins:
   - WooCommerce
   - WPML/Polylang (i18n)
   - Cache plugins
   - Security plugins
4. Test on fresh WordPress install
5. Test updates to settings
6. Test widget duplication
7. Test import/export

**Verification:**
- No conflicts with other widgets
- Works with popular themes
- Compatible with major plugins
- Settings persist correctly
- Widget duplicates properly

---

### Step 20: Final QA Checklist (1 hour)

Go through comprehensive checklist:

- [ ] All controls functional
- [ ] Live preview works
- [ ] Responsive at all breakpoints
- [ ] Cross-browser compatible
- [ ] Accessible (WCAG AA)
- [ ] Performance optimized
- [ ] No PHP warnings/errors
- [ ] No JavaScript console errors
- [ ] Documentation complete
- [ ] Code follows WordPress standards
- [ ] Sanitization/escaping correct
- [ ] Alpine.js working properly
- [ ] Sticky navigation works
- [ ] Mobile menu toggles correctly
- [ ] Dropdowns function properly
- [ ] Buttons styled correctly
- [ ] Colors apply as expected
- [ ] Typography controls work
- [ ] Logo displays/links correctly
- [ ] All URLs work properly
- [ ] External links open correctly

---

## Testing Checklist

### Functionality Testing

#### Logo
- [ ] Logo image uploads successfully
- [ ] Logo alt text saves and displays
- [ ] Logo link URL works
- [ ] Logo link opens in new tab (if set)
- [ ] Logo link has nofollow (if set)
- [ ] Text logo displays when selected
- [ ] Logo switches between image/text

#### Desktop Menu
- [ ] Menu items display horizontally
- [ ] Menu items link correctly
- [ ] Dropdown toggle works on hover
- [ ] Dropdown items display correctly
- [ ] Dropdown icon rotates on hover
- [ ] Dropdown closes when mouse leaves
- [ ] Multiple dropdowns work independently
- [ ] Simple menu items (no dropdown) work
- [ ] Menu items hide below lg breakpoint

#### Mobile Menu
- [ ] Hamburger icon displays on mobile
- [ ] Mobile menu toggles open/close
- [ ] Mobile menu items display vertically
- [ ] Mobile menu links work
- [ ] Mobile CTA button displays
- [ ] Mobile menu closes on link click (optional)
- [ ] Body scroll locks when menu open (optional)
- [ ] Menu overlay covers content

#### CTA Buttons
- [ ] Desktop CTA buttons display
- [ ] Primary button styles correctly (outline)
- [ ] Secondary button styles correctly (filled)
- [ ] Button links work
- [ ] Button hover states function
- [ ] Buttons hide on mobile when set
- [ ] Mobile CTA button works

#### Behavior
- [ ] Sticky header activates on scroll
- [ ] Sticky offset applies correctly
- [ ] Dropdown trigger option (hover/click) works
- [ ] Mobile breakpoint setting changes layout

### Style Controls Testing

#### Header
- [ ] Background color changes
- [ ] Padding adjusts (all sides)
- [ ] Min height applies
- [ ] Border displays correctly
- [ ] Box shadow renders

#### Logo
- [ ] Width control works
- [ ] Max width applies
- [ ] Height control functions
- [ ] Right spacing adjusts

#### Menu Items
- [ ] Typography changes
- [ ] Text color updates
- [ ] Hover color works
- [ ] Active color applies
- [ ] Items gap adjusts
- [ ] Item padding changes

#### Dropdown
- [ ] Background color changes
- [ ] Padding adjusts
- [ ] Border radius applies
- [ ] Box shadow displays
- [ ] Item color changes
- [ ] Hover background works
- [ ] Hover color changes
- [ ] Item spacing adjusts
- [ ] Item padding changes
- [ ] Item border radius applies

#### CTA Buttons
- [ ] Button gap adjusts
- [ ] Primary typography changes
- [ ] Primary colors update
- [ ] Primary border applies
- [ ] Primary border radius works
- [ ] Primary padding changes
- [ ] Primary hover states work
- [ ] Secondary typography changes
- [ ] Secondary colors update
- [ ] Secondary styles apply

#### Mobile Menu
- [ ] Background color changes
- [ ] Padding adjusts
- [ ] Item color changes
- [ ] Item spacing adjusts
- [ ] Item typography updates
- [ ] Toggle button size changes
- [ ] Toggle button color updates

### Responsive Testing

#### Desktop (>= 1024px)
- [ ] Desktop menu displays
- [ ] Mobile menu hidden
- [ ] Desktop CTA buttons show
- [ ] Dropdown works properly
- [ ] Layout is horizontal

#### Tablet (768px - 1023px)
- [ ] Mobile menu displays
- [ ] Desktop menu hidden
- [ ] Mobile toggle shows
- [ ] Tablet overrides apply
- [ ] Layout adjusts properly

#### Mobile (< 768px)
- [ ] Mobile menu displays
- [ ] Mobile CTA button shows
- [ ] Toggle button accessible
- [ ] Menu items vertical
- [ ] Full-width buttons
- [ ] Mobile overrides apply
- [ ] Touch targets adequate (44px min)

### Browser Testing

#### Chrome
- [ ] Desktop view correct
- [ ] Mobile view correct
- [ ] Dropdowns work
- [ ] Alpine.js functions
- [ ] Styles apply correctly

#### Firefox
- [ ] Desktop view correct
- [ ] Mobile view correct
- [ ] Dropdowns work
- [ ] Alpine.js functions
- [ ] Styles apply correctly

#### Safari (Desktop)
- [ ] Desktop view correct
- [ ] Dropdowns work
- [ ] Alpine.js functions
- [ ] Styles apply correctly

#### Safari (iOS)
- [ ] Mobile menu works
- [ ] Touch events function
- [ ] Styles render correctly
- [ ] No layout issues

#### Edge
- [ ] Desktop view correct
- [ ] Mobile view correct
- [ ] Dropdowns work
- [ ] Styles apply correctly

### Accessibility Testing

#### Keyboard Navigation
- [ ] Tab moves through menu items
- [ ] Tab moves through dropdown items
- [ ] Enter activates links
- [ ] Enter/Space toggles mobile menu
- [ ] Escape closes mobile menu
- [ ] Arrow keys navigate dropdowns (optional)
- [ ] Focus visible on all interactive elements

#### Screen Reader
- [ ] Logo link announced correctly
- [ ] Menu items announced
- [ ] Dropdown state announced
- [ ] CTA buttons announced
- [ ] Mobile toggle announced
- [ ] Current page indicated (aria-current)

#### ARIA
- [ ] aria-label on menu toggle
- [ ] aria-expanded on dropdowns
- [ ] aria-current on active menu
- [ ] role="navigation" on nav element
- [ ] Semantic HTML structure

#### Color Contrast
- [ ] Text on background passes WCAG AA (4.5:1)
- [ ] Button text passes WCAG AA
- [ ] Dropdown text passes WCAG AA
- [ ] Focus indicators visible

### Performance Testing

- [ ] Page load < 3 seconds
- [ ] No render-blocking CSS
- [ ] JavaScript loads asynchronously
- [ ] Alpine.js initializes quickly
- [ ] No layout shift (CLS)
- [ ] Smooth animations (60fps)
- [ ] No memory leaks
- [ ] Images optimized

### Integration Testing

- [ ] Works with default WordPress theme
- [ ] Works with popular themes (Astra, GeneratePress)
- [ ] Compatible with Elementor Pro
- [ ] No conflicts with other widgets
- [ ] Works with WooCommerce
- [ ] Works with cache plugins
- [ ] Works with i18n plugins (WPML)
- [ ] Settings save correctly
- [ ] Settings load correctly
- [ ] Widget duplicates properly
- [ ] Import/export works

### Edge Cases

- [ ] No menu items (graceful degradation)
- [ ] Single menu item
- [ ] Many menu items (20+)
- [ ] Very long menu text
- [ ] Empty dropdown
- [ ] Dropdown with many items (20+)
- [ ] No logo set
- [ ] No CTA buttons
- [ ] All controls at default
- [ ] All controls customized
- [ ] Special characters in text
- [ ] RTL languages

---

## Code Snippets

### 1. Register Logo Controls

```php
/**
 * Register logo controls
 *
 * @since 1.0.0
 * @access protected
 */
protected function register_logo_controls() {
    $this->start_controls_section(
        'section_logo',
        [
            'label' => __('Logo', 'pagifye-widgets'),
            'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
        ]
    );

    // Logo Type
    $this->add_control(
        'logo_type',
        [
            'label' => __('Logo Type', 'pagifye-widgets'),
            'type' => \Elementor\Controls_Manager::CHOOSE,
            'options' => [
                'image' => [
                    'title' => __('Image', 'pagifye-widgets'),
                    'icon' => 'eicon-image',
                ],
                'text' => [
                    'title' => __('Text', 'pagifye-widgets'),
                    'icon' => 'eicon-text',
                ],
            ],
            'default' => 'image',
            'toggle' => false,
        ]
    );

    // Logo Image
    $this->add_control(
        'logo_image',
        [
            'label' => __('Logo Image', 'pagifye-widgets'),
            'type' => \Elementor\Controls_Manager::MEDIA,
            'default' => [
                'url' => 'https://static.pagifye.com/root/images/navbar/root-ui-white-logo.svg',
            ],
            'condition' => [
                'logo_type' => 'image',
            ],
        ]
    );

    // Logo Alt Text
    $this->add_control(
        'logo_alt',
        [
            'label' => __('Alt Text', 'pagifye-widgets'),
            'type' => \Elementor\Controls_Manager::TEXT,
            'default' => __('Logo', 'pagifye-widgets'),
            'placeholder' => __('Enter alt text', 'pagifye-widgets'),
            'condition' => [
                'logo_type' => 'image',
            ],
        ]
    );

    // Logo Text
    $this->add_control(
        'logo_text',
        [
            'label' => __('Text Logo', 'pagifye-widgets'),
            'type' => \Elementor\Controls_Manager::TEXT,
            'default' => __('Brand Name', 'pagifye-widgets'),
            'placeholder' => __('Enter your brand name', 'pagifye-widgets'),
            'condition' => [
                'logo_type' => 'text',
            ],
        ]
    );

    // Logo Link
    $this->add_control(
        'logo_link',
        [
            'label' => __('Logo Link', 'pagifye-widgets'),
            'type' => \Elementor\Controls_Manager::URL,
            'placeholder' => __('https://your-site.com', 'pagifye-widgets'),
            'default' => [
                'url' => '#',
                'is_external' => false,
                'nofollow' => false,
            ],
        ]
    );

    $this->end_controls_section();
}
```

---

### 2. Register Menu Items Controls (with Nested Repeater)

```php
/**
 * Register menu items controls
 *
 * @since 1.0.0
 * @access protected
 */
protected function register_menu_items_controls() {
    $this->start_controls_section(
        'section_menu_items',
        [
            'label' => __('Menu Items', 'pagifye-widgets'),
            'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
        ]
    );

    $repeater = new \Elementor\Repeater();

    // Menu Text
    $repeater->add_control(
        'menu_text',
        [
            'label' => __('Menu Text', 'pagifye-widgets'),
            'type' => \Elementor\Controls_Manager::TEXT,
            'default' => __('Menu Item', 'pagifye-widgets'),
            'placeholder' => __('Enter menu text', 'pagifye-widgets'),
            'label_block' => true,
        ]
    );

    // Menu Link
    $repeater->add_control(
        'menu_link',
        [
            'label' => __('Link', 'pagifye-widgets'),
            'type' => \Elementor\Controls_Manager::URL,
            'placeholder' => __('https://your-link.com', 'pagifye-widgets'),
            'default' => [
                'url' => '#',
            ],
        ]
    );

    // Has Dropdown
    $repeater->add_control(
        'has_dropdown',
        [
            'label' => __('Has Dropdown', 'pagifye-widgets'),
            'type' => \Elementor\Controls_Manager::SWITCHER,
            'label_on' => __('Yes', 'pagifye-widgets'),
            'label_off' => __('No', 'pagifye-widgets'),
            'return_value' => 'yes',
            'default' => 'no',
        ]
    );

    // Submenu Items (Nested Repeater)
    $submenu_repeater = new \Elementor\Repeater();

    $submenu_repeater->add_control(
        'submenu_text',
        [
            'label' => __('Submenu Text', 'pagifye-widgets'),
            'type' => \Elementor\Controls_Manager::TEXT,
            'default' => __('Submenu Item', 'pagifye-widgets'),
            'label_block' => true,
        ]
    );

    $submenu_repeater->add_control(
        'submenu_link',
        [
            'label' => __('Link', 'pagifye-widgets'),
            'type' => \Elementor\Controls_Manager::URL,
            'default' => [
                'url' => '#',
            ],
        ]
    );

    $repeater->add_control(
        'submenu_items',
        [
            'label' => __('Submenu Items', 'pagifye-widgets'),
            'type' => \Elementor\Controls_Manager::REPEATER,
            'fields' => $submenu_repeater->get_controls(),
            'default' => [],
            'title_field' => '{{{ submenu_text }}}',
            'condition' => [
                'has_dropdown' => 'yes',
            ],
        ]
    );

    // Main Menu Items Repeater
    $this->add_control(
        'menu_items',
        [
            'label' => __('Menu Items', 'pagifye-widgets'),
            'type' => \Elementor\Controls_Manager::REPEATER,
            'fields' => $repeater->get_controls(),
            'default' => [
                [
                    'menu_text' => __('Home', 'pagifye-widgets'),
                    'menu_link' => ['url' => '#top'],
                    'has_dropdown' => 'no',
                ],
                [
                    'menu_text' => __('Product', 'pagifye-widgets'),
                    'menu_link' => ['url' => '#top'],
                    'has_dropdown' => 'yes',
                    'submenu_items' => [
                        [
                            'submenu_text' => __('Overview', 'pagifye-widgets'),
                            'submenu_link' => ['url' => '#top'],
                        ],
                        [
                            'submenu_text' => __('Features', 'pagifye-widgets'),
                            'submenu_link' => ['url' => '#top'],
                        ],
                        [
                            'submenu_text' => __('Solutions', 'pagifye-widgets'),
                            'submenu_link' => ['url' => '#top'],
                        ],
                        [
                            'submenu_text' => __('Integrations', 'pagifye-widgets'),
                            'submenu_link' => ['url' => '#top'],
                        ],
                    ],
                ],
                [
                    'menu_text' => __('Solutions', 'pagifye-widgets'),
                    'menu_link' => ['url' => '#top'],
                    'has_dropdown' => 'no',
                ],
                [
                    'menu_text' => __('Pricing', 'pagifye-widgets'),
                    'menu_link' => ['url' => '#top'],
                    'has_dropdown' => 'no',
                ],
                [
                    'menu_text' => __('Blogs', 'pagifye-widgets'),
                    'menu_link' => ['url' => '#top'],
                    'has_dropdown' => 'no',
                ],
            ],
            'title_field' => '{{{ menu_text }}}',
        ]
    );

    $this->end_controls_section();
}
```

---

### 3. Register Desktop CTA Controls

```php
/**
 * Register desktop CTA button controls
 *
 * @since 1.0.0
 * @access protected
 */
protected function register_desktop_cta_controls() {
    $this->start_controls_section(
        'section_desktop_cta',
        [
            'label' => __('Desktop CTA Buttons', 'pagifye-widgets'),
            'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
        ]
    );

    // Show Desktop CTA
    $this->add_control(
        'show_desktop_cta',
        [
            'label' => __('Show CTA Buttons', 'pagifye-widgets'),
            'type' => \Elementor\Controls_Manager::SWITCHER,
            'label_on' => __('Yes', 'pagifye-widgets'),
            'label_off' => __('No', 'pagifye-widgets'),
            'return_value' => 'yes',
            'default' => 'yes',
        ]
    );

    // Primary Button Heading
    $this->add_control(
        'primary_btn_heading',
        [
            'label' => __('Primary Button', 'pagifye-widgets'),
            'type' => \Elementor\Controls_Manager::HEADING,
            'separator' => 'before',
            'condition' => [
                'show_desktop_cta' => 'yes',
            ],
        ]
    );

    // Primary Button Text
    $this->add_control(
        'primary_btn_text',
        [
            'label' => __('Text', 'pagifye-widgets'),
            'type' => \Elementor\Controls_Manager::TEXT,
            'default' => __('Sign In', 'pagifye-widgets'),
            'placeholder' => __('Enter button text', 'pagifye-widgets'),
            'condition' => [
                'show_desktop_cta' => 'yes',
            ],
        ]
    );

    // Primary Button Link
    $this->add_control(
        'primary_btn_link',
        [
            'label' => __('Link', 'pagifye-widgets'),
            'type' => \Elementor\Controls_Manager::URL,
            'placeholder' => __('https://your-link.com', 'pagifye-widgets'),
            'default' => [
                'url' => '#',
            ],
            'condition' => [
                'show_desktop_cta' => 'yes',
            ],
        ]
    );

    // Primary Button Style
    $this->add_control(
        'primary_btn_style',
        [
            'label' => __('Style', 'pagifye-widgets'),
            'type' => \Elementor\Controls_Manager::SELECT,
            'default' => 'outline',
            'options' => [
                'outline' => __('Outline', 'pagifye-widgets'),
                'filled' => __('Filled', 'pagifye-widgets'),
            ],
            'condition' => [
                'show_desktop_cta' => 'yes',
            ],
        ]
    );

    // Secondary Button Heading
    $this->add_control(
        'secondary_btn_heading',
        [
            'label' => __('Secondary Button', 'pagifye-widgets'),
            'type' => \Elementor\Controls_Manager::HEADING,
            'separator' => 'before',
            'condition' => [
                'show_desktop_cta' => 'yes',
            ],
        ]
    );

    // Secondary Button Text
    $this->add_control(
        'secondary_btn_text',
        [
            'label' => __('Text', 'pagifye-widgets'),
            'type' => \Elementor\Controls_Manager::TEXT,
            'default' => __('Get Started', 'pagifye-widgets'),
            'placeholder' => __('Enter button text', 'pagifye-widgets'),
            'condition' => [
                'show_desktop_cta' => 'yes',
            ],
        ]
    );

    // Secondary Button Link
    $this->add_control(
        'secondary_btn_link',
        [
            'label' => __('Link', 'pagifye-widgets'),
            'type' => \Elementor\Controls_Manager::URL,
            'placeholder' => __('https://your-link.com', 'pagifye-widgets'),
            'default' => [
                'url' => '#',
            ],
            'condition' => [
                'show_desktop_cta' => 'yes',
            ],
        ]
    );

    // Secondary Button Style
    $this->add_control(
        'secondary_btn_style',
        [
            'label' => __('Style', 'pagifye-widgets'),
            'type' => \Elementor\Controls_Manager::SELECT,
            'default' => 'filled',
            'options' => [
                'outline' => __('Outline', 'pagifye-widgets'),
                'filled' => __('Filled', 'pagifye-widgets'),
            ],
            'condition' => [
                'show_desktop_cta' => 'yes',
            ],
        ]
    );

    $this->end_controls_section();
}
```

---

### 4. Register Menu Style Controls

```php
/**
 * Register menu style controls
 *
 * @since 1.0.0
 * @access protected
 */
protected function register_menu_style_controls() {
    $this->start_controls_section(
        'section_menu_style',
        [
            'label' => __('Menu Items', 'pagifye-widgets'),
            'tab' => \Elementor\Controls_Manager::TAB_STYLE,
        ]
    );

    // Menu Typography
    $this->add_group_control(
        \Elementor\Group_Control_Typography::get_type(),
        [
            'name' => 'menu_typography',
            'label' => __('Typography', 'pagifye-widgets'),
            'selector' => '{{WRAPPER}} .pagifye-nav-menu a',
        ]
    );

    // Menu Text Color
    $this->add_control(
        'menu_text_color',
        [
            'label' => __('Text Color', 'pagifye-widgets'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'default' => '#FFFFFF',
            'selectors' => [
                '{{WRAPPER}} .pagifye-nav-menu a' => 'color: {{VALUE}}',
            ],
        ]
    );

    // Menu Hover Color
    $this->add_control(
        'menu_text_color_hover',
        [
            'label' => __('Hover Color', 'pagifye-widgets'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'default' => '#8FE35F',
            'selectors' => [
                '{{WRAPPER}} .pagifye-nav-menu a:hover' => 'color: {{VALUE}}',
            ],
        ]
    );

    // Menu Active Color
    $this->add_control(
        'menu_active_color',
        [
            'label' => __('Active Color', 'pagifye-widgets'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'default' => '#8FE35F',
            'selectors' => [
                '{{WRAPPER}} .pagifye-nav-menu a.active' => 'color: {{VALUE}}',
            ],
        ]
    );

    // Menu Items Gap
    $this->add_responsive_control(
        'menu_items_gap',
        [
            'label' => __('Items Gap', 'pagifye-widgets'),
            'type' => \Elementor\Controls_Manager::SLIDER,
            'size_units' => ['px', 'rem'],
            'range' => [
                'px' => [
                    'min' => 0,
                    'max' => 100,
                ],
                'rem' => [
                    'min' => 0,
                    'max' => 10,
                ],
            ],
            'default' => [
                'unit' => 'px',
                'size' => 24,
            ],
            'selectors' => [
                '{{WRAPPER}} .pagifye-nav-menu ul' => 'gap: {{SIZE}}{{UNIT}}',
            ],
        ]
    );

    // Menu Item Padding
    $this->add_responsive_control(
        'menu_padding',
        [
            'label' => __('Item Padding', 'pagifye-widgets'),
            'type' => \Elementor\Controls_Manager::DIMENSIONS,
            'size_units' => ['px', 'rem'],
            'selectors' => [
                '{{WRAPPER}} .pagifye-nav-menu a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ]
    );

    $this->end_controls_section();
}
```

---

### 5. Render Method - Complete

```php
/**
 * Render widget output on the frontend
 *
 * @since 1.0.0
 * @access protected
 */
protected function render() {
    $settings = $this->get_settings_for_display();

    // Wrapper attributes
    $this->add_render_attribute('wrapper', [
        'class' => 'pagifye-widget pagifye-navigation-01',
        'x-data' => '{ isOpen: false }',
    ]);

    // Header attributes
    $header_classes = 'pagifye-nav-header relative flex items-center justify-between py-4 font-medium max-lg:pr-4';

    if ('yes' === $settings['sticky_header']) {
        $header_classes .= ' sticky top-0 z-50';
    }

    $this->add_render_attribute('header', 'class', $header_classes);

    ?>
    <section <?php echo $this->get_render_attribute_string('wrapper'); ?>>
        <header <?php echo $this->get_render_attribute_string('header'); ?>>
            <div class="container flex items-center lg:justify-between">

                <?php $this->render_logo($settings); ?>

                <?php $this->render_desktop_menu($settings); ?>

                <?php if ('yes' === $settings['show_desktop_cta']) : ?>
                    <?php $this->render_cta_buttons($settings, 'desktop'); ?>
                <?php endif; ?>

            </div>

            <?php $this->render_mobile_navigation($settings); ?>

        </header>
    </section>
    <?php
}
```

---

### 6. Alpine.js Enhanced Mobile Menu

```html
<!-- Enhanced Alpine.js with transitions and body scroll lock -->
<div
    x-data="{
        isOpen: false,
        toggle() {
            this.isOpen = !this.isOpen;
            document.body.style.overflow = this.isOpen ? 'hidden' : '';
        },
        close() {
            this.isOpen = false;
            document.body.style.overflow = '';
        }
    }"
    @keydown.escape.window="close()"
    class="flex lg:hidden"
>
    <!-- Mobile CTA -->
    <button class="mr-4 select-none text-nowrap rounded-full px-4 py-1 text-base font-bold bg-pgfy-primary-500 text-pgfy-gray-500 transition duration-300 ease-in-out hover:bg-pgfy-primary-600">
        Get Started
    </button>

    <!-- Toggle Button -->
    <button
        @click="toggle()"
        class="relative z-10 pagifye-menu-toggle"
        :aria-expanded="isOpen"
        aria-label="Toggle menu"
    >
        <img src="burger-menu.svg" alt="Menu" class="min-h-6 min-w-6">
    </button>

    <!-- Mobile Menu Panel -->
    <div
        x-show="isOpen"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 transform translate-y-4"
        x-transition:enter-end="opacity-100 transform translate-y-0"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100 transform translate-y-0"
        x-transition:leave-end="opacity-0 transform translate-y-4"
        @click.away="close()"
        style="display: none;"
    >
        <div class="pagifye-mobile-menu absolute inset-x-0 top-[70px] z-20 flex h-[calc(100vh-72px)] w-full flex-col justify-between overflow-y-auto px-4 pb-4">
            <!-- Menu items -->
            <ul class="space-y-4 pt-6">
                <li><a href="#" @click="close()">Home</a></li>
                <li><a href="#" @click="close()">About</a></li>
                <!-- More items -->
            </ul>

            <!-- CTA Buttons -->
            <div class="flex w-full flex-wrap gap-4 max-sm:flex-col">
                <!-- Buttons -->
            </div>
        </div>
    </div>
</div>
```

---

## Summary

This implementation plan provides a complete roadmap for developing the Navigation-01 Elementor widget. The widget includes:

**Features:**
- Logo (image or text) with customizable link
- Desktop horizontal menu with dropdown support
- Nested repeaters for menu items and submenus
- Desktop CTA buttons (primary and secondary)
- Mobile menu with Alpine.js toggle functionality
- Sticky header option
- Comprehensive style controls for all elements
- Responsive behavior at multiple breakpoints
- Full accessibility support (WCAG 2.1 AA)

**Complexity Breakdown:**
- **Content Controls:** 5 sections, 20+ controls
- **Style Controls:** 6 sections, 40+ controls
- **Nested Repeaters:** Menu items with submenu items
- **Alpine.js:** Mobile menu toggle, optional dropdown clicks
- **Responsive:** Desktop (lg+), Tablet (md-lg), Mobile (<md)

**Estimated Development Time:**
- Setup: 30 minutes
- Content Controls: 6 hours
- Style Controls: 5 hours
- Render Methods: 4 hours
- Alpine.js Integration: 1 hour
- Testing: 6 hours
- Documentation: 1 hour
- **Total: ~24 hours (3-4 days)**

**Next Steps:**
1. Create widget file structure
2. Implement controls section by section
3. Build render methods incrementally
4. Test each section as you build
5. Complete comprehensive testing
6. Document and finalize

This widget will serve as the foundation and pattern for all other widgets in the Pagifye Elementor Widgets plugin.

---

**Document Status:** Complete
**Ready for:** Implementation
**Developer:** Follow step-by-step implementation guide
