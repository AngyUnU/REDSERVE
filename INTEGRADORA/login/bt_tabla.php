<?php
include('conexion.php');
include('barra_lateral.php');
?>
<html>
<title>Bitacora</title>
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
            $buscar = mysqli_real_escape_string($conn, $_POST['txtBuscar']);
            $sqlcat = mysqli_query($conn, "SELECT * FROM bitacora WHERE descripcion LIKE '%$buscar%'");
        } else {
            $sqlcat = mysqli_query($conn, "SELECT * FROM bitacora ORDER BY id_bitacora ASC LIMIT " . (($pagina - 1) * $filasmax) . ", $filasmax");
        }

        $resultadoMaximo = mysqli_query($conn, "SELECT count(*) as num_registros FROM bitacora");
        $maxusutabla = mysqli_fetch_assoc($resultadoMaximo)['num_registros'];
        ?>
        <div class="ContenedorTabla"> 
            <form method="post">
                <h1>Lista de operaciones realizadas en la base de datos</h1>
                <div class="ContBuscar">
                    <div style="float: left;">
                        <a href="bt_tabla.php" class="BotonesTeam">Inicio</a>
                        <input class="BotonesTeam" type="submit" value="Buscar" name="btnBuscar">
                        <input class="CajaTextoBuscar" type="text" name="txtBuscar" placeholder="Ingresar descripcion" autocomplete="off">
                    </div>
                    
                </div>
            </form>
            <table>
                <tr>
                    <th>Id</th>
                    <th>Tabla afectada</th>
                    <th>Operacion</th>
                    <th>Fecha</th>
                    <th>Descripcion</th>
                </tr>

                <?php
                while ($mostrar = mysqli_fetch_assoc($sqlcat)) {
                    echo "<tr>";
                    echo "<td>" . $mostrar['id_bitacora'] . "</td>";
                    echo "<td>" . $mostrar['tabla_afectada'] . "</td>"; 
                    echo "<td>" . $mostrar['operacion'] . "</td>";
                    echo "<td>" . $mostrar['fecha'] . "</td>";
                    echo "<td>" . $mostrar['descripcion'] . "</td>";
                    echo "</tr>";
                }
                ?>
            </table>
            <div style='text-align:right'>
                <br>
                <?php echo "Total de registros: " . $maxusutabla; ?>
            </div>
        </div>
        <div style="text-align:center">
            <?php
            // Navegación de páginas
            if ($pagina > 1) {
                echo "<a class='BotonesTeam4' href='bt_tabla.php?pag=" . ($pagina - 1) . "'>Anterior</a>";
            } else {
                echo "<a class='BotonesTeam4' href='#' style='pointer-events: none'>Anterior</a>";
            }

            if (($pagina * $filasmax) < $maxusutabla) {
                echo "<a class='BotonesTeam4' href='bt_tabla.php?pag=" . ($pagina + 1) . "'>Siguiente</a>";
            } else {
                echo "<a class='BotonesTeam4' href='#' style='pointer-events: none'>Siguiente</a>";
            }
            ?>
        </div>
    </div>
</body>
</html>
