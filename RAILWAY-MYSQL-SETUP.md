# Railway MySQL Database Setup Guide

This guide will walk you through setting up MySQL on Railway and connecting it to your application.

## Step 1: Add MySQL Service to Railway

1. **Go to your Railway project dashboard**
   - Visit https://railway.app
   - Open your project

2. **Add MySQL Database Service**
   - Click **"+ New"** button (top right or in your project)
   - Select **"Database"** from the dropdown
   - Click **"Add MySQL"**
   - Railway will automatically create and configure MySQL

3. **Wait for MySQL to start**
   - You'll see a new service appear (usually named "MySQL" or "mysql")
   - Wait until it shows "Running" status (green indicator)

## Step 2: Connect MySQL to Your Web Service

1. **Go to your Web Service** (your PHP application)
   - Click on your web service in the Railway dashboard

2. **Add MySQL Variables as Service Variables**
   - Click on the **"Variables"** tab
   - Railway automatically provides variables, but you need to reference them
   - Click **"+ New Variable"**

3. **Link MySQL Variables to Web Service**

   Railway provides these variables automatically for MySQL service:
   - `MYSQLHOST` - The hostname (e.g., `containers-us-west-xxx.railway.app`)
   - `MYSQLUSER` - Database username
   - `MYSQLPASSWORD` - Database password
   - `MYSQLDATABASE` - Database name
   - `MYSQLPORT` - Port number (usually 3306)
   - `MYSQL_URL` - Full connection URL

   **Important:** These variables are automatically available to your web service if both services are in the same project. Your PHP code already reads them!

## Step 3: Initialize the Database with Tables

You need to run the SQL file to create tables. Here are **3 methods**:

### Method 1: Railway MySQL Console (Easiest) ⭐ RECOMMENDED

1. **Go to your MySQL service**
   - Click on the MySQL service in Railway dashboard

2. **Open the Data/Query tab**
   - Click on the **"Data"** tab (or "Query" tab)
   - Railway provides a SQL editor

3. **Run the SQL script**
   - Copy the entire contents of `attendance_system.sql`
   - Paste it into the SQL editor
   - Click **"Run"** or **"Execute"**

4. **Verify tables were created**
   - You should see tables: `users` and `userss`
   - If you see "Success" or "Query OK", the database is ready!

### Method 2: Using Railway MySQL Connect Feature

1. **Get connection details**
   - Click on your MySQL service
   - Go to **"Connect"** tab
   - Copy the connection details shown there

2. **Use Railway's built-in MySQL client**
   - Railway provides connection strings
   - Use the "Connect" button to open a MySQL console
   - Copy and paste the SQL from `attendance_system.sql`

### Method 3: Using Railway CLI

```bash
# Install Railway CLI
npm install -g @railway/cli

# Login to Railway
railway login

# Link to your project
railway link

# Connect to MySQL
railway connect mysql

# Then run the SQL file
# (You'll need to copy the contents of attendance_system.sql)
mysql -u $MYSQLUSER -p$MYSQLPASSWORD $MYSQLDATABASE
# Then paste the SQL contents
```

## Step 4: Verify Database Connection

1. **Check your application logs**
   - Go to your web service
   - Click on **"Deployments"** tab
   - Click on the latest deployment
   - Check logs for any database connection errors

2. **Test the application**
   - Visit your Railway app URL
   - Try to register/login
   - If it works, the database is connected!

## Common Issues & Solutions

### Issue: "Can't connect to database" or "Access denied"

**Solution:**
1. Make sure MySQL service is running (green status)
2. Check that both services are in the same Railway project
3. Railway automatically shares variables between services in the same project
4. Your PHP code reads `MYSQLHOST`, `MYSQLUSER`, `MYSQLPASSWORD`, `MYSQLDATABASE` automatically

### Issue: "Table doesn't exist" or "Unknown table"

**Solution:**
- The database tables haven't been initialized
- Go back to Step 3 and run the SQL script using Method 1

### Issue: "Connection timeout"

**Solution:**
1. Make sure MySQL service shows "Running" status
2. Wait a few minutes for MySQL to fully start
3. Check Railway's status page if issues persist

### Issue: Variables not found

**Solution:**
1. Railway automatically provides variables, but they're service-specific
2. Make sure both MySQL and Web services are in the same project
3. Variables are automatically shared in the same project
4. You can verify variables exist by going to MySQL service → Variables tab

## What Railway MySQL Provides Automatically

When you add MySQL service, Railway automatically creates:

| Variable | Description | Example Value |
|----------|-------------|---------------|
| `MYSQLHOST` | Database hostname | `containers-us-west-xxx.railway.app` |
| `MYSQLUSER` | Database username | `root` |
| `MYSQLPASSWORD` | Database password | (auto-generated secure password) |
| `MYSQLDATABASE` | Database name | `railway` |
| `MYSQLPORT` | Port number | `3306` |
| `MYSQL_URL` | Full connection URL | `mysql://user:pass@host:3306/dbname` |

**Your PHP code already handles these!** The `config.php` and `dbconnection.php` files automatically read these environment variables.

## Database Schema Summary

The `attendance_system.sql` file creates:

1. **`users` table** - Stores user profiles with:
   - id, profilepic, first_name, last_name, email, bio

2. **`userss` table** - Stores user authentication with:
   - id, username, email, password (hashed), name

After running the SQL, you'll have sample data to test with.

## Next Steps

1. ✅ MySQL service added to Railway
2. ✅ Tables initialized with SQL script
3. ✅ Web service connected to MySQL (automatic)
4. 🎉 Your app should now work!

If you still have issues, check:
- Railway service logs
- Database connection errors in PHP logs
- That MySQL service shows "Running" status

