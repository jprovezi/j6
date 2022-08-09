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

-- Copiando estrutura para tabela querosite.conectado_com_voce
CREATE TABLE IF NOT EXISTS `conectado_com_voce` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `iframe` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela querosite.conectado_com_voce: ~0 rows (aproximadamente)

-- Copiando estrutura para tabela querosite.config
CREATE TABLE IF NOT EXISTS `config` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `limit_page` int(11) NOT NULL DEFAULT 0 COMMENT 'numero de linhas limites',
  `admin_master` int(11) NOT NULL DEFAULT 0 COMMENT 'Id do perfil do admin master',
  `horas_diaria` time NOT NULL DEFAULT '00:00:00',
  `intervalo_ponto` time NOT NULL DEFAULT '00:00:00',
  `template_tema` varchar(50) NOT NULL DEFAULT '0',
  `metatags` mediumtext DEFAULT NULL,
  `css` longtext DEFAULT NULL,
  `mapa` longtext DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela querosite.config: ~0 rows (aproximadamente)
INSERT INTO `config` (`id`, `limit_page`, `admin_master`, `horas_diaria`, `intervalo_ponto`, `template_tema`, `metatags`, `css`, `mapa`) VALUES
	(1, 25, 1, '08:30:00', '01:00:00', 'cosmo', '<meta name="description" content="Campanha 2020 para o Vereador Jota Provezi, filiado ao PSDB 452222">\r\n<meta name="keywords" content="Campanha 2020, Vereadores Blumenau, PSDB Blumenau">\r\n<meta name="author" content="Qportais Comunicação">\r\n<title>Campanha 2020 PSDB - Vereador Jota Provezi®</title>', '#header.sticky {\r\n  position: fixed;\r\n  background: #ffcd00;\r\n  height: auto !important;\r\n  box-shadow: 0 0 11px 2px rgba(0, 0, 0, 0.1);\r\n}\r\n.sticky .navbar-default .navbar-nav > li > a {\r\n   color: #14327b;\r\n}\r\nbody{\r\nbackground-color: #fff;\r\n}\r\np{\r\ncolor: #172c77;\r\n}\r\nh1{\r\ncolor:#172c77;\r\n}\r\nh2{\r\ncolor:#172c77;\r\n}\r\nh3{\r\ncolor:#172c77;\r\n}\r\nh4{\r\ncolor:#172c77;\r\n}\r\n\r\n.navbar-default .navbar-nav > li > a {\r\ndisplay: inline;\r\npadding: 0;\r\ncolor: #54b7fb;\r\n}\r\n.portfolio-item{\r\nborder: solid #FFF 5px;\r\n}\r\n.navbar-default .navbar-toggle[aria-expanded="true"] {\r\n    background: #2c3091;\r\n}\r\n.navbar-default .navbar-toggle:hover, .navbar-default .navbar-toggle:focus {\r\n    background-color: #54b7fb;\r\n}\r\n.navbar-default .navbar-toggle {\r\n    background: #54b7fb;\r\n}\r\n.botao-enviar{\r\nbackground-color: #172c77;\r\ncolor: #fff;\r\n}\r\n.input-nome{\r\nbackground-color: #fff;\r\ncolor: #172c77;\r\nborder: 1px solid #172c77;\r\n}\r\n.input-telefone{\r\nbackground-color: #fff;\r\ncolor: #172c77;\r\nborder: 1px solid #172c77;\r\n}\r\n.input-mensagem{\r\nbackground-color: #fff;\r\ncolor: #172c77;\r\nborder: 1px solid #172c77;\r\n}\r\n.banner-apoio{\r\nmargin: 0 !important;\r\n}', '<iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d14229.658364738725!2d-49.0633038!3d-26.9220681!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x43fbbbaa7c091445!2sPSDB!5e0!3m2!1spt-BR!2sbr!4v1626094721270!5m2!1spt-BR!2sbr" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>');

-- Copiando estrutura para tabela querosite.depoimentos
CREATE TABLE IF NOT EXISTS `depoimentos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `iframe` longtext DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela querosite.depoimentos: ~0 rows (aproximadamente)

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
	(1, 'LOGO_SITE.png', 'e8893a979468b777de8f3ae63bf57dbf', '', 'PSDB BLUMENAU', 'PSDB BLUMENAU', '', 'R. Floriano Peixoto, 55 - Centro, Blumenau - SC, 89010-500', 'contato@psdbblumenau.com.br', '', '(47) 3041-4545', '(47) 30414-545', 'https://www.facebook.com/psdbblumenauoficial', '', '', '', 'www.psdbblumenau.com.br', '13337c', 'ffffff');

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

-- Copiando estrutura para tabela querosite.full_banner_mobile
CREATE TABLE IF NOT EXISTS `full_banner_mobile` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `capa` varchar(50) DEFAULT NULL,
  `dir_galeria` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela querosite.full_banner_mobile: 1 rows
/*!40000 ALTER TABLE `full_banner_mobile` DISABLE KEYS */;
INSERT INTO `full_banner_mobile` (`id`, `capa`, `dir_galeria`) VALUES
	(1, 'full_banner_mobile.jpg', 'd0d7a551f00e7993cc4157272c460b26');
/*!40000 ALTER TABLE `full_banner_mobile` ENABLE KEYS */;

-- Copiando estrutura para tabela querosite.informacoes_landing_page
CREATE TABLE IF NOT EXISTS `informacoes_landing_page` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(150) DEFAULT NULL,
  `texto` varchar(150) DEFAULT NULL,
  `dir_galeria` varchar(100) DEFAULT NULL,
  `capa` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela querosite.informacoes_landing_page: ~4 rows (aproximadamente)
INSERT INTO `informacoes_landing_page` (`id`, `titulo`, `texto`, `dir_galeria`, `capa`) VALUES
	(24, 'Amigo dos animais', 'Partido que ama os animais e luta por todas as causas a favor deles.', '7df038849cafbd5137f92d61049a73b8', 'petfriends.jpg'),
	(25, 'Apoio as mulheres', 'Acreditamos na luta das mulheres na sociedade pelos seus direitos.', 'b6b469a41034cfb7a3719a104b10fa2a', 'Apoio-as-mulheres.jpg'),
	(26, 'Apoio ao jovem empreendedor', 'Acreditamos no potencial do jovem para nossa cidade.', '12ca491578c1906cefe422789653816a', 'jovem-empreendedor.jpg'),
	(27, 'Comprometimento', 'Nosso Foco é ser comprometido e responsável com toda nossa Blumenau.', '628443476fae8ea0417bd79c0f3969ec', 'Compromisso.jpg');

-- Copiando estrutura para tabela querosite.info_estatico
CREATE TABLE IF NOT EXISTS `info_estatico` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `capa` varchar(50) DEFAULT NULL,
  `dir_galeria` varchar(50) DEFAULT NULL,
  `nome_bt_destaque` varchar(50) DEFAULT NULL,
  `url_redirecionamento` varchar(200) DEFAULT NULL,
  `texto_whatsapp` varchar(150) DEFAULT NULL,
  `whatsapp` varchar(150) DEFAULT NULL,
  `texto_rodape` mediumtext DEFAULT NULL,
  `capa2` varchar(100) DEFAULT NULL,
  `texto1` longtext NOT NULL,
  `texto2` longtext NOT NULL,
  `texto3` longtext DEFAULT NULL,
  `texto4` longtext DEFAULT NULL,
  `texto5` longtext DEFAULT NULL,
  `ativado` enum('S','N') DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela querosite.info_estatico: ~8 rows (aproximadamente)
INSERT INTO `info_estatico` (`id`, `capa`, `dir_galeria`, `nome_bt_destaque`, `url_redirecionamento`, `texto_whatsapp`, `whatsapp`, `texto_rodape`, `capa2`, `texto1`, `texto2`, `texto3`, `texto4`, `texto5`, `ativado`) VALUES
	(1, 'LOGO_SITE.png', 'b1b466ea2e925932ea2ff0f56f57eeb0', 'Fale com o PSDB BLUMENAU', '', 'PSDB BLUMENAU', '(47) 30414-545', 'NEM ANTIGA NEM NOVA POLÍTICA, E SIM A CORRETA!', NULL, 'BANDEIRAS', '', '', 'GALERIA REUNIÕES E EVENTOS', 'PRESIDENTES', NULL),
	(2, 'c0fc0b2f0f029c2a61609cc258bcb439.png', '06d92e289cc24d74d4873156a8430c71', NULL, '', NULL, NULL, NULL, '95c5dfbe8a1f7ccbd359e1462f7ea803.png', 'Qportais Comunicação', 'Empresa na área de comunicação em Blumenau/sc', NULL, NULL, NULL, 'S'),
	(3, 'full_banner_mobile.jpg', 'b1b466ea2e925932ea2ff0f56f57eeb8', NULL, NULL, NULL, NULL, NULL, NULL, 'COMO TUDO COMEÇOU', 'O Partido Social da Democracia Brasileira foi formado no município de Blumenau em meados de 1988 - ano do nascimento de nossa Constituição Federal. Aos 2 dias do mês de julho daquele ano, reuniram-se os filiados ao PSDB para deliberarem sobre a nomeação da Comissão Diretora Municipal, contando com a presença de grandes nomes da história do Partido. Momento este no qual se deu início as primeiras ações da Comissão Diretora Municipal do PSDB em Blumenau.\n\nO PSDB Blumenau, ao longo dos 32 anos de existência, foi presidido por 12 doze companheiros tucanos. Seu primeiro presidente foi Maurici Nascimento – de 1988 a 1989. Sucedido por: Luiz Eduardo Caminha, de 1989 até 1991; Sérgio F. Hess de Souza, de 1991 até 1993 cumulado com segundo mandato de 1993 até 1995; Dalírio José Beber, de 1995 até 1999; Edélcio José Vieira, de 1996 até 1998; Norberto Mette, de 1999 até 2001; Valdair José Matias, de 2001 até 2003, cumulado aos mandatos de 2003 até 2005, retornando a presidência em 2007 até 2011. Ente os anos 2005 à 2007 presidiu a Comissão Executiva do PSDB Blumenau, Giancarlo Tomelin. A partir de 2011 até 2012, Napoleão Bernardes Neto ocupou a função, sendo sucedido por Raimundo Mette, de 2012 até 2015; José Carlos Oescler, de 2015 até 2019; sendo vigente de 2019 até o presente momento o mandato de Alexandre Agenor Matias.\n\nO Partido local elegeu o prefeito Napoleão Bernardes Neto com mandato de 2013 a 2018, sendo eleito com 70,70% dos votos válidos.  \nO PSDB de Blumenau no pleito de 2020, realizou o feito histórico de eleger a primeira vice-prefeita da cidade, Maria Regina de Souza Soar. Além do mais, elegeu 2 vereadores à Câmara Municipal dos Vereadores de Blumenau - Alexandre Agenor Matias, atuando em seu segundo mandato e Mauricio Goll em seu primeiro mandato, realizando incansavelmente ações em prol da cidade mais florida de Santa Catarina, a nossa bela Blumenau.', '', '', NULL, NULL),
	(4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', NULL, NULL, NULL),
	(5, 'banner_apoio.jpg', 'e88760506da95e8cc1fe4f0144a54b01', NULL, NULL, NULL, NULL, NULL, NULL, '', '', NULL, NULL, NULL, NULL),
	(6, 'imagem_partido_fundo_site.jpg', 'b1b466ea2e925932ea2ff0f56f57ee10', NULL, NULL, NULL, NULL, NULL, NULL, 'PODEMOS + PSDB - UNIÃO QUE DEU CERTO!', 'Dois grandes partidos unidos por um só sentimento, trazer o melhor para o povo da sua cidade. Trazemos como candidato eleito a prefeito Mario hildebrandt, e como vice Maria Regina, dois grandes nomes que fizeram e ainda fazem muito por esta cidade e a todos que nela vivem.', NULL, NULL, NULL, NULL),
	(7, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'PSDB BLUMENAU', 'NEM ANTIGA NEM NOVA POLÍTICA, E SIM A CORRETA!', NULL, NULL, NULL, NULL),
	(8, 'joao-e-miguel-fade.png', '25485dfc411e18d9bdb87947b4582321', NULL, NULL, NULL, NULL, NULL, NULL, '', '', NULL, NULL, NULL, NULL);

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
) ENGINE=InnoDB AUTO_INCREMENT=264 DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela querosite.log: ~77 rows (aproximadamente)
INSERT INTO `log` (`id`, `id_usuario`, `timestamp`, `mensagem`, `info_server`) VALUES
	(187, 1182, '2020-09-09 14:20:45', 'Realizado logout no sistema', '127.0.0.1 - Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/85.0.4183.83 Safari/537.36'),
	(188, 1182, '2020-09-09 14:20:50', 'Realizado login no sistema', '127.0.0.1 - Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/85.0.4183.83 Safari/537.36'),
	(189, 1182, '2020-09-09 14:23:30', 'Cadastrado novo iframe conectado com você', '127.0.0.1 - Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/85.0.4183.83 Safari/537.36'),
	(190, 1182, '2020-09-09 14:23:34', 'Excluído conectado com você 0?_=1599661410625', '127.0.0.1 - Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/85.0.4183.83 Safari/537.36'),
	(191, 1182, '2020-09-09 14:23:36', 'Cadastrado novo iframe conectado com você', '127.0.0.1 - Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/85.0.4183.83 Safari/537.36'),
	(192, 1182, '2020-09-09 14:23:54', 'Editado conectado com você', '127.0.0.1 - Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/85.0.4183.83 Safari/537.36'),
	(193, 1182, '2020-09-09 14:24:13', 'Cadastrado novo iframe conectado com você', '127.0.0.1 - Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/85.0.4183.83 Safari/537.36'),
	(194, 1182, '2020-09-09 14:24:50', 'Cadastrado novo iframe conectado com você', '127.0.0.1 - Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/85.0.4183.83 Safari/537.36'),
	(195, 1182, '2020-09-09 14:25:39', 'Cadastrado novo iframe conectado com você', '127.0.0.1 - Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/85.0.4183.83 Safari/537.36'),
	(196, 1182, '2020-09-09 14:25:52', 'Cadastrado novo iframe conectado com você', '127.0.0.1 - Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/85.0.4183.83 Safari/537.36'),
	(197, 1182, '2020-09-09 14:26:59', 'Cadastrado novo iframe conectado com você', '127.0.0.1 - Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/85.0.4183.83 Safari/537.36'),
	(198, 1182, '2020-09-10 11:58:59', 'Editado usuário Qportais Suporte - campanhapsdb@agenciaqportais.com.br', '127.0.0.1 - Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/85.0.4183.83 Safari/537.36'),
	(199, 1182, '2020-09-10 16:37:42', 'Realizado logout no sistema', '127.0.0.1 - Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/85.0.4183.83 Safari/537.36'),
	(200, 1182, '2020-09-10 16:37:44', 'Realizado login no sistema', '127.0.0.1 - Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/85.0.4183.83 Safari/537.36'),
	(201, 1182, '2020-09-10 16:38:51', 'Editado Conheça mais  - ', '127.0.0.1 - Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/85.0.4183.83 Safari/537.36'),
	(202, 1182, '2020-09-10 16:40:46', 'Editado Conheça mais Assine nosso canal e fique por dentro de todas as novidades do candidato - Morador de Blumenau a mais de 10 anos e apaixonado pela cidade, e por todos que moram nela. Pai solteiro de um filho inteligênte e dedicado, passa seus dias em sua Agência onde dedica a maior parte do seu tempo. Espera fazer diferente pelo povo da cidade que tanto ama.', '127.0.0.1 - Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/85.0.4183.83 Safari/537.36'),
	(203, 1182, '2020-09-10 17:14:52', 'Editado Conheça mais Assine nosso canal e fique por dentro <br>de todas as novidades do candidato - Morador de Blumenau a mais de 10 anos e apaixonado pela cidade, e por todos que moram nela. Pai solteiro de um filho inteligênte e dedicado, passa seus dias em sua Agência onde dedica a maior parte do seu tempo. Espera fazer diferente pelo povo da cidade que tanto ama.', '127.0.0.1 - Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/85.0.4183.83 Safari/537.36'),
	(204, 1182, '2021-07-05 16:59:35', 'Realizado login no sistema', '127.0.0.1 - Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36'),
	(205, 1182, '2021-07-12 12:12:02', 'Realizado login no sistema', '127.0.0.1 - Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36'),
	(206, 1182, '2021-07-12 12:16:09', 'Cadastrado novo produto Presidente da republica - joao da silva', '127.0.0.1 - Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36'),
	(207, 1182, '2021-07-12 12:19:24', 'Excluído Produto 38?_=1626092361274', '127.0.0.1 - Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36'),
	(208, 1182, '2021-07-12 12:20:28', 'Editado Menu da landingpage', '127.0.0.1 - Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36'),
	(209, 1182, '2021-07-12 12:34:09', 'Editado dados Empresa PSDB BLUMENAU - ', '127.0.0.1 - Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36'),
	(210, 1182, '2021-07-12 12:35:17', 'Editado dados estáticos', '127.0.0.1 - Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36'),
	(211, 1182, '2021-07-12 12:45:26', 'Editado Full Banner', '127.0.0.1 - Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36'),
	(212, 1182, '2021-07-12 12:45:42', 'Realizado logout no sistema', '127.0.0.1 - Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36'),
	(213, 1182, '2021-07-12 12:45:46', 'Realizado login no sistema', '127.0.0.1 - Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36'),
	(214, 1182, '2021-07-12 12:51:09', 'Editado Full Banner', '127.0.0.1 - Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36'),
	(215, 1182, '2021-07-12 12:51:59', 'Editado Full Banner', '127.0.0.1 - Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36'),
	(216, 1182, '2021-07-12 12:52:21', 'Editado Menu da landingpage', '127.0.0.1 - Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36'),
	(217, 1182, '2021-07-12 12:52:59', 'Editado dados de Configuração ', '127.0.0.1 - Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36'),
	(218, 1182, '2021-07-12 12:53:20', 'Editado dados de Configuração ', '127.0.0.1 - Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36'),
	(219, 1182, '2021-07-12 12:58:58', 'Editado dados de Configuração ', '127.0.0.1 - Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36'),
	(220, 1182, '2021-07-12 13:00:40', 'Editado Full Banner Mobile', '127.0.0.1 - Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36'),
	(221, 1182, '2021-07-12 13:04:36', 'Editado dados estáticos', '127.0.0.1 - Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36'),
	(222, 1182, '2021-07-12 13:05:27', 'Editado dados estáticos', '127.0.0.1 - Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36'),
	(223, 1182, '2021-07-12 13:05:47', 'Editado informacoes de reforço PSDB BLUMENAU - NEM ANTIGA NEM NOVA POLÍTICA, E SIM A CORRETA!', '127.0.0.1 - Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36'),
	(224, 1182, '2021-07-12 13:12:00', 'Editado Profssional COMO TUDO COMEÇOU - Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections', '127.0.0.1 - Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36'),
	(225, 1182, '2021-07-12 13:13:36', 'Editado Conheça mais PODEMOS + PSDB - UNIÃO QUE DEU CERTO! - Dois grandes partidos unidos por um só sentimento, trazer o melhor para o povo da sua cidade. Trazemos como candidato eleito a prefeito Mario hildebrandt, e como vice Maria Regina, dois grandes nomes que fizeram e ainda fazem muito por esta cidade e a todos que nela vivem.', '127.0.0.1 - Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36'),
	(226, 1182, '2021-07-12 13:13:51', 'Excluído conectado com você 2?_=1626095628418', '127.0.0.1 - Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36'),
	(227, 1182, '2021-07-12 13:13:53', 'Excluído conectado com você 1?_=1626095628419', '127.0.0.1 - Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36'),
	(228, 1182, '2021-07-12 13:14:03', 'Editado Conheça mais  - ', '127.0.0.1 - Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36'),
	(229, 1182, '2021-07-12 13:14:31', 'Editado informação landing page Comprometimento - Nosso Foco é ser comprometido e responsável com toda nossa Blumenau.', '127.0.0.1 - Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36'),
	(230, 1182, '2021-07-12 13:14:39', 'Editado informação landing page Apoio ao jovem empreendedor - Acreditamos no potencial do jovem para nossa cidade.', '127.0.0.1 - Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36'),
	(231, 1182, '2021-07-12 13:14:47', 'Editado informação landing page Apoio as mulheres - Acreditamos na luta das mulheres na sociedade pelos seus direitos.', '127.0.0.1 - Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36'),
	(232, 1182, '2021-07-12 13:15:01', 'Editado informação landing page Amigo dos animais - Partido que ama os animais e luta por todas as causas a favor deles.', '127.0.0.1 - Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36'),
	(233, 1182, '2021-07-12 13:20:20', 'Editado Banner Apoio', '127.0.0.1 - Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36'),
	(234, 1182, '2021-07-12 13:21:12', 'Editado Banner Apoio', '127.0.0.1 - Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36'),
	(235, 1182, '2021-07-12 15:38:45', 'Editado Profssional COMO TUDO COMEÇOU - O Partido Social da Democracia Brasileira foi formado no município de Blumenau em meados de 1988 - ano do nascimento de nossa Constituição Federal. Aos 2 dias do mês de julho daquele ano, reuniram-se os filiados ao PSDB para deliberarem sobre a nomeação da Comissão Diretora Municipal, contando com a presença de grandes nomes da história do Partido. Momento este no qual se deu início as primeiras ações da Comissão Diretora Municipal do PSDB em Blumenau.\nO P', '127.0.0.1 - Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36'),
	(236, 1182, '2021-07-12 15:40:49', 'Editado Profssional COMO TUDO COMEÇOU - O Partido Social da Democracia Brasileira foi formado no município de Blumenau em meados de 1988 - ano do nascimento de nossa Constituição Federal. Aos 2 dias do mês de julho daquele ano, reuniram-se os filiados ao PSDB para deliberarem sobre a nomeação da Comissão Diretora Municipal, contando com a presença de grandes nomes da história do Partido. Momento este no qual se deu início as primeiras ações da Comissão Diretora Municipal do PSDB em Blumenau.\n\nO ', '127.0.0.1 - Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36'),
	(237, 1182, '2021-07-12 15:41:17', 'Excluído Lead29?_=1626104475124', '127.0.0.1 - Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36'),
	(238, 1182, '2021-07-12 15:41:18', 'Excluído Lead28?_=1626104475125', '127.0.0.1 - Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36'),
	(239, 1182, '2021-07-12 15:41:19', 'Excluído Lead27?_=1626104475126', '127.0.0.1 - Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36'),
	(240, 1182, '2021-07-12 15:41:21', 'Excluído Lead26?_=1626104475127', '127.0.0.1 - Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36'),
	(241, 1182, '2021-07-12 15:41:22', 'Excluído Lead25?_=1626104475128', '127.0.0.1 - Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36'),
	(242, 1182, '2021-07-12 15:41:23', 'Excluído Lead24?_=1626104475129', '127.0.0.1 - Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36'),
	(243, 1182, '2021-07-12 15:41:24', 'Excluído Lead23?_=1626104475130', '127.0.0.1 - Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36'),
	(244, 1182, '2021-07-12 15:41:25', 'Excluído Lead22?_=1626104475131', '127.0.0.1 - Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36'),
	(245, 1182, '2021-07-12 15:47:10', 'Editado dados de Configuração ', '127.0.0.1 - Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36'),
	(246, 1182, '2021-07-12 15:47:39', 'Editado dados de Configuração ', '127.0.0.1 - Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36'),
	(247, 1182, '2021-07-12 15:48:04', 'Editado dados de Configuração ', '127.0.0.1 - Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36'),
	(248, 1182, '2021-07-12 15:48:38', 'Editado dados de Configuração ', '127.0.0.1 - Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36'),
	(249, 1182, '2021-07-12 15:50:45', 'Editado dados de Configuração ', '127.0.0.1 - Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36'),
	(250, 1182, '2021-07-12 16:03:24', 'Cadastrado novo produto Maurici Nascimento - Presidente do PSDB DE BLUMENAU DE: 02/07/1988 - 19/03/1989', '127.0.0.1 - Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36'),
	(251, 1182, '2021-07-12 16:08:00', 'Cadastrado novo produto Luiz Eduardo Caminha - Presidente do PSDB BLUMENAU desde: 19/03/1989 - 16/06/1991', '127.0.0.1 - Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36'),
	(252, 1182, '2021-07-12 16:08:35', 'Cadastrado novo produto Sérgio F. Hess de Souza - Presidente do PSDB BLUMENAU desde: 16/06/1991 - 16/09/1993 → 16/09/1993 - 20/08/1995', '127.0.0.1 - Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36'),
	(253, 1182, '2021-07-12 16:09:03', 'Cadastrado novo produto Dalírio Jose Beber - Presidente do PSDB BLUMENAU desde: 20/08/1995 - 29/10/1999', '127.0.0.1 - Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36'),
	(254, 1182, '2021-07-12 16:09:33', 'Cadastrado novo produto Edelcio Jose Vicieira - Presidente do PSDB BLUMENAU desde: 16/03/1996 - 15/12/1996 → 16/07/1998 - 16/12/1998', '127.0.0.1 - Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36'),
	(255, 1182, '2021-07-12 16:10:06', 'Cadastrado novo produto Norberto Mette - Presidente do PSDB BLUMENAU desde: 29/10/1999 - 19/08/2001', '127.0.0.1 - Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36'),
	(256, 1182, '2021-07-12 16:10:40', 'Cadastrado novo produto Giancarlo Tomelin - Presidente do PSDB BLUMENAU desde: 19/06/2005 - 18/09/2007', '127.0.0.1 - Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36'),
	(257, 1182, '2021-07-12 16:11:51', 'Cadastrado novo produto Valdair José Matias - Presidente do PSDB BLUMENAU desde: 1/08/2001 - 21/08/2003 → 21/08/2003-19/06/2005 →\n18/09/2007 - 20/03/2011', '127.0.0.1 - Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36'),
	(258, 1182, '2021-07-12 16:12:17', 'Cadastrado novo produto Napoleão Bernardes Neto - Presidente do PSDB BLUMENAU desde: 20/03/2011 - 01/07/2012', '127.0.0.1 - Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36'),
	(259, 1182, '2021-07-12 16:12:56', 'Cadastrado novo produto Raimundo Mette - Presidente do PSDB BLUMENAU desde: 01/07/2012 - 15/05/2015', '127.0.0.1 - Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36'),
	(260, 1182, '2021-07-12 16:17:57', 'Cadastrado novo produto José Carlos Oechsler - Presidente do PSDB BLUMENAU desde: 15/05/2015 - 20/03/2019', '127.0.0.1 - Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36'),
	(261, 1182, '2021-07-12 16:18:33', 'Cadastrado novo produto Alexandre Agenor Matias - Presidente do PSDB BLUMENAU desde: 20/03/2019 - ATUAL', '127.0.0.1 - Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36'),
	(262, 1182, '2021-07-12 16:18:51', 'Editado dados estáticos', '127.0.0.1 - Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36'),
	(263, 1182, '2021-07-12 16:24:34', 'Editado dados de Configuração ', '127.0.0.1 - Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36');

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
) ENGINE=InnoDB AUTO_INCREMENT=67 DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela querosite.menu: ~6 rows (aproximadamente)
INSERT INTO `menu` (`id`, `nome`, `icone`, `url`, `controller`, `categoria`, `idFilho`, `ordem`) VALUES
	(14, 'Usuários do Sistema', '<i class="fas fa-users"></i>', 'admin-usuario', 'adminusuario', 'config', NULL, 2),
	(15, 'Perfil de Usuário', '<i class="fab fa-buromobelexperte"></i>', 'admin-perfil-usuario', 'adminperfilusuario', 'config', NULL, 3),
	(16, 'Configurações de Contato', '<i class="fas fa-id-card-alt"></i>', 'admin-empresa', 'adminempresa', '', 58, 1),
	(17, 'Configurações', '<i class="fas fa-cogs"></i>', 'admin-config', 'adminconfig', 'config', NULL, 5),
	(27, 'Informações de Reforço', '<i class="fas fa-user-tie"></i>', 'admin-info-reforco', 'admininforeforco', '', 52, 2),
	(28, 'Gerenciar Site', '<i class="fas fa-th-large"></i>', NULL, NULL, 'pai', NULL, 1),
	(29, 'Agenda (futuro)', '<i class="fas fa-align-justify"></i>', NULL, NULL, 'pai', NULL, 2),
	(33, 'Frase de Impacto', '<i class="fas fa-arrow-alt-circle-up"></i>', 'admin-frase-impacto', 'adminfraseimpacto', '', 52, 4),
	(39, 'Lista Produtos', '<i class="fab fa-product-hunt"></i>', 'admin-produtos', 'adminprodutos', '', 54, 2),
	(40, 'Banner Principal', '<i class="fas fa-images"></i>', 'admin-banner-principal', 'adminbannerprincipal', '', 52, 1),
	(41, 'Categoria Produto', '<i class="fab fa-product-hunt"></i>', 'admin-categoria-produtos', 'admincategoriaprodutos', '', 54, 1),
	(42, 'Leads', '<i class="far fa-comments"></i>', 'admin-leads', 'adminleads', '', 58, 2),
	(43, 'Dúvidas da Home', '<i class="fab fa-facebook-square"></i>', 'admin-duvidas-da-home', 'adminduvidasdahome', '', 52, 3),
	(44, 'Equipe', '<i class="fas fa-th-large"></i>', 'admin-equipe', 'adminequipe', '', 53, 1),
	(45, 'Marketing (futuro)', '<i class="fas fa-th-large"></i>', NULL, NULL, 'pai', NULL, 3),
	(50, 'Layout', '<i class="fas fa-cogs"></i>', 'admin-layout', 'adminlayout', 'config', NULL, 6),
	(51, 'SEO', '<i class="fas fa-cogs"></i>', 'admin-seo', 'adminseo', 'config', NULL, 7),
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
	(66, 'Categoria Serviços', '<i class="fab fa-product-hunt"></i>', 'admin-categoria-serviços', 'admincategoriaservicos', '', 55, 1);

-- Copiando estrutura para tabela querosite.menu_landingpage
CREATE TABLE IF NOT EXISTS `menu_landingpage` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `cod-bloco` mediumtext NOT NULL DEFAULT '',
  `ordem` char(2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela querosite.menu_landingpage: ~5 rows (aproximadamente)
INSERT INTO `menu_landingpage` (`id`, `nome`, `cod-bloco`, `ordem`) VALUES
	(1, 'INICIO', '0', '1'),
	(2, '', 'NULL', ''),
	(3, 'HISTÓRIA', '2', '2'),
	(4, 'PRESIDENTES', '4', '3'),
	(5, 'GALERIA', '5', '4');

-- Copiando estrutura para tabela querosite.perfil_sistema
CREATE TABLE IF NOT EXISTS `perfil_sistema` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela querosite.perfil_sistema: ~3 rows (aproximadamente)
INSERT INTO `perfil_sistema` (`id`, `nome`) VALUES
	(1, 'Administrador'),
	(2, 'MASTER'),
	(3, 'COMUM');

-- Copiando estrutura para tabela querosite.perfil_sistema_modulos
CREATE TABLE IF NOT EXISTS `perfil_sistema_modulos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_menu` int(11) NOT NULL,
  `id_perfil_sistema` int(11) NOT NULL,
  `cadastrar` enum('S','N') NOT NULL DEFAULT 'N',
  `editar` enum('S','N') NOT NULL DEFAULT 'N',
  `excluir` enum('S','N') NOT NULL DEFAULT 'N',
  `visualizar` enum('S','N') NOT NULL DEFAULT 'N',
  PRIMARY KEY (`id`),
  KEY `FK_perfil_sistema_modulos_menu` (`id_menu`),
  KEY `FK_perfil_sistema_modulos_perfil_sistema` (`id_perfil_sistema`),
  CONSTRAINT `FK_perfil_sistema_modulos_menu` FOREIGN KEY (`id_menu`) REFERENCES `menu` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_perfil_sistema_modulos_perfil_sistema` FOREIGN KEY (`id_perfil_sistema`) REFERENCES `perfil_sistema` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=593 DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela querosite.perfil_sistema_modulos: ~32 rows (aproximadamente)
INSERT INTO `perfil_sistema_modulos` (`id`, `id_menu`, `id_perfil_sistema`, `cadastrar`, `editar`, `excluir`, `visualizar`) VALUES
	(549, 28, 2, 'S', 'S', 'S', 'S'),
	(550, 29, 2, 'S', 'S', 'S', 'S'),
	(551, 25, 2, 'S', 'S', 'S', 'S'),
	(552, 26, 2, 'S', 'S', 'S', 'S'),
	(553, 36, 2, 'S', 'S', 'S', 'S'),
	(554, 38, 2, 'S', 'S', 'S', 'S'),
	(555, 27, 2, 'S', 'S', 'S', 'S'),
	(556, 30, 2, 'S', 'S', 'S', 'S'),
	(557, 31, 2, 'S', 'S', 'S', 'S'),
	(558, 32, 2, 'S', 'S', 'S', 'S'),
	(559, 33, 2, 'S', 'S', 'S', 'S'),
	(560, 34, 2, 'S', 'S', 'S', 'S'),
	(561, 12, 2, 'S', 'S', 'S', 'S'),
	(562, 16, 2, 'S', 'S', 'S', 'S'),
	(563, 35, 2, 'S', 'S', 'S', 'S'),
	(564, 14, 2, 'S', 'S', 'S', 'S'),
	(565, 15, 2, 'S', 'S', 'S', 'S'),
	(566, 17, 2, 'S', 'S', 'S', 'S'),
	(579, 28, 3, 'S', 'S', 'S', 'S'),
	(580, 25, 3, 'S', 'S', 'S', 'S'),
	(581, 26, 3, 'S', 'S', 'S', 'S'),
	(582, 36, 3, 'S', 'S', 'S', 'S'),
	(583, 38, 3, 'S', 'S', 'S', 'S'),
	(584, 39, 3, 'S', 'S', 'S', 'S'),
	(585, 27, 3, 'S', 'S', 'S', 'S'),
	(586, 30, 3, 'S', 'S', 'S', 'S'),
	(587, 31, 3, 'S', 'S', 'S', 'S'),
	(588, 32, 3, 'S', 'S', 'S', 'S'),
	(589, 33, 3, 'S', 'S', 'S', 'S'),
	(590, 14, 3, 'S', 'S', 'S', 'S'),
	(591, 15, 3, 'S', 'S', 'S', 'S'),
	(592, 17, 3, 'S', 'S', 'S', 'S');

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

-- Copiando dados para a tabela querosite.produtos: ~12 rows (aproximadamente)
INSERT INTO `produtos` (`id`, `titulo`, `texto_curto`, `texto`, `dir_galeria`, `capa`, `categoria_id`, `ordem`) VALUES
	(39, 'Maurici Nascimento', '02/07/1988 - 19/03/1989', 'Presidente do PSDB DE BLUMENAU DE: 02/07/1988 - 19/03/1989', 'd0c62bc424ba1261f5427128b88e89d3', '1-MAURICI_NASCIMENTO.jpg', NULL, 1),
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

-- Copiando estrutura para tabela querosite.senhas_acesso
CREATE TABLE IF NOT EXISTS `senhas_acesso` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) DEFAULT NULL,
  `site` varchar(250) DEFAULT NULL,
  `usuario` varchar(100) DEFAULT NULL,
  `senha` varchar(100) DEFAULT NULL,
  `obs` text DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela querosite.senhas_acesso: ~0 rows (aproximadamente)

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

-- Copiando dados para a tabela querosite.usuarios: ~3 rows (aproximadamente)
INSERT INTO `usuarios` (`id`, `nome`, `email`, `senha`, `capa`, `dir_galeria`, `id_perfil`, `limit_page`, `template_tema`) VALUES
	(1182, 'João Provezi', 'jprovezi@gmail.com', '140df00b2acb00cc014271d9ad4e83bd', '939e08aa45650707e38f0e9181bd14d8.jpg', 'd609060bba1bb251b5ce72da25d1a97b', 1, NULL, NULL),
	(1183, 'joao usuário', 'joao@agenciaqportais.com.br', '827ccb0eea8a706c4c34a16891f84e7b', '3a5ea5c943a3464e5af79fc7fb913178.jpg', '09b1a6fba5a3cd7828177f7db8451fc4', 2, 50, 'litera'),
	(1185, 'Qportais Suporte', 'campanhapsdb@agenciaqportais.com.br', 'f9d3fca6fefab5c8776a20e4382e74c6', '76d0ba2dc6358eb33fd8ee37a43a2395.png', 'b2dc3538781cc7062092d25ee438f05e', 1, 100, 'superhero');

-- Copiando estrutura para tabela querosite.valores
CREATE TABLE IF NOT EXISTS `valores` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(150) DEFAULT NULL,
  `subtitulo` varchar(150) DEFAULT NULL,
  `item1` varchar(150) DEFAULT NULL,
  `item2` varchar(150) DEFAULT NULL,
  `item3` varchar(150) DEFAULT NULL,
  `item4` varchar(150) DEFAULT NULL,
  `item5` varchar(150) DEFAULT NULL,
  `item6` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela querosite.valores: ~0 rows (aproximadamente)

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
