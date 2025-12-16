<?php
/**
 * Database Initialization Script for Railway
 * 
 * This script helps initialize your MySQL database on Railway.
 * It reads the SQL file and executes it to create tables.
 * 
 * Usage:
 * 1. Deploy this file to Railway (it's already in your repo)
 * 2. Visit: https://your-app.railway.app/init-database.php
 * 3. The script will create all necessary tables
 * 4. DELETE this file after use for security!
 */

// Get database connection details from environment variables (Railway)
$host = getenv('MYSQL_HOST') ?: getenv('MYSQLHOST') ?: "localhost";
$dbname = getenv('MYSQL_DATABASE') ?: getenv('MYSQLDATABASE') ?: "attendance_system";
$user = getenv('MYSQL_USER') ?: getenv('MYSQLUSER') ?: "root";
$pass = getenv('MYSQL_PASSWORD') ?: getenv('MYSQLPASSWORD') ?: "";

// Railway provides MYSQL_URL, parse it if available
if (getenv('MYSQL_URL') || getenv('DATABASE_URL')) {
    $url = getenv('MYSQL_URL') ?: getenv('DATABASE_URL');
    if (preg_match('/mysql:\/\/([^:]+):([^@]+)@([^:]+):(\d+)\/(.+)/', $url, $matches)) {
        $user = $matches[1];
        $pass = $matches[2];
        $host = $matches[3];
        $dbname = $matches[5];
    }
}

$port = getenv('MYSQLPORT') ?: '3306';

// Security: Only allow this in development/initialization
// In production, comment out the line below or add IP restrictions
// $allowed = getenv('ALLOW_DB_INIT') === 'true';
// if (!$allowed) {
//     die("Database initialization is disabled. Set ALLOW_DB_INIT=true to enable.");
// }

?>
<!DOCTYPE html>
<html>
<head>
    <title>Database Initialization - Railway</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 800px;
            margin: 50px auto;
            padding: 20px;
            background: #f5f5f5;
        }
        .container {
            background: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        h1 { color: #333; }
        .success { color: #28a745; padding: 10px; background: #d4edda; border-radius: 4px; margin: 10px 0; }
        .error { color: #dc3545; padding: 10px; background: #f8d7da; border-radius: 4px; margin: 10px 0; }
        .info { color: #0c5460; padding: 10px; background: #d1ecf1; border-radius: 4px; margin: 10px 0; }
        .warning { color: #856404; padding: 10px; background: #fff3cd; border-radius: 4px; margin: 10px 0; }
        code { background: #f4f4f4; padding: 2px 6px; border-radius: 3px; }
        pre { background: #f4f4f4; padding: 15px; border-radius: 4px; overflow-x: auto; }
    </style>
</head>
<body>
    <div class="container">
        <h1>🚂 Railway Database Initialization</h1>
        
        <?php
        echo "<div class='info'>";
        echo "<strong>Connection Details:</strong><br>";
        echo "Host: <code>$host</code><br>";
        echo "Database: <code>$dbname</code><br>";
        echo "User: <code>$user</code><br>";
        echo "Port: <code>$port</code><br>";
        echo "</div>";

        // Try to connect
        try {
            // First, connect without specifying database to create it if needed
            $pdo = new PDO(
                "mysql:host=$host;port=$port;charset=utf8",
                $user,
                $pass
            );
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            echo "<div class='success'>✓ Successfully connected to MySQL server</div>";
            
            // Create database if it doesn't exist
            try {
                $pdo->exec("CREATE DATABASE IF NOT EXISTS `$dbname`");
                echo "<div class='success'>✓ Database '$dbname' exists or created</div>";
            } catch (PDOException $e) {
                echo "<div class='error'>⚠ Could not create database: " . $e->getMessage() . "</div>";
            }
            
            // Now connect to the specific database
            $pdo = new PDO(
                "mysql:host=$host;port=$port;dbname=$dbname;charset=utf8",
                $user,
                $pass
            );
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            echo "<div class='success'>✓ Connected to database '$dbname'</div>";
            
            // Read SQL file
            $sqlFile = __DIR__ . '/attendance_system.sql';
            if (!file_exists($sqlFile)) {
                echo "<div class='error'>✗ SQL file not found at: $sqlFile</div>";
                echo "<div class='info'>Make sure attendance_system.sql is in the project root directory.</div>";
                exit;
            }
            
            $sql = file_get_contents($sqlFile);
            
            if (empty($sql)) {
                echo "<div class='error'>✗ SQL file is empty</div>";
                exit;
            }
            
            echo "<div class='info'>📄 Reading SQL file: attendance_system.sql</div>";
            
            // Split SQL into individual statements
            // Remove comments and split by semicolons
            $sql = preg_replace('/--.*$/m', '', $sql);
            $sql = preg_replace('/\/\*.*?\*\//s', '', $sql);
            $statements = array_filter(array_map('trim', explode(';', $sql)));
            
            $successCount = 0;
            $errorCount = 0;
            $errors = [];
            
            echo "<div class='info'>🔄 Executing SQL statements...</div>";
            
            // Execute each statement
            foreach ($statements as $statement) {
                if (empty($statement)) continue;
                
                try {
                    $pdo->exec($statement);
                    $successCount++;
                } catch (PDOException $e) {
                    $errorCount++;
                    // Ignore "table already exists" errors
                    if (strpos($e->getMessage(), 'already exists') === false && 
                        strpos($e->getMessage(), 'Duplicate') === false) {
                        $errors[] = $e->getMessage();
                    }
                }
            }
            
            echo "<div class='success'>✓ Executed $successCount SQL statements successfully</div>";
            
            if ($errorCount > 0) {
                echo "<div class='warning'>⚠ $errorCount statements had errors (may be expected if tables already exist)</div>";
                if (!empty($errors)) {
                    echo "<pre>" . implode("\n", array_unique($errors)) . "</pre>";
                }
            }
            
            // Verify tables were created
            echo "<div class='info'>🔍 Verifying tables...</div>";
            $tables = $pdo->query("SHOW TABLES")->fetchAll(PDO::FETCH_COLUMN);
            
            if (empty($tables)) {
                echo "<div class='error'>✗ No tables found in database</div>";
            } else {
                echo "<div class='success'>✓ Found " . count($tables) . " table(s):</div>";
                echo "<ul>";
                foreach ($tables as $table) {
                    // Get row count
                    $stmt = $pdo->query("SELECT COUNT(*) FROM `$table`");
                    $count = $stmt->fetchColumn();
                    echo "<li><strong>$table</strong> - $count row(s)</li>";
                }
                echo "</ul>";
            }
            
            echo "<div class='success' style='margin-top: 20px; padding: 20px;'>";
            echo "<h2>✅ Database Initialization Complete!</h2>";
            echo "<p>Your database has been set up successfully. You can now use your application.</p>";
            echo "<p><strong>⚠️ SECURITY WARNING:</strong> Please delete this file (init-database.php) from your repository after initialization for security reasons!</p>";
            echo "</div>";
            
        } catch (PDOException $e) {
            echo "<div class='error'>";
            echo "<h2>✗ Database Connection Failed</h2>";
            echo "<p><strong>Error:</strong> " . $e->getMessage() . "</p>";
            echo "<h3>Common Solutions:</h3>";
            echo "<ul>";
            echo "<li>Make sure MySQL service is running in Railway</li>";
            echo "<li>Check that environment variables are set correctly</li>";
            echo "<li>Verify both MySQL and Web services are in the same Railway project</li>";
            echo "<li>Wait a few minutes if MySQL service was just created (it needs time to start)</li>";
            echo "</ul>";
            echo "<h3>Current Environment Variables:</h3>";
            echo "<pre>";
            echo "MYSQLHOST: " . (getenv('MYSQLHOST') ?: 'NOT SET') . "\n";
            echo "MYSQLUSER: " . (getenv('MYSQLUSER') ?: 'NOT SET') . "\n";
            echo "MYSQLPASSWORD: " . (getenv('MYSQLPASSWORD') ? '***SET***' : 'NOT SET') . "\n";
            echo "MYSQLDATABASE: " . (getenv('MYSQLDATABASE') ?: 'NOT SET') . "\n";
            echo "MYSQL_URL: " . (getenv('MYSQL_URL') ? '***SET***' : 'NOT SET') . "\n";
            echo "</pre>";
            echo "</div>";
        }
        ?>
    </div>
</body>
</html>

