# Pagifye Elementor Widgets - Plugin Architecture

**Version:** 1.0.0
**Last Updated:** 2025-11-02
**Status:** Planning Phase

---

## Table of Contents

1. [Project Overview](#project-overview)
2. [Technology Stack](#technology-stack)
3. [Component Inventory](#component-inventory)
4. [Directory Structure](#directory-structure)
5. [Core Architecture](#core-architecture)
6. [Development Workflow](#development-workflow)
7. [Asset Management](#asset-management)
8. [Widget Development Pattern](#widget-development-pattern)
9. [Implementation Phases](#implementation-phases)
10. [Quality Standards](#quality-standards)

---

## Project Overview

### Purpose
Transform 34 free Pagifye Tailwind CSS components into fully customizable Elementor widgets for WordPress.

### Goals
- Provide beautiful, pre-designed components for Elementor users
- Maintain the Pagifye design system integrity
- Enable full customization through Elementor's visual interface
- Ensure optimal performance and accessibility
- Create a maintainable and extensible codebase

### Target Users
- WordPress site builders
- Web designers using Elementor
- Marketing agencies
- Small business owners
- Freelance developers

---

## Technology Stack

### Core Technologies
- **WordPress:** 5.8+ (Recommended: 6.4+)
- **Elementor:** 3.16+ (Pro features optional)
- **PHP:** 7.4+ (Recommended: 8.1+)
- **Tailwind CSS:** 3.4+
- **Alpine.js:** 3.13+

### Development Tools
- **Node.js:** 18+ (for build tools)
- **Composer:** 2.0+ (for PHP dependencies)
- **npm/yarn:** Package management
- **Webpack:** JavaScript bundling
- **Tailwind CLI:** CSS compilation

### Build Pipeline
```bash
# CSS Build
tailwindcss -i ./tailwind/src/input.css -o ./assets/css/tailwind-output.css --minify

# JavaScript Build
webpack --mode production

# Watch Mode (Development)
npm run dev
```

---

## Component Inventory

### Total Components: 34 widgets across 11 categories

| Category      | Variants | Files                                    |
|---------------|----------|------------------------------------------|
| Navigation    | 3        | root_navigation-01, 03, 05               |
| Hero          | 5        | root_hero-01, 03, 04, 06, 07             |
| Content       | 3        | root_content-02, 03, 04                  |
| Metrics       | 2        | root_metrics-02, 06                      |
| Team          | 3        | root_team-01, 02, 04                     |
| Pricing       | 3        | root_pricing-01, 02, 05                  |
| Testimonial   | 3        | root_testimonial-02, 04, 05              |
| FAQ           | 3        | root_faq-01, 04, 05                      |
| Contact       | 3        | root_contact-01, 02, 04                  |
| Awards        | 3        | root_awards-01, 02, 04                   |
| Blog          | 3        | root_blog-01, 03, 05                     |

### Component Source Location
All components are stored in: `/components/*.html`
Metadata available in: `/components/metadata.json`

---

## Directory Structure

```
pagifye-elementor-widgets/
├── pagifye-elementor-widgets.php          # Main plugin file
├── readme.txt                              # WordPress.org readme
├── LICENSE.txt                             # GPL v2+ license
├── composer.json                           # PHP dependencies
├── package.json                            # Node dependencies
│
├── assets/
│   ├── css/
│   │   ├── tailwind-output.css            # Compiled Tailwind (minified)
│   │   ├── custom-styles.css              # Additional styles
│   │   └── editor-preview.css             # Elementor editor styles
│   ├── js/
│   │   ├── alpine.min.js                  # Alpine.js framework
│   │   ├── widgets-frontend.js            # Frontend interactions
│   │   └── widgets-editor.js              # Editor enhancements
│   └── images/
│       ├── icons/                          # Widget icons
│       └── placeholders/                   # Default images
│
├── includes/
│   ├── class-plugin.php                    # Main plugin class
│   ├── class-assets-manager.php            # Asset enqueuing
│   ├── class-widget-manager.php            # Widget registration
│   ├── class-widget-loader.php             # Widget autoloader
│   ├── class-category-manager.php          # Elementor category
│   └── helpers/
│       ├── functions.php                   # Utility functions
│       └── sanitization.php                # Input sanitization
│
├── widgets/
│   ├── base/
│   │   └── class-pagifye-widget-base.php  # Abstract base class
│   ├── navigation/
│   │   ├── class-navigation-01.php
│   │   ├── class-navigation-03.php
│   │   └── class-navigation-05.php
│   ├── hero/
│   │   ├── class-hero-01.php
│   │   ├── class-hero-03.php
│   │   ├── class-hero-04.php
│   │   ├── class-hero-06.php
│   │   └── class-hero-07.php
│   ├── pricing/
│   │   ├── class-pricing-01.php
│   │   ├── class-pricing-02.php
│   │   └── class-pricing-05.php
│   ├── testimonial/
│   │   ├── class-testimonial-02.php
│   │   ├── class-testimonial-04.php
│   │   └── class-testimonial-05.php
│   ├── faq/
│   │   ├── class-faq-01.php
│   │   ├── class-faq-04.php
│   │   └── class-faq-05.php
│   ├── contact/
│   │   ├── class-contact-01.php
│   │   ├── class-contact-02.php
│   │   └── class-contact-04.php
│   ├── content/
│   │   ├── class-content-02.php
│   │   ├── class-content-03.php
│   │   └── class-content-04.php
│   ├── team/
│   │   ├── class-team-01.php
│   │   ├── class-team-02.php
│   │   └── class-team-04.php
│   ├── metrics/
│   │   ├── class-metrics-02.php
│   │   └── class-metrics-06.php
│   ├── awards/
│   │   ├── class-awards-01.php
│   │   ├── class-awards-02.php
│   │   └── class-awards-04.php
│   └── blog/
│       ├── class-blog-01.php
│       ├── class-blog-03.php
│       └── class-blog-05.php
│
├── templates/
│   └── parts/                              # Reusable template parts
│       ├── button.php
│       ├── card.php
│       └── icon.php
│
├── tailwind/
│   ├── tailwind.config.js                  # Tailwind configuration
│   ├── package.json                        # Build dependencies
│   └── src/
│       └── input.css                       # Tailwind source
│
├── languages/
│   └── pagifye-widgets.pot                # Translation template
│
├── tests/
│   ├── phpunit/                            # PHP unit tests
│   └── cypress/                            # E2E tests
│
└── docs/
    ├── 01-PLUGIN-ARCHITECTURE.md          # This file
    ├── 02-DEVELOPMENT-GUIDE.md            # Developer guide
    ├── 03-WIDGET-IMPLEMENTATION.md        # Widget coding standards
    ├── 04-TESTING-GUIDE.md                # Testing procedures
    └── components/                         # Individual component docs
        ├── navigation-01-plan.md
        ├── hero-01-plan.md
        ├── pricing-01-plan.md
        ├── faq-01-plan.md
        └── testimonial-02-plan.md
```

---

## Core Architecture

### Plugin Initialization Flow

```
1. WordPress loads plugin
   ↓
2. pagifye-elementor-widgets.php executed
   ↓
3. Check dependencies (Elementor, PHP version)
   ↓
4. Load includes/class-plugin.php
   ↓
5. Initialize managers:
   - Assets Manager
   - Widget Manager
   - Category Manager
   ↓
6. Register hooks:
   - elementor/widgets/register
   - elementor/elements/categories_registered
   - wp_enqueue_scripts
   ↓
7. Load widget classes
   ↓
8. Register widgets with Elementor
```

### Class Hierarchy

```
Elementor\Widget_Base (Elementor Core)
    ↓
Pagifye_Widget_Base (Our Abstract Base)
    ↓
    ├── Pagifye_Navigation_01
    ├── Pagifye_Navigation_03
    ├── Pagifye_Navigation_05
    ├── Pagifye_Hero_01
    ├── Pagifye_Hero_03
    ├── Pagifye_Pricing_01
    ├── Pagifye_FAQ_01
    ├── Pagifye_Testimonial_02
    └── ... (all 34 widgets)
```

### Base Widget Class Structure

```php
abstract class Pagifye_Widget_Base extends \Elementor\Widget_Base {

    // Properties
    protected $widget_name;
    protected $widget_title;
    protected $widget_icon;
    protected $component_slug;

    // Required Elementor Methods
    abstract public function get_name();
    abstract public function get_title();
    abstract public function get_icon();
    abstract protected function register_controls();
    abstract protected function render();

    // Common Methods
    public function get_categories();
    public function get_keywords();
    public function get_script_depends();
    public function get_style_depends();

    // Helper Methods
    protected function register_base_content_controls();
    protected function register_base_style_controls();
    protected function render_link_attributes($link_settings);
    protected function render_button($settings);
}
```

---

## Development Workflow

### Phase 1: Foundation (Weeks 1-2)
**Goal:** Set up plugin infrastructure

**Tasks:**
1. Create plugin skeleton
2. Set up Tailwind CSS build system
3. Configure Alpine.js integration
4. Create base widget class
5. Implement asset manager
6. Register Elementor category
7. Set up autoloading

**Deliverables:**
- Working plugin activates without errors
- Tailwind CSS compiles successfully
- Base widget class ready for extension
- "Pagifye Components" category appears in Elementor

---

### Phase 2: Core Widgets (Weeks 3-5)
**Goal:** Implement 5 priority widgets

**Priority Widgets:**
1. **Navigation-01** (Most complex, sets patterns)
2. **Hero-01** (High usage, showcase piece)
3. **Pricing-01** (Complex interactions, repeaters)
4. **FAQ-01** (Alpine.js accordion functionality)
5. **Testimonial-02** (Image handling, layouts)

**Workflow per Widget:**
1. Read component HTML file
2. Identify editable elements
3. Create widget class file
4. Register Elementor controls
5. Convert static HTML to dynamic PHP
6. Add style controls
7. Test responsive behavior
8. Add inline documentation
9. Test in Elementor editor
10. Commit to version control

---

### Phase 3: Remaining Widgets (Weeks 6-7)
**Goal:** Complete all 34 widgets

**Approach:**
- Implement remaining 29 widgets
- Follow established patterns from Phase 2
- Batch similar components together
- Test each category as a group

---

### Phase 4: Advanced Features (Week 8)
**Goal:** Add dynamic content and presets

**Features:**
1. WordPress post integration (Blog widgets)
2. Dynamic tags support
3. Widget presets/templates
4. Global color/font integration
5. Template library

---

### Phase 5: Polish & Release (Weeks 9-10)
**Goal:** Production-ready release

**Tasks:**
1. Performance optimization
2. Cross-browser testing
3. Accessibility audit (WCAG 2.1)
4. Security review
5. Documentation completion
6. WordPress.org submission
7. Marketing materials
8. Launch

---

## Asset Management

### Tailwind CSS Configuration

```javascript
// tailwind.config.js
module.exports = {
  content: [
    './widgets/**/*.php',
    './templates/**/*.php',
  ],
  theme: {
    extend: {
      colors: {
        'pgfy-gray': {
          50: '#F5F7F6',
          400: '#1A2E27',
          500: '#0F2C24',
        },
        'pgfy-primary': {
          500: '#8FE35F',
          600: '#7DD44E',
        },
        'pgfy-neutral-white': '#E8F0ED',
        'pgfy-wireframe': {
          100: '#E8E8E8'
        }
      },
      container: {
        center: true,
        padding: '1rem',
        screens: {
          sm: '640px',
          md: '768px',
          lg: '1024px',
          xl: '1280px',
        },
      },
    },
  },
  // Prefix to avoid conflicts
  prefix: 'tw-',
  // Scope all styles
  important: '.pagifye-widget',
}
```

### Asset Loading Strategy

**1. Conditional Loading:**
Only load assets when widget is used on page

**2. Asset Registration:**
```php
// Register (don't enqueue yet)
wp_register_style('tailwind-pagifye', ...);
wp_register_script('alpine-js', ...);

// Enqueue only when needed
if (widget_is_on_page('pagifye-navigation-01')) {
    wp_enqueue_style('tailwind-pagifye');
    wp_enqueue_script('alpine-js');
}
```

**3. Asset Optimization:**
- Minify CSS/JS in production
- Combine widget-specific styles
- Use browser caching headers
- Defer non-critical JavaScript
- Lazy load images

---

## Widget Development Pattern

### Standard Widget Structure

```php
<?php
namespace Pagifye\Widgets;

if (!defined('ABSPATH')) exit;

class Pagifye_Widget_Name extends Pagifye_Widget_Base {

    // 1. Widget Identification
    public function get_name() {
        return 'pagifye-widget-name';
    }

    public function get_title() {
        return __('Widget Name', 'pagifye-widgets');
    }

    public function get_icon() {
        return 'eicon-posts-grid';
    }

    public function get_keywords() {
        return ['pagifye', 'widget', 'name'];
    }

    // 2. Register Controls
    protected function register_controls() {

        // Content Controls
        $this->start_controls_section('section_content', [
            'label' => __('Content', 'pagifye-widgets'),
            'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
        ]);

        // Add controls here...

        $this->end_controls_section();

        // Style Controls
        $this->start_controls_section('section_style', [
            'label' => __('Style', 'pagifye-widgets'),
            'tab' => \Elementor\Controls_Manager::TAB_STYLE,
        ]);

        // Add style controls here...

        $this->end_controls_section();
    }

    // 3. Render Frontend
    protected function render() {
        $settings = $this->get_settings_for_display();

        // Wrapper with unique class
        echo '<div class="pagifye-widget pagifye-widget-name">';

        // Render widget HTML
        // Use $settings to insert dynamic content

        echo '</div>';
    }

    // 4. Render Editor Template (Optional)
    protected function content_template() {
        // JavaScript template for live editing
    }
}
```

### Control Types Reference

**Text Controls:**
- `TEXT` - Single line text
- `TEXTAREA` - Multi-line text
- `WYSIWYG` - Rich text editor
- `CODE` - Code editor

**Select Controls:**
- `SELECT` - Dropdown
- `SELECT2` - Searchable dropdown
- `CHOOSE` - Icon buttons
- `SWITCHER` - Toggle on/off

**Media Controls:**
- `MEDIA` - Image/video selector
- `GALLERY` - Multiple images
- `ICON` - Icon picker

**Layout Controls:**
- `REPEATER` - Repeating fields
- `DIMENSIONS` - Top/Right/Bottom/Left
- `SLIDER` - Numeric slider

**Design Controls:**
- `COLOR` - Color picker
- `FONT` - Font selector
- `TYPOGRAPHY` - Complete typography control

**Link Controls:**
- `URL` - Link with options (new tab, nofollow)

---

## Implementation Phases

### Phase Breakdown

| Phase | Duration | Widgets | Status |
|-------|----------|---------|--------|
| 1. Foundation | 2 weeks | 0 (Infrastructure) | Planned |
| 2. Core Widgets | 3 weeks | 5 priority | Planned |
| 3. Remaining Widgets | 2 weeks | 29 widgets | Planned |
| 4. Advanced Features | 1 week | All widgets | Planned |
| 5. Polish & Release | 2 weeks | All widgets | Planned |
| **Total** | **10 weeks** | **34 widgets** | **Planning** |

---

## Quality Standards

### Code Quality
- PSR-4 autoloading
- WordPress Coding Standards
- PHP 7.4+ compatibility
- No deprecated functions
- Proper escaping and sanitization

### Performance
- Page load < 3 seconds
- CSS file < 150KB
- JavaScript < 100KB
- No render-blocking resources

### Accessibility
- WCAG 2.1 Level AA compliance
- Keyboard navigation support
- Screen reader compatible
- Proper ARIA labels
- Color contrast ratios

### Browser Support
- Chrome (latest 2 versions)
- Firefox (latest 2 versions)
- Safari (latest 2 versions)
- Edge (latest 2 versions)
- Mobile browsers (iOS Safari, Chrome)

### Testing Requirements
- [ ] Unit tests for PHP classes
- [ ] Integration tests for widgets
- [ ] Visual regression tests
- [ ] Accessibility audit
- [ ] Performance profiling
- [ ] Security scan

---

## Version Control Strategy

### Git Workflow
```
main
  ↓
develop (active development)
  ↓
feature/widget-name (per widget)
```

### Commit Convention
```
feat: Add Navigation-01 widget
fix: Resolve pricing toggle issue
docs: Update architecture documentation
style: Format code per WordPress standards
refactor: Optimize asset loading
test: Add unit tests for base widget
```

---

## Next Steps

1. ✅ Complete architecture documentation
2. ⏳ Select 5 priority components
3. ⏳ Create detailed implementation plans
4. ⏳ Set up development environment
5. ⏳ Begin Phase 1: Foundation

---

**Document Status:** Complete
**Next Document:** Component Implementation Plans
**Ready for:** Phase 1 Development
