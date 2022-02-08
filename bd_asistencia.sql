/*
Navicat MySQL Data Transfer

Source Server         : sbccperu.com
Source Server Version : 50173
Source Host           : sbccperu.com:3306
Source Database       : bd_asistencia

Target Server Type    : MYSQL
Target Server Version : 50173
File Encoding         : 65001

Date: 2016-10-09 20:21:04
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for t_asistencia
-- ----------------------------
DROP TABLE IF EXISTS `t_asistencia`;
CREATE TABLE `t_asistencia` (
  `id_asistencia` int(11) NOT NULL AUTO_INCREMENT,
  `id_usuario` int(11) NOT NULL,
  `hora` time NOT NULL,
  `fecha_ingreso` date NOT NULL,
  `id_tipo` int(11) NOT NULL,
  `ip_pc` varchar(300) NOT NULL,
  `id_usu_crea` int(11) NOT NULL,
  `fec_crea` datetime NOT NULL,
  `id_usu_mod` int(11) NOT NULL,
  `fec_mod` datetime NOT NULL,
  `id_estado` int(11) NOT NULL,
  PRIMARY KEY (`id_asistencia`),
  KEY `id_usuario` (`id_usuario`),
  KEY `id_usu_crea` (`id_usu_crea`),
  KEY `id_usu_mod` (`id_usu_mod`),
  KEY `id_estado` (`id_estado`),
  KEY `id_tipo` (`id_tipo`),
  CONSTRAINT `t_asistencia_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `t_usuario` (`id_usuario`),
  CONSTRAINT `t_asistencia_ibfk_2` FOREIGN KEY (`id_usu_crea`) REFERENCES `t_usuario` (`id_usuario`),
  CONSTRAINT `t_asistencia_ibfk_3` FOREIGN KEY (`id_usu_mod`) REFERENCES `t_usuario` (`id_usuario`),
  CONSTRAINT `t_asistencia_ibfk_4` FOREIGN KEY (`id_estado`) REFERENCES `t_estado` (`id_estado`),
  CONSTRAINT `t_asistencia_ibfk_5` FOREIGN KEY (`id_tipo`) REFERENCES `t_tipo` (`id_tipo`)
) ENGINE=InnoDB AUTO_INCREMENT=57 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of t_asistencia
-- ----------------------------

-- ----------------------------
-- Table structure for t_cargo
-- ----------------------------
DROP TABLE IF EXISTS `t_cargo`;
CREATE TABLE `t_cargo` (
  `id_cargo` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_cargo` varchar(300) NOT NULL,
  `id_estado` int(11) NOT NULL,
  `id_usu_crea` int(11) NOT NULL,
  `fec_crea` datetime NOT NULL,
  `id_usu_mod` int(11) NOT NULL,
  `fec_mod` datetime NOT NULL,
  PRIMARY KEY (`id_cargo`),
  KEY `id_estado` (`id_estado`),
  KEY `id_usu_crea` (`id_usu_crea`),
  KEY `id_usu_mod` (`id_usu_mod`),
  CONSTRAINT `t_cargo_ibfk_1` FOREIGN KEY (`id_estado`) REFERENCES `t_estado` (`id_estado`),
  CONSTRAINT `t_cargo_ibfk_2` FOREIGN KEY (`id_usu_crea`) REFERENCES `t_usuario` (`id_usuario`),
  CONSTRAINT `t_cargo_ibfk_3` FOREIGN KEY (`id_usu_mod`) REFERENCES `t_usuario` (`id_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of t_cargo
-- ----------------------------
INSERT INTO `t_cargo` VALUES ('1', 'Asistente', '3', '1', '2016-05-21 17:07:16', '1', '2016-09-26 14:56:20');
INSERT INTO `t_cargo` VALUES ('2', 'Gerente', '3', '1', '2016-05-21 17:07:35', '1', '2016-05-22 01:05:19');
INSERT INTO `t_cargo` VALUES ('3', 'Asesor de Servicios', '1', '1', '2016-09-26 14:56:03', '1', '2016-09-26 14:56:03');
INSERT INTO `t_cargo` VALUES ('4', 'Asesor Especializado', '1', '1', '2016-09-26 14:56:15', '1', '2016-09-26 14:56:15');
INSERT INTO `t_cargo` VALUES ('5', 'Asesor Premium', '3', '1', '2016-09-26 14:56:42', '1', '2016-09-26 17:17:08');
INSERT INTO `t_cargo` VALUES ('6', 'Asesor de Retencion', '3', '1', '2016-09-26 14:56:53', '10', '2016-09-26 16:04:59');
INSERT INTO `t_cargo` VALUES ('7', 'Asesor de Fidelizacion', '3', '1', '2016-09-26 14:57:31', '1', '2016-09-26 17:17:03');
INSERT INTO `t_cargo` VALUES ('8', 'supervisor', '1', '10', '2016-09-26 17:30:54', '10', '2016-09-26 17:30:54');

-- ----------------------------
-- Table structure for t_departamento
-- ----------------------------
DROP TABLE IF EXISTS `t_departamento`;
CREATE TABLE `t_departamento` (
  `id_departamento` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_departamento` varchar(300) NOT NULL,
  `id_estado` int(11) NOT NULL,
  PRIMARY KEY (`id_departamento`),
  KEY `id_estado` (`id_estado`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of t_departamento
-- ----------------------------
INSERT INTO `t_departamento` VALUES ('1', 'Lima', '1');
INSERT INTO `t_departamento` VALUES ('2', '	Amazonas', '1');
INSERT INTO `t_departamento` VALUES ('3', '	Ancash', '1');
INSERT INTO `t_departamento` VALUES ('4', '	Apurimac', '1');
INSERT INTO `t_departamento` VALUES ('5', '	Arequipa', '1');
INSERT INTO `t_departamento` VALUES ('6', '	Ayacucho', '1');
INSERT INTO `t_departamento` VALUES ('7', '	Cajamarca', '1');
INSERT INTO `t_departamento` VALUES ('8', '	Callao', '3');
INSERT INTO `t_departamento` VALUES ('9', '	Cusco', '1');
INSERT INTO `t_departamento` VALUES ('10', '	Huancavelica', '1');
INSERT INTO `t_departamento` VALUES ('11', '	Huanuco', '1');
INSERT INTO `t_departamento` VALUES ('12', '	Ica', '1');
INSERT INTO `t_departamento` VALUES ('13', '	Junin', '1');
INSERT INTO `t_departamento` VALUES ('14', '	La Libertad', '1');
INSERT INTO `t_departamento` VALUES ('15', '	Lambayeque', '1');
INSERT INTO `t_departamento` VALUES ('16', '	Lima', '3');
INSERT INTO `t_departamento` VALUES ('17', '	Loreto', '1');
INSERT INTO `t_departamento` VALUES ('18', '	Madre De Dios', '1');
INSERT INTO `t_departamento` VALUES ('19', '	Moquegua', '1');
INSERT INTO `t_departamento` VALUES ('20', '	Pasco', '1');
INSERT INTO `t_departamento` VALUES ('21', '	Piura', '1');
INSERT INTO `t_departamento` VALUES ('22', '	Puno', '1');
INSERT INTO `t_departamento` VALUES ('23', '	San Martin', '1');
INSERT INTO `t_departamento` VALUES ('24', '	Tacna', '1');
INSERT INTO `t_departamento` VALUES ('25', '	Tumbes', '1');
INSERT INTO `t_departamento` VALUES ('26', '	Ucayali', '1');

-- ----------------------------
-- Table structure for t_dias
-- ----------------------------
DROP TABLE IF EXISTS `t_dias`;
CREATE TABLE `t_dias` (
  `id_dias` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_dias` varchar(200) NOT NULL,
  `id_estado` int(11) NOT NULL,
  PRIMARY KEY (`id_dias`),
  KEY `id_estado` (`id_estado`),
  CONSTRAINT `t_dias_ibfk_1` FOREIGN KEY (`id_estado`) REFERENCES `t_estado` (`id_estado`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of t_dias
-- ----------------------------
INSERT INTO `t_dias` VALUES ('1', 'Lunes-Sabado', '1');
INSERT INTO `t_dias` VALUES ('2', 'Domingo', '1');

-- ----------------------------
-- Table structure for t_estado
-- ----------------------------
DROP TABLE IF EXISTS `t_estado`;
CREATE TABLE `t_estado` (
  `id_estado` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_estado` varchar(300) NOT NULL,
  PRIMARY KEY (`id_estado`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of t_estado
-- ----------------------------
INSERT INTO `t_estado` VALUES ('1', 'Activo');
INSERT INTO `t_estado` VALUES ('2', 'Inactivo');
INSERT INTO `t_estado` VALUES ('3', 'Eliminado');
INSERT INTO `t_estado` VALUES ('4', 'Temprano');
INSERT INTO `t_estado` VALUES ('5', 'Tarde');
INSERT INTO `t_estado` VALUES ('6', 'Permiso Temprano');
INSERT INTO `t_estado` VALUES ('7', 'Permiso Tarde');

-- ----------------------------
-- Table structure for t_horario
-- ----------------------------
DROP TABLE IF EXISTS `t_horario`;
CREATE TABLE `t_horario` (
  `id_horario` int(11) NOT NULL AUTO_INCREMENT,
  `id_tipo_contrato` int(11) NOT NULL,
  `id_dias` int(11) NOT NULL,
  `hora_entrada` time NOT NULL,
  `hora_salida` time NOT NULL,
  `hora_re_entrada` time NOT NULL,
  `hora_re_salida` time NOT NULL,
  `id_estado` int(11) NOT NULL,
  `id_usu_crea` int(11) NOT NULL,
  `fec_crea` datetime NOT NULL,
  `id_usu_mod` int(11) NOT NULL,
  `fec_mod` datetime NOT NULL,
  PRIMARY KEY (`id_horario`),
  KEY `id_estado` (`id_estado`),
  KEY `id_usu_crea` (`id_usu_crea`),
  KEY `id_tipo_contrato` (`id_tipo_contrato`),
  KEY `id_usu_mod` (`id_usu_mod`),
  KEY `id_dias` (`id_dias`),
  CONSTRAINT `t_horario_ibfk_2` FOREIGN KEY (`id_tipo_contrato`) REFERENCES `t_tipo_contrato` (`id_tipo_contrato`),
  CONSTRAINT `t_horario_ibfk_3` FOREIGN KEY (`id_estado`) REFERENCES `t_estado` (`id_estado`),
  CONSTRAINT `t_horario_ibfk_4` FOREIGN KEY (`id_usu_crea`) REFERENCES `t_usuario` (`id_usuario`),
  CONSTRAINT `t_horario_ibfk_5` FOREIGN KEY (`id_usu_mod`) REFERENCES `t_usuario` (`id_usuario`),
  CONSTRAINT `t_horario_ibfk_6` FOREIGN KEY (`id_dias`) REFERENCES `t_dias` (`id_dias`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of t_horario
-- ----------------------------
INSERT INTO `t_horario` VALUES ('1', '1', '1', '08:00:00', '18:00:00', '13:00:00', '14:00:00', '1', '1', '2016-06-04 02:50:40', '1', '2016-09-21 21:14:21');
INSERT INTO `t_horario` VALUES ('2', '1', '2', '07:30:00', '18:00:00', '13:00:00', '14:00:00', '3', '1', '2016-06-04 02:51:09', '1', '2016-09-26 16:31:31');
INSERT INTO `t_horario` VALUES ('3', '2', '1', '07:30:00', '12:30:00', '07:00:00', '07:00:00', '1', '1', '2016-06-04 02:52:36', '1', '2016-06-04 02:52:36');
INSERT INTO `t_horario` VALUES ('4', '2', '2', '07:30:00', '12:30:00', '07:00:00', '07:00:00', '1', '1', '2016-06-04 02:53:04', '1', '2016-06-04 02:53:04');
INSERT INTO `t_horario` VALUES ('5', '2', '1', '13:00:00', '18:00:00', '07:00:00', '07:00:00', '1', '1', '2016-06-04 02:55:43', '1', '2016-06-04 02:55:43');
INSERT INTO `t_horario` VALUES ('6', '2', '2', '13:00:00', '18:00:00', '07:00:00', '07:00:00', '3', '1', '2016-06-04 02:56:07', '1', '2016-09-26 16:31:25');
INSERT INTO `t_horario` VALUES ('7', '1', '1', '07:00:00', '18:00:00', '14:00:00', '15:00:00', '1', '1', '2016-09-21 21:13:15', '1', '2016-09-21 21:13:39');
INSERT INTO `t_horario` VALUES ('8', '1', '1', '07:00:00', '13:00:00', '09:00:00', '09:30:00', '1', '10', '2016-09-26 16:18:31', '10', '2016-09-26 16:18:31');

-- ----------------------------
-- Table structure for t_motivo
-- ----------------------------
DROP TABLE IF EXISTS `t_motivo`;
CREATE TABLE `t_motivo` (
  `id_motivo` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_motivo` varchar(300) NOT NULL,
  `id_estado` int(11) NOT NULL,
  PRIMARY KEY (`id_motivo`),
  KEY `id_estado` (`id_estado`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of t_motivo
-- ----------------------------
INSERT INTO `t_motivo` VALUES ('1', 'Cita Medica', '1');
INSERT INTO `t_motivo` VALUES ('2', 'Enfermedad', '1');
INSERT INTO `t_motivo` VALUES ('3', 'Otro', '1');

-- ----------------------------
-- Table structure for t_perfil
-- ----------------------------
DROP TABLE IF EXISTS `t_perfil`;
CREATE TABLE `t_perfil` (
  `id_perfil` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_perfil` varchar(200) NOT NULL,
  `descripcion` varchar(300) NOT NULL,
  PRIMARY KEY (`id_perfil`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of t_perfil
-- ----------------------------
INSERT INTO `t_perfil` VALUES ('1', 'Usuario', '');
INSERT INTO `t_perfil` VALUES ('3', 'Administrador', '');

-- ----------------------------
-- Table structure for t_permiso
-- ----------------------------
DROP TABLE IF EXISTS `t_permiso`;
CREATE TABLE `t_permiso` (
  `id_permiso` int(11) NOT NULL AUTO_INCREMENT,
  `id_usuario` int(11) NOT NULL,
  `id_motivo` int(11) NOT NULL,
  `fecha_permiso` date NOT NULL,
  `hora_inicio` time NOT NULL,
  `hora_fin` time NOT NULL,
  `decripcion` varchar(300) NOT NULL,
  `id_estado` int(11) NOT NULL,
  `id_usu_crea` int(11) NOT NULL,
  `fec_crea` datetime NOT NULL,
  `id_usu_mod` int(11) NOT NULL,
  `fec_mod` datetime NOT NULL,
  PRIMARY KEY (`id_permiso`),
  KEY `id_usuario` (`id_usuario`),
  KEY `id_motivo` (`id_motivo`),
  KEY `id_estado` (`id_estado`),
  KEY `id_usu_crea` (`id_usu_crea`),
  KEY `id_usu_mod` (`id_usu_mod`),
  CONSTRAINT `t_permiso_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `t_usuario` (`id_usuario`),
  CONSTRAINT `t_permiso_ibfk_2` FOREIGN KEY (`id_motivo`) REFERENCES `t_motivo` (`id_motivo`),
  CONSTRAINT `t_permiso_ibfk_3` FOREIGN KEY (`id_estado`) REFERENCES `t_estado` (`id_estado`),
  CONSTRAINT `t_permiso_ibfk_4` FOREIGN KEY (`id_usu_crea`) REFERENCES `t_usuario` (`id_usuario`),
  CONSTRAINT `t_permiso_ibfk_5` FOREIGN KEY (`id_usu_mod`) REFERENCES `t_usuario` (`id_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of t_permiso
-- ----------------------------

-- ----------------------------
-- Table structure for t_sede
-- ----------------------------
DROP TABLE IF EXISTS `t_sede`;
CREATE TABLE `t_sede` (
  `id_sede` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_sede` varchar(300) NOT NULL,
  `id_estado` int(11) NOT NULL,
  `id_usu_crea` int(11) NOT NULL,
  `fec_crea` datetime NOT NULL,
  `id_usu_mod` int(11) NOT NULL,
  `fec_mod` datetime NOT NULL,
  PRIMARY KEY (`id_sede`),
  KEY `id_estado` (`id_estado`),
  KEY `id_usu_crea` (`id_usu_crea`),
  KEY `id_usu_mod` (`id_usu_mod`),
  CONSTRAINT `t_sede_ibfk_1` FOREIGN KEY (`id_estado`) REFERENCES `t_estado` (`id_estado`),
  CONSTRAINT `t_sede_ibfk_2` FOREIGN KEY (`id_usu_crea`) REFERENCES `t_usuario` (`id_usuario`),
  CONSTRAINT `t_sede_ibfk_3` FOREIGN KEY (`id_usu_mod`) REFERENCES `t_usuario` (`id_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of t_sede
-- ----------------------------
INSERT INTO `t_sede` VALUES ('1', 'Lima - Centro Cívico', '1', '1', '2016-05-21 17:07:54', '1', '2016-09-26 14:50:38');
INSERT INTO `t_sede` VALUES ('2', 'Lima-callao', '3', '1', '2016-05-22 01:03:39', '1', '2016-05-22 01:05:12');
INSERT INTO `t_sede` VALUES ('3', 'Lima - Jiron de la Unión', '3', '1', '2016-09-26 14:50:08', '10', '2016-09-26 16:05:26');
INSERT INTO `t_sede` VALUES ('4', 'UCIC', '1', '10', '2016-09-26 14:50:53', '10', '2016-09-26 14:50:53');

-- ----------------------------
-- Table structure for t_sexo
-- ----------------------------
DROP TABLE IF EXISTS `t_sexo`;
CREATE TABLE `t_sexo` (
  `id_sexo` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_sexo` varchar(300) NOT NULL,
  `id_estado` int(11) NOT NULL,
  PRIMARY KEY (`id_sexo`),
  KEY `id_estado` (`id_estado`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of t_sexo
-- ----------------------------
INSERT INTO `t_sexo` VALUES ('1', 'Masculino', '1');
INSERT INTO `t_sexo` VALUES ('2', 'Femenino', '1');

-- ----------------------------
-- Table structure for t_tipo
-- ----------------------------
DROP TABLE IF EXISTS `t_tipo`;
CREATE TABLE `t_tipo` (
  `id_tipo` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_tipo` varchar(300) NOT NULL,
  `id_estado` int(11) NOT NULL,
  PRIMARY KEY (`id_tipo`),
  KEY `id_estado` (`id_estado`),
  CONSTRAINT `t_tipo_ibfk_1` FOREIGN KEY (`id_estado`) REFERENCES `t_estado` (`id_estado`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of t_tipo
-- ----------------------------
INSERT INTO `t_tipo` VALUES ('1', 'Hora entrada', '1');
INSERT INTO `t_tipo` VALUES ('2', 'Hora salida', '1');
INSERT INTO `t_tipo` VALUES ('3', 'Hora Refrigerio Entrada', '1');
INSERT INTO `t_tipo` VALUES ('4', 'Hora Refrigerio Salida', '1');

-- ----------------------------
-- Table structure for t_tipo_contrato
-- ----------------------------
DROP TABLE IF EXISTS `t_tipo_contrato`;
CREATE TABLE `t_tipo_contrato` (
  `id_tipo_contrato` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_tipo_contrato` varchar(300) NOT NULL,
  `id_estado` int(11) NOT NULL,
  PRIMARY KEY (`id_tipo_contrato`),
  KEY `id_estado` (`id_estado`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of t_tipo_contrato
-- ----------------------------
INSERT INTO `t_tipo_contrato` VALUES ('1', 'Full Time', '1');
INSERT INTO `t_tipo_contrato` VALUES ('2', 'Part Time', '1');

-- ----------------------------
-- Table structure for t_usuario
-- ----------------------------
DROP TABLE IF EXISTS `t_usuario`;
CREATE TABLE `t_usuario` (
  `id_usuario` int(11) NOT NULL AUTO_INCREMENT,
  `id_perfil` int(11) NOT NULL,
  `dni` varchar(300) NOT NULL,
  `nombre` varchar(300) NOT NULL,
  `apellidos` varchar(300) NOT NULL,
  `id_sexo` int(11) NOT NULL,
  `fecha_nacimiento` date NOT NULL,
  `id_departamento` int(11) NOT NULL,
  `telefono` varchar(300) NOT NULL,
  `clave` varchar(300) NOT NULL,
  `id_cargo` int(11) NOT NULL,
  `id_sede` int(11) NOT NULL,
  `fecha_inicio_contrato` date NOT NULL,
  `fecha_termino_contrato` date NOT NULL,
  `id_usu_crea` int(11) NOT NULL,
  `fec_crea` datetime NOT NULL,
  `id_usu_mod` int(11) NOT NULL,
  `fec_mod` datetime NOT NULL,
  `id_estado` int(11) NOT NULL,
  `id_tipo_contrato_2` int(11) NOT NULL,
  `id_horario` int(11) NOT NULL,
  PRIMARY KEY (`id_usuario`),
  KEY `id_sexo` (`id_sexo`),
  KEY `id_departamento` (`id_departamento`),
  KEY `id_perfil` (`id_perfil`),
  KEY `id_cargo` (`id_cargo`),
  KEY `id_sede` (`id_sede`),
  KEY `id_estado` (`id_estado`),
  KEY `id_horario` (`id_horario`),
  KEY `id_tipo_contrato_2` (`id_tipo_contrato_2`),
  CONSTRAINT `t_usuario_ibfk_1` FOREIGN KEY (`id_perfil`) REFERENCES `t_perfil` (`id_perfil`),
  CONSTRAINT `t_usuario_ibfk_2` FOREIGN KEY (`id_sexo`) REFERENCES `t_sexo` (`id_sexo`),
  CONSTRAINT `t_usuario_ibfk_3` FOREIGN KEY (`id_departamento`) REFERENCES `t_departamento` (`id_departamento`),
  CONSTRAINT `t_usuario_ibfk_4` FOREIGN KEY (`id_cargo`) REFERENCES `t_cargo` (`id_cargo`),
  CONSTRAINT `t_usuario_ibfk_5` FOREIGN KEY (`id_sede`) REFERENCES `t_sede` (`id_sede`),
  CONSTRAINT `t_usuario_ibfk_6` FOREIGN KEY (`id_estado`) REFERENCES `t_estado` (`id_estado`),
  CONSTRAINT `t_usuario_ibfk_7` FOREIGN KEY (`id_tipo_contrato_2`) REFERENCES `t_tipo_contrato` (`id_tipo_contrato`),
  CONSTRAINT `t_usuario_ibfk_8` FOREIGN KEY (`id_horario`) REFERENCES `t_horario` (`id_horario`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of t_usuario
-- ----------------------------
INSERT INTO `t_usuario` VALUES ('1', '3', '12345678', 'Daniel', 'Lazaro Ortiz', '1', '2016-05-21', '1', '5501332', '123', '1', '1', '2016-05-21', '2016-07-28', '1', '2016-05-21 17:10:05', '1', '2016-09-26 14:41:04', '3', '1', '1');
INSERT INTO `t_usuario` VALUES ('4', '1', '12345676', 'Alex', 'Suarez', '1', '2016-05-27', '1', '5501332', '123', '1', '1', '2016-05-01', '2016-06-30', '1', '2016-05-27 14:56:16', '1', '2016-09-26 14:40:53', '3', '1', '1');
INSERT INTO `t_usuario` VALUES ('8', '1', '11111111', 'prueba', 'prueba', '1', '1997-06-01', '1', '5501332', '123', '1', '1', '2016-06-01', '2016-06-30', '1', '2016-06-04 04:50:46', '1', '2016-06-04 05:02:36', '3', '2', '4');
INSERT INTO `t_usuario` VALUES ('9', '3', '72016996', 'Jonathan', 'F. R.', '1', '2016-09-21', '2', '555555', '1234', '4', '1', '2016-09-21', '2016-09-21', '1', '2016-09-21 21:17:02', '1', '2016-09-26 14:59:24', '1', '1', '1');
INSERT INTO `t_usuario` VALUES ('10', '3', '73676963', 'Maria', 'Ramos Pompa', '2', '1994-04-09', '1', '994764162', 'maria', '3', '1', '2016-09-26', '2016-09-26', '1', '2016-09-26 14:44:49', '10', '2016-09-26 16:06:20', '1', '2', '3');
INSERT INTO `t_usuario` VALUES ('11', '1', '00011122', 'xx', 'xxxxx', '1', '1978-09-26', '1', '5555555', '123', '3', '1', '2016-09-26', '2016-09-26', '10', '2016-09-26 16:34:46', '10', '2016-09-26 16:34:46', '1', '1', '1');
