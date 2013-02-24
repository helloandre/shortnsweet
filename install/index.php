<?php 
include("../lib/sns.php");

SnS::init();
?>
<!doctype html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

    <title>Short 'n Sweet</title>
    <meta name="description" content="andre bluehs file upload hosting">
    <meta name="author" content="Andre Bluehs">

    <link rel="shortcut icon" href="http://abcdn.us/img/andrebluehs/favicon.png" />
    <link rel="stylesheet" href="http://abcdn.us/css/andrebluehs/style.css" />
</head>

<body>
    <div id='header'>
        <div id='header-left'>
            <h2>Short 'n Sweet</h2>
        </div>
        <div id='header-right'>
            <ul class='horizontal'>
                <li><a href='http://github.com/helloandre/shortnsweet/' target='_blank'>view source on github</a></li>
            </ul>
        </div>
    </div>
    
    <div id='sub-header'>
        <h1>Install</h1>
    </div>
    
    <div id='center' class='post'>
        <h3>You are about to populate a database with the following information:</h3>
        
        <p>If any of the below information is incorrect, please edit /lib/config.php</p>
        	
        <dl>
        	<dt>DB Name: </dt>
        	<dd><?php echo Config::$db_name ?></dd>
        	
        	<dt>DB User: </dt>
        	<dd><?php echo Config::$db_user ?></dd>
        	
        	<dt>DB Password: </dt>
        	<dd><?php echo Config::$db_pass ?></dd>
        	
        	<dt>DB Table: </dt>
        	<dd><?php echo Config::$db_table ?></dd>
        	
        	<dt>DB Host: </dt>
        	<dd><?php echo Config::$db_host ?></dd>
        </dl>
        
		<h2><a href='install.php'>Install >></a><h2>
    </div>
</body>
