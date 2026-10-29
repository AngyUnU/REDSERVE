<?php
include('conexion.php');
include('categoria_tabla.php');
$pagina = $_GET['pag'];
$id = $_GET['categoria'];

$querybuscar = mysqli_query($conn,"SELECT * FROM sections WHERE id_section = '$id'");

while($mostrar = mysqli_fetch_array($querybuscar))
{
    $catid = $mostrar['id_section'];
    $catnom = $mostrar['Nombre_sec'];
    $catdes = $mostrar['Description'];
}
?>
<html>
<body>
    <div class="caja_popup2">
        <form class="contenedor_popup" method = "POST">
            <table>
                <tr><th colspan="2">Ver categoría</th></tr>
                <tr>
                    <td><b>Id:</b></td>
                    <td><?php echo $catid ?></td>
                </tr>

                <tr>
                    <td><b>Nombre:</b></td>
                    <td><?php echo $catnom ?></td>
                </tr>

                <tr>
                    <td><b>Descripcion:</b></td>
                    <td><?php echo $catdes ?></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <?php echo "<a class='BotonesTeam' href=\"categoria_tabla.php?pag=$pagina\">Regresar</a>";?>
                    </td>
                </tr>
            </table>
        </form>
    </div>
</body>
</html>