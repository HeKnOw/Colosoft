-- phpMyAdmin SQL Dump
-- version 3.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 26, 2015 at 03:22 PM
-- Server version: 5.1.73
-- PHP Version: 5.3.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `jjanikovic2013`
--

-- --------------------------------------------------------

--
-- Table structure for table `restaurants`
--

CREATE TABLE IF NOT EXISTS `restaurants` (
  `ID` int(15) DEFAULT NULL,
  `NAME` varchar(140) NOT NULL,
  `ZIPCODE` int(15) NOT NULL,
  `CUISINE` varchar(140) NOT NULL,
  `PRICE` int(15) NOT NULL,
  `WEBSITE` varchar(150) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `restaurants`
--

INSERT INTO `restaurants` (`ID`, `NAME`, `ZIPCODE`, `CUISINE`, `PRICE`, `WEBSITE`) VALUES
(2, 'Chima', 33301, 'Brazilian', 5, 'http://chima.cc/site/index.php?option=com_content&view=article&id=5&Itemid=2'),
(1, 'La Dolce Vita', 33308, 'Italian', 4, 'http://www.ladolcevitaflorida.com/Location.html'),
(3, 'Greek Islands Taverna', 33308, 'Greek', 2, 'http://www.greekislandstaverna.com/'),
(4, 'Capital Grille', 33304, 'American', 4, 'https://www.thecapitalgrille.com/locations/fl/ft-lauderdale/8019?cmpid=br:TCG_ag:ogv_ch:ppc_ca:TCG_Ft-Lauderdale-FL_BR_dt:12-15-2014_gt:TCG---Ft-Laude'),
(5, 'Hardy Park Bistro', 33301, 'Mediterranean', 3, 'http://www.hardyparkbistro.com/'),
(6, 'Casablanca Cafe', 33304, 'French', 3, 'http://www.casablancacafeonline.com/'),
(7, 'Casa D''Angelo', 33304, 'Italian', 5, 'http://www.casa-d-angelo.com/'),
(8, 'Seasons 52', 33304, 'American', 4, 'https://www.seasons52.com/en/locations/FL/Ft-Lauderdale/4502'),
(9, 'Johnny V', 33301, 'American', 3, 'http://www.johnnyvlasolas.com/'),
(10, 'Mediterraneo Cafe & Grill', 33062, 'Mediterrenean', 3, 'https://locu.com/places/mediterraneo-pompano-beach-us/#menu'),
(11, 'Phil''s Heavenly Pizza', 33062, 'Italian', 2, 'http://www.philsheavenlypizza.com/'),
(12, 'Anthony''s Coal Fired Pizza', 33062, 'Italian', 2, 'https://acfp.com/'),
(13, 'J Marks', 33062, 'American', 2, 'http://www.jmarksrestaurant.com/'),
(14, 'Shishka Lebanese Grill', 33062, 'Mediterrenean', 2, 'http://shishkagrill.com/#ad-image-0'),
(15, 'Houston''s', 33062, 'American', 3, 'http://www.hillstone.com/houstons/'),
(16, 'Zuccarelli', 33313, 'Italian', 2, 'http://zuccarellipizza.com/'),
(17, 'Burgers & Suds', 33062, 'American', 2, 'http://www.burgerssuds.com/'),
(18, 'Malulo''s International Seafood', 33060, 'Peruvian', 2, 'http://southflorida.menupages.com/restaurants/malulos-international-seafood/menu'),
(19, 'Aconchego', 33062, 'American', 2, 'https://plus.google.com/107257466059963562938/about?gl=us&hl=en'),
(20, 'It''s All Greek to Me! Grill', 33069, 'Greek', 2, 'http://www.itsallgreektome-grill.com/'),
(21, 'Seaside Grill', 33062, 'Seafood', 3, 'http://www.viewmenu.com/seaside-grill/menu?ref=google'),
(22, 'VERO Italian', 33131, 'Italian', 3, 'http://www.veroitalian.com/'),
(23, 'Toro Toro Restaurant & Bar', 33131, 'Asian4', 5, 'http://www.torotoromiami.com/'),
(24, 'Zuma', 33131, 'Asian', 5, 'http://www.zumarestaurant.com/zuma-landing/miami/en/welcome'),
(25, 'Old Lisbon Restaurant', 33133, 'Portuguese', 2, 'http://www.oldlisbon.com/'),
(26, 'Cheescake Factory', 33133, 'American', 2, 'http://www.thecheesecakefactory.com/'),
(27, 'Pizzarium', 33131, 'Italian', 2, 'http://pizzarium-us.com/'),
(28, 'Cafe Prima Pasta', 33141, 'Italian', 3, 'http://cafeprimapasta.com/#_=_'),
(29, 'Cara Mia Trattoria', 33139, 'Italian', 2, 'http://www.caramiasobe.com/#_=_'),
(30, 'Klima', 33139, 'Spanish', 5, 'http://klimamiami.com/'),
(31, 'Strip Steak', 33140, 'American', 4, 'http://www.fontainebleau.com/web/dining/stripsteak'),
(34, 'Babylon Turkish Restaurant', 33139, 'Turkish', 3, 'http://www.babylonmiamibeach.com/'),
(32, 'Hakkasan', 33140, 'Chinese', 5, 'http://www.fontainebleau.com/web/dining/hakkasan'),
(33, 'Vittocci''s pizza', 33139, 'Italian', 3, 'http://www.vittoccispizzamiamibeach.com/'),
(35, 'Gol', 33138, 'Brazilian', 3, 'http://www.golmiamibeach.com/'),
(36, 'Cleo', 33139, 'Mediterrenean', 3, 'http://sbe.com/restaurants/locations/cleo-south-beach/'),
(37, 'Bianca at Delano', 33139, 'Sushi', 5, 'https://www.morganshotelgroup.com/delano/delano-south-beach#/explore/?id=/delano-miami-bianca/'),
(38, 'Scarpetta', 33140, 'Italian', 3, 'http://www.fontainebleau.com/web/dining/scarpetta'),
(39, 'Pubbelly Sushi', 33139, 'Sushi', 3, 'http://www.pubbellysushi.us/'),
(40, 'Chalan on the Beach', 33139, 'Peruvian', 3, 'http://southflorida.menupages.com/restaurants/chalan-on-the-beach/menu'),
(41, 'Zen Sai', 33139, 'Asian', 4, 'http://www.zensaisobe.com'),
(42, 'The Hidden Kitchen', 33140, 'American', 3, 'https://www.facebook.com/thehiddenkitchen'),
(43, 'Milos', 33139, 'Greek', 4, 'http://milos.ca/restaurants/miami'),
(44, 'STK', 33139, 'American', 4, 'http://www.stkhouse.com/'),
(45, 'Rosa Mexicano', 33139, 'Mexican', 3, 'http://rosamexicano.com/southbeach'),
(46, 'Michael Mina 74', 33410, 'American', 4, 'http://www.fontainebleau.com/web/dining/michael_mina_74'),
(47, 'Juvia', 33139, 'International', 4, 'http://www.juviamiami.com/'),
(48, 'Sylvano', 33139, 'Italian', 4, 'http://www.sylvanos.com/'),
(49, 'Market at Edition', 33140, 'American', 4, 'http://www.editionhotels.com/'),
(50, 'Vida', 33140, 'American', 4, 'http://www.fontainebleau.com/web/dining/vida');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
