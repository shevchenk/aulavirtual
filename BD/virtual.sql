/*
Navicat MySQL Data Transfer

Source Server         : LOCALHOST
Source Server Version : 50709
Source Host           : localhost:3306
Source Database       : virtual

Target Server Type    : MYSQL
Target Server Version : 50709
File Encoding         : 65001

Date: 2017-09-24 00:33:48
*/

SET FOREIGN_KEY_CHECKS=0;

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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of menus
-- ----------------------------
INSERT INTO `menus` VALUES ('1', 'Mantenimiento', 'fa fa-cogs', '1', '2017-05-26 18:56:58', null, '1', null);

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
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of opciones
-- ----------------------------
INSERT INTO `opciones` VALUES ('1', '1', 'Mantenimiento - Cargos', 'expertmanage.cargo.cargo', 'fa fa-sitemap', '1', '2017-05-26 19:00:25', null, '1', null);
INSERT INTO `opciones` VALUES ('2', '1', 'Mantenimiento - Cargos', 'basicmanage.cargo.cargo', 'fa fa-sitemap', '1', '2017-05-26 19:01:08', null, '1', null);
INSERT INTO `opciones` VALUES ('3', '1', 'Mantenimiento - Productos', 'expertmanage.producto.producto', 'fa fa-sitemap', '1', '2017-05-26 19:02:18', null, '1', null);
INSERT INTO `opciones` VALUES ('4', '1', 'Mantenimiento - Productos', 'basicmanage.producto.producto', 'fa fa-sitemap', '1', '2017-05-26 19:02:49', null, '1', null);
INSERT INTO `opciones` VALUES ('5', '1', 'Mantenimiento - Empresas', 'expertmanage.empresa.empresa', 'fa fa-sitemap', '1', '2017-05-26 19:03:08', null, '1', null);
INSERT INTO `opciones` VALUES ('6', '1', 'Mantenimiento - Empresas', 'basicmanage.empresa.empresa', 'fa fa-sitemap', '1', '2017-05-26 19:03:08', null, '1', null);

-- ----------------------------
-- Table structure for personas
-- ----------------------------
DROP TABLE IF EXISTS `personas`;
CREATE TABLE `personas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `paterno` varchar(80) NOT NULL DEFAULT '',
  `materno` varchar(80) NOT NULL DEFAULT '',
  `nombre` varchar(100) NOT NULL DEFAULT '',
  `dni` varchar(8) NOT NULL DEFAULT '99999999',
  `sexo` char(1) NOT NULL DEFAULT 'M',
  `email` varchar(100) DEFAULT '',
  `password` varchar(100) NOT NULL,
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
) ENGINE=InnoDB AUTO_INCREMENT=179 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of personas
-- ----------------------------
INSERT INTO `personas` VALUES ('1', 'Admin', 'System', 'Software', '12312312', 'M', null, '$2y$10$GbcNEAXRTarkHEU/diSbA.vNd5eipLoV5f2RMpr5piMcJZb3NxIhK', 'z3IvnfgyTK0sOyr99QrwQhUU5avNPJpOfN2R47TdiuGQTWQiU1JYsMhFoTBM', null, null, null, null, '1', '2017-05-26 15:53:15', null, '1', null);

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
  CONSTRAINT `personas_privilegios_sucursales_ibfk_1` FOREIGN KEY (`persona_id`) REFERENCES `personas` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `personas_privilegios_sucursales_ibfk_2` FOREIGN KEY (`privilegio_id`) REFERENCES `privilegios` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `personas_privilegios_sucursales_ibfk_3` FOREIGN KEY (`sucursal_id`) REFERENCES `sucursales` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of personas_privilegios_sucursales
-- ----------------------------
INSERT INTO `personas_privilegios_sucursales` VALUES ('1', '1', '1', null, null, null, '1', '2017-05-26 19:06:06', null, '1', null);

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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of privilegios
-- ----------------------------
INSERT INTO `privilegios` VALUES ('1', 'Admin', '1', '2017-05-26 19:04:59', null, '1', null);

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
) ENGINE=InnoDB AUTO_INCREMENT=56 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of privilegios_opciones
-- ----------------------------
INSERT INTO `privilegios_opciones` VALUES ('1', '1', '1', '1', '2017-05-26 19:05:13', null, '1', null);
INSERT INTO `privilegios_opciones` VALUES ('2', '1', '2', '1', '2017-05-26 19:05:13', null, '1', null);
INSERT INTO `privilegios_opciones` VALUES ('3', '1', '3', '1', '2017-05-26 19:05:13', null, '1', null);
INSERT INTO `privilegios_opciones` VALUES ('4', '1', '4', '1', '2017-05-26 19:05:13', null, '1', null);
INSERT INTO `privilegios_opciones` VALUES ('5', '1', '5', '1', '2017-05-26 19:05:13', null, '1', null);
INSERT INTO `privilegios_opciones` VALUES ('6', '1', '6', '1', '2017-05-26 19:05:13', null, '1', null);

-- ----------------------------
-- Table structure for v_balotarios
-- ----------------------------
DROP TABLE IF EXISTS `v_balotarios`;
CREATE TABLE `v_balotarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `programacion_unica_id` int(11) NOT NULL,
  `tipo_evaluacion_id` int(11) NOT NULL,
  `cantidad_maxima` int(11) NOT NULL DEFAULT '1' COMMENT 'Cantidad maxima de registros para realizar el chocolateo',
  `cantidad_pregunta` int(11) NOT NULL DEFAULT '1' COMMENT 'Cantidad de preguntas que generará el examen',
  `estado` int(11) NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `persona_id_created_at` int(11) NOT NULL,
  `persona_id_updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `b_programacion_unica_id_idx` (`programacion_unica_id`),
  KEY `b_tipo_evaluacion_id_idx` (`tipo_evaluacion_id`),
  CONSTRAINT `b_programacion_unica_id` FOREIGN KEY (`programacion_unica_id`) REFERENCES `v_programaciones_unicas` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `b_tipo_evaluacion_id` FOREIGN KEY (`tipo_evaluacion_id`) REFERENCES `v_tipos_evaluaciones` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of v_balotarios
-- ----------------------------

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
  KEY `bp_balotario_id_idx` (`balotario_id`),
  KEY `bp_pregunta_id_idx` (`pregunta_id`),
  CONSTRAINT `bp_balotario_id` FOREIGN KEY (`balotario_id`) REFERENCES `v_balotarios` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `bp_pregunta_id` FOREIGN KEY (`pregunta_id`) REFERENCES `v_preguntas` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of v_balotarios_preguntas
-- ----------------------------

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
  `contenido` varchar(500) NOT NULL DEFAULT '',
  `ruta_contenido` varchar(200) NOT NULL DEFAULT '',
  `tipo_respuesta` int(11) NOT NULL DEFAULT '0' COMMENT '0: Inicialmente es solo vista | 1: Indica que se requiere respuesta de los alumnos',
  `fecha_inicio` date DEFAULT NULL,
  `fecha_final` date DEFAULT NULL,
  `fecha_ampliada` date DEFAULT NULL COMMENT 'Fecha de ampliación para subir archivo.',
  `estado` int(11) NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `persona_id_created_at` int(11) NOT NULL,
  `persona_id_updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `co_curso_id_idx` (`curso_id`),
  KEY `co_programacion_unica_id_idx` (`programacion_unica_id`),
  CONSTRAINT `co_curso_id` FOREIGN KEY (`curso_id`) REFERENCES `v_cursos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `co_programacion_unica_id` FOREIGN KEY (`programacion_unica_id`) REFERENCES `v_programaciones_unicas` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of v_contenidos
-- ----------------------------

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
  KEY `cp_programacion_id_idx` (`programacion_id`),
  KEY `cp_contenido_id_idx` (`contenido_id`),
  CONSTRAINT `cp_contenido_id` FOREIGN KEY (`contenido_id`) REFERENCES `v_contenidos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `cp_programacion_id` FOREIGN KEY (`programacion_id`) REFERENCES `v_programaciones` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of v_contenidos_programaciones
-- ----------------------------

-- ----------------------------
-- Table structure for v_contenidos_respuestas
-- ----------------------------
DROP TABLE IF EXISTS `v_contenidos_respuestas`;
CREATE TABLE `v_contenidos_respuestas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `contenido_id` int(11) NOT NULL,
  `programacion_id` int(11) NOT NULL,
  `respuesta` varchar(500) NOT NULL DEFAULT '',
  `ruta_respuesta` varchar(200) NOT NULL DEFAULT '',
  `estado` int(11) NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `persona_id_created_at` int(11) NOT NULL,
  `persona_id_updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `cr_contenido_id_idx` (`contenido_id`),
  KEY `cr_programacion_id_idx` (`programacion_id`),
  CONSTRAINT `cr_contenido_id` FOREIGN KEY (`contenido_id`) REFERENCES `v_contenidos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `cr_programacion_id` FOREIGN KEY (`programacion_id`) REFERENCES `v_programaciones` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of v_contenidos_respuestas
-- ----------------------------

-- ----------------------------
-- Table structure for v_cursos
-- ----------------------------
DROP TABLE IF EXISTS `v_cursos`;
CREATE TABLE `v_cursos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `curso` varchar(150) NOT NULL,
  `curso_externo_id` int(11) DEFAULT NULL,
  `estado` int(11) NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `persona_id_created_at` int(11) NOT NULL,
  `persona_id_updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of v_cursos
-- ----------------------------

-- ----------------------------
-- Table structure for v_evaluaciones
-- ----------------------------
DROP TABLE IF EXISTS `v_evaluaciones`;
CREATE TABLE `v_evaluaciones` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `programacion_id` int(11) NOT NULL,
  `tipo_evaluacion_id` int(11) NOT NULL,
  `fecha_evaluacion` date DEFAULT NULL,
  `fecha_reprogramada` date DEFAULT NULL COMMENT 'Fecha que se amplio',
  `descripcion` varchar(500) NOT NULL DEFAULT '',
  `nota` decimal(10,2) NOT NULL DEFAULT '0.00',
  `estado_cambio` int(11) NOT NULL DEFAULT '0' COMMENT '0: Normal | 1: Anulación | 2: Reprogramación',
  `estado` int(11) NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `persona_id_created_at` int(11) NOT NULL,
  `persona_id_updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ev_programacion_id_idx` (`programacion_id`),
  KEY `ev_tipo_evaluacion_idx` (`tipo_evaluacion_id`),
  CONSTRAINT `ev_programacion_id` FOREIGN KEY (`programacion_id`) REFERENCES `v_programaciones` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `ev_tipo_evaluacion` FOREIGN KEY (`tipo_evaluacion_id`) REFERENCES `v_tipos_evaluaciones` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of v_evaluaciones
-- ----------------------------

-- ----------------------------
-- Table structure for v_evaluaciones_detalle
-- ----------------------------
DROP TABLE IF EXISTS `v_evaluaciones_detalle`;
CREATE TABLE `v_evaluaciones_detalle` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `evaluaciones_id` int(11) NOT NULL,
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
  KEY `ed_evaluacion_id_idx` (`evaluaciones_id`),
  KEY `ed_pregunta_id_idx` (`pregunta_id`),
  KEY `ed_respuesta_id_idx` (`respuesta_id`),
  CONSTRAINT `ed_evaluacion_id` FOREIGN KEY (`evaluaciones_id`) REFERENCES `v_evaluaciones` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `ed_pregunta_id` FOREIGN KEY (`pregunta_id`) REFERENCES `v_preguntas` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `ed_respuesta_id` FOREIGN KEY (`respuesta_id`) REFERENCES `v_respuestas` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of v_evaluaciones_detalle
-- ----------------------------

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
  `persona_externo_id` int(11) DEFAULT NULL,
  `estado` int(11) NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `persona_id_created_at` int(11) NOT NULL,
  `persona_id_updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of v_personas
-- ----------------------------

-- ----------------------------
-- Table structure for v_preguntas
-- ----------------------------
DROP TABLE IF EXISTS `v_preguntas`;
CREATE TABLE `v_preguntas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `curso_id` int(11) NOT NULL,
  `tipo_evaluacion_id` int(11) NOT NULL,
  `pregunta` varchar(250) NOT NULL DEFAULT '',
  `puntaje` decimal(10,2) NOT NULL DEFAULT '1.00',
  `estado` int(11) NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `persona_id_created_at` int(11) NOT NULL,
  `persona_id_updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `pre_curso_id_idx` (`curso_id`),
  KEY `pre_tipo_evaluacion_id_idx` (`tipo_evaluacion_id`),
  CONSTRAINT `pre_curso_id` FOREIGN KEY (`curso_id`) REFERENCES `v_cursos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `pre_tipo_evaluacion_id` FOREIGN KEY (`tipo_evaluacion_id`) REFERENCES `v_tipos_evaluaciones` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of v_preguntas
-- ----------------------------

-- ----------------------------
-- Table structure for v_programaciones
-- ----------------------------
DROP TABLE IF EXISTS `v_programaciones`;
CREATE TABLE `v_programaciones` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `programacion_externo_id` int(11) NOT NULL,
  `programacion_unica_id` int(11) NOT NULL,
  `curso_id` int(11) NOT NULL COMMENT 'Curso Asignado',
  `persona_id` int(11) NOT NULL COMMENT 'Alumno Asignado',
  `estado` int(11) NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `persona_id_created_at` int(11) NOT NULL,
  `persona_id_updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `p_curso_id_idx` (`curso_id`),
  KEY `p_persona_id_idx` (`persona_id`),
  KEY `p_programacion_unica_id_idx` (`programacion_unica_id`),
  CONSTRAINT `p_curso_id` FOREIGN KEY (`curso_id`) REFERENCES `v_cursos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `p_persona_id` FOREIGN KEY (`persona_id`) REFERENCES `v_personas` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `p_programacion_unica_id` FOREIGN KEY (`programacion_unica_id`) REFERENCES `v_programaciones_unicas` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of v_programaciones
-- ----------------------------

-- ----------------------------
-- Table structure for v_programaciones_unicas
-- ----------------------------
DROP TABLE IF EXISTS `v_programaciones_unicas`;
CREATE TABLE `v_programaciones_unicas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `curso_id` int(11) NOT NULL,
  `persona_id` int(11) NOT NULL COMMENT 'Es el docente asignado',
  `programacion_unica_externo_id` int(11) NOT NULL,
  `estado` int(11) NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `persona_id_created_at` int(11) NOT NULL,
  `persona_id_updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `pu_curso_id_idx` (`curso_id`),
  KEY `pu_persona_id_idx` (`persona_id`),
  CONSTRAINT `pu_curso_id` FOREIGN KEY (`curso_id`) REFERENCES `v_cursos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `pu_persona_id` FOREIGN KEY (`persona_id`) REFERENCES `v_personas` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of v_programaciones_unicas
-- ----------------------------

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
  KEY `rm_programacion_unica_id_idx` (`programacion_unica_id`),
  KEY `rm_condicional_id_idx` (`condicional_id`),
  CONSTRAINT `rm_condicional_id` FOREIGN KEY (`condicional_id`) REFERENCES `v_condicionales` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `rm_programacion_unica_id` FOREIGN KEY (`programacion_unica_id`) REFERENCES `v_programaciones_unicas` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
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
  `estado` int(11) NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `persona_id_created_at` int(11) NOT NULL,
  `persona_id_updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `re_pregunta_id_idx` (`pregunta_id`),
  KEY `re_tipo_respuesta_id_idx` (`tipo_respuesta_id`),
  CONSTRAINT `re_pregunta_id` FOREIGN KEY (`pregunta_id`) REFERENCES `v_preguntas` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `re_tipo_respuesta_id` FOREIGN KEY (`tipo_respuesta_id`) REFERENCES `v_tipos_respuestas` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of v_respuestas
-- ----------------------------

-- ----------------------------
-- Table structure for v_tipos_evaluaciones
-- ----------------------------
DROP TABLE IF EXISTS `v_tipos_evaluaciones`;
CREATE TABLE `v_tipos_evaluaciones` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tipo_evaluacion` varchar(200) DEFAULT NULL,
  `estado` int(11) NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `persona_id_created_at` int(11) NOT NULL,
  `persona_id_updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of v_tipos_evaluaciones
-- ----------------------------

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of v_tipos_respuestas
-- ----------------------------
