-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 15-09-2025 a las 04:06:43
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
-- Base de datos: `prueba_nexura`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `areas`
--

CREATE TABLE `areas` (
  `id` int(11) NOT NULL COMMENT 'identificador del area',
  `nombre` varchar(255) NOT NULL COMMENT 'nombre del area de la empresa'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `areas`
--

INSERT INTO `areas` (`id`, `nombre`) VALUES
(1, 'Recursos Humanos'),
(2, 'Finanzas'),
(3, 'Contabilidad'),
(4, 'Tecnología / Sistemas'),
(5, 'Desarrollo de Software'),
(6, 'Marketing'),
(7, 'Ventas'),
(8, 'Atención al Cliente'),
(9, 'Operaciones'),
(10, 'Producción'),
(11, 'Logística'),
(12, 'Compras'),
(13, 'Legal'),
(14, 'Dirección General'),
(15, 'Calidad'),
(16, 'Innovación'),
(17, 'Soporte Técnico'),
(18, 'Administración');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleados`
--

CREATE TABLE `empleados` (
  `id` int(11) NOT NULL COMMENT 'identificador del empleado',
  `nombre` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `sexo` char(1) NOT NULL,
  `area_id` int(11) NOT NULL,
  `boletin` int(11) NOT NULL,
  `descripcion` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleado_rol`
--

CREATE TABLE `empleado_rol` (
  `empleado_id` int(11) NOT NULL COMMENT 'Identificador del empleado',
  `rol_id` int(11) NOT NULL COMMENT 'identificador del rol'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id`, `nombre`) VALUES
(1, 'Analista de Recursos Humanos'),
(2, 'Coordinador de Selección'),
(3, 'Especialista en Capacitación'),
(4, 'Analista Financiero'),
(5, 'Contador General'),
(6, 'Tesorero'),
(7, 'Desarrollador Backend'),
(8, 'Desarrollador Frontend'),
(9, 'Ingeniero de QA'),
(10, 'Administrador de Bases de Datos'),
(11, 'DevOps Engineer'),
(12, 'Soporte Técnico'),
(13, 'Community Manager'),
(14, 'Diseñador Gráfico'),
(15, 'Analista de Marketing Digital'),
(16, 'Ejecutivo de Ventas'),
(17, 'Asesor Comercial'),
(18, 'Representante de Atención al Cliente'),
(19, 'Supervisor de Producción'),
(20, 'Operario de Planta'),
(21, 'Analista de Logística'),
(22, 'Director General'),
(23, 'Gerente de Proyecto'),
(24, 'Jefe de Calidad'),
(25, 'Especialista en Innovación'),
(26, 'Asistente Administrativo');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `areas`
--
ALTER TABLE `areas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `empleados`
--
ALTER TABLE `empleados`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `areas`
--
ALTER TABLE `areas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'identificador del area', AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de la tabla `empleados`
--
ALTER TABLE `empleados`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'identificador del empleado', AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
