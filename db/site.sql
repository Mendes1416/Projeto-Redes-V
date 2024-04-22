-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 26-Mar-2024 às 21:13
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
-- Estrutura da tabela `anuncios`
--

CREATE TABLE `anuncios` (
  `id` int(255) NOT NULL,
  `codigo` varchar(255) DEFAULT NULL,
  `tipo_de_oferta` varchar(255) DEFAULT NULL,
  `carreira` varchar(255) DEFAULT NULL,
  `organismo` varchar(255) DEFAULT NULL,
  `data_limite` date DEFAULT NULL,
  `Descricao` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Extraindo dados da tabela `anuncios`
--

INSERT INTO `anuncios` (`id`, `codigo`, `tipo_de_oferta`, `carreira`, `organismo`, `data_limite`, `Descricao`) VALUES
(4, '000', 'Empresarial ', 'Profissional', 'Empresa', '2024-04-30', ''),
(8, '234', 'Estágio', 'Desenvolvedor Web', 'HCSSM', '2024-03-22', 'É UM TESTE DE INICALIZAÇÃO!'),
(9, '304', 'Parte-Time', 'Desenvolvedor', 'Visabeira', '2024-03-31', 'Este Trabalho requer um pouco de tempo.\r\n\r\n\r\nisto é um teste'),
(10, '234', 'parte-time', 'PART-TIMEd', 'casa das bocas', '2024-04-11', 'Isto é mesmo so um teste '),
(11, '5', 'f', 'f', 'teste', '2024-03-05', 'teste'),
(12, '78698', 'PUTARIA FULL TIMES', 'PUTAAA DA TUA MÃES', 'Casa das Boquinhas ardentes', '2024-03-13', 'Zé Maria Nicolau a querendo arrear o calhau foi atrás de um barracão onde estava a tua mãe e arreou-lhe os tomates');

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
  `Validada` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Extraindo dados da tabela `empresa`
--

INSERT INTO `empresa` (`NIF`, `CAE`, `nome`, `Email`, `Morada`, `Cod_postal`, `Localidade`, `Descricao`, `Tipo`, `Password`, `Validada`) VALUES
(405, '504', 'Viselbi', 'Viselbi2005@hotmail.com', 'viseu', '3500-007', 'cabanoes de baixo ', 'vidros e areia ', 'Construçao ', '$2y$10$gh9D6k5tGCvF1oyvp3sBJe9K5DukoMijPycxreI6mkF1dhLW3GHeq', 1),
(456, '54', 'Visabeira', 'visabeira@teste.com', 'viseu', '3500-00', 'viseu', 'Empresa confiavel ', 'Desenvolvimento ', '$2y$10$IS1in1Whwa1I0Acr/yT1MOJZmn.VPj.QbYxeRHtcjTg0rfGyW4XeK', 1),
(1223, '1231', 'admin', 'a23608@esenviseu.net', 'dsfsdf', '3500-885', 'viseu', 'Confiavel', 'nao sie ', '$2y$10$fzWfcNpGxhYSBwM7okKgiu1ZHSmHZ4/yIHgL4PZXskQMk0oSjpEpK', 1),
(2098, '987', 'maguidascouves', 'magui@couves.com', 'rua linda ', '3500-885', 'viseu', 'ola sejam bem vindos ', 'empresarial ', '$2y$10$/Zkp.tz0ToGrAp5VWYgEu.ezj40Kupi6fcRT/Stm89s60cYEL0dZm', 1),
(250620, '123456q', 'Jose Mendes ', 'admin@admin.com', 'Rua central 18b', '3500-885', 'viseu', 'Confiavel ', 'Desenvolvimento ', '$2y$10$a7.LGMtplOc0dAUU.UCacubXyda.oToFxf232St1Lm6LtJQXp8cES', 1),
(989898, '23123', 'testes', 'teste@test.com', 'jojasd', '2500-898', 'vis', 'teste', 'oio', '$2y$10$doAuEINIxMZ9whHj6PFxZeIM5gd8t8nzcZ5NbmZKkuHQrJscYvmEm', 1),
(9876543, '5432', 'visabeira', 'visa@test.com', 'rua das princesas ', '3500-885', 'viseu', 'Boa empresa ', 'Empresa ', '$2y$10$6MIw.dfVKlDFlOVG2z55J.yWK4U1.84FLG1kDSrVxvlNwjNeUhF06', 1),
(123456789, '23123', 'Mendes ', 'mendes@gmail.com', 'asas', '231231', 'vsv', 'asda', 'asdad', '$2y$10$AVILc5bs2fc8RGqz4/0oPOVDxItSlKQXCxIOtpNsy09vqd6zRw93O', 0),
(250620944, '608', 'margarida', 'magui@magui.com', 'rua das porcas ', '350-885', 'lisboaa', 'cri cri cri ', 'empresa', '$2y$10$ncQqIyZOv2x9Ht5udpGame.hQxFXPodGgpMK7FZ.3CmDaD5jjvijW', 1),
(555555555, '1600', 'Mama MA Piça', 'ana.maria@badalhoca.xnxx', 'Rua das bocas, quarto 27', '3450-069', 'No caralho', 'Chupa pilas por dinheiro', 'Caninhas', '1234', 1),
(999999999, '1600', 'Mama MA Piça', 'ana.marta@badalhoca.xnxx', 'Rua das bocas, quarto 27', '1234-069', 'No caralho', 'Mama Piças Por Dinheiro', 'Caninhas', '$2y$10$50Msz2S/HaFFCxtc6i5DJe/xKJlMUDJttAOGXd0LCYZqga4sKEusC', 1),
(1234567890, '1234', 'sd', 'teste@teste.com', 'dad', '1231', 'qasd', 'sda', 'sda', '$2y$10$nJ4/WfV8NHkrV4kXh9RdnOssS7sxCgTJG3D8Qrq/t8xWBoh2M3kbi', 1);

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
(1, 4),
(15, 8),
(16, 12);

-- --------------------------------------------------------

--
-- Estrutura da tabela `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `photo` int(255) DEFAULT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `curso` varchar(200) NOT NULL,
  `ceated_at` datetime DEFAULT current_timestamp(),
  `email` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Extraindo dados da tabela `users`
--

INSERT INTO `users` (`id`, `photo`, `username`, `password`, `curso`, `ceated_at`, `email`) VALUES
(20, NULL, 'Maguijose', '$2y$10$vfT6qP0P32N6Wkt8FuZ1UOGC2QWjx5y2k15mJJTR2agbdjy5id6wa', 'Desportos', '2024-02-08 20:22:55', NULL),
(21, NULL, 'asa', '$2y$10$O99WQ0gY6voKmb4NCPaX9udqXa7yaF690ntOCYIZQKbT.xeKY5zg6', 'curso', '2024-02-08 20:23:13', NULL),
(22, NULL, 'Maguirv', '$2y$10$C/fdFsxn3kekT95HH9bHoOmamuBvszSreT9aiwURYaafdoUoVgji2', 'Turismo', '2024-02-08 20:28:03', NULL),
(23, NULL, 'cvss', '$2y$10$bPvGRrVh/FpCHAwSa9S8RO/MS4u34dCtLmf.1aIka4FpiZo9wbbkW', 'sss', '2024-02-08 21:13:16', NULL),
(24, NULL, 'jose', '$2y$10$9T99OYHpQFxuT9Ug3QpZGu48eoUevIvuGwhBV4ebtP5fEYZcF7Ava', 'GPSI', '2024-02-08 21:34:26', 'a23608@esenviseu.net'),
(25, NULL, 'Antonio', '$2y$10$4cQcaSD24kkcw/5A67Kr/uZ.MJjDPe5olbYJCbd6JqtycUJxPo4oS', 'GPSI', '2024-02-09 23:06:54', 'Luis202@gmail.com'),
(26, NULL, 'JOSE ANTONIO', '$2y$10$WzuE1FfnT9doTUJpEFIB4.OpNJnLFJH.DApK8q9I44z9Y8TR.ZuH.', 'MECANICA', '2024-02-22 22:22:05', 'maguirv@gmail.com'),
(27, 0, 'MENDESW', '$2y$10$vD7htQ8fAey0IFFLvrOVDuJRxpGI9BB7Ivldbc6vZpts2m9XPQ6m6', 'humanidades', '2024-02-23 10:48:31', 'MENDES@MENDES.COM'),
(28, NULL, 'Miguel costA', '$2y$10$fMwv/gUesuJ869VtbzzpoOqqzAzUtJR0tgacYfLs4aqXV7XwDMKDS', 'DESPORTO', '2024-02-25 17:33:50', 'M.silva@sapo.pt'),
(29, NULL, 'Joana', '$2y$10$GWh4Fqm3I0ST8EMt6Feh9.pLE3H19howEST.ygn/TUiGin/E8v6xG', 'GPSI', '2024-02-25 20:31:01', 'j.c.mendes2004@hotmail.com'),
(33, NULL, 'jose mendes', '$2y$10$Tyu8l3HiwASHECrm0qD.HOrytvIMD87urRS6NjM1TKtBwviz862Gy', 'GPSI', '2024-02-28 10:51:05', 'joseMENDES@mendes.com'),
(34, NULL, 'teste', '$2y$10$lruWUWRuGkz6OfBzoRiD3elg9M30N9mhPHY73j0RN/bWy0ec8HSju', 'GPSI', '2024-02-28 11:05:45', 'Admin@admin.com'),
(35, NULL, 'adelino', '$2y$10$t.Kt1AtuqwpUAno8bCk8m.B9eGb685XDRZ.A.8sZt/CF9UnnAayzi', 'prof', '2024-02-28 11:13:09', 'p@sapo.pt'),
(38, 0, 'MALTAs', '$2y$10$Zf9VrSZmMWqHVsvGjhYUiOtL0K8Cb2CjaX3FqdFBR.XYiWw/0p.jK', 'PROFs', '2024-03-06 12:29:31', 'MALTA@MALTA.COM'),
(39, NULL, 'martim', '$2y$10$mxhcJ765DqGl3Tt5m9DLEeUK/7acLclc0d17JpI6gY2eeV6ip63rG', 'GPSI', '2024-03-14 14:52:24', 'a23598@esenviseu.net'),
(40, 0, 'Admin', '$2y$10$OpV0bMvOtJ9.WoZw4wE2ceFlbxbHdPraqws.rlB9w1Li.cZ6zO6la', 'GPSI', '2024-03-14 14:56:48', 'a23598@esenviseu.net'),
(43, 0, 'Mendes14_', '$2y$10$LmNSKxSoQbr5.jqxd4gfeuh3qfBllC5DUq6QpGzuAyiQ40x0P4U3C', 'GPSI', '2024-03-18 22:52:46', 'a23598@esenviseu.net'),
(55, 0, 'ola', '$2y$10$sk2k/ERRgRD6OLeyIxb/q.qW6G/giPZT0sUncqep7vY/NdtVAW4bi', 'teste', '2024-03-26 19:45:40', 'a2345@esenviseu.net'),
(56, 0, 'roque valente', '$2y$10$HWKo.jSeBaTbfbaI26advuXwVEPB6F7.27Kcs5Tb6Y0fJskE1EhRW', 'GPSI', '2024-03-26 20:02:24', 'aroque@esenviseu.net');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `anuncios`
--
ALTER TABLE `anuncios`
  ADD PRIMARY KEY (`id`);

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
-- Índices para tabela `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `anuncios`
--
ALTER TABLE `anuncios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de tabela `favoritos`
--
ALTER TABLE `favoritos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de tabela `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

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
