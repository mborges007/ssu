-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 12/12/2023 às 20:04
-- Versão do servidor: 10.4.28-MariaDB
-- Versão do PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

CREATE DATABASE SSU;
USE SSU;

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `ssu`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `agendamento`
--

CREATE TABLE `agendamento` (
  `id_agendamento` int(11) NOT NULL,
  `data_consulta` date NOT NULL,
  `id_paciente` int(11) NOT NULL,
  `hora_consulta` time NOT NULL,
  `id_unidade` int(11) NOT NULL,
  `id_medico` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `especialidades`
--

CREATE TABLE `especialidades` (
  `descricao` varchar(20) NOT NULL,
  `ID` int(10) NOT NULL,
  `qtde_cadastro` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `especialidades`
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
-- Estrutura para tabela `medicos`
--

CREATE TABLE `medicos` (
  `nome` varchar(30) NOT NULL,
  `ID` int(10) NOT NULL,
  `CRM` varchar(10) NOT NULL,
  `Cidade` varchar(30) NOT NULL,
  `id_especialidade` int(10) NOT NULL,
  `id_unidade` INT(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Copiando estrutura para procedure ssu.ObterHorariosConsulta
DELIMITER //
CREATE PROCEDURE `ObterHorariosConsulta`(
	IN `medico_id` INT,
	IN `data` VARCHAR(20)
)
BEGIN
    SELECT hora_consulta
    FROM agendamentos
    WHERE id_medico = medico_id AND data_consulta = data;
END//
DELIMITER ;

-- Copiando estrutura para função ssu.AgendarConsulta
DELIMITER //
CREATE FUNCTION `AgendarConsulta`(
    p_data_consulta varchar(20),
    p_id_medico int,
    p_id_paciente varchar(20),
    p_hora_consulta varchar(20)
) RETURNS int
    DETERMINISTIC
BEGIN
    DECLARE agendamento_id INT;
    DECLARE unidade INT;
    
    SELECT id_unidade INTO unidade FROM medicos WHERE ID = p_id_medico;

    -- Insere o agendamento na tabela
    INSERT INTO agendamento (data_consulta, id_medico, id_paciente, hora_consulta, id_unidade)
    VALUES (p_data_consulta, p_id_medico, p_id_paciente, p_hora_consulta, unidade);

    -- Obtém o ID do agendamento recém-criado
    SET agendamento_id = LAST_INSERT_ID();

    RETURN agendamento_id;
END//
DELIMITER ;

--
-- Despejando dados para a tabela `medicos`
--

INSERT INTO `medicos` (`nome`, `ID`, `CRM`, `Cidade`, `id_especialidade`, `id_unidade`) VALUES
('Nelson Dimas Brambilla', 1, '42.929', 'Leme', 2, 1),
('Oswaldo Colombini Neto', 2, '108.472', 'Araras', 2, 4),
('Ana Paula Delgado', 3, '90.376', 'Araras', 4, 4),
('Bruno Appolari', 4, '151.650', 'Leme', 9, 5),
('Selma Lara Teixeira ', 5, '54.435', 'Araras', 4, 3),
('Rodrigo Dias da Costa', 6, '147.809', 'Leme', 2, 9),
('Jean Tonelli', 7, '95.053', 'Araras', 9, 7),
('Jardel Dair Filho', 8, '107.804', 'Araras', 4, 6),
('Fabio Volpon Santos', 9, '67.729', 'Araras', 9, 3);

-- --------------------------------------------------------

--
-- Estrutura para tabela `pacientes`
--

CREATE TABLE `pacientes` (
  `nome` varchar(30) NOT NULL,
  `cpf` varchar(15) NOT NULL,
  `telefone` varchar(15) NOT NULL,
  `data_nasc` varchar(15) NOT NULL,
  `sexo` char(1) NOT NULL,
  `endereco` varchar(40) DEFAULT NULL,
  `numero` int(5) DEFAULT NULL,
  `bairro` varchar(40) DEFAULT NULL,
  `cidade` varchar(50) DEFAULT NULL,
  `email` varchar(35) NOT NULL,
  `senha` varchar(8) NOT NULL,
  `registro` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `pacientes`
--

INSERT INTO `pacientes` (`nome`, `cpf`, `telefone`, `data_nasc`, `sexo`, `endereco`, `numero`, `bairro`, `cidade`, `email`, `senha`, `registro`) VALUES
('Marco Antonio Amorim', '555.444.555-13', '(28)96631-5632', '02/02/2003', 'm', 'Rua Villa Lobo', 232, 'jd candida', 'Araras', 'amorimantonio@gmail.com', '123', 1),
('Vitor Manoel Martins', '555.422.555-13', '(28)3356-2363', '16/01/2001', 'm', 'AV. Zenatte Luiz', 555, 'belvedere', 'Araras', 'vmm@gmail.com', '123', 2),
('João Pacolla', '554.444.555-13', '(19)93625-1236', '23/06/1999', 'm', 'Rua Luiz Amorim', 777, 'xxxxx', 'Araras', 'pacollajoao@hotmail.com', '123', 3),
('igor ferreira', '666.444.555-13', '(19)99548-5536', '02/10/2003', 'm', 'Rua Alfândega Moraes', 888, 'qqqqq', 'Araras', 'igorferreira@gmail.com', '123', 4),
('Luana Marques', '111.444.555-13', '(19)99876-8737', '20-03-2001', 'f', 'AV. Silva Lastoria', 666, 'eeee', 'Araras', 'lmarques@gmail.com', '123', 5),
('Eryck Ribeiro', '222.444.555-13', '(19)99156-6456', '31-03-2005', 'm', 'Rua Carlos Albers', 444, 'rrrr', 'Araras', 'eryckLR@gmail.com', '123', 6),
('Maikon Gino', '555.444.111-13', '(28)99685-5632', '17-08-1990', 'm', 'Av Ribeiro', 111, 'oooooo', 'Araras', 'mgino@gmail.com', '123', 8);

-- --------------------------------------------------------

--
-- Estrutura para tabela `unidades`
--

CREATE TABLE `unidades` (
  `endereco` varchar(40) NOT NULL,
  `qtde_medicos` int(10) NOT NULL,
  `telefone` varchar(15) NOT NULL,
  `cidade` varchar(30) NOT NULL,
  `ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `unidades`
--

INSERT INTO `unidades` (`endereco`, `qtde_medicos`, `telefone`, `cidade`, `ID`) VALUES
('R. Carlos Andrade Ribeiro', 5, '(19)335-6325', 'Leme', 1),
('Av Luiz Andrade', 8, '(35)99632-2356', 'Leme', 2),
('Rua Ribeiro da Silva', 3, '(19)3652-9698', 'Araras', 3),
('Av. Augusta Viola da Costa', 8, '(19)3586-3256', 'Araras', 4),
('Rua Santos Dumont', 12, '(19)99863-2356', 'Araras', 5),
('Rua Brasília', 5, '(19)3562-7536', 'Leme', 6),
('Av. Carlos Bonfanti', 5, '(19)9632-9632', 'Araras', 7),
('Rua Barão de Arary', 7, '(19)3542-9988', 'Leme', 8),
('Rua Domingos Graziano', 10, '(19)3541-8523', 'Araras', 9),
('Rua Emilio Ferreira', 10, '(19)3652-9632', 'Araras', 10);

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `agendamento`
--
ALTER TABLE `agendamento`
  ADD PRIMARY KEY (`id_agendamento`),
  ADD KEY `FK_agendamentos_pacientes` (`id_paciente`),
  ADD KEY `FK_agendamentos_unidades` (`id_unidade`),
  ADD KEY `FK_agendamentos_medico` (`id_medico`);

--
-- Índices de tabela `especialidades`
--
ALTER TABLE `especialidades`
  ADD PRIMARY KEY (`ID`) USING BTREE;

--
-- Índices de tabela `medicos`
--
ALTER TABLE `medicos`
  ADD PRIMARY KEY (`ID`) USING BTREE,
  ADD KEY `FK_medicos_especialidades` (`id_especialidade`),
  ADD KEY `FK_medicos_unidade` (`id_unidade`);


--
-- Índices de tabela `pacientes`
--
ALTER TABLE `pacientes`
  ADD PRIMARY KEY (`registro`);

--
-- Índices de tabela `unidades`
--
ALTER TABLE `unidades`
  ADD PRIMARY KEY (`ID`) USING BTREE;

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `agendamento`
--
ALTER TABLE `agendamento`
  MODIFY `id_agendamento` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `especialidades`
--
ALTER TABLE `especialidades`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de tabela `medicos`
--
ALTER TABLE `medicos`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de tabela `pacientes`
--
ALTER TABLE `pacientes`
  MODIFY `registro` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de tabela `unidades`
--
ALTER TABLE `unidades`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `agendamento`
--
ALTER TABLE `agendamento`
  ADD CONSTRAINT `FK_agendamentos_pacientes` FOREIGN KEY (`id_paciente`) REFERENCES `pacientes` (`registro`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_agendamentos_unidades` FOREIGN KEY (`id_unidade`) REFERENCES `unidades` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_agendamentos_medico` FOREIGN KEY (`id_medico`) REFERENCES `medicos` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Restrições para tabelas `medicos`
--
ALTER TABLE `medicos`
  ADD CONSTRAINT `FK_medicos_especialidades` FOREIGN KEY (`id_especialidade`) REFERENCES `especialidades` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_medicos_unidade` FOREIGN KEY (`id_unidade`) REFERENCES `unidades` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
