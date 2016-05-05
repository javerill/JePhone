-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 09, 2015 at 09:01 AM
-- Server version: 5.5.27
-- PHP Version: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `belihpdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `mscategory`
--

CREATE TABLE IF NOT EXISTS `mscategory` (
  `CategoryID` int(11) NOT NULL AUTO_INCREMENT,
  `CategoryName` varchar(100) NOT NULL,
  PRIMARY KEY (`CategoryID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `mscategory`
--

INSERT INTO `mscategory` (`CategoryID`, `CategoryName`) VALUES
(2, 'Apple'),
(3, 'Blackberry'),
(4, 'Samsung'),
(5, 'Nokia'),
(6, 'Sony'),
(7, 'Asus'),
(8, 'Motorola');

-- --------------------------------------------------------

--
-- Table structure for table `msmember`
--

CREATE TABLE IF NOT EXISTS `msmember` (
  `MemberID` int(11) NOT NULL AUTO_INCREMENT,
  `Username` varchar(100) NOT NULL,
  `Password` varchar(100) NOT NULL,
  `Fullname` varchar(100) NOT NULL,
  `Address` varchar(200) NOT NULL,
  `Gender` varchar(50) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Phone` varchar(50) NOT NULL,
  `Image` varchar(100) NOT NULL,
  `Role` varchar(100) NOT NULL DEFAULT 'member',
  `Status` varchar(100) NOT NULL DEFAULT 'none',
  PRIMARY KEY (`MemberID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=34 ;

--
-- Dumping data for table `msmember`
--

INSERT INTO `msmember` (`MemberID`, `Username`, `Password`, `Fullname`, `Address`, `Gender`, `Email`, `Phone`, `Image`, `Role`, `Status`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'admin admin', 'Street+Bina+Nusantara', 'male', 'admin@belihp.com', '08999123123', 'UserImage/20150102120128.png', 'admin', 'none'),
(8, 'member', 'aa08769cdcb26674c6706093503ff0a3', 'Oki Setiawan', 'Street rahasia xxxx', 'male', 'oki@gmail.com', '08999999999', 'UserImage/member20150103195417.jpg', 'member', 'none'),
(22, 'member2', 'aa08769cdcb26674c6706093503ff0a3', 'Darwin Cahyadi coi', 'Street Cahyadi', 'female', 'darwin@man.com', '089909999', 'UserImage/Default.jpg', 'member', 'banned'),
(24, 'memberBaru', '202cb962ac59075b964b07152d234b70', 'Nico baru', 'Street Tanah Abanag 12 no. 48', 'male', 'nico@zzz.com', '08812121212', 'UserImage/memberBaru20150102040611.jpg', 'member', 'none'),
(25, 'member3', 'aa08769cdcb26674c6706093503ff0a3', 'allen wijayantono', 'Street gembira', 'female', 'ale@xxx.com', '123123', 'UserImage/member320150104162108.gif', 'member', 'none'),
(26, 'a', '0cc175b9c0f1b6a831c399e269772661', 'a', 'Street a', 'male', 'a@a.com', '1', 'UserImage/Default.jpg', 'member', 'none'),
(27, 'testing1', '6b7330782b2feb4924020cc4a57782a9', 'testing', 'Street test', 'male', 'testing@gmail.com', '0899995656656', 'UserImage/Default.jpg', 'member', 'none'),
(28, 'testing2', 'a119e534072584a0ea88cdea4664aecd', 'testing', 'Street test2', 'male', 'testing2@gmail.com', '0899995656656', 'UserImage/Default.jpg', 'member', 'none'),
(29, 'testing3', '5fe43373c2db4deb851f3290080621f5', 'testing 3', 'Street test3', 'male', 'testing2@gmail.com', '0899995656656', 'UserImage/Default.jpg', 'member', 'none'),
(30, 'testing4', 'a5bd8e2b7e55c23e6bff78fc18e00778', 'testing 4', 'Street test4', 'male', 'testing2@gmail.com', '0899995656656', 'UserImage/testing420150109035347.jpg', 'member', 'banned'),
(31, 'testing5', '84273c002a8901bc770518d7c98c1d5b', 'testing 5', 'Street testing5', 'female', 'testing2@gmail.com', '0899995656656', 'UserImage/testing520150109035521.png', 'member', 'none'),
(33, 'allen', '7815696ecbf1c96e6894b779456d330e', 'allen wijaya', 'Street 1', 'male', 'allen.wijaya@lala.com', '0899995656656', 'UserImage/allen20150109072121.jpg', 'member', 'none');

-- --------------------------------------------------------

--
-- Table structure for table `msproduct`
--

CREATE TABLE IF NOT EXISTS `msproduct` (
  `ProductID` int(11) NOT NULL AUTO_INCREMENT,
  `CategoryID` int(11) NOT NULL,
  `Name` varchar(100) NOT NULL,
  `Stock` int(11) NOT NULL,
  `Price` int(11) NOT NULL,
  `Description` text NOT NULL,
  `Image` varchar(100) NOT NULL,
  PRIMARY KEY (`ProductID`),
  KEY `CategoryID` (`CategoryID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=30 ;

--
-- Dumping data for table `msproduct`
--

INSERT INTO `msproduct` (`ProductID`, `CategoryID`, `Name`, `Stock`, `Price`, `Description`, `Image`) VALUES
(3, 2, 'Apple iPhone 6 Plus (128GB)', 97, 18000000, '5.5 inches and thinnest, \r\nBetter display1080 x 1920 pixels resolution, \r\nBuilt on 64-bit desktop-class architecture, A8 chip delivers more power.', 'ProductImage/Apple iPhone 6 Plus (128GB)20141230165843.jpg'),
(4, 2, 'Apple iPhone 6 Plus (64GB)', 10, 17000000, '5.5 inches and thinnest, \r\nBetter display1080 x 1920 pixels resolution, \r\nBuilt on 64-bit desktop-class architecture, A8 chip delivers more power.', 'ProductImage/Apple iPhone 6 Plus (64GB)20141230170000.jpg'),
(5, 2, 'Apple iPhone 6 Plus (32GB)', 200, 15000000, '5.5 inches and thinnest, \r\nBetter display1080 x 1920 pixels resolution, \r\nBuilt on 64-bit desktop-class architecture, A8 chip delivers more power.', 'ProductImage/Apple iPhone 6 Plus (32GB)20141230170051.jpg'),
(6, 2, 'Apple iPhone 6 (128GB)', 1000, 15000000, '4.7 inches and thinnest, \r\nBetter display 750 x 1334 pixels resolution, \r\nBuilt on 64-bit desktop-class architecture, A8 chip delivers more power.', 'ProductImage/Apple iPhone 6 (128GB)20141230170139.jpg'),
(7, 2, 'Apple iPhone 6 (64GB)', 10005, 14000000, '4.7 inches and thinnest, \r\nBetter display 750 x 1334 pixels resolution, \r\nBuilt on 64-bit desktop-class architecture, A8 chip delivers more power.', 'ProductImage/Apple iPhone 6 (64GB)20141230170235.jpg'),
(8, 2, 'Apple iPhone 6 (32GB)', 5, 13000000, '4.7 inches and thinnest, \r\nBetter display 750 x 1334 pixels resolution, \r\nBuilt on 64-bit desktop-class architecture, A8 chip delivers more power.', 'ProductImage/Apple iPhone 6 (32GB)20141230170254.jpg'),
(9, 2, 'Apple iPhone 6 (16GB)', 0, 12000000, '4.7 inches and thinnest, \r\nBetter display 750 x 1334 pixels resolution, \r\nBuilt on 64-bit desktop-class architecture, A8 chip delivers more power.', 'ProductImage/Apple iPhone 6 (16GB)20141230170306.jpg'),
(10, 2, 'Apple iPhone 6 Plus (16GB)', 50, 14000000, '5.5 inches and thinnest, \r\nBetter display1080 x 1920 pixels resolution, \r\nBuilt on 64-bit desktop-class architecture, A8 chip delivers more power.', 'ProductImage/Apple iPhone 6 Plus (16GB)20141230170444.jpg'),
(11, 2, 'Apple iPad Mini 3 Wifi + Cellular (128GB)', 100, 10000000, '7.9-inch (diagonal) LED-backlit Multi-Touch display with IPS technology, \r\nA7 chip with 64-bit architecture, \r\nFingerprint identity sensor built into the Home button.', 'ProductImage/Apple iPad Mini 3 Wifi + Cellular (128GB)20141230171006.jpg'),
(12, 2, 'Apple iPad Mini 3 Wifi + Cellular (64GB)', 75, 9000000, '7.9-inch (diagonal) LED-backlit Multi-Touch display with IPS technology, \r\nA7 chip with 64-bit architecture, \r\nFingerprint identity sensor built into the Home button.', 'ProductImage/Apple iPad Mini 3 Wifi + Cellular (64GB)20141230171031.jpg'),
(13, 2, 'Apple iPad Mini 3 Wifi + Cellular (32GB)', 34, 8000000, '7.9-inch (diagonal) LED-backlit Multi-Touch display with IPS technology, \r\nA7 chip with 64-bit architecture, \r\nFingerprint identity sensor built into the Home button.', 'ProductImage/Apple iPad Mini 3 Wifi + Cellular (32GB)20141230171042.jpg'),
(14, 2, 'Apple iPad Mini 3 Wifi + Cellular (16GB)', 34, 7000000, '7.9-inch (diagonal) LED-backlit Multi-Touch display with IPS technology, \r\nA7 chip with 64-bit architecture, \r\nFingerprint identity sensor built into the Home button.', 'ProductImage/Apple iPad Mini 3 Wifi + Cellular (16GB)20141230171050.jpg'),
(15, 2, 'Apple iPad Mini 3 Wifi (128GB)', 10, 8000000, '7.9-inch (diagonal) LED-backlit Multi-Touch display with IPS technology, \r\nA7 chip with 64-bit architecture, \r\nFingerprint identity sensor built into the Home button.', 'ProductImage/Apple iPad Mini 3 Wifi (128GB)20141230171152.jpg'),
(16, 2, 'Apple iPad Mini 3 Wifi (64GB)', 10, 7000000, '7.9-inch (diagonal) LED-backlit Multi-Touch display with IPS technology, \r\nA7 chip with 64-bit architecture, \r\nFingerprint identity sensor built into the Home button.', 'ProductImage/Apple iPad Mini 3 Wifi (64GB)20141230171200.jpg'),
(17, 2, 'Apple iPad Mini 3 Wifi (32GB)', 3, 6000000, '7.9-inch (diagonal) LED-backlit Multi-Touch display with IPS technology, \r\nA7 chip with 64-bit architecture, \r\nFingerprint identity sensor built into the Home button.', 'ProductImage/Apple iPad Mini 3 Wifi (32GB)20141230171208.jpg'),
(18, 2, 'Apple iPad Mini 3 Wifi (16GB)', 28, 5000000, '7.9-inch (diagonal) LED-backlit Multi-Touch display with IPS technology, \r\nA7 chip with 64-bit architecture, \r\nFingerprint identity sensor built into the Home button.', 'ProductImage/Apple iPad Mini 3 Wifi (16GB)20141230171216.jpg'),
(19, 2, 'Apple iPad Air 2 Wifi + Cellular (128GB)', 100, 12000000, 'thin and light, 9.7 Inch Display, \r\nA8X, better CPU and graphics performance than its predecessor, \r\nWi-Fi on iPad Air 2 is fast — more than twice as fast as the previous generation.', 'ProductImage/Apple iPad Air 2 Wifi + Cellular (128GB)20141230171309.jpg'),
(20, 2, 'Apple iPad Air 2 Wifi + Cellular (64GB)', 97, 11000000, 'thin and light, 9.7 Inch Display, \r\nA8X, better CPU and graphics performance than its predecessor, \r\nWi-Fi on iPad Air 2 is fast — more than twice as fast as the previous generation.', 'ProductImage/Apple iPad Air 2 Wifi + Cellular (64GB)20141230171315.jpg'),
(21, 2, 'Apple iPad Air 2 Wifi + Cellular (32GB)', 98, 10000000, 'thin and light, 9.7 Inch Display, \r\nA8X, better CPU and graphics performance than its predecessor, \r\nWi-Fi on iPad Air 2 is fast — more than twice as fast as the previous generation.', 'ProductImage/Apple iPad Air 2 Wifi + Cellular (32GB)20141230171322.jpg'),
(22, 2, 'Apple iPad Air 2 Wifi + Cellular (16GB)', 97, 9000000, 'thin and light, 9.7 Inch Display, \r\nA8X, better CPU and graphics performance than its predecessor, \r\nWi-Fi on iPad Air 2 is fast — more than twice as fast as the previous generation.', 'ProductImage/Apple iPad Air 2 Wifi + Cellular (16GB)20141230171328.jpg'),
(23, 2, 'Apple iPad Air 2 Wifi (128GB)', 95, 12000000, 'thin and light, 9.7 Inch Display, \r\nA8X, better CPU and graphics performance than its predecessor, \r\nWi-Fi on iPad Air 2 is fast — more than twice as fast as the previous generation.', 'ProductImage/Apple iPad Air 2 Wifi (128GB)20141230171640.jpg'),
(24, 2, 'Apple iPad Air 2 Wifi (64GB)', 0, 11000000, 'thin and light, 9.7 Inch Display, \r\nA8X, better CPU and graphics performance than its predecessor, \r\nWi-Fi on iPad Air 2 is fast — more than twice as fast as the previous generation.', 'ProductImage/Apple iPad Air 2 Wifi (64GB)20141230171648.jpg'),
(25, 2, 'Apple iPad Air 2 Wifi (32GB)', 96, 10000000, 'thin and light, 9.7 Inch Display, \r\nA8X, better CPU and graphics performance than its predecessor, \r\nWi-Fi on iPad Air 2 is fast — more than twice as fast as the previous generation.', 'ProductImage/Apple iPad Air 2 Wifi (32GB)20141230171656.jpg'),
(26, 2, 'Apple iPad Air 2 Wifi (16GB)', 97, 9000000, 'thin and light, 9.7 Inch Display, \r\nA8X, better CPU and graphics performance than its predecessor, \r\nWi-Fi on iPad Air 2 is fast — more than twice as fast as the previous generation.', 'ProductImage/Apple iPad Air 2 Wifi (16GB)20141230171703.jpg'),
(27, 3, 'Blackberry Passport', 0, 20000000, 'Large QWERTY Device with 4.5” display, \r\nHybrid (Full Touch & Capacitive QWERTY), \r\nCapacitive 3-row keypad, a new way of navigating, \r\nLarger battery (3450 mAh) to last at least a day of usage.', 'ProductImage/Blackberry Passport20141230171834.jpg'),
(28, 3, 'Blackberry 9720', 1, 2000000, 'The classic BlackBerry® Keyboard has been re-engineered and elegantly designed, \r\nBBM Shortcut Key and BBM Voice, \r\nMulticast feature.', 'ProductImage/Blackberry 972020141230172053.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `trcomment`
--

CREATE TABLE IF NOT EXISTS `trcomment` (
  `CommentID` int(11) NOT NULL AUTO_INCREMENT,
  `ProductID` int(11) NOT NULL,
  `MemberID` int(11) NOT NULL,
  `Content` varchar(200) NOT NULL,
  `CommentDate` date NOT NULL,
  PRIMARY KEY (`CommentID`),
  KEY `ProductID` (`ProductID`,`MemberID`),
  KEY `MemberID` (`MemberID`),
  KEY `ProductID_2` (`ProductID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=31 ;

--
-- Dumping data for table `trcomment`
--

INSERT INTO `trcomment` (`CommentID`, `ProductID`, `MemberID`, `Content`, `CommentDate`) VALUES
(2, 24, 8, 'fffffff', '2015-01-01'),
(6, 28, 8, 'Hello this is a test test comment and this comment is particularly very long and it goes on and on and on.Hello this is a test test comment and this comment is particularly very long and it goes on an', '2015-01-01'),
(9, 27, 8, 'barang bagus banget', '2015-01-01'),
(11, 28, 8, 'sama sama kakak', '2015-01-02'),
(12, 27, 24, 'masa?', '2015-01-02'),
(13, 27, 8, 'testing', '2015-01-02'),
(14, 27, 8, 'test', '2015-01-02'),
(15, 27, 8, 'test2', '2015-01-02'),
(18, 28, 1, 'update terbaru', '2015-01-02'),
(20, 28, 1, 'testing 4', '2015-01-02'),
(23, 24, 1, 'testing', '2015-01-02'),
(24, 28, 1, 'testing', '2015-01-04'),
(25, 28, 8, 'testing baru', '2015-01-04'),
(27, 28, 25, 'testing add updte', '2015-01-04'),
(28, 28, 31, 'testing5 update', '2015-01-09'),
(29, 28, 33, 'produk jelek', '2015-01-09'),
(30, 28, 1, 'test', '2015-01-09');

-- --------------------------------------------------------

--
-- Table structure for table `trsalesdetail`
--

CREATE TABLE IF NOT EXISTS `trsalesdetail` (
  `SalesID` int(11) NOT NULL,
  `ProductID` int(11) NOT NULL,
  `Quantity` int(11) NOT NULL,
  PRIMARY KEY (`SalesID`,`ProductID`),
  KEY `SalesID` (`SalesID`,`ProductID`),
  KEY `ProductID` (`ProductID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `trsalesdetail`
--

INSERT INTO `trsalesdetail` (`SalesID`, `ProductID`, `Quantity`) VALUES
(1, 27, 40),
(1, 28, 14),
(2, 27, 9),
(2, 28, 6),
(3, 24, 10),
(4, 25, 4),
(4, 26, 3),
(4, 28, 2),
(5, 24, 90),
(5, 27, 1),
(6, 18, 2),
(6, 23, 5),
(7, 21, 2),
(7, 22, 3),
(8, 3, 3),
(8, 20, 3);

-- --------------------------------------------------------

--
-- Table structure for table `trsalesheader`
--

CREATE TABLE IF NOT EXISTS `trsalesheader` (
  `SalesID` int(11) NOT NULL AUTO_INCREMENT,
  `MemberID` int(11) NOT NULL,
  `SalesDate` date NOT NULL,
  PRIMARY KEY (`SalesID`),
  KEY `MemberID` (`MemberID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `trsalesheader`
--

INSERT INTO `trsalesheader` (`SalesID`, `MemberID`, `SalesDate`) VALUES
(1, 8, '2015-01-02'),
(2, 8, '2015-01-02'),
(3, 8, '2015-01-02'),
(4, 22, '2015-01-02'),
(5, 8, '2015-01-02'),
(6, 25, '2015-01-04'),
(7, 31, '2015-01-09'),
(8, 8, '2015-01-09');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `msproduct`
--
ALTER TABLE `msproduct`
  ADD CONSTRAINT `msproduct_ibfk_1` FOREIGN KEY (`CategoryID`) REFERENCES `mscategory` (`CategoryID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `trcomment`
--
ALTER TABLE `trcomment`
  ADD CONSTRAINT `trcomment_ibfk_1` FOREIGN KEY (`ProductID`) REFERENCES `msproduct` (`ProductID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `trcomment_ibfk_2` FOREIGN KEY (`MemberID`) REFERENCES `msmember` (`MemberID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `trsalesdetail`
--
ALTER TABLE `trsalesdetail`
  ADD CONSTRAINT `trsalesdetail_ibfk_1` FOREIGN KEY (`ProductID`) REFERENCES `msproduct` (`ProductID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `trsalesdetail_ibfk_2` FOREIGN KEY (`SalesID`) REFERENCES `trsalesheader` (`SalesID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `trsalesheader`
--
ALTER TABLE `trsalesheader`
  ADD CONSTRAINT `trsalesheader_ibfk_1` FOREIGN KEY (`MemberID`) REFERENCES `msmember` (`MemberID`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
