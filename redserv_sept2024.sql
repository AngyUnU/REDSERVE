-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 26-09-2024 a las 04:38:29
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `redserv`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bitacora`
--

CREATE TABLE `bitacora` (
  `id_bitacora` int(11) NOT NULL,
  `tabla_afectada` varchar(50) NOT NULL,
  `operacion` varchar(20) NOT NULL,
  `fecha` datetime NOT NULL DEFAULT current_timestamp(),
  `descripcion` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `bitacora`
--

INSERT INTO `bitacora` (`id_bitacora`, `tabla_afectada`, `operacion`, `fecha`, `descripcion`) VALUES
(1, 'roles ', ' insert ', '2024-08-06 17:26:30', 'Nuevo rol: user'),
(2, 'roles ', ' insert ', '2024-08-06 17:26:30', 'Nuevo rol: Administrador'),
(3, 'roles ', ' insert ', '2024-08-06 17:26:30', 'Nuevo rol: Rol1'),
(4, 'sections ', ' insert ', '2024-08-06 17:26:30', 'Nueva seccion: Limpieza'),
(5, 'sections ', ' insert ', '2024-08-06 17:26:30', 'Nueva seccion: Cocina'),
(6, 'sections ', ' insert ', '2024-08-06 17:26:30', 'Nueva seccion: Informatica'),
(7, 'sections ', ' insert ', '2024-08-06 17:26:30', 'Nueva seccion: Oficina'),
(8, 'users ', ' insert ', '2024-08-06 17:26:30', 'Nuevo usuario: admin'),
(9, 'users ', ' insert ', '2024-08-06 17:26:30', 'Nuevo usuario: susana'),
(10, 'users ', ' insert ', '2024-08-06 17:26:30', 'Nuevo usuario: ss'),
(11, 'users ', ' insert ', '2024-08-06 11:31:47', 'Nuevo usuario: gloria'),
(12, 'posts ', ' insert ', '2024-08-06 11:36:48', 'Nuevo post de: Armando'),
(13, 'sections', 'update', '2024-08-06 12:10:04', 'Actualización de la seccion: Limpieza'),
(14, 'sections', 'delete', '2024-08-06 12:10:14', 'Eliminación de la seccion: Oficina'),
(15, 'sections ', ' insert ', '2024-08-06 12:11:03', 'Nueva seccion: oficina'),
(16, 'users ', ' insert ', '2024-08-06 17:49:58', 'Nuevo usuario: Josue'),
(17, 'users ', ' insert ', '2024-08-07 03:32:11', 'Nuevo usuario: H'),
(18, 'messages ', ' insert ', '2024-08-07 10:35:05', 'Nuevo mensaje de: otp'),
(19, 'users ', ' insert ', '2024-08-07 14:43:57', 'Nuevo usuario: gloria'),
(20, 'sections ', ' insert ', '2024-08-07 14:54:27', 'Nueva seccion: Carpinteria'),
(21, 'sections', 'delete', '2024-08-07 14:55:06', 'Eliminación de la seccion: Carpinteria'),
(22, 'users ', ' insert ', '2024-08-07 15:10:34', 'Nuevo usuario: pug'),
(23, 'users ', ' insert ', '2024-08-07 15:35:41', 'Nuevo usuario: Idalia'),
(24, 'users ', ' insert ', '2024-08-07 15:36:36', 'Nuevo usuario: idalia'),
(25, 'posts ', ' insert ', '2024-08-07 15:38:51', 'Nuevo post de: Idalia Aritzel'),
(26, 'messages ', ' insert ', '2024-08-07 15:40:18', 'Nuevo mensaje de: Deyanira'),
(27, 'sections ', ' insert ', '2024-08-07 15:43:48', 'Nueva seccion: belleza'),
(28, 'sections', 'update', '2024-08-07 15:44:25', 'Actualización de la seccion: belleza'),
(29, 'sections', 'delete', '2024-08-07 15:44:42', 'Eliminación de la seccion: belleza'),
(30, 'users ', ' insert ', '2024-08-07 16:14:25', 'Nuevo usuario: JOSE'),
(31, 'users ', ' insert ', '2024-08-07 16:17:39', 'Nuevo usuario: Edgar'),
(32, 'posts ', ' insert ', '2024-08-07 16:18:51', 'Nuevo post de: Deyan'),
(33, 'messages ', ' insert ', '2024-08-07 16:22:17', 'Nuevo mensaje de: josue'),
(34, 'users', 'update', '2024-08-07 16:29:00', 'Actualización del usuario: maria'),
(35, 'users', 'delete', '2024-08-07 16:29:23', 'Eliminación del usuario: maria'),
(36, 'users ', ' insert ', '2024-08-07 16:29:57', 'Nuevo usuario: Ana'),
(37, 'users ', ' insert ', '2024-08-07 17:26:01', 'Nuevo usuario: josue'),
(38, 'posts ', ' insert ', '2024-08-07 17:27:05', 'Nuevo post de: JOSUE'),
(39, 'messages ', ' insert ', '2024-08-07 17:28:14', 'Nuevo mensaje de: Josue p'),
(40, 'users', 'update', '2024-08-07 17:29:59', 'Actualización del usuario: Mario'),
(41, 'users', 'delete', '2024-08-07 17:30:23', 'Eliminación del usuario: Mario'),
(42, 'users ', ' insert ', '2024-08-07 17:30:56', 'Nuevo usuario: Miriam'),
(43, 'users ', ' insert ', '2024-08-08 07:22:55', 'Nuevo usuario: mari'),
(44, 'users ', ' insert ', '2024-08-08 07:24:06', 'Nuevo usuario: adriana'),
(45, 'users', 'delete', '2024-08-08 07:41:20', 'Eliminación del usuario: adriana'),
(46, 'users ', ' insert ', '2024-08-08 07:41:55', 'Nuevo usuario: adro'),
(47, 'posts ', ' insert ', '2024-08-08 07:45:23', 'Nuevo post de: Gloria'),
(48, 'users ', ' insert ', '2024-08-08 07:49:19', 'Nuevo usuario: admin'),
(49, 'users', 'update', '2024-08-08 07:50:02', 'Actualización del usuario: admin'),
(50, 'sections ', ' insert ', '2024-08-08 07:51:46', 'Nueva seccion: Jardineria'),
(51, 'posts', 'update', '2024-08-08 07:52:10', 'Actualización del post de: Gloria'),
(52, 'sections ', ' insert ', '2024-08-08 07:52:37', 'Nueva seccion: Medicina'),
(53, 'users ', ' insert ', '2024-08-08 07:53:12', 'Nuevo usuario: ana'),
(54, 'posts ', ' insert ', '2024-08-08 07:54:56', 'Nuevo post de: Josue'),
(55, 'users ', ' insert ', '2024-08-08 08:29:06', 'Nuevo usuario: ana'),
(56, 'posts ', ' insert ', '2024-08-08 08:29:47', 'Nuevo post de: Ana'),
(57, 'messages ', ' insert ', '2024-08-08 08:30:25', 'Nuevo mensaje de: Ana'),
(58, 'users', 'update', '2024-08-08 08:31:38', 'Actualización del usuario: admin'),
(59, 'users', 'delete', '2024-08-08 08:31:48', 'Eliminación del usuario: ana'),
(60, 'users ', ' insert ', '2024-08-08 08:32:17', 'Nuevo usuario: Josue'),
(61, 'messages ', ' insert ', '2024-08-10 15:46:48', 'Nuevo mensaje de: JOSUE'),
(62, 'users ', ' insert ', '2024-08-10 15:48:01', 'Nuevo usuario: DAVID'),
(63, 'posts ', ' insert ', '2024-08-10 15:49:05', 'Nuevo post de: DAVID'),
(64, 'users ', ' insert ', '2024-08-10 16:02:44', 'Nuevo usuario: Rol1'),
(65, 'users ', ' insert ', '2024-09-23 09:51:49', 'Nuevo usuario: JOSUE'),
(66, 'users ', ' insert ', '2024-09-23 10:12:59', 'Nuevo usuario: avendaño');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `messages`
--

CREATE TABLE `messages` (
  `id_message` int(11) NOT NULL,
  `usuario_n` varchar(50) DEFAULT NULL,
  `contenido` text NOT NULL,
  `feha` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `messages`
--

INSERT INTO `messages` (`id_message`, `usuario_n`, `contenido`, `feha`) VALUES
(1, 'Ana', 'Hola, que die aesta disponible', '2024-08-08 14:30:25'),
(2, 'JOSUE', 'PVP O QUE MANCO\r\n\r\n', '2024-08-10 21:46:48');

--
-- Disparadores `messages`
--
DELIMITER $$
CREATE TRIGGER `message_delete` AFTER DELETE ON `messages` FOR EACH ROW begin insert into bitacora (tabla_afectada, operacion, fecha, descripcion)
values ('messages', 'delete', now(), concat('Eliminación del mensaje de: ', old.usuario_n));
end
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `message_insert` AFTER INSERT ON `messages` FOR EACH ROW begin insert into bitacora (tabla_afectada, operacion, fecha, descripcion) 
values ('messages ', ' insert ', now(), concat('Nuevo mensaje de: ', new.usuario_n));
end
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `message_update` AFTER UPDATE ON `messages` FOR EACH ROW begin insert into bitacora (tabla_afectada, operacion, fecha, descripcion)
values ('messages', 'update', now(), concat('Actualización del mensaje de: ', new.usuario_n));
end
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `posts`
--

CREATE TABLE `posts` (
  `id_post` int(11) NOT NULL,
  `nombre_of` varchar(50) NOT NULL,
  `imagen` varchar(150) DEFAULT NULL,
  `descripcion` varchar(200) NOT NULL,
  `puntuacion` int(11) DEFAULT NULL,
  `id_section` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `posts`
--

INSERT INTO `posts` (`id_post`, `nombre_of`, `imagen`, `descripcion`, `puntuacion`, `id_section`) VALUES
(1, 'Gloria', '../uploads/jardinera.webp', 'Trabajo de lunes a viernes', 1, 8),
(2, 'Josue', '../uploads/mesero.jpg', 'Asisto a todo tipo de eventos, hago banquetes', NULL, 2),
(3, 'Ana', '../uploads/doctor.jpg', 'Trabajo de lunes a viernes', NULL, 9),
(4, 'DAVID', '../uploads/idea2.jpg', 'SOY HEROICO', NULL, 3);

--
-- Disparadores `posts`
--
DELIMITER $$
CREATE TRIGGER `posts_delete` AFTER DELETE ON `posts` FOR EACH ROW begin insert into bitacora (tabla_afectada, operacion, fecha, descripcion)
values ('posts', 'delete', now(), concat('Eliminación del post de: ', old.nombre_of));
end
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `posts_insert` AFTER INSERT ON `posts` FOR EACH ROW begin insert into bitacora (tabla_afectada, operacion, fecha, descripcion) 
values ('posts ', ' insert ', now(), concat('Nuevo post de: ', new.nombre_of));
end
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `posts_update` AFTER UPDATE ON `posts` FOR EACH ROW begin insert into bitacora (tabla_afectada, operacion, fecha, descripcion)
values ('posts', 'update', now(), concat('Actualización del post de: ', new.nombre_of));
end
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `id_rol` int(11) NOT NULL,
  `Rol` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id_rol`, `Rol`) VALUES
(0, 'user'),
(1, 'Administrador'),
(2, 'Rol1');

--
-- Disparadores `roles`
--
DELIMITER $$
CREATE TRIGGER `roles_delete` AFTER DELETE ON `roles` FOR EACH ROW begin insert into bitacora (tabla_afectada, operacion, fecha, descripcion)
values ('roles', 'delete', now(), concat('Eliminación del rol: ', old.Rol));
end
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `roles_insert` AFTER INSERT ON `roles` FOR EACH ROW begin insert into bitacora (tabla_afectada, operacion, fecha, descripcion) 
values ('roles ', ' insert ', now(), concat('Nuevo rol: ', new.Rol));
end
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `roles_update` AFTER UPDATE ON `roles` FOR EACH ROW begin insert into bitacora (tabla_afectada, operacion, fecha, descripcion)
values ('roles', 'update', now(), concat('Actualización del rol: ', new.Rol));
end
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sections`
--

CREATE TABLE `sections` (
  `id_section` int(11) NOT NULL,
  `Nombre_sec` varchar(50) NOT NULL,
  `Description` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `sections`
--

INSERT INTO `sections` (`id_section`, `Nombre_sec`, `Description`) VALUES
(1, 'Limpieza', 'limpieza, etc'),
(2, 'Cocina', 'Chefs, ayudantes de cocina'),
(3, 'Informatica', 'reparacion de celulares, ayuda sobre ti, etc'),
(5, 'oficina', 'todo lo relacionzdo con oficina'),
(8, 'Jardineria', 'Cuidado y mentenimiento de las plantas'),
(9, 'Medicina', 'Enfermeros, doctores, cuidadores, etc');

--
-- Disparadores `sections`
--
DELIMITER $$
CREATE TRIGGER `sections_delete` AFTER DELETE ON `sections` FOR EACH ROW begin insert into bitacora (tabla_afectada, operacion, fecha, descripcion)
values ('sections', 'delete', now(), concat('Eliminación de la seccion: ', old.Nombre_sec));
end
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `sections_insert` AFTER INSERT ON `sections` FOR EACH ROW begin insert into bitacora (tabla_afectada, operacion, fecha, descripcion) 
values ('sections ', ' insert ', now(), concat('Nueva seccion: ', new.Nombre_sec));
end
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `sections_update` AFTER UPDATE ON `sections` FOR EACH ROW begin insert into bitacora (tabla_afectada, operacion, fecha, descripcion)
values ('sections', 'update', now(), concat('Actualización de la seccion: ', new.Nombre_sec));
end
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `nombre_us` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password_u` varchar(70) NOT NULL,
  `id_rol` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id_user`, `nombre_us`, `email`, `password_u`, `id_rol`) VALUES
(1, 'admin', 'admin@gmail.com', '$2y$10$SzqAacmpuU78J3PQnu/w0.kdjx/cXp1IWP.7PQWbfJTEptK.A1w8e', 1),
(3, 'ana', 'a@gmail.com', '$2y$10$FiraQ5ULIISkrUPZwIwqW.siKRkC207wG.5mrZ.wQVN6he9StqZlK', 0),
(4, 'Josue', 'aj@gmail.com', '$2y$10$oWZxCypu821NZglRx5KaLuPkZu8JE2Fg5.iBk/zRQJWmzQPWRNeGO', 0),
(5, 'DAVID', 'D@gmail.com', '$2y$10$QSwfzMbMW4z2/x/jrdocAOlHN0YW8bq.Bp9LTY9.rzZm54F3ybQKW', 0),
(6, 'Rol1', 'Rol1@gmail.com', '$2y$10$PWjJugevn6yT4QOQ7oF7euRHcAZeyTMh.MNxynJQEMn89CzVgtQIy', 0),
(7, 'JOSUE', 'josuetopo@gmail.com', '$2y$10$Z63hZIRvLqwuEZ4qOSY2Xe9kTl/EvAsfpQY/MTcOBqw3HQ0kf.bM2', 0),
(8, 'avendaño', 'topo@gmail.com', '$2y$10$pSZQgWrEC2yS5nN6Zw2rC.QaILW8fwlVvGMkjEuTHQefhUzAdNRVi', 0);

--
-- Disparadores `users`
--
DELIMITER $$
CREATE TRIGGER `users_delete` AFTER DELETE ON `users` FOR EACH ROW begin insert into bitacora (tabla_afectada, operacion, fecha, descripcion)
values ('users', 'delete', now(), concat('Eliminación del usuario: ', old.nombre_us));
end
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `users_insert` AFTER INSERT ON `users` FOR EACH ROW begin insert into bitacora (tabla_afectada, operacion, fecha, descripcion) 
values ('users ', ' insert ', now(), concat('Nuevo usuario: ', new.nombre_us));
end
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `users_update` AFTER UPDATE ON `users` FOR EACH ROW begin insert into bitacora (tabla_afectada, operacion, fecha, descripcion)
values ('users', 'update', now(), concat('Actualización del usuario: ', new.nombre_us));
end
$$
DELIMITER ;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `bitacora`
--
ALTER TABLE `bitacora`
  ADD PRIMARY KEY (`id_bitacora`);

--
-- Indices de la tabla `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id_message`);

--
-- Indices de la tabla `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id_post`),
  ADD KEY `ROLES_SECTION` (`id_section`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id_rol`);

--
-- Indices de la tabla `sections`
--
ALTER TABLE `sections`
  ADD PRIMARY KEY (`id_section`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`),
  ADD KEY `rol` (`id_rol`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `bitacora`
--
ALTER TABLE `bitacora`
  MODIFY `id_bitacora` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT de la tabla `messages`
--
ALTER TABLE `messages`
  MODIFY `id_message` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `posts`
--
ALTER TABLE `posts`
  MODIFY `id_post` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `sections`
--
ALTER TABLE `sections`
  MODIFY `id_section` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `ROLES_SECTION` FOREIGN KEY (`id_section`) REFERENCES `sections` (`id_section`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `rol` FOREIGN KEY (`id_rol`) REFERENCES `roles` (`id_rol`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
