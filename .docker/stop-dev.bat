@echo off
REM Docker Development Environment Stop Script for Windows

echo 🛑 Stopping Adult Dating Platform Development Environment
echo.

REM Stop Docker services
echo 🐳 Stopping Docker services...
docker-compose -f .docker/docker-compose.dev.yml down

echo.
echo ✅ Development environment stopped.
echo.
echo 💡 To start again, run: .docker\start-dev.bat
pause