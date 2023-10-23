CREATE TABLE `Customers` (
  `Id` int PRIMARY KEY AUTO_INCREMENT,
  `FirstName` varchar(255),
  `LastName` varchar(255)
);

CREATE TABLE `Employees` (
  `Id` int PRIMARY KEY AUTO_INCREMENT,
  `FirstName` varchar(255),
  `MiddleName` varchar(255),
  `LastName` varchar(255),
  `BirthDate` date,
  `Position` varchar(255),
  `Salary` double,
  `Image` varchar(255)
);

CREATE TABLE `Cranes` (
  `Id` int PRIMARY KEY AUTO_INCREMENT,
  `Name` varchar(255),
  `MaxWeightInTon` int,
  `PricePerHour` double,
  `PricePerItem` double,
  `Plate` varchar(255),
  `Employee_Id` int,
  `Image` varchar(255)
);

CREATE TABLE `Quotes` (
  `Id` int PRIMARY KEY AUTO_INCREMENT,
  `Customer_Id` int,
  `Employee_Id` int,
  `HiredHours` int,
  `HiredItems` int,
  `DiscountRate` float,
  `Total` double
);

CREATE TABLE `QuoteCranes` (
  `Id` int PRIMARY KEY AUTO_INCREMENT,
  `Crane_Id` int,
  `Quote_Id` int
);

ALTER TABLE `Cranes` ADD FOREIGN KEY (`Employee_Id`) REFERENCES `Employees` (`Id`);

ALTER TABLE `Quotes` ADD FOREIGN KEY (`Customer_Id`) REFERENCES `Customers` (`Id`);

ALTER TABLE `Quotes` ADD FOREIGN KEY (`Employee_Id`) REFERENCES `Employees` (`Id`);

ALTER TABLE `QuoteCranes` ADD FOREIGN KEY (`Crane_Id`) REFERENCES `Cranes` (`Id`);

ALTER TABLE `QuoteCranes` ADD FOREIGN KEY (`Quote_Id`) REFERENCES `Quotes` (`Id`);
