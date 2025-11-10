<?php

use Dsw\Blog\Database;
require_once '../vendor/autoload.php';

try {
    $conn = Database::getConnection();
} catch (Exception $e) {
    die("Error de conexión: " . $e->getMessage());
}

