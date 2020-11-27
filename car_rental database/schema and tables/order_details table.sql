CREATE TABLE `order_details` (
  `orderNo` int(11) NOT NULL AUTO_INCREMENT,
  `client_ID` int(11) NOT NULL,
  `car_ID` int(11) NOT NULL,
  `pickup_date` date NOT NULL,
  `drop_date` date NOT NULL,
  `pickup_loc` int(11) NOT NULL,
  `drop_loc` int(11) NOT NULL,
  `total_cost` decimal(10,2) NOT NULL,
  PRIMARY KEY (`orderNo`,`client_ID`,`car_ID`),
  KEY `client_ID_idx` (`client_ID`),
  KEY `car_ID_idx` (`car_ID`),
  KEY `pickup_loc_idx` (`pickup_loc`),
  KEY `drop_loc_idx` (`drop_loc`),
  CONSTRAINT `car_ID` FOREIGN KEY (`car_ID`) REFERENCES `car` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `client_ID` FOREIGN KEY (`client_ID`) REFERENCES `client` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `drop_loc` FOREIGN KEY (`drop_loc`) REFERENCES `location` (`Loc_no`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `pickup_loc` FOREIGN KEY (`pickup_loc`) REFERENCES `location` (`Loc_no`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
