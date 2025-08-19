# Docker Development Environment

⚠️ **DEVELOPMENT ONLY** ⚠️

This Docker setup is designed **exclusively for local development purposes**. It is not suitable for production deployment and should never be used in a production environment.

## Services Included

- **MySQL 8.0**: Database with spatial extensions for geolocation features
- **Redis**: Caching and session management
- **phpMyAdmin**: Database management interface
- **Nginx**: Web server for serving both frontend and backend
- **PHP-FPM**: PHP FastCGI Process Manager

## Quick Start

1. **Configure ports** (optional):
   ```bash
   # Copy and customize the environment file
   cp .docker/.env.example .docker/.env
   # Edit .docker/.env to set your preferred ports
   ```

2. **Start the development environment**:
   ```bash
   # Windows
   .docker\start-dev.bat
   
   # Linux/Mac
   .docker/start-dev.sh
   ```

   Or manually:
   ```bash
   docker-compose -f .docker/docker-compose.dev.yml up -d
   ```

## Port Configuration

Edit `.docker/.env` to customize ports if you have conflicts:

```env
# Port Configuration - Modify these if you have conflicts
NGINX_PORT=8080          # Frontend & API
PHPMYADMIN_PORT=8081     # Database management
REDIS_COMMANDER_PORT=8082 # Redis management
MYSQL_PORT=3306          # MySQL database
REDIS_PORT=6379          # Redis cache

# Container names (customize if you have naming conflicts)
CONTAINER_PREFIX=dating_platform
```

## Access Points

Default ports (customizable in `.docker/.env`):
- **Backend API**: http://localhost:8080/api
- **Frontend**: http://localhost:8080
- **phpMyAdmin**: http://localhost:8081
- **Redis Commander**: http://localhost:8082

## Environment Variables

The startup script automatically creates the necessary environment files:
- `.docker/.env` - Docker port and container configuration (from `.docker/.env.example`)
- `backend/.env.local` - Backend configuration (from `backend/.env.example`)

### Backend Configuration

The `backend/.env.local` file is configured for Docker by default. If you want to run the backend locally without Docker, uncomment the local database/Redis URLs in the file.

## Stopping the Environment

```bash
docker-compose -f .docker/docker-compose.dev.yml down
```

## Development Workflow

1. Start Docker services: `docker-compose -f .docker/docker-compose.dev.yml up -d`
2. Make code changes in your IDE
3. Backend changes are automatically reflected (volume mounts)
4. Frontend changes require rebuild: `cd frontend && npm run build`
5. Use phpMyAdmin to inspect database changes
6. Monitor logs: `docker-compose -f .docker/docker-compose.dev.yml logs -f`

## Troubleshooting

### Database Connection Issues
- Ensure MySQL container is running: `docker-compose -f .docker/docker-compose.dev.yml ps`
- Check logs: `docker-compose -f .docker/docker-compose.dev.yml logs database`

### Permission Issues
- Fix file permissions: `sudo chown -R $USER:$USER .`

### Port Conflicts
- Check if ports 8080, 8081, 8082, 3306, 6379 are available
- Modify port mappings in docker-compose.dev.yml if needed

Remember: This setup is for development only and includes default passwords and configurations that are not secure for production use.