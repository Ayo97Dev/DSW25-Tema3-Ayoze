<?php
// Página de prueba. Se debe eliminar de producción. 
require_once '../vendor/autoload.php';

require_once 'conexion.php';


//echo "Conexión correcta";


// Consulta SQL o manipulación del a base de datos.
if (isset($_GET['id'])) {
    // Borrar el id
    $sql = "DELETE FROM user WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['id' => $_GET['id']]);
}

// Vuelve a mostrar la tabla
header('Location: selectall.php');
exit();
