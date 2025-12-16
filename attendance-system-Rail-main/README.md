# Attendance System

PHP-based attendance system deployed on Railway.

## Quick Start

1. **Deploy to Railway:**
   - Push code to GitHub
   - Go to https://railway.app
   - Create new project → Deploy from GitHub
   - Add MySQL database service
   - Deploy web service

2. **Initialize Database:**
   - Use Railway MySQL console
   - Run `attendance_system.sql`

3. **Access Application:**
   - Railway provides a public URL automatically

## Detailed Deployment

See [RAILWAY-DEPLOY.md](RAILWAY-DEPLOY.md) for complete deployment instructions.

## Project Structure

```
.
├── Dockerfile                  # Docker image configuration
├── docker-compose.yml          # Docker Compose configuration
├── railway.json                # Railway configuration
├── railway.toml                # Railway configuration (alternative)
├── attendance_system.sql       # Database schema
├── php-login-register/         # Application source code
└── RAILWAY-DEPLOY.md          # Deployment guide
```

## Local Development

```bash
# Build Docker image
docker build -t attendance-system-web .

# Run with Docker Compose
docker-compose up -d

# Access at http://localhost:80
```

## Database Credentials

The application automatically reads from Railway environment variables:
- `MYSQLHOST` - Database host
- `MYSQLUSER` - Database user
- `MYSQLPASSWORD` - Database password
- `MYSQLDATABASE` - Database name

## Support

For deployment help, see [RAILWAY-DEPLOY.md](RAILWAY-DEPLOY.md).

