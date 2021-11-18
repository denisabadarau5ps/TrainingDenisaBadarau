/*
 Navicat MySQL Data Transfer

 Source Server         : localhost
 Source Server Type    : MySQL
 Source Server Version : 100421
 Source Host           : localhost:3306
 Source Schema         : productsdb

 Target Server Type    : MySQL
 Target Server Version : 100421
 File Encoding         : 65001

 Date: 18/11/2021 11:46:45
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for products
-- ----------------------------
DROP TABLE IF EXISTS `products`;
CREATE TABLE `products`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `price` decimal(10, 2) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 14 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of products
-- ----------------------------
INSERT INTO `products` VALUES (1, 'TV', 'Smart tv', 500.00);
INSERT INTO `products` VALUES (3, 'microwave', 'heats and cooks food', 99.99);
INSERT INTO `products` VALUES (4, 'toaster', '4 slot toaster ', 49.99);
INSERT INTO `products` VALUES (5, 'washing machine', 'washing machine with spin speed of 1400 rpm', 249.99);
INSERT INTO `products` VALUES (6, 'blender', 'high speed blender with vacuum mixing', 99.99);
INSERT INTO `products` VALUES (7, 'vacuum cleaner', 'triple action nozle for thorough vacuuming of coarse and fine dirt', 56.99);
INSERT INTO `products` VALUES (9, 'refrigerator', 'Domestic refrigerators and freezers for food storage are made in a range of sizes.', 299.00);
INSERT INTO `products` VALUES (10, 'Laptop', 'Laptop Lenovo ThinkBook 15 G2 (Procesor AMD Ryzen 3 4300U up to 3.70 GHz)', 399.00);
INSERT INTO `products` VALUES (13, 'Iphone X', 'New iphone', 600.00);

SET FOREIGN_KEY_CHECKS = 1;
