-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 04, 2024 at 10:57 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12
drop database if exists redserv;
create database redserv;
use redserv;

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `redserv`
--

-- --------------------------------------------------------

CREATE TABLE `bitacora` (
  `id_bitacora` int(11) primary key auto_increment,
  `tabla_afectada` varchar(50) NOT NULL,
  `operacion` varchar(20) NOT NULL,
  `fecha` datetime NOT NULL DEFAULT current_timestamp(),
  `descripcion` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id_message` int(11) NOT NULL,
  `usuario_n` varchar(50) DEFAULT NULL,
  `contenido` text NOT NULL,
  `feha` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id_message`, `usuario_n`, `contenido`, `feha`) VALUES
(8, 'Mon', 'hola quiero dos pizzas', '2024-08-04 20:46:55');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id_post` int(11) NOT NULL,
  `nombre_of` varchar(50) NOT NULL,
  `imagen` varchar(150) DEFAULT NULL,
  `descripcion` varchar(200) NOT NULL,
  `puntuacion` int(11) DEFAULT NULL,
  `id_section` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id_rol` int(11) NOT NULL,
  `Rol` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `roles`
--


-- --------------------------------------------------------

--
-- Table structure for table `sections`
--

CREATE TABLE `sections` (
  `id_section` int(11) NOT NULL,
  `Nombre_sec` varchar(50) NOT NULL,
  `Description` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sections`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `nombre_us` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password_u` varchar(70) NOT NULL,
  `id_rol` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

--
-- Indexes for dumped tables
--

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id_message`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id_post`),
  ADD KEY `ROLES_SECTION` (`id_section`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id_rol`);

--
-- Indexes for table `sections`
--
ALTER TABLE `sections`
  ADD PRIMARY KEY (`id_section`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`),
  ADD KEY `rol` (`id_rol`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id_message` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id_post` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `sections`
--
ALTER TABLE `sections`
  MODIFY `id_section` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `ROLES_SECTION` FOREIGN KEY (`id_section`) REFERENCES `sections` (`id_section`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `rol` FOREIGN KEY (`id_rol`) REFERENCES `roles` (`id_rol`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;





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







-- Disparadores `POSTS`
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






-- Disparadores `ROLES`
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





-- Disparadores `SECTIONS`
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


INSERT INTO `roles` (`id_rol`, `Rol`) VALUES
(0, 'user'),
(1, 'Administrador'),
(2, 'Rol1');




INSERT INTO `sections` (`id_section`, `Nombre_sec`, `Description`) VALUES
(1, 'Limpieza', 'Todo lo relacionado con la limpieza.'),
(2, 'Cocina', 'Chefs, ayudantes de cocina'),
(3, 'Informatica', 'reparacion de celulares, ayuda sobre ti, etc'),
(4, 'Oficina', 'Secretarios y oficinistas');



INSERT INTO `users` (`id_user`, `nombre_us`, `email`, `password_u`, `id_rol`) VALUES
(7, 'admin', 'admin@gmail.com', '$2y$10$xEIMyz5Ap4RvJhwJGkH6guNLottukcrfe6aHXQIb8L5CcdKc8rGE.', 1),
(9, 'susana', 'susana@gmail.com', '$2y$10$W.Fy8C8BY7PoigYQLcN9g.T6ddPaH8XEMX8.EiNxaal0nRA6q.VvG', 0),
(10, 'ss', 'ss@gmail.com', '$2y$10$SOB89aoP5R75KqqCp2JWIOrV0nX9TiLXFyMHpW4dL9f6KGcZpct2u', 0);


