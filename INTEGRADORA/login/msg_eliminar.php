<?php
include('conexion.php');
include("barra_lateral.php");
$usuarioingresado = $_SESSION['usuarioingresando'];
$pagina = $_GET['pag'];
$id = $_GET['msg'];

mysqli_query($conn, "DELETE FROM messages WHERE id_message='$id'");
header("Location: msg_tabla.php?pag=$pagina");
?>