<?php
require_once '../vendor/autoload.php';

use Dsw\Blog\DAO\UserDao;
use Dsw\Blog\Database;


if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("El parámetro id es obligatorio y debe ser un número.");
} else {
    $id = $_GET['id'];
}

try {
    $conn = Database::getConnection();
} catch (Exception $e) {
    die("Error de conexión: " . $e->getMessage());
}

$userDAO = new UserDao($conn);
$user = $userDAO->get($id);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

    <?php
    if ($user) {
        printf("%d: %s - %s - %s", $user->getId(), $user->getName(), $user->getEmail(), $user->getCreatedAt()->format('d/m/Y'));
        echo "<br>";
        printf("<a href='delete.php?id=%d'>Borrar</a>", $user->getId());
        printf("<a href='edit.php?id=%d'>Editar</a>", $user->getId());


    } else {
        echo "Usuario no encontrado.";
    }
    ?>
</body>

</html>