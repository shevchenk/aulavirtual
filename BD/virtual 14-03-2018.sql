/*
Navicat MySQL Data Transfer

Source Server         : local
Source Server Version : 50709
Source Host           : 127.0.0.1:3306
Source Database       : virtual

Target Server Type    : MYSQL
Target Server Version : 50709
File Encoding         : 65001

Date: 2018-03-14 16:42:29
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
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of clientes_accesos
-- ----------------------------
INSERT INTO `clientes_accesos` VALUES ('1', 'Software 1', 'Cliente de prueba rest full', '173449ebbda62b67a0d9bc645e6dbba7', 'http://localhost/Cliente/', '::1', '1', '2017-09-30 12:56:47', null, '1', null);
INSERT INTO `clientes_accesos` VALUES ('3', 'SIGA', 'CLinete API Siga', '173449ebbda62b67a0d9bc645e6dbba7', 'http://siga.com.pe', '192.123.123.12', '0', '2017-09-30 12:56:47', null, '0', null);

-- ----------------------------
-- Table structure for clientes_accesos_links
-- ----------------------------
DROP TABLE IF EXISTS `clientes_accesos_links`;
CREATE TABLE `clientes_accesos_links` (
  `cliente_acceso_id` int(11) NOT NULL,
  `url` varchar(500) DEFAULT NULL,
  `descripcion` varchar(500) DEFAULT NULL,
  `tipo` int(2) DEFAULT NULL,
  `estado` int(11) NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `persona_id_created_at` int(11) NOT NULL,
  `persona_id_updated_at` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of clientes_accesos_links
-- ----------------------------
INSERT INTO `clientes_accesos_links` VALUES ('1', 'http://localhost/Cliente/CCurso.php?action=key', 'Primer Curl para solicitar el Key del Cliente.', '1', '1', '2017-10-31 16:01:17', null, '1', null);
INSERT INTO `clientes_accesos_links` VALUES ('1', 'http://localhost/Cliente/CCurso.php?key=pkey&dni=pdni', 'Segundo Curl el cual valida que el Key y el DNI del cliente sean validos.', '2', '1', '2017-10-31 16:15:00', null, '1', null);
INSERT INTO `clientes_accesos_links` VALUES ('1', 'http://localhost/Cliente/Evaluacion.php', 'Api que debe enviar el Cliente con los datos a registrar', '3', '1', '2017-10-31 16:21:22', null, '1', null);
INSERT INTO `clientes_accesos_links` VALUES ('1', 'http://localhost/Cliente/Docente.php', 'Api del Docente que el Cliente debe enviar', '4', '1', '2017-11-13 12:19:33', null, '1', null);
INSERT INTO `clientes_accesos_links` VALUES ('1', 'http://localhost/Cliente/Alumno.php', 'Api del Alumno que el Cliente debe enviar', '5', '1', '2017-11-13 16:52:20', null, '1', null);
INSERT INTO `clientes_accesos_links` VALUES ('1', 'http://localhost/Cliente/Master.php', 'Api para que Master consuma todas las programaciones', '6', '1', '2017-11-14 12:25:13', null, '1', null);
INSERT INTO `clientes_accesos_links` VALUES ('1', 'http://localhost/Cliente/Retorno.php', 'Retorna Ids Externos al Cliente', '7', '1', '2017-11-17 10:05:18', null, '1', null);
INSERT INTO `clientes_accesos_links` VALUES ('1', 'http://localhost/Cliente/Curso.php', 'Api para que Master consuma todos los curso', '8', '1', '2017-11-20 11:57:28', null, '1', null);
INSERT INTO `clientes_accesos_links` VALUES ('1', 'http://localhost/Cliente/Tipo_Evaluacion.php', 'Api para que Master consuma los tipo de evaluaciones ', '9', '1', '2017-12-07 10:53:10', null, '1', null);
INSERT INTO `clientes_accesos_links` VALUES ('1', 'http://localhost/Cliente/nota.php', 'Api para retornar la nota de una evaluación', '10', '1', '2018-01-09 15:20:35', null, '1', null);
INSERT INTO `clientes_accesos_links` VALUES ('1', 'http://localhost/Cliente/Tipo_Evaluacion_alumno.php', 'Api para Obtener los tipos de evaluacion por Alumno', '11', '1', '2018-01-09 15:21:15', null, '1', null);
INSERT INTO `clientes_accesos_links` VALUES ('1', 'http://localhost/Cliente/Tipo_Evaluacion_Balotario.php', 'Api para Obtener los tipo de evaluación por programación Unica', '12', '1', '2018-01-11 11:06:46', null, '1', null);

-- ----------------------------
-- Table structure for clientes_cursos
-- ----------------------------
DROP TABLE IF EXISTS `clientes_cursos`;
CREATE TABLE `clientes_cursos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `curso` varchar(150) NOT NULL,
  `estado` int(11) NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `persona_id_created_at` int(11) NOT NULL,
  `persona_id_updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of clientes_cursos
-- ----------------------------
INSERT INTO `clientes_cursos` VALUES ('1', 'Curso prueba', '1', '2017-10-25 15:05:50', null, '1', null);

-- ----------------------------
-- Table structure for menus
-- ----------------------------
DROP TABLE IF EXISTS `menus`;
CREATE TABLE `menus` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `menu` varchar(100) NOT NULL,
  `class_icono` varchar(50) DEFAULT NULL,
  `estado` int(11) NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `persona_id_created_at` int(11) NOT NULL,
  `persona_id_updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of menus
-- ----------------------------
INSERT INTO `menus` VALUES ('1', 'Mantenimiento', 'fa fa-cogs', '1', '2017-05-26 18:56:58', null, '1', null);
INSERT INTO `menus` VALUES ('2', 'Mi aula', 'fa fa-institution', '1', '2017-10-24 16:32:41', null, '1', null);

-- ----------------------------
-- Table structure for opciones
-- ----------------------------
DROP TABLE IF EXISTS `opciones`;
CREATE TABLE `opciones` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `menu_id` int(11) NOT NULL,
  `opcion` varchar(100) NOT NULL,
  `ruta` varchar(100) NOT NULL,
  `class_icono` varchar(50) DEFAULT NULL,
  `estado` int(11) NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `persona_id_created_at` int(11) NOT NULL,
  `persona_id_updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `op_menu_id_idx` (`menu_id`) USING BTREE,
  CONSTRAINT `opciones_ibfk_1` FOREIGN KEY (`menu_id`) REFERENCES `menus` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=53 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of opciones
-- ----------------------------
INSERT INTO `opciones` VALUES ('1', '1', 'Tipo de Respuesta', 'mantenimiento.tiporespuesta.tiporespuesta', 'fa fa-sitemap', '1', '2017-05-26 19:00:25', null, '1', null);
INSERT INTO `opciones` VALUES ('2', '1', 'Tipo de Evaluación', 'mantenimiento.evaluacion.tipoevaluacion', 'fa fa-sitemap', '1', '2017-05-26 19:01:08', null, '1', null);
INSERT INTO `opciones` VALUES ('3', '1', 'Cursos', 'mantenimiento.curso.curso', 'fa fa-sitemap', '1', '2017-05-26 19:02:18', null, '1', null);
INSERT INTO `opciones` VALUES ('4', '2', 'M. Preguntas de Curso', 'proceso.master.preguntacurso.preguntacurso', 'fa fa-check-square-o fa-lg', '1', '2017-05-26 19:02:49', null, '1', null);
INSERT INTO `opciones` VALUES ('5', '2', 'Generar Balotario', 'proceso.master.balotario.balotario', 'fa fa-check-square-o fa-lg', '1', '2017-05-26 19:03:08', null, '1', null);
INSERT INTO `opciones` VALUES ('6', '2', 'Generar Balotario', 'proceso.docente.balotario.balotario', 'fa fa-check-square-o fa-lg', '1', '2017-05-26 19:03:08', null, '1', null);
INSERT INTO `opciones` VALUES ('41', '1', 'Preguntas', 'mantenimiento.pregunta.pregunta', 'fa fa-check-square-o fa-lg', '0', '2017-09-24 19:44:02', null, '1', null);
INSERT INTO `opciones` VALUES ('42', '1', 'Respuestas', 'mantenimiento.respuesta.respuesta', 'fa fa-check-square-o fa-lg', '0', '2017-09-25 08:51:03', null, '1', null);
INSERT INTO `opciones` VALUES ('43', '2', 'Evaluacion', 'proceso.alumno.evaluacion.evaluacion', 'fa fa-check-square-o fa-lg', '1', '2017-10-24 16:34:06', null, '1', null);
INSERT INTO `opciones` VALUES ('44', '2', 'Gestor de Contenidos', 'proceso.alumno.gestor.gestor', 'fa fa-check-square-o fa-lg', '1', '2017-10-24 16:34:06', null, '1', null);
INSERT INTO `opciones` VALUES ('45', '2', 'Notas', 'proceso.alumno.notas.notas', 'fa fa-check-square-o fa-lg', '1', '2017-10-24 16:34:06', null, '1', null);
INSERT INTO `opciones` VALUES ('46', '2', 'Evaluacion', 'proceso.docente.evaluacion.evaluacion', 'fa fa-check-square-o fa-lg', '0', '2017-11-08 11:15:15', null, '1', null);
INSERT INTO `opciones` VALUES ('47', '2', 'Gestor de Contenidos', 'proceso.docente.gestor.gestor', 'fa fa-check-square-o fa-lg', '1', '2017-11-08 11:16:22', null, '1', null);
INSERT INTO `opciones` VALUES ('48', '2', 'Gestor de Contenidos', 'proceso.master.gestor.gestor', 'fa fa-check-square-o fa-lg', '1', '2017-11-14 11:29:47', null, '1', null);
INSERT INTO `opciones` VALUES ('49', '1', 'Unidad de Contenido', 'mantenimiento.unidadcontenido.unidadcontenido', 'fa fa-sitemap', '1', '2017-12-07 22:46:47', null, '1', null);
INSERT INTO `opciones` VALUES ('50', '2', 'Ver Balotario', 'proceso.alumno.balotario.balotario', 'fa fa-check-square-o fa-lg', '1', '2017-05-26 19:03:08', '2017-12-26 09:49:59', '1', null);
INSERT INTO `opciones` VALUES ('51', '2', 'Reprogramación', 'proceso.master.reprogramacion.reprogramacion', 'fa fa-check-square-o fa-lg', '1', '2018-01-13 21:51:11', null, '1', null);
INSERT INTO `opciones` VALUES ('52', '2', 'Auditoria de Reprogramación', 'proceso.master.auditoria.gestor', 'fa fa-check-square-o fa-lg', '1', '2018-01-31 15:46:34', null, '1', null);

-- ----------------------------
-- Table structure for personas_privilegios_sucursales
-- ----------------------------
DROP TABLE IF EXISTS `personas_privilegios_sucursales`;
CREATE TABLE `personas_privilegios_sucursales` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `persona_id` int(11) NOT NULL,
  `privilegio_id` int(11) NOT NULL,
  `sucursal_id` int(11) DEFAULT NULL,
  `fecha_ingreso` date DEFAULT NULL,
  `fecha_salida` date DEFAULT NULL,
  `estado` int(11) NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `persona_id_created_at` int(11) NOT NULL,
  `persona_id_updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `po_privilegio_id_idx` (`privilegio_id`) USING BTREE,
  KEY `po_persona_id_idx` (`persona_id`) USING BTREE,
  KEY `po_sucursal_id_idx` (`sucursal_id`) USING BTREE,
  CONSTRAINT `personas_privilegios_sucursales_ibfk_1` FOREIGN KEY (`privilegio_id`) REFERENCES `privilegios` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `personas_privilegios_sucursales_ibfk_2` FOREIGN KEY (`persona_id`) REFERENCES `v_personas` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of personas_privilegios_sucursales
-- ----------------------------
INSERT INTO `personas_privilegios_sucursales` VALUES ('1', '1', '1', null, null, null, '1', '2017-05-26 19:06:06', null, '1', null);
INSERT INTO `personas_privilegios_sucursales` VALUES ('7', '11', '3', null, null, null, '1', '2017-10-31 12:53:13', null, '1', null);
INSERT INTO `personas_privilegios_sucursales` VALUES ('8', '12', '3', null, null, null, '1', '2017-10-31 13:01:07', null, '1', null);
INSERT INTO `personas_privilegios_sucursales` VALUES ('9', '15', '3', null, null, null, '1', '2017-10-31 16:18:23', null, '1', null);
INSERT INTO `personas_privilegios_sucursales` VALUES ('10', '12', '2', null, null, null, '0', '2017-11-08 09:44:17', null, '1', null);
INSERT INTO `personas_privilegios_sucursales` VALUES ('11', '14', '3', null, null, null, '0', '2017-11-08 09:45:10', null, '1', null);
INSERT INTO `personas_privilegios_sucursales` VALUES ('12', '14', '2', null, null, null, '1', '2017-11-08 10:53:08', null, '1', null);
INSERT INTO `personas_privilegios_sucursales` VALUES ('13', '16', '3', null, null, null, '1', '2017-11-13 00:45:39', null, '1', null);
INSERT INTO `personas_privilegios_sucursales` VALUES ('14', '17', '3', null, null, null, '1', '2017-11-13 00:46:38', null, '1', null);
INSERT INTO `personas_privilegios_sucursales` VALUES ('15', '18', '3', null, null, null, '1', '2017-11-13 12:51:10', null, '1', null);
INSERT INTO `personas_privilegios_sucursales` VALUES ('16', '19', '3', null, null, null, '1', '2017-11-13 12:58:30', null, '1', null);
INSERT INTO `personas_privilegios_sucursales` VALUES ('17', '20', '3', null, null, null, '1', '2017-11-13 12:58:30', null, '1', null);
INSERT INTO `personas_privilegios_sucursales` VALUES ('18', '27', '2', null, null, null, '1', '2017-12-19 10:52:03', null, '1', null);
INSERT INTO `personas_privilegios_sucursales` VALUES ('19', '33', '3', null, null, null, '1', '2017-12-19 18:24:51', null, '1', null);
INSERT INTO `personas_privilegios_sucursales` VALUES ('20', '34', '3', null, null, null, '1', '2017-12-19 18:25:11', null, '1', null);

-- ----------------------------
-- Table structure for privilegios
-- ----------------------------
DROP TABLE IF EXISTS `privilegios`;
CREATE TABLE `privilegios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `privilegio` varchar(100) NOT NULL,
  `estado` int(11) NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `persona_id_created_at` int(11) NOT NULL,
  `persona_id_updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of privilegios
-- ----------------------------
INSERT INTO `privilegios` VALUES ('1', 'Admin', '1', '2017-05-26 19:04:59', null, '1', null);
INSERT INTO `privilegios` VALUES ('2', 'Profesor', '1', '2017-10-05 11:04:25', null, '1', null);
INSERT INTO `privilegios` VALUES ('3', 'Alumno', '1', '2017-10-05 11:04:43', null, '1', null);

-- ----------------------------
-- Table structure for privilegios_clientes
-- ----------------------------
DROP TABLE IF EXISTS `privilegios_clientes`;
CREATE TABLE `privilegios_clientes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_priv_interno` int(11) DEFAULT NULL,
  `descripcion` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of privilegios_clientes
-- ----------------------------
INSERT INTO `privilegios_clientes` VALUES ('1', '1', 'ad');
INSERT INTO `privilegios_clientes` VALUES ('2', '2', 'pr');
INSERT INTO `privilegios_clientes` VALUES ('3', '3', 'al');

-- ----------------------------
-- Table structure for privilegios_opciones
-- ----------------------------
DROP TABLE IF EXISTS `privilegios_opciones`;
CREATE TABLE `privilegios_opciones` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `privilegio_id` int(11) NOT NULL,
  `opcion_id` int(11) NOT NULL,
  `estado` int(11) NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `persona_id_created_at` int(11) NOT NULL,
  `persona_id_updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `po_privilegio_id_idx` (`privilegio_id`) USING BTREE,
  KEY `po_opcion_id_idx` (`opcion_id`) USING BTREE,
  CONSTRAINT `privilegios_opciones_ibfk_1` FOREIGN KEY (`opcion_id`) REFERENCES `opciones` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `privilegios_opciones_ibfk_2` FOREIGN KEY (`privilegio_id`) REFERENCES `privilegios` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=69 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of privilegios_opciones
-- ----------------------------
INSERT INTO `privilegios_opciones` VALUES ('1', '1', '1', '1', '2017-05-26 19:05:13', null, '1', null);
INSERT INTO `privilegios_opciones` VALUES ('2', '1', '2', '1', '2017-05-26 19:05:13', null, '1', null);
INSERT INTO `privilegios_opciones` VALUES ('3', '1', '3', '1', '2017-05-26 19:05:13', null, '1', null);
INSERT INTO `privilegios_opciones` VALUES ('4', '1', '4', '1', '2017-05-26 19:05:13', null, '1', null);
INSERT INTO `privilegios_opciones` VALUES ('5', '1', '5', '1', '2017-05-26 19:05:13', null, '1', null);
INSERT INTO `privilegios_opciones` VALUES ('6', '2', '6', '1', '2017-05-26 19:05:13', null, '1', null);
INSERT INTO `privilegios_opciones` VALUES ('56', '1', '48', '1', '2017-09-24 19:45:22', null, '1', null);
INSERT INTO `privilegios_opciones` VALUES ('57', '1', '42', '1', '2017-09-25 08:51:25', null, '1', null);
INSERT INTO `privilegios_opciones` VALUES ('58', '2', '1', '0', '2017-10-06 11:30:31', null, '1', null);
INSERT INTO `privilegios_opciones` VALUES ('59', '2', '3', '0', '2017-10-06 11:30:43', null, '1', null);
INSERT INTO `privilegios_opciones` VALUES ('60', '3', '43', '1', '2017-10-24 16:37:05', null, '1', null);
INSERT INTO `privilegios_opciones` VALUES ('61', '3', '44', '1', '2017-10-24 16:37:05', null, '1', null);
INSERT INTO `privilegios_opciones` VALUES ('62', '3', '45', '0', '2017-10-24 16:37:05', null, '1', null);
INSERT INTO `privilegios_opciones` VALUES ('63', '2', '46', '1', '2017-11-08 11:17:16', null, '1', null);
INSERT INTO `privilegios_opciones` VALUES ('64', '2', '47', '1', '2017-11-08 11:17:27', null, '1', null);
INSERT INTO `privilegios_opciones` VALUES ('65', '3', '50', '1', '2017-12-06 10:17:08', null, '1', null);
INSERT INTO `privilegios_opciones` VALUES ('66', '1', '49', '1', '2017-12-07 22:47:20', null, '1', null);
INSERT INTO `privilegios_opciones` VALUES ('67', '1', '51', '1', '2018-01-13 21:51:56', null, '1', null);
INSERT INTO `privilegios_opciones` VALUES ('68', '1', '52', '1', '2018-01-31 15:47:31', null, '1', null);

-- ----------------------------
-- Table structure for v_balotarios
-- ----------------------------
DROP TABLE IF EXISTS `v_balotarios`;
CREATE TABLE `v_balotarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `programacion_unica_id` int(11) NOT NULL,
  `tipo_evaluacion_id` int(11) NOT NULL,
  `unidad_contenido_id` varchar(50) DEFAULT NULL,
  `cantidad_maxima` int(11) NOT NULL DEFAULT '1' COMMENT 'Cantidad maxima de registros para realizar el chocolateo',
  `cantidad_pregunta` int(11) NOT NULL DEFAULT '1' COMMENT 'Cantidad de preguntas que generará el examen',
  `estado` int(11) NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `persona_id_created_at` int(11) NOT NULL,
  `persona_id_updated_at` int(11) DEFAULT NULL,
  `modo` int(11) DEFAULT '0' COMMENT 'Modo Vista: 1 |Modo Generar: 0',
  PRIMARY KEY (`id`),
  KEY `b_programacion_unica_id_idx` (`programacion_unica_id`) USING BTREE,
  KEY `b_tipo_evaluacion_id_idx` (`tipo_evaluacion_id`) USING BTREE,
  CONSTRAINT `v_balotarios_ibfk_1` FOREIGN KEY (`programacion_unica_id`) REFERENCES `v_programaciones_unicas` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `v_balotarios_ibfk_2` FOREIGN KEY (`tipo_evaluacion_id`) REFERENCES `v_tipos_evaluaciones` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of v_balotarios
-- ----------------------------
INSERT INTO `v_balotarios` VALUES ('1', '4', '4', '3,4', '7', '10', '1', '2017-12-26 10:15:29', '2018-01-23 09:23:59', '1', '2', '1');
INSERT INTO `v_balotarios` VALUES ('2', '4', '3', '3', '4', '4', '1', '2017-12-27 09:09:35', '2018-01-23 09:46:41', '1', '2', '1');
INSERT INTO `v_balotarios` VALUES ('3', '5', '4', '2,3', '4', '4', '1', '2018-01-18 16:47:40', '2018-01-19 20:56:06', '1', '2', '0');
INSERT INTO `v_balotarios` VALUES ('4', '5', '3', null, '0', '0', '1', '2018-01-18 16:47:40', '2018-01-18 16:47:50', '1', '2', '0');
INSERT INTO `v_balotarios` VALUES ('5', '9', '4', null, '0', '0', '1', '2018-01-19 09:56:52', '2018-01-19 10:02:37', '1', '2', '0');
INSERT INTO `v_balotarios` VALUES ('6', '9', '3', null, '0', '0', '1', '2018-01-19 09:56:52', '2018-01-19 10:02:37', '1', '2', '0');
INSERT INTO `v_balotarios` VALUES ('7', '6', '4', null, '0', '0', '1', '2018-01-19 20:05:27', '2018-01-20 13:25:50', '1', '2', '0');
INSERT INTO `v_balotarios` VALUES ('8', '6', '3', null, '0', '0', '1', '2018-01-19 20:05:27', '2018-01-20 13:25:51', '1', '2', '0');
INSERT INTO `v_balotarios` VALUES ('9', '7', '4', null, '0', '0', '1', '2018-01-20 13:25:50', '2018-01-20 13:25:50', '1', null, '0');
INSERT INTO `v_balotarios` VALUES ('10', '7', '3', null, '0', '0', '1', '2018-01-20 13:25:50', '2018-01-20 13:25:50', '1', null, '0');
INSERT INTO `v_balotarios` VALUES ('11', '8', '4', null, '0', '0', '1', '2018-03-09 17:05:14', '2018-03-09 17:05:14', '1', null, '0');
INSERT INTO `v_balotarios` VALUES ('12', '8', '3', null, '0', '0', '1', '2018-03-09 17:05:14', '2018-03-09 17:05:14', '1', null, '0');

-- ----------------------------
-- Table structure for v_balotarios_preguntas
-- ----------------------------
DROP TABLE IF EXISTS `v_balotarios_preguntas`;
CREATE TABLE `v_balotarios_preguntas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `balotario_id` int(11) NOT NULL,
  `pregunta_id` int(11) NOT NULL,
  `estado` int(11) NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `persona_id_created_at` int(11) NOT NULL,
  `persona_id_updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `bp_balotario_id_idx` (`balotario_id`) USING BTREE,
  KEY `bp_pregunta_id_idx` (`pregunta_id`) USING BTREE,
  CONSTRAINT `v_balotarios_preguntas_ibfk_1` FOREIGN KEY (`balotario_id`) REFERENCES `v_balotarios` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `v_balotarios_preguntas_ibfk_2` FOREIGN KEY (`pregunta_id`) REFERENCES `v_preguntas` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=72 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of v_balotarios_preguntas
-- ----------------------------
INSERT INTO `v_balotarios_preguntas` VALUES ('61', '1', '9', '1', '2018-01-22 15:15:26', '2018-01-22 15:15:26', '1', null);
INSERT INTO `v_balotarios_preguntas` VALUES ('62', '1', '8', '1', '2018-01-22 15:15:26', '2018-01-22 15:15:26', '1', null);
INSERT INTO `v_balotarios_preguntas` VALUES ('63', '1', '11', '1', '2018-01-22 15:15:26', '2018-01-22 15:15:26', '1', null);
INSERT INTO `v_balotarios_preguntas` VALUES ('64', '1', '10', '1', '2018-01-22 15:15:26', '2018-01-22 15:15:26', '1', null);
INSERT INTO `v_balotarios_preguntas` VALUES ('65', '1', '6', '1', '2018-01-22 15:15:26', '2018-01-22 15:15:26', '1', null);
INSERT INTO `v_balotarios_preguntas` VALUES ('66', '1', '7', '1', '2018-01-22 15:15:26', '2018-01-22 15:15:26', '1', null);
INSERT INTO `v_balotarios_preguntas` VALUES ('67', '1', '5', '1', '2018-01-22 15:15:26', '2018-01-22 15:15:26', '1', null);
INSERT INTO `v_balotarios_preguntas` VALUES ('68', '2', '11', '1', '2018-01-22 15:15:30', '2018-01-22 15:15:30', '1', null);
INSERT INTO `v_balotarios_preguntas` VALUES ('69', '2', '9', '1', '2018-01-22 15:15:30', '2018-01-22 15:15:30', '1', null);
INSERT INTO `v_balotarios_preguntas` VALUES ('70', '2', '10', '1', '2018-01-22 15:15:30', '2018-01-22 15:15:30', '1', null);
INSERT INTO `v_balotarios_preguntas` VALUES ('71', '2', '8', '1', '2018-01-22 15:15:30', '2018-01-22 15:15:30', '1', null);

-- ----------------------------
-- Table structure for v_condicionales
-- ----------------------------
DROP TABLE IF EXISTS `v_condicionales`;
CREATE TABLE `v_condicionales` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `condicional` varchar(150) NOT NULL DEFAULT '',
  `valor` varchar(2) NOT NULL DEFAULT '',
  `estado` int(11) NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `persona_id_created_at` int(11) NOT NULL,
  `persona_id_updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of v_condicionales
-- ----------------------------
INSERT INTO `v_condicionales` VALUES ('1', 'Mayor', '>', '1', '2017-01-01 00:00:00', null, '1', null);
INSERT INTO `v_condicionales` VALUES ('2', 'Menor', '<', '1', '2017-01-01 00:00:00', null, '1', null);
INSERT INTO `v_condicionales` VALUES ('3', 'Igual', '=', '1', '2017-01-01 00:00:00', null, '1', null);
INSERT INTO `v_condicionales` VALUES ('4', 'Mayor Igual', '>=', '1', '2017-01-01 00:00:00', null, '1', null);
INSERT INTO `v_condicionales` VALUES ('5', 'Menor Igual', '<=', '1', '2017-01-01 00:00:00', null, '1', null);

-- ----------------------------
-- Table structure for v_contenidos
-- ----------------------------
DROP TABLE IF EXISTS `v_contenidos`;
CREATE TABLE `v_contenidos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `curso_id` int(11) NOT NULL,
  `programacion_unica_id` int(11) DEFAULT NULL,
  `unidad_contenido_id` int(11) DEFAULT NULL,
  `titulo_contenido` varchar(200) DEFAULT NULL,
  `contenido` varchar(500) NOT NULL DEFAULT '',
  `foto` varchar(200) DEFAULT NULL,
  `ruta_contenido` varchar(200) NOT NULL DEFAULT '',
  `referencia` varchar(255) DEFAULT NULL,
  `tipo_respuesta` int(11) NOT NULL DEFAULT '0' COMMENT '0: Inicialmente es solo vista | 1: Indica que se requiere respuesta de los alumnos',
  `fecha_inicio` date DEFAULT NULL,
  `hora_inicio` time DEFAULT NULL,
  `fecha_final` date DEFAULT NULL,
  `hora_final` time DEFAULT NULL,
  `fecha_ampliada` date DEFAULT NULL COMMENT 'Fecha de ampliación para subir archivo.',
  `estado` int(11) NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `persona_id_created_at` int(11) NOT NULL,
  `persona_id_updated_at` int(11) DEFAULT NULL,
  `fecha_inicio_d` date DEFAULT NULL,
  `fecha_final_d` date DEFAULT NULL,
  `fecha_ampliada_d` date DEFAULT NULL,
  `persona_masivo` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `co_curso_id_idx` (`curso_id`) USING BTREE,
  KEY `co_programacion_unica_id_idx` (`programacion_unica_id`) USING BTREE,
  CONSTRAINT `v_contenidos_ibfk_1` FOREIGN KEY (`curso_id`) REFERENCES `v_cursos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `v_contenidos_ibfk_2` FOREIGN KEY (`programacion_unica_id`) REFERENCES `v_programaciones_unicas` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=59 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of v_contenidos
-- ----------------------------
INSERT INTO `v_contenidos` VALUES ('1', '111', '6', '1', null, 'test', 'default/nodisponible.png', 'c1/cloud.pdf', null, '0', null, null, null, null, null, '0', '2017-11-06 15:29:44', '2017-12-07 16:03:45', '12', '1', null, null, null, null);
INSERT INTO `v_contenidos` VALUES ('2', '111', '6', '1', null, 'Contenido 2', 'default/nodisponible.png', 'c2/test.png', 'https://google.com|https://gmail.com', '1', '2017-11-06', null, '2017-11-13', null, '2017-11-07', '0', '2017-11-06 15:58:53', '2017-12-07 16:03:41', '12', '1', null, null, null, null);
INSERT INTO `v_contenidos` VALUES ('3', '111', '5', '2', 'TAREA', 'Lorem Ipsum\r\n\"Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit...\"\r\n\"No hay nadie que ame el dolor mismo, que lo busque, lo encuentre y lo quiera, simplemente porque es el dolor.\"', 'c3/70b5536c6fe6db0035a4c9b878a50dfb--coloring-pages-christmas-time.jpg', 'c3/trabajo.pdf', 'http://www.google.com|http://www.youtube.com', '1', '2017-11-20', null, '2017-11-20', null, '2017-12-12', '1', '2017-11-13 13:16:36', '2017-12-19 08:17:25', '14', '1', null, null, null, null);
INSERT INTO `v_contenidos` VALUES ('4', '111', '5', '2', 'VIDEOCONFERENCIA', 'Contendididi', 'default/nodisponible.png', 'c4/test.png', 'ff|ww', '2', '2017-12-10', '05:25:00', '2017-12-14', '10:30:00', '2017-12-11', '1', '2017-11-20 12:25:42', '2017-12-19 08:19:23', '14', '1', null, null, null, null);
INSERT INTO `v_contenidos` VALUES ('5', '111', '5', '2', 'Clase 2', 'Lorem Ipsum\r\n\"Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit...\"\r\n\"No hay nadie que ame el dolor mismo, que lo busque, lo encuentre y lo quiera, simplemente porque es el dolor.\"', 'c5/Curva del Cambio.png', 'c5/test.png', null, '0', null, null, null, null, '2017-11-20', '1', '2017-11-20 12:26:05', '2017-12-19 08:17:50', '14', '1', null, null, null, null);
INSERT INTO `v_contenidos` VALUES ('6', '111', '5', '1', null, 'dfsdf', 'default/nodisponible.png', 'c6/test.png', null, '0', '2017-11-20', null, null, null, null, '0', '2017-11-20 12:26:37', '2017-11-20 15:41:51', '14', '14', null, null, null, null);
INSERT INTO `v_contenidos` VALUES ('7', '111', '5', '2', 'Clase 1', 'Lorem Ipsum\r\n\"Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit...\"\r\n\"No hay nadie que ame el dolor mismo, que lo busque, lo encuentre y lo quiera, simplemente porque es el dolor.\"', 'default/nodisponible.png', 'c7/L3TT3L.png', 'https://telesup.adobeconnect.com/cfofi/', '0', null, null, null, null, '2017-11-20', '1', '2017-12-04 14:13:51', '2017-12-19 08:17:41', '14', '1', null, null, null, null);
INSERT INTO `v_contenidos` VALUES ('8', '113', '8', '1', 'SILABO', 'En este documento encontrara el silabo del curso a desarrollarse durante la duración del periodo académico.', 'c8/2.jpg', 'c8/DH-102 - Filosofía - Sílabo Contabilidad.pdf', null, '0', null, null, null, null, '2017-12-19', '0', '2017-12-04 15:26:31', '2018-03-08 14:36:43', '1', '1', '2017-12-13', '2017-12-07', '2017-12-12', null);
INSERT INTO `v_contenidos` VALUES ('9', '108', '4', '1', 'null', 'certificación entregada por la compañía Cisco Systems a las personas que hayan rendido satisfactoriamente el examen correspondiente, sobre infraestructuras de red e Internet.', 'default/nodisponible.png', 'c9/configuracion  antena.jpg', null, '0', null, null, null, null, null, '0', '2017-12-04 15:32:09', '2017-12-11 20:43:08', '1', '1', '2017-12-12', '2017-12-14', '2017-12-11', null);
INSERT INTO `v_contenidos` VALUES ('10', '112', '7', '1', null, 'Iniciando con ADR 1', 'default/nodisponible.png', 'c10/reddes.ppt', null, '0', null, null, null, null, null, '0', '2017-12-05 11:36:15', '2017-12-18 20:27:13', '1', '1', null, null, null, null);
INSERT INTO `v_contenidos` VALUES ('11', '112', '7', '1', null, 'Trabajo final Redes', 'default/nodisponible.png', 'c11/trabajo.pdf', 'https://web.ua.es/es/ice/jornadas-redes/documentos/2013-comunicaciones-orales/334627.pdf', '1', '2017-12-07', null, '2017-12-14', null, '2017-12-14', '0', '2017-12-07 15:56:08', '2017-12-18 20:27:20', '1', '1', null, null, null, null);
INSERT INTO `v_contenidos` VALUES ('12', '111', '5', '2', 'VIDEOCONFERENCIA', 'trabajo', 'c12/images12.png', 'c12/INDICE-PAE.xlsx', null, '2', '2017-12-10', '09:25:00', '2017-12-10', '11:55:00', '2017-12-10', '1', '2017-12-07 16:06:22', '2017-12-19 08:19:04', '1', '1', null, null, null, null);
INSERT INTO `v_contenidos` VALUES ('13', '108', '4', '2', 'XX', 'XX', 'c13/megaphone.png', 'c13/letter.png', null, '0', null, null, null, null, null, '0', '2017-12-11 14:53:59', '2017-12-11 14:55:22', '1', '1', null, null, null, null);
INSERT INTO `v_contenidos` VALUES ('14', '108', '4', '2', 'XX', 'XX', 'c14/megaphone.png', 'c14/letter.png', null, '0', null, null, null, null, null, '0', '2017-12-11 14:54:03', '2017-12-11 14:54:41', '1', '1', null, null, null, null);
INSERT INTO `v_contenidos` VALUES ('15', '108', '4', '2', 'SILABO', 'EN ESTE DOCUMENTO ENCONTRAREMOS EL SILABO DEL CURSO, EL CUAL SE DESARROLLARA A LO LARGO DEL SEMESTRE ACÁDEMICO', 'c15/PORTADA.jpg', 'c15/CM-101 - Comunicación I - Administracion - FINAL.pdf', null, '0', null, null, null, null, null, '0', '2017-12-11 20:42:39', '2017-12-12 17:21:18', '1', '1', '2017-12-11', '2017-12-31', null, null);
INSERT INTO `v_contenidos` VALUES ('16', '108', '4', '1', 'SILABO', 'SILabo del curso', 'c16/descarga.jpg', 'c16/CM-101 - Comunicación I - Administracion - FINAL.pdf', null, '2', '2017-12-02', '14:10:00', '2017-12-12', '15:10:00', '2017-12-13', '0', '2017-12-12 17:16:12', '2017-12-18 20:42:46', '1', '1', '2017-12-12', '2017-12-13', '2017-12-13', null);
INSERT INTO `v_contenidos` VALUES ('17', '108', '4', '1', 'guias', 'htjyfkutyccm', 'default/nodisponible.png', 'c17/CM-101 - Comunicación I - Administracion - FINAL.pdf', null, '0', null, null, null, null, null, '0', '2017-12-12 17:18:37', '2017-12-13 10:40:30', '1', '1', null, null, null, null);
INSERT INTO `v_contenidos` VALUES ('18', '108', '4', '2', 'mi documento', 'mis dfdnjksdfi', 'default/nodisponible.png', 'c18/7. Formula Silabo.docx', null, '0', null, null, null, null, null, '0', '2017-12-12 17:22:42', '2017-12-13 10:40:25', '1', '1', null, null, null, null);
INSERT INTO `v_contenidos` VALUES ('19', '108', '4', '2', 'TAREA: SOBRE COMUNICACIÓN Y LENGUAJE', 'Según las indicaciones presente usted la tarea.', 'c19/UN I-TAREAIMAGEN.jpg', 'c19/UN I-TAREA-COMUNICACION I.pdf', 'https://www.youtube.com/watch?v=nfisr_4hZ1g', '1', '2017-12-24', '15:00:00', '2018-01-06', '15:55:00', '2018-01-20', '1', '2017-12-12 17:29:01', '2017-12-20 11:58:32', '1', '1', '2017-12-24', '2018-01-06', '2018-01-27', null);
INSERT INTO `v_contenidos` VALUES ('20', '108', '4', '3', 'UNIDAD II: LA LECTURA Y EL TEXTO', '“Desarrolla la capacidad lectora a través de técnicas que le permitan comprender textos académicos expositivos y argumentativos”.', 'c20/UN II-CARATULA- COMUNICACION I.png', 'c20/UN II-CONTENIDO- COMUNICACION I.png', null, '0', null, null, null, null, null, '1', '2017-12-12 17:30:26', '2017-12-20 11:40:45', '1', '1', null, null, null, null);
INSERT INTO `v_contenidos` VALUES ('21', '108', '4', '5', 'otro', 'xd', 'c21/images.png', 'c21/telesup.png', null, '0', null, null, null, null, null, '0', '2017-12-14 13:31:11', '2017-12-19 12:06:51', '1', '1', null, null, null, null);
INSERT INTO `v_contenidos` VALUES ('22', '108', '4', '4', 'prueba', 'prueba', 'c22/SASASA.png', 'c22/CONTACTANOS.jpg', null, '0', null, null, null, null, null, '0', '2017-12-14 13:36:45', '2017-12-19 12:07:02', '1', '1', null, null, null, null);
INSERT INTO `v_contenidos` VALUES ('23', '108', '4', '6', 'OTRO', 'BEUN DIA', 'c23/file-4.png', 'c23/map-18.png', null, '0', null, null, null, null, null, '0', '2017-12-14 13:49:25', '2017-12-18 22:12:55', '1', '1', null, null, null, null);
INSERT INTO `v_contenidos` VALUES ('24', '108', '4', '1', 'DSDSD', 'DSDSD', 'c24/IMG TELESUP.png', 'c24/VIDEO.png', null, '0', null, null, null, null, null, '0', '2017-12-18 08:59:00', '2017-12-18 08:59:23', '1', '1', null, null, null, null);
INSERT INTO `v_contenidos` VALUES ('25', '108', '4', '2', 'UNIDAD I: LA COMUNICACIÓN Y EL LENGUAJE', '“Identifica y discrimina características y funciones del lenguaje, así como elementos e interferencias de la comunicación”.', 'c25/UN I-CARATULA- COMUNICACION I.png', 'c25/UN I-CONTENIDO-COMUNICACION I.png', 'https://www.youtube.com/watch?v=KThR-WXlP5E', '0', null, null, null, null, '2018-01-23', '1', '2017-12-18 09:00:21', '2018-01-23 15:48:27', '1', '1', null, null, null, null);
INSERT INTO `v_contenidos` VALUES ('26', '108', '4', '2', 'UNIDAD I: VIDEOCONFERENCIA 1', 'La comunicación y el lenguaje Parte 1', 'c26/UN I-VIDEOCONFERENCIA 1.png', 'c26/UN I-CONTENIDO-VIDEOCONFERENCIA 1.png', 'https://telesup.adobeconnect.com/cfcom/', '2', '2017-12-18', '18:00:00', '2017-12-23', '20:00:00', '2017-12-30', '1', '2017-12-18 09:04:00', '2017-12-20 12:13:26', '1', '1', '2017-12-18', '2017-12-23', '2018-01-04', null);
INSERT INTO `v_contenidos` VALUES ('27', '112', '7', '1', 'SILABO', 'En este documento encontrara el silabo del curso a desarrollarse durante la duración del mismo.', 'c27/1.jpg', 'c27/AC-101 - Introducción a la Contabilidad y Finanzas.pdf', null, '0', null, null, null, null, null, '1', '2017-12-18 20:30:56', '2017-12-18 21:51:29', '1', '1', null, null, null, null);
INSERT INTO `v_contenidos` VALUES ('28', '111', '5', '1', 'SILABO', 'En este documento encontrara el silabo del curso a desarrollarse durante la duración del periodo académico.', 'c28/3.jpg', 'c28/IA-101 - Ofimatica Empresarial I - Silabo Contabilidad.pdf', null, '0', null, null, null, null, null, '1', '2017-12-18 21:45:47', '2017-12-19 08:11:35', '1', '1', null, null, null, null);
INSERT INTO `v_contenidos` VALUES ('29', '108', '4', '1', 'SÍLABO', 'En este documento encontrara el silabo del curso a desarrollarse durante la duración del periodo académico.', 'c29/SILABO.png', 'c29/CM-101 - Comunicación I - Contabilidad - FINAL.pdf', null, '0', null, null, null, null, null, '1', '2017-12-18 21:50:53', '2017-12-20 10:56:37', '1', '1', null, null, null, null);
INSERT INTO `v_contenidos` VALUES ('30', '111', '6', '1', 'SILABO', 'En este documento encontrara el silabo del curso a desarrollarse durante la duración del periodo académico.', 'c30/5.jpg', 'c30/IA-101 - Ofimatica Empresarial I - Silabo Contabilidad.pdf', null, '0', null, null, null, null, '2017-12-18', '1', '2017-12-18 22:02:07', '2017-12-19 18:14:22', '12', '1', '2017-12-27', '2017-12-12', '2017-12-05', null);
INSERT INTO `v_contenidos` VALUES ('31', '112', '7', '2', 'INTRODUCCIÓN A LA CONTABILIDAD', 'La Contabilidad es una herramienta fundamental en el desarrollo de las organizaciones.', 'c31/DFSDS.jpg', 'c31/INTRODSDS.pdf', null, '0', null, null, null, null, '2017-12-20', '1', '2017-12-18 22:21:00', '2017-12-19 18:16:06', '1', '1', '2017-12-14', '2017-12-13', '2017-12-12', null);
INSERT INTO `v_contenidos` VALUES ('32', '108', '4', '1', 'LIBRO DEL CURSO', 'Al finalizar esta asignatura usted será capaz de “Desarrollar, fortalecer y perfeccionar sus habilidades comunicativas (hablar, escuchar, escribir y leer) adecuadas al discurso académico, a través de actividades donde aplique diversas técnicas y estrategias que le permitan la comprensión y el  análisis de textos académicos.', 'c32/LIBRO.png', 'c32/LIBRO.png', 'http://telesup.net/campus/pluginfile.php/176683/mod_resource/content/3/Comunicacion%20I.pdf', '0', null, null, null, null, null, '0', '2017-12-19 11:37:06', '2017-12-20 11:20:30', '1', '1', null, null, null, null);
INSERT INTO `v_contenidos` VALUES ('33', '108', '4', '3', 'VIDEOCONFERENCIA', 'Por este medio se desarrollara diferentes clases online, los cuales servirán de apoyo para su formación profesional.\r\n\r\nTEMA 02', 'c33/GFGF.png', 'c33/enviar.txt', null, '2', '2018-02-13', '08:00:00', null, '10:10:00', null, '0', '2017-12-19 11:40:15', '2017-12-20 12:25:16', '1', '1', null, null, null, null);
INSERT INTO `v_contenidos` VALUES ('34', '108', '4', '3', 'UNIDAD II: VIDEOCONFERENCIA 1', 'La lectura y el texto Parte 1', 'c34/UN II-IMAGEN-VIDEOCONFERENCIA 1.png', 'c34/UN II-CONTENIDO-VIDEOCONFERENCIA 1.png', 'https://telesup.adobeconnect.com/cfcom/', '2', '2018-01-29', '18:00:00', null, '20:00:00', null, '1', '2017-12-19 11:44:12', '2017-12-20 13:02:30', '1', '1', null, null, null, null);
INSERT INTO `v_contenidos` VALUES ('35', '108', '4', '3', 'TAREA: SOBRE LA LECTURA Y EL TECTO', 'Según las indicaciones presente usted la tarea.', 'c35/UN II-TAREAIMAGEN.jpg', 'c35/UN II-TAREA-COMUNICACION I.pdf', null, '1', '2018-01-16', null, '2018-01-27', null, '2018-02-03', '1', '2017-12-19 11:46:00', '2017-12-20 12:24:37', '1', '1', '2018-01-16', '2018-01-27', '2018-02-03', null);
INSERT INTO `v_contenidos` VALUES ('36', '108', '4', '4', 'LA GRAMÁTICA DEL TEXTO', 'Desarrolla la capacidad lectora a través de técnicas que le permitan comprender textos\r\nacadémicos expositivos y argumentativos.', 'c36/ensenanza-del-profesor-de-clase-de-gramatica-senalando-las-lineas-de-texto-de-la-pizarra_318-59053.jpg', 'c36/Tarea.docx', null, '0', null, '17:00:00', null, '18:50:00', null, '0', '2017-12-19 12:02:53', '2017-12-20 11:39:51', '1', '1', null, null, null, null);
INSERT INTO `v_contenidos` VALUES ('37', '108', '4', '5', 'UNIDAD IV: CORRECCIÓN IDIOMÁTICA', '“Produce textos escritos teniendo en cuenta las normas de corrección idiomática”.', 'c37/UN IV-CARATULA- COMUNICACION I.png', 'c37/UN IV-CONTENIDO-COMUNICACION I.png', null, '0', null, null, null, null, null, '1', '2017-12-19 12:05:36', '2017-12-20 11:38:28', '1', '1', null, null, null, null);
INSERT INTO `v_contenidos` VALUES ('38', '108', '4', '1', 'Taller de Oratoria', 'Se convoca a los estudiantes a participar del taller de Oratoria, para que hablen bonito y no cojudeces.', 'c38/APEDREAR.png', 'c38/INGRESO A PATMOS.pdf', null, '0', null, null, null, null, null, '0', '2017-12-19 12:06:00', '2017-12-20 11:13:35', '27', '1', null, null, null, null);
INSERT INTO `v_contenidos` VALUES ('39', '108', '4', '3', 'EXAMEN PACIAL', 'DESARROLLAR', 'c39/111.jpg', 'c39/EXAMEN PARCIAL.docx', null, '1', '2018-02-04', null, '2018-02-16', null, '2018-02-24', '0', '2017-12-19 12:21:06', '2017-12-20 12:24:45', '1', '1', '2018-02-04', '2018-02-16', '2018-02-24', null);
INSERT INTO `v_contenidos` VALUES ('40', '108', '4', '4', 'UNIDAD III: ETIMOLOGÍA  Y TERMINOLOGÍA BÁSICA', '“Comprende el significado de expresiones latinas y griegas que hoy son parte de la terminología en su carrera profesional y las emplea en textos escritos”.', 'c40/UN III-CARATULA- COMUNICACION I.png', 'c40/UN III-CONTENIDO-COMUNICACION I.png', null, '0', null, null, null, null, null, '1', '2017-12-19 14:51:05', '2017-12-20 11:39:42', '1', '1', null, null, null, null);
INSERT INTO `v_contenidos` VALUES ('41', '114', '9', '3', 'Prueba', 'Prueba', 'default/nodisponible.png', 'c41/DATA PARA EJEMPLO.docx', null, '1', '2017-11-29', null, '2017-12-19', null, '2017-12-12', '1', '2017-12-19 16:44:18', '2017-12-19 18:04:02', '1', '1', '2017-12-22', '2017-12-12', '2017-11-28', null);
INSERT INTO `v_contenidos` VALUES ('42', '114', '9', '2', 'TAREA N° 4', 'TAREA A DESARROLLAR', 'c42/sasa.jpg', 'c42/XCDDDS.docx', null, '1', '2017-12-20', null, '2017-12-27', null, '2018-01-03', '1', '2017-12-20 10:11:54', '2017-12-20 10:11:55', '1', null, '2017-12-20', '2017-12-27', '2018-01-03', null);
INSERT INTO `v_contenidos` VALUES ('43', '108', '4', '4', 'TAREA: ETIMOLOGÍA Y TERMINOLOGÍA BÁSICA', 'Según las indicaciones presente usted la tarea.', 'c43/UN III-TAREAIMAGEN.jpg', 'c43/UN III-TAREA-COMUNICACION I.pdf', null, '1', '2017-12-20', null, '2017-12-27', null, '2018-01-04', '1', '2017-12-20 10:16:11', '2017-12-20 12:47:16', '1', '1', '2017-12-20', '2017-12-27', '2018-01-04', null);
INSERT INTO `v_contenidos` VALUES ('44', '108', '4', '5', 'TAREA: CORRECCIÓN IDIOMÁTICA', 'Según las indicaciones presente usted la tarea.', 'c44/UN IV-TAREAIMAGEN.jpg', 'c44/UN IV-TAREA-COMUNICACION I.pdf', null, '1', '2017-12-27', null, '2017-12-05', null, '2017-12-03', '1', '2017-12-20 10:17:24', '2017-12-20 12:49:45', '1', '1', '2017-12-19', '2017-12-21', '2018-01-16', null);
INSERT INTO `v_contenidos` VALUES ('45', '108', '4', '1', 'GUÍA DEL CURSO', 'La Guía del curso de comunicación nos presenta la metodología de la conducción del curso y el proceso de evaluación', 'c45/ffffffffff.png', 'c45/GUIA COMUNICACION I.docx', null, '0', null, null, null, null, null, '1', '2017-12-20 10:55:26', '2017-12-20 11:25:28', '1', '1', null, null, null, null);
INSERT INTO `v_contenidos` VALUES ('46', '108', '4', '4', 'UNIDAD III: VIDEOCONFERENCIA 1', 'Etimoligia y terminología Básica Parte 1', 'c46/UN III-IMAGEN-VIDEOCONFERENCIA 1.png', 'c46/UN III-CONTENIDO-VIDEOCONFERENCIA 1.png', 'https://telesup.adobeconnect.com/cfcom/', '2', '2018-02-05', '18:00:00', null, '20:00:00', null, '1', '2017-12-20 12:41:58', '2017-12-20 13:00:31', '1', '1', null, null, null, null);
INSERT INTO `v_contenidos` VALUES ('47', '108', '4', '5', 'UNIDAD IV: VIDEOCONFERENCIA 1', 'Corrección Idiomática Parte 1', 'c47/UN IV-IMAGEN-VIDEOCONFERENCIA 1.png', 'c47/UN IV-CONTENIDO-VIDEOCONFERENCIA 1.png', 'https://telesup.adobeconnect.com/cfcom/', '1', '2018-03-12', '17:45:00', '2018-01-24', '19:15:00', '2018-01-24', '1', '2017-12-20 12:51:46', '2018-01-24 14:26:32', '1', '1', null, null, null, null);
INSERT INTO `v_contenidos` VALUES ('48', '108', '4', '2', 'UNIDAD I: VIDEOCONFERENCIA 2', 'La comunicación y el lenguaje Parte 2', 'c48/UN I-IMAGEN-VIDEOCONFERENCIA 2.png', 'c48/UN I-CONTENIDO-VIDEOCONFERENCIA 2.png', 'https://telesup.adobeconnect.com/cfcom/', '2', '2017-12-25', '18:00:00', null, '20:00:00', null, '0', '2017-12-20 12:55:04', '2018-01-18 15:07:09', '1', '1', null, null, null, null);
INSERT INTO `v_contenidos` VALUES ('49', '108', '4', '3', 'UNIDAD II: VIDEOCONFERENCIA 2', 'La lectura y el texto Parte 2', 'c49/UN II-IMAGEN-VIDEOCONFERENCIA 2.png', 'c49/UN II-CONTENIDO-VIDEOCONFERENCIA 2.png', 'https://telesup.adobeconnect.com/cfcom/', '0', null, '18:00:00', null, '20:00:00', '2018-01-24', '1', '2017-12-20 12:58:46', '2018-01-24 14:26:10', '1', '1', null, null, null, null);
INSERT INTO `v_contenidos` VALUES ('50', '108', '4', '4', 'UNIDAD III: VIDEOCONFERENCIA 2', 'Etimoligia y terminología Básica Parte 2', 'c50/UN III-IMAGEN-VIDEOCONFERENCIA 2.png', 'c50/UN III-CONTENIDO-VIDEOCONFERENCIA 2.png', 'https://telesup.adobeconnect.com/cfcom/', '2', '2018-02-12', '18:00:00', null, '20:00:00', null, '1', '2017-12-20 13:08:24', '2017-12-20 13:08:24', '1', null, null, null, null, null);
INSERT INTO `v_contenidos` VALUES ('51', '108', '4', '5', 'UNIDAD IV: VIDEOCONFERENCIA 2', 'Corrección Idiomática Parte 1', 'c51/UN IV-IMAGEN-VIDEOCONFERENCIA 2.png', 'c51/UN IV-CONTENIDO-VIDEOCONFERENCIA 2.png', 'https://telesup.adobeconnect.com/cfcom/', '2', '2018-03-19', '18:00:00', null, '20:00:00', null, '1', '2017-12-20 13:09:41', '2017-12-20 13:09:41', '1', null, null, null, null, null);
INSERT INTO `v_contenidos` VALUES ('52', '114', '8', '3', 'Prueba', 'Prueba', null, '', null, '1', '2017-11-29', null, '2017-12-19', null, '2017-12-12', '0', '2018-03-08 16:09:47', '2018-03-08 16:09:47', '1', null, null, null, null, null);
INSERT INTO `v_contenidos` VALUES ('53', '114', '8', '3', 'Prueba', 'Prueba', 'default/nodisponible.png', 'c53/DATA PARA EJEMPLO.docx', null, '1', '2017-11-29', null, '2017-12-19', null, '2017-12-12', '0', '2018-03-08 16:46:23', '2018-03-08 16:46:23', '1', null, null, null, null, null);
INSERT INTO `v_contenidos` VALUES ('54', '114', '8', '2', 'TAREA N° 4', 'TAREA A DESARROLLAR', null, '', null, '1', '2017-12-20', null, '2017-12-27', null, '2018-01-03', '0', '2018-03-08 16:46:23', '2018-03-08 16:46:23', '1', null, null, null, null, null);
INSERT INTO `v_contenidos` VALUES ('55', '114', '8', '3', 'Prueba', 'Prueba', 'default/nodisponible.png', 'c55/DATA PARA EJEMPLO.docx', null, '1', '2017-11-29', null, '2017-12-19', null, '2017-12-12', '0', '2018-03-08 16:49:23', '2018-03-08 16:49:23', '1', null, null, null, null, null);
INSERT INTO `v_contenidos` VALUES ('56', '114', '8', '2', 'TAREA N° 4', 'TAREA A DESARROLLAR', null, '', null, '1', '2017-12-20', null, '2017-12-27', null, '2018-01-03', '0', '2018-03-08 16:49:23', '2018-03-08 16:49:23', '1', null, null, null, null, null);
INSERT INTO `v_contenidos` VALUES ('57', '114', '8', '3', 'Prueba', 'Prueba', 'default/nodisponible.png', 'c57/DATA PARA EJEMPLO.docx', null, '1', '2017-11-29', null, '2017-12-19', null, '2017-12-12', '0', '2018-03-08 16:51:34', '2018-03-08 16:51:34', '1', null, null, null, null, null);
INSERT INTO `v_contenidos` VALUES ('58', '114', '8', '2', 'TAREA N° 4', 'TAREA A DESARROLLAR', 'c58/sasa.jpg', 'c58/XCDDDS.docx', null, '1', '2017-12-20', null, '2017-12-27', null, '2018-01-03', '0', '2018-03-08 16:51:34', '2018-03-08 16:51:34', '1', null, null, null, null, null);

-- ----------------------------
-- Table structure for v_contenidos_programaciones
-- ----------------------------
DROP TABLE IF EXISTS `v_contenidos_programaciones`;
CREATE TABLE `v_contenidos_programaciones` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `contenido_id` int(11) NOT NULL,
  `programacion_id` int(11) NOT NULL,
  `fecha_ampliacion` date NOT NULL COMMENT 'Fecha de ampliacion para subir un curso.',
  `estado` int(11) NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `persona_id_created_at` int(11) NOT NULL,
  `persona_id_updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `cp_programacion_id_idx` (`programacion_id`) USING BTREE,
  KEY `cp_contenido_id_idx` (`contenido_id`) USING BTREE,
  CONSTRAINT `v_contenidos_programaciones_ibfk_1` FOREIGN KEY (`contenido_id`) REFERENCES `v_contenidos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `v_contenidos_programaciones_ibfk_2` FOREIGN KEY (`programacion_id`) REFERENCES `v_programaciones` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of v_contenidos_programaciones
-- ----------------------------
INSERT INTO `v_contenidos_programaciones` VALUES ('1', '2', '3', '2017-11-10', '1', '2017-11-06 15:59:20', '2017-11-06 15:59:20', '12', null);
INSERT INTO `v_contenidos_programaciones` VALUES ('2', '3', '6', '2017-11-13', '0', '2017-11-13 17:26:52', '2017-11-17 09:39:16', '14', '14');
INSERT INTO `v_contenidos_programaciones` VALUES ('3', '3', '6', '2017-11-09', '0', '2017-11-13 17:38:07', '2017-11-17 09:39:16', '14', '14');
INSERT INTO `v_contenidos_programaciones` VALUES ('4', '3', '4', '2017-11-17', '0', '2017-11-13 17:38:15', '2017-12-04 16:03:00', '14', '14');
INSERT INTO `v_contenidos_programaciones` VALUES ('5', '3', '6', '2017-11-17', '0', '2017-11-17 09:39:06', '2017-11-17 09:39:16', '14', '14');
INSERT INTO `v_contenidos_programaciones` VALUES ('6', '3', '6', '2017-11-18', '1', '2017-11-17 09:39:16', '2017-11-17 09:39:16', '14', null);
INSERT INTO `v_contenidos_programaciones` VALUES ('7', '3', '10', '2017-11-30', '0', '2017-11-30 21:32:12', '2017-12-04 15:54:18', '1', '14');
INSERT INTO `v_contenidos_programaciones` VALUES ('8', '3', '4', '2017-12-06', '1', '2017-12-04 16:03:00', '2017-12-04 16:03:00', '14', null);
INSERT INTO `v_contenidos_programaciones` VALUES ('9', '3', '12', '2017-12-21', '1', '2017-12-07 16:55:24', '2017-12-07 16:55:24', '1', null);
INSERT INTO `v_contenidos_programaciones` VALUES ('10', '19', '1', '2017-12-13', '0', '2017-12-14 22:11:31', '2017-12-14 22:11:41', '1', '1');
INSERT INTO `v_contenidos_programaciones` VALUES ('11', '19', '14', '2018-02-01', '1', '2018-02-01 09:34:42', '2018-02-01 09:34:42', '1', null);
INSERT INTO `v_contenidos_programaciones` VALUES ('12', '35', '14', '2018-02-01', '0', '2018-02-01 11:37:25', '2018-02-01 11:38:18', '1', '1');
INSERT INTO `v_contenidos_programaciones` VALUES ('13', '35', '14', '2018-01-30', '1', '2018-02-01 11:38:18', '2018-02-01 11:38:18', '1', null);
INSERT INTO `v_contenidos_programaciones` VALUES ('14', '35', '13', '2018-02-13', '1', '2018-02-01 11:57:56', '2018-02-01 11:57:56', '1', null);

-- ----------------------------
-- Table structure for v_contenidos_respuestas
-- ----------------------------
DROP TABLE IF EXISTS `v_contenidos_respuestas`;
CREATE TABLE `v_contenidos_respuestas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `contenido_id` int(11) NOT NULL,
  `programacion_id` int(11) NOT NULL,
  `respuesta` varchar(500) NOT NULL DEFAULT '',
  `nota` char(2) DEFAULT NULL,
  `ruta_respuesta` varchar(200) NOT NULL DEFAULT '',
  `estado` int(11) NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `persona_id_created_at` int(11) NOT NULL,
  `persona_id_updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `cr_contenido_id_idx` (`contenido_id`) USING BTREE,
  KEY `cr_programacion_id_idx` (`programacion_id`) USING BTREE,
  CONSTRAINT `v_contenidos_respuestas_ibfk_1` FOREIGN KEY (`contenido_id`) REFERENCES `v_contenidos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `v_contenidos_respuestas_ibfk_2` FOREIGN KEY (`programacion_id`) REFERENCES `v_programaciones` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of v_contenidos_respuestas
-- ----------------------------
INSERT INTO `v_contenidos_respuestas` VALUES ('1', '2', '3', 'Todo esta ok!.', null, '', '1', '2017-11-12 22:45:43', '2017-11-12 22:45:43', '12', null);
INSERT INTO `v_contenidos_respuestas` VALUES ('2', '2', '3', 'Respuesta 2222', null, '', '1', '2017-11-12 22:57:16', '2017-11-12 22:57:16', '12', null);
INSERT INTO `v_contenidos_respuestas` VALUES ('3', '2', '3', 'Respuesta 111', null, 'test.png', '1', '2017-11-12 22:59:33', '2017-11-12 22:59:33', '12', null);
INSERT INTO `v_contenidos_respuestas` VALUES ('4', '2', '3', 'Todo estaba bien', null, '', '0', '2017-11-12 23:00:20', '2017-12-01 11:44:28', '12', '12');
INSERT INTO `v_contenidos_respuestas` VALUES ('5', '2', '3', 'listoooo', null, '', '1', '2017-11-12 23:24:13', '2017-11-12 23:24:13', '12', null);
INSERT INTO `v_contenidos_respuestas` VALUES ('6', '2', '3', 'okaaaa', null, '', '1', '2017-11-12 23:25:09', '2017-11-12 23:25:09', '12', null);
INSERT INTO `v_contenidos_respuestas` VALUES ('7', '3', '2', 'Respuesta de prueba!!!!!', null, '', '0', '2017-11-20 16:18:42', '2017-12-09 16:04:56', '12', '12');
INSERT INTO `v_contenidos_respuestas` VALUES ('8', '3', '2', 'rpta final', null, 'Matricula (3).xlsx', '0', '2017-12-07 17:04:53', '2017-12-09 16:04:56', '12', '12');
INSERT INTO `v_contenidos_respuestas` VALUES ('9', '3', '2', '', null, 'camb.txt', '0', '2017-12-09 09:06:13', '2017-12-09 16:04:56', '12', '12');
INSERT INTO `v_contenidos_respuestas` VALUES ('10', '3', '2', 'nueva rpta de prueba', null, 'camb.txt', '0', '2017-12-09 09:06:26', '2017-12-09 16:04:56', '12', '12');
INSERT INTO `v_contenidos_respuestas` VALUES ('11', '3', '2', '', null, '', '0', '2017-12-09 16:04:57', '2017-12-09 16:05:14', '12', '12');
INSERT INTO `v_contenidos_respuestas` VALUES ('12', '12', '2', 'Profe el trabajo final espero tenga mi 20 :V', null, 'cultura-chavin-1-728.jpg', '1', '2017-12-10 18:28:32', '2017-12-10 18:28:32', '12', null);
INSERT INTO `v_contenidos_respuestas` VALUES ('13', '19', '13', '', null, '', '0', '2017-12-20 15:12:08', '2017-12-20 15:40:20', '33', '33');
INSERT INTO `v_contenidos_respuestas` VALUES ('14', '19', '13', '', null, '', '0', '2017-12-20 15:12:14', '2017-12-20 15:40:20', '33', '33');
INSERT INTO `v_contenidos_respuestas` VALUES ('15', '19', '13', '', null, '', '0', '2017-12-20 15:12:17', '2017-12-20 15:40:20', '33', '33');
INSERT INTO `v_contenidos_respuestas` VALUES ('16', '19', '13', '', null, '', '0', '2017-12-20 15:13:18', '2017-12-20 15:40:20', '33', '33');
INSERT INTO `v_contenidos_respuestas` VALUES ('17', '19', '13', '', null, '', '0', '2017-12-20 15:13:22', '2017-12-20 15:40:20', '33', '33');
INSERT INTO `v_contenidos_respuestas` VALUES ('18', '19', '13', '', null, '', '0', '2017-12-20 15:13:28', '2017-12-20 15:40:20', '33', '33');
INSERT INTO `v_contenidos_respuestas` VALUES ('19', '19', '13', '', null, '', '0', '2017-12-20 15:13:35', '2017-12-20 15:40:20', '33', '33');
INSERT INTO `v_contenidos_respuestas` VALUES ('20', '19', '13', 'Le envio mi tarea profe.', '18', 'image.png', '1', '2017-12-20 15:40:20', '2018-01-23 08:39:19', '33', '27');
INSERT INTO `v_contenidos_respuestas` VALUES ('21', '35', '13', 'mi tarea profesoooooooor', null, 'DNI.docx', '0', '2018-01-20 18:20:18', '2018-01-23 14:53:59', '33', '33');
INSERT INTO `v_contenidos_respuestas` VALUES ('22', '35', '14', 'Prub', '15', 'Nuevo Hoja de cálculo de Microsoft Excel.xlsx', '1', '2018-01-23 11:51:52', '2018-01-23 11:52:38', '34', '1');
INSERT INTO `v_contenidos_respuestas` VALUES ('23', '25', '13', 'ff', '14', 'preyres.txt', '1', '2018-01-23 14:38:22', '2018-01-23 14:38:41', '33', '1');
INSERT INTO `v_contenidos_respuestas` VALUES ('24', '35', '13', '', null, 'preyres.txt', '1', '2018-01-23 14:53:59', '2018-01-23 14:53:59', '33', null);

-- ----------------------------
-- Table structure for v_cursos
-- ----------------------------
DROP TABLE IF EXISTS `v_cursos`;
CREATE TABLE `v_cursos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `curso_externo_id` int(11) DEFAULT NULL,
  `curso` varchar(150) NOT NULL,
  `foto` varchar(100) DEFAULT '',
  `foto_cab` varchar(100) DEFAULT '',
  `estado` int(11) NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `persona_id_created_at` int(11) NOT NULL,
  `persona_id_updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=115 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of v_cursos
-- ----------------------------
INSERT INTO `v_cursos` VALUES ('1', '0', 'Marketing', 'icon_mark-02.png', 'cabeza_mark-01.png', '1', '2017-09-25 16:33:41', '2017-12-14 13:21:00', '1', '1');
INSERT INTO `v_cursos` VALUES ('108', '1', 'Comunicación I', 'ICONO.png', 'cabeza_com-01-01.png', '1', '2017-10-30 10:33:04', '2017-12-20 12:08:53', '1', '1');
INSERT INTO `v_cursos` VALUES ('110', '2', 'Matematica Basica', 'icon_mat-02.png', 'cabezera_mate.png', '1', '2017-10-30 11:19:43', '2017-12-18 21:32:10', '1', '1');
INSERT INTO `v_cursos` VALUES ('111', '3', 'Ofimatica Empresarial I', 'Ofimatica-02.png', 'banner_ofi-01.png', '1', '2017-10-31 13:01:55', '2017-12-20 07:35:09', '1', '1');
INSERT INTO `v_cursos` VALUES ('112', '4', 'Introducción a la Contabilidad', 'Contabilidad-02.png', 'Contabilidad-01.png', '1', '2017-11-17 09:57:19', '2017-12-20 07:49:27', '1', '1');
INSERT INTO `v_cursos` VALUES ('113', '5', 'Filosofía', 'icon_Filosofia-02.png', 'banner_Filosofia-01.png', '1', '2017-11-17 09:57:19', '2017-12-19 09:38:00', '1', '1');
INSERT INTO `v_cursos` VALUES ('114', '6', 'Metodología del trabajo Universitario', 'Metodologia-02.png', 'Metodologia-01.png', '1', '2017-12-18 17:32:18', '2017-12-20 07:57:01', '1', '1');

-- ----------------------------
-- Table structure for v_cursos_copy
-- ----------------------------
DROP TABLE IF EXISTS `v_cursos_copy`;
CREATE TABLE `v_cursos_copy` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `curso` varchar(150) NOT NULL,
  `curso_externo_id` int(11) DEFAULT NULL,
  `estado` int(11) NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `persona_id_created_at` int(11) NOT NULL,
  `persona_id_updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of v_cursos_copy
-- ----------------------------
INSERT INTO `v_cursos_copy` VALUES ('1', 'Curso 1', '1', '1', '2017-09-25 16:33:41', null, '1', null);
INSERT INTO `v_cursos_copy` VALUES ('2', 'Curso rest 11', '1', '1', '2017-10-01 20:54:37', '2017-10-01 20:54:37', '1', null);
INSERT INTO `v_cursos_copy` VALUES ('3', 'Curso rest 21', '1', '1', '2017-10-01 20:54:37', '2017-10-01 20:54:37', '1', null);
INSERT INTO `v_cursos_copy` VALUES ('4', 'Curso rest 1', '1', '1', '2017-10-01 21:18:40', '2017-10-01 21:18:40', '1', null);
INSERT INTO `v_cursos_copy` VALUES ('5', 'Curso rest 2', '1', '1', '2017-10-01 21:18:40', '2017-10-01 21:18:40', '1', null);
INSERT INTO `v_cursos_copy` VALUES ('6', 'curssss', '1', '1', '2017-10-26 08:28:43', '2017-10-26 08:28:43', '1', null);
INSERT INTO `v_cursos_copy` VALUES ('7', 'curssss 2', '1', '1', '2017-10-26 08:28:43', '2017-10-26 08:28:43', '1', null);
INSERT INTO `v_cursos_copy` VALUES ('8', 'curssss 11111', '1', '1', '2017-10-26 08:37:45', '2017-10-26 08:37:45', '1', null);
INSERT INTO `v_cursos_copy` VALUES ('9', 'curssss 22222', '1', '1', '2017-10-26 08:37:45', '2017-10-26 08:37:45', '1', null);
INSERT INTO `v_cursos_copy` VALUES ('10', 'curssss 3333', '1', '1', '2017-10-26 15:04:53', '2017-10-26 15:04:53', '1', null);
INSERT INTO `v_cursos_copy` VALUES ('11', 'curssss 4444', '1', '1', '2017-10-26 15:04:53', '2017-10-26 15:04:53', '1', null);
INSERT INTO `v_cursos_copy` VALUES ('12', 'curssss 5555', '1', '1', '2017-10-26 15:06:21', '2017-10-26 15:06:21', '1', null);
INSERT INTO `v_cursos_copy` VALUES ('13', 'curssss 6666', '1', '1', '2017-10-26 15:06:21', '2017-10-26 15:06:21', '1', null);
INSERT INTO `v_cursos_copy` VALUES ('14', 'curssss 7777', '1', '1', '2017-10-26 15:07:39', '2017-10-26 15:07:39', '1', null);
INSERT INTO `v_cursos_copy` VALUES ('15', 'curssss 8888', '1', '1', '2017-10-26 15:07:39', '2017-10-26 15:07:39', '1', null);
INSERT INTO `v_cursos_copy` VALUES ('16', 'curssss 99999', '1', '1', '2017-10-26 15:09:51', '2017-10-26 15:09:51', '1', null);
INSERT INTO `v_cursos_copy` VALUES ('17', 'curssss 11222', '1', '1', '2017-10-26 15:09:51', '2017-10-26 15:09:51', '1', null);

-- ----------------------------
-- Table structure for v_evaluaciones
-- ----------------------------
DROP TABLE IF EXISTS `v_evaluaciones`;
CREATE TABLE `v_evaluaciones` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `programacion_id` int(11) NOT NULL,
  `tipo_evaluacion_id` int(11) NOT NULL,
  `fecha_evaluacion_inicial` date DEFAULT NULL,
  `fecha_evaluacion_final` date DEFAULT NULL,
  `fecha_reprogramada_inicial` date DEFAULT NULL COMMENT 'Fecha que se amplio',
  `fecha_reprogramada_final` date DEFAULT NULL,
  `descripcion` varchar(500) NOT NULL DEFAULT '',
  `nota` decimal(10,2) NOT NULL DEFAULT '0.00',
  `estado_cambio` int(11) NOT NULL DEFAULT '0' COMMENT '0: Normal | 1: Finalizado | 2: Anulación | 3: Reprogramación',
  `estado` int(11) NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `persona_id_created_at` int(11) NOT NULL,
  `persona_id_updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ev_programacion_id_idx` (`programacion_id`) USING BTREE,
  KEY `ev_tipo_evaluacion_idx` (`tipo_evaluacion_id`) USING BTREE,
  CONSTRAINT `v_evaluaciones_ibfk_1` FOREIGN KEY (`programacion_id`) REFERENCES `v_programaciones` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `v_evaluaciones_ibfk_2` FOREIGN KEY (`tipo_evaluacion_id`) REFERENCES `v_tipos_evaluaciones` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=54 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of v_evaluaciones
-- ----------------------------
INSERT INTO `v_evaluaciones` VALUES ('1', '13', '2', '2017-12-29', '2018-01-22', '2018-01-17', null, '', '0.00', '3', '1', '2018-01-04 17:40:40', '2018-01-17 16:48:53', '33', '33');
INSERT INTO `v_evaluaciones` VALUES ('2', '13', '3', '2017-12-29', '2018-01-22', '2018-01-16', null, '', '0.00', '3', '1', '2018-01-04 17:40:40', '2018-01-17 16:48:53', '33', '33');
INSERT INTO `v_evaluaciones` VALUES ('3', '13', '4', '2017-12-29', '2018-01-22', '2018-01-13', null, '', '0.00', '3', '1', '2018-01-04 17:40:40', '2018-01-16 15:30:39', '33', '33');
INSERT INTO `v_evaluaciones` VALUES ('4', '13', '1', '2017-12-30', '2018-01-22', '2018-01-13', null, '', '0.00', '3', '1', '2018-01-04 17:40:40', '2018-01-16 15:30:39', '33', '33');
INSERT INTO `v_evaluaciones` VALUES ('5', '15', '2', '2017-12-29', '2018-01-22', null, null, '', '0.00', '0', '1', '2018-01-04 17:42:58', '2018-01-04 17:43:06', '33', '33');
INSERT INTO `v_evaluaciones` VALUES ('6', '15', '3', '2017-12-29', '2018-01-22', null, null, '', '0.00', '0', '1', '2018-01-04 17:42:58', '2018-01-04 17:43:06', '33', '33');
INSERT INTO `v_evaluaciones` VALUES ('7', '15', '4', '2017-12-29', '2018-01-22', null, null, '', '0.00', '0', '1', '2018-01-04 17:42:58', '2018-01-04 17:43:06', '33', '33');
INSERT INTO `v_evaluaciones` VALUES ('8', '15', '1', '2017-12-30', '2018-01-22', null, null, '', '0.00', '0', '1', '2018-01-04 17:42:59', '2018-01-04 17:43:06', '33', '33');
INSERT INTO `v_evaluaciones` VALUES ('9', '13', '1', '2018-01-13', '2018-01-22', null, null, '', '0.00', '0', '1', '2018-01-13 21:54:51', '2018-01-13 21:54:51', '1', null);
INSERT INTO `v_evaluaciones` VALUES ('10', '13', '4', '2018-01-13', '2018-01-22', '2018-01-17', null, '', '0.00', '3', '1', '2018-01-13 22:05:59', '2018-01-17 16:52:38', '1', '1');
INSERT INTO `v_evaluaciones` VALUES ('11', '24', '2', '2017-12-29', '2018-01-22', null, null, '', '0.00', '0', '1', '2018-01-16 15:36:14', '2018-01-23 11:56:10', '34', '1');
INSERT INTO `v_evaluaciones` VALUES ('12', '24', '3', '2017-12-29', '2018-01-22', null, null, '', '0.00', '0', '1', '2018-01-16 15:36:14', '2018-01-23 11:56:10', '34', '1');
INSERT INTO `v_evaluaciones` VALUES ('13', '24', '4', '2017-12-29', '2018-01-22', null, null, '', '0.00', '0', '1', '2018-01-16 15:36:14', '2018-01-23 11:56:10', '34', '1');
INSERT INTO `v_evaluaciones` VALUES ('14', '24', '1', '2017-12-30', '2018-01-22', null, null, '', '0.00', '0', '1', '2018-01-16 15:36:14', '2018-01-23 11:56:10', '34', '1');
INSERT INTO `v_evaluaciones` VALUES ('15', '14', '2', '2017-12-29', '2018-01-22', '2018-01-17', null, '', '0.00', '3', '1', '2018-01-16 15:36:17', '2018-01-23 11:54:28', '34', '1');
INSERT INTO `v_evaluaciones` VALUES ('16', '14', '3', '2017-12-29', '2018-01-22', '2018-01-16', null, '', '0.00', '3', '1', '2018-01-16 15:36:17', '2018-01-23 11:54:28', '34', '1');
INSERT INTO `v_evaluaciones` VALUES ('17', '14', '4', '2017-12-29', '2018-01-22', '2018-01-16', null, '', '0.00', '1', '1', '2018-01-16 15:36:17', '2018-01-23 11:54:28', '34', '1');
INSERT INTO `v_evaluaciones` VALUES ('18', '14', '1', '2017-12-30', '2018-01-22', null, null, '', '0.00', '3', '1', '2018-01-16 15:36:17', '2018-01-23 11:54:28', '34', '1');
INSERT INTO `v_evaluaciones` VALUES ('19', '14', '4', '2018-01-16', '2018-01-22', null, null, '', '2.00', '1', '1', '2018-01-16 15:42:04', '2018-01-16 16:06:32', '1', '34');
INSERT INTO `v_evaluaciones` VALUES ('20', '16', '2', '2017-12-29', '2018-01-22', null, null, '', '0.00', '0', '1', '2018-01-16 15:42:40', '2018-01-23 11:56:07', '34', '1');
INSERT INTO `v_evaluaciones` VALUES ('21', '16', '3', '2017-12-29', '2018-01-22', null, null, '', '0.00', '0', '1', '2018-01-16 15:42:40', '2018-01-23 11:56:07', '34', '1');
INSERT INTO `v_evaluaciones` VALUES ('22', '16', '4', '2017-12-29', '2018-01-22', null, null, '', '0.00', '0', '1', '2018-01-16 15:42:40', '2018-01-23 11:56:07', '34', '1');
INSERT INTO `v_evaluaciones` VALUES ('23', '16', '1', '2017-12-30', '2018-01-22', null, null, '', '0.00', '0', '1', '2018-01-16 15:42:41', '2018-01-23 11:56:07', '34', '1');
INSERT INTO `v_evaluaciones` VALUES ('24', '26', '2', '2017-12-29', '2018-01-22', '2018-01-17', null, '', '0.00', '3', '1', '2018-01-16 15:42:47', '2018-01-17 13:01:29', '34', '1');
INSERT INTO `v_evaluaciones` VALUES ('25', '26', '3', '2017-12-29', '2018-01-22', '2018-01-17', null, '', '0.00', '3', '1', '2018-01-16 15:42:47', '2018-01-17 16:54:24', '34', '1');
INSERT INTO `v_evaluaciones` VALUES ('26', '26', '4', '2017-12-29', '2018-01-22', null, null, '', '0.00', '0', '1', '2018-01-16 15:42:47', '2018-01-16 15:50:00', '34', '34');
INSERT INTO `v_evaluaciones` VALUES ('27', '26', '1', '2017-12-30', '2018-01-22', null, null, '', '0.00', '0', '1', '2018-01-16 15:42:47', '2018-01-16 15:50:00', '34', '34');
INSERT INTO `v_evaluaciones` VALUES ('28', '22', '2', '2017-12-29', '2018-01-22', null, null, '', '0.00', '0', '1', '2018-01-16 15:50:02', '2018-01-23 11:56:10', '34', '1');
INSERT INTO `v_evaluaciones` VALUES ('29', '22', '3', '2017-12-29', '2018-01-22', null, null, '', '0.00', '0', '1', '2018-01-16 15:50:02', '2018-01-23 11:56:10', '34', '1');
INSERT INTO `v_evaluaciones` VALUES ('30', '22', '4', '2017-12-29', '2018-01-22', null, null, '', '0.00', '0', '1', '2018-01-16 15:50:02', '2018-01-23 11:56:10', '34', '1');
INSERT INTO `v_evaluaciones` VALUES ('31', '22', '1', '2017-12-30', '2018-01-22', null, null, '', '0.00', '0', '1', '2018-01-16 15:50:02', '2018-01-23 11:56:10', '34', '1');
INSERT INTO `v_evaluaciones` VALUES ('32', '18', '2', '2017-12-29', '2018-01-22', null, null, '', '0.00', '0', '1', '2018-01-16 16:41:46', '2018-01-23 11:56:06', '34', '1');
INSERT INTO `v_evaluaciones` VALUES ('33', '18', '3', '2017-12-29', '2018-01-22', null, null, '', '0.00', '0', '1', '2018-01-16 16:41:46', '2018-01-23 11:56:06', '34', '1');
INSERT INTO `v_evaluaciones` VALUES ('34', '18', '4', '2017-12-29', '2018-01-22', null, null, '', '0.00', '0', '1', '2018-01-16 16:41:46', '2018-01-23 11:56:06', '34', '1');
INSERT INTO `v_evaluaciones` VALUES ('35', '18', '1', '2017-12-30', '2018-01-22', null, null, '', '0.00', '0', '1', '2018-01-16 16:41:46', '2018-01-23 11:56:06', '34', '1');
INSERT INTO `v_evaluaciones` VALUES ('36', '14', '3', '2018-01-16', '2018-01-22', null, null, '', '5.00', '1', '1', '2018-01-16 17:15:44', '2018-01-16 17:16:12', '1', '34');
INSERT INTO `v_evaluaciones` VALUES ('37', '13', '3', '2018-01-16', '2018-01-22', '2018-01-17', null, '', '0.00', '3', '1', '2018-01-16 22:05:59', '2018-01-17 13:01:02', '1', '1');
INSERT INTO `v_evaluaciones` VALUES ('38', '20', '2', '2017-12-29', '2018-01-22', null, null, '', '0.00', '0', '1', '2018-01-17 12:58:50', '2018-01-23 11:56:09', '34', '1');
INSERT INTO `v_evaluaciones` VALUES ('39', '20', '3', '2017-12-29', '2018-01-22', null, null, '', '0.00', '0', '1', '2018-01-17 12:58:50', '2018-01-23 11:56:09', '34', '1');
INSERT INTO `v_evaluaciones` VALUES ('40', '20', '4', '2017-12-29', '2018-01-22', null, null, '', '0.00', '0', '1', '2018-01-17 12:58:50', '2018-01-23 11:56:09', '34', '1');
INSERT INTO `v_evaluaciones` VALUES ('41', '20', '1', '2017-12-30', '2018-01-22', null, null, '', '0.00', '0', '1', '2018-01-17 12:58:50', '2018-01-23 11:56:09', '34', '1');
INSERT INTO `v_evaluaciones` VALUES ('42', '13', '3', '2018-01-17', '2018-01-22', '2018-01-17', null, '', '0.00', '3', '1', '2018-01-17 13:01:02', '2018-01-17 16:54:24', '1', '1');
INSERT INTO `v_evaluaciones` VALUES ('43', '13', '2', '2018-01-17', '2018-01-22', null, null, '', '0.00', '0', '1', '2018-01-17 13:01:29', '2018-01-17 13:01:29', '1', null);
INSERT INTO `v_evaluaciones` VALUES ('44', '14', '2', '2018-01-17', '2018-01-22', '2018-01-18', null, '', '0.00', '3', '1', '2018-01-17 13:01:29', '2018-01-18 00:43:27', '1', '1');
INSERT INTO `v_evaluaciones` VALUES ('45', '26', '2', '2018-01-17', '2018-01-22', null, null, '', '0.00', '0', '1', '2018-01-17 13:01:29', '2018-01-17 13:01:29', '1', null);
INSERT INTO `v_evaluaciones` VALUES ('46', '13', '4', '2018-01-17', '2018-01-22', null, null, '', '0.00', '1', '1', '2018-01-17 16:52:38', '2018-01-17 16:54:50', '1', '33');
INSERT INTO `v_evaluaciones` VALUES ('47', '19', '2', '2017-12-29', '2018-01-22', null, null, '', '0.00', '0', '1', '2018-01-17 16:53:58', '2018-01-31 15:23:47', '33', '33');
INSERT INTO `v_evaluaciones` VALUES ('48', '19', '3', '2017-12-29', '2018-01-22', null, null, '', '0.00', '0', '1', '2018-01-17 16:53:58', '2018-01-31 15:23:47', '33', '33');
INSERT INTO `v_evaluaciones` VALUES ('49', '19', '4', '2017-12-29', '2018-01-22', null, null, '', '0.00', '0', '1', '2018-01-17 16:53:58', '2018-01-31 15:23:47', '33', '33');
INSERT INTO `v_evaluaciones` VALUES ('50', '19', '1', '2017-12-30', '2018-01-22', null, null, '', '0.00', '0', '1', '2018-01-17 16:53:58', '2018-01-31 15:23:47', '33', '33');
INSERT INTO `v_evaluaciones` VALUES ('51', '13', '3', '2018-01-17', '2018-01-22', null, null, '', '0.00', '1', '1', '2018-01-17 16:54:24', '2018-01-17 19:33:22', '1', '33');
INSERT INTO `v_evaluaciones` VALUES ('52', '26', '3', '2018-01-17', '2018-01-22', null, null, '', '0.00', '0', '1', '2018-01-17 16:54:24', '2018-01-17 16:54:24', '1', null);
INSERT INTO `v_evaluaciones` VALUES ('53', '14', '2', '2018-01-18', '2018-01-22', null, null, '', '0.00', '0', '1', '2018-01-18 00:43:27', '2018-01-18 00:43:27', '1', null);

-- ----------------------------
-- Table structure for v_evaluaciones_detalle
-- ----------------------------
DROP TABLE IF EXISTS `v_evaluaciones_detalle`;
CREATE TABLE `v_evaluaciones_detalle` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `evaluacion_id` int(11) NOT NULL,
  `pregunta_id` int(11) NOT NULL,
  `respuesta_id` int(11) NOT NULL,
  `texto_rpta` varchar(500) DEFAULT NULL,
  `porcentaje` decimal(10,2) DEFAULT NULL,
  `puntaje` decimal(10,2) DEFAULT NULL,
  `estado` int(11) NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `persona_id_created_at` int(11) NOT NULL,
  `persona_id_updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ed_evaluacion_id_idx` (`evaluacion_id`) USING BTREE,
  KEY `ed_pregunta_id_idx` (`pregunta_id`) USING BTREE,
  KEY `ed_respuesta_id_idx` (`respuesta_id`) USING BTREE,
  CONSTRAINT `v_evaluaciones_detalle_ibfk_1` FOREIGN KEY (`evaluacion_id`) REFERENCES `v_evaluaciones` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `v_evaluaciones_detalle_ibfk_2` FOREIGN KEY (`pregunta_id`) REFERENCES `v_preguntas` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `v_evaluaciones_detalle_ibfk_3` FOREIGN KEY (`respuesta_id`) REFERENCES `v_respuestas` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of v_evaluaciones_detalle
-- ----------------------------
INSERT INTO `v_evaluaciones_detalle` VALUES ('1', '19', '7', '11', null, null, '1.00', '1', '2018-01-16 16:06:31', '2018-01-16 16:06:31', '34', null);
INSERT INTO `v_evaluaciones_detalle` VALUES ('2', '19', '4', '5', null, null, '1.00', '1', '2018-01-16 16:06:32', '2018-01-16 16:06:32', '34', null);
INSERT INTO `v_evaluaciones_detalle` VALUES ('3', '36', '8', '14', null, null, '0.00', '1', '2018-01-16 17:16:12', '2018-01-16 17:16:12', '34', null);
INSERT INTO `v_evaluaciones_detalle` VALUES ('4', '36', '10', '17', null, null, '5.00', '1', '2018-01-16 17:16:12', '2018-01-16 17:16:12', '34', null);
INSERT INTO `v_evaluaciones_detalle` VALUES ('5', '46', '5', '8', null, null, '0.00', '1', '2018-01-17 16:52:53', '2018-01-17 16:52:53', '33', null);
INSERT INTO `v_evaluaciones_detalle` VALUES ('6', '46', '6', '9', null, null, '1.00', '1', '2018-01-17 16:52:53', '2018-01-17 16:52:53', '33', null);
INSERT INTO `v_evaluaciones_detalle` VALUES ('7', '46', '6', '10', null, null, '0.00', '1', '2018-01-17 16:54:50', '2018-01-17 16:54:50', '33', null);
INSERT INTO `v_evaluaciones_detalle` VALUES ('8', '51', '11', '20', null, null, '0.00', '1', '2018-01-17 19:33:22', '2018-01-17 19:33:22', '33', null);

-- ----------------------------
-- Table structure for v_personas
-- ----------------------------
DROP TABLE IF EXISTS `v_personas`;
CREATE TABLE `v_personas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `dni` varchar(8) NOT NULL,
  `paterno` varchar(50) DEFAULT NULL,
  `materno` varchar(50) DEFAULT NULL,
  `nombre` varchar(80) DEFAULT NULL,
  `sexo` char(1) DEFAULT '',
  `email` varchar(100) DEFAULT '',
  `password` varchar(100) DEFAULT '',
  `remember_token` varchar(100) DEFAULT '',
  `foto` varchar(100) DEFAULT '',
  `telefono` text,
  `celular` text,
  `fecha_nacimiento` date DEFAULT NULL,
  `estado` int(11) NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `persona_id_created_at` int(11) NOT NULL,
  `persona_id_updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of v_personas
-- ----------------------------
INSERT INTO `v_personas` VALUES ('1', '12312312', 'Luna', 'Galvez', 'Juan', 'M', '', '$2y$10$GbcNEAXRTarkHEU/diSbA.vNd5eipLoV5f2RMpr5piMcJZb3NxIhK', '9RlshHPOoVNEtAKaKHzPHLt5LCXxYQN0U5xxWueBtsV6Q4CQtudUqSlRrMXd', '', null, null, null, '1', '2017-10-31 12:35:14', null, '1', null);
INSERT INTO `v_personas` VALUES ('6', '11111111', 'Palote', 'Palon', 'Pepito', '', '', '', '', '', null, null, null, '1', '2017-09-28 17:50:46', '2017-09-28 17:50:46', '1', null);
INSERT INTO `v_personas` VALUES ('7', '22222222', 'Flor', 'Del Campo', 'Rosa Margarita', '', '', '', '', '', null, null, null, '1', '2017-09-28 17:50:46', '2017-09-28 17:50:46', '1', null);
INSERT INTO `v_personas` VALUES ('9', '46487881', 'Arteaga', 'Gamarra', 'Rusbel', '', '', '', '', '', null, null, null, '1', '2017-10-30 10:33:04', '2017-10-30 10:33:04', '1', null);
INSERT INTO `v_personas` VALUES ('10', '12345678', 'Ape', 'Mat', 'Frida', '', '', '', '', '', null, null, null, '1', '2017-10-30 10:37:28', '2017-10-30 10:37:28', '1', null);
INSERT INTO `v_personas` VALUES ('11', '33333333', 'Pat 1', 'Mat 1', 'Minatomon', 'M', '', '$2y$10$tgyvug2.67XPAqa/XXedq..LRSfDNBOkd1n.vBDxqIaiwqMLzTybC', 'kGHlwgkKvceFlGM0FqNPhqiNlawZZ66HmGEhqdxjZ9qnGfLlIET3Iu9AL7JY', '', null, null, null, '1', '2017-10-31 12:53:13', '2017-10-31 12:53:13', '1', null);
INSERT INTO `v_personas` VALUES ('12', '12341234', 'Alvitez', 'Perez', 'Rocio', 'M', '', '$2y$10$jd6qVIMfdON5.LRTlW7qbujw8IuaZa8etSV0gwcBwRa4b8HYIESxe', 'HdVj14n5Ekpmzt8QEJPuLxIma9T7deB6BFSIQVshEAH5deJeZZUeL53Z29Qz', '', null, null, null, '1', '2017-10-31 13:01:07', '2017-11-20 16:55:39', '1', '1');
INSERT INTO `v_personas` VALUES ('13', '12344321', 'Arteaga', 'Gamarra', 'Rusbel', '', '', '', '', '', null, null, null, '1', '2017-10-31 13:01:55', '2017-10-31 14:18:24', '1', '1');
INSERT INTO `v_personas` VALUES ('14', '40203145', 'Camonez', 'Belen', 'Elena', 'M', '', '', '00qwEyGoFBMpHq0mcfyY1P5eDZCDSVWtMQk8ZK3AwaYqwCANPXGxZ40Pk8cW', '', null, null, null, '1', '2017-10-31 14:18:23', '2017-12-07 09:35:40', '1', '1');
INSERT INTO `v_personas` VALUES ('15', '99991111', 'Perico', 'Palotes', 'prueba', 'M', '', '$2y$10$0GIVRCT9m6XAsIMkcUsvR.OivI2ihGOXDCc9sdGjb.8srrcNfDukK', '', '', null, null, null, '1', '2017-10-31 16:18:23', '2017-10-31 16:18:23', '1', null);
INSERT INTO `v_personas` VALUES ('16', '12341231', 'Perico', 'Palotes', 'prueba', 'M', '', '$2y$10$tNJzn2K./bVHYqlmo3Pz0enB/3w/a/81Tp4rr28AQIOfXolUtqnHe', '', '', null, null, null, '1', '2017-11-13 00:45:39', '2017-11-13 00:45:39', '1', null);
INSERT INTO `v_personas` VALUES ('17', '12341230', 'Perico', 'Palotes', 'prueba', 'M', '', '$2y$10$cq0jtLqxkENQqyAdiSWRAec7rVCcpGUPoGNQ8tnvAVDj/Z9Ist02W', '', '', null, null, null, '1', '2017-11-13 00:46:37', '2017-11-13 00:46:37', '1', null);
INSERT INTO `v_personas` VALUES ('18', '99999999', 'Tinco', 'Cahuana', 'Salvador', 'M', '', '$2y$10$RJackFYmgOhBTHbc.Y3ms.qoBnuT8r3QJgl4zx.r4hJ915pnPPLWa', '', '', null, null, null, '1', '2017-11-13 12:51:10', '2017-12-04 15:38:51', '1', '1');
INSERT INTO `v_personas` VALUES ('19', '88888888', 'Vidal', 'Sanchez', 'Maria', 'F', '', '$2y$10$3OcaWDvXd1JrFUaij8MPUu769MyusT6EXSYhhJkWWkYCplgKtZsRa', '', '', null, null, null, '1', '2017-11-13 12:58:30', '2017-12-04 15:38:51', '1', '1');
INSERT INTO `v_personas` VALUES ('20', '88888888', 'la', 'flaca', 'de gpip', 'F', '', '$2y$10$D4fn9EwqwUwGFs5L7FqJlO03A5BCME6srLFPPRmWrzzUVlxgblL.S', '', '', null, null, null, '1', '2017-11-13 12:58:30', '2017-11-13 12:58:30', '1', null);
INSERT INTO `v_personas` VALUES ('21', '34567895', 'Paez', 'Vallejo', 'Hecthor', '', '', '', '', '', null, null, null, '1', '2017-11-13 17:26:36', '2017-12-04 15:38:51', '1', '1');
INSERT INTO `v_personas` VALUES ('22', '67456765', 'gds', 'ffff', 'jjhj', '', '', '', '', '', null, null, null, '0', '2017-11-13 17:32:15', '2017-11-13 17:33:24', '1', '1');
INSERT INTO `v_personas` VALUES ('23', '67456795', 'gg', 'gg', 'gg', '', '', '', '', '', null, null, null, '0', '2017-11-17 11:31:38', '2017-11-17 11:31:38', '1', null);
INSERT INTO `v_personas` VALUES ('24', '67456725', 'a', 'a', 'a', '', '', '', '', '', null, null, null, '0', '2017-11-17 11:32:48', '2017-11-17 11:33:57', '1', '1');
INSERT INTO `v_personas` VALUES ('25', '67456825', 'ab', 'ab', 'ab', '', '', '', '', '', null, null, null, '0', '2017-11-17 11:35:15', '2017-11-17 11:53:47', '1', '1');
INSERT INTO `v_personas` VALUES ('26', '67456525', 'Garcia', 'Rodriguez', 'Luis', '', '', '', '6tV4FzgnvU6uQq7dIJyoey4nKw4DJH7TkfjjIUlEvJe98BuBYtMwyh7JwrvO', '', null, null, null, '1', '2017-11-17 12:13:59', '2017-12-04 15:38:51', '1', '1');
INSERT INTO `v_personas` VALUES ('27', '40404040', 'Aguilar', 'Ore', 'Maria Angelica', '', '', '', 'VluD0pe1a3oMhXNhjSvFgAtmESNQb9ec9nc5Icl2uRL36glIunxrMncHFhU1', '', null, null, null, '1', '2017-12-19 10:49:09', '2018-03-08 17:11:53', '1', '1');
INSERT INTO `v_personas` VALUES ('28', '40404041', 'Luis German', 'Jauregui', 'del Aguila', '', '', '', '', '', null, null, null, '1', '2017-12-19 10:49:09', '2017-12-19 10:53:37', '1', '1');
INSERT INTO `v_personas` VALUES ('29', '40404042', 'Fernando', 'Loyola', 'Fernandez', '', '', '', '', '', null, null, null, '1', '2017-12-19 10:49:09', '2017-12-19 10:53:37', '1', '1');
INSERT INTO `v_personas` VALUES ('30', '40404043', 'Lidia', 'Madera', 'Jauregui', '', '', '', '', '', null, null, null, '1', '2017-12-19 10:49:10', '2017-12-19 10:53:37', '1', '1');
INSERT INTO `v_personas` VALUES ('31', '40404044', 'Franklin', 'Valdiviezo', 'Cornetero', '', '', '', '', '', null, null, null, '1', '2017-12-19 10:49:10', '2017-12-19 10:53:37', '1', '1');
INSERT INTO `v_personas` VALUES ('32', '40404045', 'Hayde', 'Levano', 'Ochoa', '', '', '', '', '', null, null, null, '1', '2017-12-19 10:49:10', '2017-12-19 10:53:37', '1', '1');
INSERT INTO `v_personas` VALUES ('33', '70568567', 'Mendoza', 'Moreno', 'Raul', '', '', '', 'PIhgWGp55oaQGidJtxzTSqxROmvmeJH2dKuiLdz06DEB6YWhuygLynHzHPhU', '', null, null, null, '1', '2017-12-19 17:10:46', '2018-02-01 09:34:36', '1', '1');
INSERT INTO `v_personas` VALUES ('34', '70596845', 'Chavez', 'Sipriano', 'Fredy', '', '', '', 'OUbles5Lba8CNXzE9OvGYaZWy42JuhHr0ycSXiJJyRqBFl49Up7HJSadwoyD', '', null, null, null, '1', '2017-12-19 17:10:46', '2018-02-01 09:34:36', '1', '1');

-- ----------------------------
-- Table structure for v_preguntas
-- ----------------------------
DROP TABLE IF EXISTS `v_preguntas`;
CREATE TABLE `v_preguntas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `curso_id` int(11) NOT NULL,
  `unidad_contenido_id` int(11) NOT NULL,
  `pregunta` varchar(250) NOT NULL DEFAULT '',
  `imagen` varchar(100) DEFAULT NULL,
  `puntaje` decimal(10,2) NOT NULL DEFAULT '1.00',
  `estado` int(11) NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `persona_id_created_at` int(11) NOT NULL,
  `persona_id_updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `pre_curso_id_idx` (`curso_id`) USING BTREE,
  KEY `pre_tipo_evaluacion_id_idx` (`unidad_contenido_id`) USING BTREE,
  CONSTRAINT `v_preguntas_ibfk_1` FOREIGN KEY (`curso_id`) REFERENCES `v_cursos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `v_preguntas_ibfk_2` FOREIGN KEY (`unidad_contenido_id`) REFERENCES `v_unidades_contenido` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of v_preguntas
-- ----------------------------
INSERT INTO `v_preguntas` VALUES ('4', '108', '6', '¿Que es la Comunicación ?', '1.jpg', '1.00', '1', '2017-09-25 16:33:09', '2018-01-28 16:40:24', '1', '1');
INSERT INTO `v_preguntas` VALUES ('5', '108', '4', '¿Para que sirve la Comunicación?', '2.jpg', '1.00', '1', '2017-09-25 19:10:35', '2018-01-28 16:46:51', '1', '1');
INSERT INTO `v_preguntas` VALUES ('6', '108', '4', '¿Mencionar los elementos de la comunicación?', null, '1.00', '1', '2017-12-07 11:07:38', '2018-01-28 16:45:17', '1', '1');
INSERT INTO `v_preguntas` VALUES ('7', '108', '4', 'Qué es lo más resaltante de los elementos de la comunicación', null, '1.00', '1', '2017-12-26 10:20:35', '2018-01-28 16:45:27', '0', '1');
INSERT INTO `v_preguntas` VALUES ('8', '108', '3', 'Pregunta de examen parcial numero 1', 'L1T1LL.png', '1.00', '1', '2018-01-16 17:11:13', '2018-01-28 16:49:40', '1', '1');
INSERT INTO `v_preguntas` VALUES ('9', '108', '3', 'Pregunta de examen parcial numero 2', 'gaa.jpg', '1.00', '1', '2018-01-16 17:11:31', '2018-01-28 16:51:40', '1', '1');
INSERT INTO `v_preguntas` VALUES ('10', '108', '3', 'Pregunta de examen parcial numero 3', null, '1.00', '1', '2018-01-16 17:11:43', '2018-01-28 16:50:31', '1', '1');
INSERT INTO `v_preguntas` VALUES ('11', '108', '3', 'Pregunta de examen parcial numero 4', '2.jpg', '1.00', '1', '2018-01-16 17:11:57', '2018-01-28 16:50:42', '1', '1');
INSERT INTO `v_preguntas` VALUES ('12', '108', '2', 'prueba', null, '1.00', '1', '2018-01-18 15:58:05', '2018-01-18 15:58:05', '1', null);
INSERT INTO `v_preguntas` VALUES ('13', '1', '2', 'p1', null, '1.00', '1', '2018-01-22 22:54:21', '2018-01-28 16:22:48', '1', '1');
INSERT INTO `v_preguntas` VALUES ('14', '1', '3', 'p2', null, '1.00', '1', '2018-01-22 22:54:21', '2018-01-22 22:54:21', '1', null);
INSERT INTO `v_preguntas` VALUES ('15', '1', '2', 'pruebá con tílde', null, '1.00', '1', '2018-01-28 12:31:39', '2018-01-28 12:31:39', '1', null);
INSERT INTO `v_preguntas` VALUES ('16', '1', '3', 'p2', null, '1.00', '1', '2018-01-28 12:31:40', '2018-01-28 12:31:40', '1', null);

-- ----------------------------
-- Table structure for v_programaciones
-- ----------------------------
DROP TABLE IF EXISTS `v_programaciones`;
CREATE TABLE `v_programaciones` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `programacion_externo_id` int(11) NOT NULL,
  `programacion_unica_id` int(11) NOT NULL,
  `persona_id` int(11) NOT NULL COMMENT 'Alumno Asignado',
  `estado` int(11) NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `persona_id_created_at` int(11) NOT NULL,
  `persona_id_updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `p_persona_id_idx` (`persona_id`) USING BTREE,
  KEY `p_programacion_unica_id_idx` (`programacion_unica_id`) USING BTREE,
  CONSTRAINT `v_programaciones_ibfk_1` FOREIGN KEY (`persona_id`) REFERENCES `v_personas` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `v_programaciones_ibfk_2` FOREIGN KEY (`programacion_unica_id`) REFERENCES `v_programaciones_unicas` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of v_programaciones
-- ----------------------------
INSERT INTO `v_programaciones` VALUES ('1', '1', '4', '10', '0', '2017-10-30 10:37:28', '2017-10-31 10:28:44', '1', null);
INSERT INTO `v_programaciones` VALUES ('2', '2', '5', '12', '1', '2017-10-31 13:01:55', '2017-10-31 13:01:55', '1', null);
INSERT INTO `v_programaciones` VALUES ('3', '3', '7', '12', '1', '2017-10-31 14:18:24', '2017-10-31 14:18:24', '1', null);
INSERT INTO `v_programaciones` VALUES ('4', '7', '5', '18', '1', '2017-11-13 12:53:53', '2017-11-13 12:53:53', '1', null);
INSERT INTO `v_programaciones` VALUES ('5', '8', '5', '19', '0', '2017-11-13 12:59:27', '2017-12-19 17:05:20', '1', null);
INSERT INTO `v_programaciones` VALUES ('6', '9', '5', '21', '1', '2017-11-13 17:26:36', '2017-11-13 17:26:36', '1', null);
INSERT INTO `v_programaciones` VALUES ('7', '10', '5', '22', '0', '2017-11-13 17:32:15', '2017-11-13 17:32:15', '1', null);
INSERT INTO `v_programaciones` VALUES ('8', '11', '5', '23', '0', '2017-11-17 11:31:38', '2017-11-17 11:31:38', '1', null);
INSERT INTO `v_programaciones` VALUES ('9', '12', '5', '24', '0', '2017-11-17 11:32:48', '2017-11-17 11:32:48', '1', null);
INSERT INTO `v_programaciones` VALUES ('10', '13', '5', '24', '0', '2017-11-17 11:34:08', '2017-11-17 11:34:08', '1', null);
INSERT INTO `v_programaciones` VALUES ('11', '14', '5', '25', '0', '2017-11-17 11:35:15', '2017-11-17 11:35:15', '1', null);
INSERT INTO `v_programaciones` VALUES ('12', '15', '5', '26', '1', '2017-11-17 12:13:59', '2017-11-17 12:13:59', '1', null);
INSERT INTO `v_programaciones` VALUES ('13', '16', '4', '33', '1', '2017-12-19 17:56:38', '2017-12-19 17:56:38', '1', null);
INSERT INTO `v_programaciones` VALUES ('14', '17', '4', '34', '1', '2017-12-19 17:56:38', '2018-01-17 16:55:26', '1', null);
INSERT INTO `v_programaciones` VALUES ('15', '18', '5', '33', '1', '2017-12-19 18:13:01', '2017-12-19 18:13:01', '1', null);
INSERT INTO `v_programaciones` VALUES ('16', '19', '5', '34', '1', '2017-12-19 18:13:01', '2017-12-19 18:13:01', '1', null);
INSERT INTO `v_programaciones` VALUES ('17', '20', '6', '33', '1', '2017-12-19 18:14:12', '2017-12-19 18:14:12', '1', null);
INSERT INTO `v_programaciones` VALUES ('18', '21', '6', '34', '1', '2017-12-19 18:14:12', '2017-12-19 18:14:12', '1', null);
INSERT INTO `v_programaciones` VALUES ('19', '22', '7', '33', '1', '2017-12-19 18:15:43', '2017-12-19 18:15:43', '1', null);
INSERT INTO `v_programaciones` VALUES ('20', '23', '7', '34', '1', '2017-12-19 18:15:43', '2017-12-19 18:15:43', '1', null);
INSERT INTO `v_programaciones` VALUES ('21', '24', '8', '33', '1', '2017-12-19 18:16:49', '2017-12-19 18:16:49', '1', null);
INSERT INTO `v_programaciones` VALUES ('22', '25', '8', '34', '1', '2017-12-19 18:16:49', '2017-12-19 18:16:49', '1', null);
INSERT INTO `v_programaciones` VALUES ('23', '26', '9', '33', '1', '2017-12-19 18:18:05', '2017-12-19 18:18:05', '1', null);
INSERT INTO `v_programaciones` VALUES ('24', '27', '9', '34', '1', '2017-12-19 18:18:05', '2017-12-19 18:18:05', '1', null);
INSERT INTO `v_programaciones` VALUES ('25', '6', '4', '33', '0', '2017-12-20 14:32:24', '2018-01-17 13:00:30', '1', null);
INSERT INTO `v_programaciones` VALUES ('26', '6', '4', '34', '0', '2017-12-20 14:32:24', '2018-01-17 13:00:30', '1', null);

-- ----------------------------
-- Table structure for v_programaciones_unicas
-- ----------------------------
DROP TABLE IF EXISTS `v_programaciones_unicas`;
CREATE TABLE `v_programaciones_unicas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `curso_id` int(11) NOT NULL,
  `persona_id` int(11) NOT NULL COMMENT 'Es el docente asignado',
  `programacion_unica_externo_id` int(11) NOT NULL,
  `semestre` varchar(20) DEFAULT NULL,
  `ciclo` varchar(20) DEFAULT NULL,
  `carrera` varchar(100) DEFAULT NULL,
  `fecha_inicio` datetime DEFAULT NULL,
  `fecha_final` datetime DEFAULT NULL,
  `plantilla` int(11) DEFAULT '0' COMMENT '1: Plantilla para replicar | 0: No es plantilla',
  `estado` int(11) NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `persona_id_created_at` int(11) NOT NULL,
  `persona_id_updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `pu_curso_id_idx` (`curso_id`) USING BTREE,
  KEY `pu_persona_id_idx` (`persona_id`) USING BTREE,
  CONSTRAINT `v_programaciones_unicas_ibfk_1` FOREIGN KEY (`curso_id`) REFERENCES `v_cursos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `v_programaciones_unicas_ibfk_2` FOREIGN KEY (`persona_id`) REFERENCES `v_personas` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of v_programaciones_unicas
-- ----------------------------
INSERT INTO `v_programaciones_unicas` VALUES ('4', '108', '27', '1', '2017 - I', 'I', 'Contabilidad y Finanzas', '2017-10-20 06:07:45', '2017-10-31 15:00:12', '0', '1', '2017-10-30 10:33:04', '2018-03-08 15:52:59', '1', '1');
INSERT INTO `v_programaciones_unicas` VALUES ('5', '110', '28', '2', '2017 - I', 'I', 'Contabilidad y Finanzas', '2017-10-20 06:07:45', '2017-10-31 15:00:12', '0', '1', '2017-10-31 13:01:55', '2018-03-08 15:51:52', '1', '1');
INSERT INTO `v_programaciones_unicas` VALUES ('6', '111', '29', '3', '2017 - I', 'I', 'Contabilidad y Finanzas', '2017-10-20 06:07:45', '2017-10-31 15:00:12', '0', '1', '2017-10-31 14:18:24', '2018-03-09 11:32:37', '1', '1');
INSERT INTO `v_programaciones_unicas` VALUES ('7', '112', '30', '4', '2017 - I', 'I', 'Contabilidad y Finanzas', '2017-10-20 06:07:45', '2017-10-31 15:00:12', '0', '1', '2017-11-17 09:57:19', '2018-03-09 08:40:44', '1', '1');
INSERT INTO `v_programaciones_unicas` VALUES ('8', '113', '31', '5', '2017 - I', 'I', 'Contabilidad y Finanzas', '2017-10-20 06:07:45', '2017-10-31 15:00:12', '0', '1', '2017-11-17 09:57:19', '2018-03-08 16:03:35', '1', '1');
INSERT INTO `v_programaciones_unicas` VALUES ('9', '114', '32', '6', '2017 - I', 'I', 'Contabilidad y Finanzas', '2017-10-20 06:07:45', '2017-10-31 15:00:12', '1', '1', '2017-12-19 10:49:10', '2018-03-09 15:13:05', '1', '1');

-- ----------------------------
-- Table structure for v_reprogramacion_masiva
-- ----------------------------
DROP TABLE IF EXISTS `v_reprogramacion_masiva`;
CREATE TABLE `v_reprogramacion_masiva` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `programacion_unica_id` int(11) NOT NULL,
  `condicional_id` int(11) NOT NULL,
  `condicional_nota` decimal(10,2) NOT NULL DEFAULT '0.00',
  `fecha_reprogramada` date NOT NULL,
  `estado` int(11) NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `persona_id_created_at` int(11) NOT NULL,
  `persona_id_updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `rm_programacion_unica_id_idx` (`programacion_unica_id`) USING BTREE,
  KEY `rm_condicional_id_idx` (`condicional_id`) USING BTREE,
  CONSTRAINT `v_reprogramacion_masiva_ibfk_1` FOREIGN KEY (`condicional_id`) REFERENCES `v_condicionales` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `v_reprogramacion_masiva_ibfk_2` FOREIGN KEY (`programacion_unica_id`) REFERENCES `v_programaciones_unicas` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of v_reprogramacion_masiva
-- ----------------------------

-- ----------------------------
-- Table structure for v_respuestas
-- ----------------------------
DROP TABLE IF EXISTS `v_respuestas`;
CREATE TABLE `v_respuestas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pregunta_id` int(11) NOT NULL,
  `tipo_respuesta_id` int(11) NOT NULL,
  `respuesta` varchar(300) NOT NULL DEFAULT '',
  `puntaje` decimal(10,2) NOT NULL DEFAULT '0.00',
  `correcto` int(11) DEFAULT NULL COMMENT '1: correcta | 0 : no correcta',
  `estado` int(11) NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `persona_id_created_at` int(11) NOT NULL,
  `persona_id_updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `re_pregunta_id_idx` (`pregunta_id`) USING BTREE,
  KEY `re_tipo_respuesta_id_idx` (`tipo_respuesta_id`) USING BTREE,
  CONSTRAINT `v_respuestas_ibfk_1` FOREIGN KEY (`pregunta_id`) REFERENCES `v_preguntas` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `v_respuestas_ibfk_2` FOREIGN KEY (`tipo_respuesta_id`) REFERENCES `v_tipos_respuestas` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of v_respuestas
-- ----------------------------
INSERT INTO `v_respuestas` VALUES ('5', '4', '1', 'faa', '1.00', '1', '1', '2017-12-07 11:07:24', '2018-01-18 16:23:47', '1', '1');
INSERT INTO `v_respuestas` VALUES ('6', '4', '1', 'Nueva Rpta', '1.00', '0', '1', '2017-12-07 11:26:13', '2018-01-18 16:25:05', '1', '1');
INSERT INTO `v_respuestas` VALUES ('7', '5', '1', 'Alternativa 1', '1.00', null, '1', '2017-12-26 11:20:38', '2017-12-26 11:20:38', '1', null);
INSERT INTO `v_respuestas` VALUES ('8', '5', '1', 'Alternativa 2', '0.00', null, '1', '2017-12-26 11:20:47', '2017-12-26 11:20:47', '1', null);
INSERT INTO `v_respuestas` VALUES ('9', '6', '1', 'Alternativa 1', '1.00', null, '1', '2017-12-26 11:20:55', '2017-12-26 11:20:55', '1', null);
INSERT INTO `v_respuestas` VALUES ('10', '6', '1', 'Alternativa 2', '0.00', null, '1', '2017-12-26 11:21:04', '2017-12-26 11:21:04', '1', null);
INSERT INTO `v_respuestas` VALUES ('11', '7', '1', 'Alternativa 1', '1.00', null, '1', '2017-12-26 11:21:14', '2017-12-26 11:21:14', '1', null);
INSERT INTO `v_respuestas` VALUES ('12', '7', '1', 'Alternativa 2', '0.00', null, '1', '2017-12-26 11:21:21', '2017-12-26 11:21:21', '1', null);
INSERT INTO `v_respuestas` VALUES ('13', '8', '1', 'alternativa 1 de pregunta 1', '5.00', null, '1', '2018-01-16 17:12:25', '2018-01-16 17:12:25', '1', null);
INSERT INTO `v_respuestas` VALUES ('14', '8', '1', 'alternativa 2 de pregunta 1', '0.00', null, '1', '2018-01-16 17:12:38', '2018-01-16 17:12:38', '1', null);
INSERT INTO `v_respuestas` VALUES ('15', '9', '1', 'alternativa 1 de pregunta 2', '1.00', '1', '1', '2018-01-16 17:12:53', '2018-01-25 10:10:48', '1', '1');
INSERT INTO `v_respuestas` VALUES ('16', '9', '1', 'alternativa 2 de pregunta 2', '1.00', '0', '1', '2018-01-16 17:13:03', '2018-01-25 10:10:54', '1', '1');
INSERT INTO `v_respuestas` VALUES ('17', '10', '1', 'alternativa 1 de pregunta 3', '5.00', null, '1', '2018-01-16 17:13:26', '2018-01-16 17:13:26', '1', null);
INSERT INTO `v_respuestas` VALUES ('18', '10', '1', 'alternativa 2 de pregunta 3', '0.00', null, '1', '2018-01-16 17:13:38', '2018-01-16 17:13:38', '1', null);
INSERT INTO `v_respuestas` VALUES ('19', '11', '1', 'alternativa 1 de pregunta 4', '5.00', null, '1', '2018-01-16 17:13:55', '2018-01-16 17:13:55', '1', null);
INSERT INTO `v_respuestas` VALUES ('20', '11', '1', 'alternativa 2 de pregunta 4', '0.00', null, '1', '2018-01-16 17:14:08', '2018-01-16 17:14:08', '1', null);
INSERT INTO `v_respuestas` VALUES ('21', '13', '1', 'res1', '1.00', '1', '1', '2018-01-22 22:54:21', '2018-01-22 22:54:21', '1', null);
INSERT INTO `v_respuestas` VALUES ('22', '13', '1', 'res2', '1.00', '0', '1', '2018-01-22 22:54:21', '2018-01-22 22:54:21', '1', null);
INSERT INTO `v_respuestas` VALUES ('23', '13', '1', 'res3', '1.00', '0', '1', '2018-01-22 22:54:21', '2018-01-22 22:54:21', '1', null);
INSERT INTO `v_respuestas` VALUES ('24', '14', '1', 'res1', '1.00', '0', '1', '2018-01-22 22:54:21', '2018-01-22 22:54:21', '1', null);
INSERT INTO `v_respuestas` VALUES ('25', '14', '1', 'res2', '1.00', '1', '1', '2018-01-22 22:54:21', '2018-01-22 22:54:21', '1', null);
INSERT INTO `v_respuestas` VALUES ('26', '15', '1', 'rés ré 1', '1.00', '1', '1', '2018-01-28 12:31:39', '2018-01-28 12:31:39', '1', null);
INSERT INTO `v_respuestas` VALUES ('27', '15', '1', 'res2', '1.00', '0', '1', '2018-01-28 12:31:40', '2018-01-28 12:31:40', '1', null);
INSERT INTO `v_respuestas` VALUES ('28', '15', '1', 'res3', '1.00', '0', '1', '2018-01-28 12:31:40', '2018-01-28 12:31:40', '1', null);
INSERT INTO `v_respuestas` VALUES ('29', '16', '1', 'res1', '1.00', '0', '1', '2018-01-28 12:31:40', '2018-01-28 12:31:40', '1', null);
INSERT INTO `v_respuestas` VALUES ('30', '16', '1', 'res2', '1.00', '1', '1', '2018-01-28 12:31:40', '2018-01-28 12:31:40', '1', null);

-- ----------------------------
-- Table structure for v_tipos_evaluaciones
-- ----------------------------
DROP TABLE IF EXISTS `v_tipos_evaluaciones`;
CREATE TABLE `v_tipos_evaluaciones` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tipo_evaluacion` varchar(200) DEFAULT NULL,
  `tipo_evaluacion_externo_id` int(11) DEFAULT NULL,
  `estado` int(11) NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `persona_id_created_at` int(11) NOT NULL,
  `persona_id_updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of v_tipos_evaluaciones
-- ----------------------------
INSERT INTO `v_tipos_evaluaciones` VALUES ('1', 'PRÁCTICA CALIFICADA II', '4', '1', '2017-09-25 16:34:36', '2017-12-11 20:26:11', '1', '1');
INSERT INTO `v_tipos_evaluaciones` VALUES ('2', 'P.C.1', '1', '1', '2017-12-07 10:56:43', '2017-12-12 11:46:03', '1', '1');
INSERT INTO `v_tipos_evaluaciones` VALUES ('3', 'Examen Parcial', '2', '1', '2017-12-07 10:56:43', '2017-12-07 10:56:43', '1', null);
INSERT INTO `v_tipos_evaluaciones` VALUES ('4', 'Examen Final', '3', '1', '2017-12-07 10:56:43', '2018-01-17 22:09:11', '1', '1');

-- ----------------------------
-- Table structure for v_tipos_respuestas
-- ----------------------------
DROP TABLE IF EXISTS `v_tipos_respuestas`;
CREATE TABLE `v_tipos_respuestas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tipo_respuesta` varchar(200) NOT NULL DEFAULT '',
  `estado` int(11) NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `persona_id_created_at` int(11) NOT NULL,
  `persona_id_updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of v_tipos_respuestas
-- ----------------------------
INSERT INTO `v_tipos_respuestas` VALUES ('1', 'Tipo respuesta default', '1', '2017-12-07 11:07:00', null, '1', null);

-- ----------------------------
-- Table structure for v_unidades_contenido
-- ----------------------------
DROP TABLE IF EXISTS `v_unidades_contenido`;
CREATE TABLE `v_unidades_contenido` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `unidad_contenido` varchar(150) NOT NULL,
  `foto` varchar(100) DEFAULT NULL,
  `estado` int(11) NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `persona_id_created_at` int(11) NOT NULL,
  `persona_id_updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of v_unidades_contenido
-- ----------------------------
INSERT INTO `v_unidades_contenido` VALUES ('1', 'Portada', 'SASASASA.png', '1', '2017-12-09 01:12:40', '2017-12-20 15:56:45', '1', '1');
INSERT INTO `v_unidades_contenido` VALUES ('2', 'Unidad I', 'unidad i.png', '1', '2017-12-12 11:50:50', '2017-12-14 13:34:47', '0', '1');
INSERT INTO `v_unidades_contenido` VALUES ('3', 'Unidad II', 'unidad ii.png', '1', '2017-12-12 11:50:54', '2017-12-14 13:34:55', '0', '1');
INSERT INTO `v_unidades_contenido` VALUES ('4', 'Unidad III', 'unidad iii.png', '1', '2017-12-11 17:53:22', '2017-12-14 13:35:06', '1', '1');
INSERT INTO `v_unidades_contenido` VALUES ('5', 'Unidad IV', 'unidad iv.png', '1', '2017-12-11 17:53:42', '2017-12-14 13:35:14', '1', '1');
INSERT INTO `v_unidades_contenido` VALUES ('6', 'Unidad V', 'unidad v.png', '1', '2017-12-11 20:34:15', '2017-12-14 13:35:24', '1', '1');
INSERT INTO `v_unidades_contenido` VALUES ('7', 'Unidad VI', 'unidad vi.png', '1', '2017-12-12 11:11:52', '2017-12-14 13:35:31', '1', '1');
