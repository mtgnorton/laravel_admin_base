DROP TABLE IF EXISTS `users`;
CREATE TABLE `users`  (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `username` varchar(50) not null default '' comment '用户名',
  `password`  varchar(255) not null default '' comment '密码',
  `pay_password`  varchar(255) not null default '' comment '支付密码',
  `email` varchar(50) NOT NULL DEFAULT '' COMMENT '电子邮箱',
  `mobile` varchar(11) NOT NULL DEFAULT '' COMMENT '手机号',
  `is_disabled` tinyint(1)  unsigned not null default 0 comment '是否禁用',
  `description` text null comment '简介',
  `last_token` varchar (600)  null default null comment '最后一次登录的token',
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic comment='用户表';


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

