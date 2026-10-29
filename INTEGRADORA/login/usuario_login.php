<?php
session_start();
include('conexion.php');

$correo= $_POST["txtcorreo"];
$pass = $_POST["txtpassword"];

$buscandousu = mysqli_query($conn,"SELECT * FROM users WHERE email = '$correo'");
$nr = mysqli_num_rows($buscandousu);
$mostrar=mysqli_fetch_array($buscandousu);

if($nr == 1 && (password_verify($pass,$mostrar['password_u'])))
{
    session_start();
    $_SESSION['id_rol']=$mostrar['id_rol'];

    // Redirigimos según el rol
    switch($_SESSION['id_rol']) {
        
        case '1': 
            header("Location: posts_tabla.php");
            break;
        case '2': 
            header("Location: posts_tabla.php");
            break;
        default: // user normal
            header("Location: ../Paginas/publicar.php");
            break;
    }



}
else if ($nr == 0)
{
    echo "<script> alert('Usuario no existe');window.location='index.php' </script>";
}
?>
