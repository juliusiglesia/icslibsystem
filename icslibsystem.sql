-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 11, 2014 at 10:28 AM
-- Server version: 5.5.24-log
-- PHP Version: 5.4.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `icslibsystem`
--

-- --------------------------------------------------------

--
-- Table structure for table `administrator`
--

CREATE TABLE IF NOT EXISTS `administrator` (
  `username` varchar(30) NOT NULL,
  `fname` varchar(30) NOT NULL,
  `mname` varchar(20) NOT NULL,
  `lname` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `enum` varchar(11) NOT NULL,
  `password` varchar(100) NOT NULL,
  `lastsession` datetime NOT NULL,
  PRIMARY KEY (`username`),
  UNIQUE KEY `enum` (`enum`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `administrator`
--

INSERT INTO `administrator` (`username`, `fname`, `mname`, `lname`, `email`, `enum`, `password`, `lastsession`) VALUES
('icslibadmin', 'Marites', 'A', 'Gironella', 'icslibsystem@gmail.com', '11101111341', '53fc06bd596f54cf3c3092f3f480b18455ab2d32', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `author`
--

CREATE TABLE IF NOT EXISTS `author` (
  `fname` varchar(30) NOT NULL,
  `mname` varchar(20) NOT NULL,
  `lname` varchar(20) NOT NULL,
  `materialid` varchar(15) NOT NULL,
  `isbn` varchar(10) NOT NULL,
  PRIMARY KEY (`materialid`,`isbn`,`fname`,`mname`,`lname`),
  KEY `materialid` (`materialid`),
  KEY `isbn` (`isbn`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `author`
--

INSERT INTO `author` (`fname`, `mname`, `lname`, `materialid`, `isbn`) VALUES
('Richard', 'Blahut', 'Harper', 'CD-1', '+CD-1'),
('Wendy', 'Schweidel', 'Moe', 'CD-2', '+CD-2'),
('Damian', 'Rouson', 'Nguyen', 'CD-3', '+CD-3'),
('Stephen', 'Brass', 'Cook', 'CD-4', '+CD-4'),
('Nathalie', 'Japcowickz', 'Kohli', 'CD-5', '+CD-5'),
('Larisse', 'Almonte', 'Ramos', 'SP1982-1', '+SP1982-1'),
('Floura', 'Ponsetti', 'Contreras', 'SP1986-4', '+SP1986-4'),
('Edmon', 'Robes', 'Culiat', 'SP1986-5', '+SP1986-5'),
('Rick  Jr.', 'Cruz', 'Bates', 'SP1987-2', '+SP1987-2'),
('Jen Rick', 'Galado', 'Manalo', 'SP1987-3', '+SP1987-3'),
('Lawrence', 'Libo', 'Calagday', 'SP1988-1', '+SP1988-1'),
('Emerson', 'Arca', 'Menguito', 'SP1988-10b', '+SP1988-10'),
('Zy Carl', 'Bautista', 'Moti', 'SP1988-11', '+SP1988-11'),
('Maria Jane', 'Gallardo', 'Oliveros', 'SP1988-12a', '+SP1988-12'),
('Maria Jane', 'Gallardo', 'Oliveros', 'SP1988-13b', '+SP1988-13'),
('Pauleen', 'Santos', 'Polilen', 'SP1988-14', '+SP1988-14'),
('Jimson', 'Madela', 'Roa', 'SP1988-16', '+SP1988-16'),
('Clarianne', 'Selica', 'Su', 'SP1988-18a', '+SP1988-18'),
('Clarianne', 'Selica', 'Su', 'SP1988-19b', '+SP1988-19'),
('Sheena', 'Libero', 'Dayaoen', 'SP1988-2', '+SP1988-2'),
('Jowns', 'Tibe', 'Jonas', 'SP1988-4a', '+SP1988-4a'),
('Jowns', 'Tibe', 'Jonas', 'SP1988-5b', '+SP1988-5b'),
('Flor', 'Lobo', 'Lansigan', 'SP1988-6', '+SP1988-6'),
('Frederick', 'Labo', 'Lansigan', 'SP1988-6', '+SP1988-6'),
('Aaron Rom', 'Joenne', 'Lustria', 'SP1988-7a', '+SP1988-7a'),
('Aaron Rom', 'Joenne', 'Lustria', 'SP1988-8b', '+SP1988-8b'),
('Emerson', 'Arca', 'Menguito', 'SP1988-9a', '+SP1988-9a'),
('Aleen', 'Delos barrios', 'Araza', 'SP1989-1', '+SP1989-1'),
('Sheila', 'Pendon', 'Dela Cruz', 'SP1989-2', '+SP1989-2'),
('Maria Victoria', 'Callado', 'Elioraga', 'SP1989-3', '+SP1989-3'),
('Lauren', 'Quinto', 'Ho', 'SP1989-4', '+SP1989-4'),
('Gimmel', 'Barto', 'Layson', 'SP1989-5', '+SP1989-5'),
('Arada', 'Preza', 'Manila', 'SP1989-6', '+SP1989-6'),
('Adrian', 'Gosin', 'Natividad', 'SP1989-7', '+SP1989-7'),
('John Erick', 'Sendon', 'San Mateo', 'SP1989-8', '+SP1989-8'),
('Priscilla', 'Bustos', 'Cataggatan', 'SP1990-1', '+SP1990-1'),
('Claire', 'Vicente', 'Cando', 'SP1990-10', '+SP1990-10'),
('Emerald', 'Hinto', 'Gamace', 'SP1990-11', '+SP1990-11'),
('Wille', 'Vasquez', 'Moraca', 'SP1990-12', '+SP1990-13'),
('Aditi', 'Akal', 'Kotkar', 'T-1', '+T-1'),
('John', 'Stronk', 'Lewis', 'T-2', '+T-2'),
('Aruna', 'Allura', 'Whitney', 'T-3', '+T-3'),
('Park', 'Patel', 'Marovac', 'T-4', '+T-4'),
('Thomas', 'Drudge', 'Smiths', 'T-5', '+T-5'),
('Michael', 'Haws', 'Thorne', 'CS131-O1', '0007714358'),
('Michael', 'Haws', 'Thorne', 'CS132-P1', '0077143580'),
('Rolex', 'Watchers', 'Zwass', 'CS11-C39', '0086422468'),
('Meitel', 'Heinz', 'Pietrek', 'CS125-J3', '0091435802'),
('Johnson', 'Pines', 'Stanley', 'CS1-A1', '0123456789'),
('Gale', 'Hamps', 'Larsen', 'CS1-A8', '0135792468'),
('Cecelia', 'Hillary', 'Huffman', 'J-7', '0140002282'),
('Lynne', 'Idea', 'Harris', 'J-7', '0140002282'),
('Bernard', 'Cults', 'Kolman', 'R-46', '0142909943'),
('Marquee', 'Mart', 'Moves', 'CS21-D5', '0190874358'),
('Nicholas', 'Barrows', 'Barrakati', 'CS125-J1', '0200914358'),
('Erick Jones', 'Merdina', 'Award', 'CS128-L1', '0225514358'),
('Anne Marie', 'Diggy', 'Kelly', 'J-2', '0228201400'),
('Kathy', 'Clark', 'Fisher', 'J-2', '0228201400'),
('Shaneley', 'Salms', 'Furu', 'CS191-X1', '0246804358'),
('Richards', 'Owell', 'Dahl', 'CS124-I2', '0352546789'),
('Roy', 'Goussy', 'Peddicord', 'CS124-I2', '0352546789'),
('Tum', 'Berners', 'Lee', 'CS2-B4', '0435802468'),
('Marx', 'Durkheim', 'Weber', 'CS132-P2', '0771435800'),
('Imalrii', 'Lerista', 'Copi', 'CS57-F2', '0775564358'),
('Mauty', 'Toners', 'Bonissan', 'CS57-F2', '0775564358'),
('Relly', 'Voinne', 'Johnsonbaugh', 'CS57-F2', '0775564358'),
('Carson', 'Mitt', 'Weens', 'CS11-C4', '0864224680'),
('Newterr', 'Orro', 'Dahle', 'CS11-C4', '0864224680'),
('Dickson', 'Jox', 'Dietel', 'CS22-E4', '0874358019'),
('Wilson', 'Jox', 'Dietel', 'CS22-E4', '0874358019'),
('Hammer', 'Moans', 'Deitel', 'CS125-J4', '0914358020'),
('Guo', 'Jie', 'Li', 'J-1', '0927129486'),
('Luther', 'Jonievel', 'Goldstein', 'CS11-C11', '0987612345'),
('Rimasen', 'Looper', 'Carino', 'CS150-T1', '0987654358'),
('Ulmatra', 'Hugde', 'Suits', 'CS11-C34', '1135799753'),
('Christopher', 'Judd', 'Borland', 'CS11-C16', '1213141516'),
('Michael', 'Skimm', 'Dears', 'CS1-A9', '1234509876'),
('Kate', 'Movel', 'Jamsa', 'CS1-A10', '1234567890'),
('Alicia', 'Lems', 'Stickely', 'J-13', '1294860927'),
('Chris', 'Fletcher', 'Rouff', 'J-13', '1294860927'),
('Hellen', 'Tiger', 'Scott', 'J-13', '1294860927'),
('Wilson', 'Jines', 'Savitch', 'CS11-C18', '1314151612'),
('Anna', 'Morrows', 'Mittelbach', 'CS1-A2', '1357924680'),
('Lady', 'Lee', 'Goosens', 'CS1-A2', '1357924680'),
('Anthony', 'Rivers', 'Guddens', 'CS11-C25', '1357997531'),
('Cecelia', 'Hillary', 'Huffman', 'J-8', '1400022820'),
('Witther', 'Keins', 'Salmon', 'CS11-C2', '1415161213'),
('Glider', 'Janes', 'Peterson', 'CS141-R1', '1435800077'),
('Harold', 'Ruins', 'Lewis', 'CS141-R1', '1435800077'),
('Aldens', 'Kreens', 'Gardner', 'CS127-K2', '1435802009'),
('Alfred', 'Vierra', 'Aho', 'CS129-M10', '1435802255'),
('Evann', 'Muriir', 'Butterfield', 'M-11', '14436576'),
('Robin', 'Buds', 'Baldwin', 'M-11', '14436576'),
('Chrsitopher', 'Judd', 'Borland', 'CS11-C21', '1516121314'),
('Hilda', 'Entoussy', 'Carman', 'M-13', '15436566'),
('Angela', 'Riddons', 'Burgens', 'M-1', '15436576'),
('Chris', 'Stofff', 'Jensen', 'M-10', '15436577'),
('Chris', 'Stoff', 'Jensen', 'M-12', '15536576'),
('Sandra', 'Angers', 'Brown', 'M-12', '15536576'),
('Christopher', 'Judd', 'Borland', 'CS11-C23', '1612131415'),
('Christopher', 'Judd', 'Borland', 'CS21-D6', '1908743580'),
('Homer', 'Tiners', 'Woods', 'CS125-J2', '2009143580'),
('Kimberly', 'Tanes', 'Francia', 'J-6', '2014000228'),
('Christopher', 'Judd', 'Borland', 'CS11-C17', '2131415161'),
('Alwyn', 'Dark', 'Lien', 'CS11-C7', '2246800864'),
('Jennifer', 'Maice', 'Ettlie', 'CS128-L2', '2255143580'),
('Georganni', 'Mislet', 'Prker', 'J-3', '2282014000'),
('Eric', 'Rolls', 'Berkowitz', 'M-7', '23057481'),
('Winely', 'Starrow', 'Stanek', 'CS100-G1', '2345098761'),
('Jordan', 'Kee', 'Uffenbeck', 'CS1-A11', '2345678901'),
('Nicklaus', 'Clooney', 'Wirth', 'CS11-C35', '2468008642'),
('Stanlee', 'Chim', 'Chernicoff', 'CS1-A4', '2468013579'),
('Liebner', 'Sheera', 'Rabiner', 'CS191-X2', '2468043580'),
('Jennifer', 'Smush', 'Karuth', 'M-14', '25436576'),
('Eliezer', 'Santos', 'Albacea', 'CS123-FC1', '2546789035'),
('Jonas', 'Deens', 'Musa', 'CS128-L4', '2551435802'),
('John', 'Limo', 'Reimer', 'J-11', '2712948609'),
('Georganni', 'Mislet', 'Parker', 'J-4', '2820140002'),
('Kittty', 'Niville', 'Actions', 'J-14', '2948609271'),
('John', 'Galls', 'Miller', 'M-5', '29571436'),
('Mandy', 'Vega', 'Rogers', 'CS11-C33', '3113579975'),
('Christopher', 'Judd', 'Borland', 'CS11-C19', '3141516121'),
('Laurent', 'Steal', 'Simon', 'CS100-G2', '3450987612'),
('Ythan', 'Wise', 'Liu', 'CS1-A12', '3456789012'),
('Doughie', 'Poynter', 'Gries', 'CS11-C8', '3525467890'),
('Georgana', 'Johnson', 'Carter', 'M-15', '35436576'),
('Mickey', 'Moussy', 'Mouse', 'CS1-A20', '3579246801'),
('Baldimoore', 'Clickens', 'Bitsley', 'CS11-C26', '3579975311'),
('Michael', 'Means', 'Mano', 'CS130-N1', '3580007714'),
('Panes', 'Jocka', 'Paluge', 'CS21-D2', '3580190874'),
('Clarkson', 'Baulsy', 'Stein', 'CS124-I4', '3580200914'),
('Erick Jones', 'Merdina', 'Award', 'CS127-K4', '3580225514'),
('Neil', 'Carl', 'Rowe', 'CS170-V6', '3580246804'),
('Relly', 'Voinne', 'Johnsonbaugh', 'CS56-F1', '3580775564'),
('Eliezer', 'Santos', 'Albacea', 'CS56-FC1', '3580775564'),
('Eliezer', 'Santos', 'Albacea', 'CS142-FC1', '3580987654'),
('Margo', 'Verouch', 'McCall', 'J-9', '4000228201'),
('Matt ', 'Adams', 'Peter', 'J-9', '4000228201'),
('Ray', 'Advers', 'Khan', 'M-9', '40964575'),
('Christopher', 'Judd', 'Borland', 'CS11-C20', '4151612131'),
('Chlost', 'Bane', 'Rines', 'CS11-C6', '4224680086'),
('Goffy', 'Gall', 'Belford', 'CS11-C6', '4224680086'),
('Louie', 'Kent', 'Liu', 'CS11-C6', '4224680086'),
('Jefferey', 'Donsey', 'Ulman', 'CS129-M10', '4358000771'),
('Ravi', 'Nuisance', 'Setti', 'CS129-M10', '4358000771'),
('Jennifer', 'Pits', 'Tremblay', 'CS129-M2', '4358000771'),
('Christopher', 'Judd', 'Borland', 'CS21-D1', '4358019087'),
('Croods', 'Reileen', 'Litecky', 'CS124-I3', '4358020091'),
('Diether', 'Groose', 'Kroenke', 'CS127-K3', '4358022551'),
('Neil', 'Carl', 'Rowe', 'CS170-V2', '4358024680'),
('Dorit', 'Fritz', 'Hochbaum', 'CS245-FC2', '4358077556'),
('Dorit', 'Kock', 'Hochbaum', 'CS245-FC2', '4358077556'),
('Joel', 'Cusrt', 'Martin', 'CS141-R2', '4358098765'),
('Revery', 'Main', 'Jones', 'CS11-C1', '4509876123'),
('Jennifer', 'Juns', 'Stout', 'M-16', '45436576'),
('Thomas', 'Dict', 'Webster', 'CS1-A13', '4567890123'),
('Roger', 'Lames', 'Kruse', 'CS123-H2', '4678903525'),
('Jovan', 'Dickens', 'Couger', 'CS11-C36', '4680086422'),
('Ralph', 'Eds', 'Krumn', 'CS1-A5', '4680135792'),
('Topper', 'Tunes', 'Lasquey', 'CS2-B1', '4680435802'),
('Adlex', 'Ethorne', 'Joynes', 'J-16', '4860927129'),
('Bonnie', 'Nets', 'Worky', 'CS11-C10', '5098761234'),
('Jerry', 'Pits', 'Tremblay', 'CS129-M1', '5143580225'),
('Christopher', 'Judd', 'Borland', 'CS11-C22', '5161213141'),
('John Stevan', 'Eritzx', 'Hopaoft', 'CS11-C9', '5254678903'),
('Chris', 'Amouric', 'Evans', 'CS11-C31', '5311357997'),
('Coney', 'Boons', 'Jackson', 'CS170-V1', '5435809876'),
('Rallie', 'Anderson', 'Edmands', 'CS170-V1', '5435809876'),
('Weige', 'Quine', 'Amsbury', 'CS123-H1', '5467890352'),
('Danouver', 'Goods', 'Johnson', 'CS128-L6', '5514358022'),
('Steve', 'Jackson', 'Woods', 'M-17', '55436576'),
('Rickson', 'Cart', 'Brenner', 'CS1-A15', '5678901234'),
('Richard', 'Loyce', 'Levice', 'R-47', '5690143985'),
('Mack', 'Joe', 'Adams', 'CS1-A21', '5792468013'),
('Christopher', 'Judd', 'Borland', 'CS11-C27', '5799753113'),
('George', 'Honey', 'Olsen', 'CS130-N15', '5800077143'),
('Hanes', 'Montes', 'Templeton', 'CS21-D3', '5801908743'),
('Peter', 'Rovens', 'Robinsons', 'CS124-I5', '5802009143'),
('Carl', 'James', 'Date', 'CS127-K49', '5802255143'),
('Gaunteer', 'Shirt', 'Almasi', 'CS180-W1', '5802468043'),
('Sheen', 'Doell', 'Arbib', 'CS142-S1', '5809876543'),
('Doughie', 'Lee', 'Poynter', 'J-18', '6092712948'),
('Alie', 'Movins', 'Ghinx', 'CS11-C24', '6121314151'),
('Lee', 'Rivens', 'Carter', 'CS11-C24', '6121314151'),
('Christopher', 'Judd', 'Borland', 'CS11-C15', '6123450987'),
('Julie', 'Beans', 'Tatnal', 'CS11-C5', '6422468008'),
('Wage', 'Lou', 'Devey', 'CS11-C5', '6422468008'),
('Roger', 'Tums', 'Steven', 'CS161-U8', '6543580987'),
('John', 'Galls', 'Miller', 'M-3', '66205898'),
('Baldy', 'Brooks', 'Holloway', 'CS1-A16', '6789012345'),
('Meadows', 'Axent', 'Weiss', 'CS123-H3', '6789035254'),
('Christopher', 'Judd', 'Borland', 'CS11-C37', '6800864224'),
('James', 'Olie', 'Stewart', 'CS1-A6', '6801357924'),
('Tim', 'Berners', 'Lee', 'CS2-B2', '6804358024'),
('Ted', 'Fones', 'Rozolis', 'J-12', '7129486092'),
('Sonny', 'Shears', 'Mueller', 'CS137-Q2', '7143580007'),
('Garcy', 'Glo', 'Johnson', 'CS245-FC1', '7435801908'),
('Garcy', 'Lee', 'Johnson', 'CS245-FC1', '7435801908'),
('Harry', 'Cloaks', 'Heinumann', 'CS11-C30', '7531135799'),
('Leona', 'Advil', 'Gesics', 'M-18', '75436576'),
('Bruth', 'Minna', 'Kolman', 'CS57-F4', '7556435807'),
('Sulivan', 'Spoon', 'Nadisto', 'CS11-C14', '7612345098'),
('Andre', 'Gammer', 'Houts', 'M-20', '76205898'),
('Asher', 'Knowles', 'Tanmebaum', 'CS137-Q1', '7714358000'),
('Micro', 'Tier', 'Kernel', 'CS1-A17', '7890123456'),
('Amerald', 'Mellark', 'Tanembaum', 'CS123-H4', '7890352546'),
('Winston', 'Royce', 'Enitour', 'CS123-H4', '7890352546'),
('Evann', 'Muriir', 'Battlefield', 'M-6', '79057438'),
('Christopher', 'Judd', 'Borland', 'CS11-C28', '7997531135'),
('Looniers', 'Winge', 'Couch', 'CS130-N2', '8000771435'),
('Arnold', 'Long', 'Schneider', 'CS11-C38', '8008642246'),
('Pickart', 'Renson', 'Mendez', 'CS1-A7', '8013579246'),
('Levi', 'Geans', 'Hancock', 'CS21-D4', '8019087435'),
('Tony', 'Miller', 'Stanler', 'CS21-D4', '8019087435'),
('Eliezer', 'Santos', 'Albacea', 'CS125-FC1', '8020091435'),
('Carl', 'James', 'Date', 'CS127-K69', '8022551435'),
('Peter', 'Hanner', 'Bailey', 'CS180-W2', '8024680435'),
('Tom', 'Berners', 'Lee', 'CS2-B3', '8043580246'),
('Margarita Carmen', 'Sanchez', 'Paterno', 'CS56-FC1', '8077556435'),
('Mannilow', 'Rooter', 'Garey', 'CS142-S2', '8098765435'),
('Helene', 'Lottery', 'Crowfoot', 'J-5', '8201400022'),
('Charlotte', 'Vinnters', 'Sprouters', 'J-17', '8609271294'),
('Rolex', 'Watchers', 'Zwass', 'CS11-C40', '8642246800'),
('Faye', 'Halts', 'Meadows', 'M-4', '86451100'),
('Ray', 'Advers', 'Khan', 'M-4', '86451100'),
('Hamdy', 'Amders', 'Taha', 'R-45', '8645110043'),
('Andy', 'Jones', 'Wellings', 'CS22-FC1', '8743580190'),
('Randy', 'Moons', 'Jordain', 'CS11-C13', '8761234509'),
('Ganter', 'Sietto', 'Farin', 'CS161-U3', '8765435809'),
('Middleson', 'Mourrie', 'Liter', 'CS161-U3', '8765435809'),
('Frederick', 'Pills', 'Viuta', 'CS1-A18', '8901234567'),
('Eliezer', 'Santos', 'Albacea', 'CS124-FC1', '8903525467'),
('Wintelpal', 'Dowhi', 'Shears', 'CS1-A19', '9012345678'),
('Tony', 'Lee', 'Logsdon', 'CS124-I1', '9035254678'),
('Robert', 'Nielsen', 'Johnson', 'CS22-E1', '9087435801'),
('Aldens', 'Kreens', 'Gardner', 'CS127-K1', '9143580200'),
('Tony', 'Kieer', 'Webster', 'CS1-A3', '9246801357'),
('Matt', 'Adams', 'Peter', 'J-10', '9271294860'),
('Ador', 'Meona', 'Ti', 'J-15', '9486092712'),
('Anne Marie', 'Diggy', 'Kelly', 'M-2', '95074362'),
('Phoenix', 'Mantilla', 'Morta', 'M-19', '95736576'),
('Anne', 'Diggy', 'Kelly', 'M-8', '96755523'),
('Jowell', 'Thoms', 'Smith', 'CS11-C3', '9753113579'),
('Christopher', 'Judd', 'Borland', 'CS11-C12', '9876123450'),
('Jovellin', 'Boyce', 'Ramsey', 'CS150-T2', '9876543580'),
('Christopher', 'Judd', 'Borland', 'CS11-C29', '9975311357');

-- --------------------------------------------------------

--
-- Table structure for table `borrowedmaterial`
--

CREATE TABLE IF NOT EXISTS `borrowedmaterial` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `status` varchar(10) NOT NULL DEFAULT 'BORROWED',
  `idnumber` varchar(11) NOT NULL,
  `materialid` varchar(15) NOT NULL,
  `isbn` varchar(10) NOT NULL,
  `start` date NOT NULL,
  `expectedreturn` date NOT NULL,
  `actualreturn` date DEFAULT NULL,
  `fine` int(6) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `materialid` (`materialid`),
  KEY `isbn` (`isbn`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=69 ;

--
-- Dumping data for table `borrowedmaterial`
--

INSERT INTO `borrowedmaterial` (`id`, `status`, `idnumber`, `materialid`, `isbn`, `start`, `expectedreturn`, `actualreturn`, `fine`) VALUES
(56, 'BORROWED', '570864213', 'CS11-C15', '6123450987', '2014-03-01', '2014-03-04', NULL, 0),
(57, 'RETURNED', '2011-01021', 'CS123-H3', '6789035254', '2014-03-02', '2014-03-05', '2014-03-09', 20),
(58, 'RETURNED', '2011-42020', 'CS11-C8', '3525467890', '2014-03-03', '2014-03-06', '2014-03-07', 5),
(59, 'RETURNED', '2011-42020', 'CS127-K1', '9143580200', '2014-03-03', '2014-03-06', '2014-03-06', 0),
(60, 'RETURNED', '2011-42020', 'CS1-A20', '3579246801', '2014-03-03', '2014-03-06', '2014-03-05', -5),
(61, 'RETURNED', '864213570', 'CS128-L6', '5514358022', '2014-03-03', '2014-03-06', '2014-03-06', 0),
(62, 'RETURNED', '2011-42020', 'CS150-T2', '9876543580', '2014-03-05', '2014-03-08', '2014-03-07', -25),
(63, 'RETURNED', '2011-42020', 'CS11-C10', '5098761234', '2014-03-06', '2014-03-11', '2014-03-07', -20),
(64, 'RETURNED', '2011-42020', 'CS142-S2', '8098765435', '2014-03-06', '2014-03-11', '2014-03-07', -20),
(65, 'RETURNED', '2011-42020', 'CS150-T2', '9876543580', '2014-03-07', '2014-03-12', '2014-03-07', -25),
(66, 'RETURNED', '135792468', 'CS124-FC1', '8903525467', '2014-03-07', '2014-03-12', '2014-03-07', -25),
(67, 'RETURNED', '2010-54665', 'CS1-A10', '1234567890', '2014-03-07', '2014-03-12', '2014-03-09', -15),
(68, 'RETURNED', '2010-54665', 'CS22-E1', '9087435801', '2014-03-07', '2014-03-12', '2014-03-09', -15);

--
-- Triggers `borrowedmaterial`
--
DROP TRIGGER IF EXISTS `borrowedmaterial_t`;
DELIMITER //
CREATE TRIGGER `borrowedmaterial_t` AFTER INSERT ON `borrowedmaterial`
 FOR EACH ROW INSERT INTO log(action, time, idnumber, isbn, materialid)
VALUES ('claimed', NOW(), NEW.idnumber, NEW.isbn, NEW.materialid)
//
DELIMITER ;
DROP TRIGGER IF EXISTS `borrowedmaterial_t1`;
DELIMITER //
CREATE TRIGGER `borrowedmaterial_t1` AFTER UPDATE ON `borrowedmaterial`
 FOR EACH ROW INSERT INTO log(action, time, idnumber, isbn, materialid)
VALUES ('returned', NOW(), NEW.idnumber, NEW.isbn, NEW.materialid)
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `borrower`
--

CREATE TABLE IF NOT EXISTS `borrower` (
  `status` varchar(12) NOT NULL DEFAULT 'DEACTIVATED',
  `idnumber` varchar(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `bookcount` int(10) NOT NULL DEFAULT '0',
  `lastsession` datetime NOT NULL,
  PRIMARY KEY (`idnumber`),
  UNIQUE KEY `email` (`email`),
  KEY `idnumber` (`idnumber`),
  KEY `idnumber_2` (`idnumber`),
  KEY `idnumber_3` (`idnumber`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `borrower`
--

INSERT INTO `borrower` (`status`, `idnumber`, `email`, `password`, `bookcount`, `lastsession`) VALUES
('ACTIVATED', '012345678', 'galagjl13@gmail.com', '3d3ca278b7db82868ffd772f05e5f82b636c6828', 0, '0000-00-00 00:00:00'),
('ACTIVATED', '013579222', 'jplaras@gmail.com', '3d3ca278b7db82868ffd772f05e5f82b636c6828', 0, '0000-00-00 00:00:00'),
('ACTIVATED', '027845122', 'mmanalo@gmail.com', '3d3ca278b7db82868ffd772f05e5f82b636c6828', 0, '0000-00-00 00:00:00'),
('ACTIVATED', '086421357', 'jayana@gmail.com', '3d3ca278b7db82868ffd772f05e5f82b636c6828', 0, '0000-00-00 00:00:00'),
('ACTIVATED', '098712345', 'cmantilla@gmail.com', '3d3ca278b7db82868ffd772f05e5f82b636c6828', 0, '0000-00-00 00:00:00'),
('ACTIVATED', '123456780', 'jencinas@gmail.com', '3d3ca278b7db82868ffd772f05e5f82b636c6828', 0, '0000-00-00 00:00:00'),
('ACTIVATED', '123456789', 'gvergara@gmail.com', '3d3ca278b7db82868ffd772f05e5f82b636c6828', 0, '0000-00-00 00:00:00'),
('ACTIVATED', '135708642', 'kepbautista@gmail.com', '3d3ca278b7db82868ffd772f05e5f82b636c6828', 0, '0000-00-00 00:00:00'),
('ACTIVATED', '135792220', 'cperalta@gmail.com', '3d3ca278b7db82868ffd772f05e5f82b636c6828', 0, '0000-00-00 00:00:00'),
('ACTIVATED', '135792468', 'jalcala@gmail.com', '3d3ca278b7db82868ffd772f05e5f82b636c6828', 0, '0000-00-00 00:00:00'),
('ACTIVATED', '2007-00991', 'jmayen@gmail.com', '3d3ca278b7db82868ffd772f05e5f82b636c6828', 0, '0000-00-00 00:00:00'),
('ACTIVATED', '2007-09910', 'etolorio@gmail.com', '3d3ca278b7db82868ffd772f05e5f82b636c6828', 0, '0000-00-00 00:00:00'),
('ACTIVATED', '2007-10099', 'mgarcia@gmail.com', '3d3ca278b7db82868ffd772f05e5f82b636c6828', 0, '0000-00-00 00:00:00'),
('ACTIVATED', '2008-00725', 'juliusiglesia@gmail.com', '3d3ca278b7db82868ffd772f05e5f82b636c6828', 0, '0000-00-00 00:00:00'),
('ACTIVATED', '2008-09822', 'jyllagan@gmail.com', '3d3ca278b7db82868ffd772f05e5f82b636c6828', 0, '0000-00-00 00:00:00'),
('ACTIVATED', '2009-00352', 'esa@gmail.com', '3d3ca278b7db82868ffd772f05e5f82b636c6828', 0, '0000-00-00 00:00:00'),
('ACTIVATED', '2009-00751', 'cmarquez@gmail.com', '3d3ca278b7db82868ffd772f05e5f82b636c6828', 0, '0000-00-00 00:00:00'),
('ACTIVATED', '2009-20035', 'csa@gmail.com', '3d3ca278b7db82868ffd772f05e5f82b636c6828', 0, '0000-00-00 00:00:00'),
('ACTIVATED', '2009-28515', 'etenorio@gmail.com', '3d3ca278b7db82868ffd772f05e5f82b636c6828', 0, '0000-00-00 00:00:00'),
('ACTIVATED', '2009-46655', 'jillgan@gmail.com', '3d3ca278b7db82868ffd772f05e5f82b636c6828', 0, '0000-00-00 00:00:00'),
('DEACTIVATED', '2009-52003', 'freljord15@gmail.com', '3d3ca278b7db82868ffd772f05e5f82b636c6828', 0, '0000-00-00 00:00:00'),
('ACTIVATED', '2009-98879', 'lnecor@gmail.com', '3d3ca278b7db82868ffd772f05e5f82b636c6828', 0, '0000-00-00 00:00:00'),
('ACTIVATED', '2009-99100', 'lidea@gmail.com', '3d3ca278b7db82868ffd772f05e5f82b636c6828', 0, '0000-00-00 00:00:00'),
('ACTIVATED', '2010-22098', 'stenorio@gmail.com', '3d3ca278b7db82868ffd772f05e5f82b636c6828', 0, '0000-00-00 00:00:00'),
('ACTIVATED', '2010-54665', 'zyferrer@gmail.com', '3d3ca278b7db82868ffd772f05e5f82b636c6828', 0, '0000-00-00 00:00:00'),
('ACTIVATED', '2010-65546', 'jnortega@gmail.com', '3d3ca278b7db82868ffd772f05e5f82b636c6828', 0, '0000-00-00 00:00:00'),
('ACTIVATED', '2010-67123', 'gcalayo@gmail.com', '3d3ca278b7db82868ffd772f05e5f82b636c6828', 0, '0000-00-00 00:00:00'),
('ACTIVATED', '2010-87728', 'jshinto@gmail.com', '3d3ca278b7db82868ffd772f05e5f82b636c6828', 0, '0000-00-00 00:00:00'),
('ACTIVATED', '2010-88772', 'jsaturno@gmail.com', '3d3ca278b7db82868ffd772f05e5f82b636c6828', 0, '0000-00-00 00:00:00'),
('ACTIVATED', '2011-00456', 'ncat@gmail.com', '3d3ca278b7db82868ffd772f05e5f82b636c6828', 0, '0000-00-00 00:00:00'),
('ACTIVATED', '2011-00789', 'jgalag@gmail.com', '3d3ca278b7db82868ffd772f05e5f82b636c6828', 0, '0000-00-00 00:00:00'),
('ACTIVATED', '2011-01021', 'jldgalag@gmail.com', '3d3ca278b7db82868ffd772f05e5f82b636c6828', 0, '0000-00-00 00:00:00'),
('ACTIVATED', '2011-02468', 'ccruz@gmail.com', '3d3ca278b7db82868ffd772f05e5f82b636c6828', 0, '0000-00-00 00:00:00'),
('ACTIVATED', '2011-04560', 'csumo@gmail.com', '3d3ca278b7db82868ffd772f05e5f82b636c6828', 0, '0000-00-00 00:00:00'),
('DEACTIVATED', '2011-04653', 'Cruz99@gmail.com', '3d3ca278b7db82868ffd772f05e5f82b636c6828', 0, '0000-00-00 00:00:00'),
('ACTIVATED', '2011-07890', 'emendoza@gmail.com', '3d3ca278b7db82868ffd772f05e5f82b636c6828', 0, '0000-00-00 00:00:00'),
('ACTIVATED', '2011-09229', 'icastaneda14@gmail.com', '3d3ca278b7db82868ffd772f05e5f82b636c6828', 0, '0000-00-00 00:00:00'),
('ACTIVATED', '2011-11111', 'hpadron@gmail.com', '3d3ca278b7db82868ffd772f05e5f82b636c6828', 0, '0000-00-00 00:00:00'),
('ACTIVATED', '2011-12345', 'jescoliar@gmail.com', '3d3ca278b7db82868ffd772f05e5f82b636c6828', 0, '0000-00-00 00:00:00'),
('ACTIVATED', '2011-13579', 'aleal@gmail.com', '3d3ca278b7db82868ffd772f05e5f82b636c6828', 0, '0000-00-00 00:00:00'),
('ACTIVATED', '2011-23451', 'yanyantarong@gmail.com', '3d3ca278b7db82868ffd772f05e5f82b636c6828', 0, '0000-00-00 00:00:00'),
('ACTIVATED', '2011-23456', 'cmanuel@gmail.com', '3d3ca278b7db82868ffd772f05e5f82b636c6828', 0, '0000-00-00 00:00:00'),
('ACTIVATED', '2011-24680', 'ffernandez@gmail.com', '3d3ca278b7db82868ffd772f05e5f82b636c6828', 0, '0000-00-00 00:00:00'),
('ACTIVATED', '2011-38722', 'lburata@gmail.com', '3d3ca278b7db82868ffd772f05e5f82b636c6828', 0, '0000-00-00 00:00:00'),
('ACTIVATED', '2011-42020', 'fernerick27@gmail.com', '3d3ca278b7db82868ffd772f05e5f82b636c6828', 0, '0000-00-00 00:00:00'),
('ACTIVATED', '2011-43580', 'ccanedo@gmail.com', '3d3ca278b7db82868ffd772f05e5f82b636c6828', 0, '0000-00-00 00:00:00'),
('ACTIVATED', '2011-45123', 'gramirez@gmail.com', '3d3ca278b7db82868ffd772f05e5f82b636c6828', 0, '0000-00-00 00:00:00'),
('ACTIVATED', '2011-45600', 'eallido@gmail.com', '3d3ca278b7db82868ffd772f05e5f82b636c6828', 0, '0000-00-00 00:00:00'),
('ACTIVATED', '2011-46496', 'aramirez@gmail.com', '3d3ca278b7db82868ffd772f05e5f82b636c6828', 0, '0000-00-00 00:00:00'),
('ACTIVATED', '2011-46802', 'epurificacion@gmail.com', '3d3ca278b7db82868ffd772f05e5f82b636c6828', 0, '0000-00-00 00:00:00'),
('ACTIVATED', '2011-48644', 'ncruzada@gmail.com', '3d3ca278b7db82868ffd772f05e5f82b636c6828', 0, '0000-00-00 00:00:00'),
('ACTIVATED', '2011-54422', 'jborromeo@gmail.com', '3d3ca278b7db82868ffd772f05e5f82b636c6828', 0, '0000-00-00 00:00:00'),
('ACTIVATED', '2011-90078', 'gcontreras@gmail.com', '3d3ca278b7db82868ffd772f05e5f82b636c6828', 0, '0000-00-00 00:00:00'),
('ACTIVATED', '2011-90678', 'kespalmado@gmail.com', '3d3ca278b7db82868ffd772f05e5f82b636c6828', 0, '0000-00-00 00:00:00'),
('ACTIVATED', '2011-99999', 'jcruz@gmail.com', '3d3ca278b7db82868ffd772f05e5f82b636c6828', 0, '0000-00-00 00:00:00'),
('ACTIVATED', '2012-51007', 'jlopez@gmail.com', '3d3ca278b7db82868ffd772f05e5f82b636c6828', 0, '0000-00-00 00:00:00'),
('ACTIVATED', '2012-55466', 'ihamor@gmail.com', '3d3ca278b7db82868ffd772f05e5f82b636c6828', 0, '0000-00-00 00:00:00'),
('ACTIVATED', '2012-98220', 'amagnes@gmail.com', '3d3ca278b7db82868ffd772f05e5f82b636c6828', 0, '0000-00-00 00:00:00'),
('ACTIVATED', '201357922', 'aramonte@gmail.com', '3d3ca278b7db82868ffd772f05e5f82b636c6828', 0, '0000-00-00 00:00:00'),
('ACTIVATED', '213570864', 'mfagan@gmail.com', '3d3ca278b7db82868ffd772f05e5f82b636c6828', 0, '0000-00-00 00:00:00'),
('ACTIVATED', '234567801', 'mmalmanalang@gmail.com', '3d3ca278b7db82868ffd772f05e5f82b636c6828', 0, '0000-00-00 00:00:00'),
('ACTIVATED', '234567891', 'cgalano@gmail.com', '3d3ca278b7db82868ffd772f05e5f82b636c6828', 0, '0000-00-00 00:00:00'),
('ACTIVATED', '345678012', 'ldanila@gmail.com', '3d3ca278b7db82868ffd772f05e5f82b636c6828', 0, '0000-00-00 00:00:00'),
('ACTIVATED', '345678912', 'sborja@gmail.com', '3d3ca278b7db82868ffd772f05e5f82b636c6828', 0, '0000-00-00 00:00:00'),
('ACTIVATED', '357086421', 'iaguila@gmail.com', '3d3ca278b7db82868ffd772f05e5f82b636c6828', 0, '0000-00-00 00:00:00'),
('ACTIVATED', '357922201', 'rbulalacao@gmail.com', '3d3ca278b7db82868ffd772f05e5f82b636c6828', 0, '0000-00-00 00:00:00'),
('ACTIVATED', '357924681', 'mcortes@gmail.com', '3d3ca278b7db82868ffd772f05e5f82b636c6828', 0, '0000-00-00 00:00:00'),
('ACTIVATED', '369121518', 'abaria@gmail.com', '3d3ca278b7db82868ffd772f05e5f82b636c6828', 0, '0000-00-00 00:00:00'),
('ACTIVATED', '421357086', 'egrande@gmail.com', '3d3ca278b7db82868ffd772f05e5f82b636c6828', 0, '0000-00-00 00:00:00'),
('ACTIVATED', '445566779', 'bbatallier@gmail.com', '3d3ca278b7db82868ffd772f05e5f82b636c6828', 0, '0000-00-00 00:00:00'),
('ACTIVATED', '455667794', 'bhernandez@gmail.com', '3d3ca278b7db82868ffd772f05e5f82b636c6828', 0, '0000-00-00 00:00:00'),
('ACTIVATED', '456780123', 'jsamaniego@gmail.com', '3d3ca278b7db82868ffd772f05e5f82b636c6828', 0, '0000-00-00 00:00:00'),
('ACTIVATED', '456789123', 'acastro@gmail.com', '3d3ca278b7db82868ffd772f05e5f82b636c6828', 0, '0000-00-00 00:00:00'),
('ACTIVATED', '468135792', 'mclarino@gmail.com', '3d3ca278b7db82868ffd772f05e5f82b636c6828', 0, '0000-00-00 00:00:00'),
('ACTIVATED', '556677944', 'acueno@gmail.com', '3d3ca278b7db82868ffd772f05e5f82b636c6828', 0, '0000-00-00 00:00:00'),
('ACTIVATED', '566779445', 'jgupa@gmail.com', '3d3ca278b7db82868ffd772f05e5f82b636c6828', 0, '0000-00-00 00:00:00'),
('ACTIVATED', '567891234', 'robrero@gmail.com', '3d3ca278b7db82868ffd772f05e5f82b636c6828', 0, '0000-00-00 00:00:00'),
('ACTIVATED', '570864213', 'myee@gmail.com', '3d3ca278b7db82868ffd772f05e5f82b636c6828', 0, '0000-00-00 00:00:00'),
('ACTIVATED', '572468013', 'lyamboto@gmail.com', '3d3ca278b7db82868ffd772f05e5f82b636c6828', 0, '0000-00-00 00:00:00'),
('ACTIVATED', '579222013', 'mlaranang@gmail.com', '3d3ca278b7db82868ffd772f05e5f82b636c6828', 0, '0000-00-00 00:00:00'),
('ACTIVATED', '642135708', 'smarasigan@gmail.com', '3d3ca278b7db82868ffd772f05e5f82b636c6828', 0, '0000-00-00 00:00:00'),
('ACTIVATED', '667794455', 'naranas@gmail.com', '3d3ca278b7db82868ffd772f05e5f82b636c6828', 0, '0000-00-00 00:00:00'),
('ACTIVATED', '677944556', 'jcaponitan@gmail.com', '3d3ca278b7db82868ffd772f05e5f82b636c6828', 0, '0000-00-00 00:00:00'),
('ACTIVATED', '678912345', 'rrecario@gmail.com', '3d3ca278b7db82868ffd772f05e5f82b636c6828', 0, '0000-00-00 00:00:00'),
('ACTIVATED', '681357924', 'fmarasigan@gmail.com', '3d3ca278b7db82868ffd772f05e5f82b636c6828', 0, '0000-00-00 00:00:00'),
('ACTIVATED', '691215183', 'nenriquez@gmail.com', '3d3ca278b7db82868ffd772f05e5f82b636c6828', 0, '0000-00-00 00:00:00'),
('ACTIVATED', '708642135', 'jcorner@gmail.com', '3d3ca278b7db82868ffd772f05e5f82b636c6828', 0, '0000-00-00 00:00:00'),
('ACTIVATED', '779445566', 'jalcantara@gmail.com', '3d3ca278b7db82868ffd772f05e5f82b636c6828', 0, '0000-00-00 00:00:00'),
('ACTIVATED', '789123456', 'mderobles@gmail.com', '3d3ca278b7db82868ffd772f05e5f82b636c6828', 0, '0000-00-00 00:00:00'),
('ACTIVATED', '792220135', 'jvillanueva@gmail.com', '3d3ca278b7db82868ffd772f05e5f82b636c6828', 0, '0000-00-00 00:00:00'),
('ACTIVATED', '792468015', 'klactuan@gmail.com', '3d3ca278b7db82868ffd772f05e5f82b636c6828', 0, '0000-00-00 00:00:00'),
('ACTIVATED', '794455667', 'mborines@gmail.com', '3d3ca278b7db82868ffd772f05e5f82b636c6828', 0, '0000-00-00 00:00:00'),
('ACTIVATED', '813579246', 'mtandoc@gmail.com', '3d3ca278b7db82868ffd772f05e5f82b636c6828', 0, '0000-00-00 00:00:00'),
('ACTIVATED', '864213570', 'jrobles@gmail.com', '3d3ca278b7db82868ffd772f05e5f82b636c6828', 0, '0000-00-00 00:00:00'),
('ACTIVATED', '891234567', 'yderobles@gmail.com', '3d3ca278b7db82868ffd772f05e5f82b636c6828', 0, '0000-00-00 00:00:00'),
('ACTIVATED', '912151836', 'wremollo@gmail.com', '3d3ca278b7db82868ffd772f05e5f82b636c6828', 0, '0000-00-00 00:00:00'),
('ACTIVATED', '912345678', 'kmagno@gmail.com', '3d3ca278b7db82868ffd772f05e5f82b636c6828', 0, '0000-00-00 00:00:00'),
('ACTIVATED', '922201357', 'vcomayas@gmail.com', '3d3ca278b7db82868ffd772f05e5f82b636c6828', 0, '0000-00-00 00:00:00'),
('ACTIVATED', '924611357', 'ksamaniego@gmail.com', '3d3ca278b7db82868ffd772f05e5f82b636c6828', 0, '0000-00-00 00:00:00'),
('ACTIVATED', '944556677', 'sdemigilio@gmail.com', '3d3ca278b7db82868ffd772f05e5f82b636c6828', 0, '0000-00-00 00:00:00');

--
-- Triggers `borrower`
--
DROP TRIGGER IF EXISTS `borrower_t`;
DELIMITER //
CREATE TRIGGER `borrower_t` AFTER INSERT ON `borrower`
 FOR EACH ROW INSERT INTO log(action, time, idnumber)
VALUES('created an account', NOW(), NEW.idnumber)
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `librarymaterial`
--

CREATE TABLE IF NOT EXISTS `librarymaterial` (
  `materialid` varchar(15) NOT NULL,
  `isbn` varchar(10) NOT NULL,
  `name` varchar(100) NOT NULL,
  `course` varchar(7) DEFAULT NULL,
  `available` int(1) NOT NULL DEFAULT '1',
  `access` int(1) NOT NULL DEFAULT '4',
  `type` varchar(10) NOT NULL,
  `year` int(4) NOT NULL,
  `edvol` int(2) DEFAULT NULL,
  `borrowedcount` int(10) NOT NULL DEFAULT '0',
  `requirement` int(1) NOT NULL DEFAULT '0',
  `rating` float NOT NULL DEFAULT '0',
  `quantity` int(2) NOT NULL DEFAULT '1',
  `borrowedcopy` int(2) NOT NULL DEFAULT '0',
  PRIMARY KEY (`materialid`,`isbn`),
  UNIQUE KEY `isbn` (`isbn`),
  UNIQUE KEY `materialid` (`materialid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `librarymaterial`
--

INSERT INTO `librarymaterial` (`materialid`, `isbn`, `name`, `course`, `available`, `access`, `type`, `year`, `edvol`, `borrowedcount`, `requirement`, `rating`, `quantity`, `borrowedcopy`) VALUES
('CD-1', '+CD-1', 'NEW Barron''s Ap Computer Science A', 'CS1', 1, 4, 'CD', 2014, NULL, 0, 0, 0, 1, 0),
('CD-2', '+CD-2', 'Multimedia Computing', 'CS161', 1, 4, 'CD', 2004, NULL, 0, 0, 0, 1, 0),
('CD-3', '+CD-3', 'Analysis of Boolean Functions', 'CS57', 1, 4, 'CD', 2001, NULL, 0, 0, 0, 1, 0),
('CD-4', '+CD-4', 'Understanding Machine Learning', 'CS170', 1, 4, 'CD', 2003, NULL, 0, 0, 0, 1, 0),
('CD-5', '+CD-5', 'Data Mining and Analysis', 'CS123', 1, 4, 'CD', 2007, NULL, 0, 0, 0, 1, 0),
('CS1-A1', '0123456789', 'Microcomputer Keyboarding and Document Processing', 'CS1', 1, 4, 'Book', 2000, NULL, 0, 0, 0, 2, 0),
('CS1-A10', '1234567890', 'DOS The Complete Reference (4th Ed)', 'CS1', 1, 4, 'Book', 2009, 4, 1, 0, 0, 1, 0),
('CS1-A11', '2345678901', 'Microcomputers and Microprocessors', 'CS1', 1, 4, 'Book', 2010, 4, 0, 0, 0, 1, 0),
('CS1-A12', '3456789012', 'Microcomputer Systems: The 8086/8088 family (5th Ed)', 'CS1', 1, 4, 'Book', 1999, 5, 0, 0, 0, 1, 0),
('CS1-A13', '4567890123', 'Pagemaker 4 by Example (6th Ed)', 'CS1', 1, 4, 'Book', 1998, 6, 0, 0, 0, 1, 0),
('CS1-A15', '5678901234', 'Latex for Everyone (7th Ed)', 'CS1', 1, 4, 'Book', 1997, 7, 1, 0, 0, 1, 0),
('CS1-A16', '6789012345', 'IBM PC Advanced Troubleshooting (8th Ed)', 'CS1', 1, 4, 'Book', 1997, 8, 0, 0, 0, 1, 0),
('CS1-A17', '7890123456', 'Lotus 123 (Practical Applications)', 'CS1', 1, 4, 'Book', 1996, NULL, 0, 0, 0, 1, 0),
('CS1-A18', '8901234567', 'Microsoft MSDOS vers 4', 'CS1', 1, 4, 'Book', 1995, 4, 0, 0, 0, 1, 0),
('CS1-A19', '9012345678', 'Using Windows 3.0/3.1', 'CS1', 1, 4, 'Book', 1994, 3, 0, 0, 0, 1, 0),
('CS1-A2', '1357924680', 'The Latext Companion', 'CS1', 1, 4, 'Book', 2001, 2, 0, 0, 0, 1, 0),
('CS1-A20', '3579246801', 'Word for Windows ( quick reference)', 'CS1', 1, 4, 'Book', 1993, NULL, 1, 0, 0, 1, 0),
('CS1-A21', '5792468013', 'Microsoft Windows and MS-DOS (4th Ed)', 'CS1', 1, 4, 'Book', 1992, 4, 0, 0, 0, 1, 0),
('CS1-A22', '6924680135', 'An Introduction to Computer Science w/ Modula-2', 'CS1', 1, 4, 'Book', 1991, NULL, 0, 0, 0, 1, 0),
('CS1-A3', '9246801357', 'Pagemaker 4 for the PC', 'CS1', 1, 4, 'Book', 2002, 3, 0, 0, 0, 1, 0),
('CS1-A4', '2468013579', 'Macintosh Revealed vol 1', 'CS1', 1, 4, 'Book', 2003, NULL, 0, 0, 0, 1, 0),
('CS1-A5', '4680135792', 'Inside the Norton Utilities 6.0 (3rd Ed)', 'CS1', 1, 4, 'Book', 2004, 3, 1, 0, 0, 1, 0),
('CS1-A6', '6801357924', 'Wordperfect 5.1 Tips, Tricks and Traps (3rd Ed)', 'CS1', 1, 4, 'Book', 2005, 3, 1, 0, 0, 1, 0),
('CS1-A7', '8013579246', 'IBM Using Disk Operating System Version 4', 'CS1', 1, 4, 'Book', 2006, 4, 0, 0, 0, 1, 0),
('CS1-A8', '0135792468', 'Mastering Harvard Graphics', 'CS1', 1, 4, 'Book', 2007, NULL, 0, 0, 0, 1, 0),
('CS1-A9', '1234509876', 'Fix Your Own PC', 'CS1', 1, 4, 'Book', 2008, 2, 0, 0, 0, 1, 0),
('CS100-G1', '2345098761', 'HTML, JAVA , CGI, VRMI, SGNL Unleashed', 'CS100', 1, 4, 'Book', 2003, NULL, 1, 0, 0, 1, 0),
('CS100-G2', '3450987612', 'XML - A Primer 2nd Ed', 'CS100', 1, 4, 'Book', 2004, 2, 0, 0, 0, 1, 0),
('CS11-C1', '4509876123', 'Introduction to Computer Applications Using Jones, R M Basic (2nd ed)', 'CS11', 1, 4, 'Book', 1994, 2, 0, 0, 0, 1, 0),
('CS11-C10', '5098761234', 'Basic Programming (3rd Ed)', 'CS11', 1, 4, 'Book', 2003, 3, 1, 0, 0, 1, 0),
('CS11-C11', '0987612345', 'Hands-on Turbo Pascal (4th Ed)', 'CS11', 1, 4, 'Book', 2005, 4, 0, 0, 0, 1, 0),
('CS11-C12', '9876123450', 'Turbo Pascal 4.0 (4th Ed)', 'CS11', 1, 4, 'Book', 2006, 4, 0, 0, 0, 1, 0),
('CS11-C13', '8761234509', 'Programmer’s Problem Solver (5th ed)', 'CS11', 1, 4, 'Book', 2007, 5, 0, 0, 0, 1, 0),
('CS11-C14', '7612345098', 'Programmer’s Problem Solver (6th Ed)', 'CS11', 1, 4, 'Book', 2007, 6, 0, 0, 0, 1, 0),
('CS11-C15', '6123450987', 'Turbo Pascal 5.5(user’s and reference guide)', 'CS11', 1, 4, 'Book', 2008, NULL, 1, 0, 0, 1, 0),
('CS11-C16', '1213141516', 'Turbo Pascal 6.0', 'CS11', 1, 4, 'Book', 2009, NULL, 0, 0, 0, 1, 0),
('CS11-C17', '2131415161', 'Turbo Debugger', 'CS11', 1, 4, 'Book', 2010, NULL, 1, 0, 0, 1, 0),
('CS11-C18', '1314151612', 'Turbo Pascal Edition', 'CS11', 1, 4, 'Book', 2011, NULL, 0, 0, 0, 1, 0),
('CS11-C19', '3141516121', 'Turbo Pascal Version 3.0', 'CS11', 1, 4, 'Book', 1995, NULL, 0, 0, 0, 1, 0),
('CS11-C2', '1415161213', 'Structures and Abstractions (5th Ed)', 'CS11', 1, 4, 'Book', 1995, 5, 0, 0, 0, 1, 0),
('CS11-C20', '4151612131', 'Turbo Pascal 5.5(reference guide)', 'CS11', 1, 4, 'Book', 2012, NULL, 0, 0, 0, 1, 0),
('CS11-C21', '1516121314', 'Turbo Pascal 5.5(user’s guide)', 'CS11', 1, 4, 'Book', 2012, NULL, 0, 0, 0, 1, 0),
('CS11-C22', '5161213141', 'Turbo Graphix Toolbox (2nd Ed)', 'CS11', 1, 4, 'Book', 2013, 2, 0, 0, 0, 1, 0),
('CS11-C23', '1612131415', 'Turbo Pascal 5.5(obj oriented prog guide)', 'CS11', 1, 4, 'Book', 2012, NULL, 0, 0, 0, 1, 0),
('CS11-C24', '6121314151', 'Computer Programming in Basic', 'CS11', 1, 4, 'Book', 2012, NULL, 0, 0, 0, 1, 0),
('CS11-C25', '1357997531', 'Turbo Pascal The Ultimate Pascal Dev’t Envrnt', 'CS11', 1, 4, 'Book', 2011, NULL, 0, 0, 0, 1, 0),
('CS11-C26', '3579975311', 'Basic Handbook (3rd ed)', 'CS11', 1, 4, 'Book', 2010, 3, 0, 0, 0, 1, 0),
('CS11-C27', '5799753113', 'Turbo Pascal 5.5(object oriented programming)', 'CS11', 1, 4, 'Book', 2011, NULL, 0, 0, 0, 1, 0),
('CS11-C28', '7997531135', 'Understanding Computer Science (9th Ed)', 'CS11', 1, 4, 'Book', 2009, 9, 1, 0, 0, 1, 0),
('CS11-C29', '9975311357', 'Turbo Pascal 5.5', 'CS11', 1, 4, 'Book', 2010, NULL, 0, 0, 0, 1, 0),
('CS11-C3', '9753113579', 'Getting the Most from Turbo Pascal (6th Ed)', 'CS11', 1, 4, 'Book', 1996, 6, 1, 0, 0, 1, 0),
('CS11-C30', '7531135799', 'Computer Assisted Learning (8th Ed)', 'CS11', 1, 4, 'Book', 2008, 8, 1, 0, 0, 1, 0),
('CS11-C31', '5311357997', 'Computer Science A Modern Introduction 2nd ed.', 'CS11', 1, 4, 'Book', 2007, 2, 0, 0, 0, 1, 0),
('CS11-C33', '3113579975', 'Understanding Computer Science vol.II', 'CS11', 1, 4, 'Book', 2006, 2, 0, 0, 0, 1, 0),
('CS11-C34', '1135799753', 'Pascal User and Report vol. VII', 'CS11', 1, 4, 'Book', 2005, 7, 0, 0, 0, 1, 0),
('CS11-C35', '2468008642', 'Algorithms + Data Structures = Programs', 'CS11', 1, 4, 'Book', 2004, NULL, 1, 0, 0, 1, 0),
('CS11-C36', '4680086422', 'Introduction to Computer Based Information Systems  (4th ed)', 'CS11', 1, 4, 'Book', 2003, 4, 0, 0, 0, 1, 0),
('CS11-C37', '6800864224', 'Turbo Pascal 5.5', 'CS11', 1, 4, 'Book', 1, 2010, 0, 0, 0, 1, 0),
('CS11-C38', '8008642246', 'An Introduction to Programming and Problem Solving with Pascal (2nd ed)', 'CS11', 1, 4, 'Book', 2002, 2, 1, 0, 0, 1, 0),
('CS11-C39', '0086422468', 'Introduction to Computer Science (10th ed)', 'CS11', 1, 4, 'Book', 2001, 10, 0, 0, 0, 1, 0),
('CS11-C4', '0864224680', 'Pascal (2nd ed)', 'CS11', 1, 4, 'Book', 1997, 2, 0, 0, 0, 1, 0),
('CS11-C40', '8642246800', 'Introduction to Computer Science (8th Ed)', 'CS11', 1, 4, 'Book', 1997, 8, 0, 0, 0, 1, 0),
('CS11-C5', '6422468008', 'Computer Science (7th Ed)', 'CS11', 1, 4, 'Book', 1998, 7, 1, 0, 0, 1, 0),
('CS11-C6', '4224680086', 'Pascal (9th Ed)', 'CS11', 1, 4, 'Book', 1999, 9, 0, 0, 0, 1, 0),
('CS11-C7', '2246800864', 'Learning Basic for the Macintosh (10th Ed)', 'CS11', 1, 4, 'Book', 2000, 10, 0, 0, 0, 1, 0),
('CS11-C8', '3525467890', 'The Science of Programming', 'CS11', 1, 4, 'Book', 2001, NULL, 1, 0, 0, 1, 0),
('CS11-C9', '5254678903', 'Computer Science Achievements and Opportunities (2nd Ed)', 'CS11', 1, 4, 'Book', 2002, 2, 0, 0, 0, 1, 0),
('CS123-FC1', '2546789035', 'Introduction to Data Structures and Algrorithm (2nd Ed)', 'CS123', 1, 2, 'Book', 2002, 2, 0, 0, 0, 1, 0),
('CS123-H1', '5467890352', 'Data Structure from Arrays to Priority Queues', 'CS123', 1, 4, 'Book', 2005, NULL, 0, 0, 0, 1, 0),
('CS123-H2', '4678903525', 'Programming with Data Structures', 'CS123', 1, 4, 'Book', 2006, NULL, 0, 0, 0, 1, 0),
('CS123-H3', '6789035254', 'Data Structures and Algorithm Analysis (9th ed)', 'CS123', 1, 4, 'Book', 2007, 9, 1, 0, 0, 1, 0),
('CS123-H4', '7890352546', 'Data Structures Using Pascal(hardbound)', 'CS123', 1, 4, 'Book', 1990, NULL, 1, 0, 0, 1, 0),
('CS123-J99', '1352900454', 'hehehehehahaha', 'CS123', 0, 4, 'Book', 2014, 1, 0, 0, 0, 1, 0),
('CS124-FC1', '8903525467', 'Concepts in Programming Languages', 'CS124', 1, 2, 'Book', 2003, NULL, 1, 0, 0, 1, 0),
('CS124-I1', '9035254678', 'Programming with basic Actions', 'CS124', 1, 4, 'Book', 1991, NULL, 0, 0, 0, 1, 0),
('CS124-I2', '0352546789', 'Having Fun Learning Basic', 'CS124', 1, 4, 'Book', 1992, NULL, 0, 0, 0, 1, 0),
('CS124-I3', '4358020091', 'Structured Cobol', 'CS124', 1, 4, 'Book', 1993, NULL, 1, 0, 0, 1, 0),
('CS124-I4', '3580200914', 'Structured Cobol Programming (10th ed)', 'CS124', 1, 4, 'Book', 1994, 10, 1, 0, 0, 1, 0),
('CS124-I5', '5802009143', 'Using Turbo Prolog (6th Ed)', 'CS124', 1, 4, 'Book', 1994, 6, 0, 0, 0, 1, 0),
('CS125-FC1', '8020091435', 'Operating Systems: Basic Concepts', 'CS125', 1, 2, 'Book', 2002, NULL, 1, 0, 0, 1, 0),
('CS125-J1', '0200914358', 'Xwindow System Programming', 'CS125', 1, 4, 'Book', 1995, NULL, 0, 0, 0, 1, 0),
('CS125-J2', '2009143580', 'SCO Linux (4th Ed)', 'CS125', 1, 4, 'Book', 1996, 4, 0, 0, 0, 1, 0),
('CS125-J3', '0091435802', 'Windows Internal', 'CS125', 1, 4, 'Book', 1997, NULL, 0, 0, 0, 1, 0),
('CS125-J4', '0914358020', 'An Introduction to Operating System (7th ed)', 'CS125', 1, 4, 'Book', 1998, 7, 0, 0, 0, 1, 0),
('CS127-K1', '9143580200', 'Clipper dbase II plus Foxbase', 'CS127', 1, 4, 'Book', 1999, NULL, 1, 0, 0, 1, 0),
('CS127-K2', '1435802009', 'Database Processing (2nd Ed)', 'CS127', 1, 4, 'Book', 2001, 2, 0, 0, 0, 1, 0),
('CS127-K3', '4358022551', 'Introduction to Data processing (2nd Ed)', 'CS127', 1, 4, 'Book', 1998, 2, 1, 0, 0, 1, 0),
('CS127-K4', '3580225514', 'Business data Processing', 'CS127', 1, 4, 'Book', 2001, NULL, 0, 0, 0, 1, 0),
('CS127-K49', '5802255143', 'An Introduction to Database Systems (7th Ed)', 'CS127', 1, 4, 'Book', 2000, 7, 1, 0, 0, 1, 0),
('CS127-K69', '8022551435', 'An Introduction to Database Systems (5th Ed)', 'CS127', 1, 4, 'Book', 1990, 5, 1, 0, 0, 1, 0),
('CS128-L1', '0225514358', 'Management Infromation Systems', 'Cs128', 1, 4, 'Book', 2001, NULL, 0, 0, 0, 1, 0),
('CS128-L2', '2255143580', 'Managing the Design - Manufacturing Process (3rd Ed)', 'CS128', 1, 4, 'Book', 1995, 3, 0, 0, 0, 1, 0),
('CS128-L4', '2551435802', 'Software Reliabilty (2nd Ed)', 'CS128', 1, 4, 'Book', 1990, 2, 0, 0, 0, 1, 0),
('CS128-L6', '5514358022', 'Computer Ethics (5th ed)', 'CS128', 1, 4, 'Book', 1997, 5, 1, 0, 0, 1, 0),
('CS129-M1', '5143580225', 'The Theory and Practice of Compiler Writing', 'CS129', 1, 4, 'Book', 1993, NULL, 0, 0, 0, 1, 0),
('CS129-M10', '1435802255', 'Compilers, Principles, Techniques and Tools', 'CS129', 1, 4, 'Book', 1996, NULL, 1, 0, 0, 1, 0),
('CS129-M2', '4358000771', 'The Theory nd Practice of Compiler Writing', 'CS129', 1, 4, 'Book', 1994, NULL, 0, 0, 0, 1, 0),
('CS130-N1', '3580007714', 'Digital Design (4th ed)', 'CS130', 1, 4, 'Book', 1997, 4, 1, 0, 0, 1, 0),
('CS130-N15', '5800077143', 'Computers and Microprocessors', 'CS130', 1, 4, 'CS130', 1995, NULL, 0, 0, 0, 1, 0),
('CS130-N2', '8000771435', 'Digital and Analog Communication System', 'CS130-N', 1, 4, 'CS130', 1998, NULL, 1, 0, 0, 1, 0),
('CS131-O1', '0007714358', 'Computer Organization and Assembly Language Programming', 'CS131', 1, 4, 'Book', 2000, NULL, 1, 0, 0, 1, 0),
('CS132-P1', '0077143580', 'Advanced Micro Processor Architectures (2nd ed)', 'CS132', 1, 4, 'Book', 1990, 2, 0, 0, 0, 1, 0),
('CS132-P2', '0771435800', 'Micro Computer Architecture and Programming', 'CS132', 1, 4, 'Book', 2001, NULL, 1, 0, 0, 1, 0),
('CS137-Q1', '7714358000', 'Computer Networks', 'CS137', 1, 4, 'Book', 1999, NULL, 0, 0, 0, 1, 0),
('CS137-Q2', '7143580007', 'Upgrading and Repairing PCs', 'CS137', 1, 4, 'Book', 1990, NULL, 0, 0, 0, 1, 0),
('CS141-R1', '1435800077', 'Elements of the Theory of Computation (4th Ed)', 'CS141', 1, 4, 'Book', 2008, 4, 0, 0, 0, 1, 0),
('CS141-R2', '4358098765', 'Introduction to Languages and the Theory Of Computation', 'CS141', 1, 4, 'Book', 2008, NULL, 0, 0, 0, 1, 0),
('CS142-FC1', '3580987654', 'Design and Analysis of Algorithms: An Introduction', 'CS142', 1, 2, 'Book', 2003, NULL, 0, 0, 0, 1, 0),
('CS142-S1', '5809876543', 'The Design of Well-Structured and Correct Programs (3rd Ed)', 'CS141', 1, 4, 'Book', 2007, 3, 0, 0, 0, 1, 0),
('CS142-S2', '8098765435', 'Computer and Interactability (2nd Ed)', 'CS142', 1, 4, 'Book', 2006, 2, 1, 0, 0, 1, 0),
('CS150-T1', '0987654358', 'Numerical Integration over Finite Regions Using Extrapolation By Noulinear Sequence Transformation', 'CS150', 1, 4, 'Book', 2005, NULL, 0, 0, 0, 1, 0),
('CS150-T2', '9876543580', 'APL-stat', 'CS150', 1, 4, 'Book', 2004, NULL, 2, 0, 0, 1, 0),
('CS161-U3', '8765435809', 'Nurbs for Curve and Suface Design', 'CS161', 1, 4, 'Book', 2002, NULL, 0, 0, 0, 1, 0),
('CS161-U8', '6543580987', 'Computer Graphics (3rd Ed)', 'CS161', 1, 4, 'Book', 2003, 3, 0, 0, 0, 1, 0),
('CS170-V1', '5435809876', 'Guide To Expert Systems', 'CS170', 1, 4, 'Book', 2001, NULL, 0, 0, 0, 1, 0),
('CS170-V2', '4358024680', 'Computational Linguistics', 'CS170', 1, 4, 'Book', 2000, NULL, 0, 0, 0, 1, 0),
('CS170-V6', '3580246804', 'Artificial Intelligence Through Prologue', 'CS170', 1, 4, 'Book', 5, NULL, 1, 0, 0, 1, 0),
('CS180-W1', '5802468043', 'Highly-Parallel Computing (2nd Ed)', 'CS180', 1, 4, 'Book', 1999, 2, 0, 0, 0, 1, 0),
('CS180-W2', '8024680435', 'Parallel Processing for Scientific Computing', 'CS180', 1, 4, 'Book', 1998, NULL, 0, 0, 0, 1, 0),
('CS191-X1', '0246804358', 'Advances in Speech Signal Processing (3rd Ed)', 'CS191', 1, 4, 'Book', 1997, 3, 1, 0, 0, 1, 0),
('CS191-X2', '2468043580', 'Fundamentals of Speech Recognition (7th ed)', 'CS191', 1, 4, 'Book', 1997, 7, 0, 0, 0, 1, 0),
('CS2-B1', '4680435802', 'Internet Companion', 'CS2', 1, 4, 'Book', 1990, NULL, 0, 0, 0, 1, 0),
('CS2-B2', '6804358024', 'World Wide Web (2nd Ed)', 'CS2', 1, 4, 'Book', 1991, 2, 0, 0, 0, 1, 0),
('CS2-B3', '8043580246', 'Discover the World Wide Web (3rd Ed)', 'CS2', 1, 4, 'Book', 1992, 3, 0, 0, 0, 1, 0),
('CS2-B4', '0435802468', 'HTML Complete (4th Ed)', 'CS2', 1, 4, 'Book', 1993, 4, 0, 0, 0, 1, 0),
('CS21-D1', '4358019087', 'Turbo C version 1.5(user’s guide)', 'CS21', 1, 4, 'Book', 1994, NULL, 0, 0, 0, 1, 0),
('CS21-D2', '3580190874', 'The Standard C Library vol. III', 'CS21', 1, 4, 'Book', 1999, 3, 0, 0, 0, 1, 0),
('CS21-D3', '5801908743', 'From Basic to C', 'CS21', 1, 4, 'Book', 1998, NULL, 0, 0, 0, 1, 0),
('CS21-D4', '8019087435', 'The C Primer', 'CS21', 1, 4, 'Book', 1997, NULL, 0, 0, 0, 1, 0),
('CS21-D5', '0190874358', 'Microsoft C Computer', 'CS21', 1, 4, 'Book', 1996, NULL, 0, 0, 0, 1, 0),
('CS21-D6', '1908743580', 'Turbo C version 2.0(user’s guide)', 'CS21', 1, 4, 'Book', 1995, NULL, 0, 0, 0, 1, 0),
('CS22-E1', '9087435801', 'Java Unleashed', 'CS22', 1, 4, 'Book', 1995, NULL, 1, 0, 0, 1, 0),
('CS22-E4', '0874358019', 'Java How to Program (Object-oriented Design w/ UML)', 'CS22', 1, 4, 'Book', 1996, NULL, 1, 0, 0, 1, 0),
('CS22-FC1', '8743580190', 'Rent and Real-Time Programming in Jaba', 'CS22', 1, 2, 'Book', 2004, NULL, 0, 0, 0, 1, 0),
('CS245-FC1', '7435801908', 'Computers and Interactability', 'CS245', 1, 2, 'Book', 1979, NULL, 0, 0, 0, 1, 0),
('CS245-FC2', '4358077556', 'Approximation for NP-Hard Problems', 'CS245', 1, 2, 'Book', 1997, NULL, 0, 0, 0, 1, 0),
('CS56-F1', '3580775564', 'Discrete Mathematics (2nd Ed)', 'CS56', 1, 4, 'Book', 1997, 2, 0, 0, 0, 1, 0),
('CS56-F5', '5807755643', 'DiscreteMathematics (7th ed)', 'CS57', 1, 4, 'Book', 2002, 7, 0, 0, 0, 1, 0),
('CS56-FC1', '8077556435', 'Discrete Mathematics Structures in Computer Science (2nd Ed)', 'CS56', 1, 2, 'Book', 2003, 2, 0, 0, 0, 1, 0),
('CS57-F2', '0775564358', 'Introduction to Logic (3rd Ed)', 'CS57', 1, 4, 'Book', 1998, 3, 0, 0, 0, 1, 0),
('CS57-F3', '7755643580', 'Applied Finite Mathematics', 'CS57', 1, 4, 'Book', 1999, NULL, 0, 0, 0, 1, 0),
('CS57-F4', '7556435807', 'Discrete Mathematical Structures for CS (5th Ed)', 'CS57', 1, 4, 'Book', 2000, 5, 0, 0, 0, 1, 0),
('J-1', '0927129486', 'Journal of Computer Science and Technology', '', 1, 4, 'Journals', 2007, NULL, 1, 0, 0, 1, 0),
('J-10', '9271294860', 'Transactions on Algorithms', '', 1, 4, 'Journals', 1993, NULL, 0, 0, 0, 1, 0),
('J-11', '2712948609', 'Transactions on Applied Perception', '', 1, 4, 'Journals', 1994, NULL, 0, 0, 0, 1, 0),
('J-12', '7129486092', 'Transactions on Architecture and Code Optimization', '', 1, 4, 'Journals', 1995, NULL, 0, 0, 0, 1, 0),
('J-13', '1294860927', 'Transactions on Asian Language Information Processing', '', 1, 4, 'Journals', 1996, NULL, 0, 0, 0, 1, 0),
('J-14', '2948609271', 'Transactions on Autonomous and Adaptive Systems', '', 1, 4, 'Journals', 1996, NULL, 0, 0, 0, 1, 0),
('J-15', '9486092712', 'Transactions on Computation Theory', '', 1, 4, 'Journals', 1997, NULL, 0, 0, 0, 1, 0),
('J-16', '4860927129', 'Transactions on Computational Logic', '', 1, 4, 'Journals', 1998, NULL, 0, 0, 0, 1, 0),
('J-17', '8609271294', 'Transactions on Computer-Human Interaction', '', 1, 4, 'Journals', 1999, NULL, 0, 0, 0, 1, 0),
('J-18', '6092712948', 'Transactions on Computer Systems', '', 1, 4, 'Journals', 2000, NULL, 0, 0, 0, 1, 0),
('J-2', '0228201400', 'Journal of Data and Information Quality (JDIQ)', '', 1, 4, 'Journals', 2008, NULL, 0, 0, 0, 1, 0),
('J-3', '2282014000', 'Journal of Experimental Algorithms', '', 1, 4, 'Journals', 2009, NULL, 0, 0, 0, 1, 0),
('J-4', '2820140002', 'Journal of the ACM', '', 1, 4, 'Journals', 2010, NULL, 0, 0, 0, 1, 0),
('J-5', '8201400022', 'Journal on Computing and Cultural Heritage', '', 1, 4, 'Journals', 2011, NULL, 0, 0, 0, 1, 0),
('J-6', '2014000228', 'Journal on Educational Resources in Computing', '', 1, 4, 'Journals', 2012, NULL, 0, 0, 0, 1, 0),
('J-7', '0140002282', 'Journal on Emerging Technologies in Computing Systems', '', 1, 4, 'Journals', 2013, NULL, 0, 0, 0, 1, 0),
('J-8', '1400022820', 'ACM Letters on Programming Languages and Systems', '', 1, 4, 'Journals', 1991, NULL, 1, 0, 0, 1, 0),
('J-9', '4000228201', 'Transactions on Accesible Computing', '', 1, 4, 'Journals', 1992, NULL, 0, 0, 0, 1, 0),
('M-1', '15436576', 'Communications of the ACM', '', 1, 4, 'Magazines', 1995, 1, 0, 0, 0, 1, 0),
('M-10', '15436577', 'Oracle (Vol IX)', '', 1, 4, 'Magazines', 2004, 9, 0, 0, 0, 1, 0),
('M-11', '14436576', 'MIS Magazine (Vol X)', '', 1, 4, 'Magazines', 2005, 10, 0, 0, 0, 1, 0),
('M-12', '15536576', 'Dr. Dobb’s Magazine', '', 1, 4, 'Magazines', 2006, 1, 0, 0, 0, 1, 0),
('M-13', '15436566', 'Intelligent Computing (Vol II)', '', 1, 4, 'Magazines', 1998, 2, 0, 0, 0, 1, 0),
('M-14', '25436576', 'IEEE Annals on the History of Computing', '', 1, 4, 'Magazines', 1999, 1, 0, 0, 0, 1, 0),
('M-15', '35436576', 'Internet Computing (Vol X)', '', 1, 4, 'Magazines', 2000, 10, 0, 0, 0, 1, 0),
('M-16', '45436576', 'Computer in Entertainment', '', 1, 4, 'Magazines', 1990, 1, 0, 0, 0, 1, 0),
('M-17', '55436576', 'Computer Graphics (Vol II)', '', 1, 4, 'Magazines', 1992, 2, 0, 0, 0, 1, 0),
('M-18', '75436576', 'eLearn: education and Technology in Perspective (Vol V)', '', 1, 4, 'Magazines', 1993, 5, 0, 0, 0, 1, 0),
('M-19', '95736576', 'Intelligence: New Vision of AI  in Practice (Vol III)', '', 1, 4, 'Magazines', 1994, 3, 0, 0, 0, 1, 0),
('M-2', '95074362', 'MIS Asia  (Vol II)', '', 1, 4, 'Magazines', 1996, 2, 0, 0, 0, 1, 0),
('M-20', '76205898', 'Networker: The Crfat of Network Computing', '', 1, 4, 'Magazines', 1995, 1, 0, 0, 0, 1, 0),
('M-3', '66205898', 'Network Magazine (Vol  III)', '', 1, 4, 'Magazines', 1997, 3, 0, 0, 0, 1, 0),
('M-4', '86451100', 'Network Computing', '', 1, 4, 'Magazines', 1998, 1, 0, 0, 0, 1, 0),
('M-5', '29571436', 'PC World (Vol IV)', '', 1, 4, 'Magazines', 1999, 4, 0, 0, 0, 1, 0),
('M-6', '79057438', 'Windows IT Pro (Vol V)', '', 1, 4, 'Magazines', 2000, 5, 0, 0, 0, 1, 0),
('M-7', '23057481', 'Computing Decision (Vol VI)', '', 1, 4, 'Magazines', 2001, 6, 1, 0, 0, 1, 0),
('M-8', '96755523', 'PC Magazine (Vol VII)', '', 1, 4, 'Magazines', 2002, 7, 0, 0, 0, 1, 0),
('M-9', '40964575', 'Windows NT Magazine (Vol VIII)', '', 1, 4, 'Magazines', 2003, 8, 1, 0, 0, 1, 0),
('R-45', '8645110043', 'Operations Reserach', '', 1, 4, 'References', 1995, NULL, 0, 0, 0, 1, 0),
('R-46', '0142909943', 'Introductory Linear Algebra w/ Applications', '', 1, 4, 'References', 1996, NULL, 0, 0, 0, 1, 0),
('R-47', '5690143985', 'Quantitative Approaches to Management', '', 1, 4, 'References', 1997, NULL, 0, 0, 0, 1, 0),
('SP1982-1', '+SP1982-1', 'An Algorithm for the Reduction of Resistor Network', '', 1, 3, 'SP', 1982, NULL, 0, 0, 0, 1, 0),
('SP1986-4', '+SP1986-4', 'Developing the Analysis Phase of Compiler Design and Construction', '', 1, 3, 'SP', 1986, NULL, 0, 0, 0, 1, 0),
('SP1986-5', '+SP1986-5', 'DNA Structure Tutorial for Genetic Using Graforth', '', 1, 3, 'SP', 1986, NULL, 0, 0, 0, 1, 0),
('SP1987-2', '+SP1987-2', 'Database System for the Reforestation Projects in the Phil. Under the Forestry Dev. Center', '', 1, 3, 'SP', 1987, NULL, 0, 0, 0, 1, 0),
('SP1987-3', '+SP1987-3', 'Simulation of the Blood Circulation Inside', '', 1, 3, 'SP', 1987, NULL, 0, 0, 0, 1, 0),
('SP1988-1', '+SP1988-1', 'Design and Implementation of Visible Program Execution Tools for Concurrent Programs', '', 1, 3, 'SP', 1988, NULL, 0, 0, 0, 1, 0),
('SP1988-10b', '+SP1988-10', 'IDGRC: An Application of Three Dimensional Graphics in Gen. Chem', '', 1, 3, 'SP', 1988, NULL, 0, 0, 0, 1, 0),
('SP1988-11', '+SP1988-11', 'EXPERTS: A Protoype Expert System Shell in Prolog', '', 1, 3, 'SP', 1988, NULL, 0, 0, 0, 1, 0),
('SP1988-12a', '+SP1988-12', 'Computer Assisted Feed Formulation of Swine Grower Stage', '', 1, 3, 'SP', 1988, NULL, 0, 0, 0, 1, 0),
('SP1988-13b', '+SP1988-13', 'Computer Assisted Feed Formulation of Swine Grower Stage', '', 1, 3, 'SP', 1988, NULL, 0, 0, 0, 1, 0),
('SP1988-14', '+SP1988-14', 'Design and Implementation of a Software Library Dbase III plus and Turbo Pascal: A Comparative Study', '', 1, 3, 'SP', 1988, NULL, 0, 0, 0, 1, 0),
('SP1988-16', '+SP1988-16', 'Three Way Dimensional Histogram', '', 1, 3, 'SP', 1988, NULL, 0, 0, 0, 1, 0),
('SP1988-18a', '+SP1988-18', 'Dev’t of Computer Assisted Instruction (CAI) Material for Data Structures', '', 1, 3, 'SP', 1988, NULL, 0, 0, 0, 1, 0),
('SP1988-19b', '+SP1988-19', 'Dev’t of Computer Assisted Instruction (CAI) Material for Data Structures', '', 1, 3, 'SP', 1988, NULL, 0, 0, 0, 1, 0),
('SP1988-2', '+SP1988-2', 'Performance Analysis of Three Matrix Inversion Algorithms Using NCR Machine(Pascal Language)', '', 1, 3, 'SP', 1988, NULL, 0, 0, 0, 1, 0),
('SP1988-4a', '+SP1988-4a', 'A Statistical Package for Response Surface Analysis', '', 1, 3, 'SP', 1988, NULL, 0, 0, 0, 1, 0),
('SP1988-5b', '+SP1988-5b', 'A Statistical Package for Response Surface Analysis', '', 1, 3, 'SP', 1988, NULL, 0, 0, 0, 1, 0),
('SP1988-6', '+SP1988-6', 'POLYNNE: A Natural Language Interface for a Database and Modelbase Management System', '', 1, 3, 'SP', 1988, NULL, 0, 0, 0, 1, 0),
('SP1988-7a', '+SP1988-7a', 'Computer Assisted Least Cost Feed Formulation for Dairy Cattle', '', 1, 3, 'SP', 1988, NULL, 0, 0, 0, 1, 0),
('SP1988-8b', '+SP1988-8b', 'Computer Assisted Least Cost Feed Formulation for Dairy Cattle', '', 1, 3, 'SP', 1988, NULL, 0, 0, 0, 1, 0),
('SP1988-9a', '+SP1988-9a', 'IDGRC: An Application of Three Dimensional Graphics in Gen. Chem', '', 1, 3, 'SP', 1988, NULL, 0, 0, 0, 1, 0),
('SP1989-1', '+SP1989-1', 'AUTOPED: An Expert System for Pediatric Diagnosis', '', 1, 3, 'SP', 1989, NULL, 0, 0, 0, 1, 0),
('SP1989-2', '+SP1989-2', 'Assembly Language Implementation of Output Primitives and their Attribute', '', 1, 3, 'SP', 1989, NULL, 0, 0, 0, 1, 0),
('SP1989-3', '+SP1989-3', 'A Totorial Simulation for Memory Mangement', '', 1, 3, 'SP', 1989, NULL, 0, 0, 0, 1, 0),
('SP1989-4', '+SP1989-4', 'INTEGRATE: A Double Numerical Integrator', '', 1, 3, 'SP', 1989, NULL, 0, 0, 0, 1, 0),
('SP1989-5', '+SP1989-5', 'Assembly Language Implementation of Output Primitives and their Attributes', '', 1, 3, 'SP', 1989, NULL, 0, 0, 0, 1, 0),
('SP1989-6', '+SP1989-6', 'PAM: A Toolbox for Drawing Graphs', '', 1, 3, 'SP', 1989, NULL, 0, 0, 0, 1, 0),
('SP1989-7', '+SP1989-7', 'Transition Database from Independent Micro Computers to Network System', '', 1, 3, 'SP', 1989, NULL, 0, 0, 0, 1, 0),
('SP1989-8', '+SP1989-8', 'SLIM + V 1.0', '', 1, 3, 'SP', 1989, NULL, 0, 0, 0, 1, 0),
('SP1990-1', '+SP1990-1', 'Caigraph: Computer Assisted Instruction for Computer Graphics', '', 1, 3, 'SP', 1990, NULL, 0, 0, 0, 1, 0),
('SP1990-10', '+SP1990-10', 'DSSE: A Decision Support System of Evaluation Part II Database Component', '', 1, 3, 'SP', 1990, NULL, 0, 0, 0, 1, 0),
('SP1990-11', '+SP1990-11', 'Piggery Information System: Inventory Subsystem', '', 1, 3, 'SP', 1990, NULL, 0, 0, 0, 1, 0),
('SP1990-12', '+SP1990-12', 'TOME: A Nondeterministic Finite Automation Simulator', '', 1, 3, 'SP', 1990, NULL, 0, 0, 0, 1, 0),
('SP1990-13', '+SP1990-13', 'Developing the Intermediate Code Generation Phase of Compiler Design and Construction', '', 1, 3, 'SP', 1990, NULL, 0, 0, 0, 1, 0),
('T-1', '+T-1', 'GIS Assisted History of Middle East Empires', NULL, 1, 3, 'Thesis', 2002, NULL, 0, 0, 0, 1, 0),
('T-2', '+T-2', 'Production Line Modeling: A Simplified Approach Based on Theory of Constraints', NULL, 1, 3, 'Thesis', 2013, NULL, 0, 0, 0, 1, 0),
('T-3', '+T-3', 'Usability Testing of Android Applications', NULL, 1, 3, 'Thesis', 2005, NULL, 0, 0, 0, 1, 0),
('T-4', '+T-4', 'Mobile Store Management System', NULL, 1, 3, 'Thesis', 2010, NULL, 0, 0, 0, 1, 0),
('T-5', '+T-5', 'Identification of Alternative Translation Initiation Sites', NULL, 1, 3, 'Thesis', 2012, NULL, 0, 0, 0, 1, 0);

--
-- Triggers `librarymaterial`
--
DROP TRIGGER IF EXISTS `librarymaterial_t`;
DELIMITER //
CREATE TRIGGER `librarymaterial_t` AFTER INSERT ON `librarymaterial`
 FOR EACH ROW INSERT into log(action, time, idnumber, isbn, materialid)
VALUES('added', NOW(), 'Admin', NEW.isbn, NEW.materialid)
//
DELIMITER ;
DROP TRIGGER IF EXISTS `librarymaterial_t1`;
DELIMITER //
CREATE TRIGGER `librarymaterial_t1` AFTER DELETE ON `librarymaterial`
 FOR EACH ROW INSERT INTO log(action, time, idnumber, materialid, isbn)
VALUES('deleted', NOW(), 'Admin', OLD.materialid, OLD.isbn )
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `log`
--

CREATE TABLE IF NOT EXISTS `log` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `action` varchar(20) NOT NULL,
  `time` datetime NOT NULL,
  `idnumber` varchar(15) NOT NULL,
  `isbn` varchar(10) DEFAULT NULL,
  `materialid` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=36 ;

--
-- Dumping data for table `log`
--

INSERT INTO `log` (`id`, `action`, `time`, `idnumber`, `isbn`, `materialid`) VALUES
(5, 'deleted', '2014-03-08 15:23:59', 'Admin', '+SP1988-17', 'SP1988-17'),
(6, 'reserved', '2014-03-08 16:09:26', '013579222', '7714358000', 'CS137-Q1'),
(7, 'reserved', '2014-03-08 16:09:37', '013579222', '0007714358', 'CS131-O1'),
(8, 'reserved', '2014-03-08 16:10:35', '013579222', '5514358022', 'CS128-L6'),
(9, 'added', '2014-03-08 21:50:43', 'Admin', '1352900454', 'CS123-J99'),
(10, 'reserved', '2014-03-09 13:14:39', '2009-20035', '8098765435', 'CS142-S2'),
(11, 'returned', '2014-03-09 13:58:59', '2010-54665', '9087435801', 'CS22-E1'),
(12, 'returned', '2014-03-09 13:59:03', '2010-54665', '1234567890', 'CS1-A10'),
(13, 'returned', '2014-03-09 13:59:10', '2011-01021', '6789035254', 'CS123-H3'),
(14, 'returned', '2014-03-09 13:59:22', '2011-01021', '8022551435', 'CS127-K69'),
(15, 'returned', '2014-03-09 14:00:00', '013579222', '2468008642', 'CS11-C35'),
(16, 'returned', '2014-03-09 14:00:12', '135792468', '7890352546', 'CS123-H4'),
(17, 'returned', '2014-03-09 14:00:41', '2010-87728', '3580200914', 'CS124-I4'),
(18, 'returned', '2014-03-09 14:00:49', '2007-10099', '0007714358', 'CS131-O1'),
(19, 'reserved', '2014-03-09 15:21:21', '2011-01021', '8022551435', 'CS127-K69'),
(20, 'reserved', '2014-03-09 15:21:54', '2011-01021', '8022551435', 'CS127-K69'),
(21, 'reserved', '2014-03-09 20:58:35', '2011-42020', '0914358020', 'CS125-J4'),
(22, 'reserved', '2014-03-09 20:59:49', '2011-42020', '8008642246', 'CS11-C38'),
(23, 'reserved', '2014-03-09 21:00:00', '2011-42020', '8008642246', 'CS11-C38'),
(24, 'reserved', '2014-03-09 21:04:39', '2011-42020', '5311357997', 'CS11-C31'),
(25, 'reserved', '2014-03-09 21:05:55', '2011-42020', '4509876123', 'CS11-C1'),
(26, 'added', '2014-03-10 16:16:33', 'Admin', '+T-1', 'T-1'),
(27, 'added', '2014-03-10 16:18:00', 'Admin', '+T-2', 'T-2'),
(28, 'added', '2014-03-10 16:18:53', 'Admin', '+T-3', 'T-3'),
(29, 'added', '2014-03-10 16:19:43', 'Admin', '+T-4', 'T-4'),
(30, 'added', '2014-03-10 16:20:29', 'Admin', '+T-5', 'T-5'),
(31, 'added', '2014-03-10 16:28:20', 'Admin', '+CD-1', 'CD-1'),
(32, 'added', '2014-03-10 16:30:07', 'Admin', '+CD-2', 'CD-2'),
(33, 'added', '2014-03-10 16:30:43', 'Admin', '+CD-3', 'CD-3'),
(34, 'added', '2014-03-10 16:31:16', 'Admin', '+CD-4', 'CD-4'),
(35, 'added', '2014-03-10 16:32:47', 'Admin', '+CD-5', 'CD-5');

-- --------------------------------------------------------

--
-- Table structure for table `rating`
--

CREATE TABLE IF NOT EXISTS `rating` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `rating` varchar(10) NOT NULL,
  `idnumber` varchar(11) NOT NULL,
  `materialid` varchar(15) NOT NULL,
  `isbn` varchar(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idnumber` (`idnumber`),
  KEY `materialid` (`materialid`),
  KEY `isbn` (`isbn`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `reservation`
--

CREATE TABLE IF NOT EXISTS `reservation` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `idnumber` varchar(11) NOT NULL,
  `materialid` varchar(15) NOT NULL,
  `isbn` varchar(10) NOT NULL,
  `queue` int(10) NOT NULL,
  `started` int(1) NOT NULL DEFAULT '0',
  `startdate` date DEFAULT NULL,
  `claimdate` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `isbn` (`isbn`),
  KEY `materialid` (`materialid`),
  KEY `isbn_2` (`isbn`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=331 ;

--
-- Dumping data for table `reservation`
--

INSERT INTO `reservation` (`id`, `idnumber`, `materialid`, `isbn`, `queue`, `started`, `startdate`, `claimdate`) VALUES
(157, '2009-52003', 'CS125-J4', '0914358020', 1, 0, '2014-03-01', NULL),
(166, '2010-67123', 'CS57-F2', '0775564358', 1, 0, '2014-03-01', NULL),
(168, '924611357', 'CS128-L4', '2551435802', 1, 0, '2014-03-01', NULL),
(169, '924611357', 'CS11-C23', '1612131415', 1, 0, '2014-03-01', NULL),
(171, '912151836', 'CS1-A1', '0123456789', 1, 0, '2014-03-01', NULL),
(174, '912151836', 'J-12', '7129486092', 1, 0, '2014-03-01', NULL),
(176, '864213570', 'CS245-FC2', '4358077556', 1, 0, '2014-03-01', NULL),
(177, '864213570', 'R-46', '0142909943', 1, 0, '2014-03-01', NULL),
(178, '792468015', 'CS11-C31', '5311357997', 1, 0, '2014-03-01', NULL),
(181, '678912345', 'CS123-H1', '5467890352', 1, 0, '2014-03-01', NULL),
(182, '678912345', 'CS132-P1', '0077143580', 2, 0, '2014-03-01', NULL),
(188, '456789123', 'CS132-P1', '0077143580', 3, 0, '2014-03-01', NULL),
(272, '2009-52003', 'CS2-B4', '0435802468', 1, 0, '2014-03-04', NULL),
(285, '135708642', 'CS11-C6', '4224680086', 1, 0, '2014-03-05', NULL),
(286, '135708642', 'CS11-C34', '1135799753', 1, 0, '2014-03-05', NULL),
(287, '135708642', 'CS11-C12', '9876123450', 1, 0, '2014-03-05', NULL),
(288, '135708642', 'CS11-C37', '6800864224', 1, 0, '2014-03-05', NULL),
(289, '135708642', 'CS11-C29', '9975311357', 1, 0, '2014-03-05', NULL),
(290, '135708642', 'CS11-C23', '1612131415', 2, 0, '2014-03-05', NULL),
(291, '135708642', 'CS11-C27', '5799753113', 1, 0, '2014-03-05', NULL),
(292, '135708642', 'CS124-FC1', '8903525467', 2, 0, '2014-03-05', NULL),
(302, '', 'CS11-C1', '4509876123', 1, 0, '2014-03-05', NULL),
(314, '2011-42020', 'CS127-K69', '8022551435', 2, 0, '2014-03-06', NULL),
(317, '2011-42020', 'J-8', '1400022820', 3, 0, '2014-03-07', NULL),
(320, '2011-42020', 'CS127-K49', '5802255143', 1, 0, '2014-03-07', NULL),
(321, '013579222', 'CS1-A11', '2345678901', 1, 0, '2014-03-08', NULL),
(322, '013579222', 'J-18', '6092712948', 1, 0, '2014-03-08', NULL),
(323, '2009-20035', 'CS142-S2', '8098765435', 1, 0, '2014-03-09', NULL),
(326, '2011-42020', 'CS125-J4', '0914358020', 2, 0, '2014-03-09', NULL),
(327, '2011-42020', 'CS11-C38', '8008642246', 1, 0, '2014-03-09', NULL),
(328, '2011-42020', 'CS11-C38', '8008642246', 2, 0, '2014-03-09', NULL),
(329, '2011-42020', 'CS11-C31', '5311357997', 2, 0, '2014-03-09', NULL),
(330, '2011-42020', 'CS11-C1', '4509876123', 2, 0, '2014-03-09', NULL);

--
-- Triggers `reservation`
--
DROP TRIGGER IF EXISTS `reservation_t`;
DELIMITER //
CREATE TRIGGER `reservation_t` AFTER INSERT ON `reservation`
 FOR EACH ROW INSERT into log(action, time, idnumber, materialid, isbn)
VALUES('reserved', NOW(), NEW.idnumber, NEW.materialid, NEW.isbn)
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `sample`
--

CREATE TABLE IF NOT EXISTS `sample` (
  `idnumber` varchar(11) NOT NULL,
  `fname` varchar(30) NOT NULL,
  `mname` varchar(20) NOT NULL,
  `lname` varchar(20) NOT NULL,
  `college` varchar(11) NOT NULL,
  `course` varchar(10) NOT NULL,
  `classification` char(1) NOT NULL,
  `sex` char(1) NOT NULL,
  PRIMARY KEY (`idnumber`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sample`
--

INSERT INTO `sample` (`idnumber`, `fname`, `mname`, `lname`, `college`, `course`, `classification`, `sex`) VALUES
('012345678', 'Margarita Carmen', 'Sanchez', 'Paterno', 'CAS', 'BS Statist', 'F', 'F'),
('013579222', 'James', 'Carlos', 'Plaras', 'CAS', 'BSCS', 'F', 'M'),
('027845122', 'Marlon', 'Minoya', 'Manalo', 'CAS', 'BSCS', 'F', 'M'),
('086421357', 'Jamila', 'Ayana', 'Senico', 'CAS', 'BSCS', 'F', 'F'),
('098712345', 'Catherine', 'Mantilla', 'Simat', 'CAS', 'BSCS', 'F', 'F'),
('123456780', 'John Emmanuel', 'Ignita', 'Encinas', 'CAS', 'BSCS', 'F', 'M'),
('123456789', 'Gianina', 'Arriola', 'Vergara', 'CAS', 'BSCS', 'F', 'F'),
('135708642', 'Kristine', 'Elaine', 'Bautista', 'CAS', 'BSCS', 'F', 'F'),
('135792220', 'Caroline', 'Nathalie', 'Peralta', 'CAS', 'BSCS', 'F', 'F'),
('135792468', 'Jeric', 'Salvez', 'Alcala', 'CAS', 'BSCS', 'F', 'M'),
('2004-38914', 'Maria Cristina', 'D', 'Enriquez', 'CAS', 'BCSC', 'S', ''),
('2005-17732', 'Noli', 'P', 'Tamayo Jr', 'CAS', 'BCSC', 'S', ''),
('2005-66307', 'Glomark', 'T', 'Lapay', 'CAS', 'BCSC', 'S', ''),
('2007-00991', 'Jessa', 'Mayen', 'Andrade', 'CAS', 'BSCS', 'S', 'F'),
('2007-09910', 'Evann', 'Norman', 'Tolorio', 'CAS', 'BSCS', 'S', 'M'),
('2007-10099', 'Mariah', 'Gene', 'Garcia', 'CAS', 'BSCS', 'S', 'F'),
('2007-21672', 'Jefferson', 'R', 'Ferrera', 'CAS', 'BCSC', 'S', ''),
('2007-45107', 'Miguel Anton Paulo', 'U', 'Cuenca', 'CAS', 'BCSC', 'S', ''),
('2008-00725', 'Alvin', 'Baracael', 'Carino', 'CA', 'BSABT', 'S', 'M'),
('2008-09822', 'Jahaziel', 'Carmelo', 'Yllagan', 'CAS', 'BSCS', 'S', 'M'),
('2008-09918', 'Erica Leanor', 'P', 'Jimenez', 'CAS', 'BCSC', 'S', ''),
('2008-67242', 'Joseph', 'German', 'Jesuitas', 'CAS', 'BCSC', 'S', ''),
('2009-00072', 'Patrick Paulo', 'Santos', 'Resulto', 'CDC', 'BSDC', 'S', 'M'),
('2009-00288', 'Bj Naomi', 'T', 'Abano', 'CAS', 'BCSC', 'S', ''),
('2009-00352', 'Elle', 'Na', 'Sa', 'CAS', 'BSCS', 'S', 'F'),
('2009-00751', 'Camille', 'Marquez', 'Velisano', 'CAS', 'BSCS', 'S', 'F'),
('2009-14953', 'Erato', 'S', 'Mitra Jr', 'CAS', 'BCSC', 'S', ''),
('2009-17975', 'Jett', 'Cortez', 'Calleja', 'CAS', 'BSCS', 'S', 'M'),
('2009-20035', 'Charlotte', 'Na', 'Sa', 'CAS', 'BSCS', 'S', 'M'),
('2009-23308', 'Anne Bernandine', 'G', 'Bulaong', 'CAS', 'BCSC', 'S', ''),
('2009-25281', 'Billy George', 'M', 'Panulaya', 'CAS', 'BCSC', 'S', ''),
('2009-26281', 'Jean Karlo', 'S', 'Belista', 'CAS', 'BCSC', 'S', ''),
('2009-27575', 'James Joyce', 'G', 'Alano', 'CAS', 'BCSC', 'S', ''),
('2009-28515', 'Eugene', 'Arriston', 'Tenorio', 'CAS', 'BSCS', 'S', 'F'),
('2009-42830', 'Ann Krizzel', 'Cruz', 'Aban', 'CAS', 'BSAMAT', 'S', 'F'),
('2009-46655', 'Joanna', 'Illagan', 'Arriola', 'CAS', 'BSCS', 'S', 'F'),
('2009-52003', 'Happy', 'So', 'Nice', 'CAS', 'BSCS', 'S', 'M'),
('2009-59028', 'Jerica Ann', 'D', 'Batarina', 'CAS', 'BCSC', 'S', ''),
('2009-74291', 'Fatima', 'G', 'Deliva', 'CAS', 'BCSC', 'S', ''),
('2009-98879', 'Lou angela', 'Migora', 'Necor', 'CAS', 'BSCS', 'S', 'F'),
('2009-99100', 'Lynne', 'Marie', 'Idea', 'CAS', 'BSCS', 'S', 'F'),
('2010-00386', 'Clarianne', 'B', 'Cruz', 'CAS', 'BCSC', 'S', ''),
('2010-02739', 'John Ray', 'P', 'Bautista', 'CAS', 'BCSC', 'S', ''),
('2010-16341', 'Dominic', 'C', 'Arandella', 'CAS', 'BCSC', 'S', ''),
('2010-18114', 'Christine Joyce', 'SJ', 'Velarde', 'CAS', 'BCSC', 'S', ''),
('2010-19249', 'Krystel Arriane', 'A', 'Cortez', 'CAS', 'BCSC', 'S', ''),
('2010-22098', 'Sophia', 'Jean', 'Tenorio', 'CAS', 'BSCS', 'S', 'F'),
('2010-24697', 'Gabriel Luis', 'G', 'Borjal', 'CAS', 'BCSC', 'S', ''),
('2010-27026', 'Yumiko Kim', 'C', 'Yoshida', 'CAS', 'BCSC', 'S', ''),
('2010-29047', 'Erika', 'C', 'Kimhoko', 'CAS', 'BCSC', 'S', ''),
('2010-30012', 'Maria Christina', 'Soliven', 'Panol', 'CAS', 'BSCS', 'S', 'F'),
('2010-30204', 'Kenneth Von Noah', 'L', 'Cruz', 'CAS', 'BCSC', 'S', ''),
('2010-33368', 'Raquel Abigail', 'B', 'Bunag', 'CAS', 'BCSC', 'S', ''),
('2010-34002', 'Mikee Angelica', 'Cequena', 'Lacap', 'CAS', 'BSCS', 'S', 'F'),
('2010-35200', 'Denise', 'Anel', 'Olla', 'CAS', 'BSCS', 'S', 'F'),
('2010-36589', 'Prince', 'M', 'Jacinto', 'CAS', 'BCSC', 'S', ''),
('2010-40780', 'Alyssa Bianca', 'B', 'Cos', 'CAS', 'BCSC', 'S', ''),
('2010-41746', 'Mary Aracelli', 'Soriano', 'Basbas', 'CAS', 'BCSC', 'S', ''),
('2010-42599', 'Michael Kevin', 'B', 'Uy', 'CAS', 'BCSC', 'S', ''),
('2010-45059', 'Mary Joy', 'DJ', 'Rongcales', 'CAS', 'BCSC', 'S', ''),
('2010-47106', 'Mary Aracelli', 'Andes', 'Basbas', 'CAS', 'BSCS', 'S', 'F'),
('2010-49034', 'Leona Mae', 'J', 'Jolloso', 'CAS', 'BCSC', 'S', ''),
('2010-54665', 'Zyrene', 'Mendez', 'Ferrer', 'CAS', 'BSCS', 'S', 'F'),
('2010-55219', 'Jan Mae Ann', 'T', 'Dawey', 'CAS', 'BCSC', 'S', ''),
('2010-56289', 'Kevin Anthony', 'O', 'Martinez', 'CAS', 'BCSC', 'S', ''),
('2010-56517', 'Gabrielle Kim', 'V', 'Aenlle', 'CAS', 'BCSC', 'S', ''),
('2010-57088', 'Leo-Aldo', 'A', 'Delos Reyes', 'CAS', 'BCSC', 'S', ''),
('2010-57345', 'Nadine Mary Joyce', 'E', 'Bancoro', 'CAS', 'BCSC', 'S', ''),
('2010-59902', 'Jerred Tam', 'A', 'Almasco', 'CAS', 'BCSC', 'S', ''),
('2010-61063', 'Domingo', 'Metro', 'Vinoya III', 'CAS', 'BCSC', 'S', ''),
('2010-65546', 'Jerielyn', 'Homentes', 'Ortega', 'CAS', 'BSCS', 'S', 'F'),
('2010-65981', 'Ma Katrina', '', 'Espalmado', 'CAS', 'BCSC', 'S', ''),
('2010-67123', 'Gay Ann', 'Bentes', 'Calayo', 'CAS', 'BSCS', 'S', 'F'),
('2010-87728', 'Johanna', 'Mae', 'Shinto', 'CAS', 'BSCS', 'S', 'F'),
('2010-88772', 'Joy', 'Santes', 'Saturno', 'CAS', 'BSCS', 'S', 'F'),
('2011-00177', 'Jolly Ann', 'C', 'Bilad', 'CAS', 'BCSC', 'S', ''),
('2011-00456', 'Nazi', 'Fat', 'Cat', 'CAS', 'BSCS', 'S', 'M'),
('2011-00789', 'Johaira', 'Callado', 'Galag', 'CAS', 'BSCS', 'S', 'F'),
('2011-01021', 'Johana Lyn', 'Dabela', 'Galag', 'CAS', 'BSCS', 'S', 'F'),
('2011-01572', 'Klarence Kim', 'I', 'Manangan', 'CAS', 'BCSC', 'S', ''),
('2011-01647', 'Vaughn Victor', 'A', 'Chua', 'CAS', 'BCSC', 'S', ''),
('2011-01668', 'Junno Paolo', 'Mangulabnan', 'Beringuela', 'CAS', 'BSCS', 'S', 'M'),
('2011-02468', 'Clarriane', 'Dominador', 'Cruz', 'CAS', 'BSCS', 'S', 'F'),
('2011-03119', 'Al Joseph Rai', 'Aniban', 'Tan', 'CAS', 'BCSC', 'S', ''),
('2011-03242', 'Ma Pauline', 'S', 'Gonzales', 'CAS', 'BCSC', 'S', ''),
('2011-03587', 'Ma Clarissa', 'Sulit', 'Estremos', 'CAS', 'BCSC', 'S', ''),
('2011-03854', 'Alvin Rio', 'Usman', 'Valdeztamon', 'CAS', 'BSSTAT', 'S', 'M'),
('2011-04560', 'Claire', 'Kathleen', 'Sumo', 'CAS', 'BSCS', 'S', 'F'),
('2011-04653', 'Johana Lyn', 'Dabela', 'Galag', 'CAS', 'BCSC', 'S', ''),
('2011-06498', 'Carl Adrian', 'Pacheco', 'Castueras', 'CAS', 'BCSC', 'S', ''),
('2011-06939', 'Aristotle', 'Dalluay', 'Martinez', 'CAS', 'BCSC', 'S', ''),
('2011-07358', 'Jeob Ervin', 'N', 'Mallari', 'CAS', 'BCSC', 'S', ''),
('2011-07890', 'Eizel', 'Gracia', 'Mendoza', 'CAS', 'BSCS', 'S', 'M'),
('2011-09229', 'Inna Alexandria', 'Almonte', 'Cstaneda', 'CAS', 'BSCS', 'S', 'F'),
('2011-10195', 'Jen Anne Shane', 'De Tabali', 'Delos Santos', 'CAS', 'BCSC', 'S', ''),
('2011-10311', 'Randall Romeo', 'T', 'Castro', 'CAS', 'BCSC', 'S', ''),
('2011-10364', 'Maricar', 'Lim', 'Valdez', 'CAS', 'BASOC', 'S', 'F'),
('2011-10828', 'Timothy Roel', 'P', 'Arevalo', 'CAS', 'BCSC', 'S', ''),
('2011-11111', 'Hans', 'Soriano', 'Padron', 'CAS', 'BSBIO', 'S', 'M'),
('2011-11132', 'Raphael', 'A', 'Cosuco', 'CAS', 'BCSC', 'S', ''),
('2011-11609', 'Judelyn', 'Mata', 'Mercado', 'CAS', 'BCSC', 'S', ''),
('2011-12192', 'Jerica Ann', 'Umadhay', 'Loren', 'CAS', 'BCSC', 'S', ''),
('2011-12345', 'Janina', 'Hamor', 'Escoliar', 'CAS', 'BSCS', 'S', 'F'),
('2011-12840', 'Kim Joshua', 'Caicdoy', 'Advincula', 'CAS', 'BSCS', 'S', 'M'),
('2011-12911', 'Desery', 'R', 'Sabado', 'CAS', 'BCSC', 'S', ''),
('2011-12959', 'Ruzzel Moises', 'V', 'Lorono', 'CAS', 'BCSC', 'S', ''),
('2011-13579', 'Adrian', 'Manites', 'Leal', 'CAS', 'BSCS', 'S', 'M'),
('2011-15718', 'Anne Trixia', 'Buyan', 'Mirones', 'CAS', 'BCSC', 'S', ''),
('2011-15727', 'Ann Lois', 'Badilla', 'Abendante', 'CAS', 'BCSC', 'S', ''),
('2011-16328', 'Anthony Allan', 'Hofilena', 'Conda', 'CAS', 'BCSC', 'S', ''),
('2011-16517', 'Maraiah Gene', 'Deato', 'Garcia', 'CAS', 'BCSC', 'S', ''),
('2011-16522', 'Lailani', 'Tabuzo', 'Lago', 'CAS', 'BCSC', 'S', ''),
('2011-16702', 'Gabriel John', 'Pilapil', 'Gagno', 'CAS', 'BCSC', 'S', ''),
('2011-17311', 'Nathaniel', 'Parungao', 'Rivera', 'CAS', 'BSCS', 'S', 'F'),
('2011-17446', 'Lovely Joy', 'Erigno', 'Tuyo', 'CAS', 'BCSC', 'S', ''),
('2011-18521', 'Jayson', 'Giataw', 'Valdez', 'CEAT', 'BSCE', 'S', 'M'),
('2011-18535', 'John Carlo', 'Cal', 'Aldave', 'CAS', 'BSCS', 'S', 'M'),
('2011-19200', 'Harmon Ric', 'Manuel', 'Cayaon', 'CEAT', 'BSIE', 'S', 'M'),
('2011-19516', 'Shaira Mae', 'Firmalo', 'Villanueva', 'CAS', 'BCSC', 'S', ''),
('2011-19863', 'John Denielle', 'Flores', 'Hernandez', 'CAS', 'BCSC', 'S', ''),
('2011-20601', 'Jonathan Joseph', 'Penero', 'Pena Jr', 'CAS', 'BCSC', 'S', ''),
('2011-21037', 'Odyzza Faye', 'Lumbre', 'Daleon', 'CAS', 'BCSC', 'S', ''),
('2011-21202', 'Eizel Grace', 'DC', 'Landicho', 'CAS', 'BCSC', 'S', ''),
('2011-21205', 'Kimberly Micah', 'Lastica', 'Magtibay', 'CAS', 'BCSC', 'S', ''),
('2011-21369', 'Cris Joseph', 'Mendoza', 'Ramos', 'CAS', 'BCSC', 'S', ''),
('2011-21376', 'Edelweis', 'Afunggol', 'Valdellon', 'CAS', 'BSCS', 'S', 'F'),
('2011-21400', 'Anne Muriel', 'Villaflor', 'Gonzales', 'CAS', 'BCSC', 'S', ''),
('2011-21402', 'Paul Ivann', 'E', 'Granada', 'CAS', 'BCSC', 'S', ''),
('2011-21569', 'Kara Lane', 'Villamayor', 'Zurbano', 'CAS', 'BCSC', 'S', ''),
('2011-21582', 'Ace Joseph', 'Tan', 'Almazar', 'CAS', 'BSCS', 'S', 'F'),
('2011-21947', 'Lorenzo', 'Cornejo', 'Aban', 'CEM', 'BSECON', 'S', 'M'),
('2011-21984', 'Nyreen', 'Caliwagan', 'Delos Santos', 'CAS', 'BCSC', 'S', ''),
('2011-22108', 'Marieann Jocel', 'Sumage', 'Villanueva', 'CAS', 'BCSC', 'S', ''),
('2011-22120', 'Arlene', 'Antazo', 'Mendoza', 'CAS', 'BCSC', 'S', ''),
('2011-22130', 'Ma Margarita', 'Malana', 'Ocampo', 'CAS', 'BCSC', 'S', ''),
('2011-22168', 'Lorelie', 'Enriquez', 'Miranda', 'CAS', 'BCSC', 'S', ''),
('2011-22418', 'Billy Joel Arlo', 'Tambalo', 'Zarate', 'CAS', 'BCSC', 'S', ''),
('2011-22530', 'Maila Angelica', 'Lazarte', 'Medina', 'CAS', 'BCSC', 'S', ''),
('2011-23451', 'Yanyan', 'Campos', 'tarong', 'CAS', 'BSCS', 'S', 'F'),
('2011-23456', 'Chester', 'Alis', 'Manuel', 'CAS', 'BASocio', 'S', 'M'),
('2011-24680', 'Frederick', 'Sama', 'Fernandez', 'CAS', 'BSCS', 'S', 'M'),
('2011-25010', 'Edezer Josh', '', 'Padilla', 'CAS', 'BCSC', 'S', ''),
('2011-25084', 'Alyssa Jean', 'Aseo', 'Angeles', 'CAS', 'BCSC', 'S', ''),
('2011-25238', 'Bianca Patricia', 'Dichoso', 'Merced', 'CAS', 'BCSC', 'S', ''),
('2011-26567', 'Mark Lester', 'Ampeloquio', 'Revilloza', 'CA', 'BSA', 'S', 'M'),
('2011-26806', 'Julius', 'Mendez', 'Iglesia', 'CAS', 'BCSC', 'S', ''),
('2011-26988', 'Denise Marie ', 'Pamintuan', 'Revilla', 'CAS', 'BSBIO', 'S', 'F'),
('2011-27573', 'Edlex', 'J', 'Purificacion', 'CAS', 'BCSC', 'S', ''),
('2011-28419', 'Marc Ulysis', 'Landicho', 'De Ramos', 'CAS', 'BCSC', 'S', ''),
('2011-28447', 'Christine Joy', 'Paril', 'Villaruel', 'CAS', 'BCSC', 'S', ''),
('2011-28479', 'Cyril Justine', 'Dimaandal', 'Bravo', 'CAS', 'BCSC', 'S', ''),
('2011-29339', 'Gerald Benedict', 'Cruzado', 'Emalada', 'CAS', 'BCSC', 'S', ''),
('2011-29670', 'Nazi', 'Fabre', 'Amoncio', 'CAS', 'BSCS', 'S', 'M'),
('2011-29673', 'Kevin Lloyd', 'Hallasgo', 'Bernal', 'CAS', 'BSCS', 'S', 'M'),
('2011-29712', 'Dyanara', 'Madayag', 'Dela Rosa', 'CAS', 'BCSC', 'S', ''),
('2011-29868', 'Adrian	', 'J', 'Leal', 'CAS', 'BCSC', 'S', ''),
('2011-29873', 'Chris Nicole', 'Valencia', 'Rivera', 'CAS', 'BSCS', 'S', 'M'),
('2011-30865', 'Monica', 'D', 'Dasmarinas', 'CAS', 'BCSC', 'S', ''),
('2011-31073', 'Jericho Francis', 'A', 'Carlos', 'CAS', 'BCSC', 'S', ''),
('2011-31255', 'Harland', 'Agcaoili', 'Balucating', 'CAS', 'BSCS', 'S', 'M'),
('2011-31260', 'Rey', 'Yude', 'Benedicto', 'CAS', 'BSCS', 'S', 'M'),
('2011-31475', 'Christopher Jade', 'Quintanilla', 'Vita', 'CAS', 'BCSC', 'S', ''),
('2011-31907', 'John Ryan', 'D', 'Tarong', 'CAS', 'BCSC', 'S', ''),
('2011-32217', 'Lanz Timothy', 'Gaw', 'Uy', 'CVM', 'DVM', 'S', 'M'),
('2011-32351', 'Jent Francis', 'Antipolo', 'Aguilar', 'CAS', 'BSCS', 'S', 'M'),
('2011-32908', 'Mia Camille', 'Saprona', 'Milambiling', 'CAS', 'BCSC', 'S', ''),
('2011-33788', 'Gwyn', 'Banta', 'Contreras', 'CAS', 'BCSC', 'S', ''),
('2011-35330', 'Sarah Willen Kristel', '', 'Hernandez', 'CAS', 'BCSC', 'S', ''),
('2011-36391', 'Glorybie', 'M', 'Delos Santos', 'CAS', 'BCSC', 'S', ''),
('2011-36586', 'Thea Abigail', 'Yu', 'Lomibao', 'CAS', 'BCSC', 'S', ''),
('2011-36960', 'Arvin Kent', 'S', 'Jacob', 'CAS', 'BCSC', 'S', ''),
('2011-38016', 'Angela Roscel', 'B', 'Almoro', 'CAS', 'BCSC', 'S', ''),
('2011-38722', 'Laurevel', 'Burna', 'Burata', 'CAS', 'BSCS', 'S', 'F'),
('2011-38749', 'Jay-ar', 'Banaira', 'Hernaez', 'CAS', 'BCSC', 'S', ''),
('2011-38803', 'Edmaren', 'Fabi', 'Padua', 'CAS', 'BCSC', 'S', ''),
('2011-39502', 'Jhomar', 'Morales', 'Adefuin', 'CAS', 'BSCS', 'S', 'M'),
('2011-42020', 'Frederick', 'Acal', 'Fernandez', 'CAS', 'BSCS', 'S', 'M'),
('2011-42355', 'Albert Jamie', 'Del Rosario', 'Atadero', 'CAS', 'BSCS', 'S', 'M'),
('2011-42644', 'Jonard', 'Corpuz', 'Valdoz', 'CAS', 'BSBIO', 'S', 'M'),
('2011-43325', 'Mark Emmanuel', 'Lagsit', 'Vargas', 'CAS', 'BCSC', 'S', ''),
('2011-43580', 'Charlene', 'Canedo', 'Canedo', 'CAS', 'BSCS', 'S', 'F'),
('2011-45001', 'Chandelle Joyce', '', 'Marquez', 'CAS', 'BCSC', 'S', ''),
('2011-45123', 'Gail', 'Entala', 'Ramirez', 'CAS', 'BSCS', 'S', 'F'),
('2011-45327', 'Mac Emerson', 'B', 'Reyes', 'CAS', 'BCSC', 'S', ''),
('2011-45600', 'Eimereen', 'Andes', 'Allido', 'CAS', 'BSCS', 'S', 'F'),
('2011-46487', 'Luna', 'Pil', 'Solon', 'CVM', 'DVM', 'S', 'F'),
('2011-46496', 'Abigail Hannica', 'Resulto', 'Ramirez', 'CAS', 'BSCS', 'S', 'F'),
('2011-46497', 'Lea Isabella', 'Tamoria', 'Rinon', 'CAS', 'BSSTAT', 'S', 'F'),
('2011-46682', 'Mark Carlo', 'Alcantara', 'Dela Torre', 'CAS', 'BCSC', 'S', ''),
('2011-46686', 'Jenina Grace', '', 'Escorial', 'CAS', 'BCSC', 'S', ''),
('2011-46802', 'Edlex', 'Martines', 'Purificacion', 'CAS', 'BSCS', 'S', 'M'),
('2011-46957', 'Anne Margareth', 'Talento', 'Rivera', 'CEM', 'BSABM', 'S', 'F'),
('2011-47521', 'Red', 'Villapando', 'Fernandez', 'CA', 'BSABT', 'S', 'M'),
('2011-47640', 'Mark Angelo', 'Nacionales', 'Burdeos', 'CAS', 'BSCS', 'S', 'M'),
('2011-48315', 'Yssa Marie', 'Virina', 'Villanueva', 'CAS', 'BCSC', 'S', ''),
('2011-48393', 'Jose Carlo', 'Gaduena', 'Husmillo', 'CAS', 'BCSC', 'S', ''),
('2011-48563', 'Angelo Mathew', 'Banez', 'Reyes', 'CEAT', 'BSCE', 'S', 'M'),
('2011-48644', 'Neil Harvey', 'Vergara', 'Cruzada', 'CAS', 'BSCS', 'S', 'M'),
('2011-48742', 'Vanessa Camille', 'Arcega', 'Agbay', 'CAS', 'BSCS', 'S', 'F'),
('2011-48842', 'Emmanual Andrew', 'Poblacion', 'Torres', 'CAS', 'BCSC', 'S', ''),
('2011-48958', 'John Nicholo', 'C', 'Dominguez', 'CAS', 'BCSC', 'S', ''),
('2011-49156', 'Zinnia Kale', 'Agcanas', 'Malabuyoc', 'CAS', 'BCSC', 'S', ''),
('2011-50174', 'Gavin Christian', 'Cedro', 'Calaminos', 'CAS', 'BCSC', 'S', ''),
('2011-50539', 'Jan Claudette', 'Espanola', 'Quevedo', 'CAS', 'BCSC', 'S', ''),
('2011-51296', 'Frei Richelieu', 'Bravo', 'Echave', 'CAS', 'BCSC', 'S', ''),
('2011-53005', 'Sheena Lara', 'Dinglasan', 'De Guzman', 'CAS', 'BCSC', 'S', ''),
('2011-53035', 'Raphael Nelo', 'Sayno', 'Aguila', 'CAS', 'BSCS', 'S', 'M'),
('2011-53845', 'Evan Norman', 'Abrajano', 'Tolorio', 'CAS', 'BCSC', 'S', ''),
('2011-53949', 'Angel Marie', 'Halago', 'Dargantes', 'CVM', 'DVM', 'S', 'F'),
('2011-53951', 'Rochelle', 'Pahm', 'Juevesano', 'CAS', 'BCSC', 'S', ''),
('2011-54422', 'Joyal aleen', 'Benites', 'Borromeo', 'CAS', 'BSCS', 'S', 'F'),
('2011-54908', 'Jekri', 'Preclaro', 'Orlina', 'CAS', 'BCSC', 'S', ''),
('2011-54916', 'Janet', 'Pascual', 'Ordillano', 'CAS', 'BCSC', 'S', ''),
('2011-55768', 'Nomer', 'Castillo', 'Rivera', 'CEAT', 'BSCS', 'S', 'M'),
('2011-55898', 'Reggie', 'Mapili', 'Valdez', 'CAS', 'BSCS', 'S', 'M'),
('2011-56657', 'Marian', 'Maligaya', 'Alvarez', 'CAS', 'BSCS', 'S', 'F'),
('2011-56717', 'Ma Theresa', 'S', 'Nicdao', 'CAS', 'BCSC', 'S', ''),
('2011-57031', 'Eimereen', 'Jamilla', 'Alido', 'CAS', 'BCSC', 'S', ''),
('2011-57656', 'Gerome', 'Planas', 'Magsiglat', 'CAS', 'BCSC', 'S', ''),
('2011-57947', 'Clare Kathleen', 'Embrado', 'Sumo', 'CAS', 'BCSC', 'S', ''),
('2011-59046', 'Melvin', 'Arco', 'Flores', 'CAS', 'BCSC', 'S', ''),
('2011-59882', 'Emerald', 'Fajutag', 'Fallarme', 'CAS', 'BCSC', 'S', ''),
('2011-61368', 'Patrick Lorenz', 'Tarranco', 'Ursolino', 'CAS', 'BCSC', 'S', ''),
('2011-62074', 'Paul Daniel', 'Briones', 'Tomias', 'CAS', 'BCSC', 'S', ''),
('2011-62093', 'Alfie', 'G', 'Mendoza', 'CAS', 'BCSC', 'S', ''),
('2011-62193', 'John Viscel', 'M', 'Sangkal', 'CAS', 'BCSC', 'S', ''),
('2011-62804', 'Jerard Paul', 'Villaluz', 'Tulod', 'CEAT', 'BSIE', 'S', 'M'),
('2011-64658', 'Carmela Jane', 'Licardo', 'Garcia', 'CAS', 'BCSC', 'S', ''),
('2011-67879', 'Felicitas', 'Ranque', 'Becera', 'CAS', 'BCSC', 'S', ''),
('2011-69306', 'Leo Angelo', 'C', 'Diabordo', 'CAS', 'BCSC', 'S', ''),
('2011-71536', 'Joshua', 'Caringal', 'Aguila', 'CAS', 'BSCS', 'S', 'M'),
('2011-90078', 'Gwyn', 'Artes', 'Contreras', 'CAS', 'BSStat', 'S', 'F'),
('2011-90678', 'Kat', 'Himor', 'Espalmado', 'CAS', 'BSCS', 'S', 'F'),
('2011-91357', 'Sarah', 'Cuachin', 'Hernandez', 'CAS', 'BSCS', 'S', 'F'),
('2011-99999', 'Juan', 'Soriano', 'Cruz', 'CAS', 'BSCS', 'S', 'M'),
('2012-51007', 'Jojo', 'Alcantara', 'Lopez', 'CAS', 'BSStat', 'S', 'M'),
('2012-55466', 'Irish', 'Jeremy', 'Hamor', 'CAS', 'BSStat', 'S', 'F'),
('2012-98220', 'Aaron', 'Paul', 'Magnes', 'CAS', 'BSStat', 'S', 'M'),
('201357922', 'Alfie', 'Ramona', 'Ramonte', 'CAS', 'BSCS', 'F', 'M'),
('213570864', 'Michael', 'Fagan', 'Cruz', 'CAS', 'BSCS', 'F', 'M'),
('234567801', 'Martee Aaron', 'Lopez', 'Malmanalang', 'CAS', 'BSCS', 'F', 'M'),
('234567891', 'Charmaine', 'Cortes', 'Galano', 'CAS', 'BSCS', 'F', 'F'),
('345678012', 'Lailanie', 'Dantes', 'Danila', 'CAS', 'BSCS', 'F', 'F'),
('345678912', 'Sheila Kathleen', 'Lanuzo', 'Borja', 'CAS', 'BSCS', 'F', 'F'),
('357086421', 'Ivy', 'Galam', 'Aguila', 'CAS', 'BSCS', 'F', 'F'),
('357922201', 'Rommel', 'Sandigan', 'Bulalacao', 'CAS', 'BSCS', 'F', 'M'),
('357924681', 'Mark Jayson', 'Ferero', 'Cortez', 'CAS', 'BSCS', 'F', 'M'),
('369121518', 'Antonete', 'Guzman', 'Baria', 'CAS', 'BSCS', 'F', 'F'),
('421357086', 'Eric', 'Joyce', 'Grande', 'CAS', 'BSCS', 'F', 'M'),
('445566779', 'Butch', 'Batallion', 'Batallier', 'CAS', 'BSCS', 'F', 'M'),
('455667794', 'Bryan', 'Rudy', 'Hernandez', 'CAS', 'BSCS', 'F', 'M'),
('456780123', 'Jaime', 'Pontella', 'Samaniego', 'CAS', 'BSCS', 'F', 'M'),
('456789123', 'April', 'Tormis', 'Castro', 'CAS', 'BSCS', 'F', 'F'),
('468135792', 'Maria Art', 'Antonette', 'Clarino', 'CAS', 'BSCS', 'F', 'F'),
('556677944', 'Anthony', 'Cuela', 'Cueno', 'CAS', 'BSCS', 'F', 'M'),
('566779445', 'Joey', 'Tim', 'Gupa', 'CAS', 'BSCS', 'F', 'M'),
('567891234', 'Rick Jason', 'Endero', 'Obrero', 'CAS', 'BSCS', 'F', 'M'),
('570864213', 'Marites', 'Dee', 'Yee', 'CAS', 'BSCS', 'F', 'F'),
('572468013', 'Lorenzo', 'Andarde', 'Yambot', 'CAS', 'BSMATH', 'F', 'M'),
('579222013', 'Melanie', 'Sucaldito', 'Laranang', 'CAS', 'BSCS', 'F', 'M'),
('642135708', 'Sofia', 'Leal', 'Marasigan', 'CAS', 'BSCS', 'F', 'F'),
('667794455', 'Nicholas', 'Cage', 'Aranas', 'CAS', 'BSCS', 'F', 'M'),
('677944556', 'Jewel', 'Mische', 'Caponitan', 'CAS', 'BSCS', 'F', 'F'),
('678912345', 'Reginald', 'Notarte', 'Recario', 'CAS', 'BSCS', 'F', 'M'),
('681357924', 'Faith', 'Sanchez', 'Marasigan', 'CAS', 'BSCS', 'F', 'F'),
('691215183', 'Naomi', 'Noolga', 'Enriquez', 'CAS', 'BSCS', 'F', 'F'),
('708642135', 'Junnifer', 'Facethe', 'Corner', 'CAS', 'BSCS', 'F', 'M'),
('779445566', 'Jericho', 'Bakery', 'Alcantara', 'CAS', 'BSCS', 'F', 'M'),
('789123456', 'Marie Betel', 'Borra', 'De Robles', 'CAS', 'BSCS', 'F', 'M'),
('792220135', 'Julius', 'Dyado', 'Villanueva', 'CAS', 'BSCS', 'F', 'M'),
('792468015', 'Kristoffer', 'Lei', 'Lactuan', 'CAS', 'BSCS', 'F', 'M'),
('794455667', 'Myra', 'Buria', 'Borines', 'CAS', 'BSCS', 'F', 'F'),
('813579246', 'Mark Froilan', 'Barrios', 'Tandoc', 'CAS', 'BSCS', 'F', 'M'),
('864213570', 'Jayson', 'Andrade', 'Robles', 'CAS', 'BSCS', 'F', 'M'),
('891234567', 'Yvette', 'Borra', 'De Robles', 'CAS', 'BSCS', 'F', 'F'),
('912151836', 'Wille', 'Rayson', 'Remollo', 'CAS', 'BSCS', 'F', 'M'),
('912345678', 'Katrina Joy', 'Hamorra', 'Magno', 'CAS', 'BSCS', 'F', 'F'),
('922201357', 'Vicky', 'Dela Cruz', 'Comayas', 'CAS', 'BSCS', 'F', 'F'),
('924611357', 'Kim', 'Millanta', 'Samaniego', 'CAS', 'BSCS', 'F', 'F'),
('944556677', 'Sheila', ' Cortes', 'Demigillo', 'CAS', '', 'F', 'F');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE IF NOT EXISTS `settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fine` int(2) NOT NULL,
  `start` date NOT NULL,
  `end` date NOT NULL,
  `semester` int(1) NOT NULL,
  `fineenable` int(1) NOT NULL,
  `max` int(2) DEFAULT '3',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `fine`, `start`, `end`, `semester`, `fineenable`, `max`) VALUES
(1, 5, '2013-11-11', '2014-03-29', 2, 0, 3);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `author`
--
ALTER TABLE `author`
  ADD CONSTRAINT `author_ibfk_1` FOREIGN KEY (`materialid`) REFERENCES `librarymaterial` (`materialid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `author_ibfk_2` FOREIGN KEY (`isbn`) REFERENCES `librarymaterial` (`isbn`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `borrowedmaterial`
--
ALTER TABLE `borrowedmaterial`
  ADD CONSTRAINT `borrowedmaterial_ibfk_1` FOREIGN KEY (`materialid`) REFERENCES `librarymaterial` (`materialid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `borrowedmaterial_ibfk_2` FOREIGN KEY (`isbn`) REFERENCES `librarymaterial` (`isbn`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `borrower`
--
ALTER TABLE `borrower`
  ADD CONSTRAINT `borrower_ibfk_1` FOREIGN KEY (`idnumber`) REFERENCES `sample` (`idnumber`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `rating`
--
ALTER TABLE `rating`
  ADD CONSTRAINT `rating_ibfk_1` FOREIGN KEY (`materialid`) REFERENCES `librarymaterial` (`materialid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `rating_ibfk_2` FOREIGN KEY (`isbn`) REFERENCES `librarymaterial` (`isbn`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `rating_ibfk_3` FOREIGN KEY (`idnumber`) REFERENCES `borrower` (`idnumber`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `reservation`
--
ALTER TABLE `reservation`
  ADD CONSTRAINT `reservation_ibfk_1` FOREIGN KEY (`materialid`) REFERENCES `librarymaterial` (`materialid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `reservation_ibfk_2` FOREIGN KEY (`isbn`) REFERENCES `librarymaterial` (`isbn`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
