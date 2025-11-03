<?php

use Dotenv\Dotenv;

require '../vendor/autoload.php';

// Cargar las variables de entorno de .env
$dotenv = Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

$host = $_ENV['DB_HOST'];
$user = $_ENV['DB_USER'];
$pass = $_ENV['DB_PASS'];
$db = $_ENV['DB_NAME'];
$charset = $_ENV['DB_CHARSET'];

// Data Source Name (DSN)
$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

// Crear una instancia de PDO
try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (PDOException $e) {
    echo "<h1>Error de conexión:</h1> ";
    printf("%s", $e->getMessage());
    die();
}

// Obtener el ID del usuario a eliminar desde la URL
if (isset($_GET['id'])) {
    $userId = (int) $_GET['id'];
    // Preparar y ejecutar la consulta de eliminación
    $sql = "DELETE FROM user WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['id' => $userId]);
    // Redirigir de vuelta a la página de selección después de la eliminación
    header('Location: select.php');
    exit;
} else {
    header('Location: select.php');
    exit;
}