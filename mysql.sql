CREATE TABLE `goods` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '数据库ID',
  `cat_id` int(11) unsigned NOT NULL COMMENT '分类ID',
  `title` varchar(255) NOT NULL COMMENT '商品标题',
  `short_title` varchar(100) DEFAULT NULL COMMENT '商品短标题',
  `price` float(10,2) NOT NULL DEFAULT '0.00' COMMENT '价格',
  `sale_price` float(10,2) NOT NULL DEFAULT '0.00' COMMENT '原价',
  `quantity` int(11) NOT NULL DEFAULT '0' COMMENT '购买数量',
  `start_time` int(11) NOT NULL DEFAULT '0' COMMENT '开始时间',
  `end_time` int(11) NOT NULL DEFAULT '0' COMMENT '结束时间',
  `url` varchar(255) NOT NULL COMMENT '淘宝客URL',
  `shop_url` varchar(255) NOT NULL COMMENT '商家URL',
  `add_time` int(11) NOT NULL DEFAULT '0' COMMENT '商品入库时间',
  `image_url` varchar(255) DEFAULT NULL COMMENT '图片地址',
  `tb_id` varchar(20) NOT NULL COMMENT '淘宝ID',
  `shop_name` varchar(100) DEFAULT NULL COMMENT '店铺名称',
  `commission` float(10,2) NOT NULL COMMENT '佣金',
  `commission_rate` float NOT NULL DEFAULT '0' COMMENT '佣金率',
  `sort` tinyint(2) NOT NULL COMMENT '排序',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8

CREATE TABLE `category` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `app_id` int(11) unsigned NOT NULL,
  `name` varchar(255) NOT NULL,
  `listorder` tinyint(3) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8
