import puppeteer from 'puppeteer';
import fs from 'fs/promises';
import path from 'path';
import dotenv from 'dotenv';

dotenv.config();

const BASE_URL = 'https://pagifye.com';
const LISTING_URL = 'https://pagifye.com/components?type=ui&license=free';
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

async function getComponentSlugs(page) {
  console.log('Navigating to component listing page...');
  await page.goto(LISTING_URL, { waitUntil: 'networkidle2', timeout: 30000 });
  await page.waitForTimeout(3000);

  const slugs = await page.evaluate(() => {
    const links = [];
    const elements = document.querySelectorAll('a[href*="/components/"]');

    elements.forEach(el => {
      const href = el.getAttribute('href');
      if (href && href.includes('/components/')) {
        const slug = href.split('/components/')[1]?.split('?')[0];
        if (slug && !links.includes(slug)) {
          links.push(slug);
        }
      }
    });

    return links;
  });

  console.log(`Found ${slugs.length} components`);
  return slugs;
}

async function downloadComponent(page, slug) {
  console.log(`\nProcessing ${slug}...`);

  let capturedData = null;

  try {
    const componentUrl = `${BASE_URL}/components/${slug}`;
    console.log(`Navigating to: ${componentUrl}`);

    // Set up response interceptor BEFORE navigation
    const responseHandler = async (response) => {
      const url = response.url();

      // Look for copy-component API endpoint
      if (url.includes('/api/') && url.includes('copy')) {
        try {
          const contentType = response.headers()['content-type'];
          if (contentType && contentType.includes('application/json')) {
            const data = await response.json();
            console.log('✓ Captured API response');
            capturedData = data;
          }
        } catch (e) {
          // Ignore parse errors
        }
      }
    };

    page.on('response', responseHandler);

    await page.goto(componentUrl, { waitUntil: 'networkidle2', timeout: 30000 });
    await page.waitForTimeout(2000);

    // Try to find and click "Copy To Tailwind" button
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
      // Wait for API call
      await page.waitForTimeout(3000);
    }

    // Remove the event listener
    page.off('response', responseHandler);

    if (capturedData) {
      // Extract HTML from the captured data
      let html = null;

      if (capturedData.data) {
        html = capturedData.data;
      } else if (capturedData.html) {
        html = capturedData.html;
      } else if (capturedData.code) {
        html = capturedData.code;
      } else if (typeof capturedData === 'string') {
        html = capturedData;
      }

      if (html && html.length > 100) {
        console.log(`✓ Component HTML captured (${html.length} chars)`);
        return {
          slug,
          html,
          success: true,
          source: 'api'
        };
      }
    }

    console.warn('⚠ Could not capture component HTML from API');
    return {
      slug,
      html: null,
      success: false,
      error: 'Could not extract HTML from API'
    };

  } catch (error) {
    console.error(`Error processing ${slug}:`, error.message);
    return {
      slug,
      html: null,
      success: false,
      error: error.message
    };
  }
}

async function saveComponent(slug, html) {
  const fileName = `${slug}.html`;
  const filePath = path.join(OUTPUT_DIR, fileName);
  await fs.writeFile(filePath, html, 'utf-8');
  console.log(`✓ Saved: ${fileName}`);
}

async function saveMetadata(results) {
  const metadataPath = path.join(OUTPUT_DIR, 'metadata.json');

  const successful = results.filter(r => r.success);

  const metadata = {
    scrapeDate: new Date().toISOString(),
    totalComponents: successful.length,
    method: 'puppeteer-api-intercept',
    components: successful.map(r => ({
      slug: r.slug,
      fileName: `${r.slug}.html`,
      source: r.source
    })),
    failed: results.filter(r => !r.success).map(r => ({
      slug: r.slug,
      error: r.error
    }))
  };

  await fs.writeFile(metadataPath, JSON.stringify(metadata, null, 2), 'utf-8');
  console.log('\n✓ Saved metadata.json');
}

async function main() {
  let browser;

  try {
    await fs.mkdir(OUTPUT_DIR, { recursive: true });
    console.log(`Output directory: ${OUTPUT_DIR}\n`);

    console.log('Launching browser...');
    browser = await puppeteer.launch({
      executablePath: process.env.CHROME_PATH || '/Applications/Google Chrome.app/Contents/MacOS/Google Chrome',
      headless: 'new',
      defaultViewport: { width: 1920, height: 1080 },
      args: [
        '--no-sandbox',
        '--disable-setuid-sandbox',
        '--disable-dev-shm-usage',
        '--disable-gpu',
        '--disable-software-rasterizer',
        '--disable-extensions'
      ]
    });

    const page = await browser.newPage();
    await page.setCookie(...COOKIES);

    const slugs = await getComponentSlugs(page);

    if (slugs.length === 0) {
      console.log('No components found on the listing page');
      return;
    }

    console.log(`\nProcessing ${slugs.length} components\n`);

    const results = [];

    for (const slug of slugs) {
      const result = await downloadComponent(page, slug);
      results.push(result);

      if (result.success && result.html) {
        await saveComponent(slug, result.html);
      }

      await page.waitForTimeout(1000);
    }

    await saveMetadata(results);

    const successful = results.filter(r => r.success);
    const failed = results.filter(r => !r.success);

    console.log(`\n${'='.repeat(60)}`);
    console.log(`✅ Successfully downloaded: ${successful.length} components`);
    if (failed.length > 0) {
      console.log(`❌ Failed: ${failed.length} components`);
      failed.slice(0, 10).forEach(f => console.log(`   - ${f.slug}: ${f.error}`));
      if (failed.length > 10) {
        console.log(`   ... and ${failed.length - 10} more`);
      }
    }
    console.log(`📁 Components saved to: ${OUTPUT_DIR}`);
    console.log(`${'='.repeat(60)}\n`);

  } catch (error) {
    console.error('Error in main:', error);
  } finally {
    if (browser) {
      await browser.close();
      console.log('Browser closed');
    }
  }
}

main();
