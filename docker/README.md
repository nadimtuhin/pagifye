# Docker Development Environment

Complete Docker setup for Pagifye Elementor Widgets development and testing.

## Quick Start

```bash
# 1. Copy environment file
cp .env.docker.example .env.docker

# 2. Start development environment
docker-compose up -d

# 3. Wait for services to be ready (30-60 seconds)
docker-compose logs -f wordpress-dev

# 4. Run WordPress setup
docker-compose --profile cli run --rm wpcli sh /scripts/setup-wordpress.sh

# 5. Access WordPress
open http://localhost:8000
# Login: admin / admin

# 6. Access phpMyAdmin
open http://localhost:8080
```

## Services

| Service | URL | Purpose |
|---------|-----|---------|
| WordPress Dev | http://localhost:8000 | Development environment |
| WordPress Test | http://localhost:8001 | Testing environment |
| phpMyAdmin | http://localhost:8080 | Database management |
| MySQL Dev | localhost:3306 | Development database |
| MySQL Test | localhost:3307 | Testing database |

## Common Commands

### Start/Stop

```bash
# Start all services
docker-compose up -d

# Start with logs
docker-compose up

# Stop all services
docker-compose down

# Stop and remove volumes (⚠️ deletes all data)
docker-compose down -v
```

### WordPress Management

```bash
# Install WordPress
docker-compose --profile cli run --rm wpcli sh /scripts/setup-wordpress.sh

# List plugins
docker-compose --profile cli run --rm wpcli wp plugin list

# Install a plugin
docker-compose --profile cli run --rm wpcli wp plugin install contact-form-7 --activate

# Update WordPress
docker-compose --profile cli run --rm wpcli wp core update
```

### Database Management

```bash
# Export database
docker-compose exec mysql-dev mysqldump -u wordpress -pwordpress wordpress_dev > backup.sql

# Import database
docker-compose exec -T mysql-dev mysql -u wordpress -pwordpress wordpress_dev < backup.sql

# Access MySQL CLI
docker-compose exec mysql-dev mysql -u wordpress -pwordpress wordpress_dev

# Reset test database
docker-compose --profile cli run --rm wpcli sh /scripts/reset-test-db.sh
```

### Asset Building

```bash
# Start asset watcher
docker-compose up -d node-builder

# View build logs
docker-compose logs -f node-builder

# Rebuild assets
docker-compose restart node-builder

# One-time build
docker-compose run --rm node-builder npm run build
```

### Testing

```bash
# Start test environment
docker-compose --profile testing up -d wordpress-test mysql-test

# Run PHPUnit tests (when implemented)
docker-compose --profile testing exec wordpress-test vendor/bin/phpunit

# Reset test environment
docker-compose down wordpress-test mysql-test
docker volume rm pagifye_wp_test_data pagifye_db_test_data
```

### Logs

```bash
# View all logs
docker-compose logs

# Follow logs
docker-compose logs -f

# Service-specific logs
docker-compose logs wordpress-dev
docker-compose logs mysql-dev
docker-compose logs node-builder
```

### Cleanup

```bash
# Remove stopped containers
docker-compose down

# Remove containers and volumes
docker-compose down -v

# Remove containers, volumes, and images
docker-compose down -v --rmi all

# Clean everything Docker-related (⚠️ use with caution)
docker system prune -a --volumes
```

## Directory Structure

```
docker/
├── wordpress/
│   ├── php.ini              # PHP configuration
│   └── xdebug.ini           # Xdebug settings
├── mysql/
│   ├── dev.cnf              # MySQL development config
│   └── test.cnf             # MySQL testing config
├── node/
│   └── Dockerfile           # Node.js builder image
├── scripts/
│   ├── setup-wordpress.sh   # WordPress setup script
│   └── reset-test-db.sh     # Reset test database
└── README.md                # This file
```

## Environment Variables

Edit `.env.docker` to customize:

- WordPress admin credentials
- Database passwords
- Port numbers
- Node environment
- Xdebug settings

## Troubleshooting

### Port Already in Use

```bash
# Find what's using the port
lsof -i :8000

# Change port in docker-compose.yml
ports:
  - "8002:80"  # Changed from 8000
```

### WordPress Installation Loop

```bash
# Reset WordPress data
docker-compose down
docker volume rm pagifye_wp_dev_data
docker-compose up -d
docker-compose --profile cli run --rm wpcli sh /scripts/setup-wordpress.sh
```

### Permission Issues

```bash
# Fix WordPress permissions
docker-compose exec wordpress-dev chown -R www-data:www-data /var/www/html
```

### Database Connection Errors

```bash
# Check MySQL is running
docker-compose ps mysql-dev

# Restart MySQL
docker-compose restart mysql-dev

# Check credentials in .env.docker
```

### Assets Not Building

```bash
# Check node-builder logs
docker-compose logs node-builder

# Restart builder
docker-compose restart node-builder

# Force rebuild
docker-compose down node-builder
docker-compose up -d node-builder
```

## Performance Tips

### macOS

1. Enable VirtioFS in Docker Desktop preferences
2. Increase Docker memory to 4GB minimum
3. Use `:delegated` consistency mode (already configured)

### Linux

- Native Docker performance
- No additional configuration needed

### Windows (WSL2)

- Keep project files in WSL2 filesystem
- Don't use Windows filesystem paths

## Xdebug Setup

### VS Code

1. Install PHP Debug extension
2. Add to `.vscode/launch.json`:

```json
{
  "version": "0.2.0",
  "configurations": [
    {
      "name": "Listen for Xdebug",
      "type": "php",
      "request": "launch",
      "port": 9003,
      "pathMappings": {
        "/var/www/html/wp-content/plugins/pagifye-elementor-widgets": "${workspaceFolder}/plugin"
      }
    }
  ]
}
```

3. Start debugging (F5)
4. Set breakpoints in plugin code

## Next Steps

1. ✅ Services running
2. ✅ WordPress installed
3. ✅ Elementor activated
4. ⏳ Start plugin development
5. ⏳ Create first widget

See [main documentation](../docs/README.md) for plugin development guide.

## Support

For issues with Docker setup:
- Check logs: `docker-compose logs`
- Verify services: `docker-compose ps`
- Check disk space: `docker system df`
- See [troubleshooting](#troubleshooting) section above

For plugin development:
- See [docs/README.md](../docs/README.md)
- See component implementation plans in `docs/components/`
