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
-- Структура таблицы `data_material`
--

CREATE TABLE `data_material` (
  `material_id` int(11) NOT NULL,
  `material_name` varchar(255) NOT NULL,
  `material_structure` varchar(255) NOT NULL,
  `material_coef` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Очистить таблицу перед добавлением данных `data_material`
--

TRUNCATE TABLE `data_material`;
--
-- Дамп данных таблицы `data_material`
--

INSERT INTO `data_material` (`material_id`, `material_name`, `material_structure`, `material_coef`) VALUES
(1, 'ingot', 'hard', 3),
(2, 'fragment', 'crystal', 1),
(3, 'fabric', 'fibre', 5),
(4, 'fluid', 'liqid', 3),
(5, 'wood chunk', 'wood', 1),
(6, 'wood double chunk', 'wood', 2),
(7, 'wood triple chunk', 'wood', 3);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `data_material`
--
ALTER TABLE `data_material`
  ADD UNIQUE KEY `id` (`material_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
