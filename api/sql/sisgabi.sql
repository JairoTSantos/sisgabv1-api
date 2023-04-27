
CREATE TABLE IF NOT EXISTS `db_agenda` (
  `agenda_id` int NOT NULL AUTO_INCREMENT,
  `agenda_situacao` varchar(50) DEFAULT NULL,
  `agenda_data` datetime DEFAULT NULL,
  `agenda_titulo` varchar(2000) DEFAULT NULL,
  `agenda_local` varchar(100) DEFAULT NULL,
  `agenda_equipe` varchar(50) DEFAULT NULL,
  `agenda_presenca` varchar(50) DEFAULT NULL,
  `agenda_uf` varchar(50) DEFAULT NULL,
  `agenda_tipo` varchar(50) NOT NULL,
  `agenda_criado_em` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  KEY `Index 1` (`agenda_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


CREATE TABLE IF NOT EXISTS `db_clipping` (
  `clipping_id` int NOT NULL AUTO_INCREMENT,
  `clipping_link` varchar(2000) DEFAULT NULL,
  `clipping_veiculo` varchar(2000) DEFAULT NULL,
  `clipping_resumo` text,
  `clipping_data` datetime DEFAULT NULL,
  `clipping_texto` text,
  `clipping_pdf` varchar(500) NOT NULL,
  `clipping_importancia` varchar(50) NOT NULL,
  `clipping_criado_em` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`clipping_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


CREATE TABLE IF NOT EXISTS `db_emendas` (
  `emenda_id` int NOT NULL AUTO_INCREMENT,
  `emenda_numero` int DEFAULT NULL,
  `emenda_orgao` varchar(200) DEFAULT NULL,
  `emenda_beneficiario` varchar(2000) DEFAULT NULL,
  `emenda_objeto` varchar(2000) DEFAULT NULL,
  `emenda_modalidade` int DEFAULT NULL,
  `emenda_grupo` int DEFAULT NULL,
  `emenda_proposta` varchar(2000) DEFAULT NULL,
  `emenda_valor` decimal(10,2) DEFAULT NULL,
  `emenda_empenho` varchar(2000) DEFAULT NULL,
  `emenda_ordem` varchar(2000) DEFAULT NULL,
  `emenda_situacao` varchar(2000) DEFAULT NULL,
  `emenda_data` date DEFAULT NULL,
  `emenda_tipo` varchar(50) NOT NULL,
  `emenda_criado_em` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  KEY `Index 1` (`emenda_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


CREATE TABLE IF NOT EXISTS `db_pessoas` (
  `pessoa_id` int NOT NULL AUTO_INCREMENT,
  `pessoa_nome` varchar(50) DEFAULT NULL,
  `pessoa_aniversario` date DEFAULT NULL,
  `pessoa_email` varchar(50) DEFAULT NULL,
  `pessoa_telefone` varchar(50) DEFAULT NULL,
  `pessoa_endereco` varchar(500) DEFAULT NULL,
  `pessoa_estado` varchar(50) DEFAULT NULL,
  `pessoa_municipio` varchar(50) DEFAULT NULL,
  `pessoa_cep` varchar(50) DEFAULT NULL,
  `pessoa_relacao` varchar(500) DEFAULT NULL,
  `pessoa_cargo` varchar(50) DEFAULT NULL,
  `pessoa_orgao` varchar(50) DEFAULT NULL,
  `pessoa_face` varchar(50) DEFAULT NULL,
  `pessoa_insta` varchar(50) DEFAULT NULL,
  `pessoa_criado_em` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  KEY `Index 1` (`pessoa_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


CREATE TABLE IF NOT EXISTS `db_servidores` (
  `servidor_ponto` int DEFAULT NULL,
  `servidor_nome` varchar(50) DEFAULT NULL,
  `servidor_aniversario` varchar(5) DEFAULT NULL,
  `servidor_email` varchar(50) DEFAULT NULL,
  `servidor_telefone` varchar(50) DEFAULT NULL,
  `servidor_lotacao` varchar(50) DEFAULT NULL,
  `servidor_senha` varchar(1000) DEFAULT NULL,
  `servidor_nivel` int DEFAULT NULL,
  `servidor_criado_em` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  UNIQUE KEY `servidor_ponto` (`servidor_ponto`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


