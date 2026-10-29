<?php
#incluimos la información que contiene el archivo "conexion.php"
include('conexion.php');

$nombre = $_POST["txtnombre1"];
$correo = $_POST["txtcorreo1"];
$pass = $_POST["txtpassword1"];

$rol=0;
$pass_fuerte = password_hash($pass,PASSWORD_BCRYPT);

$insertarusu = consulta($conn, "INSERT INTO users(nombre_us, email, password_u, id_rol) VALUES (?, ?, ?, ?)", 'sssi', $nombre, $correo, $pass_fuerte, $rol);

if(!$insertarusu)
{
    echo "<script>alert('Correo duplicado, intenta con otro correo');window.location ='index.html'; </script>";
}
else
{
    echo "<script>alert('Usuario registrado con éxito: $nombre');window.location ='index.html'; </script>";
}
?>
