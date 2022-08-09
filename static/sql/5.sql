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
) ENGINE=InnoDB AUTO_INCREMENT=281 DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela querosite.log: ~16 rows (aproximadamente)
INSERT INTO `log` (`id`, `id_usuario`, `timestamp`, `mensagem`, `info_server`) VALUES
	(265, 1182, '2022-05-12 14:10:04', 'Realizado logout no sistema', '127.0.0.1 - Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/101.0.4951.54 Safari/537.36'),
	(266, 1182, '2022-05-17 14:13:59', 'login no sistema João Provezi - Id: 1182', '127.0.0.1 - Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/101.0.4951.54 Safari/537.36'),
	(267, 1182, '2022-05-17 14:15:15', 'Realizado logout no sistema', '127.0.0.1 - Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/101.0.4951.54 Safari/537.36'),
	(268, 1182, '2022-05-17 14:15:23', 'login no sistema João Provezi - Id: 1182', '127.0.0.1 - Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/101.0.4951.54 Safari/537.36'),
	(269, 1182, '2022-05-17 18:15:40', 'Realizado logout no sistema', '127.0.0.1 - Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/101.0.4951.54 Safari/537.36'),
	(270, 1182, '2022-05-17 20:38:10', 'login no sistema jprovezi@gmail.com', '127.0.0.1 - Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/101.0.4951.54 Safari/537.36'),
	(271, 1182, '2022-05-17 20:38:27', 'Realizado logout no sistema', '127.0.0.1 - Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/101.0.4951.54 Safari/537.36'),
	(272, 1182, '2022-05-17 20:38:34', 'login no sistema jprovezi@gmail.com', '127.0.0.1 - Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/101.0.4951.54 Safari/537.36'),
	(273, 1182, '2022-05-17 21:09:49', 'Realizado logout no sistema', '127.0.0.1 - Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/101.0.4951.54 Safari/537.36'),
	(274, 1182, '2022-05-18 12:43:35', 'login no sistema jprovezi@gmail.com', '127.0.0.1 - Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/101.0.4951.54 Safari/537.36'),
	(275, 1182, '2022-05-19 14:48:50', 'Realizado logout no sistema', '127.0.0.1 - Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/101.0.4951.67 Safari/537.36'),
	(276, 1182, '2022-05-19 14:48:52', 'login no sistema jprovezi@gmail.com', '127.0.0.1 - Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/101.0.4951.67 Safari/537.36'),
	(277, 1182, '2022-05-19 18:49:07', 'Realizado logout no sistema', '127.0.0.1 - Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/101.0.4951.67 Safari/537.36'),
	(278, 1182, '2022-05-19 19:01:10', 'login no sistema jprovezi@gmail.com', '127.0.0.1 - Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/101.0.4951.67 Safari/537.36'),
	(279, 1182, '2022-05-19 19:13:31', 'Realizado logout no sistema', '127.0.0.1 - Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/101.0.4951.67 Safari/537.36'),
	(280, 1182, '2022-05-19 19:13:54', 'login no sistema jprovezi@gmail.com', '127.0.0.1 - Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/101.0.4951.67 Safari/537.36');

-- Copiando estrutura para tabela querosite.menu
CREATE TABLE IF NOT EXISTS `menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `icone` varchar(50) NOT NULL,
  `url` varchar(150) DEFAULT NULL,
  `categoria` enum('pai','config','') NOT NULL,
  `idFilho` int(11) DEFAULT NULL,
  `ordem` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_menu_menu` (`idFilho`),
  CONSTRAINT `FK_menu_menu` FOREIGN KEY (`idFilho`) REFERENCES `menu` (`id`) ON DELETE SET NULL ON UPDATE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=68 DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela querosite.menu: ~33 rows (aproximadamente)
INSERT INTO `menu` (`id`, `nome`, `icone`, `url`, `categoria`, `idFilho`, `ordem`) VALUES
	(14, 'Usuários do Sistema', '<i class="fas fa-users"></i>', 'usuario', 'config', NULL, 2),
	(15, 'Perfil', '<i class="fab fa-buromobelexperte"></i>', 'perfil-usuario', 'config', NULL, 1),
	(16, 'Configurações de Contato', '<i class="fas fa-id-card-alt"></i>', 'empresa', '', 58, 1),
	(17, 'Configurações', '<i class="fas fa-cogs"></i>', 'config', 'config', NULL, 3),
	(27, 'Informações de Reforço', '<i class="fas fa-user-tie"></i>', 'info-reforco', '', 52, 2),
	(28, 'Gerenciar Site', '<i class="ion ion-md-laptop"></i>', NULL, 'pai', NULL, 1),
	(29, 'Agenda (em desenvolvimento)', '<i class="fas fa-align-justify"></i>', NULL, 'pai', NULL, 2),
	(33, 'Frase de Impacto', '<i class="fas fa-arrow-alt-circle-up"></i>', 'frase-impacto', '', 52, 4),
	(39, 'Lista Produtos', '<i class="fab fa-product-hunt"></i>', 'produtos-lista', '', 54, 2),
	(40, 'Banner Principal', '<i class="fas fa-images"></i>', 'banner-principal', '', 52, 1),
	(41, 'Categoria Produto', '<i class="fab fa-product-hunt"></i>', 'categoria-produtos', '', 54, 1),
	(42, 'Leads', '<i class="far fa-comments"></i>', 'leads', '', 58, 2),
	(43, 'Dúvidas da Home', '<i class="fab fa-facebook-square"></i>', 'duvidas-da-home', '', 52, 3),
	(44, 'Equipe', '<i class="fas fa-th-large"></i>', 'equipe-lista', '', 53, 1),
	(45, 'Marketing (em desenvolvimento)', '<i class="fas fa-th-large"></i>', NULL, 'pai', NULL, 3),
	(50, 'Layout', '<i class="fas fa-cogs"></i>', 'layout', '', 67, 6),
	(51, 'SEO', '<i class="fas fa-cogs"></i>', 'seo', '', 67, 7),
	(52, 'Home', '<i class="fas fa-th-large"></i>', 'home', '', 28, 1),
	(53, 'Institucional', '<i class="fas fa-th-large"></i>', 'institucional', '', 28, 2),
	(54, 'Produtos', '<i class="fas fa-th-large"></i>', 'produtos', '', 28, 3),
	(55, 'Serviços', '<i class="fas fa-th-large"></i>', NULL, '', 28, 4),
	(56, 'Projetos', '<i class="fas fa-th-large"></i>', 'projetos-lista', '', 28, 5),
	(57, 'Clientes', '<i class="fas fa-th-large"></i>', 'clientes-lista', '', 28, 6),
	(58, 'Contatos', '<i class="fas fa-th-large"></i>', 'contatos-lista', '', 28, 7),
	(59, 'Blog', '<i class="fas fa-th-large"></i>', 'blog-lista', '', 28, 8),
	(60, 'Dúvidas', '<i class="fas fa-th-large"></i>', 'duvidas-lista', '', 28, 9),
	(61, 'Páginas Extras', '<i class="fas fa-th-large"></i>', 'paginas-extras', '', 28, 10),
	(62, 'História Empresa', '<i class="fas fa-th-large"></i>', 'historia-empresa', '', 53, 2),
	(63, 'Lista Projetos', '<i class="fab fa-product-hunt"></i>', 'projetos-lista', '', 56, 2),
	(64, 'Categoria Projetos', '<i class="fab fa-product-hunt"></i>', 'categoria-projetos', '', 56, 1),
	(65, 'Lista Serviços', '<i class="fab fa-product-hunt"></i>', 'servicos-lista', '', 55, 2),
	(66, 'Categoria Serviços', '<i class="fab fa-product-hunt"></i>', 'categoria-serviços', '', 55, 1),
	(67, 'Configurações do Site', '<i class="fas fa-th-large"></i>', 'configuracoes-site', '', 28, 8);

-- Copiando estrutura para tabela querosite.notificacoes
CREATE TABLE IF NOT EXISTS `notificacoes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mensagem` varchar(80) NOT NULL,
  `aberta` enum('S','N') NOT NULL DEFAULT 'N',
  `url` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela querosite.notificacoes: ~8 rows (aproximadamente)
INSERT INTO `notificacoes` (`id`, `mensagem`, `aberta`, `url`) VALUES
	(1, 'Essa foi a primeira notificacao', 'N', NULL),
	(2, 'Notificação de teste do banco de dados. Notificação de teste do banco de dados. ', 'S', NULL),
	(3, 'Notificação de teste do banco de dados. Notificação de teste do banco de dados. ', 'S', NULL),
	(4, 'Notificação de teste do banco de dados. Notificação de teste do banco de dados. ', 'S', NULL),
	(5, 'Notificação de teste do banco de dados. Notificação de teste do banco de dados. ', 'S', NULL),
	(6, 'Ultima notificação do sistema aqui', 'S', NULL),
	(7, 'setima notificacao', 'S', NULL),
	(8, 'Bento da Silva enviou uma mensagem pelo site', 'S', 'http://local.querosite.digital/leads');

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

-- Copiando dados para a tabela querosite.produtos: ~1 rows (aproximadamente)
INSERT INTO `produtos` (`id`, `titulo`, `texto_curto`, `texto`, `dir_galeria`, `capa`, `categoria_id`, `ordem`) VALUES
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

-- Copiando estrutura para tabela querosite.single_url
CREATE TABLE IF NOT EXISTS `single_url` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `controlador` varchar(200) NOT NULL,
  `view` varchar(200) NOT NULL,
  `tabela` varchar(50) NOT NULL,
  `id_busca` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COMMENT='tabela para gravar os controladores e indexar seus id de busca';

-- Copiando dados para a tabela querosite.single_url: ~2 rows (aproximadamente)
INSERT INTO `single_url` (`id`, `controlador`, `view`, `tabela`, `id_busca`) VALUES
	(1, 'meucarronovo', 'clientes', 'produtos', 50),
	(3, 'comofazerseucachorrocomer', 'blog', 'produtos', 50),
	(4, 'fazendobiscoitos', 'blog', 'produtos', 50);

-- Copiando estrutura para tabela querosite.usuarios
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `nome` varchar(200) NOT NULL,
  `email` varchar(100) NOT NULL,
  `senha` varchar(100) NOT NULL,
  `capa` varchar(100) DEFAULT NULL,
  `dir_galeria` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=1186 DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela querosite.usuarios: ~0 rows (aproximadamente)
INSERT INTO `usuarios` (`id`, `nome`, `email`, `senha`, `capa`, `dir_galeria`) VALUES
	(1182, 'João Provezi', 'jprovezi@gmail.com', '140df00b2acb00cc014271d9ad4e83bd', '939e08aa45650707e38f0e9181bd14d8.jpg', 'd609060bba1bb251b5ce72da25d1a97b');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
