-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 28-Nov-2023 às 00:08
-- Versão do servidor: 10.4.13-MariaDB
-- versão do PHP: 7.4.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `ssu`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `agendamentos`
--

CREATE TABLE `agendamentos` (
  `data_consulta` varchar(20) NOT NULL,
  `id_medico` int(15) NOT NULL,
  `id_paciente` varchar(20) NOT NULL DEFAULT '',
  `hora_consulta` varchar(20) NOT NULL DEFAULT '',
  `id_unidade` int(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `especialidades`
--

CREATE TABLE `especialidades` (
  `descricao` varchar(20) NOT NULL,
  `ID` int(10) NOT NULL,
  `qtde_cadastro` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `especialidades`
--

INSERT INTO `especialidades` (`descricao`, `ID`, `qtde_cadastro`) VALUES
('Cardiologia', 1, 7),
('Cirurgia Geral', 2, 5),
('Cirugia Plástica', 3, 3),
('Dermatologia', 4, 5),
('Endocrinologia', 5, 4),
('Geriatria', 6, 3),
('Ginecologia', 7, 10),
('Neurologia', 8, 4),
('Ortopedia', 9, 3);

-- --------------------------------------------------------

--
-- Estrutura da tabela `medicos`
--

CREATE TABLE `medicos` (
  `nome` varchar(30) NOT NULL,
  `ID` int(10) NOT NULL,
  `CRM` varchar(10) NOT NULL,
  `id_especialidade` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `medicos`
--

INSERT INTO `medicos` (`nome`, `ID`, `CRM`, `id_especialidade`) VALUES
('Nelson Dimas Brambilla', 1, '42.929', 2),
('Oswaldo Colombini Neto', 2, '108.472', 2),
('Ana Paula Delgado', 3, '90.376', 4),
('Bruno Appolari', 4, '151.650', 9),
('Selma Lara Teixeira ', 5, '54.435', 4),
('Rodrigo Dias da Costa', 6, '147.809', 2),
('Jean Tonelli', 7, '95.053', 9),
('Jardel Dair Filho', 8, '107.804', 4),
('Fabio Volpon Santos', 9, '67.729', 9);

-- --------------------------------------------------------

--
-- Estrutura da tabela `pacientes`
--

CREATE TABLE `pacientes` (
  `nome` varchar(30) NOT NULL,
  `cpf` varchar(15) NOT NULL,
  `telefone` varchar(15) NOT NULL,
  `data_nasc` varchar(15) NOT NULL,
  `sexo` char(1) NOT NULL,
  `endereco` varchar(40) NOT NULL,
  `numero` int(5) NOT NULL,
  `bairro` varchar(40) NOT NULL,
  `cidade` varchar(50) NOT NULL,
  `email` varchar(35) NOT NULL,
  `senha` varchar(8) NOT NULL,
  `registro` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `pacientes`
--

INSERT INTO `pacientes` (`nome`, `cpf`, `telefone`, `data_nasc`, `sexo`, `endereco`, `numero`, `bairro`, `cidade`, `email`, `senha`, `registro`) VALUES
('Marco Antonio Amorim', '555.444.555-13', '(28)96631-5632', '02/02/2003', 'm', 'Rua Villa Lobo', 232, 'jd candida', 'Araras', 'amorimantonio@gmail.com', '123', '1'),
('Vitor Manoel Martins', '555.422.555-13', '(28)3356-2363', '16/01/2001', 'm', 'AV. Zenatte Luiz', 555, 'belvedere', 'Araras', 'vmm@gmail.com', '123', '2'),
('João Pacolla', '554.444.555-13', '(19)93625-1236', '23/06/1999', 'm', 'Rua Luiz Amorim', 777, 'xxxxx', 'Araras', 'pacollajoao@hotmail.com', '123', '3'),
('igor ferreira', '666.444.555-13', '(19)99548-5536', '02/10/2003', 'm', 'Rua Alfândega Moraes', 888, 'qqqqq', 'Araras', 'igorferreira@gmail.com', '123', '4'),
('Luana Marques', '111.444.555-13', '(19)99876-8737', '20-03-2001', 'f', 'AV. Silva Lastoria', 666, 'eeee', 'Araras', 'lmarques@gmail.com', '123', '5'),
('Eryck Ribeiro', '222.444.555-13', '(19)99156-6456', '31-03-2005', 'm', 'Rua Carlos Albers', 444, 'rrrr', 'Araras', 'eryckLR@gmail.com', '123', '6'),
('Maikon Gino', '555.444.111-13', '(28)99685-5632', '17-08-1990', 'm', 'Av Ribeiro', 111, 'oooooo', 'Araras', 'mgino@gmail.com', '123', '8');

-- --------------------------------------------------------

--
-- Estrutura da tabela `unidades`
--

CREATE TABLE `unidades` (
  `endereco` varchar(40) NOT NULL,
  `qtde_medicos` int(10) NOT NULL,
  `telefone` varchar(15) NOT NULL,
  `cidade` varchar(30) NOT NULL,
  `ID` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `unidades`
--

INSERT INTO `unidades` (`endereco`, `qtde_medicos`, `telefone`, `ID`) VALUES
('R. Carlos Andrade Ribeiro', 5, '(19)335-6325', 'LEME', 1),
('Av Luiz Andrade', 8, '(35)99632-2356', 'LEME', 2),
('Rua Ribeiro da Silva', 3, '(19)3652-9698', 'ARARAS', 3),
('Av. Augusta Viola da Costa', 8, '(19)3586-3256', 'ARARAS', 4),
('Rua Santos Dumont', 12, '(19)99863-2356', 'ARARAS', 5),
('Rua Brasília', 5, '(19)3562-7536', 'LEME', 6),
('Av. Carlos Bonfanti', 5, '(19)9632-9632', 'ARARAS', 7),
('Rua Barão de Arary', 7, '(19)3542-9988', 'LEME', 8),
('Rua Domingos Graziano', 10, '(19)3541-8523', 'ARARAS', 9),
('Rua Emilio Ferreira', 10, '(19)3652-9632', 'ARARAS', 10);

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `agendamentos`
--
ALTER TABLE `agendamentos`
  ADD KEY `FK_agendamentos_medicos` (`id_medico`),
  ADD KEY `FK_agendamentos_pacientes` (`id_paciente`),
  ADD KEY `FK_agendamentos_unidades` (`id_unidade`);

--
-- Índices para tabela `especialidades`
--
ALTER TABLE `especialidades`
  ADD PRIMARY KEY (`ID`) USING BTREE;

--
-- Índices para tabela `medicos`
--
ALTER TABLE `medicos`
  ADD PRIMARY KEY (`ID`) USING BTREE,
  ADD KEY `FK_medicos_especialidades` (`id_especialidade`);

--
-- Índices para tabela `pacientes`
--
ALTER TABLE `pacientes`
  ADD PRIMARY KEY (`registro`);

--
-- Índices para tabela `unidades`
--
ALTER TABLE `unidades`
  ADD PRIMARY KEY (`ID`) USING BTREE;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `agendamentos`
--
ALTER TABLE `agendamentos`
  ADD CONSTRAINT `FK_agendamentos_medicos` FOREIGN KEY (`id_medico`) REFERENCES `medicos` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_agendamentos_pacientes` FOREIGN KEY (`id_paciente`) REFERENCES `pacientes` (`registro`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_agendamentos_unidades` FOREIGN KEY (`id_unidade`) REFERENCES `unidades` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `medicos`
--
ALTER TABLE `medicos`
  ADD CONSTRAINT `FK_medicos_especialidades` FOREIGN KEY (`id_especialidade`) REFERENCES `especialidades` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
