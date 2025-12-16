# Railway Deployment Guide

This guide will help you deploy the Attendance System to Railway cloud platform.

## Prerequisites

- Railway account (sign up at https://railway.app)
- GitHub account (for connecting your repository)
- Your code pushed to a GitHub repository

## Option 1: Deploy with Railway MySQL Service (Recommended)

### Step 1: Create New Project on Railway

1. Go to https://railway.app
2. Click **"New Project"**
3. Select **"Deploy from GitHub repo"**
4. Choose your repository

### Step 2: Add MySQL Database Service

1. In your Railway project, click **"+ New"**
2. Select **"Database"** → **"Add MySQL"**
3. Railway will automatically create a MySQL database
4. Note the environment variables Railway provides (you'll need these)

### Step 3: Deploy Web Application

1. In your Railway project, click **"+ New"**
2. Select **"GitHub Repo"** (or **"Empty Service"** if already connected)
3. Railway will auto-detect your `Dockerfile`
4. The service will start building automatically

### Step 4: Configure Environment Variables

Railway automatically provides MySQL connection variables. Your PHP code will automatically use them.

**Railway provides these variables:**
- `MYSQLHOST` - Database host
- `MYSQLUSER` - Database user
- `MYSQLPASSWORD` - Database password
- `MYSQLDATABASE` - Database name
- `MYSQL_URL` - Full connection URL

Your PHP code is already configured to read these automatically!

### Step 5: Initialize Database

After the database service is running:

1. Go to your MySQL service in Railway
2. Click **"Connect"** or **"Query"**
3. Run the SQL from `attendance_system.sql` to create tables and initial data

**OR** use Railway's MySQL console:
1. Click on your MySQL service
2. Click **"Data"** tab
3. Use the SQL editor to run `attendance_system.sql`

### Step 6: Generate Public URL

1. Click on your web service
2. Click **"Settings"**
3. Under **"Networking"**, click **"Generate Domain"**
4. Railway will provide a public URL (e.g., `your-app.railway.app`)

## Option 2: Deploy with Docker Compose (All-in-One)

Railway supports `docker-compose.yml` for multi-service deployments.

### Step 1: Create New Project

1. Go to Railway
2. Click **"New Project"**
3. Select **"Deploy from GitHub repo"**
4. Choose your repository

### Step 2: Railway Auto-Detects docker-compose.yml

Railway will automatically:
- Detect `docker-compose.yml`
- Create services for `web` and `db`
- Set up networking between services
- Provide environment variables

### Step 3: Configure Environment Variables (Optional)

If you want to customize database credentials:

1. Go to your project **"Variables"** tab
2. Add custom variables:
   - `MYSQL_ROOT_PASSWORD=your_password`
   - `MYSQL_DATABASE=attendance_system`
   - `MYSQL_USER=annisa`
   - `MYSQL_PASSWORD=12345`

### Step 4: Generate Public URL

1. Click on the `web` service
2. Go to **"Settings"** → **"Networking"**
3. Click **"Generate Domain"**

## Environment Variables Reference

Your application automatically reads these environment variables:

| Variable | Railway Default | Description |
|----------|----------------|-------------|
| `MYSQLHOST` | Auto-provided | Database hostname |
| `MYSQLUSER` | Auto-provided | Database username |
| `MYSQLPASSWORD` | Auto-provided | Database password |
| `MYSQLDATABASE` | Auto-provided | Database name |
| `MYSQL_URL` | Auto-provided | Full connection URL |
| `PORT` | Auto-provided | Port for web service (usually 80) |

## Database Initialization

After deployment, initialize your database:

### Method 1: Railway MySQL Console

1. Go to your MySQL service
2. Click **"Data"** tab
3. Copy and paste contents of `attendance_system.sql`
4. Execute the SQL

### Method 2: Using Railway CLI

```bash
# Install Railway CLI
npm i -g @railway/cli

# Login
railway login

# Connect to database
railway connect mysql

# Run SQL file
mysql -u $MYSQLUSER -p$MYSQLPASSWORD $MYSQLDATABASE < attendance_system.sql
```

### Method 3: Using MySQL Client

1. Get connection details from Railway MySQL service
2. Use any MySQL client (MySQL Workbench, DBeaver, etc.)
3. Connect using the provided credentials
4. Run `attendance_system.sql`

## Accessing Your Application

### Public URL

Railway provides a public URL like:
- `https://your-app-name.railway.app`

### Custom Domain (Optional)

1. Go to your web service **"Settings"**
2. Under **"Networking"**, add custom domain
3. Configure DNS as instructed

## Monitoring & Logs

### View Logs

1. Click on your service in Railway dashboard
2. Click **"Deployments"** tab
3. Click on a deployment to see logs

### View Metrics

1. Go to service **"Metrics"** tab
2. View CPU, Memory, and Network usage

## Updating Your Application

### Automatic Updates (GitHub)

1. Push changes to your GitHub repository
2. Railway automatically detects changes
3. Triggers new deployment
4. Zero-downtime deployment

### Manual Deploy

1. Go to Railway dashboard
2. Click **"Redeploy"** on your service

## Troubleshooting

### Application Not Starting

1. **Check logs:**
   - Go to service → **"Deployments"** → Click deployment → View logs

2. **Check environment variables:**
   - Go to **"Variables"** tab
   - Verify MySQL variables are set

3. **Check database connection:**
   - Verify MySQL service is running
   - Check connection variables match

### Database Connection Errors

1. **Verify MySQL service is running:**
   - Check MySQL service status in Railway

2. **Check environment variables:**
   - PHP code reads from `MYSQLHOST`, `MYSQLUSER`, etc.
   - Railway provides these automatically

3. **Test connection:**
   - Use Railway MySQL console to verify credentials

### Build Failures

1. **Check Dockerfile:**
   - Ensure `Dockerfile` is in root directory
   - Verify syntax is correct

2. **Check build logs:**
   - Go to deployment → View build logs
   - Look for error messages

## Railway CLI Commands

```bash
# Install Railway CLI
npm i -g @railway/cli

# Login
railway login

# Link to project
railway link

# View logs
railway logs

# Open shell in service
railway shell

# View variables
railway variables

# Set variable
railway variables set MYSQL_PASSWORD=yourpassword
```

## Cost Considerations

- **Free Tier:** Railway offers a free tier with $5 credit/month
- **Database:** MySQL service uses credits
- **Web Service:** Uses credits based on usage
- **Check:** Railway dashboard → **"Usage"** tab

## Best Practices

1. **Use Railway MySQL:** Recommended for production
2. **Environment Variables:** Never commit secrets to code
3. **Database Backups:** Railway provides automatic backups
4. **Monitoring:** Set up alerts in Railway dashboard
5. **Scaling:** Railway auto-scales based on traffic

## Support

- Railway Docs: https://docs.railway.app
- Railway Discord: https://discord.gg/railway
- Railway Status: https://status.railway.app

