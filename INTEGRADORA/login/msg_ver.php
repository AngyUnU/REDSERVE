<?php
include('conexion.php');
include('categoria_tabla.php');
$pagina = get_int('pag', 1);
$id = get_int('msg');

$querybuscar = consulta($conn, "SELECT * FROM messages WHERE id_message = ?", 'i', $id);

$mid = $mnom = $mcon = $mf = '';
while($mostrar = mysqli_fetch_array($querybuscar))
{
    $mid = $mostrar['id_message'];
    $mnom = $mostrar['usuario_n'];
    $mcon = $mostrar['contenido'];
    $mf = $mostrar['feha'];
}
?>
<html>
<body>
    <div class="caja_popup2">
        <form class="contenedor_popup" method = "POST">
            <table>
                <tr><th colspan="2">Ver mensaje</th></tr>
                <tr>
                    <td><b>Id:</b></td>
                    <td><?php echo $mid ?></td>
                </tr>

                <tr>
                    <td><b>Nombre:</b></td>
                    <td><?php echo $mnom ?></td>
                </tr>

                <tr>
                    <td><b>Contenido:</b></td>
                    <td><?php echo $mcon ?></td>
                </tr>

                <tr>
                    <td><b>Fecha:</b></td>
                    <td><?php echo $mf ?></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <?php echo "<a class='BotonesTeam' href=\"msg_tabla.php?pag=$pagina\">Regresar</a>";?>
                    </td>
                </tr>
            </table>
        </form>
    </div>
</body>
</html>