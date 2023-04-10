-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 09, 2023 at 09:02 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `471project`
--

-- --------------------------------------------------------

--
-- Table structure for table `builds`
--

CREATE TABLE `builds` (
  `ESSN` int(9) NOT NULL,
  `TrainID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ceo`
--

CREATE TABLE `ceo` (
  `SSN` int(9) NOT NULL,
  `Address` varchar(200) DEFAULT NULL,
  `Birthdate` date DEFAULT NULL,
  `FirstName` varchar(100) NOT NULL,
  `MiddleName` varchar(100) DEFAULT NULL,
  `LastName` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ceo`
--

INSERT INTO `ceo` (`SSN`, `Address`, `Birthdate`, `FirstName`, `MiddleName`, `LastName`) VALUES
(555555, '2015 aid av SW', '0000-00-00', 'Bob', '', 'Ross');

-- --------------------------------------------------------

--
-- Table structure for table `client`
--

CREATE TABLE `client` (
  `ClientName` varchar(255) NOT NULL,
  `BranchID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `client`
--

INSERT INTO `client` (`ClientName`, `BranchID`) VALUES
('crab', 123),
('crab12', 0),
('crab13', 2131231),
('crab2', 1234),
('crab4', 2131231),
('crab5', 333333),
('crab7', 123),
('crab8', 231231);

-- --------------------------------------------------------

--
-- Table structure for table `company`
--

CREATE TABLE `company` (
  `CompanyID` int(11) NOT NULL,
  `CName` varchar(255) DEFAULT NULL,
  `Address` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `company`
--

INSERT INTO `company` (`CompanyID`, `CName`, `Address`) VALUES
(0, '', '');

-- --------------------------------------------------------

--
-- Table structure for table `dependents`
--

CREATE TABLE `dependents` (
  `ESSN` int(9) NOT NULL,
  `FirstName` varchar(100) NOT NULL,
  `MiddleName` varchar(100) DEFAULT NULL,
  `LastName` varchar(100) NOT NULL,
  `Relationship` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `SSN` int(9) NOT NULL,
  `CEOSSN` int(9) DEFAULT NULL,
  `Address` varchar(200) DEFAULT NULL,
  `FirstName` varchar(100) NOT NULL,
  `MiddleName` varchar(100) DEFAULT NULL,
  `LastName` varchar(100) NOT NULL,
  `Birthdate` date DEFAULT NULL,
  `Salary` decimal(10,2) DEFAULT NULL,
  `Sex` char(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`SSN`, `CEOSSN`, `Address`, `FirstName`, `MiddleName`, `LastName`, `Birthdate`, `Salary`, `Sex`) VALUES
(11111, 555555, '2016', 'Bob', '[value-5]', 'Ross', '0000-00-00', '0.00', '[');

-- --------------------------------------------------------

--
-- Table structure for table `freightcars`
--

CREATE TABLE `freightcars` (
  `TrainID` int(11) NOT NULL,
  `Weight` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `freightcarworker`
--

CREATE TABLE `freightcarworker` (
  `ESSN` int(11) NOT NULL,
  `FreightCarID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `government`
--

CREATE TABLE `government` (
  `Branch` varchar(255) NOT NULL,
  `ClientName` varchar(255) NOT NULL,
  `Address` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `government`
--

INSERT INTO `government` (`Branch`, `ClientName`, `Address`) VALUES
('', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `locomotives`
--

CREATE TABLE `locomotives` (
  `TrainID` int(11) NOT NULL,
  `WeightPullLimit` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `locomotiveworker`
--

CREATE TABLE `locomotiveworker` (
  `ESSN` int(11) NOT NULL,
  `TransitID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `parts`
--

CREATE TABLE `parts` (
  `PartNumber` int(11) NOT NULL,
  `SupplierName` varchar(100) NOT NULL,
  `TrainID` int(11) NOT NULL,
  `Cost` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `parts`
--

INSERT INTO `parts` (`PartNumber`, `SupplierName`, `TrainID`, `Cost`) VALUES
(69, 'Industrial Illusions', 22222, '300.33');

-- --------------------------------------------------------

--
-- Table structure for table `repair/service`
--

CREATE TABLE `repair/service` (
  `ESSN` int(9) NOT NULL,
  `TrainID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `report`
--

CREATE TABLE `report` (
  `ReportID` int(11) NOT NULL,
  `CEOSSN` int(9) NOT NULL,
  `NumberOfClients` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `safetyinspector`
--

CREATE TABLE `safetyinspector` (
  `ESSN` int(9) NOT NULL,
  `InspectorCredentials` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `shop`
--

CREATE TABLE `shop` (
  `BranchID` int(11) NOT NULL,
  `Field` varchar(50) NOT NULL,
  `ShopName` varchar(50) NOT NULL,
  `Location` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `Name` varchar(100) NOT NULL,
  `Address` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`Name`, `Address`) VALUES
('Industrial Illusions', '30th St SW');

-- --------------------------------------------------------

--
-- Table structure for table `train`
--

CREATE TABLE `train` (
  `TrainID` int(11) NOT NULL,
  `InspectorSSN` int(11) NOT NULL,
  `BranchID` int(11) NOT NULL,
  `LocomotiveType` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `train`
--

INSERT INTO `train` (`TrainID`, `InspectorSSN`, `BranchID`, `LocomotiveType`) VALUES
(22222, 11111, 23, 'FC');

-- --------------------------------------------------------

--
-- Table structure for table `trainengineer`
--

CREATE TABLE `trainengineer` (
  `ESSN` int(9) NOT NULL,
  `SupplierName` varchar(100) NOT NULL,
  `Credentials` varchar(100) NOT NULL,
  `TypeOfOrder` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `transitcars`
--

CREATE TABLE `transitcars` (
  `TrainID` int(11) NOT NULL,
  `Occupancy` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `transitworker`
--

CREATE TABLE `transitworker` (
  `ESSN` int(11) NOT NULL,
  `TransitID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `UserType` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`username`, `email`, `password`, `UserType`) VALUES
('hi', 'd@hi', '123', 'SafetyInspector'),
('extra', 'lives@gmail.com', '', 'Employee'),
('client', 'nouman.syed@jumpshere.com', '123', 'Employee'),
('client', 'nouman.syed@ucalgary.ca', '2223', 'CEO'),
('Nouman', 'switchelworldofsta3xblugrass@gmail.com', '09c28992d2', 'CEO');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `builds`
--
ALTER TABLE `builds`
  ADD PRIMARY KEY (`ESSN`,`TrainID`),
  ADD KEY `TrainID` (`TrainID`);

--
-- Indexes for table `ceo`
--
ALTER TABLE `ceo`
  ADD PRIMARY KEY (`SSN`);

--
-- Indexes for table `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`ClientName`);

--
-- Indexes for table `company`
--
ALTER TABLE `company`
  ADD PRIMARY KEY (`CompanyID`);

--
-- Indexes for table `dependents`
--
ALTER TABLE `dependents`
  ADD PRIMARY KEY (`ESSN`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`SSN`),
  ADD KEY `CEOSSN` (`CEOSSN`);

--
-- Indexes for table `freightcars`
--
ALTER TABLE `freightcars`
  ADD PRIMARY KEY (`TrainID`);

--
-- Indexes for table `freightcarworker`
--
ALTER TABLE `freightcarworker`
  ADD PRIMARY KEY (`ESSN`),
  ADD KEY `FreightCarID` (`FreightCarID`);

--
-- Indexes for table `government`
--
ALTER TABLE `government`
  ADD PRIMARY KEY (`Branch`,`ClientName`);

--
-- Indexes for table `locomotives`
--
ALTER TABLE `locomotives`
  ADD PRIMARY KEY (`TrainID`);

--
-- Indexes for table `locomotiveworker`
--
ALTER TABLE `locomotiveworker`
  ADD PRIMARY KEY (`ESSN`),
  ADD KEY `TransitID` (`TransitID`);

--
-- Indexes for table `parts`
--
ALTER TABLE `parts`
  ADD PRIMARY KEY (`PartNumber`),
  ADD KEY `SupplierName` (`SupplierName`),
  ADD KEY `TrainID` (`TrainID`);

--
-- Indexes for table `repair/service`
--
ALTER TABLE `repair/service`
  ADD PRIMARY KEY (`ESSN`,`TrainID`),
  ADD KEY `TrainID` (`TrainID`);

--
-- Indexes for table `report`
--
ALTER TABLE `report`
  ADD PRIMARY KEY (`ReportID`),
  ADD KEY `CEOSSN` (`CEOSSN`);

--
-- Indexes for table `safetyinspector`
--
ALTER TABLE `safetyinspector`
  ADD PRIMARY KEY (`ESSN`);

--
-- Indexes for table `shop`
--
ALTER TABLE `shop`
  ADD PRIMARY KEY (`BranchID`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`Name`);

--
-- Indexes for table `train`
--
ALTER TABLE `train`
  ADD PRIMARY KEY (`TrainID`),
  ADD KEY `InspectorSSN` (`InspectorSSN`);

--
-- Indexes for table `trainengineer`
--
ALTER TABLE `trainengineer`
  ADD PRIMARY KEY (`ESSN`);

--
-- Indexes for table `transitcars`
--
ALTER TABLE `transitcars`
  ADD PRIMARY KEY (`TrainID`);

--
-- Indexes for table `transitworker`
--
ALTER TABLE `transitworker`
  ADD PRIMARY KEY (`ESSN`),
  ADD KEY `TransitID` (`TransitID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `report`
--
ALTER TABLE `report`
  MODIFY `ReportID` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `builds`
--
ALTER TABLE `builds`
  ADD CONSTRAINT `builds_ibfk_1` FOREIGN KEY (`ESSN`) REFERENCES `employee` (`SSN`),
  ADD CONSTRAINT `builds_ibfk_2` FOREIGN KEY (`TrainID`) REFERENCES `train` (`TrainID`);

--
-- Constraints for table `dependents`
--
ALTER TABLE `dependents`
  ADD CONSTRAINT `dependents_ibfk_1` FOREIGN KEY (`ESSN`) REFERENCES `employee` (`SSN`);

--
-- Constraints for table `employee`
--
ALTER TABLE `employee`
  ADD CONSTRAINT `employee_ibfk_1` FOREIGN KEY (`CEOSSN`) REFERENCES `ceo` (`SSN`);

--
-- Constraints for table `freightcars`
--
ALTER TABLE `freightcars`
  ADD CONSTRAINT `freightcars_ibfk_1` FOREIGN KEY (`TrainID`) REFERENCES `train` (`TrainID`);

--
-- Constraints for table `freightcarworker`
--
ALTER TABLE `freightcarworker`
  ADD CONSTRAINT `freightcarworker_ibfk_1` FOREIGN KEY (`ESSN`) REFERENCES `employee` (`SSN`),
  ADD CONSTRAINT `freightcarworker_ibfk_2` FOREIGN KEY (`FreightCarID`) REFERENCES `freightcars` (`TrainID`);

--
-- Constraints for table `locomotiveworker`
--
ALTER TABLE `locomotiveworker`
  ADD CONSTRAINT `locomotiveworker_ibfk_1` FOREIGN KEY (`TransitID`) REFERENCES `locomotives` (`TrainID`);

--
-- Constraints for table `parts`
--
ALTER TABLE `parts`
  ADD CONSTRAINT `parts_ibfk_1` FOREIGN KEY (`SupplierName`) REFERENCES `supplier` (`Name`),
  ADD CONSTRAINT `parts_ibfk_2` FOREIGN KEY (`TrainID`) REFERENCES `train` (`TrainID`);

--
-- Constraints for table `repair/service`
--
ALTER TABLE `repair/service`
  ADD CONSTRAINT `repair/service_ibfk_1` FOREIGN KEY (`ESSN`) REFERENCES `employee` (`SSN`),
  ADD CONSTRAINT `repair/service_ibfk_2` FOREIGN KEY (`TrainID`) REFERENCES `train` (`TrainID`);

--
-- Constraints for table `report`
--
ALTER TABLE `report`
  ADD CONSTRAINT `report_ibfk_1` FOREIGN KEY (`CEOSSN`) REFERENCES `ceo` (`SSN`),
  ADD CONSTRAINT `report_ibfk_2` FOREIGN KEY (`CEOSSN`) REFERENCES `ceo` (`SSN`);

--
-- Constraints for table `train`
--
ALTER TABLE `train`
  ADD CONSTRAINT `train_ibfk_1` FOREIGN KEY (`InspectorSSN`) REFERENCES `employee` (`SSN`);

--
-- Constraints for table `trainengineer`
--
ALTER TABLE `trainengineer`
  ADD CONSTRAINT `trainengineer_ibfk_1` FOREIGN KEY (`ESSN`) REFERENCES `employee` (`SSN`);

--
-- Constraints for table `transitcars`
--
ALTER TABLE `transitcars`
  ADD CONSTRAINT `transitcars_ibfk_1` FOREIGN KEY (`TrainID`) REFERENCES `train` (`TrainID`);

--
-- Constraints for table `transitworker`
--
ALTER TABLE `transitworker`
  ADD CONSTRAINT `transitworker_ibfk_1` FOREIGN KEY (`TransitID`) REFERENCES `transitcars` (`TrainID`);
COMMIT;

ALTER TABLE train
ADD COLUMN last_inspected DATE,
ADD COLUMN inspection_status VARCHAR(255),
ADD COLUMN cost INT;


/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
