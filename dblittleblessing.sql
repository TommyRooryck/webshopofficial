-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3308
-- Gegenereerd op: 24 jul 2020 om 15:59
-- Serverversie: 8.0.18
-- PHP-versie: 7.4.0

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
-- Tabelstructuur voor tabel `attributes`
--

DROP TABLE IF EXISTS `attributes`;
CREATE TABLE IF NOT EXISTS `attributes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Gegevens worden geëxporteerd voor tabel `attributes`
--

INSERT INTO `attributes` (`id`, `name`) VALUES
(23, 'Kleur'),
(24, 'Lettertype'),
(25, 'Textiel');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `attribute_values`
--

DROP TABLE IF EXISTS `attribute_values`;
CREATE TABLE IF NOT EXISTS `attribute_values` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `attribute_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `attribute_id` (`attribute_id`)
) ENGINE=MyISAM AUTO_INCREMENT=87 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Gegevens worden geëxporteerd voor tabel `attribute_values`
--

INSERT INTO `attribute_values` (`id`, `name`, `attribute_id`) VALUES
(80, 'PN Boogie Woogie', 24),
(79, 'Moonchild', 24),
(78, 'Magical Duo', 24),
(77, 'Lucida Handwriting', 24),
(76, 'Impact', 24),
(75, 'Comic Sans', 24),
(70, 'Bruin', 23),
(68, 'Rood', 23),
(69, 'Blauw', 23),
(74, 'Charline', 24),
(73, 'Violet', 23),
(72, 'Oranje', 23),
(71, 'Groen', 23),
(81, 'ZP Watcha Doing', 24),
(82, 'Silk', 25),
(83, 'Leather', 25);

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
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Gegevens worden geëxporteerd voor tabel `category`
--

INSERT INTO `category` (`id`, `name`, `description`, `super_category_id`) VALUES
(25, 'Dekentjes', 'Dekentjes in alle soorten textielen en kleuren.', 15),
(26, 'Doudou', 'Doudou\'s voor de kinderen.', 15),
(27, 'Eten en Drinken', 'Allerlei accessoires om te lunchen voor je kind.', 15),
(28, 'Flesverpakking', 'Verpakking voor wijnflessen.', 15),
(29, 'Kinderkoffers', 'Kinderkoffertjes voor grote en kleine kinderen.', 15),
(30, 'Metalen Dozen', 'Metalen doosjes om allerlei gerief in op te bergen.', 15),
(31, 'Snoepbokalen', 'Bokalen om snoep in te houden.', 15),
(32, 'Spaarpotten', 'Al je geld zit veilig verborgen in deze spaarpotten.', 15),
(33, 'Speelgoed', 'Allerlei speelgoed', 15),
(34, 'Tassen', 'Tassen voor groot en klein.', 15),
(35, 'Accessoires', 'Accessoires voor je eigen gemaakte knuffel.', 16),
(36, 'Geluiden', 'Geluiden voor je knuffel.', 16),
(37, 'Kledij', 'Kledij voor je knuffel.', 16),
(38, 'Knuffels', 'Kies uit een assortiment van knuffels om deze dan te gaan personaliseren aan de hand van kledij, geluiden en nog zoveel meer.', 16),
(39, 'Schoenen', 'Schoenen voor je eigen gemaakte knuffel.', 16),
(40, 'Rubens Barn', 'Poppen van het topmerk Rubens Barn.', 17);

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
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Gegevens worden geëxporteerd voor tabel `customers`
--

INSERT INTO `customers` (`id`, `username`, `password`, `first_name`, `last_name`, `email`, `phone`, `adress`, `city`, `postal_code`, `region`, `country`, `shipping_adress`, `shipping_city`, `shipping_postal_code`, `shipping_region`, `shipping_country`) VALUES
(1, 'TommyR', 'kek', 'Tommy', 'Rooryck', 'tommy_rooryck@hotmail.com', '0476755659', 'Ellestraat 36', 'Gistel', '8470', 'West-Vlaanderen', 'België', 'Ellestraat 36', 'Gistel', '8470', 'West-Vlaanderen', 'België'),
(18, 'Tyeishav', 'Ikbencool1', 'Tyeisha', 'Vansevenhant', 'Tyeishav@hotmail.com', '0491 59 03 50', 'Guldensporenlaan 16', 'Oostende', '8400', 'West-Vlaanderen', 'België', 'Guldensporenlaan 16', 'Oostende', '8400', 'West-Vlaanderen', 'België');

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
) ENGINE=InnoDB AUTO_INCREMENT=116 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Gegevens worden geëxporteerd voor tabel `photos`
--

INSERT INTO `photos` (`id`, `title`, `description`, `filename`, `type`, `size`, `product_id`) VALUES
(111, '', '', '0-02.jpg', 'image/jpeg', 676474, 42),
(112, '', '', '0-03.jpg', 'image/jpeg', 464272, 42),
(113, '', '', '0-04.jpg', 'image/jpeg', 302574, 42),
(114, '', '', '15-20.jpg', 'image/jpeg', 800055, 42),
(115, '', '', '15-30.jpg', 'image/jpeg', 691902, 42);

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
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Gegevens worden geëxporteerd voor tabel `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `price`, `stock`, `created_at`, `product_placeholder`, `category_id`, `sub_category_id`) VALUES
(42, 'TEST', 'te', 4.5, 5, '2020-07-17', '0-01.jpg', 25, 0);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `specific_product`
--

DROP TABLE IF EXISTS `specific_product`;
CREATE TABLE IF NOT EXISTS `specific_product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `attribute_id` int(11) NOT NULL,
  `attribute_values_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `attribute_values_id` (`attribute_values_id`),
  KEY `product_id` (`product_id`),
  KEY `attribute_id` (`attribute_id`)
) ENGINE=InnoDB AUTO_INCREMENT=197 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Gegevens worden geëxporteerd voor tabel `specific_product`
--

INSERT INTO `specific_product` (`id`, `attribute_id`, `attribute_values_id`, `product_id`) VALUES
(179, 23, 70, 42),
(180, 0, 0, 42),
(181, 24, 68, 42),
(182, 0, 0, 42),
(183, 0, 69, 42),
(184, 0, 0, 42),
(185, 0, 0, 42),
(186, 0, 0, 42),
(187, 0, 0, 42),
(188, 0, 80, 42),
(189, 0, 0, 42),
(190, 0, 0, 42),
(191, 0, 0, 42),
(192, 0, 0, 42),
(193, 0, 0, 42),
(194, 0, 0, 42),
(195, 0, 0, 42),
(196, 0, 0, 42);

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
) ENGINE=InnoDB AUTO_INCREMENT=52 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Gegevens worden geëxporteerd voor tabel `sub_category`
--

INSERT INTO `sub_category` (`id`, `name`, `description`, `category_id`) VALUES
(45, 'Brooddozen', 'Brooddozen', 27),
(46, 'Drinkflessen', 'Drinkflessen', 27),
(47, 'Slabbetjes', 'Slabbetjes', 27),
(48, 'Stapeltoren', 'Stapeltoren voor kinderen vanaf de leeftijd van 2 jaar.', 33),
(49, 'Cutie Poppen', 'Cutie poppen van Rubens Barn.', 40),
(50, 'Doudou', 'Doudou\'s voor kinderen van Rubens Barn.', 40),
(51, 'Kids Poppen', 'Poppen voor kids van Rubens Barn.', 40);

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
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Gegevens worden geëxporteerd voor tabel `super_category`
--

INSERT INTO `super_category` (`id`, `name`, `description`) VALUES
(15, 'Geschenkartikelen', 'Geschenkartikelen voor groot en klein.'),
(16, 'Maak je eigen knuffel', 'Maak je eigen knuffel en kies uit een heel assortiment.'),
(17, 'Poppen', 'Allerlei poppen.');

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
