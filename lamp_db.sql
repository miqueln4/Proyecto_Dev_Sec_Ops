-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: db
-- Tiempo de generación: 25-05-2024 a las 15:22:57
-- Versión del servidor: 8.3.0
-- Versión de PHP: 8.2.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `lamp_db`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `galeria`
--

CREATE TABLE `galeria` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `file_path` varchar(255) NOT NULL,
  `file_type` varchar(50) NOT NULL,
  `upload_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `id_noticia` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `galeria`
--

INSERT INTO `galeria` (`id`, `user_id`, `file_path`, `file_type`, `upload_date`, `id_noticia`) VALUES
(5, 1, '../../images/69c6015eefe413258db780ee9f11f59a.jpg', 'image/jpeg', '2024-05-22 23:30:44', 9),
(11, 1, '../../images/e5d2ecc16c630b6ccd38e4d95c5c6f65.jpg', 'image/jpeg', '2024-05-23 17:51:43', 15);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `noticias`
--

CREATE TABLE `noticias` (
  `id_noticia` int NOT NULL,
  `descripcion` text NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `fecha` datetime NOT NULL,
  `username` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `noticias`
--

INSERT INTO `noticias` (`id_noticia`, `descripcion`, `titulo`, `fecha`, `username`) VALUES
(1, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi consectetur sed arcu nec dictum. Fusce lobortis nunc ex. Nam semper sem id felis sagittis lacinia. In ultrices pulvinar mattis. Aliquam erat volutpat. Phasellus malesuada aliquam mauris, vel consectetur orci semper eu. Vivamus nec feugiat quam, rutrum pretium neque. Praesent interdum, eros sit amet convallis consectetur, felis est porta quam, quis consectetur risus justo id dui. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Duis tristique est sit amet bibendum auctor. Fusce hendrerit lacus sit amet venenatis mollis. Nam dignissim tortor eu leo venenatis, tempus sodales arcu pulvinar. Etiam mattis mauris lacinia magna fermentum placerat. Donec sit amet placerat dolor, id molestie mi. Sed molestie elementum arcu, ac tincidunt enim rutrum eu.', 'Buenos dias', '2024-05-21 11:05:57', 'miqueln4'),
(4, 'ewfq4t243tergdyju76iue54ytgrf', 'dfawefwaf', '2024-05-22 15:22:44', 'miqueln4'),
(9, 'Nanosecso jiji', 'EL NANO', '2024-05-22 23:30:44', 'miqueln4'),
(15, 'hola', 'msakdnsa', '2024-05-23 17:51:43', 'miqueln4');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int NOT NULL,
  `username` varchar(50) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(64) NOT NULL,
  `dni` varchar(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `username`, `name`, `email`, `password`, `dni`) VALUES
(1, 'miqueln4', 'miquel', 'miqnavcho@alu.edu.gva.es', '489cd5dbc708c7e541de4d7cd91ce6d0f1613573b7fc5b40d3942ccb9555cf35', ''),
(8, 'qwe', 'qwe1', 'contact@salsequery.com', '1f00ea2d59a8eb240d833f87c5985384536a674853e825fb9756c3121f4a66ee', '46275049S');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `galeria`
--
ALTER TABLE `galeria`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `fk_galeria_noticias_id` (`id_noticia`);

--
-- Indices de la tabla `noticias`
--
ALTER TABLE `noticias`
  ADD PRIMARY KEY (`id_noticia`),
  ADD KEY `fk_username` (`username`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `galeria`
--
ALTER TABLE `galeria`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `noticias`
--
ALTER TABLE `noticias`
  MODIFY `id_noticia` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `galeria`
--
ALTER TABLE `galeria`
  ADD CONSTRAINT `fk_galeria_noticias_id` FOREIGN KEY (`id_noticia`) REFERENCES `noticias` (`id_noticia`),
  ADD CONSTRAINT `galeria_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `usuarios` (`id`);

--
-- Filtros para la tabla `noticias`
--
ALTER TABLE `noticias`
  ADD CONSTRAINT `fk_username` FOREIGN KEY (`username`) REFERENCES `usuarios` (`username`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
