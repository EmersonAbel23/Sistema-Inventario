-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 24-06-2025 a las 11:14:19
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
(32, 'Gaseosa', 'Bebidas carbonatadas de diferentes sabores y marcas.', 1, 7),
(33, 'Agua mineral', 'Agua embotellada con o sin gas.', 1, 7),
(34, 'Leche', 'Leche entera, descremada, evaporada o deslactosada.', 1, 8),
(35, 'Quesos', 'Variedades de queso fresco y maduro.', 1, 8),
(36, 'Arroz', 'Diferentes tipos de arroz: extra, superior, integral.', 1, 9),
(37, 'Fideos', 'Pastas cortas, largas, integrales.', 1, 9),
(38, 'Detergente', 'Líquidos o en polvo para lavar ropa o vajilla', 1, 11),
(39, 'Desinfectantes', 'Lejía, limpiadores multiusos, alcohol.', 1, 11),
(40, 'Aceite', 'Aceites para cocina', 1, 9);

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
(26, 'Aceite Vegetal Primor 1L', 9, 'aceote.JPG', 50, 'Aceite vegetal ideal para cocinar y freír.', 'PRD001', 1, 7, 40);

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
(7, 'Distribuidora Santa Rosa', '987654321', 'Av. Universitaria 123, Lima', 'contacto@santarosa.com'),
(8, 'Agro Perú S.A.C.', '945123789', 'Jr. Ayacucho 456, Arequipa', 'ventas@agroperu.com'),
(9, 'Bebidas Andinas SRL', '934567821', 'Calle Cusco 890, Cusco', 'info@bebidasandinas.com'),
(10, 'Lácteos Los Andes', '912345678', 'Av. Grau 220, Trujillo', 'lacteos@losandes.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE `rol` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`id`, `nombre`) VALUES
(1, 'admin'),
(2, 'usuario');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rubro`
--

CREATE TABLE `rubro` (
  `id_rubro` int(11) NOT NULL,
  `nombre_rubro` varchar(100) NOT NULL,
  `descripcion_rubro` varchar(255) DEFAULT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `rubro`
--

INSERT INTO `rubro` (`id_rubro`, `nombre_rubro`, `descripcion_rubro`, `estado`) VALUES
(5, 'Comida', 'Comida', 1),
(7, 'Bebidas', 'Productos líquidos como jugos, gaseosas, agua, energizantes, etc.', 1),
(8, 'Lácteos', 'Productos derivados de la leche como yogurt, queso, leche, mantequilla.', 1),
(9, 'Abarrotes', 'Productos secos como arroz, fideos, azúcar, menestras, conservas.', 1),
(10, 'Snacks', 'Galletas, papas fritas, chocolates, caramelos, frutos secos.', 1),
(11, 'Limpieza', 'Detergentes, lejía, esponjas, jabón, limpiavidrios, desinfectantes.', 1),
(12, 'Cuidado personal', 'Shampoo, jabón, crema dental, papel higiénico, pañales.', 1),
(13, 'Panadería', 'Pan, bollos, pasteles, bizcochos, tortas, panetones.', 1),
(14, 'Verduras y Frutas', 'Productos frescos como plátanos, manzanas, papas, cebolla.', 1),
(15, 'Carnes y Embutidos', 'Pollo, carne de res, salchichas, jamón, chorizos.', 1),
(16, 'Congelados', 'Helados, productos congelados listos para cocinar.', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id` int(11) NOT NULL,
  `user` varchar(50) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `nombre` varchar(30) DEFAULT NULL,
  `apellido` varchar(30) DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `token_recuperacion` varchar(100) DEFAULT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT 1,
  `id_rol` int(11) NOT NULL DEFAULT 2
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id`, `user`, `password`, `nombre`, `apellido`, `foto`, `token_recuperacion`, `estado`, `id_rol`) VALUES
(1, 'admin@gmail.com', 'admin123', 'Luis', 'Ruiz Díaz', NULL, NULL, 1, 1),
(3, 'abel@gmail.com', '123', 'Abel Emerson', 'Yauri Taparaaasassa', NULL, NULL, 1, 2),
(15, 'KevinC@gmail.com', 'kevin2323', 'Kevin Carlos', 'Castillo', NULL, NULL, 1, 2),
(16, 'daniloSantos@gmail.com', '123', 'danilosaaaa', 'santossssss', NULL, NULL, 1, 2),
(19, 'pruebaspruebanormal@gmail.com', '123', 'Prueba', 'prueba', NULL, '7d230179bf37516f9dfa152c15ec392fdd979841', 1, 2);

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
-- Indices de la tabla `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `rubro`
--
ALTER TABLE `rubro`
  ADD PRIMARY KEY (`id_rubro`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_usuario_rol` (`id_rol`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `id_categoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT de la tabla `marca`
--
ALTER TABLE `marca`
  MODIFY `id_marca` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT de la tabla `proveedor`
--
ALTER TABLE `proveedor`
  MODIFY `id_proveedor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `rol`
--
ALTER TABLE `rol`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `rubro`
--
ALTER TABLE `rubro`
  MODIFY `id_rubro` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

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

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `fk_usuario_rol` FOREIGN KEY (`id_rol`) REFERENCES `rol` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
