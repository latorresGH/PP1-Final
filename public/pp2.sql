-- MySQL dump 10.13  Distrib 8.0.30, for Win64 (x86_64)
--
-- Host: localhost    Database: pp1
-- ------------------------------------------------------
-- Server version	8.0.30

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `doctrine_migration_versions`
--

DROP TABLE IF EXISTS `doctrine_migration_versions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) COLLATE utf8mb3_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `doctrine_migration_versions`
--

LOCK TABLES `doctrine_migration_versions` WRITE;
/*!40000 ALTER TABLE `doctrine_migration_versions` DISABLE KEYS */;
INSERT INTO `doctrine_migration_versions` VALUES ('DoctrineMigrations\\Version20241120204447',NULL,NULL),('DoctrineMigrations\\Version20241120204500',NULL,NULL),('DoctrineMigrations\\Version20241121000057',NULL,NULL),('DoctrineMigrations\\Version20241121001326',NULL,NULL),('DoctrineMigrations\\Version20241128021649','2024-11-28 02:17:02',105),('DoctrineMigrations\\Version20241128022041','2024-11-28 02:20:56',25),('DoctrineMigrations\\Version20241128022150','2024-11-28 02:21:53',25),('DoctrineMigrations\\Version20241128035717','2024-11-28 03:59:34',27),('DoctrineMigrations\\Version20241130080244','2024-11-30 08:02:54',340),('DoctrineMigrations\\Version20241203015553','2024-12-03 01:56:04',87),('DoctrineMigrations\\Version20241203031358','2024-12-03 03:14:03',18),('DoctrineMigrations\\Version20241203033600','2024-12-03 03:36:06',16);
/*!40000 ALTER TABLE `doctrine_migration_versions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `favorito`
--

DROP TABLE IF EXISTS `favorito`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `favorito` (
  `id` int NOT NULL AUTO_INCREMENT,
  `usuario_id` int DEFAULT NULL,
  `pelicula_id` int DEFAULT NULL,
  `serie_id` int DEFAULT NULL,
  `fecha_agregado` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_881067C7DB38439E` (`usuario_id`),
  KEY `IDX_881067C770713909` (`pelicula_id`),
  KEY `IDX_881067C7D94388BD` (`serie_id`),
  CONSTRAINT `FK_881067C770713909` FOREIGN KEY (`pelicula_id`) REFERENCES `pelicula` (`id`),
  CONSTRAINT `FK_881067C7D94388BD` FOREIGN KEY (`serie_id`) REFERENCES `serie` (`id`),
  CONSTRAINT `FK_881067C7DB38439E` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=57 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `favorito`
--

LOCK TABLES `favorito` WRITE;
/*!40000 ALTER TABLE `favorito` DISABLE KEYS */;
INSERT INTO `favorito` VALUES (55,15,1,NULL,'2024-12-03 08:06:46'),(56,15,3,NULL,'2024-12-03 08:06:50');
/*!40000 ALTER TABLE `favorito` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `messenger_messages`
--

DROP TABLE IF EXISTS `messenger_messages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `messenger_messages` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `body` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `headers` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue_name` varchar(190) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `available_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `delivered_at` datetime DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)',
  PRIMARY KEY (`id`),
  KEY `IDX_75EA56E0FB7336F0` (`queue_name`),
  KEY `IDX_75EA56E0E3BD61CE` (`available_at`),
  KEY `IDX_75EA56E016BA31DB` (`delivered_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `messenger_messages`
--

LOCK TABLES `messenger_messages` WRITE;
/*!40000 ALTER TABLE `messenger_messages` DISABLE KEYS */;
/*!40000 ALTER TABLE `messenger_messages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pelicula`
--

DROP TABLE IF EXISTS `pelicula`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pelicula` (
  `id` int NOT NULL AUTO_INCREMENT,
  `titulo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descripcion` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `duracion` int NOT NULL,
  `imagen` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `archivo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `vistas` int NOT NULL DEFAULT '0',
  `contador_favorito` int NOT NULL,
  `portada` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pelicula`
--

LOCK TABLES `pelicula` WRITE;
/*!40000 ALTER TABLE `pelicula` DISABLE KEYS */;
INSERT INTO `pelicula` VALUES (1,'Vengadores','Descripción de la película',110,'https://es.web.img3.acsta.net/c_310_420/pictures/19/03/26/17/22/0896830.jpg','uploads/Stron.mp4',6,1,'https://images8.alphacoders.com/100/1003220.png'),(3,'El Gato con Botas: El Último Deseo','El Gato con Botas regresa para una nueva aventura épica llena de acción.',102,'https://www.universalpictures.com.ar/tl_files/content/movies/puss_in_boots_2/posters/01.jpg','public/uploads/el_gato_con_botas.mp4',4,1,'https://wallpapers.com/images/hd/puss-in-boots-poster-6riid75fsyootykg.jpg'),(4,'Spider-Man: No Way Home','Spider-Man debe enfrentarse a las consecuencias de sus decisiones con la ayuda de nuevos y viejos aliados.',148,'https://i.pinimg.com/originals/be/d5/4a/bed54a9a2c6d3508b426268eb52a9667.jpg','public/uploads/spiderman_no_way_home.mp4',2,0,'https://wallpapers.com/images/hd/spider-man-no-way-home-background-zjgw4eu8b4jk9vx4.jpg'),(5,'Interstellar','Un grupo de exploradores viaja más allá de nuestra galaxia en busca de un nuevo hogar para la humanidad.',169,'https://i.pinimg.com/originals/11/1c/5c/111c5c9ad99661af2d80e38948cf29d8.jpg','public/uploads/interstellar.mp4',0,0,'https://mrwallpaper.com/images/high/interstellar-miller-s-planet-astronauts-d5hpgadclxszmpeh.jpg'),(6,'Dragon Ball: La Resurrección de Freezer','Goku y sus amigos deben enfrentar a Freezer, quien ha sido resucitado y busca vengarse de ellos.',93,'https://i.pinimg.com/originals/da/85/11/da85116fc40c3022b8e0899c6a593a60.jpg','public/uploads/dragon_ball_resurreccion_freezer.mp4',0,0,'https://i.pinimg.com/originals/5d/92/f4/5d92f44f69c12bb12df14b428580d9c3.jpg'),(7,'Blade Runner 2049','Un nuevo blade runner, K, descubre un secreto que podría cambiar el curso de la humanidad.',164,'https://i0.wp.com/www.espaciocine.com/wp-content/uploads/2017/10/r6MqWtJCyybGoP5LUxqNm7q9kwb.jpg?fit=780%2C1170&ssl=1','public/uploads/blade_runner_2049.mp4',0,0,NULL),(8,'Maze Runner: Correr o Morir','Un grupo de jóvenes debe escapar de un laberinto mortal mientras descubren los secretos detrás de su encierro.',113,'https://play-lh.googleusercontent.com/WJGeAzOAaNjLxFSjiLTThwY-tf8_ho-zbEmxbfBNaw-7vPKgSr7pB61eKybgsyBt4VOFAA','public/uploads/maze_runner_correr_o_morir.mp4',2,0,'https://wallpapers.com/images/hd/maze-runner-escape-bc4dcb98i0kmxcso.jpg'),(9,'No Respires','Un grupo de amigos intenta robarle a un hombre ciego, pero pronto descubren que no es tan indefenso como parece.',88,'https://pbs.twimg.com/media/EyunO7BXMAANY_a.jpg','public/uploads/no_respires.mp4',0,0,NULL),(10,'Harry Potter y la piedra filosofal','Un joven huérfano descubre que es un mago y asiste a la escuela Hogwarts de Magia y Hechicería, donde hace nuevos amigos y enfrenta desafíos.',152,'https://www.lavanguardia.com/peliculas-series/images/movie/poster/2001/11/w1280/7xXJ15VEf7G9GdAuV1dO769yC73.jpg','public/uploads/harry_potter_1.mp4',0,0,NULL),(11,'Harry Potter y la cámara secreta','Harry regresa a Hogwarts para su segundo año, donde descubre que alguien ha abierto la Cámara Secreta, liberando una peligrosa criatura.',161,'https://www.justwatch.com/images/poster/90557960/s718/harry-potter-y-la-camara-secreta.jpg','public/uploads/harry_potter_2.mp4',0,0,NULL),(12,'Harry Potter y el prisionero de Azkaban','Harry descubre que un prisionero peligroso ha escapado de Azkaban y está buscando vengarse de él, mientras se enfrenta a su propio destino.',142,'https://es.web.img2.acsta.net/pictures/14/04/30/11/36/185120.jpg','public/uploads/harry_potter_3.mp4',0,0,NULL),(13,'Harry Potter y el cáliz de fuego','Harry es inesperadamente seleccionado para participar en el Torneo de los Tres Magos, un evento peligroso que pone a prueba su valentía.',157,'https://www.lavanguardia.com/peliculas-series/images/movie/poster/2005/11/w1280/6Cn5Lx9kqhXzTNV5QXwZ3RW5pBg.jpg','public/uploads/harry_potter_4.mp4',0,0,NULL),(14,'Harry Potter y la orden del fénix','Harry forma una sociedad secreta para enfrentar la amenaza de Lord Voldemort, mientras el Ministerio de Magia niega el regreso del oscuro mago.',138,'https://es.web.img3.acsta.net/medias/nmedia/18/71/59/76/20051490.jpg','public/uploads/harry_potter_5.mp4',0,0,NULL),(15,'Harry Potter y el misterio del príncipe','Harry descubre secretos del pasado de Lord Voldemort, mientras el peligro acecha en Hogwarts y los horrores de la guerra mágica se intensifican.',153,'https://www.justwatch.com/images/poster/242424237/s718/harry-potter-y-el-misterio-del-principe.jpg','public/uploads/harry_potter_6.mp4',0,0,NULL),(16,'Harry Potter y las reliquias de la muerte - Parte 1','Harry, Ron y Hermione huyen para destruir los horrocrux de Voldemort, mientras la guerra en el mundo mágico se intensifica.',146,'https://i.pinimg.com/originals/88/ad/a4/88ada4d488f994e618bb0805378b0fc2.jpg','public/uploads/harry_potter_7_1.mp4',0,0,NULL),(17,'Harry Potter y las reliquias de la muerte - Parte 2','La batalla final contra Voldemort tiene lugar en Hogwarts, donde Harry debe hacer un sacrificio definitivo para derrotar al oscuro mago.',130,'https://www.aceprensa.com/wp-content/uploads/2011/07/12445-0.jpg','public/uploads/harry_potter_7_2.mp4',0,0,NULL);
/*!40000 ALTER TABLE `pelicula` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `serie`
--

DROP TABLE IF EXISTS `serie`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `serie` (
  `id` int NOT NULL AUTO_INCREMENT,
  `titulo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descripcion` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `duracion` int NOT NULL,
  `temporadas` int NOT NULL,
  `imagen` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `archivo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `serie`
--

LOCK TABLES `serie` WRITE;
/*!40000 ALTER TABLE `serie` DISABLE KEYS */;
INSERT INTO `serie` VALUES (1,'Stranger Things','Un grupo de niños en un pequeño pueblo enfrenta fenómenos sobrenaturales.',60,4,'https://sm.ign.com/t/ign_es/tv/s/stranger-t/stranger-things_tqfy.1200.jpg','public/uploads/stranger-things.mp4'),(2,'Game of Thrones','En los Siete Reinos, luchas por el poder entre familias nobles.',60,8,'https://hips.hearstapps.com/hmg-prod/images/dany-5c77ee007218a-1551364106.jpg','public/uploads/game-of-thrones.mp4'),(3,'The Witcher','Un cazador de monstruos se enfrenta a dilemas morales en un mundo medieval.',50,2,'https://hips.hearstapps.com/hmg-prod/images/the-witcher-imagenes-y-poster-1562002685.jpeg','public/uploads/the-witcher.mp4'),(4,'Breaking Bad','Un profesor de química convierte en fabricante de drogas después de un diagnóstico terminal.',47,5,'https://decine21.com/img/upload/obras/breaking-bad-5-temporada-26518/breaking-bad-5-temporada-26518-c.jpg','public/uploads/breaking-bad.mp4'),(5,'The Mandalorian','Un cazarrecompensas se enfrenta a desafíos mientras cuida a un misterioso niño.',40,2,'https://img.rtve.es/imagenes/portada-del-libro-star-wars-the-mandalorian-arte-imagenes-planeta-comic/1618403969620.jpg','public/uploads/the-mandalorian.mp4'),(6,'Gambito de dama','Una joven prodigio del ajedrez lucha por ganar respeto en un mundo dominado por hombres mientras lidia con sus demonios internos.',60,1,'https://www.culturacr.net/wp-content/uploads/2020/10/the-queens-gambit-poster-1024x1517.jpg','public/uploads/gambito_de_dama.mp4'),(7,'Superman & Lois','Clark Kent y Lois Lane enfrentan desafíos familiares mientras luchan contra amenazas globales, todo mientras crían a sus hijos en un mundo cada vez más peligroso.',45,1,'https://sm.ign.com/ign_es/screenshot/default/superman-and-lois-poster-1259202_2cy3.jpg','public/uploads/superman_and_lois.mp4'),(8,'Jujutsu Kaisen','Un joven estudiante se une a una escuela de hechicería para luchar contra maldiciones y seres oscuros, mientras enfrenta su destino como un \"conjuro de maldición\".',24,1,'https://cdn.kobo.com/book-images/703d13fe-5c02-4266-a9e6-06ff5d2033d3/1200/1200/False/jujutsu-kaisen-the-official-anime-guide-season-1.jpg','public/uploads/jujutsu_kaisen.mp4'),(9,'Dark','Un pequeño pueblo alemán es el epicentro de eventos misteriosos relacionados con la desaparición de niños, desvelando secretos familiares y un complejo enredo de viajes en el tiempo.',60,3,'https://i.pinimg.com/236x/cf/6d/16/cf6d160eab82de332178c18203ba4d1a.jpg','public/uploads/dark.mp4'),(10,'Arcane','Ambientada en el mundo de \"League of Legends\", esta serie animada explora los orígenes de las hermanas Vi y Jinx y su relación con el caos de la ciudad de Piltover.',40,1,'https://www.ecartelera.com/carteles-series/1800/1805/001.jpg','public/uploads/arcane.mp4');
/*!40000 ALTER TABLE `serie` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuario`
--

DROP TABLE IF EXISTS `usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `usuario` (
  `id` int NOT NULL AUTO_INCREMENT,
  `email` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` json NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nombre` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto_perfil` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_IDENTIFIER_EMAIL` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuario`
--

LOCK TABLES `usuario` WRITE;
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
INSERT INTO `usuario` VALUES (2,'milagrosailenberthet@gmail.com','[]','$2y$13$jd0novBSqNSfm1tTDAolfOw0bL7uKooyMtEJyvH/j9vvQpCb1ULmG','laureano',NULL),(14,'laure@correo.com','[]','$2y$13$8vfy2I8s/eTfB2/hqe2Dk.gDii5WeHFqp7S6bcn3R6FqvXNn.AGzi','laureano',NULL),(15,'vbim101@gmail.com','[]','$2y$13$WolXQdDyQuq0lvnEGOk8C.zHuJhPifBZZsqnbvClc3KyhLS1HzQD6','vbim',NULL);
/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ver_mas_tarde`
--

DROP TABLE IF EXISTS `ver_mas_tarde`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ver_mas_tarde` (
  `id` int NOT NULL AUTO_INCREMENT,
  `usuario_id` int DEFAULT NULL,
  `pelicula_id` int DEFAULT NULL,
  `serie_id` int DEFAULT NULL,
  `fecha_agregado` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_3E042F55DB38439E` (`usuario_id`),
  KEY `IDX_3E042F5570713909` (`pelicula_id`),
  KEY `IDX_3E042F55D94388BD` (`serie_id`),
  CONSTRAINT `FK_3E042F5570713909` FOREIGN KEY (`pelicula_id`) REFERENCES `pelicula` (`id`),
  CONSTRAINT `FK_3E042F55D94388BD` FOREIGN KEY (`serie_id`) REFERENCES `serie` (`id`),
  CONSTRAINT `FK_3E042F55DB38439E` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ver_mas_tarde`
--

LOCK TABLES `ver_mas_tarde` WRITE;
/*!40000 ALTER TABLE `ver_mas_tarde` DISABLE KEYS */;
INSERT INTO `ver_mas_tarde` VALUES (8,15,NULL,4,'2024-12-03 07:03:24');
/*!40000 ALTER TABLE `ver_mas_tarde` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-12-04  0:33:21
