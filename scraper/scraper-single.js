import puppeteer from 'puppeteer';
import fs from 'fs/promises';
import path from 'path';
import dotenv from 'dotenv';

dotenv.config();

const BASE_URL = 'https://pagifye.com';
const OUTPUT_DIR = './components';

const COOKIES = [
  {
    "domain": ".pagifye.com",
    "expirationDate": 1763326539.627397,
    "hostOnly": false,
    "httpOnly": false,
    "name": "AccessToken",
    "path": "/",
    "sameSite": "strict",
    "secure": true,
    "session": false,
    "storeId": "0",
    "value": process.env.ACCESS_TOKEN
  },
  {
    "domain": ".pagifye.com",
    "expirationDate": 1763326539.627493,
    "hostOnly": false,
    "httpOnly": true,
    "name": "RefreshToken",
    "path": "/",
    "sameSite": "strict",
    "secure": true,
    "session": false,
    "storeId": "0",
    "value": process.env.REFRESH_TOKEN
  },
  {
    "domain": ".pagifye.com",
    "expirationDate": 1793566553,
    "hostOnly": false,
    "httpOnly": false,
    "name": "ph_phc_wlGdG9sRWzctAtkJ7ybtHcH7VV0QFIBS95355rTf61p_posthog",
    "path": "/",
    "sameSite": "lax",
    "secure": true,
    "session": false,
    "storeId": "0",
    "value": process.env.POSTHOG_COOKIE
  }
];

// Get slugs from command line args
const slugs = process.argv.slice(2);

if (slugs.length === 0) {
  console.log('Usage: node scraper-single.js <slug1> <slug2> ...');
  process.exit(1);
}

async function downloadComponent(page, slug) {
  console.log(`\nProcessing ${slug}...`);

  let capturedData = null;

  try {
    const componentUrl = `${BASE_URL}/components/${slug}`;
    console.log(`Navigating to: ${componentUrl}`);

    const responseHandler = async (response) => {
      const url = response.url();
      if (url.includes('/api/') && url.includes('copy')) {
        try {
          const contentType = response.headers()['content-type'];
          if (contentType && contentType.includes('application/json')) {
            const data = await response.json();
            console.log('✓ Captured API response');
            capturedData = data;
          }
        } catch (e) {}
      }
    };

    page.on('response', responseHandler);

    await page.goto(componentUrl, { waitUntil: 'networkidle2', timeout: 30000 });
    await page.waitForTimeout(2000);

    const clicked = await page.evaluate(() => {
      const buttons = Array.from(document.querySelectorAll('button, div[role="button"], span'));
      for (const button of buttons) {
        const text = button.textContent || '';
        if (text.includes('Copy To Tailwind') || text.includes('Copy to Tailwind')) {
          button.click();
          return true;
        }
      }
      return false;
    });

    if (clicked) {
      console.log('✓ Clicked "Copy To Tailwind" button');
      await page.waitForTimeout(3000);
    }

    page.off('response', responseHandler);

    if (capturedData) {
      let html = capturedData.data || capturedData.html || capturedData.code || (typeof capturedData === 'string' ? capturedData : null);

      if (html && html.length > 100) {
        console.log(`✓ Component HTML captured (${html.length} chars)`);

        const fileName = `${slug}.html`;
        const filePath = path.join(OUTPUT_DIR, fileName);
        await fs.writeFile(filePath, html, 'utf-8');
        console.log(`✓ Saved: ${fileName}`);

        return true;
      }
    }

    console.warn('⚠ Could not capture component HTML from API');
    return false;

  } catch (error) {
    console.error(`Error processing ${slug}:`, error.message);
    return false;
  }
}

async function main() {
  let browser;

  try {
    console.log('Launching browser...');
    browser = await puppeteer.launch({
      executablePath: process.env.CHROME_PATH || '/Applications/Google Chrome.app/Contents/MacOS/Google Chrome',
      headless: 'new',
      defaultViewport: { width: 1920, height: 1080 },
      args: [
        '--no-sandbox',
        '--disable-setuid-sandbox',
        '--disable-dev-shm-usage',
        '--disable-gpu'
      ]
    });

    const page = await browser.newPage();
    await page.setCookie(...COOKIES);

    for (const slug of slugs) {
      await downloadComponent(page, slug);
    }

    console.log('\n✅ Done!');

  } catch (error) {
    console.error('Error:', error);
  } finally {
    if (browser) {
      await browser.close();
    }
  }
}

main();
