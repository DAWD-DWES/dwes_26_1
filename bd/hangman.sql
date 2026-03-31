-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 27-05-2025 a las 19:23:29
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.1.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `hangman_25_1`
--
CREATE DATABASE IF NOT EXISTS `hangman_26_1` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci;
USE `hangman_26_1`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `partidas`
--

DROP TABLE IF EXISTS `partidas`;
CREATE TABLE `partidas` (
  `id` int(11) NOT NULL,
  `numErrores` tinyint(4) NOT NULL,
  `palabraSecreta` varchar(80) NOT NULL,
  `palabraDescubierta` varchar(80) NOT NULL,
  `letras` varchar(30) NOT NULL,
  `maxNumErrores` tinyint(4) NOT NULL,
  `inicio` timestamp NULL DEFAULT current_timestamp(),
  `fin` timestamp NULL DEFAULT NULL,
  `idUsuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `partidas`
--

INSERT INTO `partidas` (`id`, `numErrores`, `palabraSecreta`, `palabraDescubierta`, `letras`, `maxNumErrores`, `inicio`, `fin`, `idUsuario`) VALUES
(156, 4, 'LUMINISCENCIA', 'LUMINISCENCIA', 'DFEIOUSLRM', 5, '2025-01-01 20:28:20', '2025-01-01 20:36:36', 1),
(157, 5, 'ABEY', 'A_E_', 'AENJKLS', 5, '2025-01-01 20:32:24', '2025-01-01 20:35:04', 1),
(159, 5, 'LOBRIGO', '_O_RI_O', 'AERIOSCT', 5, '2025-01-01 20:36:41', '2025-01-01 20:38:26', 1),
(162, 5, 'DESTIN', 'DESTI_', 'AEOUIRSDTM', 5, '2025-01-01 20:38:34', '2025-01-01 21:14:56', 1),
(163, 3, 'VERBORREA', 'VERBORREA', 'AEIOUTBVR', 5, '2025-01-01 20:40:11', '2025-01-01 21:18:01', 1),
(164, 5, 'INGREDIENTE', '____ED_E__E', 'EABCDLS', 5, '2025-01-01 21:00:30', '2025-01-02 12:30:49', 1),
(165, 5, 'ROBINSON', '_OBIN_ON', 'AEIONCBUG', 5, '2025-01-01 21:00:38', '2025-05-12 22:15:42', 1),
(166, 0, 'DESPOTIZAR', '_E______A_', 'AE', 5, '2025-01-01 21:09:50', NULL, 1),
(167, 5, 'AERIFERO', 'AERI_ERO', 'AEIROPMTSL', 5, '2025-01-01 21:09:52', '2025-01-01 21:10:32', 1),
(168, 4, 'ENCARTONAR', 'ENCARTONAR', 'AEIORMPDTN', 5, '2025-01-01 21:10:36', '2025-01-01 21:13:00', 1),
(169, 2, 'ESPARTANO', '_S______O', 'SVBO', 5, '2025-01-01 21:13:07', NULL, 1),
(170, 5, 'AMAGATORIO', 'AMA_ATORIO', 'AEIORSMBTC', 5, '2025-01-02 12:23:55', '2025-01-02 14:34:06', 1),
(171, 4, 'SUBTITULO', 'SUBTITULO', 'AEIOUCSMTB', 5, '2025-01-02 13:00:26', '2025-01-02 13:01:10', 1),
(172, 2, 'DESCUADRILARSE', 'DES__ADR__ARSE', 'AENTSDR', 5, '2025-01-02 13:01:12', NULL, 1),
(173, 4, 'RIVERENSE', 'R__ERE__E', 'AROUET', 5, '2025-01-02 13:19:45', NULL, 1),
(174, 0, 'POBRETE', '_______', '', 5, '2025-01-02 15:55:21', NULL, 1),
(178, 5, 'GUIAR', '___A_', 'ASPLNT', 5, '2025-03-07 17:09:09', '2025-03-07 17:09:39', 2),
(179, 3, 'RUMPIATA', '__M_IA_A', 'AMSOIN', 5, '2025-03-07 17:09:44', NULL, 2),
(180, 0, 'TERMOTECNIA', 'TE___TE___A', 'TAE', 5, '2025-03-07 17:10:42', NULL, 2),
(181, 3, 'SERVICIAR', 'SERVICIAR', 'OUAEIRLSVC', 5, '2025-03-07 17:11:23', '2025-03-07 17:33:49', 2),
(182, 1, 'DESCORREGIDO', '_E_____E_I__', 'AEI', 5, '2025-03-07 17:12:22', NULL, 2),
(183, 0, 'VERDEZUELA', '__________', '', 5, '2025-03-07 17:12:48', NULL, 2),
(184, 0, 'AGATA', 'A_A_A', 'A', 5, '2025-03-07 17:15:11', NULL, 2),
(185, 2, 'DESPELOTARSE', '_ES_E_OTA_SE', 'AEIONTS', 5, '2025-03-07 17:24:20', NULL, 2),
(190, 5, 'HIDIONDO', '_I_ION_O', 'AEIOLNSR', 5, '2025-03-13 17:10:10', '2025-03-13 17:10:51', 1),
(191, 0, 'PENITENCIA', '__________', '', 5, '2025-03-13 17:10:57', NULL, 1),
(192, 0, 'ATARDECER', 'A_A______', 'A', 5, '2025-03-13 17:12:11', NULL, 1),
(193, 0, 'ESLOGAN', '_______', '', 5, '2025-03-14 17:25:20', NULL, 1),
(194, 0, 'GONOCOCIA', '_________', '', 5, '2025-03-14 17:25:24', NULL, 1),
(195, 2, 'DISTINGUIDOR', '_I__I___I_O_', 'AEIO', 5, '2025-03-14 17:25:26', NULL, 1),
(196, 0, 'CORDURA', '_______', '', 5, '2025-03-14 18:29:44', NULL, 1),
(197, 0, 'PAYE', '____', '', 5, '2025-03-14 18:32:07', NULL, 1),
(201, 2, 'ITALICA', 'ITALICA', 'AEINTLC', 5, '2025-03-17 19:18:40', '2025-03-17 19:19:29', 1),
(202, 5, 'ANAQUELERIA', '___Q_______', 'SWQHJY', 5, '2025-03-17 19:19:34', '2025-03-17 19:20:25', 1),
(203, 0, 'AGLOMERADO', 'A______A__', 'A', 5, '2025-03-17 22:00:47', NULL, 1),
(204, 0, 'MONOFASICO', '__________', '', 5, '2025-05-09 18:28:51', NULL, 1),
(207, 3, 'HOBO', '_OBO', 'AEIOB', 5, '2025-05-09 19:07:51', NULL, 2),
(208, 1, 'OPTIMATE', 'O_TI_ATE', 'AEOUIT', 5, '2025-05-09 19:08:14', NULL, 2),
(209, 2, 'ALMANAC', '_______', 'SP', 5, '2025-05-09 19:08:41', NULL, 2),
(210, 3, 'ATUFAR', 'A_U_A_', 'AUSLN', 5, '2025-05-09 19:08:49', NULL, 2),
(211, 0, 'MOLINO', '______', '', 5, '2025-05-09 19:09:13', NULL, 2),
(212, 0, 'MARCIALIDAD', '_A___A__DAD', 'AD', 5, '2025-05-09 21:07:34', NULL, 2),
(221, 1, 'AEROMODELISMO', 'A_________S__', 'AST', 5, '2025-05-09 21:28:11', NULL, 2),
(222, 0, 'ALSINE', 'ALSINE', 'ALSINE', 5, '2025-05-09 21:28:57', '2025-05-09 21:31:42', 2),
(223, 0, 'GESTAR', '______', '', 5, '2025-05-09 21:31:45', NULL, 2),
(224, 2, 'DIGITIFORME', '__________E', 'APE', 5, '2025-05-09 21:54:35', NULL, 2),
(225, 5, 'ARUERA', 'A__E_A', 'EADFGHJ', 5, '2025-05-10 10:38:15', '2025-05-10 10:38:57', 1),
(226, 0, 'ALSINE', '______', '', 5, '2025-05-10 10:40:31', NULL, 1),
(227, 1, 'CONSUMACION', '______A_I__', 'AEI', 5, '2025-05-12 22:17:15', NULL, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombre` varchar(60) NOT NULL,
  `clave` varchar(20) NOT NULL,
  `email` varchar(60) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `clave`, `email`) VALUES
(1, 'pepe', '123456', 'pepe@pepe.es'),
(2, 'luis', '654321', 'luis@luis.es');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `partidas`
--
ALTER TABLE `partidas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_usuario_id` (`idUsuario`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nombre` (`nombre`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `partidas`
--
ALTER TABLE `partidas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=228;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `partidas`
--
ALTER TABLE `partidas`
  ADD CONSTRAINT `fk_usuario_id` FOREIGN KEY (`idUsuario`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
