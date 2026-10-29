<?php
include('conexion.php');
include('msg_tabla.php');

$pagina = get_int('pag', 1);
?>
<html>
<head>
    <meta charset="UTF-8">
    <title>Agregar nuevo mensaje</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class = "caja_popup2">
    <form class= "contenedor_popup" method = "POST">
        <table>
            <tr><th colspan="2">Agregar mensaje</th></tr>
            <tr>
                <td>Nombre</td>
                <td><input type="text" name="txtnom" autocomplete="off" class="CajaTexto"></td>
            </tr>

            <tr>
                <td>Contenido</td>
                <td><input type="text" name="txtdes" autocomplete="off" class="CajaTexto"></td>
            </tr>


            <tr>
                <td colspan="2">
                    <?php echo "<a class= 'BotonesTeam' href=\"msg_tabla.php?pag=$pagina\">Cancelar</a>";?>&nbsp;
                    <input class="BotonesTeam" type="submit" name= "btnregistrar" value="Agregar" 
                            onClick="javascript: return confirm('¿Deseas agregar este mensaje?');">
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
   
    $queryadd = consulta($conn, "INSERT INTO messages(usuario_n, contenido) VALUES (?, ?)", 'ss', $vainom, $vaides);

    if(!$queryadd)
    {
        echo "<script> alert('Id duplicado, intenta otra vez');</script>";
    }
    else
    {
        echo "<script>window.location= 'msg_tabla.php?pag=1'</script>";
    }
}
?>