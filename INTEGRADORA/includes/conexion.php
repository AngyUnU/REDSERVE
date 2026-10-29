<?php
/*
 * conexion.php - Conexion unica a la base de datos.
 * Si falla, se registra el detalle tecnico y el usuario solo ve un
 * mensaje generico (sin rutas, usuarios ni mensajes de MySQL).
 */
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/db.php';

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
try {
    $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    $conn->set_charset('utf8mb4');
} catch (mysqli_sql_exception $ex) {
    error_log('REDSERV - error de conexion a BD: ' . $ex->getMessage());
    http_response_code(503);
    exit('El servicio no esta disponible en este momento. Intenta mas tarde.');
}
