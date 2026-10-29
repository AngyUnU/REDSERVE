<?php
include('conexion.php');
include("barra_lateral.php");
$pagina = get_int('pag', 1);
csrf_check();                      // solo POST con token valido
$id = (int)($_POST['id'] ?? 0);

consulta($conn, "DELETE FROM users WHERE id_user = ?", 'i', $id);
header("Location: user_tabla.php?pag=$pagina");
?>