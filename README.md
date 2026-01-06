# Personal Developer Portfolio

A modern, responsive developer portfolio built with Laravel and Tailwind CSS. Features an admin panel for managing skills, projects, experiences, and contact information.

![Laravel](https://img.shields.io/badge/Laravel-12.x-red?logo=laravel)
![PHP](https://img.shields.io/badge/PHP-8.4+-blue?logo=php)
![Tailwind CSS](https://img.shields.io/badge/Tailwind-3.x-38B2AC?logo=tailwindcss)
![PostgreSQL](https://img.shields.io/badge/PostgreSQL-15-blue?logo=postgresql)
![Docker](https://img.shields.io/badge/Docker-Ready-2496ED?logo=docker)

---

## 🌐 Production URL

**Live Site:** [https://yousefportfolio-cq5n.onrender.com](https://yousefportfolio-cq5n.onrender.com)

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

## 🚀 Deploy to VPS / Render

### Option 1: Deploy to Render (Free Hosting)

#### Prerequisites
- GitHub account with this repository
- Render account ([render.com](https://render.com))

#### Step 1: Create PostgreSQL Database
1. Go to Render Dashboard → **New** → **PostgreSQL**
2. Configure:
   - Name: `portfolio-db`
   - Region: Choose closest to you
   - Plan: Free
3. Click **Create Database**
4. Copy the connection details (hostname, database, username, password)

#### Step 2: Create Web Service
1. Go to Render Dashboard → **New** → **Web Service**
2. Connect your GitHub repository
3. Configure:
   - Name: `portfolio`
   - Region: **Same as database**
   - Branch: `main` or `vps`
   - Runtime: **Docker**
   - Plan: Free
4. Click **Create Web Service**

#### Step 3: Add Environment Variables
Go to your Web Service → **Environment** tab and add:

| Key | Value |
|-----|-------|
| `APP_KEY` | `base64:xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx` (generate with `php artisan key:generate --show`) |
| `APP_ENV` | `production` |
| `APP_DEBUG` | `false` |
| `APP_URL` | `https://your-app.onrender.com` |
| `DB_CONNECTION` | `pgsql` |
| `DB_HOST` | (from Render PostgreSQL) |
| `DB_PORT` | `5432` |
| `DB_DATABASE` | (from Render PostgreSQL) |
| `DB_USERNAME` | (from Render PostgreSQL) |
| `DB_PASSWORD` | (from Render PostgreSQL) |
| `SESSION_DRIVER` | `file` |
| `CACHE_STORE` | `file` |

#### Step 4: Deploy
Click **Manual Deploy** → **Deploy latest commit**

---

### Option 2: Deploy to VPS with Docker

#### Prerequisites
- VPS with Ubuntu 20.04+ (DigitalOcean, Linode, AWS EC2, etc.)
- Domain name (optional)

#### Step 1: Install Docker on VPS

```bash
# Connect to your VPS
ssh root@your-server-ip

# Update packages
sudo apt update && sudo apt upgrade -y

# Install Docker
curl -fsSL https://get.docker.com -o get-docker.sh
sudo sh get-docker.sh

# Install Docker Compose
sudo apt install docker-compose -y

# Add user to docker group
sudo usermod -aG docker $USER
```

#### Step 2: Clone and Configure

```bash
# Install Git
sudo apt install git -y

# Clone the repository
git clone https://github.com/YousefBZo/Personal-Developer-Portfolio.git
cd Personal-Developer-Portfolio

# Copy environment file
cp .env.example .env

# Edit environment variables
nano .env
```

Update `.env` with production values:
```env
APP_ENV=production
APP_DEBUG=false
APP_URL=http://your-server-ip

DB_CONNECTION=pgsql
DB_HOST=postgres
DB_DATABASE=portfolio
DB_USERNAME=portfolio
DB_PASSWORD=your-secure-password
```

#### Step 3: Build and Run

```bash
# Build and start containers
docker-compose up -d --build

# Run migrations
docker exec portfolio-app php artisan migrate --force

# Seed database (optional)
docker exec portfolio-app php artisan db:seed --force

# Create storage link
docker exec portfolio-app php artisan storage:link
```

#### Step 4: Configure Firewall

```bash
# Allow HTTP and HTTPS
sudo ufw allow 80
sudo ufw allow 443
sudo ufw enable
```

Your site should now be accessible at `http://your-server-ip`

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
