-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 30-Jul-2019 às 10:38
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
-- Database: `bdcareasy`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbcelularfuncionario`
--

CREATE TABLE `tbcelularfuncionario` (
  `codCelularFuncionario` int(11) NOT NULL,
  `numeroCelularFuncionario` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbcelulargerente`
--

CREATE TABLE `tbcelulargerente` (
  `codCelularGerente` int(11) NOT NULL,
  `numeroCelularGerente` int(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbcelularidoso`
--

CREATE TABLE `tbcelularidoso` (
  `codCelularIdoso` int(11) NOT NULL,
  `numeroCelularIdoso` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbcelularresponsavel`
--

CREATE TABLE `tbcelularresponsavel` (
  `codCelularResponsavel` int(11) NOT NULL,
  `numeroCelularResponsavel` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbenderecoidoso`
--

CREATE TABLE `tbenderecoidoso` (
  `codEnderecoIdoso` int(11) NOT NULL,
  `ruaEnderecoIdoso` varchar(100) NOT NULL,
  `bairroEnderecoIdoso` varchar(100) NOT NULL,
  `cepEnderecoIdoso` varchar(9) NOT NULL,
  `numCasaEnderecoIdoso` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbfuncionario`
--

CREATE TABLE `tbfuncionario` (
  `codFuncionario` int(11) NOT NULL,
  `nomeFuncionario` varchar(40) NOT NULL,
  `cpfFuncionario` varchar(11) NOT NULL,
  `sexoFuncionario` varchar(3) NOT NULL,
  `nascFuncionario` date NOT NULL,
  `salarioFuncionario` decimal(10,0) NOT NULL,
  `codEnderecoFuncionario` int(11) NOT NULL,
  `codTelefoneFuncionario` int(11) DEFAULT NULL,
  `codCelularFuncionario` int(11) DEFAULT NULL,
  `codGerente` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbgerente`
--

CREATE TABLE `tbgerente` (
  `codGerente` int(11) NOT NULL,
  `nomeGerente` varchar(40) NOT NULL,
  `cpfGerente` varchar(11) NOT NULL,
  `sexoGerente` varchar(3) NOT NULL,
  `NascGerente` date NOT NULL,
  `salarioGerente` decimal(10,0) NOT NULL,
  `codEnderecoGerente` int(11) NOT NULL,
  `codTelefoneGerente` int(11) NOT NULL,
  `codCelularGerente` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbidoso`
--

CREATE TABLE `tbidoso` (
  `codIdoso` int(11) NOT NULL,
  `idadeIdoso` int(4) NOT NULL,
  `nomeIdoso` varchar(40) NOT NULL,
  `sexoIdoso` varchar(4) NOT NULL,
  `cpfIdoso` varchar(11) NOT NULL,
  `nascIdoso` date NOT NULL,
  `codEnderecoIdoso` int(11) NOT NULL,
  `codTelefoneIdoso` int(11) DEFAULT NULL,
  `codCelularIdoso` int(11) DEFAULT NULL,
  `codRotina` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbidosofuncionario`
--

CREATE TABLE `tbidosofuncionario` (
  `codIdosoFuncionario` int(11) NOT NULL,
  `codIdoso` int(11) NOT NULL,
  `codFuncionario` int(11) NOT NULL,
  `quantidadeFuncionario` int(3) NOT NULL,
  `quantidadeIdoso` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbmedicacao`
--

CREATE TABLE `tbmedicacao` (
  `codMedicacao` int(11) NOT NULL,
  `nomeMedicacao` varchar(50) NOT NULL,
  `horarioMedicacao` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbmedicacaoidoso`
--

CREATE TABLE `tbmedicacaoidoso` (
  `codMedicacaoIdoso` int(11) NOT NULL,
  `codMedicacao` int(11) NOT NULL,
  `codIdoso` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbresponsavel`
--

CREATE TABLE `tbresponsavel` (
  `codResponsavel` int(11) NOT NULL,
  `idadeResponsavel` int(4) NOT NULL,
  `nomeResponsavel` varchar(40) NOT NULL,
  `cpfResponsavel` varchar(11) NOT NULL,
  `sexoResponsavel` varchar(3) NOT NULL,
  `nascResponsavel` date NOT NULL,
  `salarioResponsavel` decimal(10,0) NOT NULL,
  `codEnderecoResponsavel` int(11) NOT NULL,
  `codTelefoneResponsavel` int(11) DEFAULT NULL,
  `codCelularResponsavel` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbresponsavelidoso`
--

CREATE TABLE `tbresponsavelidoso` (
  `codResponsavelIdoso` int(11) NOT NULL,
  `codResponsavel` int(11) NOT NULL,
  `codIdoso` int(11) NOT NULL,
  `quantidadeIdoso` int(3) NOT NULL,
  `quantidadeResponsavel` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbrotina`
--

CREATE TABLE `tbrotina` (
  `codRotina` int(11) NOT NULL,
  `nomeRotina` varchar(50) NOT NULL,
  `descRotina` varchar(400) NOT NULL,
  `horarioRotina` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbtelefonefuncionario`
--

CREATE TABLE `tbtelefonefuncionario` (
  `codTelefoneFuncionario` int(11) NOT NULL,
  `numeroTelefoneFuncionario` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbtelefonegerente`
--

CREATE TABLE `tbtelefonegerente` (
  `codTelefoneGerente` int(11) NOT NULL,
  `numeroTelefoneGerente` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbtelefoneidoso`
--

CREATE TABLE `tbtelefoneidoso` (
  `codTelefoneIdoso` int(11) NOT NULL,
  `numeroTelefoneIdoso` int(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbtelefoneresponsavel`
--

CREATE TABLE `tbtelefoneresponsavel` (
  `codTelefoneResponsavel` int(11) NOT NULL,
  `numeroTelefoneResponsavel` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbcelularfuncionario`
--
ALTER TABLE `tbcelularfuncionario`
  ADD PRIMARY KEY (`codCelularFuncionario`);

--
-- Indexes for table `tbcelulargerente`
--
ALTER TABLE `tbcelulargerente`
  ADD PRIMARY KEY (`codCelularGerente`);

--
-- Indexes for table `tbcelularidoso`
--
ALTER TABLE `tbcelularidoso`
  ADD PRIMARY KEY (`codCelularIdoso`);

--
-- Indexes for table `tbcelularresponsavel`
--
ALTER TABLE `tbcelularresponsavel`
  ADD PRIMARY KEY (`codCelularResponsavel`);

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
-- Indexes for table `tbenderecoidoso`
--
ALTER TABLE `tbenderecoidoso`
  ADD PRIMARY KEY (`codEnderecoIdoso`);

--
-- Indexes for table `tbenderecoresponsavel`
--
ALTER TABLE `tbenderecoresponsavel`
  ADD PRIMARY KEY (`codEnderecoResponsavel`);

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
  ADD UNIQUE KEY `codEnderecoGerente` (`codEnderecoGerente`),
  ADD KEY `codTelefoneGerente` (`codTelefoneGerente`),
  ADD KEY `codCelularGerente` (`codCelularGerente`);

--
-- Indexes for table `tbidoso`
--
ALTER TABLE `tbidoso`
  ADD PRIMARY KEY (`codIdoso`),
  ADD UNIQUE KEY `codEnderecoIdoso` (`codEnderecoIdoso`),
  ADD UNIQUE KEY `codRotina` (`codRotina`),
  ADD KEY `codTelefoneIdoso` (`codTelefoneIdoso`),
  ADD KEY `codCelularIdoso` (`codCelularIdoso`);

--
-- Indexes for table `tbidosofuncionario`
--
ALTER TABLE `tbidosofuncionario`
  ADD PRIMARY KEY (`codIdosoFuncionario`),
  ADD KEY `codIdoso` (`codIdoso`),
  ADD KEY `codFuncionario` (`codFuncionario`);

--
-- Indexes for table `tbmedicacao`
--
ALTER TABLE `tbmedicacao`
  ADD PRIMARY KEY (`codMedicacao`);

--
-- Indexes for table `tbmedicacaoidoso`
--
ALTER TABLE `tbmedicacaoidoso`
  ADD PRIMARY KEY (`codMedicacaoIdoso`),
  ADD KEY `codMedicacao` (`codMedicacao`),
  ADD KEY `codIdoso` (`codIdoso`);

--
-- Indexes for table `tbresponsavel`
--
ALTER TABLE `tbresponsavel`
  ADD PRIMARY KEY (`codResponsavel`),
  ADD UNIQUE KEY `codEnderecoResponsavel` (`codEnderecoResponsavel`),
  ADD KEY `codTelefoneResponsavel` (`codTelefoneResponsavel`),
  ADD KEY `codCelularResponsavel` (`codCelularResponsavel`);

--
-- Indexes for table `tbresponsavelidoso`
--
ALTER TABLE `tbresponsavelidoso`
  ADD PRIMARY KEY (`codResponsavelIdoso`),
  ADD KEY `codResponsavel` (`codResponsavel`),
  ADD KEY `codIdoso` (`codIdoso`);

--
-- Indexes for table `tbrotina`
--
ALTER TABLE `tbrotina`
  ADD PRIMARY KEY (`codRotina`);

--
-- Indexes for table `tbtelefonefuncionario`
--
ALTER TABLE `tbtelefonefuncionario`
  ADD PRIMARY KEY (`codTelefoneFuncionario`);

--
-- Indexes for table `tbtelefonegerente`
--
ALTER TABLE `tbtelefonegerente`
  ADD PRIMARY KEY (`codTelefoneGerente`);

--
-- Indexes for table `tbtelefoneidoso`
--
ALTER TABLE `tbtelefoneidoso`
  ADD PRIMARY KEY (`codTelefoneIdoso`);

--
-- Indexes for table `tbtelefoneresponsavel`
--
ALTER TABLE `tbtelefoneresponsavel`
  ADD PRIMARY KEY (`codTelefoneResponsavel`);

--
-- AUTO_INCREMENT for dumped tables
--

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
-- AUTO_INCREMENT for table `tbcelularidoso`
--
ALTER TABLE `tbcelularidoso`
  MODIFY `codCelularIdoso` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbcelularresponsavel`
--
ALTER TABLE `tbcelularresponsavel`
  MODIFY `codCelularResponsavel` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbenderecofuncionario`
--
ALTER TABLE `tbenderecofuncionario`
  MODIFY `codEnderecoFuncionario` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbenderecogerente`
--
ALTER TABLE `tbenderecogerente`
  MODIFY `codEnderecoGerente` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbenderecoidoso`
--
ALTER TABLE `tbenderecoidoso`
  MODIFY `codEnderecoIdoso` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbenderecoresponsavel`
--
ALTER TABLE `tbenderecoresponsavel`
  MODIFY `codEnderecoResponsavel` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbfuncionario`
--
ALTER TABLE `tbfuncionario`
  MODIFY `codFuncionario` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbgerente`
--
ALTER TABLE `tbgerente`
  MODIFY `codGerente` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbidoso`
--
ALTER TABLE `tbidoso`
  MODIFY `codIdoso` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbidosofuncionario`
--
ALTER TABLE `tbidosofuncionario`
  MODIFY `codIdosoFuncionario` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbmedicacao`
--
ALTER TABLE `tbmedicacao`
  MODIFY `codMedicacao` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbmedicacaoidoso`
--
ALTER TABLE `tbmedicacaoidoso`
  MODIFY `codMedicacaoIdoso` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbresponsavel`
--
ALTER TABLE `tbresponsavel`
  MODIFY `codResponsavel` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbresponsavelidoso`
--
ALTER TABLE `tbresponsavelidoso`
  MODIFY `codResponsavelIdoso` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbrotina`
--
ALTER TABLE `tbrotina`
  MODIFY `codRotina` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbtelefonefuncionario`
--
ALTER TABLE `tbtelefonefuncionario`
  MODIFY `codTelefoneFuncionario` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbtelefonegerente`
--
ALTER TABLE `tbtelefonegerente`
  MODIFY `codTelefoneGerente` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbtelefoneidoso`
--
ALTER TABLE `tbtelefoneidoso`
  MODIFY `codTelefoneIdoso` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbtelefoneresponsavel`
--
ALTER TABLE `tbtelefoneresponsavel`
  MODIFY `codTelefoneResponsavel` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

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
  ADD CONSTRAINT `tbgerente_ibfk_1` FOREIGN KEY (`codCelularGerente`) REFERENCES `tbcelulargerente` (`codCelularGerente`),
  ADD CONSTRAINT `tbgerente_ibfk_2` FOREIGN KEY (`codEnderecoGerente`) REFERENCES `tbenderecogerente` (`codEnderecoGerente`),
  ADD CONSTRAINT `tbgerente_ibfk_3` FOREIGN KEY (`codTelefoneGerente`) REFERENCES `tbtelefonegerente` (`codTelefoneGerente`);

--
-- Limitadores para a tabela `tbidoso`
--
ALTER TABLE `tbidoso`
  ADD CONSTRAINT `tbidoso_ibfk_1` FOREIGN KEY (`codCelularIdoso`) REFERENCES `tbcelularidoso` (`codCelularIdoso`),
  ADD CONSTRAINT `tbidoso_ibfk_2` FOREIGN KEY (`codEnderecoIdoso`) REFERENCES `tbenderecoidoso` (`codEnderecoIdoso`),
  ADD CONSTRAINT `tbidoso_ibfk_3` FOREIGN KEY (`codRotina`) REFERENCES `tbrotina` (`codRotina`),
  ADD CONSTRAINT `tbidoso_ibfk_4` FOREIGN KEY (`codTelefoneIdoso`) REFERENCES `tbtelefoneidoso` (`codTelefoneIdoso`);

--
-- Limitadores para a tabela `tbidosofuncionario`
--
ALTER TABLE `tbidosofuncionario`
  ADD CONSTRAINT `tbidosofuncionario_ibfk_1` FOREIGN KEY (`codFuncionario`) REFERENCES `tbfuncionario` (`codFuncionario`),
  ADD CONSTRAINT `tbidosofuncionario_ibfk_2` FOREIGN KEY (`codIdoso`) REFERENCES `tbidoso` (`codIdoso`);

--
-- Limitadores para a tabela `tbmedicacaoidoso`
--
ALTER TABLE `tbmedicacaoidoso`
  ADD CONSTRAINT `tbmedicacaoidoso_ibfk_1` FOREIGN KEY (`codMedicacao`) REFERENCES `tbmedicacao` (`codMedicacao`),
  ADD CONSTRAINT `tbmedicacaoidoso_ibfk_2` FOREIGN KEY (`codIdoso`) REFERENCES `tbidoso` (`codIdoso`);

--
-- Limitadores para a tabela `tbresponsavel`
--
ALTER TABLE `tbresponsavel`
  ADD CONSTRAINT `tbresponsavel_ibfk_1` FOREIGN KEY (`codCelularResponsavel`) REFERENCES `tbcelularresponsavel` (`codCelularResponsavel`),
  ADD CONSTRAINT `tbresponsavel_ibfk_2` FOREIGN KEY (`codEnderecoResponsavel`) REFERENCES `tbenderecoresponsavel` (`codEnderecoResponsavel`),
  ADD CONSTRAINT `tbresponsavel_ibfk_3` FOREIGN KEY (`codTelefoneResponsavel`) REFERENCES `tbtelefoneresponsavel` (`codTelefoneResponsavel`);

--
-- Limitadores para a tabela `tbresponsavelidoso`
--
ALTER TABLE `tbresponsavelidoso`
  ADD CONSTRAINT `tbresponsavelidoso_ibfk_1` FOREIGN KEY (`codIdoso`) REFERENCES `tbidoso` (`codIdoso`),
  ADD CONSTRAINT `tbresponsavelidoso_ibfk_2` FOREIGN KEY (`codResponsavel`) REFERENCES `tbresponsavel` (`codResponsavel`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
