-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 19-08-2025 a las 03:36:14
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
(32, 'Bebidas', 'Bebidaszzzzzzzzzz', 1, 7),
(33, 'Agua mineral', 'Agua embotellada con o sin gas.', 1, 7),
(34, 'Leche', 'Leche entera, descremada, evaporada o deslactosada.', 1, 8),
(35, 'Quesos', 'Variedades de queso fresco y maduro.', 1, 8),
(36, 'Arroz', 'Diferentes tipos de arroz: extra, superior, integral.', 1, 9),
(37, 'Fideos', 'Pastas cortas, largas, integrales.', 1, 9),
(38, 'Detergente', 'Líquidos o en polvo para lavar ropa o vajilla', 1, 11),
(39, 'Desinfectantes', 'Lejía, limpiadores multiusos, alcohol.', 1, 11),
(40, 'Abarrotes', 'abarrotes  tales comoa rroz , azucar', 0, 9),
(41, 'HHH', 'sin hhhhhh', 0, 11);

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
-- Estructura de tabla para la tabla `detalle_venta`
--

CREATE TABLE `detalle_venta` (
  `id_detalle` int(11) NOT NULL,
  `id_venta` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precio_unitario` decimal(10,2) NOT NULL,
  `subtotal` decimal(10,2) GENERATED ALWAYS AS (`cantidad` * `precio_unitario`) STORED
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `detalle_venta`
--

INSERT INTO `detalle_venta` (`id_detalle`, `id_venta`, `id_producto`, `cantidad`, `precio_unitario`) VALUES
(1, 1, 27, 2, '25.00'),
(2, 1, 35, 1, '100.00'),
(3, 2, 26, 2, '9.00'),
(4, 2, 35, 1, '2.50'),
(5, 3, 36, 2, '12.00'),
(6, 3, 27, 1, '5.00'),
(7, 3, 35, 2, '2.50'),
(8, 4, 27, 1, '5.00'),
(9, 5, 36, 9, '12.00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `entrada_producto`
--

CREATE TABLE `entrada_producto` (
  `id_entrada` int(11) NOT NULL,
  `fecha_entrada` date NOT NULL,
  `cantidad_entrada` int(11) NOT NULL,
  `precio_unitario` decimal(10,2) NOT NULL,
  `id_producto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `entrada_producto`
--

INSERT INTO `entrada_producto` (`id_entrada`, `fecha_entrada`, `cantidad_entrada`, `precio_unitario`, `id_producto`) VALUES
(1, '2025-08-01', 5, '2400.00', 26),
(2, '2025-08-10', 3, '2500.00', 26),
(3, '2025-08-15', 12, '2.00', 27),
(4, '2025-08-16', 1, '2.00', 27),
(5, '2025-08-17', 2, '9.50', 36),
(6, '2025-08-17', 10, '9.50', 36),
(7, '2025-08-17', 12, '9.50', 36);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `marca`
--

CREATE TABLE `marca` (
  `id_marca` int(11) NOT NULL,
  `nombre_marca` varchar(100) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `estado` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `marca`
--

INSERT INTO `marca` (`id_marca`, `nombre_marca`, `descripcion`, `estado`) VALUES
(4, 'Pura vida', 'Leche en tarro pura vida ', 1),
(6, 'nikefffff', 'aaaaaaaaaaaa', 1),
(7, 'Cielo', 'Agua cielo enbotellada de 500ml', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `id` int(11) NOT NULL,
  `nombre` varchar(25) NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `stock` int(10) DEFAULT NULL,
  `descripcion` varchar(255) DEFAULT NULL,
  `codigo_prod` varchar(255) DEFAULT NULL,
  `estado` int(10) DEFAULT 1,
  `id_proveedor` int(11) DEFAULT NULL,
  `id_categoria` int(11) DEFAULT NULL,
  `id_marca` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`id`, `nombre`, `precio`, `foto`, `stock`, `descripcion`, `codigo_prod`, `estado`, `id_proveedor`, `id_categoria`, `id_marca`) VALUES
(26, 'Aceite Vegetal Primor 1L', '9.00', 'aceote.JPG', 13, 'Aceite vegetal ideal para cocinar y freír.', 'PRD001', 1, NULL, 40, NULL),
(27, 'leche', '5.00', 'leche.jfif', 14, 'leche pura vida en alta', 'LC21', 1, 10, 34, NULL),
(35, 'Agua mineral ', '2.50', 'images.jfif', 12, 'Agua enbotellada', 'AG00041', 1, 8, 33, NULL),
(36, 'Four loko', '12.00', 'images.jpeg', 12, 'four loko maracuya', 'F0001', 1, 9, 32, NULL);

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
(5, 'Comida', 'Comidassss', 1),
(7, 'Bebidas', 'Productos líquidos como jugos, gaseosas, agua, energizantes, etc.', 1),
(8, 'Lácteos', 'Productos derivados de la leche como yogurt, queso, leche, mantequilla.', 1),
(9, 'Abarrotes', 'Productos secos como arroz, fideos, azúcar, menestras, conservas.', 1),
(10, 'Snacks', 'Galletas, papas fritas, chocolates, caramelos, frutos secos.', 1),
(11, 'Limpieza', 'Detergentes, lejía, esponjas, jabón, limpiavidrios, desinfectantes.', 1),
(12, 'Cuidado personal', 'Shampoo, jabón, crema dental, papel higiénico, pañales.', 1),
(13, 'Panadería', 'Pan, bollos, pasteles, bizcochos, tortas, panetones.', 1),
(14, 'Verduras y Frutas', 'Productos frescos como plátanos, manzanas, papas, cebolla.', 1),
(15, 'Carnes y Embutidos', 'Pollo, carne de res, salchichas, jamón, chorizos.', 1),
(16, 'Congelados', 'Helados, productos congelados listos para cocinar.', 1),
(17, 'ssssssssss', 'sssssssssss', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `salida_producto`
--

CREATE TABLE `salida_producto` (
  `id_salida` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `fecha_salida` date NOT NULL DEFAULT current_timestamp(),
  `cantidad_salida` int(11) NOT NULL,
  `motivo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `salida_producto`
--

INSERT INTO `salida_producto` (`id_salida`, `id_producto`, `fecha_salida`, `cantidad_salida`, `motivo`) VALUES
(1, 27, '2025-08-10', 5, 'Venta'),
(2, 27, '2025-08-11', 2, 'Donación'),
(3, 35, '2025-08-12', 1, 'Producto defectuoso'),
(4, 36, '2025-08-17', 5, 'venta'),
(5, 36, '2025-08-17', 1, 'venta');

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
(3, 'abel.yauri1901@gmail.com', '75599888457', 'Abel Emerson', 'Yauri Taparaaasassa', NULL, NULL, 1, 2),
(15, 'KevinC@gmail.com', 'kevin2323', 'Kevin Carlos', 'Castillo', NULL, NULL, 1, 2),
(16, 'daniloSantos@gmail.com', 'dsnilo23', 'danilosaaaa', 'santossssss', NULL, NULL, 1, 2),
(19, 'pruebaspruebanormal@gmail.com', '123', 'Prueba', 'prueba', NULL, '7d230179bf37516f9dfa152c15ec392fdd979841', 1, 2),
(20, 'electronicsminka@gmail.com', 'AAAA', 'Diana', 'soto huaychay', NULL, NULL, 1, 2),
(21, 'valyuri060411@gmail.com', 'Amanecer2011.', 'Valeria Yuriana', 'Gallo Carrasco', NULL, NULL, 1, 2),
(22, 'nayelimantaritaipe@gmail.com', NULL, 'Andrea', 'Mantari', NULL, NULL, 1, 2),
(23, 'geraldine73020@gmail.com', NULL, 'geraldine', 'Rdoriguez', NULL, NULL, 1, 2),
(24, 'geraldine73020@gmail.com', NULL, 'geraldine', 'Rdoriguez', NULL, NULL, 1, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `venta`
--

CREATE TABLE `venta` (
  `id_venta` int(11) NOT NULL,
  `fecha_venta` datetime NOT NULL DEFAULT current_timestamp(),
  `total` decimal(10,2) NOT NULL,
  `cliente` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `venta`
--

INSERT INTO `venta` (`id_venta`, `fecha_venta`, `total`, `cliente`) VALUES
(1, '2025-08-17 12:30:00', '150.00', 'Juan Pérez'),
(2, '2025-08-17 14:58:30', '20.50', 'emerson'),
(3, '2025-08-17 15:00:20', '34.00', 'yasuri'),
(4, '2025-08-17 15:04:14', '5.00', 'johaira'),
(5, '2025-08-17 15:04:44', '108.00', 'emerson'),
(6, '2025-08-17 15:35:35', '0.00', 'emerson');

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
-- Indices de la tabla `detalle_venta`
--
ALTER TABLE `detalle_venta`
  ADD PRIMARY KEY (`id_detalle`),
  ADD KEY `id_venta` (`id_venta`),
  ADD KEY `id_producto` (`id_producto`);

--
-- Indices de la tabla `entrada_producto`
--
ALTER TABLE `entrada_producto`
  ADD PRIMARY KEY (`id_entrada`),
  ADD KEY `id_producto` (`id_producto`);

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
  ADD KEY `fk_producto_categoria` (`id_categoria`),
  ADD KEY `fk_producto_marca` (`id_marca`);

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
-- Indices de la tabla `salida_producto`
--
ALTER TABLE `salida_producto`
  ADD PRIMARY KEY (`id_salida`),
  ADD KEY `id_producto` (`id_producto`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_usuario_rol` (`id_rol`);

--
-- Indices de la tabla `venta`
--
ALTER TABLE `venta`
  ADD PRIMARY KEY (`id_venta`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `id_categoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT de la tabla `detalle_venta`
--
ALTER TABLE `detalle_venta`
  MODIFY `id_detalle` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `entrada_producto`
--
ALTER TABLE `entrada_producto`
  MODIFY `id_entrada` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `marca`
--
ALTER TABLE `marca`
  MODIFY `id_marca` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

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
  MODIFY `id_rubro` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de la tabla `salida_producto`
--
ALTER TABLE `salida_producto`
  MODIFY `id_salida` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT de la tabla `venta`
--
ALTER TABLE `venta`
  MODIFY `id_venta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD CONSTRAINT `fk_categoria_rubro` FOREIGN KEY (`id_rubro`) REFERENCES `rubro` (`id_rubro`);

--
-- Filtros para la tabla `detalle_venta`
--
ALTER TABLE `detalle_venta`
  ADD CONSTRAINT `detalle_venta_ibfk_1` FOREIGN KEY (`id_venta`) REFERENCES `venta` (`id_venta`) ON DELETE CASCADE,
  ADD CONSTRAINT `detalle_venta_ibfk_2` FOREIGN KEY (`id_producto`) REFERENCES `producto` (`id`);

--
-- Filtros para la tabla `entrada_producto`
--
ALTER TABLE `entrada_producto`
  ADD CONSTRAINT `entrada_producto_ibfk_1` FOREIGN KEY (`id_producto`) REFERENCES `producto` (`id`);

--
-- Filtros para la tabla `producto`
--
ALTER TABLE `producto`
  ADD CONSTRAINT `fk_producto_categoria` FOREIGN KEY (`id_categoria`) REFERENCES `categoria` (`id_categoria`),
  ADD CONSTRAINT `fk_producto_marca` FOREIGN KEY (`id_marca`) REFERENCES `marca` (`id_marca`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_producto_proveedor` FOREIGN KEY (`id_proveedor`) REFERENCES `proveedor` (`id_proveedor`);

--
-- Filtros para la tabla `salida_producto`
--
ALTER TABLE `salida_producto`
  ADD CONSTRAINT `salida_producto_ibfk_1` FOREIGN KEY (`id_producto`) REFERENCES `producto` (`id`);

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `fk_usuario_rol` FOREIGN KEY (`id_rol`) REFERENCES `rol` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
