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
-- Структура таблицы `data_component`
--

CREATE TABLE `data_component` (
  `component_id` int(11) NOT NULL,
  `component_name` varchar(255) NOT NULL,
  `component_structure` varchar(255) NOT NULL,
  `component_coef` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='100-1000 овечают за structure 1000-10000 отвечают за смысловую нагрузку при крафте' ROW_FORMAT=COMPACT;

--
-- Очистить таблицу перед добавлением данных `data_component`
--

TRUNCATE TABLE `data_component`;
--
-- Дамп данных таблицы `data_component`
--

INSERT INTO `data_component` (`component_id`, `component_name`, `component_structure`, `component_coef`) VALUES
(301, 'plate', 'hard_wood', 3),
(402, 'cord', 'fibre', 20),
(403, 'linen', 'fibre', 100),
(404, 'twine', 'fibre', 2),
(405, 'diamond', 'crystal', 1),
(406, 'mixture', 'liqid', 2),
(407, 'paper', 'wood', 1),
(408, 'tile', 'crystal', 2),
(1101, 'handle', 'hard_crystal_wood', 2),
(2201, 'blade', 'hard_crystal', 3),
(3301, 'bow component', 'hard_wood', 6),
(4101, 'rod', 'hard_crystal_wood', 3),
(5401, 'small wood block', 'wood', 4),
(5402, 'wood block', 'wood', 16),
(5403, 'long wood block', 'wood', 32),
(6201, 'hammer head', 'hard_crystal', 2),
(7201, 'axe head', 'hard_crystal', 3),
(8201, 'tip', 'hard_crystal', 1),
(9201, 'garda', 'hard_crystal', 2),
(10201, 'pixaxe head', 'hard_crystal', 2);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `data_component`
--
ALTER TABLE `data_component`
  ADD UNIQUE KEY `id` (`component_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
