<?php
include("conexion.php");
include("user_tabla.php");
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
                <tr><th colspan="2">Agregar usuario nuevo</th></tr>
                <tr>
                    <td><b>Nombre: </b></td>
                    <td><input type="text" name="txtnom" autocomplete="off" class="CajaTexto"></td>
                </tr>
                <tr>
                    <td><b>Email: </b></td>
                    <td><input type="email" name="txtemail" autocomplete="off" class="CajaTexto"></td>
                </tr>
                <tr>
                    <td><b>Password: </b></td>
                    <td><input type="text" name="txtpass" autocomplete="off" class="CajaTexto" step="any"></td>
                </tr>
                <tr>
                    <td><b>Rol: </b></td>
                    <td><select name="txtrol" class="CajaTexto">
                        <?php
                        $qrcategoria = mysqli_query($conn, "SELECT * FROM roles");
                        while ($mostrarcat = mysqli_fetch_array($qrcategoria)) 
                        {
                        echo '<option value= "' . $mostrarcat['id_rol'] . '">' . $mostrarcat['Rol'] . '</option>';
                        }
                        ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <?php echo "<a class = 'BotonesTeam' href=\"user_tabla.php?pag=$pagina\">Cancelar</a>";?>&nbsp;
                        <input type="submit" class="BotonesTeam" name="btnregistrar" value="Registrar" 
                        onClick="javascript: return confirm('¿Deseas agregar a este usuario?');">
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
    $usnom = $_POST['txtnom'];
    $usemail = $_POST['txtemail'];
    $uspass = $_POST['txtpass'];
    $usrol = $_POST['txtrol'];

    $pass_fuerte = password_hash($uspass,PASSWORD_BCRYPT);
    mysqli_query($conn, "INSERT INTO users(nombre_us, email, password_u, id_rol) VALUES('$usnom', '$usemail', '$pass_fuerte', '$usrol')");

    echo "<script> alert('Usuario registrado con éxito: $pronom'); window.location='user_tabla.php' </script>";
}