-- phpMyAdmin SQL Dump
-- version 3.2.3
-- http://www.phpmyadmin.net
--
-- 호스트: localhost
-- 처리한 시간: 23-08-18 23:13 
-- 서버 버전: 5.1.41
-- PHP 버전: 5.2.12

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 데이터베이스: `user`
--
CREATE DATABASE `user` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
USE `user`;

-- --------------------------------------------------------

--
-- 테이블 구조 `board`
--

CREATE TABLE IF NOT EXISTS `board` (
  `idx` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `pw` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `hit` int(11) NOT NULL,
  `lock_post` int(11) NOT NULL,
  `file` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`idx`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- 테이블의 덤프 데이터 `board`
--

INSERT INTO `board` (`idx`, `name`, `pw`, `title`, `content`, `date`, `hit`, `lock_post`, `file`) VALUES
(1, 'test', 'test', 'test', 'test', '2023-08-17', 1, 0, ''),
(2, 'asd', 'test', 'test', 'test', '2023-08-18', 0, 0, '');

-- --------------------------------------------------------

--
-- 테이블 구조 `juso`
--

CREATE TABLE IF NOT EXISTS `juso` (
  `idx` int(11) NOT NULL AUTO_INCREMENT,
  `zipcode` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `addr1` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `addr2` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`idx`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=10 ;

--
-- 테이블의 덤프 데이터 `juso`
--

INSERT INTO `juso` (`idx`, `zipcode`, `addr1`, `addr2`) VALUES
(1, '12345', 'Gangnam-gu, Seoul', 'Yangjae-dong 123-45'),
(2, '23456', 'Jongno-gu, Seoul', 'Gwancheol-dong 234-56'),
(3, '34567', 'Songpa-gu, Seoul', 'Jamsil-dong 345-67'),
(4, '45678', 'Gangseo-gu, Seoul', 'Hwagok-dong 456-78'),
(5, '56789', 'Seocho-gu, Seoul', 'Banpo-dong 567-89'),
(6, '67890', 'Eunpyeong-gu, Seoul', 'Nokbeon-dong 678-90'),
(7, '78901', 'Jungnang-gu, Seoul', 'Mangwoo-dong 789-1'),
(8, '89012', 'Dongjak-gu, Seoul', 'Sangdo-dong 890-12'),
(9, '90123', 'Gangbuk-gu, Seoul', 'Beon-dong 901-23');

-- --------------------------------------------------------

--
-- 테이블 구조 `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `idx` int(11) NOT NULL AUTO_INCREMENT,
  `id` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`idx`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=26 ;

--
-- 테이블의 덤프 데이터 `user`
--

INSERT INTO `user` (`idx`, `id`, `password`, `name`, `address`) VALUES
(25, 'test', '9f86d081884c7d659a2feaa0c55ad015a3bf4f1b2b0b822cd15d6c15b0f00a08', 'test', 'test');
