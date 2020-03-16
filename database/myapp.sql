-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 04-Mar-2020 às 07:12
-- Versão do servidor: 10.4.11-MariaDB
-- versão do PHP: 7.2.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `myapp`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `client`
--

CREATE TABLE `client` (
  `ID` int(11) NOT NULL DEFAULT 0,
  `TYPE` varchar(25) NOT NULL,
  `NAME` varchar(255) NOT NULL,
  `PHONE` varchar(255) NOT NULL,
  `MAIL` varchar(255) DEFAULT NULL,
  `CPF_CNPJ` varchar(255) NOT NULL,
  `ZIPCODE` varchar(8) NOT NULL,
  `STREET` varchar(255) NOT NULL,
  `NUMBER` int(11) NOT NULL,
  `NEIGHBORHOOD` varchar(255) NOT NULL,
  `CITY_STATE` varchar(255) NOT NULL,
  `ACTIVE` int(11) NOT NULL,
  `CREATED_BY` int(11) NOT NULL,
  `CREATED_ON` datetime NOT NULL DEFAULT current_timestamp(),
  `MODIFIED_BY` int(11) DEFAULT NULL,
  `MODIFIED_ON` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `client`
--

INSERT INTO `client` (`ID`, `TYPE`, `NAME`, `PHONE`, `MAIL`, `CPF_CNPJ`, `ZIPCODE`, `STREET`, `NUMBER`, `NEIGHBORHOOD`, `CITY_STATE`, `ACTIVE`, `CREATED_BY`, `CREATED_ON`, `MODIFIED_BY`, `MODIFIED_ON`) VALUES
(1, 'natural_person', 'Pedro Igor Nobre Bezerra', '85986701595', 'pedroigormt2214@gmail.com', '02920470370', '60442605', 'Rua Vinte e Um de Abril', 2, 'Bela Vista', 'Fortaleza - CE', 1, 2, '2020-02-23 01:32:10', 2, '2020-03-04 01:44:33');

-- --------------------------------------------------------

--
-- Estrutura da tabela `product`
--

CREATE TABLE `product` (
  `ID` int(11) NOT NULL,
  `DESCRIPTION` text NOT NULL,
  `QUANTITY` varchar(255) NOT NULL,
  `LOW_STOCK` int(11) NOT NULL,
  `FK_ID_UNITY` int(11) NOT NULL,
  `MEASURE` varchar(255) NOT NULL,
  `COST` varchar(255) NOT NULL,
  `SALE_VALUE` int(11) DEFAULT NULL,
  `FK_ID_PROVIDER` int(11) NOT NULL,
  `OBSERVATION` text DEFAULT NULL,
  `CREATED_BY` int(11) NOT NULL,
  `CREATED_ON` datetime NOT NULL DEFAULT current_timestamp(),
  `MODIFIED_BY` int(11) DEFAULT NULL,
  `MODIFIED_ON` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `product`
--

INSERT INTO `product` (`ID`, `DESCRIPTION`, `QUANTITY`, `LOW_STOCK`, `FK_ID_UNITY`, `MEASURE`, `COST`, `SALE_VALUE`, `FK_ID_PROVIDER`, `OBSERVATION`, `CREATED_BY`, `CREATED_ON`, `MODIFIED_BY`, `MODIFIED_ON`) VALUES
(2, 'TESTE', '16', 15, 3, '10', '12,20', 15, 1, '123SASDASD', 1, '2020-02-25 00:05:42', 1, '2020-03-03 21:47:27'),
(4, '123123', '123', 123124, 4, '123', '31.231,23', 1, 6, '2313123', 1, '2020-03-03 21:48:17', 1, '2020-03-04 02:03:48'),
(5, 'Fita branca 18mm x 45m', '1233123', 12312, 3, '123123', '12,31', 170, 0, '', 1, '2020-03-04 01:54:40', NULL, NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `provider`
--

CREATE TABLE `provider` (
  `ID` int(11) NOT NULL,
  `TYPE` varchar(25) NOT NULL,
  `NAME` varchar(255) NOT NULL,
  `PHONE` varchar(255) NOT NULL,
  `MAIL` varchar(255) DEFAULT NULL,
  `CPF_CNPJ` varchar(255) NOT NULL,
  `ZIPCODE` varchar(8) NOT NULL,
  `STREET` varchar(255) NOT NULL,
  `NUMBER` int(11) NOT NULL,
  `NEIGHBORHOOD` varchar(255) NOT NULL,
  `CITY_STATE` varchar(255) NOT NULL,
  `ACTIVE` int(11) NOT NULL,
  `CREATED_BY` int(11) NOT NULL,
  `CREATED_ON` datetime NOT NULL DEFAULT current_timestamp(),
  `MODIFIED_BY` int(11) DEFAULT NULL,
  `MODIFIED_ON` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `provider`
--

INSERT INTO `provider` (`ID`, `TYPE`, `NAME`, `PHONE`, `MAIL`, `CPF_CNPJ`, `ZIPCODE`, `STREET`, `NUMBER`, `NEIGHBORHOOD`, `CITY_STATE`, `ACTIVE`, `CREATED_BY`, `CREATED_ON`, `MODIFIED_BY`, `MODIFIED_ON`) VALUES
(1, 'natural_person', 'Pedro Igor Nobre Bezerra', '85986701595', 'pedroigormt2214@gmail.com', '02920470370', '60442605', 'Rua Vinte e Um de Abril', 2, 'Bela Vista', 'Fortaleza - CE', 1, 2, '2020-02-23 01:32:10', 2, '2020-03-04 01:46:14'),
(6, 'legal_person', 'teste', '85986701595', 'pedroigormt2214@gmail.com', '02920470370000', '60442605', 'Rua Vinte e Um de Abril', 2, 'Bela Vista', 'Fortaleza - CE', 1, 2, '2020-03-04 01:59:56', NULL, NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `unity`
--

CREATE TABLE `unity` (
  `ID` int(11) NOT NULL,
  `NAME` varchar(255) NOT NULL,
  `ABREVIATION` varchar(255) NOT NULL,
  `ACTIVE` int(11) NOT NULL,
  `CREATED_BY` int(11) NOT NULL,
  `CREATED_ON` datetime NOT NULL DEFAULT current_timestamp(),
  `MODIFIED_BY` int(11) DEFAULT NULL,
  `MODIFIED_ON` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `unity`
--

INSERT INTO `unity` (`ID`, `NAME`, `ABREVIATION`, `ACTIVE`, `CREATED_BY`, `CREATED_ON`, `MODIFIED_BY`, `MODIFIED_ON`) VALUES
(1, 'PACOTE', 'PCT', 0, 1, '2020-02-24 01:38:16', NULL, NULL),
(2, 'UNIDADE', 'UN', 0, 1, '2020-02-24 01:38:28', NULL, NULL),
(3, 'QUILOS', 'KG', 1, 1, '2020-02-24 01:38:28', NULL, NULL),
(4, 'GRAMAS', 'G', 1, 1, '2020-02-24 01:38:28', NULL, NULL),
(5, 'LITROS', 'L', 1, 1, '2020-02-24 01:38:28', NULL, NULL),
(6, 'MILILITROS', 'ML', 1, 1, '2020-02-24 01:38:28', NULL, NULL),
(7, 'METROS', 'M', 1, 1, '2020-02-24 01:38:28', NULL, NULL),
(8, 'CENTIMETROS', 'CM', 1, 1, '2020-02-24 01:38:28', NULL, NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `user`
--

CREATE TABLE `user` (
  `ID` int(11) NOT NULL,
  `USERNAME` varchar(255) NOT NULL,
  `PASSWORD` varchar(255) NOT NULL,
  `NAME` varchar(255) NOT NULL,
  `ACTIVE` int(11) NOT NULL,
  `CREATED_BY` varchar(255) NOT NULL,
  `CREATED_ON` datetime NOT NULL DEFAULT current_timestamp(),
  `MODIFIED_BY` varchar(255) NOT NULL,
  `MODIFIED_ON` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `user`
--

INSERT INTO `user` (`ID`, `USERNAME`, `PASSWORD`, `NAME`, `ACTIVE`, `CREATED_BY`, `CREATED_ON`, `MODIFIED_BY`, `MODIFIED_ON`) VALUES
(1, 'PEDRO.BEZERRA', '0501', 'PEDRO IGOR NOBRE BEZERRA', 1, 'PEDRO.BEZERRA', '2020-02-18 23:36:53', '', '0000-00-00 00:00:00'),
(2, 'MONALIZ.QUEIROZ', '2407', 'MONALIZ MARIA NOBRE QUEIROZ', 1, 'PEDRO.BEZERRA', '2020-02-22 15:31:01', '', '0000-00-00 00:00:00');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`ID`);

--
-- Índices para tabela `provider`
--
ALTER TABLE `provider`
  ADD PRIMARY KEY (`ID`);

--
-- Índices para tabela `unity`
--
ALTER TABLE `unity`
  ADD PRIMARY KEY (`ID`);

--
-- Índices para tabela `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `product`
--
ALTER TABLE `product`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `provider`
--
ALTER TABLE `provider`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de tabela `unity`
--
ALTER TABLE `unity`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de tabela `user`
--
ALTER TABLE `user`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
