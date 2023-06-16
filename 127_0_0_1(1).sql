-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 17-Dez-2021 às 14:12
-- Versão do servidor: 10.4.11-MariaDB
-- versão do PHP: 7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `banco_site`
--
CREATE DATABASE IF NOT EXISTS `banco_site` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `banco_site`;

-- --------------------------------------------------------

--
-- Estrutura da tabela `comentarios`
--

CREATE TABLE `comentarios` (
  `id` int(10) UNSIGNED NOT NULL,
  `data` varchar(10) DEFAULT NULL,
  `comentario` varchar(500) DEFAULT NULL,
  `usuario_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `lista_materiais`
--

CREATE TABLE `lista_materiais` (
  `tipos` varchar(50) DEFAULT NULL,
  `pontos_coleta_id` int(10) UNSIGNED NOT NULL,
  `materiais_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `lista_materiais`
--

INSERT INTO `lista_materiais` (`tipos`, `pontos_coleta_id`, `materiais_id`) VALUES
(NULL, 1, 2),
(NULL, 1, 3),
(NULL, 1, 4),
(NULL, 1, 5),
(NULL, 1, 6),
(NULL, 2, 2),
(NULL, 2, 3),
(NULL, 2, 4),
(NULL, 2, 5),
(NULL, 2, 6),
(NULL, 2, 9),
(NULL, 3, 1),
(NULL, 3, 2),
(NULL, 3, 3),
(NULL, 3, 4),
(NULL, 3, 5),
(NULL, 3, 6),
(NULL, 3, 7),
(NULL, 3, 9),
(NULL, 4, 1),
(NULL, 4, 2),
(NULL, 4, 6),
(NULL, 4, 7),
(NULL, 5, 1),
(NULL, 5, 2),
(NULL, 5, 6),
(NULL, 5, 7),
(NULL, 6, 1),
(NULL, 6, 2),
(NULL, 6, 6),
(NULL, 6, 7),
(NULL, 7, 1),
(NULL, 7, 2),
(NULL, 7, 6),
(NULL, 7, 7),
(NULL, 8, 1),
(NULL, 8, 2),
(NULL, 8, 6),
(NULL, 8, 7),
(NULL, 9, 1),
(NULL, 9, 2),
(NULL, 9, 6),
(NULL, 9, 7),
(NULL, 10, 1),
(NULL, 10, 2),
(NULL, 10, 3),
(NULL, 10, 4),
(NULL, 10, 5),
(NULL, 10, 6),
(NULL, 10, 9);

-- --------------------------------------------------------

--
-- Estrutura da tabela `materiais`
--

CREATE TABLE `materiais` (
  `id` int(10) UNSIGNED NOT NULL,
  `nome` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `materiais`
--

INSERT INTO `materiais` (`id`, `nome`) VALUES
(1, 'Plásticos'),
(2, 'Alumínio'),
(3, 'Cobre'),
(4, 'Vidro'),
(5, 'Baterias '),
(6, 'Metal'),
(7, 'Papel e Papelão'),
(9, 'Antimônio');

-- --------------------------------------------------------

--
-- Estrutura da tabela `pontos_coleta`
--

CREATE TABLE `pontos_coleta` (
  `id` int(10) UNSIGNED NOT NULL,
  `nome` varchar(50) NOT NULL,
  `endereco` varchar(50) NOT NULL,
  `telefone` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `horario` varchar(50) NOT NULL,
  `localizacao` varchar(50) NOT NULL,
  `imagem` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `pontos_coleta`
--

INSERT INTO `pontos_coleta` (`id`, `nome`, `endereco`, `telefone`, `email`, `horario`, `localizacao`, `imagem`) VALUES
(1, 'Sucata Mineira', 'Av. Paraíba - Centro - 1775 ', '92 995262984', '', 'manhã: 7 às 10 hrs, tarde: 14 às 17 hrs, seg à sab', '', 'img/whatssap.jpg'),
(2, 'Príncipe da Sucata ', 'Rua: José Esteve - Palmares - 119 ', '92 995262984', '', 'Manhã: 7 às 10 hrs, tarde: 14 às 16 hrs, seg à sab', '', ''),
(3, 'ASCALPIN', 'Rua: Bolevard Quatorze de Maio - Centro', '92 995039615 ou 92 35333554', '', 'dias úteis da semana', '', ''),
(4, 'IPAAM', 'Rua: Itacoatiara - Palmares ', '', '', 'dias úteis da semana', '', ''),
(5, 'Escola Municipal Lila Maia', 'Rua: Guajanira Prestes - Conjunto João Novo', '', '', 'dias úteis da semana', '', ''),
(6, 'Escola Municipal Irmã Cristine', 'Rua: João Pessoa - Itaúna II - 3990 ', '', '', 'dias úteis da semana', '', ''),
(7, 'Escola Beatriz de Maranhão', 'Av. Paraíba - Palmares - 1869', '', '', 'dias úteis da semana', '', ''),
(8, 'Escola Mércia Cardoso Coimbra', 'Rua: João Meireles - Palmares - 805', '', '', 'dias úteis da semana', '', ''),
(9, 'Escola Charles Garcia', 'Rua: Alfredo Monteiro Lima - Santa Rita de Cassia ', '', '', 'dias úteis da semana', '', ''),
(10, 'Rainha da Sucata', 'Av. Geni Bentes itaúna I', '', '', 'dias úteis da semana e aos sábados', '', '');

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--

CREATE TABLE `usuario` (
  `id` int(10) UNSIGNED NOT NULL,
  `nome` varchar(50) NOT NULL,
  `senha` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `usuario`
--

INSERT INTO `usuario` (`id`, `nome`, `senha`, `email`) VALUES
(1, 'David Ramos', '123qwe', 'davidness@gmail.com');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `comentarios`
--
ALTER TABLE `comentarios`
  ADD PRIMARY KEY (`id`,`usuario_id`),
  ADD UNIQUE KEY `id_UNIQUE` (`id`),
  ADD KEY `fk_comentarios_usuario1_idx` (`usuario_id`);

--
-- Índices para tabela `lista_materiais`
--
ALTER TABLE `lista_materiais`
  ADD PRIMARY KEY (`pontos_coleta_id`,`materiais_id`),
  ADD KEY `fk_lista_materiais_materiais1_idx` (`materiais_id`);

--
-- Índices para tabela `materiais`
--
ALTER TABLE `materiais`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_UNIQUE` (`id`);

--
-- Índices para tabela `pontos_coleta`
--
ALTER TABLE `pontos_coleta`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_UNIQUE` (`id`);

--
-- Índices para tabela `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_UNIQUE` (`id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `comentarios`
--
ALTER TABLE `comentarios`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `materiais`
--
ALTER TABLE `materiais`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de tabela `pontos_coleta`
--
ALTER TABLE `pontos_coleta`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de tabela `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `comentarios`
--
ALTER TABLE `comentarios`
  ADD CONSTRAINT `fk_comentarios_usuario1` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `lista_materiais`
--
ALTER TABLE `lista_materiais`
  ADD CONSTRAINT `fk_lista_materiais_materiais1` FOREIGN KEY (`materiais_id`) REFERENCES `materiais` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_lista_materiais_pontos_coleta1` FOREIGN KEY (`pontos_coleta_id`) REFERENCES `pontos_coleta` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
