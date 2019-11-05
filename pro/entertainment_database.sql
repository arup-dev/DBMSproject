-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 05, 2019 at 03:32 PM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `entertainment_database`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `get_ratings` ()  NO SQL
BEGIN
update product p SET p.rating=(select avg(c.rating) from critic c where p.pid=c.pid);
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `critic`
--

CREATE TABLE `critic` (
  `cname` varchar(30) NOT NULL,
  `pid` int(5) NOT NULL,
  `rating` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `critic`
--

INSERT INTO `critic` (`cname`, `pid`, `rating`) VALUES
('TOI', 100, 5),
('TOI', 200, 6),
('TOI', 300, 7);

--
-- Triggers `critic`
--
DELIMITER $$
CREATE TRIGGER `call_proc` AFTER INSERT ON `critic` FOR EACH ROW CALL get_ratings
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `cid` int(5) NOT NULL,
  `name` varchar(30) NOT NULL,
  `card_no` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`cid`, `name`, `card_no`) VALUES
(401, 'Arup', 1234),
(456, 'abhsieh', 35245);

-- --------------------------------------------------------

--
-- Table structure for table `game`
--

CREATE TABLE `game` (
  `gid` int(5) NOT NULL,
  `gname` varchar(30) NOT NULL,
  `genre` varchar(15) NOT NULL,
  `developer` varchar(15) NOT NULL,
  `platform` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `game`
--

INSERT INTO `game` (`gid`, `gname`, `genre`, `developer`, `platform`) VALUES
(200, 'Last of us', 'Action', 'ND', 'PS4'),
(201, 'Undeath', 'Horror', 'Finral', 'PC'),
(202, 'No man sky', 'Adventure', 'Solo', 'PC'),
(203, 'Dishonored', 'Action', 'FromSoft', 'PS4');

--
-- Triggers `game`
--
DELIMITER $$
CREATE TRIGGER `insert_game` BEFORE INSERT ON `game` FOR EACH ROW insert into product values(new.gid,new.gname,'GAME',null)
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `movie`
--

CREATE TABLE `movie` (
  `mid` int(5) NOT NULL,
  `mname` varchar(30) NOT NULL,
  `genre` varchar(15) NOT NULL,
  `director` varchar(30) NOT NULL,
  `length` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `movie`
--

INSERT INTO `movie` (`mid`, `mname`, `genre`, `director`, `length`) VALUES
(32, 'hello', 'horror', 'steve', 123),
(100, 'Final war', 'Action', 'Paul', 100),
(101, 'Final Desination', 'Horror', 'Norton', 110),
(102, 'Romeo', 'Romance', 'Saheks', 120),
(103, 'Trench', 'Horror', 'Saheks', 200);

--
-- Triggers `movie`
--
DELIMITER $$
CREATE TRIGGER `insert_movie` BEFORE INSERT ON `movie` FOR EACH ROW insert into product values(new.mid,new.mname,'MOVIE',null)
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `pid` int(5) NOT NULL,
  `pname` varchar(30) NOT NULL,
  `category` varchar(15) NOT NULL,
  `rating` int(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`pid`, `pname`, `category`, `rating`) VALUES
(32, 'hello', 'MOVIE', NULL),
(100, 'Final war', 'MOVIE', 5),
(101, 'Final Desination', 'MOVIE', NULL),
(102, 'Romeo', 'MOVIE', NULL),
(103, 'Trench', 'MOVIE', NULL),
(200, 'Last of us', 'GAME', 6),
(201, 'Undeath', 'GAME', NULL),
(202, 'No man sky', 'GAME', NULL),
(203, 'Dishonored', 'GAME', NULL),
(300, 'Han Solo', 'SONG', 7),
(301, 'Sereniy', 'SONG', NULL),
(302, 'Animals', 'SONG', NULL),
(303, 'Back down', 'SONG', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `product_owned`
--

CREATE TABLE `product_owned` (
  `cid` int(5) NOT NULL,
  `pid` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_owned`
--

INSERT INTO `product_owned` (`cid`, `pid`) VALUES
(456, 201);

-- --------------------------------------------------------

--
-- Table structure for table `song`
--

CREATE TABLE `song` (
  `sid` int(5) NOT NULL,
  `sname` varchar(30) NOT NULL,
  `genre` varchar(15) NOT NULL,
  `singer` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `song`
--

INSERT INTO `song` (`sid`, `sname`, `genre`, `singer`) VALUES
(300, 'Han Solo', 'Pop', 'Jason'),
(301, 'Sereniy', 'Pop', 'Lia'),
(302, 'Animals', 'EDM', 'Martin'),
(303, 'Back down', 'Jazz', '1D');

--
-- Triggers `song`
--
DELIMITER $$
CREATE TRIGGER `insert_song` BEFORE INSERT ON `song` FOR EACH ROW insert into product values(new.sid,new.sname,'SONG',null)
$$
DELIMITER ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `critic`
--
ALTER TABLE `critic`
  ADD PRIMARY KEY (`pid`,`cname`) USING BTREE;

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`cid`);

--
-- Indexes for table `game`
--
ALTER TABLE `game`
  ADD PRIMARY KEY (`gid`);

--
-- Indexes for table `movie`
--
ALTER TABLE `movie`
  ADD PRIMARY KEY (`mid`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`pid`);

--
-- Indexes for table `product_owned`
--
ALTER TABLE `product_owned`
  ADD PRIMARY KEY (`cid`,`pid`),
  ADD KEY `product_owned_ibfk_2` (`pid`);

--
-- Indexes for table `song`
--
ALTER TABLE `song`
  ADD PRIMARY KEY (`sid`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `critic`
--
ALTER TABLE `critic`
  ADD CONSTRAINT `critic_ibfk_1` FOREIGN KEY (`pid`) REFERENCES `product` (`pid`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `game`
--
ALTER TABLE `game`
  ADD CONSTRAINT `game_ibfk_1` FOREIGN KEY (`gid`) REFERENCES `product` (`pid`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `movie`
--
ALTER TABLE `movie`
  ADD CONSTRAINT `movie_ibfk_1` FOREIGN KEY (`mid`) REFERENCES `product` (`pid`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `product_owned`
--
ALTER TABLE `product_owned`
  ADD CONSTRAINT `product_owned_ibfk_1` FOREIGN KEY (`cid`) REFERENCES `customer` (`cid`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `product_owned_ibfk_2` FOREIGN KEY (`pid`) REFERENCES `product` (`pid`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `song`
--
ALTER TABLE `song`
  ADD CONSTRAINT `song_ibfk_1` FOREIGN KEY (`sid`) REFERENCES `product` (`pid`) ON DELETE CASCADE ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
