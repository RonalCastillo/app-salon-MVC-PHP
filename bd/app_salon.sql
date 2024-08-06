create database appsalon_mvc;
use appsalon_mvc;
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(60) DEFAULT NULL,
  `apellido` varchar(60) DEFAULT NULL,
  `email` varchar(30) DEFAULT NULL,
  `password` varchar(60) DEFAULT NULL,
  `telefono` varchar(10) DEFAULT NULL,
  `admin` tinyint(1) DEFAULT NULL,
  `confirmado` tinyint(1) DEFAULT NULL,
  `token` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `servicios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(60) DEFAULT NULL,
  `precio` decimal(5,2) DEFAULT NULL,
  PRIMARY KEY (`id`)
)
;
INSERT INTO `servicios` (`id`, `nombre`, `precio`) VALUES
    (1, 'Corte de Cabello Mujer', 90.00),
    (2, 'Corte de Cabello Hombre', 80.00),
    (3, 'Corte de Cabello Niño', 60.00),
    (4, 'Peinado Mujer', 80.00),
    (5, 'Peinado Hombre', 60.00),
    (6, 'Peinado Niño', 60.00),
    (7, 'Corte de Barba', 60.00),
    (8, 'Tinte Mujer', 300.00),
    (9, 'Uñas', 400.00),
    (10, 'Lavado de Cabello', 50.00),
    (11, 'Tratamiento Capilar', 150.00),
    (12, ' Tinte para cabello', 120.00);
    
    CREATE TABLE IF NOT EXISTS `citas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fecha` date DEFAULT NULL,
  `hora` time DEFAULT NULL,
  `usuarioId` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `usuarioId_idx` (`usuarioId`),
  CONSTRAINT `citas_ibfk_1` FOREIGN KEY (`usuarioId`) REFERENCES `usuarios` (`id`) ON DELETE SET NULL ON UPDATE SET NULL
);

CREATE TABLE IF NOT EXISTS `citasservicios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `citaId` int(11) DEFAULT NULL,
  `servicioId` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `citaId_idx` (`citaId`),
  KEY `servicioId_idx` (`servicioId`),
  CONSTRAINT `citasservicios_ibfk_1` FOREIGN KEY (`citaId`) REFERENCES `citas` (`id`) ON DELETE SET NULL ON UPDATE SET NULL,
  CONSTRAINT `citasservicios_ibfk_2` FOREIGN KEY (`servicioId`) REFERENCES `servicios` (`id`) ON DELETE SET NULL ON UPDATE SET NULL
)