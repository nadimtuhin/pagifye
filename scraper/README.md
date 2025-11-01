# Pagifye Component Scraper

A Node.js scraper to download free Tailwind CSS components from Pagifye.com using Puppeteer.

## Quick Start

From the project root:

```bash
# Install dependencies
npm install

# Scrape all free components
npm run scrape

# Scrape specific components
npm run scrape:single root_navigation-01 root_hero-03
```

## Configuration

1. Copy `.env.example` to `.env` in the project root
2. Add your Pagifye authentication tokens:
   - `ACCESS_TOKEN`
   - `REFRESH_TOKEN`
   - `POSTHOG_COOKIE` (optional)
   - `CHROME_PATH` (optional)

To get your tokens:
1. Log in to Pagifye in your browser
2. Open Developer Tools (F12)
3. Go to Application > Cookies > https://pagifye.com
4. Copy the token values to your `.env` file

## Scripts

### scraper.js
Main scraper that downloads all free components from Pagifye.

**Usage:**
```bash
npm run scrape
```

**What it does:**
1. Navigates to Pagifye free components page
2. Discovers all free component slugs
3. Downloads each component via API interception
4. Saves HTML files to `../components/`
5. Generates `metadata.json`

### scraper-single.js
Download specific components by slug.

**Usage:**
```bash
npm run scrape:single <slug1> <slug2> ...
```

**Example:**
```bash
npm run scrape:single root_navigation-01 root_pricing-01
```

### Helper Scripts

- **extract-component-list.js** - Extract component names and slugs
- **extract-from-html.js** - Parse component HTML
- **test-fetch.js** - Test API endpoint access

## Output

Components are saved to `../components/`:
```
components/
├── root_navigation-01.html
├── root_hero-01.html
├── root_pricing-01.html
├── ...
└── metadata.json
```

## How It Works

1. Launches headless Chrome via Puppeteer
2. Sets authentication cookies from `.env`
3. Navigates to component pages
4. Intercepts API responses when clicking "Copy To Tailwind"
5. Extracts HTML from API response
6. Saves to individual files

## Notes

- 1-second delay between requests (be respectful to server)
- Only scrapes FREE components
- Requires valid Pagifye account
- Chrome/Chromium required for Puppeteer

## Finding Component Slugs

Component slugs are in the URL:
- URL: `https://pagifye.com/components/root_navigation-01`
- Slug: `root_navigation-01`

Browse free components: https://pagifye.com/components?type=ui&license=free

## Troubleshooting

**Error: Authentication failed**
- Check your `.env` tokens are up to date
- Log in to Pagifye and get fresh tokens

**Error: Cannot find Chrome**
- Set `CHROME_PATH` in `.env` to your Chrome location
- macOS default: `/Applications/Google Chrome.app/Contents/MacOS/Google Chrome`

**Error: Component not found**
- Verify the component slug is correct
- Check if component is marked as FREE on Pagifye

## Requirements

- Node.js 14+
- Chrome/Chromium browser
- Valid Pagifye account

## License

ISC
