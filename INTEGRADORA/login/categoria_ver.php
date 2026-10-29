<?php
include('conexion.php');
include('categoria_tabla.php');
$pagina = get_int('pag', 1);
$id = get_int('categoria');

$querybuscar = consulta($conn, "SELECT * FROM sections WHERE id_section = ?", 'i', $id);

$catid = $catnom = $catdes = '';
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