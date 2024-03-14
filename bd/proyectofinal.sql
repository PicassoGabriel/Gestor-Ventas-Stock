-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 14-03-2024 a las 22:13:47
-- Versión del servidor: 10.4.25-MariaDB
-- Versión de PHP: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `proyectofinal`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `articulos`
--

CREATE TABLE `articulos` (
  `id_articulo` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `descripcion` varchar(255) NOT NULL,
  `stock` int(11) DEFAULT NULL,
  `costo_total` int(15) NOT NULL,
  `precio_venta` int(15) NOT NULL,
  `id_imagen` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_categoria` int(11) NOT NULL,
  `fecha_creacion` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `articulos`
--

INSERT INTO `articulos` (`id_articulo`, `nombre`, `descripcion`, `stock`, `costo_total`, `precio_venta`, `id_imagen`, `id_usuario`, `id_categoria`, `fecha_creacion`) VALUES
(1, 'Apego', 'Relleno vellón siliconado premium. Medidas: 20x30', 0, 800, 1500, 1, 1, 1, '2024-02-14'),
(2, 'Nordicos', 'Relleno vellón siliconado premium. Medidas: 20x30', 1, 950, 2050, 2, 1, 1, '2024-02-14'),
(3, 'Kit Cervical', 'Cuello cervical 35x35 gabardina estampada. Almohadita 20x25 relleno vellon siliconado premium', 3, 1300, 3500, 3, 1, 7, '2024-02-14'),
(4, 'Almohadones', 'Gabardina estampada relleno de goma espuma funda lavable. Medidas: 45x45', 1, 1400, 3000, 4, 1, 1, '2024-02-14'),
(5, 'King', 'Tipo Hotel. Medidas: 90x50', 5, 1500, 4000, 5, 1, 2, '2024-02-14'),
(6, 'Nidito de Contencion', 'Base de goma espuma de 2cm. Relleno de vellon siliconado premium. Tela Tussor liso y gabardina estampada.', 4, 6500, 17000, 6, 1, 3, '2024-02-14'),
(7, 'Cama L', 'Tipo colchoneta. Relleno de copos de goma espuma. Friselina negra de 80grs y lona anti desgarro. Medidas: 75x60', 1, 2500, 5800, 7, 1, 4, '2024-02-14'),
(8, 'Cama King', 'Tipo colchoneta. Relleno de copos de goma espuma. Friselina negra de 80grs y lona anti desgarro. Medidas: 105x90', 2, 4800, 10000, 8, 1, 4, '2024-02-14');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `id_categoria` int(11) NOT NULL,
  `nombre_categoria` varchar(255) NOT NULL,
  `fecha_creacion` date NOT NULL,
  `id_usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id_categoria`, `nombre_categoria`, `fecha_creacion`, `id_usuario`) VALUES
(1, 'Almohadones', '2024-02-14', 1),
(2, 'Almohadas', '2024-02-14', 1),
(3, 'Bebes', '2024-02-14', 1),
(4, 'Mascotas', '2024-02-14', 1),
(7, 'Cuellitos', '2024-02-14', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `id_cliente` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `contacto` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`id_cliente`, `nombre`, `contacto`) VALUES
(1, 'Feria', '-'),
(2, 'ClienteFalso', '001122233'),
(3, 'Nicolas', '33556644');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `imagenes`
--

CREATE TABLE `imagenes` (
  `id_imagen` int(11) NOT NULL,
  `id_categoria` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `ruta` varchar(255) NOT NULL,
  `fechaSubida` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `imagenes`
--

INSERT INTO `imagenes` (`id_imagen`, `id_categoria`, `nombre`, `ruta`, `fechaSubida`) VALUES
(1, 1, 'apego.jpg', '../../archivos/apego.jpg', '2024-02-14'),
(2, 1, 'nordicos.jpg', '../../archivos/nordicos.jpg', '2024-02-14'),
(3, 7, 'KitCervical.jpg', '../../archivos/KitCervical.jpg', '2024-02-14'),
(4, 1, 'almohadones1.jpg', '../../archivos/almohadones1.jpg', '2024-02-14'),
(5, 2, 'almohadaKing.jpg', '../../archivos/almohadaKing.jpg', '2024-02-14'),
(6, 3, 'NiditoContencion.jpg', '../../archivos/NiditoContencion.jpg', '2024-02-14'),
(7, 4, 'CamaL.jpeg', '../../archivos/CamaL.jpeg', '2024-02-14'),
(8, 4, 'camaKING.jpeg', '../../archivos/camaKING.jpeg', '2024-02-14');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `materiales`
--

CREATE TABLE `materiales` (
  `id_compra` int(11) NOT NULL,
  `id_proveedor` int(11) NOT NULL,
  `producto` varchar(255) NOT NULL,
  `descripcion` varchar(255) NOT NULL,
  `precio_compra` int(15) NOT NULL,
  `cantidad` int(15) NOT NULL,
  `fecha_creacion` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `materiales`
--

INSERT INTO `materiales` (`id_compra`, `id_proveedor`, `producto`, `descripcion`, `precio_compra`, `cantidad`, `fecha_creacion`) VALUES
(1, 2, 'Gabardina Estampada ', 'Colores Varios', 400, 4, '2024-02-14'),
(2, 2, 'Tussor', 'Liso', 800, 9, '2024-02-14'),
(3, 2, 'Lona', 'Anti desgarro', 1700, 3, '2024-02-14'),
(4, 3, 'Vellon', 'Siliconado Premium Importado', 2500, 15, '2024-02-14'),
(5, 4, 'Copos de Goma Espuma', 'Copos de diversos tamaños', 300, 7, '2024-02-14'),
(6, 2, 'Friselina', 'Colores Varios', 200, 15, '2024-02-14');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedor`
--

CREATE TABLE `proveedor` (
  `id_proveedor` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `materia_prima` varchar(255) NOT NULL,
  `contacto` varchar(255) NOT NULL,
  `direccion` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `proveedor`
--

INSERT INTO `proveedor` (`id_proveedor`, `nombre`, `materia_prima`, `contacto`, `direccion`) VALUES
(2, 'Felu S.A', 'Telas', '011223345', 'Laferrere'),
(3, 'Fabrica', 'Vellon', '022334455', 'CABA'),
(4, 'Carlitos S.R.L', 'Goma Espuma', '54788798465', 'San Justo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `apellido` varchar(255) NOT NULL,
  `correo` varchar(255) NOT NULL,
  `usuario` varchar(255) NOT NULL,
  `contraseña` varchar(50) NOT NULL,
  `fechaRegistro` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `nombre`, `apellido`, `correo`, `usuario`, `contraseña`, `fechaRegistro`) VALUES
(1, 'Gabriel', 'Picasso', 'correoFalso', 'admin', 'admin1', '2024-02-14'),
(2, 'Gabriel', 'Picasso', 'correo', 'gaby', 'gaby1', '2024-02-14');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas`
--

CREATE TABLE `ventas` (
  `id_venta` int(11) NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `id_articulo` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `total` int(15) NOT NULL,
  `forma_pago` varchar(50) NOT NULL,
  `fechaVenta` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `ventas`
--

INSERT INTO `ventas` (`id_venta`, `id_cliente`, `id_articulo`, `id_usuario`, `total`, `forma_pago`, `fechaVenta`) VALUES
(2, 1, 1, 1, 1500, 'Efectivo', '2022-11-07'),
(3, 2, 5, 1, 4000, 'Transferencia', '2022-12-15'),
(3, 2, 5, 1, 4000, 'Transferencia', '2022-12-15'),
(4, 3, 2, 1, 2050, 'Debito', '2024-02-14'),
(4, 3, 7, 1, 5800, 'Debito', '2024-02-14'),
(4, 3, 7, 1, 5800, 'Debito', '2024-02-14'),
(5, 1, 1, 2, 1500, 'Efectivo', '2024-02-14'),
(5, 1, 1, 2, 1500, 'Efectivo', '2024-02-14'),
(5, 1, 1, 2, 1500, 'Efectivo', '2024-02-14'),
(5, 1, 1, 2, 1500, 'Efectivo', '2024-02-14'),
(6, 1, 4, 1, 3000, 'Debito', '2024-02-16'),
(6, 1, 7, 1, 5800, 'Debito', '2024-02-16'),
(6, 1, 2, 1, 2050, 'Debito', '2024-02-16'),
(7, 1, 6, 1, 17000, 'Efectivo', '2024-03-14');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `articulos`
--
ALTER TABLE `articulos`
  ADD PRIMARY KEY (`id_articulo`),
  ADD KEY `id_imagen` (`id_imagen`),
  ADD KEY `id_usuario` (`id_usuario`),
  ADD KEY `id_categoria` (`id_categoria`);

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id_categoria`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id_cliente`);

--
-- Indices de la tabla `imagenes`
--
ALTER TABLE `imagenes`
  ADD PRIMARY KEY (`id_imagen`),
  ADD KEY `id_categoria` (`id_categoria`);

--
-- Indices de la tabla `materiales`
--
ALTER TABLE `materiales`
  ADD PRIMARY KEY (`id_compra`),
  ADD KEY `id_proveedor` (`id_proveedor`);

--
-- Indices de la tabla `proveedor`
--
ALTER TABLE `proveedor`
  ADD PRIMARY KEY (`id_proveedor`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`);

--
-- Indices de la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD KEY `id_cliente` (`id_cliente`),
  ADD KEY `id_articulo` (`id_articulo`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `articulos`
--
ALTER TABLE `articulos`
  MODIFY `id_articulo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id_categoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id_cliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `imagenes`
--
ALTER TABLE `imagenes`
  MODIFY `id_imagen` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `materiales`
--
ALTER TABLE `materiales`
  MODIFY `id_compra` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `proveedor`
--
ALTER TABLE `proveedor`
  MODIFY `id_proveedor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `articulos`
--
ALTER TABLE `articulos`
  ADD CONSTRAINT `articulos_ibfk_1` FOREIGN KEY (`id_imagen`) REFERENCES `imagenes` (`id_imagen`),
  ADD CONSTRAINT `articulos_ibfk_2` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`),
  ADD CONSTRAINT `articulos_ibfk_3` FOREIGN KEY (`id_categoria`) REFERENCES `categorias` (`id_categoria`);

--
-- Filtros para la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD CONSTRAINT `categorias_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`);

--
-- Filtros para la tabla `imagenes`
--
ALTER TABLE `imagenes`
  ADD CONSTRAINT `imagenes_ibfk_1` FOREIGN KEY (`id_categoria`) REFERENCES `categorias` (`id_categoria`);

--
-- Filtros para la tabla `materiales`
--
ALTER TABLE `materiales`
  ADD CONSTRAINT `materiales_ibfk_1` FOREIGN KEY (`id_proveedor`) REFERENCES `proveedor` (`id_proveedor`);

--
-- Filtros para la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD CONSTRAINT `ventas_ibfk_1` FOREIGN KEY (`id_cliente`) REFERENCES `clientes` (`id_cliente`),
  ADD CONSTRAINT `ventas_ibfk_2` FOREIGN KEY (`id_articulo`) REFERENCES `articulos` (`id_articulo`),
  ADD CONSTRAINT `ventas_ibfk_3` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
