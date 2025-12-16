<?php
// Use environment variables if available (Railway), otherwise use defaults
$db_host = getenv('MYSQL_HOST') ?: getenv('MYSQLHOST') ?: "db";
$db_user = getenv('MYSQL_USER') ?: getenv('MYSQLUSER') ?: "annisa";
$db_pass = getenv('MYSQL_PASSWORD') ?: getenv('MYSQLPASSWORD') ?: "12345";
$db_name = getenv('MYSQL_DATABASE') ?: getenv('MYSQLDATABASE') ?: "attendance_system";

// Railway provides MYSQL_URL, parse it if available
if (getenv('MYSQL_URL') || getenv('DATABASE_URL')) {
    $url = getenv('MYSQL_URL') ?: getenv('DATABASE_URL');
    if (preg_match('/mysql:\/\/([^:]+):([^@]+)@([^:]+):(\d+)\/(.+)/', $url, $matches)) {
        $db_user = $matches[1];
        $db_pass = $matches[2];
        $db_host = $matches[3];
        $db_name = $matches[5];
    }
}

try {
    $db = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_pass);
} catch (PDOException $e) {
    die("Terjadi masalah: " . $e->getMessage());
}
?>
