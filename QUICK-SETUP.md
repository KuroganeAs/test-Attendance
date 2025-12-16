# Quick Setup Guide: MySQL on Railway

## 🎯 What You Need to Do

Follow these steps **exactly** to set up your MySQL database on Railway:

---

## Step 1: Add MySQL Service (2 minutes)

1. **Open Railway Dashboard**
   - Go to https://railway.app
   - Login and open your project

2. **Click the "+ New" button** (usually top-right corner)

3. **Select "Database"** from the dropdown menu

4. **Click "Add MySQL"**
   - Railway will create a MySQL service automatically
   - Wait until you see a green "Running" status (may take 1-2 minutes)

✅ **Done!** You now have MySQL running on Railway.

---

## Step 2: Link MySQL to Your Web Service (Automatic!)

**Good news:** Railway automatically connects services in the same project!

Your PHP code already reads these environment variables that Railway provides:
- `MYSQLHOST` - Database hostname
- `MYSQLUSER` - Database username  
- `MYSQLPASSWORD` - Database password
- `MYSQLDATABASE` - Database name
- `MYSQL_URL` - Full connection URL

✅ **No action needed!** The connection is automatic.

---

## Step 3: Create Database Tables (IMPORTANT!)

This is where you actually create the tables. Choose **ONE** method:

### Method A: Railway SQL Editor (Easiest) ⭐ RECOMMENDED

1. **Click on your MySQL service** in Railway dashboard

2. **Click the "Data" tab** (or "Query" tab)

3. **Open `attendance_system.sql` file** from your project

4. **Copy ALL the contents** of `attendance_system.sql`

5. **Paste into the Railway SQL editor**

6. **Click "Run" or "Execute"**

7. **Verify success:**
   - You should see messages like "Query OK"
   - Check that tables `users` and `userss` exist

✅ **Done!** Your database is now ready!

---

### Method B: Using Railway Connect

1. **Click on your MySQL service**

2. **Click "Connect" tab**

3. **Use the connection details shown** to connect with any MySQL client

4. **Run the SQL from `attendance_system.sql`**

---

## Step 4: Verify Everything Works

1. **Visit your Railway app URL**
   - It should be something like: `https://your-app.railway.app`

2. **Try to register a new user**
   - If registration works, database is connected! ✅
   - If you see database errors, check Step 3

---

## 🐛 Troubleshooting

### "Can't connect to database" Error

**Check:**
1. MySQL service shows "Running" (green) ✅
2. Both services are in the same Railway project ✅
3. Wait 2-3 minutes after creating MySQL (it needs time to start)

### "Table doesn't exist" Error

**Fix:** Go back to Step 3 and run the SQL script!

### "Access denied" Error

**Fix:** 
- Railway automatically provides credentials
- Make sure both services are in the same project
- Variables are shared automatically

---

## 📋 Checklist

Before asking for help, verify:

- [ ] MySQL service added to Railway
- [ ] MySQL service shows "Running" status (green)
- [ ] SQL script (`attendance_system.sql`) has been executed
- [ ] Tables `users` and `userss` exist in database
- [ ] Web service and MySQL service are in the same Railway project

---

## 💡 What Railway Does Automatically

When you add MySQL, Railway creates:

| What | Where to Find |
|------|---------------|
| Database Host | MySQL service → Variables → `MYSQLHOST` |
| Username | MySQL service → Variables → `MYSQLUSER` |
| Password | MySQL service → Variables → `MYSQLPASSWORD` |
| Database Name | MySQL service → Variables → `MYSQLDATABASE` |

**You don't need to manually set these!** Your PHP code (`config.php` and `dbconnection.php`) automatically reads them.

---

## 🎉 You're Done!

After completing Step 3 (creating tables), your application should work!

**Need more help?** Check `RAILWAY-MYSQL-SETUP.md` for detailed troubleshooting.

