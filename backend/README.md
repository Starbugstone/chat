# Adult Dating Platform - Backend API

This is the backend API for the Adult Dating Platform, built with Symfony 6.4 and API Platform 3.1.

## 🏗️ Architecture

### Technology Stack
- **Framework**: Symfony 6.4 (PHP 8.2+)
- **API Platform**: 3.1.29 for REST/GraphQL APIs
- **Database**: MySQL 8.0+ with spatial extensions
- **Authentication**: JWT with LexikJWTAuthenticationBundle 2.18.0
- **Caching**: Redis with Predis client
- **ORM**: Doctrine ORM 3.5+ with migrations

### Key Features
- RESTful API with OpenAPI documentation
- JWT-based stateless authentication
- Geospatial queries for location-based matching
- Real-time capabilities preparation
- Comprehensive security measures
- Automated testing suite

## 🚀 Quick Start

### Prerequisites
- PHP 8.2+
- MySQL 8.0+
- Redis 6.0+
- Composer

### Installation
```bash
# Install dependencies
composer install

# Configure environment
cp .env .env.local
# Edit .env.local with your configuration

# Generate JWT keys
php bin/console lexik:jwt:generate-keypair

# Setup database
php bin/console doctrine:database:create
php bin/console doctrine:migrations:migrate

# Start development server
symfony server:start
```

## 📋 Configuration

### Environment Variables (.env.local)
```env
# Database Configuration
DATABASE_URL="mysql://username:password@127.0.0.1:3306/dating_platform?serverVersion=8.0.32&charset=utf8mb4"

# Redis Configuration
REDIS_URL=redis://localhost:6379

# JWT Configuration
JWT_SECRET_KEY=%kernel.project_dir%/config/jwt/private.pem
JWT_PUBLIC_KEY=%kernel.project_dir%/config/jwt/public.pem
JWT_PASSPHRASE=your_secure_passphrase_here

# Application Configuration
APP_ENV=dev
APP_SECRET=your_app_secret_key_here
```

### Key Configuration Files
- `config/packages/doctrine.yaml` - Database and ORM configuration
- `config/packages/lexik_jwt_authentication.yaml` - JWT settings
- `config/packages/api_platform.yaml` - API Platform configuration
- `config/packages/security.yaml` - Security and authentication
- `config/packages/framework.yaml` - Redis and caching

## 🔧 Development Commands

### Cache Management
```bash
# Clear cache (works in all environments)
php bin/console cache:clear

# Clear cache for production
php bin/console cache:clear --env=prod --no-debug

# Warm up cache
php bin/console cache:warmup
```

### Database Operations
```bash
# Create database
php bin/console doctrine:database:create

# Generate migration
php bin/console make:migration

# Run migrations
php bin/console doctrine:migrations:migrate

# Load fixtures (development data)
php bin/console doctrine:fixtures:load
```

### JWT Management
```bash
# Generate JWT keypair
php bin/console lexik:jwt:generate-keypair

# Check JWT configuration
php bin/console lexik:jwt:check-config

# Regenerate keys (with --overwrite)
php bin/console lexik:jwt:generate-keypair --overwrite
```

### Development Tools
```bash
# List all routes
php bin/console debug:router

# Debug container services
php bin/console debug:container

# Check configuration
php bin/console debug:config doctrine
php bin/console debug:config lexik_jwt_authentication
```

## 🗄️ Database Schema

### Core Entities (Planned)
- **User**: Authentication and basic profile
- **UserProfile**: Extended profile information
- **Match**: Matching algorithm results
- **Message**: Real-time messaging
- **Location**: Geospatial data
- **Subscription**: Premium features
- **Media**: Photo/video content

### Spatial Features
Custom MySQL spatial functions configured:
- `ST_Distance_Sphere`: Calculate distance between coordinates
- `ST_Distance`: Standard distance calculation
- `ST_Contains`: Check if geometry contains another
- `ST_Within`: Check if geometry is within another

## 🔐 Security Configuration

### Authentication Flow
1. **Login**: POST `/api/auth/login` with email/password
2. **JWT Token**: Receive access token and refresh token
3. **API Access**: Include `Authorization: Bearer <token>` header
4. **Token Refresh**: Use refresh token to get new access token

### Security Features
- JWT stateless authentication
- Role-based access control (RBAC)
- API rate limiting (planned)
- Input validation and sanitization
- CORS configuration
- HTTPS enforcement (production)

### Firewall Configuration
```yaml
security:
    firewalls:
        login:
            pattern: ^/api/auth/login
            stateless: true
            json_login:
                check_path: /api/auth/login
        api:
            pattern: ^/api
            stateless: true
            jwt: ~
```

## 📡 API Documentation

### Available Endpoints
- **Authentication**: `/api/auth/login` (POST)
- **API Documentation**: `/api/docs` (GET)
- **OpenAPI Spec**: `/api/docs.json` (GET)

### API Platform Features
- Automatic OpenAPI/Swagger documentation
- JSON-LD and Hydra support
- Filtering, sorting, and pagination
- GraphQL endpoint (planned)
- Real-time subscriptions (planned)

### Testing the API
```bash
# Test login endpoint
curl -X POST http://localhost:8000/api/auth/login \
  -H "Content-Type: application/json" \
  -d '{"email":"user@example.com","password":"password"}'

# Access protected endpoint
curl -X GET http://localhost:8000/api/users \
  -H "Authorization: Bearer YOUR_JWT_TOKEN"
```

## 🧪 Testing

### Running Tests
```bash
# Run all tests
php bin/phpunit

# Run specific test suite
php bin/phpunit tests/Unit
php bin/phpunit tests/Integration

# Run with coverage
php bin/phpunit --coverage-html coverage
```

### Test Structure
- `tests/Unit/` - Unit tests for services and entities
- `tests/Integration/` - API endpoint tests
- `tests/Functional/` - End-to-end workflow tests

## 🚨 Known Issues & Fixes

### API Platform + JWT Compatibility Issue
**Status**: ✅ **RESOLVED**

**Problem**: API Platform v3.1.29 automatically configures JWT authentication with an unsupported `enabled: true` option, causing cache clearing to fail.

**Solution Applied**: Modified API Platform's extension to use supported JWT configuration options.

**File Modified**: `vendor/api-platform/core/src/Symfony/Bundle/DependencyInjection/ApiPlatformExtension.php`

**For Production**: Use composer patches to make this fix persistent across deployments.

**Full Documentation**: See `COMPATIBILITY_FIX.md` for complete details.

## 🔧 Troubleshooting

### Common Issues

#### Cache Clearing Fails
```bash
# Check if the compatibility fix is applied
grep -n "check_path" vendor/api-platform/core/src/Symfony/Bundle/DependencyInjection/ApiPlatformExtension.php

# If not found, the fix needs to be reapplied
```

#### JWT Configuration Issues
```bash
# Verify JWT configuration
php bin/console lexik:jwt:check-config

# Check if keys exist
ls -la config/jwt/

# Regenerate keys if needed
php bin/console lexik:jwt:generate-keypair --overwrite
```

#### Database Connection Issues
```bash
# Test database connection
php bin/console doctrine:query:sql "SELECT 1"

# Check database configuration
php bin/console debug:config doctrine
```

### Performance Optimization

#### Database Optimization
- Use indexes on frequently queried columns
- Optimize spatial queries with proper indexing
- Use database query profiling

#### Caching Strategy
- Redis for session storage and application cache
- HTTP cache headers for API responses
- Doctrine query result caching

## 📦 Dependencies

### Core Dependencies
```json
{
    "api-platform/core": "^3.1",
    "doctrine/doctrine-bundle": "^2.15",
    "doctrine/orm": "^3.5",
    "lexik/jwt-authentication-bundle": "^2.18",
    "predis/predis": "^3.2",
    "symfony/framework-bundle": "6.4.*",
    "symfony/security-bundle": "6.4.*"
}
```

### Development Dependencies
- PHPUnit for testing
- Symfony Maker Bundle for code generation
- Doctrine Fixtures for test data

## 🚀 Deployment

### Production Checklist
- [ ] Apply JWT compatibility fix via composer patches
- [ ] Configure production database with proper indexes
- [ ] Set up Redis cluster for high availability
- [ ] Configure proper CORS settings
- [ ] Enable HTTPS with valid SSL certificates
- [ ] Set up monitoring and logging
- [ ] Configure backup strategies

### Environment-Specific Configuration
```bash
# Production cache clearing
APP_ENV=prod php bin/console cache:clear --env=prod --no-debug

# Production database migrations
APP_ENV=prod php bin/console doctrine:migrations:migrate --no-interaction
```

## 📚 Additional Resources

- [Symfony Documentation](https://symfony.com/doc/current/index.html)
- [API Platform Documentation](https://api-platform.com/docs/)
- [Doctrine ORM Documentation](https://www.doctrine-project.org/projects/orm.html)
- [JWT Authentication Bundle](https://github.com/lexik/LexikJWTAuthenticationBundle)

---

**Need help?** Check the main project README or create an issue for support.