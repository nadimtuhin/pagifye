# Build Scripts

Scripts for building and packaging the Pagifye Elementor Widgets plugin.

## build-plugin.sh

Creates a production-ready WordPress plugin zip file.

### Features

✅ **Automated Build Process**
- Copies plugin files to build directory
- Removes development files automatically
- Creates clean zip file for distribution
- Verifies zip integrity

✅ **Smart Exclusions**
- Removes .git and version control files
- Excludes node_modules and dependencies
- Strips out test files and documentation
- Removes source maps and build artifacts

✅ **Version Detection**
- Auto-detects version from main plugin file
- Uses semantic versioning (e.g., 1.0.0)
- Falls back to 'dev' for development builds

✅ **File Size Optimization**
- Removes unnecessary files
- Cleans up temporary files
- Optimized for WordPress.org upload (< 10MB)

### Usage

#### Basic Build
```bash
# Using npm script (recommended)
npm run build

# Or directly
bash scripts/build-plugin.sh
```

#### Keep Build Directory
```bash
# Keep build/ folder for inspection
npm run build:keep

# Or directly
bash scripts/build-plugin.sh --keep-build
```

### Output

**Zip Location:** `dist/pagifye-elementor-widgets-{version}.zip`

**Example:**
- `dist/pagifye-elementor-widgets-1.0.0.zip` (versioned)
- `dist/pagifye-elementor-widgets-dev-20251102_143045.zip` (development)

### Build Process

The script performs these steps:

1. **Validation**
   - Checks plugin directory exists
   - Extracts version from main plugin file

2. **Preparation**
   - Cleans previous builds
   - Creates fresh build directory

3. **File Copying**
   - Main plugin file (.php)
   - readme.txt
   - LICENSE file
   - includes/
   - widgets/
   - assets/
   - languages/
   - templates/

4. **Cleanup**
   - Removes .git files
   - Deletes .md documentation files
   - Strips node_modules
   - Removes test directories
   - Deletes source maps (.map files)
   - Cleans IDE configuration

5. **Packaging**
   - Creates zip file
   - Verifies integrity
   - Generates summary

6. **Finalization**
   - Removes build directory (unless --keep-build)
   - Shows file size and location

### What Gets Included

✅ **Included in Plugin Zip:**
- Main plugin PHP file
- readme.txt (WordPress.org format)
- LICENSE file
- includes/ (PHP classes)
- widgets/ (Elementor widgets)
- assets/ (compiled CSS/JS)
- languages/ (translation files)
- templates/ (PHP templates)

❌ **Excluded from Plugin Zip:**
- Documentation (.md files)
- Source files (src/, tailwind/)
- Tests (tests/, *.test.php)
- Development files (.git, node_modules)
- Build scripts
- Docker configuration
- Scraper files
- Environment files (.env)
- IDE files (.vscode, .idea)

### File Size Guidelines

**WordPress.org Requirements:**
- Maximum zip size: 10 MB
- Recommended: < 5 MB for faster review

**Current Exclusions:**
- Documentation: ~2-3 MB saved
- node_modules: ~50-200 MB saved
- Source files: ~1-2 MB saved
- Tests: ~500 KB saved

### Version Management

**Version Detection:**
The script reads the version from the main plugin file:

```php
/**
 * Version: 1.0.0
 */
```

**Version Formats:**
- `1.0.0` → `pagifye-elementor-widgets-1.0.0.zip`
- `dev` → `pagifye-elementor-widgets-dev-20251102_143045.zip`

### Troubleshooting

#### Plugin directory not found
```bash
# Make sure you're in the project root
cd /path/to/pagifye

# Check plugin directory exists
ls plugin/
```

#### Permission denied
```bash
# Make script executable
chmod +x scripts/build-plugin.sh
```

#### Zip is empty or corrupted
```bash
# Check plugin directory has files
ls -la plugin/

# Keep build directory to inspect
npm run build:keep
ls build/pagifye-elementor-widgets/
```

#### Version not detected
Add version to main plugin file:
```php
/**
 * Plugin Name: Pagifye Elementor Widgets
 * Version: 1.0.0
 */
```

### CI/CD Integration

**GitHub Actions Example:**
```yaml
- name: Build Plugin
  run: npm run build

- name: Upload Artifact
  uses: actions/upload-artifact@v3
  with:
    name: plugin-zip
    path: dist/*.zip
```

**GitLab CI Example:**
```yaml
build:
  script:
    - npm run build
  artifacts:
    paths:
      - dist/*.zip
```

### Advanced Usage

#### Custom Build Directory
```bash
# Modify script variables
BUILD_DIR="custom-build"
DIST_DIR="custom-dist"
```

#### Add Minification
The script has a placeholder for minification:
```bash
# In minify_assets() function
npm run build:production  # Add your build command
```

#### Custom Exclusions
Edit `.buildignore` to customize what gets excluded:
```
# Add custom patterns
my-custom-file.txt
secret-configs/
```

### Best Practices

1. **Before Building:**
   - Update version in main plugin file
   - Update readme.txt
   - Test plugin functionality
   - Run code quality checks

2. **After Building:**
   - Test zip installation on clean WordPress
   - Verify all assets load correctly
   - Check file size (< 10 MB)
   - Scan for security issues

3. **Release Process:**
   - Tag version in git
   - Create GitHub release
   - Upload to WordPress.org
   - Update documentation

### Build Script Checklist

- [ ] Plugin directory exists
- [ ] Main plugin file has version
- [ ] readme.txt is up to date
- [ ] Assets are compiled (CSS/JS)
- [ ] No development files in plugin/
- [ ] Run build script
- [ ] Verify zip integrity
- [ ] Check file size
- [ ] Test installation

### Future Enhancements

Planned improvements:
- [ ] CSS/JS minification
- [ ] Asset optimization (images)
- [ ] Automatic changelog generation
- [ ] WordPress.org SVN deployment
- [ ] Automated testing before build
- [ ] Build notifications (Slack/Email)

---

## Related Documentation

- [Plugin Architecture](../docs/01-PLUGIN-ARCHITECTURE.md)
- [Development Guide](../docs/03-DEVELOPMENT-START-PLAN.md)
- [Docker Setup](../docs/04-DOCKER-SETUP-PLAN.md)

---

**Last Updated:** 2025-11-02
**Script Version:** 1.0.0
