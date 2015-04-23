-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 21, 2015 at 04:19 AM
-- Server version: 5.1.44
-- PHP Version: 5.3.1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `ibanet`
--

-- --------------------------------------------------------

--
-- Table structure for table `biblioteca`
--

CREATE TABLE IF NOT EXISTS `biblioteca` (
  `btc_cod` int(11) NOT NULL AUTO_INCREMENT,
  `btc_ctg_cod` int(11) NOT NULL,
  `btc_edt_cod` int(11) NOT NULL,
  `btc_titulo` varchar(99) NOT NULL,
  `btc_autor` varchar(99) DEFAULT NULL,
  `btc_edicao` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`btc_cod`),
  KEY `fk_biblioteca_biblioteca_categoria1_idx` (`btc_ctg_cod`),
  KEY `fk_biblioteca_biblioteca_editora1_idx` (`btc_edt_cod`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `biblioteca`
--


-- --------------------------------------------------------

--
-- Table structure for table `biblioteca_categoria`
--

CREATE TABLE IF NOT EXISTS `biblioteca_categoria` (
  `btc_ctg_cod` int(11) NOT NULL AUTO_INCREMENT,
  `btc_ctg_nome` varchar(99) NOT NULL,
  PRIMARY KEY (`btc_ctg_cod`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `biblioteca_categoria`
--


-- --------------------------------------------------------

--
-- Table structure for table `biblioteca_editora`
--

CREATE TABLE IF NOT EXISTS `biblioteca_editora` (
  `btc_edt_cod` int(11) NOT NULL AUTO_INCREMENT,
  `btc_edt_nome` varchar(99) NOT NULL,
  PRIMARY KEY (`btc_edt_cod`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `biblioteca_editora`
--


-- --------------------------------------------------------

--
-- Table structure for table `biblioteca_pessoa`
--

CREATE TABLE IF NOT EXISTS `biblioteca_pessoa` (
  `psa_cod` int(11) NOT NULL,
  `btc_cod` int(11) NOT NULL,
  `btc_psa_data` date NOT NULL,
  `btc_psa_status` int(1) DEFAULT '1' COMMENT '1 = livro emprestado\\n0 = livro entregue',
  KEY `fk_biblioteca_pessoa_pessoa1_idx` (`psa_cod`),
  KEY `fk_biblioteca_pessoa_biblioteca1_idx` (`btc_cod`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `biblioteca_pessoa`
--


-- --------------------------------------------------------

--
-- Table structure for table `celula`
--

CREATE TABLE IF NOT EXISTS `celula` (
  `cel_cod` int(11) NOT NULL AUTO_INCREMENT,
  `cel_cod_pai` int(11) NOT NULL COMMENT 'código da célula de origem',
  `cel_nome` varchar(99) NOT NULL,
  `cel_dia` varchar(20) NOT NULL,
  `cel_data_nascimento` date DEFAULT NULL,
  `cel_observacao` text,
  `cel_status` int(1) NOT NULL DEFAULT '1' COMMENT 'define se a célula esta em atividade',
  PRIMARY KEY (`cel_cod`),
  KEY `fk_celula_celula1_idx` (`cel_cod_pai`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `celula`
--

INSERT INTO `celula` (`cel_cod`, `cel_cod_pai`, `cel_nome`, `cel_dia`, `cel_data_nascimento`, `cel_observacao`, `cel_status`) VALUES
(1, 1, 'IBA', 'Terça', '2010-03-24', 'célula principal', 1),
(8, 1, 'Sal e Luz', 'Sábado', '1981-07-25', 'Célula de Adolescentes', 1),
(9, 8, 'Frutos', 'Sábado', '2014-02-01', 'Celula de adolescentes filha da Sal e Luz', 1),
(10, 1, 'Kfé', 'Sábado', '2013-01-02', 'Com leite', 1),
(11, 10, 'Loren Reno', 'Sábado', '2015-04-19', 'Célula de embaixadores do rei', 1);

-- --------------------------------------------------------

--
-- Table structure for table `celula_evento`
--

CREATE TABLE IF NOT EXISTS `celula_evento` (
  `cel_evt_cod` int(11) NOT NULL AUTO_INCREMENT,
  `cel_cod` int(11) NOT NULL,
  `cel_evt_data` date NOT NULL,
  `cel_evt_hora` time NOT NULL,
  `cel_evt_obs` text NOT NULL,
  `cel_evt_endereco` varchar(99) NOT NULL,
  `cel_evt_presenca` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`cel_evt_cod`),
  KEY `fk_celula_evento_celula1_idx` (`cel_cod`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `celula_evento`
--

INSERT INTO `celula_evento` (`cel_evt_cod`, `cel_cod`, `cel_evt_data`, `cel_evt_hora`, `cel_evt_obs`, `cel_evt_endereco`, `cel_evt_presenca`) VALUES
(1, 8, '2015-04-04', '17:00:00', 'Vamos nos encontrar as 16:45 na padaria verona', 'Avenida Barra Nova, 14 Vale Encantado, Vila Velha - ES', 1),
(2, 1, '2015-04-11', '17:00:00', 'A célula será na IBA', 'Rua Itapina, 3 Rio Marinho, Vila Velha - ES', 0),
(3, 9, '2015-04-11', '17:00:00', 'Vamos nos encontrar as 16:45 na padaria verona. A casa fica do lado da Esquadrimar', 'Avenida Barra Nova, 14 Vale Encantado, Vila Velha - ES', 1),
(4, 10, '2015-04-11', '17:00:00', 'Casa do Rafael e Andréia', 'Avenida Barra Nova, 14 Vale Encantado, Vila Velha - ES', 1),
(5, 8, '2015-04-18', '17:00:00', 'Vamos sair da IBA, nos encontramos as 16:30', 'Avenida Fernando Ferrari, 514, Goiabeiras, Vitória - ES', 1),
(6, 9, '2015-04-25', '17:00:00', 'Ponto de encontro: Em frente a padaria verona', 'Avenida Barra Nova, 14 Vale Encantado, Vila Velha - ES', 1),
(7, 8, '2015-04-25', '18:00:00', 'Ponto de encontro: Em frente a ponto verde', 'Rua Itapina, 3 Rio Marinho, Vila Velha - ES', 0);

-- --------------------------------------------------------

--
-- Table structure for table `celula_frequencia`
--

CREATE TABLE IF NOT EXISTS `celula_frequencia` (
  `psa_cod` int(11) NOT NULL,
  `cel_evt_cod` int(11) NOT NULL,
  `cel_fqc_data` datetime NOT NULL,
  `cel_fqc_presente` int(1) NOT NULL DEFAULT '0' COMMENT '1 para presente e 0 para falta',
  KEY `fk_celular_frequencia_celula_evento1_idx` (`cel_evt_cod`),
  KEY `fk_celula_frequencia_pessoa1_idx` (`psa_cod`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `celula_frequencia`
--

INSERT INTO `celula_frequencia` (`psa_cod`, `cel_evt_cod`, `cel_fqc_data`, `cel_fqc_presente`) VALUES
(48, 5, '2015-04-20 14:41:11', 1),
(50, 5, '2015-04-20 14:41:11', 1),
(51, 4, '2015-04-20 14:41:37', 0),
(52, 4, '2015-04-20 14:41:37', 1),
(49, 3, '2015-04-20 14:42:25', 1),
(48, 1, '2015-04-20 14:42:45', 1),
(50, 1, '2015-04-20 14:42:45', 1),
(49, 6, '2015-04-20 14:52:49', 1);

-- --------------------------------------------------------

--
-- Table structure for table `celula_funcao`
--

CREATE TABLE IF NOT EXISTS `celula_funcao` (
  `cel_cod` int(11) NOT NULL,
  `psa_cod` int(11) NOT NULL,
  `funcao` int(11) NOT NULL COMMENT '1 = líder, 2 = supervisor, 3 = coordenador',
  KEY `fk_celula_funcao_celula1_idx` (`cel_cod`),
  KEY `fk_celula_funcao_pessoa1_idx` (`psa_cod`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `celula_funcao`
--

INSERT INTO `celula_funcao` (`cel_cod`, `psa_cod`, `funcao`) VALUES
(8, 48, 1),
(10, 50, 1),
(1, 51, 3),
(8, 51, 3),
(10, 51, 3),
(8, 52, 2),
(9, 52, 2),
(10, 52, 2),
(9, 49, 1);

-- --------------------------------------------------------

--
-- Table structure for table `celula_pessoa`
--

CREATE TABLE IF NOT EXISTS `celula_pessoa` (
  `psa_cod` int(11) NOT NULL,
  `cel_cod` int(11) NOT NULL,
  UNIQUE KEY `psa_cod` (`psa_cod`),
  KEY `fk_celula_pessoa_pessoa1_idx` (`psa_cod`),
  KEY `fk_celula_pessoa_celula1_idx` (`cel_cod`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `celula_pessoa`
--

INSERT INTO `celula_pessoa` (`psa_cod`, `cel_cod`) VALUES
(48, 8),
(50, 8),
(49, 9),
(51, 10),
(52, 10);

-- --------------------------------------------------------

--
-- Table structure for table `ebd_evento`
--

CREATE TABLE IF NOT EXISTS `ebd_evento` (
  `ebd_evt_cod` int(11) NOT NULL AUTO_INCREMENT,
  `ebd_sl_cod` int(11) NOT NULL,
  `ebd_evt_titulo` varchar(99) NOT NULL,
  `ebd_evt_data` datetime NOT NULL,
  `ebd_evt_observacao` text,
  PRIMARY KEY (`ebd_evt_cod`),
  KEY `fk_ebd_evento_edb_sala1_idx` (`ebd_sl_cod`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `ebd_evento`
--


-- --------------------------------------------------------

--
-- Table structure for table `ebd_frequencia`
--

CREATE TABLE IF NOT EXISTS `ebd_frequencia` (
  `psa_cod` int(11) NOT NULL,
  `ebd_evt_cod` int(11) NOT NULL,
  `ebd_fqc_data` datetime NOT NULL,
  `ebd_fqc_presenca` int(1) NOT NULL DEFAULT '0' COMMENT '1 = presenca\\n0 = falta',
  KEY `fk_ebd_frequencia_ebd1_idx` (`psa_cod`),
  KEY `fk_ebd_frequencia_ebd_evento1_idx` (`ebd_evt_cod`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ebd_frequencia`
--


-- --------------------------------------------------------

--
-- Table structure for table `ebd_pessoa`
--

CREATE TABLE IF NOT EXISTS `ebd_pessoa` (
  `psa_cod` int(11) NOT NULL,
  `ebd_sl_cod` int(11) NOT NULL,
  `ebd_nivel` int(1) NOT NULL DEFAULT '1' COMMENT '1 = aluno\\n2 = professor',
  `ebd_observacao` text,
  PRIMARY KEY (`psa_cod`),
  KEY `fk_ebd_pessoa1_idx` (`psa_cod`),
  KEY `fk_ebd_edb_sala1_idx` (`ebd_sl_cod`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ebd_pessoa`
--


-- --------------------------------------------------------

--
-- Table structure for table `edb_sala`
--

CREATE TABLE IF NOT EXISTS `edb_sala` (
  `ebd_sl_cod` int(11) NOT NULL AUTO_INCREMENT,
  `ebd_sl_nome` varchar(45) NOT NULL,
  PRIMARY KEY (`ebd_sl_cod`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `edb_sala`
--


-- --------------------------------------------------------

--
-- Table structure for table `financeiro`
--

CREATE TABLE IF NOT EXISTS `financeiro` (
  `fnc_cod` int(11) NOT NULL AUTO_INCREMENT,
  `psa_cod` int(11) DEFAULT NULL,
  `pc_cod_contribuinte` int(11) NOT NULL,
  `fnc_valor` float NOT NULL,
  `fnc_data_lancamento` date NOT NULL,
  `fnc_data_conta` date DEFAULT NULL,
  `fnc_log` varchar(50) NOT NULL,
  `fnc_fixo` int(1) NOT NULL DEFAULT '0' COMMENT '0 = conta na fixa\\n1 = conta fixa',
  PRIMARY KEY (`fnc_cod`),
  KEY `fk_financeiro_pessoa1_idx` (`psa_cod`),
  KEY `fk_financeiro_financeiro_plano_conta1_idx` (`pc_cod_contribuinte`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `financeiro`
--


-- --------------------------------------------------------

--
-- Table structure for table `financeiro_plano_conta`
--

CREATE TABLE IF NOT EXISTS `financeiro_plano_conta` (
  `pc_cod` int(11) NOT NULL AUTO_INCREMENT,
  `pc_cod_pai` int(11) NOT NULL,
  `pc_copetencia` year(4) NOT NULL,
  `pc_nome` varchar(99) NOT NULL,
  `pc_caption` varchar(45) NOT NULL,
  `pc_plano_orcamentario` float DEFAULT NULL,
  `pc_tipo` varchar(1) NOT NULL COMMENT 'E = entrada\\nS = saida',
  PRIMARY KEY (`pc_cod`),
  KEY `fk_financeiro_plano_conta_financeiro_plano_conta1_idx` (`pc_cod_pai`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `financeiro_plano_conta`
--


-- --------------------------------------------------------

--
-- Table structure for table `funcao`
--

CREATE TABLE IF NOT EXISTS `funcao` (
  `fnc_cod` int(11) NOT NULL AUTO_INCREMENT,
  `fnc_cod_pai` int(11) NOT NULL,
  `fnc_nome` varchar(99) NOT NULL,
  PRIMARY KEY (`fnc_cod`),
  KEY `fk_funcao_funcao1_idx` (`fnc_cod_pai`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Funções existentes na estrutura organizacional' AUTO_INCREMENT=10 ;

--
-- Dumping data for table `funcao`
--

INSERT INTO `funcao` (`fnc_cod`, `fnc_cod_pai`, `fnc_nome`) VALUES
(1, 1, 'Pastor Titula Principal'),
(2, 1, 'Ministro de Música'),
(3, 2, 'Instrumentista'),
(4, 1, 'Coordenador de Célula'),
(5, 4, 'Supervisor de Célula'),
(6, 5, 'Lider de Célula'),
(7, 1, 'Lider de Ministério'),
(8, 2, 'Lider de Som'),
(9, 8, 'Operador de Som');

-- --------------------------------------------------------

--
-- Table structure for table `funcao_pessoa`
--

CREATE TABLE IF NOT EXISTS `funcao_pessoa` (
  `fnc_cod` int(11) NOT NULL,
  `psa_cod` int(11) NOT NULL,
  KEY `fk_funcao_pessoa_funcao1_idx` (`fnc_cod`),
  KEY `fk_funcao_pessoa_pessoa1_idx` (`psa_cod`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `funcao_pessoa`
--

INSERT INTO `funcao_pessoa` (`fnc_cod`, `psa_cod`) VALUES
(5, 48),
(3, 49),
(9, 49),
(5, 49),
(6, 50),
(3, 52),
(6, 52);

-- --------------------------------------------------------

--
-- Table structure for table `mensagem`
--

CREATE TABLE IF NOT EXISTS `mensagem` (
  `msg_cod` int(11) NOT NULL AUTO_INCREMENT,
  `msg_cod_pai` int(11) DEFAULT NULL,
  `psa_cod_send` int(11) NOT NULL,
  `psa_cod_to` int(11) NOT NULL,
  `msg_data` datetime NOT NULL,
  `msg_assunto` varchar(45) NOT NULL,
  `msg_texto` text NOT NULL,
  `msg_visualizado` int(1) NOT NULL DEFAULT '0' COMMENT '1 = visualizado\\n0 = não visualizado',
  PRIMARY KEY (`msg_cod`),
  KEY `fk_mensagem_pessoa1_idx` (`psa_cod_send`),
  KEY `fk_mensagem_pessoa2_idx` (`psa_cod_to`),
  KEY `fk_mensagem_mensagem1_idx` (`msg_cod_pai`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `mensagem`
--


-- --------------------------------------------------------

--
-- Table structure for table `mensagem_grupo`
--

CREATE TABLE IF NOT EXISTS `mensagem_grupo` (
  `msg_grp_cod` int(11) NOT NULL AUTO_INCREMENT,
  `psa_cod_dono` int(11) NOT NULL,
  `psa_cod_participante` int(11) NOT NULL,
  `msg_grp_nome` varchar(45) NOT NULL,
  PRIMARY KEY (`msg_grp_cod`),
  KEY `fk_mensagem_grupo_pessoa1_idx` (`psa_cod_dono`),
  KEY `fk_mensagem_grupo_pessoa2_idx` (`psa_cod_participante`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `mensagem_grupo`
--


-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE IF NOT EXISTS `menu` (
  `menu_cod` int(11) NOT NULL AUTO_INCREMENT,
  `menu_cod_pai` int(11) DEFAULT NULL,
  `menu_topico` varchar(10) DEFAULT NULL,
  `menu_controller` varchar(45) DEFAULT NULL,
  `menu_nome` varchar(45) NOT NULL,
  PRIMARY KEY (`menu_cod`),
  KEY `fk_menu_menu1_idx` (`menu_cod_pai`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=18 ;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`menu_cod`, `menu_cod_pai`, `menu_topico`, `menu_controller`, `menu_nome`) VALUES
(1, NULL, '1', '#', 'Cadastro'),
(2, NULL, '3', '#', 'Relatório'),
(3, NULL, '2', '#', 'Financeiro'),
(4, 1, '1.1', '#', 'Célula'),
(5, 1, '1.2', 'Funcao', 'Funções Gerais'),
(6, 1, '1.3', 'Ministerio', 'Ministério'),
(7, 1, '1.4', '#', 'Pessoa'),
(8, 4, '1.1.1', 'Celula', 'Cadastro'),
(9, 4, '1.1.2', 'CelulaEvento', 'Célula Evento'),
(10, 7, '1.4.1', 'Pessoa', 'Cadastro'),
(11, 7, '1.4.2', 'PessoaTipo', 'Tipo'),
(13, NULL, '4', '#', 'Setup'),
(14, 13, '4.1', '#', 'Perfil'),
(15, 13, '4.2', 'Logout', 'Logout'),
(16, 7, '1.4.3', 'Menu', 'Permissões de Acesso'),
(17, 4, '1.1.3', 'CelulaFuncao', 'Funções da Célula');

-- --------------------------------------------------------

--
-- Table structure for table `menu_pessoa`
--

CREATE TABLE IF NOT EXISTS `menu_pessoa` (
  `menu_cod` int(11) NOT NULL,
  `psa_cod` int(11) NOT NULL,
  KEY `fk_menu_pessoa_menu1_idx` (`menu_cod`),
  KEY `fk_menu_pessoa_pessoa1_idx` (`psa_cod`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `menu_pessoa`
--

INSERT INTO `menu_pessoa` (`menu_cod`, `psa_cod`) VALUES
(1, 48),
(7, 48),
(1, 49),
(4, 49),
(8, 49),
(9, 49),
(17, 49),
(5, 49),
(6, 49),
(7, 49),
(10, 49),
(11, 49),
(16, 49),
(3, 49),
(2, 49),
(13, 49),
(14, 49),
(15, 49);

-- --------------------------------------------------------

--
-- Table structure for table `ministerio`
--

CREATE TABLE IF NOT EXISTS `ministerio` (
  `mnt_cod` int(11) NOT NULL AUTO_INCREMENT,
  `mnt_cod_pai` int(11) DEFAULT NULL,
  `psa_cod` int(11) NOT NULL COMMENT 'código da pessoa líder do ministério.',
  `mnt_nome` varchar(99) NOT NULL,
  `mnt_data_nascimento` date NOT NULL,
  `mnt_observacao` text,
  `mnt_status` int(1) NOT NULL DEFAULT '1' COMMENT 'Defini se o ministério esta em atividade',
  PRIMARY KEY (`mnt_cod`),
  KEY `fk_ministerio_ministerio1_idx` (`mnt_cod_pai`),
  KEY `fk_ministerio_pessoa1_idx` (`psa_cod`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `ministerio`
--


-- --------------------------------------------------------

--
-- Table structure for table `ministerio_pessoa`
--

CREATE TABLE IF NOT EXISTS `ministerio_pessoa` (
  `mnt_cod` int(11) NOT NULL,
  `psa_cod` int(11) NOT NULL,
  KEY `fk_ministerio_pessoa_pessoa1_idx` (`psa_cod`),
  KEY `fk_ministerio_pessoa_ministerio1_idx` (`mnt_cod`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ministerio_pessoa`
--


-- --------------------------------------------------------

--
-- Table structure for table `pessoa`
--

CREATE TABLE IF NOT EXISTS `pessoa` (
  `psa_cod` int(11) NOT NULL AUTO_INCREMENT,
  `tipo_cod` int(11) NOT NULL,
  `psa_cod_conjuge` int(11) DEFAULT NULL,
  `psa_nome` varchar(99) NOT NULL,
  `psa_data_nascimento` date NOT NULL,
  `psa_estado_civil` varchar(2) NOT NULL,
  `psa_sexo` varchar(1) NOT NULL,
  `psa_rua` varchar(45) DEFAULT NULL,
  `psa_numero` int(6) DEFAULT NULL,
  `psa_bairro` varchar(45) DEFAULT NULL,
  `psa_cidade` varchar(45) DEFAULT NULL,
  `psa_uf` varchar(2) DEFAULT NULL,
  `psa_cep` varchar(10) DEFAULT NULL,
  `psa_telefone` varchar(15) DEFAULT NULL,
  `psa_celular` varchar(15) DEFAULT NULL,
  `psa_email` varchar(100) DEFAULT NULL,
  `psa_observacao` text,
  `psa_pwd` varchar(45) DEFAULT NULL,
  `psa_ibanet` int(1) NOT NULL DEFAULT '0' COMMENT '1 = tem acesso ao ibanet\\n0 = não tem acesso ao ibanet',
  `psa_status` int(1) NOT NULL DEFAULT '1' COMMENT '1 = cadastro ativo\\n0 = cadastro inativo',
  `psa_data_cadastro` date NOT NULL,
  PRIMARY KEY (`psa_cod`),
  KEY `fk_pessoa_pessoa_idx` (`psa_cod_conjuge`),
  KEY `fk_pessoa_tipo1_idx` (`tipo_cod`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=53 ;

--
-- Dumping data for table `pessoa`
--

INSERT INTO `pessoa` (`psa_cod`, `tipo_cod`, `psa_cod_conjuge`, `psa_nome`, `psa_data_nascimento`, `psa_estado_civil`, `psa_sexo`, `psa_rua`, `psa_numero`, `psa_bairro`, `psa_cidade`, `psa_uf`, `psa_cep`, `psa_telefone`, `psa_celular`, `psa_email`, `psa_observacao`, `psa_pwd`, `psa_ibanet`, `psa_status`, `psa_data_cadastro`) VALUES
(48, 1, 49, 'Andreia Luiza Araujo', '1987-01-30', 'C', 'F', 'Avenida Barra Nova', 14, 'Vale Encantado', 'Vila Velha', 'ES', '29113040', '2733164851', '27988145635', 'andreialaraujo@gmail.com', 'Esposa do Mozão e mãe da Sofia Araujo Teixeira', NULL, 1, 1, '0000-00-00'),
(49, 1, 48, 'Rafael de Meira Teixeira', '1981-07-25', 'C', 'M', 'Avenida Barra Nova', 14, 'Vale Encantado', 'Vila Velha', 'ES', '29113040', '2733164851', '27988480733', 'rafaeldemeirateixeira@gmail.com', 'Analista de Sistemas', 'e10adc3949ba59abbe56e057f20f883e', 1, 1, '0000-00-00'),
(50, 2, NULL, 'Sofia Araujo Teixeira', '2014-02-13', 'S', 'F', 'Avenida Barra Nova', 14, 'Vale Encantado', 'Vila Velha', 'ES', '29113040', '2733164851', '27988145635', 'rafaeldemeirateixeira@gmail.com', '', NULL, 0, 1, '0000-00-00'),
(51, 4, NULL, 'Carlos André Araújo', '1990-04-24', 'S', 'M', 'Avenida Barra Nova', 14, 'Vale Encancatado', 'Vila Velha', 'ES', '29113040', '2733164851', '27988480733', 'cacarlos@hotmail.com', 'Irmão da Andreia Luiza Araujo', NULL, 0, 1, '0000-00-00'),
(52, 1, NULL, 'Yan Paula', '2015-04-30', 'S', 'M', 'Rua Itapina', 3, 'Rio Marinho', 'Vila Velha', 'ES', '29113040', '2733164851', '27988504388', 'yan@gmail.com', '', NULL, 0, 1, '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `pessoa_tipo`
--

CREATE TABLE IF NOT EXISTS `pessoa_tipo` (
  `tipo_cod` int(11) NOT NULL AUTO_INCREMENT,
  `tipo_nome` varchar(45) NOT NULL,
  `tipo_status` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`tipo_cod`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Armazena os tipos referentes as pessoas, exemplo: membros, a' AUTO_INCREMENT=5 ;

--
-- Dumping data for table `pessoa_tipo`
--

INSERT INTO `pessoa_tipo` (`tipo_cod`, `tipo_nome`, `tipo_status`) VALUES
(1, 'Membro', 1),
(2, 'Agregado', 1),
(3, 'Visitante', 1),
(4, 'Oikos', 1);

-- --------------------------------------------------------

--
-- Table structure for table `sistema_log`
--

CREATE TABLE IF NOT EXISTS `sistema_log` (
  `log_cod` int(11) NOT NULL AUTO_INCREMENT,
  `psa_cod` int(11) NOT NULL,
  `log_data` datetime NOT NULL,
  `log_ip` varchar(16) NOT NULL,
  `log_texto` text NOT NULL COMMENT 'descrição do processo realizado',
  PRIMARY KEY (`log_cod`),
  KEY `fk_sistema_log_pessoa1_idx` (`psa_cod`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=31 ;

--
-- Dumping data for table `sistema_log`
--

INSERT INTO `sistema_log` (`log_cod`, `psa_cod`, `log_data`, `log_ip`, `log_texto`) VALUES
(1, 49, '2015-04-20 20:37:15', '127.0.0.1', '["Login","authentic",{"psa_email":"rafaeldemeirateixeira@gmail.com","psa_pwd":null,"g-recaptcha-response":"03AHJ_VutxU0nx7GBqGidQTiJhCd8-EXXRcbTDUzf2g4owgsxiGA0Ne4864_b3_5Srwt7EV1OhPAZwTz1buzAzJMNTPRsSCBttn34fX-aQ7GdcWicRz2uCkofUbH5vifxu2-4wzJfs-vloH-rh-q38mTwzq-fgUyVD3BO8jwwwxdIXRuYOkgfbKaHHu7QIz968R9VISxM7FsWbtzL1mfgI6s92UGYYNIwyThOB5GpLUZSjWRYcR5aAaQ1rsciOQDkOQPfWCRG_j3SbNf-2qNisTJFIEMQ4A_SGDHS47us318yVOGeBCf-CsIdmQbnDeHxNQrs1Tryjvque-Pes1n5Ys-nAPeq2DICAdA"}]'),
(2, 49, '2015-04-20 20:38:03', '127.0.0.1', '["Login","authentic",{"psa_email":"rafaeldemeirateixeira@gmail.com","g-recaptcha-response":"03AHJ_Vus5miWljmvG6-XB9VVcyL9MQhp6s10pousSh9YADyKN9Ug0T4l_WOUe6F3CAHw4A-3by_Qlr2V4Q8xeYDWrXh9FbVBlyzVBAJG9aDSC050EUiIG-82paxk8Lk7ueRALjS0w6-3I5QhK0Pm0A8EuwlJEhFG34kokpUjvQTezSPfrvnTqnChj2MlWwTwjv4AU2m_nAopXKSyauUABo_D4no68ORoK4LDX_bf1--JBQ3fhe0NgLgwHHVzjApzkbxw0wbacjeFSsyJlGGXQSk9bMSnAl7q9X89WTko6HrwqeX3qEkTXvYzi22qivCBtJDCyXdpT10C2GEBLiZrG1G1HN-E2xR-Shw"}]'),
(3, 49, '2015-04-20 20:41:29', '127.0.0.1', '["Login","authentic","[1]",{"psa_email":"rafaeldemeirateixeira@gmail.com","g-recaptcha-response":"03AHJ_VuuHKhVYAqM3hlglNAH3R3nXv0VdIDCo-w5Np5P-AAzxtMFdltwBqH0_DeBtWaqBahoUHoOGCQ8Be0ETurulUHnbC5rhRMXksGDKBDOynoo35VjCVaZ0ddBgqPSB15Abrzb8mcaYOJTyFdmspItqG54xYuC9WULwSyCIXhBF94qRfzdngM1r3Las0mkBpGbw5mEnMapuR80oGC44IC0IV0ZZYBZ80LK-G46MLZJJKhBi8Xg59-Je5DFvMfwc0WXgz2dtFvQ2DTSt2XXuemGBgAOZ5_w-WgdUAt0Y3LLO26dRKLj6vcLNIYoTrjjn_7J23q4nVNl5Z9iEnGi04TiDsjcZaSAmGQ"}]'),
(4, 49, '2015-04-20 20:48:35', '127.0.0.1', '["Logout","Index",{"authentic":"e10adc3949ba59abbe56e057f20f883e","psa_email":"rafaeldemeirateixeira@gmail.com","psa_pwd":"e10adc3949ba59abbe56e057f20f883e:dc41e1469df46b22fd2b0e19a3440ff7","psa_cod":null,"time_session":"22:41:29"}]'),
(5, 49, '2015-04-20 20:56:56', '127.0.0.1', '["Login","authentic","[1]",{"psa_email":"rafaeldemeirateixeira@gmail.com","g-recaptcha-response":"03AHJ_VuvKnylrB_mTLt1BvqcfASugXVOM856LQJuy7gT7LMin8xDatrgXsk-V6nFO6I-ZhvrNAYyNx8WgmWy8dnqGNs2PPsaXeR8JvGOG_VdTyOEl3oTbQKNcCCHQ25TBim2h9Wv1CiuBxwcOOTFIigEtpZOlo70W1ikq2yD-pyGlEzDXFetGObQlxDkFuF6gdxMqe_JHVxGrkZmNIKU7GnuJWax6lpkWI8T-4zeab-eEf3otu50CK_xjZyMjE-p_ghTYIu5Oq_wOOND0hbQU5u0AVm7ZSLPhicUPCz3yVS1R_wnWlJNFcPM59bpp8jBPllyQ7GW-mzJPJbGCfjNmHhJCeFycVhgk1Q"}]'),
(6, 49, '2015-04-20 22:13:44', '127.0.0.1', '["Logout","Index",{"authentic":"e10adc3949ba59abbe56e057f20f883e","psa_email":"rafaeldemeirateixeira@gmail.com","psa_pwd":"e10adc3949ba59abbe56e057f20f883e:dc41e1469df46b22fd2b0e19a3440ff7","psa_cod":null,"time_session":"22:56:56"}]'),
(7, 49, '2015-04-20 22:13:56', '127.0.0.1', '["Login","authentic","[1]",{"psa_email":"rafaeldemeirateixeira@gmail.com","g-recaptcha-response":"03AHJ_VutjqH_ha7HO8AemuqyzY9TA_UZBC8F161oX15ieszzFR5a8wxwWeno2Yss75_FLvSLlPQFSwz1_5Fa_Dc8wLYp30d4Nqgz7VuR577eLpgIgywalX_LRME7CzMsB-l4LdX7EymlU0zA3tlimr3aGMydti_7wqXkikx_R_Avqhw8Pa6mWlsMSrxpZRlRFZPBMshjUEXGrjPS0kPYQeri7yrG-5Pf4Uxy1Zv776e_ifvtEcyk9lV-dIdSv2lVmL-7fwlsLQ8pkBus210g3xeSde7w1ZRYjeQ3v9s4W49M3htoCmeXWMbeuI-MEYBxBwaplJwo8XaMVryqEBWoWR_VVp9sqOvRYLw"}]'),
(8, 49, '2015-04-20 22:14:05', '127.0.0.1', '["Logout","Index",{"authentic":"e10adc3949ba59abbe56e057f20f883e","psa_email":"rafaeldemeirateixeira@gmail.com","psa_pwd":"e10adc3949ba59abbe56e057f20f883e:dc41e1469df46b22fd2b0e19a3440ff7","psa_cod":null,"time_session":"00:13:56"}]'),
(9, 49, '2015-04-20 22:14:24', '127.0.0.1', '["Login","authentic","[1]",{"psa_email":"rafaeldemeirateixeira@gmail.com","g-recaptcha-response":"03AHJ_Vus4d3eUcvxHSc2XGwM5PeQ1Z_YQJM5qi5toL3aF9k5AklsCNLqWd9Z1KochWf0nymT558DiAKZrXOAf8p7LZGmKfxFPvdSX8fT6tQammwSio6vK10vsGfVP5XsY5FV_yodC661JJ46mcIO58puY8iQoMd-lZ2Rb5Qj78yhsqUnBWBw68RebtKtQlVug5Yd5xMXhgHulN1_lN8SVRXDy04AZ0uvGWjCaR1wagdweTbGj_dIEf23a1M_f3Opb-U_fM3QiQo2S5eNi8VWHTkznmwmF318YWyLtSqmIOSJJolrPMQMaUCIJjMRKvxXqLi02wjknbhYucBHgIJM4RiIYP5M2Ke2tgQ"}]'),
(10, 49, '2015-04-20 22:14:37', '127.0.0.1', '["Logout","Index",{"authentic":"e10adc3949ba59abbe56e057f20f883e","psa_email":"rafaeldemeirateixeira@gmail.com","psa_pwd":"e10adc3949ba59abbe56e057f20f883e:dc41e1469df46b22fd2b0e19a3440ff7","psa_cod":null,"time_session":"00:14:24"}]'),
(11, 49, '2015-04-20 22:15:38', '127.0.0.1', '["Login","authentic","[1]",{"psa_email":"rafaeldemeirateixeira@gmail.com","g-recaptcha-response":"03AHJ_VuvcspydwiFDbe1ikdPBHsY6mMiUvIg9NOY8zerKKyfN_dDJnvrdPXrhk_GssCxtoQL58RD691WMAg4Feykm6LnMdlQGnCY7hxhbRyCnGOf47UKBlU4CcK5O_d6x2DfGh1cjc51iLAjbxqgOFYhOnqaTkwpxjYY4a2ru8q_294XbWkHRMvfoT3JjLXXMFP1-4wuom5ceKLadVsTBnq4VQNVK34lKfZalvXI9i6d4jnH3SsNC5mcUF7WrGUWRYF95Y8y4kfP3cbkX1wc3qrhXZuuMgyteYMvtPHtEb5YZ5l9hOiWFLXsxi5reb23o0dUYMamMY5zZG4DVrVyGavNAFz3l5Aldog"}]'),
(12, 49, '2015-04-20 22:15:51', '127.0.0.1', '["Logout","Index",{"authentic":"e10adc3949ba59abbe56e057f20f883e","psa_email":"rafaeldemeirateixeira@gmail.com","psa_pwd":"e10adc3949ba59abbe56e057f20f883e:dc41e1469df46b22fd2b0e19a3440ff7","psa_cod":null,"time_session":"00:15:38"}]'),
(13, 49, '2015-04-20 22:17:11', '127.0.0.1', '["Login","authentic","[1]",{"psa_email":"rafaeldemeirateixeira@gmail.com","g-recaptcha-response":"03AHJ_Vutp5k_0P0IwZrat7SEFGPCKDw2Z5WyVNNQOFED5kgJ1-nmlnp2uMryT0eSwlAW5w1mGd-thc6eo5MUQnH-J8yShEQ1va0jWZxXMm01FwfgmPoe_zI6d0TI4-FPDMQ8UAVYSK_27yrGi6Yitw2V-lplHXJ1ToNl-Tdp3JJXMrNt5MzeSowaZ_ETMq9srScXMLWJmtfqzP2uVUooHRSc-S4TN4CObhvJPf2zpJr2Yi6geeyXTGtsuP5bR9UidvucEDDTsQeapGfDSNws3nb2ewbIp9B4yOVkhnVW3iTMuAaIsC24UhK_aegRuod07kcUzKXwNfDd_I1ZgM6S1CpUTNhIjTnUUtw"}]'),
(14, 49, '2015-04-20 22:17:26', '127.0.0.1', '["Logout","Index",{"authentic":"e10adc3949ba59abbe56e057f20f883e","psa_email":"rafaeldemeirateixeira@gmail.com","psa_pwd":"e10adc3949ba59abbe56e057f20f883e:dc41e1469df46b22fd2b0e19a3440ff7","psa_cod":null,"time_session":"00:17:11"}]'),
(15, 49, '2015-04-20 22:17:57', '127.0.0.1', '["Login","authentic","[1]",{"psa_email":"rafaeldemeirateixeira@gmail.com","g-recaptcha-response":"03AHJ_VuvV3fiQgYLd07_fdK5j5Lg241aupErRx9cH3egbsQGJg64D4ozurPv275BrIC6TYv2MgBRUbwvlhRXnYd-ZRehziSPZ6CY9cOts-i9qzwpeL5-7kQnIfaAiPAbGVqLoRTvPKM9ty5IDxNN8wvFM6p_PDCH_xsdSTLvUbVOhBxFxr_zu1J0tAKWAqzB-CZ7p0ocA89xg7EtiSY3LsuYE_n0JEaE68FBJcrb4BU-sTS7YLu5DHaew1gCYIstK03CVw3LaR00NFgjuqvDhJFU9jl_PTEv7cGorMCCWKTDxU7fRI7u_a7CvbGYS4qdk-vGDdoHcPdy4Sdvv7g7463y1_PGvKOrGqQ"}]'),
(16, 49, '2015-04-20 22:18:08', '127.0.0.1', '["Logout","Index",{"authentic":"e10adc3949ba59abbe56e057f20f883e","psa_email":"rafaeldemeirateixeira@gmail.com","psa_pwd":"e10adc3949ba59abbe56e057f20f883e:dc41e1469df46b22fd2b0e19a3440ff7","psa_cod":null,"time_session":"00:17:57"}]'),
(17, 49, '2015-04-20 22:20:22', '127.0.0.1', '["Login","authentic","[1]",{"psa_email":"rafaeldemeirateixeira@gmail.com","g-recaptcha-response":"03AHJ_VuvYlRUtbygnsj_5VaVUoKgs5eC47k6s86sgArgz5d7D58S_CsU7nk2q8xNXbjLfQaXWdV3BMLOlVhPPAg4Zt3vYQTHALnqIYaGS0WGw_JzNydPUxtiSY_Tv6E5nJimSsZsNX5LmemRZTsD9pkh-5RBUUjAtbvL0n5GrVdeap_q1ea4ChMeOSYeSwXiMclBrRfDenMYl-_gp1lBEQ68sP2hZJX37EO3N5XdtBH5MSPnTaD4Ol34uxqD5ktVBSDFsA-YJhwj1zQTgIdqbjCiMOqKOpWGLdJGUWb8_JyRp0Gxt1rCB09gg6SIXszw8NJXUFhN8HS01jtBPZRz741YfWpiSvZgkvg"}]'),
(18, 49, '2015-04-20 22:20:29', '127.0.0.1', '["Logout","Index",{"authentic":"e10adc3949ba59abbe56e057f20f883e","psa_email":"rafaeldemeirateixeira@gmail.com","psa_pwd":"e10adc3949ba59abbe56e057f20f883e:dc41e1469df46b22fd2b0e19a3440ff7","psa_cod":null,"time_session":"00:20:22"}]'),
(19, 49, '2015-04-20 23:25:34', '127.0.0.1', '["Login","authentic","[1]",{"psa_email":"rafaeldemeirateixeira@gmail.com","g-recaptcha-response":"03AHJ_VuusDc-bdsPHOCdfo66A5APR3vgCHhQgc0HAr1Uo5k3vhVeHSMaMSFugQm25xdQhytgkSH0UHkjlxnFXjx62yGmKE-rtDSHNkw2ttuxldTWzrtABOblZUhUp5jUGAVTiErqnzfcMip-j8RvRw8oHxaxV3B513YBdhQ_XZmB7XExN38QpFXOrsVzGPepWdY1rBFbwungIf9WPzA3n6NllCvBUSW8u-vR0DeGb9YgZrDFLl_PsWJ5eFVY6FNa1tcDgCVAF_MKzmMZ9wLPIseh1aKOHaKtz2xPnBy2uKDZcJAJgSf_xXy2jq1q-tZo1BJWhcdPcONYQioJdAMP75wk0aqurlpW-bg"}]'),
(20, 49, '2015-04-20 23:27:38', '127.0.0.1', '["Logout","Index",{"authentic":"e10adc3949ba59abbe56e057f20f883e","psa_email":"rafaeldemeirateixeira@gmail.com","psa_pwd":"e10adc3949ba59abbe56e057f20f883e:dc41e1469df46b22fd2b0e19a3440ff7","psa_cod":null,"time_session":"2015-04-21 01:25:34"}]'),
(21, 49, '2015-04-20 23:27:48', '127.0.0.1', '["Login","authentic","[1]",{"psa_email":"rafaeldemeirateixeira@gmail.com","g-recaptcha-response":"03AHJ_Vus4q7t4A8y0UlHcvQEQHa-RNlhXis_KyiDAaCt_CH9GijaHdPZULhSqmNDjvuV1m6ygvnVVMyJsFWoH-bwXhe8f92gKx60v4KBktTGXH2RtfZFtPltmJWpGaljXsuNhy9JYYRhw3GYQAJkzk5PDBkYJbkmqt67G5AggSeUDy07NM1Z--dnQ8MhheMMtC5TGSYkvdsyIRlpWDFsFNWtcvbSPuNjIKqZGARIV7v72n06rlH-PrGN3B9sKgKhnKrO6aQKTMxlvnLXnhlH61xCKgPDmiMHMxBFI1qKv12wQmwWA6qCXzRVQZsxPY4FMS8XaMmiG50cTmuR6ADQ1c1U0NI0NXsfkVQ"}]'),
(22, 49, '2015-04-20 23:31:13', '127.0.0.1', '["Logout","Index",{"authentic":"e10adc3949ba59abbe56e057f20f883e","psa_email":"rafaeldemeirateixeira@gmail.com","psa_pwd":"e10adc3949ba59abbe56e057f20f883e:dc41e1469df46b22fd2b0e19a3440ff7","psa_cod":null,"time_session":"2015-04-21 01:27:48"}]'),
(23, 49, '2015-04-20 23:31:22', '127.0.0.1', '["Login","authentic","[1]",{"psa_email":"rafaeldemeirateixeira@gmail.com","g-recaptcha-response":"03AHJ_Vutx72P6H0FU1wg654r0BKhU_5gx3j5t7sKhMWU9y2Md1vRKMdLaVQiuvEj4eCD4jkBPo_s9AB_so14P8M6Tn7E0zrh2P0M3vXzIWi7u4uXmEtVd-WH8xIcpu4Rs0vrfN9WixfJyJjEpaN3jzJso4R2bErTJE_mIS3nCzTOnZePPZu5I2P_OtSk5MHEyZtXTAXFco3S0vvzAEgG4YBrkgQBft_QTh0KgPmG4AH1pqgl1GAKk9fvQZxV5CevA_wp8wje8zc-_i4ru5mWnXNyYKbaXKpdx14bh-6KhN2MnFAwQ4j4ykMi3h0OQBqArdeyBY0xAo1vE5t6o5CvXQ8BgHWMv37p2WA"}]'),
(24, 49, '2015-04-20 23:42:22', '127.0.0.1', '["Logout","Index",{"authentic":"e10adc3949ba59abbe56e057f20f883e","psa_email":"rafaeldemeirateixeira@gmail.com","psa_pwd":"e10adc3949ba59abbe56e057f20f883e:dc41e1469df46b22fd2b0e19a3440ff7","psa_cod":null,"time_session":"2015-04-21 01:31:22"}]'),
(25, 49, '2015-04-20 23:42:32', '127.0.0.1', '["Login","authentic","[1]",{"psa_email":"rafaeldemeirateixeira@gmail.com","g-recaptcha-response":"03AHJ_VuvZ-BLmH0_qCKPal9TK71u6PJp8SEmt2VInnbDKiIe6Lgz-NhBJHeJFfmGxhoveEhx5D_iW6YnupDwk6BSOrFo75HRA_Ha4jLnCRi-hYzxFznpXqxQpL_piSEaJMJnJyqMtHjCZma3Kryr6oSR2E8aphQSD9rAUcgkxlUWgoelOwptAWGCfjybCAi41JwprYLPMYI0w2tYHvzNt2IqYSX4jGuIY2Zo8eXl1rV2kvCZwAggxy7lNXFRbRTAsO93I9PgeCZtZ58E1OpWJhAHQnU8nucTfaW56G0IG5c2FEV03AFqSBPWLAYk_sQor64S3iBRVOYaevuopx5MYS6MaDKSPeCEhHg"}]'),
(26, 49, '2015-04-20 23:43:26', '127.0.0.1', '["Logout","Index",{"authentic":"e10adc3949ba59abbe56e057f20f883e","psa_email":"rafaeldemeirateixeira@gmail.com","psa_pwd":"e10adc3949ba59abbe56e057f20f883e:dc41e1469df46b22fd2b0e19a3440ff7","psa_cod":null,"time_session":"2015-04-21 01:42:32"}]'),
(27, 49, '2015-04-20 23:43:34', '127.0.0.1', '["Login","authentic","[1]",{"psa_email":"rafaeldemeirateixeira@gmail.com","g-recaptcha-response":"03AHJ_VuvQ1Px-jQpR3NKV69ABmUvWaStCZzD_XN-4gW0s3keqFewVfZH-Ref-EWrUgn3358vy5txIZ1r3xCNesnqGx2FeP0cxFd4-XUAEK8ktjFJodDTNtjE2I-0oyWj1rk3G1gwJr-pG78B9KgoT0ZfgyuM11iDbYVGnqmZZzd3C3qF4qP11-21LQk-ZQWNDcadHnLu2IY8DozgqEeOTpRW6vfnPAnbRwij-8Oasn6Rh-sI6a3_RaoR7fGGPV5EIofGUG4H5nlVP4mZdsfK2FtN_qNBR08XE4C4JUETt_8IRWsEDiKYFdo95zRQzbwCxj5HoagAf8goqqxS-xbxtVv7uAye3cw4-YQ"}]'),
(28, 49, '2015-04-20 23:44:28', '127.0.0.1', '["Logout","Index",{"authentic":"e10adc3949ba59abbe56e057f20f883e","psa_email":"rafaeldemeirateixeira@gmail.com","psa_pwd":"e10adc3949ba59abbe56e057f20f883e:dc41e1469df46b22fd2b0e19a3440ff7","psa_cod":null,"time_session":"2015-04-21 01:43:34"}]'),
(29, 49, '2015-04-20 23:44:37', '127.0.0.1', '["Login","authentic","[1]",{"psa_email":"rafaeldemeirateixeira@gmail.com","g-recaptcha-response":"03AHJ_VusQs97qcPY8JH62LtqsEumFxXswYF4FFxNnNj6TDsGSrPUuDnkQE1C7zaIC1un_n9EKPSSUQCl7iQ5sODp56O2osLP9oOtGHV0oQ-TNuPblTsJ4xhIcEMxUo-PbiacLbm-mX12TkQHCG6Smdo27tBC77erMI4JJI0QRpCXNEXbepAq1e3Heublu00msB6mL_hF7U3pFuICunBVms9dj-IXFpQ2_nt8vGtSCfEt91ah3vCdDBlPk1FOYYlWRSD8DpAG_8pmbw_34e95uXYHImYJmERS9YcuJdFh2f2pnOzfy3e3gwdQ-x88gQVRnr8XJ8eGLEYeFkZUAwsWZVxxMhbKTqMXtTA"}]'),
(30, 49, '2015-04-21 00:14:50', '127.0.0.1', '["Login","authentic","[1]",{"psa_email":"rafaeldemeirateixeira@gmail.com","g-recaptcha-response":"03AHJ_VutWh_WO0KBXVAmdPsidiCuQ0Pcr2i3eWXzHtm6u2-KoSAQ1qHCtC0-w7J-IN8PodmE1jcH1I5CsabDK3Nev2gPJo_2RttjScX4UFmh8EmytGoaMfADc80zehszsEHmXpNKeeCntOMIarX5fbWAYHRRU495O1CddB8ByVRkp70oXjO3NVFP0JqEj1j1aMuVPeiRQZN4f8Bc7gPvdVE_ie5daB0TFUERUwRfbo-0iYsak0lTgk2E7jPukQqE6aY1dPxuQ1lijl3tFlbx7qoFZoF6fsHpp_o7GqzWxwVQ_OwPTbwom5Wak3ZMeVt_0bYOZwHHpj_j-riaKtPXJZYjDxQ3VvqZ6IAltYoc7oF2NHwSOB3HCl19N9of_RymXgau5VltE4IVdXkeX0POCR_5OfwfKp2qOnNr4rlRuLLtOGVFIrEEio-U"}]');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `biblioteca`
--
ALTER TABLE `biblioteca`
  ADD CONSTRAINT `fk_biblioteca_biblioteca_categoria1` FOREIGN KEY (`btc_ctg_cod`) REFERENCES `biblioteca_categoria` (`btc_ctg_cod`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_biblioteca_biblioteca_editora1` FOREIGN KEY (`btc_edt_cod`) REFERENCES `biblioteca_editora` (`btc_edt_cod`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `biblioteca_pessoa`
--
ALTER TABLE `biblioteca_pessoa`
  ADD CONSTRAINT `fk_biblioteca_pessoa_biblioteca1` FOREIGN KEY (`btc_cod`) REFERENCES `biblioteca` (`btc_cod`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_biblioteca_pessoa_pessoa1` FOREIGN KEY (`psa_cod`) REFERENCES `pessoa` (`psa_cod`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `celula`
--
ALTER TABLE `celula`
  ADD CONSTRAINT `fk_celula_celula1` FOREIGN KEY (`cel_cod_pai`) REFERENCES `celula` (`cel_cod`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `celula_evento`
--
ALTER TABLE `celula_evento`
  ADD CONSTRAINT `fk_celula_evento_celula1` FOREIGN KEY (`cel_cod`) REFERENCES `celula` (`cel_cod`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `celula_frequencia`
--
ALTER TABLE `celula_frequencia`
  ADD CONSTRAINT `fk_celular_frequencia_celula_evento1` FOREIGN KEY (`cel_evt_cod`) REFERENCES `celula_evento` (`cel_evt_cod`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_celula_frequencia_pessoa1` FOREIGN KEY (`psa_cod`) REFERENCES `pessoa` (`psa_cod`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `celula_funcao`
--
ALTER TABLE `celula_funcao`
  ADD CONSTRAINT `fk_celula_funcao_celula1` FOREIGN KEY (`cel_cod`) REFERENCES `celula` (`cel_cod`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_celula_funcao_pessoa1` FOREIGN KEY (`psa_cod`) REFERENCES `pessoa` (`psa_cod`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `celula_pessoa`
--
ALTER TABLE `celula_pessoa`
  ADD CONSTRAINT `fk_celula_pessoa_celula1` FOREIGN KEY (`cel_cod`) REFERENCES `celula` (`cel_cod`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_celula_pessoa_pessoa1` FOREIGN KEY (`psa_cod`) REFERENCES `pessoa` (`psa_cod`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `ebd_evento`
--
ALTER TABLE `ebd_evento`
  ADD CONSTRAINT `fk_ebd_evento_edb_sala1` FOREIGN KEY (`ebd_sl_cod`) REFERENCES `edb_sala` (`ebd_sl_cod`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `ebd_frequencia`
--
ALTER TABLE `ebd_frequencia`
  ADD CONSTRAINT `fk_ebd_frequencia_ebd1` FOREIGN KEY (`psa_cod`) REFERENCES `ebd_pessoa` (`psa_cod`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_ebd_frequencia_ebd_evento1` FOREIGN KEY (`ebd_evt_cod`) REFERENCES `ebd_evento` (`ebd_evt_cod`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `ebd_pessoa`
--
ALTER TABLE `ebd_pessoa`
  ADD CONSTRAINT `fk_ebd_edb_sala1` FOREIGN KEY (`ebd_sl_cod`) REFERENCES `edb_sala` (`ebd_sl_cod`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_ebd_pessoa1` FOREIGN KEY (`psa_cod`) REFERENCES `pessoa` (`psa_cod`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `financeiro`
--
ALTER TABLE `financeiro`
  ADD CONSTRAINT `fk_financeiro_financeiro_plano_conta1` FOREIGN KEY (`pc_cod_contribuinte`) REFERENCES `financeiro_plano_conta` (`pc_cod`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_financeiro_pessoa1` FOREIGN KEY (`psa_cod`) REFERENCES `pessoa` (`psa_cod`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `financeiro_plano_conta`
--
ALTER TABLE `financeiro_plano_conta`
  ADD CONSTRAINT `fk_financeiro_plano_conta_financeiro_plano_conta1` FOREIGN KEY (`pc_cod_pai`) REFERENCES `financeiro_plano_conta` (`pc_cod`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `funcao`
--
ALTER TABLE `funcao`
  ADD CONSTRAINT `fk_funcao_funcao1` FOREIGN KEY (`fnc_cod_pai`) REFERENCES `funcao` (`fnc_cod`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `funcao_pessoa`
--
ALTER TABLE `funcao_pessoa`
  ADD CONSTRAINT `fk_funcao_pessoa_funcao1` FOREIGN KEY (`fnc_cod`) REFERENCES `funcao` (`fnc_cod`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_funcao_pessoa_pessoa1` FOREIGN KEY (`psa_cod`) REFERENCES `pessoa` (`psa_cod`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `mensagem`
--
ALTER TABLE `mensagem`
  ADD CONSTRAINT `fk_mensagem_mensagem1` FOREIGN KEY (`msg_cod_pai`) REFERENCES `mensagem` (`msg_cod`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_mensagem_pessoa1` FOREIGN KEY (`psa_cod_send`) REFERENCES `pessoa` (`psa_cod`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_mensagem_pessoa2` FOREIGN KEY (`psa_cod_to`) REFERENCES `pessoa` (`psa_cod`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `mensagem_grupo`
--
ALTER TABLE `mensagem_grupo`
  ADD CONSTRAINT `fk_mensagem_grupo_pessoa1` FOREIGN KEY (`psa_cod_dono`) REFERENCES `pessoa` (`psa_cod`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_mensagem_grupo_pessoa2` FOREIGN KEY (`psa_cod_participante`) REFERENCES `pessoa` (`psa_cod`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `menu`
--
ALTER TABLE `menu`
  ADD CONSTRAINT `fk_menu_menu1` FOREIGN KEY (`menu_cod_pai`) REFERENCES `menu` (`menu_cod`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `menu_pessoa`
--
ALTER TABLE `menu_pessoa`
  ADD CONSTRAINT `fk_menu_pessoa_menu1` FOREIGN KEY (`menu_cod`) REFERENCES `menu` (`menu_cod`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_menu_pessoa_pessoa1` FOREIGN KEY (`psa_cod`) REFERENCES `pessoa` (`psa_cod`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `ministerio`
--
ALTER TABLE `ministerio`
  ADD CONSTRAINT `fk_ministerio_ministerio1` FOREIGN KEY (`mnt_cod_pai`) REFERENCES `ministerio` (`mnt_cod`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_ministerio_pessoa1` FOREIGN KEY (`psa_cod`) REFERENCES `pessoa` (`psa_cod`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `ministerio_pessoa`
--
ALTER TABLE `ministerio_pessoa`
  ADD CONSTRAINT `fk_ministerio_pessoa_ministerio1` FOREIGN KEY (`mnt_cod`) REFERENCES `ministerio` (`mnt_cod`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_ministerio_pessoa_pessoa1` FOREIGN KEY (`psa_cod`) REFERENCES `pessoa` (`psa_cod`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `pessoa`
--
ALTER TABLE `pessoa`
  ADD CONSTRAINT `fk_pessoa_pessoa` FOREIGN KEY (`psa_cod_conjuge`) REFERENCES `pessoa` (`psa_cod`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_pessoa_tipo1` FOREIGN KEY (`tipo_cod`) REFERENCES `pessoa_tipo` (`tipo_cod`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `sistema_log`
--
ALTER TABLE `sistema_log`
  ADD CONSTRAINT `fk_sistema_log_pessoa1` FOREIGN KEY (`psa_cod`) REFERENCES `pessoa` (`psa_cod`) ON DELETE NO ACTION ON UPDATE NO ACTION;
