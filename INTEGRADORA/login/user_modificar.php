<?php
include("conexion.php");
include("user_tabla.php");


$pagina = get_int('pag', 1);
$id = get_int('user');


$querybuscar = consulta($conn, "SELECT * FROM users WHERE id_user = ?", 'i', $id);
$usid = $usnom = $usemail = $uspass = $usrol = '';
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

<td><input class="CajaTexto" type="password" name="txtpass" value="" autocomplete="new-password" placeholder="Dejar vac&iacute;o para no cambiarla"></td>
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

   if ($uspass1 !== '') {
       // Solo se cambia si el administrador escribe una nueva
       $pass_fuerte = password_hash($uspass1, PASSWORD_BCRYPT);
       $querymodificar = consulta($conn, "UPDATE users SET nombre_us=?, email=?, password_u=?, id_rol=? WHERE id_user=?", 'sssii', $usnom1, $usemail1, $pass_fuerte, (int)$usrol1, (int)$usid1);
   } else {
       $querymodificar = consulta($conn, "UPDATE users SET nombre_us=?, email=?, id_rol=? WHERE id_user=?", 'ssii', $usnom1, $usemail1, (int)$usrol1, (int)$usid1);
   }
echo "<script>window.location= 'user_tabla.php?pag=$pagina' </script>";

}
?>



