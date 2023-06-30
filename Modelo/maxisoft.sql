-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 29-06-2023 a las 23:46:24
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
  `IdUsuario` int(50) NOT NULL,
  `IdServicio` int(50) NOT NULL,
  `IdHerramientaInsumo` varchar(50) NOT NULL,
  `NombreCliente` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `Descripcion` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `FechaServicio` date NOT NULL,
  `HoraAgendamiento` varchar(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `DireccionCliente` varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `TelefonoCliente` bigint(15) NOT NULL,
  `Estado` varchar(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalleprestamo`
--

CREATE TABLE `detalleprestamo` (
  `IdDetallePrestamo` int(10) NOT NULL,
  `IdPrestamo` int(10) NOT NULL,
  `IdHerramientaInsumo` int(10) NOT NULL,
  `CantidadElemento` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `herramientadanada`
--

CREATE TABLE `herramientadanada` (
  `IdHerramientaDanada` int(10) NOT NULL,
  `IdHerramientaInsumo` int(10) NOT NULL,
  `IdUsuario` int(10) NOT NULL,
  `CantidadElemento` int(20) NOT NULL,
  `Observacion` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `herramientadanada`
--

INSERT INTO `herramientadanada` (`IdHerramientaDanada`, `IdHerramientaInsumo`, `IdUsuario`, `CantidadElemento`, `Observacion`) VALUES
(12, 38, 1, 12, 'kasdhjk');

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
  `Medida` varchar(12) COLLATE utf8_unicode_ci NOT NULL,
  `Estado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `herramientainsumo`
--

INSERT INTO `herramientainsumo` (`IdHerramientaInsumo`, `Nombre`, `Tipo`, `Categoria`, `Descripcion`, `Color`, `FechaCompra`, `Cantidad`, `Medida`, `Estado`) VALUES
(38, 'tales de tales', 'Herramienta', 'Manual', '123', '123', '22-06-2023', 111, 'M', 0),
(39, 'tales', 'Insumo', 'Cable', '123', '23', '29-06-2023', 123, 'U', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `insumoagenda`
--

CREATE TABLE `insumoagenda` (
  `IdInsumoAgenda` int(11) NOT NULL,
  `IdHerramientaInsumo` varchar(50) NOT NULL,
  `IdAgendamiento` int(11) NOT NULL,
  `Cantidad` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `novedad`
--

CREATE TABLE `novedad` (
  `IdNovedad` int(11) NOT NULL,
  `IdUsuario` int(11) NOT NULL,
  `Peticion` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `Descripcion` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `FechaRegistro` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `FechaInicio` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `FechaFinal` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `HoraInicio` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `HoraFinal` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `EstadoNovedad` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permiso`
--

CREATE TABLE `permiso` (
  `IdPermiso` int(20) NOT NULL,
  `NombrePermiso` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Permiso` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `permiso`
--

INSERT INTO `permiso` (`IdPermiso`, `NombrePermiso`, `Permiso`) VALUES
(1, 'Administrador', '1'),
(2, 'Empleado', '0');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `prestamo`
--

CREATE TABLE `prestamo` (
  `IdPrestamo` int(10) NOT NULL,
  `IdUsuario` int(10) NOT NULL,
  `FechaPrestamo` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE `rol` (
  `IdRol` int(50) NOT NULL,
  `NombreRol` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `IdPermiso` int(20) NOT NULL,
  `Permisos` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `FechaRol` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `EstadoRol` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`IdRol`, `NombreRol`, `IdPermiso`, `Permisos`, `FechaRol`, `EstadoRol`) VALUES
(1, 'Administrador', 1, '1,1,1,1,1,1,1', '07-06-2023 12:24:08', '1'),
(2, 'Novato', 1, '1,1,1,1,1,1,1', '07-06-2023 12:24:08', '1'),
(3, 'Practicante', 2, '1,1,0', '07-06-2023 12:24:08', '1'),
(10, 'Semi Administrador', 1, '1,1,0,0,0,1,1', '16-06-2023 07:12:36', '1'),
(11, 'Semi Novato', 2, '1,0,1', '16-06-2023 07:13:05', '1'),
(16, 'jbnj', 2, '1,1,1', '22-06-2023 12:38:38', '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `servicio`
--

CREATE TABLE `servicio` (
  `IdServicio` int(50) NOT NULL,
  `Nombre` varchar(30) NOT NULL,
  `Estado` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `servicio`
--

INSERT INTO `servicio` (`IdServicio`, `Nombre`, `Estado`) VALUES
(1, 'Cambio de Router', '2'),
(2, 'Cambio de Antena', '1'),
(3, 'Agregar Repetidor', '1'),
(4, 'Cambio de Servicio', '2');

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
  `Documento` bigint(30) NOT NULL,
  `Correo` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Contrasena` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Telefono` bigint(20) NOT NULL,
  `Direccion` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Estado` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`IdUsuario`, `IdRol`, `Nombre`, `Apellido`, `TipoDocumento`, `Documento`, `Correo`, `Contrasena`, `Telefono`, `Direccion`, `Estado`) VALUES
(1, 1, 'Pablo', 'Franco', 'Cédula', 1234, 'oe@gmail.com', '6a6189213a862710e0176352cde959d5f6d5037aa10d10eb60154d4e8f65d93252eacc18b4e2133e1a9232d5d86c2eb03e421d71b3c31d7ae773c14981ce9390', 301, 'szs', 1),
(2, 1, 'Dana Andresa', 'Aranga Chavarra', 'Cédula', 1011310101, 'dana@gmail.com', 'sG8Gy3UB9+Dg+2QSmJNMbiOv4vwANTgHthYjDxzsFXk=', 3244723715, 'aya', 1),
(3, 3, 'Alvaro', 'Alvarado', 'Cédula', 1234, 'alvaro@gmail.com', '6a6189213a862710e0176352cde959d5f6d5037aa10d10eb60154d4e8f65d93252eacc18b4e2133e1a9232d5d86c2eb03e421d71b3c31d7ae773c14981ce9390', 1234, 'Mi casa', 0),
(4, 3, 'Alvaro', 'Andresa', 'Cédula', 1234, 'alvaro@gmail.com', '449f672e7cd44e00c2c8a55cd3af89ce6ce1ace97e2cdf8ba9bfa5991ae1dbaaa0e24d70ce44313401cd5bfc5485625e775691944a5c0903b184c9fbc4cd2b34', 2147483647, 'Mi casa', 1),
(5, 1, 'Yenny', 'Durango', 'Cédula', 1234, 'yenny@gmail.com', 'be35cc81970680c7795eaea095bed0f2feefc4d24cba3c710f0c7cb3f75ffbca5d590a5ad6e89f1679725b72ffe13b457cd81db3220f1160770811e775435839', 2147483647, 'Mi casa', 1),
(6, 16, 'paco', 'pacosteco', 'Tarjeta de identidad', 12038134, 'paco@gmail.com', '0bb66d489c087e32be726ce3276fe29495885976f823a75c3436615b7017aff97f006d17a159ce3a5b2cc9f02c1e4993ebe22035e4f85caacf3cfbe2e7d8fce4', 2147483647, 'peaco', 0),
(7, 1, 'Tester', 'Master', 'cc', 1234567890, 'tron@gmail.com', '6a6189213a862710e0176352cde959d5f6d5037aa10d10eb60154d4e8f65d93252eacc18b4e2133e1a9232d5d86c2eb03e421d71b3c31d7ae773c14981ce9390', 12, '1', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `agendamiento`
--
ALTER TABLE `agendamiento`
  ADD PRIMARY KEY (`IdAgendamiento`),
  ADD KEY `IdUsuario` (`IdUsuario`),
  ADD KEY `IdServicio` (`IdServicio`);

--
-- Indices de la tabla `detalleprestamo`
--
ALTER TABLE `detalleprestamo`
  ADD PRIMARY KEY (`IdDetallePrestamo`),
  ADD KEY `IdPrestamo` (`IdPrestamo`),
  ADD KEY `IdHerramientaInsumo` (`IdHerramientaInsumo`);

--
-- Indices de la tabla `herramientadanada`
--
ALTER TABLE `herramientadanada`
  ADD PRIMARY KEY (`IdHerramientaDanada`),
  ADD KEY `id_herramienta_e_insumo` (`IdHerramientaInsumo`),
  ADD KEY `IdPrestamo` (`IdUsuario`);

--
-- Indices de la tabla `herramientainsumo`
--
ALTER TABLE `herramientainsumo`
  ADD PRIMARY KEY (`IdHerramientaInsumo`);

--
-- Indices de la tabla `insumoagenda`
--
ALTER TABLE `insumoagenda`
  ADD PRIMARY KEY (`IdInsumoAgenda`),
  ADD KEY `IdAgendamiento` (`IdAgendamiento`),
  ADD KEY `IdHerramientaInsumo` (`IdHerramientaInsumo`);

--
-- Indices de la tabla `novedad`
--
ALTER TABLE `novedad`
  ADD PRIMARY KEY (`IdNovedad`),
  ADD KEY `IdEmpleado` (`IdUsuario`);

--
-- Indices de la tabla `permiso`
--
ALTER TABLE `permiso`
  ADD PRIMARY KEY (`IdPermiso`);

--
-- Indices de la tabla `prestamo`
--
ALTER TABLE `prestamo`
  ADD PRIMARY KEY (`IdPrestamo`),
  ADD KEY `id_empleado` (`IdUsuario`);

--
-- Indices de la tabla `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`IdRol`),
  ADD KEY `IdPermiso` (`IdPermiso`);

--
-- Indices de la tabla `servicio`
--
ALTER TABLE `servicio`
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
  MODIFY `IdAgendamiento` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT de la tabla `detalleprestamo`
--
ALTER TABLE `detalleprestamo`
  MODIFY `IdDetallePrestamo` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT de la tabla `herramientadanada`
--
ALTER TABLE `herramientadanada`
  MODIFY `IdHerramientaDanada` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `herramientainsumo`
--
ALTER TABLE `herramientainsumo`
  MODIFY `IdHerramientaInsumo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT de la tabla `insumoagenda`
--
ALTER TABLE `insumoagenda`
  MODIFY `IdInsumoAgenda` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT de la tabla `novedad`
--
ALTER TABLE `novedad`
  MODIFY `IdNovedad` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `permiso`
--
ALTER TABLE `permiso`
  MODIFY `IdPermiso` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `prestamo`
--
ALTER TABLE `prestamo`
  MODIFY `IdPrestamo` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=91;

--
-- AUTO_INCREMENT de la tabla `rol`
--
ALTER TABLE `rol`
  MODIFY `IdRol` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `servicio`
--
ALTER TABLE `servicio`
  MODIFY `IdServicio` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `IdUsuario` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `agendamiento`
--
ALTER TABLE `agendamiento`
  ADD CONSTRAINT `agendamiento_ibfk_3` FOREIGN KEY (`IdUsuario`) REFERENCES `usuario` (`IdUsuario`),
  ADD CONSTRAINT `agendamiento_ibfk_4` FOREIGN KEY (`IdServicio`) REFERENCES `servicio` (`IdServicio`);

--
-- Filtros para la tabla `detalleprestamo`
--
ALTER TABLE `detalleprestamo`
  ADD CONSTRAINT `detalleprestamo_ibfk_1` FOREIGN KEY (`IdHerramientaInsumo`) REFERENCES `herramientainsumo` (`IdHerramientaInsumo`),
  ADD CONSTRAINT `detalleprestamo_ibfk_2` FOREIGN KEY (`IdPrestamo`) REFERENCES `prestamo` (`IdPrestamo`);

--
-- Filtros para la tabla `herramientadanada`
--
ALTER TABLE `herramientadanada`
  ADD CONSTRAINT `herramientadanada_ibfk_1` FOREIGN KEY (`IdHerramientaInsumo`) REFERENCES `herramientainsumo` (`IdHerramientaInsumo`),
  ADD CONSTRAINT `herramientadanada_ibfk_2` FOREIGN KEY (`IdUsuario`) REFERENCES `usuario` (`IdUsuario`);

--
-- Filtros para la tabla `insumoagenda`
--
ALTER TABLE `insumoagenda`
  ADD CONSTRAINT `insumoagenda_ibfk_1` FOREIGN KEY (`IdAgendamiento`) REFERENCES `agendamiento` (`IdAgendamiento`);

--
-- Filtros para la tabla `novedad`
--
ALTER TABLE `novedad`
  ADD CONSTRAINT `novedad_ibfk_1` FOREIGN KEY (`IdUsuario`) REFERENCES `usuario` (`IdUsuario`);

--
-- Filtros para la tabla `prestamo`
--
ALTER TABLE `prestamo`
  ADD CONSTRAINT `prestamo_ibfk_1` FOREIGN KEY (`IdUsuario`) REFERENCES `usuario` (`IdUsuario`);

--
-- Filtros para la tabla `rol`
--
ALTER TABLE `rol`
  ADD CONSTRAINT `rol_ibfk_1` FOREIGN KEY (`IdPermiso`) REFERENCES `permiso` (`IdPermiso`);

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`IdRol`) REFERENCES `rol` (`IdRol`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
