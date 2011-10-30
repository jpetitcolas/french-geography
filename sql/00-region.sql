SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

CREATE TABLE IF NOT EXISTS `region` (
  `id` tinyint(3) unsigned NOT NULL auto_increment,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=29 ;

INSERT INTO `region` (`id`, `name`) VALUES
(1, 'Alsace'),
(2, 'Aquitaine'),
(3, 'Auvergne'),
(16, 'Basse-Normandie'),
(4, 'Bourgogne'),
(5, 'Bretagne'),
(6, 'Centre'),
(7, 'Champagne-Ardenne'),
(8, 'Corse'),
(9, 'Franche-Comté'),
(23, 'Guadeloupe'),
(24, 'Guyane'),
(17, 'Haute-Normandie'),
(10, 'Île-de-France'),
(27, 'La Réunion'),
(11, 'Languedoc-Roussillon'),
(12, 'Limousin'),
(13, 'Lorraine'),
(25, 'Martinique'),
(26, 'Mayotte'),
(14, 'Midi-Pyrénées'),
(15, 'Nord-Pas-de-Calais'),
(18, 'Pays de la Loire'),
(19, 'Picardie'),
(20, 'Poitou-Charentes'),
(21, 'Provence-Alpes-Côte d''Azur'),
(22, 'Rhône-Alpes'),
(28, 'Saint-Pierre-et-Miquelon');
