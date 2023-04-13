-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 13, 2023 at 03:42 AM
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

--
-- Dumping data for table `builds`
--

INSERT INTO `builds` (`ESSN`, `TrainID`) VALUES
(100100400, 1000),
(100100400, 1002),
(100100400, 1003),
(100100400, 1005);

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
(666666666, '2012 21st St Sw', '1994-02-15', 'Strike', 'John', 'Free');

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
('CompanyMan', 5000),
('CrabMan', 5000),
('CrabMan2', 5000),
('CrabMan3', 5000),
('GovernmentMan', 5000);

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
(3500, 'KaibaCorp', '3000 Millenium Drive NW'),
(5001, 'CompanyMan', '555 Domino City NW');

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

--
-- Dumping data for table `dependents`
--

INSERT INTO `dependents` (`ESSN`, `FirstName`, `MiddleName`, `LastName`, `Relationship`) VALUES
(100100500, 'Syrus', 'Von', 'Truesdale', 'Friend');

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
(100100200, 666666666, '2022 21st St Sw', 'Bob', 'Morgan', 'Freeman', '1999-02-15', '35000.00', 'M'),
(100100300, 666666666, '89 Height Road SW', 'Elas', 'Kas', 'Dry', '1999-03-17', '90000.00', 'M'),
(100100400, 666666666, '786 Duel Academy NW', 'Axel', 'Von', 'Brodie', '2002-02-15', '60000.00', 'M'),
(100100500, 666666666, '786 Duel Academy NW', 'Jim', 'Crocodile', 'Cook', '2002-02-16', '55000.00', 'M');

-- --------------------------------------------------------

--
-- Table structure for table `government`
--

CREATE TABLE `government` (
  `GovBranch` varchar(255) NOT NULL,
  `ClientName` varchar(255) NOT NULL,
  `Address` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `government`
--

INSERT INTO `government` (`GovBranch`, `ClientName`, `Address`) VALUES
('Dept of Canada', 'GovernmentMan', '3500 Washington Millenium NE');

-- --------------------------------------------------------

--
-- Table structure for table `parts`
--

CREATE TABLE `parts` (
  `PartNumber` int(11) NOT NULL,
  `SupplierName` varchar(100) NOT NULL,
  `TrainID` int(11) NOT NULL,
  `PartName` varchar(100) DEFAULT NULL,
  `Cost` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `parts`
--

INSERT INTO `parts` (`PartNumber`, `SupplierName`, `TrainID`, `PartName`, `Cost`) VALUES
(1, 'Industrial Illusions', 1000, 'Headlights', '2000.00'),
(2, 'Industrial Illusions', 1000, 'Smokestack', '2000.00'),
(3, 'Industrial Illusions', 1000, 'Number Plate', '500.00'),
(4, 'Industrial Illusions', 1000, 'Smokebox Door', '1000.00'),
(5, 'Industrial Illusions', 1000, 'Handrail', '500.00'),
(6, 'Industrial Illusions', 1000, 'Marker Lights', '1000.00'),
(7, 'Industrial Illusions', 1000, 'Footboard Handrail', '4000.00'),
(8, 'Industrial Illusions', 1000, 'Uncoupling Lever', '5000.00'),
(9, 'Industrial Illusions', 1000, 'Footboards', '100.00'),
(10, 'Industrial Illusions', 1000, 'Poling Pocket', '200.00'),
(11, 'Industrial Illusions', 1000, 'Engine', '100000.00'),
(12, 'Industrial Illusions', 1000, 'Horn', '2000.00'),
(13, 'Millenium Worlds', 1001, 'Headlights', '2000.00'),
(14, 'Millenium Worlds', 1001, 'Smokestack', '2000.00'),
(15, 'Millenium Worlds', 1004, 'Number Plate', '500.00'),
(16, 'Millenium Worlds', 1006, 'Smokebox Door', '1000.00'),
(17, 'Millenium Worlds', 1006, 'Handrail', '500.00'),
(18, 'Millenium Worlds', 1006, 'Marker Lights', '1000.00'),
(19, 'Millenium Worlds', 1005, 'Footboard Handrail', '4000.00'),
(20, 'Millenium Worlds', 1004, 'Uncoupling Lever', '5000.00'),
(21, 'Industrial Illusions', 1005, 'Footboards', '100.00'),
(22, 'Industrial Illusions', 1005, 'Poling Pocket', '200.00'),
(23, 'Millenium Worlds', 1001, 'Engine', '100000.00'),
(24, 'Industrial Illusions', 1006, 'Horn', '2000.00');

-- --------------------------------------------------------

--
-- Table structure for table `repairservice`
--

CREATE TABLE `repairservice` (
  `RepairID` int(11) NOT NULL,
  `ESSN` int(9) DEFAULT NULL,
  `TrainID` int(11) DEFAULT NULL,
  `Cost` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `repairservice`
--

INSERT INTO `repairservice` (`RepairID`, `ESSN`, `TrainID`, `Cost`) VALUES
(1001, 100100400, 1001, 10000),
(1004, 100100400, 1004, 10000),
(1006, 100100400, 1006, 10000),
(1007, 100100400, 1007, 10000);

-- --------------------------------------------------------

--
-- Table structure for table `safetyinspector`
--

CREATE TABLE `safetyinspector` (
  `ESSN` int(9) NOT NULL,
  `InspectorCredentials` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `safetyinspector`
--

INSERT INTO `safetyinspector` (`ESSN`, `InspectorCredentials`) VALUES
(100100500, 'University of Calgary - Bachelor of Science');

-- --------------------------------------------------------

--
-- Table structure for table `shop`
--

CREATE TABLE `shop` (
  `BranchID` int(11) NOT NULL,
  `ShopName` varchar(50) NOT NULL,
  `Location` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `shop`
--

INSERT INTO `shop` (`BranchID`, `ShopName`, `Location`) VALUES
(5000, 'Train Emporium', '4553 Millenium Drive SE');

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
('Industrial Illusions', '555 Domino City NW'),
('Millenium Worlds', '50012 Millenium Drive SE');

-- --------------------------------------------------------

--
-- Table structure for table `train`
--

CREATE TABLE `train` (
  `TrainID` int(11) NOT NULL,
  `InspectorSSN` int(11) NOT NULL,
  `BranchID` int(11) NOT NULL,
  `LocomotiveType` varchar(100) NOT NULL,
  `last_inspected` date DEFAULT NULL,
  `inspection_status` varchar(255) DEFAULT NULL,
  `cost` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `train`
--

INSERT INTO `train` (`TrainID`, `InspectorSSN`, `BranchID`, `LocomotiveType`, `last_inspected`, `inspection_status`, `cost`) VALUES
(1000, 100100500, 5000, 'Locomotive', '2015-03-12', 'Good', 300000),
(1001, 100100500, 5000, 'Freight Car', '2014-01-25', 'Bad', 200000),
(1002, 100100500, 5000, 'Transit', '2019-01-25', 'Good', 300000),
(1003, 100100500, 5000, 'Locomotive', '2015-03-17', 'Good', 300000),
(1004, 100100500, 5000, 'Transit', '2011-01-05', 'Bad', 69345),
(1005, 100100500, 5000, 'Freight Car', '2019-01-10', 'Good', 400000),
(1006, 100100500, 5000, 'Freight Car', '2014-01-25', 'Bad', 200000),
(1007, 100100500, 5000, 'Freight Car', '2020-03-12', 'Bad', 100000);

-- --------------------------------------------------------

--
-- Table structure for table `trainengineer`
--

CREATE TABLE `trainengineer` (
  `ESSN` int(9) NOT NULL,
  `Credentials` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `trainengineer`
--

INSERT INTO `trainengineer` (`ESSN`, `Credentials`) VALUES
(100100400, 'University of Alberta - Bachelor of Engineering');

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
('AxelBrodie', 'AxelBrodie@gmail.com', '$2y$10$ArnC7qJib4hCHtp9Z43qN.IzUparqnZ4Ucqy6OaGGWE7XAxlt/O7q', 'TrainEngineer'),
('BobFreeman', 'BobFreeman@gmail.com', '$2y$10$GORXAKru4L1woeU5qs4l9u8NY1lsoAhLbjrRzUY5C9NsncSdnDgrW', 'Employee'),
('Elas Kas Dry', 'ElasDry@gmail.com', '$2y$10$ow..t.Ew9DrAnaF0z2FpceLpq73ffq/QS6NHFApxbovkcH6CQgoaq', 'Supervisor'),
('JimCook', 'JimCook@gmail.com', '$2y$10$0s8O28sPmM9nYc0nYu9.DOiMElyWdiGQyrarOtX0UJzpsKUMSzwze', 'SafetyInspector'),
('StrikeFree', 'StrikeFree@gmail.com', '$2y$10$2I3rF5S2Vz0kUNNgkbiL..LxVbS5vog0wBlO/Oh66MaCIW3k6h3Qi', 'CEO');

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
-- Indexes for table `government`
--
ALTER TABLE `government`
  ADD PRIMARY KEY (`GovBranch`,`ClientName`);

--
-- Indexes for table `parts`
--
ALTER TABLE `parts`
  ADD PRIMARY KEY (`PartNumber`),
  ADD KEY `SupplierName` (`SupplierName`),
  ADD KEY `TrainID` (`TrainID`);

--
-- Indexes for table `repairservice`
--
ALTER TABLE `repairservice`
  ADD PRIMARY KEY (`RepairID`),
  ADD KEY `fk_repairservice_essn` (`ESSN`),
  ADD KEY `fk_repairservice_trainid` (`TrainID`);

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
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`email`);

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
-- Constraints for table `parts`
--
ALTER TABLE `parts`
  ADD CONSTRAINT `parts_ibfk_1` FOREIGN KEY (`SupplierName`) REFERENCES `supplier` (`Name`),
  ADD CONSTRAINT `parts_ibfk_2` FOREIGN KEY (`TrainID`) REFERENCES `train` (`TrainID`);

--
-- Constraints for table `repairservice`
--
ALTER TABLE `repairservice`
  ADD CONSTRAINT `fk_repairservice_essn` FOREIGN KEY (`ESSN`) REFERENCES `employee` (`SSN`),
  ADD CONSTRAINT `fk_repairservice_trainid` FOREIGN KEY (`TrainID`) REFERENCES `train` (`TrainID`);

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
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
