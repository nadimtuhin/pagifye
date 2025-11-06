# Pagifye Elementor Widgets - Comprehensive Test Plan

**Version:** 1.0.0
**Last Updated:** 2025-11-06
**Status:** Ready for Testing

---

## 📋 Table of Contents

1. [Test Overview](#test-overview)
2. [Test Environment](#test-environment)
3. [Widget Test Cases](#widget-test-cases)
4. [Integration Tests](#integration-tests)
5. [Performance Tests](#performance-tests)
6. [Security Tests](#security-tests)
7. [Accessibility Tests](#accessibility-tests)
8. [Test Execution](#test-execution)

---

## 🎯 Test Overview

### Testing Scope
- **Total Widgets:** 34 Pagifye widgets + 1 test widget
- **Categories:** 11 widget categories
- **Test Types:** Functional, Integration, Performance, Security, Accessibility
- **Estimated Test Time:** 40-50 hours

### Testing Objectives
✅ Verify all widgets render correctly
✅ Validate Elementor controls functionality
✅ Ensure responsive design works
✅ Confirm Alpine.js interactions
✅ Verify security and data sanitization
✅ Check accessibility compliance
✅ Validate performance metrics

### Test Criteria
- **Pass:** Feature works as expected with no errors
- **Fail:** Feature doesn't work or produces errors
- **Blocked:** Cannot test due to dependency
- **Skip:** Test not applicable

---

## 🖥️ Test Environment

### Required Setup

#### WordPress Environment
```
WordPress Version:    6.4+ (test with 6.4, 6.5, 6.6)
PHP Version:         8.1+ (test with 8.1, 8.2, 8.3)
MySQL/MariaDB:       5.7+ / 10.3+
Memory Limit:        256MB minimum
```

#### Required Plugins
```
Elementor:           3.16+ (required)
Elementor Pro:       3.16+ (optional, for testing compatibility)
```

#### Test Browsers
- Chrome (latest 2 versions)
- Firefox (latest 2 versions)
- Safari (latest 2 versions)
- Edge (latest 2 versions)
- Mobile Safari (iOS 15+)
- Chrome Mobile (Android 11+)

#### Test Devices/Viewports
- Desktop: 1920px, 1440px, 1280px
- Tablet: 1024px, 768px
- Mobile: 414px, 375px, 360px

#### WordPress Themes to Test
- Twenty Twenty-Four (default)
- Astra
- GeneratePress
- Hello Elementor

---

## 📝 Widget Test Cases

### Navigation Widgets (3 widgets)

#### TC-NAV-001: Navigation-01 Widget
**Priority:** HIGH
**Category:** Navigation
**Estimated Time:** 45 minutes

##### Test Cases

**TC-NAV-001-01: Widget Registration**
- **Objective:** Verify widget appears in Elementor panel
- **Steps:**
  1. Open Elementor editor
  2. Search for "Navigation 01" in widget panel
  3. Verify widget is under "Pagifye" category
- **Expected:** Widget appears in panel with correct icon and name
- **Status:** [ ] Pass [ ] Fail

**TC-NAV-001-02: Logo Image Upload**
- **Objective:** Verify logo image can be uploaded and displayed
- **Steps:**
  1. Drag Navigation-01 widget to page
  2. In Content > Logo section, set Logo Type to "Image"
  3. Upload a logo image (PNG, JPG, SVG)
  4. Preview page
- **Expected:** Logo image displays correctly
- **Test Data:** Test with 100x40px, 200x80px, SVG logo
- **Status:** [ ] Pass [ ] Fail

**TC-NAV-001-03: Logo Text Display**
- **Objective:** Verify logo text mode works
- **Steps:**
  1. In Content > Logo section, set Logo Type to "Text"
  2. Enter "Test Logo" in Logo Text field
  3. Preview page
- **Expected:** Text logo displays instead of image
- **Status:** [ ] Pass [ ] Fail

**TC-NAV-001-04: Logo Link**
- **Objective:** Verify logo is clickable with correct link
- **Steps:**
  1. Set Logo Link to "https://example.com"
  2. Enable "Open in new tab"
  3. Preview and click logo
- **Expected:** Link opens in new tab to correct URL
- **Status:** [ ] Pass [ ] Fail

**TC-NAV-001-05: Menu Items**
- **Objective:** Verify menu items display and link correctly
- **Steps:**
  1. In Content > Menu Items, add 5 menu items
  2. Set text and links for each
  3. Preview page
- **Expected:** All menu items visible in desktop view
- **Status:** [ ] Pass [ ] Fail

**TC-NAV-001-06: Dropdown Menu**
- **Objective:** Verify dropdown submenu functionality
- **Steps:**
  1. Add menu item with "Has Dropdown" enabled
  2. Add 4 dropdown items in format: "Text|URL"
  3. Preview page
  4. Hover over parent menu item
- **Expected:** Dropdown appears on hover with all items
- **Status:** [ ] Pass [ ] Fail

**TC-NAV-001-07: Dropdown Icon Rotation**
- **Objective:** Verify dropdown arrow rotates on hover
- **Steps:**
  1. Add menu item with dropdown
  2. Preview page
  3. Hover over menu item
- **Expected:** Arrow icon rotates 180 degrees smoothly
- **Status:** [ ] Pass [ ] Fail

**TC-NAV-001-08: Mobile Menu Toggle**
- **Objective:** Verify mobile menu opens/closes with Alpine.js
- **Steps:**
  1. Resize browser to mobile view (< 1024px)
  2. Click hamburger menu icon
  3. Verify menu panel opens
  4. Click icon again
- **Expected:** Menu toggles open/closed smoothly
- **Test Data:** Test at 768px, 414px, 375px
- **Status:** [ ] Pass [ ] Fail

**TC-NAV-001-09: Mobile Menu Items**
- **Objective:** Verify mobile menu displays correct items
- **Steps:**
  1. Add 5 mobile menu items
  2. Set different text from desktop menu
  3. Preview in mobile view
- **Expected:** Mobile menu shows mobile-specific items
- **Status:** [ ] Pass [ ] Fail

**TC-NAV-001-10: CTA Buttons (Sign In)**
- **Objective:** Verify Sign In button displays and functions
- **Steps:**
  1. Enable "Show Sign In Button"
  2. Set button text and link
  3. Preview page
  4. Click button
- **Expected:** Button visible, styled correctly, links work
- **Status:** [ ] Pass [ ] Fail

**TC-NAV-001-11: CTA Buttons (Get Started)**
- **Objective:** Verify Get Started button displays and functions
- **Steps:**
  1. Enable "Show Get Started Button"
  2. Set button text and link
  3. Preview page
  4. Click button
- **Expected:** Button visible with primary styling, links work
- **Status:** [ ] Pass [ ] Fail

**TC-NAV-001-12: Style Controls - Background**
- **Objective:** Verify background styling applies
- **Steps:**
  1. Go to Style > Navigation Container
  2. Set background color to #333333
  3. Preview page
- **Expected:** Navigation background changes to dark gray
- **Status:** [ ] Pass [ ] Fail

**TC-NAV-001-13: Style Controls - Typography**
- **Objective:** Verify menu typography controls work
- **Steps:**
  1. Go to Style > Menu Items
  2. Change font family, size, weight
  3. Preview page
- **Expected:** Menu text styling updates accordingly
- **Status:** [ ] Pass [ ] Fail

**TC-NAV-001-14: Style Controls - Colors**
- **Objective:** Verify menu color controls work
- **Steps:**
  1. Go to Style > Menu Items
  2. Set Text Color to #FF0000
  3. Preview page
- **Expected:** Menu items appear in red
- **Status:** [ ] Pass [ ] Fail

**TC-NAV-001-15: Responsive - Desktop**
- **Objective:** Verify desktop layout at various widths
- **Steps:**
  1. Preview at 1920px, 1440px, 1280px
  2. Check menu alignment and spacing
- **Expected:** All elements visible and properly spaced
- **Status:** [ ] Pass [ ] Fail

**TC-NAV-001-16: Responsive - Tablet**
- **Objective:** Verify tablet layout
- **Steps:**
  1. Preview at 1024px and 768px
  2. Check if mobile menu appears at correct breakpoint
- **Expected:** Mobile menu appears below 1024px
- **Status:** [ ] Pass [ ] Fail

**TC-NAV-001-17: Responsive - Mobile**
- **Objective:** Verify mobile layout
- **Steps:**
  1. Preview at 414px, 375px, 360px
  2. Check mobile menu functionality
- **Expected:** Mobile menu works smoothly on all sizes
- **Status:** [ ] Pass [ ] Fail

---

#### TC-NAV-003: Navigation-03 Widget
**Priority:** MEDIUM
**Category:** Navigation
**Estimated Time:** 40 minutes

##### Test Cases

**TC-NAV-003-01: Rounded Container Style**
- **Objective:** Verify rounded navigation container
- **Steps:**
  1. Add Navigation-03 widget
  2. Check default styling
  3. Verify border-radius applied
- **Expected:** Navigation has rounded full corners
- **Status:** [ ] Pass [ ] Fail

**TC-NAV-003-02: Theme Toggle Display**
- **Objective:** Verify light/dark theme toggle appears
- **Steps:**
  1. Enable "Show Theme Toggle"
  2. Preview page
  3. Check toggle button appearance
- **Expected:** Theme toggle with sun/moon icons visible
- **Status:** [ ] Pass [ ] Fail

**TC-NAV-003-03: Theme Toggle Icons**
- **Objective:** Verify custom icons can be set
- **Steps:**
  1. Upload custom light icon
  2. Upload custom dark icon
  3. Preview page
- **Expected:** Custom icons display in toggle
- **Status:** [ ] Pass [ ] Fail

**TC-NAV-003-04: Container Padding**
- **Objective:** Verify padding controls work
- **Steps:**
  1. Go to Style > Navigation Container
  2. Set padding to 20px all sides
  3. Preview page
- **Expected:** Container padding increases visibly
- **Status:** [ ] Pass [ ] Fail

**TC-NAV-003-05: All Navigation-01 Tests**
- **Objective:** Verify all base navigation features work
- **Steps:**
  1. Run all TC-NAV-001 tests (excluding unique features)
- **Expected:** All common features work identically
- **Status:** [ ] Pass [ ] Fail

---

#### TC-NAV-005: Navigation-05 Widget
**Priority:** MEDIUM
**Category:** Navigation
**Estimated Time:** 35 minutes

##### Test Cases

**TC-NAV-005-01: Standard Layout**
- **Objective:** Verify standard horizontal layout
- **Steps:**
  1. Add Navigation-05 widget
  2. Check default layout
- **Expected:** Logo left, menu center, buttons right
- **Status:** [ ] Pass [ ] Fail

**TC-NAV-005-02: Logo and Menu Grouping**
- **Objective:** Verify logo and menu are grouped together
- **Steps:**
  1. Preview widget
  2. Check layout structure
- **Expected:** Logo and menu in same flex container
- **Status:** [ ] Pass [ ] Fail

**TC-NAV-005-03: All Navigation-01 Tests**
- **Objective:** Verify all base navigation features work
- **Steps:**
  1. Run all TC-NAV-001 tests
- **Expected:** All common features work identically
- **Status:** [ ] Pass [ ] Fail

---

### Hero Widgets (5 widgets)

#### TC-HERO-001: Hero-01 Widget
**Priority:** HIGH
**Category:** Hero
**Estimated Time:** 50 minutes

##### Test Cases

**TC-HERO-001-01: Widget Registration**
- **Objective:** Verify widget appears in Elementor panel
- **Steps:**
  1. Open Elementor editor
  2. Search for "Hero 01" in widget panel
- **Expected:** Widget appears under "Pagifye" category
- **Status:** [ ] Pass [ ] Fail

**TC-HERO-001-02: Heading Text**
- **Objective:** Verify heading displays correctly
- **Steps:**
  1. Add Hero-01 widget
  2. Enter heading: "Welcome to Our Platform"
  3. Preview page
- **Expected:** Heading displays with proper styling
- **Status:** [ ] Pass [ ] Fail

**TC-HERO-001-03: Heading Highlight Text**
- **Objective:** Verify text between {curly braces} is highlighted
- **Steps:**
  1. Enter heading: "Welcome to {Our Platform}"
  2. Preview page
- **Expected:** "Our Platform" appears with highlight color
- **Status:** [ ] Pass [ ] Fail

**TC-HERO-001-04: Heading HTML Tag**
- **Objective:** Verify heading tag can be changed
- **Steps:**
  1. Set Heading HTML Tag to H2
  2. Inspect page source
- **Expected:** Heading uses <h2> tag
- **Status:** [ ] Pass [ ] Fail

**TC-HERO-001-05: Description Text**
- **Objective:** Verify description displays
- **Steps:**
  1. Enter description text (100 words)
  2. Preview page
- **Expected:** Description appears below heading
- **Status:** [ ] Pass [ ] Fail

**TC-HERO-001-06: Hero Image Upload**
- **Objective:** Verify hero image displays
- **Steps:**
  1. Upload hero image (1200x800px)
  2. Preview page
- **Expected:** Image displays on right side
- **Status:** [ ] Pass [ ] Fail

**TC-HERO-001-07: Image Position (Left/Right)**
- **Objective:** Verify image can be positioned left or right
- **Steps:**
  1. Set Image Position to "Left"
  2. Preview page
  3. Change to "Right"
  4. Preview again
- **Expected:** Layout flips correctly
- **Status:** [ ] Pass [ ] Fail

**TC-HERO-001-08: CTA Buttons Repeater**
- **Objective:** Verify multiple CTA buttons can be added
- **Steps:**
  1. Add 3 buttons using repeater
  2. Set different text and links for each
  3. Preview page
- **Expected:** All 3 buttons display in a row
- **Status:** [ ] Pass [ ] Fail

**TC-HERO-001-09: Button Styles (Primary/Secondary)**
- **Objective:** Verify button style options work
- **Steps:**
  1. Add 2 buttons
  2. Set first to "Primary", second to "Secondary"
  3. Preview page
- **Expected:** Buttons have different visual styles
- **Status:** [ ] Pass [ ] Fail

**TC-HERO-001-10: Button Icons**
- **Objective:** Verify button icons can be added
- **Steps:**
  1. Add button with icon enabled
  2. Select arrow icon
  3. Preview page
- **Expected:** Icon appears in button
- **Status:** [ ] Pass [ ] Fail

**TC-HERO-001-11: Background Color**
- **Objective:** Verify background color control works
- **Steps:**
  1. Go to Style > Section
  2. Set background color
  3. Preview page
- **Expected:** Section background changes
- **Status:** [ ] Pass [ ] Fail

**TC-HERO-001-12: Content Width**
- **Objective:** Verify content width can be adjusted
- **Steps:**
  1. Go to Style > Layout
  2. Adjust content width slider
  3. Preview page
- **Expected:** Content area width changes
- **Status:** [ ] Pass [ ] Fail

**TC-HERO-001-13: Heading Typography**
- **Objective:** Verify heading typography controls
- **Steps:**
  1. Go to Style > Heading
  2. Change font family, size, weight
  3. Preview page
- **Expected:** Heading typography updates
- **Status:** [ ] Pass [ ] Fail

**TC-HERO-001-14: Heading Color**
- **Objective:** Verify heading color control
- **Steps:**
  1. Go to Style > Heading
  2. Set color to #000000
  3. Preview page
- **Expected:** Heading appears in black
- **Status:** [ ] Pass [ ] Fail

**TC-HERO-001-15: Highlight Color**
- **Objective:** Verify highlight color control works
- **Steps:**
  1. Enter heading with {highlight text}
  2. Go to Style > Heading
  3. Set Highlight Color to #FF6B00
  4. Preview page
- **Expected:** Highlighted text appears in orange
- **Status:** [ ] Pass [ ] Fail

**TC-HERO-001-16: Description Typography**
- **Objective:** Verify description typography controls
- **Steps:**
  1. Go to Style > Description
  2. Adjust typography settings
  3. Preview page
- **Expected:** Description styling updates
- **Status:** [ ] Pass [ ] Fail

**TC-HERO-001-17: Button Styling**
- **Objective:** Verify button style controls work
- **Steps:**
  1. Go to Style > Buttons
  2. Adjust padding, background, colors
  3. Preview page
- **Expected:** Button styling updates
- **Status:** [ ] Pass [ ] Fail

**TC-HERO-001-18: Responsive - Desktop**
- **Objective:** Verify desktop responsive behavior
- **Steps:**
  1. Preview at 1920px, 1440px, 1280px
  2. Check two-column layout maintained
- **Expected:** Image and content side-by-side
- **Status:** [ ] Pass [ ] Fail

**TC-HERO-001-19: Responsive - Tablet**
- **Objective:** Verify tablet responsive behavior
- **Steps:**
  1. Preview at 1024px and 768px
  2. Check layout adaptation
- **Expected:** Layout stacks vertically on tablet
- **Status:** [ ] Pass [ ] Fail

**TC-HERO-001-20: Responsive - Mobile**
- **Objective:** Verify mobile responsive behavior
- **Steps:**
  1. Preview at 414px, 375px, 360px
  2. Check content readability
- **Expected:** All content readable and accessible
- **Status:** [ ] Pass [ ] Fail

---

#### TC-HERO-003: Hero-03 Widget
**Priority:** MEDIUM
**Category:** Hero
**Estimated Time:** 45 minutes

##### Test Cases

**TC-HERO-003-01: Background Image**
- **Objective:** Verify full-width background image
- **Steps:**
  1. Add Hero-03 widget
  2. Upload background image
  3. Preview page
- **Expected:** Image covers full hero section
- **Status:** [ ] Pass [ ] Fail

**TC-HERO-003-02: Background Overlay**
- **Objective:** Verify gradient overlay on background
- **Steps:**
  1. Set overlay gradient
  2. Preview page
- **Expected:** Gradient overlay visible over image
- **Status:** [ ] Pass [ ] Fail

**TC-HERO-003-03: Content Positioning**
- **Objective:** Verify content positioned on left with overlay
- **Steps:**
  1. Add content
  2. Preview page
- **Expected:** Content readable with overlay background
- **Status:** [ ] Pass [ ] Fail

**TC-HERO-003-04: Rating Stars**
- **Objective:** Verify rating stars display
- **Steps:**
  1. Enable rating section
  2. Preview page
- **Expected:** 5 stars display with rating text
- **Status:** [ ] Pass [ ] Fail

**TC-HERO-003-05: All Hero-01 Common Tests**
- **Objective:** Verify shared hero features work
- **Steps:**
  1. Test heading, description, buttons (TC-HERO-001-02 to 09)
- **Expected:** All common features work
- **Status:** [ ] Pass [ ] Fail

---

#### TC-HERO-004: Hero-04 Widget
**Priority:** MEDIUM
**Category:** Hero
**Estimated Time:** 40 minutes

##### Test Cases

**TC-HERO-004-01: Unique Layout**
- **Objective:** Verify Hero-04 specific layout
- **Steps:**
  1. Add Hero-04 widget
  2. Check layout structure
  3. Preview page
- **Expected:** Layout matches design specifications
- **Status:** [ ] Pass [ ] Fail

**TC-HERO-004-02: All Hero-01 Common Tests**
- **Objective:** Verify shared hero features work
- **Steps:**
  1. Run applicable Hero-01 tests
- **Expected:** Common features work correctly
- **Status:** [ ] Pass [ ] Fail

---

#### TC-HERO-006 & TC-HERO-007: Hero-06 and Hero-07 Widgets
**Priority:** MEDIUM
**Category:** Hero
**Estimated Time:** 35 minutes each

##### Test Cases
- Follow Hero-01 test pattern
- Test unique layout features
- Verify all common hero functionality

---

### Pricing Widgets (3 widgets)

#### TC-PRICING-001: Pricing-01 Widget
**Priority:** HIGH
**Category:** Pricing
**Estimated Time:** 60 minutes

##### Test Cases

**TC-PRICING-001-01: Widget Registration**
- **Objective:** Verify widget appears in Elementor panel
- **Steps:**
  1. Open Elementor editor
  2. Search for "Pricing 01"
- **Expected:** Widget appears under "Pagifye" category
- **Status:** [ ] Pass [ ] Fail

**TC-PRICING-001-02: Section Heading**
- **Objective:** Verify section heading displays
- **Steps:**
  1. Add Pricing-01 widget
  2. Enter heading text
  3. Preview page
- **Expected:** Heading displays above pricing cards
- **Status:** [ ] Pass [ ] Fail

**TC-PRICING-001-03: Billing Toggle**
- **Objective:** Verify monthly/annual toggle works (Alpine.js)
- **Steps:**
  1. Enable billing toggle
  2. Preview page
  3. Click toggle button
- **Expected:** Toggle switches between monthly/annual
- **Status:** [ ] Pass [ ] Fail

**TC-PRICING-001-04: Pricing Cards Repeater**
- **Objective:** Verify multiple pricing cards can be added
- **Steps:**
  1. Add 3 pricing cards using repeater
  2. Set different data for each
  3. Preview page
- **Expected:** All 3 cards display in grid
- **Status:** [ ] Pass [ ] Fail

**TC-PRICING-001-05: Card - Plan Name**
- **Objective:** Verify plan name displays
- **Steps:**
  1. Set plan name to "Professional"
  2. Preview page
- **Expected:** Plan name appears in card header
- **Status:** [ ] Pass [ ] Fail

**TC-PRICING-001-06: Card - Monthly Price**
- **Objective:** Verify monthly price displays
- **Steps:**
  1. Set monthly price to "$29"
  2. Preview with monthly billing selected
- **Expected:** $29 displays prominently
- **Status:** [ ] Pass [ ] Fail

**TC-PRICING-001-07: Card - Annual Price**
- **Objective:** Verify annual price displays
- **Steps:**
  1. Set annual price to "$290"
  2. Preview with annual billing selected
- **Expected:** $290 displays prominently
- **Status:** [ ] Pass [ ] Fail

**TC-PRICING-001-08: Card - Price Switching**
- **Objective:** Verify price switches with billing toggle (Alpine.js)
- **Steps:**
  1. Set both monthly and annual prices
  2. Preview page
  3. Toggle between monthly/annual
- **Expected:** Price updates smoothly without reload
- **Status:** [ ] Pass [ ] Fail

**TC-PRICING-001-09: Card - Features List**
- **Objective:** Verify feature list displays
- **Steps:**
  1. Add features in textarea (one per line)
  2. Preview page
- **Expected:** Features display as bulleted list
- **Status:** [ ] Pass [ ] Fail

**TC-PRICING-001-10: Card - CTA Button**
- **Objective:** Verify CTA button works
- **Steps:**
  1. Set button text and link
  2. Preview and click button
- **Expected:** Button links to correct URL
- **Status:** [ ] Pass [ ] Fail

**TC-PRICING-001-11: Card - Featured Card**
- **Objective:** Verify featured card highlighting
- **Steps:**
  1. Mark middle card as "Featured"
  2. Preview page
- **Expected:** Featured card has distinct styling
- **Status:** [ ] Pass [ ] Fail

**TC-PRICING-001-12: Card - Featured Badge**
- **Objective:** Verify featured badge displays
- **Steps:**
  1. Set badge text to "Most Popular"
  2. Enable for featured card
  3. Preview page
- **Expected:** Badge appears on featured card
- **Status:** [ ] Pass [ ] Fail

**TC-PRICING-001-13: Grid Layout - 3 Columns**
- **Objective:** Verify 3-column grid on desktop
- **Steps:**
  1. Add 3 pricing cards
  2. Preview at desktop width
- **Expected:** Cards display in 3 columns
- **Status:** [ ] Pass [ ] Fail

**TC-PRICING-001-14: Grid Layout - Responsive**
- **Objective:** Verify grid adapts to screen size
- **Steps:**
  1. Preview at tablet (2 columns expected)
  2. Preview at mobile (1 column expected)
- **Expected:** Grid stacks appropriately
- **Status:** [ ] Pass [ ] Fail

**TC-PRICING-001-15: Style - Card Background**
- **Objective:** Verify card background styling
- **Steps:**
  1. Go to Style > Pricing Cards
  2. Set background color
  3. Preview page
- **Expected:** Card backgrounds update
- **Status:** [ ] Pass [ ] Fail

**TC-PRICING-001-16: Style - Featured Card Highlight**
- **Objective:** Verify featured card styling controls
- **Steps:**
  1. Go to Style > Featured Card
  2. Set border color and background
  3. Preview page
- **Expected:** Featured card styling distinct
- **Status:** [ ] Pass [ ] Fail

**TC-PRICING-001-17: Alpine.js Functionality**
- **Objective:** Verify Alpine.js loads and works
- **Steps:**
  1. Check browser console for errors
  2. Test billing toggle
  3. Check x-data, x-show attributes
- **Expected:** No Alpine.js errors, smooth interactions
- **Status:** [ ] Pass [ ] Fail

**TC-PRICING-001-18: Price Animation**
- **Objective:** Verify price changes smoothly
- **Steps:**
  1. Toggle billing period multiple times
  2. Observe transition
- **Expected:** Price fades/transitions smoothly
- **Status:** [ ] Pass [ ] Fail

---

#### TC-PRICING-002 & TC-PRICING-005: Pricing-02 and Pricing-05 Widgets
**Priority:** MEDIUM
**Category:** Pricing
**Estimated Time:** 45 minutes each

##### Test Cases
- Follow Pricing-01 test pattern
- Test unique layout features
- Verify billing toggle if present
- Check pricing card variations

---

### FAQ Widgets (3 widgets)

#### TC-FAQ-001: FAQ-01 Widget
**Priority:** HIGH
**Category:** FAQ
**Estimated Time:** 50 minutes

##### Test Cases

**TC-FAQ-001-01: Widget Registration**
- **Objective:** Verify widget appears in Elementor panel
- **Steps:**
  1. Search for "FAQ 01"
- **Expected:** Widget appears under "Pagifye" category
- **Status:** [ ] Pass [ ] Fail

**TC-FAQ-001-02: Section Heading**
- **Objective:** Verify section heading displays
- **Steps:**
  1. Add FAQ-01 widget
  2. Enter heading text
  3. Preview page
- **Expected:** Heading displays above FAQ items
- **Status:** [ ] Pass [ ] Fail

**TC-FAQ-001-03: FAQ Items Repeater**
- **Objective:** Verify multiple FAQ items can be added
- **Steps:**
  1. Add 5 FAQ items using repeater
  2. Set questions and answers
  3. Preview page
- **Expected:** All 5 items display
- **Status:** [ ] Pass [ ] Fail

**TC-FAQ-001-04: Question Text**
- **Objective:** Verify question displays correctly
- **Steps:**
  1. Enter question text
  2. Preview page
- **Expected:** Question appears with expand icon
- **Status:** [ ] Pass [ ] Fail

**TC-FAQ-001-05: Answer Text (WYSIWYG)**
- **Objective:** Verify answer supports rich text
- **Steps:**
  1. Enter answer with bold, italic, links
  2. Preview page
- **Expected:** Answer formatting preserved
- **Status:** [ ] Pass [ ] Fail

**TC-FAQ-001-06: Accordion Expand**
- **Objective:** Verify clicking question expands answer (Alpine.js)
- **Steps:**
  1. Preview page
  2. Click on a question
- **Expected:** Answer expands smoothly below question
- **Status:** [ ] Pass [ ] Fail

**TC-FAQ-001-07: Accordion Collapse**
- **Objective:** Verify clicking expanded question collapses it
- **Steps:**
  1. Expand an item
  2. Click question again
- **Expected:** Answer collapses smoothly
- **Status:** [ ] Pass [ ] Fail

**TC-FAQ-001-08: Accordion - Single Open**
- **Objective:** Verify only one item open at a time
- **Steps:**
  1. Expand first item
  2. Click second item
- **Expected:** First item closes, second opens
- **Status:** [ ] Pass [ ] Fail

**TC-FAQ-001-09: Icon Rotation**
- **Objective:** Verify expand icon rotates
- **Steps:**
  1. Click question to expand
  2. Observe icon animation
- **Expected:** Icon rotates 180 degrees smoothly
- **Status:** [ ] Pass [ ] Fail

**TC-FAQ-001-10: Open by Default**
- **Objective:** Verify FAQ item can be open by default
- **Steps:**
  1. Enable "Open by Default" for first item
  2. Preview page
- **Expected:** First item expanded on load
- **Status:** [ ] Pass [ ] Fail

**TC-FAQ-001-11: Smooth Transitions**
- **Objective:** Verify expand/collapse transitions smooth
- **Steps:**
  1. Toggle items multiple times
  2. Observe animation
- **Expected:** No jerky movements, smooth height transition
- **Status:** [ ] Pass [ ] Fail

**TC-FAQ-001-12: ARIA Attributes**
- **Objective:** Verify accessibility attributes present
- **Steps:**
  1. Inspect page source
  2. Check for aria-expanded, aria-controls
- **Expected:** Proper ARIA attributes present
- **Status:** [ ] Pass [ ] Fail

**TC-FAQ-001-13: Keyboard Navigation**
- **Objective:** Verify keyboard accessibility
- **Steps:**
  1. Use Tab to navigate between questions
  2. Press Enter/Space to toggle
- **Expected:** Can navigate and toggle with keyboard
- **Status:** [ ] Pass [ ] Fail

**TC-FAQ-001-14: Style - Question Typography**
- **Objective:** Verify question styling controls
- **Steps:**
  1. Go to Style > Questions
  2. Adjust typography
  3. Preview page
- **Expected:** Question styling updates
- **Status:** [ ] Pass [ ] Fail

**TC-FAQ-001-15: Style - Answer Typography**
- **Objective:** Verify answer styling controls
- **Steps:**
  1. Go to Style > Answers
  2. Adjust typography and color
  3. Preview page
- **Expected:** Answer styling updates
- **Status:** [ ] Pass [ ] Fail

**TC-FAQ-001-16: Alpine.js Functionality**
- **Objective:** Verify Alpine.js loads correctly
- **Steps:**
  1. Check browser console
  2. Verify x-data, x-show work
- **Expected:** No errors, smooth Alpine.js operation
- **Status:** [ ] Pass [ ] Fail

---

#### TC-FAQ-004 & TC-FAQ-005: FAQ-04 and FAQ-05 Widgets
**Priority:** MEDIUM
**Category:** FAQ
**Estimated Time:** 40 minutes each

##### Test Cases
- Follow FAQ-01 test pattern
- Test accordion functionality
- Verify Alpine.js interactions
- Check unique layout features

---

### Testimonial Widgets (3 widgets)

#### TC-TESTIMONIAL-002: Testimonial-02 Widget
**Priority:** HIGH
**Category:** Testimonial
**Estimated Time:** 50 minutes

##### Test Cases

**TC-TESTIMONIAL-002-01: Widget Registration**
- **Objective:** Verify widget appears in Elementor panel
- **Steps:**
  1. Search for "Testimonial 02"
- **Expected:** Widget appears under "Pagifye" category
- **Status:** [ ] Pass [ ] Fail

**TC-TESTIMONIAL-002-02: Featured Testimonial Display**
- **Objective:** Verify main testimonial displays
- **Steps:**
  1. Add Testimonial-02 widget
  2. Enter quote text
  3. Preview page
- **Expected:** Testimonial quote displays prominently
- **Status:** [ ] Pass [ ] Fail

**TC-TESTIMONIAL-002-03: Quote Text**
- **Objective:** Verify quote text displays with formatting
- **Steps:**
  1. Enter long quote (200 characters)
  2. Preview page
- **Expected:** Quote text readable and well-formatted
- **Status:** [ ] Pass [ ] Fail

**TC-TESTIMONIAL-002-04: Quote Icon**
- **Objective:** Verify quote icon displays
- **Steps:**
  1. Upload custom quote icon
  2. Preview page
- **Expected:** Quote icon appears in design
- **Status:** [ ] Pass [ ] Fail

**TC-TESTIMONIAL-002-05: Author Name**
- **Objective:** Verify author name displays
- **Steps:**
  1. Enter "John Smith" as author
  2. Preview page
- **Expected:** Author name appears below quote
- **Status:** [ ] Pass [ ] Fail

**TC-TESTIMONIAL-002-06: Author Position**
- **Objective:** Verify author position displays
- **Steps:**
  1. Enter "CEO" as position
  2. Preview page
- **Expected:** Position appears after name
- **Status:** [ ] Pass [ ] Fail

**TC-TESTIMONIAL-002-07: Author Company**
- **Objective:** Verify company name displays
- **Steps:**
  1. Enter "Tech Corp" as company
  2. Preview page
- **Expected:** Company name appears with author info
- **Status:** [ ] Pass [ ] Fail

**TC-TESTIMONIAL-002-08: Author Image**
- **Objective:** Verify author avatar displays
- **Steps:**
  1. Upload author photo
  2. Preview page
- **Expected:** Avatar displays (circular or styled)
- **Status:** [ ] Pass [ ] Fail

**TC-TESTIMONIAL-002-09: Company Logo**
- **Objective:** Verify company logo displays
- **Steps:**
  1. Upload company logo
  2. Preview page
- **Expected:** Logo appears in testimonial
- **Status:** [ ] Pass [ ] Fail

**TC-TESTIMONIAL-002-10: Featured Image**
- **Objective:** Verify large featured image displays
- **Steps:**
  1. Upload featured image
  2. Preview page
- **Expected:** Image displays on side of testimonial
- **Status:** [ ] Pass [ ] Fail

**TC-TESTIMONIAL-002-11: Layout Options**
- **Objective:** Verify image can be left or right
- **Steps:**
  1. Set layout to "Image Left"
  2. Preview page
  3. Change to "Image Right"
  4. Preview again
- **Expected:** Layout flips correctly
- **Status:** [ ] Pass [ ] Fail

**TC-TESTIMONIAL-002-12: Multiple Testimonials**
- **Objective:** Verify testimonial repeater works
- **Steps:**
  1. Add 3 testimonials
  2. Preview page
- **Expected:** Can switch between testimonials
- **Status:** [ ] Pass [ ] Fail

**TC-TESTIMONIAL-002-13: Avatar Selection**
- **Objective:** Verify clicking avatars switches testimonial
- **Steps:**
  1. Add 3 testimonials with different avatars
  2. Click each avatar
- **Expected:** Testimonial content switches
- **Status:** [ ] Pass [ ] Fail

**TC-TESTIMONIAL-002-14: Active Avatar Indicator**
- **Objective:** Verify active avatar has indicator
- **Steps:**
  1. Preview page with multiple testimonials
  2. Check active avatar styling
- **Expected:** Active avatar visually distinct
- **Status:** [ ] Pass [ ] Fail

**TC-TESTIMONIAL-002-15: Style - Quote Typography**
- **Objective:** Verify quote styling controls
- **Steps:**
  1. Go to Style > Quote
  2. Adjust typography
  3. Preview page
- **Expected:** Quote styling updates
- **Status:** [ ] Pass [ ] Fail

---

#### TC-TESTIMONIAL-004 & TC-TESTIMONIAL-005: Testimonial-04 and Testimonial-05 Widgets
**Priority:** MEDIUM
**Category:** Testimonial
**Estimated Time:** 40 minutes each

##### Test Cases
- Follow Testimonial-02 test pattern
- Test layout variations
- Verify image displays
- Check author information

---

### Content Widgets (3 widgets)

#### TC-CONTENT-002, TC-CONTENT-003, TC-CONTENT-004
**Priority:** MEDIUM
**Category:** Content
**Estimated Time:** 30 minutes each

##### Standard Test Cases for Content Widgets

**TC-CONTENT-XXX-01: Widget Registration**
- Verify widget appears in panel
- **Status:** [ ] Pass [ ] Fail

**TC-CONTENT-XXX-02: Heading Display**
- Verify heading text displays
- Test heading tag selector
- **Status:** [ ] Pass [ ] Fail

**TC-CONTENT-XXX-03: Description Display**
- Verify description textarea works
- Test rich text formatting
- **Status:** [ ] Pass [ ] Fail

**TC-CONTENT-XXX-04: Image Upload**
- Verify image uploads and displays
- Test image sizing
- **Status:** [ ] Pass [ ] Fail

**TC-CONTENT-XXX-05: Layout Options**
- Test different layout variations
- Verify responsive behavior
- **Status:** [ ] Pass [ ] Fail

**TC-CONTENT-XXX-06: Background Controls**
- Test background color/gradient
- Verify padding controls
- **Status:** [ ] Pass [ ] Fail

**TC-CONTENT-XXX-07: Typography Controls**
- Test heading typography
- Test description typography
- **Status:** [ ] Pass [ ] Fail

**TC-CONTENT-XXX-08: Responsive Design**
- Test at desktop, tablet, mobile
- Verify content stacking
- **Status:** [ ] Pass [ ] Fail

---

### Metrics Widgets (2 widgets)

#### TC-METRICS-002, TC-METRICS-006
**Priority:** MEDIUM
**Category:** Metrics
**Estimated Time:** 35 minutes each

##### Standard Test Cases for Metrics Widgets

**TC-METRICS-XXX-01: Metric Number Display**
- Verify large numbers display
- Test number formatting
- **Status:** [ ] Pass [ ] Fail

**TC-METRICS-XXX-02: Metric Label**
- Verify label text displays
- Test label positioning
- **Status:** [ ] Pass [ ] Fail

**TC-METRICS-XXX-03: Icon/Graphic**
- Verify icon uploads work
- Test icon positioning
- **Status:** [ ] Pass [ ] Fail

**TC-METRICS-XXX-04: Multiple Metrics (Repeater)**
- Add 3-4 metrics
- Verify grid layout
- **Status:** [ ] Pass [ ] Fail

**TC-METRICS-XXX-05: Grid Layout**
- Test column settings
- Verify responsive grid
- **Status:** [ ] Pass [ ] Fail

**TC-METRICS-XXX-06: Number Typography**
- Test font size, weight
- Verify color controls
- **Status:** [ ] Pass [ ] Fail

**TC-METRICS-XXX-07: Responsive Design**
- Test at all breakpoints
- Verify metric stacking
- **Status:** [ ] Pass [ ] Fail

---

### Team Widgets (3 widgets)

#### TC-TEAM-001, TC-TEAM-002, TC-TEAM-004
**Priority:** MEDIUM
**Category:** Team
**Estimated Time:** 35 minutes each

##### Standard Test Cases for Team Widgets

**TC-TEAM-XXX-01: Team Member Card**
- Verify card displays
- Test card layout
- **Status:** [ ] Pass [ ] Fail

**TC-TEAM-XXX-02: Member Photo**
- Upload member photo
- Verify image displays
- **Status:** [ ] Pass [ ] Fail

**TC-TEAM-XXX-03: Member Name**
- Enter member name
- Verify name displays
- **Status:** [ ] Pass [ ] Fail

**TC-TEAM-XXX-04: Member Position**
- Enter position/title
- Verify position displays
- **Status:** [ ] Pass [ ] Fail

**TC-TEAM-XXX-05: Social Links**
- Add social media links
- Verify icons/links work
- **Status:** [ ] Pass [ ] Fail

**TC-TEAM-XXX-06: Multiple Members (Repeater)**
- Add 4-6 team members
- Verify grid layout
- **Status:** [ ] Pass [ ] Fail

**TC-TEAM-XXX-07: Grid Layout**
- Test 3 or 4 columns
- Verify responsive grid
- **Status:** [ ] Pass [ ] Fail

**TC-TEAM-XXX-08: Hover Effects**
- Test card hover state
- Verify smooth transitions
- **Status:** [ ] Pass [ ] Fail

---

### Contact Widgets (3 widgets)

#### TC-CONTACT-001, TC-CONTACT-002, TC-CONTACT-004
**Priority:** MEDIUM
**Category:** Contact
**Estimated Time:** 35 minutes each

##### Standard Test Cases for Contact Widgets

**TC-CONTACT-XXX-01: Contact Information Display**
- Add address, phone, email
- Verify information displays
- **Status:** [ ] Pass [ ] Fail

**TC-CONTACT-XXX-02: Contact Icons**
- Verify icons display
- Test icon styling
- **Status:** [ ] Pass [ ] Fail

**TC-CONTACT-XXX-03: Links (Phone/Email)**
- Add clickable phone/email
- Verify tel: and mailto: links
- **Status:** [ ] Pass [ ] Fail

**TC-CONTACT-XXX-04: Map Integration (if applicable)**
- Test map embed
- Verify map displays
- **Status:** [ ] Pass [ ] Fail

**TC-CONTACT-XXX-05: Layout Options**
- Test different layouts
- Verify responsive behavior
- **Status:** [ ] Pass [ ] Fail

**TC-CONTACT-XXX-06: Social Media Links**
- Add social links
- Verify icons work
- **Status:** [ ] Pass [ ] Fail

---

### Awards Widgets (3 widgets)

#### TC-AWARDS-001, TC-AWARDS-002, TC-AWARDS-004
**Priority:** LOW
**Category:** Awards
**Estimated Time:** 30 minutes each

##### Standard Test Cases for Awards Widgets

**TC-AWARDS-XXX-01: Award Logo Display**
- Upload award logo
- Verify logo displays
- **Status:** [ ] Pass [ ] Fail

**TC-AWARDS-XXX-02: Award Title**
- Enter award title
- Verify title displays
- **Status:** [ ] Pass [ ] Fail

**TC-AWARDS-XXX-03: Award Description**
- Add description text
- Verify formatting
- **Status:** [ ] Pass [ ] Fail

**TC-AWARDS-XXX-04: Multiple Awards (Repeater)**
- Add 4-6 awards
- Verify grid layout
- **Status:** [ ] Pass [ ] Fail

**TC-AWARDS-XXX-05: Layout Options**
- Test grid variations
- Verify responsive design
- **Status:** [ ] Pass [ ] Fail

---

### Blog Widgets (3 widgets)

#### TC-BLOG-001, TC-BLOG-003, TC-BLOG-005
**Priority:** MEDIUM
**Category:** Blog
**Estimated Time:** 35 minutes each

##### Standard Test Cases for Blog Widgets

**TC-BLOG-XXX-01: Blog Post Display**
- Verify post card displays
- Test layout
- **Status:** [ ] Pass [ ] Fail

**TC-BLOG-XXX-02: Featured Image**
- Upload post image
- Verify image displays
- **Status:** [ ] Pass [ ] Fail

**TC-BLOG-XXX-03: Post Title**
- Enter post title
- Verify title displays
- **Status:** [ ] Pass [ ] Fail

**TC-BLOG-XXX-04: Post Excerpt**
- Add excerpt text
- Verify excerpt displays
- **Status:** [ ] Pass [ ] Fail

**TC-BLOG-XXX-05: Post Meta (Date, Author)**
- Add meta information
- Verify meta displays
- **Status:** [ ] Pass [ ] Fail

**TC-BLOG-XXX-06: Read More Link**
- Add read more link
- Verify link works
- **Status:** [ ] Pass [ ] Fail

**TC-BLOG-XXX-07: Multiple Posts (Repeater)**
- Add 3-6 blog posts
- Verify grid layout
- **Status:** [ ] Pass [ ] Fail

**TC-BLOG-XXX-08: Grid Layout**
- Test 2 or 3 columns
- Verify responsive grid
- **Status:** [ ] Pass [ ] Fail

---

## 🔗 Integration Tests

### INT-001: Multi-Widget Page
**Priority:** HIGH
**Estimated Time:** 2 hours

**Objective:** Verify multiple widgets work together on same page

**Test Steps:**
1. Create page with:
   - Navigation-01
   - Hero-01
   - Content-02
   - Pricing-01
   - FAQ-01
   - Testimonial-02
2. Preview page
3. Check for conflicts

**Expected Results:**
- All widgets render correctly
- No CSS conflicts
- No JavaScript errors
- Tailwind classes don't conflict
- Alpine.js works for all interactive widgets

**Status:** [ ] Pass [ ] Fail

---

### INT-002: Theme Compatibility
**Priority:** HIGH
**Estimated Time:** 3 hours

**Objective:** Test plugin with popular WordPress themes

**Test Themes:**
1. Twenty Twenty-Four
2. Astra
3. GeneratePress
4. Hello Elementor
5. OceanWP

**For Each Theme:**
- Install and activate theme
- Create test page with 5 different widgets
- Check for styling conflicts
- Verify responsive behavior

**Status:** [ ] Pass [ ] Fail

---

### INT-003: Plugin Compatibility
**Priority:** MEDIUM
**Estimated Time:** 2 hours

**Objective:** Test with popular plugins

**Test Plugins:**
1. WooCommerce
2. Yoast SEO
3. Contact Form 7
4. WP Rocket (caching)
5. Autoptimize

**For Each Plugin:**
- Install and activate
- Test widgets still work
- Check for JavaScript conflicts
- Verify caching doesn't break Alpine.js

**Status:** [ ] Pass [ ] Fail

---

### INT-004: Elementor Pro Compatibility
**Priority:** MEDIUM
**Estimated Time:** 1 hour

**Objective:** Verify works with Elementor Pro

**Test Steps:**
1. Install Elementor Pro
2. Test widgets in:
   - Single post template
   - Archive template
   - Header/Footer builder
3. Test with Elementor Pro widgets on same page

**Status:** [ ] Pass [ ] Fail

---

## ⚡ Performance Tests

### PERF-001: Page Load Time
**Priority:** HIGH
**Estimated Time:** 1 hour

**Objective:** Ensure acceptable page load times

**Test Setup:**
- Page with 6 different widgets
- Test with GTmetrix/PageSpeed Insights
- Test with caching enabled/disabled

**Acceptance Criteria:**
- Page load < 3 seconds (3G)
- Total page size < 2MB
- CSS < 200KB
- JavaScript < 300KB

**Status:** [ ] Pass [ ] Fail

---

### PERF-002: Asset Loading
**Priority:** HIGH
**Estimated Time:** 1 hour

**Objective:** Verify efficient asset loading

**Test Checklist:**
- [ ] Tailwind CSS loads only once
- [ ] Alpine.js loads only once
- [ ] No duplicate scripts
- [ ] Assets minified in production
- [ ] No unused CSS
- [ ] Images lazy load

**Status:** [ ] Pass [ ] Fail

---

### PERF-003: Database Queries
**Priority:** MEDIUM
**Estimated Time:** 30 minutes

**Objective:** Ensure minimal database impact

**Test Steps:**
1. Enable Query Monitor plugin
2. Load page with multiple widgets
3. Check number of queries
4. Check query time

**Acceptance Criteria:**
- Widgets don't add extra database queries
- No slow queries (> 0.05s)

**Status:** [ ] Pass [ ] Fail

---

### PERF-004: Memory Usage
**Priority:** MEDIUM
**Estimated Time:** 30 minutes

**Objective:** Verify acceptable memory usage

**Test Steps:**
1. Enable WP_DEBUG and memory tracking
2. Load page with all 34 widgets
3. Check memory usage

**Acceptance Criteria:**
- Memory usage < 64MB for all widgets
- No memory leaks

**Status:** [ ] Pass [ ] Fail

---

## 🔒 Security Tests

### SEC-001: XSS Protection
**Priority:** CRITICAL
**Estimated Time:** 2 hours

**Objective:** Prevent cross-site scripting attacks

**Test Cases:**
1. Enter `<script>alert('XSS')</script>` in all text fields
2. Try JavaScript in URLs
3. Test with malicious HTML in WYSIWYG fields

**Expected:**
- All user input properly escaped
- Scripts don't execute
- HTML sanitized

**Status:** [ ] Pass [ ] Fail

---

### SEC-002: SQL Injection
**Priority:** CRITICAL
**Estimated Time:** 1 hour

**Objective:** Prevent SQL injection

**Test Cases:**
1. Check if any database queries use user input
2. Test with SQL injection strings in all inputs

**Expected:**
- No direct database queries with user input
- All queries use prepared statements

**Status:** [ ] Pass [ ] Fail

---

### SEC-003: File Upload Security
**Priority:** HIGH
**Estimated Time:** 1 hour

**Objective:** Ensure safe file uploads

**Test Cases:**
1. Try uploading PHP file as image
2. Try uploading large files
3. Test file type validation

**Expected:**
- Only allowed file types accepted
- File size limits enforced
- Files properly validated

**Status:** [ ] Pass [ ] Fail

---

### SEC-004: Nonce Verification
**Priority:** HIGH
**Estimated Time:** 30 minutes

**Objective:** Verify CSRF protection

**Test Steps:**
1. Check if forms use nonces
2. Test form submissions

**Expected:**
- All forms have nonce verification
- Nonces validated on submission

**Status:** [ ] Pass [ ] Fail

---

### SEC-005: Capability Checks
**Priority:** HIGH
**Estimated Time:** 30 minutes

**Objective:** Verify proper user permissions

**Test Steps:**
1. Test as different user roles
2. Check who can edit widgets

**Expected:**
- Only users with proper caps can edit
- Subscriber/Contributor can't access

**Status:** [ ] Pass [ ] Fail

---

## ♿ Accessibility Tests

### ACCESS-001: Keyboard Navigation
**Priority:** HIGH
**Estimated Time:** 2 hours

**Objective:** Ensure full keyboard accessibility

**Test All Interactive Widgets:**
- Navigation (menus, mobile toggle)
- FAQs (accordion)
- Pricing (billing toggle)
- Testimonials (avatar selection)

**Test Steps:**
1. Use only keyboard (Tab, Enter, Space, Arrows)
2. Navigate through all elements
3. Activate all interactions

**Expected:**
- All interactive elements reachable
- Tab order logical
- Focus indicators visible
- All functions keyboard-accessible

**Status:** [ ] Pass [ ] Fail

---

### ACCESS-002: Screen Reader Compatibility
**Priority:** HIGH
**Estimated Time:** 2 hours

**Objective:** Ensure screen reader accessibility

**Test Tools:**
- NVDA (Windows)
- JAWS (Windows)
- VoiceOver (macOS/iOS)

**Test Steps:**
1. Navigate each widget with screen reader
2. Verify all content announced
3. Check interactive elements

**Expected:**
- All text content readable
- Images have alt text
- Links have descriptive text
- Interactive elements properly labeled

**Status:** [ ] Pass [ ] Fail

---

### ACCESS-003: ARIA Attributes
**Priority:** HIGH
**Estimated Time:** 1 hour

**Objective:** Verify proper ARIA usage

**Test Widgets:**
- Navigation (aria-expanded, aria-haspopup)
- FAQ (aria-expanded, aria-controls)
- Pricing (aria-pressed for toggle)

**Test Steps:**
1. Inspect HTML source
2. Verify ARIA attributes present
3. Test attribute values update

**Expected:**
- Proper ARIA roles
- Correct ARIA states
- Valid ARIA relationships

**Status:** [ ] Pass [ ] Fail

---

### ACCESS-004: Color Contrast
**Priority:** MEDIUM
**Estimated Time:** 1 hour

**Objective:** Ensure WCAG AA color contrast

**Test Tools:**
- WebAIM Contrast Checker
- Chrome DevTools

**Test Elements:**
- Text on backgrounds
- Button text
- Link text
- Icon colors

**Acceptance Criteria:**
- Normal text: 4.5:1 contrast ratio
- Large text: 3:1 contrast ratio

**Status:** [ ] Pass [ ] Fail

---

### ACCESS-005: Focus Management
**Priority:** HIGH
**Estimated Time:** 1 hour

**Objective:** Verify proper focus management

**Test Scenarios:**
1. Mobile menu opens - focus moves to menu
2. FAQ expands - focus remains on trigger
3. Modal/overlay interactions

**Expected:**
- Focus never lost
- Focus trapped when appropriate
- Focus visible at all times

**Status:** [ ] Pass [ ] Fail

---

## 📱 Mobile/Responsive Tests

### MOBILE-001: Touch Interactions
**Priority:** HIGH
**Estimated Time:** 2 hours

**Objective:** Verify touch interactions work

**Test on Real Devices:**
- iOS device (iPhone)
- Android device

**Test Widgets:**
- Navigation mobile menu
- FAQ accordion
- Pricing toggle
- Testimonial avatars

**Expected:**
- Tap targets ≥ 44x44px
- No hover-dependent interactions
- Smooth touch animations

**Status:** [ ] Pass [ ] Fail

---

### MOBILE-002: Viewport Sizes
**Priority:** HIGH
**Estimated Time:** 2 hours

**Objective:** Test all common viewport sizes

**Test Sizes:**
- 360x640 (small Android)
- 375x667 (iPhone SE)
- 390x844 (iPhone 12/13)
- 414x896 (iPhone 11)
- 768x1024 (iPad portrait)
- 1024x768 (iPad landscape)

**For Each Size:**
- Test 5 different widgets
- Check text readability
- Verify button sizes
- Check image scaling

**Status:** [ ] Pass [ ] Fail

---

### MOBILE-003: Orientation Changes
**Priority:** MEDIUM
**Estimated Time:** 1 hour

**Objective:** Handle orientation changes

**Test Steps:**
1. Load page in portrait
2. Rotate to landscape
3. Rotate back to portrait

**Expected:**
- Layout adapts smoothly
- No content cut off
- JavaScript state preserved

**Status:** [ ] Pass [ ] Fail

---

## 🌐 Browser Compatibility Tests

### BROWSER-001: Chrome
**Priority:** HIGH
**Versions:** Latest 2 versions

**Test Checklist:**
- [ ] All widgets render correctly
- [ ] Alpine.js works
- [ ] Animations smooth
- [ ] No console errors

**Status:** [ ] Pass [ ] Fail

---

### BROWSER-002: Firefox
**Priority:** HIGH
**Versions:** Latest 2 versions

**Test Checklist:**
- [ ] All widgets render correctly
- [ ] Alpine.js works
- [ ] CSS Grid/Flexbox correct
- [ ] No console errors

**Status:** [ ] Pass [ ] Fail

---

### BROWSER-003: Safari
**Priority:** HIGH
**Versions:** Latest 2 versions (macOS + iOS)

**Test Checklist:**
- [ ] All widgets render correctly
- [ ] Alpine.js works
- [ ] Webkit-specific CSS works
- [ ] No console errors

**Status:** [ ] Pass [ ] Fail

---

### BROWSER-004: Edge
**Priority:** MEDIUM
**Versions:** Latest 2 versions

**Test Checklist:**
- [ ] All widgets render correctly
- [ ] No Chromium-specific issues
- [ ] Alpine.js works

**Status:** [ ] Pass [ ] Fail

---

## 🔄 Test Execution

### Test Schedule

**Week 1: Core Functionality**
- Day 1-2: Navigation widgets
- Day 3-4: Hero widgets
- Day 5: Pricing widgets

**Week 2: Remaining Widgets**
- Day 1: FAQ & Testimonial widgets
- Day 2: Content & Metrics widgets
- Day 3: Team & Contact widgets
- Day 4: Awards & Blog widgets
- Day 5: Integration tests

**Week 3: Non-Functional Testing**
- Day 1: Performance tests
- Day 2: Security tests
- Day 3: Accessibility tests
- Day 4: Mobile/Browser tests
- Day 5: Regression & final checks

---

### Bug Reporting Template

```markdown
**Bug ID:** BUG-XXX
**Widget:** [Widget name]
**Severity:** Critical / High / Medium / Low
**Priority:** P1 / P2 / P3
**Status:** Open / In Progress / Fixed / Closed

**Description:**
Clear description of the bug

**Steps to Reproduce:**
1. Step 1
2. Step 2
3. Step 3

**Expected Result:**
What should happen

**Actual Result:**
What actually happens

**Environment:**
- WordPress: 6.4
- Elementor: 3.16
- PHP: 8.1
- Browser: Chrome 120
- Device: Desktop / Mobile

**Screenshots:**
[Attach screenshots]

**Console Errors:**
[Paste any console errors]
```

---

### Test Sign-Off Criteria

Plugin is ready for release when:

✅ **Functionality**
- [ ] All 34 widgets tested
- [ ] All test cases pass
- [ ] 0 critical bugs
- [ ] < 5 high priority bugs

✅ **Performance**
- [ ] Page load < 3 seconds
- [ ] Assets optimized
- [ ] No performance regressions

✅ **Security**
- [ ] All security tests pass
- [ ] No XSS vulnerabilities
- [ ] No SQL injection risks

✅ **Accessibility**
- [ ] WCAG 2.1 AA compliant
- [ ] Keyboard accessible
- [ ] Screen reader compatible

✅ **Compatibility**
- [ ] Works on all major browsers
- [ ] Responsive on all devices
- [ ] Compatible with popular themes/plugins

---

## 📊 Test Metrics

Track these metrics:

- **Test Coverage:** XX% (target: 95%)
- **Tests Executed:** XX / XXX
- **Tests Passed:** XX
- **Tests Failed:** XX
- **Bugs Found:** XX
- **Bugs Fixed:** XX
- **Critical Bugs:** X (target: 0)
- **Test Execution Time:** XX hours

---

**Document Status:** Living Document
**Next Review:** After each test cycle
**Maintained By:** QA Team
