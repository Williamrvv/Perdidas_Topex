-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 21-03-2018 a las 21:38:13
-- Versión del servidor: 5.7.14
-- Versión de PHP: 5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `redo`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `id` int(11) NOT NULL,
  `Cliente` varchar(60) NOT NULL,
  `status` int(1) NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`id`, `Cliente`, `status`) VALUES
(1, 'Santa Lucia', 1),
(2, 'Optiver', 1),
(3, 'Paraiso', 1),
(4, 'CSG', 1),
(5, 'LyH', 1),
(6, 'San Ramon', 1),
(7, 'Aldajo ', 1),
(8, 'Gollo PZ', 1),
(9, 'Gollo Guapiles', 1),
(10, 'Bermudez', 1),
(11, 'Crevic', 1),
(12, 'COP', 1),
(13, 'Gollo san Carlos', 1),
(14, 'Elizondo', 1),
(15, 'Silvia Herrera', 1),
(16, 'Llena Optical', 1),
(17, 'Ventosa', 1),
(18, 'Optilent', 1),
(19, 'Gollo Zapote', 1),
(20, 'La Isla', 1),
(205, 'Gollo Limón ', 1),
(22, 'Centro opt.ST D', 1),
(23, 'Flores', 1),
(24, 'Pereira', 1),
(25, 'LHS', 1),
(26, 'Optiplus', 1),
(27, 'Sancho Palm.', 1),
(28, 'Tresbo', 1),
(29, 'Siloe', 1),
(30, 'Gollo orotina', 1),
(31, 'CUP', 1),
(32, 'Vives', 1),
(33, 'Alvarez y Molina', 1),
(34, 'Siman', 1),
(35, 'Jade', 1),
(36, 'Centro opt. Occ', 1),
(37, 'Sanchun', 1),
(38, 'Punto de Vista', 1),
(39, 'Club Leones', 1),
(40, 'Arce', 1),
(41, 'Vargas Central', 1),
(42, 'Murano', 1),
(43, 'Gollo Cartago', 1),
(44, 'service', 1),
(45, 'Villa Colon', 1),
(46, 'Suplidores', 1),
(47, 'Gollo Turrialba', 1),
(48, 'Diego coto', 1),
(49, 'Su salud', 1),
(50, 'Sancho', 1),
(51, 'Alta Vista', 1),
(52, 'Imagen', 1),
(53, 'El pueblo', 1),
(54, 'Rosan', 1),
(55, 'Sion', 1),
(56, 'Borbon', 1),
(57, 'Higuerones', 1),
(58, 'Siglo XX1', 1),
(59, 'Santa Fe', 1),
(60, 'Cupunts', 1),
(61, 'CA', 1),
(62, 'Grisol', 1),
(63, 'Optik Plus Santa Ana', 1),
(64, 'Multi. Barrantes', 1),
(65, 'CODS', 1),
(66, 'Esp. Opticas', 1),
(67, 'Gabriela Quesada', 1),
(68, 'CV Puntarenas', 1),
(69, 'Del Valle', 1),
(70, 'Mundial', 1),
(71, 'Rosa Murillo', 1),
(72, 'Stylos', 1),
(73, 'Carrillo', 1),
(74, 'Opti Plus', 1),
(75, 'Cent. Opt occidente', 1),
(76, 'El guarco', 1),
(77, 'Cent. Opt  SD', 1),
(78, 'Cent. Opt MyM', 1),
(79, 'San Juan Upala', 1),
(80, 'Quepos', 1),
(81, 'Vitra Curridabat', 1),
(82, 'Monge', 1),
(83, 'Opticril', 1),
(84, 'Gladys Rodriguez', 1),
(85, 'Elizondo central', 1),
(86, 'Ultravision', 1),
(87, 'Centro Grecia', 1),
(88, 'Vitra Cartago', 1),
(89, 'Optik Plus Heredia', 1),
(90, 'Optik Plus', 1),
(91, 'Nova vision', 1),
(92, 'Arce Cartago', 1),
(93, 'Optica Alvaro Jimenez', 1),
(94, 'Gollo san jose', 1),
(95, 'Hospital Alajuela', 1),
(96, 'Oftalmologia Global', 1),
(97, 'Gollo Optica 61', 1),
(98, 'Frechen', 1),
(99, 'Padilla', 1),
(100, 'Actual', 1),
(101, 'Arawvision', 1),
(102, 'Cadivi', 1),
(103, 'Buena Vista', 1),
(104, 'Centra Alajuela', 1),
(105, 'Troyo cartago', 1),
(106, 'O6 optics', 1),
(107, 'Agape', 1),
(108, 'Santa Marta', 1),
(109, 'Nueva Imagen', 1),
(110, 'Carlos Guevara', 1),
(111, 'Optik Plus Alajuela', 1),
(112, 'Nueva Vision', 1),
(113, 'Ilusiones opticas', 1),
(114, 'Centro Optico St.D.', 1),
(115, 'A.Z', 1),
(116, 'Alvaro Jimenez', 1),
(117, 'Sancho Heredia', 1),
(118, 'Vitra', 1),
(119, 'Sue Dr. Rey', 1),
(120, '1979', 1),
(121, 'Rep Opt. Esp LyH', 1),
(122, 'Sanchum', 1),
(123, 'Dra.Mariana Vargas', 1),
(124, 'Opticentro Pocosol', 1),
(125, 'Barrantes', 1),
(126, 'Mediclinica', 1),
(127, 'Zarcero', 1),
(128, 'Provision Sta. Cruz', 1),
(129, 'Servicios visuales', 1),
(130, 'Sepro', 1),
(131, 'Centro Opt St Domingo', 1),
(132, 'Warren Alfaro', 1),
(133, 'Centro Optico de Occidente', 1),
(134, 'Opticentro AZ', 1),
(135, 'Central Alajuela', 1),
(137, 'GMD', 1),
(138, 'Vikmac', 1),
(139, 'Munkel', 1),
(140, 'Fundacion LSS', 1),
(141, 'Audiovision', 1),
(142, 'LHS ', 1),
(143, 'Visolutions', 1),
(144, 'Vitra Concepcion', 1),
(145, 'Miles', 1),
(146, 'Gollo City', 1),
(147, 'Villanueva Santa Ana', 1),
(148, 'Troyo Turrialba', 1),
(149, 'Gollo Heredia', 1),
(150, 'Dr. Ventosa', 1),
(151, 'unonhica 06', 1),
(152, 'Presalud Movil', 1),
(153, 'unoptica', 1),
(154, 'DSS', 1),
(155, 'Nueva Luz', 1),
(156, 'Copevision', 1),
(157, 'Sancho 3', 1),
(158, 'Punto visual', 1),
(159, 'Visualisa', 1),
(160, 'Johan Morales', 1),
(161, 'Fabio Mora', 1),
(162, 'Cheves', 1),
(163, 'Club de leones', 1),
(164, 'San Pedro', 1),
(165, 'Grupo CT', 1),
(166, 'Instituto oftalmologico', 1),
(207, 'Euro Ópticas Multiplaza Escazu', 1),
(168, 'Opticentro', 1),
(169, 'centro opt. Sto. Domingo', 1),
(170, 'Escazu', 1),
(171, 'Asulatina', 1),
(172, 'Clinica Zurqui', 1),
(173, 'Vitra Cartogo', 1),
(174, 'Nuva Imagen', 1),
(175, 'Solar', 1),
(176, 'BK Frames', 1),
(177, 'villa nueva santa ana', 1),
(178, 'Robles', 1),
(179, 'Liena', 1),
(180, 'Provision Liberia', 1),
(181, 'Sta. Lucia', 1),
(182, 'A la Vista', 1),
(183, 'Serv. Emp.', 1),
(184, 'Opticas del Sur', 1),
(185, 'Multiopticas Barrantes', 1),
(186, 'Mundo Vision', 1),
(206, 'Vitra Quesada', 1),
(188, 'Zurqui', 1),
(189, 'Dra.Silvia Herrera', 1),
(190, 'Gollo Liberia', 1),
(191, 'Especialistas Visuales', 1),
(192, 'Santo Domingo', 1),
(193, 'Óptica Matamoros ', 1),
(194, 'Alda Moravia', 1),
(195, 'Gollo Puntarenas', 1),
(196, 'Euro Ópticas Terra Mall', 1),
(204, 'Euro Ópticas Paseo de las Flores', 1),
(208, 'Vitra La Paz', 1),
(209, 'Salud Optica', 1),
(210, 'Vitra Molino', 1),
(211, 'Vitra San Ramon', 1),
(212, 'The Eye Spa - Pinares', 1),
(213, 'Gollo Grecia', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=214;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
