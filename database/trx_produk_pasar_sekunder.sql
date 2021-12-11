SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for trx_produk_pasar_sekunder
-- ----------------------------
DROP TABLE IF EXISTS `trx_produk_pasar_sekunder`;
CREATE TABLE `trx_produk_pasar_sekunder`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_produk` int(11) NULL DEFAULT NULL,
  `maks_harga_perlembar` double NULL DEFAULT NULL,
  `min_harga_perlembar` double NULL DEFAULT NULL,
  `nilai_biaya_admin` double NULL DEFAULT NULL,
  `jenis_biaya_admin` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `publish` tinyint(4) NULL DEFAULT NULL,
  `id_user` int(11) NULL DEFAULT NULL,
  `created_at` datetime NULL DEFAULT NULL,
  `updated_at` datetime NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` datetime NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of trx_produk_pasar_sekunder
-- ----------------------------
INSERT INTO `trx_produk_pasar_sekunder` VALUES (1, 4, 48500, 55500, 100, 'nominal', 1, 146, NULL, '2021-12-11 23:24:24', NULL);
INSERT INTO `trx_produk_pasar_sekunder` VALUES (2, 2, 49500, 52500, 2, 'persen', 1, 146, '2021-12-11 23:23:12', '2021-12-11 23:35:24', NULL);

SET FOREIGN_KEY_CHECKS = 1;
