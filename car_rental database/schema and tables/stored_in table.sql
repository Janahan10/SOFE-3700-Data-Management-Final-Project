CREATE TABLE `stored_in` (
  `car_ID` int(11) NOT NULL,
  `loc_No` int(11) NOT NULL,
  PRIMARY KEY (`car_ID`,`loc_No`),
  KEY `loc_No_idx` (`loc_No`),
  CONSTRAINT `car` FOREIGN KEY (`car_ID`) REFERENCES `car` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `loc` FOREIGN KEY (`loc_No`) REFERENCES `location` (`Loc_no`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
