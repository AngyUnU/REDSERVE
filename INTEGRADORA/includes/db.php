<?php
/*
 * db.php - Consultas preparadas (Auditoria OWASP MASVS-CODE)
 * Los datos del usuario nunca se concatenan dentro del SQL:
 * se envian aparte como parametros.
 *
 *   consulta($conn, "SELECT * FROM posts WHERE id_post = ?", 'i', $id);
 */
function consulta(mysqli $conn, string $sql, string $tipos = '', ...$params)
{
    $stmt = mysqli_prepare($conn, $sql);
    if ($tipos !== '') {
        mysqli_stmt_bind_param($stmt, $tipos, ...$params);
    }
    $ok = mysqli_stmt_execute($stmt);
    $resultado = mysqli_stmt_get_result($stmt);
    return $resultado !== false ? $resultado : $ok;
}
