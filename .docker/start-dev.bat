@echo off
REM Docker Development Environment Startup Script for Windows
REM This script helps set up and start the development environment

echo 🚀 Starting Adult Dating Platform Development Environment
echo ⚠️  This is for DEVELOPMENT ONLY - not for production use
echo.

REM Check if Docker is running
docker info >nul 2>&1
if %errorlevel% neq 0 (
    echo ❌ Docker is not running. Please start Docker Desktop first.
    pause
    exit /b 1
)

REM Check if docker-compose is available
docker-compose --version >nul 2>&1
if %errorlevel% neq 0 (
    echo ❌ docker-compose is not available. Please install Docker Desktop with docker-compose.
    pause
    exit /b 1
)

echo 📋 Setting up environment...

REM Copy Docker environment file if .env doesn't exist
if not exist ".docker\.env" (
    echo 📄 Creating .docker\.env from template...
    copy ".docker\.env.example" ".docker\.env"
    echo ✅ Docker environment file created. You can modify .docker\.env to customize ports.
)

REM Copy backend environment file if .env.local doesn't exist
if not exist "backend\.env.local" (
    echo 📄 Creating backend\.env.local from example...
    copy "backend\.env.example" "backend\.env.local"
    echo ✅ Backend environment file created. You can modify backend\.env.local if needed.
)

REM Start Docker services
echo 🐳 Starting Docker services...
docker-compose -f .docker/docker-compose.dev.yml up -d

REM Wait for services to be ready
echo ⏳ Waiting for services to start...
timeout /t 10 /nobreak >nul

REM Check if services are running
echo 🔍 Checking service status...
docker-compose -f .docker/docker-compose.dev.yml ps

REM Install backend dependencies if vendor folder doesn't exist
if not exist "backend\vendor" (
    echo 📦 Installing backend dependencies...
    docker-compose -f .docker/docker-compose.dev.yml exec php composer install
)

REM Generate JWT keys if they don't exist
if not exist "backend\config\jwt\private.pem" (
    echo 🔐 Generating JWT keys...
    docker-compose -f .docker/docker-compose.dev.yml exec php bin/console lexik:jwt:generate-keypair
)

REM Run database migrations
echo 🗄️  Running database migrations...
docker-compose -f .docker/docker-compose.dev.yml exec php bin/console doctrine:migrations:migrate --no-interaction

REM Install frontend dependencies if node_modules doesn't exist
if not exist "frontend\node_modules" (
    echo 📦 Installing frontend dependencies...
    cd frontend && npm install && cd ..
)

REM Build frontend
echo 🏗️  Building frontend...
cd frontend && npm run build && cd ..

echo.
echo 🎉 Development environment is ready!
echo.
REM Read ports from .env file for display
for /f "tokens=2 delims==" %%a in ('findstr "NGINX_PORT" .docker\.env') do set NGINX_PORT=%%a
for /f "tokens=2 delims==" %%a in ('findstr "PHPMYADMIN_PORT" .docker\.env') do set PHPMYADMIN_PORT=%%a
for /f "tokens=2 delims==" %%a in ('findstr "REDIS_COMMANDER_PORT" .docker\.env') do set REDIS_COMMANDER_PORT=%%a

echo 📍 Access points:
echo    • Frontend ^& API: http://localhost:%NGINX_PORT%
echo    • phpMyAdmin:     http://localhost:%PHPMYADMIN_PORT%
echo    • Redis Commander: http://localhost:%REDIS_COMMANDER_PORT%
echo.
echo 🛠️  Useful commands:
echo    • View logs:      docker-compose -f .docker/docker-compose.dev.yml logs -f
echo    • Stop services:  docker-compose -f .docker/docker-compose.dev.yml down
echo    • Restart:        docker-compose -f .docker/docker-compose.dev.yml restart
echo.
echo 📚 See .docker\README.md for more information
pause