<?php
include('conexion.php');
include("msg_tabla.php");

$pagina = $_GET['pag'];
$id = $_GET['msg'];

$querybuscar = mysqli_query($conn, "SELECT * FROM messages WHERE id_message = '$id'");

while($mostrar = mysqli_fetch_array($querybuscar))
{
    $mid = $mostrar['id_message'];
    $mnom = $mostrar['usuario_n'];
    $mcon = $mostrar['contenido'];
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
                <tr><th colspan="2">Modificar mensaje</th></tr>
                <tr>
                    <td>Id</td>
                    <td><input type="text" class="CajaTexto" name="txtid" value="<?php echo $mid;?>" readonly></td>
                </tr>
                <tr>
                    <td>Nombre</td>
                    <td><input type="text" class="CajaTexto" name="txtnombre" value="<?php echo $mnom;?>" required></td>
                </tr>
                <tr>
                    <td>Contenido</td>
                    <td><input type="text" class="CajaTexto" name="txtdes" value="<?php echo $mcon;?>" required></td>
                </tr>
                    <tr>
                        <td colspan="2">
                            <?php echo "<a class='BotonesTeam' href=\"msg_tabla.php?pag=$pagina\">Cancelar</a>";?>&nbsp;
                            <input type="submit" class="BotonesTeam" name="btnmodificar" value="Modificar"
                            onClick="javascript: return confirm('¿Deseas modificar este mensaje?');">
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

    $querymodificar = mysqli_query($conn, "UPDATE messages SET usuario_n='$nombre', contenido='$des' WHERE id_message = '$id'");
    #en la parte de la variable página es a donde se va a dirigir
    echo "<script>window.location= 'msg_tabla.php?pag=$pagina'</script>";
}
?>