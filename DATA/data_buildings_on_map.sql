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
-- Структура таблицы `data_buildings_on_map`
--

CREATE TABLE `data_buildings_on_map` (
  `id` int(22) NOT NULL,
  `x` int(11) NOT NULL,
  `y` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `health` int(11) NOT NULL,
  `health_max` int(11) NOT NULL,
  `master_id` int(11) NOT NULL,
  `color` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Очистить таблицу перед добавлением данных `data_buildings_on_map`
--

TRUNCATE TABLE `data_buildings_on_map`;
--
-- Дамп данных таблицы `data_buildings_on_map`
--

INSERT INTO `data_buildings_on_map` (`id`, `x`, `y`, `name`, `health`, `health_max`, `master_id`, `color`) VALUES
(2816, 28, 16, 'floor', 1, 1, 29, 250),
(2817, 28, 17, 'floor', 1, 1, 29, 250),
(2910, 29, 10, 'road', 1, 1, 29, 200),
(2911, 29, 11, 'road', 1, 1, 29, 200),
(2912, 29, 12, 'road', 1, 1, 29, 200),
(2913, 29, 13, 'road', 1, 1, 29, 200),
(2914, 29, 14, 'road', 1, 1, 29, 200),
(2915, 29, 15, 'road', 1, 1, 29, 200),
(2916, 29, 16, 'floor', 1, 1, 29, 250),
(2917, 29, 17, 'floor', 1, 1, 29, 250),
(3016, 30, 16, 'floor', 1, 1, 29, 250),
(3017, 30, 17, 'floor', 1, 1, 29, 250);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `data_buildings_on_map`
--
ALTER TABLE `data_buildings_on_map`
  ADD UNIQUE KEY `id` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
