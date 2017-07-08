-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Июл 08 2017 г., 22:56
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
  `armore_image` varchar(255) NOT NULL,
  `armore_structure` varchar(255) NOT NULL,
  `armore_coef` int(11) NOT NULL,
  `armore_slot` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Дамп данных таблицы `data_armore`
--

INSERT INTO `data_armore` (`armore_id`, `armore_name`, `armore_image`, `armore_structure`, `armore_coef`, `armore_slot`) VALUES
(101, 'lite helm', 'lite_helm.jpg', 'fibre', 10, 'head'),
(201, 'lite shirt', 'lite_shirt.jpg', 'fibre', 40, 'chest'),
(301, 'lite pans', 'lite_pans.jpg', 'fibre', 30, 'legs'),
(401, 'lite gloves', 'lite_gloves.jpg', 'fibre', 10, 'hand'),
(501, 'lite shose', 'lite_shose.jpg', 'fibre', 10, 'foot'),
(601, 'lite belt', 'lite_belt.jpg', 'fibre', 5, 'belt'),
(701, 'lite beg', 'lite_beg.jpg', 'fibre', 5, 'back');

-- --------------------------------------------------------

--
-- Структура таблицы `data_component`
--

CREATE TABLE `data_component` (
  `component_id` int(11) NOT NULL,
  `component_name` varchar(255) NOT NULL,
  `component_image` varchar(255) NOT NULL,
  `component_structure` varchar(255) NOT NULL,
  `component_coef` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='100-1000 овечают за structure 1000-10000 отвечают за смысловую нагрузку при крафте' ROW_FORMAT=COMPACT;

--
-- Дамп данных таблицы `data_component`
--

INSERT INTO `data_component` (`component_id`, `component_name`, `component_image`, `component_structure`, `component_coef`) VALUES
(401, 'plate', 'plate.jpg', 'hard', 3),
(402, 'cord', 'cord.jpg', 'fibre', 20),
(403, 'linen', 'linen.jpg', 'fibre', 100),
(404, 'twine', 'twine.jpg', 'fibre', 2),
(405, 'diamond', 'diamond.jpg', 'crystal', 1),
(406, 'mixture', 'mixture.jpg', 'liqid', 2),
(407, 'paper', 'paper.jpg', 'wood', 1),
(408, 'tile', 'tile.jpg', 'crystal', 2),
(1101, 'handle', 'handle.jpg', 'hard_crystal_wood', 2),
(2201, 'blade', 'blade.jpg', 'hard_crystal', 3),
(3301, 'bow component', 'bow_component.jpg', 'hard_wood', 6),
(4101, 'rod', 'rod.jpg', 'hard_crystal_wood', 3),
(5401, 'small wood block', 'small_wood_block.jpg', 'wood', 4),
(5402, 'wood block', 'wood_block.jpg', 'wood', 16),
(5403, 'long wood block', 'long_wood_block.jpg', 'wood', 32),
(6201, 'hammer head', 'hammer_head.jpg', 'hard_crystal', 2),
(7202, 'axe head', 'axe_head.jpg', 'hard_crystal', 3),
(8203, 'tip', 'tip.jpg', 'hard_crystal', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `data_material`
--

CREATE TABLE `data_material` (
  `material_id` int(11) NOT NULL,
  `material_name` varchar(255) NOT NULL,
  `material_image` varchar(255) NOT NULL,
  `material_structure` varchar(255) NOT NULL,
  `material_coef` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Дамп данных таблицы `data_material`
--

INSERT INTO `data_material` (`material_id`, `material_name`, `material_image`, `material_structure`, `material_coef`) VALUES
(1, 'ingot', 'ingot.jpg', 'hard', 3),
(2, 'fragment', 'fragment.jpg', 'crystal', 1),
(3, 'fabric', 'fabric.jpg', 'fibre', 5),
(4, 'fluid', 'fluid.jpg', 'liqid', 3),
(5, 'wood chunk', 'wood_chunk.jpg', 'wood', 1),
(6, 'wood double chunk', 'wood_double_chunk.jpg', 'wood', 2),
(7, 'wood triple chunk', 'wood_triple_chunk.jpg', 'wood', 3);

-- --------------------------------------------------------

--
-- Структура таблицы `data_resurse`
--

CREATE TABLE `data_resurse` (
  `resurse_id` int(11) NOT NULL,
  `resurse_name` varchar(255) NOT NULL,
  `resurse_image` varchar(255) NOT NULL,
  `resurse_structure` varchar(255) NOT NULL,
  `resurse_coef` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Дамп данных таблицы `data_resurse`
--

INSERT INTO `data_resurse` (`resurse_id`, `resurse_name`, `resurse_image`, `resurse_structure`, `resurse_coef`) VALUES
(1, 'pies', 'pies.jpg', 'hard', 60),
(2, 'dust', 'dust.jpg', 'crystal', 100),
(3, 'thread', 'thread.jpg', 'fibre', 20),
(4, 'droplet', 'droplet.jpg', 'liqid', 10),
(5, 'wood log', 'wood_log.jpg', 'wood', 40);

-- --------------------------------------------------------

--
-- Структура таблицы `data_tools`
--

CREATE TABLE `data_tools` (
  `tools_id` int(11) NOT NULL,
  `tools_name` varchar(255) NOT NULL,
  `tools_image` varchar(255) NOT NULL,
  `tools_structure` varchar(255) NOT NULL,
  `tools_coef` int(11) NOT NULL,
  `tools_slot` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Дамп данных таблицы `data_tools`
--

INSERT INTO `data_tools` (`tools_id`, `tools_name`, `tools_image`, `tools_structure`, `tools_coef`, `tools_slot`) VALUES
(1, 'hammer', 'hammer.jpg', 'hard_crystal_wood', 2, 'any'),
(2, 'saw', 'saw.jpg', 'hard_crystal_wood', 3, 'any'),
(3, 'showel', 'showel.jpg', 'hard_crystal_wood', 3, 'two_hand'),
(4, 'axe', 'axe.jpg', 'hard_crystal_wood', 3, 'any');

-- --------------------------------------------------------

--
-- Структура таблицы `data_weapon`
--

CREATE TABLE `data_weapon` (
  `weapon_id` int(11) NOT NULL,
  `weapon_name` varchar(255) NOT NULL,
  `weapon_image` varchar(255) NOT NULL,
  `weapon_structure` varchar(255) NOT NULL,
  `weapon_coef` int(11) NOT NULL,
  `weapon_slot` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='100-1000 овечают за structure 1000-10000 отвечают за смысловую нагрузку при крафте' ROW_FORMAT=COMPACT;

--
-- Дамп данных таблицы `data_weapon`
--

INSERT INTO `data_weapon` (`weapon_id`, `weapon_name`, `weapon_image`, `weapon_structure`, `weapon_coef`, `weapon_slot`) VALUES
(1201, 'knife', 'knife.jpg', 'hard_crystal', 10, 'any'),
(1202, 'short sword', 'short_sword.jpg', 'hard_crystal', 50, 'any'),
(1203, 'sword', 'sword.jpg', 'hard_crystal', 100, 'right'),
(1204, 'long sword', 'long_sword.jpg', 'hard_crystal', 150, 'right'),
(1205, 'two handed sword', 'two_handed_sword.jpg', 'hard_crystal', 200, 'two_hand'),
(2301, 'short bow', 'short_bow.jpg', 'hard_wood', 50, 'two_hand'),
(2302, 'bow', 'bow.jpg', 'hard_wood', 100, 'two_hand'),
(2303, 'long bow', 'long_bow.jpg', 'hard_wood', 150, 'two_hand'),
(2304, 'arbalet', 'arbalet.jpg', 'hard_wood', 150, 'two_hand'),
(2305, 'heavy arbalet', 'heavy_arbalet.jpg', 'hard_wood', 200, 'two_hand'),
(3201, 'pike', 'pike.jpg', 'hard_crystal', 150, 'two_hand'),
(3203, 'harpoon', 'harpoon.jpg', 'hard_crystal', 160, 'two_hand'),
(4201, 'hammer', 'hammer.jpg', 'hard_crystal', 120, 'two_hand'),
(4202, 'huge hammer', 'huge_hammer.jpg', 'hard_crystal', 180, 'two_hand'),
(5201, 'small axe', 'small_axe.jpg', 'hard_crystal', 60, 'any'),
(5202, 'axe', 'axe.jpg', 'hard_crystal', 110, 'right'),
(5203, 'big axe', 'big_axe.jpg', 'hard_crystal', 170, 'two_hand'),
(6201, 'arrow', 'arrow.jpg', 'hard_crystal', 5, 'any'),
(7101, 'staff', 'staff.jpg', 'hard_crystal_wood', 100, 'two_hand'),
(8401, 'book', 'book.jpg', 'wood', 50, 'any'),
(9101, 'shield', 'shield.jpg', 'hard_crystal_wood', 100, 'left'),
(9102, 'tower shiel', 'tower_shield.jpg', 'hard_crystal_wood', 250, 'two_hand');

-- --------------------------------------------------------

--
-- Структура таблицы `reg_users`
--

CREATE TABLE `reg_users` (
  `id` int(11) NOT NULL,
  `login` varchar(25) NOT NULL,
  `password` varchar(25) NOT NULL,
  `user_name` varchar(25) NOT NULL,
  `user_mail` varchar(64) NOT NULL,
  `date_reg` datetime NOT NULL,
  `date_last` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `reg_users`
--

INSERT INTO `reg_users` (`id`, `login`, `password`, `user_name`, `user_mail`, `date_reg`, `date_last`) VALUES
(24, 'YWFhYQ==', 'YWFhYQ==', 'aaaa', 'aaaa', '2017-07-01 22:49:27', '0000-00-00 00:00:00'),
(25, '0JLQuNC60YLQvtGA', '0JvRg9C60YzRj9C90YfQtdC90', 'Виктор', 'lucas666@mail.ru', '2017-07-02 17:33:30', '0000-00-00 00:00:00'),
(26, 'bW9uZ28=', 'dmp5dWVjbg==', 'Константин', 'mongo@mail.ru', '2017-07-07 07:15:03', '0000-00-00 00:00:00'),
(27, '0JPQvtGA0LTRi9C5INC60L7Rg', 'S2VybXp5eHR5cmo=', 'Виктор', 'lucas666@mail.ru', '2017-07-07 07:44:45', '0000-00-00 00:00:00'),
(28, '0JPQvtGA0LTRi9C5INC60L7Rg', 'S2VybXp5eHR5cmo=', 'Виктор', 'lucas666@mail.ru', '2017-07-07 07:45:19', '0000-00-00 00:00:00'),
(29, 'VmljdG9y', 'S2VybXp5eHR5cmo=', 'Виктор', 'lucas666@mail.ru', '2017-07-07 08:27:45', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Структура таблицы `user_aaaa`
--

CREATE TABLE `user_aaaa` (
  `cell_id` int(11) NOT NULL,
  `item_name` varchar(255) NOT NULL,
  `item_count` int(11) NOT NULL,
  `item_coef` int(11) NOT NULL,
  `item_type` varchar(255) NOT NULL,
  `item_structure` varchar(255) NOT NULL,
  `health` int(11) NOT NULL,
  `health_max` int(11) NOT NULL,
  `item_image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `user_aaaa`
--

INSERT INTO `user_aaaa` (`cell_id`, `item_name`, `item_count`, `item_coef`, `item_type`, `item_structure`, `health`, `health_max`, `item_image`) VALUES
(1, 'paper', 1, 87, 'component', 'wood', 0, 0, 'paper.jpg'),
(2, 'tile', 1, 25, 'component', 'crystal', 0, 0, 'tile.jpg'),
(3, 'mixture', 1, 40, 'component', 'liqid', 0, 0, 'mixture.jpg'),
(4, 'mixture', 1, 46, 'component', 'liqid', 0, 0, 'mixture.jpg'),
(5, 'twine', 1, 38, 'component', 'fibre', 0, 0, 'twine.jpg'),
(6, 'wood block', 2, 5, 'component', 'wood', 0, 0, 'wood_block.jpg'),
(7, 'mixture', 1, 44, 'component', 'liqid', 0, 0, 'mixture.jpg'),
(8, 'mixture', 1, 30, 'component', 'liqid', 0, 0, 'mixture.jpg'),
(9, 'wood block', 2, 3, 'component', 'wood', 0, 0, 'wood_block.jpg'),
(10, 'wood block', 1, 6, 'component', 'wood', 0, 0, 'wood_block.jpg'),
(11, 'mixture', 1, 49, 'component', 'liqid', 0, 0, 'mixture.jpg'),
(12, 'cord', 1, 2, 'component', 'fibre', 0, 0, 'cord.jpg'),
(13, 'mixture', 1, 37, 'component', 'liqid', 0, 0, 'mixture.jpg'),
(14, 'hammer head', 1, 43, 'component', 'hard_crystal', 0, 0, 'hammer_head.jpg'),
(15, 'small wood block', 1, 21, 'component', 'wood', 0, 0, 'small_wood_block.jpg'),
(16, 'rod', 1, 29, 'component', 'hard_crystal_wood', 0, 0, 'rod.jpg'),
(17, 'rod', 1, 18, 'component', 'hard_crystal_wood', 0, 0, 'rod.jpg'),
(18, 'mixture', 1, 42, 'component', 'liqid', 0, 0, 'mixture.jpg'),
(19, 'rod', 1, 25, 'component', 'hard_crystal_wood', 0, 0, 'rod.jpg'),
(20, 'blade', 1, 30, 'component', 'hard_crystal', 0, 0, 'blade.jpg');

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

--
-- Индексы таблицы `reg_users`
--
ALTER TABLE `reg_users`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `user_aaaa`
--
ALTER TABLE `user_aaaa`
  ADD UNIQUE KEY `cell_id` (`cell_id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `reg_users`
--
ALTER TABLE `reg_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
