/*
Navicat MySQL Data Transfer

Source Server         : 本地
Source Server Version : 50719
Source Host           : localhost:3306
Source Database       : tp5

Target Server Type    : MYSQL
Target Server Version : 50719
File Encoding         : 65001

Date: 2018-01-12 19:30:04
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for tp_admin
-- ----------------------------
DROP TABLE IF EXISTS `tp_admin`;
CREATE TABLE `tp_admin` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '管理员id',
  `name` varchar(30) NOT NULL COMMENT '管理员名称',
  `password` varchar(255) NOT NULL COMMENT '管理员密码',
  `create_time` int(10) unsigned NOT NULL,
  `update_time` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `index_name` (`name`),
  KEY `index_password` (`password`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=2027966 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tp_admin
-- ----------------------------
INSERT INTO `tp_admin` VALUES ('1', 'admin', '$2y$10$zKXoAC6RnK/qOHg7..DTeuZ4WAbG0mLSqBF.7Q8t8toUtpKkAd4VS', '1533123132', '0');
INSERT INTO `tp_admin` VALUES ('2027965', 'test02', '$2y$10$MqoZXvFgbzNw2C.TXtYYR.Xw9CCqZ5F5XjgdMARH81sL/6z6iUChS', '1515743108', '1515743108');
INSERT INTO `tp_admin` VALUES ('2027964', 'test01', '$2y$10$zKXoAC6RnK/qOHg7..DTeuZ4WAbG0mLSqBF.7Q8t8toUtpKkAd4VS', '1515724531', '1515724531');

-- ----------------------------
-- Table structure for tp_auth_group
-- ----------------------------
DROP TABLE IF EXISTS `tp_auth_group`;
CREATE TABLE `tp_auth_group` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `title` char(100) NOT NULL DEFAULT '',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `rules` char(80) NOT NULL DEFAULT '',
  `create_time` int(10) unsigned NOT NULL,
  `update_time` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tp_auth_group
-- ----------------------------
INSERT INTO `tp_auth_group` VALUES ('1', '超级管理员', '1', '15,16,19,18,17,1,9,11,14,13,12,2,3,20,10,4,21,30,22,23,24,25,26,27,28,29', '1514188435', '0');
INSERT INTO `tp_auth_group` VALUES ('3', '链接专员', '1', '2,3,20,10,4', '1514188435', '0');
INSERT INTO `tp_auth_group` VALUES ('4', '配置管理员', '1', '1,9,11,14,13,12', '1514188435', '0');
INSERT INTO `tp_auth_group` VALUES ('7', '12312312', '1', '21,15,22,23,24,25,26,29,28,27,16,17,18,19', '1515188435', '1515742504');

-- ----------------------------
-- Table structure for tp_auth_group_access
-- ----------------------------
DROP TABLE IF EXISTS `tp_auth_group_access`;
CREATE TABLE `tp_auth_group_access` (
  `uid` mediumint(8) unsigned NOT NULL COMMENT '用户id',
  `group_id` mediumint(8) unsigned NOT NULL COMMENT '用户组id',
  UNIQUE KEY `uid_group_id` (`uid`,`group_id`),
  KEY `uid` (`uid`),
  KEY `group_id` (`group_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tp_auth_group_access
-- ----------------------------
INSERT INTO `tp_auth_group_access` VALUES ('1', '1');
INSERT INTO `tp_auth_group_access` VALUES ('28', '5');
INSERT INTO `tp_auth_group_access` VALUES ('29', '6');
INSERT INTO `tp_auth_group_access` VALUES ('30', '6');

-- ----------------------------
-- Table structure for tp_auth_rule
-- ----------------------------
DROP TABLE IF EXISTS `tp_auth_rule`;
CREATE TABLE `tp_auth_rule` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `name` char(80) NOT NULL DEFAULT '',
  `title` char(20) NOT NULL DEFAULT '',
  `type` tinyint(1) NOT NULL DEFAULT '1',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `condition` char(100) NOT NULL DEFAULT '',
  `pid` mediumint(9) NOT NULL DEFAULT '0',
  `level` tinyint(1) NOT NULL DEFAULT '0',
  `sort` int(5) NOT NULL DEFAULT '50',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=MyISAM AUTO_INCREMENT=33 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tp_auth_rule
-- ----------------------------
INSERT INTO `tp_auth_rule` VALUES ('29', 'authrule/del', '权限删除', '1', '1', '', '26', '2', '50');
INSERT INTO `tp_auth_rule` VALUES ('22', 'authgroup/index', '用户组列表', '1', '1', '', '15', '1', '50');
INSERT INTO `tp_auth_rule` VALUES ('28', 'authrule/edit', '权限修改', '1', '1', '', '26', '2', '50');
INSERT INTO `tp_auth_rule` VALUES ('23', 'authgroup/add', '用户组添加', '1', '1', '', '22', '2', '50');
INSERT INTO `tp_auth_rule` VALUES ('24', 'authgroup/edit', '用户组修改', '1', '1', '', '22', '2', '50');
INSERT INTO `tp_auth_rule` VALUES ('25', 'authgroup/del', '用户组删除', '1', '1', '', '22', '2', '50');
INSERT INTO `tp_auth_rule` VALUES ('26', 'authrule/index', '权限列表', '1', '1', '', '15', '1', '50');
INSERT INTO `tp_auth_rule` VALUES ('15', 'admin', '管理员', '1', '1', '', '0', '0', '50');
INSERT INTO `tp_auth_rule` VALUES ('16', 'admin/index', '管理员列表', '1', '1', '', '15', '1', '50');
INSERT INTO `tp_auth_rule` VALUES ('17', 'admin/add', '管理员添加', '1', '1', '', '16', '2', '50');
INSERT INTO `tp_auth_rule` VALUES ('18', 'admin/del', '管理员删除', '1', '1', '', '16', '2', '50');
INSERT INTO `tp_auth_rule` VALUES ('19', 'admin/edit', '管理员修改', '1', '1', '', '16', '2', '50');
INSERT INTO `tp_auth_rule` VALUES ('27', 'authrule/add', '权限添加', '1', '1', '', '26', '2', '50');

-- ----------------------------
-- Table structure for tp_users
-- ----------------------------
DROP TABLE IF EXISTS `tp_users`;
CREATE TABLE `tp_users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `create_time` datetime NOT NULL,
  `update_time` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COMMENT='前台用户（仓库）登陆表';

-- ----------------------------
-- Records of tp_users
-- ----------------------------
INSERT INTO `tp_users` VALUES ('1', 'admin', '202cb962ac59075b964b07152d234b70', '2017-12-13 11:11:03', '2017-12-13 11:11:07');
INSERT INTO `tp_users` VALUES ('2', 'admin', '202cb962ac59075b964b07152d234b70', '2017-12-13 11:11:03', '2017-12-13 11:11:07');
