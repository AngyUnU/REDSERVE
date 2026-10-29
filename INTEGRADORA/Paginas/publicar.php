<?php
include('../php/conexion.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PUBLICAR</title>
    <link rel="stylesheet" href="../css/estilos.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">



    <nav class="navbar navbar-expand-lg fixed-top">
        <a class="navbar-brand" href="#">
            <img class="logo" src="../img/logo_d.png" alt="Logo">REDSERV
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="../index.html">Inicio</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="Servicios.php">Servicios</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="FAQ's.html">FAQ´S</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="ACERCA DE.HTML">Acerca de</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../login/index.html">Publicar <span class="sr-only">(actual)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../login/index.html">
                        <img class="sesion" src="../img/user.png" alt="User">
                    </a>
                </li>
            </ul>
        </div>
    </nav>
</head>
<body>
<style>
            body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }

        .container {
            max-width: 600px;
            margin: auto;
            background: white;
            padding: 50px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-top: 4%;
        }

        h1 {
            text-align: center;
        }

        label {
            display: block;
            margin: 10px 0 5px;
        }

        input[type="text"],
        input[type="file"],
        textarea,
        select {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        button {
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            background-color: #007BFF;
            color: white;
            cursor: pointer;
        }

        button:hover {
            background-color: #0056b3;
        }

</style>

    
    <div class="container">
        <br><br>
        <b><h1>Crear una Publicación</h1></b>
        <br>
        <form action="../php/insert_post.php" method="POST" enctype="multipart/form-data">
            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" required>
        
            <label for="imagen">Imagen:</label>
            <input type="file" id="imagen" name="imagen" accept="image/*" required>
        
            <label for="descripcion">Descripción:</label>
            <textarea id="descripcion" name="descripcion" rows="4" required></textarea>
        
           <!-- <label for="categoria">Categoría:</label>
            <select id="categoria" name="categoria" required>
                <option value="" disabled selected>Selecciona una categoría</option>
                <option value="1">Limpieza</option>
                <option value="2">Cocina</option>
                <option value="3">Informatica</option>
            </select>
    -->

                <label for="categoria">Seccion:</label>
                <select id="categoria" name="categoria" required>
                <?php
                        $categoria = mysqli_query($conn, "SELECT * FROM sections");
                        while ($mostrarc = mysqli_fetch_array($categoria)) 
                        {
                        echo '<option value= "' . $mostrarc['id_section'] . '">' . $mostrarc['Nombre_sec'] . '</option>';
                        }
                        ?>
                </select>
                
        
            <button type="submit">Publicar</button>
            <button type="button" onclick="cancelarPublicacion()">Cancelar</button>
        </form>
        
    </div>

    <script>
        function cancelarPublicacion() {
            window.location.href = 'index.html'; // Redirige al índice
        }
    </script>


<footer class="footer">
    <div class="footer-content">
        <div class="footer-section about">
            <h1 class="logo-text">Red<span>Serv</span></h1>
            <p>
            La pagina N1 para ofrecer tus servicios o solicitar alguno.
            </p>
            <div class="contact">
                <span><i class="fas fa-phone"></i> &nbsp; 123-456-789</span>
                <span><i class="fas fa-envelope"></i> &nbsp; info@redserv.com</span>
            </div>
            <div class="socials">
                <a href="#"><i class="fab fa-facebook"></i></a>
                <a href="#"><i class="fab fa-twitter"></i></a>
                <a href="#"><i class="fab fa-instagram"></i></a>
                <a href="#"><i class="fab fa-linkedin"></i></a>
            </div>
        </div>
        <div class="footer-section links">
            <h2>Enlaces rápidos</h2>
            <br>
            <ul>
                <a href="../index.html"><li>Inicio</li></a>
                <a href="Servicios.php"><li>Servicios</li></a>
                <a href="FAQ's.html"><li>FAQ's</li></a>
                <a href="ACERCA DE.HTML"><li>Acerca de</li></a>
                <a href="../login/index.html"><li>Publicar</li></a>
            </ul>
        </div>
        <div class="footer-section contact-form">
            <h2>Datos</h2>
            <br>
            <h4>RedServ companny SA de CV.</h4>
            <h6>Calle principal</h6>
            <h6>Gtz.Ver</h6>
        </div>
    </div>
    <div class="footer-bottom">
        &copy; redserv.com | Diseñado por Equipo de Desarrollo
    </div>
</footer>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

