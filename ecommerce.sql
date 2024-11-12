-- --------------------------------------------------------
-- Servidor:                     127.0.0.1
-- Versão do servidor:           10.4.32-MariaDB - mariadb.org binary distribution
-- OS do Servidor:               Win64
-- HeidiSQL Versão:              12.8.0.6908
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Copiando estrutura do banco de dados para ecommerce
CREATE DATABASE IF NOT EXISTS `ecommerce` /*!40100 DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci */;
USE `ecommerce`;

-- Copiando estrutura para tabela ecommerce.carrinho
CREATE TABLE IF NOT EXISTS `carrinho` (
  `id_carrinho` int(11) NOT NULL AUTO_INCREMENT,
  `id_produto` int(11) NOT NULL DEFAULT 0,
  `id_usuario` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id_carrinho`),
  KEY `FKid_produto` (`id_produto`),
  KEY `FKid_usuario` (`id_usuario`),
  CONSTRAINT `FKid_produto` FOREIGN KEY (`id_produto`) REFERENCES `produtos` (`id_produto`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FKid_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Copiando dados para a tabela ecommerce.carrinho: ~2 rows (aproximadamente)
DELETE FROM `carrinho`;
INSERT INTO `carrinho` (`id_carrinho`, `id_produto`, `id_usuario`) VALUES
	(2, 2, 2);

-- Copiando estrutura para tabela ecommerce.produtos
CREATE TABLE IF NOT EXISTS `produtos` (
  `id_produto` int(11) NOT NULL AUTO_INCREMENT,
  `nome_produto` varchar(250) DEFAULT NULL,
  `preco_produto` float(5,2) DEFAULT NULL,
  `imagem_produto` varchar(250) DEFAULT NULL,
  `tipo_produto` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`id_produto`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Copiando dados para a tabela ecommerce.produtos: ~7 rows (aproximadamente)
DELETE FROM `produtos`;
INSERT INTO `produtos` (`id_produto`, `nome_produto`, `preco_produto`, `imagem_produto`, `tipo_produto`) VALUES
	(1, 'Skate Montado Cbgang Sktbr Urso Espacial Black', 199.99, 'skate-1.png', 'skate'),
	(2, 'Skate Montado CBGANG Cat', 189.99, 'skate-2.png', 'skate'),
	(3, 'Shape CBGANG Maple Linux Op', 210.50, 'shape-1.png', 'shape'),
	(4, 'Shape Child Marfim The Child AMARELO', 205.75, 'shape-2.png', 'shape'),
	(5, 'Truck Para Skate Com Roda, Rolamento Black Sheep Black e Parafusos de Base', 195.30, 'kit-1.png', 'kit'),
	(6, 'Truck Skate 149mm + Rodas 54mm + Rolamento Black Precision', 215.00, 'kit-2.png', 'kit');

-- Copiando estrutura para tabela ecommerce.usuario
CREATE TABLE IF NOT EXISTS `usuario` (
  `id_usuario` int(11) NOT NULL AUTO_INCREMENT,
  `email_usuario` varchar(250) DEFAULT NULL,
  `senha_usuario` varchar(32) DEFAULT NULL,
  `nome_usuario` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`id_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Copiando dados para a tabela ecommerce.usuario: ~3 rows (aproximadamente)
DELETE FROM `usuario`;
INSERT INTO `usuario` (`id_usuario`, `email_usuario`, `senha_usuario`, `nome_usuario`) VALUES
	(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'Administrador'),
	(2, 'teste', '21232f297a57a5a743894a0e4a801fc3', 'teste'),
	(3, 'renanzanettio@gmail.com', '21232f297a57a5a743894a0e4a801fc3', 'Renan Zanetti');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
