SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";
CREATE DATABASE IF NOT EXISTS `Library` DEFAULT CHARACTER SET utf8 COLLATE utf8_czech_ci;
USE `Library`;


DROP TABLE IF EXISTS `Book`;
CREATE TABLE `Book` (
  `ID` int NOT NULL,
  `Name` varchar(256) CHARACTER SET utf8 COLLATE utf8_czech_ci NOT NULL,
  `Authors` varchar(256) CHARACTER SET utf8 COLLATE utf8_czech_ci NOT NULL,
  `Published` int NOT NULL,
  `Publisher` varchar(256) COLLATE utf8_czech_ci NOT NULL,
  `Genre` varchar(256) CHARACTER SET utf8 COLLATE utf8_czech_ci NOT NULL,
  `Amount` int NOT NULL,
  `Available` int NOT NULL,
  `Votes` int NOT NULL,
  `ISBN` varchar(256) CHARACTER SET utf8 COLLATE utf8_czech_ci NOT NULL,
  `Library` varchar(256) CHARACTER SET utf8 COLLATE utf8_czech_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8_czech_ci;


INSERT INTO `Book` (`ID`, `Name`, `Authors`, `Published`, `Publisher`, `Genre`, `Amount`, `Available`, `Votes`, `ISBN`, `Library`) VALUES
(63, 'testbook', 'test', 1987, 'distributor', 'testgen', 87, 1, 0, '87-98', 'testlib'),
(3, 'In Search of Lost Time', 'Marcel Proust', 1913, 'distributor', 'Novel', 100, 1, 13, '978-0-00-000003-3', 'fit'),
(4, 'One Hundred Years of Solitude', 'Gabriel García Márquez', 1967, 'distributor', 'Magical', 150, 1, 11, '978-0-00-000004-0', 'fit'),
(5, 'The Great Gatsby', 'F. Scott Fitzgerald', 1925, 'distributor', 'Classic', 200, 0, 1, '978-0-00-000005-7', 'fit'),
(6, 'Moby-Dick or, the Whale', 'Herman Melville', 1851, 'distributor', 'Novel', 507, 1, 5, '978-0-00-000006-4', 'fit'),
(7, 'War and Peace', 'Leo Tolstoy', 1869, 'distributor', 'Tragedy', 2590, 100, 0, '978-0-00-000007-1', 'fit'),
(8, 'Hamlet', 'William Shakespeare', 1601, 'distributor', 'Tragedy', 0, 0, 8, '978-0-00-000008-8', 'fit'),
(9, 'The Odyssey', 'Homer', 800, 'distributor', 'Epic Poetry', 70, 70, 0, '978-0-00-000009-5', 'fit'),
(10, 'Madame Bovary', 'Gustave Flaubert', 1856, 'distributor', 'Realistic Novel', 155, 155, 0, '978-0-00-000010-1', 'fit'),
(11, 'The Divine Comedy', 'Dante Alighieri', 1320, 'distributor', 'Epic Poetry', 15, 15, 0, '978-0-00-000011-8', 'fit'),
(12, 'Lolita', 'Vladimir Nabokov', 1984, 'distributor', 'Horror', 60, 60, 0, '978-0-00-000012-5', 'fit'),
(13, 'The Brothers Karamazov', 'Fyodor Dostoyevsky', 1879, 'distributor', 'Drama', 78, 78, 0, '978-0-00-000013-2', 'fit'),
(14, 'Crime and Punishment', 'Fyodor Dostoyevsky', 1866, 'distributor', 'Criminal Fiction', 140, 140, 0, '978-0-00-000014-9', 'fit'),
(15, 'Wuthering Heights', 'Emily Brontë', 1847, 'distributor', 'Gothic Fiction', 10, 10, 0, '978-0-00-000015-6', 'fit'),
(16, 'The Catcher in the Rye', 'J. D. Salinger', 1951, 'distributor', 'Juvenile Literature', 65, 65, 0, '978-0-00-000016-3', 'fit'),
(18, 'The Adventures of Huckleberry Finn', 'Mark Twain', 1884, 'distributor', 'Adventurous Novel', 213, 213, 0, '978-0-00-000018-7', 'fit'),
(19, 'Anna Karenina', 'Leo Tolstoy', 1877, 'distributor', 'Realism', 90, 90, 0, '978-0-00-000019-4', 'fit'),
(20, 'Alice\'s Adventures in Wonderland', 'Lewis Carroll', 1871, 'distributor', 'Children\'s Literature', 140, 140, 0, '978-0-00-000020-0', 'fit'),
(21, 'The Iliad', 'Homer', 800, 'distributor', 'Epic Poetry', 10, 10, 0, '978-0-00-000021-7', 'fit'),
(22, 'To the Lighthouse', 'Virginia Woolf', 1927, 'distributor', 'Novel', 100, 100, 0, '978-0-00-000022-4', 'fit'),
(23, 'Catch-22', 'Joseph Heller', 1961, 'distributor', 'Satire', 160, 160, 0, '978-0-00-000023-1', 'fit'),
(26, 'Nineteen Eighty Four', 'George Orwell', 1949, 'abc', 'Science', 110, 1, 0, '978-0-00-000026-2', 'Moravská zemská knihovna'),
(27, 'Great Expectations', 'Charles Dickens', 1860, 'distributor', 'Bildungsroman', 62, 1, 7, '978-0-00-000027-9', 'Moravská zemská knihovna'),
(28, 'One Thousand and One Nights by', 'Hanan Al-Shaykh', 2013, 'distributor', 'Folk Tales', 45, 45, 0, '978-0-00-000028-6', 'Moravská zemská knihovna'),
(29, 'The Grapes of Wrath', 'John Steinbeck', 1939, 'distributor', 'Historic', 35, 1, 0, '978-0-00-000029-3', 'Moravská zemská knihovna'),
(30, 'Absalom, Absalom!', 'William Faulkner', 1936, 'distributor', 'Gothic Novel', 15, 15, 15, '978-0-00-000030-9', 'Moravská zemská knihovna'),
(31, 'Invisible Man', 'Ralph Ellison', 1952, 'abc', 'Novel', 694, 1, 8, '978-0-00-000031-6', 'Moravská zemská knihovna'),
(32, 'To Kill a Mockingbird', 'Harper Lee', 1960, 'distributor', 'Bildungsroman', 0, 0, 1, '978-0-00-000032-3', 'Moravská zemská knihovna'),
(33, 'The Trial', 'Franz Kafka', 1925, 'abc', 'Dystopian', 80, 1, 0, '978-0-00-000033-0', 'Moravská zemská knihovna'),
(34, 'The Red and the Black', 'Stendhal', 1830, 'distributor', 'Historical Psychological Novel', 70, 70, 0, '978-0-00-000034-7', 'Moravská zemská knihovna'),
(35, 'Middlemarch', 'George Eliot', 1871, 'distributor', 'Historic Novel', 36, 36, 0, '978-0-00-000035-4', 'Moravská zemská knihovna'),
(36, 'Gulliver\'s Travels', 'Jonathan Swift', 1726, 'distributor', 'Adventurous Novel', 55, 55, 0, '978-0-00-000036-1', 'Moravská zemská knihovna'),
(37, 'Beloved', 'Toni Morrison', 1987, 'distributor', 'Novel', 17, 17, 0, '978-0-00-000037-8', 'Moravská zemská knihovna'),
(38, 'Mrs. Dalloway', 'Virginia Woolf', 1925, 'distributor', 'Psychologic Fiction', 20, 20, 0, '978-0-00-000038-5', 'Moravská zemská knihovna'),
(39, 'The Stories of Anton Chekhov', 'Anton Chekhov', 1932, 'distributor', 'Fiction', 40, 40, 0, '978-0-00-000039-2', 'Moravská zemská knihovna'),
(40, 'The Stranger', 'Albert Camus', 1942, 'distributor', 'Novel', 36, 36, 0, '978-0-00-000040-8', 'Moravská zemská knihovna'),
(41, 'Jane Eyre', 'Charlotte Brontë', 1847, 'distributor', 'Romantic Novel', 50, 50, 0, '978-0-00-000041-5', 'Moravská zemská knihovna'),
(42, 'The Aeneid', 'Virgil', 19, 'distributor', 'Epic Poem', 10, 10, 0, '978-0-00-000042-2', 'Moravská zemská knihovna'),
(43, 'Collected Fiction', 'Jorge Luis Borges', 1998, 'distributor', 'Tale Fiction', 15, 15, 0, '978-0-00-000043-9', 'Moravská zemská knihovna'),
(44, 'The Sun Also Rises', 'Ernest Hemingway', 1926, 'distributor', 'Novel', 32, 32, 0, '978-0-00-000044-6', 'Moravská zemská knihovna'),
(45, 'David Copperfield', 'Charles Dickens', 1849, 'distributor', 'Novel', 0, 0, 8, '978-0-00-000045-3', 'Moravská zemská knihovna'),
(46, 'Tristram Shandy', 'Laurence Sterne', 1767, 'distributor', 'Historic Novel', 30, 30, 0, '978-0-00-000046-0', 'Moravská zemská knihovna'),
(47, 'Leaves of Grass', 'Walt Whitman', 1855, 'distributor', 'Poetry', 50, 50, 0, '978-0-00-000047-7', 'Moravská zemská knihovna'),
(48, 'The Magic Mountain', 'Thomas Mann', 1924, 'distributor', 'Novel', 15, 15, 0, '978-0-00-000048-4', 'Moravská zemská knihovna'),
(49, 'A Portrait of the Artist as a Young Man', 'James Joyce', 1916, 'distributor', 'Semi-autobiographical Novel', 22, 22, 0, '978-0-00-000049-1', 'Moravská zemská knihovna'),
(50, 'Midnight\'s Children', 'Salman Rushdie', 1981, 'distributor', 'Magic Realism', 33, 33, 0, '978-0-00-000050-7', 'Moravská zemská knihovna');


DROP TABLE IF EXISTS `Library`;
CREATE TABLE `Library` (
  `ID` int NOT NULL,
  `Name` varchar(256) CHARACTER SET utf8 COLLATE utf8_czech_ci NOT NULL,
  `Address` varchar(256) CHARACTER SET utf8 COLLATE utf8_czech_ci NOT NULL,
  `Open_hours` varchar(256) CHARACTER SET utf8 COLLATE utf8_czech_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8_czech_ci;


INSERT INTO `Library` (`ID`, `Name`, `Address`, `Open_hours`) VALUES
(2, 'Moravská zemská knihovna', 'Kounicova 65a · 541 646 201', 'PO 9:00 - 20:00\r\nUT 9:00 - 20:00\r\nST 9:00 - 20:00\r\nSTV 9:00 - 20:00\r\nPIA 9:00 - 20:00\r\nSO 10:00 - 15:00\r\nNE zatvoreno'),
(1, 'fit', 'Božetěchova 7', '13:00 - 15:00'),
(12, 'testlib', 'testadr', '15:00 - 18:00');


DROP TABLE IF EXISTS `Order`;
CREATE TABLE `Order` (
  `ID` int NOT NULL,
  `Title` varchar(256) CHARACTER SET utf8 COLLATE utf8_czech_ci NOT NULL,
  `Publisher` varchar(256) CHARACTER SET utf8 COLLATE utf8_czech_ci NOT NULL,
  `Amount` int NOT NULL,
  `Library` varchar(256) COLLATE utf8_czech_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8_czech_ci;


INSERT INTO `Order` (`ID`, `Title`, `Publisher`, `Amount`, `Library`) VALUES
(20, 'War and Peace', 'distributor', 200, '1'),
(16, 'The Great Gatsby', 'distributor', 500, '1'),
(21, 'Crime and Punishment', 'distributor', 100, '2'),
(22, 'Gulliver\'s Travels', 'distributor', 50, '12'),
(23, 'Jane Eyre', 'distributor', 80, '2');


DROP TABLE IF EXISTS `Reservation`;
CREATE TABLE `Reservation` (
  `ID` int NOT NULL,
  `Pending` int NOT NULL,
  `Return_date` varchar(256) CHARACTER SET utf8 COLLATE utf8_czech_ci NOT NULL,
  `Fine` int NOT NULL,
  `Email` varchar(32) CHARACTER SET utf8 COLLATE utf8_czech_ci NOT NULL,
  `Title` varchar(256) CHARACTER SET utf8 COLLATE utf8_czech_ci NOT NULL,
  `Libid` int NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8_czech_ci;


INSERT INTO `Reservation` (`ID`, `Pending`, `Return_date`, `Fine`, `Email`, `Title`, `Libid`) VALUES
(1, 0, '2021-12-29', 0, 'admin@admin.cz', 'The Sound and the Fury', 2),
(2, 0, '2022-12-29', 150, 'email@email', 'Ulysses', 1),
(7, 0, '2021-11-29', 0, 'admin@admin.cz', 'Nineteen Eighty Four', 2),
(6, 1, '0000-00-00', 0, 'ctenar@ctenar.cz', 'The Stranger', 2),
(8, 1, '0000-00-00', 0, 'peter@peter.cz', 'Nineteen Eighty Four', 2),
(9, 1, '0000-00-00', 0, 'peter@peter.cz', 'One Hundred Years of Solitude', 1),
(10, 1, '0000-00-00', 0, 'admin@admin.cz', 'testbook', 12),
(11, 1, '0000-00-00', 0, 'nikdo@nikdo.cz', 'One Thousand and One Nights by', 2),
(12, 1, '0000-00-00', 0, 'admin@admin.cz', 'The Grapes of Wrath', 2);


DROP TABLE IF EXISTS `User`;
CREATE TABLE `User` (
  `ID` int NOT NULL,
  `Name` varchar(256) CHARACTER SET utf8 COLLATE utf8_czech_ci NOT NULL,
  `Surname` varchar(256) CHARACTER SET utf8 COLLATE utf8_czech_ci NOT NULL,
  `Password` varchar(32) CHARACTER SET utf8 COLLATE utf8_czech_ci NOT NULL,
  `Role` varchar(32) CHARACTER SET utf8 COLLATE utf8_czech_ci NOT NULL,
  `Email` varchar(64) CHARACTER SET utf8 COLLATE utf8_czech_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8_czech_ci;


INSERT INTO `User` (`ID`, `Name`, `Surname`, `Password`, `Role`, `Email`) VALUES
(25, 'admin', 'admin', '21232f297a57a5a743894a0e4a801fc3', 'admin', 'admin@admin.cz'),
(24, 'mlm', 'mlm', 'f59ec041772926a34e142c16940cac1b', 'čtenář', 'mlm@mlm.cz'),
(27, 'ctenar', 'ctenar', 'b23d5ae7ac107b7cba46a06348b44153', 'čtenář', 'ctenar@ctenar.cz'),
(28, 'peter', 'peter', '51dc30ddc473d43a6011e9ebba6ca770', 'čtenář', 'peter@peter.cz'),
(26, 'distributor', 'distributor', 'dd7bcee161192cb8fba765eb595eba87', 'distributor', 'distributor@distributor.cz'),
(22, 'knihovnik', 'knihovnik', 'a899e0fc96a95a2039eccb088cb08d45', 'knihovník', 'knihovnik@knihovnik.cz'),
(29, 'nikdo', 'nikdo', '1d921f130eb254bd43ccfb3a19053a2b', 'čtenář', 'nikdo@nikdo.cz'),
(32, 'awaw', 'awaw', '733b5e6a2e24f2764086325a28b6013d', 'čtenář', 'awaw@awaw'),
(31, 'hhhhh', 'hhhhhhhh', 'c1181aacf646b97f0a0a782db351a405', 'čtenář', 'hhhhh@hhhhh');


DROP TABLE IF EXISTS `Votes`;
CREATE TABLE `Votes` (
  `Email` varchar(256) COLLATE utf8_czech_ci NOT NULL,
  `Title` varchar(256) COLLATE utf8_czech_ci NOT NULL,
  `Library` varchar(256) COLLATE utf8_czech_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_czech_ci;


INSERT INTO `Votes` (`Email`, `Title`, `Library`) VALUES
('admin@admin.cz', 'Invisible Man', 'Moravská zemská knihovna');

ALTER TABLE `Book`
  ADD PRIMARY KEY (`ID`);

ALTER TABLE `Library`
  ADD PRIMARY KEY (`ID`);

ALTER TABLE `Order`
  ADD PRIMARY KEY (`ID`);

ALTER TABLE `Reservation`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `libid` (`Libid`);

ALTER TABLE `User`
  ADD PRIMARY KEY (`ID`);

ALTER TABLE `Book`
  MODIFY `ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

ALTER TABLE `Library`
  MODIFY `ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

ALTER TABLE `Order`
  MODIFY `ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

ALTER TABLE `Reservation`
  MODIFY `ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

ALTER TABLE `User`
  MODIFY `ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
COMMIT;