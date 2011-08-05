<?php
/*******
 * Google Safebrowsing API key
 * see the README for instructions on how to set this value
 ******/
$gsb_key = null;

/******
 * Basic config
 *****/

// The database name
$db_name = "terrie";
// this should almost always be localhost
$db_host = "localhost:/tmp/mysql/terrie.sock";
// the database user
$db_user = "michal";
// the database password
$db_pass = "OnbrchLN";

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

mysql_connect($db_host, $db_user, $db_pass) or die("Database Connection Error: " . mysql_error());
mysql_select_db($db_name);

$current = getcwd()."/config.php";


function get_resp_code($url){
    $ch1 = curl_init();
    curl_setopt($ch1, CURLOPT_URL, $url);
    curl_setopt($ch1, CURLOPT_RETURNTRANSFER, 1);
    curl_exec($ch1);
    $resp = curl_getinfo($ch1, CURLINFO_HTTP_CODE);
    curl_close($ch1);
    return $resp;
}
?>
