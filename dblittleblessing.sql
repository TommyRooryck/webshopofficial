-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3308
-- Gegenereerd op: 10 jul 2020 om 13:51
-- Serverversie: 8.0.18
-- PHP-versie: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dblittleblessing`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `category`
--

DROP TABLE IF EXISTS `category`;
CREATE TABLE IF NOT EXISTS `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `super_category_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `super_category_id` (`super_category_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Gegevens worden geëxporteerd voor tabel `category`
--

INSERT INTO `category` (`id`, `name`, `description`, `super_category_id`) VALUES
(2, 'Dekentjes', 'Dekentjes in verschillende kleuren en textielen.', 3),
(3, 'Accessoires', 'Allerlei accessoires voor je eigen knuffel.', 4),
(4, 'Doudou', 'omom', 3),
(5, 'Geluiden', 'Geef elke knuffel een uniek geluid. ', 4),
(18, 'TEST EDITED SECOND TRY', 'TEST EDITED SECOND TRY', 10);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `customers`
--

DROP TABLE IF EXISTS `customers`;
CREATE TABLE IF NOT EXISTS `customers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `adress` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `postal_code` varchar(255) NOT NULL,
  `region` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `shipping_adress` varchar(255) NOT NULL,
  `shipping_city` varchar(255) NOT NULL,
  `shipping_postal_code` varchar(255) NOT NULL,
  `shipping_region` varchar(255) NOT NULL,
  `shipping_country` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Gegevens worden geëxporteerd voor tabel `customers`
--

INSERT INTO `customers` (`id`, `username`, `password`, `first_name`, `last_name`, `email`, `phone`, `adress`, `city`, `postal_code`, `region`, `country`, `shipping_adress`, `shipping_city`, `shipping_postal_code`, `shipping_region`, `shipping_country`) VALUES
(1, 'TommyR', 'kek', 'Tommy', 'Rooryck', 'tommy_rooryck@hotmail.com', '0476755659', 'Ellestraat 36', 'Gistel', '8470', 'West-Vlaanderen', 'België', 'Ellestraat 36', 'Gistel', '8470', 'West-Vlaanderen', 'België'),
(18, 'Tyeishav', 'Ikbencool1', 'Tyeisha', 'Vansevenhant', 'Tyeishav@hotmail.com', '0491 59 03 50', 'Guldensporenlaan 16', 'Oostende', '8400', 'West-Vlaanderen', 'België', 'Guldensporenlaan 16', 'Oostende', '8400', 'West-Vlaanderen', 'België'),
(19, 'TommyRooryck2', 'kek', '', '', 'tommy_rooryck@hotmail.com', '', '', '', '', '', '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `photos`
--

DROP TABLE IF EXISTS `photos`;
CREATE TABLE IF NOT EXISTS `photos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `filename` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `size` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `product_id` (`product_id`)
) ENGINE=InnoDB AUTO_INCREMENT=66 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Gegevens worden geëxporteerd voor tabel `photos`
--

INSERT INTO `photos` (`id`, `title`, `description`, `filename`, `type`, `size`, `product_id`) VALUES
(61, '', '', '0-02.jpg', 'image/jpeg', 676474, 22),
(62, '', '', '0-03.jpg', 'image/jpeg', 464272, 22);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `price` float NOT NULL,
  `stock` int(11) NOT NULL,
  `created_at` date NOT NULL,
  `product_placeholder` varchar(255) NOT NULL,
  `category_id` int(11) NOT NULL,
  `sub_category_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `category_id` (`category_id`),
  KEY `sub_category_id` (`sub_category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Gegevens worden geëxporteerd voor tabel `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `price`, `stock`, `created_at`, `product_placeholder`, `category_id`, `sub_category_id`) VALUES
(22, 'TEST', 'TEST', 4.5, 5, '2020-07-09', '0-01.jpg', 2, 0);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `sub_category`
--

DROP TABLE IF EXISTS `sub_category`;
CREATE TABLE IF NOT EXISTS `sub_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `category_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `category_id` (`category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Gegevens worden geëxporteerd voor tabel `sub_category`
--

INSERT INTO `sub_category` (`id`, `name`, `description`, `category_id`) VALUES
(5, 'TEST', 'TEST', 4),
(6, 'TEST', 'TEST', 5),
(7, 'TEST', 'TEST', 16),
(8, 'TEST', 'TEST', 4),
(9, 'TEST', 'TEST', 5),
(11, 'TEST', 'TEST', 4),
(12, 'TEST', 'TEST', 5),
(13, 'TEST EDITED SECOND TRY', 'TEST EDITED SECOND TRY', 18);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `super_category`
--

DROP TABLE IF EXISTS `super_category`;
CREATE TABLE IF NOT EXISTS `super_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Gegevens worden geëxporteerd voor tabel `super_category`
--

INSERT INTO `super_category` (`id`, `name`, `description`) VALUES
(3, 'Geschenkartikelen', 'Geschenkartikelen voor groot en klein.'),
(4, 'Maak je eigen knuffel', 'Maak je eigen knuffel aan de hand van kledij, accessoires en geluiden.'),
(10, 'TEST', 'TEST');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Gegevens worden geëxporteerd voor tabel `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `username`, `password`, `role`) VALUES
(2, 'Tommy', 'Rooryck', 'TommyRooryck', 'lol', 'Admin'),
(3, 'Wendy', 'Vanwelssenaers', 'Wienababy', 'Tequila-baby1', 'Owner');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
