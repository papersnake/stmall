/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50615
Source Host           : localhost:3306
Source Database       : stmall

Target Server Type    : MYSQL
Target Server Version : 50615
File Encoding         : 65001

Date: 2014-03-01 14:29:41
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `stmall_oauth_client`
-- ----------------------------
DROP TABLE IF EXISTS `stmall_oauth_client`;
CREATE TABLE `stmall_oauth_client` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `client_id` varchar(32) NOT NULL,
  `client_secret` varchar(32) NOT NULL,
  `redirect_uri` varchar(200) NOT NULL,
  `create_time` int(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of stmall_oauth_client
-- ----------------------------
INSERT INTO `stmall_oauth_client` VALUES ('3', '24976904', '66645095', 'http://localhost/OAuth2test/callback', '1393555936');
INSERT INTO `stmall_oauth_client` VALUES ('4', '198247', 'pb198247', 'https://www.getpostman.com/oauth2/callback', '1393589651');

-- ----------------------------
-- Table structure for `stmall_oauth_code`
-- ----------------------------
DROP TABLE IF EXISTS `stmall_oauth_code`;
CREATE TABLE `stmall_oauth_code` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `client_id` varchar(32) NOT NULL,
  `user_id` varchar(32) NOT NULL,
  `code` varchar(40) NOT NULL,
  `redirect_uri` varchar(200) NOT NULL,
  `expires` int(11) NOT NULL,
  `scope` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=31 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of stmall_oauth_code
-- ----------------------------

-- ----------------------------
-- Table structure for `stmall_oauth_token`
-- ----------------------------
DROP TABLE IF EXISTS `stmall_oauth_token`;
CREATE TABLE `stmall_oauth_token` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `client_id` varchar(32) NOT NULL,
  `user_id` varchar(32) NOT NULL,
  `access_token` varchar(40) NOT NULL,
  `refresh_token` varchar(40) NOT NULL,
  `expires` int(11) NOT NULL,
  `scope` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of stmall_oauth_token
-- ----------------------------



