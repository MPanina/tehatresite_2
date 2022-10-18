-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Окт 19 2022 г., 01:32
-- Версия сервера: 8.0.30
-- Версия PHP: 8.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `theatresite2`
--

-- --------------------------------------------------------

--
-- Структура таблицы `direction`
--

CREATE TABLE `direction` (
  `id` int NOT NULL,
  `dir_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `direction`
--

INSERT INTO `direction` (`id`, `dir_name`) VALUES
(1, 'Зал'),
(2, 'Балкон');

-- --------------------------------------------------------

--
-- Структура таблицы `poster`
--

CREATE TABLE `poster` (
  `id` int NOT NULL,
  `img` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `place` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `poster`
--

INSERT INTO `poster` (`id`, `img`, `name`, `place`) VALUES
(1, 'gdedima.jpg\r\n', 'Спектакль &quot;Поиски Иванова&quot;', 'ДК Октябрь'),
(2, 'durka.jpg', 'Спектакль &quot;Палата Бизнес-Класса&quot;', 'ДК Октябрь'),
(3, 'dom.jpg', 'Спектакль &quot;Возвращение Домой&quot;', 'Центральный Концертный Зал'),
(4, 'lebedi2.jpg', 'Балет &quot;Борьба Двух Оленей&quot;', '&quot;Царицынская опера&quot;\r\n');

-- --------------------------------------------------------

--
-- Структура таблицы `row`
--

CREATE TABLE `row` (
  `id` int NOT NULL,
  `row_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `row`
--

INSERT INTO `row` (`id`, `row_name`) VALUES
(1, '1'),
(2, '2'),
(3, '3'),
(4, '4'),
(5, '5'),
(6, '6'),
(7, '7'),
(8, '8');

-- --------------------------------------------------------

--
-- Структура таблицы `sits`
--

CREATE TABLE `sits` (
  `id` int NOT NULL,
  `id_timetable` int NOT NULL,
  `sit_num` varchar(255) NOT NULL,
  `sit_status` varchar(255) NOT NULL,
  `id_direction` int NOT NULL,
  `id_row` int NOT NULL,
  `sit_price` varchar(255) NOT NULL,
  `reserved_by_id` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `sits`
--

INSERT INTO `sits` (`id`, `id_timetable`, `sit_num`, `sit_status`, `id_direction`, `id_row`, `sit_price`, `reserved_by_id`) VALUES
(1, 1, '1', 'свободное', 1, 1, '2500$', '');

-- --------------------------------------------------------

--
-- Структура таблицы `tickets`
--

CREATE TABLE `tickets` (
  `id` int NOT NULL,
  `id_timetable` int NOT NULL,
  `id_user` int NOT NULL,
  `id_sits` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `tickets`
--

INSERT INTO `tickets` (`id`, `id_timetable`, `id_user`, `id_sits`) VALUES
(2, 1, 1, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `timetable`
--

CREATE TABLE `timetable` (
  `id` int NOT NULL,
  `id_timetable` int NOT NULL,
  `id_poster` int NOT NULL,
  `date` varchar(255) NOT NULL,
  `time` varchar(255) NOT NULL,
  `price` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `timetable`
--

INSERT INTO `timetable` (`id`, `id_timetable`, `id_poster`, `date`, `time`, `price`) VALUES
(1, 1, 1, '28 Сентября ', '19:00\r\n', '1 000 — 2 500₽'),
(2, 0, 2, '10 Октября ', '19:00', '1 000 — 2 800₽'),
(3, 0, 3, '1 Сентября\r\n', '20:00', '250 — 1 500₽'),
(4, 0, 4, '3 Ноября', '19:00', '800 — 2 200₽\r\n');

-- --------------------------------------------------------

--
-- Структура таблицы `user`
--

CREATE TABLE `user` (
  `id` int NOT NULL,
  `login` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `user`
--

INSERT INTO `user` (`id`, `login`, `password`) VALUES
(1, 'dima', '$2y$10$E0/midggw.nmctxYwSgRsOyciZuxAvwS0hgq7IbcyeiWHmcEaA6cW');

-- --------------------------------------------------------

--
-- Структура таблицы `user_tickets`
--

CREATE TABLE `user_tickets` (
  `id_poster` int NOT NULL,
  `id_sit` int NOT NULL,
  `action_by` varchar(255) NOT NULL,
  `date` varchar(255) NOT NULL,
  `id_direction` int NOT NULL,
  `id_row` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `direction`
--
ALTER TABLE `direction`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `poster`
--
ALTER TABLE `poster`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `row`
--
ALTER TABLE `row`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `sits`
--
ALTER TABLE `sits`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `tickets`
--
ALTER TABLE `tickets`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `timetable`
--
ALTER TABLE `timetable`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `direction`
--
ALTER TABLE `direction`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `poster`
--
ALTER TABLE `poster`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `row`
--
ALTER TABLE `row`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT для таблицы `sits`
--
ALTER TABLE `sits`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `tickets`
--
ALTER TABLE `tickets`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `timetable`
--
ALTER TABLE `timetable`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `user`
--
ALTER TABLE `user`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
