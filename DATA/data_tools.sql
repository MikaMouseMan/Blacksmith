-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Июл 27 2017 г., 21:07
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
-- Структура таблицы `data_tools`
--

CREATE TABLE `data_tools` (
  `tools_id` int(11) NOT NULL,
  `tools_name` varchar(255) NOT NULL,
  `tools_structure` varchar(255) NOT NULL,
  `tools_coef` int(11) NOT NULL,
  `tools_slot` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Очистить таблицу перед добавлением данных `data_tools`
--

TRUNCATE TABLE `data_tools`;
--
-- Дамп данных таблицы `data_tools`
--

INSERT INTO `data_tools` (`tools_id`, `tools_name`, `tools_structure`, `tools_coef`, `tools_slot`) VALUES
(1, 'hammer', 'hard_crystal_wood', 2, 'any'),
(2, 'saw', 'hard_crystal', 3, 'any'),
(3, 'showel', 'hard_crystal_wood', 3, 'two_hand'),
(4, 'axe', 'hard_crystal', 3, 'any'),
(5, 'pixaxe', 'hard_crystal', 3, 'two_hand');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `data_tools`
--
ALTER TABLE `data_tools`
  ADD UNIQUE KEY `id` (`tools_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
