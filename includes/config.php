<?php 
// DB credentials.
//define('DB_HOST','localhost');
//define('DB_USER','root');
//define('DB_PASS','');
//define('DB_NAME','ems');
// Establish database connection.
//try
//{
//$dbh = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME,DB_USER, DB_PASS,array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
//}
//catch (PDOException $e)
//{
//exit("Error: " . $e->getMessage());
//}
?>

<?php
$host = "eventraze-db-do-user-18780292-0.d.db.ondigitalocean.com"; // From DigitalOcean
$dbname = "ems";
$username = "doadmin";
$password = "AVNS_82Lx5oEBtiIhnq1K_UQ";
$port = 25060; // Use DigitalOcean’s provided port

try {
    $pdo = new PDO("mysql:host=$host;port=$port;dbname=$dbname;charset=utf8mb4", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}
?>

