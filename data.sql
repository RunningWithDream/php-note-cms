CREATE TABLE user (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='表';


CREATE TABLE news (
  `news_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL DEFAULT '' COMMENT '标题',
  `sub` varchar(50) NOT NULL DEFAULT '' COMMENT '描述',
  `content` text COMMENT '内容',
  `author` varchar(20) NOT NULL DEFAULT '' COMMENT '',
  `create_time` int(11) unsigned NULL DEFAULT NULL COMMENT '',
  `update_time` int(11) unsigned NULL DEFAULT NULL COMMENT '',
  `delete_time` int(11) unsigned NULL DEFAULT NULL COMMENT '',
  PRIMARY KEY (`news_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='新闻表';

CREATE TABLE category (
  `category_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL DEFAULT '' COMMENT '',
  `create_time` int(11) unsigned NULL DEFAULT NULL COMMENT '',
  `update_time` int(11) unsigned NULL DEFAULT NULL COMMENT '',
  `delete_time` int(11) unsigned NULL DEFAULT NULL COMMENT '',
  PRIMARY KEY (`category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='新闻分类';

CREATE TABLE news_category (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `news_id` int(10) unsigned NOT NULL DEFAULT 0 COMMENT '新闻索引',
  `category_id` int(10) unsigned NOT NULL DEFAULT 0 COMMENT '分类索引',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='新闻分类表';