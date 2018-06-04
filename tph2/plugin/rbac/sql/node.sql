/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50547
Source Host           : localhost:3306
Source Database       : tpadmin

Target Server Type    : MYSQL
Target Server Version : 50547
File Encoding         : 65001

Date: 2018-05-08 17:18:38
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for tp_admin_node
-- ----------------------------
DROP TABLE IF EXISTS `tp_admin_node`;
CREATE TABLE `tp_admin_node` (
  `id` smallint(6) unsigned NOT NULL AUTO_INCREMENT,
  `pid` smallint(6) unsigned NOT NULL DEFAULT '0',
  `group_id` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `name` varchar(255) NOT NULL DEFAULT '',
  `title` varchar(50) NOT NULL DEFAULT '',
  `remark` varchar(255) NOT NULL DEFAULT '',
  `level` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `type` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '节点类型，1-控制器 | 0-方法',
  `sort` smallint(6) unsigned NOT NULL DEFAULT '50',
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `isdelete` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `level` (`level`),
  KEY `pid` (`pid`),
  KEY `status` (`status`),
  KEY `name` (`name`),
  KEY `isdelete` (`isdelete`),
  KEY `sort` (`sort`),
  KEY `group_id` (`group_id`)
) ENGINE=MyISAM AUTO_INCREMENT=70 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of tp_admin_node
-- ----------------------------
INSERT INTO `tp_admin_node` VALUES ('1', '0', '1', 'Admin', '后台管理', '后台管理，不可更改', '1', '1', '1', '1', '0');
INSERT INTO `tp_admin_node` VALUES ('2', '1', '1', 'AdminGroup', '分组管理', ' ', '2', '1', '1', '1', '0');
INSERT INTO `tp_admin_node` VALUES ('3', '1', '1', 'AdminNode', '节点管理', ' ', '2', '1', '2', '1', '0');
INSERT INTO `tp_admin_node` VALUES ('4', '1', '1', 'AdminRole', '角色管理', ' ', '2', '1', '3', '1', '0');
INSERT INTO `tp_admin_node` VALUES ('5', '1', '1', 'AdminUser', '用户管理', '', '2', '1', '4', '1', '0');
INSERT INTO `tp_admin_node` VALUES ('6', '1', '0', 'Index', '首页', '', '2', '1', '50', '1', '0');
INSERT INTO `tp_admin_node` VALUES ('7', '6', '0', 'welcome', '欢迎页', '', '3', '0', '50', '1', '0');
INSERT INTO `tp_admin_node` VALUES ('8', '6', '0', 'index', '未定义', '', '3', '0', '50', '1', '0');
INSERT INTO `tp_admin_node` VALUES ('9', '1', '2', 'Generate', '代码自动生成', '', '2', '1', '50', '1', '0');
INSERT INTO `tp_admin_node` VALUES ('10', '1', '2', 'Demo/excel', 'Excel一键导出', '', '2', '0', '2', '1', '0');
INSERT INTO `tp_admin_node` VALUES ('11', '1', '2', 'Demo/download', '下载', '', '2', '0', '3', '1', '0');
INSERT INTO `tp_admin_node` VALUES ('12', '1', '2', 'Demo/downloadImage', '远程图片下载', '', '2', '0', '4', '1', '0');
INSERT INTO `tp_admin_node` VALUES ('13', '1', '2', 'Demo/mail', '邮件发送', '', '2', '0', '5', '1', '0');
INSERT INTO `tp_admin_node` VALUES ('14', '1', '2', 'Demo/qiniu', '七牛上传', '', '2', '0', '6', '1', '0');
INSERT INTO `tp_admin_node` VALUES ('15', '1', '2', 'Demo/hashids', 'ID加密', '', '2', '0', '7', '1', '0');
INSERT INTO `tp_admin_node` VALUES ('16', '1', '2', 'Demo/layer', '丰富弹层', '', '2', '0', '8', '1', '0');
INSERT INTO `tp_admin_node` VALUES ('17', '1', '2', 'Demo/tableFixed', '表格溢出', '', '2', '0', '9', '1', '0');
INSERT INTO `tp_admin_node` VALUES ('18', '1', '2', 'Demo/ueditor', '百度编辑器', '', '2', '0', '10', '1', '0');
INSERT INTO `tp_admin_node` VALUES ('19', '1', '2', 'Demo/imageUpload', '图片上传', '', '2', '0', '11', '1', '0');
INSERT INTO `tp_admin_node` VALUES ('20', '1', '2', 'Demo/qrcode', '二维码生成', '', '2', '0', '12', '1', '0');
INSERT INTO `tp_admin_node` VALUES ('21', '1', '1', 'NodeMap', '节点图', '', '2', '1', '5', '1', '0');
INSERT INTO `tp_admin_node` VALUES ('22', '1', '1', 'WebLog', '操作日志', '', '2', '1', '6', '1', '0');
INSERT INTO `tp_admin_node` VALUES ('23', '1', '1', 'LoginLog', '登录日志', '', '2', '1', '7', '1', '0');
INSERT INTO `tp_admin_node` VALUES ('59', '1', '2', 'one.two.three.Four/index', '多级节点', '', '2', '0', '50', '1', '0');
INSERT INTO `tp_admin_node` VALUES ('24', '23', '0', 'index', '首页', '', '3', '0', '50', '1', '0');
INSERT INTO `tp_admin_node` VALUES ('25', '22', '0', 'index', '列表', '', '3', '0', '50', '1', '0');
INSERT INTO `tp_admin_node` VALUES ('26', '22', '0', 'detail', '详情', '', '3', '0', '50', '1', '0');
INSERT INTO `tp_admin_node` VALUES ('27', '21', '0', 'load', '自动导入', '', '3', '0', '50', '1', '0');
INSERT INTO `tp_admin_node` VALUES ('28', '21', '0', 'index', '首页', '', '3', '0', '50', '1', '0');
INSERT INTO `tp_admin_node` VALUES ('29', '5', '0', 'add', '添加', '', '3', '0', '51', '1', '0');
INSERT INTO `tp_admin_node` VALUES ('30', '21', '0', 'edit', '编辑', '', '3', '0', '50', '1', '0');
INSERT INTO `tp_admin_node` VALUES ('31', '21', '0', 'deleteForever', '永久删除', '', '3', '0', '50', '1', '0');
INSERT INTO `tp_admin_node` VALUES ('32', '9', '0', 'index', '首页', '', '3', '0', '50', '1', '0');
INSERT INTO `tp_admin_node` VALUES ('33', '9', '0', 'generate', '生成方法', '', '3', '0', '50', '1', '0');
INSERT INTO `tp_admin_node` VALUES ('34', '5', '0', 'password', '修改密码', '', '3', '0', '50', '1', '0');
INSERT INTO `tp_admin_node` VALUES ('35', '5', '0', 'index', '首页', '', '3', '0', '50', '1', '0');
INSERT INTO `tp_admin_node` VALUES ('36', '5', '0', 'add', '添加', '', '3', '0', '50', '1', '0');
INSERT INTO `tp_admin_node` VALUES ('37', '5', '0', 'edit', '编辑', '', '3', '0', '50', '1', '0');
INSERT INTO `tp_admin_node` VALUES ('38', '4', '0', 'user', '用户列表', '', '3', '0', '50', '1', '0');
INSERT INTO `tp_admin_node` VALUES ('39', '4', '0', 'access', '授权', '', '3', '0', '50', '1', '0');
INSERT INTO `tp_admin_node` VALUES ('40', '4', '0', 'index', '首页', '', '3', '0', '50', '1', '0');
INSERT INTO `tp_admin_node` VALUES ('41', '4', '0', 'add', '添加', '', '3', '0', '50', '1', '0');
INSERT INTO `tp_admin_node` VALUES ('42', '4', '0', 'edit', '编辑', '', '3', '0', '50', '1', '0');
INSERT INTO `tp_admin_node` VALUES ('43', '4', '0', 'forbid', '默认禁用操作', '', '3', '0', '50', '1', '0');
INSERT INTO `tp_admin_node` VALUES ('44', '4', '0', 'resume', '默认恢复操作', '', '3', '0', '50', '1', '0');
INSERT INTO `tp_admin_node` VALUES ('45', '3', '0', 'load', '节点快速导入测试', '', '3', '0', '50', '0', '0');
INSERT INTO `tp_admin_node` VALUES ('46', '3', '0', 'index', '首页', '', '3', '0', '50', '1', '0');
INSERT INTO `tp_admin_node` VALUES ('47', '3', '0', 'add', '添加', '', '3', '0', '50', '1', '0');
INSERT INTO `tp_admin_node` VALUES ('48', '3', '0', 'edit', '编辑', '', '3', '0', '50', '1', '0');
INSERT INTO `tp_admin_node` VALUES ('49', '3', '0', 'forbid', '默认禁用操作', '', '3', '0', '50', '1', '0');
INSERT INTO `tp_admin_node` VALUES ('50', '3', '0', 'resume', '默认恢复操作', '', '3', '0', '50', '1', '0');
INSERT INTO `tp_admin_node` VALUES ('51', '2', '0', 'index', '首页', '', '3', '0', '50', '1', '0');
INSERT INTO `tp_admin_node` VALUES ('52', '2', '0', 'add', '添加', '', '3', '0', '50', '1', '0');
INSERT INTO `tp_admin_node` VALUES ('53', '2', '0', 'edit', '编辑', '', '3', '0', '50', '1', '0');
INSERT INTO `tp_admin_node` VALUES ('54', '2', '0', 'forbid', '默认禁用操作', '', '3', '0', '51', '1', '0');
INSERT INTO `tp_admin_node` VALUES ('55', '2', '0', 'resume', '默认恢复操作', '', '3', '0', '50', '1', '0');
INSERT INTO `tp_admin_node` VALUES ('56', '1', '2', 'one', '一级菜单', '', '2', '1', '13', '1', '0');
INSERT INTO `tp_admin_node` VALUES ('60', '56', '2', 'two', '二级', '', '3', '1', '50', '1', '0');
INSERT INTO `tp_admin_node` VALUES ('61', '60', '2', 'three', '三级菜单', '', '4', '1', '50', '1', '0');
INSERT INTO `tp_admin_node` VALUES ('62', '61', '2', 'Four', '四级菜单', '', '5', '1', '50', '1', '0');
INSERT INTO `tp_admin_node` VALUES ('63', '0', '1', 'Test', '测试1111', '', '1', '1', '50', '1', '0');
INSERT INTO `tp_admin_node` VALUES ('64', '0', '0', 'fish', '机构职责', '', '1', '1', '50', '1', '1');
INSERT INTO `tp_admin_node` VALUES ('65', '2', '0', 'fish', '1111', '', '3', '1', '50', '1', '1');
INSERT INTO `tp_admin_node` VALUES ('66', '0', '1', 'Test2', 'Test2', '', '1', '1', '50', '1', '1');
INSERT INTO `tp_admin_node` VALUES ('67', '2', '0', 'fish', '1111', '', '3', '1', '50', '1', '1');
INSERT INTO `tp_admin_node` VALUES ('68', '63', '1', 'Test', '测试节点', '', '2', '1', '50', '1', '0');
INSERT INTO `tp_admin_node` VALUES ('69', '68', '0', 'index', '测试首页', '', '3', '1', '50', '1', '0');
