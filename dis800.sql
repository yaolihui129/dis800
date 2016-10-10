-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2015 年 05 月 08 日 14:26
-- 服务器版本: 5.6.12-log
-- PHP 版本: 5.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `dis800`
--
CREATE DATABASE IF NOT EXISTS `dis800` DEFAULT CHARACTER SET utf8 COLLATE utf8_bin;
USE `dis800`;

-- --------------------------------------------------------

--
-- 表的结构 `dis_address`
--

CREATE TABLE IF NOT EXISTS `dis_address` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL COMMENT '用户ID',
  `address` varchar(255) COLLATE utf8_bin NOT NULL COMMENT '收货地址',
  `tel` varchar(11) COLLATE utf8_bin NOT NULL COMMENT '收货电话',
  `name` varchar(50) COLLATE utf8_bin NOT NULL COMMENT '收货人',
  `postcode` varchar(10) COLLATE utf8_bin NOT NULL COMMENT '邮编',
  `defaultadd` tinyint(4) NOT NULL DEFAULT '0',
  `email` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=6 ;

-- --------------------------------------------------------

--
-- 表的结构 `dis_administrator`
--

CREATE TABLE IF NOT EXISTS `dis_administrator` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user` varchar(100) COLLATE utf8_bin NOT NULL,
  `password` varchar(32) COLLATE utf8_bin NOT NULL,
  `limit1` varchar(20) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `dis_administrator`
--

INSERT INTO `dis_administrator` (`id`, `user`, `password`, `limit1`) VALUES
(1, '12', '515a8b95b642fe65566597754a2cbae2', '1');

-- --------------------------------------------------------

--
-- 表的结构 `dis_blogroll`
--

CREATE TABLE IF NOT EXISTS `dis_blogroll` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `url` varchar(255) COLLATE utf8_bin NOT NULL,
  `describe` varchar(255) CHARACTER SET utf8 NOT NULL,
  `recycle` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '1',
  `type` int(11) NOT NULL DEFAULT '1' COMMENT '1B2C  2门户 3其他',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=65 ;

--
-- 转存表中的数据 `dis_blogroll`
--

INSERT INTO `dis_blogroll` (`id`, `url`, `describe`, `recycle`, `type`) VALUES
(50, 'www.baidu.com', '百度娱乐', '0', 1),
(51, 'www.zixue.com', '搜狐娱乐', '0', 1),
(52, 'www.baidu.com', '百度乐娱', '1', 1),
(53, 'www.baidu.com', '百度娱乐', '1', 1),
(54, 'www.sohu.com', '个电饭锅电饭锅', '0', 1),
(55, 'www.sohu.com', '搜狐视频', '0', 1),
(57, '3333', '333', '0', 1),
(58, '222', '222', '1', 1),
(59, '222', '222', '0', 1),
(60, '545', '广告费', '1', 2),
(61, '3432', '432432', '0', 1),
(62, '555', '55', '1', 1),
(63, 'www.123com', '百度', '1', 2),
(64, 'www.123com', '百度123', '0', 3);

-- --------------------------------------------------------

--
-- 表的结构 `dis_brand`
--

CREATE TABLE IF NOT EXISTS `dis_brand` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `brand` varchar(50) COLLATE utf8_bin NOT NULL COMMENT '品牌名',
  `pic` varchar(100) COLLATE utf8_bin NOT NULL COMMENT '图片',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=13 ;

--
-- 转存表中的数据 `dis_brand`
--

INSERT INTO `dis_brand` (`id`, `brand`, `pic`) VALUES
(8, '森马', '/Admin/uploads/brand/2015-05-08/554ca0db7627e.jpg'),
(9, '秋水伊人', '/Admin/uploads/brand/2015-05-08/554ca0e974555.jpg'),
(10, '大嘴猴', '/Admin/uploads/brand/2015-05-08/554ca0f7e58e6.jpg'),
(11, '无印良品', '/Admin/uploads/brand/2015-05-08/554ca119be8f9.jpg'),
(12, '香奈儿', '/Admin/uploads/brand/2015-05-08/554ca126e599f.jpg');

-- --------------------------------------------------------

--
-- 表的结构 `dis_cart`
--

CREATE TABLE IF NOT EXISTS `dis_cart` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `gid` int(11) NOT NULL COMMENT '商品id',
  `uid` int(11) NOT NULL COMMENT '用户id',
  `number` int(11) NOT NULL COMMENT '数量',
  `totalprice` binary(10) NOT NULL COMMENT '总价',
  `cartpic` varchar(150) COLLATE utf8_bin NOT NULL,
  `gname` varchar(50) COLLATE utf8_bin NOT NULL,
  `gsize` varchar(100) COLLATE utf8_bin NOT NULL,
  `gmoney` binary(10) NOT NULL,
  `gcolor` varchar(50) COLLATE utf8_bin NOT NULL,
  `goodnumber` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `dis_chat`
--

CREATE TABLE IF NOT EXISTS `dis_chat` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `zid` int(11) NOT NULL,
  `content` varchar(255) COLLATE utf8_bin NOT NULL,
  `time` varchar(30) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=3 ;

--
-- 转存表中的数据 `dis_chat`
--

INSERT INTO `dis_chat` (`id`, `uid`, `zid`, `content`, `time`) VALUES
(1, 9, 0, 'we挼这', '2015-05-08 22:00:16'),
(2, 9, 1, 'wqqweqw  ', '2015-05-08 22:01:38');

-- --------------------------------------------------------

--
-- 表的结构 `dis_close`
--

CREATE TABLE IF NOT EXISTS `dis_close` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `close` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `dis_close`
--

INSERT INTO `dis_close` (`id`, `close`) VALUES
(1, 2);

-- --------------------------------------------------------

--
-- 表的结构 `dis_diss`
--

CREATE TABLE IF NOT EXISTS `dis_diss` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `gid` int(11) NOT NULL,
  `content` varchar(255) COLLATE utf8_bin NOT NULL COMMENT '评论内容',
  `time` varchar(11) COLLATE utf8_bin NOT NULL COMMENT '评论时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `dis_diss`
--

INSERT INTO `dis_diss` (`id`, `uid`, `gid`, `content`, `time`) VALUES
(1, 9, 17, 'hsadhad\r\n					', '1431093889');

-- --------------------------------------------------------

--
-- 表的结构 `dis_draw`
--

CREATE TABLE IF NOT EXISTS `dis_draw` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uname` varchar(255) COLLATE utf8_bin NOT NULL,
  `uid` int(11) NOT NULL,
  `award` varchar(255) COLLATE utf8_bin NOT NULL,
  `time` varchar(255) COLLATE utf8_bin NOT NULL,
  `number` varchar(255) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- 表的结构 `dis_favorite`
--

CREATE TABLE IF NOT EXISTS `dis_favorite` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `gid` int(11) NOT NULL,
  `time` varchar(11) COLLATE utf8_bin NOT NULL COMMENT '收藏时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=30 ;

--
-- 转存表中的数据 `dis_favorite`
--

INSERT INTO `dis_favorite` (`id`, `uid`, `gid`, `time`) VALUES
(22, 34545, 45365, '1430069407'),
(28, 345, 2147483647, '1430280125');

-- --------------------------------------------------------

--
-- 表的结构 `dis_goods`
--

CREATE TABLE IF NOT EXISTS `dis_goods` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pid` int(11) NOT NULL,
  `bid` int(11) NOT NULL COMMENT '品牌id',
  `name` varchar(50) COLLATE utf8_bin NOT NULL COMMENT '商品名',
  `soldnum` int(11) NOT NULL COMMENT '销售量',
  `clicknum` int(11) NOT NULL COMMENT '点击量',
  `addtime` varchar(11) COLLATE utf8_bin NOT NULL COMMENT '添加时间',
  `state` tinyint(4) NOT NULL COMMENT '状态',
  `pic` varchar(100) COLLATE utf8_bin NOT NULL COMMENT '图片',
  `material` varchar(50) COLLATE utf8_bin NOT NULL COMMENT '材料',
  `detail` varchar(255) COLLATE utf8_bin NOT NULL COMMENT '详情',
  `pname` varchar(50) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=22 ;

--
-- 转存表中的数据 `dis_goods`
--

INSERT INTO `dis_goods` (`id`, `pid`, `bid`, `name`, `soldnum`, `clicknum`, `addtime`, `state`, `pic`, `material`, `detail`, `pname`) VALUES
(9, 13, 8, '森马衬衣', 0, 2, '1431086455', 1, '/Admin/uploads/goods/2015-05-08/554ca577dac85.jpg', '纯棉', '青春、时尚版', '衬衣'),
(10, 11, 9, '连衣裙', 0, 3, '1431087121', 2, '/Admin/uploads/goods/2015-05-08/554ca811128df.jpg', '蕾丝衣', '韩版修身', '裙子'),
(11, 12, 12, '香奈儿衬衣', 0, 2, '1431087626', 1, '/Admin/uploads/goods/2015-05-08/554caa0aca830.jpg', '亚麻', '时尚修身版', '上衣'),
(13, 14, 8, '情侣短裤', 0, 1, '1431088224', 2, '/Admin/uploads/goods/2015-05-08/554cac60c0047.jpg', '纯棉', '韩版修身', '裤子'),
(14, 17, 11, '全友家居', 0, 2, '1431088571', 1, '/Admin/uploads/goods/2015-05-08/554cadbb049ed.jpg', '纯棉，真皮', '时尚，小型户', '沙发'),
(15, 18, 11, '全友家居', 0, 1, '1431088953', 1, '/Admin/uploads/goods/2015-05-08/554caf39690b5.jpg', '实木', '现代简约', '衣柜'),
(16, 20, 10, '贝亲', 0, 3, '1431089280', 1, '/Admin/uploads/goods/2015-05-08/554cb0800560a.jpg', '婴儿硅胶奶嘴 ', '0~3个月', '奶嘴'),
(17, 11, 9, '半身裙', 0, 2, '1431089843', 2, '/Admin/uploads/goods/2015-05-08/554cb2b31edae.jpg', '欧根纱', '自然腰', '裙子'),
(18, 12, 10, '半袖衣', 0, 2, '1431090207', 2, '/Admin/uploads/goods/2015-05-08/554cb41ff05dc.jpg', '纯棉', '胖MM专有', '上衣'),
(19, 14, 11, '男士长裤', 0, 0, '1431091043', 2, '/Admin/uploads/goods/2015-05-08/554cb7637038b.jpg', '棉麻', '透气性好', '裤子'),
(20, 14, 8, '短裤', 0, 0, '1431091439', 2, '/Admin/uploads/goods/2015-05-08/554cb8ef0938a.jpg', '牛仔', '含棉量高', '裤子'),
(21, 12, 9, '外套', 0, 1, '1431091876', 3, '/Admin/uploads/goods/2015-05-08/554cbaa438578.jpg', '纱布', '五分袖', '上衣');

-- --------------------------------------------------------

--
-- 表的结构 `dis_goodsclass`
--

CREATE TABLE IF NOT EXISTS `dis_goodsclass` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pid` int(11) NOT NULL COMMENT '父类id',
  `path` varchar(255) COLLATE utf8_bin NOT NULL COMMENT '路径',
  `name` varchar(50) COLLATE utf8_bin NOT NULL COMMENT '类别名',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=46 ;

--
-- 转存表中的数据 `dis_goodsclass`
--

INSERT INTO `dis_goodsclass` (`id`, `pid`, `path`, `name`) VALUES
(8, 0, '0,', '服装'),
(9, 8, '0,8,', '女装'),
(10, 8, '0,8,', '男装'),
(11, 9, '0,8,9,', '裙子'),
(12, 9, '0,8,9,', '上衣'),
(13, 10, '0,8,10,', '衬衣'),
(14, 10, '0,8,10,', '裤子'),
(15, 0, '0,', '居家'),
(16, 15, '0,15,', '家具'),
(17, 16, '0,15,16,', '沙发'),
(18, 16, '0,15,16,', '衣柜'),
(19, 15, '0,15,', '母婴'),
(20, 19, '0,15,19,', '奶嘴'),
(21, 19, '0,15,19,', '奶粉'),
(22, 0, '0,', '奢侈'),
(23, 22, '0,22,', '名鞋'),
(24, 23, '0,22,23,', '恨天高'),
(25, 23, '0,22,23,', '坡鞋'),
(26, 22, '0,22,', '名表'),
(27, 26, '0,22,26,', 'CK手表'),
(28, 26, '0,22,26,', '天王'),
(29, 0, '0,', '休闲'),
(30, 29, '0,29,', '饮品'),
(31, 30, '0,29,30,', 'Coffee'),
(32, 30, '0,29,30,', '茶酒'),
(33, 29, '0,29,', '音乐'),
(34, 33, '0,29,33,', '耳机'),
(35, 33, '0,29,33,', '低音炮'),
(36, 0, '0,', '运动'),
(37, 36, '0,36,', '装备'),
(38, 37, '0,36,37,', '护膝'),
(39, 37, '0,36,37,', '水壶'),
(40, 36, '0,36,', '球类'),
(41, 40, '0,36,40,', '篮球'),
(42, 40, '0,36,40,', '足球'),
(43, 36, '0,36,', '眼镜'),
(44, 43, '0,36,43,', '兰奇'),
(45, 43, '0,36,43,', '梦豇');

-- --------------------------------------------------------

--
-- 表的结构 `dis_goodsinfo`
--

CREATE TABLE IF NOT EXISTS `dis_goodsinfo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `gid` int(11) NOT NULL COMMENT '商品id',
  `sid` int(11) NOT NULL COMMENT '尺寸id',
  `cid` int(11) NOT NULL COMMENT '颜色id',
  `price` binary(10) NOT NULL COMMENT '价格',
  `number` int(11) NOT NULL COMMENT '库存',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=52 ;

--
-- 转存表中的数据 `dis_goodsinfo`
--

INSERT INTO `dis_goodsinfo` (`id`, `gid`, `sid`, `cid`, `price`, `number`) VALUES
(22, 9, 22, 22, '200\0\0\0\0\0\0\0', 20),
(23, 9, 23, 23, '500\0\0\0\0\0\0\0', 70),
(24, 10, 24, 24, '100\0\0\0\0\0\0\0', 30),
(25, 10, 25, 25, '250\0\0\0\0\0\0\0', 30),
(26, 11, 26, 26, '200\0\0\0\0\0\0\0', 20),
(27, 11, 27, 27, '300\0\0\0\0\0\0\0', 40),
(28, 13, 28, 28, '100\0\0\0\0\0\0\0', 50),
(29, 13, 29, 29, '100\0\0\0\0\0\0\0', 50),
(30, 13, 30, 30, '200\0\0\0\0\0\0\0', 50),
(31, 14, 31, 31, '2500\0\0\0\0\0\0', 70),
(32, 14, 32, 32, '3500\0\0\0\0\0\0', 30),
(33, 15, 33, 33, '1500\0\0\0\0\0\0', 40),
(34, 15, 34, 34, '2500\0\0\0\0\0\0', 50),
(35, 16, 35, 35, '15\0\0\0\0\0\0\0\0', 50),
(36, 16, 36, 36, '30\0\0\0\0\0\0\0\0', 70),
(37, 17, 37, 37, '567\0\0\0\0\0\0\0', 50),
(38, 17, 38, 38, '589\0\0\0\0\0\0\0', 80),
(39, 17, 39, 39, '789\0\0\0\0\0\0\0', 79),
(40, 18, 40, 40, '999\0\0\0\0\0\0\0', 100),
(41, 18, 41, 41, '999\0\0\0\0\0\0\0', 100),
(42, 18, 42, 42, '888\0\0\0\0\0\0\0', 90),
(43, 18, 43, 43, '777\0\0\0\0\0\0\0', 1000),
(44, 19, 44, 44, '800\0\0\0\0\0\0\0', 100),
(45, 19, 45, 45, '600\0\0\0\0\0\0\0', 34),
(46, 19, 46, 46, '560\0\0\0\0\0\0\0', 56),
(47, 20, 47, 47, '45\0\0\0\0\0\0\0\0', 89),
(48, 20, 48, 48, '89\0\0\0\0\0\0\0\0', 67),
(49, 20, 49, 49, '99\0\0\0\0\0\0\0\0', 67),
(50, 21, 50, 50, '199\0\0\0\0\0\0\0', 45),
(51, 21, 51, 51, '200\0\0\0\0\0\0\0', 45);

-- --------------------------------------------------------

--
-- 表的结构 `dis_goodspic`
--

CREATE TABLE IF NOT EXISTS `dis_goodspic` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pic` varchar(100) COLLATE utf8_bin NOT NULL COMMENT '图片',
  `gid` int(11) NOT NULL COMMENT '商品详情id',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=49 ;

--
-- 转存表中的数据 `dis_goodspic`
--

INSERT INTO `dis_goodspic` (`id`, `pic`, `gid`) VALUES
(10, '/Admin/uploads/goods/2015-05-08/554ca59a3adc9.jpg', 9),
(11, '/Admin/uploads/goods/2015-05-08/554ca59a58678.jpg', 9),
(12, '/Admin/uploads/goods/2015-05-08/554ca5cf382f0.jpg', 9),
(13, '/Admin/uploads/goods/2015-05-08/554ca5cf553cf.jpg', 9),
(14, '/Admin/uploads/goods/2015-05-08/554ca837e1e26.jpg', 10),
(15, '/Admin/uploads/goods/2015-05-08/554ca838000e2.jpg', 10),
(16, '/Admin/uploads/goods/2015-05-08/554ca8388a7da.jpg', 10),
(17, '/Admin/uploads/goods/2015-05-08/554ca8526e345.jpg', 10),
(18, '/Admin/uploads/goods/2015-05-08/554ca8527f8a1.jpg', 10),
(19, '/Admin/uploads/goods/2015-05-08/554caa27b6105.jpg', 11),
(20, '/Admin/uploads/goods/2015-05-08/554caa40745a4.jpg', 11),
(21, '/Admin/uploads/goods/2015-05-08/554caa4093f1f.jpg', 11),
(22, '/Admin/uploads/goods/2015-05-08/554cac800edd2.jpg', 13),
(23, '/Admin/uploads/goods/2015-05-08/554cac800edd2.jpg', 13),
(24, '/Admin/uploads/goods/2015-05-08/554cac9a8c4ad.jpg', 13),
(25, '/Admin/uploads/goods/2015-05-08/554cadf9ccf58.jpg', 14),
(26, '/Admin/uploads/goods/2015-05-08/554cae10242cd.jpg', 14),
(27, '/Admin/uploads/goods/2015-05-08/554caf5d7e7fb.jpg', 15),
(28, '/Admin/uploads/goods/2015-05-08/554caf763abbf.jpg', 15),
(29, '/Admin/uploads/goods/2015-05-08/554cb09cb3d9c.jpg', 16),
(30, '/Admin/uploads/goods/2015-05-08/554cb0e5c161f.jpg', 16),
(31, '/Admin/uploads/goods/2015-05-08/554cb2d22168d.jpg', 17),
(32, '/Admin/uploads/goods/2015-05-08/554cb327aefc2.jpg', 17),
(33, '/Admin/uploads/goods/2015-05-08/554cb35b362e1.jpg', 17),
(34, '/Admin/uploads/goods/2015-05-08/554cb35b54104.jpg', 17),
(35, '/Admin/uploads/goods/2015-05-08/554cb35bd7cdd.jpg', 17),
(36, '/Admin/uploads/goods/2015-05-08/554cb44fc9553.jpg', 18),
(37, '/Admin/uploads/goods/2015-05-08/554cb44fc9553.jpg', 18),
(38, '/Admin/uploads/goods/2015-05-08/554cb47375d8a.jpg', 18),
(39, '/Admin/uploads/goods/2015-05-08/554cb4935fcc9.jpg', 18),
(40, '/Admin/uploads/goods/2015-05-08/554cb7858f4b5.jpg', 19),
(41, '/Admin/uploads/goods/2015-05-08/554cb7b656520.jpg', 19),
(42, '/Admin/uploads/goods/2015-05-08/554cb7e29415a.jpg', 19),
(43, '/Admin/uploads/goods/2015-05-08/554cb90521f1a.jpg', 20),
(44, '/Admin/uploads/goods/2015-05-08/554cb9275b100.jpg', 20),
(45, '/Admin/uploads/goods/2015-05-08/554cb92e66643.jpg', 20),
(46, '/Admin/uploads/goods/2015-05-08/554cbac7a5f20.jpg', 21),
(47, '/Admin/uploads/goods/2015-05-08/554cbad59912e.jpg', 21),
(48, '/Admin/uploads/goods/2015-05-08/554cbaf3baa34.jpg', 21);

-- --------------------------------------------------------

--
-- 表的结构 `dis_infocolor`
--

CREATE TABLE IF NOT EXISTS `dis_infocolor` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `color` varchar(50) COLLATE utf8_bin NOT NULL COMMENT '颜色',
  `gid` int(11) NOT NULL COMMENT '商品详情id',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=52 ;

--
-- 转存表中的数据 `dis_infocolor`
--

INSERT INTO `dis_infocolor` (`id`, `color`, `gid`) VALUES
(22, '白色', 9),
(23, '黑色', 9),
(24, '白色', 10),
(25, '黑色', 10),
(26, '红色', 11),
(27, '白色', 11),
(28, '褐色', 13),
(29, '褐色', 13),
(30, '白色', 13),
(31, '咖啡色', 14),
(32, '米色', 14),
(33, '米色', 15),
(34, '白色', 15),
(35, '半透明', 16),
(36, '透明色', 16),
(37, '花色', 17),
(38, '碎花', 17),
(39, '浅花色', 17),
(40, '黑色', 18),
(41, '橘红', 18),
(42, '大红色', 18),
(43, '白色', 18),
(44, '白色', 19),
(45, '黑色', 19),
(46, '灰色', 19),
(47, '浅蓝', 20),
(48, '土黄', 20),
(49, '橘黄', 20),
(50, '浅粉色', 21),
(51, '白色', 21);

-- --------------------------------------------------------

--
-- 表的结构 `dis_information`
--

CREATE TABLE IF NOT EXISTS `dis_information` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `content` varchar(255) COLLATE utf8_bin NOT NULL,
  `time` varchar(11) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=149 ;

--
-- 转存表中的数据 `dis_information`
--

INSERT INTO `dis_information` (`id`, `uid`, `content`, `time`) VALUES
(113, 6, 'you ', '1430959573'),
(114, 7, 'you ', '1430959573'),
(115, 8, 'you ', '1430959573'),
(117, 5, 'wei', '1430959585'),
(118, 1, 'er', '1430967897'),
(119, 6, 'er', '1430967897'),
(120, 7, 'er', '1430967897'),
(121, 8, 'er', '1430967897'),
(123, 10, 'er', '1430967897'),
(124, 9, 'wqeqwe', '1430968131'),
(125, 1, 'sdfdsf', '1430968535'),
(126, 6, 'sdfdsf', '1430968535'),
(127, 7, 'sdfdsf', '1430968535'),
(128, 8, 'sdfdsf', '1430968535'),
(130, 10, 'sdfdsf', '1430968535'),
(133, 1, 'fghgfhgf', '1430968749'),
(134, 6, 'fghgfhgf', '1430968749'),
(135, 7, 'fghgfhgf', '1430968749'),
(136, 8, 'fghgfhgf', '1430968749'),
(138, 10, 'fghgfhgf', '1430968749'),
(139, 11, 'fghgfhgf', '1430968749'),
(140, 1, '有优惠 ', '1431092086'),
(141, 6, '有优惠 ', '1431092086'),
(142, 7, '有优惠 ', '1431092086'),
(143, 8, '有优惠 ', '1431092086'),
(144, 9, '有优惠 ', '1431092086'),
(145, 10, '有优惠 ', '1431092086'),
(146, 11, '有优惠 ', '1431092086'),
(147, 12, '有优惠 ', '1431092086'),
(148, 13, '有优惠 ', '1431092086');

-- --------------------------------------------------------

--
-- 表的结构 `dis_infosize`
--

CREATE TABLE IF NOT EXISTS `dis_infosize` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `size` varchar(50) COLLATE utf8_bin NOT NULL COMMENT '尺寸',
  `gid` int(11) NOT NULL COMMENT '商品详情id',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=52 ;

--
-- 转存表中的数据 `dis_infosize`
--

INSERT INTO `dis_infosize` (`id`, `size`, `gid`) VALUES
(22, 'xxl', 9),
(23, 'xxxl', 9),
(24, 'xL', 10),
(25, 'xxl', 10),
(26, 'xxl', 11),
(27, 'xl', 11),
(28, 'xl', 13),
(29, 'xl', 13),
(30, 'xxl', 13),
(31, '3M*1.2M', 14),
(32, '3M*1.2M', 14),
(33, '2M*3M', 15),
(34, '1.5M*3M', 15),
(35, '3~6个月', 16),
(36, '6~8个月', 16),
(37, 'S', 17),
(38, 'L', 17),
(39, 'XL', 17),
(40, 'L', 18),
(41, 'XL', 18),
(42, 'XXL', 18),
(43, 'XXXL', 18),
(44, 'L', 19),
(45, 'XL', 19),
(46, 'XXL', 19),
(47, 'L', 20),
(48, 'XL', 20),
(49, 'XXL', 20),
(50, 'S', 21),
(51, 'L', 21);

-- --------------------------------------------------------

--
-- 表的结构 `dis_order`
--

CREATE TABLE IF NOT EXISTS `dis_order` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL COMMENT '用户ID',
  `aid` int(11) NOT NULL COMMENT '地址id',
  `totalprice` binary(10) NOT NULL COMMENT '总价',
  `time` varchar(11) COLLATE utf8_bin NOT NULL COMMENT '下单时间',
  `static` tinyint(4) NOT NULL COMMENT '订单状态',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- 表的结构 `dis_orderinfo`
--

CREATE TABLE IF NOT EXISTS `dis_orderinfo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `oid` int(11) NOT NULL COMMENT '订单id',
  `gid` int(11) NOT NULL COMMENT '商品详情id',
  `price` binary(10) NOT NULL COMMENT '价格',
  `pic` varchar(255) COLLATE utf8_bin NOT NULL COMMENT '商品图片',
  `number` int(11) NOT NULL COMMENT '数量',
  `name` varchar(100) COLLATE utf8_bin NOT NULL,
  `color` varchar(50) COLLATE utf8_bin NOT NULL,
  `size` varchar(50) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `dis_orderinfo`
--

INSERT INTO `dis_orderinfo` (`id`, `oid`, `gid`, `price`, `pic`, `number`, `name`, `color`, `size`) VALUES
(1, 1, 17, '567\0\0\0\0\0\0\0', '/dis800/Public/Admin/uploads/goods/2015-05-08/554c', 50, '半身裙', '花色', 'S');

-- --------------------------------------------------------

--
-- 表的结构 `dis_ringpic`
--

CREATE TABLE IF NOT EXISTS `dis_ringpic` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pic` varchar(255) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=57 ;

--
-- 转存表中的数据 `dis_ringpic`
--

INSERT INTO `dis_ringpic` (`id`, `pic`) VALUES
(53, '/Uploads/ringpic/2015-05-06/5549635cf32b8.jpg'),
(54, '/Uploads/ringpic/2015-05-06/55496365ab06a.jpg'),
(55, '/Uploads/ringpic/2015-05-06/5549636ef1b65.jpg'),
(56, '/Uploads/ringpic/2015-05-06/55496374a99d9.jpg');

-- --------------------------------------------------------

--
-- 表的结构 `dis_user`
--

CREATE TABLE IF NOT EXISTS `dis_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ltime` varchar(11) COLLATE utf8_bin NOT NULL COMMENT '最后登录时间',
  `user` varchar(50) COLLATE utf8_bin NOT NULL COMMENT '用户名',
  `pass` char(32) COLLATE utf8_bin NOT NULL COMMENT '密码',
  `name` varchar(50) COLLATE utf8_bin NOT NULL COMMENT '真实姓名',
  `sex` tinyint(4) DEFAULT '0' COMMENT '性别 1男 0女',
  `age` tinyint(4) NOT NULL COMMENT '年龄',
  `qq` varchar(13) COLLATE utf8_bin NOT NULL COMMENT 'QQ',
  `tel` varchar(11) COLLATE utf8_bin NOT NULL COMMENT '电话',
  `time` varchar(11) COLLATE utf8_bin NOT NULL COMMENT '注册时间',
  `lever` tinyint(4) NOT NULL DEFAULT '1' COMMENT '等级 1',
  `limit` tinyint(4) NOT NULL DEFAULT '1' COMMENT '权限 1允许登陆2禁止',
  `mail` varchar(50) COLLATE utf8_bin NOT NULL COMMENT '邮箱',
  `pic` varchar(150) COLLATE utf8_bin NOT NULL,
  `issue` varchar(100) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=14 ;

--
-- 转存表中的数据 `dis_user`
--

INSERT INTO `dis_user` (`id`, `ltime`, `user`, `pass`, `name`, `sex`, `age`, `qq`, `tel`, `time`, `lever`, `limit`, `mail`, `pic`, `issue`) VALUES
(1, '', 'we', '12', 'de', 0, 12, '12232323', '12345678988', '', 1, 1, '', '', ''),
(6, '', '123', '123', '', 0, 0, '', '', '', 1, 1, '', '', ''),
(7, '', '123123', '4297f44b13955235245b2497399d7a93', '', 0, 0, '', '', '', 1, 1, '', '', ''),
(8, '1430508005', 'quzhikuan', 'quzhikuan', '', 0, 0, '', '', '', 1, 1, '', '', ''),
(9, '1431094719', '123qwe', '46f94c8de14fb36680850768ff1b7f2a', '', 0, 0, '', '', '', 1, 1, '', '', ''),
(10, '1430967845', '1234546', 'e10adc3949ba59abbe56e057f20f883e', '', 0, 0, '', '', '', 1, 1, '', '', ''),
(11, '1430968777', '123asd', 'e120ea280aa50693d5568d0071456460', '', 0, 0, '', '', '', 1, 1, '', '', ''),
(12, '1431075769', '123456', 'e10adc3949ba59abbe56e057f20f883e', '', 0, 0, '', '', '', 1, 1, '', '', ''),
(13, '1431075845', '1234567', 'e10adc3949ba59abbe56e057f20f883e', '', 0, 0, '', '', '', 1, 1, '', '', '');

-- --------------------------------------------------------

--
-- 表的结构 `dis_website`
--

CREATE TABLE IF NOT EXISTS `dis_website` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `logo` varchar(255) COLLATE utf8_bin NOT NULL,
  `title` varchar(255) COLLATE utf8_bin NOT NULL,
  `wdescribe` varchar(255) COLLATE utf8_bin NOT NULL,
  `copyright` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '0 ',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=42 ;

--
-- 转存表中的数据 `dis_website`
--

INSERT INTO `dis_website` (`id`, `logo`, `title`, `wdescribe`, `copyright`) VALUES
(41, '/Admin/Uploads/website/2015-05-08/554cbfcd48f74.jpg', '【折800官网】购物商城', '我是网站描述', '我是网站版权');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
