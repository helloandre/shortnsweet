<?php 
include("../config.php");
?>
<!DOCTYPE html>
<html>

<head>
	<title><?php echo $site_name ?></title>
	<style>
		body{text-align: center;color: #B4C5D3;}
		a{font-size: 1.2em;color: #5D5D5D;padding: 3px;}
	</style>	
</head>

<body>
	You are about to populate a database with the following information:<br><br>
	Name: <strong><?php echo $db_name ?></strong><br>
	User: <strong><?php echo $db_user ?></strong><br>
	Password: <strong><?php echo $db_pass ?></strong><br><br>
	
	Your site with the following information<br>
	url: http://<strong><?php echo $site_url ?></strong><br>
	name: <strong><?php echo $site_name ?></strong><br><br>
	
	If this seems incorrect, please edit:
	<strong><?php echo $current ?></strong><br><br>
	
	Otherwise:<br>
	<a href='complete.php'>Install >></a>
</body>
