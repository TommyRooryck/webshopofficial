-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Gegenereerd op: 29 aug 2020 om 23:22
-- Serverversie: 10.4.14-MariaDB
-- PHP-versie: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
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

CREATE TABLE `attributes` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Gegevens worden geëxporteerd voor tabel `attributes`
--

INSERT INTO `attributes` (`id`, `name`) VALUES
(23, 'Tekstkleur'),
(24, 'Lettertype'),
(25, 'Textiel'),
(26, 'Vulling'),
(27, 'Kleur'),
(28, 'Text');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `attribute_values`
--

CREATE TABLE `attribute_values` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `attribute_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

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
(92, 'Lichtblauw', 23),
(91, 'Goud', 23),
(74, 'Charline', 24),
(90, 'Donkerblauw', 23),
(89, 'Baby Pink', 23),
(81, 'ZP Watcha Doing', 24),
(82, 'Silk', 25),
(83, 'Leather', 25),
(87, 'Vullen door Little Blessings', 26),
(88, 'Vulling meesturen', 26),
(93, 'Rood', 23),
(94, 'Wit', 23),
(95, 'Zilver', 23),
(96, 'Zwart', 23),
(103, 'Licht Turquise', 27),
(98, 'Blauw', 27),
(99, 'Lime', 27),
(100, 'Oranje', 27),
(101, 'Roze', 27),
(102, 'Wit', 27),
(104, 'Lichtblauw', 27),
(105, 'Lichtroze', 27),
(106, 'Mint', 27),
(107, 'Grijs', 27);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `super_category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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

CREATE TABLE `customers` (
  `id` int(11) NOT NULL,
  `user_code` varchar(255) NOT NULL,
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
  `shipping_country` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Gegevens worden geëxporteerd voor tabel `customers`
--

INSERT INTO `customers` (`id`, `user_code`, `username`, `password`, `first_name`, `last_name`, `email`, `phone`, `adress`, `city`, `postal_code`, `region`, `country`, `shipping_adress`, `shipping_city`, `shipping_postal_code`, `shipping_region`, `shipping_country`) VALUES
(1, '', 'TommyR', '$2y$10$d/TZ58iwKqJ5ZK7kMR/2FOUbe0I6Ew8z4XfulTWoF.LkfGqgTirBq', 'Tommy', 'Rooryck', 'tommy_rooryck@hotmail.com', '0476755659', 'Ellestraat, 36', 'Gistel', '8470', 'West-Vlaanderen', 'België', 'Ellestraat, 36', 'Gistel', '8470', 'West-Vlaanderen', 'België'),
(2, '', 'TommyR2', '$2y$10$JUGzA.jHXy5PYA/ExikkguTYB6ISNalkNlraUQbITid5npN4RJiGy', 'Tommy', 'Rooryck', 'tommy_rooryck@hotmail.com', '0476755659', 'Ellestraat, 36', 'Gistel', '8470', 'West-Vlaanderen', 'België', 'Ellestraat, 36', 'Gistel', '8470', 'West-Vlaanderen', 'België');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `created_at` date NOT NULL,
  `products` text NOT NULL,
  `status` varchar(255) NOT NULL,
  `order_status_id` int(11) NOT NULL,
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
  `total_price` varchar(255) NOT NULL,
  `payment_id` varchar(255) NOT NULL,
  `bestelcode` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Gegevens worden geëxporteerd voor tabel `orders`
--

INSERT INTO `orders` (`id`, `customer_id`, `created_at`, `products`, `status`, `order_status_id`, `first_name`, `last_name`, `email`, `phone`, `adress`, `city`, `postal_code`, `region`, `country`, `shipping_adress`, `shipping_city`, `shipping_postal_code`, `shipping_region`, `shipping_country`, `total_price`, `payment_id`, `bestelcode`) VALUES
(1, 1, '2020-08-27', 'a:1:{i:0;a:2:{i:0;s:2:\"46\";i:1;a:1:{i:0;s:3:\"103\";}}}', 'paid', 1, 'Tommy', 'Rooryck', 'tommy_rooryck@hotmail.com', '0476755659', 'Ellestraat, 36', 'Gistel', '8470', 'West-Vlaanderen', 'België', 'Ellestraat, 36', 'Gistel', '8470', 'West-Vlaanderen', 'België', '19', 'tr_UCe8bEMR6z', '202008275f47a5f7655d06.51973031'),
(2, 1, '2020-08-27', 'a:1:{i:0;a:2:{i:0;s:2:\"45\";i:1;a:4:{i:0;s:3:\"107\";i:1;s:2:\"78\";i:2;s:2:\"90\";i:3;i:113;}}}', 'paid', 1, 'Tommy', 'Rooryck', 'tommy_rooryck@hotmail.com', '0476755659', 'Ellestraat, 36', 'Gistel', '8470', 'West-Vlaanderen', 'België', 'Ellestraat, 36', 'Gistel', '8470', 'West-Vlaanderen', 'België', '20.99', 'tr_wNSqm5sP93', '202008275f47a71ae84995.79403301'),
(3, 2, '2020-08-27', 'a:2:{i:0;a:2:{i:0;s:2:\"80\";i:1;a:3:{i:0;s:3:\"100\";i:1;s:2:\"79\";i:2;i:114;}}i:1;a:2:{i:0;s:2:\"80\";i:1;a:4:{i:0;s:3:\"100\";i:1;s:2:\"79\";i:2;i:114;i:3;i:115;}}}', 'paid', 1, 'Tommy', 'Rooryck', 'tommy_rooryck@hotmail.com', '0476755659', 'Ellestraat, 36', 'Gistel', '8470', 'West-Vlaanderen', 'België', 'Ellestraat, 36', 'Gistel', '8470', 'West-Vlaanderen', 'Nederland', '18', 'tr_tSqPzt5yrs', '202008275f47ab8821ae52.97261725');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `order_products`
--

CREATE TABLE `order_products` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `attribute_id` int(11) NOT NULL,
  `attribute_values_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Gegevens worden geëxporteerd voor tabel `order_products`
--

INSERT INTO `order_products` (`id`, `order_id`, `product_id`, `attribute_id`, `attribute_values_id`) VALUES
(1, 1, 46, 27, 103),
(2, 2, 45, 27, 107),
(3, 2, 45, 24, 78),
(4, 2, 45, 23, 90),
(5, 2, 45, 28, 113),
(6, 3, 80, 27, 100),
(7, 3, 80, 24, 79),
(8, 3, 80, 28, 114),
(9, 3, 80, 27, 100),
(10, 3, 80, 24, 79),
(11, 3, 80, 28, 114),
(12, 3, 80, 28, 115);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `order_status`
--

CREATE TABLE `order_status` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Gegevens worden geëxporteerd voor tabel `order_status`
--

INSERT INTO `order_status` (`id`, `name`) VALUES
(1, 'Processing delivery '),
(2, 'Delivery sent'),
(3, 'Devlivered');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `photos`
--

CREATE TABLE `photos` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `filename` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `size` int(11) NOT NULL,
  `product_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Gegevens worden geëxporteerd voor tabel `photos`
--

INSERT INTO `photos` (`id`, `title`, `description`, `filename`, `type`, `size`, `product_id`) VALUES
(120, '', '', 'blush.jpg', 'image/jpeg', 134171, 46),
(121, '', '', 'Cambridge Blue.jpg', 'image/jpeg', 608776, 46),
(122, '', '', 'Shifting Sand terazzo.jpg', 'image/jpeg', 205247, 46),
(123, '', '', 'Silver Sage.jpg', 'image/jpeg', 535775, 46),
(124, '', '', 'Tradewinds.jpg', 'image/jpeg', 651418, 46),
(125, '', '', 'Warm Taupe.jpg', 'image/jpeg', 607537, 46),
(130, '', '', 'Lichtblauw.jpg', 'image/jpeg', 2470, 45),
(131, '', '', 'Lichtroze.jpg', 'image/jpeg', 2735, 45),
(132, '', '', 'lunchbox-ecolunch.jpg', 'image/jpeg', 76900, 45),
(133, '', '', 'grijs.jpg', 'image/jpeg', 156611, 57),
(134, '', '', 'pinky patch bear.jpg', 'image/jpeg', 47679, 64);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `price` float NOT NULL,
  `stock` int(11) UNSIGNED NOT NULL,
  `created_at` date NOT NULL,
  `product_placeholder` varchar(255) NOT NULL,
  `category_id` int(11) NOT NULL,
  `sub_category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Gegevens worden geëxporteerd voor tabel `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `price`, `stock`, `created_at`, `product_placeholder`, `category_id`, `sub_category_id`) VALUES
(45, 'Lunchdoos', 'Lunchdoos met bijhorend, herbruikbaar, plastic bestek en tekst naar keuze.', 15.99, 3, '2020-08-27', 'Mint.jpg', 27, 45),
(46, 'Mushi Silicone Slab', 'Silicone Slab met opvangbakje van Mushie.', 14, 7, '2020-08-27', 'Raw Sienna.jpg', 27, 47),
(57, 'Dekentje', 'Dekentje met naam', 20.99, 1, '2020-08-23', 'dekentje.jpg', 25, 0),
(58, 'Donkey', '– size: 16”\r\n– Curly, soft plush\r\n– Zip with Velcro on the back\r\n– Plastic eyes\r\n– 100% Polyester Cotton\r\n– Standing position\r\n\r\n*HEE-HAW* It’s the sound of a happy donkey. The skin is so soft you might want to cuddle it all day long. Enjoy the time with your new best friend.', 16.99, 3, '2020-07-27', 'Donkey.jpg', 38, 0),
(59, 'Flopsy The Grey Buny', '– size: 16”\r\n– Soft, grey plush\r\n– Zip with Velcro on the back\r\n– Plastic eyes\r\n– 100% Polyester Cotton\r\n– Standing position\r\n\r\nEverybody loves rabbits – especially this cuddly friend because of its unusually soft ears and cute, bushy tail. Don’t forget to dress it up when it is cold outside or it will start to sneeze and have a wet snout.', 16.99, 4, '2020-08-23', 'flopsy the grey bunny pink nose.jpg', 38, 0),
(60, 'Giraffe', '– size: 16”\r\n– Soft plush with dotted pattern\r\n– Zip with Velcro on the back\r\n– Plastic eyes\r\n– 100% Polyester Cotton\r\n– Standing position\r\n\r\nA giraffe-friend is a good friend! They can reach the highest top of every tree, and help you reach the top shelf with the best book and adventures. The big, soft stomach is nice to cuddle up to.', 16.99, 5, '2020-08-23', 'Giraffe.png', 38, 0),
(61, 'Golden Retriever', '– size: 16”\r\n– Golden, soft plush\r\n– Zip with Velcro on the back\r\n– Plastic eyes\r\n– 100% Polyester Cotton\r\n– Sitting position\r\nWho is up for playing and having fun all day long? With this golden friend, you will laugh so much your stomach might hurt. It loves walking on lead with you and sniff around. Remember to give your new best friend a fantastic name.', 16.99, 6, '2020-07-27', 'Golden Retriever.jpg', 38, 0),
(62, 'Monkey', '– size: 16”\r\n– Soft, brown plush\r\n– Zip with Velcro on the back\r\n– Embroidered eyes\r\n– 100% Polyester Cotton\r\n– Standing position\r\n\r\nMeet a very popular friend of ours. It loves swinging around in the trees and make funny noises with you. If you give it a tasty banana it will also love to dress up and play funny games with you.', 16.99, 2, '2020-07-27', 'Monkey.png', 38, 0),
(63, 'Patch Dog', '– size: 16”\r\n– Soft white plush with brown patch\r\n– Zip with Velcro on the back\r\n– Plastic eyes\r\n– 100% Polyester Cotton\r\n– Sitting position\r\n\r\nMeet the wonderful Patch Dog that will show you steadfast loyalty every day. It loves to learn cool tricks from you and play all day long. Just remember to give it a treat once in a while.', 16.99, 1, '2020-07-27', 'Patch dog.png', 38, 0),
(64, 'Pinky Patch Bear', '– size: 16”\r\n– Pink plush with cute patch on ears, heart and paws\r\n– Zip with Velcro on the back\r\n– Plastic eyes\r\n– 100% Polyester Cotton\r\n– Standing position\r\n\r\nPink is the new black – at least for the girls. This fine lady is adorable and has the beauty of a real princess. This means she can wear every kind of clothes and everything looks good on her.', 16.99, 3, '2020-07-27', 'pinky patch bear.jpg', 38, 0),
(65, 'Racoon', '– size: 16”\r\n– High quality soft plush\r\n– Zip with Velcro on the back\r\n– Plastic eyes and nose\r\n– 100% Polyester Cotton\r\n– Standing position\r\n\r\nLook at the soft, warm fur of this cute animal. We love to cuddle and hug it! It can see in the dark and is extremely cleaver which makes it is a very good friend to have.', 16.99, 6, '2020-07-27', 'Racoon.png', 38, 0),
(66, 'Unicorn', '– size: 16”\r\n– Soft, white plush with pink horn, mane and hairy feet.\r\n– Zip with Velcro on the back\r\n– Embroidered eyes eyes\r\n– 100% Polyester Cotton\r\n– Sitting position\r\n\r\nThis is an adorable and mysterious friend of ours. Maybe that is why it is so popular. You get to use your imagination when you play with it and dress it up with beautiful outfits. Besides it is very good at keeping secrets!', 16.99, 3, '2020-07-27', 'Unicorn.png', 38, 0),
(80, 'Drinkfles', 'Mooie drinkfles', 4, 3, '2020-08-27', '104977433_595280614736146_7949593365913357679_n.jpg', 27, 46);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `shipping`
--

CREATE TABLE `shipping` (
  `id` int(11) NOT NULL,
  `shipping_zone` varchar(255) NOT NULL,
  `shipping_price` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Gegevens worden geëxporteerd voor tabel `shipping`
--

INSERT INTO `shipping` (`id`, `shipping_zone`, `shipping_price`) VALUES
(1, 'België', 5),
(2, 'Nederland', 10);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `specific_product`
--

CREATE TABLE `specific_product` (
  `id` int(11) NOT NULL,
  `attribute_id` int(11) NOT NULL,
  `attribute_values_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Gegevens worden geëxporteerd voor tabel `specific_product`
--

INSERT INTO `specific_product` (`id`, `attribute_id`, `attribute_values_id`, `product_id`) VALUES
(667, 27, 107, 56),
(668, 0, 104, 56),
(669, 0, 105, 56),
(670, 0, 102, 56),
(745, 26, 87, 58),
(746, 0, 88, 58),
(753, 26, 87, 62),
(754, 0, 88, 62),
(755, 26, 87, 63),
(756, 0, 88, 63),
(757, 26, 87, 64),
(758, 0, 88, 64),
(759, 26, 87, 65),
(760, 0, 88, 65),
(761, 26, 87, 66),
(762, 0, 88, 66),
(765, 26, 87, 61),
(766, 0, 88, 61),
(829, 27, 104, 57),
(830, 0, 105, 57),
(831, 0, 101, 57),
(832, 0, 102, 57),
(833, 26, 87, 59),
(834, 0, 88, 59),
(835, 26, 87, 60),
(836, 0, 88, 60),
(856, 27, 103, 46),
(857, 0, 104, 46),
(858, 0, 105, 46),
(859, 0, 99, 46),
(860, 0, 106, 46),
(861, 0, 100, 46),
(952, 27, 107, 45),
(953, 24, 104, 45),
(954, 23, 105, 45),
(955, 28, 106, 45),
(956, 0, 78, 45),
(957, 0, 79, 45),
(958, 0, 80, 45),
(959, 0, 81, 45),
(960, 0, 90, 45),
(961, 0, 91, 45),
(962, 0, 92, 45),
(963, 0, 93, 45),
(964, 0, 94, 45),
(965, 0, 95, 45),
(966, 0, 96, 45),
(967, 27, 98, 80),
(968, 24, 100, 80),
(969, 28, 78, 80),
(970, 0, 79, 80);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `sub_category`
--

CREATE TABLE `sub_category` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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

CREATE TABLE `super_category` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Gegevens worden geëxporteerd voor tabel `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `username`, `password`, `role`) VALUES
(1, 'Tommy', 'Rooryck', 'TommyRooryck', '$2y$10$r7Njn7f3UyUVfIX5p81NEuE/QbDnWvtUNFuYwUunbq89MM72d1DU2', 'Admin');

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `attributes`
--
ALTER TABLE `attributes`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `attribute_values`
--
ALTER TABLE `attribute_values`
  ADD PRIMARY KEY (`id`),
  ADD KEY `attribute_id` (`attribute_id`);

--
-- Indexen voor tabel `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`),
  ADD KEY `super_category_id` (`super_category_id`) USING BTREE;

--
-- Indexen voor tabel `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customer_id` (`customer_id`),
  ADD KEY `order_status_id` (`order_status_id`);

--
-- Indexen voor tabel `order_products`
--
ALTER TABLE `order_products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `attribute_id` (`attribute_id`),
  ADD KEY `attribute_values_id` (`attribute_values_id`);

--
-- Indexen voor tabel `order_status`
--
ALTER TABLE `order_status`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `photos`
--
ALTER TABLE `photos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexen voor tabel `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`),
  ADD KEY `sub_category_id` (`sub_category_id`);

--
-- Indexen voor tabel `shipping`
--
ALTER TABLE `shipping`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `specific_product`
--
ALTER TABLE `specific_product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `attribute_values_id` (`attribute_values_id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `attribute_id` (`attribute_id`);

--
-- Indexen voor tabel `sub_category`
--
ALTER TABLE `sub_category`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexen voor tabel `super_category`
--
ALTER TABLE `super_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `attributes`
--
ALTER TABLE `attributes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT voor een tabel `attribute_values`
--
ALTER TABLE `attribute_values`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=117;

--
-- AUTO_INCREMENT voor een tabel `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT voor een tabel `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT voor een tabel `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT voor een tabel `order_products`
--
ALTER TABLE `order_products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT voor een tabel `order_status`
--
ALTER TABLE `order_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT voor een tabel `photos`
--
ALTER TABLE `photos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=135;

--
-- AUTO_INCREMENT voor een tabel `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- AUTO_INCREMENT voor een tabel `shipping`
--
ALTER TABLE `shipping`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT voor een tabel `specific_product`
--
ALTER TABLE `specific_product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=971;

--
-- AUTO_INCREMENT voor een tabel `sub_category`
--
ALTER TABLE `sub_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT voor een tabel `super_category`
--
ALTER TABLE `super_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT voor een tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
