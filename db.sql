-- phpMyAdmin SQL Dump
-- version 3.5.6
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Время создания: Мар 20 2013 г., 21:07
-- Версия сервера: 5.1.67-0ubuntu0.10.04.1
-- Версия PHP: 5.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `saitovod`
--

-- --------------------------------------------------------

--
-- Структура таблицы `posts`
--

CREATE TABLE IF NOT EXISTS `posts` (
  `id`      INT(10) UNSIGNED                   NOT NULL AUTO_INCREMENT,
  `title`   VARCHAR(255)                       NOT NULL,
  `slug`    VARCHAR(255)                       NOT NULL,
  `date`    DATETIME                           NOT NULL,
  `content` TEXT                               NOT NULL,
  `status`  ENUM('draft', 'public', 'private') NOT NULL DEFAULT 'public',
  PRIMARY KEY (`id`),
  UNIQUE KEY `slug` (`slug`),
  KEY `status` (`status`)
)
  ENGINE = MyISAM
  DEFAULT CHARSET = utf8
  AUTO_INCREMENT = 1;

--
-- Структура таблицы `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
  `id`          INT(10) UNSIGNED                              NOT NULL AUTO_INCREMENT,
  `post_id`     INT(10) UNSIGNED                              NOT NULL,
  `author_name` VARCHAR(255)                                  NOT NULL,
  `author_ip`   VARCHAR(15)                                   NOT NULL,
  `date`        DATETIME                                      NOT NULL,
  `content`     TEXT                                          NOT NULL,
  `status`      ENUM('not_moderated', 'moderated', 'deleted') NOT NULL DEFAULT 'not_moderated',
  PRIMARY KEY (`id`),
  KEY `post_and_status` (`post_id`, `status`)
)
  ENGINE = MyISAM
  DEFAULT CHARSET = utf8
  AUTO_INCREMENT = 1;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
