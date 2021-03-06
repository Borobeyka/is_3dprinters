-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Хост: localhost
-- Время создания: Июн 16 2020 г., 12:30
-- Версия сервера: 5.7.23-24
-- Версия PHP: 7.1.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `u0991801_default`
--

-- --------------------------------------------------------

--
-- Структура таблицы `carts`
--

CREATE TABLE `carts` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `summ` int(11) NOT NULL DEFAULT '0',
  `count` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `carts`
--

INSERT INTO `carts` (`id`, `user_id`, `summ`, `count`) VALUES
(1, 2, 0, 0),
(2, 1, 499, 1),
(3, 4, 0, 0),
(4, 5, 0, 0),
(6, 7, 0, 0),
(7, 20, 0, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `cart_details`
--

CREATE TABLE `cart_details` (
  `id` int(11) NOT NULL,
  `cart_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `count` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `cart_details`
--

INSERT INTO `cart_details` (`id`, `cart_id`, `item_id`, `count`) VALUES
(86, 2, 1, 1);

--
-- Триггеры `cart_details`
--
DELIMITER $$
CREATE TRIGGER `add_cart_count` AFTER INSERT ON `cart_details` FOR EACH ROW UPDATE
	carts as c
SET
	c.count = c.count + 1
WHERE
	c.id = NEW.cart_id
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `add_cart_summ` AFTER INSERT ON `cart_details` FOR EACH ROW UPDATE
	carts
SET
	summ = summ + (
        SELECT
        	price
        FROM
        	item_price
        WHERE
        	item_price.item_id = NEW.item_id
    )
WHERE
	carts.id = NEW.cart_id
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `sub_cart_count` BEFORE DELETE ON `cart_details` FOR EACH ROW UPDATE
	carts as c
SET
	c.count = c.count - OLD.count
WHERE
	c.id = OLD.cart_id
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `sub_cart_summ` BEFORE DELETE ON `cart_details` FOR EACH ROW UPDATE
	carts
SET
	summ = summ - (
        SELECT
        	price
        FROM
        	item_price
        WHERE
        	item_price.item_id = OLD.item_id
    ) * OLD.count
WHERE
	carts.id = OLD.cart_id
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Структура таблицы `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(32) NOT NULL,
  `title` varchar(32) NOT NULL,
  `image` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `categories`
--

INSERT INTO `categories` (`id`, `name`, `title`, `image`) VALUES
(1, 'electronic', 'Электроника', 'electronic.png'),
(2, 'mechanic', 'Механика', 'mechanical.png'),
(3, 'extruders', 'Экструдеры', 'extruders.png');

-- --------------------------------------------------------

--
-- Структура таблицы `items`
--

CREATE TABLE `items` (
  `id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `title` varchar(64) NOT NULL,
  `description` varchar(2048) NOT NULL DEFAULT 'Описание отсутствует',
  `image` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `items`
--

INSERT INTO `items` (`id`, `category_id`, `title`, `description`, `image`) VALUES
(1, 3, 'Экструдер direct', 'Описание отсутствует', 'pic1.jpg'),
(2, 2, 'Подшипник LM8UU', 'Описание отсутствует', 'pic2.jpg'),
(3, 2, 'Приводной ремень GT2', 'Описание отсутствует', 'pic3.jpg'),
(4, 2, 'Пружина натяжения ремня 6мм', 'Описание отсутствует', 'pic4.jpg'),
(5, 2, 'Пружина регулировки горячего стола', 'Описание отсутствует', 'pic5.jpg'),
(6, 2, 'Ролик для ремня GT2', 'Описание отсутствует', 'pic6.jpg'),
(7, 2, 'Гайка 8 мм ходового винта, шаг 8 мм', 'Материал: латунь;\r\nДиаметр резьбы: 8 мм;\r\nШаг: 8 мм.\r\nЗаходность: 4 мм;\r\nХод: 8 мм.', 'pic7.jpg'),
(9, 2, 'Гайка 10 мм ходового винта, шаг 2 мм', 'Материал: латунь;\r\nДиаметр резьбы: 8 мм;\r\nШаг: 2 мм.\r\nЗаходность: 4 мм;\r\nХод: 8 мм.', 'pic8.jpg'),
(10, 2, 'Трапецеидальный винт Т8 250 мм', 'Винт изготовлен из высококачественной нержавеющей стали;\r\nДиаметр винта: 8 мм;\r\nПрофиль резьбы имеет трапецеидальную форму;\r\nШаг: 2 мм;\r\nЗаходность: 4;\r\nХод: 8 мм ( за одни оборот винта гайка продет 8 мм );\r\nДлина: 250 мм.', 'pic9.jpg'),
(11, 2, 'Трапецеидальный винт Т8 500 мм', 'Винт изготовлен из высококачественной нержавеющей стали;\r\nДиаметр винта: 8 мм;\r\nПрофиль резьбы имеет трапецеидальную форму;\r\nШаг: 2 мм;\r\nЗаходность: 4;\r\nХод: 8 мм ( за одни оборот винта гайка продет 8 мм );\r\nДлина: 300 мм;', 'pic10.jpg'),
(12, 2, 'Зубчатое колесо экструдера MK8 26 зубьев', 'Материал: латунь;\r\nКоличество зубов: 26 шт;\r\nВнутренний диаметр: 5 мм;\r\nВнешний диаметр: 11 мм;\r\nДлина: 11 мм;\r\nПрижимной винт: 3 мм;', 'pic11.jpg'),
(13, 2, 'Зубчатое колесо с выемкой 1.75 мм, внутренний 8 мм', 'Описание отсутствует', 'pic12.jpg'),
(14, 2, 'Зубчатое колесо с выемкой 3 мм, внутренний 8 мм', 'Зубчатое колесо с выемкой 3 мм, внутренний 8 мм', 'pic13.jpg'),
(20, 1, 'Нагреватель высокотемпературный 12V 50W', 'Описание отсутствует', 'c70b112f03eb49403ff5c8b243592838ba872269e51f16257168eb7e2bbb8f0d.jpg'),
(21, 1, 'Нагреватель высокотемпературный 24V 50W', 'Описание отсутствует', '081fd2f8d2468db1ba02c42813072f8cf0774e2708159d4b0d5a8296f648d67c.jpg'),
(22, 1, 'Керамический нагревательный элемент 12В', 'Материал: Нержавеющая сталь, ПВХ, нейлон;\r\nНапряжение: 12 В;\r\nМощность: 40 Вт;\r\nДлина провода: 1 м;\r\nРазмер нагревателя: 6 х 20 мм.', 'e0d4f577b369e9bf4afd8e589d69486b9cb2a740e40dca453af5d07fed470fcb.jpg'),
(23, 1, 'Керамический нагревательный элемент 24В', 'Материал: Нержавеющая сталь, ПВХ, нейлон;\r\nНапряжение: 24 В;\r\nМощность: 40 Вт;\r\nДлина провода: 1 м;\r\nРазмер нагревателя: 6 х 20 мм.', '9b51571d3dff75ed104ff523e185ee39e387d48f5e85ac06e42ea2f7c9598527.jpg'),
(24, 1, 'Шаговый двигатель nema 17 17HS40005', 'Описание отсутствует', 'ee171f0b13d05171caba7c930a1af2d7386cb81a81313f34bd81ecbf7adf4027.jpg'),
(25, 1, 'Шнур питания европейского стандарта 220V 1 м', 'Описание отсутствует', 'bfd342632eab84c0a5a701f57d20010539ce402c9237191774c97071d575d1d1.jpg'),
(26, 1, 'Кабель usb A - usb B для arduino', 'Тип: USB 2.0;\r\nДлина: 20 см.', '0e8e5ba0cc13b216343fa0cce16d72d85c74e09ac1e1e026d179ffc12d81baee.jpg'),
(27, 1, 'Алюминиевый нагревательный стол MK3 328x328x3 мм 24V', 'Описание отсутствует', 'ac55944fe1b67e941fbd6f9f8cb15009161e91524a234b08d186376eff63a007.jpg'),
(28, 1, 'Твердотельное реле MGR-1 D4860', 'Быстрая коммутация\r\nБыстрота реакции. При внезапном скачке разности потенциалов срабатывание элемента происходит всего через несколько миллисекунд\r\nБесшумность, очень тихая работа\r\nНезначительный уровень помех в момент подключения нагрузки\r\nЭкономичность, потребляет ничтожно малое количество электроэнергии\r\nНе имеет дребезжащих контактов и потенциальных источников искр\r\nСтойкость к вибрациям\r\nВысокая степень изоляции соединений', '04807d540397b87c52a1387fcd2e8105908f9cdc65b5e623ec2cdc255f66df07.jpg'),
(29, 3, 'Экструдер E3D-V6 Bowden для 3D-принтера', 'Материал: металл;\r\nТемпература сопла: до 260 ℃;\r\nДиаметр сопла: 0.4 мм;\r\nВходное напряжение: 12В;\r\nДиаметр нити: 1.75mm;\r\nОхлаждающий вентилятор: 12В;\r\nНапряжение нагревателя: 12В;\r\nТермистор: NTC-термистор 3950 (100 кОм).', '4f14d3dc66ac97db968224435cbb873de37087f4a3532436915b90b27a2c6796.jpg'),
(30, 3, 'Экструдер Diamond', 'Радиаторы V6: 3 шт;\r\nНагреватель: 1 шт;\r\nТермистор NTC 3950: 1 шт;\r\nВентилятор 5010: 1 шт;\r\nВентилятор улитка: 1 шт;\r\nСистема обдува;\r\nЛатунное сопло (1.75/0.4).', 'b843201dc7cc844947a649487652174c3ddf93617efaf76f0a066c8295877889.jpg'),
(31, 3, 'Двойной экструдер MK8 для 3D-принтера', 'Описание отсутствует', '92daed6837d6c4141305e72cacabe8a7911d99fcfb862bc42a91499b7d1a790f.jpg');

-- --------------------------------------------------------

--
-- Структура таблицы `item_price`
--

CREATE TABLE `item_price` (
  `id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `old_price` int(11) NOT NULL DEFAULT '0',
  `date_change` date NOT NULL DEFAULT '1970-01-01'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `item_price`
--

INSERT INTO `item_price` (`id`, `item_id`, `price`, `old_price`, `date_change`) VALUES
(1, 1, 499, 799, '2020-04-16'),
(2, 2, 70, 0, '1970-01-01'),
(3, 3, 100, 120, '2020-03-21'),
(4, 4, 10, 0, '1970-01-01'),
(5, 5, 15, 0, '1970-01-01'),
(6, 6, 110, 170, '2020-03-15'),
(7, 7, 90, 0, '1970-01-01'),
(8, 9, 90, 0, '1970-01-01'),
(9, 10, 250, 0, '1970-01-01'),
(10, 11, 260, 290, '2020-03-26'),
(11, 12, 120, 150, '2020-03-26'),
(12, 13, 300, 0, '2020-05-15'),
(13, 14, 130, 0, '1970-01-01'),
(17, 20, 220, 0, '1970-01-01'),
(18, 21, 270, 0, '1970-01-01'),
(19, 22, 100, 0, '1970-01-01'),
(20, 23, 120, 0, '1970-01-01'),
(21, 24, 760, 800, '2020-03-26'),
(22, 25, 160, 200, '2020-03-26'),
(23, 26, 50, 0, '1970-01-01'),
(24, 27, 2000, 0, '1970-01-01'),
(25, 28, 550, 0, '1970-01-01'),
(26, 29, 900, 1200, '2020-03-26'),
(27, 30, 2000, 0, '1970-01-01'),
(28, 31, 3560, 3700, '2020-03-26');

--
-- Триггеры `item_price`
--
DELIMITER $$
CREATE TRIGGER `delete_item_from_cart` BEFORE DELETE ON `item_price` FOR EACH ROW DELETE FROM
	cart_details
WHERE
	cart_details.item_id = OLD.item_id
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `delete_item_from_cart_summ` AFTER DELETE ON `item_price` FOR EACH ROW UPDATE
	carts
SET
	summ = summ - (
        SELECT
        	price
        FROM
        	item_price
        WHERE
        	item_price.item_id = OLD.item_id
    )
WHERE
	1 = 1
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `update_cart_summ_after` AFTER UPDATE ON `item_price` FOR EACH ROW UPDATE
	carts as c
INNER JOIN cart_details cd ON cd.cart_id = c.id
SET
	c.summ = c.summ + (
        SELECT
        	price
        FROM
        	item_price
        WHERE
        	item_price.item_id = NEW.item_id
    )
WHERE
	NEW.item_id = cd.item_id
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `update_cart_summ_before` BEFORE UPDATE ON `item_price` FOR EACH ROW UPDATE
	carts as c
INNER JOIN cart_details cd ON cd.cart_id = c.id
SET
	c.summ = c.summ - (
        SELECT
        	price
        FROM
        	item_price
        WHERE
        	item_price.item_id = NEW.item_id
    )
WHERE
	NEW.item_id = cd.item_id
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Структура таблицы `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `summ` int(11) NOT NULL,
  `count` int(11) NOT NULL DEFAULT '1',
  `date` datetime NOT NULL,
  `status` varchar(64) NOT NULL DEFAULT 'В обработке'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `summ`, `count`, `date`, `status`) VALUES
(3, 1, 4250, 3, '2020-04-01 12:15:15', 'Выдан'),
(4, 1, 1080, 2, '2020-04-13 18:53:25', 'В обработке'),
(5, 1, 125, 1, '2020-04-18 10:36:36', 'Готов к выдаче'),
(6, 1, 2550, 2, '2020-04-18 20:15:12', 'В обработке'),
(7, 2, 245, 2, '2020-04-18 20:16:45', 'В обработке'),
(8, 4, 120, 1, '2020-04-22 17:42:01', 'В обработке'),
(10, 7, 160, 1, '2020-04-24 19:34:33', 'Выдан'),
(11, 1, 1497, 1, '2020-04-30 21:39:01', 'Готов к выдаче'),
(13, 20, 2900, 2, '2020-05-14 20:34:21', 'Готов к выдаче');

-- --------------------------------------------------------

--
-- Структура таблицы `order_details`
--

CREATE TABLE `order_details` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `count` int(11) NOT NULL DEFAULT '1',
  `title` varchar(64) NOT NULL,
  `price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `order_details`
--

INSERT INTO `order_details` (`id`, `order_id`, `item_id`, `count`, `title`, `price`) VALUES
(8, 3, 27, 1, 'Алюминиевый нагревательный стол MK3 328x328x3 мм 24V', 2000),
(9, 3, 30, 1, 'Экструдер Diamond', 2000),
(10, 3, 13, 2, 'Зубчатое колесо с выемкой 1.75 мм, внутренний 8 мм', 125),
(11, 4, 24, 1, 'Шаговый двигатель nema 17 17HS40005', 760),
(12, 4, 25, 2, 'Шнур питания европейского стандарта 220V 1 м', 160),
(14, 5, 13, 1, 'Зубчатое колесо с выемкой 1.75 мм, внутренний 8 мм', 125),
(15, 6, 27, 1, 'Алюминиевый нагревательный стол MK3 328x328x3 мм 24V', 2000),
(16, 6, 28, 1, 'Твердотельное реле MGR-1 D4860', 550),
(17, 7, 13, 1, 'Зубчатое колесо с выемкой 1.75 мм, внутренний 8 мм', 125),
(18, 7, 12, 1, 'Зубчатое колесо экструдера MK8 26 зубьев', 120),
(19, 8, 23, 1, 'Керамический нагревательный элемент 24В', 120),
(23, 10, 25, 1, 'Шнур питания европейского стандарта 220V 1 м', 160),
(24, 11, 1, 3, 'Экструдер direct', 499),
(26, 13, 30, 1, 'Экструдер Diamond', 2000),
(27, 13, 29, 1, 'Экструдер E3D-V6 Bowden для 3D-принтера', 900);

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(64) NOT NULL,
  `password` varchar(64) NOT NULL,
  `hash` varchar(64) NOT NULL,
  `ip` varchar(128) NOT NULL,
  `phone` varchar(16) NOT NULL,
  `name` varchar(32) NOT NULL,
  `surname` varchar(32) NOT NULL,
  `isAdmin` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `hash`, `ip`, `phone`, `name`, `surname`, `isAdmin`) VALUES
(1, 'dandr07@yandex.ru', '756bc47cb5215dc3329ca7e1f7be33a2dad68990bb94b76d90aa07f4e44a233a', '2b8ecf90b4fc2cc9c04ba8b72899c26df0e8c4d085a700f0a171371625bc9072', '46.242.9.156', '8(916)913-43-88', 'Данила', 'Малинкин', 1),
(2, 'tester@yandex.ru', 'dd041ff70fb948ec307d6694130596588b26e821c5591d2144578d326e8fa1eb', '43910e2a5a5ee4215a23daf4f93881778f42da4a7c4c940c5a97c989d42b6e05', '46.242.9.95', '8(999)888-77-66', 'Tester', 'Testerovich', 0),
(3, 'danila2202@gmail.com2', '173af653133d964edfc16cafe0aba33c8f500a07f3ba3f81943916910c257705', '1feb050a59635afcf161c832aaecfcacb4c925032d2750d69d6a054281d45359', '::1', '8(888)888-88-88', 'Test', 'Test', 0),
(4, 'daslef93@gmail.com', '83c6d39f4d235ba1f7013c3bb69cf3da556ae886f2c3c7ae23fb0eef2e7645d2', '062922b59f4e59b6910f129e6780161537034e388ae772ceb4e1e57d6919947f', '94.25.170.110', '8(964)523-76-74', 'Алексей', 'Трофимов', 0),
(5, 'privetmalina@mail.ru', '1af099c23bea870038a714577e2879f5cf448434d760074d0c1c7fef9f12a3c6', '8ae7f2c48f2006bf15b667792a10fc29c3765b5023205a99b0233b456596b428', '94.25.171.6', '8(398)423-47-82', 'Malina', 'Privet', 0),
(7, 'BlackBass1@yandex.ru', '1f4495cefc85c149627440a665de1f68f1cd6d03ffe147099701153f6988ce0d', '56e36164617a5e2227b7e37e9a35710e13438c5c68053826b97e6f3223ba079b', '178.140.174.47', '8(925)055-12-70', 'Саша', 'Бубнов', 0),
(17, 'katrin-m0903@yandex.ru', '173af653133d964edfc16cafe0aba33c8f500a07f3ba3f81943916910c257705', '0957daaf2f447f4c6c20a6f32517e7d7c552e2d8d2735164bd8a6c33cde22d6e', '46.242.9.95', '8(791)621-82-25', 'Екатерина', 'Малинкина', 0),
(20, 'trunov-2015@inbox.ru', '49dc52e6bf2abe5ef6e2bb5b0f1ee2d765b922ae6cc8b95d39dc06c21c848f8c', 'beeeb6cba982e5f99490b7973d9a88be61e6d01eaf7de51a0ef0ab69ca353574', '79.139.236.27', '8(967)134-79-94', 'Лешка', 'Пузарь', 0),
(22, 'altrunovvv@yandex.ru', '49dc52e6bf2abe5ef6e2bb5b0f1ee2d765b922ae6cc8b95d39dc06c21c848f8c', '923ab9bacd6cea483f859708b4303acfd663358085dc733010131b0dadbfa5eb', '79.139.236.27', '8(967)134-79-94', 'Lexa', 'Пузарь', 0);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Индексы таблицы `cart_details`
--
ALTER TABLE `cart_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `item_id` (`item_id`),
  ADD KEY `order_id` (`cart_id`);

--
-- Индексы таблицы `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`);

--
-- Индексы таблицы `item_price`
--
ALTER TABLE `item_price`
  ADD PRIMARY KEY (`id`),
  ADD KEY `item_id` (`item_id`);

--
-- Индексы таблицы `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Индексы таблицы `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `item_id` (`item_id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `carts`
--
ALTER TABLE `carts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT для таблицы `cart_details`
--
ALTER TABLE `cart_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=87;

--
-- AUTO_INCREMENT для таблицы `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `items`
--
ALTER TABLE `items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT для таблицы `item_price`
--
ALTER TABLE `item_price`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT для таблицы `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT для таблицы `order_details`
--
ALTER TABLE `order_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `carts`
--
ALTER TABLE `carts`
  ADD CONSTRAINT `carts_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Ограничения внешнего ключа таблицы `cart_details`
--
ALTER TABLE `cart_details`
  ADD CONSTRAINT `cart_details_ibfk_1` FOREIGN KEY (`item_id`) REFERENCES `items` (`id`),
  ADD CONSTRAINT `cart_details_ibfk_2` FOREIGN KEY (`cart_id`) REFERENCES `carts` (`id`);

--
-- Ограничения внешнего ключа таблицы `items`
--
ALTER TABLE `items`
  ADD CONSTRAINT `items_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`);

--
-- Ограничения внешнего ключа таблицы `item_price`
--
ALTER TABLE `item_price`
  ADD CONSTRAINT `item_price_ibfk_1` FOREIGN KEY (`item_id`) REFERENCES `items` (`id`);

--
-- Ограничения внешнего ключа таблицы `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Ограничения внешнего ключа таблицы `order_details`
--
ALTER TABLE `order_details`
  ADD CONSTRAINT `order_details_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`),
  ADD CONSTRAINT `order_details_ibfk_2` FOREIGN KEY (`item_id`) REFERENCES `items` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
