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


# 权限管理
CREATE TABLE IF NOT EXISTS `rbac_auth` (
  `node_id` INT(11) NOT NULL COMMENT '节点ID',
  `role_id` INT(11) NOT NULL COMMENT '角色ID',
  UNIQUE KEY `nid_rid` (`node_id`,`role_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='角色与节点对应表';

CREATE TABLE IF NOT EXISTS `rbac_menu` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `title` VARCHAR(30) NOT NULL COMMENT '导航名称',
  `node_id` INT(11) DEFAULT NULL COMMENT '节点ID',
  `p_id` INT(11) DEFAULT NULL COMMENT '导航父id',
  `sort` INT(11) NOT NULL DEFAULT '0' COMMENT '排序',
  `status` INT(11) DEFAULT '1' COMMENT '状态(1:正常,0:停用)',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='菜单表' AUTO_INCREMENT=20 ;

CREATE TABLE IF NOT EXISTS `rbac_node` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `dirc` VARCHAR(20) NOT NULL COMMENT '目录',
  `cont` VARCHAR(30) NOT NULL COMMENT '控制器',
  `func` VARCHAR(30) NOT NULL COMMENT '方法',
  `memo` VARCHAR(25) DEFAULT NULL COMMENT '备注',
  `status` INT(11) NOT NULL DEFAULT '1' COMMENT '状态(1:正常,0:停用)',
  PRIMARY KEY (`id`),
  UNIQUE KEY `d_c_f` (`dirc`,`cont`,`func`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='节点表' AUTO_INCREMENT=24 ;

CREATE TABLE IF NOT EXISTS `rbac_role` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `rolename` VARCHAR(25) NOT NULL COMMENT '角色名',
  `desc` VARCHAR(100) NOT NULL COMMENT '角色描述',
  `status` INT(11) NOT NULL DEFAULT '1' COMMENT '状态(1:正常,0停用)',
  `create_time` int(11) unsigned NULL DEFAULT NULL COMMENT '',
  `update_time` int(11) unsigned NULL DEFAULT NULL COMMENT '',
  `delete_time` int(11) unsigned NULL DEFAULT NULL COMMENT '',
  PRIMARY KEY (`id`),
  UNIQUE KEY `rolename` (`rolename`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='角色表' AUTO_INCREMENT=0 ;

CREATE TABLE IF NOT EXISTS `rbac_user` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `username` VARCHAR(20) NOT NULL COMMENT '用户名',
  `phone` VARCHAR(11) NOT NULL COMMENT '手机',
  `password` VARCHAR(32) NOT NULL COMMENT '密码',
  `nickname` VARCHAR(20) NOT NULL COMMENT '昵称',
  `email` VARCHAR(25) NOT NULL COMMENT 'Email',
  `role_id` INT(11) DEFAULT NULL COMMENT '角色ID',
  `status` INT(11) NOT NULL DEFAULT '1' COMMENT '状态(1:正常,0:停用)',
  `create_time` int(11) unsigned NULL DEFAULT NULL COMMENT '',
  `update_time` int(11) unsigned NULL DEFAULT NULL COMMENT '',
  `delete_time` int(11) unsigned NULL DEFAULT NULL COMMENT '',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `phone` (`phone`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='用户表' AUTO_INCREMENT=6 ;

