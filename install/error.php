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
        <h1>Error</h1>
    </div>
    
    <div id='center' class='post'>
        <h2><a href="<?php echo SnS::make_url('install/') ?>">Try Again</a><h2>
    </div>
</body>

