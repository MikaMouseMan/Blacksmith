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
-- Структура таблицы `data_resurse`
--

CREATE TABLE `data_resurse` (
  `resurse_id` int(11) NOT NULL,
  `resurse_name` varchar(255) NOT NULL,
  `resurse_structure` varchar(255) NOT NULL,
  `resurse_coef` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Очистить таблицу перед добавлением данных `data_resurse`
--

TRUNCATE TABLE `data_resurse`;
--
-- Дамп данных таблицы `data_resurse`
--

INSERT INTO `data_resurse` (`resurse_id`, `resurse_name`, `resurse_structure`, `resurse_coef`) VALUES
(1, 'pies', 'hard', 60),
(2, 'dust', 'crystal', 100),
(3, 'thread', 'fibre', 20),
(4, 'droplet', 'liqid', 10),
(5, 'wood log', 'wood', 40);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `data_resurse`
--
ALTER TABLE `data_resurse`
  ADD UNIQUE KEY `id` (`resurse_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
