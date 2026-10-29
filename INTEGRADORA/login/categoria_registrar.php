<?php
include('conexion.php');
include('categoria_tabla.php');

$pagina = $_GET['pag'];
?>
<html>
<head>
    <meta charset="UTF-8">
    <title>Registrar Categoria</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class = "caja_popup2">
    <form class= "contenedor_popup" method = "POST">
        <table>
            <tr><th colspan="2">Agregar categoría</th></tr>
            <tr>
                <td>Nombre</td>
                <td><input type="text" name="txtnom" autocomplete="off" class="CajaTexto"></td>
            </tr>

            <tr>
                <td>Descripcion</td>
                <td><input type="text" name="txtdes" autocomplete="off" class="CajaTexto"></td>
            </tr>

            <tr>
                <td colspan="2">
                    <?php echo "<a class= 'BotonesTeam' href=\"categoria_tabla.php?pag=$pagina\">Cancelar</a>";?>&nbsp;
                    <input class="BotonesTeam" type="submit" name= "btnregistrar" value="Registrar" 
                            onClick="javascript: return confirm('¿Deseas registrar esta categoría?');">
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
    $vainom = $_POST['txtnom'];
    $vaides = $_POST['txtdes'];

    $queryadd = mysqli_query($conn,"INSERT INTO sections(Nombre_sec,Description) VALUES('$vainom','$vaides')");

    if(!$queryadd)
    {
        echo "<script> alert('Id duplicado, intenta otra vez');</script>";
    }
    else
    {
        echo "<script>window.location= 'categoria_tabla.php?pag=1'</script>";
    }
}
?>