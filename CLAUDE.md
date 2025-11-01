# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Project Overview

This is a two-part project that transforms Pagifye Tailwind CSS components into Elementor WordPress widgets:

1. **Component Scraper** (Node.js/Puppeteer) - Automated tool to download free Tailwind CSS components from Pagifye.com
2. **Elementor Plugin** (WordPress/PHP) - Plugin to use the scraped components as Elementor widgets (planned, not yet implemented)

**Current Status:**
- Scraper: ✅ Complete and functional (34 components downloaded)
- Plugin: ⏳ Planning phase complete, ready for development

## Development Commands

### Component Scraper

```bash
# Install dependencies
npm install

# Scrape all free components from Pagifye
npm run scrape

# Scrape specific components by slug
npm run scrape:single root_navigation-01 root_hero-03

# Direct scraper execution
node scraper/scraper.js
node scraper/scraper-single.js <slug1> <slug2>
```

### Environment Setup

1. Copy `.env.example` to `.env`
2. Add Pagifye authentication tokens (ACCESS_TOKEN, REFRESH_TOKEN, POSTHOG_COOKIE)
3. Optionally set CHROME_PATH for Puppeteer

To get tokens:
- Log in to Pagifye.com in browser
- Open DevTools → Application → Cookies → https://pagifye.com
- Copy AccessToken and RefreshToken values

## Project Architecture

### Scraper Architecture (`/scraper/`)

**Main Files:**
- `scraper.js` - Main scraper that discovers and downloads all free components
- `scraper-single.js` - Downloads specific components by slug(s)
- `extract-component-list.js` - Helper to extract component names/slugs
- `extract-from-html.js` - Helper to parse component HTML
- `test-fetch.js` - Helper to test API endpoint access

**Scraper Flow:**
1. Launches headless Chrome via Puppeteer
2. Sets authentication cookies from `.env`
3. Navigates to component listing page or specific component page
4. Intercepts API responses when "Copy To Tailwind" button is clicked
5. Extracts HTML from API response
6. Saves each component as individual HTML file to `/components/`
7. Generates `metadata.json` with scraping details

**Key Implementation Details:**
- Uses Puppeteer for browser automation
- API interception via page.on('response') to capture component HTML
- 1-second delay between component requests (be respectful to server)
- Component slugs format: `root_<category>-<number>` (e.g., `root_navigation-01`)
- Output directory: `./components/`

### Plugin Architecture (Planned - Not Yet Implemented)

**Documentation:** Complete implementation plans exist in `/docs/`

**Key Documents:**
- `docs/00-PROJECT-MASTER-PLAN.md` - Complete project overview
- `docs/01-PLUGIN-ARCHITECTURE.md` - Technical design and structure
- `docs/02-PRIORITY-COMPONENTS-SELECTION.md` - 5 priority widgets for initial implementation
- `docs/components/` - Detailed implementation plans for individual widgets (navigation-01, hero-01, pricing-01, faq-01, testimonial-02)

**Tech Stack (Planned):**
- WordPress 5.8+ (Recommended: 6.4+)
- Elementor 3.16+
- PHP 7.4+ (Recommended: 8.1+)
- Tailwind CSS 3.4+
- Alpine.js 3.13+
- Node.js 18+ (build tools)

**34 Components across 11 categories:**
- Navigation (3), Hero (5), Pricing (3), Testimonial (3), FAQ (3)
- Contact (3), Content (3), Team (3), Blog (3), Metrics (2), Awards (3)

**Development Phases (10 weeks planned):**
- Phase 1: Foundation (Weeks 1-2) - Plugin skeleton, base classes, asset management
- Phase 2: Core Widgets (Weeks 3-5) - 5 priority widgets (Navigation-01, Hero-01, Pricing-01, FAQ-01, Testimonial-02)
- Phase 3-5: Complete Plugin (Weeks 6-10) - Remaining 29 widgets, testing, release

## Component Inventory

**Location:** `/components/` - Contains 34 HTML files
**Metadata:** `/components/metadata.json` - Scraping details

**Categories:**
- Navigation: root_navigation-01, 03, 05
- Hero: root_hero-01, 03, 04, 06, 07
- Content: root_content-02, 03, 04
- Metrics: root_metrics-02, 06
- Team: root_team-01, 02, 04
- Pricing: root_pricing-01, 02, 05
- Testimonial: root_testimonial-02, 04, 05
- FAQ: root_faq-01, 04, 05
- Contact: root_contact-01, 02, 04
- Awards: root_awards-01, 02, 04
- Blog: root_blog-01, 03, 05

## Important Notes

### Scraper Behavior
- Only scrapes FREE components (marked with "FREE" badge on Pagifye)
- Requires valid Pagifye account with active authentication tokens
- Chrome/Chromium browser required for Puppeteer
- Uses headless Chrome by default
- API interception is the primary method for capturing component HTML

### Finding Component Slugs
- Browse free components: https://pagifye.com/components?type=ui&license=free
- Component URL format: `https://pagifye.com/components/root_navigation-01`
- Slug is the part after `/components/`: `root_navigation-01`

### Documentation
- All planning docs are in `/docs/` - over 67,500 words of comprehensive documentation
- Each priority component has 10,000+ word implementation plan with code snippets
- Documentation includes detailed Elementor control specifications, Alpine.js integration patterns, and testing checklists

### File Structure
```
pagifye/
├── scraper/              # All scraper scripts
├── components/           # Downloaded HTML components (34 files)
├── docs/                 # Complete plugin documentation (planning phase)
├── examples/             # Example pages using components
├── package.json          # Node.js dependencies and scripts
├── .env.example          # Environment variable template
└── README.md            # Project overview
```

### Common Issues

**Authentication Errors:**
- Tokens expire - get fresh tokens from browser cookies
- Ensure all three tokens are set in `.env` (ACCESS_TOKEN, REFRESH_TOKEN, POSTHOG_COOKIE)

**Chrome Not Found:**
- Set CHROME_PATH in `.env` to your Chrome executable
- macOS default: `/Applications/Google Chrome.app/Contents/MacOS/Google Chrome`

**Component Not Found:**
- Verify component slug is correct
- Check if component is marked as FREE on Pagifye
- Some components may require authentication or premium access
