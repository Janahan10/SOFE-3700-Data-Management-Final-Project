CREATE TABLE `car` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `year` char(4) DEFAULT NULL,
  `make` varchar(45) DEFAULT NULL,
  `model` varchar(45) DEFAULT NULL,
  `color` varchar(45) DEFAULT NULL,
  `class` varchar(45) DEFAULT NULL,
  `body` varchar(45) DEFAULT NULL,
  `seats` varchar(45) DEFAULT NULL,
  `MSRP` varchar(45) DEFAULT NULL,
  `engine` varchar(45) DEFAULT NULL,
  `transmission` varchar(45) DEFAULT NULL,
  `cost_per_day` decimal(10,2) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
