#!/bin/bash
# WordPress Initial Setup Script

set -e

echo "==> Setting up WordPress..."

# Wait for WordPress to be ready
until wp core is-installed 2>/dev/null; do
    echo "Waiting for WordPress to be ready..."
    sleep 5
done

echo "==> WordPress is ready!"

# Install WordPress core
if ! wp core is-installed; then
    echo "==> Installing WordPress core..."
    wp core install \
        --url="${WP_DEV_URL:-http://localhost:8000}" \
        --title="${WP_DEV_SITE_TITLE:-Pagifye Dev}" \
        --admin_user="${WP_DEV_ADMIN_USER:-admin}" \
        --admin_password="${WP_DEV_ADMIN_PASSWORD:-admin}" \
        --admin_email="${WP_DEV_ADMIN_EMAIL:-admin@example.com}" \
        --skip-email
    echo "==> WordPress installed successfully!"
else
    echo "==> WordPress already installed"
fi

# Install and activate Elementor
if ! wp plugin is-installed elementor; then
    echo "==> Installing Elementor..."
    wp plugin install elementor --activate
    echo "==> Elementor installed and activated!"
else
    echo "==> Elementor already installed"
    if ! wp plugin is-active elementor; then
        wp plugin activate elementor
        echo "==> Elementor activated!"
    fi
fi

# Activate our plugin (if it exists)
if wp plugin list --field=name | grep -q "pagifye-elementor-widgets"; then
    if ! wp plugin is-active pagifye-elementor-widgets; then
        wp plugin activate pagifye-elementor-widgets
        echo "==> Pagifye Elementor Widgets activated!"
    else
        echo "==> Pagifye Elementor Widgets already active"
    fi
else
    echo "==> Pagifye Elementor Widgets not found (will be available after plugin development)"
fi

# Set permalink structure
wp rewrite structure '/%postname%/' --hard
echo "==> Permalink structure updated"

# Set timezone
wp option update timezone_string 'UTC'

# Discourage search engines (development only)
wp option update blog_public 0

echo "==> WordPress setup complete!"
echo "==> Access WordPress at: ${WP_DEV_URL:-http://localhost:8000}"
echo "==> Login: ${WP_DEV_ADMIN_USER:-admin} / ${WP_DEV_ADMIN_PASSWORD:-admin}"
