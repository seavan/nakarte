/*
Navicat MySQL Data Transfer

Source Server         : dev.notamedia.ru
Source Server Version : 50051
Source Host           : localhost:3306
Source Database       : nakarte_dev

Target Server Type    : MYSQL
Target Server Version : 50051
File Encoding         : 65001

Date: 2010-05-01 11:21:44
*/

SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for `photos`
-- ----------------------------
DROP TABLE IF EXISTS `photos`;
CREATE TABLE `photos` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `user_id` int(11) unsigned default NULL,
  `poi_id` int(11) unsigned NOT NULL,
  `guid` tinytext character set utf8 NOT NULL,
  `descr` text character set utf8 NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=51 DEFAULT CHARSET=cp1251;

-- ----------------------------
-- Records of photos
-- ----------------------------
INSERT INTO `photos` VALUES ('45', null, '38153', '3D99BE7F64C6', '');
INSERT INTO `photos` VALUES ('46', null, '19456', '20DE13CF07D3', '');
INSERT INTO `photos` VALUES ('47', null, '19456', '01353DEAB6EC', '');
INSERT INTO `photos` VALUES ('48', null, '19456', '4D7CD860B265', '');
INSERT INTO `photos` VALUES ('49', null, '19456', '3DD2A2C75343', '');
INSERT INTO `photos` VALUES ('50', null, '19456', '4114A2775309', '');
