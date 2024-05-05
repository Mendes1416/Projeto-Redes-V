-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 05-Maio-2024 às 23:52
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
-- Banco de dados: `site`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `PASSWORD` varchar(255) NOT NULL,
  `role` enum('admin','empresa','aluno') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `admins`
--

INSERT INTO `admins` (`id`, `nome`, `email`, `PASSWORD`, `role`) VALUES
(1, 'jose', 'jose@esenviseu.net', '$2y$10$XQq0Ckn7BD7kswSkW9AasOrvJDsZ/EW3O2ZiPe/9FPyHfL2jF8iXu', NULL),
(2, 'jose', 'Admin@esenviseu.net', '$2y$10$hnaz4xm0Xzp3JPvdFZUGJuYOiZ6A8ZvV5v/27SRjs06tcwd/I7R6y', NULL),
(3, 'Mendes', 'joses@esenviseu.net', '$2y$10$fwHpFaBL1vF5LxA4hw8xB.INdMwQgM8hDJ7IsKcKDciaEkCn6KXOi', NULL),
(4, 'AdminJosé', 'Adminj@esenviseu.net', '$2y$10$hFUfFLPsYTOB14OqCIApSe6wVZTpcOuNLYFWd4B4PrMbkCT9ITbFK', NULL),
(5, 'AdminMendes', 'adminMENDES@esenviseu.net', '$2y$10$Ws.ThAwu/.3ayBEcSsj/SeNaKZZYsQukXiVQCZGPCZgzaGTiDfc3y', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `alunos`
--

CREATE TABLE `alunos` (
  `id` int(11) NOT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `curso` varchar(200) NOT NULL,
  `ceated_at` datetime DEFAULT current_timestamp(),
  `email` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Extraindo dados da tabela `alunos`
--

INSERT INTO `alunos` (`id`, `photo`, `username`, `password`, `curso`, `ceated_at`, `email`) VALUES
(1, '315108777_3378875542434330_5792098551013358840_n.jpg', 'Jose Antonio Da Costa Mendes', '$2y$10$ulbgtvdp4j8TARcY/3fUPudIA6IvNedo0ER9YyQ632P4HGNo7/SZi', 'Gestão e Programação de Sistemas Informáticos', '2024-04-28 20:06:45', 'a23608@esenviseu.net'),
(36, 'html.png', 'Mendes jose', '$2y$10$y5ecTLH8OgsHkln2HupzluF76zN1iAzI/FNCohhRkx7TL7KjGINHe', 'Manutenção Industrial de Metalurgia e Metalomecânica', '2024-04-30 14:37:13', 'Mendes@esenviseu.net');

-- --------------------------------------------------------

--
-- Estrutura da tabela `anuncios`
--

CREATE TABLE `anuncios` (
  `id` int(255) NOT NULL,
  `codigo` varchar(255) DEFAULT NULL,
  `tipo_de_oferta` varchar(255) DEFAULT NULL,
  `carreira` varchar(255) DEFAULT NULL,
  `organismo` varchar(255) DEFAULT NULL,
  `data_limite` date DEFAULT NULL,
  `Descricao` text NOT NULL,
  `curso_id` varchar(100) NOT NULL,
  `id_empresa` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Extraindo dados da tabela `anuncios`
--

INSERT INTO `anuncios` (`id`, `codigo`, `tipo_de_oferta`, `carreira`, `organismo`, `data_limite`, `Descricao`, `curso_id`, `id_empresa`) VALUES
(10, '234', 'parte-time', 'PART-TIMEd', 'casa das bocas', '2024-04-11', 'Isto é mesmo so um teste ', '', NULL),
(13, '305', 'teste', 'teste', 'teste', '2024-03-22', 'Resultou o teste. AMEM', '', NULL),
(18, '7865', 'Full-Time', 'ituiyu', 'yuiyuii', '2024-05-22', 'yuiyui', 'Multimédia', NULL),
(25, '6874', 'Full-Time', '75', '75', '2024-05-29', '75', '2', NULL),
(26, '2345', 'Part-Time', 'Técnico de infomática', 'Politecnico ', '2024-05-27', 'Precisa-se um TI para manutenção.', 'Gestão e Programação de Sistemas Informáticos', NULL),
(27, '343', 'Full-Time', 'Escolar', 'Visabeira', '2024-05-15', 'TESTE', 'Turismo Ambiental e Rural', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `cursos`
--

CREATE TABLE `cursos` (
  `Nome` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `empresa`
--

CREATE TABLE `empresa` (
  `NIF` int(11) NOT NULL,
  `CAE` varchar(255) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Morada` varchar(255) NOT NULL,
  `Cod_postal` varchar(10) NOT NULL,
  `Localidade` varchar(255) NOT NULL,
  `Descricao` text DEFAULT NULL,
  `Tipo` varchar(50) DEFAULT NULL,
  `Password` varchar(255) NOT NULL,
  `Validada` tinyint(1) NOT NULL,
  `photo` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Extraindo dados da tabela `empresa`
--

INSERT INTO `empresa` (`NIF`, `CAE`, `nome`, `Email`, `Morada`, `Cod_postal`, `Localidade`, `Descricao`, `Tipo`, `Password`, `Validada`, `photo`) VALUES
(405, '504', 'Visabeira', 'Viselbi2005@hotmail.com', 'viseu', '3500-007', 'cabanoes de baixo ', 'Vidro e areiasiyfuf', 'Construçao ', '$2y$10$gh9D6k5tGCvF1oyvp3sBJe9K5DukoMijPycxreI6mkF1dhLW3GHeq', 1, NULL),
(1223, '1231', 'admin', 'a23608@esenviseu.net', 'dsfsdf', '3500-885', 'viseu', 'Confiavel', 'nao sie ', '$2y$10$fzWfcNpGxhYSBwM7okKgiu1ZHSmHZ4/yIHgL4PZXskQMk0oSjpEpK', 1, NULL),
(250620, '123456q', 'Jose Mendes ', 'admin@admin.com', 'Rua central 18b', '3500-885', 'viseu', 'Confiavel ', 'Desenvolvimento ', '$2y$10$a7.LGMtplOc0dAUU.UCacubXyda.oToFxf232St1Lm6LtJQXp8cES', 1, NULL),
(123456789, '', 'Mendes ', 'mendes@gmail.com', 'asas', '231231', 'Almargem', 'asda', 'asdad', '$2y$10$AVILc5bs2fc8RGqz4/0oPOVDxItSlKQXCxIOtpNsy09vqd6zRw93O', 0, NULL),
(206140323, '4563', 'MENDES ', 'MENDES@MENDES.COM', 'Rua formosa', '3500-090', 'viseu', 'Empresa de desentendimento avançado. usando PHP  ', 'Dsenvolvimento ', '$2y$10$qdHUL6A4/uAt3gINfkT7Qe9Yl1EaqTNEK4amH/kx8ZjQMDb5Hy7JO', 1, NULL),
(987654321, '2345', 'erwer', 'ja019627@gmail.com', 'viseu', '2345678', 'viseu', 'hjhjh', 'dfghjkl', '$2y$10$16MJWi86a7VXiW7RZ/NerOs3kbcAueXUklR2HJEhZNLeajSjFU8By', 1, NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `favoritos`
--

CREATE TABLE `favoritos` (
  `id` int(11) NOT NULL,
  `anuncio_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `favoritos`
--

INSERT INTO `favoritos` (`id`, `anuncio_id`) VALUES
(43, 26);

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `alunos`
--
ALTER TABLE `alunos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Índices para tabela `anuncios`
--
ALTER TABLE `anuncios`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `cursos`
--
ALTER TABLE `cursos`
  ADD PRIMARY KEY (`Nome`);

--
-- Índices para tabela `empresa`
--
ALTER TABLE `empresa`
  ADD PRIMARY KEY (`NIF`);

--
-- Índices para tabela `favoritos`
--
ALTER TABLE `favoritos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `anuncio_id` (`anuncio_id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `alunos`
--
ALTER TABLE `alunos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT de tabela `anuncios`
--
ALTER TABLE `anuncios`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT de tabela `favoritos`
--
ALTER TABLE `favoritos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `favoritos`
--
ALTER TABLE `favoritos`
  ADD CONSTRAINT `favoritos_ibfk_1` FOREIGN KEY (`anuncio_id`) REFERENCES `anuncios` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
