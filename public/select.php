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

//echo "Conexión exitosa a la base de datos '$db' en el host '$host'.\n";


// Consulta SQL o manipulación de la base de datos
$sql = "SELECT * FROM user";
$stmt = $pdo->query($sql);
$usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);
echo "<pre>";
print_r($usuarios);
echo "</pre>";

// Consulta preparada (Por ID)
$userId = 3;
$sql = "SELECT id, name, email FROM user WHERE id = :id";
$stmt = $pdo->prepare($sql);
$stmt->execute(['id' => $userId]);
$usuario = $stmt->fetch();
echo "<pre>";
print_r($usuario);
echo "</pre>";
printf('<p>ID: %s</p>', $usuario['id']);
printf('<p>Name: %s</p>', $usuario['name']);
printf('<p>Email: %s</p>', $usuario['email']);

// Consulta preparada (Todos los usuarios)
$sql = "SELECT id, name, email FROM user";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$usuarios = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        tr,
        th,
        td {
            border: 1px solid black;
            padding: 5px;
        }
        table {
            border-collapse: collapse;
        }
    </style>
</head>

<body>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Email</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>

<?php
foreach ($usuarios as $usuario) {
    printf("
            <tr>
                <td>%s</td>
                <td>%s</td>
                <td>%s</td>
                <td><a href='delete.php?id=%s'>Eliminar</a></td>
            </tr>
    ", $usuario['id'], $usuario['name'], $usuario['email'], $usuario['id']);
}
?>
        </tbody>
    </table>
</body>

</html>

<?


// Desconexión
$pdo = null;
$stmt = null;
