# Pagifye Elementor Widgets

Transform beautiful Pagifye Tailwind CSS components into fully customizable Elementor widgets for WordPress.

## Project Status

- ✅ **Component Scraper:** Functional - 34 components downloaded
- ✅ **Planning Phase:** Complete - Full documentation ready
- ⏳ **Development Phase:** Ready to start
- 📚 **Documentation:** 67,500+ words across 9 comprehensive guides

## What This Project Includes

### 1. Component Scraper
A Node.js scraper to download free Tailwind CSS components from Pagifye.com using Puppeteer.

#### Scraper Features

- Automated component discovery and download using Puppeteer
- Intercepts API responses to capture component HTML
- Saves components as individual HTML files
- Generates metadata.json with scraping details
- Environment variable configuration for secure credential management
- Support for both batch and single component downloads

### 2. Elementor Plugin (Planned)
Complete WordPress plugin to use Pagifye components in Elementor.

#### Plugin Features (Planned)

- 34 fully customizable Elementor widgets
- 11 component categories (Navigation, Hero, Pricing, FAQ, etc.)
- Tailwind CSS + Alpine.js integration
- Full responsive design support
- Accessibility compliant (WCAG 2.1 AA)
- No coding required for users

## Quick Links

### 📚 Documentation
- **[Start Here - Docs README](docs/README.md)** - Documentation navigation
- **[Master Project Plan](docs/00-PROJECT-MASTER-PLAN.md)** - Complete overview
- **[Plugin Architecture](docs/01-PLUGIN-ARCHITECTURE.md)** - Technical design
- **[Component Plans](docs/components/)** - Widget implementation guides

### 📦 Components
- **[Component Inventory](COMPONENT_LIST.md)** - All 34 components
- **[Components Folder](components/)** - Downloaded HTML files
- **[Examples](examples/)** - Sample pages using components

---

## Getting Started

### For Scraping Components

#### Installation

```bash
npm install
```

#### Configuration

1. Copy the `.env.example` file to `.env`:
```bash
cp .env.example .env
```

2. Update the `.env` file with your credentials:
   - `ACCESS_TOKEN` - Your Pagifye access token
   - `REFRESH_TOKEN` - Your Pagifye refresh token
   - `POSTHOG_COOKIE` - PostHog analytics cookie (optional)
   - `CHROME_PATH` - Path to Chrome executable (optional, defaults to macOS path)

To get your tokens:
1. Log in to Pagifye in your browser
2. Open Developer Tools (F12)
3. Go to Application/Storage > Cookies > https://pagifye.com
4. Copy the values for `AccessToken`, `RefreshToken`, and `ph_phc_wlGdG9sRWzctAtkJ7ybtHcH7VV0QFIBS95355rTf61p_posthog`
5. Paste them into your `.env` file

#### Usage

##### Scrape All Free Components

```bash
npm run scrape
```

This command runs `scraper.js` which:
1. Navigates to the Pagifye free components listing page
2. Automatically discovers all free component slugs
3. Downloads each component by intercepting the API response when clicking "Copy To Tailwind"
4. Saves each component as an HTML file in the `./components` directory
5. Creates a `metadata.json` file with scraping details

##### Scrape Specific Components

```bash
node scraper-single.js <slug1> <slug2> ...
```

Example:
```bash
node scraper-single.js root_navigation-01 root_hero-03
```

This allows you to download specific components by their slugs instead of scraping all components.

### For Developing the Elementor Plugin

See the **[complete documentation in `docs/`](docs/README.md)** for:
- Plugin architecture and structure
- Implementation plans for all widgets
- Code snippets and examples
- Testing guidelines
- Development workflow

**Quick Start:**
1. Read [Master Project Plan](docs/00-PROJECT-MASTER-PLAN.md)
2. Set up WordPress + Elementor locally
3. Follow [Plugin Architecture](docs/01-PLUGIN-ARCHITECTURE.md) guide
4. Start with [Hero-01 widget](docs/components/hero-01-plan.md) (simplest)

---

## Component Scraper Details

### What Gets Downloaded

The scraper will:
1. Intercept the API response when "Copy To Tailwind" is clicked
2. Extract the component HTML code from the API response
3. Save each component as a separate HTML file in the `./components` directory
4. Generate a `metadata.json` file with:
   - Scrape date and time
   - Total number of components downloaded
   - List of successful downloads with file names
   - List of failed downloads with error messages

### Output Structure

```
components/
├── root_navigation-01.html
├── root_navigation-03.html
├── root_navigation-05.html
├── root_hero-01.html
├── root_hero-03.html
├── root_hero-04.html
├── root_hero-06.html
├── root_hero-07.html
├── root_content-02.html
└── metadata.json
```

### How It Works

The scraper uses Puppeteer to:
1. Launch a headless Chrome browser
2. Set authentication cookies from your `.env` file
3. Navigate to the Pagifye components listing page
4. Extract component slugs from the page
5. For each component:
   - Navigate to the component page
   - Set up an API response interceptor
   - Click the "Copy To Tailwind" button
   - Capture the API response containing the component HTML
   - Save the HTML to a file

### Finding Component Slugs

Component slugs can be found in the URL when viewing a component on Pagifye:
- URL: `https://pagifye.com/components/root_navigation-01`
- Slug: `root_navigation-01`

You can browse free components at: https://pagifye.com/components?type=ui&license=free

### Scraper Notes

- The scraper includes a 1-second delay between component requests
- Only free components (marked with "FREE" badge) should be downloaded
- The HTML files contain the component code extracted from the API
- Requires a valid Pagifye account with active authentication tokens
- Chrome/Chromium browser is required for Puppeteer

---

## Project Structure

```
pagifye/
├── components/              # Downloaded HTML components (34 files)
├── examples/                # Example pages using components
├── docs/                    # Complete Elementor plugin documentation
│   ├── README.md           # Documentation navigation
│   ├── 00-PROJECT-MASTER-PLAN.md
│   ├── 01-PLUGIN-ARCHITECTURE.md
│   ├── 02-PRIORITY-COMPONENTS-SELECTION.md
│   └── components/         # Widget implementation plans
├── scraper.js              # Main scraper script
├── scraper-single.js       # Single component scraper
└── package.json
```

## Requirements

### For Scraper
- Node.js 14+
- npm or yarn
- Chrome/Chromium browser

### For Plugin Development
- PHP 7.4+ (Recommended: 8.1+)
- WordPress 5.8+ (Recommended: 6.4+)
- Elementor 3.16+
- Node.js 18+ (build tools)

## Component Inventory

### 34 Components across 11 categories:
- **Navigation:** 3 variants
- **Hero:** 5 variants
- **Pricing:** 3 variants
- **Testimonial:** 3 variants
- **FAQ:** 3 variants
- **Contact:** 3 variants
- **Content:** 3 variants
- **Team:** 3 variants
- **Blog:** 3 variants
- **Metrics:** 2 variants
- **Awards:** 3 variants

See [COMPONENT_LIST.md](COMPONENT_LIST.md) for complete details.

## Development Roadmap

### ✅ Phase 0: Planning (Complete)
- Complete plugin architecture
- Component selection and analysis
- Detailed implementation plans for 5 priority widgets
- 67,500+ words of documentation

### ⏳ Phase 1: Foundation (Weeks 1-2)
- Plugin skeleton and base classes
- Tailwind CSS + Alpine.js setup
- Asset management system

### ⏳ Phase 2: Core Widgets (Weeks 3-5)
- Navigation-01 (24 hours)
- Hero-01 (20 hours)
- Pricing-01 (24 hours)
- FAQ-01 (12 hours)
- Testimonial-02 (20 hours)

### ⏳ Phase 3-5: Complete Plugin (Weeks 6-10)
- Remaining 29 widgets
- Advanced features
- Testing and optimization
- WordPress.org release

**Total Timeline:** 10 weeks

## Contributing

Contributions are welcome! Please read the [documentation](docs/README.md) first.

### Development Workflow
1. Read the relevant documentation
2. Follow the implementation plans
3. Test thoroughly
4. Submit pull request

## License

ISC

## Credits

- Components from [Pagifye.com](https://pagifye.com)
- Built with [Tailwind CSS](https://tailwindcss.com)
- Interactive features with [Alpine.js](https://alpinejs.dev)
- For [Elementor](https://elementor.com) page builder

---

**Status:** Planning Complete ✅ | Ready for Development ⏳

For detailed information, see the [complete documentation](docs/README.md).
