# Pagifye Component Scraper

A Node.js script to download free Tailwind CSS components from Pagifye.com.

## Features

- Downloads free Tailwind CSS component HTML from Pagifye
- Saves metadata including component names, URLs, and file names
- Rate-limited to avoid overwhelming the server
- Multiple scraping methods available

## Installation

```bash
npm install
```

## Configuration

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

## Usage

### Method 1: API-based Scraper (Recommended - Fast & Reliable)

```bash
npm run scrape-api
```

This method downloads components directly using their URLs. It's faster and doesn't require a headless browser.

**Note:** The component list is manually maintained in `scraper-api.js`. To add more components, update the `FREE_COMPONENTS` array with the component slugs from Pagifye.

### Method 2: Puppeteer-based Scraper (Experimental)

```bash
npm run scrape-v2
```

This method uses Puppeteer to handle client-side rendered content. It automatically discovers components but is slower due to browser automation.

**Note:** Requires Puppeteer installation which downloads Chromium (~200MB).

## What Gets Downloaded

Each script will:
1. Download component HTML pages
2. Save all components to the `./components` directory
3. Create a `metadata.json` file with component information

## Output Structure

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

## Adding More Components

To download additional free components:

1. Visit https://pagifye.com/components?type=ui&license=free
2. Find the component you want (look for FREE badge)
3. Get the component slug from the URL (e.g., `root_navigation-01`)
4. Add it to the `FREE_COMPONENTS` array in `scraper-api.js`
5. Run `npm run scrape-api` again

Example:
```javascript
const FREE_COMPONENTS = [
  'root_navigation-01',
  'root_hero-01',
  // Add your new component slugs here
  'root_footer-01',
];
```

## Notes

- The scraper includes a 1.5-second delay between requests to be respectful to the server
- Only free components (marked with "FREE" badge) should be downloaded
- The HTML files contain the full page structure, not just the component code
- Components are downloaded in "light" mode by default

## Requirements

- Node.js 14+
- npm or yarn

## License

ISC
