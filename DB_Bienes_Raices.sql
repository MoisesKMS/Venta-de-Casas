-- MySQL dump 10.13  Distrib 5.7.33, for Linux (x86_64)
--
-- Host: localhost    Database: bienes_raices
-- ------------------------------------------------------
-- Server version	5.7.33-0ubuntu0.18.04.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `propiedades`
--

DROP TABLE IF EXISTS `propiedades`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `propiedades` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(60) DEFAULT NULL,
  `precio` decimal(10,2) DEFAULT NULL,
  `imagen` varchar(200) DEFAULT NULL,
  `descripcion` longtext,
  `habitaciones` int(1) DEFAULT NULL,
  `wc` int(1) DEFAULT NULL,
  `estacionamiento` int(1) DEFAULT NULL,
  `creado` date DEFAULT NULL,
  `vendedorId` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `vendedorId_idx` (`vendedorId`),
  CONSTRAINT `vendedorId` FOREIGN KEY (`vendedorId`) REFERENCES `vendedores` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `propiedades`
--

LOCK TABLES `propiedades` WRITE;
/*!40000 ALTER TABLE `propiedades` DISABLE KEYS */;
INSERT INTO `propiedades` VALUES (2,'Casa de Lujo en el Lago',30000000.00,'588d306be5ef526681221bd1f7f3d323.jpg','Casa en el Lago con excelente vista, acabados de lujo a un Excelente Precio',3,5,6,'2021-03-09',1),(3,'Casa terminado de Lujo',5000000.00,'83d4f98a0f75cb4f167c2ec7f3e5fd7b.jpg','Casa con diseÃ±o moderno, asÃ­ como tecnologÃ­a inteligente y amueblada',2,3,2,'2021-03-09',2),(4,'Casa con Alberca',4500000.00,'f67802047f5611804bcf728826180856.jpg','Casa con alberca y acabados de lujo en la ciudad, excelente oportunidad',5,2,3,'2021-03-09',1),(5,'Casa con Chica',2000000.00,'2b568feb25104c90e5da4dfa7ee7e929.jpg','Casa con alberca y acabados de lujo en la ciudad, excelente oportunidad',2,1,3,'2021-03-09',1),(6,'Casa acabado Antiguo',6000000.00,'fb0bad0bc6443f3ed9b1cbcfd0f8c3d8.jpg','Hermosa casa con acabado vintage hubicada en el bosque',2,3,2,'2021-03-09',1),(7,'Casa con Alberca Moderna',8000000.00,'06cdd8b94028a2fc6bcc091c955f45b4.jpg','Casa con alberca, acabados modernos y minimalistas con vista a la ciudad',5,2,3,'2021-03-09',1);
/*!40000 ALTER TABLE `propiedades` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(60) DEFAULT NULL,
  `password` varchar(60) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios`
--

LOCK TABLES `usuarios` WRITE;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` VALUES (1,'correo@correo.com','$2y$10$mqRJ3p74ogBud22fylwwo.s3NTnm5ZSPuH/K1EPtAQAXJIe08TBjS');
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vendedores`
--

DROP TABLE IF EXISTS `vendedores`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `vendedores` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) DEFAULT NULL,
  `apellido` varchar(45) DEFAULT NULL,
  `telefono` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vendedores`
--

LOCK TABLES `vendedores` WRITE;
/*!40000 ALTER TABLE `vendedores` DISABLE KEYS */;
INSERT INTO `vendedores` VALUES (1,'Moises','Jimenez Macias','3515199117'),(2,'Abril','Xeder Left','3519912362');
/*!40000 ALTER TABLE `vendedores` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-02-26 19:50:43
