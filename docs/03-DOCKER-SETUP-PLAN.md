# Docker Development & Testing Environment Plan

**Version:** 1.0.0
**Date:** 2025-11-02
**Status:** Planning Phase

---

## Table of Contents

1. [Overview](#overview)
2. [Architecture](#architecture)
3. [Service Configuration](#service-configuration)
4. [Directory Structure](#directory-structure)
5. [Docker Compose Services](#docker-compose-services)
6. [Development Workflow](#development-workflow)
7. [Testing Infrastructure](#testing-infrastructure)
8. [Environment Variables](#environment-variables)
9. [Volume Management](#volume-management)
10. [Implementation Steps](#implementation-steps)
11. [Usage Guide](#usage-guide)
12. [Troubleshooting](#troubleshooting)

---

## Overview

### Purpose
Create a complete Docker-based development and testing environment for the Pagifye Elementor Widgets plugin that includes:

- **WordPress development** environment
- **Elementor Pro** (optional) integration
- **MySQL database** with persistent storage
- **phpMyAdmin** for database management
- **WP-CLI** for WordPress automation
- **Node.js** for asset building (Tailwind CSS, Alpine.js)
- **Testing environment** separate from development
- **Automated plugin installation** and setup

### Goals
- One-command setup (`docker-compose up`)
- Isolated development environment
- Easy switching between development and testing
- Automated Elementor installation
- Hot-reload for CSS/JS changes
- Database persistence
- Easy cleanup and reset

---

## Architecture

### Service Overview

```
┌─────────────────────────────────────────────────────────────┐
│                    Docker Compose Stack                      │
├─────────────────────────────────────────────────────────────┤
│                                                               │
│  ┌──────────────┐  ┌──────────────┐  ┌──────────────┐      │
│  │  WordPress   │  │  WordPress   │  │     Node     │      │
│  │    (Dev)     │  │   (Test)     │  │   Builder    │      │
│  │  Port: 8000  │  │  Port: 8001  │  │              │      │
│  └──────┬───────┘  └──────┬───────┘  └──────┬───────┘      │
│         │                  │                  │              │
│  ┌──────▼───────┐  ┌──────▼───────┐         │              │
│  │   MySQL      │  │   MySQL      │  ┌──────▼───────┐      │
│  │    (Dev)     │  │   (Test)     │  │  Tailwind    │      │
│  │  Port: 3306  │  │  Port: 3307  │  │   Watcher    │      │
│  └──────┬───────┘  └──────────────┘  └──────────────┘      │
│         │                                                    │
│  ┌──────▼───────┐                                           │
│  │ phpMyAdmin   │                                           │
│  │  Port: 8080  │                                           │
│  └──────────────┘                                           │
│                                                               │
└─────────────────────────────────────────────────────────────┘

Volumes:
- wp_dev_data        → WordPress development files
- wp_test_data       → WordPress test files
- db_dev_data        → MySQL development database
- db_test_data       → MySQL test database
- plugin_source      → Plugin source code (bind mount)
- node_modules       → npm packages
```

---

## Service Configuration

### 1. WordPress Development Service

**Purpose:** Main development environment
**Access:** http://localhost:8000

**Configuration:**
```yaml
Service: wordpress-dev
Image: wordpress:6.4-php8.1-apache
Port: 8000:80
Database: mysql-dev
Volumes:
  - Plugin source (bind mount)
  - WordPress data (persistent)
  - Upload directory
  - Themes directory
```

**Features:**
- Latest WordPress 6.4+
- PHP 8.1 for optimal performance
- Xdebug enabled for debugging
- WP_DEBUG enabled
- Elementor auto-installed
- Plugin auto-activated

---

### 2. WordPress Testing Service

**Purpose:** Isolated testing environment
**Access:** http://localhost:8001

**Configuration:**
```yaml
Service: wordpress-test
Image: wordpress:6.4-php8.1-apache
Port: 8001:80
Database: mysql-test
Volumes:
  - Plugin source (bind mount, read-only)
  - WordPress test data (ephemeral)
```

**Features:**
- Identical to dev but isolated
- Fresh database for each test run
- Read-only plugin mount (prevent accidental edits)
- Can be reset easily
- Used for automated testing

---

### 3. MySQL Development Database

**Purpose:** Development database
**Access:** localhost:3306

**Configuration:**
```yaml
Service: mysql-dev
Image: mysql:8.0
Port: 3306:3306
Database: wordpress_dev
User: wordpress
Password: wordpress
Root Password: rootpassword
```

**Features:**
- Persistent volume (survives restarts)
- Exposed port for external access
- Optimized for development
- Slow query log enabled

---

### 4. MySQL Testing Database

**Purpose:** Testing database
**Access:** localhost:3307

**Configuration:**
```yaml
Service: mysql-test
Image: mysql:8.0
Port: 3307:3306
Database: wordpress_test
User: wordpress_test
Password: wordpress_test
Root Password: rootpassword
```

**Features:**
- Separate from development
- Can be wiped and recreated easily
- Used for automated tests
- Faster configuration (no slow query log)

---

### 5. phpMyAdmin

**Purpose:** Database management UI
**Access:** http://localhost:8080

**Configuration:**
```yaml
Service: phpmyadmin
Image: phpmyadmin:latest
Port: 8080:80
Connects to: mysql-dev, mysql-test
```

**Features:**
- Web-based database management
- Visual query builder
- Import/export functionality
- Multi-server support

---

### 6. Node.js Builder Service

**Purpose:** Asset compilation and watching
**Access:** Internal only

**Configuration:**
```yaml
Service: node-builder
Image: node:18-alpine
Working Dir: /app
Volumes:
  - Plugin source (bind mount)
  - node_modules cache
Command: npm run dev
```

**Features:**
- Tailwind CSS compilation
- JavaScript bundling (Webpack)
- Watch mode for auto-rebuild
- Hot module replacement
- Source maps for debugging

---

### 7. WP-CLI Service

**Purpose:** WordPress command-line interface
**Access:** Run on-demand

**Configuration:**
```yaml
Service: wpcli
Image: wordpress:cli-php8.1
Volumes:
  - WordPress data (shared with wordpress-dev)
Network: Same as wordpress-dev
```

**Features:**
- Plugin installation/activation
- Theme management
- Database operations
- User creation
- Content import/export

---

## Directory Structure

```
pagifye/
├── docker/
│   ├── wordpress/
│   │   ├── Dockerfile              # Custom WordPress image
│   │   ├── php.ini                 # PHP configuration
│   │   ├── xdebug.ini              # Xdebug settings
│   │   └── wp-config-override.php  # WP config additions
│   ├── mysql/
│   │   ├── dev.cnf                 # MySQL dev config
│   │   └── test.cnf                # MySQL test config
│   ├── node/
│   │   ├── Dockerfile              # Node builder image
│   │   └── package.json            # Build dependencies
│   └── scripts/
│       ├── install-elementor.sh    # Auto-install Elementor
│       ├── activate-plugin.sh      # Activate our plugin
│       ├── setup-wordpress.sh      # Initial WP setup
│       ├── import-test-data.sh     # Load test content
│       └── reset-test-db.sh        # Reset test database
│
├── docker-compose.yml              # Main compose file
├── docker-compose.dev.yml          # Development overrides
├── docker-compose.test.yml         # Testing overrides
├── .env.docker                     # Docker environment variables
├── .dockerignore                   # Files to exclude
│
├── plugin/                         # Plugin source (to be created)
│   ├── pagifye-elementor-widgets.php
│   ├── includes/
│   ├── widgets/
│   ├── assets/
│   └── tests/
│
├── tailwind/                       # Tailwind build config
│   ├── tailwind.config.js
│   ├── package.json
│   └── src/
│
└── tests/                          # Test files
    ├── php/                        # PHPUnit tests
    ├── e2e/                        # Cypress E2E tests
    └── fixtures/                   # Test data
```

---

## Docker Compose Services

### Main docker-compose.yml

```yaml
version: '3.8'

services:
  # WordPress Development
  wordpress-dev:
    image: wordpress:6.4-php8.1-apache
    container_name: pagifye-wordpress-dev
    restart: unless-stopped
    ports:
      - "8000:80"
    environment:
      WORDPRESS_DB_HOST: mysql-dev:3306
      WORDPRESS_DB_NAME: wordpress_dev
      WORDPRESS_DB_USER: wordpress
      WORDPRESS_DB_PASSWORD: wordpress
      WORDPRESS_DEBUG: 1
      WORDPRESS_CONFIG_EXTRA: |
        define('WP_DEBUG_LOG', true);
        define('WP_DEBUG_DISPLAY', false);
        define('SCRIPT_DEBUG', true);
        define('SAVEQUERIES', true);
    volumes:
      # Plugin source (development)
      - ./plugin:/var/www/html/wp-content/plugins/pagifye-elementor-widgets
      # WordPress data persistence
      - wp_dev_data:/var/www/html
      # Custom PHP config
      - ./docker/wordpress/php.ini:/usr/local/etc/php/conf.d/custom.ini
      # Xdebug
      - ./docker/wordpress/xdebug.ini:/usr/local/etc/php/conf.d/xdebug.ini
    depends_on:
      - mysql-dev
    networks:
      - pagifye-network

  # MySQL Development Database
  mysql-dev:
    image: mysql:8.0
    container_name: pagifye-mysql-dev
    restart: unless-stopped
    ports:
      - "3306:3306"
    environment:
      MYSQL_ROOT_PASSWORD: rootpassword
      MYSQL_DATABASE: wordpress_dev
      MYSQL_USER: wordpress
      MYSQL_PASSWORD: wordpress
    volumes:
      - db_dev_data:/var/lib/mysql
      - ./docker/mysql/dev.cnf:/etc/mysql/conf.d/custom.cnf
    networks:
      - pagifye-network

  # WordPress Testing
  wordpress-test:
    image: wordpress:6.4-php8.1-apache
    container_name: pagifye-wordpress-test
    restart: unless-stopped
    ports:
      - "8001:80"
    environment:
      WORDPRESS_DB_HOST: mysql-test:3306
      WORDPRESS_DB_NAME: wordpress_test
      WORDPRESS_DB_USER: wordpress_test
      WORDPRESS_DB_PASSWORD: wordpress_test
      WORDPRESS_DEBUG: 1
    volumes:
      # Plugin source (read-only for testing)
      - ./plugin:/var/www/html/wp-content/plugins/pagifye-elementor-widgets:ro
      - wp_test_data:/var/www/html
    depends_on:
      - mysql-test
    networks:
      - pagifye-network
    profiles:
      - testing

  # MySQL Testing Database
  mysql-test:
    image: mysql:8.0
    container_name: pagifye-mysql-test
    restart: unless-stopped
    ports:
      - "3307:3306"
    environment:
      MYSQL_ROOT_PASSWORD: rootpassword
      MYSQL_DATABASE: wordpress_test
      MYSQL_USER: wordpress_test
      MYSQL_PASSWORD: wordpress_test
    volumes:
      - db_test_data:/var/lib/mysql
      - ./docker/mysql/test.cnf:/etc/mysql/conf.d/custom.cnf
    networks:
      - pagifye-network
    profiles:
      - testing

  # phpMyAdmin
  phpmyadmin:
    image: phpmyadmin:latest
    container_name: pagifye-phpmyadmin
    restart: unless-stopped
    ports:
      - "8080:80"
    environment:
      PMA_HOSTS: mysql-dev,mysql-test
      PMA_PORTS: 3306,3306
      PMA_USER: root
      PMA_PASSWORD: rootpassword
    depends_on:
      - mysql-dev
    networks:
      - pagifye-network

  # Node.js Asset Builder
  node-builder:
    build:
      context: ./docker/node
      dockerfile: Dockerfile
    container_name: pagifye-node-builder
    working_dir: /app
    volumes:
      - ./tailwind:/app
      - ./plugin/assets:/app/dist
      - node_modules:/app/node_modules
    command: npm run dev
    networks:
      - pagifye-network

  # WP-CLI
  wpcli:
    image: wordpress:cli-php8.1
    container_name: pagifye-wpcli
    user: xfs
    volumes:
      - wp_dev_data:/var/www/html
      - ./docker/scripts:/scripts
    depends_on:
      - wordpress-dev
      - mysql-dev
    networks:
      - pagifye-network
    profiles:
      - cli

volumes:
  wp_dev_data:
    name: pagifye_wp_dev_data
  wp_test_data:
    name: pagifye_wp_test_data
  db_dev_data:
    name: pagifye_db_dev_data
  db_test_data:
    name: pagifye_db_test_data
  node_modules:
    name: pagifye_node_modules

networks:
  pagifye-network:
    name: pagifye-network
    driver: bridge
```

---

## Development Workflow

### Initial Setup

```bash
# 1. Start development environment
docker-compose up -d

# 2. Wait for WordPress to be ready (30-60 seconds)
docker-compose logs -f wordpress-dev

# 3. Run WordPress setup
docker-compose --profile cli run --rm wpcli wp core install \
  --url=http://localhost:8000 \
  --title="Pagifye Dev" \
  --admin_user=admin \
  --admin_password=admin \
  --admin_email=admin@example.com

# 4. Install Elementor
docker-compose --profile cli run --rm wpcli wp plugin install elementor --activate

# 5. Activate our plugin
docker-compose --profile cli run --rm wpcli wp plugin activate pagifye-elementor-widgets

# 6. Start asset watcher
docker-compose up -d node-builder
```

### Daily Development

```bash
# Start services
docker-compose up -d

# View logs
docker-compose logs -f wordpress-dev

# Access WordPress
open http://localhost:8000

# Access phpMyAdmin
open http://localhost:8080

# Rebuild assets
docker-compose restart node-builder

# Stop services
docker-compose down
```

### Database Management

```bash
# Export database
docker-compose exec mysql-dev mysqldump -u wordpress -pwordpress wordpress_dev > backup.sql

# Import database
docker-compose exec -T mysql-dev mysql -u wordpress -pwordpress wordpress_dev < backup.sql

# Reset database
docker-compose down mysql-dev
docker volume rm pagifye_db_dev_data
docker-compose up -d mysql-dev
```

---

## Testing Infrastructure

### Running Tests

```bash
# Start test environment
docker-compose --profile testing up -d wordpress-test mysql-test

# Run PHPUnit tests
docker-compose --profile testing exec wordpress-test \
  vendor/bin/phpunit --configuration phpunit.xml

# Run E2E tests (Cypress)
docker-compose --profile testing exec wordpress-test \
  npm run test:e2e

# Reset test environment
docker-compose down wordpress-test mysql-test
docker volume rm pagifye_wp_test_data pagifye_db_test_data
docker-compose --profile testing up -d wordpress-test mysql-test
```

### Test Data

```bash
# Import test content
docker-compose --profile cli run --rm wpcli wp import /scripts/test-data.xml

# Create test users
docker-compose --profile cli run --rm wpcli wp user create testuser test@example.com --role=editor

# Generate test posts
docker-compose --profile cli run --rm wpcli wp post generate --count=50
```

---

## Environment Variables

### .env.docker

```env
# WordPress Development
WP_DEV_URL=http://localhost:8000
WP_DEV_ADMIN_USER=admin
WP_DEV_ADMIN_PASSWORD=admin
WP_DEV_ADMIN_EMAIL=admin@example.com

# WordPress Testing
WP_TEST_URL=http://localhost:8001
WP_TEST_ADMIN_USER=testadmin
WP_TEST_ADMIN_PASSWORD=testadmin
WP_TEST_ADMIN_EMAIL=test@example.com

# MySQL Development
MYSQL_DEV_ROOT_PASSWORD=rootpassword
MYSQL_DEV_DATABASE=wordpress_dev
MYSQL_DEV_USER=wordpress
MYSQL_DEV_PASSWORD=wordpress

# MySQL Testing
MYSQL_TEST_ROOT_PASSWORD=rootpassword
MYSQL_TEST_DATABASE=wordpress_test
MYSQL_TEST_USER=wordpress_test
MYSQL_TEST_PASSWORD=wordpress_test

# phpMyAdmin
PMA_HOSTS=mysql-dev,mysql-test

# Node Builder
NODE_ENV=development
TAILWIND_MODE=watch

# Xdebug
XDEBUG_MODE=debug
XDEBUG_CLIENT_HOST=host.docker.internal
XDEBUG_CLIENT_PORT=9003
```

---

## Volume Management

### Persistent Volumes

**Development Volumes (Keep Data):**
- `pagifye_wp_dev_data` - WordPress files, themes, plugins
- `pagifye_db_dev_data` - Development database
- `pagifye_node_modules` - npm packages cache

**Test Volumes (Can Reset):**
- `pagifye_wp_test_data` - Test WordPress instance
- `pagifye_db_test_data` - Test database

### Volume Commands

```bash
# List volumes
docker volume ls | grep pagifye

# Inspect volume
docker volume inspect pagifye_wp_dev_data

# Remove all volumes (DANGEROUS - loses all data)
docker-compose down -v

# Remove test volumes only
docker volume rm pagifye_wp_test_data pagifye_db_test_data

# Backup volume
docker run --rm -v pagifye_db_dev_data:/data -v $(pwd):/backup \
  alpine tar czf /backup/db_dev_backup.tar.gz -C /data .

# Restore volume
docker run --rm -v pagifye_db_dev_data:/data -v $(pwd):/backup \
  alpine tar xzf /backup/db_dev_backup.tar.gz -C /data
```

---

## Implementation Steps

### Phase 1: Basic Setup (Week 1)

**Step 1: Create Docker Files** (2 hours)
- [ ] Create `docker-compose.yml`
- [ ] Create `.env.docker`
- [ ] Create `.dockerignore`
- [ ] Create `docker/` directory structure

**Step 2: WordPress Service** (2 hours)
- [ ] Configure wordpress-dev service
- [ ] Configure mysql-dev service
- [ ] Set up volumes
- [ ] Test basic WordPress installation

**Step 3: phpMyAdmin** (1 hour)
- [ ] Add phpMyAdmin service
- [ ] Configure multi-server support
- [ ] Test database connections

**Step 4: WP-CLI Integration** (2 hours)
- [ ] Add wpcli service
- [ ] Create setup scripts
- [ ] Test WordPress automation

### Phase 2: Development Environment (Week 2)

**Step 5: Node Builder** (3 hours)
- [ ] Create Node Dockerfile
- [ ] Configure Tailwind build
- [ ] Set up watch mode
- [ ] Test hot reload

**Step 6: Plugin Integration** (2 hours)
- [ ] Create plugin directory structure
- [ ] Configure volume mounts
- [ ] Test plugin activation
- [ ] Verify asset loading

**Step 7: Elementor Setup** (2 hours)
- [ ] Create Elementor install script
- [ ] Configure Elementor Pro (optional)
- [ ] Test widget registration
- [ ] Verify editor functionality

### Phase 3: Testing Environment (Week 3)

**Step 8: Test Services** (3 hours)
- [ ] Add wordpress-test service
- [ ] Add mysql-test service
- [ ] Configure profiles
- [ ] Test isolation

**Step 9: Test Automation** (4 hours)
- [ ] Set up PHPUnit
- [ ] Configure Cypress
- [ ] Create test scripts
- [ ] Add CI/CD integration

**Step 10: Documentation** (2 hours)
- [ ] Write Docker usage guide
- [ ] Document common tasks
- [ ] Create troubleshooting guide
- [ ] Add video tutorial (optional)

---

## Usage Guide

### Quick Start

```bash
# Clone repository
git clone https://github.com/nadimtuhin/pagifye.git
cd pagifye

# Copy environment file
cp .env.docker.example .env.docker

# Start development environment
docker-compose up -d

# Access WordPress
open http://localhost:8000
# Login: admin / admin

# Access phpMyAdmin
open http://localhost:8080
```

### Common Tasks

#### Install New Plugin via WP-CLI
```bash
docker-compose --profile cli run --rm wpcli \
  wp plugin install contact-form-7 --activate
```

#### Update WordPress
```bash
docker-compose --profile cli run --rm wpcli \
  wp core update
```

#### Export/Import Database
```bash
# Export
docker-compose exec mysql-dev mysqldump \
  -u wordpress -pwordpress wordpress_dev > backup.sql

# Import
docker-compose exec -T mysql-dev mysql \
  -u wordpress -pwordpress wordpress_dev < backup.sql
```

#### Rebuild Assets
```bash
# One-time build
docker-compose run --rm node-builder npm run build

# Watch mode
docker-compose up -d node-builder
docker-compose logs -f node-builder
```

#### Run Tests
```bash
# PHP Unit Tests
docker-compose --profile testing run --rm wordpress-test \
  vendor/bin/phpunit

# E2E Tests
docker-compose --profile testing up -d wordpress-test
npm run test:e2e -- --config baseUrl=http://localhost:8001
```

---

## Troubleshooting

### Port Already in Use

**Problem:** Port 8000, 3306, or 8080 already in use

**Solution:**
```bash
# Check what's using the port
lsof -i :8000

# Change ports in docker-compose.yml
ports:
  - "8002:80"  # Change 8000 to 8002
```

### WordPress Installation Loop

**Problem:** Keeps showing WordPress installation screen

**Solution:**
```bash
# Reset WordPress
docker-compose down
docker volume rm pagifye_wp_dev_data
docker-compose up -d
```

### Permission Issues

**Problem:** Cannot write files in WordPress

**Solution:**
```bash
# Fix permissions
docker-compose exec wordpress-dev chown -R www-data:www-data /var/www/html
```

### Database Connection Errors

**Problem:** "Error establishing database connection"

**Solution:**
```bash
# Check MySQL is running
docker-compose ps mysql-dev

# Check database credentials in .env.docker

# Restart MySQL
docker-compose restart mysql-dev
```

### Node Builder Not Watching

**Problem:** CSS changes not reflecting

**Solution:**
```bash
# Restart node builder
docker-compose restart node-builder

# Check logs
docker-compose logs -f node-builder

# Force rebuild
docker-compose run --rm node-builder npm run build
```

---

## Performance Optimization

### macOS Performance

**Use Docker Desktop with:**
- VirtioFS (faster file sharing)
- Increased memory (4GB minimum)
- Increased CPU (2 cores minimum)

**Optimize volumes:**
```yaml
# Use delegated consistency for better performance
volumes:
  - ./plugin:/var/www/html/wp-content/plugins/pagifye-elementor-widgets:delegated
```

### Linux Performance

**Use native Docker:**
- No VM overhead
- Direct filesystem access
- Better network performance

### Windows (WSL2) Performance

**Keep files in WSL2 filesystem:**
```bash
# Clone repo in WSL2
cd ~/projects
git clone https://github.com/nadimtuhin/pagifye.git
```

---

## Security Considerations

### Development Only

**⚠️ WARNING:** This Docker setup is for **development only**, NOT for production!

**Security measures to add for production:**
- [ ] Change default passwords
- [ ] Use Docker secrets
- [ ] Enable SSL/TLS
- [ ] Restrict port exposure
- [ ] Use non-root users
- [ ] Enable security plugins
- [ ] Regular updates

### Credentials

**Never commit:**
- `.env.docker` file
- Database backups
- API keys
- Passwords

**Always use:**
- Environment variables
- Docker secrets (production)
- Strong passwords
- SSH keys for deployment

---

## Next Steps

1. ✅ Complete this planning document
2. ⏳ Create docker-compose.yml
3. ⏳ Create Docker configuration files
4. ⏳ Write setup scripts
5. ⏳ Test complete workflow
6. ⏳ Document usage guide
7. ⏳ Create video tutorial

---

## Related Documents

- [00-PROJECT-MASTER-PLAN.md](./00-PROJECT-MASTER-PLAN.md) - Overall project plan
- [01-PLUGIN-ARCHITECTURE.md](./01-PLUGIN-ARCHITECTURE.md) - Plugin structure
- [02-PRIORITY-COMPONENTS-SELECTION.md](./02-PRIORITY-COMPONENTS-SELECTION.md) - Widget selection

---

**Status:** Planning Complete
**Ready for:** Docker Implementation
**Estimated Setup Time:** 3 weeks (concurrent with Phase 1)
