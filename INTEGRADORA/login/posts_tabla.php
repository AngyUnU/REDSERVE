<?php
include('conexion.php');
include("barra_lateral.php");
?>
<html>
<title>Productos Tabla</title>
<body>
<div class="ContenedorPrincipal">  
<?php
$filasmax = 7;
if (isset($_GET['pag']))
   {
       $pagina = max(1, (int)$_GET['pag']);
   } else
   {
       $pagina = 1;
   }
if(isset($_POST['btnbuscar']))
{
$buscar = $_POST['txtbuscar'] ?? '';


$sqlpost = consulta($conn, "SELECT p.id_post,p.nombre_of,p.descripcion,p.puntuacion,s.Nombre_sec FROM posts p JOIN sections s ON p.id_section=s.id_section WHERE p.descripcion LIKE ?", 's', $buscar . '%');


}
else
{
$sqlpost = mysqli_query($conn, "SELECT p.id_post,p.nombre_of,p.descripcion,p.puntuacion,s.Nombre_sec
FROM posts p, sections s where  p.id_section=s.id_section ORDER BY p.id_post ASC LIMIT " . (($pagina -1) * $filasmax)  . "," . $filasmax);
}
   $resultadoMaximo = mysqli_query($conn, "SELECT count(*) as num_posts FROM posts");
   $maxusutabla = mysqli_fetch_assoc($resultadoMaximo)['num_posts'];
  
   ?>
   <div class="ContenedorTabla">
   <form method="POST">
   <h1>Control de Posts</h1>
  
   <div class="ContBuscar">
   <div style="float: left;">
   <a href="posts_tabla.php" class="BotonesTeam">Inicio</a>
   <input class="BotonesTeam" type="submit" value="Buscar" name="btnbuscar">
   <input class="CajaTextoBuscar" type="text" name="txtbuscar"  placeholder="Ingresar descripción del post" autocomplete="off" >
   </div>
   <div style="float:right;">
   <?php echo "<a class='BotonesTeam5' href=\"posts_registrar.php?pag=$pagina\">Agregar post</a>";?>
   </div>
   </div>
           </form>
   <table>
           <tr>
           <th>Id</th>
           <th>Nombre</th>
           <th>Descripción</th>
           <th>Puntuacion</th>
           <th>Seccion</th>
           <th>Acción</th>
           </tr>
       <?php
       while ($mostrar = mysqli_fetch_assoc($sqlpost))
       {
          
           echo "<tr>";
           echo "<td>".$mostrar['id_post']."</td>";
           echo "<td>".$mostrar['nombre_of']."</td>";
           echo "<td>".$mostrar['descripcion']."</td>";
           echo "<td>".$mostrar['puntuacion']."</td>";
           echo "<td>".$mostrar['Nombre_sec']."</td>";
           echo "<td style='width:24%'>
           <a class='BotonesTeam1' href=\"posts_ver.php?id=$mostrar[id_post]&pag=$pagina\">&#x1F50D;</a>
           <a class='BotonesTeam2' href=\"posts_modificar.php?id=$mostrar[id_post]&pag=$pagina\">&#128397;</a>
           <form method='post' action='posts_eliminar.php?pag=$pagina' style='display:inline' onsubmit=\"return confirm('¿Estás seguro de eliminar el post de ' + this.dataset.nombre + '?')\" data-nombre='" . e($mostrar['nombre_of']) . "'>" . csrf_field() . "<input type='hidden' name='id' value='" . (int)$mostrar['id_post'] . "'><button type='submit' class='BotonesTeam3' title='Eliminar' style='border:none;background:none;cursor:pointer;padding:0'>&#10006;</button></form>
           </td>"; 
          
       }
       ?>
   </table>
   <div style='text-align:right'>
   <br>
   <?php echo "Total de posts: ".$maxusutabla;?>
   </div>
   </div>
<div style='text-align:right'>
<br>
</div>
<div style="text-align:center">
<?php
if (isset($_GET['pag'])) {
if ($_GET['pag'] > 1) {
?>
<a class="BotonesTeam4" href="posts_tabla.php?pag=<?php echo $pagina - 1; ?>">Anterior</a>
<?php
}
else
{
?>
<a class="BotonesTeam4" href="#" style="pointer-events: none">Anterior</a>
<?php
}
?>
<?php
}
else
{
?>
<a class="BotonesTeam4" href="#" style="pointer-events: none">Anterior</a>
<?php
}
if (isset($_GET['pag'])) {
if ((($pagina) * $filasmax) < $maxusutabla) {
?>
<a class="BotonesTeam4" href="posts_tabla.php?pag=<?php echo $pagina + 1; ?>">Siguiente</a>
<?php
} else {
?>
<a class="BotonesTeam4" href="#" style="pointer-events: none">Siguiente</a>
<?php
}
?>
<?php
} else {
?>
<a class="BotonesTeam4" href="posts_tabla.php?pag=2">Siguiente</a>
<?php
}
?>
</div>
</div>
</body>
</html>