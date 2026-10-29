<?php
include('conexion.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $categoria = $_POST['categoria'];

    $imagen = null;
    if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] == 0) {
        $targetDir = "../uploads/";
        $imagen = $targetDir . basename($_FILES['imagen']['name']);
        move_uploaded_file($_FILES['imagen']['tmp_name'], $imagen);
    }

    $stmt = $conn->prepare("INSERT INTO posts (nombre_of, imagen, descripcion, id_section) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("sssi", $nombre, $imagen, $descripcion, $categoria);

    if ($stmt->execute()) {
        echo "New post created successfully";
        // Redirige después de completar todas las operaciones
        header("Location: ../Paginas/Servicios.php");
        exit(); // Asegura que el script se detenga después de la redirección
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>
