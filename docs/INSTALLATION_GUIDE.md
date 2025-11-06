# Pagifye Elementor Widgets - Installation Guide

**Version:** 1.0.0
**Last Updated:** 2025-11-06

---

## 📋 Table of Contents

1. [Requirements](#requirements)
2. [Installation Methods](#installation-methods)
3. [Post-Installation Setup](#post-installation-setup)
4. [First Steps](#first-steps)
5. [Troubleshooting](#troubleshooting)
6. [Uninstallation](#uninstallation)

---

## 🔧 Requirements

### Minimum Requirements

| Component | Version |
|-----------|---------|
| WordPress | 5.8+ |
| PHP | 7.4+ |
| MySQL | 5.7+ or MariaDB 10.3+ |
| Elementor | 3.16+ |
| Memory Limit | 256MB |
| Max Execution Time | 30s |

### Recommended Requirements

| Component | Version |
|-----------|---------|
| WordPress | 6.4+ |
| PHP | 8.1+ |
| MySQL | 8.0+ or MariaDB 10.6+ |
| Elementor | Latest version |
| Memory Limit | 512MB |
| Max Execution Time | 60s |

### Server Requirements

- HTTPS enabled (recommended)
- Modern browser (Chrome, Firefox, Safari, Edge)
- JavaScript enabled
- Cookies enabled

---

## 📦 Installation Methods

### Method 1: WordPress Admin (Recommended)

**Step 1: Access WordPress Admin**
```
1. Log in to your WordPress admin panel
2. URL: https://yoursite.com/wp-admin
```

**Step 2: Navigate to Plugins**
```
1. Click "Plugins" in the left sidebar
2. Click "Add New"
```

**Step 3: Search for Plugin**
```
1. In the search box, type "Pagifye Elementor Widgets"
2. Find the plugin in results
```

**Step 4: Install**
```
1. Click "Install Now" button
2. Wait for installation to complete
```

**Step 5: Activate**
```
1. Click "Activate" button
2. Plugin is now active!
```

---

### Method 2: Upload ZIP File

**Step 1: Download Plugin**
```
1. Download pagifye-elementor-widgets-1.0.0.zip
2. Save to your computer
```

**Step 2: Upload to WordPress**
```
1. Go to WordPress admin
2. Navigate to Plugins > Add New
3. Click "Upload Plugin" button at the top
4. Click "Choose File"
5. Select the downloaded ZIP file
6. Click "Install Now"
```

**Step 3: Activate**
```
1. After installation completes
2. Click "Activate Plugin"
3. Done!
```

---

### Method 3: Manual Installation (FTP)

**Step 1: Prepare Files**
```bash
1. Download plugin ZIP file
2. Extract to your computer
3. You should have a folder: pagifye-elementor-widgets/
```

**Step 2: Upload via FTP**
```bash
1. Connect to your server via FTP client (FileZilla, etc.)
2. Navigate to: /wp-content/plugins/
3. Upload the entire pagifye-elementor-widgets/ folder
4. Ensure all files uploaded successfully
```

**Step 3: Set Permissions**
```bash
# Recommended permissions
Folders: 755
Files: 644
```

**Step 4: Activate in WordPress**
```
1. Go to WordPress admin
2. Navigate to Plugins
3. Find "Pagifye Elementor Widgets"
4. Click "Activate"
```

---

### Method 4: WP-CLI

**For developers using command line:**

```bash
# Navigate to WordPress installation
cd /path/to/wordpress

# Install plugin
wp plugin install pagifye-elementor-widgets.zip

# Activate plugin
wp plugin activate pagifye-elementor-widgets

# Verify installation
wp plugin list | grep pagifye
```

---

## ⚙️ Post-Installation Setup

### 1. Verify Installation

**Check Plugin is Active**
```
✓ Go to Plugins page
✓ "Pagifye Elementor Widgets" shows as "Active"
✓ No error messages displayed
```

**Check Elementor Integration**
```
1. Edit any page with Elementor
2. Look for "Pagifye" category in Elements panel
3. Should see all 34 widgets listed
```

### 2. Initial Configuration

**No configuration needed!** The plugin works out of the box.

Optional settings:
- Widgets are automatically registered
- Assets load automatically when widgets are used
- No additional setup required

### 3. Update Settings (Optional)

Currently, the plugin has no settings page. All customization is done per-widget in Elementor.

Future versions may include:
- Global widget settings
- Default styles
- Performance options

---

## 🚀 First Steps

### Step 1: Create Your First Page

```
1. Go to Pages > Add New
2. Enter page title
3. Click "Edit with Elementor"
```

### Step 2: Add Your First Widget

```
1. In Elementor panel, find search box
2. Type "pagifye" or search specific widget
3. Drag widget onto your page
4. Widget appears with default content
```

### Step 3: Customize the Widget

```
1. Click on the widget
2. Left panel shows customization options
3. Adjust Content settings:
   - Text, images, links, etc.
4. Adjust Style settings:
   - Colors, fonts, spacing, etc.
5. See live preview as you edit
```

### Step 4: Publish Your Page

```
1. Review your page
2. Click green "Publish" button
3. View published page
4. Share with the world!
```

---

## 🎨 Widget Quick Start Guide

### Navigation Widgets

**Example: Navigation-01**
```
1. Drag "Navigation 01" to page top
2. Content > Logo: Upload your logo
3. Content > Menu Items: Add menu links
4. Content > CTA Buttons: Add action buttons
5. Style: Customize colors and spacing
6. Preview on mobile to see hamburger menu
```

### Hero Widgets

**Example: Hero-01**
```
1. Drag "Hero 01" to page
2. Content > Heading: Enter your headline
   - Use {curly braces} for highlighted text
3. Content > Description: Add subheading
4. Content > Image: Upload hero image
5. Content > Buttons: Add CTA buttons
6. Style: Adjust layout and colors
```

### Pricing Widgets

**Example: Pricing-01**
```
1. Drag "Pricing 01" to page
2. Content > Billing Toggle: Enable if needed
3. Content > Pricing Cards: Add 2-4 plans
   - Set monthly and annual prices
   - Add features list
   - Mark featured plan
4. Style: Customize card appearance
5. Test billing toggle in preview
```

### FAQ Widgets

**Example: FAQ-01**
```
1. Drag "FAQ 01" to page
2. Content > FAQ Items: Add questions
   - Enter question text
   - Enter answer (supports rich text)
3. Content > Open by Default: Choose which opens first
4. Style: Customize colors and typography
5. Click questions in preview to test accordion
```

---

## 🔍 Troubleshooting

### Plugin Won't Activate

**Problem:** Error message when activating

**Solutions:**
```
1. Check PHP version (7.4+ required)
   - Go to Tools > Site Health
   - Check PHP version under "Info"

2. Check if Elementor is installed
   - Go to Plugins page
   - Install/activate Elementor if missing

3. Check memory limit
   - Add to wp-config.php:
     define('WP_MEMORY_LIMIT', '256M');

4. Check for plugin conflicts
   - Deactivate all other plugins
   - Activate Pagifye plugin
   - Reactivate other plugins one by one
```

### Widgets Don't Appear

**Problem:** Can't find widgets in Elementor panel

**Solutions:**
```
1. Clear Elementor cache
   - Elementor > Tools > Regenerate CSS & Data
   - Click "Regenerate Files & Data"

2. Clear WordPress cache
   - If using caching plugin, clear cache

3. Clear browser cache
   - Ctrl+Shift+Delete (Windows)
   - Cmd+Shift+Delete (Mac)

4. Check plugin is activated
   - Go to Plugins page
   - Ensure "Pagifye Elementor Widgets" is active

5. Try different browser
   - Test in Chrome, Firefox, or Safari
```

### Widgets Not Displaying Correctly

**Problem:** Widgets look broken or unstyled

**Solutions:**
```
1. Regenerate Elementor CSS
   - Elementor > Tools > Regenerate CSS

2. Check for theme conflicts
   - Temporarily switch to Hello Elementor theme
   - Test if widgets display correctly
   - If yes, theme conflict exists

3. Check for CSS conflicts
   - Inspect element in browser
   - Look for conflicting styles
   - Add custom CSS if needed

4. Clear all caches
   - Elementor cache
   - WordPress cache
   - Browser cache
   - Server cache (if any)
```

### Alpine.js Not Working

**Problem:** Interactive features don't work (accordions, toggles, menus)

**Solutions:**
```
1. Check browser console for errors
   - Press F12
   - Look at Console tab
   - Check for JavaScript errors

2. Verify Alpine.js is loading
   - View page source
   - Search for "alpine"
   - Should find alpine.js file

3. Check for JavaScript conflicts
   - Deactivate other plugins
   - Test if features work
   - Identify conflicting plugin

4. Ensure jQuery compatibility mode
   - Some themes load jQuery differently
   - Alpine.js should still work independently
```

### Images Not Loading

**Problem:** Widget images don't display

**Solutions:**
```
1. Check image file exists
   - Verify image uploaded to Media Library
   - Check image URL is accessible

2. Check file permissions
   - Uploads folder should be 755
   - Images should be 644

3. Check file size
   - WordPress may have upload limits
   - Reduce image size if too large

4. Use absolute URLs
   - Ensure images use full URLs
   - Not relative paths
```

### Performance Issues

**Problem:** Page loads slowly

**Solutions:**
```
1. Optimize images
   - Compress images before upload
   - Use WebP format if possible
   - Use lazy loading

2. Minimize widgets per page
   - Use only necessary widgets
   - Remove unused widgets

3. Enable caching
   - Install caching plugin
   - Configure page caching

4. Use CDN
   - Use CloudFlare or similar
   - Serve assets from CDN

5. Optimize database
   - Use optimization plugin
   - Clean up revisions and transients
```

### Mobile Display Issues

**Problem:** Widgets don't look right on mobile

**Solutions:**
```
1. Test responsive settings
   - Use Elementor's responsive mode
   - Adjust mobile-specific settings

2. Check viewport meta tag
   - Ensure theme has proper meta tag
   - Should be in theme's header.php

3. Test on real devices
   - Emulators may not be accurate
   - Test on actual phone/tablet

4. Adjust breakpoints
   - Customize responsive breakpoints
   - In Elementor > Settings > Advanced
```

---

## 🔄 Updating the Plugin

### Automatic Updates (WordPress.org)

```
1. Go to Dashboard > Updates
2. Find "Pagifye Elementor Widgets"
3. Click "Update Now"
4. Wait for update to complete
5. Clear all caches
```

### Manual Update

```
1. Deactivate current plugin
2. Delete old plugin files (data is safe)
3. Install new version
4. Activate plugin
5. Regenerate Elementor CSS
```

### Before Updating

**Always:**
- ✓ Backup your website
- ✓ Test on staging site first
- ✓ Check changelog for breaking changes
- ✓ Ensure compatibility with your WordPress/Elementor version

---

## 🗑️ Uninstallation

### Method 1: WordPress Admin

```
1. Go to Plugins page
2. Find "Pagifye Elementor Widgets"
3. Click "Deactivate"
4. Click "Delete"
5. Confirm deletion
```

### Method 2: FTP

```
1. Connect via FTP
2. Navigate to /wp-content/plugins/
3. Delete pagifye-elementor-widgets/ folder
```

### What Gets Removed

When you delete the plugin:
- ✓ Plugin files deleted
- ✓ Plugin folder removed
- ✗ Widget content in pages remains (but won't display)
- ✗ No database tables created (nothing to clean up)

### After Uninstall

- Pages with Pagifye widgets will show empty space
- Edit pages and replace widgets with alternatives
- Or keep plugin deactivated and widgets remain in pages

---

## 🆘 Getting Help

### Support Channels

**WordPress.org Forum:**
- https://wordpress.org/support/plugin/pagifye-elementor-widgets/
- Post your question
- Community and developers will help

**GitHub Issues:**
- https://github.com/nadimtuhin/pagifye/issues
- For bug reports
- For feature requests

**Documentation:**
- https://github.com/nadimtuhin/pagifye/tree/main/docs
- Complete documentation
- Code examples

### Before Requesting Support

Please provide:
1. WordPress version
2. Elementor version
3. PHP version
4. Plugin version
5. Theme name and version
6. Description of issue
7. Steps to reproduce
8. Screenshots (if applicable)
9. Browser console errors (if any)

### System Information

To get system info:
```
1. Go to Tools > Site Health
2. Click "Info" tab
3. Copy relevant information
4. Include in support request
```

---

## ✅ Installation Checklist

Use this checklist to verify successful installation:

```
□ WordPress 5.8+ installed
□ PHP 7.4+ confirmed
□ Elementor 3.16+ installed and active
□ Pagifye plugin downloaded
□ Plugin installed via preferred method
□ Plugin activated successfully
□ No error messages in WordPress
□ Widgets visible in Elementor panel (34 total)
□ Test page created
□ Sample widget added to page
□ Widget customization works
□ Live preview updates correctly
□ Page published successfully
□ Published page displays correctly
□ Mobile view tested
□ Browser console has no errors
□ Caches cleared
□ Installation complete!
```

---

## 📚 Additional Resources

- **Plugin Homepage:** https://github.com/nadimtuhin/pagifye
- **Documentation:** https://github.com/nadimtuhin/pagifye/tree/main/docs
- **Widget Gallery:** Coming soon
- **Video Tutorials:** Coming soon
- **Community Forum:** WordPress.org support forum

---

## 🎉 Ready to Build!

Your Pagifye Elementor Widgets plugin is now installed and ready to use!

**Next Steps:**
1. Read the [User Guide](USER_GUIDE.md) for detailed widget documentation
2. Explore all 34 widgets
3. Create beautiful pages
4. Share your creations!

**Happy Building! 🚀**

---

**Version:** 1.0.0
**Last Updated:** 2025-11-06
**Need Help?** Visit our [support forum](https://wordpress.org/support/plugin/pagifye-elementor-widgets/)
