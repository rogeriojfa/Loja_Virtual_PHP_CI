-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 31, 2021 at 09:08 PM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 7.3.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `loja`
--

-- --------------------------------------------------------

--
-- Table structure for table `categorias`
--

CREATE TABLE `categorias` (
  `categoria_id` int(11) NOT NULL,
  `categoria_pai_id` int(11) DEFAULT NULL,
  `categoria_nome` varchar(45) NOT NULL,
  `categoria_ativa` tinyint(1) DEFAULT NULL,
  `categoria_meta_link` varchar(100) DEFAULT NULL,
  `categoria_data_criacao` timestamp NOT NULL DEFAULT current_timestamp(),
  `categoria_data_alteracao` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categorias`
--

INSERT INTO `categorias` (`categoria_id`, `categoria_pai_id`, `categoria_nome`, `categoria_ativa`, `categoria_meta_link`, `categoria_data_criacao`, `categoria_data_alteracao`) VALUES
(1, 2, 'Camisa Elite', 1, 'camisa-elite', '2021-03-24 12:51:43', '2021-04-08 18:52:18'),
(2, 2, 'Bretelle', 1, 'bretelle', '2021-03-24 12:53:21', '2021-03-24 20:42:08'),
(3, NULL, 'Calça', 1, 'calca', '2021-03-24 20:25:39', '2021-03-24 20:25:39'),
(5, 5, 'Pastilhas de Freio', 1, 'pastilhas-de-freio', '2021-04-07 13:26:52', '2021-04-07 13:26:52'),
(6, 2, 'Camisa Ciclotour', 1, 'camisa-ciclotour', '2021-04-08 18:52:30', '2021-04-08 18:52:30'),
(7, 2, 'Camisa Start', 1, 'camisa-start', '2021-04-08 18:52:49', '2021-04-08 18:52:49');

-- --------------------------------------------------------

--
-- Table structure for table `categorias_pai`
--

CREATE TABLE `categorias_pai` (
  `categoria_pai_id` int(11) NOT NULL,
  `categoria_pai_nome` varchar(45) NOT NULL,
  `categoria_pai_ativa` tinyint(1) DEFAULT NULL,
  `categoria_pai_meta_link` varchar(100) DEFAULT NULL,
  `categoria_pai_data_criacao` timestamp NOT NULL DEFAULT current_timestamp(),
  `categoria_pai_data_alteracao` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categorias_pai`
--

INSERT INTO `categorias_pai` (`categoria_pai_id`, `categoria_pai_nome`, `categoria_pai_ativa`, `categoria_pai_meta_link`, `categoria_pai_data_criacao`, `categoria_pai_data_alteracao`) VALUES
(2, 'Vestuário', 1, 'vestuario', '2021-03-23 20:07:15', '2021-03-23 20:07:15'),
(3, 'Calçados', 1, 'calcados', '2021-04-01 19:49:55', '2021-04-01 19:49:55'),
(4, 'Sinalização', 1, 'sinalizacao', '2021-04-01 19:50:05', '2021-04-01 19:50:05'),
(5, 'Peças', 1, 'pecas', '2021-04-01 19:50:18', '2021-04-01 19:50:18'),
(6, 'Hidratação', 1, 'hidratacao', '2021-04-01 19:50:42', '2021-04-01 19:50:42');

-- --------------------------------------------------------

--
-- Table structure for table `clientes`
--

CREATE TABLE `clientes` (
  `cliente_id` int(11) NOT NULL,
  `cliente_data_cadastro` timestamp NULL DEFAULT current_timestamp(),
  `cliente_nome` varchar(45) NOT NULL,
  `cliente_sobrenome` varchar(150) NOT NULL,
  `cliente_data_nascimento` date DEFAULT NULL,
  `cliente_cpf` varchar(20) NOT NULL,
  `cliente_email` varchar(150) NOT NULL,
  `cliente_telefone_fixo` varchar(20) DEFAULT NULL,
  `cliente_telefone_movel` varchar(20) NOT NULL,
  `cliente_cep` varchar(10) NOT NULL,
  `cliente_endereco` varchar(155) NOT NULL,
  `cliente_numero_endereco` varchar(20) NOT NULL,
  `cliente_bairro` varchar(45) NOT NULL,
  `cliente_cidade` varchar(105) NOT NULL,
  `cliente_estado` varchar(2) NOT NULL,
  `cliente_complemento` varchar(145) DEFAULT NULL,
  `cliente_data_alteracao` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `clientes`
--

INSERT INTO `clientes` (`cliente_id`, `cliente_data_cadastro`, `cliente_nome`, `cliente_sobrenome`, `cliente_data_nascimento`, `cliente_cpf`, `cliente_email`, `cliente_telefone_fixo`, `cliente_telefone_movel`, `cliente_cep`, `cliente_endereco`, `cliente_numero_endereco`, `cliente_bairro`, `cliente_cidade`, `cliente_estado`, `cliente_complemento`, `cliente_data_alteracao`) VALUES
(1, '2021-05-05 20:30:27', 'Rogério Silva', 'Sauro', '1973-11-01', '998.236.676-91', 'rogeriojfa@gmail.com', '(32) 3218-1045', '(32) 98809-7877', '36060-620', 'Rua Aangelo biggi', '963', 'Linhares', 'Juiz de Fora', 'MG', 'Fundos', '2021-05-05 20:30:27'),
(9, '2021-05-26 14:48:19', 'Lara', 'Rigolon', '2006-07-21', '209.963.420-36', 'lara@gmail.com', NULL, '(78) 56412-3123', '36060-620', 'Rua Ângelo Bigi', '963', 'Linhares', 'Juiz de Fora', 'MG', NULL, '2021-05-26 14:48:19'),
(10, '2021-05-26 19:00:52', 'Luiz', 'Carlos', '1984-04-12', '219.972.150-71', 'luiz@gmail.com', NULL, '(78) 94561-2313', '36060-300', 'Rua Diva Garcia', '2460', 'Linhares', 'Juiz de Fora', 'MG', NULL, '2021-05-26 19:00:52'),
(11, '2021-05-26 19:03:55', 'luiz fernando', 'Silva', '1978-11-01', '594.124.960-87', 'luizf@gmail.com', NULL, '(23) 21312-3123', '36060-610', 'Rua Maria Augusta', '11', 'Linhares', 'Juiz de Fora', 'MG', NULL, '2021-05-26 19:03:55'),
(12, '2021-05-27 14:10:32', 'Gabriel', 'Rigolon', '1987-12-01', '845.210.950-46', 'gabi@gmail.com', NULL, '(54) 67892-1345', '36060-620', 'Rua Ângelo Bigi', '963', 'Linhares', 'Juiz de Fora', 'MG', NULL, '2021-05-27 14:10:32');

-- --------------------------------------------------------

--
-- Table structure for table `config_correios`
--

CREATE TABLE `config_correios` (
  `config_id` int(11) NOT NULL,
  `config_cep_origem` varchar(20) NOT NULL,
  `config_codigo_pac` varchar(10) NOT NULL,
  `config_codigo_sedex` varchar(10) NOT NULL,
  `config_somar_frete` decimal(10,2) NOT NULL,
  `config_valor_declarado` decimal(5,2) NOT NULL,
  `config_data_alteracao` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `config_correios`
--

INSERT INTO `config_correios` (`config_id`, `config_cep_origem`, `config_codigo_pac`, `config_codigo_sedex`, `config_somar_frete`, `config_valor_declarado`, `config_data_alteracao`) VALUES
(1, '80530-000', '04510', '04014', '3.50', '21.50', '2021-03-30 23:20:09');

-- --------------------------------------------------------

--
-- Table structure for table `config_pagseguro`
--

CREATE TABLE `config_pagseguro` (
  `config_id` int(11) NOT NULL,
  `config_email` varchar(255) NOT NULL,
  `config_token` varchar(100) NOT NULL,
  `config_ambiente` tinyint(1) NOT NULL COMMENT '0 -> Ambiente real / 1 -> Ambiente sandbox',
  `config_data_alteracao` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `config_pagseguro`
--

INSERT INTO `config_pagseguro` (`config_id`, `config_email`, `config_token`, `config_ambiente`, `config_data_alteracao`) VALUES
(1, 'rogeriojfa@gmail.com', '0D52FCE5E9A8459688006014209E9F71', 1, '2021-03-31 13:57:44');

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE `groups` (
  `id` mediumint(8) UNSIGNED NOT NULL,
  `name` varchar(20) NOT NULL,
  `description` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `name`, `description`) VALUES
(1, 'admin', 'Administrator'),
(2, 'clientes', 'General User');

-- --------------------------------------------------------

--
-- Table structure for table `login_attempts`
--

CREATE TABLE `login_attempts` (
  `id` int(11) UNSIGNED NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `login` varchar(100) NOT NULL,
  `time` int(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `marcas`
--

CREATE TABLE `marcas` (
  `marca_id` int(11) NOT NULL,
  `marca_nome` varchar(45) NOT NULL,
  `marca_meta_link` varchar(255) NOT NULL,
  `marca_ativa` tinyint(1) DEFAULT NULL,
  `marca_data_criacao` timestamp NOT NULL DEFAULT current_timestamp(),
  `marca_data_alteracao` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `marcas`
--

INSERT INTO `marcas` (`marca_id`, `marca_nome`, `marca_meta_link`, `marca_ativa`, `marca_data_criacao`, `marca_data_alteracao`) VALUES
(6, 'VEST', 'vest', 1, '2021-03-23 18:23:50', '2021-03-23 18:24:16'),
(8, 'VEZZO', 'vezzo', 1, '2021-03-31 20:59:55', NULL),
(9, 'MORIAH', 'moriah', 1, '2021-03-31 21:00:08', NULL),
(10, 'TSW', 'tsw', 1, '2021-03-31 21:00:16', NULL),
(11, 'ERT', 'ert', 1, '2021-03-31 21:00:27', NULL),
(12, 'INVICTO', 'invicto', 1, '2021-03-31 21:00:36', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `pedidos`
--

CREATE TABLE `pedidos` (
  `pedido_id` int(11) NOT NULL,
  `pedido_codigo` varchar(8) DEFAULT NULL,
  `pedido_cliente_id` int(11) DEFAULT NULL,
  `pedido_valor_produtos` decimal(15,2) DEFAULT NULL,
  `pedido_valor_frete` decimal(15,2) DEFAULT NULL,
  `pedido_valor_final` decimal(15,2) DEFAULT NULL,
  `pedido_forma_envio` tinyint(1) DEFAULT NULL COMMENT '1 = Correios Sedex---------------------2 - Correios PAC',
  `pedido_data_cadastro` timestamp NOT NULL DEFAULT current_timestamp(),
  `pedido_data_alteracao` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pedidos`
--

INSERT INTO `pedidos` (`pedido_id`, `pedido_codigo`, `pedido_cliente_id`, `pedido_valor_produtos`, `pedido_valor_frete`, `pedido_valor_final`, `pedido_forma_envio`, `pedido_data_cadastro`, `pedido_data_alteracao`) VALUES
(1, '58267041', 9, '39.90', '38.92', '78.82', 1, '2021-05-26 14:48:23', NULL),
(2, '51784230', 10, '39.90', '78.52', '118.42', 2, '2021-05-26 19:00:56', NULL),
(3, '95734128', 11, '39.90', '78.52', '118.42', 2, '2021-05-26 19:03:59', NULL),
(4, '26594378', 12, '39.90', '78.52', '118.42', 2, '2021-05-27 14:10:35', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `pedidos_produtos`
--

CREATE TABLE `pedidos_produtos` (
  `pedido_id` int(11) DEFAULT NULL,
  `produto_id` int(11) DEFAULT NULL,
  `produto_nome` varchar(200) NOT NULL,
  `produto_quantidade` int(11) NOT NULL,
  `produto_valor_unitario` decimal(15,2) NOT NULL,
  `produto_valor_total` decimal(15,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pedidos_produtos`
--

INSERT INTO `pedidos_produtos` (`pedido_id`, `produto_id`, `produto_nome`, `produto_quantidade`, `produto_valor_unitario`, `produto_valor_total`) VALUES
(1, 3, 'Sinalizador traseiro', 1, '39.90', '39.90'),
(2, 3, 'Sinalizador traseiro', 1, '39.90', '39.90'),
(3, 3, 'Sinalizador traseiro', 1, '39.90', '39.90'),
(4, 3, 'Sinalizador traseiro', 1, '39.90', '39.90');

-- --------------------------------------------------------

--
-- Table structure for table `produtos`
--

CREATE TABLE `produtos` (
  `produto_id` int(11) NOT NULL,
  `produto_codigo` varchar(45) DEFAULT NULL,
  `produto_data_cadastro` timestamp NULL DEFAULT current_timestamp(),
  `produto_categoria_id` int(11) DEFAULT NULL,
  `produto_marca_id` int(11) DEFAULT NULL,
  `produto_nome` varchar(255) DEFAULT NULL,
  `produto_meta_link` varchar(255) DEFAULT NULL,
  `produto_peso` int(11) DEFAULT 0,
  `produto_altura` int(11) DEFAULT 0,
  `produto_largura` int(11) DEFAULT 0,
  `produto_comprimento` int(11) DEFAULT 0,
  `produto_valor` varchar(45) DEFAULT NULL,
  `produto_destaque` tinyint(1) DEFAULT NULL,
  `produto_controlar_estoque` tinyint(1) DEFAULT NULL,
  `produto_quantidade_estoque` int(11) DEFAULT 0,
  `produto_ativo` tinyint(1) DEFAULT NULL,
  `produto_descricao` longtext DEFAULT NULL,
  `produto_data_alteracao` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `produtos`
--

INSERT INTO `produtos` (`produto_id`, `produto_codigo`, `produto_data_cadastro`, `produto_categoria_id`, `produto_marca_id`, `produto_nome`, `produto_meta_link`, `produto_peso`, `produto_altura`, `produto_largura`, `produto_comprimento`, `produto_valor`, `produto_destaque`, `produto_controlar_estoque`, `produto_quantidade_estoque`, `produto_ativo`, `produto_descricao`, `produto_data_alteracao`) VALUES
(1, '12345678', '2021-03-25 13:48:03', 6, 6, 'Camisa ciclotour VEST', 'camisa-ciclotour-vest', 1, 15, 15, 15, '89', 1, 1, 0, 1, 'teste de descrição', NULL),
(3, '92647815', '2021-03-30 21:26:14', 1, 6, 'Sinalizador traseiro', 'sinalizador-traseiro', 1, 15, 15, 15, '39.90', 1, 1, 5, 1, 'sinalizador top de linha', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `produtos_fotos`
--

CREATE TABLE `produtos_fotos` (
  `foto_id` int(11) NOT NULL,
  `foto_produto_id` int(11) DEFAULT NULL,
  `foto_caminho` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `produtos_fotos`
--

INSERT INTO `produtos_fotos` (`foto_id`, `foto_produto_id`, `foto_caminho`) VALUES
(27, 1, '873576de635e04949d0c0af2c237dd79.jpg'),
(28, 1, 'ecb5399c049cd906313b1b4e83602fb0.jpg'),
(29, 3, '9e58b783ac499452520388c959d4d644.jpg'),
(30, 3, 'b6f108a3ccde8ecbe223f45d76124e9a.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `sistema`
--

CREATE TABLE `sistema` (
  `sistema_id` int(11) NOT NULL,
  `sistema_razao_social` varchar(145) DEFAULT NULL,
  `sistema_nome_fantasia` varchar(145) DEFAULT NULL,
  `sistema_cnpj` varchar(25) DEFAULT NULL,
  `sistema_ie` varchar(25) DEFAULT NULL,
  `sistema_telefone_fixo` varchar(25) DEFAULT NULL,
  `sistema_telefone_movel` varchar(25) NOT NULL,
  `sistema_email` varchar(100) DEFAULT NULL,
  `sistema_site_url` varchar(100) DEFAULT NULL,
  `sistema_cep` varchar(25) DEFAULT NULL,
  `sistema_endereco` varchar(145) DEFAULT NULL,
  `sistema_numero` varchar(25) DEFAULT NULL,
  `sistema_cidade` varchar(45) DEFAULT NULL,
  `sistema_estado` varchar(2) DEFAULT NULL,
  `sistema_produtos_destaques` int(11) NOT NULL,
  `sistema_texto` tinytext DEFAULT NULL,
  `sistema_data_alteracao` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sistema`
--

INSERT INTO `sistema` (`sistema_id`, `sistema_razao_social`, `sistema_nome_fantasia`, `sistema_cnpj`, `sistema_ie`, `sistema_telefone_fixo`, `sistema_telefone_movel`, `sistema_email`, `sistema_site_url`, `sistema_cep`, `sistema_endereco`, `sistema_numero`, `sistema_cidade`, `sistema_estado`, `sistema_produtos_destaques`, `sistema_texto`, `sistema_data_alteracao`) VALUES
(1, 'Superação Bikes ME', 'Vende tudo!', '80.838.809/0001-26', 'Vende tudo!', '(41) 3232-3030', '(41) 9999-9999', 'vendetudo@contato.com.br', 'http://vendetudo.com.br', '80510-000', 'Rua da Programação', '54', 'Curitiba', 'PR', 6, 'Preço e qualidade!', '2021-03-22 20:48:36');

-- --------------------------------------------------------

--
-- Table structure for table `transacoes`
--

CREATE TABLE `transacoes` (
  `transacao_id` int(11) NOT NULL,
  `transacao_pedido_id` int(11) DEFAULT NULL,
  `transacao_cliente_id` int(11) DEFAULT NULL,
  `transacao_data` timestamp NULL DEFAULT current_timestamp(),
  `transacao_codigo_hash` varchar(255) DEFAULT NULL,
  `transacao_tipo_metodo_pagamento` tinyint(1) DEFAULT NULL COMMENT '1 = Cartão | 2 = Boleto | 3 = Transferência',
  `transacao_codigo_metodo_pagamento` varchar(10) DEFAULT NULL,
  `transacao_link_pagamento` varchar(255) DEFAULT NULL,
  `transacao_banco_escolhido` varchar(20) DEFAULT NULL,
  `transacao_valor_bruto` decimal(15,2) DEFAULT NULL,
  `transacao_valor_taxa_pagseguro` decimal(15,2) DEFAULT NULL,
  `transacao_valor_liquido` decimal(15,2) DEFAULT NULL,
  `transacao_numero_parcelas` int(11) DEFAULT NULL,
  `transacao_valor_parcela` decimal(15,2) DEFAULT NULL,
  `transacao_status` tinyint(1) DEFAULT NULL COMMENT 'Verificar documentação',
  `transacao_data_alteracao` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `transacoes`
--

INSERT INTO `transacoes` (`transacao_id`, `transacao_pedido_id`, `transacao_cliente_id`, `transacao_data`, `transacao_codigo_hash`, `transacao_tipo_metodo_pagamento`, `transacao_codigo_metodo_pagamento`, `transacao_link_pagamento`, `transacao_banco_escolhido`, `transacao_valor_bruto`, `transacao_valor_taxa_pagseguro`, `transacao_valor_liquido`, `transacao_numero_parcelas`, `transacao_valor_parcela`, `transacao_status`, `transacao_data_alteracao`) VALUES
(1, 1, 9, '2021-05-26 14:48:23', '8B9962AF-A01B-48F4-A7FB-4622A22E0C3E', 2, '202', 'https://sandbox.pagseguro.uol.com.br/checkout/payment/booklet/print.jhtml?c=baa2bd93eebd8723ff7f667986a04b2e922debe7071a96cb30e03c64c0673e4cbf6dfd481b3857f5', NULL, '78.82', '3.54', '75.28', 1, '78.82', 1, NULL),
(2, 2, 10, '2021-05-26 19:00:56', '48D58148-3C4E-4C31-A589-B5822E9177E9', 2, '202', 'https://sandbox.pagseguro.uol.com.br/checkout/payment/booklet/print.jhtml?c=6eabaac4e6fb5e3bf059d2699a71bfaae008fed1a36521f89e83a5b1d212afe43009096801009107', NULL, '118.42', '5.12', '113.30', 1, '118.42', 1, NULL),
(3, 3, 11, '2021-05-26 19:03:59', 'ED71ACA9-CB54-456B-AC36-59E268D285B8', 2, '202', 'https://sandbox.pagseguro.uol.com.br/checkout/payment/booklet/print.jhtml?c=ff70ed68413eb38f25d0ca9e1aa5097cb82b18df5bf14d97ad3a70dd9607618b8c4a4880c9f18259', NULL, '118.42', '5.12', '113.30', 1, '118.42', 1, NULL),
(4, 4, 12, '2021-05-27 14:10:35', '68335E91-1E28-44E5-A6FF-5AEAA4F66DB1', 3, '302', 'https://sandbox.pagseguro.uol.com.br/checkout/payment/eft/print.jhtml?c=cf6b2dd876415aece48e5d2ec2308660978508344cf76f3cf078021bfa0207d726ba95094ccf196e', NULL, '118.42', '5.12', '113.30', 1, '118.42', 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `cliente_user_id` int(11) DEFAULT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(254) NOT NULL,
  `activation_selector` varchar(255) DEFAULT NULL,
  `activation_code` varchar(255) DEFAULT NULL,
  `forgotten_password_selector` varchar(255) DEFAULT NULL,
  `forgotten_password_code` varchar(255) DEFAULT NULL,
  `forgotten_password_time` int(11) UNSIGNED DEFAULT NULL,
  `remember_selector` varchar(255) DEFAULT NULL,
  `remember_code` varchar(255) DEFAULT NULL,
  `created_on` int(11) UNSIGNED NOT NULL,
  `last_login` int(11) UNSIGNED DEFAULT NULL,
  `active` tinyint(1) UNSIGNED DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `company` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `ip_address`, `cliente_user_id`, `username`, `password`, `email`, `activation_selector`, `activation_code`, `forgotten_password_selector`, `forgotten_password_code`, `forgotten_password_time`, `remember_selector`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `company`, `phone`) VALUES
(1, '127.0.0.1', NULL, 'administrator', '$2y$10$87XczwHy4s1tCTGgRosR.uPfcu1FJ.tYbmzZY7AHMpHmahaThRGAW', 'admin@admin.com', NULL, '', NULL, NULL, NULL, NULL, NULL, 1268889823, 1621456758, 1, 'Admin', 'istrator', 'ADMIN', '0'),
(3, '', 1, NULL, '$2y$10$3nniss9wxF9je3eDJ2f1eeWV1UN75w4.KIL0WzTwEUPsTaAAqko0y', 'rogeriojfa@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1268889823, 1620934932, 1, 'Rogério Silva', 'Sauro', NULL, NULL),
(10, '::1', 9, 'Lara', '$2y$10$.NYv/xZtM2Dpwhb89VGHIupxANOhr2qMnuJ7.JqgWxsdcKNfjGQU.', 'lara@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1622040499, NULL, 1, 'Lara', 'Rigolon', NULL, '(78) 56412-3123'),
(11, '::1', 10, 'Luiz', '$2y$10$iIyAGytV76j3C3EMT5Ygi.gz3pPS94lyv42ENgTt.Aji9Ukx6fYC.', 'luiz@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1622055652, NULL, 1, 'Luiz', 'Carlos', NULL, '(78) 94561-2313'),
(12, '::1', 11, 'luiz fernando', '$2y$10$S1CCIAEB5Mp6xa2y0HMbI.kXB3ppZROoKZd7/LWPSAJ4r.NINIohW', 'luizf@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1622055835, 1622060110, 1, 'luiz fernando', 'Silva', NULL, '(23) 21312-3123'),
(13, '::1', 12, 'Gabriel', '$2y$10$XqP/b.xJBS7CvS.t1Q8LyefUXvVB99PEa3JQ90BabXMI/9G.wFV/a', 'gabi@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1622124632, NULL, 1, 'Gabriel', 'Rigolon', NULL, '(54) 67892-1345');

-- --------------------------------------------------------

--
-- Table structure for table `users_groups`
--

CREATE TABLE `users_groups` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `group_id` mediumint(8) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users_groups`
--

INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES
(7, 1, 1),
(9, 3, 2),
(17, 10, 2),
(18, 11, 2),
(19, 12, 2),
(20, 13, 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`categoria_id`),
  ADD KEY `categoria_pai_id` (`categoria_pai_id`);

--
-- Indexes for table `categorias_pai`
--
ALTER TABLE `categorias_pai`
  ADD PRIMARY KEY (`categoria_pai_id`);

--
-- Indexes for table `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`cliente_id`);

--
-- Indexes for table `config_correios`
--
ALTER TABLE `config_correios`
  ADD PRIMARY KEY (`config_id`);

--
-- Indexes for table `config_pagseguro`
--
ALTER TABLE `config_pagseguro`
  ADD PRIMARY KEY (`config_id`);

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `login_attempts`
--
ALTER TABLE `login_attempts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `marcas`
--
ALTER TABLE `marcas`
  ADD PRIMARY KEY (`marca_id`);

--
-- Indexes for table `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`pedido_id`),
  ADD KEY `pedido_cliente_id` (`pedido_cliente_id`);

--
-- Indexes for table `pedidos_produtos`
--
ALTER TABLE `pedidos_produtos`
  ADD KEY `pedido_id` (`pedido_id`,`produto_id`),
  ADD KEY `produto_id` (`produto_id`);

--
-- Indexes for table `produtos`
--
ALTER TABLE `produtos`
  ADD PRIMARY KEY (`produto_id`),
  ADD KEY `produto_categoria_id` (`produto_categoria_id`),
  ADD KEY `produto_marca_id` (`produto_marca_id`);

--
-- Indexes for table `produtos_fotos`
--
ALTER TABLE `produtos_fotos`
  ADD PRIMARY KEY (`foto_id`),
  ADD KEY `fk_foto_produto_id` (`foto_produto_id`);

--
-- Indexes for table `transacoes`
--
ALTER TABLE `transacoes`
  ADD PRIMARY KEY (`transacao_id`),
  ADD KEY `transacao_pedido_id` (`transacao_pedido_id`,`transacao_cliente_id`),
  ADD KEY `fk_transacao_cliente_id` (`transacao_cliente_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uc_email` (`email`),
  ADD UNIQUE KEY `uc_activation_selector` (`activation_selector`),
  ADD UNIQUE KEY `uc_forgotten_password_selector` (`forgotten_password_selector`),
  ADD UNIQUE KEY `uc_remember_selector` (`remember_selector`),
  ADD KEY `cliente_user_id` (`cliente_user_id`);

--
-- Indexes for table `users_groups`
--
ALTER TABLE `users_groups`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uc_users_groups` (`user_id`,`group_id`),
  ADD KEY `fk_users_groups_users1_idx` (`user_id`),
  ADD KEY `fk_users_groups_groups1_idx` (`group_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categorias`
--
ALTER TABLE `categorias`
  MODIFY `categoria_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `categorias_pai`
--
ALTER TABLE `categorias_pai`
  MODIFY `categoria_pai_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `clientes`
--
ALTER TABLE `clientes`
  MODIFY `cliente_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `config_pagseguro`
--
ALTER TABLE `config_pagseguro`
  MODIFY `config_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `login_attempts`
--
ALTER TABLE `login_attempts`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `marcas`
--
ALTER TABLE `marcas`
  MODIFY `marca_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `pedido_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `produtos`
--
ALTER TABLE `produtos`
  MODIFY `produto_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `produtos_fotos`
--
ALTER TABLE `produtos_fotos`
  MODIFY `foto_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `transacoes`
--
ALTER TABLE `transacoes`
  MODIFY `transacao_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `users_groups`
--
ALTER TABLE `users_groups`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `categorias`
--
ALTER TABLE `categorias`
  ADD CONSTRAINT `fk_categoria_pai_id` FOREIGN KEY (`categoria_pai_id`) REFERENCES `categorias_pai` (`categoria_pai_id`) ON DELETE CASCADE;

--
-- Constraints for table `pedidos`
--
ALTER TABLE `pedidos`
  ADD CONSTRAINT `fk_pedido_cliente_id` FOREIGN KEY (`pedido_cliente_id`) REFERENCES `clientes` (`cliente_id`) ON DELETE CASCADE;

--
-- Constraints for table `pedidos_produtos`
--
ALTER TABLE `pedidos_produtos`
  ADD CONSTRAINT `fk_pedido_id` FOREIGN KEY (`pedido_id`) REFERENCES `pedidos` (`pedido_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_produto_id` FOREIGN KEY (`produto_id`) REFERENCES `produtos` (`produto_id`) ON DELETE CASCADE;

--
-- Constraints for table `produtos_fotos`
--
ALTER TABLE `produtos_fotos`
  ADD CONSTRAINT `fk_foto_produto_id` FOREIGN KEY (`foto_produto_id`) REFERENCES `produtos` (`produto_id`) ON DELETE CASCADE;

--
-- Constraints for table `transacoes`
--
ALTER TABLE `transacoes`
  ADD CONSTRAINT `fk_transacao_cliente_id` FOREIGN KEY (`transacao_cliente_id`) REFERENCES `clientes` (`cliente_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_transacao_pedido_id` FOREIGN KEY (`transacao_pedido_id`) REFERENCES `pedidos` (`pedido_id`) ON DELETE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `fk_cliente_user_id` FOREIGN KEY (`cliente_user_id`) REFERENCES `clientes` (`cliente_id`) ON DELETE CASCADE;

--
-- Constraints for table `users_groups`
--
ALTER TABLE `users_groups`
  ADD CONSTRAINT `fk_users_groups_groups1` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_users_groups_users1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
