-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Июл 09 2017 г., 01:44
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
(101, 'lite helm', 'fibre', 10, 'head'),
(201, 'lite shirt', 'fibre', 40, 'chest'),
(301, 'lite pans', 'fibre', 30, 'legs'),
(401, 'lite gloves', 'fibre', 10, 'hand'),
(501, 'lite shose', 'fibre', 10, 'foot'),
(601, 'lite belt', 'fibre', 5, 'belt'),
(701, 'lite beg', 'fibre', 5, 'back');

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
(401, 'plate', 'hard', 3),
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
(9201, 'garda', 'hard_crystal', 2);

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
(2, 'saw', 'hard_crystal_wood', 3, 'any'),
(3, 'showel', 'hard_crystal_wood', 3, 'two_hand'),
(4, 'axe', 'hard_crystal_wood', 3, 'any');

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
-- Индексы таблицы `data_armore`
--
ALTER TABLE `data_armore`
  ADD UNIQUE KEY `id` (`armore_id`);

--
-- Индексы таблицы `data_component`
--
ALTER TABLE `data_component`
  ADD UNIQUE KEY `id` (`component_id`);

--
-- Индексы таблицы `data_material`
--
ALTER TABLE `data_material`
  ADD UNIQUE KEY `id` (`material_id`);

--
-- Индексы таблицы `data_resurse`
--
ALTER TABLE `data_resurse`
  ADD UNIQUE KEY `id` (`resurse_id`);

--
-- Индексы таблицы `data_tools`
--
ALTER TABLE `data_tools`
  ADD UNIQUE KEY `id` (`tools_id`);

--
-- Индексы таблицы `data_weapon`
--
ALTER TABLE `data_weapon`
  ADD UNIQUE KEY `id` (`weapon_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
