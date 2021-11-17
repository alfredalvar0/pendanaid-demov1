SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for tbl_komisi_referral
-- ----------------------------
DROP TABLE IF EXISTS `tbl_komisi_referral`;
CREATE TABLE `tbl_komisi_referral`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_produk` int(11) NULL DEFAULT NULL,
  `persen_komisi` int(11) NULL DEFAULT NULL,
  `created_at` datetime NULL DEFAULT NULL,
  `updated_at` datetime NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` datetime NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tbl_komisi_referral
-- ----------------------------
INSERT INTO `tbl_komisi_referral` VALUES (1, 2, 20, NULL, NULL, NULL);

SET FOREIGN_KEY_CHECKS = 1;
