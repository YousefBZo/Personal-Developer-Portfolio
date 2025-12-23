# Personal Developer Portfolio

A modern, responsive developer portfolio built with Laravel and Tailwind CSS. Features an admin panel for managing skills, projects, experiences, and contact information.

![Laravel](https://img.shields.io/badge/Laravel-12.x-red?logo=laravel)
![PHP](https://img.shields.io/badge/PHP-8.2+-blue?logo=php)
![Tailwind CSS](https://img.shields.io/badge/Tailwind-3.x-38B2AC?logo=tailwindcss)
![PostgreSQL](https://img.shields.io/badge/PostgreSQL-16-blue?logo=postgresql)
![Docker](https://img.shields.io/badge/Docker-Ready-2496ED?logo=docker)

---

## 🚀 Tech Stack

| Technology    | Version | Purpose                    |
|---------------|---------|----------------------------|
| Laravel       | 12.x    | Backend Framework          |
| PHP           | 8.2+    | Server-side Language       |
| PostgreSQL    | 16      | Database                   |
| Tailwind CSS  | 3.x     | Styling                    |
| Vite          | 7.x     | Frontend Build Tool        |
| Nginx         | Latest  | Web Server                 |
| Docker        | Latest  | Containerization           |

---

## 📋 Prerequisites

- [Docker](https://www.docker.com/get-started) installed
- [Docker Compose](https://docs.docker.com/compose/install/) installed
- Git

---

## 🛠️ Quick Start (Docker)

### 1. Clone the Repository

```bash
git clone https://github.com/yourusername/Personal-Developer-Portfolio.git
cd Personal-Developer-Portfolio
```

### 2. Set Up Environment Variables

```bash
cp .env.example .env
```

Edit `.env` file with your configuration:

```env
APP_NAME="Portfolio"
APP_ENV=local
APP_DEBUG=true
APP_URL=http://localhost

DB_CONNECTION=pgsql
DB_HOST=postgres
DB_PORT=5432
DB_DATABASE=portfolio
DB_USERNAME=portfolio
DB_PASSWORD=secret

POSTGRES_DB=portfolio
POSTGRES_USER=portfolio
POSTGRES_PASSWORD=secret
```

### 3. Build and Run Containers

```bash
docker-compose up -d --build
```

**Or use Makefile (easier):**

```bash
make setup    # First time setup - does everything automatically
```

### 4. Install Dependencies & Setup

```bash
# Install PHP dependencies
docker exec portfolio-app composer install

# Generate application key
docker exec portfolio-app php artisan key:generate

# Run database migrations
docker exec portfolio-app php artisan migrate

# Seed the database (optional - adds sample data)
docker exec portfolio-app php artisan db:seed

# Create storage link
docker exec portfolio-app php artisan storage:link
```

### 5. Build Frontend Assets

```bash
# Install Node dependencies and build assets
docker exec portfolio_vite npm install
docker exec portfolio_vite npm run build
```

---

## 🌐 Access the Application

| Service          | URL                          |
|------------------|------------------------------|
| Portfolio        | http://localhost             |
| Admin Dashboard  | http://localhost/admin       |
| Login Page       | http://localhost/login       |
| Vite Dev Server  | http://localhost:5173        |

### Default Admin Credentials

```
Email: admin@admin.com
Password: password
```

---

## 🔧 Configuration

### Ports

| Service    | Port  |
|------------|-------|
| Nginx      | 80    |
| PostgreSQL | 5432  |
| Vite       | 5173  |

### Environment Variables

| Variable           | Description                    | Default     |
|--------------------|--------------------------------|-------------|
| `APP_NAME`         | Application name               | Portfolio   |
| `APP_ENV`          | Environment (local/production) | local       |
| `APP_DEBUG`        | Debug mode                     | true        |
| `DB_HOST`          | Database host                  | postgres    |
| `DB_DATABASE`      | Database name                  | portfolio   |
| `DB_USERNAME`      | Database username              | portfolio   |
| `DB_PASSWORD`      | Database password              | secret      |

---

## 🧪 Testing

### Access the Portfolio

1. Open http://localhost in your browser
2. You should see the portfolio homepage with:
   - Hero section with profile info
   - Skills section
   - Projects section
   - Experience timeline
   - Contact section

### Access the Admin Panel

1. Go to http://localhost/login
2. Enter admin credentials
3. You'll be redirected to http://localhost/admin
4. From here you can manage:
   - Profile information
   - Skills
   - Projects
   - Work experiences
   - Contact links

---

## 🛑 Stop and Clean Up

### Stop Containers

```bash
docker-compose down
```

### Stop and Remove Volumes (Full Reset)

```bash
docker-compose down -v
```

### Remove All Docker Resources

```bash
# Stop containers
docker-compose down -v

# Remove images
docker rmi portfolio-app portfolio-nginx portfolio-postgres portfolio_vite

# Prune unused resources
docker system prune -f
```

---

## 📁 Project Structure

```
├── app/
│   ├── Http/Controllers/
│   │   ├── Admin/          # Admin panel controllers
│   │   └── Auth/           # Authentication controllers
│   ├── Models/             # Eloquent models
│   └── Service/            # Business logic
├── database/
│   ├── migrations/         # Database migrations
│   └── seeders/            # Database seeders
├── docker/
│   ├── nginx/              # Nginx configuration
│   ├── node/               # Node.js/Vite configuration
│   ├── php/                # PHP-FPM configuration
│   └── postgres/           # PostgreSQL configuration
├── resources/
│   ├── css/                # Stylesheets
│   ├── js/                 # JavaScript files
│   └── views/              # Blade templates
├── routes/
│   ├── web.php             # Web routes
│   └── auth.php            # Authentication routes
├── docker-compose.yml
└── README.md
```

---

## 🤝 Contributing

1. Fork the repository
2. Create your feature branch (`git checkout -b feature/amazing-feature`)
3. Commit your changes (`git commit -m 'Add some amazing feature'`)
4. Push to the branch (`git push origin feature/amazing-feature`)
5. Open a Pull Request

---

## 📄 License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
A responsive personal portfolio website showcasing my skills, projects, experiences ,and contact information.
