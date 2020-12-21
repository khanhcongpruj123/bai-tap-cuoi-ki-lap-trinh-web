/*
 Navicat Premium Data Transfer

 Source Server         : mysql
 Source Server Type    : MySQL
 Source Server Version : 80022
 Source Host           : localhost:3306
 Source Schema         : quanlidonhang

 Target Server Type    : MySQL
 Target Server Version : 80022
 File Encoding         : 65001

 Date: 22/12/2020 01:20:23
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for TBL_ACCOUNT
-- ----------------------------
DROP TABLE IF EXISTS `TBL_ACCOUNT`;
CREATE TABLE `TBL_ACCOUNT` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`,`username`),
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- ----------------------------
-- Records of TBL_ACCOUNT
-- ----------------------------
BEGIN;
INSERT INTO `TBL_ACCOUNT` VALUES (1, 'admin', 'admin');
INSERT INTO `TBL_ACCOUNT` VALUES (2, 'test', 'test');
INSERT INTO `TBL_ACCOUNT` VALUES (4, 'test1', 'TEST');
COMMIT;

-- ----------------------------
-- Table structure for TBL_ITEM
-- ----------------------------
DROP TABLE IF EXISTS `TBL_ITEM`;
CREATE TABLE `TBL_ITEM` (
  `id` int NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `thumnail` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- ----------------------------
-- Records of TBL_ITEM
-- ----------------------------
BEGIN;
INSERT INTO `TBL_ITEM` VALUES (1, 'Macbook Pro M1', 36000000.00, 'img_macbook_m1.jpeg');
INSERT INTO `TBL_ITEM` VALUES (2, 'iPhone 12 Pro', 31000000.00, 'img_iphone_12.jpg');
INSERT INTO `TBL_ITEM` VALUES (3, 'Macbook Air 2020', 27000000.00, 'img_mac_air_2020.jpg');
INSERT INTO `TBL_ITEM` VALUES (4, 'Mac Mini', 18000000.00, 'img_mac_mini.png');
COMMIT;

-- ----------------------------
-- Table structure for TBL_ORDER
-- ----------------------------
DROP TABLE IF EXISTS `TBL_ORDER`;
CREATE TABLE `TBL_ORDER` (
  `id` int NOT NULL AUTO_INCREMENT,
  `item_id` int DEFAULT NULL,
  `user_id` int DEFAULT NULL,
  `count` int DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `status` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `item_id` (`item_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `tbl_order_ibfk_1` FOREIGN KEY (`item_id`) REFERENCES `TBL_ITEM` (`id`),
  CONSTRAINT `tbl_order_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `TBL_USER` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- ----------------------------
-- Records of TBL_ORDER
-- ----------------------------
BEGIN;
INSERT INTO `TBL_ORDER` VALUES (33, 2, 2, 1, 'Nha Trang', '2020-12-21', 0);
INSERT INTO `TBL_ORDER` VALUES (34, 2, 2, 1, 'Nha Trang', '2020-12-21', 0);
INSERT INTO `TBL_ORDER` VALUES (35, 1, 2, 1, 'Ki tuc xa B2', '2020-12-21', 0);
INSERT INTO `TBL_ORDER` VALUES (37, 2, 1, 1, 'dfsdfsfsdf', '2020-11-29', 1);
INSERT INTO `TBL_ORDER` VALUES (38, 2, 3, 1, 'Ki tuc xa B2', '2020-12-21', 0);
COMMIT;

-- ----------------------------
-- Table structure for TBL_USER
-- ----------------------------
DROP TABLE IF EXISTS `TBL_USER`;
CREATE TABLE `TBL_USER` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `sex` int DEFAULT NULL,
  `id_account` int NOT NULL,
  `role` int DEFAULT NULL,
  PRIMARY KEY (`id`,`id_account`),
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- ----------------------------
-- Records of TBL_USER
-- ----------------------------
BEGIN;
INSERT INTO `TBL_USER` VALUES (1, 'Admin', 0, 1, 0);
INSERT INTO `TBL_USER` VALUES (2, 'test', 0, 2, 1);
INSERT INTO `TBL_USER` VALUES (3, 'TRANG', 1, 4, 1);
COMMIT;

SET FOREIGN_KEY_CHECKS = 1;
