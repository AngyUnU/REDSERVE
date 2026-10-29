<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SERVICIOS</title>
    <link rel="stylesheet" href="../css/estilos.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
</head>
<body>
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
                    <a class="nav-link" href="../index.html">Inicio <span class="sr-only">(actual)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Servicios <span class="sr-only">(actual)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="FAQ's.html">FAQ´S</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="ACERCA DE.HTML">Acerca de</a>
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

    <div class="container mt-5">
        <h1 class="text-center">Publicaciones</h1>

        <!-- Filter and Search Form -->
        <form method="GET" action="" class="mb-4">
              <div class="form-row">
                <div class="col-md-4 mb-3">
                    <label for="categoria">Categoría</label>
                    <select id="categoria" name="categoria" class="form-control">
                        <option value="">Todas</option>
                        <!-- Populate categories dynamically from the database -->
                        <?php
                        include('../php/conexion.php');
                        $category_query = "SELECT DISTINCT sections.Nombre_sec  FROM sections, posts WHERE sections.id_section=posts.id_section";
                        $categories = $conn->query($category_query);
                        while ($cat = $categories->fetch_assoc()) {
                            echo "<option value='" . $cat['Nombre_sec'] . "'>" . $cat['Nombre_sec'] . "</option>";
                        }
                        $conn->close();
                        ?>
                    </select>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="search">Buscar</label>
                    <input type="text" id="search" name="search" class="form-control" placeholder="Buscar publicaciones">
                </div>
                <div class="col-md-4 mb-3">
                    <label>&nbsp;</label>
                    <button type="submit" class="btn btn-primary form-control">Buscar</button>
                </div>
            </div>
        </form>
                    </div>
        <div class="contenedorP">
        <?php
            include('../php/conexion.php');

            // Get filter and search values
            $category_filter = isset($_GET['categoria']) ? $_GET['categoria'] : '';
            $search_query = isset($_GET['search']) ? $_GET['search'] : '';

            // Construct SQL query
            $sql = "SELECT p.nombre_of, p.imagen, p.descripcion FROM posts p JOIN sections s ON p.id_section = s.id_section WHERE 1=1";

            if ($category_filter) {
                $sql .= " AND s.Nombre_sec = '" . $conn->real_escape_string($category_filter) . "'";
            }
            if ($search_query) {
                $sql .= " AND (p.nombre_of LIKE '%" . $conn->real_escape_string($search_query) . "%'   OR p.descripcion LIKE '%" . $conn->real_escape_string($search_query) . "%')";
            }

            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<div class='card Publicacion col-4'>";
                    echo "<h4 class='card-header'>" . $row['nombre_of'] . "</h4>";
                    echo '<div class="card-body">';
                    if ($row['imagen']) {
                        echo "<img src='" . $row['imagen'] . "' alt='Imagen de publicación'>";
                    }
                    echo "<p><b>" . $row['descripcion'] . "</b></p>";
                    echo "<a href='../msgs/mensajes.php' class='btn-block'>Contactar</a>";
                    echo "</div></div>";
                }
            } else {
                echo "No hay publicaciones.";
            }
            $conn->close();
            ?>

        </div>
  

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
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>
</body>
</html>
