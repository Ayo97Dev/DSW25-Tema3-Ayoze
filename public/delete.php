<?php

require_once '../bootstrap.php';

use Dsw\Blog\DAO\UserDao;

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("El parámetro id es obligatorio y debe ser un número.");
} else {
    $id = $_GET['id'];
}

// Eliminar el usuario
$userDAO = new UserDao($conn);
$userDAO->delete($id);

// Vuelve a mostrar la tabla
header('Location: users.php');
exit();
