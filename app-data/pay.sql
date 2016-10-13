/*
SQLyog Ultimate v11.11 (64 bit)
MySQL - 5.6.28-76.1-log : Database - linosys_roughsheet
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
/*Table structure for table `rs_paygateway` */

DROP TABLE IF EXISTS `rs_paygateway`;

CREATE TABLE `rs_paygateway` (
  `id` int(7) NOT NULL AUTO_INCREMENT,
  `key_id` varchar(200) DEFAULT NULL,
  `key_secret` varchar(200) DEFAULT NULL,
  `amount` decimal(10,2) DEFAULT '0.00',
  `name` varchar(200) DEFAULT NULL,
  `description` text,
  `image` text,
  `status` enum('Active','Deactive') DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `rs_paygateway` */

insert  into `rs_paygateway`(`id`,`key_id`,`key_secret`,`amount`,`name`,`description`,`image`,`status`) values ('1','rzp_test_XLqUhwBcClrk7z','SzqFCBZvMJtUFNYxU6BeMD6O','999.00','RoughSheet','Registration Fees','logo_beta.png','Deactive'),('2','rzp_test_oANVjwzcmyuz47','OCOQeM3HZw21ca61yPeILmoh','100.00','RoughSheet','Registration Fees','logo_beta.png','Active'),('3','rzp_live_QiMcv6KyNM8b2q','kRVmNC4p71GegLwA3pWeFRUr','999.00','Roughsheet','Roughsheet Registration Fees','logo_beta.png','Deactive');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
