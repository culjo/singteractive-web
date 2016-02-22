-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 15, 2016 at 05:12 AM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `singteractive`
--
CREATE DATABASE IF NOT EXISTS `singteractive` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `singteractive`;

-- --------------------------------------------------------

--
-- Table structure for table `st_albums`
--

CREATE TABLE IF NOT EXISTS `st_albums` (
  `album_id` int(11) NOT NULL AUTO_INCREMENT,
  `artist_id` int(11) DEFAULT NULL,
  `album_name` varchar(255) DEFAULT NULL,
  `album_year` varchar(255) DEFAULT NULL,
  `genre` text,
  `album_created` datetime DEFAULT NULL,
  `album_updated` datetime DEFAULT NULL,
  PRIMARY KEY (`album_id`),
  KEY `fk_st_albums_st_artists1_idx` (`artist_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `st_artists`
--

CREATE TABLE IF NOT EXISTS `st_artists` (
  `artist_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `is_band` tinyint(4) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `location` int(11) DEFAULT NULL,
  `genre` text,
  PRIMARY KEY (`artist_id`),
  KEY `fk_st_artists_st_users_idx` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `st_artists`
--

INSERT INTO `st_artists` (`artist_id`, `user_id`, `is_band`, `name`, `location`, `genre`) VALUES
(1, 1, 0, 'Lekamania', NULL, '1');

-- --------------------------------------------------------

--
-- Table structure for table `st_cities`
--

CREATE TABLE IF NOT EXISTS `st_cities` (
  `city_id` int(11) NOT NULL AUTO_INCREMENT,
  `state_id` int(11) DEFAULT NULL,
  `city_name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`city_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `st_countries`
--

CREATE TABLE IF NOT EXISTS `st_countries` (
  `country_id` int(11) NOT NULL AUTO_INCREMENT,
  `country_name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`country_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `st_genre`
--

CREATE TABLE IF NOT EXISTS `st_genre` (
  `genre_id` int(11) NOT NULL AUTO_INCREMENT,
  `genre_name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`genre_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `st_genre`
--

INSERT INTO `st_genre` (`genre_id`, `genre_name`) VALUES
(1, 'soul'),
(2, 'rap'),
(3, 'gospel'),
(4, 'blues'),
(5, 'pop'),
(6, 'rock'),
(7, 'metal'),
(8, 'afro'),
(9, 'fuji');

-- --------------------------------------------------------

--
-- Table structure for table `st_music`
--

CREATE TABLE IF NOT EXISTS `st_music` (
  `music_id` int(11) NOT NULL AUTO_INCREMENT,
  `artist_id` int(11) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL COMMENT 'The name given to the music by the artist(User)',
  `file_name` varchar(255) DEFAULT NULL COMMENT 'The original uploaded file name from the artist(user) device',
  `file_type` varchar(45) DEFAULT NULL COMMENT 'the mime type of the music file',
  `file_ext` varchar(45) DEFAULT NULL,
  `url` text,
  `album` varchar(255) DEFAULT NULL,
  `genre` text COMMENT 'A list of comma separated values that hold the id references to genre',
  `year` varchar(50) DEFAULT NULL,
  `music_uploaded_on` datetime DEFAULT NULL,
  `music_update_on` datetime DEFAULT NULL,
  PRIMARY KEY (`music_id`),
  KEY `fk_st_music_st_artists1_idx` (`artist_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `st_music`
--

INSERT INTO `st_music` (`music_id`, `artist_id`, `title`, `file_name`, `file_type`, `file_ext`, `url`, `album`, `genre`, `year`, `music_uploaded_on`, `music_update_on`) VALUES
(2, 1, 'number one', 'number_one', 'mp3', '.mp3', NULL, NULL, '', '2016', NULL, NULL),
(3, 1, 'Getting the Groove', 'gettinggroove', 'mp3', '.mp3', NULL, NULL, NULL, '2016', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `st_music_location`
--

CREATE TABLE IF NOT EXISTS `st_music_location` (
  `music_location_id` int(11) NOT NULL AUTO_INCREMENT,
  `music_id` int(11) DEFAULT NULL,
  `city_id` int(11) DEFAULT NULL,
  `state_id` int(11) DEFAULT NULL,
  `country_id` int(11) DEFAULT NULL COMMENT '0 = GLOBAL location',
  `misc` text,
  PRIMARY KEY (`music_location_id`),
  KEY `fk_st_music_location_st_music1_idx` (`music_id`),
  KEY `fk_st_music_location_st_countries1_idx` (`country_id`),
  KEY `fk_st_music_location_st_states1_idx` (`state_id`),
  KEY `fk_st_music_location_st_cities1_idx` (`city_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `st_music_stat`
--

CREATE TABLE IF NOT EXISTS `st_music_stat` (
  `music_stat_id` int(11) NOT NULL AUTO_INCREMENT,
  `music_id` int(11) DEFAULT NULL,
  `tot_plays` int(11) DEFAULT NULL,
  `tot_fav` int(11) DEFAULT NULL,
  PRIMARY KEY (`music_stat_id`),
  KEY `fk_st_music_stat_st_music1_idx` (`music_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `st_states`
--

CREATE TABLE IF NOT EXISTS `st_states` (
  `states_id` int(11) NOT NULL AUTO_INCREMENT,
  `country_id` int(11) DEFAULT NULL,
  `state_name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`states_id`),
  KEY `fk_st_states_st_countries1_idx` (`country_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `st_user_settings`
--

CREATE TABLE IF NOT EXISTS `st_user_settings` (
  `user_setting_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `setting1` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`user_setting_id`),
  KEY `fk_st_user_settings_st_users1_idx` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `st_users`
--

CREATE TABLE IF NOT EXISTS `st_users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `unique_id` varchar(23) NOT NULL,
  `firstname` varchar(105) DEFAULT NULL,
  `lastname` varchar(105) DEFAULT NULL,
  `displayname` varchar(105) DEFAULT NULL,
  `is_artist` tinyint(4) DEFAULT '0',
  `email` varchar(100) NOT NULL,
  `password` varchar(80) NOT NULL,
  `salt` varchar(10) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `country` int(11) DEFAULT NULL,
  `state` int(11) DEFAULT NULL,
  `city` int(11) DEFAULT NULL,
  `city_name` text,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `unique_id` (`unique_id`,`email`),
  UNIQUE KEY `email_UNIQUE` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `st_users`
--

INSERT INTO `st_users` (`user_id`, `unique_id`, `firstname`, `lastname`, `displayname`, `is_artist`, `email`, `password`, `salt`, `created_at`, `updated_at`, `country`, `state`, `city`, `city_name`) VALUES
(1, '56884ab7a25c77.25411633', NULL, NULL, NULL, 0, 'olad@yahoo.com', 'UaShZgBtffFwuk71MW+9racvuhQ0YTFjMzI3MTli', '4a1c32719b', '2016-01-02 23:09:59', NULL, NULL, NULL, NULL, NULL);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `st_albums`
--
ALTER TABLE `st_albums`
  ADD CONSTRAINT `fk_st_albums_st_artists1` FOREIGN KEY (`artist_id`) REFERENCES `st_artists` (`artist_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `st_artists`
--
ALTER TABLE `st_artists`
  ADD CONSTRAINT `fk_st_artists_st_users` FOREIGN KEY (`user_id`) REFERENCES `st_users` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `st_music`
--
ALTER TABLE `st_music`
  ADD CONSTRAINT `fk_st_music_st_artists1` FOREIGN KEY (`artist_id`) REFERENCES `st_artists` (`artist_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `st_music_location`
--
ALTER TABLE `st_music_location`
  ADD CONSTRAINT `fk_st_music_location_st_cities1` FOREIGN KEY (`city_id`) REFERENCES `st_cities` (`city_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_st_music_location_st_countries1` FOREIGN KEY (`country_id`) REFERENCES `st_countries` (`country_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_st_music_location_st_music1` FOREIGN KEY (`music_id`) REFERENCES `st_music` (`music_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_st_music_location_st_states1` FOREIGN KEY (`state_id`) REFERENCES `st_states` (`states_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `st_music_stat`
--
ALTER TABLE `st_music_stat`
  ADD CONSTRAINT `fk_st_music_stat_st_music1` FOREIGN KEY (`music_id`) REFERENCES `st_music` (`music_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `st_states`
--
ALTER TABLE `st_states`
  ADD CONSTRAINT `fk_st_states_st_countries1` FOREIGN KEY (`country_id`) REFERENCES `st_countries` (`country_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `st_user_settings`
--
ALTER TABLE `st_user_settings`
  ADD CONSTRAINT `fk_st_user_settings_st_users1` FOREIGN KEY (`user_id`) REFERENCES `st_users` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
