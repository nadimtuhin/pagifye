# Pagifye Elementor Widgets - Test Suite

Comprehensive testing suite for all 34 Pagifye Elementor widgets.

---

## 📋 Test Documentation

- **[Complete Test Plan](../docs/TEST_PLAN.md)** - Comprehensive test cases (300+ tests)
- **[Quick Test Checklist](../docs/QUICK_TEST_CHECKLIST.md)** - Fast verification (2-3 hours)
- **[Test Tracking](TEST_TRACKING.csv)** - Test execution tracking spreadsheet

---

## 🧪 Test Types

### 1. Unit Tests (PHPUnit)
- Plugin activation
- Widget registration
- Widget rendering
- Output escaping

### 2. Integration Tests (PHPUnit)
- Multi-widget pages
- Theme compatibility
- Plugin compatibility

### 3. End-to-End Tests (Playwright)
- Browser automation
- User interactions
- Alpine.js functionality
- Responsive design

### 4. Manual Tests
- Accessibility (WCAG 2.1 AA)
- Visual regression
- Cross-browser testing

---

## 🚀 Quick Start

### Prerequisites

```bash
# PHP 8.1+
php -v

# Composer
composer --version

# Node.js 18+
node -v

# Playwright
npm install -g playwright
```

### Setup Test Environment

```bash
# Install WordPress test library
bash bin/install-wp-tests.sh wordpress_test root '' localhost latest

# Install PHPUnit
composer install

# Install Playwright
cd tests
npm install
npx playwright install
```

---

## 🏃 Running Tests

### PHP Unit Tests

```bash
# Run all PHPUnit tests
vendor/bin/phpunit

# Run specific test file
vendor/bin/phpunit tests/test-plugin-activation.php

# Run with coverage
vendor/bin/phpunit --coverage-html coverage
```

### E2E Tests (Playwright)

```bash
# Run all E2E tests
cd tests
npm test

# Run in headed mode (see browser)
npm run test:headed

# Run specific test file
npx playwright test e2e/test-widgets.spec.js

# Debug mode
npm run test:debug

# Interactive UI mode
npm run test:ui

# View test report
npm run test:report
```

### Manual Testing

```bash
# Follow quick checklist
# See: docs/QUICK_TEST_CHECKLIST.md

# Time required: 2-3 hours
```

---

## 📊 Test Coverage

### Widget Tests
- [ ] Navigation (3 widgets) - 17 test cases each
- [ ] Hero (5 widgets) - 20 test cases each
- [ ] Pricing (3 widgets) - 18 test cases each
- [ ] FAQ (3 widgets) - 16 test cases each
- [ ] Testimonial (3 widgets) - 15 test cases each
- [ ] Content (3 widgets) - 8 test cases each
- [ ] Metrics (2 widgets) - 7 test cases each
- [ ] Team (3 widgets) - 8 test cases each
- [ ] Contact (3 widgets) - 6 test cases each
- [ ] Awards (3 widgets) - 5 test cases each
- [ ] Blog (3 widgets) - 8 test cases each

### Integration Tests
- Multi-widget pages
- Theme compatibility (5 themes)
- Plugin compatibility (5 plugins)
- Elementor Pro compatibility

### Performance Tests
- Page load time (< 3s target)
- Asset loading
- Database queries
- Memory usage

### Security Tests
- XSS protection
- SQL injection prevention
- File upload security
- Nonce verification
- Capability checks

### Accessibility Tests
- Keyboard navigation
- Screen reader compatibility
- ARIA attributes
- Color contrast (WCAG AA)
- Focus management

### Browser Tests
- Chrome (latest 2 versions)
- Firefox (latest 2 versions)
- Safari (latest 2 versions)
- Edge (latest)
- Mobile browsers

---

## 📝 Writing Tests

### PHPUnit Test Example

```php
<?php
class Test_My_Widget extends WP_UnitTestCase {
    public function test_widget_renders() {
        $widget = $this->get_widget_instance( 'my-widget' );
        $widget->set_settings( [ 'heading' => 'Test' ] );

        ob_start();
        $widget->render();
        $output = ob_get_clean();

        $this->assertStringContainsString( 'Test', $output );
    }
}
```

### Playwright Test Example

```javascript
test('my widget works', async ({ page }) => {
  await page.goto('/wp-admin/post-new.php?post_type=page');
  await page.click('text=Edit with Elementor');

  // Add widget
  await page.fill('#elementor-panel-elements-search-input', 'My Widget');
  await page.dragAndDrop('text=My Widget', '.elementor-inner');

  // Verify
  const preview = page.frameLocator('#elementor-preview-iframe');
  await expect(preview.locator('.my-widget')).toBeVisible();
});
```

---

## 🐛 Bug Reporting

When you find a bug during testing:

1. **Check** if it's already reported
2. **Document** using bug report template (see TEST_PLAN.md)
3. **Log** in TEST_TRACKING.csv
4. **Create** GitHub issue with:
   - Bug ID
   - Steps to reproduce
   - Expected vs actual behavior
   - Screenshots
   - Environment details

---

## 📈 Test Metrics

Track these metrics in TEST_TRACKING.csv:

- Tests executed
- Tests passed/failed
- Bugs found
- Critical bugs (must be 0)
- Test coverage %
- Time spent

---

## ✅ Test Sign-Off

Plugin ready for release when:

- [ ] All 34 widgets tested
- [ ] All critical tests pass
- [ ] 0 critical bugs
- [ ] < 5 high priority bugs
- [ ] Performance targets met
- [ ] Security tests pass
- [ ] Accessibility compliant (WCAG AA)
- [ ] Works on all target browsers
- [ ] Responsive on all devices

---

## 🔧 CI/CD Integration

### GitHub Actions Example

```yaml
name: Tests

on: [push, pull_request]

jobs:
  phpunit:
    runs-on: ubuntu-latest
    steps:
      - uses: actions/checkout@v2
      - name: Setup PHP
        uses: shivammathur/setup-php@v2
        with:
          php-version: '8.1'
      - name: Install dependencies
        run: composer install
      - name: Run tests
        run: vendor/bin/phpunit

  playwright:
    runs-on: ubuntu-latest
    steps:
      - uses: actions/checkout@v2
      - name: Setup Node
        uses: actions/setup-node@v2
        with:
          node-version: '18'
      - name: Install dependencies
        run: |
          cd tests
          npm ci
          npx playwright install
      - name: Run E2E tests
        run: cd tests && npm test
```

---

## 📞 Support

- **Documentation:** See `/docs/` folder
- **Issues:** Report on GitHub
- **Questions:** Create GitHub discussion

---

## 📚 Resources

- [PHPUnit Documentation](https://phpunit.de/documentation.html)
- [Playwright Documentation](https://playwright.dev)
- [WordPress Testing](https://make.wordpress.org/core/handbook/testing/automated-testing/phpunit/)
- [Elementor Developer Docs](https://developers.elementor.com)

---

**Test Suite Version:** 1.0.0
**Last Updated:** 2025-11-06
**Maintained By:** QA Team
