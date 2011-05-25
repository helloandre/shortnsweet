<?php
/******
 * Basic config
 *****/

// The database name
$db_name = "uploads";
// this should almost always be localhost
$db_host = "localhost";
// the database user
$db_user = "uploads_user";
// the database password
$db_pass = "uploads_pass";

// this is where your url will go (really important)
// without http://
$site_url = "ablu.us";

// name of your site
$site_name = "Ablu.us";

/******
 * Advanced features
 *****/

// easily expandable to include uppercase and numbers and symbols
$usable = array('a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm',
		'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z');
		
/* this controls how many letters/numbers in the url
 * 		for only lowercase alphabet (default as of v1.0):
 * 		3 -> 26 ^ 3 = 17576
 * 		4 -> 26 ^ 4 = 456976
 * 
 * the higher this number, the longer the url, but also the more you can handle
 */		
$url_length = 3;

mysql_connect("localhost", $db_user, $db_pass) or die("Database Connection Error: " . mysql_error());
mysql_select_db($db_name);

$current = getcwd()."/config.php";
?>
