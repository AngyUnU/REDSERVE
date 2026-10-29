<?php
include('conexion.php');
include('user_tabla.php');
$pagina = $_GET['pag'];
$id = $_GET['user'];


$querybuscar = mysqli_query($conn, "SELECT u.id_user,u.nombre_us,u.email,u.password_u, r.Rol from 
users u, roles r WHERE u.id_rol=r.id_rol and u.id_user = '$id'");


while($mostrar = mysqli_fetch_array($querybuscar))
{
    $usid = $mostrar['id_user'];
    $usnom = $mostrar['nombre_us'];
    $usemail = $mostrar['email'];
    $uspass = $mostrar['password_u'];
    $usrol = $mostrar['Rol'];
}
?>
<html>
<body>
    <div class="caja_popup2">
        <form class="contenedor_popup" method = "POST">
            <table>
                <tr><th colspan="2">Ver usuario</th></tr>
                <tr>
                    <td><b>Id:</b></td>
                    <td><?php echo $usid ?></td>
                </tr>

                <tr>
                    <td><b>Nombre:</b></td>
                    <td><?php echo $usnom ?></td>
                </tr>
                <tr>

            
                <tr>
                    <td><b>Email:</b></td>
                    <td><?php echo $usemail ?></td>
                </tr>
                <tr>

                <tr>
                    <td><b>Password:</b></td>
                    <td><?php echo $uspass ?></td>
                </tr>
                <tr>

                <tr>
                    <td><b>Rol:</b></td>
                    <td><?php echo $usrol ?></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <?php echo "<a class='BotonesTeam' href=\"user_tabla.php?pag=$pagina\">Regresar</a>";?>
                    </td>
                </tr>
            </table>
        </form>
    </div>
</body>
</html>