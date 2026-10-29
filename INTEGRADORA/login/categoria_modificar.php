<?php
include('conexion.php');
include("categoria_tabla.php");

$pagina = $_GET['pag'];
$id = $_GET['categoria'];

$querybuscar = mysqli_query($conn, "SELECT * FROM sections WHERE id_section = '$id'");

while($mostrar = mysqli_fetch_array($querybuscar))
{
    $catid = $mostrar['id_section'];
    $catnom = $mostrar['Nombre_sec'];
    $catdes = $mostrar['Description'];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modificar</title>
</head>
<body>
    <div class="caja_popup2">
        <form class="contenedor_popup" method="POST">
            <table>
                <tr><th colspan="2">Modificar categoría</th></tr>
                <tr>
                    <td>Id</td>
                    <td><input type="text" class="CajaTexto" name="txtid" value="<?php echo $catid;?>" readonly></td>
                </tr>
                <tr>
                    <td>Nombre</td>
                    <td><input type="text" class="CajaTexto" name="txtnombre" value="<?php echo $catnom;?>" required></td>
                </tr>
                <tr>
                    <td>Descripcion</td>
                    <td><input type="text" class="CajaTexto" name="txtdes" value="<?php echo $catdes;?>" required></td>
                </tr>
                    <tr>
                        <td colspan="2">
                            <?php echo "<a class='BotonesTeam' href=\"categoria_tabla.php?pag=$pagina\">Cancelar</a>";?>&nbsp;
                            <input type="submit" class="BotonesTeam" name="btnmodificar" value="Modificar"
                            onClick="javascript: return confirm('¿Deseas modificar esta categoría?');">
                        </td>
                    </tr>
            </table>
        </form>
    </div>
</body>
</html>

<?php
if(isset($_POST['btnmodificar']))
{
    $id = $_POST['txtid'];
    $nombre = $_POST['txtnombre'];
    $des = $_POST['txtdes'];

    $querymodificar = mysqli_query($conn, "UPDATE sections SET Nombre_sec='$nombre', Description='$des' WHERE id_section = '$id'");
    #en la parte de la variable página es a donde se va a dirigir
    echo "<script>window.location= 'categoria_tabla.php?pag=$pagina'</script>";
}
?>