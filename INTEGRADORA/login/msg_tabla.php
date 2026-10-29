<?php
include('conexion.php');
include('barra_lateral.php');
?>
<html>
<title>Tabla de mensajes</title>
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
            $sqlcat = consulta($conn, "SELECT * FROM messages WHERE contenido LIKE ?", 's', '%' . $buscar . '%');
        } else {
            $sqlcat = mysqli_query($conn, "SELECT * FROM messages ORDER BY id_message ASC LIMIT " . (($pagina - 1) * $filasmax) . ", $filasmax");
        }

        $resultadoMaximo = mysqli_query($conn, "SELECT count(*) as num_message FROM messages");
        $maxusutabla = mysqli_fetch_assoc($resultadoMaximo)['num_message'];
        ?>
        <div class="ContenedorTabla"> 
            <form method="post">
                <h1>Mensajes existentes</h1>
                <div class="ContBuscar">
                    <div style="float: left;">
                        <a href="msg_tabla.php" class="BotonesTeam">Inicio</a>
                        <input class="BotonesTeam" type="submit" value="Buscar" name="btnBuscar">
                        <input class="CajaTextoBuscar" type="text" name="txtBuscar" placeholder="Ingresar Mensaje" autocomplete="off">
                    </div>
                    <div style="float:right">
                        <?php echo "<a class='BotonesTeam' href='msg_registrar.php?pag=$pagina'>Agregar nuevo mensaje</a>"; ?>
                    </div>
                </div>
            </form>
            <table>
                <tr>
                    <th>Id</th>
                    <th>Nombre</th>
                    <th>Contenido</th>
                    <th>Fecha</th>
                    <th>Acción</th>
                </tr>

                <?php
                while ($mostrar = mysqli_fetch_assoc($sqlcat)) {
                    echo "<tr>";
                    echo "<td>" . $mostrar['id_message'] . "</td>";
                    echo "<td>" . $mostrar['usuario_n'] . "</td>"; 
                    echo "<td>" . $mostrar['contenido'] . "</td>";
                    echo "<td>" . $mostrar['feha'] . "</td>"; 
                    echo "<td style='width:24%'>
                        <a class='BotonesTeam1' href='msg_ver.php?msg={$mostrar['id_message']}&pag=$pagina'>&#x1F50D;</a> 
                        <a class='BotonesTeam2' href='msg_modificar.php?msg={$mostrar['id_message']}&pag=$pagina'>&#128397;</a> 
                        <form method='post' action='msg_eliminar.php?pag=$pagina' style='display:inline' onsubmit=\"return confirm('¿Estás seguro de eliminar el mensaje de ' + this.dataset.nombre + '?')\" data-nombre='" . e($mostrar['usuario_n']) . "'>" . csrf_field() . "<input type='hidden' name='id' value='" . (int)$mostrar['id_message'] . "'><button type='submit' class='BotonesTeam3' title='Eliminar' style='border:none;background:none;cursor:pointer;padding:0'>&#10006;</button></form>
                    </td>";  
                    echo "</tr>";
                }
                ?>
            </table>
            <div style='text-align:right'>
                <br>
                <?php echo "Total de mensajes: " . $maxusutabla; ?>
            </div>
        </div>
        <div style="text-align:center">
            <?php
            // Navegación de páginas
            if ($pagina > 1) {
                echo "<a class='BotonesTeam4' href='msg_tabla.php?pag=" . ($pagina - 1) . "'>Anterior</a>";
            } else {
                echo "<a class='BotonesTeam4' href='#' style='pointer-events: none'>Anterior</a>";
            }

            if (($pagina * $filasmax) < $maxusutabla) {
                echo "<a class='BotonesTeam4' href='msg_tabla.php?pag=" . ($pagina + 1) . "'>Siguiente</a>";
            } else {
                echo "<a class='BotonesTeam4' href='#' style='pointer-events: none'>Siguiente</a>";
            }
            ?>
        </div>
    </div>
</body>
</html>
