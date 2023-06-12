-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 10-06-2023 a las 00:17:59
-- Versión del servidor: 10.4.24-MariaDB
-- Versión de PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `maxisoft`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `agendamiento`
--

CREATE TABLE `agendamiento` (
  `IdAgendamiento` int(10) NOT NULL,
  `IdEmpleado` int(10) NOT NULL,
  `IdServicio` int(10) NOT NULL,
  `NombreCliente` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `Descripcion` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `FechaServicio` date NOT NULL,
  `HoraAgendamiento` varchar(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `DireccionCliente` varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `TelefonoCliente` bigint(15) NOT NULL,
  `Cantidad` int(10) NOT NULL,
  `Estado` varchar(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `IdHerramientaInsumo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalleprestamo`
--

CREATE TABLE `detalleprestamo` (
  `IdDetallePrestamo` int(10) NOT NULL,
  `IdHerramientaInsumo` int(10) NOT NULL,
  `CantidadElemento` int(20) NOT NULL,
  `Observacion` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `detalleprestamo`
--

INSERT INTO `detalleprestamo` (`IdDetallePrestamo`, `IdHerramientaInsumo`, `CantidadElemento`, `Observacion`) VALUES
(2, 4, 9, 'agua');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleado`
--

CREATE TABLE `empleado` (
  `IdEmpleado` int(20) NOT NULL,
  `Nombre` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Apellido` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `TipoDocumento` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Documento` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Correo` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Telefono` int(50) NOT NULL,
  `Direccion` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Estado` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `empleado`
--

INSERT INTO `empleado` (`IdEmpleado`, `Nombre`, `Apellido`, `TipoDocumento`, `Documento`, `Correo`, `Telefono`, `Direccion`, `Estado`) VALUES
(1, 'Pablo', 'Franco', 'Cédula', '1234', 'oe@gmail.com', 301, 'szs', 1),
(2, 'Dana', 'Andresa', 'Cédula', '1234', 'dana@gmail.com', 1234, 'aya', 1),
(3, 'Alvaro', 'Alvarado', 'Cédula', '1234', 'alvaro@gmail.com', 1234, 'Mi casa', 1),
(4, 'Alvaro', 'Andresa', 'Cédula', '1234', 'alvaro@gmail.com', 2147483647, 'Mi casa', 1),
(5, 'Yenny', 'Durango', 'Cédula', '1234', 'yenny@gmail.com', 2147483647, 'Mi casa', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `herramientainsumo`
--

CREATE TABLE `herramientainsumo` (
  `IdHerramientaInsumo` int(11) NOT NULL,
  `Nombre` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `Tipo` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `Categoria` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `Descripcion` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `Color` varchar(11) COLLATE utf8_unicode_ci NOT NULL,
  `FechaCompra` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `Cantidad` int(11) NOT NULL,
  `Medida` varchar(12) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `herramientainsumo`
--

INSERT INTO `herramientainsumo` (`IdHerramientaInsumo`, `Nombre`, `Tipo`, `Categoria`, `Descripcion`, `Color`, `FechaCompra`, `Cantidad`, `Medida`) VALUES
(1, 'fe', '32', '32', '23', '23', '23', 21, 'm'),
(2, 'Moden 2 antenas', 'Herramienta', 'Manual', 'para tener covertura', 'azul', '2022-11-28', 6, 'm'),
(3, 'clavos', 'insumo', 'manual', 'para clavar', 'gris', '2022-11-22', 0, ''),
(4, 'grapas', 'insumo', 'manual', 'para pegar cable a l', 'gris', '2022-11-22', 12, ''),
(5, 'moden 3 antenas', 'insumo', 'router', 'para tener covertura', 'blanco', '2022-11-04', 6, ''),
(6, 'llave ingresa', 'herramienta', 'manual', 'para desatornillar t', 'rojo', '2022-11-16', 0, ''),
(7, '76', 'opcion1', '76', '76', '76', '0000-00-00', 6, ''),
(8, '56', 'herramienta', '6', '56', '56', '0000-00-00', 56, ''),
(24, 'pala', 'herramienta', 'manual', 'para palear', 'negro', '19-05-2023', 2, ''),
(25, 'Grapas', 'insumo', 'manual', 'para grapar', 'negro', '19-05-2023', 78, ''),
(26, 'clavo', 'insumo', 'cable', 'asas', 'azul', '31-05-2023', 200, ''),
(27, 'aadasd', 'insumo', 'cable', 'adad', 'adad', '31-05-2023', 34, ''),
(28, 'ad', 'insumo', 'cable', 'ad', 'ad', '31-05-2023', 21, 'medida'),
(29, '', 'herramienta', 'manual', '', '', '02-06-2023', 0, 'medida'),
(30, '', 'herramienta', 'manual', '', '', '02-06-2023', 0, 'medida'),
(31, 'a', 'herramienta', 'manual', '', '', '02-06-2023', 0, ''),
(32, 'ola', 'insumo', 'cable', '', '', '02-06-2023', 0, ''),
(33, 'val', 'insumo', 'cable', '', '', '02-06-2023', 0, ''),
(34, '76', 'herramienta', 'manual', '', '', '02-06-2023', 0, ''),
(35, '87', 'herramienta', 'manual', '', '', '02-06-2023', 0, ''),
(36, 'ava', 'insumo', 'cable', 'ava', 'ava', '02-06-2023', 0, 'cm'),
(37, 'a', 'herramienta', 'manual', 'a', 'a', '02-06-2023', 4, 'm');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `prestamo`
--

CREATE TABLE `prestamo` (
  `IdPrestamo` int(10) NOT NULL,
  `IdEmpleado` int(10) NOT NULL,
  `IdHerramientaInsumo` int(11) NOT NULL,
  `FechaPrestamo` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Cantidad` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `prestamo`
--

INSERT INTO `prestamo` (`IdPrestamo`, `IdEmpleado`, `IdHerramientaInsumo`, `FechaPrestamo`, `Cantidad`) VALUES
(80, 5, 1, '09-06-2023', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE `rol` (
  `IdRol` int(50) NOT NULL,
  `NombreRol` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Permisos` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `FechaRol` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `EstadoRol` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`IdRol`, `NombreRol`, `Permisos`, `FechaRol`, `EstadoRol`) VALUES
(1, 'Administrador', '1,1,1,1,1,1,1', '07-06-2023 12:24:08', '1'),
(2, 'Novato', '1,1,1,0,0,0,0', '09-06-2023 09:57:44', '1'),
(3, 'Practicantes', '1,1,1,0,0,0,0', '09-06-2023 09:57:50', '0');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `servicios`
--

CREATE TABLE `servicios` (
  `IdServicio` int(11) NOT NULL,
  `Nombre` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `Estado` varchar(20) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `servicios`
--

INSERT INTO `servicios` (`IdServicio`, `Nombre`, `Estado`) VALUES
(1, 'Manolo', 'Activado'),
(2, 'cambio de contraseña', 'Desactivado'),
(3, 'cambio de cable', 'Activado'),
(4, 'cambio de router', 'Desactivado'),
(5, 'cambio de nombre wifi', 'Activado'),
(19, 'Hola', 'Activado'),
(20, 'Manola', 'Activado'),
(21, '', 'Desactivado'),
(22, '', 'Activado'),
(23, 'Juan', 'Activado'),
(24, 'Pablo', 'Activado'),
(25, 'Papa', 'Activado'),
(26, 'Luffy', 'Activado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `IdUsuario` int(50) NOT NULL,
  `IdRol` int(20) NOT NULL,
  `Nombre` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Apellido` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `TipoDocumento` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Documento` int(30) NOT NULL,
  `Correo` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Contrasena` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Telefono` int(20) NOT NULL,
  `Direccion` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Estado` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`IdUsuario`, `IdRol`, `Nombre`, `Apellido`, `TipoDocumento`, `Documento`, `Correo`, `Contrasena`, `Telefono`, `Direccion`, `Estado`) VALUES
(1, 1, 'Pablo', 'Franco', 'Cédula', 1234, 'oe@gmail.com', '6a6189213a862710e0176352cde959d5f6d5037aa10d10eb60154d4e8f65d93252eacc18b4e2133e1a9232d5d86c2eb03e421d71b3c31d7ae773c14981ce9390', 301, 'szs', 1),
(2, 2, 'Dana', 'Andresa', 'Cédula', 1234, 'dana@gmail.com', '6a6189213a862710e0176352cde959d5f6d5037aa10d10eb60154d4e8f65d93252eacc18b4e2133e1a9232d5d86c2eb03e421d71b3c31d7ae773c14981ce9390', 1234, 'aya', 1),
(3, 3, 'Alvaro', 'Alvarado', 'Cédula', 1234, 'alvaro@gmail.com', '6a6189213a862710e0176352cde959d5f6d5037aa10d10eb60154d4e8f65d93252eacc18b4e2133e1a9232d5d86c2eb03e421d71b3c31d7ae773c14981ce9390', 1234, 'Mi casa', 1),
(4, 3, 'Alvaro', 'Andresa', 'Cédula', 1234, 'alvaro@gmail.com', '449f672e7cd44e00c2c8a55cd3af89ce6ce1ace97e2cdf8ba9bfa5991ae1dbaaa0e24d70ce44313401cd5bfc5485625e775691944a5c0903b184c9fbc4cd2b34', 2147483647, 'Mi casa', 1),
(5, 1, 'Yenny', 'Durango', 'Cédula', 1234, 'yenny@gmail.com', 'be35cc81970680c7795eaea095bed0f2feefc4d24cba3c710f0c7cb3f75ffbca5d590a5ad6e89f1679725b72ffe13b457cd81db3220f1160770811e775435839', 2147483647, 'Mi casa', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `agendamiento`
--
ALTER TABLE `agendamiento`
  ADD PRIMARY KEY (`IdAgendamiento`),
  ADD KEY `id_empleado` (`IdEmpleado`,`IdServicio`),
  ADD KEY `id_servicio` (`IdServicio`),
  ADD KEY `id_herramienta_e_insumo` (`IdHerramientaInsumo`);

--
-- Indices de la tabla `detalleprestamo`
--
ALTER TABLE `detalleprestamo`
  ADD PRIMARY KEY (`IdDetallePrestamo`),
  ADD KEY `id_herramienta_e_insumo` (`IdHerramientaInsumo`);

--
-- Indices de la tabla `empleado`
--
ALTER TABLE `empleado`
  ADD PRIMARY KEY (`IdEmpleado`);

--
-- Indices de la tabla `herramientainsumo`
--
ALTER TABLE `herramientainsumo`
  ADD PRIMARY KEY (`IdHerramientaInsumo`);

--
-- Indices de la tabla `prestamo`
--
ALTER TABLE `prestamo`
  ADD PRIMARY KEY (`IdPrestamo`),
  ADD KEY `id_empleado` (`IdEmpleado`),
  ADD KEY `id_herramienta_e_insumo` (`IdHerramientaInsumo`);

--
-- Indices de la tabla `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`IdRol`);

--
-- Indices de la tabla `servicios`
--
ALTER TABLE `servicios`
  ADD PRIMARY KEY (`IdServicio`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`IdUsuario`),
  ADD KEY `IdRol` (`IdRol`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `agendamiento`
--
ALTER TABLE `agendamiento`
  MODIFY `IdAgendamiento` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `detalleprestamo`
--
ALTER TABLE `detalleprestamo`
  MODIFY `IdDetallePrestamo` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `empleado`
--
ALTER TABLE `empleado`
  MODIFY `IdEmpleado` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `herramientainsumo`
--
ALTER TABLE `herramientainsumo`
  MODIFY `IdHerramientaInsumo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT de la tabla `prestamo`
--
ALTER TABLE `prestamo`
  MODIFY `IdPrestamo` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- AUTO_INCREMENT de la tabla `rol`
--
ALTER TABLE `rol`
  MODIFY `IdRol` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `servicios`
--
ALTER TABLE `servicios`
  MODIFY `IdServicio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `IdUsuario` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `agendamiento`
--
ALTER TABLE `agendamiento`
  ADD CONSTRAINT `agendamiento_ibfk_2` FOREIGN KEY (`IdServicio`) REFERENCES `servicios` (`IdServicio`),
  ADD CONSTRAINT `agendamiento_ibfk_3` FOREIGN KEY (`IdEmpleado`) REFERENCES `empleado` (`IdEmpleado`);

--
-- Filtros para la tabla `detalleprestamo`
--
ALTER TABLE `detalleprestamo`
  ADD CONSTRAINT `detalleprestamo_ibfk_1` FOREIGN KEY (`IdHerramientaInsumo`) REFERENCES `herramientainsumo` (`IdHerramientaInsumo`);

--
-- Filtros para la tabla `prestamo`
--
ALTER TABLE `prestamo`
  ADD CONSTRAINT `prestamo_ibfk_2` FOREIGN KEY (`IdHerramientaInsumo`) REFERENCES `herramientainsumo` (`IdHerramientaInsumo`),
  ADD CONSTRAINT `prestamo_ibfk_3` FOREIGN KEY (`IdEmpleado`) REFERENCES `empleado` (`IdEmpleado`);

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `Usuario_ibfk_1` FOREIGN KEY (`IdRol`) REFERENCES `rol` (`IdRol`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
