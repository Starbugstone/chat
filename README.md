# Adult Dating Platform

A modern, secure, and feature-rich adult dating platform built with cutting-edge web technologies. This platform provides a comprehensive solution for adult users to connect, interact, and build meaningful relationships in a safe and privacy-focused environment.

## 🎯 Project Overview

### Purpose
This adult dating platform is designed to facilitate connections between consenting adults through a sophisticated matching system, real-time communication features, and advanced privacy controls. The platform emphasizes user safety, data protection, and authentic interactions.

### Key Features
- **Advanced Matching Algorithm**: AI-powered compatibility matching based on preferences, location, and behavior
- **Real-time Communication**: Instant messaging, video calls, and voice messages
- **Geolocation Services**: Location-based matching and proximity features
- **Privacy & Security**: End-to-end encryption, anonymous browsing, and comprehensive privacy controls
- **Content Management**: Photo/video sharing with moderation and verification systems
- **Subscription Management**: Flexible pricing tiers and premium features
- **Mobile-First Design**: Responsive web application optimized for all devices

## 🏗️ Architecture & Technology Stack

### Backend (API)
- **Framework**: Symfony 6.4 (PHP 8.2+)
- **API Platform**: 3.1.29 - REST/GraphQL API with OpenAPI documentation
- **Database**: MySQL 8.0+ with spatial extensions for geolocation
- **Authentication**: JWT (JSON Web Tokens) with refresh token support
- **Caching**: Redis for session management and application caching
- **ORM**: Doctrine ORM with migrations and fixtures
- **Security**: Symfony Security Bundle with role-based access control

### Frontend (Web Application)
- **Framework**: React 18+ with TypeScript
- **State Management**: Redux Toolkit for application state
- **UI Framework**: Material-UI (MUI) with custom theming
- **Real-time**: WebSocket integration for live features
- **Maps**: Integration with mapping services for location features
- **PWA**: Progressive Web App capabilities for mobile experience

### Infrastructure & DevOps
- **Containerization**: Docker with Docker Compose for development
- **Database**: MySQL with spatial extensions (PostGIS alternative)
- **Caching**: Redis cluster for high availability
- **File Storage**: Cloud storage integration for media files
- **Monitoring**: Application performance monitoring and logging

## 🚀 Getting Started

### Prerequisites
- **PHP**: 8.2 or higher
- **Node.js**: 18+ with npm/yarn
- **MySQL**: 8.0+ with spatial extensions
- **Redis**: 6.0+ for caching
- **Composer**: Latest version for PHP dependencies

### Installation

#### 1. Clone the Repository
```bash
git clone <repository-url>
cd adult-dating-platform
```

#### 2. Backend Setup
```bash
cd backend

# Install PHP dependencies
composer install

# Configure environment
cp .env .env.local
# Edit .env.local with your database and Redis credentials

# Generate JWT keys
php bin/console lexik:jwt:generate-keypair

# Create database and run migrations
php bin/console doctrine:database:create
php bin/console doctrine:migrations:migrate

# Load sample data (optional)
php bin/console doctrine:fixtures:load

# Start development server
symfony server:start
```

#### 3. Frontend Setup
```bash
cd frontend

# Install Node.js dependencies
npm install

# Configure environment
cp .env.example .env.local
# Edit .env.local with your API endpoints

# Start development server
npm run dev
```

#### 4. Development with Docker (Alternative)
```bash
# Start all services
docker-compose up -d

# Run database migrations
docker-compose exec backend php bin/console doctrine:migrations:migrate
```

### Environment Configuration

#### Backend (.env.local)
```env
# Database
DATABASE_URL="mysql://username:password@127.0.0.1:3306/dating_platform?serverVersion=8.0.32&charset=utf8mb4"

# Redis
REDIS_URL=redis://localhost:6379

# JWT Authentication
JWT_SECRET_KEY=%kernel.project_dir%/config/jwt/private.pem
JWT_PUBLIC_KEY=%kernel.project_dir%/config/jwt/public.pem
JWT_PASSPHRASE=your_secure_passphrase

# App Configuration
APP_ENV=dev
APP_SECRET=your_app_secret_key
```

#### Frontend (.env.local)
```env
# API Configuration
REACT_APP_API_URL=http://localhost:8000/api
REACT_APP_WS_URL=ws://localhost:8000/ws

# External Services
REACT_APP_GOOGLE_MAPS_API_KEY=your_google_maps_key
REACT_APP_STRIPE_PUBLIC_KEY=your_stripe_public_key
```

## 📁 Project Structure

```
adult-dating-platform/
├── backend/                    # Symfony API Backend
│   ├── config/                # Configuration files
│   │   ├── packages/          # Bundle configurations
│   │   ├── routes/            # Route definitions
│   │   └── jwt/               # JWT keys
│   ├── src/                   # Application source code
│   │   ├── Controller/        # API controllers
│   │   ├── Entity/            # Doctrine entities
│   │   ├── Repository/        # Data repositories
│   │   ├── Service/           # Business logic services
│   │   ├── Security/          # Authentication & authorization
│   │   └── Doctrine/          # Custom Doctrine functions
│   ├── migrations/            # Database migrations
│   ├── tests/                 # Backend tests
│   └── var/                   # Cache and logs
├── frontend/                  # React Frontend Application
│   ├── public/                # Static assets
│   ├── src/                   # React source code
│   │   ├── components/        # Reusable UI components
│   │   ├── pages/             # Page components
│   │   ├── hooks/             # Custom React hooks
│   │   ├── services/          # API services
│   │   ├── store/             # Redux store configuration
│   │   ├── types/             # TypeScript type definitions
│   │   └── utils/             # Utility functions
│   └── build/                 # Production build output
├── docker/                    # Docker configuration
├── docs/                      # Project documentation
└── .kiro/                     # Kiro IDE specifications
    └── specs/                 # Feature specifications
```

## 🔧 Development Workflow

### Backend Development
```bash
# Clear cache (works in all environments)
php bin/console cache:clear

# Create new entity
php bin/console make:entity

# Generate migration
php bin/console make:migration

# Run migrations
php bin/console doctrine:migrations:migrate

# Run tests
php bin/phpunit

# Check JWT configuration
php bin/console lexik:jwt:check-config
```

### Frontend Development
```bash
# Start development server
npm run dev

# Run tests
npm test

# Build for production
npm run build

# Type checking
npm run type-check

# Linting
npm run lint
```

### API Documentation
- **OpenAPI/Swagger**: Available at `http://localhost:8000/api/docs`
- **Interactive API Explorer**: Test endpoints directly from the browser
- **JSON Schema**: Auto-generated from Doctrine entities

## 🔐 Security Features

### Authentication & Authorization
- **JWT Authentication**: Stateless authentication with refresh tokens
- **Role-Based Access Control**: User, Premium, Moderator, Admin roles
- **API Rate Limiting**: Protection against abuse and spam
- **CORS Configuration**: Secure cross-origin resource sharing

### Data Protection
- **Input Validation**: Comprehensive validation on all endpoints
- **SQL Injection Prevention**: Doctrine ORM with parameterized queries
- **XSS Protection**: Content Security Policy and input sanitization
- **HTTPS Enforcement**: SSL/TLS encryption for all communications

### Privacy Controls
- **Anonymous Browsing**: Users can browse without revealing identity
- **Data Encryption**: Sensitive data encrypted at rest and in transit
- **GDPR Compliance**: Data export, deletion, and consent management
- **Content Moderation**: Automated and manual content review systems

## 🗄️ Database Schema

### Core Entities
- **User**: User profiles, preferences, and authentication
- **Profile**: Extended user information and preferences
- **Match**: Matching algorithm results and compatibility scores
- **Message**: Real-time messaging system
- **Location**: Geospatial data for location-based features
- **Subscription**: Premium features and billing management
- **Media**: Photo and video content with moderation status

### Spatial Features
- **Geolocation Support**: MySQL spatial extensions for distance calculations
- **Custom Spatial Functions**: ST_Distance_Sphere, ST_Contains, ST_Within
- **Location-Based Matching**: Proximity-based user discovery

## 🧪 Testing Strategy

### Backend Testing
- **Unit Tests**: PHPUnit for service and entity testing
- **Integration Tests**: API endpoint testing with test database
- **Functional Tests**: End-to-end workflow testing
- **Security Tests**: Authentication and authorization testing

### Frontend Testing
- **Unit Tests**: Jest and React Testing Library
- **Component Tests**: Isolated component behavior testing
- **Integration Tests**: User interaction flow testing
- **E2E Tests**: Cypress for full application testing

## 📊 Performance & Monitoring

### Caching Strategy
- **Redis Caching**: Application-level caching for frequently accessed data
- **HTTP Caching**: API response caching with proper cache headers
- **Database Query Optimization**: Indexed queries and query optimization

### Monitoring & Logging
- **Application Logs**: Structured logging with Monolog
- **Performance Monitoring**: Response time and resource usage tracking
- **Error Tracking**: Comprehensive error logging and alerting
- **Database Monitoring**: Query performance and connection monitoring

## 🚀 Deployment

### Production Environment
- **Web Server**: Nginx with PHP-FPM
- **Database**: MySQL cluster with read replicas
- **Caching**: Redis cluster for high availability
- **CDN**: Content delivery network for static assets
- **SSL/TLS**: Let's Encrypt or commercial certificates

### CI/CD Pipeline
- **Automated Testing**: Run full test suite on every commit
- **Code Quality**: Static analysis and code style checking
- **Security Scanning**: Dependency vulnerability scanning
- **Automated Deployment**: Zero-downtime deployment strategies

## 🐛 Known Issues & Fixes

### API Platform + JWT Compatibility
- **Issue**: Cache clearing failed due to configuration conflict
- **Status**: ✅ **RESOLVED** 
- **Solution**: Applied compatibility fix in API Platform extension
- **Documentation**: See `backend/COMPATIBILITY_FIX.md` for detailed explanation

## 🤝 Contributing

### Development Guidelines
1. **Code Standards**: Follow PSR-12 for PHP, ESLint/Prettier for TypeScript
2. **Git Workflow**: Feature branches with pull request reviews
3. **Testing**: Maintain test coverage above 80%
4. **Documentation**: Update documentation for new features

### Getting Help
- **Issues**: Report bugs and feature requests via GitHub issues
- **Discussions**: Technical discussions and questions
- **Documentation**: Comprehensive guides in the `/docs` directory

## 📄 License

This project is proprietary software. All rights reserved.

## 🔗 Related Documentation

- [Backend API Documentation](backend/README.md)
- [Frontend Development Guide](frontend/README.md)
- [Deployment Guide](docs/deployment.md)
- [Security Guidelines](docs/security.md)
- [API Platform JWT Fix](backend/COMPATIBILITY_FIX.md)

---

**Built with ❤️ for connecting people in meaningful ways.**