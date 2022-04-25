-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 10-03-2022 a las 09:46:58
-- Versión del servidor: 10.4.21-MariaDB
-- Versión de PHP: 8.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `php_login_database`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `pato` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `pato`) VALUES
(1, 'test@email.com', '$2y$10$6gJVKUBpCHBN/ixBK2Dnk.dCcLWBu42qOLXaXrSoJbmPcTX9U7mE6', 'Rody'),
(2, 'test2@email.com', '$2y$10$RpwOcWUz4GypUfBC4LeV4O7VTouOOJCBimMUfdCHRyL.UF42dA0Sy', 'Rodolfo'),
(3, 'test3@email.com', '$2y$10$C88Gm1OkbPCUsLFeD7yAte8FPzXbbAhNNHTXbcsFnLlhkRahRXUbS', 'Patodolfo'),
(4, 'test4@email.com', '$2y$10$Bmu3.QxurjhJSOXH0hgs6.mtExBjarTjdaYqdvJ2Kl0OJe3Q0iwsS', 'PatoPato'),
(5, 'test5@email.com', '$2y$10$x2AaxhOy.eOitoDezaQxVuzFHQIhC3BpTk7u848bGB0ZnopLoHeY2', 'Manuel'),
(6, 'test312@email.com', '$2y$10$Pylej8EEG7RxZld0Hi1D2eGEjLk91.rGRC268MqS1ZE77n6IkDdbi', '123321'),
(7, 'test7@email.com', '$2y$10$ktHPHEfa59yv.HgwbdqJle2LsO04eLJMkxl.AwgW7r.HWfko213.O', 'Roda'),
(8, 'test11111@email.com', '$2y$10$VO/Veo1TpWH5SFPVsU7QzeDhWGei5QG9ev0e9SCvIGA5oDQWqXtoy', 'pato123'),
(9, 'test12@email.com', '$2y$10$DjqVGNhddBdCovid9PZNxOE/Oo1EMVEKsy3iyyM5aRly5bSHwJpp6', '1212');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
