#!/bin/bash
# Reset Test Database Script

set -e

echo "==> Resetting test database..."

# Drop and recreate database
wp db reset --yes

echo "==> Reinstalling WordPress..."

# Reinstall WordPress
wp core install \
    --url="${WP_TEST_URL:-http://localhost:8001}" \
    --title="${WP_TEST_SITE_TITLE:-Pagifye Test}" \
    --admin_user="${WP_TEST_ADMIN_USER:-testadmin}" \
    --admin_password="${WP_TEST_ADMIN_PASSWORD:-testadmin}" \
    --admin_email="${WP_TEST_ADMIN_EMAIL:-test@example.com}" \
    --skip-email

echo "==> Installing Elementor..."
wp plugin install elementor --activate

echo "==> Activating Pagifye plugin..."
if wp plugin list --field=name | grep -q "pagifye-elementor-widgets"; then
    wp plugin activate pagifye-elementor-widgets
fi

echo "==> Test database reset complete!"
