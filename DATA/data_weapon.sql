-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Июл 28 2017 г., 12:58
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
-- Структура таблицы `data_weapon`
--

CREATE TABLE `data_weapon` (
  `weapon_id` int(11) NOT NULL,
  `weapon_name` varchar(255) NOT NULL,
  `weapon_structure` varchar(255) NOT NULL,
  `weapon_coef` int(11) NOT NULL,
  `weapon_slot` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='100-1000 овечают за structure 1000-10000 отвечают за смысловую нагрузку при крафте' ROW_FORMAT=COMPACT;

--
-- Очистить таблицу перед добавлением данных `data_weapon`
--

TRUNCATE TABLE `data_weapon`;
--
-- Дамп данных таблицы `data_weapon`
--

INSERT INTO `data_weapon` (`weapon_id`, `weapon_name`, `weapon_structure`, `weapon_coef`, `weapon_slot`) VALUES
(1201, 'knife', 'hard_crystal', 10, 'any'),
(1202, 'short sword', 'hard_crystal', 50, 'any'),
(1203, 'sword', 'hard_crystal', 100, 'right'),
(1204, 'long sword', 'hard_crystal', 150, 'right'),
(1205, 'two handed sword', 'hard_crystal', 200, 'two_hand'),
(2301, 'short bow', 'hard_wood', 50, 'two_hand'),
(2302, 'bow', 'hard_wood', 100, 'two_hand'),
(2303, 'long bow', 'hard_wood', 150, 'two_hand'),
(2304, 'arbalet', 'hard_wood', 150, 'two_hand'),
(2305, 'heavy arbalet', 'hard_wood', 200, 'two_hand'),
(3201, 'pike', 'hard_crystal', 150, 'two_hand'),
(3203, 'harpoon', 'hard_crystal', 160, 'two_hand'),
(4201, 'hammer', 'hard_crystal', 120, 'two_hand'),
(4202, 'huge hammer', 'hard_crystal', 180, 'two_hand'),
(5201, 'small axe', 'hard_crystal', 60, 'any'),
(5202, 'axe', 'hard_crystal', 110, 'right'),
(5203, 'big axe', 'hard_crystal', 170, 'two_hand'),
(6201, 'arrow', 'hard_crystal', 5, 'any'),
(7101, 'staff', 'hard_crystal_wood', 100, 'two_hand'),
(8401, 'book', 'wood', 50, 'any'),
(9101, 'shield', 'hard_crystal_wood', 100, 'left'),
(9102, 'tower shiel', 'hard_crystal_wood', 250, 'two_hand');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `data_weapon`
--
ALTER TABLE `data_weapon`
  ADD UNIQUE KEY `id` (`weapon_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
