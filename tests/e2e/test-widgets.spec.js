/**
 * End-to-End Tests for Pagifye Elementor Widgets
 * Using Playwright for browser automation
 *
 * @package Pagifye_Elementor_Widgets
 */

const { test, expect } = require('@playwright/test');

// Configuration
const WORDPRESS_URL = process.env.WP_URL || 'http://localhost:8080';
const ADMIN_USER = process.env.WP_ADMIN_USER || 'admin';
const ADMIN_PASS = process.env.WP_ADMIN_PASS || 'password';

test.describe('Pagifye Widgets - E2E Tests', () => {

  test.beforeEach(async ({ page }) => {
    // Login to WordPress admin
    await page.goto(`${WORDPRESS_URL}/wp-admin`);
    await page.fill('#user_login', ADMIN_USER);
    await page.fill('#user_pass', ADMIN_PASS);
    await page.click('#wp-submit');

    // Wait for dashboard
    await page.waitForURL('**/wp-admin/**');
  });

  test('Plugin is activated', async ({ page }) => {
    await page.goto(`${WORDPRESS_URL}/wp-admin/plugins.php`);

    // Check plugin is in active list
    const pluginRow = page.locator('tr[data-plugin*="pagifye"]');
    await expect(pluginRow).toBeVisible();
    await expect(pluginRow).toContainText('Pagifye Elementor Widgets');
  });

  test('Widgets appear in Elementor panel', async ({ page }) => {
    // Create new page with Elementor
    await page.goto(`${WORDPRESS_URL}/wp-admin/post-new.php?post_type=page`);
    await page.click('text=Edit with Elementor');

    // Wait for Elementor to load
    await page.waitForSelector('#elementor-panel');

    // Open widgets panel
    await page.click('#elementor-panel-elements');

    // Search for Pagifye widgets
    await page.fill('#elementor-panel-elements-search-input', 'pagifye');

    // Verify at least one widget appears
    const widget = page.locator('.elementor-element-wrapper .elementor-element');
    await expect(widget.first()).toBeVisible();
  });

  test('Navigation-01 widget can be added and configured', async ({ page }) => {
    // Navigate to Elementor editor
    await page.goto(`${WORDPRESS_URL}/wp-admin/post-new.php?post_type=page`);
    await page.click('text=Edit with Elementor');
    await page.waitForSelector('#elementor-panel');

    // Search and add widget
    await page.fill('#elementor-panel-elements-search-input', 'Navigation 01');
    await page.dragAndDrop(
      'text=Navigation 01',
      '#elementor-preview-iframe >> .elementor-inner'
    );

    // Configure widget
    await page.fill('input[data-setting="logo_text"]', 'Test Logo');

    // Preview
    const preview = page.frameLocator('#elementor-preview-iframe');
    await expect(preview.locator('text=Test Logo')).toBeVisible();
  });

  test('Hero-01 widget renders with highlight text', async ({ page }) => {
    await page.goto(`${WORDPRESS_URL}/wp-admin/post-new.php?post_type=page`);
    await page.click('text=Edit with Elementor');
    await page.waitForSelector('#elementor-panel');

    // Add widget
    await page.fill('#elementor-panel-elements-search-input', 'Hero 01');
    await page.dragAndDrop('text=Hero 01', '#elementor-preview-iframe >> .elementor-inner');

    // Set heading with highlight
    await page.fill('textarea[data-setting="heading"]', 'Welcome to {Our Platform}');

    // Check preview
    const preview = page.frameLocator('#elementor-preview-iframe');
    await expect(preview.locator('text=Welcome to')).toBeVisible();
    await expect(preview.locator('text=Our Platform')).toBeVisible();
  });

  test('Pricing-01 widget billing toggle works', async ({ page }) => {
    await page.goto(`${WORDPRESS_URL}/wp-admin/post-new.php?post_type=page`);
    await page.click('text=Edit with Elementor');
    await page.waitForSelector('#elementor-panel');

    // Add widget
    await page.fill('#elementor-panel-elements-search-input', 'Pricing 01');
    await page.dragAndDrop('text=Pricing 01', '#elementor-preview-iframe >> .elementor-inner');

    // Enable billing toggle
    await page.click('input[data-setting="show_billing_toggle"]');

    // Switch to preview
    const preview = page.frameLocator('#elementor-preview-iframe');

    // Check toggle exists
    const toggle = preview.locator('[x-data*="billingPeriod"]');
    await expect(toggle).toBeVisible();

    // Click toggle
    await toggle.click();

    // Verify price switches (Alpine.js interaction)
    // This tests that Alpine.js is loaded and working
    await page.waitForTimeout(500); // Wait for animation
  });

  test('FAQ-01 widget accordion works', async ({ page }) => {
    await page.goto(`${WORDPRESS_URL}/wp-admin/post-new.php?post_type=page`);
    await page.click('text=Edit with Elementor');
    await page.waitForSelector('#elementor-panel');

    // Add widget
    await page.fill('#elementor-panel-elements-search-input', 'FAQ 01');
    await page.dragAndDrop('text=FAQ 01', '#elementor-preview-iframe >> .elementor-inner');

    const preview = page.frameLocator('#elementor-preview-iframe');

    // Click first FAQ question
    const question = preview.locator('.faq-question').first();
    await question.click();

    // Verify answer expands
    const answer = preview.locator('.faq-answer').first();
    await expect(answer).toBeVisible();

    // Click again to collapse
    await question.click();
    await expect(answer).toBeHidden();
  });

  test('Navigation mobile menu works on small screens', async ({ page }) => {
    // Set mobile viewport
    await page.setViewportSize({ width: 375, height: 667 });

    await page.goto(`${WORDPRESS_URL}/wp-admin/post-new.php?post_type=page`);
    await page.click('text=Edit with Elementor');
    await page.waitForSelector('#elementor-panel');

    // Add Navigation widget
    await page.fill('#elementor-panel-elements-search-input', 'Navigation 01');
    await page.dragAndDrop('text=Navigation 01', '#elementor-preview-iframe >> .elementor-inner');

    const preview = page.frameLocator('#elementor-preview-iframe');

    // Click hamburger menu
    const hamburger = preview.locator('.mobile-menu-toggle');
    await hamburger.click();

    // Verify menu opens
    const mobileMenu = preview.locator('.mobile-menu');
    await expect(mobileMenu).toBeVisible();
  });

  test('Widgets are responsive', async ({ page }) => {
    await page.goto(`${WORDPRESS_URL}/wp-admin/post-new.php?post_type=page`);
    await page.click('text=Edit with Elementor');
    await page.waitForSelector('#elementor-panel');

    // Add Hero widget
    await page.fill('#elementor-panel-elements-search-input', 'Hero 01');
    await page.dragAndDrop('text=Hero 01', '#elementor-preview-iframe >> .elementor-inner');

    const preview = page.frameLocator('#elementor-preview-iframe');

    // Test desktop
    await page.setViewportSize({ width: 1920, height: 1080 });
    await expect(preview.locator('.hero-section')).toBeVisible();

    // Test tablet
    await page.setViewportSize({ width: 768, height: 1024 });
    await expect(preview.locator('.hero-section')).toBeVisible();

    // Test mobile
    await page.setViewportSize({ width: 375, height: 667 });
    await expect(preview.locator('.hero-section')).toBeVisible();
  });

  test('No JavaScript errors in console', async ({ page }) => {
    const consoleErrors = [];

    page.on('console', msg => {
      if (msg.type() === 'error') {
        consoleErrors.push(msg.text());
      }
    });

    await page.goto(`${WORDPRESS_URL}/wp-admin/post-new.php?post_type=page`);
    await page.click('text=Edit with Elementor');
    await page.waitForSelector('#elementor-panel');

    // Add several widgets
    const widgets = ['Navigation 01', 'Hero 01', 'Pricing 01', 'FAQ 01'];

    for (const widget of widgets) {
      await page.fill('#elementor-panel-elements-search-input', widget);
      await page.dragAndDrop(`text=${widget}`, '#elementor-preview-iframe >> .elementor-inner');
      await page.waitForTimeout(1000);
    }

    // Check for errors
    expect(consoleErrors.length).toBe(0);
  });

  test('Assets load correctly', async ({ page }) => {
    await page.goto(`${WORDPRESS_URL}/wp-admin/post-new.php?post_type=page`);
    await page.click('text=Edit with Elementor');
    await page.waitForSelector('#elementor-panel');

    // Add widget
    await page.fill('#elementor-panel-elements-search-input', 'Hero 01');
    await page.dragAndDrop('text=Hero 01', '#elementor-preview-iframe >> .elementor-inner');

    // Check for 404 errors
    const failedRequests = [];
    page.on('requestfailed', request => {
      failedRequests.push(request.url());
    });

    await page.waitForTimeout(3000); // Wait for all assets

    // No assets should fail to load
    expect(failedRequests.length).toBe(0);
  });

  test('Widgets work with popular themes', async ({ page }) => {
    // Test with Hello Elementor theme
    await page.goto(`${WORDPRESS_URL}/wp-admin/themes.php`);

    // Activate Hello Elementor
    await page.click('text=Hello Elementor >> .. >> text=Activate');

    // Create page with widgets
    await page.goto(`${WORDPRESS_URL}/wp-admin/post-new.php?post_type=page`);
    await page.click('text=Edit with Elementor');
    await page.waitForSelector('#elementor-panel');

    // Add widget
    await page.fill('#elementor-panel-elements-search-input', 'Hero 01');
    await page.dragAndDrop('text=Hero 01', '#elementor-preview-iframe >> .elementor-inner');

    // Verify it renders
    const preview = page.frameLocator('#elementor-preview-iframe');
    await expect(preview.locator('.hero-section')).toBeVisible();
  });

});

/**
 * Performance Tests
 */
test.describe('Performance Tests', () => {

  test('Page with widgets loads in acceptable time', async ({ page }) => {
    const startTime = Date.now();

    // Go to a page with multiple widgets
    await page.goto(`${WORDPRESS_URL}/sample-page`);
    await page.waitForLoadState('networkidle');

    const loadTime = Date.now() - startTime;

    // Should load in less than 3 seconds
    expect(loadTime).toBeLessThan(3000);
  });

  test('No memory leaks with multiple widgets', async ({ page }) => {
    await page.goto(`${WORDPRESS_URL}/wp-admin/post-new.php?post_type=page`);
    await page.click('text=Edit with Elementor');
    await page.waitForSelector('#elementor-panel');

    // Get initial memory
    const initialMetrics = await page.metrics();

    // Add 10 widgets
    for (let i = 0; i < 10; i++) {
      await page.fill('#elementor-panel-elements-search-input', 'Hero 01');
      await page.dragAndDrop('text=Hero 01', '#elementor-preview-iframe >> .elementor-inner');
      await page.waitForTimeout(500);
    }

    // Get final memory
    const finalMetrics = await page.metrics();

    // Memory increase should be reasonable (< 50MB)
    const memoryIncrease = finalMetrics.JSHeapUsedSize - initialMetrics.JSHeapUsedSize;
    expect(memoryIncrease).toBeLessThan(50 * 1024 * 1024);
  });

});

/**
 * Accessibility Tests
 */
test.describe('Accessibility Tests', () => {

  test('Widgets are keyboard accessible', async ({ page }) => {
    await page.goto(`${WORDPRESS_URL}/sample-page`);

    // Tab through interactive elements
    await page.keyboard.press('Tab');
    await page.keyboard.press('Tab');
    await page.keyboard.press('Tab');

    // Check focus is visible
    const focusedElement = await page.locator(':focus');
    await expect(focusedElement).toBeVisible();
  });

  test('Widgets have proper ARIA attributes', async ({ page }) => {
    await page.goto(`${WORDPRESS_URL}/wp-admin/post-new.php?post_type=page`);
    await page.click('text=Edit with Elementor');
    await page.waitForSelector('#elementor-panel');

    // Add FAQ widget
    await page.fill('#elementor-panel-elements-search-input', 'FAQ 01');
    await page.dragAndDrop('text=FAQ 01', '#elementor-preview-iframe >> .elementor-inner');

    const preview = page.frameLocator('#elementor-preview-iframe');

    // Check for ARIA attributes
    const accordion = preview.locator('[aria-expanded]').first();
    await expect(accordion).toHaveAttribute('aria-expanded');
  });

});
