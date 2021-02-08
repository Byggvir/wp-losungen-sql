USE `wordpress`;

CREATE TABLE IF NOT EXISTS `hhl_losungen` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `Datum` datetime DEFAULT NULL,
  `Wtag` varchar(16) DEFAULT NULL,
  `Sonntag` varchar(255) DEFAULT NULL,
  `Losungsvers` varchar(64) DEFAULT NULL,
  `Losungstext` varchar(2048) DEFAULT NULL,
  `Lehrtextvers` varchar(64) DEFAULT NULL,
  `Lehrtext` varchar(2048) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `Datum` (`Datum`),
  KEY `Losungsvers` (`Losungsvers`),
  KEY `Lehrtextvers` (`Lehrtextvers`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4;

