-- --------------------------------------------------------
-- Servidor:                     127.0.0.1
-- Versão do servidor:           10.4.24-MariaDB - mariadb.org binary distribution
-- OS do Servidor:               Win64
-- HeidiSQL Versão:              12.0.0.6468
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Copiando estrutura para tabela querosite.config
CREATE TABLE IF NOT EXISTS `config` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `limit_page` int(11) NOT NULL DEFAULT 0 COMMENT 'numero de linhas limites',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela querosite.config: ~0 rows (aproximadamente)
INSERT INTO `config` (`id`, `limit_page`) VALUES
	(1, 25);

-- Copiando estrutura para tabela querosite.empresa
CREATE TABLE IF NOT EXISTS `empresa` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `capa` varchar(50) DEFAULT NULL,
  `dir_galeria` varchar(50) DEFAULT NULL,
  `cnpj` varchar(50) DEFAULT NULL,
  `nome_fantasia` varchar(100) DEFAULT NULL,
  `razao_social` varchar(100) DEFAULT NULL,
  `data_abertura` varchar(15) DEFAULT NULL,
  `endereco` varchar(100) DEFAULT NULL,
  `email_primario` varchar(100) DEFAULT NULL,
  `email_secundario` varchar(100) DEFAULT NULL,
  `telefone` varchar(100) DEFAULT NULL,
  `whatsapp` varchar(100) DEFAULT NULL,
  `facebook` varchar(100) DEFAULT NULL,
  `linkedin` varchar(100) DEFAULT NULL,
  `instagram` varchar(100) DEFAULT NULL,
  `youtube` varchar(100) DEFAULT NULL,
  `site` varchar(150) DEFAULT NULL,
  `cor_primaria` varchar(25) DEFAULT NULL,
  `cor_secundaria` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela querosite.empresa: ~0 rows (aproximadamente)
INSERT INTO `empresa` (`id`, `capa`, `dir_galeria`, `cnpj`, `nome_fantasia`, `razao_social`, `data_abertura`, `endereco`, `email_primario`, `email_secundario`, `telefone`, `whatsapp`, `facebook`, `linkedin`, `instagram`, `youtube`, `site`, `cor_primaria`, `cor_secundaria`) VALUES
	(1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- Copiando estrutura para tabela querosite.full_banner
CREATE TABLE IF NOT EXISTS `full_banner` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `capa` varchar(50) DEFAULT NULL,
  `dir_galeria` varchar(50) DEFAULT NULL,
  `ativado` enum('S','N') DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela querosite.full_banner: 1 rows
/*!40000 ALTER TABLE `full_banner` DISABLE KEYS */;
INSERT INTO `full_banner` (`id`, `capa`, `dir_galeria`, `ativado`) VALUES
	(1, 'Full_banner.jpg', 'd0d7a551f00e7993cc4157272c460b26', 'S');
/*!40000 ALTER TABLE `full_banner` ENABLE KEYS */;

-- Copiando estrutura para tabela querosite.leads
CREATE TABLE IF NOT EXISTS `leads` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(200) NOT NULL,
  `whatsapp` varchar(50) NOT NULL,
  `mensagem` longtext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=30 DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela querosite.leads: 0 rows
/*!40000 ALTER TABLE `leads` DISABLE KEYS */;
/*!40000 ALTER TABLE `leads` ENABLE KEYS */;

-- Copiando estrutura para tabela querosite.log
CREATE TABLE IF NOT EXISTS `log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_usuario` int(11) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `mensagem` varchar(500) DEFAULT NULL,
  `info_server` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_log_usuarios` (`id_usuario`),
  CONSTRAINT `FK_log_usuarios` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=266 DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela querosite.log: ~0 rows (aproximadamente)
INSERT INTO `log` (`id`, `id_usuario`, `timestamp`, `mensagem`, `info_server`) VALUES
	(265, 1182, '2022-05-12 14:10:04', 'Realizado logout no sistema', '127.0.0.1 - Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/101.0.4951.54 Safari/537.36');

-- Copiando estrutura para tabela querosite.menu
CREATE TABLE IF NOT EXISTS `menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `icone` varchar(50) NOT NULL,
  `url` varchar(150) DEFAULT NULL,
  `controller` varchar(150) DEFAULT NULL,
  `categoria` enum('pai','submenu','config','') NOT NULL,
  `idFilho` int(11) DEFAULT NULL,
  `ordem` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_menu_menu` (`idFilho`),
  CONSTRAINT `FK_menu_menu` FOREIGN KEY (`idFilho`) REFERENCES `menu` (`id`) ON DELETE SET NULL ON UPDATE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=68 DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela querosite.menu: ~32 rows (aproximadamente)
INSERT INTO `menu` (`id`, `nome`, `icone`, `url`, `controller`, `categoria`, `idFilho`, `ordem`) VALUES
	(14, 'Usuários do Sistema', '<i class="fas fa-users"></i>', 'admin-usuario', 'adminusuario', 'config', NULL, 2),
	(15, 'Perfil', '<i class="fab fa-buromobelexperte"></i>', 'admin-perfil-usuario', 'adminperfilusuario', 'config', NULL, 1),
	(16, 'Configurações de Contato', '<i class="fas fa-id-card-alt"></i>', 'admin-empresa', 'adminempresa', '', 58, 1),
	(17, 'Configurações', '<i class="fas fa-cogs"></i>', 'admin-config', 'adminconfig', 'config', NULL, 3),
	(27, 'Informações de Reforço', '<i class="fas fa-user-tie"></i>', 'admin-info-reforco', 'admininforeforco', '', 52, 2),
	(28, 'Gerenciar Site', '<i class="ion ion-md-laptop"></i>', NULL, NULL, 'pai', NULL, 1),
	(29, 'Agenda (futuro)', '<i class="fas fa-align-justify"></i>', NULL, NULL, 'pai', NULL, 2),
	(33, 'Frase de Impacto', '<i class="fas fa-arrow-alt-circle-up"></i>', 'admin-frase-impacto', 'adminfraseimpacto', '', 52, 4),
	(39, 'Lista Produtos', '<i class="fab fa-product-hunt"></i>', 'admin-produtos', 'adminprodutos', '', 54, 2),
	(40, 'Banner Principal', '<i class="fas fa-images"></i>', 'admin-banner-principal', 'adminbannerprincipal', '', 52, 1),
	(41, 'Categoria Produto', '<i class="fab fa-product-hunt"></i>', 'admin-categoria-produtos', 'admincategoriaprodutos', '', 54, 1),
	(42, 'Leads', '<i class="far fa-comments"></i>', 'admin-leads', 'adminleads', '', 58, 2),
	(43, 'Dúvidas da Home', '<i class="fab fa-facebook-square"></i>', 'admin-duvidas-da-home', 'adminduvidasdahome', '', 52, 3),
	(44, 'Equipe', '<i class="fas fa-th-large"></i>', 'admin-equipe', 'adminequipe', '', 53, 1),
	(45, 'Marketing (futuro)', '<i class="fas fa-th-large"></i>', NULL, NULL, 'pai', NULL, 3),
	(50, 'Layout', '<i class="fas fa-cogs"></i>', 'admin-layout', 'adminlayout', '', 67, 6),
	(51, 'SEO', '<i class="fas fa-cogs"></i>', 'admin-seo', 'adminseo', '', 67, 7),
	(52, 'Home', '<i class="fas fa-th-large"></i>', NULL, NULL, 'submenu', 28, 1),
	(53, 'Institucional', '<i class="fas fa-th-large"></i>', NULL, NULL, 'submenu', 28, 2),
	(54, 'Produtos', '<i class="fas fa-th-large"></i>', NULL, NULL, 'submenu', 28, 3),
	(55, 'Serviços', '<i class="fas fa-th-large"></i>', NULL, NULL, 'submenu', 28, 4),
	(56, 'Projetos', '<i class="fas fa-th-large"></i>', NULL, NULL, 'submenu', 28, 5),
	(57, 'Clientes', '<i class="fas fa-th-large"></i>', NULL, NULL, '', 28, 6),
	(58, 'Contatos', '<i class="fas fa-th-large"></i>', NULL, NULL, 'submenu', 28, 7),
	(59, 'Blog', '<i class="fas fa-th-large"></i>', NULL, NULL, '', 28, 8),
	(60, 'Dúvidas', '<i class="fas fa-th-large"></i>', NULL, NULL, '', 28, 9),
	(61, 'Páginas Extras', '<i class="fas fa-th-large"></i>', NULL, NULL, '', 28, 10),
	(62, 'História Empresa', '<i class="fas fa-th-large"></i>', 'admin-historia-empresa', 'adminhistoriaempresa', '', 53, 2),
	(63, 'Lista Projetos', '<i class="fab fa-product-hunt"></i>', 'admin-projetos', 'adminprojetos', '', 56, 2),
	(64, 'Categoria Projetos', '<i class="fab fa-product-hunt"></i>', 'admin-categoria-projetos', 'admincategoriaprojetos', '', 54, 1),
	(65, 'Lista Serviços', '<i class="fab fa-product-hunt"></i>', 'admin-servicos', 'adminservicos', '', 55, 2),
	(66, 'Categoria Serviços', '<i class="fab fa-product-hunt"></i>', 'admin-categoria-serviços', 'admincategoriaservicos', '', 55, 1),
	(67, 'Configurações do Site', '<i class="fas fa-th-large"></i>', NULL, NULL, 'submenu', 28, 8);

-- Copiando estrutura para tabela querosite.produtos
CREATE TABLE IF NOT EXISTS `produtos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(150) DEFAULT NULL,
  `texto_curto` varchar(250) DEFAULT NULL,
  `texto` longtext DEFAULT NULL,
  `dir_galeria` varchar(100) DEFAULT NULL,
  `capa` varchar(100) DEFAULT NULL,
  `categoria_id` int(11) DEFAULT NULL,
  `ordem` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_produtos_produtos_categoria` (`categoria_id`),
  CONSTRAINT `FK_produtos_produtos_categoria` FOREIGN KEY (`categoria_id`) REFERENCES `produtos_categoria` (`id`) ON DELETE SET NULL ON UPDATE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela querosite.produtos: ~11 rows (aproximadamente)
INSERT INTO `produtos` (`id`, `titulo`, `texto_curto`, `texto`, `dir_galeria`, `capa`, `categoria_id`, `ordem`) VALUES
	(40, 'Luiz Eduardo Caminha', '19/03/1989 - 16/06/1991', 'Presidente do PSDB BLUMENAU desde: 19/03/1989 - 16/06/1991', '421b329e7e09a7936db608e60f958434', '2-LUIZ_EDUARDO_CAMINHA.jpg', NULL, 2),
	(41, 'Sérgio F. Hess de Souza', '16/06/1991 - 16/09/1993 → 16/09/1993 - 20/08/1995', 'Presidente do PSDB BLUMENAU desde: 16/06/1991 - 16/09/1993 → 16/09/1993 - 20/08/1995', 'c10b5b5a9f701bfc31c4c8f110187c03', '3-SERGIO_F._HESS_DE_SOUZA.jpg', NULL, 3),
	(42, 'Dalírio Jose Beber', '20/08/1995 - 29/10/1999', 'Presidente do PSDB BLUMENAU desde: 20/08/1995 - 29/10/1999', 'efc08c59b8b21344fa8efb0eacc3eaba', '4-DALIRIO_JOSE_BEBER.jpg', NULL, 4),
	(43, 'Edelcio Jose Vicieira', '16/03/1996 - 15/12/1996 → 16/07/1998 - 16/12/1998', 'Presidente do PSDB BLUMENAU desde: 16/03/1996 - 15/12/1996 → 16/07/1998 - 16/12/1998', 'cd20ca4ff8bc13e14a1e220e42eaaa18', '5-EDELCIO_JOSE_VIEIRA.jpg', NULL, 5),
	(44, 'Norberto Mette', '29/10/1999 - 19/08/2001', 'Presidente do PSDB BLUMENAU desde: 29/10/1999 - 19/08/2001', '48eba81b5cde2008f48b9023f8cc2f07', '6-NORBERTO_METTE.jpg', NULL, 6),
	(45, 'Giancarlo Tomelin', '19/06/2005 - 18/09/2007', 'Presidente do PSDB BLUMENAU desde: 19/06/2005 - 18/09/2007', '2c1ff2f4adfcc9ccd2b1157873d38d66', '7-GIANCARLO_TOMELIN.jpg', NULL, 7),
	(46, 'Valdair José Matias', '1/08/2001 - 21/08/2003 → 21/08/2003-19/06/2005 → 18/09/2007 - 20/03/2011', 'Presidente do PSDB BLUMENAU desde: 1/08/2001 - 21/08/2003 → 21/08/2003-19/06/2005 →\n18/09/2007 - 20/03/2011', 'b6fd2c9750b49494acf8922a24b202aa', '8-VALDAIR_JOSE_MATIAS.jpg', NULL, 8),
	(47, 'Napoleão Bernardes Neto', '20/03/2011 - 01/07/2012', 'Presidente do PSDB BLUMENAU desde: 20/03/2011 - 01/07/2012', 'd47862ecb875d830d13c87f9e499da2a', '9-NAPOLEAO_BERNARDES_NETO.jpg', NULL, 9),
	(48, 'Raimundo Mette', '01/07/2012 - 15/05/2015', 'Presidente do PSDB BLUMENAU desde: 01/07/2012 - 15/05/2015', '7fe0257d0297b31e559e8fb6129dd18a', '10-RAIMUNDO_METTE.jpg', NULL, 10),
	(49, 'José Carlos Oechsler', '15/05/2015 - 20/03/2019', 'Presidente do PSDB BLUMENAU desde: 15/05/2015 - 20/03/2019', '18482ee0e59ebbf5f91818abfe744f43', '11-Jose_Carlos_Oechsler.jpg', NULL, 11),
	(50, 'Alexandre Agenor Matias', '20/03/2019 - ATUAL', 'Presidente do PSDB BLUMENAU desde: 20/03/2019 - ATUAL', '90e932375b8d395aca5e4138ccd7555a', '12-ALEXANDRE_AGENOR_MATIAS.jpg', NULL, 12);

-- Copiando estrutura para tabela querosite.produtos_categoria
CREATE TABLE IF NOT EXISTS `produtos_categoria` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `categoria` varchar(100) DEFAULT NULL,
  `cor_bloco` varchar(50) DEFAULT NULL,
  `cor_texto` varchar(50) DEFAULT NULL,
  `ordem` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela querosite.produtos_categoria: ~0 rows (aproximadamente)

-- Copiando estrutura para tabela querosite.usuarios
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `nome` varchar(200) NOT NULL,
  `email` varchar(100) NOT NULL,
  `senha` varchar(100) NOT NULL,
  `capa` varchar(100) DEFAULT NULL,
  `dir_galeria` varchar(100) DEFAULT NULL,
  `id_perfil` int(11) DEFAULT NULL,
  `limit_page` int(11) DEFAULT NULL,
  `template_tema` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  KEY `FK_usuarios_perfil_sistema` (`id_perfil`),
  CONSTRAINT `FK_usuarios_perfil_sistema` FOREIGN KEY (`id_perfil`) REFERENCES `perfil_sistema` (`id`) ON DELETE SET NULL ON UPDATE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=1186 DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela querosite.usuarios: ~1 rows (aproximadamente)
INSERT INTO `usuarios` (`id`, `nome`, `email`, `senha`, `capa`, `dir_galeria`, `id_perfil`, `limit_page`, `template_tema`) VALUES
	(1182, 'João Provezi', 'jprovezi@gmail.com', '140df00b2acb00cc014271d9ad4e83bd', '939e08aa45650707e38f0e9181bd14d8.jpg', 'd609060bba1bb251b5ce72da25d1a97b', 1, NULL, NULL);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
