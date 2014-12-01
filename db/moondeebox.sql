-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Czas generowania: 01 Gru 2014, 22:37
-- Wersja serwera: 5.6.20
-- Wersja PHP: 5.5.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Baza danych: `moondeebox`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `activity`
--

CREATE TABLE IF NOT EXISTS `activity` (
`id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL DEFAULT ''
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Zrzut danych tabeli `activity`
--

INSERT INTO `activity` (`id`, `name`) VALUES
(1, 'editor'),
(2, 'creator');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `album`
--

CREATE TABLE IF NOT EXISTS `album` (
`id` bigint(20) NOT NULL,
  `owner` bigint(20) NOT NULL DEFAULT '0',
  `title` varchar(255) NOT NULL DEFAULT '',
  `describe` text NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=59 ;

--
-- Zrzut danych tabeli `album`
--

INSERT INTO `album` (`id`, `owner`, `title`, `describe`) VALUES
(16, 1, 'maciej', ''),
(44, 1, 'album 2', ''),
(58, 1, 'test', '');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `description`
--

CREATE TABLE IF NOT EXISTS `description` (
`id` bigint(20) NOT NULL,
  `writer` bigint(20) NOT NULL DEFAULT '0',
  `object_id` bigint(20) NOT NULL DEFAULT '0',
  `text` text NOT NULL,
  `kk` int(11) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=77 ;

--
-- Zrzut danych tabeli `description`
--

INSERT INTO `description` (`id`, `writer`, `object_id`, `text`, `kk`) VALUES
(59, 10, 10, 'text', 0),
(60, 10, 10, 'text 2', 0),
(61, 10, 10, 'text 2', 0),
(62, 1, 10, 'text 13\r\n', 0),
(63, 1, 10, 'Testowy opis 6', 0),
(71, 1, 1, 'Pracuję w domu, przez większość czasu eksplorując sieć.\r\nWyszukuję różne treści i dane, kategoryzuję je, analizuję, opracowuję i produkuję raporty, stanowiące wyciąg z przetworzonej masy informacji.\r\n\r\nPrywatnie często robię to samo, tylko tematykę sobie sama wybieram. No i wtedy rzadko takie badanie kończy się raportem, raczej krótkim podsumowaniem. Czasem nie kończy się wcale, tylko zostaje w mojej głowie.\r\n\r\nUwielbiam sieci społecznościowe. Kiedyś Usenet, potem różne fora, GoldenLine itp. Czytam, obserwuję ich rozwój i momenty największej popularności oraz powolne gaśnięcie.  \r\n\r\nNa G+ wrzucam wszystko co wydaje mi się warte przeczytania, zastanowienia lub obejrzenia.\r\nNa profil główny trafiają najważniejsze wpisy. Teksty z tematyki społecznej, gospodarczej i mediów, szczególnie internetowych. Często wyniki badań (moich lub cudzych). Polityki nie tykam. ', 0),
(73, 1, 72, 'Testowy opis miejsca', 0),
(74, 1, 72, 'Testowy opis miejsca 2', 0),
(75, 1, 72, 'Maciej testuje dodawanie opisow\r\n', 0);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `description_permission`
--

CREATE TABLE IF NOT EXISTS `description_permission` (
`id` bigint(20) NOT NULL,
  `object_id` bigint(20) NOT NULL DEFAULT '0',
  `group_id` bigint(20) NOT NULL DEFAULT '0',
  `method` varchar(255) NOT NULL DEFAULT ''
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Zrzut danych tabeli `description_permission`
--

INSERT INTO `description_permission` (`id`, `object_id`, `group_id`, `method`) VALUES
(1, 59, 0, 'getMark'),
(2, 59, 0, 'getText');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `email`
--

CREATE TABLE IF NOT EXISTS `email` (
`id` bigint(20) NOT NULL,
  `email` varchar(255) NOT NULL DEFAULT '',
  `object_id` bigint(20) NOT NULL DEFAULT '0'
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Zrzut danych tabeli `email`
--

INSERT INTO `email` (`id`, `email`, `object_id`) VALUES
(5, 'maciejkonkol@o2.pl', 1),
(6, 'michalkonkel@o2.pl', 2);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `group`
--

CREATE TABLE IF NOT EXISTS `group` (
`id` bigint(20) NOT NULL,
  `name` varchar(255) NOT NULL DEFAULT '',
  `owner` bigint(20) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=32 ;

--
-- Zrzut danych tabeli `group`
--

INSERT INTO `group` (`id`, `name`, `owner`) VALUES
(1, 'Znajomi', 1),
(2, 'Rodzina', 1),
(9, 'Znajomi', 8),
(10, 'Rodzina', 8),
(11, 'Dalsi znajomi', 8),
(12, 'Znajomi', 9),
(13, 'Rodzina', 9),
(14, 'Dalsi znajomi', 9),
(15, 'test', 1),
(16, 'maciej', 1),
(17, 'halo', 1),
(18, 'kolo', 1),
(19, 'orta', 1),
(20, 'kolpak', 1),
(21, 'Administratorzy', 12),
(22, 'grupa 2', 1),
(23, 'Administratorzy', 46),
(24, 'Administratorzy', 47),
(25, 'Administratorzy', 51),
(26, 'Administratorzy', 54),
(27, 'Administratorzy', 55),
(28, 'Administratorzy', 57),
(29, 'Znajomi', 2),
(30, 'Administratorzy', 71),
(31, 'Administratorzy', 72);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `group-object`
--

CREATE TABLE IF NOT EXISTS `group-object` (
`id` bigint(20) NOT NULL,
  `group_id` bigint(20) NOT NULL DEFAULT '0',
  `object_id` bigint(20) NOT NULL DEFAULT '0'
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Zrzut danych tabeli `group-object`
--

INSERT INTO `group-object` (`id`, `group_id`, `object_id`) VALUES
(1, 1, 2),
(2, 2, 2),
(3, 2, 10),
(5, 15, 2),
(6, 16, 2),
(7, 17, 2),
(8, 1, 10),
(9, 21, 1),
(10, 29, 1);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `image`
--

CREATE TABLE IF NOT EXISTS `image` (
`id` bigint(20) NOT NULL,
  `album` bigint(20) NOT NULL DEFAULT '0',
  `title` varchar(255) NOT NULL DEFAULT '',
  `describe` text NOT NULL,
  `date_execution` datetime NOT NULL,
  `date_added` datetime NOT NULL,
  `server` varchar(255) NOT NULL,
  `path` varchar(255) NOT NULL,
  `file` varchar(255) NOT NULL,
  `extension` varchar(255) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=46 ;

--
-- Zrzut danych tabeli `image`
--

INSERT INTO `image` (`id`, `album`, `title`, `describe`, `date_execution`, `date_added`, `server`, `path`, `file`, `extension`) VALUES
(35, 16, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '00/00/00/00/00/00/00/00/00', '35', 'jpg'),
(45, 16, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '00/00/00/00/00/00/00/00/00', '45', 'jpg');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `like`
--

CREATE TABLE IF NOT EXISTS `like` (
`id` bigint(20) NOT NULL,
  `user_id` bigint(20) NOT NULL DEFAULT '0',
  `object_id` bigint(20) NOT NULL DEFAULT '0',
  `date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Zrzut danych tabeli `like`
--

INSERT INTO `like` (`id`, `user_id`, `object_id`, `date`) VALUES
(2, 1, 2, '2013-12-16 11:13:22'),
(3, 1, 12, '2013-12-17 19:56:00');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `mark`
--

CREATE TABLE IF NOT EXISTS `mark` (
`id` bigint(20) NOT NULL,
  `judge` bigint(20) NOT NULL DEFAULT '0',
  `object` bigint(20) NOT NULL DEFAULT '0',
  `value` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=19 ;

--
-- Zrzut danych tabeli `mark`
--

INSERT INTO `mark` (`id`, `judge`, `object`, `value`) VALUES
(13, 1, 10, 7),
(14, 1, 72, 10),
(18, 1, 73, 10);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `mark_average`
--

CREATE TABLE IF NOT EXISTS `mark_average` (
`id` bigint(20) NOT NULL,
  `object` bigint(20) NOT NULL DEFAULT '0',
  `value` float NOT NULL DEFAULT '0',
  `num` bigint(20) NOT NULL DEFAULT '0'
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Zrzut danych tabeli `mark_average`
--

INSERT INTO `mark_average` (`id`, `object`, `value`, `num`) VALUES
(1, 10, 8.66667, 6),
(2, 59, 0, 0),
(3, 62, 0, 0),
(4, 63, 0, 0),
(5, 73, 6.66667, 9),
(6, 74, 4, 4),
(7, 72, 10, 1),
(8, 75, 0, 0);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `menu`
--

CREATE TABLE IF NOT EXISTS `menu` (
`id` int(11) NOT NULL,
  `module` varchar(255) NOT NULL DEFAULT '',
  `controller` varchar(255) NOT NULL DEFAULT '',
  `action` varchar(255) NOT NULL DEFAULT '',
  `label` varchar(255) NOT NULL DEFAULT '',
  `icon` varchar(255) NOT NULL DEFAULT '',
  `rout` varchar(255) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Zrzut danych tabeli `menu`
--

INSERT INTO `menu` (`id`, `module`, `controller`, `action`, `label`, `icon`, `rout`) VALUES
(1, 'entity', 'user', 'groups', 'Grupy', 'groups', 'grupy'),
(2, 'image', 'image', 'albums', 'Obrazy', 'images', 'albums'),
(3, 'entity', 'place', 'index', 'MIejsca', 'places', 'miejsca'),
(4, 'entity', 'place', 'addplace', 'Dodaj miejsce', 'addplaces', 'dodaj_miejsce');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `moondee_object`
--

CREATE TABLE IF NOT EXISTS `moondee_object` (
`id` bigint(20) NOT NULL,
  `class` varchar(255) NOT NULL DEFAULT ''
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=78 ;

--
-- Zrzut danych tabeli `moondee_object`
--

INSERT INTO `moondee_object` (`id`, `class`) VALUES
(1, 'Moondee_Entity_User'),
(2, 'Moondee_Entity_User'),
(3, 'Moondee_Entity_User'),
(4, 'Moondee_Entity_User'),
(5, 'Moondee_Entity_User'),
(6, 'Moondee_Entity_User'),
(7, 'Moondee_Entity_User'),
(8, 'Moondee_Entity_User'),
(9, 'Moondee_Entity_User'),
(10, 'Moondee_Entity_Attraction_Place'),
(11, 'Moondee_Entity_Attraction_Place'),
(12, 'Moondee_Entity_Attraction_Place'),
(13, 'Moondee_Image_Album'),
(14, 'Moondee_Image_Album'),
(15, 'Moondee_Image_Album'),
(16, 'Moondee_Image_Album'),
(26, 'Moondee_Image_Album'),
(27, 'Moondee_Image'),
(28, 'Moondee_Image'),
(29, 'Moondee_Image'),
(30, 'Moondee_Image'),
(31, 'Moondee_Image'),
(32, 'Moondee_Image'),
(35, 'Moondee_Image'),
(42, 'Moondee_Image'),
(43, 'Moondee_Image_Album'),
(44, 'Moondee_Image_Album'),
(45, 'Moondee_Image'),
(46, 'Moondee_Entity_Attraction_Place'),
(47, 'Moondee_Entity_Attraction_Place'),
(48, 'Moondee_Entity_Attraction_Place'),
(49, 'Moondee_Entity_Attraction_Place'),
(50, 'Moondee_Entity_Attraction_Place'),
(51, 'Moondee_Entity_Attraction_Place'),
(52, 'Moondee_Entity_Attraction_Place'),
(53, 'Moondee_Entity_Attraction_Place'),
(54, 'Moondee_Entity_Attraction_Place'),
(55, 'Moondee_Entity_Attraction_Place'),
(56, 'Moondee_Entity_Attraction_Place'),
(57, 'Moondee_Entity_Attraction_Place'),
(58, 'Moondee_Image_Album'),
(59, 'Moondee_Description'),
(60, 'Moondee_Description'),
(61, 'Moondee_Description'),
(62, 'Moondee_Description'),
(63, 'Moondee_Description'),
(64, 'Moondee_Description'),
(65, 'Moondee_Description'),
(66, 'Moondee_Description'),
(67, 'Moondee_Description'),
(68, 'Moondee_Description'),
(69, 'Moondee_Description'),
(70, 'Moondee_Description'),
(71, 'Moondee_Entity_Attraction_Place'),
(72, 'Moondee_Entity_Attraction_Place'),
(73, 'Moondee_Description'),
(74, 'Moondee_Description'),
(75, 'Moondee_Description'),
(76, 'Moondee_Description'),
(77, 'Moondee_Description');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `object-object-activity`
--

CREATE TABLE IF NOT EXISTS `object-object-activity` (
`id` bigint(20) NOT NULL,
  `object1_id` bigint(20) NOT NULL DEFAULT '0',
  `object2_id` bigint(20) NOT NULL DEFAULT '0',
  `activity_id` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Zrzut danych tabeli `object-object-activity`
--

INSERT INTO `object-object-activity` (`id`, `object1_id`, `object2_id`, `activity_id`) VALUES
(1, 1, 10, 1),
(2, 1, 57, 2),
(3, 1, 71, 2),
(4, 1, 72, 2);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `place`
--

CREATE TABLE IF NOT EXISTS `place` (
`id` bigint(20) NOT NULL,
  `name` varchar(255) NOT NULL DEFAULT '',
  `owner` bigint(20) NOT NULL DEFAULT '0'
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=73 ;

--
-- Zrzut danych tabeli `place`
--

INSERT INTO `place` (`id`, `name`, `owner`) VALUES
(10, 'Jastarnia', 0),
(12, 'Puck', 0),
(57, 'uuu', 1),
(71, 'wladek', 0),
(72, 'torba', 0);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `place_permission`
--

CREATE TABLE IF NOT EXISTS `place_permission` (
`id` bigint(20) NOT NULL,
  `object_id` bigint(20) NOT NULL DEFAULT '0',
  `group_id` bigint(20) NOT NULL DEFAULT '0',
  `method` varchar(255) NOT NULL DEFAULT ''
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Zrzut danych tabeli `place_permission`
--

INSERT INTO `place_permission` (`id`, `object_id`, `group_id`, `method`) VALUES
(1, 12, 21, 'getAbout'),
(2, 12, 21, 'getAlbums');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `user`
--

CREATE TABLE IF NOT EXISTS `user` (
`id` bigint(20) NOT NULL,
  `name` varchar(255) NOT NULL DEFAULT '',
  `surname` varchar(255) NOT NULL DEFAULT '',
  `password` varchar(255) NOT NULL DEFAULT ''
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Zrzut danych tabeli `user`
--

INSERT INTO `user` (`id`, `name`, `surname`, `password`) VALUES
(1, 'Maciej', 'Konkol', 'c37976221ab2fefc5578fb38f7003ef9'),
(2, 'Michał', 'Debil', 'c37976221ab2fefc5578fb38f7003ef9'),
(8, 'Teresa', 'Konkol', '21ceb9c2ca307e0a4f835fb3a699e9fe'),
(9, 'Teresa', 'Konkol', '21ceb9c2ca307e0a4f835fb3a699e9fe');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `user-place`
--

CREATE TABLE IF NOT EXISTS `user-place` (
`id` bigint(20) NOT NULL,
  `user_id` bigint(20) NOT NULL DEFAULT '0',
  `place_id` bigint(20) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `user_permission`
--

CREATE TABLE IF NOT EXISTS `user_permission` (
`id` bigint(20) NOT NULL,
  `object_id` bigint(20) NOT NULL DEFAULT '0',
  `group_id` bigint(20) NOT NULL DEFAULT '0',
  `method` varchar(255) NOT NULL DEFAULT ''
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Zrzut danych tabeli `user_permission`
--

INSERT INTO `user_permission` (`id`, `object_id`, `group_id`, `method`) VALUES
(1, 1, 1, 'setName'),
(2, 1, 1, 'getName'),
(3, 1, 2, 'getSurname'),
(4, 1, 2, 'getName'),
(5, 1, 0, 'getName'),
(6, 1, 0, 'getSurname'),
(7, 2, 0, 'getName'),
(8, 2, 0, 'getSurname'),
(9, 2, 29, 'getAlbums');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indexes for table `activity`
--
ALTER TABLE `activity`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `album`
--
ALTER TABLE `album`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `description`
--
ALTER TABLE `description`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `description_permission`
--
ALTER TABLE `description_permission`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `email`
--
ALTER TABLE `email`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `group`
--
ALTER TABLE `group`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `group-object`
--
ALTER TABLE `group-object`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `image`
--
ALTER TABLE `image`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `like`
--
ALTER TABLE `like`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mark`
--
ALTER TABLE `mark`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mark_average`
--
ALTER TABLE `mark_average`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `moondee_object`
--
ALTER TABLE `moondee_object`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `object-object-activity`
--
ALTER TABLE `object-object-activity`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `place`
--
ALTER TABLE `place`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `place_permission`
--
ALTER TABLE `place_permission`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user-place`
--
ALTER TABLE `user-place`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_permission`
--
ALTER TABLE `user_permission`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT dla tabeli `activity`
--
ALTER TABLE `activity`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT dla tabeli `album`
--
ALTER TABLE `album`
MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=59;
--
-- AUTO_INCREMENT dla tabeli `description`
--
ALTER TABLE `description`
MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=77;
--
-- AUTO_INCREMENT dla tabeli `description_permission`
--
ALTER TABLE `description_permission`
MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT dla tabeli `email`
--
ALTER TABLE `email`
MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT dla tabeli `group`
--
ALTER TABLE `group`
MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=32;
--
-- AUTO_INCREMENT dla tabeli `group-object`
--
ALTER TABLE `group-object`
MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT dla tabeli `image`
--
ALTER TABLE `image`
MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=46;
--
-- AUTO_INCREMENT dla tabeli `like`
--
ALTER TABLE `like`
MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT dla tabeli `mark`
--
ALTER TABLE `mark`
MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT dla tabeli `mark_average`
--
ALTER TABLE `mark_average`
MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT dla tabeli `menu`
--
ALTER TABLE `menu`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT dla tabeli `moondee_object`
--
ALTER TABLE `moondee_object`
MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=78;
--
-- AUTO_INCREMENT dla tabeli `object-object-activity`
--
ALTER TABLE `object-object-activity`
MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT dla tabeli `place`
--
ALTER TABLE `place`
MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=73;
--
-- AUTO_INCREMENT dla tabeli `place_permission`
--
ALTER TABLE `place_permission`
MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT dla tabeli `user`
--
ALTER TABLE `user`
MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT dla tabeli `user-place`
--
ALTER TABLE `user-place`
MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT dla tabeli `user_permission`
--
ALTER TABLE `user_permission`
MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
