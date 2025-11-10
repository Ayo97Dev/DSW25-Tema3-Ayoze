<?php

require_once '../bootstrap.php';

use Dsw\Blog\DAO\UserDao;

$userDAO = new UserDao($conn);
$users = $userDAO->getAll();

echo "<pre>";
print_r($users);
echo "</pre>";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Lista usuarios</h1>
    <table>
        <thead>
                <th>ID</th>
                <th>Nombre</th>
                <th>Email</th>
                <th>Fecha Registro</th>
        </thead>
        <tbody>
            <?php foreach ($users as $user): ?>
                <tr>
                    <td><?php echo "<a href='user.php?id={$user->getId()}'>{$user->getId()}</a>"; ?></td>
                    <td><?php echo $user->getName(); ?></td>
                    <td><?php echo $user->getEmail(); ?></td>
                    <td><?php echo $user->getCreatedAt()->format('Y-m-d'); ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <p><a href="create.php">Crear nuevo usuario</a></p>
</body>
</html>