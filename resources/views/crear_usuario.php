<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Crear Usuario</title>
</head>
<body>
    <h1>Crear Usuario</h1>
    <form action="/usuarios/guardar" method="POST">
        <label>Nombre:</label>
        <input type="text" name="nombre" required>
        <label>Apellido Paterno:</label>
        <input type="text" name="ap_paterno" required>
        <label>Apellido Materno:</label>
        <input type="text" name="ap_materno">
        <label>Rol:</label>
        <input type="text" name="rol" required>
        <label>Email:</label>
        <input type="email" name="email" required>
        <label>Contraseña:</label>
        <input type="password" name="password" required>
        <button type="submit">Guardar</button>
    </form>
</body>
</html>
