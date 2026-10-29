<?php
include("conexion.php");
include("posts_tabla.php");


$pagina = $_GET['pag'];
$id = $_GET['id'];


$querybuscar = mysqli_query($conn, "SELECT * FROM posts WHERE id_post = '$id'");
while($mostrar = mysqli_fetch_array($querybuscar))
{  
   $proid = $mostrar['id_post'];
   $pronom = $mostrar['nombre_of'];
   $prodes = $mostrar['descripcion'];
   $propun = $mostrar['puntuacion'];
   $procat = $mostrar['id_section'];

?>
<html>
<body>
<div class="caja_popup2">
<form class="contenedor_popup" method="POST">
<table>

<tr><th colspan="2">Modificar post</th></tr>

<tr>
<td><b>Id: </b></td>
<td><input class="CajaTexto" type="number" name="txtid" value="<?php echo $proid;?>" readonly></td>
</tr>

<tr>
<td><b>Nombre: </b></td>
<td><input class="CajaTexto" type="text" name="txtnom" value="<?php echo $pronom;?>" required></td>
</tr>
<tr>
<td><b>Descripción: </b></td>
<td><input class="CajaTexto" type="text" name="txtdes" value="<?php echo $prodes;?>" required></td>
</tr>
<tr>
<td><b>Puntuacion: </b></td>
<td><input class="CajaTexto" type="number" step="any" name="txtpre" value="<?php echo $propun;?>" required ></td>
</tr>
<tr>
<td><b>Seccion: </b></td>
<td>
<select name="txtcat" class='CajaTexto'>


<?php  
}
$qrproductos = mysqli_query($conn, "SELECT * FROM sections where sections.id_section > 0;
");
while($mostrarcat = mysqli_fetch_array($qrproductos))
{
if($mostrarcat['id_section']==$procat)
{
echo '<option selected="selected" value="'.$mostrarcat['id_section'].'">' .$mostrarcat['Nombre_sec']. '</option>';
}
else
{
echo '<option value="'.$mostrarcat['id_section'].'">' .$mostrarcat['Nombre_sec']. '</option>';
}
}      
?>

</select>
</td>
</tr>
<tr>
<td colspan="2" >
<?php echo "<a class='BotonesTeam' href=\"posts_tabla.php?pag=$pagina\">Cancelar</a>";?>&nbsp;
<input class='BotonesTeam' type="submit" name="btnregistrar" value="Modificar" onClick="javascript: return confirm('¿Deseas modificar este post');">
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
   $proid1     = $_POST['txtid'];
   $pronom1    = $_POST['txtnom'];
   $prodes1    = $_POST['txtdes'];
   $propun1    = $_POST['txtpre'];
   $procat1    = $_POST['txtcat'];
    
$querymodificar = mysqli_query($conn, "UPDATE posts SET nombre_of='$pronom1',descripcion='$prodes1',puntuacion='$propun1',id_section='$procat1' WHERE id_post = '$proid1'");
echo "<script>window.location= 'posts_tabla.php?pag=$pagina' </script>";
  
}
?>



