#!/bin/bash

# Docker Development Environment Startup Script
# This script helps set up and start the development environment

echo "🚀 Starting Adult Dating Platform Development Environment"
echo "⚠️  This is for DEVELOPMENT ONLY - not for production use"
echo ""

# Check if Docker is running
if ! docker info > /dev/null 2>&1; then
    echo "❌ Docker is not running. Please start Docker first."
    exit 1
fi

# Check if docker-compose is available
if ! command -v docker-compose &> /dev/null; then
    echo "❌ docker-compose is not installed. Please install docker-compose first."
    exit 1
fi

echo "📋 Setting up environment..."

# Copy Docker environment file if .env doesn't exist
if [ ! -f ".docker/.env" ]; then
    echo "📄 Creating .docker/.env from template..."
    cp .docker/.env.example .docker/.env
    echo "✅ Docker environment file created. You can modify .docker/.env to customize ports."
fi

# Copy backend environment file if .env.local doesn't exist
if [ ! -f "backend/.env.local" ]; then
    echo "📄 Creating backend/.env.local from example..."
    cp backend/.env.example backend/.env.local
    echo "✅ Backend environment file created. You can modify backend/.env.local if needed."
fi

# Start Docker services
echo "🐳 Starting Docker services..."
docker-compose -f .docker/docker-compose.dev.yml up -d

# Wait for services to be ready
echo "⏳ Waiting for services to start..."
sleep 10

# Check if services are running
echo "🔍 Checking service status..."
docker-compose -f .docker/docker-compose.dev.yml ps

# Install backend dependencies if vendor folder doesn't exist
if [ ! -d "backend/vendor" ]; then
    echo "📦 Installing backend dependencies..."
    docker-compose -f .docker/docker-compose.dev.yml exec php composer install
fi

# Generate JWT keys if they don't exist
if [ ! -f "backend/config/jwt/private.pem" ]; then
    echo "🔐 Generating JWT keys..."
    docker-compose -f .docker/docker-compose.dev.yml exec php bin/console lexik:jwt:generate-keypair
fi

# Run database migrations
echo "🗄️  Running database migrations..."
docker-compose -f .docker/docker-compose.dev.yml exec php bin/console doctrine:migrations:migrate --no-interaction

# Install frontend dependencies if node_modules doesn't exist
if [ ! -d "frontend/node_modules" ]; then
    echo "📦 Installing frontend dependencies..."
    cd frontend && npm install && cd ..
fi

# Build frontend
echo "🏗️  Building frontend..."
cd frontend && npm run build && cd ..

echo ""
echo "🎉 Development environment is ready!"
echo ""
# Read ports from .env file for display
NGINX_PORT=$(grep NGINX_PORT .docker/.env | cut -d '=' -f2)
PHPMYADMIN_PORT=$(grep PHPMYADMIN_PORT .docker/.env | cut -d '=' -f2)
REDIS_COMMANDER_PORT=$(grep REDIS_COMMANDER_PORT .docker/.env | cut -d '=' -f2)

echo "📍 Access points:"
echo "   • Frontend & API: http://localhost:${NGINX_PORT}"
echo "   • phpMyAdmin:     http://localhost:${PHPMYADMIN_PORT}"
echo "   • Redis Commander: http://localhost:${REDIS_COMMANDER_PORT}"
echo ""
echo "🛠️  Useful commands:"
echo "   • View logs:      docker-compose -f .docker/docker-compose.dev.yml logs -f"
echo "   • Stop services:  docker-compose -f .docker/docker-compose.dev.yml down"
echo "   • Restart:        docker-compose -f .docker/docker-compose.dev.yml restart"
echo ""
echo "📚 See .docker/README.md for more information"