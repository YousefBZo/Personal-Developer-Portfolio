# ===========================================
# Portfolio Makefile
# ===========================================

.PHONY: help build up down restart logs shell migrate seed fresh test clean

# Default target
help:
	@echo "Available commands:"
	@echo "  make build    - Build Docker images"
	@echo "  make up       - Start all containers"
	@echo "  make down     - Stop all containers"
	@echo "  make restart  - Restart all containers"
	@echo "  make logs     - View container logs"
	@echo "  make shell    - Open shell in app container"
	@echo "  make migrate  - Run database migrations"
	@echo "  make seed     - Seed the database"
	@echo "  make fresh    - Fresh migration with seeding"
	@echo "  make test     - Run tests"
	@echo "  make install  - Install all dependencies"
	@echo "  make assets   - Build frontend assets"
	@echo "  make clean    - Stop containers and remove volumes"

# Build Docker images
build:
	docker-compose build

# Start containers
up:
	docker-compose up -d

# Stop containers
down:
	docker-compose down

# Restart containers
restart:
	docker-compose down
	docker-compose up -d

# View logs
logs:
	docker-compose logs -f

# Open shell in app container
shell:
	docker exec -it portfolio-app bash

# Run migrations
migrate:
	docker exec portfolio-app php artisan migrate

# Seed database
seed:
	docker exec portfolio-app php artisan db:seed

# Fresh migration with seed
fresh:
	docker exec portfolio-app php artisan migrate:fresh --seed

# Run tests
test:
	docker exec portfolio-app php artisan test

# Install dependencies
install:
	docker exec portfolio-app composer install
	docker exec portfolio_vite npm install

# Build assets
assets:
	docker exec portfolio_vite npm run build

# Full setup (first time)
setup: build up
	@echo "Waiting for containers to start..."
	@sleep 10
	docker exec portfolio-app composer install
	docker exec portfolio-app php artisan key:generate
	docker exec portfolio-app php artisan migrate --seed
	docker exec portfolio-app php artisan storage:link
	docker exec portfolio_vite npm install
	docker exec portfolio_vite npm run build
	@echo "Setup complete! Visit http://localhost"

# Clean everything
clean:
	docker-compose down -v
	docker system prune -f

# Check health status
health:
	@curl -s http://localhost/health | jq . || echo "Service not ready"

# View container status
status:
	docker-compose ps

