CREATE TABLE `client` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL,
  `Fname` varchar(45) NOT NULL,
  `Lname` varchar(45) NOT NULL,
  `Bdate` date NOT NULL,
  `phone_No` char(10) NOT NULL,
  `Email` varchar(45) NOT NULL,
  `D_license` char(15) NOT NULL,
  PRIMARY KEY (`ID`,`username`),
  UNIQUE KEY `ID_UNIQUE` (`ID`),
  UNIQUE KEY `username_UNIQUE` (`username`),
  UNIQUE KEY `D_license_UNIQUE` (`D_license`)
) ENGINE=InnoDB AUTO_INCREMENT=178 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
