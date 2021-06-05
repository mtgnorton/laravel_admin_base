/*
 Navicat Premium Data Transfer

 Source Server         : 本地
 Source Server Type    : MySQL
 Source Server Version : 50726
 Source Host           : localhost:3306
 Source Schema         : base_api

 Target Server Type    : MySQL
 Target Server Version : 50726
 File Encoding         : 65001

 Date: 05/06/2021 15:42:40
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for advert_categories
-- ----------------------------
DROP TABLE IF EXISTS `advert_categories`;
CREATE TABLE `advert_categories`  (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '广告分类名称',
  `width` int(11) NOT NULL DEFAULT 0 COMMENT '图片宽度',
  `height` int(11) NOT NULL DEFAULT 0 COMMENT '图片高度',
  `identifying` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '广告分类标识',
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci COMMENT = '广告分类' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of advert_categories
-- ----------------------------

-- ----------------------------
-- Table structure for adverts
-- ----------------------------
DROP TABLE IF EXISTS `adverts`;
CREATE TABLE `adverts`  (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `category_id` int(11) NOT NULL DEFAULT 0 COMMENT '广告分类id',
  `name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '广告名称',
  `identifying` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '广告标识或链接',
  `image_path` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '图片路径',
  `sort` int(11) NOT NULL DEFAULT 0,
  `is_disabled` tinyint(1) NOT NULL DEFAULT 0 COMMENT '是否禁用',
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci COMMENT = '广告' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of adverts
-- ----------------------------

-- ----------------------------
-- Table structure for announcements
-- ----------------------------
DROP TABLE IF EXISTS `announcements`;
CREATE TABLE `announcements`  (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '公告标题',
  `content` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL COMMENT '公告内容',
  `sort` int(11) NOT NULL DEFAULT 0,
  `is_disabled` tinyint(1) NOT NULL DEFAULT 0 COMMENT '是否禁用',
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci COMMENT = '公告' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of announcements
-- ----------------------------
INSERT INTO `announcements` VALUES (1, '12321', '<p>3123213</p>', 0, 0, '2021-04-25 08:29:48', '2021-04-25 08:29:48');

-- ----------------------------
-- Table structure for app_versions
-- ----------------------------
DROP TABLE IF EXISTS `app_versions`;
CREATE TABLE `app_versions`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `version` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '版本号',
  `title` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '升级标题',
  `description` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '升级描述',
  `download_url` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '下载链接',
  `client_type` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0 安卓,1 ios',
  `upgrade_type` tinyint(1) NOT NULL DEFAULT 0 COMMENT '2强制升级 1提醒升级  0不提醒升级',
  `created_at` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP(0) COMMENT '创建时间',
  `updated_at` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP(0) COMMENT '更新时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = 'app版本升级' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of app_versions
-- ----------------------------

-- ----------------------------
-- Table structure for certifications
-- ----------------------------
DROP TABLE IF EXISTS `certifications`;
CREATE TABLE `certifications`  (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int(11) UNSIGNED NOT NULL DEFAULT 0 COMMENT '用户id',
  `username` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '用户名',
  `name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '姓名',
  `id_card` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '身份证',
  `card_image_front` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '身份证正面',
  `card_image_behind` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '身份证反面',
  `type` tinyint(1) NOT NULL DEFAULT 1 COMMENT '认证类型 1 kyc1 ,2 kyc2',
  `status` tinyint(1) NOT NULL DEFAULT 0 COMMENT '状态 0未审核 1已审核 -1已拒绝',
  `remark` tinyint(1) NOT NULL DEFAULT 0 COMMENT '备注,审核失败原因',
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `user_idx`(`user_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci COMMENT = '实名认证' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of certifications
-- ----------------------------

-- ----------------------------
-- Table structure for comments
-- ----------------------------
DROP TABLE IF EXISTS `comments`;
CREATE TABLE `comments`  (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL DEFAULT 0 COMMENT '用户id',
  `post_id` int(11) NULL DEFAULT 0 COMMENT '博客id',
  `content` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL COMMENT '内容',
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci COMMENT = '评论表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of comments
-- ----------------------------

-- ----------------------------
-- Table structure for configs
-- ----------------------------
DROP TABLE IF EXISTS `configs`;
CREATE TABLE `configs`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `module` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '模块名',
  `key` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '键值',
  `value` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL COMMENT '键对应的值',
  `create_at` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP(0) COMMENT '创建时间',
  `update_at` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP(0) COMMENT '更新时间',
  `is_json` tinyint(1) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `key_idx`(`key`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 29 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '系统配置表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of configs
-- ----------------------------
INSERT INTO `configs` VALUES (11, 'site', 'site_name', '脚手架', '2021-01-21 11:30:30', '2021-01-21 11:30:30', NULL);
INSERT INTO `configs` VALUES (12, 'other', 'other_config', '213', '2021-01-21 11:30:33', '2021-01-21 11:30:33', NULL);
INSERT INTO `configs` VALUES (13, 'sms', 'huan_hui_user_id', '702', '2021-02-27 12:28:01', '2021-02-27 12:28:01', NULL);
INSERT INTO `configs` VALUES (14, 'sms', 'huan_hui_account', '210', '2021-02-27 12:28:01', '2021-02-27 12:28:01', NULL);
INSERT INTO `configs` VALUES (15, 'sms', 'huan_hui_password', '4285551a', '2021-02-27 12:28:01', '2021-02-27 12:28:01', NULL);
INSERT INTO `configs` VALUES (16, 'sms', 'sms_send_diff_min', '1', '2021-02-27 12:28:01', '2021-02-27 12:28:01', NULL);
INSERT INTO `configs` VALUES (17, 'sms', 'sms_send_day_max', '10', '2021-02-27 12:28:01', '2021-02-27 12:28:01', NULL);
INSERT INTO `configs` VALUES (18, 'sms', 'sms_effective_time', '5', '2021-02-27 12:28:01', '2021-02-27 12:28:01', NULL);
INSERT INTO `configs` VALUES (19, 'storage', 'storage_type', 'admin', '2021-03-15 11:07:21', '2021-03-15 11:07:21', NULL);
INSERT INTO `configs` VALUES (20, 'storage', 'access_id', 'LTAIog09GLW5pHZp', '2021-03-15 11:07:21', '2021-03-15 11:07:21', NULL);
INSERT INTO `configs` VALUES (21, 'storage', 'access_key', 'la1whWUQZJURdikJvRsp4SbUqkjKdd', '2021-03-15 11:07:21', '2021-03-15 11:07:21', NULL);
INSERT INTO `configs` VALUES (22, 'storage', 'bucket', 'shangtukeji', '2021-03-15 11:07:21', '2021-03-15 11:07:21', NULL);
INSERT INTO `configs` VALUES (23, 'storage', 'endpoint', 'oss-cn-hongkong.aliyuncs.com', '2021-03-15 11:07:21', '2021-03-15 11:07:21', NULL);
INSERT INTO `configs` VALUES (24, 'smstemplate', 'auth_code_content', '【{$siteName}】验证码：{$code}，{$expireTime}分钟内有效,切勿告知他人！', '2021-04-10 11:06:32', '2021-04-10 11:06:32', NULL);
INSERT INTO `configs` VALUES (25, 'smstemplate', 'template_hello_word', '【{$siteName}】 hello world', '2021-04-10 11:06:32', '2021-04-10 11:06:32', NULL);
INSERT INTO `configs` VALUES (26, 'site', 'is_close_site', 'off', '2021-05-13 09:27:39', '2021-05-13 09:27:39', NULL);
INSERT INTO `configs` VALUES (27, 'site', 'close_site_reason', '123', '2021-05-13 09:27:39', '2021-05-13 09:27:39', NULL);
INSERT INTO `configs` VALUES (28, 'site', 'open_front_log', '1', '2021-05-20 14:51:23', '2021-05-20 14:51:23', NULL);

-- ----------------------------
-- Table structure for document_categories
-- ----------------------------
DROP TABLE IF EXISTS `document_categories`;
CREATE TABLE `document_categories`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '分类标题',
  `parent_id` int(11) NOT NULL DEFAULT 0 COMMENT '父级id',
  `sort` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP(0) COMMENT '创建时间',
  `updated_at` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP(0) COMMENT '更新时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 12 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '文档分类' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of document_categories
-- ----------------------------
INSERT INTO `document_categories` VALUES (11, '1234', 0, 0, '2021-04-10 07:24:55', '2021-04-10 07:24:55');

-- ----------------------------
-- Table structure for documents
-- ----------------------------
DROP TABLE IF EXISTS `documents`;
CREATE TABLE `documents`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '文档标题',
  `identify` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '文档标识符',
  `category_id` int(11) NOT NULL DEFAULT 0 COMMENT '分类id',
  `content` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL COMMENT '文档内容',
  `sort` int(11) NOT NULL DEFAULT 0,
  `is_disabled` tinyint(1) NOT NULL DEFAULT 0 COMMENT '是否禁用',
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 12 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '文档表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of documents
-- ----------------------------
INSERT INTO `documents` VALUES (11, '213', '123', 11, '<p>3213123</p>', 1, 0, '2021-04-10 07:25:23', '2021-04-10 07:25:23');

-- ----------------------------
-- Table structure for exchanges
-- ----------------------------
DROP TABLE IF EXISTS `exchanges`;
CREATE TABLE `exchanges`  (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `base_symbol_id` int(11) UNSIGNED NOT NULL DEFAULT 0 COMMENT '基础货币id',
  `quote_symbol_id` int(11) UNSIGNED NOT NULL DEFAULT 0 COMMENT '计价货币id',
  `is_can_trade` tinyint(1) UNSIGNED NOT NULL DEFAULT 0 COMMENT '是否能够进行交易',
  `is_recommend` tinyint(1) UNSIGNED NOT NULL DEFAULT 0 COMMENT '是否推荐',
  `is_disabled` tinyint(1) UNSIGNED NOT NULL DEFAULT 0 COMMENT '是否禁用',
  `sort` int(11) UNSIGNED NOT NULL DEFAULT 0 COMMENT '排序',
  `decimals` tinyint(1) UNSIGNED NOT NULL DEFAULT 0 COMMENT '小数位数',
  `taker_fee` decimal(18, 8) NOT NULL DEFAULT 0.00000000 COMMENT '吃单手续费',
  `maker_fee` decimal(18, 8) NOT NULL DEFAULT 0.00000000 COMMENT '挂单手续费',
  `limit_buy_min` decimal(18, 8) NOT NULL DEFAULT 0.00000000 COMMENT '限价买入最小量,当为0时不限制',
  `limit_sell_min` decimal(18, 8) NOT NULL DEFAULT 0.00000000 COMMENT '限价卖出最小量,当为0时不限制',
  `market_buy_min` decimal(18, 8) NOT NULL DEFAULT 0.00000000 COMMENT '市价买入最小量,当为0时不限制',
  `market_sell_min` decimal(18, 8) NOT NULL DEFAULT 0.00000000 COMMENT '市价卖出最小量,当为0时不限制',
  `trade_start_time` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `trade_end_time` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `symbol_pair` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci COMMENT = '币币交易市场' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of exchanges
-- ----------------------------
INSERT INTO `exchanges` VALUES (1, 1, 2, 1, 0, 0, 0, 0, 0.20000000, 0.20000000, 0.00000000, 0.00000000, 0.00000000, 0.00000000, '0', '24', '2020-12-15 03:36:01', '2020-12-09 08:37:30', 'BTC/USDT');
INSERT INTO `exchanges` VALUES (2, 3, 2, 1, 1, 0, 0, 0, 0.20000000, 0.20000000, 0.00000000, 0.00000000, 0.00000000, 0.00000000, '00:12:35', '23:12:35', '2020-12-25 16:06:30', '2020-12-25 16:06:30', 'LINK/USDT');

-- ----------------------------
-- Table structure for failed_jobs
-- ----------------------------
DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE `failed_jobs`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP(0),
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of failed_jobs
-- ----------------------------

-- ----------------------------
-- Table structure for front_operation_log
-- ----------------------------
DROP TABLE IF EXISTS `front_operation_log`;
CREATE TABLE `front_operation_log`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL DEFAULT 0,
  `username` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `path` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `method` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `ip` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `input` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `front_operation_log_user_id_index`(`user_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5532 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of front_operation_log
-- ----------------------------
INSERT INTO `front_operation_log` VALUES (5531, 0, '', 'api/v1/user_register', 'POST', '127.0.0.1', '{\"username\":\"t1\",\"mobile\":\"18063164161\",\"code\":\"786595\",\"password\":\"123456\",\"password_confirmation\":\"123456\"}', '2021-05-20 06:56:45', '2021-05-20 06:56:45');

-- ----------------------------
-- Table structure for holidays
-- ----------------------------
DROP TABLE IF EXISTS `holidays`;
CREATE TABLE `holidays`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `data_id` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '数据id',
  `person` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '人员',
  `hour` decimal(18, 8) NOT NULL DEFAULT 0.00000000 COMMENT '请假时长',
  `type` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '请假类型',
  `reason` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '请假理由',
  `arrangement` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '工作安排',
  `result` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '审批结果',
  `begin_time` timestamp(0) NULL DEFAULT NULL COMMENT '请假开始时间',
  `end_time` timestamp(0) NULL DEFAULT NULL COMMENT '请假结束时间',
  `approve_time` timestamp(0) NULL DEFAULT NULL COMMENT '请假通过时间',
  `is_not_normal` tinyint(1) NOT NULL DEFAULT 0 COMMENT '是否异常',
  `created_at` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP(0) COMMENT '创建时间',
  `updated_at` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP(0) COMMENT '更新时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 349 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of holidays
-- ----------------------------
INSERT INTO `holidays` VALUES (1, '', '于翔翔', 8.00000000, '事假', '下午下雨，在家没回得去，明天回', '回来继续', '审批通过', '2021-05-04 08:00:00', '2021-05-04 18:00:00', '2021-05-03 21:57:57', 0, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (2, '', '董青', 8.00000000, '事假', '家里老人在老家，还需照看孩子一天', '回去继续', '审批通过', '2021-05-04 08:30:00', '2021-05-04 18:00:00', '2021-05-03 21:58:02', 0, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (3, '', '张志飞', 8.00000000, '事假', '家里有事需处理。', '有事电话联系。', '审批通过', '2021-05-04 08:30:00', '2021-05-04 18:00:00', '2021-05-03 12:54:01', 0, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (4, '', '郑皓', 16.00000000, '事假', '因房产问题，去松原处理', '无', '审批通过', '2021-05-04 08:30:00', '2021-05-05 18:00:00', '2021-05-03 11:16:08', 0, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (5, '', '刘致洲', 8.00000000, '事假', '家中有事', '随时联系', '审批通过', '2021-05-04 08:30:00', '2021-05-04 18:00:00', '2021-04-30 19:16:05', 0, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (6, '', '张燕', 16.00000000, '事假', '回老家有事', '自己跟进', '审批通过', '2021-05-04 08:30:00', '2021-05-05 18:00:00', '2021-04-30 18:38:33', 0, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (7, '', '董青', 2.00000000, '事假', '需要照看孩子', '回来继续', '审批通过', '2021-04-30 16:00:00', '2021-04-30 18:00:00', '2021-04-30 15:16:40', 0, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (8, '', '席伟男', 2.00000000, '事假', '外出办事', '随时联系', '审批通过', '2021-04-30 08:30:00', '2021-04-30 10:30:00', '2021-04-30 08:11:08', 0, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (9, '', '马廷广', 1.50000000, '事假', '家中有事', '回来继续', '审批通过', '2021-04-30 08:30:00', '2021-04-30 10:00:00', '2021-04-30 08:11:05', 0, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (10, '', '王壮壮', 8.00000000, '事假', '家中有事', '回来继续', '审批通过', '2021-04-30 08:30:00', '2021-04-30 18:00:00', '2021-04-29 19:01:07', 0, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (11, '', '郑皓', 8.00000000, '事假', '家里迎接女朋友一家，接机等安排', '无', '审批通过', '2021-04-30 08:30:00', '2021-04-30 18:00:00', '2021-04-29 16:23:42', 0, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (12, '', '张燕', 4.00000000, '事假', '学校家委会事宜', '自己跟进', '审批通过', '2021-04-30 14:00:00', '2021-04-30 18:00:00', '2021-04-29 14:57:49', 0, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (13, '', '石仕刚', 7.33000000, '事假', '感冒难受', '在家办公保持联系', '审批通过', '2021-04-29 09:10:00', '2021-04-29 18:00:00', '2021-04-29 09:09:25', 0, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (14, '', '于翔翔', 2.00000000, '事假', '不好意思，手机昨晚没电了，不知道为什么没充上，关机了', '回来继续', '审批通过', '2021-04-29 08:30:00', '2021-04-29 10:30:00', '2021-04-29 08:45:19', 1, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (15, '', '席伟男', 1.50000000, '事假', '送孩子回去', '随时联系', '审批通过', '2021-04-29 08:30:00', '2021-04-29 10:00:00', '2021-04-29 08:00:18', 0, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (16, '', '张燕', 1.00000000, '事假', '物业办事', '自己跟进', '审批通过', '2021-04-29 08:30:00', '2021-04-29 09:30:00', '2021-04-29 07:33:25', 0, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (17, '', '蔺要红', 4.00000000, '事假', '家里有事，处理到现在，', '回去继续', '审批通过', '2021-04-29 08:30:00', '2021-04-29 13:30:00', '2021-04-29 07:34:19', 0, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (18, '', '董青', 1.00000000, '事假', '家里有事', '回来继续', '审批通过', '2021-04-28 14:00:00', '2021-04-28 15:00:00', '2021-04-28 14:58:44', 1, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (19, '', '季德鹏', 4.00000000, '事假', '胃疼', '自行解决', '审批通过', '2021-04-28 14:00:00', '2021-04-28 18:00:00', '2021-04-28 13:21:47', 0, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (20, '', '蔺要红', 1.50000000, '事假', '家里有事，', '回去继续', '审批通过', '2021-04-28 08:30:00', '2021-04-28 10:00:00', '2021-04-28 07:51:45', 0, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (21, '', '于翔翔', 2.00000000, '事假', '家里有事', '回来继续', '审批通过', '2021-04-28 08:30:00', '2021-04-28 10:30:00', '2021-04-28 03:41:09', 0, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (22, '', '季德鹏', 4.00000000, '事假', '胃疼', '自行解决', '审批通过', '2021-04-28 08:30:00', '2021-04-28 12:30:00', '2021-04-28 00:29:13', 0, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (23, '', '赵文政', 4.00000000, '事假', '家里有事', '暂无', '审批通过', '2021-04-28 08:30:00', '2021-04-28 12:30:00', '2021-04-27 22:03:24', 0, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (24, '', '席伟男', 4.00000000, '事假', '小孩连续三天发高烧，带孩子看看', '随时联系', '审批通过', '2021-04-28 08:30:00', '2021-04-28 12:30:00', '2021-04-27 18:23:49', 0, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (25, '', '席伟男', 1.00000000, '事假', '家中有事', '随时联系', '审批通过', '2021-04-27 08:30:00', '2021-04-27 09:30:00', '2021-04-27 08:03:36', 0, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (26, '', '张志飞', 4.00000000, '事假', '家里有事要处理。', '回来继续。', '审批通过', '2021-04-27 08:30:00', '2021-04-27 12:30:00', '2021-04-26 20:38:05', 0, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (27, '', '马廷广', 8.00000000, '事假', '家中有事', '回去继续', '审批通过', '2021-04-27 08:30:00', '2021-04-27 18:00:00', '2021-04-26 17:44:48', 0, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (28, '', '王壮壮', 1.00000000, '事假', '有事', '回来继续', '审批通过', '2021-04-26 14:00:00', '2021-04-26 15:00:00', '2021-04-26 13:59:41', 0, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (29, '', '马廷广', 8.00000000, '事假', '家中有事，事没忙完，忙完回公司', '回去继续', '审批通过', '2021-04-26 08:30:00', '2021-04-26 18:00:00', '2021-04-26 12:46:34', 1, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (30, '', '蔺要红', 2.00000000, '事假', '家里有事，没注意好', '回去继续', '审批通过', '2021-04-26 08:30:00', '2021-04-26 10:30:00', '2021-04-26 07:20:44', 0, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (31, '', '马廷广', 1.50000000, '事假', '家中有事', '回去继续', '审批通过', '2021-04-24 08:30:00', '2021-04-24 10:00:00', '2021-04-24 08:07:33', 0, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (32, '', '赵文政', 8.00000000, '事假', '事情没处理完', '暂无', '审批通过', '2021-04-24 08:29:00', '2021-04-24 18:01:00', '2021-04-23 19:46:25', 0, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (33, '', '季德鹏', 1.00000000, '事假', '有事早走', '自行安排', '审批通过', '2021-04-23 17:00:00', '2021-04-23 18:00:00', '2021-04-23 16:09:36', 0, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (34, '', '王壮壮', 0.50000000, '事假', '有事', '回来继续', '审批通过', '2021-04-23 09:30:00', '2021-04-23 10:00:00', '2021-04-23 08:39:50', 0, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (35, '', '马廷广', 1.50000000, '事假', '家中有事', '回去继续', '审批通过', '2021-04-23 08:30:00', '2021-04-23 10:00:00', '2021-04-23 08:02:17', 0, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (36, '', '王壮壮', 1.00000000, '事假', '有事', '回来继续', '审批通过', '2021-04-23 08:30:00', '2021-04-23 09:30:00', '2021-04-23 07:58:47', 0, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (37, '', '石仕刚', 8.00000000, '事假', '回家一趟打疫苗', '590修改已改好测试完，等待产品验收，有事电话联系', '审批通过', '2021-04-23 08:30:00', '2021-04-23 18:00:00', '2021-04-22 22:23:05', 0, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (38, '', '赵文政', 8.00000000, '事假', '家里有事', '暂无', '审批通过', '2021-04-23 08:30:00', '2021-04-23 18:00:00', '2021-04-22 22:23:26', 0, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (39, '', '郑皓', 8.00000000, '事假', '医院陪床一天', '无', '审批通过', '2021-04-23 08:00:00', '2021-04-23 18:00:00', '2021-04-22 17:58:40', 0, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (40, '', '王冬', 8.00000000, '事假', '去沂南参加科目二考试', '回来继续', '审批通过', '2021-04-23 08:30:00', '2021-04-23 18:00:00', '2021-04-22 14:14:50', 0, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (41, '', '石仕刚', 2.00000000, '事假', '身体不适', '回去继续', '审批通过', '2021-04-22 08:30:00', '2021-04-22 10:30:00', '2021-04-22 08:23:30', 0, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (42, '', '王壮壮', 0.50000000, '事假', '堵车', '回来继续', '审批通过', '2021-04-22 08:30:00', '2021-04-22 09:00:00', '2021-04-22 08:23:48', 0, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (43, '', '蔺要红', 8.00000000, '事假', '媳妇去医院 上午和下午 有几个小时需要看小孩', '可以在家里工作，已经和产品沟通过', '审批通过', '2021-04-22 08:00:00', '2021-04-22 18:30:00', '2021-04-21 22:04:59', 0, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (44, '', '王冬', 4.00000000, '事假', '23号科目二考试，考试之前再练练。', '回来继续', '审批通过', '2021-04-22 08:30:00', '2021-04-22 12:30:00', '2021-04-21 15:26:16', 0, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (45, '', '马廷广', 2.00000000, '事假', '家中有事', '回去继续', '审批通过', '2021-04-21 08:30:00', '2021-04-21 10:30:00', '2021-04-21 08:09:43', 0, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (46, '', '王壮壮', 0.50000000, '事假', '堵车', '回来继续', '审批通过', '2021-04-21 08:30:00', '2021-04-21 09:00:00', '2021-04-21 07:57:22', 0, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (47, '', '张燕', 1.00000000, '事假', '去医院拿药', '自己跟进', '审批通过', '2021-04-21 11:30:00', '2021-04-21 12:30:00', '2021-04-21 07:57:03', 0, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (48, '', '于翔翔', 2.00000000, '事假', '家里有事', '回来继续', '审批通过', '2021-04-21 08:30:00', '2021-04-21 10:30:00', '2021-04-21 07:57:17', 0, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (49, '', '蔺要红', 4.00000000, '事假', '媳妇产检，回家看小孩', '忙完可5点以后可以在家办公，有事情打电话联系', '审批通过', '2021-04-20 12:30:00', '2021-04-20 18:00:00', '2021-04-20 11:45:16', 0, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (50, '', '马廷广', 1.50000000, '事假', '家中有事', '回去继续', '审批通过', '2021-04-20 08:30:00', '2021-04-20 10:00:00', '2021-04-20 08:07:14', 0, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (51, '', '于翔翔', 2.00000000, '事假', '晚上有事，睡太晚', '回来继续', '审批通过', '2021-04-20 08:30:00', '2021-04-20 10:30:00', '2021-04-20 08:18:42', 0, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (52, '', '石仕刚', 8.00000000, '事假', '练车', '有修改的话晚上在家改，紧急情况电话联系', '审批通过', '2021-04-20 08:30:00', '2021-04-20 18:00:00', '2021-04-19 21:20:32', 0, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (53, '', '张明浩', 8.00000000, '事假', '回老家处理事情', '新版交易所测试完成、如果有其他反馈在及时修改。216同步修改完成等待反馈', '审批通过', '2021-04-20 08:30:00', '2021-04-20 18:00:00', '2021-04-19 09:01:17', 0, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (54, '', '蔺要红', 2.00000000, '事假', '临时有事情处理', '回去继续', '审批通过', '2021-04-19 06:30:00', '2021-04-19 10:30:00', '2021-04-19 08:24:56', 1, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (55, '', '马廷广', 1.50000000, '事假', '家中有事', '回去继续', '审批通过', '2021-04-19 08:30:00', '2021-04-19 10:00:00', '2021-04-19 08:17:20', 0, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (56, '', '张元艳', 4.00000000, '事假', '家里有事，需处理', '回来继续', '审批通过', '2021-04-19 08:30:00', '2021-04-19 12:30:00', '2021-04-18 23:20:31', 0, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (57, '', '张志飞', 4.00000000, '事假', '家里有事需处理。', '回来继续。', '审批通过', '2021-04-19 08:30:00', '2021-04-19 12:30:00', '2021-04-18 15:32:25', 0, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (58, '', '席伟男', 1.17000000, '事假', '回家有事', '随时联系', '审批通过', '2021-04-17 16:50:00', '2021-04-18 18:00:00', '2021-04-17 16:50:02', 0, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (59, '', '马廷广', 4.00000000, '事假', '家中有事，事情没办完', '回来继续', '审批通过', '2021-04-17 08:30:00', '2021-04-17 12:30:00', '2021-04-17 10:10:04', 1, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (60, '', '石仕刚', 8.00000000, '事假', '回家一趟', '回来继续，有事电话联系', '审批通过', '2021-04-17 08:30:00', '2021-04-17 18:00:00', '2021-04-16 20:00:05', 0, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (61, '', '季德鹏', 2.00000000, '事假', '个人有点事处理', '自行处理', '审批通过', '2021-04-17 08:30:00', '2021-04-17 10:30:00', '2021-04-16 14:17:42', 0, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (62, '', '宿鹏磊', 8.00000000, '事假', '家里有事', '回来继续', '审批通过', '2021-04-17 08:30:00', '2021-04-17 18:00:00', '2021-04-16 12:00:49', 0, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (63, '', '赵文政', 8.00000000, '事假', '家里有事', '回来继续', '审批通过', '2021-04-17 08:30:00', '2021-04-17 18:00:00', '2021-04-16 11:56:04', 0, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (64, '', '王冬', 8.00000000, '事假', '去驾校练车', '回来继续，有事钉钉联系', '审批通过', '2021-04-17 08:30:00', '2021-04-17 18:00:00', '2021-04-16 09:45:57', 0, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (65, '', '蔺要红', 8.00000000, '事假', '小孩发烧', '回去继续', '审批通过', '2021-04-16 08:30:00', '2021-04-16 18:00:00', '2021-04-16 04:36:55', 0, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (66, '', '张燕', 8.00000000, '事假', '孩子生病，去医院', '自己跟进', '审批通过', '2021-04-16 08:00:00', '2021-04-16 18:00:00', '2021-04-15 18:07:36', 0, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (67, '', '张志飞', 8.00000000, '事假', '家里有事要处理。', '有时按电话联系，回来继续。', '审批通过', '2021-04-16 08:30:00', '2021-04-16 18:00:00', '2021-04-15 15:03:34', 0, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (68, '', '张燕', 3.00000000, '事假', '胃疼', '自己跟进', '审批通过', '2021-04-15 15:00:00', '2021-04-15 18:00:00', '2021-04-15 14:25:42', 0, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (69, '', '席伟男', 4.00000000, '事假', '回来的路上', '随时联系', '审批通过', '2021-04-15 08:30:00', '2021-04-15 12:30:00', '2021-04-15 10:14:11', 1, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (70, '', '马廷广', 1.50000000, '事假', '家中有事', '回去继续', '审批通过', '2021-04-15 08:30:00', '2021-04-15 10:00:00', '2021-04-15 08:12:38', 0, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (71, '', '张元艳', 4.00000000, '事假', '肠胃感冒', '回来继续', '审批通过', '2021-04-14 08:30:00', '2021-04-14 12:30:00', '2021-04-14 09:14:14', 1, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (72, '', '席伟男', 9.00000000, '事假', '回平邑办事', '随时联系', '审批通过', '2021-04-13 17:00:00', '2021-04-14 18:00:00', '2021-04-13 16:17:06', 0, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (73, '', '马廷广', 1.50000000, '事假', '家中有事', '回去继续', '审批通过', '2021-04-13 08:30:00', '2021-04-13 10:00:00', '2021-04-13 08:00:14', 0, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (74, '', '石仕刚', 8.00000000, '事假', '感冒身体不适，拿点药在家办公', '有事电话联系', '审批通过', '2021-04-13 08:30:00', '2021-04-13 18:00:00', '2021-04-13 07:54:09', 0, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (75, '', '蔺要红', 2.00000000, '事假', '需要看小孩两个小时', '回去继续', '审批通过', '2021-04-12 08:30:00', '2021-04-12 10:30:00', '2021-04-12 21:22:25', 1, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (76, '', '于翔翔', 8.00000000, '事假', '头痛，没睡着觉，不舒服', '回来继续', '审批通过', '2021-04-12 08:30:00', '2021-04-12 18:30:00', '2021-04-12 08:15:25', 0, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (77, '', '马廷广', 8.00000000, '事假', '回一趟老家', '新交易所测试问题，忙完回来弄', '审批通过', '2021-04-12 08:30:00', '2021-04-12 18:00:00', '2021-04-11 20:50:26', 0, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (78, '', '董青', 8.00000000, '事假', '老家事情，需要处理', '回来继续', '审批通过', '2021-04-12 08:30:00', '2021-04-12 18:00:00', '2021-04-11 19:50:35', 0, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (79, '', '董青', 2.00000000, '事假', '家里有点事，回去处理一下', '回来继续', '审批通过', '2021-04-10 10:30:00', '2021-04-10 12:30:00', '2021-04-10 10:02:04', 0, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (80, '', '邵毓清', 8.00000000, '事假', '家里有事', '暂无', '审批通过', '2021-04-10 08:00:00', '2021-04-10 18:00:00', '2021-04-09 20:43:41', 0, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (81, '', '王冬', 8.00000000, '事假', '去驾校练车', '回来继续', '审批通过', '2021-04-10 08:30:00', '2021-04-10 18:00:00', '2021-04-09 08:48:13', 0, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (82, '', '蔺要红', 1.00000000, '事假', '看小孩', '回去继续', '审批通过', '2021-04-09 08:30:00', '2021-04-09 09:30:00', '2021-04-08 23:33:15', 0, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (83, '', '于翔翔', 4.00000000, '事假', '感冒了，休息一下', '回来继续', '审批通过', '2021-04-08 08:30:00', '2021-04-08 12:30:00', '2021-04-07 21:43:23', 0, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (84, '', '赵文政', 1.50000000, '事假', '家里有事', '回来继续', '审批通过', '2021-04-07 16:30:00', '2021-04-07 18:00:00', '2021-04-07 16:31:44', 0, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (85, '', '季德鹏', 4.00000000, '事假', '租的房子有事情需要处理', '工作自行跟进', '审批通过', '2021-04-07 14:00:00', '2021-04-07 18:00:00', '2021-04-06 14:13:06', 0, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (86, '', '王壮壮', 2.00000000, '事假', '家中有事', '回来继续', '审批通过', '2021-04-06 16:00:00', '2021-04-06 18:00:00', '2021-04-06 14:09:14', 0, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (87, '', '马廷广', 1.50000000, '事假', '家中有事', '回去继续', '审批通过', '2021-04-06 08:30:00', '2021-04-06 10:00:00', '2021-04-06 08:28:54', 0, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (88, '', '蔺要红', 2.00000000, '事假', '家里有事', '无', '审批通过', '2021-04-02 08:30:00', '2021-04-02 10:30:00', '2021-04-02 08:02:22', 0, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (89, '', '马廷广', 16.00000000, '丧假', '家中亲人去世', '回来继续', '审批通过', '2021-03-30 00:00:00', '2021-03-31 00:00:00', '2021-04-01 15:04:58', 1, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (90, '', '马廷广', 16.00000000, '事假', '家中有事', '回来继续', '审批通过', '2021-03-30 08:30:00', '2021-03-31 18:00:00', '2021-04-01 15:03:26', 1, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (91, '', '石仕刚', 7.00000000, '事假', '头疼身体不舒服', '有事联系在家办公', '审批通过', '2021-04-01 09:30:00', '2021-04-01 18:30:00', '2021-04-01 09:42:12', 1, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (92, '', '席伟男', 3.18000000, '事假', '家中有事', '随时联系', '审批通过', '2021-04-01 09:19:00', '2021-04-01 12:30:00', '2021-04-01 09:21:55', 0, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (93, '', '马廷广', 2.00000000, '事假', '从老家回来的路上', '回去继续', '审批未通过', '2021-04-01 08:30:00', '2021-04-01 10:30:00', '2021-04-01 14:51:45', 1, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (94, '', '席伟男', 1.50000000, '事假', '办事', '随时联系', '审批通过', '2021-03-31 08:30:00', '2021-03-31 10:00:00', '2021-03-31 08:20:13', 0, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (95, '', '张元艳', 4.00000000, '事假', '回家有事', '回来继续', '审批通过', '2021-03-31 14:00:00', '2021-03-31 18:00:00', '2021-03-30 17:15:23', 0, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (96, '', '席伟男', 1.00000000, '事假', '租房签合同', '随时联系', '审批通过', '2021-03-30 14:00:00', '2021-03-30 15:00:00', '2021-03-30 14:00:41', 0, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (97, '', '赵文政', 4.00000000, '事假', '家里有事', '回去继续', '审批通过', '2021-03-30 08:30:00', '2021-03-30 12:30:00', '2021-03-29 22:24:24', 0, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (98, '', '马廷广', 1.50000000, '事假', '练车', '回来继续', '审批通过', '2021-03-29 16:30:00', '2021-03-29 18:00:00', '2021-03-29 14:19:17', 0, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (99, '', '席伟男', 4.00000000, '事假', '腰疼理疗', '随时联系', '审批通过', '2021-03-27 08:30:00', '2021-03-27 12:30:00', '2021-03-27 07:30:49', 0, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (100, '', '石仕刚', 8.00000000, '事假', '回家一趟', '208反馈回家改，周天再回来加班', '审批通过', '2021-03-27 08:30:00', '2021-03-27 18:00:00', '2021-03-26 17:50:03', 0, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (101, '', '张富赢', 8.00000000, '事假', '家中有事', '有问题带电脑在家办公', '审批通过', '2021-03-27 08:30:00', '2021-03-27 18:00:00', '2021-03-26 16:43:35', 0, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (102, '', '张燕', 4.00000000, '事假', '搬家', '自己跟进', '审批通过', '2021-03-27 14:00:00', '2021-03-27 18:00:00', '2021-03-26 14:07:05', 0, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (103, '', '蔺要红', 2.00000000, '事假', '需要在家看小孩 ，对象去检查身体', '暂无', '审批通过', '2021-03-26 08:30:00', '2021-03-26 10:30:00', '2021-03-25 23:19:10', 0, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (104, '', '马廷广', 8.00000000, '事假', '身体不舒服，在家办公', '在家办公', '审批通过', '2021-03-26 08:30:00', '2021-03-26 18:00:00', '2021-03-26 08:11:40', 0, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (105, '', '席伟男', 1.00000000, '事假', '出去办事', '207、216已经安排好，208等完成后后测试', '审批通过', '2021-03-25 17:00:00', '2021-03-25 18:00:00', '2021-03-25 16:51:50', 0, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (106, '', '张志飞', 8.00000000, '事假', '家里有事需处理', '电话联系', '审批通过', '2021-03-26 08:30:00', '2021-03-26 18:00:00', '2021-03-25 17:56:20', 0, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (107, '', '席伟男', 1.00000000, '事假', '腰疼', '电话联系', '审批通过', '2021-03-25 08:30:00', '2021-03-25 09:30:00', '2021-03-25 07:55:38', 0, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (108, '', '于翔翔', 8.00000000, '事假', '家里有事，回家一趟', '回来继续', '审批通过', '2021-03-24 08:30:00', '2021-03-24 18:00:00', '2021-03-23 21:39:01', 0, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (109, '', '张燕', 1.50000000, '事假', '去物业办事', '自己跟进', '审批通过', '2021-03-22 08:30:00', '2021-03-22 10:00:00', '2021-03-22 10:35:01', 1, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (110, '', '席伟男', 2.00000000, '事假', '做理疗', '电话联系', '审批通过', '2021-03-22 08:30:00', '2021-03-22 10:30:00', '2021-03-22 08:13:06', 0, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (111, '', '张明浩', 16.00000000, '陪产假', '生宝宝了、陪产两天', '新交易所目前工作完成、610b和614和车拖车反馈等工作上的事随时可以远程修改', '审批通过', '2021-03-22 00:00:00', '2021-03-23 00:00:00', '2021-03-21 13:14:02', 0, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (112, '', '马廷广', 8.00000000, '事假', '家中有事，需要去趟费县', '回来继续', '审批通过', '2021-03-20 08:30:00', '2021-03-20 18:00:00', '2021-03-20 08:15:46', 0, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (113, '', '张明浩', 8.00000000, '事假', '对象临产今早不舒服、去医院检查', '新版交易所数据对接完毕正在测试、610b和614随时可远程', '审批通过', '2021-03-20 08:30:00', '2021-03-20 18:00:00', '2021-03-20 08:16:18', 0, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (114, '', '石仕刚', 8.00000000, '事假', '家里有事，回去一趟', '已跟产品沟通，有修改的话晚上修改', '审批通过', '2021-03-20 08:30:00', '2021-03-20 18:00:00', '2021-03-19 20:33:57', 0, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (115, '', '马廷广', 1.50000000, '事假', '家中有事', '回去继续', '审批通过', '2021-03-19 08:30:00', '2021-03-19 10:00:00', '2021-03-19 08:11:53', 0, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (116, '', '董青', 8.00000000, '事假', '奶奶身体不好，需要去医院', '回来继续', '审批通过', '2021-03-19 08:30:00', '2021-03-19 18:00:00', '2021-03-18 15:50:02', 0, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (117, '', '席伟男', 4.00000000, '事假', '家中有事', '随时联系', '审批通过', '2021-03-18 08:30:00', '2021-03-18 12:30:00', '2021-03-18 10:40:54', 1, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (118, '', '张元艳', 8.00000000, '事假', '家里有事', '回来继续', '审批通过', '2021-03-18 08:30:00', '2021-03-18 18:00:00', '2021-03-17 12:59:09', 0, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (119, '', '席伟男', 8.00000000, '事假', '看病', '电话联系', '审批通过', '2021-03-17 08:30:00', '2021-03-17 18:00:00', '2021-03-17 08:20:35', 0, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (120, '', '张志飞', 8.00000000, '事假', '家里有事需要处理。', '电话联系。', '审批通过', '2021-03-17 08:30:00', '2021-03-17 18:00:00', '2021-03-17 08:20:38', 0, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (121, '', '席伟男', 8.00000000, '事假', '去医院', '远程处理', '审批通过', '2021-03-16 08:30:00', '2021-03-16 18:00:00', '2021-03-16 12:06:44', 1, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (122, '', '王壮壮', 0.50000000, '事假', '堵车严重', '回来继续', '审批通过', '2021-03-16 08:30:00', '2021-03-16 09:00:00', '2021-03-16 08:08:36', 0, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (123, '', '马廷广', 2.00000000, '事假', '家中有事', '回去继续', '审批通过', '2021-03-16 08:30:00', '2021-03-16 10:30:00', '2021-03-16 08:08:37', 0, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (124, '', '张元艳', 0.50000000, '事假', '有事需处理', '回来继续', '审批通过', '2021-03-15 12:00:00', '2021-03-15 12:30:00', '2021-03-15 10:44:25', 0, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (125, '', '焦倩', 2.00000000, '事假', '补办银行卡', '电脑桌面上有一份于甜甜的简历，今年本科刚毕业，想应聘前端开发岗位，没有实际工作经验只有在校时候跟着开发的经验，帮忙问一下前端的老师是否合适然后在微信上跟于甜甜说一声，谢谢', '审批通过', '2021-03-15 08:30:00', '2021-03-15 10:30:00', '2021-03-14 15:26:28', 0, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (126, '', '董青', 1.00000000, '事假', '预约补牙齿', '回来处理', '审批通过', '2021-03-13 17:00:00', '2021-03-13 18:00:00', '2021-03-13 08:37:46', 0, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (127, '', '席伟男', 1.00000000, '事假', '加班', '电话联系', '审批通过', '2021-03-13 08:30:00', '2021-03-13 09:30:00', '2021-03-13 07:29:23', 0, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (128, '', '马廷广', 2.50000000, '事假', '家中有事', '回来继续', '审批通过', '2021-03-13 08:30:00', '2021-03-13 11:00:00', '2021-03-13 00:27:37', 0, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (129, '', '蔺要红', 1.00000000, '事假', '家里有事', '可以随时电话', '审批通过', '2021-03-13 08:30:00', '2021-03-13 09:30:00', '2021-03-13 00:05:38', 0, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (130, '', '张元艳', 8.00000000, '事假', '搬家需请假一天', '回来继续', '审批通过', '2021-03-13 08:30:00', '2021-03-13 18:00:00', '2021-03-12 14:14:04', 0, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (131, '', '张燕', 4.00000000, '事假', '家里有事', '自己跟进', '审批通过', '2021-03-12 14:00:00', '2021-03-12 18:00:00', '2021-03-12 08:30:17', 0, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (132, '', '张燕', 1.00000000, '事假', '家里有事', '自己跟进', '审批通过', '2021-03-12 08:30:00', '2021-03-12 09:30:00', '2021-03-12 08:30:22', 0, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (133, '', '蔺要红', 0.50000000, '事假', '家中有事', '无', '审批通过', '2021-03-11 09:00:00', '2021-03-11 09:30:00', '2021-03-11 08:49:42', 0, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (134, '', '马廷广', 8.00000000, '事假', '家中有事', '回来继续', '审批通过', '2021-03-11 08:30:00', '2021-03-11 18:00:00', '2021-03-10 18:23:49', 0, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (135, '', '席伟男', 2.00000000, '事假', '家中有事', '电话联系', '审批通过', '2021-03-10 08:30:00', '2021-03-10 10:30:00', '2021-03-10 08:04:07', 0, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (136, '', '席伟男', 3.98000000, '事假', '排队拍ct', '电话联系', '审批通过', '2021-03-09 14:01:00', '2021-03-09 18:00:00', '2021-03-09 14:02:44', 0, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (137, '', '席伟男', 4.00000000, '事假', '去医院看看腰', '随时联系', '审批通过', '2021-03-09 08:30:00', '2021-03-09 12:30:00', '2021-03-09 09:52:52', 1, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (138, '', '董青', 3.00000000, '事假', '幼儿园开家长会', '回来继续', '审批通过', '2021-03-08 15:00:00', '2021-03-08 18:00:00', '2021-03-08 14:55:45', 0, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (139, '', '蔺要红', 12.00000000, '事假', '家里有事处理', '暂无', '审批通过', '2021-03-06 08:00:00', '2021-03-08 12:30:00', '2021-03-08 13:04:33', 1, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (140, '', '马廷广', 1.50000000, '事假', '家中有事', '回去继续', '审批通过', '2021-03-08 08:30:00', '2021-03-08 10:00:00', '2021-03-08 08:23:17', 0, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (141, '', '张元艳', 4.00000000, '事假', '有事需本人处理', '回来继续', '审批通过', '2021-03-08 08:30:00', '2021-03-08 12:30:00', '2021-03-08 07:48:36', 0, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (142, '', '张燕', 6.00000000, '事假', '家里有点事', '无交接', '审批通过', '2021-03-06 10:30:00', '2021-03-06 18:00:00', '2021-03-06 11:26:48', 1, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (143, '', '席伟男', 2.00000000, '事假', '家中有事', '电话联系', '审批通过', '2021-03-06 08:30:00', '2021-03-06 10:30:00', '2021-03-06 08:27:06', 0, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (144, '', '张富赢', 8.00000000, '事假', '家中有事', '电话联系，家中办公', '审批通过', '2021-03-06 08:30:00', '2021-03-06 18:00:00', '2021-03-05 13:24:20', 0, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (145, '', '蔺要红', 4.00000000, '事假', '家里有事情', '暂无', '审批通过', '2021-03-05 14:00:00', '2021-03-05 18:30:00', '2021-03-05 13:24:50', 0, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (146, '', '蔺要红', 2.00000000, '事假', '处理物业事情排队', '无', '审批通过', '2021-03-05 10:30:00', '2021-03-05 12:30:00', '2021-03-05 13:24:08', 1, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (147, '', '张元艳', 8.00000000, '事假', '家里漏水了', '回来继续', '审批通过', '2021-03-05 08:30:00', '2021-03-05 18:00:00', '2021-03-05 10:02:48', 1, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (148, '', '席伟男', 3.00000000, '事假', '联系换锁', '电话联系', '审批通过', '2021-03-05 08:30:00', '2021-03-05 11:30:00', '2021-03-05 09:13:01', 1, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (149, '', '蔺要红', 2.00000000, '事假', '需要去物业办理业务', '回去继续', '审批通过', '2021-03-05 08:30:00', '2021-03-05 10:30:00', '2021-03-05 09:13:30', 1, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (150, '', '马廷广', 1.00000000, '事假', '家中有事', '回来继续', '审批通过', '2021-03-04 17:00:00', '2021-03-04 18:00:00', '2021-03-04 16:36:42', 0, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (151, '', '董青', 3.00000000, '事假', '给小朋友办理入园体检', '已交接', '审批通过', '2021-03-03 15:00:00', '2021-03-03 18:00:00', '2021-03-03 15:42:29', 1, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (152, '', '席伟男', 2.00000000, '事假', '家中有事', '电话联系', '审批通过', '2021-03-02 08:30:00', '2021-03-02 10:30:00', '2021-03-02 08:24:45', 0, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (153, '', '蔺要红', 2.00000000, '事假', '临时家里有事', '无', '审批通过', '2021-03-01 08:30:00', '2021-03-01 10:30:00', '2021-03-01 09:38:34', 1, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (154, '', '于翔翔', 8.00000000, '事假', '亲戚住院，随家人前去看望', '回来继续', '审批通过', '2021-03-01 08:30:00', '2021-03-01 18:00:00', '2021-03-01 09:12:37', 1, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (155, '', '马廷广', 2.00000000, '事假', '家中有事', '回去继续', '审批通过', '2021-03-01 08:30:00', '2021-03-01 10:30:00', '2021-03-01 09:12:25', 1, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (156, '', '董青', 2.00000000, '事假', '家里有事', '已对接', '审批通过', '2021-02-27 16:00:00', '2021-02-27 18:00:00', '2021-02-27 16:02:28', 0, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (157, '', '董青', 1.00000000, '事假', '水管漏水，找人修一下', '回去继续', '审批通过', '2021-02-26 08:30:00', '2021-02-26 09:30:00', '2021-02-26 08:59:30', 1, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (158, '', '蔺要红', 8.00000000, '事假', '家里人有事情, 需要在家看娃，会在家里完成接口开发，整理接口文档', '有问题及时联系', '审批通过', '2021-02-26 08:30:00', '2021-02-26 18:00:00', '2021-02-26 08:27:25', 0, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (159, '', '石仕刚', 16.00000000, '事假', '我哥结婚', '回家晚上改', '审批通过', '2021-02-26 08:30:00', '2021-02-27 18:00:00', '2021-02-26 08:29:55', 0, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (160, '', '刘顺', 4.00000000, '事假', '病假，去医院做个检查', '有需求在家改', '审批通过', '2021-02-25 14:00:00', '2021-02-25 18:00:00', '2021-02-25 14:18:32', 1, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (161, '', '于翔翔', 4.00000000, '事假', '路上滑，摔了一跤，回家整下衣服', '回来继续', '审批通过', '2021-02-25 08:30:00', '2021-02-25 12:30:00', '2021-02-25 09:47:45', 1, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (162, '', '刘顺', 4.00000000, '事假', '病假，挂个点滴，最后一天', '暂无', '审批通过', '2021-02-25 08:30:00', '2021-02-25 12:30:00', '2021-02-25 08:51:26', 1, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (163, '', '席伟男', 4.00000000, '事假', '家里有事，去人民医院', '电话联系，随时处理', '审批通过', '2021-02-25 08:30:00', '2021-02-25 12:30:00', '2021-02-25 08:31:37', 0, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (164, '', '马廷广', 2.00000000, '事假', '家中有事', '回去继续', '审批通过', '2021-02-25 08:30:00', '2021-02-25 10:30:00', '2021-02-25 08:31:23', 0, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (165, '', '刘顺', 4.00000000, '事假', '病假', '暂无', '审批通过', '2021-02-24 14:00:00', '2021-02-24 18:00:00', '2021-02-24 17:01:02', 1, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (166, '', '于翔翔', 2.00000000, '事假', '头痛', '回去继续', '审批通过', '2021-02-24 08:00:00', '2021-02-24 10:30:00', '2021-02-24 08:30:17', 1, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (167, '', '刘顺', 4.00000000, '事假', '病假', '有反馈我在家里改', '审批通过', '2021-02-23 12:30:00', '2021-02-23 18:00:00', '2021-02-23 14:19:05', 1, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (168, '', '蔺要红', 4.00000000, '事假', '家里有事处理，延长2个小时', '回去继续', '审批通过', '2021-02-23 08:00:00', '2021-02-23 12:30:00', '2021-02-23 10:42:46', 1, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (169, '', '刘顺', 4.00000000, '事假', '病假，受冻有点发热', '回来继续', '审批通过', '2021-02-23 08:30:00', '2021-02-23 12:30:00', '2021-02-23 09:07:00', 1, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (170, '', '席伟男', 4.00000000, '事假', '帮家人去医院拿东西', '随时联系', '审批通过', '2021-02-23 08:30:00', '2021-02-23 12:30:00', '2021-02-23 08:35:45', 1, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (171, '', '赵文政', 2.00000000, '事假', '去趟医院', '回去继续', '审批通过', '2021-02-23 07:51:00', '2021-02-23 10:30:00', '2021-02-23 09:06:12', 1, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (172, '', '马廷广', 4.00000000, '事假', '回趟老家办手续', '回去继续', '审批通过', '2021-02-23 08:30:00', '2021-02-23 12:30:00', '2021-02-23 08:29:24', 0, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (173, '', '于翔翔', 2.00000000, '事假', '家里有事', '回来继续', '审批通过', '2021-02-22 08:30:00', '2021-02-22 10:30:00', '2021-02-22 09:29:34', 1, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (174, '', '马廷广', 1.50000000, '事假', '家中有事', '回去继续', '审批通过', '2021-02-22 08:30:00', '2021-02-22 10:00:00', '2021-02-22 09:29:15', 1, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (175, '', '张元艳', 2.00000000, '事假', '去趟医院，看病人', '回来继续', '审批通过', '2021-02-22 08:30:00', '2021-02-22 10:30:00', '2021-02-22 09:20:44', 1, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (176, '', '席伟男', 4.00000000, '事假', '加班太晚', '电话联系', '审批通过', '2021-02-22 08:30:00', '2021-02-22 12:30:00', '2021-02-22 08:39:16', 1, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (177, '', '董青', 8.00000000, '事假', '老家有事，需要回去', '回来处理', '审批通过', '2021-02-22 08:30:00', '2021-02-22 18:00:00', '2021-02-22 08:38:50', 1, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (178, '', '于翔翔', 1.50000000, '事假', '回去有点事', '回来继续', '审批通过', '2021-02-20 11:00:00', '2021-02-20 12:30:00', '2021-02-20 10:51:55', 0, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (179, '', '蔺要红', 1.00000000, '事假', '肚子不舒服，', '回去处理', '审批通过', '2021-02-20 07:56:00', '2021-02-20 09:30:00', '2021-02-20 08:25:16', 1, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (180, '', '席伟男', 8.00000000, '事假', '家中有事回平邑', '随时联系处理', '审批通过', '2021-02-19 08:30:00', '2021-02-19 18:00:00', '2021-02-18 17:39:23', 0, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (181, '', '蔺要红', 1.00000000, '事假', '回家看小孩,早点回去有事情', '暂无', '审批通过', '2021-02-18 17:00:00', '2021-02-18 18:00:00', '2021-02-19 14:15:28', 1, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (182, '', '刘顺', 5.00000000, '事假', '房子装修有问题', '暂无', '审批通过', '2021-02-18 11:30:00', '2021-02-18 18:00:00', '2021-02-18 11:29:09', 0, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (183, '', '张元艳', 4.00000000, '事假', '过敏了，去看看。', '回去继续', '审批通过', '2021-02-18 08:30:00', '2021-02-18 12:30:00', '2021-02-18 09:26:39', 1, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (184, '', '马廷广', 4.00000000, '事假', '家中有事', '回去继续', '审批通过', '2021-02-18 08:30:00', '2021-02-18 12:30:00', '2021-02-18 08:29:40', 0, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (185, '', '赵文政', 2.00000000, '事假', '家里有事', '加班处理', '审批通过', '2021-01-31 08:30:00', '2021-01-31 10:30:00', '2021-01-31 12:26:16', 1, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (186, '', '蔺要红', 1.50000000, '事假', '去物业办理手续', '无', '审批通过', '2021-01-31 07:56:00', '2021-01-31 10:00:00', '2021-01-31 09:56:13', 1, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (187, '', '马廷广', 1.50000000, '事假', '家中有事', '回去继续', '审批通过', '2021-01-31 08:30:00', '2021-01-31 10:00:00', '2021-01-31 08:30:29', 0, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (188, '', '张燕', 4.00000000, '事假', '去医院', '自己跟进', '审批通过', '2021-01-31 08:30:00', '2021-01-31 12:30:00', '2021-01-31 08:31:03', 0, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (189, '', '马廷广', 1.00000000, '事假', '家中有事', '回去继续', '审批通过', '2021-01-30 08:30:00', '2021-01-30 09:30:00', '2021-01-30 08:29:33', 0, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (190, '', '席伟男', 1.00000000, '事假', '202直播沟通，208测试，问题反馈太晚，休息一小时', '随时联系', '审批通过', '2021-01-30 08:30:00', '2021-01-30 09:30:00', '2021-01-30 08:29:15', 0, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (191, '', '董青', 4.00000000, '事假', '家里有事', '已交接', '审批通过', '2021-01-30 14:00:00', '2021-01-30 18:00:00', '2021-01-29 20:03:52', 0, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (192, '', '张富赢', 13.00000000, '事假', '家中有事', '带着电脑，有事联系', '审批通过', '2021-01-29 11:30:00', '2021-01-31 18:00:00', '2021-01-29 08:53:54', 0, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (193, '', '蔺要红', 1.00000000, '事假', '家里有点事需要处理', '无', '审批通过', '2021-01-29 07:50:00', '2021-01-29 09:30:00', '2021-01-29 08:29:52', 1, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (194, '', '金士通', 8.00000000, '事假', '带小孩去医院', '自己处理', '审批通过', '2021-01-29 08:30:00', '2021-01-29 18:00:00', '2021-01-29 08:29:24', 0, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (195, '', '张燕', 4.00000000, '事假', '家里有点事', '自己跟进', '审批通过', '2021-01-29 08:30:00', '2021-01-29 12:30:00', '2021-01-29 08:29:11', 0, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (196, '', '马廷广', 8.00000000, '事假', '家中有事', '回去继续', '审批通过', '2021-01-29 08:30:00', '2021-01-29 18:00:00', '2021-01-29 08:30:11', 0, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (197, '', '张元艳', 4.00000000, '事假', '家里有事需处理。', '回来继续', '审批通过', '2021-01-28 08:30:00', '2021-01-28 12:30:00', '2021-01-28 09:40:47', 1, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (198, '', '蔺要红', 8.00000000, '事假', '陪家人有事处理', '随时联系', '审批通过', '2021-01-28 08:30:00', '2021-01-28 18:00:00', '2021-01-28 08:42:40', 1, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (199, '', '马廷广', 8.00000000, '事假', '家中有事', '610接口已开发完成，前端对接中，如果接口有问题，先搁置，后天处理', '审批通过', '2021-01-28 08:30:00', '2021-01-28 18:00:00', '2021-01-28 08:19:45', 0, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (200, '', '张元艳', 4.00000000, '事假', '家里热水器的管漏水了，约了师傅来修。', '自行跟进，回去继续', '审批通过', '2021-01-27 08:30:00', '2021-01-27 12:30:00', '2021-01-27 08:40:15', 1, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (201, '', '于翔翔', 2.00000000, '事假', '家里有点事', '回来继续', '审批通过', '2021-01-26 07:51:00', '2021-01-26 10:30:00', '2021-01-26 09:15:41', 1, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (202, '', '马廷广', 2.00000000, '事假', '家中有事', '回去继续', '审批通过', '2021-01-26 08:30:00', '2021-01-26 10:30:00', '2021-01-26 09:15:24', 1, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (203, '', '席伟男', 4.00000000, '事假', '家中有事', '家中有事，随时准备处理处理', '审批通过', '2021-01-26 08:30:00', '2021-01-26 14:00:00', '2021-01-26 07:53:17', 0, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (204, '', '张燕', 8.00000000, '事假', '家里有事', '自己跟进', '审批通过', '2021-01-26 08:30:00', '2021-01-26 18:00:00', '2021-01-25 14:43:47', 0, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (205, '', '蔺要红', 2.00000000, '事假', '家里有点事', '回去继续', '审批通过', '2021-01-25 07:59:00', '2021-01-25 10:30:00', '2021-01-25 08:30:00', 1, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (206, '', '石仕刚', 1.00000000, '事假', '回家赶公交', '回家继续', '审批通过', '2021-01-23 17:00:00', '2021-01-23 18:00:00', '2021-01-23 14:57:19', 0, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (207, '', '董青', 4.00000000, '事假', '家里有事', '已交接', '审批通过', '2021-01-23 14:00:00', '2021-01-23 18:00:00', '2021-01-23 09:28:09', 0, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (208, '', '董青', 68.00000000, '事假', '家里有事', '已连接', '审批未通过', '2021-01-14 14:00:00', '2021-01-23 18:00:00', '2021-01-23 09:21:34', 1, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (209, '', '于翔翔', 1.00000000, '事假', '家里有点事，需要紧急处理一下', '回来继续', '审批通过', '2021-01-23 08:30:00', '2021-01-23 09:30:00', '2021-01-23 09:28:29', 1, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (210, '', '席伟男', 8.00000000, '事假', '孩子今天放假家长开会', '随时联系', '审批通过', '2021-01-23 08:30:00', '2021-01-23 18:00:00', '2021-01-23 09:27:53', 1, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (211, '', '马廷广', 4.00000000, '事假', '家中有事', '回去继续', '审批通过', '2021-01-23 08:30:00', '2021-01-23 12:30:00', '2021-01-23 08:24:44', 0, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (212, '', '蔺要红', 8.00000000, '事假', '家中有事，去医院', '和赵配合', '审批通过', '2021-01-22 08:30:00', '2021-01-22 19:00:00', '2021-01-22 08:49:31', 1, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (213, '', '蔺要红', 1.00000000, '事假', '需要看小孩', '暂无', '审批通过', '2021-01-21 07:47:00', '2021-01-21 09:30:00', '2021-01-21 08:43:27', 1, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (214, '', '于翔翔', 4.00000000, '事假', '家里等会有人来装燃气', '回来继续', '审批通过', '2021-01-19 08:30:00', '2021-01-19 12:30:00', '2021-01-19 08:31:20', 0, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (215, '', '席伟男', 4.00000000, '事假', '回平邑明天处理小孩上学的事', '随时联系', '审批通过', '2021-01-18 08:30:00', '2021-01-18 12:30:00', '2021-01-17 20:58:43', 0, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (216, '', '张志飞', 2.00000000, '事假', '身体不舒服，去看一下。', '回来继续。', '审批通过', '2021-01-16 07:48:00', '2021-01-16 10:30:00', '2021-01-16 08:31:35', 1, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (217, '', '马廷广', 1.00000000, '事假', '家中有事', '回去继续', '审批通过', '2021-01-15 08:30:00', '2021-01-15 09:30:00', '2021-01-15 08:36:27', 1, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (218, '', '蔺要红', 0.50000000, '事假', '临时有时', '无', '审批通过', '2021-01-14 14:00:00', '2021-01-14 14:30:00', '2021-01-14 14:46:58', 1, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (219, '', '张明浩', 8.00000000, '事假', '回老家办喜事', '202暂无反馈\n204正在设计\n单身说现有工作全部完成了', '审批通过', '2021-01-15 08:30:00', '2021-01-15 18:00:00', '2021-01-14 09:59:05', 0, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (220, '', '席伟男', 2.00000000, '事假', '家里有事', '随时处理', '审批通过', '2021-01-14 08:30:00', '2021-01-14 10:30:00', '2021-01-14 08:36:47', 1, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (221, '', '于翔翔', 2.00000000, '事假', '家里有事', '回来继续', '审批通过', '2021-01-13 08:30:00', '2021-01-13 10:30:00', '2021-01-13 09:22:45', 1, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (222, '', '蔺要红', 1.00000000, '事假', '看小孩', '无', '审批通过', '2021-01-13 07:51:00', '2021-01-13 09:30:00', '2021-01-13 08:27:14', 1, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (223, '', '席伟男', 2.00000000, '事假', '拿报告，复诊', '电联', '审批通过', '2021-01-12 08:30:00', '2021-01-12 10:30:00', '2021-01-12 08:25:19', 0, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (224, '', '马廷广', 1.00000000, '事假', '家中有事', '回去继续', '审批通过', '2021-01-12 07:57:00', '2021-01-12 09:30:00', '2021-01-12 08:25:31', 1, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (225, '', '席伟男', 4.00000000, '事假', '去抽血', '随时处理', '审批通过', '2021-01-11 08:30:00', '2021-01-11 12:30:00', '2021-01-11 10:12:22', 1, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (226, '', '蔺要红', 1.00000000, '事假', '需要看小孩', '无', '审批通过', '2021-01-11 08:30:00', '2021-01-11 09:30:00', '2021-01-11 08:32:43', 0, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (227, '', '张元艳', 2.00000000, '事假', '发烧了，去打个针', '回去继续', '审批通过', '2021-01-09 08:30:00', '2021-01-09 10:30:00', '2021-01-09 07:52:44', 0, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (228, '', '于翔翔', 8.00000000, '事假', '家中有事', '回来继续', '审批通过', '2021-01-09 08:30:00', '2021-01-09 18:30:00', '2021-01-08 20:00:57', 0, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (229, '', '席伟男', 4.00000000, '事假', '头疼拿药', '电话联系', '审批通过', '2021-01-08 08:30:00', '2021-01-08 12:30:00', '2021-01-08 10:16:28', 1, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (230, '', '张燕', 1.50000000, '事假', '家里有事', '自己跟进', '审批通过', '2021-01-08 08:30:00', '2021-01-08 10:00:00', '2021-01-08 09:18:00', 1, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (231, '', '于翔翔', 8.00000000, '事假', '去医院一趟，爷爷住院了', '回来继续', '审批通过', '2021-01-08 08:30:00', '2021-01-08 18:30:00', '2021-01-08 09:17:33', 1, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (232, '', '马廷广', 1.50000000, '事假', '家中有事', '回去继续', '审批通过', '2021-01-08 08:30:00', '2021-01-08 10:00:00', '2021-01-08 09:17:42', 1, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (233, '', '蔺要红', 1.00000000, '事假', '家中有事', '无', '审批通过', '2021-01-07 08:30:00', '2021-01-07 09:30:00', '2021-01-07 08:29:55', 0, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (234, '', '董青', 16.00000000, '事假', '家里有事，需要去外地', '暂无', '审批通过', '2021-01-07 08:30:00', '2021-01-08 18:00:00', '2021-01-06 18:09:29', 0, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (235, '', '席伟男', 4.00000000, '事假', '家中有事，医保转移，办卡缴学费等', '随时电话联系处理', '审批通过', '2021-01-06 08:30:00', '2021-01-06 12:30:00', '2021-01-06 08:45:57', 1, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (236, '', '蔺要红', 1.00000000, '事假', '临时看下孩子，家里有事', '无', '审批通过', '2021-01-06 08:05:00', '2021-01-06 09:30:00', '2021-01-06 08:46:06', 1, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (237, '', '于翔翔', 8.00000000, '事假', '家里有事，水管爆了，热水器坏了', '回来继续', '审批通过', '2021-01-05 08:30:00', '2021-01-05 18:00:00', '2021-01-05 08:27:54', 0, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (238, '', '蔺要红', 2.00000000, '事假', '需要看小孩，家里人事', '暂无', '审批通过', '2021-01-04 08:30:00', '2021-01-04 10:30:00', '2021-01-04 09:43:33', 1, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (239, '', '马廷广', 1.50000000, '事假', '家中有事', '回去继续', '审批通过', '2021-01-04 08:30:00', '2021-01-04 10:00:00', '2021-01-03 20:59:39', 0, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (240, '', '蔺要红', 1.00000000, '事假', '家里有点事情', '无', '审批通过', '2020-12-31 08:30:00', '2020-12-31 09:30:00', '2020-12-31 08:15:22', 0, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (241, '', '马廷广', 4.00000000, '事假', '家中有事', '回去继续', '审批通过', '2020-12-31 08:30:00', '2020-12-31 12:30:00', '2020-12-31 08:15:17', 0, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (242, '', '马廷广', 1.50000000, '事假', '打车去公司', '回去继续', '审批通过', '2020-12-30 08:30:00', '2020-12-30 10:00:00', '2020-12-30 09:20:15', 1, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (243, '', '马廷广', 1.00000000, '事假', '天气太差，打车过去', '回去继续', '审批通过', '2020-12-29 08:30:00', '2020-12-29 09:30:00', '2020-12-29 08:43:58', 1, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (244, '', '蔺要红', 2.00000000, '事假', '需要去医院', '回去处理', '审批通过', '2020-12-29 08:30:00', '2020-12-29 10:30:00', '2020-12-29 08:43:50', 1, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (245, '', '席伟男', 1.50000000, '事假', '家中有事，刚赶回来', '加班处理', '审批通过', '2020-12-28 08:30:00', '2020-12-28 10:00:00', '2020-12-28 07:54:43', 0, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (246, '', '蔺要红', 8.00000000, '事假', '家里有事需要处理', '无紧急事情，有事打电话', '审批通过', '2020-12-26 08:30:00', '2020-12-26 18:00:00', '2020-12-26 08:25:10', 0, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (247, '', '刘顺', 2.25000000, '事假', '修测试机', '暂无', '审批通过', '2020-12-25 15:45:00', '2020-12-25 18:00:00', '2020-12-25 15:49:11', 0, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (248, '', '张燕', 2.00000000, '事假', '家里有事', '自己跟进', '审批通过', '2020-12-25 16:00:00', '2020-12-25 18:00:00', '2020-12-25 14:28:28', 0, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (249, '', '马廷广', 1.50000000, '事假', '家中有事', '回去继续', '审批通过', '2020-12-25 08:08:00', '2020-12-25 10:00:00', '2020-12-25 08:15:21', 1, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (250, '', '于翔翔', 4.00000000, '事假', '头痛的厉害', '回来继续', '审批通过', '2020-12-25 08:30:00', '2020-12-25 12:30:00', '2020-12-25 08:10:05', 0, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (251, '', '马廷广', 4.00000000, '事假', '做胃镜', '回来继续', '审批通过', '2020-12-24 08:30:00', '2020-12-24 12:30:00', '2020-12-23 20:56:48', 0, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (252, '', '蔺要红', 8.00000000, '事假', '发烧需要去诊所', '电话联系', '审批通过', '2020-12-23 07:45:00', '2020-12-23 20:45:00', '2020-12-23 08:53:32', 1, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (253, '', '蔺要红', 1.00000000, '事假', '发烧，早点回去看看', '暂无', '审批通过', '2020-12-22 17:00:00', '2020-12-22 18:00:00', '2020-12-22 16:53:29', 0, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (254, '', '董青', 4.00000000, '事假', '专升本考试', '暂无交接', '审批通过', '2020-12-22 14:00:00', '2020-12-22 18:00:00', '2020-12-22 12:10:21', 0, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (255, '', '马廷广', 8.67000000, '事假', '练车和科三考试', '回来继续', '审批通过', '2020-12-22 11:20:00', '2020-12-23 12:00:00', '2020-12-22 11:32:03', 1, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (256, '', '张燕', 4.00000000, '事假', '身体不舒服，挂盐水', '无交接', '审批通过', '2020-12-21 14:00:00', '2020-12-21 18:00:00', '2020-12-21 10:51:22', 0, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (257, '', '张燕', 4.00000000, '事假', '身体不舒服，眩晕。', '自己跟进', '审批通过', '2020-12-21 08:30:00', '2020-12-21 12:30:00', '2020-12-21 08:31:26', 0, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (258, '', '马廷广', 8.00000000, '事假', '胃镜检查和练车', '回去继续', '审批通过', '2020-12-21 08:30:00', '2020-12-21 18:00:00', '2020-12-20 18:19:54', 0, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (259, '', '马廷广', 2.83000000, '事假', '去医院检查下胃', '回来继续', '审批通过', '2020-12-19 15:10:00', '2020-12-19 18:00:00', '2020-12-19 14:59:42', 0, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (260, '', '席伟男', 5.50000000, '事假', '回烟台探亲', '正常处理，急事电话联系', '审批通过', '2020-12-19 11:00:00', '2020-12-19 18:00:00', '2020-12-19 10:30:53', 0, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (261, '', '马廷广', 4.00000000, '事假', '练车', '回去继续', '审批通过', '2020-12-18 14:00:00', '2020-12-18 18:00:00', '2020-12-18 13:12:59', 0, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (262, '', '于翔翔', 8.00000000, '事假', '家里有事，回家一趟', '回来继续', '审批通过', '2020-12-18 08:30:00', '2020-12-18 18:00:00', '2020-12-18 08:37:30', 1, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (263, '', '蔺要红', 1.00000000, '事假', '家里临时有点事耽误一下', '到公司处理', '审批通过', '2020-12-18 08:16:00', '2020-12-18 09:30:00', '2020-12-18 08:37:42', 1, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (264, '', '席伟男', 4.00000000, '事假', '家中有事', '电话联系', '审批通过', '2020-12-18 08:30:00', '2020-12-18 12:30:00', '2020-12-18 08:38:03', 1, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (265, '', '刘顺', 4.00000000, '事假', '家里有事', '暂无需要安排', '审批通过', '2020-12-17 14:00:00', '2020-12-17 18:00:00', '2020-12-17 14:16:55', 1, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (266, '', '马廷广', 4.00000000, '事假', '练车', '回来继续', '审批通过', '2020-12-16 14:00:00', '2020-12-16 18:00:00', '2020-12-16 13:30:57', 0, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (267, '', '于翔翔', 2.00000000, '事假', '自行车坏了', '回来继', '审批通过', '2020-12-16 08:30:00', '2020-12-16 10:30:00', '2020-12-16 08:56:00', 1, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (268, '', '金士通', 16.00000000, '事假', '亲人去世', '在家处理', '审批通过', '2020-12-15 08:30:00', '2020-12-16 18:00:00', '2020-12-14 20:35:30', 0, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (269, '', '马廷广', 4.00000000, '事假', '练车', '回来继续', '审批通过', '2020-12-14 14:00:00', '2020-12-14 18:00:00', '2020-12-14 11:36:28', 0, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (270, '', '席伟男', 4.00000000, '事假', '家中有事', '电话联系', '审批通过', '2020-12-14 08:30:00', '2020-12-14 12:30:00', '2020-12-14 09:18:03', 1, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (271, '', '金祥祥', 4.00000000, '事假', '家中有事，回去处理', '回来继续', '审批通过', '2020-12-14 08:30:00', '2020-12-14 12:30:00', '2020-12-13 09:53:49', 0, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (272, '', '董青', 8.00000000, '事假', '考试', '已完成', '审批通过', '2020-12-14 08:30:00', '2020-12-14 18:00:00', '2020-12-12 14:22:43', 0, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (273, '', '蔺要红', 4.00000000, '事假', '朋友从外地来玩，陪护', '相关接口已提供给赵, 等待前端页面，有问题打电话', '审批通过', '2020-12-12 14:00:00', '2020-12-12 18:00:00', '2020-12-12 10:44:47', 0, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (274, '', '马廷广', 4.00000000, '事假', '练车', '回去继续', '审批通过', '2020-12-12 08:30:00', '2020-12-12 12:30:00', '2020-12-11 20:53:15', 0, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (275, '', '刘顺', 4.00000000, '事假', '修电脑', '无', '审批通过', '2020-12-11 12:30:00', '2020-12-11 18:00:00', '2020-12-11 12:31:03', 0, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (276, '', '马廷广', 4.00000000, '事假', '练车', '回来继续', '审批通过', '2020-12-11 14:00:00', '2020-12-11 18:00:00', '2020-12-11 11:58:12', 0, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (277, '', '蔺要红', 2.00000000, '事假', '家里临时有事', '去公司处理', '审批通过', '2020-12-11 08:30:00', '2020-12-11 10:30:00', '2020-12-11 08:39:16', 1, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (278, '', '马廷广', 1.00000000, '事假', '去医院拿点东西', '回去继续', '审批通过', '2020-12-09 08:30:00', '2020-12-09 09:30:00', '2020-12-09 08:50:02', 1, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (279, '', '蔺要红', 2.00000000, '事假', '去物业处理点视频', '回去继续工作', '审批通过', '2020-12-08 08:27:00', '2020-12-08 10:30:00', '2020-12-08 08:42:35', 1, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (280, '', '席伟男', 4.00000000, '事假', '家中有事需要陪床', '随时联系', '审批通过', '2020-12-07 08:30:00', '2020-12-07 12:30:00', '2020-12-07 08:11:53', 0, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (281, '', '于翔翔', 8.00000000, '事假', '家里有事', '回来继续', '审批通过', '2020-12-07 08:00:00', '2020-12-07 18:00:00', '2020-12-07 08:12:00', 1, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (282, '', '张富赢', 8.00000000, '事假', '家中有事', '随时电话联系', '审批通过', '2020-12-07 08:30:00', '2020-12-07 18:00:00', '2020-12-05 10:28:35', 0, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (283, '', '马廷广', 1.00000000, '事假', '家中有事', '回去继续', '审批通过', '2020-12-05 08:30:00', '2020-12-05 09:30:00', '2020-12-05 10:28:44', 1, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (284, '', '席伟男', 4.00000000, '事假', '陪奶奶去人民医院', '电话联系，方案今晚已经完成大部分', '审批通过', '2020-12-05 08:30:00', '2020-12-05 12:30:00', '2020-12-04 22:49:41', 0, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (285, '', '赵文政', 8.00000000, '事假', '家里有事', '目前的或完成，有反馈回来处理', '审批通过', '2020-12-05 08:30:00', '2020-12-05 18:00:00', '2020-12-04 22:16:31', 0, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (286, '', '冯聪聪', 7.00000000, '事假', '口腔上火带着牙龈发炎。痛的话都说不出', '缓解马上干', '审批通过', '2020-12-03 09:30:00', '2020-12-03 18:00:00', '2020-12-03 10:52:35', 1, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (287, '', '席伟男', 1.50000000, '事假', '检查颈椎', '随时处理', '审批通过', '2020-12-03 08:30:00', '2020-12-03 10:00:00', '2020-12-03 08:37:59', 1, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (288, '', '刘顺', 2.00000000, '事假', '钥匙丢了，找钥匙', '。', '审批通过', '2020-12-03 08:30:00', '2020-12-03 10:30:00', '2020-12-03 08:38:09', 1, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (289, '', '马廷广', 8.00000000, '事假', '家中有事', '回去继续', '审批通过', '2020-12-03 08:30:00', '2020-12-03 18:00:00', '2020-12-02 21:01:52', 0, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (290, '', '马廷广', 3.00000000, '事假', '家中有事', '回来继续', '审批通过', '2020-12-02 15:00:00', '2020-12-02 18:00:00', '2020-12-02 13:32:22', 0, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (291, '', '冯聪聪', 5.00000000, '事假', '路上赶路', '到公司马上干', '审批通过', '2020-12-01 08:30:00', '2020-12-01 15:00:00', '2020-12-01 00:50:39', 0, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (292, '', '张明浩', 8.00000000, '事假', '查体需要工作日去请假需要', '直播带货页面刚出回来赶上搭界面', '审批通过', '2020-12-01 08:30:00', '2020-12-01 18:00:00', '2020-11-30 17:31:38', 0, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (293, '', '马廷广', 1.00000000, '事假', '家中有事', '回去继续', '审批通过', '2020-11-30 08:30:00', '2020-11-30 09:30:00', '2020-11-30 10:48:07', 1, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (294, '', '于翔翔', 8.00000000, '事假', '头痛不舒服', '回来继续', '审批通过', '2020-11-30 08:00:00', '2020-11-30 18:00:00', '2020-11-30 10:48:16', 1, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (295, '', '蔺要红', 8.00000000, '事假', '家中有事情处理', '在家处理公司的事情', '审批通过', '2020-11-28 08:30:00', '2020-11-28 18:00:00', '2020-11-28 09:38:33', 1, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (296, '', '金士通', 8.00000000, '事假', '家中有事', '在家处理', '审批通过', '2020-11-28 08:30:00', '2020-11-28 18:00:00', '2020-11-28 08:32:42', 0, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (297, '', '冯聪聪', 16.00000000, '事假', '个人家里有事', '有事电话', '审批通过', '2020-11-28 08:30:00', '2020-11-30 18:00:00', '2020-11-27 18:04:36', 0, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (298, '', '张富赢', 8.00000000, '事假', '家中有事', '随时电话联系', '审批通过', '2020-11-28 08:30:00', '2020-11-28 18:00:00', '2020-11-27 08:45:01', 0, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (299, '', '冯聪聪', 0.50000000, '事假', '路上遇到点事情', '到公司继续干', '审批通过', '2020-11-27 08:30:00', '2020-11-27 09:00:00', '2020-11-27 08:44:52', 1, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (300, '', '刘顺', 5.97000000, '事假', '苹果手机不能进行真机测试，充不进电，无法对接口了，去百脑汇修手机，', '。', '审批通过', '2020-11-26 10:32:00', '2020-11-26 18:00:00', '2020-11-26 10:35:54', 0, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (301, '', '于翔翔', 2.00000000, '事假', '有点事', '回来继续', '审批通过', '2020-11-26 08:30:00', '2020-11-26 10:30:00', '2020-11-26 08:58:26', 1, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (302, '', '刘顺', 2.00000000, '事假', '车带子扎了，', '。', '审批通过', '2020-11-26 08:30:00', '2020-11-26 10:30:00', '2020-11-26 08:53:37', 1, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (303, '', '蔺要红', 3.50000000, '事假', '家里有事，需要去办理燃气', '无', '审批通过', '2020-11-25 07:51:00', '2020-11-25 12:00:00', '2020-11-25 10:32:45', 1, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (304, '', '冯聪聪', 0.50000000, '事假', '路上遇到问题，电瓶车内胎漏气', '到公司继续干', '审批通过', '2020-11-25 08:30:00', '2020-11-25 09:00:00', '2020-11-25 08:42:16', 1, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (305, '', '刘顺', 3.92000000, '事假', '病假，还在门诊', '已安排', '审批通过', '2020-11-24 14:05:00', '2020-11-24 18:05:00', '2020-11-24 14:10:21', 1, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (306, '', '马廷广', 1.77000000, '事假', '路上有事', '回去继续', '审批通过', '2020-11-24 08:44:00', '2020-11-24 10:30:00', '2020-11-24 09:07:02', 1, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (307, '', '刘顺', 4.00000000, '事假', '吃坏肚子，肚子疼，去看病', '暂时没有需要安排的', '审批通过', '2020-11-24 08:30:00', '2020-11-24 12:30:00', '2020-11-24 09:06:47', 1, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (308, '', '席伟男', 4.00000000, '事假', '预约的体检', '随时电话联系', '审批通过', '2020-11-23 08:30:00', '2020-11-23 12:30:00', '2020-11-23 07:52:08', 0, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (309, '', '蔺要红', 0.50000000, '事假', '家里有点事处理', '到公司处理', '审批通过', '2020-11-21 09:30:00', '2020-11-21 10:00:00', '2020-11-21 09:31:49', 0, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (310, '', '冯聪聪', 8.00000000, '事假', '个人身体不适，腹痛。', '尽量了解观察', '审批通过', '2020-11-21 08:30:00', '2020-11-21 18:00:00', '2020-11-21 09:30:30', 1, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (311, '', '蔺要红', 1.00000000, '事假', '家里有点事处理', '到公司处理', '审批通过', '2020-11-21 07:45:00', '2020-11-21 09:30:00', '2020-11-21 09:30:25', 1, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (312, '', '赵文政', 4.00000000, '事假', '家里有事', '下午回来继续', '审批通过', '2020-11-20 08:30:00', '2020-11-20 12:30:00', '2020-11-19 20:32:47', 0, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (313, '', '蔺要红', 8.00000000, '事假', '严重失眠', '接口已经开发完。整理好文档交付给赵，如果需要上线，在家处理，有问题打电话', '审批通过', '2020-11-18 08:30:00', '2020-11-18 18:00:00', '2020-11-18 08:50:20', 1, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (314, '', '刘顺', 4.00000000, '事假', '修电脑', '已安排妥当', '审批通过', '2020-11-16 12:30:00', '2020-11-16 18:00:00', '2020-11-16 11:14:01', 0, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (315, '', '马廷广', 1.50000000, '事假', '家中有事', '回去继续', '审批通过', '2020-11-16 08:30:00', '2020-11-16 10:00:00', '2020-11-16 08:30:32', 0, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (316, '', '于翔翔', 8.00000000, '事假', '家中有事', '回来继续', '审批通过', '2020-11-16 08:00:00', '2020-11-16 18:00:00', '2020-11-16 08:30:19', 1, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (317, '', '赵文政', 8.00000000, '事假', '家里有事', '有问题下午在家处理', '审批通过', '2020-11-14 08:30:00', '2020-11-14 18:00:00', '2020-11-13 17:27:26', 0, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (318, '', '席伟男', 8.00000000, '事假', '出门办事', '随时电话联系 带着电脑', '审批通过', '2020-11-14 08:30:00', '2020-11-14 18:00:00', '2020-11-12 21:08:57', 0, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (319, '', '张燕', 1.00000000, '事假', '参加学校家长会', '无交接，自己跟进。', '审批通过', '2020-11-13 17:00:00', '2020-11-13 18:00:00', '2020-11-12 17:41:14', 0, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (320, '', '赵文政', 8.00000000, '事假', '家里有事', '回来继续', '审批通过', '2020-11-13 08:30:00', '2020-11-13 18:00:00', '2020-11-12 17:21:45', 0, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (321, '', '蔺要红', 1.00000000, '事假', '有事', '无', '审批通过', '2020-11-12 08:30:00', '2020-11-12 09:30:00', '2020-11-12 08:45:13', 1, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (322, '', '冯聪聪', 8.00000000, '事假', '个人有事，要去物业处理', '尽量收集信息', '审批通过', '2020-11-12 08:30:00', '2020-11-12 18:00:00', '2020-11-12 08:45:08', 1, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (323, '', '于翔翔', 8.00000000, '事假', '家中有事', '回来继续', '审批通过', '2020-11-12 08:30:00', '2020-11-12 18:00:00', '2020-11-12 08:44:51', 1, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (324, '', '马廷广', 4.00000000, '事假', '家中有事', '回来继续', '审批通过', '2020-11-11 14:00:00', '2020-11-11 18:00:00', '2020-11-11 12:30:44', 0, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (325, '', '张燕', 2.50000000, '事假', '带家人检查', '无交接，自己跟进。', '审批通过', '2020-11-11 15:30:00', '2020-11-11 18:00:00', '2020-11-11 10:35:57', 0, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (326, '', '侯振', 8.00000000, '事假', '老家叔伯过世出殡', '随时联系', '审批通过', '2020-11-09 08:30:00', '2020-11-09 18:00:00', '2020-11-07 17:09:17', 0, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (327, '', '马廷广', 2.00000000, '事假', '家中有事', '回去继续', '审批通过', '2020-11-07 08:30:00', '2020-11-07 10:30:00', '2020-11-07 09:10:09', 1, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (328, '', '金士通', 8.00000000, '事假', '家中有事', '在家处理', '审批通过', '2020-11-07 08:30:00', '2020-11-07 18:00:00', '2020-11-06 18:29:40', 0, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (329, '', '赵文政', 4.00000000, '事假', '看牙', '回来继续', '审批通过', '2020-11-06 12:30:00', '2020-11-06 18:00:00', '2020-11-06 10:22:58', 0, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (330, '', '蔺要红', 2.00000000, '事假', '家中有事', '晚点回公司处理', '审批通过', '2020-11-06 08:30:00', '2020-11-06 10:30:00', '2020-11-06 08:56:50', 1, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (331, '', '于翔翔', 8.00000000, '事假', '家里有事，周天补回来', '', '审批通过', '2020-11-05 08:30:00', '2020-11-05 18:00:00', '2020-11-05 08:30:50', 0, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (332, '', '刘顺', 8.00000000, '事假', '家里有事', '', '审批通过', '2020-11-05 08:30:00', '2020-11-05 18:00:00', '2020-11-04 14:30:43', 0, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (333, '', '冯聪聪', 4.00000000, '事假', '感冒，请假休息', '', '审批未通过', '2020-11-03 14:00:00', '2020-11-03 18:00:00', '2020-11-03 16:09:47', 1, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (334, '', '冯聪聪', 4.00000000, '事假', '感冒去药店拿药', '', '审批通过', '2020-11-03 08:30:00', '2020-11-03 12:30:00', '2020-11-03 08:57:04', 1, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (335, '', '于翔翔', 8.00000000, '事假', '发烧', '', '审批通过', '2020-10-30 08:30:00', '2020-10-30 18:00:00', '2020-10-30 08:32:03', 0, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (336, '', '席伟男', 1.00000000, '事假', '打退烧针', '', '审批通过', '2020-10-30 08:30:00', '2020-10-30 09:30:00', '2020-10-30 08:31:03', 0, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (337, '', '侯振', 8.00000000, '事假', '家中有事', '', '审批通过', '2020-10-30 08:30:00', '2020-10-30 18:00:00', '2020-10-30 08:30:49', 0, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (338, '', '席伟男', 3.50000000, '事假', '嗓子疼，发烧，去医院看下', '', '审批通过', '2020-10-29 08:30:00', '2020-10-29 12:00:00', '2020-10-29 09:34:23', 1, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (339, '', '蔺要红', 1.50000000, '事假', '换电池', '', '审批通过', '2020-10-28 16:30:00', '2020-10-28 18:00:00', '2020-10-28 16:29:34', 0, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (340, '', '黄宗赫', 3.50000000, '事假', '回家相亲', '', '审批通过', '2020-10-28 08:30:00', '2020-10-28 12:00:00', '2020-10-27 18:57:42', 0, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (341, '', '冯聪聪', 8.00000000, '事假', '因还在对象家处理事情，请假一天', '', '审批通过', '2020-10-26 08:30:00', '2020-10-26 18:00:00', '2020-10-26 09:54:54', 1, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (342, '', '冯聪聪', 16.00000000, '事假', '个人有事回家和对象一起处理', '', '审批通过', '2020-10-23 08:30:00', '2020-10-24 18:00:00', '2020-10-23 09:55:10', 1, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (343, '', '黄宗赫', 16.00000000, '事假', '姐姐结婚 男方习俗女方父母不能到场 需要我过去操持事情', '', '审批通过', '2020-10-24 08:30:00', '2020-10-26 18:00:00', '2020-10-22 15:48:16', 0, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (344, '', '冯聪聪', 3.50000000, '事假', '个人回家有事未归临沂，请假上午时间', '', '审批通过', '2020-10-19 08:30:00', '2020-10-19 12:00:00', '2020-10-19 09:23:00', 1, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (345, '', '黄宗赫', 8.00000000, '事假', '小区暖气打压 家里需要有人', '', '审批通过', '2020-10-17 08:30:00', '2020-10-17 18:00:00', '2020-10-15 14:25:11', 0, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (346, '', '冯聪聪', 8.00000000, '事假', '个人家里有事，需要处理', '', '审批通过', '2020-09-15 08:30:00', '2020-09-15 18:00:00', '2020-09-15 11:23:10', 1, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (347, '', '冯聪聪', 8.00000000, '事假', '个人有事，需要去修理电瓶车', '', '审批通过', '2020-09-03 08:30:00', '2020-09-03 18:00:00', '2020-09-03 11:39:52', 1, '2021-05-04 08:45:13', '2021-05-04 08:45:13');
INSERT INTO `holidays` VALUES (348, '', '威廉', 10.00000000, '事假', '去参加阿里巴巴DING峰会，了解移动智能办公，为团队赋能。\n注：这是系统为你创建的体验单，试试点击同意感受快速审批！', '', '审批未通过', '2019-02-17 08:00:00', '2019-02-17 18:00:00', '2019-02-17 19:14:10', 1, '2021-05-04 08:45:13', '2021-05-04 08:45:13');

-- ----------------------------
-- Table structure for messages
-- ----------------------------
DROP TABLE IF EXISTS `messages`;
CREATE TABLE `messages`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL DEFAULT 0 COMMENT '用户id',
  `target` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '发送地址',
  `content` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '发送内容',
  `code` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '验证码',
  `ip` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT 'ip',
  `type` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '发送类型,如注册,找回密码',
  `is_use` tinyint(1) NOT NULL DEFAULT 0 COMMENT '是否使用',
  `created_at` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP(0) COMMENT '创建时间',
  `updated_at` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP(0) COMMENT '更新时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 12 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '短信发送记录' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of messages
-- ----------------------------
INSERT INTO `messages` VALUES (11, 0, '18063164161', '【213】验证码：786595，5分钟内有效,切勿告知他人！', '786595', '127.0.0.1', '1', 1, '2021-04-10 03:36:24', '2021-04-10 03:38:20');

-- ----------------------------
-- Table structure for migrations
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of migrations
-- ----------------------------
INSERT INTO `migrations` VALUES (1, '2014_10_12_000000_create_users_table', 1);
INSERT INTO `migrations` VALUES (2, '2014_10_12_100000_create_password_resets_table', 1);
INSERT INTO `migrations` VALUES (3, '2016_01_04_173148_create_admin_tables', 1);
INSERT INTO `migrations` VALUES (4, '2019_08_19_000000_create_failed_jobs_table', 1);

-- ----------------------------
-- Table structure for password_resets
-- ----------------------------
DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE `password_resets`  (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  INDEX `password_resets_email_index`(`email`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of password_resets
-- ----------------------------

-- ----------------------------
-- Table structure for posts
-- ----------------------------
DROP TABLE IF EXISTS `posts`;
CREATE TABLE `posts`  (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL DEFAULT 0 COMMENT '用户id',
  `cover_path` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '封面图',
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '标题',
  `content` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL COMMENT '内容',
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  `type` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `author` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '作者',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci COMMENT = '博客表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of posts
-- ----------------------------
INSERT INTO `posts` VALUES (2, 1, 'images/4a1c93fd97773eee171abe2843d8f1c4.jpg', '123123', '<table><tbody><tr><td colspan=\"2\"><form><label>换行<input></label></form></td></tr><tr><td></td><td><html>\r\n</td></tr><tr><td></td><td><meta http-equiv=\"Content-Type\" content=\"text/html; charset=gb2312\">\r\n</td></tr><tr><td></td><td><head>\r\n</td></tr><tr><td></td><td><title>朱自清《背影》- 现代散文</title>\r\n</td></tr><tr><td></td><td><link rel=stylesheet href=\"<a target=\"_blank\" href=\"http://www.ccview.net/cchtml.css\">../../../cchtml.css</a>\" type=\"text/css\">\r\n</td></tr><tr><td></td><td><script language=\"JavaScript\" src=\"<a target=\"_blank\" href=\"http://www.ccview.net/js/common.js\">../../../js/common.js</a>\"></script>\r\n</td></tr><tr><td></td><td></head>\r\n</td></tr><tr><td></td><td><body>\r\n</td></tr><tr><td></td><td><script language=\"javascript\">ccview_title(\"../../../picture/\")</script>\r\n</td></tr><tr><td></td><td><table align=\"center\" border=\"0\" width=\"476\">\r\n</td></tr><tr><td></td><td>    <tr>\r\n</td></tr><tr><td></td><td>        <td class=3dtitle><p align=\"center\" style=\"font-size=20pt;\">背影</p></td>\r\n</td></tr><tr><td></td><td>    </tr>\r\n</td></tr><tr><td></td><td>    <tr>\r\n</td></tr><tr><td></td><td>        <td><p align=\"center\"><font color=\"#000000\">作者: 朱自清</font></p></td>\r\n</td></tr><tr><td></td><td>    </tr>\r\n</td></tr><tr><td></td><td>    <tr>\r\n</td></tr><tr><td></td><td>        <td>　</td>\r\n</td></tr><tr><td></td><td>    </tr>\r\n</td></tr><tr><td></td><td>    <tr>\r\n</td></tr><tr><td></td><td>        <td>　　我与父亲不相见已二年余了，我最不能忘记的是他的背影。那年冬天，祖母死了，父亲的差使也交卸了，正是祸不单行的日子，我从北京到徐州，打算跟着父亲奔丧回家。到徐州见着父亲，看见满院狼藉的东西，又想起祖母，不禁簌簌地流下眼泪。父亲说，“事已如此，不必难过，好在天无绝人之路！”<br>\r\n</td></tr><tr><td></td><td>        　　回家变卖典质，父亲还了亏空；又借钱办了丧事。这些日子，家中光景很是惨淡，一半为了丧事，一半为了父亲赋闲。丧事完毕，父亲要到南京谋事，我也要回北京念书，我们便同行。<br>\r\n</td></tr><tr><td></td><td>        　　到南京时，有朋友约去游逛，勾留了一日；第二日上午便须渡江到浦口，下午上车北去。父亲因为事忙，本已说定不送我，叫旅馆里一个熟识的茶房陪我同去。他再三嘱咐茶房，甚是仔细。但他终于不放心，怕茶房不妥帖；颇踌躇了一会。其实我那年已二十岁，北京已来往过两三次，是没有甚么要紧的了。他踌躇了一会，终于决定还是自己送我去。我两三回劝他不必去；他只说，“不要紧，他们去不好！”<br>\r\n</td></tr><tr><td></td><td>        　　我们过了江，进了车站。我买票，他忙着照看行李。行李太多了，得向脚夫行些小费，才可过去。他便又忙着和他们讲价钱。我那时真是聪明过分，总觉他说话不大漂亮，非自己插嘴不可。但他终于讲定了价钱；就送我上车。他给我拣定了靠车门的一张椅子；我将他给我做的紫毛大衣铺好坐位。他嘱我路上小心，夜里警醒些，不要受凉。又嘱托茶房好好照应我。我心里暗笑他的迂；他们只认得钱，托他们直是白托！而且我这样大年纪的人，难道还不能料理自己么？唉，我现在想想，那时真是太聪明了！<br>\r\n</td></tr><tr><td></td><td>        　　我说道，“爸爸，你走吧。”他望车外看了看，说，“我买几个橘子去。你就在此地，不要走动。”我看那边月台的栅栏外有几个卖东西的等着顾客。走到那边月台，须穿过铁道，须跳下去又爬上去。父亲是一个胖子，走过去自然要费事些。我本来要去的，他不肯，只好让他去。我看见他戴着黑布小帽，穿着黑布大马褂，深青布棉袍，蹒跚地走到铁道边，慢慢探身下去，尚不大难。可是他穿过铁道，要爬上那边月台，就不容易了。他用两手攀着上面，两脚再向上缩；他肥胖的身子向左微倾，显出努力的样子。这时我看见他的背影，我的泪很快地流下来了。我赶紧拭干了泪，怕他看见，也怕别人看见。我再向外看时，他已抱了朱红的橘子望回走了。过铁道时，他先将橘子散放在地上，自己慢慢爬下，再抱起橘子走。到这边时，我赶紧去搀他。他和我走到车上，将橘子一股脑儿放在我的皮大衣上。于是扑扑衣上的泥土，心里很轻松似的，过一会说，“我走了；到那边来信！”我望着他走出去。他走了几步，回过头看见我，说，“进去吧，里边没人。”等他的背影混入来来往往的人里，再找不着了，我便进来坐下，我的眼泪又来了。<br>\r\n</td></tr><tr><td></td><td>        　　近几年来，父亲和我都是东奔西走，家中光景是一日不如一日。他少年出外谋生，独力支持，做了许多大事。那知老境却如此颓唐！他触目伤怀，自然情不能自已。情郁于中，自然要发之于外；家庭琐屑便往往触他之怒。他待我渐渐不同往日。但最近两年的不见，他终于忘却我的不好，只是惦记着我，惦记着我的儿子。我北来后，他写了一信给我，信中说道，“我身体平安，惟膀子疼痛利害，举箸提笔，诸多不便，大约大去之期不远矣。”我读到此处，在晶莹的泪光中，又看见那肥胖的，青布棉袍，黑布马褂的背影。唉！我不知何时再能与他相见！<br>\r\n</td></tr><tr><td></td><td>        　</td>\r\n</td></tr><tr><td></td><td>    </tr>\r\n</td></tr><tr><td></td><td>    <tr>\r\n</td></tr><tr><td></td><td>        <td><p style=\"font-size=9pt; color:#808080; line-height:13pt;\">　　1925年10月在北京。<br>\r\n</td></tr><tr><td></td><td>        　</p></td>\r\n</td></tr><tr><td></td><td>    </tr>\r\n</td></tr><tr><td></td><td></table>\r\n</td></tr><tr><td></td><td><script language=\"javascript\">ccview_bottom()</script>\r\n</td></tr><tr><td></td><td></body>\r\n</td></tr><tr><td></td><td></html>\r\n</td></tr><tr><td></td><td></td></tr></tbody></table>', '2021-05-20 07:15:45', '2021-05-20 08:13:05', 'science', '');

-- ----------------------------
-- Table structure for user_recommend_relation
-- ----------------------------
DROP TABLE IF EXISTS `user_recommend_relation`;
CREATE TABLE `user_recommend_relation`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NULL DEFAULT NULL COMMENT '用户ID',
  `parent_id` int(11) NULL DEFAULT NULL COMMENT '上级ID',
  `layer` int(11) NULL DEFAULT NULL COMMENT '层数',
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci COMMENT = '用户推荐关系表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of user_recommend_relation
-- ----------------------------

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users`  (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `username` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '用户名',
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '密码',
  `pay_password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT '' COMMENT '支付密码',
  `email` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '电子邮箱',
  `mobile` varchar(11) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '手机号',
  `is_disabled` tinyint(1) UNSIGNED NOT NULL DEFAULT 0 COMMENT '是否禁用',
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL COMMENT '简介',
  `invite_code` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '邀请码',
  `parent_id` int(11) NOT NULL DEFAULT 0 COMMENT '上级id',
  `last_token` varchar(600) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '最后一次登录的token',
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci COMMENT = '用户表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES (2, 'test', '$2y$10$240ceDc29F8GkRf1qHh9e.hz5tLdm84L1DDxZ5yZlPOyrHbb5SGOC', '', '', '', 0, NULL, '', 0, '', '2021-05-20 06:58:10', '2021-05-20 06:58:10');

SET FOREIGN_KEY_CHECKS = 1;
