# MySQL Setup on Railway - Step by Step

## 🎯 The Problem
Your app works on Railway, but the database can't be accessed because:
1. MySQL service might not be added yet, OR
2. The database tables haven't been created

## ✅ The Solution (3 Simple Steps)

### STEP 1: Add MySQL Service (2 minutes)

1. **Go to Railway Dashboard**: https://railway.app
2. **Open your project**
3. **Click "+ New"** (top-right corner)
4. **Select "Database" → "Add MySQL"**
5. **Wait for it to start** (green "Running" status)

**What Railway Does:**
- Creates a MySQL database
- Generates secure credentials automatically
- Makes variables available to your web service automatically

---

### STEP 2: Create Tables (5 minutes) ⭐ MOST IMPORTANT

You need to run your SQL file to create the tables. Here's how:

**Option A: Railway SQL Editor (Easiest)**

1. **Click on your MySQL service** in Railway dashboard
2. **Click "Data" tab** (some Railway versions call it "Query")
3. **Open `attendance_system.sql`** from your computer
4. **Copy ALL the text** from the file
5. **Paste it into the Railway SQL editor**
6. **Click "Run" or "Execute"**
7. **You should see "Query OK" messages**

✅ Done! Your tables are now created.

**Option B: Railway Connect (Alternative)**

1. Click MySQL service → "Connect" tab
2. Use the connection details with any MySQL client
3. Run the SQL file

---

### STEP 3: Test Your App

1. **Go to your Railway app URL** (e.g., `https://your-app.railway.app`)
2. **Try to register/login**
3. **If it works → Success! ✅**
4. **If you see database errors → Go back to Step 2**

---

## 🔍 What Railway Provides Automatically

When you add MySQL, Railway creates these environment variables:

```
MYSQLHOST = containers-us-west-xxx.railway.app
MYSQLUSER = root
MYSQLPASSWORD = [auto-generated secure password]
MYSQLDATABASE = railway
MYSQLPORT = 3306
MYSQL_URL = mysql://user:pass@host:3306/dbname
```

**Your PHP code already reads these!** 

Check your `config.php` and `dbconnection.php` - they already have code to read `MYSQLHOST`, `MYSQLUSER`, `MYSQLPASSWORD`, and `MYSQLDATABASE`.

**You don't need to manually set these variables!** Railway automatically shares them between services in the same project.

---

## ❓ Common Questions

### Q: Do I need to manually set environment variables?
**A:** No! Railway automatically shares MySQL variables with your web service.

### Q: What if I see "Can't connect to database"?
**A:** 
- Make sure MySQL service shows "Running" (green)
- Wait 2-3 minutes after creating MySQL (it needs time to start)
- Both services must be in the same Railway project

### Q: What if I see "Table doesn't exist"?
**A:** You haven't run the SQL script yet! Go to Step 2.

### Q: Where do I find the MySQL credentials?
**A:** Click MySQL service → "Variables" tab. But you don't need to copy them - Railway shares them automatically!

### Q: Can I use a different database name?
**A:** Railway creates a database called "railway" by default. Your code reads `MYSQLDATABASE` which Railway provides. You can change it in Railway if needed, but the default works fine.

---

## 📋 Quick Checklist

Before you finish, verify:

- [ ] MySQL service added to Railway
- [ ] MySQL service shows "Running" (green dot)
- [ ] Opened "Data" tab in MySQL service
- [ ] Copied contents of `attendance_system.sql`
- [ ] Pasted and executed SQL in Railway
- [ ] Saw "Query OK" or success messages
- [ ] Tested your app - registration/login works

---

## 🆘 Still Having Issues?

1. **Check Railway logs:**
   - Web service → Deployments → Latest deployment → View logs
   - Look for database connection errors

2. **Verify MySQL is running:**
   - MySQL service should show green "Running" status

3. **Check tables exist:**
   - MySQL service → Data tab
   - You should see `users` and `userss` tables listed

4. **Verify environment variables:**
   - MySQL service → Variables tab
   - Should see: MYSQLHOST, MYSQLUSER, MYSQLPASSWORD, MYSQLDATABASE

---

## 📚 More Help

- **Detailed guide:** See `RAILWAY-MYSQL-SETUP.md`
- **Quick reference:** See `QUICK-SETUP.md`
- **Railway docs:** https://docs.railway.app/databases/mysql

---

## 🎉 Success!

Once Step 2 is complete (tables created), your application will work!

The most common issue is forgetting Step 2 - **you MUST run the SQL script to create the tables!**

