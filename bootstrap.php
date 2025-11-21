<?php
session_start();

use Dsw\Blog\DAO\UserDAO;
use Dsw\Blog\Database;
use Dsw\Blog\Models\User;

require_once '../vendor/autoload.php';

try {
    $conn = Database::getConnection();
} catch (Exception $e) {
    die('Error de conexión con BD: ' . $e->getMessage());
}

$user = null;
if (isset($_SESSION['user_id'])) {
    $userDAO = new UserDAO($conn);
    $user = $userDAO->get($_SESSION['user_id']);
}

// Control de acceso según el nivel. Por defecto el nivel mínimo es 'user'.
function accessControl(?User $user, string $level = 'user') {
    // Si no hay usuario se deniega el acceso.
    if ($user) {
        // Si hay usuario se comprueba si el nivel es 'admin' para comprobar si el usuario es administrador.
        if ($level === 'admin') {
            $access = $user->isAdmin();
        } else {
            // Si el nivel es 'user' y hay un usuario (user o admin), puede acceder.
            $access = true;
        }
    } else {
        $access = false;
    }

    // Si el acceso es denegado se envía a prohibido.php
    if (!$access) {
        header('Location: prohibido.php');
        exit();
    }

    // Si el acceso es permitido se seguirá ejecutando después de la función.
}