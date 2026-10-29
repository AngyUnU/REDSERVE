<?php
include('conexion.php');
include('user_tabla.php');
$pagina = get_int('pag', 1);
$id = get_int('user');


$querybuscar = consulta($conn, "SELECT u.id_user,u.nombre_us,u.email, r.Rol FROM users u JOIN roles r ON u.id_rol=r.id_rol WHERE u.id_user = ?", 'i', $id);


$usid = $usnom = $usemail = $usrol = '';
while($mostrar = mysqli_fetch_array($querybuscar))
{
    $usid = $mostrar['id_user'];
    $usnom = $mostrar['nombre_us'];
    $usemail = $mostrar['email'];
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