<?php
include("conexion.php");
include("user_tabla.php");


$pagina = $_GET['pag'];
$id = $_GET['user'];


$querybuscar = mysqli_query($conn, "SELECT * FROM users WHERE id_user = '$id'");
while($mostrar = mysqli_fetch_array($querybuscar))
{  
   $usid = $mostrar['id_user'];
   $usnom = $mostrar['nombre_us'];
   $usemail = $mostrar['email'];
   $uspass = $mostrar['password_u'];
   $usrol = $mostrar['id_rol'];

?>

<html>
<body>
<div class="caja_popup2">
<form class="contenedor_popup" method="POST">
<table>

<tr><th colspan="2">Modificar usuario</th></tr>

<tr>
<td><b>Id: </b></td>
<td><input class="CajaTexto" type="number" name="txtid" value="<?php echo $usid;?>" readonly></td>
</tr>

<tr>
<td><b>Nombre: </b></td>
<td><input class="CajaTexto" type="text" name="txtnom" value="<?php echo $usnom;?>" required></td>
</tr>
<tr>
<td><b>Email: </b></td>
<td><input class="CajaTexto" type="email" name="txtemail" value="<?php echo $usemail;?>" required></td>
</tr>
<tr>
<td><b>Password: </b></td>

<td><input class="CajaTexto" type="text" step="any" name="txtpass" value="<?php echo "";?>" required ></td>
</tr>
<tr>
<td><b>Rol: </b></td>
<td>
<select name="txtrol" class='CajaTexto'>


<?php  
}
$qruser = mysqli_query($conn, "SELECT * FROM roles;
");
while($mostrarcat = mysqli_fetch_array($qruser))
{
if($mostrarcat['id_rol']==$usrol)
{
echo '<option selected="selected" value="'.$mostrarcat['id_rol'].'">' .$mostrarcat['Rol']. '</option>';
}
else
{
echo '<option value="'.$mostrarcat['id_rol'].'">' .$mostrarcat['Rol']. '</option>';
}
}      
?>

</select>
</td>
</tr>
<tr>
<td colspan="2" >
<?php echo "<a class='BotonesTeam' href=\"user_tabla.php?pag=$pagina\">Cancelar</a>";?>&nbsp;
<input class='BotonesTeam' type="submit" name="btnregistrar" value="Modificar" onClick="javascript: return confirm('¿Deseas modificar a este usuario?');">
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
   $usid1     = $_POST['txtid'];
   $usnom1    = $_POST['txtnom'];
   $usemail1    = $_POST['txtemail'];
   $uspass1    = $_POST['txtpass'];
   $usrol1    = $_POST['txtrol'];

   $pass_fuerte = password_hash($uspass1,PASSWORD_BCRYPT);
  
$querymodificar = mysqli_query($conn, "UPDATE users SET nombre_us='$usnom1',email='$usemail1',password_u='$pass_fuerte',id_rol='$usrol' WHERE id_user = '$usid1'");
echo "<script>window.location= 'user_tabla.php?pag=$pagina' </script>";

}
?>



