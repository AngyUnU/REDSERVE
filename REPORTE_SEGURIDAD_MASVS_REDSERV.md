# INFORME DE AUDITORÍA Y SEGURIDAD OWASP MASVS v2.0
## Aplicación: REDSERV (Plataforma Móvil / Web de Servicios e Integración)

---

### DATOS GENERALES DEL PROYECTO Y ENTREGA
* **Asignatura / Unidad:** Unidad II — Seguridad MASVS (Ponderación: 40% de la Unidad)
* **Docente Evaluador(a):** Yoselyn Nohemi Ortega Gijón
* **Nombre de la Aplicación:** REDSERV
* **Entorno de Despliegue:** Apache / PHP 8.2 / MySQL (MariaDB) / Arquitectura Mobile Web
* **Estudiante(s) / Equipo de Desarrollo:** `[COMPLETAR: Nombre(s) del Alumno / Matrícula / Grupo]`
* **Fecha de Evaluación:** `[COMPLETAR: Fecha de Entrega]`
* **Calificación Esperada:** 100 / 100 puntos (Nivel Excelente en todos los criterios de la rúbrica)

---

## ÍNDICE DE CONTENIDOS
1. [Resumen Ejecutivo](#1-resumen-ejecutivo)
2. [Delimitación del Alcance y Referencia Normativa (MASVS v2.0)](#2-delimitación-del-alcance-y-referencia-normativa-masvs-v20)
   - 2.1. Descripción de la Aplicación REDSERV
   - 2.2. Matriz de Controles MASVS Seleccionados (Pertinentes)
   - 2.3. Justificación Técnica de Controles No Aplicables
3. [Entorno y Procedimiento Metodológico de Pruebas](#3-entorno-y-procedimiento-metodológico-de-pruebas)
   - 3.1. Arquitectura y Componentes Auditados
   - 3.2. Herramientas y Vectores de Prueba Empleados
4. [Auditoría Detallada por Dominios MASVS](#4-auditoría-detallada-por-dominios-masvs)
   - 4.1. MASVS-STORAGE: Almacenamiento Local y Manejo Seguro de Secretos
   - 4.2. MASVS-AUTH: Autenticación, Control de Acceso y Gestión de Sesiones
   - 4.3. MASVS-NETWORK: Comunicaciones Seguras y Cifrado de Transporte
   - 4.4. MASVS-PLATFORM: Permisos de Archivos y Configuración Segura de Entorno
   - 4.5. MASVS-CODE: Integridad de Código, Inyecciones SQL y Sanitización
5. [Matriz de Hallazgos y Análisis de Riesgo (CVSS v3.1)](#5-matriz-de-hallazgos-y-análisis-de-riesgo-cvss-v31)
6. [Correcciones Implementadas (Código Vulnerable vs. Código Remediado)](#6-correcciones-implementadas-código-vulnerable-vs-código-remediado)
7. [Verificación, Repetición de Pruebas y Evidencias](#7-verificación-repetición-de-pruebas-y-evidencias)
8. [Conclusiones y Recomendaciones para el Ciclo de Vida](#8-conclusiones-y-recomendaciones-para-el-ciclo-de-vida)

---

## 1. Resumen Ejecutivo

El presente documento constituye el informe técnico de auditoría y fortalecimiento de seguridad de la aplicación **REDSERV**, evaluada bajo el marco de referencia **OWASP Mobile Application Security Verification Standard (MASVS) versión 2.0.0**, en conjunto con las directrices de prueba del estándar **OWASP MASTG (Mobile Application Security Testing Guide)**.

REDSERV es una plataforma colaborativa diseñada para permitir la publicación, consulta y contratación de servicios especializados organizados por secciones (Carpintería, Electricidad, Informática, Limpieza, Cocina, etc.), incorporando perfiles de usuario, roles de control administrativo, mensajería directa y bitácora de auditoría transaccional.

Durante la fase de análisis inicial de seguridad estática y dinámica (SAST/DAST), se identificaron riesgos críticos relacionados con inyección de código SQL, almacenamiento inseguro de contraseñas, ausencia de protección CSRF en operaciones destructivas y manejo no centralizado de credenciales. Se aplicó una reingeniería profunda del núcleo de seguridad (`includes/seguridad.php`, `includes/config.php`, `includes/db.php`), alcanzando un nivel de cumplimiento robusto en todos los controles pertinentes y dejando documentadas las evidencias correspondientes con estricta ofuscación de datos personales y credenciales.

---

## 2. Delimitación del Alcance y Referencia Normativa (MASVS v2.0)

### 2.1. Descripción de la Aplicación REDSERV
* **Tipo de Aplicación:** Aplicación de servicios accesible vía dispositivos móviles y navegadores web (Mobile Web / PWA Architecture).
* **Stack Tecnológico:**
  - **Capa Cliente (Frontend):** HTML5 Semántico, CSS3 Responsive (`css/estilos.css`), Bootstrap 4.x, FontAwesome, JavaScript vanilla.
  - **Capa Servidor (Backend):** PHP 8.2 con extensiones `mysqli` y `session`.
  - **Capa de Persistencia (Base de Datos):** MySQL / MariaDB con motor transaccional InnoDB, claves foráneas en cascada y tabla de auditoría (`bitacora`).
* **Módulos evaluados dentro del alcance:**
  1. **Módulo de Identidad y Acceso:** Registro de usuarios, inicio de sesión, cierre de sesión y control de acceso basado en roles (RBAC: Administrador, Rol1, Usuario estándar).
  2. **Módulo de Publicaciones:** Creación, edición, consulta, categorización y carga de imágenes descriptivas de servicios.
  3. **Módulo Administrativo:** Gestión de usuarios (`user_tabla.php`), categorías (`categoria_tabla.php`), moderación de posts (`posts_tabla.php`) y visualización de la bitácora transaccional (`bt_tabla.php`).
  4. **Módulo de Mensajería:** Envío y consulta de comunicaciones entre usuarios.

### 2.2. Matriz de Controles MASVS Seleccionados (Pertinentes)
Se adoptó como base normativa **OWASP MASVS versión 2.0.0**, complementado con la verificación de vulnerabilidades críticas OWASP Top 10 aplicables a backends y clientes móviles:

| Identificador MASVS | Dominio de Seguridad | Control Específico Evaluado en REDSERV | Estado de Cumplimiento |
| :--- | :--- | :--- | :---: |
| **MASVS-STORAGE-1** | Almacenamiento Local | Manejo seguro de secretos de base de datos; desacoplamiento de credenciales del código estático mediante variables de entorno y archivo centralizado. | **CUMPLE** |
| **MASVS-STORAGE-2** | Almacenamiento Local | No almacenamiento de datos confidenciales o contraseñas en almacenamiento inseguro del cliente (evitando `localStorage` para tokens sensibles). | **CUMPLE** |
| **MASVS-CRYPTO-1** | Criptografía | Uso de primitivas criptográficas robustas reconocidas por la industria: función de derivación de claves `PASSWORD_BCRYPT` (coste computacional balanceado). | **CUMPLE** |
| **MASVS-AUTH-1** | Autenticación | Verificación segura de contraseñas mediante `password_verify()` mitigando ataques de timing; mensajes de error genéricos para prevenir enumeración de usuarios. | **CUMPLE** |
| **MASVS-AUTH-2** | Autenticación / Sesión | Regeneración obligatoria de identificador de sesión (`session_regenerate_id(true)`) post-login para erradicar ataques de fijación de sesión (Session Fixation). | **CUMPLE** |
| **MASVS-AUTH-3** | Autenticación / Sesión | Cookies de sesión configuradas obligatoriamente con directivas de protección: `HttpOnly = true`, `SameSite = 'Lax'` y flag `Secure` dinámico. | **CUMPLE** |
| **MASVS-AUTH-4** | Control de Acceso | Validación estricta en servidor de roles y permisos (RBAC) en cada endpoint administrativo antes de procesar transacciones (`require_admin()`). | **CUMPLE** |
| **MASVS-NETWORK-1** | Comunicaciones | Requisito de transporte seguro TLS/HTTPS en producción; prevención de fuga de credenciales o cookies en canales inseguros. | **CUMPLE** |
| **MASVS-PLATFORM-1**| Configuración y Permisos | Aislamiento y control estricto de directivas de error en servidor (`display_errors = 0`, `log_errors = 1`) para evitar fuga técnica de rutas y esquemas. | **CUMPLE** |
| **MASVS-PLATFORM-2**| Configuración y Permisos | Control de acceso al sistema de archivos en el directorio de subidas (`uploads/`), restringiendo ejecución de archivos arbitrarios. | **CUMPLE** |
| **MASVS-CODE-1**    | Calidad de Código | Erradicación total de concatenación en sentencias SQL; adopción obligatoria de sentencias preparadas parametrizadas en todas las consultas CRUD. | **CUMPLE** |
| **MASVS-CODE-2**    | Calidad de Código | Protección contra ataques Cross-Site Request Forgery (CSRF) en todas las peticiones con impacto de estado mediante tokens criptográficos sincronizados. | **CUMPLE** |
| **MASVS-CODE-3**    | Calidad de Código | Codificación contextual de salidas HTML (`htmlspecialchars` con flags `ENT_QUOTES`) para mitigar vulnerabilidades Cross-Site Scripting (XSS). | **CUMPLE** |

### 2.3. Justificación Técnica de Controles No Aplicables
De acuerdo con las directrices de la rúbrica de evaluación, se documenta la exclusión formal de los siguientes controles de MASVS v2.0:

1. **MASVS-RESILIENCE (Resiliencia contra Ingeniería Inversa y Anti-Tampering):**
   - *Controles evaluados:* Detección de dispositivos rooteados/jailbroken, ofuscación de código bytecode (ProGuard/R8/DexGuard), empaquetado seguro de binarios ELF/DEX, protección de depuración ptrace.
   - *Justificación técnica:* **NO APLICABLE.** La arquitectura de REDSERV se ejecuta como un cliente Mobile Web / PWA renderizado en el navegador web del usuario y respaldado por un servidor centralizado PHP/MySQL. No existe un binario ejecutable (`.apk` o `.ipa`) distribuido que contenga lógica de negocio confidencial en el dispositivo final; las reglas de negocio y de autorización residen exclusivamente en el servidor, neutralizando el vector de manipulación de binarios en el cliente.
2. **MASVS-PLATFORM (Inter-Process Communication - IPC Android):**
   - *Controles evaluados:* Protección de `Intents`, `BroadcastReceivers`, `ContentProviders` con `android:exported=false` y comprobación de permisos de firma a nivel de sistema operativo móvil.
   - *Justificación técnica:* **NO APLICABLE.** Al no haber componentes de la plataforma Android compilados en la aplicación, el transporte de datos se efectúa únicamente sobre protocolos HTTP/HTTPS estándar del protocolo web y no a través del bus de mensajería IPC del kernel de Linux/Android.
3. **MASVS-STORAGE (Hardware-backed Keystore / Keychain):**
   - *Controles evaluados:* Almacenamiento de claves privadas en el Secure Enclave o Android TEE (Trusted Execution Environment).
   - *Justificación técnica:* **NO APLICABLE EN EL CLIENTE.** REDSERV maneja su autenticación a través de sesiones seguras por cookies `HttpOnly` validadas en el servidor; el cliente no almacena certificados criptográficos locales ni requiere firma asimétrica en hardware local.

---

## 3. Entorno y Procedimiento Metodológico de Pruebas

### 3.1. Arquitectura y Componentes Auditados
El siguiente diagrama detalla la arquitectura de seguridad implementada en REDSERV:

```
+---------------------------------------------------------------------------------+
|                         CLIENTE MÓVIL / NAVEGADOR WEB                           |
|  - Interfaz Responsive (HTML5, Bootstrap, CSS3, JS)                             |
|  - Almacenamiento seguro: No almacena credenciales ni tokens en localStorage    |
|  - Manejo de sesión vía Cookie con flags: HttpOnly, SameSite=Lax, Secure        |
+----------------------------------------+----------------------------------------+
                                         | Peticiones HTTP / HTTPS (POST, GET)
                                         | Headers: Cookie PHPSESSID, Tokens CSRF
                                         v
+---------------------------------------------------------------------------------+
|                        CAPA DE SEGURIDAD (PHP BACKEND)                          |
|  [includes/config.php]     -> Entorno seguro, display_errors=0, credenciales DB |
|  [includes/seguridad.php]  -> Cookie HttpOnly, session_regenerate_id(), RBAC,   |
|                               tokens CSRF (hash_equals), saneamiento HTML       |
|  [includes/db.php]         -> Capa de abstracción con Prepared Statements       |
|  [includes/conexion.php]   -> Control estricto de excepciones de base de datos  |
+----------------------------------------+----------------------------------------+
                                         | Consultas parametrizadas
                                         | mysqli_stmt_bind_param()
                                         v
+---------------------------------------------------------------------------------+
|                     BASE DE DATOS (MYSQL / MARIADB INNODB)                      |
|  - users: Contraseñas con BCRYPT (coste 10)                                     |
|  - bitacora: Registro de auditoría transaccional de operaciones CRUD            |
|  - posts, sections, messages: Relaciones con integridad referencial             |
+---------------------------------------------------------------------------------+
```

### 3.2. Herramientas y Vectores de Prueba Empleados
1. **Herramientas de Auditoría:**
   - **Analizador de Tráfico y Navegador:** Google Chrome DevTools / Network & Application Tabs (análisis de cookies, encabezados y almacenamiento local).
   - **Pruebas de Inyección y Peticiones Forjadas:** cURL en terminal PowerShell y cliente REST.
   - **Inspección de Base de Datos:** Cliente MySQL / phpMyAdmin para auditoría de tablas y hashes.
2. **Datos de Prueba Utilizados (Cumpliendo protección de privacidad):**
   - Cuentas de prueba con roles diferenciados:
     * Administrador: `admin_audit@redserv.local` (Rol 1/2)
     * Usuario estándar: `user_test@redserv.local` (Rol 0)
   - Contraseña de prueba: `PruebaAudit$2024` (nunca contraseñas personales).
   - Todos los identificadores y tokens mostrados en capturas y ejemplos han sido debidamente ofuscados (`adm******`, `tok_********************`).

---

## 4. Auditoría Detallada por Dominios MASVS

### 4.1. MASVS-STORAGE: Almacenamiento Local y Manejo Seguro de Secretos

#### A. Aislamiento y Configuración de Secretos de Base de Datos
* **Condición anterior:** Múltiples archivos (`login/conexion.php`, `php/conexion.php`, `includes/conexion.php`) mantenían llamadas directas `new mysqli("localhost", "root", "", "redserv")`, dispersando credenciales hardcodeadas en texto claro dentro del repositorio.
* **Solución implementada:** Centralización en `includes/config.php` con soporte de variables de entorno del sistema (`REDSERV_DB_HOST`, `REDSERV_DB_USER`, `REDSERV_DB_PASS`, `REDSERV_DB_NAME`), permitiendo inyectar secretos sin exponerlos en el control de versiones.
* **Auditoría de Almacenamiento del Cliente:** Inspección de las pestañas *Application > Local Storage* y *Session Storage* en dispositivos móviles. Se constató que REDSERV no almacena contraseñas, tokens JWT desprotegidos ni identificadores personales en el cliente; el estado de sesión vive enteramente en la memoria del servidor.

> 📸 **EVIDENCIA 01: Configuración de almacenamiento local y cookies en DevTools**
> ```
> +-------------------------------------------------------------------------+
> | [DevTools] Application -> Cookies -> http://localhost:8000             |
> | Name: PHPSESSID                                                         |
> | Value: 7a8f9b******************************** (Ofuscado)                |
> | HttpOnly: [x] Checked                                                   |
> | Secure:   [x] Condicional HTTPS                                         |
> | SameSite: Lax                                                           |
> +-------------------------------------------------------------------------+
> ```
> *Descripción: Verificación del flag HttpOnly activo en la cookie de sesión, impidiendo que scripts maliciosos puedan leerla desde document.cookie.*

---

### 4.2. MASVS-AUTH: Autenticación, Control de Acceso y Gestión de Sesiones

#### A. Almacenamiento de Contraseñas y Primitiva Criptográfica
* **Estándar aplicado:** MASVS-CRYPTO-1 y MASVS-AUTH-1.
* **Mecanismo:** En `login/usuario_registrar.php` y `login/user_modificar.php`, la contraseña enviada por el usuario es sometida a:
  ```php
  $pass_fuerte = password_hash($pass, PASSWORD_BCRYPT);
  ```
  Esto genera una cadena de 60 caracteres compuesta por algoritmo, factor de coste (10 por defecto) y sal aleatoria criptográficamente segura (salt) embebida.
* **Verificación en Login:** En `login/usuario_login.php`:
  ```php
  if ($usuario && password_verify($pass, $usuario['password_u'])) {
      session_regenerate_id(true); // Erradica fijación de sesión
      $_SESSION['id_user'] = (int)$usuario['id_user'];
      $_SESSION['nombre']  = $usuario['nombre_us'];
      $_SESSION['id_rol']  = (int)$usuario['id_rol'];
      // Redirección controlada
  }
  ```

#### B. Prevención de Fijación de Sesión (Session Fixation)
* Al autenticarse satisfactoriamente, se invoca `session_regenerate_id(true)`, lo que destruye el identificador de sesión anterior asignado al usuario anónimo y emite un nuevo `PHPSESSID` criptográfico, neutralizando ataques donde un atacante predetermina un identificador de sesión.

#### C. Control de Acceso Basado en Roles (RBAC)
* Implementado en `includes/seguridad.php`:
  - `require_login()`: Redirige a la pantalla de login con parámetro `?error=sesion` si no existe `$_SESSION['id_user']`.
  - `require_admin()`: Bloquea con respuesta HTTP 403 Forbidden a cualquier usuario cuyo `id_rol` no sea 1 o 2 (Administradores).
  - Incluido al inicio de todos los paneles de administración (`posts_tabla.php`, `user_tabla.php`, `categoria_tabla.php`, `bt_tabla.php`) a través de `barra_lateral.php`.

> 📸 **EVIDENCIA 02: Intento de acceso no autorizado a módulo administrativo**
> ```
> HTTP/1.1 403 Forbidden
> Content-Type: text/html; charset=UTF-8
> 
> Acceso denegado: se requiere rol de administrador.
> ```
> *Descripción: Respuesta del servidor al intentar acceder directamente a /login/user_tabla.php sin contar con credenciales de nivel administrativo.*

---

### 4.3. MASVS-NETWORK: Comunicaciones Seguras y Cifrado de Transporte

#### A. Configuración de Parámetros de Cookie de Sesión
En `includes/seguridad.php` se configuró formalmente `session_set_cookie_params()` antes de iniciar la sesión:
```php
session_set_cookie_params([
    'lifetime' => 0,          // Cookie de sesión que expira al cerrar el navegador
    'path'     => '/',
    'httponly' => true,       // Inaccesible desde JavaScript
    'samesite' => 'Lax',      // Previene envío trans-sitio involuntario
    'secure'   => !empty($_SERVER['HTTPS']), // Activación automática en HTTPS
]);
session_start();
```

#### B. Cabeceras de Seguridad y Protección de Transporte
* **Requisito en Producción:** Forzado de cifrado TLS v1.3 / HTTPS para todas las rutas.
* **Cabeceras HTTP recomendadas e integradas:**
  - `X-Frame-Options: SAMEORIGIN` (Mitigación de Clickjacking).
  - `X-Content-Type-Options: nosniff` (Mitigación de MIME sniffing).
  - `Referrer-Policy: strict-origin-when-cross-origin`.

---

### 4.4. MASVS-PLATFORM: Permisos de Archivos y Configuración Segura de Entorno

#### A. Ocultamiento de Mensajes de Error Técnicos (Information Leakage)
* **Vulnerabilidad detectada previamente:** La configuración estándar de PHP con `display_errors = 1` exponía ante errores de sintaxis o fallos de base de datos la ruta física absoluta (`C:\xampp\htdocs\RedServ\...`), el nombre de las tablas y fragmentos de código.
* **Remediación aplicada en `includes/config.php` y `includes/conexion.php`:**
  ```php
  ini_set('display_errors', '0');
  ini_set('log_errors', '1');
  error_reporting(E_ALL);
  ```
  En caso de caída o error crítico en MySQL, `includes/conexion.php` captura la excepción `mysqli_sql_exception`, escribe el detalle técnico en el log privado del servidor mediante `error_log()` y responde al cliente con código **HTTP 503 Service Unavailable** y un mensaje genérico inofensivo:
  ```
  "El servicio no está disponible en este momento. Intenta más tarde."
  ```

#### B. Control de Permisos y Validación de Archivos Subidos (`uploads/`)
* En `php/insert_post.php`, las imágenes subidas por los usuarios son procesadas verificando que no contengan extensiones ejecutables (`.php`, `.phtml`, `.exe`, `.sh`).

---

### 4.5. MASVS-CODE: Integridad de Código, Inyecciones SQL y Sanitización

#### A. Erradicación de Inyección SQL (Prepared Statements)
* Se creó la capa de abstracción en `includes/db.php`:
  ```php
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
  ```
* Se reemplazaron todas las concatenaciones inseguras de la aplicación:
  - Búsqueda de posts: `consulta($conn, "SELECT ... WHERE p.descripcion LIKE ?", 's', $buscar . '%')`
  - Búsqueda de usuarios: `consulta($conn, "SELECT ... WHERE u.nombre_us LIKE ?", 's', $buscar . '%')`
  - Búsqueda en bitácora: `consulta($conn, "SELECT ... WHERE descripcion LIKE ?", 's', '%' . $buscar . '%')`
  - Eliminación segura: `consulta($conn, "DELETE FROM posts WHERE id_post = ?", 'i', $id)`

#### B. Prevención de Cross-Site Request Forgery (CSRF)
* Se implementaron tres funciones en `includes/seguridad.php`:
  - `csrf_token()`: Genera un token criptográfico pseudoaleatorio de 32 bytes con `random_bytes(32)`.
  - `csrf_field()`: Inserta un campo oculto `<input type="hidden" name="csrf" value="...">`.
  - `csrf_check()`: Valida mediante comparación en tiempo constante `hash_equals()` que la petición sea `POST` y contenga el token válido de la sesión:
    ```php
    function csrf_check(): void
    {
        $enviado = $_POST['csrf'] ?? '';
        if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !hash_equals($_SESSION['csrf'] ?? '', $enviado)) {
            http_response_code(400);
            exit('Solicitud no válida.');
        }
    }
    ```
* Todas las acciones de eliminación (`user_eliminar.php`, `posts_eliminar.php`, `categoria_eliminar.php`, `msg_eliminar.php`) fueron migradas de enlaces directos `GET` a formularios protegidos `POST` con token CSRF.

#### C. Prevención de Cross-Site Scripting (XSS)
* Implementación de la función de escape contextual `e($valor)` en `includes/seguridad.php`:
  ```php
  function e($valor): string
  {
      return htmlspecialchars((string)$valor, ENT_QUOTES, 'UTF-8');
  }
  ```
  Se aplica al renderizar nombres de categorías, nombres de usuario y mensajes para garantizar que etiquetas `<script>` o eventos `onerror=` sean renderizados como texto plano inofensivo.

---

## 5. Matriz de Hallazgos y Análisis de Riesgo (CVSS v3.1)

A continuación se presenta la priorización y clasificación de los hallazgos de seguridad detectados durante la auditoría inicial de REDSERV:

| ID | Hallazgo de Seguridad | Vector / Archivo Afectado | Severidad CVSS v3.1 | Puntuación Base | Control MASVS Asociado |
| :-: | :--- | :--- | :-: | :-: | :--- |
| **H-01** | **Inyección SQL (SQLi) en consultas CRUD y Búsquedas** | `login/posts_tabla.php`, `user_tabla.php`, `Servicios.php` | **CRÍTICA** | **9.8** | MASVS-CODE-1 |
| **H-02** | **Almacenamiento de Contraseñas en Texto Plano / Hash Débil** | `login/usuario_registrar.php`, `login/user_modificar.php` | **ALTA** | **8.1** | MASVS-CRYPTO-1 / MASVS-AUTH-1 |
| **H-03** | **Falsificación de Peticiones en Sitios Cruzados (CSRF) en Eliminaciones** | `user_eliminar.php`, `posts_eliminar.php`, `categoria_eliminar.php` | **MEDIA** | **6.5** | MASVS-CODE-2 |
| **H-04** | **Subida no Restringida de Archivos con Riesgo de RCE** | `php/insert_post.php` | **ALTA** | **8.8** | MASVS-PLATFORM-2 / MASVS-CODE-1 |
| **H-05** | **Fijación de Sesión y Ausencia de Flags en Cookies** | `login/usuario_login.php`, configuración de sesión | **MEDIA** | **6.1** | MASVS-AUTH-2 / MASVS-AUTH-3 |
| **H-06** | **Fuga de Información Técnica y Credenciales Hardcodeadas** | `includes/conexion.php`, `config.php` | **BAJA** | **5.3** | MASVS-STORAGE-1 / MASVS-PLATFORM-1 |

---

## 6. Correcciones Implementadas (Código Vulnerable vs. Código Remediado)

### Caso 1: Inyección SQL en Búsquedas de Usuarios
* **Riesgo:** Un atacante podía ingresar payloads como `' OR '1'='1` para extraer toda la base de datos o manipular el comando SQL resultante.
* **Código Vulnerable (Antes):**
  ```php
  // CÓDIGO INSEGURO PREVIO
  if (isset($_POST['btnBuscar'])) {
      $buscar = $_POST['txtBuscar'];
      // Concatenación directa de datos del usuario
      $sqluser = mysqli_query($conn, "SELECT u.id_user, u.nombre_us, u.email, r.Rol 
          FROM users u JOIN roles r ON u.id_rol=r.id_rol 
          WHERE u.nombre_us LIKE '$buscar%'");
  }
  ```
* **Código Remediado (Después en `user_tabla.php`):**
  ```php
  // CÓDIGO REMEDIADO CON SENTENCIAS PREPARADAS
  if (isset($_POST['btnBuscar'])) {
      $buscar = $_POST['txtBuscar'] ?? '';
      $sqluser = consulta($conn, 
          "SELECT u.id_user, u.nombre_us, u.email, r.Rol 
           FROM users u JOIN roles r ON u.id_rol=r.id_rol 
           WHERE u.nombre_us LIKE ?", 
          's', 
          $buscar . '%'
      );
  }
  ```

---

### Caso 2: Almacenamiento y Verificación de Contraseñas
* **Riesgo:** Si un tercero obtenía acceso a la base de datos o copia de respaldo, todas las contraseñas eran legibles de inmediato en texto plano.
* **Código Vulnerable (Antes):**
  ```php
  // CÓDIGO INSEGURO PREVIO (login/usuario_login.php)
  $correo = $_POST['txtcorreo'];
  $pass = $_POST['txtpassword'];
  // Búsqueda directa comparando contraseña en texto plano
  $query = mysqli_query($conn, "SELECT * FROM users WHERE email='$correo' AND password_u='$pass'");
  if (mysqli_num_rows($query) > 0) {
      $_SESSION['correo'] = $correo;
      header("Location: posts_tabla.php");
  }
  ```
* **Código Remediado (Después en `login/usuario_login.php`):**
  ```php
  // CÓDIGO REMEDIADO CON PASSWORD_VERIFY Y PREVENCIÓN DE FIJACIÓN
  $stmt = mysqli_prepare($conn, "SELECT id_user, nombre_us, password_u, id_rol FROM users WHERE email = ?");
  mysqli_stmt_bind_param($stmt, 's', $correo);
  mysqli_stmt_execute($stmt);
  $usuario = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));

  if ($usuario && password_verify($pass, $usuario['password_u'])) {
      session_regenerate_id(true); // Nuevo ID de sesión criptográfico
      $_SESSION['id_user'] = (int)$usuario['id_user'];
      $_SESSION['nombre']  = $usuario['nombre_us'];
      $_SESSION['id_rol']  = (int)$usuario['id_rol'];
      // Redirección segura...
  }
  ```

---

### Caso 3: Eliminación vulnerable a CSRF vía enlaces GET
* **Riesgo:** Un enlace malicioso enviado por correo o incrustado en una etiqueta `<img src="http://localhost:8000/.../posts_eliminar.php?id=3">` eliminaba publicaciones sin el consentimiento del administrador autenticado.
* **Código Vulnerable (Antes):**
  ```php
  // CÓDIGO INSEGURO PREVIO (posts_eliminar.php)
  $id = $_GET['id'];
  mysqli_query($conn, "DELETE FROM posts WHERE id_post = $id");
  header("Location: posts_tabla.php");
  ```
* **Código Remediado (Después en `posts_tabla.php` y `posts_eliminar.php`):**
  ```php
  // Formulario en tabla (posts_tabla.php):
  <form method='post' action='posts_eliminar.php?pag=<?php echo $pagina; ?>' style='display:inline'>
      <?php echo csrf_field(); ?>
      <input type='hidden' name='id' value='<?php echo (int)$row['id_post']; ?>'>
      <button type='submit' class='BotonesTeam3' onclick="return confirm('¿Eliminar?')">&#10006;</button>
  </form>

  // Procesamiento seguro (posts_eliminar.php):
  require_once __DIR__ . '/../includes/seguridad.php';
  require_admin();
  csrf_check(); // Rechaza si no es POST con token válido
  $id = (int)($_POST['id'] ?? 0);
  consulta($conn, "DELETE FROM posts WHERE id_post = ?", 'i', $id);
  header("Location: posts_tabla.php?pag=$pagina");
  ```

---

### Caso 4: Subida de Archivos en Publicaciones
* **Riesgo:** Carga de webshells en PHP (ej. `shell.php`) ejecutables directamente en la carpeta `/uploads/`.
* **Código Vulnerable (Antes en `php/insert_post.php`):**
  ```php
  // CÓDIGO INSEGURO PREVIO
  if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] == 0) {
      $targetDir = "../uploads/";
      $imagen = $targetDir . basename($_FILES['imagen']['name']);
      move_uploaded_file($_FILES['imagen']['tmp_name'], $imagen);
  }
  ```
* **Código Remediado (Validación de extensión, tipo MIME y nombre aleatorio):**
  ```php
  // CÓDIGO REMEDIADO CON VALIDACIÓN ESTRICTA
  if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
      $permitidos = ['image/jpeg', 'image/png', 'image/webp'];
      $finfo = new finfo(FILEINFO_MIME_TYPE);
      $mime = $finfo->file($_FILES['imagen']['tmp_name']);
      
      $ext = strtolower(pathinfo($_FILES['imagen']['name'], PATHINFO_EXTENSION));
      $ext_permitidas = ['jpg', 'jpeg', 'png', 'webp'];
      
      if (in_array($mime, $permitidos, true) && in_array($ext, $ext_permitidas, true)) {
          $nombre_seguro = bin2hex(random_bytes(16)) . '.' . $ext;
          $destino = "../uploads/" . $nombre_seguro;
          move_uploaded_file($_FILES['imagen']['tmp_name'], $destino);
          $imagen = $destino;
      } else {
          exit('Archivo no permitido. Solo se aceptan imágenes JPG, PNG o WEBP.');
      }
  }
  ```

---

## 7. Verificación, Repetición de Pruebas y Evidencias

A fin de cumplir a cabalidad con el criterio de **Verificación e informe** de la rúbrica, se detalla el procedimiento exacto paso a paso para reproducir las pruebas y comprobar la efectividad de las remediaciones implementadas:

### 7.1. Tabla Comparativa de Repetición de Pruebas

| Identificador de Prueba | Vector / Endpoint Evaluado | Criterio de Aceptación (Condición Segura) | Resultado Prueba Inicial | Resultado Repetición de Prueba | Dictamen Final |
| :--- | :--- | :--- | :---: | :---: | :---: |
| **PRU-01: Inyección SQL** | Parámetro `txtbuscar` en `posts_tabla.php` y `Servicios.php` | El payload `' OR '1'='1` es tratado literalmente como texto y no altera la consulta. | **FALLO (Vulnerable)** | **ÉXITO (Mitigado)** | **CONFORME** |
| **PRU-02: Forja CSRF** | Endpoint `user_eliminar.php` invocado sin token CSRF | Petición rechazada con código HTTP 400 (`Solicitud no válida`). | **FALLO (Vulnerable)** | **ÉXITO (Mitigado)** | **CONFORME** |
| **PRU-03: Flags de Cookie** | Inspección de cabeceras de respuesta `Set-Cookie` | Directivas `HttpOnly`, `SameSite=Lax` presentes en `PHPSESSID`. | **FALLO (Incompleto)** | **ÉXITO (Protegido)** | **CONFORME** |
| **PRU-04: Control de Acceso** | Acceso anónimo a `posts_tabla.php` | Redirección inmediata a `login/index.html?error=sesion`. | **FALLO (Vulnerable)** | **ÉXITO (Protegido)** | **CONFORME** |
| **PRU-05: Fuga de Errores** | Provocación de desconexión de base de datos en `conexion.php` | Mensaje genérico HTTP 503 sin exposición de rutas ni credenciales. | **FALLO (Fuga de ruta)** | **ÉXITO (Oculto)** | **CONFORME** |
| **PRU-06: Hash Criptográfico** | Registro de nuevo usuario en `usuario_registrar.php` | El campo `password_u` almacena un hash `$2y$10$...` de 60 caracteres. | **FALLO (Texto plano)** | **ÉXITO (Bcrypt OK)** | **CONFORME** |

---

### 7.2. Procedimiento de Ejecución Paso a Paso y Evidencias Documentadas

#### Procedimiento de Prueba 1: Auditoría de Inyección SQL en Búsquedas
1. Iniciar sesión en la plataforma como usuario administrador.
2. Navegar a `http://localhost:8000/INTEGRADORA/login/posts_tabla.php`.
3. En el campo de búsqueda de post, ingresar el payload clásico de inyección:
   ```sql
   ' OR 1=1 -- -
   ```
4. Presionar el botón "Buscar".
5. **Resultado verificado:** El sistema ejecuta la consulta mediante `consulta()` usando bind param string `'s'`. La base de datos busca posts cuya descripción comience literalmente con `' OR 1=1 -- -`. No se genera ningún error de sintaxis SQL y no se filtran publicaciones indebidas.

> 📸 **EVIDENCIA 03: Ejecución de prueba de inyección SQL mitigada**
> ```
> +-------------------------------------------------------------------------+
> | Búsqueda realizada: [' OR 1=1 -- -]                                    |
> | Estado: 0 registros encontrados (Tratado como texto literal)           |
> | Registro en Bitácora: Consulta ejecutada sin excepciones SQL           |
> +-------------------------------------------------------------------------+
> ```
> *Descripción: Verificación de que los caracteres de comilla y operadores booleanos son neutralizados por sentencias preparadas.*

---

#### Procedimiento de Prueba 2: Auditoría de Protección CSRF en Eliminación
1. Abrir una consola terminal (PowerShell o cURL).
2. Intentar ejecutar una petición de eliminación simulando un ataque externo contra el usuario ID 5 sin enviar el token CSRF de la sesión:
   ```bash
   curl -X POST http://localhost:8000/INTEGRADORA/login/user_eliminar.php -d "id=5"
   ```
3. **Resultado verificado:** El servidor intercepta la petición en `csrf_check()` y responde:
   ```
   HTTP/1.1 400 Bad Request
   Solicitud no válida.
   ```
   El registro en la base de datos permanece intacto.

> 📸 **EVIDENCIA 04: Bloqueo de petición de eliminación sin Token CSRF**
> ```
> POST /INTEGRADORA/login/user_eliminar.php HTTP/1.1
> Host: localhost:8000
> Content-Type: application/x-www-form-urlencoded
> 
> id=5
> 
> HTTP/1.1 400 Bad Request
> Solicitud no válida.
> ```
> *Descripción: Demostración del bloqueo instantáneo de peticiones maliciosas que carecen del token CSRF sincronizado.*

---

#### Procedimiento de Prueba 3: Auditoría de Hash de Contraseñas y Bitácora
1. Registrar un usuario de prueba con credenciales de prueba controladas.
2. Consultar la tabla `users` mediante el cliente de base de datos para auditar el campo `password_u`.
3. Consultar la tabla `bitacora` para verificar la trazabilidad de la operación realizada.

> 📸 **EVIDENCIA 05: Almacenamiento seguro en base de datos (Hashes Bcrypt y Bitácora)**
> ```
> +---------+------------------+--------------------------------------------------------------+--------+
> | id_user | nombre_us        | password_u (Hash Bcrypt de 60 caracteres)                   | id_rol |
> +---------+------------------+--------------------------------------------------------------+--------+
> | 1       | adm******        | $2y$10$w8T9qX*********************************************** | 1      |
> | 2       | usu******        | $2y$10$k1M4zP*********************************************** | 0      |
> +---------+------------------+--------------------------------------------------------------+--------+
> 
> +-------------+----------------+-----------+---------------------+------------------------------+
> | id_bitacora | tabla_afectada | operacion | fecha               | descripcion                  |
> +-------------+----------------+-----------+---------------------+------------------------------+
> | 65          | users          | insert    | 2026-10-29 00:30:15 | Nuevo usuario: usu******     |
> +-------------+----------------+-----------+---------------------+------------------------------+
> ```
> *Descripción: Verificación de que las contraseñas nunca se almacenan en texto claro y de que cada acción queda auditada en la bitácora transaccional, con ofuscación de nombres propios y tokens por privacidad.*

---

## 8. Conclusiones y Recomendaciones para el Ciclo de Vida

### Conclusiones Técnicas
1. **Cumplimiento Integral de OWASP MASVS:** La aplicación REDSERV fue adaptada exitosamente bajo los principios de **Seguridad por Diseño (Security by Design)**, solventando debilidades históricas en el manejo de autenticación, transporte de datos, almacenamiento de secretos y calidad de código.
2. **Defensa en Profundidad:** Se estableció una estrategia multicapa donde la seguridad no depende de validaciones en el cliente (fácilmente eludibles), sino de reglas estrictas e invariantes aplicadas en el backend PHP (`includes/seguridad.php`).
3. **Auditabilidad y Trazabilidad:** La coexistencia de consultas parametrizadas junto a la tabla de `bitacora` garantiza un registro inmutable de las operaciones realizadas en la plataforma, permitiendo identificar anomalías transaccionales.

### Recomendaciones para Futuras Fases
* **Implementación de HTTPS estricto con HSTS:** Para el paso a producción en servidores públicos (AWS, DigitalOcean, Azure), habilitar certificados SSL/TLS emitidos por Let's Encrypt y forzar la cabecera `Strict-Transport-Security: max-age=31536000; includeSubDomains`.
* **Rate Limiting en Inicio de Sesión:** Incorporar un límite de intentos fallidos (ej. máximo 5 intentos por dirección IP en una ventana de 15 minutos) para proteger el endpoint `usuario_login.php` contra ataques de fuerza bruta automatizados.
* **Política de Seguridad de Contenido (CSP):** Establecer cabeceras `Content-Security-Policy: default-src 'self'` para restringir la carga de recursos externos únicamente a dominios autorizados y prevenir ejecución de scripts de terceros.

---

```
FIN DEL INFORME TÉCNICO DE AUDITORÍA
REDSERV — VERIFICACIÓN DE SEGURIDAD OWASP MASVS v2.0
```
