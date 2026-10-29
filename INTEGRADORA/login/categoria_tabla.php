<?php
include('conexion.php');
include('barra_lateral.php');
?>
<html>
<title>Tabla de categorias</title>
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
            $sqlcat = consulta($conn, "SELECT * FROM sections WHERE Nombre_sec LIKE ?", 's', '%' . $buscar . '%');
        } else {
            $sqlcat = mysqli_query($conn, "SELECT * FROM sections ORDER BY id_section ASC LIMIT " . (($pagina - 1) * $filasmax) . ", $filasmax");
        }

        $resultadoMaximo = mysqli_query($conn, "SELECT count(*) as num_categorias FROM sections");
        $maxusutabla = mysqli_fetch_assoc($resultadoMaximo)['num_categorias'];
        ?>
        <div class="ContenedorTabla"> 
            <form method="post">
                <h1>Lista de categorías existentes</h1>
                <div class="ContBuscar">
                    <div style="float: left;">
                        <a href="categoria_tabla.php" class="BotonesTeam">Inicio</a>
                        <input class="BotonesTeam" type="submit" value="Buscar" name="btnBuscar">
                        <input class="CajaTextoBuscar" type="text" name="txtBuscar" placeholder="Ingresar Categoría" autocomplete="off">
                    </div>
                    <div style="float:right">
                        <?php echo "<a class='BotonesTeam' href='categoria_registrar.php?pag=$pagina'>Agregar categoría</a>"; ?>
                    </div>
                </div>
            </form>
            <table>
                <tr>
                    <th>Id</th>
                    <th>Nombre</th>
                    <th>Descripcion</th>
                    <th>Acción</th>
                </tr>

                <?php
                while ($mostrar = mysqli_fetch_assoc($sqlcat)) {
                    echo "<tr>";
                    echo "<td>" . $mostrar['id_section'] . "</td>";
                    echo "<td>" . $mostrar['Nombre_sec'] . "</td>"; 
                    echo "<td>" . $mostrar['Description'] . "</td>"; 
                    echo "<td style='width:24%'>
                        <a class='BotonesTeam1' href='categoria_ver.php?categoria={$mostrar['id_section']}&pag=$pagina'>&#x1F50D;</a> 
                        <a class='BotonesTeam2' href='categoria_modificar.php?categoria={$mostrar['id_section']}&pag=$pagina'>&#128397;</a> 
                        <form method='post' action='categoria_eliminar.php?pag=$pagina' style='display:inline' onsubmit=\"return confirm('¿Estás seguro de eliminar la categoría ' + this.dataset.nombre + '?')\" data-nombre='" . e($mostrar['Nombre_sec']) . "'>" . csrf_field() . "<input type='hidden' name='id' value='" . (int)$mostrar['id_section'] . "'><button type='submit' class='BotonesTeam3' title='Eliminar' style='border:none;background:none;cursor:pointer;padding:0'>&#10006;</button></form>
                    </td>";  
                    echo "</tr>";
                }
                ?>
            </table>
            <div style='text-align:right'>
                <br>
                <?php echo "Total de categorías: " . $maxusutabla; ?>
            </div>
        </div>
        <div style="text-align:center">
            <?php
            // Navegación de páginas
            if ($pagina > 1) {
                echo "<a class='BotonesTeam4' href='categoria_tabla.php?pag=" . ($pagina - 1) . "'>Anterior</a>";
            } else {
                echo "<a class='BotonesTeam4' href='#' style='pointer-events: none'>Anterior</a>";
            }

            if (($pagina * $filasmax) < $maxusutabla) {
                echo "<a class='BotonesTeam4' href='categoria_tabla.php?pag=" . ($pagina + 1) . "'>Siguiente</a>";
            } else {
                echo "<a class='BotonesTeam4' href='#' style='pointer-events: none'>Siguiente</a>";
            }
            ?>
        </div>
    </div>
</body>
</html>
