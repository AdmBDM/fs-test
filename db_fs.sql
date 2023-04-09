-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Апр 09 2023 г., 14:04
-- Версия сервера: 8.0.30
-- Версия PHP: 7.4.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `fs`
--
CREATE DATABASE IF NOT EXISTS `fs` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;
USE `fs`;

-- --------------------------------------------------------

--
-- Структура таблицы `migration`
--

CREATE TABLE `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `migration`
--

INSERT INTO `migration` (`version`, `apply_time`) VALUES
('m000000_000000_base', 1679407560),
('m130524_201442_init', 1679407563),
('m190124_110200_add_verification_token_column_to_user_table', 1679407563),
('m230316_163543_create_table_visit', 1679407563),
('m230321_125242_add_fields_to_user_table', 1679407563);

-- --------------------------------------------------------

--
-- Структура таблицы `user`
--

CREATE TABLE `user` (
  `id` int NOT NULL,
  `username` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `auth_key` varchar(32) COLLATE utf8mb3_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `discount` int DEFAULT '0',
  `is_staff` tinyint(1) NOT NULL DEFAULT '0',
  `is_admin` tinyint(1) NOT NULL DEFAULT '0',
  `is_manager` tinyint(1) NOT NULL DEFAULT '0',
  `status` smallint NOT NULL DEFAULT '10',
  `created_at` bigint NOT NULL,
  `updated_at` bigint NOT NULL,
  `verification_token` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Дамп данных таблицы `user`
--

INSERT INTO `user` (`id`, `username`, `auth_key`, `password_hash`, `password_reset_token`, `email`, `phone`, `discount`, `is_staff`, `is_admin`, `is_manager`, `status`, `created_at`, `updated_at`, `verification_token`) VALUES
(1, 'Jim7', 'oGv0C4FlbNUjgxHmXEXZr9b5tsOffi9k', '$2y$13$YUAGrypKjLeSqN1.Wq3kDOtGVGaVTB9eBw2fenw.kFIl2re57Yz3q', NULL, 'it@rfprt.ru', '+7', 0, 1, 1, 0, 10, 1680948929, 1680948929, NULL),
(2, 'New', 'GZa97X_zASEONGLIKmMzrewyi7auHZ1o', '$2y$13$WpV95UAjJ6yfD7UlvoE9Vuti/hU44X9ThbXLyup78b7xFJ56uRl2C', NULL, '11@gmail.com', '+7 (123) 456-7890', 0, 1, 0, 1, 10, 1680949151, 1680965262, NULL),
(12, 'NewUser', 'jy9hDDWJbbIpQk4UPJwyvNGBLlPkV-_u', '$2y$13$H0FaxJvwG3RTLv4HFDkGtO8DefPvsL3023Yq8DW7ZDC2Tod2qMCYi', NULL, 'jim7rfp@gmail.com', '+7 (012) 345-6789', 0, 1, 0, 0, 10, 1680957430, 1680964230, 'FOlxWMZHHMRJJT2ZsEkuUgAJwJgUFajq_1680957430'),
(13, 'Client 1', 'S2JL25zwzv7GTK-g6ucSuPe63D3oIs7S', '$2y$13$xZWGnx.nkjrg/8d4Udq5BuWyhPGmvFWjXitSQXO/J1Dpm79cRT3lS', NULL, '111@ru', '+7 (234) 567-8901', 0, 0, 0, 0, 10, 1681032700, 1681032700, 'QqPn3ic7wBew4rxDONXn1KLb9MNJ_s5E_1681032700'),
(14, 'Client 2', '15dlh0AJmWXT3wHQC2J3-NXWJINc3vZx', '$2y$13$YY2L4R2ATDg4goFq7jNByugu3/buuAFd7dMYrWju7chzec/8WKsOG', NULL, '11@ru', '+7 (345) 678-9012', 0, 0, 0, 0, 10, 1681032746, 1681032746, 'gOOwWeFxzoV6Q__REqAFnSSgJmuLyKF-_1681032746');

-- --------------------------------------------------------

--
-- Структура таблицы `visit`
--

CREATE TABLE `visit` (
  `id` int NOT NULL,
  `client_id` int NOT NULL,
  `staff_id` int NOT NULL,
  `visit_date` bigint NOT NULL,
  `visit_sum` float NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Дамп данных таблицы `visit`
--

INSERT INTO `visit` (`id`, `client_id`, `staff_id`, `visit_date`, `visit_sum`) VALUES
(1, 13, 2, 1681034795, 10);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `migration`
--
ALTER TABLE `migration`
  ADD PRIMARY KEY (`version`);

--
-- Индексы таблицы `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `phone` (`phone`),
  ADD UNIQUE KEY `password_reset_token` (`password_reset_token`);

--
-- Индексы таблицы `visit`
--
ALTER TABLE `visit`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `user`
--
ALTER TABLE `user`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT для таблицы `visit`
--
ALTER TABLE `visit`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- База данных: `gf`
--
CREATE DATABASE IF NOT EXISTS `gf` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;
USE `gf`;

-- --------------------------------------------------------

--
-- Структура таблицы `migration`
--

CREATE TABLE `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `migration`
--

INSERT INTO `migration` (`version`, `apply_time`) VALUES
('m000000_000000_base', 1674220886),
('m130524_201442_init', 1674220904),
('m190124_110200_add_verification_token_column_to_user_table', 1674220904),
('m230122_094741_add_is_admin_column_to_user_tabel', 1674381501);

-- --------------------------------------------------------

--
-- Структура таблицы `spr_medicines`
--

CREATE TABLE `spr_medicines` (
  `id` int NOT NULL,
  `medicine_name` varchar(255) NOT NULL,
  `many_other_params` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `spr_org`
--

CREATE TABLE `spr_org` (
  `id` int NOT NULL,
  `org_name` varchar(255) NOT NULL,
  `many_other_params` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `spr_pharmacy`
--

CREATE TABLE `spr_pharmacy` (
  `id` int NOT NULL,
  `pharmacy_name` varchar(255) NOT NULL,
  `many_other_params` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `user`
--

CREATE TABLE `user` (
  `id` int NOT NULL,
  `username` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `auth_key` varchar(32) COLLATE utf8mb3_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `status` smallint NOT NULL DEFAULT '10',
  `created_at` int NOT NULL,
  `updated_at` int NOT NULL,
  `verification_token` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `is_admin` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Дамп данных таблицы `user`
--

INSERT INTO `user` (`id`, `username`, `auth_key`, `password_hash`, `password_reset_token`, `email`, `status`, `created_at`, `updated_at`, `verification_token`, `is_admin`) VALUES
(1, 'Jim7', 'oGv0C4FlbNUjgxHmXEXZr9b5tsOffi9k', '$2y$13$YUAGrypKjLeSqN1.Wq3kDOtGVGaVTB9eBw2fenw.kFIl2re57Yz3q', NULL, 'jim7@mymail.ru', 10, 1530517416, 1640783648, NULL, 1),
(7, 'qqq', 'hTcupn35LbaWNepdvqaZk07JDWz8r1rf', '$2y$13$YUAGrypKjLeSqN1.Wq3kDOtGVGaVTB9eBw2fenw.kFIl2re57Yz3q', NULL, 'it1@rfprt.ru', 10, 1674475741, 1674475894, 'OrpVJyqVZGFl88tTjZ7SskQyWLAxkNY7_1674475740', 0),
(8, 'dd', 'WmdQ8xaPZwi5v4Q22M2Owi8XhlZYz2Uf', '$2y$13$0GtohJoX0yT9LO2Se4eFAOgaqRu4Ngtwhk11UY9SNoX0OGz9ei0z6', NULL, 'dd@ww.ru', 9, 1674488155, 1674488155, 'DvcnvE7OcWNkuBNiQOLFvilvx9u2Kl2L_1674488152', 0),
(9, 'NewJim7', '7Y1B7FGbDU_Ep5MsBqh2xlHYM8vBUc3v', '$2y$13$werKtv5.I.vSNbni5epbAOOJJDlcHmRie3Zm.o6f0YCH/ldFFbjcK', NULL, 'it@rfprt.ru', 10, 1674489437, 1674489484, 'NdAnFpl-Dh_SG5lWJhlaxlI96qrjSpo6_1674489435', 0),
(10, 'test', 'w8hlPh2p-Szt_uopSAo58JF-T04OUVp3', '$2y$13$C6HSvnPO5x53tZdu/pL7keQATBdYhbqwOZu67yYiSjUxhhcbSGTvW', 'EMAf4cO-cI5j0XlaJ-Nua5n_VuYMLZtG_1674572680', 'jim7kzn@gmail.com', 10, 1674571692, 1674572680, 'dwk6IIyqOypSFbcC7zuIlVgfbh-xA0WI_1674571688', 0);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `migration`
--
ALTER TABLE `migration`
  ADD PRIMARY KEY (`version`);

--
-- Индексы таблицы `spr_medicines`
--
ALTER TABLE `spr_medicines`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `spr_org`
--
ALTER TABLE `spr_org`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `spr_pharmacy`
--
ALTER TABLE `spr_pharmacy`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `password_reset_token` (`password_reset_token`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `spr_medicines`
--
ALTER TABLE `spr_medicines`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `spr_org`
--
ALTER TABLE `spr_org`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `spr_pharmacy`
--
ALTER TABLE `spr_pharmacy`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `user`
--
ALTER TABLE `user`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- База данных: `po`
--
CREATE DATABASE IF NOT EXISTS `po` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;
USE `po`;

-- --------------------------------------------------------

--
-- Структура таблицы `apple`
--

CREATE TABLE `apple` (
  `id` int NOT NULL,
  `tree_id` int DEFAULT '1',
  `createTime` int NOT NULL,
  `dropTime` int NOT NULL,
  `ruinTime` int NOT NULL,
  `coordX` int NOT NULL DEFAULT '0',
  `coordY` int NOT NULL DEFAULT '0',
  `radius` int NOT NULL DEFAULT '5',
  `color` varchar(7) COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT '#000000',
  `reminder` int NOT NULL DEFAULT '100',
  `status` int NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Дамп данных таблицы `apple`
--

INSERT INTO `apple` (`id`, `tree_id`, `createTime`, `dropTime`, `ruinTime`, `coordX`, `coordY`, `radius`, `color`, `reminder`, `status`) VALUES
(1, 1, 1678029536, 1678461536, 1678479536, 35, 91, 17, '#FF3300', 100, 0),
(2, 1, 1678029578, 1678279612, 1678297612, 113, 61, 18, '#FFFF00', 80, 2),
(3, 1, 1678187413, 1678619413, 1678637413, 60, 44, 10, '#FF9900', 100, 0),
(4, 1, 1678187431, 1678198421, 1678216481, 493, 79, 13, '#FF0000', 100, 2),
(5, 1, 1678270340, 1678702340, 1678720340, 224, 13, 9, '#FF9900', 100, 0),
(6, 1, 1678270572, 1678702572, 1678720572, 156, 70, 17, '#FF9900', 100, 0),
(7, 1, 1678363243, 1678795243, 1678813245, 105, 54, 13, '#FF9900', 100, 0),
(8, 1, 1678363258, 1678795258, 1678813260, 45, 51, 7, '#FF0000', 100, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `migration`
--

CREATE TABLE `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `migration`
--

INSERT INTO `migration` (`version`, `apply_time`) VALUES
('m000000_000000_base', 1677757506),
('m130524_201442_init', 1677758379),
('m190124_110200_add_verification_token_column_to_user_table', 1677758379),
('m230305_121054_create_apple_table', 1678022838),
('m230305_121134_create_tree_table', 1678022838),
('m230305_135645_add_tree_to_table', 1678025708);

-- --------------------------------------------------------

--
-- Структура таблицы `tree`
--

CREATE TABLE `tree` (
  `id` int NOT NULL,
  `nameTree` varchar(100) COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'Tree',
  `border` int NOT NULL DEFAULT '5',
  `xTreeFrom` int NOT NULL DEFAULT '0',
  `xTreeTo` int NOT NULL DEFAULT '100',
  `yTreeFrom` int NOT NULL DEFAULT '0',
  `yTreeTo` int NOT NULL DEFAULT '100'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Дамп данных таблицы `tree`
--

INSERT INTO `tree` (`id`, `nameTree`, `border`, `xTreeFrom`, `xTreeTo`, `yTreeFrom`, `yTreeTo`) VALUES
(1, 'Apple Tree', 5, 100, 600, 0, 100);

-- --------------------------------------------------------

--
-- Структура таблицы `user`
--

CREATE TABLE `user` (
  `id` int NOT NULL,
  `username` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `auth_key` varchar(32) COLLATE utf8mb3_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `is_admin` tinyint(1) NOT NULL DEFAULT '0',
  `status` smallint NOT NULL DEFAULT '10',
  `created_at` int NOT NULL,
  `updated_at` int NOT NULL,
  `verification_token` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Дамп данных таблицы `user`
--

INSERT INTO `user` (`id`, `username`, `auth_key`, `password_hash`, `password_reset_token`, `email`, `is_admin`, `status`, `created_at`, `updated_at`, `verification_token`) VALUES
(1, 'Jim7', 'oGv0C4FlbNUjgxHmXEXZr9b5tsOffi9k', '$2y$13$YUAGrypKjLeSqN1.Wq3kDOtGVGaVTB9eBw2fenw.kFIl2re57Yz3q', NULL, 'jim7@mymail.ru', 1, 10, 1530517416, 1640783648, NULL);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `apple`
--
ALTER TABLE `apple`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `migration`
--
ALTER TABLE `migration`
  ADD PRIMARY KEY (`version`);

--
-- Индексы таблицы `tree`
--
ALTER TABLE `tree`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `password_reset_token` (`password_reset_token`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `apple`
--
ALTER TABLE `apple`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT для таблицы `tree`
--
ALTER TABLE `tree`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `user`
--
ALTER TABLE `user`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
