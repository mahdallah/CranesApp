-- cranes            /Name, WeghtLift, PricePerHour, Plate, image, PerItem
CREATE TABLE `hijaz`.`cranes` ( `Id` INT NOT NULL AUTO_INCREMENT , `Name` VARCHAR(40) NOT NULL , `WeghtLift` DOUBLE NULL , `PricePerHour` DOUBLE NOT NULL , `Plate` VARCHAR(40) NULL , `Image` VARCHAR(100) NOT NULL , PRIMARY KEY (`Id`))
-- employees         /FirstName, MiddleName, LastName, BirthDate, Gender, position, salary, image
CREATE TABLE `hijaz`.`employees` ( `Id` INT NOT NULL AUTO_INCREMENT , `FirstName` VARCHAR(40) NOT NULL , `MiddleName` VARCHAR(40) NOT NULL , `LastName` VARCHAR(40) NOT NULL , `BirthDate` DATE NULL , `Gender` VARCHAR(10) NOT NULL , `Position` VARCHAR(20) NULL , `Salary` DOUBLE NOT NULL , `image` VARCHAR(50) NOT NULL , PRIMARY KEY (`Id`));
-- customers         /FirstName, LastName
CREATE TABLE `hijaz`.`customers` ( `Id` INT NOT NULL AUTO_INCREMENT , `FirstName` VARCHAR(20) NOT NULL , `LastName` VARCHAR(20) NOT NULL , PRIMARY KEY (`Id`));
-- service           /Customer_Id, Crane_Id, HiredHours, Date
CREATE TABLE `hijaz`.`services` ( `Id` INT NOT NULL AUTO_INCREMENT , `Customer_Id` INT NOT NULL , `Crane_Id` INT NOT NULL , `HiredHours` INT NULL , `HiredItems` INT NULL , `Date` DATE NOT NULL , PRIMARY KEY (`Id`)) ENGINE = InnoDB;

--customer_contacts  /Customer_Id, ContactType, Contact
CREATE TABLE `hijaz`.`customer-contacts` ( `Id` INT NOT NULL AUTO_INCREMENT , `Customer_Id` INT NOT NULL , `ContactType` VARCHAR(20) NOT NULL , `Contact` VARCHAR(100) NOT NULL , PRIMARY KEY (`Id`));
ALTER TABLE `customer-contacts` ADD INDEX(`Customer_Id`);

ALTER TABLE `customer-contacts` ADD CONSTRAINT `fk_customer_contacts_customers_Id` FOREIGN KEY (`Customer_Id`) REFERENCES `customers`(`Id`) ON DELETE RESTRICT ON UPDATE RESTRICT;
--employee_contacts  /Employee_Id, ContactType, Contact
CREATE TABLE `hijaz`.`employee-contacts` ( `Id` INT NOT NULL AUTO_INCREMENT , `Employee_Id` INT NOT NULL , `ContactType` VARCHAR(20) NOT NULL , `Contact` VARCHAR(100) NOT NULL , PRIMARY KEY (`Id`)) ENGINE = InnoDB;
ALTER TABLE `employee-contacts` ADD INDEX(`Employee_Id`);

ALTER TABLE `employee-contacts` ADD CONSTRAINT `fk_employee_contacts_employees_Id` FOREIGN KEY (`Employee_Id`) REFERENCES `employees`(`Id`) ON DELETE RESTRICT ON UPDATE RESTRICT;