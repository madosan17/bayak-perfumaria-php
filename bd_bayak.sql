-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 24/10/2025 às 22:55
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `bd_bayak`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `categorias`
--

CREATE TABLE `categorias` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `categorias`
--

INSERT INTO `categorias` (`id`, `nome`) VALUES
(4, 'Água de colonia'),
(6, 'amadeirado'),
(7, 'Âmbar Floral'),
(8, 'Aromático Fougère'),
(2, 'citrico'),
(5, 'Para noites quentes');

-- --------------------------------------------------------

--
-- Estrutura para tabela `perfumes`
--

CREATE TABLE `perfumes` (
  `id` int(11) NOT NULL,
  `marca` varchar(100) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `preco` decimal(10,2) NOT NULL,
  `descricao` text NOT NULL,
  `img_frente` varchar(255) NOT NULL,
  `img_lado` varchar(255) DEFAULT NULL,
  `img_tras` varchar(255) DEFAULT NULL,
  `id_categoria` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `perfumes`
--

INSERT INTO `perfumes` (`id`, `marca`, `nome`, `preco`, `descricao`, `img_frente`, `img_lado`, `img_tras`, `id_categoria`) VALUES
(5, '4711', '4711 De Echt Kolnisch Wasser Eau De Cologne Unisex 200 ml', 179.00, 'O clássico das águas de colônia, muito refrescante e herbal.', '68f65f6816d7e.jpg', '68f65f68172c5.jpg', '68f65f6817835.jpg', 4),
(6, 'Dolce & Gabbana', 'Light Blue Pour Homme', 1200.00, 'Frescor de limão siciliano com um toque amadeirado. Considerado um \"must-have\" para o calor.', '68f66782565ef.jpg', '68f6678256d69.jpg', '68f6678257295.jpg', 4),
(8, 'Calvin Klein', 'CK One', 300.00, 'Um clássico dos anos 90, com bergamota e limão vibrantes. Super versátil para o dia a dia.', '68f66ecace57c.webp', '68f66ecacec8c.jpg', '68f66ecacf207.webp', 4),
(9, 'Giorgio Armani', 'Acqua di Giò Eau de Toilette', 470.00, 'Um ícone de frescor, com notas marinhas e cítricas.', '68f670849931f.avif', '68f67084998a7.avif', '68f6708499d56.avif', 4),
(11, 'O Boticário', 'Malbec', 250.00, 'O perfume amadeirado mais vendido do Brasil. Intenso e marcante.', '68f678f07786f.jpg', '68f678f077f00.jpg', '68f678f078421.jpg', 6),
(12, 'Hermès', 'Terre d\'Hermès', 800.00, 'Extremamente elegante e sofisticado, com notas de laranja e pimenta.', '68f6874823c73.webp', '68f6874824262.webp', '68f687482473c.webp', 6),
(13, 'Dior', 'Dior Sauvage Eau de Parfum', 820.00, 'Frescor cítrico na abertura que se aprofunda em notas amadeiradas de ambroxan e pimenta. Moderno e muito popular.', '68f687ce0b1f1.avif', '68f687ce0bbc6.avif', '68f687ce0c349.avif', 6),
(14, 'Chanel', 'Bleu de Chanel', 740.00, 'Sofisticação e mistério. É versátil, mas se destaca por sua elegância amadeirada.', '68f6884b1276a.avif', '68f6884b12ec9.webp', '68f6884b133de.webp', 6),
(15, 'Natura', 'Essencial Único', 320.00, 'Uma fragrância nacional com boa concentração e performance, ideal para ocasiões especiais.', '68f688ced757b.jpg', '68f688ced7bb2.jpg', '68f688ced7faf.jpg', 6),
(16, 'Versace', 'Versace Pour Homme ', 530.00, 'Frescor vibrante e limpo, com notas de limão e néroli, muito versátil.', '68f689790bf44.jpg', '68f689790c594.jpg', '68f689790cada.jpg', 2),
(17, 'Parfums de Marly', 'Layton', 2599.00, 'Um dos perfumes de nicho mais famosos e elogiados. É conhecido por sua abertura viciante de maçã e lavanda, que evolui para um coração quente, cremoso e extremamente sedutor de baunilha, cardamomo e sândalo. É um campeão de elogios.', '68fbbda7d8e83.jpg', '68fbbda7d9669.jpg', '68fbbda7df358.jpg', 7),
(18, 'Mercedes-Benz', 'Man', 450.00, 'Um perfume que transmite a elegância e sofisticação da marca. É uma fragrância limpa e moderna, com uma nota frutada única de pera, combinada com gerânio e uma base amadeirada de pau-rosa. Perfeito para o trabalho e ocasiões formais.', '68fbbde9ab1b2.jpg', '68fbbde9ab46b.jpg', '68fbbde9ab62e.jpg', 6),
(19, 'Ferrari', 'Black', 180.00, 'Um clássico absoluto e um dos perfumes mais vendidos no Brasil. É conhecido pelo seu aroma adocicado e frutado de maçã e ameixa, com um toque quente de canela e uma base confortável de baunilha e cedro.', '68fbbe0e6e0e1.jpg', '68fbbe0e6e333.jpg', '68fbbe0e6e4d2.jpg', 8),
(20, 'Versace', 'Eros (Eau de Toilette)', 580.00, 'Inspirado no deus grego do amor, é um perfume vibrante e sensual. Famoso por sua explosão de frescor (menta, maçã verde) combinada com uma base intensamente doce e quente de baunilha, fava tonka e cedro. Ideal para festas e encontros.', '68fbbe2de2da6.jpg', '68fbbe2de3107.jpg', '', 8),
(21, 'Ralph Lauren', 'Polo Black', 550.00, 'Uma fragrância moderna, ousada e urbana. É conhecida por sua nota de manga gelada na saída, que se mistura com sálvia e uma base misteriosa e sensual de patchouli preto e fava tonka. Perfeito para a noite.', '68fbbe5c5d28d.jpg', '68fbbe5c5d6dc.jpg', '68fbbe5c5dbf9.jpg', 6);

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `data_cadastro` datetime DEFAULT current_timestamp(),
  `tipo` enum('admin','cliente') DEFAULT 'cliente'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `nome`, `email`, `senha`, `data_cadastro`, `tipo`) VALUES
(1, 'Danilo Viana Souza de Paiva', 'richars@gmail.com', '$2y$10$nJcJZAsmK1wsrxtaUWdEN.PGQA7KIipkFhKxuOr2ErVhnO3nb6zDC', '2025-10-17 11:20:46', 'cliente'),
(2, 'Matheus dos Santos Ferreira', 'matheus@gmail.com', '$2y$10$QWY9oVLQc2auJ1ESU8tBtebnPgtru19R7UIIzfdNMjKQ.XMmyHn22', '2025-10-17 14:43:00', 'cliente'),
(3, 'Administrador', 'admin@bayak.com', '$2y$10$RiUZyJ09KGNV0F6APJisd.AB6cPS2jRklJSC7dLaN5MXVJXy8Q89G', '2025-10-17 17:01:45', 'admin'),
(4, 'João Lima', 'joao@gmail.com', '$2y$10$bAcF9bLOTSEZY3aZ3aaLvORe9r5ooAKWN8lngFa36EBu93c53u/FS', '2025-10-24 15:07:11', 'cliente');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nome` (`nome`);

--
-- Índices de tabela `perfumes`
--
ALTER TABLE `perfumes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_categoria` (`id_categoria`);

--
-- Índices de tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de tabela `perfumes`
--
ALTER TABLE `perfumes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `perfumes`
--
ALTER TABLE `perfumes`
  ADD CONSTRAINT `perfumes_ibfk_1` FOREIGN KEY (`id_categoria`) REFERENCES `categorias` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
