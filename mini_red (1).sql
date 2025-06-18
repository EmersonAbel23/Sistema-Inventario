-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 17-06-2025 a las 08:46:20
-- Versión del servidor: 10.4.13-MariaDB
-- Versión de PHP: 7.4.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `mini_red`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE `categoria` (
  `id_categoria` int(11) NOT NULL,
  `nombre_categoria` varchar(50) NOT NULL,
  `descripcion_categoria` varchar(255) DEFAULT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT 1,
  `id_rubro` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`id_categoria`, `nombre_categoria`, `descripcion_categoria`, `estado`, `id_rubro`) VALUES
(1, 'Lacteos', 'toda clase de lacteos de todas las marca', 1, 2),
(3, 'Abarrotes', 'Toda clase de Abarrotes', 1, 2),
(4, 'Gaseosas', 'Todo tipo de gaseosas', 1, 2),
(5, 'chocolates', 'todo tipo de chocolate', 1, 2),
(6, 'Galletas', 'toda clase de galletas', 1, 2),
(18, 'Accesorios', 'de toda marcas', 1, 1),
(25, 'Ropa', 'todo tipo de ropa', 1, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `descripcion_doc`
--

CREATE TABLE `descripcion_doc` (
  `ruc` varchar(15) DEFAULT NULL,
  `dni` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `marca`
--

CREATE TABLE `marca` (
  `id_marca` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `estado` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `id` int(11) NOT NULL,
  `nombre` varchar(25) NOT NULL,
  `precio` int(11) NOT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `stock` int(10) DEFAULT NULL,
  `descripcion` varchar(255) DEFAULT NULL,
  `codigo_prod` varchar(255) DEFAULT NULL,
  `estado` int(10) DEFAULT 1,
  `id_proveedor` int(11) DEFAULT NULL,
  `id_categoria` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`id`, `nombre`, `precio`, `foto`, `stock`, `descripcion`, `codigo_prod`, `estado`, `id_proveedor`, `id_categoria`) VALUES
(1, 'leche', 52, NULL, 5, 'leche pura vida en alta', '245784', NULL, 2, 6),
(3, 'espiassssss', 20, NULL, 86, 'leche pura vida en alta', 'jghjghjghjghjghj', NULL, NULL, NULL),
(16, 'Gaseosa Cola Plus 1.5L', 71, '1.jpg', 120, 'Gaseosa sabor cola de 1.5 litros', 'GAS001', 1, NULL, NULL),
(17, 'talcos', 25, '1.jpg', 10, 'talco para ies', '00000124578', 1, NULL, NULL),
(18, 'espias', 20, 'Captura.JPG', 86, 'leche pura vida en alta', 'jghjghjghjghjghj', 1, 1, 3),
(19, 'laptop', 2000, 'xd.jpg', 4, 'laptop hp', '0001245787444', NULL, 3, 18),
(20, 'celular', 250, 'wave.png', 50, 'toda marca de celulares', '124555782454', NULL, 1, 18),
(21, 'desodorante', 15, '1.jpg', 50, 'xasxasxasxaxasxas', '1254789631251', NULL, 4, 1),
(22, 'teclado', 45, 'avatar2.png', 40, 'sadasdasdasdsa', '12457963584', NULL, 1, 1),
(23, 'polos manga larga', 20, 'Captura.JPG', 20, 'manga larga de nikes', '1254698563', NULL, 4, 25),
(24, 'pantalon', 25, NULL, 20, 'pantalon hym', '02123065478', NULL, 3, 25),
(25, 'maouse', 30, 'Captura.JPG', 45, 'mause gamer', '12456326978', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedor`
--

CREATE TABLE `proveedor` (
  `id_proveedor` int(11) NOT NULL,
  `nombre_proveedor` varchar(100) NOT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `direccion` varchar(150) DEFAULT NULL,
  `correo` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `proveedor`
--

INSERT INTO `proveedor` (`id_proveedor`, `nombre_proveedor`, `telefono`, `direccion`, `correo`) VALUES
(1, 'TecnoPlus', '987654321', 'Av. Siempre Viva 123', 'contacto@tecnoplus.com'),
(2, 'SnackManía', '912345678', 'Jr. Las Delicias 45', 'ventas@snackmania.pe'),
(3, 'ModaFlex', '922334455', 'Calle Estilo 99', 'info@modaflex.com'),
(4, 'CleanPeru', '933221100', 'Av. Higiene 777', 'clientes@cleanperu.com'),
(5, 'Leche Gloria', '912699828', 'mx d lote 3 av lauis', 'leche@gloria.com'),
(6, 'Refrescos Andinos', '987654321', 'Av. Central 123, Lima', 'ventas@refrescosandinos.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rubro`
--

CREATE TABLE `rubro` (
  `id_rubro` int(11) NOT NULL,
  `nombre_rubro` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `rubro`
--

INSERT INTO `rubro` (`id_rubro`, `nombre_rubro`) VALUES
(1, 'Tecnología'),
(2, 'Alimentos'),
(3, 'Ropa'),
(4, 'Limpieza');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id` int(11) NOT NULL,
  `user` varchar(50) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `tipo_usuario` varchar(25) DEFAULT NULL,
  `nombre` varchar(30) DEFAULT NULL,
  `apellido` varchar(30) DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id`, `user`, `password`, `tipo_usuario`, `nombre`, `apellido`, `foto`) VALUES
(1, 'admin@gmail.com', 'admin123', 'admin', 'Luis Angel', 'Ruiz Diaz', NULL),
(3, 'abel@gmail.com', '123', 'usuario', 'Abel Emerson', 'Yauri Tapara', NULL),
(5, 'ermerson@prueba', '123456789', 'usuario', 'Emerson A', 'casimiro llayi', NULL);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`id_categoria`),
  ADD KEY `fk_categoria_rubro` (`id_rubro`);

--
-- Indices de la tabla `marca`
--
ALTER TABLE `marca`
  ADD PRIMARY KEY (`id_marca`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_producto_proveedor` (`id_proveedor`),
  ADD KEY `fk_producto_categoria` (`id_categoria`);

--
-- Indices de la tabla `proveedor`
--
ALTER TABLE `proveedor`
  ADD PRIMARY KEY (`id_proveedor`);

--
-- Indices de la tabla `rubro`
--
ALTER TABLE `rubro`
  ADD PRIMARY KEY (`id_rubro`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `id_categoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT de la tabla `marca`
--
ALTER TABLE `marca`
  MODIFY `id_marca` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT de la tabla `proveedor`
--
ALTER TABLE `proveedor`
  MODIFY `id_proveedor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `rubro`
--
ALTER TABLE `rubro`
  MODIFY `id_rubro` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD CONSTRAINT `fk_categoria_rubro` FOREIGN KEY (`id_rubro`) REFERENCES `rubro` (`id_rubro`);

--
-- Filtros para la tabla `producto`
--
ALTER TABLE `producto`
  ADD CONSTRAINT `fk_producto_categoria` FOREIGN KEY (`id_categoria`) REFERENCES `categoria` (`id_categoria`),
  ADD CONSTRAINT `fk_producto_proveedor` FOREIGN KEY (`id_proveedor`) REFERENCES `proveedor` (`id_proveedor`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
