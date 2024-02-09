-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 09-Fev-2024 às 13:55
-- Versão do servidor: 10.4.32-MariaDB
-- versão do PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `suaoferta`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `arquivo`
--

CREATE TABLE `arquivo` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `base_url` varchar(255) NOT NULL,
  `mime_type` varchar(255) NOT NULL,
  `path_url` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `imagem_oferta`
--

CREATE TABLE `imagem_oferta` (
  `id` int(11) NOT NULL,
  `oferta_id` int(11) NOT NULL,
  `arquivo_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `migration`
--

CREATE TABLE `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `migration`
--

INSERT INTO `migration` (`version`, `apply_time`) VALUES
('m000000_000000_base', 1706185580),
('m240115_170023_user_table', 1707483275),
('m240119_172158_create_oferta_table', 1707483275),
('m240119_172319_create_arquivo_table', 1707483275),
('m240119_173835_create_imagem_oferta_table', 1707483276);

-- --------------------------------------------------------

--
-- Estrutura da tabela `oferta`
--

CREATE TABLE `oferta` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `descricao` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `nomeComercio` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `categoriaComercio` varchar(50) DEFAULT NULL,
  `auth_key` varchar(32) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `password_reset_token` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT 10,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `verification_token` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `arquivo`
--
ALTER TABLE `arquivo`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `imagem_oferta`
--
ALTER TABLE `imagem_oferta`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx-imagem_oferta-oferta_id` (`oferta_id`),
  ADD KEY `idx-imagem_oferta-arquivo_id` (`arquivo_id`);

--
-- Índices para tabela `migration`
--
ALTER TABLE `migration`
  ADD PRIMARY KEY (`version`);

--
-- Índices para tabela `oferta`
--
ALTER TABLE `oferta`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx-oferta-user_id` (`user_id`);

--
-- Índices para tabela `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `idx-user-username` (`username`),
  ADD UNIQUE KEY `idx-user-email` (`email`),
  ADD UNIQUE KEY `idx-user-password_reset_token` (`password_reset_token`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `arquivo`
--
ALTER TABLE `arquivo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `imagem_oferta`
--
ALTER TABLE `imagem_oferta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `oferta`
--
ALTER TABLE `oferta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `imagem_oferta`
--
ALTER TABLE `imagem_oferta`
  ADD CONSTRAINT `fk-imagem_oferta-arquivo_id` FOREIGN KEY (`arquivo_id`) REFERENCES `arquivo` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk-imagem_oferta-oferta_id` FOREIGN KEY (`oferta_id`) REFERENCES `oferta` (`id`) ON DELETE CASCADE;

--
-- Limitadores para a tabela `oferta`
--
ALTER TABLE `oferta`
  ADD CONSTRAINT `fk-oferta-user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
