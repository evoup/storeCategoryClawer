<?php
/*
  +----------------------------------------------------------------------+
  | Name:
  +----------------------------------------------------------------------+
  | Comment:
  +----------------------------------------------------------------------+
  | Author:Evoup     evoex@126.com                                                     
  +----------------------------------------------------------------------+
  | Create:
  +----------------------------------------------------------------------+
  | Last-Modified:
  +----------------------------------------------------------------------+
*/
/*
 *CREATE TABLE `android_app_category` (
 *  `id` int(11) NOT NULL AUTO_INCREMENT,
 *  `android_app_category_id` varchar(45) COLLATE utf8_bin DEFAULT NULL,
 *  `parent_id` varchar(45) COLLATE utf8_bin DEFAULT NULL,
 *  `android_app_category_name` varchar(45) COLLATE utf8_bin DEFAULT NULL COMMENT 'app category engilsh name',
 *  `locale_names` longtext COLLATE utf8_bin COMMENT 'json key value map, if a category has many names of different countries, visit this field to get specify name.',
 *  PRIMARY KEY (`id`),
 *  UNIQUE KEY `category_id` (`android_app_category_id`),
 *  KEY `parenet_id` (`parent_id`),
 *  KEY `category_parent_id` (`android_app_category_id`,`parent_id`)
 *) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin
 */

$CAT=unserialize(file_get_contents('/tmp/res1.ser'));
//print_r($CAT);
$link = mysqli_connect('172.16.25.87', 'dba', 'madsolution') or die("Error: Unable to connect to MySQL." . PHP_EOL);
