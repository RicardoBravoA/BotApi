-- phpMyAdmin SQL Dump
-- version 4.6.5.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:8889
-- Tiempo de generación: 09-02-2017 a las 16:06:07
-- Versión del servidor: 5.6.34
-- Versión de PHP: 7.1.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Base de datos: `db_bot`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `message_default`
--

CREATE TABLE `message_default` (
  `message_default_id` int(11) NOT NULL,
  `message` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `operation` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `property_type` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `response_1` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `response_2` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `response_type_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `message_default`
--

INSERT INTO `message_default` (`message_default_id`, `message`, `operation`, `property_type`, `response_1`, `response_2`, `response_type_id`) VALUES
(1, 'hola', '¿Qué operación desea realizar?', '', 'Hola', '', 2),
(2, '', 'alquilar', '', '¿Qué inmueble desea alquilar?', '', 3),
(3, '', 'comprar', '', '¿Qué inmueble desea comprar?', '', 3),
(4, '', 'alquilar', 'departamento', 'Tenemos estas propiedades para usted', '', 4),
(5, '', 'alquilar', 'casa', 'Tenemos estas propiedades para usted', '', 4),
(6, '', 'comprar', 'departamento', 'Tenemos estas propiedades para usted', '', 4),
(7, '', 'alquilar', 'casa', 'Tenemos estas propiedades para usted', '', 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `property`
--

CREATE TABLE `property` (
  `property_id` int(11) NOT NULL,
  `image` varchar(200) COLLATE utf8_spanish_ci NOT NULL,
  `title` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `price` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `money_type` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `url` varchar(200) COLLATE utf8_spanish_ci NOT NULL,
  `operation` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `property_type` varchar(50) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `property`
--

INSERT INTO `property` (`property_id`, `image`, `title`, `price`, `money_type`, `url`, `operation`, `property_type`) VALUES
(1, 'http://cde.urbania.pe/elements/50106/proyectos/480/galery/alto-casuarinas-2013-05-29-183021-480-1.jpg', 'Proyecto ALTO CASUARINAS', '212,288', 'US$', 'http://urbania.pe/ficha-proyecto/proyecto-alto-casuarinas-lima-santiago-de-surco-sbm-grupo-inmobiliario-480', 'comprar', 'departamento'),
(2, 'http://cde.urbania.pe/elements/123410/proyectos/1993/galery/1993-21038092.jpg', 'Proyecto ALAMEDA DE BARRANCO', '437,000', 'S/', 'http://urbania.pe/ficha-proyecto/proyecto-alameda-de-barranco-lima-barranco-armas-doomo-inmobiliaria-1993', 'comprar', 'departamento'),
(3, 'http://cde.urbania.pe/elements/31825/proyectos/655/galery/655-18136892.jpg', 'Proyecto Concepto Family Park - Pueblo Libre', '411,100', 'S/', 'http://urbania.pe/ficha-proyecto/proyecto-concepto-family-park-pueblo-libre-lima-pueblo-libre-imagina-grupo-inmobiliario-655', 'comprar', 'departamento'),
(4, 'http://cde.urbania.pe/elements/534927/proyectos/3176/galery/3176-20137882.jpg', 'Proyecto ÄMAK VICHAYITO', '95,400', 'US$', 'http://urbania.pe/ficha-proyecto/proyecto-amak-vichayito-piura-mancora-amak-peru-3176', 'comprar', 'casa'),
(5, 'http://cde.urbania.pe/elements/123410/proyectos/2138/galery/2138-11411084.jpg', 'Proyecto QUEBRADA DEL MAR', '676,500', 'S/', 'http://urbania.pe/ficha-proyecto/proyecto-quebrada-del-mar-lima-asia-armas-doomo-inmobiliaria-2138', 'comprar', 'casa'),
(6, 'http://cde.urbania.pe/elements/197529/proyectos/2754/galery/2754-16993509.jpg', 'Proyecto Condominio Los Arándanos', '55', 'US$', 'http://urbania.pe/ficha-proyecto/proyecto-condominio-los-arandanos-lima-imperial-country-house-sac-2754', 'comprar', 'casa'),
(7, 'http://cde.urbania.g3c.pe/546176/avisos/3542867/galery/546176_589937582e8d6.jpeg', 'Alquiler de Casa de campo en San Sebastian', 'Consultar', '', 'http://urbania.pe/ficha-web/alquiler-de-casa-de-campo-en-san-sebastian-cusco-5-a-mas-dormitorios-piscina-terraza-amoblado-3542867', 'alquilar', 'casa'),
(8, 'http://cde.urbania.g3c.pe/410054/avisos/3542373/galery/410054_5898bafa19a1d.jpeg', 'Alquiler de Casa en La Molina', '4,000', 'US$', 'http://urbania.pe/ficha-web/alquiler-de-casa-en-la-molina-lima-4-dormitorios-piscina-terraza-3542373', 'alquilar', 'casa'),
(9, 'http://cde.urbania.g3c.pe/3303/avisos/3540547/galery/3303_589a2a6cb3ede.jpeg', 'Alquiler de Casa en Santiago De Surco', '2,250', 'US$', 'http://urbania.pe/ficha-web/alquiler-de-casa-en-santiago-de-surco-lima-4-dormitorios-terraza-3540547', 'alquilar', 'casa'),
(10, 'http://cde.urbania.g3c.pe/546597/avisos/3545739/galery/546597_589bd34682382.jpeg', 'Alquiler de Departamento en Jesus Maria', 'Consultar', '', 'http://urbania.pe/ficha-web/alquiler-de-departamento-en-jesus-maria-lima-3-dormitorios-ascensor-3545739', 'alquilar', 'departamento'),
(11, 'http://cde.urbania.g3c.pe/110645/avisos/3542774/galery/110645_58990b8e7e237.jpeg', 'Alquiler de Departamento en Pueblo Libre', '800', 'US$', 'http://urbania.pe/ficha-web/alquiler-de-departamento-en-pueblo-libre-lima-3-dormitorios-3542774', 'alquilar', 'departamento'),
(12, 'http://cde.urbania.g3c.pe/544860/avisos/3534724/galery/544860_5897f74d5e8b0.jpeg', 'Alquiler de Departamento en Magdalena Del Mar', '2,500', 'S/', 'http://urbania.pe/ficha-web/alquiler-de-departamento-en-magdalena-del-mar-lima-2-dormitorios-ascensor-3534724', 'alquilar', 'departamento');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `message_default`
--
ALTER TABLE `message_default`
  ADD PRIMARY KEY (`message_default_id`);

--
-- Indices de la tabla `property`
--
ALTER TABLE `property`
  ADD PRIMARY KEY (`property_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `message_default`
--
ALTER TABLE `message_default`
  MODIFY `message_default_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT de la tabla `property`
--
ALTER TABLE `property`
  MODIFY `property_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;