-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 22, 2023 at 04:37 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_ormawa`
--

-- --------------------------------------------------------

--
-- Table structure for table `developer`
--

CREATE TABLE `developer` (
  `developer_id` int(11) NOT NULL,
  `developer_nama` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `developer`
--

INSERT INTO `developer` (`developer_id`, `developer_nama`) VALUES
(18, 'Rockstarr'),
(19, 'Bethesda'),
(20, 'Nintendo'),
(21, 'Ubisoft'),
(22, 'www'),
(23, 'zzzzzzwwwww');

--
-- Triggers `developer`
--
DELIMITER $$
CREATE TRIGGER `delete_game2` AFTER DELETE ON `developer` FOR EACH ROW BEGIN
    DELETE FROM game WHERE developer_id = OLD.developer_id;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `engine`
--

CREATE TABLE `engine` (
  `engine_id` int(11) NOT NULL,
  `engine_nama` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `engine`
--

INSERT INTO `engine` (`engine_id`, `engine_nama`) VALUES
(13, 'Rockstar Advanced Game Engine'),
(14, 'Creation Engine'),
(15, 'Havok physics engine'),
(16, 'Anvil');

--
-- Triggers `engine`
--
DELIMITER $$
CREATE TRIGGER `delete_game` AFTER DELETE ON `engine` FOR EACH ROW BEGIN
    DELETE FROM game WHERE engine_id = OLD.engine_id;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `game`
--

CREATE TABLE `game` (
  `game_id` int(11) NOT NULL,
  `game_foto` varchar(255) DEFAULT NULL,
  `game_genre` varchar(10) DEFAULT NULL,
  `game_nama` varchar(100) DEFAULT NULL,
  `game_release` int(2) DEFAULT NULL,
  `developer_id` int(11) DEFAULT NULL,
  `engine_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `game`
--

INSERT INTO `game` (`game_id`, `game_foto`, `game_genre`, `game_nama`, `game_release`, `developer_id`, `engine_id`) VALUES
(19, 'rdr2.jpg', 'Western', 'Red Dead Redemption 2', 2018, 18, 13),
(20, 'skyrim-logo.jpg', 'Action RPG', 'Skyrim', 2011, 19, 14),
(21, 'zelda.png', 'Action-Adv', 'Zelda ', 2017, 20, 15),
(22, 'gta5.jpeg', 'Action-Adv', 'Grand Theft Auto V ', 2013, 18, 13),
(26, 'ac.jpg', 'wdwad', 'zzzzzzzzzzzzz', 2222, 22, 15);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `developer`
--
ALTER TABLE `developer`
  ADD PRIMARY KEY (`developer_id`);

--
-- Indexes for table `engine`
--
ALTER TABLE `engine`
  ADD PRIMARY KEY (`engine_id`);

--
-- Indexes for table `game`
--
ALTER TABLE `game`
  ADD PRIMARY KEY (`game_id`),
  ADD KEY `fk_jabatan` (`engine_id`),
  ADD KEY `fk_divisi` (`developer_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `developer`
--
ALTER TABLE `developer`
  MODIFY `developer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `engine`
--
ALTER TABLE `engine`
  MODIFY `engine_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `game`
--
ALTER TABLE `game`
  MODIFY `game_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `game`
--
ALTER TABLE `game`
  ADD CONSTRAINT `fk_jabatan` FOREIGN KEY (`engine_id`) REFERENCES `engine` (`engine_id`),
  ADD CONSTRAINT `game_ibfk_1` FOREIGN KEY (`developer_id`) REFERENCES `developer` (`developer_id`),
  ADD CONSTRAINT `game_ibfk_2` FOREIGN KEY (`engine_id`) REFERENCES `engine` (`engine_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
