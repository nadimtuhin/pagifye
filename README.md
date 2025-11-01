# Pagifye Component Scraper

A Node.js scraper to download free Tailwind CSS components from Pagifye.com using Puppeteer.

## Features

- Automated component discovery and download using Puppeteer
- Intercepts API responses to capture component HTML
- Saves components as individual HTML files
- Generates metadata.json with scraping details
- Environment variable configuration for secure credential management
- Support for both batch and single component downloads

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

### Scrape All Free Components

```bash
npm run scrape
```

This command runs `scraper.js` which:
1. Navigates to the Pagifye free components listing page
2. Automatically discovers all free component slugs
3. Downloads each component by intercepting the API response when clicking "Copy To Tailwind"
4. Saves each component as an HTML file in the `./components` directory
5. Creates a `metadata.json` file with scraping details

### Scrape Specific Components

```bash
node scraper-single.js <slug1> <slug2> ...
```

Example:
```bash
node scraper-single.js root_navigation-01 root_hero-03
```

This allows you to download specific components by their slugs instead of scraping all components.

## What Gets Downloaded

The scraper will:
1. Intercept the API response when "Copy To Tailwind" is clicked
2. Extract the component HTML code from the API response
3. Save each component as a separate HTML file in the `./components` directory
4. Generate a `metadata.json` file with:
   - Scrape date and time
   - Total number of components downloaded
   - List of successful downloads with file names
   - List of failed downloads with error messages

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

## How It Works

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

## Finding Component Slugs

Component slugs can be found in the URL when viewing a component on Pagifye:
- URL: `https://pagifye.com/components/root_navigation-01`
- Slug: `root_navigation-01`

You can browse free components at: https://pagifye.com/components?type=ui&license=free

## Notes

- The scraper includes a 1-second delay between component requests
- Only free components (marked with "FREE" badge) should be downloaded
- The HTML files contain the component code extracted from the API
- Requires a valid Pagifye account with active authentication tokens
- Chrome/Chromium browser is required for Puppeteer

## Requirements

- Node.js 14+
- npm or yarn

## License

ISC
