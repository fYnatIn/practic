CREATE DATABASE IF NOT EXISTS `practic` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `practic`;

CREATE TABLE IF NOT EXISTS `department` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(10) NOT NULL,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY(`id`)
)ENGINE=InnoDB  DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `teacher` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `fathername` varchar(255) NOT NULL,
  `department_id` int(11) NOT NULL,
  `account_id` int(11) NOT NULL,
  PRIMARY KEY(`id`)
)ENGINE=InnoDB  DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `group` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(10) NOT NULL,
  `name` varchar(255) NOT NULL,
  `department_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
)ENGINE=InnoDB  DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `account` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `u_login` varchar(50) NOT NULL,
  `u_pwd` varchar(50) NOT NULL,
  `role` enum('1','2','3','4') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

INSERT INTO `account` (`id`,  `u_login`, `u_pwd`, `role`) VALUES
(1, 'Admin', '0ce3266d4eb71ad50f7a90aee6d21dcd', '4');