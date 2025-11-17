<?php
require_once '../bootstrap.php';

if(isset($argv[1])) {
    try {
        $sql = file_get_contents($argv[1]);
        $conn->exec($sql);

        echo "SQL realizado con éxito";
    } catch (PDOException $e) {
        die("Error de conexión con BD: " . $e->getMessage());
    }
} else {
    echo ("Falta el nombre del archivo sql. ");
}