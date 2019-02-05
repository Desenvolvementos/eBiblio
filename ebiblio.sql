-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Xerado en: 04 de Feb de 2019 ás 23:07
-- Versión do servidor: 10.1.36-MariaDB
-- Versión do PHP: 7.2.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `ebiblio`
--

-- --------------------------------------------------------

--
-- Estrutura da táboa `marc21`
--

CREATE TABLE `marc21` (
  `cod` varchar(6) COLLATE utf8_spanish_ci NOT NULL,
  `nombre` varchar(200) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- A extraer os datos da táboa `familia`
--

INSERT INTO `marc21` (`cod`, `nombre`) VALUES
('|', 'No se utiliza'),
('0', 'No es ficción'),
('1', 'Es ficción (sin especificar)'),
('c', 'Cartas'),
('d', 'Drama'),
('e', 'Ensayo'),
('f', 'Novela'),
('h', 'Humor, sátira, etc.'),
('j', 'Relatos'),
('m', 'Forma mixta'),
('ORDENA', 'Ordenadores'),
('p', 'Poesía'),
('s', 'Discursos'),
('u', 'Desconocido'),
('VIDEOC', 'Videocámaras');

-- --------------------------------------------------------

--
-- Estrutura da táboa `ficha`
--

CREATE TABLE `ficha` (
  `cod` varchar(12) COLLATE utf8_spanish_ci NOT NULL,
  `titulo` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `autor` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `edicion` int(4) NOT NULL COMMENT 'En anos',
  `editorial` varchar(50) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Indicar nombre',
  `ISBN` int(11) NOT NULL COMMENT 'Formato'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- A extraer os datos da táboa `ficha`
--

INSERT INTO `ficha` (`cod`, `titulo`, `autor`, `edicion`, `editorial`, `ISBN`) VALUES
('79/ABO/AYA', 'STOP', 'Clement Oubrerie', 2017, 'Norma Editorial', '9788467928914'),
('79/ELE/STO', 'Elerre', 'Elerre', 2018, 'Norma Editorial',  '9788469793343'),
('860/RED/GUA', 'El guardián invisible','Dolores Redondo', 2013, 'Destino', '9788423341986');

-- --------------------------------------------------------

--
-- Estrutura da táboa `catalogo`
--

CREATE TABLE `catalogo` (
  `cod` varchar(12) COLLATE utf8_spanish_ci NOT NULL,
  `nombre` varchar(200) COLLATE utf8_spanish_ci DEFAULT NULL,
  `nombre_corto` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `descripcion` text COLLATE utf8_spanish_ci,
  `familia` varchar(6) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- A extraer os datos da táboa `catalogo`
--

INSERT INTO `catalogo` (`cod`, `nombre`, `nombre_corto`, `descripcion`, `familia`) VALUES
('79/ABO/AYA', 'AYA DE YOPOUGON', 'Título:AYA DE YOPOUGON /Autor/ Código:79/ABO/aya ', 'Costa de Marfil, finales de 1970. Aya, una joven de diecinueve años, vive en Yopougon, un barrio de Abidjan en el que la mayoría de las jóvenes sueñan con convertirse en peluqueras y encontrar un marido.', 'ORDENA'),
('79/ZER/kob', 'Kobane calling', 'Título:KOBANE CALLING /Autor: Zerocalcare/ Código:', '', '6');


-- --------------------------------------------------------

--
-- Estrutura da táboa `reserva`
--

CREATE TABLE `reserva` (
  `cod` varchar(12) COLLATE utf8_spanish_ci NOT NULL,
  `lector` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- A extraer os datos da táboa `reserva`
--

INSERT INTO `reserva` (`cod`, `lector`) VALUES
('79/ABO/AYA', 1974),
('860/GAL/BES',1964);

-- --------------------------------------------------------



-- --------------------------------------------------------

--
-- Estrutura da táboa `lectores`
--

CREATE TABLE `lectores` (
  `usuario` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `contrasena` varchar(32) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- A extraer os datos da táboa `lectores`
--

INSERT INTO `lectores` (`usuario`, `contrasena`) VALUES
('1237', '47bce5c74f589f4867dbd57e9ca9f808'),
('1313', 'f09696910bdd874a99cd74c8f05b5c44'),
('1921', '071e89d6430e8321624257dd60cf80e6'),
('1954', '77963b7a931377ad4ab5ad6a9cd718aa'),
('1964', '39dcaf7a053dc372fbc391d4e6b5d693'),
('1974', '3d863b367aa379f71c7afc0c9cdca41d'),
('2019', 'e8dc8ccd5e5f9e3a54f07350ce8a2d3d'),
('2121', '08f8e0260c64418510cefb2b06eee5cd'),
('2813', '900150983cd24fb0d6963f7d28e17f72'),
('2880', 'c61f571dbd2fb949d3fe5ae1608dd48b'),
('8345', '37c9216b00a111ac0e1f81de25ddff77'),
('bibliotecaria', '900150983cd24fb0d6963f7d28e17f72');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `marc21``
--
ALTER TABLE `marc21`
  ADD PRIMARY KEY (`cod`);

--
-- Indexes for table `ficha`
--
ALTER TABLE `ficha`
  ADD PRIMARY KEY (`cod`);

--
-- Indexes for table `catalogo`
--
ALTER TABLE `catalogo`
  ADD PRIMARY KEY (`cod`),
  ADD UNIQUE KEY `nombre_corto` (`nombre_corto`),
  ADD KEY `familia` (`familia`);

--
-- Indexes for table `reserva`
--
ALTER TABLE `reserva`
  ADD PRIMARY KEY (`cod`,`lector`);


--
-- Indexes for table `lectores`
--
ALTER TABLE `lectores`
  ADD PRIMARY KEY (`usuario`);

--
-- AUTO_INCREMENT for dumped tables
--



/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
