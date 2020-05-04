/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : printtasks

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2020-05-05 01:48:20
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for jobs
-- ----------------------------
DROP TABLE IF EXISTS `jobs`;
CREATE TABLE `jobs` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) DEFAULT 0,
  `order_number` varchar(255) DEFAULT NULL,
  `customer` varchar(255) DEFAULT NULL,
  `project_name` varchar(255) DEFAULT NULL,
  `supplier` varchar(255) DEFAULT '',
  `quantity` int(11) DEFAULT NULL,
  `delivery_date` datetime DEFAULT NULL,
  `status` tinyint(4) DEFAULT 0,
  `archived` int(11) DEFAULT 0 COMMENT '0:not, 1: archived',
  `storage_location` int(10) DEFAULT NULL,
  `created_at` date DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of jobs
-- ----------------------------
INSERT INTO `jobs` VALUES ('1', '0', '12345', 'Thach', 'MPOS', 'VOD', '10', '2020-04-20 00:00:00', '0', '0', '1', '2020-05-04', '2020-05-04 00:00:00');
INSERT INTO `jobs` VALUES ('2', '1', '12345', 'Thach', 'MPOS', 'VOD', '5', '2020-04-20 00:00:00', '0', '0', '1', '2020-05-04', '2020-05-04 00:00:00');
INSERT INTO `jobs` VALUES ('3', '1', '12345', 'Thach', 'MPOS', 'VOP', '5', '2020-04-20 00:00:00', '1', '0', '1', '2020-05-04', '2020-05-04 00:00:00');
INSERT INTO `jobs` VALUES ('4', '0', '123456', 'Toan', 'VOD', 'VOD', '10', '2020-04-30 00:00:00', '0', '0', '2', '2020-05-04', '2020-05-04 00:00:00');
INSERT INTO `jobs` VALUES ('5', '0', 'sfsdfa', 'sdfasd', 'fasdfsd', null, '5', '7070-01-01 00:00:00', '0', '0', '1', '2020-05-04', '2020-05-04 17:54:50');
INSERT INTO `jobs` VALUES ('6', '0', 'sfsdfa', 'sdfasd', 'fasdfsd', null, '5', '7070-01-01 00:00:00', '0', '0', '1', '2020-05-04', '2020-05-04 17:55:54');

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE KEY `admins_email_unique` (`email`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=COMPRESSED;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES ('1', 'Admin Jobtask', 'admin@cmg.ink', null, '$2y$10$0k7GDd9Q8iy1AAuB6LxC.uWx6JMg/XdQ1h8x0MCiRkivKCuP9hvze', 'QRwU9HBm4Ktw94oSdLxBIg8wlNpBnUcFWSAhGa6Oahb2mKcfPdY8mejqtX3P', '2019-09-03 12:02:34', '2019-09-03 12:02:34');
