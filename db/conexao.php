
<?php
$host = 'localhost';
$port = '5432'; 
$dbname = 'cinema';
$user = 'postgres';
$password = 'postgres';

$dsn = "pgsql:host=$host;port=$port;dbname=$dbname";

try {

    $pdo = new PDO($dsn, $user, $password, [
        PDO::ATTR_TIMEOUT => 3, 
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]);

} catch (PDOException $e) {
    die('Erro de conexão: ' . $e->getMessage()); 
}
?>
