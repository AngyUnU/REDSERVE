<?php
include('conexion.php');
include("barra_lateral.php");
$usuarioingresado = $_SESSION['usuarioingresando'];
$pagina = $_GET['pag'];
$id = $_GET['categoria'];

mysqli_query($conn, "DELETE FROM sections WHERE id_section='$id'");
header("Location: categoria_tabla.php?pag=$pagina");
?>