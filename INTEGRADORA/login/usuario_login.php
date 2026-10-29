<?php
require_once __DIR__ . '/../includes/seguridad.php';
include('conexion.php');

$correo = trim($_POST['txtcorreo'] ?? '');
$pass   = $_POST['txtpassword'] ?? '';

$stmt = mysqli_prepare($conn, "SELECT id_user, nombre_us, password_u, id_rol FROM users WHERE email = ?");
mysqli_stmt_bind_param($stmt, 's', $correo);
mysqli_stmt_execute($stmt);
$usuario = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));

if ($usuario && password_verify($pass, $usuario['password_u'])) {
    session_regenerate_id(true);           // evita fijacion de sesion
    $_SESSION['id_user'] = (int)$usuario['id_user'];
    $_SESSION['nombre']  = $usuario['nombre_us'];
    $_SESSION['id_rol']  = (int)$usuario['id_rol'];

    if (in_array($_SESSION['id_rol'], [1, 2], true)) {
        header('Location: posts_tabla.php');
    } else {
        header('Location: ../Paginas/publicar.php');
    }
    exit;
}

// Mensaje generico: no revela si el correo existe
header('Location: index.html?error=login');
exit;
