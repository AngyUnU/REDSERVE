<?php
include('conexion.php');
include('barra_lateral.php');
?>
<html>
<title>Tabla de usuarios</title>
<body>
    <div class="ContenedorPrincipal">
        <?php
        $filasmax = 7;

        if (isset($_GET['pag'])) {
            $pagina = (int)$_GET['pag'];
        } else {
            $pagina = 1;
        }

        if (isset($_POST['btnBuscar'])) {
            $buscar = $_POST['txtBuscar'] ?? '';
           
        $sqluser = consulta($conn, "SELECT u.id_user,u.nombre_us,u.email, r.Rol FROM users u JOIN roles r ON u.id_rol=r.id_rol WHERE u.nombre_us LIKE ?", 's', $buscar . '%');

        } else {

            $sqluser = mysqli_query($conn, "SELECT u.id_user,u.nombre_us,u.email, r.Rol
            FROM users u, roles r where u.id_rol=r.id_rol  ORDER BY u.id_user ASC LIMIT " . (($pagina -1) * $filasmax)  . "," . $filasmax);
        }

        $resultadoMaximo = mysqli_query($conn, "SELECT count(*) as num_users FROM users");
        $maxusutabla = mysqli_fetch_assoc($resultadoMaximo)['num_users'];
        ?>
        <div class="ContenedorTabla"> 
            <form method="post">
                <h1>Lista de usuarios</h1>
                <div class="ContBuscar">
                    <div style="float: left;">
                        <a href="user_tabla.php" class="BotonesTeam">Inicio</a>
                        <input class="BotonesTeam" type="submit" value="Buscar" name="btnBuscar">
                        <input class="CajaTextoBuscar" type="text" name="txtBuscar" placeholder="Ingresar Usuario" autocomplete="off">
                    </div>
                    <div style="float:right">
                        <?php echo "<a class='BotonesTeam' href='user_registrar.php?pag=$pagina'>Agregar usuario</a>"; ?>
                    </div>
                </div>
            </form>
            <table>
                <tr>
                    <th>Id</th>
                    <th>Nombre</th>
                    <th>Email</th>
                    <th>Rol</th>
                    <th>Acción</th>
                </tr>

                <?php
                while ($mostrar = mysqli_fetch_assoc($sqluser)) {
                    echo "<tr>";
                    echo "<td>" . $mostrar['id_user'] . "</td>";
                    echo "<td>" . $mostrar['nombre_us'] . "</td>";
                    echo "<td>" . $mostrar['email'] . "</td>";
                    echo "<td>" . $mostrar['Rol'] . "</td>"; 
                    echo "<td style='width:24%'>
                        <a class='BotonesTeam1' href='user_ver.php?user={$mostrar['id_user']}&pag=$pagina'>&#x1F50D;</a> 
                        <a class='BotonesTeam2' href='user_modificar.php?user={$mostrar['id_user']}&pag=$pagina'>&#128397;</a> 
                        <form method='post' action='user_eliminar.php?pag=$pagina' style='display:inline' onsubmit=\"return confirm('¿Estás seguro de eliminar al usuario ' + this.dataset.nombre + '?')\" data-nombre='" . e($mostrar['nombre_us']) . "'>" . csrf_field() . "<input type='hidden' name='id' value='" . (int)$mostrar['id_user'] . "'><button type='submit' class='BotonesTeam3' title='Eliminar' style='border:none;background:none;cursor:pointer;padding:0'>&#10006;</button></form>
                    </td>";  
                    echo "</tr>";
                }
                ?>
            </table>
            <div style='text-align:right'>
                <br>
                <?php echo "Total de usuarios: " . $maxusutabla; ?>
            </div>
        </div>
        <div style="text-align:center">
            <?php
            // Navegación de páginas
            if ($pagina > 1) {
                echo "<a class='BotonesTeam4' href='user_tabla.php?pag=" . ($pagina - 1) . "'>Anterior</a>";
            } else {
                echo "<a class='BotonesTeam4' href='#' style='pointer-events: none'>Anterior</a>";
            }

            if (($pagina * $filasmax) < $maxusutabla) {
                echo "<a class='BotonesTeam4' href='user_tabla.php?pag=" . ($pagina + 1) . "'>Siguiente</a>";
            } else {
                echo "<a class='BotonesTeam4' href='#' style='pointer-events: none'>Siguiente</a>";
            }
            ?>
        </div>
    </div>
</body>
</html>
