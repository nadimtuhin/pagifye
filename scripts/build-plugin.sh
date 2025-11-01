#!/bin/bash
# WordPress Plugin Build Script for Pagifye Elementor Widgets
# Creates a production-ready zip file for WordPress plugin distribution

set -e  # Exit on error

# Colors for output
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
BLUE='\033[0;34m'
NC='\033[0m' # No Color

# Configuration
PLUGIN_SLUG="pagifye-elementor-widgets"
PLUGIN_DIR="plugin"
BUILD_DIR="build"
DIST_DIR="dist"
TIMESTAMP=$(date +%Y%m%d_%H%M%S)
VERSION=""

# Functions
print_header() {
    echo -e "${BLUE}╔════════════════════════════════════════════════════════════╗${NC}"
    echo -e "${BLUE}║${NC}  Pagifye Elementor Widgets - WordPress Plugin Builder  ${BLUE}║${NC}"
    echo -e "${BLUE}╚════════════════════════════════════════════════════════════╝${NC}"
    echo ""
}

print_step() {
    echo -e "${GREEN}▶${NC} $1"
}

print_error() {
    echo -e "${RED}✗ Error:${NC} $1"
}

print_warning() {
    echo -e "${YELLOW}⚠ Warning:${NC} $1"
}

print_success() {
    echo -e "${GREEN}✓${NC} $1"
}

# Check if plugin directory exists
check_plugin_exists() {
    if [ ! -d "$PLUGIN_DIR" ]; then
        print_error "Plugin directory '$PLUGIN_DIR' not found!"
        echo "Please create the plugin directory first or run from project root."
        exit 1
    fi
    print_success "Plugin directory found"
}

# Extract version from main plugin file
get_version() {
    if [ -f "$PLUGIN_DIR/${PLUGIN_SLUG}.php" ]; then
        VERSION=$(grep "Version:" "$PLUGIN_DIR/${PLUGIN_SLUG}.php" | head -1 | awk '{print $3}')
        if [ -z "$VERSION" ]; then
            VERSION="dev"
            print_warning "Version not found in plugin file, using 'dev'"
        else
            print_success "Plugin version: $VERSION"
        fi
    else
        VERSION="dev"
        print_warning "Main plugin file not found, using version 'dev'"
    fi
}

# Clean previous builds
clean_build() {
    print_step "Cleaning previous builds..."
    rm -rf "$BUILD_DIR"
    mkdir -p "$BUILD_DIR"
    mkdir -p "$DIST_DIR"
    print_success "Build directory cleaned"
}

# Copy plugin files to build directory
copy_files() {
    print_step "Copying plugin files..."

    # Create plugin directory in build
    mkdir -p "$BUILD_DIR/$PLUGIN_SLUG"

    # Copy main plugin files
    if [ -f "$PLUGIN_DIR/${PLUGIN_SLUG}.php" ]; then
        cp "$PLUGIN_DIR/${PLUGIN_SLUG}.php" "$BUILD_DIR/$PLUGIN_SLUG/"
    fi

    if [ -f "$PLUGIN_DIR/readme.txt" ]; then
        cp "$PLUGIN_DIR/readme.txt" "$BUILD_DIR/$PLUGIN_SLUG/"
    fi

    if [ -f "$PLUGIN_DIR/LICENSE" ] || [ -f "$PLUGIN_DIR/LICENSE.txt" ]; then
        cp "$PLUGIN_DIR/LICENSE"* "$BUILD_DIR/$PLUGIN_SLUG/" 2>/dev/null || true
    fi

    # Copy includes directory
    if [ -d "$PLUGIN_DIR/includes" ]; then
        cp -r "$PLUGIN_DIR/includes" "$BUILD_DIR/$PLUGIN_SLUG/"
        print_success "Copied includes directory"
    fi

    # Copy widgets directory
    if [ -d "$PLUGIN_DIR/widgets" ]; then
        cp -r "$PLUGIN_DIR/widgets" "$BUILD_DIR/$PLUGIN_SLUG/"
        print_success "Copied widgets directory"
    fi

    # Copy assets directory
    if [ -d "$PLUGIN_DIR/assets" ]; then
        cp -r "$PLUGIN_DIR/assets" "$BUILD_DIR/$PLUGIN_SLUG/"
        print_success "Copied assets directory"
    fi

    # Copy languages directory
    if [ -d "$PLUGIN_DIR/languages" ]; then
        cp -r "$PLUGIN_DIR/languages" "$BUILD_DIR/$PLUGIN_SLUG/"
        print_success "Copied languages directory"
    fi

    # Copy templates directory
    if [ -d "$PLUGIN_DIR/templates" ]; then
        cp -r "$PLUGIN_DIR/templates" "$BUILD_DIR/$PLUGIN_SLUG/"
        print_success "Copied templates directory"
    fi

    print_success "Plugin files copied"
}

# Remove development files
remove_dev_files() {
    print_step "Removing development files..."

    # Remove common dev files
    find "$BUILD_DIR" -name ".git" -type d -exec rm -rf {} + 2>/dev/null || true
    find "$BUILD_DIR" -name ".gitignore" -type f -delete 2>/dev/null || true
    find "$BUILD_DIR" -name ".gitattributes" -type f -delete 2>/dev/null || true
    find "$BUILD_DIR" -name ".DS_Store" -type f -delete 2>/dev/null || true
    find "$BUILD_DIR" -name "Thumbs.db" -type f -delete 2>/dev/null || true
    find "$BUILD_DIR" -name "*.log" -type f -delete 2>/dev/null || true
    find "$BUILD_DIR" -name "*.md" -type f -delete 2>/dev/null || true

    # Remove node_modules if exists
    find "$BUILD_DIR" -name "node_modules" -type d -exec rm -rf {} + 2>/dev/null || true

    # Remove package.json and package-lock.json
    find "$BUILD_DIR" -name "package.json" -type f -delete 2>/dev/null || true
    find "$BUILD_DIR" -name "package-lock.json" -type f -delete 2>/dev/null || true

    # Remove test directories
    find "$BUILD_DIR" -name "tests" -type d -exec rm -rf {} + 2>/dev/null || true
    find "$BUILD_DIR" -name "test" -type d -exec rm -rf {} + 2>/dev/null || true

    # Remove source maps
    find "$BUILD_DIR" -name "*.map" -type f -delete 2>/dev/null || true

    # Remove IDE files
    find "$BUILD_DIR" -name ".vscode" -type d -exec rm -rf {} + 2>/dev/null || true
    find "$BUILD_DIR" -name ".idea" -type d -exec rm -rf {} + 2>/dev/null || true

    print_success "Development files removed"
}

# Minify CSS and JS (if available)
minify_assets() {
    print_step "Checking for minification..."

    # Check if npm is available
    if command -v npm &> /dev/null; then
        print_warning "Minification not implemented yet. Add to future version."
        # TODO: Add minification logic here
        # npm run build:production
    else
        print_warning "npm not found, skipping minification"
    fi
}

# Create zip file
create_zip() {
    print_step "Creating zip file..."

    # Determine zip filename
    if [ "$VERSION" = "dev" ]; then
        ZIP_NAME="${PLUGIN_SLUG}-${VERSION}-${TIMESTAMP}.zip"
    else
        ZIP_NAME="${PLUGIN_SLUG}-${VERSION}.zip"
    fi

    # Change to build directory and create zip
    cd "$BUILD_DIR"
    zip -r "../$DIST_DIR/$ZIP_NAME" "$PLUGIN_SLUG" -q
    cd ..

    print_success "Zip file created: $DIST_DIR/$ZIP_NAME"
}

# Calculate file sizes
show_summary() {
    print_step "Build Summary"
    echo ""
    echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━"

    # Get file size
    if [ -f "$DIST_DIR/$ZIP_NAME" ]; then
        SIZE=$(du -h "$DIST_DIR/$ZIP_NAME" | cut -f1)
        echo "  Plugin:     $PLUGIN_SLUG"
        echo "  Version:    $VERSION"
        echo "  Filename:   $ZIP_NAME"
        echo "  Size:       $SIZE"
        echo "  Location:   $DIST_DIR/$ZIP_NAME"
    fi

    # Count files
    FILE_COUNT=$(find "$BUILD_DIR/$PLUGIN_SLUG" -type f | wc -l | tr -d ' ')
    echo "  Files:      $FILE_COUNT"

    echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━"
    echo ""
}

# Verify zip integrity
verify_zip() {
    print_step "Verifying zip integrity..."

    if unzip -t "$DIST_DIR/$ZIP_NAME" &> /dev/null; then
        print_success "Zip file is valid"
    else
        print_error "Zip file is corrupted!"
        exit 1
    fi
}

# Clean up build directory
cleanup() {
    if [ "$1" != "--keep-build" ]; then
        print_step "Cleaning up..."
        rm -rf "$BUILD_DIR"
        print_success "Build directory removed"
    else
        print_warning "Build directory kept at: $BUILD_DIR"
    fi
}

# Main execution
main() {
    print_header

    # Check requirements
    check_plugin_exists
    get_version

    # Build process
    clean_build
    copy_files
    remove_dev_files
    minify_assets
    create_zip
    verify_zip
    show_summary
    cleanup "$@"

    echo ""
    print_success "Build completed successfully!"
    echo ""
    echo "To install the plugin:"
    echo "  1. Upload $ZIP_NAME to WordPress"
    echo "  2. Or extract to wp-content/plugins/"
    echo ""
}

# Run main function with all arguments
main "$@"
