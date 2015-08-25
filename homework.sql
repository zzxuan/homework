/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50624
Source Host           : localhost:3306
Source Database       : homework

Target Server Type    : MYSQL
Target Server Version : 50624
File Encoding         : 65001

Date: 2015-08-26 00:00:49
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `hw_class`
-- ----------------------------
DROP TABLE IF EXISTS `hw_class`;
CREATE TABLE `hw_class` (
  `hwclassid` int(11) NOT NULL AUTO_INCREMENT,
  `hwclassname` varchar(256) DEFAULT NULL,
  `hwclassdesc` varchar(2048) DEFAULT NULL,
  PRIMARY KEY (`hwclassid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of hw_class
-- ----------------------------

-- ----------------------------
-- Table structure for `hw_classstudent`
-- ----------------------------
DROP TABLE IF EXISTS `hw_classstudent`;
CREATE TABLE `hw_classstudent` (
  `classstudent` int(11) NOT NULL AUTO_INCREMENT,
  `studentid` int(11) DEFAULT NULL,
  `hwclassid` int(11) DEFAULT NULL,
  PRIMARY KEY (`classstudent`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of hw_classstudent
-- ----------------------------

-- ----------------------------
-- Table structure for `hw_classteacher`
-- ----------------------------
DROP TABLE IF EXISTS `hw_classteacher`;
CREATE TABLE `hw_classteacher` (
  `classteacherid` int(11) NOT NULL AUTO_INCREMENT,
  `teacherid` int(11) DEFAULT NULL,
  `hwclassid` int(11) DEFAULT NULL,
  PRIMARY KEY (`classteacherid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of hw_classteacher
-- ----------------------------

-- ----------------------------
-- Table structure for `hw_user`
-- ----------------------------
DROP TABLE IF EXISTS `hw_user`;
CREATE TABLE `hw_user` (
  `userid` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(32) DEFAULT NULL,
  `userdisplay` varchar(32) DEFAULT NULL,
  `userpassword` varchar(32) DEFAULT NULL,
  `usertype` int(11) DEFAULT NULL,
  PRIMARY KEY (`userid`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of hw_user
-- ----------------------------
INSERT INTO `hw_user` VALUES ('1', 'admin', null, '53250d93495ec5680ac9a864623a2413', '3');
INSERT INTO `hw_user` VALUES ('13', 'zhangsan', '张三', '202cb962ac59075b964b07152d234b70', '1');
INSERT INTO `hw_user` VALUES ('14', 'lisi', '李四', '202cb962ac59075b964b07152d234b70', '1');
INSERT INTO `hw_user` VALUES ('15', 'wangwu', '王五', 'f1290186a5d0b1ceab27f4e77c0c5d68', '1');
INSERT INTO `hw_user` VALUES ('16', 'sa', 'sa', 'c12e01f2a13ff5587e1e9e4aedb8242d', '1');
INSERT INTO `hw_user` VALUES ('17', '123', '123', 'c20ad4d76fe97759aa27a0c99bff6710', '1');
INSERT INTO `hw_user` VALUES ('18', 'xiaoming', '小明', '202cb962ac59075b964b07152d234b70', '2');
INSERT INTO `hw_user` VALUES ('19', 'xiaohong', '小红', '202cb962ac59075b964b07152d234b70', '2');
INSERT INTO `hw_user` VALUES ('20', 'xiaoxiao', '小小', '202cb962ac59075b964b07152d234b70', '2');
