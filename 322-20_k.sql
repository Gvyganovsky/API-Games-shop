-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Хост: localhost:3306
-- Время создания: Ноя 28 2023 г., 10:45
-- Версия сервера: 10.11.4-MariaDB-1:10.11.4+maria~ubu2004
-- Версия PHP: 8.1.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `322-20_k`
--

-- --------------------------------------------------------

--
-- Структура таблицы `category`
--

CREATE TABLE `category` (
  `id_category` int(11) NOT NULL,
  `category_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `category`
--

INSERT INTO `category` (`id_category`, `category_name`) VALUES
(1, 'Ролевые игры'),
(2, 'Спортивные игры'),
(3, 'Шутеры'),
(4, 'Многопользовательские игры'),
(5, 'Приключенческие игры');

-- --------------------------------------------------------

--
-- Структура таблицы `games`
--

CREATE TABLE `games` (
  `id_game` int(11) NOT NULL,
  `game_name` varchar(100) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `games`
--

INSERT INTO `games` (`id_game`, `game_name`, `price`, `category_id`, `description`, `image`) VALUES
(21, 'Assassin\'s Creed Valhalla', 49.99, 1, 'Assassin\'s Creed Valhalla — игра о викингах и их приключениях.', NULL),
(22, 'FIFA 22', 59.99, 2, 'FIFA 22 — футбольный симулятор с обновленными возможностями.', NULL),
(23, 'Cyberpunk 2077', 39.99, 4, 'Cyberpunk 2077 — ролевая игра о мире будущего и киберпространстве.', NULL),
(24, 'Red Dead Redemption 2', 59.99, 5, 'Red Dead Redemption 2 — западная эпическая игра о бандитах и приключениях.', NULL),
(26, 'The Last of Us Part II', 49.99, 5, 'The Last of Us Part II — игра о выживании в постапокалиптическом мире.', NULL),
(27, 'League of Legends', 0.00, 4, 'League of Legends — популярная многопользовательская онлайн-игра.', NULL),
(28, 'Call of Duty: Warzone', 0.00, 3, 'Call of Duty: Warzone — онлайн-шутер во вселенной Call of Duty.', NULL),
(29, 'Animal Crossing: New Horizons', 49.99, 5, 'Animal Crossing: New Horizons — игра о жизни на острове.', NULL),
(30, 'Hades', 25.00, 1, 'Hades — рогалик о греческом боге подземного мира.', NULL),
(35, 'asdsad', 23.23, 2, 'dsfagdssdf', NULL),
(36, 'asd', 12.12, 1, 'asd', 'asdf'),
(37, 'фыв', 12.00, 1, NULL, NULL),
(38, 'zzzzzzzz', 12.00, 1, 'asd', 'asdf');

-- --------------------------------------------------------

--
-- Структура таблицы `orders`
--

CREATE TABLE `orders` (
  `id_order` int(11) NOT NULL,
  `game_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `orders`
--

INSERT INTO `orders` (`id_order`, `game_id`, `user_id`) VALUES
(6, 21, 1),
(7, 22, 10),
(9, 21, 1),
(10, 21, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `password` varchar(100) NOT NULL,
  `token` varchar(255) DEFAULT NULL,
  `admin` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id_user`, `first_name`, `last_name`, `email`, `phone`, `password`, `token`, `admin`) VALUES
(1, 'asdfasf', 'asfasfasf', 'asdas@asd.ru', '88005553535', '$2y$13$OZPe2W2giIAHYHrgn.qvuuFXPVxqvlQfGeq9IgEMcAHPY7AQJ21QG', '-_N54ZI45qe34qMimXe_RHmYnddD0AdK', 1),
(2, 'asdfasf', 'asfasfasf', 'test@asd.ru', '88005553535', '$2y$13$nGhnJy17V1r7r2h1oQEbcut0HtdUx3SiKBApDOX./jhkde7/4Cmh6', 'MMF0A4NsD_9mdRZtwr3fBamFeMJwz6bZ', 0),
(3, 'sadfaxxxx', 'gasasxxxx', 'xxx@xx.ru', '89533626060', '$2y$13$VnVbEKlVI6WAXjHByG45iOi2TV6tn2NUhDJElqdqe3OB5vD1ZgXrS', '8LEwDKhdr3HPQm9SFnkb-t1JVVeSzmeN', 0),
(4, 'xxxxxxxxxxxx', 'xxxxxxxx', 'xxx@xx.xu', '89533626078', '$2y$13$NN6KOFj9blcazu0qyA2tIeILg6Ijj1Yz8PYzlVnUhU9b3p8gcv4S.', '4UGTNZ4JnOqe_3L0Kg4CC2OOspBH8ERM', 0),
(5, 'asdss', 'assssss', 'sasd@asd.ru', '89533626060', '$2y$13$YOvksVD9HMwlFCnZDWkDe.RdjaxL.8IIrZVjFTf/Fo/yRjRsLlYbW', 'WxhTdYbpKmkFGv-zPoRtuZH5FOJtuWb-', 0),
(7, 'asdssф', 'assssss', 'saasdsd@asd.ru', '89533626060', '$2y$13$cR9paoHLoyodC.ES2ck2QuuALgf07MRHIRHoY5vGkGTFEoaJnAXtG', '5LhFMlgbWUKWPjNqJHRHFD5QnhPvLsba', 0),
(9, 'asdssф', 'assssss', 'saasdasdsd@asd.ru', '89533626060', '$2y$13$1DKJnHlJgJMBu5EqUuO3RukRj0ZzUE47J7847nGwVTVN4FEUOAlbG', 'kJ0okbjmWHv7sGwl9htmmgKB6R8prxT_', 0),
(10, 'asdssф', 'assssss', 'sd@asd.ru', '89533626060', '$2y$13$ibCHWogkkTodIyKjOPHsTuZBil0/FnoYnCt3mWKLgb5VTQQnxyGmu', '5GDyM2LdYubQUpRz7_jtpc0gVxxbxElo', 0),
(11, 'ssss', 'sssssssssssssssssssss', 'ssss@sss.ru', '88888888888', '$2y$13$kwWzvtXzTd1Ry5d7Hhof3u/YOCyecsWBUtUvdTzQ8p8eSPALB7w1q', 'JkdfrF5Cig32TWYk_sUOvhZNrNQye5Gn', 0),
(12, 'ssssasd', 'ssssssssssssssssss', 'ssasasddss@sssads.ru', '89523455753', '$2y$13$5QG4JPd1PujQuxE7XbUD9ugBXrgSDhKv5xICNrNlxPeoHU.ZGOSca', 'OdXense98vzwuszojF8Js04sLB_SlTAz', 0),
(13, 'ssssasdasd', 'ssssssssssssssssssasd', 'ssasasasdddss@sssads.ru', '89523455752', '$2y$13$nWb75t41K4g0.sTkgl4tV.ZFzYIYb/Plx59vuLUQbTdBDPMmRJkCa', '-48szCqg81JVVH_BmVSla-6R72G_fs2l', 0),
(17, 'ssssasdasd', 'sssssssssssasd', 'sdss@ssds.ru', '89523455752', '$2y$13$LipyvhmDAarEqIjCUJn2WOXOIlqWoiofive6LtBy8gV03i8VyRPeG', '8IgFCQ_hemS8WO9AqJQ5IWu01zI8lrr6', 0),
(18, 'assa', 'asas', 'asdasdss@ssds.ru', '89523455721', '$2y$13$5VMxEXQW6yNH94AucvfsjOy7c5rjb7C40x6B7zikpkXDlfBX3s8ce', 'Z42ZmMa5hOVDTWDo0iavMPrh0dHB2BsM', 0),
(20, 'assa', 'asas', 'asdass@ssds.ru', '89523455721', '$2y$13$ggVwH71P6m5/WI9EJwOamOuhhPPbEYrNjo25RhoSrZVCNNQV.jTVe', 'y_EF2yDTsh5wuX6iE5HpwVK5mqR8JrcM', 0),
(21, NULL, NULL, 'asdf@asd.ru', NULL, '$2y$13$1oplk2KV61AYymRLX7buMeOspZAGcnoR/TFZZ2pkcicwCw.L06Gu6', 'OYMwxgl0GU3vJTkjFMQhUOEj2TiPUX7o', 0),
(23, NULL, NULL, 'agggsdf@asd.ru', NULL, '$2y$13$uI3zV/YjDV5vrAi.jtcY4OV89gJILK5G8H77I65jGXHgZjCzB0XuS', '_YnEonYKCbpYBvi5WokkBQrue7G8RTSF', 0),
(28, NULL, NULL, 'zzzz@zz.zu', NULL, '$2y$13$42QcJ.QrYk1wEllAZrmZE.xQqAzSfrbpX9M2EDA8dBCN6XpTxl9uW', '9669wDpQxuKHoY1QUNSKSZ6SAH3HBp1Y', 0);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id_category`);

--
-- Индексы таблицы `games`
--
ALTER TABLE `games`
  ADD PRIMARY KEY (`id_game`),
  ADD KEY `category_id` (`category_id`);

--
-- Индексы таблицы `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id_order`),
  ADD KEY `game_id` (`game_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `category`
--
ALTER TABLE `category`
  MODIFY `id_category` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `games`
--
ALTER TABLE `games`
  MODIFY `id_game` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT для таблицы `orders`
--
ALTER TABLE `orders`
  MODIFY `id_order` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `games`
--
ALTER TABLE `games`
  ADD CONSTRAINT `games_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `category` (`id_category`);

--
-- Ограничения внешнего ключа таблицы `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`game_id`) REFERENCES `games` (`id_game`),
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id_user`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
