DROP DATABASE  IF EXISTS `mpkdb`;

CREATE DATABASE  IF NOT EXISTS `mpkdb` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;

USE `mpkdb`;

DROP TABLE IF EXISTS `building`;

CREATE TABLE `building` (
    `building_id` int NOT NULL AUTO_INCREMENT,
    `address` varchar(255) NOT NULL,
    `name` varchar(255) NOT NULL,
    `owner` varchar(255) NOT NULL,
    PRIMARY KEY (`building_id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;



DROP TABLE IF EXISTS `service_type`;

CREATE TABLE `service_type` (
    `id` int NOT NULL,
    `name` varchar(255) DEFAULT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;



DROP TABLE IF EXISTS `project`;

CREATE TABLE `project` (
   `id` int NOT NULL AUTO_INCREMENT,
   `date` varchar(255) DEFAULT NULL,
   `floor` varchar(255) DEFAULT NULL,
   `mpk` varchar(255) DEFAULT NULL,
   `project_num` int DEFAULT NULL,
   `short_description` varchar(255) DEFAULT NULL,
   `tenant` varchar(255) DEFAULT NULL,
   `building_id` int DEFAULT NULL,
   `service_type_id` int NOT NULL,
   PRIMARY KEY (`id`),
   KEY `FK_BUILDING_idx` (`building_id`),
   KEY `FK_SERVICE_TYPE_idx` (`service_type_id`),
   CONSTRAINT `FK_SERVICE_TYPE_ID` FOREIGN KEY (`service_type_id`) REFERENCES `service_type` (`id`),
   CONSTRAINT `FK_BUILDING_ID` FOREIGN KEY (`building_id`) REFERENCES `building` (`building_id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
