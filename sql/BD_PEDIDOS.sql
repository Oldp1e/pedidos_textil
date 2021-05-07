-- --------------------------------------------------------
-- Host:                         LOCAHOST
-- Server version:               5.7.17-13-log - Percona Server (GPL), Release 13, Revision fd33d43
-- Server OS:                    Linux
-- HeidiSQL Version:             11.2.0.6213
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for BD_PEDIDOS
CREATE DATABASE IF NOT EXISTS `BD_PEDIDOS` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `BD_PEDIDOS`;

-- Dumping structure for table BD_PEDIDOS.clientes
CREATE TABLE IF NOT EXISTS `clientes` (
  `id_cliente` int(11) NOT NULL AUTO_INCREMENT,
  `nome_cliente` char(50) NOT NULL DEFAULT '',
  `endereco` char(50) NOT NULL DEFAULT '',
  `CEP` char(50) NOT NULL DEFAULT '',
  `MUNICIPIO` char(50) NOT NULL DEFAULT '',
  `BAIRRO` char(50) NOT NULL DEFAULT '',
  `ESTADO` char(50) NOT NULL DEFAULT '',
  `FONE` char(50) NOT NULL DEFAULT '',
  `CNPJ` char(50) NOT NULL DEFAULT '',
  `insc_est` char(50) NOT NULL DEFAULT '',
  `id_usuario` int(11) NOT NULL DEFAULT '0',
  `username` char(50) NOT NULL,
  PRIMARY KEY (`id_cliente`),
  KEY `FK_clientes_usuarios` (`id_usuario`),
  CONSTRAINT `FK_clientes_usuarios` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=122 DEFAULT CHARSET=utf8mb4;

-- Data exporting was unselected.

-- Dumping structure for table BD_PEDIDOS.fechamento_pedido
CREATE TABLE IF NOT EXISTS `fechamento_pedido` (
  `ID_Fechamento` int(11) NOT NULL AUTO_INCREMENT,
  `id_pedido` char(50) NOT NULL DEFAULT '',
  `id_transport` int(11) NOT NULL,
  `DATA_FECH` date NOT NULL,
  `HORA_FECH` time NOT NULL,
  `id_usuario` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`ID_Fechamento`),
  KEY `FK2_ID_Transport_Fech` (`id_transport`),
  KEY `FK3_ID_Usuario_Fech` (`id_usuario`),
  KEY `FK_fechamento_pedido_pedidos` (`id_pedido`),
  CONSTRAINT `FK2_ID_Transport_Fech` FOREIGN KEY (`id_transport`) REFERENCES `transporte` (`id_transport`),
  CONSTRAINT `FK3_ID_Usuario_Fech` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`),
  CONSTRAINT `FK_fechamento_pedido_pedidos` FOREIGN KEY (`id_pedido`) REFERENCES `pedidos` (`ID_Pedido`)
) ENGINE=InnoDB AUTO_INCREMENT=217 DEFAULT CHARSET=utf8mb4;

-- Data exporting was unselected.

-- Dumping structure for table BD_PEDIDOS.pedidos
CREATE TABLE IF NOT EXISTS `pedidos` (
  `ID_Pedido` char(50) NOT NULL DEFAULT 'AUTO_INCREMENT',
  `ID_Cliente` int(11) NOT NULL,
  `status_pedido` char(50) DEFAULT NULL,
  `username` char(50) DEFAULT NULL,
  `valor_total` double DEFAULT NULL,
  PRIMARY KEY (`ID_Pedido`),
  KEY `FK1_ID_Cliente` (`ID_Cliente`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Data exporting was unselected.

-- Dumping structure for table BD_PEDIDOS.produtos
CREATE TABLE IF NOT EXISTS `produtos` (
  `ID_Produto` int(11) NOT NULL AUTO_INCREMENT,
  `Artigo` char(50) NOT NULL,
  `COD_Prod` char(50) NOT NULL,
  PRIMARY KEY (`ID_Produto`)
) ENGINE=InnoDB AUTO_INCREMENT=83 DEFAULT CHARSET=utf8mb4;

-- Data exporting was unselected.

-- Dumping structure for table BD_PEDIDOS.produtos_pedido
CREATE TABLE IF NOT EXISTS `produtos_pedido` (
  `id_produtos_pedido` int(11) NOT NULL AUTO_INCREMENT,
  `id_pedido` char(50) DEFAULT NULL,
  `id_produto` int(11) NOT NULL DEFAULT '0',
  `quant` double NOT NULL DEFAULT '0',
  `preco_unit` double NOT NULL DEFAULT '0',
  `desenho` char(50) DEFAULT NULL,
  `variante` char(50) DEFAULT NULL,
  `total` double NOT NULL DEFAULT '0',
  `colecao` char(50) DEFAULT NULL,
  PRIMARY KEY (`id_produtos_pedido`),
  KEY `FK2_ID_Produto_Produtos` (`id_produto`),
  KEY `FK2_ID_Pedido_Pedidos` (`id_pedido`),
  CONSTRAINT `FK2_ID_Pedido_Pedidos` FOREIGN KEY (`id_pedido`) REFERENCES `pedidos` (`ID_Pedido`),
  CONSTRAINT `FK2_ID_Produto_Produtos` FOREIGN KEY (`id_produto`) REFERENCES `produtos` (`ID_Produto`)
) ENGINE=InnoDB AUTO_INCREMENT=505 DEFAULT CHARSET=utf8mb4;

-- Data exporting was unselected.

-- Dumping structure for table BD_PEDIDOS.transporte
CREATE TABLE IF NOT EXISTS `transporte` (
  `id_transport` int(11) NOT NULL AUTO_INCREMENT,
  `CNPJ` char(50) NOT NULL,
  `nome_local_entrega` char(50) NOT NULL,
  `ID_Pedido` char(50) NOT NULL DEFAULT '0',
  `End_Entrega` char(50) NOT NULL DEFAULT '0',
  `End_Cobranca` char(50) NOT NULL DEFAULT '0',
  `nome_transp` char(50) DEFAULT NULL,
  `obs` text,
  `n_pedido` char(50) DEFAULT NULL,
  `cond_pag` char(50) DEFAULT NULL,
  `anexo` char(200) DEFAULT NULL,
  PRIMARY KEY (`id_transport`),
  KEY `FK_transporte_pedidos` (`ID_Pedido`),
  CONSTRAINT `FK_transporte_pedidos` FOREIGN KEY (`ID_Pedido`) REFERENCES `pedidos` (`ID_Pedido`)
) ENGINE=InnoDB AUTO_INCREMENT=225 DEFAULT CHARSET=utf8mb4;

-- Data exporting was unselected.

-- Dumping structure for table BD_PEDIDOS.usuarios
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id_usuario` int(11) NOT NULL AUTO_INCREMENT,
  `username` char(50) NOT NULL,
  `nivel_perm` char(50) NOT NULL DEFAULT '0',
  `password` char(50) NOT NULL,
  `email` char(50) NOT NULL,
  `email_enc_1` char(50) DEFAULT NULL,
  `email_enc_2` char(50) DEFAULT NULL,
  PRIMARY KEY (`id_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4;

-- Data exporting was unselected.

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
