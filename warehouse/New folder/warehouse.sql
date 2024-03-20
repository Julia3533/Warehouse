-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 17, 2024 at 07:12 PM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `warehouse`
--

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `ItemID` int(11) NOT NULL,
  `itemName` varchar(255) NOT NULL,
  `ItemGroup` enum('Loose','Light','Heavy','Tools','Materials') NOT NULL,
  `UnitOfMeasurement` enum('SI','Imperial') NOT NULL,
  `Quantity` int(11) NOT NULL,
  `PriceWithoutVAT` decimal(10,2) NOT NULL,
  `Status` varchar(255) NOT NULL,
  `StorageLocation` varchar(255) DEFAULT NULL,
  `ContactPerson` text DEFAULT NULL,
  `Photo` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`ItemID`, `itemName`, `ItemGroup`, `UnitOfMeasurement`, `Quantity`, `PriceWithoutVAT`, `Status`, `StorageLocation`, `ContactPerson`, `Photo`) VALUES
(2, 'Hammer', 'Light', 'Imperial', 20, '200.00', 'Availible', 'Storage B', 'Jane Smith', 'photo2.jpg'),
(3, 'Wrench', 'Light', 'Imperial', 15, '150.00', 'Damaged', 'Storage C', 'David Johnson', 'photo3.jpg'),
(4, 'Drill', 'Light', 'SI', 8, '80.00', 'Available', 'Storage Daaa', 'Michael Brown', 'photo4.jpg'),
(5, 'Saw', 'Light', 'Imperial', 5, '120.00', 'In Use', 'Storage E', 'Sophia Johnson', 'photo5.jpg'),
(6, 'Pliers', 'Heavy', 'SI', 7, '70.00', 'Damaged', 'Storage F', 'Oliver Smith', 'photo6.jpg'),
(7, 'Tape Measureaaaaa', 'Heavy', 'SI', 7, '50.04', 'Available11aaaaas', 'Storage Gaaaa', 'Emma Wilsonsadsadasa', 'photo7.jpga'),
(8, 'Utility Knife', 'Heavy', 'Imperial', 9, '90.00', 'In Use', 'Storage H', 'James Taylor', 'photo8.jpg'),
(9, 'Level', 'Heavy', 'SI', 6, '60.00', 'Damaged', 'Storage I', 'Liam Martinez', 'photo9.jpg'),
(10, 'Flashlight', 'Heavy', 'SI', 14, '140.00', 'Available', 'Storage J', 'Ella Anderson', 'photo10.jpg'),
(11, 'Screwdriver Set', 'Tools', 'Imperial', 11, '110.00', 'In Use', 'Storage K', 'William Thomas', 'photo11.jpg'),
(12, 'Socket Set', 'Tools', 'SI', 13, '130.00', 'Damaged', 'Storage L', 'Ava White', 'photo12.jpg'),
(13, 'Chisel Set', 'Tools', 'SI', 17, '170.00', 'Available', 'Storage M', 'Noah Brown', 'photo13.jpg'),
(14, 'Hex Key Set', 'Tools', 'SI', 10, '10.00', 'Availible', 'My Warehouse', 'Julia Strelczuk', '100'),
(15, 'Adjustable Wrench', 'Tools', 'SI', 10, '10.00', 'Availible', 'My Warehouse', 'Julia Strelczuk', '100'),
(16, 'Circular Saw', 'Materials', 'SI', 10, '10.00', 'Availible', 'My Warehouse', 'Julia Strelczuk', '100'),
(17, 'Angle Grinder', 'Materials', 'SI', 10, '10.00', 'Availible', 'My Warehouse', 'Julia Strelczuk', '100'),
(18, 'Power Drill', 'Materials', 'SI', 10, '10.00', 'Availible', 'My Warehouse', 'Julia Strelczuk', '100'),
(19, 'Jigsaw', 'Materials', 'SI', 10, '10.00', 'Availible', 'My Warehouse', 'Julia Strelczuk', '100'),
(20, 'Impact Driver', 'Materials', 'SI', 10, '10.00', 'Availible', 'My Warehouse', 'Julia Strelczuk', '100'),
(21, 'Nail Gun', 'Loose', 'SI', 10, '10.00', 'Availible', 'My Warehouse', 'Julia Strelczuk', '100'),
(22, 'Air Compressor', 'Loose', 'SI', 10, '10.00', 'Availible', 'My Warehouse', 'Julia Strelczuk', '100'),
(23, 'Heat Gun', 'Loose', 'SI', 10, '10.00', 'Availible', 'My Warehouse', 'Julia Strelczuk', '100'),
(24, 'Sander', 'Loose', 'SI', 10, '10.00', 'Availible', 'My Warehouse', 'Julia Strelczuk', '100'),
(25, 'Staple Gun', 'Loose', 'SI', 10, '40.00', 'Availible', 'My warehouse', 'Julia Strelczuk', 'photo222.jpg'),
(26, 'Concrete Mixer', 'Materials', 'SI', 13, '50.00', 'Availible asdaaa', 'My warehousesadasdasasdaaaaaaa', 'Julia Strelczuk 11dsadasa', 'jan.pngaaa'),
(27, 'Soil Compactor Mega Pro 2000', 'Materials', 'SI', 10, '40.00', 'Availible in you local DIY store', 'My warehouse 12', 'Julia Strelczuk', 'photo222.jpg'),
(28, 'Surveying Level', 'Materials', 'SI', 10, '40.00', 'Availible', 'My warehouse', 'Julia Strelczuk', 'photo222.jpg'),
(29, 'Steel Ruler', 'Materials', 'SI', 10, '40.00', 'Availible', 'My warehouse', 'Julia Strelczuk', 'photo222.jpg'),
(31, 'Cement Testing Apparatus', 'Tools', 'SI', 10, '10.00', 'Availible', 'Warehouse 111', 'Jan Kedrak', 'photo222222.jpg'),
(32, 'Aggregate Impact Tester', 'Tools', 'SI', 10, '10.00', 'Availible', 'Warehouse 111', 'Jan Kedrak', 'photo222222.jpg'),
(34, 'Compression Testing Machine', 'Tools', 'SI', 10, '40.00', 'Availible', 'My warehouse', 'Julia Strelczuk', 'photo222.jpg'),
(35, 'Los Angeles Abrasion Testing Machine', 'Tools', 'SI', 10, '40.00', 'Availible', 'My warehouse', 'Julia Strelczuk', 'photo222.jpg'),
(36, 'Vicat Apparatus', 'Materials', 'SI', 10, '40.00', 'Availible', 'My warehouse', 'Julia Strelczuk', 'photo222.jpg'),
(37, 'Proctor Compaction Test Set', 'Materials', 'SI', 10, '40.00', 'Availible', 'My warehouse', 'Julia Strelczuk', 'photo222.jpg'),
(38, 'Automatic Compactor', 'Materials', 'SI', 11, '10.00', 'Availible aaaaa', 'ka', 'aka', 'skdask.jpg'),
(39, 'Cone Penetrometer', 'Materials', 'SI', 10, '10.00', 'Availible', 'ka', 'aka', 'skdask.jpg'),
(41, 'Concrete Permeability Apparatus', 'Tools', 'SI', 10, '10.00', 'Availible', 'Warehouse 1112', 'Jan Kedrak', 'photo222222.jpg'),
(42, 'Concrete Vibrator', 'Tools', 'SI', 10, '10.00', 'Availible', 'Warehouse 111', 'Jan Kedrak', 'photo222222.jpg'),
(43, 'Marshall Stability Test Apparatus', 'Tools', 'SI', 10, '10.00', 'Availible', 'Warehouse 111', 'Jan Kedrak', 'photo222222.jpg'),
(44, 'Ductility Testing Machine', 'Tools', 'SI', 10, '10.00', 'Availible', 'Warehouse 111', 'Jan Kedrak', 'photo222222.jpg'),
(45, 'Universal Testing Machine', 'Tools', 'SI', 10, '10.00', 'Availible', 'Warehouse 111', 'Jan Kedrak', 'photo222222.jpg'),
(46, 'Brinell Hardness Testing Machine', 'Tools', 'SI', 50, '100.00', 'Availible', 'asda', 'asda', 'asdas'),
(47, 'Vickers Hardness Tester', 'Tools', 'SI', 100, '100.00', 'Availible', 'asda', 'asda', 'asdas'),
(48, 'Rockwell Hardness Tester', 'Tools', 'Imperial', 10, '24.50', 'Availible', 'My house', 'kmsak', 'mskmdak.png');

-- --------------------------------------------------------

--
-- Table structure for table `requests`
--

CREATE TABLE `requests` (
  `RequestID` int(11) NOT NULL,
  `EmployeeName` varchar(255) NOT NULL,
  `ItemID` int(11) DEFAULT NULL,
  `UnitOfMeasurement` enum('SI','Imperial') NOT NULL,
  `Quantity` int(11) NOT NULL,
  `PriceWithoutVAT` decimal(10,2) NOT NULL,
  `Comment` text DEFAULT NULL,
  `Status` enum('New','Approved','Rejected') DEFAULT 'New'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `requests`
--

INSERT INTO `requests` (`RequestID`, `EmployeeName`, `ItemID`, `UnitOfMeasurement`, `Quantity`, `PriceWithoutVAT`, `Comment`, `Status`) VALUES
(1, 'John Doe', 2, 'SI', 10, '100.00', 'asdasda', 'Approved'),
(2, 'Jane Smith', 3, 'SI', 15, '150.00', 'Request comment 2', 'Approved'),
(3, 'David Johnson', 9, 'Imperial', 20, '200.00', 'I was lazy one', 'Rejected'),
(4, 'Alice Brown', 9, 'SI', 8, '80.00', '', 'Rejected'),
(5, 'Bob Johnson', 3, 'Imperial', 12, '120.00', 'Request comment 5', 'Approved'),
(6, 'Eve White', 13, 'SI', 7, '70.00', 'Request comment 6', 'New'),
(7, 'Michael Davis', 3, 'SI', 5, '50.00', 'Request comment 7', 'New'),
(8, 'Sophia Wilson', 13, 'SI', 9, '90.00', 'Request comment 8', 'Rejected'),
(9, 'Oliver Taylor', 7, 'Imperial', 6, '60.00', 'Request comment 9', 'New'),
(10, 'Emma Martinez', 8, 'SI', 14, '140.00', 'asdasa', 'Rejected'),
(11, 'William Anderson', 6, 'SI', 11, '110.00', 'asda', 'Rejected'),
(12, 'Sophie Thomas', 4, 'Imperial', 13, '130.00', 'eqweqwe', 'Rejected'),
(13, 'Noah White', 13, 'SI', 17, '170.00', 'sdadasda', 'Rejected'),
(14, 'Liam Brown', 3, 'SI', 8, '80.00', 'Request comment 14', 'Approved'),
(15, 'Ava Johnson', 13, 'Imperial', 12, '120.00', 'Request comment 15', 'New'),
(16, 'Mia White', 5, 'SI', 7, '70.00', 'sada', 'Approved'),
(17, 'James Davis', 12, 'SI', 5, '50.00', 'asdasd', 'Rejected'),
(18, 'Charlotte Wilson', 3, 'SI', 9, '90.00', 'Request comment 18', 'Approved'),
(19, 'Lucas Taylor', 5, 'Imperial', 6, '60.00', 'Request comment 19', 'New'),
(20, 'Harper Martinez', 3, 'SI', 14, '140.00', 'Request comment 20', 'New'),
(21, 'Evelyn Anderson', 12, 'SI', 11, '110.00', 'Request comment 21', 'Rejected'),
(22, 'Alexander Thomas', 13, 'Imperial', 13, '130.00', 'Request comment 22', 'New'),
(23, 'Logan White', 3, 'SI', 17, '170.00', 'Request comment 23', 'New'),
(24, 'Amelia Brown', 13, 'SI', 8, '80.00', 'Request comment 24', 'Approved'),
(25, 'Benjamin Johnson', 5, 'Imperial', 12, '120.00', 'Request comment 25', 'New'),
(26, 'Emily White', NULL, 'SI', 7, '70.00', 'Request comment 26', 'New'),
(27, 'Michael Davis', NULL, 'SI', 5, '50.00', 'Request comment 27', 'New'),
(28, 'Isabella Wilson', NULL, 'SI', 9, '90.00', 'Request comment 28', 'Approved'),
(29, 'William Taylor', NULL, 'Imperial', 6, '60.00', 'Request comment 29', 'New'),
(30, 'Ethan Martinez', NULL, 'SI', 14, '140.00', 'Request comment 30', 'New'),
(31, 'Olivia Anderson', NULL, 'SI', 11, '110.00', 'Request comment 31', 'Rejected'),
(32, 'Sophia Thomas', NULL, 'Imperial', 13, '130.00', 'Request comment 32', 'New'),
(34, 'Jan Rogers', 9, 'SI', 10, '10.20', 'smkdmakmd', 'New'),
(35, 'Jan Rogers', 2, 'SI', 10, '10.20', 'smkdmakmd', 'New'),
(36, 'asdasda', 2, 'SI', 11, '11.00', '11', 'New'),
(37, 'Jan Kowalski', 46, 'Imperial', 50, '20.00', 'I was lazy one', 'Approved'),
(38, 'Jan Rogers', 21, 'SI', 1, '100.00', '11', 'New'),
(39, 'Jan Rogers', 21, 'SI', 1, '100.00', '11', 'New');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`ItemID`);

--
-- Indexes for table `requests`
--
ALTER TABLE `requests`
  ADD PRIMARY KEY (`RequestID`),
  ADD KEY `ItemID` (`ItemID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `ItemID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `requests`
--
ALTER TABLE `requests`
  MODIFY `RequestID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `requests`
--
ALTER TABLE `requests`
  ADD CONSTRAINT `requests_ibfk_1` FOREIGN KEY (`ItemID`) REFERENCES `items` (`ItemID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
