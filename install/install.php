<?php
include("../lib/sns.php");

SnS::init();

$db_table = Config::$db_table;
$query = "CREATE TABLE IF NOT EXISTS `$db_table` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `type` tinyint(4) NOT NULL,
  `short` varchar(55) NOT NULL DEFAULT '',
  `long` varchar(255) NOT NULL DEFAULT '',
  `name` varchar(255) DEFAULT NULL,
  `ts` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `short` (`short`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;";

try {
    Db::q($query);
    Response::redirect('complete.php');
} catch (Exception $e) {
    Response::redirect('error.php');
}
?>