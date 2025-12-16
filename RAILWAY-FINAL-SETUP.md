# Final Railway Setup - Fix "executable cd not found"

## The Problem
Railway's start command doesn't support `cd` directly. We need to either:
1. Set Root Directory in Railway (BEST SOLUTION)
2. Use a shell script

## Solution: Set Root Directory in Railway Dashboard

### Step 1: Set Root Directory (REQUIRED)

1. **Go to Railway Dashboard**
2. **Click on your web service**
3. **Go to "Settings" tab**
4. **Scroll to "Build & Deploy" section**
5. **Find "Root Directory" or "Source Directory"**
6. **Set it to:** `php-login-register`
7. **Save changes**

### Step 2: Update Start Command

After setting root directory, the start command should be simpler:

1. **In Settings → Deploy → Start Command**
2. **Set to:** `php -S 0.0.0.0:${PORT}`
3. **Save and redeploy**

## Alternative: If Root Directory Setting Doesn't Exist

If Railway doesn't have a root directory setting, the `start.sh` script should work:

1. Make sure `start.sh` is in your repository root
2. Commit and push it
3. Railway will use `sh start.sh` from the config

## After This Works

Once your app starts successfully:

1. **Add MySQL service:**
   - Click "+ New" → Database → Add MySQL
   - Wait for "Running" status

2. **Initialize database:**
   - MySQL service → "Data" tab
   - Copy/paste `attendance_system.sql` and run it

3. **Test your app!**

## Current Configuration

- ✅ `railway.json` - configured to use `sh start.sh`
- ✅ `start.sh` - shell script that changes directory and starts PHP
- ✅ `Procfile` - backup method Railway might auto-detect
- ✅ `composer.json` - tells Railway this is a PHP project

The key is setting the **Root Directory** in Railway dashboard to `php-login-register`!

