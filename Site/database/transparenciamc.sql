-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 27-Maio-2020 às 21:48
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
  `Senha` varchar(32) NOT NULL,
  `Usuario` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `administradores`
--

INSERT INTO `administradores` (`id_admin`, `Senha`, `Usuario`) VALUES
(1, '202cb962ac59075b964b07152d234b70', 'William'),
(2, '202cb962ac59075b964b07152d234b70', 'asdsad'),
(3, '2b0c8408ea77ba5fe4b4b72cae5d0146', 'Akira'),
(4, '202cb962ac59075b964b07152d234b70', 'sadasd');

-- --------------------------------------------------------

--
-- Estrutura da tabela `detalhes`
--

CREATE TABLE `detalhes` (
  `id` int(255) NOT NULL,
  `id_item` int(255) NOT NULL,
  `categoria` varchar(255) NOT NULL,
  `subcategoria` varchar(255) NOT NULL,
  `valor` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `detalhes`
--

INSERT INTO `detalhes` (`id`, `id_item`, `categoria`, `subcategoria`, `valor`) VALUES
(2, 10, 'Remuneracao', 'Bonus', 1788.45),
(2, 11, 'Remuneracao', 'Salario', 2789.45),
(2, 12, 'Desconto', 'Imp. de Renda', 233.12),
(2, 13, 'Desconto', 'IPREM', 589.33),
(3, 14, 'Remuneracao', 'Hora extra', 345.78),
(3, 15, 'Remuneracao', 'Bonus', 2789.45),
(3, 16, 'Remuneracao', 'Salario', 5673.43),
(3, 17, 'Desconto', 'Imp. de Renda', 233.12),
(3, 18, 'Desconto', 'IPREM', 589.33);

-- --------------------------------------------------------

--
-- Estrutura da tabela `funcionarios_bd`
--

CREATE TABLE `funcionarios_bd` (
  `id` int(255) NOT NULL,
  `Nome` varchar(255) NOT NULL,
  `Cargo` varchar(255) NOT NULL,
  `Modificado` varchar(255) NOT NULL,
  `Regime` varchar(255) NOT NULL,
  `TBruto` varchar(255) NOT NULL,
  `Tliquido` varchar(255) NOT NULL,
  `TDescontos` varchar(255) NOT NULL,
  `DescontosObgr` varchar(255) NOT NULL,
  `OutrosDescontos` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `funcionarios_bd`
--

INSERT INTO `funcionarios_bd` (`id`, `Nome`, `Cargo`, `Modificado`, `Regime`, `TBruto`, `Tliquido`, `TDescontos`, `DescontosObgr`, `OutrosDescontos`) VALUES
(2, 'Leonardo', 'Tecnico em informatica', '30/07/2020', 'INSS', '4577.9', '3720.79', '857.11', '822.45', '34.66'),
(3, 'José', 'Analista de Sistemas', '24/05/2018', 'INSS', '8808.66', '7652.88', '1155.78', '822.45', '333.33');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `administradores`
--
ALTER TABLE `administradores`
  ADD PRIMARY KEY (`id_admin`);

--
-- Índices para tabela `detalhes`
--
ALTER TABLE `detalhes`
  ADD PRIMARY KEY (`id_item`),
  ADD KEY `fk_funcionario` (`id`);

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
  MODIFY `id_admin` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `detalhes`
--
ALTER TABLE `detalhes`
  MODIFY `id_item` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT de tabela `funcionarios_bd`
--
ALTER TABLE `funcionarios_bd`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `detalhes`
--
ALTER TABLE `detalhes`
  ADD CONSTRAINT `fk_funcionario` FOREIGN KEY (`id`) REFERENCES `funcionarios_bd` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
