<?php
include("conexion.php");
include("posts_tabla.php");
$pagina = get_int('pag', 1);
$id = get_int('id');

$querybuscar = consulta($conn, "SELECT p.id_post, p.Nombre_of, p.descripcion, p.puntuacion, s.Nombre_sec FROM posts p JOIN sections s ON p.id_section = s.id_section WHERE p.id_post = ?", 'i', $id);



$proid = $pronom = $prodes = $propun = $procat = '';
while($mostrar = mysqli_fetch_array($querybuscar))
{
    $proid = $mostrar['id_post'];
    $pronom = $mostrar['Nombre_of'];
    $prodes = $mostrar['descripcion'];
    $propun = $mostrar['puntuacion'];
    $procat = $mostrar['Nombre_sec'];
}
?>


<html>
<body>
    <div class="caja_popup2">
        <form class="contenedor_popup" method="POSt">
            <table>
                <tr><th colspan="2">Ver post</th></tr>
                <tr>
                    <td><b>Id:</b></td>
                    <td><?php echo $proid;?></td>
                </tr>
                <tr>
                    <td><b>Nombre:</b></td>
                    <td><?php echo $pronom;?></td>
                </tr>
                <tr>
                    <td><b>Descripción:</b></td>
                    <td><?php echo $prodes;?></td>
                </tr>
                <tr>
                    <td><b>Puntuacion:</b></td>
                    <td><?php echo $propun;?></td>
                </tr>
                <tr>
                    <td><b>Seccion:</b></td>
                    <td><?php echo $procat;?></td>
                </tr>

                <tr>
                    <td colspan="2">
                        <?php echo "<a class='BotonesTeam' href=\"posts_tabla.php?pag=$pagina\">Regresar</a>";?>
                    </td>
                </tr>
            </table>
        </form>
    </div>
</body>
</html>