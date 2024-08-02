/*
 Navicat Premium Data Transfer

 Source Server         : homestead
 Source Server Type    : MySQL
 Source Server Version : 100417
 Source Host           : localhost:3306
 Source Schema         : test

 Target Server Type    : MySQL
 Target Server Version : 100417
 File Encoding         : 65001

 Date: 02/08/2024 21:54:11
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for urls
-- ----------------------------
DROP TABLE IF EXISTS `urls`;
CREATE TABLE `urls`  (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `user_id` int(10) NULL DEFAULT NULL,
  `original_url` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `short_url` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  `deleted_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of urls
-- ----------------------------
INSERT INTO `urls` VALUES (1, 1, 'https://www.youtube.com/watch?v=PpWS2y9Yipw', 'ExSdt', '2024-08-02 05:46:36', '2024-08-02 08:58:30', '2024-08-02 08:58:30');
INSERT INTO `urls` VALUES (2, 1, 'https://www.youtube.com/watch?v=HLKiICV2gN8', 'zD74s', '2024-08-02 09:13:37', '2024-08-02 13:43:57', NULL);
INSERT INTO `urls` VALUES (3, 3, 'https://www.youtube.com/watch?v=BaJ-E4Rb14w', 'ExreH', '2024-08-02 13:52:18', '2024-08-02 14:48:11', '2024-08-02 14:48:11');
INSERT INTO `urls` VALUES (4, 3, 'https://www.youtube.com/watch?v=k8fSPMXWAR4', 'fIXxY', '2024-08-02 13:52:34', '2024-08-02 13:52:34', NULL);

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp(0) NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  `is_admin` tinyint(1) NULL DEFAULT 0,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `users_email_unique`(`email`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES (1, 'juuuu', 'ju@email.com', NULL, '$2y$10$7IYh5ppXMuJe9ovPIvJ4RuyfX694RCNcD1EkUxDKiAm.bSutMzpvG', 'lSsrB107huQeKrdN1zt3wb3YohBaCKzTd5DfGQoYX4ucyKIdnONfS5DfYIh9', '2024-08-02 05:39:42', '2024-08-02 05:39:42', 0);
INSERT INTO `users` VALUES (2, 'admin', 'admin@email.com', NULL, '$2y$10$l9QZa9lhsJpRoAn7K1ioVeJG3kaR2hR7X.SVy2nNzVrBlz/F4UkSK', 'qjhXEyOQ52rPwQje8X7DNZb1a5JdvrcS97UQhezAsbhHenyznGhGM4y6YlOQ', '2024-08-02 05:47:17', '2024-08-02 05:47:17', 1);
INSERT INTO `users` VALUES (3, 'pam', 'pam@email.com', NULL, '$2y$10$0eSJycRJa/x2CAaegWFj/.2ABZ9PKZnMtHbG9BiP2jD9SokiintMi', 'NsRNob5zP0mpUGDclL3WvJNPd1p5rwApenY2j1AstWtQ7A50iYmgHoW0KfDQ', '2024-08-02 13:50:31', '2024-08-02 13:50:31', 0);
INSERT INTO `users` VALUES (4, 'jutha', 'jutha@email.com', NULL, '$2y$10$Nyn1.fTavdDOfOTKoB6TBus9Vo1hYebPRPbyPrBzXQM4hdPx8Rmx2', 'B5t44uw0tRNX9cCXVTSUwa1TLWCLNLrshraOXKAL1OTIOHDNcsYtkYIGmwfF', '2024-08-02 14:45:10', '2024-08-02 14:45:10', 0);

SET FOREIGN_KEY_CHECKS = 1;
