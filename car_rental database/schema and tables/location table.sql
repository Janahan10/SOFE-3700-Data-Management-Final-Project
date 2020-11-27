CREATE TABLE `location` (
  `Loc_no` int(11) NOT NULL AUTO_INCREMENT,
  `address_line` varchar(45) NOT NULL,
  `city` varchar(45) NOT NULL,
  `province` varchar(45) NOT NULL,
  `ZIP` char(6) NOT NULL,
  PRIMARY KEY (`Loc_no`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
