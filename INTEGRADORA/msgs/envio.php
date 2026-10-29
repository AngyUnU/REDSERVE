<?php
include('../php/conexion.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario_n = $_POST['usuario_n'];
    $contenido = $_POST['contenido'];


    $stmt = $conn->prepare("INSERT INTO messages (usuario_n, contenido) VALUES (?, ?)");
    $stmt->bind_param("ss", $usuario_n, $contenido);

    if ($stmt->execute()) {
        echo "New post created successfully";
        // Redirige después de completar todas las operaciones
        header("Location: mensajes.php");
        exit(); // Asegura que el script se detenga después de la redirección
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>
