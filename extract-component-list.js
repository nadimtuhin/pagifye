import * as cheerio from 'cheerio';
import fs from 'fs/promises';

/**
 * Helper script to extract component slugs from saved HTML
 *
 * Usage:
 * 1. Save the HTML from https://pagifye.com/components?type=ui&license=free to a file
 * 2. Run: node extract-component-list.js <path-to-html-file>
 * 3. Copy the output and update scraper-api.js
 */

async function extractComponentSlugs(htmlFilePath) {
  try {
    const html = await fs.readFile(htmlFilePath, 'utf-8');
    const $ = cheerio.load(html);

    const components = [];

    // Find all component cards
    $('.box-shadow.group').each((index, element) => {
      const $card = $(element);

      // Get component name
      const nameElement = $card.find('.text-pg-black.pl-3');
      const name = nameElement.text().trim();

      // Get preview link
      const previewLink = $card.find('a[aria-label*="preview"]').attr('href');

      // Check if it's free
      const labelElement = $card.find('.labelGray');
      const labelText = labelElement.text().trim().toUpperCase();
      const isFree = labelText === 'FREE';

      if (name && previewLink) {
        const slug = previewLink.split('?')[0].replace('/components/', '');
        components.push({
          name,
          slug,
          isFree,
          label: labelText || 'PRO'
        });
      }
    });

    console.log(`\nFound ${components.length} total components\n`);

    const freeComponents = components.filter(c => c.isFree);
    console.log(`Free components: ${freeComponents.length}`);
    console.log(`Pro components: ${components.length - freeComponents.length}\n`);

    console.log('='.repeat(60));
    console.log('FREE COMPONENT SLUGS (copy to scraper-api.js):');
    console.log('='.repeat(60));
    console.log('const FREE_COMPONENTS = [');
    freeComponents.forEach(c => {
      console.log(`  '${c.slug}', // ${c.name}`);
    });
    console.log('];\n');

    console.log('='.repeat(60));
    console.log('ALL COMPONENTS:');
    console.log('='.repeat(60));
    components.forEach(c => {
      const badge = c.isFree ? '[FREE]' : '[PRO]';
      console.log(`${badge.padEnd(7)} ${c.slug.padEnd(30)} ${c.name}`);
    });

  } catch (error) {
    console.error('Error:', error.message);
    console.log('\nUsage: node extract-component-list.js <path-to-html-file>');
    console.log('Example: node extract-component-list.js page.html');
  }
}

// Get filename from command line arguments
const htmlFile = process.argv[2];

if (!htmlFile) {
  console.log('Usage: node extract-component-list.js <path-to-html-file>');
  console.log('\nExample:');
  console.log('1. Save the HTML from https://pagifye.com/components?type=ui&license=free');
  console.log('2. Run: node extract-component-list.js page.html');
  process.exit(1);
}

extractComponentSlugs(htmlFile);
