-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 20-10-2022 a las 04:04:08
-- Versión del servidor: 10.4.20-MariaDB
-- Versión de PHP: 7.3.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `carrito_default`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carrito`
--

CREATE TABLE `carrito` (
  `id` int(11) NOT NULL,
  `cliente_id` int(11) NOT NULL,
  `orden_id` int(11) DEFAULT NULL,
  `precio_total` decimal(12,2) NOT NULL,
  `fecha` date NOT NULL,
  `pagado` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carrito_detalle`
--

CREATE TABLE `carrito_detalle` (
  `id` int(11) NOT NULL,
  `producto_id` int(11) NOT NULL,
  `carrito_id` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE `categoria` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`id`, `nombre`) VALUES
(1, 'Smartphone'),
(2, 'Laptop'),
(3, 'Consola'),
(4, 'Tv'),
(5, 'Tablet');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE `cliente` (
  `id` int(11) NOT NULL,
  `user_name` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nombre` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `apellido` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dni` smallint(6) NOT NULL,
  `telefono` varchar(11) COLLATE utf8mb4_unicode_ci NOT NULL,
  `correo` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `direccion` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `doctrine_migration_versions`
--

CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20221018024154', '2022-10-18 02:42:07', 385);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `marca`
--

CREATE TABLE `marca` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `marca`
--

INSERT INTO `marca` (`id`, `nombre`) VALUES
(1, 'Apple'),
(2, 'Asus'),
(3, 'Samsung'),
(4, 'Sony');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `messenger_messages`
--

CREATE TABLE `messenger_messages` (
  `id` bigint(20) NOT NULL,
  `body` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `headers` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue_name` varchar(190) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `available_at` datetime NOT NULL,
  `delivered_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `orden`
--

CREATE TABLE `orden` (
  `id` int(11) NOT NULL,
  `cliente_id` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `precio_total` decimal(12,2) NOT NULL,
  `metodo_pago` varchar(6) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `orden_detalle`
--

CREATE TABLE `orden_detalle` (
  `id` int(11) NOT NULL,
  `producto_id` int(11) NOT NULL,
  `orden_id` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `id` int(11) NOT NULL,
  `foto_id` int(11) DEFAULT NULL,
  `categoria_id` int(11) NOT NULL,
  `marca_id` int(11) NOT NULL,
  `nombre` varchar(75) COLLATE utf8mb4_unicode_ci NOT NULL,
  `precio` decimal(12,2) NOT NULL,
  `stock` int(11) NOT NULL,
  `descripcion` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`id`, `foto_id`, `categoria_id`, `marca_id`, `nombre`, `precio`, `stock`, `descripcion`) VALUES
(1, 1, 1, 1, 'Phone 12 128GB', '3449.00', 20, NULL),
(2, 6, 1, 2, 'ASUS TUF Gaming A15 AMD Ryzen 5 4600H 15', '3199.00', 20, 'Características destacadas:\r\n-Procesador: AMD Ryzen 5 4600H,\r\n-Modelo tarjeta de video: NVIDIA GeForce GTX 1650,\r\n-Tamaño de la pantalla: 15.6 pulgadas,\r\n-Disco duro: No tiene, \r\n-Disco duro sólido: 512GB'),
(3, 10, 3, 4, 'Consola PS4 Slim 500GB Jet Black', '2399.00', 20, 'Características destacadas:\r\n\r\n-Capacidad de almacenamiento: 500GB,\r\n\r\n-Procesador: AMD Jaguar,\r\n\r\n-Entradas USB: 1,\r\n\r\n-Entradas HDMI: 1,\r\n\r\n-Conectividad: USB'),
(4, 13, 1, 3, 'Galaxy A53 5G 128GB 6GB Negro', '1479.00', 20, 'A53 5G 128gb 6gb Ram Dual Sim'),
(5, 17, 1, 3, 'Galaxy Z Flip 3 128GB 8GB Negro', '4099.00', 20, 'Características destacadas:\r\n-Cámara posterior: 12.0 MP + 12.0 MP,\r\n-Cámara frontal: 10MP,\r\n-Tamaño de la pantalla: 6.7 pulgadas,\r\n-Memoria interna: 128GB,\r\n-Núcleos del procesador: Octa Core'),
(6, 21, 5, 1, 'iPad Wi-Fi 64GB 9na Gen Space Gray', '1499.00', 20, 'Características destacadas:\r\n-Procesador: Chip A13 Bionic,\r\n-Núcleos del procesador: CPU de 6 núcleos,\r\n-Tamaño de la pantalla: 10.2'),
(7, 25, 1, 1, 'iPhone 13 Pro 128GB', '4999.00', 20, 'Características destacadas:\r\n-Alto: 146.7 mm,\r\n-Ancho: 71.5 mm,\r\n-Cámara frontal: 12MP,\r\n-Cámara principal: 12MP,\r\n-Batería: Ion de litio'),
(8, 30, 2, 1, 'MacBook Air 13,6 256GB - Chip M2', '6099.00', 20, 'Características destacadas:\r\n-Procesador: M2 Apple,\r\n-Disco duro: 256 GB SSD,\r\n-Tipo de disco duro: Disco duro solido'),
(9, 34, 3, 4, 'PS5 Digital Edition - Latam', '3399.00', 20, 'Características destacadas:\r\n-Capacidad de almacenamiento: SSD 825GB,\r\n-Procesador: Procesador x86-64-AMD Ryzen Zen 2,\r\n-Entradas USB: 4,\r\n-Entradas HDMI: Compatibilidad con televisores 4K de 120Hz, televisores 8K, VRR (especificado por HDMI ver2.1),\r\n-Conectividad: WiFi/Ethernet/Bluetooth'),
(10, 37, 4, 3, 'Televisor Samsung Smart TV 65 UHD 4K', '2099.00', 20, 'Características destacadas:\r\n-Tamaño de la pantalla: 65 pulgadas,\r\n-Resolución: 3,840 x 2,160,\r\n-Tecnología: LED,\r\n-Conexión Bluetooth: Sí,\r\n-Entradas USB: 1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto_file_upload`
--

CREATE TABLE `producto_file_upload` (
  `producto_id` int(11) NOT NULL,
  `file_upload_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `producto_file_upload`
--

INSERT INTO `producto_file_upload` (`producto_id`, `file_upload_id`) VALUES
(1, 2),
(1, 3),
(1, 4),
(1, 5),
(2, 7),
(2, 8),
(2, 9),
(3, 11),
(3, 12),
(4, 14),
(4, 15),
(4, 16),
(5, 18),
(5, 19),
(5, 20),
(6, 22),
(6, 23),
(6, 24),
(7, 26),
(7, 27),
(7, 28),
(7, 29),
(8, 31),
(8, 32),
(8, 33),
(9, 35),
(9, 36),
(10, 38),
(10, 39);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `upload_file`
--

CREATE TABLE `upload_file` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `secure` varchar(48) COLLATE utf8mb4_unicode_ci NOT NULL,
  `folder` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `upload_file`
--

INSERT INTO `upload_file` (`id`, `name`, `secure`, `folder`) VALUES
(1, 'iPhone 12 128GB PRINC.jpg', 'aa7a832b2070e58204401fd2bc92c746c58ddcfe.jpg', NULL),
(2, 'iPhone 12 128GB 1.jpg', '133f5992be621901b2f8a6100a18a9c2c182cc0e.jpg', NULL),
(3, 'iPhone 12 128GB.jpg', 'df964c397bb9b177edde49d53eb7f18de1724ab7.jpg', NULL),
(4, 'iPhone 12 128GB 3.jpg', '0208db0a27f4a861f26b3f75103db36a304830a3.jpg', NULL),
(5, 'iPhone 12 128GB 4.jpg', '3af58b636cdf254cc2c9fab1bb36126bf5570c8f.jpg', NULL),
(6, 'ASUS TUF Gaming A15 AMD Ryzen 5 4600H 15.jpg', 'f326f3001a0967e028373d5046b949e34d0dbc3a.jpg', NULL),
(7, 'ASUS TUF Gaming A15 AMD Ryzen 5 4600H 15 1.jpg', 'e550106885391fdcfdef43ad917704a8df7b3895.jpg', NULL),
(8, 'ASUS TUF Gaming A15 AMD Ryzen 5 4600H 15 2.jpg', '05ba12883df4af06d842b14b471cd57659e2d0b8.jpg', NULL),
(9, 'ASUS TUF Gaming A15 AMD Ryzen 5 4600H 15 3.jpg', 'f093149bbbe872820451b8ce8510d5e1b7f03419.jpg', NULL),
(10, 'Consola PS4 Slim 500GB Jet Black.jpg', '7d9976371246f335577c9fe75540a83d802a5ba2.jpg', NULL),
(11, 'Consola PS4 Slim 500GB Jet Black 1.jpg', '492cedeb9f2451fa16369d5aa786d610d1473ebb.jpg', NULL),
(12, 'Consola PS4 Slim 500GB Jet Black 2.jpg', '72c57a138f494a952ba9f3b0763ff7db0378a5f6.jpg', NULL),
(13, 'Galaxy A53 5G 128GB 6GB Negro PRIN.jpg', '1a81ff1718e8b5fd583c8187ecc071805c7ddc91.jpg', NULL),
(14, 'Galaxy A53 5G 128GB 6GB Negro 1.jpg', '4b15616a6439f854d730c3b072a79feb4a599be9.jpg', NULL),
(15, 'Galaxy A53 5G 128GB 6GB Negro 2.jpg', '294dd15b2f694d481814ef84185918db2e9d95dc.jpg', NULL),
(16, 'Galaxy A53 5G 128GB 6GB Negro 3.jpg', 'e8e91204db88be78edba1635a4945a0035ba8b3e.jpg', NULL),
(17, 'Galaxy Z Flip 3 128GB 8GB Negro PRINC.jpg', '1f40f0dd7f0078ec4701c2c6c27bd075daf7b514.jpg', NULL),
(18, 'Galaxy Z Flip 3 128GB 8GB Negro 1.jpg', '81d4676ace4443b433dcf24b2a8c1373251d15d2.jpg', NULL),
(19, 'Galaxy Z Flip 3 128GB 8GB Negro 2.jpg', '1f23a63663e9f9475740350aa0176661b15fd9ca.jpg', NULL),
(20, 'Galaxy Z Flip 3 128GB 8GB Negro 3.jpg', '2903a010a3e2649cd829fb51e3e3f1a0e098d547.jpg', NULL),
(21, 'iPad Wi-Fi 64GB 9na Gen Space Gray.jpg', '218b89198e92b7f0f2aa1a0c68bd5f5593a13a47.jpg', NULL),
(22, 'iPad Wi-Fi 64GB 9na Gen Space Gray 1.jpg', 'b5d15a6d2b1a5f8d0a94bee7be35fc6d2c9a0fe1.jpg', NULL),
(23, 'iPad Wi-Fi 64GB 9na Gen Space Gray 2.jpg', 'fc1350575a0594c2818bbf0da620b0b5ead1a859.jpg', NULL),
(24, 'iPad Wi-Fi 64GB 9na Gen Space Gray 3.jpg', 'dc9f938a946e4f072c7506e629b1dd85a3996f8d.jpg', NULL),
(25, 'iPhone 13 Pro 128GB PRINC.jpg', '1e549df0da78dca40ec6f0922703d27d14fd2552.jpg', NULL),
(26, 'iPhone 13 Pro 128GB 1.jpg', 'fce46374dda3f76d5057c612e9aa3114a633d02e.jpg', NULL),
(27, 'iPhone 13 Pro 128GB 2.jpg', 'df820667cf649b39489ae6be049eaa0faac9e568.jpg', NULL),
(28, 'iPhone 13 Pro 128GB 3.jpg', 'a815e23bbfe9b8ad649ff4fc29585de58b3a051c.jpg', NULL),
(29, 'iPhone 13 Pro 128GB 4.jpg', '0337251b9cd35bd73bdf445a02829801630fadde.jpg', NULL),
(30, 'MacBook Air 13,6 256GB - Chip M2.jpg', 'fa9ccd678247a2cc15ea6a341431b0978f8cba67.jpg', NULL),
(31, 'MacBook Air 13,6 256GB - Chip M2 1.jpg', 'e054b416aebd9d792b9f56f13b78a87906f7d793.jpg', NULL),
(32, 'MacBook Air 13,6 256GB - Chip M2 2.jpg', 'a1ad96cb197714872f0c6c435aeeaa9924f66e91.jpg', NULL),
(33, 'MacBook Air 13,6 256GB - Chip M2 3.jpg', 'e53f819551170a1d9adc3e3cc8659b01ad2d906a.jpg', NULL),
(34, 'PS5 Digital Edition - Latam.jpg', '92d4c3b1640edf629de5b3fcccfe8964dcd5cf9a.jpg', NULL),
(35, 'PS5 Digital Edition - Latam 1.jpg', 'b1da3abdadb5812c001c388f7657a4d89f53db33.jpg', NULL),
(36, 'PS5 Digital Edition - Latam 2.jpg', '264b8ee73c25cbaa1b1af4ef4b73aa90b11efc5b.jpg', NULL),
(37, 'Televisor Samsung Smart TV 65 UHD 4K.jpg', '5b81fc03689d4643c5298ea773bab89c120fc4bc.jpg', NULL),
(38, 'Televisor Samsung Smart TV 65 UHD 4K 1.jpg', '9c41bfefd3fcc581bd1a6dd83086ffa776065bba.jpg', NULL),
(39, 'Televisor Samsung Smart TV 65 UHD 4K 2.jpg', 'd287f28bbb9860ab909ecb2f42e4e6f68735f62f.jpg', NULL);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `carrito`
--
ALTER TABLE `carrito`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_77E6BED59750851F` (`orden_id`),
  ADD KEY `IDX_77E6BED5DE734E51` (`cliente_id`);

--
-- Indices de la tabla `carrito_detalle`
--
ALTER TABLE `carrito_detalle`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_412915887645698E` (`producto_id`),
  ADD KEY `IDX_41291588DE2CF6E7` (`carrito_id`);

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `doctrine_migration_versions`
--
ALTER TABLE `doctrine_migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- Indices de la tabla `marca`
--
ALTER TABLE `marca`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `messenger_messages`
--
ALTER TABLE `messenger_messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_75EA56E0FB7336F0` (`queue_name`),
  ADD KEY `IDX_75EA56E0E3BD61CE` (`available_at`),
  ADD KEY `IDX_75EA56E016BA31DB` (`delivered_at`);

--
-- Indices de la tabla `orden`
--
ALTER TABLE `orden`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_E128CFD7DE734E51` (`cliente_id`);

--
-- Indices de la tabla `orden_detalle`
--
ALTER TABLE `orden_detalle`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_3CB7641E7645698E` (`producto_id`),
  ADD KEY `IDX_3CB7641E9750851F` (`orden_id`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_A7BB06157ABFA656` (`foto_id`),
  ADD KEY `IDX_A7BB06153397707A` (`categoria_id`),
  ADD KEY `IDX_A7BB061581EF0041` (`marca_id`);

--
-- Indices de la tabla `producto_file_upload`
--
ALTER TABLE `producto_file_upload`
  ADD PRIMARY KEY (`producto_id`,`file_upload_id`),
  ADD KEY `IDX_7BCABD1A7645698E` (`producto_id`),
  ADD KEY `IDX_7BCABD1A42C00547` (`file_upload_id`);

--
-- Indices de la tabla `upload_file`
--
ALTER TABLE `upload_file`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_81BB16936DE5A04` (`secure`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `carrito`
--
ALTER TABLE `carrito`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `carrito_detalle`
--
ALTER TABLE `carrito_detalle`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `cliente`
--
ALTER TABLE `cliente`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `marca`
--
ALTER TABLE `marca`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `messenger_messages`
--
ALTER TABLE `messenger_messages`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `orden`
--
ALTER TABLE `orden`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `orden_detalle`
--
ALTER TABLE `orden_detalle`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `upload_file`
--
ALTER TABLE `upload_file`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `carrito`
--
ALTER TABLE `carrito`
  ADD CONSTRAINT `FK_77E6BED59750851F` FOREIGN KEY (`orden_id`) REFERENCES `orden` (`id`),
  ADD CONSTRAINT `FK_77E6BED5DE734E51` FOREIGN KEY (`cliente_id`) REFERENCES `cliente` (`id`);

--
-- Filtros para la tabla `carrito_detalle`
--
ALTER TABLE `carrito_detalle`
  ADD CONSTRAINT `FK_412915887645698E` FOREIGN KEY (`producto_id`) REFERENCES `producto` (`id`),
  ADD CONSTRAINT `FK_41291588DE2CF6E7` FOREIGN KEY (`carrito_id`) REFERENCES `carrito` (`id`);

--
-- Filtros para la tabla `orden`
--
ALTER TABLE `orden`
  ADD CONSTRAINT `FK_E128CFD7DE734E51` FOREIGN KEY (`cliente_id`) REFERENCES `cliente` (`id`);

--
-- Filtros para la tabla `orden_detalle`
--
ALTER TABLE `orden_detalle`
  ADD CONSTRAINT `FK_3CB7641E7645698E` FOREIGN KEY (`producto_id`) REFERENCES `producto` (`id`),
  ADD CONSTRAINT `FK_3CB7641E9750851F` FOREIGN KEY (`orden_id`) REFERENCES `orden` (`id`);

--
-- Filtros para la tabla `producto`
--
ALTER TABLE `producto`
  ADD CONSTRAINT `FK_A7BB06153397707A` FOREIGN KEY (`categoria_id`) REFERENCES `categoria` (`id`),
  ADD CONSTRAINT `FK_A7BB06157ABFA656` FOREIGN KEY (`foto_id`) REFERENCES `upload_file` (`id`),
  ADD CONSTRAINT `FK_A7BB061581EF0041` FOREIGN KEY (`marca_id`) REFERENCES `marca` (`id`);

--
-- Filtros para la tabla `producto_file_upload`
--
ALTER TABLE `producto_file_upload`
  ADD CONSTRAINT `FK_7BCABD1A42C00547` FOREIGN KEY (`file_upload_id`) REFERENCES `upload_file` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_7BCABD1A7645698E` FOREIGN KEY (`producto_id`) REFERENCES `producto` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
