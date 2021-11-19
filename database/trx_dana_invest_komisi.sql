SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for trx_dana_invest_komisi
-- ----------------------------
DROP TABLE IF EXISTS `trx_dana_invest_komisi`;
CREATE TABLE `trx_dana_invest_komisi`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_dana` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `id_pengguna` int(11) NULL DEFAULT NULL,
  `persen_komisi` int(11) NULL DEFAULT NULL,
  `status` int(11) NULL DEFAULT NULL,
  `keterangan` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `created_at` datetime NULL DEFAULT NULL,
  `updated_at` datetime NULL DEFAULT NULL,
  `deleted_at` datetime NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of trx_dana_invest_komisi
-- ----------------------------
INSERT INTO `trx_dana_invest_komisi` VALUES (1, '20211116131617', 141, 20, 1, 'OK', '2021-11-17 14:49:28', NULL, NULL);

SET FOREIGN_KEY_CHECKS = 1;
