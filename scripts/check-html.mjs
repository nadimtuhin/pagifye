// Validates the example pages (html-validate) and runs axe-core accessibility
// checks against them. Exits non-zero on any error or violation.
import { readFileSync, readdirSync } from 'node:fs';
import { join } from 'node:path';
import { createRequire } from 'node:module';
import { HtmlValidate, FileSystemConfigLoader, formatterFactory } from 'html-validate';
import { JSDOM } from 'jsdom';

const require = createRequire(import.meta.url);
const axeSource = readFileSync(require.resolve('axe-core/axe.min.js'), 'utf8');

const dir = 'examples';
const files = readdirSync(dir).filter((f) => f.endsWith('.html')).map((f) => join(dir, f));
let failed = false;

// 1. HTML validation
const validator = new HtmlValidate(new FileSystemConfigLoader());
const report = await validator.validateMultipleFiles(files);
if (!report.valid) {
  console.error(formatterFactory('stylish')(report.results));
  failed = true;
} else {
  console.log(`html-validate: ${files.length} files OK`);
}

// 2. Required head metadata + axe-core (rules that need layout/CSS are disabled:
// jsdom does not render and the pages load Tailwind from a CDN).
for (const file of files) {
  const html = readFileSync(file, 'utf8');
  const dom = new JSDOM(html, { runScripts: 'outside-only', url: 'http://localhost/' + file });
  const { document } = dom.window;

  const missing = [];
  if (!document.documentElement.getAttribute('lang')) missing.push('html[lang]');
  if (!document.title.trim()) missing.push('<title>');
  if (!document.querySelector('meta[name="viewport"]')) missing.push('meta[name=viewport]');
  if (!document.querySelector('meta[name="description"][content]')) missing.push('meta[name=description]');
  if (missing.length) {
    console.error(`${file}: missing ${missing.join(', ')}`);
    failed = true;
  }

  dom.window.eval(axeSource);
  const results = await dom.window.axe.run(document, {
    runOnly: { type: 'tag', values: ['wcag2a', 'wcag2aa', 'wcag21a', 'wcag21aa', 'best-practice'] },
    rules: { 'color-contrast': { enabled: false } },
  });
  for (const v of results.violations) {
    failed = true;
    console.error(`${file}: [${v.impact}] ${v.id} - ${v.help} (${v.nodes.length})`);
    for (const n of v.nodes.slice(0, 5)) console.error(`    ${n.target.join(' ')}`);
  }
  if (!results.violations.length && !missing.length) console.log(`axe: ${file} OK`);
  dom.window.close();
}

process.exit(failed ? 1 : 0);
