/*
SQLyog Ultimate v8.55 
MySQL - 5.5.8-log : Database - duosystem
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`duosystem` /*!40100 DEFAULT CHARACTER SET utf8 */;

USE `duosystem`;

/*Table structure for table `atividade_status` */

DROP TABLE IF EXISTS `atividade_status`;

CREATE TABLE `atividade_status` (
  `id_status` INT(11) NOT NULL AUTO_INCREMENT,
  `desc_status` VARCHAR(100) DEFAULT NULL,
  PRIMARY KEY (`id_status`)
) ENGINE=INNODB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

/*Data for the table `atividade_status` */

INSERT  INTO `atividade_status`(`id_status`,`desc_status`) VALUES (1,'Pendente'),(2,'Em Desenvolvimento'),(3,'Em Teste'),(4,'Concluido');
/*Table structure for table `login` */



DROP TABLE IF EXISTS `login`;



CREATE TABLE `login` (
  `id_login` INT(11) NOT NULL AUTO_INCREMENT,
  `login` VARCHAR(150) NOT NULL,
  `senha` VARCHAR(200) DEFAULT NULL,
  `nivel` TINYINT(4) DEFAULT NULL,
  `email` VARCHAR(255) DEFAULT NULL,
  `COD_FUNC` INT(11) DEFAULT NULL,
  PRIMARY KEY (`id_login`)
) ENGINE=INNODB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8;



/*Data for the table `login` */



INSERT  INTO `login`(`id_login`,`login`,`senha`,`nivel`,`email`,`COD_FUNC`) VALUES (1,'alex_teste','e10adc3949ba59abbe56e057f20f883e',1,'alexjimenez@sol.com.br',2),(2,'teste','89794b621a313bb59eed0d9f0f4e8205',1,'',7),(3,'funcionario1','e10adc3949ba59abbe56e057f20f883e',2,'',5),(6,'linus','e10adc3949ba59abbe56e057f20f883e',2,'',13),(7,'ltv','e10adc3949ba59abbe56e057f20f883e',2,'',13),(8,'ltva','e10adc3949ba59abbe56e057f20f883e',2,'',13);




/*Table structure for table `atividades` */

DROP TABLE IF EXISTS `atividades`;

CREATE TABLE `atividades` (
  `id_atv` INT(11) NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(255) NOT NULL,
  `descricao` TEXT NOT NULL,
  `data_inicio` DATE NOT NULL,
  `data_fim` DATE DEFAULT NULL,
  `status` INT(11) DEFAULT NULL,
  `situacao` TINYINT(4) DEFAULT NULL,
  `cod_login` INT(11) DEFAULT NULL,
  PRIMARY KEY (`id_atv`),
  KEY `index_status` (`status`),
  KEY `FK_atividades2` (`cod_login`),
  CONSTRAINT `FK_atividades2` FOREIGN KEY (`cod_login`) REFERENCES `login` (`id_login`),
  CONSTRAINT `FK_atividades` FOREIGN KEY (`status`) REFERENCES `atividade_status` (`id_status`)
) ENGINE=INNODB AUTO_INCREMENT=45 DEFAULT CHARSET=utf8;

/*Data for the table `atividades` */

INSERT  INTO `atividades`(`id_atv`,`nome`,`descricao`,`data_inicio`,`data_fim`,`status`,`situacao`,`cod_login`) VALUES (1,'Atividade1','Analise do Sistema','2017-05-25','2017-06-30',1,1,1),(2,'Atividade2bcd','Projeto do Sistema','2017-05-26','2017-06-27',1,1,1),(3,'Atividade 4','Desenvolver Sistema','2017-05-26',NULL,2,1,1),(4,'Atividade 51','Desenvolvimento do Sistema','2017-05-26',NULL,4,0,1),(5,'Atividade 6','Depuração do Sistema','2017-05-27',NULL,2,1,1),(39,'aaaaa','sssss','2017-05-02','2017-05-10',4,0,2),(40,'ATIVIDADE 77','DESCRICAO ATIVIDADE 77','2017-05-24','2017-05-31',1,1,1),(41,'ATIVIDADE 22','ATIVIDADE 22 DESC','2017-05-08','2017-06-06',1,1,1),(42,'ATIVIDADE 11','DESC ATIVIDADE11','2017-05-08','2017-05-25',3,1,2),(43,'ATIVIDADE 443','DESC ATIVIDADE334','2017-05-01','2017-05-31',2,1,1),(44,'Atividade454','DESC ATIVIDADE DD','2017-05-08','2017-05-31',2,1,1);


/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
