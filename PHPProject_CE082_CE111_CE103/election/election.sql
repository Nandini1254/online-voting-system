-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 29, 2021 at 07:08 AM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.2.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `election`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(8) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(70) NOT NULL,
  `pass` varchar(256) NOT NULL,
  `mobile` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `name`, `email`, `pass`, `mobile`) VALUES
(8, 'Nandini101', 'user89@gmail.com', '$2y$10$KjLqvQDfw9DjM0jMQsh2hePPs3Jq4JXrzt6gPsZviBnuq8XZwYOLG', '9510922991'),
(9, 'Nandini896', 'user200@gmail.com', '$2y$10$qS5sUpmM8aGh8kcQsUKnJei.S0gd/SOky8XpUxFG2QwQPFvoA95gu', '9510922990'),
(10, 'Nandinimain', 'nandinipanchani@gmail.com', '$2y$10$H/0nAwsGccVki4vm2QmEIu9l11QbmqyKHwzZ0j.7BlIpgMzATWpya', '9510922990');

-- --------------------------------------------------------

--
-- Table structure for table `admin_change`
--

CREATE TABLE `admin_change` (
  `id` int(8) NOT NULL,
  `A_id` int(8) NOT NULL,
  `token` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin_change`
--

INSERT INTO `admin_change` (`id`, `A_id`, `token`) VALUES
(1, 1, 'dfdfcdvfdv');

-- --------------------------------------------------------

--
-- Table structure for table `election_vote`
--

CREATE TABLE `election_vote` (
  `eid` int(8) NOT NULL,
  `name` varchar(40) NOT NULL,
  `description` text NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `reg_last_date` date NOT NULL,
  `create_on` datetime NOT NULL DEFAULT current_timestamp(),
  `vote_status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `election_vote`
--

INSERT INTO `election_vote` (`eid`, `name`, `description`, `start_date`, `end_date`, `reg_last_date`, `create_on`, `vote_status`) VALUES
(3, 'HOD', 'sds555dd', '2021-03-04', '2021-03-19', '2021-03-01', '2021-03-01 17:57:31', 0),
(4, 'vice man', 'sub election2', '2021-03-16', '2021-03-26', '2021-03-18', '2021-03-01 18:03:14', 0),
(5, 'chairman', 'college-election', '2021-03-17', '2021-03-19', '2021-03-11', '2021-03-02 04:19:24', 0),
(6, 'HOD (CE)', 'It\'s election for head of our department ', '2021-03-29', '2021-04-02', '2021-03-28', '2021-03-24 11:34:55', 0),
(7, 'Sub Election of CH', 'sub election of chemical departtment for chairman', '2021-03-27', '2021-03-29', '2021-03-26', '2021-03-24 11:39:52', 0),
(8, 'Chairman2', 'main sub director', '2021-03-30', '2021-04-04', '2021-03-28', '2021-03-27 07:45:47', 0),
(9, 'Election Ec', 'Main election of head of sub director', '2021-04-01', '2021-04-02', '2021-03-30', '2021-03-27 08:04:16', 0),
(10, 'HOD (Chemical)', 'the main head of department', '2021-03-31', '2021-04-03', '2021-03-29', '2021-03-28 00:15:25', 0),
(11, 'chairamain of CE', '', '2021-03-30', '2021-03-31', '2021-03-29', '2021-03-28 01:17:48', 0);

-- --------------------------------------------------------

--
-- Table structure for table `elector`
--

CREATE TABLE `elector` (
  `id` int(8) NOT NULL,
  `elector_name` varchar(50) DEFAULT NULL,
  `vote` int(8) NOT NULL,
  `election` varchar(100) NOT NULL,
  `elector_email` varchar(50) NOT NULL,
  `elector_mobile` varchar(10) NOT NULL,
  `elector_password` varchar(256) NOT NULL,
  `elector_logo` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `elector`
--

INSERT INTO `elector` (`id`, `elector_name`, `vote`, `election`, `elector_email`, `elector_mobile`, `elector_password`, `elector_logo`) VALUES
(12, 'Nirali2', 1, 'HOD', 'user1@gmail.com', '9510922990', '$2y$10$t/nm07lehNsGvNsGv9wOFux5RKAxjxANJXutGn5ahhfMejL0OqUOi', '../uploads/IMG_20200413_2312335550.jpg'),
(13, 'Nirali1', 3, 'HOD', 'nirali@gmail.com', '9510922990', '$2y$10$MCgKfeQMVt.22Lmx97a/Y.UFDTBibsYVTCHxy8FhKMzdPfPQlgwZG', '../uploads/21940.jpg'),
(14, 'Nandini450000', 5, 'chairman', 'nandini34@gmail.com', '9328789852', '$2y$10$SXJMsAwXEz0cNAYYOsKdGeSmmWUEX2JS0xDPibyJ.qzHsclsQv.e6', '../uploads/capital0111.png'),
(16, 'Nirali89', 2, 'vice man', 'user410@gmail.com', '9510922990', '$2y$10$TRpSs4K/eouDugCshTkwVOGQNJkYsMxxpJc5KGotyXiqkjJ0x4IqC', '../uploads/download1734.jpg'),
(17, 'Niraliwe', 0, 'vice man', 'user11@gmail.com', '9510922990', '$2y$10$bDxWyfTEdMJrRkLPHCEtKuJgcvf0JjlZE5zgukMBg2XLc9wSgByzW', '../uploads/10404.jpg'),
(18, 'Niraliwer', 0, 'vice man', 'user233@gmail.com', '9510922990', '$2y$10$9gDiWPhAvp9WuyYelOYUr.S9gPDGVmrx9u9sX.f63kygZL9F6rW2O', '../uploads/20210.jpg'),
(19, 'Nandini35', 0, 'Chairman2', 'user855@gmail.com', '9510922990', '$2y$10$8xEXVFzAobB1/p9Fyb0wSuG89UxjDbZfX9S5dXYiQ4OVis77fFj1i', '../uploads/142555.jpg'),
(20, 'Nandini', 0, 'Election Ec', 'user@gmail.com', '9510922990', '$2y$10$Z4oYwu5Pq9q.DJLexDUi1elIyeIYkbFOnGbHwS.gOldiaX/V6Rq.u', '../uploads/160401.png'),
(21, 'Nandini', 0, 'Sub Election of CH', 'user3@gmail.com', '9510922990', '$2y$10$cMxQde2JrU1.E8VRAyFSEOhLmA3lKxM7qgJHOnowpGl8jRcbzoqHm', '../uploads/94929.png'),
(22, 'Maitra', 0, 'HOD (CE)', 'user50@gmail.com', '9510922990', '$2y$10$MIL/7HEwaZs4EzXcOuvd0.i9p.us09DlO3hlPNkliAv5HKwZN6l/G', '../uploads/download2830.jpg'),
(23, 'Rajesh', 2, 'Sub Election of CH', 'user34@gmail.com', '9510922990', '$2y$10$Hi.yb4iljlkFQYWiqxbzoOV8BneWy4X2la551rKaRplAHrBBQ1NXO', '../uploads/113231.png'),
(24, 'Nandini4555', 0, 'HOD (Chemical)', 'user@gmail.com', '9510922990', '$2y$10$1WN.yRo7OOOoyFQdRlrhUOmpHCOWRFOnA/3T21nrVPWdj47RdHySS', '../uploads/21354.jpg'),
(25, 'Nandini25000', 0, 'Election Ec', 'user25000@gmail.com', '9510922990', '$2y$10$TouEOttPAIkDy7vUtoA1b.5O8bEPyRSMDWw7Zdw/BJMMUGleZ25O.', '../uploads/120548.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `result`
--

CREATE TABLE `result` (
  `id` int(8) NOT NULL,
  `election_id` int(8) NOT NULL,
  `candidate_id` int(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `result`
--

INSERT INTO `result` (`id`, `election_id`, `candidate_id`) VALUES
(1, 1, 1),
(2, 3, 13),
(3, 5, 0),
(4, 4, 16);

-- --------------------------------------------------------

--
-- Table structure for table `voter`
--

CREATE TABLE `voter` (
  `id` int(8) NOT NULL,
  `voter_name` varchar(40) DEFAULT NULL,
  `voter_email` varchar(50) NOT NULL,
  `voter_password` varchar(256) NOT NULL,
  `voter_mobile` varchar(10) NOT NULL,
  `vote_status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `voter`
--

INSERT INTO `voter` (`id`, `voter_name`, `voter_email`, `voter_password`, `voter_mobile`, `vote_status`) VALUES
(14, 'Nirali7', 'user@gmail.com', '$2y$10$T65Im5aB7r4NRodIUt2jN.5BqEXyDiJEchg2VG8hLc2w9rUDwIIGS', '9510922990', 0),
(15, 'nandini', 'nandinipanchani@gmail.com', '253', '9865741234', 0),
(16, 'Nirali2', 'user2@gmail.com', '$2y$10$coNYiit59fPkPslPy6YQsuza8oG0JkhMMl3ifZczrJNq.QXtS9.Jm', '9510922990', 0),
(17, 'Nirali40', 'user3@gmail.com', '$2y$10$dk4nH.1zNlk6vcZx4O3lA.mUCJ8Vi0Ur4Qoig87svYarsPWMotDre', '9510922990', 0),
(18, 'Nirali', 'user8@gmail.com', '$2y$10$3FOVJUABllyLaIqrW8XgB.rVC95ubIVdE5bF7CXzZmu1L4/iRSkEa', '9510922990', 0),
(19, 'Nandini56', 'user410@gmail.com', '$2y$10$wvSr3U70S.PlDRRisEIIPOJfnbZ0js7v3OklN3OnvfiViD0dZiXli', '9510922970', 0),
(20, 'User30', 'user30@gmail.com', '$2y$10$4WBNIfzau332f7QBwIOiEO/H.huO8wDf47gDJXJ/2Bcq0uRe9iPfG', '9852255245', 0);

-- --------------------------------------------------------

--
-- Table structure for table `voting`
--

CREATE TABLE `voting` (
  `id` int(8) NOT NULL,
  `v_id` int(8) NOT NULL,
  `E_id` int(8) NOT NULL,
  `c_id` int(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `voting`
--

INSERT INTO `voting` (`id`, `v_id`, `E_id`, `c_id`) VALUES
(2, 16, 3, 12),
(4, 17, 3, 13),
(5, 18, 3, 13),
(6, 19, 3, 13),
(7, 19, 4, 16),
(9, 19, 7, 23),
(10, 20, 7, 23);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin_change`
--
ALTER TABLE `admin_change`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `election_vote`
--
ALTER TABLE `election_vote`
  ADD PRIMARY KEY (`eid`);

--
-- Indexes for table `elector`
--
ALTER TABLE `elector`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `result`
--
ALTER TABLE `result`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `voter`
--
ALTER TABLE `voter`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `voting`
--
ALTER TABLE `voting`
  ADD PRIMARY KEY (`id`),
  ADD KEY `voter_voting` (`v_id`),
  ADD KEY `elector_voting` (`E_id`),
  ADD KEY `candidate_voting_count` (`c_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `admin_change`
--
ALTER TABLE `admin_change`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `election_vote`
--
ALTER TABLE `election_vote`
  MODIFY `eid` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `elector`
--
ALTER TABLE `elector`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `result`
--
ALTER TABLE `result`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `voter`
--
ALTER TABLE `voter`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `voting`
--
ALTER TABLE `voting`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `voting`
--
ALTER TABLE `voting`
  ADD CONSTRAINT `candidate_voting_count` FOREIGN KEY (`c_id`) REFERENCES `elector` (`id`),
  ADD CONSTRAINT `elector_voting` FOREIGN KEY (`E_id`) REFERENCES `election_vote` (`eid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `voter_voting` FOREIGN KEY (`v_id`) REFERENCES `voter` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
