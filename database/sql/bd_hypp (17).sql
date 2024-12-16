-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 29/11/2024 às 16:06
-- Versão do servidor: 8.0.39
-- Versão do PHP: 8.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `bd_hypp`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_admin`
--

DROP TABLE IF EXISTS `tb_admin`;
CREATE TABLE IF NOT EXISTS `tb_admin` (
  `id_admin` int NOT NULL AUTO_INCREMENT,
  `nome_admin` varchar(40) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `email_admin` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `senha_admin` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `tipo_admin` enum('master','common','','') CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  PRIMARY KEY (`id_admin`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Despejando dados para a tabela `tb_admin`
--

INSERT INTO `tb_admin` (`id_admin`, `nome_admin`, `email_admin`, `senha_admin`, `tipo_admin`) VALUES
(1, 'admin', 'admin@gmail.com', '$2y$10$J14jIlo.J/WdX19CxsFx.udn8V3GqV/5VPmqeN8zqE3RhYj0slGlS', 'master'),
(2, 'jenny', 'jennys@gmail.com', '$2y$10$R207pqH2vYvZKi4jc/yS6Os8uGnj0dLsJMnRqWQ/V9ixw7u3mQcze', 'common');

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_album`
--

DROP TABLE IF EXISTS `tb_album`;
CREATE TABLE IF NOT EXISTS `tb_album` (
  `id_album` int NOT NULL AUTO_INCREMENT,
  `nome_album` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `qnt_musica` int NOT NULL,
  `qnt_categoria` int NOT NULL,
  `qnt_artista` int NOT NULL,
  `foto_album` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `data_registro` date DEFAULT NULL,
  PRIMARY KEY (`id_album`)
) ENGINE=InnoDB AUTO_INCREMENT=50 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Despejando dados para a tabela `tb_album`
--

INSERT INTO `tb_album` (`id_album`, `nome_album`, `qnt_musica`, `qnt_categoria`, `qnt_artista`, `foto_album`, `data_registro`) VALUES
(46, 'Syro', 3, 1, 1, '../../../imgs/album/c68409faf26e5b60a4df2d6dbae66833.jpg', NULL),
(47, 'Frevo Mulher', 3, 1, 1, '../../../imgs/album/34937590a0227515427e5a5777e659c9.jpg', NULL),
(48, 'Voar como a águia', 3, 1, 1, '../../../imgs/album/81b72d8eefd148d37e717ae262415cfa.jpg', NULL),
(49, 'Imunidade Musical', 3, 1, 1, '../../../imgs/album/17a67bf8e5fb2d43aa1dc4ac1f82f80a.jpg', NULL);

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_album_artista`
--

DROP TABLE IF EXISTS `tb_album_artista`;
CREATE TABLE IF NOT EXISTS `tb_album_artista` (
  `id_album_artista` int NOT NULL AUTO_INCREMENT,
  `fk_id_artista` int DEFAULT NULL,
  `fk_id_album` int NOT NULL,
  PRIMARY KEY (`id_album_artista`),
  KEY `fk_artista_has_album` (`fk_id_artista`),
  KEY `fk_album_has_artista` (`fk_id_album`)
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Despejando dados para a tabela `tb_album_artista`
--

INSERT INTO `tb_album_artista` (`id_album_artista`, `fk_id_artista`, `fk_id_album`) VALUES
(27, 43, 46),
(36, 44, 47),
(37, 45, 48),
(38, 46, 49);

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_album_categoria`
--

DROP TABLE IF EXISTS `tb_album_categoria`;
CREATE TABLE IF NOT EXISTS `tb_album_categoria` (
  `id_album_categoria` int NOT NULL AUTO_INCREMENT,
  `fk_id_categoria` int NOT NULL,
  `fk_id_album` int NOT NULL,
  PRIMARY KEY (`id_album_categoria`),
  KEY `fk_categoria_has_album` (`fk_id_categoria`),
  KEY `fk_album_has_categoria` (`fk_id_album`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Despejando dados para a tabela `tb_album_categoria`
--

INSERT INTO `tb_album_categoria` (`id_album_categoria`, `fk_id_categoria`, `fk_id_album`) VALUES
(17, 7, 46),
(19, 22, 47),
(20, 23, 48),
(21, 24, 49);

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_album_musica`
--

DROP TABLE IF EXISTS `tb_album_musica`;
CREATE TABLE IF NOT EXISTS `tb_album_musica` (
  `id_album_musica` int NOT NULL AUTO_INCREMENT,
  `fk_id_musica` int NOT NULL,
  `fk_id_album` int NOT NULL,
  PRIMARY KEY (`id_album_musica`),
  KEY `fk_album_has_musica` (`fk_id_album`),
  KEY `fk_musica_has_album` (`fk_id_musica`)
) ENGINE=InnoDB AUTO_INCREMENT=65 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Despejando dados para a tabela `tb_album_musica`
--

INSERT INTO `tb_album_musica` (`id_album_musica`, `fk_id_musica`, `fk_id_album`) VALUES
(53, 53, 46),
(54, 54, 46),
(55, 55, 46),
(56, 56, 47),
(57, 57, 47),
(58, 58, 47),
(59, 59, 48),
(60, 60, 48),
(61, 61, 48),
(62, 62, 49),
(63, 63, 49),
(64, 64, 49);

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_artista`
--

DROP TABLE IF EXISTS `tb_artista`;
CREATE TABLE IF NOT EXISTS `tb_artista` (
  `id_artista` int NOT NULL AUTO_INCREMENT,
  `nome_artista` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `foto_artista` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `qnt_albuns` int NOT NULL,
  `data_registro` date NOT NULL,
  PRIMARY KEY (`id_artista`)
) ENGINE=InnoDB AUTO_INCREMENT=47 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Despejando dados para a tabela `tb_artista`
--

INSERT INTO `tb_artista` (`id_artista`, `nome_artista`, `foto_artista`, `qnt_albuns`, `data_registro`) VALUES
(43, 'Aphex Twin', '../../../imgs/singer/612e98be8c10cc4cd8787741c4a5fe16.jpg', 0, '2024-11-28'),
(44, 'Amelinha', '../../../imgs/singer/8271ba973eb1a494a78218c57828fbc6.jpg', 0, '2024-11-29'),
(45, 'Alda Célia', '../../../imgs/singer/5c211d546d587101da3c9c679ed88bca.jpg', 0, '2024-11-29'),
(46, 'Charlie Brown Junior', '../../../imgs/singer/3439f3ad222a58cd9c0bdfcc8dbea00e.jpg', 0, '2024-11-29');

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_categoria`
--

DROP TABLE IF EXISTS `tb_categoria`;
CREATE TABLE IF NOT EXISTS `tb_categoria` (
  `id_categoria` int NOT NULL AUTO_INCREMENT,
  `nome_categoria` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  PRIMARY KEY (`id_categoria`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Despejando dados para a tabela `tb_categoria`
--

INSERT INTO `tb_categoria` (`id_categoria`, `nome_categoria`) VALUES
(5, 'Pop'),
(6, 'Rock'),
(7, 'Eletrônica'),
(8, 'Indie'),
(9, 'Remix'),
(10, 'Dubstep'),
(11, 'Samba'),
(12, 'Pagode'),
(13, 'Sertanejo'),
(21, 'Funk'),
(22, 'Forró'),
(23, 'Gospel'),
(24, 'Hip Hop');

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_musica`
--

DROP TABLE IF EXISTS `tb_musica`;
CREATE TABLE IF NOT EXISTS `tb_musica` (
  `id_musica` int NOT NULL AUTO_INCREMENT,
  `nome_musica` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `musica` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `qnt_artista` int NOT NULL,
  `foto_musica` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `fk_id_categoria` int NOT NULL,
  `data_registro` date DEFAULT NULL,
  PRIMARY KEY (`id_musica`),
  KEY `fk_categoria_musica` (`fk_id_categoria`)
) ENGINE=InnoDB AUTO_INCREMENT=65 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Despejando dados para a tabela `tb_musica`
--

INSERT INTO `tb_musica` (`id_musica`, `nome_musica`, `musica`, `qnt_artista`, `foto_musica`, `fk_id_categoria`, `data_registro`) VALUES
(47, 'Peaceful ost1', '../../musica/source/7d15160bc9e22182b7d1966abe272601.mp3', 2, '../../../imgs/music/f778403634e22177102ca8d818968d3c.jpg', 8, NULL),
(48, 'Peaceful ost2', '../../musica/source/c8f38155f3e80d4d6c88f3af1abefa6d.mp3', 4, '../../../imgs/music/c1a5c2838a6d806061f25d95d9469660.jpg', 8, NULL),
(53, 'Aisatsana', '../../musica/source/65463c05a61dcc0173c8a07c051be340.mp3', 1, '../../../imgs/music/83a7c3e3ddf4e8819fd9b4cad17deace.jpg', 7, NULL),
(54, 'CIRCLONT14', '../../musica/source/4e173d92f177590a4fea599690c2583f.mp3', 1, '../../../imgs/music/4ceb3dbad83fac73619189538da77af2.jpg', 7, NULL),
(55, 'produk 29', '../../musica/source/3a94baee87ad8a05b746e3b19094146d.mp3', 2, '../../../imgs/music/82fdcb65ebd62c0302438e6f4273dabb.jpg', 7, NULL),
(56, 'Divindade', '../../musica/source/c1a81c7ba432d696b42144dff4188f88.mp3', 1, '../../../imgs/music/fb48581d5367acd5c5db334ca2a58b0b.jpg', 22, NULL),
(57, 'Noites De Cetim', '../../musica/source/3b2169835081663d64b6519396a9e677.mp3', 2, '../../../imgs/music/cc7f01730f906533250bad50d925568f.jpg', 22, NULL),
(58, 'Santa Tereza', '../../musica/source/624177ead0604395515f6b4025a6298b.mp3', 3, '../../../imgs/music/f58cc798fd4af52d7351d47bb22a9bb7.jpg', 22, NULL),
(59, 'Deus é bom', '../../musica/source/54b92a8cdff06c146898e57025245275.mp3', 1, '../../../imgs/music/2874f9685c52df0ab83279424ef5d0e7.jpg', 23, NULL),
(60, 'Glória ao Altíssimo', '../../musica/source/ea61f731b1bc007e12defcfd824b03ff.mp3', 2, '../../../imgs/music/e0bb86d0805e2a9df632386ba400a30f.jpg', 23, NULL),
(61, 'Óleo de alegria', '../../musica/source/b0a0a6eb941d6126f05108651d683469.mp3', 3, '../../../imgs/music/9a9cfe078722b38053130875fd7e83cc.jpg', 23, NULL),
(62, 'No Passo a Passo', '../../musica/source/c80c50610d300c4fd33fd68a55715572.mp3', 1, '../../../imgs/music/33dd34280f70945bf8445dc41ac2964b.jpg', 24, NULL),
(63, 'O mundo explodiu lá fora', '../../musica/source/d344920ca1d7de8c187a7920129e4d6e.mp3', 2, '../../../imgs/music/b6b86408c1948a17af4d09b269b2575a.jpg', 24, NULL),
(64, 'Pra Não Dizer Que Não Falei Das Flores', '../../musica/source/b1af889d4db8055e1dded82539cfa046.mp3', 3, '../../../imgs/music/1333c7adfa4ef4744b237528bbfd46cd.jpg', 24, NULL);

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_musica_artista`
--

DROP TABLE IF EXISTS `tb_musica_artista`;
CREATE TABLE IF NOT EXISTS `tb_musica_artista` (
  `id_musica_artista` int NOT NULL AUTO_INCREMENT,
  `fk_id_musica` int NOT NULL,
  `fk_id_artista` int NOT NULL,
  PRIMARY KEY (`id_musica_artista`),
  KEY `fk_artista_has_musica` (`fk_id_artista`),
  KEY `fk_musica_has_artista` (`fk_id_musica`)
) ENGINE=InnoDB AUTO_INCREMENT=60 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Despejando dados para a tabela `tb_musica_artista`
--

INSERT INTO `tb_musica_artista` (`id_musica_artista`, `fk_id_musica`, `fk_id_artista`) VALUES
(39, 53, 43),
(40, 54, 43),
(41, 55, 43),
(51, 56, 44),
(52, 57, 44),
(53, 58, 44),
(54, 59, 45),
(55, 60, 45),
(56, 61, 45),
(57, 62, 46),
(58, 63, 46),
(59, 64, 46);

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_playlist`
--

DROP TABLE IF EXISTS `tb_playlist`;
CREATE TABLE IF NOT EXISTS `tb_playlist` (
  `id_playlist` int NOT NULL AUTO_INCREMENT,
  `nome_playlist` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `qnt_musica` int NOT NULL,
  `fk_id_usuario` int DEFAULT NULL,
  `fk_id_admin` int DEFAULT NULL,
  `data_registro` date DEFAULT NULL,
  PRIMARY KEY (`id_playlist`),
  KEY `fk_usuario_playlist` (`fk_id_usuario`),
  KEY `fk_admin_playlist` (`fk_id_admin`)
) ENGINE=InnoDB AUTO_INCREMENT=53 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Despejando dados para a tabela `tb_playlist`
--

INSERT INTO `tb_playlist` (`id_playlist`, `nome_playlist`, `qnt_musica`, `fk_id_usuario`, `fk_id_admin`, `data_registro`) VALUES
(32, 'Playlist 1', 0, NULL, 1, NULL),
(37, 'Playlist3', 0, NULL, 1, NULL),
(38, 'Playlist4', 0, NULL, 1, NULL),
(45, 'Playlist5', 0, NULL, 1, NULL),
(51, 'Playlist6', 0, NULL, 1, NULL),
(52, 'Playlist6', 0, NULL, 1, NULL);

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_playlist_musica`
--

DROP TABLE IF EXISTS `tb_playlist_musica`;
CREATE TABLE IF NOT EXISTS `tb_playlist_musica` (
  `id_playlist_musica` int NOT NULL AUTO_INCREMENT,
  `fk_id_musica` int NOT NULL,
  `fk_id_playlist` int NOT NULL,
  PRIMARY KEY (`id_playlist_musica`),
  KEY `fk_musica_has_playlist` (`fk_id_musica`),
  KEY `fk_playlist_has_musica` (`fk_id_playlist`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Despejando dados para a tabela `tb_playlist_musica`
--

INSERT INTO `tb_playlist_musica` (`id_playlist_musica`, `fk_id_musica`, `fk_id_playlist`) VALUES
(14, 47, 32);

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_usuario`
--

DROP TABLE IF EXISTS `tb_usuario`;
CREATE TABLE IF NOT EXISTS `tb_usuario` (
  `id_usuario` int NOT NULL AUTO_INCREMENT,
  `nome_usuario` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `email_usuario` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `senha_usuario` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `foto_usuario` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `data_registro` date NOT NULL,
  PRIMARY KEY (`id_usuario`),
  UNIQUE KEY `email_usuario` (`email_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Despejando dados para a tabela `tb_usuario`
--

INSERT INTO `tb_usuario` (`id_usuario`, `nome_usuario`, `email_usuario`, `senha_usuario`, `foto_usuario`, `data_registro`) VALUES
(2, 'Henry Kenji', 'henrykenjiueta@gmail.com', '$2y$10$Wo/n3R3JgvKFl0FzLlNZ5.aTSfl9nJgLsOX7xazsnHoSxImYLt9Lm', '../fotos/26ce78266d0710f6c8faf758ee7a52de.jpg', '2024-11-04'),
(5, 'Andreas', 'uetanew@gmail.com', '$2y$10$KdTpXb5Pv4IfdDujvWj6ne4GY6ytyTQJK1HTAxNbdVFaaaeH9lI/q', '../fotos/554afbe24ad4173270a384071ed7a33f.jpg', '2024-11-05'),
(6, 'arnaldo', 'arnaldo@gmail.com', '$2y$10$OUdoqv03JchDbM79/KbaOul1gQyQxc4ftZOcplFNrJvVmNX2ni3Oe', '../fotos/usuarios9303c84dd060590ce7574a0d663d1611.jpg', '2024-11-07'),
(8, 'Zack', 'zack@gmail.com', '3131313131', '13131313', '2024-11-28');

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `tb_album_artista`
--
ALTER TABLE `tb_album_artista`
  ADD CONSTRAINT `fk_album_has_artista` FOREIGN KEY (`fk_id_album`) REFERENCES `tb_album` (`id_album`) ON DELETE CASCADE ON UPDATE RESTRICT,
  ADD CONSTRAINT `fk_artista_has_album` FOREIGN KEY (`fk_id_artista`) REFERENCES `tb_artista` (`id_artista`) ON DELETE CASCADE ON UPDATE RESTRICT;

--
-- Restrições para tabelas `tb_album_categoria`
--
ALTER TABLE `tb_album_categoria`
  ADD CONSTRAINT `fk_album_has_categoria` FOREIGN KEY (`fk_id_album`) REFERENCES `tb_album` (`id_album`) ON DELETE CASCADE ON UPDATE RESTRICT,
  ADD CONSTRAINT `fk_categoria_has_album` FOREIGN KEY (`fk_id_categoria`) REFERENCES `tb_categoria` (`id_categoria`) ON DELETE CASCADE ON UPDATE RESTRICT;

--
-- Restrições para tabelas `tb_album_musica`
--
ALTER TABLE `tb_album_musica`
  ADD CONSTRAINT `fk_album_has_musica` FOREIGN KEY (`fk_id_album`) REFERENCES `tb_album` (`id_album`) ON DELETE CASCADE ON UPDATE RESTRICT,
  ADD CONSTRAINT `fk_musica_has_album` FOREIGN KEY (`fk_id_musica`) REFERENCES `tb_musica` (`id_musica`) ON DELETE CASCADE ON UPDATE RESTRICT;

--
-- Restrições para tabelas `tb_musica`
--
ALTER TABLE `tb_musica`
  ADD CONSTRAINT `fk_categoria_musica` FOREIGN KEY (`fk_id_categoria`) REFERENCES `tb_categoria` (`id_categoria`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Restrições para tabelas `tb_musica_artista`
--
ALTER TABLE `tb_musica_artista`
  ADD CONSTRAINT `fk_artista_has_musica` FOREIGN KEY (`fk_id_artista`) REFERENCES `tb_artista` (`id_artista`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_musica_has_artista` FOREIGN KEY (`fk_id_musica`) REFERENCES `tb_musica` (`id_musica`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restrições para tabelas `tb_playlist`
--
ALTER TABLE `tb_playlist`
  ADD CONSTRAINT `fk_admin_playlist` FOREIGN KEY (`fk_id_admin`) REFERENCES `tb_admin` (`id_admin`) ON DELETE CASCADE ON UPDATE RESTRICT,
  ADD CONSTRAINT `fk_usuario_playlist` FOREIGN KEY (`fk_id_usuario`) REFERENCES `tb_usuario` (`id_usuario`) ON DELETE CASCADE ON UPDATE RESTRICT;

--
-- Restrições para tabelas `tb_playlist_musica`
--
ALTER TABLE `tb_playlist_musica`
  ADD CONSTRAINT `fk_musica_has_playlist` FOREIGN KEY (`fk_id_musica`) REFERENCES `tb_musica` (`id_musica`) ON DELETE CASCADE ON UPDATE RESTRICT,
  ADD CONSTRAINT `fk_playlist_has_musica` FOREIGN KEY (`fk_id_playlist`) REFERENCES `tb_playlist` (`id_playlist`) ON DELETE CASCADE ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
