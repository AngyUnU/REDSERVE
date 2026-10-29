<?php
include('conexion.php');
include('categoria_tabla.php');
$pagina = $_GET['pag'];
$id = $_GET['msg'];

$querybuscar = mysqli_query($conn,"SELECT * FROM messages WHERE id_message = '$id'");

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