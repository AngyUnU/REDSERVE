<?php
include('conexion.php');
include("barra_lateral.php");
$pagina = get_int('pag', 1);
csrf_check();                      // solo POST con token valido
$id = (int)($_POST['id'] ?? 0);

consulta($conn, "DELETE FROM messages WHERE id_message = ?", 'i', $id);
header("Location: msg_tabla.php?pag=$pagina");
?>