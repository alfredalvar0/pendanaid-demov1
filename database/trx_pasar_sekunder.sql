SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for trx_pasar_sekunder
-- ----------------------------
DROP TABLE IF EXISTS `trx_pasar_sekunder`;
CREATE TABLE `trx_pasar_sekunder`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_pengguna` int(11) NULL DEFAULT NULL,
  `id_produk` int(11) NULL DEFAULT NULL,
  `jenis_transaksi` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `lembar_saham` int(11) NULL DEFAULT NULL,
  `harga_per_lembar` decimal(10, 0) NULL DEFAULT NULL,
  `total` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `created_at` datetime NULL DEFAULT NULL,
  `updated_at` datetime NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` datetime NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of trx_pasar_sekunder
-- ----------------------------
INSERT INTO `trx_pasar_sekunder` VALUES (1, 169, 2, 'jual', 3, 55000, '165000', 'pending', '2021-12-07 13:44:01', NULL, NULL);
INSERT INTO `trx_pasar_sekunder` VALUES (2, 169, 4, 'jual', 2, 55000, '110000', 'pending', '2021-12-07 13:45:21', NULL, NULL);
INSERT INTO `trx_pasar_sekunder` VALUES (3, 169, 2, 'beli', 2, 50000, '100000', 'success', '2021-12-06 13:45:21', NULL, NULL);

SET FOREIGN_KEY_CHECKS = 1;
