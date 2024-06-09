-- --------------------------------------------------------
-- Host:                         161.132.48.189
-- Versión del servidor:         10.5.23-MariaDB-0+deb11u1 - Debian 11
-- SO del servidor:              debian-linux-gnu
-- HeidiSQL Versión:             12.7.0.6850
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Volcando estructura de base de datos para essaludbd1
CREATE DATABASE IF NOT EXISTS `essaludbd1` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;
USE `essaludbd1`;

-- Volcando estructura para tabla essaludbd1.citas
CREATE TABLE IF NOT EXISTS `citas` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `EspecialidadID` int(11) NOT NULL,
  `MedicoID` int(11) NOT NULL,
  `PacienteID` int(11) NOT NULL,
  `FechaAtencion` date NOT NULL,
  `InicioAtencion` time NOT NULL,
  `Estado` varchar(255) DEFAULT 'Programada',
  `Observaciones` varchar(500) DEFAULT NULL,
  `Activo` tinyint(1) NOT NULL DEFAULT 1,
  `FechaRegistro` datetime DEFAULT current_timestamp(),
  `FechaModificacion` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `UsuarioRegistro` varchar(255) DEFAULT NULL,
  `UsuarioModificacion` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`ID`),
  KEY `FK_Citas_Especialidades` (`EspecialidadID`),
  KEY `FK_Citas_Medicos` (`MedicoID`),
  KEY `FK_Citas_Pacientes` (`PacienteID`),
  CONSTRAINT `FK_Citas_Especialidades` FOREIGN KEY (`EspecialidadID`) REFERENCES `especialidades` (`ID`),
  CONSTRAINT `FK_Citas_Medicos` FOREIGN KEY (`MedicoID`) REFERENCES `medicos` (`ID`),
  CONSTRAINT `FK_Citas_Pacientes` FOREIGN KEY (`PacienteID`) REFERENCES `pacientes` (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcando datos para la tabla essaludbd1.citas: ~15 rows (aproximadamente)
INSERT INTO `citas` (`ID`, `EspecialidadID`, `MedicoID`, `PacienteID`, `FechaAtencion`, `InicioAtencion`, `Estado`, `Observaciones`, `Activo`, `FechaRegistro`, `FechaModificacion`, `UsuarioRegistro`, `UsuarioModificacion`) VALUES
	(1, 1, 1, 1, '2024-06-01', '08:00:00', 'Programada', NULL, 1, '2024-05-24 18:43:13', '2024-05-24 18:43:13', NULL, NULL),
	(2, 2, 2, 2, '2024-06-02', '09:00:00', 'Programada', NULL, 1, '2024-05-24 18:43:13', '2024-05-24 18:43:13', NULL, NULL),
	(23, 1, 1, 75427645, '2024-06-01', '01:00:00', 'Cancelada', NULL, 0, '2024-05-24 21:44:22', '2024-05-24 23:03:33', NULL, NULL),
	(24, 1, 1, 75427645, '2024-06-01', '08:00:00', 'Cancelada', NULL, 0, '2024-05-24 21:45:22', '2024-05-24 23:03:39', NULL, NULL),
	(25, 2, 2, 75427645, '2024-06-01', '08:00:00', 'Cancelada', NULL, 0, '2024-05-24 21:48:40', '2024-05-24 22:16:38', NULL, NULL),
	(26, 1, 1, 75427645, '2024-06-01', '09:00:00', 'Cancelada', NULL, 0, '2024-05-24 21:50:45', '2024-05-24 22:16:08', NULL, NULL),
	(27, 1, 1, 75427645, '2024-06-01', '09:00:00', 'Cancelada', NULL, 0, '2024-05-24 22:11:12', '2024-05-24 22:14:37', NULL, NULL),
	(28, 1, 1, 75427645, '2024-06-01', '08:00:00', 'Cancelada', NULL, 0, '2024-05-24 22:17:48', '2024-05-24 22:17:50', NULL, NULL),
	(29, 1, 1, 75427645, '2024-06-01', '08:00:00', 'Programada', NULL, 1, '2024-05-24 23:03:56', '2024-05-24 23:03:56', NULL, NULL),
	(30, 1, 1, 12345678, '2024-06-01', '08:00:00', 'Cancelada', NULL, 0, '2024-05-31 17:22:03', '2024-05-31 17:22:04', NULL, NULL),
	(33, 1, 1, 63261636, '2024-06-01', '08:00:00', 'Programada', NULL, 1, '2024-06-01 00:41:27', '2024-06-01 00:41:27', NULL, NULL),
	(34, 1, 1, 41312123, '2024-06-01', '08:00:00', 'Cancelada', NULL, 0, '2024-06-01 02:13:20', '2024-06-01 02:13:21', NULL, NULL),
	(36, 1, 1, 12345678, '2024-06-01', '08:00:00', 'Programada', NULL, 1, '2024-06-01 11:15:27', '2024-06-01 11:15:27', NULL, NULL),
	(37, 1, 1, 75407600, '2024-06-01', '08:00:00', 'Programada', NULL, 1, '2024-06-01 11:52:14', '2024-06-01 11:52:14', NULL, NULL),
	(38, 1, 1, 12345678, '2024-06-01', '09:00:00', 'Programada', NULL, 1, '2024-06-01 11:53:19', '2024-06-01 11:53:19', NULL, NULL);

-- Volcando estructura para tabla essaludbd1.especialidades
CREATE TABLE IF NOT EXISTS `especialidades` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(255) NOT NULL,
  `Descripcion` varchar(500) DEFAULT NULL,
  `Activo` tinyint(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcando datos para la tabla essaludbd1.especialidades: ~3 rows (aproximadamente)
INSERT INTO `especialidades` (`ID`, `Nombre`, `Descripcion`, `Activo`) VALUES
	(1, 'Cardiología', 'Trata enfermedades del corazón y el sistema circulatorio.', 1),
	(2, 'Dermatología', 'Especializada en el tratamiento de la piel y sus enfermedades.', 1),
	(3, 'Pediatría', 'Cuidado médico especializado para infantes, niños y adolescentes.', 1);

-- Volcando estructura para tabla essaludbd1.horarios
CREATE TABLE IF NOT EXISTS `horarios` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `MedicoID` int(11) NOT NULL,
  `FechaAtencion` date NOT NULL,
  `InicioAtencion` time NOT NULL,
  `FinAtencion` time NOT NULL,
  `Activo` tinyint(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`ID`),
  KEY `FK_Horarios_Medicos` (`MedicoID`),
  CONSTRAINT `FK_Horarios_Medicos` FOREIGN KEY (`MedicoID`) REFERENCES `medicos` (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcando datos para la tabla essaludbd1.horarios: ~4 rows (aproximadamente)
INSERT INTO `horarios` (`ID`, `MedicoID`, `FechaAtencion`, `InicioAtencion`, `FinAtencion`, `Activo`) VALUES
	(1, 1, '2024-06-01', '08:00:00', '09:00:00', 1),
	(2, 1, '2024-06-01', '09:00:00', '10:00:00', 1),
	(3, 2, '2024-06-01', '08:00:00', '09:00:00', 1),
	(4, 2, '2024-06-02', '09:00:00', '10:00:00', 1);

-- Volcando estructura para tabla essaludbd1.medicos
CREATE TABLE IF NOT EXISTS `medicos` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Nombres` varchar(255) NOT NULL,
  `Apellidos` varchar(255) NOT NULL,
  `DNI` varchar(15) NOT NULL,
  `Direccion` varchar(500) DEFAULT NULL,
  `Correo` varchar(255) DEFAULT NULL,
  `Telefono` varchar(15) DEFAULT NULL,
  `Sexo` char(1) DEFAULT NULL,
  `NumColegiatura` varchar(255) DEFAULT NULL,
  `FechaNacimiento` date DEFAULT NULL,
  `Activo` tinyint(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcando datos para la tabla essaludbd1.medicos: ~5 rows (aproximadamente)
INSERT INTO `medicos` (`ID`, `Nombres`, `Apellidos`, `DNI`, `Direccion`, `Correo`, `Telefono`, `Sexo`, `NumColegiatura`, `FechaNacimiento`, `Activo`) VALUES
	(1, 'Luis', 'García', '12345678', 'Calle Sol 123, Lima', 'luisgarcia@example.com', '987654321', 'M', 'MED12345', '1975-08-15', 1),
	(2, 'Ana', 'Méndez', '87654321', 'Av Luna 456, Lima', 'anamendez@example.com', '912345678', 'F', 'MED54321', '1980-12-20', 1),
	(3, 'Carlos', 'Torres', '98765432', 'Calle Río 234, Lima', 'carlostorres@example.com', '935678123', 'M', 'MED67890', '1970-01-25', 1),
	(10, 'juan', 'quispe', '2313', 'Calle Sol 123, Lima', 'luisgarcia@example.com', '4123131', 'M', 'MD1234', '2024-05-31', 1),
	(17, 'Renato', 'Chambilla', '71041123', 'Calle Sol 123, Lima', 'luisgarcia@example.com', '431321', 'M', 'MD1213', '2002-10-16', 1);

-- Volcando estructura para tabla essaludbd1.medicos_especialidades
CREATE TABLE IF NOT EXISTS `medicos_especialidades` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `MedicoID` int(11) NOT NULL,
  `EspecialidadID` int(11) NOT NULL,
  `FechaRegistro` datetime DEFAULT NULL,
  `FechaModificacion` datetime DEFAULT NULL,
  `UsuarioRegistro` varchar(255) DEFAULT NULL,
  `UsuarioModificacion` varchar(255) DEFAULT NULL,
  `Activo` tinyint(1) DEFAULT 1,
  PRIMARY KEY (`ID`),
  KEY `FK_Medicos_Especialidades_Especialidades` (`EspecialidadID`),
  KEY `FK_Medicos_Especialidades_Medicos` (`MedicoID`),
  CONSTRAINT `FK_Medicos_Especialidades_Especialidades` FOREIGN KEY (`EspecialidadID`) REFERENCES `especialidades` (`ID`),
  CONSTRAINT `FK_Medicos_Especialidades_Medicos` FOREIGN KEY (`MedicoID`) REFERENCES `medicos` (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcando datos para la tabla essaludbd1.medicos_especialidades: ~3 rows (aproximadamente)
INSERT INTO `medicos_especialidades` (`ID`, `MedicoID`, `EspecialidadID`, `FechaRegistro`, `FechaModificacion`, `UsuarioRegistro`, `UsuarioModificacion`, `Activo`) VALUES
	(1, 1, 1, NULL, NULL, NULL, NULL, 1),
	(2, 2, 2, NULL, NULL, NULL, NULL, 1),
	(3, 3, 1, NULL, NULL, NULL, NULL, 1);

-- Volcando estructura para tabla essaludbd1.pacientes
CREATE TABLE IF NOT EXISTS `pacientes` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Nombres` varchar(255) NOT NULL,
  `Apellidos` varchar(255) NOT NULL,
  `DNI` varchar(15) NOT NULL,
  `Direccion` varchar(500) DEFAULT NULL,
  `Telefono` varchar(15) DEFAULT NULL,
  `Sexo` char(1) DEFAULT NULL,
  `FechaNacimiento` date DEFAULT NULL,
  `Activo` tinyint(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=75427646 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcando datos para la tabla essaludbd1.pacientes: ~5 rows (aproximadamente)
INSERT INTO `pacientes` (`ID`, `Nombres`, `Apellidos`, `DNI`, `Direccion`, `Telefono`, `Sexo`, `FechaNacimiento`, `Activo`) VALUES
	(12345678, 'Luis', 'Moreno', '12345678', 'tewwer', '2313123', 'M', '2024-05-31', 1),
	(41312123, 'Maria', 'Montenegro', '41312123', 'Asoc.Las Buganvilas', '312123', 'F', NULL, 1),
	(63261636, 'rene', 'manchego', '63261636', 'Las Cucardas', '6433122', 'M', NULL, 1),
	(75407600, 'Ricardo', 'Valcarcel', '75407600', 'Tacna Pocollay', '999888777', 'M', '1997-10-10', 1),
	(75427645, 'Ronal Daniel', 'Lupaca Mamani', '75427645', 'EL AGUSTINO 12', '952548879', 'M', '2001-10-19', 1);

-- Volcando estructura para tabla essaludbd1.tbrol
CREATE TABLE IF NOT EXISTS `tbrol` (
  `idrol` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  PRIMARY KEY (`idrol`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcando datos para la tabla essaludbd1.tbrol: ~2 rows (aproximadamente)
INSERT INTO `tbrol` (`idrol`, `nombre`) VALUES
	(1, 'Administrador'),
	(2, 'Paciente');

-- Volcando estructura para tabla essaludbd1.tbusuario
CREATE TABLE IF NOT EXISTS `tbusuario` (
  `dniusuario` int(11) NOT NULL,
  `nombres` varchar(100) NOT NULL,
  `apellidos` varchar(100) NOT NULL,
  `contrasenia` varchar(100) NOT NULL,
  `correo` varchar(100) DEFAULT NULL,
  `telefono` int(11) DEFAULT NULL,
  `fechanacimiento` date DEFAULT NULL,
  `fk_idrol` int(11) NOT NULL,
  `direccion` varchar(100) DEFAULT NULL,
  `sexo` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`dniusuario`),
  KEY `rol` (`fk_idrol`),
  CONSTRAINT `FK_usuario_rol` FOREIGN KEY (`fk_idrol`) REFERENCES `tbrol` (`idrol`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcando datos para la tabla essaludbd1.tbusuario: ~9 rows (aproximadamente)
INSERT INTO `tbusuario` (`dniusuario`, `nombres`, `apellidos`, `contrasenia`, `correo`, `telefono`, `fechanacimiento`, `fk_idrol`, `direccion`, `sexo`) VALUES
	(4123123, 'eqwe', 'eqwweq', '123', 'eqweqweqw@gmail.com', 23131, '2024-06-01', 2, 'eqwewqq', 'F'),
	(12345678, 'Luis', 'Moreno', '123', 'luismoreno@gmail.com', 541233123, '2002-12-09', 2, 'EL AGUSTINO', 'M'),
	(41312123, 'Maria', 'Montenegro', '123', 'Melina@gmail.com', 312123423, '2002-01-11', 2, 'Asoc.Las Buganvilas', 'F'),
	(63261636, 'rene', 'manchego', '123', 'rene123@gmail.com', 214748364, '2000-05-20', 2, 'Asoc.Las Buganvilas', 'M'),
	(71041199, 'Renato', 'Chambilla', '123', 'renatochambilla@gmail.com', 946984235, '2002-10-16', 1, 'EL AGUSTINO', 'M'),
	(75407600, 'Ricardo', 'Valcarcel', '123', 'varcarcel@upt.pe', 999888777, '1997-06-05', 2, 'Tacna Pocollay', 'M'),
	(75427640, 'Daniel', 'Lupaca', '123', 'daniel@gmai.com', 853213123, '2002-04-14', 1, 'Asoc. Los Alamos', 'M'),
	(75427645, 'Ronal Daniel', 'Lupaca Mamani', '123', 'daniel25stuna@gmail.com', 952548879, '2002-07-19', 2, 'EL AGUSTINO', 'M'),
	(87654321, 'Luis', 'Vallejo', '123', 'luis123@gmail.com', 214748364, '2007-01-04', 2, 'Asoc. Las Buganbilas', 'M');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
