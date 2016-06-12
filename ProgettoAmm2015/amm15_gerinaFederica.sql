-- phpMyAdmin SQL Dump
-- version 4.4.13.1deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Creato il: Giu 06, 2016 alle 20:23
-- Versione del server: 5.6.27-0ubuntu1
-- Versione PHP: 5.6.11-1ubuntu3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `amm15_gerinaFederica`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `Corsi`
--

CREATE TABLE IF NOT EXISTS `Corsi` (
  `Codice` int(4) NOT NULL,
  `Nome` varchar(30) NOT NULL,
  `Descrizione` varchar(100) NOT NULL,
  `Durata` varchar(20) NOT NULL,
  `OrarioLezioni` varchar(50) NOT NULL,
  `NMax` bigint(3) NOT NULL,
  `Prezzo` varchar(20) NOT NULL,
  `idInsegnante` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `Corsi`
--

INSERT INTO `Corsi` (`Codice`, `Nome`, `Descrizione`, `Durata`, `OrarioLezioni`, `NMax`, `Prezzo`, `idInsegnante`) VALUES
(1, 'Basic Suomi', 'Corso Base di Lingua Finlandese (Suomi)', '3 Mesi', 'lun-mer-ven dalle 18:00 alle 20:00', 25, '150', 1),
(2, 'FIRST', 'Corso di inglese Livello Intermedio/Avanzato', '3 Mesi', 'mar-gio-sab dalle 10:00 alle 12:00', 20, '100,00 Euro', 2),
(3, 'Ichi', 'Corso Base di Giapponese', '3 Mesi', 'mar-gio dalle 9:00 alle 11:00', 10, '150,00 Euro', 3),
(4, 'Arab', 'Corso Base di Lingua Araba (fonetica, vocabolario e scrittura)', '5 Mesi', 'lun-mer-ven dalle 9:00 alle 11:00', 20, '200,00 Euro', 5),
(5, 'Advanced English', 'Corso Avanzato di Lingua Inglese (Certificazione FIRST richiesta)', '4 Mesi', 'lun-mar-mer dalle 11:00 alle 13:00', 25, '150,00 Euro', 4),
(6, 'Suomi - Reading/Writing', 'Corso di lettura e scrittura in lingua Finlandese', '1 Mese', 'lun-ven dalle 15:00 alle 16:00', 10, '100 Euro', 1);

-- --------------------------------------------------------

--
-- Struttura della tabella `Insegnanti`
--

CREATE TABLE IF NOT EXISTS `Insegnanti` (
  `id` int(4) NOT NULL,
  `Nome` varchar(20) NOT NULL,
  `Cognome` varchar(20) NOT NULL,
  `CodiceFiscale` varchar(20) NOT NULL,
  `DataNascita` date NOT NULL,
  `Email` varchar(30) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `Insegnanti`
--

INSERT INTO `Insegnanti` (`id`, `Nome`, `Cognome`, `CodiceFiscale`, `DataNascita`, `Email`, `username`, `password`) VALUES
(1, 'Alexi', 'Laiho', 'ALXLHO79D08R345O', '1979-04-08', 'alexi_bodom@gmail.com', 'tchr01', 'Progetto2015'),
(2, 'Jhon', 'Doe', 'JHNDOE75F16U678L', '1975-06-16', 'jhon.doe@tiscali.it', 'tchr02', 'Progetto2015'),
(3, 'Toshi', 'Usui', 'TSHUSU80O12Y789K', '1980-12-12', 'toshitoshi@live.com', 'tchr03', 'Progetto2015'),
(4, 'Jane', 'Smith', 'JNESMT78F15B325I', '1978-06-15', 'smith_jane@tiscali.it', 'tchr04', 'Progetto2015'),
(5, 'Mohamed', 'Hassam', 'MHMHSS75G14M647O', '1975-07-14', 'mohamed_hassam@gmail.com', 'tchr05', 'Progetto2015');

-- --------------------------------------------------------

--
-- Struttura della tabella `Iscrizioni`
--

CREATE TABLE IF NOT EXISTS `Iscrizioni` (
  `CodiceI` int(5) NOT NULL,
  `DataIscrizione` date NOT NULL,
  `idUtente` int(4) NOT NULL,
  `CodiceCorso` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `Iscrizioni`
--

INSERT INTO `Iscrizioni` (`CodiceI`, `DataIscrizione`, `idUtente`, `CodiceCorso`) VALUES
(100, '2016-05-20', 1000, 1),
(101, '2015-04-20', 1001, 2),
(103, '2016-05-10', 1002, 3),
(105, '2016-01-20', 1003, 4);

-- --------------------------------------------------------

--
-- Struttura della tabella `Utenti`
--

CREATE TABLE IF NOT EXISTS `Utenti` (
  `id` int(4) NOT NULL,
  `Nome` varchar(30) NOT NULL,
  `Cognome` varchar(30) NOT NULL,
  `DataNascita` date NOT NULL,
  `Email` varchar(30) NOT NULL,
  `Telefono` varchar(15) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `Utenti`
--

INSERT INTO `Utenti` (`id`, `Nome`, `Cognome`, `DataNascita`, `Email`, `Telefono`, `username`, `password`) VALUES
(1000, 'Federica', 'Gerina', '1994-11-25', 'fe.gerina@gmail.com', '0705064987', 'std01', 'Progetto2015'),
(1001, 'Cristina', 'Uccheddu', '1994-12-16', 'cri_ucche@gmail.com', '0704158639', 'std02', 'Progetto2015'),
(1002, 'Federico', 'Spiga', '1995-01-10', 'spiga_fede@gmail.com', '0704158963', 'std03', 'Progetto2015'),
(1003, 'Daniel', 'Piras', '1987-05-22', 'daniel_p@gmail.com', '0704856941', 'std04', 'Progetto2015');

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `Corsi`
--
ALTER TABLE `Corsi`
  ADD PRIMARY KEY (`Codice`);

--
-- Indici per le tabelle `Insegnanti`
--
ALTER TABLE `Insegnanti`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `Iscrizioni`
--
ALTER TABLE `Iscrizioni`
  ADD PRIMARY KEY (`CodiceI`);

--
-- Indici per le tabelle `Utenti`
--
ALTER TABLE `Utenti`
  ADD PRIMARY KEY (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
