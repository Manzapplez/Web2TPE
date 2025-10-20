-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 20-10-2025 a las 08:06:44
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
-- Base de datos: `soundsnack`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `artists`
--

CREATE TABLE `artists` (
  `id_artist` smallint(5) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `biography` text DEFAULT NULL,
  `cover` varchar(255) DEFAULT NULL,
  `date_of_birth` date NOT NULL,
  `date_of_death` date DEFAULT NULL,
  `place_of_birth` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `artists`
--

INSERT INTO `artists` (`id_artist`, `name`, `biography`, `cover`, `date_of_birth`, `date_of_death`, `place_of_birth`) VALUES
(1, 'Axel Patricio Fernando Witteveen', 'Axel Patricio Fernando Witteveen, es un cantante y compositor argentino. Ha sido galardonado con cinco Premios Carlos Gardel, un MTV Europe Music Awards, un MTV Latinoamérica, dos 40 principales, un MTV Millennial Awards, un Kids Choice Awards Argentina, un TVyNovelas, un Heat Latin Music Awards, entre otros.', '/soundSnack/assets/img/covers/artists/axelWitteveen.jpg', '1977-01-01', NULL, 'Rafael Calzada, Almirante Brown, Buenos Aires, Argentina'),
(2, 'Airbag', 'Airbag es una banda argentina de Rock fundada en Don Torcuato, Gran Buenos Aires, en el año 1999. La banda fue fundada e integrada por los hermanos Gastón Sardelli, Patricio Sardelli y Guido Sardelli donde empezaron con los primeros ensayos a mediados de los años noventa bajo el nombre de Los Nietos de Chuck, donde hacían covers de Chuck Berry, The Beatles y Creedence, entre otros.', '/soundSnack/assets/img/covers/artists/airbag.jpg', '1999-01-01', NULL, 'Don Torcuato, Buenos Aires, Argentina'),
(3, 'Tan Biónica', 'Tan Biónica es un grupo musical de rock argentino surgido en Buenos Aires en el año 2001 formado por Chano, Seby, Bambi y Diega. Desde 2016 el grupo estuvo en un impasse hasta el 17 de marzo de 2023, cuando Chano se presentó en el Lollapalooza Argentina y anunció oficialmente el regreso de la banda.', '/soundSnack/assets/img/covers/artists/tanBionica.jpg', '2001-01-01', NULL, 'Buenos Aires, Argentina'),
(4, 'Miranda!', 'Miranda! es un dúo argentino de pop formado en 2001 integrado por Ale Sergi y Juliana Gattas.', '/soundSnack/assets/img/covers/artists/miranda.jpg', '2001-01-01', NULL, 'Buenos Aires, Argentina'),
(5, 'Bad Bunny', 'Bad Bunny nació en San Juan, Puerto Rico, el 10 de marzo de 1994. Es compositor y cantante de música urbana, sobre todo trap y reggaetón.', '/soundSnack/assets/img/covers/artists/badbunny.jpg', '1994-03-10', NULL, 'San Juan, Puerto Rico'),
(6, 'Lady Gaga', 'Stefani Joanne Angelina Germanotta, conocida por su nombre artístico Lady Gaga, es una cantante, compositora, productora, bailarina, actriz, activista y diseñadora de moda estadounidense.', '/soundSnack/assets/img/covers/artists/ladygaga.jpg', '1986-03-28', NULL, 'Nueva York, Estados Unidos');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `artists`
--
ALTER TABLE `artists`
  ADD PRIMARY KEY (`id_artist`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `artists`
--
ALTER TABLE `artists`
  MODIFY `id_artist` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
