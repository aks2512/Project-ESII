-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 13-Maio-2020 às 17:45
-- Versão do servidor: 10.4.11-MariaDB
-- versão do PHP: 7.4.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `transparenciamc`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `administradores`
--

CREATE TABLE `administradores` (
  `id_admin` int(255) NOT NULL,
  `NomeAdmin` varchar(255) NOT NULL,
  `Senha` varchar(32) NOT NULL,
  `Usuario` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `administradores`
--

INSERT INTO `administradores` (`id_admin`, `NomeAdmin`, `Senha`, `Usuario`) VALUES
(1, 'Joao', 'jo123', 'Jao'),
(2, 'leonardo', '123', 'leonardo');

-- --------------------------------------------------------

--
-- Estrutura da tabela `funcionarios_bd`
--

CREATE TABLE `funcionarios_bd` (
  `id` int(255) NOT NULL,
  `Nome` varchar(255) NOT NULL,
  `Cargo` varchar(255) NOT NULL,
  `Remuneracao` int(255) NOT NULL,
  `Modificado` int(255) NOT NULL,
  `Regime` varchar(255) NOT NULL,
  `TBruto` int(255) NOT NULL,
  `Tliquido` int(255) NOT NULL,
  `TDescontos` int(255) NOT NULL,
  `DescontosObgr` int(255) NOT NULL,
  `OutrosDescontos` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `funcionarios_bd`
--

INSERT INTO `funcionarios_bd` (`id`, `Nome`, `Cargo`, `Remuneracao`, `Modificado`, `Regime`, `TBruto`, `Tliquido`, `TDescontos`, `DescontosObgr`, `OutrosDescontos`) VALUES
(1, 'Josisberto', 'Gerente', 2000, 2020, 'Tributario-Simples', 2000, 1800, 200, 180, 20),
(2, 'Carlos', 'Gerente', 2500, 2020, 'A', 4, 5, 53, 3, 23);

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `administradores`
--
ALTER TABLE `administradores`
  ADD PRIMARY KEY (`id_admin`);

--
-- Índices para tabela `funcionarios_bd`
--
ALTER TABLE `funcionarios_bd`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `administradores`
--
ALTER TABLE `administradores`
  MODIFY `id_admin` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `funcionarios_bd`
--
ALTER TABLE `funcionarios_bd`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
