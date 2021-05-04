DROP TABLE IF EXISTS `users`;
CREATE TABLE `users`  (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `username` varchar(50) not null default '' comment '用户名',
  `password`  varchar(255) not null default '' comment '密码',
  `pay_password`  null default null comment '支付密码',
  `email` varchar(50) NOT NULL DEFAULT '' COMMENT '电子邮箱',
  `mobile` varchar(11) NOT NULL DEFAULT '' COMMENT '手机号',
  `is_disabled` tinyint(1)  unsigned not null default 0 comment '是否禁用',
  `description` text null comment '简介',
  `invite_code` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '邀请码',
  `parent_id` int(11) NOT NULL DEFAULT 0 COMMENT '上级id',
  `last_token` varchar (600)  null default null comment '最后一次登录的token',
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic comment='用户表';

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



DROP TABLE IF EXISTS `posts`;
CREATE TABLE `posts`  (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int(11) not null default 0 comment '用户id',
  `cover_path` varchar (255) null comment '封面图',
  `title`  varchar (255) null comment '标题',
  `content` text  null comment '内容',
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic comment='博客表';


DROP TABLE IF EXISTS `comments`;
CREATE TABLE `comments`  (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int(11) not null default 0 comment '用户id',
  `post_id`  int(11) not null default 0   null comment '博客id',
  `content` text  null comment '内容',
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic comment='评论表';



DROP TABLE IF EXISTS `advert_categories`;
CREATE TABLE `advert_categories`  (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar (50) not null default '' comment '广告分类名称',
  `width` int(11) not null default 0 comment '图片宽度',
  `height` int(11) not null default 0 comment '图片高度',
  `identifying` varchar(50) not null default '' comment '广告分类标识',
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic comment =  '广告分类';


DROP TABLE IF EXISTS `adverts`;
CREATE TABLE `adverts`  (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `category_id` int(11) not null default 0 comment '广告分类id',
  `name` varchar (50) not null default '' comment '广告名称',
  `identifying` varchar (50) not null default '' comment '广告标识或链接',
  `image_path` varchar(255) not null default '' comment '图片路径',
  `sort` int(11) not null default 0 comment '',
  `is_disabled` tinyint(1) not null default 0 comment '是否禁用',
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic comment =  '广告';


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
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci COMMENT = '实名认证' ROW_FORMAT = Dynamic;

create index user_idx on certifications(user_id);


DROP TABLE IF EXISTS `announcements`;
CREATE TABLE `announcements`  (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar (50) not null default '' comment '公告标题',
  `content` text  null comment '公告内容',
  `sort` int(11) not null default 0 comment '',
  `is_disabled` tinyint(1) not null default 0 comment '是否禁用',
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic comment =  '公告';




DROP TABLE IF EXISTS `messages`;
CREATE TABLE `messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id`  int(11) not null default 0 comment '用户id',
  `target`  varchar (20) not null  default '' comment '发送地址',
  `content`  varchar (255)not null default '' comment '发送内容',
  `code`  varchar (20) not null default '' comment '验证码',
  `ip`  varchar (20) not null default '' comment 'ip',
  `type` varchar (20) not null default '' comment '发送类型,如注册,找回密码',
  `is_use` tinyint(1) not null default 0 comment '是否使用',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '更新时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='短信发送记录';




DROP TABLE IF EXISTS `document_categories`;
CREATE TABLE `document_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title`  varchar (50) not null  default '' comment '分类标题',
  `parent_id`  int(11) not null default 0 comment '父级id',
  `sort`  int(11) not null default 0 comment '',

  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '更新时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='文档分类';



DROP TABLE IF EXISTS `documents`;
CREATE TABLE `documents` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar (50) not null default '' comment '文档标题',
  `identify` varchar (50) not null default '' comment '文档标识符',
  `category_id` int (11) not null default 0 comment '分类id',
  `content` text  null comment '文档内容',
  `sort` int(11) not null default 0 comment '',
  `is_disabled` tinyint(1) not null default 0 comment '是否禁用',
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='文档表';



DROP TABLE IF EXISTS `app_versions`;
CREATE TABLE `app_versions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `version`  varchar (20) not null default '' comment '版本号',
  `title`  varchar (50) not null  default '' comment '升级标题',
  `description`  varchar (255) null default null comment '升级描述',
  `download_url` varchar (255)not null default '' comment '下载链接',
  `client_type` tinyint(1) not null default 0 comment '0 安卓,1 ios',
  `upgrade_type` tinyint(1) not null default 0 comment '2强制升级 1提醒升级  0不提醒升级',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '更新时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='app版本升级';

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
) ENGINE = InnoDB AUTO_INCREMENT = 26 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '系统配置表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of configs
-- ----------------------------
INSERT INTO `configs` VALUES (11, 'site', 'site_name', '213', '2021-01-21 11:30:30', '2021-01-21 11:30:30', NULL);
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
