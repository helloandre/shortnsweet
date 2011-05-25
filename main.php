<!DOCTYPE html>
<html>
<head>
	<style>
		body{background:white url(name_side.png) no-repeat;text-align:center;color:#40404;}
		a{text-decoration:none;color:#a8a8a8;}
		h2{color:green;}
		img{border:1px solid black;}
		ul{margin:0;padding:0;}
		li{list-style:none;}
		#submit{padding:7px;}
	</style>
	<title>Files</title>
</head>
<body>
	<div>
		<form enctype="multipart/form-data" action="up.php" method="POST">
			<p>Choose a file to upload:</p>
			<input name="media" type="file" /><br /><br />
			<input id='submit' type="submit" value="Upload File" />
		</form>
		<br><br><br>
		<p>Url to shorten:</p>
		<form action='up.php' method='GET'>
			<input name='site' size=50>
			<input type='submit' value='Shorten'>
		</form>
	</div>