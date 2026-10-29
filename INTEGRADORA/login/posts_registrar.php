<?php
include("conexion.php");
include("posts_tabla.php");
$pagina = $_GET['pag'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    <div class="caja_popup2">
        <form method="POST" class="contenedor_popup">
            <table>
                <tr><th colspan="2">Agregar post nuevo</th></tr>
                <tr>
                    <td><b>Nombre: </b></td>
                    <td><input type="text" name="txtnom" autocomplete="off" class="CajaTexto"></td>
                </tr>
                <tr>
                    <td><b>Descripción: </b></td>
                    <td><input type="text" name="txtdes" autocomplete="off" class="CajaTexto"></td>
                </tr>
                <tr>
                    <td><b>Puntuacion: </b></td>
                    <td><input type="number" name="txtpre" autocomplete="off" class="CajaTexto" step="any"></td>
                </tr>
                <tr>
                    <td><b>Seccion: </b></td>
                    <td><select name="txtcat" class="CajaTexto">
                        <?php
                        $qrcategoria = mysqli_query($conn, "SELECT * FROM sections");
                        while ($mostrarcat = mysqli_fetch_array($qrcategoria)) 
                        {
                        echo '<option value= "' . $mostrarcat['id_section'] . '">' . $mostrarcat['Nombre_sec'] . '</option>';
                        }
                        ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <?php echo "<a class = 'BotonesTeam' href=\"posts_tabla.php?pag=$pagina\">Cancelar</a>";?>&nbsp;
                        <input type="submit" class="BotonesTeam" name="btnregistrar" value="Registrar" 
                        onClick="javascript: return confirm('¿Deseas agregar este post?');">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</body>
</html>

<?php
if(isset($_POST['btnregistrar']))
{
    $pronom = $_POST['txtnom'];
    $prodes = $_POST['txtdes'];
    $propun = $_POST['txtpre'];
    $procat = $_POST['txtcat'];

    mysqli_query($conn, "INSERT INTO posts(nombre_of, descripcion, puntuacion, id_section) VALUES('$pronom', '$prodes', '$propun', '$procat')");

    echo "<script> alert('Post registrado con éxito: $pronom'); window.location='posts_tabla.php' </script>";
}