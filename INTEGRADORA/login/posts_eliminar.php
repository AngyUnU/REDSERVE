<?php
include("conexion.php");
include("barra_lateral.php");
$usuarioingresado = $_SESSION['usuarioingresando'];
$pagina = $_GET['pag'];
$id = $_GET['id'];

mysqli_query($conn, "DELETE FROM posts WHERE id_post='$id'");
header("Location:posts_tabla.php?pag=$pagina");
?>