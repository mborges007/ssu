-- --------------------------------------------------------
-- Servidor:                     127.0.0.1
-- Versão do servidor:           8.0.34 - MySQL Community Server - GPL
-- OS do Servidor:               Win64
-- HeidiSQL Versão:              12.5.0.6677
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Copiando estrutura do banco de dados para ssu
CREATE DATABASE IF NOT EXISTS `ssu` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `ssu`;

-- Copiando estrutura para tabela ssu.agendamentos
CREATE TABLE IF NOT EXISTS `agendamentos` (
  `data_consulta` varchar(20) NOT NULL,
  `id_medico` int NOT NULL,
  `id_paciente` varchar(20) NOT NULL DEFAULT '',
  `hora_consulta` varchar(20) NOT NULL DEFAULT '',
  `id_unidade` int NOT NULL,
  KEY `FK_agendamentos_medicos` (`id_medico`),
  KEY `FK_agendamentos_pacientes` (`id_paciente`),
  KEY `FK_agendamentos_unidades` (`id_unidade`),
  CONSTRAINT `FK_agendamentos_medicos` FOREIGN KEY (`id_medico`) REFERENCES `medicos` (`ID`),
  CONSTRAINT `FK_agendamentos_pacientes` FOREIGN KEY (`id_paciente`) REFERENCES `pacientes` (`registro`),
  CONSTRAINT `FK_agendamentos_unidades` FOREIGN KEY (`id_unidade`) REFERENCES `unidades` (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Copiando dados para a tabela ssu.agendamentos: ~3 rows (aproximadamente)
INSERT INTO `agendamentos` (`data_consulta`, `id_medico`, `id_paciente`, `hora_consulta`, `id_unidade`) VALUES
	('23-12-2023', 1, '1', '10', 1),
	('23-12-2023', 1, '2', '11', 1),
	('23-12-2023', 1, '3', '16', 1);

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
    INSERT INTO agendamentos (data_consulta, id_medico, id_paciente, hora_consulta, id_unidade)
    VALUES (p_data_consulta, p_id_medico, p_id_paciente, p_hora_consulta, unidade);

    -- Obtém o ID do agendamento recém-criado
    SET agendamento_id = LAST_INSERT_ID();

    RETURN agendamento_id;
END//
DELIMITER ;

-- Copiando estrutura para tabela ssu.especialidades
CREATE TABLE IF NOT EXISTS `especialidades` (
  `descricao` varchar(20) NOT NULL,
  `ID` int NOT NULL,
  `qtde_cadastro` int NOT NULL,
  PRIMARY KEY (`ID`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Copiando dados para a tabela ssu.especialidades: ~9 rows (aproximadamente)
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

-- Copiando estrutura para tabela ssu.medicos
CREATE TABLE IF NOT EXISTS `medicos` (
  `nome` varchar(30) NOT NULL,
  `ID` int NOT NULL,
  `CRM` varchar(10) NOT NULL,
  `Cidade` varchar(30) NOT NULL,
  `id_especialidade` int NOT NULL,
  `id_unidade` int NOT NULL,
  PRIMARY KEY (`ID`) USING BTREE,
  KEY `FK_medicos_especialidades` (`id_especialidade`),
  CONSTRAINT `FK_medicos_especialidades` FOREIGN KEY (`id_especialidade`) REFERENCES `especialidades` (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Copiando dados para a tabela ssu.medicos: ~9 rows (aproximadamente)
INSERT INTO `medicos` (`nome`, `ID`, `CRM`, `Cidade`, `id_especialidade`, `id_unidade`) VALUES
	('Nelson Dimas Brambilla', 1, '42.929', 'Leme', 2, 10),
	('Oswaldo Colombini Neto', 2, '108.472', 'Araras', 2, 1),
	('Ana Paula Delgado', 3, '90.376', 'Araras', 4, 3),
	('Bruno Appolari', 4, '151.650', 'Leme', 9, 4),
	('Selma Lara Teixeira ', 5, '54.435', 'Araras', 4, 7),
	('Rodrigo Dias da Costa', 6, '147.809', 'Leme', 2, 9),
	('Jean Tonelli', 7, '95.053', 'Araras', 9, 9),
	('Jardel Dair Filho', 8, '107.804', 'Araras', 4, 8),
	('Fabio Volpon Santos', 9, '67.729', 'Araras', 9, 5);

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

-- Copiando estrutura para tabela ssu.pacientes
CREATE TABLE IF NOT EXISTS `pacientes` (
  `nome` varchar(30) NOT NULL,
  `cpf` varchar(15) NOT NULL,
  `telefone` varchar(15) NOT NULL,
  `data_nasc` varchar(15) NOT NULL,
  `sexo` char(1) NOT NULL,
  `endereco` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `numero` int DEFAULT NULL,
  `bairro` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `cidade` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `email` varchar(35) NOT NULL,
  `senha` varchar(8) NOT NULL,
  `registro` varchar(20) NOT NULL,
  PRIMARY KEY (`registro`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Copiando dados para a tabela ssu.pacientes: ~7 rows (aproximadamente)
INSERT INTO `pacientes` (`nome`, `cpf`, `telefone`, `data_nasc`, `sexo`, `endereco`, `numero`, `bairro`, `cidade`, `email`, `senha`, `registro`) VALUES
	('Marco Antonio Amorim', '555.444.555-13', '(28)96631-5632', '02/02/2003', 'm', 'Rua Villa Lobo', 232, 'jd candida', 'Araras', 'amorimantonio@gmail.com', '123', '1'),
	('Vitor Manoel Martins', '555.422.555-13', '(28)3356-2363', '16/01/2001', 'm', 'AV. Zenatte Luiz', 555, 'belvedere', 'Araras', 'vmm@gmail.com', '123', '2'),
	('João Pacolla', '554.444.555-13', '(19)93625-1236', '23/06/1999', 'm', 'Rua Luiz Amorim', 777, 'xxxxx', 'Araras', 'pacollajoao@hotmail.com', '123', '3'),
	('igor ferreira', '666.444.555-13', '(19)99548-5536', '02/10/2003', 'm', 'Rua Alfândega Moraes', 888, 'qqqqq', 'Araras', 'igorferreira@gmail.com', '123', '4'),
	('Luana Marques', '111.444.555-13', '(19)99876-8737', '20-03-2001', 'f', 'AV. Silva Lastoria', 666, 'eeee', 'Araras', 'lmarques@gmail.com', '123', '5'),
	('Eryck Ribeiro', '222.444.555-13', '(19)99156-6456', '31-03-2005', 'm', 'Rua Carlos Albers', 444, 'rrrr', 'Araras', 'eryckLR@gmail.com', '123', '6'),
	('Maikon Gino', '555.444.111-13', '(28)99685-5632', '17-08-1990', 'm', 'Av Ribeiro', 111, 'oooooo', 'Araras', 'mgino@gmail.com', '123', '8');

-- Copiando estrutura para tabela ssu.unidades
CREATE TABLE IF NOT EXISTS `unidades` (
  `endereco` varchar(40) NOT NULL,
  `qtde_medicos` int NOT NULL,
  `telefone` varchar(15) NOT NULL,
  `cidade` varchar(30) NOT NULL,
  `ID` int NOT NULL,
  PRIMARY KEY (`ID`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Copiando dados para a tabela ssu.unidades: ~10 rows (aproximadamente)
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

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
