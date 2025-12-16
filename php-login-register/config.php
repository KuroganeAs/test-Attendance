<?php
// Use environment variables if available (Railway), otherwise use defaults
$host = getenv('MYSQL_HOST') ?: getenv('MYSQLHOST') ?: "db";
$dbname = getenv('MYSQL_DATABASE') ?: getenv('MYSQLDATABASE') ?: "attendance_system";
$user = getenv('MYSQL_USER') ?: getenv('MYSQLUSER') ?: "annisa";
$pass = getenv('MYSQL_PASSWORD') ?: getenv('MYSQLPASSWORD') ?: "12345";

// Railway provides MYSQL_URL, parse it if available
if (getenv('MYSQL_URL') || getenv('DATABASE_URL')) {
    $url = getenv('MYSQL_URL') ?: getenv('DATABASE_URL');
    // Parse MySQL URL: mysql://user:pass@host:port/dbname
    if (preg_match('/mysql:\/\/([^:]+):([^@]+)@([^:]+):(\d+)\/(.+)/', $url, $matches)) {
        $user = $matches[1];
        $pass = $matches[2];
        $host = $matches[3];
        $dbname = $matches[5];
    }
}

try {
    $db = new PDO(
        "mysql:host=$host;dbname=$dbname;charset=utf8",
        $user,
        $pass
    );
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("DB Connection failed: " . $e->getMessage());
}
?>