-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Tempo de geração: 22/02/2018 às 18:11
-- Versão do servidor: 10.1.29-MariaDB
-- Versão do PHP: 7.0.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `u163043632_otsb`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `log`
--

CREATE TABLE `log` (
  `id` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `descricao` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `tokens`
--

CREATE TABLE `tokens` (
  `id` int(11) NOT NULL,
  `token` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Fazendo dump de dados para tabela `tokens`
--

INSERT INTO `tokens` (`id`, `token`) VALUES
(17, 'tctvbnhj45m4k'),
(18, '567854iorekterfe');

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `senha` varchar(100) NOT NULL,
  `foto` varchar(100) NOT NULL,
  `permissao` int(1) NOT NULL DEFAULT '0',
  `status` int(1) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Fazendo dump de dados para tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `nome`, `email`, `senha`, `foto`, `permissao`, `status`) VALUES
(8, 'faael', '', '', '2dd945d3c0471656ce5f0a4bb587bcbf.jpg', 0, 1),
(46, 'fabiolucenaribas', 'fabio.luce@outlook.com', '76e3e53ee06d9bfdd7f26c36e0633de7', 'cbdfec6d3f86516e2490ea43c72a21d2.jpg', 1, 2);

--
-- Índices de tabelas apagadas
--

--
-- Índices de tabela `log`
--
ALTER TABLE `log`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `tokens`
--
ALTER TABLE `tokens`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas apagadas
--

--
-- AUTO_INCREMENT de tabela `log`
--
ALTER TABLE `log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tokens`
--
ALTER TABLE `tokens`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
