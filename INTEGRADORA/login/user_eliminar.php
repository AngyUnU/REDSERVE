<?php
include('conexion.php');
include("barra_lateral.php");
$usuarioingresado = $_SESSION['usuarioingresando'];
$pagina = $_GET['pag'];
$id = $_GET['user'];

mysqli_query($conn, "DELETE FROM users WHERE id_user='$id'");
header("Location: user_tabla.php?pag=$pagina");
?>