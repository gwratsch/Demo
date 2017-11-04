-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Machine: 127.0.0.1
-- Gegenereerd op: 03 nov 2017 om 22:29
-- Serverversie: 5.5.20-log
-- PHP-versie: 5.6.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Databank: `demo`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `author`
--

CREATE TABLE IF NOT EXISTS `author` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Name` char(255) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Gegevens worden geëxporteerd voor tabel `author`
--

INSERT INTO `author` (`ID`, `Name`) VALUES
(1, 'shiznit ligula'),
(2, 'Dawg stuff'),
(3, 'chung fo shizzle'),
(4, 'Dawg stuff dignissim'),
(5, 'Crizzle'),
(6, 'accumsizzle'),
(8, 'Curabitur sizzle amet leo nec mofo blandizzle dignissizzle');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `post`
--

CREATE TABLE IF NOT EXISTS `post` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Title` char(255) DEFAULT NULL,
  `Message` varchar(1500) DEFAULT NULL,
  `IDauthor` int(11) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=15 ;

--
-- Gegevens worden geëxporteerd voor tabel `post`
--

INSERT INTO `post` (`ID`, `Title`, `Message`, `IDauthor`) VALUES
(1, 'consequat uhuh', 'Mah nizzle blandizzle. Maecenas metus magna, things sure, lobortizzle fo shizzle mah nizzle fo rizzle, mah home g-dizzle, molestie shiznit, lacizzle. Morbi mi break it down, mammasay mammasa mamma oo sa sed, dapibizzle shut the shizzle up, pretizzle crazy, velizzle. We gonna chung fo shizzle tellus quizzle felis shizzlin dizzle aliquam.', 1),
(2, 'pizzle went crizzle nunc', 'sapizzle gizzle nunc. Donizzle eu dang. Vestibulizzle quizzle felis. My shizz elementizzle crazy erizzle. Sizzle nulla sem, volutpizzle fizzle, pot eget.', 2),
(3, 'tellus sizzle amet enizzle', 'Aenizzle nizzle ass nizzle brizzle mattizzle fo shizzle my nizzle. Sizzle break it down felizzle, laoreet id, shit quizzle, boofron nizzle, nizzle. Maecenizzle .', 3),
(4, 'Vivamus rutrizzle', 'Stuff at fo shizzle. Aliquizzle away fo shizzle, boofron consectetizzle, cool izzle, consequat uhuh ... yih!, fizzle. Fo shizzle mah nizzle fo rizzle, mah home g-dizzle', 2),
(5, 'eleifend nizzle', 'fizzle adipiscing elit. Go to hizzle sapien velit, nizzle volutpizzle, uhuh ... yih! quizzle, yippiyo vizzle, shizzle my nizzle crocodizzle. Pizzle cool tortizzle. Sed erizzle. Stuff ghetto shit dapibus turpis tempizzle shit. Mauris pellentesque izzle turpizzle. Things izzle tortor. Pellentesque rhoncus away.', 4),
(6, 'rizzle sheezy', 'Etiam a magna sed gangster accumsan. Aenizzle izzle gangsta. Vivamizzle mauris dolizzle, dawg vitae, pot izzle, gangster izzle, ass. Tellivizzle ante ipsizzle bling bling izzle stuff orci ma nizzle izzle check out this posuere check out this Curae; Bizzle dolizzle. Phat faucibizzle. Pot pharetra crunk phat. Vivamus rutrizzle aliquet orci. Sed facilisizzle.', 6),
(8, 'Aenizzle izzle gangsta', 'Bizzle dolizzle. Phat faucibizzle. Pot pharetra crunk phat. Vivamus rutrizzle aliquet orci. Sed facilisizzle. Dope sem shut the shizzle up, funky fresh eu, scelerisque vel, shiznit tellivizzle, mofo.', 5),
(9, 'dignissim felis', 'Sure shiznit ligula. Yo porta commodo sheezy. Aenean viverra, sapien izzle crunk hendrerit, libero urna hendrerizzle leo, non i saw beyonces tizzles and my pizzle went crizzle nunc sapizzle gizzle nunc. Donizzle eu dang. Vestibulizzle quizzle felis. My shizz elementizzle crazy erizzle. Sizzle nulla sem,', 1),
(10, 'Vivamizzle nizzle', 'Maecenas metus magna, things sure, lobortizzle fo shizzle mah nizzle fo rizzle, mah home g-dizzle, molestie shiznit, lacizzle. Morbi mi break it down, mammasay mammasa mamma oo sa sed, dapibizzle shut the shizzle up, pretizzle crazy, velizzle.', 1),
(12, 'waggelroede na deafsluitdijk bij de 4e afslag omkeren.', 'Vivamizzle nizzle check it out egizzle black my shizz pretizzle. Vivamizzle gizzle shit away. Stuff eu nisl egizzle lacizzle crazy. Praesent suscipizzle viverra hizzle. Curabitizzle fo shizzle arcu. Vestibulum enizzle shut the shizzle up, auctor gangsta, bow wow wow eu, away non, libero. Nullam vitae pede ghetto eros posuere break it down. Phat you son of a bizzle shiz, congue pulvinar, auctizzle a, funky fresh crunk amizzle, erizzle. Stuff at fo shizzle. Aliquizzle away fo shizzle, boofron cons', 8),
(13, 'mofo blandizzle', 'Maecenas izzle pimpin. Nizzle ero''. Proin shizznit'', turpizzle away dawg consectetizzle, metizzle izzle funky fresh crazy, eget shit ghetto cool check it out boofron. Crizzle faucibus elizzle. Fo shizzle my nizzle nibh shizznit, consequat , izzle &quot;volutpizzl&quot;, porttitizzle the bizzle, tellus. Proin you son of a bizzle urna.', 4),
(14, 'gonna chung fo shizzle tellus quizzle felis shizzlin dizzle aliquam.', 'Lorizzle ipsum uhuh ... yih! sizzle amizzle, fizzle adipiscing elit. Go to hizzle sapien velit, nizzle volutpizzle, uhuh ... yih! quizzle, yippiyo vizzle, shizzle my nizzle crocodizzle. Pizzle cool tortizzle. Sed erizzle. Stuff ghetto shit dapibus turpis tempizzle shit. Mauris pellentesque izzle turpizzle. Things izzle tortor. Pellentesque rhoncus away. Its fo rizzle dawg habitasse platea dope. Boofron dapibus. Curabitur dizzle , pretium eu, boofron ac, eleifend nizzle, nunc. Check out this fo shizzle. Gangster semper velizzle sed fo shizzle.', 6);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
