<?php
session_start();
include('conexion.php');

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrador</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="BarraLateral">
        <ul>
            <li><a href="posts_tabla.php">Posts</a></li>
            <li><a href="categoria_tabla.php">Categorias</a></li>
            <li><a href="user_tabla.php">Usuarios</a></li>
            <li><a href="msg_tabla.php">Mensajes</a></li>
            <li><a href="bt_tabla.php">Bitacora</a></li>
            <li><a href="cerrar_sesion.php">Cerrar Sesión</a></li>
        </ul>
    </div>
</body>
</html>