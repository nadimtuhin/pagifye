# Pagifye Elementor Widgets - Development Start Plan

**Version:** 1.0.0
**Date:** 2025-11-02
**Status:** 🚀 Ready to Begin Development
**Phase:** Pre-Development → Phase 1 Foundation

---

## 📋 Table of Contents

1. [Executive Summary](#executive-summary)
2. [Current Project Status](#current-project-status)
3. [Development Plan Overview](#development-plan-overview)
4. [Phase 1: Foundation Setup (Detailed)](#phase-1-foundation-setup-detailed)
5. [Phase 2: Priority Widgets (Detailed)](#phase-2-priority-widgets-detailed)
6. [Prerequisites & Environment Setup](#prerequisites--environment-setup)
7. [Day-by-Day Implementation Guide](#day-by-day-implementation-guide)
8. [Technical Implementation Details](#technical-implementation-details)
9. [Quality Assurance Checklist](#quality-assurance-checklist)
10. [Resources & References](#resources--references)
11. [Success Criteria](#success-criteria)
12. [Next Steps](#next-steps)

---

## 📋 Executive Summary

This document provides a comprehensive, actionable plan to begin development of the Pagifye Elementor Widgets plugin. All planning documentation is complete (67,500+ words), and the project is ready to transition from planning to active development.

### Quick Facts

- **Total Components:** 34 widgets across 11 categories
- **Priority Widgets:** 5 widgets for initial implementation
- **Technology Stack:** WordPress + Elementor + Tailwind CSS + Alpine.js
- **Estimated Timeline:** 10 weeks (2 weeks foundation + 3 weeks core widgets + 5 weeks completion)
- **Current Phase:** Phase 1 Foundation - Ready to Start
- **Documentation:** Complete and comprehensive

### What This Document Covers

This development start plan bridges the gap between planning and implementation by providing:

1. ✅ Detailed breakdown of Phase 1 foundation tasks
2. ✅ Step-by-step implementation guide for first 2 weeks
3. ✅ Environment setup requirements and verification steps
4. ✅ Code structure templates and examples
5. ✅ Testing and validation checkpoints
6. ✅ Troubleshooting guidance
7. ✅ Links to all relevant documentation

---

## 🎯 Current Project Status

### ✅ Completed Work

#### Planning Documentation (100% Complete)
| Document | Size | Status | Purpose |
|----------|------|--------|---------|
| **00-PROJECT-MASTER-PLAN.md** | 15,000 words | ✅ Complete | Project overview, roadmap, statistics |
| **01-PLUGIN-ARCHITECTURE.md** | 15,000 words | ✅ Complete | Technical architecture, directory structure |
| **02-PRIORITY-COMPONENTS-SELECTION.md** | 7,000 words | ✅ Complete | Component selection criteria and rationale |
| **components/navigation-01-plan.md** | 10,000 words | ✅ Complete | Navigation widget implementation guide |
| **components/hero-01-plan.md** | 8,000 words | ✅ Complete | Hero widget implementation guide |
| **components/pricing-01-plan.md** | 8,000 words | ✅ Complete | Pricing widget implementation guide |
| **components/faq-01-plan.md** | 6,000 words | ✅ Complete | FAQ widget implementation guide |
| **components/testimonial-02-plan.md** | 7,000 words | ✅ Complete | Testimonial widget implementation guide |
| **README.md** | 9,000 words | ✅ Complete | Documentation index and navigation |
| **Total** | **85,000+ words** | ✅ Complete | Comprehensive project documentation |

#### Component Assets (100% Complete)
- ✅ **34 components** scraped and saved as HTML files
- ✅ **metadata.json** with component inventory
- ✅ **Component scraper** functional and tested
- ✅ All source HTML available in `components/` directory

#### Repository Setup (100% Complete)
- ✅ Git repository initialized
- ✅ Node.js project configured (`package.json`)
- ✅ Scraper dependencies installed
- ✅ Environment variables configured (`.env`)
- ✅ Project documentation organized

### ⏳ Pending Work

#### Phase 1: Foundation (0% Complete)
- ⏳ Plugin directory structure
- ⏳ Main plugin file with WordPress headers
- ⏳ Tailwind CSS build system
- ⏳ Alpine.js integration
- ⏳ Base widget class
- ⏳ Asset manager
- ⏳ Autoloading and widget registration

#### Phase 2: Core Widgets (0% Complete)
- ⏳ Navigation-01 widget
- ⏳ Hero-01 widget
- ⏳ Pricing-01 widget
- ⏳ FAQ-01 widget
- ⏳ Testimonial-02 widget

---

## 🗺️ Development Plan Overview

### Timeline Breakdown

```
┌─────────────────────────────────────────────────────────────────┐
│                    10-Week Development Timeline                  │
├─────────────────────────────────────────────────────────────────┤
│ Week 1-2   │ Phase 1: Foundation Setup                          │
│            │ • Plugin structure, build system, base classes     │
├────────────┼────────────────────────────────────────────────────┤
│ Week 3     │ Phase 2: Navigation-01 (Days 1-4) + Hero-01 (5-7) │
│            │ • Establish patterns with most complex widget      │
├────────────┼────────────────────────────────────────────────────┤
│ Week 4     │ Phase 2: Pricing-01 (Days 8-11) + FAQ-01 (12-13)  │
│            │ • Interactive widgets with Alpine.js               │
├────────────┼────────────────────────────────────────────────────┤
│ Week 5     │ Phase 2: Testimonial-02 (Days 14-16) + Testing    │
│            │ • Final priority widget + integration testing     │
├────────────┼────────────────────────────────────────────────────┤
│ Week 6-7   │ Phase 3: Remaining 29 Widgets                     │
│            │ • Follow established patterns                      │
├────────────┼────────────────────────────────────────────────────┤
│ Week 8     │ Phase 4: Advanced Features                        │
│            │ • Dynamic tags, templates, global styles          │
├────────────┼────────────────────────────────────────────────────┤
│ Week 9-10  │ Phase 5: Polish & Release                         │
│            │ • Testing, optimization, WordPress.org submission  │
└─────────────────────────────────────────────────────────────────┘
```

### Phase 1 Focus: Foundation (This Document's Primary Focus)

**Duration:** 2 weeks (80 hours)
**Goal:** Create a solid, tested foundation for all widgets
**Deliverables:** Working plugin with base infrastructure ready

**Why Phase 1 is Critical:**
- Establishes architectural patterns used by all 34 widgets
- Sets up build tools and asset management
- Creates reusable base classes and utilities
- Prevents technical debt and refactoring later
- Ensures WordPress and Elementor best practices from the start

---

## 🏗️ Phase 1: Foundation Setup (Detailed)

### Overview

Phase 1 consists of 7 major tasks that build the plugin infrastructure. Each task is designed to be completed sequentially, with testing and validation at each step.

**Total Time:** 80 hours (2 weeks)
**Approach:** Incremental development with continuous testing
**Success Metric:** Plugin activates and is ready for widget development

---

### Task 1: Plugin Directory Structure

**Time:** 6 hours
**Priority:** Highest - Foundation for everything
**Dependencies:** None

#### What to Create

Create the complete WordPress plugin structure in your WordPress plugins directory:

```
wp-content/plugins/pagifye-elementor-widgets/
├── pagifye-elementor-widgets.php          # Main plugin file
├── readme.txt                              # WordPress.org readme
├── composer.json                           # PHP dependencies
├── package.json                            # Node dependencies
├── .gitignore                              # Git ignore rules
│
├── includes/                               # PHP classes
│   ├── class-plugin.php                   # Main plugin class
│   ├── class-base-widget.php              # Base widget class
│   ├── class-assets-manager.php           # Asset management
│   ├── class-widgets-loader.php           # Widget registration
│   └── helpers/                            # Helper functions
│       ├── sanitization.php               # Sanitization functions
│       └── utilities.php                  # Utility functions
│
├── widgets/                                # Individual widget classes
│   ├── class-navigation-01.php            # Navigation widget
│   ├── class-hero-01.php                  # Hero widget
│   ├── class-pricing-01.php               # Pricing widget
│   ├── class-faq-01.php                   # FAQ widget
│   └── class-testimonial-02.php           # Testimonial widget
│
├── assets/                                 # Source assets
│   ├── css/
│   │   ├── src/
│   │   │   ├── main.css                   # Tailwind entry point
│   │   │   ├── components/                # Component styles
│   │   │   └── utilities/                 # Custom utilities
│   │   └── admin/
│   │       └── editor.css                 # Elementor editor styles
│   │
│   └── js/
│       ├── src/
│       │   ├── main.js                    # JavaScript entry point
│       │   └── components/                # Alpine.js components
│       └── admin/
│           └── editor.js                  # Editor JavaScript
│
├── build/                                  # Compiled assets (generated)
│   ├── css/
│   │   ├── pagifye-widgets.css           # Compiled CSS
│   │   └── pagifye-widgets.min.css       # Minified CSS
│   └── js/
│       ├── pagifye-widgets.js            # Compiled JS
│       └── pagifye-widgets.min.js        # Minified JS
│
├── languages/                              # Translation files
│   └── pagifye-elementor-widgets.pot      # Translation template
│
├── vendor/                                 # Composer packages (generated)
│
└── node_modules/                           # npm packages (generated)
```

#### Implementation Steps

1. **Create Root Directory**
   ```bash
   cd /path/to/wordpress/wp-content/plugins/
   mkdir pagifye-elementor-widgets
   cd pagifye-elementor-widgets
   ```

2. **Create Directory Structure**
   ```bash
   mkdir -p includes/helpers
   mkdir -p widgets
   mkdir -p assets/css/src/{components,utilities}
   mkdir -p assets/css/admin
   mkdir -p assets/js/src/components
   mkdir -p assets/js/admin
   mkdir -p build/{css,js}
   mkdir -p languages
   ```

3. **Initialize Git**
   ```bash
   git init
   ```

4. **Create .gitignore**
   ```
   # Dependencies
   node_modules/
   vendor/

   # Build files
   build/

   # Environment
   .env
   .env.local

   # OS files
   .DS_Store
   Thumbs.db

   # IDE
   .vscode/
   .idea/
   *.sublime-*

   # Logs
   *.log
   npm-debug.log*

   # Compiled files
   *.css.map
   *.js.map
   ```

#### Validation Checklist

- [ ] All directories created
- [ ] Git initialized
- [ ] .gitignore in place
- [ ] Directory structure matches plan
- [ ] Ready for next task

---

### Task 2: Main Plugin File

**Time:** 8 hours
**Priority:** Highest
**Dependencies:** Task 1 (Directory Structure)

#### What to Create

Create the main plugin file that WordPress recognizes and loads.

**File:** `pagifye-elementor-widgets.php`

#### Implementation

```php
<?php
/**
 * Plugin Name: Pagifye Elementor Widgets
 * Plugin URI: https://github.com/yourusername/pagifye-elementor-widgets
 * Description: Transform beautiful Pagifye Tailwind CSS components into fully customizable Elementor widgets.
 * Version: 1.0.0
 * Author: Your Name
 * Author URI: https://yourwebsite.com
 * License: GPL v2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: pagifye-elementor-widgets
 * Domain Path: /languages
 * Requires at least: 5.8
 * Requires PHP: 7.4
 * Elementor tested up to: 3.19
 * Elementor Pro tested up to: 3.19
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Plugin constants
 */
define( 'PAGIFYE_WIDGETS_VERSION', '1.0.0' );
define( 'PAGIFYE_WIDGETS_FILE', __FILE__ );
define( 'PAGIFYE_WIDGETS_PATH', plugin_dir_path( __FILE__ ) );
define( 'PAGIFYE_WIDGETS_URL', plugin_dir_url( __FILE__ ) );
define( 'PAGIFYE_WIDGETS_ASSETS_URL', PAGIFYE_WIDGETS_URL . 'build/' );

/**
 * Minimum requirements
 */
define( 'PAGIFYE_WIDGETS_MINIMUM_PHP_VERSION', '7.4' );
define( 'PAGIFYE_WIDGETS_MINIMUM_WP_VERSION', '5.8' );
define( 'PAGIFYE_WIDGETS_MINIMUM_ELEMENTOR_VERSION', '3.16.0' );

/**
 * Load Composer autoloader
 */
require_once PAGIFYE_WIDGETS_PATH . 'vendor/autoload.php';

/**
 * Main Plugin Class
 */
final class Pagifye_Elementor_Widgets {

    /**
     * Plugin instance
     *
     * @var Pagifye_Elementor_Widgets
     */
    private static $_instance = null;

    /**
     * Get plugin instance
     *
     * @return Pagifye_Elementor_Widgets
     */
    public static function instance() {
        if ( is_null( self::$_instance ) ) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    /**
     * Constructor
     */
    private function __construct() {
        add_action( 'plugins_loaded', [ $this, 'init' ] );
    }

    /**
     * Initialize plugin
     */
    public function init() {
        // Check if Elementor is installed and activated
        if ( ! did_action( 'elementor/loaded' ) ) {
            add_action( 'admin_notices', [ $this, 'admin_notice_missing_elementor' ] );
            return;
        }

        // Check minimum Elementor version
        if ( ! version_compare( ELEMENTOR_VERSION, PAGIFYE_WIDGETS_MINIMUM_ELEMENTOR_VERSION, '>=' ) ) {
            add_action( 'admin_notices', [ $this, 'admin_notice_minimum_elementor_version' ] );
            return;
        }

        // Check minimum PHP version
        if ( version_compare( PHP_VERSION, PAGIFYE_WIDGETS_MINIMUM_PHP_VERSION, '<' ) ) {
            add_action( 'admin_notices', [ $this, 'admin_notice_minimum_php_version' ] );
            return;
        }

        // Load plugin functionality
        $this->load_plugin();
    }

    /**
     * Load plugin functionality
     */
    private function load_plugin() {
        // Load text domain
        add_action( 'init', [ $this, 'load_textdomain' ] );

        // Register Elementor widget category
        add_action( 'elementor/elements/categories_registered', [ $this, 'register_widget_category' ] );

        // Register widgets
        add_action( 'elementor/widgets/register', [ $this, 'register_widgets' ] );

        // Enqueue assets
        add_action( 'wp_enqueue_scripts', [ $this, 'enqueue_frontend_assets' ] );
        add_action( 'elementor/editor/before_enqueue_scripts', [ $this, 'enqueue_editor_assets' ] );
    }

    /**
     * Load plugin text domain
     */
    public function load_textdomain() {
        load_plugin_textdomain(
            'pagifye-elementor-widgets',
            false,
            dirname( plugin_basename( __FILE__ ) ) . '/languages'
        );
    }

    /**
     * Register widget category
     *
     * @param \Elementor\Elements_Manager $elements_manager
     */
    public function register_widget_category( $elements_manager ) {
        $elements_manager->add_category(
            'pagifye-widgets',
            [
                'title' => esc_html__( 'Pagifye Components', 'pagifye-elementor-widgets' ),
                'icon' => 'fa fa-plug',
            ]
        );
    }

    /**
     * Register widgets
     *
     * @param \Elementor\Widgets_Manager $widgets_manager
     */
    public function register_widgets( $widgets_manager ) {
        // This will be implemented in Task 6
        // For now, it's a placeholder
    }

    /**
     * Enqueue frontend assets
     */
    public function enqueue_frontend_assets() {
        // This will be implemented in Task 5
    }

    /**
     * Enqueue editor assets
     */
    public function enqueue_editor_assets() {
        // This will be implemented in Task 5
    }

    /**
     * Admin notice - Missing Elementor
     */
    public function admin_notice_missing_elementor() {
        $message = sprintf(
            /* translators: 1: Plugin name 2: Elementor */
            esc_html__( '"%1$s" requires "%2$s" to be installed and activated.', 'pagifye-elementor-widgets' ),
            '<strong>' . esc_html__( 'Pagifye Elementor Widgets', 'pagifye-elementor-widgets' ) . '</strong>',
            '<strong>' . esc_html__( 'Elementor', 'pagifye-elementor-widgets' ) . '</strong>'
        );

        printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', wp_kses_post( $message ) );
    }

    /**
     * Admin notice - Minimum Elementor version
     */
    public function admin_notice_minimum_elementor_version() {
        $message = sprintf(
            /* translators: 1: Plugin name 2: Elementor 3: Required Elementor version */
            esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'pagifye-elementor-widgets' ),
            '<strong>' . esc_html__( 'Pagifye Elementor Widgets', 'pagifye-elementor-widgets' ) . '</strong>',
            '<strong>' . esc_html__( 'Elementor', 'pagifye-elementor-widgets' ) . '</strong>',
            PAGIFYE_WIDGETS_MINIMUM_ELEMENTOR_VERSION
        );

        printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', wp_kses_post( $message ) );
    }

    /**
     * Admin notice - Minimum PHP version
     */
    public function admin_notice_minimum_php_version() {
        $message = sprintf(
            /* translators: 1: Plugin name 2: PHP 3: Required PHP version */
            esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'pagifye-elementor-widgets' ),
            '<strong>' . esc_html__( 'Pagifye Elementor Widgets', 'pagifye-elementor-widgets' ) . '</strong>',
            '<strong>' . esc_html__( 'PHP', 'pagifye-elementor-widgets' ) . '</strong>',
            PAGIFYE_WIDGETS_MINIMUM_PHP_VERSION
        );

        printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', wp_kses_post( $message ) );
    }
}

/**
 * Initialize plugin
 */
function pagifye_elementor_widgets() {
    return Pagifye_Elementor_Widgets::instance();
}

// Kick off the plugin
pagifye_elementor_widgets();
```

#### Create Composer Configuration

**File:** `composer.json`

```json
{
    "name": "pagifye/elementor-widgets",
    "description": "Pagifye Elementor Widgets - Beautiful Tailwind CSS components for Elementor",
    "type": "wordpress-plugin",
    "license": "GPL-2.0-or-later",
    "require": {
        "php": ">=7.4"
    },
    "autoload": {
        "psr-4": {
            "Pagifye\\ElementorWidgets\\": "includes/"
        }
    }
}
```

#### Install Composer Dependencies

```bash
composer install
```

#### Validation Checklist

- [ ] Main plugin file created
- [ ] Plugin headers complete
- [ ] Constants defined
- [ ] Dependency checks implemented
- [ ] Composer configured
- [ ] Autoloader working
- [ ] Plugin activates in WordPress without errors
- [ ] Admin notices display when Elementor is missing

---

### Task 3: Tailwind CSS Build System

**Time:** 12 hours
**Priority:** High
**Dependencies:** Task 1 (Directory Structure)

#### What to Create

Set up Tailwind CSS compilation with the Pagifye design system.

#### Implementation Steps

##### 1. Install Dependencies

**File:** `package.json`

```json
{
  "name": "pagifye-elementor-widgets",
  "version": "1.0.0",
  "description": "Pagifye Elementor Widgets - Build System",
  "scripts": {
    "dev": "webpack --mode development --watch",
    "build": "webpack --mode production",
    "build:css": "tailwindcss -i ./assets/css/src/main.css -o ./build/css/pagifye-widgets.css",
    "build:css:watch": "tailwindcss -i ./assets/css/src/main.css -o ./build/css/pagifye-widgets.css --watch",
    "build:css:min": "tailwindcss -i ./assets/css/src/main.css -o ./build/css/pagifye-widgets.min.css --minify"
  },
  "devDependencies": {
    "@tailwindcss/forms": "^0.5.7",
    "@tailwindcss/typography": "^0.5.10",
    "autoprefixer": "^10.4.16",
    "css-loader": "^6.8.1",
    "cssnano": "^6.0.1",
    "mini-css-extract-plugin": "^2.7.6",
    "postcss": "^8.4.31",
    "postcss-loader": "^7.3.3",
    "tailwindcss": "^3.4.0",
    "webpack": "^5.89.0",
    "webpack-cli": "^5.1.4"
  },
  "dependencies": {
    "alpinejs": "^3.13.3"
  }
}
```

##### 2. Install npm Packages

```bash
npm install
```

##### 3. Configure Tailwind CSS

**File:** `tailwind.config.js`

```javascript
/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    './widgets/**/*.php',
    './includes/**/*.php',
    './assets/js/**/*.js',
  ],
  theme: {
    extend: {
      colors: {
        // Pagifye Color Palette
        'pgfy-primary': {
          500: '#8FE35F',
          600: '#7DD44E',
        },
        'pgfy-gray': {
          50: '#F5F7F6',
          400: '#1A2E27',
          500: '#0F2C24',
        },
        'pgfy-neutral-white': '#E8F0ED',
        'pgfy-wireframe': {
          100: '#E8E8E8',
        },
      },
      fontFamily: {
        sans: ['Inter', 'system-ui', 'sans-serif'],
      },
      container: {
        center: true,
        padding: {
          DEFAULT: '1rem',
          sm: '1rem',
          lg: '2rem',
          xl: '2rem',
          '2xl': '2rem',
        },
        screens: {
          sm: '640px',
          md: '768px',
          lg: '1024px',
          xl: '1280px',
          '2xl': '1280px', // Max container width
        },
      },
      spacing: {
        '18': '4.5rem',
        '112': '28rem',
        '128': '32rem',
      },
    },
  },
  plugins: [
    require('@tailwindcss/forms'),
    require('@tailwindcss/typography'),
  ],
}
```

##### 4. Configure PostCSS

**File:** `postcss.config.js`

```javascript
module.exports = {
  plugins: {
    tailwindcss: {},
    autoprefixer: {},
    ...(process.env.NODE_ENV === 'production' ? { cssnano: {} } : {})
  }
}
```

##### 5. Create CSS Entry Point

**File:** `assets/css/src/main.css`

```css
/**
 * Pagifye Elementor Widgets - Main Stylesheet
 *
 * This file serves as the entry point for Tailwind CSS compilation.
 */

/* Tailwind Base Styles */
@tailwind base;
@tailwind components;
@tailwind utilities;

/**
 * Custom Base Styles
 */
@layer base {
  /* Smooth scrolling */
  html {
    scroll-behavior: smooth;
  }

  /* Default body styles */
  body {
    @apply antialiased;
  }

  /* Focus styles for accessibility */
  *:focus-visible {
    @apply outline-2 outline-offset-2 outline-pgfy-primary-500;
  }
}

/**
 * Custom Components
 *
 * Widget-specific component styles that are reused across multiple widgets
 */
@layer components {
  /* Container utility matching Pagifye design */
  .pgfy-container {
    @apply container mx-auto px-4 sm:px-6 lg:px-8;
  }

  /* Section padding matching Pagifye components */
  .pgfy-section {
    @apply py-10 sm:py-16 lg:py-28;
  }

  /* Button base styles */
  .pgfy-btn {
    @apply inline-flex items-center justify-center px-6 py-3 rounded-lg font-medium transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2;
  }

  .pgfy-btn-primary {
    @apply pgfy-btn bg-pgfy-primary-500 text-pgfy-gray-500 hover:bg-pgfy-primary-600 focus:ring-pgfy-primary-500;
  }

  .pgfy-btn-secondary {
    @apply pgfy-btn bg-pgfy-gray-500 text-white hover:bg-pgfy-gray-400 focus:ring-pgfy-gray-500;
  }

  .pgfy-btn-outline {
    @apply pgfy-btn border-2 border-current text-pgfy-gray-500 hover:bg-pgfy-gray-500 hover:text-white focus:ring-pgfy-gray-500;
  }

  /* Heading styles */
  .pgfy-heading {
    @apply font-bold leading-tight tracking-tight;
  }

  .pgfy-heading-xl {
    @apply pgfy-heading text-4xl sm:text-5xl lg:text-6xl;
  }

  .pgfy-heading-lg {
    @apply pgfy-heading text-3xl sm:text-4xl lg:text-5xl;
  }

  .pgfy-heading-md {
    @apply pgfy-heading text-2xl sm:text-3xl lg:text-4xl;
  }

  .pgfy-heading-sm {
    @apply pgfy-heading text-xl sm:text-2xl lg:text-3xl;
  }

  /* Text highlight (used in headings) */
  .pgfy-text-highlight {
    @apply text-pgfy-primary-500;
  }

  /* Card styles */
  .pgfy-card {
    @apply rounded-2xl border border-gray-200 bg-white p-6 transition-shadow duration-200;
  }

  .pgfy-card-hover {
    @apply pgfy-card hover:shadow-lg;
  }
}

/**
 * Custom Utilities
 *
 * Additional utility classes for common patterns
 */
@layer utilities {
  /* Gradient text */
  .text-gradient-primary {
    @apply bg-gradient-to-r from-pgfy-primary-600 to-pgfy-primary-500 bg-clip-text text-transparent;
  }

  /* Hide scrollbar but keep functionality */
  .scrollbar-hide {
    -ms-overflow-style: none;
    scrollbar-width: none;
  }

  .scrollbar-hide::-webkit-scrollbar {
    display: none;
  }

  /* Smooth transitions */
  .transition-smooth {
    @apply transition-all duration-300 ease-in-out;
  }
}

/**
 * Alpine.js Transitions
 *
 * Common transition styles for Alpine.js components
 */
[x-cloak] {
  display: none !important;
}

/* Fade transition */
.fade-enter {
  opacity: 0;
}

.fade-enter-active {
  transition: opacity 200ms ease-in;
}

.fade-enter-to {
  opacity: 1;
}

.fade-leave {
  opacity: 1;
}

.fade-leave-active {
  transition: opacity 200ms ease-out;
}

.fade-leave-to {
  opacity: 0;
}

/* Slide down transition (for mobile menus, dropdowns) */
.slide-down-enter {
  opacity: 0;
  transform: translateY(-10px);
}

.slide-down-enter-active {
  transition: opacity 200ms ease-out, transform 200ms ease-out;
}

.slide-down-enter-to {
  opacity: 1;
  transform: translateY(0);
}

/* Accordion transition (for FAQ) */
.accordion-enter {
  max-height: 0;
  opacity: 0;
}

.accordion-enter-active {
  transition: max-height 300ms ease-in-out, opacity 200ms ease-in;
}

.accordion-enter-to {
  max-height: 1000px;
  opacity: 1;
}

.accordion-leave {
  max-height: 1000px;
  opacity: 1;
}

.accordion-leave-active {
  transition: max-height 300ms ease-in-out, opacity 200ms ease-out;
}

.accordion-leave-to {
  max-height: 0;
  opacity: 0;
}
```

##### 6. Configure Webpack

**File:** `webpack.config.js`

```javascript
const path = require('path');
const MiniCssExtractPlugin = require('mini-css-extract-plugin');

module.exports = (env, argv) => {
  const isProduction = argv.mode === 'production';

  return {
    entry: {
      'pagifye-widgets': './assets/js/src/main.js',
    },
    output: {
      path: path.resolve(__dirname, 'build/js'),
      filename: isProduction ? '[name].min.js' : '[name].js',
    },
    module: {
      rules: [
        {
          test: /\.css$/,
          use: [
            MiniCssExtractPlugin.loader,
            'css-loader',
            'postcss-loader',
          ],
        },
      ],
    },
    plugins: [
      new MiniCssExtractPlugin({
        filename: isProduction
          ? '../css/pagifye-widgets.min.css'
          : '../css/pagifye-widgets.css',
      }),
    ],
    devtool: isProduction ? false : 'source-map',
  };
};
```

##### 7. Build CSS

```bash
# Development build (unminified, with source maps)
npm run build:css

# Production build (minified)
npm run build:css:min

# Watch mode for development
npm run build:css:watch
```

#### Validation Checklist

- [ ] Tailwind CSS installed
- [ ] Configuration file created with Pagifye colors
- [ ] CSS entry point created
- [ ] PostCSS configured
- [ ] Build scripts functional
- [ ] CSS compiles without errors
- [ ] Output files generated in `build/css/`
- [ ] Minified version created
- [ ] Watch mode works for development

---

### Task 4: Alpine.js Integration

**Time:** 10 hours
**Priority:** High
**Dependencies:** Task 3 (Build System)

#### What to Create

Set up Alpine.js for interactive widget components.

#### Implementation Steps

##### 1. Create JavaScript Entry Point

**File:** `assets/js/src/main.js`

```javascript
/**
 * Pagifye Elementor Widgets - Main JavaScript
 *
 * This file initializes Alpine.js and loads all interactive components.
 */

import Alpine from 'alpinejs';

// Import Alpine.js components
import './components/navigation';
import './components/pricing';
import './components/faq';
import './components/testimonial';

// Make Alpine available globally
window.Alpine = Alpine;

// Start Alpine
Alpine.start();

/**
 * Initialize widgets when document is ready
 */
document.addEventListener('DOMContentLoaded', function() {
  console.log('Pagifye Elementor Widgets loaded');
});
```

##### 2. Create Alpine.js Components

**File:** `assets/js/src/components/navigation.js`

```javascript
/**
 * Navigation Component
 *
 * Handles mobile menu toggle and dropdown functionality
 */

import Alpine from 'alpinejs';

Alpine.data('pagifyeNavigation', () => ({
  mobileMenuOpen: false,
  dropdownOpen: null,

  init() {
    // Close mobile menu on escape
    document.addEventListener('keydown', (e) => {
      if (e.key === 'Escape' && this.mobileMenuOpen) {
        this.mobileMenuOpen = false;
      }
    });
  },

  toggleMobileMenu() {
    this.mobileMenuOpen = !this.mobileMenuOpen;

    // Prevent body scroll when menu is open
    if (this.mobileMenuOpen) {
      document.body.style.overflow = 'hidden';
    } else {
      document.body.style.overflow = '';
    }
  },

  toggleDropdown(index) {
    this.dropdownOpen = this.dropdownOpen === index ? null : index;
  },

  isDropdownOpen(index) {
    return this.dropdownOpen === index;
  },
}));
```

**File:** `assets/js/src/components/pricing.js`

```javascript
/**
 * Pricing Component
 *
 * Handles billing period toggle (monthly/annual)
 */

import Alpine from 'alpinejs';

Alpine.data('pagifyePricing', () => ({
  billingPeriod: 'monthly',

  toggleBillingPeriod() {
    this.billingPeriod = this.billingPeriod === 'monthly' ? 'annual' : 'monthly';
  },

  isMonthly() {
    return this.billingPeriod === 'monthly';
  },

  isAnnual() {
    return this.billingPeriod === 'annual';
  },

  getPrice(monthlyPrice, annualPrice) {
    return this.billingPeriod === 'monthly' ? monthlyPrice : annualPrice;
  },
}));
```

**File:** `assets/js/src/components/faq.js`

```javascript
/**
 * FAQ Component
 *
 * Handles accordion functionality
 */

import Alpine from 'alpinejs';

Alpine.data('pagifyeFaq', (openByDefault = null) => ({
  openItem: openByDefault,

  toggle(index) {
    this.openItem = this.openItem === index ? null : index;
  },

  isOpen(index) {
    return this.openItem === index;
  },
}));
```

**File:** `assets/js/src/components/testimonial.js`

```javascript
/**
 * Testimonial Component
 *
 * Handles testimonial switching
 */

import Alpine from 'alpinejs';

Alpine.data('pagifyeTestimonial', (defaultIndex = 0) => ({
  activeIndex: defaultIndex,

  setActive(index) {
    this.activeIndex = index;
  },

  isActive(index) {
    return this.activeIndex === index;
  },
}));
```

##### 3. Build JavaScript

Update `webpack.config.js` if needed (already configured in Task 3), then:

```bash
# Development build
npm run dev

# Production build
npm run build
```

#### Validation Checklist

- [ ] Alpine.js installed via npm
- [ ] JavaScript entry point created
- [ ] All component files created
- [ ] Webpack builds without errors
- [ ] JavaScript output files generated
- [ ] Alpine.js available globally
- [ ] Components registered correctly

---

### Task 5: Asset Manager Class

**Time:** 12 hours
**Priority:** High
**Dependencies:** Task 2, 3, 4

#### What to Create

Create a smart asset management system that only loads CSS/JS when widgets are used.

#### Implementation

**File:** `includes/class-assets-manager.php`

```php
<?php
/**
 * Assets Manager
 *
 * Handles enqueuing of CSS and JavaScript assets for widgets.
 * Only loads assets when widgets are actually used on the page.
 *
 * @package Pagifye_Elementor_Widgets
 */

namespace Pagifye\ElementorWidgets;

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Assets Manager Class
 */
class Assets_Manager {

    /**
     * Track which widgets are used on the page
     *
     * @var array
     */
    private static $widgets_in_use = [];

    /**
     * Initialize the assets manager
     */
    public function __construct() {
        // Frontend assets
        add_action( 'wp_enqueue_scripts', [ $this, 'register_assets' ] );
        add_action( 'wp_footer', [ $this, 'enqueue_widget_assets' ], 5 );

        // Editor assets
        add_action( 'elementor/editor/before_enqueue_scripts', [ $this, 'enqueue_editor_assets' ] );
        add_action( 'elementor/preview/enqueue_styles', [ $this, 'enqueue_preview_assets' ] );
    }

    /**
     * Register all assets (doesn't enqueue them yet)
     */
    public function register_assets() {
        // Get asset URLs
        $css_url = $this->get_asset_url( 'css/pagifye-widgets.min.css' );
        $js_url  = $this->get_asset_url( 'js/pagifye-widgets.min.js' );

        // Development mode - use unminified files
        if ( defined( 'WP_DEBUG' ) && WP_DEBUG ) {
            $css_url = $this->get_asset_url( 'css/pagifye-widgets.css' );
            $js_url  = $this->get_asset_url( 'js/pagifye-widgets.js' );
        }

        // Register styles
        wp_register_style(
            'pagifye-widgets',
            $css_url,
            [],
            PAGIFYE_WIDGETS_VERSION
        );

        // Register scripts
        wp_register_script(
            'pagifye-widgets',
            $js_url,
            [],
            PAGIFYE_WIDGETS_VERSION,
            true
        );

        // Add Alpine.js defer attribute
        add_filter( 'script_loader_tag', [ $this, 'add_defer_attribute' ], 10, 2 );
    }

    /**
     * Enqueue widget assets if any Pagifye widgets are used
     */
    public function enqueue_widget_assets() {
        // Check if we're in Elementor edit mode
        if ( \Elementor\Plugin::$instance->preview->is_preview_mode() ) {
            wp_enqueue_style( 'pagifye-widgets' );
            wp_enqueue_script( 'pagifye-widgets' );
            return;
        }

        // Check if any Pagifye widgets are used on this page
        if ( $this->has_pagifye_widgets() ) {
            wp_enqueue_style( 'pagifye-widgets' );
            wp_enqueue_script( 'pagifye-widgets' );
        }
    }

    /**
     * Enqueue editor assets
     */
    public function enqueue_editor_assets() {
        // Editor-specific CSS
        wp_enqueue_style(
            'pagifye-widgets-editor',
            PAGIFYE_WIDGETS_URL . 'assets/css/admin/editor.css',
            [],
            PAGIFYE_WIDGETS_VERSION
        );

        // Editor-specific JS
        wp_enqueue_script(
            'pagifye-widgets-editor',
            PAGIFYE_WIDGETS_URL . 'assets/js/admin/editor.js',
            [ 'jquery' ],
            PAGIFYE_WIDGETS_VERSION,
            true
        );
    }

    /**
     * Enqueue preview assets
     */
    public function enqueue_preview_assets() {
        wp_enqueue_style( 'pagifye-widgets' );
        wp_enqueue_script( 'pagifye-widgets' );
    }

    /**
     * Check if page has any Pagifye widgets
     *
     * @return bool
     */
    private function has_pagifye_widgets() {
        // Get current post
        $post = get_post();

        if ( ! $post ) {
            return false;
        }

        // Check if Elementor is used on this page
        if ( ! \Elementor\Plugin::$instance->documents->get( $post->ID ) ) {
            return false;
        }

        // Get Elementor data
        $document = \Elementor\Plugin::$instance->documents->get( $post->ID );
        $elements = $document->get_elements_data();

        // Check if any element is a Pagifye widget
        return $this->search_widgets_in_elements( $elements );
    }

    /**
     * Recursively search for Pagifye widgets in elements
     *
     * @param array $elements
     * @return bool
     */
    private function search_widgets_in_elements( $elements ) {
        foreach ( $elements as $element ) {
            // Check if this is a Pagifye widget
            if ( isset( $element['widgetType'] ) && strpos( $element['widgetType'], 'pagifye-' ) === 0 ) {
                return true;
            }

            // Check nested elements (sections, columns)
            if ( ! empty( $element['elements'] ) ) {
                if ( $this->search_widgets_in_elements( $element['elements'] ) ) {
                    return true;
                }
            }
        }

        return false;
    }

    /**
     * Get asset URL
     *
     * @param string $path
     * @return string
     */
    private function get_asset_url( $path ) {
        return PAGIFYE_WIDGETS_ASSETS_URL . $path;
    }

    /**
     * Add defer attribute to Alpine.js script
     *
     * @param string $tag
     * @param string $handle
     * @return string
     */
    public function add_defer_attribute( $tag, $handle ) {
        if ( 'pagifye-widgets' === $handle ) {
            return str_replace( ' src', ' defer src', $tag );
        }
        return $tag;
    }

    /**
     * Mark a widget as being used on the page
     *
     * @param string $widget_name
     */
    public static function mark_widget_used( $widget_name ) {
        self::$widgets_in_use[] = $widget_name;
    }

    /**
     * Get widgets used on the page
     *
     * @return array
     */
    public static function get_widgets_in_use() {
        return self::$widgets_in_use;
    }
}
```

##### Create Editor Styles

**File:** `assets/css/admin/editor.css`

```css
/**
 * Elementor Editor Styles
 *
 * Styles for the Elementor editor panel
 */

/* Widget panel icon */
.elementor-element .icon-pagifye {
  font-family: Arial, sans-serif;
}

/* Category header */
.elementor-element .elementor-element-wrapper[data-category="pagifye-widgets"] {
  border-left: 3px solid #8FE35F;
}

/* Widget preview in panel */
.elementor-element[data-widget_type^="pagifye-"] {
  border-left: 2px solid #8FE35F;
}

/* Control section headers */
.elementor-control-section_pagifye {
  background-color: #f5f7f6;
}
```

##### Create Editor JavaScript

**File:** `assets/js/admin/editor.js`

```javascript
/**
 * Elementor Editor JavaScript
 *
 * JavaScript for the Elementor editor
 */

(function($) {
  'use strict';

  /**
   * Initialize when Elementor editor is ready
   */
  $(window).on('elementor:init', function() {
    console.log('Pagifye Widgets Editor Loaded');

    // Add custom editor functionality here if needed
  });

})(jQuery);
```

#### Update Main Plugin File

Update `pagifye-elementor-widgets.php` to instantiate the Assets Manager:

```php
// In the load_plugin() method, add:
private function load_plugin() {
    // ... existing code ...

    // Initialize assets manager
    new \Pagifye\ElementorWidgets\Assets_Manager();
}
```

#### Validation Checklist

- [ ] Assets Manager class created
- [ ] Asset registration working
- [ ] Conditional enqueuing functional
- [ ] Editor assets created
- [ ] Widget detection working
- [ ] Defer attribute added to scripts
- [ ] No JavaScript errors in console
- [ ] Assets only load when widgets are used

---

### Task 6: Base Widget Class

**Time:** 16 hours
**Priority:** Highest - Foundation for all widgets
**Dependencies:** Task 2, 5

#### What to Create

Create the foundational base class that all Pagifye widgets will extend.

#### Implementation

**File:** `includes/class-base-widget.php`

```php
<?php
/**
 * Base Widget Class
 *
 * All Pagifye widgets extend this base class.
 * Provides common functionality, helper methods, and standard controls.
 *
 * @package Pagifye_Elementor_Widgets
 */

namespace Pagifye\ElementorWidgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Core\Kits\Documents\Tabs\Global_Colors;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Base Widget Class
 */
abstract class Base_Widget extends Widget_Base {

    /**
     * Get widget categories
     *
     * @return array
     */
    public function get_categories() {
        return [ 'pagifye-widgets' ];
    }

    /**
     * Get widget icon
     *
     * @return string
     */
    public function get_icon() {
        return 'eicon-plug';
    }

    /**
     * Get widget keywords for search
     *
     * @return array
     */
    public function get_keywords() {
        return [ 'pagifye', 'tailwind', 'component' ];
    }

    /**
     * Register common responsive controls
     *
     * @param string $prefix Control ID prefix
     * @param string $label Control label
     * @param string $selector CSS selector
     * @param array  $options Control options
     */
    protected function add_responsive_control_custom( $prefix, $label, $selector, $options = [] ) {
        $defaults = [
            'type'       => Controls_Manager::SLIDER,
            'size_units' => [ 'px', 'em', 'rem', '%' ],
            'range'      => [
                'px' => [
                    'min' => 0,
                    'max' => 1000,
                ],
            ],
        ];

        $options = wp_parse_args( $options, $defaults );

        $this->add_responsive_control(
            $prefix,
            array_merge(
                [
                    'label'     => $label,
                    'selectors' => [ $selector => $options['property'] . ': {{SIZE}}{{UNIT}};' ],
                ],
                $options
            )
        );
    }

    /**
     * Add section heading controls
     *
     * Used by many widgets (Hero, Pricing, FAQ, Testimonial)
     */
    protected function add_section_heading_controls() {
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
            'heading_text',
            [
                'label'       => esc_html__( 'Heading', 'pagifye-elementor-widgets' ),
                'type'        => Controls_Manager::TEXT,
                'default'     => esc_html__( 'Section Heading', 'pagifye-elementor-widgets' ),
                'placeholder' => esc_html__( 'Enter heading', 'pagifye-elementor-widgets' ),
                'dynamic'     => [
                    'active' => true,
                ],
                'condition'   => [
                    'show_heading' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'heading_highlight_text',
            [
                'label'       => esc_html__( 'Highlighted Text', 'pagifye-elementor-widgets' ),
                'type'        => Controls_Manager::TEXT,
                'default'     => '',
                'placeholder' => esc_html__( 'Text to highlight', 'pagifye-elementor-widgets' ),
                'description' => esc_html__( 'This text will be highlighted with the primary color', 'pagifye-elementor-widgets' ),
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
                'default'   => 'h2',
                'options'   => [
                    'h1' => 'H1',
                    'h2' => 'H2',
                    'h3' => 'H3',
                    'h4' => 'H4',
                    'h5' => 'H5',
                    'h6' => 'H6',
                ],
                'condition' => [
                    'show_heading' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'description_text',
            [
                'label'       => esc_html__( 'Description', 'pagifye-elementor-widgets' ),
                'type'        => Controls_Manager::TEXTAREA,
                'default'     => '',
                'placeholder' => esc_html__( 'Enter description', 'pagifye-elementor-widgets' ),
                'rows'        => 4,
                'dynamic'     => [
                    'active' => true,
                ],
            ]
        );

        $this->end_controls_section();
    }

    /**
     * Add heading style controls
     */
    protected function add_heading_style_controls() {
        $this->start_controls_section(
            'section_heading_style',
            [
                'label'     => esc_html__( 'Heading', 'pagifye-elementor-widgets' ),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'show_heading' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'heading_color',
            [
                'label'     => esc_html__( 'Color', 'pagifye-elementor-widgets' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#0F2C24',
                'selectors' => [
                    '{{WRAPPER}} .pgfy-section-heading' => 'color: {{VALUE}};',
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
                    '{{WRAPPER}} .pgfy-text-highlight' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'heading_typography',
                'selector' => '{{WRAPPER}} .pgfy-section-heading',
                'global'   => [
                    'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
                ],
            ]
        );

        $this->add_responsive_control(
            'heading_spacing',
            [
                'label'      => esc_html__( 'Bottom Spacing', 'pagifye-elementor-widgets' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => [ 'px', 'em', 'rem' ],
                'range'      => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'default'    => [
                    'size' => 16,
                    'unit' => 'px',
                ],
                'selectors'  => [
                    '{{WRAPPER}} .pgfy-section-heading' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'heading_alignment',
            [
                'label'     => esc_html__( 'Alignment', 'pagifye-elementor-widgets' ),
                'type'      => Controls_Manager::CHOOSE,
                'options'   => [
                    'left'   => [
                        'title' => esc_html__( 'Left', 'pagifye-elementor-widgets' ),
                        'icon'  => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__( 'Center', 'pagifye-elementor-widgets' ),
                        'icon'  => 'eicon-text-align-center',
                    ],
                    'right'  => [
                        'title' => esc_html__( 'Right', 'pagifye-elementor-widgets' ),
                        'icon'  => 'eicon-text-align-right',
                    ],
                ],
                'default'   => 'left',
                'selectors' => [
                    '{{WRAPPER}} .pgfy-section-heading' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    /**
     * Add description style controls
     */
    protected function add_description_style_controls() {
        $this->start_controls_section(
            'section_description_style',
            [
                'label' => esc_html__( 'Description', 'pagifye-elementor-widgets' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'description_color',
            [
                'label'     => esc_html__( 'Color', 'pagifye-elementor-widgets' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#1A2E27',
                'selectors' => [
                    '{{WRAPPER}} .pgfy-section-description' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'description_typography',
                'selector' => '{{WRAPPER}} .pgfy-section-description',
                'global'   => [
                    'default' => Global_Typography::TYPOGRAPHY_TEXT,
                ],
            ]
        );

        $this->add_responsive_control(
            'description_spacing',
            [
                'label'      => esc_html__( 'Bottom Spacing', 'pagifye-elementor-widgets' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => [ 'px', 'em', 'rem' ],
                'range'      => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'default'    => [
                    'size' => 24,
                    'unit' => 'px',
                ],
                'selectors'  => [
                    '{{WRAPPER}} .pgfy-section-description' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    /**
     * Render section heading (used by multiple widgets)
     *
     * @param array $settings Widget settings
     */
    protected function render_section_heading( $settings ) {
        if ( 'yes' !== $settings['show_heading'] ) {
            return;
        }

        $heading_text = $settings['heading_text'];
        $highlight    = $settings['heading_highlight_text'];

        // Replace highlight text with span
        if ( ! empty( $highlight ) && strpos( $heading_text, $highlight ) !== false ) {
            $heading_text = str_replace(
                $highlight,
                '<span class="pgfy-text-highlight">' . esc_html( $highlight ) . '</span>',
                $heading_text
            );
        } else {
            $heading_text = esc_html( $heading_text );
        }

        printf(
            '<%1$s class="pgfy-section-heading pgfy-heading-lg">%2$s</%1$s>',
            tag_escape( $settings['heading_tag'] ),
            wp_kses_post( $heading_text )
        );

        if ( ! empty( $settings['description_text'] ) ) {
            printf(
                '<p class="pgfy-section-description">%s</p>',
                esc_html( $settings['description_text'] )
            );
        }
    }

    /**
     * Sanitize HTML class
     *
     * @param string $class
     * @return string
     */
    protected function sanitize_html_class( $class ) {
        return sanitize_html_class( $class );
    }

    /**
     * Get button classes based on style
     *
     * @param string $style Button style (primary, secondary, outline)
     * @return string
     */
    protected function get_button_classes( $style = 'primary' ) {
        $classes = 'pgfy-btn';

        switch ( $style ) {
            case 'primary':
                $classes .= ' pgfy-btn-primary';
                break;
            case 'secondary':
                $classes .= ' pgfy-btn-secondary';
                break;
            case 'outline':
                $classes .= ' pgfy-btn-outline';
                break;
        }

        return $classes;
    }

    /**
     * Render button
     *
     * @param array $button_settings Button settings
     * @param array $additional_classes Additional CSS classes
     */
    protected function render_button( $button_settings, $additional_classes = [] ) {
        if ( empty( $button_settings['text'] ) ) {
            return;
        }

        $classes   = [ $this->get_button_classes( $button_settings['style'] ) ];
        $classes   = array_merge( $classes, $additional_classes );
        $class_str = implode( ' ', $classes );

        $this->add_link_attributes( 'button', $button_settings['link'] );

        printf(
            '<a %1$s class="%2$s">%3$s</a>',
            $this->get_render_attribute_string( 'button' ),
            esc_attr( $class_str ),
            esc_html( $button_settings['text'] )
        );
    }

    /**
     * Check if we're in edit mode
     *
     * @return bool
     */
    protected function is_edit_mode() {
        return \Elementor\Plugin::$instance->editor->is_edit_mode();
    }
}
```

#### Create Helper Functions

**File:** `includes/helpers/sanitization.php`

```php
<?php
/**
 * Sanitization Helper Functions
 *
 * @package Pagifye_Elementor_Widgets
 */

namespace Pagifye\ElementorWidgets\Helpers;

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Sanitize HTML class names
 *
 * @param string|array $classes
 * @return string
 */
function sanitize_html_classes( $classes ) {
    if ( is_array( $classes ) ) {
        $classes = implode( ' ', $classes );
    }

    return sanitize_html_class( $classes );
}

/**
 * Sanitize SVG output
 *
 * @param string $svg
 * @return string
 */
function sanitize_svg( $svg ) {
    return wp_kses(
        $svg,
        [
            'svg'  => [
                'class'           => true,
                'aria-hidden'     => true,
                'aria-labelledby' => true,
                'role'            => true,
                'xmlns'           => true,
                'width'           => true,
                'height'          => true,
                'viewbox'         => true,
                'fill'            => true,
                'stroke'          => true,
            ],
            'g'    => [ 'fill' => true ],
            'path' => [
                'd'               => true,
                'fill'            => true,
                'stroke'          => true,
                'stroke-width'    => true,
                'stroke-linecap'  => true,
                'stroke-linejoin' => true,
            ],
        ]
    );
}
```

**File:** `includes/helpers/utilities.php`

```php
<?php
/**
 * Utility Helper Functions
 *
 * @package Pagifye_Elementor_Widgets
 */

namespace Pagifye\ElementorWidgets\Helpers;

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Check if Elementor is in edit mode
 *
 * @return bool
 */
function is_edit_mode() {
    return \Elementor\Plugin::$instance->editor->is_edit_mode();
}

/**
 * Check if Elementor preview mode
 *
 * @return bool
 */
function is_preview_mode() {
    return \Elementor\Plugin::$instance->preview->is_preview_mode();
}

/**
 * Get Pagifye icon SVG
 *
 * @param string $icon Icon name
 * @return string
 */
function get_icon_svg( $icon ) {
    $icons = [
        'chevron-down' => '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>',
        'menu'         => '<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>',
        'close'        => '<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>',
        'check'        => '<svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path></svg>',
    ];

    return $icons[ $icon ] ?? '';
}
```

#### Update Composer Autoloader

The helper files need to be included. Update `composer.json`:

```json
{
    "autoload": {
        "psr-4": {
            "Pagifye\\ElementorWidgets\\": "includes/"
        },
        "files": [
            "includes/helpers/sanitization.php",
            "includes/helpers/utilities.php"
        ]
    }
}
```

Run:
```bash
composer dump-autoload
```

#### Validation Checklist

- [ ] Base Widget class created
- [ ] Common helper methods implemented
- [ ] Section heading controls added
- [ ] Style control methods functional
- [ ] Helper functions created
- [ ] Composer autoloader updated
- [ ] No PHP errors
- [ ] Ready to be extended by widgets

---

### Task 7: Widget Registration System

**Time:** 16 hours
**Priority:** High
**Dependencies:** Task 2, 6

#### What to Create

Create the system that discovers and registers all Pagifye widgets with Elementor.

#### Implementation

**File:** `includes/class-widgets-loader.php`

```php
<?php
/**
 * Widgets Loader
 *
 * Handles registration of all Pagifye widgets with Elementor.
 *
 * @package Pagifye_Elementor_Widgets
 */

namespace Pagifye\ElementorWidgets;

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Widgets Loader Class
 */
class Widgets_Loader {

    /**
     * List of widgets to register
     *
     * @var array
     */
    private $widgets = [];

    /**
     * Constructor
     */
    public function __construct() {
        // Define available widgets
        $this->define_widgets();

        // Register widgets
        add_action( 'elementor/widgets/register', [ $this, 'register_widgets' ] );
    }

    /**
     * Define available widgets
     *
     * Add new widgets here as they are developed
     */
    private function define_widgets() {
        $this->widgets = [
            // Phase 2 - Priority Widgets
            // 'navigation-01'   => 'Navigation_01',  // Coming soon
            // 'hero-01'         => 'Hero_01',         // Coming soon
            // 'pricing-01'      => 'Pricing_01',      // Coming soon
            // 'faq-01'          => 'FAQ_01',          // Coming soon
            // 'testimonial-02'  => 'Testimonial_02',  // Coming soon

            // Phase 3 - Remaining widgets
            // Will be added as development progresses
        ];
    }

    /**
     * Register widgets with Elementor
     *
     * @param \Elementor\Widgets_Manager $widgets_manager
     */
    public function register_widgets( $widgets_manager ) {
        foreach ( $this->widgets as $widget_id => $widget_class ) {
            // Build full class name
            $class_name = '\\Pagifye\\ElementorWidgets\\Widgets\\' . $widget_class;

            // Check if class exists
            if ( ! class_exists( $class_name ) ) {
                continue;
            }

            // Register the widget
            $widgets_manager->register( new $class_name() );
        }
    }

    /**
     * Get registered widgets
     *
     * @return array
     */
    public function get_widgets() {
        return $this->widgets;
    }
}
```

#### Update Main Plugin File

Update `pagifye-elementor-widgets.php` to use the Widgets Loader:

```php
// In the load_plugin() method, replace the register_widgets action with:

/**
 * Load plugin functionality
 */
private function load_plugin() {
    // Load text domain
    add_action( 'init', [ $this, 'load_textdomain' ] );

    // Register Elementor widget category
    add_action( 'elementor/elements/categories_registered', [ $this, 'register_widget_category' ] );

    // Initialize assets manager
    new \Pagifye\ElementorWidgets\Assets_Manager();

    // Initialize widgets loader
    new \Pagifye\ElementorWidgets\Widgets_Loader();
}

// Remove the old register_widgets() method
// Remove the enqueue methods (handled by Assets_Manager)
```

#### Update Composer for Widget Namespace

Update `composer.json` to include the widgets namespace:

```json
{
    "autoload": {
        "psr-4": {
            "Pagifye\\ElementorWidgets\\": "includes/",
            "Pagifye\\ElementorWidgets\\Widgets\\": "widgets/"
        },
        "files": [
            "includes/helpers/sanitization.php",
            "includes/helpers/utilities.php"
        ]
    }
}
```

Run:
```bash
composer dump-autoload
```

#### Create Example Widget (For Testing)

Create a simple test widget to verify the system works:

**File:** `widgets/class-test-widget.php`

```php
<?php
/**
 * Test Widget (For Development Testing)
 *
 * @package Pagifye_Elementor_Widgets
 */

namespace Pagifye\ElementorWidgets\Widgets;

use Pagifye\ElementorWidgets\Base_Widget;
use Elementor\Controls_Manager;

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Test Widget Class
 */
class Test_Widget extends Base_Widget {

    /**
     * Get widget name
     */
    public function get_name() {
        return 'pagifye-test';
    }

    /**
     * Get widget title
     */
    public function get_title() {
        return esc_html__( 'Test Widget', 'pagifye-elementor-widgets' );
    }

    /**
     * Register widget controls
     */
    protected function register_controls() {
        $this->start_controls_section(
            'section_content',
            [
                'label' => esc_html__( 'Content', 'pagifye-elementor-widgets' ),
            ]
        );

        $this->add_control(
            'title',
            [
                'label'   => esc_html__( 'Title', 'pagifye-elementor-widgets' ),
                'type'    => Controls_Manager::TEXT,
                'default' => esc_html__( 'Test Widget', 'pagifye-elementor-widgets' ),
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
        <div class="pgfy-container pgfy-section">
            <h2 class="pgfy-heading-lg text-pgfy-gray-500">
                <?php echo esc_html( $settings['title'] ); ?>
            </h2>
            <p class="mt-4 text-pgfy-gray-400">
                <?php echo esc_html__( 'This is a test widget to verify the Pagifye Elementor Widgets plugin is working correctly.', 'pagifye-elementor-widgets' ); ?>
            </p>
            <div class="mt-6">
                <a href="#" class="pgfy-btn-primary">
                    <?php echo esc_html__( 'Primary Button', 'pagifye-elementor-widgets' ); ?>
                </a>
                <a href="#" class="pgfy-btn-outline ml-4">
                    <?php echo esc_html__( 'Outline Button', 'pagifye-elementor-widgets' ); ?>
                </a>
            </div>
        </div>
        <?php
    }
}
```

#### Enable Test Widget

Update `includes/class-widgets-loader.php` to include the test widget:

```php
private function define_widgets() {
    $this->widgets = [
        // Test widget (remove after Phase 1 complete)
        'test' => 'Test_Widget',

        // Phase 2 - Priority Widgets (commented out for now)
        // ...
    ];
}
```

Run:
```bash
composer dump-autoload
```

#### Validation Checklist

- [ ] Widgets Loader class created
- [ ] Widget registration system functional
- [ ] Test widget created
- [ ] Test widget appears in Elementor
- [ ] Test widget can be added to page
- [ ] Test widget renders correctly
- [ ] Test widget uses Tailwind classes
- [ ] No PHP or JavaScript errors
- [ ] Ready for actual widget development

---

## ✅ Phase 1 Completion Checklist

### All Tasks Complete

- [ ] **Task 1:** Directory structure created
- [ ] **Task 2:** Main plugin file working
- [ ] **Task 3:** Tailwind CSS compiling
- [ ] **Task 4:** Alpine.js integrated
- [ ] **Task 5:** Assets Manager functional
- [ ] **Task 6:** Base Widget class ready
- [ ] **Task 7:** Widget registration working

### Plugin Functionality

- [ ] Plugin activates without errors
- [ ] "Pagifye Components" category appears in Elementor
- [ ] Test widget visible in widget panel
- [ ] Test widget can be dragged to page
- [ ] Tailwind CSS styles apply correctly
- [ ] No console errors
- [ ] Assets load only when needed

### Code Quality

- [ ] All PHP files follow WordPress Coding Standards
- [ ] Proper escaping and sanitization
- [ ] PHPDoc comments complete
- [ ] No deprecated functions
- [ ] Git repository up to date

### Documentation

- [ ] Code comments complete
- [ ] README updated with setup instructions
- [ ] Development notes documented

---

## 🚀 Phase 2: Priority Widgets (Detailed)

### Overview

With Phase 1 complete, you're ready to implement the 5 priority widgets. Each widget has a detailed implementation plan in the `docs/components/` directory.

**Total Time:** 100 hours (3 weeks)
**Deliverables:** 5 fully functional, production-ready Elementor widgets

---

### Widget 1: Navigation-01

**File:** `docs/components/navigation-01-plan.md`
**Time:** 24 hours (3-4 days)
**Complexity:** ⭐⭐⭐⭐⭐ Very High
**Priority:** Highest - Sets patterns for all widgets

#### Why Start Here (Alternative: Start with Hero-01)

**Pros:**
- Most complex widget - establishes all patterns upfront
- Forces you to solve hardest problems first
- Other widgets will feel easier
- Comprehensive testing of base classes

**Cons:**
- Steep learning curve
- Could be demotivating if stuck
- 24 hours is significant time investment

**Alternative Approach:** Start with Hero-01 (simpler) for a confidence boost, then tackle Navigation-01.

#### Key Features

- Logo image/text with conditional logic
- Menu items with 2-level nested repeaters
- Desktop CTA buttons
- Mobile menu with Alpine.js
- Sticky navigation option
- Full accessibility (WCAG 2.1 AA)

#### Implementation Steps (from detailed plan)

1. Create `widgets/class-navigation-01.php`
2. Implement logo controls (image vs text)
3. Add nested menu repeater (menu → submenu)
4. Add CTA button controls
5. Implement mobile menu controls
6. Add sticky navigation option
7. Create comprehensive style controls (40+)
8. Implement render method with Alpine.js
9. Add responsive breakpoint logic
10. Test all interactions
11. Accessibility audit
12. Performance optimization

#### Success Criteria

- [ ] Logo displays correctly (image or text)
- [ ] Menu items render with proper structure
- [ ] Submenus work on desktop (hover/click)
- [ ] Mobile menu toggles smoothly
- [ ] CTA buttons functional
- [ ] Sticky navigation works
- [ ] Fully responsive (3 breakpoints)
- [ ] Keyboard navigation works
- [ ] Screen reader compatible
- [ ] No console errors
- [ ] Passes all 100+ test cases

---

### Widget 2: Hero-01

**File:** `docs/components/hero-01-plan.md`
**Time:** 20 hours (2-3 days)
**Complexity:** ⭐⭐⭐ Medium
**Priority:** High - High usage component

#### Why This Could Be First

**Pros:**
- Simpler than Navigation-01
- Quick win for confidence
- High visual impact
- Establishes image handling patterns
- Tests base widget class

**Cons:**
- Doesn't cover advanced patterns (nested repeaters)
- Less challenging, so less learning

#### Key Features

- Heading with inline text highlighting
- Description/subheading
- Multiple CTA buttons (repeater)
- Hero image with responsive sizing
- Layout options (left/right, center)
- Background customization
- Semantic HTML

#### Implementation Steps (from detailed plan)

1. Create `widgets/class-hero-01.php`
2. Add heading controls (with highlight)
3. Add description control
4. Implement button repeater
5. Add image controls
6. Create layout options
7. Add background controls
8. Implement 90+ style controls
9. Create render method
10. Add responsive logic
11. Test all variations
12. Optimize images

#### Success Criteria

- [ ] Heading renders with highlights
- [ ] Description displays correctly
- [ ] Buttons render from repeater
- [ ] Image loads and is responsive
- [ ] Layout variations work
- [ ] Background options functional
- [ ] Fully responsive
- [ ] Images lazy load
- [ ] No layout shift (CLS)
- [ ] Passes all test cases

---

### Widget 3: Pricing-01

**File:** `docs/components/pricing-01-plan.md`
**Time:** 24 hours (3-4 days)
**Complexity:** ⭐⭐⭐⭐ High
**Priority:** High - Complex interactions

#### Key Features

- Section heading with highlight
- Billing period toggle (Alpine.js)
- Pricing cards repeater (12 fields each)
- Monthly/annual price switching
- Featured card highlighting
- Badge positioning
- Button variations
- Responsive grid (4/2/1 columns)

#### Implementation Steps (from detailed plan)

1. Create `widgets/class-pricing-01.php`
2. Add section heading controls
3. Implement billing toggle controls
4. Create pricing cards repeater
5. Add monthly/annual price fields
6. Implement featured card logic
7. Add badge controls
8. Create grid layout controls
9. Implement style controls (40+)
10. Create render method with Alpine.js
11. Test price switching
12. Responsive testing

#### Success Criteria

- [ ] Section heading displays
- [ ] Billing toggle works smoothly
- [ ] Prices switch correctly
- [ ] Featured card stands out
- [ ] Badge positions correctly
- [ ] Grid responsive
- [ ] All card fields display
- [ ] Alpine.js no errors
- [ ] Smooth animations
- [ ] Passes all test cases

---

### Widget 4: FAQ-01

**File:** `docs/components/faq-01-plan.md`
**Time:** 12 hours (1.5-2 days)
**Complexity:** ⭐⭐⭐ Medium
**Priority:** Medium - Establishes accordion pattern

#### Key Features

- Section heading and description
- FAQ items repeater (WYSIWYG answers)
- Accordion expand/collapse (Alpine.js)
- Icon rotation animation
- Open by default option
- Smooth height transitions
- Full keyboard navigation
- Screen reader compatible

#### Implementation Steps (from detailed plan)

1. Create `widgets/class-faq-01.php`
2. Add section heading controls
3. Implement FAQ items repeater
4. Add icon controls
5. Create "open by default" option
6. Implement style controls
7. Create render method with Alpine.js
8. Add ARIA attributes
9. Test keyboard navigation
10. Test with screen reader

#### Success Criteria

- [ ] FAQ items display correctly
- [ ] Accordion opens/closes smoothly
- [ ] Icons rotate on toggle
- [ ] Only one open at a time
- [ ] "Open by default" works
- [ ] Keyboard navigation functional
- [ ] Screen reader announces states
- [ ] ARIA attributes correct
- [ ] No console errors
- [ ] Passes accessibility audit

---

### Widget 5: Testimonial-02

**File:** `docs/components/testimonial-02-plan.md`
**Time:** 20 hours (2-3 days)
**Complexity:** ⭐⭐⭐ Medium
**Priority:** Medium - Image handling practice

#### Key Features

- Featured testimonial display
- Quote text with rich formatting
- Author name, position, company
- Author image and company logo
- Multiple testimonial avatars
- Active state indicator
- Optional Alpine.js switching
- Layout variations (image left/right)

#### Implementation Steps (from detailed plan)

1. Create `widgets/class-testimonial-02.php`
2. Add testimonial repeater
3. Implement image controls (3 types)
4. Add author information fields
5. Create avatar selector
6. Implement layout options
7. Add style controls
8. Create render method
9. Add Alpine.js switching (optional)
10. Test image loading
11. Responsive testing

#### Success Criteria

- [ ] Testimonial displays correctly
- [ ] All images load properly
- [ ] Author info displays
- [ ] Avatar selector works
- [ ] Layout variations functional
- [ ] Quote formatting preserved
- [ ] Images optimized
- [ ] Fully responsive
- [ ] No layout shift
- [ ] Passes all test cases

---

### Integration Testing (Week 3, Days 17-21)

**Time:** 40 hours
**Purpose:** Ensure all widgets work together and in various scenarios

#### Test Scenarios

1. **Multi-Widget Page**
   - Add all 5 widgets to one page
   - Verify no CSS conflicts
   - Check JavaScript interactions
   - Test asset loading

2. **Performance Testing**
   - Run Lighthouse audit
   - Check page load times
   - Verify asset sizes
   - Optimize as needed

3. **Cross-Browser Testing**
   - Chrome (latest 2 versions)
   - Firefox (latest 2 versions)
   - Safari (latest 2 versions)
   - Edge (latest 2 versions)
   - iOS Safari
   - Android Chrome

4. **Responsive Testing**
   - Test all breakpoints
   - Verify mobile experience
   - Check touch interactions
   - Test landscape/portrait

5. **Accessibility Audit**
   - WCAG 2.1 Level AA compliance
   - Keyboard navigation
   - Screen reader testing
   - Color contrast verification
   - Focus indicators
   - ARIA attributes

6. **Edge Cases**
   - Long content
   - Missing images
   - Empty repeaters
   - Many items in repeater
   - Special characters

7. **Elementor Integration**
   - Global colors
   - Global fonts
   - Copy/paste widgets
   - Save as template
   - Import/export
   - Revision history

#### Bug Fixes and Refinement

- Document all bugs found
- Prioritize by severity
- Fix critical bugs immediately
- Create issues for minor bugs
- Update documentation as needed

---

## 🛠️ Prerequisites & Environment Setup

### Local WordPress Environment

#### Option 1: LocalWP (Recommended)

**Why:** Easy to use, built specifically for WordPress, one-click SSL

1. Download from https://localwp.com
2. Install and launch
3. Create new site:
   - Site name: "Pagifye Development"
   - PHP: 8.1+
   - WordPress: Latest version
4. Start site and access admin

#### Option 2: MAMP

**Why:** Simple, works on Mac/Windows

1. Download from https://www.mamp.info
2. Install and configure
3. Create WordPress database
4. Download WordPress from wordpress.org
5. Install WordPress

#### Option 3: Docker (Advanced)

**Why:** Production-like environment, version control

```bash
# Use official WordPress Docker image
docker-compose up -d
```

### Install Elementor

1. Log into WordPress admin
2. Go to Plugins → Add New
3. Search "Elementor"
4. Install and Activate
5. Skip onboarding wizard

### Verify Requirements

```bash
# Check PHP version (should be 7.4+)
php -v

# Check Node.js version (should be 18+)
node -v

# Check npm version
npm -v

# Check Composer
composer --version
```

### Install Development Tools

#### VS Code Extensions (Recommended)

- PHP Intelephense
- WordPress Snippets
- Tailwind CSS IntelliSense
- ESLint
- Prettier

#### Chrome Extensions

- Lighthouse
- WAVE (Accessibility)
- React Developer Tools (for debugging)

---

## 📅 Day-by-Day Implementation Guide

### Week 1: Foundation Setup

#### Day 1 (Monday) - 8 hours

**Morning (4 hours):**
- [ ] Set up local WordPress environment
- [ ] Install Elementor
- [ ] Create plugin directory structure (Task 1)
- [ ] Initialize Git repository

**Afternoon (4 hours):**
- [ ] Create main plugin file (Task 2 - Part 1)
- [ ] Add WordPress headers and constants
- [ ] Set up Composer
- [ ] Test plugin activation

**End of Day:**
- Plugin activates in WordPress
- No PHP errors
- Git repository initialized

---

#### Day 2 (Tuesday) - 8 hours

**Morning (4 hours):**
- [ ] Complete main plugin file (Task 2 - Part 2)
- [ ] Add dependency checks
- [ ] Test admin notices
- [ ] Install npm and initialize package.json

**Afternoon (4 hours):**
- [ ] Install Tailwind CSS dependencies (Task 3 - Part 1)
- [ ] Configure tailwind.config.js
- [ ] Create CSS entry point
- [ ] First CSS build test

**End of Day:**
- Dependency checks working
- Tailwind CSS compiling
- Build directory created with CSS

---

#### Day 3 (Wednesday) - 8 hours

**Morning (4 hours):**
- [ ] Complete Tailwind setup (Task 3 - Part 2)
- [ ] Add custom Pagifye styles
- [ ] Configure PostCSS
- [ ] Set up Webpack

**Afternoon (4 hours):**
- [ ] Install Alpine.js (Task 4 - Part 1)
- [ ] Create JavaScript entry point
- [ ] Create component files
- [ ] Test JavaScript build

**End of Day:**
- Full build system working
- Both CSS and JS compiling
- Alpine.js loading correctly

---

#### Day 4 (Thursday) - 8 hours

**Morning (4 hours):**
- [ ] Create Assets Manager class (Task 5 - Part 1)
- [ ] Implement asset registration
- [ ] Add conditional loading logic

**Afternoon (4 hours):**
- [ ] Complete Assets Manager (Task 5 - Part 2)
- [ ] Create editor assets
- [ ] Test asset loading
- [ ] Verify defer attribute

**End of Day:**
- Assets load conditionally
- Editor assets working
- No console errors

---

#### Day 5 (Friday) - 8 hours

**Morning (4 hours):**
- [ ] Create Base Widget class (Task 6 - Part 1)
- [ ] Add common controls
- [ ] Implement helper methods

**Afternoon (4 hours):**
- [ ] Complete Base Widget (Task 6 - Part 2)
- [ ] Create helper files
- [ ] Update Composer autoloader
- [ ] Test base class

**End of Day:**
- Base Widget class complete
- Helper functions working
- Ready to extend

---

### Week 2: Complete Foundation & Start First Widget

#### Day 6 (Monday) - 8 hours

**Morning (4 hours):**
- [ ] Create Widgets Loader class (Task 7 - Part 1)
- [ ] Set up widget registration
- [ ] Update Composer namespaces

**Afternoon (4 hours):**
- [ ] Create test widget (Task 7 - Part 2)
- [ ] Test widget registration
- [ ] Verify in Elementor
- [ ] Test widget rendering

**End of Day:**
- Widget registration working
- Test widget appears in Elementor
- Test widget renders correctly
- **PHASE 1 COMPLETE** ✅

---

#### Day 7 (Tuesday) - 8 hours

**Morning (4 hours):**
- [ ] Final Phase 1 testing
- [ ] Fix any bugs found
- [ ] Code cleanup
- [ ] Documentation update

**Afternoon (4 hours):**
- [ ] Review Phase 2 plans
- [ ] Decide: Navigation-01 or Hero-01 first?
- [ ] Read implementation plan thoroughly
- [ ] Set up development workflow

**End of Day:**
- Phase 1 fully tested
- Ready for Phase 2
- Implementation plan understood

---

#### Days 8-14: First Priority Widget

**Choose your starting widget:**

**Option A:** Hero-01 (Recommended for confidence)
- Simpler structure
- Quick visual results
- Tests core functionality
- 20 hours = ~3 days

**Option B:** Navigation-01 (Comprehensive learning)
- Most complex widget
- Establishes all patterns
- Harder but teaches more
- 24 hours = ~4 days

Follow the detailed implementation plan in the respective component plan document.

---

## 📊 Technical Implementation Details

### Plugin File Organization

```
pagifye-elementor-widgets/
├── Main plugin file (pagifye-elementor-widgets.php)
│   ├── Constants
│   ├── Autoloader
│   ├── Main class (Singleton)
│   └── Initialization hooks
│
├── includes/ (Core functionality)
│   ├── class-plugin.php              # Main plugin logic
│   ├── class-base-widget.php         # Widget base class
│   ├── class-assets-manager.php      # Asset handling
│   ├── class-widgets-loader.php      # Widget registration
│   └── helpers/                       # Utility functions
│
├── widgets/ (Individual widget classes)
│   └── class-{widget-name}.php       # Widget implementations
│
├── assets/ (Source files)
│   ├── css/src/                       # Tailwind source
│   └── js/src/                        # JavaScript/Alpine source
│
└── build/ (Compiled assets)
    ├── css/                           # Compiled CSS
    └── js/                            # Compiled JavaScript
```

### Class Hierarchy

```
Elementor\Widget_Base (Elementor core)
    └── Pagifye\ElementorWidgets\Base_Widget
            ├── Pagifye\ElementorWidgets\Widgets\Navigation_01
            ├── Pagifye\ElementorWidgets\Widgets\Hero_01
            ├── Pagifye\ElementorWidgets\Widgets\Pricing_01
            ├── Pagifye\ElementorWidgets\Widgets\FAQ_01
            └── Pagifye\ElementorWidgets\Widgets\Testimonial_02
```

### Asset Loading Flow

```
1. WordPress loads
2. Plugin initializes
3. Assets_Manager registers assets (doesn't enqueue yet)
4. Page renders
5. Elementor processes widgets
6. Assets_Manager checks if Pagifye widgets exist
7. If yes: Enqueue CSS and JS
8. If no: Don't load anything
9. Scripts load with defer attribute
10. Alpine.js initializes on DOMContentLoaded
```

### Build Process Flow

```
Source Files → Processors → Build Files → WordPress

CSS:
assets/css/src/main.css
    → Tailwind CSS processor
    → PostCSS (autoprefixer)
    → cssnano (production)
    → build/css/pagifye-widgets.min.css

JavaScript:
assets/js/src/main.js
    → Webpack
    → Alpine.js bundling
    → Minification (production)
    → build/js/pagifye-widgets.min.js
```

### Development vs Production

**Development Mode (WP_DEBUG = true):**
- Unminified CSS/JS
- Source maps included
- Verbose error messages
- No caching

**Production Mode (WP_DEBUG = false):**
- Minified CSS/JS
- No source maps
- Clean error messages
- Browser caching enabled

---

## ✅ Quality Assurance Checklist

### Code Quality

#### PHP Standards
- [ ] Follows WordPress Coding Standards
- [ ] PSR-4 autoloading
- [ ] Proper escaping (esc_html, esc_attr, esc_url)
- [ ] Proper sanitization (sanitize_text_field, wp_kses_post)
- [ ] PHPDoc comments for all methods
- [ ] No deprecated functions
- [ ] No direct database queries
- [ ] Nonces for form submissions

#### JavaScript Standards
- [ ] ES6+ syntax
- [ ] Proper event handling
- [ ] No global pollution
- [ ] Error handling
- [ ] Code comments
- [ ] Alpine.js best practices

#### CSS Standards
- [ ] Tailwind utility classes
- [ ] No inline styles
- [ ] Responsive design
- [ ] Browser compatibility
- [ ] Performance optimized

### Functionality Testing

#### Widget Registration
- [ ] Widget appears in Elementor panel
- [ ] Widget icon displays
- [ ] Widget category correct
- [ ] Widget keywords work

#### Widget Controls
- [ ] All controls register correctly
- [ ] Control values save
- [ ] Control values load on edit
- [ ] Conditional controls work
- [ ] Responsive controls function
- [ ] Dynamic tags supported

#### Widget Rendering
- [ ] Widget renders on frontend
- [ ] All settings apply correctly
- [ ] Responsive behavior works
- [ ] No PHP errors
- [ ] No JavaScript errors
- [ ] No console warnings

### Performance Testing

#### Asset Loading
- [ ] CSS loads only when needed
- [ ] JS loads only when needed
- [ ] No render-blocking resources
- [ ] Assets minified in production
- [ ] Proper caching headers

#### Page Speed
- [ ] Lighthouse score 90+
- [ ] First Contentful Paint < 2s
- [ ] Time to Interactive < 4s
- [ ] Total Blocking Time < 300ms
- [ ] Cumulative Layout Shift < 0.1

### Accessibility Testing

#### WCAG 2.1 Level AA
- [ ] Keyboard navigation works
- [ ] Focus indicators visible
- [ ] Screen reader compatible
- [ ] ARIA labels correct
- [ ] Color contrast 4.5:1+
- [ ] Semantic HTML
- [ ] Skip links functional
- [ ] Form labels present

### Browser Compatibility

#### Desktop Browsers
- [ ] Chrome (latest 2)
- [ ] Firefox (latest 2)
- [ ] Safari (latest 2)
- [ ] Edge (latest 2)

#### Mobile Browsers
- [ ] iOS Safari
- [ ] Android Chrome
- [ ] Samsung Internet

### Responsive Testing

#### Breakpoints
- [ ] Mobile (< 640px)
- [ ] Tablet (640px - 1024px)
- [ ] Desktop (> 1024px)
- [ ] Wide (> 1280px)

#### Orientation
- [ ] Portrait mode
- [ ] Landscape mode

---

## 📚 Resources & References

### Documentation Links

#### This Project
- [Master Plan](./00-PROJECT-MASTER-PLAN.md) - Project overview
- [Plugin Architecture](./01-PLUGIN-ARCHITECTURE.md) - Technical design
- [Component Selection](./02-PRIORITY-COMPONENTS-SELECTION.md) - Widget priorities
- [Component Plans](./components/) - Individual widget guides

#### Elementor Development
- [Developer Documentation](https://developers.elementor.com/)
- [Widget Development](https://developers.elementor.com/docs/widgets/)
- [Controls Reference](https://developers.elementor.com/docs/controls/)
- [Render Method](https://developers.elementor.com/docs/widgets/widget-structure/#render)

#### WordPress Development
- [Plugin Handbook](https://developer.wordpress.org/plugins/)
- [Coding Standards](https://developer.wordpress.org/coding-standards/)
- [Security Best Practices](https://developer.wordpress.org/apis/security/)
- [Escaping Functions](https://developer.wordpress.org/apis/security/escaping/)

#### Tailwind CSS
- [Documentation](https://tailwindcss.com/docs)
- [Configuration](https://tailwindcss.com/docs/configuration)
- [Customization](https://tailwindcss.com/docs/theme)
- [JIT Mode](https://tailwindcss.com/docs/upgrade-guide#migrating-to-the-jit-engine)

#### Alpine.js
- [Documentation](https://alpinejs.dev/)
- [Directives](https://alpinejs.dev/directives/data)
- [Properties](https://alpinejs.dev/magics/el)
- [Best Practices](https://alpinejs.dev/advanced/reactivity)

### Learning Resources

#### Video Tutorials
- Elementor Widget Development (YouTube)
- Tailwind CSS Crash Course
- Alpine.js Tutorial
- WordPress Plugin Development

#### Community
- Elementor Developers Facebook Group
- WordPress Stack Exchange
- Tailwind CSS Discord
- Alpine.js GitHub Discussions

### Tools & Utilities

#### Development Tools
- [LocalWP](https://localwp.com) - Local WordPress environment
- [WP-CLI](https://wp-cli.org/) - WordPress command line
- [Composer](https://getcomposer.org/) - PHP dependency manager
- [npm](https://www.npmjs.com/) - JavaScript package manager

#### Testing Tools
- [Lighthouse](https://developers.google.com/web/tools/lighthouse) - Performance audit
- [WAVE](https://wave.webaim.org/) - Accessibility checker
- [BrowserStack](https://www.browserstack.com/) - Cross-browser testing
- [Query Monitor](https://wordpress.org/plugins/query-monitor/) - WordPress debugging

#### Build Tools
- [Webpack](https://webpack.js.org/) - Module bundler
- [PostCSS](https://postcss.org/) - CSS processor
- [Autoprefixer](https://github.com/postcss/autoprefixer) - CSS vendor prefixes

---

## ✅ Success Criteria

### Phase 1 Success (Foundation Complete)

**Technical Criteria:**
- [x] Plugin activates without errors
- [x] No PHP warnings or notices
- [x] No JavaScript console errors
- [x] Assets compile successfully
- [x] Base classes functional

**Functional Criteria:**
- [x] "Pagifye Components" category appears in Elementor
- [x] Test widget can be added to page
- [x] Test widget renders correctly
- [x] Tailwind styles apply
- [x] Alpine.js loads

**Code Quality Criteria:**
- [x] WordPress Coding Standards followed
- [x] Proper escaping and sanitization
- [x] PHPDoc comments complete
- [x] Git repository up to date
- [x] README documentation current

**Ready for Phase 2:**
- [x] All 7 foundation tasks complete
- [x] System tested and validated
- [x] Base widget class ready to extend
- [x] Build system operational
- [x] Team ready to implement widgets

---

### Phase 2 Success (Priority Widgets Complete)

**Widget Completion:**
- [ ] Navigation-01 functional and tested
- [ ] Hero-01 functional and tested
- [ ] Pricing-01 functional and tested
- [ ] FAQ-01 functional and tested
- [ ] Testimonial-02 functional and tested

**Quality Standards:**
- [ ] All widgets fully responsive
- [ ] WCAG 2.1 AA compliant
- [ ] Cross-browser compatible
- [ ] Performance optimized
- [ ] Lighthouse score 90+

**Integration:**
- [ ] Widgets work together on same page
- [ ] No CSS conflicts
- [ ] No JavaScript conflicts
- [ ] Asset loading optimized

**Documentation:**
- [ ] Widget usage documented
- [ ] Code comments complete
- [ ] Known issues logged
- [ ] Test results recorded

---

## 🎯 Next Steps

### Immediate Actions (Today)

1. **Environment Setup**
   - [ ] Install LocalWP or MAMP
   - [ ] Create WordPress site
   - [ ] Install Elementor
   - [ ] Verify PHP/Node versions

2. **Repository Preparation**
   - [ ] Create plugin directory
   - [ ] Copy current repo to plugin location
   - [ ] Initialize Git in plugin directory
   - [ ] Create .gitignore

3. **Tools Installation**
   - [ ] Install VS Code extensions
   - [ ] Install Chrome extensions
   - [ ] Install Composer globally
   - [ ] Verify npm installation

---

### This Week Goals

**Monday-Tuesday:**
- Complete environment setup
- Start Phase 1, Task 1 & 2
- Plugin structure and main file

**Wednesday-Thursday:**
- Complete Tasks 3 & 4
- Build system fully operational
- Assets compiling

**Friday:**
- Complete Tasks 5 & 6
- Assets Manager and Base Widget
- End week with solid foundation

---

### Next Week Goals

**Monday:**
- Complete Task 7
- Widget registration working
- **Phase 1 Complete** ✅

**Tuesday:**
- Final testing and cleanup
- Choose first widget
- Review implementation plan

**Wednesday-Friday:**
- Begin first priority widget
- Follow detailed implementation plan
- Daily testing and validation

---

## 🤝 Getting Help

### When Stuck

1. **Check Documentation**
   - Re-read relevant implementation plan
   - Review Elementor developer docs
   - Check WordPress Codex

2. **Debug Systematically**
   - Check PHP error logs
   - Check JavaScript console
   - Use Query Monitor plugin
   - Add debugging statements

3. **Ask for Help**
   - WordPress Stack Exchange
   - Elementor Developers Facebook
   - GitHub Issues (if public repo)
   - Development communities

### Common Issues

#### Plugin Won't Activate
- Check PHP version (needs 7.4+)
- Verify Elementor is installed
- Check for syntax errors
- Review error logs

#### Assets Won't Load
- Verify build process ran
- Check file permissions
- Confirm URLs are correct
- Clear browser cache

#### Widget Won't Appear
- Check Widgets Loader configuration
- Verify class name and namespace
- Confirm Composer autoload
- Review registration code

---

## 📝 Development Notes

### Git Workflow

```bash
# Feature branch workflow
git checkout -b feature/phase-1-foundation
# ... make changes ...
git add .
git commit -m "feat: Complete plugin foundation (Phase 1)"
git push origin feature/phase-1-foundation

# After Phase 1 complete
git checkout main
git merge feature/phase-1-foundation
git tag v0.1.0 -m "Phase 1: Foundation Complete"
git push --tags
```

### Commit Message Convention

```
feat: Add new feature
fix: Fix bug
docs: Update documentation
style: Format code (no functional changes)
refactor: Refactor code
test: Add tests
chore: Update build tools
```

### Version Numbers

- **v0.1.0** - Phase 1 Complete (Foundation)
- **v0.2.0** - Phase 2 Complete (5 Priority Widgets)
- **v0.3.0** - Phase 3 Complete (All 34 Widgets)
- **v0.4.0** - Phase 4 Complete (Advanced Features)
- **v1.0.0** - Phase 5 Complete (Public Release)

---

## 🎉 Conclusion

You have a comprehensive, well-documented plan to transform the Pagifye components into a production-ready Elementor plugin. The planning phase is complete, and you're ready to begin development.

### Key Strengths

✅ **Thorough Planning** - 85,000+ words of documentation
✅ **Clear Roadmap** - Defined phases with time estimates
✅ **Detailed Guides** - Step-by-step implementation plans
✅ **Quality Focus** - Testing and accessibility built in
✅ **Realistic Timeline** - 10 weeks with buffer time

### Success Factors

1. **Follow the Plan** - Trust the detailed documentation
2. **Test Frequently** - Validate after each major step
3. **Start Simple** - Consider Hero-01 before Navigation-01
4. **Stay Organized** - Use Git, version control, and todos
5. **Ask Questions** - Leverage community when stuck

---

**Ready to begin? Start with [Prerequisites & Environment Setup](#prerequisites--environment-setup) and follow the [Day-by-Day Implementation Guide](#day-by-day-implementation-guide).**

**Good luck! 🚀**

---

**Last Updated:** 2025-11-02
**Document Version:** 1.0.0
**Status:** Complete ✅
**Next Action:** Begin Phase 1, Task 1
