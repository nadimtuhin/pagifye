# Pagifye Free Components List

This document contains the list of free components available on Pagifye.

## How to Find More Components

1. Visit https://pagifye.com/components?type=ui&license=free
2. Look for components with the "FREE" badge
3. Click on any component to see its detail page
4. The URL will be like: `https://pagifye.com/components/root_navigation-01?variant=light&type=ui`
5. Extract the slug (the part between `/components/` and `?`), e.g., `root_navigation-01`
6. Add it to the list below

## Known Free Components

Based on the screenshots and page data provided:

### Navigation Components
- `root_navigation-01` - Navigation 01
- `root_navigation-03` - Navigation 03
- `root_navigation-05` - Navigation 05

### Hero Components
- `root_hero-01` - Hero 01
- `root_hero-03` - Hero 03
- `root_hero-04` - Hero 04
- `root_hero-06` - Hero 06
- `root_hero-07` - Hero 07

### Content Components
- `root_content-02` - Content 02

### Other Categories

According to the Pagifye website, there are many more categories. Look for FREE components in:

- **Navigation** - Navigation bars, menus
- **Hero** - Hero sections, landing page headers
- **Content** - Content sections, text blocks
- **Footer** - Footer sections
- **CTA** - Call-to-action sections
- **Features** - Feature showcases
- **Pricing** - Pricing tables
- **Testimonials** - Customer testimonials
- **Team** - Team member displays
- **FAQ** - Frequently asked questions
- **Contact** - Contact forms and sections
- **Blog** - Blog post layouts
- **Cards** - Card components
- **Forms** - Form elements
- **Buttons** - Button styles
- And more...

## How to Get the Complete List

### Method 1: Browser DevTools (Manual but Reliable)

1. Go to https://pagifye.com/components?type=ui&license=free
2. Open Browser DevTools (F12)
3. Go to Console tab
4. Paste this code:

```javascript
// Extract all free component slugs
const components = Array.from(document.querySelectorAll('.box-shadow.group'))
  .map(card => {
    const name = card.querySelector('.text-pg-black.pl-3')?.textContent.trim();
    const link = card.querySelector('a[aria-label*="preview"]')?.getAttribute('href');
    const isFree = card.querySelector('.labelGray')?.textContent.trim().toUpperCase() === 'FREE';

    if (name && link && isFree) {
      const slug = link.split('?')[0].replace('/components/', '');
      return { name, slug };
    }
    return null;
  })
  .filter(c => c !== null);

console.log('FREE COMPONENTS:');
console.log('const FREE_COMPONENTS = [');
components.forEach(c => console.log(`  '${c.slug}', // ${c.name}`));
console.log('];');
console.log(`\nTotal: ${components.length} free components`);
```

5. Copy the output
6. Update `scraper-api.js` with the new component list

### Method 2: Network Tab

1. Go to https://pagifye.com/components?type=ui&license=free
2. Open DevTools > Network tab
3. Look for API calls that fetch component data
4. The response might contain a JSON list of all components
5. Filter for free components and extract slugs

## Updating the Scraper

After you have the component slugs, update `scraper-api.js`:

```javascript
const FREE_COMPONENTS = [
  'root_navigation-01',
  'root_navigation-03',
  'root_navigation-05',
  'root_hero-01',
  // ... add more here
];
```

Then run:
```bash
npm run scrape-api
```

## Notes

- The FREE component list changes as Pagifye adds new components
- Some components might require authentication even if marked as FREE
- Component slugs typically follow the pattern: `{library}_{category}-{number}`
  - Example: `root_navigation-01` = Root UI library, Navigation category, variant 01
  - Example: `maple_hero-05` = Maple UI library, Hero category, variant 05
