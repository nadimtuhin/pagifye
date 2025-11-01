import * as cheerio from 'cheerio';
import fs from 'fs/promises';

// Paste the HTML content here or read from a file
const htmlContent = `[PASTE HTML HERE]`;

async function extractFromHTML() {
  const $ = cheerio.load(htmlContent);

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
    const isFree = labelElement && labelElement.text().trim().toUpperCase() === 'FREE';

    if (name && previewLink && isFree) {
      const slug = previewLink.split('?')[0].replace('/components/', '');
      components.push({
        name,
        slug
      });
    }
  });

  console.log(`Found ${components.length} FREE components:\n`);
  console.log('const FREE_COMPONENTS = [');
  components.forEach(c => {
    console.log(`  '${c.slug}', // ${c.name}`);
  });
  console.log('];\n');

  // Save to file
  const output = {
    totalFree: components.length,
    components: components
  };

  await fs.writeFile('free-components-list.json', JSON.stringify(output, null, 2), 'utf-8');
  console.log(`Saved component list to free-components-list.json`);
}

extractFromHTML();
