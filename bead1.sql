-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Gép: 127.0.0.1
-- Létrehozás ideje: 2022. Ápr 28. 20:06
-- Kiszolgáló verziója: 10.4.22-MariaDB
-- PHP verzió: 8.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Adatbázis: `bead1`
--

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `bejegyzesek`
--

CREATE TABLE `bejegyzesek` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `cim` varchar(255) COLLATE utf8mb4_hungarian_ci NOT NULL,
  `tartalom` text COLLATE utf8mb4_hungarian_ci NOT NULL,
  `letrehozva` datetime NOT NULL,
  `modositva` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;

--
-- A tábla adatainak kiíratása `bejegyzesek`
--

INSERT INTO `bejegyzesek` (`id`, `userid`, `cim`, `tartalom`, `letrehozva`, `modositva`) VALUES
(1, 1, 'Elkezdtük', 'Üdvözlünk mindenkit első bejegyzésünknél, melyet a honlap elindulásával hoztunk létre.\r\nBízunk benne, hogy hasznosnak találják honlapunkat és sok hasznos információhoz juthatnak majd hozzá a honlapon.', '2022-04-25 20:12:22', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `felhasznalok`
--

CREATE TABLE `felhasznalok` (
  `id` int(11) NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_hungarian_ci NOT NULL,
  `keresztnev` varchar(255) COLLATE utf8mb4_hungarian_ci NOT NULL,
  `vezeteknev` varchar(255) COLLATE utf8mb4_hungarian_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_hungarian_ci NOT NULL,
  `jelszo` varchar(255) COLLATE utf8mb4_hungarian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;

--
-- A tábla adatainak kiíratása `felhasznalok`
--

INSERT INTO `felhasznalok` (`id`, `username`, `keresztnev`, `vezeteknev`, `email`, `jelszo`) VALUES
(1, 'admin', 'Burka', 'Márk', 'admin@matesz.hu', '$2y$10$OhtVN5E7xzVh42l1URdu8eBVB0kdC7bQge1I4iuZgv9CbyHiyNkw.');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `np`
--

CREATE TABLE `np` (
  `id` int(11) NOT NULL,
  `nev` varchar(255) COLLATE utf8mb4_hungarian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;

--
-- A tábla adatainak kiíratása `np`
--

INSERT INTO `np` (`id`, `nev`) VALUES
(1, 'Aggteleki Nemzeti Park Igazgatóság\r'),
(2, 'Balaton-felvidéki Nemzeti Park Igazgatóság\r'),
(3, 'Bükki Nemzeti Park Igazgatóság\r'),
(4, 'Duna-Dráva Nemzeti Park Igazgatóság\r'),
(5, 'Duna-Ipoly Nemzeti Park Igazgatóság\r'),
(6, 'Fertő-Hanság Nemzeti Park Igazgatóság\r'),
(7, 'Hortobágyi Nemzeti Park Igazgatóság\r'),
(8, 'Kiskunsági Nemzeti Park Igazgatóság\r'),
(9, 'Körös-Maros Nemzeti Park Igazgatóság\r'),
(10, 'Őrségi Nemzeti Park Igazgatóság\r');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `telepules`
--

CREATE TABLE `telepules` (
  `id` int(11) NOT NULL,
  `nev` varchar(255) COLLATE utf8mb4_hungarian_ci NOT NULL,
  `npid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;

--
-- A tábla adatainak kiíratása `telepules`
--

INSERT INTO `telepules` (`id`, `nev`, `npid`) VALUES
(1, 'Abaliget', 4),
(2, 'Ágasegyháza', 8),
(3, 'Aggtelek', 1),
(4, 'Apaj', 8),
(5, 'Ásotthalom', 8),
(6, 'Babócsa', 4),
(7, 'Bakonybél', 2),
(8, 'Balatonederics', 2),
(9, 'Balatonmagyaród', 2),
(10, 'Barcs', 4),
(11, 'Bélapátfalva', 3),
(12, 'Berettyóújfalu', 7),
(13, 'Biharugra', 9),
(14, 'Budapest', 5),
(15, 'Bugac', 8),
(16, 'Bükkszentkereszt', 3),
(17, 'Cégénydányád', 7),
(18, 'Celldömölk', 10),
(19, 'Csáfordjánosfa', 6),
(20, 'Csákvár', 5),
(21, 'Császártöltés', 8),
(22, 'Cserépfalu', 3),
(23, 'Cserkút', 4),
(24, 'Csopak', 2),
(25, 'Dejtár', 5),
(26, 'Dévaványa', 9),
(27, 'Drégelypalánk', 5),
(28, 'Dunapataj', 8),
(29, 'Dunaremete', 6),
(30, 'Esztergom', 5),
(31, 'Farmos', 5),
(32, 'Felsőtárkány', 3),
(33, 'Fertőrákos', 6),
(34, 'Fót', 5),
(35, 'Fülöpháza', 8),
(36, 'Fülöpszállás', 8),
(37, 'Gánt', 5),
(38, 'Garadna', 3),
(39, 'Gyékényes', 4),
(40, 'Gyöngyös', 3),
(41, 'Győr', 6),
(42, 'Hollókő', 3),
(43, 'Hortobágy', 7),
(44, 'Ipolytarnóc', 3),
(45, 'Izsák', 8),
(46, 'Jósvafő', 1),
(47, 'Kaposvár', 4),
(48, 'Kecskemét', 8),
(49, 'Kékkút', 2),
(50, 'Kercaszomor', 10),
(51, 'Kisapáti', 2),
(52, 'Kisszentmárton', 4),
(53, 'Kölked', 4),
(54, 'Kőszeg', 10),
(55, 'Kunadacs', 8),
(56, 'Lakitelek', 8),
(57, 'Magyaregregy', 4),
(58, 'Magyarszombatfa', 10),
(59, 'Matty', 4),
(60, 'Miskolc', 3),
(61, 'Mohács', 4),
(62, 'Mórahalom', 8),
(63, 'Nagykovácsi', 5),
(64, 'Nagykőrös', 5),
(65, 'Óbánya', 4),
(66, 'Ócsa', 5),
(67, 'Old', 4),
(68, 'Orfű', 4),
(69, 'Orgovány', 8),
(70, 'Osli', 6),
(71, 'Őriszentpéter', 10),
(72, 'Őrtilos', 4),
(73, 'Paks', 4),
(74, 'Pálmonostora', 8),
(75, 'Pannonhalma', 6),
(76, 'Parád', 3),
(77, 'Pécs', 4),
(78, 'Perkupa', 1),
(79, 'Pilisszentiván', 5),
(80, 'Poroszló', 7),
(81, 'Pörböly', 4),
(82, 'Ravazd', 6),
(83, 'Salgótarján', 3),
(84, 'Sámsonháza', 3),
(85, 'Sarród', 6),
(86, 'Somlójenő', 2),
(87, 'Szabadkígyós', 9),
(88, 'Szalafő', 10),
(89, 'Szarvas', 9),
(90, 'Szarvaskő', 3),
(91, 'Szatymaz', 8),
(92, 'Szeghalom', 9),
(93, 'Szekszárd', 5),
(94, 'Szeremle', 4),
(95, 'Szigliget', 2),
(96, 'Szilvásvárad', 3),
(97, 'Szögliget', 1),
(98, 'Tarpa', 7),
(99, 'Tihany', 2),
(100, 'Tiszaalpár', 8),
(101, 'Tiszafüred', 7),
(102, 'Tiszalúc', 3),
(103, 'Tokaj', 1),
(104, 'Vámospércs', 7),
(105, 'Villány', 4),
(106, 'Vízvár', 4);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `ut`
--

CREATE TABLE `ut` (
  `azon` int(11) NOT NULL,
  `nev` varchar(255) COLLATE utf8mb4_hungarian_ci NOT NULL,
  `hossz` decimal(8,4) NOT NULL,
  `allomas` int(11) NOT NULL,
  `ido` decimal(8,2) NOT NULL,
  `vezetes` tinyint(1) NOT NULL,
  `telepulesid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;

--
-- A tábla adatainak kiíratása `ut`
--

INSERT INTO `ut` (`azon`, `nev`, `hossz`, `allomas`, `ido`, `vezetes`, `telepulesid`) VALUES
(1, 'Anna-ligeti tanösvény ', '2.0000', 8, '1.50', -1, 89),
(2, 'Apródok útja tanösvény ', '7.2000', 8, '3.00', -1, 27),
(3, 'Aqua Colun tanösvény ', '3.5000', 5, '2.00', -1, 45),
(4, 'Árpád fejedelem tanösvény ', '3.0000', 11, '2.00', -1, 100),
(5, 'Ártéri tanösvény ', '0.5000', 4, '0.50', -1, 106),
(6, 'Babócsai Basa-kert tanösvény ', '1.0000', 2, '1.00', -1, 6),
(7, 'Baradla tanösvény ', '7.5000', 18, '3.00', -1, 3),
(8, 'Bárányfoki tanösvény ', '2.1000', 6, '1.00', -1, 93),
(9, 'Báránypirosító tanösvény ', '1.6000', 5, '1.60', -1, 35),
(10, 'Barát-réti tanösvény ', '6.5000', 4, '3.00', -1, 32),
(11, 'Barcsi Borókás tanösvény ', '2.0000', 4, '1.00', -1, 10),
(12, 'Bazaltorgonák tanösvény ', '4.0000', 7, '2.00', -1, 51),
(13, 'Bél-kői tanösvény ', '5.0000', 7, '2.50', -1, 11),
(14, 'Bihari-sík tanösvény ', '7.2000', 20, '5.20', -1, 12),
(15, 'Bodrogzugi vízitúra tanösvény ', '5.0000', 3, '2.00', 0, 103),
(16, 'Bódva-völgyi tanösvény ', '2.5000', 7, '1.00', 0, 78),
(17, 'Boróka tanösvény ', '2.9000', 5, '1.50', -1, 15),
(18, 'Boros-Dráva tanösvény ', '1.0000', 2, '0.50', -1, 67),
(19, 'Boroszlán tanösvény ', '7.0000', 8, '3.00', -1, 7),
(20, 'Boszorkány-kő geológiai tanösvény ', '0.4000', 13, '0.50', -1, 83),
(21, 'Bőköz tanösvény ', '4.0000', 6, '1.50', -1, 52),
(22, 'Bölömbika tanösvény ', '3.0000', 6, '1.50', -1, 62),
(23, 'Búbos vöcsök tanösvény ', '1.5000', 13, '1.50', 0, 9),
(24, 'Buda-hegyi tanösvény', '2.0000', 8, '3.00', -1, 84),
(25, 'Cankó tanösvény ', '1.0000', 9, '1.50', -1, 36),
(26, 'Cégénydányádi Kastélypark tanösvény ', '1.5000', 19, '1.00', 0, 17),
(27, 'Chernel-kerti tanösvény ', '0.5000', 0, '0.50', 0, 54),
(28, 'Cserépfalui Ördögtorony tanösvény ', '10.0000', 20, '4.50', -1, 22),
(29, 'Csipak tanösvény ', '3.0000', 9, '1.50', -1, 62),
(30, 'Csodarét tanösvény ', '4.0000', 10, '2.00', -1, 5),
(31, 'Csomoros-sziget tanösvény ', '0.7000', 10, '1.00', -1, 10),
(32, 'Csörgőalma tanösvény ', '0.0000', 1, '0.50', -1, 71),
(33, 'Denevér tanösvény ', '5.0000', 13, '3.00', -1, 1),
(34, 'Erdei tanösvény ', '2.7000', 6, '2.00', -1, 15),
(35, 'Eresztvényi kőbányák ', '2.5000', 6, '1.00', -1, 83),
(36, 'Erzsébet-sziget tanösvény ', '3.0000', 2, '1.50', -1, 6),
(37, 'Fekete harkály tanösvény ', '5.0000', 13, '3.00', -1, 47),
(38, 'Felsőszeri tanösvény ', '1.7000', 6, '1.00', -1, 88),
(39, 'Fóti-Somlyó tanösvény ', '3.5000', 11, '3.00', -1, 34),
(40, 'Földtani tanösvény ', '2.0000', 13, '1.50', -1, 37),
(41, 'Fürge cselle tanösvény ', '3.2000', 8, '1.50', -1, 50),
(42, 'Fürkész ösvény ', '2.0000', 12, '1.50', -1, 46),
(43, 'Górési tanösvény ', '11.0000', 5, '3.00', -1, 101),
(44, 'Halásztelki tanösvény ', '3.0000', 10, '1.50', -1, 89),
(45, 'Hankovszky-liget tanösvény ', '0.3500', 8, '0.50', -1, 48),
(46, 'Hany Istók tanösvény ', '5.0000', 7, '2.00', 0, 70),
(47, 'Haraszt-hegyi tanösvény ', '3.5000', 7, '3.00', -1, 20),
(48, 'Holt-Rába tanösvény ', '6.0000', 5, '2.00', 0, 41),
(49, 'Ilona-völgyi geológiai tanösvény ', '6.5000', 9, '2.50', -1, 76),
(50, 'Ipolytarnóc - Biológiai tanösvény ', '6.0000', 13, '1.25', -1, 44),
(51, 'Ipolytarnóc - Borókás-árok geológiai tanösvény ', '0.8000', 7, '1.00', -1, 44),
(52, 'Ipolytarnóc - Kőszikla tanösvény ', '0.9000', 20, '1.50', -1, 44),
(53, 'Ipolytarnóc - Kőzetpark ', '0.7000', 20, '0.50', -1, 44),
(54, 'Jági tanösvény ', '3.5000', 6, '2.00', -1, 79),
(55, 'Jakab-hegyi tanösvény ', '8.0000', 10, '2.00', -1, 23),
(56, 'Jávorkúti tanösvény ', '3.0000', 4, '1.00', -1, 38),
(57, 'Jónásrészi tanösvény ', '5.0000', 11, '3.00', -1, 104),
(58, 'Káli-medence túrahálózat ', '25.0000', 79, '8.00', -1, 49),
(59, 'Kamon-kő tanösvény ', '6.0000', 9, '3.00', -1, 95),
(60, 'Kékbegy tanösvény ', '0.2100', 3, '0.50', -1, 31),
(61, 'Kékmoszat tanösvény ', '2.4000', 12, '2.00', -1, 28),
(62, 'Kesznyéteni TK agrár-környezetgazdálkodási tanösvény ', '4.8000', 6, '3.50', -1, 102),
(63, 'Kígyósi tanösvény ', '5.0000', 4, '2.00', 0, 87),
(64, 'Kismély-völgyi tanösvény ', '1.0000', 5, '1.00', -1, 77),
(65, 'Kisvátyoni tanösvény ', '8.0000', 6, '3.00', 0, 13),
(66, 'Kitaibel tanösvény ', '3.0000', 9, '2.00', -1, 86),
(67, 'Kontyvirág tanösvény ', '2.4000', 6, '1.50', -1, 56),
(68, 'Kormorános-erdő tanösvény ', '2.0000', 6, '0.50', -1, 59),
(69, 'Kosbor tanösvény ', '1.7000', 5, '1.50', -1, 55),
(70, 'Kő-közi tanösvény ', '0.8000', 5, '1.00', -1, 32),
(71, 'Kőpark tanösvény ', '0.2000', 0, '0.50', -1, 14),
(72, 'Körtike tanösvény ', '6.2000', 11, '2.50', -1, 88),
(73, 'Kövi benge tanösvény ', '0.3000', 20, '1.00', 0, 33),
(74, 'Lóczy gejzír-sétaút ', '18.0000', 15, '6.00', -1, 99),
(75, 'Madarak és fák útja ', '1.0000', 5, '1.00', -1, 15),
(76, 'Madárvédelmi tanösvény ', '0.3000', 8, '0.50', -1, 54),
(77, 'Mágor-pusztai tanösvény ', '0.5000', 5, '1.50', 0, 92),
(78, 'Magyar-bányai kőpark ', '0.1500', 13, '0.50', -1, 83),
(79, 'Mérus-erdő tanösvény ', '1.0000', 1, '0.50', -1, 6),
(80, 'Millenniumi természetismereti és erdészeti bemutató sétaút ', '2.5000', 20, '1.00', -1, 96),
(81, 'Nagymező - Kis-kőháti-zsomboly tanösvény ', '3.0000', 3, '1.00', -1, 96),
(82, 'Nagypartosi tanösvény ', '2.5000', 6, '1.00', -1, 53),
(83, 'Nagy-Szénás tanösvény ', '2.1000', 7, '1.50', -1, 63),
(84, 'Nyéki-Holt-Duna tanösvény ', '2.2000', 6, '1.00', -1, 81),
(85, 'Óbányai Pro Silva tanösvény ', '2.0000', 5, '0.50', -1, 65),
(86, 'Olasz-kapui tanösvény ', '7.2000', 6, '3.00', -1, 96),
(87, 'Orfűi Vízfő tanösvény ', '1.0000', 4, '0.50', -1, 68),
(88, 'Öregtavi tanösvény ', '25.0000', 18, '6.00', -1, 43),
(89, 'Őrtilosi Dráva-ártér tanösvény ', '2.0000', 0, '0.75', -1, 72),
(90, 'Paksi Ürge-mező tanösvény ', '4.0000', 11, '1.00', -1, 73),
(91, 'Pálfája tanösvény ', '1.8000', 10, '1.50', -1, 64),
(92, 'Páskom legelő tanösvény ', '3.0000', 6, '2.00', -1, 25),
(93, 'Pele apó ösvénye ', '8.5000', 38, '5.00', -1, 8),
(94, 'Pele körút ', '0.8000', 10, '1.00', -1, 24),
(95, 'Pimpó tanösvény ', '5.8000', 6, '4.00', -1, 69),
(96, 'Poszáta tanösvény ', '2.0000', 8, '1.50', -1, 45),
(97, 'Ravazd-Sokorópátkai tanösvény ', '15.0000', 3, '3.00', 0, 82),
(98, 'Réce tanösvény ', '1.0000', 5, '0.50', -1, 4),
(99, 'Réhelyi tanösvény ', '1.5000', 8, '1.00', -1, 26),
(100, 'Rejtek - Répáshuta tanösvény ', '9.0000', 12, '4.50', -1, 16),
(101, 'Rekettye tanösvény ', '2.3000', 6, '2.00', -1, 2),
(102, 'Rezgőnyár tanösvény ', '0.3000', 7, '0.50', -1, 71),
(103, 'Ság-hegy élővilága ', '0.2000', 13, '0.20', -1, 18),
(104, 'Ság-hegyi geológiai tanösvény ', '1.0000', 18, '0.50', -1, 18),
(105, 'Salgó - Somoskő vára tanösvény ', '3.5000', 6, '1.00', -1, 83),
(106, 'Sárgaliliom tanösvény ', '6.2000', 11, '2.50', -1, 58),
(107, 'Sár-hegyi természetismereti tanösvény ', '7.0000', 12, '3.00', -1, 40),
(108, 'Sas-hegy tanösvény ', '0.8500', 7, '1.00', -1, 14),
(109, 'Sáskajárás sétaút ', '0.8000', 8, '1.00', -1, 15),
(110, 'Selyem-réti tanösvény ', '1.5000', 6, '2.00', -1, 66),
(111, 'Sirály tanösvény ', '2.0000', 5, '1.50', -1, 91),
(112, 'Sóvirág tanösvény ', '0.5000', 0, '1.00', -1, 31),
(113, 'Sötét-völgyi tanösvény ', '4.3000', 9, '2.00', -1, 93),
(114, 'Strázsa-hegyi tanösvény ', '1.2000', 7, '1.50', -1, 30),
(115, 'Szádvár tanösvény ', '4.5000', 12, '3.00', -1, 97),
(116, 'Szalajka-völgyi természetvédelmi bemutatóösvény ', '4.2000', 10, '2.50', -1, 96),
(117, 'Szala menti tanösvény ', '3.8000', 9, '1.50', -1, 71),
(118, 'Szálkahalmi tanösvény ', '1.1000', 5, '1.00', -1, 43),
(119, 'Szarvaskői geológiai tanösvény ', '8.8000', 11, '3.50', -1, 90),
(120, 'Szeremlei-Holt-Duna tanösvény ', '2.4000', 6, '1.00', -1, 94),
(121, 'Szigetközi Ökoturisztikai Bemutató Útvonal ', '18.0000', 12, '2.00', 0, 29),
(122, 'Sziki őszirózsa tanösvény ', '4.0000', 10, '2.00', 0, 85),
(123, 'Szilvás-kői geológiai tanösvény ', '3.5000', 12, '1.50', -1, 83),
(124, 'Szinva tanösvény ', '4.0000', 6, '3.00', -1, 60),
(125, 'Szomoróczi tanösvény ', '3.0000', 6, '1.00', -1, 50),
(126, 'Tanösvény a Turjánban ', '1.2000', 9, '1.00', -1, 66),
(127, 'Tarpai Szőlő-hegy tanösvény ', '3.0000', 6, '2.00', 0, 98),
(128, 'Templom-hegyi tanösvény ', '2.0000', 6, '1.00', -1, 105),
(129, 'Pannonhalmi arborétum', '1.5000', 3, '0.30', 0, 75),
(130, 'Tisza-tavi vízi sétány és tanösvény ', '1.5000', 4, '2.00', -1, 80),
(131, 'Tohonya-Kuriszlán tanösvény II. útvonal ', '9.0000', 25, '6.00', -1, 46),
(132, 'Tohonya-Kuriszlán tanösvény I. útvonal ', '4.5000', 12, '2.50', -1, 46),
(133, 'Tőzike tanösvény ', '3.0000', 5, '1.00', -1, 19),
(134, 'Tüskés-réti tanösvény ', '1.0000', 4, '1.00', -1, 77),
(135, 'Újmohácsi tanösvény ', '3.1000', 7, '1.00', -1, 61),
(136, 'Üde rétek tanösvény ', '3.0000', 5, '2.00', -1, 10),
(137, 'Várdomb tanösvény ', '0.3000', 6, '0.50', 0, 100),
(138, 'Vár-hegyi tanösvény ', '10.0000', 6, '4.50', -1, 32),
(139, 'Vártúra ösvény ', '1.2000', 0, '1.00', -1, 42),
(140, 'Vár-völgyi földtani tanösvény ', '3.0000', 10, '1.00', -1, 57),
(141, 'Vasút-oldali túraútvonal ', '10.0000', 1, '2.50', -1, 39),
(142, 'Vizi Rence Túraútvonal ', '6.0000', 0, '3.00', -1, 33),
(143, 'Vöcsök tanösvény ', '3.2000', 7, '2.50', -1, 74),
(144, 'Vörös-mocsár tanösvény ', '2.5000', 2, '2.00', -1, 21);

--
-- Indexek a kiírt táblákhoz
--

--
-- A tábla indexei `bejegyzesek`
--
ALTER TABLE `bejegyzesek`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userid` (`userid`) USING BTREE;

--
-- A tábla indexei `felhasznalok`
--
ALTER TABLE `felhasznalok`
  ADD PRIMARY KEY (`id`);

--
-- A tábla indexei `np`
--
ALTER TABLE `np`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- A tábla indexei `telepules`
--
ALTER TABLE `telepules`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`),
  ADD KEY `npid` (`npid`);

--
-- A tábla indexei `ut`
--
ALTER TABLE `ut`
  ADD PRIMARY KEY (`azon`),
  ADD KEY `telepulesid` (`telepulesid`);

--
-- A kiírt táblák AUTO_INCREMENT értéke
--

--
-- AUTO_INCREMENT a táblához `bejegyzesek`
--
ALTER TABLE `bejegyzesek`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT a táblához `felhasznalok`
--
ALTER TABLE `felhasznalok`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT a táblához `ut`
--
ALTER TABLE `ut`
  MODIFY `azon` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=145;

--
-- Megkötések a kiírt táblákhoz
--

--
-- Megkötések a táblához `telepules`
--
ALTER TABLE `telepules`
  ADD CONSTRAINT `telepules_ibfk_1` FOREIGN KEY (`npid`) REFERENCES `np` (`id`);

--
-- Megkötések a táblához `ut`
--
ALTER TABLE `ut`
  ADD CONSTRAINT `ut_ibfk_1` FOREIGN KEY (`telepulesid`) REFERENCES `telepules` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
