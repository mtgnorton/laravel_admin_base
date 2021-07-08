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
