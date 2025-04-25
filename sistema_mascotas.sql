-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 25-04-2025 a las 16:45:36
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
-- Base de datos: `sistema_mascotas`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empre_licencia`
--

CREATE TABLE `empre_licencia` (
  `id_empresa` int(11) NOT NULL,
  `nom_empresa` varchar(100) NOT NULL,
  `direccion` varchar(255) NOT NULL,
  `telefono` bigint(11) NOT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `empre_licencia`
--

INSERT INTO `empre_licencia` (`id_empresa`, `nom_empresa`, `direccion`, `telefono`, `email`) VALUES
(830512410, 'Aventura Canina', 'Ibague, Tunjos', 3156789435, 'aventuracanina@gmail.com'),
(860523789, 'Pawtastic', 'Ibague, Samaria', 8631579563, 'pawtastic@gmail.com'),
(900123456, 'Rincon De Ladridos', 'Ibague, Ciudadela Comfenalco', 3158796317, 'rincondeladridos@gmail.com'),
(901234567, 'Cuidado De Cachorros', 'Ibague', 7896114563, 'cuidadodecachorros@gmail.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estado_licencia`
--

CREATE TABLE `estado_licencia` (
  `id_estado_licencia` int(11) NOT NULL,
  `nom_estado` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `estado_licencia`
--

INSERT INTO `estado_licencia` (`id_estado_licencia`, `nom_estado`) VALUES
(1, 'Activa'),
(2, 'Inactiva');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ingreso_parque`
--

CREATE TABLE `ingreso_parque` (
  `id_ingresos` int(11) NOT NULL,
  `id_mascota` int(11) NOT NULL,
  `fecha_ingreso` timestamp NOT NULL DEFAULT current_timestamp(),
  `fecha_salida` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `ingreso_parque`
--

INSERT INTO `ingreso_parque` (`id_ingresos`, `id_mascota`, `fecha_ingreso`, `fecha_salida`) VALUES
(1, 1, '2025-04-25 21:40:00', '2025-04-25 22:40:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `licencia`
--

CREATE TABLE `licencia` (
  `id_licencia` varchar(11) NOT NULL,
  `id_estado` int(11) NOT NULL,
  `tipo_licencia` int(11) NOT NULL,
  `id_empresa` int(11) NOT NULL,
  `fecha_ini_licencia` date NOT NULL,
  `fecha_fin_licencia` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `licencia`
--

INSERT INTO `licencia` (`id_licencia`, `id_estado`, `tipo_licencia`, `id_empresa`, `fecha_ini_licencia`, `fecha_fin_licencia`) VALUES
('3X1XFL5R9Y', 1, 1, 830512410, '2025-04-24', '2025-04-27'),
('HALRPJNETB', 1, 2, 900123456, '2025-04-24', '2025-10-21'),
('PHMQHG7212', 1, 3, 860523789, '2025-04-24', '2026-04-24'),
('TJWY6ZKG03', 1, 4, 901234567, '2025-04-24', '2027-04-24');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mascotas`
--

CREATE TABLE `mascotas` (
  `id_mascota` int(11) NOT NULL,
  `nombre_mascota` varchar(255) NOT NULL,
  `tipo_mascota` int(11) NOT NULL,
  `raza_mascota` int(11) NOT NULL,
  `codigo_barras` bigint(100) NOT NULL,
  `doc_user` bigint(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `mascotas`
--

INSERT INTO `mascotas` (`id_mascota`, `nombre_mascota`, `tipo_mascota`, `raza_mascota`, `codigo_barras`, `doc_user`) VALUES
(1, 'Princesa', 1, 10, 17455527116, 1108463259);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `raza_mascota`
--

CREATE TABLE `raza_mascota` (
  `id_raza_mascota` int(11) NOT NULL,
  `nom_raza_mascota` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `raza_mascota`
--

INSERT INTO `raza_mascota` (`id_raza_mascota`, `nom_raza_mascota`) VALUES
(1, 'Pastor Aleman'),
(2, 'Bulldog'),
(3, 'Labrador Retriever'),
(4, 'Golden Retriever'),
(5, 'Bulldog Frances'),
(6, 'Husky Siberiano'),
(7, 'Beagle'),
(8, 'Poodle'),
(9, 'Malamute de Alaska'),
(10, 'Chihuahua'),
(11, 'Dachshund'),
(12, 'Pastor Ganadero Australiano'),
(13, 'Boyero De Berna'),
(14, 'Pug'),
(15, 'Rottweiler'),
(16, 'Airedable Terrier'),
(17, 'Border Collie'),
(18, 'American Staffordshire Terrier'),
(19, 'Pastor Ovejero Australiano '),
(20, 'Criollo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE `rol` (
  `id_rol` int(11) NOT NULL,
  `nom_rol` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`id_rol`, `nom_rol`) VALUES
(1, 'Super Administrador'),
(2, 'Administrador'),
(3, 'Usuario ');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_licencia`
--

CREATE TABLE `tipo_licencia` (
  `id_tipo_licencia` int(11) NOT NULL,
  `nom_tipo_licencia` varchar(100) NOT NULL,
  `valor` decimal(10,2) NOT NULL,
  `duracion_licencia` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tipo_licencia`
--

INSERT INTO `tipo_licencia` (`id_tipo_licencia`, `nom_tipo_licencia`, `valor`, `duracion_licencia`) VALUES
(1, 'Demo', 300000.00, 3),
(2, '6 Meses', 300000.00, 180),
(3, '1 Año', 300000.00, 365),
(4, '2 Años', 300000.00, 730);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_mascota`
--

CREATE TABLE `tipo_mascota` (
  `id_tipo_mascota` int(11) NOT NULL,
  `nom_tipo_mascota` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tipo_mascota`
--

INSERT INTO `tipo_mascota` (`id_tipo_mascota`, `nom_tipo_mascota`) VALUES
(1, 'Perro');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `documento` bigint(11) NOT NULL,
  `nombres` varchar(100) NOT NULL,
  `apellidos` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(500) NOT NULL,
  `telefono` bigint(11) NOT NULL,
  `direccion` varchar(255) NOT NULL,
  `id_empresa` int(11) DEFAULT NULL,
  `id_rol` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`documento`, `nombres`, `apellidos`, `email`, `password`, `telefono`, `direccion`, `id_empresa`, `id_rol`) VALUES
(1107977746, 'Juan Sebastian', 'Duran Castellanos', 'jdurancastellanos21@gmail.com', '$2y$12$9g6rW6i4uQo0jdzENGEEZuFyFRCqcNai3Bu6AAZkdnbxRvWhv4jNq', 3163105392, 'Ciudadela Comfenalco', NULL, 1),
(1108463259, 'Brian Stiven', 'Rocha Poveda', 'rocha@gmail.com', '$2y$10$4vACrf1oiAkIi1its8pg.eWOaUFYNaBj4TQRtd4FTmyZU57S7ouz6', 3102331487, 'barrio jardin', NULL, 3),
(1108655540, 'Cristiano Ronaldo', 'Dos Santos Aveiro', 'cr7@gmail.com', '$2y$12$iNyZpGcou7eStlKBMv8NZeGIYgdNfXruAVxEdUSnTdiW9uQkqGSwa', 3108665519, 'Ibague', 830512410, 2),
(1109491416, 'Edwar Farid', 'Gomez Sanchez', 'edwarr@gmail.com', '$2y$10$Rs1HiGu3lt0nHeJFg1prHet4Fl02AxzqG9ffKxK1opLzHOCKQOjpS', 3127594638, 'tunjos', NULL, 3);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `empre_licencia`
--
ALTER TABLE `empre_licencia`
  ADD PRIMARY KEY (`id_empresa`);

--
-- Indices de la tabla `estado_licencia`
--
ALTER TABLE `estado_licencia`
  ADD PRIMARY KEY (`id_estado_licencia`);

--
-- Indices de la tabla `ingreso_parque`
--
ALTER TABLE `ingreso_parque`
  ADD PRIMARY KEY (`id_ingresos`),
  ADD KEY `id_mascota` (`id_mascota`);

--
-- Indices de la tabla `licencia`
--
ALTER TABLE `licencia`
  ADD PRIMARY KEY (`id_licencia`),
  ADD KEY `id_estado` (`id_estado`),
  ADD KEY `tipo_licencia` (`tipo_licencia`),
  ADD KEY `id_empresa` (`id_empresa`);

--
-- Indices de la tabla `mascotas`
--
ALTER TABLE `mascotas`
  ADD PRIMARY KEY (`id_mascota`),
  ADD KEY `tipo_mascota` (`tipo_mascota`),
  ADD KEY `raza_mascota` (`raza_mascota`),
  ADD KEY `doc_user` (`doc_user`);

--
-- Indices de la tabla `raza_mascota`
--
ALTER TABLE `raza_mascota`
  ADD PRIMARY KEY (`id_raza_mascota`);

--
-- Indices de la tabla `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`id_rol`);

--
-- Indices de la tabla `tipo_licencia`
--
ALTER TABLE `tipo_licencia`
  ADD PRIMARY KEY (`id_tipo_licencia`);

--
-- Indices de la tabla `tipo_mascota`
--
ALTER TABLE `tipo_mascota`
  ADD PRIMARY KEY (`id_tipo_mascota`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`documento`),
  ADD KEY `id_rol` (`id_rol`),
  ADD KEY `id_empresa` (`id_empresa`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `estado_licencia`
--
ALTER TABLE `estado_licencia`
  MODIFY `id_estado_licencia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `ingreso_parque`
--
ALTER TABLE `ingreso_parque`
  MODIFY `id_ingresos` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `mascotas`
--
ALTER TABLE `mascotas`
  MODIFY `id_mascota` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `raza_mascota`
--
ALTER TABLE `raza_mascota`
  MODIFY `id_raza_mascota` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `rol`
--
ALTER TABLE `rol`
  MODIFY `id_rol` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `tipo_licencia`
--
ALTER TABLE `tipo_licencia`
  MODIFY `id_tipo_licencia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `tipo_mascota`
--
ALTER TABLE `tipo_mascota`
  MODIFY `id_tipo_mascota` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `ingreso_parque`
--
ALTER TABLE `ingreso_parque`
  ADD CONSTRAINT `ingreso_parque_ibfk_1` FOREIGN KEY (`id_mascota`) REFERENCES `mascotas` (`id_mascota`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `licencia`
--
ALTER TABLE `licencia`
  ADD CONSTRAINT `licencia_ibfk_1` FOREIGN KEY (`id_estado`) REFERENCES `estado_licencia` (`id_estado_licencia`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `licencia_ibfk_2` FOREIGN KEY (`tipo_licencia`) REFERENCES `tipo_licencia` (`id_tipo_licencia`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `licencia_ibfk_3` FOREIGN KEY (`id_empresa`) REFERENCES `empre_licencia` (`id_empresa`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `mascotas`
--
ALTER TABLE `mascotas`
  ADD CONSTRAINT `mascotas_ibfk_1` FOREIGN KEY (`tipo_mascota`) REFERENCES `tipo_mascota` (`id_tipo_mascota`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `mascotas_ibfk_3` FOREIGN KEY (`raza_mascota`) REFERENCES `raza_mascota` (`id_raza_mascota`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `mascotas_ibfk_4` FOREIGN KEY (`doc_user`) REFERENCES `users` (`documento`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`id_rol`) REFERENCES `rol` (`id_rol`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `users_ibfk_2` FOREIGN KEY (`id_empresa`) REFERENCES `empre_licencia` (`id_empresa`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
