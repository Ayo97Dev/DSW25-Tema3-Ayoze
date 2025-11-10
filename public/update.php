<?php

use Dsw\Blog\DAO\UserDao;

require_once '../vendor/autoload.php';

require_once '../bootstrap.php';
if (isset($_POST['id'], $_POST['name'], $_POST['email'])) {
    $userDao = new UserDao($conn);
    // Obtener el usuario
    $user = $userDao->get($_POST['id']);

    if ($user) {
        // Actualizar el usuario
        $user->setName($_POST['name']);
        $user->setEmail($_POST['email']);
        // Guardar los cambios
        $userDao->update($user);
    }
} else {
    // Manejar el error si los datos no están completos
    die("Faltan datos para actualizar el usuario.");
}


header('Location: users.php');
exit();