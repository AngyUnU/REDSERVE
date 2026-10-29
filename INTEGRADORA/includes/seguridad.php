<?php
/*
 * seguridad.php - Funciones comunes de seguridad (Auditoria OWASP MASVS)
 * - Sesion con cookie HttpOnly / SameSite            (MASVS-AUTH)
 * - Control de acceso por sesion y rol               (MASVS-AUTH)
 * - Token CSRF para acciones que modifican datos     (MASVS-AUTH / CODE)
 * - Escape de salida HTML                            (MASVS-CODE)
 */
if (session_status() === PHP_SESSION_NONE) {
    session_set_cookie_params([
        'lifetime' => 0,
        'path'     => '/',
        'httponly' => true,
        'samesite' => 'Lax',
        'secure'   => !empty($_SERVER['HTTPS']),
    ]);
    session_start();
}

const RUTA_LOGIN = '/INTEGRADORA/login/index.html';

/** Escapa texto para mostrarlo en HTML. */
function e($valor): string
{
    return htmlspecialchars((string)$valor, ENT_QUOTES, 'UTF-8');
}

/** Exige un usuario con sesion iniciada. */
function require_login(): void
{
    if (empty($_SESSION['id_user'])) {
        header('Location: ' . RUTA_LOGIN . '?error=sesion');
        exit;
    }
}

/** Exige sesion con rol Administrador (1) o Rol1 (2). */
function require_admin(): void
{
    require_login();
    if (!in_array((int)$_SESSION['id_rol'], [1, 2], true)) {
        http_response_code(403);
        exit('Acceso denegado: se requiere rol de administrador.');
    }
}

/** Token CSRF de la sesion. */
function csrf_token(): string
{
    if (empty($_SESSION['csrf'])) {
        $_SESSION['csrf'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf'];
}

function csrf_field(): string
{
    return '<input type="hidden" name="csrf" value="' . e(csrf_token()) . '">';
}

/** Rechaza la peticion si no es POST con token CSRF valido. */
function csrf_check(): void
{
    $enviado = $_POST['csrf'] ?? '';
    if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !hash_equals($_SESSION['csrf'] ?? '', $enviado)) {
        http_response_code(400);
        exit('Solicitud no valida.');
    }
}

/** Lee un entero de $_GET con valor por defecto. */
function get_int(string $clave, int $defecto = 0): int
{
    $v = filter_input(INPUT_GET, $clave, FILTER_VALIDATE_INT);
    return ($v === false || $v === null) ? $defecto : $v;
}
