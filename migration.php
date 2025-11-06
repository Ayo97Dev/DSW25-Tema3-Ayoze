<?php

include_once 'vendor/autoload.php';
include_once 'public/conexion.php';

if (isset($argv[1])) {
    try {
        $sql = file_get_contents($argv[1]);
        $pdo->exec($sql);
        echo "Tabla 'posts' creada correctamente o ya existía.";
    } catch (Exception $e) {
        die("Error: " . $e->getMessage());
    }
} else {
    echo "Ejecuta este script con un argumento.";
}
// Ejemplo en cmd: php migration.php sql/create_table_post.sql
// Ejemplo en cmd: php migration.php sql/drop_table_post.sql