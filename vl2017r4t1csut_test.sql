-- phpMyAdmin SQL Dump
-- version 4.0.10.18
-- https://www.phpmyadmin.net
--
-- Host: localhost:3306
-- Generation Time: Apr 05, 2017 at 05:20 PM
-- Server version: 10.0.30-MariaDB
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `vl2017r4t1csut_test`
--

-- --------------------------------------------------------

--
-- Table structure for table `Answerstest`
--

CREATE TABLE IF NOT EXISTS `Answerstest` (
  `AnswerID` int(11) NOT NULL AUTO_INCREMENT,
  `UserID` int(11) NOT NULL,
  `PollID` int(11) NOT NULL,
  `Language` varchar(3) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `Answer` int(11) NOT NULL,
  PRIMARY KEY (`AnswerID`),
  KEY `UserID` (`UserID`),
  KEY `PollID` (`PollID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `Answerstest`
--

INSERT INTO `Answerstest` (`AnswerID`, `UserID`, `PollID`, `Language`, `Answer`) VALUES
(1, 1, 1, 'Eng', 4),
(2, 1, 2, 'Est', 1),
(3, 2, 1, 'Eng', 2),
(4, 2, 2, 'Eng', 3);

-- --------------------------------------------------------

--
-- Table structure for table `Passwordtest`
--

CREATE TABLE IF NOT EXISTS `Passwordtest` (
  `UserPassID` int(11) NOT NULL,
  `Password` varchar(40) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Passwordtest`
--

INSERT INTO `Passwordtest` (`UserPassID`, `Password`) VALUES
(1, 'Passw0rd'),
(2, 'Aa123456');

-- --------------------------------------------------------

--
-- Table structure for table `Polltest`
--

CREATE TABLE IF NOT EXISTS `Polltest` (
  `PollID` int(11) NOT NULL AUTO_INCREMENT,
  `RegDate` date NOT NULL,
  `UserID` int(11) NOT NULL,
  `Type` tinyint(1) NOT NULL,
  `Category` varchar(20) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `Privacy` int(11) NOT NULL,
  `Language` varchar(3) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `OpenStatus` tinyint(1) NOT NULL,
  PRIMARY KEY (`PollID`),
  KEY `UserID` (`UserID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `Polltest`
--

INSERT INTO `Polltest` (`PollID`, `RegDate`, `UserID`, `Type`, `Category`, `Privacy`, `Language`, `OpenStatus`) VALUES
(1, '2017-03-24', 1, 1, 'Politics', 1, 'Eng', 1),
(2, '2017-03-24', 1, 1, 'Religion', 1, 'Eng', 1);

-- --------------------------------------------------------

--
-- Table structure for table `Questiontest`
--

CREATE TABLE IF NOT EXISTS `Questiontest` (
  `QuestionID` int(11) NOT NULL AUTO_INCREMENT,
  `PollID` int(11) NOT NULL,
  `Language` varchar(3) NOT NULL,
  `Option1` varchar(160) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `Option2` varchar(160) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `Option3` varchar(160) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `Option4` varchar(160) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `Option5` varchar(160) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `Question` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`QuestionID`),
  KEY `PollID` (`PollID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `Questiontest`
--

INSERT INTO `Questiontest` (`QuestionID`, `PollID`, `Language`, `Option1`, `Option2`, `Option3`, `Option4`, `Option5`, `Question`) VALUES
(1, 1, 'Eng', 'Donald Trump', 'Barack Obama', 'George W. Bush', 'Bill Clinton', '', 'Who was the best president?'),
(2, 1, 'Est', 'Donald Trump', 'Barack Obama', 'George W. Bush', 'Bill Clinton', '', 'Kes oli parim president?'),
(3, 2, 'Est', 'Ei tea/ei huvita', 'Ei ole', 'Jah, üksainus', 'Jah, neid on mitu', '', 'Kas jumal on olemas?'),
(4, 2, 'Eng', 'Don''t know/don''t care', 'No', 'Yes, one god', 'Yes, several gods', '', 'Does God exist?');

-- --------------------------------------------------------

--
-- Table structure for table `Usertest`
--

CREATE TABLE IF NOT EXISTS `Usertest` (
  `UserID` int(11) NOT NULL AUTO_INCREMENT,
  `FirstName` varchar(50) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `LastName` varchar(50) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `Sex` tinyint(1) NOT NULL,
  `Email` varchar(100) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `BirthDate` date NOT NULL,
  `Language` varchar(3) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `FB` varchar(50) NOT NULL,
  PRIMARY KEY (`UserID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `Usertest`
--

INSERT INTO `Usertest` (`UserID`, `FirstName`, `LastName`, `Sex`, `Email`, `BirthDate`, `Language`, `FB`) VALUES
(1, 'John', 'Smith', 1, 'john.smith@gmail.com', '1990-07-04', 'Eng', ''),
(2, 'Jane', 'Doe', 2, 'janedoe@hotmail.com', '1997-03-08', 'Eng', '');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `Answerstest`
--
ALTER TABLE `Answerstest`
  ADD CONSTRAINT `fk_Answer_2_Poll` FOREIGN KEY (`PollID`) REFERENCES `Polltest` (`PollID`),
  ADD CONSTRAINT `fk_Answer_2_User` FOREIGN KEY (`UserID`) REFERENCES `Usertest` (`UserID`);

--
-- Constraints for table `Polltest`
--
ALTER TABLE `Polltest`
  ADD CONSTRAINT `fk_User_2_Poll` FOREIGN KEY (`UserID`) REFERENCES `Usertest` (`UserID`);

--
-- Constraints for table `Questiontest`
--
ALTER TABLE `Questiontest`
  ADD CONSTRAINT `fk_Poll_2_Question` FOREIGN KEY (`PollID`) REFERENCES `Polltest` (`PollID`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

CREATE USER 'vl2017r4t1csut_testuser'@'localhost' IDENTIFIED VIA mysql_native_password USING '*6B5EDDE567F4F29018862811195DBD14B8ADDD2A';GRANT USAGE ON *.* TO 'vl2017r4t1csut_testuser'@'localhost' REQUIRE NONE WITH MAX_QUERIES_PER_HOUR 0 MAX_CONNECTIONS_PER_HOUR 0 MAX_UPDATES_PER_HOUR 0 MAX_USER_CONNECTIONS 0;GRANT ALL PRIVILEGES ON `vl2017r4t1csut_test`.* TO 'vl2017r4t1csut_testuser'@'localhost';
