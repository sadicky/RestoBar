-- MySQL dump 10.13  Distrib 5.6.17, for Win32 (x86)
--
-- Host: localhost    Database: db_easy_resto_gros
-- ------------------------------------------------------
-- Server version	5.6.17

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `accounts`
--

DROP TABLE IF EXISTS `accounts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `accounts` (
  `acc_id` int(11) NOT NULL AUTO_INCREMENT,
  `bal_adv` int(11) DEFAULT NULL,
  `bal_cash` int(11) DEFAULT NULL,
  `last_update` date DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_date` date DEFAULT NULL,
  `personne_id` int(11) DEFAULT NULL,
  `acc_num` varchar(15) DEFAULT NULL,
  `status` bit(1) NOT NULL DEFAULT b'1',
  PRIMARY KEY (`acc_id`),
  KEY `updated_by` (`updated_by`),
  KEY `fggf` (`personne_id`),
  KEY `personne_id` (`personne_id`),
  CONSTRAINT `accounts_ibfk_1` FOREIGN KEY (`personne_id`) REFERENCES `personne` (`personne_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=110 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `accounts`
--

LOCK TABLES `accounts` WRITE;
/*!40000 ALTER TABLE `accounts` DISABLE KEYS */;
INSERT INTO `accounts` VALUES (16,0,706168,'2018-09-27',1,NULL,1,'1',''),(30,NULL,NULL,NULL,NULL,'2018-05-29',2,'17',''),(101,NULL,NULL,NULL,NULL,'2018-08-04',69,'31',''),(103,NULL,NULL,NULL,NULL,'2018-08-06',71,'103',''),(104,NULL,NULL,NULL,NULL,'2018-08-06',72,'104',''),(105,NULL,NULL,NULL,NULL,'2018-08-25',73,'105',''),(106,NULL,NULL,NULL,NULL,'2018-08-25',74,'106',''),(107,NULL,NULL,NULL,NULL,'2018-09-06',75,'107',''),(108,NULL,NULL,NULL,NULL,'2018-09-20',76,'108',''),(109,NULL,NULL,NULL,NULL,'2018-09-20',77,'109','');
/*!40000 ALTER TABLE `accounts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `achats`
--

DROP TABLE IF EXISTS `achats`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `achats` (
  `idachats` int(11) NOT NULL AUTO_INCREMENT,
  `amount` int(11) DEFAULT '0',
  `op_id` int(11) NOT NULL,
  `is_paid` bit(1) DEFAULT NULL,
  `num_achat` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`idachats`),
  KEY `op_id` (`op_id`),
  CONSTRAINT `achats_ibfk_1` FOREIGN KEY (`op_id`) REFERENCES `operation` (`op_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `achats`
--

LOCK TABLES `achats` WRITE;
/*!40000 ALTER TABLE `achats` DISABLE KEYS */;
INSERT INTO `achats` VALUES (9,389000,40,'\0','1/0918'),(10,101000,43,'\0','10/0918'),(11,45000,45,'\0','11/0918');
/*!40000 ALTER TABLE `achats` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `assureur`
--

DROP TABLE IF EXISTS `assureur`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `assureur` (
  `ass_id` int(11) NOT NULL AUTO_INCREMENT,
  `ass_name` varchar(30) NOT NULL,
  `personne_id` int(11) NOT NULL,
  `actif` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`ass_id`),
  KEY `personne_id` (`personne_id`),
  CONSTRAINT `assureur_ibfk_1` FOREIGN KEY (`personne_id`) REFERENCES `personne` (`personne_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `assureur`
--

LOCK TABLES `assureur` WRITE;
/*!40000 ALTER TABLE `assureur` DISABLE KEYS */;
INSERT INTO `assureur` VALUES (1,'Jeanine',73,1),(2,'Marc',74,1);
/*!40000 ALTER TABLE `assureur` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `attribution_menu`
--

DROP TABLE IF EXISTS `attribution_menu`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `attribution_menu` (
  `attrib_id` int(11) NOT NULL AUTO_INCREMENT,
  `personne_id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  `permission` varchar(60) DEFAULT NULL,
  PRIMARY KEY (`attrib_id`),
  KEY `personne_id` (`personne_id`),
  KEY `menu_id` (`menu_id`),
  CONSTRAINT `attribution_menu_ibfk_1` FOREIGN KEY (`personne_id`) REFERENCES `personne` (`personne_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `attribution_menu_ibfk_2` FOREIGN KEY (`menu_id`) REFERENCES `menu` (`menu_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=210 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `attribution_menu`
--

LOCK TABLES `attribution_menu` WRITE;
/*!40000 ALTER TABLE `attribution_menu` DISABLE KEYS */;
INSERT INTO `attribution_menu` VALUES (39,1,9,'-'),(42,1,4,'-'),(51,1,12,'-'),(52,1,15,'-'),(53,1,16,'-'),(54,1,17,'-'),(55,1,18,'-'),(57,1,20,'-'),(64,1,10,'-'),(65,1,11,'-'),(66,1,23,'-'),(67,1,1,'-'),(68,1,3,'-'),(72,1,26,'-'),(76,1,19,'-'),(78,1,29,'-'),(82,1,32,'-'),(83,1,33,'-'),(86,1,35,'-'),(87,1,36,'-'),(91,1,39,'-'),(94,1,28,'-'),(97,1,43,'-'),(98,1,44,'-'),(100,1,46,'-'),(186,1,51,'-'),(187,1,52,'-'),(188,1,27,'-'),(189,77,11,'-'),(190,77,44,'-'),(191,77,35,'-'),(192,77,12,'-'),(193,77,16,'-'),(194,77,17,'-'),(195,77,18,'-'),(196,77,32,'-'),(197,77,19,'-'),(198,77,46,'-'),(199,77,23,'-'),(200,77,26,'-'),(201,77,27,'-'),(202,77,28,'-'),(203,77,29,'-'),(204,77,33,'-'),(205,77,36,'-'),(206,77,39,'-'),(207,77,52,'-'),(208,77,15,'-'),(209,77,20,'-');
/*!40000 ALTER TABLE `attribution_menu` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `autre_info`
--

DROP TABLE IF EXISTS `autre_info`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `autre_info` (
  `id_info` int(11) NOT NULL AUTO_INCREMENT,
  `affilie` varchar(30) NOT NULL,
  `benef` varchar(20) NOT NULL,
  `service` varchar(30) NOT NULL,
  `num_bon` varchar(15) NOT NULL,
  `mat` varchar(15) NOT NULL,
  `idvente` int(11) NOT NULL,
  PRIMARY KEY (`id_info`),
  KEY `idvente` (`idvente`),
  CONSTRAINT `autre_info_ibfk_1` FOREIGN KEY (`idvente`) REFERENCES `vente` (`idvente`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `autre_info`
--

LOCK TABLES `autre_info` WRITE;
/*!40000 ALTER TABLE `autre_info` DISABLE KEYS */;
/*!40000 ALTER TABLE `autre_info` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `category`
--

DROP TABLE IF EXISTS `category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `category` (
  `category_id` int(11) NOT NULL AUTO_INCREMENT,
  `category_name` varchar(45) DEFAULT NULL,
  `status` bit(1) NOT NULL DEFAULT b'1',
  `parent_id` int(11) NOT NULL,
  PRIMARY KEY (`category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `category`
--

LOCK TABLES `category` WRITE;
/*!40000 ALTER TABLE `category` DISABLE KEYS */;
INSERT INTO `category` VALUES (1,'Boisson non alcolisÃ©','',0),(2,'Boisson alcoolisÃ©','',0);
/*!40000 ALTER TABLE `category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `composition`
--

DROP TABLE IF EXISTS `composition`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `composition` (
  `id_compo` int(11) NOT NULL AUTO_INCREMENT,
  `prod_id` int(11) NOT NULL,
  `ingred` int(11) NOT NULL,
  `qt` float NOT NULL,
  PRIMARY KEY (`id_compo`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `composition`
--

LOCK TABLES `composition` WRITE;
/*!40000 ALTER TABLE `composition` DISABLE KEYS */;
INSERT INTO `composition` VALUES (1,69,158,10),(2,69,239,0.25),(6,69,187,100),(7,101,160,10),(8,1,219,3),(9,1,200,40),(10,1,270,20),(11,1,220,30),(12,1,230,1),(13,2,219,3),(14,2,200,40),(15,2,270,20),(16,2,220,10),(17,2,236,15),(18,2,230,1),(19,3,219,3),(20,3,200,40),(21,3,270,20),(22,3,220,10),(23,3,230,1);
/*!40000 ALTER TABLE `composition` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `coupon`
--

DROP TABLE IF EXISTS `coupon`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `coupon` (
  `coupon_id` int(11) NOT NULL AUTO_INCREMENT,
  `coupon_name` int(11) NOT NULL,
  `status` bit(1) NOT NULL DEFAULT b'1',
  PRIMARY KEY (`coupon_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `coupon`
--

LOCK TABLES `coupon` WRITE;
/*!40000 ALTER TABLE `coupon` DISABLE KEYS */;
INSERT INTO `coupon` VALUES (1,50,''),(2,100,''),(3,500,''),(4,10000,''),(5,1000,''),(6,2000,'');
/*!40000 ALTER TABLE `coupon` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `customer`
--

DROP TABLE IF EXISTS `customer`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `customer` (
  `customer_id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_name` varchar(30) NOT NULL,
  `personne_id` int(11) NOT NULL,
  `actif` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`customer_id`),
  KEY `personne_id` (`personne_id`),
  CONSTRAINT `customer_ibfk_1` FOREIGN KEY (`personne_id`) REFERENCES `personne` (`personne_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `customer`
--

LOCK TABLES `customer` WRITE;
/*!40000 ALTER TABLE `customer` DISABLE KEYS */;
INSERT INTO `customer` VALUES (31,'Brown Mauzo',71,1),(32,'Cash',72,1),(33,'BIZIMANA Alain',75,1);
/*!40000 ALTER TABLE `customer` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `details_operation`
--

DROP TABLE IF EXISTS `details_operation`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `details_operation` (
  `details_id` int(11) NOT NULL AUTO_INCREMENT,
  `op_id` int(11) NOT NULL,
  `prod_id` int(11) NOT NULL,
  `quantity` float DEFAULT NULL,
  `amount` int(11) DEFAULT NULL,
  `det` bit(1) NOT NULL DEFAULT b'0',
  PRIMARY KEY (`details_id`),
  KEY `op_id` (`op_id`),
  CONSTRAINT `details_operation_ibfk_1` FOREIGN KEY (`op_id`) REFERENCES `operation` (`op_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=114 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `details_operation`
--

LOCK TABLES `details_operation` WRITE;
/*!40000 ALTER TABLE `details_operation` DISABLE KEYS */;
INSERT INTO `details_operation` VALUES (72,40,3,10,12500,'\0'),(73,40,2,15,14000,'\0'),(74,40,1,4,13500,'\0'),(88,41,3,10,20000,'\0'),(89,41,2,6,5000,''),(90,41,1,5,4000,''),(91,41,2,1,50000,'\0'),(94,43,1,3,12000,'\0'),(95,43,2,5,13000,'\0'),(97,46,2,6,5000,''),(101,47,3,2,2000,''),(105,48,2,1,50000,'\0'),(106,50,3,2,20000,'\0'),(107,45,4,15,3000,'\0'),(108,51,4,5,55000,'\0'),(109,52,4,3,55000,'\0'),(111,53,2,1,50000,'\0'),(112,53,3,12,2000,''),(113,53,1,6,4000,'');
/*!40000 ALTER TABLE `details_operation` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `doc`
--

DROP TABLE IF EXISTS `doc`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `doc` (
  `doc_id` int(11) NOT NULL AUTO_INCREMENT,
  `doc_name` varchar(45) DEFAULT NULL,
  `file_` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`doc_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `doc`
--

LOCK TABLES `doc` WRITE;
/*!40000 ALTER TABLE `doc` DISABLE KEYS */;
/*!40000 ALTER TABLE `doc` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `entre_prodf`
--

DROP TABLE IF EXISTS `entre_prodf`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `entre_prodf` (
  `ident` int(11) NOT NULL AUTO_INCREMENT,
  `op_id` int(11) NOT NULL,
  `amount` int(11) NOT NULL DEFAULT '0',
  `is_paid` bit(1) NOT NULL,
  `num_ent` varchar(20) NOT NULL,
  PRIMARY KEY (`ident`),
  KEY `op_id` (`op_id`),
  CONSTRAINT `entre_prodf_ibfk_1` FOREIGN KEY (`op_id`) REFERENCES `operation` (`op_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `entre_prodf`
--

LOCK TABLES `entre_prodf` WRITE;
/*!40000 ALTER TABLE `entre_prodf` DISABLE KEYS */;
/*!40000 ALTER TABLE `entre_prodf` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `info_suppl`
--

DROP TABLE IF EXISTS `info_suppl`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `info_suppl` (
  `id_info` int(11) NOT NULL AUTO_INCREMENT,
  `service` varchar(30) NOT NULL,
  `mat` varchar(15) NOT NULL,
  `personne_id` int(11) NOT NULL,
  PRIMARY KEY (`id_info`),
  KEY `idvente` (`personne_id`),
  KEY `personne_id` (`personne_id`),
  CONSTRAINT `info_suppl_ibfk_1` FOREIGN KEY (`personne_id`) REFERENCES `personne` (`personne_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `info_suppl`
--

LOCK TABLES `info_suppl` WRITE;
/*!40000 ALTER TABLE `info_suppl` DISABLE KEYS */;
INSERT INTO `info_suppl` VALUES (2,'','',71),(3,'Oui','',72),(4,'Non','9999',75);
/*!40000 ALTER TABLE `info_suppl` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `menu`
--

DROP TABLE IF EXISTS `menu`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `menu` (
  `menu_id` int(11) NOT NULL AUTO_INCREMENT,
  `menu_text` varchar(50) NOT NULL,
  `menu_id_text` varchar(20) NOT NULL,
  `menu_data_id` varchar(20) DEFAULT NULL,
  `menu_parent` int(11) NOT NULL,
  `menu_order` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`menu_id`)
) ENGINE=InnoDB AUTO_INCREMENT=53 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `menu`
--

LOCK TABLES `menu` WRITE;
/*!40000 ALTER TABLE `menu` DISABLE KEYS */;
INSERT INTO `menu` VALUES (1,'Menu de navigation','tab_menu','',2,0),(2,'Configuration','','',0,0),(3,'Utilisateurs','users','',2,0),(4,'Fournisseurs','suppliers','',5,0),(5,'Stock','','',0,0),(8,'Caisse','',NULL,0,0),(9,'categorie','category','',5,0),(10,'Produits','products','',5,0),(11,'Fournitures en gros','supply','',5,0),(12,'Paiement Fournisseurs','paiement','',8,0),(15,'Vente','client_ord','',25,0),(16,'Paiement Client','paiement_cli','',8,0),(17,'Versement','alim_cpt','',8,0),(18,'Retrait','ret_cpt','',8,0),(19,'DÃ©penses','dep','',8,0),(20,'Client','customers','',25,0),(21,'Rapports','','',0,0),(23,'Hist Appro Stock','hist_appro','',21,0),(25,'Vente','','',0,0),(26,'historique de vente','hist_vente','',21,0),(27,'Rapport de caisse','rap_caisse','',21,0),(28,'Rapport de vente','rap_vente','',21,0),(29,'Fiche du stock','rap_stk_mp','',21,0),(32,'Transfert','transf_cpt','',8,0),(33,'Situation du Stock','rap_situ_stk_mp','',21,0),(35,'Sortie du stock','sortie_mat','',5,0),(36,'Historique de sortie','hist_prod','',21,0),(39,'Hist Approv Pv','rap_conso_per','',21,0),(43,'Point de Vente','pos','',2,0),(44,'Approvisionnement PV','transf_prod','',5,0),(46,'Journal de caisse','jour_cais','',8,0),(51,'Serveurs','ass','',2,0),(52,'Rapport de consommation','fiche_syn','',21,0);
/*!40000 ALTER TABLE `menu` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `operation`
--

DROP TABLE IF EXISTS `operation`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `operation` (
  `op_id` int(11) NOT NULL AUTO_INCREMENT,
  `op_type` enum('Approvisionnement','Sortie','Production','Vente','Transfert produit') DEFAULT NULL,
  `create_date` date DEFAULT NULL,
  `state` bit(1) DEFAULT NULL,
  `party_code` varchar(45) DEFAULT NULL,
  `is_paid` bit(1) DEFAULT NULL,
  `personne_id` int(11) DEFAULT NULL,
  `party_type` enum('stock_in','stock_out','cash_in','cash_out') NOT NULL DEFAULT 'stock_in',
  `pos_id` int(11) NOT NULL DEFAULT '26',
  `valid_id` int(11) DEFAULT NULL,
  `is_send` bit(1) NOT NULL DEFAULT b'0',
  PRIMARY KEY (`op_id`),
  KEY `personne_id` (`personne_id`),
  CONSTRAINT `operation_ibfk_1` FOREIGN KEY (`personne_id`) REFERENCES `personne` (`personne_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=54 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `operation`
--

LOCK TABLES `operation` WRITE;
/*!40000 ALTER TABLE `operation` DISABLE KEYS */;
INSERT INTO `operation` VALUES (40,'Approvisionnement','2018-09-11','','69','\0',1,'stock_in',2,NULL,'\0'),(41,'Vente','2018-09-11','','72','',1,'stock_out',2,NULL,'\0'),(42,'Sortie','2018-09-11','','-','\0',1,'stock_out',2,NULL,'\0'),(43,'Approvisionnement','2018-09-20','','69','\0',1,'stock_in',76,NULL,'\0'),(44,'Sortie','2018-09-21','','-','\0',1,'stock_out',2,NULL,'\0'),(45,'Approvisionnement','2018-09-25','','69','\0',1,'stock_in',2,NULL,'\0'),(46,'Vente','2018-09-20','','72','\0',1,'stock_out',76,NULL,'\0'),(47,'Vente','2018-09-23','','72','\0',1,'stock_out',2,NULL,'\0'),(48,'Transfert produit','2018-09-23','','76','\0',1,'stock_out',2,NULL,'\0'),(49,'Transfert produit','2018-09-23','','76','\0',1,'stock_out',2,NULL,'\0'),(50,'Transfert produit','2018-09-25','','76','\0',1,'stock_out',2,NULL,'\0'),(51,'Transfert produit','2018-09-25','','76','\0',1,'stock_out',2,NULL,'\0'),(52,'Transfert produit','2018-09-25','','76','\0',1,'stock_out',2,NULL,'\0'),(53,'Vente','2018-09-27','','72','\0',77,'stock_out',2,NULL,'\0');
/*!40000 ALTER TABLE `operation` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `after_insert_operation` AFTER INSERT ON `operation`
 FOR EACH ROW BEGIN
/*declare new_amount int default 0;
declare val_is_paid bit default 0;

if new.op_type=1 then

INSERT INTO achats (amount,op_id,is_paid) VALUES(new_amount,new.op_id,val_is_paid);

end if;
*/
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `paiement`
--

DROP TABLE IF EXISTS `paiement`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `paiement` (
  `paie_id` int(11) NOT NULL AUTO_INCREMENT,
  `op_id` int(11) NOT NULL,
  `transaction_id` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `mode_paie` enum('Cash','Banque') NOT NULL DEFAULT 'Cash',
  `cheque` varchar(30) NOT NULL,
  PRIMARY KEY (`paie_id`),
  KEY `transaction_id` (`transaction_id`),
  KEY `op_id` (`op_id`),
  CONSTRAINT `paiement_ibfk_2` FOREIGN KEY (`transaction_id`) REFERENCES `transactions` (`transaction_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `paiement`
--

LOCK TABLES `paiement` WRITE;
/*!40000 ALTER TABLE `paiement` DISABLE KEYS */;
INSERT INTO `paiement` VALUES (1,41,1,50000,'Cash',''),(2,41,2,85000,'Cash',''),(3,41,3,150000,'Cash',''),(4,53,4,10000,'Cash','');
/*!40000 ALTER TABLE `paiement` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `personne`
--

DROP TABLE IF EXISTS `personne`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `personne` (
  `personne_id` int(11) NOT NULL AUTO_INCREMENT,
  `role` enum('supplier','staff','users','customer','assureur','pos') DEFAULT NULL,
  `photo` text,
  `nom_complet` varchar(100) DEFAULT NULL,
  `genre` varchar(15) DEFAULT NULL,
  `contact` varchar(30) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`personne_id`)
) ENGINE=InnoDB AUTO_INCREMENT=78 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `personne`
--

LOCK TABLES `personne` WRITE;
/*!40000 ALTER TABLE `personne` DISABLE KEYS */;
INSERT INTO `personne` VALUES (1,'users','175445564.png','Mulfam Yaredi','Homme','79756874','mulfamaline@gmail.com'),(2,'pos',NULL,'Comptoir','','-','-'),(69,'supplier',NULL,'Monsieur X','','',''),(71,'customer',NULL,'Brown Mauzo','','',''),(72,'customer',NULL,'Cash','','',''),(73,'assureur',NULL,'Jeanine','','',''),(74,'assureur',NULL,'Marc','','',''),(75,'customer',NULL,'BIZIMANA Alain','','79393833','88888'),(76,'pos',NULL,'Auxil','','-','-'),(77,'users',NULL,'mulfam 2','Homme','-','-');
/*!40000 ALTER TABLE `personne` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `insert_supplier` AFTER INSERT ON `personne`
 FOR EACH ROW BEGIN
DECLARE actu_save int;
DECLARE last_save int;

if NEW.role = "supplier" THEN
insert into supplier (personne_id, supplier_name) values (NEW.personne_id, NEW.nom_complet);
END if;

if NEW.role = "customer" THEN
insert into customer (personne_id, customer_name) values (NEW.personne_id, NEW.nom_complet);
END if;

if NEW.role = "assureur" THEN
insert into assureur (personne_id, ass_name) values (NEW.personne_id, NEW.nom_complet);
END if;

if NEW.role = "pos" THEN
insert into pos (personne_id, pos_name) values (NEW.personne_id, NEW.nom_complet);
END if;

SELECT max(acc_id) into last_save from accounts;

  IF last_save is null THEN
  SET actu_save = 1;

  else
  SET actu_save = last_save+1;
  END if;

  INSERT INTO accounts (acc_num, personne_id,created_date) values (actu_save, NEW.personne_id,now());
  
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `after_update_personne` AFTER UPDATE ON `personne` FOR EACH ROW BEGIN
DECLARE actu_save int;
DECLARE last_save int;

if NEW.role = "supplier" THEN
update supplier  set supplier_name=NEW.nom_complet WHERE personne_id=NEW.personne_id;
END if;

if NEW.role = "customer" THEN
update customer  set customer_name=NEW.nom_complet WHERE personne_id=NEW.personne_id;
END if;

if NEW.role = "pos" THEN
update pos  set pos_name=NEW.nom_complet WHERE personne_id=NEW.personne_id;
END if;

if NEW.role = "assureur" THEN
update assureur  set ass_name=NEW.nom_complet WHERE personne_id=NEW.personne_id;
END if;

if NEW.role = "users" THEN
update users  set username=NEW.nom_complet WHERE personne_id=NEW.personne_id;
END if;



END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `pos`
--

DROP TABLE IF EXISTS `pos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pos` (
  `pos_id` int(11) NOT NULL AUTO_INCREMENT,
  `pos_name` varchar(30) NOT NULL,
  `personne_id` int(11) NOT NULL,
  `actif` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`pos_id`),
  KEY `personne_id` (`personne_id`),
  CONSTRAINT `pos_ibfk_1` FOREIGN KEY (`personne_id`) REFERENCES `personne` (`personne_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pos`
--

LOCK TABLES `pos` WRITE;
/*!40000 ALTER TABLE `pos` DISABLE KEYS */;
INSERT INTO `pos` VALUES (1,'Comptoir',2,1),(2,'Auxil',76,1);
/*!40000 ALTER TABLE `pos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `price`
--

DROP TABLE IF EXISTS `price`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `price` (
  `price_id` int(11) NOT NULL AUTO_INCREMENT,
  `price` int(11) DEFAULT NULL,
  `supplier_id` int(11) DEFAULT NULL,
  `prod_id` int(11) NOT NULL,
  `start_date` datetime DEFAULT NULL,
  `end_date` datetime DEFAULT NULL,
  `state` int(1) DEFAULT NULL,
  `set_by` int(11) DEFAULT NULL,
  `comment` text,
  PRIMARY KEY (`price_id`),
  KEY `supplier_id` (`supplier_id`),
  KEY `prod_id` (`prod_id`),
  KEY `set_by` (`set_by`),
  CONSTRAINT `price_ibfk_1` FOREIGN KEY (`prod_id`) REFERENCES `products` (`prod_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `price_ibfk_2` FOREIGN KEY (`set_by`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `price`
--

LOCK TABLES `price` WRITE;
/*!40000 ALTER TABLE `price` DISABLE KEYS */;
/*!40000 ALTER TABLE `price` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `products` (
  `prod_id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(11) NOT NULL,
  `prod_name` varchar(45) DEFAULT NULL,
  `prod_price` float NOT NULL DEFAULT '0',
  `prod_state` bit(1) DEFAULT NULL,
  `prod_code` varchar(15) NOT NULL,
  `prod_price_gros` float NOT NULL DEFAULT '0',
  `unt_mes` int(11) NOT NULL,
  `is_sale` varchar(4) NOT NULL DEFAULT 'Oui',
  `is_stock` varchar(4) NOT NULL DEFAULT 'Oui',
  PRIMARY KEY (`prod_id`),
  KEY `category_id` (`category_id`),
  CONSTRAINT `products_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `category` (`category_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products`
--

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` VALUES (1,2,'Primus',4000,'','0001',50000,12,'Oui','Oui'),(2,2,'Amstel',5000,'','0002',50000,12,'Oui','Oui'),(3,1,'Fanta',2000,'','003',20000,24,'Oui','Oui'),(4,2,'RedBull',5000,'','9303',55000,12,'Oui','Oui');
/*!40000 ALTER TABLE `products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `requisition`
--

DROP TABLE IF EXISTS `requisition`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `requisition` (
  `req_id` int(11) NOT NULL AUTO_INCREMENT,
  `req_name` varchar(100) DEFAULT NULL,
  `req_type` varchar(45) DEFAULT NULL,
  `details` varchar(300) DEFAULT NULL,
  `req_date` datetime DEFAULT NULL,
  `amount` int(11) DEFAULT NULL,
  `from_acct` int(11) DEFAULT NULL,
  `doc_id` int(11) NOT NULL,
  PRIMARY KEY (`req_id`),
  KEY `doc_id` (`doc_id`),
  KEY `from_acct` (`from_acct`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `requisition`
--

LOCK TABLES `requisition` WRITE;
/*!40000 ALTER TABLE `requisition` DISABLE KEYS */;
/*!40000 ALTER TABLE `requisition` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sortie_matp`
--

DROP TABLE IF EXISTS `sortie_matp`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sortie_matp` (
  `idsort` int(11) NOT NULL AUTO_INCREMENT,
  `op_id` int(11) NOT NULL,
  `amount` int(11) NOT NULL DEFAULT '0',
  `is_paid` bit(1) NOT NULL,
  `num_sort` varchar(20) NOT NULL,
  `motif` varchar(50) DEFAULT NULL,
  `type_sort` varchar(15) NOT NULL DEFAULT 'Destruction',
  PRIMARY KEY (`idsort`),
  KEY `op_id` (`op_id`),
  CONSTRAINT `sortie_matp_ibfk_1` FOREIGN KEY (`op_id`) REFERENCES `operation` (`op_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sortie_matp`
--

LOCK TABLES `sortie_matp` WRITE;
/*!40000 ALTER TABLE `sortie_matp` DISABLE KEYS */;
INSERT INTO `sortie_matp` VALUES (18,42,0,'\0','1/0918','bouteilles brises','Destruction'),(19,44,0,'\0','19/0918','pour  destruction','Destruction'),(20,48,50000,'\0','20/0918','Transfert des produits','Vente'),(21,49,0,'\0','21/0918','Transfert des produits','Vente'),(22,50,40000,'\0','22/0918','Transfert des produits','Vente'),(23,51,275000,'\0','23/0918','Transfert des produits','Vente'),(24,52,165000,'\0','24/0918','Transfert des produits','Vente');
/*!40000 ALTER TABLE `sortie_matp` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `staff`
--

DROP TABLE IF EXISTS `staff`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `staff` (
  `staff_id` int(11) NOT NULL AUTO_INCREMENT,
  `staff_role` varchar(45) DEFAULT NULL,
  `created_date` varchar(45) DEFAULT NULL,
  `personne_id` int(11) NOT NULL,
  PRIMARY KEY (`staff_id`),
  KEY `personne_id` (`personne_id`),
  CONSTRAINT `staff_ibfk_1` FOREIGN KEY (`personne_id`) REFERENCES `personne` (`personne_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `staff`
--

LOCK TABLES `staff` WRITE;
/*!40000 ALTER TABLE `staff` DISABLE KEYS */;
/*!40000 ALTER TABLE `staff` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `stock`
--

DROP TABLE IF EXISTS `stock`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `stock` (
  `stock_id` int(11) NOT NULL AUTO_INCREMENT,
  `prod_id` int(11) NOT NULL,
  `op_id` int(11) DEFAULT NULL,
  `quantity` float DEFAULT NULL,
  `update_date` datetime DEFAULT NULL,
  `pos_id` int(11) NOT NULL DEFAULT '26',
  `det` bit(1) NOT NULL DEFAULT b'0',
  PRIMARY KEY (`stock_id`),
  KEY `prod_id` (`prod_id`),
  KEY `op_id` (`op_id`),
  CONSTRAINT `stock_ibfk_2` FOREIGN KEY (`prod_id`) REFERENCES `products` (`prod_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `stock`
--

LOCK TABLES `stock` WRITE;
/*!40000 ALTER TABLE `stock` DISABLE KEYS */;
INSERT INTO `stock` VALUES (16,3,53,145,'2018-09-27 10:49:00',2,''),(17,2,53,138,'2018-09-27 10:49:00',2,''),(18,1,53,37,'2018-09-27 10:50:00',2,''),(19,1,49,36,'2018-09-23 07:44:00',76,''),(20,2,48,55,'2018-09-23 07:48:00',76,''),(21,3,50,48,'2018-09-25 10:45:00',76,''),(22,4,52,84,'2018-09-25 02:46:00',2,''),(23,4,52,36,'2018-09-25 02:46:00',76,'');
/*!40000 ALTER TABLE `stock` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `supplier`
--

DROP TABLE IF EXISTS `supplier`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `supplier` (
  `supplier_id` int(11) NOT NULL AUTO_INCREMENT,
  `supplier_name` varchar(45) DEFAULT NULL,
  `personne_id` int(11) NOT NULL,
  `actif` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`supplier_id`),
  KEY `personne_id` (`personne_id`),
  CONSTRAINT `supplier_ibfk_1` FOREIGN KEY (`personne_id`) REFERENCES `personne` (`personne_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `supplier`
--

LOCK TABLES `supplier` WRITE;
/*!40000 ALTER TABLE `supplier` DISABLE KEYS */;
INSERT INTO `supplier` VALUES (29,'Monsieur X',69,1);
/*!40000 ALTER TABLE `supplier` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `table`
--

DROP TABLE IF EXISTS `table`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `table` (
  `table_id` int(11) NOT NULL AUTO_INCREMENT,
  `table_num` varchar(3) NOT NULL,
  `status` bit(1) NOT NULL DEFAULT b'1',
  PRIMARY KEY (`table_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `table`
--

LOCK TABLES `table` WRITE;
/*!40000 ALTER TABLE `table` DISABLE KEYS */;
INSERT INTO `table` VALUES (1,'1',''),(2,'2',''),(3,'3','');
/*!40000 ALTER TABLE `table` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `transactions`
--

DROP TABLE IF EXISTS `transactions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `transactions` (
  `transaction_id` int(11) NOT NULL AUTO_INCREMENT,
  `acc_id` int(11) DEFAULT NULL,
  `transaction_type` enum('versement','paiement_fournisseur','paiement_client','retrait','transfert') DEFAULT NULL,
  `create_date` date DEFAULT NULL,
  `acc_res_id` int(11) DEFAULT NULL,
  `amount` int(11) DEFAULT NULL,
  `reference` varchar(100) DEFAULT NULL,
  `party_type` varchar(45) DEFAULT NULL,
  `party_code` varchar(45) DEFAULT NULL,
  `status` enum('done','canceled') DEFAULT NULL,
  `pre_bal` varchar(11) DEFAULT NULL,
  `bal_after` int(11) DEFAULT NULL,
  PRIMARY KEY (`transaction_id`),
  KEY `acc_id` (`acc_id`),
  KEY `acc_res_id` (`acc_res_id`),
  KEY `acc_id_2` (`acc_id`),
  CONSTRAINT `transactions_ibfk_1` FOREIGN KEY (`acc_id`) REFERENCES `accounts` (`acc_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `transactions`
--

LOCK TABLES `transactions` WRITE;
/*!40000 ALTER TABLE `transactions` DISABLE KEYS */;
INSERT INTO `transactions` VALUES (1,16,'paiement_client','2018-09-20',1,50000,'','Paiement Client','104','done','411168',461168),(2,16,'paiement_client','2018-09-27',1,85000,'','Paiement client','104','done','461168',546168),(3,16,'paiement_client','2018-09-27',1,150000,'','Paiement client','104','done','546168',696168),(4,16,'paiement_client','2018-09-27',1,10000,'','Paiement client','104','done','696168',706168);
/*!40000 ALTER TABLE `transactions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(45) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `actif` bit(1) DEFAULT NULL,
  `personne_id` int(11) DEFAULT NULL,
  `type_user` varchar(30) DEFAULT NULL,
  `cash` bit(1) NOT NULL DEFAULT b'0',
  PRIMARY KEY (`user_id`),
  KEY `personne_id` (`personne_id`),
  CONSTRAINT `users_ibfk_1` FOREIGN KEY (`personne_id`) REFERENCES `personne` (`personne_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'mulfam','$2y$10$s67kjMUnOMy60UZYELr8f.jUujLlqcV4Le4K/WDwfEVeH7QpGsIpm','',1,'2',''),(2,'mulfam_2','$2y$10$pmAjp219AsgKUKdwJ68LpeQCR8yi4NdWKtSJvIAvXPFUtT3y431Yq','',77,'76','\0');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vente`
--

DROP TABLE IF EXISTS `vente`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `vente` (
  `idvente` int(11) NOT NULL AUTO_INCREMENT,
  `amount` int(11) DEFAULT '0',
  `op_id` int(11) NOT NULL,
  `ass_id` int(11) DEFAULT NULL,
  `is_paid` bit(1) DEFAULT NULL,
  `num_vente` varchar(15) DEFAULT NULL,
  `red` float NOT NULL DEFAULT '0',
  `tva` tinyint(4) NOT NULL DEFAULT '0',
  `caisse_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`idvente`),
  KEY `op_id` (`op_id`),
  CONSTRAINT `vente_ibfk_1` FOREIGN KEY (`op_id`) REFERENCES `operation` (`op_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vente`
--

LOCK TABLES `vente` WRITE;
/*!40000 ALTER TABLE `vente` DISABLE KEYS */;
INSERT INTO `vente` VALUES (15,300000,41,105,'','1/Jea11',15000,1,NULL),(16,30000,46,105,'\0','1/Jea20',0,0,NULL),(17,4000,47,106,'\0','1/Mulf/23',0,0,NULL),(18,98000,53,105,'\0','1/mulf/27',0,0,NULL);
/*!40000 ALTER TABLE `vente` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-10-02  8:05:23
