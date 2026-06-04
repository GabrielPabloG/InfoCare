-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 22-Nov-2019 às 21:20
-- Versão do servidor: 10.1.31-MariaDB
-- PHP Version: 7.2.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bdinfocare`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `foto`
--

CREATE TABLE `foto` (
  `codFoto` int(11) NOT NULL,
  `nomeFoto` varchar(100) NOT NULL,
  `dataFoto` date NOT NULL,
  `codGerente` int(11) DEFAULT NULL,
  `codFuncionario` int(11) DEFAULT NULL,
  `codResponsavel` int(11) DEFAULT NULL,
  `codAdm` int(11) DEFAULT NULL,
  `codIdoso` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `foto`
--

INSERT INTO `foto` (`codFoto`, `nomeFoto`, `dataFoto`, `codGerente`, `codFuncionario`, `codResponsavel`, `codAdm`, `codIdoso`) VALUES
(1, 'd311c025c5d77ba14c7b41e0ddad398a.jpg', '2019-09-27', 10, NULL, NULL, NULL, 0),
(2, 'c8583ec1c7be0842db139bfa80829a04.jpg', '2019-10-02', NULL, 3, NULL, NULL, 0),
(4, '4183a3c0615e482d84c13d4080f819aa.png', '2019-10-02', NULL, 3, NULL, NULL, 0),
(5, '64346a05fbd8524a37395cfac718d981.png', '2019-10-02', 9, NULL, NULL, NULL, 0),
(6, '4c8a09885b811b92cca870204d3dce5b.png', '2019-10-02', 9, NULL, NULL, NULL, 0),
(7, '829e80aaaacc4a785b257195156ac10c.jpg', '2019-10-05', NULL, NULL, 31, NULL, 0),
(8, 'b85713d9ef3dca2f784d8bc988ca6653.jpg', '2019-10-07', NULL, NULL, 31, NULL, 0),
(9, '4b33b1057bc47fe3dfbdef616e1407a5.jpeg', '2019-10-26', NULL, 3, NULL, NULL, 0),
(10, '272b16e83b72e2c8d1cd46dc444b1953.png', '2019-10-26', NULL, 3, NULL, NULL, 0),
(11, '1661cd337d59cdba0c7928001b95be8e.png', '2019-10-26', NULL, 3, NULL, NULL, 0),
(12, 'e59ac7941abfffc1fe953eca46b5a530.png', '2019-10-26', NULL, 3, NULL, NULL, 0),
(13, '825eea857fa4f64b616f4c522cd668c3.png', '2019-10-27', NULL, NULL, NULL, 1, 0),
(14, '1e72e34fdad54e2e78235177f8978b9a.png', '2019-10-27', NULL, NULL, NULL, 1, 0),
(15, 'd0f1b2fec4ea68c4ee005270bf5b71d1.png', '2019-10-27', NULL, NULL, NULL, 1, 0),
(16, '09a2d7cefc3ff44444bd5369adb947c1.png', '2019-10-27', NULL, NULL, NULL, 1, 0),
(17, 'cd3b36fb6e6fbc7d9c4f8ec91a58da58.png', '2019-10-27', NULL, NULL, NULL, 1, 0),
(18, '44d392a9b04411caf32789db2831b932.png', '2019-10-30', NULL, 3, NULL, NULL, 0),
(19, 'fadb138d217ea2145e63fdedb6c7c2ba.jpg', '2019-10-30', NULL, 3, NULL, NULL, 0),
(20, '4870926b6f4840dabca6c5c857f012b3.jpg', '2019-11-02', NULL, 3, NULL, NULL, 0),
(21, '0fd84bdd28e7b5dbbe8d4c1d7f06d128.jpg', '2019-11-02', NULL, 3, NULL, NULL, 0),
(22, 'a0f5106032d7f5b1d4381adba4dcd4ef.jpg', '2019-11-02', NULL, 3, NULL, NULL, 0),
(23, '42ec59e4678a54247c0d77b98b79a5ca.png', '2019-11-02', NULL, NULL, NULL, 1, 0),
(24, 'a7c3e6590511d29757340ed32d980578.jpg', '2019-11-02', NULL, NULL, NULL, 1, 0),
(25, '0cc175b9c0f1b6a831c399e269772661', '2019-11-02', NULL, NULL, NULL, NULL, 46),
(26, 'f0e9a85a3c2f08ee92424e92de33a5e5.png', '2019-11-02', NULL, NULL, NULL, NULL, 51),
(27, 'd3946a9694dea89619b5ba6693ab5960.jpg', '2019-11-04', NULL, NULL, NULL, 15, NULL),
(28, 'ac53dca4edfd3560d8e9e11f0794215b.png', '2019-11-04', NULL, NULL, NULL, 15, NULL),
(29, '2db7f87380275eac2b28910de300b48f.jpg', '2019-11-04', NULL, NULL, 15, NULL, NULL),
(30, '33636f3c2c37e29aaa863673d3792845.png', '2019-11-15', NULL, NULL, NULL, NULL, 52),
(31, '33636f3c2c37e29aaa863673d3792845.png', '2019-11-15', NULL, NULL, NULL, NULL, 53),
(32, '3c4bb2f4ec9e0c9fe17640656e831229.png', '2019-11-15', NULL, NULL, NULL, NULL, 54),
(33, 'f89dced159908ef667790aec05ca221e.png', '2019-11-16', NULL, NULL, NULL, NULL, 1),
(34, '33636f3c2c37e29aaa863673d3792845.png', '2019-11-16', NULL, NULL, NULL, NULL, 1),
(35, 'b8fc331d0e30d6467cf6219b2337da08.png', '2019-11-18', NULL, NULL, NULL, NULL, 1),
(36, '4602533171232b5bb2f67baf330a9f33.jpg', '2019-11-19', NULL, NULL, NULL, NULL, 1),
(37, '4602533171232b5bb2f67baf330a9f33.jpg', '2019-11-19', NULL, NULL, NULL, NULL, 1),
(38, '4602533171232b5bb2f67baf330a9f33.jpg', '2019-11-19', NULL, NULL, NULL, NULL, 6),
(39, '21f4eec0a3bc13039bde472f338b09ce.jpg', '2019-11-19', NULL, NULL, NULL, NULL, 7),
(40, 'be1431bb728a0ba46d9d588055943f85.jpg', '2019-11-19', NULL, NULL, NULL, NULL, 8),
(41, 'be1431bb728a0ba46d9d588055943f85.jpg', '2019-11-19', NULL, NULL, NULL, NULL, 9),
(42, '42072fa7bd3ca1825d013f4e7bd8088c.png', '2019-11-22', NULL, NULL, NULL, NULL, 10),
(43, '42072fa7bd3ca1825d013f4e7bd8088c.png', '2019-11-22', NULL, NULL, NULL, NULL, 11),
(44, '42072fa7bd3ca1825d013f4e7bd8088c.png', '2019-11-22', NULL, NULL, NULL, NULL, 12),
(45, '42072fa7bd3ca1825d013f4e7bd8088c.png', '2019-11-22', NULL, NULL, NULL, NULL, 13),
(46, '42072fa7bd3ca1825d013f4e7bd8088c.png', '2019-11-22', NULL, NULL, NULL, NULL, 14),
(47, '42072fa7bd3ca1825d013f4e7bd8088c.png', '2019-11-22', NULL, NULL, NULL, NULL, 15),
(48, '760c7976118b42799bf2afe5bf0cf862.jpg', '2019-11-22', 9, NULL, NULL, NULL, NULL),
(49, '7d44a94b494b038532ffe94009ce4446.jpg', '2019-11-22', 9, NULL, NULL, NULL, NULL),
(50, '0e352075d7d93994c9b5244a0c75bd2d.jpg', '2019-11-22', NULL, NULL, NULL, NULL, 16),
(51, 'a6eb7f70d6033fab220197ccf5b80b8e.jpg', '2019-11-22', NULL, NULL, NULL, NULL, 17),
(52, 'a6eb7f70d6033fab220197ccf5b80b8e.jpg', '2019-11-22', NULL, NULL, NULL, NULL, 18),
(53, 'a6eb7f70d6033fab220197ccf5b80b8e.jpg', '2019-11-22', NULL, NULL, NULL, NULL, 19),
(54, 'a6eb7f70d6033fab220197ccf5b80b8e.jpg', '2019-11-22', NULL, NULL, NULL, NULL, 20),
(55, 'a6eb7f70d6033fab220197ccf5b80b8e.jpg', '2019-11-22', NULL, NULL, NULL, NULL, 21),
(56, '16daf3accbb10180b3db32fa5d4ba860.jpg', '2019-11-22', NULL, NULL, NULL, NULL, 22),
(57, '16daf3accbb10180b3db32fa5d4ba860.jpg', '2019-11-22', NULL, NULL, NULL, NULL, 23),
(58, '7fdc1a630c238af0815181f9faa190f5.jpg', '2019-11-22', NULL, NULL, NULL, NULL, 24);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbadm`
--

CREATE TABLE `tbadm` (
  `codAdm` int(11) NOT NULL,
  `emailAdm` varchar(100) NOT NULL,
  `senhaAdm` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tbadm`
--

INSERT INTO `tbadm` (`codAdm`, `emailAdm`, `senhaAdm`) VALUES
(1, 'adm@adm', 'adm');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbalimentacao`
--

CREATE TABLE `tbalimentacao` (
  `codAlimentacao` int(11) NOT NULL,
  `alimentacaoSolo` varchar(25) DEFAULT NULL,
  `dificuldadeDegluticao` varchar(25) DEFAULT NULL,
  `usoSonda` varchar(25) DEFAULT NULL,
  `restricaoAlimento` varchar(50) DEFAULT NULL,
  `preferenciaAlimento` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tbalimentacao`
--

INSERT INTO `tbalimentacao` (`codAlimentacao`, `alimentacaoSolo`, `dificuldadeDegluticao`, `usoSonda`, `restricaoAlimento`, `preferenciaAlimento`) VALUES
(1, 'a', 'a', 'a', 'a', '0'),
(2, 'a', 'a', 'aa', 'a', '0'),
(3, 'b', 'b', 'b', 'b', '0'),
(4, 'c', 'c', 'c', 'c', '0'),
(5, 'c', 'c', 'c', 'c', '0'),
(6, 'c', 'c', 'c', 'c', '0'),
(7, 'c', 'c', 'c', 'c', '0'),
(8, 'c', 'c', 'c', 'c', '0'),
(9, 'c', 'c', 'c', 'c', '0'),
(10, 'c', 'c', 'c', 'c', '0'),
(11, 'z', 'z', 'z', 'z', '0'),
(12, 'z', 'z', 'z', 'z', '0'),
(13, 'z', 'z', 'z', 'z', '0'),
(14, 'z', 'z', 'z', 'z', '0'),
(15, 'a', 'a', 'a', 'a', '0'),
(16, 'n', 'n', 'n', 'n', '0'),
(17, 'a', 'a', 'a', 'a', '0'),
(18, 'a', 'a', 'a', 'a', '0'),
(19, 'a', 'a', 'a', 'a', '0'),
(20, 'a', 'a', 'a', 'a', '0'),
(21, 'a', 'a', 'a', 'a', '0'),
(22, 'a', 'a', 'a', 'a', '0'),
(23, 'a', 'a', 'a', 'a', '0'),
(24, 'a', 'a', 'a', 'a', '0'),
(25, 'a', 'a', 'a', 'a', '0'),
(26, 'a', 'a', 'a', 'a', '0'),
(27, 'a', 'a', 'aa', 'a', '0'),
(28, 'a', 'a', 'a', 'a', '0'),
(29, 'a', 'a', 'a', 'a', '0'),
(30, 'a', 'a', 'a', 'a', '0'),
(31, 'a', 'a', 'a', 'a', '0'),
(32, 'a', 'a', 'a', 'a', 'a'),
(33, 'a', 'a', 'a', 'a', 'a'),
(34, 'a', 'a', 'a', 'a', 'a'),
(35, 'a', 'a', 'a', 'a', 'a'),
(36, '', '', '', '', ''),
(37, 'Sim', 'Sim', 'Sim', 'Sim', 'Sim'),
(38, 'Sim', 'Sim', 'Sim', 'Sim', 'Sim'),
(39, 'Sim', 'Sim', 'Sim', 'Sim', 'Sim'),
(40, 'Sim', 'Sim', 'Sim', 'Sim', 'Sim'),
(41, 'Sim', 'Sim', 'Sim', 'Sim', 'Sim'),
(42, 'Sim', 'Sim', 'Sim', 'Sim', 'Sim'),
(43, 'Sim', 'Sim', 'Sim', 'Sim', 'Sim'),
(44, 'Não', 'Não', 'Não', 'Não', 'Não'),
(45, 'Não', 'Não', 'Não', 'Não', 'Não'),
(46, 'Não', 'Não', 'Não', 'Não', 'Não'),
(47, 'Não', 'Não', 'Não', 'Não', 'Não'),
(48, 'Não', 'Não', 'Não', 'Não', 'Não'),
(49, 'Não', 'Não', 'Não', 'Não', 'Não'),
(50, 'Não', 'Não', 'Não', 'Não', 'Não'),
(51, 'Não', 'Não', 'Não', 'Não', 'Não'),
(52, 'Não', 'Não', 'Não', 'Não', 'Não'),
(53, 'Não', 'Não', 'Não', 'Não', 'Não'),
(54, 'Não', 'Não', 'Não', 'Não', 'Não'),
(55, 'Não', 'Não', 'Não', 'Não', 'Não'),
(56, 'Não', 'Não', 'Não', 'Não', 'Não'),
(57, 'Não', 'Não', 'Não', 'Não', 'Não'),
(58, 'Não', 'Não', 'Não', 'Não', 'Não');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbantecedencia`
--

CREATE TABLE `tbantecedencia` (
  `codAntecedencia` int(11) NOT NULL,
  `declinioCongnitivo` varchar(50) DEFAULT NULL,
  `dificuldadeFala` varchar(50) DEFAULT NULL,
  `audicao` varchar(50) DEFAULT NULL,
  `acidenteVascularEncefalico` varchar(50) DEFAULT NULL,
  `traumatismoCranioEncefalico` varchar(50) DEFAULT NULL,
  `hipertensaoArterial` varchar(50) DEFAULT NULL,
  `hipotireoidismo` varchar(50) DEFAULT NULL,
  `tipoDiabetes` varchar(50) DEFAULT NULL,
  `tipoCancer` varchar(50) DEFAULT NULL,
  `localFratura` varchar(50) DEFAULT NULL,
  `tipoCirurgia` varchar(50) DEFAULT NULL,
  `outrasPatologias` varchar(50) DEFAULT NULL,
  `usoMedicamento` varchar(5) NOT NULL,
  `tratamentoRealizado` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tbantecedencia`
--

INSERT INTO `tbantecedencia` (`codAntecedencia`, `declinioCongnitivo`, `dificuldadeFala`, `audicao`, `acidenteVascularEncefalico`, `traumatismoCranioEncefalico`, `hipertensaoArterial`, `hipotireoidismo`, `tipoDiabetes`, `tipoCancer`, `localFratura`, `tipoCirurgia`, `outrasPatologias`, `usoMedicamento`, `tratamentoRealizado`) VALUES
(6, 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a'),
(7, 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a'),
(8, 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a'),
(9, 'b', 'b', 'b', 'b', 'b', 'b', 'b', 'b', 'b', 'b', 'b', 'b', 'bb', 'b'),
(10, 'c', 'cc', 'c', 'c', 'c', 'c', 'c', 'c', 'c', 'c', 'c', 'c', 'c', 'c'),
(11, 'c', 'cc', 'c', 'c', 'c', 'c', 'c', 'c', 'c', 'c', 'c', 'c', 'c', 'c'),
(12, 'c', 'cc', 'c', 'c', 'c', 'c', 'c', 'c', 'c', 'c', 'c', 'c', 'c', 'c'),
(13, 'c', 'cc', 'c', 'c', 'c', 'c', 'c', 'c', 'c', 'c', 'c', 'c', 'c', 'c'),
(14, 'c', 'cc', 'c', 'c', 'c', 'c', 'c', 'c', 'c', 'c', 'c', 'c', 'c', 'c'),
(15, 'cC', 'c', 'c', 'c', 'c', 'c', 'c', 'c', 'c', 'c', 'c', 'c', 'c', 'c'),
(16, 'cC', 'c', 'c', 'c', 'c', 'c', 'c', 'c', 'c', 'c', 'c', 'c', 'c', 'c'),
(17, 'z', 'z', 'z', 'z', 'z', 'z', 'z', 'z', 'z', 'z', 'z', 'z', 'z', 'z'),
(18, 'z', 'z', 'z', 'z', 'z', 'z', 'z', 'z', 'z', 'z', 'z', 'z', 'z', 'z'),
(19, 'z', 'z', 'z', 'z', 'z', 'z', 'z', 'z', 'z', 'z', 'z', 'z', 'z', 'z'),
(20, 'z', 'z', 'z', 'z', 'z', 'z', 'z', 'z', 'z', 'z', 'z', 'z', 'z', 'z'),
(21, 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a'),
(22, 'n', 'n', 'n', 'n', 'n', 'n', 'n', 'nn', 'n', 'n', 'n', 'n', 'n', 'n'),
(23, 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a'),
(24, 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'Sim', 'a'),
(25, 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'Sim', 'a'),
(26, 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'Sim', 'a'),
(27, 's', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'Sim', 'a'),
(28, 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'Sim', 'a'),
(29, 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a'),
(30, 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a'),
(31, 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a'),
(32, 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a'),
(33, 'a', 'a', 'a', 'a', 'a', 'a', 'aa', 'a', 'a', 'a', 'a', 'a', 'aa', 'a'),
(34, 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a'),
(35, 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a'),
(36, 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a'),
(37, 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a'),
(38, 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a'),
(39, 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a'),
(40, 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a'),
(41, 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a'),
(42, '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(43, 'Sim', 'Sim', 'Sem aparelho', 'Sim', 'Sim', 'Sim', 'Sim', 'Nenhum', 'Nenhum', '', 'Nenhuma', '', 'Sim', 'Sim'),
(44, 'Sim', 'Sim', 'Sem aparelho', 'Sim', 'Sim', 'Sim', 'Sim', 'Nenhum', 'Nenhum', '', 'Nenhuma', '', 'Sim', 'Sim'),
(45, 'Sim', 'Sim', 'Sem aparelho', 'Sim', 'Sim', 'Sim', 'Sim', 'Nenhum', 'Nenhum', '', 'Nenhuma', '', 'Sim', 'Sim'),
(46, 'Sim', 'Sim', 'Sem aparelho', 'Sim', 'Sim', 'Sim', 'Sim', 'Nenhum', 'Nenhum', '', 'Nenhuma', '', 'Sim', 'Sim'),
(47, 'Sim', 'Sim', 'Sem aparelho', 'Sim', 'Sim', 'Sim', 'Sim', 'Nenhum', 'Nenhum', '', 'Nenhuma', '', 'Sim', 'Sim'),
(48, 'Sim', 'Sim', 'Sem aparelho', 'Sim', 'Sim', 'Sim', 'Sim', 'Nenhum', 'Nenhum', '', 'Nenhuma', '', 'Sim', 'Sim'),
(49, 'Sim', 'Sim', 'Sem aparelho', 'Sim', 'Sim', 'Sim', 'Sim', 'Nenhum', 'Nenhum', '', 'Nenhuma', '', 'Sim', 'Sim'),
(50, 'Não', 'Não', 'Sem Aparelho', 'Não', 'Não', 'Não', 'Não', 'Nenhum', 'Nenhum', '', 'Nenhuma', '', 'Sim', 'Não'),
(51, 'Não', 'Não', 'Sem Aparelho', 'Não', 'Não', 'Não', 'Não', 'Nenhum', 'Nenhum', '', 'Nenhuma', '', 'Não', 'Não'),
(52, 'Não', 'Não', 'Sem Aparelho', 'Não', 'Não', 'Não', 'Não', 'Nenhum', 'Nenhum', '', 'Nenhuma', '', 'Não', 'Não'),
(53, 'Não', 'Não', 'Sem Aparelho', 'Não', 'Não', 'Não', 'Não', 'Nenhum', 'Nenhum', '', 'Nenhuma', '', 'Não', 'Não'),
(54, 'Não', 'Não', 'Sem Aparelho', 'Não', 'Não', 'Não', 'Não', 'Nenhum', 'Nenhum', '', 'Nenhuma', '', 'Não', 'Não'),
(55, 'Não', 'Não', 'Sem Aparelho', 'Não', 'Não', 'Não', 'Não', 'Nenhum', 'Nenhum', '', 'Nenhuma', '', 'Não', 'Não'),
(56, 'Não', 'Não', 'Sem Aparelho', 'Não', 'Não', 'Não', 'Não', 'Nenhum', 'Nenhum', '', 'Nenhuma', '', 'Não', 'Não'),
(57, 'Não', 'Não', 'Sem Aparelho', 'Não', 'Não', 'Não', 'Não', 'Nenhum', 'Nenhum', '', 'Nenhuma', '', 'Sim', 'Sim'),
(58, 'Não', 'Não', 'Sem Aparelho', 'Não', 'Não', 'Não', 'Não', 'Nenhum', 'Nenhum', '', 'Nenhuma', '', 'Sim', 'Não'),
(59, 'Não', 'Não', 'Sem Aparelho', 'Não', 'Não', 'Não', 'Não', 'Nenhum', 'Nenhum', '', 'Nenhuma', '', 'Sim', 'Não'),
(60, 'Não', 'Não', 'Sem Aparelho', 'Não', 'Não', 'Não', 'Não', 'Nenhum', 'Nenhum', '', 'Nenhuma', '', 'Sim', 'Não'),
(61, 'Não', 'Não', 'Sem Aparelho', 'Não', 'Não', 'Não', 'Não', 'Nenhum', 'Nenhum', '', 'Nenhuma', '', 'Sim', 'Não'),
(62, 'Não', 'Não', 'Sem Aparelho', 'Não', 'Não', 'Não', 'Não', 'Nenhum', 'Nenhum', '', 'Nenhuma', '', 'Sim', 'Sim'),
(63, 'Não', 'Não', 'Sem Aparelho', 'Não', 'Não', 'Não', 'Não', 'Nenhum', 'Nenhum', '', 'Nenhuma', '', 'Sim', 'Sim'),
(64, 'Não', 'Não', 'Sem Aparelho', 'Não', 'Não', 'Não', 'Não', 'Nenhum', 'Nenhum', '', 'Nenhuma', '', 'Não', 'Não');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbcelularfuncionario`
--

CREATE TABLE `tbcelularfuncionario` (
  `codCelularFuncionario` int(11) NOT NULL,
  `numeroCelularFuncionario` varchar(25) DEFAULT NULL,
  `codFuncionario` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbcelulargerente`
--

CREATE TABLE `tbcelulargerente` (
  `codCelularGerente` int(11) NOT NULL,
  `numeroCelularGerente` int(25) DEFAULT NULL,
  `codGerente` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbcelularresponsavel`
--

CREATE TABLE `tbcelularresponsavel` (
  `codCelularResponsavel` int(11) NOT NULL,
  `numeroCelularResponsavel` varchar(25) DEFAULT NULL,
  `codResponsavel` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbdiagnosticoenfermagem`
--

CREATE TABLE `tbdiagnosticoenfermagem` (
  `codDiagnosticoEnfermagem` int(11) NOT NULL,
  `diagnosticoEnfermagem` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbeliminacao`
--

CREATE TABLE `tbeliminacao` (
  `codEliminacao` int(11) NOT NULL,
  `frequenciaEvacuacao` varchar(25) NOT NULL,
  `aspecto` varchar(50) DEFAULT NULL,
  `coloracaoUrina` varchar(25) DEFAULT NULL,
  `odorUrina` varchar(25) DEFAULT NULL,
  `frequenciaUrina` varchar(25) DEFAULT NULL,
  `queixaGases` varchar(25) DEFAULT NULL,
  `usoFraldaGeriatrica` varchar(25) DEFAULT NULL,
  `marcaFraldaGeriatrica` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tbeliminacao`
--

INSERT INTO `tbeliminacao` (`codEliminacao`, `frequenciaEvacuacao`, `aspecto`, `coloracaoUrina`, `odorUrina`, `frequenciaUrina`, `queixaGases`, `usoFraldaGeriatrica`, `marcaFraldaGeriatrica`) VALUES
(1, 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a'),
(2, 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a'),
(3, 'b', 'b', 'b', 'b', 'b', 'b', 'b', 'b'),
(4, 'c', 'c', 'c', 'c', 'cc', 'c', 'c', 'c'),
(5, 'c', 'c', 'c', 'c', 'cc', 'c', 'c', 'c'),
(6, 'c', 'c', 'c', 'c', 'cc', 'c', 'c', 'c'),
(7, 'c', 'c', 'c', 'c', 'cc', 'c', 'c', 'c'),
(8, 'c', 'c', 'c', 'c', 'cc', 'c', 'c', 'c'),
(9, 'c', 'c', 'c', 'c', 'c', 'c', 'c', 'c'),
(10, 'c', 'c', 'c', 'c', 'c', 'c', 'c', 'c'),
(11, 'z', 'z', 'z', 'z', 'z', 'z', 'z', 'zz'),
(12, 'z', 'z', 'z', 'z', 'z', 'z', 'z', 'zz'),
(13, 'z', 'z', 'z', 'z', 'z', 'z', 'z', 'zz'),
(14, 'z', 'z', 'z', 'z', 'z', 'z', 'z', 'zz'),
(15, 'z', 'z', 'z', 'z', 'z', 'z', 'z', 'zz'),
(16, 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a'),
(17, 'n', 'n', 'nn', 'n', 'n', 'n', 'n', 'n'),
(18, 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a'),
(19, 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a'),
(20, 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a'),
(21, 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'aa'),
(22, 'aa', 'a', 'a', 'a', 'a', 'aa', 'a', 'a'),
(23, 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a'),
(24, 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a'),
(25, 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a'),
(26, 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a'),
(27, 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a'),
(28, 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a'),
(29, 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a'),
(30, 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a'),
(31, 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a'),
(32, 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a'),
(33, 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a'),
(34, 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a'),
(35, 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a'),
(36, 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a'),
(37, '', '', '', '', '', '', '', ''),
(38, 'Pouco', 'Tipo 1', '', 'Sim', 'Sim', 'Sim', 'Sim', ''),
(39, 'Pouco', 'Tipo 1', '', 'Sim', 'Sim', 'Sim', 'Sim', ''),
(40, 'Pouco', 'Tipo 1', '', 'Sim', 'Sim', 'Sim', 'Sim', ''),
(41, 'Pouco', 'Tipo 1', '', 'Sim', 'Sim', 'Sim', 'Sim', ''),
(42, 'Pouco', 'Tipo 1', '', 'Sim', 'Sim', 'Sim', 'Sim', ''),
(43, 'Pouco', 'Tipo 1', '', 'Sim', 'Sim', 'Sim', 'Sim', ''),
(44, 'Pouco', 'Tipo 1', '', 'Sim', 'Sim', 'Sim', 'Sim', ''),
(45, 'Pouco', 'Tipo 1', '', 'Não', 'Sim', 'Não', 'Não', ''),
(46, 'Pouco', 'Tipo 1', '', 'Não', 'Sim', 'Não', 'Não', ''),
(47, 'Pouco', 'Tipo 1', '', 'Não', 'Sim', 'Não', 'Não', ''),
(48, 'Pouco', 'Tipo 1', '', 'Não', 'Sim', 'Não', 'Não', ''),
(49, 'Pouco', 'Tipo 1', '', 'Não', 'Sim', 'Não', 'Não', ''),
(50, 'Pouco', 'Tipo 1', '', 'Não', 'Sim', 'Não', 'Não', ''),
(51, 'Pouco', 'Tipo 1', '', 'Não', 'Sim', 'Não', 'Não', ''),
(52, 'Pouco', 'Tipo 1', '', 'Não', 'Sim', 'Não', 'Não', ''),
(53, 'Pouco', 'Tipo 1', '', 'Não', 'Sim', 'Não', 'Não', ''),
(54, 'Pouco', 'Tipo 1', '', 'Não', 'Sim', 'Não', 'Não', ''),
(55, 'Pouco', 'Tipo 1', '', 'Não', 'Sim', 'Não', 'Não', ''),
(56, 'Pouco', 'Tipo 1', '', 'Não', 'Sim', 'Não', 'Não', ''),
(57, 'Pouco', 'Tipo 1', '', 'Não', 'Sim', 'Não', 'Não', ''),
(58, 'Pouco', 'Tipo 1', '', 'Não', 'Sim', 'Não', 'Não', ''),
(59, 'Pouco', 'Tipo 1', '', 'Não', 'Sim', 'Não', 'Não', '');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbenderecofuncionario`
--

CREATE TABLE `tbenderecofuncionario` (
  `codEnderecoFuncionario` int(11) NOT NULL,
  `ruaEnderecoFuncionario` varchar(100) NOT NULL,
  `bairroEnderecoFuncionario` varchar(100) NOT NULL,
  `cepEnderecoFuncionario` varchar(9) NOT NULL,
  `numCasaFuncionario` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tbenderecofuncionario`
--

INSERT INTO `tbenderecofuncionario` (`codEnderecoFuncionario`, `ruaEnderecoFuncionario`, `bairroEnderecoFuncionario`, `cepEnderecoFuncionario`, `numCasaFuncionario`) VALUES
(1, '1', '1', '11', '1'),
(2, '1', '1', '1', '2'),
(3, 'Rua Ametista', 'Conjunto Habitacional Cristal', '86182-726', '123'),
(4, 'Rua Ametista', 'Conjunto Habitacional Cristal', '86182-726', '123'),
(5, 'Rua Antônio Rumph', 'Salto do Norte', '89065-525', '333'),
(6, 'Rua G', 'Mário Andreazza', '76913-031', '450'),
(7, 'Rua São Lucas', 'Glória', '69911-132', '699');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbenderecogerente`
--

CREATE TABLE `tbenderecogerente` (
  `codEnderecoGerente` int(11) NOT NULL,
  `ruaEnderecoGerente` varchar(100) NOT NULL,
  `bairroEnderecoGerente` varchar(100) NOT NULL,
  `cepEnderecoGerente` varchar(9) NOT NULL,
  `numCasaEnderecoGerente` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tbenderecogerente`
--

INSERT INTO `tbenderecogerente` (`codEnderecoGerente`, `ruaEnderecoGerente`, `bairroEnderecoGerente`, `cepEnderecoGerente`, `numCasaEnderecoGerente`) VALUES
(1, '3', '4', '5', '6'),
(2, '1', '1', '1', '1'),
(3, '1', '1', '1', '1'),
(4, 'Rua Ametista', 'Conjunto Habitacional Cristal', '86182-726', '123'),
(5, '1', '1', '1', '1'),
(6, '123', '123', '123', '123'),
(7, '11', '1', '1', '1'),
(8, '123', '123', '1', '1'),
(9, '123', '123', '1', '1'),
(10, '123', '123', '1', '1'),
(11, '123', '123', '1', '1'),
(12, '123', '123', '1', '1'),
(13, '123', '123', '1', '1'),
(14, '1', '1', '1', '1'),
(15, 'Rua', 'qq', 'cc', '11'),
(16, '1', '1', '1', '1'),
(17, 'Avenida Goiás', 'Setor União I', '77405-170', '241'),
(18, 'Avenida Goiás', 'Setor União I', '77405-170', '241'),
(19, 'Avenida Goiás', 'Setor União I', '77405-170', '241'),
(20, 'Avenida Goiás', 'Setor União I', '77405-170', '241'),
(21, 'Avenida Goiás', 'Setor União I', '77405-170', '241'),
(22, 'Avenida Goiás', 'Setor União I', '77405-170', '241'),
(23, 'Avenida Goiás', 'Setor União I', '77405-170', '241'),
(24, 'Avenida Goiás', 'Setor União I', '77405-170', '241'),
(25, 'Rua Luís Pereira Lopes', 'Jardim Centenário', '08430-370', '251'),
(26, 'Rua São Gabriel', 'Centro', '93260-260', '655'),
(27, 'Rua Manoel Cesário', 'Capoeira', '69905-006', '774');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbenderecoresponsavel`
--

CREATE TABLE `tbenderecoresponsavel` (
  `codEnderecoResponsavel` int(11) NOT NULL,
  `ruaEnderecoResponsavel` varchar(100) NOT NULL,
  `bairroEnderecoResponsavel` varchar(100) NOT NULL,
  `cepEnderecoResponsavel` varchar(9) NOT NULL,
  `numCasaEnderecoResponsavel` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tbenderecoresponsavel`
--

INSERT INTO `tbenderecoresponsavel` (`codEnderecoResponsavel`, `ruaEnderecoResponsavel`, `bairroEnderecoResponsavel`, `cepEnderecoResponsavel`, `numCasaEnderecoResponsavel`) VALUES
(56, '123', '123', '123', 123),
(57, '123', '123', '123', 123),
(58, '123', '123', '123', 123),
(59, '123', '123', '123', 123),
(60, '123', '123', '123', 123),
(61, '123', '123', '123', 123),
(62, '123', '123', '123', 123),
(63, '123', '123', '123', 123),
(64, '123', '123', '123', 123),
(65, '123', '123', '123', 123),
(66, '123', '123', '123', 123),
(67, '123', '123', '123', 123),
(68, '123', '123', '123', 123),
(69, '123', '123', '123', 123),
(70, '123', '123', '123', 123),
(71, '123', '123', '123', 123),
(72, '123', '123', '123', 123),
(73, '123', '123', '123', 123),
(74, '123', '123', '123', 123),
(75, '123', '123', '123', 123),
(76, '123', '123', '123', 123),
(77, '123', '123', '123', 123),
(78, '123', '123', '123', 123),
(79, '123', '123', '123', 123),
(80, '123', '123', '123', 123),
(81, '123', '123', '123', 123),
(82, '123', '123', '123', 123),
(83, '123', '123', '123', 123),
(84, '123', '123', '123', 123),
(85, '123', '123', '123', 123),
(86, '123', '123', '123', 123),
(87, '123', '123', '123', 123),
(88, '123', '123', '123', 123),
(89, '123', '123', '123', 123),
(90, '123', '123', '123', 123),
(91, '123', '123', '123', 123),
(92, '123', '123', '123', 123),
(93, '123', '123', '123', 123),
(94, '123', '123', '123', 123),
(95, '123', '123', '123', 123),
(96, '123', '123', '123', 123),
(97, '123', '123', '123', 123),
(98, '123', '123', '123', 123),
(99, '123', '123', '123', 123),
(100, '123', '123', '123', 123),
(101, '123', '123', '123', 123),
(102, '123', '123', '123', 123),
(103, '123', '123', '1231', 1232),
(104, '123', '123', '21312', 321),
(105, 'Fds', 'Ds', 'ASD', 201),
(106, '123', '213', '21312', 12312),
(107, '123', '123', '123', 123),
(108, '123', '123', '123', 123),
(109, '1', '1', '1', 1),
(110, '1', '1', '1', 1),
(111, '12', '12', '11', 1),
(112, '1', '11', '1', 1),
(113, '1', '1', '1', 1),
(114, '1', '1', '1', 1),
(115, '1', '1', '1', 1),
(116, '1', '1', '1', 1),
(117, '1', '1', '1', 1),
(118, '1', '1', '1', 1),
(119, '1', '1', '1', 1),
(120, '1', '1', '1', 1),
(121, '1', '1', '1', 1),
(122, '1', '1', '1', 1),
(123, '1', '1', '1', 1),
(124, '1', '1', '1', 1),
(125, '1', '1', '1', 1),
(126, '1', '1', '1', 1),
(127, '1', '1', '1', 1),
(128, '1', '1', '1', 1),
(129, '1', '1', '1', 1),
(130, '1', '1', '1', 1),
(131, '1', '1', '1', 1),
(132, '1', '1', '1', 1),
(133, '1', '1', '1', 1),
(134, '1', '1', '1', 1),
(135, '1', '1', '1', 1),
(136, '1', '1', '1', 1),
(137, '1', '1', '1', 1),
(138, '1', '1', '1', 1),
(139, '1', '1', '1', 1),
(140, '1', '1', '1', 1),
(141, '1', '1', '1', 1),
(142, '1', '1', '1', 1),
(143, '1', '1', '1', 1),
(144, '1', '1', '1', 1),
(145, '1', '1', '1', 1),
(146, '1', '1', '1', 1),
(147, '1', '1', '1', 1),
(148, '1', '1', '1', 1),
(149, '1', '1', '1', 1),
(150, '1', '1', '1', 1),
(151, '1', '1', '1', 1),
(152, '1', '1', '1', 1),
(153, '1', '1', '1', 1),
(154, '1', '1', '1', 1),
(155, '1', '1', '1', 1),
(156, '1', '1', '1', 1),
(157, '1', '1', '1', 1),
(158, '1', '1', '1', 1),
(159, '1', '1', '1', 1),
(160, '1', '1', '1', 1),
(161, '1', '1', '1', 1),
(162, '1', '1', '1', 1),
(163, '1', '1', '1', 1),
(164, '1', '1', '1', 1),
(165, '1', '1', '1', 1),
(166, '1', '1', '1', 1),
(167, '1', '1', '1', 1),
(168, '1', '1', '1', 1),
(169, '1', '1', '1', 1),
(170, '1', '1', '1', 1),
(171, '1', '1', '1', 1),
(172, '1', '1', '1', 1),
(173, '1', '1', '1', 1),
(174, '1', '1', '1', 1),
(175, '1', '1', '1', 1),
(176, '1', '1', '1', 1),
(177, '1', '1', '1', 1),
(178, '1', '1', '1', 1),
(179, 'Rua Acapuana', 'Centro da Serra', '29179-246', 221),
(180, 'Rua Ametista', 'Conjunto Habitacional Cristal', '86182-726', 121),
(181, 'Avenida Goiás', 'Setor União I', '77405-170', 233),
(182, 'Avenida Goiás', 'Setor União I', '77405-170', 44),
(183, 'Avenida Goiás', 'Setor União I', '77405-170', 45),
(184, 'Rua Ametista', 'Conjunto Habitacional Cristal', '86182-726', 55),
(185, 'Rua Ametista', 'Conjunto Habitacional Cristal', '86182-726', 222),
(186, 'Rua Ametista', 'Conjunto Habitacional Cristal', '86182-726', 12),
(187, 'Rua Ametista', 'Conjunto Habitacional Cristal', '86182-726', 111),
(188, 'Rua Ametista', 'Conjunto Habitacional Cristal', '86182-726', 2),
(189, 'Rua Ametista', 'Conjunto Habitacional Cristal', '86182-726', 2),
(190, 'Rua Ametista', 'Conjunto Habitacional Cristal', '86182-726', 1),
(191, 'Rua Ametista', 'Conjunto Habitacional Cristal', '86182-726', 1),
(192, 'Rua Ametista', 'Conjunto Habitacional Cristal', '86182-726', 2),
(193, 'Avenida Goiás', 'Setor União I', '77405-170', 3),
(194, 'Rua Ametista', 'Conjunto Habitacional Cristal', '86182-726', 3),
(195, 'Avenida Goiás', 'Setor União I', '77405-170', 5),
(196, 'Rua Ametista', 'Conjunto Habitacional Cristal', '86182-726', 33),
(197, 'Rua N2', 'Conjunto Tucumã', '69919-817', 957),
(198, 'QN 402 Conjunto IComércio', 'Samambaia Norte (Samambaia)', '72318-509', 885),
(199, 'Rua Oniva de Moura Brizola', 'Jardim Itu', '91220-060', 986),
(200, 'Rua Terra Nova', 'Boa Vista', '55038-470', 811),
(201, 'Travessa Constancia Leão Tomaz', 'Muruci (Fazendinha)', '68911-411', 339),
(202, 'Rua JT-15', 'Jardim Tropical', '69314-608', 511),
(203, 'Rua JT-15', 'Jardim Tropical', '69314-608', 511),
(204, 'Rua Parangato', 'Jardim Santana', '76828-672', 367),
(205, 'Rua Parreiras', 'Pontal da Ilha', '65057-682', 892),
(206, 'Rua Flausina de Oliveira Rosa', 'Caiçara', '11706-130', 121),
(207, 'Rua Zito Soares', 'Jardinópolis', '30532-260', 447),
(208, 'Avenida Doutor Alessandro Nottegar', 'Nova Jesusalém', '63906-040', 667),
(209, 'Rua Cento e Oito', 'Arroio da Manteiga', '93140-318', 379),
(210, 'Rua São Domingos', 'Vila Maranhão', '65091-300', 102),
(211, 'Rua Clara Costa', 'Centro', '25520-400', 187),
(212, 'Rua Patriota', 'Jardim Calixto', '75134-654', 445);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbexame`
--

CREATE TABLE `tbexame` (
  `codExame` int(11) NOT NULL,
  `conclusaoHemograma` varchar(50) DEFAULT NULL,
  `tipoUrina` varchar(25) DEFAULT NULL,
  `parasitologicoFezes` varchar(50) DEFAULT NULL,
  `glicemiaJejum` varchar(50) DEFAULT NULL,
  `colesterol` varchar(50) DEFAULT NULL,
  `tipoHepatite` varchar(25) DEFAULT NULL,
  `hiv` varchar(50) DEFAULT NULL,
  `vdrl` varchar(50) DEFAULT NULL,
  `atestadoNeurologico` varchar(50) DEFAULT NULL,
  `raioxPulmao` varchar(50) DEFAULT NULL,
  `receituarioMedico` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tbexame`
--

INSERT INTO `tbexame` (`codExame`, `conclusaoHemograma`, `tipoUrina`, `parasitologicoFezes`, `glicemiaJejum`, `colesterol`, `tipoHepatite`, `hiv`, `vdrl`, `atestadoNeurologico`, `raioxPulmao`, `receituarioMedico`) VALUES
(1, 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a'),
(2, 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a'),
(3, 'b', 'b', 'b', 'b', 'b', 'b', 'b', 'b', 'b', 'b', 'b'),
(4, 'c', 'cc', 'c', 'c', 'c', 'cc', 'c', 'c', 'c', 'c', 'c'),
(5, 'c', 'cc', 'c', 'c', 'c', 'cc', 'c', 'c', 'c', 'c', 'c'),
(6, 'c', 'cc', 'c', 'c', 'c', 'cc', 'c', 'c', 'c', 'c', 'c'),
(7, 'c', 'cc', 'c', 'c', 'c', 'cc', 'c', 'c', 'c', 'c', 'c'),
(8, 'c', 'cc', 'c', 'c', 'c', 'cc', 'c', 'c', 'c', 'c', 'c'),
(9, 'c', 'c', 'c', 'c', 'c', 'c', 'c', 'c', 'c', 'c', 'c'),
(10, 'c', 'c', 'c', 'c', 'c', 'c', 'c', 'c', 'c', 'c', 'c'),
(11, 'z', 'z', 'z', 'z', 'z', 'z', 'z', 'z', 'z', 'z', 'z'),
(12, 'z', 'z', 'z', 'z', 'z', 'z', 'z', 'z', 'z', 'z', 'z'),
(13, 'z', 'z', 'z', 'z', 'z', 'z', 'z', 'z', 'z', 'z', 'z'),
(14, 'z', 'z', 'z', 'z', 'z', 'z', 'z', 'z', 'z', 'z', 'z'),
(15, 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a'),
(16, 'n', 'n', 'n', 'n', 'n', 'n', 'n', 'n', 'n', 'n', 'nn'),
(17, 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a'),
(18, 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a'),
(19, 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a'),
(20, 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a'),
(21, 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a'),
(22, 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a'),
(23, 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a'),
(24, 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a'),
(25, 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a'),
(26, 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a'),
(27, 'a', 'a', 'aa', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a'),
(28, 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a'),
(29, 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a'),
(30, 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a'),
(31, 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a'),
(32, 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a'),
(33, 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a'),
(34, 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a'),
(35, 'aa', 'a', 'a', 'aa', 'a', 'a', 'a', 'a', 'a', 'a', 'a'),
(36, '', '', '', '', '', '', '', '', '', '', ''),
(37, 'Sim', 'Urina amarelo escuro', 'Sim', 'Sim', 'Alto', 'Nenhum', 'Sim', 'Sim', 'Sim', 'Sim', 'Sim'),
(38, 'Sim', 'Urina amarelo escuro', 'Sim', 'Sim', 'Alto', 'Nenhum', 'Sim', 'Sim', 'Sim', 'Sim', 'Sim'),
(39, 'Sim', 'Urina amarelo escuro', 'Sim', 'Sim', 'Alto', 'Nenhum', 'Sim', 'Sim', 'Sim', 'Sim', 'Sim'),
(40, 'Sim', 'Urina amarelo escuro', 'Sim', 'Sim', 'Alto', 'Nenhum', 'Sim', 'Sim', 'Sim', 'Sim', 'Sim'),
(41, 'Sim', 'Urina amarelo escuro', 'Sim', 'Sim', 'Alto', 'Nenhum', 'Sim', 'Sim', 'Sim', 'Sim', 'Sim'),
(42, 'Sim', 'Urina amarelo escuro', 'Sim', 'Sim', 'Alto', 'Nenhum', 'Sim', 'Sim', 'Sim', 'Sim', 'Sim'),
(43, 'Sim', 'Urina amarelo escuro', 'Sim', 'Sim', 'Alto', 'Nenhum', 'Sim', 'Sim', 'Sim', 'Sim', 'Sim'),
(44, 'Não', 'Urina amarelo escuro', 'Não', 'Não', 'Alto', 'Nenhum', 'Não', 'Não', 'Não', 'Não', 'Não'),
(45, 'Não', 'Urina amarelo escuro', 'Não', 'Não', 'Alto', 'Nenhum', 'Não', 'Não', 'Não', 'Não', 'Não'),
(46, 'Não', 'Urina amarelo escuro', 'Não', 'Não', 'Alto', 'Nenhum', 'Não', 'Não', 'Não', 'Não', 'Não'),
(47, 'Não', 'Urina amarelo escuro', 'Não', 'Não', 'Alto', 'Nenhum', 'Não', 'Não', 'Não', 'Não', 'Não'),
(48, 'Não', 'Urina amarelo escuro', 'Não', 'Não', 'Alto', 'Nenhum', 'Não', 'Não', 'Não', 'Não', 'Não'),
(49, 'Não', 'Urina amarelo escuro', 'Não', 'Não', 'Alto', 'Nenhum', 'Não', 'Não', 'Não', 'Não', 'Não'),
(50, 'Não', 'Urina amarelo escuro', 'Não', 'Não', 'Alto', 'Nenhum', 'Não', 'Não', 'Não', 'Não', 'Não'),
(51, 'Não', 'Urina amarelo escuro', 'Não', 'Não', 'Alto', 'Nenhum', 'Não', 'Não', 'Não', 'Não', 'Não'),
(52, 'Não', 'Urina amarelo escuro', 'Não', 'Não', 'Alto', 'Nenhum', 'Não', 'Não', 'Não', 'Não', 'Não'),
(53, 'Não', 'Urina amarelo escuro', 'Não', 'Não', 'Alto', 'Nenhum', 'Não', 'Não', 'Não', 'Não', 'Não'),
(54, 'Não', 'Urina amarelo escuro', 'Não', 'Não', 'Alto', 'Nenhum', 'Não', 'Não', 'Não', 'Não', 'Não'),
(55, 'Não', 'Urina amarelo escuro', 'Não', 'Não', 'Alto', 'Nenhum', 'Não', 'Não', 'Não', 'Não', 'Não'),
(56, 'Não', 'Urina amarelo escuro', 'Não', 'Não', 'Alto', 'Nenhum', 'Não', 'Não', 'Não', 'Não', 'Não'),
(57, 'Não', 'Urina amarelo escuro', 'Não', 'Não', 'Alto', 'Nenhum', 'Não', 'Não', 'Não', 'Não', 'Não'),
(58, 'Não', 'Urina amarelo escuro', 'Não', 'Não', 'Alto', 'Nenhum', 'Não', 'Não', 'Não', 'Não', 'Não');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbfuncionario`
--

CREATE TABLE `tbfuncionario` (
  `codFuncionario` int(11) NOT NULL,
  `nomeFuncionario` varchar(40) NOT NULL,
  `cpfFuncionario` varchar(15) NOT NULL,
  `sexoFuncionario` varchar(10) NOT NULL,
  `nascFuncionario` date NOT NULL,
  `salarioFuncionario` decimal(10,0) NOT NULL,
  `emailFuncionario` varchar(75) NOT NULL,
  `senhaFuncionario` varchar(50) NOT NULL,
  `codEnderecoFuncionario` int(11) DEFAULT NULL,
  `codTelefoneFuncionario` int(11) DEFAULT NULL,
  `codCelularFuncionario` int(11) DEFAULT NULL,
  `codGerente` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tbfuncionario`
--

INSERT INTO `tbfuncionario` (`codFuncionario`, `nomeFuncionario`, `cpfFuncionario`, `sexoFuncionario`, `nascFuncionario`, `salarioFuncionario`, `emailFuncionario`, `senhaFuncionario`, `codEnderecoFuncionario`, `codTelefoneFuncionario`, `codCelularFuncionario`, `codGerente`) VALUES
(3, 'Sarah Tânia', '658.641.747', 'Masculino', '2019-09-10', '11111', 'sara@sara', '123', 4, NULL, NULL, NULL),
(4, 'Sebastiel', '907.695.078-40', 'Masculino', '1989-10-20', '2000', 'se@se', '123', 5, NULL, NULL, NULL),
(5, 'Rebeca Brenda Beatriz ', '884.512.332-44', 'Masculino', '1975-10-08', '0', 're@re', '123', 6, NULL, NULL, NULL),
(6, 'Cecília Francisca Eloá Galvão', '561.391.224-65', 'Feminino', '2019-10-08', '0', 'ce@ce', '123', 7, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbgerente`
--

CREATE TABLE `tbgerente` (
  `codGerente` int(11) NOT NULL,
  `nomeGerente` varchar(40) NOT NULL,
  `cpfGerente` varchar(15) NOT NULL,
  `sexoGerente` varchar(10) NOT NULL,
  `nascGerente` date NOT NULL,
  `salarioGerente` decimal(10,0) NOT NULL,
  `emailGerente` varchar(75) NOT NULL,
  `senhaGerente` varchar(50) NOT NULL,
  `codEnderecoGerente` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tbgerente`
--

INSERT INTO `tbgerente` (`codGerente`, `nomeGerente`, `cpfGerente`, `sexoGerente`, `nascGerente`, `salarioGerente`, `emailGerente`, `senhaGerente`, `codEnderecoGerente`) VALUES
(9, 'ADM', '111.111.111-11 ', 'Masculino ', '2019-11-14', '999999', 'adm1@adm', '123', 24),
(10, 'Afonso', '658.641.747  ', 'Masculino ', '0000-00-00', '999999', 'af@af', '123', 25);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbidoso`
--

CREATE TABLE `tbidoso` (
  `codIdoso` int(11) NOT NULL,
  `nomeIdoso` varchar(40) NOT NULL,
  `sexoIdoso` varchar(15) NOT NULL,
  `cpfIdoso` varchar(25) NOT NULL,
  `nascIdoso` date NOT NULL,
  `codResponsavel` int(11) DEFAULT NULL,
  `codProntuarioFixo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tbidoso`
--

INSERT INTO `tbidoso` (`codIdoso`, `nomeIdoso`, `sexoIdoso`, `cpfIdoso`, `nascIdoso`, `codResponsavel`, `codProntuarioFixo`) VALUES
(1, 'Isaac Raimundo Raul Bernardes', 'Masculino', '578.210.957-29', '2019-10-30', 15, 23),
(9, 'Helena Larissa Farias', 'Feminino', '572.967.691-30', '2010-11-23', 15, 32),
(10, 'Teresinha Malu Alves', 'Feminino', '413.286.405-74', '2019-11-21', 39, 33),
(15, 'Tânia Elaine Rayssa Moreira', 'Feminino', '111.495.851-45', '2019-11-05', 39, 38),
(16, 'Nelson Thales Sales', 'Masculino', '639.987.244-86', '2019-11-18', 39, 39),
(17, 'Emanuelly Eduarda Araújo', 'Feminino', '679.468.163-32', '2007-10-31', 40, 40),
(21, 'Jennifer Laura Galvão', 'Feminino', '881.638.083-73', '2019-11-13', 15, 44),
(23, 'Márcio Hugo Juan Corte Real', 'Masculino', '986.453.482-33', '1946-11-13', 39, 46),
(24, 'Melissa Heloisa Moraes', 'Feminino', '195.459.664-24', '1966-11-15', 40, 47);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tblocomocao`
--

CREATE TABLE `tblocomocao` (
  `codLocomocao` int(11) NOT NULL,
  `locomocaoSolo` varchar(25) NOT NULL,
  `cadeirante` varchar(25) NOT NULL,
  `tempoCadeirante` varchar(50) NOT NULL,
  `acamacao` varchar(25) NOT NULL,
  `tempoAcamacao` varchar(25) DEFAULT NULL,
  `apoioFisico` varchar(50) DEFAULT NULL,
  `esporteTerapia` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tblocomocao`
--

INSERT INTO `tblocomocao` (`codLocomocao`, `locomocaoSolo`, `cadeirante`, `tempoCadeirante`, `acamacao`, `tempoAcamacao`, `apoioFisico`, `esporteTerapia`) VALUES
(1, 'a', 'a', 'a', 'a', 'a', 'a', 'a'),
(2, 'a', 'a', 'a', 'a', 'a', 'a', 'a'),
(3, 'b', 'b', 'b', 'b', 'b', 'b', 'b'),
(4, 'c', 'c', 'c', 'c', 'c', 'c', 'c'),
(5, 'c', 'c', 'c', 'c', 'c', 'c', 'c'),
(6, 'c', 'c', 'c', 'c', 'c', 'c', 'c'),
(7, 'c', 'c', 'c', 'c', 'c', 'c', 'c'),
(8, 'c', 'c', 'c', 'c', 'c', 'c', 'c'),
(9, 'c', 'c', 'c', 'c', 'cc', 'c', 'c'),
(10, 'c', 'c', 'c', 'c', 'cc', 'c', 'c'),
(11, 'zz', 'z', 'z', 'z', 'z', 'z', 'z'),
(12, 'zz', 'z', 'z', 'z', 'z', 'z', 'z'),
(13, 'zz', 'z', 'z', 'z', 'z', 'z', 'z'),
(14, 'zz', 'z', 'z', 'z', 'z', 'z', 'z'),
(15, 'a', 'a', 'a', 'a', 'a', 'a', 'a'),
(16, 'n', 'n', 'n', 'n', 'n', 'nn', 'n'),
(17, 'a', 'a', 'a', 'a', 'a', 'a', 'a'),
(18, 'a', 'a', 'a', 'a', 'a', 'a', 'a'),
(19, 'a', 'a', 'a', 'a', 'a', 'a', 'a'),
(20, 'a', 'a', 'a', 'a', 'a', 'a', 'a'),
(21, 'a', 'a', 'a', 'a', 'a', 'a', 'a'),
(22, 'a', 'a', 'a', 'a', 'a', 'a', 'a'),
(23, 'a', 'a', 'a', 'a', 'a', 'a', 'a'),
(24, 'a', 'a', 'a', 'a', 'a', 'a', 'a'),
(25, 'a', 'a', 'a', 'a', 'a', 'a', 'a'),
(26, 'a', 'a', 'a', 'a', 'a', 'a', 'a'),
(27, 'a', 'a', 'a', 'a', 'a', 'a', 'a'),
(28, 'a', 'a', 'a', 'a', 'a', 'a', 'a'),
(29, 'a', 'a', 'a', 'a', 'a', 'a', 'a'),
(30, 'a', 'a', 'a', 'a', 'a', 'a', 'a'),
(31, 'a', 'a', 'a', 'a', 'a', 'a', 'a'),
(32, 'a', 'a', 'a', 'a', 'a', 'a', 'a'),
(33, 'a', 'a', 'a', 'a', 'a', 'a', 'a'),
(34, 'a', 'a', 'a', 'a', 'a', 'a', 'a'),
(35, 'a', 'a', 'a', 'a', 'a', 'a', 'a'),
(36, '', '', '', '', '', '', ''),
(37, 'Sim', 'Sim', '', 'Sim', '', 'Sim', 'Sim'),
(38, 'Sim', 'Sim', '', 'Sim', '', 'Sim', 'Sim'),
(39, 'Sim', 'Sim', '', 'Sim', '', 'Sim', 'Sim'),
(40, 'Sim', 'Sim', '', 'Sim', '', 'Sim', 'Sim'),
(41, 'Sim', 'Sim', '', 'Sim', '', 'Sim', 'Sim'),
(42, 'Sim', 'Sim', '', 'Sim', '', 'Sim', 'Sim'),
(43, 'Sim', 'Sim', '', 'Sim', '', 'Sim', 'Sim'),
(44, 'Não', 'Não', '', 'Não', '', 'Não', 'Não'),
(45, 'Não', 'Não', '', 'Não', '', 'Não', 'Não'),
(46, 'Não', 'Não', '', 'Não', '', 'Não', 'Não'),
(47, 'Não', 'Não', '', 'Não', '', 'Não', 'Não'),
(48, 'Não', 'Não', '', 'Não', '', 'Não', 'Não'),
(49, 'Não', 'Não', '', 'Não', '', 'Não', 'Não'),
(50, 'Não', 'Não', '', 'Não', '', 'Não', 'Não'),
(51, 'Não', 'Não', '', 'Não', '', 'Não', 'Não'),
(52, 'Não', 'Não', '', 'Não', '', 'Não', 'Não'),
(53, 'Não', 'Não', '', 'Não', '', 'Não', 'Não'),
(54, 'Não', 'Não', '', 'Não', '', 'Não', 'Não'),
(55, 'Não', 'Não', '', 'Não', '', 'Não', 'Não'),
(56, 'Não', 'Não', '', 'Não', '', 'Não', 'Não'),
(57, 'Não', 'Não', '', 'Não', '', 'Não', 'Não'),
(58, 'Não', 'Não', '', 'Não', '', 'Não', 'Não');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbmedicacao`
--

CREATE TABLE `tbmedicacao` (
  `codMedicacao` int(11) NOT NULL,
  `nomeMedicacao` varchar(50) NOT NULL,
  `dosagemMedicacao` varchar(50) NOT NULL,
  `horarioMedicacao` time NOT NULL,
  `composicaoMedicamento` varchar(75) DEFAULT NULL,
  `posologia` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tbmedicacao`
--

INSERT INTO `tbmedicacao` (`codMedicacao`, `nomeMedicacao`, `dosagemMedicacao`, `horarioMedicacao`, `composicaoMedicamento`, `posologia`) VALUES
(1, 'Tina', '0.5', '13:50:00', NULL, NULL),
(2, 'Acetazolamida', '250', '12:00:00', NULL, NULL),
(3, 'teste', '123', '11:11:00', NULL, NULL),
(4, 'A', '1', '11:11:00', NULL, NULL),
(5, 'Acetazolamida', '250', '11:11:00', NULL, NULL),
(6, 'Acetazolamida', '250', '11:11:00', NULL, NULL),
(7, 'Tina', '0.5', '12:01:00', NULL, NULL),
(8, 'Tina', '0.5', '12:01:00', NULL, NULL),
(9, 'Tina', '0.5', '12:01:00', NULL, NULL),
(10, 'Tina', '0.5', '12:01:00', NULL, NULL),
(11, 'R', '121', '05:04:00', NULL, NULL),
(12, 'R', '121mG', '05:04:00', NULL, NULL),
(13, 'AA', '55g', '12:01:00', 'Água', 'AQ'),
(14, '', '', '00:00:00', '', '');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbmedicacaoprontuario`
--

CREATE TABLE `tbmedicacaoprontuario` (
  `codMedicacao` int(11) DEFAULT NULL,
  `codProntuarioFixo` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tbmedicacaoprontuario`
--

INSERT INTO `tbmedicacaoprontuario` (`codMedicacao`, `codProntuarioFixo`) VALUES
(10, 9),
(12, 10),
(12, 26),
(12, 27),
(12, 29),
(12, 30),
(12, 31),
(12, 32),
(12, 33),
(12, 34),
(12, 35),
(12, 36),
(12, 37),
(12, 38),
(12, 39),
(13, 46),
(14, 47);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbpele`
--

CREATE TABLE `tbpele` (
  `codPele` int(11) NOT NULL,
  `integridadePele` varchar(25) DEFAULT NULL,
  `hidratacaoPele` varchar(25) DEFAULT NULL,
  `dermatite` varchar(25) DEFAULT NULL,
  `prurido` varchar(25) DEFAULT NULL,
  `micoseUnha` varchar(25) DEFAULT NULL,
  `escamacaoPele` varchar(25) DEFAULT NULL,
  `ictericiaPele` varchar(25) DEFAULT NULL,
  `feridaPele` varchar(25) DEFAULT NULL,
  `petequiaPele` varchar(25) DEFAULT NULL,
  `hematomaPele` varchar(25) DEFAULT NULL,
  `ulceraPele` varchar(25) DEFAULT NULL,
  `grauUlcera` varchar(25) DEFAULT NULL,
  `outraEspecificacao` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tbpele`
--

INSERT INTO `tbpele` (`codPele`, `integridadePele`, `hidratacaoPele`, `dermatite`, `prurido`, `micoseUnha`, `escamacaoPele`, `ictericiaPele`, `feridaPele`, `petequiaPele`, `hematomaPele`, `ulceraPele`, `grauUlcera`, `outraEspecificacao`) VALUES
(1, 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a'),
(2, 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a'),
(3, 'b', 'b', 'b', 'b', 'b', 'b', 'b', 'b', 'b', 'b', 'b', 'b', 'b'),
(4, 'c', 'c', 'c', 'c', 'c', 'c', 'c', 'c', 'c', 'c', 'c', 'c', 'c'),
(5, 'c', 'c', 'c', 'c', 'c', 'c', 'c', 'c', 'c', 'c', 'c', 'c', 'c'),
(6, 'c', 'c', 'c', 'c', 'c', 'c', 'c', 'c', 'c', 'c', 'c', 'c', 'c'),
(7, 'c', 'c', 'c', 'c', 'c', 'c', 'c', 'c', 'c', 'c', 'c', 'c', 'c'),
(8, 'c', 'c', 'c', 'c', 'c', 'c', 'c', 'c', 'c', 'c', 'c', 'c', 'c'),
(9, 'c', 'c', 'c', 'c', 'c', 'c', 'c', 'c', 'c', 'c', 'c', 'c', 'c'),
(10, 'c', 'c', 'c', 'c', 'c', 'c', 'c', 'c', 'c', 'c', 'c', 'c', 'c'),
(11, 'z', 'z', 'z', 'z', 'z', 'z', 'z', 'z', 'z', 'z', 'z', 'z', 'z'),
(12, 'z', 'z', 'z', 'z', 'z', 'z', 'z', 'z', 'z', 'z', 'z', 'z', 'z'),
(13, 'z', 'z', 'z', 'z', 'z', 'z', 'z', 'z', 'z', 'z', 'z', 'z', 'z'),
(14, 'z', 'z', 'z', 'z', 'z', 'z', 'z', 'z', 'z', 'z', 'z', 'z', 'z'),
(15, 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a'),
(16, 'n', 'n', 'n', 'n', 'n', 'nn', 'n', 'n', 'n', 'n', 'n', 'n', 'n'),
(17, 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a'),
(18, 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a'),
(19, 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a'),
(20, 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a'),
(21, 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a'),
(22, 'a', 'aa', 'a', 'a', 'a', 'aa', 'a', 'a', 'a', 'a', 'a', 'a', 'a'),
(23, 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a'),
(24, 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a'),
(25, 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a'),
(26, 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a'),
(27, 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a'),
(28, 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a'),
(29, 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a'),
(30, 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a'),
(31, 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a'),
(32, 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a'),
(33, 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a'),
(34, 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a'),
(35, 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a'),
(36, '', '', '', '', '', '', '', '', '', '', '', '', ''),
(37, 'Sim', 'Sim', 'Sim', 'Sim', 'Sim', 'Sim', 'Sim', 'Sim', 'Sim', 'Sim', 'Sim', '', ''),
(38, 'Sim', 'Sim', 'Sim', 'Sim', 'Sim', 'Sim', 'Sim', 'Sim', 'Sim', 'Sim', 'Sim', '', ''),
(39, 'Sim', 'Sim', 'Sim', 'Sim', 'Sim', 'Sim', 'Sim', 'Sim', 'Sim', 'Sim', 'Sim', '', ''),
(40, 'Sim', 'Sim', 'Sim', 'Sim', 'Sim', 'Sim', 'Sim', 'Sim', 'Sim', 'Sim', 'Sim', '', ''),
(41, 'Sim', 'Sim', 'Sim', 'Sim', 'Sim', 'Sim', 'Sim', 'Sim', 'Sim', 'Sim', 'Sim', '', ''),
(42, 'Sim', 'Sim', 'Sim', 'Sim', 'Sim', 'Sim', 'Sim', 'Sim', 'Sim', 'Sim', 'Sim', '', ''),
(43, 'Sim', 'Sim', 'Sim', 'Sim', 'Sim', 'Sim', 'Sim', 'Sim', 'Sim', 'Sim', 'Sim', '', ''),
(44, 'Não', 'Não', 'Não', 'Não', 'Não', 'Não', 'Não', 'Não', 'Não', 'Não', 'Não', '', ''),
(45, 'Não', 'Não', 'Não', 'Não', 'Não', 'Não', 'Não', 'Não', 'Não', 'Não', 'Não', '', ''),
(46, 'Não', 'Não', 'Não', 'Não', 'Não', 'Não', 'Não', 'Não', 'Não', 'Não', 'Não', '', ''),
(47, 'Não', 'Não', 'Não', 'Não', 'Não', 'Não', 'Não', 'Não', 'Não', 'Não', 'Não', '', ''),
(48, 'Não', 'Não', 'Não', 'Não', 'Não', 'Não', 'Não', 'Não', 'Não', 'Não', 'Não', '', ''),
(49, 'Não', 'Não', 'Não', 'Não', 'Não', 'Não', 'Não', 'Não', 'Não', 'Não', 'Não', '', ''),
(50, 'Não', 'Não', 'Não', 'Não', 'Não', 'Não', 'Não', 'Não', 'Não', 'Não', 'Não', '', ''),
(51, 'Não', 'Não', 'Não', 'Não', 'Não', 'Não', 'Não', 'Não', 'Não', 'Não', 'Não', '', ''),
(52, 'Não', 'Não', 'Não', 'Não', 'Não', 'Não', 'Não', 'Não', 'Não', 'Não', 'Não', '', ''),
(53, 'Não', 'Não', 'Não', 'Não', 'Não', 'Não', 'Não', 'Não', 'Não', 'Não', 'Não', '', ''),
(54, 'Não', 'Não', 'Não', 'Não', 'Não', 'Não', 'Não', 'Não', 'Não', 'Não', 'Não', '', ''),
(55, 'Não', 'Não', 'Não', 'Não', 'Não', 'Não', 'Não', 'Não', 'Não', 'Não', 'Não', '', ''),
(56, 'Não', 'Não', 'Não', 'Não', 'Não', 'Não', 'Não', 'Não', 'Não', 'Não', 'Não', '', ''),
(57, 'Não', 'Não', 'Não', 'Não', 'Não', 'Não', 'Não', 'Não', 'Não', 'Não', 'Não', '', ''),
(58, 'Não', 'Não', 'Não', 'Não', 'Não', 'Não', 'Não', 'Não', 'Não', 'Não', 'Não', '', '');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbprescricaoenfermagem`
--

CREATE TABLE `tbprescricaoenfermagem` (
  `codPrescricaoEnfermagem` int(11) NOT NULL,
  `prescricaoEnfermagem` varchar(75) NOT NULL,
  `aprazamentoEnfermagem` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbprontuariodiario`
--

CREATE TABLE `tbprontuariodiario` (
  `codProntuario` int(11) NOT NULL,
  `descProntuario` varchar(50) NOT NULL,
  `dataProntuario` date NOT NULL,
  `codIdoso` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbprontuariofixo`
--

CREATE TABLE `tbprontuariofixo` (
  `codProntuarioFixo` int(11) NOT NULL,
  `dataEmissaoProntuarioFixo` date NOT NULL,
  `codAntecedencia` int(11) DEFAULT NULL,
  `codQuestionamento` int(11) DEFAULT NULL,
  `codPele` int(11) DEFAULT NULL,
  `codPulmonar` int(11) DEFAULT NULL,
  `codAlimentacao` int(11) DEFAULT NULL,
  `codLocomocao` int(11) DEFAULT NULL,
  `codRelacionamento` int(11) DEFAULT NULL,
  `codExame` int(11) DEFAULT NULL,
  `codEliminacao` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tbprontuariofixo`
--

INSERT INTO `tbprontuariofixo` (`codProntuarioFixo`, `dataEmissaoProntuarioFixo`, `codAntecedencia`, `codQuestionamento`, `codPele`, `codPulmonar`, `codAlimentacao`, `codLocomocao`, `codRelacionamento`, `codExame`, `codEliminacao`) VALUES
(2, '2019-10-22', 20, 4, 14, 14, 14, 14, 14, 14, 15),
(3, '2019-10-22', 21, 5, 15, 15, 15, 15, 15, 15, 16),
(4, '2019-10-22', 22, 6, 16, 16, 16, 16, 16, 16, 17),
(5, '2019-10-26', 23, 7, 17, 17, 17, 17, 17, 17, 18),
(6, '2019-10-26', 24, 8, 18, 18, 18, 18, 18, 18, 19),
(7, '2019-10-26', 25, 9, 19, 19, 19, 19, 19, 19, 20),
(8, '2019-10-28', 26, 10, 20, 20, 20, 20, 20, 20, 21),
(9, '2019-10-30', 27, 11, 21, 21, 21, 21, 21, 21, 22),
(10, '2019-11-02', 28, 12, 22, 22, 22, 22, 22, 22, 23),
(11, '2019-11-02', 29, 13, 23, 23, 23, 23, 23, 23, 24),
(12, '2019-11-02', 30, 14, 24, 24, 24, 24, 24, 24, 25),
(13, '2019-11-02', 31, 15, 25, 25, 25, 25, 25, 25, 26),
(14, '2019-11-02', 32, 16, 26, 26, 26, 26, 26, 26, 27),
(15, '2019-11-02', 33, 17, 27, 27, 27, 27, 27, 27, 28),
(16, '2019-11-02', 34, 18, 28, 28, 28, 28, 28, 28, 29),
(17, '2019-11-02', 35, 19, 29, 29, 29, 29, 29, 29, 30),
(18, '2019-11-02', 36, 20, 30, 30, 30, 30, 30, 30, 31),
(19, '2019-11-02', 37, 21, 31, 31, 31, 31, 31, 31, 32),
(20, '2019-11-15', 38, 22, 32, 32, 32, 32, 32, 32, 33),
(21, '2019-11-15', 39, 23, 33, 33, 33, 33, 33, 33, 34),
(22, '2019-11-15', 40, 24, 34, 34, 34, 34, 34, 34, 35),
(23, '2019-11-16', 41, 25, 35, 35, 35, 35, 35, 35, 36),
(24, '2019-11-16', 42, 26, 36, 36, 36, 36, 36, 36, 37),
(25, '2019-11-18', 43, 27, 37, 37, 37, 37, 37, 37, 38),
(26, '2019-11-19', 44, 28, 38, 38, 38, 38, 38, 38, 39),
(27, '2019-11-19', 45, 29, 39, 39, 39, 39, 39, 39, 40),
(28, '2019-11-19', 45, 29, 39, 39, 39, 39, 39, 39, 40),
(29, '2019-11-19', 46, 30, 40, 40, 40, 40, 40, 40, 41),
(30, '2019-11-19', 47, 31, 41, 41, 41, 41, 41, 41, 42),
(31, '2019-11-19', 48, 32, 42, 42, 42, 42, 42, 42, 43),
(32, '2019-11-19', 49, 33, 43, 43, 43, 43, 43, 43, 44),
(33, '2019-11-22', 50, 34, 44, 44, 44, 44, 44, 44, 45),
(34, '2019-11-22', 51, 35, 45, 45, 45, 45, 45, 45, 46),
(35, '2019-11-22', 52, 36, 46, 46, 46, 46, 46, 46, 47),
(36, '2019-11-22', 53, 37, 47, 47, 47, 47, 47, 47, 48),
(37, '2019-11-22', 54, 38, 48, 48, 48, 48, 48, 48, 49),
(38, '2019-11-22', 55, 39, 49, 49, 49, 49, 49, 49, 50),
(39, '2019-11-22', 56, 40, 50, 50, 50, 50, 50, 50, 51),
(40, '2019-11-22', 57, 41, 51, 51, 51, 51, 51, 51, 52),
(41, '2019-11-22', 58, 42, 52, 52, 52, 52, 52, 52, 53),
(42, '2019-11-22', 59, 43, 53, 53, 53, 53, 53, 53, 54),
(43, '2019-11-22', 60, 44, 54, 54, 54, 54, 54, 54, 55),
(44, '2019-11-22', 61, 45, 55, 55, 55, 55, 55, 55, 56),
(45, '2019-11-22', 62, 46, 56, 56, 56, 56, 56, 56, 57),
(46, '2019-11-22', 63, 47, 57, 57, 57, 57, 57, 57, 58),
(47, '2019-11-22', 64, 48, 58, 58, 58, 58, 58, 58, 59);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbpulmonar`
--

CREATE TABLE `tbpulmonar` (
  `codPulmonar` int(11) NOT NULL,
  `tipoTosse` varchar(50) DEFAULT NULL,
  `ascultacao` varchar(50) DEFAULT NULL,
  `tipoDispineia` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tbpulmonar`
--

INSERT INTO `tbpulmonar` (`codPulmonar`, `tipoTosse`, `ascultacao`, `tipoDispineia`) VALUES
(1, 'a', 'a', 'a'),
(2, 'a', 'a', 'a'),
(3, 'b', 'b', 'b'),
(4, 'c', 'c', 'c'),
(5, 'c', 'c', 'c'),
(6, 'c', 'c', 'c'),
(7, 'c', 'c', 'c'),
(8, 'c', 'c', 'c'),
(9, 'c', 'c', 'c'),
(10, 'c', 'c', 'c'),
(11, 'z', 'z', 'z'),
(12, 'z', 'z', 'z'),
(13, 'z', 'z', 'z'),
(14, 'z', 'z', 'z'),
(15, 'a', 'a', 'a'),
(16, 'n', 'nn', 'n'),
(17, 'a', 'a', 'a'),
(18, 'a', 'a', 'a'),
(19, 'a', 'a', 'a'),
(20, 'a', 'a', 'a'),
(21, 'a', 'a', 'a'),
(22, 'a', 'a', 'a'),
(23, 'a', 'a', 'a'),
(24, 'a', 'a', 'a'),
(25, 'a', 'a', 'a'),
(26, 'a', 'a', 'a'),
(27, 'a', 'a', 'aa'),
(28, 'a', 'a', 'a'),
(29, 'a', 'a', 'a'),
(30, 'a', 'a', 'a'),
(31, 'a', 'a', 'a'),
(32, 'a', 'a', 'a'),
(33, 'a', 'a', 'a'),
(34, 'a', 'a', 'a'),
(35, 'a', 'a', 'a'),
(36, '', '', ''),
(37, 'Nenhuma', 'Sim', 'Nenhum'),
(38, 'Nenhuma', 'Sim', 'Nenhum'),
(39, 'Nenhuma', 'Sim', 'Nenhum'),
(40, 'Nenhuma', 'Sim', 'Nenhum'),
(41, 'Nenhuma', 'Sim', 'Nenhum'),
(42, 'Nenhuma', 'Sim', 'Nenhum'),
(43, 'Nenhuma', 'Sim', 'Nenhum'),
(44, 'Nenhuma', 'Não', 'Nenhum'),
(45, 'Nenhuma', 'Não', 'Nenhum'),
(46, 'Nenhuma', 'Não', 'Nenhum'),
(47, 'Nenhuma', 'Não', 'Nenhum'),
(48, 'Nenhuma', 'Não', 'Nenhum'),
(49, 'Nenhuma', 'Não', 'Nenhum'),
(50, 'Nenhuma', 'Não', 'Nenhum'),
(51, 'Tosse produtiva', 'Sim', 'Nenhum'),
(52, 'Nenhuma', 'Não', 'Nenhum'),
(53, 'Nenhuma', 'Não', 'Nenhum'),
(54, 'Nenhuma', 'Não', 'Nenhum'),
(55, 'Nenhuma', 'Não', 'Nenhum'),
(56, 'Tosse produtiva', 'Não', 'Nenhum'),
(57, 'Tosse produtiva', 'Não', 'Nenhum'),
(58, 'Nenhuma', 'Não', 'Nenhum');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbquestionamento`
--

CREATE TABLE `tbquestionamento` (
  `codQuestionamento` int(11) NOT NULL,
  `peso` double NOT NULL,
  `altura` double DEFAULT NULL,
  `pressaoArterial` varchar(50) DEFAULT NULL,
  `pulsacao` varchar(50) DEFAULT NULL,
  `respiracao` varchar(50) DEFAULT NULL,
  `temperatura` int(11) DEFAULT NULL,
  `dextro` varchar(25) DEFAULT NULL,
  `spo2` varchar(50) DEFAULT NULL,
  `utilizacaoOculos` varchar(25) DEFAULT NULL,
  `proteseAuditiva` varchar(25) DEFAULT NULL,
  `carteiraVacinacao` varchar(50) DEFAULT NULL,
  `tabagista` varchar(50) DEFAULT NULL,
  `etilista` varchar(50) DEFAULT NULL,
  `dependenciaEtilismo` varchar(25) DEFAULT NULL,
  `tipoSanguineo` varchar(10) DEFAULT NULL,
  `usoProteseDentaria` varchar(25) DEFAULT NULL,
  `marcaProteseDentaria` varchar(25) DEFAULT NULL,
  `modeloProtoseDentaria` varchar(25) DEFAULT NULL,
  `usoMedicamentoContinuo` varchar(25) DEFAULT NULL,
  `usoSubstanciaPsicoativa` varchar(25) DEFAULT NULL,
  `alergiaMedicamento` varchar(25) DEFAULT NULL,
  `convenio` varchar(50) DEFAULT NULL,
  `encaminhamentoUnidadeHospitalar` varchar(50) DEFAULT NULL,
  `atividadeManual` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tbquestionamento`
--

INSERT INTO `tbquestionamento` (`codQuestionamento`, `peso`, `altura`, `pressaoArterial`, `pulsacao`, `respiracao`, `temperatura`, `dextro`, `spo2`, `utilizacaoOculos`, `proteseAuditiva`, `carteiraVacinacao`, `tabagista`, `etilista`, `dependenciaEtilismo`, `tipoSanguineo`, `usoProteseDentaria`, `marcaProteseDentaria`, `modeloProtoseDentaria`, `usoMedicamentoContinuo`, `usoSubstanciaPsicoativa`, `alergiaMedicamento`, `convenio`, `encaminhamentoUnidadeHospitalar`, `atividadeManual`) VALUES
(1, 0, 0, 'z', 'z', 'z', 0, 'z', 'z', 'z', 'z', 'z', 'z', 'z', 'z', 'z', 'z', 'z', 'z', 'z', 'z', 'z', 'z', 'z', 'z'),
(2, 0, 0, 'z', 'z', 'z', 0, 'z', 'z', 'z', 'z', 'z', 'z', 'z', 'z', 'z', 'z', 'z', 'z', 'z', 'z', 'z', 'z', 'z', 'z'),
(3, 0, 0, 'z', 'z', 'z', 0, 'z', 'z', 'z', 'z', 'z', 'z', 'z', 'z', 'z', 'z', 'z', 'z', 'z', 'z', 'z', 'z', 'z', 'z'),
(4, 0, 0, 'z', 'z', 'z', 0, 'z', 'z', 'z', 'z', 'z', 'z', 'z', 'z', 'z', 'z', 'z', 'z', 'z', 'z', 'z', 'z', 'z', 'z'),
(5, 0, 0, 'a', 'a', 'a', 0, 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a'),
(6, 0, 0, 'n', 'n', 'n', 0, 'n', 'n', 'n', 'n', 'n', 'n', 'n', 'n', 'n', 'n', 'n', 'n', 'n', 'n', 'n', 'n', 'n', 'n'),
(7, 0, 0, 'a', 'a', 'a', 0, 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'Sim', 'a', 'a', 'a', 'a', 'a'),
(8, 0, 0, 'a', 'a', 'a', 0, 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a'),
(9, 0, 0, 'a', 'a', 'a', 0, 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a'),
(10, 0, 0, 'a', 'a', 'a', 0, 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a'),
(11, 0, 0, 'a', 'a', 'a', 0, 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a'),
(12, 0, 0, 'a', 'a', 'a', 0, 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'aa', 'a', 'aa', 'a', 'a', 'a'),
(13, 0, 0, 'a', 'a', 'a', 0, 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a'),
(14, 0, 0, 'a', 'a', 'a', 0, 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a'),
(15, 0, 0, 'a', 'a', 'a', 0, 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a'),
(16, 0, 0, 'a', 'a', 'a', 0, 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a'),
(17, 0, 0, 'a', 'a', 'a', 0, 'a', 'aa', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a'),
(18, 0, 0, 'a', 'a', 'a', 0, 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a'),
(19, 0, 0, 'a', 'a', 'a', 0, 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a'),
(20, 0, 0, 'a', 'a', 'a', 0, 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a'),
(21, 0, 0, 'a', 'a', 'a', 0, 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a'),
(22, 0, 0, 'a', 'a', 'a', 0, 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a'),
(23, 0, 0, 'a', 'a', 'a', 0, 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a'),
(24, 0, 0, 'a', 'a', 'a', 0, 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a'),
(25, 0, 0, 'a', 'a', 'a', 0, 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a'),
(26, 0, 0, '', '', '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(27, 11, 1, '', '', '', 0, '', '', 'Sim', 'Sim', 'Sim', 'Sim', 'Sim', 'Sim', 'AB+', 'Sim', '', '', 'Sim', 'Sim', 'Sim', 'Sim', 'Sim', 'Sim'),
(28, 1, 1, '', '', '', 0, '', '', 'Sim', 'Sim', 'Sim', 'Sim', 'Sim', 'Sim', 'AB+', 'Sim', '', '', 'Sim', 'Sim', 'Sim', 'Sim', 'Sim', 'Sim'),
(29, 11, 1, '', '', '', 0, '', '', 'Sim', 'Sim', 'Sim', 'Sim', 'Sim', 'Sim', 'AB+', 'Sim', '', '', 'Sim', 'Sim', 'Sim', 'Sim', 'Sim', 'Sim'),
(30, 11, 1, '', '', '', 0, '', '', 'Sim', 'Sim', 'Sim', 'Sim', 'Sim', 'Sim', 'AB+', 'Sim', '', '', 'Sim', 'Sim', 'Sim', 'Sim', 'Sim', 'Sim'),
(31, 12, 21, '', '', '', 0, '', '', 'Sim', 'Sim', 'Sim', 'Sim', 'Sim', 'Sim', 'AB+', 'Sim', '', '', 'Sim', 'Sim', 'Sim', 'Sim', 'Sim', 'Sim'),
(32, 121, 12, '', '', '', 0, '', '', 'Sim', 'Sim', 'Sim', 'Sim', 'Sim', 'Sim', 'AB+', 'Sim', '', '', 'Sim', 'Sim', 'Sim', 'Sim', 'Sim', 'Sim'),
(33, 50, 1.56, '', '', '', 0, '', '', 'Sim', 'Sim', 'Sim', 'Sim', 'Sim', 'Sim', 'AB+', 'Sim', '', '', 'Sim', 'Sim', 'Sim', 'Sim', 'Sim', 'Sim'),
(34, 1, 1, '', '', '', 0, '', '', 'Não', 'Não', 'Não', 'Não', 'Não', 'Não', 'AB+', 'Não', '', '', 'Sim', 'Não', 'Não', 'Não', 'Não', 'Não'),
(35, 11, 1, '', '', '', 0, '', '', 'Não', 'Não', 'Não', 'Não', 'Não', 'Não', 'AB+', 'Não', '', '', 'Não', 'Não', 'Não', 'Não', 'Não', 'Não'),
(36, 11, 1, '', '', '', 0, '', '', 'Não', 'Não', 'Não', 'Não', 'Não', 'Não', 'AB+', 'Não', '', '', 'Não', 'Não', 'Não', 'Não', 'Não', 'Não'),
(37, 11, 1, '', '', '', 0, '', '', 'Não', 'Não', 'Não', 'Não', 'Não', 'Não', 'AB+', 'Não', '', '', 'Não', 'Não', 'Não', 'Não', 'Não', 'Não'),
(38, 11, 1, '', '', '', 0, '', '', 'Não', 'Não', 'Não', 'Não', 'Não', 'Não', 'AB+', 'Não', '', '', 'Não', 'Não', 'Não', 'Não', 'Não', 'Não'),
(39, 11, 1, '', '', '', 0, '', '', 'Não', 'Não', 'Não', 'Não', 'Não', 'Não', 'AB+', 'Não', '', '', 'Não', 'Não', 'Não', 'Não', 'Não', 'Não'),
(40, 1, 1, '', '', '', 0, '', '', 'Não', 'Não', 'Não', 'Não', 'Não', 'Não', 'AB+', 'Não', '', '', 'Não', 'Não', 'Não', 'Não', 'Não', 'Não'),
(41, 1, 1, '', '', '', 0, '', '', 'Não', 'Não', 'Não', 'Não', 'Não', 'Não', 'AB+', 'Não', '', '', 'Não', 'Não', 'Não', 'Não', 'Não', 'Não'),
(42, 1, 1, '', '', '', 0, '', '', 'Não', 'Não', 'Não', 'Não', 'Não', 'Não', 'AB+', 'Não', '', '', 'Não', 'Não', 'Não', 'Não', 'Não', 'Não'),
(43, 1, 1, '', '', '', 0, '', '', 'Não', 'Não', 'Não', 'Não', 'Não', 'Não', 'AB+', 'Não', '', '', 'Não', 'Não', 'Não', 'Não', 'Não', 'Não'),
(44, 1, 1, '', '', '', 0, '', '', 'Não', 'Não', 'Não', 'Não', 'Não', 'Não', 'AB+', 'Não', '', '', 'Não', 'Não', 'Não', 'Não', 'Não', 'Não'),
(45, 1, 1, '', '', '', 0, '', '', 'Não', 'Não', 'Não', 'Não', 'Não', 'Não', 'AB+', 'Não', '', '', 'Não', 'Não', 'Não', 'Não', 'Não', 'Não'),
(46, 5, 5, '', '', '', 0, '', '', 'Não', 'Não', 'Não', 'Não', 'Não', 'Não', 'AB+', 'Não', '', '', 'Não', 'Não', 'Não', 'Não', 'Não', 'Não'),
(47, 5, 5, '', '', '', 0, '', '', 'Não', 'Não', 'Não', 'Não', 'Não', 'Não', 'AB+', 'Não', '', '', 'Não', 'Não', 'Não', 'Não', 'Não', 'Não'),
(48, 1, 1, '', '', '', 0, '', '', 'Não', 'Não', 'Não', 'Não', 'Não', 'Não', 'AB+', 'Não', '', '', 'Não', 'Não', 'Não', 'Não', 'Não', 'Não');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbrelacionamento`
--

CREATE TABLE `tbrelacionamento` (
  `codRelacionamento` int(11) NOT NULL,
  `statusComunicacao` varchar(50) DEFAULT NULL,
  `agressividade` varchar(50) DEFAULT NULL,
  `temperamento` varchar(50) DEFAULT NULL,
  `anterioridadeCasaRepouso` varchar(25) DEFAULT NULL,
  `irritabilidade` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tbrelacionamento`
--

INSERT INTO `tbrelacionamento` (`codRelacionamento`, `statusComunicacao`, `agressividade`, `temperamento`, `anterioridadeCasaRepouso`, `irritabilidade`) VALUES
(1, 'a', 'a', 'a', 'a', 'a'),
(2, 'a', 'a', 'a', 'a', 'a'),
(3, 'b', 'b', 'b', 'b', 'b'),
(4, 'c', 'c', 'c', 'c', 'c'),
(5, 'c', 'c', 'c', 'c', 'c'),
(6, 'c', 'c', 'c', 'c', 'c'),
(7, 'c', 'c', 'c', 'c', 'c'),
(8, 'c', 'c', 'c', 'c', 'c'),
(9, 'c', 'c', 'c', 'c', 'c'),
(10, 'c', 'c', 'c', 'c', 'c'),
(11, 'z', 'z', 'z', 'z', 'z'),
(12, 'z', 'z', 'z', 'z', 'z'),
(13, 'z', 'z', 'z', 'z', 'z'),
(14, 'z', 'z', 'z', 'z', 'z'),
(15, 'a', 'a', 'a', 'a', 'a'),
(16, 'n', 'n', 'n', 'n', 'n'),
(17, 'a', 'a', 'a', 'a', 'a'),
(18, 'a', 'a', 'a', 'a', 'a'),
(19, 'a', 'a', 'a', 'a', 'a'),
(20, 'a', 'a', 'a', 'a', 'a'),
(21, 'a', 'aa', 'a', 'a', 'a'),
(22, 'a', 'a', 'a', 'a', 'a'),
(23, 'a', 'a', 'a', 'a', 'a'),
(24, 'a', 'a', 'a', 'a', 'a'),
(25, 'a', 'aa', 'a', 'a', 'a'),
(26, 'a', 'a', 'a', 'a', 'a'),
(27, 'a', 'a', 'a', 'a', 'a'),
(28, 'a', 'a', 'a', 'a', 'a'),
(29, 'a', 'a', 'a', 'a', 'a'),
(30, 'a', 'a', 'a', 'a', 'a'),
(31, 'a', 'a', 'a', 'a', 'a'),
(32, 'a', 'a', 'a', 'a', 'a'),
(33, 'a', 'a', 'a', 'a', 'a'),
(34, 'a', 'a', 'a', 'a', 'a'),
(35, 'a', 'a', 'a', 'a', 'a'),
(36, '', '', '', '', ''),
(37, 'Sim', 'Nenhuma', 'Colérico', 'Sim', 'Sim'),
(38, 'Sim', 'Nenhuma', 'Colérico', 'Sim', 'Sim'),
(39, 'Sim', 'Nenhuma', 'Colérico', 'Sim', 'Sim'),
(40, 'Sim', 'Nenhuma', 'Colérico', 'Sim', 'Sim'),
(41, 'Sim', 'Nenhuma', 'Colérico', 'Sim', 'Sim'),
(42, 'Sim', 'Nenhuma', 'Colérico', 'Sim', 'Sim'),
(43, 'Sim', 'Nenhuma', 'Colérico', 'Sim', 'Sim'),
(44, 'Não', 'Nenhuma', 'Colérico', 'Não', 'Não'),
(45, 'Não', 'Nenhuma', 'Colérico', 'Não', 'Não'),
(46, 'Não', 'Nenhuma', 'Colérico', 'Não', 'Não'),
(47, 'Não', 'Nenhuma', 'Colérico', 'Não', 'Não'),
(48, 'Não', 'Nenhuma', 'Colérico', 'Não', 'Não'),
(49, 'Não', 'Nenhuma', 'Colérico', 'Não', 'Não'),
(50, 'Não', 'Nenhuma', 'Colérico', 'Não', 'Não'),
(51, 'Não', 'Nenhuma', 'Colérico', 'Não', 'Não'),
(52, 'Não', 'Nenhuma', 'Colérico', 'Não', 'Não'),
(53, 'Não', 'Nenhuma', 'Colérico', 'Não', 'Não'),
(54, 'Não', 'Nenhuma', 'Colérico', 'Não', 'Não'),
(55, 'Não', 'Nenhuma', 'Colérico', 'Não', 'Não'),
(56, 'Não', 'Nenhuma', 'Colérico', 'Não', 'Não'),
(57, 'Não', 'Nenhuma', 'Colérico', 'Não', 'Não'),
(58, 'Não', 'Nenhuma', 'Colérico', 'Não', 'Não');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbresponsavel`
--

CREATE TABLE `tbresponsavel` (
  `codResponsavel` int(11) NOT NULL,
  `nomeResponsavel` varchar(40) NOT NULL,
  `cpfResponsavel` varchar(15) NOT NULL,
  `sexoResponsavel` varchar(15) NOT NULL,
  `nascResponsavel` date NOT NULL,
  `emailResponsavel` varchar(75) NOT NULL,
  `senhaResponsavel` varchar(50) NOT NULL,
  `codEnderecoResponsavel` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tbresponsavel`
--

INSERT INTO `tbresponsavel` (`codResponsavel`, `nomeResponsavel`, `cpfResponsavel`, `sexoResponsavel`, `nascResponsavel`, `emailResponsavel`, `senhaResponsavel`, `codEnderecoResponsavel`) VALUES
(15, 'Rodolfo Renan Pinto', '161.359.641', 'Masculino', '1957-12-25', 'elias@e', '123', 179),
(31, 'Ricardo Theo Monteiro', '298.914.454-45', 'Masculino', '1982-10-11', 'ri@ri', '123', 197),
(32, 'Alice Carolina Antônia', '663.922.919-62', 'Masculino', '1989-12-15', 'ali@ali', '123', 198),
(35, 'Kamilly Larissa Isis Duarte', '898.739.949-47', 'Feminino', '2007-09-04', 'k@k', '123', 201),
(36, 'Elisa Flávia Olivia dos Santos', '868.776.163-59', 'Feminino', '2010-10-12', 'el@el', '123', 202),
(37, 'Lorena Clara Vieira', '868.776.163-59', 'Feminino', '1998-12-15', 'l@l', '123', 203),
(38, 'Sebastião Nelson Aparício', '752.622.719-95', 'Masculino', '2007-09-11', 'sb@sb', '123', 204),
(39, 'Juliana Lavínia Louise Caldeira', '512.769.209-03', 'Feminino', '2019-10-08', 'ju@ju', '123', 205),
(40, 'Murilo Leonardo Oliver Caldeira', '120.258.107-25', 'Masculino', '2019-11-20', 'mu@mu', '123', 212);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbtelefonefuncionario`
--

CREATE TABLE `tbtelefonefuncionario` (
  `codTelefoneFuncionario` int(11) NOT NULL,
  `numeroTelefoneFuncionario` varchar(25) DEFAULT NULL,
  `codFuncionario` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tbtelefonefuncionario`
--

INSERT INTO `tbtelefonefuncionario` (`codTelefoneFuncionario`, `numeroTelefoneFuncionario`, `codFuncionario`) VALUES
(1, '(43) 3560-7558', 3),
(2, '(47) 2550-2349', 4),
(3, '(69) 2595-2476', 5),
(4, '(68) 2975-5559', 6);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbtelefonegerente`
--

CREATE TABLE `tbtelefonegerente` (
  `codTelefoneGerente` int(11) NOT NULL,
  `numeroTelefoneGerente` varchar(25) DEFAULT NULL,
  `codGerente` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tbtelefonegerente`
--

INSERT INTO `tbtelefonegerente` (`codTelefoneGerente`, `numeroTelefoneGerente`, `codGerente`) VALUES
(1, '(11) 9087-77821', 9),
(2, '(27) 2706-7494', 10);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbtelefoneresponsavel`
--

CREATE TABLE `tbtelefoneresponsavel` (
  `codTelefoneResponsavel` int(11) NOT NULL,
  `numeroTelefoneResponsavel` varchar(25) DEFAULT NULL,
  `codResponsavel` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tbtelefoneresponsavel`
--

INSERT INTO `tbtelefoneresponsavel` (`codTelefoneResponsavel`, `numeroTelefoneResponsavel`, `codResponsavel`) VALUES
(1, '(27) 2717-6299', 15),
(2, '(11) 9087-77821', 16),
(3, '(43) 3560-7558', 17),
(4, '(11) 9087-77821', 18),
(5, '(43) 3560-7558', 19),
(6, '(11) 1111-11111', 20),
(7, '(11) 9087-77821', 21),
(8, '(43) 3560-7558', 22),
(9, '(11) 9087-77821', 23),
(10, '(11) 9087-77821', 25),
(11, '(43) 3560-7558', 26),
(12, '(11) 9087-77821', 27),
(13, '(11) 9087-77821', 28),
(14, '(11) 9087-77821', 29),
(15, '(11) 9087-77821', 30),
(16, '(68) 2773-4536', 31),
(17, '(61) 2875-2141', 32),
(18, '(51) 2985-2738', 33),
(19, '(81) 2859-8168', 34),
(20, '(96) 2827-4161', 35),
(21, '(95) 2639-4526', 36),
(22, '(95) 2639-4526', 37),
(23, '(69) 2636-4585', 38),
(24, '(98) 2724-1855', 39),
(25, '(13) 2912-6475', 40),
(26, '(31) 3622-1747', 41),
(27, '(88) 2937-9277', 42),
(28, '(51) 3807-4110', 43),
(29, '(98) 2990-6118', 44),
(30, '(21) 2857-2885', 45),
(31, '(62) 2950-1244', 40);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `foto`
--
ALTER TABLE `foto`
  ADD PRIMARY KEY (`codFoto`),
  ADD KEY `codGerente` (`codGerente`),
  ADD KEY `codResponsavel` (`codResponsavel`) USING BTREE,
  ADD KEY `codFuncionario` (`codFuncionario`) USING BTREE,
  ADD KEY `codAdm` (`codAdm`),
  ADD KEY `codIdoso` (`codIdoso`);

--
-- Indexes for table `tbadm`
--
ALTER TABLE `tbadm`
  ADD PRIMARY KEY (`codAdm`);

--
-- Indexes for table `tbalimentacao`
--
ALTER TABLE `tbalimentacao`
  ADD PRIMARY KEY (`codAlimentacao`);

--
-- Indexes for table `tbantecedencia`
--
ALTER TABLE `tbantecedencia`
  ADD PRIMARY KEY (`codAntecedencia`);

--
-- Indexes for table `tbcelularfuncionario`
--
ALTER TABLE `tbcelularfuncionario`
  ADD PRIMARY KEY (`codCelularFuncionario`),
  ADD KEY `codFuncionario` (`codFuncionario`);

--
-- Indexes for table `tbcelulargerente`
--
ALTER TABLE `tbcelulargerente`
  ADD PRIMARY KEY (`codCelularGerente`),
  ADD KEY `codGerente` (`codGerente`);

--
-- Indexes for table `tbcelularresponsavel`
--
ALTER TABLE `tbcelularresponsavel`
  ADD PRIMARY KEY (`codCelularResponsavel`),
  ADD KEY `codResponsavel` (`codResponsavel`);

--
-- Indexes for table `tbdiagnosticoenfermagem`
--
ALTER TABLE `tbdiagnosticoenfermagem`
  ADD PRIMARY KEY (`codDiagnosticoEnfermagem`);

--
-- Indexes for table `tbeliminacao`
--
ALTER TABLE `tbeliminacao`
  ADD PRIMARY KEY (`codEliminacao`);

--
-- Indexes for table `tbenderecofuncionario`
--
ALTER TABLE `tbenderecofuncionario`
  ADD PRIMARY KEY (`codEnderecoFuncionario`);

--
-- Indexes for table `tbenderecogerente`
--
ALTER TABLE `tbenderecogerente`
  ADD PRIMARY KEY (`codEnderecoGerente`);

--
-- Indexes for table `tbenderecoresponsavel`
--
ALTER TABLE `tbenderecoresponsavel`
  ADD PRIMARY KEY (`codEnderecoResponsavel`);

--
-- Indexes for table `tbexame`
--
ALTER TABLE `tbexame`
  ADD PRIMARY KEY (`codExame`);

--
-- Indexes for table `tbfuncionario`
--
ALTER TABLE `tbfuncionario`
  ADD PRIMARY KEY (`codFuncionario`),
  ADD UNIQUE KEY `codEnderecoFuncionario` (`codEnderecoFuncionario`),
  ADD UNIQUE KEY `codEnderecoFuncionario_2` (`codEnderecoFuncionario`),
  ADD KEY `codTelefoneFuncionario` (`codTelefoneFuncionario`),
  ADD KEY `codCelularFuncionario` (`codCelularFuncionario`),
  ADD KEY `codTelefoneFuncionario_2` (`codTelefoneFuncionario`),
  ADD KEY `codGerente` (`codGerente`);

--
-- Indexes for table `tbgerente`
--
ALTER TABLE `tbgerente`
  ADD PRIMARY KEY (`codGerente`),
  ADD UNIQUE KEY `codEnderecoGerente` (`codEnderecoGerente`);

--
-- Indexes for table `tbidoso`
--
ALTER TABLE `tbidoso`
  ADD PRIMARY KEY (`codIdoso`),
  ADD KEY `codResponsavel` (`codResponsavel`),
  ADD KEY `codProntuarioFixo` (`codProntuarioFixo`);

--
-- Indexes for table `tblocomocao`
--
ALTER TABLE `tblocomocao`
  ADD PRIMARY KEY (`codLocomocao`);

--
-- Indexes for table `tbmedicacao`
--
ALTER TABLE `tbmedicacao`
  ADD PRIMARY KEY (`codMedicacao`);

--
-- Indexes for table `tbmedicacaoprontuario`
--
ALTER TABLE `tbmedicacaoprontuario`
  ADD KEY `codMedicacao` (`codMedicacao`),
  ADD KEY `codProntuario` (`codProntuarioFixo`);

--
-- Indexes for table `tbpele`
--
ALTER TABLE `tbpele`
  ADD PRIMARY KEY (`codPele`);

--
-- Indexes for table `tbprescricaoenfermagem`
--
ALTER TABLE `tbprescricaoenfermagem`
  ADD PRIMARY KEY (`codPrescricaoEnfermagem`);

--
-- Indexes for table `tbprontuariodiario`
--
ALTER TABLE `tbprontuariodiario`
  ADD PRIMARY KEY (`codProntuario`),
  ADD KEY `codIdoso` (`codIdoso`);

--
-- Indexes for table `tbprontuariofixo`
--
ALTER TABLE `tbprontuariofixo`
  ADD PRIMARY KEY (`codProntuarioFixo`),
  ADD KEY `codAntecedencia` (`codAntecedencia`),
  ADD KEY `codQuestionamento` (`codQuestionamento`),
  ADD KEY `codPele` (`codPele`),
  ADD KEY `codPulmonar` (`codPulmonar`),
  ADD KEY `codAlimentacao` (`codAlimentacao`),
  ADD KEY `codLocomocao` (`codLocomocao`),
  ADD KEY `codRelacionamento` (`codRelacionamento`),
  ADD KEY `codExame` (`codExame`),
  ADD KEY `codEliminacao` (`codEliminacao`);

--
-- Indexes for table `tbpulmonar`
--
ALTER TABLE `tbpulmonar`
  ADD PRIMARY KEY (`codPulmonar`);

--
-- Indexes for table `tbquestionamento`
--
ALTER TABLE `tbquestionamento`
  ADD PRIMARY KEY (`codQuestionamento`);

--
-- Indexes for table `tbrelacionamento`
--
ALTER TABLE `tbrelacionamento`
  ADD PRIMARY KEY (`codRelacionamento`);

--
-- Indexes for table `tbresponsavel`
--
ALTER TABLE `tbresponsavel`
  ADD PRIMARY KEY (`codResponsavel`),
  ADD UNIQUE KEY `codEnderecoResponsavel` (`codEnderecoResponsavel`);

--
-- Indexes for table `tbtelefonefuncionario`
--
ALTER TABLE `tbtelefonefuncionario`
  ADD PRIMARY KEY (`codTelefoneFuncionario`),
  ADD KEY `codFuncionario` (`codFuncionario`);

--
-- Indexes for table `tbtelefonegerente`
--
ALTER TABLE `tbtelefonegerente`
  ADD PRIMARY KEY (`codTelefoneGerente`),
  ADD KEY `codGerente` (`codGerente`);

--
-- Indexes for table `tbtelefoneresponsavel`
--
ALTER TABLE `tbtelefoneresponsavel`
  ADD PRIMARY KEY (`codTelefoneResponsavel`),
  ADD KEY `codResponsavel` (`codResponsavel`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `foto`
--
ALTER TABLE `foto`
  MODIFY `codFoto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `tbadm`
--
ALTER TABLE `tbadm`
  MODIFY `codAdm` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbalimentacao`
--
ALTER TABLE `tbalimentacao`
  MODIFY `codAlimentacao` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `tbantecedencia`
--
ALTER TABLE `tbantecedencia`
  MODIFY `codAntecedencia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT for table `tbcelularfuncionario`
--
ALTER TABLE `tbcelularfuncionario`
  MODIFY `codCelularFuncionario` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbcelulargerente`
--
ALTER TABLE `tbcelulargerente`
  MODIFY `codCelularGerente` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbcelularresponsavel`
--
ALTER TABLE `tbcelularresponsavel`
  MODIFY `codCelularResponsavel` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbdiagnosticoenfermagem`
--
ALTER TABLE `tbdiagnosticoenfermagem`
  MODIFY `codDiagnosticoEnfermagem` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbeliminacao`
--
ALTER TABLE `tbeliminacao`
  MODIFY `codEliminacao` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT for table `tbenderecofuncionario`
--
ALTER TABLE `tbenderecofuncionario`
  MODIFY `codEnderecoFuncionario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tbenderecogerente`
--
ALTER TABLE `tbenderecogerente`
  MODIFY `codEnderecoGerente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `tbenderecoresponsavel`
--
ALTER TABLE `tbenderecoresponsavel`
  MODIFY `codEnderecoResponsavel` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=213;

--
-- AUTO_INCREMENT for table `tbexame`
--
ALTER TABLE `tbexame`
  MODIFY `codExame` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `tbfuncionario`
--
ALTER TABLE `tbfuncionario`
  MODIFY `codFuncionario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbgerente`
--
ALTER TABLE `tbgerente`
  MODIFY `codGerente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tbidoso`
--
ALTER TABLE `tbidoso`
  MODIFY `codIdoso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `tblocomocao`
--
ALTER TABLE `tblocomocao`
  MODIFY `codLocomocao` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `tbmedicacao`
--
ALTER TABLE `tbmedicacao`
  MODIFY `codMedicacao` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `tbpele`
--
ALTER TABLE `tbpele`
  MODIFY `codPele` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `tbprescricaoenfermagem`
--
ALTER TABLE `tbprescricaoenfermagem`
  MODIFY `codPrescricaoEnfermagem` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbprontuariodiario`
--
ALTER TABLE `tbprontuariodiario`
  MODIFY `codProntuario` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbprontuariofixo`
--
ALTER TABLE `tbprontuariofixo`
  MODIFY `codProntuarioFixo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `tbpulmonar`
--
ALTER TABLE `tbpulmonar`
  MODIFY `codPulmonar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `tbquestionamento`
--
ALTER TABLE `tbquestionamento`
  MODIFY `codQuestionamento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `tbrelacionamento`
--
ALTER TABLE `tbrelacionamento`
  MODIFY `codRelacionamento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `tbresponsavel`
--
ALTER TABLE `tbresponsavel`
  MODIFY `codResponsavel` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `tbtelefonefuncionario`
--
ALTER TABLE `tbtelefonefuncionario`
  MODIFY `codTelefoneFuncionario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbtelefonegerente`
--
ALTER TABLE `tbtelefonegerente`
  MODIFY `codTelefoneGerente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbtelefoneresponsavel`
--
ALTER TABLE `tbtelefoneresponsavel`
  MODIFY `codTelefoneResponsavel` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `foto`
--
ALTER TABLE `foto`
  ADD CONSTRAINT `foto_ibfk_1` FOREIGN KEY (`codGerente`) REFERENCES `tbgerente` (`codGerente`),
  ADD CONSTRAINT `foto_ibfk_2` FOREIGN KEY (`codFuncionario`) REFERENCES `tbfuncionario` (`codFuncionario`),
  ADD CONSTRAINT `foto_ibfk_3` FOREIGN KEY (`codResponsavel`) REFERENCES `tbresponsavel` (`codResponsavel`);

--
-- Limitadores para a tabela `tbcelularfuncionario`
--
ALTER TABLE `tbcelularfuncionario`
  ADD CONSTRAINT `tbcelularfuncionario_ibfk_1` FOREIGN KEY (`codFuncionario`) REFERENCES `tbfuncionario` (`codFuncionario`);

--
-- Limitadores para a tabela `tbcelulargerente`
--
ALTER TABLE `tbcelulargerente`
  ADD CONSTRAINT `tbcelulargerente_ibfk_1` FOREIGN KEY (`codGerente`) REFERENCES `tbgerente` (`codGerente`);

--
-- Limitadores para a tabela `tbcelularresponsavel`
--
ALTER TABLE `tbcelularresponsavel`
  ADD CONSTRAINT `tbcelularresponsavel_ibfk_1` FOREIGN KEY (`codResponsavel`) REFERENCES `tbresponsavel` (`codResponsavel`);

--
-- Limitadores para a tabela `tbfuncionario`
--
ALTER TABLE `tbfuncionario`
  ADD CONSTRAINT `tbfuncionario_ibfk_1` FOREIGN KEY (`codGerente`) REFERENCES `tbgerente` (`codGerente`),
  ADD CONSTRAINT `tbfuncionario_ibfk_2` FOREIGN KEY (`codTelefoneFuncionario`) REFERENCES `tbtelefonefuncionario` (`codTelefoneFuncionario`),
  ADD CONSTRAINT `tbfuncionario_ibfk_3` FOREIGN KEY (`codEnderecoFuncionario`) REFERENCES `tbenderecofuncionario` (`codEnderecoFuncionario`),
  ADD CONSTRAINT `tbfuncionario_ibfk_4` FOREIGN KEY (`codCelularFuncionario`) REFERENCES `tbcelularfuncionario` (`codCelularFuncionario`);

--
-- Limitadores para a tabela `tbgerente`
--
ALTER TABLE `tbgerente`
  ADD CONSTRAINT `tbgerente_ibfk_2` FOREIGN KEY (`codEnderecoGerente`) REFERENCES `tbenderecogerente` (`codEnderecoGerente`);

--
-- Limitadores para a tabela `tbidoso`
--
ALTER TABLE `tbidoso`
  ADD CONSTRAINT `tbidoso_ibfk_1` FOREIGN KEY (`codResponsavel`) REFERENCES `tbresponsavel` (`codResponsavel`),
  ADD CONSTRAINT `tbidoso_ibfk_2` FOREIGN KEY (`codProntuarioFixo`) REFERENCES `tbprontuariofixo` (`codProntuarioFixo`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `tbmedicacaoprontuario`
--
ALTER TABLE `tbmedicacaoprontuario`
  ADD CONSTRAINT `tbmedicacaoprontuario_ibfk_1` FOREIGN KEY (`codMedicacao`) REFERENCES `tbmedicacao` (`codMedicacao`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbmedicacaoprontuario_ibfk_2` FOREIGN KEY (`codProntuarioFixo`) REFERENCES `tbprontuariofixo` (`codProntuarioFixo`) ON UPDATE CASCADE;

--
-- Limitadores para a tabela `tbprontuariodiario`
--
ALTER TABLE `tbprontuariodiario`
  ADD CONSTRAINT `tbprontuariodiario_ibfk_1` FOREIGN KEY (`codIdoso`) REFERENCES `tbidoso` (`codIdoso`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `tbprontuariofixo`
--
ALTER TABLE `tbprontuariofixo`
  ADD CONSTRAINT `tbprontuariofixo_ibfk_1` FOREIGN KEY (`codAlimentacao`) REFERENCES `tbalimentacao` (`codAlimentacao`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbprontuariofixo_ibfk_10` FOREIGN KEY (`codRelacionamento`) REFERENCES `tbrelacionamento` (`codRelacionamento`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbprontuariofixo_ibfk_2` FOREIGN KEY (`codAntecedencia`) REFERENCES `tbantecedencia` (`codAntecedencia`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbprontuariofixo_ibfk_3` FOREIGN KEY (`codEliminacao`) REFERENCES `tbeliminacao` (`codEliminacao`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbprontuariofixo_ibfk_4` FOREIGN KEY (`codExame`) REFERENCES `tbexame` (`codExame`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbprontuariofixo_ibfk_5` FOREIGN KEY (`codLocomocao`) REFERENCES `tblocomocao` (`codLocomocao`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbprontuariofixo_ibfk_7` FOREIGN KEY (`codPele`) REFERENCES `tbpele` (`codPele`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbprontuariofixo_ibfk_8` FOREIGN KEY (`codPulmonar`) REFERENCES `tbpulmonar` (`codPulmonar`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbprontuariofixo_ibfk_9` FOREIGN KEY (`codQuestionamento`) REFERENCES `tbquestionamento` (`codQuestionamento`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `tbresponsavel`
--
ALTER TABLE `tbresponsavel`
  ADD CONSTRAINT `tbresponsavel_ibfk_1` FOREIGN KEY (`codEnderecoResponsavel`) REFERENCES `tbenderecoresponsavel` (`codEnderecoResponsavel`);

--
-- Limitadores para a tabela `tbtelefonefuncionario`
--
ALTER TABLE `tbtelefonefuncionario`
  ADD CONSTRAINT `tbtelefonefuncionario_ibfk_1` FOREIGN KEY (`codFuncionario`) REFERENCES `tbfuncionario` (`codFuncionario`);

--
-- Limitadores para a tabela `tbtelefonegerente`
--
ALTER TABLE `tbtelefonegerente`
  ADD CONSTRAINT `tbtelefonegerente_ibfk_1` FOREIGN KEY (`codGerente`) REFERENCES `tbgerente` (`codGerente`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
