<?php
/*
 * config.php - Configuracion unica de REDSERV (Auditoria OWASP MASVS)
 * Antes las credenciales de la BD estaban repetidas en varios archivos.
 * Ahora viven solo aqui y se pueden sobrescribir con variables de entorno
 * (REDSERV_DB_HOST, REDSERV_DB_USER, REDSERV_DB_PASS, REDSERV_DB_NAME)
 * para no dejar contrasenas reales dentro del codigo ni del repositorio.
 */
define('DB_HOST', getenv('REDSERV_DB_HOST') ?: 'localhost');
define('DB_USER', getenv('REDSERV_DB_USER') ?: 'root');
define('DB_PASS', getenv('REDSERV_DB_PASS') ?: '');
define('DB_NAME', getenv('REDSERV_DB_NAME') ?: 'redserv');

// Errores: se registran en el log del servidor, nunca se muestran al usuario.
ini_set('display_errors', '0');
ini_set('log_errors', '1');
error_reporting(E_ALL);
