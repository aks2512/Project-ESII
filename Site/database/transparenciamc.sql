-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 19-Maio-2020 às 00:18
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
(3, '2b0c8408ea77ba5fe4b4b72cae5d0146', 'Akira');

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
(2, 1, 'Remuneração', 'Hora Extra', 589.45),
(2, 2, 'Remuneração', 'Honorarios', 987.76),
(2, 3, 'Remuneração', 'Salario', 3000.67),
(2, 4, 'Desconto', 'Imp. de Renda', 253),
(2, 5, 'Desconto', 'IPREM', 1314.9);

-- --------------------------------------------------------

--
-- Estrutura da tabela `funcionarios_bd`
--

CREATE TABLE `funcionarios_bd` (
  `id` int(255) NOT NULL,
  `Nome` varchar(255) NOT NULL,
  `Cargo` varchar(255) NOT NULL,
  `Remuneracao` varchar(255) NOT NULL,
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

INSERT INTO `funcionarios_bd` (`id`, `Nome`, `Cargo`, `Remuneracao`, `Modificado`, `Regime`, `TBruto`, `Tliquido`, `TDescontos`, `DescontosObgr`, `OutrosDescontos`) VALUES
(2, 'Ivenspreison', 'Gerente Genérico', '4577.88', '27/13/2200', 'AGE', '4000.56', '3500.7', '4690.9', '1567.9', '3123');

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
  MODIFY `id_admin` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `detalhes`
--
ALTER TABLE `detalhes`
  MODIFY `id_item` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `funcionarios_bd`
--
ALTER TABLE `funcionarios_bd`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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
