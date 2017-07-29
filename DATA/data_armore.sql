-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Июл 27 2017 г., 21:05
-- Версия сервера: 10.1.21-MariaDB
-- Версия PHP: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `c968524y_main`
--

-- --------------------------------------------------------

--
-- Структура таблицы `data_armore`
--

CREATE TABLE `data_armore` (
  `armore_id` int(11) NOT NULL,
  `armore_name` varchar(255) NOT NULL,
  `armore_structure` varchar(255) NOT NULL,
  `armore_coef` int(11) NOT NULL,
  `armore_slot` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Очистить таблицу перед добавлением данных `data_armore`
--

TRUNCATE TABLE `data_armore`;
--
-- Дамп данных таблицы `data_armore`
--

INSERT INTO `data_armore` (`armore_id`, `armore_name`, `armore_structure`, `armore_coef`, `armore_slot`) VALUES
(1001, 'lite helm', 'fibre', 10, 'head'),
(1301, 'medium helm', 'hard_crystal_fibre', 100, 'head'),
(1601, 'havy helm', 'hard_crystal', 150, 'head'),
(2001, 'lite shirt', 'fibre', 40, 'chest'),
(3001, 'lite pans', 'fibre', 30, 'legs'),
(4001, 'lite gloves', 'fibre', 10, 'hand'),
(5001, 'lite shose', 'fibre', 10, 'foot'),
(6001, 'lite belt', 'fibre', 5, 'belt'),
(7001, 'lite beg', 'fibre', 5, 'back');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `data_armore`
--
ALTER TABLE `data_armore`
  ADD UNIQUE KEY `id` (`armore_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
