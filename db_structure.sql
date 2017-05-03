-- phpMyAdmin SQL Dump
-- version 4.4.15.10
-- https://www.phpmyadmin.net
--
-- Хост: localhost
-- Время создания: Май 03 2017 г., 15:25
-- Версия сервера: 5.6.33-79.0
-- Версия PHP: 5.3.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `u6789569_default`
--

-- --------------------------------------------------------

--
-- Структура таблицы `additional_field`
--

CREATE TABLE IF NOT EXISTS `additional_field` (
  `id` int(10) unsigned NOT NULL,
  `name` varchar(45) NOT NULL,
  `title` varchar(45) NOT NULL,
  `type` enum('text','textarea','select','date') NOT NULL,
  `sort` int(10) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `additional_field_value`
--

CREATE TABLE IF NOT EXISTS `additional_field_value` (
  `id` int(10) unsigned NOT NULL,
  `additional_field_id` int(10) unsigned NOT NULL,
  `value` varchar(45) NOT NULL,
  `sort` int(10) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `attachment`
--

CREATE TABLE IF NOT EXISTS `attachment` (
  `id` int(10) unsigned NOT NULL,
  `title` varchar(128) NOT NULL,
  `url` varchar(512) NOT NULL,
  `type` enum('image','video','document','certificate') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `attribute`
--

CREATE TABLE IF NOT EXISTS `attribute` (
  `id` int(10) unsigned NOT NULL,
  `name` varchar(256) NOT NULL,
  `title` varchar(256) NOT NULL,
  `type` int(10) unsigned NOT NULL,
  `show_on_preview` int(10) unsigned NOT NULL DEFAULT '0',
  `sort` int(10) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `attribute_value`
--

CREATE TABLE IF NOT EXISTS `attribute_value` (
  `id` int(10) unsigned NOT NULL,
  `label` varchar(256) DEFAULT NULL,
  `attribute_id` int(11) NOT NULL,
  `value` varchar(512) NOT NULL,
  `mark_up` int(10) unsigned NOT NULL DEFAULT '0',
  `active` int(10) unsigned NOT NULL DEFAULT '1',
  `sort` int(10) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `AuthAssignment`
--

CREATE TABLE IF NOT EXISTS `AuthAssignment` (
  `itemname` varchar(64) NOT NULL,
  `userid` varchar(64) NOT NULL,
  `bizrule` text,
  `data` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `authassignment`
--

CREATE TABLE IF NOT EXISTS `authassignment` (
  `itemname` varchar(64) NOT NULL,
  `userid` varchar(64) NOT NULL,
  `bizrule` text,
  `data` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `authitem`
--

CREATE TABLE IF NOT EXISTS `authitem` (
  `name` varchar(64) NOT NULL,
  `type` int(11) NOT NULL,
  `description` text,
  `bizrule` text,
  `data` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `AuthItem`
--

CREATE TABLE IF NOT EXISTS `AuthItem` (
  `name` varchar(64) NOT NULL,
  `type` int(11) NOT NULL,
  `description` text,
  `bizrule` text,
  `data` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `authitemchild`
--

CREATE TABLE IF NOT EXISTS `authitemchild` (
  `parent` varchar(64) NOT NULL,
  `child` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `AuthItemChild`
--

CREATE TABLE IF NOT EXISTS `AuthItemChild` (
  `parent` varchar(64) NOT NULL,
  `child` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `block`
--

CREATE TABLE IF NOT EXISTS `block` (
  `id` int(10) unsigned NOT NULL,
  `title` varchar(64) NOT NULL,
  `identifier` varchar(64) NOT NULL,
  `product_count` int(10) unsigned NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `block_product`
--

CREATE TABLE IF NOT EXISTS `block_product` (
  `product_id` int(10) unsigned NOT NULL,
  `block_id` int(10) unsigned NOT NULL,
  `sort` int(10) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `block_video`
--

CREATE TABLE IF NOT EXISTS `block_video` (
  `id` int(10) unsigned NOT NULL,
  `block_id` int(10) unsigned NOT NULL,
  `name` varchar(256) NOT NULL,
  `image` varchar(256) NOT NULL,
  `video_url` varchar(256) NOT NULL,
  `description` text NOT NULL,
  `sort` int(10) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `callback`
--

CREATE TABLE IF NOT EXISTS `callback` (
  `id` int(11) NOT NULL,
  `name` varchar(60) NOT NULL,
  `phone` varchar(60) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` int(10) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `card`
--

CREATE TABLE IF NOT EXISTS `card` (
  `id` int(10) unsigned NOT NULL,
  `buyer` varchar(60) DEFAULT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `email` varchar(40) NOT NULL,
  `subscribe` tinyint(1) NOT NULL DEFAULT '0',
  `number` varchar(6) NOT NULL,
  `date_issue` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `card_product`
--

CREATE TABLE IF NOT EXISTS `card_product` (
  `id` int(10) unsigned NOT NULL,
  `card_id` int(10) unsigned NOT NULL,
  `product_id` int(10) unsigned NOT NULL,
  `product_price` double DEFAULT NULL,
  `product_count` int(10) unsigned NOT NULL,
  `discount` int(11) DEFAULT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `id` int(10) unsigned NOT NULL,
  `pid` int(10) unsigned DEFAULT NULL,
  `shop_id` int(10) unsigned NOT NULL,
  `short_title` varchar(120) DEFAULT NULL,
  `title` varchar(128) NOT NULL,
  `second_title` varchar(1024) DEFAULT NULL,
  `slug` varchar(128) NOT NULL,
  `description` text NOT NULL,
  `meta_description` text NOT NULL,
  `meta_keywords` varchar(500) NOT NULL,
  `icon` varchar(128) NOT NULL,
  `item_template` varchar(64) NOT NULL DEFAULT '_view',
  `custom_style` varchar(256) DEFAULT NULL,
  `static_page` varchar(256) DEFAULT NULL,
  `is_new` tinyint(1) NOT NULL DEFAULT '0',
  `sort` int(10) unsigned NOT NULL DEFAULT '0',
  `visible` int(10) unsigned DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `customers`
--

CREATE TABLE IF NOT EXISTS `customers` (
  `id` int(10) unsigned NOT NULL,
  `name` varchar(128) NOT NULL,
  `phone` varchar(64) NOT NULL,
  `email` varchar(64) NOT NULL,
  `subscribe` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `customer_address`
--

CREATE TABLE IF NOT EXISTS `customer_address` (
  `id` int(10) unsigned NOT NULL,
  `zip` varchar(6) DEFAULT NULL,
  `city` varchar(128) DEFAULT NULL,
  `area` varchar(128) DEFAULT NULL,
  `address` text,
  `street` varchar(128) DEFAULT NULL,
  `house` varchar(128) DEFAULT NULL,
  `apartment` varchar(128) DEFAULT NULL,
  `pvz` varchar(128) DEFAULT NULL,
  `pvz_name` varchar(128) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `customer_entity_info`
--

CREATE TABLE IF NOT EXISTS `customer_entity_info` (
  `id` int(10) unsigned NOT NULL,
  `name` varchar(512) NOT NULL,
  `director_short` varchar(256) NOT NULL,
  `director` varchar(256) NOT NULL,
  `ogrn` varchar(16) NOT NULL,
  `inn` varchar(20) NOT NULL,
  `kpp` varchar(16) NOT NULL,
  `okpo` varchar(16) NOT NULL,
  `address` varchar(256) NOT NULL,
  `phone` varchar(64) NOT NULL,
  `rs` varchar(20) NOT NULL,
  `bank` varchar(256) NOT NULL,
  `bik` varchar(10) NOT NULL,
  `ks` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `discount`
--

CREATE TABLE IF NOT EXISTS `discount` (
  `id` int(10) unsigned NOT NULL,
  `title` varchar(128) NOT NULL,
  `description` text NOT NULL,
  `image` varchar(256) DEFAULT NULL,
  `value` varchar(64) NOT NULL,
  `label` varchar(128) DEFAULT NULL,
  `date_from` date NOT NULL,
  `date_to` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `discount_instruction`
--

CREATE TABLE IF NOT EXISTS `discount_instruction` (
  `id` int(10) unsigned NOT NULL,
  `description` text NOT NULL,
  `code` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `feature`
--

CREATE TABLE IF NOT EXISTS `feature` (
  `id` int(10) unsigned NOT NULL,
  `name` varchar(128) NOT NULL,
  `title` varchar(128) NOT NULL,
  `suffix` varchar(60) DEFAULT NULL,
  `visible` int(10) unsigned NOT NULL,
  `sort` int(10) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `filter`
--

CREATE TABLE IF NOT EXISTS `filter` (
  `id` int(10) unsigned NOT NULL,
  `name` varchar(128) NOT NULL,
  `title` varchar(128) NOT NULL,
  `visible` int(10) unsigned NOT NULL,
  `sort` int(10) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `filter_value`
--

CREATE TABLE IF NOT EXISTS `filter_value` (
  `id` int(10) unsigned NOT NULL,
  `filter_id` int(10) unsigned NOT NULL,
  `value` varchar(128) NOT NULL,
  `sort` int(10) unsigned NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `gallery`
--

CREATE TABLE IF NOT EXISTS `gallery` (
  `id` int(10) unsigned NOT NULL,
  `shop_id` int(10) unsigned NOT NULL,
  `short_title` varchar(256) NOT NULL,
  `title` varchar(256) NOT NULL,
  `description` text NOT NULL,
  `meta_description` text NOT NULL,
  `meta_keywords` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `gallery_album`
--

CREATE TABLE IF NOT EXISTS `gallery_album` (
  `id` int(10) unsigned NOT NULL,
  `gallery_id` int(10) unsigned NOT NULL,
  `short_title` varchar(256) NOT NULL,
  `title` varchar(256) NOT NULL,
  `slug` varchar(128) NOT NULL,
  `description` text NOT NULL,
  `meta_keywords` text NOT NULL,
  `meta_description` text NOT NULL,
  `visible` int(10) unsigned NOT NULL DEFAULT '1',
  `sort` int(10) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `geo`
--

CREATE TABLE IF NOT EXISTS `geo` (
  `id` int(11) NOT NULL,
  `zone_id` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  `full_name` varchar(512) NOT NULL,
  `postcode` varchar(6) NOT NULL,
  `parent_id` int(11) NOT NULL,
  `lat` double(10,6) NOT NULL,
  `long` float(10,6) NOT NULL,
  `population` double NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `global_settings`
--

CREATE TABLE IF NOT EXISTS `global_settings` (
  `id` int(11) unsigned NOT NULL,
  `name` varchar(60) NOT NULL,
  `value` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `hit_sales`
--

CREATE TABLE IF NOT EXISTS `hit_sales` (
  `product_id` int(10) unsigned NOT NULL,
  `sort` int(10) unsigned NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `image`
--

CREATE TABLE IF NOT EXISTS `image` (
  `model_id` int(10) unsigned NOT NULL,
  `model` varchar(128) NOT NULL,
  `type` int(10) unsigned NOT NULL,
  `url` varchar(256) NOT NULL,
  `title` varchar(512) DEFAULT NULL,
  `alt` varchar(256) DEFAULT NULL,
  `description` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `images`
--

CREATE TABLE IF NOT EXISTS `images` (
  `product_id` int(10) unsigned NOT NULL,
  `name` varchar(254) NOT NULL,
  `description` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `manufacturer`
--

CREATE TABLE IF NOT EXISTS `manufacturer` (
  `id` int(10) unsigned NOT NULL,
  `country` varchar(60) DEFAULT NULL,
  `site` varchar(128) DEFAULT NULL,
  `name` varchar(128) NOT NULL,
  `image` varchar(128) DEFAULT NULL,
  `sort` int(10) unsigned NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `news`
--

CREATE TABLE IF NOT EXISTS `news` (
  `id` int(10) unsigned NOT NULL,
  `meta_description` text,
  `meta_keywords` text,
  `title` varchar(200) NOT NULL,
  `slug` varchar(254) DEFAULT NULL,
  `image` varchar(128) NOT NULL,
  `short_text` text,
  `text` text NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `news_shop`
--

CREATE TABLE IF NOT EXISTS `news_shop` (
  `news_id` int(10) unsigned NOT NULL,
  `shop_id` int(10) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `orders`
--

CREATE TABLE IF NOT EXISTS `orders` (
  `id` int(10) unsigned NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `shop_id` int(10) unsigned NOT NULL DEFAULT '1',
  `customer_id` int(10) unsigned NOT NULL,
  `comment` text NOT NULL,
  `shipping_id` int(10) unsigned NOT NULL,
  `payment_id` int(10) unsigned NOT NULL,
  `track` varchar(200) DEFAULT NULL,
  `status` int(10) unsigned NOT NULL,
  `payment_status` int(10) unsigned NOT NULL,
  `log` text NOT NULL,
  `shipping_price` int(10) unsigned NOT NULL DEFAULT '0',
  `total_price` int(10) unsigned NOT NULL,
  `promo_code` varchar(64) DEFAULT NULL,
  `discount` varchar(64) DEFAULT NULL,
  `priority` smallint(6) NOT NULL DEFAULT '0',
  `update_status` datetime DEFAULT NULL,
  `update_payment_status` datetime DEFAULT NULL,
  `formed_date` datetime DEFAULT NULL,
  `allow_payment` tinyint(3) unsigned NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `order_additional_field`
--

CREATE TABLE IF NOT EXISTS `order_additional_field` (
  `id` int(10) unsigned NOT NULL,
  `order_id` int(10) unsigned NOT NULL,
  `additional_field_id` int(10) unsigned NOT NULL,
  `value` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `order_comment`
--

CREATE TABLE IF NOT EXISTS `order_comment` (
  `id` int(11) unsigned NOT NULL,
  `order_id` int(11) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL DEFAULT '1',
  `text` text NOT NULL,
  `create_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `order_expenses`
--

CREATE TABLE IF NOT EXISTS `order_expenses` (
  `id` int(10) unsigned NOT NULL,
  `order_id` int(10) unsigned NOT NULL,
  `amount` int(10) unsigned NOT NULL,
  `comment` varchar(500) NOT NULL,
  `create_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `order_gift`
--

CREATE TABLE IF NOT EXISTS `order_gift` (
  `id` int(11) NOT NULL,
  `order_id` int(10) unsigned NOT NULL,
  `gift_id` int(10) unsigned NOT NULL,
  `count` int(10) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `order_log`
--

CREATE TABLE IF NOT EXISTS `order_log` (
  `id` int(10) unsigned NOT NULL,
  `order_id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `action` enum('add','update','delete') NOT NULL,
  `field` varchar(45) NOT NULL,
  `description` text NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `order_meta`
--

CREATE TABLE IF NOT EXISTS `order_meta` (
  `order_id` int(10) unsigned NOT NULL,
  `name` varchar(60) NOT NULL,
  `value` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `order_notification`
--

CREATE TABLE IF NOT EXISTS `order_notification` (
  `id` int(10) unsigned NOT NULL,
  `order_id` int(10) unsigned NOT NULL,
  `type` enum('sms','email','call') NOT NULL,
  `description` text NOT NULL,
  `user_id` int(10) unsigned NOT NULL DEFAULT '1',
  `date_create` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `order_order_tag`
--

CREATE TABLE IF NOT EXISTS `order_order_tag` (
  `order_id` int(10) unsigned NOT NULL,
  `order_tag_id` int(10) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `order_payment`
--

CREATE TABLE IF NOT EXISTS `order_payment` (
  `order_id` int(10) unsigned NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `billing_data` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `order_payment_status`
--

CREATE TABLE IF NOT EXISTS `order_payment_status` (
  `id` int(10) unsigned NOT NULL,
  `name` varchar(60) NOT NULL,
  `label` varchar(15) DEFAULT 'default',
  `default` tinyint(3) unsigned NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `order_products`
--

CREATE TABLE IF NOT EXISTS `order_products` (
  `id` int(10) unsigned NOT NULL,
  `order_id` int(10) unsigned NOT NULL,
  `product_id` int(10) unsigned NOT NULL,
  `title` varchar(128) DEFAULT NULL,
  `image` varchar(256) DEFAULT NULL,
  `price` float DEFAULT NULL,
  `count` int(11) NOT NULL,
  `attributes_string` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `order_product_attribute_value`
--

CREATE TABLE IF NOT EXISTS `order_product_attribute_value` (
  `order_product_id` int(10) unsigned NOT NULL,
  `attribute_value_id` int(10) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `order_product_include`
--

CREATE TABLE IF NOT EXISTS `order_product_include` (
  `order_product_id` int(10) unsigned NOT NULL,
  `include_id` int(10) unsigned NOT NULL,
  `count` int(10) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `order_shipping_additional_field`
--

CREATE TABLE IF NOT EXISTS `order_shipping_additional_field` (
  `id` int(11) NOT NULL,
  `shipping_id` int(11) NOT NULL,
  `additional_field_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `order_status`
--

CREATE TABLE IF NOT EXISTS `order_status` (
  `id` int(10) unsigned NOT NULL,
  `name` varchar(60) NOT NULL,
  `label` varchar(15) DEFAULT NULL,
  `default` tinyint(3) unsigned NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `order_status_history`
--

CREATE TABLE IF NOT EXISTS `order_status_history` (
  `id` int(10) unsigned NOT NULL,
  `order_id` int(10) unsigned NOT NULL,
  `order_status_id` int(10) unsigned NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `order_tag`
--

CREATE TABLE IF NOT EXISTS `order_tag` (
  `id` int(10) unsigned NOT NULL,
  `img` varchar(60) NOT NULL,
  `label` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `payment`
--

CREATE TABLE IF NOT EXISTS `payment` (
  `id` int(10) unsigned NOT NULL,
  `user_name` varchar(64) NOT NULL,
  `name` varchar(128) NOT NULL,
  `redirect` varchar(40) NOT NULL,
  `params` text,
  `visible` int(10) unsigned NOT NULL,
  `sort` int(10) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `piece`
--

CREATE TABLE IF NOT EXISTS `piece` (
  `id` int(10) unsigned NOT NULL,
  `short_title` varchar(128) NOT NULL,
  `title` varchar(512) NOT NULL,
  `preview_image` varchar(512) NOT NULL,
  `general_image` varchar(512) NOT NULL,
  `temp_image` varchar(512) NOT NULL,
  `description` text NOT NULL,
  `visible` int(10) unsigned NOT NULL DEFAULT '1',
  `sort` int(10) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `products`
--

CREATE TABLE IF NOT EXISTS `products` (
  `id` int(10) unsigned NOT NULL,
  `shop` int(10) unsigned DEFAULT NULL,
  `category` int(10) unsigned DEFAULT NULL,
  `short_title` varchar(128) NOT NULL,
  `title` varchar(254) NOT NULL,
  `slug` varchar(128) NOT NULL,
  `page_title` varchar(200) DEFAULT NULL,
  `meta_description` text,
  `meta_keywords` varchar(500) DEFAULT NULL,
  `description` text NOT NULL,
  `image` varchar(254) NOT NULL,
  `type` enum('simple','set','composition') NOT NULL DEFAULT 'simple',
  `price` int(10) unsigned NOT NULL DEFAULT '0',
  `shipping_discount` int(10) unsigned DEFAULT NULL,
  `amount` int(10) unsigned NOT NULL DEFAULT '0',
  `manufacturer_id` int(10) unsigned DEFAULT NULL,
  `active` int(10) unsigned NOT NULL DEFAULT '1',
  `in_stock` int(10) unsigned NOT NULL DEFAULT '1',
  `category_visible` int(10) unsigned NOT NULL DEFAULT '1',
  `sort` int(10) unsigned NOT NULL DEFAULT '0',
  `updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `product_attachment`
--

CREATE TABLE IF NOT EXISTS `product_attachment` (
  `product_id` int(10) unsigned NOT NULL,
  `attachment_id` int(10) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `product_attribute`
--

CREATE TABLE IF NOT EXISTS `product_attribute` (
  `product_id` int(10) unsigned NOT NULL,
  `attribute_id` int(10) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `product_category`
--

CREATE TABLE IF NOT EXISTS `product_category` (
  `product_id` int(10) unsigned NOT NULL,
  `category_id` int(10) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `product_comment`
--

CREATE TABLE IF NOT EXISTS `product_comment` (
  `id` int(10) unsigned NOT NULL,
  `shop_id` int(10) unsigned NOT NULL,
  `product_id` int(10) unsigned NOT NULL,
  `user_name` varchar(256) NOT NULL,
  `user_email` varchar(256) NOT NULL,
  `rating` tinyint(3) unsigned NOT NULL,
  `text` text NOT NULL,
  `moderated` tinyint(1) NOT NULL DEFAULT '0',
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `product_composition`
--

CREATE TABLE IF NOT EXISTS `product_composition` (
  `product_id` int(10) unsigned NOT NULL,
  `include_id` int(10) unsigned NOT NULL,
  `image` varchar(256) DEFAULT NULL,
  `label` varchar(128) DEFAULT NULL,
  `sort` int(10) unsigned NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `product_description`
--

CREATE TABLE IF NOT EXISTS `product_description` (
  `shop_id` int(10) unsigned NOT NULL,
  `product_id` int(10) unsigned NOT NULL,
  `short_description` text NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `product_discount`
--

CREATE TABLE IF NOT EXISTS `product_discount` (
  `product_id` int(10) unsigned NOT NULL,
  `discount_id` int(10) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `product_feature`
--

CREATE TABLE IF NOT EXISTS `product_feature` (
  `id` int(10) unsigned NOT NULL,
  `product_id` int(10) unsigned NOT NULL,
  `feature_id` int(10) unsigned NOT NULL,
  `value` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `product_filter`
--

CREATE TABLE IF NOT EXISTS `product_filter` (
  `id` int(10) unsigned NOT NULL,
  `product_id` int(10) unsigned NOT NULL,
  `filter_id` int(10) unsigned NOT NULL,
  `value` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `product_filter_value`
--

CREATE TABLE IF NOT EXISTS `product_filter_value` (
  `product_filter_id` int(11) NOT NULL,
  `value` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `product_gift`
--

CREATE TABLE IF NOT EXISTS `product_gift` (
  `product_id` int(10) unsigned NOT NULL,
  `gift_id` int(10) unsigned NOT NULL,
  `shop_id` int(10) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `product_include`
--

CREATE TABLE IF NOT EXISTS `product_include` (
  `product_id` int(10) unsigned NOT NULL,
  `include_id` int(10) unsigned NOT NULL,
  `custom_price` int(11) DEFAULT NULL,
  `count` float unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `product_meta`
--

CREATE TABLE IF NOT EXISTS `product_meta` (
  `id` int(10) unsigned NOT NULL,
  `product_id` int(10) unsigned NOT NULL,
  `meta` varchar(60) NOT NULL,
  `value` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `product_news`
--

CREATE TABLE IF NOT EXISTS `product_news` (
  `product_id` int(10) unsigned NOT NULL,
  `news_id` int(10) unsigned NOT NULL,
  `sort` int(10) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `product_piece`
--

CREATE TABLE IF NOT EXISTS `product_piece` (
  `product_id` int(10) unsigned NOT NULL,
  `piece_id` int(10) unsigned NOT NULL,
  `piece_count` int(10) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `product_shop`
--

CREATE TABLE IF NOT EXISTS `product_shop` (
  `product_id` int(10) unsigned NOT NULL,
  `shop_id` int(10) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `product_visible`
--

CREATE TABLE IF NOT EXISTS `product_visible` (
  `product_id` int(10) unsigned NOT NULL,
  `site` int(10) unsigned NOT NULL DEFAULT '1',
  `product_list` int(10) unsigned NOT NULL DEFAULT '1',
  `add_product` int(10) unsigned NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `redirection`
--

CREATE TABLE IF NOT EXISTS `redirection` (
  `id` int(10) unsigned NOT NULL,
  `url_from` varchar(512) NOT NULL,
  `url_to` varchar(512) NOT NULL,
  `shop_id` int(10) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `referral`
--

CREATE TABLE IF NOT EXISTS `referral` (
  `id` int(10) unsigned NOT NULL,
  `name` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `password` varchar(128) NOT NULL,
  `autologin` varchar(128) NOT NULL,
  `visit` int(10) unsigned NOT NULL DEFAULT '0',
  `unique_visit` int(10) unsigned NOT NULL DEFAULT '0',
  `buy` int(10) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `referral_order`
--

CREATE TABLE IF NOT EXISTS `referral_order` (
  `referral_id` int(10) unsigned NOT NULL,
  `order_id` int(10) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `referral_social_banner`
--

CREATE TABLE IF NOT EXISTS `referral_social_banner` (
  `referral_id` int(10) unsigned NOT NULL,
  `visit` int(10) unsigned NOT NULL DEFAULT '0',
  `unique_visit` int(10) unsigned NOT NULL DEFAULT '0',
  `buy` int(10) unsigned NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `related_product`
--

CREATE TABLE IF NOT EXISTS `related_product` (
  `product_id` int(10) unsigned NOT NULL,
  `related_id` int(10) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `rights`
--

CREATE TABLE IF NOT EXISTS `rights` (
  `itemname` varchar(64) NOT NULL,
  `type` int(11) NOT NULL,
  `weight` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `Rights`
--

CREATE TABLE IF NOT EXISTS `Rights` (
  `itemname` varchar(64) NOT NULL,
  `type` int(11) NOT NULL,
  `weight` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `seller_form`
--

CREATE TABLE IF NOT EXISTS `seller_form` (
  `id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `start_sum` int(11) NOT NULL,
  `end_sum` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `seller_form_expense`
--

CREATE TABLE IF NOT EXISTS `seller_form_expense` (
  `id` int(10) unsigned NOT NULL,
  `seller_form_id` int(10) unsigned NOT NULL,
  `title` varchar(128) NOT NULL,
  `amount` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `seller_form_sale`
--

CREATE TABLE IF NOT EXISTS `seller_form_sale` (
  `id` int(10) unsigned NOT NULL,
  `seller_form_id` int(10) unsigned NOT NULL,
  `product_id` int(10) unsigned NOT NULL,
  `product_title` varchar(128) NOT NULL,
  `product_price` double unsigned NOT NULL,
  `product_count` int(10) unsigned NOT NULL,
  `discount` int(10) unsigned DEFAULT '0',
  `gift_id` int(10) unsigned NOT NULL,
  `gift_title` varchar(128) DEFAULT NULL,
  `payment_type` int(10) unsigned NOT NULL,
  `note` text,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `shipping`
--

CREATE TABLE IF NOT EXISTS `shipping` (
  `id` int(10) unsigned NOT NULL,
  `edost_code` int(10) unsigned NOT NULL,
  `label` varchar(5) DEFAULT NULL,
  `name` varchar(64) NOT NULL,
  `customer_name` varchar(64) DEFAULT NULL,
  `info` text NOT NULL,
  `tracking_link` varchar(128) DEFAULT NULL,
  `send_no_call` varchar(512) DEFAULT NULL,
  `sort` int(10) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `shipping_payment`
--

CREATE TABLE IF NOT EXISTS `shipping_payment` (
  `shipping_id` int(10) unsigned NOT NULL,
  `payment_id` int(10) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `shop`
--

CREATE TABLE IF NOT EXISTS `shop` (
  `id` int(10) unsigned NOT NULL,
  `domain` varchar(128) NOT NULL,
  `name` varchar(128) NOT NULL,
  `address` text NOT NULL,
  `email` varchar(128) NOT NULL,
  `phone` varchar(32) NOT NULL,
  `title` varchar(128) NOT NULL,
  `meta_description` text NOT NULL,
  `meta_keywords` varchar(500) NOT NULL,
  `template` varchar(64) NOT NULL,
  `mobile_template` varchar(64) DEFAULT NULL,
  `category_url_type` int(11) NOT NULL DEFAULT '0',
  `category_nesting` int(10) unsigned NOT NULL DEFAULT '3',
  `default_controller` varchar(128) DEFAULT NULL,
  `default_product_id` int(10) unsigned DEFAULT NULL,
  `vk_app_id` int(10) unsigned DEFAULT NULL,
  `yandex_metrika_id` int(10) unsigned DEFAULT NULL,
  `edost_shop_id` int(11) NOT NULL DEFAULT '3359',
  `edost_shop_password` varchar(64) NOT NULL DEFAULT 'iFOatdWP6RPo8yHUOsVnLf9Ff56tj8sE'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `shop_category`
--

CREATE TABLE IF NOT EXISTS `shop_category` (
  `shop_id` int(10) unsigned NOT NULL,
  `category_id` int(10) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `shop_email_template`
--

CREATE TABLE IF NOT EXISTS `shop_email_template` (
  `shop_id` int(10) unsigned NOT NULL,
  `header_banner` varchar(256) NOT NULL,
  `color_1` varchar(6) NOT NULL,
  `color_2` varchar(6) NOT NULL,
  `color_3` varchar(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `shop_email_template_product`
--

CREATE TABLE IF NOT EXISTS `shop_email_template_product` (
  `id` int(10) unsigned NOT NULL,
  `shop_id` int(10) unsigned NOT NULL,
  `title` varchar(256) NOT NULL,
  `url` varchar(256) NOT NULL,
  `image` varchar(256) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `shop_images`
--

CREATE TABLE IF NOT EXISTS `shop_images` (
  `id` int(10) unsigned NOT NULL,
  `logo` varchar(128) NOT NULL,
  `icon` varchar(128) NOT NULL,
  `watermark` varchar(128) DEFAULT NULL,
  `watermark_x` int(11) NOT NULL DEFAULT '0',
  `watermark_y` int(11) NOT NULL DEFAULT '0',
  `banner_width` int(10) unsigned NOT NULL DEFAULT '0',
  `banner_height` int(10) unsigned NOT NULL DEFAULT '0',
  `category_width` int(10) unsigned NOT NULL DEFAULT '800',
  `category_height` int(10) unsigned NOT NULL DEFAULT '300',
  `thumb_width` int(10) unsigned NOT NULL DEFAULT '400',
  `thumb_height` int(10) unsigned NOT NULL DEFAULT '400',
  `popup_width` int(10) unsigned NOT NULL DEFAULT '1000',
  `popup_height` int(10) unsigned NOT NULL DEFAULT '1000',
  `product_width` int(10) unsigned NOT NULL DEFAULT '245',
  `product_height` int(10) unsigned NOT NULL DEFAULT '335',
  `additional_width` int(10) unsigned NOT NULL DEFAULT '400',
  `additional_height` int(10) unsigned NOT NULL DEFAULT '400',
  `related_width` int(10) unsigned NOT NULL DEFAULT '245',
  `related_height` int(10) unsigned NOT NULL DEFAULT '335',
  `compare_width` int(10) unsigned NOT NULL DEFAULT '90',
  `compare_height` int(10) unsigned NOT NULL DEFAULT '90',
  `wishlist_width` int(10) unsigned NOT NULL DEFAULT '90',
  `wishlist_height` int(10) unsigned NOT NULL DEFAULT '90',
  `cart_width` int(10) unsigned NOT NULL DEFAULT '90',
  `cart_height` int(11) unsigned NOT NULL DEFAULT '90',
  `category_icon_width` int(10) unsigned NOT NULL DEFAULT '0',
  `category_icon_height` int(10) unsigned NOT NULL DEFAULT '0',
  `piece_width` int(11) NOT NULL DEFAULT '100',
  `piece_height` int(11) NOT NULL DEFAULT '100',
  `news_width` int(10) unsigned NOT NULL DEFAULT '350',
  `news_height` int(10) unsigned NOT NULL DEFAULT '350',
  `video_block_width` int(10) unsigned NOT NULL DEFAULT '300',
  `video_block_height` int(10) unsigned NOT NULL DEFAULT '169',
  `gallery_width` int(11) NOT NULL DEFAULT '1205',
  `gallery_height` int(11) NOT NULL DEFAULT '800'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `shop_product_count`
--

CREATE TABLE IF NOT EXISTS `shop_product_count` (
  `id` int(10) unsigned NOT NULL,
  `related` int(10) unsigned NOT NULL DEFAULT '10',
  `new` int(10) unsigned NOT NULL DEFAULT '10',
  `hit_sales` int(10) unsigned NOT NULL DEFAULT '10',
  `category` int(10) unsigned NOT NULL DEFAULT '10',
  `index` int(10) unsigned NOT NULL DEFAULT '10'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `social_banner`
--

CREATE TABLE IF NOT EXISTS `social_banner` (
  `id` int(10) unsigned NOT NULL,
  `title` varchar(64) NOT NULL,
  `image` varchar(128) NOT NULL,
  `text` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `static_page`
--

CREATE TABLE IF NOT EXISTS `static_page` (
  `id` int(11) NOT NULL,
  `shop_id` int(10) unsigned DEFAULT NULL,
  `slug` varchar(128) NOT NULL,
  `title` varchar(128) NOT NULL,
  `short_title` varchar(128) NOT NULL,
  `meta_tag` text,
  `meta_description` text,
  `content` text NOT NULL,
  `updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(10) unsigned NOT NULL,
  `login` varchar(128) NOT NULL,
  `password` varchar(32) NOT NULL,
  `name` varchar(120) NOT NULL,
  `default_controller` varchar(40) DEFAULT NULL,
  `signature` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `yandex_direct_offer`
--

CREATE TABLE IF NOT EXISTS `yandex_direct_offer` (
  `utm_campaign` int(10) unsigned NOT NULL,
  `utm_content` int(10) unsigned DEFAULT NULL,
  `offer_name` varchar(256) NOT NULL,
  `priority` int(10) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `additional_field`
--
ALTER TABLE `additional_field`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `additional_field_value`
--
ALTER TABLE `additional_field_value`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `attachment`
--
ALTER TABLE `attachment`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `attribute`
--
ALTER TABLE `attribute`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `attribute_value`
--
ALTER TABLE `attribute_value`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `AuthAssignment`
--
ALTER TABLE `AuthAssignment`
  ADD PRIMARY KEY (`itemname`,`userid`);

--
-- Индексы таблицы `authassignment`
--
ALTER TABLE `authassignment`
  ADD PRIMARY KEY (`itemname`,`userid`);

--
-- Индексы таблицы `authitem`
--
ALTER TABLE `authitem`
  ADD PRIMARY KEY (`name`);

--
-- Индексы таблицы `AuthItem`
--
ALTER TABLE `AuthItem`
  ADD PRIMARY KEY (`name`);

--
-- Индексы таблицы `authitemchild`
--
ALTER TABLE `authitemchild`
  ADD PRIMARY KEY (`parent`,`child`),
  ADD KEY `child` (`child`);

--
-- Индексы таблицы `AuthItemChild`
--
ALTER TABLE `AuthItemChild`
  ADD PRIMARY KEY (`parent`,`child`),
  ADD KEY `child` (`child`);

--
-- Индексы таблицы `block`
--
ALTER TABLE `block`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `block_product`
--
ALTER TABLE `block_product`
  ADD PRIMARY KEY (`product_id`);

--
-- Индексы таблицы `block_video`
--
ALTER TABLE `block_video`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `callback`
--
ALTER TABLE `callback`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `card`
--
ALTER TABLE `card`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `card_product`
--
ALTER TABLE `card_product`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `customer_address`
--
ALTER TABLE `customer_address`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `customer_entity_info`
--
ALTER TABLE `customer_entity_info`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `discount`
--
ALTER TABLE `discount`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `discount_instruction`
--
ALTER TABLE `discount_instruction`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `feature`
--
ALTER TABLE `feature`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `filter`
--
ALTER TABLE `filter`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `filter_value`
--
ALTER TABLE `filter_value`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `gallery`
--
ALTER TABLE `gallery`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `gallery_album`
--
ALTER TABLE `gallery_album`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `geo`
--
ALTER TABLE `geo`
  ADD PRIMARY KEY (`id`),
  ADD KEY `name` (`name`);

--
-- Индексы таблицы `global_settings`
--
ALTER TABLE `global_settings`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `hit_sales`
--
ALTER TABLE `hit_sales`
  ADD PRIMARY KEY (`product_id`);

--
-- Индексы таблицы `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`product_id`,`name`);

--
-- Индексы таблицы `manufacturer`
--
ALTER TABLE `manufacturer`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `news_shop`
--
ALTER TABLE `news_shop`
  ADD PRIMARY KEY (`news_id`,`shop_id`);

--
-- Индексы таблицы `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `order_additional_field`
--
ALTER TABLE `order_additional_field`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `order_comment`
--
ALTER TABLE `order_comment`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `order_expenses`
--
ALTER TABLE `order_expenses`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `order_gift`
--
ALTER TABLE `order_gift`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `order_log`
--
ALTER TABLE `order_log`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `order_meta`
--
ALTER TABLE `order_meta`
  ADD KEY `order_id` (`order_id`);

--
-- Индексы таблицы `order_notification`
--
ALTER TABLE `order_notification`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `order_order_tag`
--
ALTER TABLE `order_order_tag`
  ADD PRIMARY KEY (`order_id`,`order_tag_id`);

--
-- Индексы таблицы `order_payment`
--
ALTER TABLE `order_payment`
  ADD PRIMARY KEY (`order_id`);

--
-- Индексы таблицы `order_payment_status`
--
ALTER TABLE `order_payment_status`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `order_products`
--
ALTER TABLE `order_products`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `order_product_attribute_value`
--
ALTER TABLE `order_product_attribute_value`
  ADD PRIMARY KEY (`order_product_id`,`attribute_value_id`);

--
-- Индексы таблицы `order_product_include`
--
ALTER TABLE `order_product_include`
  ADD UNIQUE KEY `order_product_id` (`order_product_id`,`include_id`);

--
-- Индексы таблицы `order_shipping_additional_field`
--
ALTER TABLE `order_shipping_additional_field`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `order_status`
--
ALTER TABLE `order_status`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `order_status_history`
--
ALTER TABLE `order_status_history`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `order_tag`
--
ALTER TABLE `order_tag`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `piece`
--
ALTER TABLE `piece`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `product_attachment`
--
ALTER TABLE `product_attachment`
  ADD PRIMARY KEY (`product_id`,`attachment_id`);

--
-- Индексы таблицы `product_attribute`
--
ALTER TABLE `product_attribute`
  ADD PRIMARY KEY (`product_id`,`attribute_id`);

--
-- Индексы таблицы `product_category`
--
ALTER TABLE `product_category`
  ADD PRIMARY KEY (`product_id`,`category_id`);

--
-- Индексы таблицы `product_comment`
--
ALTER TABLE `product_comment`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `product_composition`
--
ALTER TABLE `product_composition`
  ADD PRIMARY KEY (`product_id`,`include_id`);

--
-- Индексы таблицы `product_description`
--
ALTER TABLE `product_description`
  ADD PRIMARY KEY (`shop_id`,`product_id`);

--
-- Индексы таблицы `product_discount`
--
ALTER TABLE `product_discount`
  ADD PRIMARY KEY (`product_id`,`discount_id`);

--
-- Индексы таблицы `product_feature`
--
ALTER TABLE `product_feature`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `product_filter`
--
ALTER TABLE `product_filter`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `product_gift`
--
ALTER TABLE `product_gift`
  ADD PRIMARY KEY (`product_id`,`gift_id`);

--
-- Индексы таблицы `product_include`
--
ALTER TABLE `product_include`
  ADD PRIMARY KEY (`product_id`,`include_id`);

--
-- Индексы таблицы `product_meta`
--
ALTER TABLE `product_meta`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `product_news`
--
ALTER TABLE `product_news`
  ADD PRIMARY KEY (`product_id`,`news_id`);

--
-- Индексы таблицы `product_piece`
--
ALTER TABLE `product_piece`
  ADD PRIMARY KEY (`product_id`,`piece_id`);

--
-- Индексы таблицы `product_shop`
--
ALTER TABLE `product_shop`
  ADD PRIMARY KEY (`product_id`,`shop_id`);

--
-- Индексы таблицы `product_visible`
--
ALTER TABLE `product_visible`
  ADD PRIMARY KEY (`product_id`);

--
-- Индексы таблицы `redirection`
--
ALTER TABLE `redirection`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `referral`
--
ALTER TABLE `referral`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `referral_order`
--
ALTER TABLE `referral_order`
  ADD PRIMARY KEY (`referral_id`,`order_id`);

--
-- Индексы таблицы `referral_social_banner`
--
ALTER TABLE `referral_social_banner`
  ADD PRIMARY KEY (`referral_id`);

--
-- Индексы таблицы `related_product`
--
ALTER TABLE `related_product`
  ADD PRIMARY KEY (`product_id`,`related_id`);

--
-- Индексы таблицы `rights`
--
ALTER TABLE `rights`
  ADD PRIMARY KEY (`itemname`);

--
-- Индексы таблицы `Rights`
--
ALTER TABLE `Rights`
  ADD PRIMARY KEY (`itemname`);

--
-- Индексы таблицы `seller_form`
--
ALTER TABLE `seller_form`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `seller_form_expense`
--
ALTER TABLE `seller_form_expense`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `seller_form_sale`
--
ALTER TABLE `seller_form_sale`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `shipping`
--
ALTER TABLE `shipping`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `shipping_payment`
--
ALTER TABLE `shipping_payment`
  ADD PRIMARY KEY (`shipping_id`,`payment_id`),
  ADD UNIQUE KEY `UNIQUE` (`payment_id`,`shipping_id`);

--
-- Индексы таблицы `shop`
--
ALTER TABLE `shop`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `shop_category`
--
ALTER TABLE `shop_category`
  ADD PRIMARY KEY (`shop_id`,`category_id`);

--
-- Индексы таблицы `shop_email_template`
--
ALTER TABLE `shop_email_template`
  ADD PRIMARY KEY (`shop_id`);

--
-- Индексы таблицы `shop_email_template_product`
--
ALTER TABLE `shop_email_template_product`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `shop_images`
--
ALTER TABLE `shop_images`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `shop_product_count`
--
ALTER TABLE `shop_product_count`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `social_banner`
--
ALTER TABLE `social_banner`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `additional_field`
--
ALTER TABLE `additional_field`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `additional_field_value`
--
ALTER TABLE `additional_field_value`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `attachment`
--
ALTER TABLE `attachment`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `attribute`
--
ALTER TABLE `attribute`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `attribute_value`
--
ALTER TABLE `attribute_value`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `block`
--
ALTER TABLE `block`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `block_video`
--
ALTER TABLE `block_video`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `callback`
--
ALTER TABLE `callback`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `card`
--
ALTER TABLE `card`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `card_product`
--
ALTER TABLE `card_product`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `category`
--
ALTER TABLE `category`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `discount`
--
ALTER TABLE `discount`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `discount_instruction`
--
ALTER TABLE `discount_instruction`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `feature`
--
ALTER TABLE `feature`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `filter`
--
ALTER TABLE `filter`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `filter_value`
--
ALTER TABLE `filter_value`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `gallery`
--
ALTER TABLE `gallery`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `gallery_album`
--
ALTER TABLE `gallery_album`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `geo`
--
ALTER TABLE `geo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `global_settings`
--
ALTER TABLE `global_settings`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `manufacturer`
--
ALTER TABLE `manufacturer`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `news`
--
ALTER TABLE `news`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `order_additional_field`
--
ALTER TABLE `order_additional_field`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `order_comment`
--
ALTER TABLE `order_comment`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `order_expenses`
--
ALTER TABLE `order_expenses`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `order_gift`
--
ALTER TABLE `order_gift`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `order_log`
--
ALTER TABLE `order_log`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `order_notification`
--
ALTER TABLE `order_notification`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `order_payment_status`
--
ALTER TABLE `order_payment_status`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `order_products`
--
ALTER TABLE `order_products`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `order_shipping_additional_field`
--
ALTER TABLE `order_shipping_additional_field`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `order_status`
--
ALTER TABLE `order_status`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `order_status_history`
--
ALTER TABLE `order_status_history`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `order_tag`
--
ALTER TABLE `order_tag`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `payment`
--
ALTER TABLE `payment`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `piece`
--
ALTER TABLE `piece`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `products`
--
ALTER TABLE `products`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `product_comment`
--
ALTER TABLE `product_comment`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `product_feature`
--
ALTER TABLE `product_feature`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `product_filter`
--
ALTER TABLE `product_filter`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `product_meta`
--
ALTER TABLE `product_meta`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `redirection`
--
ALTER TABLE `redirection`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `referral`
--
ALTER TABLE `referral`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `seller_form`
--
ALTER TABLE `seller_form`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `seller_form_expense`
--
ALTER TABLE `seller_form_expense`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `seller_form_sale`
--
ALTER TABLE `seller_form_sale`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `shipping`
--
ALTER TABLE `shipping`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `shop`
--
ALTER TABLE `shop`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `shop_email_template_product`
--
ALTER TABLE `shop_email_template_product`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `shop_images`
--
ALTER TABLE `shop_images`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `social_banner`
--
ALTER TABLE `social_banner`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `user`
--
ALTER TABLE `user`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `AuthAssignment`
--
ALTER TABLE `AuthAssignment`
  ADD CONSTRAINT `AuthAssignment_ibfk_1` FOREIGN KEY (`itemname`) REFERENCES `AuthItem` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `AuthItemChild`
--
ALTER TABLE `AuthItemChild`
  ADD CONSTRAINT `AuthItemChild_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `AuthItem` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `AuthItemChild_ibfk_2` FOREIGN KEY (`child`) REFERENCES `AuthItem` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `Rights`
--
ALTER TABLE `Rights`
  ADD CONSTRAINT `Rights_ibfk_1` FOREIGN KEY (`itemname`) REFERENCES `AuthItem` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
