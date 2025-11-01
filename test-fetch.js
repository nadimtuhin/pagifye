import axios from 'axios';
import * as cheerio from 'cheerio';
import fs from 'fs/promises';

const COOKIES = {
  AccessToken: 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpZCI6ImE2OTA5ZGMxLTgwOTgtNDNkNi05MzcwLWM2MTc0YjA4OGVkOCIsInJvbGUiOiJ1c2VyIiwibmFtZSI6Ik5hZGltIFR1aGluIiwiZW1haWwiOiJuYWRpbXR1aGluQGdtYWlsLmNvbSIsImlhdCI6MTc2MjAyNzEzOSwiZXhwIjoxNzYyMDI4MDM5fQ.bTPtD3d52ri1yCkVDsu8LSo8PHTld_EbGWRU8u9bgrs',
  RefreshToken: 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpZCI6ImE2OTA5ZGMxLTgwOTgtNDNkNi05MzcwLWM2MTc0YjA4OGVkOCIsInNjb3BlIjoicmVmcmVzaCIsImlhdCI6MTc2MjAyNzEzOSwiZXhwIjoxNzYzMzIzMTM5fQ.0kE4a0DuRff1T3TvE_o-iuGpuonwFZQxOkNSe7A7N54',
  ph_phc_wlGdG9sRWzctAtkJ7ybtHcH7VV0QFIBS95355rTf61p_posthog: '%7B%22distinct_id%22%3A%22019a2155-6e11-78d2-bbbd-3d0f203014ca%22%2C%22%24sesid%22%3A%5B1762027713193%2C%22019a4100-8634-77b0-9635-ef1b56bc05a8%22%2C1762027144754%5D%2C%22%24initial_person_info%22%3A%7B%22r%22%3A%22%24direct%22%2C%22u%22%3A%22https%3A%2F%2Fpagifye.com%2F%22%7D%7D'
};

function getCookieString() {
  return Object.entries(COOKIES)
    .map(([key, value]) => `${key}=${value}`)
    .join('; ');
}

async function test() {
  const axiosInstance = axios.create({
    headers: {
      'Cookie': getCookieString(),
      'User-Agent': 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36',
      'Accept': 'text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,*/*;q=0.8',
    }
  });

  const response = await axiosInstance.get('https://pagifye.com/components?type=ui&license=free');

  // Save raw HTML for inspection
  await fs.writeFile('test-output.html', response.data, 'utf-8');
  console.log('Saved raw HTML to test-output.html');

  const $ = cheerio.load(response.data);

  // Try different selectors
  console.log('\n=== Testing Selectors ===');
  console.log('box-shadow.group:', $('.box-shadow.group').length);
  console.log('.box-shadow:', $('.box-shadow').length);
  console.log('div[class*="box-shadow"]:', $('div[class*="box-shadow"]').length);
  console.log('a[aria-label*="preview"]:', $('a[aria-label*="preview"]').length);
  console.log('.labelGray:', $('.labelGray').length);

  // Try to find text content
  console.log('\n=== Looking for "navigation" ===');
  const navElements = $('*:contains("navigation")');
  console.log('Elements containing "navigation":', navElements.length);

  console.log('\n=== Looking for "FREE" ===');
  const freeElements = $('*:contains("FREE")');
  console.log('Elements containing "FREE":', freeElements.length);

  // Check if it's a React app (might be client-side rendered)
  console.log('\n=== Checking for React/Next.js ===');
  console.log('Has __NEXT_DATA__:', response.data.includes('__NEXT_DATA__'));
  console.log('Has React root:', response.data.includes('react') || response.data.includes('React'));

  // Try to extract __NEXT_DATA__ if it exists
  if (response.data.includes('__NEXT_DATA__')) {
    const scriptMatch = response.data.match(/<script id="__NEXT_DATA__"[^>]*>(.*?)<\/script>/s);
    if (scriptMatch) {
      try {
        const nextData = JSON.parse(scriptMatch[1]);
        await fs.writeFile('next-data.json', JSON.stringify(nextData, null, 2), 'utf-8');
        console.log('Saved Next.js data to next-data.json');
      } catch (e) {
        console.log('Failed to parse __NEXT_DATA__');
      }
    }
  }
}

test();
