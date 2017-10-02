/*
Navicat MySQL Data Transfer

Source Server         : LOCALHOST
Source Server Version : 50709
Source Host           : localhost:3306
Source Database       : virtual

Target Server Type    : MYSQL
Target Server Version : 50709
File Encoding         : 65001

Date: 2017-10-01 21:29:06
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for clientes_accesos
-- ----------------------------
DROP TABLE IF EXISTS `clientes_accesos`;
CREATE TABLE `clientes_accesos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) DEFAULT NULL,
  `descripcion` text,
  `key` varchar(100) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `ip` varchar(100) DEFAULT NULL,
  `estado` int(11) NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `persona_id_created_at` int(11) NOT NULL,
  `persona_id_updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of clientes_accesos
-- ----------------------------
INSERT INTO `clientes_accesos` VALUES ('2', 'Software 1', 'Cliente de prueba rest full', '173449ebbda62b67a0d9bc645e6dbba7', 'www.informaniaticos.com', '192.168.1.100', '1', '2017-09-30 12:56:47', null, '1', null);
