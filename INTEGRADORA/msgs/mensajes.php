<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CHAT</title>
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
                    <a class="nav-link" href="../Paginas/Servicios.php">Servicios</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../Paginas/FAQ's.html">FAQ´S</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../Paginas/ACERCA DE.HTML">Acerca de</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../login/index.html">Publicar</a>
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
    margin: auto;
    padding: 100px;
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


<div class="container mt-4">
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h3  class="text-center">Publicar mensaje</h3>
                </div>
                <div class="card-body">
                    <form action="envio.php" method="POST" enctype="multipart/form-data">
                        <label for="usuario_n">Nombre:</label>
                        <input type="text" id="usuario_n" name="usuario_n" required>

                        <label for="contenido">Descripción:</label>
                        <textarea id="contenido" name="contenido" rows="4" required></textarea>

                        <button type="submit">Publicar</button>

                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h3 class="text-center">Mensajes</h3>
                </div>
                <div class="card-body">
                    <div class="contenedorP" style="justify-content: end;">
                        <div class="row">
                            <?php
                                include('../php/conexion.php');

                                // Construct SQL query
                                $sql = "SELECT usuario_n,contenido,feha FROM messages WHERE 1=1";

                                $result = $conn->query($sql);

                                
                                    while ($row = $result->fetch_assoc()) {
                                        echo "<div class='col-12'><p class='text-right'>".$row['feha']."</p>";
                                        echo "<div class='alert alert-primary'>";
                                        echo "<h4 class='alert-heading'>" . $row['usuario_n'] . "</h4>". "<hr><p><b>" . $row['contenido'] . "</b></p>";
                                        echo "</div></div>";
                                    }
                            
                                $conn->close();
                                ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
     </div>
</div>
 


<div><br><br><br>

<footer class="footer">
        <div class="footer-content">
            <div class="footer-section about">
                <h1 class="logo-text">Red<span>Serv</span></h1>
                <p>
                    La app N1 para encontrar ofrecer tus servicios
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
                    <a href="../Paginas/Servicios.php"><li>Servicios</li></a>
                    <a href="../Paginas/FAQ's.html"><li>FAQ's</li></a>
                    <a href="../Paginas/ACERCA DE.HTML"><li>Acerca de</li></a>
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
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>




            </div>
            </body>

            </html>