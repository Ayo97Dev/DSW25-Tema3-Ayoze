<?php
// pagina de prueba

use Dotenv\Dotenv;

require '../vendor/autoload.php';

// Cargar las variables de entorno de .env
$dotenv = Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

echo "<pre>";
print_r($_ENV);
echo "</pre>";

// Asignar las variables de entorno a variables locales
$host = $_ENV['DB_HOST'];
$port = $_ENV['DB_PORT'];
$user = $_ENV['DB_USER'];
$pass = $_ENV['DB_PASS'];
$dbname = $_ENV['DB_NAME'];
$charset = $_ENV['DB_CHARSET'];

printf(
    "Host: %s\nPort: %s\nUser: %s\nPass: %s\nDB Name: %s\nCharset: %s\n",
    $host,$port,$user,$pass,$dbname,$charset
);

