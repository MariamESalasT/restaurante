<?php
require_once __DIR__ . '/../../../../vendor/autoload.php';

use App\Models\Usuario;

$usuarios = Usuario::all();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Usuarios</title>
</head>
<body>
    <h1>Lista de Usuarios</h1>
    <a href="crear.php">Crear Usuario</a>
    <table >
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Email</th>
            <th>Rol</th>
            <th>Acciones</th>
        </tr>
        <?php foreach ($usuarios as $usuario): ?>
        <tr>
            <td><?= $usuario->id ?></td>
            <td><?= $usuario->nombre ?> <?= $usuario->ap_paterno ?></td>
            <td><?= $usuario->email ?></td>
            <td><?= $usuario->rol ?></td>
            <td>
                <a href="detalle.php?id=<?= $usuario->id ?>">Ver</a>
                <a href="editar.php?id=<?= $usuario->id ?>">Editar</a>
                <a href="eliminar.php?id=<?= $usuario->id ?>">Eliminar</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
