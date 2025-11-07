# Testing Guide for Pagifye Elementor Widgets

This guide explains how to properly test all 34 components in the Pagifye Elementor Widgets plugin.

## Prerequisites

Ensure you have the following installed:

- **PHP 8.1+** (minimum 7.4)
- **Composer** (for PHPUnit)
- **Node.js 18+** (for Playwright E2E tests)
- **Docker & Docker Compose** (for local WordPress environment)

## Quick Start

### 1. Install Dependencies

```bash
# Install PHP testing dependencies (PHPUnit)
composer install

# Install E2E testing dependencies (Playwright)
cd tests
npm install
npx playwright install
cd ..
```

### 2. Start Local WordPress Environment

```bash
# Start WordPress + MySQL + phpMyAdmin
docker-compose up -d

# Wait for services to be ready (about 30-60 seconds)
docker-compose logs -f wordpress-dev
```

**Services:**
- WordPress Dev: http://localhost:8080
- phpMyAdmin: http://localhost:8081
- MySQL: localhost:3306

### 3. Configure WordPress (First Time Only)

```bash
# Complete WordPress setup
# Open http://localhost:8080 in your browser
# Follow the installation wizard:
# - Site Title: Pagifye Test Site
# - Username: admin
# - Password: password (or your choice)
# - Email: your@email.com

# Then install Elementor plugin via WordPress admin:
# - Go to Plugins > Add New
# - Search for "Elementor"
# - Install and Activate
```

### 4. Activate the Plugin

```bash
# Option 1: Via WordPress Admin
# Go to http://localhost:8080/wp-admin/plugins.php
# Find "Pagifye Elementor Widgets" and click Activate

# Option 2: Via WP-CLI (if available)
docker-compose run --rm wpcli wp plugin activate pagifye-elementor-widgets
```

## Running Tests

### PHP Unit Tests

PHPUnit tests verify plugin activation, widget registration, and basic rendering.

```bash
# Run all PHPUnit tests
vendor/bin/phpunit

# Run specific test file
vendor/bin/phpunit tests/test-plugin-activation.php
vendor/bin/phpunit tests/test-widget-registration.php
vendor/bin/phpunit tests/test-widget-rendering.php

# Run with code coverage report
vendor/bin/phpunit --coverage-html coverage
# View coverage: open coverage/index.html in browser
```

### End-to-End Tests (Playwright)

E2E tests use real browser automation to test widgets in Elementor editor.

```bash
# Set environment variables
export WP_URL=http://localhost:8080
export WP_ADMIN_USER=admin
export WP_ADMIN_PASS=password

# Run all E2E tests (chromium only)
cd tests
npx playwright test --project=chromium

# Run in headed mode (watch browser)
npx playwright test --project=chromium --headed

# Run specific test file
npx playwright test e2e/test-widgets.spec.js --project=chromium

# Debug mode (step through tests)
npx playwright test --debug

# Interactive UI mode
npx playwright test --ui

# View test report
npx playwright show-report
```

### Test All Browsers

```bash
# Run on all configured browsers
cd tests
npx playwright test

# This will test on:
# - Desktop Chrome
# - Desktop Firefox
# - Desktop Safari (WebKit)
# - Mobile Chrome (Pixel 5)
# - Mobile Safari (iPhone 12)
# - Tablet (iPad Pro)
```

## Test Coverage

### Automated Tests (Playwright)

The E2E test suite covers:

1. **Plugin Activation** - Verify plugin loads correctly
2. **Widget Visibility** - All widgets appear in Elementor panel
3. **Widget Configuration** - Can add and configure each widget
4. **Interactive Features**:
   - Navigation mobile menu toggle
   - FAQ accordion expand/collapse
   - Pricing billing toggle (monthly/yearly)
   - Hero text highlighting
5. **Responsive Design** - Desktop, tablet, mobile viewports
6. **JavaScript Errors** - No console errors when loading widgets
7. **Asset Loading** - All CSS/JS files load successfully
8. **Performance** - Page loads in < 3 seconds
9. **Memory** - No memory leaks with multiple widgets
10. **Accessibility** - Keyboard navigation and ARIA attributes
11. **Theme Compatibility** - Works with Hello Elementor theme

### Manual Testing Checklist

For thorough testing, see:
- **Complete Test Plan**: `/docs/TEST_PLAN.md` (300+ test cases)
- **Quick Checklist**: `/docs/QUICK_TEST_CHECKLIST.md` (2-3 hours)
- **Test Tracking**: `/tests/TEST_TRACKING.csv` (track progress)

## Testing Individual Widgets

### Test a Specific Widget

1. Start WordPress: `docker-compose up -d`
2. Open Elementor editor: http://localhost:8080/wp-admin/post-new.php?post_type=page
3. Click "Edit with Elementor"
4. Search for widget (e.g., "Navigation 01")
5. Drag widget to canvas
6. Configure settings in left panel
7. Test interactions (hover, click, toggle)
8. Switch to mobile view (bottom toolbar)
9. Preview page (click "Preview" button)
10. Publish and view on frontend

### Priority Widgets to Test First

1. **Navigation-01** - Mobile menu, responsive behavior
2. **Hero-01** - Text highlighting, responsive layout
3. **Pricing-01** - Billing toggle (Alpine.js), card layouts
4. **FAQ-01** - Accordion functionality (Alpine.js)
5. **Testimonial-02** - Image handling, text content

## Common Issues

### WordPress Not Loading

```bash
# Check container status
docker-compose ps

# View logs
docker-compose logs wordpress-dev

# Restart containers
docker-compose restart
```

### Plugin Not Appearing

```bash
# Check plugin is mounted correctly
docker-compose exec wordpress-dev ls -la /var/www/html/wp-content/plugins/

# Verify file permissions
docker-compose exec wordpress-dev ls -la /var/www/html/wp-content/plugins/pagifye-elementor-widgets/
```

### Elementor Not Installed

```bash
# Install Elementor via WordPress admin
# Or use WP-CLI:
docker-compose run --rm wpcli wp plugin install elementor --activate
```

### Playwright Tests Failing

```bash
# Make sure WordPress is accessible
curl http://localhost:8080

# Verify credentials match
export WP_ADMIN_USER=admin
export WP_ADMIN_PASS=password

# Run single test in debug mode
cd tests
npx playwright test e2e/test-widgets.spec.js --project=chromium --debug
```

### Port Already in Use

```bash
# If port 8080 is busy, edit docker-compose.yml
# Change wordpress-dev ports to "8082:80"
# Then update WP_URL: export WP_URL=http://localhost:8082
```

## Test Reports

### PHPUnit Reports

```bash
# Generate coverage report
vendor/bin/phpunit --coverage-html coverage

# View report
open coverage/index.html  # macOS
xdg-open coverage/index.html  # Linux
```

### Playwright Reports

```bash
# View last test report
cd tests
npx playwright show-report

# Reports are saved in tests/playwright-report/
```

## CI/CD Integration

For automated testing in GitHub Actions or other CI systems, see:
- `/tests/README.md` - CI/CD examples
- `.github/workflows/` - GitHub Actions configuration (if exists)

## Performance Testing

```bash
# Test page load performance
cd tests
npx playwright test --grep "Performance" --project=chromium

# Results should show:
# - Page load < 3 seconds
# - Memory usage < 50MB increase
# - No failed asset requests
```

## Accessibility Testing

```bash
# Test keyboard navigation and ARIA
cd tests
npx playwright test --grep "Accessibility" --project=chromium

# For manual accessibility testing:
# 1. Use keyboard to navigate (Tab, Enter, Space, Arrow keys)
# 2. Test with screen reader (NVDA, JAWS, VoiceOver)
# 3. Check color contrast ratios
# 4. Verify focus indicators are visible
```

## Cleanup

```bash
# Stop all containers
docker-compose down

# Remove volumes (fresh start)
docker-compose down -v

# Remove coverage reports
rm -rf coverage tests/playwright-report tests/test-results
```

## Test Sign-Off Criteria

Plugin is ready for release when:

- [x] All 34 widgets load in Elementor panel
- [x] All automated tests pass (PHPUnit + Playwright)
- [ ] 0 critical bugs
- [ ] < 5 high priority bugs
- [ ] Performance targets met (< 3s load time)
- [ ] No JavaScript console errors
- [ ] Works on all target browsers (Chrome, Firefox, Safari)
- [ ] Responsive on mobile, tablet, desktop
- [ ] Accessibility compliant (WCAG 2.1 AA)
- [ ] Compatible with popular themes (Hello Elementor, Astra, etc.)

## Resources

- **Test Documentation**: `/tests/README.md`
- **Test Plan**: `/docs/TEST_PLAN.md`
- **Quick Checklist**: `/docs/QUICK_TEST_CHECKLIST.md`
- **PHPUnit Docs**: https://phpunit.de/documentation.html
- **Playwright Docs**: https://playwright.dev
- **Elementor Dev Docs**: https://developers.elementor.com

## Getting Help

- **Report Issues**: Create GitHub issue with test failure details
- **Questions**: Open GitHub discussion
- **Documentation**: See `/docs/` folder

---

**Last Updated**: 2025-11-07
**Version**: 1.0.0
