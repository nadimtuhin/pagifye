# Quick Test Checklist - Pagifye Elementor Widgets

**Version:** 1.0.0
**Purpose:** Fast verification checklist for rapid testing

---

## 🚀 Pre-Test Setup (5 minutes)

```bash
□ WordPress 6.4+ installed
□ Elementor 3.16+ active
□ Plugin uploaded and activated
□ WP_DEBUG enabled in wp-config.php
□ Browser DevTools console open
□ Test page created in Elementor
```

---

## ⚡ Smoke Tests (15 minutes)

### Plugin Activation
```
□ Plugin activates without errors
□ No PHP warnings/errors in debug.log
□ Plugin appears in Plugins list
```

### Elementor Panel
```
□ "Pagifye" category appears in widgets
□ All 34 widgets visible in panel
□ Widget icons display correctly
□ Can search and find widgets
```

### Widget Drag & Drop
```
□ Can drag widget to page
□ Widget previews immediately
□ No JavaScript console errors
□ Widget settings panel opens
```

---

## 🎯 Critical Path Tests (30 minutes)

### Test 1: Navigation Widget
```
□ Add Navigation-01 to page
□ Upload logo → displays
□ Add 5 menu items → display
□ Add dropdown menu → expands on hover
□ Resize to mobile → hamburger appears
□ Click hamburger → menu opens (Alpine.js)
□ Style controls work
□ No errors in console
```

### Test 2: Hero Widget
```
□ Add Hero-01 to page
□ Enter heading with {highlight text}
□ Upload hero image → displays
□ Add 2 CTA buttons → display
□ Change image position → layout flips
□ Style controls work
□ Responsive on mobile
```

### Test 3: Pricing Widget
```
□ Add Pricing-01 to page
□ Add 3 pricing cards
□ Set monthly and annual prices
□ Enable billing toggle
□ Click toggle → prices switch (Alpine.js)
□ Mark card as featured → highlighted
□ Grid responsive on mobile
□ No JavaScript errors
```

### Test 4: FAQ Widget
```
□ Add FAQ-01 to page
□ Add 5 FAQ items
□ Click question → answer expands (Alpine.js)
□ Icon rotates smoothly
□ Click again → answer collapses
□ Open different FAQ → previous closes
□ Keyboard navigation works (Tab/Enter)
□ No errors
```

### Test 5: Testimonial Widget
```
□ Add Testimonial-02 to page
□ Enter quote and author info
□ Upload author image → displays
□ Upload featured image → displays
□ Add multiple testimonials
□ Click avatar → testimonial switches
□ Layout responsive
□ Smooth transitions
```

---

## 🎨 Style Controls (15 minutes)

Test on any widget:
```
□ Background color changes
□ Background gradient works
□ Typography controls apply
□ Color picker works
□ Padding/margin controls work
□ Border controls work
□ Box shadow works
□ Changes reflect in live preview
```

---

## 📱 Responsive Tests (20 minutes)

Test 3 different widgets at each size:

### Desktop (1920px, 1440px, 1280px)
```
□ All elements visible
□ Proper spacing
□ Images not distorted
□ Text readable
```

### Tablet (1024px, 768px)
```
□ Layout adapts
□ Grid columns reduce
□ Mobile menu appears (nav)
□ Touch-friendly sizes
```

### Mobile (414px, 375px, 360px)
```
□ Single column layout
□ Text remains readable
□ Buttons full-width or appropriate size
□ Images scale properly
□ No horizontal scroll
```

---

## 🔧 Technical Checks (10 minutes)

### Assets Loading
```
□ Tailwind CSS loads
□ Alpine.js loads
□ No 404 errors in Network tab
□ Assets minified (if production build)
□ No duplicate scripts loading
```

### JavaScript
```
□ No errors in console
□ Alpine.js initialized (check console for "Alpine")
□ Interactive widgets work without page reload
□ Smooth animations
```

### Performance
```
□ Page loads in < 3 seconds
□ No layout shift (CLS)
□ Images lazy load
□ No memory leaks (check with DevTools)
```

---

## 🔗 Integration Tests (20 minutes)

### Multi-Widget Page
```
□ Add 6 different widgets to one page
□ All render correctly
□ No CSS conflicts
□ No JavaScript conflicts
□ Alpine.js works for all interactive widgets
□ Page remains performant
```

### Theme Compatibility
```
□ Test with Hello Elementor theme
□ Test with Astra theme
□ Widgets style correctly in both
□ No theme CSS conflicts
```

---

## 🔒 Security Checks (10 minutes)

### XSS Testing
```
□ Enter <script>alert('test')</script> in text field
□ Script doesn't execute
□ HTML properly escaped
□ WYSIWYG sanitizes input
```

### Data Validation
```
□ Image upload validates file type
□ URLs properly validated
□ Large text inputs don't break layout
```

---

## ♿ Accessibility Quick Check (15 minutes)

### Keyboard Navigation
```
□ Tab through navigation menu
□ Tab through FAQ widget
□ Enter/Space activates buttons
□ Focus indicators visible
□ Tab order logical
```

### Screen Reader (Basic)
```
□ Turn on screen reader (VoiceOver/NVDA)
□ Navigate through widgets
□ All text announced
□ Images have alt text
□ Interactive elements labeled
```

### ARIA
```
□ Inspect FAQ widget → check aria-expanded
□ Check navigation → aria-haspopup
□ Verify proper ARIA roles
```

---

## 🌐 Browser Compatibility (20 minutes)

Test 2-3 widgets in each:

### Chrome
```
□ All widgets render
□ Alpine.js works
□ No console errors
□ Animations smooth
```

### Firefox
```
□ All widgets render
□ CSS Grid/Flexbox correct
□ Alpine.js works
□ No console errors
```

### Safari (if available)
```
□ All widgets render
□ Webkit-specific features work
□ Alpine.js works
□ No console errors
```

---

## 📋 Widget-Specific Quick Checks

### All Navigation Widgets (3)
```
□ Logo displays (image/text)
□ Menu items clickable
□ Dropdowns work
□ Mobile menu toggles
□ CTA buttons work
```

### All Hero Widgets (5)
```
□ Heading displays
□ Highlight text works
□ Images display
□ CTA buttons work
□ Responsive layout
```

### All Pricing Widgets (3)
```
□ Cards display in grid
□ Prices show correctly
□ Billing toggle works (if present)
□ Featured card highlighted
□ Buttons work
```

### All FAQ Widgets (3)
```
□ Questions display
□ Click expands answer
□ Accordion works smoothly
□ Icon rotates
□ Keyboard accessible
```

### All Testimonial Widgets (3)
```
□ Quote displays
□ Author info shows
□ Images display
□ Multiple testimonials work
□ Layout responsive
```

### All Content Widgets (3)
```
□ Heading displays
□ Description shows
□ Images display
□ Layout correct
```

### All Metrics Widgets (2)
```
□ Numbers display large
□ Labels show
□ Icons display
□ Grid layout works
```

### All Team Widgets (3)
```
□ Member cards display
□ Photos show
□ Names and titles visible
□ Social links work
□ Grid responsive
```

### All Contact Widgets (3)
```
□ Contact info displays
□ Icons show
□ Links work (tel:, mailto:)
□ Layout correct
```

### All Awards Widgets (3)
```
□ Award logos display
□ Text shows
□ Grid layout works
□ Responsive
```

### All Blog Widgets (3)
```
□ Post cards display
□ Images show
□ Titles and excerpts visible
□ Read more links work
□ Grid responsive
```

---

## ✅ Sign-Off Checklist

Before marking testing complete:

```
□ All 34 widgets tested at least once
□ All critical functionality works
□ No critical or high-severity bugs remaining
□ Responsive on desktop, tablet, mobile
□ Works in Chrome, Firefox, Safari
□ Keyboard accessible
□ No console errors
□ Page load time acceptable (< 3s)
□ Alpine.js working for all interactive widgets
□ Tailwind CSS styles apply correctly
□ Documentation reviewed and accurate
```

---

## 🐛 Quick Bug Report

If you find an issue:

```
Bug: [Brief description]
Widget: [Widget name]
Steps to Reproduce:
1.
2.
3.

Expected:
Actual:
Browser:
Screenshot:
```

---

## 📊 Test Summary

After completing all tests:

```
Date: ___________
Tester: ___________
Duration: _____ minutes

Widgets Tested: ____ / 34
Tests Passed: ____
Tests Failed: ____
Bugs Found: ____

Critical Issues: ____
High Priority Issues: ____
Medium/Low Issues: ____

Overall Status: □ PASS  □ FAIL  □ CONDITIONAL PASS

Notes:
_________________________________
_________________________________
_________________________________
```

---

## 🎯 Priority Test Paths

If time is limited, test in this order:

### 30-Minute Test (Bare Minimum)
1. Plugin activation
2. Navigation-01 (all features)
3. Hero-01 (all features)
4. Pricing-01 (Alpine.js critical)
5. FAQ-01 (Alpine.js critical)
6. Quick responsive check

### 1-Hour Test (Recommended Minimum)
- 30-minute test above +
- Testimonial-02
- One widget from each remaining category
- Browser compatibility (Chrome, Firefox)
- Accessibility basics

### 2-Hour Test (Thorough)
- 1-hour test above +
- All navigation widgets
- All hero widgets
- All pricing/FAQ/testimonial widgets
- Full responsive testing
- Integration tests

### Full Test (Complete)
- Follow entire TEST_PLAN.md
- All 34 widgets
- All test categories
- Estimated: 40-50 hours

---

**Document Version:** 1.0.0
**Last Updated:** 2025-11-06
**Quick Test Completion Time:** ~2-3 hours
