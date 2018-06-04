/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50547
Source Host           : localhost:3306
Source Database       : tpadmin

Target Server Type    : MYSQL
Target Server Version : 50547
File Encoding         : 65001

Date: 2018-05-08 17:18:54
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for tp_admin_role
-- ----------------------------
DROP TABLE IF EXISTS `tp_admin_role`;
CREATE TABLE `tp_admin_role` (
  `id` smallint(6) unsigned NOT NULL AUTO_INCREMENT,
  `pid` smallint(6) unsigned NOT NULL DEFAULT '0' COMMENT '父级id',
  `name` varchar(20) NOT NULL DEFAULT '' COMMENT '名称',
  `remark` varchar(255) NOT NULL DEFAULT '' COMMENT '备注',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '状态',
  `isdelete` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `create_time` int(11) unsigned NOT NULL DEFAULT '0',
  `update_time` int(11) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `parentId` (`pid`),
  KEY `status` (`status`),
  KEY `isdelete` (`isdelete`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of tp_admin_role
-- ----------------------------
INSERT INTO `tp_admin_role` VALUES ('1', '0', '领导组', ' ', '1', '0', '1208784792', '1254325558');
INSERT INTO `tp_admin_role` VALUES ('2', '0', '网编组', ' ', '1', '0', '1215496283', '1454049929');
INSERT INTO `tp_admin_role` VALUES ('3', '0', '测试组', '', '1', '0', '1525753135', '1525753135');
