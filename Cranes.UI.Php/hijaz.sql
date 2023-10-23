-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 07, 2022 at 01:50 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hijaz`
--

-- --------------------------------------------------------

--
-- Table structure for table `cranes`
--

CREATE TABLE `cranes` (
  `Id` int(11) NOT NULL,
  `Name` varchar(40) NOT NULL,
  `MaxWeightLiftInTon` double DEFAULT NULL,
  `PricePerHour` double DEFAULT NULL,
  `PricePerItem` double DEFAULT NULL,
  `Plate` varchar(40) DEFAULT NULL,
  `Image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cranes`
--

INSERT INTO `cranes` (`Id`, `Name`, `MaxWeightLiftInTon`, `PricePerHour`, `PricePerItem`, `Plate`, `Image`) VALUES
(6, 'ForkLift', 15, 90, 200, 'AE2000', 'Images/Cranes/ForkLift61679f9a15dab4.74724418.jpg'),
(7, 'Tadano', 12, 50, 200, 'AE6233', 'Images/Cranes/Tadano6167a0a3d42e53.85989892.png'),
(8, 'Kobelco', 15, 70, 200, 'AE2399', 'Images/Cranes/Kobelco6167a13aef26a9.40236519.jpg'),
(9, 'Mitsubishi', 20, 50, 200, 'AE2911', 'Images/Cranes/Mitsubishi6167a407929433.12918232.png'),
(10, 'Liber', 30, 80, 200, 'AE6000', 'Images/Cranes/Liber6167a5274fa8c9.88790497.jpg'),
(11, 'Liber', 70, 50, 350, 'AE6000', 'Images/Cranes/Liber6167a5c6e467d0.23667997.jpg'),
(14, 'PH', 80, 75, 350, 'AE', 'Images/Cranes/PH6167aa89757885.26297633.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `customer-contacts`
--

CREATE TABLE `customer-contacts` (
  `Id` int(11) NOT NULL,
  `Customer_Id` int(11) NOT NULL,
  `ContactType` varchar(20) NOT NULL,
  `Contact` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `Id` int(11) NOT NULL,
  `FirstName` varchar(20) NOT NULL,
  `LastName` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`Id`, `FirstName`, `LastName`) VALUES
(7, 'Faysal', 'Musa'),
(9, 'Hussein', 'Mohamod');

-- --------------------------------------------------------

--
-- Table structure for table `employee-contacts`
--

CREATE TABLE `employee-contacts` (
  `Id` int(11) NOT NULL,
  `Employee_Id` int(11) NOT NULL,
  `ContactType` varchar(20) NOT NULL,
  `Contact` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `Id` int(11) NOT NULL,
  `FirstName` varchar(40) NOT NULL,
  `MiddleName` varchar(40) NOT NULL,
  `LastName` varchar(40) NOT NULL,
  `BirthDate` date NOT NULL,
  `Gender` varchar(10) NOT NULL,
  `Position` varchar(20) NOT NULL,
  `Salary` double NOT NULL,
  `Image` varchar(300) DEFAULT NULL,
  `Email` varchar(50) NOT NULL,
  `Password` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`Id`, `FirstName`, `MiddleName`, `LastName`, `BirthDate`, `Gender`, `Position`, `Salary`, `Image`, `Email`, `Password`) VALUES
(19, 'Abdirahman', 'Ali', 'Mohamod', '2001-03-29', 'Male', 'Manager', 50000, 'Images/Employees/Abdirahman6186a0f7cd8758.36821783.jpg', 'test@gmail.com', '1877'),
(20, 'asdf', 'fdasf', 'adfssf', '2021-12-11', 'Male', 'asddf', 555, 'Images/Employees/asdf61b4f37d9b7af6.75059091.jpeg', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `invoices`
--

CREATE TABLE `invoices` (
  `Id` int(11) NOT NULL,
  `Qoute_Id` int(11) NOT NULL,
  `Paid` double NOT NULL,
  `Remained` double NOT NULL,
  `Date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `quotes`
--

CREATE TABLE `quotes` (
  `Id` int(11) NOT NULL,
  `Customer_Id` int(11) NOT NULL,
  `Crane_Id` int(11) NOT NULL,
  `HiredHours` int(11) DEFAULT NULL,
  `HiredItems` int(11) DEFAULT NULL,
  `Date` date NOT NULL DEFAULT current_timestamp(),
  `Discount` float DEFAULT 0,
  `Total` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `quotes`
--

INSERT INTO `quotes` (`Id`, `Customer_Id`, `Crane_Id`, `HiredHours`, `HiredItems`, `Date`, `Discount`, `Total`) VALUES
(15, 7, 8, 5, 0, '2021-10-17', 50, 175),
(16, 9, 6, 6, 0, '2021-11-06', 3, 523.8);

--
-- Triggers `quotes`
--
DELIMITER $$
CREATE TRIGGER `quotes_invoices_remianed` AFTER INSERT ON `quotes` FOR EACH ROW UPDATE quotes SET quotes.Total = invoices.Remained WHERE quotes.Id = invoices.Qoute_Id
$$
DELIMITER ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cranes`
--
ALTER TABLE `cranes`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `customer-contacts`
--
ALTER TABLE `customer-contacts`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `Customer_Id` (`Customer_Id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `employee-contacts`
--
ALTER TABLE `employee-contacts`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `Employee_Id` (`Employee_Id`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `invoices`
--
ALTER TABLE `invoices`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `quotes`
--
ALTER TABLE `quotes`
  ADD PRIMARY KEY (`Id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cranes`
--
ALTER TABLE `cranes`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `customer-contacts`
--
ALTER TABLE `customer-contacts`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `employee-contacts`
--
ALTER TABLE `employee-contacts`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `invoices`
--
ALTER TABLE `invoices`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `quotes`
--
ALTER TABLE `quotes`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `customer-contacts`
--
ALTER TABLE `customer-contacts`
  ADD CONSTRAINT `fk_customer_contacts_customers_Id` FOREIGN KEY (`Customer_Id`) REFERENCES `customers` (`Id`);

--
-- Constraints for table `employee-contacts`
--
ALTER TABLE `employee-contacts`
  ADD CONSTRAINT `fk_employee_contacts_employees_Id` FOREIGN KEY (`Employee_Id`) REFERENCES `employees` (`Id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
