/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50547
Source Host           : localhost:3306
Source Database       : tpadmin

Target Server Type    : MYSQL
Target Server Version : 50547
File Encoding         : 65001

Date: 2018-05-08 17:18:19
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for tp_admin_access
-- ----------------------------
DROP TABLE IF EXISTS `tp_admin_access`;
CREATE TABLE `tp_admin_access` (
  `role_id` smallint(6) unsigned NOT NULL DEFAULT '0',
  `node_id` smallint(6) unsigned NOT NULL DEFAULT '0',
  `level` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `pid` smallint(6) unsigned NOT NULL DEFAULT '0',
  KEY `groupId` (`role_id`),
  KEY `nodeId` (`node_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of tp_admin_access
-- ----------------------------
INSERT INTO `tp_admin_access` VALUES ('1', '68', '2', '63');
INSERT INTO `tp_admin_access` VALUES ('1', '63', '1', '0');
INSERT INTO `tp_admin_access` VALUES ('3', '68', '2', '63');
INSERT INTO `tp_admin_access` VALUES ('3', '63', '1', '0');
INSERT INTO `tp_admin_access` VALUES ('3', '33', '3', '9');
INSERT INTO `tp_admin_access` VALUES ('3', '32', '3', '9');
INSERT INTO `tp_admin_access` VALUES ('3', '9', '2', '1');
INSERT INTO `tp_admin_access` VALUES ('3', '8', '3', '6');
INSERT INTO `tp_admin_access` VALUES ('3', '7', '3', '6');
INSERT INTO `tp_admin_access` VALUES ('3', '6', '2', '1');
INSERT INTO `tp_admin_access` VALUES ('3', '44', '3', '4');
INSERT INTO `tp_admin_access` VALUES ('3', '43', '3', '4');
INSERT INTO `tp_admin_access` VALUES ('3', '42', '3', '4');
INSERT INTO `tp_admin_access` VALUES ('3', '41', '3', '4');
INSERT INTO `tp_admin_access` VALUES ('3', '40', '3', '4');
INSERT INTO `tp_admin_access` VALUES ('3', '39', '3', '4');
INSERT INTO `tp_admin_access` VALUES ('3', '38', '3', '4');
INSERT INTO `tp_admin_access` VALUES ('3', '4', '2', '1');
INSERT INTO `tp_admin_access` VALUES ('3', '50', '3', '3');
INSERT INTO `tp_admin_access` VALUES ('3', '49', '3', '3');
INSERT INTO `tp_admin_access` VALUES ('3', '48', '3', '3');
INSERT INTO `tp_admin_access` VALUES ('3', '47', '3', '3');
INSERT INTO `tp_admin_access` VALUES ('3', '46', '3', '3');
INSERT INTO `tp_admin_access` VALUES ('3', '3', '2', '1');
INSERT INTO `tp_admin_access` VALUES ('3', '55', '3', '2');
INSERT INTO `tp_admin_access` VALUES ('3', '54', '3', '2');
INSERT INTO `tp_admin_access` VALUES ('3', '53', '3', '2');
INSERT INTO `tp_admin_access` VALUES ('3', '52', '3', '2');
INSERT INTO `tp_admin_access` VALUES ('3', '51', '3', '2');
INSERT INTO `tp_admin_access` VALUES ('3', '2', '2', '1');
INSERT INTO `tp_admin_access` VALUES ('3', '1', '1', '0');
INSERT INTO `tp_admin_access` VALUES ('2', '1', '1', '0');
INSERT INTO `tp_admin_access` VALUES ('2', '2', '2', '1');
INSERT INTO `tp_admin_access` VALUES ('2', '51', '3', '2');
INSERT INTO `tp_admin_access` VALUES ('2', '52', '3', '2');
INSERT INTO `tp_admin_access` VALUES ('2', '53', '3', '2');
INSERT INTO `tp_admin_access` VALUES ('2', '54', '3', '2');
INSERT INTO `tp_admin_access` VALUES ('2', '55', '3', '2');
INSERT INTO `tp_admin_access` VALUES ('2', '3', '2', '1');
INSERT INTO `tp_admin_access` VALUES ('2', '46', '3', '3');
INSERT INTO `tp_admin_access` VALUES ('2', '47', '3', '3');
INSERT INTO `tp_admin_access` VALUES ('2', '48', '3', '3');
INSERT INTO `tp_admin_access` VALUES ('2', '49', '3', '3');
INSERT INTO `tp_admin_access` VALUES ('2', '50', '3', '3');
INSERT INTO `tp_admin_access` VALUES ('2', '4', '2', '1');
INSERT INTO `tp_admin_access` VALUES ('2', '38', '3', '4');
INSERT INTO `tp_admin_access` VALUES ('2', '39', '3', '4');
INSERT INTO `tp_admin_access` VALUES ('2', '40', '3', '4');
INSERT INTO `tp_admin_access` VALUES ('2', '41', '3', '4');
INSERT INTO `tp_admin_access` VALUES ('2', '42', '3', '4');
INSERT INTO `tp_admin_access` VALUES ('2', '43', '3', '4');
INSERT INTO `tp_admin_access` VALUES ('2', '44', '3', '4');
INSERT INTO `tp_admin_access` VALUES ('2', '5', '2', '1');
INSERT INTO `tp_admin_access` VALUES ('2', '29', '3', '5');
INSERT INTO `tp_admin_access` VALUES ('2', '34', '3', '5');
INSERT INTO `tp_admin_access` VALUES ('2', '35', '3', '5');
INSERT INTO `tp_admin_access` VALUES ('2', '36', '3', '5');
INSERT INTO `tp_admin_access` VALUES ('2', '37', '3', '5');
INSERT INTO `tp_admin_access` VALUES ('2', '6', '2', '1');
INSERT INTO `tp_admin_access` VALUES ('2', '7', '3', '6');
INSERT INTO `tp_admin_access` VALUES ('2', '8', '3', '6');
INSERT INTO `tp_admin_access` VALUES ('2', '9', '2', '1');
INSERT INTO `tp_admin_access` VALUES ('2', '32', '3', '9');
INSERT INTO `tp_admin_access` VALUES ('2', '33', '3', '9');
INSERT INTO `tp_admin_access` VALUES ('2', '10', '2', '1');
INSERT INTO `tp_admin_access` VALUES ('2', '11', '2', '1');
INSERT INTO `tp_admin_access` VALUES ('2', '12', '2', '1');
INSERT INTO `tp_admin_access` VALUES ('2', '13', '2', '1');
INSERT INTO `tp_admin_access` VALUES ('2', '14', '2', '1');
INSERT INTO `tp_admin_access` VALUES ('2', '15', '2', '1');
INSERT INTO `tp_admin_access` VALUES ('2', '16', '2', '1');
INSERT INTO `tp_admin_access` VALUES ('2', '17', '2', '1');
INSERT INTO `tp_admin_access` VALUES ('2', '18', '2', '1');
INSERT INTO `tp_admin_access` VALUES ('2', '19', '2', '1');
INSERT INTO `tp_admin_access` VALUES ('2', '20', '2', '1');
INSERT INTO `tp_admin_access` VALUES ('2', '21', '2', '1');
INSERT INTO `tp_admin_access` VALUES ('2', '27', '3', '21');
INSERT INTO `tp_admin_access` VALUES ('2', '28', '3', '21');
INSERT INTO `tp_admin_access` VALUES ('2', '30', '3', '21');
INSERT INTO `tp_admin_access` VALUES ('2', '31', '3', '21');
INSERT INTO `tp_admin_access` VALUES ('2', '22', '2', '1');
INSERT INTO `tp_admin_access` VALUES ('2', '25', '3', '22');
INSERT INTO `tp_admin_access` VALUES ('2', '26', '3', '22');
INSERT INTO `tp_admin_access` VALUES ('2', '23', '2', '1');
INSERT INTO `tp_admin_access` VALUES ('2', '24', '3', '23');
INSERT INTO `tp_admin_access` VALUES ('2', '59', '2', '1');
INSERT INTO `tp_admin_access` VALUES ('2', '56', '2', '1');
INSERT INTO `tp_admin_access` VALUES ('2', '60', '3', '56');
INSERT INTO `tp_admin_access` VALUES ('2', '61', '4', '60');
INSERT INTO `tp_admin_access` VALUES ('2', '62', '5', '61');
INSERT INTO `tp_admin_access` VALUES ('1', '69', '3', '68');
INSERT INTO `tp_admin_access` VALUES ('3', '69', '3', '68');
