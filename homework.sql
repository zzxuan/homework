/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50624
Source Host           : localhost:3306
Source Database       : homework

Target Server Type    : MYSQL
Target Server Version : 50624
File Encoding         : 65001

Date: 2015-09-10 00:43:06
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
  `classtime` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`hwclassid`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of hw_class
-- ----------------------------
INSERT INTO `hw_class` VALUES ('1', '初一数学', '初一数学', '2015-08-28 22:24:18');
INSERT INTO `hw_class` VALUES ('2', '初二物理', 'saddsadasdas', null);
INSERT INTO `hw_class` VALUES ('4', '初三化学', 'sdsadadsds', null);

-- ----------------------------
-- Table structure for `hw_classstudent`
-- ----------------------------
DROP TABLE IF EXISTS `hw_classstudent`;
CREATE TABLE `hw_classstudent` (
  `classstudent` int(11) NOT NULL AUTO_INCREMENT,
  `studentid` int(11) DEFAULT NULL,
  `hwclassid` int(11) DEFAULT NULL,
  PRIMARY KEY (`classstudent`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of hw_classstudent
-- ----------------------------
INSERT INTO `hw_classstudent` VALUES ('1', '18', '1');
INSERT INTO `hw_classstudent` VALUES ('2', '19', '1');
INSERT INTO `hw_classstudent` VALUES ('3', '20', '2');
INSERT INTO `hw_classstudent` VALUES ('4', '18', '2');
INSERT INTO `hw_classstudent` VALUES ('5', '20', '4');

-- ----------------------------
-- Table structure for `hw_classteacher`
-- ----------------------------
DROP TABLE IF EXISTS `hw_classteacher`;
CREATE TABLE `hw_classteacher` (
  `classteacherid` int(11) NOT NULL AUTO_INCREMENT,
  `teacherid` int(11) DEFAULT NULL,
  `hwclassid` int(11) DEFAULT NULL,
  PRIMARY KEY (`classteacherid`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of hw_classteacher
-- ----------------------------
INSERT INTO `hw_classteacher` VALUES ('4', '13', '1');
INSERT INTO `hw_classteacher` VALUES ('5', '13', '2');
INSERT INTO `hw_classteacher` VALUES ('6', '14', '4');

-- ----------------------------
-- Table structure for `hw_hmwork`
-- ----------------------------
DROP TABLE IF EXISTS `hw_hmwork`;
CREATE TABLE `hw_hmwork` (
  `hmworkid` int(11) NOT NULL AUTO_INCREMENT,
  `hmworktitle` varchar(1024) DEFAULT NULL,
  `hmworkrequire` varchar(4096) DEFAULT NULL,
  `hmworkcontent` text,
  `hmworkstate` int(11) DEFAULT NULL,
  `hwclassid` int(11) DEFAULT NULL,
  `teacherid` int(11) DEFAULT NULL,
  `createtime` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`hmworkid`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of hw_hmwork
-- ----------------------------
INSERT INTO `hw_hmwork` VALUES ('1', '作业一', '实打实大师的', '<p>的撒打算打算打算</p>', '3', '1', '13', '2015-08-30 10:28:56');
INSERT INTO `hw_hmwork` VALUES ('2', '作业', '啥都实打实大师的', '<p>四大大三大</p><p>sdasdd<span style=\"font-size: 18px;\"><strong>sadas四打算</strong></span></p>', '3', '1', '13', '2015-08-30 18:31:48');
INSERT INTO `hw_hmwork` VALUES ('3', '四大大三大四', '四大大三大四打算大声道', '<p>18:32:582015-08-30<img src=\"/homework/data/ue/upload/image/20150830/1440930824130941.png\" title=\"1440930824130941.png\" alt=\"logo.png\"/></p>', '3', '1', '13', '2015-08-30 18:33:52');
INSERT INTO `hw_hmwork` VALUES ('4', '测试', '测试', '<p>实打实大</p><p>sdadasdasdsdadsasd</p><p><br/></p><p>sdadasdasdwq</p><p>sdasdasdasdasd</p><p><br/></p>', '3', '1', '13', '2015-08-30 22:37:16');
INSERT INTO `hw_hmwork` VALUES ('5', '的萨达四大打算', '实打实的三大', '<p>打算打算打算打算的</p>', '3', '1', '13', '2015-08-30 22:39:09');
INSERT INTO `hw_hmwork` VALUES ('6', '23132', '23123', '<p>21312312</p>', '3', '1', '13', '2015-08-30 22:40:05');
INSERT INTO `hw_hmwork` VALUES ('7', '是的撒旦的', '四大大三大四的', '<p>四大大三大四打算的</p>', '3', '1', '13', '2015-08-30 22:40:52');
INSERT INTO `hw_hmwork` VALUES ('8', '测试作业', '测试xxxxxxxxxxxxxxxxxx\r\n谁倒霉死了看到拉斯电视卡可乐乐乐乐乐乐乐乐', '<p><span style=\"color: rgb(51, 51, 51); font-family: 宋体; font-size: 14px; line-height: 25px;\">1．存储容量的基本单位 Byte 表示什么？(D)</span><br style=\"color: rgb(51, 51, 51); font-family: 宋体; font-size: 14px; line-height: 25px; white-space: normal;\"/><span style=\"color: rgb(51, 51, 51); font-family: 宋体; font-size: 14px; line-height: 25px;\">A一个二进制位&nbsp;</span><br style=\"color: rgb(51, 51, 51); font-family: 宋体; font-size: 14px; line-height: 25px; white-space: normal;\"/><span style=\"color: rgb(51, 51, 51); font-family: 宋体; font-size: 14px; line-height: 25px;\">B一个十进制位&nbsp;</span><br style=\"color: rgb(51, 51, 51); font-family: 宋体; font-size: 14px; line-height: 25px; white-space: normal;\"/><span style=\"color: rgb(51, 51, 51); font-family: 宋体; font-size: 14px; line-height: 25px;\">C两个八进制位&nbsp;</span><br style=\"color: rgb(51, 51, 51); font-family: 宋体; font-size: 14px; line-height: 25px; white-space: normal;\"/><span style=\"color: rgb(51, 51, 51); font-family: 宋体; font-size: 14px; line-height: 25px;\">D八个二进制位</span><br style=\"color: rgb(51, 51, 51); font-family: 宋体; font-size: 14px; line-height: 25px; white-space: normal;\"/><span style=\"color: rgb(51, 51, 51); font-family: 宋体; font-size: 14px; line-height: 25px;\">2．一个 ASCII 码字符用几个 Byte 表示？(A)</span><br style=\"color: rgb(51, 51, 51); font-family: 宋体; font-size: 14px; line-height: 25px; white-space: normal;\"/><span style=\"color: rgb(51, 51, 51); font-family: 宋体; font-size: 14px; line-height: 25px;\">A1&nbsp;</span><br style=\"color: rgb(51, 51, 51); font-family: 宋体; font-size: 14px; line-height: 25px; white-space: normal;\"/><span style=\"color: rgb(51, 51, 51); font-family: 宋体; font-size: 14px; line-height: 25px;\">B2&nbsp;</span><br style=\"color: rgb(51, 51, 51); font-family: 宋体; font-size: 14px; line-height: 25px; white-space: normal;\"/><span style=\"color: rgb(51, 51, 51); font-family: 宋体; font-size: 14px; line-height: 25px;\">C3&nbsp;</span><br style=\"color: rgb(51, 51, 51); font-family: 宋体; font-size: 14px; line-height: 25px; white-space: normal;\"/><span style=\"color: rgb(51, 51, 51); font-family: 宋体; font-size: 14px; line-height: 25px;\">D4</span><br style=\"color: rgb(51, 51, 51); font-family: 宋体; font-size: 14px; line-height: 25px; white-space: normal;\"/><span style=\"color: rgb(51, 51, 51); font-family: 宋体; font-size: 14px; line-height: 25px;\">3．计算机键盘是一个(A)</span><br style=\"color: rgb(51, 51, 51); font-family: 宋体; font-size: 14px; line-height: 25px; white-space: normal;\"/><span style=\"color: rgb(51, 51, 51); font-family: 宋体; font-size: 14px; line-height: 25px;\">A输入设备&nbsp;</span><br style=\"color: rgb(51, 51, 51); font-family: 宋体; font-size: 14px; line-height: 25px; white-space: normal;\"/><span style=\"color: rgb(51, 51, 51); font-family: 宋体; font-size: 14px; line-height: 25px;\">B输出设备&nbsp;</span><br style=\"color: rgb(51, 51, 51); font-family: 宋体; font-size: 14px; line-height: 25px; white-space: normal;\"/><span style=\"color: rgb(51, 51, 51); font-family: 宋体; font-size: 14px; line-height: 25px;\">C控制设备&nbsp;</span><br style=\"color: rgb(51, 51, 51); font-family: 宋体; font-size: 14px; line-height: 25px; white-space: normal;\"/><span style=\"color: rgb(51, 51, 51); font-family: 宋体; font-size: 14px; line-height: 25px;\">D监视设备</span><br style=\"color: rgb(51, 51, 51); font-family: 宋体; font-size: 14px; line-height: 25px; white-space: normal;\"/><span style=\"color: rgb(51, 51, 51); font-family: 宋体; font-size: 14px; line-height: 25px;\">4．计算机能直接执行的程序是(B)</span></p><p><span style=\"color: rgb(51, 51, 51); font-family: 宋体; font-size: 14px; line-height: 25px;\"><img src=\"/homework/data/ue/upload/image/20150830/1440946762138721.png\" title=\"1440946762138721.png\" alt=\"结构.png\" width=\"437\" height=\"202\" style=\"width: 437px; height: 202px;\"/></span></p><p><span style=\"color: rgb(51, 51, 51); font-family: 宋体; font-size: 14px; line-height: 25px;\"></span></p><table><tbody><tr class=\"firstRow\"><td width=\"178\" valign=\"top\"><br/></td><td width=\"178\" valign=\"top\" style=\"word-break: break-all;\">实打实大师</td><td width=\"178\" valign=\"top\"><br/></td><td width=\"178\" valign=\"top\"><br/></td></tr><tr><td width=\"178\" valign=\"top\"><br/></td><td width=\"178\" valign=\"top\"><br/></td><td width=\"178\" valign=\"top\" style=\"word-break: break-all;\">实打实大师的</td><td width=\"178\" valign=\"top\"><br/></td></tr><tr><td width=\"178\" valign=\"top\"><br/></td><td width=\"178\" valign=\"top\"><br/></td><td width=\"178\" valign=\"top\"><br/></td><td width=\"178\" valign=\"top\" style=\"word-break: break-all;\">四大大三大四的</td></tr></tbody></table><p><span style=\"color: rgb(51, 51, 51); font-family: 宋体; font-size: 14px; line-height: 25px;\"></span><br/></p>', '3', '1', '13', '2015-08-30 23:00:02');
INSERT INTO `hw_hmwork` VALUES ('9', '测试', '实打实的萨达的拉斯加分了卡机说服力卡斯加分了卡萨减肥了开始放假啦水煎服拉克丝发了空间发了卡手机费拉斯卡发生了咖啡加拉斯卡房间爱看了啥房间爱死了快放假拉屎咖啡洒进来看房间爱快乐是放假哎看来是房间爱思考了房间拉斯卡房间爱死了', '<p>实打实的萨达的拉斯加分了卡机说服力卡斯加分了卡萨减肥了开始放假啦水煎服拉克丝发了空间发了卡手机费拉斯卡发生了咖啡加拉斯卡房间爱看了啥房间爱死了快放假拉屎咖啡洒进来看房间爱快乐是放假哎看来是房间爱思考了房间拉斯卡房间爱死了实打实的萨达的拉斯加分了卡机说服力卡斯加分了卡萨减肥了开始放假啦水煎服拉克丝发了空间发了卡手机费拉斯卡发生了咖啡加拉斯卡房间爱看了啥房间爱死了快放假拉屎咖啡洒进来看房间爱快乐是放假哎看来是房间爱思考了房间拉斯卡房间爱死了实打实的萨达的拉斯加分了卡机说服力卡斯加分了卡萨减肥了开始放假啦水煎服拉克丝发了空间发了卡手机费拉斯卡发生了咖啡加拉斯卡房间爱看了啥房间爱死了快放假拉屎咖啡洒进来看房间爱快乐是放假哎看来是房间爱思考了房间拉斯卡房间爱死了</p>', '3', '1', '13', '2015-08-31 00:35:21');
INSERT INTO `hw_hmwork` VALUES ('10', '大声大声道', '打算打打', '<p>dasdasds sd</p><p>sadasdasd</p><p><img src=\"/homework/data/ue/upload/image/20150830/1440930824130941.png\" alt=\"1440930824130941.png\"/></p>', '3', '1', '13', '2015-08-31 01:36:12');
INSERT INTO `hw_hmwork` VALUES ('11', '主要', '飞规划局和哥哥家估计和各个环节', '<p>餐656746747675</p>', '3', '2', '13', '2015-09-01 23:42:38');
INSERT INTO `hw_hmwork` VALUES ('12', '为我去恶趣味请问', '实打实大苏打实打实的', '<p>十大大苏打实打实大苏打</p><p><img src=\"/homework/data/ue/upload/image/20150901/1441122798340295.png\" title=\"1441122798340295.png\" alt=\"结构.png\"/></p><p>实打实大苏打似的撒旦盛大</p>', '3', '1', '13', '2015-09-01 23:53:32');

-- ----------------------------
-- Table structure for `hw_hmworksub`
-- ----------------------------
DROP TABLE IF EXISTS `hw_hmworksub`;
CREATE TABLE `hw_hmworksub` (
  `hmworksubid` int(11) NOT NULL AUTO_INCREMENT,
  `hmworksubcontent` varchar(2048) DEFAULT NULL,
  `hmworksubdesc` varchar(2048) DEFAULT NULL,
  `createtime` varchar(32) DEFAULT NULL,
  `hmworkid` int(11) DEFAULT NULL,
  `studentid` int(11) DEFAULT NULL,
  `hmworkresstate` int(11) DEFAULT NULL,
  `hmworkresscore` int(11) DEFAULT NULL,
  `hmworkresdesc` varchar(2048) DEFAULT NULL,
  `hmworkrescontent` text,
  `rescreatetime` varchar(32) DEFAULT NULL,
  `teacherid` int(11) DEFAULT NULL,
  PRIMARY KEY (`hmworksubid`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of hw_hmworksub
-- ----------------------------
INSERT INTO `hw_hmworksub` VALUES ('5', null, '1312', '2015-09-09 23:31:29', '1', '18', '1', '23', '23', '<p>323321312</p>', '2015-09-10 00:22:57', '13');

-- ----------------------------
-- Table structure for `hw_img`
-- ----------------------------
DROP TABLE IF EXISTS `hw_img`;
CREATE TABLE `hw_img` (
  `imgid` int(11) NOT NULL AUTO_INCREMENT,
  `imgtype` int(11) DEFAULT NULL,
  `imgparentid` int(11) DEFAULT NULL,
  `imgsrc` varchar(512) DEFAULT NULL,
  PRIMARY KEY (`imgid`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of hw_img
-- ----------------------------
INSERT INTO `hw_img` VALUES ('1', '1', '3', 'http://localhost:8080/homework/data/studentfiles/student20150906220031674.png');
INSERT INTO `hw_img` VALUES ('2', '1', '3', 'http://localhost:8080/homework/data/studentfiles/student20150906220036472.png');
INSERT INTO `hw_img` VALUES ('3', '1', '8', 'http://localhost:8080/homework/data/studentfiles/student20150906231523473.png');
INSERT INTO `hw_img` VALUES ('4', '1', '8', 'http://localhost:8080/homework/data/studentfiles/student20150906231528438.png');
INSERT INTO `hw_img` VALUES ('5', '1', '8', 'http://localhost:8080/homework/data/studentfiles/student20150906231531986.png');
INSERT INTO `hw_img` VALUES ('6', '1', '9', 'http://localhost:8080/homework/data/studentfiles/student20150906231642294.png');
INSERT INTO `hw_img` VALUES ('7', '1', '9', 'http://localhost:8080/homework/data/studentfiles/student20150906231645195.png');
INSERT INTO `hw_img` VALUES ('8', '1', '10', 'http://localhost:8080/homework/data/studentfiles/student20150906233345548.jpg');
INSERT INTO `hw_img` VALUES ('9', '1', '11', 'http://localhost:8080/homework/data/studentfiles/student20150908001545894.png');
INSERT INTO `hw_img` VALUES ('10', '1', '5', 'http://localhost:8080/homework/data/studentfiles/student20150909233126313.png');

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
  `usertime` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`userid`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of hw_user
-- ----------------------------
INSERT INTO `hw_user` VALUES ('1', 'admin', null, '53250d93495ec5680ac9a864623a2413', '3', null);
INSERT INTO `hw_user` VALUES ('13', 'zhangsan', '张三', '202cb962ac59075b964b07152d234b70', '1', null);
INSERT INTO `hw_user` VALUES ('14', 'lisi', '李四', '202cb962ac59075b964b07152d234b70', '1', null);
INSERT INTO `hw_user` VALUES ('15', 'wangwu', '王五', 'f1290186a5d0b1ceab27f4e77c0c5d68', '1', null);
INSERT INTO `hw_user` VALUES ('16', 'sa', 'sa', 'c12e01f2a13ff5587e1e9e4aedb8242d', '1', null);
INSERT INTO `hw_user` VALUES ('17', '123', '123', 'c20ad4d76fe97759aa27a0c99bff6710', '1', null);
INSERT INTO `hw_user` VALUES ('18', 'xiaoming', '小明', '202cb962ac59075b964b07152d234b70', '2', null);
INSERT INTO `hw_user` VALUES ('19', 'xiaohong', '小红', '202cb962ac59075b964b07152d234b70', '2', null);
INSERT INTO `hw_user` VALUES ('20', 'xiaoxiao', '小小', '202cb962ac59075b964b07152d234b70', '2', null);
INSERT INTO `hw_user` VALUES ('21', 'xx', 'xx', '202cb962ac59075b964b07152d234b70', '2', null);
INSERT INTO `hw_user` VALUES ('22', 'deckey', 'deckey', '202cb962ac59075b964b07152d234b70', '1', null);
INSERT INTO `hw_user` VALUES ('23', 'qwe', '\'\'\'', '202cb962ac59075b964b07152d234b70', '1', null);
